import fs from 'fs';

async function test() {
  const res = await fetch('http://localhost:4321/pelatihan/operator-alat-berat-surabaya/');
  const html = await res.text();
  
  const mainOpen = html.indexOf('<main id="konten-utama">');
  const mainClose = html.indexOf('</main>', mainOpen + 24);
  const ctaIndex = html.indexOf('class="cta w"');
  const footerIndex = html.indexOf('<footer');
  
  console.log('mainOpen index:', mainOpen);
  console.log('mainClose index:', mainClose);
  console.log('ctaIndex:', ctaIndex);
  console.log('footerIndex:', footerIndex);
  
  if (mainClose > ctaIndex && mainClose < footerIndex) {
    console.log('✅ DOM structure is valid: <main> closes after CTA and before <footer>');
  } else {
    console.log('❌ Invalid DOM nesting: mainClose is before CTA or missing');
  }
}

test();
