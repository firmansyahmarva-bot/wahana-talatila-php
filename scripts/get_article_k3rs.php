<?php
require_once __DIR__ . '/../config.php';
$key = 'wtk_srv_' . hash('sha256', DB_PASS . 'WahanaTotalitaSecure2026!');

$ch = curl_init('https://wahanatotalita.com/api/articles.php?slug=standar-k3-rumah-sakit-permenkes-66-2016-sertifikasi-petugas-k3rs');
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $key, 'Accept: application/json'],
    CURLOPT_SSL_VERIFYPEER => false,
]);
$resp = curl_exec($ch);
curl_close($ch);

$data = json_decode($resp, true);
echo "Article ID: " . ($data['data']['id'] ?? 'Not found') . "\n";
echo "Title: " . ($data['data']['title'] ?? '') . "\n";
