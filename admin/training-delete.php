<?php
require_once __DIR__ . '/../config.php';
require_admin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !csrf_verify($_POST['csrf_token'] ?? '')) {
    redirect(SITE_URL . '/admin/trainings.php');
}

$id = (int)($_POST['id'] ?? 0);
if (!$id) { flash_set('error', 'ID tidak valid.'); redirect(SITE_URL . '/admin/trainings.php'); }

$pdo  = get_pdo();
$stmt = $pdo->prepare(
    'SELECT t.id, t.name, t.slug, t.image_path, c.slug AS cat_slug
     FROM trainings t LEFT JOIN categories c ON c.id = t.category_id
     WHERE t.id=? LIMIT 1'
);
$stmt->execute([$id]);
$t = $stmt->fetch();

if (!$t) { flash_set('error', 'Program tidak ditemukan.'); redirect(SITE_URL . '/admin/trainings.php'); }

// Log a permanent redirect BEFORE deleting, so the old URL 301s to the
// category hub instead of 404ing. This is what makes deletions safe for SEO.
$pdo->prepare(
    'INSERT INTO training_redirects (old_slug, target_slug, target_category_slug, reason)
     VALUES (?, NULL, ?, ?)
     ON DUPLICATE KEY UPDATE target_slug=NULL, target_category_slug=VALUES(target_category_slug), reason=VALUES(reason), created_at=NOW()'
)->execute([$t['slug'], $t['cat_slug'] ?: null, 'deleted']);

// Delete uploaded image if any
if (!empty($t['image_path'])) {
    @unlink(UPLOAD_DIR . basename($t['image_path']));
}

$pdo->prepare('DELETE FROM trainings WHERE id=?')->execute([$id]);
flash_set('success', "Program \"{$t['name']}\" berhasil dihapus. URL lama akan otomatis redirect.");
redirect(SITE_URL . '/admin/trainings.php');
