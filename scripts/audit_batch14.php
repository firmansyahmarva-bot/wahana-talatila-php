<?php
/**
 * scripts/audit_batch14.php
 * Find and audit Courses 131 - 140 (and print 141-147 so we have the full final map)
 */

$apiBaseUrl = 'https://wahanatotalita.com/api/trainings.php';
$apiKey = 'wtk_srv_fad3983cf65feca3f8f3da70d01d759a64cd889d99bafe88028732826f33066f';

function fetchPage($page) {
    global $apiBaseUrl, $apiKey;
    $url = $apiBaseUrl . '?page=' . $page . '&limit=100&fields=full&api_key=' . urlencode($apiKey);
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 30,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_HTTPHEADER     => [
            'Authorization: Bearer ' . $apiKey,
            'X-API-Key: ' . $apiKey
        ]
    ]);
    $res = curl_exec($ch);
    curl_close($ch);
    $data = json_decode($res, true);
    return $data['data'] ?? [];
}

$page1 = fetchPage(1);
$page2 = fetchPage(2);
$allTrainings = array_merge($page1, $page2);

echo "Total trainings fetched: " . count($allTrainings) . "\n\n";

// Batch 14: indices 130 to 139 (courses 131 to 140)
$batch14 = array_slice($allTrainings, 130, 10);

echo "══════════════════════════════════════════════════════════════════════\n";
echo "BATCH 14 COURSES (131 - 140):\n";
echo "══════════════════════════════════════════════════════════════════════\n";
$index = 131;
foreach ($batch14 as $item) {
    $slug = $item['slug'] ?? 'NO_SLUG';
    echo "[$index/140] ID: {$item['id']} | Slug: {$slug}\n";
    echo "Name       : " . ($item['name'] ?? 'N/A') . "\n";
    echo "Meta Title : " . ($item['meta_title'] ?? 'N/A') . "\n";
    echo "Meta Desc  : " . ($item['meta_desc'] ?? 'N/A') . "\n";
    echo "Desc Len   : " . strlen($item['description'] ?? '') . " chars\n";
    $curriculum = is_array($item['curriculum'] ?? null) ? count($item['curriculum']) : (is_string($item['curriculum'] ?? null) ? 'string' : 'none');
    echo "Curriculum : " . json_encode($curriculum) . " items\n";
    $long = $item['long_content'] ?? '';
    echo "Long Content: " . strlen($long) . " chars\n";
    if (strlen($long) > 0) {
        echo "Long Content Excerpt: " . substr(strip_tags($long), 0, 160) . "...\n";
    }
    echo "----------------------------------------------------------------------\n";
    $index++;
}

// Batch 15: indices 140 to end (courses 141 to 147)
$batch15 = array_slice($allTrainings, 140);
echo "\n══════════════════════════════════════════════════════════════════════\n";
echo "BATCH 15 REMAINING COURSES (141 - " . (140 + count($batch15)) . "):\n";
echo "══════════════════════════════════════════════════════════════════════\n";
$index15 = 141;
foreach ($batch15 as $item) {
    echo "[$index15] ID: {$item['id']} | Slug: {$item['slug']}\n";
    echo "     Name: {$item['name']}\n";
    $index15++;
}
