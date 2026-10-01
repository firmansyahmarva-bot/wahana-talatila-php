<?php
require_once __DIR__ . '/../config.php';
$s = get_all_settings();

$page_title = 'Generator IBPR & HIRADC K3 2026: Identifikasi Bahaya & Penilaian Risiko';
$meta_desc = 'Buat tabel dokumen IBPR (Identifikasi Bahaya dan Penilaian Risiko) & HIRADC lengkap standar SMK3 PP 50/2012 dan ISO 45001:2018. Tersedia template manufaktur, konstruksi, dan tambang.';

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
    { "@type": "ListItem", "position": 3, "name": "Generator IBPR", "item": "https://wahanatotalita.com/tools/ibpr-generator.php" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebApplication",
  "name": "Generator Tabel IBPR & HIRADC K3 Online",
  "url": "https://wahanatotalita.com/tools/ibpr-generator.php",
  "description": "Generator formulir Identifikasi Bahaya, Penilaian Risiko, dan Pengendalian Risiko (IBPR / HIRADC) resmi standar SMK3 PP 50/2012 dan ISO 45001.",
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
      "name": "Apa kepanjangan dari IBPR dan HIRADC?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "IBPR adalah singkatan dari Identifikasi Bahaya, Penilaian Risiko, dan Pengendalian Risiko. Istilah ini merupakan padanan resmi bahasa Indonesia dari HIRADC (Hazard Identification, Risk Assessment, and Determining Controls) yang menjadi persyaratan inti Klausul 6.1.2 ISO 45001:2018 dan Lampiran II PP 50/2012."
      }
    },
    {
      "@type": "Question",
      "name": "Apa yang dimaksud dengan kondisi R, NR, dan E dalam tabel IBPR?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Dalam IBPR, seluruh aktivitas kerja wajib diklasifikasikan ke dalam 3 kondisi: (1) R (Rutin): aktivitas kerja harian yang terencana; (2) NR (Non-Rutin): aktivitas berkala atau tidak terjadwal seperti perbaikan darurat dan shutdown; (3) E (Emergency): situasi keadaan darurat seperti kebakaran, gempa bumi, atau kebocoran gas beracun."
      }
    },
    {
      "@type": "Question",
      "name": "Berapa kali dalam setahun dokumen IBPR harus ditinjau ulang (review)?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Dokumen IBPR wajib ditinjau ulang minimal 1 (satu) kali dalam setahun secara periodik oleh Tim K3, atau seketika ditinjau ulang apabila terjadi kecelakaan kerja fatal/berat, adanya perubahan mesin/peralatan baru, pergantian metode proses kerja, atau terbitnya regulasi perundang-undangan K3 baru."
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
.ibpr-hero {
  background: linear-gradient(135deg, #071524 0%, #0D233A 60%, #183654 100%);
  color: #fff;
  padding: 58px 0 44px;
  position: relative;
  overflow: hidden;
  border-bottom: 3px solid var(--orange);
}
.ibpr-hero::before {
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
.ibpr-hero h1 {
  font-family: 'Lexend', sans-serif;
  font-size: clamp(1.8rem, 3.6vw, 2.7rem);
  font-weight: 800;
  line-height: 1.2;
  margin-bottom: 12px;
}
.ibpr-hero h1 span { color: var(--orange); }
.ibpr-hero p {
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
.ibpr-wrapper { padding: 40px 0 60px; }
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

/* TEMPLATES PILLS */
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
}
.preset-btn:hover, .preset-btn.active {
  background: var(--navy);
  border-color: var(--navy);
  color: #fff;
}

/* METADATA FORM */
.meta-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 16px;
  background: var(--slate-50);
  padding: 18px;
  border-radius: var(--radius-md);
  border: 1px solid var(--slate-200);
  margin-bottom: 24px;
}
.form-field { margin-bottom: 0; }
.form-label {
  display: block;
  font-size: 0.8rem;
  font-weight: 700;
  color: var(--navy);
  margin-bottom: 4px;
  text-transform: uppercase;
}
.form-input {
  width: 100%;
  padding: 8px 12px;
  border: 1.5px solid var(--slate-200);
  border-radius: 6px;
  font-size: 0.9rem;
}
.form-input:focus { outline: none; border-color: var(--orange); }

/* IBPR TABLE */
.ibpr-table-container {
  overflow-x: auto;
  border: 1px solid var(--slate-200);
  border-radius: var(--radius-md);
  margin-bottom: 22px;
}
.ibpr-table {
  width: 100%;
  border-collapse: collapse;
  min-width: 980px;
  font-size: 0.85rem;
}
.ibpr-table th {
  background: var(--navy);
  color: #fff;
  padding: 10px 12px;
  text-align: left;
  font-weight: 700;
  font-size: 0.8rem;
  border: 1px solid rgba(255,255,255,0.1);
}
.ibpr-table td {
  padding: 10px 12px;
  border-bottom: 1px solid var(--slate-200);
  vertical-align: top;
  background: #fff;
}
.ibpr-table tr:hover td { background: var(--slate-50); }
.ibpr-table textarea {
  width: 100%;
  border: 1px solid var(--slate-200);
  border-radius: 4px;
  padding: 6px 8px;
  font-size: 0.84rem;
  font-family: inherit;
  resize: vertical;
  min-height: 56px;
}
.ibpr-table textarea:focus { outline: none; border-color: var(--orange); }

.badge-risk {
  display: inline-block;
  padding: 2px 6px;
  border-radius: 4px;
  font-size: 0.75rem;
  font-weight: bold;
}
.risk-ext { background: #FEE2E2; color: #991B1B; }
.risk-high { background: #FFEDD5; color: #9A3412; }
.risk-med { background: #FEF3C7; color: #92400E; }
.risk-low { background: #DCFCE7; color: #166534; }

/* ACTIONS */
.action-bar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 12px;
}
.btn-action-ibpr {
  padding: 10px 18px;
  border-radius: 8px;
  font-size: 0.88rem;
  font-weight: 700;
  cursor: pointer;
  border: none;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}
.btn-primary { background: var(--orange); color: #fff; }
.btn-primary:hover { background: var(--orange-hover); }
.btn-secondary { background: var(--navy-light); color: #fff; }
.btn-secondary:hover { background: var(--navy); }

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

<main class="ibpr-page" id="konten-utama">

<!-- HERO -->
<section class="ibpr-hero">
  <div class="container">
    <div class="hero-badge">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
      SMK3 PP 50/2012 &amp; ISO 45001:2018
    </div>
    <h1>Generator IBPR &amp; HIRADC <span>Online 2026</span></h1>
    <p>Susun tabel Identifikasi Bahaya, Penilaian Risiko, dan Pengendalian Risiko (IBPR / HIRADC) komprehensif. Sesuaikan kondisi operasional Rutin, Non-Rutin, dan Darurat serta cetak dokumen resmi audit SMK3.</p>
    <div class="hero-tags">
      <span class="hero-tag">Elemen 2 Perencanaan SMK3 PP 50/2012</span>
      <span class="hero-tag">Klausul 6.1.2 ISO 45001:2018</span>
      <span class="hero-tag">Initial vs Residual Risk Rating</span>
      <span class="hero-tag">Export CSV &amp; Cetak Lembar Pengesahan</span>
    </div>
  </div>
</section>

<!-- MAIN WORKSPACE -->
<section class="ibpr-wrapper">
  <div class="container">
    
    <div class="card-box">
      
      <!-- TEMPLATES -->
      <div class="card-header-line">
        <h2 class="card-title">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--orange)" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
          Pilih Template Matriks Industri
        </h2>
        <span style="font-size:0.8rem;color:var(--slate-600)">Klik untuk memuat data tabel awal:</span>
      </div>

      <div class="preset-bar">
        <button class="preset-btn active" type="button" onclick="loadIbprTemplate('manufaktur')">🏭 Industri Manufaktur &amp; Fabrikasi Logam</button>
        <button class="preset-btn" type="button" onclick="loadIbprTemplate('konstruksi')">🏗️ Proyek Konstruksi Gedung &amp; Sipil</button>
        <button class="preset-btn" type="button" onclick="loadIbprTemplate('tambang')">⛏️ Pertambangan &amp; Pengolahan Mineral</button>
        <button class="preset-btn" type="button" onclick="loadIbprTemplate('logistik')">📦 Pergudangan &amp; Distribusi Logistik</button>
      </div>

      <!-- METADATA FORM -->
      <div class="meta-grid">
        <div class="form-field">
          <label class="form-label" for="inpPerusahaan">Nama Perusahaan / Site</label>
          <input type="text" id="inpPerusahaan" class="form-input" value="PT Wahana Totalita Mandiri">
        </div>
        <div class="form-field">
          <label class="form-label" for="inpDepartemen">Departemen / Area Proses</label>
          <input type="text" id="inpDepartemen" class="form-input" value="Workshop Fabrikasi &amp; Machining">
        </div>
        <div class="form-field">
          <label class="form-label" for="inpKetuaTim">Ketua Tim HIRADC / Ahli K3</label>
          <input type="text" id="inpKetuaTim" class="form-input" value="Bambang Wijaya, S.T. (Ahli K3 Umum)">
        </div>
        <div class="form-field">
          <label class="form-label" for="inpTglReview">Tanggal Penyusunan / Review</label>
          <input type="date" id="inpTglReview" class="form-input">
        </div>
      </div>

      <!-- IBPR TABLE -->
      <div class="ibpr-table-container">
        <table class="ibpr-table" id="ibprTable">
          <thead>
            <tr>
              <th rowspan="2" style="width:36px;text-align:center">No</th>
              <th rowspan="2" style="width:16%">Aktivitas / Proses Kerja</th>
              <th rowspan="2" style="width:60px;text-align:center">Kondisi</th>
              <th rowspan="2" style="width:18%">Identifikasi Bahaya &amp; Dampak Risiko</th>
              <th colspan="3" style="text-align:center;background:#071524">Risiko Awal (Initial)</th>
              <th rowspan="2" style="width:18%">Rencana Pengendalian Tambahan (Hierarki K3)</th>
              <th colspan="2" style="text-align:center;background:#071524">Risiko Sisa</th>
              <th rowspan="2" style="width:36px;text-align:center">Aksi</th>
            </tr>
            <tr>
              <th style="width:40px;text-align:center">L</th>
              <th style="width:40px;text-align:center">C</th>
              <th style="width:50px;text-align:center">Level</th>
              <th style="width:40px;text-align:center">Skor</th>
              <th style="width:50px;text-align:center">Level</th>
            </tr>
          </thead>
          <tbody id="ibprBody">
            <!-- Dynamically populated -->
          </tbody>
        </table>
      </div>

      <!-- ACTION BUTTONS -->
      <div class="action-bar">
        <button class="btn-action-ibpr btn-secondary" type="button" onclick="addIbprRow()">
          + Tambah Baris Aktivitas
        </button>

        <div style="display:flex;gap:10px">
          <button class="btn-action-ibpr btn-secondary" type="button" onclick="exportIbprCsv()" style="background:#fff;color:var(--navy);border:1.5px solid var(--slate-300)">
            Export CSV
          </button>
          <button class="btn-action-ibpr btn-primary" type="button" onclick="printOfficialIbpr()">
            Cetak Dokumen IBPR Resmi
          </button>
        </div>
      </div>

    </div>

    <!-- IN-DEPTH EDITORIAL ARTICLE (SEO DEPTH) -->
    <div class="editorial-box">
      <h2 class="editorial-title">Penyusunan Dokumen IBPR / HIRADC Sesuai Standar PP 50/2012</h2>
      <p class="editorial-p">
        Identifikasi Bahaya, Penilaian Risiko, dan Pengendalian Risiko (IBPR) merupakan pilar utama penerapan <strong>Sistem Manajemen K3 (SMK3) berdasarkan Peraturan Pemerintah No. 50 Tahun 2012</strong> Elemen 2 tentang Perencanaan K3, serta Klausul 6.1.2 <strong>ISO 45001:2018</strong>. Dokumen ini menjadi rujukan legal apakah suatu tempat kerja telah melakukan mitigasi proaktif sebelum terjadi kecelakaan.
      </p>

      <h3 style="color:var(--navy);font-family:'Lexend',sans-serif;font-size:1.15rem;margin:22px 0 10px">Klasifikasi Kondisi Operasional (Rutin, Non-Rutin, Emergency)</h3>
      <p class="editorial-p">
        Saat melakukan asesmen bahaya, tim K3 dilarang hanya melihat proses normal. Wajib mengklasifikasikan ke dalam 3 kondisi:
      </p>
      <ul style="padding-left:22px;color:var(--slate-700);line-height:1.75;margin-bottom:18px">
        <li><strong>Rutin (R):</strong> Seluruh kegiatan operasional harian yang memiliki siklus teratur dan dikerjakan oleh pekerja tetap (misal: pengoperasian mesin bubut, packaging gudang).</li>
        <li><strong>Non-Rutin (NR):</strong> Aktivitas yang dilakukan sewaktu-waktu atau berkala (misal: maintenance tahunan, perbaikan atap bocor, pembersihan ruang terbatas). Seringkali menjadi sumber kecelakaan fatal terbesar.</li>
        <li><strong>Emergency (E):</strong> Keadaan tidak terduga yang mengancam keselamatan jiwa dan fasilitas secara massal (misal: kebakaran pabrik, gempa bumi, ledakan bejana tekan, tumpahan bahan kimia B3 berskala besar).</li>
      </ul>

      <!-- FAQ ACCORDION -->
      <h3 style="color:var(--navy);font-family:'Lexend',sans-serif;font-size:1.25rem;margin:28px 0 16px">Tanya Jawab Seputar IBPR / HIRADC (FAQ)</h3>
      <div class="faq-box">
        
        <div class="faq-item">
          <button class="faq-q" onclick="toggleFaq(this)">
            <span>Apakah auditor eksternal SMK3 mewajibkan seluruh bahaya memiliki risiko sisa Rendah (Low)?</span>
            <span class="faq-icon">▼</span>
          </button>
          <div class="faq-a">
            Tidak harus selalu Rendah (Low). Namun seluruh risiko awal berkategori Ekstrem (Extreme) dan Tinggi (High) WAJIB diturunkan hingga mencapai kategori Sedang (Medium) atau Rendah (Low) yang memenuhi kriteria ALARP (As Low As Reasonably Practicable). Jika risiko sisa masih Tinggi, pekerjaan tersebut belum layak dijalankan tanpa izin khusus Direksi.
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-q" onclick="toggleFaq(this)">
            <span>Apa perbedaan mendasar antara IBPR dan JSA?</span>
            <span class="faq-icon">▼</span>
          </button>
          <div class="faq-a">
            IBPR bersifat makro di tingkat fasilitas dan mencakup seluruh siklus operasional bisnis perusahaan secara periodik (tahunan). Sedangkan JSA bersifat mikro, operasional, dan dibuat spesifik untuk satu jenis pekerjaan tertentu sebelum pekerjaan fisik dilakukan di lapangan, biasanya menjadi lampiran wajib dokumen Surat Izin Kerja Aman (SIKA / PTW).
          </div>
        </div>

      </div>

    </div>

  </div>
</section>

</main>

<?php require __DIR__ . '/../includes/footer.php'; ?>

<script>
const ibprTemplates = {
  manufaktur: [
    { act: "Pemotongan plat baja dengan mesin shearing hidrolik", cond: "R", hazard: "Jari tangan terjepit pisau pemotong, terkena gram tajam", l1: 4, c1: 4, score1: 16, cat1: "EXTREME", control: "Pemasangan interlock sensor otomatis, wajib sarung tangan Cut Level 5, SOP kerja mesin", l2: 2, c2: 2, score2: 4, cat2: "LOW" },
    { act: "Pembersihan tangki degreasing bahan kimia pelarut", cond: "NR", hazard: "Inhalasi uap pelarut organik beracun, dermatitis kulit", l1: 4, c1: 3, score1: 12, cat1: "HIGH", control: "Blower ventilasi hisap mekanis, respirator cartridge gas organik, sarung tangan nitril panjang", l2: 2, c2: 2, score2: 4, cat2: "LOW" },
    { act: "Pengoperasian forklift bongkar muat pallet di gudang", cond: "R", hazard: "Pekerja tertabrak forklift di persimpangan buta (blind spot)", l1: 3, c1: 4, score1: 12, cat1: "HIGH", control: "Marka jalur pejalan kaki warna hijau, cermin cembung tikungan, batas speed 10 km/jam", l2: 2, c2: 2, score2: 4, cat2: "LOW" }
  ],
  konstruksi: [
    { act: "Pengecoran balok lantai 4 pada scaffolding ketinggian", cond: "R", hazard: "Pekerja jatuh dari ketinggian > 10 meter, perancah rubuh", l1: 4, c1: 5, score1: 20, cat1: "EXTREME", control: "Full Body Harness 100% tie-off ke lifeline independen, inspeksi scafftag hijau, safety net", l2: 2, c2: 3, score2: 6, cat2: "MED" },
    { act: "Pengangkatan rangka baja kolom menggunakan Mobile Crane 25T", cond: "NR", hazard: "Kawat seling putus, crane terguling akibat tanah lembek", l1: 3, c1: 5, score1: 15, cat1: "EXTREME", control: "Cek SWL load chart, outrigger pad pelat baja tebal, rigger berlisensi SIO Kemnaker", l2: 1, c2: 4, score2: 4, cat2: "LOW" }
  ],
  tambang: [
    { act: "Pengangkutan bijih batubara dengan Dump Truck 50 Ton", cond: "R", hazard: "Tabrakan di jalan hauling, dump truck terbalik di jurang", l1: 3, c1: 5, score1: 15, cat1: "EXTREME", control: "Pemisahan jalur hauling, tanggul pengaman (safety bund) tinggi 3/4 diameter roda, fatigue sensor", l2: 1, c2: 4, score2: 4, cat2: "LOW" }
  ],
  logistik: [
    { act: "Penyusunan barang pada rak tinggi warehouse (High Reach)", cond: "R", hazard: "Barang pallet roboh menimpa operator reach truck", l1: 3, c1: 4, score1: 12, cat1: "HIGH", control: "Overhead guard baja pada kabin operator, batas kapasitas beban rak, wrapping stretch film rapat", l2: 1, c2: 3, score2: 3, cat2: "LOW" }
  ]
};

let currentRows = [];

function loadIbprTemplate(key){
  const t = ibprTemplates[key];
  if(!t) return;
  document.querySelectorAll('.preset-bar .preset-btn').forEach(b => b.classList.remove('active'));
  event.target.classList.add('active');

  currentRows = JSON.parse(JSON.stringify(t));
  renderIbprTable();
}

function getRiskCategory(score){
  if(score >= 15) return { cat: 'EXTREME', cls: 'risk-ext' };
  if(score >= 10) return { cat: 'HIGH', cls: 'risk-high' };
  if(score >= 5)  return { cat: 'MED', cls: 'risk-med' };
  return { cat: 'LOW', cls: 'risk-low' };
}

function renderIbprTable(){
  const tbody = document.getElementById('ibprBody');
  tbody.innerHTML = '';

  currentRows.forEach((r, idx) => {
    const info1 = getRiskCategory(r.score1);
    const info2 = getRiskCategory(r.score2);

    const tr = document.createElement('tr');
    tr.innerHTML = `
      <td style="text-align:center;font-weight:bold">${idx + 1}</td>
      <td><textarea onchange="updateIbpr(${idx}, 'act', this.value)">${escapeHtml(r.act)}</textarea></td>
      <td style="text-align:center">
        <select class="form-input" style="padding:4px;font-size:0.8rem;font-weight:bold" onchange="updateIbpr(${idx}, 'cond', this.value)">
          <option value="R" ${r.cond === 'R' ? 'selected' : ''}>R</option>
          <option value="NR" ${r.cond === 'NR' ? 'selected' : ''}>NR</option>
          <option value="E" ${r.cond === 'E' ? 'selected' : ''}>E</option>
        </select>
      </td>
      <td><textarea onchange="updateIbpr(${idx}, 'hazard', this.value)">${escapeHtml(r.hazard)}</textarea></td>
      <td style="text-align:center"><input type="number" min="1" max="5" class="form-input" style="padding:4px;text-align:center" value="${r.l1}" onchange="calcRow(${idx}, 'l1', this.value)"></td>
      <td style="text-align:center"><input type="number" min="1" max="5" class="form-input" style="padding:4px;text-align:center" value="${r.c1}" onchange="calcRow(${idx}, 'c1', this.value)"></td>
      <td style="text-align:center"><span class="badge-risk ${info1.cls}">${info1.cat} (${r.score1})</span></td>
      <td><textarea onchange="updateIbpr(${idx}, 'control', this.value)">${escapeHtml(r.control)}</textarea></td>
      <td style="text-align:center"><strong style="color:var(--navy)">${r.score2}</strong></td>
      <td style="text-align:center"><span class="badge-risk ${info2.cls}">${info2.cat}</span></td>
      <td style="text-align:center">
        <button style="border:none;background:#FEE2E2;color:#991B1B;padding:2px 6px;border-radius:4px;cursor:pointer;font-weight:bold" onclick="delIbprRow(${idx})">✕</button>
      </td>
    `;
    tbody.appendChild(tr);
  });
}

function updateIbpr(idx, field, val){
  if(currentRows[idx]) currentRows[idx][field] = val;
}

function calcRow(idx, field, val){
  const r = currentRows[idx];
  if(!r) return;
  r[field] = parseInt(val) || 1;
  r.score1 = r.l1 * r.c1;
  r.score2 = Math.max(1, Math.round(r.score1 * 0.25)); // Residual risk auto estimated
  renderIbprTable();
}

function addIbprRow(){
  currentRows.push({
    act: "Aktivitas kerja baru...",
    cond: "R",
    hazard: "Potensi bahaya teridentifikasi...",
    l1: 3, c1: 3, score1: 9, cat1: "MED",
    control: "Rencana tindakan pengendalian K3...",
    l2: 1, c2: 2, score2: 2, cat2: "LOW"
  });
  renderIbprTable();
}

function delIbprRow(idx){
  if(currentRows.length <= 1){
    alert('Minimal harus ada 1 baris aktivitas dalam tabel IBPR!');
    return;
  }
  currentRows.splice(idx, 1);
  renderIbprTable();
}

function escapeHtml(text){
  return String(text).replace(/[&<>"']/g, function(m){
    return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m];
  });
}

function exportIbprCsv(){
  let csv = 'No,Aktivitas,Kondisi,Bahaya & Dampak,L_Awal,C_Awal,Skor_Awal,Tindakan Pengendalian,Skor_Sisa\n';
  currentRows.forEach((r, i) => {
    csv += `"${i+1}","${r.act.replace(/"/g, '""')}","${r.cond}","${r.hazard.replace(/"/g, '""')}","${r.l1}","${r.c1}","${r.score1}","${r.control.replace(/"/g, '""')}","${r.score2}"\n`;
  });
  const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
  const link = document.createElement("a");
  link.href = URL.createObjectURL(blob);
  link.download = `IBPR_HIRADC_${new Date().toISOString().slice(0,10)}.csv`;
  link.click();
}

function printOfficialIbpr(){
  const perush = document.getElementById('inpPerusahaan').value;
  const dept = document.getElementById('inpDepartemen').value;
  const ketua = document.getElementById('inpKetuaTim').value;
  const tgl = document.getElementById('inpTglReview').value || new Date().toLocaleDateString('id-ID');

  const win = window.open('', '_blank');
  win.document.write(`<!DOCTYPE html><html><head><title>Dokumen IBPR - ${perush}</title>
  <style>
    body{font-family:'Segoe UI',Arial,sans-serif;padding:24px;max-width:1050px;margin:0 auto;color:#0F172A;line-height:1.4}
    h1{font-size:16pt;margin:0;color:#0D233A;border-bottom:2px solid #0D233A;padding-bottom:6px}
    .sub{font-size:8.5pt;color:#64748B;margin:4px 0 12px}
    table{width:100%;border-collapse:collapse;margin:10px 0;font-size:8.5pt}
    th,td{border:1px solid #CBD5E1;padding:6px 8px;text-align:left;vertical-align:top}
    th{background:#0D233A;color:#fff}
    .sig{margin-top:30px;display:grid;grid-template-columns:1fr 1fr;gap:40px;text-align:center;font-size:9pt}
    .line{margin-top:50px;border-top:1px solid #000;font-weight:bold}
  </style>
  </head><body>
  <h1>TABEL IDENTIFIKASI BAHAYA &amp; PENILAIAN RISIKO (IBPR / HIRADC)</h1>
  <div class="sub">Perusahaan: <strong>${perush}</strong> | Dept: <strong>${dept}</strong> | Tanggal: ${tgl}</div>
  <table>
    <thead>
      <tr>
        <th style="width:25px">No</th>
        <th>Aktivitas Kerja</th>
        <th style="width:30px">Kond</th>
        <th>Potensi Bahaya &amp; Dampak</th>
        <th style="width:35px">Skor Awal</th>
        <th>Pengendalian Tambahan (Hirarki K3)</th>
        <th style="width:35px">Skor Sisa</th>
      </tr>
    </thead>
    <tbody>
      ${currentRows.map((r, i) => `
        <tr>
          <td style="text-align:center">${i+1}</td>
          <td>${escapeHtml(r.act)}</td>
          <td style="text-align:center"><strong>${r.cond}</strong></td>
          <td>${escapeHtml(r.hazard)}</td>
          <td style="text-align:center"><strong>${r.score1}</strong></td>
          <td>${escapeHtml(r.control)}</td>
          <td style="text-align:center"><strong>${r.score2}</strong></td>
        </tr>
      `).join('')}
    </tbody>
  </table>
  <div class="sig">
    <div>Disusun oleh,<br><strong>Ketua Tim HIRADC / Ahli K3 Umum</strong><div class="line">${ketua}</div></div>
    <div>Disahkan oleh,<br><strong>Pimpinan Manajemen Puncak</strong><div class="line">( ___________________________ )</div></div>
  </div>
  </body></html>`);
  win.document.close();
  win.print();
}

function toggleFaq(btn){
  btn.parentElement.classList.toggle('active');
}

window.addEventListener('DOMContentLoaded', () => {
  document.getElementById('inpTglReview').valueAsDate = new Date();
  loadIbprTemplate('manufaktur');
});
</script>

<?php require __DIR__ . '/../includes/scripts.php'; ?>
</body>
</html>