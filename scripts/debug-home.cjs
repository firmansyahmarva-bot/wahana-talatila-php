const http = require('http');
const fs = require('fs');
const path = require('path');
const { chromium } = require('playwright');

const distDir = path.join(__dirname, '..', 'dist');

function startServer(port = 4325) {
  return new Promise((resolve) => {
    const server = http.createServer((req, res) => {
      let p = req.url.split('?')[0];
      if (p.endsWith('/')) p += 'index.html';
      const fp = path.join(distDir, p);
      if (fs.existsSync(fp) && fs.statSync(fp).isFile()) {
        res.writeHead(200);
        fs.createReadStream(fp).pipe(res);
      } else {
        res.writeHead(404);
        res.end();
      }
    });
    server.listen(port, () => resolve(server));
  });
}

(async () => {
  const server = await startServer(4325);
  const browser = await chromium.launch({ channel: 'chrome', headless: true });
  const page = await browser.newPage();
  await page.setViewportSize({ width: 375, height: 800 });
  await page.goto('http://localhost:4325/');

  const targetSelectors = {
    faqItem: '.fqc-card, .fqc-item, details.sp-faq-card, .faq-item, .sp-faq-card, .faq-card, .pd-faq-item, .zh-faq-item, .st-faq-card',
    faqSummary: '.fqc-summary, summary.sp-faq-summary, .faq-question, .faq-q, .pd-faq-q, .sp-faq-summary, .faq-summary, .zh-faq-q, summary, button.faq-q, button.pd-faq-q, button.zh-faq-q'
  };

  const itemInfo = await page.evaluate((sel) => {
    const el = document.querySelector(sel);
    if (!el) return null;
    const s = window.getComputedStyle(el);
    return {
      tag: el.tagName,
      className: el.className,
      boxShadow: s.boxShadow,
      parent: el.parentElement ? el.parentElement.tagName + '.' + el.parentElement.className : null
    };
  }, targetSelectors.faqItem);

  const sumInfo = await page.evaluate((sel) => {
    const el = document.querySelector(sel);
    if (!el) return null;
    const s = window.getComputedStyle(el);
    return {
      tag: el.tagName,
      className: el.className,
      color: s.color,
      border: s.border,
      parent: el.parentElement ? el.parentElement.tagName + '.' + el.parentElement.className : null
    };
  }, targetSelectors.faqSummary);

  console.log('ITEM INFO:', itemInfo);
  console.log('SUMMARY INFO:', sumInfo);

  await browser.close();
  server.close();
})();
