<?php
require_once __DIR__ . '/config.php';

// ===================== AUTO RECOVERY SYSTEM (404 -> 301 or real 404, always logged) =====================
// Every request that reaches this file means the URL genuinely does not exist.
// Existing/working URLs never hit this file, so nothing here can break live pages.
//
// Decision logic (reviewed from 404-log.txt, approved YYYY-MM-DD):
//   1. Hardcoded legacy paths      -> 301 to their known new location (not logged, already trusted)
//   2. Confirmed junk/scanner/bot  -> real 404 page, LOGGED (so we can spot anything misclassified)
//   3. Keyword-matched slugs       -> 301 permanent redirect, LOGGED
//   4. Everything else (fallback)  -> real 404 page, LOGGED (no more blind-redirecting unknowns to "/")
//
// If review of the log later shows a fallback/junk URL is actually real traffic worth saving,
// add it as its own exact-match rule or a new keyword rule below.

$__requestUri = $_SERVER['REQUEST_URI'] ?? '/';
$__path       = strtolower((string) parse_url($__requestUri, PHP_URL_PATH));

// Sanitize referrer/user-agent before logging: strip line breaks so a forged
// header can't inject fake extra log lines.
$__clean = fn($v) => $v !== null ? str_replace(["\r", "\n"], ' ', $v) : '-';

$__logHit = function (string $outcome) use ($__requestUri, $__clean) {
    $__logLine = sprintf(
        "[%s] URL=%s REF=%s UA=%s -> %s\n",
        date('Y-m-d H:i:s'),
        $__requestUri,
        $__clean($_SERVER['HTTP_REFERER'] ?? null),
        $__clean($_SERVER['HTTP_USER_AGENT'] ?? null),
        $outcome
    );
    @file_put_contents(__DIR__ . '/404-log.txt', $__logLine, FILE_APPEND | LOCK_EX);
};

// ---------------------------------------------------------------------------
// 1. Hardcoded legacy URL redirects — confirmed real, permanent (301)
// ---------------------------------------------------------------------------
if ($__path === '/event-orgniser') {
    header('Location: /event-organizer/', true, 301);
    exit;
}

if ($__path === '/klient') {
    header('Location: /klien/', true, 301);
    exit;
}

if ($__path === '/tools/seafty-talk') {
    header('Location: /tools/safety-talk/', true, 301);
    exit;
}

if ($__path === '/artikel/gaji-ahli-k3-umum-di-indonesia/') {
    header('Location: /artikel/ahli-k3-umum-ak3u-syarat-tugas-sertifikasi', true, 301);
    exit;
}

if ($__path === '/artikel/pengawas-operasional-pertama-pop-pertambangan') {
    header('Location: /artikel/pengawas-operasional-pertama-pop-pertambangan-tugas-syarat-dan-sertifikasi', true, 301);
    exit;
}

if ($__path === '/artikel/pelatihan-pengelolaan-lingkungan-hidup-ukl-upl-proper/') {
    header('Location: /artikel/pelatihan-pengelolaan-lingkungan-hidup-untuk-perusahaan-ukl-upl-dan-proper', true, 301);
    exit;
}


// ---------------------------------------------------------------------------
// 2. Legacy training URL redirects
// ---------------------------------------------------------------------------

if ($__path === '/pelatihan/pengawas-k3-listrik') {
    header('Location: /pelatihan/pelatihan-ahli-k3-listrik-sertifikasi-bnsp/', true, 301);
    exit;
}

if ($__path === '/pelatihan/ahli-k3-penanggulangan-kebakaran-kelas-a/') {
    header('Location: /pelatihan/pelatihan-ahli-k3-penanggulangan-keb-kelas-a-sertifikasi-kemnaker-ri/', true, 301);
    exit;
}

if ($__path === '/pelatihan/amdal-penyusun') {
    header('Location: /pelatihan/pelatihan-teknis-pertek-limbah-b3-dan-emisi-udara-sertifikasi-bnsp/', true, 301);
    exit;
}

if ($__path === '/pelatihan/ahli-k3-umum') {
    header('Location: /pelatihan/pelatihan-ahli-k3-umum-sertifikasi-kemnaker-ri/', true, 301);
    exit;
}

if ($__path === '/pelatihan/pelatihan-ahli-k3-umum-sertifikasi-bnsp-online/') {
    header('Location: /pelatihan/ak3-bnsp/', true, 301);
    exit;
}

if ($__path === '/pelatihan/hazops/') {
    header('Location: /pelatihan/pelatihan-hazard-dan-operability-studies-hazops-sertifikasi-bnsp/', true, 301);
    exit;
}

if ($__path === '/pelatihan/operator-forklift') {
    header('Location: /pelatihan/pelatihan-k3-operator-forklift-kelas-2-sertifikasi-kemnaker-ri/', true, 301);
    exit;
}

if ($__path === '/pelatihan/ahli-k3-penanggulangan-kebakaran-kelas-a-tangerang.html') {
    header('Location: /pelatihan/pelatihan-ahli-k3-penanggulangan-keb-kelas-a-sertifikasi-kemnaker-ri/', true, 301);
    exit;
}

if ($__path === '/pelatihan/ahli-k3-listrik-bnsp/') {
    header('Location: /pelatihan/pelatihan-ahli-k3-listrik-sertifikasi-bnsp/', true, 301);
    exit;
}

if ($__path === '/pelatihan/regu-penanggulangan-kebakaran-kelas-c/') {
    header('Location: /pelatihan/pelatihan-regu-penanggulangan-kebakaran-kelas-c-sertifikasi-kemnaker-ri/', true, 301);
    exit;
}

if ($__path === '/pelatihan/tkbt-ii-banggai.html') {
    header('Location: /pelatihan/pelatihan-tkbt-ii-sertifikasi-kemnaker-ri/', true, 301);
    exit;
}

if ($__path === '/pelatihan/ahli-k3-umum-sumbawa.html') {
    header('Location: /pelatihan/pelatihan-ahli-k3-umum-sertifikasi-kemnaker-ri/', true, 301);
    exit;
}

if ($__path === '/pelatihan/ahli-k3-konstruksi') {
    header('Location: /pelatihan/ahli-k3-konstruksi-sertifikasi-bnsp/', true, 301);
    exit;
}

if ($__path === '/pelatihan/auditor-internal-k3') {
    header('Location: /pelatihan/pelatihan-auditor-sistem-manajemen-k3-sertifikasi-bnsp/', true, 301);
    exit;
}

if ($__path === '/pelatihan/pelatihan-ahli-k3-listrik') {
    header('Location: /pelatihan/pelatihan-ahli-k3-listrik-sertifikasi-kemnaker-ri/', true, 301);
    exit;
}

if ($__path === '/pelatihan-dan-sertifikasi-pengoperasian-alat-gali-muat-excavator-back-hoe-sertifikasi-bnsp') {
    header('Location: /pelatihan/pelatihan-dan-sertifikasi-pengoperasian-alat-gali-muat-excavator-back-hoe-sertifikasi-bnsp/', true, 301);
    exit;
}

if ($__path === '/pelatihan/penyusun-amdal') {
    header('Location: /pelatihan/pelatihan-teknis-pertek-limbah-b3-dan-emisi-udara-sertifikasi-bnsp/', true, 301);
    exit;
}


// ---------------------------------------------------------------------------
// 3. Legacy category / catalog pages
// ---------------------------------------------------------------------------

if ($__path === '/pelatihan-catalog') {
    header('Location: /pelatihan/', true, 301);
    exit;
}

if ($__path === '/pelatihan-kategori') {
    header('Location: /pelatihan/', true, 301);
    exit;
}

if ($__path === '/pelnanggulangan-kebakaran') {
    header('Location: /pelatihan/k3/', true, 301);
    exit;
}


// ---------------------------------------------------------------------------
// 4. Legacy resource pages
// ---------------------------------------------------------------------------

if ($__path === '/resources/template-hiradc-ibpr/') {
    header('Location: /k3/', true, 301);
    exit;
}

if ($__path === '/resources/materi-safety-talk-toolbox-meeting/') {
    header('Location: /k3/', true, 301);
    exit;
}


// ---------------------------------------------------------------------------
// 5. Legacy location pages
// ---------------------------------------------------------------------------

if ($__path === '/kota') {
    header('Location: /pelatihan-k3-balikpapan/', true, 301);
    exit;
}

if ($__path === '/kota/jakarta') {
    header('Location: /pelatihan-k3-jakarta/', true, 301);
    exit;
}


// ---------------------------------------------------------------------------
// 6. Legacy miscellaneous content
// ---------------------------------------------------------------------------

if ($__path === '/outbond') {
    header('Location: /pelatihan/', true, 301);
    exit;
}

if ($__path === '/galeri/index') {
    header('Location: /galeri', true, 301);
    exit;
}

if ($__path === '/syarat-ketentuan/') {
    header('Location: /event-organizer', true, 301);
    exit;
}

if ($__path === '/syarat-ketentuan') {
    header('Location: /event-organizer', true, 301);
    exit;
}

if ($__path === '/dafter') {
    header('Location: /jadwal/', true, 301);
    exit;
}


// ---------------------------------------------------------------------------
// 7. Legacy scheduling URLs
// ---------------------------------------------------------------------------
// These are old registration/session URLs. They do not have an equivalent
// individual training URL in the supplied sitemap, so send them to the
// training hub rather than creating a misleading product redirect.

if ($__path === '/jadwal/daftar/83/') {
    header('Location: /jadwal/', true, 301);
    exit;
}

if ($__path === '/jadwal/daftar/79/') {
    header('Location: /jadwal/', true, 301);
    exit;
}

if ($__path === '/jadwal/daftar/39/') {
    header('Location: /jadwal/', true, 301);
    exit;
}

if ($__path === '/jadwal/daftar/37/') {
    header('Location: /jadwal/', true, 301);
    exit;
}


// ---------------------------------------------------------------------------
// 8. Additional legacy pages identified from 404-log.txt review (2026-08-20)
//    Matched against current sitemap.xml slugs.
// ---------------------------------------------------------------------------

if ($__path === '/pelatihan/operator-scaffolding/') {
    header('Location: /pelatihan/pelatihan-k3-operator-scaffolding-sertifikasi-kemnaker-ri/', true, 301);
    exit;
}

if ($__path === '/pelatihan/operator-welder-kelas-1/') {
    header('Location: /pelatihan/pelatihan-k3-operator-welder-kelas-1-sertifikasi-kemnaker-ri/', true, 301);
    exit;
}

if ($__path === '/pelatihan/ahli-higiene-industri-muda/') {
    header('Location: /pelatihan/pelatihan-ahli-higiene-industri-muda-sertifikasi-bnsp/', true, 301);
    exit;
}

if ($__path === '/pelatihan/teknisi-ruang-terbatas/') {
    header('Location: /pelatihan/pelatihan-teknisi-ruang-terbatas-sertifikasi-bnsp/', true, 301);
    exit;
}

if ($__path === '/pelatihan/ahli-utama-ruang-terbatas-binjai/') {
    header('Location: /pelatihan/pelatihan-ahli-utama-ruang-terbatas-sertifikasi-bnsp/', true, 301);
    exit;
}

if ($__path === '/pelatihan/petugas-peran-kebakaran-kelas-d-kudus/') {
    header('Location: /pelatihan/pelatihan-petugas-peran-kebakaran-kelas-d-kemnaker-ri/', true, 301);
    exit;
}

if ($__path === '/pelatihan/pelatihan-petugas-peran-kebakaran-kelas-d/') {
    header('Location: /pelatihan/pelatihan-petugas-peran-kebakaran-kelas-d-kemnaker-ri/', true, 301);
    exit;
}

if ($__path === '/pelatihan/pelatihan-petugas-p3k-kemnaker-ri/') {
    header('Location: /pelatihan/pelatihan-petugas-p3k-sertifikasi-kemnaker-ri/', true, 301);
    exit;
}

if ($__path === '/pelatihan/operator-forklift-kelas-2/') {
    header('Location: /pelatihan/pelatihan-k3-operator-forklift-kelas-2-sertifikasi-kemnaker-ri/', true, 301);
    exit;
}

if ($__path === '/pelatihan/ahli-muda-lingkungan-kerja/') {
    header('Location: /pelatihan/pelatihan-ahli-muda-lingkungan-kerja-sertifikasi-kemnaker-ri/', true, 301);
    exit;
}

if ($__path === '/pelatihan/penanganan-bahaya-gas-h2s/') {
    header('Location: /pelatihan/pelatihan-penanganan-bahaya-gas-h2s-sertifikasi-bnsp/', true, 301);
    exit;
}

if ($__path === '/pelatihan/penanganan-bahaya-gas-h2s-maros.html') {
    header('Location: /pelatihan/pelatihan-penanganan-bahaya-gas-h2s-sertifikasi-bnsp/', true, 301);
    exit;
}

if ($__path === '/pelatihan/penyusun-amdal/') {
    header('Location: /pelatihan/pelatihan-teknis-pertek-limbah-b3-dan-emisi-udara-sertifikasi-bnsp/', true, 301);
    exit;
}

if ($__path === '/pelatihan/operator-motor-diesel-genset-mojokerto/') {
    header('Location: /pelatihan/pelatihan-k3-operator-motor-diesel-genset-sertifikasi-kemnaker-ri/', true, 301);
    exit;
}

if ($__path === '/pelatihan/operator-crane-kelas-3/') {
    header('Location: /pelatihan/pelatihan-k3-operator-crane-kelas-3-sertifikasi-kemnaker-ri/', true, 301);
    exit;
}

if ($__path === '/artikel/pelatihan-pengelolaan-lingkungan-hidup-ukl-upl-proper') {
    header('Location: /artikel/pelatihan-pengelolaan-lingkungan-hidup-untuk-perusahaan-ukl-upl-dan-proper', true, 301);
    exit;
}

if ($__path === '/pelatihan/pelatihan-operator-pesawat-tenaga-produksi-ptp/%20s') {
    header('Location: /pelatihan/pelatihan-operator-pesawat-tenaga-produksi-ptp/', true, 301);
    exit;
}

if ($__path === '/pelatihan/pelatihan-operator-pesawat-tenaga-produksi-ptp%20%20show') {
    header('Location: /pelatihan/pelatihan-operator-pesawat-tenaga-produksi-ptp/', true, 301);
    exit;
}

// high-frequency legacy path with no modern equivalent — sending to homepage
// rather than leaving as a dead-end 404 (revisit if a forum/blog section is ever rebuilt)
if ($__path === '/forum/' || $__path === '/forum') {
    header('Location: /', true, 301);
    exit;
}


// ---------------------------------------------------------------------------
// 8b. City-specific training slugs identified from 404-log.txt (2026-08-27)
//     Matched via substring so both trailing-slash and .html variants hit.
// ---------------------------------------------------------------------------

$__citySpecificRedirects = [
    // -> pelatihan-k3-operator-crane-kelas-3-sertifikasi-kemnaker-ri/
    // generic match — catches any city suffix (berau, ambon, kendal, and future ones)
    'operator-crane-kelas-3' => '/pelatihan/pelatihan-k3-operator-crane-kelas-3-sertifikasi-kemnaker-ri/',

    // -> pelatihan-k3-operator-scaffolding-sertifikasi-kemnaker-ri/
    'operator-scaffolding-palangka-raya' => '/pelatihan/pelatihan-k3-operator-scaffolding-sertifikasi-kemnaker-ri/',

    // -> pelatihan-tkbt-ii-sertifikasi-kemnaker-ri/ (same target as tkbt-ii-banggai in Section 8)
    'tkbt-ii-paser' => '/pelatihan/pelatihan-tkbt-ii-sertifikasi-kemnaker-ri/',
    'tkbt-ii-maros' => '/pelatihan/pelatihan-tkbt-ii-sertifikasi-kemnaker-ri/',

    // -> pelatihan-ahli-muda-lingkungan-kerja-sertifikasi-kemnaker-ri/
    'ahli-muda-lingkungan-kerja-morowali' => '/pelatihan/pelatihan-ahli-muda-lingkungan-kerja-sertifikasi-kemnaker-ri/',

    // -> pelatihan-regu-penanggulangan-kebakaran-kelas-c-sertifikasi-kemnaker-ri/
    'regu-penanggulangan-kebakaran-kelas-c-bojonegoro' => '/pelatihan/pelatihan-regu-penanggulangan-kebakaran-kelas-c-sertifikasi-kemnaker-ri/',

    // -> pelatihan-ahli-utama-ruang-terbatas-sertifikasi-bnsp/ (same target as -binjai in Section 8)
    'ahli-utama-ruang-terbatas-gorontalo' => '/pelatihan/pelatihan-ahli-utama-ruang-terbatas-sertifikasi-bnsp/',

    // No dedicated conveyor product page exists yet -> send to catalog rather
    // than a misleading product redirect. Revisit if a conveyor page is built.
    'operator-conveyor' => '/pelatihan/',
];

foreach ($__citySpecificRedirects as $__slug => $__target) {
    if (strpos($__path, $__slug) !== false) {
        header('Location: ' . $__target, true, 301);
        exit;
    }
}


// ---------------------------------------------------------------------------
// 9. Confirmed junk / scanner / bot-probe patterns — real 404, still logged
// ---------------------------------------------------------------------------

// Benign Chrome prefetch-proxy probe — extremely high frequency, zero signal.
// 404 silently, no log entry, so it doesn't drown out real 404s worth reviewing.
if ($__path === '/.well-known/traffic-advice') {
    http_response_code(404);
    goto __render_404;
}

$__junkPatterns = [
    // generic attack/scanner probes
    '/.env', '/wp-admin', '/wp-login', '/wp-content', '/wp-includes',
    '/wp-json', '/wp-sitemap', '/phpmyadmin', '/cgi-bin', '/.git',
    '/xmlrpc.php', '/.aws', '/vendor/', '/.ssh', '/.htpasswd',
    '/.htaccess', '/config.php.bak', '/.well-known/security',
    '/actuator', '/telescope', '/database/sync_run.php', '/admin]',
    '/login', '/crossdomain.xml', '/404error_test.html',

    // stale/legacy CMS paths with no modern equivalent
    '/images/stories/', '/apple-touch-icon-precomposed.png',

    // old dynamic upload filenames — no stable target to redirect to
    '/assets/uploads/',

    // malformed / injected external-looking paths
    '/recruitment.btn.co.id', '/www.holcim.co.id', '/ib.bri.co.id',

    // typo/scanner noise (not a real user typo worth mapping)
    '/gallry', '/gallary', '/artickel',

    // sitemap files that don't exist under these names
    '/sitemap-wahana-city-pages.xml', '/sitemap-wahana-index.xml',
    '/sitemap_index.xml',

    // expired/deleted training-schedule IDs — no live schedule to point to
    '/jadwal/daftar/',
];

foreach ($__junkPatterns as $__pat) {
    if (strpos($__path, $__pat) !== false) {
        $__logHit('404 (confirmed junk/scanner pattern: ' . $__pat . ')');
        http_response_code(404);
        goto __render_404;
    }
}

// ---------------------------------------------------------------------------
// 10. Keyword-matched slugs — 301 permanent redirect, logged
// ---------------------------------------------------------------------------
$__redirectRules = [
    'smk3' => '/smk3/',
    'bnsp' => '/sertifikasi-bnsp/',
    'iso'  => '/pelatihan-iso/',
    'k3'   => '/k3/', // keep last: broadest match, catches anything with "k3" in it
];

foreach ($__redirectRules as $__keyword => $__target) {
    if (strpos($__path, $__keyword) !== false) {
        $__logHit($__target . ' (keyword match: "' . $__keyword . '") [301 permanent]');
        header('Location: ' . $__target, true, 301);
        exit;
    }
}

// ---------------------------------------------------------------------------
// 11. Fallback — no junk match, no keyword match — real 404, logged
// ---------------------------------------------------------------------------
$__logHit('404 (fallback: no keyword match)');
http_response_code(404);

// ===================== END AUTO RECOVERY SYSTEM =====================

__render_404:
$s         = get_all_settings();
$categories = get_categories(); // needed by footer.php
$trainings = get_trainings();
$featured  = array_filter($trainings, fn($t) => $t['is_featured']);
$featured  = array_slice(array_values($featured), 0, 6);
if (count($featured) < 3) $featured = array_slice($trainings, 0, 6);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Halaman Tidak Ditemukan (404) | <?= e($s['site_name'] ?? 'Wahana Totalita Konsultan') ?></title>
<meta name="robots" content="noindex, follow">
<?php if (!empty($s['gtm_id'])): ?>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','<?= e($s['gtm_id']) ?>');</script>
<?php endif; ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/style.css">
<?= theme_css_vars($s) ?>
<style>
.e404-hero{background:var(--green,#0A4A2E);color:#fff;padding:80px 0 60px;text-align:center}
.e404-code{font-size:clamp(6rem,20vw,10rem);font-weight:800;line-height:1;margin:0;
  background:linear-gradient(135deg,var(--orange,#C6621C),#e8852e);
  -webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
.e404-hero h1{font-size:clamp(1.5rem,4vw,2.2rem);font-weight:800;margin:.5rem 0 1rem}
.e404-hero p{font-size:1rem;opacity:.8;max-width:440px;margin:0 auto 2rem;line-height:1.6}
.e404-actions{display:flex;gap:1rem;justify-content:center;flex-wrap:wrap}
.e404-btn-prim{background:var(--orange,#C6621C);color:#fff;padding:13px 28px;border-radius:8px;
  text-decoration:none;font-weight:700;font-size:15px;transition:background .2s}
.e404-btn-prim:hover{background:#a85118}
.e404-btn-sec{background:rgba(255,255,255,.12);color:#fff;border:1.5px solid rgba(255,255,255,.3);
  padding:12px 28px;border-radius:8px;text-decoration:none;font-weight:700;font-size:15px;
  transition:background .2s}
.e404-btn-sec:hover{background:rgba(255,255,255,.2)}
.e404-suggest{padding:4rem 0 5rem;background:#f9fafb}
.e404-suggest-title{text-align:center;font-size:1.4rem;font-weight:800;color:#1a1a2e;margin:0 0 2rem}
.e404-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:1rem}
.e404-card{background:#fff;border-radius:10px;overflow:hidden;box-shadow:0 2px 10px rgba(0,0,0,.06);
  text-decoration:none;color:inherit;transition:transform .2s,box-shadow .2s;display:flex;flex-direction:column}
.e404-card:hover{transform:translateY(-3px);box-shadow:0 6px 20px rgba(0,0,0,.1)}
.e404-card img{width:100%;aspect-ratio:16/9;object-fit:cover}
.e404-card-body{padding:1rem}
.e404-card-name{font-size:14px;font-weight:700;color:#1a1a2e;line-height:1.4;margin:0 0 .4rem}
.e404-card-price{font-size:13px;color:var(--orange,#C6621C);font-weight:600}
.e404-search{max-width:480px;margin:0 auto 3rem;display:flex;background:#fff;
  border-radius:50px;box-shadow:0 2px 16px rgba(0,0,0,.1);overflow:hidden}
.e404-search input{flex:1;border:none;outline:none;padding:13px 20px;font-size:14px}
.e404-search button{background:var(--green,#0A4A2E);border:none;padding:13px 22px;
  color:#fff;cursor:pointer;font-size:14px;font-weight:700}
</style>
</head>
<body>
<?php require __DIR__ . '/includes/navbar.php'; ?>

<section class="e404-hero">
  <div class="container">
    <p class="e404-code">404</p>
    <h1>Halaman Tidak Ditemukan</h1>
    <p>Halaman yang Anda cari tidak ada atau sudah dipindahkan. Coba cari program pelatihan yang Anda butuhkan di bawah ini.</p>
    <div class="e404-actions">
      <a href="/" class="e404-btn-prim">← Kembali ke Beranda</a>
      <a href="<?= wa_url('Halo, saya tidak bisa menemukan halaman yang saya cari di wahanatotalita.com') ?>" class="e404-btn-sec" target="_blank" rel="noopener">💬 Hubungi Kami</a>
    </div>
  </div>
</section>

<section class="e404-suggest">
  <div class="container">
    <p class="e404-suggest-title">Program Pelatihan Populer</p>
    <!-- Quick search -->
    <form class="e404-search" action="/" method="get">
      <input type="text" name="q" placeholder="Cari program pelatihan K3, Lingkungan..." autocomplete="off">
      <button type="submit">Cari</button>
    </form>
    <div class="e404-grid">
      <?php foreach ($featured as $t): ?>
      <a href="/pelatihan/<?= e($t['slug']) ?>/" class="e404-card">
        <img src="<?= training_img_url($t['image_path'] ?? null, $t['cat_slug'] ?? '') ?>"
             alt="<?= e($t['name']) ?>" loading="lazy" width="400" height="225">
        <div class="e404-card-body">
          <div class="e404-card-name"><?= e($t['name']) ?></div>
          <div class="e404-card-price"><?= format_price((int)$t['price']) ?> /orang</div>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
<?php require __DIR__ . '/includes/scripts.php'; ?>
</body>
</html>