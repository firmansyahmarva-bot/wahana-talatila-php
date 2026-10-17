const fs = require('fs');
const path = require('path');

const distDir = 'd:/wahana-transform/temp-ca82039/dist';

const pages = [
  'pelatihan/index.html',
  'keselamatan-kerja/index.html',
  'skkni/ahli-higiene-industri-muda-hima/index.html',
  'in-house-training/cilegon-karawang/index.html',
  'tools/apd-selector/index.html',
  'tools/ibpr-generator/index.html',
  'tools/jsa-builder/index.html',
  'tools/kalkulator-biaya-k3/index.html',
  'tools/kalkulator-k3/index.html',
  'tools/kalkulator-kebisingan/index.html',
  'tools/laporan-insiden/index.html',
  'tools/regulasi-k3/index.html',
  'tools/risk-matrix/index.html',
  'tools/safety-talk/index.html',
  'tools/social-generator/index.html'
];

for (const p of pages) {
  const filePath = path.join(distDir, p);
  if (!fs.existsSync(filePath)) {
    console.log('Missing:', p);
    continue;
  }
  const content = fs.readFileSync(filePath, 'utf8');
  // Check icons or text in FAQ
  const faqM = content.match(/<[^>]+(faq|FAQ)[^>]*>[\s\S]*?<\/section>|<div class="faq-box">[\s\S]*?<\/div>\s*<\/div>/i);
  console.log('===', p);
  if (faqM) {
    const textOnly = faqM[0]
      .replace(/<script[^>]*>[\s\S]*?<\/script>/gi, '')
      .replace(/<style[^>]*>[\s\S]*?<\/style>/gi, '')
      .replace(/<svg[^>]*>[\s\S]*?<\/svg>/gi, '')
      .replace(/<[^>]+>/g, ' ')
      .replace(/\s+/g, ' ')
      .trim();
    console.log(textOnly.slice(0, 150) + '...');
  }
}
