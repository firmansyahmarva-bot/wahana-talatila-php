<?php
/**
 * scripts/find_empty_meta.php
 * List all courses where meta_title is empty
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

$emptyMeta = [];
foreach ($all as $idx => $item) {
    $metaTitle = trim($item['meta_title'] ?? '');
    if ($metaTitle === '') {
        $emptyMeta[] = [
            'catalog_pos' => $idx + 1,
            'id'          => $item['id'],
            'slug'        => $item['slug'],
            'name'        => $item['name'],
            'desc_len'    => strlen($item['description'] ?? ''),
            'long_len'    => strlen($item['long_content'] ?? '')
        ];
    }
}

echo "Total courses with empty meta_title: " . count($emptyMeta) . "\n\n";
foreach ($emptyMeta as $i => $item) {
    echo "[" . ($i + 1) . "/" . count($emptyMeta) . "] Pos: {$item['catalog_pos']} | ID: {$item['id']} | Slug: {$item['slug']}\n";
    echo "       Name: {$item['name']}\n";
    echo "       Desc: {$item['desc_len']} chars | Long: {$item['long_len']} chars\n";
}
