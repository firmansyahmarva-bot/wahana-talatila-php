import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const pagesDir = path.join(__dirname, '..', 'src', 'pages', 'tools');
const dataDir = path.join(__dirname, '..', 'data');

// 1. Fix apd-selector.astro
const apdPath = path.join(pagesDir, 'apd-selector.astro');
let apdContent = fs.readFileSync(apdPath, 'utf8');
if (!apdContent.includes("import apdList from")) {
  apdContent = apdContent.replace("import Layout from '../../layouts/Layout.astro';", "import Layout from '../../layouts/Layout.astro';\nimport apdList from '../../../data/tools_apd.json';");
}
apdContent = apdContent.replace(/<div class="apd-cards-grid" id="apdCards">[\s\S]*?<\/div>(\s*<!-- IN-DEPTH)/, `<div class="apd-cards-grid" id="apdCards">
      {apdList.map((a) => (
        <div class="apd-card" data-cat={a.id}>
          <div class="apd-badge">{a.kategori}</div>
          <h3 class="apd-title">{a.nama}</h3>
          <div class="apd-standard">Standar: {a.standar}</div>
          
          <div class="apd-spec-list">
            <div><strong>Potensi Bahaya:</strong> {a.bahaya}</div>
            <div><strong>Spesifikasi Wajib:</strong> {a.spesifikasi}</div>
            <div><strong>Masa Pakai / Kadaluarsa:</strong> {a.masa_pakai}</div>
          </div>

          <div class="apd-inspect-box">
            <strong>Poin Kritis Inspeksi Pra-Pakai:</strong><br />
            {a.inspeksi}
          </div>
        </div>
      ))}
    </div>$1`);
fs.writeFileSync(apdPath, apdContent, 'utf8');
console.log('Fixed apd-selector.astro');

// 2. Fix regulasi-k3.astro
const regPath = path.join(pagesDir, 'regulasi-k3.astro');
let regContent = fs.readFileSync(regPath, 'utf8');
if (!regContent.includes("import regulasiList from")) {
  regContent = regContent.replace("import Layout from '../../layouts/Layout.astro';", "import Layout from '../../layouts/Layout.astro';\nimport regulasiList from '../../../data/tools_regulasi.json';");
}
regContent = regContent.replace(/<div class="reg-grid" id="regCardGrid">[\s\S]*?<\/div>(\s*<!-- IN-DEPTH)/, `<div class="reg-grid" id="regCardGrid">
      {regulasiList.map((r) => (
        <div class="reg-card" data-cat={r.cat} data-text={(r.nomor + ' ' + r.judul + ' ' + r.ringkasan + ' ' + r.pasal).toLowerCase()}>
          <div class="reg-badge-row">
            <span style="font-size:0.75rem;font-weight:700;color:var(--slate-600);text-transform:uppercase">{r.cat.toUpperCase()}</span>
            <span class="badge-status">{r.status}</span>
          </div>
          <h3 class="reg-num">{r.nomor}</h3>
          <div class="reg-sub">{r.judul}</div>
          <p class="reg-desc">{r.ringkasan}</p>
          <div class="reg-meta-box">
            <div style="margin-bottom:6px"><strong>Pasal Krusial:</strong> {r.pasal}</div>
            <div><strong>Sanksi Pelanggaran:</strong> <span style="color:var(--danger-dark)">{r.sanksi}</span></div>
          </div>
        </div>
      ))}
    </div>$1`);
fs.writeFileSync(regPath, regContent, 'utf8');
console.log('Fixed regulasi-k3.astro');

// 3. Fix safety-talk.astro
const stPath = path.join(pagesDir, 'safety-talk.astro');
let stContent = fs.readFileSync(stPath, 'utf8');
const talks = JSON.parse(fs.readFileSync(path.join(dataDir, 'tools_safety_talk.json'), 'utf8'));

if (!stContent.includes("import talksList from")) {
  stContent = stContent.replace("import Layout from '../../layouts/Layout.astro';", "import Layout from '../../layouts/Layout.astro';\nimport talksList from '../../../data/tools_safety_talk.json';");
}
stContent = stContent.replace(/<div class="st-grid" id="talkGrid">[\s\S]*?<\/div>(\s*<!-- Fallback)/, `<div class="st-grid" id="talkGrid">
      {talksList.map((t, i) => (
        <div class={\`st-card\${i >= 12 ? ' is-hidden' : ''}\`} data-cat={t.cat} onclick={\`openModal(\${i})\`}>
          <div class="st-card-top">
            <span class={\`st-cat-badge cat-\${t.cat}\`}>{t.cat.toUpperCase()}</span>
            <span class="st-topic-id">Topik #{t.w}</span>
          </div>
          <div class="st-card-header">
            <h3>{t.title}</h3>
          </div>
          <div class="st-card-body">{t.desc}</div>
          <div class="st-card-tags">
            {t.tags.map((tag) => (
              <span class="st-tag">{tag}</span>
            ))}
          </div>
          <a class="st-card-related" href={t.related ? t.related.url : '/pelatihan/pelatihan-ahli-k3-umum-sertifikasi-kemnaker-ri/'} onclick="event.stopPropagation()">
            <span>Pelajari: {t.related ? t.related.label : 'Program Ahli K3 Umum Kemnaker RI'}</span>
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
          </a>
          <div class="st-card-footer">
            <button class="st-btn-detail" onclick={\`event.stopPropagation();openModal(\${i})\`} type="button">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
              <span>Lihat Detail</span>
            </button>
            <button class="st-btn-print" onclick={\`event.stopPropagation();printTalk(\${i})\`} type="button" title="Cetak materi dan lembar absensi">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
              <span>Cetak</span>
            </button>
          </div>
        </div>
      ))}
    </div>$1`);

// Fix client JS talks definition
const talksJsonString = JSON.stringify(talks);
stContent = stContent.replace(/const talks = .*?;/, `const talks = ${talksJsonString};`);

// Remove any lingering PHP tags in safety-talk
stContent = stContent.replace(/<\?php[\s\S]*?\?>/g, '');
stContent = stContent.replace(/<\?=[\s\S]*?\?>/g, '');

fs.writeFileSync(stPath, stContent, 'utf8');
console.log('Fixed safety-talk.astro');
