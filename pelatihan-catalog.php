<?php
/**
 * pelatihan-catalog.php — training catalog listing (/pelatihan/, no slug).
 * Included by pelatihan.php when get_url_slug() is empty. Fixes the
 * pre-existing 403: no rewrite rule matched a bare /pelatihan/ request
 * (all slug rules require 1+ char) and the directory itself has
 * Options -Indexes with no index file, so Apache returned 403 before
 * PHP ever ran. This file gives that URL real content instead of a
 * redirect to home, using the get_categories()/get_trainings() helpers
 * already defined in config.php (built for exactly this, never called
 * with an empty $cat_slug until now).
 *
 * 2026-07-28: rebuilt using the site's existing sitewide components
 * (.stats-bar, .section-services glass cards, .catalog-search-wrap +
 * .filter-bar, .section-faq accordion — all already defined in
 * style.css/additions.css and used on the homepage) instead of one-off
 * plain boxes, to match the rest of the site's visual quality and
 * close the dead vertical space the old flat layout left behind.
 */
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/hub-category-map.php';

$categories = get_categories();
$s          = get_all_settings();
$wa_number  = $s['wa_number'] ?? '6287759151278';

$meta_title = 'Katalog Pelatihan K3 Resmi Kemnaker & BNSP | Wahana Totalita';
$meta_desc  = 'Katalog lengkap pelatihan K3 resmi Kemnaker RI & BNSP: Ahli K3 Umum, alat berat, lingkungan & ISO. Kelas online & offline batch terdekat. Daftar via WhatsApp!';
$page_url   = SITE_URL . '/pelatihan/';


// Build category groups up front so empty categories are skipped cleanly.
$groups = [];
foreach ($categories as $cat) {
    $trainings = get_trainings($cat['slug']);
    if ($trainings) {
        $groups[] = ['cat' => $cat, 'trainings' => $trainings];
    }
}

// Real counts — computed live every load, never hardcoded, so this
// stays accurate as the catalog grows without needing a content edit.
$totalPrograms   = array_sum(array_map(fn($g) => count($g['trainings']), $groups));
$totalCategories = count($groups);

// Hub-directory cards — 4 known accent colors match the special hover
// glow selectors already defined in style.css's "SHINING GLASS" block
// for .section-services .service-card, so these get the bonus glow.
$hubIcons  = ['k3' => '🦺', 'system-management' => '📋', 'lingkungan' => '🌱', 'mining' => '⛏️'];
$hubAccent = ['k3' => '#22C55E', 'system-management' => '#3B82F6', 'lingkungan' => '#F59E0B', 'mining' => '#E8611A'];

// ─────────────────────────────────────────────────────────────────────
// Catalog-level FAQ — this page's job is the broad, "show me everything
// you have" searches from Search Console (kursus online k3, pelatihan
// k3 terdekat, biaya pelatihan k3, inhouse training k3, dll) — NOT the
// specific-certification searches (confined space, forklift, ahli k3
// umum, dll), which belong on their own hub/training pages. Keeping
// this page's keyword focus narrow to "catalog-level intent" avoids
// cannibalizing rankings the hub/training pages are already targeting.
// ─────────────────────────────────────────────────────────────────────
$catalogFaqs = [
    ['q' => 'Apakah pelatihan K3 di Wahana Totalita tersedia secara online?', 'a' => 'Ya. Sebagian besar program kami tersedia dalam mode online (kelas virtual langsung, bukan rekaman), dan sebagian lain offline/tatap muka di Yogyakarta atau in-house di lokasi perusahaan Anda. Mode masing-masing program tertera pada setiap kartu pelatihan di katalog ini.'],
    ['q' => 'Berapa biaya pelatihan K3?', 'a' => 'Biaya bervariasi tergantung jenis sertifikasi (Kemnaker RI atau BNSP), durasi program, dan mode pelaksanaan (online, offline, atau in-house). Harga per program tertera langsung di setiap kartu katalog — hubungi kami via WhatsApp untuk penawaran khusus kelompok atau perusahaan.'],
    ['q' => 'Apakah tersedia pelatihan in-house untuk perusahaan?', 'a' => 'Ya, kami menyediakan pelatihan in-house yang dapat diselenggarakan langsung di lokasi perusahaan Anda di seluruh Indonesia, disesuaikan dengan jadwal dan kebutuhan spesifik tim Anda — termasuk untuk grup dengan jumlah peserta besar.'],
    ['q' => 'Apakah pelatihan ini bisa diikuti peserta di luar Yogyakarta?', 'a' => 'Bisa. Program online dapat diikuti dari kota mana saja di Indonesia, dan program in-house dapat diselenggarakan langsung di lokasi perusahaan Anda. Untuk program offline yang diadakan di Yogyakarta, kami juga membantu info akomodasi bagi peserta luar kota.'],
    ['q' => 'Bagaimana cara memilih pelatihan K3 yang tepat untuk saya atau tim saya?', 'a' => 'Pemilihan tergantung kebutuhan: kewajiban regulasi perusahaan (misalnya SMK3 untuk perusahaan ≥100 karyawan), jenis risiko kerja spesifik (kimia, ketinggian, ruang terbatas, alat berat, dll), atau syarat sertifikasi untuk tender/proyek tertentu. Tim kami siap membantu konsultasi gratis via WhatsApp untuk merekomendasikan program yang sesuai.'],
    ['q' => 'Apakah sertifikat dari pelatihan ini diakui secara nasional?', 'a' => 'Ya. Sertifikat Kemnaker RI dan BNSP yang diterbitkan melalui lembaga terakreditasi berlaku secara nasional di seluruh Indonesia, termasuk untuk keperluan tender pemerintah dan proyek BUMN/swasta.'],
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($meta_title) ?></title>
<meta name="description" content="<?= e($meta_desc) ?>">
<link rel="canonical" href="<?= e($page_url) ?>">

<meta property="og:type"        content="website">
<meta property="og:title"       content="<?= e($meta_title) ?>">
<meta property="og:description" content="<?= e($meta_desc) ?>">
<meta property="og:url"         content="<?= e($page_url) ?>">
<meta property="og:site_name"   content="<?= e($s['site_name'] ?? 'Wahana Totalita Konsultan') ?>">
<meta property="og:locale"      content="id_ID">
<meta name="theme-color"        content="<?= e(is_valid_hex($s['theme_color_primary'] ?? '') ? $s['theme_color_primary'] : '#103A5C') ?>">
<meta name="robots"             content="index,follow">
<link rel="manifest" href="/manifest.json">

<?php if (!empty($s['gtm_id'])): ?>
<script>
window.dataLayer = window.dataLayer || [];
function initGTM() {
  (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','<?= e($s['gtm_id']) ?>');
}
if ('requestIdleCallback' in window) {
  requestIdleCallback(initGTM, { timeout: 3000 });
} else {
  window.addEventListener('load', initGTM, { passive: true });
}
</script>
<?php endif; ?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preload" as="style" href="<?= theme_font_url($s) ?>">
<link rel="stylesheet" href="<?= theme_font_url($s) ?>" media="print" onload="this.media='all'">
<noscript>
  <link rel="stylesheet" href="<?= theme_font_url($s) ?>">
</noscript>
<style><?php
$_core_css_file = __DIR__ . '/assets/css/core.min.css';
if (is_file($_core_css_file)) {
    readfile($_core_css_file);
} else {
    readfile(__DIR__ . '/assets/css/tokens.css');
    readfile(__DIR__ . '/assets/css/core.css');
}
?></style>
<link rel="stylesheet" href="<?= asset_v('/assets/css/components.min.css') ?>" media="print" onload="this.media='all'">
<noscript><link rel="stylesheet" href="<?= asset_v('/assets/css/components.min.css') ?>"></noscript>
<?= theme_css_vars($s) ?>

<script type="application/ld+json"><?= json_encode([
    '@context' => 'https://schema.org',
    '@type'    => 'BreadcrumbList',
    'itemListElement' => [
        ['@type'=>'ListItem','position'=>1,'name'=>'Beranda','item'=>SITE_URL.'/'],
        ['@type'=>'ListItem','position'=>2,'name'=>'Pelatihan','item'=>$page_url],
    ]
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?></script>
<?php if (!empty($catalogFaqs)): ?>
<script type="application/ld+json"><?= json_encode([
    '@context'   => 'https://schema.org',
    '@type'      => 'FAQPage',
    'mainEntity' => array_map(fn($f) => [
        '@type' => 'Question', 'name' => $f['q'],
        'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']],
    ], $catalogFaqs),
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?></script>
<?php endif; ?>
<style>
.breadcrumb-list { list-style: none; padding-left: 0; }

/* Compact catalog hero — intentionally NOT .hero (that class is the
   homepage's 100vh slideshow hero elsewhere on this site); this is its
   own small banner so it can't inherit that min-height. */
.pcat-hero { background: var(--green-light, #E8F4EE); padding: 44px 0 40px; text-align: center; }
.pcat-hero h1 { font-size: clamp(1.7rem, 4vw, 2.4rem); font-weight: 800; color: var(--green, #0A4A2E); margin-bottom: 10px; }
.pcat-hero p { font-size: 15px; color: var(--text-muted, #555); max-width: 640px; margin: 0 auto 20px; line-height: 1.7; }
.pcat-badges { display: flex; flex-wrap: wrap; gap: 8px; justify-content: center; }
.pcat-badge { display: inline-flex; align-items: center; gap: 6px; background: #fff; border: 1.5px solid #d0e8d8; color: var(--green, #0A4A2E); font-size: 12.5px; font-weight: 700; padding: 7px 15px; border-radius: 20px; }

/* Category directory intro line inside the services section */
.pcat-dir-intro { text-align: center; max-width: 760px; margin: 0 auto 8px; color: var(--text-muted, #555); font-size: 14.5px; line-height: 1.7; }

.pcat-filter-row { display: flex; flex-direction: column; align-items: center; padding: 24px 0 8px; }

/* Quick Category Filter Pills */
.pcat-cat-pills-wrap { display: flex; justify-content: center; gap: 8px; flex-wrap: wrap; margin-bottom: 14px; width: 100%; max-width: 820px; }
.pcat-cat-pill { padding: 8px 18px; border-radius: 999px; border: 1.5px solid #d0e8d8; background: #fff; color: #334155; font-size: 13px; font-weight: 600; cursor: pointer; transition: all .2s; }
.pcat-cat-pill:hover { border-color: var(--green, #0A4A2E); color: var(--green, #0A4A2E); }
.pcat-cat-pill.active { background: var(--green, #0A4A2E); color: #fff; border-color: var(--green, #0A4A2E); box-shadow: 0 2px 8px rgba(10,74,46,0.25); }

/* Comparison Kemnaker vs BNSP */
.pcat-compare-section { padding: 48px 0; background: #ffffff; border-bottom: 1px solid #e8e8e8; }
.pcat-compare-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-top: 24px; }
@media (max-width: 768px) { .pcat-compare-grid { grid-template-columns: 1fr; } }
.pcat-compare-card { border-radius: 14px; padding: 26px; border: 1.5px solid #e2e8f0; background: #fafcff; display: flex; flex-direction: column; transition: transform .2s, box-shadow .2s; }
.pcat-compare-card:hover { transform: translateY(-3px); box-shadow: 0 10px 24px rgba(0,0,0,0.06); }
.pcat-compare-kemnaker { border-top: 4px solid var(--green, #0A4A2E); }
.pcat-compare-bnsp { border-top: 4px solid #0284c7; }
.pcat-comp-tag { display: inline-block; font-size: 11.5px; font-weight: 700; text-transform: uppercase; padding: 4px 10px; border-radius: 6px; margin-bottom: 12px; align-self: flex-start; }
.tag-kemnaker { background: #dcfce7; color: #166534; }
.tag-bnsp { background: #e0f2fe; color: #0369a1; }
.pcat-compare-card h3 { font-size: 1.25rem; font-weight: 800; color: #0f172a; margin: 0 0 10px; }
.pcat-compare-card p { font-size: 14px; color: #475569; line-height: 1.6; margin-bottom: 16px; }
.pcat-comp-points { list-style: none; padding: 0; margin: 0 0 20px; display: flex; flex-direction: column; gap: 9px; font-size: 13.5px; color: #334155; }
.pcat-comp-points li { display: flex; align-items: flex-start; gap: 8px; line-height: 1.5; }

/* 4 Steps Process */
.pcat-steps-section { padding: 54px 0; background: #f8fafc; border-bottom: 1px solid #e2e8f0; }
.pcat-steps-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-top: 28px; }
.pcat-step-card { background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; position: relative; display: flex; flex-direction: column; box-shadow: 0 2px 8px rgba(0,0,0,0.03); }
.pcat-step-num { width: 34px; height: 34px; border-radius: 50%; background: var(--green, #0A4A2E); color: #fff; font-weight: 800; font-size: 14px; display: flex; align-items: center; justify-content: center; margin-bottom: 14px; }
.pcat-step-card h3 { font-size: 1.05rem; font-weight: 700; color: #0f172a; margin: 0 0 8px; }
.pcat-step-card p { font-size: 13.5px; color: #64748b; line-height: 1.55; margin: 0; }

/* In-House B2B Banner */
.pcat-b2b-box { background: linear-gradient(135deg, #092015 0%, #0F3826 100%); color: #fff; border-radius: 16px; padding: 36px 40px; margin: 48px auto; max-width: 1060px; box-shadow: 0 16px 36px rgba(10,74,46,0.15); border: 1px solid rgba(255,255,255,0.1); }
.pcat-b2b-inner { display: grid; grid-template-columns: 1.4fr 1fr; gap: 36px; align-items: center; }
@media (max-width: 800px) { .pcat-b2b-inner { grid-template-columns: 1fr; gap: 24px; } .pcat-b2b-box { padding: 28px 20px; } }
.pcat-b2b-box h2 { font-size: clamp(1.4rem, 2.5vw, 1.85rem); font-weight: 800; margin: 0 0 10px; color: #fff; }
.pcat-b2b-box p { font-size: 14px; line-height: 1.65; color: #bbf7d0; margin-bottom: 18px; }
.pcat-b2b-features { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 10px; font-size: 13.5px; }
.pcat-b2b-features li { display: flex; align-items: center; gap: 10px; color: #f0fdf4; }
.pcat-b2b-features li span { color: #4ade80; font-weight: 700; }
.pcat-b2b-actions { display: flex; flex-direction: column; gap: 12px; align-items: flex-start; }
@media (max-width: 800px) { .pcat-b2b-actions { align-items: stretch; } }
.btn-b2b-wa { display: inline-flex; align-items: center; justify-content: center; gap: 8px; background: #25D366; color: #fff !important; padding: 13px 24px; border-radius: 10px; font-weight: 700; font-size: 14px; text-decoration: none; box-shadow: 0 4px 16px rgba(37,211,102,0.3); transition: all .2s; }
.btn-b2b-wa:hover { background: #20ba5a; transform: translateY(-2px); }

/* Trust Pillars Grid */
.pcat-trust-section { padding: 48px 0; background: #ffffff; border-top: 1px solid #e2e8f0; }
.pcat-trust-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(230px, 1fr)); gap: 20px; margin-top: 24px; }
.pcat-trust-item { display: flex; gap: 14px; align-items: flex-start; padding: 18px; border-radius: 12px; background: #f8fafc; border: 1px solid #e2e8f0; }
.pcat-trust-icon { font-size: 1.8rem; line-height: 1; flex-shrink: 0; }
.pcat-trust-item h4 { font-size: 14.5px; font-weight: 700; color: #0f172a; margin: 0 0 4px; }
.pcat-trust-item p { font-size: 12.5px; color: #64748b; line-height: 1.5; margin: 0; }

/* Navbar visibility fix: this page's hero is light (pcat-hero), not the
   dark hero the shared navbar assumes by default (transparent bg +
   white text, meant to sit on a dark background). Without this, the
   navbar is invisible until the user scrolls. Mirrors the site's own
   .navbar.on-light-hero rules, scoped here so it doesn't require
   editing the shared includes/navbar.php used on every other page. */
#navbar:not(.scrolled) { background: rgba(255,255,255,.97) !important; border-bottom-color: #e8e8e8 !important; }
#navbar:not(.scrolled) .nav-logo { color: var(--green) !important; }
#navbar:not(.scrolled) .nav-links a { color: var(--text) !important; }
#navbar:not(.scrolled) .nav-logo-text strong {
  background: linear-gradient(135deg, var(--green) 30%, var(--orange));
  -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
}
#navbar:not(.scrolled) .nav-hamburger span { background: var(--text) !important; }
#navbar:not(.scrolled) .nav-socials a { color: var(--text-muted) !important; }
</style>
</head>
<body class="catalog-page">
<div id="scroll-progress" aria-hidden="true"></div>

<?php if (!empty($s['gtm_id'])): ?>
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?= e($s['gtm_id']) ?>" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<?php endif; ?>

<?php require __DIR__ . '/includes/navbar.php'; ?>

<main id="konten-utama">
<div class="breadcrumb-bar">
  <div class="container">
    <nav aria-label="Breadcrumb">
      <ol class="breadcrumb-list">
        <li><a href="/">Beranda</a></li>
        <li aria-hidden="true">›</li>
        <li aria-current="page">Pelatihan</li>
      </ol>
    </nav>
  </div>
</div>

<!-- HERO -->
<section class="pcat-hero">
  <div class="container">
    <h1>Katalog Pelatihan K3 &amp; Sertifikasi Resmi</h1>
    <p>Semua program sertifikasi K3 resmi Kemnaker RI &amp; BNSP — tersedia kelas online, tatap muka di Yogyakarta, maupun in-house training perusahaan di seluruh Indonesia.</p>

    <div class="pcat-badges">
      <span class="pcat-badge">✔ Kemnaker RI &amp; BNSP</span>
      <span class="pcat-badge">✔ Online &amp; Offline</span>
      <span class="pcat-badge">✔ In-house Perusahaan</span>
      <span class="pcat-badge">✔ Seluruh Indonesia</span>
    </div>
  </div>
</section>

<!-- STATS BAR -->
<section class="stats-bar">
  <div class="container stats-inner">
    <div class="stat-item">
      <span class="stat-number"><?= $totalPrograms ?></span>
      <span class="stat-label">Program Aktif</span>
    </div>
    <div class="stat-divider"></div>
    <div class="stat-item">
      <span class="stat-number"><?= $totalCategories ?></span>
      <span class="stat-label">Kategori Pelatihan</span>
    </div>
    <div class="stat-divider"></div>
    <div class="stat-item">
      <span class="stat-number" style="font-size:15px">Kemnaker &amp; BNSP</span>
      <span class="stat-label">Sertifikasi Resmi</span>
    </div>
    <div class="stat-divider"></div>
    <div class="stat-item">
      <span class="stat-number" style="font-size:15px">Online &amp; Offline</span>
      <span class="stat-label">Mode Pelatihan</span>
    </div>
  </div>
</section>

<!-- CATEGORY DIRECTORY (glass service cards — reuses homepage component) -->
<?php if (!empty($HUB_CATEGORY_MAP)): ?>
<section class="section-services">
  <div class="container">
    <div class="section-header">
      <p class="section-eyebrow">Direktori Kategori</p>
      <h2 class="section-title">Kategori Program Pelatihan</h2>
      <p class="pcat-dir-intro">Pilih kategori pelatihan untuk melihat silabus lengkap, jadwal, dan sertifikasi resmi Kemnaker RI &amp; BNSP.</p>
    </div>
    <div class="services-grid">
      <?php $c_idx = 0; foreach ($HUB_CATEGORY_MAP as $catSlug => $hub): $c_idx++; ?>
      <a href="/pelatihan/<?= e($catSlug) ?>/" class="service-card" data-reveal="up" data-reveal-delay="<?= (($c_idx - 1) % 4) + 1 ?>" style="--accent: <?= e($hubAccent[$catSlug] ?? '#0A4A2E') ?>; text-decoration:none;">
        <div class="service-card-icon"><?= $hubIcons[$catSlug] ?? '📄' ?></div>
        <div class="service-card-title"><?= e($hub['hub_name']) ?></div>
        <div class="service-card-desc">Daftar lengkap program pelatihan dan sertifikasi <?= e($hub['hub_name']) ?>.</div>
        <div class="service-card-arrow">→</div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- JALUR SERTIFIKASI: KEMNAKER VS BNSP -->
<section class="pcat-compare-section">
  <div class="container">
    <div class="section-header" style="margin-bottom:20px;">
      <p class="section-eyebrow">Panduan Jalur Sertifikasi</p>
      <h2 class="section-title">Memilih Antara Kemnaker RI dan BNSP</h2>
      <p class="pcat-dir-intro">Pahami perbedaan legalitas, kewajiban regulasi, dan peruntukan sertifikasi agar Anda memilih program yang tepat bagi karir maupun kepatuhan perusahaan.</p>
    </div>
    <div class="pcat-compare-grid">
      <!-- Kemnaker Card -->
      <div class="pcat-compare-card pcat-compare-kemnaker" data-reveal="up" data-reveal-delay="1">
        <span class="pcat-comp-tag tag-kemnaker">Kewajiban Regulasi &amp; Lisensi Legal</span>
        <h3>Sertifikasi Kemnaker RI</h3>
        <p>Diterbitkan langsung melalui Kementerian Ketenagakerjaan RI, menghasilkan Surat Keputusan Penunjukan (SKP) dan Lisensi K3 (SIO/Buku Kerja).</p>
        <ul class="pcat-comp-points">
          <li><span class="icon">✅</span> <span><strong>Wajib Regulasi:</strong> Payung hukum UU No. 1/1970 untuk pemenuhan syarat audit Pengawas Ketenagakerjaan.</span></li>
          <li><span class="icon">✅</span> <span><strong>Output Lisensi:</strong> Mendapatkan SKP dan Kartu Kewenangan Ahli/Operator resmi pemerintah.</span></li>
          <li><span class="icon">✅</span> <span><strong>Contoh Skema:</strong> Ahli K3 Umum Kemnaker, Operator Forklift (Kelas 1 &amp; 2), Damkar (Kelas D/C/B/A), Operator Boiler &amp; Crane.</span></li>
        </ul>
      </div>
      <!-- BNSP Card -->
      <div class="pcat-compare-card pcat-compare-bnsp" data-reveal="up" data-reveal-delay="2">
        <span class="pcat-comp-tag tag-bnsp">Standar Kompetensi Kerja (SKKNI)</span>
        <h3>Sertifikasi BNSP (Badan Nasional Sertifikasi Profesi)</h3>
        <p>Diterbitkan melalui Lembaga Sertifikasi Profesi (LSP) berlisensi BNSP mengacu pada standar unit kompetensi SKKNI nasional.</p>
        <ul class="pcat-comp-points">
          <li><span class="icon">✅</span> <span><strong>Pengakuan Kompetensi:</strong> Berlogo Garuda Emas, mengukur keterampilan terstandar industri nasional.</span></li>
          <li><span class="icon">✅</span> <span><strong>Syarat Tender &amp; Proyek:</strong> Kerap menjadi syarat teknis dalam dokumen lelang BUMN, kontraktor EPC, dan migas.</span></li>
          <li><span class="icon">✅</span> <span><strong>Contoh Skema:</strong> Pengawas K3 Migas, POP/POM Pertambangan, Penanggung Jawab Air Limbah (POPAL), Auditor SMK3 &amp; ISO.</span></li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- 4 LANGKAH PROSES PENDAFTARAN -->
<section class="pcat-steps-section">
  <div class="container">
    <div class="section-header" style="margin-bottom:20px;">
      <p class="section-eyebrow">Alur Sertifikasi</p>
      <h2 class="section-title">4 Langkah Mudah Mengikuti Pelatihan</h2>
      <p class="pcat-dir-intro">Proses pendaftaran cepat, transparan, dan dibimbing langsung oleh tim konsultan kami dari awal hingga sertifikat resmi terbit.</p>
    </div>
    <div class="pcat-steps-grid">
      <div class="pcat-step-card" data-reveal="up" data-reveal-delay="1">
        <div class="pcat-step-num">1</div>
        <h3>Pilih Program &amp; Jadwal</h3>
        <p>Cari program di katalog ini, lalu hubungi kami via WhatsApp untuk mendapatkan silabus dan tanggal batch terdekat.</p>
      </div>
      <div class="pcat-step-card" data-reveal="up" data-reveal-delay="2">
        <div class="pcat-step-num">2</div>
        <h3>Registrasi Dokumen</h3>
        <p>Kirim kelengkapan berkas persyaratan peserta (KTP, ijazah terakhir, pas foto, atau surat penugasan kerja).</p>
      </div>
      <div class="pcat-step-card" data-reveal="up" data-reveal-delay="3">
        <div class="pcat-step-num">3</div>
        <h3>Pembinaan &amp; Praktik</h3>
        <p>Ikuti sesi pembinaan materi interaktif dan simulasi studi kasus dipandu praktisi industri (Online Zoom atau Tatap Muka).</p>
      </div>
      <div class="pcat-step-card" data-reveal="up" data-reveal-delay="4">
        <div class="pcat-step-num">4</div>
        <h3>Asesmen &amp; Sertifikat</h3>
        <p>Uji kompetensi resmi. Sertifikat kelulusan fisik dan digital resmi ber-SKP/barcode diterbitkan dan dikirim ke alamat Anda.</p>
      </div>
    </div>
  </div>
</section>

<!-- SEARCH + MODE FILTER + CATEGORY PILLS -->
<div class="container pcat-filter-row">
  <div class="pcat-cat-pills-wrap">
    <button class="pcat-cat-pill active" data-cat="all" onclick="setCatFilter(this)">Semua Kategori (<?= $totalPrograms ?>)</button>
    <?php foreach ($groups as $group): $cat = $group['cat']; ?>
    <button class="pcat-cat-pill" data-cat="<?= e($cat['slug']) ?>" onclick="setCatFilter(this)"><?= $cat['icon'] ?? '' ?> <?= e($cat['name']) ?> (<?= count($group['trainings']) ?>)</button>
    <?php endforeach; ?>
  </div>
  <div class="filter-bar" style="width:100%;max-width:780px;">
    <div class="catalog-search-wrap">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      <input type="text" id="catalog-search" placeholder="Cari nama program pelatihan..." value="<?= e($_GET['q'] ?? '') ?>" oninput="filterCatalog()">
    </div>
    <div class="filter-group">
      <button class="filter-mode active" data-mode="all" onclick="setModeFilter(this)">Semua</button>
      <button class="filter-mode" data-mode="online" onclick="setModeFilter(this)">Online</button>
      <button class="filter-mode" data-mode="offline" onclick="setModeFilter(this)">Offline</button>
    </div>
  </div>
</div>

<section class="detail-body" style="padding-top:16px">
  <div class="container">
    <div class="detail-main" style="max-width:100%;">

      <?php foreach ($groups as $group): $cat = $group['cat']; $trainings = $group['trainings']; ?>
      <div class="detail-section" id="cat-<?= e($cat['slug']) ?>">
        <h2><?= $cat['icon'] ?? '' ?> <?= e($cat['name']) ?></h2>
        <div class="training-grid">
          <?php foreach ($trainings as $t): ?>
          <article class="training-card fade-in"
                   data-cat="<?= e($t['cat_slug']) ?>"
                   data-mode="<?= e($t['mode']) ?>"
                   style="--accent: <?= e($t['accent_color'] ?? '#0A4A2E') ?>">
            <a href="/pelatihan/<?= e($t['slug']) ?>/" class="training-card-img-wrap">
              <img src="<?= training_img_url($t['image_path'], $t['cat_slug'] ?? '', $t['slug'] ?? '') ?>"
                   alt="<?= e((stripos($t['name'], 'pelatihan') === false ? 'Pelatihan ' : '') . $t['name'] . (!empty($t['certification']) ? ' Sertifikasi ' . $t['certification'] : '')) ?>" loading="lazy" width="400" height="250" decoding="async">
              <span class="training-card-cat-badge"><?= $t['cat_icon'] ?? '' ?> <?= e($t['cat_name']) ?></span>
            </a>
            <div class="training-card-body">
              <div class="training-card-meta">
                <span class="badge-mode"><?= e(mode_label($t['mode'])) ?></span>
                <span class="badge-cert"><?= e($t['certification']) ?></span>
              </div>
              <h3 class="training-card-title"><a href="/pelatihan/<?= e($t['slug']) ?>/"><?= e($t['name']) ?></a></h3>
              <div class="training-card-footer">
                <span class="training-price"><?= format_price((int)$t['price']) ?> <small>/orang</small></span>
                <a href="<?= wa_url($t['wa_text'] ?? 'Halo, saya ingin info ' . $t['name']) ?>"
                   class="btn-wa-card" target="_blank" rel="noopener">Daftar</a>
              </div>
            </div>
          </article>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endforeach; ?>

      <?php if (!$groups): ?>
      <p>Katalog pelatihan sedang diperbarui. Hubungi kami langsung via WhatsApp untuk informasi program terkini.</p>
      <?php endif; ?>

      <div id="catalog-empty" class="filter-empty" style="display:none">
        Tidak ada program yang cocok dengan pencarian Anda. Coba kata kunci lain, atau hubungi kami langsung via WhatsApp.
      </div>

      <!-- IN-HOUSE B2B BANNER -->
      <div class="pcat-b2b-box">
        <div class="pcat-b2b-inner">
          <div>
            <h2>🏢 Solusi Pelatihan In-House untuk Perusahaan &amp; Industri</h2>
            <p>Ingin melatih tim dalam jumlah besar tanpa mengganggu operasional harian pabrik, tambang, atau proyek Anda? Wahana Totalita menyediakan program in-house training dengan fleksibilitas penuh di seluruh Indonesia.</p>
            <ul class="pcat-b2b-features">
              <li><span>✔</span> Instruktur senior dikirim langsung ke lokasi site/fasilitas perusahaan Anda.</li>
              <li><span>✔</span> Jadwal dan durasi pelatihan fleksibel sesuai shift operasional kerja tim.</li>
              <li><span>✔</span> Kurikulum disesuaikan dengan studi kasus dan potensi bahaya riil di tempat kerja.</li>
              <li><span>✔</span> Penawaran harga corporate khusus dan efisien untuk rombongan minimal 5–10 peserta.</li>
            </ul>
          </div>
          <div class="pcat-b2b-actions">
            <a href="<?= wa_url('Halo Wahana Totalita, kami dari perusahaan ingin meminta penawaran in-house training.') ?>" class="btn-b2b-wa" target="_blank" rel="noopener">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
              Konsultasi In-House via WhatsApp
            </a>
            <a href="/in-house-training/" style="color:#bbf7d0; font-size:13.5px; text-decoration:underline; text-align:center; padding:4px;">
              Lihat Portal &amp; Hub Regional In-House &rarr;
            </a>
          </div>
        </div>
      </div>

      <!-- TRUST & QUALITY GUARANTEE -->
      <div class="pcat-trust-section">
        <div class="section-header" style="margin-bottom:10px;">
          <p class="section-eyebrow">Standar Kualitas</p>
          <h2 class="section-title">Keunggulan Pelatihan Wahana Totalita</h2>
        </div>
        <div class="pcat-trust-grid">
          <div class="pcat-trust-item" data-reveal="up" data-reveal-delay="1">
            <div class="pcat-trust-icon">🏛️</div>
            <div>
              <h4>PJK3 Resmi Berlisensi</h4>
              <p>Terdaftar resmi di Kemnaker RI dengan SKP Penunjukan sah dan berlisensi LSP terakreditasi BNSP.</p>
            </div>
          </div>
          <div class="pcat-trust-item" data-reveal="up" data-reveal-delay="2">
            <div class="pcat-trust-icon">👨‍🏫</div>
            <div>
              <h4>Instruktur Praktisi Senior</h4>
              <p>Materi diampu langsung oleh praktisi berpengalaman 10+ tahun di sektor migas, tambang, dan industri.</p>
            </div>
          </div>
          <div class="pcat-trust-item" data-reveal="up" data-reveal-delay="3">
            <div class="pcat-trust-icon">🔍</div>
            <div>
              <h4>Sertifikat Resmi &amp; Terverifikasi</h4>
              <p>Sertifikat resmi ber-SKP atau berlogo Garuda Emas, dapat divalidasi keasliannya di portal resmi.</p>
            </div>
          </div>
          <div class="pcat-trust-item" data-reveal="up" data-reveal-delay="4">
            <div class="pcat-trust-icon">🤝</div>
            <div>
              <h4>Dipercaya 500+ Korporasi</h4>
              <p>Telah melatih dan menyertifikasi ribuan profesional dari berbagai BUMN, multinasional, dan swasta.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FAQ (reuses homepage .section-faq accordion component) -->
<?php if (!empty($catalogFaqs)): ?>
<section class="section-faq">
  <div class="container">
    <div class="section-header">
      <p class="section-eyebrow">FAQ</p>
      <h2 class="section-title">Pertanyaan Umum Seputar Pelatihan K3</h2>
    </div>
    <div class="faq-grid">
      <?php foreach ($catalogFaqs as $f_idx => $f): ?>
      <div class="faq-item" data-reveal="up" data-reveal-delay="<?= ($f_idx % 4) + 1 ?>">
        <button class="faq-question" onclick="toggleCatalogFaq(this)">
          <span><?= e($f['q']) ?></span>
          <span class="faq-icon">+</span>
        </button>
        <div class="faq-answer"><p><?= e($f['a']) ?></p></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

</main>
<?php require __DIR__ . '/includes/footer.php'; ?>

<script>
function toggleCatalogFaq(btn) {
  btn.closest('.faq-item').classList.toggle('open');
}

function setModeFilter(btn) {
  document.querySelectorAll('.filter-mode').forEach(function(b){ b.classList.remove('active'); });
  btn.classList.add('active');
  filterCatalog();
}

function setCatFilter(btn) {
  document.querySelectorAll('.pcat-cat-pill').forEach(function(b){ b.classList.remove('active'); });
  btn.classList.add('active');
  filterCatalog();
}

function filterCatalog() {
  var q = (document.getElementById('catalog-search').value || '').trim().toLowerCase();
  var activeBtn = document.querySelector('.filter-mode.active');
  var mode = activeBtn ? activeBtn.dataset.mode : 'all';
  var activeCatBtn = document.querySelector('.pcat-cat-pill.active');
  var selCat = activeCatBtn ? activeCatBtn.dataset.cat : 'all';
  var anyVisible = false;

  document.querySelectorAll('.detail-section[id^="cat-"]').forEach(function(section){
    var catId = section.id.replace('cat-', '');
    if (selCat !== 'all' && catId !== selCat) {
      section.style.display = 'none';
      return;
    }
    var sectionHasVisible = false;
    section.querySelectorAll('.training-card').forEach(function(card){
      var titleEl = card.querySelector('.training-card-title');
      var name = titleEl ? titleEl.textContent.toLowerCase() : '';
      var cardMode = (card.dataset.mode || '').toLowerCase();
      var matchesText = !q || name.indexOf(q) !== -1;
      var matchesMode = mode === 'all' || cardMode.indexOf(mode) !== -1;
      var show = matchesText && matchesMode;
      card.setAttribute('data-hidden', show ? 'false' : 'true');
      if (show) { sectionHasVisible = true; anyVisible = true; }
    });
    section.style.display = sectionHasVisible ? '' : 'none';
  });

  document.getElementById('catalog-empty').style.display = anyVisible ? 'none' : 'block';
}

// Auto filter on load if query parameter exists
if ((document.getElementById('catalog-search').value || '').trim() !== '') {
  filterCatalog();
}
</script>
<script src="/assets/js/main.js" defer></script>
<?php if (!empty($s['ga_measurement_id'])): ?>
<script async src="https://www.googletagmanager.com/gtag/js?id=<?= e($s['ga_measurement_id']) ?>"></script>
<script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','<?= e($s['ga_measurement_id']) ?>');</script>
<?php endif; ?>
</body>
</html>