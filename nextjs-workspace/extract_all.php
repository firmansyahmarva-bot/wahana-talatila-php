<?php
$trainings = [];
$batch_files = glob(__DIR__ . '/scripts/*_content_data.php');
foreach ($batch_files as $bf) {
    $batch = require $bf;
    if (is_array($batch)) {
        foreach ($batch as $slug => $item) {
            $item['slug'] = (string)$slug;
            $trainings[$slug] = $item;
        }
    }
}

$articles = [];
$art_file = __DIR__ . '/scripts/20_articles_data.php';
if (file_exists($art_file)) {
    $art_batch = require $art_file;
    if (is_array($art_batch)) {
        foreach ($art_batch as $item) {
            if (isset($item['slug'])) {
                $articles[$item['slug']] = $item;
            }
        }
    }
}

// Load Regulasi dataset
require_once __DIR__ . '/includes/regulasi-data.php';
$regulasi = get_regulasi_dataset();

// Load Purnabakti dataset
require_once __DIR__ . '/includes/purnabakti-data.php';
$purnabakti = get_all_purnabakti_items();

// Load Riksa Uji dataset
require_once __DIR__ . '/includes/riksa-uji-data.php';
$riksa_uji = get_all_riksa_uji_items();

// Load Perpanjangan SKP dataset
require_once __DIR__ . '/includes/perpanjangan-skp-data.php';
$perpanjangan_skp = get_all_perpanjangan_skp_items();

// Load Event dataset
require_once __DIR__ . '/includes/event-data.php';
$event_data = get_all_event_items();

if (!is_dir(__DIR__ . '/src/data')) {
    mkdir(__DIR__ . '/src/data', 0777, true);
}

file_put_contents(
    __DIR__ . '/src/data/trainings.json',
    json_encode($trainings, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
);

file_put_contents(
    __DIR__ . '/src/data/articles.json',
    json_encode($articles, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
);

file_put_contents(
    __DIR__ . '/src/data/regulasi.json',
    json_encode($regulasi, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
);

file_put_contents(
    __DIR__ . '/src/data/purnabakti.json',
    json_encode($purnabakti, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
);

file_put_contents(
    __DIR__ . '/src/data/riksa_uji.json',
    json_encode($riksa_uji, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
);

file_put_contents(
    __DIR__ . '/src/data/perpanjangan_skp.json',
    json_encode($perpanjangan_skp, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
);

file_put_contents(
    __DIR__ . '/src/data/events.json',
    json_encode($event_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
);

echo "EXTRACTED DATASET TOTALS:\n";
echo "- Training Courses: " . count($trainings) . "\n";
echo "- Masterclass Articles: " . count($articles) . "\n";
echo "- Regulation Guides: " . count($regulasi) . "\n";
echo "- Purnabakti Guides: " . count($purnabakti) . "\n";
echo "- Riksa Uji Guides: " . count($riksa_uji) . "\n";
echo "- Perpanjangan SKP Guides: " . count($perpanjangan_skp) . "\n";
echo "- Event Guides: " . count($event_data) . "\n";
