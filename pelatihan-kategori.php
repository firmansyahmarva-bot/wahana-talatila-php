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
$cat_row = $pdo->prepare("SELECT * FROM categories WHERE slug = ? AND is_active = 1");
$cat_row->execute([$cat_slug]);
$category = $cat_row->fetch(PDO::FETCH_ASSOC);

if (!$category) {
    http_response_code(404);
    include __DIR__ . '/404.php';
    exit;
}

$page = max(1, (int)($_GET['page'] ?? 1));
$per_page = 24;
$offset = ($page - 1) * $per_page;

$count_stmt = $pdo->prepare("SELECT COUNT(*) FROM trainings WHERE category_id = ? AND is_active = 1");
$count_stmt->execute([$category['id']]);
$total = $count_stmt->fetchColumn();
$total_pages = max(1, ceil($total / $per_page));

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

$related_articles = [];
if (!empty($hub['article_cats'])) {
    $placeholders = implode(',', array_fill(0, count($hub['article_cats']), '?'));
    $art_stmt = $pdo->prepare("
        SELECT title, slug, meta_desc, thumbnail, published_at
        FROM articles
        WHERE category IN ($placeholders) AND status = 'published'
        ORDER BY published_at DESC LIMIT 6
    ");
    $art_stmt->execute($hub['article_cats']);
    $related_articles = $art_stmt->fetchAll(PDO::FETCH_ASSOC);
}

$page_title = 'Pelatihan ' . $category['name'] . ' Bersertifikasi Kemnaker & BNSP — Wahana Totalita';
$page_desc = 'Daftar ' . $total . ' program pelatihan ' . $category['name'] . ' resmi berlisensi Kemnaker RI & BNSP. Tersedia kelas online, tatap muka di Yogyakarta, dan in-house training.';
$canonical = SITE_URL . '/pelatihan/' . $cat_slug . '/' . ($page > 1 ? '?page=' . $page : '');
$accent = $category['accent_color'] ?? '#0A4A2E';
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

<link rel="stylesheet" href="/assets/css/base.css">
<link rel="stylesheet" href="/assets/css/components.min.css">
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
.cat-hero-banner {
  background: linear-gradient(135deg, <?= e($accent) ?> 0%, #0B2C46 100%);
  color: #fff;
  padding: 48px 0 44px;
  position: relative;
  overflow: hidden;
}
.cat-hero-banner::before {
  content: '';
  position: absolute;
  inset: 0;
  background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,.07) 1px, transparent 0);
  background-size: 28px 28px;
  pointer-events: none;
}
.cat-hero-inner {
  position: relative;
  z-index: 1;
  text-align: center;
  max-width: 780px;
  margin: 0 auto;
}
.cat-hero-icon {
  font-size: 2.8rem;
  margin-bottom: 12px;
  display: inline-block;
  line-height: 1;
}
.cat-hero-title {
  font-family: 'Lexend', sans-serif;
  font-size: clamp(1.8rem, 4vw, 2.6rem);
  font-weight: 800;
  color: #fff;
  line-height: 1.15;
  margin-bottom: 12px;
}
.cat-hero-sub {
  font-size: 15.5px;
  color: #D6E4EE;
  line-height: 1.65;
  margin-bottom: 22px;
}
.cat-hero-badges {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 10px;
}
.cat-hero-badge {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: rgba(255,255,255,.12);
  border: 1px solid rgba(255,255,255,.24);
  color: #fff;
  font-size: 12.5px;
  font-weight: 600;
  padding: 6px 14px;
  border-radius: 999px;
  backdrop-filter: blur(4px);
}

/* Catalog Main Section */
.cat-section {
  padding: 50px 0 70px;
  background: #F6F9FC;
}
.cat-top-meta {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 16px;
  margin-bottom: 28px;
  flex-wrap: wrap;
}
.cat-count-pill {
  font-size: 14px;
  color: var(--text-muted);
  font-weight: 600;
}
.cat-count-pill strong {
  color: var(--text);
}

/* Pagination */
.cat-pagination-wrap {
  display: flex;
  justify-content: center;
  gap: 8px;
  margin-top: 48px;
}
.cat-pg-btn {
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
.cat-pg-btn:hover {
  border-color: var(--green);
  color: var(--green);
}
.cat-pg-btn.active {
  background: var(--green);
  color: #fff;
  border-color: var(--green);
}

/* Sub-hubs & Articles */
.cat-extra-sec {
  background: #fff;
  padding: 50px 0;
  border-top: 1px solid #e8e8e8;
}
.cat-extra-head {
  text-align: center;
  margin-bottom: 32px;
}
.cat-extra-head h2 {
  font-size: 1.4rem;
  font-weight: 800;
  color: var(--green);
  margin-bottom: 6px;
}
.cat-extra-head p {
  color: var(--text-muted);
  font-size: 14px;
}
.cat-hub-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 14px;
}
.cat-hub-card {
  display: block;
  background: #F8FAFC;
  border: 1.5px solid var(--border);
  border-radius: 12px;
  padding: 16px 20px;
  color: var(--green);
  font-weight: 700;
  font-size: 14px;
  text-decoration: none;
  transition: all .2s;
}
.cat-hub-card:hover {
  background: var(--green-light);
  border-color: var(--green);
  transform: translateY(-2px);
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
        <li><a href="/pelatihan/">Pelatihan</a></li>
        <li aria-hidden="true">›</li>
        <li aria-current="page"><?= e($category['name']) ?></li>
      </ol>
    </nav>
  </div>
</div>

<!-- CATEGORY HERO -->
<section class="cat-hero-banner">
  <div class="container cat-hero-inner">
    <?php if (!empty($category['icon'])): ?>
      <span class="cat-hero-icon"><?= $category['icon'] ?></span>
    <?php endif; ?>
    <h1 class="cat-hero-title">Pelatihan <?= e($category['name']) ?></h1>
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
               alt="<?= e($t['name'] . ' bersertifikasi ' . $t['certification']) ?>"
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
<section class="cat-extra-sec" style="background:#F6F9FC;">
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
