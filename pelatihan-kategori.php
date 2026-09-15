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

$page_title = 'Pelatihan ' . $category['name'] . ' — Wahana Totalita';
$page_desc = 'Daftar lengkap program pelatihan ' . $category['name'] . ' bersertifikasi dari Wahana Totalita. ' . $total . ' program tersedia.';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<?php
$meta_title = $page_title;
$meta_desc = $page_desc;
$canonical = SITE_URL . '/pelatihan/' . $cat_slug . '/';
include __DIR__ . '/includes/head.php';
?>
<style>
.cat-hero{background:linear-gradient(135deg,<?= e($category['accent_color'] ?? '#1a5276') ?>,<?= e($category['accent_color'] ?? '#1a5276') ?>cc);color:#fff;padding:3rem 0;text-align:center}
.cat-hero h1{font-size:2rem;margin:0 0 .5rem}
.cat-hero p{opacity:.9;max-width:600px;margin:0 auto}
.cat-breadcrumb{padding:1rem 0;font-size:.875rem;color:#666}
.cat-breadcrumb a{color:#1a5276;text-decoration:none}
.cat-breadcrumb a:hover{text-decoration:underline}
.cat-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:1.5rem;padding:2rem 0}
.cat-card{border:1px solid #e0e0e0;border-radius:8px;overflow:hidden;transition:box-shadow .2s}
.cat-card:hover{box-shadow:0 4px 16px rgba(0,0,0,.1)}
.cat-card-img{height:180px;background:#f0f0f0;overflow:hidden}
.cat-card-img img{width:100%;height:100%;object-fit:cover}
.cat-card-body{padding:1rem}
.cat-card-body h3{margin:0 0 .5rem;font-size:1.1rem}
.cat-card-body h3 a{color:#1a1a1a;text-decoration:none}
.cat-card-body h3 a:hover{color:<?= e($category['accent_color'] ?? '#1a5276') ?>}
.cat-card-meta{font-size:.8rem;color:#888;margin-bottom:.5rem}
.cat-card-desc{font-size:.9rem;color:#555;line-height:1.5}
.cat-pagination{display:flex;justify-content:center;gap:.5rem;padding:2rem 0}
.cat-pagination a,.cat-pagination span{display:inline-flex;align-items:center;justify-content:center;min-width:40px;height:40px;border:1px solid #ddd;border-radius:6px;text-decoration:none;color:#333;font-size:.9rem}
.cat-pagination .active{background:<?= e($category['accent_color'] ?? '#1a5276') ?>;color:#fff;border-color:transparent}
.cat-hub-links{background:#f8f9fa;padding:2rem 0;margin-top:2rem}
.cat-hub-links h2{text-align:center;margin:0 0 1.5rem;font-size:1.4rem}
.hub-link-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:1rem}
.hub-link-card{background:#fff;border:1px solid #e0e0e0;border-radius:8px;padding:1rem;text-align:center}
.hub-link-card a{color:#1a5276;text-decoration:none;font-weight:600}
.hub-link-card a:hover{text-decoration:underline}
.cat-articles{padding:2rem 0}
.cat-articles h2{margin:0 0 1.5rem;font-size:1.4rem}
.article-list{display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:1.5rem}
.article-item a{color:#1a5276;text-decoration:none;font-weight:600;font-size:1.05rem}
.article-item a:hover{text-decoration:underline}
.article-item p{color:#555;font-size:.9rem;margin:.25rem 0 0}
</style>
</head>
<body>
<?php include __DIR__ . '/includes/navbar.php'; ?>

<div class="cat-breadcrumb">
  <div class="container">
    <a href="/">Beranda</a> &gt;
    <a href="/pelatihan/">Pelatihan</a> &gt;
    <span><?= e($category['name']) ?></span>
  </div>
</div>

<section class="cat-hero">
  <div class="container">
    <?php if (!empty($category['icon'])): ?><div style="font-size:2.5rem;margin-bottom:.5rem"><?= $category['icon'] ?></div><?php endif; ?>
    <h1>Pelatihan <?= e($category['name']) ?></h1>
    <p><?= $total ?> program pelatihan bersertifikasi tersedia</p>
  </div>
</section>

<main class="container">
  <div class="cat-grid">
    <?php foreach ($trainings as $t): ?>
    <div class="cat-card">
      <?php if (!empty($t['image_path'])): ?>
      <div class="cat-card-img">
        <a href="/pelatihan/<?= e($t['slug']) ?>/">
          <img src="<?= e($t['image_path']) ?>" alt="<?= e($t['name']) ?>" loading="lazy">
        </a>
      </div>
      <?php endif; ?>
      <div class="cat-card-body">
        <h3><a href="/pelatihan/<?= e($t['slug']) ?>/"><?= e($t['name']) ?></a></h3>
        <div class="cat-card-meta">
          <?php if (!empty($t['duration_days'])): ?><?= $t['duration_days'] ?> hari<?php endif; ?>
          <?php if (!empty($t['certification'])): ?> · <?= e($t['certification']) ?><?php endif; ?>
        </div>
        <?php if (!empty($t['meta_desc'])): ?>
        <div class="cat-card-desc"><?= e(mb_substr($t['meta_desc'], 0, 120)) ?>…</div>
        <?php endif; ?>
      </div>
    </div>
    <?php endforeach; ?>
  </div>

  <?php if ($total_pages > 1): ?>
  <nav class="cat-pagination" aria-label="Pagination">
    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
      <?php if ($i === $page): ?>
        <span class="active"><?= $i ?></span>
      <?php else: ?>
        <a href="/pelatihan/<?= e($cat_slug) ?>/?page=<?= $i ?>"><?= $i ?></a>
      <?php endif; ?>
    <?php endfor; ?>
  </nav>
  <?php endif; ?>
</main>

<?php if (!empty($hub['sub_hubs'])): ?>
<section class="cat-hub-links">
  <div class="container">
    <h2>Spesialisasi <?= e($category['name']) ?></h2>
    <div class="hub-link-grid">
      <div class="hub-link-card">
        <a href="<?= e($hub['hub_url']) ?>"><?= e($hub['hub_name']) ?></a>
      </div>
      <?php foreach ($hub['sub_hubs'] as $url => $name): ?>
      <div class="hub-link-card">
        <a href="<?= e($url) ?>"><?= e($name) ?></a>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php if (!empty($related_articles)): ?>
<section class="cat-articles">
  <div class="container">
    <h2>Artikel Seputar <?= e($category['name']) ?></h2>
    <div class="article-list">
      <?php foreach ($related_articles as $art): ?>
      <div class="article-item">
        <a href="/artikel/<?= e($art['slug']) ?>/"><?= e($art['title']) ?></a>
        <?php if (!empty($art['meta_desc'])): ?>
        <p><?= e(mb_substr($art['meta_desc'], 0, 120)) ?>…</p>
        <?php endif; ?>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php include __DIR__ . '/includes/footer.php'; ?>
</body>
</html>
