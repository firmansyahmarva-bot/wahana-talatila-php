<?php
/**
 * tools/audit-titles.php
 * Accurate & Deep SEO Title Auditor for Wahana Totalita
 */

$rootDir = realpath(__DIR__ . '/..');

echo "========================================================\n";
echo "   WAHANA TOTALITA — DEEP SEO TITLE & ARCHITECTURE AUDITOR\n";
echo "========================================================\n\n";

$pages = [];
$doubleTitleFiles = [];
$fallbackHeadFiles = [];

// ─── 1. Scan All Public PHP & HTML Files ─────────────────────────────────────
$excludeDirs = ['vendor', 'nextjs-workspace', 'nextjs-clean', 'admin', '.git', 'mailer', 'cron', 'tests', 'cache'];

$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootDir, RecursiveDirectoryIterator::SKIP_DOTS)
);

foreach ($iterator as $file) {
    if (!$file->isFile()) continue;
    $ext = strtolower($file->getExtension());
    if ($ext !== 'php' && $ext !== 'html') continue;

    $path = $file->getPathname();
    $relPath = str_replace('\\', '/', substr($path, strlen($rootDir) + 1));

    $skip = false;
    foreach ($excludeDirs as $ex) {
        if (str_starts_with($relPath, $ex . '/') || $relPath === $ex) {
            $skip = true;
            break;
        }
    }
    if ($skip) continue;

    if (preg_match('#^(api/|cron/|scripts/|generate-|test_|secrets|setup\.php|includes/|test-)#i', $relPath)) {
        continue;
    }
    // Skip this audit script itself
    if ($relPath === 'tools/audit-titles.php') continue;

    $content = file_get_contents($path);

    // Check if file has double <head> / double <title>
    $titleTagMatches = [];
    preg_match_all('~<title>(.*?)</title>~is', $content, $titleTagMatches);
    $titleTagCount = count($titleTagMatches[0]);

    $hasHeadInclude = (bool)preg_match('#(?:include|require)(?:_once)?\s*[\'"][^\'"]*includes/head\.php[\'"]#i', $content);
    if ($titleTagCount > 0 && $hasHeadInclude && !str_contains($content, 'ob_start()')) {
        $doubleTitleFiles[] = $relPath;
    }

    $title = '';
    $method = '';

    // Check hub data
    if (preg_match('/\$hub_data\s*=\s*\[.*?\'meta_title\'\s*=>\s*[\'"]([^\'"]+)[\'"]/s', $content, $m)) {
        $title = $m[1];
        $method = '$hub_data[meta_title]';
    } elseif (preg_match('/\$hub_data\s*=\s*\[.*?\'title\'\s*=>\s*[\'"]([^\'"]+)[\'"]/s', $content, $m)) {
        $title = $m[1] . ' — Wahana Totalita';
        $method = '$hub_data[title] fallback';
    }
    // Check explicit $page_title
    elseif (preg_match('/\$page_title\s*=\s*[\'"]([^\'"]+)[\'"]/i', $content, $m)) {
        $title = $m[1];
        $method = '$page_title';
    }
    // Check explicit $meta_title or $metaTitle
    elseif (preg_match('/\$meta_?title\s*=\s*[\'"]([^\'"]+)[\'"]/i', $content, $m)) {
        $title = $m[1];
        $method = '$meta_title';
    }
    // Check direct static <title> (filtering out regex strings)
    elseif (!empty($titleTagMatches[1])) {
        foreach ($titleTagMatches[1] as $raw) {
            $raw = trim($raw);
            if ($raw === '.*?' || str_contains($raw, '$page_title') || str_contains($raw, '$metaTitle')) {
                continue;
            }
            $title = strip_tags($raw);
            $method = 'static <title>';
            break;
        }
    }

    // Check if page relies on head.php without setting $page_title
    if (!$title && $hasHeadInclude) {
        $title = 'Wahana Totalita Konsultan - Pelatihan K3 & Sertifikasi BNSP';
        $method = 'unbound head.php fallback';
        $fallbackHeadFiles[] = $relPath;
    }

    if ($title) {
        $pages[] = [
            'type'   => str_ends_with($relPath, '.html') ? 'Static HTML' : 'PHP Page',
            'file'   => $relPath,
            'title'  => $title,
            'method' => $method,
        ];
    }
}

// ─── 2. Add City Pages from kota.php ──────────────────────────────────────────
$kotaFile = $rootDir . '/kota.php';
if (file_exists($kotaFile)) {
    $kotaContent = file_get_contents($kotaFile);
    if (preg_match_all('/\'([a-z0-9\-]+)\'\s*=>\s*\[\s*\'name\'\s*=>\s*\'([^\']+)\'.*?\'title\'\s*=>\s*\'([^\']+)\'/s', $kotaContent, $matches, PREG_SET_ORDER)) {
        foreach ($matches as $match) {
            $pages[] = [
                'type'   => 'City Page (/pelatihan-k3-' . $match[1] . '/)',
                'file'   => 'kota.php [' . $match[1] . ']',
                'title'  => $match[3],
                'method' => 'kota.php array',
            ];
        }
    }
}

// ─── 3. Audit & Categorize ───────────────────────────────────────────────────
$total = count($pages);
$titleMap = [];
$tooLong = [];
$tooShort = [];
$hasBrandSuffix = [];
$brokenEncoding = [];

foreach ($pages as $p) {
    $cleanTitle = trim($p['title']);
    $len = mb_strlen($cleanTitle, 'UTF-8');

    $norm = mb_strtolower($cleanTitle, 'UTF-8');
    if (!isset($titleMap[$norm])) {
        $titleMap[$norm] = [];
    }
    $titleMap[$norm][] = $p;

    if ($len > 60) {
        $tooLong[] = array_merge($p, ['len' => $len]);
    } elseif ($len < 30) {
        $tooShort[] = array_merge($p, ['len' => $len]);
    }

    if (preg_match('/(\s*[-|–—]\s*Wahana Totalita.*|\s*\|\s*WTK|\s*–\s*Wahana\s*Totalita.*)$/iu', $cleanTitle)) {
        $hasBrandSuffix[] = array_merge($p, ['len' => $len]);
    }

    if (preg_match('/(\?\"|\?\'||\?\s*Wahana)/u', $cleanTitle)) {
        $brokenEncoding[] = $p;
    }
}

$duplicates = [];
foreach ($titleMap as $norm => $group) {
    if (count($group) > 1) {
        $duplicates[] = [
            'title' => $group[0]['title'],
            'count' => count($group),
            'pages' => $group,
        ];
    }
}

// ─── 4. Report ───────────────────────────────────────────────────────────────
echo "Total Evaluated Pages     : {$total}\n";
echo "Unique Titles Found       : " . count($titleMap) . "\n";
echo "Exact Duplicate Titles    : " . count($duplicates) . " title groups (" . array_sum(array_map(fn($d) => $d['count'], $duplicates)) . " pages affected)\n";
echo "Titles > 60 Chars (Long)  : " . count($tooLong) . " pages (SERP cutoff risk)\n";
echo "Titles < 30 Chars (Short) : " . count($tooShort) . " pages (Thin SEO intent)\n";
echo "Brand Suffix Attached     : " . count($hasBrandSuffix) . " pages (ending with Wahana Totalita)\n";
echo "Broken UTF-8 Characters   : " . count($brokenEncoding) . " pages\n";
echo "Critical Double <title>   : " . count($doubleTitleFiles) . " files\n\n";

if (!empty($doubleTitleFiles)) {
    echo "────────────────────────────────────────────────────────\n";
    echo "🚨 CRITICAL ARCHITECTURE BUG: DOUBLE <title> & DOUBLE <head>\n";
    echo "   (Files output their own <title> then include head.php)\n";
    echo "────────────────────────────────────────────────────────\n";
    foreach ($doubleTitleFiles as $f) {
        echo "  ❌ $f\n";
    }
    echo "\n";
}

if (!empty($duplicates)) {
    echo "────────────────────────────────────────────────────────\n";
    echo "🔴 TOP DUPLICATE TITLE GROUPS (Keyword Cannibalization):\n";
    echo "────────────────────────────────────────────────────────\n";
    usort($duplicates, fn($a, $b) => $b['count'] <=> $a['count']);
    foreach (array_slice($duplicates, 0, 8) as $i => $d) {
        echo "[" . ($i + 1) . "] Title: \"{$d['title']}\"\n";
        echo "    Duplicates: {$d['count']} pages\n";
        echo "    Files:\n";
        foreach (array_slice($d['pages'], 0, 3) as $item) {
            echo "      - {$item['file']}\n";
        }
        if ($d['count'] > 3) {
            echo "      ... and " . ($d['count'] - 3) . " more\n";
        }
        echo "\n";
    }
}

echo "────────────────────────────────────────────────────────\n";
echo "⚠️ TOP OVER-SIZED TITLES (> 90 Chars):\n";
echo "────────────────────────────────────────────────────────\n";
usort($tooLong, fn($a, $b) => $b['len'] <=> $a['len']);
foreach (array_slice($tooLong, 0, 6) as $item) {
    echo "• [{$item['len']} chars] {$item['file']}\n";
    echo "  \"{$item['title']}\"\n\n";
}

// ─── 5. Export CSV ───────────────────────────────────────────────────────────
$csvPath = __DIR__ . '/title-audit.csv';
$fp = fopen($csvPath, 'w');
fprintf($fp, chr(0xEF).chr(0xBB).chr(0xBF));
fputcsv($fp, ['Type', 'File / Route', 'Current Title', 'Char Length', 'SERP Status', 'Is Duplicate', 'Has Brand Suffix', 'Suggested Title (Clean & <= 58 chars)']);

foreach ($pages as $p) {
    $title = $p['title'];
    $len = mb_strlen($title, 'UTF-8');
    $norm = mb_strtolower(trim($title), 'UTF-8');
    $isDup = count($titleMap[$norm]) > 1 ? 'YES (' . count($titleMap[$norm]) . ' pages)' : 'NO';
    $hasSuffix = preg_match('/(\s*[-|–—]\s*Wahana Totalita.*|\s*\|\s*WTK)$/iu', $title) ? 'YES' : 'NO';

    $status = 'OK';
    if ($len > 60) $status = 'TOO LONG (>60)';
    elseif ($len < 30) $status = 'TOO SHORT (<30)';

    // Build suggested title
    $clean = preg_replace('/\s*[-|–—]\s*Wahana Totalita.*$/iu', '', trim($title));
    $clean = preg_replace('/[\?"]{1,3}\s*Wahana.*$/u', '', $clean);
    $clean = trim($clean, " -|–—");
    
    $suggested = $clean;
    if (mb_strlen($suggested . ' | Wahana Totalita') <= 58) {
        $suggested .= ' | Wahana Totalita';
    }

    fputcsv($fp, [
        $p['type'],
        $p['file'],
        $title,
        $len,
        $status,
        $isDup,
        $hasSuffix,
        $suggested
    ]);
}
fclose($fp);

echo "========================================================\n";
echo "✅ Exported clean audit to: tools/title-audit.csv\n";
echo "========================================================\n";
