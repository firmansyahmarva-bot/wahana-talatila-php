const { chromium } = require('playwright');

(async () => {
  const browser = await chromium.launch({ channel: 'chrome', headless: true });
  const page = await browser.newPage();
  await page.goto('http://localhost:4323/');
  const sel = '.fqc-card, .fqc-item, details.sp-faq-card, .faq-item, .sp-faq-card, .faq-card, .pd-faq-item, .zh-faq-item, .st-faq-card';
  const el = await page.$(sel);
  const s = await el.evaluate(e => ({
    tag: e.tagName,
    cls: e.className,
    shadow: window.getComputedStyle(e).boxShadow,
    parent: e.parentElement.className
  }));
  console.log('Homepage target element:', s);
  await browser.close();
})();
