<?php
/**
 * CRON: Rebuild XML Sitemaps
 * Schedule: Every Sunday at 02:00 WIB (Sundays 19:00 UTC Saturday)
 * Command:  php /home/u566907099/public_html/cron/sitemap-rebuild.php
 *
 * Generates:
 *  - /sitemap.xml          (main: static pages + trainings + articles + platform)
 *  - /sitemap-cities.xml   (city × training programmatic pages)
 *
 * Max URLs per sitemap: 49,999 (Google limit 50,000)
 * File is written directly to DOCUMENT_ROOT.
 */
define('CRON_RUN', true);
require_once __DIR__ . '/../config.php';

$pdo      = get_pdo();
$base     = SITE_URL;
$docroot  = $_SERVER['DOCUMENT_ROOT'] ?? __DIR__ . '/..';
$today    = date('Y-m-d');
$start    = microtime(true);
$urlCount = 0;

echo "[" . date('Y-m-d H:i:s') . "] Starting sitemap rebuild...\n";

// ─── Helper ──────────────────────────────────────────────────────────────────
function xml_url(string $loc, string $lastmod = '', string $changefreq = 'monthly', string $priority = '0.5'): string {
    $out = "  <url>\n    <loc>" . htmlspecialchars($loc, ENT_XML1) . "</loc>\n";
    if ($lastmod) $out .= "    <lastmod>{$lastmod}</lastmod>\n";
    $out .= "    <changefreq>{$changefreq}</changefreq>\n";
    $out .= "    <priority>{$priority}</priority>\n  </url>\n";
    return $out;
}

// ════════════════════════════════════════════════════════════════════
// 1. MAIN SITEMAP
// ════════════════════════════════════════════════════════════════════
$xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
$xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

// Static high-priority pages
$statics = [
    ['/', 'weekly', '1.0'],
    ['/jadwal/', 'daily', '0.9'],
    ['/resources/', 'weekly', '0.8'],
    ['/forum/', 'daily', '0.8'],
    ['/insiden/', 'weekly', '0.8'],
    ['/glosarium/', 'weekly', '0.7'],
    ['/lowongan/', 'weekly', '0.7'],
    ['/tools/', 'monthly', '0.7'],
    ['/tools/kalkulator-k3', 'monthly', '0.7'],
    ['/tools/risk-matrix', 'monthly', '0.7'],
    ['/tools/jsa-builder', 'monthly', '0.7'],
    ['/tools/ibpr-generator', 'monthly', '0.7'],
    ['/tools/safety-talk', 'monthly', '0.6'],
    ['/tools/ai-analyzer', 'monthly', '0.6'],
    ['/verifikasi/', 'monthly', '0.6'],
    ['/artikel/', 'weekly', '0.8'],
    ['/jadwal/kalender/', 'weekly', '0.7'],
    ['/csms', 'monthly', '0.6'],
    ['/perpanjangan-skp', 'monthly', '0.6'],
    ['/newsletter/', 'monthly', '0.5'],
    ['/workplace/', 'monthly', '0.5'],
];
foreach ($statics as [$path, $freq, $pri]) {
    $xml .= xml_url($base . $path, $today, $freq, $pri);
    $urlCount++;
}

// Training pages
try {
    $trainings = $pdo->query(
        "SELECT slug, updated_at FROM trainings WHERE is_active=1 ORDER BY updated_at DESC LIMIT 5000"
    )->fetchAll(PDO::FETCH_ASSOC);
    foreach ($trainings as $t) {
        $lm = $t['updated_at'] ? substr($t['updated_at'],0,10) : $today;
        $xml .= xml_url($base . '/pelatihan/' . $t['slug'] . '/', $lm, 'monthly', '0.8');
        $urlCount++;
    }
    echo "  Trainings: " . count($trainings) . "\n";
} catch (Exception $e) { echo "  WARN: trainings - " . $e->getMessage() . "\n"; }

// Articles
try {
    $articles = $pdo->query(
        "SELECT slug, updated_at FROM articles WHERE status='published' ORDER BY updated_at DESC LIMIT 5000"
    )->fetchAll(PDO::FETCH_ASSOC);
    foreach ($articles as $a) {
        $lm = $a['updated_at'] ? substr($a['updated_at'],0,10) : $today;
        $xml .= xml_url($base . '/artikel/' . $a['slug'] . '/', $lm, 'monthly', '0.7');
        $urlCount++;
    }
    echo "  Articles: " . count($articles) . "\n";
} catch (Exception $e) { echo "  WARN: articles - " . $e->getMessage() . "\n"; }

// Resources
try {
    $resources = $pdo->query(
        "SELECT slug, updated_at FROM resources WHERE is_active=1 ORDER BY updated_at DESC LIMIT 2000"
    )->fetchAll(PDO::FETCH_ASSOC);
    foreach ($resources as $r) {
        $xml .= xml_url($base . '/resources/' . $r['slug'] . '/', substr($r['updated_at'],0,10), 'monthly', '0.6');
        $urlCount++;
    }
    echo "  Resources: " . count($resources) . "\n";
} catch (Exception $e) {}

// Glosarium
try {
    $terms = $pdo->query(
        "SELECT slug, updated_at FROM glossary WHERE is_active=1 ORDER BY term ASC LIMIT 5000"
    )->fetchAll(PDO::FETCH_ASSOC);
    foreach ($terms as $t) {
        $xml .= xml_url($base . '/glosarium/' . $t['slug'] . '/', substr($t['updated_at'],0,10), 'monthly', '0.6');
        $urlCount++;
    }
    echo "  Glossary: " . count($terms) . "\n";
} catch (Exception $e) {}

// Incidents
try {
    $incidents = $pdo->query(
        "SELECT slug, updated_at FROM incidents WHERE is_published=1 ORDER BY incident_date DESC LIMIT 3000"
    )->fetchAll(PDO::FETCH_ASSOC);
    foreach ($incidents as $i) {
        $xml .= xml_url($base . '/insiden/' . $i['slug'] . '/', substr($i['updated_at'],0,10), 'monthly', '0.6');
        $urlCount++;
    }
    echo "  Incidents: " . count($incidents) . "\n";
} catch (Exception $e) {}

// Forum topics
try {
    $topics = $pdo->query(
        "SELECT slug, updated_at FROM forum_topics WHERE status='approved' ORDER BY updated_at DESC LIMIT 3000"
    )->fetchAll(PDO::FETCH_ASSOC);
    foreach ($topics as $t) {
        $xml .= xml_url($base . '/forum/topik/' . $t['slug'] . '/', substr($t['updated_at'],0,10), 'weekly', '0.5');
        $urlCount++;
    }
    echo "  Forum topics: " . count($topics) . "\n";
} catch (Exception $e) {}

// Forum categories
try {
    $cats = $pdo->query("SELECT slug FROM forum_categories WHERE is_active=1")->fetchAll(PDO::FETCH_COLUMN);
    foreach ($cats as $slug) {
        $xml .= xml_url($base . '/forum/' . $slug . '/', $today, 'weekly', '0.6');
        $urlCount++;
    }
} catch (Exception $e) {}

// Job listings
try {
    $jobs = $pdo->query(
        "SELECT slug, updated_at FROM jobs WHERE is_active=1 AND expires_at > NOW() ORDER BY posted_at DESC LIMIT 500"
    )->fetchAll(PDO::FETCH_ASSOC);
    foreach ($jobs as $j) {
        $xml .= xml_url($base . '/lowongan/' . $j['slug'] . '/', substr($j['updated_at'],0,10), 'weekly', '0.6');
        $urlCount++;
    }
    echo "  Jobs: " . count($jobs) . "\n";
} catch (Exception $e) {}

// City pages (pelatihan-k3-{kota})
try {
    $cities = $pdo->query("SELECT slug FROM cities ORDER BY slug ASC")->fetchAll(PDO::FETCH_COLUMN);
    foreach ($cities as $city) {
        $xml .= xml_url($base . '/pelatihan-k3-' . $city . '/', $today, 'monthly', '0.7');
        $urlCount++;
    }
    echo "  City pages: " . count($cities) . "\n";
} catch (Exception $e) {}

$xml .= '</urlset>';

// Write main sitemap
$path = rtrim($docroot, '/') . '/sitemap.xml';
if (file_put_contents($path, $xml) !== false) {
    echo "  ✅ sitemap.xml written ({$urlCount} URLs)\n";
} else {
    echo "  ❌ Failed to write sitemap.xml\n";
}

// ════════════════════════════════════════════════════════════════════
// 2. CITY × TRAINING SITEMAP
// ════════════════════════════════════════════════════════════════════
$xml2       = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
$xml2      .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
$cityCount  = 0;

try {
    $trainings = $pdo->query("SELECT slug FROM trainings WHERE is_active=1 LIMIT 200")->fetchAll(PDO::FETCH_COLUMN);
    $cities    = $pdo->query("SELECT slug FROM cities LIMIT 30")->fetchAll(PDO::FETCH_COLUMN);
    foreach ($trainings as $tslug) {
        foreach ($cities as $cslug) {
            $xml2 .= xml_url($base . '/pelatihan/' . $tslug . '/' . $cslug . '/', $today, 'monthly', '0.5');
            $cityCount++;
            if ($cityCount >= 49000) break 2; // safety limit
        }
    }
    echo "  City×Training combinations: {$cityCount}\n";
} catch (Exception $e) {
    echo "  WARN: city-training sitemap - " . $e->getMessage() . "\n";
}

$xml2 .= '</urlset>';

$path2 = rtrim($docroot, '/') . '/sitemap-cities.xml';
if (file_put_contents($path2, $xml2) !== false) {
    echo "  ✅ sitemap-cities.xml written ({$cityCount} URLs)\n";
} else {
    echo "  ❌ Failed to write sitemap-cities.xml\n";
}

// ── Update last_rebuild timestamp in settings ────────────────────────────────
try {
    $pdo->prepare("UPDATE site_settings SET setting_value=NOW() WHERE setting_key='sitemap_last_rebuilt'")->execute([]);
} catch (Exception $e) {}

$elapsed = round(microtime(true) - $start, 2);
echo "[" . date('Y-m-d H:i:s') . "] Sitemap rebuild complete. Total URLs: " . ($urlCount + $cityCount) . ". Time: {$elapsed}s\n";
