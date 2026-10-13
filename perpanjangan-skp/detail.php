<?php
/**
 * perpanjangan-skp/detail.php — Dedicated Service Page for Individual SKP, SIO & BNSP License Renewal
 * URL: /perpanjangan-skp/{slug}/
 */
require_once dirname(__DIR__) . '/config.php';
require_once dirname(__DIR__) . '/includes/perpanjangan-skp-data.php';

$slug = trim($_GET['slug'] ?? '');
if (!$slug) {
    header('Location: ' . SITE_URL . '/perpanjangan-skp/', true, 301);
    exit;
}

$item = get_perpanjangan_skp_item($slug);
if (!$item) {
    http_response_code(404);
    include dirname(__DIR__) . '/404.php';
    exit;
}

$s = get_all_settings();
$wa_number = preg_replace('/\D/', '', get_setting('wa_number', '6287759151278'));

$canonical = SITE_URL . '/perpanjangan-skp/' . $item['slug'] . '/';

$meta_title = $item['meta_title'] . ' | Wahana Totalita';
$meta_desc  = $item['meta_desc'];

// WhatsApp Lead Generation Message
$wa_lead_msg = "Halo Wahana Totalita, saya ingin memperpanjang {$item['judul']}. Mohon info estimasi biaya dan kelengkapan dokumen yang dibutuhkan.";
$wa_lead_url = "https://wa.me/{$wa_number}?text=" . rawurlencode($wa_lead_msg);

// Related renewal services
$related_items = get_related_perpanjangan_skp($item['slug'], $item['kategori'], 3);

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
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Perpanjangan SKP & Lisensi K3', 'item' => SITE_URL . '/perpanjangan-skp/'],
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
        'serviceType'  => 'Statutory License Renewal & Administrative Processing',
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
<?php require dirname(__DIR__) . '/includes/css.php'; ?>

<link rel="stylesheet" href="<?= asset_v('/assets/css/page/perpanjangan-skp-detail.css') ?>">
</head>
<body>

<?php require dirname(__DIR__) . '/includes/navbar.php'; ?>

<!-- HERO -->
<section class="skpd-hero">
  <div class="container">
    <div class="skpd-breadcrumbs">
      <a href="/">Beranda</a> &rsaquo;
      <a href="/perpanjangan-skp/">Perpanjangan SKP &amp; Lisensi K3</a> &rsaquo;
      <a href="/perpanjangan-skp/?kategori=<?= $item['kategori'] ?>"><?= htmlspecialchars($item['kategori_label']) ?></a> &rsaquo;
      <span style="color:var(--surface);"><?= htmlspecialchars($item['judul']) ?></span>
    </div>

    <h1><?= htmlspecialchars($item['judul']) ?></h1>
    <p class="lead"><?= htmlspecialchars($item['tagline']) ?></p>

    <div class="skpd-quick-specs">
      <div class="skpd-spec-item">
        <strong>Dasar Hukum:</strong> <?= htmlspecialchars($item['dasar_hukum']) ?>
      </div>
      <div class="skpd-spec-item">
        <strong>Masa Berlaku:</strong> <?= htmlspecialchars($item['masa_berlaku']) ?>
      </div>
      <div class="skpd-spec-item">
        <strong>Waktu Proses:</strong> <?= htmlspecialchars($item['durasi_proses']) ?>
      </div>
      <div class="skpd-spec-item">
        <strong>Wilayah Kebutuhan:</strong> <?= htmlspecialchars($item['city_keyword']) ?>
      </div>
    </div>
  </div>
</section>

<!-- MAIN CONTENT & SIDEBAR -->
<main class="container">
  <div class="skpd-body-grid">
    
    <!-- LEFT: IN-DEPTH TECHNICAL CONTENT -->
    <article class="skpd-content">
      <h2>Mengapa Perpanjangan Administratif Tepat Waktu Itu Penting?</h2>
      <p>
        <?= htmlspecialchars($item['deskripsi_lengkap']) ?>
      </p>

      <div class="skpd-callout-info">
        <strong>Keuntungan Proses Administratif Tanpa Pelatihan Ulang:</strong>
        Selama dokumen Anda belum melewati batas toleransi kedaluwarsa, Anda tidak diwajibkan mengikuti pembinaan ulang dari awal. Anda menghemat waktu kerja produktif dan menghemat anggaran perusahaan hingga 60%–70% dibanding mengambil kursus baru.
      </div>

      <h2>Persyaratan Berkas Dokumen Pengajuan</h2>
      <p>
        Untuk memastikan verifikasi di Kementerian Ketenagakerjaan RI atau LSP BNSP berjalan lancar tanpa penolakan, siapkan berkas berikut dalam bentuk scan digital berwarna (format PDF atau JPG jelas):
      </p>
      <ul style="padding-left:20px; margin-bottom:24px;">
        <?php foreach ($item['syarat_dokumen'] as $doc): ?>
        <li style="margin-bottom:8px;"><?= htmlspecialchars($doc) ?></li>
        <?php endforeach; ?>
      </ul>

      <h2>4 Tahapan Alur Pemrosesan Berkas</h2>
      <ol class="skpd-step-list">
        <?php foreach ($item['alur_proses'] as $step): ?>
        <li><?= htmlspecialchars($step) ?></li>
        <?php endforeach; ?>
      </ol>

      <h2>Pertanyaan Umum &amp; Solusi Kendala (FAQ)</h2>
      <div style="display:flex; flex-direction:column; gap:12px; margin-top:16px;">
        <?php foreach ($item['faqs'] as $faq): ?>
        <details style="background:var(--slate-50); border:1px solid var(--slate-200); border-radius:8px; padding:14px 18px;">
          <summary style="font-weight:700; color:var(--slate-900); cursor:pointer; font-size:14.5px;"><?= htmlspecialchars($faq['q']) ?></summary>
          <p style="margin:10px 0 0; color:var(--slate-600); font-size:13.5px; line-height:1.6;"><?= htmlspecialchars($faq['a']) ?></p>
        </details>
        <?php endforeach; ?>
      </div>
    </article>

    <!-- RIGHT: PRICING & REGISTRATION SIDEBAR -->
    <aside>
      <div class="skpd-sidebar-card">
        <h3>Biaya &amp; Pengajuan</h3>
        
        <div class="skpd-price-display">
          <span style="font-size:12px; color:var(--slate-500); text-transform:uppercase; font-weight:700;">Biaya Perorangan:</span>
          <div class="price-val"><?= htmlspecialchars($item['biaya_standar']) ?></div>
          <p style="margin:6px 0 0; font-size:12px; color:var(--brand); font-weight:600;">
            Tarif Rombongan / Batch: <?= htmlspecialchars($item['biaya_batch']) ?>
          </p>
        </div>

        <ul class="skpd-sidebar-list">
          <li>
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
            Termasuk Biaya PNBP Resmi
          </li>
          <li>
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
            Format Laporan K3 Disediakan
          </li>
          <li>
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
            Proses 100% Online Tanpa Tatap Muka
          </li>
          <li>
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
            Pengiriman Dokumen Fisik Asli
          </li>
        </ul>

        <a href="<?= $wa_lead_url ?>" class="skpd-btn-wa-full" target="_blank" rel="noopener">
          Ajukan Perpanjangan via WhatsApp
        </a>

        <p style="text-align:center; font-size:12px; color:var(--slate-400); margin:12px 0 0;">
          Konsultasi &amp; pengecekan berkas awal gratis
        </p>
      </div>
    </aside>

  </div>
</main>

<!-- RELATED RENEWAL SERVICES -->
<section style="background:var(--slate-50); padding:48px 0; border-top:1px solid var(--slate-200);">
  <div class="container">
    <h3 style="font-size:20px; font-weight:800; color:var(--slate-900); margin:0 0 20px;">Layanan Perpanjangan Terkait Lainnya</h3>
    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(280px, 1fr)); gap:20px;">
      <?php foreach ($related_items as $rel): ?>
      <div style="background:var(--surface); border:1px solid var(--slate-200); border-radius:10px; padding:20px;">
        <span style="font-size:11.5px; font-weight:700; color:var(--accent-dark); background:var(--accent-light); padding:2px 8px; border-radius:4px;">
          <?= htmlspecialchars($rel['kategori_label']) ?>
        </span>
        <h4 style="font-size:16px; margin:10px 0 6px; font-weight:700;">
          <a href="/perpanjangan-skp/<?= htmlspecialchars($rel['slug']) ?>/" style="color:var(--slate-900); text-decoration:none;">
            <?= htmlspecialchars($rel['judul']) ?>
          </a>
        </h4>
        <p style="font-size:13px; color:var(--slate-500); line-height:1.5; margin:0 0 12px;">
          <?= htmlspecialchars($rel['tagline']) ?>
        </p>
        <a href="/perpanjangan-skp/<?= htmlspecialchars($rel['slug']) ?>/" style="font-size:13px; font-weight:700; color:var(--brand-dark); text-decoration:none;">
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
