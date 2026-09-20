<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/partials/auth.php';
require_auth('programs');
require_admin();

$pdo   = get_pdo();
$flash = flash_get();

// Search / filter
$search   = trim($_GET['q']    ?? '');
$cat_id   = (int)($_GET['cat'] ?? 0);
$page     = max(1, (int)($_GET['page'] ?? 1));
$per_page = 20;

$where    = ['1=1'];
$params   = [];
if ($search) { $where[] = 't.name LIKE ?'; $params[] = "%$search%"; }
if ($cat_id) { $where[] = 't.category_id = ?'; $params[] = $cat_id; }
$where_sql = implode(' AND ', $where);

$total   = (int)$pdo->prepare("SELECT COUNT(*) FROM trainings t WHERE $where_sql")->execute($params) ? $pdo->prepare("SELECT COUNT(*) FROM trainings t WHERE $where_sql")->execute($params) : 0;
// Redo properly:
$cnt_stmt = $pdo->prepare("SELECT COUNT(*) FROM trainings t WHERE $where_sql");
$cnt_stmt->execute($params);
$total    = (int)$cnt_stmt->fetchColumn();
$pages    = max(1, (int)ceil($total / $per_page));
$offset   = ($page - 1) * $per_page;

$stmt = $pdo->prepare(
  "SELECT t.*, c.name AS cat_name, c.icon AS cat_icon, c.accent_color
   FROM trainings t LEFT JOIN categories c ON c.id=t.category_id
   WHERE $where_sql ORDER BY t.sort_order ASC, t.id ASC
   LIMIT $per_page OFFSET $offset"
);
$stmt->execute($params);
$trainings  = $stmt->fetchAll();
$categories = get_categories();
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Program Pelatihan — Admin</title>
<meta name="robots" content="noindex,nofollow">
<link rel="stylesheet" href="/admin/assets/admin.css">
<style>
.table-wrap{overflow-x:auto}
table{width:100%;border-collapse:collapse;font-size:13.5px}
th{background:#f8fdf9;padding:10px 12px;text-align:left;font-weight:600;color:#0A4A2E;border-bottom:2px solid #e8e8e8;white-space:nowrap}
td{padding:10px 12px;border-bottom:1px solid #f0f0f0;vertical-align:middle}
tr:hover td{background:#fafafa}
.badge-active{background:#E8F4EE;color:#0A4A2E;padding:2px 8px;border-radius:10px;font-size:11px;font-weight:600}
.badge-inactive{background:#f0f0f0;color:#888;padding:2px 8px;border-radius:10px;font-size:11px}
.action-btns{display:flex;gap:6px}
.btn-edit{padding:5px 12px;background:#0A4A2E;color:#fff;border-radius:5px;font-size:12px;font-weight:600}
.btn-del{padding:5px 12px;background:#FEF2F2;color:#991B1B;border-radius:5px;font-size:12px;font-weight:600;border:1px solid #FECACA;cursor:pointer}
.search-bar{display:flex;gap:10px;flex-wrap:wrap;margin-bottom:18px}
.search-bar input,.search-bar select{padding:9px 14px;border:1.5px solid #e8e8e8;border-radius:7px;font-size:13px;outline:none}
.search-bar input:focus,.search-bar select:focus{border-color:#0A4A2E}
.search-bar .btn-save{padding:9px 16px;font-size:13px}
.pager{display:flex;gap:6px;margin-top:16px}
.pager a,.pager span{padding:6px 12px;border-radius:6px;font-size:13px;border:1px solid #e8e8e8}
.pager a{color:#0A4A2E;font-weight:600}
.pager a:hover{background:#E8F4EE}
.pager .cur{background:#0A4A2E;color:#fff;border-color:#0A4A2E}
</style>
<link rel="stylesheet" href="/admin/assets/admin.css"></head>
<body>
<div class="admin-wrap">
  <?php include __DIR__ . '/partials/sidebar.php'; ?>
  <div class="main-area">
    <div class="topbar">
      <div class="topbar-title">Program Pelatihan</div>
      <a href="/admin/training-save.php" class="btn-save" style="font-size:13px;padding:7px 16px">+ Tambah Program</a>
    </div>
    <div class="content">

      <?php if ($flash): ?>
      <div style="padding:12px 16px;border-radius:8px;margin-bottom:16px;font-size:14px;
           background:<?= $flash['type']==='success' ? '#E8F4EE' : '#FEF2F2' ?>;
           color:<?= $flash['type']==='success' ? '#0A4A2E' : '#991B1B' ?>">
        <?= e($flash['message']) ?>
      </div>
      <?php endif; ?>

      <div class="card-section">
        <form method="get" class="search-bar">
          <input type="text" name="q" value="<?= e($search) ?>" placeholder="Cari nama program…">
          <select name="cat">
            <option value="">Semua Kategori</option>
            <?php foreach ($categories as $c): ?>
            <option value="<?= $c['id'] ?>" <?= $cat_id===$c['id']?'selected':'' ?>><?= e($c['name']) ?></option>
            <?php endforeach; ?>
          </select>
          <button type="submit" class="btn-save">Filter</button>
          <?php if ($search || $cat_id): ?>
          <a href="/admin/trainings.php" style="padding:9px 14px;border:1.5px solid #e8e8e8;border-radius:7px;font-size:13px;color:#888">Reset</a>
          <?php endif; ?>
        </form>

        <div style="font-size:13px;color:#888;margin-bottom:10px">
          Menampilkan <?= count($trainings) ?> dari <?= $total ?> program
        </div>

        <div class="table-wrap">
          <table>
            <thead>
              <tr>
                <th style="width:40px">#</th>
                <th>Nama Program</th>
                <th>Kategori</th>
                <th>Mode</th>
                <th>Harga</th>
                <th>Status</th>
                <th>Views</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php if (empty($trainings)): ?>
              <tr><td colspan="8" style="text-align:center;padding:30px;color:#888">Tidak ada program ditemukan.</td></tr>
              <?php else: ?>
              <?php foreach ($trainings as $t): ?>
              <tr>
                <td style="color:#aaa"><?= $t['id'] ?></td>
                <td>
                  <div style="font-weight:600;color:#1a1a1a"><?= e(mb_strimwidth($t['name'], 0, 55, '…')) ?></div>
                  <div style="font-size:11px;color:#aaa;margin-top:2px"><?= e($t['slug']) ?></div>
                </td>
                <td><span style="background:<?= e($t['accent_color']??'#0A4A2E') ?>20;color:<?= e($t['accent_color']??'#0A4A2E') ?>;padding:3px 8px;border-radius:5px;font-size:12px;font-weight:600"><?= $t['cat_icon'] ?> <?= e($t['cat_name']) ?></span></td>
                <td><?= e(mode_label($t['mode'])) ?></td>
                <td style="font-weight:700;color:#0A4A2E;white-space:nowrap"><?= format_price((int)$t['price']) ?></td>
                <td><?php if ($t['is_active']): ?><span class="badge-active">Aktif</span><?php else: ?><span class="badge-inactive">Nonaktif</span><?php endif; ?></td>
                <td style="color:#888"><?= number_format($t['view_count']) ?></td>
                <td>
                  <div class="action-btns">
                    <a href="/admin/training-save.php?id=<?= $t['id'] ?>" class="btn-edit">Edit</a>
                    <form method="post" action="/admin/training-delete.php" onsubmit="return confirm('Hapus program ini?')">
                      <?= csrf_field() ?>
                      <input type="hidden" name="id" value="<?= $t['id'] ?>">
                      <button type="submit" class="btn-del">Hapus</button>
                    </form>
                  </div>
                </td>
              </tr>
              <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>

        <?php if ($pages > 1): ?>
        <div class="pager">
          <?php for ($i = 1; $i <= $pages; $i++): ?>
          <?php $q = http_build_query(array_filter(['q'=>$search,'cat'=>$cat_id,'page'=>$i])); ?>
          <?php if ($i === $page): ?>
          <span class="cur"><?= $i ?></span>
          <?php else: ?>
          <a href="?<?= $q ?>"><?= $i ?></a>
          <?php endif; ?>
          <?php endfor; ?>
        </div>
        <?php endif; ?>

      </div>
    </div>
  </div>
</div>
<script src="/admin/assets/admin.js"></script></body>
</html>
