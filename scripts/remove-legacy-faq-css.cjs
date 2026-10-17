const fs = require('fs');
const path = require('path');

const toolFiles = [
  'tools-apd-selector.css',
  'tools-ibpr-generator.css',
  'tools-jsa-builder.css',
  'tools-kalkulator-biaya-k3.css',
  'tools-kalkulator-k3.css',
  'tools-kalkulator-kebisingan.css',
  'tools-laporan-insiden.css',
  'tools-regulasi-k3.css',
  'tools-risk-matrix.css',
  'tools-social-generator.css',
  'tools.css'
];

for (const tf of toolFiles) {
  const p = path.join(__dirname, '..', 'public', 'assets', 'css', 'page', tf);
  let content = fs.readFileSync(p, 'utf8');
  // Match /* FAQ */ or .faq-item to end of file or block
  const idx = content.search(/\/\*\s*FAQ\s*\*\/|\.faq-item\s*\{/i);
  if (idx !== -1) {
    content = content.substring(0, idx).trimEnd() + '\n';
    fs.writeFileSync(p, content, 'utf8');
    console.log(`Cleaned FAQ CSS from ${tf}`);
  }
}

// skkni-detail.css
const skkniPath = path.join(__dirname, '..', 'public', 'assets', 'css', 'page', 'skkni-detail.css');
let skkniContent = fs.readFileSync(skkniPath, 'utf8');
skkniContent = skkniContent.replace(/\/\*\s*FAQ Accordion UI\s*\*\/[\s\S]*?(\/\*\s*Sidebar Styling\s*\*\/)/i, '$1');
fs.writeFileSync(skkniPath, skkniContent, 'utf8');
console.log('Cleaned skkni-detail.css');

// sector.css
const sectorPath = path.join(__dirname, '..', 'public', 'assets', 'css', 'page', 'sector.css');
let sectorContent = fs.readFileSync(sectorPath, 'utf8');
sectorContent = sectorContent.replace(/\.faq-list\{[\s\S]*?\.faq-a\.open\{max-height:300px;padding:14px 20px 18px\}/i, '');
fs.writeFileSync(sectorPath, sectorContent, 'utf8');
console.log('Cleaned sector.css');

// ak3u-fresh-graduate.css
const ak3uFgPath = path.join(__dirname, '..', 'public', 'assets', 'css', 'page', 'ak3u-fresh-graduate.css');
let ak3uFgContent = fs.readFileSync(ak3uFgPath, 'utf8');
ak3uFgContent = ak3uFgContent.replace(/\.faq-q\{[\s\S]*?\.faq-a\.open\{max-height:300px;padding:14px 20px 18px\}/i, '');
fs.writeFileSync(ak3uFgPath, ak3uFgContent, 'utf8');
console.log('Cleaned ak3u-fresh-graduate.css');

// ak3u-gratis.css
const ak3uGrPath = path.join(__dirname, '..', 'public', 'assets', 'css', 'page', 'ak3u-gratis.css');
let ak3uGrContent = fs.readFileSync(ak3uGrPath, 'utf8');
ak3uGrContent = ak3uGrContent.replace(/\.faq-q\{[\s\S]*?\.faq-a\.open\{max-height:300px;padding:14px 20px 18px\}/i, '');
fs.writeFileSync(ak3uGrPath, ak3uGrContent, 'utf8');
console.log('Cleaned ak3u-gratis.css');

// keselamatan-kerja.css
const kkPath = path.join(__dirname, '..', 'public', 'assets', 'css', 'page', 'keselamatan-kerja.css');
let kkContent = fs.readFileSync(kkPath, 'utf8');
kkContent = kkContent.replace(/\.faq-a\{[\s\S]*?line-height:1\.75\}/i, '');
fs.writeFileSync(kkPath, kkContent, 'utf8');
console.log('Cleaned keselamatan-kerja.css');
