<?php
require_once __DIR__ . '/../config.php';
$s = get_all_settings();

$page_title = 'JSA Builder Online 2026: Generator Job Safety Analysis & JHA Indonesia';
$meta_desc = 'Buat dokumen Job Safety Analysis (JSA / JHA) K3 standar industri secara instan online. Dilengkapi 6 template pekerjaan risiko tinggi, hirarki pengendalian, dan cetak form resmi.';

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
    { "@type": "ListItem", "position": 3, "name": "JSA Builder", "item": "https://wahanatotalita.com/tools/jsa-builder.php" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebApplication",
  "name": "JSA & JHA Builder Online K3 Indonesia",
  "url": "https://wahanatotalita.com/tools/jsa-builder.php",
  "description": "Generator dokumen Job Safety Analysis (JSA) dan Job Hazard Analysis (JHA) standar SMK3 PP 50/2012 dan ISO 45001 dengan fitur cetak formulir resmi.",
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
      "name": "Apa perbedaan antara JSA (Job Safety Analysis) dan HIRADC / IBPR?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "HIRADC / IBPR adalah identifikasi bahaya dan penilaian risiko makro yang mencakup seluruh aktivitas, fasilitas, dan proses operasional perusahaan secara menyeluruh. Sedangkan JSA (Job Safety Analysis) bersifat mikro dan taktis, berfokus menganalisis langkah demi langkah dari satu pekerjaan spesifik, terutama pekerjaan berisiko tinggi atau non-rutin sebelum izin kerja (PTW) diterbitkan."
      }
    },
    {
      "@type": "Question",
      "name": "Siapa yang wajib menyusun dan menyetujui dokumen JSA di lapangan?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "JSA idealnya disusun oleh pengawas langsung atau supervisor pekerjaan bersama tim pekerja pelaksana yang memahami teknis lapangan, lalu ditinjau dan divalidasi oleh Petugas / Ahli K3 Umum (HSE Officer), serta disahkan oleh Pimpinan Proyek atau Site Manager sebelum pekerjaan dimulai."
      }
    },
    {
      "@type": "Question",
      "name": "Kapan suatu pekerjaan wajib dilengkapi dokumen JSA?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Dokumen JSA wajib dibuat untuk pekerjaan yang memiliki potensi risiko tinggi (seperti bekerja di ketinggian, ruang terbatas, pekerjaan panas, pengangkatan crane, penggalian dalam), pekerjaan non-rutin yang belum memiliki SOP baku, atau pekerjaan baru dengan perubahan metode/alat kerja."
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
.jsa-hero {
  background: linear-gradient(135deg, #071524 0%, #0D233A 60%, #183654 100%);
  color: #fff;
  padding: 58px 0 44px;
  position: relative;
  overflow: hidden;
  border-bottom: 3px solid var(--orange);
}
.jsa-hero::before {
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
.jsa-hero h1 {
  font-family: 'Lexend', sans-serif;
  font-size: clamp(1.8rem, 3.6vw, 2.7rem);
  font-weight: 800;
  line-height: 1.2;
  margin-bottom: 12px;
}
.jsa-hero h1 span { color: var(--orange); }
.jsa-hero p {
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

/* JSA WORKSPACE */
.jsa-wrapper { padding: 40px 0 60px; }
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
  flex-wrap: wrap;
  gap: 12px;
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

/* TEMPLATES PRESET */
.preset-bar {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin-bottom: 24px;
}
.preset-btn {
  background: var(--slate-100);
  border: 1px solid var(--slate-200);
  padding: 8px 14px;
  border-radius: 8px;
  font-size: 0.84rem;
  font-weight: 600;
  color: var(--slate-700);
  cursor: pointer;
  transition: all 0.2s;
  display: inline-flex;
  align-items: center;
  gap: 6px;
}
.preset-btn:hover, .preset-btn.active {
  background: var(--navy);
  border-color: var(--navy);
  color: #fff;
}

/* HEADER METADATA FORM */
.meta-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 16px;
  background: var(--slate-50);
  padding: 18px;
  border-radius: var(--radius-md);
  border: 1px solid var(--slate-200);
  margin-bottom: 26px;
}
.form-field { margin-bottom: 0; }
.form-label {
  display: block;
  font-size: 0.82rem;
  font-weight: 700;
  color: var(--navy);
  margin-bottom: 6px;
  text-transform: uppercase;
  letter-spacing: 0.03em;
}
.form-input {
  width: 100%;
  padding: 9px 12px;
  border: 1.5px solid var(--slate-200);
  border-radius: 8px;
  font-size: 0.9rem;
  color: var(--slate-900);
  background: #fff;
}
.form-input:focus {
  outline: none;
  border-color: var(--orange);
}

/* JSA STEPS TABLE */
.jsa-table-container {
  overflow-x: auto;
  border: 1px solid var(--slate-200);
  border-radius: var(--radius-md);
  margin-bottom: 22px;
}
.jsa-table {
  width: 100%;
  border-collapse: collapse;
  min-width: 860px;
  font-size: 0.88rem;
}
.jsa-table th {
  background: var(--navy);
  color: #fff;
  padding: 12px 14px;
  text-align: left;
  font-weight: 700;
  font-size: 0.84rem;
  text-transform: uppercase;
  letter-spacing: 0.03em;
}
.jsa-table td {
  padding: 12px 14px;
  border-bottom: 1px solid var(--slate-200);
  vertical-align: top;
  background: #fff;
}
.jsa-table tr:hover td { background: var(--slate-50); }
.jsa-table textarea {
  width: 100%;
  border: 1px solid var(--slate-200);
  border-radius: 6px;
  padding: 8px 10px;
  font-size: 0.86rem;
  font-family: inherit;
  resize: vertical;
  min-height: 64px;
}
.jsa-table textarea:focus {
  outline: none;
  border-color: var(--orange);
}
.risk-select {
  padding: 6px 10px;
  border-radius: 6px;
  font-weight: 700;
  font-size: 0.8rem;
  border: 1px solid var(--slate-300);
}
.risk-low { background: #DCFCE7; color: #166534; }
.risk-med { background: #FEF3C7; color: #92400E; }
.risk-high { background: #FEE2E2; color: #991B1B; }

.btn-del-step {
  background: #FEE2E2;
  border: 1px solid #FCA5A5;
  color: #991B1B;
  width: 30px;
  height: 30px;
  border-radius: 6px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: bold;
}
.btn-del-step:hover { background: #EF4444; color: #fff; }

/* ACTIONS */
.action-bar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 12px;
}
.btn-add-step {
  background: var(--navy-light);
  color: #fff;
  border: none;
  padding: 10px 18px;
  border-radius: 8px;
  font-size: 0.88rem;
  font-weight: 700;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}
.btn-add-step:hover { background: var(--navy); }

.export-group { display: flex; gap: 10px; }
.btn-export {
  padding: 10px 18px;
  border-radius: 8px;
  font-size: 0.88rem;
  font-weight: 700;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  border: none;
  text-decoration: none;
}
.btn-print { background: var(--orange); color: #fff; }
.btn-print:hover { background: var(--orange-hover); }
.btn-csv { background: var(--slate-100); color: var(--navy); border: 1.5px solid var(--slate-300); }
.btn-csv:hover { background: var(--slate-200); }

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

<main class="jsa-page" id="konten-utama">

<!-- HERO -->
<section class="jsa-hero">
  <div class="container">
    <div class="hero-badge">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
      Sesuai SMK3 PP 50/2012 &amp; ISO 45001
    </div>
    <h1>JSA Builder <span>Online 2026</span></h1>
    <p>Susun formulir Job Safety Analysis (JSA) &amp; Job Hazard Analysis (JHA) profesional langkah demi langkah. Pilih template risiko tinggi, sesuaikan hierarki kontrol, dan cetak form resmi untuk Izin Kerja (PTW).</p>
    <div class="hero-tags">
      <span class="hero-tag">6 Template Industri Siap Pakai</span>
      <span class="hero-tag">Hirarki Kontrol 5 Tingkat</span>
      <span class="hero-tag">Matriks Tingkat Risiko L/M/H</span>
      <span class="hero-tag">Format Cetak Tanda Tangan Lapangan</span>
    </div>
  </div>
</section>

<!-- BUILDER WORKSPACE -->
<section class="jsa-wrapper">
  <div class="container">
    
    <div class="card-box">
      
      <!-- TEMPLATE SELECTOR -->
      <div class="card-header-line">
        <h2 class="card-title">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--orange)" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
          Pilih Template Pekerjaan Berisiko Tinggi
        </h2>
        <span style="font-size:0.8rem;color:var(--slate-600)">Klik untuk memuat langkah kerja standar:</span>
      </div>

      <div class="preset-bar">
        <button class="preset-btn active" type="button" onclick="loadTemplate('ketinggian')">
          🪜 Bekerja di Ketinggian / Scaffolding
        </button>
        <button class="preset-btn" type="button" onclick="loadTemplate('hotwork')">
          🔥 Pekerjaan Panas (Welding &amp; Cutting)
        </button>
        <button class="preset-btn" type="button" onclick="loadTemplate('confined')">
          🕳️ Ruang Terbatas (Confined Space)
        </button>
        <button class="preset-btn" type="button" onclick="loadTemplate('lifting')">
          🏗️ Pengangkatan Beban Berat (Crane Lifting)
        </button>
        <button class="preset-btn" type="button" onclick="loadTemplate('galian')">
          ⛏️ Pekerjaan Penggalian Tanah Dalam
        </button>
        <button class="preset-btn" type="button" onclick="loadTemplate('listrik')">
          ⚡ Perbaikan Panel &amp; Trafo Listrik
        </button>
      </div>

      <!-- METADATA FORM -->
      <div class="meta-grid">
        <div class="form-field">
          <label class="form-label" for="inpJudulKerja">Nama Pekerjaan (Job Title)</label>
          <input type="text" id="inpJudulKerja" class="form-input" value="Pemasangan &amp; Inspeksi Perancah Scaffolding">
        </div>
        <div class="form-field">
          <label class="form-label" for="inpLokasi">Lokasi / Area Proyek</label>
          <input type="text" id="inpLokasi" class="form-input" value="Area Workshop Gedung B">
        </div>
        <div class="form-field">
          <label class="form-label" for="inpSupervisor">Pengawas Lapangan (Supervisor)</label>
          <input type="text" id="inpSupervisor" class="form-input" value="Ahmad Farhan">
        </div>
        <div class="form-field">
          <label class="form-label" for="inpHse">Ahli K3 / HSE Officer</label>
          <input type="text" id="inpHse" class="form-input" value="Rian Pratama, S.T.">
        </div>
        <div class="form-field">
          <label class="form-label" for="inpPtw">No. Izin Kerja (PTW)</label>
          <input type="text" id="inpPtw" class="form-input" value="PTW-WAHANA-2026-042">
        </div>
        <div class="form-field">
          <label class="form-label" for="inpTanggal">Tanggal Pelaksanaan</label>
          <input type="date" id="inpTanggal" class="form-input">
        </div>
      </div>

      <!-- JSA STEPS TABLE -->
      <div class="jsa-table-container">
        <table class="jsa-table" id="jsaTable">
          <thead>
            <tr>
              <th style="width:45px;text-align:center">No</th>
              <th style="width:24%">Urutan Langkah Kerja</th>
              <th style="width:24%">Potensi Bahaya &amp; Dampak</th>
              <th style="width:130px;text-align:center">Tingkat Risiko</th>
              <th>Tindakan Pengendalian (Hirarki K3)</th>
              <th style="width:14%">Penanggung Jawab (PIC)</th>
              <th style="width:40px;text-align:center">Aksi</th>
            </tr>
          </thead>
          <tbody id="jsaBody">
            <!-- Dynamically populated -->
          </tbody>
        </table>
      </div>

      <!-- ACTION BUTTONS -->
      <div class="action-bar">
        <button class="btn-add-step" type="button" onclick="addJsaStep()">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
          Tambah Baris Langkah Kerja
        </button>

        <div class="export-group">
          <button class="btn-export btn-csv" type="button" onclick="exportCsv()">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
            Export CSV
          </button>
          <button class="btn-export btn-print" type="button" onclick="printOfficialJsa()">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
            Cetak Formulir JSA Resmi
          </button>
        </div>
      </div>

    </div>

    <!-- IN-DEPTH EDUCATIONAL GUIDE (SEO DEPTH) -->
    <div class="editorial-box">
      <h2 class="editorial-title">Panduan Lengkap Penyusunan Job Safety Analysis (JSA) Sesuai Standar K3</h2>
      <p class="editorial-p">
        <strong>Job Safety Analysis (JSA)</strong>, yang juga dikenal sebagai <em>Job Hazard Analysis (JHA)</em>, adalah teknik manajemen keselamatan kerja sistematis untuk mengidentifikasi bahaya fisik, kimia, biologis, ergonomi, dan mekanis pada setiap urutan tahapan kerja, guna menetapkan langkah pencegahan sebelum kecelakaan terjadi.
      </p>

      <h3 style="color:var(--navy);font-family:'Lexend',sans-serif;font-size:1.15rem;margin:22px 0 10px">4 Tahap Utama Pembuatan JSA yang Efektif</h3>
      <ol style="padding-left:22px;color:var(--slate-700);line-height:1.75;margin-bottom:18px">
        <li><strong>Memilih Pekerjaan yang Dianalisis:</strong> Prioritaskan pekerjaan dengan tingkat frekuensi atau keparahan insiden tinggi, pekerjaan baru tanpa instruksi kerja baku, atau pekerjaan berisiko kritis (misal: hot work, confined space, ketinggian).</li>
        <li><strong>Memecah Pekerjaan Menjadi Urutan Langkah:</strong> Uraikan tugas dari awal persiapan hingga penyelesaian. Hindari membuat urutan terlalu detail (lebih dari 15 langkah) atau terlalu umum (kurang dari 3 langkah).</li>
        <li><strong>Mengidentifikasi Potensi Bahaya pada Tiap Langkah:</strong> Teliti potensi terjatuh, tertimpa, tersengat listrik, terpapar zat kimia, titik jepit (pinch point), atau postur janggal.</li>
        <li><strong>Menetapkan Tindakan Pengendalian Bahaya:</strong> Gunakan hierarki kontrol (eliminasi hingga APD) untuk merancang perlindungan yang reliabel.</li>
      </ol>

      <h3 style="color:var(--navy);font-family:'Lexend',sans-serif;font-size:1.15rem;margin:22px 0 10px">Penerapan Hirarki Pengendalian Bahaya (Hierarchy of Controls)</h3>
      <p class="editorial-p">
        Saat mengisi kolom tindakan pengendalian pada JSA, Ahli K3 dan Supervisor dilarang langsung meloncat ke pemakaian APD. Wajib memprioritaskan kontrol dari tingkat teratas:
      </p>
      <ul style="padding-left:22px;color:var(--slate-700);line-height:1.75;margin-bottom:24px">
        <li><strong>1. Eliminasi:</strong> Menghilangkan sumber bahaya secara fisik (misal: memindahkan panel listrik bertegangan sebelum dikerjakan).</li>
        <li><strong>2. Substitusi:</strong> Mengganti bahan atau alat beracun/berbahaya dengan yang lebih aman (misal: mengganti solvent berbasis benzena dengan pembersih berbasis air).</li>
        <li><strong>3. Rekayasa Teknik (Engineering Controls):</strong> Memasang pelindung mesin, exhaust ventilation, scaffolding berpagar ganda.</li>
        <li><strong>4. Pengendalian Administratif:</strong> Pemberlakuan Izin Kerja (PTW), rotasi shift kerja, safety briefing / TBM sebelum kerja.</li>
        <li><strong>5. Alat Pelindung Diri (APD):</strong> Garis pertahanan terakhir (harness, kacamata goggle, respirator N95, sepatu safety).</li>
      </ul>

      <!-- FAQ ACCORDION -->
      <h3 style="color:var(--navy);font-family:'Lexend',sans-serif;font-size:1.25rem;margin:28px 0 16px">Tanya Jawab Seputar JSA / JHA (FAQ)</h3>
      <div class="faq-box">
        
        <div class="faq-item">
          <button class="faq-q" onclick="toggleFaq(this)">
            <span>Apa perbedaan mendasar antara JSA dan IBPR / HIRADC?</span>
            <span class="faq-icon">▼</span>
          </button>
          <div class="faq-a">
            HIRADC (Hazard Identification, Risk Assessment and Determining Control) atau IBPR bersifat makro di tingkat fasilitas dan mencakup seluruh siklus operasional bisnis perusahaan secara periodik (tahunan). Sedangkan JSA bersifat mikro, operasional, dan dibuat spesifik untuk satu jenis pekerjaan tertentu sebelum pekerjaan fisik dilakukan di lapangan, biasanya menjadi lampiran wajib dokumen Surat Izin Kerja Aman (SIKA / PTW).
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-q" onclick="toggleFaq(this)">
            <span>Siapa yang wajib menandatangani formulir JSA sebelum pekerjaan dimulai?</span>
            <span class="faq-icon">▼</span>
          </button>
          <div class="faq-a">
            Formulir JSA resmi wajib ditandatangani oleh:
            <ol style="padding-left:20px;margin-top:6px">
              <li><strong>Pelaksana / Mandor:</strong> Memahami langkah dan berkomitmen menerapkan kontrol.</li>
              <li><strong>Pengawas Pekerjaan / Supervisor:</strong> Memverifikasi kesiapan alat dan keselamatan lapangan.</li>
              <li><strong>Petugas HSE / Ahli K3 Umum:</strong> Mereview kepatuhan regulasi dan standar K3 perusahaan.</li>
            </ol>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-q" onclick="toggleFaq(this)">
            <span>Berapa lama masa berlaku suatu dokumen JSA?</span>
            <span class="faq-icon">▼</span>
          </button>
          <div class="faq-a">
            Dokumen JSA berlaku selama durasi pekerjaan tersebut berlangsung (sesuai masa aktif PTW, umumnya 1 shift kerja atau maksimal 1 minggu untuk pekerjaan proyek berkelanjutan). Jika terdapat perubahan kondisi lapangan, cuaca ekstrem, pergantian mesin/metode, atau terjadi insiden, JSA wajib ditinjau ulang (review) dan direvisi seketika.
          </div>
        </div>

      </div>

    </div>

  </div>
</section>

</main>

<?php require __DIR__ . '/../includes/footer.php'; ?>

<script>
// Templates database for instant high-value generation
const jsaTemplates = {
  ketinggian: {
    title: "Pemasangan & Inspeksi Perancah Scaffolding (Ketinggian > 2m)",
    steps: [
      { step: "Pemeriksaan kondisi fisik komponen scaffolding (pipa, clamp, baseplate, catwalk)", hazard: "Pipa retak/bengkok, clamp aus berisiko patah saat menahan beban", risk: "HIGH", control: "Inspeksi visual pra-pakai, singkirkan material cacat, gunakan scaffolder berlisensi Kemnaker", pic: "Scaffolder Inspector" },
      { step: "Perataan dan pemadatan tanah landasan pemasangan baseplate", hazard: "Struktur perancah amblas atau miring akibat tanah lunak", risk: "HIGH", control: "Gunakan sole plate papan kayu solid minimal tebal 5 cm, pasang jack base waterpass", pic: "Supervisor Lapangan" },
      { step: "Ereksi rangka scaffolding, ledger, transom, dan cross-bracing", hazard: "Pekerja terjatuh dari ketinggian saat memasang pipa atas", risk: "HIGH", control: "Wajib memakai Full Body Harness double lanyard 100% tie-off ke anchor point independen", pic: "Mandor & Pekerja" },
      { step: "Pemasangan papan lantai kerja (catwalk) dan toeboard penahan", hazard: "Papan patah atau bergeser, celah longgar menyebabkan tersandung", risk: "MED", control: "Pasang lantai kerja rapat tanpa celah (> 20mm), pasang toeboard minimal tinggi 15 cm", pic: "Tim Scaffolder" },
      { step: "Pemasangan guardrail (top rail 110cm & mid rail 60cm)", hazard: "Pekerja tergelincir jatuh dari tepi perancah", risk: "HIGH", control: "Pasang railing ganda sesuai standar Permenaker No. 09/2016, pasang jaring safety net", pic: "Scaffolder" },
      { step: "Inspeksi akhir dan pemasangan Scafftag (Tag Hijau / Merah)", hazard: "Pekerja umum menggunakan perancah belum selesai / tidak aman", risk: "MED", control: "Inspeksi Ahli K3 / Scaffolder Bersertifikat, pasang Tag Hijau jika lulus, Tag Merah jika belum aman", pic: "HSE Officer" }
    ]
  },
  hotwork: {
    title: "Pekerjaan Pengelasan dan Pemotongan Besi (Hot Work)",
    steps: [
      { step: "Pemeriksaan area kerja radius 11 meter dari bahan mudah terbakar", hazard: "Percikan bunga api las menyambar solar, thinner, kayu, atau kardus", risk: "HIGH", control: "Singkirkan semua bahan B3 mudah terbakar radius 11m, tutup celah dengan fire blanket tahan api", pic: "Fire Watcher" },
      { step: "Inspeksi kabel mesin las, trafo, stang las, dan grounding clamp", hazard: "Kabel terkelupas menyebabkan sengatan listrik 380V atau korsleting", risk: "HIGH", control: "Gunakan mesin las yang telah diuji tagging bulanan, pasang grounding rapat pada benda kerja", pic: "Welder / Teknisi" },
      { step: "Penyiapan tabung gas asetilen & oksigen untuk proses cutting", hazard: "Kebocoran gas LPG/asetilen memicu ledakan tabung silinder", risk: "HIGH", control: "Pastikan tabung berdiri tegak terikat rantai, pasang flash back arrestor di regulator dan torch", pic: "Fitter" },
      { step: "Pelaksanaan proses pengelasan benda kerja", hazard: "Radiasi sinar UV/IR menyilaukan mata, asap beracun (fume) terhirup", risk: "MED", control: "Gunakan welding helmet auto-darkening shade 10-12, gunakan respirator khusus asap las (particulate filter)", pic: "Welder" },
      { step: "Pemantauan pasca pengelasan (Fire Watch Standby 30 menit)", hazard: "Bara tersembunyi menyala menjadi api setelah pekerja meninggalkan lokasi", risk: "HIGH", control: "Fire watcher standby dengan APAR powder 6kg minimal 30 menit setelah pekerjaan selesai", pic: "Petugas Fire Watch" }
    ]
  },
  confined: {
    title: "Pembersihan & Inspeksi Tangki Ruang Terbatas (Confined Space)",
    steps: [
      { step: "Isolasi energi mekanis, perpipaan, dan listrik (LOTO)", hazard: "Cairan kimia masuk atau mixer tangki menyala otomatis secara mendadak", risk: "HIGH", control: "Pasang blind flange fisik pada pipa masuk, pasang padlock dan Tag LOTO pada breaker listrik", pic: "Mekanik & HSE" },
      { step: "Pengujian atmosfer gas berbahaya (Gas Testing) pra-masuk", hazard: "Kekurangan oksigen (< 19.5%), paparan gas beracun (H2S, CO), ledakan LEL", risk: "HIGH", control: "Uji dengan 4-gas detector terkalibrasi di 3 level ketinggian (atas, tengah, bawah tangki)", pic: "Petugas Gas Tester" },
      { step: "Ventilasi udara paksa dengan blower mekanis", hazard: "Akumulasi gas beracun selama pekerjaan pembersihan berlangsung", risk: "HIGH", control: "Nyalakan blower udara segar terus menerus, arahkan exhaust jauh dari pintu masuk", pic: "Attendant" },
      { step: "Personel masuk ke dalam tangki menggunakan APD lengkap", hazard: "Pekerja pingsan atau terjebak di dalam tangki", risk: "HIGH", control: "Wajib kenakan harness dengan retrieval lifeline, sediakan breathing apparatus (SCBA/airline)", pic: "Entrant" },
      { step: "Pengawasan kontinu oleh Petugas Jaga Ruang Terbatas (Attendant)", hazard: "Keterlambatan tindakan evakuasi saat entrant mengalami kondisi darurat", risk: "HIGH", control: "Attendant standby 100% di luar manhole, catat log waktu masuk-keluar, siapkan tripot rescue", pic: "Standby Attendant" }
    ]
  },
  lifting: {
    title: "Pengangkatan Generator 10 Ton Menggunakan Mobile Crane",
    steps: [
      { step: "Pemeriksaan dokumen sertifikasi crane (SILO) dan lisensi operator (SIO)", hazard: "Kegagalan mekanis crane, ketidakmampuan operator mengendalikan beban", risk: "HIGH", control: "Pastikan SILO Kemnaker masih aktif, operator memiliki SIO Crane Kelas 1 / 2 resmi", pic: "HSE Inspector" },
      { step: "Inspeksi outrigger crane dan kestabilan landasan tanah", hazard: "Tanah amblas menyebabkan crane terguling (tip-over)", risk: "HIGH", control: "Pasang outrigger full extend, pasang pelat baja/kayu keras tebal di bawah ponton outrigger", pic: "Rigging Supervisor" },
      { step: "Inspeksi alat bantu angkat (webbing sling, shackle, spreader bar)", hazard: "Sling putus, shackle bengkok meluncurkan beban jatuh ke bawah", risk: "HIGH", control: "Cek SWL (Safe Working Load), tolak sling yang sobek/terpotong, gunakan safety latch pada hook", pic: "Rigger Bersertifikat" },
      { step: "Sterilisasi area radius putar crane (Swing Radius Barricade)", hazard: "Pekerja tertimpa beban ayun atau terjepit counterweight crane", risk: "HIGH", control: "Pasang barikade pita merah-putih di sekeliling radius putar, dilarang melintas di bawah beban", pic: "Safety Man" },
      { step: "Pengangkatan beban dan pemanduan arah menggunakan tagline", hazard: "Beban berputar tak terkendali mengenai struktur gedung sekitar", risk: "MED", control: "Gunakan tali pemandu (tagline) minimal 2 sisi, komando hanya dari 1 orang rigger berompi terang", pic: "Rigger & Tagman" }
    ]
  },
  galian: {
    title: "Pekerjaan Penggalian Tanah Pondasi Kedalaman > 2 Meter",
    steps: [
      { step: "Pengecekan jalur utilitas bawah tanah (kabel listrik, pipa gas, air)", hazard: "Mengenai kabel tegangan tinggi memicu ledakan atau pipa air pecah", risk: "HIGH", control: "Survei utilitas bawah tanah dengan cable locator, gali manual hati-hati di titik kritis", pic: "Surveyor & Pengawas" },
      { step: "Penggalian menggunakan excavator dan pembentukan kemiringan (sloping)", hazard: "Pekerja tertabrak swing excavator atau tanah longsor mendadak", risk: "HIGH", control: "Jaga jarak 5 meter dari excavator, buat kemiringan (bench/slope) rasio 1:1 sesuai jenis tanah", pic: "Operator & Mandor" },
      { step: "Pemasangan proteksi dinding penahan tanah (shoring/sheet pile)", hazard: "Dinding galian runtuh menimbun pekerja di dasar lubang", risk: "HIGH", control: "Pasang sistem penahan tanah (shoring) untuk galian > 1.5m, inspeksi pasca hujan", pic: "Supervisor Sipil" },
      { step: "Penyediaan tangga akses keluar masuk lubang galian", hazard: "Pekerja terpeleset jatuh ke lubang atau terjebak saat kondisi darurat", risk: "MED", control: "Sediakan tangga akses setiap jarak 7.5 meter, ujung tangga menonjol 1 meter di atas tanah", pic: "Mandor" },
      { step: "Penempatan tumpukan tanah galian (spoil pile)", hazard: "Beban tanah di tepi galian memicu keruntuhan dinding", risk: "HIGH", control: "Tempatkan tumpukan tanah minimal 1 meter dari bibir tepi galian", pic: "Pengawas Lapangan" }
    ]
  },
  listrik: {
    title: "Perbaikan & Perawatan Panel Listrik Tegangan Menengah (20kV)",
    steps: [
      { step: "Penerbitan Izin Kerja Listrik dan Prosedur LOTO (Lock Out Tag Out)", hazard: "Pekerja lain menyalakan breaker utama saat teknisi bekerja", risk: "HIGH", control: "Putus breaker utama, pasang pad-lock pribadi dan danger tag, simpan kunci di lockbox", pic: "Teknisi Listrik & HSE" },
      { step: "Verifikasi kondisi Nol Energi (Zero Voltage Testing)", hazard: "Tegangan sisa pada kapasitor atau kesalahan pemutusan jalur kabel", risk: "HIGH", control: "Uji dengan voltage detector terkalibrasi, lakukan pelepasan arus tanah (grounding discharge)", pic: "Ahli K3 Listrik" },
      { step: "Pemasangan Grounding Portabel Sementara", hazard: "Tegangan induksi dari kabel berdekatan yang masih aktif", risk: "HIGH", control: "Pasang portable earthing lead pada ketiga fasa kabel sebelum disentuh tangan", pic: "Teknisi Listrik" },
      { step: "Pembersihan isolator dan pengencangan baut busbar", hazard: "Paparan debu partikel atau bahaya Arc Flash jika alat terjatuh", risk: "HIGH", control: "Wajib kenakan APD Arc Flash Kit (face shield, sarung tangan isolasi 20kV, pakaian FR)", pic: "Teknisi Listrik" },
      { step: "Pelepasan gembok LOTO dan uji coba penyalaan kembali", hazard: "Peralatan/personel tertinggal di dalam panel saat tegangan dimasukkan", risk: "HIGH", control: "Inspeksi housekeeping (pastikan tidak ada kunci pas tertinggal), tutup panel rapat sebelum ON", pic: "Supervisor Listrik" }
    ]
  }
};

let currentSteps = [];

function loadTemplate(key){
  const t = jsaTemplates[key];
  if(!t) return;
  document.querySelectorAll('.preset-bar .preset-btn').forEach(b => b.classList.remove('active'));
  event.target.classList.add('active');

  document.getElementById('inpJudulKerja').value = t.title;
  currentSteps = JSON.parse(JSON.stringify(t.steps));
  renderSteps();
}

function renderSteps(){
  const tbody = document.getElementById('jsaBody');
  tbody.innerHTML = '';

  currentSteps.forEach((s, idx) => {
    const tr = document.createElement('tr');
    tr.innerHTML = `
      <td style="text-align:center;font-weight:bold;color:var(--slate-600)">${idx + 1}</td>
      <td><textarea onchange="updateStep(${idx}, 'step', this.value)">${escapeHtml(s.step)}</textarea></td>
      <td><textarea onchange="updateStep(${idx}, 'hazard', this.value)">${escapeHtml(s.hazard)}</textarea></td>
      <td style="text-align:center">
        <select class="risk-select ${s.risk === 'HIGH' ? 'risk-high' : (s.risk === 'MED' ? 'risk-med' : 'risk-low')}" onchange="updateRisk(${idx}, this)">
          <option value="HIGH" ${s.risk === 'HIGH' ? 'selected' : ''}>TINGGI (H)</option>
          <option value="MED" ${s.risk === 'MED' ? 'selected' : ''}>SEDANG (M)</option>
          <option value="LOW" ${s.risk === 'LOW' ? 'selected' : ''}>RENDAH (L)</option>
        </select>
      </td>
      <td><textarea onchange="updateStep(${idx}, 'control', this.value)">${escapeHtml(s.control)}</textarea></td>
      <td><input type="text" class="form-input" style="font-size:0.84rem" value="${escapeHtml(s.pic)}" onchange="updateStep(${idx}, 'pic', this.value)"></td>
      <td style="text-align:center">
        <button class="btn-del-step" type="button" onclick="deleteStep(${idx})" title="Hapus Baris">✕</button>
      </td>
    `;
    tbody.appendChild(tr);
  });
}

function addJsaStep(){
  currentSteps.push({
    step: "Langkah kerja baru...",
    hazard: "Potensi bahaya teridentifikasi...",
    risk: "MED",
    control: "Tindakan pengendalian hierarki K3...",
    pic: "Petugas Terkait"
  });
  renderSteps();
}

function updateStep(idx, field, val){
  if(currentSteps[idx]){
    currentSteps[idx][field] = val;
  }
}

function updateRisk(idx, selectEl){
  const val = selectEl.value;
  if(currentSteps[idx]){
    currentSteps[idx].risk = val;
    selectEl.className = 'risk-select ' + (val === 'HIGH' ? 'risk-high' : (val === 'MED' ? 'risk-med' : 'risk-low'));
  }
}

function deleteStep(idx){
  if(currentSteps.length <= 1){
    alert('Minimal harus ada 1 langkah kerja dalam JSA!');
    return;
  }
  currentSteps.splice(idx, 1);
  renderSteps();
}

function escapeHtml(text){
  return String(text).replace(/[&<>"']/g, function(m){
    return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m];
  });
}

function exportCsv(){
  const title = document.getElementById('inpJudulKerja').value;
  let csv = 'No,Urutan Langkah Kerja,Potensi Bahaya,Tingkat Risiko,Tindakan Pengendalian,Penanggung Jawab\n';
  currentSteps.forEach((s, idx) => {
    csv += `"${idx+1}","${s.step.replace(/"/g, '""')}","${s.hazard.replace(/"/g, '""')}","${s.risk}","${s.control.replace(/"/g, '""')}","${s.pic.replace(/"/g, '""')}"\n`;
  });

  const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
  const link = document.createElement("a");
  link.href = URL.createObjectURL(blob);
  link.download = `JSA_${title.replace(/[^a-zA-Z0-9]/g, '_')}.csv`;
  link.click();
}

function printOfficialJsa(){
  const title = document.getElementById('inpJudulKerja').value;
  const lokasi = document.getElementById('inpLokasi').value;
  const supervisor = document.getElementById('inpSupervisor').value;
  const hse = document.getElementById('inpHse').value;
  const ptw = document.getElementById('inpPtw').value;
  const tgl = document.getElementById('inpTanggal').value || new Date().toLocaleDateString('id-ID');

  const win = window.open('', '_blank');
  win.document.write(`<!DOCTYPE html><html><head><title>JSA Form - ${title}</title>
  <style>
    body{font-family:'Segoe UI',Arial,sans-serif;padding:24px;max-width:960px;margin:0 auto;color:#0F172A;line-height:1.4}
    .header{border-bottom:3px solid #0D233A;padding-bottom:12px;margin-bottom:16px;display:flex;justify-content:space-between;align-items:flex-end}
    h1{font-size:16pt;margin:0;color:#0D233A}
    .sub{font-size:8.5pt;color:#64748B}
    table.meta{width:100%;border-collapse:collapse;margin-bottom:16px;font-size:9pt}
    table.meta td{padding:4px 8px;border:1px solid #CBD5E1}
    table.meta th{background:#F1F5F9;text-align:left;padding:4px 8px;border:1px solid #CBD5E1;width:18%}
    table.data{width:100%;border-collapse:collapse;margin:12px 0;font-size:8.5pt}
    table.data th{background:#0D233A;color:#fff;padding:8px;border:1px solid #0D233A;text-align:left}
    table.data td{padding:8px;border:1px solid #CBD5E1;vertical-align:top}
    .badge-h{background:#FEE2E2;color:#991B1B;padding:2px 6px;border-radius:4px;font-weight:bold;font-size:8pt}
    .badge-m{background:#FEF3C7;color:#92400E;padding:2px 6px;border-radius:4px;font-weight:bold;font-size:8pt}
    .badge-l{background:#DCFCE7;color:#166534;padding:2px 6px;border-radius:4px;font-weight:bold;font-size:8pt}
    .sig-grid{display:grid;grid-template-columns:1fr 1fr 1fr;gap:20px;margin-top:28px;text-align:center;font-size:8.5pt}
    .sig-line{margin-top:50px;border-top:1px solid #000;font-weight:bold;padding-top:4px}
  </style>
  </head><body>
  <div class="header">
    <div>
      <h1>JOB SAFETY ANALYSIS (JSA) / ANALISIS KESELAMATAN KERJA</h1>
      <div class="sub">Standar Operasional Keselamatan Kerja &amp; Lampiran Izin Kerja (PTW)</div>
    </div>
    <div style="text-align:right">
      <span style="background:#E8611A;color:#fff;padding:3px 8px;border-radius:4px;font-weight:bold;font-size:8pt">FORMULIR K3 RESMI</span>
    </div>
  </div>

  <table class="meta">
    <tr>
      <th>Nama Pekerjaan</th><td><strong>${title}</strong></td>
      <th>No. Izin Kerja (PTW)</th><td><strong>${ptw}</strong></td>
    </tr>
    <tr>
      <th>Lokasi / Proyek</th><td>${lokasi}</td>
      <th>Tanggal Pelaksanaan</th><td>${tgl}</td>
    </tr>
    <tr>
      <th>Pengawas Pekerjaan</th><td>${supervisor}</td>
      <th>Ahli K3 / HSE Officer</th><td>${hse}</td>
    </tr>
  </table>

  <table class="data">
    <thead>
      <tr>
        <th style="width:30px;text-align:center">No</th>
        <th style="width:25%">Urutan Langkah Kerja</th>
        <th style="width:25%">Potensi Bahaya Teridentifikasi</th>
        <th style="width:65px;text-align:center">Risiko</th>
        <th>Tindakan Pengendalian (Hierarki K3)</th>
        <th style="width:15%">Penanggung Jawab</th>
      </tr>
    </thead>
    <tbody>
      ${currentSteps.map((s, idx) => `
        <tr>
          <td style="text-align:center">${idx + 1}</td>
          <td>${escapeHtml(s.step)}</td>
          <td>${escapeHtml(s.hazard)}</td>
          <td style="text-align:center">
            <span class="${s.risk === 'HIGH' ? 'badge-h' : (s.risk === 'MED' ? 'badge-m' : 'badge-l')}">${s.risk}</span>
          </td>
          <td>${escapeHtml(s.control)}</td>
          <td>${escapeHtml(s.pic)}</td>
        </tr>
      `).join('')}
    </tbody>
  </table>

  <div class="sig-grid">
    <div>
      Disusun &amp; Dilaksanakan oleh,<br>
      <strong>Pengawas Lapangan / Supervisor</strong>
      <div class="sig-line">${supervisor}</div>
    </div>
    <div>
      Diverifikasi oleh,<br>
      <strong>Ahli K3 Umum / HSE Officer</strong>
      <div class="sig-line">${hse}</div>
    </div>
    <div>
      Disetujui oleh,<br>
      <strong>Pimpinan Proyek / Site Manager</strong>
      <div class="sig-line">( ___________________________ )</div>
    </div>
  </div>
  </body></html>`);
  win.document.close();
  win.print();
}

function toggleFaq(btn){
  btn.parentElement.classList.toggle('active');
}

// Initial load
window.addEventListener('DOMContentLoaded', () => {
  document.getElementById('inpTanggal').valueAsDate = new Date();
  loadTemplate('ketinggian');
});
</script>

<?php require __DIR__ . '/../includes/scripts.php'; ?>
</body>
</html>
