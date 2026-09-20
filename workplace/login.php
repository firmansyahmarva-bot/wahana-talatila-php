<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/workplace-functions.php';

if (wp_get_session()) redirect(SITE_URL . '/workplace/dashboard/');

$s = get_all_settings();
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf()) { $errors[] = 'Sesi tidak valid.'; }
    else {
        $email = sanitize($_POST['email'] ?? '');
        $pass  = $_POST['password'] ?? '';
        if (!$email || !$pass) {
            $errors[] = 'Email dan password wajib diisi.';
        } else {
            $account = wp_login($email, $pass);
            if ($account) {
                wp_set_session($account);
                redirect(SITE_URL . '/workplace/dashboard/');
            } else {
                $errors[] = 'Email atau password salah.';
            }
        }
    }
}
?>
<?php
$page_title = 'Login Workplace K3 Dashboard';
$meta_desc = 'Login ke Workplace K3 Dashboard Wahana Totalita.';
require __DIR__ . '/../includes/head.php';
<?= theme_css_vars($s) ?>
<style>
body{background:#f0f9f0;min-height:100vh;display:flex;flex-direction:column}
.login-wrap{flex:1;display:flex;align-items:center;justify-content:center;padding:40px 20px}
.login-card{background:#fff;border-radius:20px;padding:40px;width:100%;max-width:440px;box-shadow:0 8px 32px rgba(0,0,0,.1)}
.login-card .logo{text-align:center;margin-bottom:28px}
.login-card .logo span{font-size:3rem;display:block}
.login-card .logo h1{font-size:1.4rem;font-weight:800;color:var(--green);margin:8px 0 4px}
.login-card .logo p{font-size:.85rem;color:#999;margin:0}
.form-group{margin-bottom:18px}
.form-group label{display:block;font-weight:600;margin-bottom:6px;font-size:.875rem;color:#333}
.form-group input{width:100%;box-sizing:border-box;padding:12px 16px;border:1.5px solid #ddd;border-radius:10px;font-size:.95rem;font-family:inherit;transition:.2s}
.form-group input:focus{outline:none;border-color:var(--green);box-shadow:0 0 0 3px rgba(10,74,46,.1)}
.btn-login{width:100%;background:var(--green);color:#fff;border:none;padding:14px;border-radius:10px;font-size:1rem;font-weight:700;cursor:pointer}
.btn-login:hover{background:#0d5c38}
.error-box{background:#fee2e2;color:#991b1b;border:1px solid #fecaca;padding:12px 16px;border-radius:8px;margin-bottom:16px;font-size:.875rem}
.divider{display:flex;align-items:center;gap:12px;margin:20px 0;color:#ccc;font-size:.8rem}
.divider::before,.divider::after{content:'';flex:1;height:1px;background:#eee}
.back-link{display:block;text-align:center;margin-top:20px;color:#999;font-size:.85rem;text-decoration:none}
.back-link:hover{color:var(--green)}
</style>
<?php include __DIR__ . '/../includes/navbar.php'; ?>

<div class="login-wrap">
  <div class="login-card">
    <div class="logo">
      <span>🏢</span>
      <h1>Workplace K3</h1>
      <p>Dashboard sertifikat & K3 Score perusahaan</p>
    </div>

    <?php if (!empty($errors)): ?>
    <div class="error-box">❌ <?= implode('<br>', array_map('e', $errors)) ?></div>
    <?php endif; ?>

    <form method="POST">
      <?= csrf_field() ?>
      <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" value="<?= e($_POST['email'] ?? '') ?>" placeholder="email@perusahaan.com" required autofocus>
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" placeholder="••••••••" required>
      </div>
      <button type="submit" class="btn-login">🔐 Masuk ke Dashboard</button>
    </form>

    <div class="divider">atau</div>

    <div style="text-align:center;font-size:.875rem;color:#666">
      Perusahaan Anda belum terdaftar?<br>
      <a href="/workplace/daftar/" style="color:var(--green);font-weight:600">Daftar Gratis →</a>
    </div>

    <div style="margin-top:16px;text-align:center;font-size:.8rem;color:#999">
      Lupa password? <a href="<?= wa_url('Halo, saya lupa password Workplace K3 Dashboard') ?>" style="color:var(--green)">Hubungi Admin</a>
    </div>

    <a href="/" class="back-link">← Kembali ke website</a>
  </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
<script src="<?= SITE_URL ?>/assets/js/main.js"></script>
</body></html>
