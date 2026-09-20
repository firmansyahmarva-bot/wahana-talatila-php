<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/jadwal-functions.php';

$requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: '';
$batchId = preg_match('#/jadwal/daftar/(\d+)/?$#', $requestPath, $batchIdMatch)
    ? (int)$batchIdMatch[1]
    : 0;
if (!$batchId) redirect(SITE_URL . '/jadwal/');
$batch = get_schedule_by_id($batchId);
if (!$batch || $batch['is_public'] != 1) { http_response_code(404); include __DIR__.'/../404.php'; exit; }

$sisa   = $batch['max_participants'] - $batch['current_participants'];
$isFull = $batch['status'] === 'full' || ($batch['max_participants'] > 0 && $sisa <= 0);
if ($isFull) redirect(SITE_URL . '/jadwal/' . $batchId . '/');

$errors = [];
$success = false;
$regCode = '';

if (isset($_GET['sent'], $_SESSION['registration_success']) && is_array($_SESSION['registration_success']) && (int)($_SESSION['registration_success']['batch_id'] ?? 0) === $batchId) {
    $success = true;
    $regCode = (string)$_SESSION['registration_success']['reg_code'];
    unset($_SESSION['registration_success']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && verify_csrf()) {
    $data = [
        'batch_id'   => $batchId,
        'name'       => sanitize($_POST['name']    ?? ''),
        'email'      => sanitize($_POST['email']   ?? ''),
        'phone'      => sanitize($_POST['phone']   ?? ''),
        'company'    => sanitize($_POST['company'] ?? ''),
        'jabatan'    => sanitize($_POST['jabatan'] ?? ''),
        'nik'        => sanitize($_POST['nik']     ?? ''),
    ];

    if ($data['name'] === '') $errors[] = 'Nama lengkap wajib diisi.';
    if ($data['phone'] === '') $errors[] = 'Nomor WhatsApp wajib diisi.';
    if ($data['email'] !== '' && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) $errors[] = 'Alamat email tidak valid.';

    if (!$errors) {
        $saved = save_registration($data);
        if (!empty($saved['success'])) {
            $regCode = $saved['reg_code'] ?? '';
            // Complete the browser request immediately. SMTP is intentionally not
            // run here: a slow/unavailable mail server must never turn a saved
            // registration into an HTTP 500 response for the visitor.
            $_SESSION['registration_success'] = ['batch_id'=>$batchId, 'reg_code'=>$regCode];
            redirect(SITE_URL . '/jadwal/daftar/'.$batchId.'/?sent=1', 303);
        } else {
            $errors[] = 'Pendaftaran belum dapat disimpan. Silakan coba lagi.';
        }
    }
}

$s = get_all_settings();
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Daftar Pelatihan <?= e($batch['training_name']) ?> | Wahana Totalita</title>
<meta name="robots" content="noindex, follow">
<link rel="stylesheet" href="<?= asset_v('/assets/css/style.css') ?>">
<?= theme_css_vars($s) ?>
<style>
.reg-page{max-width:680px;margin:60px auto;padding:0 20px}
.reg-card{background:#fff;border-radius:16px;border:1px solid #eee;box-shadow:0 4px 20px rgba(0,0,0,.08);overflow:hidden}
.reg-card-header{background:linear-gradient(135deg,var(--green),#1a5c3a);padding:28px 32px;color:#fff}
.reg-card-header h1{font-size:1.3rem;font-weight:800;margin:0 0 6px}
.reg-card-header p{font-size:.875rem;opacity:.8;margin:0}
.reg-card-body{padding:32px}
.form-group{margin-bottom:20px}
.form-group label{display:block;font-weight:600;margin-bottom:6px;font-size:.9rem;color:#333}
.form-group input{width:100%;box-sizing:border-box;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:.95rem;font-family:inherit}
.form-group input:focus{outline:none;border-color:var(--green);box-shadow:0 0 0 3px rgba(10,74,46,.1)}
.form-group .hint{font-size:.78rem;color:#999;margin-top:4px}
.btn-submit{width:100%;background:var(--orange);color:#fff;border:none;padding:14px;border-radius:12px;font-size:1.1rem;font-weight:700;cursor:pointer}
.btn-submit:hover{background:var(--orange-dark)}
.error-box{background:#fee2e2;color:#991b1b;border:1px solid #fecaca;padding:14px 20px;border-radius:8px;margin-bottom:20px}
.success-box{background:#dcfce7;color:#166534;border:1px solid #bbf7d0;padding:28px;border-radius:12px;text-align:center}
.success-box .reg-code{font-size:2rem;font-weight:800;font-family:monospace;color:var(--green);background:#f0f9f0;padding:12px 24px;border-radius:8px;display:inline-block;margin:12px 0}
.batch-summary{background:#f0f9f0;border-radius:8px;padding:16px;margin-bottom:24px;font-size:.875rem}
.batch-summary .row{display:flex;justify-content:space-between;padding:4px 0}
.batch-summary .row .val{font-weight:600}
</style>
</head>
<body>
<?php include __DIR__ . '/../includes/navbar.php'; ?>

<div class="reg-page">
  <?php if ($success): ?>
  <div class="success-box">
    <div style="font-size:3rem;margin-bottom:12px">🎉</div>
    <h2 style="margin:0 0 8px">Pendaftaran Berhasil!</h2>
    <p>Kode registrasi Anda:</p>
    <div class="reg-code"><?= e($regCode) ?></div>
    <p style="margin:12px 0 20px;color:#555">Simpan kode ini untuk keperluan verifikasi dan pembayaran.<br>Tim kami akan menghubungi Anda via WhatsApp dalam 1x24 jam.</p>
    <a href="/jadwal/" style="display:inline-block;background:var(--green);color:#fff;padding:12px 28px;border-radius:8px;text-decoration:none;font-weight:600">← Lihat Jadwal Lain</a>
    <a href="<?= wa_url('Halo, kode registrasi saya adalah '.$regCode.'. Saya ingin konfirmasi pembayaran pelatihan '.$batch['training_name'], '6287759151278') ?>" style="display:inline-block;background:var(--orange);color:#fff;padding:12px 28px;border-radius:8px;text-decoration:none;font-weight:600;margin-left:12px">💬 Konfirmasi Pembayaran</a>
  </div>

  <?php else: ?>
  <div class="reg-card">
    <div class="reg-card-header">
      <h1>📝 Form Pendaftaran</h1>
      <p><?= e($batch['training_name']) ?></p>
    </div>
    <div class="reg-card-body">
      <div class="batch-summary">
        <div class="row"><span>Tanggal</span><span class="val"><?= format_date($batch['start_date']) ?></span></div>
        <div class="row"><span>Mode</span><span class="val"><?= strtoupper($batch['mode'] ?? 'OFFLINE') ?></span></div>
        <?php if ($batch['location']): ?><div class="row"><span>Lokasi</span><span class="val"><?= e($batch['location']) ?></span></div><?php endif; ?>
        <div class="row"><span>Biaya</span><span class="val"><?= $batch['price'] > 0 ? format_price((int)$batch['price']) : 'GRATIS' ?></span></div>
        <?php if ($batch['max_participants'] > 0): ?><div class="row"><span>Sisa Kursi</span><span class="val" style="color:var(--orange)"><?= $sisa ?> kursi</span></div><?php endif; ?>
      </div>

      <?php if (!empty($errors)): ?>
      <div class="error-box">
        <?php foreach ($errors as $e_msg): ?><div>❌ <?= e($e_msg) ?></div><?php endforeach; ?>
      </div>
      <?php endif; ?>

      <form method="POST" action="">
        <?= csrf_field() ?>
        <div class="form-group">
          <label>Nama Lengkap</label>
          <input type="text" name="name" value="<?= e($_POST['name'] ?? '') ?>" placeholder="Sesuai KTP" required>
        </div>
        <div class="form-group">
          <label>Email (opsional)</label>
          <input type="email" name="email" value="<?= e($_POST['email'] ?? '') ?>" placeholder="email@aktif.com">
          <div class="hint">Sertifikat dan konfirmasi dikirim ke email ini</div>
        </div>
        <div class="form-group">
          <label>Nomor WhatsApp</label>
          <input type="tel" name="phone" value="<?= e($_POST['phone'] ?? '') ?>" placeholder="08xxxxxxxxxx" required>
          <div class="hint">Untuk konfirmasi dan informasi pelatihan</div>
        </div>
        <div class="form-group">
          <label>Perusahaan / Instansi</label>
          <input type="text" name="company" value="<?= e($_POST['company'] ?? '') ?>" placeholder="PT / CV / Dinas ...">
        </div>
        <div class="form-group">
          <label>Jabatan</label>
          <input type="text" name="jabatan" value="<?= e($_POST['jabatan'] ?? '') ?>" placeholder="Jabatan Anda">
        </div>
        <div class="form-group">
          <label>NIK (opsional)</label>
          <input type="text" name="nik" value="<?= e($_POST['nik'] ?? '') ?>" placeholder="16 digit NIK KTP" maxlength="16">
          <div class="hint">Diperlukan untuk penerbitan sertifikat BNSP</div>
        </div>
        <button type="submit" class="btn-submit">Kirim Pendaftaran</button>
      </form>

      <div style="margin-top:20px;text-align:center;font-size:.85rem;color:#999">
        Butuh bantuan pendaftaran? <a href="<?= wa_url('Halo, saya butuh bantuan mendaftar pelatihan '.$batch['training_name'], '6287759151278') ?>" style="color:var(--green)">Chat WhatsApp</a>
      </div>
    </div>
  </div>
  <?php endif; ?>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
<script src="/assets/js/main.js"></script>
</body></html>
