const fs = require('fs');
const path = require('path');
const http = require('http');
const { chromium } = require('playwright');

const rootDir = process.cwd();
const distDir = path.join(rootDir, 'dist');
const baselineDir = path.join(rootDir, 'baseline');

if (!fs.existsSync(baselineDir)) {
  fs.mkdirSync(baselineDir, { recursive: true });
}

// 15 representative pages requested
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

// Simple static server for dist
function startServer(port = 4322) {
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
        const notFoundPath = path.join(distDir, '404.html');
        if (fs.existsSync(notFoundPath)) {
          res.writeHead(404, { 'Content-Type': 'text/html' });
          fs.createReadStream(notFoundPath).pipe(res);
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
  console.log('Starting static server on port 4322...');
  const server = await startServer(4322);

  console.log('Launching browser with system Chrome...');
  const browser = await chromium.launch({
    executablePath: 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe',
    headless: true
  });

  const total = pages.length * viewports.length;
  let count = 0;

  for (const vp of viewports) {
    const context = await browser.newContext({
      viewport: { width: vp.width, height: vp.height },
      deviceScaleFactor: 1
    });
    const page = await context.newPage();

    for (const p of pages) {
      count++;
      const targetUrl = `http://localhost:4322${p.url}`;
      process.stdout.write(`[${count}/${total}] ${p.name} @ ${vp.width}px ... `);

      try {
        await page.goto(targetUrl, { waitUntil: 'domcontentloaded', timeout: 15000 });
        // small delay for web fonts and layout stability
        await page.waitForTimeout(300);

        const outPath = path.join(baselineDir, `${p.name}-${vp.name}.png`);
        await page.screenshot({ path: outPath, fullPage: true });
        console.log('OK');
      } catch (err) {
        console.log(`ERROR: ${err.message}`);
      }
    }

    await context.close();
  }

  await browser.close();
  server.close();
  console.log(`\n✅ Completed all ${total} baseline screenshots in: ${baselineDir}`);
}

run().catch(err => {
  console.error('Fatal error during baseline capture:', err);
  process.exit(1);
});
