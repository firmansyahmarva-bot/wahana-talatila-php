import fs from 'fs';

// 1. Fix regulasi-k3
let reg = fs.readFileSync('src/pages/tools/regulasi-k3.astro', 'utf8');
reg = reg.replace('{count($regulasi)}', '{regulasiList.length}');
fs.writeFileSync('src/pages/tools/regulasi-k3.astro', reg, 'utf8');

// 2. Fix safety-talk
let st = fs.readFileSync('src/pages/tools/safety-talk.astro', 'utf8');
const relatedHtml = `<li class="st-training-item"><a href="/pelatihan/pelatihan-ahli-k3-umum-sertifikasi-kemnaker-ri/"><span>Program Ahli K3 Umum Kemnaker RI</span><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg></a></li>
      <li class="st-training-item"><a href="/pelatihan/pelatihan-tkbt-ii-sertifikasi-kemnaker-ri/"><span>Program TKBT II Kemnaker RI</span><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg></a></li>
      <li class="st-training-item"><a href="/pelatihan/pelatihan-ahli-k3-listrik-sertifikasi-kemnaker-ri/"><span>Program Ahli K3 Listrik Kemnaker RI</span><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg></a></li>
      <li class="st-training-item"><a href="/pelatihan/pelatihan-petugas-k3-kimia-sertifikasi-kemnaker-ri/"><span>Program Petugas K3 Kimia Kemnaker RI</span><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg></a></li>`;

st = st.replace(/<li class="st-training-item">[\s\S]*?<\/li>/, relatedHtml);
fs.writeFileSync('src/pages/tools/safety-talk.astro', st, 'utf8');
console.log('Fixed regulasi-k3 and safety-talk cleanly!');
