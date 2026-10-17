const fs = require('fs');
const path = require('path');
const http = require('http');
const { chromium } = require('playwright');

const rootDir = path.join(__dirname, '..');
const distDir = path.join(rootDir, 'dist');
const outFile = process.argv[2] || path.join(__dirname, 'out', 'before-styles.json');

const samplePages = [
  { name: 'home', url: '/' },
  { name: 'course', url: '/pelatihan/pelatihan-ahli-k3-umum-sertifikasi-kemnaker-ri/' },
  { name: 'city', url: '/pelatihan-k3-jakarta/' },
  { name: 'category', url: '/pelatihan/k3/' },
  { name: 'article', url: '/artikel/5-prinsip-dasar-smk3/' },
  { name: 'tool', url: '/tools/apd-selector/' },
  { name: 'en', url: '/en/' },
  { name: 'zh', url: '/zh/' },
  { name: 'ak3u-gratis', url: '/ak3u-gratis/' },
  { name: 'ak3u-fresh-graduate', url: '/ak3u-fresh-graduate/' },
  { name: 'perusahaan', url: '/perusahaan/' }
];

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
  breadcrumbBar: '.breadcrumb-bar, .sp-breadcrumb-wrap, .bc-bar',
  breadcrumbInner: '.breadcrumb-bar .container, .sp-breadcrumb-inner, .bc-inner',
  breadcrumbList: '.breadcrumb-list, .sp-breadcrumb-list, .bc-list',
  breadcrumbLink: '.breadcrumb-list a, .sp-breadcrumb-link, .bc-link',
  faqItem: '.faq-item, .sp-faq-card, .faq-card',
  faqSummary: '.faq-question, .faq-q, .sp-faq-summary, .faq-summary',
  faqAnswer: '.faq-answer, .faq-a, .sp-faq-content, .faq-content',
  sectionTitle: '.section-title, .sp-title-underlined, .st-title'
};

async function run() {
  console.log('Starting static server on port 4323...');
  const server = await startServer(4323);

  console.log('Launching browser with system Chrome...');
  const browser = await chromium.launch({
    executablePath: 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe',
    headless: true
  });

  const results = {};

  for (const width of viewports) {
    const context = await browser.newContext({
      viewport: { width, height: 800 },
      deviceScaleFactor: 1
    });
    const page = await context.newPage();

    for (const p of samplePages) {
      const pageKey = `${p.name}@${width}`;
      results[pageKey] = {};
      const targetUrl = `http://localhost:4323${p.url}`;

      try {
        await page.goto(targetUrl, { waitUntil: 'domcontentloaded', timeout: 15000 });
        await page.waitForTimeout(300);

        const styles = await page.evaluate((selectors) => {
          const out = {};
          const cssProps = [
            'display', 'padding', 'margin', 'fontSize', 'fontWeight',
            'lineHeight', 'color', 'backgroundColor', 'border', 'borderRadius', 'maxWidth'
          ];

          for (const [key, sel] of Object.entries(selectors)) {
            const el = document.querySelector(sel);
            if (!el) {
              out[key] = null;
              continue;
            }
            const s = window.getComputedStyle(el);
            const comp = {};
            for (const prop of cssProps) {
              comp[prop] = s[prop];
            }
            out[key] = comp;
          }
          return out;
        }, targetSelectors);

        results[pageKey] = styles;
      } catch (err) {
        console.error(`Error capturing styles for ${targetUrl} @ ${width}px:`, err.message);
        results[pageKey] = { error: err.message };
      }
    }

    await context.close();
  }

  await browser.close();
  server.close();

  fs.mkdirSync(path.dirname(outFile), { recursive: true });
  fs.writeFileSync(outFile, JSON.stringify(results, null, 2), 'utf8');
  console.log(`Computed styles saved to ${outFile}`);
}

run().catch(err => {
  console.error('Fatal error capturing computed styles:', err);
  process.exit(1);
});
