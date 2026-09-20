<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/artikel-functions.php';

$slug = get_url_slug();
if (!$slug) redirect(SITE_URL . '/artikel/');

// Check if this is a legacy static article in /artikel/ folder
$static_path = __DIR__ . '/artikel/' . $slug . '/index.html';
if (file_exists($static_path)) {
    readfile($static_path);
    exit;
}

// Try database article
$article = get_article_by_slug($slug);
if (!$article) {
    http_response_code(404);
    require __DIR__ . '/404.php';
    exit;
}

artikel_view_increment($article['id']);

$s        = get_all_settings();
$categories = get_categories(); // needed by footer.php
$faqs     = !empty($article['faq_data']) ? json_decode($article['faq_data'], true) : [];
$related  = get_related_articles($article['id'], $article['category'], 3);
$read_min = reading_time($article['content']);
$canon    = SITE_URL . '/artikel/' . $article['slug'] . '/';

$t = $article['title'];
$meta_title = $article['meta_title'] ?: (mb_strlen($t) > 55 ? mb_substr($t, 0, mb_strrpos(mb_substr($t, 0, 55), ' ')) . '...' : $t) . ' | ' . ($s['site_name'] ?? 'Wahana Totalita');
$meta_desc  = $article['meta_desc']  ?: mb_substr(strip_tags($article['content']), 0, 155) . '...';
$pub_date   = $article['published_at'] ? date('Y-m-d', strtotime($article['published_at'])) : date('Y-m-d', strtotime($article['created_at']));
$mod_date   = date('Y-m-d', strtotime($article['updated_at']));

// Build FAQ schema
$faq_schema = null;
if (!empty($faqs)) {
    $faq_schema = [
        '@context'   => 'https://schema.org',
        '@type'      => 'FAQPage',
        'mainEntity' => array_map(fn($f) => [
            '@type'          => 'Question',
            'name'           => $f['q'] ?? '',
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a'] ?? ''],
        ], $faqs),
    ];
}

// Article schema
$article_schema = [
    '@context'         => 'https://schema.org',
    '@type'            => 'Article',
    'headline'         => $article['title'],
    'description'      => $meta_desc,
    'author'           => ['@type' => 'Organization', 'name' => $article['author']],
    'publisher'        => ['@type' => 'Organization', 'name' => $s['site_name'] ?? 'Wahana Totalita Konsultan', 'url' => SITE_URL],
    'datePublished'    => $pub_date,
    'dateModified'     => $mod_date,
    'mainEntityOfPage' => $canon,
    'articleSection'   => $article['category'],
    'inLanguage'       => 'id',
];
if (!empty($article['thumbnail'])) $article_schema['image'] = artikel_thumb($article['thumbnail'], $article['category'], $article['slug'] ?? '');
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($meta_title) ?></title>
<meta name="description" content="<?= e($meta_desc) ?>">
<link rel="canonical" href="<?= e($canon) ?>">
<?php if (!empty($article['keywords'])): ?>
<meta name="keywords" content="<?= e($article['keywords']) ?>">
<?php endif; ?>
<meta property="og:type"        content="article">
<meta property="og:title"       content="<?= e($article['title']) ?>">
<meta property="og:description" content="<?= e($meta_desc) ?>">
<meta property="og:url"         content="<?= e($canon) ?>">
<meta property="og:image"       content="<?= e(artikel_thumb($article['thumbnail'] ?? '', $article['category'], $article['slug'] ?? '')) ?>">
<meta property="og:image:width"  content="1200">
<meta property="og:image:height" content="630">
<meta property="og:site_name"   content="<?= e($s['site_name'] ?? '') ?>">
<meta property="article:published_time" content="<?= e($pub_date) ?>">
<meta property="article:modified_time"  content="<?= e($mod_date) ?>">
<meta property="article:section" content="<?= e($article['category']) ?>">
<meta name="twitter:card"        content="summary_large_image">
<meta name="twitter:title"       content="<?= e($article['title']) ?>">
<meta name="twitter:description" content="<?= e($meta_desc) ?>">
<meta name="theme-color"         content="#0A4A2E">
<script type="application/ld+json"><?= json_encode($article_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?></script>
<?php if ($faq_schema): ?>
<script type="application/ld+json"><?= json_encode($faq_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?></script>
<?php endif; ?>
<!-- BreadcrumbList -->
<script type="application/ld+json"><?= json_encode([
  '@context' => 'https://schema.org',
  '@type'    => 'BreadcrumbList',
  'itemListElement' => [
    ['@type'=>'ListItem','position'=>1,'name'=>'Beranda','item'=>SITE_URL.'/'],
    ['@type'=>'ListItem','position'=>2,'name'=>'Artikel','item'=>SITE_URL.'/artikel/'],
    ['@type'=>'ListItem','position'=>3,'name'=>$article['title'],'item'=>$canon],
  ]
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?></script>
<?php if (!empty($s['gtm_id'])): ?>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','<?= e($s['gtm_id']) ?>');</script>
<?php endif; ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Lora:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= asset_v('/assets/css/style.css') ?>">
<link rel="stylesheet" href="<?= asset_v('/assets/css/artikel.css') ?>">
<?= theme_css_vars($s) ?>
</head>
<body class="artikel-single-page">
<?php if (!empty($s['gtm_id'])): ?>
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?= e($s['gtm_id']) ?>" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<?php endif; ?>

<!-- Reading progress bar -->
<div class="ak-progress-bar" id="akProgress" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-label="Progress membaca"></div>

<?php require __DIR__ . '/includes/navbar.php'; ?>

<main id="konten-utama">

  <!-- ARTICLE HEADER -->
  <header class="ak-article-header">
    <div class="container ak-article-header-inner">
      <nav class="ak-breadcrumb" aria-label="Breadcrumb">
        <ol>
          <li><a href="/">Beranda</a></li>
          <li><a href="/artikel/">Artikel</a></li>
          <li><a href="/artikel/?cat=<?= urlencode($article['category']) ?>"><?= e($article['category']) ?></a></li>
          <li aria-current="page"><?= e(mb_substr($article['title'], 0, 40)) ?>...</li>
        </ol>
      </nav>
      <span class="ak-article-cat-badge" style="background:<?= e(artikel_cat_color($article['category'])) ?>">
        <?= e($article['category']) ?>
      </span>
      <h1><?= e($article['title']) ?></h1>
      <div class="ak-article-meta-bar">
        <span class="ak-meta-author">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
          <?= e($article['author']) ?>
        </span>
        <span>•</span>
        <time datetime="<?= e($pub_date) ?>">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
          <?= format_article_date($article['published_at'] ?? $article['created_at']) ?>
        </time>
        <span>•</span>
        <span>
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
          <?= $read_min ?> baca
        </span>
        <span>•</span>
        <span><?= number_format($article['view_count'] + 1) ?> dibaca</span>
      </div>
    </div>
  </header>

  <!-- ARTICLE FEATURED IMAGE -->
  <div class="ak-article-hero-img">
    <div class="container">
      <img src="<?= e(artikel_thumb($article['thumbnail'] ?? '', $article['category'], $article['slug'] ?? '')) ?>"
           alt="<?= e($article['title']) ?>"
           loading="eager" fetchpriority="high" width="1200" height="630">
    </div>
  </div>

  <!-- ARTICLE BODY + SIDEBAR -->
  <div class="container ak-article-layout">

    <!-- STICKY TABLE OF CONTENTS (desktop) -->
    <aside class="ak-toc-sidebar" id="akToc" aria-label="Daftar isi">
      <div class="ak-toc-inner">
        <div class="ak-toc-title">📋 Daftar Isi</div>
        <nav id="akTocNav"><!-- Generated by JS --></nav>
        <!-- Sidebar WA CTA -->
        <div class="ak-toc-cta">
          <strong>Butuh Pelatihan K3?</strong>
          <a href="<?= wa_url('Halo, saya baca artikel di wahanatotalita.com dan ingin tanya tentang pelatihan K3') ?>" target="_blank" rel="noopener" class="ak-toc-wa">
            💬 Tanya via WhatsApp
          </a>
        </div>
      </div>
    </aside>

    <!-- ARTICLE CONTENT -->
    <article class="ak-content" id="akContent">
      <div class="ak-article-body prose">
        <?= $article['content'] ?>
      </div>

      <!-- MID-ARTICLE CTA -->
      <div class="ak-inline-cta">
        <div class="ak-inline-cta-icon">🎓</div>
        <div>
          <strong>Siap Mulai Sertifikasi K3?</strong>
          <p>Wahana Totalita Konsultan menyediakan 40+ program pelatihan K3 bersertifikasi BNSP & Kemnaker RI.</p>
        </div>
        <a href="<?= wa_url('Halo, saya ingin daftar pelatihan K3 di Wahana Totalita') ?>" class="ak-inline-cta-btn" target="_blank" rel="noopener">
          Daftar Sekarang →
        </a>
      </div>

      <!-- FAQ SECTION -->
      <?php if (!empty($faqs)): ?>
      <section class="ak-faq" id="faq" aria-labelledby="faq-heading">
        <h2 id="faq-heading">❓ Pertanyaan Umum</h2>
        <div class="ak-faq-list">
          <?php foreach ($faqs as $i => $faq): ?>
          <?php if (empty($faq['q'])) continue; ?>
          <div class="ak-faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
            <button class="ak-faq-q" onclick="toggleFaq(this)" aria-expanded="false" aria-controls="faq-answer-<?= $i ?>">
              <span itemprop="name"><?= e($faq['q']) ?></span>
              <svg class="ak-faq-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
            </button>
            <div class="ak-faq-a" id="faq-answer-<?= $i ?>" hidden itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
              <div itemprop="text"><?= nl2br(e($faq['a'] ?? '')) ?></div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </section>
      <?php endif; ?>

      <!-- RELATED PROGRAM RECOMMENDATIONS -->
      <?php
        require_once __DIR__ . '/includes/related-cta.php';
        echo related_cta('article', $article['category'] ?? '');
      ?>

      <!-- SHARE + TAGS -->
      <div class="ak-article-footer">
        <div class="ak-share">
          <span>Bagikan:</span>
          <a href="https://wa.me/?text=<?= rawurlencode($article['title'] . ' — ' . $canon) ?>" target="_blank" rel="noopener" class="ak-share-btn ak-share-wa" aria-label="Bagikan via WhatsApp">WhatsApp</a>
          <a href="https://www.facebook.com/sharer/sharer.php?u=<?= rawurlencode($canon) ?>" target="_blank" rel="noopener" class="ak-share-btn ak-share-fb" aria-label="Bagikan di Facebook">Facebook</a>
          <button onclick="navigator.clipboard.writeText('<?= e($canon) ?>').then(()=>this.textContent='✓ Disalin')" class="ak-share-btn ak-share-copy">Salin Link</button>
        </div>
        <div class="ak-tag">
          <a href="/artikel/?cat=<?= urlencode($article['category']) ?>" class="ak-tag-link"><?= e($article['category']) ?></a>
        </div>
      </div>

    </article>
  </div>

  <!-- RELATED ARTICLES -->
  <?php if (!empty($related)): ?>
  <section class="ak-related" aria-labelledby="related-heading">
    <div class="container">
      <h2 id="related-heading">Artikel Terkait</h2>
      <div class="ak-related-grid">
        <?php foreach ($related as $r): ?>
        <article class="ak-card">
          <a href="/artikel/<?= e($r['slug']) ?>/" class="ak-card-img-wrap">
            <img src="<?= e(artikel_thumb($r['thumbnail'] ?? '', $r['category'], $r['slug'] ?? '')) ?>"
                 alt="<?= e($r['title']) ?>"
                 loading="lazy" width="400" height="225">
            <span class="ak-card-cat" style="background:<?= e(artikel_cat_color($r['category'])) ?>"><?= e($r['category']) ?></span>
          </a>
          <div class="ak-card-body">
            <div class="ak-card-meta">
              <time datetime="<?= e(substr($r['published_at'] ?? $r['created_at'], 0, 10)) ?>"><?= format_article_date($r['published_at'] ?? $r['created_at']) ?></time>
            </div>
            <h3 class="ak-card-title"><a href="/artikel/<?= e($r['slug']) ?>/"><?= e($r['title']) ?></a></h3>
            <?php if (!empty($r['meta_desc'])): ?>
            <p class="ak-card-desc"><?= e(mb_substr($r['meta_desc'], 0, 100)) ?>...</p>
            <?php endif; ?>
          </div>
        </article>
        <?php endforeach; ?>
      </div>
      <div style="text-align:center;margin-top:2rem">
        <a href="/artikel/" class="btn-outline" style="display:inline-block;padding:12px 32px;border:2px solid var(--green);color:var(--green);border-radius:8px;font-weight:600;text-decoration:none">← Lihat Semua Artikel</a>
      </div>
    </div>
  </section>
  <?php endif; ?>

</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
<?php require __DIR__ . '/includes/scripts.php'; ?>

<script>
// Reading progress bar
(function(){
  var bar = document.getElementById('akProgress');
  if(!bar) return;
  function upd(){
    var d = document.documentElement, b = document.body;
    var st = d.scrollTop || b.scrollTop;
    var h = (d.scrollHeight || b.scrollHeight) - d.clientHeight;
    var pct = h > 0 ? (st/h*100) : 0;
    bar.style.width = Math.min(100,pct) + '%';
    bar.setAttribute('aria-valuenow', Math.round(pct));
  }
  window.addEventListener('scroll', upd, {passive:true});
})();

// Auto-generate TOC from h2/h3 headings
(function(){
  var content = document.getElementById('akContent');
  var nav     = document.getElementById('akTocNav');
  if(!content || !nav) return;
  var headings = content.querySelectorAll('h2, h3');
  if(headings.length < 2) { document.getElementById('akToc').style.display='none'; return; }
  var html = '<ul>';
  headings.forEach(function(h, i){
    if(!h.id) h.id = 'ak-h-' + i;
    var tag = h.tagName.toLowerCase();
    html += '<li class="toc-' + tag + '"><a href="#' + h.id + '">' + h.textContent + '</a></li>';
  });
  html += '</ul>';
  nav.innerHTML = html;
  // Active link on scroll
  var links = nav.querySelectorAll('a');
  window.addEventListener('scroll', function(){
    var pos = window.scrollY + 100;
    headings.forEach(function(h, i){
      if(h.offsetTop <= pos){ links.forEach(l=>l.classList.remove('active')); if(links[i]) links[i].classList.add('active'); }
    });
  }, {passive:true});
})();

// FAQ accordion
function toggleFaq(btn){
  var answer = document.getElementById(btn.getAttribute('aria-controls'));
  var open = btn.getAttribute('aria-expanded') === 'true';
  btn.setAttribute('aria-expanded', !open);
  if(open){ answer.hidden = true; } else { answer.hidden = false; }
}
</script>
</body>
</html>
