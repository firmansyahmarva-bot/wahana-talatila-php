<?php
/**
 * admin/forum-quick-add.php
 *
 * Temporary tool: add forum topics as ALREADY APPROVED,
 * bypassing whatever "publish switch" is broken on the normal submit form.
 *
 * Place this file in your /admin/ folder (same folder as forum.php)
 * and open it in the browser while logged in as an admin/mod.
 */
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/partials/auth.php';
require_once __DIR__ . '/../includes/forum-functions.php';
require_auth('forum_mod');

$pdo = get_pdo();
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && csrf_verify($_POST['csrf_token'] ?? '')) {
    $title       = trim(sanitize($_POST['title'] ?? ''));
    $content     = trim($_POST['content'] ?? ''); // saved as-is; forum-functions trims it too
    $categoryId  = (int)($_POST['category_id'] ?? 0);
    $authorName  = trim(sanitize($_POST['author_name'] ?? '')) ?: 'Admin';
    $authorEmail = trim(sanitize($_POST['author_email'] ?? '')) ?: 'admin@wahanatotalita.com';

    if ($title === '' || $content === '' || $categoryId <= 0) {
        $error = 'Judul, isi, dan kategori wajib diisi.';
    } else {
        $id = save_forum_topic([
            'category_id'    => $categoryId,
            'author_name'    => $authorName,
            'author_email'   => $authorEmail,
            'author_company' => '',
            'title'          => $title,
            'content'        => $content,
            'is_approved'    => 1, // <-- forced approved, this is the whole point of this tool
        ]);

        if ($id) {
            $success = "Topik berhasil dibuat dan langsung tayang (ID #$id).";
        } else {
            $error = 'Gagal menyimpan. Cek error log server untuk detail.';
        }
    }
}

$categories = get_forum_categories();
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Quick Add Topik — Admin</title>
<meta name="robots" content="noindex">
<link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/admin.css">
</head>
<body class="admin-body">
<?php include __DIR__ . '/partials/sidebar.php'; ?>
<div class="admin-main" style="max-width:700px">
  <h1>➕ Tambah Topik Langsung (Sudah Disetujui)</h1>
  <p style="color:#666;font-size:.85rem;margin-bottom:20px">
    Tool sementara: topik yang dibuat di sini akan langsung tayang, tidak masuk antrian moderasi.
    Gunakan ini untuk mengisi forum sambil kita perbaiki form submit publiknya.
  </p>

  <?php if ($error): ?><div class="flash" style="background:#fee2e2;color:#991b1b;padding:12px;border-radius:8px;margin-bottom:16px">❌ <?= e($error) ?></div><?php endif; ?>
  <?php if ($success): ?><div class="flash flash-ok" style="padding:12px;border-radius:8px;margin-bottom:16px">✅ <?= e($success) ?></div><?php endif; ?>

  <?php if (empty($categories)): ?>
    <div style="color:#991b1b">⚠️ Tidak ada kategori aktif ditemukan. Tambahkan kategori dulu di forum_categories.</div>
  <?php else: ?>
  <form method="POST" style="background:#fff;border:1px solid #eee;border-radius:10px;padding:20px;display:flex;flex-direction:column;gap:14px">
    <?= csrf_field() ?>

    <label style="font-size:.85rem;font-weight:600">Kategori
      <select name="category_id" required style="width:100%;padding:8px;border:1px solid #ddd;border-radius:8px;margin-top:4px">
        <option value="">— Pilih kategori —</option>
        <?php foreach ($categories as $c): ?>
          <option value="<?= (int)$c['id'] ?>"><?= e($c['name']) ?></option>
        <?php endforeach; ?>
      </select>
    </label>

    <label style="font-size:.85rem;font-weight:600">Judul
      <input type="text" name="title" required maxlength="200" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:8px;margin-top:4px">
    </label>

    <label style="font-size:.85rem;font-weight:600">Isi
      <textarea name="content" required rows="8" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:8px;margin-top:4px"></textarea>
    </label>

    <label style="font-size:.85rem;font-weight:600">Nama penulis (opsional, default "Admin")
      <input type="text" name="author_name" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:8px;margin-top:4px">
    </label>

    <label style="font-size:.85rem;font-weight:600">Email penulis (opsional)
      <input type="email" name="author_email" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:8px;margin-top:4px">
    </label>

    <button type="submit" style="background:var(--green);color:#fff;border:none;padding:12px;border-radius:8px;cursor:pointer;font-weight:700">Publikasikan Topik</button>
  </form>
  <?php endif; ?>
</div>
</body></html>
