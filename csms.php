<?php
/**
 * csms.php — Contractor Safety Management System (CSMS) Authority & Lead Generation Page
 *
 * Integrated with shared site navbar, shared footer, rich internal links,
 * and high-converting lead capture mechanisms.
 *
 * Optimized for top search queries:
 *   - "penyusunan laporan kinerja chsems untuk manajemen puncak"
 *   - "siklus k3ll pertamina" / "susunan siklus k3ll pertamina"
 *   - "csms pertamina adalah" / "csms k3" / "tahapan csms"
 *   - "contoh csms pertamina lengkap" / "dokumen csms" / "sop csms" / "contoh csms lengkap pdf"
 *   - "sertifikat csms pertamina" / "high risk" / "bagaimana daftarnya" / "berapa lama prosesnya"
 */
require_once __DIR__ . '/config.php';
$s = get_all_settings();

$wa_number  = preg_replace('/\D/', '', get_setting('wa_number', '6287759151278'));
$phone_disp = '0' . substr($wa_number, 2);
$phone_disp = trim(chunk_split($phone_disp, 4, '-'), '-');
$year       = date('Y');

// Targeted WhatsApp Inquiry Messages for Maximum Lead Conversion
$wa_consult_msg  = 'Halo Wahana Totalita, kami ingin konsultasi pendampingan pembuatan & audit dokumen CSMS Pertamina / BUMN agar lolos kualifikasi High Risk.';
$wa_template_msg = 'Halo Wahana Totalita, saya ingin meminta contoh format dokumen CSMS Pertamina lengkap, checklist 7 elemen, dan panduan HSE Plan untuk persiapan tender.';
$wa_consult      = "https://wa.me/{$wa_number}?text=" . rawurlencode($wa_consult_msg);
$wa_template     = "https://wa.me/{$wa_number}?text=" . rawurlencode($wa_template_msg);

$page_title = 'Panduan Lengkap CSMS Indonesia: 7 Elemen, Siklus K3LL Pertamina, & Lolos High Risk | Wahana Totalita';
$meta_desc  = 'Panduan komprehensif CSMS (Contractor Safety Management System) Indonesia 2026: Siklus K3LL Pertamina, 7 elemen penilaian, penyusunan laporan kinerja CHSEMS manajemen puncak, dokumen prakualifikasi, & jasa pendampingan lolos High Risk.';
$canonical  = 'https://wahanatotalita.com/csms';

require __DIR__ . '/includes/head.php';
?>

<!-- Structured Data: BreadcrumbList, TechArticle, & FAQPage for Rich Snippets -->
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
      "headline": "Panduan Lengkap CSMS (Contractor Safety Management System) Indonesia: 7 Elemen, Siklus K3LL Pertamina, & Lolos High Risk",
      "description": "Panduan teknis mengenai implementasi Contractor Safety Management System (CSMS) di sektor migas, pertambangan, energi, dan BUMN: 7 elemen penilaian, siklus K3LL Pertamina, laporan kinerja CHSEMS manajemen puncak, & strategi lolos High Risk.",
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
      "dateModified": "2026-09-29",
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
          "name": "Bagaimana susunan siklus K3LL Pertamina dalam CSMS?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Siklus K3LL Pertamina terdiri dari 6 tahapan baku: 1. Penilaian Risiko (Risk Assessment), 2. Prakualifikasi (Pre-Qualification/PQ), 3. Seleksi & Penilaian HSE Plan Tender, 4. Pra-Pekerjaan (Pre-Job Activity & SIKA), 5. Pekerjaan Berlangsung (Work In Progress/WIP Monitoring), dan 6. Evaluasi Akhir Kinerja (Close-Out Performance Review)."
          }
        },
        {
          "@type": "Question",
          "name": "Bagaimana cara menyusun laporan kinerja CHSEMS untuk manajemen puncak?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Laporan kinerja CHSEMS (Contractor HSE Management System) untuk manajemen puncak disusun secara berkala (bulanan/triwulanan) merangkum: Leading Indicators (jumlah safety walk direksi, TBM, inspeksi K3, laporan near-miss, audit internal), Lagging Indicators (total jam kerja selamat, LTIFR, TRIR, keparahan insiden), status tindak lanjut temuan audit (CAPA), serta rekomendasi peningkatan untuk forum Rapat Tinjauan Manajemen (Management Review)."
          }
        },
        {
          "@type": "Question",
          "name": "Berapa batas minimal skor (cut-off score) untuk lolos CSMS Pertamina?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Batas minimal skor tergantung kategori risiko pekerjaan: Risiko Tinggi (High Risk) membutuhkan skor minimal 75%-80%, Risiko Sedang (Medium Risk) 60%-74%, dan Risiko Rendah (Low Risk) minimal 50%-59%."
          }
        },
        {
          "@type": "Question",
          "name": "Berapa lama masa berlaku sertifikat Pre-Kualifikasi CSMS Pertamina?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Masa berlaku sertifikat prakualifikasi CSMS Pertamina dan SKK Migas umumnya adalah 2 hingga 3 tahun, berlaku di seluruh unit operasi dan subholding sesuai kategori risiko yang disetujui, selama tidak terjadi kecelakaan kerja fatal (fatality)."
          }
        },
        {
          "@type": "Question",
          "name": "Berapa lama proses pembuatan dan verifikasi dokumen CSMS?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Dengan pendampingan konsultan Wahana Totalita, persiapan dan audit 7 elemen dokumen CSMS dapat diselesaikan dalam 7-14 hari kerja. Proses verifikasi dan asesmen oleh auditor Principal Pertamina memakan waktu rata-rata 14-30 hari kerja."
          }
        },
        {
          "@type": "Question",
          "name": "Apakah sertifikat ISO 45001 otomatis meloloskan prakualifikasi CSMS?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Tidak otomatis. Meskipun ISO 45001 memberi poin tinggi pada elemen kebijakan dan organisasi, kontraktor tetap wajib mengisi kuesioner spesifik CSMS Principal dan melampirkan bukti fisik implementasi (records, SOP spesifik bahaya proyek, matriks IBPR, statistik jam kerja)."
          }
        }
      ]
    }
  ]
}
</script>

<link rel="stylesheet" href="<?= asset_v('/assets/css/page/csms.css') ?>">
<link rel="stylesheet" href="<?= asset_v('/assets/css/page/csms-modern.css') ?>">

<style id="csms-lead-gen-css">
/* ═════════════════════════════════════════════════════════════
   CSMS CONVERSION RATE OPTIMIZATION (CRO) & LEAD MAGNET STYLES
   ═════════════════════════════════════════════════════════════ */
.csms-hero-leadbox {
  background: rgba(15, 23, 42, 0.7);
  border: 1.5px solid rgba(52, 211, 153, 0.4);
  border-radius: 16px;
  padding: 24px;
  margin-top: 28px;
  backdrop-filter: blur(12px);
  display: flex;
  flex-direction: column;
  gap: 14px;
  box-shadow: 0 16px 36px -12px rgba(0, 0, 0, 0.5);
}
.csms-leadbox-title {
  font-family: 'Lexend', sans-serif;
  font-size: 17px;
  font-weight: 800;
  color: #34d399;
  display: flex;
  align-items: center;
  gap: 8px;
}
.csms-leadbox-desc {
  font-size: 14.5px;
  color: #cbd5e1;
  line-height: 1.6;
  margin: 0;
}
.csms-leadbox-list {
  list-style: none;
  padding: 0;
  margin: 0;
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 8px;
  font-size: 13.5px;
  color: #e2e8f0;
}
.csms-leadbox-list li {
  display: flex;
  align-items: center;
  gap: 6px;
}
.csms-leadbox-list li span.chk {
  color: #10b981;
  font-weight: 800;
}

/* Downloadable Lead Magnet Card (Bab 7 & Mid-Article) */
.csms-lead-magnet {
  background: linear-gradient(135deg, #071f33 0%, #0a4a2e 100%);
  border: 2px solid #34d399;
  border-radius: 18px;
  padding: 34px 28px;
  color: #ffffff;
  margin: 36px 0;
  box-shadow: 0 16px 36px -12px rgba(10, 74, 46, 0.4);
  position: relative;
  overflow: hidden;
}
.csms-lead-magnet::before {
  content: '';
  position: absolute;
  top: -40px;
  right: -40px;
  width: 140px;
  height: 140px;
  background: rgba(52, 211, 153, 0.15);
  border-radius: 50%;
  pointer-events: none;
}
.csms-lead-magnet h3 {
  font-family: 'Lexend', sans-serif;
  font-size: clamp(20px, 3vw, 24px);
  font-weight: 800;
  color: #34d399;
  margin-bottom: 12px;
  line-height: 1.3;
}
.csms-lead-magnet p {
  color: #e2e8f0;
  font-size: 15px;
  line-height: 1.65;
  margin-bottom: 20px;
  max-width: 720px;
}
.csms-magnet-checklist {
  list-style: none;
  padding: 0;
  margin: 0 0 24px;
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: 10px;
  font-size: 14px;
  color: #cbd5e1;
}
.csms-magnet-checklist li {
  display: flex;
  align-items: center;
  gap: 8px;
}
.csms-magnet-checklist li span.chk {
  color: #34d399;
  font-weight: 800;
  font-size: 16px;
}
.csms-magnet-actions {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  gap: 14px;
}
.csms-btn-magnet {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  background: #059669;
  color: #ffffff !important;
  font-family: 'Lexend', sans-serif;
  font-weight: 700;
  font-size: 15px;
  padding: 13px 26px;
  border-radius: 10px;
  box-shadow: 0 4px 14px rgba(5, 150, 105, 0.4);
  transition: transform 0.15s ease, background 0.15s ease;
}
.csms-btn-magnet:hover {
  background: #047857;
  transform: translateY(-2px);
  color: #ffffff !important;
}

/* Sticky Bottom Lead Bar */
.csms-sticky-bar {
  position: fixed;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(7, 26, 43, 0.96);
  backdrop-filter: blur(12px);
  border-top: 1px solid rgba(52, 211, 153, 0.35);
  padding: 12px 20px;
  z-index: 999;
  transform: translateY(100%);
  transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
  box-shadow: 0 -8px 24px rgba(0, 0, 0, 0.35);
}
.csms-sticky-bar.is-visible {
  transform: translateY(0);
}
.csms-sticky-inner {
  max-width: 1160px;
  margin: 0 auto;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 16px;
  flex-wrap: wrap;
}
.csms-sticky-text {
  font-size: 14px;
  color: #e2e8f0;
}
.csms-sticky-text strong {
  color: #34d399;
  font-weight: 700;
  font-family: 'Lexend', sans-serif;
}
.csms-sticky-btn {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: #059669;
  color: #ffffff !important;
  font-family: 'Lexend', sans-serif;
  font-weight: 700;
  font-size: 14px;
  padding: 10px 22px;
  border-radius: 8px;
  box-shadow: 0 4px 14px rgba(5, 150, 105, 0.4);
  transition: all 0.2s ease;
  white-space: nowrap;
}
.csms-sticky-btn:hover {
  background: #047857;
  transform: translateY(-2px);
  color: #ffffff !important;
}
@media (max-width: 768px) {
  .csms-sticky-inner {
    flex-direction: column;
    text-align: center;
    gap: 10px;
  }
  .csms-sticky-btn {
    width: 100%;
    justify-content: center;
  }
}
</style>

<!-- ═══════════════════════════════════════════════════ NAVBAR -->
<?php require __DIR__ . '/includes/navbar.php'; ?>

<!-- ═══════════════════════════════════════════════════ MAIN WRAPPER -->
<main id="konten-utama">

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
      <div class="hero-eyebrow">🛡️ PANDUAN ULTIMATE COMPLIANCE VENDOR &amp; TENDER K3</div>
      <h1>Panduan Komprehensif <span>CSMS</span><br>(Contractor Safety Management System)</h1>
      <p class="hero-lead">
        Buku panduan utama pengelolaan K3 kontraktor untuk standar <strong>Pertamina</strong>, <strong>SKK Migas (PTK-005)</strong>, <strong>PLN</strong>, <strong>BUMN</strong>, dan Industri Energi: 7 elemen penilaian, matriks risiko, siklus K3LL Pertamina, penyusunan laporan kinerja CHSEMS untuk manajemen puncak, berkas prakualifikasi, hingga audit lapangan untuk lolos kategori <strong>High Risk</strong>.
      </p>

      <div class="hero-meta">
        <div class="hero-meta-item">⏱️ <strong>25 Menit Baca</strong></div>
        <div class="hero-meta-item">📚 <strong>14 Bab Pembahasan</strong></div>
        <div class="hero-meta-item">📅 <strong>Diperbarui 2026</strong></div>
        <div class="hero-meta-item">🏛️ <strong>Standar Pertamina &amp; SKK Migas (PTK-005)</strong></div>
      </div>

      <div class="hero-btns">
        <a href="<?= e($wa_consult) ?>" target="_blank" rel="noopener" class="btn-primary">
          💬 Konsultasi Pendampingan Lolos CSMS
        </a>
        <a href="<?= e($wa_template) ?>" target="_blank" rel="noopener" class="btn-outline">
          📥 Minta Contoh Format &amp; Checklist CSMS
        </a>
      </div>

      <!-- Quick Action Lead Box -->
      <div class="csms-hero-leadbox">
        <div class="csms-leadbox-title">
          <span>⚡ Butuh Lolos Prakualifikasi CSMS Pertamina untuk Mengikuti Tender?</span>
        </div>
        <p class="csms-leadbox-desc">
          Jangan sampai perusahaan Anda gugur tender di tahap prakualifikasi. Tim konsultan K3 senior Wahana Totalita siap mendampingi penyusunan 7 elemen dokumen, SOP pekerjaan kritis, matriks IBPR, hingga simulasi audit agar siap 100% meraih sertifikat <strong>High Risk</strong> dalam 7–14 hari kerja.
        </p>
        <ul class="csms-leadbox-list">
          <li><span class="chk">✓</span> Penyusunan 7 Elemen Dokumen Baku</li>
          <li><span class="chk">✓</span> Matriks IBPR &amp; JSA Pekerjaan Kritis</li>
          <li><span class="chk">✓</span> Draf Project HSE Plan Spesifik Tender</li>
          <li><span class="chk">✓</span> Garansi Evaluasi &amp; Pendampingan Lolos</li>
        </ul>
      </div>

    </div>
  </header>

  <!-- TRUST PHOTO SECTION -->
  <section class="csms-trust" aria-labelledby="csms-trust-title">
    <div class="container">
      <div class="csms-trust-head">
        <h2 id="csms-trust-title">Pendampingan berbasis praktik lapangan riil</h2>
        <p>Dokumentasi pembinaan personil, simulasi tanggap darurat, inspeksi peralatan, dan implementasi sistem keselamatan kerja kontraktor.</p>
      </div>
      <div class="csms-photo-row">
        <figure class="csms-photo"><img src="/galeri/thumbs/PELATIHAN%20DAMKAR.JPG" alt="Simulasi tanggap darurat dan keselamatan kerja untuk sertifikasi CSMS K3" width="640" height="427" loading="lazy" decoding="async"><span>Simulasi tanggap darurat</span></figure>
        <figure class="csms-photo"><img src="/galeri/thumbs/IMG_1945.JPG" alt="Pemeriksaan peralatan keselamatan kerja industri sertifikasi Kemnaker RI" width="640" height="427" loading="lazy" decoding="async"><span>Pemeriksaan peralatan</span></figure>
        <figure class="csms-photo"><img src="/galeri/thumbs/DSC_0282.JPG" alt="Diskusi peserta pelatihan Ahli K3 Umum dan implementasi CSMS" width="640" height="427" loading="lazy" decoding="async"><span>Diskusi implementasi</span></figure>
        <figure class="csms-photo"><img src="/galeri/thumbs/IMG_1910.JPG" alt="Dokumentasi peserta pembinaan sertifikasi K3 Wahana Totalita" width="640" height="427" loading="lazy" decoding="async"><span>Bukti kegiatan</span></figure>
      </div>
    </div>
  </section>

  <!-- MAIN ARTICLE GRID -->
  <div class="main-wrapper">
    <div class="container">
      <div class="article-grid">

        <!-- SIDEBAR WITH TABLE OF CONTENTS & CTA -->
        <aside class="sidebar">
          <nav class="toc-box" aria-label="Daftar Isi">
            <div class="toc-title">📖 Daftar Isi Panduan</div>
            <ul class="toc-list">
              <li><a href="#bab-1">1. Pengertian &amp; Peran Strategis CSMS</a></li>
              <li><a href="#bab-2">2. Landasan Hukum &amp; Regulasi CSMS</a></li>
              <li><a href="#bab-3">3. CSMS vs SMK3 PP 50 vs ISO 45001</a></li>
              <li><a href="#bab-4">4. Siklus K3LL Pertamina (6 Tahapan)</a></li>
              <li><a href="#bab-5">5. 7 Elemen Utama Penilaian CSMS</a></li>
              <li><a href="#bab-6">6. Kategorisasi Risiko Pekerjaan</a></li>
              <li><a href="#bab-7">7. Berkas Prakualifikasi CSMS Wajib</a></li>
              <li><a href="#download-dokumen-csms">📥 Download Contoh Dokumen CSMS</a></li>
              <li><a href="#prosedur-daftar-csms">7.1 Cara Daftar &amp; Masa Berlaku CSMS</a></li>
              <li><a href="#bab-8">8. Menyusun HSE Plan Tender Unggul</a></li>
              <li><a href="#bab-9">9. Pelaksanaan &amp; Pengawasan Lapangan</a></li>
              <li><a href="#bab-10">10. Evaluasi Akhir &amp; Rating Kontraktor</a></li>
              <li><a href="#laporan-kinerja-manajemen-puncak">10.1 Laporan Kinerja CHSEMS Manajemen Puncak</a></li>
              <li><a href="#bab-11">11. 10 Kesalahan Fatal Penyebab Gagal</a></li>
              <li><a href="#bab-12">12. Roadmap 30 Hari Persiapan CSMS</a></li>
              <li><a href="#bab-13">13. Tanya Jawab Terlengkap (FAQ)</a></li>
              <li><a href="#bab-14">14. Pendampingan CSMS Wahana Totalita</a></li>
            </ul>
          </nav>

          <div class="sidebar-cta">
            <h3>Ingin Lolos CSMS Pertamina Tanpa Gagal?</h3>
            <p>Dapatkan pendampingan audit berkas, penyusunan HSE Plan, hingga pelatihan personil K3 bersertifikat KEMNAKER RI / BNSP.</p>
            <a href="<?= e($wa_consult) ?>" target="_blank" rel="noopener" class="btn-sidebar">💬 Hubungi Ahli K3 Kami</a>
          </div>
        </aside>

        <!-- MAIN ARTICLE BODY -->
        <article class="article-body">

          <!-- BAB 1 -->
          <section id="bab-1">
            <h2>1. Pengertian &amp; Peran Strategis CSMS dalam Industri Berisiko Tinggi</h2>
            <p>
              <strong>Contractor Safety Management System (CSMS)</strong> adalah suatu sistem manajemen komprehensif yang dirancang oleh perusahaan pemilik proyek (<em>Principal</em>/<em>Owner</em>) untuk mengelola, mengevaluasi, memverifikasi, dan meningkatkan kinerja K3LL (Keselamatan, Kesehatan Kerja, dan Perlindungan Lingkungan) dari para kontraktor, vendor, dan penyedia jasa yang bekerja di lingkungan operasional mereka.
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
            <h2>2. Landasan Hukum &amp; Regulasi CSMS di Indonesia</h2>
            <p>
              Penerapan CSMS di Indonesia memiliki payung hukum yang sangat kuat, baik dari regulasi nasional ketenagakerjaan maupun petunjuk teknis spesifik sektor industri energi dan sumber daya mineral:
            </p>

            <ul>
              <li><strong>Undang-Undang No. 1 Tahun 1970 tentang Keselamatan Kerja:</strong> Mewajibkan setiap pengurus tempat kerja untuk menjamin keselamatan setiap orang yang berada di tempat kerja tersebut, termasuk tenaga kerja pihak ketiga, tamu, dan kontraktor.</li>
              <li><strong>Peraturan Pemerintah (PP) No. 50 Tahun 2012 tentang Penerapan Sistem Manajemen K3 (SMK3):</strong> Elemen 11 PP 50/2012 secara eksplisit mengatur Pembelian dan Pengendalian Kontraktor, di mana perusahaan wajib menilai kapabilitas K3 penyedia barang dan jasa sebelum ikatan kerja dimulai.</li>
              <li><strong>Pedoman Tata Kerja SKK Migas No. PTK-005/SKKMA0000/2018/S0:</strong> Standar baku Pengelolaan Kesehatan, Keselamatan Kerja dan Lindungan Lingkungan Kontraktor untuk seluruh Kontraktor Kontrak Kerja Sama (KKKS) hulu migas di Indonesia.</li>
              <li><strong>Tata Kerja Organisasi (TKO) PT Pertamina (Persero) &amp; Holding/Subholding:</strong> Pedoman internal CSMS Pertamina yang mengatur 7 Elemen penilaian kualifikasi vendor di lingkungan Pertamina Group.</li>
              <li><strong>Standar Internasional IOGP Report 423 (HSE Management - Guidelines for Working Together):</strong> Acuan internasional dari <em>International Association of Oil &amp; Gas Producers</em> yang menjadi fondasi penyusunan CSMS global.</li>
              <li><strong>ISO 45001:2018 Klausul 8.1.4.2 (Procurement - Contractors):</strong> Meminta organisasi untuk mengkoordinasikan proses pengadaannya dengan kontraktor guna mengidentifikasi bahaya serta mengendalikan risiko K3.</li>
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
                    <td>Mengelola &amp; menilai risiko K3 pihak ketiga (kontraktor/vendor) oleh pemilik proyek.</td>
                    <td>Penerapan sistem K3 internal perusahaan sesuai regulasi wajib Pemerintah RI.</td>
                    <td>Standar internasional voluntary untuk kerangka kerja sistem manajemen K3 global.</td>
                  </tr>
                  <tr>
                    <td><strong>Pihak Penilai / Auditor</strong></td>
                    <td>Tim HSE Principal (Pertamina, SKK Migas, PLN, BUMN Karya, dll).</td>
                    <td>Lembaga Audit Independen yang ditunjuk Kemnaker RI (Sucofindo, Surveyor Indonesia, dll).</td>
                    <td>Lembaga Sertifikasi Internasional terakreditasi KAN/IAF (BSI, SGS, TUV, Lloyd's, dll).</td>
                  </tr>
                  <tr>
                    <td><strong>Fokus Pengujian</strong></td>
                    <td>Kesesuaian sistem K3 kontraktor dengan bahaya spesifik proyek yang akan ditenderkan.</td>
                    <td>Pemenuhan 64, 122, atau 166 kriteria audit sistem K3 nasional.</td>
                    <td>Klausa ISO (Plan-Do-Check-Act) &amp; kepemimpinan manajemen puncak.</td>
                  </tr>
                  <tr>
                    <td><strong>Masa Berlaku</strong></td>
                    <td>2 – 3 Tahun (atau per durasi kontrak proyek).</td>
                    <td>3 Tahun (Sertifikat &amp; Bendera Emas/Perak).</td>
                    <td>3 Tahun (dengan audit surveillance tahunan).</td>
                  </tr>
                  <tr>
                    <td><strong>Output Hasil</strong></td>
                    <td>High Risk / Medium Risk / Low Risk Approval Rating &amp; Score %.</td>
                    <td>Sertifikat SMK3 Kemnaker RI &amp; Tingkat Pencapaian %.</td>
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

          <!-- BAB 4: SIKLUS K3LL PERTAMINA (TOP RANKING QUERY) -->
          <section id="bab-4">
            <h2>4. Siklus K3LL Pertamina: 6 Tahapan Baku Contractor Safety Management System</h2>
            <p>
              Dalam pedoman Tata Kerja Organisasi (TKO) PT Pertamina (Persero) dan SKK Migas PTK-005, <strong>susunan siklus K3LL Pertamina</strong> (sering disebut sebagai siklus hidup CSMS) merupakan alur terstruktur yang wajib dilalui oleh setiap kontraktor, penyedia jasa, maupun konsultan lapangan. Siklus K3LL Pertamina terdiri dari <strong>6 tahapan berurutan</strong>:
            </p>

            <div class="stepper">
              <div class="step-item">
                <div class="step-number">1</div>
                <div class="step-content">
                  <div class="step-title">Tahap 1: Penilaian Risiko Pekerjaan (Risk Assessment &amp; Categorization)</div>
                  <p class="step-desc">
                    Dilakukan oleh Pemilik Proyek (Fungsi Pengguna Jasa / User Pertamina) sebelum pengadaan dibuka. Mengidentifikasi potensi bahaya pekerjaan dan mengklasifikasikan paket kerja ke dalam kategori <strong>Risiko Tinggi (High Risk)</strong>, <strong>Risiko Sedang (Medium Risk)</strong>, atau <strong>Risiko Rendah (Low Risk)</strong>.
                  </p>
                </div>
              </div>

              <div class="step-item">
                <div class="step-number">2</div>
                <div class="step-content">
                  <div class="step-title">Tahap 2: Prakualifikasi Kontraktor (Pre-Qualification / PQ)</div>
                  <p class="step-desc">
                    Tahap evaluasi kapabilitas K3LL vendor sebelum tender. Kontraktor mengunggah bukti pemenuhan <strong>7 Elemen Dokumen CSMS</strong> ke portal e-Procurement (SMART GEP Pertamina). Penilaian menghasilkan <em>Sertifikat CSMS</em> yang berlaku 2–3 tahun dengan predikat High/Medium/Low Risk.
                  </p>
                </div>
              </div>

              <div class="step-item">
                <div class="step-number">3</div>
                <div class="step-content">
                  <div class="step-title">Tahap 3: Seleksi Tender &amp; Penilaian HSE Plan (Selection Stage)</div>
                  <p class="step-desc">
                    Hanya vendor yang memiliki Sertifikat CSMS aktif sesuai level risiko yang diundang ikut lelang. Peserta tender wajib mengajukan dokumen <strong>Project-Specific HSE Plan</strong> yang dinilai dan diberi bobot dalam evaluasi teknis pengadaan.
                  </p>
                </div>
              </div>

              <div class="step-item">
                <div class="step-number">4</div>
                <div class="step-content">
                  <div class="step-title">Tahap 4: Aktivitas Pra-Pekerjaan (Pre-Job Activity)</div>
                  <p class="step-desc">
                    Dilaksanakan setelah penetapan pemenang kontrak dan sebelum pekerjaan fisik dimulai di site. Meliputi Kick-off Meeting K3LL, peninjauan lapangan bersama, verifikasi kelayakan peralatan &amp; SILO, pemeriksaan kesehatan (MCU) pekerja, induksi K3, dan penerbitan Surat Izin Kerja Aman (SIKA/PTW).
                  </p>
                </div>
              </div>

              <div class="step-item">
                <div class="step-number">5</div>
                <div class="step-content">
                  <div class="step-title">Tahap 5: Pengawasan Pelaksanaan Pekerjaan (Work in Progress / WIP Monitoring)</div>
                  <p class="step-desc">
                    Pengawasan langsung di area kerja Pertamina: briefing harian Toolbox Meeting (TBM/PJSM), pelaksanaan inspeksi harian, audit kepatuhan APD &amp; SOP, Safety Walkthrough manajemen, serta <strong>penyusunan laporan kinerja K3LL/CHSEMS bulanan</strong>.
                  </p>
                </div>
              </div>

              <div class="step-item">
                <div class="step-number">6</div>
                <div class="step-content">
                  <div class="step-title">Tahap 6: Evaluasi Akhir Kinerja K3LL (Final Close-Out Performance Review)</div>
                  <p class="step-desc">
                    Evaluasi komprehensif saat pekerjaan selesai (serah terima pekerjaan/BAST). Tim CSMS Pertamina menilai total kinerja keselamatan kontraktor (jam kerja selamat, kepatuhan, temuan insiden). Hasil penilaian menentukan rating kontraktor (Gold/Green/Yellow/Red) untuk hak partisipasi tender berikutnya.
                  </p>
                </div>
              </div>
            </div>
          </section>

          <!-- BAB 5: 7 ELEMEN UTAMA CSMS -->
          <section id="bab-5">
            <h2>5. 7 Elemen Utama Penilaian CSMS &amp; Bobot Penilaian (Scoring System)</h2>
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
                    <td><strong>1. Kepemimpinan &amp; Komitmen Manajemen</strong></td>
                    <td>15%</td>
                    <td>Management Walk Through (MWT) Direksi, keterlibatan pimpinan dalam Safety Meeting, alokasi anggaran K3, dan <strong>pelaporan kinerja K3LL kepada manajemen puncak</strong>.</td>
                  </tr>
                  <tr>
                    <td><strong>2. Kebijakan &amp; Sasaran Strategis K3LL</strong></td>
                    <td>10%</td>
                    <td>Kebijakan K3 tertulis yang ditandatangani Direktur Utama, Kebijakan Stop Work Authority, Kebijakan Bebas Narkoba &amp; Alkohol, sosialisasi kebijakan kepada seluruh pekerja.</td>
                  </tr>
                  <tr>
                    <td><strong>3. Organisasi, Kualifikasi, Sertifikasi &amp; Dokumentasi</strong></td>
                    <td>20%</td>
                    <td>Struktur organisasi K3, sertifikat Ahli K3 Umum Kemnaker RI aktif, sertifikasi personil teknis (Rigger, Scaffolder, Welder, Petugas P3K, Operator Crane/Forklift), prosedur pengendalian dokumen.</td>
                  </tr>
                  <tr>
                    <td><strong>4. Manajemen Risiko (HIRADC / IBPR) &amp; Prosedur</strong></td>
                    <td>20%</td>
                    <td>Matriks Risiko 5x5, dokumen IBPR/HIRADC spesifik aktivitas, SOP Pekerjaan Kritis (Hot Work, Confined Space, Lifting, Working at Height, Electrical Safety).</td>
                  </tr>
                  <tr>
                    <td><strong>5. Perencanaan &amp; Implementasi Operasional</strong></td>
                    <td>15%</td>
                    <td>Sistem Izin Kerja Aman (PTW/SIKA), Sistem LOTO, Manajemen Perubahan (MOC), Pemeliharaan Alat &amp; SILO, Distribusi &amp; Matriks APD sesuai bahaya kerja.</td>
                  </tr>
                  <tr>
                    <td><strong>6. Tanggap Darurat &amp; Investigasi Insiden</strong></td>
                    <td>10%</td>
                    <td>Prosedur ERP, Tim Tanggap Darurat, jadwal simulasi (drill evakuasi/kebakaran) berkala, prosedur investigasi insiden 5-Why/Fishbone, pelaporan Near Miss.</td>
                  </tr>
                  <tr>
                    <td><strong>7. Audit Internal, Tinjauan Manajemen &amp; Peningkatan</strong></td>
                    <td>10%</td>
                    <td>Program audit K3 internal, notulen rapat tinjauan manajemen (Management Review), pelacakan tindakan perbaikan (CAPA), <strong>penyusunan laporan kinerja K3LL/CHSEMS periodik</strong>.</td>
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

          <!-- BAB 6: KATEGORISASI RISIKO -->
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
                  Pekerjaan di area berbahaya tinggi dengan potensi Fatality atau kerusakan aset besar. Contoh: Pengeboran migas (drilling), pekerjaan panas di tangki hidrokarbon, pengangkatan berat (heavy lifting &gt;10 ton), pekerjaan di ruang terbatas (confined space), konstruksi di ketinggian &gt;5 meter, pekerjaan tegangan tinggi.
                </p>
              </div>

              <div class="info-card" style="border-top:4px solid #f59e0b">
                <div class="info-card-icon">⚙️</div>
                <div class="info-card-title">Risiko Sedang (Medium Risk)</div>
                <p class="info-card-desc">
                  Pekerjaan dengan potensi cedera berat namun terkendali. Contoh: Perbaikan mekanikal &amp; elektrikal umum, pekerjaan sipil gedung, fabrikasi pipa non-pressurized, transportasi logistik darat, pekerjaan pemeliharaan berkala di luar area proses utama.
                </p>
              </div>

              <div class="info-card" style="border-top:4px solid #10b981">
                <div class="info-card-icon">📋</div>
                <div class="info-card-title">Risiko Rendah (Low Risk)</div>
                <p class="info-card-desc">
                  Pekerjaan pendukung tanpa paparan bahaya industri langsung. Contoh: Jasa katering kantor, konsultan manajemen, penyediaan IT &amp; perangkat lunak, pekerjaan kebersihan kantor (janitorial), pengadaan alat tulis kantor (ATK).
                </p>
              </div>
            </div>
          </section>

          <!-- BAB 7: BERKAS PRAKUALIFIKASI CSMS -->
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
              <li><strong>Manual &amp; SOP K3:</strong> Prosedur Kerja Aman untuk seluruh operasional kunci (LOTO, Working at Height, Lifting, Confined Space, Hot Work, Waste Management).</li>
              <li><strong>Struktur Organisasi K3:</strong> Chart organisasi K3 yang disahkan Direksi, dilengkapi Surat Penunjukan (SK) P2K3 atau Penanggung Jawab K3.</li>
              <li><strong>Sertifikat Ahli K3 Umum (Kemnaker RI):</strong> Copy Sertifikat, SKP (Surat Keputusan Penunjukan), dan Kartu Lisensi K3 Ahli K3 Utama/Umum yang masih aktif.</li>
              <li><strong>Sertifikasi Kompetensi Personil Teknis:</strong> Lisensi Rigger (Juru Ikat), Scaffolder (Teknisi Perancah), Welder (Juru Las), Operator Crane (SILO &amp; SIO), Petugas P3K, dan Petugas Damkar.</li>
              <li><strong>Matriks IBPR / HIRADC:</strong> Form Identifikasi Bahaya, Penilaian Risiko, dan Pengendalian Risiko yang mencakup seluruh lingkup pekerjaan perusahaan.</li>
              <li><strong>Data Statistik K3 (3 Tahun Terakhir):</strong> Tabel rekapitulasi Jam Kerja Selamat (Safe Manhours), Lost Time Injury Rate (LTIR), Total Recordable Incident Rate (TRIR), Severity Rate, dan statistik Near Miss disahkan oleh Manajemen.</li>
              <li><strong>Bukti Inspeksi &amp; Kalibrasi Alat:</strong> Surat Ijin Laik Operasi (SILO) dari Disnaker/Migas untuk alat berat, crane, kompresor, bejana tekan, serta sertifikat kalibrasi alat ukur.</li>
              <li><strong>Bukti Audit Internal &amp; Management Review:</strong> Laporan Audit K3 Internal terakhir dan Notulen Rapat Tinjauan Manajemen (Management Review Meeting).</li>
              <li><strong>Prosedur &amp; Laporan Drill Evakuasi:</strong> Dokumentasi foto, daftar hadir, dan evaluasi hasil simulasi tanggap darurat (fire drill/evacuation drill).</li>
            </ol>

            <!-- LEAD MAGNET DOWNLOAD BOX (DIRECT ANSWER TO TOP SEARCH QUERIES) -->
            <div class="csms-lead-magnet" id="download-dokumen-csms">
              <h3>📥 Paket Contoh Dokumen CSMS Pertamina Lengkap (Template Checklist &amp; SOP)</h3>
              <p>
                Sedang menyusun berkas prakualifikasi CSMS atau mengejar jadwal tender? Dapatkan paket panduan praktis dan contoh format dokumen CSMS Pertamina &amp; SKK Migas (PTK-005) lengkap dari Wahana Totalita:
              </p>
              <ul class="csms-magnet-checklist">
                <li><span class="chk">✓</span> Contoh Format Manual CSMS &amp; Kebijakan K3LL</li>
                <li><span class="chk">✓</span> Template Matriks IBPR / HIRADC Pekerjaan Kritis</li>
                <li><span class="chk">✓</span> Template SOP LOTO, Confined Space, Lifting &amp; Hot Work</li>
                <li><span class="chk">✓</span> Format Laporan Kinerja CHSEMS untuk Manajemen Puncak</li>
                <li><span class="chk">✓</span> Draf Contoh Project HSE Plan Tender Migas/Konstruksi</li>
                <li><span class="chk">✓</span> Checklist Lengkap Verifikasi Portal CSMS Pertamina</li>
              </ul>
              <div class="csms-magnet-actions">
                <a href="<?= e($wa_template) ?>" class="csms-btn-magnet" target="_blank" rel="noopener">
                  💬 Minta Contoh Format &amp; Checklist via WhatsApp
                </a>
                <span style="font-size:13px;color:#94a3b8">Layanan cepat &amp; konsultasi gratis</span>
              </div>
            </div>

            <!-- SUBSECTION: CARA DAFTAR & MASA BERLAKU CSMS (TOP QUERIES) -->
            <div id="prosedur-daftar-csms" style="margin-top:32px;padding:24px;background:#f8fafc;border:1px solid #e2e8f0;border-radius:14px;">
              <h3 style="font-family:'Lexend',sans-serif;font-size:18px;color:#0f172a;margin-bottom:12px;">
                7.1 Panduan Pendaftaran CSMS Pertamina, Durasi Proses, &amp; Masa Berlaku
              </h3>
              <p style="font-size:14.5px;color:#475569;line-height:1.65;margin-bottom:14px;">
                Bagi kontraktor baru yang sering bertanya seputar mekanisme pendaftaran, berikut adalah panduan praktisnya:
              </p>
              <ul style="font-size:14px;color:#334155;line-height:1.7;padding-left:20px;margin-bottom:14px;">
                <li><strong>Bagaimana Cara Mendaftarnya?</strong> Kontraktor mendaftar melalui portal e-Procurement resmi Pertamina (seperti portal SMART GEP / VMS Pertamina). Setelah membuat akun vendor, kontraktor memilih menu Prakualifikasi K3LL/CSMS, mengunduh kuesioner 7 elemen, dan mengunggah dokumen bukti records dalam format PDF.</li>
                <li><strong>Berapa Lama Proses Pembuatan &amp; Verifikasinya?</strong> Proses persiapan dokumen internal secara mandiri membutuhkan 1–2 bulan. Bersama konsultan Wahana Totalita, persiapan berkas dapat dipersingkat menjadi <strong>7–14 hari kerja</strong>. Setelah di-submit ke portal, proses audit verifikasi oleh asesor Pertamina rata-rata memakan waktu <strong>14–30 hari kerja</strong>.</li>
                <li><strong>Berapa Tahun Masa Berlakunya?</strong> Sertifikat CSMS Pertamina memiliki masa berlaku <strong>2 hingga 3 tahun</strong>. Sertifikat ini diakui di seluruh holding, subholding (Upstream, Refinery, Commercial &amp; Trading), dan anak perusahaan Pertamina untuk kategori risiko yang sama.</li>
                <li><strong>Bagaimana Jika Gagal?</strong> Kontraktor yang gagal (skor &lt;50% atau gagal di audit lapangan) harus menunggu masa pembinaan 6–12 bulan sebelum diperbolehkan mengajukan re-assessment. Oleh karena itu, persiapan yang matang sejak awal sangat krusial.</li>
              </ul>
            </div>

          </section>

          <!-- BAB 8: HSE PLAN TENDER -->
          <section id="bab-8">
            <h2>8. Penyusunan HSE Plan Tender yang Unggul (Project-Specific HSE Plan)</h2>
            <p>
              Setelah lulus Prakualifikasi dan mendapatkan Sertifikat CSMS, langkah berikutnya saat mengikuti tender adalah menyusun <strong>Project HSE Plan</strong>. Berbeda dengan dokumen Prakualifikasi yang bersifat umum tingkat perusahaan, HSE Plan bersifat <em>site-specific</em> dan <em>project-specific</em>.
            </p>

            <h3>Komponen Utama Anatomi HSE Plan Tender:</h3>
            <ul>
              <li><strong>Ringkasan Proyek &amp; Lingkup Kerja:</strong> Penjelasan mendalam mengenai metode kerja teknis yang akan digunakan di lokasi proyek.</li>
              <li><strong>Target &amp; Sasaran K3 Proyek (KPI K3):</strong> Penetapan target kuantitatif (contoh: 0 Fatality, 0 LTIR, 100% Kepatuhan APD, 50 BBS Observation/bulan).</li>
              <li><strong>Organisasi HSE Proyek:</strong> Struktur rantai komando K3 di lokasi proyek, daftar HSE Officer yang ditugaskan beserta sertifikatnya.</li>
              <li><strong>Spesifik Risk Assessment (JSA &amp; IBPR Proyek):</strong> Analisis keselamatan kerja tahap demi tahap (Job Safety Analysis) untuk setiap tahapan pekerjaan tender.</li>
              <li><strong>Rencana Pengendalian Lingkungan:</strong> Pengelolaan limbah B3, pengendalian tumpahan oli/kimia (spill kit), dan pengolahan sampah domestik site.</li>
              <li><strong>Prosedur Emergency Response Site Spesifik:</strong> Peta jalur evakuasi proyek, lokasi titik kumpul (muster point), nomor kontak darurat lokal (RS terdekat, Damkar, Polsek).</li>
              <li><strong>Jadwal Pelatihan &amp; Safety Program Site:</strong> Matriks jadwal Induksi K3, Toolbox Meeting harian, Inspeksi Mingguan, dan Safety Campaign.</li>
            </ul>
          </section>

          <!-- BAB 9: PELAKSANAAN & PENGAWASAN LAPANGAN -->
          <section id="bab-9">
            <h2>9. Pelaksanaan &amp; Pengawasan Lapangan (Work In Progress / WIP)</h2>
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
                <div class="info-card-title">Toolbox Meeting (TBM) &amp; PJSM</div>
                <p class="info-card-desc">
                  Briefing keselamatan 5-10 menit sebelum shift kerja dimulai untuk mendiskusikan bahaya harian, kondisi cuaca, dan kesiapan APD personil.
                </p>
              </div>

              <div class="info-card">
                <div class="info-card-icon">🔎</div>
                <div class="info-card-title">Safety Patrol &amp; Interim Audit</div>
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

          <!-- BAB 10: EVALUASI AKHIR & LAPORAN KINERJA MANAJEMEN PUNCAK -->
          <section id="bab-10">
            <h2>10. Evaluasi Akhir &amp; Rating Kontraktor (Close-Out Performance Review)</h2>
            <p>
              Di akhir masa proyek, Tim CSMS Principal akan menerbitkan laporan <strong>Evaluasi Akhir Kontraktor (Contractor Close-Out HSE Review)</strong>. Skor akhir dihitung berdasarkan akumulasi kinerja keselamatan selama proyek berlangsung:
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

            <!-- SUBSECTION: PENYUSUNAN LAPORAN KINERJA CHSEMS UNTUK MANAJEMEN PUNCAK (TOP SEARCH QUERY!) -->
            <div id="laporan-kinerja-manajemen-puncak" style="margin-top:36px;padding:28px;background:#ffffff;border:1.5px solid #059669;border-radius:16px;box-shadow:0 8px 24px rgba(5,150,105,0.08);">
              <span style="font-family:'Lexend',sans-serif;font-size:12px;font-weight:700;color:#059669;text-transform:uppercase;letter-spacing:0.06em;display:block;margin-bottom:6px;">Panduan Khusus Kontraktor</span>
              <h3 style="font-family:'Lexend',sans-serif;font-size:21px;font-weight:800;color:#0f172a;margin-bottom:14px;line-height:1.3;">
                10.1 Cara Penyusunan Laporan Kinerja CHSEMS / K3LL untuk Manajemen Puncak
              </h3>
              <p style="font-size:15px;color:#334155;line-height:1.7;margin-bottom:16px;">
                Salah satu kriteria penting dalam Elemen 1 (Kepemimpinan) dan Elemen 7 (Tinjauan Manajemen) kuesioner CSMS Pertamina adalah adanya bukti tertulis <strong>pelaporan kinerja K3LL / CHSEMS (Contractor Health, Safety, and Environment Management System) kepada Manajemen Puncak (Direksi &amp; Dewan Komisaris)</strong>.
              </p>

              <h4 style="font-size:16px;color:#0f172a;margin-bottom:10px;">A. Komponen Wajib Laporan Kinerja CHSEMS Eksekutif:</h4>
              <ol style="font-size:14.5px;color:#475569;line-height:1.7;padding-left:22px;margin-bottom:18px;">
                <li><strong>Leading Indicators (Indikator Proaktif Pencegahan):</strong>
                  <ul>
                    <li>Jumlah Management Walk Through (MWT) yang dilakukan oleh Direksi dan General Manager.</li>
                    <li>Persentase kehadiran Toolbox Meeting (TBM) dan Safety Induction karyawan baru.</li>
                    <li>Jumlah temuan inspeksi keselamatan kerja, pelaporan kartu Near Miss / Hazard Observation Card (HOC).</li>
                    <li>Persentase penyelesaian Corrective Action &amp; Preventive Action (CAPA) tepat waktu.</li>
                    <li>Realisasi program pelatihan dan sertifikasi K3 personil dibandingkan dengan Training Matrix tahunan.</li>
                  </ul>
                </li>
                <li><strong>Lagging Indicators (Indikator Reaktif Statistik Insiden):</strong>
                  <ul>
                    <li>Total Jam Kerja Selamat (Cumulative Safe Manhours) tanpa kecelakaan kerja hilang waktu (LTI).</li>
                    <li>Nilai Lost Time Injury Frequency Rate (LTIFR) dan Total Recordable Incident Rate (TRIR).</li>
                    <li>Catatan kasus Pertolongan Pertama Pada Kecelakaan (P3K) dan kerusakan aset / properti (Property Damage).</li>
                    <li>Insiden lingkungan (tumpahan minyak, pencemaran tanah/air, pengelolaan limbah B3).</li>
                  </ul>
                </li>
                <li><strong>Evaluasi Kepatuhan Regulasi &amp; Legalitas:</strong>
                  Status masa berlaku sertifikat kompetensi Ahli K3 Umum, SIO operator, lisensi teknisi, dan Surat Ijin Laik Operasi (SILO) alat berat yang dioperasikan.
                </li>
                <li><strong>Notulen &amp; Keputusan Rapat Tinjauan Manajemen (Management Review):</strong>
                  Rekomendasi strategis, alokasi anggaran tambahan K3, dan arahan Direksi untuk perbaikan sistem keselamatan kerja berkelanjutan.
                </li>
              </ol>

              <div style="background:#ecfdf5;border:1px solid #a7f3d0;border-radius:10px;padding:16px 20px;">
                <strong style="color:#065f46;font-size:14.5px;">💡 Tips Lolos Asesmen CSMS:</strong>
                <p style="margin:4px 0 0;font-size:13.5px;color:#047857;line-height:1.6;">
                  Laporan kinerja CHSEMS untuk direksi tidak perlu bertele-tele (cukup 3–5 halaman eksekutif berisi ringkasan dashboard metrik K3LL) tetapi <strong>wajib dilengkapi lembar disposisi tanda tangan Direktur Utama</strong> serta bukti undangan &amp; notulen rapat evaluasi berkala (triwulanan/tahunan). Ini adalah dokumen berbobot nilai tertinggi di Elemen 7!
                </p>
              </div>
            </div>

          </section>

          <!-- BAB 11: 10 KESALAHAN FATAL -->
          <section id="bab-11">
            <h2>11. 10 Kesalahan Fatal Penyebab Gagal Pre-Kualifikasi CSMS &amp; Cara Mengatasinya</h2>
            <p>
              Berdasarkan pengalaman pendampingan audit CSMS oleh Wahana Totalita, berikut adalah 10 jebakan utama yang paling sering menyebabkan berkas kontraktor ditolak atau mendapat nilai di bawah standar:
            </p>

            <ol>
              <li><strong>Sertifikat Ahli K3 atau Lisensi Personil Kedaluwarsa:</strong> Mengunggah sertifikat Ahli K3 Umum atau SIO operator yang telah habis masa berlakunya. <em>Solusi: Buat matriks masa berlaku sertifikat dan lakukan perpanjangan (recertification) 3 bulan sebelum ekspirasi.</em></li>
              <li><strong>Data Jam Kerja &amp; Statistik K3 Manipulatif / Tidak Konsisten:</strong> Jumlah jam kerja di statistik K3 tidak sinkron dengan jumlah karyawan di laporan HRD. <em>Solusi: Gunakan formula kalkulasi jam kerja standar (Jumlah Karyawan x Jam Kerja Efektif x Hari Kerja).</em></li>
              <li><strong>Dokumen IBPR / HIRADC bersifat Generic:</strong> Menyalin tabel IBPR dari internet yang tidak menggambarkan bahaya spesifik dari alat dan lokasi kerja yang digunakan. <em>Solusi: Menyusun IBPR berbasis analisis proses kerja aktual.</em></li>
              <li><strong>Prosedur / SOP Tanpa Tanda Tangan &amp; Kontrol Revisi:</strong> SOP tidak memiliki lembar pengesahan Direksi, penomoran dokumen, atau tanggal berlaku.</li>
              <li><strong>Bukti Audit Internal Fiktif:</strong> Mengisi kuesioner mengaku rutin audit internal tetapi tidak dapat melampirkan daftar hadir auditor, foto audit, dan lembar temuan (checklist audit).</li>
              <li><strong>Struktur Organisasi K3 Tidak Sesuai Rantai Komando:</strong> Posisi HSE Manager diletakkan di bawah Supervisor Lapangan, yang mengurangi independensi wewenang Stop Work.</li>
              <li><strong>Matriks APD (PPE Grid) Tidak Sesuai Hazard:</strong> Menyediakan sarung tangan kain standar untuk pekerjaan penanganan bahan kimia korosif.</li>
              <li><strong>Peralatan Alat Berat Tanpa SILO / SIO:</strong> Menggunakan Crane atau Forklift yang tidak memiliki Surat Ijin Laik Operasi aktif dari instansi Ketenagakerjaan.</li>
              <li><strong>Prosedur ERP Tanpa Jadwal &amp; Laporan Drill:</strong> Punya prosedur ERP tebal tapi tidak pernah melaksanakan simulasi kebakaran/evakuasi minimal 1 tahun sekali.</li>
              <li><strong>Tidak Ada Bukti Rapat Tinjauan Manajemen (Management Review):</strong> Tidak memiliki notulen rapat berkala Direksi yang membahas evaluasi kinerja K3 perusahaan.</li>
            </ol>
          </section>

          <!-- BAB 12: ROADMAP 30 HARI -->
          <section id="bab-12">
            <h2>12. Roadmap 30 Hari Persiapan Sertifikasi CSMS dari Nol</h2>
            <p>
              Jika perusahaan Anda belum memiliki sistem CSMS dan ingin mengejar target tender dalam waktu dekat, ikuti roadmap aksi 30 hari terstruktur berikut:
            </p>

            <div class="stepper">
              <div class="step-item">
                <div class="step-number">W1</div>
                <div class="step-content">
                  <div class="step-title">Minggu 1: Gap Analysis &amp; Inventarisasi Dokumen</div>
                  <p class="step-desc">
                    Lakukan pemetaan seluruh dokumen K3 yang sudah dimiliki perusahaan. Bandingkan dengan 7 Elemen Kuesioner CSMS Pertamina/SKK Migas untuk mengidentifikasi dokumen yang belum ada (gap).
                  </p>
                </div>
              </div>

              <div class="step-item">
                <div class="step-number">W2</div>
                <div class="step-content">
                  <div class="step-title">Minggu 2: Penyusunan Kebijakan, Manual, &amp; SOP K3</div>
                  <p class="step-desc">
                    Susun Kebijakan K3LL, Kebijakan Stop Work, Manual K3, serta 15+ SOP Pekerjaan Kritis. Pastikan seluruh dokumen disahkan oleh Direktur Utama.
                  </p>
                </div>
              </div>

              <div class="step-item">
                <div class="step-number">W3</div>
                <div class="step-content">
                  <div class="step-title">Minggu 3: Pemenuhan Sertifikasi &amp; Bukti Implementasi (Records)</div>
                  <p class="step-desc">
                    Daftarkan personil kunci pada pelatihan Ahli K3 Umum Kemnaker RI / BNSP. Lakukan inspeksi alat, buat laporan simulasi ERP, dan gelar rapat Management Review.
                  </p>
                </div>
              </div>

              <div class="step-item">
                <div class="step-number">W4</div>
                <div class="step-content">
                  <div class="step-title">Minggu 4: Final Compilation, Internal Simulation Audit, &amp; Submission</div>
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
                <summary>Bagaimana susunan siklus K3LL Pertamina?</summary>
                <div class="faq-answer">
                  Siklus K3LL Pertamina terdiri dari 6 tahapan: 1. Penilaian Risiko (Risk Assessment), 2. Prakualifikasi CSMS (Pre-Qualification), 3. Seleksi Tender &amp; Evaluasi HSE Plan, 4. Pra-Pekerjaan (Pre-Job Activity), 5. Pekerjaan Berlangsung (Work In Progress), dan 6. Evaluasi Akhir Kinerja (Close-Out Performance Review).
                </div>
              </details>

              <details>
                <summary>Bagaimana cara menyusun laporan kinerja CHSEMS untuk manajemen puncak?</summary>
                <div class="faq-answer">
                  Laporan kinerja CHSEMS untuk manajemen puncak disusun secara berkala merangkum indikator terdepan (Leading: safety walkthrough direksi, TBM, inspeksi K3, laporan near-miss, realisasi audit K3) dan indikator akhir (Lagging: jam kerja selamat, LTIFR, TRIR, keparahan insiden) serta status tindak lanjut temuan audit (CAPA) yang disahkan oleh Direktur Utama.
                </div>
              </details>

              <details>
                <summary>Apakah CSMS Pertamina dan SKK Migas Wajib Bagi Semua Kontraktor?</summary>
                <div class="faq-answer">
                  Ya, CSMS hukumnya wajib bagi seluruh vendor, supplier jasa, dan kontraktor yang ingin berpartisipasi dalam tender di lingkungan PT Pertamina (Persero), KKKS di bawah SKK Migas, PLN, serta BUMN dan perusahaan energi swasta di Indonesia.
                </div>
              </details>

              <details>
                <summary>Berapa batas minimal skor (cut-off score) untuk lolos CSMS Pertamina?</summary>
                <div class="faq-answer">
                  Batas minimal skor tergantung kategori risiko pekerjaan: Risiko Tinggi (High Risk) umumnya membutuhkan skor minimal 75%-80%, Risiko Sedang (Medium Risk) 60%-70%, dan Risiko Rendah (Low Risk) minimal 50%.
                </div>
              </details>

              <details>
                <summary>Berapa lama masa berlaku sertifikat Pre-Kualifikasi CSMS Pertamina?</summary>
                <div class="faq-answer">
                  Masa berlaku sertifikat prakualifikasi CSMS umumnya 2 hingga 3 tahun tergantung regulasi Principal. Namun, status dapat ditinjau ulang atau dicabut jika terjadi kecelakaan kerja fatal (Fatality) pada proyek yang sedang berjalan.
                </div>
              </details>

              <details>
                <summary>Berapa lama proses pembuatan dokumen CSMS dengan bantuan konsultan?</summary>
                <div class="faq-answer">
                  Dengan pendampingan konsultan Wahana Totalita, penyusunan seluruh 7 elemen dokumen CSMS dapat diselesaikan dalam 7 hingga 14 hari kerja, siap upload ke sistem portal CSMS Pertamina.
                </div>
              </details>

              <details>
                <summary>Apakah Perusahaan Kecil / CV Bisa Mendaftar CSMS Pertamina?</summary>
                <div class="faq-answer">
                  Bisa. Pengajuan CSMS disesuaikan dengan tingkat risiko pekerjaan. Untuk pekerjaan risiko rendah atau sedang (seperti pengadaan bahan, jasa katering, IT maintenance), CV tetap dapat memenuhi dokumen CSMS sesuai porsinya.
                </div>
              </details>
            </div>
          </section>

          <!-- BAB 14: SERVICES & CLOSING CTA -->
          <section id="bab-14">
            <h2>14. Layanan Pendampingan CSMS &amp; Sertifikasi K3 Wahana Totalita</h2>
            <p>
              Menyiapkan sistem CSMS yang memenuhi standar tinggi Pertamina, SKK Migas, dan BUMN membutuhkan ketelitian teknis, pemahaman regulasi, serta bukti implementasi K3 yang valid. <strong>Wahana Totalita Konsultan</strong> hadir sebagai mitra terpercaya perusahaan Anda dalam pemenuhan kualifikasi K3 dan pengembangan sumber daya manusia.
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
                <div class="info-card-title">Pelatihan K3 Migas &amp; Konstruksi</div>
                <p class="info-card-desc">
                  Sertifikasi personil spesifik industri: Pengawas K3 Migas, Ahli K3 Konstruksi, Auditor SMK3, Pengawas Operasional Pertambangan (POP BNSP).
                </p>
              </div>

              <div class="info-card">
                <div class="info-card-icon">📝</div>
                <div class="info-card-title">Penyusunan Project HSE Plan Tender</div>
                <p class="info-card-desc">
                  Jasa pembuatan proposal HSE Plan spesifik proyek untuk keperluan kelengkapan berkas tender di lingkungan BUMN &amp; Swasta.
                </p>
              </div>
            </div>

            <div class="mid-article-cta" style="margin-top:40px">
              <h3>Siap Tingkatkan Kualifikasi CSMS Perusahaan Anda?</h3>
              <p>Konsultasikan kebutuhan CSMS dan pelatihan K3 tim Anda bersama konsultan senior Wahana Totalita sekarang juga.</p>
              <a href="<?= e($wa_consult) ?>" target="_blank" rel="noopener" class="btn-primary" style="font-size:17px;padding:16px 36px">💬 Konsultasi Pendampingan CSMS via WhatsApp</a>
            </div>
          </section>

        </article>
      </div>
    </div>
  </div>

  <!-- CROSS-RESOURCES SECTION -->
  <section class="csms-resources" aria-labelledby="csms-resources-title">
    <div class="csms-resources-in">
      <span class="hero-eyebrow" style="color:#d95716;border-color:#f0c7b0;background:#fff">LANGKAH BERIKUTNYA</span>
      <h2 id="csms-resources-title">Perkuat dokumen dan kompetensi perusahaan</h2>
      <p>Gunakan panduan, alat bantu, jadwal pelatihan, dan program kompetensi yang relevan untuk menindaklanjuti hasil evaluasi CSMS.</p>
      <div class="csms-resource-grid">
        <a class="csms-resource-card" href="/tools/safety-talk"><small>Toolbox</small><b>Materi Safety Talk</b><span>Siapkan pengarahan →</span></a>
        <a class="csms-resource-card" href="/jadwal/"><small>Kompetensi</small><b>Jadwal Pelatihan K3</b><span>Lihat batch aktif →</span></a>
        <a class="csms-resource-card" href="/pelatihan/ahli-k3-umum-sertifikasi-kemnaker-ri"><small>Kemnaker RI</small><b>Ahli K3 Umum</b><span>Lihat program →</span></a>
        <a class="csms-resource-card" href="/k3"><small>Panduan</small><b>Pusat Informasi K3</b><span>Pelajari dasar K3 →</span></a>
        <a class="csms-resource-card" href="/layanan-pemerintah"><small>B2G &amp; Vendor</small><b>Vendor Pelatihan K3</b><span>Lihat pengadaan →</span></a>
        <a class="csms-resource-card" href="/perusahaan"><small>In-House</small><b>Layanan Korporasi</b><span>Solusi training →</span></a>
        <a class="csms-resource-card" href="/artikel/"><small>Referensi</small><b>Artikel dan Regulasi</b><span>Baca artikel →</span></a>
        <a class="csms-resource-card" href="<?= e($wa_consult) ?>"><small>Konsultasi</small><b>Pendampingan CSMS</b><span>Hubungi konsultan →</span></a>
      </div>
    </div>
  </section>

</main>

<!-- ═══════════════════════════════════════════════════ STICKY BOTTOM LEAD BAR -->
<div class="csms-sticky-bar" id="csmsStickyBar" aria-hidden="true">
  <div class="csms-sticky-inner">
    <div class="csms-sticky-text">
      <strong>⚠️ Butuh Lolos CSMS Pertamina / BUMN untuk Tender?</strong>
      <span>Dapatkan pendampingan dokumen 7 elemen &amp; draf HSE Plan siap lolos High Risk.</span>
    </div>
    <a href="<?= e($wa_consult) ?>" class="csms-sticky-btn" target="_blank" rel="noopener">
      <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
      <span>Konsultasi CSMS via WhatsApp</span>
    </a>
  </div>
</div>

<script>
// Show sticky lead bar on scroll (> 500px)
(function(){
  var bar = document.getElementById('csmsStickyBar');
  if(!bar) return;
  var shown = false;
  window.addEventListener('scroll', function(){
    var shouldShow = window.scrollY > 500;
    if(shouldShow !== shown){
      shown = shouldShow;
      bar.classList.toggle('is-visible', shown);
      bar.setAttribute('aria-hidden', !shown);
    }
  }, {passive: true});
})();
</script>

<!-- ═══════════════════════════════════════════════════ FOOTER -->
<?php require __DIR__ . '/includes/footer.php'; ?>
<?php require __DIR__ . '/includes/scripts.php'; ?>

</body>
</html>
