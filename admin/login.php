<?php
require_once __DIR__ . '/../config.php';

if (!empty($_SESSION['admin_id'])) redirect(SITE_URL . '/admin/');

$error   = '';
$success = '';
$tab     = $_GET['tab'] ?? 'login';

// ── Handle Login ──────────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'login') {
    if (!csrf_verify($_POST['csrf_token'] ?? '')) {
        $error = 'Token tidak valid. Silakan coba lagi.';
    } else {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        $ip       = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
        $pdo      = get_pdo();

        // Rate limit
        $window = date('Y-m-d H:i:s', time() - 900);
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM login_attempts WHERE username=? AND attempted_at > ?');
        $stmt->execute([$username, $window]);
        if ((int)$stmt->fetchColumn() >= 5) {
            $error = 'Terlalu banyak percobaan. Tunggu 15 menit.';
        } elseif (!$username || !$password) {
            $error = 'Username dan password wajib diisi.';
        } else {
            $stmt = $pdo->prepare('SELECT * FROM admin_users WHERE username=? LIMIT 1');
            $stmt->execute([$username]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password_hash'])) {
                if ($user['status'] === 'suspended') {
                    $error = 'Akun Anda telah dinonaktifkan. Hubungi Super Admin.';
                } elseif ($user['status'] === 'pending') {
                    $error = 'Akun Anda belum disetujui. Silakan tunggu persetujuan admin.';
                } else {
                    session_regenerate_id(true);
                    $_SESSION['admin_id']   = $user['id'];
                    $_SESSION['admin_user'] = $user['username'];
                    $_SESSION['admin_name'] = $user['full_name'] ?? $user['username'];
                    $_SESSION['admin_role'] = $user['role'] ?? 'viewer';
                    $_SESSION['last_regen'] = time();
                    $pdo->prepare('UPDATE admin_users SET last_login_at=NOW() WHERE id=?')->execute([$user['id']]);
                    $pdo->prepare('DELETE FROM login_attempts WHERE username=?')->execute([$username]);
                    redirect(SITE_URL . '/admin/');
                }
            } else {
                $pdo->prepare('INSERT INTO login_attempts (username, ip_address) VALUES (?,?)')->execute([$username, $ip]);
                $error = 'Username atau password salah.';
            }
        }
    }
    $tab = 'login';
}

// ── Handle Register ───────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'register') {
    if (!csrf_verify($_POST['csrf_token'] ?? '')) {
        $error = 'Token tidak valid.';
    } else {
        $username  = trim($_POST['username'] ?? '');
        $password  = $_POST['password'] ?? '';
        $confirm   = $_POST['confirm_password'] ?? '';
        $full_name = trim($_POST['full_name'] ?? '');
        $email     = trim($_POST['email'] ?? '');
        $phone     = trim($_POST['phone'] ?? '');
        $role_req  = $_POST['role_requested'] ?? 'viewer';
        $pdo       = get_pdo();

        if (!$username || !$password || !$full_name) {
            $error = 'Nama lengkap, username, dan password wajib diisi.';
        } elseif (strlen($username) < 4) {
            $error = 'Username minimal 4 karakter.';
        } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
            $error = 'Username hanya boleh huruf, angka, dan underscore.';
        } elseif (strlen($password) < 8) {
            $error = 'Password minimal 8 karakter.';
        } elseif ($password !== $confirm) {
            $error = 'Konfirmasi password tidak cocok.';
        } elseif (!in_array($role_req, ['website','certification','accounting','viewer'])) {
            $error = 'Role tidak valid.';
        } else {
            // Check duplicate username
            $stmt = $pdo->prepare('SELECT COUNT(*) FROM admin_users WHERE username=?');
            $stmt->execute([$username]);
            $dup1 = (int)$stmt->fetchColumn();
            $stmt = $pdo->prepare('SELECT COUNT(*) FROM user_registrations WHERE username=? AND status=\'pending\'');
            $stmt->execute([$username]);
            $dup2 = (int)$stmt->fetchColumn();

            if ($dup1 > 0 || $dup2 > 0) {
                $error = 'Username sudah digunakan. Pilih username lain.';
            } else {
                $hash = password_hash($password, PASSWORD_BCRYPT, ['cost'=>12]);
                $pdo->prepare('INSERT INTO user_registrations (username,password_hash,full_name,email,phone,role_requested) VALUES (?,?,?,?,?,?)')
                    ->execute([$username, $hash, $full_name, $email, $phone, $role_req]);

                // Notify superadmin
                try {
                    $pdo->prepare("INSERT INTO notifications (type,title,message,link,for_roles) VALUES ('user_pending',?,?,?,'superadmin')")
                        ->execute(["Pendaftaran akun baru: $username", "$full_name mendaftar sebagai $role_req. Tinjau dan setujui.", '/admin/users.php?tab=registrations']);
                } catch (Exception $e) {}

                $success = 'Pendaftaran berhasil! Akun Anda sedang menunggu persetujuan dari Super Admin.';
                $tab = 'register';
            }
        }
    }
    if (!$success) $tab = 'register';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Admin — Wahana Totalita</title>
<meta name="robots" content="noindex,nofollow">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{--green:#0A4A2E;--green-m:#0d5c38;--orange:#C6621C;--border:#e5e7eb}
body{font-family:'Segoe UI',system-ui,sans-serif;background:linear-gradient(135deg,#062316 0%,#0A4A2E 60%,#0d5c38 100%);min-height:100vh;display:flex;align-items:center;justify-content:center;padding:20px;position:relative;overflow:hidden}
body::before{content:'';position:absolute;inset:0;background-image:radial-gradient(circle at 1px 1px,rgba(255,255,255,.04) 1px,transparent 0);background-size:28px 28px;pointer-events:none}
.card{background:#fff;border-radius:16px;box-shadow:0 20px 60px rgba(0,0,0,.35);width:100%;max-width:440px;overflow:hidden;position:relative;z-index:1}
.card-header{background:var(--green);padding:28px 32px 24px}
.logo{display:flex;align-items:center;gap:12px;margin-bottom:18px}
.logo-icon{width:42px;height:42px;background:var(--orange);border-radius:10px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:13px;font-weight:900;flex-shrink:0}
.logo-text strong{display:block;color:#fff;font-size:15px;font-weight:800}
.logo-text span{color:rgba(255,255,255,.55);font-size:12px}
.tabs{display:flex;gap:4px}
.tab-btn{flex:1;padding:9px;border:none;background:rgba(255,255,255,.1);color:rgba(255,255,255,.65);border-radius:8px;font-size:13px;font-weight:600;cursor:pointer;transition:all .15s;font-family:inherit}
.tab-btn.active{background:#fff;color:var(--green)}
.card-body{padding:28px 32px}
.tab-content{display:none}
.tab-content.active{display:block}
.form-group{margin-bottom:16px}
label{display:block;font-size:13px;font-weight:600;color:#374151;margin-bottom:5px}
input,select{width:100%;padding:10px 14px;border:1.5px solid var(--border);border-radius:8px;font-size:14px;outline:none;transition:border-color .2s;background:#fafafa;font-family:inherit}
input:focus,select:focus{border-color:var(--green);background:#fff}
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:12px}
.btn{width:100%;padding:12px;background:var(--green);color:#fff;font-size:15px;font-weight:700;border:none;border-radius:8px;cursor:pointer;transition:background .2s;margin-top:6px;font-family:inherit}
.btn:hover{background:var(--green-m)}
.alert{border-radius:8px;padding:11px 14px;margin-bottom:16px;font-size:13px;display:flex;gap:8px;align-items:flex-start}
.alert-error{background:#fef2f2;border:1px solid #fca5a5;color:#991b1b}
.alert-success{background:#f0fdf4;border:1px solid #86efac;color:#166534}
.back{display:block;text-align:center;margin-top:16px;font-size:12px;color:#9ca3af}
.back a{color:var(--green);font-weight:600}
.form-hint{font-size:11px;color:#9ca3af;margin-top:3px}
@media(max-width:480px){.form-row{grid-template-columns:1fr}.card-body{padding:22px 20px}.card-header{padding:22px 20px 18px}}
</style>
</head>
<body>
<div class="card">
  <div class="card-header">
    <div class="logo">
      <div class="logo-icon">WT</div>
      <div class="logo-text">
        <strong>Wahana Totalita Konsultan</strong>
        <span>Panel Admin</span>
      </div>
    </div>
    <div class="tabs">
      <button class="tab-btn <?= $tab === 'login' ? 'active' : '' ?>" onclick="switchTab('login')">Masuk</button>
      <button class="tab-btn <?= $tab === 'register' ? 'active' : '' ?>" onclick="switchTab('register')">Daftar Akun</button>
    </div>
  </div>

  <div class="card-body">

    <!-- ── LOGIN TAB ── -->
    <div class="tab-content <?= $tab === 'login' ? 'active' : '' ?>" id="tab-login">
      <?php if ($error && $tab === 'login'): ?>
      <div class="alert alert-error">⚠️ <?= e($error) ?></div>
      <?php endif; ?>

      <form method="post" novalidate>
        <?= csrf_field() ?>
        <input type="hidden" name="action" value="login">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" value="<?= e($_POST['username'] ?? '') ?>"
                 autocomplete="username" autofocus required>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" autocomplete="current-password" required>
        </div>
        <button type="submit" class="btn">Masuk ke Panel Admin</button>
      </form>
      <a href="/" class="back">← Kembali ke Website</a>
    </div>

    <!-- ── REGISTER TAB ── -->
    <div class="tab-content <?= $tab === 'register' ? 'active' : '' ?>" id="tab-register">
      <?php if ($error && $tab === 'register'): ?>
      <div class="alert alert-error">⚠️ <?= e($error) ?></div>
      <?php endif; ?>
      <?php if ($success): ?>
      <div class="alert alert-success">✅ <?= e($success) ?></div>
      <p style="text-align:center;margin-top:12px"><a href="/admin/login.php" style="color:var(--green);font-weight:600">← Kembali ke Login</a></p>
      <?php else: ?>

      <form method="post" novalidate>
        <?= csrf_field() ?>
        <input type="hidden" name="action" value="register">
        <div class="form-group">
          <label for="reg-name">Nama Lengkap <span style="color:#ef4444">*</span></label>
          <input type="text" id="reg-name" name="full_name" value="<?= e($_POST['full_name'] ?? '') ?>" required>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label for="reg-username">Username <span style="color:#ef4444">*</span></label>
            <input type="text" id="reg-username" name="username" value="<?= e($_POST['username'] ?? '') ?>"
                   pattern="[a-zA-Z0-9_]+" required>
            <div class="form-hint">Huruf, angka, underscore</div>
          </div>
          <div class="form-group">
            <label for="reg-phone">No. WhatsApp</label>
            <input type="tel" id="reg-phone" name="phone" value="<?= e($_POST['phone'] ?? '') ?>">
          </div>
        </div>
        <div class="form-group">
          <label for="reg-email">Email</label>
          <input type="email" id="reg-email" name="email" value="<?= e($_POST['email'] ?? '') ?>">
        </div>
        <div class="form-row">
          <div class="form-group">
            <label for="reg-password">Password <span style="color:#ef4444">*</span></label>
            <input type="password" id="reg-password" name="password" required>
            <div class="form-hint">Min. 8 karakter</div>
          </div>
          <div class="form-group">
            <label for="reg-confirm">Konfirmasi Password <span style="color:#ef4444">*</span></label>
            <input type="password" id="reg-confirm" name="confirm_password" required>
          </div>
        </div>
        <div class="form-group">
          <label for="reg-role">Akses yang Diminta</label>
          <select id="reg-role" name="role_requested">
            <option value="viewer"        <?= ($_POST['role_requested']??'viewer')==='viewer'        ? 'selected':'' ?>>View Only — Hanya lihat data</option>
            <option value="certification" <?= ($_POST['role_requested']??'')==='certification' ? 'selected':'' ?>>Sertifikasi — Kelola klien & sertifikasi</option>
            <option value="accounting"    <?= ($_POST['role_requested']??'')==='accounting'    ? 'selected':'' ?>>Keuangan — Kelola invoice & pembayaran</option>
            <option value="website"       <?= ($_POST['role_requested']??'')==='website'       ? 'selected':'' ?>>Website — Kelola konten & program</option>
          </select>
          <div class="form-hint">Super Admin akan menentukan akses final Anda</div>
        </div>
        <button type="submit" class="btn">Kirim Pendaftaran</button>
        <p style="text-align:center;margin-top:12px;font-size:12px;color:#9ca3af">
          Pendaftaran akan ditinjau oleh Super Admin sebelum disetujui.
        </p>
      </form>
      <?php endif; ?>
    </div>

  </div>
</div>

<script>
function switchTab(tab) {
  document.querySelectorAll('.tab-content').forEach(function(el) { el.classList.remove('active'); });
  document.querySelectorAll('.tab-btn').forEach(function(el) { el.classList.remove('active'); });
  document.getElementById('tab-' + tab).classList.add('active');
  document.querySelectorAll('.tab-btn')[tab === 'login' ? 0 : 1].classList.add('active');
}
// Auto switch to register tab if URL param
<?php if ($tab === 'register'): ?>switchTab('register');<?php endif; ?>
</script>
</body>
</html>
