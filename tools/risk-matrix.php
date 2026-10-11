<?php
require_once __DIR__ . '/../config.php';
$s = get_all_settings();

$page_title = 'Matriks Risiko 5x5 K3 Online 2026: Kalkulator ISO 31000 & HIRARC';
$meta_desc = 'Kalkulator Matriks Risiko 5x5 interaktif standar ISO 31000:2018 dan HIRARC K3. Evaluasi skor keparahan, peluang, level risiko Low-Extreme, serta buat Risk Register online.';

ob_start();
require __DIR__ . '/../includes/head.php';
$shared_head = ob_get_clean();
$shared_head = preg_replace('~<title>.*?</title>~s', '<title>' . e($page_title) . '</title>', $shared_head, 1);
echo $shared_head;
?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    { "@type": "ListItem", "position": 1, "name": "Beranda", "item": "https://wahanatotalita.com/" },
    { "@type": "ListItem", "position": 2, "name": "Tools K3", "item": "https://wahanatotalita.com/tools/" },
    { "@type": "ListItem", "position": 3, "name": "Risk Matrix 5x5", "item": "https://wahanatotalita.com/tools/risk-matrix/" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebApplication",
  "name": "Kalkulator Matriks Risiko 5x5 K3 Online",
  "url": "https://wahanatotalita.com/tools/risk-matrix/",
  "description": "Aplikasi evaluasi matriks risiko 5x5 standar ISO 31000 dan HIRARC dengan fitur pembuatan dan pencetakan dokumen Risk Register K3.",
  "applicationCategory": "BusinessApplication",
  "operatingSystem": "All",
  "offers": { "@type": "Offer", "price": "0", "priceCurrency": "IDR" }
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "Apa itu Matriks Risiko 5x5 dalam K3?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Matriks Risiko 5x5 adalah alat visual penilaian risiko yang memetakan probabilitas atau peluang terjadinya suatu bahaya (Likelihood skala 1-5) dengan tingkat keparahan konsekuensi dampaknya (Consequence skala 1-5) untuk menghasilkan skor risiko total (1 hingga 25), yang terbagi dalam kategori Rendah (Low), Sedang (Medium), Tinggi (High), hingga Ekstrem (Extreme)."
      }
    },
    {
      "@type": "Question",
      "name": "Apa yang dimaksud dengan prinsip ALARP (As Low As Reasonably Practicable)?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "ALARP adalah prinsip penilaian keselamatan di mana risiko harus diturunkan sampai ke level terendah yang dapat dicapai secara praktis, mempertimbangkan perbandingan biaya finansial, waktu, dan upaya teknis terhadap manfaat penurunan risiko yang diperoleh."
      }
    },
    {
      "@type": "Question",
      "name": "Kapan suatu pekerjaan harus segera dihentikan berdasarkan Matriks Risiko?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Pekerjaan wajib segera dihentikan seketika (Stop Work Authority) jika penilaian risiko awal (Initial Risk) menghasilkan level Ekstrem / Kritis (skor 15-25). Pekerjaan sama sekali tidak boleh dilanjutkan sampai tindakan pengendalian fisik tingkat tinggi diterapkan dan risiko sisa (Residual Risk) turun ke level Sedang atau Rendah."
      }
    }
  ]
}
</script>

<style>
:root {
  --navy-dark: #071524;
  --navy: #0D233A;
  --navy-light: #183654;
  --orange: #E8611A;
  --orange-hover: #cf5213;
  --orange-light: #fff2ea;
  --slate-50: #F8FAFC;
  --slate-100: #F1F5F9;
  --slate-200: #E2E8F0;
  --slate-300: #CBD5E1;
  --slate-600: #475569;
  --slate-700: #334155;
  --slate-900: #0F172A;
  --radius-md: 12px;
  --radius-lg: 16px;
  --shadow-sm: 0 2px 8px rgba(13,35,58,0.06);
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
body {
  font-family: 'Source Sans 3', system-ui, -apple-system, sans-serif;
  background: var(--slate-50);
  color: var(--slate-900);
  line-height: 1.6;
}
.container { max-width: 1200px; margin: 0 auto; padding: 0 24px; }

/* HERO */
.rm-hero {
  background: linear-gradient(135deg, #071524 0%, #0D233A 60%, #183654 100%);
  color: #fff;
  padding: 58px 0 44px;
  position: relative;
  overflow: hidden;
  border-bottom: 3px solid var(--orange);
}
.rm-hero::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image: linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
  background-size: 36px 36px;
  pointer-events: none;
}
.hero-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: rgba(232, 97, 26, 0.18);
  border: 1px solid rgba(232, 97, 26, 0.4);
  padding: 6px 14px;
  border-radius: 999px;
  color: #FFA573;
  font-size: 0.8rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  margin-bottom: 14px;
}
.rm-hero h1 {
  font-family: 'Lexend', sans-serif;
  font-size: clamp(1.8rem, 3.6vw, 2.7rem);
  font-weight: 800;
  line-height: 1.2;
  margin-bottom: 12px;
}
.rm-hero h1 span { color: var(--orange); }
.rm-hero p {
  color: #CBD5E1;
  font-size: 1.05rem;
  max-width: 760px;
  margin-bottom: 20px;
}
.hero-tags { display: flex; flex-wrap: wrap; gap: 8px; }
.hero-tag {
  background: rgba(255,255,255,0.08);
  border: 1px solid rgba(255,255,255,0.12);
  padding: 4px 12px;
  border-radius: 6px;
  font-size: 0.82rem;
  color: #E2E8F0;
}

/* WORKSPACE LAYOUT */
.rm-wrapper { padding: 40px 0 60px; }
.rm-grid {
  display: grid;
  grid-template-columns: 1.15fr 0.85fr;
  gap: 32px;
  align-items: start;
}
@media (max-width: 992px) {
  .rm-grid { grid-template-columns: 1fr; }
}

.card-box {
  background: #fff;
  border: 1px solid var(--slate-200);
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow-sm);
  padding: 28px;
  margin-bottom: 28px;
}
.card-header-line {
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-bottom: 2px solid var(--slate-100);
  padding-bottom: 16px;
  margin-bottom: 22px;
}
.card-title {
  font-family: 'Lexend', sans-serif;
  font-size: 1.25rem;
  font-weight: 700;
  color: var(--navy);
  display: flex;
  align-items: center;
  gap: 10px;
}

/* 5x5 MATRIX GRID */
.matrix-container {
  display: grid;
  grid-template-columns: 80px repeat(5, 1fr);
  gap: 6px;
  margin: 16px 0 24px;
}
.matrix-cell {
  aspect-ratio: 1.25;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  border-radius: 8px;
  font-weight: 800;
  font-family: 'Lexend', sans-serif;
  cursor: pointer;
  transition: all 0.2s;
  position: relative;
  user-select: none;
  font-size: 1.1rem;
}
.matrix-cell small { font-size: 0.68rem; font-weight: 600; opacity: 0.9; }
.matrix-cell:hover {
  transform: scale(1.05);
  box-shadow: 0 6px 16px rgba(0,0,0,0.15);
  z-index: 2;
}
.matrix-cell.selected {
  outline: 3px solid #000;
  box-shadow: 0 0 0 4px #fff, 0 8px 20px rgba(0,0,0,0.25);
  transform: scale(1.08);
  z-index: 3;
}

/* Risk Colors */
.cell-low { background: #86EFAC; color: #14532D; }
.cell-med { background: #FDE047; color: #713F12; }
.cell-high { background: #FDBA74; color: #7C2D12; }
.cell-ext { background: #FCA5A5; color: #7F1D1D; }

.matrix-header-y {
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 0.76rem;
  font-weight: 700;
  color: var(--slate-600);
  text-align: center;
  line-height: 1.2;
}
.matrix-header-x {
  grid-column: 2 / span 5;
  text-align: center;
  font-size: 0.85rem;
  font-weight: 700;
  color: var(--navy);
  padding: 6px;
  text-transform: uppercase;
  letter-spacing: 0.04em;
}

/* CONTROLS SLIDERS / SELECTORS */
.control-row { margin-bottom: 20px; }
.control-label {
  display: flex;
  justify-content: space-between;
  font-size: 0.88rem;
  font-weight: 700;
  color: var(--navy);
  margin-bottom: 8px;
}
.select-styled {
  width: 100%;
  padding: 10px 14px;
  border: 1.5px solid var(--slate-200);
  border-radius: var(--radius-md);
  font-size: 0.92rem;
  color: var(--slate-900);
  background: #fff;
}
.select-styled:focus {
  outline: none;
  border-color: var(--orange);
}

/* RESULT DETAILS */
.risk-score-display {
  background: var(--slate-50);
  border: 2px solid var(--slate-200);
  border-radius: var(--radius-lg);
  padding: 24px;
  text-align: center;
  margin-bottom: 24px;
}
.score-badge {
  display: inline-block;
  font-family: 'Lexend', sans-serif;
  font-size: 2.8rem;
  font-weight: 900;
  line-height: 1;
  padding: 12px 28px;
  border-radius: var(--radius-md);
  margin-bottom: 12px;
}
.score-cat {
  font-family: 'Lexend', sans-serif;
  font-size: 1.3rem;
  font-weight: 800;
  margin-bottom: 8px;
}
.score-timeframe {
  font-size: 0.85rem;
  font-weight: 600;
  color: var(--slate-700);
  background: rgba(0,0,0,0.04);
  padding: 6px 14px;
  border-radius: 999px;
  display: inline-block;
}

/* RISK REGISTER TABLE */
.register-table-wrapper {
  overflow-x: auto;
  margin-top: 16px;
  border: 1px solid var(--slate-200);
  border-radius: var(--radius-md);
}
.reg-table {
  width: 100%;
  border-collapse: collapse;
  font-size: 0.86rem;
}
.reg-table th {
  background: var(--navy);
  color: #fff;
  padding: 10px 12px;
  text-align: left;
  font-size: 0.82rem;
}
.reg-table td {
  padding: 10px 12px;
  border-bottom: 1px solid var(--slate-200);
  background: #fff;
}
.reg-table tr:hover td { background: var(--slate-50); }

/* EDITORIAL ARTICLE */
.editorial-box {
  background: #fff;
  border: 1px solid var(--slate-200);
  border-radius: var(--radius-lg);
  padding: 36px;
  margin-bottom: 32px;
}
.editorial-title {
  font-family: 'Lexend', sans-serif;
  font-size: 1.45rem;
  font-weight: 800;
  color: var(--navy);
  margin-bottom: 16px;
  border-left: 4px solid var(--orange);
  padding-left: 14px;
}
.editorial-p {
  color: var(--slate-700);
  font-size: 0.96rem;
  line-height: 1.7;
  margin-bottom: 16px;
}

/* FAQ */
.faq-item {
  border: 1px solid var(--slate-200);
  border-radius: var(--radius-md);
  margin-bottom: 12px;
  overflow: hidden;
  background: #fff;
}
.faq-q {
  width: 100%;
  padding: 16px 20px;
  text-align: left;
  background: #fff;
  border: none;
  font-family: 'Lexend', sans-serif;
  font-size: 0.98rem;
  font-weight: 700;
  color: var(--navy);
  cursor: pointer;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.faq-q:hover { background: var(--slate-50); }
.faq-a {
  padding: 0 20px 18px;
  color: var(--slate-700);
  font-size: 0.92rem;
  line-height: 1.65;
  display: none;
}
.faq-item.active .faq-a { display: block; }
.faq-item.active .faq-icon { transform: rotate(180deg); }
.faq-icon { transition: transform 0.2s; }
</style>

<?php require __DIR__ . '/../includes/navbar.php'; ?>

<main class="rm-page" id="konten-utama">

<!-- HERO -->
<section class="rm-hero">
  <div class="container">
    <div class="hero-badge">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="3" y1="15" x2="21" y2="15"/><line x1="9" y1="3" x2="9" y2="21"/><line x1="15" y1="3" x2="15" y2="21"/></svg>
      Standar ISO 31000:2018 &amp; HIRARC K3
    </div>
    <h1>Matriks Risiko 5x5 <span>K3 Online 2026</span></h1>
    <p>Hitung evaluasi risiko bahaya kerja secara akurat menggunakan matriks 5x5 interaktif. Tentukan nilai Peluang (Likelihood) dan Dampak Keparahan (Consequence), peroleh kategori risiko, dan susun dokumen Risk Register resmi.</p>
    <div class="hero-tags">
      <span class="hero-tag">Skala Likelihood 1 - 5</span>
      <span class="hero-tag">Skala Consequence 1 - 5</span>
      <span class="hero-tag">Level Risiko Low, Medium, High, Extreme</span>
      <span class="hero-tag">Tindakan Pengendalian ALARP</span>
    </div>
  </div>
</section>

<!-- MAIN MATRIX WORKSPACE -->
<section class="rm-wrapper">
  <div class="container">
    
    <div class="rm-grid">
      
      <!-- INTERACTIVE MATRIX COLUMN -->
      <div>
        <div class="card-box">
          <div class="card-header-line">
            <h2 class="card-title">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--orange)" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/></svg>
              Tabel Matriks Risiko 5x5
            </h2>
            <span style="font-size:0.8rem;color:var(--slate-600)">Klik salah satu sel untuk evaluasi instan:</span>
          </div>

          <!-- 5x5 GRID -->
          <div class="matrix-container" id="matrixGrid">
            <!-- Headers and cells generated dynamically -->
          </div>

          <!-- SLIDERS / SELECTORS -->
          <div class="control-row">
            <div class="control-label">
              <span>Peluang Terjadi (Likelihood)</span>
              <strong id="labelL" style="color:var(--orange)">Tingkat 3 - Mungkin Terjadi</strong>
            </div>
            <select id="selL" class="select-styled" onchange="onSelectChange()">
              <option value="1">1 - Sangat Jarang / Hampir Mustahil (Terjadi 1x > 5 tahun)</option>
              <option value="2">2 - Jarang Terjadi (Terjadi 1x dalam 2 - 5 tahun)</option>
              <option value="3" selected>3 - Mungkin / Sedang (Terjadi 1x dalam 1 tahun)</option>
              <option value="4">4 - Sering Terjadi (Terjadi beberapa kali per tahun)</option>
              <option value="5">5 - Hampir Pasti Terjadi (Terjadi rutin mingguan / bulanan)</option>
            </select>
          </div>

          <div class="control-row">
            <div class="control-label">
              <span>Keparahan Dampak (Consequence / Severity)</span>
              <strong id="labelC" style="color:var(--orange)">Tingkat 3 - Cedera Sedang (LTI)</strong>
            </div>
            <select id="selC" class="select-styled" onchange="onSelectChange()">
              <option value="1">1 - Tidak Signifikan (Tidak ada cedera, kerugian finansial nihil)</option>
              <option value="2">2 - Ringan (Perawatan P3K, tidak ada hari kerja hilang)</option>
              <option value="3" selected>3 - Sedang (Cedera LTI, rawat inap medis, hilang hari kerja)</option>
              <option value="4">4 - Berat (Cacat tetap permanen, kerusakan properti parah)</option>
              <option value="5">5 - Katastropik (Kematian / Fatalitas, pencemaran meluas)</option>
            </select>
          </div>

        </div>
      </div>

      <!-- EVALUATION & ACTION SUMMARY -->
      <div>
        <div class="card-box">
          <div class="card-header-line">
            <h2 class="card-title">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--orange)" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
              Hasil Evaluasi Risiko
            </h2>
            <span style="font-size:0.78rem;font-weight:700;color:var(--navy)">ISO 31000:2018</span>
          </div>

          <div class="risk-score-display" id="scoreBox">
            <div class="score-badge cell-med" id="scoreNum">9</div>
            <div class="score-cat" id="scoreCat" style="color:#713F12">SEDANG (MEDIUM RISK)</div>
            <div class="score-timeframe" id="scoreTime">Tindakan mitigasi diperlukan dalam waktu 7 hari kerja</div>
          </div>

          <div style="background:var(--slate-50);border:1px solid var(--slate-200);border-radius:var(--radius-md);padding:18px;margin-bottom:20px">
            <h4 style="font-size:0.9rem;font-weight:700;color:var(--navy);margin-bottom:8px">Ketentuan Pengendalian Wajib:</h4>
            <p id="actionGuide" style="font-size:0.86rem;color:var(--slate-700);line-height:1.6">
              Pekerjaan dapat dijalankan dengan pengawasan supervisor dan penerapan Standard Operating Procedure (SOP) yang diperketat serta APD standar.
            </p>
          </div>

          <div style="border-top:1px dashed var(--slate-300);padding-top:18px">
            <h4 style="font-size:0.9rem;font-weight:700;color:var(--navy);margin-bottom:12px">Tambahkan ke Risk Register:</h4>
            <div style="margin-bottom:10px">
              <input type="text" id="regActivity" class="select-styled" placeholder="Aktivitas / Bahaya (cth: Pekerjaan Las di Ketinggian)">
            </div>
            <div style="margin-bottom:14px">
              <input type="text" id="regControl" class="select-styled" placeholder="Rencana Pengendalian (cth: Pasang fire blanket & full body harness)">
            </div>
            <button class="select-styled" type="button" onclick="addToRiskRegister()" style="background:var(--orange);color:#fff;border:none;font-weight:700;cursor:pointer">
              + Tambah ke Tabel Risk Register
            </button>
          </div>

        </div>
      </div>

    </div>

    <!-- RISK REGISTER LIST -->
    <div class="card-box" id="regCard">
      <div class="card-header-line">
        <h2 class="card-title">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--orange)" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
          Daftar Rekapitulasi Risiko (Risk Register)
        </h2>
        <div style="display:flex;gap:8px">
          <button class="select-styled" type="button" onclick="printRiskRegister()" style="padding:6px 14px;font-size:0.82rem;font-weight:700;background:var(--navy);color:#fff;cursor:pointer">
            Cetak Risk Register
          </button>
        </div>
      </div>

      <div class="register-table-wrapper">
        <table class="reg-table" id="regTable">
          <thead>
            <tr>
              <th style="width:36px;text-align:center">No</th>
              <th>Aktivitas Kerja / Potensi Bahaya</th>
              <th style="width:50px;text-align:center">L</th>
              <th style="width:50px;text-align:center">C</th>
              <th style="width:80px;text-align:center">Skor</th>
              <th style="width:110px;text-align:center">Level</th>
              <th>Rencana Tindakan Pengendalian</th>
              <th style="width:40px;text-align:center">Aksi</th>
            </tr>
          </thead>
          <tbody id="regBody">
            <!-- Dynamic items -->
          </tbody>
        </table>
      </div>
    </div>

    <!-- IN-DEPTH EDITORIAL REFERENCE (SEO DEPTH) -->
    <div class="editorial-box">
      <h2 class="editorial-title">Panduan Lengkap Penilaian Risiko K3 Menggunakan Matriks 5x5</h2>
      <p class="editorial-p">
        Penilaian risiko keselamatan kerja merupakan fondasi utama sistem manajemen K3 modern sesuai dengan <strong>SNI ISO 31000:2018 (Manajemen Risiko — Pedoman)</strong> dan Lampiran Peraturan Pemerintah No. 50 Tahun 2012 tentang Penerapan SMK3. Matriks 5x5 menggabungkan probabilitas kemunculan bahaya dengan tingkat keparahan konsekuensi yang ditimbulkan.
      </p>

      <h3 style="color:var(--navy);font-family:'Lexend',sans-serif;font-size:1.15rem;margin:22px 0 10px">1. Klasifikasi 4 Tingkat Risiko (Risk Levels)</h3>
      <ul style="padding-left:22px;color:var(--slate-700);line-height:1.75;margin-bottom:18px">
        <li><strong>Ekstrem / Kritis (Skor 15 - 25):</strong> Risiko tidak dapat ditoleransi. Pekerjaan harus segera dihentikan seketika sampai tindakan rekayasa teknik dipasang. Wajib persetujuan Direktur Operasional.</li>
        <li><strong>Tinggi / High (Skor 10 - 14):</strong> Risiko signifikan yang memerlukan tindakan perbaikan mendesak dalam kurun waktu 24 jam. Wajib izin kerja khusus (PTW) dan pengawasan intensif HSE.</li>
        <li><strong>Sedang / Medium (Skor 5 - 9):</strong> Risiko dapat diterima dengan syarat pengendalian operasional, SOP, dan APD dipatuhi secara ketat. Mitigasi dijadwalkan dalam 7 hari kerja.</li>
        <li><strong>Rendah / Low (Skor 1 - 4):</strong> Risiko dapat diterima (Broadly Acceptable). Tindakan pencegahan rutin dan pemantauan berkala saat inspeksi K3 triwulanan.</li>
      </ul>

      <h3 style="color:var(--navy);font-family:'Lexend',sans-serif;font-size:1.15rem;margin:22px 0 10px">2. Konsep ALARP (As Low As Reasonably Practicable)</h3>
      <p class="editorial-p">
        Prinsip ALARP menetapkan bahwa tidak semua risiko di tempat kerja dapat diturunkan hingga nol mutlak (zero risk), namun setiap bahaya harus ditekan hingga ke titik di mana biaya tambahan untuk menurunkannya lagi akan sangat tidak proporsional dibanding penurunan risiko yang dicapai.
      </p>

      <!-- FAQ ACCORDION -->
      <h3 style="color:var(--navy);font-family:'Lexend',sans-serif;font-size:1.25rem;margin:28px 0 16px">Pertanyaan Sering Diajukan Seputar Matriks Risiko K3 (FAQ)</h3>
      <div class="faq-box">
        
        <div class="faq-item">
          <button class="faq-q" onclick="toggleFaq(this)">
            <span>Apa perbedaan antara Initial Risk (Risiko Awal) dan Residual Risk (Risiko Sisa)?</span>
            <span class="faq-icon">▼</span>
          </button>
          <div class="faq-a">
            Initial Risk adalah tingkat risiko murni dari suatu aktivitas kerja sebelum diterapkannya tindakan pengendalian keselamatan apa pun. Sedangkan Residual Risk (Risiko Sisa) adalah tingkat risiko yang masih tersisa setelah seluruh tindakan pencegahan (rekayasa teknik, SOP, APD) telah diimplementasikan secara efektif di lapangan.
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-q" onclick="toggleFaq(this)">
            <span>Mengapa matriks risiko 5x5 lebih dianjurkan dibanding matriks 3x3?</span>
            <span class="faq-icon">▼</span>
          </button>
          <div class="faq-a">
            Matriks 3x3 cenderung menghasilkan pengelompokan yang terlalu kasar (banyak bahaya menumpuk di kategori Sedang). Matriks 5x5 memberikan diferensiasi yang jauh lebih presisi dan terukur antara cedera ringan P3K, rawat inap medis (LTI), cacat permanen, hingga fatalitas, sehingga alokasi anggaran K3 perusahaan dapat diarahkan tepat sasaran pada bahaya paling kritis.
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-q" onclick="toggleFaq(this)">
            <span>Siapa yang harus melakukan evaluasi matriks risiko di perusahaan?</span>
            <span class="faq-icon">▼</span>
          </button>
          <div class="faq-a">
            Evaluasi matriks risiko wajib dilakukan secara multidisiplin oleh tim HIRADC yang terdiri dari: Penanggung jawab area kerja (Supervisor/Manager), Teknisi pelaksana pekerjaan yang memahami detail bahaya fisik, serta Ahli K3 Umum yang menguasai metodologi evaluasi risiko dan regulasi keselamatan nasional.
          </div>
        </div>

      </div>

    </div>

  </div>
</section>

</main>

<?php require __DIR__ . '/../includes/footer.php'; ?>

<script>
let curL = 3;
let curC = 3;

const matrixDefinitions = {
  // Score mapping: L x C
  getScore: (l, c) => l * c,
  getLevel: (score) => {
    if(score >= 15) return { cat: 'EKSTREM (EXTREME RISK)', cls: 'cell-ext', time: 'Hentikan pekerjaan seketika! Tindakan segera wajib.', text: 'Pekerjaan dilarang dimulai atau dilanjutkan. Sumber bahaya wajib diisolasi atau dieliminasi segera. Diperlukan otorisasi level Direksi untuk melanjutkan.' };
    if(score >= 10) return { cat: 'TINGGI (HIGH RISK)', cls: 'cell-high', time: 'Mitigasi wajib diterapkan dalam 24 jam kerja.', text: 'Diperlukan tindakan mitigasi spesifik, Izin Kerja Khusus (PTW), instruksi kerja ketat, dan supervisi langsung oleh HSE Officer.' };
    if(score >= 5)  return { cat: 'SEDANG (MEDIUM RISK)', cls: 'cell-med', time: 'Mitigasi diperlukan dalam 7 hari kerja.', text: 'Pekerjaan dapat dijalankan dengan pengawasan supervisor dan kepatuhan terhadap SOP operasional serta kelengkapan APD standar.' };
    return { cat: 'RENDAH (LOW RISK)', cls: 'cell-low', time: 'Tinjauan rutin saat inspeksi berkala.', text: 'Risiko dapat diterima secara luas (Broadly Acceptable). Lakukan pemantauan berkala dan pastikan pekerja memahami dasar keselamatan kerja.' };
  }
};

let riskRegister = [
  { activity: "Pengelasan pipa di atas perancah ketinggian 6 meter", l: 4, c: 4, score: 16, cat: "EKSTREM", control: "Pasang Full Body Harness 100% tie-off, fire blanket, & fire watch standby" },
  { activity: "Pengoperasian forklift di area lorong gudang bahan baku", l: 3, c: 3, score: 9, cat: "SEDANG", control: "Marka jalur pejalan kaki, batas kecepatan 10 km/jam, klakson blind spot" },
  { activity: "Penyusunan kardus arsip dokumen di lemari kantor", l: 2, c: 1, score: 2, cat: "RENDAH", control: "Gunakan tangga pijak step stool berkaki karet stabil" }
];

function initMatrix(){
  const grid = document.getElementById('matrixGrid');
  grid.innerHTML = '';

  // Top labels (Consequence 1 to 5)
  const headerX = document.createElement('div');
  headerX.className = 'matrix-header-x';
  headerX.textContent = 'KEPARAHAN DAMPAK (CONSEQUENCE) →';
  grid.appendChild(headerX);

  // Rows from L=5 down to L=1
  const lLabels = {
    5: '5 - Hampir Pasti',
    4: '4 - Sering',
    3: '3 - Mungkin',
    2: '2 - Jarang',
    1: '1 - S. Jarang'
  };

  for(let l = 5; l >= 1; l--){
    const yHeader = document.createElement('div');
    yHeader.className = 'matrix-header-y';
    yHeader.textContent = lLabels[l];
    grid.appendChild(yHeader);

    for(let c = 1; c <= 5; c++){
      const score = l * c;
      const info = matrixDefinitions.getLevel(score);
      const cell = document.createElement('div');
      cell.className = `matrix-cell ${info.cls}`;
      cell.id = `cell-${l}-${c}`;
      cell.innerHTML = `<span>${score}</span><small>L${l}xC${c}</small>`;
      cell.onclick = () => selectCell(l, c);
      grid.appendChild(cell);
    }
  }

  updateSelection();
  renderRiskRegister();
}

function selectCell(l, c){
  curL = l;
  curC = c;
  document.getElementById('selL').value = l;
  document.getElementById('selC').value = c;
  updateSelection();
}

function onSelectChange(){
  curL = parseInt(document.getElementById('selL').value);
  curC = parseInt(document.getElementById('selC').value);
  updateSelection();
}

function updateSelection(){
  document.querySelectorAll('.matrix-cell').forEach(c => c.classList.remove('selected'));
  const activeCell = document.getElementById(`cell-${curL}-${curC}`);
  if(activeCell) activeCell.classList.add('selected');

  const score = curL * curC;
  const info = matrixDefinitions.getLevel(score);

  const numEl = document.getElementById('scoreNum');
  numEl.textContent = score;
  numEl.className = `score-badge ${info.cls}`;

  const catEl = document.getElementById('scoreCat');
  catEl.textContent = info.cat;

  document.getElementById('scoreTime').textContent = info.time;
  document.getElementById('actionGuide').textContent = info.text;

  // Labels
  document.getElementById('labelL').textContent = `Tingkat ${curL}`;
  document.getElementById('labelC').textContent = `Tingkat ${curC}`;
}

function addToRiskRegister(){
  const act = document.getElementById('regActivity').value.trim();
  const ctrl = document.getElementById('regControl').value.trim();
  if(!act || !ctrl){
    alert('Mohon isi nama aktivitas dan rencana tindakan pengendalian!');
    return;
  }

  const score = curL * curC;
  const info = matrixDefinitions.getLevel(score);

  riskRegister.push({
    activity: act,
    l: curL,
    c: curC,
    score: score,
    cat: info.cat.split(' ')[0],
    control: ctrl
  });

  document.getElementById('regActivity').value = '';
  document.getElementById('regControl').value = '';
  renderRiskRegister();
}

function deleteRegItem(idx){
  riskRegister.splice(idx, 1);
  renderRiskRegister();
}

function renderRiskRegister(){
  const tbody = document.getElementById('regBody');
  tbody.innerHTML = '';

  riskRegister.forEach((item, idx) => {
    const info = matrixDefinitions.getLevel(item.score);
    const tr = document.createElement('tr');
    tr.innerHTML = `
      <td style="text-align:center;font-weight:bold;color:var(--slate-600)">${idx + 1}</td>
      <td><strong>${escapeHtml(item.activity)}</strong></td>
      <td style="text-align:center">${item.l}</td>
      <td style="text-align:center">${item.c}</td>
      <td style="text-align:center;font-weight:bold">${item.score}</td>
      <td style="text-align:center"><span style="padding:2px 8px;border-radius:4px;font-size:0.75rem;font-weight:bold" class="${info.cls}">${item.cat}</span></td>
      <td>${escapeHtml(item.control)}</td>
      <td style="text-align:center">
        <button style="border:none;background:#FEE2E2;color:#991B1B;padding:2px 8px;border-radius:4px;cursor:pointer;font-weight:bold" onclick="deleteRegItem(${idx})">✕</button>
      </td>
    `;
    tbody.appendChild(tr);
  });
}

function escapeHtml(text){
  return String(text).replace(/[&<>"']/g, function(m){
    return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m];
  });
}

function printRiskRegister(){
  const win = window.open('', '_blank');
  win.document.write(`<!DOCTYPE html><html><head><title>Risk Register K3 - ISO 31000</title>
  <style>
    body{font-family:'Segoe UI',Arial,sans-serif;padding:32px;max-width:860px;margin:0 auto;color:#0F172A;line-height:1.5}
    h1{font-size:16pt;margin:0;color:#0D233A;border-bottom:2px solid #0D233A;padding-bottom:8px}
    .sub{font-size:8.5pt;color:#64748B;margin:6px 0 16px}
    table{width:100%;border-collapse:collapse;margin-top:12px;font-size:9pt}
    th,td{border:1px solid #CBD5E1;padding:8px 10px;text-align:left}
    th{background:#F1F5F9;color:#0D233A}
    .sig{margin-top:40px;display:grid;grid-template-columns:1fr 1fr;gap:40px;text-align:center;font-size:9pt}
    .line{margin-top:60px;border-top:1px solid #000;font-weight:bold}
  </style>
  </head><body>
  <h1>DOKUMEN RISK REGISTER K3 (HIRARC)</h1>
  <div class="sub">Berdasarkan Standar Evaluasi Matriks 5x5 ISO 31000:2018 &amp; SMK3 PP 50/2012</div>
  <table>
    <thead>
      <tr>
        <th style="width:30px">No</th>
        <th>Aktivitas Kerja / Potensi Bahaya</th>
        <th style="width:40px">L</th>
        <th style="width:40px">C</th>
        <th style="width:50px">Skor</th>
        <th style="width:90px">Level</th>
        <th>Rencana Tindakan Pengendalian</th>
      </tr>
    </thead>
    <tbody>
      ${riskRegister.map((r, i) => `
        <tr>
          <td style="text-align:center">${i+1}</td>
          <td><strong>${escapeHtml(r.activity)}</strong></td>
          <td style="text-align:center">${r.l}</td>
          <td style="text-align:center">${r.c}</td>
          <td style="text-align:center"><strong>${r.score}</strong></td>
          <td style="text-align:center">${r.cat}</td>
          <td>${escapeHtml(r.control)}</td>
        </tr>
      `).join('')}
    </tbody>
  </table>
  <div class="sig">
    <div>Divalidasi oleh,<br><strong>Ahli K3 Umum / HSE Manager</strong><div class="line">( ___________________________ )</div></div>
    <div>Disetujui oleh,<br><strong>General Manager / Kepala Operasi</strong><div class="line">( ___________________________ )</div></div>
  </div>
  </body></html>`);
  win.document.close();
  win.print();
}

function toggleFaq(btn){
  btn.parentElement.classList.toggle('active');
}

window.addEventListener('DOMContentLoaded', initMatrix);
</script>

<?php require __DIR__ . '/../includes/scripts.php'; ?>
</body>
</html>
