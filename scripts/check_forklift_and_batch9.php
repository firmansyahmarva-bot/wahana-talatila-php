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

// Check Forklift
$forklift = apiGet("https://wahanatotalita.com/api/trainings.php?slug=pelatihan-k3-operator-forklift-kelas-2-sertifikasi-kemnaker-ri&api_key={$apiKey}", $apiKey);
echo "=== CURRENT FORKLIFT DATA ===\n";
echo "Name: " . ($forklift['data']['name'] ?? '') . "\n";
echo "Meta Title: " . ($forklift['data']['meta_title'] ?? '') . "\n";
echo "Meta Desc: " . ($forklift['data']['meta_desc'] ?? '') . "\n";
echo "Content excerpt: " . substr(strip_tags($forklift['data']['long_content'] ?? ''), 0, 300) . "\n\n";

// Now print courses 81 to 90
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

echo "=== COURSES 81 TO 90 (BATCH 9) ===\n";
for ($i = 80; $i < min(90, count($allCourses)); $i++) {
    $c = $allCourses[$i];
    $num = $i + 1;
    echo "[$num] ID: {$c['id']} | Slug: {$c['slug']}\n";
    echo "     Name: {$c['name']}\n";
    echo "     Category: {$c['cat_name']}\n";
    echo "     Certification: {$c['certification']}\n";
    echo "     Mode: {$c['mode']}\n";
    echo "     Price: {$c['price']}\n";
}
