<?php
/**
 * riksa-uji/index.php — Master Authority Hub for Jasa Riksa Uji K3 Kemnaker RI
 * URL: /riksa-uji/
 */
require_once dirname(__DIR__) . '/config.php';
require_once dirname(__DIR__) . '/includes/riksa-uji-data.php';

$s = get_all_settings();
$wa_number = preg_replace('/\D/', '', get_setting('wa_number', '6287759151278'));

// Filter parameters
$search   = trim($_GET['q'] ?? '');
$kategori = trim($_GET['kategori'] ?? '');

$filter = [];
if ($search !== '')   $filter['q'] = $search;
if ($kategori !== '') $filter['kategori'] = $kategori;

$items        = get_all_riksa_uji_items($filter);
$categories   = get_riksa_uji_categories();
$totalFound   = count($items);

$page_title  = 'Jasa Riksa Uji K3 Kemnaker RI Resmi (Pemeriksaan & Pengujian Alat) | Wahana Totalita';
$meta_desc   = 'Layanan jasa riksa uji K3 berlisensi PJK3 Kemnaker RI. Uji kelayakan forklift, crane, boiler, penangkal petir, bejana tekan & genset. Terbit Suket resmi pabrik.';
$canonical   = SITE_URL . '/riksa-uji/';

$default_wa_text = "Halo Wahana Totalita, kami ingin meminta penawaran resmi Jasa Riksa Uji K3 Kemnaker untuk unit peralatan di perusahaan kami.";
$default_wa_url  = "https://wa.me/{$wa_number}?text=" . rawurlencode($default_wa_text);

// Schema.org Graph
$schema_graph = [
    [
        '@type'        => 'Organization',
        '@id'          => SITE_URL . '/#organization',
        'name'         => 'PT Wahana Totalita Konsultan',
        'url'          => SITE_URL,
        'description'  => 'PJK3 Resmi Berlisensi Kementerian Ketenagakerjaan RI Bidang Pemeriksaan & Pengujian K3 serta Pembinaan Tenaga Kerja.',
        'contactPoint' => [
            '@type'             => 'ContactPoint',
            'telephone'         => '+62-877-5915-1278',
            'contactType'       => 'customer service & engineering sales',
            'availableLanguage' => ['Indonesian', 'English']
        ]
    ],
    [
        '@type' => 'BreadcrumbList',
        '@id'   => $canonical . '#breadcrumb',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => SITE_URL . '/'],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Jasa Riksa Uji K3', 'item' => $canonical]
        ]
    ],
    [
        '@type'       => 'Service',
        '@id'         => $canonical . '#service',
        'name'        => 'Jasa Riksa Uji K3 Kemnaker RI (Pemeriksaan & Pengujian Peralatan Industri)',
        'provider'    => ['@id' => SITE_URL . '/#organization'],
        'serviceType' => 'PJK3 Statutory Safety Inspection and Machinery Testing',
        'description' => $meta_desc,
        'areaServed'  => [
            ['@type' => 'Country', 'name' => 'Indonesia']
        ],
        'hasOfferCatalog' => [
            '@type' => 'OfferCatalog',
            'name'  => 'Katalog Layanan Riksa Uji K3 Kemnaker',
            'itemListElement' => array_values(array_map(function($i) {
                return [
                    '@type' => 'Offer',
                    'itemOffered' => [
                        '@type' => 'Service',
                        'name'  => $i['judul'],
                        'url'   => SITE_URL . '/riksa-uji/' . $i['slug'] . '/'
                    ]
                ];
            }, $items))
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
/* Riksa Uji Authority Styles */
.ru-hero {
  background: linear-gradient(135deg, #07192f 0%, #0d2b52 50%, #0b1e3b 100%);
  color: #fff;
  padding: 60px 0 50px;
  position: relative;
  overflow: hidden;
  border-bottom: 4px solid #E8611A;
}
.ru-hero::before {
  content: '';
  position: absolute;
  top: -50%;
  right: -20%;
  width: 600px;
  height: 600px;
  background: radial-gradient(circle, rgba(232, 97, 26, 0.15) 0%, transparent 70%);
  border-radius: 50%;
  pointer-events: none;
}
.ru-badge {
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
  margin-bottom: 18px;
}
.ru-hero h1 {
  font-size: clamp(26px, 3.8vw, 42px);
  font-weight: 800;
  line-height: 1.25;
  margin-bottom: 16px;
  color: #ffffff;
}
.ru-hero h1 em {
  font-style: normal;
  color: #f97316;
}
.ru-hero p.lead {
  font-size: clamp(15px, 1.8vw, 17.5px);
  color: #cbd5e1;
  max-width: 820px;
  line-height: 1.6;
  margin-bottom: 28px;
}
.ru-hero-actions {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
}
.ru-btn-wa {
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
.ru-btn-wa:hover {
  background: #20ba5a;
  transform: translateY(-2px);
  color: #fff;
}
.ru-btn-outline {
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
.ru-btn-outline:hover {
  background: rgba(255,255,255,0.18);
  color: #fff;
}
.ru-trust-bar {
  display: flex;
  flex-wrap: wrap;
  gap: 24px;
  margin-top: 36px;
  padding-top: 24px;
  border-top: 1px solid rgba(255,255,255,0.12);
  font-size: 13.5px;
  color: #94a3b8;
}
.ru-trust-bar span {
  display: flex;
  align-items: center;
  gap: 8px;
  color: #e2e8f0;
}
.ru-trust-bar svg {
  width: 18px;
  height: 18px;
  color: #22c55e;
}

/* Category Filter Bar */
.ru-filter-section {
  background: #f8fafc;
  padding: 24px 0;
  border-bottom: 1px solid #e2e8f0;
}
.ru-filter-bar {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  align-items: center;
  justify-content: center;
}
.ru-filter-chip {
  padding: 8px 16px;
  border-radius: 99px;
  font-size: 13.5px;
  font-weight: 600;
  text-decoration: none;
  background: #fff;
  color: #334155;
  border: 1px solid #cbd5e1;
  transition: all .2s;
}
.ru-filter-chip:hover {
  background: #f1f5f9;
  border-color: #94a3b8;
  color: #0f172a;
}
.ru-filter-chip.active {
  background: #0f1a30;
  color: #fff;
  border-color: #0f1a30;
}

/* Services Grid */
.ru-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(330px, 1fr));
  gap: 26px;
  margin-top: 36px;
}
.ru-card {
  background: #fff;
  border: 1px solid #e2e8f0;
  border-radius: 14px;
  padding: 26px;
  display: flex;
  flex-direction: column;
  transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
  box-shadow: 0 4px 12px rgba(0,0,0,0.03);
}
.ru-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 12px 24px rgba(0,0,0,0.07);
  border-color: #f97316;
}
.ru-card-tag {
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
.ru-card h3 {
  font-size: 19px;
  font-weight: 800;
  color: #0f172a;
  margin: 0 0 10px;
  line-height: 1.35;
}
.ru-card h3 a {
  color: inherit;
  text-decoration: none;
}
.ru-card h3 a:hover {
  color: #c2410c;
}
.ru-card p.desc {
  font-size: 14px;
  color: #475569;
  line-height: 1.55;
  margin-bottom: 16px;
  flex-grow: 1;
}
.ru-card-meta {
  background: #f8fafc;
  border-radius: 8px;
  padding: 10px 14px;
  font-size: 12.5px;
  color: #334155;
  margin-bottom: 18px;
}
.ru-card-meta strong {
  color: #0f172a;
}
.ru-card-actions {
  display: flex;
  gap: 10px;
  align-items: center;
}
.ru-card-btn {
  flex: 1;
  text-align: center;
  padding: 9px 14px;
  border-radius: 8px;
  font-size: 13.5px;
  font-weight: 700;
  text-decoration: none;
}
.ru-card-btn-primary {
  background: #0f1a30;
  color: #fff;
}
.ru-card-btn-primary:hover {
  background: #1e293b;
  color: #fff;
}
.ru-card-btn-wa {
  background: #25D366;
  color: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 40px;
  padding: 9px 0;
}
.ru-card-btn-wa:hover {
  background: #20ba5a;
  color: #fff;
}

/* Regulatory Table Section */
.ru-table-box {
  background: #fff;
  border: 1px solid #e2e8f0;
  border-radius: 12px;
  overflow-x: auto;
  margin-top: 24px;
}
.ru-table {
  width: 100%;
  border-collapse: collapse;
  text-align: left;
  font-size: 14px;
}
.ru-table th {
  background: #0f1a30;
  color: #fff;
  padding: 14px 18px;
  font-weight: 700;
  font-size: 13px;
  text-transform: uppercase;
  letter-spacing: .04em;
}
.ru-table td {
  padding: 14px 18px;
  border-bottom: 1px solid #f1f5f9;
  color: #334155;
  vertical-align: top;
}
.ru-table tr:hover td {
  background: #f8fafc;
}

/* Workflow Steps */
.ru-workflow {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: 20px;
  margin-top: 28px;
}
.ru-step {
  background: #fff;
  border: 1px solid #e2e8f0;
  border-radius: 12px;
  padding: 22px;
  position: relative;
  box-shadow: 0 2px 8px rgba(0,0,0,0.02);
}
.ru-step-num {
  width: 38px;
  height: 38px;
  border-radius: 50%;
  background: #fff7ed;
  color: #ea580c;
  border: 2px solid #fdba74;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 800;
  font-size: 16px;
  margin-bottom: 14px;
}
.ru-step h4 {
  font-size: 16px;
  font-weight: 800;
  color: #0f172a;
  margin: 0 0 8px;
}
.ru-step p {
  font-size: 13.5px;
  color: #64748b;
  line-height: 1.5;
  margin: 0;
}

/* RFQ Interactive Calculator Box */
.ru-rfq-box {
  background: linear-gradient(135deg, #07192f 0%, #0d2b52 100%);
  border-radius: 16px;
  padding: 36px 32px;
  color: #fff;
  margin-top: 48px;
}
.ru-rfq-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 24px;
  align-items: center;
}
.ru-rfq-box h3 {
  font-size: 24px;
  color: #fff;
  font-weight: 800;
  margin: 0 0 10px;
}
.ru-rfq-box p {
  color: #cbd5e1;
  font-size: 14.5px;
  line-height: 1.6;
  margin: 0;
}
</style>
</head>
<body>

<?php require dirname(__DIR__) . '/includes/navbar.php'; ?>

<!-- HERO -->
<section class="ru-hero">
  <div class="container">
    <div class="ru-badge">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/></svg>
      PJK3 Resmi Berlisensi Kemnaker RI
    </div>
    <h1>Jasa Riksa Uji K3 Kemnaker: <em>Pemeriksaan &amp; Sertifikasi Kelayakan Alat</em></h1>
    <p class="lead">
      Layanan pengujian teknis, Non-Destructive Testing (NDT), uji beban, dan inspeksi keselamatan untuk menerbitkan <strong>Surat Keterangan (Suket) Kelayakan Operasi resmi dari Kementerian Ketenagakerjaan RI</strong>. Menjamin legalitas operasional mesin dan keselamatan pabrik Anda.
    </p>

    <div class="ru-hero-actions">
      <a href="<?= $default_wa_url ?>" class="ru-btn-wa" target="_blank" rel="noopener">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
        Minta Penawaran / RFQ via WhatsApp
      </a>
      <a href="#katalog" class="ru-btn-outline">Lihat 7 Objek Uji</a>
    </div>

    <div class="ru-trust-bar">
      <span><svg viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>SKP PJK3 Resmi Kemnaker RI</span>
      <span><svg viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>Tenaga Ahli K3 Spesialis Ber-SKP</span>
      <span><svg viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>Alat Ukur Terkalibrasi KAN</span>
      <span><svg viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>Jangkauan Seluruh Indonesia</span>
    </div>
  </div>
</section>

<!-- FILTER SECTION -->
<section class="ru-filter-section" id="katalog">
  <div class="container">
    <div class="ru-filter-bar">
      <a href="/riksa-uji/" class="ru-filter-chip <?= empty($kategori) ? 'active' : '' ?>">Semua Bidang</a>
      <?php foreach ($categories as $catKey => $catLabel): ?>
      <a href="/riksa-uji/?kategori=<?= $catKey ?>" class="ru-filter-chip <?= ($kategori === $catKey) ? 'active' : '' ?>">
        <?= htmlspecialchars($catLabel) ?>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- CATALOG GRID -->
<section style="padding: 50px 0 60px; background: #fff;">
  <div class="container">
    <div style="display:flex; justify-content:space-between; align-items:flex-end; flex-wrap:wrap; gap:16px;">
      <div>
        <span style="color:#c2410c; font-weight:700; font-size:13px; text-transform:uppercase; letter-spacing:.08em;">Objek Pemeriksaan &amp; Pengujian</span>
        <h2 style="font-size:clamp(22px, 3vw, 32px); color:#0f172a; font-weight:800; margin:6px 0 0;">
          Daftar Layanan Riksa Uji K3 Spesifik
        </h2>
      </div>
      <p style="color:#64748b; font-size:14px; margin:0;">
        Menampilkan <strong><?= $totalFound ?></strong> program riksa uji siap uji
      </p>
    </div>

    <div class="ru-grid">
      <?php foreach ($items as $item): 
        $item_wa_text = "Halo Wahana Totalita, kami ingin meminta penawaran biaya Riksa Uji Kemnaker untuk unit: {$item['judul']}. Mohon info estimasi dan persyaratannya.";
        $item_wa_url  = "https://wa.me/{$wa_number}?text=" . rawurlencode($item_wa_text);
      ?>
      <article class="ru-card">
        <span class="ru-card-tag"><?= htmlspecialchars($item['kategori_label']) ?></span>
        <h3><a href="/riksa-uji/<?= htmlspecialchars($item['slug']) ?>/"><?= htmlspecialchars($item['judul']) ?></a></h3>
        <p class="desc"><?= htmlspecialchars($item['tagline']) ?></p>

        <div class="ru-card-meta">
          <div><strong>Regulasi:</strong> <?= htmlspecialchars($item['dasar_hukum']) ?></div>
          <div style="margin-top:4px;"><strong>Periode Uji:</strong> <?= htmlspecialchars($item['masa_berlaku']) ?></div>
        </div>

        <div class="ru-card-actions">
          <a href="/riksa-uji/<?= htmlspecialchars($item['slug']) ?>/" class="ru-card-btn ru-card-btn-primary">
            Lihat Prosedur &amp; Syarat &rarr;
          </a>
          <a href="<?= $item_wa_url ?>" class="ru-card-btn ru-card-btn-wa" target="_blank" rel="noopener" title="Tanya Penawaran WhatsApp">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
          </a>
        </div>
      </article>
      <?php endforeach; ?>
    </div>

    <!-- RFQ CALLOUT BOX -->
    <div class="ru-rfq-box">
      <div class="ru-rfq-grid">
        <div>
          <span style="color:#fdba74; font-weight:700; font-size:12px; text-transform:uppercase; letter-spacing:.08em;">Butuh Proposal &amp; Rincian Anggaran?</span>
          <h3>Dapatkan Penawaran Riksa Uji Resmi dalam 1×24 Jam</h3>
          <p>
            Kirimkan daftar inventaris mesin/instalasi perusahaan Anda (jenis alat, merk/kapasitas, dan kota lokasi pabrik). Tim Tenaga Ahli K3 Spesialis Wahana Totalita akan menyusun jadwal pemeriksaan lapangan serta proposal penawaran harga kompetitif.
          </p>
        </div>
        <div style="text-align:center;">
          <a href="<?= $default_wa_url ?>" class="ru-btn-wa" target="_blank" rel="noopener" style="font-size:16px; padding:15px 32px;">
            Hubungi Tim Teknis via WhatsApp
          </a>
          <p style="color:#94a3b8; font-size:12.5px; margin-top:10px;">Respon cepat 7 hari seminggu &bull; Konsultasi regulasi gratis</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 4 TAHAPAN KERJA RIKSA UJI -->
<section style="padding: 50px 0; background: #f8fafc; border-top: 1px solid #e2e8f0; border-bottom: 1px solid #e2e8f0;">
  <div class="container">
    <div style="text-align:center; max-width:720px; margin:0 auto 36px;">
      <span style="color:#c2410c; font-weight:700; font-size:13px; text-transform:uppercase; letter-spacing:.08em;">Prosedur Standar Operasional</span>
      <h2 style="font-size:clamp(22px, 3vw, 32px); color:#0f172a; font-weight:800; margin:6px 0 12px;">
        4 Tahap Penerbitan Suket Kemnaker Resmi
      </h2>
      <p style="color:#64748b; font-size:15px; margin:0;">
        Pemeriksaan dan pengujian dilaksanakan secara transparan, terukur, dan terkoordinasi langsung dengan Pengawas Ketenagakerjaan Spesialis K3 setempat.
      </p>
    </div>

    <div class="ru-workflow">
      <div class="ru-step">
        <div class="ru-step-num">1</div>
        <h4>Verifikasi Dokumen</h4>
        <p>Pengecekan gambar konstruksi, nameplate pabrikan, sertifikat material, riksa uji periode terdahulu, dan lisensi operator penanggung jawab alat.</p>
      </div>
      <div class="ru-step">
        <div class="ru-step-num">2</div>
        <h4>Pemeriksaan Visual &amp; NDT</h4>
        <p>Inspeksi keausan komponen, ketegakan struktur, pengujian tebal pelat ultrasonik (UT), serta uji keretakan sambungan las dengan Magnetic / Penetrant Test.</p>
      </div>
      <div class="ru-step">
        <div class="ru-step-num">3</div>
        <h4>Uji Fungsi &amp; Beban (SWL)</h4>
        <p>Pengujian seluruh limit switch, katup pengaman, rem darurat, disusul uji beban bertahap (110%–125% kapasitas aman) atau uji tekan hidrostatik 1.5x MAWP.</p>
      </div>
      <div class="ru-step">
        <div class="ru-step-num">4</div>
        <h4>Penerbitan Suket Sah</h4>
        <p>Penyusunan Laporan Hasil Uji (LHU) PJK3 dan penandatanganan Berita Acara bersama Pengawas Disnaker hingga Surat Keterangan resmi terbit.</p>
      </div>
    </div>
  </div>
</section>

<!-- REGULATORY FRAMEWORK TABLE -->
<section style="padding: 50px 0; background: #fff;">
  <div class="container">
    <div style="text-align:center; max-width:760px; margin:0 auto 28px;">
      <span style="color:#c2410c; font-weight:700; font-size:13px; text-transform:uppercase; letter-spacing:.08em;">Kepatuhan Hukum Nasional</span>
      <h2 style="font-size:clamp(22px, 3vw, 32px); color:#0f172a; font-weight:800; margin:6px 0 12px;">
        Dasar Hukum Wajib Uji K3 di Tempat Kerja
      </h2>
      <p style="color:#64748b; font-size:15px; margin:0;">
        Setiap pemilik, pengurus, dan pemakai mesin atau instalasi di wilayah Republik Indonesia wajib mentaati undang-undang dan peraturan menteri berikut:
      </p>
    </div>

    <div class="ru-table-box">
      <table class="ru-table">
        <thead>
          <tr>
            <th>Kelompok Objek Uji</th>
            <th>Peraturan Perundangan</th>
            <th>Masa Uji Berkala</th>
            <th>Sanksi Ketidakpatuhan</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><strong>Pesawat Angkat &amp; Angkut</strong><br><small>Forklift, Crane, Excavator, Hoist</small></td>
            <td>Permenaker No. 8 Tahun 2020</td>
            <td>1 Tahun Sekali</td>
            <td>Penyegelan alat / sanksi kurungan UU No. 1/1970 Pasal 15</td>
          </tr>
          <tr>
            <td><strong>Ketel Uap (Boiler)</strong><br><small>Water tube, fire tube, combi boiler</small></td>
            <td>UU Uap Tahun 1930 &amp; PP 1930</td>
            <td>2 Tahun Sekali</td>
            <td>Penghentian izin operasi &amp; penolakan klaim asuransi kebakaran</td>
          </tr>
          <tr>
            <td><strong>Bejana Tekanan &amp; Tangki Timbun</strong><br><small>Air receiver, tangki solar, tangki CPO</small></td>
            <td>Permenaker No. 37 Tahun 2016</td>
            <td>2 Thn (Bejana) / 5 Thn (Tangki)</td>
            <td>Penyitaan peralatan bertekanan tanpa akte pengesahan</td>
          </tr>
          <tr>
            <td><strong>Instalasi Penyalur Petir</strong><br><small>Konvensional &amp; Elektrostatis</small></td>
            <td>Permenaker No. 31 Tahun 2015</td>
            <td>2 Tahun Sekali</td>
            <td>Temuan mayor audit SMK3 &amp; kewajiban ganti rugi kebakaran</td>
          </tr>
          <tr>
            <td><strong>Instalasi Listrik &amp; Thermovision</strong><br><small>Panel distribusi LVMDP, trafo</small></td>
            <td>Permenaker No. 12 Tahun 2015</td>
            <td>1 Tahun Sekali</td>
            <td>Risiko arc flash fatal &amp; pelanggaran regulasi ketenagakerjaan</td>
          </tr>
          <tr>
            <td><strong>Pesawat Tenaga &amp; Produksi</strong><br><small>Genset diesel > 100 HP, mesin press</small></td>
            <td>Permenaker No. 38 Tahun 2016</td>
            <td>1 Tahun Sekali</td>
            <td>Penghentian mesin produksi oleh Pengawas Ketenagakerjaan</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

<!-- REGIONAL INDUSTRIAL EXPERTISE (Kalimantan, Riau, Jawa) -->
<section style="padding: 50px 0; background: #0f1a30; color:#fff;">
  <div class="container">
    <div style="max-width:760px; margin:0 auto 36px; text-align:center;">
      <span style="color:#f97316; font-weight:700; font-size:13px; text-transform:uppercase; letter-spacing:.08em;">Jangkauan Nasional &amp; Spesialisasi Sektor</span>
      <h2 style="font-size:clamp(22px, 3vw, 32px); color:#fff; font-weight:800; margin:6px 0 12px;">
        Solusi Riksa Uji K3 untuk Pusat Industri Indonesia
      </h2>
      <p style="color:#94a3b8; font-size:15px; margin:0;">
        Tim inspektur Wahana Totalita terbiasa memobilisasi peralatan uji presisi (load cell, water bag, ultrasonic gauge, earth tester) ke area operasional terpencil maupun kawasan industri padat modal:
      </p>
    </div>

    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(300px, 1fr)); gap:22px;">
      <div style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.12); border-radius:12px; padding:24px;">
        <h4 style="color:#fdba74; font-size:17px; margin:0 0 10px;">🚜 Kalimantan (Balikpapan, IKN, Samarinda, Tabalong)</h4>
        <p style="color:#cbd5e1; font-size:13.5px; line-height:1.6; margin:0;">
          Fokus pada sertifikasi alat berat tambang batubara (excavator, dump truck), crawler crane untuk erection mega proyek IKN Nusantara, serta uji pembebanan genset diesel berkekuatan megawatt di site pertambangan terisolasi.
        </p>
      </div>

      <div style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.12); border-radius:12px; padding:24px;">
        <h4 style="color:#fdba74; font-size:17px; margin:0 0 10px;">🌴 Riau &amp; Sumatera (Pekanbaru, Dumai, Duri, Pelalawan)</h4>
        <p style="color:#cbd5e1; font-size:13.5px; line-height:1.6; margin:0;">
          Spesialisasi uji hydrotest dan internal inspection boiler pabrik kelapa sawit (PKS), pengukuran ketebalan pelat tangki timbun CPO vertikal ribuan ton, serta pengujian sistem proteksi kebakaran tangki BBM pelabuhan Dumai.
        </p>
      </div>

      <div style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.12); border-radius:12px; padding:24px;">
        <h4 style="color:#fdba74; font-size:17px; margin:0 0 10px;">⚙️ Jawa &amp; Sulawesi (Cilegon, Karawang, Morowali, Surabaya)</h4>
        <p style="color:#cbd5e1; font-size:13.5px; line-height:1.6; margin:0;">
          Pemeriksaan berkala armada forklift gudang logistik, thermovision panel distribusi LVMDP industri manufaktur, riksa uji bejana reaksi kimia petrokimia, dan overhead crane pabrik peleburan nikel/baja.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- FAQ SECTION -->
<section style="padding: 50px 0; background: #fff;">
  <div class="container">
    <div style="text-align:center; max-width:700px; margin:0 auto 36px;">
      <span style="color:#c2410c; font-weight:700; font-size:13px; text-transform:uppercase; letter-spacing:.08em;">Pertanyaan Umum</span>
      <h2 style="font-size:clamp(22px, 3vw, 30px); color:#0f172a; font-weight:800; margin:6px 0 0;">
        FAQ Seputar Jasa Riksa Uji K3
      </h2>
    </div>

    <div style="max-width:840px; margin:0 auto; display:flex; flex-direction:column; gap:14px;">
      <details style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:10px; padding:16px 20px;">
        <summary style="font-weight:700; color:#0f172a; cursor:pointer; font-size:15.5px;">Berapa lama proses riksa uji hingga Surat Keterangan (Suket) terbit?</summary>
        <p style="margin:12px 0 0; color:#475569; font-size:14px; line-height:1.6;">
          Pelaksanaan pengujian fisik di lapangan biasanya memerlukan waktu 1–2 hari kerja per batch peralatan. Laporan Hasil Uji (LHU) teknis kami selesaikan dalam 3–5 hari kerja. Proses verifikasi berkas hingga penerbitan Suket resmi dari Dinas Tenaga Kerja setempat rata-rata memakan waktu 14–21 hari kerja tergantung antrean sistem koordinasi instansi berwenang.
        </p>
      </details>

      <details style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:10px; padding:16px 20px;">
        <summary style="font-weight:700; color:#0f172a; cursor:pointer; font-size:15.5px;">Faktor apa saja yang mempengaruhi biaya penawaran jasa riksa uji?</summary>
        <p style="margin:12px 0 0; color:#475569; font-size:14px; line-height:1.6;">
          Biaya jasa riksa uji dipengaruhi oleh: (1) Jenis dan tonase/kapasitas alat, (2) Jumlah unit alat yang diuji dalam satu lokasi (pengujian multi-unit sekaligus mendapatkan tarif batch lebih hemat), (3) Lokasi geografis pabrik/site untuk perhitungan akomodasi tim ahli, dan (4) Kebutuhan pengujian khusus seperti NDT lanjutan atau penyewaan beban uji (load bank/water bag).
        </p>
      </details>

      <details style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:10px; padding:16px 20px;">
        <summary style="font-weight:700; color:#0f172a; cursor:pointer; font-size:15.5px;">Bagaimana jika saat pengujian ditemukan komponen alat yang tidak laik?</summary>
        <p style="margin:12px 0 0; color:#475569; font-size:14px; line-height:1.6;">
          Tim Tenaga Ahli K3 Spesialis kami akan menerbitkan Formulir Lembar Rekomendasi Teknis (Punch List). Perusahaan diberikan masa toleransi untuk melakukan perbaikan, penggantian spare part, atau penyetelan ulang sebelum dilakukan re-inspeksi untuk memastikan keselamatan sebelum diajukan ke dinas ketenagakerjaan.
        </p>
      </details>

      <details style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:10px; padding:16px 20px;">
        <summary style="font-weight:700; color:#0f172a; cursor:pointer; font-size:15.5px;">Apakah sertifikasi riksa uji ini sah untuk audit SMK3, ISO, dan CSMS Pertamina?</summary>
        <p style="margin:12px 0 0; color:#475569; font-size:14px; line-height:1.6;">
          100% sah dan diakui. Seluruh proses pemeriksaan dipimpin oleh PJK3 berpenunjukan resmi Kemnaker RI dan ditandatangani oleh Pengawas Ketenagakerjaan Spesialis K3, sehingga memenuhi seluruh kriteria audit kepatuhan hukum SMK3 PP 50/2012, ISO 45001, audit CSMS BUMN, dan inspeksi Ketenagakerjaan.
        </p>
      </details>
    </div>
  </div>
</section>

<!-- BOTTOM CTA -->
<section style="background:#07192f; color:#fff; padding:50px 0; text-align:center; border-top:1px solid #1e293b;">
  <div class="container">
    <h2 style="color:#fff; font-size:26px; margin:0 0 12px; font-weight:800;">Pastikan Seluruh Mesin &amp; Instalasi Perusahaan Anda Berizin Resmi</h2>
    <p style="color:#cbd5e1; font-size:15.5px; max-width:640px; margin:0 auto 24px;">
      Hindari sanksi hukum dan risiko kecelakaan kerja fatal. Konsultasikan jadwal riksa uji dan permintaan proposal resmi dengan Technical Advisor Wahana Totalita hari ini.
    </p>
    <a href="<?= $default_wa_url ?>" class="ru-btn-wa" target="_blank" rel="noopener" style="font-size:16px; padding:15px 32px;">
      Minta Penawaran Riksa Uji via WhatsApp
    </a>
  </div>
</section>

<?php require dirname(__DIR__) . '/includes/footer.php'; ?>
<script src="/assets/js/main.js" defer></script>
</body>
</html>
