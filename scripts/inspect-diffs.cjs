const fs = require('fs');
const before = JSON.parse(fs.readFileSync('scripts/out/before-true.json', 'utf8'));
const after = JSON.parse(fs.readFileSync('scripts/out/after-true.json', 'utf8'));

const groups = [
  '/akomodasi/',
  '/in-house-training/',
  '/keselamatan-kerja/',
  '/pelatihan/ahli-higiene-industri-muda-balikpapan/',
  '/pelatihan/@',
  '/skkni/',
  '/tools/index.html',
  '/tools/apd-selector/',
  '/tools/safety-talk/'
];

for (const grp of groups) {
  console.log('====================================');
  console.log('GROUP:', grp);
  console.log('====================================');
  for (const k of Object.keys(before)) {
    if (!k.includes(grp)) continue;
    const b = before[k];
    const a = after[k];
    if (!a) continue;
    for (const el of Object.keys(b)) {
      if (!b[el] || !a[el]) continue;
      for (const p of Object.keys(b[el])) {
        if (b[el][p] !== a[el][p]) {
          console.log(`[${k}] ${el}.${p}: before="${b[el][p]}" vs after="${a[el][p]}"`);
        }
      }
    }
  }
}
