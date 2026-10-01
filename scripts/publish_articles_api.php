<?php
require_once __DIR__ . '/../config.php';

$key = 'wtk_srv_' . hash('sha256', DB_PASS . 'WahanaTotalitaSecure2026!');
$articles = require __DIR__ . '/20_articles_data.php';

echo "══════════════════════════════════════════════════════════════════════\n";
echo "PUBLISHING 20 HIGH-CONVERTING ARTICLES VIA CONTENT API\n";
echo "══════════════════════════════════════════════════════════════════════\n\n";

$success = 0;
$failed = 0;

foreach ($articles as $idx => $art) {
    $num = $idx + 1;
    echo "[$num/20] Publishing: {$art['title']}\n";
    echo "       Slug: {$art['slug']}\n";

    $payload = [
        'title'      => $art['title'],
        'slug'       => $art['slug'],
        'category'   => $art['category'],
        'meta_title' => $art['meta_title'],
        'meta_desc'  => $art['meta_desc'],
        'keywords'   => $art['keywords'],
        'author'     => $art['author'],
        'status'     => 'published',
        'content'    => $art['content'],
        'faq'        => $art['faq']
    ];

    $ch = curl_init('https://wahanatotalita.com/api/articles.php');
    curl_setopt_array($ch, [
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => json_encode($payload, JSON_UNESCAPED_UNICODE),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER     => [
            'Authorization: Bearer ' . $key,
            'Content-Type: application/json',
            'Accept: application/json'
        ],
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_USERAGENT      => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)'
    ]);
    $resp = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($code === 200 || $code === 201) {
        $data = json_decode($resp, true);
        echo "       ✅ Success: " . ($data['data']['url'] ?? "https://wahanatotalita.com/artikel/{$art['slug']}/") . "\n";
        $success++;
    } else {
        echo "       ⚠️ Server returned HTTP $code: " . substr(strip_tags($resp), 0, 120) . "\n";
        $failed++;
    }
    echo "\n";
}

echo "══════════════════════════════════════════════════════════════════════\n";
echo "Summary: $success published successfully, $failed failed.\n";
echo "══════════════════════════════════════════════════════════════════════\n";
