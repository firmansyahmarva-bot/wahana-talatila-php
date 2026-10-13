<?php
/**
 * pelatihan-city-renderer.php
 * Unified high-performance renderer for 352 static training city pages.
 * 
 * Guarantees:
 * 1. 100% SEO preservation: exact untouched <title>, meta description, canonical URL, and JSON-LD schemas.
 * 2. Modern Stripe-clean navbar and footer.
 * 3. Dynamic real-time schedule feed via training-schedule-feed.js.
 */

require_once __DIR__ . '/config.php';
$s = get_all_settings();

$slug = get_url_slug();
if (!$slug) {
    http_response_code(404);
    require __DIR__ . '/404.php';
    exit;
}

$dataFile = __DIR__ . '/pelatihan-data/' . $slug . '.json';
if (!file_exists($dataFile)) {
    http_response_code(404);
    require __DIR__ . '/404.php';
    exit;
}

$page = json_decode(file_get_contents($dataFile), true);
if (!$page) {
    http_response_code(404);
    require __DIR__ . '/404.php';
    exit;
}

$page_title = $page['title'];
$meta_desc  = $page['description'];
$canonical  = $page['canonical'];
$schemas    = $page['schemas'] ?? [];
$content    = $page['content'];

// Strip outer <main> tags if present so we can wrap in single semantic <main>
$clean_content = preg_replace('#^<main\s*>#i', '', trim($content));
$clean_content = preg_replace('#</main>\s*#i', '', $clean_content);

// Dynamic floating whatsapp message
$wa_float_msg = 'Halo Wahana Totalita, saya ingin bertanya tentang pelatihan ' . ($page_title ?? '');

// Determine training slug & city for data attributes used by training-schedule-feed.js
$known_cities = ['balikpapan', 'bandung', 'bantul', 'batam', 'bekasi', 'cilegon', 'jakarta', 'makassar', 'malang', 'medan', 'pekanbaru', 'semarang', 'sleman', 'solo', 'surabaya', 'yogyakarta'];
$city_name = '';
$training_slug = $slug;
foreach ($known_cities as $c) {
    if (str_ends_with($slug, '-' . $c)) {
        $city_name = ucfirst($c);
        $training_slug = substr($slug, 0, -strlen($c) - 1);
        break;
    }
}
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8') ?></title>
<meta name="description" content="<?= htmlspecialchars($meta_desc, ENT_QUOTES, 'UTF-8') ?>">
<link rel="canonical" href="<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>">
<meta name="robots" content="index,follow">
<meta property="og:title" content="<?= htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:description" content="<?= htmlspecialchars($meta_desc, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:type" content="website">
<meta property="og:url" content="<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>">
<?php foreach ($schemas as $schema): ?>
<script type="application/ld+json"><?= $schema ?></script>
<?php endforeach; ?>
<link rel="stylesheet" href="/assets/css/core.css">
<link rel="stylesheet" href="/assets/css/components.css">
<link rel="stylesheet" href="/assets/css/page/training-city-remake.css">
<link rel="stylesheet" href="/assets/css/page/training-content.css">
<link rel="stylesheet" href="/assets/css/page/training-schedule-feed.css">
<link rel="stylesheet" href="/assets/css/page/training-fixes.css">
</head>
<body data-training-slug="<?= htmlspecialchars($training_slug, ENT_QUOTES, 'UTF-8') ?>" data-city="<?= htmlspecialchars($city_name, ENT_QUOTES, 'UTF-8') ?>">

<?php require __DIR__ . '/includes/navbar.php'; ?>

<main id="main-content">
<?= $clean_content ?>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>

<script src="/assets/js/main.js" defer></script>
<script src="/assets/js/training-schedule-feed.js" defer></script>
<script src="/assets/js/training-schedule-fallback.js" defer></script>
</body>
</html>
