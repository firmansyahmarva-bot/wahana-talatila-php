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
    'pelatihan-penanggung-jawab-pengendalian-pencemaran-air-pppa-sertifikasi-bnsp',
    'pelatihan-penanggung-jawab-pengendalian-pencemaran-udara-pppu-sertifikasi-bnsp',
    'pelatihan-manajer-pengolahan-limbah-b3-jenjang-kualifikasi-6-level-pengawas-mplb3-sertifikasi-bnsp',
    'pelatihan-operator-penyimpanan-limbah-b3-jenjang-kualifikasi-3-level-pelaksana-sertifikasi-bnsp-1',
    'pelatihan-dan-sertifikasi-pipe-group-welder-welding-inspector-basic-sertifikasi-bnsp',
    'pelatihan-dan-sertifikasi-welding-foreman-sertifikasi-bnsp',
    'pelatihan-dan-sertifikasi-welding-inspector-standard-sertifikasi-bnsp',
    'pelatihan-dan-sertifikasi-welding-practitioner-welding-instructur-sertifikasi-bnsp',
    'pelatihan-dan-sertifikasi-pipe-fitter-sertifikasi-bnsp',
    'pelatihan-dan-sertifikasi-welding-specialistsupervisor'
];

foreach ($slugs as $idx => $s) {
    $c = apiGet("https://wahanatotalita.com/api/trainings.php?slug={$s}&api_key={$apiKey}", $apiKey);
    $data = $c['data'] ?? [];
    echo "[" . ($idx + 91) . "] {$s}\n";
    echo "     Name: " . ($data['name'] ?? '') . "\n";
    echo "     Price: " . ($data['price'] ?? '') . " | Mode: " . ($data['mode'] ?? '') . " | Cert: " . ($data['certification'] ?? '') . "\n";
    echo "     Desc: " . substr(strip_tags($data['description'] ?? ''), 0, 150) . "...\n\n";
}
