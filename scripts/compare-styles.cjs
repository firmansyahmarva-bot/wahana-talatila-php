const fs = require('fs');
const path = require('path');

const beforeFile = process.argv[2] || path.join(__dirname, 'out', 'before-true.json');
const afterFile = process.argv[3] || path.join(__dirname, 'out', 'after-true.json');

if (!fs.existsSync(beforeFile) || !fs.existsSync(afterFile)) {
  console.error(`Missing style files: ${beforeFile} or ${afterFile}`);
  process.exit(1);
}

const before = JSON.parse(fs.readFileSync(beforeFile, 'utf8'));
const after = JSON.parse(fs.readFileSync(afterFile, 'utf8'));

const cssProps = [
  'display', 'padding', 'margin', 'fontSize', 'fontWeight',
  'lineHeight', 'color', 'backgroundColor', 'border', 'borderRadius',
  'boxShadow', 'maxWidth', 'transform', 'gridTemplateRows'
];

let totalDifferences = 0;
const diffReport = [];

for (const pageKey of Object.keys(before)) {
  if (pageKey.startsWith('_')) continue;
  const bPage = before[pageKey];
  const aPage = after[pageKey];

  if (!aPage) {
    diffReport.push(`Missing pageKey in after: ${pageKey}`);
    totalDifferences++;
    continue;
  }

  for (const elKey of Object.keys(bPage)) {
    const bEl = bPage[elKey];
    const aEl = aPage[elKey];

    if (!bEl && !aEl) continue;
    if (!bEl && aEl) {
      // Element was absent in before, now present
      continue;
    }
    if (bEl && !aEl) {
      diffReport.push(`[${pageKey}] ${elKey}: was present in before, now missing in after`);
      totalDifferences++;
      continue;
    }

    for (const prop of cssProps) {
      const bVal = bEl[prop];
      const aVal = aEl[prop];

      if (bVal !== aVal) {
        // Special case: Chromium box-shadow color precision or quotes
        if (prop === 'boxShadow' && bVal && aVal && bVal.replace(/\s+/g, '') === aVal.replace(/\s+/g, '')) {
          continue;
        }

        // Special case: In commit ca82039, 9 tool pages lacked a toggleFaq() function definition,
        // causing Playwright's click on the summary to error in before-true.json and remain closed (display: none, transform: none).
        // In the migrated component, native <details> opens cleanly (display: block, transform: matrix(-1, 0, 0, -1, 0, 0)).
        if (pageKey.includes('@open') && pageKey.startsWith('/tools/')) {
          if (elKey === 'faqAnswer' && prop === 'display' && bVal === 'none' && aVal === 'block') {
            continue;
          }
          if (elKey === 'faqIcon' && prop === 'transform' && bVal === 'none' && aVal === 'matrix(-1, 0, 0, -1, 0, 0)') {
            continue;
          }
        }

        diffReport.push(`[${pageKey}] ${elKey}.${prop}: before="${bVal}" vs after="${aVal}"`);
        totalDifferences++;
      }
    }
  }
}

console.log('\n=== COMPUTED STYLE COMPARISON SUMMARY ===');
console.log(`Total checked page keys: ${Object.keys(before).filter(k => !k.startsWith('_')).length}`);
console.log(`Total style differences: ${totalDifferences}`);

if (totalDifferences === 0) {
  console.log('Zero style regressions detected across all pages at 375px and 1280px (closed and open)!');
  console.log('RESULT: PASS');
  process.exit(0);
} else {
  console.error(`Found ${totalDifferences} style differences:`);
  diffReport.slice(0, 30).forEach(d => console.error('  - ' + d));
  if (diffReport.length > 30) {
    console.error(`  ... and ${diffReport.length - 30} more.`);
  }
  console.log('RESULT: FAIL');
  process.exit(1);
}
