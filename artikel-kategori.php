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
        SELECT name, slug FROM trainings
        WHERE category_id = ? AND is_active = 1
        ORDER BY sort_order ASC LIMIT 6
    ");
    $tr_stmt->execute([$category['id']]);
    $related_trainings = $tr_stmt->fetchAll(PDO::FETCH_ASSOC);
}

$cat_label = $hub['hub_name'];
$page_title = 'Artikel ' . $cat_label . ' — Wahana Totalita';
$page_desc = 'Kumpulan artikel dan panduan tentang ' . $cat_label . '. ' . $total . ' artikel tersedia.';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<?php
$meta_title = $page_title;
$meta_desc = $page_desc;
$canonical = SITE_URL . '/artikel/' . $cat_slug . '/';
include __DIR__ . '/includes/head.php';
?>
<style>
.acat-hero{background:linear-gradient(135deg,#1a5276,#1a5276cc);color:#fff;padding:3rem 0;text-align:center}
.acat-hero h1{font-size:2rem;margin:0 0 .5rem}
.acat-hero p{opacity:.9;max-width:600px;margin:0 auto}
.acat-breadcrumb{padding:1rem 0;font-size:.875rem;color:#666}
.acat-breadcrumb a{color:#1a5276;text-decoration:none}
.acat-breadcrumb a:hover{text-decoration:underline}
.acat-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:1.5rem;padding:2rem 0}
.acat-card{border:1px solid #e0e0e0;border-radius:8px;overflow:hidden;transition:box-shadow .2s}
.acat-card:hover{box-shadow:0 4px 16px rgba(0,0,0,.1)}
.acat-card-img{height:180px;background:#f0f0f0;overflow:hidden}
.acat-card-img img{width:100%;height:100%;object-fit:cover}
.acat-card-body{padding:1rem}
.acat-card-body h3{margin:0 0 .5rem;font-size:1.05rem}
.acat-card-body h3 a{color:#1a1a1a;text-decoration:none}
.acat-card-body h3 a:hover{color:#1a5276}
.acat-card-date{font-size:.8rem;color:#888;margin-bottom:.5rem}
.acat-card-desc{font-size:.9rem;color:#555;line-height:1.5}
.acat-pagination{display:flex;justify-content:center;gap:.5rem;padding:2rem 0}
.acat-pagination a,.acat-pagination span{display:inline-flex;align-items:center;justify-content:center;min-width:40px;height:40px;border:1px solid #ddd;border-radius:6px;text-decoration:none;color:#333;font-size:.9rem}
.acat-pagination .active{background:#1a5276;color:#fff;border-color:transparent}
.acat-trainings{background:#f8f9fa;padding:2rem 0;margin-top:2rem}
.acat-trainings h2{text-align:center;margin:0 0 1.5rem;font-size:1.4rem}
.training-link-list{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:1rem;max-width:900px;margin:0 auto}
.training-link-item{background:#fff;border:1px solid #e0e0e0;border-radius:8px;padding:1rem}
.training-link-item a{color:#1a5276;text-decoration:none;font-weight:600}
.training-link-item a:hover{text-decoration:underline}
</style>
</head>
<body>
<?php include __DIR__ . '/includes/navbar.php'; ?>

<div class="acat-breadcrumb">
  <div class="container">
    <a href="/">Beranda</a> &gt;
    <a href="/artikel/">Artikel</a> &gt;
    <span><?= e($cat_label) ?></span>
  </div>
</div>

<section class="acat-hero">
  <div class="container">
    <h1>Artikel <?= e($cat_label) ?></h1>
    <p><?= $total ?> artikel dan panduan tersedia</p>
  </div>
</section>

<main class="container">
  <div class="acat-grid">
    <?php foreach ($articles as $art): ?>
    <div class="acat-card">
      <?php if (!empty($art['thumbnail'])): ?>
      <div class="acat-card-img">
        <a href="/artikel/<?= e($art['slug']) ?>/">
          <img src="<?= e($art['thumbnail']) ?>" alt="<?= e($art['title']) ?>" loading="lazy">
        </a>
      </div>
      <?php endif; ?>
      <div class="acat-card-body">
        <h3><a href="/artikel/<?= e($art['slug']) ?>/"><?= e($art['title']) ?></a></h3>
        <?php if (!empty($art['published_at'])): ?>
        <div class="acat-card-date"><?= date('d M Y', strtotime($art['published_at'])) ?></div>
        <?php endif; ?>
        <?php if (!empty($art['meta_desc'])): ?>
        <div class="acat-card-desc"><?= e(mb_substr($art['meta_desc'], 0, 120)) ?>…</div>
        <?php endif; ?>
      </div>
    </div>
    <?php endforeach; ?>
  </div>

  <?php if ($total_pages > 1): ?>
  <nav class="acat-pagination" aria-label="Pagination">
    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
      <?php if ($i === $page): ?>
        <span class="active"><?= $i ?></span>
      <?php else: ?>
        <a href="/artikel/<?= e($cat_slug) ?>/?page=<?= $i ?>"><?= $i ?></a>
      <?php endif; ?>
    <?php endfor; ?>
  </nav>
  <?php endif; ?>
</main>

<?php if (!empty($related_trainings)): ?>
<section class="acat-trainings">
  <div class="container">
    <h2>Program Pelatihan <?= e($cat_label) ?></h2>
    <div class="training-link-list">
      <?php foreach ($related_trainings as $tr): ?>
      <div class="training-link-item">
        <a href="/pelatihan/<?= e($tr['slug']) ?>/"><?= e($tr['name']) ?></a>
      </div>
      <?php endforeach; ?>
    </div>
    <p style="text-align:center;margin-top:1rem">
      <a href="/pelatihan/<?= e($cat_slug) ?>/" style="color:#1a5276;font-weight:600">Lihat semua program <?= e($cat_label) ?> →</a>
    </p>
  </div>
</section>
<?php endif; ?>

<?php include __DIR__ . '/includes/footer.php'; ?>
</body>
</html>
