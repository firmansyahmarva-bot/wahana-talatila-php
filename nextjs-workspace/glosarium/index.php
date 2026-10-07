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
.glos-hero{background:linear-gradient(135deg,var(--green),#1a5c3a);padding:56px 0;color:#fff;text-align:center}
.glos-hero h1{font-size:clamp(1.8rem,3.5vw,2.5rem);font-weight:800;margin:0 0 12px}
.search-box{background:#fff;border-radius:12px;padding:6px;display:flex;gap:8px;max-width:500px;margin:20px auto 0;box-shadow:0 4px 20px rgba(0,0,0,.2)}
.search-box input{flex:1;border:none;outline:none;padding:10px 16px;font-size:1rem;background:transparent;color:#222}
.search-box button{background:var(--orange);color:#fff;border:none;padding:10px 20px;border-radius:8px;cursor:pointer;font-weight:600}
.alpha-nav{display:flex;gap:4px;flex-wrap:wrap;justify-content:center;padding:20px 0;background:#f8f8f8;border-bottom:1px solid #eee}
.alpha-btn{display:inline-block;width:36px;height:36px;line-height:36px;text-align:center;border-radius:8px;text-decoration:none;font-weight:700;font-size:.9rem;color:#555;transition:.2s}
.alpha-btn:hover,.alpha-btn.active{background:var(--green);color:#fff}
.alpha-btn.has-terms{color:var(--green)}
.glos-content{padding:40px 0;max-width:800px;margin:0 auto;padding-left:20px;padding-right:20px}
.term-card{background:#fff;border-radius:8px;border:1px solid #eee;padding:20px 24px;margin-bottom:12px;transition:.2s}
.term-card:hover{border-color:var(--green);box-shadow:0 4px 12px rgba(10,74,46,.08)}
.term-card h2{margin:0 0 8px;font-size:1.05rem}
.term-card h2 a{text-decoration:none;color:var(--green)}
.term-card h2 a:hover{text-decoration:underline}
.term-abbr{font-size:.8rem;color:var(--orange);font-weight:600;font-family:monospace;margin-bottom:4px}
.term-def{font-size:.9rem;color:#555;line-height:1.6;margin:0}
.term-cat{display:inline-block;background:#f0f9f0;color:var(--green);padding:2px 8px;border-radius:100px;font-size:.72rem;font-weight:600;margin-top:8px}
.letter-heading{font-size:2rem;font-weight:800;color:var(--green);margin:32px 0 16px;border-bottom:3px solid var(--green);padding-bottom:8px;display:inline-block}
</style>
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
  <p style="color:#666;margin-bottom:24px">Hasil pencarian: "<strong><?= e($search) ?></strong>" — <?= count($terms) ?> istilah ditemukan</p>
  <?php endif; ?>

  <?php if (empty($terms)): ?>
  <div style="text-align:center;padding:40px;color:#999">
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

  <div style="margin-top:40px;background:#f0f9f0;border-radius:12px;padding:24px;text-align:center">
    <h3 style="margin:0 0 8px;color:var(--green)">Pelajari K3 Lebih Dalam</h3>
    <p style="color:#666;font-size:.9rem;margin:0 0 16px">Ikuti pelatihan K3 bersertifikat BNSP dan Kemnaker RI</p>
    <a href="/jadwal/" style="display:inline-block;background:var(--orange);color:#fff;padding:12px 24px;border-radius:8px;text-decoration:none;font-weight:700">📅 Lihat Jadwal Pelatihan</a>
  </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
<script src="<?= SITE_URL ?>/assets/js/main.js"></script>
</body></html>
