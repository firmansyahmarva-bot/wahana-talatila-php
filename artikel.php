<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/artikel-functions.php';

$s       = get_all_settings();
$categories = get_categories(); // needed by footer.php — do not overwrite below
$search  = trim($_GET['q'] ?? '');
$cat     = trim($_GET['cat'] ?? '');
$page    = max(1, (int)($_GET['page'] ?? 1));
$per     = 12;
$offset  = ($page - 1) * $per;

$articles           = get_articles($per, $offset, $cat, $search);
$total              = count_articles($cat, $search);
$total_pages        = (int)ceil($total / $per);
$article_categories = get_article_categories(); // renamed: was overwriting $categories, which footer.php also relies on

$page_title = 'Artikel & Panduan K3 | ' . ($s['site_name'] ?? 'Wahana Totalita Konsultan');
$meta_desc  = 'Artikel, panduan, dan tips seputar K3, sertifikasi BNSP, lingkungan kerja, dan keselamatan industri dari Wahana Totalita Konsultan.';

// Canonical now reflects category/page state instead of always pointing at the bare listing
$canon_url = SITE_URL . '/artikel/';
if ($cat) {
    $canon_url .= '?cat=' . urlencode($cat);
    if ($page > 1) $canon_url .= '&page=' . $page;
} elseif ($page > 1) {
    $canon_url .= '?page=' . $page;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($page_title) ?></title>
<meta name="description" content="<?= e($meta_desc) ?>">
<link rel="canonical" href="<?= e($canon_url) ?>">
<?php if ($search): ?>
<meta name="robots" content="noindex,follow">
<?php endif; ?>
<meta property="og:type"        content="website">
<meta property="og:title"       content="<?= e($page_title) ?>">
<meta property="og:description" content="<?= e($meta_desc) ?>">
<meta property="og:url"         content="<?= e($canon_url) ?>">
<meta property="og:image"       content="<?= SITE_URL . e($s['og_image'] ?? '/assets/img/og-cover.jpg') ?>">
<meta name="twitter:card"       content="summary_large_image">
<meta name="theme-color"        content="<?= e($s['brand_color'] ?? '#0A4A2E') ?>">
<script type="application/ld+json"><?= json_encode([
  '@context'      => 'https://schema.org',
  '@type'         => 'Blog',
  'name'          => 'Artikel Wahana Totalita Konsultan',
  'url'           => $canon_url,
  'description'   => $meta_desc,
  'publisher'     => ['@type'=>'Organization','name'=>$s['site_name']??'Wahana Totalita Konsultan','url'=>SITE_URL],
  'inLanguage'    => 'id',
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?></script>
<?php if (!empty($s['gtm_id'])): ?>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','<?= e($s['gtm_id']) ?>');</script>
<?php endif; ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Lora:wght@400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= asset_v('/assets/css/style.css') ?>">
<link rel="stylesheet" href="<?= asset_v('/assets/css/artikel.css') ?>">
<?= theme_css_vars($s) ?>
</head>
<body>
<?php if (!empty($s['gtm_id'])): ?>
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?= e($s['gtm_id']) ?>" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<?php endif; ?>

<?php require __DIR__ . '/includes/navbar.php'; ?>

<!-- ARTIKEL HERO -->
<section class="ak-hero">
  <div class="container">
    <nav class="ak-breadcrumb" aria-label="Breadcrumb">
      <ol><li><a href="/">Beranda</a></li><li aria-current="page">Artikel</li></ol>
    </nav>
    <h1>Artikel & Panduan <em>K3 &amp; Lingkungan</em></h1>
    <p>Tips praktis, panduan sertifikasi, dan update regulasi K3 terbaru untuk profesional industri Indonesia.</p>
    <!-- Search -->
    <form class="ak-search-form" method="get" action="/artikel/">
      <?php if ($cat): ?>
      <input type="hidden" name="cat" value="<?= e($cat) ?>">
      <?php endif; ?>
      <input type="text" name="q" placeholder="Cari artikel..." value="<?= e($search) ?>" autocomplete="off">
      <button type="submit">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      </button>
    </form>
  </div>
</section>

<div class="ak-layout container">

  <!-- FILTER SIDEBAR -->
  <aside class="ak-sidebar">
    <div class="ak-sidebar-card">
      <h3>Kategori</h3>
      <a href="/artikel/" class="ak-cat-link <?= !$cat ? 'active' : '' ?>">
        Semua <span><?= count_articles() ?></span>
      </a>
      <?php foreach ($article_categories as $c): ?>
      <a href="/artikel/?cat=<?= urlencode($c['category']) ?>" class="ak-cat-link <?= $cat === $c['category'] ? 'active' : '' ?>" style="--cat-color:<?= e(artikel_cat_color($c['category'])) ?>">
        <?= e($c['category']) ?> <span><?= $c['cnt'] ?></span>
      </a>
      <?php endforeach; ?>
    </div>

    <!-- CTA Card -->
    <div class="ak-sidebar-cta">
      <div class="ak-cta-icon">🎓</div>
      <h4>Butuh Sertifikasi K3?</h4>
      <p>Konsultasi gratis dengan tim kami via WhatsApp.</p>
      <a href="<?= wa_url('Halo, saya ingin konsultasi tentang pelatihan K3') ?>" class="ak-cta-btn" target="_blank" rel="noopener">
        💬 Chat WhatsApp
      </a>
    </div>
  </aside>

  <!-- ARTICLE GRID -->
  <main class="ak-main" id="konten-utama">

    <?php if ($search || $cat): ?>
    <div class="ak-filter-info">
      <?php if ($search): ?>
        <span>Hasil pencarian: <strong>"<?= e($search) ?>"</strong></span>
      <?php elseif ($cat): ?>
        <span>Kategori: <strong><?= e($cat) ?></strong></span>
      <?php endif; ?>
      <span class="ak-result-count"><?= $total ?> artikel</span>
      <a href="/artikel/" class="ak-clear-filter">× Hapus filter</a>
    </div>
    <?php endif; ?>

    <?php if (empty($articles)): ?>
    <div class="ak-empty">
      <div class="ak-empty-icon">📝</div>
      <h3>Tidak ada artikel ditemukan</h3>
      <p>Coba kata kunci lain atau <a href="/artikel/">lihat semua artikel</a>.</p>
    </div>
    <?php else: ?>

    <div class="ak-grid">
      <?php foreach ($articles as $i => $a): ?>
      <article class="ak-card <?= $i === 0 && !$offset ? 'ak-card-featured' : '' ?>">
        <a href="/artikel/<?= e($a['slug']) ?>/" class="ak-card-img-wrap">
          <img src="<?= e(artikel_thumb($a['thumbnail'] ?? '', $a['category'], $a['slug'] ?? '')) ?>"
               alt="<?= e($a['title']) ?>"
               loading="<?= $i < 3 ? 'eager' : 'lazy' ?>"
               width="600" height="340">
          <span class="ak-card-cat" style="background:<?= e(artikel_cat_color($a['category'])) ?>">
            <?= e($a['category']) ?>
          </span>
        </a>
        <div class="ak-card-body">
          <div class="ak-card-meta">
            <time datetime="<?= e($a['published_at'] ?? '') ?>"><?= format_article_date($a['published_at'] ?? $a['created_at']) ?></time>
            <span>•</span>
            <span><?= (int)($a['read_min'] ?: 3) ?> menit baca</span>
          </div>
          <h2 class="ak-card-title">
            <a href="/artikel/<?= e($a['slug']) ?>/"><?= e($a['title']) ?></a>
          </h2>
          <?php if (!empty($a['meta_desc'])): ?>
          <p class="ak-card-desc"><?= e($a['meta_desc']) ?></p>
          <?php endif; ?>
          <a href="/artikel/<?= e($a['slug']) ?>/" class="ak-read-more">
            Baca selengkapnya <span>→</span>
          </a>
        </div>
      </article>
      <?php endforeach; ?>
    </div>

    <!-- Pagination -->
    <?php if ($total_pages > 1): ?>
    <nav class="ak-pagination" aria-label="Halaman artikel">
      <?php if ($page > 1): ?>
      <a href="?<?= http_build_query(array_merge($_GET, ['page' => $page - 1])) ?>" class="ak-page-btn" aria-label="Sebelumnya">←</a>
      <?php endif; ?>
      <?php
        // Sliding window centered on the current page instead of always showing 1–7
        $window     = 3;
        $range_start = max(1, $page - $window);
        $range_end   = min($total_pages, $page + $window);
      ?>
      <?php if ($range_start > 1): ?>
      <a href="?<?= http_build_query(array_merge($_GET, ['page' => 1])) ?>" class="ak-page-btn">1</a>
      <?php if ($range_start > 2): ?><span class="ak-page-ellipsis">…</span><?php endif; ?>
      <?php endif; ?>
      <?php for ($p = $range_start; $p <= $range_end; $p++): ?>
      <a href="?<?= http_build_query(array_merge($_GET, ['page' => $p])) ?>"
         class="ak-page-btn <?= $p === $page ? 'active' : '' ?>"><?= $p ?></a>
      <?php endfor; ?>
      <?php if ($range_end < $total_pages): ?>
      <?php if ($range_end < $total_pages - 1): ?><span class="ak-page-ellipsis">…</span><?php endif; ?>
      <a href="?<?= http_build_query(array_merge($_GET, ['page' => $total_pages])) ?>" class="ak-page-btn"><?= $total_pages ?></a>
      <?php endif; ?>
      <?php if ($page < $total_pages): ?>
      <a href="?<?= http_build_query(array_merge($_GET, ['page' => $page + 1])) ?>" class="ak-page-btn" aria-label="Berikutnya">→</a>
      <?php endif; ?>
    </nav>
    <?php endif; ?>

    <?php endif; ?>
  </main>
</div>

<?php require __DIR__ . '/includes/footer.php'; ?>
<?php require __DIR__ . '/includes/scripts.php'; ?>
</body>
</html>