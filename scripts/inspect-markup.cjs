const fs = require('fs');
const pages = [
  'd:/wahana-transform/temp-ca82039/dist/index.html',
  'd:/wahana-transform/temp-ca82039/dist/pelatihan/pelatihan-ahli-k3-umum-sertifikasi-kemnaker-ri/index.html',
  'd:/wahana-transform/temp-ca82039/dist/pelatihan-k3-jakarta/index.html',
  'd:/wahana-transform/temp-ca82039/dist/jadwal/index.html',
  'd:/wahana-transform/temp-ca82039/dist/tools/apd-selector/index.html',
  'd:/wahana-transform/temp-ca82039/dist/tools/risk-matrix/index.html',
  'd:/wahana-transform/temp-ca82039/dist/ak3u-gratis/index.html'
];
for (const p of pages) {
  if (!fs.existsSync(p)) continue;
  const c = fs.readFileSync(p, 'utf8');
  console.log('=== PAGE:', p.split('temp-ca82039/dist')[1]);
  const faqM = c.match(/<(details|div|section)[^>]*class=["'][^"']*(faq|sp-faq)[^"']*["'][^>]*>/i);
  if (faqM) console.log('FAQ match:', faqM[0]);
  const sumM = c.match(/<(summary|button|div)[^>]*class=["'][^"']*(faq-q|faq-question|sp-faq-summary|faq-summary)[^"']*["'][^>]*>/i);
  if (sumM) console.log('Summary match:', sumM[0]);
  const bcM = c.match(/<(nav|div)[^>]*class=["'][^"']*(breadcrumb|sp-breadcrumb)[^"']*["'][^>]*>/i);
  if (bcM) console.log('Breadcrumb match:', bcM[0]);
}
