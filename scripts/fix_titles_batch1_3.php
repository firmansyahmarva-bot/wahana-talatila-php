<?php
/**
 * scripts/fix_titles_batch1_3.php
 * Update meta titles for Batches 1, 2, and 3 based on:
 * Primary keyword + certification/format + 1–3 genuine buyer questions
 * (Zero boilerplate suffix, zero slug change)
 */

$titles = [
    // Batch 1
    'pelatihan-operator-k3-sertifikasi-bnsp' => 'Pelatihan Operator K3 BNSP: Syarat, Jadwal & Sertifikasi',
    'pelatihan-sertifikasi-peralatan-pendukung-water-truck-sertifikasi-bnsp' => 'Pelatihan Operator Water Truck BNSP: Biaya, Syarat & Jadwal',
    'pelatihan-sertifikasi-peralatan-pendukung-bulldozer-sertifikasi-bnsp' => 'Pelatihan Operator Bulldozer BNSP: Biaya, Syarat & Jadwal',
    'pelatihan-dan-sertifikasi-pengoperasian-alat-gali-muat-excavator-back-hoe-sertifikasi-bnsp' => 'Pelatihan Operator Excavator BNSP: Biaya, Syarat & Sertifikasi',
    'pelatihan-dan-sertifikasi-pengambil-contoh-uji-emisi-sumber-tidak-bergerak-jenjang-kualifikasi-3' => 'Sertifikasi PCU Emisi BNSP: Biaya, Syarat & Jadwal Resmi',
    'sosial-media-marketing-training-reguler' => 'Pelatihan Social Media Marketing: Materi, Jadwal & Biaya',
    'perpanjangan-sertifikasi-bnsp-online' => 'Perpanjangan Sertifikat BNSP Online: Syarat, Biaya & Jadwal RCC',
    'pelatihan-sertifikasi-peralatan-pendukung-motor-grader-sertifikasi-bnsp' => 'Pelatihan Operator Motor Grader BNSP: Biaya & Syarat Resmi',
    'pelatihan-ahli-k3-umum-fresh-graduate-kemnaker-online' => 'Pelatihan Ahli K3 Umum Fresh Graduate Kemnaker: Biaya & Syarat',
    'pelatihan-ahli-k3-umum-sertifikasi-bnsp-online' => 'Pelatihan Ahli K3 Umum BNSP Online: Biaya & Syarat',

    // Batch 2
    'pelatihan-dan-sertifikasi-fillet-plate-welder-sertifikasi-bnsp' => 'Pelatihan Welder Fillet & Plate BNSP: Syarat, Biaya & Uji WPS',
    'pelatihan-ahli-k3-penanggulangan-keb-kelas-a-sertifikasi-kemnaker-ri' => 'Pelatihan Ahli K3 Kebakaran Kelas A Kemnaker: Biaya & Syarat SKP',
    'pelatihan-sertifikasi-peralatan-pendukung-compactor-sertifikasi-bnsp' => 'Pelatihan Operator Compactor BNSP: Biaya, Syarat & Jadwal',
    'pelatihan-sertifikasi-peralatan-pendukung-service-truck-sertifikasi-bnsp' => 'Pelatihan Operator Service Truck BNSP: Biaya & Syarat Tambang',
    'pelatihan-sertifikasi-peralatan-pendukung-fuel-truck-sertifikasi-bnsp' => 'Pelatihan Operator Fuel Truck BNSP: Biaya, Syarat & Sertifikasi',
    'pelatihan-penanggung-jawab-pengendalian-pencemaran-air-pppa-oflline' => 'Pelatihan PPPA BNSP Offline: Biaya, Syarat & Jadwal Tatap Muka',
    'pelatihan-pengawas-k3-fasyankes-sertifikasi-bnsp' => 'Pelatihan Pengawas K3 Fasyankes BNSP: Biaya & Syarat Rumah Sakit',
    'pelatihan-penanganan-bahaya-gas-h2s-sertifikasi-bnsp' => 'Pelatihan Bahaya Gas H2S BNSP: Biaya, Sertifikasi & Jadwal',
    'pelatihan-petugas-p3k-sertifikasi-bnsp' => 'Pelatihan Petugas P3K BNSP: Biaya, Syarat & Sertifikasi Resmi',
    'ak3-bnsp' => 'Sertifikasi Ahli K3 Umum BNSP: Biaya, Syarat & Jadwal Portofolio',

    // Batch 3
    'pelatihan-penanggung-jawab-operasional-pengolahan-air-limbah-popal-offline' => 'Pelatihan POPAL BNSP Offline: Biaya, Syarat & Jadwal',
    'pelatihan-penanggung-jawab-pengendalian-pencemaran-udara-pppu-offline' => 'Pelatihan PPPU BNSP Offline: Biaya, Syarat & Jadwal Cerobong',
    'pelatihan-penanggung-jawab-operasional-instalasi-pengendalian-pencemaran-udara-poippu-offline' => 'Pelatihan POIPPU BNSP Offline: Biaya, Syarat & Jadwal Operasi',
    'pelatihan-pop-pengawas-operasional-pertama-offline' => 'Pelatihan POP Pertambangan BNSP Offline: Biaya, Syarat & Jadwal',
    'pelatihan-sertifikasi-pengoperasian-alat-angkut-underground-truck-sertifikasi-bnsp' => 'Pelatihan Operator Underground Truck BNSP: Biaya & Syarat Tambang',
    'pelatihan-qhse-awareness-terintegrasi-iso-online' => 'Pelatihan QHSE Terintegrasi ISO: Materi, Biaya & Jadwal Online',
    'pelatihan-pop-pertambangan-sertifikasi-bnsp-online' => 'Pelatihan POP Pertambangan BNSP Online: Biaya, Syarat & Jadwal',
    'pelatihan-qhse-awareness-iso-online' => 'Pelatihan QHSE Awareness ISO: Materi & Biaya Rp 1 Juta Online',
    'pelatihan-investigasi-kecelakaan-sertifikasi-bnsp' => 'Pelatihan Investigasi Kecelakaan BNSP: Materi, Biaya & Syarat RCA',
    'pelatihan-dan-sertifikasi-training-of-trainer-tot-instruktur-bnsp' => 'Pelatihan TOT Instruktur BNSP: Biaya, Syarat & Jadwal Online',
];

$apiBaseUrl = 'https://wahanatotalita.com/api/trainings.php';
$apiKey = 'wtk_srv_fad3983cf65feca3f8f3da70d01d759a64cd889d99bafe88028732826f33066f';

echo "Updating Meta Titles for Batches 1-3 (30 Courses)...\n\n";

$updated = 0;
foreach ($titles as $slug => $metaTitle) {
    $url = $apiBaseUrl . '?slug=' . urlencode($slug) . '&api_key=' . urlencode($apiKey);
    $payload = json_encode(['meta_title' => $metaTitle, 'actor' => 'title_ctr_upgrade']);

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST  => 'PUT',
        CURLOPT_POSTFIELDS     => $payload,
        CURLOPT_HTTPHEADER     => [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $apiKey,
            'X-API-Key: ' . $apiKey,
            'User-Agent: WahanaAgent/1.0 (Title-Updater)'
        ],
        CURLOPT_TIMEOUT        => 20,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => 0
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    $dec = json_decode($response, true);
    if ($httpCode === 200 && !empty($dec['success'])) {
        printf("[OK] %-60s -> %s\n", $slug, $metaTitle);
        $updated++;
    } else {
        printf("[FAIL %d] %s: %s\n", $httpCode, $slug, ($dec['message'] ?? $response));
    }
}

echo "\nDone: $updated / 30 titles updated successfully.\n";
