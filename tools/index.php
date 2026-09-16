<?php
require_once __DIR__ . '/../config.php';
$s = get_all_settings();
?>
<?php
$page_title = 'Tools K3 Gratis Online — Kalkulator, Template & Generator';
$meta_desc = 'Kumpulan tools K3 gratis: kalkulator LTIR/TRIR online, risk matrix interaktif, JSA builder, IBPR generator, pemilih APD, kalkulatot kebisingan. Digunakan lebih dari 5.000 HSE officer Indonesia.';
require __DIR__ . '/../includes/head.php';
?>
<link rel="manifest" href="/manifest.json">
<style>
:root{--primary:#1a6b3a;--primary-d:#145530;--accent:#f5a623;--bg:#f8fafc;--card:#fff;--text:#1a202c;--muted:#6b7280;--radius:12px;--shadow:0 2px 16px rgba(0,0,0,.09)}
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Segoe UI',system-ui,sans-serif;background:var(--bg);color:var(--text);line-height:1.6}
a{color:inherit;text-decoration:none}
.container{max-width:1140px;margin:0 auto;padding:0 20px}
/* NAV */
nav{background:#fff;border-bottom:1px solid #e5e7eb;padding:14px 0;position:sticky;top:0;z-index:100;box-shadow:0 1px 6px rgba(0,0,0,.06)}
.nav-inner{display:flex;align-items:center;justify-content:space-between}
.nav-logo{display:flex;align-items:center;gap:10px;font-weight:700;font-size:1.05rem;color:var(--primary)}
.nav-logo svg{width:36px;height:36px}
.nav-links{display:flex;gap:24px;font-size:.9rem}
.nav-links a{color:var(--muted);font-weight:500;transition:color .2s}
.nav-links a:hover,.nav-links a.active{color:var(--primary)}
.nav-cta{background:var(--primary);color:#fff;padding:8px 20px;border-radius:8px;font-size:.88rem;font-weight:600;transition:background .2s}
.nav-cta:hover{background:var(--primary-d);color:#fff}
/* HERO */
.hero{background:linear-gradient(135deg,#0f4c2a 0%,#1a6b3a 60%,#2d8a52 100%);color:#fff;padding:60px 0 50px;text-align:center}
.hero-badge{display:inline-block;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.3);border-radius:50px;padding:6px 18px;font-size:.82rem;font-weight:600;letter-spacing:.5px;margin-bottom:20px;text-transform:uppercase}
.hero h1{font-size:clamp(1.8rem,4vw,2.8rem);font-weight:800;line-height:1.2;margin-bottom:16px}
.hero h1 span{color:var(--accent)}
.hero p{font-size:1.05rem;opacity:.88;max-width:620px;margin:0 auto 30px}
.hero-stats{display:flex;gap:32px;justify-content:center;flex-wrap:wrap;margin-top:32px}
.hero-stat{text-align:center}
.hero-stat strong{display:block;font-size:1.8rem;font-weight:800;color:var(--accent)}
.hero-stat span{font-size:.82rem;opacity:.8}
/* SEARCH BAR */
.search-wrap{background:#fff;max-width:560px;margin:-24px auto 0;border-radius:50px;box-shadow:0 8px 30px rgba(0,0,0,.15);display:flex;align-items:center;padding:6px 6px 6px 20px;position:relative;z-index:10}
.search-wrap input{flex:1;border:none;outline:none;font-size:.95rem;color:var(--text);background:transparent}
.search-wrap button{background:var(--primary);color:#fff;border:none;border-radius:50px;padding:10px 24px;font-size:.88rem;font-weight:600;cursor:pointer;white-space:nowrap}
/* CATEGORIES */
.cats{padding:60px 0 20px}
.cats h2{font-size:1.6rem;font-weight:800;text-align:center;margin-bottom:8px}
.cats-sub{text-align:center;color:var(--muted);margin-bottom:40px}
.cat-tabs{display:flex;gap:10px;flex-wrap:wrap;justify-content:center;margin-bottom:40px}
.cat-tab{background:#fff;border:2px solid #e5e7eb;border-radius:50px;padding:8px 20px;font-size:.88rem;font-weight:600;cursor:pointer;transition:all .2s;color:var(--muted)}
.cat-tab:hover,.cat-tab.active{background:var(--primary);border-color:var(--primary);color:#fff}
/* TOOLS GRID */
.tools-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:24px}
.tool-card{background:var(--card);border-radius:var(--radius);box-shadow:var(--shadow);overflow:hidden;transition:transform .2s,box-shadow .2s;border:1px solid #e5e7eb;display:flex;flex-direction:column}
.tool-card:hover{transform:translateY(-4px);box-shadow:0 8px 32px rgba(0,0,0,.14)}
.tool-card-header{padding:24px 24px 16px;display:flex;align-items:flex-start;gap:16px}
.tool-icon{width:52px;height:52px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0}
.tool-icon.green{background:#dcfce7}
.tool-icon.blue{background:#dbeafe}
.tool-icon.orange{background:#ffedd5}
.tool-icon.purple{background:#ede9fe}
.tool-icon.red{background:#fee2e2}
.tool-icon.yellow{background:#fef9c3}
.tool-icon.teal{background:#ccfbf1}
.tool-icon.pink{background:#fce7f3}
.tool-card h3{font-size:1rem;font-weight:700;margin-bottom:4px}
.tool-card .tag{display:inline-block;font-size:.72rem;padding:2px 10px;border-radius:50px;font-weight:600;margin-bottom:4px}
.tag-online{background:#dcfce7;color:#16a34a}
.tag-download{background:#dbeafe;color:#2563eb}
.tag-template{background:#ffedd5;color:#c2410c}
.tool-card p{font-size:.88rem;color:var(--muted);line-height:1.5;padding:0 24px 16px}
.tool-card-footer{margin-top:auto;padding:16px 24px;border-top:1px solid #f3f4f6;display:flex;align-items:center;justify-content:space-between}
.btn-tool{background:var(--primary);color:#fff;border-radius:8px;padding:9px 20px;font-size:.85rem;font-weight:600;transition:background .2s;display:inline-flex;align-items:center;gap:6px}
.btn-tool:hover{background:var(--primary-d);color:#fff}
.btn-tool-ghost{color:var(--primary);font-size:.85rem;font-weight:600}
.tool-meta{font-size:.78rem;color:var(--muted);display:flex;align-items:center;gap:4px}
/* SECTION TITLES */
.section{padding:60px 0}
.section-title{font-size:1.5rem;font-weight:800;margin-bottom:8px}
.section-sub{color:var(--muted);margin-bottom:36px}
/* FEATURED TOOL */
.featured-tool{background:linear-gradient(135deg,#1a6b3a,#2d8a52);border-radius:16px;color:#fff;padding:40px;display:grid;grid-template-columns:1fr auto;gap:32px;align-items:center;margin-bottom:40px}
.featured-tool h3{font-size:1.4rem;font-weight:800;margin-bottom:10px}
.featured-tool p{opacity:.88;font-size:.95rem;margin-bottom:20px}
.featured-features{list-style:none;display:flex;flex-direction:column;gap:8px;font-size:.88rem;opacity:.9}
.featured-features li::before{content:"✓ "}
.featured-preview{background:rgba(0,0,0,.2);border-radius:12px;padding:20px;min-width:200px;text-align:center}
.featured-preview .big-num{font-size:3rem;font-weight:900;color:var(--accent);line-height:1}
.featured-preview .big-label{font-size:.8rem;opacity:.8;margin-top:4px}
.btn-featured{background:#fff;color:var(--primary);padding:12px 28px;border-radius:8px;font-weight:700;font-size:.95rem;display:inline-block;transition:opacity .2s}
.btn-featured:hover{opacity:.92;color:var(--primary)}
/* DOWNLOAD SECTION */
.download-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:20px}
.dl-card{background:#fff;border-radius:12px;border:1px solid #e5e7eb;padding:20px;display:flex;gap:16px;align-items:flex-start;transition:box-shadow .2s}
.dl-card:hover{box-shadow:0 4px 20px rgba(0,0,0,.1)}
.dl-icon{width:44px;height:44px;border-radius:10px;background:#dcfce7;display:flex;align-items:center;justify-content:center;font-size:1.3rem;flex-shrink:0}
.dl-card h4{font-size:.92rem;font-weight:700;margin-bottom:4px}
.dl-card p{font-size:.8rem;color:var(--muted);margin-bottom:10px}
.dl-card a{color:var(--primary);font-size:.82rem;font-weight:600}
/* CTA BANNER */
.cta-banner{background:var(--accent);border-radius:16px;padding:40px;text-align:center;margin:60px 0}
.cta-banner h3{font-size:1.5rem;font-weight:800;margin-bottom:10px}
.cta-banner p{font-size:.95rem;margin-bottom:24px;max-width:500px;margin-left:auto;margin-right:auto}
.btn-wa{background:#25D366;color:#fff;padding:14px 32px;border-radius:10px;font-weight:700;font-size:1rem;display:inline-flex;align-items:center;gap:10px;transition:opacity .2s}
.btn-wa:hover{opacity:.9;color:#fff}
/* FOOTER */
footer{background:#111827;color:#9ca3af;padding:40px 0;margin-top:80px;text-align:center;font-size:.85rem}
footer a{color:#6ee7b7}
footer .footer-links{display:flex;gap:20px;justify-content:center;flex-wrap:wrap;margin-bottom:16px}
/* SEARCH HIDE */
.tool-card.hidden{display:none}
@media(max-width:768px){
  .hero{padding:40px 0 36px}
  .featured-tool{grid-template-columns:1fr}
  .featured-preview{display:none}
  .nav-links{display:none}
  .hero-stats{gap:20px}
}
.tools-training-cta{padding:40px 0}
.tools-training-cta h2{font-size:1.3rem;font-weight:800;margin:0 0 16px;text-align:center;color:#0A4A2E}
.tools-training-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(230px,1fr));gap:16px}
.tools-training-card{background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:18px;display:flex;flex-direction:column}
.tools-training-card h3{font-size:.95rem;font-weight:700;margin:0 0 8px}
.tools-training-card h3 a{color:#0A4A2E;text-decoration:none}
.tools-training-card p{font-size:.85rem;color:#555;line-height:1.6;margin:0 0 12px;flex:1}
.tools-training-btn{display:inline-block;background:#0A4A2E;color:#fff;font-weight:700;font-size:.85rem;padding:8px 14px;border-radius:8px;text-decoration:none;text-align:center}
</style>
<!-- Schema: SoftwareApplication Collection -->
<script type="application/ld+json">
{
  "@context":"https://schema.org",
  "@type":"CollectionPage",
  "name":"Tools K3 Gratis Online",
  "description":"Kumpulan tools K3 gratis untuk HSE officer Indonesia: kalkulator statistik K3, risk matrix interaktif, JSA builder, IBPR generator, template dokumen dan lebih banyak lagi.",
  "url":"https://wahanatotalita.com/tools/",
  "provider":{
    "@type":"Organization",
    "name":"Wahana Totalita Konsultan",
    "url":"https://wahanatotalita.com"
  }
}
</script>
<nav>
  <div class="container nav-inner">
    <a href="/" class="nav-logo">
      <svg viewBox="0 0 40 40" fill="none"><circle cx="20" cy="20" r="20" fill="#1a6b3a"/><path d="M20 8l3 9h9l-7 5 3 9-8-6-8 6 3-9-7-5h9z" fill="#f5a623"/></svg>
      Wahana Totalita
    </a>
    <div class="nav-links">
      <a href="/">Beranda</a>
      <a href="/jadwal-pelatihan">Jadwal</a>
      <a href="/csms">Dokumen K3</a>
      <a href="/tools/" class="active">Tools Gratis</a>
      <a href="/artikel/">Artikel</a>
    </div>
    <a href="https://wa.me/6287759151278?text=Halo%20Wahana%2C%20saya%20ingin%20konsultasi%20pelatihan%20K3" target="_blank" rel="noopener" class="nav-cta">📱 Konsultasi Gratis</a>
  </div>
</nav>

<section class="hero">
  <div class="container">
    <div class="hero-badge">🔧 Tools K3 100% Gratis</div>
    <h1>Semua Tools HSE yang Kamu<br><span>Butuhkan Ada di Sini</span></h1>
    <p>Kalkulator LTIR/TRIR, Risk Matrix interaktif, JSA Builder, IBPR Generator, template Excel, database regulasi — gratis selamanya untuk HSE officer Indonesia.</p>

    <div class="search-wrap">
      <input type="text" id="toolSearch" placeholder="Cari tool... (contoh: LTIR, risk matrix, JSA)" oninput="searchTools(this.value)">
      <button onclick="searchTools(document.getElementById('toolSearch').value)">Cari</button>
    </div>

    <div class="hero-stats">
      <div class="hero-stat"><strong>11</strong><span>Tools Online</span></div>
      <div class="hero-stat"><strong>15+</strong><span>Template Download</span></div>
      <div class="hero-stat"><strong>100%</strong><span>Gratis</span></div>
      <div class="hero-stat"><strong>No Login</strong><span>Langsung Pakai</span></div>
    </div>
  </div>
</section>

<section class="cats">
  <div class="container">
    <h2>Tools K3 Berdasarkan Kategori</h2>
    <p class="cats-sub">Pilih kategori atau gunakan pencarian di atas untuk menemukan tool yang kamu butuhkan</p>

    <div class="cat-tabs">
      <button class="cat-tab active" onclick="filterCat(this,'all')">Semua Tools</button>
      <button class="cat-tab" onclick="filterCat(this,'kalkulator')">🧮 Kalkulator</button>
      <button class="cat-tab" onclick="filterCat(this,'generator')">⚙️ Generator & Builder</button>
      <button class="cat-tab" onclick="filterCat(this,'referensi')">📚 Referensi</button>
      <button class="cat-tab" onclick="filterCat(this,'template')">📄 Template Download</button>
    </div>

    <!-- FEATURED TOOL -->
    <a href="/tools/kalkulator-k3" style="display:block">
    <div class="featured-tool">
      <div>
        <span style="background:rgba(255,255,255,.2);border-radius:50px;padding:4px 14px;font-size:.78rem;font-weight:700;display:inline-block;margin-bottom:14px">⭐ PALING POPULER</span>
        <h3>Kalkulator Statistik K3 — LTIR, TRIR, SR, FR</h3>
        <p>Hitung LTIR, TRIR, LTISR, Frequency Rate dan Severity Rate secara otomatis. Masukkan data jam kerja, jumlah kecelakaan, hari hilang — langsung dapat semua angka + interpretasi.</p>
        <ul class="featured-features">
          <li>Dukungan standar OSHA (200.000 jam) dan International (1.000.000 jam)</li>
          <li>Laporan bulanan & tahunan otomatis</li>
          <li>Interpretasi warna: aman / waspada / bahaya</li>
          <li>Copy hasil langsung ke clipboard / print laporan</li>
        </ul>
        <br>
        <span class="btn-featured">Buka Kalkulator →</span>
      </div>
      <div class="featured-preview">
        <div class="big-num">2.45</div>
        <div class="big-label">LTIR</div>
        <div style="margin-top:16px;font-size:.75rem;opacity:.7">1.000.000 jam kerja</div>
      </div>
    </div>
    </a>

    <!-- TOOLS GRID -->
    <div class="tools-grid" id="toolsGrid">

      <!-- KALKULATOR -->
      <div class="tool-card" data-cat="kalkulator" data-name="kalkulator statistik k3 ltir trir ltisr severity rate frequency rate kecelakaan">
        <div class="tool-card-header">
          <div class="tool-icon green">🧮</div>
          <div>
            <span class="tag tag-online">Online Tool</span>
            <h3>Kalkulator LTIR / TRIR / SR</h3>
          </div>
        </div>
        <p>Hitung semua KPI keselamatan kerja sekaligus: LTIR, TRIR, LTISR, Frequency Rate, Severity Rate. Standar OSHA & International.</p>
        <div class="tool-card-footer">
          <a href="/tools/kalkulator-k3" class="btn-tool">Buka Tool →</a>
          <span class="tool-meta">⚡ Langsung pakai</span>
        </div>
      </div>

      <div class="tool-card" data-cat="kalkulator" data-name="kalkulator kebisingan nab noise exposure db jam">
        <div class="tool-card-header">
          <div class="tool-icon blue">🔊</div>
          <div>
            <span class="tag tag-online">Online Tool</span>
            <h3>Kalkulator Paparan Kebisingan</h3>
          </div>
        </div>
        <p>Hitung dosis paparan kebisingan berdasarkan tingkat dB dan jam kerja. Bandingkan dengan NAB Kepmennaker 5/2018 (85 dB).</p>
        <div class="tool-card-footer">
          <a href="/tools/kalkulator-kebisingan" class="btn-tool">Buka Tool →</a>
          <span class="tool-meta">⚡ Langsung pakai</span>
        </div>
      </div>

      <div class="tool-card" data-cat="kalkulator" data-name="kalkulator biaya kecelakaan kerja heinrich ratio langsung tidak langsung">
        <div class="tool-card-header">
          <div class="tool-icon orange">💰</div>
          <div>
            <span class="tag tag-online">Online Tool</span>
            <h3>Kalkulator Biaya Kecelakaan</h3>
          </div>
        </div>
        <p>Estimasi biaya kecelakaan kerja menggunakan Rasio Heinrich (1:4). Hitung biaya langsung + tidak langsung untuk justifikasi anggaran K3.</p>
        <div class="tool-card-footer">
          <a href="/tools/kalkulator-biaya-k3" class="btn-tool">Buka Tool →</a>
          <span class="tool-meta">⚡ Langsung pakai</span>
        </div>
      </div>

      <!-- GENERATOR / BUILDER -->
      <div class="tool-card" data-cat="generator" data-name="risk matrix risiko matriks likelihod severity level warna">
        <div class="tool-card-header">
          <div class="tool-icon red">📊</div>
          <div>
            <span class="tag tag-online">Online Tool</span>
            <h3>Risk Matrix 5×5 Interaktif</h3>
          </div>
        </div>
        <p>Klik likelihood × severity — langsung dapat risk level (Low/Medium/High/Extreme), warna indikator, dan rekomendasi kontrol. Bisa print / simpan.</p>
        <div class="tool-card-footer">
          <a href="/tools/risk-matrix" class="btn-tool">Buka Tool →</a>
          <span class="tool-meta">⚡ Langsung pakai</span>
        </div>
      </div>

      <div class="tool-card" data-cat="generator" data-name="jsa job safety analysis builder form langkah hazard kontrol cetak">
        <div class="tool-card-header">
          <div class="tool-icon purple">📋</div>
          <div>
            <span class="tag tag-online">Online Tool</span>
            <h3>JSA Builder — Form Otomatis</h3>
          </div>
        </div>
        <p>Isi form JSA online — langkah pekerjaan, potensi bahaya, level risiko, tindakan pencegahan, APD. Langsung cetak ke PDF atau simpan.</p>
        <div class="tool-card-footer">
          <a href="/tools/jsa-builder" class="btn-tool">Buka Tool →</a>
          <span class="tool-meta">⚡ Print ke PDF</span>
        </div>
      </div>

      <div class="tool-card" data-cat="generator" data-name="ibpr hirarc identifikasi bahaya penilaian risiko pengendalian generator online">
        <div class="tool-card-header">
          <div class="tool-icon teal">🔍</div>
          <div>
            <span class="tag tag-online">Online Tool</span>
            <h3>IBPR / HIRARC Generator</h3>
          </div>
        </div>
        <p>Buat tabel IBPR (Identifikasi Bahaya Penilaian Risiko) atau HIRARC online. Input aktivitas, bahaya, risiko, kontrol → hasilkan dokumen siap pakai.</p>
        <div class="tool-card-footer">
          <a href="/tools/ibpr-generator" class="btn-tool">Buka Tool →</a>
          <span class="tool-meta">⚡ Print ke PDF</span>
        </div>
      </div>

      <div class="tool-card" data-cat="generator" data-name="laporan near miss incident report generator form">
        <div class="tool-card-header">
          <div class="tool-icon yellow">⚠️</div>
          <div>
            <span class="tag tag-online">Online Tool</span>
            <h3>Form Laporan Insiden / Near Miss</h3>
          </div>
        </div>
        <p>Isi form laporan insiden atau near miss secara digital. Sistem panduan langkah demi langkah — cocok untuk investigasi 5-Why dan laporan ke manajemen.</p>
        <div class="tool-card-footer">
          <a href="/tools/laporan-insiden" class="btn-tool">Buka Tool →</a>
          <span class="tool-meta">⚡ Print ke PDF</span>
        </div>
      </div>

      <!-- REFERENSI -->
      <div class="tool-card" data-cat="referensi" data-name="apd alat pelindung diri pemilih selector hazard jenis pekerjaan">
        <div class="tool-card-header">
          <div class="tool-icon orange">🦺</div>
          <div>
            <span class="tag tag-online">Online Tool</span>
            <h3>Panduan Pemilihan APD</h3>
          </div>
        </div>
        <p>Pilih jenis bahaya / pekerjaan → sistem langsung rekomendasikan APD yang wajib dipakai, standar yang berlaku, dan tips inspeksi APD.</p>
        <div class="tool-card-footer">
          <a href="/tools/apd-selector" class="btn-tool">Buka Tool →</a>
          <span class="tool-meta">⚡ Langsung pakai</span>
        </div>
      </div>

      <div class="tool-card" data-cat="referensi" data-name="regulasi k3 database undang undang peraturan permenaker pp smk3">
        <div class="tool-card-header">
          <div class="tool-icon blue">⚖️</div>
          <div>
            <span class="tag tag-online">Referensi</span>
            <h3>Database Regulasi K3 Indonesia</h3>
          </div>
        </div>
        <p>Cari peraturan K3 — UU, PP, Permenaker, Kepmenaker — beserta ringkasan isi, pasal penting, dan sanksi. Update 2024.</p>
        <div class="tool-card-footer">
          <a href="/tools/regulasi-k3" class="btn-tool">Buka Tool →</a>
          <span class="tool-meta">📚 100+ Regulasi</span>
        </div>
      </div>

      <div class="tool-card" data-cat="referensi" data-name="safety talk materi toolbox meeting k3 topik mingguan">
        <div class="tool-card-header">
          <div class="tool-icon green">🎤</div>
          <div>
            <span class="tag tag-online">Referensi</span>
            <h3>52 Materi Safety Talk / TBM</h3>
          </div>
        </div>
        <p>Satu tahun penuh topik safety talk siap pakai — 52 tema, setiap minggu ada materi lengkap + poin diskusi untuk toolbox meeting.</p>
        <div class="tool-card-footer">
          <a href="/tools/safety-talk" class="btn-tool">Buka Tool →</a>
          <span class="tool-meta">📅 52 Topik</span>
        </div>
      </div>

      <div class="tool-card" data-cat="referensi" data-name="nab nilai ambang batas kebisingan kimia suhu tabel referensi">
        <div class="tool-card-header">
          <div class="tool-icon purple">📏</div>
          <div>
            <span class="tag tag-online">Referensi</span>
            <h3>Tabel NAB — Nilai Ambang Batas</h3>
          </div>
        </div>
        <p>Referensi NAB lengkap: kebisingan, bahan kimia, suhu, getaran, radiasi. Berdasarkan Permenaker No.5 Tahun 2018. Bisa dicari dan difilter.</p>
        <div class="tool-card-footer">
          <a href="/tools/kalkulator-kebisingan" class="btn-tool">Buka Tool →</a>
          <span class="tool-meta">📚 Permenaker 5/2018</span>
        </div>
      </div>

      <!-- TEMPLATES DOWNLOAD -->
      <div class="tool-card" data-cat="template" data-name="hse dashboard excel download gratis project tracking">
        <div class="tool-card-header">
          <div class="tool-icon green">📊</div>
          <div>
            <span class="tag tag-download">Download Excel</span>
            <h3>HSE Dashboard Excel — Gratis</h3>
          </div>
        </div>
        <p>Dashboard HSE lengkap: incident tracking, LTIR/TRIR chart otomatis, risk register, audit tracker, training matrix. Setara produk berbayar di pasaran.</p>
        <div class="tool-card-footer">
          <a href="https://wa.me/6287759151278?text=Halo%20Wahana%2C%20saya%20minta%20HSE%20Dashboard%20Excel%20gratis" target="_blank" rel="noopener" class="btn-tool">Download Gratis →</a>
          <span class="tool-meta">📁 Via WhatsApp</span>
        </div>
      </div>

      <div class="tool-card" data-cat="template" data-name="template jsa excel download format kosong">
        <div class="tool-card-header">
          <div class="tool-icon blue">📄</div>
          <div>
            <span class="tag tag-download">Download Excel</span>
            <h3>Template JSA Excel</h3>
          </div>
        </div>
        <p>Format JSA siap pakai dalam Excel — header sudah terisi, formula risk level otomatis, tinggal isi langkah pekerjaan dan bahaya.</p>
        <div class="tool-card-footer">
          <a href="/assets/downloads/template-jsa.csv" download class="btn-tool">Download CSV →</a>
          <span class="tool-meta">📁 CSV/Excel</span>
        </div>
      </div>

      <div class="tool-card" data-cat="template" data-name="template ibpr hirarc excel download format kosong">
        <div class="tool-card-header">
          <div class="tool-icon teal">📄</div>
          <div>
            <span class="tag tag-download">Download Excel</span>
            <h3>Template IBPR / HIRARC Excel</h3>
          </div>
        </div>
        <p>Format IBPR/HIRARC lengkap dengan kolom likelihood, severity, risk score, existing control, dan residual risk. Sesuai standar SMK3 PP 50/2012.</p>
        <div class="tool-card-footer">
          <a href="/assets/downloads/template-ibpr.csv" download class="btn-tool">Download CSV →</a>
          <span class="tool-meta">📁 CSV/Excel</span>
        </div>
      </div>

    </div><!-- end tools-grid -->
  </div>
</section>

<!-- DOWNLOAD SECTION -->
<section style="background:#f0fdf4;padding:60px 0">
  <div class="container">
    <div class="section-title">📥 Template & Dokumen Download Gratis</div>
    <p class="section-sub">File Excel, Word, dan PDF siap pakai — download langsung, tanpa daftar</p>

    <div class="download-grid">
      <div class="dl-card">
        <div class="dl-icon">📊</div>
        <div>
          <h4>HSE Dashboard Excel All-in-One</h4>
          <p>6 sheet: Incident Log, LTIR Chart, Risk Register, Audit Tracker, Training Matrix, KPI Summary</p>
          <a href="https://wa.me/6287759151278?text=Minta%20HSE%20Dashboard%20Excel" target="_blank">📱 Minta via WhatsApp →</a>
        </div>
      </div>
      <div class="dl-card">
        <div class="dl-icon">📋</div>
        <div>
          <h4>Template JSA (Job Safety Analysis)</h4>
          <p>Format Excel siap pakai, risk matrix formula otomatis</p>
          <a href="/assets/downloads/template-jsa.csv" download>⬇ Download Template JSA →</a>
        </div>
      </div>
      <div class="dl-card">
        <div class="dl-icon">🔍</div>
        <div>
          <h4>Template IBPR / HIRARC</h4>
          <p>Identifikasi bahaya penilaian risiko sesuai PP 50/2012</p>
          <a href="/assets/downloads/template-ibpr.csv" download>⬇ Download Template IBPR →</a>
        </div>
      </div>
      <div class="dl-card">
        <div class="dl-icon">📝</div>
        <div>
          <h4>Form Ijin Kerja / Permit To Work</h4>
          <p>Hot Work, Confined Space, Working at Height, Electrical — 4 format</p>
          <a href="/csms#ptw">📄 Lihat di halaman CSMS →</a>
        </div>
      </div>
      <div class="dl-card">
        <div class="dl-icon">🚒</div>
        <div>
          <h4>Prosedur Tanggap Darurat</h4>
          <p>ERP template: kebakaran, tumpahan kimia, gempa, kecelakaan besar</p>
          <a href="/csms#tanggap-darurat">📄 Lihat di halaman CSMS →</a>
        </div>
      </div>
      <div class="dl-card">
        <div class="dl-icon">🎤</div>
        <div>
          <h4>52 Materi Safety Talk PDF</h4>
          <p>Satu tahun topik toolbox meeting siap cetak — update 2024</p>
          <a href="/tools/safety-talk">📖 Lihat semua topik →</a>
        </div>
      </div>
      <div class="dl-card">
        <div class="dl-icon">📈</div>
        <div>
          <h4>Template Laporan K3 Bulanan</h4>
          <p>Format laporan P2K3 bulanan sesuai persyaratan Disnaker</p>
          <a href="https://wa.me/6287759151278?text=Minta%20template%20laporan%20K3%20bulanan" target="_blank">📱 Minta via WhatsApp →</a>
        </div>
      </div>
      <div class="dl-card">
        <div class="dl-icon">⚙️</div>
        <div>
          <h4>Checklist Inspeksi K3 Umum</h4>
          <p>40+ item inspeksi: APAR, APD, housekeeping, mekanikal, elektrikal</p>
          <a href="/assets/downloads/checklist-inspeksi-k3.csv" download>⬇ Download Checklist →</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CTA BANNER -->
<section class="container">
  <div class="cta-banner">
    <h3>🎓 Ingin Sertifikasi K3 Resmi?</h3>
    <p>Tools ini gratis selamanya. Kalau kamu ingin naik level dengan sertifikat K3 KEMNAKER / BNSP yang diakui nasional, konsultasi dulu — gratis!</p>
    <a href="https://wa.me/6287759151278?text=Halo%20Wahana%2C%20saya%20pakai%20tools%20K3%20gratis%20dan%20ingin%20tanya%20soal%20pelatihan%20sertifikasi" target="_blank" rel="noopener" class="btn-wa">
      <svg viewBox="0 0 24 24" fill="currentColor" width="20" height="20"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
      Konsultasi Pelatihan K3 — Gratis
    </a>
  </div>
</section>

<section class="tools-training-cta">
  <div class="container">
    <h2>Tingkatkan Kompetensi K3 Anda</h2>
    <div class="tools-training-grid">
      <div class="tools-training-card">
        <h3><a href="/pelatihan/pelatihan-ahli-k3-umum-sertifikasi-bnsp-online/">Pelatihan Ahli K3 Umum</a></h3>
        <p>Sertifikasi wajib bagi praktisi K3 perusahaan, resmi BNSP, materi regulasi &amp; manajemen risiko.</p>
        <a href="/pelatihan/pelatihan-ahli-k3-umum-sertifikasi-bnsp-online/" class="tools-training-btn">Lihat Program &rarr;</a>
      </div>
      <div class="tools-training-card">
        <h3><a href="/pelatihan/pelatihan-petugas-p3k-sertifikasi-bnsp/">Pelatihan Petugas P3K | Sertifikasi BNSP</a></h3>
        <p>Pelatihan penanganan darurat dan P3K di tempat kerja, sertifikasi BNSP, wajib untuk perusahaan.</p>
        <a href="/pelatihan/pelatihan-petugas-p3k-sertifikasi-bnsp/" class="tools-training-btn">Lihat Program &rarr;</a>
      </div>
      <div class="tools-training-card">
        <h3><a href="/pelatihan/pelatihan-operator-k3-sertifikasi-bnsp/">Pelatihan Operator K3 | Sertifikasi BNSP</a></h3>
        <p>Kompetensi dasar keselamatan kerja untuk operator, sertifikasi resmi BNSP, untuk semua industri.</p>
        <a href="/pelatihan/pelatihan-operator-k3-sertifikasi-bnsp/" class="tools-training-btn">Lihat Program &rarr;</a>
      </div>
    </div>
  </div>
</section>

<footer>
  <div class="container">
    <div class="footer-links">
      <a href="/">Beranda</a>
      <a href="/tools/">Tools K3 Gratis</a>
      <a href="/csms">Template CSMS</a>
      <a href="/jadwal-pelatihan">Jadwal Pelatihan</a>
      <a href="/artikel/">Artikel K3</a>
      <a href="https://wa.me/6287759151278" target="_blank">WhatsApp</a>
    </div>
    <p>© <?php echo date('Y'); ?> Wahana Totalita Konsultan — Jl. Kaliurang KM 8, Yogyakarta | Tools K3 gratis untuk HSE officer Indonesia</p>
  </div>
</footer>

<!-- Floating WA -->
<a href="https://wa.me/6287759151278?text=Halo%20Wahana%2C%20saya%20pakai%20tools%20K3%20gratis%20dan%20ingin%20konsultasi" target="_blank" rel="noopener"
   style="position:fixed;bottom:24px;right:24px;background:#25D366;width:56px;height:56px;border-radius:50%;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 16px rgba(37,211,102,.4);z-index:999;transition:transform .2s"
   onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
  <svg viewBox="0 0 24 24" fill="white" width="28" height="28"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
</a>

<script>
function searchTools(q){
  q = q.toLowerCase().trim();
  document.querySelectorAll('.tool-card').forEach(card=>{
    const name = (card.dataset.name||'').toLowerCase();
    card.classList.toggle('hidden', q && !name.includes(q));
  });
}
function filterCat(btn, cat){
  document.querySelectorAll('.cat-tab').forEach(b=>b.classList.remove('active'));
  btn.classList.add('active');
  document.querySelectorAll('.tool-card').forEach(card=>{
    card.classList.toggle('hidden', cat !== 'all' && card.dataset.cat !== cat);
  });
}
</script>
</body>
</html>
