<?php
/**
 * IndexNow Pinger — call this after uploading new/updated pages
 * Usage: visit https://wahanatotalita.com/indexnow-ping.php?key=YOUR_ADMIN_KEY
 * Or run via cron/manually after any content update
 */
// Auth: accept either the manual ping key OR the cron secret (for automation).
$admin_key = $_GET['key'] ?? '';
$cron_ok   = isset($_GET['cron_key']) && getenv('CRON_SECRET') && $_GET['cron_key'] === getenv('CRON_SECRET');
if ($admin_key !== 'wahana2026ping' && !$cron_ok) {
    http_response_code(403);
    exit('Forbidden');
}

require_once __DIR__ . '/config.php';

$indexnow_key = 'wahana2026indexnow';
$host         = 'wahanatotalita.com';
$base         = "https://{$host}";

// ── Static high-priority pages ─────────────────────────────────────────────
$urls = [
  "{$base}/",
  "{$base}/layanan-pemerintah",
  "{$base}/perpanjangan-skp",
  "{$base}/csms",
  "{$base}/jadwal-pelatihan",
  "{$base}/artikel/",
  "{$base}/glosarium/",
  "{$base}/regulasi/",
  "{$base}/skkni/",
  "{$base}/tools/",
  "{$base}/lp/k3-migas", "{$base}/lp/k3-pertambangan", "{$base}/lp/k3-konstruksi",
  "{$base}/lp/k3-umum", "{$base}/lp/k3-lingkungan",
];

// ── Regulasi Hub pages ───────────────────────────────────────────────────────
if (file_exists(__DIR__ . '/includes/regulasi-data.php')) {
    require_once __DIR__ . '/includes/regulasi-data.php';
    if (function_exists('get_regulasi_dataset')) {
        foreach (array_keys(get_regulasi_dataset()) as $r_slug) {
            $urls[] = "{$base}/regulasi/{$r_slug}/";
        }
    }
}

// ── SKKNI Hub pages ──────────────────────────────────────────────────────────
$skkni_files = glob(__DIR__ . '/data/skkni/*.php');
if (!empty($skkni_files)) {
    foreach ($skkni_files as $f) {
        $urls[] = "{$base}/skkni/" . basename($f, '.php') . "/";
    }
}

// ── Dynamic pages from JSON files (always current) ───────────────────────
$trFile = __DIR__ . '/data/trainings.json';
if (file_exists($trFile)) {
    foreach (json_decode(file_get_contents($trFile), true) ?: [] as $r) {
        if (!($r['is_active'] ?? 1)) continue;
        if (!empty($r['slug'])) $urls[] = "{$base}/pelatihan/" . $r['slug'] . "/";
    }
}
$glFile = __DIR__ . '/data/glossary.json';
if (file_exists($glFile)) {
    foreach (json_decode(file_get_contents($glFile), true) ?: [] as $r) {
        if (!($r['is_active'] ?? 1)) continue;
        if (!empty($r['slug'])) $urls[] = "{$base}/glosarium/" . $r['slug'] . "/";
    }
}
$arFile = __DIR__ . '/data/articles.json';
if (file_exists($arFile)) {
    foreach (json_decode(file_get_contents($arFile), true) ?: [] as $r) {
        if (($r['status'] ?? 'published') !== 'published') continue;
        if (!empty($r['slug'])) $urls[] = "{$base}/artikel/" . $r['slug'] . "/";
    }
}

$urls = array_values(array_unique($urls));

$payload = json_encode([
  'host'        => $host,
  'key'         => $indexnow_key,
  'keyLocation' => "https://{$host}/{$indexnow_key}.txt",
  'urlList'     => $urls,
]);

$endpoints = [
  'IndexNow Central' => 'https://api.indexnow.org/indexnow',
  'Bing IndexNow'    => 'https://www.bing.com/indexnow',
];

header('Content-Type: text/plain');
echo "IndexNow & Bing URL submission initiated.\n";
echo "Total unique URLs: " . count($urls) . "\n\n";

foreach ($endpoints as $name => $endpoint) {
    $ch = curl_init($endpoint);
    curl_setopt_array($ch, [
      CURLOPT_POST           => true,
      CURLOPT_POSTFIELDS     => $payload,
      CURLOPT_HTTPHEADER     => ['Content-Type: application/json; charset=utf-8'],
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_TIMEOUT        => 20,
    ]);
    $response = curl_exec($ch);
    $status   = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    echo "[{$name}] {$endpoint}\n";
    echo "HTTP Status: {$status}\n";
    if ($response) {
        echo "Response: {$response}\n";
    }
    echo "----------------------------------------\n";
}

