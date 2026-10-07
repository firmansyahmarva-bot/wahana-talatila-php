<?php
/**
 * riksa-uji/detail.php — Detailed Service Page for Individual Machinery & Equipment Inspection
 * URL: /riksa-uji/{slug}/
 */
require_once dirname(__DIR__) . '/config.php';
require_once dirname(__DIR__) . '/includes/riksa-uji-data.php';

$slug = trim($_GET['slug'] ?? '');
if (!$slug) {
    header('Location: ' . SITE_URL . '/riksa-uji/', true, 301);
    exit;
}

$item = get_riksa_uji_item($slug);
if (!$item) {
    http_response_code(404);
    include dirname(__DIR__) . '/404.php';
    exit;
}

$s = get_all_settings();
$wa_number = preg_replace('/\D/', '', get_setting('wa_number', '6287759151278'));

$canonical = SITE_URL . '/riksa-uji/' . $item['slug'] . '/';

$meta_title = $item['meta_title'] . ' | Wahana Totalita';
$meta_desc  = $item['meta_desc'];

// WhatsApp Lead Generation Message
$wa_lead_msg = "Halo Wahana Totalita, kami ingin konsultasi dan meminta penawaran resmi Jasa Riksa Uji Kemnaker untuk objek: " . $item['judul'] . " di perusahaan kami.";
$wa_lead_url = "https://wa.me/{$wa_number}?text=" . rawurlencode($wa_lead_msg);

// Related services
$related_items = get_related_riksa_uji($item['slug'], $item['kategori'], 3);

// Structured Data
$schema_faqs = [];
foreach ($item['faqs'] as $faq) {
    $schema_faqs[] = [
        '@type' => 'Question',
        'name' => $faq['q'],
        'acceptedAnswer' => [
            '@type' => 'Answer',
            'text' => $faq['a']
        ]
    ];
}

$schema_graph = [
    [
        '@type' => 'BreadcrumbList',
        '@id'   => $canonical . '#breadcrumb',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => SITE_URL . '/'],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Jasa Riksa Uji K3', 'item' => SITE_URL . '/riksa-uji/'],
            ['@type' => 'ListItem', 'position' => 3, 'name' => $item['judul'], 'item' => $canonical]
        ]
    ],
    [
        '@type'        => 'Service',
        '@id'          => $canonical . '#service',
        'name'         => $item['judul'],
        'provider'     => [
            '@type' => 'Organization',
            'name'  => 'PT Wahana Totalita Konsultan',
            'url'   => SITE_URL
        ],
        'serviceType'  => 'Statutory Technical Safety Inspection & Testing',
        'description'  => $meta_desc,
        'areaServed'   => [
            ['@type' => 'Country', 'name' => 'Indonesia']
        ]
    ],
    [
        '@type'      => 'FAQPage',
        '@id'        => $canonical . '#faq',
        'mainEntity' => $schema_faqs
    ]
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($meta_title) ?></title>
<meta name="description" content="<?= htmlspecialchars($meta_desc) ?>">
<link rel="canonical" href="<?= htmlspecialchars($canonical) ?>">

<meta property="og:type" content="article">
<meta property="og:site_name" content="Wahana Totalita Konsultan">
<meta property="og:title" content="<?= htmlspecialchars($meta_title) ?>">
<meta property="og:description" content="<?= htmlspecialchars($meta_desc) ?>">
<meta property="og:url" content="<?= htmlspecialchars($canonical) ?>">
<meta property="og:image" content="<?= SITE_URL ?>/assets/img/og-cover.jpg">

<script type="application/ld+json">
<?= json_encode(['@context' => 'https://schema.org', '@graph' => $schema_graph], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) ?>
</script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="<?= theme_font_url($s) ?>" media="print" onload="this.media='all'">
<noscript><link rel="stylesheet" href="<?= theme_font_url($s) ?>"></noscript>
<style><?php
$_core_css_file = dirname(__DIR__) . '/assets/css/core.min.css';
if (is_file($_core_css_file)) {
    readfile($_core_css_file);
} else {
    readfile(dirname(__DIR__) . '/assets/css/tokens.css');
    readfile(dirname(__DIR__) . '/assets/css/core.css');
}
?></style>
<link rel="stylesheet" href="<?= asset_v('/assets/css/components.min.css') ?>" media="print" onload="this.media='all'">
<noscript><link rel="stylesheet" href="<?= asset_v('/assets/css/components.min.css') ?>"></noscript>
<?= theme_css_vars($s) ?>

<style>
/* Detail Page Specific Styling */
.rud-hero {
  background: linear-gradient(135deg, #07192f 0%, #0d2b52 60%, #0f1a30 100%);
  color: #fff;
  padding: 48px 0 42px;
  border-bottom: 4px solid #E8611A;
}
.rud-breadcrumbs {
  font-size: 13px;
  color: #94a3b8;
  margin-bottom: 16px;
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  align-items: center;
}
.rud-breadcrumbs a {
  color: #cbd5e1;
  text-decoration: none;
}
.rud-breadcrumbs a:hover {
  color: #fdba74;
}
.rud-hero h1 {
  font-size: clamp(24px, 3.4vw, 38px);
  font-weight: 800;
  line-height: 1.3;
  margin-bottom: 14px;
  color: #ffffff;
}
.rud-hero p.lead {
  font-size: clamp(15px, 1.8vw, 17px);
  color: #cbd5e1;
  max-width: 800px;
  line-height: 1.6;
  margin-bottom: 24px;
}
.rud-quick-specs {
  display: flex;
  flex-wrap: wrap;
  gap: 16px;
  margin-top: 24px;
  padding-top: 20px;
  border-top: 1px solid rgba(255,255,255,0.12);
  font-size: 13.5px;
}
.rud-spec-item {
  background: rgba(255,255,255,0.06);
  border: 1px solid rgba(255,255,255,0.15);
  border-radius: 8px;
  padding: 10px 16px;
}
.rud-spec-item strong {
  color: #fdba74;
}

/* Content Layout */
.rud-body-grid {
  display: grid;
  grid-template-columns: 1fr 340px;
  gap: 36px;
  padding: 48px 0 60px;
}
@media (max-width: 900px) {
  .rud-body-grid {
    grid-template-columns: 1fr;
  }
}
.rud-content h2 {
  font-size: 24px;
  color: #0f172a;
  font-weight: 800;
  margin: 36px 0 16px;
  border-bottom: 2px solid #f1f5f9;
  padding-bottom: 10px;
}
.rud-content h2:first-of-type {
  margin-top: 0;
}
.rud-content h3 {
  font-size: 19px;
  color: #1e293b;
  font-weight: 700;
  margin: 24px 0 12px;
}
.rud-content p, .rud-content li {
  font-size: 15px;
  color: #334155;
  line-height: 1.7;
}
.rud-step-list {
  padding-left: 20px;
  margin: 16px 0 24px;
}
.rud-step-list li {
  margin-bottom: 12px;
}
.rud-step-list strong {
  color: #0f172a;
}
.rud-callout-warning {
  background: #fff7ed;
  border-left: 4px solid #ea580c;
  padding: 16px 20px;
  border-radius: 0 10px 10px 0;
  margin: 24px 0;
  font-size: 14.5px;
  color: #7c2d12;
}
.rud-callout-warning strong {
  display: block;
  font-size: 15px;
  margin-bottom: 6px;
  color: #9a3412;
}

/* Sidebar Box */
.rud-sidebar-card {
  background: #fff;
  border: 1px solid #e2e8f0;
  border-radius: 14px;
  padding: 24px;
  position: sticky;
  top: 90px;
  box-shadow: 0 4px 16px rgba(0,0,0,0.04);
}
.rud-sidebar-card h3 {
  font-size: 18px;
  color: #0f172a;
  font-weight: 800;
  margin: 0 0 12px;
}
.rud-sidebar-list {
  list-style: none;
  padding: 0;
  margin: 16px 0 24px;
  font-size: 13.5px;
}
.rud-sidebar-list li {
  padding: 8px 0;
  border-bottom: 1px solid #f1f5f9;
  display: flex;
  align-items: center;
  gap: 8px;
  color: #475569;
}
.rud-sidebar-list li svg {
  width: 16px;
  height: 16px;
  color: #16a34a;
  flex-shrink: 0;
}
.rud-btn-wa-full {
  display: block;
  text-align: center;
  background: #25D366;
  color: #fff;
  font-weight: 700;
  font-size: 15px;
  padding: 13px 20px;
  border-radius: 10px;
  text-decoration: none;
  transition: background .2s ease;
}
.rud-btn-wa-full:hover {
  background: #20ba5a;
  color: #fff;
}
.rud-cross-promo {
  margin-top: 24px;
  background: #f8fafc;
  border: 1px dashed #cbd5e1;
  border-radius: 10px;
  padding: 16px;
}
.rud-cross-promo h4 {
  font-size: 14px;
  color: #0f172a;
  font-weight: 700;
  margin: 0 0 6px;
}
.rud-cross-promo p {
  font-size: 12.5px;
  color: #64748b;
  margin: 0 0 10px;
  line-height: 1.45;
}
.rud-cross-promo a {
  display: inline-block;
  font-size: 13px;
  font-weight: 700;
  color: #c2410c;
  text-decoration: none;
}
.rud-cross-promo a:hover {
  text-decoration: underline;
}
</style>
</head>
<body>

<?php require dirname(__DIR__) . '/includes/navbar.php'; ?>

<!-- HERO -->
<section class="rud-hero">
  <div class="container">
    <div class="rud-breadcrumbs">
      <a href="/">Beranda</a> &rsaquo;
      <a href="/riksa-uji/">Jasa Riksa Uji K3</a> &rsaquo;
      <a href="/riksa-uji/?kategori=<?= $item['kategori'] ?>"><?= htmlspecialchars($item['kategori_label']) ?></a> &rsaquo;
      <span style="color:#fff;"><?= htmlspecialchars($item['judul']) ?></span>
    </div>

    <h1><?= htmlspecialchars($item['judul']) ?></h1>
    <p class="lead"><?= htmlspecialchars($item['tagline']) ?></p>

    <div class="rud-quick-specs">
      <div class="rud-spec-item">
        <strong>Dasar Hukum:</strong> <?= htmlspecialchars($item['dasar_hukum']) ?>
      </div>
      <div class="rud-spec-item">
        <strong>Masa Berlaku Uji:</strong> <?= htmlspecialchars($item['masa_berlaku']) ?>
      </div>
      <div class="rud-spec-item">
        <strong>Legalitas Hasil:</strong> Suket Resmi Kemnaker / Disnaker RI
      </div>
    </div>
  </div>
</section>

<!-- MAIN CONTENT & SIDEBAR -->
<main class="container">
  <div class="rud-body-grid">
    
    <!-- LEFT: IN-DEPTH TECHNICAL CONTENT -->
    <article class="rud-content">
      <h2>Pentingnya Riksa Uji Teknis Berdasarkan Regulasi Kemnaker</h2>
      <p>
        Setiap peralatan dan instalasi industri wajib melalui tahapan pemeriksaan dan pengujian (Riksa Uji) K3 sebelum pertama kali dioperasikan (uji pertama), secara berkala sesuai siklus waktu peraturan menteri (uji berkala), maupun setelah mengalami modifikasi atau perbaikan besar (uji khusus).
      </p>
      <p>
        Pengujian ini berlandaskan langsung pada <strong><?= htmlspecialchars($item['dasar_hukum']) ?></strong>. Melalui pemeriksaan menyeluruh, potensi bahaya mekanis, kegagalan material, dan malfungsi perangkat pengaman dapat dicegah sedini mungkin sebelum menyebabkan kerugian aset fatal atau korban jiwa tenaga kerja.
      </p>

      <div class="rud-callout-warning">
        <strong>Peringatan Hukum &amp; Asuransi:</strong>
        Pengoperasian peralatan tanpa Surat Keterangan (Suket) Kelayakan Operasi yang masih berlaku merupakan pelanggaran terhadap UU No. 1 Tahun 1970 Pasal 15 dengan ancaman sanksi pidana. Selain itu, polis asuransi aset industri dan jaminan BPJS Ketenagakerjaan berhak menolak klaim kerugian jika insiden melibatkan mesin yang tidak memiliki legalitas riksa uji sah.
      </div>

      <h2>Cakupan &amp; Objek Peralatan yang Diuji</h2>
      <p>
        Layanan inspeksi teknis kami mencakup berbagai varian dan kapasitas peralatan, antara lain:
      </p>
      <p style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:8px; padding:14px 18px; font-weight:600; color:#0f172a;">
        <?= htmlspecialchars($item['lingkup_alat']) ?>
      </p>

      <h2>6 Tahapan Pemeriksaan &amp; Pengujian di Lapangan</h2>
      <p>
        Pemeriksaan dilakukan langsung oleh Tim Tenaga Ahli K3 Spesialis Wahana Totalita Konsultan yang telah mengantongi SKP resmi dari Kementerian Ketenagakerjaan Republik Indonesia:
      </p>
      <ol class="rud-step-list">
        <?php foreach ($item['tahapan_uji'] as $step): ?>
        <li><?= htmlspecialchars($step) ?></li>
        <?php endforeach; ?>
      </ol>

      <h2>Persyaratan Dokumen Pengajuan Suket Resmi</h2>
      <p>
        Untuk mempercepat proses administrasi penerbitan Surat Keterangan (Suket) dan pengesahan pemakaian di Dinas Tenaga Kerja setempat, perusahaan pemohon disarankan menyiapkan berkas pendukung berikut:
      </p>
      <ul style="padding-left:20px; margin-bottom:24px;">
        <?php foreach ($item['dokumen_syarat'] as $doc): ?>
        <li style="margin-bottom:8px;"><?= htmlspecialchars($doc) ?></li>
        <?php endforeach; ?>
      </ul>

      <h2>Aplikasi Industri &amp; Pengalaman Lapangan</h2>
      <p>
        <?= htmlspecialchars($item['regional_insight']) ?>
      </p>
      <p>
        Dengan jaringan Tenaga Ahli K3 Spesialis di berbagai wilayah, Wahana Totalita siap memobilisasi peralatan uji standar internasional ke lokasi pabrik, site pertambangan, maupun pelabuhan logistik perusahaan Anda dengan jadwal fleksibel yang tidak mengganggu target shift operasional.
      </p>

      <h2>Pertanyaan Kerap Diajukan (FAQ)</h2>
      <div style="display:flex; flex-direction:column; gap:12px; margin-top:16px;">
        <?php foreach ($item['faqs'] as $faq): ?>
        <details style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:8px; padding:14px 18px;">
          <summary style="font-weight:700; color:#0f172a; cursor:pointer; font-size:14.5px;"><?= htmlspecialchars($faq['q']) ?></summary>
          <p style="margin:10px 0 0; color:#475569; font-size:13.5px; line-height:1.6;"><?= htmlspecialchars($faq['a']) ?></p>
        </details>
        <?php endforeach; ?>
      </div>
    </article>

    <!-- RIGHT: RFQ SIDEBAR -->
    <aside>
      <div class="rud-sidebar-card">
        <h3>Minta Penawaran Resmi</h3>
        <p style="color:#64748b; font-size:13px; line-height:1.5; margin:0 0 14px;">
          Dapatkan estimasi biaya, timeline penerbitan Suket, dan jadwal ketersediaan Tenaga Ahli K3 Spesialis kami:
        </p>

        <ul class="rud-sidebar-list">
          <li>
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
            PJK3 Berpenunjukan Resmi Kemnaker
          </li>
          <li>
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
            Laporan Hasil Uji (LHU) Akurat &amp; Cepat
          </li>
          <li>
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
            Harga Paket Batch Multi-Unit Hemat
          </li>
          <li>
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
            Didampingi Hingga Suket Terbit
          </li>
        </ul>

        <a href="<?= $wa_lead_url ?>" class="rud-btn-wa-full" target="_blank" rel="noopener">
          Konsultasi via WhatsApp
        </a>

        <?php if (!empty($item['pelatihan_terkait'])): ?>
        <div class="rud-cross-promo">
          <h4>Operator Anda Belum Berlisensi?</h4>
          <p>
            Selain kelayakan unit mesin, Kemnaker mewajibkan operator mengantongi Surat Izin Operator (SIO).
          </p>
          <a href="/pelatihan/<?= htmlspecialchars($item['pelatihan_terkait']['slug']) ?>/">
            Lihat <?= htmlspecialchars($item['pelatihan_terkait']['name']) ?> &rarr;
          </a>
        </div>
        <?php endif; ?>
      </div>
    </aside>

  </div>
</main>

<!-- RELATED INSPECTION SERVICES -->
<section style="background:#f8fafc; padding:48px 0; border-top:1px solid #e2e8f0;">
  <div class="container">
    <h3 style="font-size:20px; font-weight:800; color:#0f172a; margin:0 0 20px;">Layanan Riksa Uji Terkait Lainnya</h3>
    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(280px, 1fr)); gap:20px;">
      <?php foreach ($related_items as $rel): ?>
      <div style="background:#fff; border:1px solid #e2e8f0; border-radius:10px; padding:20px;">
        <span style="font-size:11.5px; font-weight:700; color:#c2410c; background:#fff7ed; padding:2px 8px; border-radius:4px;">
          <?= htmlspecialchars($rel['kategori_label']) ?>
        </span>
        <h4 style="font-size:16px; margin:10px 0 6px; font-weight:700;">
          <a href="/riksa-uji/<?= htmlspecialchars($rel['slug']) ?>/" style="color:#0f172a; text-decoration:none;">
            <?= htmlspecialchars($rel['judul']) ?>
          </a>
        </h4>
        <p style="font-size:13px; color:#64748b; line-height:1.5; margin:0 0 12px;">
          <?= htmlspecialchars($rel['tagline']) ?>
        </p>
        <a href="/riksa-uji/<?= htmlspecialchars($rel['slug']) ?>/" style="font-size:13px; font-weight:700; color:#0f1a30; text-decoration:none;">
          Detail Layanan &rarr;
        </a>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php require dirname(__DIR__) . '/includes/footer.php'; ?>
<script src="/assets/js/main.js" defer></script>
</body>
</html>
