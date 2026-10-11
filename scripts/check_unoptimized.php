<?php
/**
 * scripts/check_unoptimized.php
 * Scan all 147 trainings and list which ones are not yet optimized
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

$all = array_merge(fetchPage(1), fetchPage(2));

$unoptimized = [];
$optimizedCount = 0;

foreach ($all as $idx => $item) {
    $metaTitle = trim($item['meta_title'] ?? '');
    $metaDesc  = trim($item['meta_desc'] ?? '');
    $longLen   = strlen($item['long_content'] ?? '');
    $descLen   = strlen($item['description'] ?? '');

    // Check if optimized
    $isOptimized = ($metaTitle !== '' && $metaDesc !== '' && $longLen > 4000 && $descLen > 200);

    if ($isOptimized) {
        $optimizedCount++;
    } else {
        $unoptimized[] = [
            'idx'       => $idx + 1,
            'id'        => $item['id'],
            'slug'      => $item['slug'],
            'name'      => $item['name'],
            'meta_title'=> $metaTitle,
            'descLen'   => $descLen,
            'longLen'   => $longLen
        ];
    }
}

echo "Total courses: " . count($all) . "\n";
echo "Optimized count: " . $optimizedCount . "\n";
echo "Unoptimized count: " . count($unoptimized) . "\n\n";

echo "LIST OF UNOPTIMIZED COURSES:\n";
foreach ($unoptimized as $u) {
    echo "[$u[idx]/147] ID: {$u['id']} | Slug: {$u['slug']}\n";
    echo "       Name: {$u['name']}\n";
    echo "       Meta: '{$u['meta_title']}' | Desc: {$u['descLen']} | Long: {$u['longLen']}\n";
}
