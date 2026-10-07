<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/workplace-functions.php';

wp_require_login('hse_manager');
$session = wp_get_session();
$company = get_company($session['company_id']);
$data    = get_hse_dashboard($session['company_id']);
$s = get_all_settings();
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>HSE Dashboard — <?= e($company['name'] ?? '') ?></title>
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
.wp-navbar .user-info{font-size:.85rem;color:#666}
.wp-navbar a{color:#999;font-size:.85rem;text-decoration:none}
.wp-navbar a:hover{color:var(--green)}
.wp-layout{display:flex;min-height:calc(100vh - 60px)}
.sidebar{width:220px;background:#fff;border-right:1px solid #eee;padding:20px 0;flex-shrink:0;position:sticky;top:60px;height:calc(100vh - 60px);overflow-y:auto}
.sidebar-item{display:flex;gap:12px;align-items:center;padding:12px 20px;text-decoration:none;color:#555;font-size:.875rem;border-left:3px solid transparent;transition:.2s}
.sidebar-item:hover,.sidebar-item.active{color:var(--green);background:#f0f9f0;border-left-color:var(--green)}
.sidebar-item .icon{width:20px;text-align:center}
.sidebar-section{padding:16px 20px 6px;font-size:.72rem;color:#999;text-transform:uppercase;letter-spacing:1px;font-weight:700}
.main-content{flex:1;padding:24px;max-width:1100px}
.score-card{background:linear-gradient(135deg,var(--green),#1a5c3a);border-radius:16px;padding:28px;color:#fff;margin-bottom:24px}
.score-circle{width:100px;height:100px;border-radius:50%;background:rgba(255,255,255,.15);display:flex;align-items:center;justify-content:center;flex-direction:column}
.score-circle .score-num{font-size:2.2rem;font-weight:800;line-height:1}
.score-circle .score-label{font-size:.7rem;opacity:.7}
.stats-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:16px;margin-bottom:24px}
.stat-card{background:#fff;border-radius:12px;border:1px solid #eee;padding:20px;box-shadow:0 2px 8px rgba(0,0,0,.05)}
.stat-card .value{font-size:2rem;font-weight:800;color:var(--green);line-height:1.2}
.stat-card .label{font-size:.8rem;color:#999;margin-top:4px}
.stat-card.warning .value{color:var(--orange)}
.stat-card.danger .value{color:#ef4444}
.section-card{background:#fff;border-radius:12px;border:1px solid #eee;margin-bottom:20px;overflow:hidden}
.section-header{padding:16px 20px;border-bottom:1px solid #f0f0f0;display:flex;align-items:center;justify-content:space-between}
.section-header h2{font-size:.95rem;font-weight:700;margin:0;color:var(--green)}
.table{width:100%;border-collapse:collapse;font-size:.875rem}
.table th{background:#f9fafb;padding:10px 16px;text-align:left;color:#666;font-size:.78rem;font-weight:600;border-bottom:1px solid #f0f0f0}
.table td{padding:10px 16px;border-bottom:1px solid #f5f5f5;color:#333}
.table tr:last-child td{border-bottom:none}
.table tr:hover td{background:#f9fafb}
.badge{display:inline-block;padding:2px 8px;border-radius:100px;font-size:.72rem;font-weight:700}
.badge-ok{background:#d1fae5;color:#065f46}
.badge-warn{background:#fef3c7;color:#92400e}
.badge-danger{background:#fee2e2;color:#991b1b}
.progress-bar{height:8px;background:#e5e7eb;border-radius:100px;overflow:hidden;min-width:80px}
.progress-fill{height:100%;background:var(--green);border-radius:100px}
.progress-fill.warn{background:var(--orange)}
.progress-fill.danger{background:#ef4444}
.logout-btn{background:none;border:1px solid #ddd;padding:6px 14px;border-radius:6px;cursor:pointer;font-size:.8rem;color:#666}
.logout-btn:hover{border-color:#ef4444;color:#ef4444}
@media(max-width:768px){.wp-layout{flex-direction:column}.sidebar{width:100%;height:auto;position:static;display:flex;overflow-x:auto;padding:0}.sidebar-item{flex-shrink:0;border-left:none;border-bottom:3px solid transparent}.main-content{padding:16px}}
</style>
</head>
<body>
<nav class="wp-navbar">
  <div class="brand">🏢 <?= e($company['name'] ?? 'Workplace K3') ?></div>
  <div style="display:flex;gap:16px;align-items:center">
    <span class="user-info">👤 <?= e($session['user']['full_name'] ?? '') ?> <span style="background:#dcfce7;color:#166534;padding:2px 8px;border-radius:100px;font-size:.72rem;font-weight:700;margin-left:4px">HSE MANAGER</span></span>
    <a href="/workplace/logout.php">Logout</a>
  </div>
</nav>

<div class="wp-layout">
  <div class="sidebar">
    <div class="sidebar-section">Menu Utama</div>
    <a href="/workplace/dashboard-hse/" class="sidebar-item active"><span class="icon">📊</span> Dashboard</a>
    <a href="/workplace/karyawan/"      class="sidebar-item"><span class="icon">👥</span> Karyawan</a>
    <a href="/workplace/sertifikat/"    class="sidebar-item"><span class="icon">📜</span> Sertifikat</a>
    <a href="/workplace/pelatihan/"     class="sidebar-item"><span class="icon">📅</span> Pelatihan</a>
    <div class="sidebar-section">Laporan</div>
    <a href="/workplace/laporan/"       class="sidebar-item"><span class="icon">📈</span> Laporan K3</a>
    <a href="/workplace/reminder/"      class="sidebar-item"><span class="icon">🔔</span> Reminder</a>
    <div class="sidebar-section">Akun</div>
    <a href="/workplace/pengaturan/"    class="sidebar-item"><span class="icon">⚙️</span> Pengaturan</a>
    <a href="/workplace/logout.php"     class="sidebar-item"><span class="icon">🚪</span> Logout</a>
  </div>

  <div class="main-content">
    <!-- K3 Score -->
    <div class="score-card">
      <div style="display:flex;align-items:center;gap:24px;flex-wrap:wrap">
        <div class="score-circle">
          <span class="score-num"><?= $data['k3_score'] ?? 0 ?></span>
          <span class="score-label">K3 SCORE</span>
        </div>
        <div>
          <h2 style="margin:0 0 6px;font-size:1.3rem">K3 Score Perusahaan</h2>
          <p style="margin:0 0 12px;opacity:.8;font-size:.9rem">
            <?php
            $sc = $data['k3_score'] ?? 0;
            if ($sc >= 80) echo '✅ Excellent — Compliance K3 sangat baik';
            elseif ($sc >= 60) echo '⚠️ Good — Masih ada ruang improvement';
            elseif ($sc >= 40) echo '⚠️ Fair — Perlu perhatian serius';
            else echo '🚨 Poor — Diperlukan tindakan segera';
            ?>
          </p>
          <div style="display:flex;gap:20px;font-size:.8rem;opacity:.8;flex-wrap:wrap">
            <span>Sertifikat valid: <strong><?= ($data['cert_coverage'] ?? 0) ?>%</strong></span>
            <span>Pelatihan rutin: <strong><?= ($data['training_score'] ?? 0) ?>/30</strong></span>
            <span>Profil lengkap: <strong><?= ($data['profile_score'] ?? 0) ?>/30</strong></span>
          </div>
        </div>
        <div style="margin-left:auto">
          <a href="/jadwal/" style="background:var(--orange);color:#fff;padding:10px 20px;border-radius:8px;text-decoration:none;font-weight:600;font-size:.875rem">📅 Tingkatkan Score</a>
        </div>
      </div>
    </div>

    <!-- Stats -->
    <div class="stats-grid">
      <div class="stat-card">
        <div class="value"><?= $data['total_employees'] ?? 0 ?></div>
        <div class="label">Total Karyawan</div>
      </div>
      <div class="stat-card <?= ($data['cert_expiring_30'] ?? 0) > 0 ? 'warning' : '' ?>">
        <div class="value"><?= $data['cert_expiring_30'] ?? 0 ?></div>
        <div class="label">Sertifikat Kadaluarsa 30 Hari</div>
      </div>
      <div class="stat-card <?= ($data['cert_expired'] ?? 0) > 0 ? 'danger' : '' ?>">
        <div class="value"><?= $data['cert_expired'] ?? 0 ?></div>
        <div class="label">Sertifikat Sudah Kadaluarsa</div>
      </div>
      <div class="stat-card">
        <div class="value"><?= $data['trained_this_year'] ?? 0 ?></div>
        <div class="label">Dilatih Tahun Ini</div>
      </div>
    </div>

    <!-- Employees needing attention -->
    <?php if (!empty($data['expiring_certs'])): ?>
    <div class="section-card">
      <div class="section-header">
        <h2>⚠️ Sertifikat Segera Kadaluarsa</h2>
        <a href="/workplace/sertifikat/" style="font-size:.8rem;color:var(--green);text-decoration:none">Lihat semua →</a>
      </div>
      <table class="table">
        <thead><tr><th>Karyawan</th><th>Sertifikat</th><th>Kadaluarsa</th><th>Status</th><th>Aksi</th></tr></thead>
        <tbody>
          <?php foreach (array_slice($data['expiring_certs'], 0, 8) as $cert):
            $daysLeft = ceil((strtotime($cert['expiry_date']) - time()) / 86400);
          ?>
          <tr>
            <td><?= e($cert['employee_name']) ?></td>
            <td><?= e($cert['cert_name']) ?></td>
            <td><?= format_date($cert['expiry_date']) ?></td>
            <td>
              <?php if ($daysLeft < 0): ?><span class="badge badge-danger">KADALUARSA</span>
              <?php elseif ($daysLeft <= 7): ?><span class="badge badge-danger"><?= $daysLeft ?> hari lagi</span>
              <?php elseif ($daysLeft <= 30): ?><span class="badge badge-warn"><?= $daysLeft ?> hari lagi</span>
              <?php else: ?><span class="badge badge-warn"><?= $daysLeft ?> hari lagi</span>
              <?php endif; ?>
            </td>
            <td><a href="/jadwal/" style="font-size:.8rem;color:var(--green);font-weight:600">Daftar Renewal</a></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <?php endif; ?>

    <!-- All Employees K3 Status -->
    <?php if (!empty($data['employees'])): ?>
    <div class="section-card">
      <div class="section-header">
        <h2>👥 Status K3 Karyawan</h2>
        <a href="/workplace/karyawan/" style="font-size:.8rem;color:var(--green);text-decoration:none">Kelola karyawan →</a>
      </div>
      <table class="table">
        <thead><tr><th>Nama</th><th>Jabatan</th><th>Sertifikat Aktif</th><th>K3 Score</th><th>Status</th></tr></thead>
        <tbody>
          <?php foreach (array_slice($data['employees'], 0, 10) as $emp):
            $pct = min(100, (int)($emp['k3_score'] ?? 0));
            $fillClass = $pct >= 70 ? '' : ($pct >= 40 ? 'warn' : 'danger');
            $badgeClass = $pct >= 70 ? 'badge-ok' : ($pct >= 40 ? 'badge-warn' : 'badge-danger');
          ?>
          <tr>
            <td><?= e($emp['name']) ?></td>
            <td><?= e($emp['jabatan'] ?? '—') ?></td>
            <td><?= (int)($emp['active_certs'] ?? 0) ?></td>
            <td>
              <div style="display:flex;align-items:center;gap:8px">
                <div class="progress-bar"><div class="progress-fill <?= $fillClass ?>" style="width:<?= $pct ?>%"></div></div>
                <span style="font-size:.8rem;font-weight:600"><?= $pct ?></span>
              </div>
            </td>
            <td><span class="badge <?= $badgeClass ?>"><?= $pct >= 70 ? 'BAIK' : ($pct >= 40 ? 'PERLU PERHATIAN' : 'KRITIS') ?></span></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <?php endif; ?>

    <!-- Quick Actions -->
    <div style="display:flex;gap:12px;flex-wrap:wrap;margin-top:8px">
      <a href="/jadwal/" style="display:inline-block;background:var(--orange);color:#fff;padding:12px 20px;border-radius:8px;text-decoration:none;font-weight:600;font-size:.875rem">📅 Daftarkan Karyawan ke Pelatihan</a>
      <a href="<?= wa_url('Halo, saya HSE Manager dan ingin konsultasi program K3 perusahaan kami') ?>" style="display:inline-block;background:var(--green);color:#fff;padding:12px 20px;border-radius:8px;text-decoration:none;font-weight:600;font-size:.875rem">💬 Konsultasi dengan Tim K3</a>
    </div>
  </div>
</div>

<script src="<?= SITE_URL ?>/assets/js/main.js"></script>
</body></html>
