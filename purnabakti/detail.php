<?php
/**
 * purnabakti/detail.php — Dedicated Program & Syllabus Page for Pelatihan Masa Persiapan Pensiun (MPP)
 * URL: /purnabakti/{slug}/
 */
require_once dirname(__DIR__) . '/config.php';
require_once dirname(__DIR__) . '/includes/purnabakti-data.php';

$slug = trim($_GET['slug'] ?? '');
if (!$slug) {
    header('Location: ' . SITE_URL . '/purnabakti/', true, 301);
    exit;
}

$item = get_purnabakti_item($slug);
if (!$item) {
    http_response_code(404);
    include dirname(__DIR__) . '/404.php';
    exit;
}

$s = get_all_settings();
$wa_number = preg_replace('/\D/', '', get_setting('wa_number', '6287759151278'));

$canonical = SITE_URL . '/purnabakti/' . $item['slug'] . '/';

$meta_title = $item['meta_title'] . ' | Wahana Totalita';
$meta_desc  = $item['meta_desc'];

// WhatsApp Lead Generation Message
$wa_lead_msg = "Halo Wahana Totalita, saya dari tim HR / Manajemen. Kami tertarik dengan silabus: {$item['judul']}. Mohon kirimkan proposal teknis & penawaran biaya resminya.";
$wa_lead_url = "https://wa.me/{$wa_number}?text=" . rawurlencode($wa_lead_msg);

// Related programs
$related_items = get_related_purnabakti_items($item['slug'], $item['kategori'], 3);

// Structured Data FAQs
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
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Pelatihan Purnabakti (MPP)', 'item' => SITE_URL . '/purnabakti/'],
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
        'serviceType'  => 'Executive Retirement Preparation & Corporate Training',
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
/* Purnabakti Detail Styles */
.mpp-detail-hero {
  background: linear-gradient(135deg, #091e36 0%, #102d4f 50%, #0d2238 100%);
  color: #fff;
  padding: 50px 0 44px;
  border-bottom: 4px solid #f59e0b;
}
.mpp-detail-hero .badge {
  display: inline-block;
  background: rgba(245, 158, 11, 0.16);
  border: 1px solid rgba(245, 158, 11, 0.45);
  color: #fde68a;
  font-size: 12.5px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: .06em;
  padding: 5px 12px;
  border-radius: 6px;
  margin-bottom: 14px;
}
.mpp-detail-hero h1 {
  font-size: clamp(24px, 3.6vw, 38px);
  font-weight: 800;
  line-height: 1.25;
  color: #fff;
  margin: 0 0 16px;
}
.mpp-detail-hero p.tagline {
  font-size: clamp(15px, 1.8vw, 17px);
  color: #e2e8f0;
  max-width: 820px;
  line-height: 1.6;
  margin-bottom: 24px;
}
.mpp-meta-strip {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
  background: rgba(255,255,255,0.06);
  border: 1px solid rgba(255,255,255,0.12);
  border-radius: 12px;
  padding: 18px 22px;
  margin-bottom: 24px;
}
.mpp-meta-item {
  flex: 1;
  min-width: 200px;
}
.mpp-meta-item span.lbl {
  display: block;
  font-size: 11.5px;
  color: #94a3b8;
  text-transform: uppercase;
  letter-spacing: .05em;
  margin-bottom: 4px;
}
.mpp-meta-item strong {
  font-size: 15px;
  color: #fff;
  font-weight: 700;
}
.mpp-meta-item strong.price {
  color: #34d399;
  font-size: 17px;
}

/* Content Layout */
.mpp-layout {
  display: grid;
  grid-template-columns: 1fr 340px;
  gap: 40px;
  padding: 48px 0 60px;
}
@media (max-width: 991px) {
  .mpp-layout {
    grid-template-columns: 1fr;
  }
}

.mpp-body {
  font-size: 15.5px;
  line-height: 1.8;
  color: #334155;
}
.mpp-body h2 {
  font-size: 24px;
  font-weight: 800;
  color: #0f172a;
  margin: 36px 0 14px;
  padding-bottom: 8px;
  border-bottom: 2px solid #e2e8f0;
}
.mpp-body h3 {
  font-size: 19px;
  font-weight: 800;
  color: #0f172a;
  margin: 28px 0 12px;
}
.mpp-body p {
  margin-bottom: 18px;
  white-space: pre-line;
}

/* Table Styles */
.mpp-syllabus-table {
  width: 100%;
  border-collapse: collapse;
  margin: 24px 0 32px;
  background: #fff;
  border: 1px solid #e2e8f0;
  border-radius: 10px;
  overflow: hidden;
  font-size: 14px;
}
.mpp-syllabus-table th {
  background: #091e36;
  color: #fff;
  padding: 12px 16px;
  text-align: left;
  font-weight: 700;
  font-size: 13px;
}
.mpp-syllabus-table td {
  padding: 14px 16px;
  border-bottom: 1px solid #f1f5f9;
  vertical-align: top;
  color: #334155;
}
.mpp-syllabus-table tr:hover td {
  background: #f8fafc;
}

/* Itinerary List */
.mpp-rundown-box {
  background: #f8fafc;
  border: 1px solid #e2e8f0;
  border-radius: 12px;
  padding: 24px;
  margin: 24px 0 32px;
}
.mpp-rundown-item {
  display: flex;
  gap: 16px;
  margin-bottom: 18px;
  padding-bottom: 18px;
  border-bottom: 1px dashed #cbd5e1;
}
.mpp-rundown-item:last-child {
  margin-bottom: 0;
  padding-bottom: 0;
  border-bottom: none;
}
.mpp-day-badge {
  background: #091e36;
  color: #fde68a;
  font-weight: 800;
  font-size: 13px;
  padding: 6px 12px;
  border-radius: 8px;
  height: fit-content;
  white-space: nowrap;
}
.mpp-rundown-content h4 {
  margin: 0 0 6px;
  font-size: 15.5px;
  color: #0f172a;
}
.mpp-rundown-content p {
  margin: 0;
  font-size: 14px;
  color: #475569;
  line-height: 1.6;
}

/* Sidebar Widgets */
.mpp-sidebar-card {
  background: #fff;
  border: 1px solid #e2e8f0;
  border-radius: 14px;
  padding: 24px;
  margin-bottom: 24px;
  box-shadow: 0 4px 14px rgba(0,0,0,0.03);
}
.mpp-sidebar-card h3 {
  font-size: 17.5px;
  font-weight: 800;
  color: #0f172a;
  margin: 0 0 14px;
}
.mpp-sidebar-card p {
  font-size: 13.5px;
  color: #64748b;
  line-height: 1.6;
  margin-bottom: 16px;
}
.mpp-sidebar-price {
  background: #f8fafc;
  border-radius: 10px;
  padding: 14px;
  margin-bottom: 18px;
  border: 1px solid #e2e8f0;
}
.mpp-sidebar-price .lbl {
  font-size: 12px;
  color: #64748b;
  text-transform: uppercase;
}
.mpp-sidebar-price .val {
  font-size: 20px;
  font-weight: 800;
  color: #0A4A2E;
  margin: 4px 0 0;
}
.mpp-btn-full-wa {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  background: #25D366;
  color: #fff;
  font-weight: 700;
  font-size: 15px;
  padding: 12px 18px;
  border-radius: 10px;
  text-decoration: none;
  width: 100%;
  box-sizing: border-box;
  transition: all .2s;
}
.mpp-btn-full-wa:hover {
  background: #20ba5a;
  color: #fff;
}
.mpp-b2b-badge-box {
  background: #eff6ff;
  border: 1px solid #bfdbfe;
  border-radius: 10px;
  padding: 14px;
  font-size: 13px;
  color: #1e40af;
  margin-top: 16px;
  line-height: 1.5;
}
</style>
</head>
<body>

<?php require dirname(__DIR__) . '/includes/navbar.php'; ?>

<!-- HERO -->
<section class="mpp-detail-hero">
  <div class="container">
    <div style="font-size:13px; color:#cbd5e1; margin-bottom:12px;">
      <a href="/" style="color:#cbd5e1; text-decoration:none;">Beranda</a> &rsaquo; 
      <a href="/purnabakti/" style="color:#cbd5e1; text-decoration:none;">Pelatihan Purnabakti (MPP)</a> &rsaquo; 
      <span style="color:#fbbf24;"><?= htmlspecialchars($item['kategori_label']) ?></span>
    </div>

    <span class="badge"><?= htmlspecialchars($item['kategori_label']) ?></span>
    <h1><?= htmlspecialchars($item['judul']) ?></h1>
    <p class="tagline"><?= htmlspecialchars($item['tagline']) ?></p>

    <div class="mpp-meta-strip">
      <div class="mpp-meta-item">
        <span class="lbl">Durasi Program</span>
        <strong><?= htmlspecialchars($item['durasi_program']) ?></strong>
      </div>
      <div class="mpp-meta-item">
        <span class="lbl">Lokasi Utama</span>
        <strong><?= htmlspecialchars($item['lokasi_utama']) ?></strong>
      </div>
      <div class="mpp-meta-item">
        <span class="lbl">Investasi Perorangan</span>
        <strong class="price"><?= htmlspecialchars($item['biaya_standar']) ?></strong>
      </div>
      <div class="mpp-meta-item">
        <span class="lbl">Investasi All-In (+ Pasangan)</span>
        <strong class="price"><?= htmlspecialchars($item['biaya_batch']) ?></strong>
      </div>
    </div>

    <div>
      <a href="<?= $wa_lead_url ?>" class="btn btn-primary" target="_blank" rel="noopener" style="background:#25D366; border-color:#25D366; font-weight:700; padding:12px 24px;">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" style="vertical-align:middle; margin-right:6px;"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
        Minta Proposal &amp; Penawaran Resmi HR
      </a>
      <a href="#silabus" class="btn btn-secondary" style="background:rgba(255,255,255,0.1); border:1px solid rgba(255,255,255,0.3); color:#fff; padding:12px 20px; margin-left:10px;">
        Lihat Silabus Rinci &darr;
      </a>
    </div>
  </div>
</section>

<!-- MAIN BODY -->
<div class="container">
  <div class="mpp-layout">
    
    <!-- LEFT COLUMN: ARTICLE & SYLLABUS -->
    <main class="mpp-body">
      <h2>Urgensi &amp; Latar Belakang Program</h2>
      <p><?= htmlspecialchars($item['deskripsi_lengkap']) ?></p>

      <h2>Profil Sasaran Peserta</h2>
      <p>
        Program ini diformulasikan secara khusus untuk: <strong><?= htmlspecialchars($item['target_peserta']) ?></strong>.
      </p>
      <div style="background:#f8fafc; border-left:4px solid #f59e0b; padding:16px 20px; border-radius:0 8px 8px 0; margin-bottom:24px;">
        <h4 style="margin:0 0 8px; color:#0f172a; font-size:15px;">Kesiapan Lintas Perusahaan &amp; Institusi:</h4>
        <p style="margin:0; font-size:14px; color:#475569;">
          Telah dipercaya oleh delegasi dari BUMN ternama seperti <strong><?= implode(', ', $item['companies_mentions']) ?></strong> serta instansi pemerintah daerah dari berbagai kota termasuk <strong><?= implode(', ', $item['city_mentions']) ?></strong>.
        </p>
      </div>

      <h2 id="silabus">Silabus &amp; Modul Pembelajaran Komprehensif</h2>
      <p>
        Materi disusun secara terstruktur dengan pendekatan partisipatif, studi kasus, simulasi finansial, dan praktik lapangan berbobot:
      </p>

      <table class="mpp-syllabus-table">
        <thead>
          <tr>
            <th style="width:28%;">Mata Pelatihan</th>
            <th style="width:18%;">Durasi</th>
            <th style="width:34%;">Fokus Pembahasan</th>
            <th style="width:20%;">Output Peserta</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($item['silabus_modul'] as $mod): ?>
          <tr>
            <td><strong><?= htmlspecialchars($mod['modul']) ?></strong></td>
            <td><span style="display:inline-block; background:#eff6ff; color:#1d4ed8; padding:3px 8px; border-radius:6px; font-weight:700; font-size:12px;"><?= htmlspecialchars($mod['durasi']) ?></span></td>
            <td><?= htmlspecialchars($mod['fokus']) ?></td>
            <td><strong><?= htmlspecialchars($mod['output']) ?></strong></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <?php if (!empty($item['jadwal_rundown'])): ?>
      <h2>Susunan Acara (Rundown Kegiatan)</h2>
      <p>
        Gambaran jadwal pelaksanaan harian yang seimbang antara pembekalan di kelas hotel berbintang dengan kesegaran kunjungan lapangan:
      </p>
      <div class="mpp-rundown-box">
        <?php foreach ($item['jadwal_rundown'] as $day => $desc): ?>
        <div class="mpp-rundown-item">
          <div class="mpp-day-badge"><?= htmlspecialchars($day) ?></div>
          <div class="mpp-rundown-content">
            <p><?= htmlspecialchars($desc) ?></p>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>

      <?php if (!empty($item['kunjungan_lapangan'])): ?>
      <h2>Studi Lapangan Nyata (Living Laboratory Yogyakarta)</h2>
      <p>
        Peserta diajak melihat, menyentuh, dan berdiskusi langsung dengan para pengusaha purnawirawan di unit bisnis nyata:
      </p>
      <ul style="padding-left:20px; line-height:1.7; margin-bottom:28px;">
        <?php foreach ($item['kunjungan_lapangan'] as $visit): ?>
        <li style="margin-bottom:8px; font-weight:600; color:#0f172a;"><?= htmlspecialchars($visit) ?></li>
        <?php endforeach; ?>
      </ul>
      <?php endif; ?>

      <h2>Fasilitas &amp; Logistik Eksekutif</h2>
      <p>
        Demi menjaga kenyamanan para purnawirawan senior dan pasangannya, seluruh paket penyelenggaraan telah mencakup:
      </p>
      <div style="background:#fff; border:1px solid #e2e8f0; border-radius:12px; padding:22px; margin-bottom:32px;">
        <ul style="margin:0; padding-left:20px; line-height:1.7;">
          <?php foreach ($item['fasilitas_include'] as $fas): ?>
          <li style="margin-bottom:8px; color:#334155;"><?= htmlspecialchars($fas) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>

      <!-- FAQ SECTION -->
      <h2>Pertanyaan Kerap Diajukan (FAQ)</h2>
      <div style="display:flex; flex-direction:column; gap:12px; margin-bottom:36px;">
        <?php foreach ($item['faqs'] as $faq): ?>
        <details style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:8px; padding:14px 18px;">
          <summary style="font-weight:700; color:#0f172a; cursor:pointer; font-size:15px;"><?= htmlspecialchars($faq['q']) ?></summary>
          <p style="margin:10px 0 0; color:#475569; font-size:14px; line-height:1.6;"><?= htmlspecialchars($faq['a']) ?></p>
        </details>
        <?php endforeach; ?>
      </div>

    </main>

    <!-- RIGHT COLUMN: SIDEBAR -->
    <aside>
      <div class="mpp-sidebar-card" style="position:sticky; top:24px;">
        <span style="color:#b45309; font-weight:700; font-size:12px; text-transform:uppercase; letter-spacing:.08em;">Estimasi Anggaran</span>
        <h3 style="margin-top:4px;">Pengajuan Proposal B2B</h3>

        <div class="mpp-sidebar-price">
          <div class="lbl">Paket Standar Perorangan:</div>
          <div class="val"><?= htmlspecialchars($item['biaya_standar']) ?></div>
        </div>

        <div class="mpp-sidebar-price" style="background:#fef3c7; border-color:#fde68a;">
          <div class="lbl" style="color:#92400e;">Paket All-In (+ Pasangan):</div>
          <div class="val" style="color:#b45309;"><?= htmlspecialchars($item['biaya_batch']) ?></div>
        </div>

        <p>
          Bisa disesuaikan dengan Term of Reference (TOR/KAK) instansi, tanggal khusus perusahaan, dan pemilihan hotel berbintang di Yogyakarta.
        </p>

        <a href="<?= $wa_lead_url ?>" class="mpp-btn-full-wa" target="_blank" rel="noopener">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
          Minta Penawaran Resmi
        </a>

        <div class="mpp-b2b-badge-box">
          <strong>Kepatuhan B2B &amp; B2G:</strong>
          <br>&bull; SPK &amp; BAST Legal Bermeterai
          <br>&bull; Terdaftar LPSE &amp; PADI UMKM
          <br>&bull; Faktur Pajak PPh 23 / PPN Sah
          <br>&bull; Laporan Kegiatan &amp; Dokumentasi HC
        </div>

        <div style="margin-top:24px; padding-top:20px; border-top:1px solid #e2e8f0;">
          <h4 style="font-size:14px; font-weight:800; color:#0f172a; margin:0 0 10px;">Program Terkait Lainnya:</h4>
          <ul style="list-style:none; padding:0; margin:0; font-size:13.5px; line-height:1.6;">
            <?php foreach ($related_items as $rel): ?>
            <li style="margin-bottom:8px;">
              <a href="/purnabakti/<?= htmlspecialchars($rel['slug']) ?>/" style="color:#091e36; text-decoration:none; font-weight:600;">
                &rarr; <?= htmlspecialchars($rel['judul']) ?>
              </a>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </aside>

  </div>
</div>

<!-- BOTTOM CTA -->
<section style="background:#091e36; color:#fff; padding:50px 0; text-align:center; border-top:1px solid #1e293b;">
  <div class="container">
    <h2 style="color:#fff; font-size:26px; margin:0 0 12px; font-weight:800;">Persiapkan Masa Purna Tugas Insan Terbaik Anda</h2>
    <p style="color:#cbd5e1; font-size:15.5px; max-width:640px; margin:0 auto 24px; line-height:1.6;">
      Dapatkan draf proposal silabus lengkap, rincian biaya resmi, dan simulasi jadwal pelaksanaan di Yogyakarta hari ini.
    </p>
    <a href="<?= $wa_lead_url ?>" class="btn btn-primary" target="_blank" rel="noopener" style="background:#25D366; border-color:#25D366; font-size:16px; padding:14px 30px; font-weight:700;">
      Hubungi Tim Konsultan via WhatsApp
    </a>
  </div>
</section>

<?php require dirname(__DIR__) . '/includes/footer.php'; ?>
<script src="/assets/js/main.js" defer></script>
</body>
</html>
