<?php
/**
 * city-page.php — Programmatic City × Training pages
 * Route: /pelatihan/{training_slug}/{city_slug}/
 * Generates 5,000+ unique SEO pages from 1 template + DB data.
 * Each page is unique: city name, population, industry, local keywords.
 */
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/glossary-functions.php';
require_once __DIR__ . '/includes/jadwal-functions.php';

$trainingSlug = sanitize(get_query_param('training_slug') ?: ($_GET['training_slug'] ?? ''));
$citySlug     = sanitize(get_query_param('city_slug')     ?: ($_GET['city_slug'] ?? ''));

if (!$trainingSlug || !$citySlug) { http_response_code(404); include '404.php'; exit; }

// Fetch training from DB
$pdo = get_pdo();
$training = $pdo->prepare("SELECT * FROM trainings WHERE slug=? AND is_active=1 LIMIT 1");
$training->execute([$trainingSlug]);
$training = $training->fetch();
if (!$training) { http_response_code(404); include '404.php'; exit; }

// Fetch city
$city = get_city_page($citySlug);
if (!$city) {
    // Try to generate city from cities table
    $cs = $pdo->prepare("SELECT * FROM cities WHERE slug=? LIMIT 1");
    $cs->execute([$citySlug]);
    $city = $cs->fetch();
}
if (!$city) { http_response_code(404); include '404.php'; exit; }

$cityName       = $city['name'];
$province       = $city['province'] ?? '';
$industry       = $city['industry_type'] ?? 'industri umum';
$population     = $city['population'] ?? 0;
$priceModifier  = (float)($city['price_modifier'] ?? 1.0);

// Upcoming schedules in this city or online
$schedules = get_public_schedules(['limit'=>5,'status'=>'open','is_public'=>1]);

// Base price with city modifier
$basePrice = (int)($training['base_price'] ?? 2500000);
$localPrice = (int)($basePrice * $priceModifier);

// Generate unique content variables
$s = get_all_settings();
$metaTitle = 'Pelatihan ' . $training['name'] . ' ' . $cityName . ' — Sertifikasi BNSP | Wahana Totalita';
$metaDesc  = 'Ikuti pelatihan ' . $training['name'] . ' di ' . $cityName . ', ' . $province . '. Sertifikasi BNSP & Kemnaker RI resmi. Harga mulai ' . format_price($localPrice) . '. Daftar sekarang.';

// Related city pages: other trainings × same city
$relatedTrainings = $pdo->query("SELECT name, slug FROM trainings WHERE slug != " . $pdo->quote($trainingSlug) . " AND is_active=1 ORDER BY RAND() LIMIT 6")->fetchAll();

// Nearby cities (same province)
$nearbyCities = [];
try {
    $nc = $pdo->prepare("SELECT name, slug FROM cities WHERE province=? AND slug!=? LIMIT 5");
    $nc->execute([$province, $citySlug]);
    $nearbyCities = $nc->fetchAll();
} catch (Exception $e) {}

$schema = json_encode([
  "@context"  => "https://schema.org",
  "@type"     => "Course",
  "name"      => $training['name'] . ' ' . $cityName,
  "description" => $metaDesc,
  "url"       => SITE_URL . "/pelatihan/{$trainingSlug}/{$citySlug}/",
  "provider"  => ["@type"=>"Organization","name"=>"Wahana Totalita Konsultan","url"=>SITE_URL],
  "hasCourseInstance" => [
    "@type"          => "CourseInstance",
    "courseMode"     => ["Online","Blended"],
    "offers"         => ["@type"=>"Offer","price"=>$localPrice,"priceCurrency"=>"IDR"]
  ]
]);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="noindex,follow">
<title><?= e($metaTitle) ?></title>
<meta name="description" content="<?= e($metaDesc) ?>">
<link rel="canonical" href="<?= SITE_URL ?>/pelatihan/<?= e($trainingSlug) ?>/<?= e($citySlug) ?>/">
<link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/style.css">
<script type="application/ld+json"><?= $schema ?></script>
<?= theme_css_vars($s) ?>
<style>
.city-hero{background:linear-gradient(135deg,var(--green),#1a5c3a);padding:60px 0;color:#fff}
.city-hero h1{font-size:clamp(1.4rem,3vw,2.2rem);font-weight:800;margin:0 0 12px;line-height:1.3}
.city-hero p{opacity:.85;max-width:680px;margin:0 0 24px}
.hero-cta{display:flex;gap:12px;flex-wrap:wrap}
.btn-orange{background:var(--orange);color:#fff;padding:14px 28px;border-radius:12px;font-weight:700;text-decoration:none;font-size:1rem}
.btn-white{background:rgba(255,255,255,.15);color:#fff;padding:14px 28px;border-radius:12px;font-weight:700;text-decoration:none;font-size:1rem;border:2px solid rgba(255,255,255,.3)}
.city-content{padding:48px 0}
.city-layout{display:grid;grid-template-columns:1fr 320px;gap:32px}
.content-block{background:#fff;border-radius:12px;border:1px solid #eee;padding:28px;margin-bottom:20px}
.content-block h2{font-size:1.1rem;font-weight:700;color:var(--green);margin:0 0 16px;padding-bottom:10px;border-bottom:2px solid #f0f9f0}
.content-block p,.content-block li{font-size:.9rem;color:#444;line-height:1.85}
.content-block ul{margin:0;padding-left:20px}
.stat-row{display:flex;gap:16px;flex-wrap:wrap;margin-bottom:20px}
.stat-pill{background:rgba(255,255,255,.15);padding:8px 16px;border-radius:100px;font-size:.85rem}
.price-card{background:#fff;border-radius:16px;border:2px solid var(--green);padding:28px;position:sticky;top:80px}
.price-card h3{color:var(--green);margin:0 0 16px;font-size:1.1rem}
.price-tag{font-size:2rem;font-weight:800;color:var(--orange);margin:0 0 4px}
.price-note{font-size:.8rem;color:#999;margin-bottom:20px}
.info-rows .row{display:flex;justify-content:space-between;padding:8px 0;border-bottom:1px solid #f0f0f0;font-size:.875rem}
.info-rows .row:last-child{border-bottom:none}
.info-rows .row .label{color:#999}
.info-rows .row .val{font-weight:600}
.btn-daftar-big{display:block;background:var(--orange);color:#fff;padding:14px;border-radius:12px;font-weight:700;text-align:center;text-decoration:none;margin-top:16px}
.btn-daftar-big:hover{background:var(--orange-dark)}
.nearby-city-links{display:flex;gap:8px;flex-wrap:wrap;margin-top:8px}
.city-link{display:inline-block;background:#f0f9f0;color:var(--green);padding:4px 12px;border-radius:100px;font-size:.8rem;font-weight:600;text-decoration:none}
.city-link:hover{background:var(--green);color:#fff}
.related-train-list{display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-top:8px}
.train-link{display:flex;gap:8px;align-items:center;padding:8px 12px;border:1px solid #eee;border-radius:8px;text-decoration:none;color:#333;font-size:.82rem}
.train-link:hover{border-color:var(--green);color:var(--green)}
.breadcrumb{font-size:.85rem;color:rgba(255,255,255,.6);margin-bottom:12px}
.breadcrumb a{color:rgba(255,255,255,.8);text-decoration:none}
@media(max-width:768px){.city-layout{grid-template-columns:1fr}.price-card{position:static}}
</style>
</head>
<body>
<?php include __DIR__ . '/includes/navbar.php'; ?>

<section class="city-hero">
  <div class="container">
    <div class="breadcrumb">
      <a href="/">Home</a> ›
      <a href="/pelatihan/">Pelatihan</a> ›
      <a href="/pelatihan/<?= e($trainingSlug) ?>/"><?= e($training['name']) ?></a> ›
      <?= e($cityName) ?>
    </div>
    <h1>Pelatihan <?= e($training['name']) ?> di <?= e($cityName) ?>, <?= e($province) ?></h1>
    <p>
      Ikuti pelatihan <?= e($training['name']) ?> di <?= e($cityName) ?> bersertifikasi BNSP & Kemnaker RI.
      <?php if ($population > 0): ?>
      Melayani <?= number_format($population) ?>+ penduduk dan ribuan perusahaan di wilayah <?= e($cityName) ?> & sekitarnya.
      <?php endif; ?>
      <?php if ($industry): ?>
      Cocok untuk sektor <?= e($industry) ?> yang dominan di wilayah ini.
      <?php endif; ?>
    </p>
    <div class="stat-row">
      <span class="stat-pill">🎓 Bersertifikat BNSP</span>
      <span class="stat-pill">✅ Kemnaker RI</span>
      <span class="stat-pill">📍 <?= e($cityName) ?> & Online</span>
      <span class="stat-pill">⏱ <?= e($training['duration_days'] ?? '?') ?> Hari</span>
    </div>
    <div class="hero-cta">
      <a href="#daftar" class="btn-orange">📝 Daftar Sekarang</a>
      <a href="<?= wa_url('Halo, saya ingin info pelatihan '.$training['name'].' di '.$cityName) ?>" class="btn-white">💬 Tanya via WhatsApp</a>
    </div>
  </div>
</section>

<div class="city-content">
  <div class="container">
    <div class="city-layout">
      <div>
        <div class="content-block">
          <h2>📋 Tentang Pelatihan <?= e($training['name']) ?> di <?= e($cityName) ?></h2>
          <p>
            Wahana Totalita Konsultan menyelenggarakan pelatihan <strong><?= e($training['name']) ?></strong> di wilayah <strong><?= e($cityName) ?>, <?= e($province) ?></strong>.
            <?= nl2br(e($training['description'] ?? 'Program pelatihan K3 ini dirancang untuk memberikan pemahaman mendalam dan kompetensi praktis kepada peserta.')) ?>
          </p>
          <?php if ($industry): ?>
          <p>Pelatihan ini sangat direkomendasikan untuk perusahaan di sektor <strong><?= e($industry) ?></strong> di <?= e($cityName) ?> yang wajib memenuhi standar K3 sesuai regulasi Kemnaker RI dan K3 nasional.</p>
          <?php endif; ?>
        </div>

        <?php
        $modules = [];
        if ($training['training_modules']) $modules = json_decode($training['training_modules'], true) ?: [];
        ?>
        <?php if (!empty($modules)): ?>
        <div class="content-block">
          <h2>📚 Materi Pelatihan</h2>
          <ul>
            <?php foreach ($modules as $m): ?>
            <li><?= e(is_array($m) ? ($m['title'] ?? '') : $m) ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
        <?php endif; ?>

        <div class="content-block">
          <h2>✅ Manfaat Mengikuti Pelatihan di <?= e($cityName) ?></h2>
          <ul>
            <li>Mendapatkan sertifikat K3 yang diakui secara nasional (BNSP / Kemnaker RI)</li>
            <li>Meningkatkan compliance K3 perusahaan di <?= e($cityName) ?> sesuai regulasi</li>
            <li>Mengurangi risiko kecelakaan kerja dan sanksi hukum</li>
            <li>Meningkatkan nilai tender pemerintah — syarat wajib memiliki tenaga K3 bersertifikat</li>
            <li>Investasi terbaik untuk karir di bidang K3 & HSE</li>
          </ul>
        </div>

        <div class="content-block">
          <h2>❓ Pertanyaan Umum — Pelatihan <?= e($training['name']) ?> <?= e($cityName) ?></h2>
          <details style="margin-bottom:12px">
            <summary style="cursor:pointer;font-weight:600;padding:8px 0">Apakah pelatihan ini tersedia di <?= e($cityName) ?>?</summary>
            <p style="padding:8px 0 0">Ya, Wahana Totalita melayani pelatihan <?= e($training['name']) ?> di <?= e($cityName) ?> dan seluruh wilayah <?= e($province) ?>. Tersedia dalam format offline (di <?= e($cityName) ?>) dan online via Zoom.</p>
          </details>
          <details style="margin-bottom:12px">
            <summary style="cursor:pointer;font-weight:600;padding:8px 0">Berapa biaya pelatihan <?= e($training['name']) ?> di <?= e($cityName) ?>?</summary>
            <p style="padding:8px 0 0">Biaya pelatihan mulai dari <strong><?= format_price($localPrice) ?></strong> per peserta. Tersedia diskon khusus untuk pendaftaran grup ≥5 orang dari perusahaan yang sama.</p>
          </details>
          <details>
            <summary style="cursor:pointer;font-weight:600;padding:8px 0">Berapa lama durasi pelatihan?</summary>
            <p style="padding:8px 0 0">Durasi pelatihan <?= e($training['name']) ?> adalah <?= e($training['duration_days'] ?? '?') ?> hari termasuk ujian kompetensi. Jadwal intensif tersedia bagi peserta dari luar kota.</p>
          </details>
        </div>

        <?php if (!empty($nearbyCities)): ?>
        <div class="content-block">
          <h2>🗺️ Kota Terdekat dari <?= e($cityName) ?></h2>
          <p>Wahana Totalita juga melayani pelatihan <?= e($training['name']) ?> di kota-kota berikut:</p>
          <div class="nearby-city-links">
            <?php foreach ($nearbyCities as $nc): ?>
            <a href="/pelatihan/<?= e($trainingSlug) ?>/<?= e($nc['slug']) ?>/" class="city-link">📍 <?= e($nc['name']) ?></a>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endif; ?>

        <?php if (!empty($relatedTrainings)): ?>
        <div class="content-block">
          <h2>🎓 Pelatihan K3 Lainnya di <?= e($cityName) ?></h2>
          <div class="related-train-list">
            <?php foreach ($relatedTrainings as $rt): ?>
            <a href="/pelatihan/<?= e($rt['slug']) ?>/<?= e($citySlug) ?>/" class="train-link">📚 <?= e(mb_substr($rt['name'],0,35)) ?></a>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endif; ?>
      </div>

      <div id="daftar">
        <div class="price-card">
          <h3>📝 Daftar Pelatihan <?= e($training['name']) ?></h3>
          <div class="price-tag"><?= format_price($localPrice) ?></div>
          <div class="price-note">per peserta · harga khusus <?= e($cityName) ?></div>
          <div class="info-rows">
            <div class="row"><span class="label">📍 Lokasi</span><span class="val"><?= e($cityName) ?> / Online</span></div>
            <div class="row"><span class="label">⏱ Durasi</span><span class="val"><?= e($training['duration_days'] ?? '?') ?> hari</span></div>
            <div class="row"><span class="label">🎓 Sertifikasi</span><span class="val"><?= e($training['certification_body'] ?? 'BNSP') ?></span></div>
            <div class="row"><span class="label">📋 Mode</span><span class="val">Offline & Online</span></div>
            <div class="row"><span class="label">📅 Jadwal</span><span class="val">Fleksibel</span></div>
          </div>
          <?php if (!empty($schedules)): ?>
          <div style="margin-top:16px;font-size:.8rem;color:#666;font-weight:600">Jadwal tersedia:</div>
          <?php foreach (array_slice($schedules,0,3) as $sched): ?>
          <a href="/jadwal/<?= $sched['id'] ?>/" style="display:block;padding:8px 0;font-size:.8rem;color:var(--green);text-decoration:none;border-bottom:1px solid #f0f0f0">
            📅 <?= format_date($sched['start_date']) ?> — <?= strtoupper($sched['mode']??'OFFLINE') ?>
          </a>
          <?php endforeach; ?>
          <?php endif; ?>
          <a href="/jadwal/" class="btn-daftar-big">📝 Lihat Semua Jadwal & Daftar</a>
          <div style="margin-top:12px;text-align:center">
            <a href="<?= wa_url('Halo, saya ingin daftar pelatihan '.$training['name'].' di '.$cityName) ?>" style="font-size:.875rem;color:var(--green);font-weight:600;text-decoration:none">💬 Tanya Jadwal via WhatsApp</a>
          </div>
        </div>

        <div style="background:var(--green);color:#fff;border-radius:12px;padding:20px;margin-top:16px;text-align:center">
          <p style="margin:0 0 12px;font-size:.875rem;opacity:.85">Butuh pelatihan in-house untuk tim di <?= e($cityName) ?>?</p>
          <a href="<?= wa_url('Halo, saya ingin pelatihan in-house '.$training['name'].' di '.$cityName.' untuk tim kami') ?>" style="display:block;background:var(--orange);color:#fff;padding:10px;border-radius:8px;text-decoration:none;font-weight:600">💬 Request In-House Training</a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
<script src="<?= SITE_URL ?>/assets/js/main.js"></script>
</body></html>
