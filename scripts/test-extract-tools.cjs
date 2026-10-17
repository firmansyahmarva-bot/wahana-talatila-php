const fs = require('fs');
const path = require('path');

const tools = [
  'apd-selector',
  'ibpr-generator',
  'jsa-builder',
  'kalkulator-biaya-k3',
  'kalkulator-k3',
  'kalkulator-kebisingan',
  'laporan-insiden',
  'regulasi-k3',
  'risk-matrix',
  'safety-talk',
  'social-generator'
];

for (const t of tools) {
  const filePath = path.join(__dirname, '..', 'src', 'pages', 'tools', `${t}.astro`);
  let content = fs.readFileSync(filePath, 'utf8');

  let items = [];

  if (t === 'safety-talk') {
    const cardRegex = /<div class="st-faq-card">[\s\S]*?<h3>([\s\S]*?)<\/h3>[\s\S]*?<p>([\s\S]*?)<\/p>[\s\S]*?<\/div>/gi;
    let match;
    while ((match = cardRegex.exec(content)) !== null) {
      items.push({
        q: match[1].trim(),
        a: match[2].trim()
      });
    }
  } else {
    const itemRegex = /<div class="faq-item">[\s\S]*?<button[^>]*>[\s\S]*?<span>([\s\S]*?)<\/span>[\s\S]*?<\/button>[\s\S]*?<div class="faq-a">([\s\S]*?)<\/div>[\s\S]*?<\/div>/gi;
    let match;
    while ((match = itemRegex.exec(content)) !== null) {
      items.push({
        q: match[1].trim(),
        a: match[2].trim()
      });
    }
  }

  console.log(`Tool: ${t}, found ${items.length} FAQ items`);
  if (items.length === 0) {
    console.error(`ERROR: No items found for ${t}`);
  }
}
