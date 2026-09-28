<?php
/**
 * scripts/audit_batch13.php
 * Audit current content for Batch 13 (Courses 121 - 130)
 */

$apiBaseUrl = 'https://wahanatotalita.com/api/trainings.php';
$apiKey = 'wtk_srv_fad3983cf65feca3f8f3da70d01d759a64cd889d99bafe88028732826f33066f';

$slugs = [
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

$index = 121;
foreach ($slugs as $slug) {
    $url = $apiBaseUrl . '?slug=' . urlencode($slug) . '&api_key=' . urlencode($apiKey);
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 15,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_HTTPHEADER     => [
            'Authorization: Bearer ' . $apiKey,
            'X-API-Key: ' . $apiKey
        ]
    ]);
    $res = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    $data = json_decode($res, true);
    $item = $data['data'] ?? [];

    echo "══════════════════════════════════════════════════════════════════════\n";
    echo "[$index/130] Slug: {$slug} (HTTP $code)\n";
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
    $index++;
}
