<?php
require_once __DIR__ . '/../config.php';

$pdo   = get_pdo();
$token = sanitize($_GET['token'] ?? '');
$done  = false;
$error = false;
$email = '';

if ($token) {
    $row = $pdo->prepare('SELECT * FROM newsletter_subscribers WHERE unsubscribe_token=? LIMIT 1');
    $row->execute([$token]); $row = $row->fetch();
    if ($row) {
        $email = $row['email'];
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm'])) {
            $pdo->prepare('UPDATE newsletter_subscribers SET is_active=0, unsubscribed_at=NOW() WHERE id=?')
                ->execute([$row['id']]);
            $done = true;
        }
    } else {
        $error = true;
    }
} else {
    // Handle POST from footer form (email only)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = sanitize($_POST['email'] ?? '');
        if ($email) {
            $pdo->prepare('UPDATE newsletter_subscribers SET is_active=0, unsubscribed_at=NOW() WHERE email=?')
                ->execute([$email]);
            $done = true;
        }
    }
}

$s = get_settings();
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Berhenti Berlangganan Newsletter — <?= e($s['site_name'] ?? 'Wahana Totalita') ?></title>
<meta name="robots" content="noindex,nofollow">
<link rel="canonical" href="<?= SITE_URL ?>/newsletter/unsubscribe/">
<style><?php
$_core_css_file = __DIR__ . '/../assets/css/core.min.css';
if (is_file($_core_css_file)) {
    readfile($_core_css_file);
} else {
    readfile(__DIR__ . '/../assets/css/tokens.css');
    readfile(__DIR__ . '/../assets/css/core.css');
}
?></style>
<link rel="stylesheet" href="<?= asset_v('/assets/css/components.min.css') ?>" media="print" onload="this.media='all'">
<noscript><link rel="stylesheet" href="<?= asset_v('/assets/css/components.min.css') ?>"></noscript>
<style>
.unsub-wrap{min-height:80vh;display:flex;align-items:center;justify-content:center;padding:40px 16px;background:#f8fafc}
.unsub-card{background:#fff;border-radius:16px;border:1px solid #e5e7eb;padding:48px 40px;max-width:480px;width:100%;text-align:center;box-shadow:0 4px 24px rgba(0,0,0,.06)}
.unsub-icon{font-size:3rem;margin-bottom:16px}
.unsub-card h1{font-size:1.4rem;color:#1f2937;margin:0 0 12px}
.unsub-card p{color:#6b7280;font-size:.9rem;line-height:1.6;margin:0 0 24px}
.unsub-email{background:#f3f4f6;border-radius:8px;padding:10px 16px;font-size:.85rem;font-weight:600;color:#374151;margin-bottom:24px}
.btn-confirm{display:block;width:100%;padding:13px;background:#ef4444;color:#fff;border:none;border-radius:10px;font-size:.95rem;font-weight:700;cursor:pointer;margin-bottom:10px}
.btn-confirm:hover{background:#dc2626}
.btn-cancel{display:block;width:100%;padding:13px;background:#f3f4f6;color:#374151;border:none;border-radius:10px;font-size:.9rem;font-weight:600;cursor:pointer;text-decoration:none}
.btn-cancel:hover{background:#e5e7eb}
</style>
</head>
<body>
<div class="unsub-wrap">
  <div class="unsub-card">
    <?php if ($done): ?>
      <div class="unsub-icon">✅</div>
      <h1>Berhasil Berhenti Berlangganan</h1>
      <p>Email <strong><?= e($email) ?></strong> telah dihapus dari daftar newsletter kami. Kamu tidak akan menerima email dari kami lagi.</p>
      <p style="font-size:.82rem;color:#9ca3af">Berubah pikiran? <a href="/newsletter/" style="color:var(--green)">Daftar lagi di sini</a>.</p>
      <a href="/" class="btn-cancel" style="margin-top:8px">← Kembali ke Beranda</a>

    <?php elseif ($error): ?>
      <div class="unsub-icon">⚠️</div>
      <h1>Link Tidak Valid</h1>
      <p>Link unsubscribe ini sudah tidak berlaku atau sudah digunakan sebelumnya.</p>
      <a href="/" class="btn-cancel">← Kembali ke Beranda</a>

    <?php elseif ($token && $email): ?>
      <div class="unsub-icon">📧</div>
      <h1>Berhenti Berlangganan?</h1>
      <p>Kamu akan berhenti menerima newsletter K3 dari Wahana Totalita.</p>
      <div class="unsub-email">📧 <?= e($email) ?></div>
      <form method="POST">
        <input type="hidden" name="confirm" value="1">
        <button type="submit" class="btn-confirm">Ya, Berhenti Berlangganan</button>
      </form>
      <a href="/" class="btn-cancel">Tidak, Tetap Berlangganan</a>

    <?php else: ?>
      <div class="unsub-icon">📧</div>
      <h1>Berhenti Berlangganan Newsletter</h1>
      <p>Masukkan email kamu untuk berhenti menerima newsletter K3 dari Wahana Totalita.</p>
      <form method="POST" style="text-align:left">
        <div style="margin-bottom:12px">
          <input type="email" name="email" required placeholder="Email kamu"
                 style="width:100%;box-sizing:border-box;padding:11px 14px;border:1.5px solid #ddd;border-radius:9px;font-size:.9rem">
        </div>
        <button type="submit" class="btn-confirm">Berhenti Berlangganan</button>
      </form>
      <a href="/" class="btn-cancel" style="margin-top:8px;display:block;text-align:center">← Kembali</a>
    <?php endif; ?>
  </div>
</div>
</body>
</html>
