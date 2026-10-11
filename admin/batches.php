<?php
require_once __DIR__.'/../config.php';
require_once __DIR__.'/partials/auth.php';
require_auth('batches');
$pdo=get_pdo();
if($_SERVER['REQUEST_METHOD']==='POST'&&csrf_verify($_POST['csrf_token']??'')){
    $a=$_POST['action']??'';
    if($a==='save'){
        $id=(int)($_POST['id']??0);
        $course_id=(int)$_POST['course_id'];
        $inst_id=($_POST['instructor_id']??'')?((int)$_POST['instructor_id']):null;
        $batch_name=trim($_POST['batch_name']??'');
        $start=$_POST['start_date']??''; $end=$_POST['end_date']??'';
        $mode=$_POST['mode']??'online'; $venue=trim($_POST['venue']??'');
        $max=(int)($_POST['max_participants']??30);
        $status=$_POST['status']??'planned'; $notes=trim($_POST['notes']??'');
        $is_public=isset($_POST['is_public'])?1:0;
        $price=(int)preg_replace('/\D/','',$_POST['price']??'0');
        $price_notes=trim($_POST['price_notes']??'');
        if($id){$pdo->prepare("UPDATE training_batches SET course_id=?,instructor_id=?,batch_name=?,start_date=?,end_date=?,mode=?,venue=?,max_participants=?,status=?,notes=?,is_public=?,price=?,price_notes=?,updated_at=NOW() WHERE id=?")->execute([$course_id,$inst_id,$batch_name,$start,$end,$mode,$venue,$max,$status,$notes,$is_public,$price,$price_notes,$id]);}
        else{$pdo->prepare("INSERT INTO training_batches (course_id,instructor_id,batch_name,start_date,end_date,mode,venue,max_participants,status,notes,is_public,price,price_notes,created_by) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)")->execute([$course_id,$inst_id,$batch_name,$start,$end,$mode,$venue,$max,$status,$notes,$is_public,$price,$price_notes,current_user_id()]);}
        flash_set('success','Batch disimpan.');
    } elseif($a==='delete'){$pdo->prepare("DELETE FROM training_batches WHERE id=?")->execute([(int)$_POST['id']]);flash_set('success','Batch dihapus.');}
    redirect(SITE_URL.'/admin/batches.php');
}
$filter=$_GET['filter']??'all';
$valid_status=['planned','ongoing','completed','cancelled'];
$where=''; $bparams=[];
if($filter!=='all' && in_array($filter,$valid_status,true)){ $where="WHERE b.status=?"; $bparams[]=$filter; }
$bstmt=$pdo->prepare("SELECT b.*,t.name AS course_name,i.name AS instructor_name,(SELECT COUNT(*) FROM training_registrations WHERE batch_id=b.id AND status IN ('pending','confirmed','completed')) AS participant_count FROM training_batches b JOIN trainings t ON t.id=b.course_id LEFT JOIN instructors i ON i.id=b.instructor_id $where ORDER BY b.start_date DESC LIMIT 50");
$bstmt->execute($bparams);
$batches=$bstmt->fetchAll();
$courses=$pdo->query("SELECT id,name FROM trainings WHERE is_active=1 ORDER BY name")->fetchAll();
$instructors=$pdo->query("SELECT id,name FROM instructors WHERE is_active=1 ORDER BY name")->fetchAll();
$edit=null; if(!empty($_GET['edit'])){$se=$pdo->prepare("SELECT * FROM training_batches WHERE id=?"); $se->execute([(int)$_GET['edit']]); $edit=$se->fetch();}
$status_labels=['planned'=>'Direncanakan','ongoing'=>'Berlangsung','completed'=>'Selesai','cancelled'=>'Dibatalkan'];
$flash=flash_get();
?><!DOCTYPE html><html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Jadwal Batch — Admin</title><meta name="robots" content="noindex,nofollow"><link rel="stylesheet" href="/admin/assets/admin.css"></head>
<body><div class="admin-layout"><div class="mobile-overlay" id="mobileOverlay"></div>
<?php require __DIR__.'/partials/sidebar.php';?>
<main class="admin-main">
<div class="admin-topbar"><button class="topbar-hamburger" id="hamburger"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg></button><div class="topbar-title">Jadwal Batch Pelatihan</div><div class="topbar-actions"><button class="topbar-btn topbar-btn-primary" onclick="openModal('mBatch')">+ Jadwal Batch Baru</button></div></div>
<div class="admin-content">
<?php if($flash):?><div id="flash-message" class="alert alert-<?=$flash['type']==='success'?'success':'error'?>"><?=e($flash['message'])?></div><?php endif;?>
<div class="card">
<div class="filter-bar"><div class="filter-chips">
<?php foreach(['all'=>'Semua','planned'=>'Direncanakan','ongoing'=>'Berlangsung','completed'=>'Selesai','cancelled'=>'Dibatalkan'] as $k=>$v):?>
<a href="?filter=<?=$k?>" class="filter-chip <?=$filter===$k?'active':''?>"><?=$v?></a>
<?php endforeach;?>
</div></div>
<div class="table-wrap"><table class="admin-table"><thead><tr><th>Batch</th><th>Program</th><th>Instruktur</th><th>Tanggal</th><th>Mode</th><th>Peserta</th><th>Status</th><th>Aksi</th></tr></thead><tbody>
<?php if(empty($batches)):?><tr><td colspan="8"><div class="empty-state"><div class="empty-state-icon">📅</div><h3>Belum ada jadwal batch</h3></div></td></tr>
<?php else: foreach($batches as $b):?>
<tr>
<td><?=e($b['batch_name']??'—')?></td>
<td style="font-size:12px;max-width:180px"><div style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis"><?=e($b['course_name'])?></div></td>
<td><?=e($b['instructor_name']??'—')?></td>
<td style="font-size:12px"><?=date('d M',strtotime($b['start_date']))?> – <?=date('d M Y',strtotime($b['end_date']))?></td>
<td><span class="badge badge-draft"><?=ucfirst($b['mode'])?></span></td>
<td><?=$b['participant_count']?>/<?=$b['max_participants']?></td>
<td><span class="badge badge-<?=$b['status']==='completed'?'active':($b['status']==='ongoing'?'active':($b['status']==='cancelled'?'expired':'new'))?>"><?=$status_labels[$b['status']]?></span></td>
<td><div style="display:flex;gap:6px">
<a href="/jadwal/<?=$b['id']?>/" target="_blank" class="btn btn-xs btn-outline">Lihat</a>
<a href="?edit=<?=$b['id']?>" class="btn btn-xs btn-outline">Edit</a>
<form method="post" style="display:inline" onsubmit="return confirm('Hapus batch?')"><?=csrf_field()?><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?=$b['id']?>"><button type="submit" class="btn btn-xs btn-danger">Hapus</button></form>
</div></td></tr>
<?php endforeach; endif;?>
</tbody></table></div></div></div></main></div>
<div class="modal-overlay <?=$edit?'open':''?>" id="mBatch"><div class="modal"><div class="modal-header"><div class="modal-title"><?=$edit?'Edit':'Jadwal'?> Batch</div><button class="modal-close" onclick="closeModal('mBatch')">✕</button></div>
<form method="post"><?=csrf_field()?><input type="hidden" name="action" value="save"><input type="hidden" name="id" value="<?=$edit['id']??0?>">
<div class="modal-body"><div class="form-grid">
<div class="form-group form-full"><label class="form-label">Nama Batch</label><input type="text" name="batch_name" class="form-input" value="<?=e($edit['batch_name']??'')?>" placeholder="mis: K3 Umum Batch 1 Mei 2026"></div>
<div class="form-group form-full"><label class="form-label">Program Pelatihan <span>*</span></label><select name="course_id" class="form-select" required><option value="">-- Pilih Program --</option><?php foreach($courses as $co):?><option value="<?=$co['id']?>" <?=($edit['course_id']??'')==$co['id']?'selected':''?>><?=e($co['name'])?></option><?php endforeach;?></select></div>
<div class="form-group form-full"><label class="form-label">Instruktur</label><select name="instructor_id" class="form-select"><option value="">-- Pilih Instruktur --</option><?php foreach($instructors as $ins):?><option value="<?=$ins['id']?>" <?=($edit['instructor_id']??'')==$ins['id']?'selected':''?>><?=e($ins['name'])?></option><?php endforeach;?></select></div>
<div class="form-group"><label class="form-label">Tanggal Mulai <span>*</span></label><input type="date" name="start_date" class="form-input" value="<?=$edit['start_date']??''?>" required></div>
<div class="form-group"><label class="form-label">Tanggal Selesai <span>*</span></label><input type="date" name="end_date" class="form-input" value="<?=$edit['end_date']??''?>" required></div>
<div class="form-group"><label class="form-label">Mode</label><select name="mode" class="form-select"><option value="online" <?=($edit['mode']??'')==='online'?'selected':''?>><?='Online'?></option><option value="offline" <?=($edit['mode']??'')==='offline'?'selected':''?>><?='Tatap Muka'?></option><option value="hybrid" <?=($edit['mode']??'')==='hybrid'?'selected':''?>><?='Hybrid'?></option></select></div>
<div class="form-group"><label class="form-label">Maks. Peserta</label><input type="number" name="max_participants" class="form-input" value="<?=$edit['max_participants']??30?>" min="1"></div>
<div class="form-group"><label class="form-label">Harga (Rp)</label><input type="text" name="price" class="form-input" value="<?=number_format((int)($edit['price']??0),0,',','.')?>" placeholder="0 = Gratis" oninput="this.value=this.value.replace(/[^0-9.]/g,'')"></div>
<div class="form-group form-full"><label class="form-label">Venue / Link</label><input type="text" name="venue" class="form-input" value="<?=e($edit['venue']??'')?>" placeholder="Alamat venue atau link Zoom/GMeet"></div>
<div class="form-group form-full"><label class="form-label">Catatan Harga</label><input type="text" name="price_notes" class="form-input" value="<?=e($edit['price_notes']??'')?>" placeholder="mis: sudah termasuk sertifikat & konsumsi"></div>
<div class="form-group form-full"><label class="form-label" style="display:flex;align-items:center;gap:8px;cursor:pointer"><input type="checkbox" name="is_public" value="1" <?=(!$edit || !empty($edit['is_public']))?'checked':''?> style="width:auto"> Tampilkan di website (jadwal publik)</label></div>
<div class="form-group"><label class="form-label">Status</label><select name="status" class="form-select"><?php foreach($status_labels as $k=>$v):?><option value="<?=$k?>" <?=($edit['status']??'planned')===$k?'selected':''?>><?=$v?></option><?php endforeach;?></select></div>
<div class="form-group form-full"><label class="form-label">Catatan</label><textarea name="notes" class="form-textarea"><?=e($edit['notes']??'')?></textarea></div>
</div></div>
<div class="modal-footer"><button type="button" class="btn btn-outline" onclick="closeModal('mBatch')">Batal</button><button type="submit" class="btn btn-primary">💾 Simpan</button></div>
</form></div></div>
<script src="/admin/assets/admin.js"></script><?php if($edit):?><script>openModal('mBatch');</script><?php endif;?>
</body></html>
