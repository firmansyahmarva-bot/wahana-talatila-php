const fs = require('fs');
const path = require('path');
const http = require('http');
const { chromium } = require('playwright');

const distDir = path.join(__dirname, '..', 'dist');

const testPages = [
  '/',
  '/pelatihan/',
  '/tools/apd-selector/',
  '/ak3u-gratis/',
  '/keselamatan-kerja/',
  '/skkni/ahli-higiene-industri-muda-hima/',
  '/in-house-training/cilegon-karawang/'
];

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

function startServer(port = 4324) {
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

const summarySelector = '.fqc-summary, summary.sp-faq-summary, .faq-question, .faq-q, .pd-faq-q, .sp-faq-summary, .faq-summary, .zh-faq-q, summary, button.faq-q';

async function run() {
  console.log('Starting static server on port 4324...');
  const server = await startServer(4324);

  console.log('Launching browser with Chrome...');
  const browser = await chromium.launch({
    executablePath: 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe',
    headless: true
  });

  const page = await browser.newPage();
  let totalErrors = 0;
  let clickFailures = 0;

  for (const urlPath of testPages) {
    const consoleErrors = [];
    page.on('console', msg => {
      if (msg.type() === 'error') consoleErrors.push(msg.text());
    });
    page.on('pageerror', err => {
      consoleErrors.push(err.message);
    });

    const fullUrl = `http://localhost:4324${urlPath}`;
    console.log(`\nTesting click on ${urlPath}...`);
    await page.goto(fullUrl, { waitUntil: 'domcontentloaded', timeout: 20000 });
    await page.waitForTimeout(400);

    const summaryEl = await page.$(summarySelector);
    if (!summaryEl) {
      console.warn(`No summary element found on ${urlPath}`);
      continue;
    }

    // 1st click -> open
    await summaryEl.click();
    await page.waitForTimeout(300);

    const isOpenAfterFirst = await page.evaluate(sel => {
      const el = document.querySelector(sel);
      if (!el) return false;
      const details = el.closest('details');
      if (details) return details.open;
      const item = el.closest('.faq-item, .fqc-item');
      if (item) return item.classList.contains('open') || item.classList.contains('active');
      return true;
    }, summarySelector);

    if (!isOpenAfterFirst) {
      console.error(`FAIL: ${urlPath} did not open on first click`);
      clickFailures++;
    } else {
      console.log(`  ✓ Opened on first click`);
    }

    // 2nd click -> close
    await summaryEl.click();
    await page.waitForTimeout(300);

    const isOpenAfterSecond = await page.evaluate(sel => {
      const el = document.querySelector(sel);
      if (!el) return false;
      const details = el.closest('details');
      if (details) return details.open;
      const item = el.closest('.faq-item, .fqc-item');
      if (item) return item.classList.contains('open') || item.classList.contains('active');
      return false;
    }, summarySelector);

    if (isOpenAfterSecond) {
      console.error(`FAIL: ${urlPath} did not close on second click`);
      clickFailures++;
    } else {
      console.log(`  ✓ Closed on second click`);
    }

    if (consoleErrors.length > 0) {
      console.error(`  Console errors on ${urlPath}:`, consoleErrors);
      totalErrors += consoleErrors.length;
    } else {
      console.log(`  ✓ No console errors`);
    }
  }

  await browser.close();
  server.close();

  console.log('\n=== CLICK TEST SUMMARY ===');
  console.log(`Click failures: ${clickFailures}`);
  console.log(`Console errors: ${totalErrors}`);

  if (clickFailures === 0 && totalErrors === 0) {
    console.log('RESULT: PASS');
    process.exit(0);
  } else {
    console.log('RESULT: FAIL');
    process.exit(1);
  }
}

run().catch(err => {
  console.error('Fatal click test error:', err);
  process.exit(1);
});
