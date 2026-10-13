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

// Fetch training from JSON
$training = get_training_by_slug($trainingSlug);
if (!$training) { http_response_code(404); include '404.php'; exit; }

// Fetch city from JSON
$allCities = get_cities(100);
$city = null;
foreach ($allCities as $c) {
    if (($c['slug'] ?? '') === $citySlug) {
        $city = $c;
        break;
    }
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
$allTrainings = get_trainings();
$relatedCandidates = [];
foreach ($allTrainings as $t) {
    if (($t['slug'] ?? '') !== $trainingSlug && ($t['is_active'] ?? 1)) {
        $relatedCandidates[] = ['name' => $t['name'], 'slug' => $t['slug']];
    }
}
shuffle($relatedCandidates);
$relatedTrainings = array_slice($relatedCandidates, 0, 6);

// Nearby cities (same province)
$nearbyCities = [];
foreach ($allCities as $c) {
    if (($c['province'] ?? '') === $province && ($c['slug'] ?? '') !== $citySlug) {
        $nearbyCities[] = ['name' => $c['name'], 'slug' => $c['slug']];
        if (count($nearbyCities) >= 5) break;
    }
}

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
<?php require __DIR__ . '/includes/css.php'; ?>
<script type="application/ld+json"><?= $schema ?></script>
<link rel="stylesheet" href="<?= asset_v('/assets/css/page/city-page.css') ?>">
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
          <div style="margin-top:16px;font-size:.8rem;color:var(--slate-600);font-weight:600">Jadwal tersedia:</div>
          <?php foreach (array_slice($schedules,0,3) as $sched): ?>
          <a href="/jadwal/<?= $sched['id'] ?>/" style="display:block;padding:8px 0;font-size:.8rem;color:var(--green);text-decoration:none;border-bottom:1px solid var(--slate-100)">
            📅 <?= format_date($sched['start_date']) ?> — <?= strtoupper($sched['mode']??'OFFLINE') ?>
          </a>
          <?php endforeach; ?>
          <?php endif; ?>
          <a href="/jadwal/" class="btn-daftar-big">📝 Lihat Semua Jadwal & Daftar</a>
          <div style="margin-top:12px;text-align:center">
            <a href="<?= wa_url('Halo, saya ingin daftar pelatihan '.$training['name'].' di '.$cityName) ?>" style="font-size:.875rem;color:var(--green);font-weight:600;text-decoration:none">💬 Tanya Jadwal via WhatsApp</a>
          </div>
        </div>

        <div style="background:var(--green);color:var(--surface);border-radius:12px;padding:20px;margin-top:16px;text-align:center">
          <p style="margin:0 0 12px;font-size:.875rem;opacity:.85">Butuh pelatihan in-house untuk tim di <?= e($cityName) ?>?</p>
          <a href="<?= wa_url('Halo, saya ingin pelatihan in-house '.$training['name'].' di '.$cityName.' untuk tim kami') ?>" style="display:block;background:var(--orange);color:var(--surface);padding:10px;border-radius:8px;text-decoration:none;font-weight:600">💬 Request In-House Training</a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
<script src="<?= SITE_URL ?>/assets/js/main.js"></script>
</body></html>
