<?php
/**
 * scripts/apply_batch7.php
 * Automated updater for Batch 7 (Courses 61 - 70)
 * 
 * STRICT INVARIANT: Slugs are 100% IMMUTABLE.
 * Flow: Reads batch7_content_data.php -> Sends authenticated update -> Verifies response -> Verifies live HTML.
 */

$batchDataFile = __DIR__ . '/batch7_content_data.php';
if (!file_exists($batchDataFile)) {
    die("Error: $batchDataFile not found.\n");
}

$courses = require $batchDataFile;
if (!is_array($courses) || count($courses) !== 10) {
    die("Error: Expected exactly 10 courses in batch data, found " . count($courses) . "\n");
}

// 10 Whitelisted Slugs for Batch 7 — NEVER MODIFY
$expectedSlugs = [
    'pelatihan-petugas-p3k-sertifikasi-kemnaker-ri',
    'pelatihan-k3-operator-lift-barang-sertifikasi-kemnaker-ri',
    'pelatihan-k3-operator-crane-kelas-3-sertifikasi-kemnaker-ri',
    'pelatihan-k3-operator-scaffolding-sertifikasi-kemnaker-ri',
    'pelatihan-operator-pesawat-tenaga-produksi-ptp',
    'pelatihan-k3-operator-alat-berat-sertifikasi-kemnaker-ri',
    'pelatihan-k3-operator-boiler-kelas-2-sertifikasi-kemnaker-ri',
    'pelatihan-auditor-sistem-manajemen-k3-sertifikasi-kemnaker-ri',
    'pelatihan-tkbt-ii-sertifikasi-kemnaker-ri',
    'pelatihan-k3-operator-motor-diesel-genset-sertifikasi-kemnaker-ri'
];

// Safety assertion: Verify data keys strictly match whitelist
$dataSlugs = array_keys($courses);
if ($dataSlugs !== $expectedSlugs) {
    die("CRITICAL ERROR: Data keys do not exactly match the 10 immutable slugs!\n");
}

echo "══════════════════════════════════════════════════════════════════════\n";
echo "BATCH 7 CONTENT UPDATE RUNNER (COURSES 61 - 70)\n";
echo "Rule: Slugs are 100% IMMUTABLE. Target: Hostinger Production via API\n";
echo "Focus: High CTR, Internal Links (/pelatihan/ak3-bnsp), Corporate In-House\n";
echo "══════════════════════════════════════════════════════════════════════\n\n";

$apiBaseUrl = 'https://wahanatotalita.com/api/trainings.php';
$apiKey = 'wtk_srv_fad3983cf65feca3f8f3da70d01d759a64cd889d99bafe88028732826f33066f';

$successCount = 0;
$failCount = 0;

$index = 61;
foreach ($courses as $slug => $payload) {
    echo "[$index/70] Processing: {$slug}\n";
    echo "       Title : {$payload['name']}\n";
    echo "       Meta  : {$payload['meta_title']}\n";

    // Prepare request payload (strictly omit 'slug' to guarantee immutability)
    $updateData = [
        'name'         => $payload['name'],
        'meta_title'   => $payload['meta_title'],
        'meta_desc'    => $payload['meta_desc'],
        'wa_text'      => $payload['wa_text'],
        'description'  => $payload['description'],
        'curriculum'   => $payload['curriculum'],
        'long_content' => $payload['long_content'],
        'actor'        => 'batch7_seo_intent_rewrite'
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
            'User-Agent: WahanaAgent/1.0 (Batch7-Updater)'
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
echo "BATCH 7 UPDATE COMPLETE SUMMARY:\n";
echo "Total processed: 10\n";
echo "Success: $successCount\n";
echo "Failed : $failCount\n";
echo "══════════════════════════════════════════════════════════════════════\n";

if ($failCount === 0 && $successCount === 10) {
    echo "\nTriggering live cache refresh...\n";
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
    echo "Cache response excerpt: " . substr(strip_tags($rfRes), 0, 150) . "\n\n";

    echo "══════════════════════════════════════════════════════════════════════\n";
    echo "LIVE FRONTEND VERIFICATION (HTTP GET on each public URL)\n";
    echo "══════════════════════════════════════════════════════════════════════\n";

    foreach ($expectedSlugs as $idx => $slug) {
        $liveUrl = "https://wahanatotalita.com/pelatihan/$slug/";
        $vCh = curl_init($liveUrl);
        curl_setopt_array($vCh, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 15,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_FOLLOWLOCATION => true
        ]);
        $html = curl_exec($vCh);
        $vCode = curl_getinfo($vCh, CURLINFO_HTTP_CODE);
        curl_close($vCh);

        // Check title tag in rendered HTML
        preg_match('/<title>(.*?)<\/title>/is', $html, $tMatch);
        $renderedTitle = trim($tMatch[1] ?? 'NOT FOUND');

        // Check if internal links and in-house section are present
        $hasAk3Link = (strpos($html, '/pelatihan/ak3-bnsp') !== false);
        $hasInhouse = (stripos($html, 'In-House Training') !== false);

        echo "[" . ($idx + 61) . "] HTTP $vCode: $slug\n";
        echo "     Title: $renderedTitle\n";
        echo "     Has /pelatihan/ak3-bnsp link: " . ($hasAk3Link ? "YES" : "NO") . "\n";
        echo "     Has In-House Section: " . ($hasInhouse ? "YES" : "NO") . "\n\n";
    }
}
