<?php
/**
 * k3.php — the single /k3 engine.
 *
 *   /k3            → the ONE indexed authority hub (index,follow, self-canonical)
 *   /k3/{slug}     → same engine, content SERVED ON DEMAND for that query.
 *   /k3?q={query}  → same, via query param (on-page search).
 *
 * On-demand views are noindex + canonical→/k3, so no thin pages get created or
 * indexed — the hub stays the only indexed URL. Every view converts to WhatsApp.
 */
declare(strict_types=1);

require __DIR__ . '/k3lib/src/autoload.php';
require __DIR__ . '/k3lib/src/helpers.php';

use App\Repositories\ProgramRepository;
use App\Repositories\KeywordRepository;
use App\Repositories\FaqRepository;

$settings = require __DIR__ . '/k3lib/config/settings.php';
$WA  = $settings['wa_number'];
$GTM = $settings['gtm_id'];
$year = date('Y');

$programRepo = new ProgramRepository();
$keywordRepo = new KeywordRepository();
$faqRepo     = new FaqRepository();

// --- Resolve incoming demand -------------------------------------------------
$raw = $_GET['slug'] ?? $_GET['q'] ?? '';
$raw = is_string($raw) ? substr($raw, 0, 160) : '';
$slug = norm_slug($raw);
$isDemand = $slug !== '';

$primary = null;
$matches = [];
$kwRow = null;

if ($isDemand) {
    $kwRow = $keywordRepo->findBySlug($slug);
    if ($kwRow) {
        $keywordRepo->recordHit((int)$kwRow['id']);
        if (!empty($kwRow['program_id'])) {
            $primary = $programRepo->find((int)$kwRow['program_id']);
        }
    }
    $matches = $programRepo->search(humanize($slug), 12);
    if (!$primary && !empty($matches)) {
        $primary = $matches[0];
    }
}

// --- SEO directives ----------------------------------------------------------
$hubUrl = $settings['canonical_base'] . $settings['hub_path'];
if ($isDemand) {
    // Served on demand — NOT its own indexed page.
    $robots = 'noindex,follow';
    $canonical = $hubUrl;
    $h1 = e(humanize($slug));
    $title = humanize($slug) . ' — Pelatihan & Sertifikasi | ' . $settings['org_name'];
    $metaDesc = 'Info ' . humanize($slug) . ': biaya, jadwal, syarat, dan sertifikasi resmi. Konsultasi & pendaftaran langsung via WhatsApp bersama ' . $settings['org_name'] . '.';
} else {
    // The one indexed hub.
    $robots = 'index,follow';
    $canonical = $hubUrl;
    $h1 = 'Pusat Pelatihan &amp; Sertifikasi K3, BNSP &amp; Kemnaker';
    $title = 'Pelatihan & Sertifikasi K3, BNSP & Kemnaker — Semua Program | ' . $settings['org_name'];
    $metaDesc = 'Direktori lengkap pelatihan & sertifikasi K3, BNSP, dan Kemnaker: Ahli K3 Umum, K3 Migas, P3K, lingkungan, dan puluhan program lain. Biaya transparan, sertifikat resmi, konsultasi via WhatsApp.';
}

// --- Content data ------------------------------------------------------------
$grouped = $programRepo->groupedByCertification();
$totalPrograms = $programRepo->countActive();
$faqs = $faqRepo->forProgram($primary['id'] ?? null, 6);
$kwIndex = $keywordRepo->indexSample(10);

// WhatsApp message carries the demand context — great for the sales team.
$waContext = $isDemand ? humanize($slug) : 'program pelatihan K3 / sertifikasi';
$waMsg = "Halo, saya ingin info & pendaftaran untuk \"{$waContext}\". Mohon dibantu jadwal dan biayanya.";
$waLink = wa_url($WA, $waMsg);

$WASVG = '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.5 14.4c-.3-.1-1.8-.9-2-1-.3-.1-.5-.1-.7.1-.2.3-.8 1-.9 1.2-.2.2-.3.2-.6.1-.3-.2-1.3-.5-2.4-1.5-.9-.8-1.5-1.8-1.7-2-.2-.3 0-.5.1-.6l.5-.5c.1-.2.2-.3.3-.5.1-.2 0-.4 0-.5l-.9-2.2c-.2-.6-.5-.5-.7-.5h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.5s1.1 2.9 1.2 3.1c.1.2 2.1 3.2 5.1 4.5.7.3 1.3.5 1.7.6.7.2 1.4.2 1.9.1.6-.1 1.8-.7 2-1.4.2-.7.2-1.3.2-1.4-.1-.1-.3-.2-.6-.3M12 2a10 10 0 0 0-8.6 15l-1.3 4.7 4.8-1.3A10 10 0 1 0 12 2z"/></svg>';
$CHK = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6 9 17l-5-5"/></svg>';

$lpCss = @file_get_contents(__DIR__ . '/k3lib/assets/lp-glass.css');

// Renders one program card. Shared by the matched-results, "Semua Program",
// and folded-overflow blocks so the markup exists in exactly one place.
$renderProgCard = function (array $p) use ($WA, $WASVG): void {
    $mwa = wa_url($WA, "Halo, saya tertarik dengan \"{$p['name']}\". Mohon info jadwal & biaya.");
    ?>
    <div class="prog-item glass">
      <span class="pn"><?= e($p['name']) ?></span>
      <div class="meta">
        <?php if (!empty($p['certification'])): ?><span><b><?= e($p['certification']) ?></b></span><?php endif; ?>
        <?php if (!empty($p['duration_days'])): ?><span><?= (int)$p['duration_days'] ?> hari</span><?php endif; ?>
        <?php if (!empty($p['mode'])): ?><span><?= e(ucfirst($p['mode'])) ?></span><?php endif; ?>
        <span><b><?= e(format_price($p['price'])) ?></b></span>
      </div>
      <div class="pcta">
        <a class="btn-wa mini" href="<?= e($mwa) ?>" target="_blank" rel="noopener"><?= $WASVG ?> Daftar</a>
        <a class="mini-out" href="<?= e($p['external_url']) ?>">Detail &rarr;</a>
      </div>
    </div>
    <?php
};

// Cap: only this many cards show open per group; the rest fold into a native
// <details> disclosure (same accordion pattern as the FAQ) so ad-landing
// visitors reach FAQ/benefits/CTA quickly, without deleting any content —
// folded programs stay in the HTML (crawlable), just visually collapsed.
const K3_VISIBLE_PER_GROUP = 6;

// JSON-LD: ItemList of programs on the hub; on demand, the primary program.
$jsonLd = null;
if (!$isDemand) {
    $items = [];
    $i = 1;
    foreach ($programRepo->allActive() as $p) {
        $items[] = ['@type' => 'ListItem', 'position' => $i++, 'name' => $p['name'], 'url' => $p['external_url']];
        if ($i > 50) break;
    }
    $jsonLd = ['@context' => 'https://schema.org', '@type' => 'ItemList', 'itemListElement' => $items];
} elseif ($primary) {
    $jsonLd = [
        '@context' => 'https://schema.org', '@type' => 'Course',
        'name' => $primary['name'],
        'description' => $primary['description'] ?: $metaDesc,
        'provider' => ['@type' => 'Organization', 'name' => $settings['org_name'], 'url' => $settings['canonical_base']],
        'url' => $primary['external_url'],
    ];
}
if ($faqs) {
    $faqLd = ['@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => array_map(fn($f) => [
        '@type' => 'Question', 'name' => $f['question'],
        'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['answer']],
    ], $faqs)];
}
?><!DOCTYPE html>
<html lang="id" translate="no">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= e($title) ?></title>
<meta name="description" content="<?= e($metaDesc) ?>">
<link rel="canonical" href="<?= e($canonical) ?>">
<meta name="robots" content="<?= e($robots) ?>">
<meta property="og:title" content="<?= e($title) ?>">
<meta property="og:description" content="<?= e($metaDesc) ?>">
<meta property="og:type" content="website">
<meta property="og:url" content="<?= e($canonical) ?>">
<?php if ($jsonLd): ?><script type="application/ld+json"><?= json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script><?php endif; ?>
<?php if (!empty($faqLd)): ?><script type="application/ld+json"><?= json_encode($faqLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script><?php endif; ?>
<script>
(function(){var l=false;function g(){if(l)return;l=true;(function(w,d,s,i){w.dataLayer=w.dataLayer||[];w.dataLayer.push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s);j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i;f.parentNode.insertBefore(j,f);})(window,document,'script','<?= $GTM ?>');}
['scroll','touchstart','mousemove','keydown','click'].forEach(function(e){window.addEventListener(e,g,{once:true,passive:true});});setTimeout(g,3500);})();
</script>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
<noscript><link href="https://fonts.googleapis.com/css2?family=Sora:wght@600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"></noscript>
<?php if ($lpCss): ?><style><?= $lpCss ?></style><?php else: ?><link rel="stylesheet" href="/k3lib/assets/lp-glass.css"><?php endif; ?>
<style>
.k3-search{display:flex;gap:10px;max-width:560px;margin:22px auto 0;flex-wrap:wrap}
.k3-search input{flex:1;min-width:200px;padding:14px 18px;border-radius:12px;border:1px solid rgba(255,255,255,.4);background:rgba(255,255,255,.9);font-size:15px}
.k3-search button{border:none;cursor:pointer}
.prog-group{margin-bottom:34px}
.prog-group h3{font-family:'Sora';font-size:1.15rem;color:#0b5d4a;margin-bottom:14px;display:flex;align-items:center;gap:10px}
.prog-group h3 .cnt{font-size:12px;font-weight:600;background:rgba(13,148,136,.15);color:#0b5d4a;padding:3px 10px;border-radius:20px}
.prog-list{display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:12px}
.prog-item{border-radius:14px;padding:16px 18px;display:flex;flex-direction:column;gap:6px}
.prog-item .pn{font-weight:700;color:#0c1f1a;font-size:15px;line-height:1.35}
.prog-item .meta{display:flex;gap:8px;flex-wrap:wrap;font-size:12px;color:#3a554d}
.prog-item .meta b{color:var(--green)}
.prog-item .pcta{display:flex;gap:8px;margin-top:6px;flex-wrap:wrap}
.prog-item .mini{font-size:13px;padding:8px 14px;border-radius:9px;min-height:0}
.mini-out{background:rgba(6,78,59,.08);color:var(--green);font-weight:700;text-decoration:none;display:inline-flex;align-items:center;padding:8px 14px;border-radius:9px;font-size:13px}
.kw-index{columns:2;column-gap:26px;max-width:900px;margin:0 auto}
.kw-index .kw-mod{break-inside:avoid;margin-bottom:18px}
.kw-index h4{font-family:'Sora';font-size:14px;color:#0b5d4a;text-transform:capitalize;margin-bottom:8px}
.kw-index a{display:block;font-size:13.5px;color:#33514a;text-decoration:none;padding:3px 0}
.kw-index a:hover{color:var(--green2)}
@media(max-width:560px){.kw-index{columns:1}}
.demand-note{max-width:760px;margin:0 auto 8px;text-align:center;font-size:14px;color:#3a554d}
.prog-more{margin-top:6px}
.prog-more summary{font-size:14px;padding:12px 0;color:var(--green)}
.prog-more summary::after{color:var(--green2)}
.prog-more .prog-list{margin-top:10px}

/* --- Contrast fix: ad traffic often lands via Facebook/Instagram/TikTok
   in-app browsers, which frequently have weak or no backdrop-filter support.
   Without it, .glass falls back to a thin 55%-opacity white sheet over the
   busy gradient background, and small gray text becomes hard to read. Force
   a near-opaque, high-contrast fallback whenever blur isn't actually applied,
   and unconditionally strengthen text darkness on small viewports. */
@supports not ((backdrop-filter: blur(1px)) or (-webkit-backdrop-filter: blur(1px))) {
  .glass{background:rgba(255,255,255,.96)}
}
@media(max-width:860px){
  .glass{background:rgba(255,255,255,.88)}
  .prog-item .meta{color:#1f3b33;font-weight:600}
  .prog-item .meta b{color:#064e3b}
  .kw-index a{color:#1f3b33}
  .demand-note{color:#1f3b33}
  .card p{color:#1f3b33}
  .testi p{color:#1f3b33}
  .subtitle{color:#26413a}
}
</style>
</head>
<body>
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?= $GTM ?>" height="0" width="0" style="display:none"></iframe></noscript>

<section class="hero"><div class="wrap hero-inner">
  <div>
    <div class="pill"><span class="dot"></span> <?= $totalPrograms ?>+ Program · Sertifikat Resmi Nasional</div>
    <h1><?= $h1 ?></h1>
    <?php if ($isDemand && $primary): ?>
      <p class="lead"><?= e($primary['name']) ?> — sertifikasi <?= e($primary['certification'] ?: 'resmi') ?>, dibantu sampai sertifikat terbit. Konsultasi jadwal & biaya langsung via WhatsApp.</p>
    <?php elseif ($isDemand): ?>
      <p class="lead">Kami bantu kebutuhan pelatihan &amp; sertifikasi Anda untuk "<?= $h1 ?>". Konsultasikan jadwal, biaya, dan persyaratannya langsung dengan tim kami.</p>
    <?php else: ?>
      <p class="lead">Semua program pelatihan &amp; sertifikasi K3, BNSP, dan Kemnaker dalam satu tempat. Biaya transparan, instruktur praktisi, jadwal tiap bulan, sertifikat resmi diakui nasional.</p>
    <?php endif; ?>
    <p class="reassure">&#10003; Dibantu sampai selesai &nbsp;&middot;&nbsp; &#10003; Bisa online dari seluruh Indonesia &nbsp;&middot;&nbsp; &#10003; Sertifikat resmi</p>
    <div class="hero-cta">
      <a class="btn-wa" href="<?= e($waLink) ?>" target="_blank" rel="noopener"><?= $WASVG ?> Konsultasi via WhatsApp</a>
      <?php if ($isDemand && $primary): ?>
        <div class="price-tag">Investasi mulai<b><?= e(format_price($primary['price'])) ?></b></div>
      <?php endif; ?>
    </div>
    <form class="k3-search" action="<?= e($settings['hub_path']) ?>" method="get" role="search">
      <input type="text" name="q" placeholder="Cari pelatihan… mis. ahli k3 umum, forklift, migas" value="<?= $isDemand ? e(humanize($slug)) : '' ?>">
      <button class="btn-wa" type="submit" style="padding:14px 22px">Cari</button>
    </form>
  </div>
  <div class="hcard">
    <div class="urg">&#128293; Batch bulan ini — kuota terbatas</div>
    <h3>Ringkasan</h3>
    <?php if ($isDemand && $primary): ?>
      <div class="row"><span>Program</span><b><?= e($primary['name']) ?></b></div>
      <div class="row"><span>Sertifikasi</span><b><?= e($primary['certification'] ?: 'Resmi') ?></b></div>
      <?php if (!empty($primary['duration_days'])): ?><div class="row"><span>Durasi</span><b><?= (int)$primary['duration_days'] ?> hari</b></div><?php endif; ?>
      <div class="row"><span>Investasi</span><b><?= e(format_price($primary['price'])) ?></b></div>
      <div class="row"><span>Metode</span><b><?= e(ucfirst($primary['mode'] ?: 'Online / Offline')) ?></b></div>
    <?php else: ?>
      <div class="row"><span>Total Program</span><b><?= $totalPrograms ?>+</b></div>
      <div class="row"><span>Sertifikasi</span><b>BNSP · Kemnaker RI</b></div>
      <div class="row"><span>Metode</span><b>Online &amp; Offline</b></div>
      <div class="row"><span>Jadwal</span><b>Setiap bulan</b></div>
    <?php endif; ?>
    <a class="btn-wa" href="<?= e($waLink) ?>" target="_blank" rel="noopener" style="width:100%;margin-top:16px"><?= $WASVG ?> Tanya Jadwal &amp; Biaya</a>
  </div>
</div></section>

<div class="trust"><div class="wrap">
  <p>Dipercaya oleh tim K3 dari perusahaan</p>
  <div class="trust-logos"><?php foreach(['PT Badak NGL','Pupuk Kujang','Indonesia Power','PT Itokoh Ceperindo','Pertamina','+ ratusan lainnya'] as $t): ?><span class="tchip"><?= e($t) ?></span><?php endforeach; ?></div>
</div></div>

<?php if ($isDemand && !empty($matches)): /* ---- ON-DEMAND: matched programs ---- */ ?>
<section class="pad"><div class="wrap">
  <div class="eyebrow">Hasil untuk pencarian Anda</div>
  <h2 class="title">Program terkait "<?= $h1 ?>"</h2>
  <p class="subtitle">Klik WhatsApp untuk jadwal &amp; biaya, atau lihat detail lengkap di halaman program.</p>
  <div class="prog-list">
    <?php foreach(array_slice($matches, 0, K3_VISIBLE_PER_GROUP) as $p): $renderProgCard($p); endforeach; ?>
  </div>
  <?php $moreMatches = array_slice($matches, K3_VISIBLE_PER_GROUP); if ($moreMatches): ?>
    <details class="glass prog-more">
      <summary>Lihat <?= count($moreMatches) ?> program terkait lainnya</summary>
      <div class="prog-list"><?php foreach($moreMatches as $p): $renderProgCard($p); endforeach; ?></div>
    </details>
  <?php endif; ?>
</div></section>
<?php endif; ?>

<?php /* ---- Full catalogue grouped by certification — capped per group, rest
   folds into <details> so FAQ/benefits/CTA aren't buried under 162 cards. ---- */ ?>
<section class="pad" id="semua"><div class="wrap">
  <div class="eyebrow">Semua Program</div>
  <h2 class="title"><?= $isDemand ? 'Jelajahi seluruh program' : 'Pilih program pelatihan &amp; sertifikasi Anda' ?></h2>
  <p class="subtitle">Semua harga sudah termasuk ujian &amp; sertifikat resmi. Klik untuk konsultasi cepat via WhatsApp.</p>
  <?php foreach($grouped as $cert => $items): ?>
    <div class="prog-group">
      <h3><?= e($cert) ?> <span class="cnt"><?= count($items) ?> program</span></h3>
      <div class="prog-list">
        <?php foreach(array_slice($items, 0, K3_VISIBLE_PER_GROUP) as $p): $renderProgCard($p); endforeach; ?>
      </div>
      <?php $moreItems = array_slice($items, K3_VISIBLE_PER_GROUP); if ($moreItems): ?>
        <details class="glass prog-more">
          <summary>Lihat <?= count($moreItems) ?> program <?= e($cert) ?> lainnya</summary>
          <div class="prog-list"><?php foreach($moreItems as $p): $renderProgCard($p); endforeach; ?></div>
        </details>
      <?php endif; ?>
    </div>
  <?php endforeach; ?>
</div></section>

<section class="pad"><div class="wrap">
  <div class="eyebrow">Kenapa Wahana Totalita</div>
  <h2 class="title">Semua yang Anda butuhkan untuk bersertifikat</h2>
  <div class="cards">
    <?php
    $benefits = [
      ['Sertifikat Resmi','Diakui secara hukum di seluruh Indonesia (BNSP / Kemnaker RI).'],
      ['Online via Zoom','Ikuti dari mana saja, sertifikat tetap sah.'],
      ['Jadwal Tiap Bulan','Banyak pilihan batch, tidak menunggu lama.'],
      ['Instruktur Praktisi','Diajar ahli berpengalaman dari industri nyata.'],
      ['Harga Transparan','Sudah termasuk ujian &amp; sertifikat resmi.'],
      ['Dibantu Sampai Selesai','Kami dampingi administrasi hingga sertifikat terbit.'],
    ];
    foreach($benefits as $b): ?>
      <div class="card glass"><div class="ic"><?= $CHK ?></div><h3><?= $b[0] ?></h3><p><?= $b[1] ?></p></div>
    <?php endforeach; ?>
  </div>
</div></section>

<?php if ($faqs): ?>
<section class="pad"><div class="wrap">
  <div class="eyebrow">Pertanyaan Umum</div>
  <h2 class="title">Masih ragu? Ini jawabannya</h2>
  <div class="faq"><?php foreach($faqs as $k=>$f): ?>
    <details class="glass"<?= $k===0?' open':'' ?>><summary><?= e($f['question']) ?></summary><p><?= e($f['answer']) ?></p></details>
  <?php endforeach; ?></div>
</div></section>
<?php endif; ?>

<?php if (!$isDemand && $kwIndex): /* internal topical index — hub only, grouped & capped (not a 10k link wall) */ ?>
<section class="pad"><div class="wrap">
  <div class="eyebrow">Topik Populer</div>
  <h2 class="title">Cari berdasarkan kebutuhan</h2>
  <p class="subtitle">Pertanyaan yang sering dicari seputar biaya, jadwal, syarat, dan lokasi pelatihan.</p>
  <div class="kw-index">
    <?php foreach($kwIndex as $mod => $rows): if(empty($rows)) continue; ?>
      <div class="kw-mod">
        <h4><?= e($mod) ?></h4>
        <?php foreach($rows as $r): ?>
          <a href="<?= e($settings['hub_path'].'/'.$r['norm_slug']) ?>"><?= e($r['phrase']) ?></a>
        <?php endforeach; ?>
      </div>
    <?php endforeach; ?>
  </div>
</div></section>
<?php endif; ?>

<section class="pad"><div class="wrap"><div class="final">
  <h2>Siap raih sertifikat Anda?</h2>
  <p>Ribuan profesional sudah bersertifikat bersama kami. Sekarang giliran Anda. Chat tim kami untuk jadwal batch terdekat &amp; biaya.</p>
  <a class="btn-wa" href="<?= e($waLink) ?>" target="_blank" rel="noopener"><?= $WASVG ?> Chat WhatsApp Sekarang</a>
</div></div></section>

<footer class="foot"><div class="wrap">
  <div class="links"><a href="/">Beranda</a>&middot;<a href="/#produk">Semua Program</a>&middot;<a href="/jadwal/">Jadwal</a>&middot;<a href="<?= e($settings['hub_path']) ?>">Pusat K3</a></div>
  &#128241; 0812-2969-435 &middot; &#9993;&#65039; info@wahanatotalita.com &middot; &#128205; Yogyakarta<br>
  <span style="opacity:.65">&copy; <?= $year ?> <?= e($settings['org_name']) ?></span>
</div></footer>

<div class="sticky">
  <div class="info"><?= $isDemand && $primary ? e($primary['name']) : 'Pelatihan & Sertifikasi K3 / BNSP' ?><b><?= $isDemand && $primary ? 'Mulai '.e(format_price($primary['price'])) : $totalPrograms.'+ program tersedia' ?></b></div>
  <a class="btn-wa" href="<?= e($waLink) ?>" target="_blank" rel="noopener"><?= $WASVG ?> Daftar</a>
</div>
</body>
</html>
