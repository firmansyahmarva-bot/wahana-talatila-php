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
$wa_number  = $s['wa_number'] ?? '628122969435';

$meta_title = 'Katalog Pelatihan K3 — Semua Program Sertifikasi Kemnaker RI & BNSP | Wahana Totalita';
$meta_desc  = 'Katalog lengkap pelatihan K3 Wahana Totalita: konstruksi, pertambangan, migas, lingkungan, ISO, dan puluhan program lain. Sertifikasi Kemnaker RI & BNSP. Yogyakarta & in-house.';
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
<meta name="theme-color"        content="<?= e(is_valid_hex($s['theme_color_primary'] ?? '') ? $s['theme_color_primary'] : '#0A4A2E') ?>">
<meta name="robots"             content="index,follow">
<link rel="manifest" href="/manifest.json">

<?php if (!empty($s['gtm_id'])): ?>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','<?= e($s['gtm_id']) ?>');</script>
<?php endif; ?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="<?= theme_font_url($s) ?>" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/style.css">
<link rel="stylesheet" href="/assets/css/additions.css">
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

.pcat-filter-row { display: flex; justify-content: center; padding: 28px 0 8px; }

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
    <h1>Katalog Pelatihan K3</h1>
    <p>Semua program sertifikasi K3 Wahana Totalita — Kemnaker RI &amp; BNSP, siap tatap muka di Yogyakarta maupun in-house di lokasi perusahaan Anda di seluruh Indonesia.</p>
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
      <h2 class="section-title">Panduan Lengkap per Topik K3</h2>
      <p class="pcat-dir-intro">Baca panduan lengkap tiap topik K3 — regulasi, siapa yang wajib mengikuti, dan program terkait — sebelum memilih pelatihan.</p>
    </div>
    <div class="services-grid">
      <?php foreach ($HUB_CATEGORY_MAP as $catSlug => $hub): ?>
      <a href="<?= e($hub['hub_url']) ?>" class="service-card" style="--accent: <?= e($hubAccent[$catSlug] ?? '#0A4A2E') ?>; text-decoration:none;">
        <div class="service-card-icon"><?= $hubIcons[$catSlug] ?? '📄' ?></div>
        <div class="service-card-title"><?= e($hub['hub_name']) ?></div>
        <div class="service-card-desc">Panduan lengkap, dasar hukum, dan program pelatihan terkait <?= e($hub['hub_name']) ?>.</div>
        <div class="service-card-arrow">→</div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- SEARCH + MODE FILTER -->
<div class="container pcat-filter-row">
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
                   alt="<?= e($t['name']) ?>" loading="lazy" width="400" height="250" decoding="async">
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

      <div class="detail-cta-box">
        <h3>Tidak menemukan program yang Anda cari?</h3>
        <p>Hubungi tim kami via WhatsApp — kami juga menyediakan program in-house yang disesuaikan kebutuhan perusahaan Anda.</p>
        <a href="<?= wa_url('Halo, saya ingin konsultasi program pelatihan K3 untuk perusahaan kami.') ?>" class="btn-primary" target="_blank" rel="noopener">Konsultasi via WhatsApp</a>
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
      <?php foreach ($catalogFaqs as $f): ?>
      <div class="faq-item">
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

function filterCatalog() {
  var q = (document.getElementById('catalog-search').value || '').trim().toLowerCase();
  var activeBtn = document.querySelector('.filter-mode.active');
  var mode = activeBtn ? activeBtn.dataset.mode : 'all';
  var anyVisible = false;

  document.querySelectorAll('.detail-section[id^="cat-"]').forEach(function(section){
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
<script src="/assets/js/main.js"></script>
<?php if (!empty($s['ga_measurement_id'])): ?>
<script async src="https://www.googletagmanager.com/gtag/js?id=<?= e($s['ga_measurement_id']) ?>"></script>
<script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','<?= e($s['ga_measurement_id']) ?>');</script>
<?php endif; ?>
</body>
</html>