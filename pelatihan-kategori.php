<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/hub-category-map.php';

$s = get_all_settings();
$cat_slug = $_GET['cat'] ?? '';

if (!isset($HUB_CATEGORY_MAP[$cat_slug])) {
    http_response_code(404);
    include __DIR__ . '/404.php';
    exit;
}

$hub = $HUB_CATEGORY_MAP[$cat_slug];

// Find category from JSON
$category = null;
$categoriesFile = __DIR__ . '/data/categories.json';
if (file_exists($categoriesFile)) {
    $allCats = json_decode(file_get_contents($categoriesFile), true) ?: [];
    foreach ($allCats as $c) {
        if (($c['slug'] ?? '') === $cat_slug && ($c['is_active'] ?? 1)) {
            $category = $c;
            break;
        }
    }
}
if (!$category) {
    try {
        $pdo = get_pdo();
        $cat_row = $pdo->prepare("SELECT * FROM categories WHERE slug = ? AND is_active = 1");
        $cat_row->execute([$cat_slug]);
        $category = $cat_row->fetch(PDO::FETCH_ASSOC);
    } catch (Exception) {}
}

if (!$category) {
    http_response_code(404);
    include __DIR__ . '/404.php';
    exit;
}

$page = max(1, (int)($_GET['page'] ?? 1));
$per_page = 24;
$offset = ($page - 1) * $per_page;

$trainings = [];
$total = 0;
$trainingsFile = __DIR__ . '/data/trainings.json';
if (file_exists($trainingsFile)) {
    $allTrainings = json_decode(file_get_contents($trainingsFile), true) ?: [];
    $catTrainings = [];
    foreach ($allTrainings as $t) {
        if (!($t['is_active'] ?? 1)) continue;
        if ((int)($t['category_id'] ?? 0) === (int)$category['id'] || ($t['cat_slug'] ?? $t['category_slug'] ?? '') === $cat_slug) {
            $catTrainings[] = $t;
        }
    }
    $total = count($catTrainings);
    usort($catTrainings, fn($a, $b) => (($a['sort_order'] ?? 0) <=> ($b['sort_order'] ?? 0)) ?: strcasecmp($a['name'] ?? '', $b['name'] ?? ''));
    $trainings = array_slice($catTrainings, $offset, $per_page);
} else {
    try {
        $pdo = get_pdo();
        $count_stmt = $pdo->prepare("SELECT COUNT(*) FROM trainings WHERE category_id = ? AND is_active = 1");
        $count_stmt->execute([$category['id']]);
        $total = $count_stmt->fetchColumn();

        $stmt = $pdo->prepare("
            SELECT t.*, c.name AS cat_name, c.slug AS cat_slug, c.icon AS cat_icon, c.accent_color
            FROM trainings t
            LEFT JOIN categories c ON c.id = t.category_id
            WHERE t.category_id = ? AND t.is_active = 1
            ORDER BY t.sort_order ASC, t.name ASC
            LIMIT " . (int)$per_page . " OFFSET " . (int)$offset . "
        ");
        $stmt->execute([$category['id']]);
        $trainings = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception) {}
}
$total_pages = max(1, ceil($total / $per_page));

$related_articles = [];
if (!empty($hub['article_cats'])) {
    $articlesFile = __DIR__ . '/data/articles.json';
    if (file_exists($articlesFile)) {
        $allArticles = json_decode(file_get_contents($articlesFile), true) ?: [];
        foreach ($allArticles as $art) {
            if (($art['status'] ?? 'published') !== 'published') continue;
            if (in_array($art['category'] ?? '', $hub['article_cats'])) {
                $related_articles[] = $art;
                if (count($related_articles) >= 6) break;
            }
        }
    } else {
        try {
            $pdo = get_pdo();
            $placeholders = implode(',', array_fill(0, count($hub['article_cats']), '?'));
            $art_stmt = $pdo->prepare("
                SELECT title, slug, meta_desc, thumbnail, published_at
                FROM articles
                WHERE category IN ($placeholders) AND status = 'published'
                ORDER BY published_at DESC LIMIT 6
            ");
            $art_stmt->execute($hub['article_cats']);
            $related_articles = $art_stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception) {}
    }
}

$CATEGORY_SEO = [
    'k3' => [
        'title' => 'Pelatihan K3 Resmi Kemnaker RI & BNSP | Wahana Totalita',
        'h1'    => 'Pelatihan K3 & Sertifikasi Keselamatan Kerja',
        'desc'  => 'Daftar ' . $total . ' program pelatihan K3 bersertifikasi resmi Kemnaker RI & BNSP. Pembinaan kompetensi keselamatan kerja industri, kelas online & tatap muka.',
    ],
    'lingkungan' => [
        'title' => 'Pelatihan K3 Lingkungan & Limbah BNSP | Wahana Totalita',
        'h1'    => 'Pelatihan Pengelolaan Lingkungan & Limbah',
        'desc'  => 'Program pelatihan dan sertifikasi kompetensi lingkungan hidup & limbah B3 berlisensi BNSP resmi (' . $total . ' program: PPPA, POPAL, PLB3). Daftar via WA.',
    ],
    'mining' => [
        'title' => 'Pelatihan K3 Pertambangan & Mining BNSP | Wahana Totalita',
        'h1'    => 'Pelatihan K3 Pertambangan (Minerba)',
        'desc'  => 'Sertifikasi kompetensi pengawas operasional pertambangan berlisensi BNSP (' . $total . ' program: POP, POM, POU minerba). Hubungi tim kami via WhatsApp.',
    ],
    'system-management' => [
        'title' => 'Pelatihan ISO & Sistem Manajemen SMK3 | Wahana Totalita',
        'h1'    => 'Pelatihan ISO & Sistem Manajemen (SMK3)',
        'desc'  => 'Pelatihan dan konsultasi sistem manajemen (' . $total . ' program: SMK3 PP 50/2012, ISO 9001, 14001, 45001). Sertifikasi resmi & pendampingan audit.',
    ],
];

$seo_info   = $CATEGORY_SEO[$cat_slug] ?? null;
$page_title = $seo_info['title'] ?? ('Pelatihan ' . $category['name'] . ' Resmi | Wahana Totalita');
$page_h1    = $seo_info['h1']    ?? ('Pelatihan ' . $category['name']);
$page_desc  = $seo_info['desc']  ?? ('Daftar ' . $total . ' program pelatihan ' . $category['name'] . ' resmi berlisensi Kemnaker RI & BNSP. Tersedia kelas online & offline.');
$canonical  = SITE_URL . '/pelatihan/' . $cat_slug . '/' . ($page > 1 ? '?page=' . $page : '');
$accent     = $category['accent_color'] ?? 'var(--accent)';

?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($page_title) ?></title>
<meta name="description" content="<?= e($page_desc) ?>">
<link rel="canonical" href="<?= htmlspecialchars($canonical) ?>">

<!-- Open Graph -->
<meta property="og:type" content="website">
<meta property="og:title" content="<?= e($page_title) ?>">
<meta property="og:description" content="<?= e($page_desc) ?>">
<meta property="og:url" content="<?= htmlspecialchars($canonical) ?>">
<meta property="og:site_name" content="<?= e($s['site_name'] ?? 'Wahana Totalita') ?>">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preload" as="style" href="<?= theme_font_url($s ?? []) ?>">
<link rel="stylesheet" href="<?= theme_font_url($s ?? []) ?>" media="print" onload="this.media='all'">
<noscript>
  <link rel="stylesheet" href="<?= theme_font_url($s ?? []) ?>">
</noscript>

<?php require __DIR__ . '/includes/css.php'; ?>

<link rel="stylesheet" href="<?= asset_v('/assets/css/page/pelatihan-kategori.css') ?>">
</head>
<body>

<?php require __DIR__ . '/includes/navbar.php'; ?>

<!-- BREADCRUMB -->
<div class="breadcrumb-bar">
  <div class="container">
    <nav aria-label="Breadcrumb">
      <ol class="breadcrumb-list">
        <li><a href="/">Beranda</a></li>
        <li aria-hidden="true">›</li>
        <li><a href="/pelatihan/">Pelatihan</a></li>
        <li aria-hidden="true">›</li>
        <li aria-current="page"><?= e($category['name']) ?></li>
      </ol>
    </nav>
  </div>
</div>

<!-- CATEGORY HERO -->
<section class="cat-hero-banner" style="--cat-accent: <?= e($accent) ?>">
  <div class="container cat-hero-inner">
    <?php if (!empty($category['icon'])): ?>
      <span class="cat-hero-icon"><?= $category['icon'] ?></span>
    <?php endif; ?>
    <h1 class="cat-hero-title"><?= e($page_h1) ?></h1>

    <p class="cat-hero-sub"><?= $total ?> program pelatihan bersertifikasi resmi Kemnaker RI &amp; BNSP, siap tatap muka di Yogyakarta maupun in-house di lokasi perusahaan Anda di seluruh Indonesia.</p>
    <div class="cat-hero-badges">
      <span class="cat-hero-badge">🏛️ Sertifikasi Resmi Kemnaker &amp; BNSP</span>
      <span class="cat-hero-badge">💻 Online Virtual &amp; Tatap Muka</span>
      <span class="cat-hero-badge">🏢 Siap In-House Training</span>
    </div>
  </div>
</section>

<!-- TRAINING LISTINGS -->
<main class="cat-section">
  <div class="container">
    <div class="cat-top-meta">
      <span class="cat-count-pill">Menampilkan <strong><?= count($trainings) ?></strong> dari <strong><?= $total ?></strong> Program (Halaman <?= $page ?> dari <?= $total_pages ?>)</span>
    </div>

    <div class="training-grid" id="training-grid">
      <?php foreach ($trainings as $t): ?>
      <article class="training-card fade-in" data-cat="<?= e($t['cat_slug']) ?>" data-mode="<?= e($t['mode']) ?>" style="--accent: <?= e($t['accent_color'] ?? $accent) ?>">
        <a href="/pelatihan/<?= e($t['slug']) ?>/" class="training-card-img-wrap">
          <img src="<?= training_img_url($t['image_path'], $t['cat_slug'] ?? '', $t['slug'] ?? '') ?>"
               alt="<?= e((stripos($t['name'], 'pelatihan') === false ? 'Pelatihan ' : '') . $t['name'] . (!empty($t['certification']) ? ' Sertifikasi ' . $t['certification'] : '')) ?>"
               loading="lazy" decoding="async" width="400" height="250">
          <span class="training-card-cat-badge"><?= $t['cat_icon'] ?? '🦺' ?> <?= e($t['cat_name'] ?? $category['name']) ?></span>
        </a>
        <div class="training-card-body">
          <div class="training-card-meta">
            <span class="badge-mode"><?= e(mode_label($t['mode'])) ?></span>
            <span class="badge-cert"><?= e($t['certification']) ?></span>
          </div>
          <h3 class="training-card-title"><a href="/pelatihan/<?= e($t['slug']) ?>/"><?= e($t['name']) ?></a></h3>
          <ul class="training-card-features">
            <?php if (!empty($t['duration_days'])): ?>
            <li><span class="tcf-ico">⏱</span> <?= (int)$t['duration_days'] ?> hari pelatihan</li>
            <?php endif; ?>
            <?php if (!empty($t['validity_months'])): ?>
            <li><span class="tcf-ico">🔄</span> Sertifikat berlaku <?= (int)round($t['validity_months']/12) ?> tahun</li>
            <?php endif; ?>
            <li><span class="tcf-ico">✓</span> Sertifikat + modul + e-certificate</li>
          </ul>
          <div class="training-card-footer">
            <span class="training-price"><?= format_price((int)$t['price']) ?> <small>/orang</small></span>
            <a href="<?= wa_url($t['wa_text'] ?? 'Halo, saya ingin info ' . $t['name']) ?>" class="btn-wa-card" target="_blank" rel="noopener">Daftar Sekarang</a>
          </div>
        </div>
      </article>
      <?php endforeach; ?>
    </div>

    <!-- PAGINATION -->
    <?php if ($total_pages > 1): ?>
    <nav class="cat-pagination-wrap" aria-label="Navigasi Halaman">
      <?php if ($page > 1): ?>
        <a href="/pelatihan/<?= e($cat_slug) ?>/?page=<?= $page - 1 ?>" class="cat-pg-btn" aria-label="Sebelumnya">‹</a>
      <?php endif; ?>

      <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <?php if ($i === $page): ?>
          <span class="cat-pg-btn active"><?= $i ?></span>
        <?php else: ?>
          <a href="/pelatihan/<?= e($cat_slug) ?>/?page=<?= $i ?>" class="cat-pg-btn"><?= $i ?></a>
        <?php endif; ?>
      <?php endfor; ?>

      <?php if ($page < $total_pages): ?>
        <a href="/pelatihan/<?= e($cat_slug) ?>/?page=<?= $page + 1 ?>" class="cat-pg-btn" aria-label="Selanjutnya">›</a>
      <?php endif; ?>
    </nav>
    <?php endif; ?>
  </div>
</main>

<!-- SUB-HUBS / SPESIALISASI -->
<?php if (!empty($hub['sub_hubs'])): ?>
<section class="cat-extra-sec">
  <div class="container">
    <div class="cat-extra-head">
      <h2>Spesialisasi <?= e($category['name']) ?></h2>
      <p>Pilih spesialisasi bidang untuk panduan sertifikasi lebih terfokus</p>
    </div>
    <div class="cat-hub-grid">
      <?php foreach ($hub['sub_hubs'] as $url => $name): ?>
      <a href="<?= e($url) ?>" class="cat-hub-card">
        <?= e($name) ?> →
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ARTIKEL TERKAIT -->
<?php if (!empty($related_articles)): ?>
<section class="cat-extra-sec" style="background:var(--surface-subtle);">
  <div class="container">
    <div class="cat-extra-head">
      <h2>Panduan &amp; Artikel <?= e($category['name']) ?> Terkait</h2>
      <p>Pelajari regulasi, syarat ujian, dan materi teknis sebelum mendaftar</p>
    </div>
    <div class="services-grid" style="grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));">
      <?php foreach ($related_articles as $art): ?>
      <a href="/artikel/<?= e($art['slug']) ?>/" class="service-card" style="text-decoration:none;">
        <span class="service-card-icon">📖</span>
        <h3 class="service-card-title"><?= e($art['title']) ?></h3>
        <p class="service-card-desc"><?= e(mb_substr($art['meta_desc'] ?? '', 0, 110)) ?>…</p>
        <span class="service-card-arrow">Baca Panduan →</span>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php require __DIR__ . '/includes/footer.php'; ?>
<?php require __DIR__ . '/includes/scripts.php'; ?>
</body>
</html>
