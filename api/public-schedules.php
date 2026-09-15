<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/jadwal-functions.php';

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: public, max-age=300, s-maxage=600');

$slug = preg_replace('/[^a-z0-9-]/', '', strtolower((string)($_GET['training_slug'] ?? '')));
$city = trim(preg_replace('/[^\pL\pN .-]/u', '', (string)($_GET['city'] ?? '')));

$training = $slug !== '' ? get_training_by_slug($slug) : null;
$filters = ['upcoming' => true, 'limit' => 24];
if ($training) {
    $filters['training_id'] = (int)$training['id'];
}
$rows = get_public_schedules($filters);

if ($city !== '') {
    usort($rows, static function (array $a, array $b) use ($city): int {
        $aLocal = stripos((string)($a['location'] ?? ''), $city) !== false;
        $bLocal = stripos((string)($b['location'] ?? ''), $city) !== false;
        return ($bLocal <=> $aLocal) ?: strcmp((string)$a['start_date'], (string)$b['start_date']);
    });
}

$result = array_map(static function (array $row): array {
    return [
        'id'         => (int)$row['id'],
        'start_date' => (string)$row['start_date'],
        'end_date'   => (string)$row['end_date'],
        'mode'       => (string)($row['mode'] ?? 'offline'),
        'location'   => (string)($row['location'] ?? ''),
        'price'      => (int)($row['price'] ?? 0),
        'seats_left' => (int)($row['seats_left'] ?? 0),
        'url'        => '/jadwal/' . (int)$row['id'] . '/',
    ];
}, array_slice($rows, 0, 6));

echo json_encode(['success' => true, 'schedules' => $result], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
