<?php
/**
 * scripts/apply_batch4.php
 * Automated updater for Batch 4 (Courses 31 - 40)
 * 
 * STRICT INVARIANT: Slugs are 100% IMMUTABLE.
 * Flow: Reads batch4_content_data.php -> Sends authenticated update -> Verifies response.
 */

$batchDataFile = __DIR__ . '/batch4_content_data.php';
if (!file_exists($batchDataFile)) {
    die("Error: $batchDataFile not found.\n");
}

$courses = require $batchDataFile;
if (!is_array($courses) || count($courses) !== 10) {
    die("Error: Expected exactly 10 courses in batch data, found " . count($courses) . "\n");
}

// 10 Whitelisted Slugs for Batch 4 — NEVER MODIFY
$expectedSlugs = [
    'pelatihan-ahli-muda-lingkungan-kerja-sertifikasi-kemnaker-ri',
    'pelatihan-petugas-k3-kimia-sertifikasi-kemnaker-ri',
    'pelatihan-internal-auditor-iso-9001-online',
    'pelatihan-pengawas-k3-rumah-sakit-sertifikasi-bnsp-online',
    'pelatihan-petugas-p3k-first-aid-online',
    'pelatihan-tkbt-2-bangunan-tinggi-online',
    'pelatihan-pom-pertambangan-sertifikasi-bnsp-online',
    'pelatihan-regu-penanggulangan-kebakaran-kelas-c-sertifikasi-kemnaker-ri',
    'pelatihan-ahli-muda-k3-konstruksi-sertifikasi-kemnaker-ri',
    'pelatihan-ahli-higiene-industri-muda-sertifikasi-bnsp'
];

// Safety assertion 1: Verify data keys strictly match whitelist
$dataSlugs = array_keys($courses);
if ($dataSlugs !== $expectedSlugs) {
    die("CRITICAL ERROR: Data keys do not exactly match the 10 immutable slugs!\n");
}

echo "══════════════════════════════════════════════════════════════════════\n";
echo "BATCH 4 CONTENT UPDATE RUNNER (COURSES 31 - 40)\n";
echo "Rule: Slugs are 100% IMMUTABLE. Target: Hostinger Production via API\n";
echo "Focus: High CTR, Corporate In-House Intent, Verified Units\n";
echo "══════════════════════════════════════════════════════════════════════\n\n";

$apiBaseUrl = 'https://wahanatotalita.com/api/trainings.php';
$apiKey = 'wtk_srv_fad3983cf65feca3f8f3da70d01d759a64cd889d99bafe88028732826f33066f';

$successCount = 0;
$skippedCount = 0;
$failCount = 0;

$index = 31;
foreach ($courses as $slug => $payload) {
    echo "[$index/40] Processing: {$slug}\n";
    echo "       Title : {$payload['name']}\n";

    // Prepare request payload (strictly omit 'slug' to guarantee immutability)
    $updateData = [
        'name'         => $payload['name'],
        'meta_title'   => $payload['meta_title'],
        'meta_desc'    => $payload['meta_desc'],
        'wa_text'      => $payload['wa_text'],
        'description'  => $payload['description'],
        'curriculum'   => $payload['curriculum'],
        'long_content' => $payload['long_content'],
        'actor'        => 'batch4_seo_intent_rewrite'
    ];

    $jsonBody = json_encode($updateData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

    $url = $apiBaseUrl . '?slug=' . urlencode($slug) . '&api_key=' . urlencode($apiKey);

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST  => 'PUT',
        CURLOPT_POSTFIELDS     => $jsonBody,
        CURLOPT_HTTPHEADER     => [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $apiKey,
            'X-API-Key: ' . $apiKey,
            'User-Agent: WahanaAgent/1.0 (Batch4-Updater)'
        ],
        CURLOPT_TIMEOUT        => 30,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => 0
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlErr  = curl_error($ch);
    curl_close($ch);

    if ($curlErr) {
        echo "       [FAILED] cURL error: $curlErr\n\n";
        $failCount++;
        $index++;
        continue;
    }

    $res = json_decode($response, true);

    if ($httpCode === 200 && isset($res['success']) && $res['success']) {
        echo "       [SUCCESS 200] " . ($res['message'] ?? 'Updated') . "\n";
        if (isset($res['data']['slug']) && $res['data']['slug'] === $slug) {
            echo "       [VERIFIED] Target slug untouched: {$res['data']['slug']}\n";
        }
        $successCount++;
    } else {
        echo "       [FAILED HTTP $httpCode] " . ($res['error'] ?? $response) . "\n";
        $failCount++;
    }
    echo "\n";
    $index++;
}

echo "══════════════════════════════════════════════════════════════════════\n";
echo "BATCH 4 UPDATE COMPLETE SUMMARY:\n";
echo "Total processed: 10\n";
echo "Success: $successCount\n";
echo "Failed : $failCount\n";
echo "══════════════════════════════════════════════════════════════════════\n";

if ($failCount === 0 && $successCount === 10) {
    echo "Triggering live cache refresh...\n";
    $refreshUrl = 'https://wahanatotalita.com/k3lib/database/refresh.php?key=k3-refresh-Ht9x2Qv7';
    $rfCh = curl_init($refreshUrl);
    curl_setopt_array($rfCh, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 30,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => 0
    ]);
    $rfRes = curl_exec($rfCh);
    $rfCode = curl_getinfo($rfCh, CURLINFO_HTTP_CODE);
    curl_close($rfCh);
    echo "Live cache refresh status: HTTP $rfCode\n";
    echo "Cache response excerpt: " . substr(strip_tags($rfRes), 0, 150) . "\n";
}
