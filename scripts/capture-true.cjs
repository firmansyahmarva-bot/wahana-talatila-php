const fs = require('fs');
const path = require('path');
const http = require('http');
const crypto = require('crypto');
const { chromium } = require('playwright');

const distDir = process.env.DIST_DIR || path.join(__dirname, '..', 'dist');
const outFile = process.argv[2] || path.join(__dirname, 'out', 'before-true.json');

const targetUrls = [
  // 11 sample pages
  '/',
  '/pelatihan/pelatihan-ahli-k3-umum-sertifikasi-kemnaker-ri/',
  '/pelatihan-k3-jakarta/',
  '/pelatihan/k3/',
  '/artikel/5-prinsip-dasar-smk3/',
  '/tools/apd-selector/',
  '/en/',
  '/zh/',
  '/ak3u-gratis/',
  '/ak3u-fresh-graduate/',
  '/perusahaan/',

  // Distinct CSS combination pages
  '/ahli-k3-umum/',
  '/akomodasi/',
  '/csms/',
  '/en/boiler-pressure-vessel-certification/',
  '/event-organizer/annual-employee-gathering/',
  '/event-organizer/',
  '/glosarium/5r-housekeeping/',
  '/higiene-industri/',
  '/in-house-training/balikpapan-ikn/',
  '/in-house-training/cilegon-karawang/',
  '/in-house-training/',
  '/in-house-training/morowali-weda-bay/',
  '/insiden/105-pekerja-nikel-tewas-akibat-kecelakaan-kerja-di-indonesia-2026/',
  '/insiden/',
  '/instruktur/',
  '/jadwal/106/',
  '/jadwal/',
  '/kebijakan-privasi/',
  '/keselamatan-kerja/',
  '/klien/',
  '/kota/',
  '/layanan-pemerintah/',
  '/lowongan/hse-officer-tambang-konstruksi/',
  '/pelatihan/ahli-higiene-industri-muda-balikpapan/',
  '/pelatihan/ahli-k3-konstruksi-sertifikasi-bnsp/',
  '/pelatihan/',
  '/perpanjangan-skp/ahli-k3-kebakaran/',
  '/perpanjangan-skp/',
  '/purnabakti/in-house-training-bumn/',
  '/purnabakti/',
  '/regulasi/',
  '/regulasi/kepdirjen-minerba-no-185-tahun-2019/',
  '/riksa-uji/bejana-tekan-tangki-timbun/',
  '/riksa-uji/',
  '/skkni/ahli-higiene-industri-muda-hima/',
  '/skkni/',
  '/tools/ibpr-generator/',
  '/tools/',
  '/tools/jsa-builder/',
  '/tools/kalkulator-biaya-k3/',
  '/tools/kalkulator-k3/',
  '/tools/kalkulator-kebisingan/',
  '/tools/laporan-insiden/',
  '/tools/regulasi-k3/',
  '/tools/risk-matrix/',
  '/tools/safety-talk/',
  '/tools/social-generator/',
  '/zh/ahli-k3-umum/'
];

// Deduplicate
const uniqueUrls = Array.from(new Set(targetUrls)).sort();

const viewports = [375, 1280];

const mimeTypes = {
  '.html': 'text/html',
  '.js': 'text/javascript',
  '.css': 'text/css',
  '.json': 'application/json',
  '.png': 'image/png',
  '.jpg': 'image/jpeg',
  '.webp': 'image/webp',
  '.svg': 'image/svg+xml',
  '.ico': 'image/x-icon',
  '.woff2': 'font/woff2'
};

function startServer(port = 4323) {
  return new Promise((resolve, reject) => {
    const server = http.createServer((req, res) => {
      let reqPath = decodeURI(req.url.split('?')[0]);
      if (reqPath.endsWith('/')) reqPath += 'index.html';
      let filePath = path.join(distDir, reqPath);
      if (!fs.existsSync(filePath) && fs.existsSync(filePath + '.html')) {
        filePath += '.html';
      }
      if (fs.existsSync(filePath) && fs.statSync(filePath).isFile()) {
        const ext = path.extname(filePath);
        res.writeHead(200, { 'Content-Type': mimeTypes[ext] || 'application/octet-stream' });
        fs.createReadStream(filePath).pipe(res);
      } else {
        res.writeHead(404);
        res.end('Not Found');
      }
    });

    server.listen(port, () => resolve(server));
    server.on('error', reject);
  });
}

const targetSelectors = {
  breadcrumbBar: '.bcr-bar, .breadcrumb-bar, .sp-breadcrumb-wrap, .bc-bar, nav[aria-label="Breadcrumb"], nav[aria-label="breadcrumb"]',
  breadcrumbInner: '.bcr-inner, .breadcrumb-bar > .container, .breadcrumb-bar .container, .sp-breadcrumb-inner, .bc-inner',
  breadcrumbList: '.bcr-list, .breadcrumb-list, .sp-breadcrumb-list, .bc-list, ol[class*="breadcrumb"], ul[class*="breadcrumb"]',
  breadcrumbLink: '.bcr-link, .breadcrumb-list a, .sp-breadcrumb-link, .bc-link, [class*="breadcrumb"] a',
  faqItem: '.fqc-card, .fqc-item, details.sp-faq-card, .faq-item, .sp-faq-card, .faq-card, .pd-faq-item, .zh-faq-item, .st-faq-card',
  faqSummary: '.fqc-summary, summary.sp-faq-summary, .faq-question, .faq-q, .pd-faq-q, .sp-faq-summary, .faq-summary, .zh-faq-q, summary, button.faq-q, button.pd-faq-q, button.zh-faq-q',
  faqIcon: '.fqc-icon, .faq-icon, .sp-faq-icon, .pd-faq-icon, summary svg, .faq-q .faq-icon, .zh-faq-icon, .faq-question .faq-icon',
  faqAnswer: '.fqc-content, .fqc-answer, .sp-faq-content, .faq-answer, .faq-a, .pd-faq-a, .faq-content, .zh-faq-a',
  sectionTitle: '.sct-title, .faq-section-title, .section-title, .sp-title-underlined, .st-title, h2.section-title'
};

const summarySelector = targetSelectors.faqSummary;

const cssProps = [
  'display',
  'padding',
  'margin',
  'fontSize',
  'fontWeight',
  'lineHeight',
  'color',
  'backgroundColor',
  'border',
  'borderRadius',
  'boxShadow',
  'maxWidth',
  'transform',
  'gridTemplateRows'
];

async function captureElementStyles(page) {
  return await page.evaluate(({ selectors, props }) => {
    const out = {};
    for (const [key, sel] of Object.entries(selectors)) {
      const el = document.querySelector(sel);
      if (!el) {
        out[key] = null;
        continue;
      }
      const s = window.getComputedStyle(el);
      const comp = {};
      for (const prop of props) {
        comp[prop] = s[prop];
      }
      if (!comp.border || comp.border === '') {
        comp.border = `${s.borderTopWidth} ${s.borderTopStyle} ${s.borderTopColor}`;
      }
      out[key] = comp;
    }
    return out;
  }, { selectors: targetSelectors, props: cssProps });
}

async function run() {
  console.log(`Starting static server for ${distDir} on port 4323...`);
  const server = await startServer(4323);

  console.log('Launching browser with Chrome...');
  const browser = await chromium.launch({
    executablePath: 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe',
    headless: true
  });

  const results = {};
  const visibleTextHashes = {};

  for (const width of viewports) {
    console.log(`\nCapturing viewport width: ${width}px...`);
    const context = await browser.newContext({
      viewport: { width, height: 800 },
      deviceScaleFactor: 1
    });
    const page = await context.newPage();

    for (const targetUrl of uniqueUrls) {
      const fullUrl = `http://localhost:4323${targetUrl}`;
      try {
        await page.goto(fullUrl, { waitUntil: 'load', timeout: 20000 });
        await page.waitForTimeout(400);

        // Capture visible text hash once per URL
        if (!visibleTextHashes[targetUrl]) {
          const visibleText = await page.evaluate(() => {
            const el = document.body;
            if (!el) return '';
            // Clone and strip scripts/styles
            return el.innerText.replace(/\s+/g, ' ').trim();
          });
          visibleTextHashes[targetUrl] = crypto.createHash('sha256').update(visibleText).digest('hex');
        }

        // State 1: closed
        const closedStyles = await captureElementStyles(page);
        results[`${targetUrl}@${width}@closed`] = closedStyles;

        // State 2: open (click on first summary)
        const summaryEl = await page.$(summarySelector);
        if (summaryEl) {
          try {
            await summaryEl.click({ timeout: 2000 });
            await page.waitForTimeout(400);
          } catch (clickErr) {
            // Click failed, ignore
          }
        }
        const openStyles = await captureElementStyles(page);
        results[`${targetUrl}@${width}@open`] = openStyles;

      } catch (err) {
        console.error(`Error on ${targetUrl} @ ${width}:`, err.message);
        results[`${targetUrl}@${width}@closed`] = { error: err.message };
        results[`${targetUrl}@${width}@open`] = { error: err.message };
      }
    }

    await context.close();
  }

  await browser.close();
  server.close();

  results['_meta'] = {
    capturedAt: new Date().toISOString(),
    distDir,
    totalUrls: uniqueUrls.length,
    visibleTextHashes
  };

  fs.mkdirSync(path.dirname(outFile), { recursive: true });
  fs.writeFileSync(outFile, JSON.stringify(results, null, 2), 'utf8');
  console.log(`\nSuccessfully captured true before-state styles for ${uniqueUrls.length} pages into ${outFile}`);
}

run().catch(err => {
  console.error('Fatal error in capture-true:', err);
  process.exit(1);
});
