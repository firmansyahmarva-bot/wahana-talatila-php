const fs = require('fs');
const glob = [
  'apd-selector', 'ibpr-generator', 'jsa-builder', 'kalkulator-biaya-k3',
  'kalkulator-k3', 'kalkulator-kebisingan', 'laporan-insiden', 'regulasi-k3',
  'risk-matrix', 'safety-talk', 'social-generator'
];
for (const g of glob) {
  const p = 'src/pages/tools/' + g + '.astro';
  const c = fs.readFileSync(p, 'utf8');
  const hasToggle = c.includes('function toggleFaq');
  const m = c.match(/<div class=["'](faq-box|st-faq-grid)["']>([\s\S]*?)<\/div>/i);
  console.log(g, 'hasToggle:', hasToggle, 'box length:', m ? m[0].length : 0);
}
