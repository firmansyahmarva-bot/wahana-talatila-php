<?php
/**
 * scripts/run_batch1_direct.php
 * Direct PDO execution script for Batch 1 (Can run on server environment or via CLI).
 * STRICT RULE: Slugs are 100% IMMUTABLE and are used solely as WHERE conditions.
 */

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../api/includes/api-common.php';

$batchDataFile = __DIR__ . '/batch1_content_data.php';
$courses = require $batchDataFile;

try {
    $pdo = get_pdo();
} catch (Exception $e) {
    die("Database connection failed: " . $e->getMessage() . "\n");
}

ensure_audit_log_table($pdo);

$expectedSlugs = [
    'pelatihan-operator-k3-sertifikasi-bnsp',
    'pelatihan-sertifikasi-peralatan-pendukung-water-truck-sertifikasi-bnsp',
    'pelatihan-sertifikasi-peralatan-pendukung-bulldozer-sertifikasi-bnsp',
    'pelatihan-dan-sertifikasi-pengoperasian-alat-gali-muat-excavator-back-hoe-sertifikasi-bnsp',
    'pelatihan-dan-sertifikasi-pengambil-contoh-uji-emisi-sumber-tidak-bergerak-jenjang-kualifikasi-3',
    'sosial-media-marketing-training-reguler',
    'perpanjangan-sertifikasi-bnsp-online',
    'pelatihan-sertifikasi-peralatan-pendukung-motor-grader-sertifikasi-bnsp',
    'pelatihan-ahli-k3-umum-fresh-graduate-kemnaker-online',
    'pelatihan-ahli-k3-umum-sertifikasi-bnsp-online'
];

echo "Direct PDO Batch 1 Runner starting...\n";
$stmtCheck = $pdo->prepare("SELECT id, slug, name FROM trainings WHERE slug = ? LIMIT 1");
$stmtUpdate = $pdo->prepare("
    UPDATE trainings 
    SET name = ?, short_name = ?, meta_title = ?, meta_desc = ?, wa_text = ?, 
        description = ?, curriculum = ?, long_content = ?, updated_at = NOW()
    WHERE slug = ?
");

foreach ($courses as $slug => $c) {
    if (!in_array($slug, $expectedSlugs, true)) {
        die("ILLEGAL SLUG DETECTED: $slug\n");
    }

    $stmtCheck->execute([$slug]);
    $existing = $stmtCheck->fetch();
    if (!$existing) {
        echo "[NOT FOUND] Slug: $slug\n";
        continue;
    }

    $curJson = !empty($c['curriculum']) ? json_encode(array_values(array_filter(array_map('trim', $c['curriculum']))), JSON_UNESCAPED_UNICODE) : null;

    $stmtUpdate->execute([
        $c['name'],
        $c['short_name'],
        $c['meta_title'],
        $c['meta_desc'],
        $c['wa_text'],
        $c['description'],
        $curJson,
        $c['long_content'],
        $slug // WHERE slug = ? (Never modified!)
    ]);

    log_content_audit($pdo, 'training', (int)$existing['id'], $slug, 'batch1_rewrite', [
        'name' => $c['name'],
        'meta_title' => $c['meta_title']
    ], 'batch1_runner');

    echo "[UPDATED] {$slug} (ID: {$existing['id']})\n";
}

echo "All 10 programs successfully processed!\n";
