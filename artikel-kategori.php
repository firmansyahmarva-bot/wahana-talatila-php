<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/hub-category-map.php';

$pdo = get_pdo();
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

$placeholders = implode(',', array_fill(0, count($article_cats), '?'));

$count_stmt = $pdo->prepare("SELECT COUNT(*) FROM articles WHERE category IN ($placeholders) AND status = 'published'");
$count_stmt->execute($article_cats);
$total = $count_stmt->fetchColumn();
$total_pages = max(1, ceil($total / $per_page));

$stmt = $pdo->prepare("
    SELECT title, slug, meta_desc, thumbnail, category, published_at
    FROM articles
    WHERE category IN ($placeholders) AND status = 'published'
    ORDER BY published_at DESC
    LIMIT " . (int)$per_page . " OFFSET " . (int)$offset . "
");
$stmt->execute($article_cats);
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

$related_trainings = [];
$cat_row = $pdo->prepare("SELECT id, name FROM categories WHERE slug = ? AND is_active = 1");
$cat_row->execute([$cat_slug]);
$category = $cat_row->fetch(PDO::FETCH_ASSOC);
if ($category) {
    $tr_stmt = $pdo->prepare("
        SELECT t.*, c.name AS cat_name, c.slug AS cat_slug, c.icon AS cat_icon, c.accent_color
        FROM trainings t
        LEFT JOIN categories c ON c.id = t.category_id
        WHERE t.category_id = ? AND t.is_active = 1
        ORDER BY t.sort_order ASC LIMIT 6
    ");
    $tr_stmt->execute([$category['id']]);
    $related_trainings = $tr_stmt->fetchAll(PDO::FETCH_ASSOC);
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
<link rel="preload" href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;600;700;800&family=Source+Sans+3:wght@400;600;700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;600;700;800&family=Source+Sans+3:wght@400;600;700&display=swap">
</noscript>

<link rel="stylesheet" href="<?= asset_v('/assets/css/core.min.css') ?>">
<link rel="stylesheet" href="<?= asset_v('/assets/css/components.min.css') ?>">
<?= theme_css_vars($s) ?>

<style>
/* Light navbar fix */
#navbar:not(.scrolled) { background: rgba(255,255,255,.97) !important; border-bottom-color: #e8e8e8 !important; }
#navbar:not(.scrolled) .nav-logo { color: var(--green) !important; }
#navbar:not(.scrolled) .nav-links a { color: var(--text) !important; }
#navbar:not(.scrolled) .nav-logo-text strong {
  background: linear-gradient(135deg, var(--green) 30%, var(--orange));
  -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
}
#navbar:not(.scrolled) .nav-hamburger span { background: var(--text) !important; }
#navbar:not(.scrolled) .nav-socials a { color: var(--text-muted) !important; }

/* Category Hero Banner */
.acat-hero-banner {
  background: linear-gradient(135deg, #103A5C 0%, #0B2C46 100%);
  color: #fff;
  padding: 48px 0 44px;
  position: relative;
  overflow: hidden;
}
.acat-hero-banner::before {
  content: '';
  position: absolute;
  inset: 0;
  background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,.07) 1px, transparent 0);
  background-size: 28px 28px;
  pointer-events: none;
}
.acat-hero-inner {
  position: relative;
  z-index: 1;
  text-align: center;
  max-width: 780px;
  margin: 0 auto;
}
.acat-hero-icon {
  font-size: 2.8rem;
  margin-bottom: 12px;
  display: inline-block;
  line-height: 1;
}
.acat-hero-title {
  font-family: 'Lexend', sans-serif;
  font-size: clamp(1.8rem, 4vw, 2.6rem);
  font-weight: 800;
  color: #fff;
  line-height: 1.15;
  margin-bottom: 12px;
}
.acat-hero-sub {
  font-size: 15.5px;
  color: #D6E4EE;
  line-height: 1.65;
  margin-bottom: 0;
}

/* Articles Section */
.acat-section {
  padding: 50px 0 70px;
  background: #F6F9FC;
}
.acat-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
  gap: 24px;
}
.article-card {
  background: #fff;
  border-radius: var(--radius, 14px);
  overflow: hidden;
  border: 1.5px solid var(--border);
  box-shadow: 0 4px 20px rgba(0,0,0,.04);
  transition: transform .2s, box-shadow .2s;
  display: flex;
  flex-direction: column;
}
.article-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 12px 30px rgba(0,0,0,.08);
}
.article-card-img-wrap {
  display: block;
  position: relative;
  aspect-ratio: 16 / 10;
  overflow: hidden;
  background: var(--green-light);
}
.article-card-img-wrap img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform .35s;
}
.article-card:hover .article-card-img-wrap img {
  transform: scale(1.05);
}
.article-card-body {
  padding: 20px;
  flex: 1;
  display: flex;
  flex-direction: column;
}
.article-card-date {
  font-size: 12px;
  font-weight: 600;
  color: var(--text-muted);
  margin-bottom: 8px;
}
.article-card-title {
  font-family: 'Lexend', sans-serif;
  font-size: 16px;
  font-weight: 700;
  color: var(--text);
  line-height: 1.4;
  margin-bottom: 10px;
}
.article-card-title a {
  color: inherit;
  text-decoration: none;
}
.article-card-title a:hover {
  color: var(--green);
}
.article-card-desc {
  font-size: 14px;
  color: var(--text-muted);
  line-height: 1.65;
  margin-bottom: 16px;
  flex: 1;
}
.article-card-more {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  font-size: 13px;
  font-weight: 700;
  color: var(--green);
  text-decoration: none;
  margin-top: auto;
}
.article-card-more:hover {
  color: var(--orange);
}

/* Pagination */
.acat-pagination-wrap {
  display: flex;
  justify-content: center;
  gap: 8px;
  margin-top: 48px;
}
.acat-pg-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  min-width: 42px;
  height: 42px;
  padding: 0 14px;
  border-radius: 10px;
  font-size: 14px;
  font-weight: 700;
  background: #fff;
  color: var(--text);
  border: 1.5px solid var(--border);
  text-decoration: none;
  transition: all .2s;
}
.acat-pg-btn:hover {
  border-color: var(--green);
  color: var(--green);
}
.acat-pg-btn.active {
  background: var(--green);
  color: #fff;
  border-color: var(--green);
}

/* Related Trainings Box */
.acat-trainings-sec {
  background: #fff;
  padding: 56px 0;
  border-top: 1px solid #e8e8e8;
}
.acat-trainings-head {
  text-align: center;
  margin-bottom: 32px;
}
.acat-trainings-head h2 {
  font-size: 1.5rem;
  font-weight: 800;
  color: var(--green);
  margin-bottom: 6px;
}
.acat-trainings-head p {
  color: var(--text-muted);
  font-size: 14.5px;
}
</style>
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
               alt="<?= e($art['title']) ?>"
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
      <article class="training-card fade-in" data-cat="<?= e($t['cat_slug']) ?>" data-mode="<?= e($t['mode']) ?>" style="--accent: <?= e($t['accent_color'] ?? '#0A4A2E') ?>">
        <a href="/pelatihan/<?= e($t['slug']) ?>/" class="training-card-img-wrap">
          <img src="<?= training_img_url($t['image_path'], $t['cat_slug'] ?? '', $t['slug'] ?? '') ?>"
               alt="<?= e($t['name'] . ' bersertifikasi ' . $t['certification']) ?>"
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
