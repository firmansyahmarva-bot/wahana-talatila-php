<?php
/**
 * Wahana Totalita — setup.php
 * Run ONCE after importing database.sql.
 * DELETES itself is NOT supported — you must manually delete this file.
 * ---------------------------------------------------
 * Access: https://wahanatotalita.com/setup.php
 * DELETE THIS FILE IMMEDIATELY after running it.
 */

// ── CONFIGURE BEFORE RUNNING ───────────────────────────────────
define('SETUP_USERNAME', 'admin');       // admin username to update
define('SETUP_PASSWORD', 'Admin@2026');  // ← CHANGE TO YOUR PASSWORD
// ──────────────────────────────────────────────────────────────

require_once __DIR__ . '/config.php';

$steps = []; $errors = [];

// 1. DB connection
try { $pdo = get_pdo(); $steps[] = '✅ Koneksi database berhasil.'; }
catch (Exception $e) { $errors[] = '❌ Koneksi gagal: ' . $e->getMessage(); }

// 2. Tables
if (!$errors) {
    foreach (['categories','trainings','admin_users','site_settings','inquiries'] as $tbl) {
        try { $pdo->query("SELECT 1 FROM `$tbl` LIMIT 1"); $steps[] = "✅ Tabel `$tbl` OK."; }
        catch (Exception $e) { $errors[] = "❌ Tabel `$tbl` tidak ditemukan. Import database.sql terlebih dahulu."; }
    }
}

// 3. Set password
if (!$errors) {
    if (strlen(SETUP_PASSWORD) < 8) { $errors[] = '❌ Password minimal 8 karakter.'; }
    else {
        $hash = password_hash(SETUP_PASSWORD, PASSWORD_BCRYPT, ['cost'=>12]);
        $stmt = $pdo->prepare('UPDATE admin_users SET password_hash=? WHERE username=?');
        $stmt->execute([$hash, SETUP_USERNAME]);
        if ($stmt->rowCount() > 0) $steps[] = '✅ Password admin berhasil di-set untuk user "' . SETUP_USERNAME . '".';
        else $errors[] = '❌ User "' . SETUP_USERNAME . '" tidak ditemukan di tabel admin_users.';
    }
}

// 4. Upload dir
if (!$errors) {
    if (!is_dir(UPLOAD_DIR)) { mkdir(UPLOAD_DIR, 0755, true); }
    $steps[] = is_writable(UPLOAD_DIR) ? '✅ Direktori upload dapat ditulis.' : '⚠️ Direktori upload tidak bisa ditulis. chmod 755.';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Setup — Wahana Totalita</title>
<meta name="robots" content="noindex,nofollow">
<style>
body{font-family:system-ui,sans-serif;max-width:600px;margin:60px auto;padding:20px;background:#f5f6fa}
.card{background:#fff;border-radius:12px;padding:32px;box-shadow:0 4px 20px rgba(0,0,0,.1)}
h1{font-size:20px;color:#0A4A2E;margin-bottom:24px}
.step{padding:8px 12px;margin:6px 0;border-radius:7px;font-size:14px;
      background:#E8F4EE;color:#0A4A2E}
.step.err{background:#FEF2F2;color:#991B1B}
.warn{background:#FEF9EC;color:#854F0B;padding:16px;border-radius:8px;margin-top:20px;font-size:14px;font-weight:600}
.btn{display:inline-block;margin-top:20px;padding:12px 24px;background:#0A4A2E;color:#fff;border-radius:8px;font-weight:700;font-size:15px;text-decoration:none}
</style>
</head>
<body>
<div class="card">
  <h1>⚙️ Setup Wahana Totalita</h1>
  <?php foreach ($steps  as $s): ?><div class="step"><?= htmlspecialchars($s) ?></div><?php endforeach; ?>
  <?php foreach ($errors as $e): ?><div class="step err"><?= htmlspecialchars($e) ?></div><?php endforeach; ?>

  <?php if (empty($errors)): ?>
  <div class="warn">
    ⚠️ Setup selesai! Segera HAPUS file <code>setup.php</code> dari server Anda sebelum melanjutkan.
  </div>
  <a href="/admin/login.php" class="btn">→ Login ke Admin Panel</a>
  <?php else: ?>
  <div class="warn">Perbaiki error di atas, lalu refresh halaman ini.</div>
  <?php endif; ?>
</div>
</body>
</html>
