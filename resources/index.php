<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/resources-functions.php';

$settings = get_all_settings();
$s = get_all_settings();

// Filters
$catSlug = get_url_slug();
$search  = htmlspecialchars(trim($_GET['q'] ?? ''), ENT_QUOTES);
$page    = max(1, (int)($_GET['p'] ?? 1));
$perPage = 16;
$offset  = ($page - 1) * $perPage;

$cat = $catSlug ? get_resource_category_by_slug($catSlug) : null;
$cats= get_resource_categories();
$opts= ['limit'=>$perPage,'offset'=>$offset];
if ($cat)    $opts['category_id'] = $cat['id'];
if ($search) $opts['search']      = $search;

$resources = wt_get_resources($opts);
$total     = count_resources($opts);
$totalPages= max(1, (int)ceil($total / $perPage));
$stats     = get_resource_stats();

$metaTitle = 'Download Dokumen K3 Gratis — Template JSA, Checklist, SOP | Wahana Totalita';
$metaDesc  = 'Ribuan template dokumen K3 gratis: JSA, HIRARC, checklist inspeksi, SOP K3, poster, safety talk. Download langsung untuk kebutuhan HSE Anda.';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($metaTitle) ?></title>
<meta name="description" content="<?= e($metaDesc) ?>">
<link rel="canonical" href="<?= SITE_URL ?>/resources/">
<style><?php
$_core_css_file = __DIR__ . '/../assets/css/core.min.css';
if (is_file($_core_css_file)) {
    readfile($_core_css_file);
} else {
    readfile(__DIR__ . '/../assets/css/tokens.css');
    readfile(__DIR__ . '/../assets/css/core.css');
}
?></style>
<link rel="stylesheet" href="<?= asset_v('/assets/css/components.min.css') ?>" media="print" onload="this.media='all'">
<noscript><link rel="stylesheet" href="<?= asset_v('/assets/css/components.min.css') ?>"></noscript>
<?= theme_css_vars($s) ?>
<style>
.resource-hero{background:linear-gradient(135deg,var(--green),#1a5c3a);padding:60px 0;color:#fff;text-align:center}
.resource-hero h1{font-size:clamp(1.8rem,4vw,2.8rem);font-weight:800;margin:0 0 12px}
.resource-hero p{opacity:.85;max-width:600px;margin:0 auto 24px}
.resource-stats{display:flex;gap:32px;justify-content:center;flex-wrap:wrap;margin-top:24px}
.resource-stats .stat{text-align:center}
.resource-stats .stat strong{display:block;font-size:2rem;font-weight:800}
.resource-stats .stat span{font-size:.85rem;opacity:.75}
.search-bar{background:#fff;border-radius:12px;padding:6px;display:flex;gap:8px;max-width:600px;margin:20px auto 0;box-shadow:0 4px 20px rgba(0,0,0,.15)}
.search-bar input{flex:1;border:none;outline:none;padding:10px 16px;font-size:1rem;background:transparent;color:#222}
.search-bar button{background:var(--orange);color:#fff;border:none;padding:10px 20px;border-radius:8px;cursor:pointer;font-weight:600}
.filter-bar{background:#f8f8f8;border-bottom:1px solid #eee;padding:16px 0;overflow-x:auto}
.filter-bar-inner{display:flex;gap:10px;flex-wrap:nowrap;padding:0 20px;min-width:max-content}
.filter-chip{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;border-radius:100px;border:2px solid #ddd;background:#fff;cursor:pointer;text-decoration:none;color:#333;font-size:.9rem;white-space:nowrap;transition:.2s}
.filter-chip:hover,.filter-chip.active{background:var(--green);color:#fff;border-color:var(--green)}
.resource-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:24px;padding:40px 0}
.resource-card{background:#fff;border-radius:12px;border:1px solid #eee;overflow:hidden;transition:.2s;box-shadow:0 2px 8px rgba(0,0,0,.06)}
.resource-card:hover{box-shadow:0 8px 24px rgba(0,0,0,.12);transform:translateY(-2px)}
.resource-card-top{background:linear-gradient(135deg,var(--green),#1a5c3a);padding:24px 20px;text-align:center;color:#fff}
.resource-card-top .icon{font-size:3rem;display:block;margin-bottom:8px}
.resource-card-top .file-type{display:inline-block;background:rgba(255,255,255,.2);padding:4px 10px;border-radius:100px;font-size:.75rem;font-weight:700;text-transform:uppercase}
.resource-card-body{padding:20px}
.resource-card-body h3{font-size:1rem;font-weight:700;margin:0 0 8px;line-height:1.4;color:#1a1a1a}
.resource-card-body p{font-size:.875rem;color:#666;margin:0 0 16px;line-height:1.5}
.resource-card-meta{display:flex;gap:16px;font-size:.8rem;color:#999;margin-bottom:16px}
.btn-download{display:block;text-align:center;background:var(--orange);color:#fff;padding:10px;border-radius:8px;font-weight:600;text-decoration:none;font-size:.9rem}
.btn-download:hover{background:var(--orange-dark)}
.badge-free{display:inline-block;background:#dcfce7;color:#166534;font-size:.72rem;font-weight:700;padding:3px 8px;border-radius:100px;margin-left:6px}
.empty-state{text-align:center;padding:80px 20px;color:#999}
.empty-state .icon{font-size:4rem;display:block;margin-bottom:16px}
.pagination{display:flex;gap:8px;justify-content:center;padding:40px 0;flex-wrap:wrap}
.page-btn{display:inline-block;padding:8px 16px;border-radius:8px;border:1px solid #ddd;text-decoration:none;color:#333;font-weight:600}
.page-btn.active{background:var(--green);color:#fff;border-color:var(--green)}
.page-btn:hover{border-color:var(--green);color:var(--green)}
</style>
</head>
<body>
<?php include __DIR__ . '/../includes/navbar.php'; ?>

<section class="resource-hero">
  <div class="container">
    <h1>📄 Resource Library K3</h1>
    <p>Download ribuan template dokumen K3 gratis — JSA, HIRARC, Checklist, SOP, Poster, Safety Talk &amp; lebih banyak lagi</p>
    <div class="resource-stats">
      <div class="stat"><strong><?= number_format($stats['total_resources'] ?? 0) ?>+</strong><span>Dokumen</span></div>
      <div class="stat"><strong><?= number_format($stats['total_downloads'] ?? 0) ?>+</strong><span>Download</span></div>
      <div class="stat"><strong><?= number_format($stats['total_leads'] ?? 0) ?>+</strong><span>Pengguna</span></div>
    </div>
    <form class="search-bar" action="" method="GET">
      <?php if ($cat): ?><input type="hidden" name="slug" value="<?= e($catSlug) ?>"><?php endif; ?>
      <input type="search" name="q" placeholder="Cari template, dokumen K3..." value="<?= e($search) ?>" autocomplete="off">
      <button type="submit">🔍 Cari</button>
    </form>
  </div>
</section>

<nav class="filter-bar">
  <div class="filter-bar-inner">
    <a href="/resources/" class="filter-chip <?= !$catSlug ? 'active' : '' ?>">📁 Semua</a>
    <?php foreach ($cats as $c): ?>
    <a href="/resources/kategori/<?= e($c['slug']) ?>/" class="filter-chip <?= $catSlug === $c['slug'] ? 'active' : '' ?>">
      <?= e($c['icon']) ?> <?= e($c['name']) ?>
      <?php if ($c['resource_count'] > 0): ?>
      <span style="font-size:.75rem;opacity:.7">(<?= $c['resource_count'] ?>)</span>
      <?php endif; ?>
    </a>
    <?php endforeach; ?>
  </div>
</nav>

<div class="container">
  <?php if ($cat): ?>
  <div style="padding:24px 0 0;font-size:.9rem;color:#666;">
    <a href="/resources/">Resource Library</a> › <?= e($cat['icon']) ?> <?= e($cat['name']) ?>
  </div>
  <?php endif; ?>
  <?php if ($search): ?>
  <p style="padding-top:16px;color:#666;">Hasil pencarian untuk: <strong>"<?= e($search) ?>"</strong> — <?= $total ?> dokumen ditemukan</p>
  <?php endif; ?>

  <?php if (empty($resources)): ?>
  <div class="empty-state">
    <span class="icon">📭</span>
    <h3>Belum ada dokumen</h3>
    <p>Coba kata kunci lain atau pilih kategori berbeda.</p>
    <a href="/resources/" class="btn-download" style="display:inline-block;margin-top:16px;">Lihat Semua Resource</a>
  </div>
  <?php else: ?>
  <div class="resource-grid">
    <?php foreach ($resources as $r): ?>
    <div class="resource-card">
      <div class="resource-card-top">
        <span class="icon"><?= match(strtolower($r['file_type'] ?? '')) { 'pdf' => '📕', 'xlsx','xls' => '📊', 'docx','doc' => '📝', 'pptx','ppt' => '📋', 'zip' => '🗜️', default => '📄' } ?></span>
        <span class="file-type"><?= e(strtoupper($r['file_type'] ?? 'DOC')) ?></span>
      </div>
      <div class="resource-card-body">
        <h3><?= e($r['title']) ?></h3>
        <?php if ($r['description']): ?>
        <p><?= e(mb_substr(strip_tags($r['description']), 0, 90)) ?>...</p>
        <?php endif; ?>
        <div class="resource-card-meta">
          <span>⬇ <?= number_format($r['download_count']) ?></span>
          <span>👁 <?= number_format($r['view_count']) ?></span>
          <?php if ($r['file_size_kb']): ?>
          <span>📦 <?= $r['file_size_kb'] > 1024 ? round($r['file_size_kb']/1024,1).'MB' : $r['file_size_kb'].'KB' ?></span>
          <?php endif; ?>
        </div>
        <?php if (!$r['is_premium']): ?>
        <a href="/resources/<?= e($r['slug']) ?>/" class="btn-download">
          ⬇ Download Gratis<span class="badge-free">FREE</span>
        </a>
        <?php else: ?>
        <a href="/resources/<?= e($r['slug']) ?>/" class="btn-download" style="background:var(--green);">
          🔓 Lihat Detail
        </a>
        <?php endif; ?>
      </div>
    </div>
    <?php endforeach; ?>
  </div>

  <?php if ($totalPages > 1): ?>
  <div class="pagination">
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
    <a href="?<?= http_build_query(array_merge($_GET, ['p' => $i])) ?>"
       class="page-btn <?= $i === $page ? 'active' : '' ?>"><?= $i ?></a>
    <?php endfor; ?>
  </div>
  <?php endif; ?>
  <?php endif; ?>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
<script src="<?= SITE_URL ?>/assets/js/main.js"></script>
</body></html>
