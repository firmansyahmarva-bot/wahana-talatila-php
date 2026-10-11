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

$slugs = [
    'manajemen-hutang-usaha-sertifikasi-reguler',
    'financial-accounting-training-reguler',
    'fiber-optic-fundamental-training-reguler',
    'project-cost-management-training-reguler',
    'hydraulic-and-pneumatic-operation-and-maintenance-training-reguler',
    'pengadaan-barang-dan-jasa-training-reguler',
    'system-management-vendor-training-reguler',
    'communication-skills-training-reguler',
    'logistic-transportation-distribution-training-reguler',
    'contract-drafting-and-negotiation-skill-training-training-reguler'
];

foreach ($slugs as $i => $slug) {
    $res = apiGet("https://wahanatotalita.com/api/trainings.php?slug={$slug}&api_key={$apiKey}", $apiKey);
    $d = $res['data'] ?? [];
    echo "══════════════════════════════════════════════════════════════════════\n";
    echo "[" . ($i + 111) . "] SLUG: {$slug}\n";
    echo "NAME: " . ($d['name'] ?? '') . "\n";
    echo "META TITLE: " . ($d['meta_title'] ?? '') . "\n";
    echo "META DESC: " . ($d['meta_desc'] ?? '') . "\n";
    echo "DESC LENGTH: " . strlen($d['description'] ?? '') . " chars\n";
    echo "DESC EXCERPT: " . substr(strip_tags($d['description'] ?? ''), 0, 150) . "...\n";
    echo "CURRICULUM COUNT: " . (is_array($d['curriculum'] ?? null) ? count($d['curriculum']) : 0) . "\n";
    echo "LONG CONTENT LENGTH: " . strlen($d['long_content'] ?? '') . " chars\n";
    echo "LONG CONTENT EXCERPT: " . substr(strip_tags($d['long_content'] ?? ''), 0, 200) . "...\n";
}
