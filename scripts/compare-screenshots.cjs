const fs = require('fs');
const path = require('path');
const http = require('http');
const { chromium } = require('playwright');

const rootDir = process.cwd();
const distDir = path.join(rootDir, 'dist');
const baselineDir = path.join(rootDir, 'baseline');
const currentDir = path.join(rootDir, 'screenshots-current');

if (!fs.existsSync(currentDir)) {
  fs.mkdirSync(currentDir, { recursive: true });
}

const pages = [
  { name: '01-home', url: '/' },
  { name: '02-pelatihan-list', url: '/pelatihan/' },
  { name: '03-pelatihan-detail', url: '/pelatihan/pelatihan-ahli-k3-umum-sertifikasi-kemnaker-ri/' },
  { name: '04-city-page', url: '/pelatihan-k3-jakarta/' },
  { name: '05-hub', url: '/k3-konstruksi/' },
  { name: '06-tool', url: '/tools/apd-selector/' },
  { name: '07-jadwal', url: '/jadwal/' },
  { name: '08-artikel', url: '/artikel/' },
  { name: '09-perusahaan', url: '/perusahaan/' },
  { name: '10-en-index', url: '/en/' },
  { name: '11-en-article', url: '/en/csms-contractor-safety-management-system/' },
  { name: '12-zh-index', url: '/zh/' },
  { name: '13-404', url: '/404.html' },
  { name: '14-csms', url: '/csms/' },
  { name: '15-galeri', url: '/galeri/' }
];

const viewports = [
  { width: 375, height: 812, name: '375' },
  { width: 768, height: 1024, name: '768' },
  { width: 1280, height: 800, name: '1280' }
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
        const notFound = path.join(distDir, '404.html');
        if (fs.existsSync(notFound)) {
          res.writeHead(404, { 'Content-Type': 'text/html' });
          fs.createReadStream(notFound).pipe(res);
        } else {
          res.writeHead(404);
          res.end('Not Found');
        }
      }
    });
    server.listen(port, () => resolve(server));
    server.on('error', reject);
  });
}

async function run() {
  const server = await startServer(4323);
  const browser = await chromium.launch({
    executablePath: 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe',
    headless: true
  });

  let diffList = [];

  for (const vp of viewports) {
    const context = await browser.newContext({
      viewport: { width: vp.width, height: vp.height },
      deviceScaleFactor: 1
    });
    const page = await context.newPage();

    for (const p of pages) {
      const fileName = `${p.name}-${vp.name}.png`;
      const baselineFile = path.join(baselineDir, fileName);
      const currentFile = path.join(currentDir, fileName);

      try {
        await page.goto(`http://localhost:4323${p.url}`, { waitUntil: 'domcontentloaded', timeout: 15000 });
        await page.waitForTimeout(300);
        await page.screenshot({ path: currentFile, fullPage: true });

        if (fs.existsSync(baselineFile)) {
          const bBuf = fs.readFileSync(baselineFile);
          const cBuf = fs.readFileSync(currentFile);
          const sizeDiff = Math.abs(bBuf.length - cBuf.length);
          // Flag if buffer differs significantly (>1% file size change)
          const pct = ((sizeDiff / bBuf.length) * 100).toFixed(2);
          if (bBuf.compare(cBuf) !== 0) {
            diffList.push({ name: fileName, sizeDiff, pct, baselineSize: bBuf.length, currentSize: cBuf.length });
          }
        } else {
          diffList.push({ name: fileName, status: 'NO_BASELINE' });
        }
      } catch (e) {
        console.error(`Error capturing ${fileName}:`, e.message);
      }
    }
    await context.close();
  }

  await browser.close();
  server.close();

  console.log('\n=== SCREENSHOT REGRESSION CHECK ===');
  if (diffList.length === 0) {
    console.log('✅ 100% Identical: No visual differences detected against baseline.');
  } else {
    console.log(`⚠️  ${diffList.length} screenshots differ from baseline:`);
    diffList.forEach(d => {
      console.log(`  - ${d.name}: byte diff ${d.sizeDiff} bytes (${d.pct}%)`);
    });
  }
}

run().catch(e => {
  console.error(e);
  process.exit(1);
});
