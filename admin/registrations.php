<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/partials/auth.php';
require_auth('registrations');

$pdo = get_pdo();
$role = current_role();

// Handle status updates and deliberate bulk cleanup of test registrations.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && csrf_verify($_POST['csrf_token'] ?? '') && isset($_POST['action'])) {
    $act = sanitize($_POST['action']);
    if ($act === 'delete_selected') {
        $ids = array_values(array_unique(array_filter(array_map('intval', $_POST['ids'] ?? []))));
        if ($ids) {
            $placeholders = implode(',', array_fill(0, count($ids), '?'));
            $stmt = $pdo->prepare("DELETE FROM training_registrations WHERE id IN ($placeholders)");
            $stmt->execute($ids);
            redirect(SITE_URL . '/admin/registrations.php?deleted=' . $stmt->rowCount());
        }
        redirect(SITE_URL . '/admin/registrations.php?none_selected=1');
    }

    $id = (int)($_POST['id'] ?? 0);
    if ($id && in_array($act, ['confirm','cancel','complete'], true)) {
        $pdo->prepare('UPDATE training_registrations SET status=?, updated_at=NOW() WHERE id=?')->execute([$act === 'confirm' ? 'confirmed' : ($act === 'cancel' ? 'cancelled' : 'completed'), $id]);
    }
    redirect(SITE_URL . '/admin/registrations.php?saved=1');
}

// Filters
$status = sanitize($_GET['status'] ?? '');
$search = sanitize($_GET['q'] ?? '');
$page   = max(1, (int)($_GET['p'] ?? 1));
$limit  = 30;
$offset = ($page - 1) * $limit;

$where  = [];
$params = [];
if ($status) { $where[] = 'tr.status = ?'; $params[] = $status; }
if ($search) { $where[] = '(tr.participant_name LIKE ? OR tr.email LIKE ? OR t.name LIKE ?)'; $params = array_merge($params, ["%$search%","%$search%","%$search%"]); }
$whereSQL = $where ? 'WHERE ' . implode(' AND ', $where) : '';

$total = $pdo->prepare("SELECT COUNT(*) FROM training_registrations tr JOIN training_batches tb ON tr.batch_id=tb.id JOIN trainings t ON tb.course_id=t.id $whereSQL");
$total->execute($params); $total = (int)$total->fetchColumn();

$regs = $pdo->prepare("SELECT tr.*, t.name as training_name, tb.start_date, tb.end_date, tb.mode FROM training_registrations tr JOIN training_batches tb ON tr.batch_id=tb.id JOIN trainings t ON tb.course_id=t.id $whereSQL ORDER BY tr.created_at DESC LIMIT $limit OFFSET $offset");
$regs->execute($params); $regs = $regs->fetchAll();

$pages = ceil($total / $limit);

// Status counts
$counts = $pdo->query("SELECT status, COUNT(*) as n FROM training_registrations GROUP BY status")->fetchAll(PDO::FETCH_KEY_PAIR);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Pendaftaran Peserta — Admin</title>
<meta name="robots" content="noindex">
<link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/admin.css">
</head>
<body class="admin-body">
<?php include __DIR__ . '/partials/sidebar.php'; ?>
<div class="admin-main">
  <?php if (isset($_GET['saved'])): ?><div class="flash flash-ok">✅ Status berhasil diperbarui</div><?php endif; ?>
  <?php if (isset($_GET['deleted'])): ?><div class="flash flash-ok">✅ <?= (int)$_GET['deleted'] ?> data uji berhasil dihapus</div><?php endif; ?>
  <?php if (isset($_GET['none_selected'])): ?><div class="flash" style="background:#fef3c7;color:#92400e">Pilih sedikitnya satu data yang akan dihapus.</div><?php endif; ?>

  <div class="admin-topbar">
    <h1>📋 Pendaftaran Peserta Pelatihan</h1>
    <div style="font-size:.85rem;color:#666">Total: <?= $total ?> pendaftaran</div>
  </div>

  <!-- Status filter tabs -->
  <div style="display:flex;gap:8px;margin-bottom:20px;flex-wrap:wrap">
    <?php
    $tabs = [''=>'Semua','pending'=>'Menunggu','confirmed'=>'Konfirmasi','completed'=>'Selesai','cancelled'=>'Batal'];
    foreach ($tabs as $val => $lbl):
      $cnt = $val ? ($counts[$val] ?? 0) : array_sum($counts);
    ?>
    <a href="?status=<?= $val ?>&q=<?= urlencode($search) ?>" style="padding:6px 14px;border-radius:100px;text-decoration:none;font-size:.82rem;font-weight:600;background:<?= $status===$val?'var(--green)':'#f1f5f9' ?>;color:<?= $status===$val?'#fff':'#475569' ?>"><?= $lbl ?> <?= $cnt ? "<span style='font-weight:400;opacity:.75'>($cnt)</span>" : '' ?></a>
    <?php endforeach; ?>
  </div>

  <!-- Search -->
  <form method="GET" style="display:flex;gap:10px;margin-bottom:20px">
    <input type="hidden" name="status" value="<?= e($status) ?>">
    <input type="text" name="q" value="<?= e($search) ?>" placeholder="Cari nama, email, pelatihan..." style="flex:1;padding:9px 14px;border:1.5px solid #ddd;border-radius:8px;font-size:.875rem">
    <button type="submit" style="background:var(--green);color:#fff;border:none;padding:9px 18px;border-radius:8px;cursor:pointer;font-weight:600">Cari</button>
  </form>

  <form method="POST" id="bulk-delete-form" style="display:flex;justify-content:flex-end;margin-bottom:10px" onsubmit="return confirm('Hapus permanen data yang dipilih? Pastikan hanya data test/percobaan.');">
    <?= csrf_field() ?>
    <input type="hidden" name="action" value="delete_selected">
    <button type="submit" style="background:#fee2e2;color:#991b1b;border:1px solid #fecaca;padding:7px 12px;border-radius:7px;cursor:pointer;font-weight:600">🗑 Hapus Data Terpilih</button>
  </form>

  <div class="admin-table-card">
    <table class="admin-table">
      <thead>
        <tr><th style="width:32px"><input type="checkbox" id="select-all" aria-label="Pilih semua data di halaman ini"></th><th>Peserta</th><th>Pelatihan</th><th>Tanggal</th><th>Kode</th><th>Status</th><th>Daftar</th><th>Aksi</th></tr>
      </thead>
      <tbody>
      <?php foreach ($regs as $r): ?>
      <tr>
        <td><input type="checkbox" name="ids[]" value="<?= (int)$r['id'] ?>" form="bulk-delete-form" class="registration-select" aria-label="Pilih <?= e($r['participant_name']) ?>"></td>
        <td>
          <div style="font-weight:600"><?= e($r['participant_name']) ?></div>
          <div style="font-size:.78rem;color:#999"><?= e($r['email']) ?> · <?= e($r['phone'] ?? '') ?></div>
          <?php if ($r['company'] ?? ''): ?><div style="font-size:.75rem;color:#aaa"><?= e($r['company']) ?></div><?php endif; ?>
        </td>
        <td>
          <div><?= e(mb_substr($r['training_name'],0,40)) ?></div>
          <div style="font-size:.75rem;color:#999"><?= e($r['mode'] ?? '') ?></div>
        </td>
        <td>
          <div style="font-size:.83rem"><?= format_date($r['start_date']) ?></div>
          <div style="font-size:.75rem;color:#999">s/d <?= format_date($r['end_date']) ?></div>
        </td>
        <td style="font-family:monospace;font-size:.8rem;color:var(--green);font-weight:600"><?= e($r['reg_code'] ?? '—') ?></td>
        <td>
          <?php $sc = $r['status'];
            $bc = ['pending'=>'#fef3c7:#92400e','confirmed'=>'#d1fae5:#065f46','completed'=>'#dbeafe:#1e40af','cancelled'=>'#fee2e2:#991b1b'][$sc] ?? '#f3f4f6:#6b7280';
            [$bg,$fg] = explode(':', $bc);
          ?>
          <span style="background:<?= $bg ?>;color:<?= $fg ?>;padding:2px 10px;border-radius:100px;font-size:.72rem;font-weight:700"><?= strtoupper($sc) ?></span>
        </td>
        <td style="font-size:.78rem;color:#999"><?= time_ago($r['created_at']) ?></td>
        <td>
          <div style="display:flex;gap:6px;flex-wrap:wrap">
          <?php if ($r['status'] === 'pending'): ?>
          <form method="POST" style="display:inline"><?= csrf_field() ?>
            <input type="hidden" name="id" value="<?= $r['id'] ?>">
            <input type="hidden" name="action" value="confirm">
            <button type="submit" style="background:var(--green);color:#fff;border:none;padding:4px 10px;border-radius:6px;cursor:pointer;font-size:.75rem">✓ Konfirmasi</button>
          </form>
          <form method="POST" style="display:inline"><?= csrf_field() ?>
            <input type="hidden" name="id" value="<?= $r['id'] ?>">
            <input type="hidden" name="action" value="cancel">
            <button type="submit" style="background:#fee2e2;color:#991b1b;border:none;padding:4px 10px;border-radius:6px;cursor:pointer;font-size:.75rem">✗ Batal</button>
          </form>
          <?php elseif ($r['status'] === 'confirmed'): ?>
          <form method="POST" style="display:inline"><?= csrf_field() ?>
            <input type="hidden" name="id" value="<?= $r['id'] ?>">
            <input type="hidden" name="action" value="complete">
            <button type="submit" style="background:#dbeafe;color:#1e40af;border:none;padding:4px 10px;border-radius:6px;cursor:pointer;font-size:.75rem">✓ Selesai</button>
          </form>
          <?php else: ?><span style="font-size:.75rem;color:#999">—</span><?php endif; ?>
          <?php if ($r['wa_number'] ?? $r['phone'] ?? ''): ?>
          <a href="<?= wa_url('Halo ' . $r['participant_name'] . ', konfirmasi pendaftaran pelatihan ' . $r['training_name']) ?>" style="background:#d1fae5;color:#065f46;padding:4px 8px;border-radius:6px;font-size:.75rem;text-decoration:none">💬</a>
          <?php endif; ?>
          </div>
        </td>
      </tr>
      <?php endforeach; ?>
      <?php if (empty($regs)): ?>
      <tr><td colspan="8" style="text-align:center;padding:40px;color:#999">Tidak ada pendaftaran ditemukan</td></tr>
      <?php endif; ?>
      </tbody>
    </table>
  </div>

  <!-- Pagination -->
  <?php if ($pages > 1): ?>
  <div style="display:flex;gap:8px;justify-content:center;margin-top:20px">
    <?php for($i=1;$i<=$pages;$i++): ?>
    <a href="?status=<?= urlencode($status) ?>&q=<?= urlencode($search) ?>&p=<?= $i ?>" style="padding:6px 12px;border-radius:6px;border:1px solid #ddd;text-decoration:none;background:<?= $i===$page?'var(--green)':'#fff' ?>;color:<?= $i===$page?'#fff':'#333' ?>;font-size:.82rem"><?= $i ?></a>
    <?php endfor; ?>
  </div>
  <?php endif; ?>
</div>
<script src="<?= SITE_URL ?>/assets/js/admin.js"></script>
<script>
document.getElementById('select-all')?.addEventListener('change', function () {
  document.querySelectorAll('.registration-select').forEach(function (checkbox) {
    checkbox.checked = this.checked;
  }, this);
});
</script>
</body></html>
