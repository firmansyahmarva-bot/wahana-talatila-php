<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/workplace-functions.php';

wp_require_login();
$session = wp_get_session();
$company = get_company($session['company_id']);
$s = get_all_settings();

// Staff personal K3 data
try {
    $pdo = get_pdo();
    $uid = $session['user']['id'];
    $cid = $session['company_id'];

    // Get employee record linked to this user
    $emp = $pdo->prepare('SELECT * FROM workplace_employees WHERE user_id=? AND company_id=?');
    $emp->execute([$uid, $cid]);
    $emp = $emp->fetch();

    $myCerts = [];
    $myTraining = [];
    if ($emp) {
        $cs = $pdo->prepare("SELECT * FROM employee_certs WHERE employee_id=? ORDER BY expiry_date ASC");
        $cs->execute([$emp['id']]); $myCerts = $cs->fetchAll();

        $ts = $pdo->prepare("SELECT tr.*, t.name as training_name, tb.start_date, tb.end_date FROM training_registrations tr JOIN training_batches tb ON tr.batch_id=tb.id JOIN trainings t ON tb.training_id=t.id WHERE tr.employee_id=? ORDER BY tb.start_date DESC LIMIT 5");
        $ts->execute([$emp['id']]); $myTraining = $ts->fetchAll();
    }
} catch (Exception $ex) {
    $emp = null; $myCerts = []; $myTraining = [];
}

$k3Score = (int)($emp['k3_score'] ?? 0);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My K3 Dashboard — <?= e($company['name'] ?? '') ?></title>
<meta name="robots" content="noindex">
<link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/style.css">
<?= theme_css_vars($s) ?>
<style>
body{background:#f0f4f8}
.wp-navbar{background:#fff;border-bottom:1px solid #eee;padding:0 24px;display:flex;align-items:center;justify-content:space-between;height:60px;position:sticky;top:0;z-index:100}
.wp-navbar .brand{font-weight:800;color:var(--green);font-size:1.05rem}
.main-wrap{max-width:900px;margin:0 auto;padding:24px}
.greeting-card{background:linear-gradient(135deg,var(--green),#1a5c3a);border-radius:16px;padding:28px;color:#fff;margin-bottom:24px;display:flex;align-items:center;gap:24px;flex-wrap:wrap}
.avatar-circle{width:80px;height:80px;border-radius:50%;background:rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center;font-size:2.5rem;font-weight:800;flex-shrink:0}
.score-chip{background:rgba(255,255,255,.15);border-radius:12px;padding:12px 20px;text-align:center}
.score-chip .sc-num{font-size:2rem;font-weight:900;display:block;line-height:1}
.score-chip .sc-lbl{font-size:.7rem;opacity:.7;display:block;margin-top:4px}
.stats-row{display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:16px;margin-bottom:24px}
.stat-card{background:#fff;border-radius:12px;border:1px solid #eee;padding:18px;text-align:center;box-shadow:0 2px 8px rgba(0,0,0,.05)}
.stat-card .val{font-size:1.8rem;font-weight:800;color:var(--green);line-height:1.2}
.stat-card .lbl{font-size:.78rem;color:#999;margin-top:4px}
.section-card{background:#fff;border-radius:12px;border:1px solid #eee;margin-bottom:20px;overflow:hidden}
.section-header{padding:14px 20px;border-bottom:1px solid #f0f0f0;display:flex;align-items:center;justify-content:space-between}
.section-header h2{font-size:.95rem;font-weight:700;margin:0;color:var(--green)}
.cert-item{display:flex;align-items:center;gap:16px;padding:14px 20px;border-bottom:1px solid #f5f5f5}
.cert-item:last-child{border-bottom:none}
.cert-icon{width:40px;height:40px;border-radius:8px;background:#f0f9f0;display:flex;align-items:center;justify-content:center;font-size:1.3rem;flex-shrink:0}
.cert-info{flex:1}
.cert-info .name{font-weight:600;font-size:.9rem;color:#1a1a1a}
.cert-info .meta{font-size:.78rem;color:#999;margin-top:2px}
.badge{display:inline-block;padding:2px 8px;border-radius:100px;font-size:.72rem;font-weight:700}
.badge-ok{background:#d1fae5;color:#065f46}
.badge-warn{background:#fef3c7;color:#92400e}
.badge-danger{background:#fee2e2;color:#991b1b}
.training-item{padding:14px 20px;border-bottom:1px solid #f5f5f5;display:flex;align-items:center;justify-content:space-between;gap:12px}
.training-item:last-child{border-bottom:none}
.tip-card{background:#f0f9f0;border-radius:12px;padding:20px;margin-bottom:20px;border:1px solid #bbf7d0}
.tip-card h3{margin:0 0 12px;color:var(--green);font-size:.95rem}
@media(max-width:768px){.greeting-card{flex-direction:column}.main-wrap{padding:16px}}
</style>
</head>
<body>
<nav class="wp-navbar">
  <div class="brand">🏢 <?= e($company['name'] ?? '') ?></div>
  <div style="display:flex;gap:16px;align-items:center">
    <span style="font-size:.85rem;color:#666">👤 <?= e($session['user']['full_name'] ?? '') ?></span>
    <a href="/workplace/logout.php" style="font-size:.85rem;color:#999;text-decoration:none">Logout</a>
  </div>
</nav>

<div class="main-wrap">
  <!-- Greeting Card -->
  <div class="greeting-card">
    <div class="avatar-circle"><?= mb_substr($session['user']['full_name'] ?? 'S', 0, 1) ?></div>
    <div style="flex:1">
      <h1 style="margin:0 0 4px;font-size:1.3rem">Halo, <?= e(explode(' ', $session['user']['full_name'] ?? 'Karyawan')[0]) ?>! 👋</h1>
      <p style="margin:0 0 4px;opacity:.8;font-size:.875rem"><?= e($emp['jabatan'] ?? '') ?> <?= $emp && $emp['department'] ? '· '.e($emp['department']) : '' ?></p>
      <p style="margin:0;opacity:.6;font-size:.8rem"><?= e($company['name'] ?? '') ?></p>
    </div>
    <div class="score-chip">
      <span class="sc-num" style="color:<?= $k3Score>=70?'#4ade80':($k3Score>=40?'#fb923c':'#f87171') ?>"><?= $k3Score ?></span>
      <span class="sc-lbl">K3 Score Anda</span>
    </div>
  </div>

  <!-- Stats -->
  <div class="stats-row">
    <div class="stat-card">
      <div class="val"><?= count($myCerts) ?></div>
      <div class="lbl">Total Sertifikat K3</div>
    </div>
    <?php
    $activeCerts  = array_filter($myCerts, fn($c) => $c['is_active'] && strtotime($c['expiry_date']) > time());
    $expiringSoon = array_filter($myCerts, fn($c) => $c['is_active'] && strtotime($c['expiry_date']) > time() && (strtotime($c['expiry_date']) - time()) < 30*86400);
    ?>
    <div class="stat-card">
      <div class="val"><?= count($activeCerts) ?></div>
      <div class="lbl">Sertifikat Aktif</div>
    </div>
    <div class="stat-card">
      <div class="val" style="color:<?= count($expiringSoon)>0?'var(--orange)':'var(--green)' ?>"><?= count($expiringSoon) ?></div>
      <div class="lbl">Akan Kadaluarsa (30 Hari)</div>
    </div>
    <div class="stat-card">
      <div class="val"><?= count($myTraining) ?></div>
      <div class="lbl">Riwayat Pelatihan</div>
    </div>
  </div>

  <!-- K3 Score Tips -->
  <?php if ($k3Score < 70): ?>
  <div class="tip-card">
    <h3>💡 Cara Tingkatkan K3 Score Anda</h3>
    <ul style="margin:0;padding-left:20px;font-size:.875rem;color:#555;line-height:2">
      <?php if (count($myCerts) === 0): ?><li>Ikuti pelatihan K3 dan dapatkan sertifikasi BNSP/Kemnaker</li><?php endif; ?>
      <?php if (count($expiringSoon) > 0): ?><li>Perbarui <?= count($expiringSoon) ?> sertifikat yang akan segera kadaluarsa</li><?php endif; ?>
      <li>Minta HR Anda lengkapi data profil karyawan Anda</li>
      <li>Ikuti pelatihan rutin minimal 1x per tahun</li>
    </ul>
    <a href="/jadwal/" style="display:inline-block;margin-top:12px;background:var(--green);color:#fff;padding:10px 20px;border-radius:8px;text-decoration:none;font-weight:600;font-size:.875rem">📅 Lihat Jadwal Pelatihan</a>
  </div>
  <?php endif; ?>

  <!-- Sertifikat -->
  <div class="section-card">
    <div class="section-header">
      <h2>📜 Sertifikat K3 Saya</h2>
    </div>
    <?php if (empty($myCerts)): ?>
    <div style="padding:40px;text-align:center;color:#999">
      <p>Belum ada sertifikat K3. Mulai dengan mengikuti pelatihan!</p>
      <a href="/jadwal/" style="color:var(--green);font-weight:600">Lihat Jadwal Pelatihan →</a>
    </div>
    <?php else: ?>
    <?php foreach ($myCerts as $cert):
      $daysLeft = ceil((strtotime($cert['expiry_date']) - time()) / 86400);
      $badgeClass = $daysLeft < 0 ? 'badge-danger' : ($daysLeft <= 30 ? 'badge-warn' : 'badge-ok');
      $badgeText  = $daysLeft < 0 ? 'KADALUARSA' : ($daysLeft <= 30 ? $daysLeft.' hari lagi' : 'VALID');
    ?>
    <div class="cert-item">
      <div class="cert-icon">📜</div>
      <div class="cert-info">
        <div class="name"><?= e($cert['cert_name']) ?></div>
        <div class="meta">No: <?= e($cert['cert_number'] ?? '—') ?> · Kadaluarsa: <?= format_date($cert['expiry_date']) ?></div>
      </div>
      <span class="badge <?= $badgeClass ?>"><?= $badgeText ?></span>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>
  </div>

  <!-- Riwayat Pelatihan -->
  <div class="section-card">
    <div class="section-header">
      <h2>📅 Riwayat Pelatihan</h2>
      <a href="/jadwal/" style="font-size:.8rem;color:var(--green);text-decoration:none">Daftar Pelatihan →</a>
    </div>
    <?php if (empty($myTraining)): ?>
    <div style="padding:30px;text-align:center;color:#999;font-size:.875rem">
      Belum ada riwayat pelatihan. <a href="/jadwal/" style="color:var(--green);font-weight:600">Daftar sekarang →</a>
    </div>
    <?php else: ?>
    <?php foreach ($myTraining as $tr): ?>
    <div class="training-item">
      <div>
        <div style="font-weight:600;font-size:.9rem"><?= e($tr['training_name']) ?></div>
        <div style="font-size:.78rem;color:#999;margin-top:2px"><?= format_date($tr['start_date']) ?> — <?= format_date($tr['end_date']) ?></div>
      </div>
      <span class="badge <?= $tr['status']==='completed'?'badge-ok':($tr['status']==='confirmed'?'badge-ok':'badge-warn') ?>"><?= strtoupper($tr['status']) ?></span>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>
  </div>

  <!-- K3 Resources -->
  <div class="section-card">
    <div class="section-header">
      <h2>📚 Sumber Daya K3 Gratis</h2>
    </div>
    <div style="padding:16px 20px;display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:12px">
      <a href="/resources/" style="display:flex;gap:10px;align-items:center;padding:12px;background:#f9fafb;border-radius:8px;text-decoration:none;color:#333">
        <span style="font-size:1.5rem">📄</span>
        <span style="font-size:.85rem;font-weight:600">Template K3 Gratis</span>
      </a>
      <a href="/glosarium/" style="display:flex;gap:10px;align-items:center;padding:12px;background:#f9fafb;border-radius:8px;text-decoration:none;color:#333">
        <span style="font-size:1.5rem">📖</span>
        <span style="font-size:.85rem;font-weight:600">Glosarium K3</span>
      </a>
      <a href="/forum/" style="display:flex;gap:10px;align-items:center;padding:12px;background:#f9fafb;border-radius:8px;text-decoration:none;color:#333">
        <span style="font-size:1.5rem">💬</span>
        <span style="font-size:.85rem;font-weight:600">Forum Diskusi K3</span>
      </a>
      <a href="/jadwal/" style="display:flex;gap:10px;align-items:center;padding:12px;background:#f0f9f0;border-radius:8px;text-decoration:none;color:#333">
        <span style="font-size:1.5rem">📅</span>
        <span style="font-size:.85rem;font-weight:600;color:var(--green)">Jadwal Pelatihan</span>
      </a>
    </div>
  </div>
</div>

<script src="<?= SITE_URL ?>/assets/js/main.js"></script>
</body></html>
