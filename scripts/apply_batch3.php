<?php
/**
 * scripts/apply_batch3.php
 * Automated updater for Batch 3 (Courses 21 - 30)
 * 
 * STRICT INVARIANT: Slugs are 100% IMMUTABLE.
 * Flow: Reads batch3_content_data.php -> Sends authenticated update -> Verifies response.
 */

$batchDataFile = __DIR__ . '/batch3_content_data.php';
if (!file_exists($batchDataFile)) {
    die("Error: $batchDataFile not found.\n");
}

$courses = require $batchDataFile;
if (!is_array($courses) || count($courses) !== 10) {
    die("Error: Expected exactly 10 courses in batch data, found " . count($courses) . "\n");
}

// 10 Whitelisted Slugs for Batch 3 — NEVER MODIFY
$expectedSlugs = [
    'pelatihan-penanggung-jawab-operasional-pengolahan-air-limbah-popal-offline',
    'pelatihan-penanggung-jawab-pengendalian-pencemaran-udara-pppu-offline',
    'pelatihan-penanggung-jawab-operasional-instalasi-pengendalian-pencemaran-udara-poippu-offline',
    'pelatihan-pop-pengawas-operasional-pertama-offline',
    'pelatihan-sertifikasi-pengoperasian-alat-angkut-underground-truck-sertifikasi-bnsp',
    'pelatihan-qhse-awareness-terintegrasi-iso-online',
    'pelatihan-pop-pertambangan-sertifikasi-bnsp-online',
    'pelatihan-qhse-awareness-iso-online',
    'pelatihan-investigasi-kecelakaan-sertifikasi-bnsp',
    'pelatihan-dan-sertifikasi-training-of-trainer-tot-instruktur-bnsp'
];

// Safety assertion 1: Verify data keys strictly match whitelist
$dataSlugs = array_keys($courses);
if ($dataSlugs !== $expectedSlugs) {
    die("CRITICAL ERROR: Data keys do not exactly match the 10 immutable slugs!\n");
}

echo "══════════════════════════════════════════════════════════════════════\n";
echo "BATCH 3 CONTENT UPDATE RUNNER (COURSES 21 - 30)\n";
echo "Rule: Slugs are 100% IMMUTABLE. Target: Hostinger Production via API\n";
echo "Focus: High CTR, Corporate In-House Intent, Verified Units\n";
echo "══════════════════════════════════════════════════════════════════════\n\n";

$apiBaseUrl = 'https://wahanatotalita.com/api/trainings.php';
$apiKey = 'wtk_srv_fad3983cf65feca3f8f3da70d01d759a64cd889d99bafe88028732826f33066f';

$successCount = 0;
$skippedCount = 0;
$failCount = 0;

$index = 21;
foreach ($courses as $slug => $payload) {
    echo "[$index/30] Processing: {$slug}\n";
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
        'actor'        => 'batch3_seo_intent_rewrite'
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
            'User-Agent: WahanaAgent/1.0 (Batch3-Updater)'
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

    $decoded = json_decode($response, true);
    if ($httpCode === 200 && !empty($decoded['success'])) {
        $retSlug = $decoded['data']['slug'] ?? '';
        if ($retSlug !== $slug) {
            die("\n[CRITICAL VIOLATION] Returned slug '{$retSlug}' does NOT match target slug '{$slug}'! Aborting immediately!\n");
        }
        $msg = $decoded['message'] ?? 'Updated';
        echo "       [SUCCESS] HTTP {$httpCode}: {$msg} (Slug verified: {$retSlug})\n\n";
        if ($msg === 'No changes detected') {
            $skippedCount++;
        } else {
            $successCount++;
        }
    } else {
        echo "       [FAILED] HTTP {$httpCode}: " . ($decoded['message'] ?? $response) . "\n\n";
        $failCount++;
    }

    $index++;
}

echo "══════════════════════════════════════════════════════════════════════\n";
echo "BATCH 3 UPDATE SUMMARY\n";
echo "Total Courses: 10 (21 - 30)\n";
echo "Updated      : $successCount\n";
echo "Unchanged    : $skippedCount\n";
echo "Failed       : $failCount\n";
echo "══════════════════════════════════════════════════════════════════════\n";
