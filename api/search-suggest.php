<?php
declare(strict_types=1);

require_once __DIR__ . '/../config.php';

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: public, max-age=180, s-maxage=300');

$q = trim((string)($_GET['q'] ?? ''));
// Normalize spaces and length
$q = preg_replace('/\s+/', ' ', $q);
$q = mb_substr($q, 0, 80, 'UTF-8');

if (mb_strlen($q, 'UTF-8') < 2) {
    echo json_encode(['success' => true, 'results' => []], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

try {
$results = [];
$trainingsFile = __DIR__ . '/../data/trainings.json';
if (file_exists($trainingsFile)) {
    $trainings = json_decode(file_get_contents($trainingsFile), true) ?: [];
    $qLower = mb_strtolower($q);
    $matched = [];
    foreach ($trainings as $t) {
        if (!($t['is_active'] ?? 1)) continue;
        $name = $t['name'] ?? '';
        $nameLower = mb_strtolower($name);
        $cert = $t['certification'] ?? '';
        $cat = $t['cat_name'] ?? $t['category_name'] ?? '';
        
        $score = 999;
        if (str_starts_with($nameLower, $qLower)) {
            $score = 1;
        } elseif (str_contains($nameLower, $qLower)) {
            $score = 2;
        } elseif (str_contains(mb_strtolower($cert), $qLower) || str_contains(mb_strtolower($cat), $qLower)) {
            $score = 3;
        }
        
        if ($score < 999) {
            $matched[] = ['item' => $t, 'score' => $score];
        }
    }
    usort($matched, fn($a, $b) => ($a['score'] <=> $b['score']) ?: (($a['item']['sort_order'] ?? 0) <=> ($b['item']['sort_order'] ?? 0)));
    $rows = array_map(fn($m) => $m['item'], array_slice($matched, 0, 6));
} else {
    try {
        $pdo = get_pdo();
        $like = '%' . $q . '%';
        $prefix = $q . '%';

        $stmt = $pdo->prepare(
            'SELECT t.name, t.slug, t.certification
             FROM trainings t
             LEFT JOIN categories c ON c.id = t.category_id
             WHERE t.is_active = 1
               AND (t.name LIKE ? OR t.certification LIKE ? OR c.name LIKE ?)
             ORDER BY 
               CASE 
                 WHEN t.name LIKE ? THEN 1 
                 WHEN t.name LIKE ? THEN 2 
                 ELSE 3 
               END,
               t.sort_order ASC,
               t.id ASC
             LIMIT 6'
        );
        $stmt->execute([$like, $like, $like, $prefix, $like]);
        $rows = $stmt->fetchAll();
    } catch (Exception) { $rows = []; }
}

    $results = [];
    foreach ($rows as $row) {
        $cert = trim((string)($row['certification'] ?? ''));
        // Keep certification clean and short if present
        if ($cert !== '') {
            if (stripos($cert, 'Kemnaker') !== false) {
                $cert = 'Kemnaker RI';
            } elseif (stripos($cert, 'BNSP') !== false) {
                $cert = 'BNSP';
            }
        }

        $results[] = [
            'name' => (string)$row['name'],
            'slug' => (string)$row['slug'],
            'url'  => '/pelatihan/' . urlencode((string)$row['slug']) . '/',
            'cert' => $cert,
        ];
    }

    echo json_encode(['success' => true, 'results' => $results], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} catch (Throwable $e) {
    // Fail silently with empty list to prevent frontend breakage
    echo json_encode(['success' => false, 'results' => []], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}
