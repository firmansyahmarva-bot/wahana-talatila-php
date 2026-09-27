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

// Fetch all active courses
$allCourses = [];
$page = 1;
do {
    $url = "https://wahanatotalita.com/api/trainings.php?limit=50&page={$page}&status=active&fields=summary&api_key={$apiKey}";
    $data = apiGet($url, $apiKey);
    if (!empty($data['data'])) {
        foreach ($data['data'] as $item) {
            $allCourses[] = $item;
        }
    }
    $total = $data['total'] ?? 0;
    $totalPages = $data['pages'] ?? 1;
    $page++;
} while ($page <= $totalPages);

echo "Total Active Courses Retrieved: " . count($allCourses) . " (Total DB reported: $total)\n\n";

foreach ($allCourses as $i => $c) {
    $num = $i + 1;
    echo "[$num] ID: {$c['id']} | Slug: {$c['slug']}\n";
    echo "     Name: {$c['name']}\n";
    echo "     Meta: " . ($c['meta_title'] ?: '(EMPTY/FALLBACK)') . "\n";
}
