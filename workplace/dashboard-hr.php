<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/workplace-functions.php';

wp_require_login('hr_manager');
$session = wp_get_session();
$company = get_company($session['company_id']);
$s = get_all_settings();

// HR-specific data
try {
    $pdo = get_pdo();
    $cid = $session['company_id'];

    $totalEmp = $pdo->prepare('SELECT COUNT(*) FROM workplace_employees WHERE company_id=? AND is_active=1');
    $totalEmp->execute([$cid]); $totalEmp = (int)$totalEmp->fetchColumn();

    $noK3  = $pdo->prepare('SELECT COUNT(*) FROM workplace_employees e WHERE e.company_id=? AND e.is_active=1 AND (SELECT COUNT(*) FROM employee_certs c WHERE c.employee_id=e.id AND c.is_active=1)=0');
    $noK3->execute([$cid]); $noK3 = (int)$noK3->fetchColumn();

    $newThisMonth = $pdo->prepare("SELECT COUNT(*) FROM workplace_employees WHERE company_id=? AND is_active=1 AND DATE_FORMAT(created_at,'%Y-%m')=DATE_FORMAT(NOW(),'%Y-%m')");
    $newThisMonth->execute([$cid]); $newThisMonth = (int)$newThisMonth->fetchColumn();

    $pendingTraining = $pdo->prepare("SELECT COUNT(*) FROM training_registrations tr JOIN training_batches tb ON tr.batch_id=tb.id WHERE tr.company_id=? AND tr.status='confirmed' AND tb.start_date > NOW()");
    $pendingTraining->execute([$cid]); $pendingTraining = (int)$pendingTraining->fetchColumn();

    $employees = $pdo->prepare('SELECT e.*, (SELECT COUNT(*) FROM employee_certs c WHERE c.employee_id=e.id AND c.is_active=1) as active_certs, e.k3_score FROM workplace_employees e WHERE e.company_id=? AND e.is_active=1 ORDER BY e.name ASC LIMIT 20');
    $employees->execute([$cid]); $employees = $employees->fetchAll();

    $upcomingTraining = $pdo->prepare("SELECT tr.*, tb.start_date, tb.end_date, t.name as training_name, e.name as employee_name FROM training_registrations tr JOIN training_batches tb ON tr.batch_id=tb.id JOIN trainings t ON tb.training_id=t.id LEFT JOIN workplace_employees e ON tr.employee_id=e.id WHERE tr.company_id=? AND tr.status IN ('confirmed','pending') AND tb.start_date > NOW() ORDER BY tb.start_date ASC LIMIT 10");
    $upcomingTraining->execute([$cid]); $upcomingTraining = $upcomingTraining->fetchAll();

    $certsByDept = $pdo->prepare('SELECT e.department, COUNT(e.id) as total_emp, SUM(CASE WHEN ec.id IS NOT NULL THEN 1 ELSE 0 END) as has_cert FROM workplace_employees e LEFT JOIN employee_certs ec ON ec.employee_id=e.id AND ec.is_active=1 WHERE e.company_id=? AND e.is_active=1 GROUP BY e.department ORDER BY total_emp DESC LIMIT 8');
    $certsByDept->execute([$cid]); $certsByDept = $certsByDept->fetchAll();

} catch (Exception $ex) {
    $totalEmp = $noK3 = $newThisMonth = $pendingTraining = 0;
    $employees = $upcomingTraining = $certsByDept = [];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>HR Dashboard — <?= e($company['name'] ?? '') ?></title>
<meta name="robots" content="noindex">
<link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/style.css">
<?= theme_css_vars($s) ?>
<style>
body{background:#f0f4f8}
.wp-navbar{background:#fff;border-bottom:1px solid #eee;padding:0 24px;display:flex;align-items:center;justify-content:space-between;height:60px;position:sticky;top:0;z-index:100;box-shadow:0 2px 8px rgba(0,0,0,.06)}
.wp-navbar .brand{font-weight:800;color:#7c3aed;font-size:1.05rem}
.wp-layout{display:flex;min-height:calc(100vh - 60px)}
.sidebar{width:220px;background:#fff;border-right:1px solid #eee;padding:20px 0;flex-shrink:0;position:sticky;top:60px;height:calc(100vh - 60px);overflow-y:auto}
.sidebar-item{display:flex;gap:12px;align-items:center;padding:12px 20px;text-decoration:none;color:#555;font-size:.875rem;border-left:3px solid transparent;transition:.2s}
.sidebar-item:hover,.sidebar-item.active{color:#7c3aed;background:#f5f3ff;border-left-color:#7c3aed}
.sidebar-section{padding:16px 20px 6px;font-size:.72rem;color:#999;text-transform:uppercase;letter-spacing:1px;font-weight:700}
.main-content{flex:1;padding:24px;max-width:1100px}
.page-header{margin-bottom:24px}
.page-header h1{font-size:1.4rem;font-weight:800;margin:0 0 4px;color:#1a1a1a}
.page-header p{color:#666;margin:0;font-size:.875rem}
.stats-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:16px;margin-bottom:24px}
.stat-card{background:#fff;border-radius:12px;border:1px solid #eee;padding:20px;box-shadow:0 2px 8px rgba(0,0,0,.05)}
.stat-card .value{font-size:2rem;font-weight:800;line-height:1.2}
.stat-card .label{font-size:.8rem;color:#999;margin-top:4px}
.stat-card.purple .value{color:#7c3aed}
.stat-card.orange .value{color:var(--orange)}
.stat-card.red .value{color:#ef4444}
.stat-card.green .value{color:var(--green)}
.section-card{background:#fff;border-radius:12px;border:1px solid #eee;margin-bottom:20px;overflow:hidden}
.section-header{padding:16px 20px;border-bottom:1px solid #f0f0f0;display:flex;align-items:center;justify-content:space-between}
.section-header h2{font-size:.95rem;font-weight:700;margin:0;color:#7c3aed}
.table{width:100%;border-collapse:collapse;font-size:.875rem}
.table th{background:#f9fafb;padding:10px 16px;text-align:left;color:#666;font-size:.78rem;font-weight:600;border-bottom:1px solid #f0f0f0}
.table td{padding:10px 16px;border-bottom:1px solid #f5f5f5;color:#333}
.table tr:last-child td{border-bottom:none}
.badge{display:inline-block;padding:2px 8px;border-radius:100px;font-size:.72rem;font-weight:700}
.badge-ok{background:#d1fae5;color:#065f46}
.badge-warn{background:#fef3c7;color:#92400e}
.badge-purple{background:#ede9fe;color:#5b21b6}
.progress-bar{height:8px;background:#e5e7eb;border-radius:100px;overflow:hidden;min-width:80px}
.progress-fill{height:100%;background:#7c3aed;border-radius:100px}
.quick-actions{display:flex;gap:12px;flex-wrap:wrap;margin-top:8px}
@media(max-width:768px){.wp-layout{flex-direction:column}.sidebar{width:100%;height:auto;position:static;display:flex;overflow-x:auto;padding:0}.sidebar-item{flex-shrink:0;border-left:none;border-bottom:3px solid transparent}.main-content{padding:16px}}
</style>
</head>
<body>
<nav class="wp-navbar">
  <div class="brand">🏢 <?= e($company['name'] ?? 'HR Workplace') ?></div>
  <div style="display:flex;gap:16px;align-items:center">
    <span style="font-size:.85rem;color:#666">👤 <?= e($session['user']['full_name'] ?? '') ?> <span style="background:#ede9fe;color:#5b21b6;padding:2px 8px;border-radius:100px;font-size:.72rem;font-weight:700;margin-left:4px">HR MANAGER</span></span>
    <a href="/workplace/logout.php" style="font-size:.85rem;color:#999;text-decoration:none">Logout</a>
  </div>
</nav>

<div class="wp-layout">
  <div class="sidebar">
    <div class="sidebar-section">Menu Utama</div>
    <a href="/workplace/dashboard-hr/" class="sidebar-item active"><span>📊</span> Dashboard</a>
    <a href="/workplace/karyawan/"     class="sidebar-item"><span>👥</span> Data Karyawan</a>
    <a href="/workplace/pelatihan/"    class="sidebar-item"><span>📅</span> Pelatihan</a>
    <a href="/workplace/sertifikat/"   class="sidebar-item"><span>📜</span> Sertifikat</a>
    <div class="sidebar-section">Laporan</div>
    <a href="/workplace/laporan/"      class="sidebar-item"><span>📈</span> Laporan HR</a>
    <div class="sidebar-section">Akun</div>
    <a href="/workplace/pengaturan/"   class="sidebar-item"><span>⚙️</span> Pengaturan</a>
    <a href="/workplace/logout.php"    class="sidebar-item"><span>🚪</span> Logout</a>
  </div>

  <div class="main-content">
    <div class="page-header">
      <h1>👥 HR Dashboard</h1>
      <p>Kelola data karyawan, pelatihan, dan compliance K3 SDM perusahaan Anda</p>
    </div>

    <!-- Stats -->
    <div class="stats-grid">
      <div class="stat-card purple">
        <div class="value"><?= $totalEmp ?></div>
        <div class="label">Total Karyawan Aktif</div>
      </div>
      <div class="stat-card green">
        <div class="value"><?= $newThisMonth ?></div>
        <div class="label">Karyawan Baru Bulan Ini</div>
      </div>
      <div class="stat-card orange">
        <div class="value"><?= $pendingTraining ?></div>
        <div class="label">Pelatihan Terjadwal</div>
      </div>
      <div class="stat-card <?= $noK3 > 0 ? 'red' : 'green' ?>">
        <div class="value"><?= $noK3 ?></div>
        <div class="label">Karyawan Tanpa Sertifikat K3</div>
      </div>
    </div>

    <!-- Certification by Department -->
    <?php if (!empty($certsByDept)): ?>
    <div class="section-card">
      <div class="section-header">
        <h2>📊 Status Sertifikasi per Departemen</h2>
        <a href="/jadwal/" style="font-size:.8rem;color:#7c3aed;text-decoration:none">Daftarkan Pelatihan →</a>
      </div>
      <table class="table">
        <thead><tr><th>Departemen</th><th>Karyawan</th><th>Punya Sertifikat</th><th>Coverage</th></tr></thead>
        <tbody>
          <?php foreach ($certsByDept as $d):
            $pct = $d['total_emp'] > 0 ? round($d['has_cert'] / $d['total_emp'] * 100) : 0;
          ?>
          <tr>
            <td><?= e($d['department'] ?: 'Tidak Ditentukan') ?></td>
            <td><?= (int)$d['total_emp'] ?></td>
            <td><?= (int)$d['has_cert'] ?></td>
            <td>
              <div style="display:flex;align-items:center;gap:8px">
                <div class="progress-bar" style="flex:1"><div class="progress-fill" style="width:<?= $pct ?>%;background:<?= $pct>=70?'var(--green)':($pct>=40?'var(--orange)':'#ef4444') ?>"></div></div>
                <span style="font-size:.8rem;font-weight:600;min-width:32px"><?= $pct ?>%</span>
              </div>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <?php endif; ?>

    <!-- Upcoming Training -->
    <?php if (!empty($upcomingTraining)): ?>
    <div class="section-card">
      <div class="section-header">
        <h2>📅 Pelatihan Mendatang</h2>
        <a href="/jadwal/" style="font-size:.8rem;color:#7c3aed;text-decoration:none">Cari pelatihan →</a>
      </div>
      <table class="table">
        <thead><tr><th>Karyawan</th><th>Pelatihan</th><th>Tanggal</th><th>Status</th></tr></thead>
        <tbody>
          <?php foreach ($upcomingTraining as $tr): ?>
          <tr>
            <td><?= e($tr['employee_name'] ?? $tr['participant_name'] ?? '—') ?></td>
            <td><?= e($tr['training_name']) ?></td>
            <td><?= format_date($tr['start_date']) ?></td>
            <td><span class="badge badge-purple"><?= e(strtoupper($tr['status'])) ?></span></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <?php endif; ?>

    <!-- Employee List -->
    <div class="section-card">
      <div class="section-header">
        <h2>👥 Daftar Karyawan</h2>
        <a href="/workplace/karyawan/" style="font-size:.8rem;color:#7c3aed;text-decoration:none">Kelola semua →</a>
      </div>
      <?php if (empty($employees)): ?>
      <div style="padding:40px;text-align:center;color:#999">
        <p>Belum ada data karyawan.</p>
        <a href="/workplace/karyawan/tambah/" style="color:#7c3aed;font-weight:600">+ Tambah Karyawan</a>
      </div>
      <?php else: ?>
      <table class="table">
        <thead><tr><th>Nama</th><th>Jabatan</th><th>Departemen</th><th>Sertifikat Aktif</th><th>K3 Score</th></tr></thead>
        <tbody>
          <?php foreach ($employees as $emp):
            $score = (int)($emp['k3_score'] ?? 0);
            $badgeClass = $score >= 70 ? 'badge-ok' : ($score >= 40 ? 'badge-warn' : 'badge-danger');
          ?>
          <tr>
            <td><?= e($emp['name']) ?></td>
            <td><?= e($emp['jabatan'] ?? '—') ?></td>
            <td><?= e($emp['department'] ?? '—') ?></td>
            <td><?= (int)($emp['active_certs'] ?? 0) ?></td>
            <td><span class="badge <?= $badgeClass ?>"><?= $score ?></span></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <?php endif; ?>
    </div>

    <div class="quick-actions">
      <a href="/jadwal/" style="background:#7c3aed;color:#fff;padding:12px 20px;border-radius:8px;text-decoration:none;font-weight:600;font-size:.875rem">📅 Daftarkan Karyawan ke Pelatihan</a>
      <a href="/workplace/karyawan/tambah/" style="background:var(--green);color:#fff;padding:12px 20px;border-radius:8px;text-decoration:none;font-weight:600;font-size:.875rem">➕ Tambah Karyawan Baru</a>
      <a href="<?= wa_url('Halo, saya HR Manager dan butuh bantuan program K3 karyawan perusahaan kami') ?>" style="background:var(--orange);color:#fff;padding:12px 20px;border-radius:8px;text-decoration:none;font-weight:600;font-size:.875rem">💬 Konsultasi K3</a>
    </div>
  </div>
</div>

<script src="<?= SITE_URL ?>/assets/js/main.js"></script>
</body></html>
