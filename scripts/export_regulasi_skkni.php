<?php
$baseDir = dirname(__DIR__);
require_once $baseDir . '/includes/regulasi-data.php';
$regRaw = get_regulasi_dataset();
$regulasi = [];
foreach ($regRaw as $k => $item) {
    if (!isset($item['id'])) {
        $item['id'] = $item['slug'] ?? $k;
    }
    if (!isset($item['slug'])) {
        $item['slug'] = $k;
    }
    $regulasi[] = $item;
}
file_put_contents($baseDir . '/data/regulasi.json', json_encode($regulasi, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
echo "Exported " . count($regulasi) . " regulasi items.\n";

$skkniFiles = glob($baseDir . '/data/skkni/*.php');
$skkniList = [];
foreach ($skkniFiles as $f) {
    $res = include $f;
    if (is_array($res)) {
        if (!isset($res['slug'])) {
            $res['slug'] = basename($f, '.php');
        }
        if (!isset($res['id'])) {
            $res['id'] = $res['slug'];
        }
        $skkniList[] = $res;
    }
}
file_put_contents($baseDir . '/data/skkni.json', json_encode($skkniList, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
echo "Exported " . count($skkniList) . " skkni items.\n";
