import fs from 'fs';
import path from 'path';

console.log('--- STARTING COMPREHENSIVE AUDIT ---');

const testRoutes = [
  'out/index.html',
  'out/pelatihan/index.html',
  'out/jadwal/index.html',
  'out/artikel/index.html',
  'out/ahli-k3-umum/index.html'
];

let allPassed = true;

for (const route of testRoutes) {
  const fullPath = path.join(process.cwd(), route);
  if (!fs.existsSync(fullPath)) {
    console.error(`FAIL: ${route} does not exist!`);
    allPassed = false;
    continue;
  }

  const html = fs.readFileSync(fullPath, 'utf8');

  const hasNavbar = html.includes('nav class="navbar');
  const hasFooter = html.includes('footer class="footer');
  const hasPhotoStrip = html.includes('footer-photo-strip');
  const hasMobileNav = html.includes('mobile-bottom-nav');
  const hasWaFloat = html.includes('wa-float');
  const hasCanonical = html.includes('rel="canonical"');
  const hasJsonLd = html.includes('application/ld+json');
  const imgCount = (html.match(/<img[^>]+>/g) || []).length;
  const hasOldInlineScript = html.includes('document.addEventListener(\'click\'') || html.includes('document.addEventListener("click"');

  console.log(`\nAuditing [${route}]:`);
  console.log(`  Navbar present:        ${hasNavbar ? 'OK' : 'MISSING'}`);
  console.log(`  Footer present:        ${hasFooter ? 'OK' : 'MISSING'}`);
  console.log(`  Photo strip present:   ${hasPhotoStrip ? 'OK' : 'MISSING'}`);
  console.log(`  Mobile bottom nav:     ${hasMobileNav ? 'OK' : 'MISSING'}`);
  console.log(`  WhatsApp float:        ${hasWaFloat ? 'OK' : 'MISSING'}`);
  console.log(`  Canonical link:        ${hasCanonical ? 'OK' : 'MISSING'}`);
  console.log(`  JSON-LD structured:    ${hasJsonLd ? 'OK' : 'MISSING'}`);
  console.log(`  Total Images:          ${imgCount}`);
  console.log(`  Old hacky script:      ${!hasOldInlineScript ? 'CLEAN (None)' : 'DETECTED'}`);

  if (!hasNavbar || !hasFooter || !hasCanonical || hasOldInlineScript || imgCount === 0) {
    allPassed = false;
  }
}

console.log('\n----------------------------------------');
console.log(`AUDIT RESULT: ${allPassed ? 'ALL CHECKS PASSED PERFECTLY' : 'SOME CHECKS FAILED'}`);
console.log('----------------------------------------');
