<?php
/**
 * cron/enrich-city-pages.php
 * Makes the kept /pelatihan/{program}-{city}.html pages UNIQUE.
 *
 * The problem: those pages were ~82% identical city-to-city (thin doorway).
 * This injects a genuinely local, AI-written section (local industries, why
 * K3 certification matters there, local demand) into each page — so Google
 * sees real, differentiated content instead of duplicates.
 *
 * Uses the SAME Gemini setup as write-article.php (get_claude()).
 * Idempotent: skips pages already enriched (marker <!-- WT-LOCAL v1 -->).
 * Run repeatedly until all done — each run processes MAX_PER_RUN pages.
 *
 *   CLI : php .../cron/enrich-city-pages.php
 *   Web : https://wahanatotalita.com/cron/enrich-city-pages.php?key=wahana2026ping
 */
if (PHP_SAPI !== 'cli' && (($_GET['key'] ?? '') !== 'wahana2026ping')) {
    http_response_code(403); exit('Forbidden');
}
set_time_limit(0);
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/ai-functions.php';
header('Content-Type: text/plain; charset=utf-8');

const MARKER       = '<!-- WT-LOCAL v1 -->';
const MAX_PER_RUN  = 30;                 // keep each run under the ~60s web limit
const SLEEP_MS     = 400;                // gentle pacing for Gemini rate limits

// Kept cities -> readable name (must match curate-pelatihan.php whitelist).
$CITY_NAMES = [
    'yogyakarta'=>'Yogyakarta','sleman'=>'Sleman','bantul'=>'Bantul','semarang'=>'Semarang',
    'solo'=>'Solo','surabaya'=>'Surabaya','bandung'=>'Bandung','bekasi'=>'Bekasi',
    'balikpapan'=>'Balikpapan','cilegon'=>'Cilegon','batam'=>'Batam',
];

$dir = ($_SERVER['DOCUMENT_ROOT'] ?? realpath(__DIR__.'/..')) . '/pelatihan';
$ai  = get_claude();
if (!$ai) { exit("No AI key configured (gemini_api_key empty)\n"); }

$files = glob($dir . '/*.html');
$done = 0; $skipped = 0; $failed = 0;

foreach ($files as $file) {
    if ($done >= MAX_PER_RUN) break;
    $slug = basename($file, '.html');

    // identify city (trailing match) + program
    $city = null; $cityName = null;
    foreach ($CITY_NAMES as $cslug => $cname) {
        if (str_ends_with($slug, '-' . $cslug)) { $city = $cslug; $cityName = $cname; break; }
    }
    if (!$city) { continue; }                      // not a kept city page
    $programSlug = substr($slug, 0, -(strlen($city) + 1));
    $programName = ucwords(str_replace('-', ' ', $programSlug));
    $programName = preg_replace('/\bK3\b/i', 'K3', $programName);

    $html = file_get_contents($file);
    if ($html === false || str_contains($html, MARKER)) { $skipped++; continue; }

    // anchor: the Kurikulum section ("Materi Pelatihan")
    $anchorPos = strpos($html, '<div class="sl">Kurikulum</div>');
    if ($anchorPos === false) { $skipped++; continue; }
    $secPos = strrpos(substr($html, 0, $anchorPos), '<section');
    if ($secPos === false) { $skipped++; continue; }

    // ── generate unique local content ───────────────────────────────────────
    $system = 'Kamu penulis konten K3 untuk Wahana Totalita Konsultan (pelatihan K3 bersertifikasi Kemnaker RI & BNSP). Tulis bahasa Indonesia, faktual, spesifik lokal. JANGAN mengarang statistik, jumlah, atau harga.';
    $prompt = "Tulis konten HTML unik tentang pelatihan \"{$programName}\" khusus untuk kota/wilayah {$cityName}, Indonesia.\n"
        . "Ketentuan:\n"
        . "- 180-230 kata.\n"
        . "- HANYA gunakan <p>, <ul>, <li>, <strong>. JANGAN gunakan <h1>-<h3>, <html>, <head>, <body>.\n"
        . "- Bahas: industri/sektor dominan di {$cityName} yang relevan dengan {$programName}, mengapa sertifikasi K3 ini penting bagi pekerja/perusahaan di {$cityName}, dan siapa yang biasanya membutuhkannya.\n"
        . "- Spesifik untuk {$cityName} (sebut karakter ekonomi/industri kota), bukan kalimat umum yang bisa dipakai kota lain.\n"
        . "- Jangan sebut angka statistik atau harga yang tidak pasti.\n"
        . "Jawab HANYA dengan potongan HTML (tanpa pembungkus markdown).";

    $res = $ai->message($prompt, $system, 'gemini-2.5-flash-lite', 1024, false);
    if (!$res['success'] || strlen(trim($res['text'])) < 200) {
        usleep(SLEEP_MS * 1000);
        $res = $ai->message($prompt, $system, 'gemini-2.5-flash', 1024, false);
    }
    if (!$res['success']) { $failed++; echo "FAIL {$slug}: {$res['error']}\n"; continue; }

    $body = trim($res['text']);
    $body = preg_replace('/^```(html)?|```$/m', '', $body);     // strip fences if any
    $body = trim($body);

    $block = "\n" . MARKER . "\n"
        . '<section class="sec sec-alt">' . "\n"
        . '  <div class="sl">Konteks Lokal</div>' . "\n"
        . "  <h2>Pelatihan {$programName} di {$cityName}</h2>\n"
        . "  <div class=\"local-content\">{$body}</div>\n"
        . "</section>\n";

    $newHtml = substr($html, 0, $secPos) . $block . substr($html, $secPos);
    if (file_put_contents($file, $newHtml) !== false) {
        $done++;
        echo "OK   {$slug}  (+{$res['tokens']} tok)\n";
    } else {
        $failed++; echo "WRITE-FAIL {$slug}\n";
    }
    usleep(SLEEP_MS * 1000);
}

$remaining = 0;
foreach (glob($dir.'/*.html') as $f) {
    $s = basename($f,'.html');
    foreach ($CITY_NAMES as $cs=>$cn) { if (str_ends_with($s,'-'.$cs)) { $h=@file_get_contents($f); if($h!==false && !str_contains($h,MARKER)) $remaining++; break; } }
}
echo "\n=== enrich run done ===\n";
echo "enriched this run : {$done}\n";
echo "skipped (already) : {$skipped}\n";
echo "failed            : {$failed}\n";
echo "still remaining   : {$remaining}\n";
echo $remaining > 0 ? "Run again to continue.\n" : "ALL kept pages enriched. Re-submit sitemap in Search Console.\n";
