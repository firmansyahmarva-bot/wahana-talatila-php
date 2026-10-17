const fs = require('fs');
const path = require('path');

const beforeFile = process.argv[2] || path.join(__dirname, 'out', 'before-all.json');
const afterFile = process.argv[3] || path.join(__dirname, 'out', 'after-all.json');

if (!fs.existsSync(beforeFile) || !fs.existsSync(afterFile)) {
  console.error(`Missing snapshots: ${beforeFile} or ${afterFile}`);
  process.exit(1);
}

const before = JSON.parse(fs.readFileSync(beforeFile, 'utf8'));
const after = JSON.parse(fs.readFileSync(afterFile, 'utf8'));

const beforeUrls = Object.keys(before).sort();
const afterUrls = Object.keys(after).sort();

console.log(`Before page count: ${beforeUrls.length}`);
console.log(`After page count:  ${afterUrls.length}`);

const added = afterUrls.filter(u => !before[u]);
const removed = beforeUrls.filter(u => !after[u]);

if (added.length > 0) {
  console.error(`FAIL: ${added.length} URLs added:`, added.slice(0, 5));
}
if (removed.length > 0) {
  console.error(`FAIL: ${removed.length} URLs removed:`, removed.slice(0, 5));
}

let titleDiffs = 0;
let descDiffs = 0;
let canonicalDiffs = 0;
let h1Diffs = 0;
let jsonLdDiffs = 0;
let visibleTextDiffsCourse = [];
let visibleTextDiffsOther = [];

for (const url of beforeUrls) {
  if (!after[url]) continue;
  const b = before[url];
  const a = after[url];

  if (b.title !== a.title) {
    titleDiffs++;
    console.error(`Title diff at ${url}: [${b.title}] vs [${a.title}]`);
  }
  if (b.description !== a.description) {
    descDiffs++;
    console.error(`Desc diff at ${url}`);
  }
  if (b.canonical !== a.canonical) {
    canonicalDiffs++;
    console.error(`Canonical diff at ${url}: [${b.canonical}] vs [${a.canonical}]`);
  }
  if (b.h1Text !== a.h1Text) {
    h1Diffs++;
    console.error(`h1 diff at ${url}: [${b.h1Text}] vs [${a.h1Text}]`);
  }
  if (b.jsonLdHash !== a.jsonLdHash) {
    jsonLdDiffs++;
    console.error(`JSON-LD diff at ${url}`);
  }

  if (b.visibleTextHash !== a.visibleTextHash) {
    const norm = url.replace(/\\/g, '/').replace(/^dist\//, '/');

    // Check if category hub or catalog index
    const isCategoryHub = [
      '/pelatihan/index.html',
      '/pelatihan/k3/index.html',
      '/pelatihan/lingkungan/index.html',
      '/pelatihan/mining/index.html',
      '/pelatihan/system-management/index.html'
    ].includes(norm);

    // Course pages are in /pelatihan/ and not hub or catalog index
    if (norm.startsWith('/pelatihan/') && !isCategoryHub) {
      visibleTextDiffsCourse.push(norm);
    } else {
      visibleTextDiffsOther.push(norm);
      console.error(`Non-course visible text diff at ${norm}`);
    }
  }
}

console.log('\n=== SNAPSHOT COMPARISON SUMMARY ===');
console.log(`URLs Added:       ${added.length} (Expected: 0)`);
console.log(`URLs Removed:     ${removed.length} (Expected: 0)`);
console.log(`Title Diffs:      ${titleDiffs} (Expected: 0)`);
console.log(`Desc Diffs:       ${descDiffs} (Expected: 0)`);
console.log(`Canonical Diffs:  ${canonicalDiffs} (Expected: 0)`);
console.log(`H1 Diffs:         ${h1Diffs} (Expected: 0)`);
console.log(`JSON-LD Diffs:    ${jsonLdDiffs} (Expected: 0)`);
console.log(`Course Visible Diffs (Allowed: schedule filter): ${visibleTextDiffsCourse.length}`);
console.log(`Other Visible Diffs (Must be 0):                ${visibleTextDiffsOther.length}`);

if (added.length === 0 && removed.length === 0 && titleDiffs === 0 && descDiffs === 0 &&
    canonicalDiffs === 0 && h1Diffs === 0 && jsonLdDiffs === 0 && visibleTextDiffsOther.length === 0) {
  console.log('\nRESULT: PASS');
  process.exit(0);
} else {
  console.log('\nRESULT: FAIL');
  process.exit(1);
}
