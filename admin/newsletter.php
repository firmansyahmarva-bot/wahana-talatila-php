<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/partials/auth.php';
require_auth('newsletter_admin');

$pdo = get_pdo();

// Handle actions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && csrf_verify($_POST['csrf_token'] ?? '')) {
    $act = sanitize($_POST['action'] ?? '');
    $id  = (int)($_POST['id'] ?? 0);
    if ($act === 'unsubscribe' && $id) {
        $pdo->prepare('UPDATE newsletter_subscribers SET is_active=0 WHERE id=?')->execute([$id]);
    } elseif ($act === 'resubscribe' && $id) {
        $pdo->prepare('UPDATE newsletter_subscribers SET is_active=1 WHERE id=?')->execute([$id]);
    }
    redirect(SITE_URL . '/admin/newsletter.php?saved=1');
}

// Export CSV
if (isset($_GET['export'])) {
    $subs = $pdo->query("SELECT email,name,company,source,subscribed_at FROM newsletter_subscribers WHERE is_active=1 ORDER BY subscribed_at DESC")->fetchAll();
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="newsletter-subscribers-'.date('Y-m-d').'.csv"');
    $fp = fopen('php://output', 'w');
    fputcsv($fp, ['Email','Nama','Perusahaan','Sumber','Tanggal']);
    foreach ($subs as $s) fputcsv($fp, [$s['email'],$s['name'],$s['company'],$s['source'],$s['subscribed_at']]);
    fclose($fp); exit;
}

$filter = sanitize($_GET['filter'] ?? 'active');
$search = sanitize($_GET['q'] ?? '');
$page   = max(1,(int)($_GET['p'] ?? 1));
$limit  = 30; $offset = ($page-1)*$limit;

$where  = [];
$params = [];
if ($filter === 'active')   { $where[] = 'is_active=1'; }
if ($filter === 'inactive') { $where[] = 'is_active=0'; }
if ($search) { $where[] = '(email LIKE ? OR name LIKE ?)'; $params = array_merge($params, ["%$search%","%$search%"]); }
$whereSQL = $where ? 'WHERE '.implode(' AND ',$where) : '';

$total = $pdo->prepare("SELECT COUNT(*) FROM newsletter_subscribers $whereSQL");
$total->execute($params); $total = (int)$total->fetchColumn();

$subs = $pdo->prepare("SELECT * FROM newsletter_subscribers $whereSQL ORDER BY subscribed_at DESC LIMIT $limit OFFSET $offset");
$subs->execute($params); $subs = $subs->fetchAll();
$pages = ceil($total/$limit);

$totalActive   = (int)$pdo->query("SELECT COUNT(*) FROM newsletter_subscribers WHERE is_active=1")->fetchColumn();
$totalInactive = (int)$pdo->query("SELECT COUNT(*) FROM newsletter_subscribers WHERE is_active=0")->fetchColumn();
$newThisMonth  = (int)$pdo->query("SELECT COUNT(*) FROM newsletter_subscribers WHERE is_active=1 AND DATE_FORMAT(subscribed_at,'%Y-%m')=DATE_FORMAT(NOW(),'%Y-%m')")->fetchColumn();
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Newsletter Subscribers — Admin</title>
<meta name="robots" content="noindex">
<link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/admin.css">
</head>
<body class="admin-body">
<?php include __DIR__ . '/partials/sidebar.php'; ?>
<div class="admin-main">
  <?php if (isset($_GET['saved'])): ?><div class="flash flash-ok">✅ Berhasil</div><?php endif; ?>
  <div class="admin-topbar">
    <h1>📧 Newsletter Subscribers</h1>
    <a href="?export=1" style="background:var(--green);color:#fff;padding:10px 18px;border-radius:8px;text-decoration:none;font-weight:600;font-size:.875rem">⬇️ Export CSV</a>
  </div>

  <!-- Stats row -->
  <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:24px">
    <div style="background:#fff;border-radius:10px;border:1px solid #eee;padding:18px;text-align:center">
      <div style="font-size:2rem;font-weight:800;color:var(--green)"><?= $totalActive ?></div>
      <div style="font-size:.8rem;color:#999">Aktif</div>
    </div>
    <div style="background:#fff;border-radius:10px;border:1px solid #eee;padding:18px;text-align:center">
      <div style="font-size:2rem;font-weight:800;color:var(--orange)"><?= $newThisMonth ?></div>
      <div style="font-size:.8rem;color:#999">Baru Bulan Ini</div>
    </div>
    <div style="background:#fff;border-radius:10px;border:1px solid #eee;padding:18px;text-align:center">
      <div style="font-size:2rem;font-weight:800;color:#9ca3af"><?= $totalInactive ?></div>
      <div style="font-size:.8rem;color:#999">Unsubscribed</div>
    </div>
  </div>

  <!-- Filters -->
  <div style="display:flex;gap:12px;margin-bottom:16px;flex-wrap:wrap">
    <div style="display:flex;gap:6px">
      <?php foreach (['all'=>'Semua','active'=>'Aktif','inactive'=>'Unsubscribed'] as $k=>$lbl): ?>
      <a href="?filter=<?= $k ?>&q=<?= urlencode($search) ?>" style="padding:6px 14px;border-radius:100px;text-decoration:none;font-size:.82rem;font-weight:600;background:<?= $filter===$k?'var(--green)':'#f1f5f9' ?>;color:<?= $filter===$k?'#fff':'#475569' ?>"><?= $lbl ?></a>
      <?php endforeach; ?>
    </div>
    <form method="GET" style="display:flex;gap:8px;flex:1">
      <input type="hidden" name="filter" value="<?= e($filter) ?>">
      <input type="text" name="q" value="<?= e($search) ?>" placeholder="Cari email atau nama..." style="flex:1;padding:7px 12px;border:1.5px solid #ddd;border-radius:8px;font-size:.85rem">
      <button type="submit" style="background:var(--green);color:#fff;border:none;padding:7px 14px;border-radius:8px;cursor:pointer;font-size:.85rem">Cari</button>
    </form>
  </div>

  <div class="admin-table-card">
    <table class="admin-table">
      <thead><tr><th>Email</th><th>Nama</th><th>Perusahaan</th><th>Sumber</th><th>Tanggal</th><th>Status</th><th>Aksi</th></tr></thead>
      <tbody>
      <?php foreach ($subs as $s): ?>
      <tr>
        <td style="font-weight:600"><?= e($s['email']) ?></td>
        <td><?= e($s['name'] ?: '—') ?></td>
        <td style="font-size:.82rem;color:#666"><?= e($s['company'] ?: '—') ?></td>
        <td><span style="background:#f0f9f0;color:var(--green);padding:2px 8px;border-radius:4px;font-size:.72rem"><?= e($s['source'] ?? 'website') ?></span></td>
        <td style="font-size:.78rem;color:#999"><?= format_date($s['subscribed_at']) ?></td>
        <td>
          <?php if ($s['is_active']): ?>
          <span style="background:#d1fae5;color:#065f46;padding:2px 8px;border-radius:100px;font-size:.72rem;font-weight:700">AKTIF</span>
          <?php else: ?>
          <span style="background:#f3f4f6;color:#9ca3af;padding:2px 8px;border-radius:100px;font-size:.72rem;font-weight:700">UNSUBSCRIBED</span>
          <?php endif; ?>
        </td>
        <td>
          <form method="POST" style="display:inline"><?= csrf_field() ?>
            <input type="hidden" name="id" value="<?= $s['id'] ?>">
            <input type="hidden" name="action" value="<?= $s['is_active']?'unsubscribe':'resubscribe' ?>">
            <button type="submit" style="background:<?= $s['is_active']?'#fee2e2':'#d1fae5' ?>;color:<?= $s['is_active']?'#991b1b':'#065f46' ?>;border:none;padding:4px 10px;border-radius:6px;cursor:pointer;font-size:.75rem"><?= $s['is_active']?'Unsub':'Re-sub' ?></button>
          </form>
        </td>
      </tr>
      <?php endforeach; ?>
      <?php if (empty($subs)): ?><tr><td colspan="7" style="text-align:center;padding:40px;color:#999">Tidak ada data</td></tr><?php endif; ?>
      </tbody>
    </table>
  </div>

  <?php if ($pages > 1): ?>
  <div style="display:flex;gap:8px;justify-content:center;margin-top:20px">
    <?php for($i=1;$i<=$pages;$i++): ?>
    <a href="?filter=<?= e($filter) ?>&q=<?= urlencode($search) ?>&p=<?= $i ?>" style="padding:6px 12px;border-radius:6px;border:1px solid #ddd;text-decoration:none;background:<?= $i===$page?'var(--green)':'#fff' ?>;color:<?= $i===$page?'#fff':'#333' ?>;font-size:.82rem"><?= $i ?></a>
    <?php endfor; ?>
  </div>
  <?php endif; ?>
</div>
<script src="<?= SITE_URL ?>/assets/js/admin.js"></script>
</body></html>
