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
<?php require __DIR__ . '/../includes/css.php'; ?>
<link rel="stylesheet" href="<?= asset_v('/assets/css/page/resources.css') ?>">
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
  <div style="padding:24px 0 0;font-size:.9rem;color:var(--slate-600);">
    <a href="/resources/">Resource Library</a> › <?= e($cat['icon']) ?> <?= e($cat['name']) ?>
  </div>
  <?php endif; ?>
  <?php if ($search): ?>
  <p style="padding-top:16px;color:var(--slate-600);">Hasil pencarian untuk: <strong>"<?= e($search) ?>"</strong> — <?= $total ?> dokumen ditemukan</p>
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
