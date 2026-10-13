<?php
/**
 * Sitemap Router — replaces the old monolithic sitemap.php
 *
 * Routes:
 *   /sitemap.xml              → sitemapindex (this file, no ?type)
 *   /sitemap-core.xml         → ?type=core
 *   /sitemap-pelatihan.xml    → ?type=pelatihan
 *   /sitemap-artikel.xml      → ?type=artikel
 *   /sitemap-kota.xml         → ?type=kota
 *   /sitemap-platform.xml     → ?type=platform
 *   /sitemap-jadwal.xml       → physical schedule sitemap (no rewrite required)
 *   /sitemap-glosarium.xml    → ?type=glosarium
 *
 * .htaccess routes all sitemap-*.xml requests to this file with ?type= param.
 */
require_once __DIR__ . '/config.php';

header('Content-Type: application/xml; charset=utf-8');
header('X-Robots-Tag: noindex');

$base = rtrim(SITE_URL, '/');
$type = $_GET['type'] ?? '';

// ─── XML helpers ────────────────────────────────────────────────────────────
function sm_url(string $loc, string $lastmod = '', string $priority = '0.5'): string {
    $out = "  <url>\n    <loc>" . htmlspecialchars($loc, ENT_XML1) . "</loc>\n";
    if ($lastmod) $out .= "    <lastmod>{$lastmod}</lastmod>\n";
    $out .= "    <priority>{$priority}</priority>\n  </url>\n";
    return $out;
}

function sm_header(): string {
    return '<?xml version="1.0" encoding="UTF-8"?>' . "\n"
         . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
}

// ════════════════════════════════════════════════════════════════════════════
// SITEMAP INDEX (default — no ?type)
// ════════════════════════════════════════════════════════════════════════════
if ($type === '') {
    $now = date('c');
    echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    echo '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    foreach (['core','pelatihan','artikel','kota','kota-pelatihan','platform','jadwal','glosarium','regulasi','skkni','riksa-uji','perpanjangan-skp','purnabakti','event'] as $child) {
        $childUrl = $child === 'jadwal'
            ? $base . '/sitemap-jadwal.xml'
            : $base . '/sitemap-' . $child . '.xml';
        echo "  <sitemap>\n";
        echo "    <loc>" . htmlspecialchars($childUrl, ENT_XML1) . "</loc>\n";
        echo "    <lastmod>{$now}</lastmod>\n";
        echo "  </sitemap>\n";
    }
    echo '</sitemapindex>' . "\n";
    exit;
}

// ════════════════════════════════════════════════════════════════════════════
// CHILD SITEMAPS
// ════════════════════════════════════════════════════════════════════════════

$pdo = null;

switch ($type) {

// ─── CORE: homepage, hub/service pages, legal ───────────────────────────────
case 'core':
    echo sm_header();

    // Homepage
    echo sm_url($base . '/', date('Y-m-d'), '1.0');

    // Pages with NO trailing-slash canonical
    $no_slash = [
        'perusahaan'        => '0.9',
        'layanan-pemerintah'=> '0.9',
        'perpanjangan-skp'  => '0.8',
        'csms'              => '0.7',
        'kebijakan-privasi' => '0.4',
        'k3'                => '0.8',
    ];
    foreach ($no_slash as $slug => $pri) {
        $file = __DIR__ . '/' . $slug . '.php';
        $lm = file_exists($file) ? date('Y-m-d', filemtime($file)) : '';
        echo sm_url($base . '/' . $slug, $lm, $pri);
    }

    // Pages with trailing-slash canonical
    $with_slash = [
        'zh'                             => '0.85',
        'zh/factory-roadmap'             => '0.85',
        'zh/ahli-k3-umum'                => '0.8',
        'zh/sio-alat-berat'              => '0.8',
        'zh/smk3'                        => '0.8',
        'zh/juru-las'                    => '0.8',
        'zh/in-house-training'           => '0.8',
        'zh/kecelakaan-kerja'            => '0.8',
        'zh/k3-kimia'                    => '0.8',
        'zh/k3-kebakaran'                => '0.8',
        'zh/k3-pertambangan'             => '0.8',
        'zh/checklist'                   => '0.8',
        'en'                             => '0.9',
        'en/indonesia-occupational-safety-law'        => '0.85',
        'en/p2k3-safety-committee-requirements'       => '0.8',
        'en/workplace-accident-reporting-procedure'   => '0.8',
        'en/smk3-certification-guide'                 => '0.85',
        'en/smk3-vs-iso-45001'                        => '0.85',
        'en/csms-contractor-safety-management-system' => '0.8',
        'en/safety-officer-ak3-umum-requirements'     => '0.85',
        'en/chemical-safety-officer-requirements'     => '0.8',
        'en/electrical-safety-expert-requirements'    => '0.8',
        'en/industrial-hygiene-officer-guide'         => '0.8',
        'en/heavy-equipment-operator-license-sio'     => '0.85',
        'en/statutory-equipment-inspection-sia'       => '0.85',
        'en/boiler-pressure-vessel-certification'     => '0.8',
        'en/certified-welder-regulations-indonesia'   => '0.8',
        'en/working-at-height-regulations'            => '0.8',
        'en/confined-space-safety-standards'          => '0.8',
        'en/workplace-fire-safety-classification'     => '0.8',
        'en/mining-safety-regulations-smkp'           => '0.85',
        'en/oil-gas-safety-migas-requirements'        => '0.85',
        'en/construction-safety-system-smkk'          => '0.8',
        'en/factory-setup-safety-checklist'           => '0.85',
        'sertifikasi-bnsp'               => '0.8',
        'keselamatan-kerja'              => '0.9',
        'klien'                          => '0.8',
        'instruktur'                     => '0.7',
        'ak3u-fresh-graduate'            => '0.8',
        'ak3u-gratis'                    => '0.7',
        'k3-kimia'                       => '0.85',
        'k3-ketinggian'                  => '0.85',
        'k3-listrik'                     => '0.85',
        'k3-konstruksi'                  => '0.85',
        'k3-pertambangan'                => '0.85',
        'k3-migas'                       => '0.8',
        'smk3'                           => '0.8',
        'k3-lingkungan'                  => '0.8',
        'k3-pesawat-angkat-angkut'       => '0.8',
        'penanggulangan-kebakaran'       => '0.8',
        'p3k'                            => '0.8',
        'k3-pesawat-uap'                 => '0.8',
        'operator-alat-berat'            => '0.8',
        'juru-las'                       => '0.8',
        'higiene-industri'               => '0.8',
        'pelatihan-iso'                  => '0.8',
        'k3-perkantoran'                 => '0.8',
        'selam'                          => '0.8',
        'outbound'                       => '0.8',
        'wisata-karyawan'                => '0.8',
        'k3-rumah-sakit'                 => '0.8',
        'pelatihan-manajemen-sdm'        => '0.8',
        'pelatihan-satpam'               => '0.8',
        'catering'                       => '0.8',
        'pelatihan-kelautan'             => '0.8',
        'k3-laboratorium'                => '0.8',
        'k3-transportasi'                => '0.8',
        'akomodasi'                      => '0.8',
        'pelatihan-keuangan-daerah'      => '0.8',
        'pelatihan-pengadaan-barang-jasa'=> '0.8',
        'k3-manufaktur'                  => '0.8',
        'k3-psikososial'                 => '0.8',
        'k3-pangan'                      => '0.8',
        'pelatihan-teknologi-informasi'  => '0.8',
        'ahli-k3-umum'                   => '0.9',
        'kota'                           => '0.85',
        'in-house-training'              => '0.9',
        'in-house-training/balikpapan-ikn' => '0.85',
        'in-house-training/cilegon-karawang' => '0.85',
        'in-house-training/morowali-weda-bay' => '0.85',
    ];
    foreach ($with_slash as $slug => $pri) {
        if ($slug === 'in-house-training') {
            $file = __DIR__ . '/in-house/index.php';
        } elseif (str_starts_with($slug, 'in-house-training/')) {
            $file = __DIR__ . '/in-house/' . substr($slug, 19) . '.php';
        } else {
            $file = __DIR__ . '/' . $slug . '.php';
        }
        $lm = file_exists($file) ? date('Y-m-d', filemtime($file)) : date('Y-m-d');
        echo sm_url($base . '/' . $slug . '/', $lm, $pri);
    }

    echo '</urlset>' . "\n";
    break;

// ─── PELATIHAN: training catalog + individual program pages ─────────────────
case 'pelatihan':
    echo sm_header();

    // Catalog index
    echo sm_url($base . '/pelatihan/', date('Y-m-d'), '0.9');

    // Category index pages
    foreach (['k3', 'system-management', 'lingkungan', 'mining'] as $cat) {
        echo sm_url($base . '/pelatihan/' . $cat . '/', '', '0.7');
    }

    // Individual training pages
    $trainingsFile = __DIR__ . '/data/trainings.json';
    if (file_exists($trainingsFile)) {
        $rows = json_decode(file_get_contents($trainingsFile), true) ?: [];
        foreach ($rows as $t) {
            if (!($t['is_active'] ?? 1)) continue;
            $lm = !empty($t['updated_at']) ? date('Y-m-d', strtotime($t['updated_at'])) : date('Y-m-d');
            echo sm_url($base . '/pelatihan/' . htmlspecialchars($t['slug']) . '/', $lm, '0.8');
        }
    }

    echo '</urlset>' . "\n";
    break;

// ─── ARTIKEL: article index + individual articles ───────────────────────────
case 'artikel':
    echo sm_header();

    $seenArticles = [];

    // Article index
    echo sm_url($base . '/artikel/', date('Y-m-d'), '0.8');

    // Category index pages
    foreach (['k3', 'system-management', 'lingkungan', 'mining'] as $cat) {
        echo sm_url($base . '/artikel/' . $cat . '/', '', '0.7');
    }

    // Individual articles from JSON
    $articlesFile = __DIR__ . '/data/articles.json';
    if (file_exists($articlesFile)) {
        $rows = json_decode(file_get_contents($articlesFile), true) ?: [];
        foreach ($rows as $a) {
            if (($a['status'] ?? 'published') !== 'published') continue;
            if (isset($seenArticles[$a['slug']])) continue;
            $seenArticles[$a['slug']] = true;
            $lm = !empty($a['updated_at']) ? date('Y-m-d', strtotime($a['updated_at'])) : (!empty($a['published_at']) ? date('Y-m-d', strtotime($a['published_at'])) : date('Y-m-d'));
            echo sm_url($base . '/artikel/' . htmlspecialchars($a['slug']) . '/', $lm, '0.7');
        }
    }

    echo '</urlset>' . "\n";
    break;

// ─── KOTA: city landing pages ───────────────────────────────────────────────
case 'kota':
    echo sm_header();

    $citiesFile = __DIR__ . '/data/cities.json';
    if (file_exists($citiesFile)) {
        $rows = json_decode(file_get_contents($citiesFile), true) ?: [];
        foreach ($rows as $c) {
            $lm = !empty($c['updated_at']) ? date('Y-m-d', strtotime($c['updated_at'])) : date('Y-m-d');
            echo sm_url($base . '/pelatihan-k3-' . htmlspecialchars($c['slug']) . '/', $lm, '0.7');
        }
    }

    echo '</urlset>' . "\n";
    break;

// ─── KOTA-PELATIHAN: static /pelatihan/{slug}/ city×program pages ──────────
case 'kota-pelatihan':
    echo sm_header();

    $jsonFiles = glob(__DIR__ . '/pelatihan-data/*.json');
    foreach ($jsonFiles as $f) {
        $slug = basename($f, '.json');
        $lm   = date('Y-m-d', filemtime($f));
        echo sm_url($base . '/pelatihan/' . htmlspecialchars($slug) . '/', $lm, '0.7');
    }

    echo '</urlset>' . "\n";
    break;

// ─── PLATFORM: forum, resources, incidents, jobs, tools, etc. ───────────────
case 'platform':
    echo sm_header();

    // ── Static platform index pages (all use trailing-slash canonical) ──
    $platform_indexes = [
        '/resources/'   => '0.8',
        '/insiden/'     => '0.8',
        '/lowongan/'    => '0.7',
        '/tools/'       => '0.5',
        '/verifikasi/'  => '0.4',
    ];
    foreach ($platform_indexes as $path => $pri) {
        echo sm_url($base . $path, '', $pri);
    }

    // ── Tools sub-pages (individual tools) ──
    // Canonical patterns vary: most no-slash, two with slash
    $tools_with_slash = ['ai-analyzer' => '0.6', 'social-generator' => '0.6'];
    $tools_no_slash = [
        'kalkulator-k3'        => '0.7',
        'risk-matrix'          => '0.7',
        'jsa-builder'          => '0.7',
        'ibpr-generator'       => '0.7',
        'safety-talk'          => '0.6',
        'apd-selector'         => '0.6',
        'kalkulator-biaya-k3'  => '0.6',
        'kalkulator-kebisingan'=> '0.6',
        'laporan-insiden'      => '0.6',
        'regulasi-k3'          => '0.6',
    ];
    foreach ($tools_with_slash as $slug => $pri) {
        $file = __DIR__ . '/tools/' . $slug . '.php';
        $lm = file_exists($file) ? date('Y-m-d', filemtime($file)) : '';
        echo sm_url($base . '/tools/' . $slug . '/', $lm, $pri);
    }
    foreach ($tools_no_slash as $slug => $pri) {
        $file = __DIR__ . '/tools/' . $slug . '.php';
        $lm = file_exists($file) ? date('Y-m-d', filemtime($file)) : '';
        echo sm_url($base . '/tools/' . $slug, $lm, $pri);
    }

    // ── Resources (DB) ──
    try {
        $rows = $pdo->query(
            "SELECT slug, updated_at FROM resources WHERE is_active=1 ORDER BY updated_at DESC"
        )->fetchAll();
        foreach ($rows as $r) {
            $lm = !empty($r['updated_at']) ? date('Y-m-d', strtotime($r['updated_at'])) : '';
            echo sm_url($base . '/resources/' . htmlspecialchars($r['slug']) . '/', $lm, '0.6');
        }
    } catch (Exception) {}

    // ── Incidents (DB) ──
    try {
        $rows = $pdo->query(
            "SELECT slug, updated_at FROM incidents WHERE is_published=1 ORDER BY incident_date DESC"
        )->fetchAll();
        foreach ($rows as $i) {
            $lm = !empty($i['updated_at']) ? date('Y-m-d', strtotime($i['updated_at'])) : '';
            echo sm_url($base . '/insiden/' . htmlspecialchars($i['slug']) . '/', $lm, '0.6');
        }
    } catch (Exception) {}

    // ── Job listings (DB — only active, non-expired) ──
    try {
        $rows = $pdo->query(
            "SELECT slug, updated_at FROM jobs WHERE is_active=1 AND expires_at > NOW() ORDER BY posted_at DESC"
        )->fetchAll();
        foreach ($rows as $j) {
            $lm = !empty($j['updated_at']) ? date('Y-m-d', strtotime($j['updated_at'])) : '';
            echo sm_url($base . '/lowongan/' . htmlspecialchars($j['slug']) . '/', $lm, '0.6');
        }
    } catch (Exception) {}

    echo '</urlset>' . "\n";
    break;

// ─── JADWAL: public schedule hubs + genuine upcoming batch pages ────────────
case 'jadwal':
    echo sm_header();

    $jadwalFile = __DIR__ . '/jadwal-pelatihan.php';
    $kalenderFile = __DIR__ . '/jadwal/kalender.php';
    echo sm_url($base . '/jadwal/', file_exists($jadwalFile) ? date('Y-m-d', filemtime($jadwalFile)) : date('Y-m-d'), '0.9');
    echo sm_url($base . '/jadwal/kalender/', file_exists($kalenderFile) ? date('Y-m-d', filemtime($kalenderFile)) : date('Y-m-d'), '0.7');

    $batchesFile = __DIR__ . '/data/training_batches.json';
    if (file_exists($batchesFile)) {
        $batches = json_decode(file_get_contents($batchesFile), true) ?: [];
        $curDate = date('Y-m-d');
        foreach ($batches as $batchRow) {
            if (!($batchRow['is_public'] ?? 1)) continue;
            if (!in_array($batchRow['status'] ?? '', ['planned', 'ongoing'])) continue;
            if (($batchRow['start_date'] ?? '') < $curDate) continue;
            $lm = !empty($batchRow['updated_at']) ? date('Y-m-d', strtotime($batchRow['updated_at'])) : date('Y-m-d');
            echo sm_url($base . '/jadwal/' . (int)$batchRow['id'] . '/', $lm, '0.7');
        }
    }

    echo '</urlset>' . "\n";
    break;

// ─── GLOSARIUM: glossary index + individual terms ───────────────────────────
case 'glosarium':
    echo sm_header();

    // Glossary index
    echo sm_url($base . '/glosarium/', '', '0.4');

    $glossaryFile = __DIR__ . '/data/glossary.json';
    if (file_exists($glossaryFile)) {
        $rows = json_decode(file_get_contents($glossaryFile), true) ?: [];
        foreach ($rows as $g) {
            if (!($g['is_active'] ?? 1)) continue;
            if (empty($g['definition']) || mb_strlen($g['definition']) < 50) continue;
            $lm = !empty($g['updated_at']) ? date('Y-m-d', strtotime($g['updated_at'])) : date('Y-m-d');
            echo sm_url($base . '/glosarium/' . htmlspecialchars($g['slug']) . '/', $lm, '0.4');
        }
    }

    echo '</urlset>' . "\n";
    break;

// ─── REGULASI: regulation hub + individual decrees ──────────────────────────
case 'regulasi':
    echo sm_header();

    // Hub index
    echo sm_url($base . '/regulasi/', date('Y-m-d'), '0.8');

    // Individual regulations
    require_once __DIR__ . '/includes/regulasi-data.php';
    $regulasiData = get_regulasi_dataset();
    foreach ($regulasiData as $item) {
        echo sm_url($base . '/regulasi/' . htmlspecialchars($item['slug']) . '/', date('Y-m-d'), '0.7');
    }

    echo '</urlset>' . "\n";
    break;

// ─── SKKNI: competency standards hub + individual professions ──────────────
case 'skkni':
    echo sm_header();

    // Hub index
    echo sm_url($base . '/skkni/', date('Y-m-d'), '0.8');

    // Individual professions
    require_once __DIR__ . '/includes/skkni-functions.php';
    $skkniData = get_all_skkni_items();
    foreach ($skkniData as $item) {
        $lm = date('Y-m-d');
        echo sm_url($base . '/skkni/' . htmlspecialchars($item['slug']) . '/', $lm, '0.7');
    }

    echo '</urlset>' . "\n";
    break;

// ─── RIKSA-UJI: statutory safety inspection hub + equipment service pages ───
case 'riksa-uji':
    echo sm_header();

    // Hub index
    echo sm_url($base . '/riksa-uji/', date('Y-m-d'), '0.9');

    // Individual equipment inspection pages
    require_once __DIR__ . '/includes/riksa-uji-data.php';
    $riksaData = get_all_riksa_uji_items();
    foreach ($riksaData as $item) {
        $lm = date('Y-m-d');
        echo sm_url($base . '/riksa-uji/' . htmlspecialchars($item['slug']) . '/', $lm, '0.8');
    }

    echo '</urlset>' . "\n";
    break;

// ─── PERPANJANGAN-SKP: renewal hub + individual license renewal pages ────────
case 'perpanjangan-skp':
    echo sm_header();

    // Hub index
    echo sm_url($base . '/perpanjangan-skp/', date('Y-m-d'), '0.9');

    // Individual renewal pages
    require_once __DIR__ . '/includes/perpanjangan-skp-data.php';
    $skpData = get_all_perpanjangan_skp_items();
    foreach ($skpData as $item) {
        $lm = date('Y-m-d');
        echo sm_url($base . '/perpanjangan-skp/' . htmlspecialchars($item['slug']) . '/', $lm, '0.8');
    }

    echo '</urlset>' . "\n";
    break;

// ─── PURNABAKTI: retirement preparation hub + individual service/syllabus pages ───
case 'purnabakti':
    echo sm_header();

    // Hub index
    echo sm_url($base . '/purnabakti/', date('Y-m-d'), '0.9');

    // Individual purnabakti program pages
    require_once __DIR__ . '/includes/purnabakti-data.php';
    $purnaData = get_all_purnabakti_items();
    foreach ($purnaData as $item) {
        $lm = date('Y-m-d');
        echo sm_url($base . '/purnabakti/' . htmlspecialchars($item['slug']) . '/', $lm, '0.8');
    }

    echo '</urlset>' . "\n";
    break;

// ─── EVENT ORGANIZER: B2B/B2G MICE & HSE Statutory Event Hub + 24 program pages ───
case 'event':
    echo sm_header();

    // Hub index
    echo sm_url($base . '/event-organizer/', date('Y-m-d'), '0.9');

    // 24 Individual event programs
    require_once __DIR__ . '/includes/event-data.php';
    $eventData = get_all_event_items();
    foreach ($eventData as $item) {
        $lm = date('Y-m-d');
        echo sm_url($base . '/event-organizer/' . htmlspecialchars($item['slug']) . '/', $lm, '0.8');
    }

    echo '</urlset>' . "\n";
    break;

// ─── Unknown type → 404 ────────────────────────────────────────────────────
default:
    http_response_code(404);
    echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>' . "\n";
}
