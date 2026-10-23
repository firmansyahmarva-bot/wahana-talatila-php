import fs from 'node:fs';
import path from 'node:path';
import assert from 'node:assert/strict';
import { chromium } from 'playwright';

const output = 'output/course-redesign';
fs.mkdirSync(output, { recursive: true });
const metadata = html => [...html.matchAll(/<meta\b[^>]*>|<title>[\s\S]*?<\/title>|<link\b[^>]*rel="(?:canonical|alternate)"[^>]*>/g)].map(match => match[0]);
const snapshot = html => ({ metadata: metadata(html.match(/<head>([\s\S]*?)<\/head>/)?.[1] || ''), h1: [...html.matchAll(/<h1\b[^>]*>([\s\S]*?)<\/h1>/g)].map(match => match[1]), schemas: [...html.matchAll(/<script[^>]*type="application\/ld\+json"[^>]*>([\s\S]*?)<\/script>/g)].map(match => match[1]) });
const pages = {};
function walk(dir) {
  for (const entry of fs.readdirSync(dir, { withFileTypes: true })) {
    const file = path.join(dir, entry.name);
    if (entry.isDirectory()) walk(file);
    else if (file.endsWith('.html')) pages[path.relative('dist', file)] = fs.readFileSync(file, 'utf8');
  }
}
walk('dist');
if (process.argv.includes('--capture-baseline')) {
  fs.writeFileSync(path.join(output, 'seo-baseline.json'), JSON.stringify(Object.fromEntries(Object.entries(pages).map(([name, html]) => [name, snapshot(html)]))));
  console.log(`Saved baseline for ${Object.keys(pages).length} HTML files.`);
  process.exit(0);
}
const baselineFile = path.join(output, 'seo-baseline.json');
if (fs.existsSync(baselineFile)) {
  const baseline = JSON.parse(fs.readFileSync(baselineFile, 'utf8'));
  assert.deepEqual(Object.keys(pages).sort(), Object.keys(baseline).sort(), 'Generated route set must stay unchanged');
  for (const [name, html] of Object.entries(pages)) assert.deepEqual(snapshot(html), baseline[name], `${name}: SEO metadata, H1 or schema changed`);
  console.log(`SEO metadata, H1 and schemas unchanged on ${Object.keys(pages).length} HTML files.`);
}
const coursePages = Object.entries(pages).filter(([, html]) => html.includes('class="course-experience"'));
for (const [name, html] of coursePages) {
  assert.equal((html.match(/<h1\b/g) || []).length, 1, name);
  assert.ok(html.includes('id="jadwal-pelatihan"'), name + ' schedule anchor');
  assert.ok(html.includes('id="pendaftaran"'), name + ' registration anchor');
  assert.ok(html.includes('id="in-house-training"'), name + ' dedicated in-house card');
  assert.ok(!html.includes('Tertarik dengan program ini?'), name + ' course-specific closing CTA');
  assert.ok(!html.includes('pelatihan-detail.css'), name + ' legacy stylesheet removed');
  const image = html.match(/<figure class="ce-hero-image"><img[^>]*src="([^\"]+)"/);
  assert.ok(image && fs.existsSync(path.join('public', image[1])), name + ' existing hero image');
}
console.log(`${coursePages.length} course and schedule pages have a complete hero, schedule and registration.`);
const programSchedules = coursePages.filter(([name]) => name.startsWith('jadwal' + path.sep));
for (const [name, html] of programSchedules) {
  const courseFile = name.replace(/^jadwal/, 'pelatihan');
  const course = pages[courseFile];
  assert.ok(course, name + ' related course');
  assert.equal(snapshot(html).h1[0], 'Jadwal ' + snapshot(course).h1[0], name + ' shared course name');
  for (const pattern of [/<p class="ce-price">([\s\S]*?)<\/p>/, /<ul class="pd-curriculum">([\s\S]*?)<\/ul>/, /<strong data-course-next-date[^>]*>([\s\S]*?)<\/strong>/]) {
    assert.equal(html.match(pattern)?.[1], course.match(pattern)?.[1], name + ' shared price, curriculum or next date');
  }
}
console.log(`${programSchedules.length} schedule pages match course names, prices, curriculum and dates.`);
if (process.argv.includes('--seo-only')) process.exit(0);
const origin = 'http://course-preview.test';
const browser = await chromium.launch({ headless: true });
const routes = ['/pelatihan/ak3-bnsp/', '/pelatihan/pelatihan-ahli-k3-umum-sertifikasi-kemnaker-ri/', '/pelatihan/pelatihan-k3-operator-forklift-kelas-2-sertifikasi-kemnaker-ri/', '/pelatihan/pelatihan-damkar-paralel-kelas-dcba-sertifikasi-kemnaker-ri/', '/pelatihan/pelatihan-penanggung-jawab-operasional-instalasi-pengendalian-pencemaran-udara-poippu-offline/'];
const scheduleRoutes = routes.map(route => route.replace('/pelatihan/', '/jadwal/'));
const serveBuild = async route => {
      const url = new URL(route.request().url());
      if (url.origin !== origin) return route.abort();
      const root = path.resolve('dist');
      let file = path.resolve(root, '.' + decodeURIComponent(url.pathname));
      if (!file.startsWith(root + path.sep) && file !== root) return route.abort();
      if (fs.existsSync(file) && fs.statSync(file).isDirectory()) file = path.join(file, 'index.html');
      if (!fs.existsSync(file)) return route.fulfill({ status: 404, body: '' });
      const types = { '.html': 'text/html', '.css': 'text/css', '.js': 'text/javascript', '.png': 'image/png', '.webp': 'image/webp', '.svg': 'image/svg+xml', '.woff2': 'font/woff2' };
      return route.fulfill({ status: 200, contentType: types[path.extname(file)] || 'application/octet-stream', body: fs.readFileSync(file) });
};
let checks = 0;
try {
  for (const width of [320, 390, 768, 1024, 1440]) {
    const page = await browser.newPage({ viewport: { width, height: 1000 } });
    await page.route('**/*', serveBuild);
    for (const route of [...routes, ...scheduleRoutes]) {
      const isSchedule = route.startsWith('/jadwal/');
      const errors = [];
      const onError = error => errors.push(error.message);
      page.on('pageerror', onError);
      await page.goto(origin + route, { waitUntil: 'networkidle' });
      await page.evaluate(() => document.fonts.ready);
      assert.equal(await page.locator('h1').count(), 1);
      if (!isSchedule) assert.equal(await page.locator('.ce-schedules .ce-text-link').getAttribute('href'), route.replace('/pelatihan/', '/jadwal/'), 'Schedule directory stays on the current course');
      else assert.equal(await page.locator('.ce-guide-company[href="' + route.replace('/jadwal/', '/pelatihan/') + '"]').count(), 1, 'Schedule links to its course');
      for (const link of await page.locator('.ce-schedule-footer a').all()) {
        const url = new URL(await link.getAttribute('href'));
        assert.equal(url.hostname, 'wa.me', 'Every batch registers directly via WhatsApp');
        assert.ok(url.searchParams.get('text').includes('batch'), 'Registration includes the selected batch');
      }
      const heading = await page.locator('h1').textContent();
      const courseName = isSchedule ? heading.replace(/^Jadwal /, '') : heading;
      if (!isSchedule) assert.equal(await page.locator('.pd-cta-box h2').textContent(), 'Daftar ' + courseName);
      const inhouseMessage = new URL(await page.locator('.ce-inhouse-copy .ce-button').getAttribute('href')).searchParams.get('text');
      assert.ok(inhouseMessage.includes(courseName), 'In-house enquiry includes the course');
      const metrics = await page.evaluate(() => {
        const image = document.querySelector('.ce-hero-image img');
        return { overflow: document.documentElement.scrollWidth > innerWidth, imageLoaded: image.complete && image.naturalWidth > 0, imageRatio: image.clientWidth / image.clientHeight, imageFit: getComputedStyle(image).objectFit, textSize: parseFloat(getComputedStyle(document.querySelector('.pd-desc p, .pd-rich p')).fontSize) };
      });
      assert.equal(metrics.overflow, false, `${route}: overflow at ${width}`);
      assert.equal(metrics.imageLoaded, true, `${route}: hero loads`);
      assert.equal(metrics.imageFit, 'contain', `${route}: poster stays uncropped`);
      assert.ok(Math.abs(metrics.imageRatio - 1822 / 662) < .1);
      assert.ok(metrics.textSize >= 16);
      assert.equal(await page.locator('.home-wa-float').getAttribute('href'), await page.locator('.ce-registration > .ce-button').getAttribute('href'), 'Floating contact keeps the course context');
      for (const link of await page.locator('.ce-section-nav a').all()) assert.equal(await page.locator(await link.getAttribute('href')).count(), 1, `${route}: section anchor`);
      if (!isSchedule) {
        await page.locator('.ce-faq-list details:first-child summary').click();
        assert.equal(await page.locator('.ce-faq-list details:first-child').getAttribute('open'), '');
      }
      await page.locator('.ce-section-nav a[href="#jadwal-pelatihan"]').click();
      await page.waitForFunction(() => document.querySelector('.ce-section-nav a[href="#jadwal-pelatihan"]')?.getAttribute('aria-current') === 'location');
      assert.equal(await page.locator('.ce-section-nav a[href="#jadwal-pelatihan"]').getAttribute('aria-current'), 'location');
      assert.equal(errors.length, 0, errors.join('\n'));
      page.off('pageerror', onError);
      if ((route === routes[0] || route === scheduleRoutes[0]) && [390, 1440].includes(width)) {
        const prefix = isSchedule ? 'schedule' : 'course';
        await page.evaluate(() => { window.scrollTo({ top: 0, behavior: 'instant' }); document.activeElement?.blur(); });
        await page.waitForTimeout(100);
        await page.screenshot({ path: `${output}/${prefix}-${width}.png` });
        await page.evaluate(() => document.querySelector('#tentang-program').scrollIntoView({block: 'start', behavior: 'instant'}));
        await page.waitForTimeout(100);
        await page.screenshot({ path: `${output}/${prefix}-content-${width}.png` });
      }
      checks++;
    }
    await page.close();
  }
  const livePage = await browser.newPage();
  await livePage.route('**/*', serveBuild);
  await livePage.route(url => url.pathname === '/api/public-schedules.php', route => route.fulfill({status: 200, contentType: 'application/json', body: JSON.stringify({success: true, schedules: [{start_date: '2030-01-07', end_date: '2030-01-09', mode: 'online', price: 3650000, url: '/jadwal/123/'}]})}));
  await livePage.goto(origin + routes[0], {waitUntil: 'networkidle'});
  await livePage.waitForFunction(() => document.querySelector('.ce-schedule-card h3')?.textContent?.includes('2030'));
  assert.ok((await livePage.locator('[data-course-next-date]').textContent()).includes('2030'), 'Registration date follows the live schedule');
  const liveRegistration = new URL(await livePage.locator('.ce-schedule-footer a').getAttribute('href'));
  assert.equal(liveRegistration.hostname, 'wa.me', 'Live API batch IDs never replace WhatsApp registration');
  assert.ok(liveRegistration.searchParams.get('text').includes('2030'), 'Live registration includes the selected date');
  await livePage.close();
  const noJsPage = await browser.newPage({javaScriptEnabled: false});
  await noJsPage.route('**/*', serveBuild);
  await noJsPage.goto(origin + routes[0]);
  assert.ok(await noJsPage.locator('.ce-schedule-card').count() > 0, 'Schedules remain available without JavaScript');
  await noJsPage.locator('.ce-faq-list details:first-child summary').click();
  assert.equal(await noJsPage.locator('.ce-faq-list details:first-child').getAttribute('open'), '', 'FAQ works without JavaScript');
  assert.ok((await noJsPage.locator('.ce-schedule-footer a').first().getAttribute('href')).startsWith('https://wa.me/'), 'Direct registration works without JavaScript');
  await noJsPage.close();
  const reducedMotion = await browser.newPage({reducedMotion: 'reduce'});
  await reducedMotion.route('**/*', serveBuild);
  await reducedMotion.goto(origin + routes[0]);
  assert.equal(await reducedMotion.locator('.ce-hero-main').evaluate(node => getComputedStyle(node).animationName), 'none', 'Reduced motion disables entrance animation');
  await reducedMotion.close();
  console.log('Live schedule refresh and no-JavaScript fallbacks passed.');
  console.log(`Course experience passed ${checks} page/viewport checks, including native FAQ, section navigation, image loading and no horizontal overflow.`);
} finally { await browser.close(); }
