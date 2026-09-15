<?php
require_once __DIR__.'/../config.php';
require_once __DIR__.'/partials/auth.php';
require_auth('expenses');
$pdo=get_pdo();
if($_SERVER['REQUEST_METHOD']==='POST'&&csrf_verify($_POST['csrf_token']??'')){
    $a=$_POST['action']??'';
    if($a==='save'){
        $id=(int)($_POST['id']??0);
        $cat=$_POST['category']??'other';
        $desc=trim($_POST['description']??'');
        $amt=(float)$_POST['amount'];
        $date=$_POST['expense_date']??date('Y-m-d');
        $rec=trim($_POST['receipt_number']??'');
        $vendor=trim($_POST['vendor']??'');
        $notes=trim($_POST['notes']??'');
        if($id){$pdo->prepare("UPDATE expenses SET category=?,description=?,amount=?,expense_date=?,receipt_number=?,vendor=?,notes=? WHERE id=?")->execute([$cat,$desc,$amt,$date,$rec,$vendor,$notes,$id]);}
        else{$pdo->prepare("INSERT INTO expenses (category,description,amount,expense_date,receipt_number,vendor,notes,created_by) VALUES (?,?,?,?,?,?,?,?)")->execute([$cat,$desc,$amt,$date,$rec,$vendor,$notes,current_user_id()]);}
        flash_set('success','Pengeluaran disimpan.');
    } elseif($a==='delete'){$pdo->prepare("DELETE FROM expenses WHERE id=?")->execute([(int)$_POST['id']]);flash_set('success','Pengeluaran dihapus.');}
    redirect(SITE_URL.'/admin/expenses.php');
}
$year=(int)($_GET['year']??date('Y')); $month=(int)($_GET['month']??date('n'));
$exp=$pdo->prepare("SELECT * FROM expenses WHERE YEAR(expense_date)=? AND MONTH(expense_date)=? ORDER BY expense_date DESC"); $exp->execute([$year,$month]); $expenses=$exp->fetchAll();
$total_exp=(float)$pdo->prepare("SELECT COALESCE(SUM(amount),0) FROM expenses WHERE YEAR(expense_date)=? AND MONTH(expense_date)=?")->execute([$year,$month]) ? 0 : 0;
$st=$pdo->prepare("SELECT COALESCE(SUM(amount),0) FROM expenses WHERE YEAR(expense_date)=? AND MONTH(expense_date)=?"); $st->execute([$year,$month]); $total_exp=(float)$st->fetchColumn();
$edit=null; if(!empty($_GET['edit'])){$se=$pdo->prepare("SELECT * FROM expenses WHERE id=?"); $se->execute([(int)$_GET['edit']]); $edit=$se->fetch();}
$cat_labels=['instructor'=>'Instruktur','venue'=>'Venue','materials'=>'Materi','transport'=>'Transport','marketing'=>'Marketing','operational'=>'Operasional','other'=>'Lainnya'];
$months_id=['','Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
$flash=flash_get();
?><!DOCTYPE html><html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Pengeluaran — Admin</title><meta name="robots" content="noindex,nofollow"><link rel="stylesheet" href="/admin/assets/admin.css"></head>
<body><div class="admin-layout"><div class="mobile-overlay" id="mobileOverlay"></div>
<?php require __DIR__.'/partials/sidebar.php';?>
<main class="admin-main">
<div class="admin-topbar"><button class="topbar-hamburger" id="hamburger"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg></button>
<div class="topbar-title">Pengeluaran</div>
<div class="topbar-actions">
<form method="get" style="display:flex;gap:8px">
<select name="month" class="form-select" style="width:auto;padding:7px 10px"><?php for($m=1;$m<=12;$m++):?><option value="<?=$m?>" <?=$m===$month?'selected':''?>><?=$months_id[$m]?></option><?php endfor;?></select>
<select name="year" class="form-select" style="width:auto;padding:7px 10px"><?php for($y=date('Y');$y>=date('Y')-3;$y--):?><option value="<?=$y?>" <?=$y===$year?'selected':''?>><?=$y?></option><?php endfor;?></select>
<button type="submit" class="btn btn-outline btn-sm">Tampilkan</button>
</form>
<button class="topbar-btn topbar-btn-primary" onclick="openModal('mExp')">+ Tambah Pengeluaran</button>
</div></div>
<div class="admin-content">
<?php if($flash):?><div id="flash-message" class="alert alert-<?=$flash['type']==='success'?'success':'error'?>"><?=e($flash['message'])?></div><?php endif;?>
<div class="stat-card orange" style="margin-bottom:20px;display:inline-block;min-width:280px"><div class="stat-card-icon">📤</div><div class="stat-card-num" style="font-size:20px">Rp <?=number_format($total_exp,0,',','.')?></div><div class="stat-card-label">Total Pengeluaran <?=$months_id[$month]?> <?=$year?></div></div>
<div class="card">
<div class="table-wrap"><table class="admin-table"><thead><tr><th>Tanggal</th><th>Kategori</th><th>Deskripsi</th><th>Vendor</th><th>Jumlah</th><th>No Kwitansi</th><th>Aksi</th></tr></thead><tbody>
<?php if(empty($expenses)):?><tr><td colspan="7"><div class="empty-state"><div class="empty-state-icon">📭</div><h3>Belum ada pengeluaran</h3></div></td></tr>
<?php else: foreach($expenses as $e):?>
<tr>
<td><?=date('d M Y',strtotime($e['expense_date']))?></td>
<td><span class="badge badge-draft"><?=$cat_labels[$e['category']]??$e['category']?></span></td>
<td><?=e($e['description'])?></td>
<td><?=e($e['vendor']??'—')?></td>
<td><strong>Rp <?=number_format($e['amount'],0,',','.')?></strong></td>
<td style="font-size:12px"><?=e($e['receipt_number']??'—')?></td>
<td><div style="display:flex;gap:6px">
<a href="?edit=<?=$e['id']?>&year=<?=$year?>&month=<?=$month?>" class="btn btn-xs btn-outline">Edit</a>
<form method="post" style="display:inline" onsubmit="return confirm('Hapus?')">
<?=csrf_field()?><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?=$e['id']?>">
<button type="submit" class="btn btn-xs btn-danger">Hapus</button></form>
</div></td></tr>
<?php endforeach; endif;?>
</tbody></table></div></div></div></main></div>
<div class="modal-overlay <?=$edit?'open':''?>" id="mExp"><div class="modal"><div class="modal-header"><div class="modal-title"><?=$edit?'Edit':'Tambah'?> Pengeluaran</div><button class="modal-close" onclick="closeModal('mExp')">✕</button></div>
<form method="post"><?=csrf_field()?><input type="hidden" name="action" value="save"><input type="hidden" name="id" value="<?=$edit['id']??0?>">
<div class="modal-body"><div class="form-grid">
<div class="form-group form-full"><label class="form-label">Deskripsi <span>*</span></label><input type="text" name="description" class="form-input" value="<?=e($edit['description']??'')?>" required></div>
<div class="form-group"><label class="form-label">Kategori</label><select name="category" class="form-select"><?php foreach($cat_labels as $k=>$v):?><option value="<?=$k?>" <?=($edit['category']??'')===$k?'selected':''?>><?=$v?></option><?php endforeach;?></select></div>
<div class="form-group"><label class="form-label">Jumlah <span>*</span></label><input type="number" name="amount" class="form-input" value="<?=$edit['amount']??0?>" min="0" step="1000" required></div>
<div class="form-group"><label class="form-label">Tanggal</label><input type="date" name="expense_date" class="form-input" value="<?=$edit['expense_date']??date('Y-m-d')?>"></div>
<div class="form-group"><label class="form-label">Vendor / Supplier</label><input type="text" name="vendor" class="form-input" value="<?=e($edit['vendor']??'')?>"></div>
<div class="form-group"><label class="form-label">No. Kwitansi / Faktur</label><input type="text" name="receipt_number" class="form-input" value="<?=e($edit['receipt_number']??'')?>"></div>
<div class="form-group form-full"><label class="form-label">Catatan</label><textarea name="notes" class="form-textarea"><?=e($edit['notes']??'')?></textarea></div>
</div></div>
<div class="modal-footer"><button type="button" class="btn btn-outline" onclick="closeModal('mExp')">Batal</button><button type="submit" class="btn btn-primary">💾 Simpan</button></div>
</form></div></div>
<script src="/admin/assets/admin.js"></script><?php if($edit):?><script>openModal('mExp');</script><?php endif;?>
</body></html>
