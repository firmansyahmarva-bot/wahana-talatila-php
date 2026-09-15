<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/partials/auth.php';
require_auth('workplace_admin');

$pdo = get_pdo();

// Handle actions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && csrf_verify($_POST['csrf_token'] ?? '')) {
    $act = sanitize($_POST['action'] ?? '');
    $id  = (int)($_POST['id'] ?? 0);
    if ($act === 'toggle_active' && $id) {
        $pdo->prepare('UPDATE workplace_companies SET is_active = NOT is_active WHERE id=?')->execute([$id]);
    }
    redirect(SITE_URL . '/admin/workplace.php?saved=1');
}

$search = sanitize($_GET['q'] ?? '');
$page   = max(1,(int)($_GET['p'] ?? 1));
$limit  = 25; $offset = ($page-1)*$limit;

$where  = $search ? "WHERE wc.company_name LIKE ? OR wc.contact_email LIKE ?" : '';
$params = $search ? ["%$search%","%$search%"] : [];

$total = $pdo->prepare("SELECT COUNT(*) FROM workplace_companies wc $where");
$total->execute($params); $total = (int)$total->fetchColumn();

$companies = $pdo->prepare("SELECT wc.*, (SELECT COUNT(*) FROM workplace_employees e WHERE e.company_id=wc.id AND e.is_active=1) as emp_count, (SELECT AVG(k3_score) FROM workplace_employees e WHERE e.company_id=wc.id AND e.is_active=1) as avg_score FROM workplace_companies wc $where ORDER BY wc.created_at DESC LIMIT $limit OFFSET $offset");
$companies->execute($params); $companies = $companies->fetchAll();
$pages = ceil($total/$limit);

$statsQ = $pdo->query("SELECT COUNT(*) as total, SUM(CASE WHEN is_active=1 THEN 1 ELSE 0 END) as active, SUM(employee_count) as total_emp FROM workplace_companies")->fetch();
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Workplace K3 Companies — Admin</title>
<meta name="robots" content="noindex">
<link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/admin.css">
</head>
<body class="admin-body">
<?php include __DIR__ . '/partials/sidebar.php'; ?>
<div class="admin-main">
  <?php if (isset($_GET['saved'])): ?><div class="flash flash-ok">✅ Berhasil</div><?php endif; ?>
  <div class="admin-topbar">
    <h1>🏢 Workplace K3 — Perusahaan Terdaftar</h1>
    <div style="font-size:.85rem;color:#666"><?= $statsQ['total'] ?> perusahaan · <?= $statsQ['active'] ?> aktif · <?= number_format((int)$statsQ['total_emp']) ?> karyawan</div>
  </div>

  <!-- Stats -->
  <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-bottom:24px">
    <div style="background:#fff;border-radius:10px;border:1px solid #eee;padding:16px;text-align:center">
      <div style="font-size:2rem;font-weight:800;color:var(--green)"><?= $statsQ['active'] ?></div>
      <div style="font-size:.78rem;color:#999">Perusahaan Aktif</div>
    </div>
    <div style="background:#fff;border-radius:10px;border:1px solid #eee;padding:16px;text-align:center">
      <div style="font-size:2rem;font-weight:800;color:#3b82f6"><?= number_format((int)$statsQ['total_emp']) ?></div>
      <div style="font-size:.78rem;color:#999">Total Karyawan</div>
    </div>
    <div style="background:#fff;border-radius:10px;border:1px solid #eee;padding:16px;text-align:center">
      <div style="font-size:2rem;font-weight:800;color:var(--orange)"><?= (int)$statsQ['total'] - (int)$statsQ['active'] ?></div>
      <div style="font-size:.78rem;color:#999">Perlu Follow-up</div>
    </div>
  </div>

  <!-- Search -->
  <form method="GET" style="display:flex;gap:10px;margin-bottom:20px">
    <input type="text" name="q" value="<?= e($search) ?>" placeholder="Cari nama perusahaan atau email..." style="flex:1;padding:9px 14px;border:1.5px solid #ddd;border-radius:8px;font-size:.875rem">
    <button type="submit" style="background:var(--green);color:#fff;border:none;padding:9px 18px;border-radius:8px;cursor:pointer;font-weight:600">Cari</button>
  </form>

  <div class="admin-table-card">
    <table class="admin-table">
      <thead><tr><th>Perusahaan</th><th>Industri</th><th>Kontak</th><th>Karyawan</th><th>K3 Score</th><th>Daftar</th><th>Status</th><th>Aksi</th></tr></thead>
      <tbody>
      <?php foreach ($companies as $c):
        $avgScore = round((float)($c['avg_score'] ?? 0));
      ?>
      <tr>
        <td>
          <div style="font-weight:600"><?= e($c['company_name']) ?></div>
          <div style="font-size:.75rem;color:#999"><?= e($c['contact_name'] ?? '') ?></div>
        </td>
        <td style="font-size:.82rem"><?= e($c['industry'] ?? '—') ?></td>
        <td style="font-size:.78rem">
          <div><?= e($c['contact_email'] ?? '—') ?></div>
          <?php if ($c['contact_phone'] ?? ''): ?><a href="<?= wa_url('Halo ' . $c['contact_name'] . ', ada info program K3 untuk ' . $c['company_name']) ?>" style="color:var(--green);text-decoration:none"><?= e($c['contact_phone']) ?></a><?php endif; ?>
        </td>
        <td style="text-align:center">
          <div style="font-weight:700"><?= (int)$c['emp_count'] ?></div>
          <div style="font-size:.72rem;color:#999">aktif</div>
        </td>
        <td style="text-align:center">
          <?php $scoreColor = $avgScore>=70?'#065f46':($avgScore>=40?'#92400e':'#991b1b');
                $scoreBg    = $avgScore>=70?'#d1fae5':($avgScore>=40?'#fef3c7':'#fee2e2'); ?>
          <span style="background:<?= $scoreBg ?>;color:<?= $scoreColor ?>;padding:3px 10px;border-radius:100px;font-size:.8rem;font-weight:800"><?= $avgScore ?></span>
        </td>
        <td style="font-size:.75rem;color:#999"><?= format_date($c['created_at']) ?></td>
        <td>
          <form method="POST" style="display:inline">
            <?= csrf_field() ?><input type="hidden" name="action" value="toggle_active">
            <input type="hidden" name="id" value="<?= $c['id'] ?>">
            <button type="submit" style="background:<?= $c['is_active']?'#d1fae5':'#f3f4f6' ?>;color:<?= $c['is_active']?'#065f46':'#9ca3af' ?>;border:none;padding:2px 10px;border-radius:100px;cursor:pointer;font-size:.72rem;font-weight:700"><?= $c['is_active']?'AKTIF':'NON-AKTIF' ?></button>
          </form>
        </td>
        <td>
          <a href="<?= wa_url('Halo ' . ($c['contact_name']??'') . ', ini dari Wahana Totalita. Kami ingin follow up program K3 untuk ' . $c['company_name']) ?>" style="background:#d1fae5;color:#065f46;padding:5px 10px;border-radius:6px;text-decoration:none;font-size:.78rem">💬 WA</a>
        </td>
      </tr>
      <?php endforeach; ?>
      <?php if (empty($companies)): ?><tr><td colspan="8" style="text-align:center;padding:40px;color:#999">Belum ada perusahaan terdaftar</td></tr><?php endif; ?>
      </tbody>
    </table>
  </div>

  <?php if ($pages > 1): ?>
  <div style="display:flex;gap:8px;justify-content:center;margin-top:20px">
    <?php for($i=1;$i<=$pages;$i++): ?>
    <a href="?q=<?= urlencode($search) ?>&p=<?= $i ?>" style="padding:6px 12px;border-radius:6px;border:1px solid #ddd;text-decoration:none;background:<?= $i===$page?'var(--green)':'#fff' ?>;color:<?= $i===$page?'#fff':'#333' ?>;font-size:.82rem"><?= $i ?></a>
    <?php endfor; ?>
  </div>
  <?php endif; ?>
</div>
<script src="<?= SITE_URL ?>/assets/js/admin.js"></script>
</body></html>
