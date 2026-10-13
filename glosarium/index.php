<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/glossary-functions.php';

$s      = get_all_settings();
$letter = strtoupper(sanitize($_GET['l'] ?? ''));
$search = sanitize($_GET['q'] ?? '');
$opts   = $letter ? ['letter'=>$letter] : [];
if ($search) $opts['search'] = $search;
$terms   = get_glossary_terms($opts);
$letters = get_glossary_alphabet();

$metaTitle = 'Glosarium K3 Indonesia — Kamus Istilah HSE & Keselamatan Kerja | Wahana Totalita';
$metaDesc  = '500+ istilah dan definisi K3, HSE, AMDAL, dan keselamatan kerja Indonesia. Referensi lengkap untuk HSE profesional dan pekerja.';

$schema = json_encode([
  "@context"=>"https://schema.org",
  "@type"=>"DefinedTermSet",
  "name"=>"Glosarium K3 Indonesia",
  "description"=>$metaDesc,
  "url"=>SITE_URL."/glosarium/"
]);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($metaTitle) ?></title>
<meta name="description" content="<?= e($metaDesc) ?>">
<link rel="canonical" href="<?= SITE_URL ?>/glosarium/">
<?php require __DIR__ . '/../includes/css.php'; ?>
<script type="application/ld+json"><?= $schema ?></script>
<link rel="stylesheet" href="<?= asset_v('/assets/css/page/glosarium.css') ?>">
</head>
<body>
<?php include __DIR__ . '/../includes/navbar.php'; ?>

<section class="glos-hero">
  <div class="container">
    <h1>📖 Glosarium K3 Indonesia</h1>
    <p style="opacity:.85;max-width:560px;margin:0 auto">Kamus lengkap istilah K3, HSE, AMDAL, dan keselamatan kerja. Referensi gratis untuk semua profesional K3.</p>
    <form class="search-box" action="" method="GET">
      <input type="search" name="q" placeholder="Cari istilah K3 (JSA, HIRARC, APD...)" value="<?= e($search) ?>">
      <button type="submit">🔍</button>
    </form>
  </div>
</section>

<nav class="alpha-nav">
  <a href="/glosarium/" class="alpha-btn <?= !$letter && !$search ? 'active' : '' ?>">Semua</a>
  <?php foreach (range('A','Z') as $l):
    $hasTerms = in_array($l, $letters);
  ?>
  <a href="/glosarium/?l=<?= $l ?>" class="alpha-btn <?= $letter===$l?'active':'' ?> <?= $hasTerms?'has-terms':'' ?>"><?= $l ?></a>
  <?php endforeach; ?>
</nav>

<div class="glos-content">
  <?php if ($search): ?>
  <p style="color:var(--slate-600);margin-bottom:24px">Hasil pencarian: "<strong><?= e($search) ?></strong>" — <?= count($terms) ?> istilah ditemukan</p>
  <?php endif; ?>

  <?php if (empty($terms)): ?>
  <div style="text-align:center;padding:40px;color:var(--text-light)">
    <div style="font-size:3rem;margin-bottom:12px">📭</div>
    <p>Belum ada istilah untuk huruf atau kata kunci tersebut.</p>
    <a href="/glosarium/" style="color:var(--green);font-weight:600">Lihat semua istilah →</a>
  </div>
  <?php else: ?>

  <?php
  $currentLetter = '';
  foreach ($terms as $t):
    $firstLetter = strtoupper(mb_substr($t['term'],0,1));
    if (!$search && !$letter && $firstLetter !== $currentLetter):
      $currentLetter = $firstLetter;
  ?>
  <div class="letter-heading"><?= $currentLetter ?></div>
  <?php endif; ?>

  <div class="term-card">
    <?php if ($t['abbreviation']): ?>
    <div class="term-abbr"><?= e($t['abbreviation']) ?></div>
    <?php endif; ?>
    <h2><a href="/glosarium/<?= e($t['slug']) ?>/"><?= e($t['term']) ?></a></h2>
    <p class="term-def"><?= e(mb_substr($t['definition'],0,200)) ?><?= strlen($t['definition'])>200?'...':'' ?></p>
    <?php if ($t['category']): ?><span class="term-cat"><?= e($t['category']) ?></span><?php endif; ?>
  </div>
  <?php endforeach; ?>
  <?php endif; ?>

  <div style="margin-top:40px;background:var(--success-bg);border-radius:12px;padding:24px;text-align:center">
    <h3 style="margin:0 0 8px;color:var(--green)">Pelajari K3 Lebih Dalam</h3>
    <p style="color:var(--slate-600);font-size:.9rem;margin:0 0 16px">Ikuti pelatihan K3 bersertifikat BNSP dan Kemnaker RI</p>
    <a href="/jadwal/" style="display:inline-block;background:var(--orange);color:var(--surface);padding:12px 24px;border-radius:8px;text-decoration:none;font-weight:700">📅 Lihat Jadwal Pelatihan</a>
  </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
<script src="<?= SITE_URL ?>/assets/js/main.js"></script>
</body></html>
