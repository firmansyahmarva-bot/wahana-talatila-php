<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/partials/auth.php';
require_auth('incidents_admin');

$pdo = get_pdo();

// Handle actions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && csrf_verify($_POST['csrf_token'] ?? '')) {
    $act = sanitize($_POST['action'] ?? '');
    $id  = (int)($_POST['id'] ?? 0);
    if ($act === 'toggle_publish' && $id) {
        $pdo->prepare('UPDATE incidents SET is_active = NOT is_active WHERE id=?')->execute([$id]);
    } elseif ($act === 'delete' && $id) {
        $pdo->prepare('DELETE FROM incidents WHERE id=?')->execute([$id]);
    } elseif ($act === 'scrape') {
        // Trigger manual scrape
        require_once __DIR__ . '/../includes/incident-functions.php';
        $scraped = scrape_and_save_incidents();
        redirect(SITE_URL . '/admin/incidents.php?scraped='.(int)$scraped);
    }
    redirect(SITE_URL . '/admin/incidents.php?saved=1');
}

$search   = sanitize($_GET['q'] ?? '');
$severity = sanitize($_GET['severity'] ?? '');
$page     = max(1,(int)($_GET['p'] ?? 1));
$limit    = 25; $offset = ($page-1)*$limit;

$where  = []; $params = [];
if ($search)   { $where[] = '(title LIKE ? OR city LIKE ? OR company LIKE ?)'; $params = array_merge($params, ["%$search%","%$search%","%$search%"]); }
if ($severity) { $where[] = $severity==='fatal' ? 'deaths > 0' : ($severity==='major' ? '(deaths = 0 AND injured > 0)' : '(deaths = 0 AND injured = 0)'); }
$whereSQL = $where ? 'WHERE '.implode(' AND ',$where) : '';

$total = $pdo->prepare("SELECT COUNT(*) FROM incidents $whereSQL");
$total->execute($params); $total = (int)$total->fetchColumn();

$incidents = $pdo->prepare("SELECT * FROM incidents $whereSQL ORDER BY incident_date DESC LIMIT $limit OFFSET $offset");
$incidents->execute($params); $incidents = $incidents->fetchAll();
$pages = ceil($total/$limit);

$stats = [
    'total'     => (int)$pdo->query("SELECT COUNT(*) FROM incidents")->fetchColumn(),
    'published' => (int)$pdo->query("SELECT COUNT(*) FROM incidents WHERE is_active=1")->fetchColumn(),
    'fatal'     => (int)$pdo->query("SELECT COUNT(*) FROM incidents WHERE deaths > 0")->fetchColumn(),
    'today'     => (int)$pdo->query("SELECT COUNT(*) FROM incidents WHERE DATE(created_at)=CURDATE()")->fetchColumn(),
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Database Insiden K3 — Admin</title>
<meta name="robots" content="noindex">
<link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/admin.css">
</head>
<body class="admin-body">
<?php include __DIR__ . '/partials/sidebar.php'; ?>
<div class="admin-main">
  <?php if (isset($_GET['saved'])): ?><div class="flash flash-ok">✅ Berhasil</div><?php endif; ?>
  <?php if (isset($_GET['scraped'])): ?><div class="flash flash-ok">✅ Scraping selesai: <?= (int)$_GET['scraped'] ?> insiden baru ditambahkan</div><?php endif; ?>
  <div class="admin-topbar">
    <h1>⚠️ Database Insiden K3</h1>
    <form method="POST" style="display:inline">
      <?= csrf_field() ?><input type="hidden" name="action" value="scrape">
      <button type="submit" style="background:var(--orange);color:#fff;border:none;padding:10px 18px;border-radius:8px;cursor:pointer;font-weight:600">🔄 Scrape Sekarang</button>
    </form>
  </div>

  <!-- Stats -->
  <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin-bottom:24px">
    <?php foreach ([['Total',            $stats['total'],    'var(--green)'],
                   ['Published',         $stats['published'],'#3b82f6'],
                   ['Fatal',             $stats['fatal'],    '#ef4444'],
                   ['Ditambahkan Hari Ini',$stats['today'],  'var(--orange)']] as [$lbl,$val,$clr]): ?>
    <div style="background:#fff;border-radius:10px;border:1px solid #eee;padding:16px;text-align:center">
      <div style="font-size:1.8rem;font-weight:800;color:<?= $clr ?>"><?= $val ?></div>
      <div style="font-size:.78rem;color:#999;margin-top:2px"><?= $lbl ?></div>
    </div>
    <?php endforeach; ?>
  </div>

  <!-- Filters -->
  <div style="display:flex;gap:10px;margin-bottom:16px;flex-wrap:wrap">
    <form method="GET" style="display:flex;gap:8px;flex:1">
      <input type="text" name="q" value="<?= e($search) ?>" placeholder="Cari insiden, lokasi, perusahaan..." style="flex:1;padding:8px 12px;border:1.5px solid #ddd;border-radius:8px;font-size:.85rem">
      <select name="severity" style="padding:8px 12px;border:1.5px solid #ddd;border-radius:8px;font-size:.85rem">
        <option value="">Semua</option>
        <option value="fatal" <?= $severity==='fatal'?'selected':'' ?>>Fatal</option>
        <option value="major" <?= $severity==='major'?'selected':'' ?>>Mayor</option>
        <option value="minor" <?= $severity==='minor'?'selected':'' ?>>Minor</option>
      </select>
      <button type="submit" style="background:var(--green);color:#fff;border:none;padding:8px 14px;border-radius:8px;cursor:pointer">Cari</button>
    </form>
  </div>

  <div class="admin-table-card">
    <table class="admin-table">
      <thead><tr><th>Insiden</th><th>Lokasi</th><th>Tanggal</th><th>Severity</th><th>Korban</th><th>Status</th><th>Aksi</th></tr></thead>
      <tbody>
      <?php foreach ($incidents as $inc): ?>
      <tr>
        <td>
          <a href="/insiden/<?= e($inc['slug'] ?? $inc['id']) ?>/" target="_blank" style="font-weight:600;color:var(--green);text-decoration:none"><?= e(mb_substr($inc['title'],0,55)) ?></a>
          <div style="font-size:.75rem;color:#999"><?= e(mb_substr($inc['industry']??'',0,30)) ?></div>
        </td>
        <td style="font-size:.82rem"><?= e($inc['city'] ?? '—') ?></td>
        <td style="font-size:.78rem;color:#666"><?= format_date($inc['incident_date'] ?? $inc['created_at']) ?></td>
        <td>
          <?php $sc = ['fatal'=>'#fee2e2:#991b1b','major'=>'#fef3c7:#92400e','minor'=>'#f0f9f0:var(--green)'][($inc['deaths']>0?'fatal':($inc['injured']>0?'major':'minor'))] ?? '#f3f4f6:#6b7280';
                [$bg,$fg] = explode(':',$sc); ?>
          <span style="background:<?= $bg ?>;color:<?= $fg ?>;padding:2px 8px;border-radius:100px;font-size:.72rem;font-weight:700"><?= strtoupper(($inc['deaths']>0?'fatal':($inc['injured']>0?'major':'minor'))) ?></span>
        </td>
        <td style="font-size:.82rem;text-align:center">
          <?php if (($inc['deaths']??0)>0): ?><div style="color:#ef4444;font-weight:700">💀 <?= $inc['deaths'] ?></div><?php endif; ?>
          <?php if (($inc['injured']??0)>0): ?><div style="color:var(--orange)">🤕 <?= $inc['injured'] ?></div><?php endif; ?>
          <?php if (!($inc['deaths']??0) && !($inc['injured']??0)): ?><span style="color:#999">—</span><?php endif; ?>
        </td>
        <td>
          <form method="POST" style="display:inline">
            <?= csrf_field() ?><input type="hidden" name="action" value="toggle_publish">
            <input type="hidden" name="id" value="<?= $inc['id'] ?>">
            <button type="submit" style="background:<?= $inc['is_active']?'#d1fae5':'#f3f4f6' ?>;color:<?= $inc['is_active']?'#065f46':'#9ca3af' ?>;border:none;padding:2px 10px;border-radius:100px;cursor:pointer;font-size:.72rem;font-weight:700"><?= $inc['is_active']?'PUBLISHED':'DRAFT' ?></button>
          </form>
        </td>
        <td>
          <form method="POST" style="display:inline" onsubmit="return confirm('Hapus insiden ini?')">
            <?= csrf_field() ?><input type="hidden" name="action" value="delete">
            <input type="hidden" name="id" value="<?= $inc['id'] ?>">
            <button type="submit" style="background:#fee2e2;color:#991b1b;border:none;padding:4px 8px;border-radius:6px;cursor:pointer;font-size:.75rem">🗑</button>
          </form>
        </td>
      </tr>
      <?php endforeach; ?>
      <?php if (empty($incidents)): ?><tr><td colspan="7" style="text-align:center;padding:40px;color:#999">Belum ada data insiden</td></tr><?php endif; ?>
      </tbody>
    </table>
  </div>

  <?php if ($pages > 1): ?>
  <div style="display:flex;gap:8px;justify-content:center;margin-top:20px">
    <?php for($i=1;$i<=$pages;$i++): ?>
    <a href="?q=<?= urlencode($search) ?>&severity=<?= e($severity) ?>&p=<?= $i ?>" style="padding:6px 12px;border-radius:6px;border:1px solid #ddd;text-decoration:none;background:<?= $i===$page?'var(--green)':'#fff' ?>;color:<?= $i===$page?'#fff':'#333' ?>;font-size:.82rem"><?= $i ?></a>
    <?php endfor; ?>
  </div>
  <?php endif; ?>
</div>
<script src="<?= SITE_URL ?>/assets/js/admin.js"></script>
</body></html>
