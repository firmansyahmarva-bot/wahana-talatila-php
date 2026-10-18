const fs = require('fs');
const path = require('path');
const { execSync } = require('child_process');
const { chromium } = require('playwright');

const outFile = path.join(__dirname, 'out', 'after-seo-metrics.json');

const baselineUrls = [
  '/',
  '/pelatihan/',
  '/pelatihan/pelatihan-ahli-k3-umum-sertifikasi-kemnaker-ri/',
  '/jadwal/',
  '/jadwal/106/',
  '/keselamatan-kerja/',
  '/skkni/',
  '/skkni/ahli-k3-umum/',
  '/in-house-training/cilegon-karawang/',
  '/tools/',
  '/tools/apd-selector/',
  '/artikel/',
  '/artikel/k3/',
  '/en/',
  '/zh/'
];

const fontCheckUrls = ['/', '/pelatihan/', '/en/', '/zh/'];

async function main() {
  console.log('Measuring Step 8e Performance & Page Weight for After-State...');

  const browser = await chromium.launch({ channel: 'chrome', headless: true });
  const baselineMetrics = {};
  const fontsCheck = {};

  for (const url of baselineUrls) {
    const page = await browser.newPage({
      viewport: { width: 375, height: 667 },
      userAgent: 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.5 Mobile/15E148 Safari/604.1'
    });

    const transferred = { html: 0, css: 0, js: 0, img: 0, font: 0, other: 0, total: 0 };
    const fontRequests = [];

    page.on('response', async (res) => {
      const resUrl = res.url();
      const rType = res.request().resourceType();
      let size = 0;
      try {
        const buf = await res.body();
        size = buf.length;
      } catch (e) {
        const len = res.headers()['content-length'];
        if (len) size = parseInt(len, 10) || 0;
      }

      transferred.total += size;
      if (rType === 'document') transferred.html += size;
      else if (rType === 'stylesheet') transferred.css += size;
      else if (rType === 'script') transferred.js += size;
      else if (rType === 'image') transferred.img += size;
      else if (rType === 'font' || /\.(woff2?|ttf|otf|eot)/i.test(resUrl)) {
        transferred.font += size;
        fontRequests.push({ url: resUrl, size, status: res.status() });
      } else {
        transferred.other += size;
      }
    });

    await page.goto(`http://127.0.0.1:4331${url}`, { waitUntil: 'networkidle', timeout: 30000 });

    let docFonts = [];
    if (fontCheckUrls.includes(url)) {
      docFonts = await page.evaluate(() => {
        return Array.from(document.fonts).map(f => ({
          family: f.family,
          weight: f.weight,
          style: f.style,
          status: f.status
        }));
      });
      fontsCheck[url] = {
        networkFontRequests: fontRequests,
        documentFonts: docFonts
      };
    }

    baselineMetrics[url] = {
      transferredBytes: transferred
    };

    console.log(`  ✓ Transferred bytes for ${url} (Total: ${(transferred.total / 1024).toFixed(1)} KB, Fonts: ${(transferred.font / 1024).toFixed(1)} KB)`);
    await page.close();
  }
  await browser.close();

  // Lighthouse mobile for 15 baseline pages
  console.log('\nRunning Lighthouse mobile for 15 baseline pages...');
  const tempLhPath = path.join(__dirname, 'out', 'temp-lh-after.json');
  fs.mkdirSync(path.dirname(tempLhPath), { recursive: true });

  for (const url of baselineUrls) {
    const fullTarget = `http://127.0.0.1:4331${url}`;
    const cmd = `npx lighthouse ${fullTarget} --output=json --output-path="${tempLhPath}" --only-categories=performance --chrome-flags="--headless=new --no-sandbox --disable-gpu" --quiet`;

    const t0 = Date.now();
    try {
      execSync(cmd, { stdio: 'ignore' });
      if (fs.existsSync(tempLhPath)) {
        const lhData = JSON.parse(fs.readFileSync(tempLhPath, 'utf8'));
        const perf = lhData.categories?.performance?.score !== undefined ? Math.round(lhData.categories.performance.score * 100) : 0;
        const lcp = lhData.audits['largest-contentful-paint']?.displayValue || 'N/A';
        const cls = lhData.audits['cumulative-layout-shift']?.displayValue || 'N/A';
        const tbt = lhData.audits['total-blocking-time']?.displayValue || 'N/A';

        baselineMetrics[url].lighthouse = {
          score: perf,
          lcp,
          cls,
          tbt
        };
        console.log(`  ✓ ${url} (${Date.now() - t0}ms) => Score: ${perf}, LCP: ${lcp}, CLS: ${cls}, TBT: ${tbt}`);
        fs.unlinkSync(tempLhPath);
      } else {
        console.error(`  ✗ Output file missing for ${url}`);
        baselineMetrics[url].lighthouse = { error: 'Output missing' };
      }
    } catch (err) {
      console.error(`  ✗ Error running Lighthouse for ${url}:`, err.message);
      baselineMetrics[url].lighthouse = { error: err.message };
    }
  }

  const finalOutput = {
    baselineMetrics,
    fontsCheck
  };

  fs.writeFileSync(outFile, JSON.stringify(finalOutput, null, 2), 'utf8');
  console.log(`\nSuccessfully saved after-state metrics to ${outFile}`);
}

main().catch(err => {
  console.error('Fatal error in measure-after-seo:', err);
  process.exit(1);
});
