<?php
/**
 * perpanjangan-skp/index.php — Master Authority Hub for Perpanjangan SKP & Lisensi K3 Kemnaker / BNSP
 * URL: /perpanjangan-skp/
 */
require_once dirname(__DIR__) . '/config.php';
require_once dirname(__DIR__) . '/includes/perpanjangan-skp-data.php';

$s = get_all_settings();
$wa_number = preg_replace('/\D/', '', get_setting('wa_number', '6287759151278'));

// Filter parameters
$search   = trim($_GET['q'] ?? '');
$kategori = trim($_GET['kategori'] ?? '');

$filter = [];
if ($search !== '')   $filter['q'] = $search;
if ($kategori !== '') $filter['kategori'] = $kategori;

$items        = get_all_perpanjangan_skp_items($filter);
$categories   = get_perpanjangan_skp_categories();
$totalFound   = count($items);

$page_title  = 'Perpanjangan SKP & Lisensi K3 Kemnaker RI Resmi | Biaya, Syarat & Proses Cepat';
$meta_desc   = 'Layanan perpanjangan SKP Ahli K3 Umum, Mutasi PT, SIO Forklift/Crane & Sertifikat BNSP online. Tanpa pelatihan ulang, proses 7-14 hari. Cek syarat & biaya disini.';
$canonical   = SITE_URL . '/perpanjangan-skp/';

$default_wa_text = "Halo Wahana Totalita, saya ingin konsultasi perpanjangan SKP / Lisensi K3 saya. Mohon dibantu cek masa berlaku dan persyaratannya.";
$default_wa_url  = "https://wa.me/{$wa_number}?text=" . rawurlencode($default_wa_text);

// Schema.org Graph
$schema_graph = [
    [
        '@type'        => 'Organization',
        '@id'          => SITE_URL . '/#organization',
        'name'         => 'PT Wahana Totalita Konsultan',
        'url'          => SITE_URL,
        'description'  => 'PJK3 Resmi Berlisensi Kementerian Ketenagakerjaan RI Bidang Pembinaan, Perpanjangan SKP/Lisensi K3 & Uji Kompetensi BNSP.',
        'contactPoint' => [
            '@type'             => 'ContactPoint',
            'telephone'         => '+62-877-5915-1278',
            'contactType'       => 'licensing & customer service',
            'availableLanguage' => ['Indonesian', 'English']
        ]
    ],
    [
        '@type' => 'BreadcrumbList',
        '@id'   => $canonical . '#breadcrumb',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => SITE_URL . '/'],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Perpanjangan SKP & Lisensi K3', 'item' => $canonical]
        ]
    ],
    [
        '@type'       => 'Service',
        '@id'         => $canonical . '#service',
        'name'        => 'Layanan Perpanjangan SKP Ahli K3 & Lisensi Kemnaker / BNSP Online',
        'provider'    => ['@id' => SITE_URL . '/#organization'],
        'serviceType' => 'Statutory Licensing Administration & Renewal',
        'description' => $meta_desc,
        'areaServed'  => [
            ['@type' => 'Country', 'name' => 'Indonesia']
        ]
    ],
    [
        '@type'      => 'FAQPage',
        '@id'        => $canonical . '#faq',
        'mainEntity' => [
            [
                '@type' => 'Question',
                'name'  => 'SKP Ahli K3 berlaku berapa lama?',
                'answerCount' => 1,
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text'  => 'Berdasarkan Permenaker No. 02/MEN/1992, SKP (Surat Keputusan Penunjukan) dan Lisensi Ahli K3 berlaku selama 3 (tiga) tahun. Sedangkan Lisensi Operator K3 Kemnaker (SIO) berlaku selama 5 tahun, dan Sertifikat Kompetensi BNSP berlaku selama 3 tahun.'
                ]
            ],
            [
                '@type' => 'Question',
                'name'  => 'Apakah SKP yang sudah kadaluwarsa harus mengulang pelatihan dari awal?',
                'answerCount' => 1,
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text'  => 'Tidak perlu jika masih dalam batas masa toleransi (kurang dari 1 tahun). Anda cukup mengajukan perpanjangan administratif. Jika sudah kadaluwarsa lebih dari 1 tahun, Anda dapat mengikuti program Refresher K3 (penyegaran 2 hari) tanpa harus membayar biaya penuh kursus 12 hari dari nol.'
                ]
            ],
            [
                '@type' => 'Question',
                'name'  => 'Berapa lama proses nunggunya sampai SKP / Lisensi baru terbit?',
                'answerCount' => 1,
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text'  => 'Waktu proses rata-rata adalah 7 hingga 14 hari kerja setelah seluruh dokumen persyaratan dan Laporan Kegiatan K3 dinyatakan lengkap dan diverifikasi oleh tim pengawas Kemnaker RI.'
                ]
            ],
            [
                '@type' => 'Question',
                'name'  => 'Apakah proses perpanjangan sertifikat BNSP bisa secara online?',
                'answerCount' => 1,
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text'  => 'Bisa 100% online. Melalui skema RCC (Recognition of Current Competency), perpanjangan sertifikat BNSP dilakukan melalui verifikasi portofolio kerja dan wawancara online bersama asesor LSP via Zoom tanpa harus hadir tatap muka.'
                ]
            ],
            [
                '@type' => 'Question',
                'name'  => 'Berapa estimasi biaya perpanjangan lisensi dan SKP K3?',
                'answerCount' => 1,
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text'  => 'Biaya perpanjangan SIO Operator mulai dari Rp 1.500.000,- (batch) hingga Rp 1.750.000,-. Perpanjangan SKP Ahli K3 Umum Rp 1.850.000,-, Mutasi PT Rp 2.450.000,-, dan Uji RCC BNSP Rp 2.500.000,- all-in termasuk PNBP dan pengiriman fisik dokumen.'
                ]
            ]
        ]
    ]
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($page_title) ?></title>
<meta name="description" content="<?= htmlspecialchars($meta_desc) ?>">
<link rel="canonical" href="<?= htmlspecialchars($canonical) ?>">

<meta property="og:type" content="website">
<meta property="og:site_name" content="Wahana Totalita Konsultan">
<meta property="og:title" content="<?= htmlspecialchars($page_title) ?>">
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
/* Perpanjangan SKP Hub Styles */
.skp-hero {
  background: linear-gradient(135deg, #07192f 0%, #0d2b52 50%, #0b1e3b 100%);
  color: #fff;
  padding: 56px 0 48px;
  position: relative;
  overflow: hidden;
  border-bottom: 4px solid #E8611A;
}
.skp-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: rgba(232, 97, 26, 0.15);
  border: 1px solid rgba(232, 97, 26, 0.4);
  color: #fed7aa;
  font-size: 13px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: .06em;
  padding: 6px 14px;
  border-radius: 99px;
  margin-bottom: 16px;
}
.skp-hero h1 {
  font-size: clamp(26px, 3.8vw, 42px);
  font-weight: 800;
  line-height: 1.25;
  margin-bottom: 16px;
  color: #ffffff;
}
.skp-hero h1 em {
  font-style: normal;
  color: #f97316;
}
.skp-hero p.lead {
  font-size: clamp(15px, 1.8vw, 17.5px);
  color: #cbd5e1;
  max-width: 820px;
  line-height: 1.6;
  margin-bottom: 26px;
}
.skp-hero-actions {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
}
.skp-btn-wa {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  background: #25D366;
  color: #fff;
  font-weight: 700;
  font-size: 15px;
  padding: 13px 26px;
  border-radius: 10px;
  text-decoration: none;
  transition: transform .2s ease, background .2s ease;
}
.skp-btn-wa:hover {
  background: #20ba5a;
  transform: translateY(-2px);
  color: #fff;
}
.skp-btn-outline {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: rgba(255,255,255,0.08);
  color: #fff;
  border: 1px solid rgba(255,255,255,0.25);
  font-weight: 600;
  font-size: 15px;
  padding: 13px 22px;
  border-radius: 10px;
  text-decoration: none;
}
.skp-btn-outline:hover {
  background: rgba(255,255,255,0.18);
  color: #fff;
}
.skp-trust-bar {
  display: flex;
  flex-wrap: wrap;
  gap: 24px;
  margin-top: 32px;
  padding-top: 22px;
  border-top: 1px solid rgba(255,255,255,0.12);
  font-size: 13.5px;
  color: #94a3b8;
}
.skp-trust-bar span {
  display: flex;
  align-items: center;
  gap: 8px;
  color: #e2e8f0;
}
.skp-trust-bar svg {
  width: 18px;
  height: 18px;
  color: #22c55e;
}

/* Category Filter Chips */
.skp-filter-section {
  background: #f8fafc;
  padding: 22px 0;
  border-bottom: 1px solid #e2e8f0;
}
.skp-filter-bar {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  align-items: center;
  justify-content: center;
}
.skp-filter-chip {
  padding: 8px 18px;
  border-radius: 99px;
  font-size: 13.5px;
  font-weight: 600;
  text-decoration: none;
  background: #fff;
  color: #334155;
  border: 1px solid #cbd5e1;
  transition: all .2s;
}
.skp-filter-chip:hover {
  background: #f1f5f9;
  border-color: #94a3b8;
  color: #0f172a;
}
.skp-filter-chip.active {
  background: #0f1a30;
  color: #fff;
  border-color: #0f1a30;
}

/* Grid of Renewal Services */
.skp-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
  gap: 24px;
  margin-top: 32px;
}
.skp-card {
  background: #fff;
  border: 1px solid #e2e8f0;
  border-radius: 14px;
  padding: 24px;
  display: flex;
  flex-direction: column;
  transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
  box-shadow: 0 4px 12px rgba(0,0,0,0.03);
}
.skp-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 12px 24px rgba(0,0,0,0.07);
  border-color: #f97316;
}
.skp-card-tag {
  font-size: 11.5px;
  font-weight: 700;
  text-transform: uppercase;
  color: #c2410c;
  background: #fff7ed;
  border: 1px solid #ffedd5;
  padding: 3px 10px;
  border-radius: 6px;
  align-self: flex-start;
  margin-bottom: 12px;
}
.skp-card h3 {
  font-size: 18.5px;
  font-weight: 800;
  color: #0f172a;
  margin: 0 0 10px;
  line-height: 1.35;
}
.skp-card h3 a {
  color: inherit;
  text-decoration: none;
}
.skp-card h3 a:hover {
  color: #c2410c;
}
.skp-card p.desc {
  font-size: 14px;
  color: #475569;
  line-height: 1.55;
  margin-bottom: 16px;
  flex-grow: 1;
}
.skp-card-price-box {
  background: #f8fafc;
  border-radius: 8px;
  padding: 12px 14px;
  font-size: 13px;
  color: #334155;
  margin-bottom: 18px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.skp-card-price-box strong {
  font-size: 16px;
  color: #0A4A2E;
  font-weight: 800;
}
.skp-card-actions {
  display: flex;
  gap: 10px;
  align-items: center;
}
.skp-card-btn {
  flex: 1;
  text-align: center;
  padding: 9px 14px;
  border-radius: 8px;
  font-size: 13.5px;
  font-weight: 700;
  text-decoration: none;
}
.skp-card-btn-primary {
  background: #0f1a30;
  color: #fff;
}
.skp-card-btn-primary:hover {
  background: #1e293b;
  color: #fff;
}
.skp-card-btn-wa {
  background: #25D366;
  color: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 40px;
  padding: 9px 0;
}
.skp-card-btn-wa:hover {
  background: #20ba5a;
  color: #fff;
}

/* Instant WhatsApp Expiry Checker Callout */
.skp-checker-box {
  background: linear-gradient(135deg, #0A4A2E 0%, #115E59 100%);
  border-radius: 16px;
  padding: 36px 32px;
  color: #fff;
  margin: 46px 0;
}
.skp-checker-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 24px;
  align-items: center;
}
.skp-checker-box h3 {
  font-size: 24px;
  color: #fff;
  font-weight: 800;
  margin: 0 0 10px;
}
.skp-checker-box p {
  color: #ccfbf1;
  font-size: 14.5px;
  line-height: 1.6;
  margin: 0;
}

/* Pricing Comparison Table */
.skp-table-box {
  background: #fff;
  border: 1px solid #e2e8f0;
  border-radius: 12px;
  overflow-x: auto;
  margin-top: 24px;
}
.skp-table {
  width: 100%;
  border-collapse: collapse;
  text-align: left;
  font-size: 14px;
}
.skp-table th {
  background: #0f1a30;
  color: #fff;
  padding: 14px 18px;
  font-weight: 700;
  font-size: 13px;
  text-transform: uppercase;
  letter-spacing: .04em;
}
.skp-table td {
  padding: 14px 18px;
  border-bottom: 1px solid #f1f5f9;
  color: #334155;
  vertical-align: top;
}
.skp-table tr:hover td {
  background: #f8fafc;
}
</style>
</head>
<body>

<?php require dirname(__DIR__) . '/includes/navbar.php'; ?>

<!-- HERO -->
<section class="skp-hero">
  <div class="container">
    <div class="skp-badge">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/></svg>
      Layanan Resmi Kemnaker RI &amp; BNSP
    </div>
    <h1>Perpanjang SKP &amp; Lisensi K3 <em>Tanpa Pelatihan Ulang</em></h1>
    <p class="lead">
      SKP atau Lisensi K3 Anda mendekati tanggal kedaluwarsa atau sudah lewat masa 3 tahun? Ajukan perpanjangan administratif resmi ke Kementerian Ketenagakerjaan RI dan LSP BNSP. <strong>Proses cepat 7–14 hari kerja, tanpa harus mengulang kursus dari nol.</strong>
    </p>

    <div class="skp-hero-actions">
      <a href="<?= $default_wa_url ?>" class="skp-btn-wa" target="_blank" rel="noopener">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
        Cek Kelayakan Berkas via WhatsApp (Gratis)
      </a>
      <a href="#katalog" class="skp-btn-outline">Lihat Daftar Lisensi (<?= count(get_all_perpanjangan_skp_items()) ?>)</a>
    </div>

    <div class="skp-trust-bar">
      <span><svg viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>Birokrasi TemanK3 Resmi</span>
      <span><svg viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>Hemat Biaya hingga Rp 5 Juta</span>
      <span><svg viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>100% Pengurusan Online</span>
      <span><svg viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>Didampingi Hingga Fisik Terbit</span>
    </div>
  </div>
</section>

<!-- FILTER SECTION -->
<section class="skp-filter-section" id="katalog">
  <div class="container">
    <div class="skp-filter-bar">
      <a href="/perpanjangan-skp/" class="skp-filter-chip <?= empty($kategori) ? 'active' : '' ?>">Semua Program (<?= count(get_all_perpanjangan_skp_items()) ?>)</a>
      <?php foreach ($categories as $catKey => $catLabel): ?>
      <a href="/perpanjangan-skp/?kategori=<?= $catKey ?>" class="skp-filter-chip <?= ($kategori === $catKey) ? 'active' : '' ?>">
        <?= htmlspecialchars($catLabel) ?>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- SERVICES GRID -->
<section style="padding: 48px 0 60px; background: #fff;">
  <div class="container">
    <div style="display:flex; justify-content:space-between; align-items:flex-end; flex-wrap:wrap; gap:16px;">
      <div>
        <span style="color:#c2410c; font-weight:700; font-size:13px; text-transform:uppercase; letter-spacing:.08em;">Katalog Pembaharuan Lisensi</span>
        <h2 style="font-size:clamp(22px, 3vw, 32px); color:#0f172a; font-weight:800; margin:6px 0 0;">
          Pilih Jenis SKP atau Lisensi yang Ingin Diperpanjang
        </h2>
      </div>
      <p style="color:#64748b; font-size:14px; margin:0;">
        Menampilkan <strong><?= $totalFound ?></strong> skema perpanjangan aktif
      </p>
    </div>

    <div class="skp-grid">
      <?php foreach ($items as $item): 
        $item_wa_text = "Halo Wahana Totalita, saya ingin memperpanjang {$item['judul']}. Mohon info estimasi biaya dan kelengkapan dokumen yang dibutuhkan.";
        $item_wa_url  = "https://wa.me/{$wa_number}?text=" . rawurlencode($item_wa_text);
      ?>
      <article class="skp-card">
        <span class="skp-card-tag"><?= htmlspecialchars($item['kategori_label']) ?></span>
        <h3><a href="/perpanjangan-skp/<?= htmlspecialchars($item['slug']) ?>/"><?= htmlspecialchars($item['judul']) ?></a></h3>
        <p class="desc"><?= htmlspecialchars($item['tagline']) ?></p>

        <div class="skp-card-price-box">
          <div>
            <span style="display:block; font-size:11.5px; color:#64748b; text-transform:uppercase;">Biaya Mulai:</span>
            <strong><?= htmlspecialchars($item['biaya_standar']) ?></strong>
          </div>
          <div style="text-align:right;">
            <span style="display:block; font-size:11.5px; color:#64748b;">Masa Berlaku:</span>
            <span style="font-weight:700; color:#0f172a;"><?= htmlspecialchars($item['masa_berlaku']) ?></span>
          </div>
        </div>

        <div class="skp-card-actions">
          <a href="/perpanjangan-skp/<?= htmlspecialchars($item['slug']) ?>/" class="skp-card-btn skp-card-btn-primary">
            Lihat Syarat &amp; Alur &rarr;
          </a>
          <a href="<?= $item_wa_url ?>" class="skp-card-btn skp-card-btn-wa" target="_blank" rel="noopener" title="Konsultasi WhatsApp">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
          </a>
        </div>
      </article>
      <?php endforeach; ?>
    </div>

    <!-- INSTANT EXPIRY CHECKER CALLOUT -->
    <div class="skp-checker-box">
      <div class="skp-checker-grid">
        <div>
          <span style="color:#99f6e4; font-weight:700; font-size:12px; text-transform:uppercase; letter-spacing:.08em;">Verifikasi Cepat 15 Menit</span>
          <h3>Bingung Apakah SKP Anda Masih Bisa Diperpanjang?</h3>
          <p>
            Cukup foto halaman depan sertifikat atau SKP lama Anda dan kirimkan ke tim verifikasi Wahana Totalita. Kami akan mengecek sisa masa tenggang toleransi dan menerbitkan checklist berkas yang dibutuhkan secara gratis.
          </p>
        </div>
        <div style="text-align:center;">
          <a href="<?= $default_wa_url ?>" class="skp-btn-wa" target="_blank" rel="noopener" style="font-size:16px; padding:15px 32px;">
            Kirim Foto SKP via WhatsApp
          </a>
          <p style="color:#ccfbf1; font-size:12.5px; margin-top:10px;">Respon cepat 15 menit &bull; Tanpa biaya pengecekan</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- TRANSPARENT PRICING & BENEFIT COMPARISON -->
<section style="padding: 50px 0; background: #f8fafc; border-top: 1px solid #e2e8f0; border-bottom: 1px solid #e2e8f0;">
  <div class="container">
    <div style="text-align:center; max-width:760px; margin:0 auto 28px;">
      <span style="color:#c2410c; font-weight:700; font-size:13px; text-transform:uppercase; letter-spacing:.08em;">Transparansi Biaya &amp; Estimasi</span>
      <h2 style="font-size:clamp(22px, 3vw, 32px); color:#0f172a; font-weight:800; margin:6px 0 12px;">
        Tabel Estimasi Biaya &amp; Durasi Perpanjangan K3
      </h2>
      <p style="color:#64748b; font-size:15px; margin:0;">
        Biaya all-in transparan meliputi verifikasi berkas, PNBP resmi kementerian / LSP, pencetakan blangko berhologram, dan ongkos kirim fisik dokumen bergaransi:
      </p>
    </div>

    <div class="skp-table-box">
      <table class="skp-table">
        <thead>
          <tr>
            <th>Jenis Layanan Perpanjangan</th>
            <th>Masa Berlaku</th>
            <th>Tarif Perorangan</th>
            <th>Tarif Rombongan / Batch</th>
            <th>Estimasi Waktu</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><strong>SIO Operator &amp; Teknisi Kemnaker</strong><br><small>Forklift, Crane, Boiler, Welder, Ketinggian</small></td>
            <td>5 Tahun</td>
            <td><strong>Rp 1.750.000</strong></td>
            <td><strong>Rp 1.500.000</strong> / lisensi (min. 3)</td>
            <td>7 – 10 Hari Kerja</td>
          </tr>
          <tr>
            <td><strong>SKP Ahli K3 Umum (Kemnaker RI)</strong><br><small>Pembaharuan SKP &amp; Lisensi Penunjukan</small></td>
            <td>3 Tahun</td>
            <td><strong>Rp 1.850.000</strong></td>
            <td><strong>Rp 1.550.000</strong> / orang (min. 3)</td>
            <td>7 – 14 Hari Kerja</td>
          </tr>
          <tr>
            <td><strong>Mutasi Perusahaan SKP Ahli K3</strong><br><small>Pindah PT / Perubahan Nama Badan Usaha</small></td>
            <td>3 Tahun</td>
            <td><strong>Rp 2.450.000</strong></td>
            <td><strong>Rp 2.100.000</strong> / orang</td>
            <td>10 – 16 Hari Kerja</td>
          </tr>
          <tr>
            <td><strong>SKP Ahli K3 Spesialis</strong><br><small>Listrik, Konstruksi, Kimia, Kebakaran</small></td>
            <td>3 Tahun</td>
            <td><strong>Rp 2.250.000</strong></td>
            <td><strong>Rp 1.950.000</strong> / orang</td>
            <td>10 – 14 Hari Kerja</td>
          </tr>
          <tr>
            <td><strong>Sertifikasi BNSP K3 &amp; Lingkungan (RCC)</strong><br><small>Uji Portofolio Online via Zoom (POPAL, PPPA, POP)</small></td>
            <td>3 Tahun</td>
            <td><strong>Rp 2.500.000</strong></td>
            <td><strong>Rp 2.200.000</strong> / orang</td>
            <td>5 – 10 Hari Kerja</td>
          </tr>
          <tr>
            <td><strong>Solusi SKP Kadaluwarsa > 1 Tahun</strong><br><small>Program Refresher K3 Resmi Kemnaker</small></td>
            <td>3 Tahun Baru</td>
            <td><strong>Rp 3.850.000</strong></td>
            <td><strong>Rp 3.300.000</strong> / orang</td>
            <td>Penyegaran 2 Hari</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

<!-- FAQ SECTION -->
<section style="padding: 50px 0; background: #fff;">
  <div class="container">
    <div style="text-align:center; max-width:700px; margin:0 auto 36px;">
      <span style="color:#c2410c; font-weight:700; font-size:13px; text-transform:uppercase; letter-spacing:.08em;">Pertanyaan Kerap Diajukan</span>
      <h2 style="font-size:clamp(22px, 3vw, 30px); color:#0f172a; font-weight:800; margin:6px 0 0;">
        FAQ Seputar Perpanjangan SKP &amp; Lisensi K3
      </h2>
    </div>

    <div style="max-width:840px; margin:0 auto; display:flex; flex-direction:column; gap:14px;">
      <details style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:10px; padding:16px 20px;">
        <summary style="font-weight:700; color:#0f172a; cursor:pointer; font-size:15.5px;">SKP Ahli K3 Umum berlaku berapa lama dan berlaku berapa tahun?</summary>
        <p style="margin:12px 0 0; color:#475569; font-size:14px; line-height:1.6;">
          Berdasarkan Permenaker No. 02/MEN/1992 Pasal 3, Surat Keputusan Penunjukan (SKP) dan Lisensi Ahli K3 berlaku selama <strong>3 (tiga) tahun</strong>. Setelah 3 tahun, pengurus wajib mengajukan perpanjangan administratif ke Kemnaker RI. Sertifikat kelulusan dasarnya sendiri berlaku seumur hidup.
        </p>
      </details>

      <details style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:10px; padding:16px 20px;">
        <summary style="font-weight:700; color:#0f172a; cursor:pointer; font-size:15.5px;">Berapa lama proses nunggunya sampai lisensi fisik terbit?</summary>
        <p style="margin:12px 0 0; color:#475569; font-size:14px; line-height:1.6;">
          Waktu tunggu pemrosesan adalah <strong>7 hingga 14 hari kerja</strong> setelah dokumen pendukung (laporan kegiatan K3 dan surat pengantar) diverifikasi lengkap oleh Pengawas Spesialis K3 Kemnaker RI.
        </p>
      </details>

      <details style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:10px; padding:16px 20px;">
        <summary style="font-weight:700; color:#0f172a; cursor:pointer; font-size:15.5px;">Jika SKP sudah kadaluwarsa lebih dari 1 tahun, apakah wajib kursus ulang 12 hari?</summary>
        <p style="margin:12px 0 0; color:#475569; font-size:14px; line-height:1.6;">
          Tidak perlu mengulang 12 hari penuh dari nol. Kemnaker RI menyediakan skema <strong>Refresher K3 (Pembinaan Penyegaran 2 Hari)</strong> bagi pemilik sertifikat lama yang penunjukannya telah mati lebih dari 1 tahun. Biayanya jauh lebih hemat dibandingkan mendaftar kursus penuh.
        </p>
      </details>

      <details style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:10px; padding:16px 20px;">
        <summary style="font-weight:700; color:#0f172a; cursor:pointer; font-size:15.5px;">Apakah sertifikat BNSP bisa diperpanjang secara online dari luar kota?</summary>
        <p style="margin:12px 0 0; color:#475569; font-size:14px; line-height:1.6;">
          Bisa 100% online. Skema RCC (Recognition of Current Competency) BNSP dilakukan secara daring: Anda mengunggah portofolio bukti kerja K3 selama 1–2 tahun terakhir, lalu mengikuti sesi wawancara online via Zoom bersama Asesor LSP selama ±30 menit. Sertifikat fisik Garuda BNSP baru akan dikirimkan ke alamat Anda.
        </p>
      </details>
    </div>
  </div>
</section>

<!-- BOTTOM CTA -->
<section style="background:#07192f; color:#fff; padding:50px 0; text-align:center; border-top:1px solid #1e293b;">
  <div class="container">
    <h2 style="color:#fff; font-size:26px; margin:0 0 12px; font-weight:800;">Jangan Biarkan Kewenangan K3 Anda Terputus</h2>
    <p style="color:#cbd5e1; font-size:15.5px; max-width:640px; margin:0 auto 24px;">
      Pertahankan keabsahan legalitas tender dan kepatuhan audit SMK3 perusahaan Anda. Kirimkan berkas perpanjangan SKP atau SIO Anda hari ini.
    </p>
    <a href="<?= $default_wa_url ?>" class="skp-btn-wa" target="_blank" rel="noopener" style="font-size:16px; padding:15px 32px;">
      Konsultasi Perpanjangan via WhatsApp
    </a>
  </div>
</section>

<?php require dirname(__DIR__) . '/includes/footer.php'; ?>
<script src="/assets/js/main.js" defer></script>
</body>
</html>
