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
    foreach (['core','pelatihan','artikel','kota','kota-pelatihan','platform','jadwal','glosarium'] as $child) {
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

$pdo = get_pdo();

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
        'event-organizer'                => '0.8',
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
    ];
    foreach ($with_slash as $slug => $pri) {
        $file = __DIR__ . '/' . $slug . '.php';
        $lm = file_exists($file) ? date('Y-m-d', filemtime($file)) : '';
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

    // Individual training pages from DB
    try {
        $rows = $pdo->query(
            "SELECT slug, updated_at FROM trainings WHERE is_active=1 ORDER BY sort_order ASC"
        )->fetchAll();
        foreach ($rows as $t) {
            $lm = $t['updated_at'] ? date('Y-m-d', strtotime($t['updated_at'])) : '';
            echo sm_url($base . '/pelatihan/' . htmlspecialchars($t['slug']) . '/', $lm, '0.8');
        }
    } catch (Exception) {}

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

    // Standalone editorial articles using static HTML or the shared PHP layout.
    // These pages do not live in the articles table, so discover them here.
    $standaloneArticles = array_merge(
        glob(__DIR__ . '/artikel/*/index.html') ?: [],
        glob(__DIR__ . '/artikel/*/index.php') ?: []
    );
    foreach ($standaloneArticles as $file) {
        $slug = basename(dirname($file));
        if (isset($seenArticles[$slug])) continue;
        $seenArticles[$slug] = true;
        echo sm_url(
            $base . '/artikel/' . htmlspecialchars($slug) . '/',
            date('Y-m-d', filemtime($file)),
            '0.7'
        );
    }

    // Individual articles from DB
    try {
        $rows = $pdo->query(
            "SELECT slug, updated_at FROM articles WHERE status='published' ORDER BY published_at DESC"
        )->fetchAll();
        foreach ($rows as $a) {
            if (isset($seenArticles[$a['slug']])) continue;
            $lm = $a['updated_at'] ? date('Y-m-d', strtotime($a['updated_at'])) : '';
            echo sm_url($base . '/artikel/' . htmlspecialchars($a['slug']) . '/', $lm, '0.7');
        }
    } catch (Exception) {}

    echo '</urlset>' . "\n";
    break;

// ─── KOTA: city landing pages ───────────────────────────────────────────────
case 'kota':
    echo sm_header();

    // Pull from DB cities table (same source as cron/sitemap-rebuild.php)
    try {
        $rows = $pdo->query("SELECT slug, updated_at FROM cities ORDER BY slug ASC")->fetchAll();
        foreach ($rows as $c) {
            $lm = !empty($c['updated_at']) ? date('Y-m-d', strtotime($c['updated_at'])) : '';
            echo sm_url($base . '/pelatihan-k3-' . htmlspecialchars($c['slug']) . '/', $lm, '0.7');
        }
    } catch (Exception) {
        // Fallback: if cities table doesn't exist yet, use the kota.php hardcoded array
        $kotaSlugs = [
            'jakarta','surabaya','bandung','medan','makassar','semarang','batam',
            'pekanbaru','balikpapan','yogyakarta','palembang','bekasi','cilegon',
            'samarinda','denpasar','malang','solo','karawang','tangerang','bogor',
        ];
        foreach ($kotaSlugs as $slug) {
            echo sm_url($base . '/pelatihan-k3-' . $slug . '/', '', '0.7');
        }
    }

    echo '</urlset>' . "\n";
    break;

// ─── KOTA-PELATIHAN: static /pelatihan/{slug}/ city×program pages ──────────
case 'kota-pelatihan':
    echo sm_header();

    $htmlFiles = glob(__DIR__ . '/pelatihan/*.html');
    foreach ($htmlFiles as $f) {
        $slug = basename($f, '.html');
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
        '/forum/'       => '0.8',
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

    // ── Forum categories (DB) ──
    try {
        $rows = $pdo->query(
            "SELECT slug FROM forum_categories WHERE is_active=1"
        )->fetchAll();
        foreach ($rows as $c) {
            echo sm_url($base . '/forum/' . htmlspecialchars($c['slug']) . '/', '', '0.6');
        }
    } catch (Exception) {}

    // ── Forum topics (DB) ──
    try {
        $rows = $pdo->query(
            "SELECT slug, updated_at FROM forum_topics WHERE status='approved' ORDER BY updated_at DESC"
        )->fetchAll();
        foreach ($rows as $t) {
            $lm = !empty($t['updated_at']) ? date('Y-m-d', strtotime($t['updated_at'])) : '';
            echo sm_url($base . '/forum/topik/' . htmlspecialchars($t['slug']) . '/', $lm, '0.5');
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

    echo sm_url($base . '/jadwal/', date('Y-m-d', filemtime(__DIR__ . '/jadwal-pelatihan.php')), '0.9');
    echo sm_url($base . '/jadwal/kalender/', date('Y-m-d', filemtime(__DIR__ . '/jadwal/kalender.php')), '0.7');

    // Only index pages a visitor can currently open. Registration forms are
    // intentionally excluded because they are conversion/noindex pages.
    try {
        $batchRows = $pdo->query(
            "SELECT id, COALESCE(updated_at, created_at) AS last_changed
             FROM training_batches
             WHERE is_public=1
               AND status IN ('planned','ongoing')
               AND start_date>=CURDATE()
             ORDER BY start_date ASC
             LIMIT 500"
        )->fetchAll();
        foreach ($batchRows as $batchRow) {
            $lm = !empty($batchRow['last_changed'])
                ? date('Y-m-d', strtotime($batchRow['last_changed']))
                : '';
            echo sm_url($base . '/jadwal/' . (int)$batchRow['id'] . '/', $lm, '0.7');
        }
    } catch (Throwable $e) {
        error_log('[sitemap-jadwal] ' . $e->getMessage());
    }

    echo '</urlset>' . "\n";
    break;

// ─── GLOSARIUM: glossary index + individual terms ───────────────────────────
case 'glosarium':
    echo sm_header();

    // Glossary index
    echo sm_url($base . '/glosarium/', '', '0.4');

    // Individual terms from DB — only include if glossary has real content
    try {
        $rows = $pdo->query(
            "SELECT slug, updated_at, definition FROM glossary WHERE is_active=1 ORDER BY term ASC"
        )->fetchAll();
        foreach ($rows as $g) {
            if (empty($g['definition']) || mb_strlen($g['definition']) < 50) continue;
            $lm = !empty($g['updated_at']) ? date('Y-m-d', strtotime($g['updated_at'])) : '';
            echo sm_url($base . '/glosarium/' . htmlspecialchars($g['slug']) . '/', $lm, '0.4');
        }
    } catch (Exception) {}

    echo '</urlset>' . "\n";
    break;

// ─── Unknown type → 404 ────────────────────────────────────────────────────
default:
    http_response_code(404);
    echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>' . "\n";
}
