<?php
$apiKey = 'wtk_srv_fad3983cf65feca3f8f3da70d01d759a64cd889d99bafe88028732826f33066f';

function apiGet($url, $apiKey) {
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER     => [
            'Authorization: Bearer ' . $apiKey,
            'X-API-Key: ' . $apiKey
        ],
        CURLOPT_TIMEOUT        => 30,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => 0
    ]);
    $res = curl_exec($ch);
    curl_close($ch);
    return json_decode($res, true);
}

$allCourses = [];
$page = 1;
do {
    $url = "https://wahanatotalita.com/api/trainings.php?limit=50&page={$page}&status=active&fields=full&api_key={$apiKey}";
    $data = apiGet($url, $apiKey);
    if (!empty($data['data'])) {
        foreach ($data['data'] as $item) {
            $allCourses[] = $item;
        }
    }
    $totalPages = $data['meta']['total_pages'] ?? 1;
    $page++;
} while ($page <= $totalPages);

echo "=== COURSES 101 TO 110 (BATCH 11) ===\n";
for ($i = 100; $i < min(110, count($allCourses)); $i++) {
    $c = $allCourses[$i];
    $num = $i + 1;
    echo "[$num] ID: {$c['id']} | Slug: {$c['slug']}\n";
    echo "     Name: {$c['name']}\n";
    echo "     Certification: {$c['certification']}\n";
    echo "     Mode: {$c['mode']}\n";
    echo "     Price: {$c['price']}\n";
}
