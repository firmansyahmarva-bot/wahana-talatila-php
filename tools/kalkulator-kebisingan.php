<?php
require_once __DIR__ . '/../config.php';
$s = get_all_settings();

$page_title = 'Kalkulator Kebisingan K3 2026: Dosis Paparan Permenaker 5/2018 & TWA';
$meta_desc = 'Kalkulator dosis paparan kebisingan tempat kerja sesuai Permenaker No. 5/2018 & OSHA. Hitung Dosis Harian (%), TWA 8 Jam (dBA), batas waktu pajanan, serta proteksi NRR earplug & earmuff.';

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
    { "@type": "ListItem", "position": 3, "name": "Kalkulator Kebisingan", "item": "https://wahanatotalita.com/tools/kalkulator-kebisingan/" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebApplication",
  "name": "Kalkulator Paparan Kebisingan K3 Online",
  "url": "https://wahanatotalita.com/tools/kalkulator-kebisingan/",
  "description": "Perhitungan dosis kebisingan kumulatif, Time Weighted Average (TWA), dan uji efektivitas APD pendengaran sesuai Permenaker No. 5 Tahun 2018.",
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
      "name": "Berapa Nilai Ambang Batas (NAB) kebisingan resmi di Indonesia?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Berdasarkan Permenaker No. 5 Tahun 2018 tentang K3 Lingkungan Kerja, Nilai Ambang Batas (NAB) kebisingan untuk waktu kerja 8 jam per hari atau 40 jam per minggu adalah 85 dBA dengan exchange rate 3 dB."
      }
    },
    {
      "@type": "Question",
      "name": "Bagaimana aturan penggandaan waktu pajanan kebisingan (3 dB exchange rate)?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Setiap kenaikan intensitas suara sebesar 3 dBA, batas waktu pemaparan yang diizinkan dipotong menjadi setengahnya. Sebagai contoh: 85 dBA diizinkan 8 jam, 88 dBA diizinkan 4 jam, 91 dBA diizinkan 2 jam, 94 dBA diizinkan 1 jam, dan pada 100 dBA hanya diizinkan maksimal 15 menit per hari tanpa APD."
      }
    },
    {
      "@type": "Question",
      "name": "Mengapa nilai NRR pada kemasan earplug / earmuff harus dikurangi (derated)?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Nilai NRR (Noise Reduction Rating) dari pabrikan diuji di laboratorium ideal. Standar OSHA dan NIOSH mensyaratkan derating karena di lapangan terdapat kebocoran pemasangan, rambut, kacamata, dan pergerakan rahang. Rumus OSHA mengoreksi NRR earplug dengan derating 50% setelah dikurangi 7 dB: Proteksi Riil = (NRR - 7) × 0.5."
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
.noise-hero {
  background: linear-gradient(135deg, #071524 0%, #0D233A 60%, #183654 100%);
  color: #fff;
  padding: 58px 0 44px;
  position: relative;
  overflow: hidden;
  border-bottom: 3px solid var(--orange);
}
.noise-hero::before {
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
.noise-hero h1 {
  font-family: 'Lexend', sans-serif;
  font-size: clamp(1.8rem, 3.6vw, 2.7rem);
  font-weight: 800;
  line-height: 1.2;
  margin-bottom: 12px;
}
.noise-hero h1 span { color: var(--orange); }
.noise-hero p {
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
.noise-wrapper { padding: 40px 0 60px; }
.noise-grid {
  display: grid;
  grid-template-columns: 1.15fr 0.85fr;
  gap: 32px;
  align-items: start;
}
@media (max-width: 992px) {
  .noise-grid { grid-template-columns: 1fr; }
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

/* NOISE EXPOSURE TABLE */
.noise-table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 18px;
  font-size: 0.9rem;
}
.noise-table th {
  background: var(--navy);
  color: #fff;
  padding: 10px 12px;
  text-align: left;
  font-size: 0.82rem;
}
.noise-table td {
  padding: 10px 12px;
  border-bottom: 1px solid var(--slate-200);
  vertical-align: middle;
}
.noise-input {
  width: 100%;
  padding: 8px 10px;
  border: 1.5px solid var(--slate-200);
  border-radius: 6px;
  font-size: 0.9rem;
}
.noise-input:focus { outline: none; border-color: var(--orange); }

.btn-add-source {
  background: var(--slate-100);
  border: 1.5px solid var(--slate-300);
  color: var(--navy);
  padding: 8px 16px;
  border-radius: 8px;
  font-size: 0.84rem;
  font-weight: 700;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 6px;
}
.btn-add-source:hover { background: var(--slate-200); }

/* APD DERATING CALCULATOR */
.apd-box {
  background: var(--slate-50);
  border: 1px solid var(--slate-200);
  border-radius: var(--radius-md);
  padding: 18px;
  margin-top: 20px;
}
.apd-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 14px;
  margin-top: 12px;
}
@media (max-width: 600px) {
  .apd-grid { grid-template-columns: 1fr; }
}

/* RESULTS PANEL */
.result-stat-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 16px;
  margin-bottom: 22px;
}
.stat-card {
  background: var(--slate-50);
  border: 1px solid var(--slate-200);
  border-radius: var(--radius-md);
  padding: 16px;
  position: relative;
  overflow: hidden;
}
.stat-card.featured {
  background: linear-gradient(145deg, #0D233A 0%, #183654 100%);
  color: #fff;
  border-color: #0D233A;
}
.stat-card.featured .stat-meta { color: #FFA573; }
.stat-card.featured .stat-val { color: #fff; }
.stat-card.featured .stat-desc { color: #CBD5E1; }
.stat-card::after {
  content: "";
  position: absolute;
  top: 0; left: 0;
  width: 4px; height: 100%;
  background: var(--orange);
}
.stat-meta {
  font-size: 0.76rem;
  font-weight: 700;
  text-transform: uppercase;
  color: var(--slate-600);
  letter-spacing: 0.04em;
  margin-bottom: 4px;
}
.stat-val {
  font-family: 'Lexend', sans-serif;
  font-size: 1.8rem;
  font-weight: 800;
  color: var(--navy);
  line-height: 1.1;
  margin-bottom: 4px;
}
.stat-desc { font-size: 0.8rem; color: var(--slate-600); }

.status-box {
  padding: 14px 18px;
  border-radius: var(--radius-md);
  font-weight: 700;
  margin-bottom: 20px;
  display: flex;
  align-items: center;
  gap: 12px;
  font-size: 0.92rem;
}
.status-safe { background: #DCFCE7; color: #166534; border: 1px solid #BBF7D0; }
.status-warn { background: #FEF3C7; color: #92400E; border: 1px solid #FDE68A; }
.status-danger { background: #FEE2E2; color: #991B1B; border: 1px solid #FECACA; }

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
.ref-table {
  width: 100%;
  border-collapse: collapse;
  font-size: 0.88rem;
  margin: 20px 0;
}
.ref-table th {
  background: var(--navy);
  color: #fff;
  padding: 10px 14px;
  text-align: left;
}
.ref-table td {
  padding: 9px 14px;
  border-bottom: 1px solid var(--slate-200);
  color: var(--slate-700);
}
.ref-table tr:nth-child(even) td { background: var(--slate-50); }

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

<main class="noise-page" id="konten-utama">

<!-- HERO -->
<section class="noise-hero">
  <div class="container">
    <div class="hero-badge">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" y1="19" x2="12" y2="23"/><line x1="8" y1="23" x2="16" y2="23"/></svg>
      Permenaker No. 5 Tahun 2018 &amp; OSHA 1910.95
    </div>
    <h1>Kalkulator Paparan Kebisingan <span>K3 2026</span></h1>
    <p>Hitung Dosis Kebisingan Kumulatif (Noise Dose %), Time-Weighted Average (TWA 8-Jam), batas durasi pajanan maksimal yang diizinkan, serta evaluasi perlindungan riil APD pendengaran (NRR Derating).</p>
    <div class="hero-tags">
      <span class="hero-tag">NAB Resmi: 85 dBA / 8 Jam</span>
      <span class="hero-tag">Exchange Rate 3 dB</span>
      <span class="hero-tag">Dosis D = Σ (C / T) × 100%</span>
      <span class="hero-tag">OSHA NRR Derating Earplug &amp; Earmuff</span>
    </div>
  </div>
</section>

<!-- MAIN WORKSPACE -->
<section class="noise-wrapper">
  <div class="container">
    
    <div class="noise-grid">
      
      <!-- INPUT COLUMN -->
      <div>
        <div class="card-box">
          <div class="card-header-line">
            <h2 class="card-title">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--orange)" stroke-width="2"><path d="M11 5L6 9H2v6h4l5 4V5z"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14M15.54 8.46a5 5 0 0 1 0 7.07"/></svg>
              Tabel Sumber &amp; Durasi Paparan
            </h2>
            <button class="btn-add-source" type="button" onclick="addNoiseRow()">
              + Tambah Sumber Kebisingan
            </button>
          </div>

          <table class="noise-table" id="noiseTable">
            <thead>
              <tr>
                <th>Area / Mesin Operasional</th>
                <th style="width:110px">Tingkat (dBA)</th>
                <th style="width:110px">Durasi (Jam)</th>
                <th style="width:110px">Batas Izin (T)</th>
                <th style="width:36px;text-align:center">Hapus</th>
              </tr>
            </thead>
            <tbody id="noiseBody">
              <!-- Dynamically populated -->
            </tbody>
          </table>

          <!-- APD DERATING CALCULATOR -->
          <div class="apd-box">
            <div style="font-weight:700;color:var(--navy);font-size:0.92rem;display:flex;align-items:center;gap:8px">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 18v-6a9 9 0 0 1 18 0v6"/><path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"/></svg>
              Kalkulator Efektivitas Alat Pelindung Diri (HPD NRR)
            </div>
            
            <div class="apd-grid">
              <div>
                <label style="display:block;font-size:0.8rem;font-weight:700;color:var(--slate-700);margin-bottom:4px">Jenis Pelindung Telinga</label>
                <select id="hpdType" class="noise-input" onchange="calcNoise()">
                  <option value="plug">Earplug Sumbat Telinga (OSHA 50% Derate)</option>
                  <option value="muff">Earmuff Tutup Telinga (OSHA 70% Derate)</option>
                  <option value="dual">Dual Protection (Earplug + Earmuff)</option>
                </select>
              </div>
              <div>
                <label style="display:block;font-size:0.8rem;font-weight:700;color:var(--slate-700);margin-bottom:4px">Label NRR Pabrikan (dB)</label>
                <input type="number" id="hpdNrr" class="noise-input" value="28" min="0" max="40" oninput="calcNoise()">
              </div>
            </div>
          </div>

        </div>
      </div>

      <!-- RESULTS COLUMN -->
      <div>
        <div class="card-box">
          <div class="card-header-line">
            <h2 class="card-title">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--orange)" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
              Hasil Evaluasi Pajanan
            </h2>
            <span style="font-size:0.78rem;font-weight:700;color:var(--orange);background:var(--orange-light);padding:4px 8px;border-radius:4px">
              Permenaker 5/2018
            </span>
          </div>

          <div id="statusBadge" class="status-box status-safe">
            <span id="statusIcon">✓</span>
            <span id="statusText">Paparan kebisingan masih berada dalam batas aman NAB.</span>
          </div>

          <div class="result-stat-grid">
            
            <div class="stat-card featured">
              <div class="stat-meta">Dosis Kebisingan (D)</div>
              <div class="stat-val" id="outDose">68.5%</div>
              <div class="stat-desc">Batas maksimum aman: 100% per 8 jam</div>
            </div>

            <div class="stat-card featured">
              <div class="stat-meta">Equivalent TWA 8-Jam</div>
              <div class="stat-val" id="outTwa">82.3 dBA</div>
              <div class="stat-desc">NAB Permenaker: 85 dBA</div>
            </div>

            <div class="stat-card">
              <div class="stat-meta">Proteksi Riil APD</div>
              <div class="stat-val" id="outHpdProt">10.5 dBA</div>
              <div class="stat-desc">Setelah derating koreksi OSHA</div>
            </div>

            <div class="stat-card">
              <div class="stat-meta">Paparan di Telinga</div>
              <div class="stat-val" id="outAtEar">71.8 dBA</div>
              <div class="stat-desc">Tingkat suara yang masuk gendang telinga</div>
            </div>

          </div>

          <div style="background:var(--slate-50);border:1px solid var(--slate-200);border-radius:var(--radius-md);padding:16px;font-size:0.84rem;color:var(--slate-700);line-height:1.6">
            <strong>Rekomendasi Tindakan K3:</strong>
            <ul style="padding-left:18px;margin-top:6px" id="rekomendasiList">
              <li>Lakukan pemantauan lingkungan kerja periodik 6 bulan sekali.</li>
              <li>Wajibkan audiometri berkala tahunan untuk pekerja di zona kebisingan > 85 dBA.</li>
            </ul>
          </div>

          <button class="noise-input" type="button" onclick="printNoiseReport()" style="margin-top:18px;background:var(--orange);color:#fff;border:none;font-weight:700;padding:12px;cursor:pointer">
            Cetak Laporan Penilaian Kebisingan
          </button>

        </div>
      </div>

    </div>

    <!-- IN-DEPTH EDITORIAL ARTICLE (SEO DEPTH) -->
    <div class="editorial-box">
      <h2 class="editorial-title">Dasar Hukum &amp; Standar Kebisingan Tempat Kerja di Indonesia</h2>
      <p class="editorial-p">
        Pengendalian faktor fisik kebisingan diatur secara mengikat melalui <strong>Peraturan Menteri Ketenagakerjaan RI No. 5 Tahun 2018 tentang Keselamatan dan Kesehatan Kerja Lingkungan Kerja</strong>. Kebisingan diartikan sebagai semua suara yang tidak dikehendaki yang bersumber dari alat-alat proses produksi dan/atau alat-alat kerja yang pada tingkat tertentu dapat menimbulkan gangguan pendengaran.
      </p>

      <h3 style="color:var(--navy);font-family:'Lexend',sans-serif;font-size:1.15rem;margin:22px 0 10px">Tabel Resmi Batas Waktu Pemaparan Kebisingan (Permenaker 5/2018)</h3>
      <table class="ref-table">
        <thead>
          <tr>
            <th>Intensitas Kebisingan (dBA)</th>
            <th>Waktu Pemaparan Maksimal per Hari Kerja</th>
            <th>Keterangan Kategori</th>
          </tr>
        </thead>
        <tbody>
          <tr><td>85 dBA</td><td><strong>8 Jam</strong></td><td>Nilai Ambang Batas Standar (NAB)</td></tr>
          <tr><td>88 dBA</td><td><strong>4 Jam</strong></td><td>Kenaikan 3 dB = Waktu Berkurang 50%</td></tr>
          <tr><td>91 dBA</td><td><strong>2 Jam</strong></td><td>Wajib APD &amp; Audiometri Tahunan</td></tr>
          <tr><td>94 dBA</td><td><strong>1 Jam</strong></td><td>Wajib Rotasi Kerja</td></tr>
          <tr><td>97 dBA</td><td><strong>30 Menit</strong></td><td>Zona Kebisingan Tinggi</td></tr>
          <tr><td>100 dBA</td><td><strong>15 Menit</strong></td><td>Area Sangat Bising</td></tr>
          <tr><td>103 dBA</td><td><strong>7.5 Menit</strong></td><td>Batas Sangat Kritis</td></tr>
          <tr><td>115 dBA</td><td><strong>28.12 Detik</strong></td><td>Bahaya Langsung Pendengaran</td></tr>
          <tr><td>140 dBA</td><td><strong>Tidak Boleh Terpapar (0 Detik)</strong></td><td>Batas Maksimum Mutlak (Impulsif)</td></tr>
        </tbody>
      </table>

      <h3 style="color:var(--navy);font-family:'Lexend',sans-serif;font-size:1.15rem;margin:22px 0 10px">Rumus Perhitungan Dosis Kebisingan Kumulatif</h3>
      <p class="editorial-p">
        Apabila seorang tenaga kerja bekerja di berbagai ruangan dengan intensitas bising yang bervariasi sepanjang giliran kerja (shift), maka dosis paparan kumulatif dihitung dengan rumus:
      </p>
      <div style="background:var(--slate-100);padding:14px 18px;border-radius:8px;font-family:monospace;font-size:0.95rem;color:var(--navy);margin-bottom:16px">
        Dosis (D) = [ (C1 / T1) + (C2 / T2) + ... + (Cn / Tn) ] × 100%
      </div>
      <p class="editorial-p">
        Di mana <em>C</em> adalah durasi aktual pekerja berada di area bising tersebut (dalam jam), dan <em>T</em> adalah batas waktu paparan maksimum yang diizinkan untuk intensitas kebisingan tersebut berdasarkan tabel Permenaker 5/2018. Jika nilai <strong>Dosis (D) melebihi 100%</strong>, maka paparan dinyatakan MELAMPAUI Nilai Ambang Batas.
      </p>

      <!-- FAQ ACCORDION -->
      <h3 style="color:var(--navy);font-family:'Lexend',sans-serif;font-size:1.25rem;margin:28px 0 16px">Tanya Jawab Seputar Kebisingan Tempat Kerja (FAQ)</h3>
      <div class="faq-box">
        
        <div class="faq-item">
          <button class="faq-q" onclick="toggleFaq(this)">
            <span>Apa itu Noise Induced Hearing Loss (NIHL)?</span>
            <span class="faq-icon">▼</span>
          </button>
          <div class="faq-a">
            Noise Induced Hearing Loss (NIHL) atau Tuli Akibat Kebisingan (TAK) adalah penyakit akibat kerja (PAK) yang menyebabkan kerusakan permanen pada sel-sel rambut sensorik di dalam koklea telinga bagian dalam akibat paparan suara keras secara terus menerus dalam jangka panjang. NIHL bersifat menetap, tidak dapat disembuhkan secara medis, namun 100% dapat dicegah dengan manajemen K3 yang tepat.
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-q" onclick="toggleFaq(this)">
            <span>Kapan perusahaan wajib menyelenggarakan program Hearing Conservation Program (HCP)?</span>
            <span class="faq-icon">▼</span>
          </button>
          <div class="faq-a">
            Program Konservasi Pendengaran (HCP) wajib diterapkan oleh perusahaan apabila hasil pengukuran lingkungan kerja menunjukkan tingkat kebisingan mencapai atau melampaui Action Level 82 dBA (atau 85 dBA TWA 8-jam). Komponen HCP meliputi: survei pemetaan kebisingan, pengendalian teknik/mesin, uji audiometri berkala bagi pekerja, penyediaan APD yang teruji, serta edukasi K3.
          </div>
        </div>

      </div>

    </div>

  </div>
</section>

</main>

<?php require __DIR__ . '/../includes/footer.php'; ?>

<script>
let noiseRows = [
  { area: "Ruang Genset / Kompresor", dba: 91, hours: 1.5 },
  { area: "Lantai Produksi Mesin Stamping", dba: 88, hours: 3.0 },
  { area: "Ruang Kontrol / Office", dba: 70, hours: 3.5 }
];

// Reference T for Permenaker 5/2018 (3dB exchange rate, 85dB = 8h)
function getAllowedTime(dba){
  if(dba <= 80) return 24;
  return 8 / Math.pow(2, (dba - 85) / 3);
}

function initNoiseTable(){
  const tbody = document.getElementById('noiseBody');
  tbody.innerHTML = '';

  noiseRows.forEach((r, idx) => {
    const tAllowed = getAllowedTime(r.dba);
    const tr = document.createElement('tr');
    tr.innerHTML = `
      <td><input type="text" class="noise-input" value="${escapeHtml(r.area)}" onchange="updateNoiseRow(${idx}, 'area', this.value)"></td>
      <td><input type="number" class="noise-input" value="${r.dba}" min="50" max="140" oninput="updateNoiseRow(${idx}, 'dba', this.value)"></td>
      <td><input type="number" class="noise-input" value="${r.hours}" min="0" max="24" step="0.25" oninput="updateNoiseRow(${idx}, 'hours', this.value)"></td>
      <td style="font-weight:bold;color:var(--navy)">${formatHours(tAllowed)}</td>
      <td style="text-align:center">
        <button style="border:none;background:#FEE2E2;color:#991B1B;padding:4px 8px;border-radius:4px;cursor:pointer;font-weight:bold" onclick="delNoiseRow(${idx})">✕</button>
      </td>
    `;
    tbody.appendChild(tr);
  });

  calcNoise();
}

function updateNoiseRow(idx, field, val){
  if(noiseRows[idx]){
    noiseRows[idx][field] = field === 'area' ? val : parseFloat(val) || 0;
    initNoiseTable();
  }
}

function addNoiseRow(){
  noiseRows.push({ area: "Area Kerja Baru", dba: 85, hours: 2 });
  initNoiseTable();
}

function delNoiseRow(idx){
  if(noiseRows.length <= 1){
    alert('Minimal harus ada 1 sumber kebisingan!');
    return;
  }
  noiseRows.splice(idx, 1);
  initNoiseTable();
}

function formatHours(h){
  if(h >= 24) return "> 24 Jam";
  if(h >= 1) return h.toFixed(2) + " Jam";
  const mins = h * 60;
  if(mins >= 1) return mins.toFixed(1) + " Menit";
  return (mins * 60).toFixed(0) + " Detik";
}

function calcNoise(){
  let totalDose = 0;
  let maxDba = 0;

  noiseRows.forEach(r => {
    const tAllowed = getAllowedTime(r.dba);
    if(tAllowed > 0){
      totalDose += (r.hours / tAllowed);
    }
    if(r.dba > maxDba) maxDba = r.dba;
  });

  const dosePercent = totalDose * 100;
  
  // Equivalent TWA 8h
  let twa = 0;
  if(totalDose > 0){
    twa = 16.61 * Math.log10(totalDose) + 85;
  } else {
    twa = 0;
  }

  // APD Derating
  const hpdType = document.getElementById('hpdType').value;
  const nrr = parseFloat(document.getElementById('hpdNrr').value) || 0;
  let prot = 0;

  if(hpdType === 'plug'){
    prot = Math.max(0, (nrr - 7) * 0.5);
  } else if(hpdType === 'muff'){
    prot = Math.max(0, (nrr - 7) * 0.7);
  } else if(hpdType === 'dual'){
    prot = Math.max(0, (nrr - 7) * 0.7) + 5;
  }

  const atEar = Math.max(0, maxDba - prot);

  document.getElementById('outDose').textContent = dosePercent.toFixed(1) + '%';
  document.getElementById('outTwa').textContent = twa.toFixed(1) + ' dBA';
  document.getElementById('outHpdProt').textContent = prot.toFixed(1) + ' dBA';
  document.getElementById('outAtEar').textContent = atEar.toFixed(1) + ' dBA';

  const badge = document.getElementById('statusBadge');
  const txt = document.getElementById('statusText');
  const icon = document.getElementById('statusIcon');
  const reco = document.getElementById('rekomendasiList');

  if(dosePercent > 100 || twa > 85){
    badge.className = 'status-box status-danger';
    icon.textContent = '⚠️';
    txt.textContent = 'BAHAYA: Dosis paparan kebisingan MELAMPAUI Nilai Ambang Batas (NAB)!';
    reco.innerHTML = `
      <li>Wajib pasang rambu peringatan kewajiban APD pendengaran (Hearing Protection Zone).</li>
      <li>Terapkan pengendalian teknis (enclosure mesin bising, isolasi getaran, silencer).</li>
      <li>Batasi waktu kerja / rotasi tenaga kerja agar dosis harian di bawah 100%.</li>
      <li>Lakukan pemeriksaan audiometri berkala setiap tahun bagi pekerja terpapar.</li>
    `;
  } else if(dosePercent > 50 || twa >= 82){
    badge.className = 'status-box status-warn';
    icon.textContent = '⚡';
    txt.textContent = 'WASPADA: Paparan mendekati batas NAB (Action Level > 82 dBA).';
    reco.innerHTML = `
      <li>Sediakan APD penutup telinga dan pastikan dipakai dengan benar.</li>
      <li>Lakukan pemeliharaan rutin pada mesin untuk mengurangi getaran suara.</li>
      <li>Lakukan monitoring lingkungan kerja secara periodik.</li>
    `;
  } else {
    badge.className = 'status-box status-safe';
    icon.textContent = '✓';
    txt.textContent = 'AMAN: Paparan kebisingan berada di bawah Nilai Ambang Batas (NAB).';
    reco.innerHTML = `
      <li>Tingkat kebisingan aman untuk shift kerja standar 8 jam/hari.</li>
      <li>Pertahankan pemeliharaan mesin secara berkala.</li>
    `;
  }
}

function escapeHtml(text){
  return String(text).replace(/[&<>"']/g, function(m){
    return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m];
  });
}

function printNoiseReport(){
  const dose = document.getElementById('outDose').textContent;
  const twa = document.getElementById('outTwa').textContent;
  const prot = document.getElementById('outHpdProt').textContent;
  const atEar = document.getElementById('outAtEar').textContent;

  const win = window.open('', '_blank');
  win.document.write(`<!DOCTYPE html><html><head><title>Laporan Penilaian Paparan Kebisingan</title>
  <style>
    body{font-family:'Segoe UI',Arial,sans-serif;padding:32px;max-width:760px;margin:0 auto;color:#0F172A;line-height:1.5}
    h1{font-size:16pt;margin:0;color:#0D233A;border-bottom:2px solid #0D233A;padding-bottom:8px}
    .sub{font-size:8.5pt;color:#64748B;margin:6px 0 16px}
    table{width:100%;border-collapse:collapse;margin:16px 0;font-size:9pt}
    th,td{border:1px solid #CBD5E1;padding:8px 10px;text-align:left}
    th{background:#F1F5F9;color:#0D233A}
    .sig{margin-top:40px;display:grid;grid-template-columns:1fr 1fr;gap:40px;text-align:center;font-size:9pt}
    .line{margin-top:60px;border-top:1px solid #000;font-weight:bold}
  </style>
  </head><body>
  <h1>LAPORAN EVALUASI PAPARAN KEBISINGAN TEMPAT KERJA</h1>
  <div class="sub">Standar Permenaker RI No. 5 Tahun 2018 tentang K3 Lingkungan Kerja</div>
  <table>
    <tr><th>Area / Sumber Mesin</th><th>Tingkat Bising (dBA)</th><th>Durasi Paparan</th><th>Batas Waktu Izin</th></tr>
    ${noiseRows.map(r => `<tr><td>${escapeHtml(r.area)}</td><td>${r.dba} dBA</td><td>${r.hours} Jam</td><td>${formatHours(getAllowedTime(r.dba))}</td></tr>`).join('')}
  </table>
  <h3>Hasil Evaluasi Kumulatif:</h3>
  <table>
    <tr><td>Total Dosis Paparan Kebisingan (D)</td><td><strong>${dose}</strong></td></tr>
    <tr><td>Time-Weighted Average 8-Jam (TWA)</td><td><strong>${twa}</strong></td></tr>
    <tr><td>Proteksi Riil APD (NRR Derated)</td><td><strong>${prot}</strong></td></tr>
    <tr><td>Tingkat Kebisingan Efektif di Telinga</td><td><strong>${atEar}</strong></td></tr>
  </table>
  <div class="sig">
    <div>Diperiksa oleh,<br><strong>Ahli K3 Lingkungan Kerja</strong><div class="line">( ___________________________ )</div></div>
    <div>Mengetahui,<br><strong>Pimpinan Pabrik / HSE Manager</strong><div class="line">( ___________________________ )</div></div>
  </div>
  </body></html>`);
  win.document.close();
  win.print();
}

function toggleFaq(btn){
  btn.parentElement.classList.toggle('active');
}

window.addEventListener('DOMContentLoaded', initNoiseTable);
</script>

<?php require __DIR__ . '/../includes/scripts.php'; ?>
</body>
</html>
