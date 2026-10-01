<?php
require_once __DIR__ . '/../config.php';
$s = get_all_settings();

$page_title = 'Kumpulan Tools K3 Online 2026: Kalkulator, Generator & Regulasi K3';
$meta_desc = 'Pusat tools dan kalkulator K3 online terlengkap 2026: Safety Talk, Kalkulator Statistik K3 (FR/SR), JSA Builder, Matriks Risiko 5x5, Kebisingan, Regulasi K3, dan IBPR gratis.';

ob_start();
require __DIR__ . '/../includes/head.php';
$shared_head = ob_get_clean();
$shared_head = preg_replace('~<title>.*?</title>~s', '<title>' . e($page_title) . '</title>', $shared_head, 1);
echo $shared_head;

$allTools = [
  [
    "url" => "safety-talk.php",
    "title" => "100 Materi Safety Talk & Toolbox Meeting (TBM)",
    "desc" => "Database 100 topik materi safety talk harian K3 terlengkap dengan poin diskusi 2 arah, fakta statistik, dan lembar daftar hadir absensi siap cetak.",
    "cat" => "edukasi",
    "badge" => "Paling Populer",
    "icon" => "M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253",
    "tags" => ["Toolbox Meeting", "Absensi TBM", "100 Topik"]
  ],
  [
    "url" => "kalkulator-k3.php",
    "title" => "Kalkulator Statistik K3 (FR, SR, IR & Safe T-Score)",
    "desc" => "Hitung indikator kinerja K3 resmi: Frequency Rate (FR), Severity Rate (SR), Incident Rate, dan Piramida Heinrich sesuai Kepmenaker 372/1989 & OSHA.",
    "cat" => "kalkulator",
    "badge" => "Standar Kemnaker",
    "icon" => "M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z",
    "tags" => ["Kepmenaker 372/1989", "OSHA 1904", "Laporan P2K3"]
  ],
  [
    "url" => "jsa-builder.php",
    "title" => "JSA Builder (Job Safety Analysis Generator)",
    "desc" => "Generator penyusun formulir analisis keselamatan kerja langkah demi langkah dengan 6 template pekerjaan risiko tinggi dan cetak form tanda tangan resmi.",
    "cat" => "lapangan",
    "badge" => "Siap Cetak",
    "icon" => "M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4",
    "tags" => ["Izin Kerja PTW", "Hierarki Kontrol", "Format Resmi"]
  ],
  [
    "url" => "risk-matrix.php",
    "title" => "Matriks Risiko 5x5 K3 (ISO 31000 & HIRARC)",
    "desc" => "Kalkulator evaluasi matriks risiko 5x5 interaktif berdasarkan Peluang (Likelihood) dan Keparahan (Consequence) serta pembuatan tabel Risk Register.",
    "cat" => "lapangan",
    "badge" => "ISO 31000",
    "icon" => "M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z",
    "tags" => ["Low to Extreme", "ALARP", "Risk Register"]
  ],
  [
    "url" => "kalkulator-kebisingan.php",
    "title" => "Kalkulator Paparan Kebisingan Permenaker 5/2018",
    "desc" => "Hitung Dosis Kebisingan Kumulatif (%), TWA 8-Jam (dBA), batas pajanan waktu kerja maksimal, serta uji proteksi riil APD telinga (NRR Derating).",
    "cat" => "kalkulator",
    "badge" => "Permenaker 5/2018",
    "icon" => "M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z",
    "tags" => ["NAB 85 dBA", "TWA 8 Jam", "Earplug & Earmuff"]
  ],
  [
    "url" => "kalkulator-biaya-k3.php",
    "title" => "Kalkulator Biaya Kecelakaan Kerja (Heinrich & Bird)",
    "desc" => "Analisis total kerugian finansial akibat kecelakaan kerja berdasarkan Teori Gunung Es K3 (biaya langsung vs biaya tersembunyi) dan ROI program K3.",
    "cat" => "kalkulator",
    "badge" => "Teori Gunung Es",
    "icon" => "M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z",
    "tags" => ["Rasio 1:4 & 1:10", "Hidden Costs", "ROI Safety"]
  ],
  [
    "url" => "regulasi-k3.php",
    "title" => "Database Regulasi K3 Indonesia Terlengkap",
    "desc" => "Koleksi peraturan perundang-undangan K3 lengkap: UU No. 1/1970, PP No. 50/2012, Permenaker, dan Kepmenaker dengan pasal krusial dan sanksi hukum.",
    "cat" => "regulasi",
    "badge" => "Database Hukum",
    "icon" => "M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253",
    "tags" => ["UU 1/1970", "PP 50/2012", "Sanksi Pidana"]
  ],
  [
    "url" => "apd-selector.php",
    "title" => "Panduan Pemilihan APD K3 (SNI & Permenaker 08/2010)",
    "desc" => "Spesifikasi teknis alat pelindung diri 7 organ tubuh sesuai Permenaker No. 08/2010, standar SNI, ANSI, & EN lengkap dengan panduan inspeksi kelayakan pra-pakai.",
    "cat" => "lapangan",
    "badge" => "Permenaker 08/2010",
    "icon" => "M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z",
    "tags" => ["Standar SNI/ANSI", "7 Organ Tubuh", "Inspeksi Pra-Pakai"]
  ],
  [
    "url" => "laporan-insiden.php",
    "title" => "Formulir Laporan Insiden K3 & Investigasi 5-Why",
    "desc" => "Dokumentasikan insiden kecelakaan kerja resmi Permenaker 03/1998 dengan analisis rantai akar penyebab 5-Why, penyebab langsung SCAT, dan matriks CAPA.",
    "cat" => "lapangan",
    "badge" => "Permenaker 03/1998",
    "icon" => "M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z",
    "tags" => ["5-Why Analysis", "SCAT Model", "Format Disnaker"]
  ],
  [
    "url" => "ibpr-generator.php",
    "title" => "Generator IBPR / HIRADC K3 (SMK3 PP 50/2012)",
    "desc" => "Buat tabel Identifikasi Bahaya dan Penilaian Risiko (IBPR) terpadu dengan klasifikasi kondisi Rutin/Non-Rutin/Darurat dan evaluasi risiko awal vs sisa.",
    "cat" => "lapangan",
    "badge" => "SMK3 PP 50/2012",
    "icon" => "M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z",
    "tags" => ["Elemen 2 SMK3", "ISO 45001", "Export CSV"]
  ],
  [
    "url" => "social-generator.php",
    "title" => "Generator Poster & Banner K3 (Bulan K3 Nasional)",
    "desc" => "Desain grafis promosi keselamatan kerja dan spanduk Bulan K3 Nasional dengan template slogan motivasi siap download dalam resolusi tinggi PNG.",
    "cat" => "edukasi",
    "badge" => "Download HD",
    "icon" => "M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z",
    "tags" => ["Bulan K3", "Poster Mading", "Banner 16:9"]
  ],
  [
    "url" => "ai-analyzer.php",
    "title" => "AI K3 Document Analyzer (Cek Kepatuhan SMK3)",
    "desc" => "Pindai kepatuhan dokumen Kebijakan K3, SOP, dan JSA Anda terhadap regulasi audit PP No. 50 Tahun 2012 dan temukan celah ketidaksesuaian secara instan.",
    "cat" => "regulasi",
    "badge" => "AI Scanner",
    "icon" => "M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z",
    "tags" => ["Gap Analysis", "Klausul Audit", "Evaluasi Otomatis"]
  ]
];
?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    { "@type": "ListItem", "position": 1, "name": "Beranda", "item": "https://wahanatotalita.com/" },
    { "@type": "ListItem", "position": 2, "name": "Tools K3", "item": "https://wahanatotalita.com/tools/" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "CollectionPage",
  "name": "Kumpulan Tools K3 Online 2026: Kalkulator, Generator & Regulasi",
  "url": "https://wahanatotalita.com/tools/",
  "description": "Direktori lengkap aplikasi dan kalkulator keselamatan kerja K3 online gratis: Safety Talk, Kalkulator K3, JSA, Matriks Risiko, Kebisingan, dan IBPR.",
  "inLanguage": "id-ID"
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "Apakah seluruh tools dan kalkulator K3 di situs ini gratis?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Ya, 100% gratis dan dapat digunakan secara bebas oleh praktisi HSE, Ahli K3 Umum, mahasiswa, dan manajemen perusahaan di seluruh Indonesia tanpa perlu registrasi."
      }
    },
    {
      "@type": "Question",
      "name": "Apakah hasil perhitungan kalkulator K3 sesuai dengan standar regulasi pemerintah?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Seluruh formula perhitungan dan dokumen yang dihasilkan mengacu langsung pada peraturan perundang-undangan resmi Republik Indonesia, seperti Kepmenaker No. KEP.372/MEN/1989, Permenaker No. 5 Tahun 2018, Permenaker No. 03/MEN/1998, dan PP No. 50 Tahun 2012 tentang Penerapan SMK3."
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
.hub-hero {
  background: linear-gradient(135deg, #071524 0%, #0D233A 60%, #183654 100%);
  color: #fff;
  padding: 64px 0 48px;
  position: relative;
  overflow: hidden;
  border-bottom: 3px solid var(--orange);
}
.hub-hero::before {
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
.hub-hero h1 {
  font-family: 'Lexend', sans-serif;
  font-size: clamp(2rem, 4vw, 3rem);
  font-weight: 800;
  line-height: 1.2;
  margin-bottom: 14px;
}
.hub-hero h1 span { color: var(--orange); }
.hub-hero p {
  color: #CBD5E1;
  font-size: 1.1rem;
  max-width: 780px;
  margin-bottom: 24px;
}

/* SEARCH & FILTER BAR */
.hub-wrapper { padding: 40px 0 60px; }
.search-card {
  background: #fff;
  border: 1px solid var(--slate-200);
  border-radius: var(--radius-lg);
  padding: 24px;
  box-shadow: var(--shadow-sm);
  margin-bottom: 36px;
}
.search-input-box {
  position: relative;
  margin-bottom: 18px;
}
.search-icon {
  position: absolute;
  left: 16px;
  top: 50%;
  transform: translateY(-50%);
  color: var(--slate-600);
}
.hub-search-input {
  width: 100%;
  padding: 14px 16px 14px 48px;
  border: 2px solid var(--slate-200);
  border-radius: var(--radius-md);
  font-size: 1rem;
  color: var(--slate-900);
  transition: all 0.2s;
}
.hub-search-input:focus {
  outline: none;
  border-color: var(--orange);
  box-shadow: 0 0 0 3px rgba(232,97,26,0.12);
}

.category-pills {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
}
.cat-btn {
  background: var(--slate-100);
  border: 1px solid var(--slate-200);
  padding: 8px 18px;
  border-radius: 999px;
  font-size: 0.86rem;
  font-weight: 600;
  color: var(--slate-700);
  cursor: pointer;
  transition: all 0.2s;
}
.cat-btn:hover, .cat-btn.active {
  background: var(--navy);
  border-color: var(--navy);
  color: #fff;
}

/* TOOLS GRID */
.tools-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
  gap: 26px;
  margin-bottom: 48px;
}
@media (max-width: 600px) {
  .tools-grid { grid-template-columns: 1fr; }
}

.tool-card {
  background: #fff;
  border: 1px solid var(--slate-200);
  border-radius: var(--radius-lg);
  padding: 26px;
  box-shadow: var(--shadow-sm);
  display: flex;
  flex-direction: column;
  text-decoration: none;
  color: inherit;
  transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s;
  position: relative;
}
.tool-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 12px 28px rgba(13,35,58,0.1);
  border-color: var(--orange);
}
.tool-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 16px;
}
.tool-icon-box {
  width: 46px;
  height: 46px;
  border-radius: 10px;
  background: var(--orange-light);
  color: var(--orange);
  display: flex;
  align-items: center;
  justify-content: center;
}
.tool-badge {
  background: #DCFCE7;
  color: #166534;
  padding: 4px 10px;
  border-radius: 999px;
  font-size: 0.72rem;
  font-weight: 700;
  letter-spacing: 0.03em;
}
.tool-title {
  font-family: 'Lexend', sans-serif;
  font-size: 1.2rem;
  font-weight: 800;
  color: var(--navy);
  margin-bottom: 10px;
  line-height: 1.35;
}
.tool-card:hover .tool-title { color: var(--orange); }
.tool-desc {
  font-size: 0.88rem;
  color: var(--slate-600);
  line-height: 1.6;
  margin-bottom: 20px;
  flex-grow: 1;
}
.tool-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-top: 1px solid var(--slate-100);
  padding-top: 14px;
}
.tag-list { display: flex; flex-wrap: wrap; gap: 6px; }
.tool-tag {
  background: var(--slate-100);
  color: var(--slate-600);
  font-size: 0.75rem;
  padding: 2px 8px;
  border-radius: 4px;
  font-weight: 600;
}
.tool-arrow {
  color: var(--orange);
  font-weight: 700;
  font-size: 0.9rem;
  display: flex;
  align-items: center;
  gap: 4px;
}

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

<main class="hub-page" id="konten-utama">

<!-- HERO -->
<section class="hub-hero">
  <div class="container">
    <div class="hero-badge">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
      Pusat Aplikasi K3 Digital Indonesia 2026
    </div>
    <h1>Kumpulan Tools &amp; Kalkulator <span>K3 Online</span></h1>
    <p>Akses 12 alat bantu dan kalkulator keselamatan kerja profesional gratis: dari materi Safety Talk harian, perhitungan statistik K3 (FR/SR), JSA Builder, Matriks Risiko 5x5, hingga database regulasi resmi Kemnaker RI.</p>
  </div>
</section>

<!-- MAIN DIRECTORY -->
<section class="hub-wrapper">
  <div class="container">
    
    <!-- SEARCH & FILTER -->
    <div class="search-card">
      <div class="search-input-box">
        <svg class="search-icon" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <input type="text" id="hubSearch" class="hub-search-input" placeholder="Cari tool K3 (contoh: safety talk, statistik fr sr, jsa, kebisingan, matriks risiko, regulasi)..." oninput="filterTools()">
      </div>

      <div class="category-pills">
        <button class="cat-btn active" type="button" onclick="setHubCategory('all', this)">Semua Tools (<?php echo count($allTools); ?>)</button>
        <button class="cat-btn" type="button" onclick="setHubCategory('lapangan', this)">Manajemen Risiko &amp; Lapangan</button>
        <button class="cat-btn" type="button" onclick="setHubCategory('kalkulator', this)">Kalkulator K3 &amp; Finansial</button>
        <button class="cat-btn" type="button" onclick="setHubCategory('regulasi', this)">Regulasi &amp; Dokumen K3</button>
        <button class="cat-btn" type="button" onclick="setHubCategory('edukasi', this)">Edukasi &amp; Kampanye K3</button>
      </div>
    </div>

    <!-- SERVER-RENDERED TOOLS CARDS GRID -->
    <div class="tools-grid" id="toolsGrid">
      <?php foreach ($allTools as $t): ?>
      <a href="<?php echo e($t['url']); ?>" class="tool-card" data-cat="<?php echo e($t['cat']); ?>" data-text="<?php echo strtolower(e($t['title'] . ' ' . $t['desc'] . ' ' . implode(' ', $t['tags']))); ?>">
        <div class="tool-header">
          <div class="tool-icon-box">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="<?php echo e($t['icon']); ?>"/></svg>
          </div>
          <span class="tool-badge"><?php echo e($t['badge']); ?></span>
        </div>
        <h2 class="tool-title"><?php echo e($t['title']); ?></h2>
        <p class="tool-desc"><?php echo e($t['desc']); ?></p>
        <div class="tool-footer">
          <div class="tag-list">
            <?php foreach ($t['tags'] as $tag): ?>
            <span class="tool-tag"><?php echo e($tag); ?></span>
            <?php endforeach; ?>
          </div>
          <span class="tool-arrow">Buka Tool →</span>
        </div>
      </a>
      <?php endforeach; ?>
    </div>

    <!-- IN-DEPTH EDITORIAL ARTICLE (SEO DEPTH) -->
    <div class="editorial-box">
      <h2 class="editorial-title">Pentingnya Digitalisasi Tools K3 dalam Penerapan SMK3 PP 50/2012</h2>
      <p class="editorial-p">
        Transformasi digital dalam pengelolaan Keselamatan dan Kesehatan Kerja (K3) kini menjadi kebutuhan fundamental bagi perusahaan di Indonesia. Penggunaan kalkulator dan generator otomatis memungkinkan Ahli K3 Umum, pengawas lapangan, dan komite P2K3 untuk melakukan evaluasi risiko kuantitatif secara cepat, akurat, dan terstandarisasi sesuai regulasi nasional.
      </p>

      <h3 style="color:var(--navy);font-family:'Lexend',sans-serif;font-size:1.15rem;margin:22px 0 10px">Keunggulan Implementasi Tools K3 Berbasis Standar Resmi</h3>
      <ul style="padding-left:22px;color:var(--slate-700);line-height:1.75;margin-bottom:18px">
        <li><strong>Akurasi Perhitungan Hukum:</strong> Menghilangkan risiko kesalahan rumus manual dalam perhitungan Frequency Rate (FR) dan Severity Rate (SR) pada pelaporan triwulan P2K3 ke Dinas Tenaga Kerja.</li>
        <li><strong>Standardisasi Form Lapangan:</strong> Menjamin format dokumen Job Safety Analysis (JSA) dan Risk Register mematuhi ketentuan hierarki pengendalian ISO 45001:2018.</li>
        <li><strong>Efisiensi Waktu Kerja:</strong> Mempersingkat waktu pembuatan materi Toolbox Meeting harian dan verifikasi kepatuhan dokumen audit SMK3.</li>
      </ul>

      <!-- FAQ ACCORDION -->
      <h3 style="color:var(--navy);font-family:'Lexend',sans-serif;font-size:1.25rem;margin:28px 0 16px">Tanya Jawab Seputar Tools K3 (FAQ)</h3>
      <div class="faq-box">
        
        <div class="faq-item">
          <button class="faq-q" onclick="toggleFaq(this)">
            <span>Apakah seluruh tools dan kalkulator K3 di situs ini gratis?</span>
            <span class="faq-icon">▼</span>
          </button>
          <div class="faq-a">
            Ya, 100% gratis dan dapat digunakan secara bebas oleh praktisi HSE, Ahli K3 Umum, mahasiswa, dan manajemen perusahaan di seluruh Indonesia tanpa perlu registrasi.
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-q" onclick="toggleFaq(this)">
            <span>Apakah hasil perhitungan kalkulator K3 sesuai dengan standar regulasi pemerintah?</span>
            <span class="faq-icon">▼</span>
          </button>
          <div class="faq-a">
            Seluruh formula perhitungan dan dokumen yang dihasilkan mengacu langsung pada peraturan perundang-undangan resmi Republik Indonesia, seperti Kepmenaker No. KEP.372/MEN/1989, Permenaker No. 5 Tahun 2018, Permenaker No. 03/MEN/1998, dan PP No. 50 Tahun 2012 tentang Penerapan SMK3.
          </div>
        </div>

      </div>

    </div>

  </div>
</section>

</main>

<?php require __DIR__ . '/../includes/footer.php'; ?>

<script>
let currentHubCat = 'all';

function setHubCategory(cat, btn){
  currentHubCat = cat;
  document.querySelectorAll('.category-pills .cat-btn').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
  filterTools();
}

function filterTools(){
  const q = document.getElementById('hubSearch').value.toLowerCase().trim();
  const cards = document.querySelectorAll('.tool-card');

  cards.forEach(c => {
    const cat = c.getAttribute('data-cat');
    const text = c.getAttribute('data-text');

    const matchCat = (currentHubCat === 'all' || cat === currentHubCat);
    const matchQuery = (q === '' || text.includes(q));

    if(matchCat && matchQuery){
      c.style.display = 'flex';
    } else {
      c.style.display = 'none';
    }
  });
}

function toggleFaq(btn){
  btn.parentElement.classList.toggle('active');
}
</script>

<?php require __DIR__ . '/../includes/scripts.php'; ?>
</body>
</html>
