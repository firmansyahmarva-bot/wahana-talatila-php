<?php
/**
 * admin/klien-sertifikasi.php
 * Combined Client + Certificate Form — ONE form, saves both at once
 * Replaces the old 2-step flow (clients.php → certifications.php)
 */
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/partials/auth.php';
require_auth('clients');
$pdo = get_pdo();

// ── Handle POST ────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && csrf_verify($_POST['csrf_token'] ?? '')) {
    $action = $_POST['action'] ?? '';

    if ($action === 'save_full') {
        $errors = [];

        // Validate
        $client_name = trim($_POST['client_name'] ?? '');
        $phone       = trim($_POST['phone'] ?? '');
        if (!$client_name) $errors[] = 'Nama peserta wajib diisi.';

        // Company: existing or new
        $company_id = null;
        $co_existing = (int)($_POST['company_id'] ?? 0);
        $co_new_name = trim($_POST['company_new'] ?? '');
        if ($co_existing > 0) {
            $company_id = $co_existing;
        } elseif ($co_new_name) {
            $pdo->prepare("INSERT INTO companies (name) VALUES (?)")->execute([$co_new_name]);
            $company_id = (int)$pdo->lastInsertId();
        }

        if (!$errors) {
            // Client: check if phone already exists
            $existing_client = null;
            if ($phone) {
                $st = $pdo->prepare("SELECT * FROM clients WHERE phone = ? LIMIT 1");
                $st->execute([$phone]);
                $existing_client = $st->fetch();
            }

            if ($existing_client) {
                $client_id = $existing_client['id'];
                // Update info if changed
                $pdo->prepare("UPDATE clients SET name=?,company_id=?,position=?,email=?,notes=?,updated_at=NOW() WHERE id=?")
                    ->execute([$client_name, $company_id, trim($_POST['position']??''), trim($_POST['email']??''), trim($_POST['notes']??''), $client_id]);
            } else {
                $pdo->prepare("INSERT INTO clients (name,company_id,nik,position,phone,email,notes) VALUES (?,?,?,?,?,?,?)")
                    ->execute([$client_name, $company_id, trim($_POST['nik']??''), trim($_POST['position']??''), $phone, trim($_POST['email']??''), trim($_POST['notes']??'')]);
                $client_id = (int)$pdo->lastInsertId();
            }

            // Save certifications (one or more)
            $cert_saved = 0;
            $courses     = $_POST['course_id']   ?? [];
            $cert_nos    = $_POST['cert_number'] ?? [];
            $comp_dates  = $_POST['completion_date'] ?? [];
            $exp_dates   = $_POST['expiry_date']  ?? [];
            $validities  = $_POST['validity_months'] ?? [];

            foreach ($courses as $i => $course_id) {
                $course_id = (int)$course_id;
                if (!$course_id) continue;
                $comp = $comp_dates[$i] ?? date('Y-m-d');
                $exp  = $exp_dates[$i]  ?? date('Y-m-d', strtotime('+3 years'));
                $valid= (int)($validities[$i] ?? 36);
                $cno  = trim($cert_nos[$i] ?? '');
                if (!$comp || !$exp) continue;

                $pdo->prepare("INSERT INTO certifications (client_id,course_id,cert_number,completion_date,expiry_date,validity_months,created_by) VALUES (?,?,?,?,?,?,?)")
                    ->execute([$client_id, $course_id, $cno ?: null, $comp, $exp, $valid, current_user_id()]);
                $cert_saved++;
            }

            $msg = "Peserta <strong>".htmlspecialchars($client_name)."</strong> disimpan";
            if ($cert_saved) $msg .= " dengan <strong>$cert_saved</strong> sertifikasi.";
            else $msg .= " (tanpa sertifikasi).";
            if ($existing_client) $msg .= " <em>(Data peserta diperbarui dari data lama)</em>";

            flash_set('success', $msg);
            redirect(SITE_URL . '/admin/admin_klien_sertifikasi.php');
        } else {
            $flash_error = implode(' ', $errors);
        }
    }

    if ($action === 'quick_delete_cert') {
        $cid = (int)($_POST['cert_id'] ?? 0);
        if ($cid) $pdo->prepare("DELETE FROM certifications WHERE id=?")->execute([$cid]);
        flash_set('success', 'Sertifikasi dihapus.');
        redirect(SITE_URL . '/admin/admin_klien_sertifikasi.php');
    }
}

// ── Data ───────────────────────────────────────────────────
$search      = trim($_GET['q'] ?? '');
$page        = max(1, (int)($_GET['page'] ?? 1));
$per         = 25; $offset = ($page-1)*$per;
$where       = $search ? "WHERE cl.name LIKE ? OR cl.phone LIKE ? OR cl.email LIKE ? OR co.name LIKE ?" : "";
$params      = $search ? array_fill(0, 4, "%$search%") : [];

$stC = $pdo->prepare("SELECT COUNT(*) FROM clients cl LEFT JOIN companies co ON co.id=cl.company_id $where");
$stC->execute($params); $total = (int)$stC->fetchColumn();

$stmt = $pdo->prepare("SELECT cl.*, co.name AS co_name,
    (SELECT COUNT(*) FROM certifications WHERE client_id=cl.id) AS cert_count,
    (SELECT MIN(expiry_date) FROM certifications WHERE client_id=cl.id AND expiry_date >= NOW()) AS next_expiry,
    (SELECT COUNT(*) FROM certifications WHERE client_id=cl.id AND expiry_date < NOW()) AS expired_count
    FROM clients cl LEFT JOIN companies co ON co.id=cl.company_id
    $where ORDER BY cl.created_at DESC LIMIT $per OFFSET $offset");
$stmt->execute($params); $clients = $stmt->fetchAll();
$total_pages = ceil($total/$per);

$companies = $pdo->query("SELECT id,name FROM companies WHERE is_active=1 ORDER BY name ASC")->fetchAll();
$trainings = $pdo->query("SELECT id,name,price,certification,validity_months FROM trainings WHERE is_active=1 ORDER BY category_id,sort_order")->fetchAll();

// Detail view
$detail_client = null; $detail_certs = [];
if (!empty($_GET['detail'])) {
    $st = $pdo->prepare("SELECT cl.*,co.name AS co_name FROM clients cl LEFT JOIN companies co ON co.id=cl.company_id WHERE cl.id=?");
    $st->execute([(int)$_GET['detail']]); $detail_client = $st->fetch();
    if ($detail_client) {
        $stc = $pdo->prepare("SELECT ce.*,t.name AS course_name,t.certification FROM certifications ce LEFT JOIN trainings t ON t.id=ce.course_id WHERE ce.client_id=? ORDER BY ce.expiry_date DESC");
        $stc->execute([$detail_client['id']]); $detail_certs = $stc->fetchAll();
    }
}

$flash = flash_get();
$today = date('Y-m-d');
?>
<!DOCTYPE html><html lang="id"><head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Peserta & Sertifikasi — Admin</title>
<meta name="robots" content="noindex,nofollow">
<link rel="stylesheet" href="/admin/assets/admin.css">
<style>
.ks-split{display:grid;grid-template-columns:1fr 1fr;gap:2rem}
.ks-cert-row{display:grid;grid-template-columns:2fr 1.2fr 1.2fr 1.2fr 80px 36px;gap:.5rem;align-items:end;margin-bottom:.75rem;padding:.75rem;background:#f9fafb;border-radius:8px;border:1px solid #e5e7eb}
.ks-cert-row .form-group{margin:0}
.ks-cert-row .form-label{font-size:11px;margin-bottom:3px}
.ks-cert-row .form-input,.ks-cert-row .form-select{height:36px;font-size:13px}
.rm-cert{background:#fee2e2;border:none;color:#dc2626;border-radius:6px;height:36px;width:36px;cursor:pointer;font-size:16px;align-self:end}
.tag-exp{display:inline-block;padding:2px 8px;border-radius:10px;font-size:11px;font-weight:700}
.tag-ok{background:#d1fae5;color:#065f46}
.tag-soon{background:#fef3c7;color:#92400e}
.tag-dead{background:#fee2e2;color:#991b1b}
.exp-date{font-size:12px;color:#374151;font-weight:600}
.wa-link{color:#25D366;font-weight:700;font-size:12px;text-decoration:none}
.wa-link:hover{text-decoration:underline}
.client-row td{vertical-align:middle}
.cert-mini{display:flex;flex-wrap:wrap;gap:4px;margin-top:3px}
.cert-chip{font-size:10px;background:#f3f4f6;color:#374151;padding:2px 7px;border-radius:8px;font-weight:600}
.cert-chip.exp{background:#fee2e2;color:#991b1b}
</style>
</head>
<body><div class="admin-layout"><div class="mobile-overlay" id="mobileOverlay"></div>
<?php require __DIR__.'/partials/sidebar.php'; ?>
<main class="admin-main">
<div class="admin-topbar">
  <button class="topbar-hamburger" id="hamburger"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg></button>
  <div class="topbar-title">Peserta & Sertifikasi</div>
  <div class="topbar-actions">
    <button class="topbar-btn topbar-btn-primary" onclick="openModal('mNew')">+ Tambah Peserta</button>
  </div>
</div>
<div class="admin-content">
<?php if($flash):?><div id="flash-message" class="alert alert-<?=$flash['type']==='success'?'success':'error'?>"><?=$flash['message']?></div><?php endif;?>
<?php if(!empty($flash_error)):?><div class="alert alert-error"><?=e($flash_error)?></div><?php endif;?>

<!-- DETAIL PANEL -->
<?php if($detail_client): ?>
<div class="card" style="margin-bottom:1.5rem">
  <div style="padding:1.25rem 1.5rem;border-bottom:1px solid #e5e7eb;display:flex;justify-content:space-between;align-items:center">
    <div>
      <h3 style="font-size:16px;font-weight:700;margin:0"><?=e($detail_client['name'])?></h3>
      <div style="font-size:13px;color:#6b7280;margin-top:2px">
        <?=e($detail_client['co_name']??'Individu')?> 
        <?php if($detail_client['phone']):?> · <a class="wa-link" href="https://wa.me/<?=preg_replace('/\D/','',$detail_client['phone'])?>" target="_blank">📱 <?=e($detail_client['phone'])?></a><?php endif;?>
      </div>
    </div>
    <a href="/admin/admin_klien_sertifikasi.php" class="btn btn-xs btn-outline">✕ Tutup</a>
  </div>
  <div class="table-wrap">
    <table class="admin-table">
      <thead><tr><th>Program Pelatihan</th><th>No. Sertifikat</th><th>Selesai</th><th>Kadaluarsa</th><th>Status</th><th>Aksi</th></tr></thead>
      <tbody>
      <?php if(empty($detail_certs)):?>
      <tr><td colspan="6"><div class="empty-state" style="padding:1.5rem"><div class="empty-state-icon">📋</div><h3>Belum ada sertifikasi</h3></div></td></tr>
      <?php else: foreach($detail_certs as $c):
        $is_exp  = $c['expiry_date'] < $today;
        $days_left = (int)ceil((strtotime($c['expiry_date'])-time())/(86400));
        $tag = $is_exp ? 'tag-dead' : ($days_left <= 30 ? 'tag-soon' : 'tag-ok');
        $label = $is_exp ? 'Kadaluarsa' : ($days_left <= 30 ? $days_left.' hari lagi' : 'Aktif');
      ?>
      <tr>
        <td><strong style="font-size:13px"><?=e($c['course_name']??'-')?></strong><div style="font-size:11px;color:#6b7280"><?=e($c['certification']??'')?></div></td>
        <td style="font-size:12px"><?=e($c['cert_number']??'—')?></td>
        <td style="font-size:12px"><?=date('d M Y',strtotime($c['completion_date']))?></td>
        <td><span class="exp-date"><?=date('d M Y',strtotime($c['expiry_date']))?></span></td>
        <td><span class="tag-exp <?=$tag?>"><?=$label?></span></td>
        <td>
          <?php if($detail_client['phone']):?>
          <a class="wa-link" href="https://wa.me/<?=preg_replace('/\D/','',$detail_client['phone'])?>?text=<?=rawurlencode('Halo '.$detail_client['name'].', sertifikasi '.$c['course_name'].' Anda '.($is_exp?'telah kadaluarsa':'akan kadaluarsa pada '.date('d M Y',strtotime($c['expiry_date']))).'. Segera perpanjang di wahanatotalita.com')?>" target="_blank">📱 WA</a>
          <?php endif;?>
          <form method="post" style="display:inline" onsubmit="return confirm('Hapus sertifikasi ini?')">
            <?=csrf_field()?><input type="hidden" name="action" value="quick_delete_cert"><input type="hidden" name="cert_id" value="<?=$c['id']?>">
            <button type="submit" class="btn btn-xs btn-danger" style="margin-left:6px">Hapus</button>
          </form>
        </td>
      </tr>
      <?php endforeach; endif; ?>
      </tbody>
    </table>
  </div>
</div>
<?php endif; ?>

<!-- CLIENT LIST -->
<div class="card">
  <div class="filter-bar">
    <div class="filter-search">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      <form method="get" style="flex:1"><input type="text" name="q" placeholder="Cari nama, HP, email, perusahaan..." value="<?=e($search)?>" style="border:none;outline:none;width:100%;font-size:13px;background:none;padding:8px 0"></form>
    </div>
    <div class="filter-bar-end"><span style="font-size:12px;color:#6b7280"><?=number_format($total)?> peserta</span></div>
  </div>
  <div class="table-wrap">
    <table class="admin-table">
      <thead><tr><th>Nama</th><th>Perusahaan</th><th>WhatsApp</th><th>Sertifikasi</th><th>Next Expiry</th><th>Aksi</th></tr></thead>
      <tbody>
      <?php if(empty($clients)):?>
      <tr><td colspan="6"><div class="empty-state"><div class="empty-state-icon">👥</div><h3>Belum ada peserta</h3><p>Klik <strong>+ Tambah Peserta</strong> untuk menambah data pertama.</p></div></td></tr>
      <?php else: foreach($clients as $c):
        $has_exp = $c['expired_count'] > 0;
        $near_exp = $c['next_expiry'] && (strtotime($c['next_expiry'])-time()) < 30*86400;
      ?>
      <tr class="client-row">
        <td><strong><?=e($c['name'])?></strong><?php if($c['nik']):?><div style="font-size:11px;color:#9ca3af">NIK: <?=e($c['nik'])?></div><?php endif;?></td>
        <td style="font-size:13px"><?=e($c['co_name']??'—')?></td>
        <td><?php if($c['phone']):?><a class="wa-link" href="https://wa.me/<?=preg_replace('/\D/','',$c['phone'])?>" target="_blank">📱 <?=e($c['phone'])?></a><?php else:?>—<?php endif;?></td>
        <td>
          <span class="badge <?=$c['cert_count']>0?'badge-active':'badge-inactive'?>"><?=$c['cert_count']?> sertifikat</span>
          <?php if($has_exp):?><span style="font-size:10px;color:#991b1b;font-weight:700;display:block;margin-top:2px">⚠ <?=$c['expired_count']?> kadaluarsa</span><?php endif;?>
        </td>
        <td><?php if($c['next_expiry']):?><span class="exp-date <?=$near_exp?'tag-exp tag-soon':''?>"><?=date('d M Y',strtotime($c['next_expiry']))?></span><?php else:?>—<?php endif;?></td>
        <td>
          <div style="display:flex;gap:5px">
            <a href="?detail=<?=$c['id']?><?=$search?'&q='.urlencode($search):''?>" class="btn btn-xs btn-outline">📋 Detail</a>
            <button class="btn btn-xs btn-primary" onclick="prefillEdit(<?=htmlspecialchars(json_encode($c))?>) ">✏ Edit</button>
          </div>
        </td>
      </tr>
      <?php endforeach; endif; ?>
      </tbody>
    </table>
  </div>
  <?php if($total_pages>1):?>
  <div class="pagination">
    <div class="page-info">Menampilkan <?=($offset+1)?>–<?=min($offset+$per,$total)?> dari <?=$total?></div>
    <?php for($p=1;$p<=$total_pages;$p++):?><a href="?q=<?=urlencode($search)?>&page=<?=$p?>" class="page-btn <?=$p===$page?'active':''?>"><?=$p?></a><?php endfor;?>
  </div>
  <?php endif; ?>
</div>
</div></main></div>

<!-- ══ ADD/EDIT MODAL ══ -->
<div class="modal-overlay" id="mNew">
  <div class="modal" style="max-width:820px;width:95%">
    <div class="modal-header">
      <div class="modal-title" id="mTitle">Tambah Peserta + Sertifikasi</div>
      <button class="modal-close" onclick="closeModal('mNew')">✕</button>
    </div>
    <form method="post" id="ksForm">
      <?=csrf_field()?>
      <input type="hidden" name="action" value="save_full">
      <input type="hidden" name="client_id_edit" id="clientIdEdit" value="0">
      <div class="modal-body">

        <p style="font-size:13px;color:#6b7280;margin-bottom:1.25rem">Isi data peserta dan sertifikasi sekaligus — tersimpan semua dalam satu klik.</p>

        <!-- CLIENT DATA -->
        <div style="background:#f0fdf4;border-radius:10px;padding:1rem 1.25rem;margin-bottom:1.25rem;border:1px solid #a7f3d0">
          <div style="font-size:11px;font-weight:800;text-transform:uppercase;letter-spacing:.08em;color:#065f46;margin-bottom:1rem">👤 Data Peserta</div>
          <div class="ks-split">
            <div class="form-group"><label class="form-label">Nama Lengkap <span>*</span></label><input type="text" name="client_name" class="form-input" required></div>
            <div class="form-group"><label class="form-label">No. WhatsApp</label><input type="tel" name="phone" class="form-input" placeholder="08xxxxxxxxxx"></div>
            <div class="form-group"><label class="form-label">Perusahaan / Instansi</label>
              <select name="company_id" class="form-select">
                <option value="">-- Pilih atau isi baru --</option>
                <?php foreach($companies as $co):?><option value="<?=$co['id']?>"><?=e($co['name'])?></option><?php endforeach;?>
              </select>
            </div>
            <div class="form-group"><label class="form-label">Atau Nama Perusahaan Baru</label><input type="text" name="company_new" class="form-input" placeholder="Ketik jika belum ada di daftar"></div>
            <div class="form-group"><label class="form-label">Jabatan</label><input type="text" name="position" class="form-input"></div>
            <div class="form-group"><label class="form-label">Email</label><input type="email" name="email" class="form-input"></div>
            <div class="form-group"><label class="form-label">NIK KTP</label><input type="text" name="nik" class="form-input"></div>
            <div class="form-group"><label class="form-label">Catatan</label><input type="text" name="notes" class="form-input"></div>
          </div>
        </div>

        <!-- CERTIFICATIONS -->
        <div style="background:#fef3ec;border-radius:10px;padding:1rem 1.25rem;border:1px solid #fed7aa">
          <div style="font-size:11px;font-weight:800;text-transform:uppercase;letter-spacing:.08em;color:#9a3412;margin-bottom:1rem">🏆 Sertifikasi (bisa lebih dari satu)</div>
          <div id="certRows">
            <!-- Template row (populated by JS) -->
          </div>
          <button type="button" onclick="addCertRow()" class="btn btn-outline btn-xs" style="margin-top:.5rem">+ Tambah Sertifikasi Lagi</button>
          <p style="font-size:11px;color:#9ca3af;margin-top:.5rem">Lewati bagian ini jika hanya ingin simpan data peserta tanpa sertifikasi.</p>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline" onclick="closeModal('mNew')">Batal</button>
        <button type="submit" class="btn btn-primary">💾 Simpan Sekaligus</button>
      </div>
    </form>
  </div>
</div>

<script src="/admin/assets/admin.js"></script>
<script>
var trainings = <?=json_encode(array_map(fn($t)=>['id'=>$t['id'],'name'=>$t['name'],'price'=>$t['price'],'cert'=>$t['certification'],'validity'=>$t['validity_months']??36],$trainings))?>;
var certCount = 0;

function addCertRow(data){
  certCount++;
  var today = new Date().toISOString().slice(0,10);
  var exp3yr = new Date(Date.now()+3*365*24*60*60*1000).toISOString().slice(0,10);
  var opts = '<option value="">-- Pilih Program --</option>';
  trainings.forEach(function(t){ opts += '<option value="'+t.id+'" data-valid="'+t.validity+'">'+t.name+' ('+t.cert+')</option>'; });
  var row = document.createElement('div');
  row.className = 'ks-cert-row'; row.id = 'cert-row-'+certCount;
  row.innerHTML =
    '<div class="form-group"><label class="form-label">Program Pelatihan</label><select name="course_id[]" class="form-select" onchange="autofillExpiry(this)">' + opts + '</select></div>'+
    '<div class="form-group"><label class="form-label">No. Sertifikat</label><input type="text" name="cert_number[]" class="form-input" placeholder="Opsional"></div>'+
    '<div class="form-group"><label class="form-label">Tgl Selesai</label><input type="date" name="completion_date[]" class="form-input" value="'+today+'"></div>'+
    '<div class="form-group"><label class="form-label">Kadaluarsa</label><input type="date" name="expiry_date[]" class="form-input" id="exp-'+certCount+'" value="'+exp3yr+'"></div>'+
    '<div class="form-group"><label class="form-label">Bulan Valid</label><input type="number" name="validity_months[]" class="form-input" value="36" min="1" max="120" id="val-'+certCount+'"></div>'+
    '<button type="button" class="rm-cert" onclick="this.closest(\'.ks-cert-row\').remove()" title="Hapus">✕</button>';
  document.getElementById('certRows').appendChild(row);
}

function autofillExpiry(sel){
  var valid = sel.options[sel.selectedIndex].getAttribute('data-valid') || 36;
  var rowEl  = sel.closest('.ks-cert-row');
  var rowId  = rowEl.id.replace('cert-row-','');
  document.getElementById('val-'+rowId).value = valid;
  var compEl = rowEl.querySelector('[name="completion_date[]"]');
  if(compEl && compEl.value){
    var d = new Date(compEl.value);
    d.setMonth(d.getMonth() + parseInt(valid));
    document.getElementById('exp-'+rowId).value = d.toISOString().slice(0,10);
  }
}

function prefillEdit(c){
  document.getElementById('mTitle').textContent = 'Edit Peserta: ' + c.name;
  var f = document.getElementById('ksForm');
  f.querySelector('[name=client_name]').value  = c.name || '';
  f.querySelector('[name=phone]').value        = c.phone || '';
  f.querySelector('[name=position]').value     = c.position || '';
  f.querySelector('[name=email]').value        = c.email || '';
  f.querySelector('[name=nik]').value          = c.nik || '';
  f.querySelector('[name=notes]').value        = c.notes || '';
  var coSel = f.querySelector('[name=company_id]');
  if(coSel && c.company_id) coSel.value = c.company_id;
  openModal('mNew');
}

// Add one cert row by default
addCertRow();
</script>
</body></html>
