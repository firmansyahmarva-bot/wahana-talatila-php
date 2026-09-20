<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/glossary-functions.php';

$slug = get_url_slug() ?: ($_GET['slug'] ?? '');
if (!$slug) redirect(SITE_URL . '/glosarium/');
$term = get_glossary_by_slug($slug);
if (!$term) { http_response_code(404); include __DIR__.'/../404.php'; exit; }

$s     = get_all_settings();
$other = get_glossary_terms(['limit'=>8]);
$other = array_filter($other, fn($t) => $t['id'] !== $term['id']);

$metaTitle = 'Arti & Pengertian ' . $term['term'] . ' dalam K3 | Wahana Totalita';
$metaDesc  = mb_substr($term['definition'], 0, 160);

$schema = json_encode([
  "@context"=>"https://schema.org",
  "@type"=>"DefinedTerm",
  "name"=>$term['term'],
  "description"=>$metaDesc,
  "url"=>SITE_URL."/glosarium/".urlencode($term['slug'])."/",
  "inDefinedTermSet"=>["@type"=>"DefinedTermSet","name"=>"Glosarium K3 Indonesia","url"=>SITE_URL."/glosarium/"]
]);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($metaTitle) ?></title>
<meta name="description" content="<?= e($metaDesc) ?>">
<link rel="canonical" href="<?= SITE_URL ?>/glosarium/<?= e($term['slug']) ?>/">
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
<script type="application/ld+json"><?= $schema ?></script>
<?= theme_css_vars($s) ?>
<style>
.glos-detail{padding:48px 0;max-width:820px;margin:0 auto;padding-left:20px;padding-right:20px}
.term-main{background:#fff;border-radius:16px;border:1px solid #eee;overflow:hidden;box-shadow:0 4px 16px rgba(0,0,0,.07)}
.term-hero{background:linear-gradient(135deg,var(--green),#1a5c3a);padding:32px;color:#fff}
.term-hero .abbr{font-family:monospace;background:rgba(255,255,255,.15);padding:4px 12px;border-radius:100px;font-size:.9rem;display:inline-block;margin-bottom:10px}
.term-hero h1{font-size:clamp(1.5rem,3vw,2rem);font-weight:800;margin:0 0 8px}
.term-hero .cat{font-size:.8rem;opacity:.7}
.term-body{padding:32px}
.def-block{font-size:1.05rem;line-height:1.85;color:#333;margin:0 0 24px;padding:20px;background:#f9fafb;border-left:4px solid var(--green);border-radius:0 8px 8px 0}
.section-title{font-size:1rem;font-weight:700;color:var(--green);margin:24px 0 12px}
.related-terms{display:flex;gap:8px;flex-wrap:wrap;margin-top:8px}
.related-term{display:inline-block;background:#f0f9f0;color:var(--green);padding:4px 12px;border-radius:100px;font-size:.8rem;font-weight:600;text-decoration:none}
.related-term:hover{background:var(--green);color:#fff}
.breadcrumb{font-size:.85rem;color:#999;margin-bottom:20px}
.breadcrumb a{color:var(--green);text-decoration:none}
.other-terms{margin-top:32px;background:#fff;border-radius:12px;border:1px solid #eee;padding:24px}
.other-terms h3{margin:0 0 16px;font-size:1rem;font-weight:700;color:var(--green)}
.other-list{display:grid;grid-template-columns:1fr 1fr;gap:8px}
.other-item{display:flex;gap:8px;align-items:center;padding:8px;border-radius:6px;text-decoration:none;color:#333;font-size:.875rem}
.other-item:hover{background:#f0f9f0;color:var(--green)}
</style>
</head>
<body>
<?php include __DIR__ . '/../includes/navbar.php'; ?>

<div class="container">
  <div class="glos-detail">
    <div class="breadcrumb">
      <a href="/glosarium/">Glosarium K3</a> › <?= e($term['term']) ?>
    </div>

    <div class="term-main">
      <div class="term-hero">
        <?php if ($term['abbreviation']): ?><div class="abbr"><?= e($term['abbreviation']) ?></div><?php endif; ?>
        <h1><?= e($term['term']) ?></h1>
        <?php if ($term['category']): ?><div class="cat">📁 <?= e($term['category']) ?></div><?php endif; ?>
      </div>
      <div class="term-body">
        <h2 class="section-title">📖 Definisi</h2>
        <div class="def-block"><?= nl2br(e($term['definition'])) ?></div>

        <?php if ($term['example']): ?>
        <h2 class="section-title">💡 Contoh Penggunaan</h2>
        <p style="color:#555;font-size:.9rem;line-height:1.7"><?= nl2br(e($term['example'])) ?></p>
        <?php endif; ?>

        <?php if ($term['related_terms']): ?>
        <h2 class="section-title">🔗 Istilah Terkait</h2>
        <div class="related-terms">
          <?php foreach (explode(',', $term['related_terms']) as $rt): ?>
          <?php $rt = trim($rt); if (!$rt) continue; ?>
          <a href="/glosarium/?q=<?= urlencode($rt) ?>" class="related-term"><?= e($rt) ?></a>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <div style="margin-top:28px;padding-top:20px;border-top:1px solid #f0f0f0;display:flex;gap:12px;flex-wrap:wrap">
          <a href="/jadwal/" style="display:inline-block;background:var(--orange);color:#fff;padding:10px 20px;border-radius:8px;text-decoration:none;font-weight:600;font-size:.9rem">📅 Ikuti Pelatihan K3</a>
          <a href="/resources/" style="display:inline-block;background:var(--green);color:#fff;padding:10px 20px;border-radius:8px;text-decoration:none;font-weight:600;font-size:.9rem">📄 Download Template</a>
          <a href="/glosarium/" style="display:inline-block;border:1px solid var(--green);color:var(--green);padding:10px 20px;border-radius:8px;text-decoration:none;font-weight:600;font-size:.9rem">← Kembali ke Glosarium</a>
        </div>
      </div>
    </div>

    <?php if (!empty($other)): ?>
    <div class="other-terms">
      <h3>📚 Istilah K3 Lainnya</h3>
      <div class="other-list">
        <?php foreach ($other as $o): ?>
        <a href="/glosarium/<?= e($o['slug']) ?>/" class="other-item">
          <span>📖</span><span><?= e($o['term']) ?></span>
        </a>
        <?php endforeach; ?>
      </div>
      <a href="/glosarium/" style="display:block;text-align:center;margin-top:16px;color:var(--green);font-weight:600;font-size:.875rem;text-decoration:none">Lihat semua istilah →</a>
    </div>
    <?php endif; ?>

    <!-- T17a: fails silent today (no glossary-category map yet); wired so
         it activates automatically once that map is added — see T15 notes. -->
    <?php
      require_once __DIR__ . '/../includes/related-cta.php';
      echo related_cta('glossary', $term['category'] ?? '');
    ?>
  </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
<script src="<?= SITE_URL ?>/assets/js/main.js"></script>
</body></html>
