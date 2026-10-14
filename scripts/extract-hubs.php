<?php
$files = [
    'higiene-industri.php',
    'juru-las.php',
    'k3-ketinggian.php',
    'k3-kimia.php',
    'k3-konstruksi.php',
    'k3-laboratorium.php',
    'k3-lingkungan.php',
    'k3-listrik.php',
    'k3-manufaktur.php',
    'k3-migas.php',
    'k3-pangan.php',
    'k3-perkantoran.php',
    'k3-pertambangan.php',
    'k3-pesawat-angkat-angkut.php',
    'k3-pesawat-uap.php',
    'k3-psikososial.php',
    'k3-rumah-sakit.php',
    'k3-transportasi.php',
    'operator-alat-berat.php',
    'p3k.php',
    'pelatihan-iso.php',
    'penanggulangan-kebakaran.php',
    'sertifikasi-bnsp.php',
    'smk3.php',
];

$hubs = [];
foreach ($files as $file) {
    if (!file_exists($file)) continue;
    $content = file_get_contents($file);
    // Replace require hub-layout with return $hub_data
    $code = preg_replace('/require\s+__DIR__\s*\.\s*\'\/includes\/hub-layout\.php\';/', '', $content);
    $code = preg_replace('/require_once\s+__DIR__\s*\.\s*\'\/config\.php\';/', '', $code);
    $code = preg_replace('/<\?php/', '', $code);
    
    // Evaluate in isolated scope
    $hub_data = null;
    eval($code);
    if ($hub_data) {
        $slug = $hub_data['slug'] ?? basename($file, '.php');
        $hub_data['slug'] = $slug;
        $hub_data['id'] = $slug;
        $hubs[$slug] = $hub_data;
        echo "Extracted: $slug\n";
    } else {
        echo "Failed to extract: $file\n";
    }
}

file_put_contents('data/hubs.json', json_encode(array_values($hubs), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
echo "Successfully wrote " . count($hubs) . " hubs to data/hubs.json\n";
