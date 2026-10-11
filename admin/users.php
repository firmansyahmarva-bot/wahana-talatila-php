<?php
require_once __DIR__.'/../config.php';
require_once __DIR__.'/partials/auth.php';
require_auth('users');
$pdo=get_pdo();

if($_SERVER['REQUEST_METHOD']==='POST'&&csrf_verify($_POST['csrf_token']??'')){
    $a=$_POST['action']??'';
    if($a==='approve'){
        $reg_id=(int)$_POST['reg_id'];
        $role=$_POST['role']??'viewer';
        $stmt=$pdo->prepare("SELECT * FROM user_registrations WHERE id=? AND status='pending'");
        $stmt->execute([$reg_id]); $reg=$stmt->fetch();
        if($reg){
            $pdo->prepare("INSERT INTO admin_users (username,password_hash,full_name,email,phone,role,status) VALUES (?,?,?,?,?,?,'active')")
                ->execute([$reg['username'],$reg['password_hash'],$reg['full_name'],$reg['email'],$reg['phone'],$role]);
            $pdo->prepare("UPDATE user_registrations SET status='approved',reviewed_by=?,reviewed_at=NOW() WHERE id=?")->execute([current_user_id(),$reg_id]);
            flash_set('success','Akun '.$reg['username'].' disetujui.');
        }
    } elseif($a==='reject'){
        $pdo->prepare("UPDATE user_registrations SET status='rejected',reviewed_by=?,reviewed_at=NOW() WHERE id=?")->execute([current_user_id(),(int)$_POST['reg_id']]);
        flash_set('success','Pendaftaran ditolak.');
    } elseif($a==='save_user'){
        $id=(int)$_POST['id'];
        $role=$_POST['role']??'viewer';
        $status=$_POST['status']??'active';
        $full_name=trim($_POST['full_name']??'');
        $pdo->prepare("UPDATE admin_users SET role=?,status=?,full_name=? WHERE id=?")->execute([$role,$status,$full_name,$id]);
        if(!empty($_POST['new_password'])&&strlen($_POST['new_password'])>=8){
            $pdo->prepare("UPDATE admin_users SET password_hash=? WHERE id=?")->execute([password_hash($_POST['new_password'],PASSWORD_BCRYPT),  $id]);
        }
        flash_set('success','Pengguna diperbarui.');
    } elseif($a==='delete_user'){
        $id=(int)$_POST['id'];
        if($id!=current_user_id()){$pdo->prepare("DELETE FROM admin_users WHERE id=?")->execute([$id]);flash_set('success','Pengguna dihapus.');}
        else{flash_set('error','Tidak bisa menghapus akun sendiri.');}
    }
    redirect(SITE_URL.'/admin/users.php');
}

$tab=$_GET['tab']??'users';
$users=$pdo->query("SELECT * FROM admin_users ORDER BY role ASC, username ASC")->fetchAll();
$pending=$pdo->query("SELECT * FROM user_registrations WHERE status='pending' ORDER BY created_at DESC")->fetchAll();
$edit=null; if(!empty($_GET['edit'])){$se=$pdo->prepare("SELECT * FROM admin_users WHERE id=?"); $se->execute([(int)$_GET['edit']]); $edit=$se->fetch();}
$flash=flash_get();
?><!DOCTYPE html><html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Pengguna — Admin</title><meta name="robots" content="noindex,nofollow"><link rel="stylesheet" href="/admin/assets/admin.css"></head>
<body><div class="admin-layout"><div class="mobile-overlay" id="mobileOverlay"></div>
<?php require __DIR__.'/partials/sidebar.php';?>
<main class="admin-main">
<div class="admin-topbar"><button class="topbar-hamburger" id="hamburger"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg></button><div class="topbar-title">Kelola Pengguna Admin</div></div>
<div class="admin-content">
<?php if($flash):?><div id="flash-message" class="alert alert-<?=$flash['type']==='success'?'success':'error'?>"><?=e($flash['message'])?></div><?php endif;?>
<?php if(!empty($pending)):?>
<div class="alert alert-warning" style="margin-bottom:20px">⚠️ <strong><?=count($pending)?> pendaftaran akun</strong> menunggu persetujuan Anda.</div>
<?php endif;?>
<div style="display:flex;border-bottom:2px solid #e5e9ef;margin-bottom:20px;gap:0">
<a href="?tab=users" style="padding:10px 20px;font-size:13px;font-weight:600;color:<?=$tab==='users'?'#0A4A2E':'#6b7280'?>;border-bottom:2px solid <?=$tab==='users'?'#0A4A2E':'transparent'?>;margin-bottom:-2px">Pengguna Aktif (<?=count($users)?>)</a>
<a href="?tab=registrations" style="padding:10px 20px;font-size:13px;font-weight:600;color:<?=$tab==='registrations'?'#0A4A2E':'#6b7280'?>;border-bottom:2px solid <?=$tab==='registrations'?'#0A4A2E':'transparent'?>;margin-bottom:-2px">Menunggu Persetujuan (<?=count($pending)?>)</a>
</div>
<?php if($tab==='users'):?>
<div class="card">
<div class="table-wrap"><table class="admin-table"><thead><tr><th>Nama</th><th>Username</th><th>Role</th><th>Status</th><th>Login Terakhir</th><th>Aksi</th></tr></thead><tbody>
<?php foreach($users as $u):?>
<tr>
<td><strong><?=e($u['full_name']??$u['username'])?></strong><?php if($u['email']):?><div style="font-size:11px;color:#6b7280"><?=e($u['email'])?></div><?php endif;?></td>
<td style="font-family:monospace"><?=e($u['username'])?></td>
<td><span class="badge badge-active" style="background:<?=ROLE_LABELS[$u['role']]['color']??'#666'?>22;color:<?=ROLE_LABELS[$u['role']]['color']??'#666'?>"><?=ROLE_LABELS[$u['role']]['label']??$u['role']?></span></td>
<td><span class="badge <?=$u['status']==='active'?'badge-active':($u['status']==='pending'?'badge-expiring':'badge-expired')?>"><?=ucfirst($u['status'])?></span></td>
<td style="font-size:12px"><?=$u['last_login_at']?date('d M Y H:i',strtotime($u['last_login_at'])):'Belum pernah'?></td>
<td><div style="display:flex;gap:6px">
<?php if($u['id']!==current_user_id()):?>
<a href="?edit=<?=$u['id']?>" class="btn btn-xs btn-outline">Edit</a>
<form method="post" style="display:inline" onsubmit="return confirm('Hapus pengguna ini?')"><?=csrf_field()?><input type="hidden" name="action" value="delete_user"><input type="hidden" name="id" value="<?=$u['id']?>"><button type="submit" class="btn btn-xs btn-danger">Hapus</button></form>
<?else:?><span style="font-size:11px;color:#9ca3af">Akun Anda</span><?php endif;?>
</div></td></tr>
<?php endforeach;?>
</tbody></table></div></div>
<?php else:?>
<div class="card">
<div class="table-wrap"><table class="admin-table"><thead><tr><th>Nama</th><th>Username</th><th>Role Diminta</th><th>HP</th><th>Mendaftar</th><th>Aksi</th></tr></thead><tbody>
<?php if(empty($pending)):?><tr><td colspan="6"><div class="empty-state"><div class="empty-state-icon">✅</div><h3>Tidak ada pendaftaran menunggu</h3></div></td></tr>
<?php else: foreach($pending as $pr):?>
<tr>
<td><strong><?=e($pr['full_name'])?></strong><?php if($pr['email']):?><div style="font-size:11px;color:#6b7280"><?=e($pr['email'])?></div><?php endif;?></td>
<td style="font-family:monospace"><?=e($pr['username'])?></td>
<td><span class="badge badge-draft"><?=ROLE_LABELS[$pr['role_requested']]['label']??$pr['role_requested']?></span></td>
<td><?=e($pr['phone']??'—')?></td>
<td style="font-size:12px"><?=date('d M Y H:i',strtotime($pr['created_at']))?></td>
<td>
<form method="post" style="display:flex;gap:6px;align-items:center"><?=csrf_field()?>
<input type="hidden" name="reg_id" value="<?=$pr['id']?>">
<select name="role" class="form-select" style="padding:4px 8px;font-size:12px;width:auto">
<?php foreach(ROLE_LABELS as $k=>$v): if($k==='superadmin') continue;?><option value="<?=$k?>" <?=$k===$pr['role_requested']?'selected':''?>><?=$v['label']?></option><?php endforeach;?>
</select>
<button type="submit" name="action" value="approve" class="btn btn-xs btn-primary">✅ Setujui</button>
<button type="submit" name="action" value="reject" class="btn btn-xs btn-danger" onclick="return confirm('Tolak pendaftaran ini?')">❌ Tolak</button>
</form></td></tr>
<?php endforeach; endif;?>
</tbody></table></div></div>
<?php endif;?>
</div></main></div>
<div class="modal-overlay <?=$edit?'open':''?>" id="mEditUser"><div class="modal"><div class="modal-header"><div class="modal-title">Edit Pengguna</div><button class="modal-close" onclick="closeModal('mEditUser')">✕</button></div>
<?php if($edit):?>
<form method="post"><?=csrf_field()?><input type="hidden" name="action" value="save_user"><input type="hidden" name="id" value="<?=$edit['id']?>">
<div class="modal-body"><div class="form-grid">
<div class="form-group form-full"><label class="form-label">Nama Lengkap</label><input type="text" name="full_name" class="form-input" value="<?=e($edit['full_name']??$edit['username'])?>"></div>
<div class="form-group"><label class="form-label">Role</label><select name="role" class="form-select"><?php foreach(ROLE_LABELS as $k=>$v):?><option value="<?=$k?>" <?=$edit['role']===$k?'selected':''?>><?=$v['label']?></option><?php endforeach;?></select></div>
<div class="form-group"><label class="form-label">Status</label><select name="status" class="form-select"><option value="active" <?=$edit['status']==='active'?'selected':''?>><?='Aktif'?></option><option value="suspended" <?=$edit['status']==='suspended'?'selected':''?>><?='Nonaktif'?></option></select></div>
<div class="form-group form-full"><label class="form-label">Password Baru (kosongkan jika tidak ubah)</label><input type="password" name="new_password" class="form-input" placeholder="Min. 8 karakter"></div>
</div></div>
<div class="modal-footer"><button type="button" class="btn btn-outline" onclick="closeModal('mEditUser')">Batal</button><button type="submit" class="btn btn-primary">💾 Simpan</button></div>
</form>
<?php endif;?>
</div></div>
<script src="/admin/assets/admin.js"></script><?php if($edit):?><script>openModal('mEditUser');</script><?php endif;?>
</body></html>
