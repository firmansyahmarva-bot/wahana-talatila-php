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
<?php require __DIR__ . '/../includes/css.php'; ?>
<script type="application/ld+json"><?= $schema ?></script>
<link rel="stylesheet" href="<?= asset_v('/assets/css/page/glosarium-detail.css') ?>">
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
        <p style="color:var(--slate-600);font-size:.9rem;line-height:1.7"><?= nl2br(e($term['example'])) ?></p>
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

        <div style="margin-top:28px;padding-top:20px;border-top:1px solid var(--slate-100);display:flex;gap:12px;flex-wrap:wrap">
          <a href="/jadwal/" style="display:inline-block;background:var(--orange);color:var(--surface);padding:10px 20px;border-radius:8px;text-decoration:none;font-weight:600;font-size:.9rem">📅 Ikuti Pelatihan K3</a>
          <a href="/resources/" style="display:inline-block;background:var(--green);color:var(--surface);padding:10px 20px;border-radius:8px;text-decoration:none;font-weight:600;font-size:.9rem">📄 Download Template</a>
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
