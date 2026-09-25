<?php
require_once __DIR__ . '/config.php';
$wa_number = preg_replace('/\D/', '', get_setting('wa_number', '6287759151278'));
$year      = date('Y');
$gtm_id    = 'GTM-MMZHD3HN';
$wa_consult = "https://wa.me/{$wa_number}?text=" . rawurlencode('Halo, saya ingin konsultasi pendampingan CSMS dan program pelatihan K3');
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Panduan Lengkap CSMS (Contractor Safety Management System) Indonesia <?=$year?> | Wahana Totalita</title>
<meta name="description" content="Panduan komprehensif CSMS (Contractor Safety Management System) Indonesia 2026. Pelajari 7 elemen penilaian, matriks risiko, dokumen pre-kualifikasi Pertamina & SKK Migas, HSE Plan, audit lapangan, hingga strategi lolos sertifikasi High Risk.">
<link rel="canonical" href="https://wahanatotalita.com/csms">
<meta property="og:type"        content="article">
<meta property="og:title"       content="Panduan Lengkap CSMS (Contractor Safety Management System) Indonesia | Wahana Totalita">
<meta property="og:description" content="Panduan komprehensif CSMS untuk kontraktor & vendor Pertamina, SKK Migas, PLN, BUMN. Pembahasan 7 elemen CSMS, penilaian risiko, HSE plan, audit lapangan, & tips lolos pre-kualifikasi.">
<meta property="og:url"         content="https://wahanatotalita.com/csms">
<meta property="og:image"       content="https://wahanatotalita.com/assets/img/og-cover.svg">
<meta property="og:locale"      content="id_ID">
<meta name="twitter:card"       content="summary_large_image">
<meta name="robots"             content="index, follow, max-image-preview:large">
<meta name="theme-color"        content="#103A5C">
<link rel="icon" type="image/png" sizes="32x32" href="/assets/img/favicon-32.png">
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','<?=$gtm_id?>');</script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Lexend:wght@500;600;700;800&family=Source+Sans+3:ital,wght@0,400;0,500;0,600;1,400&display=swap">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lexend:wght@500;600;700;800&family=Source+Sans+3:ital,wght@0,400;0,500;0,600;1,400&display=swap" media="print" onload="this.media='all'">
<noscript>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lexend:wght@500;600;700;800&family=Source+Sans+3:ital,wght@0,400;0,500;0,600;1,400&display=swap">
</noscript>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "BreadcrumbList",
      "itemListElement": [
        {
          "@type": "ListItem",
          "position": 1,
          "name": "Beranda",
          "item": "https://wahanatotalita.com/"
        },
        {
          "@type": "ListItem",
          "position": 2,
          "name": "Panduan K3",
          "item": "https://wahanatotalita.com/csms"
        },
        {
          "@type": "ListItem",
          "position": 3,
          "name": "CSMS Indonesia",
          "item": "https://wahanatotalita.com/csms"
        }
      ]
    },
    {
      "@type": "TechArticle",
      "headline": "Panduan Lengkap CSMS (Contractor Safety Management System) Indonesia",
      "description": "Panduan teknis dan akademis mengenai implementasi Contractor Safety Management System (CSMS) di sektor migas, pertambangan, energi, dan konstruksi Indonesia.",
      "author": {
        "@type": "Organization",
        "name": "Wahana Totalita Konsultan",
        "url": "https://wahanatotalita.com"
      },
      "publisher": {
        "@type": "Organization",
        "name": "Wahana Totalita",
        "logo": {
          "@type": "ImageObject",
          "url": "https://wahanatotalita.com/assets/img/favicon-32.png"
        }
      },
      "datePublished": "2026-01-15",
      "dateModified": "2026-08-11",
      "inLanguage": "id-ID"
    },
    {
      "@type": "FAQPage",
      "mainEntity": [
        {
          "@type": "Question",
          "name": "Apa itu CSMS (Contractor Safety Management System)?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "CSMS adalah sistem sistematis untuk mengelola K3LL (Keselamatan, Kesehatan Kerja dan Perlindungan Lingkungan) bagi kontraktor yang bekerja di lingkungan perusahaan pemilik proyek (Principal), mulai dari tahap prakualifikasi, seleksi tender, pekerjaan lapangan, hingga evaluasi akhir."
          }
        },
        {
          "@type": "Question",
          "name": "Apakah CSMS Pertamina dan SKK Migas Wajib Bagi Semua Kontraktor?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Ya, CSMS hukumnya wajib bagi seluruh vendor, supplier jasa, dan kontraktor yang ingin berpartisipasi dalam tender di lingkungan PT Pertamina (Persero), KKKS di bawah SKK Migas, PLN, serta BUMN dan perusahaan energi swasta di Indonesia."
          }
        },
        {
          "@type": "Question",
          "name": "Apa perbedaan utama antara CSMS, SMK3 PP 50/2012, dan ISO 45001:2018?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "SMK3 PP 50/2012 dan ISO 45001 adalah standar Sistem Manajemen K3 internal perusahaan, sedangkan CSMS adalah sistem evaluasi K3 yang diterapkan oleh Perusahaan Pemilik Proyek (Principal) untuk menyaring, mengawasi, dan menilai kinerja K3 pihak ketiga (kontraktor/vendor)."
          }
        },
        {
          "@type": "Question",
          "name": "Berapa batas minimal skor (cut-off score) untuk lolos CSMS Pertamina?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Batas minimal skor tergantung kategori risiko pekerjaan: Risiko Tinggi (High Risk) umumnya membutuhkan skor minimal 75%-80%, Risiko Sedang (Medium Risk) 60%-70%, dan Risiko Rendah (Low Risk) minimal 50%."
          }
        },
        {
          "@type": "Question",
          "name": "Berapa lama masa berlaku sertifikat Pre-Kualifikasi CSMS?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Masa berlaku sertifikat prakualifikasi CSMS umumnya 2 hingga 3 tahun tergantung regulasi Principal. Namun, status dapat ditinjau ulang atau dicabut jika terjadi kecelakaan kerja fatal (Fatality) pada proyek yang sedang berjalan."
          }
        },
        {
          "@type": "Question",
          "name": "Apakah Sertifikat ISO 45001 Otomatis Meloloskan Prakualifikasi CSMS?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Tidak otomatis. Meskipun memiliki ISO 45001 memberi nilai tambah pada Elemen Kebijakan dan Organisasi, kontraktor tetap wajib mengisi kuesioner spesifik CSMS dan melampirkan bukti implementasi nyata (records) sesuai format Principal."
          }
        },
        {
          "@type": "Question",
          "name": "Apakah Perusahaan Kecil / CV Bisa Mendaftar CSMS Pertamina?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Bisa. Pengajuan CSMS disesuaikan dengan tingkat risiko pekerjaan. Untuk pekerjaan risiko rendah atau sedang (seperti pengadaan bahan, jasa katering, IT maintenance), CV tetap dapat memenuhi dokumen CSMS sesuai porsinya."
          }
        },
        {
          "@type": "Question",
          "name": "Apa yang Terjadi Jika Kontraktor Gagal Lolos Pre-Kualifikasi CSMS?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Kontraktor yang tidak memenuhi skor minimal dinyatakan Gagal Pre-Kualifikasi dan tidak diperbolehkan mengikuti tender untuk kategori risiko tersebut selama masa pembinaan (biasanya 6-12 bulan) hingga dilakukan pengajuan ulang (re-assessment)."
          }
        }
      ]
    }
  ]
}
</script>
<link rel="stylesheet" href="<?= asset_v('/assets/css/page/csms.css') ?>">
<link rel="stylesheet" href="<?= asset_v('/assets/css/page/csms-modern.css') ?>">
</head>
<body>
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?=$gtm_id?>" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

<!-- NAVBAR -->
<nav class="navbar">
  <div class="container inner">
    <a href="/" class="nav-logo">Wahana Totalita <span>.</span></a>
    <ul class="nav-links">
      <li><a href="/#produk">Program Pelatihan</a></li>
      <li><a href="/jadwal-pelatihan">Jadwal Sertifikasi</a></li>
      <li><a href="/csms" style="color:var(--primary);font-weight:700">Panduan CSMS</a></li>
      <li><a href="/artikel/">Artikel K3</a></li>
    </ul>
    <a href="<?=$wa_consult?>" target="_blank" rel="noopener" class="btn-wa-sm">💬 Konsultasi CSMS</a>
  </div>
</nav>

<!-- HERO SECTION -->
<header class="hero">
  <div class="container">
    <nav aria-label="Breadcrumb">
      <ol class="breadcrumb">
        <li><a href="/">Beranda</a></li>
        <li>›</li>
        <li><a href="/csms">Panduan K3</a></li>
        <li>›</li>
        <li aria-current="page">CSMS Indonesia</li>
      </ol>
    </nav>
    <div class="hero-eyebrow">🛡️ PANDUAN ULTIMATE COMPLIANCE VENDOR & TENDER K3</div>
    <h1>Panduan Komprehensif <span>CSMS</span><br>(Contractor Safety Management System)</h1>
    <p class="hero-lead">
      Buku panduan utama pengelolaan K3 kontraktor untuk standar Pertamina, SKK Migas, PLN, BUMN, dan Industri Energi: 7 elemen penilaian, matriks risiko pekerjaan, pengisian berkas prakualifikasi, penyusunan HSE Plan, hingga audit lapangan.
    </p>
    <div class="hero-meta">
      <div class="hero-meta-item">⏱️ <strong>25 Menit Baca</strong></div>
      <div class="hero-meta-item">📚 <strong>14 Bab Pembahasan</strong></div>
      <div class="hero-meta-item">📅 <strong>Diperbarui 2026</strong></div>
      <div class="hero-meta-item">🏛️ <strong>Standar Pertamina & SKK Migas (PTK-005)</strong></div>
    </div>
    <div class="hero-btns">
      <a href="<?=$wa_consult?>" target="_blank" rel="noopener" class="btn-primary">💬 Konsultasi Pendampingan CSMS</a>
      <a href="#bab-1" class="btn-outline">Mulai Membaca Panduan ↓</a>
    </div>
  </div>
</header>

<section class="csms-trust" aria-labelledby="csms-trust-title">
  <div class="container">
    <div class="csms-trust-head">
      <h2 id="csms-trust-title">Pendampingan berbasis praktik lapangan</h2>
      <p>Dokumentasi pelatihan, simulasi keadaan darurat, pemeriksaan peralatan, dan diskusi penerapan sistem K3 perusahaan.</p>
    </div>
    <div class="csms-photo-row">
      <figure class="csms-photo"><img src="/galeri/thumbs/PELATIHAN%20DAMKAR.JPG" alt="Simulasi tanggap darurat dan keselamatan kerja untuk sertifikasi CSMS K3" width="640" height="427" loading="lazy" decoding="async"><span>Simulasi tanggap darurat</span></figure>
      <figure class="csms-photo"><img src="/galeri/thumbs/IMG_1945.JPG" alt="Pemeriksaan peralatan keselamatan kerja industri sertifikasi Kemnaker RI" width="640" height="427" loading="lazy" decoding="async"><span>Pemeriksaan peralatan</span></figure>
      <figure class="csms-photo"><img src="/galeri/thumbs/DSC_0282.JPG" alt="Diskusi peserta pelatihan Ahli K3 Umum dan implementasi CSMS" width="640" height="427" loading="lazy" decoding="async"><span>Diskusi implementasi</span></figure>
      <figure class="csms-photo"><img src="/galeri/thumbs/IMG_1910.JPG" alt="Dokumentasi peserta pembinaan sertifikasi K3 Wahana Totalita" width="640" height="427" loading="lazy" decoding="async"><span>Bukti kegiatan</span></figure>
    </div>
  </div>
</section>

<!-- MAIN CONTENT WRAPPER -->
<div class="main-wrapper">
  <div class="container">
    <div class="article-grid">

      <!-- SIDEBAR WITH TABLE OF CONTENTS -->
      <aside class="sidebar">
        <nav class="toc-box" aria-label="Daftar Isi">
          <div class="toc-title">📖 Daftar Isi Panduan</div>
          <ul class="toc-list">
            <li><a href="#bab-1">1. Pengertian & Peran Strategis CSMS</a></li>
            <li><a href="#bab-2">2. Landasan Hukum & Regulasi CSMS</a></li>
            <li><a href="#bab-3">3. CSMS vs SMK3 PP 50 vs ISO 45001</a></li>
            <li><a href="#bab-4">4. Siklus Hidup CSMS (6 Tahapan)</a></li>
            <li><a href="#bab-5">5. 7 Elemen Utama Penilaian CSMS</a></li>
            <li><a href="#bab-6">6. Kategorisasi Risiko Pekerjaan</a></li>
            <li><a href="#bab-7">7. Berkas Prakualifikasi CSMS Wajib</a></li>
            <li><a href="#bab-8">8. Menyusun HSE Plan Tender Unggul</a></li>
            <li><a href="#bab-9">9. Pelaksanaan & Pengawasan Lapangan</a></li>
            <li><a href="#bab-10">10. Evaluasi Akhir & Rating Kontraktor</a></li>
            <li><a href="#bab-11">11. 10 Kesalahan Fatal Penyebab Gagal</a></li>
            <li><a href="#bab-12">12. Roadmap 30 Hari Persiapan CSMS</a></li>
            <li><a href="#bab-13">13. Tanya Jawab Terlengkap (FAQ)</a></li>
            <li><a href="#bab-14">14. Pendampingan CSMS Wahana Totalita</a></li>
          </ul>
        </nav>

        <div class="sidebar-cta">
          <h3>Ingin Lolos CSMS Pertamina Tanpa Gagal?</h3>
          <p>Dapatkan pendampingan audit berkas, penyusunan HSE Plan, hingga pelatihan personil K3 bersertifikat KEMNAKER RI / BNSP.</p>
          <a href="<?=$wa_consult?>" target="_blank" rel="noopener" class="btn-sidebar">💬 Hubungi Ahli K3 Kami</a>
        </div>
      </aside>

      <!-- MAIN ARTICLE BODY -->
      <article class="article-body">

        <!-- BAB 1 -->
        <section id="bab-1">
          <h2>1. Pengertian & Peran Strategis CSMS dalam Industri Berisiko Tinggi</h2>
          <p>
            <strong>Contractor Safety Management System (CSMS)</strong> adalah suatu sistem manajemen komprehensif yang dirancang oleh perusahaan pemilik proyek (<em>Principal</em>/<em>Owner</em>) untuk mengelola, mengevaluasi, mengecek, dan meningkatkan kinerja K3LL (Keselamatan, Kesehatan Kerja, dan Perlindungan Lingkungan) dari para kontraktor, vendor, dan penyedia jasa yang bekerja di lingkungan operasional mereka.
          </p>
          <p>
            Dalam dunia industri modern—khususnya sektor Minyak dan Gas Bumi (Migas), Pertambangan, Ketenagalistrikan (PLN), Petrokimia, dan Konstruksi Infrastruktur—penggunaan tenaga kerja kontraktor telah mencapai lebih dari 60% hingga 80% dari total jam kerja operasional di lapangan. Tingginya ketergantungan pada pihak ketiga ini membawa tantangan keselamatan yang sangat signifikan. Data histori industri menunjukkan bahwa angka kecelakaan kerja (<em>accident rate</em>) pada pekerja kontraktor secara konsisten lebih tinggi dibandingkan dengan karyawan organik pemilik proyek.
          </p>
          <p>
            Oleh karena itu, CSMS berfungsi sebagai <strong>sistem filter keselamatan (safety gatekeeper)</strong>. CSMS memastikan bahwa hanya kontraktor yang memiliki komitmen K3 nyata, sistem kerja yang terstruktur, personil bersertifikat, dan rekam jejak keselamatan yang teruji yang diperbolehkan menginjakkan kaki di fasilitas kerja berisiko tinggi.
          </p>

          <div class="callout callout-tip">
            <div class="callout-title">💡 Insight Utama: Mengapa CSMS Bukan Sekadar Berkas Formalitas?</div>
            <p>
              Bagi kontraktor, sertifikasi atau status lolos CSMS bukanlah sekadar syarat administrasi untuk mengambil dokumen tender. CSMS adalah cerminan dari <em>Safety Culture</em> (budaya keselamatan) dan kapabilitas manajemen perusahaan Anda. Kegagalan dalam kualifikasi CSMS secara otomatis memutus akses bisnis perusahaan Anda ke proyek-proyek bernilai tinggi di lingkungan BUMN dan Multinasional.
            </p>
          </div>
        </section>

        <!-- BAB 2 -->
        <section id="bab-2">
          <h2>2. Landasan Hukum & Regulasi CSMS di Indonesia</h2>
          <p>
            Penerapan CSMS di Indonesia memiliki payung hukum yang sangat kuat, baik dari regulasi nasional ketenagakerjaan maupun petunjuk teknis spesifik sektor industri energi dan sumber daya mineral:
          </p>

          <ul>
            <li><strong>Undang-Undang No. 1 Tahun 1970 tentang Keselamatan Kerja:</strong> Mewajibkan setiap pengurus tempat kerja untuk menjamin keselamatan setiap orang yang berada di tempat kerja tersebut, termasuk tenaga kerja asing, tamu, dan kontraktor.</li>
            <li><strong>Peraturan Pemerintah (PP) No. 50 Tahun 2012 tentang Penerapan Sistem Manajemen K3 (SMK3):</strong> Elemen 11 PP 50/2012 secara eksplisit mengatur Pembelian dan Pengendalian Kontraktor, di mana perusahaan wajib menilai kapabilitas K3 penyedia barang dan jasa sebelum ikatan kerja dimulai.</li>
            <li><strong>Pedoman Tata Kerja SKK Migas No. PTK-005/SKKMA0000/2018/S0:</strong> Standar baku Pengelolaan Kesehatan, Keselamatan Kerja dan Perlindungan Lingkungan Kontraktor untuk seluruh Kontraktor Kontrak Kerja Sama (KKKS) hulu migas di Indonesia.</li>
            <li><strong>Tata Kerja Organisasi (TKO) PT Pertamina (Persero) & Holding/Subholding:</strong> Pedoman internal CSMS Pertamina yang mengatur 7 Elemen penilaian kualifikasi vendor di lingkungan Pertamina Group.</li>
            <li><strong>Standar Internasional IOGP Report 423 (HSE Management - Guidelines for Working Together):</strong> Acuan internasional dari <em>International Association of Oil & Gas Producers</em> yang menjadi fondasi penyusunan CSMS global.</li>
            <li><strong>ISO 45001:2018 Klausul 8.1.4.2 (Procurement - Contractors):</strong> Meminta organisasi untuk mengkoordinasikan proses pengadaannya dengan kontraktor untuk mengidentifikasi bahaya dan menilai serta mengendalikan risiko K3.</li>
          </ul>
        </section>

        <!-- BAB 3 -->
        <section id="bab-3">
          <h2>3. Matriks Perbandingan: CSMS vs SMK3 (PP 50/2012) vs ISO 45001:2018</h2>
          <p>
            Banyak praktisi K3 maupun manajemen perusahaan vendor yang masih bingung membedakan antara CSMS, Sertifikasi SMK3 Kemnaker (PP 50/2012), dan ISO 45001:2018. Meskipun ketiganya berada dalam payung Sistem Manajemen K3, fokus dan mekanisme penerapannya berbeda secara mendasar:
          </p>

          <div class="table-responsive">
            <table class="data-table">
              <thead>
                <tr>
                  <th>Parameter</th>
                  <th>CSMS (Contractor Safety Management)</th>
                  <th>SMK3 (PP No. 50 Tahun 2012)</th>
                  <th>ISO 45001:2018</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><strong>Tujuan Utama</strong></td>
                  <td>Mengelola & menilai risiko K3 pihak ketiga (kontraktor/vendor) oleh pemilik proyek.</td>
                  <td>Penerapan sistem K3 internal perusahaan sesuai regulasi wajib Pemerintah RI.</td>
                  <td>Standar internasional voluntary untuk kerangka kerja sistem manajemen K3 global.</td>
                </tr>
                <tr>
                  <td><strong>Pihak Penilai / Auditor</strong></td>
                  <td>Tim HSE Principal (Pertamina, SKK Migas, PLN, Chevron, dll).</td>
                  <td>Lembaga Audit Independen yang ditunjuk Kemnaker RI (Sucofindo, Surveyor Indonesia, dll).</td>
                  <td>Lembaga Sertifikasi Internasional terakreditasi KAN/IAF (BSI, SGS, TUV, Lloyd's, dll).</td>
                </tr>
                <tr>
                  <td><strong>Fokus Pengujian</strong></td>
                  <td>Kesesuaian sistem K3 kontraktor dengan bahaya spesifik proyek yang akan ditenderkan.</td>
                  <td>Pemenuhan 64, 122, atau 166 kriteria audit sistem K3 nasional.</td>
                  <td>Klausa ISO (Plan-Do-Check-Act) & kepemimpinan manajemen puncak.</td>
                </tr>
                <tr>
                  <td><strong>Masa Berlaku</strong></td>
                  <td>2 – 3 Tahun (atau per durasi kontrak proyek).</td>
                  <td>3 Tahun (Sertifikat & Bendera Emas/Perak).</td>
                  <td>3 Tahun (dengan audit surveillance tahunan).</td>
                </tr>
                <tr>
                  <td><strong>Output Hasil</strong></td>
                  <td>High Risk / Medium Risk / Low Risk Approval Rating & Score %.</td>
                  <td>Sertifikat SMK3 Kemnaker RI & Tingkat Pencapaian %.</td>
                  <td>Sertifikat ISO 45001:2018 Terakreditasi.</td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="callout">
            <div class="callout-title">📌 Kesimpulan Integrasi Sistem</div>
            <p>
              Sertifikat ISO 45001 atau SMK3 Kemnaker tidak otomatis menggantikan kewajiban CSMS. Namun, perusahaan yang sudah menerapkan ISO 45001 / SMK3 PP 50/2012 akan jauh lebih mudah melengkapi dokumen CSMS karena 70% prosedur, kebijakan, dan bukti audit (records) sudah tersedia.
            </p>
          </div>
        </section>

        <!-- BAB 4 -->
        <section id="bab-4">
          <h2>4. Siklus Hidup CSMS: 6 Tahapan Utama dari Penilaian Risiko hingga Evaluasi Akhir</h2>
          <p>
            Penerapan CSMS tidak berhenti saat dokumen prakualifikasi Anda disetujui. CSMS adalah proses siklus hidup (<em>lifecycle process</em>) berkesinambungan yang terdiri dari 6 tahapan utama:
          </p>

          <div class="stepper">
            <div class="step-item">
              <div class="step-number">1</div>
              <div class="step-content">
                <div class="step-title">Tahap 1: Risk Assessment & Categorization (Penilaian Risiko Pekerjaan)</div>
                <p class="step-desc">
                  Dilakukan oleh Pemilik Proyek (Principal) sebelum tender dibuka. Principal menentukan tingkat risiko proyek (High, Medium, atau Low Risk) berdasarkan potensi bahaya tempat kerja, tingkat kompleksitas teknis, lokasi, dan durasi pekerjaan.
                </p>
              </div>
            </div>

            <div class="step-item">
              <div class="step-number">2</div>
              <div class="step-content">
                <div class="step-title">Tahap 2: Pre-Qualification / PQ (Prakualifikasi Vendor)</div>
                <p class="step-desc">
                  Kontraktor menyerahkan berkas kuisener CSMS beserta seluruh bukti administratif (sertifikat, SOP, statistik K3, IBPR) untuk diverifikasi oleh Tim CSMS Principal. Hasil penilaian menghasilkan Sertifikat Prakualifikasi CSMS sesuai kategori risiko.
                </p>
              </div>
            </div>

            <div class="step-item">
              <div class="step-number">3</div>
              <div class="step-content">
                <div class="step-title">Tahap 3: Selection & Tender Stage (Seleksi Dokumen & HSE Plan Proyek)</div>
                <p class="step-desc">
                  Hanya kontraktor yang lulus Prakualifikasi dengan kategori risiko yang sesuai yang diundang dalam tender. Pada tahap ini, kontraktor wajib menyusun dokumen <strong>HSE Plan Spesifik Proyek</strong> yang dinilai bersamaan dengan proposal teknis.
                </p>
              </div>
            </div>

            <div class="step-item">
              <div class="step-number">4</div>
              <div class="step-content">
                <div class="step-title">Tahap 4: Pre-Job Activity (Persiapan Sebelum Kerja)</div>
                <p class="step-desc">
                  Setelan pemenang tender ditetapkan. Dilakukan Kick-off Meeting K3, Alignment Meeting, Site Induction, verifikasi fisik peralatan (inspeksi kelayakan), pemeriksaan kesehatan pekerja (MCU), dan penerbitan Surat Izin Kerja Aman (SIKA/PTW).
                </p>
              </div>
            </div>

            <div class="step-item">
              <div class="step-number">5</div>
              <div class="step-content">
                <div class="step-title">Tahap 5: Work in Progress / WIP Monitoring (Pengawasan Lapangan)</div>
                <p class="step-desc">
                  Pengawasan eksekusi kerja di lapangan. Meliputi inspeksi K3 harian, audit lapangan berkala (interim audit), pemantauan kepatuhan APD, pelaksanaan TBM/Safety Talk, serta pelaporan statistik K3 bulanan oleh kontraktor.
                </p>
              </div>
            </div>

            <div class="step-item">
              <div class="step-number">6</div>
              <div class="step-content">
                <div class="step-title">Tahap 6: Final Evaluation & Performance Rating (Evaluasi Akhir Kinerja)</div>
                <p class="step-desc">
                  Di akhir masa kontrak, Principal melakukan close-out audit untuk menilai total kinerja K3 kontraktor. Nilai evaluasi akhir ini menentukan apakah kontraktor mendapat rating Baik (Green/Gold Vendor) atau di-blacklist dari tender berikutnya.
                </p>
              </div>
            </div>
          </div>
        </section>

        <!-- BAB 5 -->
        <section id="bab-5">
          <h2>5. 7 Elemen Utama Penilaian CSMS & Bobot Penilaian (Scoring System)</h2>
          <p>
            Format kuesioner CSMS standar Pertamina dan SKK Migas (PTK-005) terbagi menjadi <strong>7 Elemen Utama</strong> yang menguji secara mendalam aspek perencanaan, eksekusi, hingga evaluasi K3 kontraktor:
          </p>

          <div class="table-responsive">
            <table class="data-table">
              <thead>
                <tr>
                  <th>Elemen CSMS</th>
                  <th>Bobot Sektor Migas</th>
                  <th>Sub-Elemen Kunci yang Diperiksa</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><strong>1. Kepemimpinan & Komitmen Manajemen</strong></td>
                  <td>15%</td>
                  <td>Management Walk Through (MWT), keterlibatan Direksi dalam Safety Meeting, alokasi anggaran K3, dan akuntabilitas pimpinan.</td>
                </tr>
                <tr>
                  <td><strong>2. Kebijakan & Sasaran Strategis K3LL</strong></td>
                  <td>10%</td>
                  <td>Kebijakan K3 tertulis yang ditandatangani Direktur Utama, Kebijakan Stop Work Authority, Kebijakan Bebas Narkoba & Alkohol, sosialisasi kebijakan.</td>
                </tr>
                <tr>
                  <td><strong>3. Organisasi, Kualifikasi, Sertifikasi & Dokumentasi</strong></td>
                  <td>20%</td>
                  <td>Struktur organisasi K3, sertifikat Ahli K3 Umum Kemnaker, sertifikasi personil (Rigger, Welder, Scaffolder), prosedur pengendalian dokumen & rekaman.</td>
                </tr>
                <tr>
                  <td><strong>4. Manajemen Risiko (HIRADC / IBPR) & Prosedur</strong></td>
                  <td>20%</td>
                  <td>Matriks Risiko 5x5, dokumen IBPR/HIRADC spesifik aktivitas, SOP Pekerjaan Kritis (Lifting, Confined Space, Working at Height, Hot Work).</td>
                </tr>
                <tr>
                  <td><strong>5. Perencanaan & Implementasi Operasional</strong></td>
                  <td>15%</td>
                  <td>Sistem Izin Kerja Aman (PTW/SIKA), Sistem LOTO, Manajemen Perubahan (MOC), Pemeliharaan Alat & SILO, Distribusi & Matrix APD.</td>
                </tr>
                <tr>
                  <td><strong>6. Tanggap Darurat & Investigasi Insiden</strong></td>
                  <td>10%</td>
                  <td>Prosedur ERP, Tim Tanggap Darurat, Jadwal Drill/Simulasi Evakuasi, Prosedur Investigasi Insiden 5-Why/Fishbone, Reporting Near Miss.</td>
                </tr>
                <tr>
                  <td><strong>7. Audit Internal, Tinjauan Manajemen & Peningkatan</strong></td>
                  <td>10%</td>
                  <td>Program Audit K3 Internal, Notulen Tinjauan Manajemen (Management Review), Pelacakan Tindakan Perbaikan (CAPA), Log Statistik K3 (LTIR/TRIR).</td>
                </tr>
              </tbody>
            </table>
          </div>

          <h3>Ambangan Batas Kelulusan (Cut-off Score Thresholds)</h3>
          <p>
            Skor akumulasi dari 7 elemen di atas akan menentukan tingkat kualifikasi kontraktor:
          </p>
          <ul>
            <li><strong>Sertifikat Kategori Risiko Tinggi (High Risk):</strong> Skor Total &ge; 75% – 80% (Dapat mengikuti seluruh kategori tender High, Medium, dan Low Risk).</li>
            <li><strong>Sertifikat Kategori Risiko Sedang (Medium Risk):</strong> Skor Total 60% – 74% (Hanya dapat mengikuti tender kategori Medium dan Low Risk).</li>
            <li><strong>Sertifikat Kategori Risiko Rendah (Low Risk):</strong> Skor Total 50% – 59% (Hanya diperbolehkan untuk tender pekerjaan risiko rendah).</li>
            <li><strong>Gagal / Tidak Lolos:</strong> Skor Total &lt; 50% (Gagal kualifikasi dan masuk masa pembinaan).</li>
          </ul>
        </section>

        <!-- BAB 6 -->
        <section id="bab-6">
          <h2>6. Kategorisasi Risiko Pekerjaan dalam CSMS (Risk Matrix)</h2>
          <p>
            Penetapan kategori risiko proyek oleh Principal berdampak langsung pada tingkat ketatnya persyaratan dokumen dan pengawasan yang diberlakukan. Berikut adalah klasifikasi matriks risiko pekerjaan:
          </p>

          <div class="card-grid">
            <div class="info-card" style="border-top:4px solid #dc2626">
              <div class="info-card-icon">🔥</div>
              <div class="info-card-title">Risiko Tinggi (High Risk)</div>
              <p class="info-card-desc">
                Pekerjaan di area berbahaya tinggi dengan potensi Fatality atau kerusakan aset besar. Contoh: Pengeboran migas (drilling), pekerjaan panas di tanki hydrocarbon, pengangkatan berat (heavy lifting &gt;10 ton), pekerjaan di ruang terbatas (confined space), konstruksi di ketinggian &gt;5 meter, pekerjaan tegangan tinggi.
              </p>
            </div>

            <div class="info-card" style="border-top:4px solid #f59e0b">
              <div class="info-card-icon">⚙️</div>
              <div class="info-card-title">Risiko Sedang (Medium Risk)</div>
              <p class="info-card-desc">
                Pekerjaan dengan potensi cedera berat namun terkendali. Contoh: Perbaikan mekanikal & elektrikal umum, pekerjaan sipil gedung, fabrikasi pipa non-pressurized, transportasi logistik darat, pekerjaan pemeliharaan berkala di luar area proses utama.
              </p>
            </div>

            <div class="info-card" style="border-top:4px solid #10b981">
              <div class="info-card-icon">📋</div>
              <div class="info-card-title">Risiko Rendah (Low Risk)</div>
              <p class="info-card-desc">
                Pekerjaan pendukung tanpa paparan bahaya industri langsung. Contoh: Jasa katering kantor, konsultan manajemen, penyediaan IT & perangkat lunak, pekerjaan kebersihan kantor (janitorial), pengadaan alat tulis kantor (ATK).
              </p>
            </div>
          </div>
        </section>

        <!-- MID-ARTICLE CTA -->
        <div class="mid-article-cta">
          <h3>Butuh Bantuan Menyiapkan Berkas Prakualifikasi CSMS?</h3>
          <p>Tim ahli K3 Wahana Totalita siap membantu merapikan dokumen, menyusun IBPR, HSE Plan, hingga melatih personil K3 perusahaan Anda agar siap 100% menghadapi audit Pertamina & SKK Migas.</p>
          <a href="<?=$wa_consult?>" target="_blank" rel="noopener" class="btn-primary">💬 Konsultasi Bebas Biaya via WhatsApp</a>
        </div>

        <!-- BAB 7 -->
        <section id="bab-7">
          <h2>7. Penyusunan Berkas Prakualifikasi CSMS Wajib (Document Checklist)</h2>
          <p>
            Agar pengajuan dokumen prakualifikasi CSMS Anda disetujui tanpa revisi berulang, pastikan seluruh bukti fisik (records) berikut ini telah disiapkan dalam format PDF yang rapi:
          </p>

          <div class="callout callout-warning">
            <div class="callout-title">⚠️ Aturan Emas Penyusunan Berkas CSMS</div>
            <p>
              Auditor CSMS tidak hanya menilai adanya Prosedur / SOP (<em>Say What You Do</em>), tetapi fokus utama pada <strong>Bukti Pelaksanaan / Records</strong> selama 12-36 bulan terakhir (<em>Do What You Say</em>). Prosedur sebagus apa pun tanpa lampiran bukti pelaksanaan akan diberi skor 0 (Nol).
            </p>
          </div>

          <h4>Daftar Periksa Berkas Wajib CSMS:</h4>
          <ol>
            <li><strong>Kebijakan K3LL Perusahaan:</strong> Ditandatangani Direktur Utama, stempel basah, mencantumkan tanggal revisi, dan bukti foto sosialisasi kepada pekerja.</li>
            <li><strong>Manual & SOP K3:</strong> Prosedur Kerja Aman untuk seluruh operasional kunci (LOTO, Working at Height, Lifting, Confined Space, Hot Work, Waste Management).</li>
            <li><strong>Struktur Organisasi K3:</strong> Chart organisasi K3 yang disahkan Direksi, dilengkapi Surat Penunjukan (SK) P2K3 atau Petanggung Jawab K3.</li>
            <li><strong>Sertifikat Ahli K3 Umum (Kemnaker RI):</strong> Copy Sertifikat, SKP (Surat Keputusan Penunjukan), dan Kartu Lisensi K3 Ahli K3 Utama/Umum yang masih aktif.</li>
            <li><strong>Sertifikasi Kompetensi Personil Teknis:</strong> Lisensi Rigger (Juru Ikat), Scaffolder (Teknisi Perancah), Welder (Juru Las), Operator Crane (SILO & SIO), Petugas P3K, dan Petugas APAR.</li>
            <li><strong>Matriks IBPR / HIRADC:</strong> Form Identifikasi Bahaya, Penilaian Risiko, dan Pengendalian Risiko yang mencakup seluruh lingkup pekerjaan perusahaan.</li>
            <li><strong>Data Statistik K3 (3 Tahun Terakhir):</strong> Tabel rekapitulasi Jam Kerja Selamat (Safe Manhours), Lost Time Injury Rate (LTIR), Total Recordable Incident Rate (TRIR), Severity Rate, dan statistik Near Miss disahkan oleh Manajemen.</li>
            <li><strong>Bukti Inspeksi & Kalibrasi Alat:</strong> Surat Ijin Laik Operasi (SILO) dari Disnaker/Migas untuk alat berat, crane, kompresor, bejana tekan, serta sertifikat kalibrasi alat ukur.</li>
            <li><strong>Bukti Audit Internal & Management Review:</strong> Laporan Audit K3 Internal terakhir dan Notulen Rapat Tinjauan Manajemen (Management Review Meeting).</li>
            <li><strong>Prosedur & Laporan Drill Evakuasi:</strong> Dokumentasi foto, daftar hadir, dan evaluasi hasil simulasi tanggap darurat (fire drill/evacuation drill).</li>
          </ol>
        </section>

        <!-- BAB 8 -->
        <section id="bab-8">
          <h2>8. Penyusunan HSE Plan Tender yang Unggul (Project-Specific HSE Plan)</h2>
          <p>
            Setelah lulus Prakualifikasi dan mendapatkan Sertifikat CSMS, langkah berikutnya saat mengikuti tender adalah menyusun <strong>Project HSE Plan</strong>. Berbeda dengan dokumen Prakualifikasi yang bersifat umum tingkat perusahaan, HSE Plan bersifat <em>site-specific</em> dan <em>project-specific</em>.
          </p>

          <h3>Komponen Utama Anatomi HSE Plan Tender:</h3>
          <ul>
            <li><strong>Ringkasan Proyek & Lingkup Kerja:</strong> Penjelasan mendalam mengenai metode kerja teknis yang akan digunakan di lokasi proyek.</li>
            <li><strong>Target & Sasaran K3 Proyek (KPI K3):</strong> Penetapan target kuantitatif (contoh: 0 Fatality, 0 LTIR, 100% Kepatuhan APD, 50 BBS Observation/bulan).</li>
            <li><strong>Organisasi HSE Proyek:</strong> Struktur rantai komando K3 di lokasi proyek, daftar HSE Officer yang ditugaskan beserta sertifikatnya.</li>
            <li><strong>Spesifik Risk Assessment (JSA & IBPR Proyek):</strong> Analisis keselamatan kerja tahap demi tahap (Job Safety Analysis) untuk setiap tahapan pekerjaan tender.</li>
            <li><strong>Rencana Pengendalian Lingkungan:</strong> Pengelolaan limbah B3, pengendalian tumpahan oli/kimia (spill kit), dan pengolahan sampah domestik site.</li>
            <li><strong>Prosedur Emergency Response Site Spesifik:</strong> Peta jalur evakuasi proyek, lokasi titik kumpul (muster point), nomor kontak darurat lokal (RS terdekat, Damkar, Polsek).</li>
            <li><strong>Jadwal Pelatihan & Safety Program Site:</strong> Matriks jadwal Induksi K3, Toolbox Meeting harian, Inspeksi Mingguan, dan Safety Campaign.</li>
          </ul>
        </section>

        <!-- BAB 9 -->
        <section id="bab-9">
          <h2>9. Pelaksanaan & Pengawasan Lapangan (Work In Progress / WIP)</h2>
          <p>
            Tahap eksekusi adalah pembuktian atas seluruh komitmen K3 yang tertera di dokumen tender. Selama fase konstruksi atau operasional berjalan, pengawasan CSMS di lapangan berfokus pada instrumen berikut:
          </p>

          <div class="card-grid">
            <div class="info-card">
              <div class="info-card-icon">🪪</div>
              <div class="info-card-title">Permit to Work (PTW / SIKA)</div>
              <p class="info-card-desc">
                Setiap pekerjaan berisiko tinggi wajib memiliki Sistem Izin Kerja Aman yang disetujui oleh Area Owner dan Safety Inspector sebelum pekerjaan dimulai setiap harinya.
              </p>
            </div>

            <div class="info-card">
              <div class="info-card-icon">🗣️</div>
              <div class="info-card-title">Toolbox Meeting (TBM) & PJSM</div>
              <p class="info-card-desc">
                Briefing keselamatan 5-10 menit sebelum shift kerja dimulai untuk mendiskusikan bahaya harian, kondisi cuaca, dan kesiapan APD personil.
              </p>
            </div>

            <div class="info-card">
              <div class="info-card-icon">🔎</div>
              <div class="info-card-title">Safety Patrol & Interim Audit</div>
              <p class="info-card-desc">
                Inspeksi lapangan rutin oleh tim HSE Principal untuk memastikan kepatuhan prosedur. Pelanggaran akan menghasilkan Surat Temuan (NCR / Stop Work Authority).
              </p>
            </div>

            <div class="info-card">
              <div class="info-card-icon">📊</div>
              <div class="info-card-title">Pelaporan Kinerja HSE Bulanan</div>
              <p class="info-card-desc">
                Kontraktor wajib menyampaikan laporan bulanan yang mencakup rekapitulasi jam kerja, jumlah TBM, audit APD, inspeksi alat, dan statistik insiden.
              </p>
            </div>
          </div>
        </section>

        <!-- BAB 10 -->
        <section id="bab-10">
          <h2>10. Evaluasi Akhir & Rating Kontraktor (Close-Out Performance Review)</h2>
          <p>
            Di akhir masa proyek, Tim CSMS Principal akan menerbitkan laporan **Evaluasi Akhir Kontraktor (Contractor Close-Out HSE Review)**. Skor akhir dihitung berdasarkan akumulasi kinerja keselamatan selama proyek berlangsung:
          </p>

          <div class="table-responsive">
            <table class="data-table">
              <thead>
                <tr>
                  <th>Kategori Kinerja Akhir</th>
                  <th>Skor Evaluasi</th>
                  <th>Dampak Bagi Masa Depan Vendor</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><strong>Sangat Baik (Gold / Excellent)</strong></td>
                  <td>&ge; 90%</td>
                  <td>Mendapatkan Surat Keterangan Kinerja Baik, rekomendasi perpanjangan kontrak, dan prioritas di tender berikutnya.</td>
                </tr>
                <tr>
                  <td><strong>Baik (Green / Satisfactory)</strong></td>
                  <td>75% – 89%</td>
                  <td>Memenuhi standar K3, dapat mengikuti tender selanjutnya sesuai kelas risikonya.</td>
                </tr>
                <tr>
                  <td><strong>Cukup (Yellow / Marginal)</strong></td>
                  <td>60% – 74%</td>
                  <td>Diberikan Surat Peringatan K3, wajib menyerahkan Action Plan perbaikan sebelum diizinkan ikut tender baru.</td>
                </tr>
                <tr>
                  <td><strong>Buruk / Fatality (Red / Blacklisted)</strong></td>
                  <td>&lt; 60% / Ada Fatality</td>
                  <td>Sertifikat CSMS dicabut, pemutusan kontrak kerja, dan pembekuan status vendor (Blacklist) selama 1-3 tahun.</td>
                </tr>
              </tbody>
            </table>
          </div>
        </section>

        <!-- BAB 11 -->
        <section id="bab-11">
          <h2>11. 10 Kesalahan Fatal Penyebab Gagal Pre-Kualifikasi CSMS & Cara Mengatasinya</h2>
          <p>
            Berdasarkan pengalaman pendampingan audit CSMS oleh Wahana Totalita, berikut adalah 10 jebakan utama yang paling sering menyebabkan berkas kontraktor ditolak atau mendapat nilai di bawah standar:
          </p>

          <ol>
            <li><strong>Sertifikat Ahli K3 atau Lisensi Personil Kadaluarsa:</strong> Mengunggah sertifikat Ahli K3 Umum atau SIO operator yang telah habis masa berlakunya. <em>Solusi: Buat matriks masa berlaku sertifikat dan lakukan perpanjangan (recertification) 3 bulan sebelum ekspirasi.</em></li>
            <li><strong>Data Jam Kerja & Statistik K3 Manipulatif / Tidak Konsisten:</strong> Jumlah jam kerja di statistik K3 tidak sinkron dengan jumlah karyawan di laporan HRD. <em>Solusi: Gunakan formula kalkulasi jam kerja standar (Jumlah Karyawan x Jam Kerja Efektif x Hari Kerja).</em></li>
            <li><strong>Dokumen IBPR / HIRADC bersifat Generic:</strong> Menyalin tabel IBPR dari internet yang tidak menggambarkan bahaya spesifik dari alat dan lokasi kerja yang digunakan. <em>Solusi: Menyusun IBPR berbasis analisis proses kerja aktual.</em></li>
            <li><strong>Prosedur / SOP Tanpa Tanda Tangan & Kontrol Revisi:</strong> SOP tidak memiliki lembar pengesahan Direksi, penomoran dokumen, atau tanggal berlaku.</li>
            <li><strong>Bukti Audit Internal Fiktif:</strong> Mengisi kuesioner mengaku rutin audit internal tetapi tidak dapat melampirkan daftar hadir auditor, foto audit, dan lembar temuan (checklist audit).</li>
            <li><strong>Struktur Organisasi K3 Tidak Sesuai Rantai Komando:</strong> Posisi HSE Manager diletakkan di bawah Supervisor Lapangan, yang mengurangi independensi wewenang Stop Work.</li>
            <li><strong>Matriks APD (PPE Grid) Tidak Sesuai Hazard:</strong> Menyediakan sarung tangan kain standar untuk pekerjaan penanganan bahan kimia korosif.</li>
            <li><strong>Peralatan Alat Berat Tanpa SILO / SIO:</strong> Menggunakan Crane atau Forklift yang tidak memiliki Surat Ijin Laik Operasi aktif dari instansi Ketenagakerjaan.</li>
            <li><strong>Prosedur ERP Tanpa Jadwal & Laporan Drill:</strong> Punya prosedur ERP tebal tapi tidak pernah melaksanakan simulasi kebakaran/evakuasi minimal 1 tahun sekali.</li>
            <li><strong>Tidak Ada Bukti Rapat Tinjauan Manajemen (Management Review):</strong> Tidak memiliki notulen rapat berkala Direksi yang membahas evaluasi kinerja K3 perusahaan.</li>
          </ol>
        </section>

        <!-- BAB 12 -->
        <section id="bab-12">
          <h2>12. Roadmap 30 Hari Persiapan Sertifikasi CSMS dari Nol</h2>
          <p>
            Jika perusahaan Anda belum memiliki sistem CSMS dan ingin mengejar target tender dalam waktu dekat, ikuti roadmap aksi 30 hari terstruktur berikut:
          </p>

          <div class="stepper">
            <div class="step-item">
              <div class="step-number">W1</div>
              <div class="step-content">
                <div class="step-title">Minggu 1: Gap Analysis & Inventarisasi Dokumen</div>
                <p class="step-desc">
                  Lakukan pemetaan seluruh dokumen K3 yang sudah dimiliki perusahaan. Bandingkan dengan 7 Elemen Kuesioner CSMS Pertamina/SKK Migas untuk mengidentifikasi dokumen yang belum ada (gap).
                </p>
              </div>
            </div>

            <div class="step-item">
              <div class="step-number">W2</div>
              <div class="step-content">
                <div class="step-title">Minggu 2: Penyusunan Kebijakan, Manual, & SOP K3</div>
                <p class="step-desc">
                  Susun Kebijakan K3LL, Kebijakan Stop Work, Manual K3, serta 15+ SOP Pekerjaan Kritis. Pastikan seluruh dokumen disahkan oleh Direktur Utama.
                </p>
              </div>
            </div>

            <div class="step-item">
              <div class="step-number">W3</div>
              <div class="step-content">
                <div class="step-title">Minggu 3: Pemenuhan Sertifikasi & Bukti Implementasi (Records)</div>
                <p class="step-desc">
                  Daftarkan personil kunci pada pelatihan Ahli K3 Umum Kemnaker RI / BNSP. Lakukan inspeksi alat, buat laporan simulasi ERP, dan gelar rapat Management Review.
                </p>
              </div>
            </div>

            <div class="step-item">
              <div class="step-number">W4</div>
              <div class="step-content">
                <div class="step-title">Minggu 4: Final Compilation, Internal Simulation Audit, & Submission</div>
                <p class="step-desc">
                  Kompilasi seluruh file PDF sesuai penomoran kuesioner CSMS. Jalankan simulasi audit internal bersama konsultan K3, lakukan perbaikan akhir, dan unggah ke portal CSMS Principal.
                </p>
              </div>
            </div>
          </div>
        </section>

        <!-- BAB 13: FAQ ACCORDION -->
        <section id="bab-13">
          <h2>13. Tanya Jawab Terlengkap Seputar CSMS (FAQ)</h2>
          <p>
            Berikut adalah jawaban mendalam dari tim konsultan senior Wahana Totalita atas pertanyaan teknis yang paling sering diajukan terkait pengurusan CSMS:
          </p>

          <div class="faq-accordion">
            <details open>
              <summary>Apa itu CSMS (Contractor Safety Management System)?</summary>
              <div class="faq-answer">
                CSMS adalah sistem manajemen komprehensif yang digunakan oleh pemilik proyek (Principal) seperti Pertamina, SKK Migas, PLN, dan BUMN untuk mengelola, mengevaluasi, dan mengawasi kinerja K3 kontraktor mulai dari tahap prakualifikasi hingga evaluasi akhir proyek.
              </div>
            </details>

            <details>
              <summary>Apakah CSMS Pertamina dan SKK Migas Wajib Bagi Semua Kontraktor?</summary>
              <div class="faq-answer">
                Ya, CSMS hukumnya wajib bagi seluruh vendor, supplier jasa, dan kontraktor yang ingin berpartisipasi dalam tender di lingkungan PT Pertamina (Persero), KKKS di bawah SKK Migas, PLN, serta BUMN dan perusahaan energi swasta di Indonesia.
              </div>
            </details>

            <details>
              <summary>Apa perbedaan utama antara CSMS, SMK3 PP 50/2012, dan ISO 45001:2018?</summary>
              <div class="faq-answer">
                SMK3 PP 50/2012 dan ISO 45001 adalah sistem manajemen K3 internal perusahaan untuk mengelola risiko pekerja sendiri. Sedangkan CSMS adalah sistem yang diterapkan oleh Principal untuk menyaring dan mengendalikan keselamatan pihak ketiga (kontraktor) yang bekerja di fasilitas mereka.
              </div>
            </details>

            <details>
              <summary>Berapa batas minimal skor (cut-off score) untuk lolos CSMS Pertamina?</summary>
              <div class="faq-answer">
                Batas minimal skor tergantung kategori risiko tender: Risiko Tinggi (High Risk) membutuhkan skor minimal 75%-80%, Risiko Sedang (Medium Risk) 60%-70%, dan Risiko Rendah (Low Risk) minimal 50%.
              </div>
            </details>

            <details>
              <summary>Berapa lama masa berlaku sertifikat Pre-Kualifikasi CSMS?</summary>
              <div class="faq-answer">
                Masa berlaku sertifikat prakualifikasi CSMS umumnya 2 hingga 3 tahun tergantung kebijakan Principal. Namun, status kualifikasi dapat ditinjau ulang atau dicabut sewaktu-waktu jika terjadi kecelakaan kerja berat atau fatality selama proyek berlangsung.
              </div>
            </details>

            <details>
              <summary>Apakah Sertifikat ISO 45001 Otomatis Meloloskan Prakualifikasi CSMS?</summary>
              <div class="faq-answer">
                Tidak otomatis. Meskipun sertifikat ISO 45001 memberi bobot nilai tambah pada Elemen Kebijakan dan Organisasi, kontraktor tetap wajib mengisi kuesioner spesifik CSMS dan melampirkan bukti implementasi operasional (records) yang dipersyaratkan oleh Principal.
              </div>
            </details>

            <details>
              <summary>Apakah Perusahaan Kecil / CV Bisa Mendaftar CSMS Pertamina?</summary>
              <div class="faq-answer">
                Bisa. Pengajuan CSMS disesuaikan dengan tingkat risiko pekerjaan. Untuk pekerjaan risiko rendah atau sedang (seperti pengadaan barang, katering, jasa IT, perawatan taman), CV tetap dapat mengajukan kualifikasi CSMS sesuai porsinya.
              </div>
            </details>

            <details>
              <summary>Apa yang Terjadi Jika Kontraktor Gagal Lolos Pre-Kualifikasi CSMS?</summary>
              <div class="faq-answer">
                Kontraktor yang tidak mencapai skor minimal dinyatakan Gagal Pre-Kualifikasi dan tidak diperbolehkan mengikuti tender kategori tersebut selama masa pembinaan (biasanya 6-12 bulan) hingga dilakukan perbaikan sistem dan pengajuan re-assessment.
              </div>
            </details>
          </div>
        </section>

        <!-- BAB 14: SERVICES & CLOSING CTA -->
        <section id="bab-14">
          <h2>14. Layanan Pendampingan CSMS & Sertifikasi K3 Wahana Totalita</h2>
          <p>
            Menyiapkan sistem CSMS yang memenuhi standar tinggi Pertamina, SKK Migas, dan BUMN membutuhkan ketelitian teknis, pemahaman regulasi, serta bukti implementasi K3 yang valid. **Wahana Totalita Konsultan** hadir sebagai mitra terpercaya perusahaan Anda dalam pemenuhan kualifikasi K3 dan pengembangan sumber daya manusia.
          </p>

          <div class="card-grid">
            <div class="info-card">
              <div class="info-card-icon">📂</div>
              <div class="info-card-title">Pendampingan Dokumentasi CSMS</div>
              <p class="info-card-desc">
                Jasa penyusunan 7 Elemen Dokumen CSMS, pembuatan manual K3, penyusunan IBPR/HIRADC, SOP Pekerjaan Kritis, hingga pendampingan upload portal CSMS Principal.
              </p>
            </div>

            <div class="info-card">
              <div class="info-card-icon">🎓</div>
              <div class="info-card-title">Sertifikasi Ahli K3 Umum Kemnaker RI</div>
              <p class="info-card-desc">
                Program pelatihan dan pembinaan Ahli K3 Umum bersertifikat resmi Kemnaker RI untuk memenuhi syarat personil K3 wajib dalam kualifikasi CSMS.
              </p>
            </div>

            <div class="info-card">
              <div class="info-card-icon">⛽</div>
              <div class="info-card-title">Pelatihan K3 Migas & Konstruksi</div>
              <p class="info-card-desc">
                Sertifikasi personil spesifik industri: Pengawas K3 Migas, Ahli K3 Konstruksi, Auditor SMK3, Pengawas Operasional Pertambangan (POP BNSP).
              </p>
            </div>

            <div class="info-card">
              <div class="info-card-icon">📝</div>
              <div class="info-card-title">Penyusunan Project HSE Plan Tender</div>
              <p class="info-card-desc">
                Jasa pembuatan proposal HSE Plan spesifik proyek untuk keperluan kelengkapan berkas tender di lingkungan BUMN & Swasta.
              </p>
            </div>
          </div>

          <div class="mid-article-cta" style="margin-top:40px">
            <h3>Siap Tingkatkan Kualifikasi CSMS Perusahaan Anda?</h3>
            <p>Konsultasikan kebutuhan CSMS dan pelatihan K3 tim Anda bersama konsultan senior Wahana Totalita sekarang juga.</p>
            <a href="<?=$wa_consult?>" target="_blank" rel="noopener" class="btn-primary" style="font-size:17px;padding:16px 36px">💬 Konsultasi Pendampingan CSMS via WhatsApp</a>
          </div>
        </section>

      </article>
    </div>
  </div>
</div>

<section class="csms-resources" aria-labelledby="csms-resources-title">
  <div class="csms-resources-in">
    <span class="hero-eyebrow" style="color:#d95716;border-color:#f0c7b0;background:#fff">LANGKAH BERIKUTNYA</span>
    <h2 id="csms-resources-title">Perkuat dokumen dan kompetensi perusahaan</h2>
    <p>Gunakan panduan, alat bantu, jadwal pelatihan, dan program kompetensi yang relevan untuk menindaklanjuti hasil evaluasi CSMS.</p>
    <div class="csms-resource-grid">
      <a class="csms-resource-card" href="/tools/ibpr-generator"><small>Alat K3</small><b>IBPR Generator</b><span>Buat identifikasi risiko →</span></a>
      <a class="csms-resource-card" href="/tools/safety-talk"><small>Toolbox</small><b>Materi Safety Talk</b><span>Siapkan pengarahan →</span></a>
      <a class="csms-resource-card" href="/jadwal/"><small>Kompetensi</small><b>Jadwal Pelatihan K3</b><span>Lihat batch aktif →</span></a>
      <a class="csms-resource-card" href="/pelatihan/pelatihan-ahli-k3-umum-sertifikasi-kemnaker-ri/"><small>Kemnaker RI</small><b>Ahli K3 Umum</b><span>Lihat program →</span></a>
      <a class="csms-resource-card" href="/k3"><small>Panduan</small><b>Pusat Informasi K3</b><span>Pelajari dasar K3 →</span></a>
      <a class="csms-resource-card" href="/layanan-pemerintah"><small>Perusahaan</small><b>Layanan Pemerintah</b><span>Lihat layanan →</span></a>
      <a class="csms-resource-card" href="/artikel/"><small>Referensi</small><b>Artikel dan Regulasi</b><span>Baca artikel →</span></a>
      <a class="csms-resource-card" href="<?=$wa_consult?>"><small>Konsultasi</small><b>Pendampingan CSMS</b><span>Hubungi konsultan →</span></a>
    </div>
  </div>
</section>

<!-- FOOTER -->
<footer class="footer">
  <div class="container">
    <div class="footer-grid">
      <div class="footer-brand">
        <h4>Wahana Totalita Konsultan</h4>
        <p>
          Lembaga penyedia konsultasi manajemen K3, pendampingan CSMS, serta pelatihan dan pembinaan personil K3 bersertifikat Kemnaker RI & BNSP terpercaya di Indonesia.
        </p>
      </div>
      <div class="footer-links">
        <h5>Program Sertifikasi</h5>
        <ul>
          <li><a href="/pelatihan/pelatihan-ahli-k3-umum-sertifikasi-bnsp-online/">Ahli K3 Umum BNSP</a></li>
          <li><a href="/pelatihan/ahli-k3-konstruksi">K3 Konstruksi Kemnaker</a></li>
          <li><a href="/lp/k3-migas">K3 Migas Kemnaker</a></li>
          <li><a href="/k3">POP Pertambangan BNSP</a></li>
          <li><a href="/pelatihan/pelatihan-ahli-k3-listrik-sertifikasi-bnsp/">Auditor Internal SMK3</a></li>
        </ul>
      </div>
      <div class="footer-links">
        <h5>Informasi & Navigasi</h5>
        <ul>
          <li><a href="/csms">Panduan CSMS Indonesia</a></li>
          <li><a href="/jadwal-pelatihan">Jadwal Pelatihan Terdekat</a></li>
          <li><a href="/artikel/">Artikel & Insight K3</a></li>
          <li><a href="<?=$wa_consult?>" target="_blank" rel="noopener">Hubungi Kami (WhatsApp)</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <p>© <?=$year?> Wahana Totalita Konsultan. Hak Cipta Dilindungi Undang-Undang. | <a href="/csms" style="color:inherit">wahanatotalita.com/csms</a></p>
    </div>
  </div>
</footer>
</body>
</html>
