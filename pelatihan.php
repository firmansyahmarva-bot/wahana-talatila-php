<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/hub-category-map.php';

$slug = get_url_slug();
if (!$slug) {
    // Bare /pelatihan/ (no slug) -> full training catalog, not a homepage redirect.
    require __DIR__ . '/pelatihan-catalog.php';
    exit;
}

// Check if static city page exists in pelatihan-data
$city_data_file = __DIR__ . '/pelatihan-data/' . $slug . '.json';
if (file_exists($city_data_file)) {
    require __DIR__ . '/pelatihan-city-renderer.php';
    exit;
}

$training = get_training_by_slug($slug);
if (!$training) {
    // Check file redirects first
    $redirsFile = __DIR__ . '/data/training_redirects.json';
    if (file_exists($redirsFile)) {
        $redirs = json_decode(file_get_contents($redirsFile), true) ?: [];
        foreach ($redirs as $r) {
            if (($r['old_slug'] ?? '') === $slug) {
                if (!empty($r['target_slug'])) {
                    header('Location: ' . SITE_URL . '/pelatihan/' . $r['target_slug'] . '/', true, 301);
                    exit;
                }
                if (!empty($r['target_category_slug']) && isset($HUB_CATEGORY_MAP[$r['target_category_slug']])) {
                    header('Location: ' . $HUB_CATEGORY_MAP[$r['target_category_slug']]['hub_url'], true, 301);
                    exit;
                }
                header('Location: /pelatihan/', true, 301);
                exit;
            }
        }
    }

    // Truly unknown slug -> real 404
    http_response_code(404);
    $f = __DIR__ . '/404.php';
    if (is_file($f)) { include $f; } else { echo 'Halaman tidak ditemukan.'; }
    exit;
}

// Related trainings (same category, exclude self)
$related = [];
$trainingsFile = __DIR__ . '/data/trainings.json';
if (file_exists($trainingsFile)) {
    $allTrainings = json_decode(file_get_contents($trainingsFile), true) ?: [];
    foreach ($allTrainings as $t) {
        if (($t['category_id'] ?? 0) == ($training['category_id'] ?? 0) && ($t['id'] ?? 0) != ($training['id'] ?? 0)) {
            $related[] = $t;
            if (count($related) >= 4) break;
        }
    }
} else {
    try {
        $stmt = get_pdo()->prepare(
            'SELECT t.*, c.name AS cat_name, c.slug AS cat_slug, c.icon AS cat_icon, c.accent_color
             FROM trainings t
             LEFT JOIN categories c ON c.id = t.category_id
             WHERE t.is_active = 1 AND t.category_id = ? AND t.id != ?
             ORDER BY t.sort_order ASC LIMIT 4'
        );
        $stmt->execute([$training['category_id'], $training['id']]);
        $related = $stmt->fetchAll();
    } catch (Exception) {}
}

// Related articles ("Artikel Seputar Topik Ini")
$articleCatMap = [
    'k3'                => ['K3'],
    'lingkungan'        => ['Lingkungan'],
    'mining'            => ['Mining'],
    'system-management' => ['ISO', 'QHSE'],
];
$articleCats = $articleCatMap[$training['cat_slug'] ?? ''] ?? ['K3'];
$relatedArticles = [];
$articlesFile = __DIR__ . '/data/articles.json';
if (file_exists($articlesFile)) {
    $allArticles = json_decode(file_get_contents($articlesFile), true) ?: [];
    foreach ($allArticles as $a) {
        if (in_array($a['category'] ?? '', $articleCats)) {
            $relatedArticles[] = $a;
            if (count($relatedArticles) >= 3) break;
        }
    }
    if (count($relatedArticles) < 2) {
        foreach ($allArticles as $a) {
            if (!in_array($a, $relatedArticles, true)) {
                $relatedArticles[] = $a;
                if (count($relatedArticles) >= 2) break;
            }
        }
    }
}

// Curriculum
$curriculum = [];
if (!empty($training['curriculum'])) {
    $dec = json_decode($training['curriculum'], true);
    if (is_array($dec)) $curriculum = $dec;
}
// Long-form SEO content (added for enriched training pages)
$long_content = $training['long_content'] ?? null;

// ─────────────────────────────────────────────────────────────────────
// SEO FAQ content — built from real Search Console queries that land
// on this domain with impressions but 0 clicks / poor position (e.g.
// "perbedaan bnsp dan kemnaker" pos ~74, "kadar oksigen yang aman untuk
// bekerja di ruang terbatas" pos ~10, "ptp adalah singkatan dari" pos
// ~69, "166 kriteria smk3" pos ~12, "ahli k3 umum bnsp ..." pos 18-25
// across cities). $faqUniversal runs on every training page; topic
// blocks are appended when the training's own slug/name matches the
// relevant keyword cluster, so each page answers the exact questions
// people are already typing about that specific program.
// ─────────────────────────────────────────────────────────────────────
$haystack = mb_strtolower(($training['slug'] ?? '') . ' ' . ($training['name'] ?? ''));

// Modular SEO FAQ content
$faqData = require __DIR__ . '/includes/training-faqs.php';
$topicFaqs = [];
foreach ($faqData['clusters'] as $cluster) {
    foreach ($cluster['keywords'] as $kw) {
        if (str_contains($haystack, $kw)) {
            $topicFaqs = array_merge($topicFaqs, $cluster['faqs']);
            break;
        }
    }
}

// Course-specific FAQ items
$hero_name  = clean_program_name($training['short_name'] ?: $training['name']);
$courseFaqs = [
    [
        'q' => 'Kapan jadwal pelaksanaan ' . $hero_name . ' batch terdekat?',
        'a' => 'Jadwal ' . $hero_name . ' diselenggarakan secara berkala setiap bulan untuk kelas reguler publik (online maupun tatap muka) dan in-house training di perusahaan Anda. Hubungi tim kami via WhatsApp di nomor 0877-5915-1278 untuk mendapatkan jadwal batch dan silabus terbaru.',
    ],
    [
        'q' => 'Berapa biaya investasi dan apa saja fasilitas pelatihan ini?',
        'a' => 'Investasi pelatihan ' . $hero_name . (!empty($training['price']) && (int)$training['price'] > 0 ? ' adalah ' . format_price((int)$training['price']) . '/peserta' : ' dapat dikonsultasikan secara gratis') . '. Fasilitas mencakup sertifikat resmi, modul materi lengkap, pembinaan oleh instruktur profesional berpengalaman, dan konsultasi pra-pelatihan.',
    ],
];

$faqItems = array_merge($courseFaqs, $topicFaqs, $faqData['universal']);

$s         = get_all_settings();
$wa_number = $s['wa_number'] ?? '6287759151278';
$wa_msg    = $training['wa_text'] ?: ('Halo Wahana Totalita, saya ingin konsultasi pendaftaran ' . $hero_name);
$wa_inhouse_msg = 'Halo Wahana Totalita, kami dari perusahaan ingin meminta proposal & penawaran resmi In-House Training untuk topik: ' . $hero_name;

// 2026-09-26 SEO Overhaul: dynamic keyword optimization strictly ≤65 chars
$meta_title = build_training_title($training);
$meta_desc  = build_training_meta_desc($training);
$page_url   = SITE_URL . '/pelatihan/' . $training['slug'] . '/';

// Cross-silo link (Fix 7): breadcrumb + schema should point at the real
// hub page for this training's category, not the old /#produk anchor.
$hub_link = '/#produk';
if (isset($HUB_CATEGORY_MAP[$training['cat_slug'] ?? ''])) {
    $hub_link = $HUB_CATEGORY_MAP[$training['cat_slug']]['hub_url'];
}


// 2026-07-24: sidebar "registration ticket" reads two optional fields that
// don't appear elsewhere in this file — `schedule` (free-text next batch /
// jadwal info) and `brochure_url` (downloadable PDF). Both are entirely
// optional; every reference below is guarded with !empty() so nothing
// breaks if the columns are absent or unset on a given training row.
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($meta_title) ?></title>
<meta name="description" content="<?= e($meta_desc) ?>">
<link rel="canonical" href="<?= e($page_url) ?>">

<!-- Open Graph -->
<meta property="og:type"           content="website">
<meta property="og:title"          content="<?= e($meta_title) ?>">
<meta property="og:description"    content="<?= e($meta_desc) ?>">
<meta property="og:url"            content="<?= e($page_url) ?>">
<meta property="og:image"          content="<?= training_img_url($training['image_path'], $training['cat_slug'] ?? '') ?>">
<meta property="og:image:width"    content="1200">
<meta property="og:image:height"   content="630">
<meta property="og:site_name"      content="<?= e($s['site_name'] ?? 'Wahana Totalita Konsultan') ?>">
<meta property="og:locale"         content="id_ID">
<meta name="twitter:card"          content="summary_large_image">
<meta name="twitter:title"         content="<?= e($meta_title) ?>">
<meta name="twitter:description"   content="<?= e($meta_desc) ?>">
<meta name="twitter:image"         content="<?= training_img_url($training['image_path'], $training['cat_slug'] ?? '') ?>">
<meta name="theme-color"           content="<?= e(is_valid_hex($s['theme_color_primary'] ?? '') ? $s['theme_color_primary'] : 'var(--brand)') ?>">
<meta name="robots"                content="index,follow">
<!-- PWA -->
<link rel="manifest" href="/manifest.json">
<meta name="apple-mobile-web-app-capable"            content="yes">
<meta name="apple-mobile-web-app-status-bar-style"   content="black-translucent">
<meta name="apple-mobile-web-app-title"              content="<?= e($s['site_name'] ?? 'Wahana Totalita') ?>">

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
<link rel="preload" href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;600;700;800&family=Source+Sans+3:wght@400;600;700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;600;700;800&family=Source+Sans+3:wght@400;600;700&display=swap">
</noscript>

<!-- Critical base styles (tokens, reset, typography, navbar, footer) -->
<?php require __DIR__ . '/includes/css.php'; ?>

<!-- Primary stylesheet: dedicated design for training detail pages -->
<link rel="stylesheet" href="<?= asset_v('/assets/css/pelatihan-detail.css') ?>">
<!-- Deferred non-critical stylesheet for shared components -->

<!-- Course Schema (JSON-LD) -->
<script type="application/ld+json"><?= course_schema($training) ?></script>
<!-- BreadcrumbList Schema -->
<script type="application/ld+json"><?= json_encode([
    '@context' => 'https://schema.org',
    '@type'    => 'BreadcrumbList',
    'itemListElement' => [
        ['@type'=>'ListItem','position'=>1,'name'=>'Beranda','item'=>SITE_URL.'/'],
        ['@type'=>'ListItem','position'=>2,'name'=>'Pelatihan','item'=>SITE_URL.'/pelatihan/'],
        ['@type'=>'ListItem','position'=>3,'name'=>$training['cat_name'],'item'=>SITE_URL.$hub_link],
        ['@type'=>'ListItem','position'=>4,'name'=>$hero_name,'item'=>$page_url],
    ]
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?></script>
<?php if (!empty($faqItems)): ?>
<!-- FAQPage Schema — universal + topic-matched blocks, built from real
     Search Console keyword gaps (see $faqUniversal/$topicFaqs above) -->
<script type="application/ld+json"><?= json_encode([
    '@context'   => 'https://schema.org',
    '@type'      => 'FAQPage',
    'mainEntity' => array_map(fn($f) => [
        '@type' => 'Question', 'name' => $f['q'],
        'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']],
    ], $faqItems),
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?></script>
<?php endif; ?>
</head>
<body class="detail-page pd-page">
<div id="scroll-progress" aria-hidden="true"></div>

<?php if (!empty($s['gtm_id'])): ?>
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?= e($s['gtm_id']) ?>" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<?php endif; ?>

<?php require __DIR__ . '/includes/navbar.php'; ?>
<main id="konten-utama">
<!-- BREADCRUMB -->
<div class="breadcrumb-bar">
  <div class="container">
    <nav aria-label="Breadcrumb">
      <ol class="breadcrumb-list">
        <li><a href="/">Beranda</a></li>
        <li aria-hidden="true">›</li>
        <li><a href="/pelatihan/">Pelatihan</a></li>
        <li aria-hidden="true">›</li>
        <li><a href="<?= e($hub_link) ?>"><?= e($training['cat_name']) ?></a></li>
        <li aria-hidden="true">›</li>
        <li aria-current="page"><?= e($hero_name) ?></li>
      </ol>
    </nav>
  </div>
</div>

<!-- DETAIL HERO -->
<?php
$cert_raw = trim($training['certification'] ?? '');
$cert_clean = preg_replace('/^sertifikasi\s+/i', '', $cert_raw);
$cat_name_clean = trim($training['cat_name'] ?? '');
?>
<section class="pd-hero">
  <div class="container pd-hero-grid">
    <div class="pd-hero-copy">
      <div class="pd-eyebrow">
        <span class="pd-eyebrow-pill">PJK3 Resmi Kemnaker RI</span>
        <span class="pd-eyebrow-dot" aria-hidden="true">&middot;</span>
        <span class="pd-eyebrow-cert">Sertifikasi <?= e($cert_clean ?: $cert_raw) ?></span>
        <span class="pd-eyebrow-dot" aria-hidden="true">&middot;</span>
        <span class="pd-eyebrow-cat"><?= e($cat_name_clean) ?></span>
      </div>
      <h1><?= e($hero_name) ?></h1>
      <p class="pd-hero-lede"><?= e(mb_strimwidth(strip_tags($training['description'] ?? ''), 0, 220, '…')) ?: 'Sertifikasi resmi ' . e($training['certification']) . ', diselenggarakan Wahana Totalita Konsultan secara komprehensif.' ?></p>
      <div class="pd-hero-badges">
        <?php if (!empty($training['duration_days'])): ?>
        <span class="pd-hero-badge"><span class="badge-icon">⏱️</span> <?= (int)$training['duration_days'] ?> Hari Pelatihan</span>
        <?php endif; ?>
        <span class="pd-hero-badge"><span class="badge-icon">🌐</span> <?= e(mode_label($training['mode'])) ?></span>
        <span class="pd-hero-badge pd-badge-inhouse"><span class="badge-icon">🏢</span> Tersedia In-House Training</span>
        <span class="pd-hero-badge pd-badge-accredited"><span class="badge-icon">✓</span> Terakreditasi Resmi</span>
      </div>
      <div class="pd-cta-row">
        <a href="<?= wa_url($wa_msg) ?>" class="pd-cta-btn pd-cta-primary" target="_blank" rel="noopener">
          <svg viewBox="0 0 24 24" fill="currentColor" width="20" height="20" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
          <span>Daftar via WhatsApp</span>
        </a>
        <a href="<?= wa_url($wa_inhouse_msg) ?>" class="pd-cta-btn pd-cta-inhouse" target="_blank" rel="noopener">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20" aria-hidden="true"><path d="M3 21h18M3 7v14M21 7v14M6 11h4M6 15h4M14 11h4M14 15h4M9 3h6v4H9z"/></svg>
          <span>Penawaran In-House Training</span>
        </a>
        <a href="<?= wa_url('Halo, saya ingin info jadwal batch terdekat ' . $training['name']) ?>" class="pd-cta-secondary" target="_blank" rel="noopener">Tanya jadwal &amp; info lebih &rarr;</a>
      </div>
    </div>

    <div class="pd-hero-card-wrap">
      <div class="pd-hero-card">
        <div class="pd-card-header">
          <span class="pd-card-badge-top">🛡️ Terakreditasi Resmi</span>
          <span class="pd-card-cert"><?= e($training['certification']) ?></span>
        </div>
        <div class="pd-card-price-block">
          <span class="pd-card-price-label">Biaya Investasi Mulai</span>
          <div class="pd-card-price-val">
            <?= format_price((int)$training['price']) ?>
            <span class="pd-card-price-sub">/ orang</span>
          </div>
        </div>
        <div class="pd-card-inhouse-tag">
          <span class="tag-icon">🏢</span>
          <span>Tersedia Penawaran Khusus In-House &amp; Grup Perusahaan</span>
        </div>
        <ul class="pd-card-perks">
          <li><svg viewBox="0 0 20 20" fill="currentColor" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg> Sertifikat Resmi &amp; SKP Kemnaker / BNSP</li>
          <li><svg viewBox="0 0 20 20" fill="currentColor" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg> Modul Materi &amp; Bimbingan Instruktur Ahli</li>
          <li><svg viewBox="0 0 20 20" fill="currentColor" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg> Pelatihan Tatap Muka, Online, &amp; In-House</li>
        </ul>
        <div class="pd-card-footer">
          <span class="pd-card-response">⚡ Konsultasi Gratis &amp; Respon Cepat via WhatsApp</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- DETAIL BODY -->
<section class="pd-body">
  <div class="container pd-layout">

    <div class="pd-main">

      <?php if (!empty(trim($training['description'] ?? ''))): ?>
      <div class="pd-section">
        <p class="pd-section-eyebrow">Program</p>
        <h2>Deskripsi Program</h2>
        <div class="pd-desc">
          <?= nl2br(e($training['description'])) ?>
        </div>
      </div>
      <?php endif; ?>

      <?php if (!empty($long_content)): ?>
      <div class="pd-section pd-rich">
        <?php
        require_once __DIR__ . '/includes/glossary-autolink.php';
        echo glossary_autolink($long_content);
        ?>
      </div>
      <?php endif; ?>

      <?php if (!empty($curriculum)): ?>
      <div class="pd-section">
        <p class="pd-section-eyebrow">Kurikulum</p>
        <h2>Materi Pelatihan</h2>
        <ul class="pd-curriculum">
          <?php foreach ($curriculum as $i => $item): ?>
          <li><span class="pd-num"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span><span><?= e($item) ?></span></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <?php endif; ?>

      <!-- IN-CONTENT WHATSAPP CTA -->
      <div class="pd-mid-cta">
        <div class="pd-mid-cta-body">
          <h3>Butuh Penawaran Resmi atau Pelatihan In-House?</h3>
          <p>Dapatkan silabus lengkap, proposal teknis, dan rincian diskon rombongan untuk perusahaan atau instansi Anda langsung via WhatsApp konsultan kami.</p>
        </div>
        <a href="<?= wa_url('Halo Wahana Totalita, saya ingin informasi penawaran resmi/jadwal untuk program ' . $training['name']) ?>" class="pd-mid-cta-btn" target="_blank" rel="noopener">
          <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
          Konsultasi WhatsApp Gratis &rarr;
        </a>
      </div>

      <?php
      // Option A: Core Pillar Program Interlinks
      $all_pillars = [
          [
              'slug'  => 'ak3-bnsp',
              'url'   => '/pelatihan/ak3-bnsp/',
              'name'  => 'Sertifikasi Ahli K3 BNSP',
              'desc'  => 'Standarisasi kompetensi personil K3 profesional bersertifikasi Badan Nasional Sertifikasi Profesi berbasis SKKNI.',
              'badge' => 'BNSP',
          ],
          [
              'slug'  => 'pelatihan-k3-operator-forklift-kelas-2-sertifikasi-kemnaker-ri',
              'url'   => '/pelatihan/pelatihan-k3-operator-forklift-kelas-2-sertifikasi-kemnaker-ri/',
              'name'  => 'Pelatihan K3 Operator Forklift Kelas 2 Kemnaker RI',
              'desc'  => 'Lisensi K3 resmi (SIO) operator forklift untuk operasional pergudangan, logistik, dan industri manufaktur.',
              'badge' => 'Kemnaker RI',
          ],
          [
              'slug'  => 'pelatihan-teknisi-bejana-tekan-sertifikasi-kemnaker-ri',
              'url'   => '/pelatihan/pelatihan-teknisi-bejana-tekan-sertifikasi-kemnaker-ri/',
              'name'  => 'Pelatihan Teknisi Bejana Tekan Kemnaker RI',
              'desc'  => 'Kualifikasi teknisi inspeksi dan pengoperasian bejana tekan serta tangki timbun bertekanan tinggi.',
              'badge' => 'Kemnaker RI',
          ],
          [
              'slug'  => 'pelatihan-dan-sertifikasi-pelaksanaan-reklamasi-pada-kegiatan-petambangan-mineral-dan-batubara-sertifikasi-bnsp',
              'url'   => '/pelatihan/pelatihan-dan-sertifikasi-pelaksanaan-reklamasi-pada-kegiatan-petambangan-mineral-dan-batubara-sertifikasi-bnsp/',
              'name'  => 'Pelatihan Reklamasi Pertambangan Minerba BNSP',
              'desc'  => 'Kompetensi teknis perencanaan dan pelaksanaan reklamasi lingkungan pada area tambang mineral dan batubara.',
              'badge' => 'BNSP',
          ],
          [
              'slug'  => 'pelatihan-operator-pesawat-tenaga-produksi-ptp',
              'url'   => '/pelatihan/pelatihan-operator-pesawat-tenaga-produksi-ptp/',
              'name'  => 'Pelatihan Operator Pesawat Tenaga & Produksi (PTP)',
              'desc'  => 'Lisensi K3 operator mesin perkakas, mesin produksi, dan penggerak mula sesuai Permenaker No. 38 Tahun 2016.',
              'badge' => 'Kemnaker RI',
          ],
          [
              'slug'  => 'pelatihan-dan-sertifikasi-fillet-plate-welder-sertifikasi-bnsp',
              'url'   => '/pelatihan/pelatihan-dan-sertifikasi-fillet-plate-welder-sertifikasi-bnsp/',
              'name'  => 'Pelatihan & Sertifikasi Fillet Plate Welder BNSP',
              'desc'  => 'Uji kompetensi juru las sambungan fillet pelat industri konstruksi, fabrikasi baja, dan manufaktur.',
              'badge' => 'BNSP',
          ],
          [
              'slug'  => 'pelatihan-damkar-paralel-kelas-dcba-sertifikasi-kemnaker-ri',
              'url'   => '/pelatihan/pelatihan-damkar-paralel-kelas-dcba-sertifikasi-kemnaker-ri/',
              'name'  => 'Pelatihan Damkar Paralel Kelas D, C, B, A Kemnaker RI',
              'desc'  => 'Sertifikasi regu penanggulangan kebakaran di tempat kerja berjenjang sesuai standar Kepmenaker 186/1999.',
              'badge' => 'Kemnaker RI',
          ],
          [
              'slug'  => 'pelatihan-dan-sertifikasi-pipe-fitter-sertifikasi-bnsp',
              'url'   => '/pelatihan/pelatihan-dan-sertifikasi-pipe-fitter-sertifikasi-bnsp/',
              'name'  => 'Pelatihan & Sertifikasi Pipe Fitter BNSP',
              'desc'  => 'Sertifikasi kompetensi teknisi pemasangan, pemotongan, dan fabrikasi sistem perpipaan industri proses & migas.',
              'badge' => 'BNSP',
          ],
          [
              'slug'  => 'tkbt-ii-surabaya',
              'url'   => '/pelatihan/tkbt-ii-surabaya/',
              'name'  => 'Pelatihan Bekerja di Ketinggian (TKBT Tingkat II)',
              'desc'  => 'Lisensi K3 teknisi keselamatan bekerja pada ketinggian, struktur bangunan tinggi, dan scaffolding.',
              'badge' => 'Kemnaker RI',
          ],
      ];

      // Exclude self, pick up to 4 complementary pillar programs
      $current_slug = $training['slug'] ?? '';
      $filtered_pillars = array_values(array_filter($all_pillars, fn($p) => $p['slug'] !== $current_slug));
      $display_pillars = array_slice($filtered_pillars, 0, 4);
      ?>

      <!-- REKOMENDASI LISENSI & SERTIFIKASI TERKAIT (OPTION A PILLAR INTERLINKS) -->
      <div class="pd-section pd-pillar-recommendations">
        <p class="pd-section-eyebrow">Pengembangan Kompetensi</p>
        <h2>Rekomendasi Sertifikasi &amp; Lisensi K3 Terkait</h2>
        <p class="pd-pillar-intro">
          Untuk melengkapi kualifikasi kerja di industri dan memenuhi kepatuhan regulasi keselamatan kerja, tenaga kerja dan pengawas juga disarankan melengkapi portofolio sertifikasi kompetensi terkait berikut:
        </p>
        <div class="pd-pillar-grid">
          <?php foreach ($display_pillars as $p_idx => $p): ?>
          <article class="pd-pillar-card" data-reveal="up" data-reveal-delay="<?= ($p_idx % 4) + 1 ?>">
            <span class="pd-pillar-badge"><?= e($p['badge']) ?></span>
            <h3><a href="<?= e($p['url']) ?>"><?= e($p['name']) ?></a></h3>
            <p><?= e($p['desc']) ?></p>
            <a href="<?= e($p['url']) ?>" class="pd-pillar-link">Lihat Silabus &amp; Jadwal &rarr;</a>
          </article>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="pd-section">
        <p class="pd-section-eyebrow">Ringkasan</p>
        <h2>Informasi Pelatihan</h2>
        <table class="pd-spec">
          <tr><th>Kategori</th><td><?= e($training['cat_name']) ?></td></tr>
          <tr><th>Mode</th><td><?= e(mode_label($training['mode'])) ?></td></tr>
          <tr><th>Sertifikasi</th><td><?= e($training['certification']) ?></td></tr>
          <?php if (!empty($training['duration_days'])): ?>
          <tr><th>Durasi</th><td><?= (int)$training['duration_days'] ?> Hari</td></tr>
          <?php endif; ?>
          <tr><th>Harga</th><td><?= format_price((int)$training['price']) ?> / orang</td></tr>
          <tr><th>Pendaftaran</th><td>Via WhatsApp</td></tr>
        </table>
      </div>

      <?php if (!empty($faqItems)): ?>
      <div class="pd-section" style="max-width:none">
        <p class="pd-section-eyebrow">FAQ</p>
        <h2>Pertanyaan Seputar <?= e($hero_name) ?></h2>
        <div class="pd-faq-list">
          <?php foreach ($faqItems as $fi => $f): ?>
          <div class="pd-faq-item" data-reveal="up" data-reveal-delay="<?= ($fi % 4) + 1 ?>">
            <button class="pd-faq-q" aria-expanded="false" onclick="toggleFaqPelatihan(this)">
              <span><?= e($f['q']) ?></span>
              <svg class="pd-faq-arrow" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
            </button>
            <div class="pd-faq-a"><p><?= e($f['a']) ?></p></div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endif; ?>

      <?php if (!empty($relatedArticles)): ?>
      <div class="pd-section" style="max-width:none">
        <p class="pd-section-eyebrow">Baca Juga</p>
        <h2>Artikel Seputar Topik Ini</h2>
        <div class="pd-related-grid">
          <?php foreach ($relatedArticles as $ra_idx => $ra): $snippet = mb_substr($ra['meta_desc'] ?? '', 0, 100); ?>
          <div class="pd-related-card" data-reveal="up" data-reveal-delay="<?= ($ra_idx % 4) + 1 ?>">
            <h3><a href="/artikel/<?= e($ra['slug']) ?>/"><?= e($ra['title']) ?></a></h3>
            <p><?= e($snippet) ?><?= mb_strlen($ra['meta_desc'] ?? '') > 100 ? '...' : '' ?></p>
            <a href="/artikel/<?= e($ra['slug']) ?>/" class="pd-related-link">Baca Artikel &rarr;</a>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endif; ?>

      <div class="pd-cta-box">
        <div class="pd-cta-box-copy">
          <h3>Tertarik dengan program ini?</h3>
          <p>Hubungi tim kami via WhatsApp untuk informasi jadwal, syarat pendaftaran, dan penawaran khusus perusahaan.</p>
        </div>
        <a href="<?= wa_url($wa_msg) ?>" class="pd-cta-btn" target="_blank" rel="noopener">
          <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
          Daftar via WhatsApp
        </a>
      </div>

    </div><!-- /.pd-main -->

    <!-- REGISTRATION SIDEBAR — sticky on desktop, moves below hero on mobile -->
    <aside class="pd-sidebar">
      <div class="pd-ticket">
        <div class="pd-ticket-header">
          <span class="pd-ticket-header-badge">
            <svg viewBox="0 0 24 24" fill="currentColor" width="13" height="13" aria-hidden="true"><path d="M12 2L3 7v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-9-5zm-2 16l-4-4 1.41-1.41L10 15.17l6.59-6.59L18 10l-8 8z"/></svg>
            Sertifikasi Resmi <?= e($training['certification']) ?>
          </span>
        </div>

        <div class="pd-ticket-inner">

          <div class="pd-ticket-price-box">
            <span class="pd-ticket-label">Investasi Pelatihan</span>
            <div class="pd-ticket-price-row">
              <span class="pd-ticket-price"><?= format_price((int)$training['price']) ?></span>
              <span class="pd-ticket-unit">/ orang</span>
            </div>
          </div>

          <div class="pd-ticket-specs">
            <?php if (!empty($training['duration_days'])): ?>
            <div class="pd-ticket-row"><span class="pd-ticket-k">Durasi</span><span class="pd-ticket-v"><?= (int)$training['duration_days'] ?> Hari</span></div>
            <?php endif; ?>
            <div class="pd-ticket-row"><span class="pd-ticket-k">Jadwal</span><span class="pd-ticket-v"><?= e(!empty($training['schedule']) ? $training['schedule'] : 'Reguler Bulanan & In-House') ?></span></div>
            <div class="pd-ticket-row"><span class="pd-ticket-k">Sertifikat</span><span class="pd-ticket-v"><?= e($training['certification']) ?></span></div>
            <div class="pd-ticket-row"><span class="pd-ticket-k">Mode</span><span class="pd-ticket-v"><?= e(mode_label($training['mode'])) ?></span></div>
          </div>

          <!-- 2 DISTINCT CTAS: 1 FOR PROGRAM REGISTRATION, 1 FOR IN-HOUSE QUOTATION -->
          <div class="pd-ticket-cta-group">
            <a href="<?= wa_url('Halo Wahana Totalita, saya ingin daftar/konsultasi program: ' . $training['name']) ?>" class="pd-ticket-cta pd-ticket-cta-primary" target="_blank" rel="noopener">
              <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
              <div class="pd-ticket-cta-text">
                <span class="pd-ticket-cta-title">Daftar Program Ini</span>
                <span class="pd-ticket-cta-sub">Konsultasi jadwal &amp; pendaftaran via WA</span>
              </div>
            </a>

            <a href="<?= wa_url('Halo Wahana Totalita, saya mewakili perusahaan ingin meminta proposal & penawaran resmi In-House Training untuk topik: ' . $training['name']) ?>" class="pd-ticket-cta pd-ticket-cta-inhouse" target="_blank" rel="noopener">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M3 21h18M3 7v14M21 7v14M6 11h4M6 15h4M14 11h4M14 15h4M9 3h6v4H9z"/></svg>
              <div class="pd-ticket-cta-text">
                <span class="pd-ticket-cta-title">Minta Penawaran In-House</span>
                <span class="pd-ticket-cta-sub">Proposal teknis &amp; tarif rombongan B2B</span>
              </div>
            </a>
          </div>

          <?php if (!empty($training['brochure_url'])): ?>
          <a href="<?= e($training['brochure_url']) ?>" class="pd-ticket-brochure" target="_blank" rel="noopener">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M12 3v12m0 0l-4-4m4 4l4-4M4 19h16"/></svg>
            Unduh Brosur Pelatihan
          </a>
          <?php endif; ?>

          <div class="pd-ticket-trust">
            <span class="pd-trust-item">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M20 6L9 17l-5-5"/></svg>
              Sertifikat resmi diakui Kemnaker / BNSP
            </span>
            <span class="pd-trust-item">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M20 6L9 17l-5-5"/></svg>
              Tersedia In-House di lokasi perusahaan Anda
            </span>
            <span class="pd-trust-item">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M20 6L9 17l-5-5"/></svg>
              Proposal resmi &amp; konsultasi teknis gratis
            </span>
          </div>

        </div>
      </div>
    </aside>

  </div>
</section>

<!-- RELATED TRAININGS -->
<?php if (!empty($related)): ?>
<section class="pd-related-trainings pd-page">
  <div class="container">
    <p class="pd-section-eyebrow">Lainnya</p>
    <h2>Program Lainnya dalam <?= e($training['cat_name']) ?></h2>
    <div class="pd-training-grid">
      <?php foreach ($related as $t_idx => $t): ?>
      <article class="pd-training-card" data-reveal="up" data-reveal-delay="<?= ($t_idx % 4) + 1 ?>">
        <a href="/pelatihan/<?= e($t['slug']) ?>/">
          <img src="<?= training_img_url($t['image_path'], $t['cat_slug'] ?? '') ?>"
               alt="<?= e((stripos($t['name'], 'pelatihan') === false ? 'Pelatihan ' : '') . $t['name'] . (!empty($t['certification']) ? ' Sertifikasi ' . $t['certification'] : '')) ?>" loading="lazy" width="400" height="250" decoding="async">
        </a>
        <div class="pd-training-card-body">
          <div class="pd-training-card-meta">
            <span><?= e(mode_label($t['mode'])) ?></span>
            <span><?= e($t['certification']) ?></span>
          </div>
          <h3><a href="/pelatihan/<?= e($t['slug']) ?>/"><?= e($t['name']) ?></a></h3>
          <div class="pd-training-card-footer">
            <span class="pd-training-price"><?= format_price((int)$t['price']) ?> <small>/orang</small></span>
            <a href="<?= wa_url($t['wa_text'] ?? 'Halo, saya ingin info ' . $t['name']) ?>"
               class="pd-btn-wa-card" target="_blank" rel="noopener">Daftar</a>
          </div>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

</main>
<?php require __DIR__ . '/includes/footer.php'; ?>

<script>
function toggleFaqPelatihan(btn) {
  var expanded = btn.getAttribute('aria-expanded') === 'true';
  btn.setAttribute('aria-expanded', !expanded);
  var answer = btn.parentElement.querySelector('.pd-faq-a');
  answer.classList.toggle('open', !expanded);
}
</script>
<script src="/assets/js/main.js" defer></script>
<?php if (!empty($s['ga_measurement_id'])): ?>
<script async src="https://www.googletagmanager.com/gtag/js?id=<?= e($s['ga_measurement_id']) ?>"></script>
<script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','<?= e($s['ga_measurement_id']) ?>');</script>
<?php endif; ?>
</body>
</html>