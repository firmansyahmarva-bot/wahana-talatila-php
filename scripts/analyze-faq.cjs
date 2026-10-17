const fs = require('fs');
const data = JSON.parse(fs.readFileSync('scripts/out/before-true.json', 'utf8'));

const faqPages = new Map();

for (const key of Object.keys(data)) {
  if (key.startsWith('_')) continue;
  const parts = key.split('@');
  const url = parts[0];
  const width = parts[1];
  const state = parts[2];
  const d = data[key];
  if (!d.faqItem && !d.faqSummary) continue;

  if (!faqPages.has(url)) faqPages.set(url, {});
  faqPages.get(url)[width + '@' + state] = {
    faqItem: d.faqItem,
    faqSummary: d.faqSummary,
    faqIcon: d.faqIcon,
    faqAnswer: d.faqAnswer
  };
}

console.log('Total pages with FAQ in before-true:', faqPages.size);
for (const [url, states] of faqPages.entries()) {
  const c1280 = states['1280@closed'] || {};
  const o1280 = states['1280@open'] || {};
  console.log('--- URL:', url);
  console.log('  Item closed border:', c1280.faqItem ? c1280.faqItem.border : null, 'radius:', c1280.faqItem ? c1280.faqItem.borderRadius : null, 'margin:', c1280.faqItem ? c1280.faqItem.margin : null);
  console.log('  Summary bg:', c1280.faqSummary ? c1280.faqSummary.backgroundColor : null, 'pad:', c1280.faqSummary ? c1280.faqSummary.padding : null, 'color:', c1280.faqSummary ? c1280.faqSummary.color : null);
  console.log('  Answer pad:', c1280.faqAnswer ? c1280.faqAnswer.padding : null, 'color:', c1280.faqAnswer ? c1280.faqAnswer.color : null);
  console.log('  Icon transform closed:', c1280.faqIcon ? c1280.faqIcon.transform : null, 'open:', o1280.faqIcon ? o1280.faqIcon.transform : null);
}
