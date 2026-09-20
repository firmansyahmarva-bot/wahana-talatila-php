<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/workplace-functions.php';

if (wp_get_session()) redirect(SITE_URL . '/workplace/dashboard/');

$s = get_all_settings();
$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf()) { $errors[] = 'Sesi tidak valid.'; }
    else {
        $data = [
            'company_name' => sanitize($_POST['company_name'] ?? ''),
            'contact_name' => sanitize($_POST['contact_name'] ?? ''),
            'email'        => sanitize($_POST['email']        ?? ''),
            'password'     => $_POST['password']              ?? '',
            'password2'    => $_POST['password2']             ?? '',
        ];
        if (!$data['company_name']) $errors[] = 'Nama perusahaan wajib diisi.';
        if (!$data['contact_name']) $errors[] = 'Nama PIC wajib diisi.';
        if (!$data['email'] || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) $errors[] = 'Email valid wajib diisi.';
        if (strlen($data['password']) < 8) $errors[] = 'Password minimal 8 karakter.';
        if ($data['password'] !== $data['password2']) $errors[] = 'Password dan konfirmasi tidak cocok.';

        if (empty($errors)) {
            $result = wp_register($data);
            if ($result['success']) {
                $success = true;
            } else {
                $errors[] = $result['error'] ?? 'Gagal mendaftar. Coba lagi.';
            }
        }
    }
}
?>
<?php
$page_title = 'Daftar Workplace K3 Dashboard — Gratis';
$meta_desc = 'Daftar akun Workplace K3 Dashboard gratis — kelola sertifikat, K3 Score, dan laporan HSE perusahaan Anda.';
require __DIR__ . '/../includes/head.php';
<?= theme_css_vars($s) ?>
<style>
.reg-page{max-width:620px;margin:60px auto;padding:0 20px 80px}
.reg-card{background:#fff;border-radius:20px;overflow:hidden;box-shadow:0 8px 32px rgba(0,0,0,.1)}
.reg-header{background:linear-gradient(135deg,var(--green),#1a5c3a);padding:32px;color:#fff;text-align:center}
.reg-header h1{font-size:1.4rem;font-weight:800;margin:0 0 8px}
.reg-body{padding:36px}
.form-group{margin-bottom:18px}
.form-group label{display:block;font-weight:600;margin-bottom:6px;font-size:.875rem;color:#333}
.form-group input{width:100%;box-sizing:border-box;padding:12px 16px;border:1.5px solid #ddd;border-radius:10px;font-size:.95rem;font-family:inherit}
.form-group input:focus{outline:none;border-color:var(--green);box-shadow:0 0 0 3px rgba(10,74,46,.1)}
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:16px}
.btn-daftar{width:100%;background:var(--green);color:#fff;border:none;padding:14px;border-radius:10px;font-size:1rem;font-weight:700;cursor:pointer;margin-top:8px}
.btn-daftar:hover{background:#0d5c38}
.benefits{background:#f0f9f0;border-radius:12px;padding:20px;margin-bottom:24px}
.benefits ul{margin:8px 0 0;padding-left:20px;font-size:.875rem;line-height:2;color:#555}
.error-box{background:#fee2e2;color:#991b1b;border:1px solid #fecaca;padding:12px 16px;border-radius:8px;margin-bottom:16px;font-size:.875rem}
.success-box{background:#f0fdf4;border:1px solid #bbf7d0;padding:28px;border-radius:12px;text-align:center}
@media(max-width:520px){.form-row{grid-template-columns:1fr}}
</style>
<?php include __DIR__ . '/../includes/navbar.php'; ?>

<div class="reg-page">
  <div class="reg-card">
    <div class="reg-header">
      <div style="font-size:3rem">🏢</div>
      <h1>Daftar Workplace K3</h1>
      <p style="opacity:.85;font-size:.875rem;margin:0">Dashboard sertifikat & K3 Score untuk perusahaan Anda. Gratis.</p>
    </div>
    <div class="reg-body">
      <?php if ($success): ?>
      <div class="success-box">
        <div style="font-size:3rem;margin-bottom:12px">🎉</div>
        <h2 style="margin:0 0 8px;color:var(--green)">Pendaftaran Berhasil!</h2>
        <p style="color:#555;margin:0 0 20px">Akun perusahaan Anda sudah aktif. Login sekarang untuk mulai kelola K3 perusahaan.</p>
        <a href="/workplace/login/" style="display:inline-block;background:var(--green);color:#fff;padding:12px 28px;border-radius:8px;text-decoration:none;font-weight:700">🔐 Login Sekarang</a>
      </div>
      <?php else: ?>
      <div class="benefits">
        <strong style="font-size:.9rem;color:var(--green)">✨ Apa yang Anda dapatkan GRATIS:</strong>
        <ul>
          <li>Dashboard K3 Score real-time untuk semua karyawan</li>
          <li>Tracking sertifikat & status kadaluarsa</li>
          <li>Riwayat data karyawan tersimpan aman</li>
        </ul>
      </div>

      <?php if (!empty($errors)): ?>
      <div class="error-box">❌ <?= implode('<br>', array_map('e', $errors)) ?></div>
      <?php endif; ?>

      <form method="POST">
        <?= csrf_field() ?>
        <div class="form-group">
          <label>Nama Perusahaan *</label>
          <input type="text" name="company_name" value="<?= e($_POST['company_name'] ?? '') ?>" placeholder="PT / CV / Dinas ..." required>
        </div>
        <div class="form-group">
          <label>Nama PIC / HSE Manager *</label>
          <input type="text" name="contact_name" value="<?= e($_POST['contact_name'] ?? '') ?>" placeholder="Nama lengkap" required>
        </div>
        <div class="form-group">
          <label>Email *</label>
          <input type="email" name="email" value="<?= e($_POST['email'] ?? '') ?>" placeholder="email@perusahaan.com" required>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label>Password *</label>
            <input type="password" name="password" placeholder="Min 8 karakter" required>
          </div>
          <div class="form-group">
            <label>Konfirmasi Password *</label>
            <input type="password" name="password2" placeholder="Ulangi password" required>
          </div>
        </div>
        <button type="submit" class="btn-daftar">✅ Daftar Gratis Sekarang</button>
        <p style="text-align:center;margin-top:16px;font-size:.8rem;color:#999">Sudah punya akun? <a href="/workplace/login/" style="color:var(--green);font-weight:600">Login di sini</a></p>
      </form>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
<script src="<?= SITE_URL ?>/assets/js/main.js"></script>
</body></html>
