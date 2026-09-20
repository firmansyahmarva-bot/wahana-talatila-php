<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/workplace-functions.php';

$session = wp_require_login();
$accountId = $session['account_id'];
$s = get_all_settings();
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_employee'])) {
    if (verify_csrf()) {
        $full_name   = trim($_POST['full_name'] ?? '');
        $cert_type   = trim($_POST['cert_type'] ?? '');
        $expiry_date = $_POST['expiry_date'] ?? '';
        if ($full_name && $cert_type && $expiry_date) {
            wp_add_employee($accountId, [
                'full_name'   => $full_name,
                'position'    => $_POST['position'] ?? '',
                'cert_type'   => $cert_type,
                'cert_number' => $_POST['cert_number'] ?? '',
                'expiry_date' => $expiry_date,
            ]);
            $message = 'Karyawan berhasil ditambahkan.';
        }
    }
}

if (isset($_GET['delete']) && isset($_GET['csrf']) && csrf_verify($_GET['csrf'])) {
    wp_delete_employee($accountId, (int)$_GET['delete']);
    redirect(SITE_URL . '/workplace/dashboard/');
}

$data = wp_dashboard_data($accountId);

$status_label = ['valid' => 'Berlaku', 'expiring' => 'Segera Habis', 'expired' => 'Kadaluarsa'];
$status_color = ['valid' => '#166534', 'expiring' => '#92400e', 'expired' => '#991b1b'];
$status_bg    = ['valid' => '#dcfce7', 'expiring' => '#fef3c7', 'expired' => '#fee2e2'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard — <?= e($session['company_name']) ?> | Workplace K3</title>
<meta name="robots" content="noindex">
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
<?= theme_css_vars($s) ?>
<style>
body{background:#f0f4f8}
.wp-navbar{background:#fff;border-bottom:1px solid #eee;padding:0 24px;display:flex;align-items:center;justify-content:space-between;height:60px;position:sticky;top:0;z-index:100;box-shadow:0 2px 8px rgba(0,0,0,.06)}
.wp-navbar .brand{font-weight:800;color:var(--green);font-size:1.05rem}
.wp-navbar a{color:#999;font-size:.85rem;text-decoration:none}
.wp-navbar a:hover{color:var(--green)}
.wp-wrap{max-width:1000px;margin:0 auto;padding:28px 20px}
.wp-msg{background:#dcfce7;color:#166534;padding:12px 16px;border-radius:8px;font-size:13px;margin-bottom:20px}
.cards{display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:16px;margin-bottom:28px}
.stat-card{background:#fff;border-radius:12px;border:1px solid #eee;padding:20px;box-shadow:0 2px 8px rgba(0,0,0,.05)}
.stat-card .value{font-size:2rem;font-weight:800;color:var(--green);line-height:1.2}
.stat-card .label{font-size:.8rem;color:#999;margin-top:4px}
.stat-card.score{background:linear-gradient(135deg,var(--green),#1a5c3a);color:#fff}
.stat-card.score .value{color:#fff}
.stat-card.score .label{color:rgba(255,255,255,.8)}
.stat-card.warning .value{color:var(--orange)}
.stat-card.danger .value{color:#ef4444}
.section-card{background:#fff;border-radius:12px;border:1px solid #eee;margin-bottom:20px;padding:22px}
.section-card h2{font-size:1rem;font-weight:700;margin:0 0 16px;color:var(--green)}
.formgrid{display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:12px;align-items:end}
.formgrid label{display:block;font-size:.78rem;font-weight:600;color:#444;margin-bottom:5px}
.formgrid input{width:100%;box-sizing:border-box;padding:10px 12px;border:1.5px solid #ddd;border-radius:8px;font-size:.875rem;font-family:inherit}
.formgrid input:focus{outline:none;border-color:var(--green)}
.btn-add{background:var(--green);color:#fff;border:none;padding:10px 20px;border-radius:8px;font-weight:700;font-size:.85rem;cursor:pointer;white-space:nowrap}
.btn-add:hover{background:#0d5c38}
.table{width:100%;border-collapse:collapse;font-size:.875rem}
.table th{background:#f9fafb;padding:10px 12px;text-align:left;color:#666;font-size:.75rem;font-weight:700;text-transform:uppercase;border-bottom:1px solid #f0f0f0}
.table td{padding:10px 12px;border-bottom:1px solid #f5f5f5;color:#333}
.table tr:hover td{background:#f9fafb}
.badge{display:inline-block;padding:3px 10px;border-radius:100px;font-size:.72rem;font-weight:700}
.del-link{color:#b91c1c;font-size:.78rem;font-weight:700;text-decoration:none}
.empty{color:#999;font-size:.875rem;padding:16px 0;text-align:center}
@media(max-width:768px){.wp-wrap{padding:16px}}
</style>
</head>
<body>
<nav class="wp-navbar">
  <div class="brand">🏢 <?= e($session['company_name']) ?></div>
  <div style="display:flex;gap:16px;align-items:center">
    <a href="/workplace/logout.php">Logout</a>
  </div>
</nav>

<div class="wp-wrap">
  <?php if ($message): ?><div class="wp-msg"><?= e($message) ?></div><?php endif; ?>

  <div class="cards">
    <div class="stat-card score"><div class="value"><?= $data['k3_score'] ?>%</div><div class="label">K3 Score</div></div>
    <div class="stat-card"><div class="value"><?= $data['total'] ?></div><div class="label">Total Karyawan Tercatat</div></div>
    <div class="stat-card warning"><div class="value"><?= $data['expiring'] ?></div><div class="label">Segera Habis (30 Hari)</div></div>
    <div class="stat-card danger"><div class="value"><?= $data['expired'] ?></div><div class="label">Kadaluarsa</div></div>
  </div>

  <div class="section-card">
    <h2>Tambah Karyawan</h2>
    <form method="POST">
      <?= csrf_field() ?>
      <input type="hidden" name="add_employee" value="1">
      <div class="formgrid">
        <div><label>Nama Lengkap</label><input type="text" name="full_name" required></div>
        <div><label>Posisi</label><input type="text" name="position"></div>
        <div><label>Jenis Sertifikat</label><input type="text" name="cert_type" placeholder="AK3 Umum" required></div>
        <div><label>No. Sertifikat</label><input type="text" name="cert_number"></div>
        <div><label>Tanggal Kadaluarsa</label><input type="date" name="expiry_date" required></div>
        <div><button type="submit" class="btn-add">+ Tambah</button></div>
      </div>
    </form>
  </div>

  <div class="section-card">
    <h2>Status Sertifikat Karyawan</h2>
    <?php if (empty($data['employees'])): ?>
    <p class="empty">Belum ada data karyawan. Tambahkan menggunakan form di atas.</p>
    <?php else: ?>
    <table class="table">
      <thead><tr><th>Nama</th><th>Posisi</th><th>Sertifikat</th><th>Kadaluarsa</th><th>Status</th><th></th></tr></thead>
      <tbody>
      <?php foreach ($data['employees'] as $e): $st = wp_cert_status($e['expiry_date']); ?>
      <tr>
        <td><?= e($e['full_name']) ?></td>
        <td><?= e($e['position'] ?: '—') ?></td>
        <td><?= e($e['cert_type']) ?></td>
        <td><?= e(date('d M Y', strtotime($e['expiry_date']))) ?></td>
        <td><span class="badge" style="color:<?= $status_color[$st] ?>;background:<?= $status_bg[$st] ?>"><?= $status_label[$st] ?></span></td>
        <td><a class="del-link" href="?delete=<?= $e['id'] ?>&csrf=<?= urlencode(csrf_token()) ?>" onclick="return confirm('Hapus data karyawan ini?')">Hapus</a></td>
      </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    <?php endif; ?>
  </div>
</div>

<script src="<?= SITE_URL ?>/assets/js/main.js"></script>
</body></html>
