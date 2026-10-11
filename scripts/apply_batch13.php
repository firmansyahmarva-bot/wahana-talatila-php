<?php
/**
 * scripts/apply_batch13.php
 * Automated updater for Batch 13 (Courses 121 - 130)
 * 
 * STRICT INVARIANT: Slugs are 100% IMMUTABLE.
 * NO refresh.php calls (main DB is updated directly via API).
 */

$batchDataFile = __DIR__ . '/batch13_content_data.php';
if (!file_exists($batchDataFile)) {
    die("Error: $batchDataFile not found.\n");
}

$courses = require $batchDataFile;
if (!is_array($courses) || count($courses) !== 10) {
    die("Error: Expected exactly 10 courses in batch data, found " . count($courses) . "\n");
}

$expectedSlugs = [
    'digital-marketing-specialist-training-reguler',
    'pelatihan-sertifikasi-human-resources-manajer-sertifikasi-bnsp',
    'online-training-fire-watcher',
    'pelatihan-sertifikasi-operator-hydraulic-drilling-rig-kelas-1-sertifikasi-kemnaker-ri',
    'training-public-speaking-and-communication-skill',
    'pelatihan-dan-sertifikasi-perencana-pascatambang-mineral-dan-batubara-sertifikasi-bnsp',
    'pelatihan-dan-sertifikasi-perencanaan-reklamasi-pada-kegiatan-pertambangan-mineral-dan-batubara-sertifikasi-bnsp',
    'pelatihan-dan-sertifikasi-pelaksana-pemantauan-hasil-pascatambang-pada-kegiatan-pertambangan-mineral-dan-batubara-sertifikasi-bnsp',
    'pelatihan-dan-sertifikasi-pelaksanaan-reklamasi-pada-kegiatan-petambangan-mineral-dan-batubara-sertifikasi-bnsp',
    'pelatihan-dan-sertifikasi-pengoperasian-alat-gali-muat-excavator-front-shovel-sertifikat-bnsp'
];

$dataSlugs = array_keys($courses);
if ($dataSlugs !== $expectedSlugs) {
    echo "Expected:\n";
    print_r($expectedSlugs);
    echo "Actual data slugs:\n";
    print_r($dataSlugs);
    die("CRITICAL ERROR: Data keys do not exactly match the 10 immutable slugs!\n");
}

echo "══════════════════════════════════════════════════════════════════════\n";
echo "BATCH 13 CONTENT UPDATE RUNNER (COURSES 121 - 130)\n";
echo "Rule: Slugs are 100% IMMUTABLE. Target: Hostinger Production via API\n";
echo "Digital Marketing, HR Manajer, Fire Watcher, Rig Kemnaker, Minerba BNSP\n";
echo "══════════════════════════════════════════════════════════════════════\n\n";

$apiBaseUrl = 'https://wahanatotalita.com/api/trainings.php';
$apiKey = 'wtk_srv_fad3983cf65feca3f8f3da70d01d759a64cd889d99bafe88028732826f33066f';

$successCount = 0;
$failCount = 0;

$index = 121;
foreach ($courses as $slug => $payload) {
    echo "[$index/130] Processing: {$slug}\n";
    echo "       Title : {$payload['name']}\n";
    echo "       Meta  : {$payload['meta_title']}\n";

    $updateData = [
        'name'         => $payload['name'],
        'meta_title'   => $payload['meta_title'],
        'meta_desc'    => $payload['meta_desc'],
        'wa_text'      => $payload['wa_text'],
        'description'  => $payload['description'],
        'curriculum'   => $payload['curriculum'],
        'long_content' => $payload['long_content'],
        'actor'        => 'batch13_bespoke_seo'
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
            'User-Agent: WahanaAgent/1.0 (Batch13-Updater)'
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
echo "BATCH 13 UPDATE SUMMARY:\n";
echo "Total processed: 10\n";
echo "Success: $successCount\n";
echo "Failed : $failCount\n";
echo "══════════════════════════════════════════════════════════════════════\n";

if ($failCount === 0 && $successCount === 10) {
    echo "\nPerforming Public Live HTTP Verification for all 10 pages...\n";
    $verifyIndex = 121;
    $allPagesOk = true;

    foreach ($expectedSlugs as $slug) {
        $liveUrl = "https://wahanatotalita.com/pelatihan/" . $slug;
        $ch = curl_init($liveUrl);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_TIMEOUT        => 20,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_USERAGENT      => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'
        ]);
        $html = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        preg_match('/<title>(.*?)<\/title>/is', $html, $matches);
        $title = isset($matches[1]) ? trim($matches[1]) : 'NO_TITLE_FOUND';

        echo "[$verifyIndex/130] Live HTTP $code: $liveUrl\n";
        echo "       Title: $title\n";

        if ($code !== 200) {
            echo "       [WARNING] Non-200 HTTP code: $code\n";
            $allPagesOk = false;
        }
        $verifyIndex++;
    }

    if ($allPagesOk) {
        echo "\n>>> ALL 10 COURSES IN BATCH 13 VERIFIED LIVE AND HEALTHY! <<<\n";
    }
}
