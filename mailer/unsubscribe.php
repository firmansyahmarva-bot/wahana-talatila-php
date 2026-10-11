<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';

// Public, unauthenticated page — reached only via a per-contact link in a sent email.
$token = (string)($_GET['t'] ?? '');

if ($token !== '') {
    $stmt = db()->prepare("SELECT id FROM contacts WHERE unsubscribe_token = ? AND status != 'unsubscribed'");
    $stmt->execute([$token]);
    $contact = $stmt->fetch();
    if ($contact) {
        db()->prepare("UPDATE contacts SET status = 'unsubscribed' WHERE id = ?")->execute([$contact['id']]);
    }
}
// Always show the same generic confirmation, regardless of token validity, to avoid leaking whether a token exists.
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex, nofollow">
<title>Berhenti Berlangganan — PT Wahana Totalita Konsultan</title>
<style>
body { font-family: "Segoe UI", Arial, Helvetica, sans-serif; background: #f4f6f5; color: #1a1a1a; margin: 0; padding: 60px 20px; }
.box { max-width: 440px; margin: 0 auto; background: #fff; border: 1px solid #e2e5e3; border-radius: 10px; padding: 32px; text-align: center; }
.box img { height: 34px; margin-bottom: 18px; }
.box h1 { font-size: 18px; margin: 0 0 10px; color: #0A4A2E; }
.box p { font-size: 14px; color: #555; line-height: 1.6; }
</style>
</head>
<body>
  <div class="box">
    <img src="<?= e(SITE_LOGO_URL) ?>" alt="PT Wahana Totalita Konsultan">
    <h1>Anda telah berhenti berlangganan</h1>
    <p>Anda tidak akan lagi menerima email dari PT Wahana Totalita Konsultan. Jika ini tidak sengaja, silakan hubungi kami melalui <a href="<?= e(SITE_URL) ?>">website</a> kami.</p>
  </div>
</body>
</html>
