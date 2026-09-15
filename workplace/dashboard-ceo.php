<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/workplace-functions.php';

wp_require_login('ceo');
$session = wp_get_session();
$company = get_company($session['company_id']);
$s = get_all_settings();

$data = get_hse_dashboard($session['company_id']);

try {
    $pdo = get_pdo();
    $cid = $session['company_id'];

    $totalEmp = $pdo->prepare('SELECT COUNT(*) FROM workplace_employees WHERE company_id=? AND is_active=1');
    $totalEmp->execute([$cid]); $totalEmp = (int)$totalEmp->fetchColumn();

    $totalCerts = $pdo->prepare('SELECT COUNT(*) FROM employee_certs ec JOIN workplace_employees e ON ec.employee_id=e.id WHERE e.company_id=? AND ec.is_active=1');
    $totalCerts->execute([$cid]); $totalCerts = (int)$totalCerts->fetchColumn();

    $expiredCerts = $pdo->prepare("SELECT COUNT(*) FROM employee_certs ec JOIN workplace_employees e ON ec.employee_id=e.id WHERE e.company_id=? AND ec.expiry_date < NOW() AND ec.is_active=1");
    $expiredCerts->execute([$cid]); $expiredCerts = (int)$expiredCerts->fetchColumn();

    $totalSpend = $pdo->prepare("SELECT COALESCE(SUM(tr.price_paid),0) FROM training_registrations tr WHERE tr.company_id=? AND tr.status='confirmed' AND YEAR(tr.created_at)=YEAR(NOW())");
    $totalSpend->execute([$cid]); $totalSpend = (int)$totalSpend->fetchColumn();

    $monthlyTrend = $pdo->prepare("SELECT DATE_FORMAT(tr.created_at,'%b') as mon, COUNT(*) as cnt FROM training_registrations tr WHERE tr.company_id=? AND tr.created_at >= DATE_SUB(NOW(),INTERVAL 6 MONTH) GROUP BY DATE_FORMAT(tr.created_at,'%Y-%m') ORDER BY 1 ASC");
    $monthlyTrend->execute([$cid]); $monthlyTrend = $monthlyTrend->fetchAll();

    $riskEmployees = $pdo->prepare("SELECT e.name, e.jabatan, e.department, e.k3_score FROM workplace_employees e WHERE e.company_id=? AND e.is_active=1 AND e.k3_score < 40 ORDER BY e.k3_score ASC LIMIT 5");
    $riskEmployees->execute([$cid]); $riskEmployees = $riskEmployees->fetchAll();

} catch (Exception $ex) {
    $totalEmp = $totalCerts = $expiredCerts = $totalSpend = 0;
    $monthlyTrend = $riskEmployees = [];
}

$complianceRate = $totalEmp > 0 ? round(($totalEmp - ($data['cert_expired'] ?? 0)) / $totalEmp * 100) : 0;
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CEO Dashboard — <?= e($company['name'] ?? '') ?></title>
<meta name="robots" content="noindex">
<link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/style.css">
<?= theme_css_vars($s) ?>
<style>
body{background:#f0f4f8}
.wp-navbar{background:#1a1a2e;padding:0 24px;display:flex;align-items:center;justify-content:space-between;height:60px;position:sticky;top:0;z-index:100}
.wp-navbar .brand{font-weight:800;color:#f59e0b;font-size:1.05rem}
.wp-layout{display:flex;min-height:calc(100vh - 60px)}
.sidebar{width:220px;background:#16213e;padding:20px 0;flex-shrink:0;position:sticky;top:60px;height:calc(100vh - 60px);overflow-y:auto}
.sidebar-item{display:flex;gap:12px;align-items:center;padding:12px 20px;text-decoration:none;color:#94a3b8;font-size:.875rem;border-left:3px solid transparent;transition:.2s}
.sidebar-item:hover,.sidebar-item.active{color:#f59e0b;background:rgba(245,158,11,.08);border-left-color:#f59e0b}
.sidebar-section{padding:16px 20px 6px;font-size:.72rem;color:#475569;text-transform:uppercase;letter-spacing:1px;font-weight:700}
.main-content{flex:1;padding:24px;max-width:1200px}
.hero-banner{background:linear-gradient(135deg,#1a1a2e,#16213e);border-radius:16px;padding:28px;color:#fff;margin-bottom:24px;display:flex;align-items:center;gap:32px;flex-wrap:wrap}
.hero-score{width:120px;height:120px;border-radius:50%;background:conic-gradient(#f59e0b <?= ($data['k3_score'] ?? 0)*3.6 ?>deg,rgba(255,255,255,.1) 0deg);display:flex;align-items:center;justify-content:center;flex-direction:column;flex-shrink:0}
.hero-score .num{font-size:2.4rem;font-weight:900;color:#f59e0b;line-height:1}
.hero-score .lbl{font-size:.65rem;color:#94a3b8;letter-spacing:1px}
.kpi-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px;margin-bottom:24px}
.kpi-card{background:#fff;border-radius:12px;border:1px solid #eee;padding:20px;box-shadow:0 2px 8px rgba(0,0,0,.05)}
.kpi-card .kpi-val{font-size:2rem;font-weight:800;line-height:1.2}
.kpi-card .kpi-lbl{font-size:.8rem;color:#999;margin-top:4px}
.kpi-card .kpi-trend{font-size:.75rem;margin-top:8px}
.kpi-card.gold .kpi-val{color:#d97706}
.kpi-card.green .kpi-val{color:var(--green)}
.kpi-card.red .kpi-val{color:#ef4444}
.kpi-card.blue .kpi-val{color:#3b82f6}
.section-card{background:#fff;border-radius:12px;border:1px solid #eee;margin-bottom:20px;overflow:hidden}
.section-header{padding:16px 20px;border-bottom:1px solid #f0f0f0;display:flex;align-items:center;justify-content:space-between}
.section-header h2{font-size:.95rem;font-weight:700;margin:0;color:#1a1a1a}
.table{width:100%;border-collapse:collapse;font-size:.875rem}
.table th{background:#f9fafb;padding:10px 16px;text-align:left;color:#666;font-size:.78rem;font-weight:600;border-bottom:1px solid #f0f0f0}
.table td{padding:10px 16px;border-bottom:1px solid #f5f5f5;color:#333}
.badge{display:inline-block;padding:2px 8px;border-radius:100px;font-size:.72rem;font-weight:700}
.badge-ok{background:#d1fae5;color:#065f46}
.badge-warn{background:#fef3c7;color:#92400e}
.badge-danger{background:#fee2e2;color:#991b1b}
.two-col{display:grid;grid-template-columns:1fr 1fr;gap:20px}
@media(max-width:900px){.two-col{grid-template-columns:1fr}}
@media(max-width:768px){.wp-layout{flex-direction:column}.sidebar{width:100%;height:auto;position:static;display:flex;overflow-x:auto;padding:0}.sidebar-item{flex-shrink:0;border-left:none;border-bottom:3px solid transparent}.main-content{padding:16px}}
</style>
</head>
<body>
<nav class="wp-navbar">
  <div class="brand">👔 Executive Dashboard — <?= e($company['name'] ?? '') ?></div>
  <div style="display:flex;gap:16px;align-items:center">
    <span style="font-size:.85rem;color:#94a3b8">👤 <?= e($session['user']['full_name'] ?? '') ?> <span style="background:rgba(245,158,11,.2);color:#f59e0b;padding:2px 8px;border-radius:100px;font-size:.72rem;font-weight:700;margin-left:4px">CEO</span></span>
    <a href="/workplace/logout.php" style="font-size:.85rem;color:#94a3b8;text-decoration:none">Logout</a>
  </div>
</nav>

<div class="wp-layout">
  <div class="sidebar">
    <div class="sidebar-section">Overview</div>
    <a href="/workplace/dashboard-ceo/" class="sidebar-item active"><span>📊</span> Executive Summary</a>
    <a href="/workplace/laporan/"       class="sidebar-item"><span>📈</span> Laporan K3</a>
    <div class="sidebar-section">Akun</div>
    <a href="/workplace/pengaturan/"    class="sidebar-item"><span>⚙️</span> Pengaturan</a>
    <a href="/workplace/logout.php"     class="sidebar-item"><span>🚪</span> Logout</a>
  </div>

  <div class="main-content">
    <!-- Hero Banner with K3 Score -->
    <div class="hero-banner">
      <div class="hero-score">
        <span class="num"><?= $data['k3_score'] ?? 0 ?></span>
        <span class="lbl">K3 SCORE</span>
      </div>
      <div style="flex:1">
        <h1 style="margin:0 0 8px;font-size:1.4rem;color:#f59e0b">K3 Compliance Summary</h1>
        <p style="margin:0 0 12px;opacity:.8;font-size:.9rem">
          <?php $sc = $data['k3_score'] ?? 0;
          if ($sc >= 80) echo '✅ Excellent — Kepatuhan K3 perusahaan sangat baik';
          elseif ($sc >= 60) echo '⚠️ Good — Ada ruang improvement pada compliance K3';
          elseif ($sc >= 40) echo '⚠️ Fair — Diperlukan perhatian serius pada K3';
          else echo '🚨 High Risk — Tindakan segera diperlukan untuk compliance K3'; ?>
        </p>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;max-width:400px">
          <div style="text-align:center;padding:10px;background:rgba(255,255,255,.08);border-radius:8px">
            <div style="font-size:1.4rem;font-weight:800;color:#4ade80"><?= ($data['cert_coverage'] ?? 0) ?>%</div>
            <div style="font-size:.7rem;opacity:.6;margin-top:2px">Cert Coverage</div>
          </div>
          <div style="text-align:center;padding:10px;background:rgba(255,255,255,.08);border-radius:8px">
            <div style="font-size:1.4rem;font-weight:800;color:#fb923c"><?= ($data['training_score'] ?? 0) ?></div>
            <div style="font-size:.7rem;opacity:.6;margin-top:2px">Training Score</div>
          </div>
          <div style="text-align:center;padding:10px;background:rgba(255,255,255,.08);border-radius:8px">
            <div style="font-size:1.4rem;font-weight:800;color:#60a5fa"><?= $complianceRate ?>%</div>
            <div style="font-size:.7rem;opacity:.6;margin-top:2px">Compliance Rate</div>
          </div>
        </div>
      </div>
      <div>
        <a href="/jadwal/" style="display:block;background:#f59e0b;color:#fff;padding:12px 20px;border-radius:8px;text-decoration:none;font-weight:700;text-align:center;font-size:.875rem">📅 Tingkatkan Score</a>
        <a href="<?= wa_url('Halo, saya CEO dan ingin konsultasi program K3 komprehensif untuk perusahaan kami') ?>" style="display:block;margin-top:8px;background:rgba(255,255,255,.1);color:#fff;padding:10px 20px;border-radius:8px;text-decoration:none;font-weight:600;text-align:center;font-size:.85rem;border:1px solid rgba(255,255,255,.2)">💬 Konsultasi K3</a>
      </div>
    </div>

    <!-- KPIs -->
    <div class="kpi-grid">
      <div class="kpi-card green">
        <div class="kpi-val"><?= $totalEmp ?></div>
        <div class="kpi-lbl">Total Karyawan Aktif</div>
        <div class="kpi-trend" style="color:#10b981">Data terkini</div>
      </div>
      <div class="kpi-card blue">
        <div class="kpi-val"><?= $totalCerts ?></div>
        <div class="kpi-lbl">Total Sertifikat K3</div>
        <div class="kpi-trend" style="color:#3b82f6">Aktif dan valid</div>
      </div>
      <div class="kpi-card <?= $expiredCerts > 0 ? 'red' : 'green' ?>">
        <div class="kpi-val"><?= $expiredCerts ?></div>
        <div class="kpi-lbl">Sertifikat Kadaluarsa</div>
        <div class="kpi-trend" style="color:<?= $expiredCerts > 0 ? '#ef4444' : '#10b981' ?>"><?= $expiredCerts > 0 ? '⚠️ Perlu renewal segera' : '✅ Semua sertifikat valid' ?></div>
      </div>
      <div class="kpi-card gold">
        <div class="kpi-val"><?= format_price($totalSpend) ?></div>
        <div class="kpi-lbl">Total Investasi Pelatihan K3 (Tahun Ini)</div>
        <div class="kpi-trend" style="color:#d97706">ROI: Zero accident = efisiensi biaya</div>
      </div>
    </div>

    <div class="two-col">
      <!-- Risk Employees -->
      <div class="section-card">
        <div class="section-header">
          <h2>🚨 Karyawan Berisiko Tinggi (Score < 40)</h2>
        </div>
        <?php if (empty($riskEmployees)): ?>
        <div style="padding:30px;text-align:center;color:#10b981;font-weight:600">✅ Tidak ada karyawan berisiko tinggi</div>
        <?php else: ?>
        <table class="table">
          <thead><tr><th>Nama</th><th>Jabatan</th><th>Dept</th><th>Score</th></tr></thead>
          <tbody>
            <?php foreach ($riskEmployees as $e): ?>
            <tr>
              <td><?= htmlspecialchars($e['name']) ?></td>
              <td><?= htmlspecialchars($e['jabatan'] ?? '—') ?></td>
              <td><?= htmlspecialchars($e['department'] ?? '—') ?></td>
              <td><span class="badge badge-danger"><?= (int)$e['k3_score'] ?></span></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <?php endif; ?>
      </div>

      <!-- Summary Recommendations -->
      <div class="section-card">
        <div class="section-header">
          <h2>💡 Rekomendasi CEO</h2>
        </div>
        <div style="padding:20px">
          <?php $sc = $data['k3_score'] ?? 0; ?>
          <?php if (($data['cert_expired'] ?? 0) > 0): ?>
          <div style="background:#fee2e2;border-radius:8px;padding:14px;margin-bottom:12px;font-size:.875rem">
            <strong style="color:#991b1b">🚨 Action Required:</strong> <?= $data['cert_expired'] ?> sertifikat kadaluarsa. Jadwalkan renewal segera untuk menjaga compliance.
          </div>
          <?php endif; ?>
          <?php if (($data['cert_expiring_30'] ?? 0) > 0): ?>
          <div style="background:#fef3c7;border-radius:8px;padding:14px;margin-bottom:12px;font-size:.875rem">
            <strong style="color:#92400e">⚠️ Perlu Perhatian:</strong> <?= $data['cert_expiring_30'] ?> sertifikat akan kadaluarsa dalam 30 hari.
          </div>
          <?php endif; ?>
          <?php if ($sc >= 80): ?>
          <div style="background:#d1fae5;border-radius:8px;padding:14px;margin-bottom:12px;font-size:.875rem">
            <strong style="color:#065f46">✅ Excellent:</strong> K3 Score sangat baik. Pertahankan dengan pelatihan rutin dan renewal sertifikat tepat waktu.
          </div>
          <?php elseif ($sc >= 60): ?>
          <div style="background:#dbeafe;border-radius:8px;padding:14px;margin-bottom:12px;font-size:.875rem">
            <strong style="color:#1e40af">📈 Tingkatkan:</strong> Fokus pada karyawan yang belum bersertifikat untuk mencapai K3 Score 80+.
          </div>
          <?php else: ?>
          <div style="background:#fee2e2;border-radius:8px;padding:14px;margin-bottom:12px;font-size:.875rem">
            <strong style="color:#991b1b">⚡ Prioritas Tinggi:</strong> K3 Score di bawah standar. Rencanakan program pelatihan massal segera.
          </div>
          <?php endif; ?>
          <div style="background:#f9fafb;border-radius:8px;padding:14px;font-size:.875rem;color:#555">
            <strong>💼 Strategi K3 Optimal:</strong> Sertifikasi K3 mengurangi risiko kecelakaan kerja hingga 70%, menghemat biaya kompensasi, dan meningkatkan produktivitas karyawan.
          </div>
          <a href="/jadwal/" style="display:block;margin-top:16px;background:var(--green);color:#fff;padding:12px;border-radius:8px;text-decoration:none;font-weight:600;text-align:center">📅 Lihat Program Pelatihan</a>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="<?= SITE_URL ?>/assets/js/main.js"></script>
</body></html>
