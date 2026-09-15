<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/partials/auth.php';
require_auth('resources_admin');

$pdo = get_pdo();

// Handle actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $act = sanitize($_POST['action'] ?? '');
    $id  = (int)($_POST['id'] ?? 0);
    if ($act === 'toggle_active' && $id) {
        $pdo->prepare('UPDATE resources SET is_active = NOT is_active WHERE id=?')->execute([$id]);
    } elseif ($act === 'delete' && $id) {
        $pdo->prepare('DELETE FROM resources WHERE id=?')->execute([$id]);
    } elseif ($act === 'add' && verify_csrf()) {
        $data = [
            sanitize($_POST['title'] ?? ''),
            sanitize($_POST['category'] ?? ''),
            sanitize($_POST['file_type'] ?? 'pdf'),
            sanitize($_POST['file_url'] ?? ''),
            sanitize($_POST['description'] ?? ''),
            isset($_POST['is_gated']) ? 1 : 0,
            isset($_POST['is_premium']) ? 1 : 0,
            make_slug(sanitize($_POST['title'] ?? '')),
        ];
        $pdo->prepare('INSERT INTO resources (title,category,file_type,file_url,description,is_gated,is_premium,slug,created_at) VALUES (?,?,?,?,?,?,?,?,NOW())')->execute($data);
    }
    redirect(SITE_URL . '/admin/resources.php?saved=1');
}

$search = sanitize($_GET['q'] ?? '');
$page   = max(1,(int)($_GET['p'] ?? 1));
$limit  = 20; $offset = ($page-1)*$limit;

$where  = $search ? "WHERE r.title LIKE ?" : '';
$params = $search ? ["%$search%"] : [];

$total = $pdo->prepare("SELECT COUNT(*) FROM resources r $where");
$total->execute($params); $total = (int)$total->fetchColumn();

$resources = $pdo->prepare("SELECT r.*, (SELECT COUNT(*) FROM resource_leads rl WHERE rl.resource_id=r.id) as lead_count, (SELECT COUNT(*) FROM resource_downloads rd WHERE rd.resource_id=r.id) as dl_count FROM resources r $where ORDER BY r.created_at DESC LIMIT $limit OFFSET $offset");
$resources->execute($params); $resources = $resources->fetchAll();
$pages = ceil($total / $limit);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Library Resources — Admin</title>
<meta name="robots" content="noindex">
<link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/admin.css">
</head>
<body class="admin-body">
<?php include __DIR__ . '/partials/sidebar.php'; ?>
<div class="admin-main">
  <?php if (isset($_GET['saved'])): ?><div class="flash flash-ok">✅ Tersimpan</div><?php endif; ?>
  <div class="admin-topbar">
    <h1>📄 Library Resources K3</h1>
    <button onclick="document.getElementById('addModal').style.display='flex'" style="background:var(--orange);color:#fff;border:none;padding:10px 18px;border-radius:8px;cursor:pointer;font-weight:600">+ Tambah Resource</button>
  </div>

  <!-- Search -->
  <form method="GET" style="display:flex;gap:10px;margin-bottom:20px">
    <input type="text" name="q" value="<?= e($search) ?>" placeholder="Cari resource..." style="flex:1;padding:9px 14px;border:1.5px solid #ddd;border-radius:8px;font-size:.875rem">
    <button type="submit" style="background:var(--green);color:#fff;border:none;padding:9px 18px;border-radius:8px;cursor:pointer;font-weight:600">Cari</button>
  </form>

  <div class="admin-table-card">
    <table class="admin-table">
      <thead><tr><th>Resource</th><th>Kategori</th><th>Tipe</th><th>Gate</th><th>Leads</th><th>DL</th><th>Status</th><th>Aksi</th></tr></thead>
      <tbody>
      <?php foreach ($resources as $r): ?>
      <tr>
        <td>
          <div style="font-weight:600"><?= e(mb_substr($r['title'],0,50)) ?></div>
          <div style="font-size:.75rem;color:#999"><?= e(mb_substr($r['description']??'',0,60)) ?></div>
        </td>
        <td style="font-size:.82rem"><?= e($r['category'] ?? '—') ?></td>
        <td><span style="background:#f0f9f0;color:var(--green);padding:2px 8px;border-radius:4px;font-size:.75rem;font-weight:700"><?= strtoupper($r['file_type'] ?? 'pdf') ?></span></td>
        <td style="font-size:.8rem">
          <?= $r['is_gated'] ? '<span style="color:var(--orange)">🔒 Gated</span>' : '<span style="color:#999">Gratis</span>' ?>
          <?= $r['is_premium'] ? '<br><span style="color:#6366f1;font-size:.72rem">💎 Premium</span>' : '' ?>
        </td>
        <td style="text-align:center;font-weight:700;color:var(--green)"><?= (int)$r['lead_count'] ?></td>
        <td style="text-align:center;color:#666"><?= (int)$r['dl_count'] ?></td>
        <td>
          <form method="POST" style="display:inline">
            <input type="hidden" name="action" value="toggle_active">
            <input type="hidden" name="id" value="<?= $r['id'] ?>">
            <button type="submit" style="background:<?= $r['is_active']?'#d1fae5':'#f3f4f6' ?>;color:<?= $r['is_active']?'#065f46':'#9ca3af' ?>;border:none;padding:3px 10px;border-radius:100px;cursor:pointer;font-size:.75rem;font-weight:700"><?= $r['is_active'] ? 'AKTIF' : 'NON-AKTIF' ?></button>
          </form>
        </td>
        <td>
          <a href="/resources/<?= e($r['slug']) ?>/" target="_blank" style="font-size:.78rem;color:var(--green);text-decoration:none">👁 View</a> ·
          <form method="POST" style="display:inline" onsubmit="return confirm('Hapus resource ini?')">
            <input type="hidden" name="action" value="delete">
            <input type="hidden" name="id" value="<?= $r['id'] ?>">
            <button type="submit" style="background:none;border:none;color:#ef4444;cursor:pointer;font-size:.78rem">🗑 Hapus</button>
          </form>
        </td>
      </tr>
      <?php endforeach; ?>
      <?php if (empty($resources)): ?><tr><td colspan="8" style="text-align:center;padding:40px;color:#999">Belum ada resource</td></tr><?php endif; ?>
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

<!-- Add Modal -->
<div id="addModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:1000;align-items:center;justify-content:center">
  <div style="background:#fff;border-radius:16px;padding:28px;max-width:520px;width:90%;max-height:80vh;overflow-y:auto">
    <h2 style="margin:0 0 20px;color:var(--green)">➕ Tambah Resource Baru</h2>
    <form method="POST">
      <?= csrf_field() ?>
      <input type="hidden" name="action" value="add">
      <div style="margin-bottom:12px">
        <label style="font-size:.83rem;font-weight:600;display:block;margin-bottom:4px">Judul *</label>
        <input type="text" name="title" required style="width:100%;box-sizing:border-box;padding:9px 12px;border:1.5px solid #ddd;border-radius:8px;font-size:.875rem">
      </div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:12px">
        <div>
          <label style="font-size:.83rem;font-weight:600;display:block;margin-bottom:4px">Kategori</label>
          <input type="text" name="category" placeholder="K3 Umum, APD, APAR..." style="width:100%;box-sizing:border-box;padding:9px 12px;border:1.5px solid #ddd;border-radius:8px;font-size:.875rem">
        </div>
        <div>
          <label style="font-size:.83rem;font-weight:600;display:block;margin-bottom:4px">Tipe File</label>
          <select name="file_type" style="width:100%;padding:9px 12px;border:1.5px solid #ddd;border-radius:8px;font-size:.875rem">
            <option>pdf</option><option>docx</option><option>xlsx</option><option>pptx</option><option>zip</option>
          </select>
        </div>
      </div>
      <div style="margin-bottom:12px">
        <label style="font-size:.83rem;font-weight:600;display:block;margin-bottom:4px">URL File / Link</label>
        <input type="text" name="file_url" placeholder="https://... atau /uploads/..." style="width:100%;box-sizing:border-box;padding:9px 12px;border:1.5px solid #ddd;border-radius:8px;font-size:.875rem">
      </div>
      <div style="margin-bottom:12px">
        <label style="font-size:.83rem;font-weight:600;display:block;margin-bottom:4px">Deskripsi</label>
        <textarea name="description" rows="3" style="width:100%;box-sizing:border-box;padding:9px 12px;border:1.5px solid #ddd;border-radius:8px;font-size:.875rem;resize:vertical"></textarea>
      </div>
      <div style="display:flex;gap:20px;margin-bottom:20px">
        <label style="display:flex;gap:8px;align-items:center;font-size:.85rem;cursor:pointer"><input type="checkbox" name="is_gated" value="1"> 🔒 Email Gated</label>
        <label style="display:flex;gap:8px;align-items:center;font-size:.85rem;cursor:pointer"><input type="checkbox" name="is_premium" value="1"> 💎 Premium</label>
      </div>
      <div style="display:flex;gap:12px">
        <button type="submit" style="flex:1;background:var(--green);color:#fff;border:none;padding:12px;border-radius:8px;cursor:pointer;font-weight:700">Simpan Resource</button>
        <button type="button" onclick="document.getElementById('addModal').style.display='none'" style="flex:1;background:#f3f4f6;color:#333;border:none;padding:12px;border-radius:8px;cursor:pointer;font-weight:600">Batal</button>
      </div>
    </form>
  </div>
</div>

<script src="<?= SITE_URL ?>/assets/js/admin.js"></script>
</body></html>
