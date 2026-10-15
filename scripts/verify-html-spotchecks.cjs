const fs = require('fs');
const path = require('path');

const distDir = path.join(__dirname, '..', 'dist');

const pages = [
  { type: 'course', file: 'pelatihan/pelatihan-ahli-k3-umum-sertifikasi-kemnaker-ri/index.html' },
  { type: 'city-course', file: 'pelatihan/ahli-higiene-industri-muda-bandung/index.html' },
  { type: 'category', file: 'pelatihan/k3/index.html' },
  { type: 'catalog', file: 'pelatihan/index.html' },
];

let allPassed = true;

for (const p of pages) {
  const fullPath = path.join(distDir, p.file);
  if (!fs.existsSync(fullPath)) {
    console.error(`❌ File not found: ${p.file}`);
    allPassed = false;
    continue;
  }

  const html = fs.readFileSync(fullPath, 'utf8');

  // Check 1: exactly one h1
  const h1Matches = html.match(/<h1[\s>]/gi) || [];
  const h1Count = h1Matches.length;
  const h1Pass = h1Count === 1;

  // Check 2: WhatsApp links are present
  const waPass = html.includes('wa.me') || html.includes('whatsapp');

  // Check 3: Schedule block on course page
  const hasSchedule = html.includes('live-schedule-grid') || html.includes('tc-live-schedules') || html.includes('pd-schedule-section');
  const schedulePass = p.type === 'course' ? hasSchedule : true;

  // Check 4: Sticky bar markup exists ONLY on the course page
  const hasStickyBarMarkup = html.includes('class="pd-sticky-mobile-bar"') || html.includes("class='pd-sticky-mobile-bar'");
  const stickyPass = p.type === 'course' ? hasStickyBarMarkup : !hasStickyBarMarkup;

  console.log(`\n--- Verification for [${p.type}] ${p.file} ---`);
  console.log(`H1 count (expected 1): ${h1Count} -> ${h1Pass ? 'PASS' : 'FAIL'}`);
  console.log(`WhatsApp link present: ${waPass ? 'PASS' : 'FAIL'}`);
  if (p.type === 'course') {
    console.log(`Schedule block present: ${schedulePass ? 'PASS' : 'FAIL'}`);
  }
  console.log(`Sticky bottom bar markup: ${hasStickyBarMarkup ? 'PRESENT' : 'ABSENT'} (expected ${p.type === 'course' ? 'PRESENT' : 'ABSENT'}) -> ${stickyPass ? 'PASS' : 'FAIL'}`);

  if (!h1Pass || !waPass || !schedulePass || !stickyPass) {
    allPassed = false;
  }
}

console.log(`\n========================================`);
console.log(`HTML SPOT CHECK OVERALL: ${allPassed ? 'PASS' : 'FAIL'}`);
console.log(`========================================`);

if (!allPassed) process.exit(1);
