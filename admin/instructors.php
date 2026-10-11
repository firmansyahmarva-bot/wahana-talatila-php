<?php
require_once __DIR__.'/../config.php';
require_once __DIR__.'/partials/auth.php';
require_auth('batches');
$pdo=get_pdo();
if($_SERVER['REQUEST_METHOD']==='POST'&&csrf_verify($_POST['csrf_token']??'')){
    $a=$_POST['action']??'';
    if($a==='save'){
        $id=(int)($_POST['id']??0);
        $name=trim($_POST['name']??''); $phone=trim($_POST['phone']??''); $email=trim($_POST['email']??'');
        $exp=trim($_POST['expertise']??''); $cert=trim($_POST['certification']??'');
        $fee=$_POST['fee_per_day']??(float)$_POST['fee_per_day']??null;
        $notes=trim($_POST['notes']??'');
        if($id){$pdo->prepare("UPDATE instructors SET name=?,phone=?,email=?,expertise=?,certification=?,fee_per_day=?,notes=?,is_active=1 WHERE id=?")->execute([$name,$phone,$email,$exp,$cert,$fee,$notes,$id]);}
        else{$pdo->prepare("INSERT INTO instructors (name,phone,email,expertise,certification,fee_per_day,notes) VALUES (?,?,?,?,?,?,?)")->execute([$name,$phone,$email,$exp,$cert,$fee,$notes]);}
        flash_set('success','Instruktur disimpan.');
    } elseif($a==='delete'){$pdo->prepare("DELETE FROM instructors WHERE id=?")->execute([(int)$_POST['id']]);flash_set('success','Instruktur dihapus.');}
    redirect(SITE_URL.'/admin/instructors.php');
}
$inst=$pdo->query("SELECT * FROM instructors ORDER BY name ASC")->fetchAll();
$edit=null; if(!empty($_GET['edit'])){$se=$pdo->prepare("SELECT * FROM instructors WHERE id=?"); $se->execute([(int)$_GET['edit']]); $edit=$se->fetch();}
$flash=flash_get();
?><!DOCTYPE html><html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Instruktur — Admin</title><meta name="robots" content="noindex,nofollow"><link rel="stylesheet" href="/admin/assets/admin.css"></head>
<body><div class="admin-layout"><div class="mobile-overlay" id="mobileOverlay"></div>
<?php require __DIR__.'/partials/sidebar.php';?>
<main class="admin-main">
<div class="admin-topbar"><button class="topbar-hamburger" id="hamburger"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg></button><div class="topbar-title">Instruktur</div><div class="topbar-actions"><button class="topbar-btn topbar-btn-primary" onclick="openModal('mInst')">+ Tambah Instruktur</button></div></div>
<div class="admin-content">
<?php if($flash):?><div id="flash-message" class="alert alert-<?=$flash['type']==='success'?'success':'error'?>"><?=e($flash['message'])?></div><?php endif;?>
<div class="card"><div class="table-wrap"><table class="admin-table"><thead><tr><th>Nama</th><th>No HP</th><th>Email</th><th>Keahlian</th><th>Fee/Hari</th><th>Aksi</th></tr></thead><tbody>
<?php if(empty($inst)):?><tr><td colspan="6"><div class="empty-state"><div class="empty-state-icon">👨‍🏫</div><h3>Belum ada instruktur</h3></div></td></tr>
<?php else: foreach($inst as $ins):?>
<tr><td><strong><?=e($ins['name'])?></strong></td><td><?=e($ins['phone']??'—')?></td><td style="font-size:12px"><?=e($ins['email']??'—')?></td>
<td style="font-size:12px"><?=e(substr($ins['expertise']??'—',0,50))?></td>
<td><?=$ins['fee_per_day']?'Rp '.number_format($ins['fee_per_day'],0,',','.'):'—'?></td>
<td><div style="display:flex;gap:6px">
<a href="?edit=<?=$ins['id']?>" class="btn btn-xs btn-outline">Edit</a>
<form method="post" style="display:inline" onsubmit="return confirm('Hapus?')"><?=csrf_field()?><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?=$ins['id']?>"><button type="submit" class="btn btn-xs btn-danger">Hapus</button></form>
</div></td></tr>
<?php endforeach; endif;?>
</tbody></table></div></div></div></main></div>
<div class="modal-overlay <?=$edit?'open':''?>" id="mInst"><div class="modal"><div class="modal-header"><div class="modal-title"><?=$edit?'Edit':'Tambah'?> Instruktur</div><button class="modal-close" onclick="closeModal('mInst')">✕</button></div>
<form method="post"><?=csrf_field()?><input type="hidden" name="action" value="save"><input type="hidden" name="id" value="<?=$edit['id']??0?>">
<div class="modal-body"><div class="form-grid">
<div class="form-group form-full"><label class="form-label">Nama <span>*</span></label><input type="text" name="name" class="form-input" value="<?=e($edit['name']??'')?>" required></div>
<div class="form-group"><label class="form-label">No HP</label><input type="tel" name="phone" class="form-input" value="<?=e($edit['phone']??'')?>"></div>
<div class="form-group"><label class="form-label">Email</label><input type="email" name="email" class="form-input" value="<?=e($edit['email']??'')?>"></div>
<div class="form-group"><label class="form-label">Fee Per Hari (Rp)</label><input type="number" name="fee_per_day" class="form-input" value="<?=$edit['fee_per_day']??''?>"></div>
<div class="form-group form-full"><label class="form-label">Keahlian</label><input type="text" name="expertise" class="form-input" value="<?=e($edit['expertise']??'')?>" placeholder="K3 Umum, Lingkungan, Mining..."></div>
<div class="form-group form-full"><label class="form-label">Sertifikasi Dimiliki</label><textarea name="certification" class="form-textarea"><?=e($edit['certification']??'')?></textarea></div>
<div class="form-group form-full"><label class="form-label">Catatan</label><textarea name="notes" class="form-textarea"><?=e($edit['notes']??'')?></textarea></div>
</div></div>
<div class="modal-footer"><button type="button" class="btn btn-outline" onclick="closeModal('mInst')">Batal</button><button type="submit" class="btn btn-primary">💾 Simpan</button></div>
</form></div></div>
<script src="/admin/assets/admin.js"></script><?php if($edit):?><script>openModal('mInst');</script><?php endif;?>
</body></html>
