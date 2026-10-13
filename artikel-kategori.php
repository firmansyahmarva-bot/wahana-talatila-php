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
$article_cats = $hub['article_cats'];

$page = max(1, (int)($_GET['page'] ?? 1));
$per_page = 24;
$offset = ($page - 1) * $per_page;

$all_cat_articles = [];
$articles_file = __DIR__ . '/data/articles.json';
if (file_exists($articles_file)) {
    $raw_articles = json_decode(file_get_contents($articles_file), true) ?: [];
    foreach ($raw_articles as $a) {
        if (($a['status'] ?? 'published') !== 'published') continue;
        if (in_array($a['category'] ?? '', $article_cats, true)) {
            $all_cat_articles[] = $a;
        }
    }
    usort($all_cat_articles, fn($a, $b) => strcmp($b['published_at'] ?? $b['created_at'] ?? '', $a['published_at'] ?? $a['created_at'] ?? ''));
} else {
    try {
        $pdo = get_pdo();
        $placeholders = implode(',', array_fill(0, count($article_cats), '?'));
        $stmt = $pdo->prepare("
            SELECT title, slug, meta_desc, thumbnail, category, published_at
            FROM articles
            WHERE category IN ($placeholders) AND status = 'published'
            ORDER BY published_at DESC
        ");
        $stmt->execute($article_cats);
        $all_cat_articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception) { $all_cat_articles = []; }
}

$total = count($all_cat_articles);
$total_pages = max(1, (int)ceil($total / $per_page));
$articles = array_slice($all_cat_articles, $offset, $per_page);

$related_trainings = [];
$trainings_file = __DIR__ . '/data/trainings.json';
if (file_exists($trainings_file)) {
    $raw_trainings = json_decode(file_get_contents($trainings_file), true) ?: [];
    foreach ($raw_trainings as $tr) {
        if (!($tr['is_active'] ?? 1)) continue;
        if (($tr['cat_slug'] ?? '') === $cat_slug || ($tr['category_slug'] ?? '') === $cat_slug) {
            $related_trainings[] = $tr;
            if (count($related_trainings) >= 6) break;
        }
    }
}

$cat_label = $hub['hub_name'];
$page_title = 'Artikel & Panduan ' . $cat_label . ' — Wahana Totalita';
$page_desc = 'Kumpulan ' . $total . ' artikel, regulasi, dan panduan praktis seputar ' . $cat_label . ' dari praktisi dan instruktur berpengalaman Wahana Totalita.';
$canonical = SITE_URL . '/artikel/' . $cat_slug . '/' . ($page > 1 ? '?page=' . $page : '');
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

<link rel="stylesheet" href="<?= asset_v('/assets/css/page/artikel-kategori.css') ?>">
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
        <li><a href="/artikel/">Artikel</a></li>
        <li aria-hidden="true">›</li>
        <li aria-current="page"><?= e($cat_label) ?></li>
      </ol>
    </nav>
  </div>
</div>

<!-- HERO BANNER -->
<section class="acat-hero-banner">
  <div class="container acat-hero-inner">
    <span class="acat-hero-icon">📚</span>
    <h1 class="acat-hero-title">Artikel &amp; Panduan <?= e($cat_label) ?></h1>
    <p class="acat-hero-sub">Kumpulan <?= $total ?> panduan komprehensif, tips ujian sertifikasi, dan pembahasan regulasi resmi seputar <?= e($cat_label) ?>.</p>
  </div>
</section>

<!-- MAIN ARTICLES LIST -->
<main class="acat-section">
  <div class="container">
    <div class="acat-grid">
      <?php foreach ($articles as $art): ?>
      <article class="article-card">
        <a href="/artikel/<?= e($art['slug']) ?>/" class="article-card-img-wrap">
          <img src="<?= !empty($art['thumbnail']) ? e($art['thumbnail']) : training_img_url(null, $cat_slug, $art['slug']) ?>"
               alt="<?= e($art['title'] . (stripos($art['title'], 'k3') === false ? ' — Info Pelatihan & Sertifikasi K3' : ' — Wahana Totalita')) ?>"
               loading="lazy" decoding="async" width="400" height="250">
        </a>
        <div class="article-card-body">
          <?php if (!empty($art['published_at'])): ?>
          <div class="article-card-date"><?= date('d M Y', strtotime($art['published_at'])) ?></div>
          <?php endif; ?>
          <h3 class="article-card-title">
            <a href="/artikel/<?= e($art['slug']) ?>/"><?= e($art['title']) ?></a>
          </h3>
          <?php if (!empty($art['meta_desc'])): ?>
          <p class="article-card-desc"><?= e(mb_substr($art['meta_desc'], 0, 130)) ?>…</p>
          <?php endif; ?>
          <a href="/artikel/<?= e($art['slug']) ?>/" class="article-card-more">
            Baca Selengkapnya →
          </a>
        </div>
      </article>
      <?php endforeach; ?>
    </div>

    <!-- PAGINATION -->
    <?php if ($total_pages > 1): ?>
    <nav class="acat-pagination-wrap" aria-label="Navigasi Halaman">
      <?php if ($page > 1): ?>
        <a href="/artikel/<?= e($cat_slug) ?>/?page=<?= $page - 1 ?>" class="acat-pg-btn" aria-label="Sebelumnya">‹</a>
      <?php endif; ?>

      <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <?php if ($i === $page): ?>
          <span class="acat-pg-btn active"><?= $i ?></span>
        <?php else: ?>
          <a href="/artikel/<?= e($cat_slug) ?>/?page=<?= $i ?>" class="acat-pg-btn"><?= $i ?></a>
        <?php endif; ?>
      <?php endfor; ?>

      <?php if ($page < $total_pages): ?>
        <a href="/artikel/<?= e($cat_slug) ?>/?page=<?= $page + 1 ?>" class="acat-pg-btn" aria-label="Selanjutnya">›</a>
      <?php endif; ?>
    </nav>
    <?php endif; ?>
  </div>
</main>

<!-- PROGRAM PELATIHAN TERKAIT -->
<?php if (!empty($related_trainings)): ?>
<section class="acat-trainings-sec">
  <div class="container">
    <div class="acat-trainings-head">
      <h2>Program Pelatihan <?= e($cat_label) ?> Terkait</h2>
      <p>Tingkatkan kompetensi Anda dengan sertifikasi resmi Kemnaker RI &amp; BNSP</p>
    </div>
    <div class="training-grid">
      <?php foreach ($related_trainings as $t): ?>
      <article class="training-card fade-in" data-cat="<?= e($t['cat_slug']) ?>" data-mode="<?= e($t['mode']) ?>" style="--accent: <?= e($t['accent_color'] ?? 'var(--accent)') ?>">
        <a href="/pelatihan/<?= e($t['slug']) ?>/" class="training-card-img-wrap">
          <img src="<?= training_img_url($t['image_path'], $t['cat_slug'] ?? '', $t['slug'] ?? '') ?>"
               alt="<?= e((stripos($t['name'], 'pelatihan') === false ? 'Pelatihan ' : '') . $t['name'] . (!empty($t['certification']) ? ' Sertifikasi ' . $t['certification'] : '')) ?>"
               loading="lazy" decoding="async" width="400" height="250">
          <span class="training-card-cat-badge"><?= $t['cat_icon'] ?? '🦺' ?> <?= e($t['cat_name'] ?? $cat_label) ?></span>
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
    <p style="text-align:center;margin-top:28px">
      <a href="/pelatihan/<?= e($cat_slug) ?>/" style="color:var(--green);font-weight:800;font-size:15px;text-decoration:none">
        Lihat Semua Program <?= e($cat_label) ?> →
      </a>
    </p>
  </div>
</section>
<?php endif; ?>

<?php require __DIR__ . '/includes/footer.php'; ?>
<?php require __DIR__ . '/includes/scripts.php'; ?>
</body>
</html>
