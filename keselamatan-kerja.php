<?php
require_once __DIR__ . '/config.php';
$s = get_all_settings();
/**
 * keselamatan-kerja.php
 * Seasonal SEO hub page targeting the broad "keselamatan kerja" query.
 * Zero DB dependency, modeled on sertifikasi-bnsp.php.
 */
$wa_number = '6287759151278';
$wa_msg = rawurlencode('Halo, saya ingin konsultasi program pelatihan K3 untuk perusahaan kami');
$wa_url = "https://wa.me/{$wa_number}?text={$wa_msg}";
$year = date('Y');

$dasarHukum = [
    ['title' => 'UU No. 1 Tahun 1970', 'desc' => 'Undang-undang dasar Keselamatan Kerja — payung hukum utama seluruh regulasi K3 di Indonesia.'],
    ['title' => 'PP No. 50 Tahun 2012', 'desc' => 'Mengatur Penerapan Sistem Manajemen Keselamatan dan Kesehatan Kerja (SMK3) di perusahaan.'],
    ['title' => 'Permenaker No. 26 Tahun 2014', 'desc' => 'Mengatur penilaian penerapan SMK3 dan kompetensi K3 bidang kelistrikan.'],
    ['title' => 'Permenaker No. 13 Tahun 2025', 'desc' => 'Regulasi terbaru mengenai Panitia Pembina Keselamatan dan Kesehatan Kerja (P2K3).'],
];

$sertifikasi = [
    ['jenis' => 'Ahli K3 Umum', 'lembaga' => 'Kemnaker RI', 'berlaku' => '3 tahun'],
    ['jenis' => 'Ahli K3 Spesialis', 'lembaga' => 'Kemnaker RI', 'berlaku' => '3 tahun'],
    ['jenis' => 'Skema Kompetensi K3', 'lembaga' => 'BNSP', 'berlaku' => '3 tahun'],
];

$skemas = [
    [
        'name'     => 'Ahli K3 Umum Kemnaker RI & BNSP',
        'cert'     => 'Kemnaker RI / BNSP',
        'slug'     => 'pelatihan-ahli-k3-umum-sertifikasi-bnsp',
        'mode'     => 'Sertifikasi Resmi Nasional',
        'duration' => '12 Hari Pelatihan',
        'desc'     => 'Program pembinaan calon Ahli K3 Umum untuk mengawasi kepatuhan UU No. 1/1970 di tempat kerja dan merancang sistem manajemen K3 perusahaan.',
        'target'   => 'HSE Officer, Supervisor Pabrik, Fresh Graduate D3/S1',
    ],
    [
        'name'     => 'Ahli Muda K3 Konstruksi BNSP',
        'cert'     => 'Sertifikasi BNSP',
        'slug'     => 'pelatihan-ahli-muda-k3-konstruksi-online',
        'mode'     => 'Uji Kompetensi BNSP',
        'duration' => '5 Hari Pelatihan',
        'desc'     => 'Pelatihan pengawasan keselamatan proyek konstruksi, identifikasi bahaya struktural lapangan, dan penyusunan dokumen SMKK/HIRADC.',
        'target'   => 'Site Engineer, Pelaksana Proyek Sipil, Safety Officer',
    ],
    [
        'name'     => 'Pengawas K3 Industri Migas BNSP',
        'cert'     => 'Sertifikasi BNSP',
        'slug'     => 'pelatihan-pengawas-k3-industri-migas-sertifikasi-bnsp',
        'mode'     => 'Sertifikasi SKKNI Migas',
        'duration' => '4 Hari Pelatihan',
        'desc'     => 'Standarisasi kompetensi pengawas keselamatan operasi migas hulu/hilir, pengendalian gas H2S, dan prosedur izin kerja aman (PTW).',
        'target'   => 'Safety Inspector, Rig Crew, Operator Migas',
    ],
    [
        'name'     => 'Operator Forklift Kelas 2 Kemnaker RI',
        'cert'     => 'Kemnaker RI',
        'slug'     => 'pelatihan-k3-operator-forklift-kelas-2-sertifikasi-kemnaker-ri',
        'mode'     => 'Lisensi K3 Kemnaker RI',
        'duration' => '3 Hari Pelatihan',
        'desc'     => 'Lisensi resmi KEMNAKER RI pengoperasian unit forklift industri di bawah kapasitas 15 ton sesuai Permenaker No. 08 Tahun 2020.',
        'target'   => 'Operator Forklift, Staf Gudang & Logistik',
    ],
    [
        'name'     => 'Petugas P3K di Tempat Kerja BNSP',
        'cert'     => 'Sertifikasi BNSP',
        'slug'     => 'pelatihan-petugas-p3k-sertifikasi-bnsp',
        'mode'     => 'Sertifikasi BNSP',
        'duration' => '3 Hari Pelatihan',
        'desc'     => 'Pelatihan tanggap darurat medis tempat kerja, prosedur resusitasi jantung paru (RJP), pertolongan luka, dan regulasi Permenaker 15/2008.',
        'target'   => 'Tim Tanggap Darurat, HRGA, Paramedis Perusahaan',
    ],
    [
        'name'     => 'Auditor Sistem Manajemen K3 (SMK3)',
        'cert'     => 'Sertifikasi BNSP',
        'slug'     => 'pelatihan-auditor-sistem-manajemen-k3-sertifikasi-bnsp',
        'mode'     => 'Sertifikasi BNSP',
        'duration' => '4 Hari Pelatihan',
        'desc'     => 'Kualifikasi auditor internal untuk evaluasi penerapan SMK3 PP No. 50 Tahun 2012 dan ISO 45001 menuju sertifikasi bendera emas.',
        'target'   => 'Internal Auditor, QHSE Manager, Tim SMK3',
    ],
];

$elemenSmk3 = [
    'Penetapan kebijakan K3',
    'Perencanaan K3',
    'Pelaksanaan rencana K3',
    'Pemantauan dan evaluasi kinerja K3',
    'Peninjauan dan peningkatan kinerja SMK3',
];

$pencegahan = [
    'Identifikasi bahaya dan penilaian risiko (IBPR/HIRARC) secara rutin di setiap area kerja.',
    'Terapkan hierarki pengendalian — eliminasi, substitusi, rekayasa teknik, administratif, hingga APD.',
    'Bentuk P2K3 dan tunjuk Ahli K3 sesuai kewajiban regulasi bagi perusahaan berisiko tinggi.',
    'Selenggarakan safety talk/toolbox meeting rutin untuk menjaga kesadaran keselamatan pekerja.',
    'Investigasi setiap insiden dan near miss untuk menemukan akar masalah dan mencegah pengulangan.',
];

$faqs = [
    ['q' => 'Apa saja kewajiban perusahaan dalam K3?', 'a' => 'Berdasarkan UU No. 1 Tahun 1970 Pasal 8 dan ketentuan turunannya, perusahaan wajib membentuk Panitia Pembina Keselamatan dan Kesehatan Kerja (P2K3) jika mempekerjakan lebih dari 100 karyawan, serta menerapkan Sistem Manajemen K3 (SMK3) sesuai PP No. 50 Tahun 2012.'],
    ['q' => 'Siapa yang wajib memiliki Ahli K3?', 'a' => 'Perusahaan dengan tingkat risiko bahaya tinggi atau yang mempekerjakan lebih dari 100 karyawan wajib memiliki Ahli K3 yang ditunjuk dan disahkan oleh Kemnaker RI.'],
    ['q' => 'Apa perbedaan K3 dan SMK3?', 'a' => 'K3 adalah konsep umum keselamatan dan kesehatan kerja, sedangkan SMK3 (Sistem Manajemen Keselamatan dan Kesehatan Kerja) adalah sistem manajemen terstruktur untuk menerapkan K3 secara sistematis di perusahaan, sesuai PP No. 50 Tahun 2012.'],
    ['q' => 'Berapa lama pelatihan K3 umum?', 'a' => 'Pelatihan Ahli K3 Umum yang diregulasi oleh Kemnaker RI berlangsung selama 12 hari kerja, mencakup teori, praktik, dan ujian.'],
    ['q' => 'Apakah sertifikat K3 bisa dipakai di seluruh Indonesia?', 'a' => 'Ya. Sertifikat dan SK Ahli K3 yang diterbitkan oleh Kemnaker RI maupun sertifikasi BNSP berlaku secara nasional di seluruh wilayah Indonesia.'],
];
?>
<?php
$page_title = 'Keselamatan dan Kesehatan Kerja (K3) — Panduan Lengkap & Program Sertifikasi Yogyakarta';
$meta_desc = 'Panduan lengkap Keselamatan dan Kesehatan Kerja (K3): dasar hukum, program sertifikasi, SMK3, dan pelatihan K3 resmi bersertifikat Kemnaker RI di Yogyakarta.';
require __DIR__ . '/includes/head.php';
?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ProfessionalService",
  "name": "Wahana Totalita Konsultan",
  "telephone": "+6287759151278",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Jl. Wonosari KM 8.5",
    "addressLocality": "Sleman",
    "addressRegion": "DIY",
    "addressCountry": "ID"
  }
}
</script>
<script type="application/ld+json">
<?php
echo json_encode([
    '@context' => 'https://schema.org',
    '@type'    => 'FAQPage',
    'mainEntity' => array_map(fn($f) => [
        '@type' => 'Question', 'name' => $f['q'],
        'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']],
    ], $faqs),
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
?>
</script>
<link rel="stylesheet" href="<?= asset_v('/assets/css/core.min.css') ?>">
<link rel="stylesheet" href="<?= asset_v('/assets/css/page/sector.css') ?>">
<link rel="stylesheet" href="<?= asset_v('/assets/css/page/hub-master.css') ?>">
<style>
.hero h1{font-size:clamp(1.6rem,4.5vw,2.6rem);font-weight:800;line-height:1.2;margin-bottom:14px;letter-spacing:-.02em}
section{padding:48px 0;background:#f5f5f2}
h2.section-title{font-size:1.5rem;font-weight:800;color:#111827;margin-bottom:8px;letter-spacing:-.02em}
.section-subtitle{font-size:14.5px;color:#6b7280;margin-bottom:20px}
.intro-text{font-size:15.5px;color:#374151;line-height:1.85;max-width:800px;margin:0 0 14px}
.pilar-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;margin-top:16px}
@media(max-width:640px){.pilar-grid{grid-template-columns:1fr}}
.pilar-card{background:#fff;border:1.5px solid #e5e7eb;border-radius:12px;padding:18px;text-align:center}
.pilar-card strong{display:block;font-size:14.5px;color:#0A4A2E;margin-bottom:4px}
.pilar-card span{font-size:13px;color:#6b7280}
.law-list{display:flex;flex-direction:column;gap:10px}
.law-item{background:#fff;border:1.5px solid #e5e7eb;border-radius:10px;padding:14px 18px}
.law-item strong{display:block;font-size:14.5px;color:#0A4A2E;margin-bottom:3px}
.law-item span{font-size:13.5px;color:#4b5563}
.sert-table{width:100%;border-collapse:collapse;background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 2px 12px rgba(0,0,0,.05)}
.sert-table th{background:#0A4A2E;color:#fff;padding:12px 16px;text-align:left;font-size:13.5px}
.sert-table td{padding:12px 16px;border-bottom:1px solid #f3f4f6;font-size:14px;color:#374151}
.sert-table tr:last-child td{border-bottom:none}
.elemen-list{list-style:none;counter-reset:elemen}
.elemen-list li{counter-increment:elemen;background:#fff;border:1.5px solid #e5e7eb;border-radius:10px;padding:14px 18px;margin-bottom:8px;font-size:14px;color:#374151;position:relative;padding-left:52px}
.elemen-list li::before{content:counter(elemen);position:absolute;left:14px;top:50%;transform:translateY(-50%);width:26px;height:26px;background:#0A4A2E;color:#fff;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:13px}
.stat-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:1rem;margin-bottom:20px}
@media(max-width:640px){.stat-grid{grid-template-columns:1fr}}
.stat-card{background:#fff;border:1.5px solid #e5e7eb;border-radius:12px;padding:18px;text-align:center}
.stat-card strong{display:block;font-size:1.3rem;color:#0A4A2E}
.stat-card span{font-size:12.5px;color:#6b7280}
.prevent-list{list-style:none}
.prevent-list li{background:#fff;border:1.5px solid #e5e7eb;border-radius:10px;padding:12px 16px;margin-bottom:8px;font-size:14px;color:#374151;display:flex;gap:10px}
.prevent-list li::before{content:'✓';color:#0A4A2E;font-weight:800;flex-shrink:0}
.faq-a{padding:0 20px;max-height:0;overflow:hidden;transition:max-height .3s ease,padding .3s;font-size:14.5px;color:#374151;line-height:1.75}
.final-cta h2{font-size:1.8rem;font-weight:800;margin-bottom:10px}

/* Enhanced Scheme Grid & Modern Cards */
.scheme-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:16px}
.scheme-card{background:#fff;border:1.5px solid #e2e8f0;border-radius:12px;padding:20px;display:flex;flex-direction:column;box-shadow:0 2px 8px rgba(0,0,0,.03);transition:transform .2s ease,box-shadow .2s ease,border-color .2s ease}
.scheme-card:hover{transform:translateY(-3px);border-color:#0A4A2E;box-shadow:0 10px 24px rgba(10,74,46,.1)}
.scheme-cert{display:inline-flex;align-items:center;gap:4px;background:#e8f4ee;color:#0A4A2E;font-size:11px;font-weight:700;padding:4px 10px;border-radius:6px;text-transform:uppercase;letter-spacing:.04em;margin-bottom:10px;width:fit-content}
.scheme-card h3{font-size:1.05rem;font-weight:800;margin:0 0 8px;line-height:1.4}
.scheme-card h3 a{color:#0f172a;text-decoration:none;transition:color .15s ease}
.scheme-card h3 a:hover{color:#0A4A2E}
.scheme-card p{font-size:13px;color:#64748b;line-height:1.6;margin:0 0 14px;flex-grow:1}
.scheme-link{margin-top:auto;padding-top:12px;border-top:1px solid #f1f5f9;color:#0A4A2E;font-weight:700;font-size:13px;text-decoration:none;display:inline-flex;align-items:center;justify-content:space-between;transition:color .15s ease}
.scheme-link:hover{color:#C6621C}
</style>
<style id="wt-hero-height-fix-2026-07">
/* wt-hero-height-fix-2026-07: this page's own .hero is a small custom hero, not the
   homepage full-screen slideshow hero — cancel the global 100vh /
   flex-centering from style.css so it doesn't leak in here. */
.hero{min-height:auto!important;display:block!important}
</style>
<?php require __DIR__ . '/includes/navbar.php'; ?>
<section class="hero">
  <div class="container inner">
    <div class="hero-badge">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
      Panduan Lengkap
    </div>
    <h1>Keselamatan dan Kesehatan Kerja (K3) di Indonesia: Panduan Lengkap</h1>
    <p class="hero-sub">Dasar hukum, program sertifikasi, penerapan SMK3, dan pelatihan K3 resmi bersertifikat Kemnaker RI di Yogyakarta.</p>
    <div>
      <a href="<?=$wa_url?>" class="btn-wa" target="_blank" rel="noopener">
        <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
        Konsultasi Program K3
      </a>
    </div>
  </div>
</section>

<div class="hub-wrapper">
  <div class="container hub-grid-layout">
    <main class="hub-main">


<!-- APA ITU K3 -->
<section class="white">
<div class="container">
  <h2 class="section-title">Apa itu K3?</h2>
  <p class="intro-text">Keselamatan dan Kesehatan Kerja (K3) adalah upaya sistematis untuk melindungi pekerja dari bahaya dan risiko yang dapat timbul dari aktivitas kerja, sesuai definisi dalam Undang-Undang No. 1 Tahun 1970 tentang Keselamatan Kerja. Tujuan utama K3 adalah mencegah dan mengurangi kecelakaan kerja, penyakit akibat kerja, serta kerugian yang timbul akibat proses produksi, sambil menjamin efisiensi dan produktivitas kerja yang optimal.</p>
  <p class="intro-text">Penerapan K3 di Indonesia bertumpu pada tiga pilar utama yang saling melengkapi.</p>
  <div class="pilar-grid">
    <div class="pilar-card"><strong>Keselamatan</strong><span>Pencegahan cedera dan kecelakaan kerja</span></div>
    <div class="pilar-card"><strong>Kesehatan</strong><span>Perlindungan dari penyakit akibat kerja</span></div>
    <div class="pilar-card"><strong>Lingkungan</strong><span>Pengelolaan dampak kerja terhadap lingkungan</span></div>
  </div>
</div>
</section>

<!-- DASAR HUKUM -->
<section>
<div class="container">
  <h2 class="section-title">Dasar Hukum K3 di Indonesia</h2>
  <p class="section-subtitle">Kerangka regulasi yang menjadi fondasi penerapan K3 di tempat kerja</p>
  <div class="law-list">
    <?php foreach ($dasarHukum as $l): ?>
    <div class="law-item"><strong><?= htmlspecialchars($l['title']) ?></strong><span><?= htmlspecialchars($l['desc']) ?></span></div>
    <?php endforeach; ?>
  </div>
</div>
</section>

<!-- SERTIFIKASI YANG DIAKUI -->
<section class="white">
<div class="container">
  <h2 class="section-title">Sertifikasi K3 yang Diakui di Indonesia</h2>
  <p class="section-subtitle">Dua lembaga utama penyelenggara sertifikasi kompetensi K3 nasional</p>
  <table class="sert-table">
    <thead><tr><th>Jenis Sertifikasi</th><th>Lembaga</th><th>Berlaku</th></tr></thead>
    <tbody>
      <?php foreach ($sertifikasi as $row): ?>
      <tr><td><?= htmlspecialchars($row['jenis']) ?></td><td><?= htmlspecialchars($row['lembaga']) ?></td><td><?= htmlspecialchars($row['berlaku']) ?></td></tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <p class="intro-text" style="margin-top:16px">Kemnaker RI menerbitkan Surat Keputusan resmi untuk skema Ahli K3 Umum dan Ahli K3 Spesialis, sementara BNSP menyelenggarakan uji kompetensi berbasis skema profesi (SKKNI) untuk berbagai bidang K3 spesifik. Keduanya diakui dan dihargai secara luas di dunia industri Indonesia.</p>
</div>
</section>

<!-- PROGRAM PELATIHAN -->
<section style="background:#f8fafc;padding:56px 0;">
<div class="container">
  <div style="text-align:center;max-width:760px;margin:0 auto 36px;">
    <span style="display:inline-flex;align-items:center;gap:6px;font-size:12px;font-weight:700;color:#C6621C;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:6px;">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
      Program Pelatihan Unggulan
    </span>
    <h2 class="section-title" style="font-size:1.8rem;font-weight:800;color:#111827;margin-bottom:8px;">Program Pelatihan K3 &amp; Sertifikasi Resmi</h2>
    <p class="section-subtitle" style="font-size:15px;color:#64748b;margin:0;">Pilih skema kompetensi KEMNAKER RI &amp; BNSP sesuai kebutuhan lisensi dan tanggung jawab kerja Anda.</p>
  </div>

  <div class="hub-program-cards">
    <?php foreach ($skemas as $sk): 
      $prog_url = '/pelatihan/' . trim($sk['slug'], '/') . '/';
      $prog_wa_msg = 'Halo Wahana Totalita, saya ingin informasi biaya dan jadwal terdekat pelatihan ' . $sk['name'];
      $prog_wa_url = "https://wa.me/{$wa_number}?text=" . rawurlencode($prog_wa_msg);
      $prog_img = training_img_url('', 'k3', $sk['slug']);
    ?>
    <article class="hub-prog-card">
      <div class="hub-prog-card-media">
        <img src="<?= htmlspecialchars($prog_img) ?>" alt="<?= htmlspecialchars($sk['name']) ?>" loading="lazy" width="400" height="180">
        <div class="hub-prog-media-overlay">
          <span class="hub-prog-pill-cert">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            <?= htmlspecialchars($sk['cert']) ?>
          </span>
          <?php if (!empty($sk['duration'])): ?>
          <span class="hub-prog-pill-dur"><?= htmlspecialchars($sk['duration']) ?></span>
          <?php endif; ?>
        </div>
      </div>

      <div class="hub-prog-card-content">
        <div style="font-size:11px;font-weight:700;color:var(--hub-orange, #C6621C);text-transform:uppercase;letter-spacing:0.04em;margin-bottom:6px;">
          <?= htmlspecialchars($sk['mode'] ?? 'Sertifikasi Resmi') ?>
        </div>

        <h3 class="hub-prog-title">
          <a href="<?= htmlspecialchars($prog_url) ?>"><?= htmlspecialchars($sk['name']) ?></a>
        </h3>

        <p class="hub-prog-desc"><?= htmlspecialchars($sk['desc']) ?></p>

        <ul class="hub-prog-checklist">
          <li>
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
            <span>Lisensi &amp; Sertifikat Resmi <?= htmlspecialchars($sk['cert']) ?></span>
          </li>
          <?php if (!empty($sk['target'])): ?>
          <li>
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="7" r="4"/><path d="M5.5 21a6.5 6.5 0 0 1 13 0"/></svg>
            <span>Sasaran: <?= htmlspecialchars($sk['target']) ?></span>
          </li>
          <?php endif; ?>
          <li>
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/></svg>
            <span>Modul Pelatihan, Ujian Kompetensi &amp; Konsultasi</span>
          </li>
        </ul>

        <div class="hub-prog-card-footer">
          <a href="<?= htmlspecialchars($prog_url) ?>" class="hub-btn-prog-primary">
            <span>Silabus &amp; Jadwal</span>
            <span aria-hidden="true">&rarr;</span>
          </a>
          <a href="<?= htmlspecialchars($prog_wa_url) ?>" class="hub-btn-prog-wa-icon" target="_blank" rel="noopener" title="Konsultasi WhatsApp">
            <svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
            <span>Chat WA</span>
          </a>
        </div>
      </div>
    </article>
    <?php endforeach; ?>
  </div>
</div>
</section>

<!-- DIREKTORI 23 BIDANG KEAHLIAN K3 -->
<section class="white" id="direktori-bidang" style="border-top:1px solid #e5e7eb;padding:52px 0;">
<div class="container">
  <div class="section-header" style="text-align:center;max-width:760px;margin:0 auto 36px;">
    <p class="section-eyebrow" style="color:#C6621C;font-weight:700;text-transform:uppercase;font-size:12px;letter-spacing:0.05em;margin-bottom:6px;">Pilar Kompetensi Nasional</p>
    <h2 class="section-title" style="font-size:1.8rem;font-weight:800;color:#111827;margin-bottom:8px;">Direktori 23 Bidang Keahlian K3 &amp; Sertifikasi Industri</h2>
    <p class="section-subtitle" style="font-size:15px;color:#6b7280;line-height:1.6;">Pusat pelatihan dan sertifikasi resmi KEMNAKER RI &amp; BNSP yang terbagi dalam 4 sektor industri utama di Indonesia.</p>
  </div>

  <div class="hub-directory-container" style="display:flex;flex-direction:column;gap:36px;">

    <!-- Sektor 1: Konstruksi & Kelistrikan -->
    <div class="hub-sector-block">
      <div style="display:flex;align-items:center;gap:10px;margin-bottom:16px;padding-bottom:10px;border-bottom:2px solid #E8F4EE;">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#0A4A2E" stroke-width="2.5"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
        <h3 style="font-size:1.25rem;font-weight:800;color:#0A4A2E;margin:0;">Sektor Konstruksi, Kelistrikan &amp; Mekanikal</h3>
      </div>
      <div class="scheme-grid">
        <div class="scheme-card">
          <span class="scheme-cert">Kemnaker RI</span>
          <h3><a href="/k3-listrik/">K3 Listrik (Teknisi &amp; Ahli)</a></h3>
          <p style="font-size:13px;color:#6b7280;margin:6px 0 10px;line-height:1.5;">Kepatuhan Permenaker 12/2015 &amp; PUIL. Lisensi operasional teknisi dan pengawas instalasi listrik pabrik &amp; gedung.</p>
          <a href="/k3-listrik/" class="scheme-link">Buka Halaman Hub &rarr;</a>
        </div>
        <div class="scheme-card">
          <span class="scheme-cert">Kemnaker &amp; BNSP</span>
          <h3><a href="/k3-konstruksi/">K3 Konstruksi</a></h3>
          <p style="font-size:13px;color:#6b7280;margin:6px 0 10px;line-height:1.5;">Pengawasan keselamatan proyek sipil, struktur gedung tinggi, dan kepatuhan standar Permenaker 01/1980.</p>
          <a href="/k3-konstruksi/" class="scheme-link">Buka Halaman Hub &rarr;</a>
        </div>
        <div class="scheme-card">
          <span class="scheme-cert">Kemnaker RI</span>
          <h3><a href="/k3-ketinggian/">K3 Bekerja di Ketinggian (TKBT)</a></h3>
          <p style="font-size:13px;color:#6b7280;margin:6px 0 10px;line-height:1.5;">Sertifikasi Tenaga Kerja Bangunan Tinggi (TKBT I &amp; II) dan Rope Access (TKPK) Permenaker 09/2016.</p>
          <a href="/k3-ketinggian/" class="scheme-link">Buka Halaman Hub &rarr;</a>
        </div>
        <div class="scheme-card">
          <span class="scheme-cert">Kemnaker RI</span>
          <h3><a href="/k3-pesawat-angkat-angkut/">K3 Pesawat Angkat &amp; Angkut</a></h3>
          <p style="font-size:13px;color:#6b7280;margin:6px 0 10px;line-height:1.5;">Lisensi resmi operator forklift, mobile crane, tower crane, overhead crane, dan rigger industri.</p>
          <a href="/k3-pesawat-angkat-angkut/" class="scheme-link">Buka Halaman Hub &rarr;</a>
        </div>
        <div class="scheme-card">
          <span class="scheme-cert">Kemnaker RI</span>
          <h3><a href="/k3-pesawat-uap/">K3 Pesawat Uap &amp; Bejana Tekan</a></h3>
          <p style="font-size:13px;color:#6b7280;margin:6px 0 10px;line-height:1.5;">Sertifikasi operator boiler/ketel uap Kelas I &amp; II dan teknisi bejana tekan industri.</p>
          <a href="/k3-pesawat-uap/" class="scheme-link">Buka Halaman Hub &rarr;</a>
        </div>
      </div>
    </div>

    <!-- Sektor 2: Industri & Manufaktur -->
    <div class="hub-sector-block">
      <div style="display:flex;align-items:center;gap:10px;margin-bottom:16px;padding-bottom:10px;border-bottom:2px solid #E8F4EE;">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#0A4A2E" stroke-width="2.5"><path d="M2 20a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8l-7 5V8l-7 5V4a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"/></svg>
        <h3 style="font-size:1.25rem;font-weight:800;color:#0A4A2E;margin:0;">Sektor Pabrik, Manufaktur &amp; Kimia</h3>
      </div>
      <div class="scheme-grid">
        <div class="scheme-card">
          <span class="scheme-cert">Kemnaker RI</span>
          <h3><a href="/k3-kimia/">K3 Kimia (Petugas &amp; Ahli)</a></h3>
          <p style="font-size:13px;color:#6b7280;margin:6px 0 10px;line-height:1.5;">Pengendalian bahan kimia berbahaya di tempat kerja sesuai Kepmenaker 187/1999 dan penanganan B3.</p>
          <a href="/k3-kimia/" class="scheme-link">Buka Halaman Hub &rarr;</a>
        </div>
        <div class="scheme-card">
          <span class="scheme-cert">BNSP &amp; Kemnaker</span>
          <h3><a href="/higiene-industri/">Higiene Industri (HIMU &amp; HIMA)</a></h3>
          <p style="font-size:13px;color:#6b7280;margin:6px 0 10px;line-height:1.5;">Pengukuran faktor fisik, kimia, dan biologi di lingkungan kerja sesuai Permenaker 05/2018.</p>
          <a href="/higiene-industri/" class="scheme-link">Buka Halaman Hub &rarr;</a>
        </div>
        <div class="scheme-card">
          <span class="scheme-cert">Kemnaker RI</span>
          <h3><a href="/penanggulangan-kebakaran/">Penanggulangan Kebakaran</a></h3>
          <p style="font-size:13px;color:#6b7280;margin:6px 0 10px;line-height:1.5;">Petugas peran kebakaran Kelas D, regu C, koordinator B, hingga Ahli K3 Kebakaran Kelas A.</p>
          <a href="/penanggulangan-kebakaran/" class="scheme-link">Buka Halaman Hub &rarr;</a>
        </div>
        <div class="scheme-card">
          <span class="scheme-cert">Kemnaker &amp; BNSP</span>
          <h3><a href="/p3k/">P3K di Tempat Kerja</a></h3>
          <p style="font-size:13px;color:#6b7280;margin:6px 0 10px;line-height:1.5;">Pelatihan pertolongan pertama pada kecelakaan kerja bersertifikat resmi Permenaker 15/2008.</p>
          <a href="/p3k/" class="scheme-link">Buka Halaman Hub &rarr;</a>
        </div>
        <div class="scheme-card">
          <span class="scheme-cert">BNSP</span>
          <h3><a href="/k3-manufaktur/">K3 Manufaktur &amp; Pabrik</a></h3>
          <p style="font-size:13px;color:#6b7280;margin:6px 0 10px;line-height:1.5;">Standardisasi proteksi mesin industri, ergonomi jalur produksi, dan manajemen keselamatan pabrik.</p>
          <a href="/k3-manufaktur/" class="scheme-link">Buka Halaman Hub &rarr;</a>
        </div>
        <div class="scheme-card">
          <span class="scheme-cert">Kemnaker &amp; BNSP</span>
          <h3><a href="/juru-las/">Juru Las (Welder 1G–6G)</a></h3>
          <p style="font-size:13px;color:#6b7280;margin:6px 0 10px;line-height:1.5;">Sertifikasi kualifikasi juru las plat dan pipa SMAW, GTAW, GMAW sesuai standar Permenaker 02/1982.</p>
          <a href="/juru-las/" class="scheme-link">Buka Halaman Hub &rarr;</a>
        </div>
      </div>
    </div>

    <!-- Sektor 3: Migas, Tambang & Energi -->
    <div class="hub-sector-block">
      <div style="display:flex;align-items:center;gap:10px;margin-bottom:16px;padding-bottom:10px;border-bottom:2px solid #E8F4EE;">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#0A4A2E" stroke-width="2.5"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
        <h3 style="font-size:1.25rem;font-weight:800;color:#0A4A2E;margin:0;">Sektor Minyak &amp; Gas, Tambang, dan Alat Berat</h3>
      </div>
      <div class="scheme-grid">
        <div class="scheme-card">
          <span class="scheme-cert">BNSP</span>
          <h3><a href="/k3-migas/">K3 Industri Migas</a></h3>
          <p style="font-size:13px;color:#6b7280;margin:6px 0 10px;line-height:1.5;">Pengawas dan operator keselamatan migas hulu/hilir bersertifikasi BNSP berbasis SKKNI.</p>
          <a href="/k3-migas/" class="scheme-link">Buka Halaman Hub &rarr;</a>
        </div>
        <div class="scheme-card">
          <span class="scheme-cert">BNSP &amp; ESDM</span>
          <h3><a href="/k3-pertambangan/">K3 Pertambangan (POP &amp; POM)</a></h3>
          <p style="font-size:13px;color:#6b7280;margin:6px 0 10px;line-height:1.5;">Pengawas Operasional Pratama (POP) dan Madya (POM) mineral &amp; batubara.</p>
          <a href="/k3-pertambangan/" class="scheme-link">Buka Halaman Hub &rarr;</a>
        </div>
        <div class="scheme-card">
          <span class="scheme-cert">Kemnaker RI</span>
          <h3><a href="/operator-alat-berat/">Operator Alat Berat</a></h3>
          <p style="font-size:13px;color:#6b7280;margin:6px 0 10px;line-height:1.5;">Sertifikasi operator excavator, wheel loader, bulldozer, dan dump truck tambang.</p>
          <a href="/operator-alat-berat/" class="scheme-link">Buka Halaman Hub &rarr;</a>
        </div>
      </div>
    </div>

    <!-- Sektor 4: Fasilitas Publik & Sektor Spesifik -->
    <div class="hub-sector-block">
      <div style="display:flex;align-items:center;gap:10px;margin-bottom:16px;padding-bottom:10px;border-bottom:2px solid #E8F4EE;">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#0A4A2E" stroke-width="2.5"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
        <h3 style="font-size:1.25rem;font-weight:800;color:#0A4A2E;margin:0;">Sektor Fasilitas Publik, Kesehatan &amp; Sistem Manajemen</h3>
      </div>
      <div class="scheme-grid">
        <div class="scheme-card">
          <span class="scheme-cert">Kemnaker &amp; BNSP</span>
          <h3><a href="/k3-rumah-sakit/">K3 Rumah Sakit &amp; Faskes</a></h3>
          <p style="font-size:13px;color:#6b7280;margin:6px 0 10px;line-height:1.5;">Standar keselamatan fasilitas kesehatan, pengelolaan limbah B3 medis, dan akreditasi RS.</p>
          <a href="/k3-rumah-sakit/" class="scheme-link">Buka Halaman Hub &rarr;</a>
        </div>
        <div class="scheme-card">
          <span class="scheme-cert">BNSP</span>
          <h3><a href="/k3-laboratorium/">K3 Laboratorium</a></h3>
          <p style="font-size:13px;color:#6b7280;margin:6px 0 10px;line-height:1.5;">Protokol biosafety, chemical safety, dan penanganan reagen berbahaya di lab uji &amp; riset.</p>
          <a href="/k3-laboratorium/" class="scheme-link">Buka Halaman Hub &rarr;</a>
        </div>
        <div class="scheme-card">
          <span class="scheme-cert">Kemnaker RI</span>
          <h3><a href="/k3-perkantoran/">K3 Perkantoran &amp; Gedung</a></h3>
          <p style="font-size:13px;color:#6b7280;margin:6px 0 10px;line-height:1.5;">Kepatuhan Permenaker 48/2016 untuk ergonomi kerja, sirkulasi udara, dan keselamatan gedung tinggi.</p>
          <a href="/k3-perkantoran/" class="scheme-link">Buka Halaman Hub &rarr;</a>
        </div>
        <div class="scheme-card">
          <span class="scheme-cert">BNSP</span>
          <h3><a href="/k3-transportasi/">K3 Transportasi &amp; Logistik</a></h3>
          <p style="font-size:13px;color:#6b7280;margin:6px 0 10px;line-height:1.5;">Defensive driving, keselamatan armada darat, dan kepatuhan distribusi logistik B3.</p>
          <a href="/k3-transportasi/" class="scheme-link">Buka Halaman Hub &rarr;</a>
        </div>
        <div class="scheme-card">
          <span class="scheme-cert">BNSP</span>
          <h3><a href="/k3-pangan/">K3 Industri Pangan &amp; HACCP</a></h3>
          <p style="font-size:13px;color:#6b7280;margin:6px 0 10px;line-height:1.5;">Sistem sanitasi higienis, Good Manufacturing Practice (GMP), dan analisis bahaya HACCP.</p>
          <a href="/k3-pangan/" class="scheme-link">Buka Halaman Hub &rarr;</a>
        </div>
        <div class="scheme-card">
          <span class="scheme-cert">BNSP</span>
          <h3><a href="/k3-psikososial/">K3 Psikososial &amp; Ergonomi</a></h3>
          <p style="font-size:13px;color:#6b7280;margin:6px 0 10px;line-height:1.5;">Manajemen stres kerja, pencegahan kelelahan (fatigue), dan ergonomi fisik tempat kerja.</p>
          <a href="/k3-psikososial/" class="scheme-link">Buka Halaman Hub &rarr;</a>
        </div>
        <div class="scheme-card">
          <span class="scheme-cert">ISO Internasional</span>
          <h3><a href="/pelatihan-iso/">Pelatihan ISO &amp; QHSE</a></h3>
          <p style="font-size:13px;color:#6b7280;margin:6px 0 10px;line-height:1.5;">Lead Auditor &amp; Internal Auditor ISO 45001 (K3), ISO 9001 (Mutu), ISO 14001 (Lingkungan).</p>
          <a href="/pelatihan-iso/" class="scheme-link">Buka Halaman Hub &rarr;</a>
        </div>
        <div class="scheme-card">
          <span class="scheme-cert">Kemnaker RI</span>
          <h3><a href="/smk3/">Penerapan &amp; Audit SMK3 PP 50</a></h3>
          <p style="font-size:13px;color:#6b7280;margin:6px 0 10px;line-height:1.5;">Pelatihan Auditor Internal dan persiapan sertifikasi bendera emas SMK3 PP No. 50 Tahun 2012.</p>
          <a href="/smk3/" class="scheme-link">Buka Halaman Hub &rarr;</a>
        </div>
      </div>
    </div>

  </div>
</div>
</section>

<!-- SMK3 -->
<section class="white">
<div class="container">
  <h2 class="section-title">SMK3 — Sistem Manajemen Keselamatan dan Kesehatan Kerja</h2>
  <p class="intro-text">SMK3 diatur dalam PP No. 50 Tahun 2012 tentang Penerapan Sistem Manajemen Keselamatan dan Kesehatan Kerja, dan wajib diterapkan oleh perusahaan dengan jumlah karyawan 100 orang atau lebih, atau perusahaan dengan tingkat risiko bahaya tinggi meskipun jumlah karyawannya lebih sedikit. SMK3 terdiri dari lima elemen utama yang membentuk siklus manajemen keselamatan berkelanjutan:</p>
  <ol class="elemen-list">
    <?php foreach ($elemenSmk3 as $e): ?>
    <li><?= htmlspecialchars($e) ?></li>
    <?php endforeach; ?>
  </ol>
</div>
</section>

<!-- KECELAKAAN KERJA -->
<section>
<div class="container">
  <h2 class="section-title">Kecelakaan Kerja — Angka &amp; Pencegahan</h2>
  <p class="intro-text">Menurut International Labour Organization (ILO), lebih dari 2 juta pekerja meninggal setiap tahun akibat kecelakaan kerja dan penyakit akibat kerja di seluruh dunia. Di Indonesia, data BPJS Ketenagakerjaan mencatat ratusan ribu klaim kecelakaan kerja setiap tahunnya, menunjukkan bahwa penerapan K3 yang konsisten masih menjadi tantangan besar bagi banyak perusahaan.</p>
  <div class="stat-grid">
    <div class="stat-card"><strong>2 Juta+</strong><span>Kematian akibat kerja per tahun (global, data ILO)</span></div>
    <div class="stat-card"><strong>Ratusan Ribu</strong><span>Klaim kecelakaan kerja per tahun (data BPJS Ketenagakerjaan)</span></div>
  </div>
  <p class="section-subtitle" style="margin-bottom:12px">5 langkah pencegahan kecelakaan kerja yang efektif:</p>
  <ul class="prevent-list">
    <?php foreach ($pencegahan as $p): ?>
    <li><?= htmlspecialchars($p) ?></li>
    <?php endforeach; ?>
  </ul>
</div>
</section>

<!-- FAQ -->
<section class="white">
<div class="container-sm">
  <h2 class="section-title" style="text-align:center">Pertanyaan yang Sering Ditanyakan</h2>
  <div class="faq-list" style="margin-top:20px">
    <?php foreach ($faqs as $f): ?>
    <div class="faq-item">
      <button class="faq-q" aria-expanded="false" onclick="toggleFaq(this)">
        <?= htmlspecialchars($f['q']) ?>
        <svg class="faq-arrow" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
      </button>
      <div class="faq-a"><p><?= htmlspecialchars($f['a']) ?></p></div>
    </div>
    <?php endforeach; ?>
  </div>
</div>
</section>


    </main>

    <!-- RIGHT COLUMN: DESKTOP STICKY SIDEBAR -->
    <aside class="hub-sticky-sidebar">
      <div class="hub-sidebar-card">
        <div class="hub-sb-status">
          <span class="hub-sb-status-dot"></span>
          <span>Konsultan Online &bull; Respon Cepat</span>
        </div>

        <h3 class="hub-sb-title">Konsultasi Program K3</h3>
        <p class="hub-sb-sub">Dapatkan informasi jadwal terdekat, rincian biaya, dan silabus lengkap langsung dari konsultan kami.</p>

        <a href="<?= $wa_url ?>" class="hub-sb-btn-wa" target="_blank" rel="noopener">
          <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
          <span>Chat WhatsApp Konsultan</span>
        </a>

        <a href="<?= wa_url('Halo Wahana, mohon kirimkan PDF silabus dan kalender jadwal pelatihan K3', $wa_number) ?>" class="hub-sb-btn-secondary" target="_blank" rel="noopener">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
          <span>Unduh Silabus via WA</span>
        </a>

        <div class="hub-sb-guarantees">
          <div class="hub-sb-guarantee-item">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
            <span>Sertifikat Resmi Kemnaker RI &amp; BNSP</span>
          </div>
          <div class="hub-sb-guarantee-item">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
            <span>Instruktur Senior Berlisensi Resmi</span>
          </div>
          <div class="hub-sb-guarantee-item">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
            <span>Layanan In-House Seluruh Indonesia</span>
          </div>
        </div>
      </div>
    </aside>
  </div>
</div>
<section class="final-cta">
  <div class="container-sm">
    <h2>Butuh Program K3 untuk Perusahaan Anda?</h2>
    <p>Konsultasikan kebutuhan pelatihan dan sertifikasi K3 perusahaan Anda dengan tim kami.</p>
    <a href="<?=$wa_url?>" class="btn-wa" target="_blank" rel="noopener">
      <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
      Konsultasi Program K3
    </a>
  </div>
</section>

<?php
require_once __DIR__ . '/includes/hub-category-map.php';
$hub_article_cats = $HUB_CATEGORY_MAP['k3']['article_cats'] ?? [];
include __DIR__ . '/includes/hub-artikel-terkait.php';
?>
<?php require __DIR__ . '/includes/footer.php'; ?>
<script>
function toggleFaq(btn) {
  var expanded = btn.getAttribute('aria-expanded') === 'true';
  btn.setAttribute('aria-expanded', !expanded);
  var answer = btn.nextElementSibling;
  answer.classList.toggle('open', !expanded);
}
</script>
<!-- MOBILE FLOATING BAR -->
<div class="hub-mobile-bar">
  <div class="hub-mb-info">
    <span class="hub-mb-title">Konsultasi Program K3</span>
    <span class="hub-mb-sub">Respon Cepat via WhatsApp</span>
  </div>
  <a href="<?= $wa_url ?>" class="hub-mb-btn" target="_blank" rel="noopener">
    <svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
    <span>Chat WA</span>
  </a>
</div>

</body>
</html>
