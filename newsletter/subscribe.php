<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/newsletter-functions.php';

$s = get_all_settings();
$success = false;
$error   = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf()) { $error = 'Sesi tidak valid.'; }
    else {
        $name  = sanitize($_POST['name']  ?? '');
        $email = sanitize($_POST['email'] ?? '');
        if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Email tidak valid.';
        } else {
            $ok = newsletter_subscribe($email, $name);
            if ($ok['ok'] ?? false) { $success = true; }
            else { $error = $ok['msg'] ?? 'Terjadi kesalahan.'; }
        }
    }
}
// Handle GET with email param (from footer form)
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['email'])) {
    redirect(SITE_URL . '/newsletter/?email=' . urlencode($_GET['email']));
}
?>
<?php
$page_title = 'Newsletter K3 — Tips HSE Gratis Setiap Minggu';
$meta_desc = 'Subscribe newsletter K3 gratis. Dapatkan tips HSE, info pelatihan terbaru, update regulasi K3 Indonesia langsung di inbox Anda.';
require __DIR__ . '/../includes/head.php';
<?= theme_css_vars($s) ?>
<style>
.nl-page{max-width:580px;margin:80px auto;padding:0 20px 80px;text-align:center}
.nl-card{background:#fff;border-radius:20px;padding:48px 40px;box-shadow:0 8px 32px rgba(0,0,0,.1)}
.nl-icon{font-size:4rem;margin-bottom:20px}
.nl-card h1{font-size:1.6rem;font-weight:800;margin:0 0 12px;color:var(--green)}
.nl-card p{color:#666;margin:0 0 28px}
.nl-form input{width:100%;box-sizing:border-box;padding:12px 16px;border:1.5px solid #ddd;border-radius:10px;font-size:.95rem;font-family:inherit;margin-bottom:12px}
.nl-form input:focus{outline:none;border-color:var(--green)}
.nl-form button{width:100%;background:var(--orange);color:#fff;border:none;padding:14px;border-radius:10px;font-size:1rem;font-weight:700;cursor:pointer}
.benefits{display:flex;gap:16px;flex-wrap:wrap;justify-content:center;margin-bottom:28px}
.benefit{background:#f0f9f0;padding:8px 16px;border-radius:100px;font-size:.8rem;color:var(--green);font-weight:600}
.error{color:#991b1b;background:#fee2e2;padding:10px;border-radius:8px;margin-bottom:12px;font-size:.875rem}
.success-state{text-align:center}
.success-state .icon{font-size:4rem;margin-bottom:16px}
</style>
<?php include __DIR__ . '/../includes/navbar.php'; ?>
<div class="nl-page">
  <div class="nl-card">
    <?php if ($success): ?>
    <div class="success-state">
      <div class="icon">🎉</div>
      <h1>Berhasil Subscribe!</h1>
      <p>Terima kasih! Newsletter K3 pertama Anda akan hadir segera di inbox.</p>
      <a href="/" style="display:inline-block;margin-top:20px;background:var(--green);color:#fff;padding:12px 28px;border-radius:8px;text-decoration:none;font-weight:600">← Kembali ke Home</a>
    </div>
    <?php else: ?>
    <div class="nl-icon">📧</div>
    <h1>Newsletter K3 Gratis</h1>
    <p>Dapatkan tips K3, update regulasi, dan info jadwal pelatihan terbaru langsung di inbox Anda. 100% gratis, unsubscribe kapan saja.</p>
    <div class="benefits">
      <span class="benefit">✅ Tips K3 mingguan</span>
      <span class="benefit">📋 Template gratis</span>
      <span class="benefit">📅 Info jadwal pelatihan</span>
      <span class="benefit">📰 Update regulasi</span>
    </div>
    <?php if ($error): ?><div class="error">❌ <?= e($error) ?></div><?php endif; ?>
    <form class="nl-form" method="POST">
      <?= csrf_field() ?>
      <input type="text"  name="name"  placeholder="Nama Anda" value="<?= e($_POST['name'] ?? '') ?>">
      <input type="email" name="email" placeholder="Email aktif Anda *" required value="<?= e($_POST['email'] ?? $_GET['email'] ?? '') ?>">
      <button type="submit">📧 Subscribe Gratis Sekarang</button>
    </form>
    <p style="margin-top:16px;font-size:.75rem;color:#bbb">Kami tidak akan membagikan email Anda kepada pihak ketiga.</p>
    <?php endif; ?>
  </div>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
<script src="<?= SITE_URL ?>/assets/js/main.js"></script>
</body></html>
