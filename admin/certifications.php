<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/partials/auth.php';
require_auth('certifications');

$pdo = get_pdo();

// ── Handle actions ────────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && csrf_verify($_POST['csrf_token'] ?? '')) {
    $action = $_POST['action'] ?? '';

    if ($action === 'save') {
        $id          = (int)($_POST['id'] ?? 0);
        $client_id   = (int)$_POST['client_id'];
        $course_id   = (int)$_POST['course_id'];
        $cert_num    = trim($_POST['cert_number'] ?? '');
        $comp_date   = $_POST['completion_date'] ?? '';
        $valid_months = (int)($_POST['validity_months'] ?? 36);
        $score       = $_POST['score'] !== '' ? (float)$_POST['score'] : null;
        $notes       = trim($_POST['notes'] ?? '');
        $batch_id    = ($_POST['batch_id'] ?? '') !== '' ? (int)$_POST['batch_id'] : null;

        // Calculate expiry
        $expiry = date('Y-m-d', strtotime($comp_date . " +{$valid_months} months"));

        if ($id) {
            $pdo->prepare("UPDATE certifications SET client_id=?,course_id=?,cert_number=?,completion_date=?,expiry_date=?,validity_months=?,score=?,notes=?,batch_id=?,updated_at=NOW() WHERE id=?")
                ->execute([$client_id,$course_id,$cert_num,$comp_date,$expiry,$valid_months,$score,$notes,$batch_id,$id]);
            flash_set('success', 'Sertifikasi berhasil diperbarui.');
        } else {
            $pdo->prepare("INSERT INTO certifications (client_id,course_id,cert_number,completion_date,expiry_date,validity_months,score,notes,batch_id,created_by) VALUES (?,?,?,?,?,?,?,?,?,?)")
                ->execute([$client_id,$course_id,$cert_num,$comp_date,$expiry,$valid_months,$score,$notes,$batch_id,current_user_id()]);
            flash_set('success', 'Sertifikasi berhasil ditambahkan.');
        }
    } elseif ($action === 'delete') {
        $id = (int)$_POST['id'];
        $pdo->prepare("DELETE FROM certifications WHERE id=?")->execute([$id]);
        flash_set('success', 'Sertifikasi dihapus.');
    }
    redirect(SITE_URL . '/admin/certifications.php');
}

// ── Filters ───────────────────────────────────────────────────────────────
$filter  = $_GET['filter']  ?? 'all';
$search  = trim($_GET['q']  ?? '');
$page    = max(1, (int)($_GET['page'] ?? 1));
$per     = 20;
$offset  = ($page - 1) * $per;

$where = "WHERE 1=1";
$params = [];

if ($filter === 'active') {
    $where .= " AND c.expiry_date > DATE_ADD(NOW(), INTERVAL 30 DAY)";
} elseif ($filter === 'expiring_soon') {
    $where .= " AND c.expiry_date BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 30 DAY)";
} elseif ($filter === 'expired') {
    $where .= " AND c.expiry_date < NOW()";
}
if ($search) {
    $where .= " AND (cl.name LIKE ? OR t.name LIKE ? OR c.cert_number LIKE ?)";
    $s = "%$search%";
    $params = array_merge($params, [$s,$s,$s]);
}

$cnt_stmt = $pdo->prepare("SELECT COUNT(*) FROM certifications c JOIN clients cl ON cl.id=c.client_id JOIN trainings t ON t.id=c.course_id $where");
$cnt_stmt->execute($params);
$total = (int)$cnt_stmt->fetchColumn();

$stmt = $pdo->prepare(
    "SELECT c.*, cl.name AS client_name, cl.phone AS client_phone, cl.company_id,
            co.name AS company_name,
            t.name AS course_name, t.certification,
            DATEDIFF(c.expiry_date, NOW()) AS days_left
     FROM certifications c
     JOIN clients cl ON cl.id = c.client_id
     LEFT JOIN companies co ON co.id = cl.company_id
     JOIN trainings t ON t.id = c.course_id
     $where
     ORDER BY c.expiry_date ASC
     LIMIT $per OFFSET $offset"
);
$stmt->execute($params);
$certs = $stmt->fetchAll();
$total_pages = ceil($total / $per);

// For form dropdowns
$clients  = $pdo->query("SELECT id, name FROM clients WHERE is_active=1 ORDER BY name ASC")->fetchAll();
$courses  = $pdo->query("SELECT id, name, validity_months FROM trainings WHERE is_active=1 ORDER BY name ASC")->fetchAll();

// Edit data
$edit = null;
if (!empty($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM certifications WHERE id=?");
    $stmt->execute([(int)$_GET['edit']]);
    $edit = $stmt->fetch();
}

$flash = flash_get();
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sertifikasi — Wahana Totalita Admin</title>
<meta name="robots" content="noindex,nofollow">
<link rel="stylesheet" href="/admin/assets/admin.css">
</head>
<body>
<div class="admin-layout">
  <div class="mobile-overlay" id="mobileOverlay"></div>
  <?php require __DIR__ . '/partials/sidebar.php'; ?>
  <main class="admin-main">
    <div class="admin-topbar">
      <button class="topbar-hamburger" id="hamburger"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg></button>
      <div class="topbar-title">Sertifikasi & Tracking Expiry</div>
      <div class="topbar-actions">
        <button class="topbar-btn topbar-btn-primary" onclick="openModal('modalCert')">+ Tambah Sertifikasi</button>
      </div>
    </div>

    <div class="admin-content">
      <?php if ($flash): ?>
      <div id="flash-message" class="alert alert-<?= $flash['type'] === 'success' ? 'success' : 'error' ?>"><?= e($flash['message']) ?></div>
      <?php endif; ?>

      <!-- Stats row -->
      <div class="stats-grid" style="grid-template-columns:repeat(4,1fr);margin-bottom:20px">
        <?php
        $cnt = [
          'all'           => $pdo->query("SELECT COUNT(*) FROM certifications")->fetchColumn(),
          'active'        => $pdo->query("SELECT COUNT(*) FROM certifications WHERE expiry_date > DATE_ADD(NOW(),INTERVAL 30 DAY)")->fetchColumn(),
          'expiring_soon' => $pdo->query("SELECT COUNT(*) FROM certifications WHERE expiry_date BETWEEN NOW() AND DATE_ADD(NOW(),INTERVAL 30 DAY)")->fetchColumn(),
          'expired'       => $pdo->query("SELECT COUNT(*) FROM certifications WHERE expiry_date < NOW()")->fetchColumn(),
        ];
        ?>
        <div class="stat-card green"><div class="stat-card-icon">🎓</div><div class="stat-card-num"><?= $cnt['all'] ?></div><div class="stat-card-label">Total</div></div>
        <div class="stat-card blue"><div class="stat-card-icon">✅</div><div class="stat-card-num"><?= $cnt['active'] ?></div><div class="stat-card-label">Aktif</div></div>
        <div class="stat-card yellow"><div class="stat-card-icon">⏰</div><div class="stat-card-num"><?= $cnt['expiring_soon'] ?></div><div class="stat-card-label">Akan Exp. (30 hari)</div></div>
        <div class="stat-card red"><div class="stat-card-icon">❌</div><div class="stat-card-num"><?= $cnt['expired'] ?></div><div class="stat-card-label">Expired</div></div>
      </div>

      <div class="card">
        <!-- Filters -->
        <div class="filter-bar">
          <div class="filter-chips">
            <?php foreach (['all'=>'Semua','active'=>'Aktif','expiring_soon'=>'Akan Exp.','expired'=>'Expired'] as $k=>$v): ?>
            <a href="?filter=<?= $k ?>&q=<?= urlencode($search) ?>" class="filter-chip <?= $filter===$k?'active':'' ?>"><?= $v ?>
              <?php if ($k !== 'all'): ?><span style="opacity:.7">(<?= $cnt[$k] ?>)</span><?php endif; ?>
            </a>
            <?php endforeach; ?>
          </div>
          <div class="filter-search">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <form method="get" style="flex:1">
              <input type="hidden" name="filter" value="<?= e($filter) ?>">
              <input type="text" name="q" class="search-input" placeholder="Cari nama / program / no. sertifikat..."
                     value="<?= e($search) ?>" style="border:none;outline:none;width:100%;font-size:13px;background:none">
            </form>
          </div>
          <div class="filter-bar-end">
            <span style="font-size:12px;color:#6b7280"><?= number_format($total) ?> data</span>
          </div>
        </div>

        <!-- Table -->
        <div class="table-wrap">
          <table class="admin-table" id="filterTable">
            <thead>
              <tr>
                <th>Peserta</th>
                <th>Perusahaan</th>
                <th>Program</th>
                <th>No. Sertifikat</th>
                <th>Selesai</th>
                <th>Kedaluwarsa</th>
                <th>Sisa</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php if (empty($certs)): ?>
              <tr><td colspan="9"><div class="empty-state"><div class="empty-state-icon">🎓</div><h3>Belum ada data</h3><p>Tambah sertifikasi pertama Anda</p></div></td></tr>
              <?php else: ?>
              <?php foreach ($certs as $c):
                $days = (int)$c['days_left'];
                if ($days < 0)     { $status_badge = 'badge-expired';  $status_label = 'Expired'; }
                elseif ($days <= 30) { $status_badge = 'badge-expiring'; $status_label = 'Akan Exp.'; }
                else               { $status_badge = 'badge-active';   $status_label = 'Aktif'; }
                $wa_msg = "Halo {$c['client_name']}, sertifikasi *{$c['course_name']}* Anda " .
                  ($days < 0 ? "telah kedaluwarsa sejak " . date('d M Y', strtotime($c['expiry_date'])) :
                   "akan kedaluwarsa pada " . date('d M Y', strtotime($c['expiry_date'])) . " ({$days} hari lagi)") .
                  ".\n\nSegera perpanjang di:\n🌐 wahanatotalita.com\n📱 wa.me/6281235036420";
              ?>
              <tr data-status="<?= $status_badge ?>"
                  data-search="<?= e(strtolower($c['client_name'].' '.$c['course_name'].' '.($c['cert_number']??''))) ?>">
                <td><strong><?= e($c['client_name']) ?></strong></td>
                <td><?= e($c['company_name'] ?? '—') ?></td>
                <td style="max-width:200px"><div style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis" title="<?= e($c['course_name']) ?>"><?= e($c['course_name']) ?></div>
                  <div style="font-size:10px;color:#6b7280"><?= e($c['certification']) ?></div>
                </td>
                <td style="font-size:12px;font-family:monospace"><?= e($c['cert_number'] ?? '—') ?></td>
                <td><?= date('d M Y', strtotime($c['completion_date'])) ?></td>
                <td class="expiry-date" data-date="<?= $c['expiry_date'] ?>"><?= date('d M Y', strtotime($c['expiry_date'])) ?></td>
                <td><span class="badge <?= $status_badge ?>"><?= $days < 0 ? abs($days).' hari lalu' : $days.' hari' ?></span></td>
                <td><span class="badge <?= $status_badge ?>"><?= $status_label ?></span></td>
                <td>
                  <div style="display:flex;gap:6px;align-items:center">
                    <?php if ($c['client_phone']): ?>
                    <button class="btn btn-xs btn-wa" title="Kirim WA"
                            onclick="sendWA('<?= e($c['client_phone']) ?>','<?= e(addslashes($wa_msg)) ?>')">📱</button>
                    <?php endif; ?>
                    <a href="?edit=<?= $c['id'] ?>&filter=<?= e($filter) ?>" class="btn btn-xs btn-outline">Edit</a>
                    <form method="post" style="display:inline" onsubmit="return confirm('Hapus sertifikasi ini?')">
                      <?= csrf_field() ?>
                      <input type="hidden" name="action" value="delete">
                      <input type="hidden" name="id" value="<?= $c['id'] ?>">
                      <button type="submit" class="btn btn-xs btn-danger">Hapus</button>
                    </form>
                  </div>
                </td>
              </tr>
              <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <?php if ($total_pages > 1): ?>
        <div class="pagination">
          <div class="page-info">Menampilkan <?= ($offset+1) ?>–<?= min($offset+$per,$total) ?> dari <?= $total ?></div>
          <?php for ($p=1;$p<=$total_pages;$p++): ?>
          <a href="?filter=<?= e($filter) ?>&q=<?= urlencode($search) ?>&page=<?= $p ?>" class="page-btn <?= $p===$page?'active':'' ?>"><?= $p ?></a>
          <?php endfor; ?>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </main>
</div>

<!-- ── Add/Edit Modal ── -->
<div class="modal-overlay <?= $edit ? 'open' : '' ?>" id="modalCert">
  <div class="modal">
    <div class="modal-header">
      <div class="modal-title"><?= $edit ? 'Edit Sertifikasi' : 'Tambah Sertifikasi' ?></div>
      <button class="modal-close" onclick="closeModal('modalCert')">✕</button>
    </div>
    <form method="post">
      <?= csrf_field() ?>
      <input type="hidden" name="action" value="save">
      <input type="hidden" name="id" value="<?= $edit['id'] ?? 0 ?>">
      <div class="modal-body">
        <div class="form-grid">
          <div class="form-group form-full">
            <label class="form-label">Peserta <span>*</span></label>
            <select name="client_id" class="form-select" required>
              <option value="">-- Pilih Peserta --</option>
              <?php foreach ($clients as $cl): ?>
              <option value="<?= $cl['id'] ?>" <?= ($edit['client_id']??'')==$cl['id']?'selected':'' ?>><?= e($cl['name']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group form-full">
            <label class="form-label">Program Pelatihan <span>*</span></label>
            <select name="course_id" class="form-select" required id="courseSelect"
                    onchange="updateValidity(this)">
              <option value="">-- Pilih Program --</option>
              <?php foreach ($courses as $co): ?>
              <option value="<?= $co['id'] ?>" data-months="<?= $co['validity_months'] ?>"
                      <?= ($edit['course_id']??'')==$co['id']?'selected':'' ?>><?= e($co['name']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">No. Sertifikat</label>
            <input type="text" name="cert_number" class="form-input" value="<?= e($edit['cert_number']??'') ?>" placeholder="Misal: BNSP/K3/2024/0001">
          </div>
          <div class="form-group">
            <label class="form-label">Masa Berlaku (bulan) <span>*</span></label>
            <input type="number" name="validity_months" id="validityMonths" class="form-input"
                   value="<?= $edit['validity_months']??36 ?>" min="1" max="120" required>
            <div class="form-text">BNSP = 36 bulan, KEMNAKER = tergantung program</div>
          </div>
          <div class="form-group">
            <label class="form-label">Tanggal Selesai Pelatihan <span>*</span></label>
            <input type="date" name="completion_date" class="form-input"
                   value="<?= $edit['completion_date']??date('Y-m-d') ?>" required
                   onchange="calcExpiry()">
          </div>
          <div class="form-group">
            <label class="form-label">Tanggal Kedaluwarsa (otomatis)</label>
            <input type="text" id="expiryPreview" class="form-input" readonly
                   style="background:#f9fafb;color:#6b7280"
                   value="<?= $edit ? date('d M Y', strtotime($edit['expiry_date'])) : '' ?>">
            <div class="form-text">Dihitung otomatis dari tanggal selesai + masa berlaku</div>
          </div>
          <div class="form-group">
            <label class="form-label">Nilai / Score</label>
            <input type="number" name="score" class="form-input" value="<?= $edit['score']??'' ?>"
                   min="0" max="100" step="0.01" placeholder="0-100">
          </div>
          <div class="form-group form-full">
            <label class="form-label">Catatan</label>
            <textarea name="notes" class="form-textarea"><?= e($edit['notes']??'') ?></textarea>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline" onclick="closeModal('modalCert')">Batal</button>
        <button type="submit" class="btn btn-primary">💾 Simpan</button>
      </div>
    </form>
  </div>
</div>

<script src="/admin/assets/admin.js"></script>
<script>
<?php if ($edit): ?>openModal('modalCert');<?php endif; ?>
function updateValidity(sel) {
  var opt = sel.options[sel.selectedIndex];
  var months = opt.dataset.months || 36;
  document.getElementById('validityMonths').value = months;
  calcExpiry();
}
function calcExpiry() {
  var dateVal = document.querySelector('input[name="completion_date"]').value;
  var months  = parseInt(document.getElementById('validityMonths').value) || 36;
  if (!dateVal) return;
  var d = new Date(dateVal);
  d.setMonth(d.getMonth() + months);
  var opts = {day:'2-digit',month:'short',year:'numeric'};
  document.getElementById('expiryPreview').value = d.toLocaleDateString('id-ID', opts);
}
document.querySelector('input[name="completion_date"]')?.addEventListener('change', calcExpiry);
document.getElementById('validityMonths')?.addEventListener('change', calcExpiry);
</script>
</body>
</html>
