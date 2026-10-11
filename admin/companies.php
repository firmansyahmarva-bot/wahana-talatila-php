<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/partials/auth.php';
require_auth('companies');
$pdo = get_pdo();

if ($_SERVER['REQUEST_METHOD']==='POST' && csrf_verify($_POST['csrf_token']??'')) {
    $a = $_POST['action']??'';
    if ($a==='save') {
        $id = (int)($_POST['id']??0);
        $f  = ['name','industry','address','city','province','pic_name','pic_phone','pic_email','pic_position','notes'];
        $v  = array_map(fn($k)=>trim($_POST[$k]??''), $f);
        if ($id) {
            $sets = implode(',', array_map(fn($k)=>"$k=?", $f));
            $pdo->prepare("UPDATE companies SET $sets,updated_at=NOW() WHERE id=?")->execute([...$v,$id]);
            flash_set('success','Perusahaan diperbarui.');
        } else {
            $cols = implode(',', $f);
            $ph   = implode(',', array_fill(0,count($f),'?'));
            $pdo->prepare("INSERT INTO companies ($cols) VALUES ($ph)")->execute($v);
            flash_set('success','Perusahaan ditambahkan.');
        }
    } elseif ($a==='delete') {
        $pdo->prepare("DELETE FROM companies WHERE id=?")->execute([(int)$_POST['id']]);
        flash_set('success','Perusahaan dihapus.');
    }
    redirect(SITE_URL.'/admin/companies.php');
}

$search = trim($_GET['q']??'');
$where  = $search ? "WHERE name LIKE ? OR city LIKE ? OR industry LIKE ?" : "";
$params = $search ? array_fill(0,3,"%$search%") : [];
$stC=$pdo->prepare("SELECT COUNT(*) FROM companies $where"); $stC->execute($params);
$total=(int)$stC->fetchColumn();
$page=max(1,(int)($_GET['page']??1)); $per=25; $offset=($page-1)*$per;
$stmt=$pdo->prepare("SELECT co.*, (SELECT COUNT(*) FROM clients WHERE company_id=co.id) AS client_count FROM companies co $where ORDER BY co.name ASC LIMIT $per OFFSET $offset");
$stmt->execute($params); $companies=$stmt->fetchAll();
$total_pages=ceil($total/$per);
$edit=null; if(!empty($_GET['edit'])){$st=$pdo->prepare("SELECT * FROM companies WHERE id=?");$st->execute([(int)$_GET['edit']]);$edit=$st->fetch();}
$flash=flash_get();
?><!DOCTYPE html><html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Perusahaan — Admin</title><meta name="robots" content="noindex,nofollow"><link rel="stylesheet" href="/admin/assets/admin.css"></head>
<body><div class="admin-layout"><div class="mobile-overlay" id="mobileOverlay"></div>
<?php require __DIR__.'/partials/sidebar.php'; ?>
<main class="admin-main">
<div class="admin-topbar"><button class="topbar-hamburger" id="hamburger"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg></button><div class="topbar-title">Data Perusahaan</div><div class="topbar-actions"><button class="topbar-btn topbar-btn-primary" onclick="openModal('mComp')">+ Tambah Perusahaan</button></div></div>
<div class="admin-content">
<?php if($flash):?><div id="flash-message" class="alert alert-<?=$flash['type']==='success'?'success':'error'?>"><?=e($flash['message'])?></div><?php endif;?>
<div class="card">
<div class="filter-bar"><div class="filter-search"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg><form method="get" style="flex:1"><input type="text" name="q" placeholder="Cari nama, kota, industri..." value="<?=e($search)?>" style="border:none;outline:none;width:100%;font-size:13px;background:none;padding:8px 0"></form></div><div class="filter-bar-end"><span style="font-size:12px;color:#6b7280"><?=number_format($total)?> perusahaan</span></div></div>
<div class="table-wrap"><table class="admin-table"><thead><tr><th>Nama Perusahaan</th><th>Industri</th><th>Kota</th><th>PIC</th><th>Kontak</th><th>Peserta</th><th>Aksi</th></tr></thead><tbody>
<?php if(empty($companies)):?><tr><td colspan="7"><div class="empty-state"><div class="empty-state-icon">🏢</div><h3>Belum ada perusahaan</h3></div></td></tr>
<?php else: foreach($companies as $c):?>
<tr>
<td><strong><?=e($c['name'])?></strong></td>
<td><?=e($c['industry']??'—')?></td>
<td><?=e($c['city']??'—')?></td>
<td><?=e($c['pic_name']??'—')?><?php if($c['pic_position']):?><div style="font-size:11px;color:#6b7280"><?=e($c['pic_position'])?></div><?php endif;?></td>
<td><?=e($c['pic_phone']??'—')?></td>
<td><span class="badge badge-active"><?=$c['client_count']?> peserta</span></td>
<td><div style="display:flex;gap:6px">
<?php if($c['pic_phone']):?><button class="btn btn-xs btn-wa" onclick="sendWA('<?=e($c['pic_phone'])?>','Halo <?=e($c['pic_name']??$c['name'])?>, kami dari Wahana Totalita Konsultan Yogyakarta. Kami spesialis pelatihan sertifikasi K3 dan lingkungan BNSP & KEMNAKER RI. Apakah perusahaan Bapak/Ibu sudah memiliki Ahli K3 bersertifikat?')">📱</button><?php endif;?>
<a href="?edit=<?=$c['id']?>" class="btn btn-xs btn-outline">Edit</a>
<form method="post" style="display:inline" onsubmit="return confirm('Hapus perusahaan ini?')">
<?=csrf_field()?><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?=$c['id']?>">
<button type="submit" class="btn btn-xs btn-danger">Hapus</button></form>
</div></td></tr>
<?php endforeach; endif;?>
</tbody></table></div>
<?php if($total_pages>1):?><div class="pagination"><div class="page-info">Menampilkan <?=($offset+1)?>–<?=min($offset+$per,$total)?> dari <?=$total?></div><?php for($p=1;$p<=$total_pages;$p++):?><a href="?q=<?=urlencode($search)?>&page=<?=$p?>" class="page-btn <?=$p===$page?'active':''?>"><?=$p?></a><?php endfor;?></div><?php endif;?>
</div></div></main></div>
<div class="modal-overlay <?=$edit?'open':''?>" id="mComp"><div class="modal" style="max-width:640px"><div class="modal-header"><div class="modal-title"><?=$edit?'Edit':'Tambah'?> Perusahaan</div><button class="modal-close" onclick="closeModal('mComp')">✕</button></div>
<form method="post"><?=csrf_field()?><input type="hidden" name="action" value="save"><input type="hidden" name="id" value="<?=$edit['id']??0?>">
<div class="modal-body"><div class="form-grid">
<div class="form-group form-full"><label class="form-label">Nama Perusahaan <span>*</span></label><input type="text" name="name" class="form-input" value="<?=e($edit['name']??'')?>" required></div>
<div class="form-group"><label class="form-label">Industri</label><input type="text" name="industry" class="form-input" value="<?=e($edit['industry']??'')?>" placeholder="Manufaktur, Pertambangan, dll"></div>
<div class="form-group"><label class="form-label">Kota</label><input type="text" name="city" class="form-input" value="<?=e($edit['city']??'')?>"></div>
<div class="form-group"><label class="form-label">Provinsi</label><input type="text" name="province" class="form-input" value="<?=e($edit['province']??'')?>"></div>
<div class="form-group form-full"><label class="form-label">Alamat</label><textarea name="address" class="form-textarea" rows="2"><?=e($edit['address']??'')?></textarea></div>
<div style="grid-column:1/-1;font-size:13px;font-weight:700;color:#374151;padding-top:8px;border-top:1px solid #e5e9ef;margin-top:4px">Kontak Person (PIC)</div>
<div class="form-group"><label class="form-label">Nama PIC</label><input type="text" name="pic_name" class="form-input" value="<?=e($edit['pic_name']??'')?>"></div>
<div class="form-group"><label class="form-label">Jabatan PIC</label><input type="text" name="pic_position" class="form-input" value="<?=e($edit['pic_position']??'')?>"></div>
<div class="form-group"><label class="form-label">No. HP / WA PIC</label><input type="tel" name="pic_phone" class="form-input" value="<?=e($edit['pic_phone']??'')?>"></div>
<div class="form-group"><label class="form-label">Email PIC</label><input type="email" name="pic_email" class="form-input" value="<?=e($edit['pic_email']??'')?>"></div>
<div class="form-group form-full"><label class="form-label">Catatan</label><textarea name="notes" class="form-textarea"><?=e($edit['notes']??'')?></textarea></div>
</div></div>
<div class="modal-footer"><button type="button" class="btn btn-outline" onclick="closeModal('mComp')">Batal</button><button type="submit" class="btn btn-primary">💾 Simpan</button></div>
</form></div></div>
<script src="/admin/assets/admin.js"></script><?php if($edit):?><script>openModal('mComp');</script><?php endif;?>
</body></html>
