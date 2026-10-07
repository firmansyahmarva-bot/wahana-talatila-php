<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/jadwal-functions.php';

try {
    $pdo = get_pdo();
    $totalBatches = (int)$pdo->query("SELECT COUNT(*) FROM training_batches")->fetchColumn();
    $publicBatches = (int)$pdo->query("SELECT COUNT(*) FROM training_batches WHERE is_public = 1")->fetchColumn();
    $upcomingCount = get_upcoming_schedule_count();
    
    echo "Total batches in training_batches: $totalBatches\n";
    echo "Public batches: $publicBatches\n";
    echo "Upcoming public batches (start_date >= CURDATE()): $upcomingCount\n\n";

    echo "--- Sample upcoming batches (first 10) ---\n";
    $samples = get_public_schedules(['upcoming' => 1, 'limit' => 10]);
    foreach ($samples as $b) {
        echo "ID: {$b['id']} | {$b['start_date']} - {$b['end_date']} | {$b['training_name']} | Mode: {$b['mode']} | Seats left: {$b['seats_left']} | Status: {$b['status']}\n";
    }

    echo "\n--- Recent batches overall (first 10 by ID desc) ---\n";
    $recent = $pdo->query("SELECT id, course_id, batch_name, start_date, end_date, mode, is_public, status FROM training_batches ORDER BY id DESC LIMIT 10")->fetchAll();
    foreach ($recent as $r) {
        echo "ID: {$r['id']} | Course ID: {$r['course_id']} | {$r['start_date']} to {$r['end_date']} | Mode: {$r['mode']} | Public: {$r['is_public']} | Status: {$r['status']} | Name: {$r['batch_name']}\n";
    }

    echo "\n--- Total registrations in training_registrations ---\n";
    $totalRegs = (int)$pdo->query("SELECT COUNT(*) FROM training_registrations")->fetchColumn();
    echo "Total registrations: $totalRegs\n";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
