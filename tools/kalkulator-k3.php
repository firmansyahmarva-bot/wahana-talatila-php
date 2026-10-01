<?php
require_once __DIR__ . '/../config.php';
$s = get_all_settings();

$page_title = 'Kalkulator K3 Online 2026: Hitung FR, SR, IR, AFR & Safe T-Score (Kepmenaker & OSHA)';
$meta_desc = 'Kalkulator statistik K3 terlengkap sesuai Kepmenaker No. KEP.372/MEN/1989 dan OSHA 1904. Hitung Frequency Rate (FR), Severity Rate (SR), Safe T-Score, dan cetak laporan P2K3 gratis.';

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
    { "@type": "ListItem", "position": 3, "name": "Kalkulator K3", "item": "https://wahanatotalita.com/tools/kalkulator-k3.php" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebApplication",
  "name": "Kalkulator Statistik K3 Online Indonesia",
  "url": "https://wahanatotalita.com/tools/kalkulator-k3.php",
  "description": "Perhitungan statistik K3 resmi Kemnaker RI (Kepmenaker 372/1989) & OSHA: FR, SR, IR, LTIFR, Safe T-Score, dan Piramida Heinrich.",
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
      "name": "Apa perbedaan standar pengali 1.000.000 jam kerja dan 200.000 jam kerja?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Standar 1.000.000 jam kerja adalah standar resmi Depnaker/Kemnaker RI berdasarkan Kepmenaker No. KEP.372/MEN/1989 dan ILO, mewakili sekitar 500 pekerja penuh waktu selama 1 tahun. Sedangkan standar 200.000 jam kerja mengacu pada US OSHA (Occupational Safety and Health Administration), mewakili 100 pekerja penuh waktu selama 1 tahun (100 pekerja x 40 jam/minggu x 50 minggu kerja)."
      }
    },
    {
      "@type": "Question",
      "name": "Bagaimana cara membaca nilai Safe T-Score?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Safe T-Score digunakan untuk membandingkan kinerja K3 periode saat ini dengan periode sebelumnya. Jika nilai Safe T-Score di antara -2.00 hingga +2.00, perbedaannya dianggap fluktuasi normal. Jika skor lebih kecil dari -2.00, performa K3 membaik secara signifikan. Jika skor lebih besar dari +2.00, performa K3 memburuk secara signifikan dan memerlukan investigasi akar penyebab segera."
      }
    },
    {
      "@type": "Question",
      "name": "Berapa hari kerja hilang yang dihitung untuk kasus kecelakaan fatal atau cacat tetap total?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Sesuai Kepmenaker KEP.372/MEN/1989 dan ANSI Z16.1, untuk kasus kecelakaan fatal (kematian) dan cacat total permanen (kehilangan fungsi kedua mata, kedua tangan, atau kelumpuhan total), beban hari kerja hilang yang dibebankan adalah 6.000 hari kerja (man-days lost)."
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
  --shadow-md: 0 8px 24px rgba(13,35,58,0.1);
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
.calc-hero {
  background: linear-gradient(135deg, #071524 0%, #0D233A 60%, #183654 100%);
  color: #fff;
  padding: 60px 0 46px;
  position: relative;
  overflow: hidden;
  border-bottom: 3px solid var(--orange);
}
.calc-hero::before {
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
.calc-hero h1 {
  font-family: 'Lexend', sans-serif;
  font-size: clamp(1.8rem, 3.6vw, 2.8rem);
  font-weight: 800;
  line-height: 1.2;
  margin-bottom: 12px;
}
.calc-hero h1 span { color: var(--orange); }
.calc-hero p {
  color: #CBD5E1;
  font-size: 1.05rem;
  max-width: 760px;
  margin-bottom: 24px;
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

/* LAYOUT */
.calc-wrapper { padding: 40px 0 60px; }
.calc-grid {
  display: grid;
  grid-template-columns: 1.15fr 0.85fr;
  gap: 32px;
  align-items: start;
}
@media (max-width: 992px) {
  .calc-grid { grid-template-columns: 1fr; }
}

/* CARDS */
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

/* FORM STYLES */
.preset-pills {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin-bottom: 20px;
}
.pill-btn {
  background: var(--slate-100);
  border: 1px solid var(--slate-200);
  padding: 6px 14px;
  border-radius: 999px;
  font-size: 0.82rem;
  font-weight: 600;
  color: var(--slate-700);
  cursor: pointer;
  transition: all 0.2s;
}
.pill-btn:hover, .pill-btn.active {
  background: var(--navy);
  border-color: var(--navy);
  color: #fff;
}

.form-group-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 16px;
  margin-bottom: 18px;
}
@media (max-width: 600px) {
  .form-group-grid { grid-template-columns: 1fr; }
}
.form-field { margin-bottom: 16px; }
.form-label {
  display: flex;
  justify-content: space-between;
  font-size: 0.86rem;
  font-weight: 600;
  color: var(--navy);
  margin-bottom: 6px;
}
.form-label small { color: var(--slate-600); font-weight: 400; }
.form-input {
  width: 100%;
  padding: 10px 14px;
  border: 1.5px solid var(--slate-200);
  border-radius: var(--radius-md);
  font-size: 0.95rem;
  color: var(--slate-900);
  background: #fff;
  transition: border-color 0.2s;
}
.form-input:focus {
  outline: none;
  border-color: var(--orange);
  box-shadow: 0 0 0 3px rgba(232,97,26,0.12);
}
.unit-toggle {
  display: flex;
  background: var(--slate-100);
  padding: 4px;
  border-radius: var(--radius-md);
  margin-bottom: 20px;
}
.unit-opt {
  flex: 1;
  text-align: center;
  padding: 8px;
  font-size: 0.85rem;
  font-weight: 600;
  color: var(--slate-700);
  border-radius: 8px;
  cursor: pointer;
  border: none;
  background: transparent;
  transition: all 0.2s;
}
.unit-opt.active {
  background: #fff;
  color: var(--navy);
  box-shadow: 0 2px 6px rgba(0,0,0,0.06);
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

/* SAFE T-SCORE GAUGE */
.safe-t-box {
  background: #fff;
  border: 1px solid var(--slate-200);
  border-radius: var(--radius-md);
  padding: 16px;
  margin-bottom: 20px;
}
.safe-t-badge {
  display: inline-block;
  padding: 4px 10px;
  border-radius: 999px;
  font-size: 0.8rem;
  font-weight: 700;
  margin-top: 6px;
}
.safe-t-good { background: #DCFCE7; color: #166534; }
.safe-t-normal { background: #FEF3C7; color: #92400E; }
.safe-t-bad { background: #FEE2E2; color: #991B1B; }

/* HEINRICH PYRAMID SVG */
.pyramid-box {
  background: #fff;
  border: 1px solid var(--slate-200);
  border-radius: var(--radius-md);
  padding: 18px;
  text-align: center;
  margin-bottom: 22px;
}
.pyramid-title {
  font-size: 0.9rem;
  font-weight: 700;
  color: var(--navy);
  margin-bottom: 12px;
}
.pyramid-level {
  padding: 8px 12px;
  margin: 4px auto;
  border-radius: 6px;
  font-size: 0.82rem;
  font-weight: 600;
  display: flex;
  justify-content: space-between;
  align-items: center;
  transition: transform 0.2s;
}
.pyr-1 { width: 45%; background: #EF4444; color: #fff; }
.pyr-2 { width: 62%; background: #F97316; color: #fff; }
.pyr-3 { width: 80%; background: #FBBF24; color: #78350F; }
.pyr-4 { width: 100%; background: #E2E8F0; color: #1E293B; }

/* ACTION BUTTONS */
.btn-row { display: flex; gap: 12px; margin-top: 14px; }
.btn-calc-action {
  flex: 1;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  padding: 12px 18px;
  border-radius: var(--radius-md);
  font-size: 0.9rem;
  font-weight: 700;
  cursor: pointer;
  border: none;
  transition: all 0.2s;
  text-decoration: none;
}
.btn-primary-k3 {
  background: var(--orange);
  color: #fff;
}
.btn-primary-k3:hover {
  background: var(--orange-hover);
  color: #fff;
}
.btn-outline-k3 {
  background: #fff;
  color: var(--navy);
  border: 1.5px solid var(--slate-300);
}
.btn-outline-k3:hover {
  background: var(--slate-100);
}

/* REFERENCE & CONTENT SECTIONS */
.k3-editorial-section {
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
  font-weight: 600;
}
.ref-table td {
  padding: 10px 14px;
  border-bottom: 1px solid var(--slate-200);
  color: var(--slate-700);
}
.ref-table tr:nth-child(even) td { background: var(--slate-50); }

/* FAQ ACCORDION */
.faq-box { margin-top: 20px; }
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
.faq-icon { transition: transform 0.2s; font-size: 0.8rem; }

/* PRINT STYLES */
@media print {
  body { background: #fff; color: #000; }
  .calc-hero, .pill-btn, .btn-row, nav, footer, .faq-box, .unit-toggle, .form-input, .k3-editorial-section { display: none !important; }
  .calc-wrapper { padding: 0; }
  .calc-grid { display: block; }
  .card-box { border: none; box-shadow: none; padding: 0; }
  .print-header { display: block !important; border-bottom: 2px solid #000; padding-bottom: 12px; margin-bottom: 20px; }
}
.print-header { display: none; }
</style>

<?php require __DIR__ . '/../includes/navbar.php'; ?>

<main class="calc-page" id="konten-utama">

<!-- HERO -->
<section class="calc-hero">
  <div class="container">
    <div class="hero-badge">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
      Standar Kemnaker RI &amp; OSHA 1904
    </div>
    <h1>Kalkulator Statistik K3 <span>Online 2026</span></h1>
    <p>Hitung Tingkat Kekerapan (FR), Tingkat Keparahan (SR), Incident Rate (IR), Safe T-Score, dan Piramida Heinrich otomatis untuk keperluan audit SMK3 PP 50/2012 dan pelaporan P2K3.</p>
    <div class="hero-tags">
      <span class="hero-tag">Kepmenaker KEP.372/MEN/1989</span>
      <span class="hero-tag">OSHA 29 CFR 1904</span>
      <span class="hero-tag">ISO 45001:2018 Cl. 9.1</span>
      <span class="hero-tag">Laporan Triwulan P2K3</span>
    </div>
  </div>
</section>

<!-- MAIN CALCULATOR -->
<section class="calc-wrapper">
  <div class="container">
    
    <div class="calc-grid">
      
      <!-- FORM INPUT COLUMN -->
      <div class="calc-form-col">
        <div class="card-box">
          <div class="card-header-line">
            <h2 class="card-title">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--orange)" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="9" y1="9" x2="15" y2="9"/><line x1="12" y1="12" x2="12" y2="18"/><line x1="9" y1="15" x2="15" y2="15"/></svg>
              Parameter Data Kerja
            </h2>
            <button class="pill-btn" type="button" onclick="resetForm()">Reset Nilai</button>
          </div>

          <!-- INDUSTRY PRESETS -->
          <div class="preset-pills">
            <span style="font-size:0.8rem;font-weight:700;color:var(--slate-600);align-self:center">Preset Industri:</span>
            <button class="pill-btn active" type="button" onclick="loadPreset('manufaktur')">Manufaktur (150 Pekerja)</button>
            <button class="pill-btn" type="button" onclick="loadPreset('konstruksi')">Konstruksi (300 Pekerja)</button>
            <button class="pill-btn" type="button" onclick="loadPreset('migas')">Migas &amp; Energi (500 Pekerja)</button>
            <button class="pill-btn" type="button" onclick="loadPreset('gudang')">Gudang &amp; Logistik (80 Pekerja)</button>
          </div>

          <!-- BASIS MULTIPLIER TOGGLE -->
          <label class="form-label">Standar Basis Jam Kerja (Multiplier)</label>
          <div class="unit-toggle">
            <button class="unit-opt active" id="btnKemnaker" type="button" onclick="setMultiplier(1000000)">
              Kemnaker / ILO (1.000.000 Jam)
            </button>
            <button class="unit-opt" id="btnOsha" type="button" onclick="setMultiplier(200000)">
              OSHA / Internasional (200.000 Jam)
            </button>
          </div>

          <!-- INPUT FIELDS -->
          <div class="form-group-grid">
            <div class="form-field">
              <label class="form-label" for="inpJumlahPekerja">
                Jumlah Pekerja (Rata-rata)
                <small>Orang</small>
              </label>
              <input type="number" id="inpJumlahPekerja" class="form-input" value="150" min="1" oninput="calculateK3()">
            </div>
            <div class="form-field">
              <label class="form-label" for="inpJamKerjaOrang">
                Total Jam Kerja Selamat (JKO)
                <small>Man-Hours</small>
              </label>
              <input type="number" id="inpJamKerjaOrang" class="form-input" value="312000" min="1" oninput="calculateK3()">
            </div>
          </div>

          <div class="form-group-grid">
            <div class="form-field">
              <label class="form-label" for="inpJumlahKasusLTI">
                Kasus Kecelakaan Hilang Hari (LTI)
                <small>Kasus</small>
              </label>
              <input type="number" id="inpJumlahKasusLTI" class="form-input" value="2" min="0" oninput="calculateK3()">
            </div>
            <div class="form-field">
              <label class="form-label" for="inpHariHilang">
                Total Hari Kerja Hilang (LTD)
                <small>Hari Kerja</small>
              </label>
              <input type="number" id="inpHariHilang" class="form-input" value="14" min="0" oninput="calculateK3()">
            </div>
          </div>

          <div class="form-group-grid">
            <div class="form-field">
              <label class="form-label" for="inpKasusNonLTI">
                Kecelakaan Ringan / Medis (FAC/MTC)
                <small>Tanpa Hari Hilang</small>
              </label>
              <input type="number" id="inpKasusNonLTI" class="form-input" value="5" min="0" oninput="calculateK3()">
            </div>
            <div class="form-field">
              <label class="form-label" for="inpNearMiss">
                Kejadian Hampir Celaka (Near Miss)
                <small>Laporan Lapangan</small>
              </label>
              <input type="number" id="inpNearMiss" class="form-input" value="28" min="0" oninput="calculateK3()">
            </div>
          </div>

          <div style="border-top:1px dashed var(--slate-300);padding-top:16px;margin-top:10px">
            <label class="form-label">
              Komparasi Safe T-Score (Periode Sebelumnya)
              <small>Opsional</small>
            </label>
            <div class="form-group-grid">
              <div class="form-field">
                <input type="number" id="inpFrLalu" class="form-input" placeholder="FR Periode Lalu (cth: 8.5)" value="9.6" step="0.1" oninput="calculateK3()">
              </div>
              <div class="form-field">
                <input type="number" id="inpHoursLalu" class="form-input" placeholder="JKO Periode Lalu (cth: 300000)" value="300000" oninput="calculateK3()">
              </div>
            </div>
          </div>

          <div class="btn-row">
            <button class="btn-calc-action btn-primary-k3" type="button" onclick="printOfficialReport()">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
              Cetak Rekap Laporan P2K3
            </button>
            <button class="btn-calc-action btn-outline-k3" type="button" onclick="copyResultSummary()">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
              Salin Ringkasan
            </button>
          </div>

        </div>
      </div>

      <!-- RESULTS COLUMN -->
      <div class="calc-result-col">
        <div class="card-box">
          
          <div class="card-header-line">
            <h2 class="card-title">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--orange)" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
              Hasil Evaluasi Kinerja K3
            </h2>
            <span id="labelBasis" style="font-size:0.75rem;font-weight:700;color:var(--orange);background:var(--orange-light);padding:4px 8px;border-radius:4px">
              Basis: 1.000.000 Jam
            </span>
          </div>

          <div class="result-stat-grid">
            
            <div class="stat-card featured">
              <div class="stat-meta">Frequency Rate (FR)</div>
              <div class="stat-val" id="outFR">6.41</div>
              <div class="stat-desc">Kecelakaan per unit jam kerja standar</div>
            </div>

            <div class="stat-card featured">
              <div class="stat-meta">Severity Rate (SR)</div>
              <div class="stat-val" id="outSR">44.87</div>
              <div class="stat-desc">Hari kerja hilang per unit jam kerja</div>
            </div>

            <div class="stat-card">
              <div class="stat-meta">Incident Rate (IR)</div>
              <div class="stat-val" id="outIR">1.33%</div>
              <div class="stat-desc">Rasio pekerja mengalami insiden</div>
            </div>

            <div class="stat-card">
              <div class="stat-meta">Avg. Lost Time (ALTR)</div>
              <div class="stat-val" id="outALTR">7.00</div>
              <div class="stat-desc">Rata-rata hari hilang per kasus LTI</div>
            </div>

          </div>

          <!-- SAFE T-SCORE EVALUATION -->
          <div class="safe-t-box">
            <div style="display:flex;justify-content:space-between;align-items:center">
              <div>
                <strong style="font-size:0.92rem;color:var(--navy)">Analisis Safe T-Score:</strong>
                <div style="font-size:0.8rem;color:var(--slate-600)">Komparasi tren performa keselamatan</div>
              </div>
              <div style="text-align:right">
                <span id="outSafeTScore" style="font-size:1.4rem;font-weight:800;font-family:'Lexend',sans-serif;color:var(--navy)">-0.58</span>
              </div>
            </div>
            <div id="badgeSafeT" class="safe-t-badge safe-t-normal">
              Fluktuasi Normal (Tidak ada perubahan signifikan)
            </div>
          </div>

          <!-- HEINRICH PYRAMID -->
          <div class="pyramid-box">
            <div class="pyramid-title">Piramida Rasio Heinrich Periode Ini</div>
            <div class="pyramid-level pyr-1" title="Kecelakaan Fatal / Akibat Parah">
              <span>Fatal / Cacat:</span>
              <strong id="pyrFatal">0 Kasus</strong>
            </div>
            <div class="pyramid-level pyr-2" title="Kecelakaan Hilang Hari (LTI)">
              <span>LTI / Hari Hilang:</span>
              <strong id="pyrLTI">2 Kasus</strong>
            </div>
            <div class="pyramid-level pyr-3" title="Kecelakaan Ringan / P3K">
              <span>Non-LTI / Medis:</span>
              <strong id="pyrNonLTI">5 Kasus</strong>
            </div>
            <div class="pyramid-level pyr-4" title="Near Miss / Hampir Celaka">
              <span>Near Miss:</span>
              <strong id="pyrNearMiss">28 Kejadian</strong>
            </div>
          </div>

          <div style="font-size:0.8rem;color:var(--slate-600);line-height:1.5;background:var(--slate-100);padding:12px;border-radius:8px">
            <strong>Catatan Audit SMK3:</strong> Data statistik wajib direkapitulasi secara berkala per triwulan dan dilaporkan kepada Dinas Tenaga Kerja setempat melalui lembar formulir Laporan P2K3 sesuai format Permenaker 04/MEN/1987.
          </div>

        </div>
      </div>

    </div>

    <!-- IN-DEPTH EDITORIAL REFERENCE GUIDE (INDEXABLE SEO DEPTH) -->
    <div class="k3-editorial-section">
      <h2 class="editorial-title">Panduan Lengkap Rumus &amp; Perhitungan Statistik K3 Resmi Indonesia</h2>
      <p class="editorial-p">
        Pengukuran kinerja Keselamatan dan Kesehatan Kerja (K3) berbasis data numerik merupakan instrumen krusial dalam pemenuhan Klausul 9 ISO 45001:2018 dan Lampiran II PP 50/2012 tentang Penerapan SMK3. Di Indonesia, acuan resmi perhitungan statistik kecelakaan kerja diatur dalam <strong>Keputusan Menteri Tenaga Kerja RI Nomor: KEP.372/MEN/1989</strong> mengenai Petunjuk Pelaksanaan Tarif Premi Asuransi Kecelakaan Kerja.
      </p>

      <h3 style="color:var(--navy);font-family:'Lexend',sans-serif;font-size:1.15rem;margin:22px 0 10px">1. Rumus Frequency Rate (Tingkat Kekerapan Kecelakaan)</h3>
      <p class="editorial-p">
        Frequency Rate (FR) menunjukkan berapa frekuensi kasus kecelakaan kerja yang menyebabkan hilang hari kerja (LTI) untuk setiap satu juta (atau dua ratus ribu) jam kerja orang yang ditempuh oleh pekerja.
      </p>
      <div style="background:var(--slate-100);padding:14px 18px;border-radius:8px;font-family:monospace;font-size:0.95rem;color:var(--navy);margin-bottom:16px">
        FR = (Jumlah Kasus Kecelakaan LTI × Multiplier) / Total Jam Kerja Orang (JKO)
      </div>

      <h3 style="color:var(--navy);font-family:'Lexend',sans-serif;font-size:1.15rem;margin:22px 0 10px">2. Rumus Severity Rate (Tingkat Keparahan Kecelakaan)</h3>
      <p class="editorial-p">
        Severity Rate (SR) mengindikasikan tingkat keparahan dampak kecelakaan yang tercermin dari banyaknya jumlah hari kerja hilang (man-days lost) yang dialami perusahaan.
      </p>
      <div style="background:var(--slate-100);padding:14px 18px;border-radius:8px;font-family:monospace;font-size:0.95rem;color:var(--navy);margin-bottom:16px">
        SR = (Total Hari Kerja Hilang × Multiplier) / Total Jam Kerja Orang (JKO)
      </div>

      <h3 style="color:var(--navy);font-family:'Lexend',sans-serif;font-size:1.15rem;margin:22px 0 10px">3. Tabel Standar Hari Kerja Hilang untuk Cacat Tetap (Kepmenaker 372/1989)</h3>
      <p class="editorial-p">
        Jika kecelakaan kerja mengakibatkan cacat permanen sebagian atau kematian, perhitungan hari hilang tidak dihitung berdasarkan hari kalender rawat inap, melainkan menggunakan tabel tarif pembebanan hari kerja hilang resmi berikut:
      </p>

      <table class="ref-table">
        <thead>
          <tr>
            <th>Jenis Cedera / Cacat Permanen</th>
            <th>Persentase Cacat</th>
            <th>Standar Beban Hari Kerja Hilang</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><strong>Kematian (Fatal Accident)</strong></td>
            <td>100%</td>
            <td><strong>6.000 Hari</strong></td>
          </tr>
          <tr>
            <td><strong>Cacat Tetap Total</strong> (Kehilangan kedua mata/lengan/kaki)</td>
            <td>100%</td>
            <td><strong>6.000 Hari</strong></td>
          </tr>
          <tr>
            <td>Kehilangan satu lengan dari atau di atas siku</td>
            <td>75%</td>
            <td>4.500 Hari</td>
          </tr>
          <tr>
            <td>Kehilangan satu tangan dari atau di atas pergelangan</td>
            <td>50%</td>
            <td>3.000 Hari</td>
          </tr>
          <tr>
            <td>Kehilangan satu kaki dari atau di atas lutut</td>
            <td>75%</td>
            <td>4.500 Hari</td>
          </tr>
          <tr>
            <td>Kehilangan penglihatan satu mata total</td>
            <td>30%</td>
            <td>1.800 Hari</td>
          </tr>
          <tr>
            <td>Kehilangan satu ibu jari tangan</td>
            <td>10%</td>
            <td>600 Hari</td>
          </tr>
          <tr>
            <td>Kehilangan satu jari telunjuk tangan</td>
            <td>5%</td>
            <td>300 Hari</td>
          </tr>
        </tbody>
      </table>

      <!-- FAQ ACCORDION -->
      <h3 style="color:var(--navy);font-family:'Lexend',sans-serif;font-size:1.25rem;margin:32px 0 16px">Pertanyaan Sering Diajukan Seputar Statistik K3 (FAQ)</h3>
      <div class="faq-box">
        
        <div class="faq-item">
          <button class="faq-q" onclick="toggleFaq(this)">
            <span>Apa perbedaan standar pengali 1.000.000 jam kerja dan 200.000 jam kerja?</span>
            <span class="faq-icon">▼</span>
          </button>
          <div class="faq-a">
            Standar 1.000.000 jam kerja adalah standar resmi Depnaker/Kemnaker RI berdasarkan Kepmenaker No. KEP.372/MEN/1989 dan International Labour Organization (ILO), mewakili skala sekitar 500 pekerja penuh waktu selama 1 tahun kerja (500 org × 40 jam × 50 minggu). Sedangkan standar 200.000 jam kerja mengacu pada regulasi US OSHA (Occupational Safety and Health Administration), mewakili skala 100 pekerja penuh waktu selama 1 tahun (100 org × 40 jam × 50 minggu).
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-q" onclick="toggleFaq(this)">
            <span>Bagaimana cara membaca dan menginterpretasikan nilai Safe T-Score?</span>
            <span class="faq-icon">▼</span>
          </button>
          <div class="faq-a">
            Safe T-Score digunakan untuk menguji secara statistik apakah perbedaan angka Frequency Rate (FR) saat ini dibanding periode lalu murni kebetulan acak atau merupakan perubahan kinerja yang nyata:
            <ul style="padding-left:20px;margin-top:8px">
              <li><strong>Skor antara -2.00 s/d +2.00:</strong> Variasi normal / acak. Kinerja K3 dinilai relatif stabil.</li>
              <li><strong>Skor &lt; -2.00:</strong> Kinerja keselamatan MEMBAIK secara signifikan (kemungkinan program pencegahan berhasil).</li>
              <li><strong>Skor &gt; +2.00:</strong> Kinerja keselamatan MEMBURUK secara signifikan (indikasi bahaya sistemik, perlu audit investigasi).</li>
            </ul>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-q" onclick="toggleFaq(this)">
            <span>Kapan suatu kecelakaan dikategorikan sebagai Lost Time Injury (LTI)?</span>
            <span class="faq-icon">▼</span>
          </button>
          <div class="faq-a">
            Menurut standar Kepmenaker 372/1989 dan OSHA 1904, kecelakaan kerja diklasifikasikan sebagai Lost Time Injury (LTI) jika cedera yang dialami menyebabkan pekerja tidak mampu kembali bekerja atau menjalankan tugas normalnya pada jadwal giliran kerja berikutnya (minimal 1 x 24 jam setelah kejadian), berdasarkan surat rekomendasi dokter pemeriksa.
          </div>
        </div>

      </div>

    </div>

  </div>
</section>

</main>

<?php require __DIR__ . '/../includes/footer.php'; ?>

<script>
let currentMultiplier = 1000000;

const presets = {
  manufaktur: { workers: 150, hours: 312000, lti: 2, days: 14, nonLti: 5, nearMiss: 28, frPast: 9.6, hoursPast: 300000 },
  konstruksi: { workers: 300, hours: 624000, lti: 4, days: 38, nonLti: 12, nearMiss: 64, frPast: 7.2, hoursPast: 600000 },
  migas:       { workers: 500, hours: 1040000, lti: 0, days: 0, nonLti: 3, nearMiss: 110, frPast: 1.1, hoursPast: 1000000 },
  gudang:      { workers: 80,  hours: 166400, lti: 1, days: 6, nonLti: 4, nearMiss: 19, frPast: 5.8, hoursPast: 160000 }
};

function loadPreset(key){
  const p = presets[key];
  if(!p) return;
  document.querySelectorAll('.preset-pills .pill-btn').forEach(btn => btn.classList.remove('active'));
  event.target.classList.add('active');
  
  document.getElementById('inpJumlahPekerja').value = p.workers;
  document.getElementById('inpJamKerjaOrang').value = p.hours;
  document.getElementById('inpJumlahKasusLTI').value = p.lti;
  document.getElementById('inpHariHilang').value = p.days;
  document.getElementById('inpKasusNonLTI').value = p.nonLti;
  document.getElementById('inpNearMiss').value = p.nearMiss;
  document.getElementById('inpFrLalu').value = p.frPast;
  document.getElementById('inpHoursLalu').value = p.hoursPast;
  calculateK3();
}

function setMultiplier(val){
  currentMultiplier = val;
  document.getElementById('btnKemnaker').classList.toggle('active', val === 1000000);
  document.getElementById('btnOsha').classList.toggle('active', val === 200000);
  document.getElementById('labelBasis').textContent = val === 1000000 ? 'Basis: 1.000.000 Jam' : 'Basis: 200.000 Jam';
  calculateK3();
}

function resetForm(){
  document.getElementById('inpJumlahPekerja').value = 100;
  document.getElementById('inpJamKerjaOrang').value = 200000;
  document.getElementById('inpJumlahKasusLTI').value = 0;
  document.getElementById('inpHariHilang').value = 0;
  document.getElementById('inpKasusNonLTI').value = 0;
  document.getElementById('inpNearMiss').value = 0;
  document.getElementById('inpFrLalu').value = '';
  document.getElementById('inpHoursLalu').value = '';
  calculateK3();
}

function calculateK3(){
  const workers = parseFloat(document.getElementById('inpJumlahPekerja').value) || 1;
  const hours = parseFloat(document.getElementById('inpJamKerjaOrang').value) || 1;
  const lti = parseFloat(document.getElementById('inpJumlahKasusLTI').value) || 0;
  const days = parseFloat(document.getElementById('inpHariHilang').value) || 0;
  const nonLti = parseFloat(document.getElementById('inpKasusNonLTI').value) || 0;
  const nearMiss = parseFloat(document.getElementById('inpNearMiss').value) || 0;

  // FR & SR
  const fr = (lti * currentMultiplier) / hours;
  const sr = (days * currentMultiplier) / hours;
  
  // Incident Rate (% per 100 workers)
  const ir = (lti / workers) * 100;
  
  // Average Lost Time Rate
  const altr = lti > 0 ? (days / lti) : 0;

  document.getElementById('outFR').textContent = fr.toFixed(2);
  document.getElementById('outSR').textContent = sr.toFixed(2);
  document.getElementById('outIR').textContent = ir.toFixed(2) + '%';
  document.getElementById('outALTR').textContent = altr.toFixed(2);

  // Safe T-Score calculation
  const frPast = parseFloat(document.getElementById('inpFrLalu').value);
  const hoursPast = parseFloat(document.getElementById('inpHoursLalu').value);

  if(!isNaN(frPast) && !isNaN(hoursPast) && hoursPast > 0){
    const diff = fr - frPast;
    const denominator = Math.sqrt((frPast / hours) * currentMultiplier);
    let safeT = 0;
    if(denominator > 0){
      safeT = diff / Math.sqrt((frPast / (hours / currentMultiplier)));
    }
    const scoreVal = safeT.toFixed(2);
    document.getElementById('outSafeTScore').textContent = (safeT > 0 ? '+' : '') + scoreVal;
    
    const badge = document.getElementById('badgeSafeT');
    if(safeT < -2.0){
      badge.className = 'safe-t-badge safe-t-good';
      badge.textContent = 'Membaik Signifikan (Safe T-Score < -2.0)';
    } else if(safeT > 2.0){
      badge.className = 'safe-t-badge safe-t-bad';
      badge.textContent = 'Memburuk Signifikan (Safe T-Score > +2.0)';
    } else {
      badge.className = 'safe-t-badge safe-t-normal';
      badge.textContent = 'Fluktuasi Normal (-2.0 s/d +2.0)';
    }
  } else {
    document.getElementById('outSafeTScore').textContent = 'N/A';
    document.getElementById('badgeSafeT').className = 'safe-t-badge safe-t-normal';
    document.getElementById('badgeSafeT').textContent = 'Masukkan data periode lalu untuk Safe T-Score';
  }

  // Heinrich Pyramid levels
  document.getElementById('pyrFatal').textContent = '0 Kasus';
  document.getElementById('pyrLTI').textContent = `${lti} Kasus`;
  document.getElementById('pyrNonLTI').textContent = `${nonLti} Kasus`;
  document.getElementById('pyrNearMiss').textContent = `${nearMiss} Kejadian`;
}

function copyResultSummary(){
  const fr = document.getElementById('outFR').textContent;
  const sr = document.getElementById('outSR').textContent;
  const ir = document.getElementById('outIR').textContent;
  const altr = document.getElementById('outALTR').textContent;
  const basis = currentMultiplier.toLocaleString('id-ID');
  
  const text = `=== REKAP LAPORAN STATISTIK K3 (Wahana Totalita) ===\nBasis Multiplier: ${basis} Jam Kerja\nFrequency Rate (FR): ${fr}\nSeverity Rate (SR): ${sr}\nIncident Rate (IR): ${ir}\nAverage Lost Time (ALTR): ${altr} Hari/Kasus\nSumber Kalkulator: https://wahanatotalita.com/tools/kalkulator-k3.php`;
  
  navigator.clipboard.writeText(text).then(()=>{
    alert('Ringkasan statistik K3 berhasil disalin ke clipboard!');
  });
}

function printOfficialReport(){
  const workers = document.getElementById('inpJumlahPekerja').value;
  const hours = document.getElementById('inpJamKerjaOrang').value;
  const lti = document.getElementById('inpJumlahKasusLTI').value;
  const days = document.getElementById('inpHariHilang').value;
  const fr = document.getElementById('outFR').textContent;
  const sr = document.getElementById('outSR').textContent;
  const ir = document.getElementById('outIR').textContent;
  const altr = document.getElementById('outALTR').textContent;
  const basis = currentMultiplier.toLocaleString('id-ID');

  const win = window.open('', '_blank');
  win.document.write(`<!DOCTYPE html><html><head><title>Laporan Statistik K3 - Rekap P2K3</title>
  <style>
    body{font-family:'Segoe UI',Arial,sans-serif;padding:32px;max-width:760px;margin:0 auto;color:#0F172A;line-height:1.6}
    .header{border-bottom:3px solid #0D233A;padding-bottom:12px;margin-bottom:20px;display:flex;justify-content:space-between;align-items:flex-end}
    h1{font-size:18pt;margin:0;color:#0D233A}
    .sub{font-size:9pt;color:#64748B}
    table{width:100%;border-collapse:collapse;margin:16px 0;font-size:10pt}
    th,td{border:1px solid #CBD5E1;padding:8px 12px;text-align:left}
    th{background:#F1F5F9;color:#0D233A}
    .badge{display:inline-block;padding:2px 8px;border-radius:4px;font-weight:bold;background:#E8611A;color:#fff;font-size:8.5pt}
    .sig-grid{display:grid;grid-template-columns:1fr 1fr;gap:40px;margin-top:40px;text-align:center}
    .sig-line{margin-top:60px;border-top:1px solid #000;font-weight:bold}
  </style>
  </head><body>
  <div class="header">
    <div>
      <h1>LEMBAR REKAPITULASI STATISTIK K3</h1>
      <div class="sub">Berdasarkan Kepmenaker No. KEP.372/MEN/1989 &amp; Format Evaluasi P2K3</div>
    </div>
    <div style="text-align:right">
      <span class="badge">RESMI P2K3</span><br>
      <span class="sub">Dicetak: ${new Date().toLocaleDateString('id-ID')}</span>
    </div>
  </div>

  <h3>I. Data Operasional &amp; Jam Kerja Orang (JKO)</h3>
  <table>
    <tr><th style="width:50%">Parameter</th><th>Nilai Tercatat</th></tr>
    <tr><td>Jumlah Tenaga Kerja Rata-rata</td><td><strong>${workers} Orang</strong></td></tr>
    <tr><td>Total Jam Kerja Orang (JKO) Selamat</td><td><strong>${Number(hours).toLocaleString('id-ID')} Jam</strong></td></tr>
    <tr><td>Kasus Kecelakaan Hilang Hari (LTI)</td><td><strong>${lti} Kasus</strong></td></tr>
    <tr><td>Total Hari Kerja Hilang (LTD)</td><td><strong>${days} Hari</strong></td></tr>
    <tr><td>Standar Pengali (Basis Multiplier)</td><td><strong>${basis} Jam Kerja</strong></td></tr>
  </table>

  <h3>II. Indikator Kinerja K3 (OHS Lagging Indicators)</h3>
  <table>
    <tr><th>Indikator Statistik</th><th>Hasil Perhitungan</th><th>Keterangan / Interpretasi</th></tr>
    <tr><td><strong>Frequency Rate (FR)</strong></td><td style="font-size:12pt;font-weight:bold;color:#E8611A">${fr}</td><td>Frekuensi LTI per unit jam kerja</td></tr>
    <tr><td><strong>Severity Rate (SR)</strong></td><td style="font-size:12pt;font-weight:bold;color:#0D233A">${sr}</td><td>Tingkat keparahan hari kerja hilang</td></tr>
    <tr><td><strong>Incident Rate (IR)</strong></td><td><strong>${ir}</strong></td><td>Persentase pekerja terkena insiden</td></tr>
    <tr><td><strong>Average Lost Time (ALTR)</strong></td><td><strong>${altr} Hari/Kasus</strong></td><td>Rata-rata hari hilang per peristiwa LTI</td></tr>
  </table>

  <div class="sig-grid">
    <div>
      Dibuat oleh,<br>
      <strong>Sekretaris P2K3 / Ahli K3 Umum</strong>
      <div class="sig-line">( _____________________________ )</div>
      No. Reg SKP: ___________________
    </div>
    <div>
      Disetujui oleh,<br>
      <strong>Ketua P2K3 / Pimpinan Perusahaan</strong>
      <div class="sig-line">( _____________________________ )</div>
      Tanggal: _______________________
    </div>
  </div>
  </body></html>`);
  win.document.close();
  win.print();
}

function toggleFaq(btn){
  const item = btn.parentElement;
  item.classList.toggle('active');
}

// Initial calculation on load
window.addEventListener('DOMContentLoaded', calculateK3);
</script>

<?php require __DIR__ . '/../includes/scripts.php'; ?>
</body>
</html>
