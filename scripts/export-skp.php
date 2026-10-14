<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/perpanjangan-skp-data.php';

$items = get_all_perpanjangan_skp_items();
foreach ($items as $slug => &$item) {
    $item['id'] = $slug;
    $item['slug'] = $slug;
}
unset($item);

file_put_contents(__DIR__ . '/../data/perpanjangan_skp.json', json_encode(array_values($items), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
echo "Exported " . count($items) . " perpanjangan SKP items to data/perpanjangan_skp.json\n";
