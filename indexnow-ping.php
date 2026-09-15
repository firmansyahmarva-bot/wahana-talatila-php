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
  "{$base}/tools/",
  "{$base}/lp/k3-migas", "{$base}/lp/k3-pertambangan", "{$base}/lp/k3-konstruksi",
  "{$base}/lp/k3-umum", "{$base}/lp/k3-lingkungan",
];

// ── Dynamic pages from the database (always current) ───────────────────────
try {
    $pdo = get_pdo();
    foreach ($pdo->query("SELECT slug FROM trainings WHERE is_active=1")->fetchAll() as $r) {
        $urls[] = "{$base}/pelatihan/" . $r['slug'] . "/";
    }
    foreach ($pdo->query("SELECT slug FROM glossary WHERE is_active=1")->fetchAll() as $r) {
        $urls[] = "{$base}/glosarium/" . $r['slug'] . "/";
    }
    foreach ($pdo->query("SELECT slug FROM articles WHERE status='published'")->fetchAll() as $r) {
        $urls[] = "{$base}/artikel/" . $r['slug'] . "/";
    }
} catch (Exception $e) { /* fall back to static list only */ }

$urls = array_values(array_unique($urls));

$payload = json_encode([
  'host'    => $host,
  'key'     => $indexnow_key,
  'keyLocation' => "https://{$host}/{$indexnow_key}.txt",
  'urlList' => $urls,
]);

$ch = curl_init('https://api.indexnow.org/indexnow');
curl_setopt_array($ch, [
  CURLOPT_POST           => true,
  CURLOPT_POSTFIELDS     => $payload,
  CURLOPT_HTTPHEADER     => ['Content-Type: application/json; charset=utf-8'],
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_TIMEOUT        => 15,
]);
$response = curl_exec($ch);
$status   = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

header('Content-Type: text/plain');
echo "IndexNow ping sent.\n";
echo "HTTP Status: {$status}\n";
echo "URLs submitted: " . count($urls) . "\n";
echo "Response: {$response}\n";
