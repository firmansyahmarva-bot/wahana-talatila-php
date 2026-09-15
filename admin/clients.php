<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/partials/auth.php';
require_auth('clients');
$pdo = get_pdo();

if ($_SERVER['REQUEST_METHOD']==='POST' && csrf_verify($_POST['csrf_token']??'')) {
    $a = $_POST['action']??'';
    if ($a==='save') {
        $id   = (int)($_POST['id']??0);
        $data = [
            trim($_POST['name']??''),
            ($_POST['company_id']??'')??(int)$_POST['company_id']??null,
            trim($_POST['nik']??''),
            trim($_POST['position']??''),
            trim($_POST['phone']??''),
            trim($_POST['email']??''),
            trim($_POST['address']??''),
            trim($_POST['notes']??''),
        ];
        $co = ($_POST['company_id']??'')?((int)$_POST['company_id']??null):null;
        if ($id) {
            $pdo->prepare("UPDATE clients SET name=?,company_id=?,nik=?,position=?,phone=?,email=?,address=?,notes=?,updated_at=NOW() WHERE id=?")
                ->execute([$data[0],$co,$data[2],$data[3],$data[4],$data[5],$data[6],$data[7],$id]);
            flash_set('success','Peserta diperbarui.');
        } else {
            $pdo->prepare("INSERT INTO clients (name,company_id,nik,position,phone,email,address,notes) VALUES (?,?,?,?,?,?,?,?)")
                ->execute([$data[0],$co,$data[2],$data[3],$data[4],$data[5],$data[6],$data[7]]);
            flash_set('success','Peserta ditambahkan.');
        }
    } elseif ($a==='delete') {
        $pdo->prepare("DELETE FROM clients WHERE id=?")->execute([(int)$_POST['id']]);
        flash_set('success','Peserta dihapus.');
    } elseif ($a==='import_csv') {
        // ── Bulk import peserta dari CSV (kolom: name,company,position,phone,email,notes) ──
        // Aman dijalankan berulang: peserta dengan nama+HP yang sama dilewati.
        if (!empty($_FILES['csvfile']['tmp_name']) && is_uploaded_file($_FILES['csvfile']['tmp_name'])) {
            @set_time_limit(300);
            $ins = 0; $dup = 0; $newCo = 0; $bad = 0;

            // Muat kunci dedupe (nama+HP) dari data yang sudah ada.
            $existing = [];
            foreach ($pdo->query("SELECT LOWER(name) n, phone p FROM clients")->fetchAll() as $row) {
                $existing[$row['n'] . '|' . preg_replace('/\D/', '', (string)$row['p'])] = true;
            }
            // Peta nama perusahaan -> id (lowercase).
            $coMap = [];
            foreach ($pdo->query("SELECT id, LOWER(name) n FROM companies")->fetchAll() as $row) {
                $coMap[$row['n']] = (int)$row['id'];
            }
            $insCo = $pdo->prepare("INSERT INTO companies (name,is_active) VALUES (?,1)");
            $insCl = $pdo->prepare("INSERT INTO clients (name,company_id,position,phone,email,notes) VALUES (?,?,?,?,?,?)");

            $fh = fopen($_FILES['csvfile']['tmp_name'], 'r');
            if ($fh) {
                $first = fgetcsv($fh); // baris header — dilewati
                $pdo->beginTransaction();
                try {
                    while (($r = fgetcsv($fh)) !== false) {
                        $name = trim((string)($r[0] ?? ''));
                        if ($name === '') { $bad++; continue; }
                        $company  = trim((string)($r[1] ?? ''));
                        $position = trim((string)($r[2] ?? ''));
                        $phone    = trim((string)($r[3] ?? ''));
                        $email    = trim((string)($r[4] ?? ''));
                        $notes    = trim((string)($r[5] ?? ''));

                        $key = mb_strtolower($name) . '|' . preg_replace('/\D/', '', $phone);
                        if (isset($existing[$key])) { $dup++; continue; }

                        $coId = null;
                        if ($company !== '') {
                            $cl = mb_strtolower($company);
                            if (!isset($coMap[$cl])) {
                                $insCo->execute([$company]);
                                $coMap[$cl] = (int)$pdo->lastInsertId();
                                $newCo++;
                            }
                            $coId = $coMap[$cl];
                        }
                        $insCl->execute([$name, $coId, $position, $phone, $email, $notes]);
                        $existing[$key] = true;
                        $ins++;
                    }
                    $pdo->commit();
                    flash_set('success', "Import selesai: {$ins} peserta baru, {$dup} duplikat dilewati, {$newCo} perusahaan baru dibuat.");
                } catch (Throwable $e) {
                    $pdo->rollBack();
                    flash_set('error', 'Import gagal: ' . $e->getMessage());
                }
                fclose($fh);
            } else {
                flash_set('error', 'Tidak bisa membaca file CSV.');
            }
        } else {
            flash_set('error', 'File CSV tidak ditemukan atau gagal diupload.');
        }
    }
    redirect(SITE_URL.'/admin/clients.php');
}

$search = trim($_GET['q']??'');
$page   = max(1,(int)($_GET['page']??1));
$per    = 25; $offset = ($page-1)*$per;
$where  = $search ? "WHERE cl.name LIKE ? OR cl.phone LIKE ? OR cl.email LIKE ? OR co.name LIKE ?" : "";
$params = $search ? array_fill(0,4,"%$search%") : [];

$total = (int)$pdo->prepare("SELECT COUNT(*) FROM clients cl LEFT JOIN companies co ON co.id=cl.company_id $where")->execute($params) ? 0 : 0;
$stC = $pdo->prepare("SELECT COUNT(*) FROM clients cl LEFT JOIN companies co ON co.id=cl.company_id $where");
$stC->execute($params); $total=(int)$stC->fetchColumn();

$stmt = $pdo->prepare("SELECT cl.*, co.name AS company_name,
    (SELECT COUNT(*) FROM certifications WHERE client_id=cl.id) AS cert_count
    FROM clients cl LEFT JOIN companies co ON co.id=cl.company_id
    $where ORDER BY cl.name ASC LIMIT $per OFFSET $offset");
$stmt->execute($params); $clients=$stmt->fetchAll();
$total_pages=ceil($total/$per);
$companies=$pdo->query("SELECT id,name FROM companies WHERE is_active=1 ORDER BY name ASC")->fetchAll();
$edit=null; if(!empty($_GET['edit'])){$st=$pdo->prepare("SELECT * FROM clients WHERE id=?");$st->execute([(int)$_GET['edit']]);$edit=$st->fetch();}
$flash=flash_get();
?><!DOCTYPE html><html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Peserta — Admin</title><meta name="robots" content="noindex,nofollow"><link rel="stylesheet" href="/admin/assets/admin.css"></head>
<body><div class="admin-layout"><div class="mobile-overlay" id="mobileOverlay"></div>
<?php require __DIR__.'/partials/sidebar.php'; ?>
<main class="admin-main">
<div class="admin-topbar"><button class="topbar-hamburger" id="hamburger"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg></button><div class="topbar-title">Data Peserta</div><div class="topbar-actions"><button class="topbar-btn" onclick="openModal('mImport')">⬆ Import CSV</button> <button class="topbar-btn topbar-btn-primary" onclick="openModal('mClient')">+ Tambah Peserta</button></div></div>
<div class="admin-content">
<?php if($flash):?><div id="flash-message" class="alert alert-<?=$flash['type']==='success'?'success':'error'?>"><?=e($flash['message'])?></div><?php endif;?>
<div class="card">
<div class="filter-bar"><div class="filter-search"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg><form method="get" style="flex:1"><input type="text" name="q" placeholder="Cari nama, HP, email, perusahaan..." value="<?=e($search)?>" style="border:none;outline:none;width:100%;font-size:13px;background:none;padding:8px 0"></form></div><div class="filter-bar-end"><span style="font-size:12px;color:#6b7280"><?=number_format($total)?> peserta</span></div></div>
<div class="table-wrap"><table class="admin-table"><thead><tr><th>Nama</th><th>Perusahaan</th><th>No HP</th><th>Email</th><th>Jabatan</th><th>Sertifikasi</th><th>Aksi</th></tr></thead><tbody>
<?php if(empty($clients)):?><tr><td colspan="7"><div class="empty-state"><div class="empty-state-icon">👥</div><h3>Belum ada peserta</h3></div></td></tr>
<?php else: foreach($clients as $c):?>
<tr>
<td><strong><?=e($c['name'])?></strong><?php if($c['nik']):?><div style="font-size:11px;color:#6b7280">NIK: <?=e($c['nik'])?></div><?php endif;?></td>
<td><?=e($c['company_name']??'—')?></td>
<td><?=e($c['phone']??'—')?></td>
<td style="font-size:12px"><?=e($c['email']??'—')?></td>
<td><?=e($c['position']??'—')?></td>
<td><span class="badge badge-active"><?=$c['cert_count']?> sertifikat</span></td>
<td><div style="display:flex;gap:6px">
<?php if($c['phone']):?><button class="btn btn-xs btn-wa" onclick="sendWA('<?=e($c['phone'])?>','Halo <?=e($c['name'])?>, kami dari Wahana Totalita Konsultan. Apakah ada yang bisa kami bantu?')">📱</button><?php endif;?>
<a href="?edit=<?=$c['id']?>" class="btn btn-xs btn-outline">Edit</a>
<form method="post" style="display:inline" onsubmit="return confirm('Hapus peserta ini?')">
<?=csrf_field()?><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?=$c['id']?>">
<button type="submit" class="btn btn-xs btn-danger">Hapus</button></form>
</div></td></tr>
<?php endforeach; endif;?>
</tbody></table></div>
<?php if($total_pages>1):?><div class="pagination"><div class="page-info">Menampilkan <?=($offset+1)?>–<?=min($offset+$per,$total)?> dari <?=$total?></div>
<?php for($p=1;$p<=$total_pages;$p++):?><a href="?q=<?=urlencode($search)?>&page=<?=$p?>" class="page-btn <?=$p===$page?'active':''?>"><?=$p?></a><?php endfor;?></div><?php endif;?>
</div></div></main></div>
<div class="modal-overlay <?=$edit?'open':''?>" id="mClient"><div class="modal"><div class="modal-header"><div class="modal-title"><?=$edit?'Edit':'Tambah'?> Peserta</div><button class="modal-close" onclick="closeModal('mClient')">✕</button></div>
<form method="post"><?=csrf_field()?><input type="hidden" name="action" value="save"><input type="hidden" name="id" value="<?=$edit['id']??0?>">
<div class="modal-body"><div class="form-grid">
<div class="form-group form-full"><label class="form-label">Nama Lengkap <span>*</span></label><input type="text" name="name" class="form-input" value="<?=e($edit['name']??'')?>" required></div>
<div class="form-group"><label class="form-label">Perusahaan</label><select name="company_id" class="form-select"><option value="">— Individu —</option><?php foreach($companies as $co):?><option value="<?=$co['id']?>" <?=($edit['company_id']??'')==$co['id']?'selected':''?>><?=e($co['name'])?></option><?php endforeach;?></select></div>
<div class="form-group"><label class="form-label">NIK KTP</label><input type="text" name="nik" class="form-input" value="<?=e($edit['nik']??'')?>"></div>
<div class="form-group"><label class="form-label">Jabatan</label><input type="text" name="position" class="form-input" value="<?=e($edit['position']??'')?>"></div>
<div class="form-group"><label class="form-label">No. WhatsApp</label><input type="tel" name="phone" class="form-input" value="<?=e($edit['phone']??'')?>"></div>
<div class="form-group"><label class="form-label">Email</label><input type="email" name="email" class="form-input" value="<?=e($edit['email']??'')?>"></div>
<div class="form-group form-full"><label class="form-label">Alamat</label><textarea name="address" class="form-textarea"><?=e($edit['address']??'')?></textarea></div>
<div class="form-group form-full"><label class="form-label">Catatan</label><textarea name="notes" class="form-textarea"><?=e($edit['notes']??'')?></textarea></div>
</div></div>
<div class="modal-footer"><button type="button" class="btn btn-outline" onclick="closeModal('mClient')">Batal</button><button type="submit" class="btn btn-primary">💾 Simpan</button></div>
</form></div></div>
<!-- Import CSV modal -->
<div class="modal-overlay" id="mImport"><div class="modal"><div class="modal-header"><div class="modal-title">Import Peserta dari CSV</div><button class="modal-close" onclick="closeModal('mImport')">✕</button></div>
<form method="post" enctype="multipart/form-data"><?=csrf_field()?><input type="hidden" name="action" value="import_csv">
<div class="modal-body">
<p style="font-size:13px;color:#6b7280;margin-bottom:14px;line-height:1.6">Upload file CSV dengan kolom (urut): <strong>name, company, position, phone, email, notes</strong>.<br>Peserta dengan kombinasi <strong>nama + No HP</strong> yang sudah ada akan otomatis dilewati, jadi aman dijalankan berulang. Perusahaan baru dibuat otomatis.</p>
<div class="form-group form-full"><label class="form-label">File CSV <span>*</span></label><input type="file" name="csvfile" accept=".csv" class="form-input" required></div>
</div>
<div class="modal-footer"><button type="button" class="btn btn-outline" onclick="closeModal('mImport')">Batal</button><button type="submit" class="btn btn-primary">⬆ Import Sekarang</button></div>
</form></div></div>
<script src="/admin/assets/admin.js"></script>
<?php if($edit):?>
<script>openModal('mClient');</script>
<?php endif;?>
</body></html>
