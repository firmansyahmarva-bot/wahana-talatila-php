<?php
require_once __DIR__.'/../config.php';
require_once __DIR__.'/partials/auth.php';
require_auth('targets');
$pdo=get_pdo();
if($_SERVER['REQUEST_METHOD']==='POST'&&csrf_verify($_POST['csrf_token']??'')){
    $year=(int)$_POST['year']; $month=(int)$_POST['month'];
    $rt=(float)$_POST['revenue_target']; $nc=(int)$_POST['new_clients_target'];
    $ct=(int)$_POST['certifications_target']; $rnt=(int)$_POST['renewals_target'];
    $notes=trim($_POST['notes']??'');
    $pdo->prepare("INSERT INTO targets (year,month,revenue_target,new_clients_target,certifications_target,renewals_target,notes) VALUES (?,?,?,?,?,?,?) ON DUPLICATE KEY UPDATE revenue_target=VALUES(revenue_target),new_clients_target=VALUES(new_clients_target),certifications_target=VALUES(certifications_target),renewals_target=VALUES(renewals_target),notes=VALUES(notes),updated_at=NOW()")
        ->execute([$year,$month,$rt,$nc,$ct,$rnt,$notes]);
    flash_set('success','Target disimpan.');
    redirect(SITE_URL.'/admin/targets.php?year='.$year);
}
$year=(int)($_GET['year']??date('Y'));
$months_id=['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
$targets_data=[];
$stmt=$pdo->prepare("SELECT * FROM targets WHERE year=?"); $stmt->execute([$year]);
foreach($stmt->fetchAll() as $t) $targets_data[$t['month']]=$t;
// Get actual data per month
$actual=[];
for($m=1;$m<=12;$m++){
    $stR=$pdo->prepare("SELECT COALESCE(SUM(amount),0) FROM payments WHERE YEAR(payment_date)=? AND MONTH(payment_date)=?"); $stR->execute([$year,$m]); $actual[$m]['revenue']=(float)$stR->fetchColumn();
    $stC=$pdo->prepare("SELECT COUNT(*) FROM certifications WHERE YEAR(completion_date)=? AND MONTH(completion_date)=?"); $stC->execute([$year,$m]); $actual[$m]['certifications']=(int)$stC->fetchColumn();
    $stN=$pdo->prepare("SELECT COUNT(*) FROM clients WHERE YEAR(created_at)=? AND MONTH(created_at)=?"); $stN->execute([$year,$m]); $actual[$m]['new_clients']=(int)$stN->fetchColumn();
}
$flash=flash_get();
?><!DOCTYPE html><html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Target — Admin</title><meta name="robots" content="noindex,nofollow"><link rel="stylesheet" href="/admin/assets/admin.css"></head>
<body><div class="admin-layout"><div class="mobile-overlay" id="mobileOverlay"></div>
<?php require __DIR__.'/partials/sidebar.php';?>
<main class="admin-main">
<div class="admin-topbar"><button class="topbar-hamburger" id="hamburger"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg></button>
<div class="topbar-title">Target & Realisasi <?=$year?></div>
<div class="topbar-actions">
<form method="get" style="display:flex;gap:8px">
<select name="year" class="form-select" style="width:auto;padding:7px 10px"><?php for($y=date('Y');$y>=date('Y')-3;$y--):?><option value="<?=$y?>" <?=$y===$year?'selected':''?>><?=$y?></option><?php endfor;?></select>
<button type="submit" class="btn btn-outline btn-sm">Tampilkan</button>
</form></div></div>
<div class="admin-content">
<?php if($flash):?><div id="flash-message" class="alert alert-<?=$flash['type']==='success'?'success':'error'?>"><?=e($flash['message'])?></div><?php endif;?>
<div class="card">
<div class="card-header"><div class="card-title">Target & Realisasi Per Bulan <?=$year?></div></div>
<div class="table-wrap"><table class="admin-table">
<thead><tr><th>Bulan</th><th>Target Revenue</th><th>Aktual Revenue</th><th>Progress</th><th>Target Sertif.</th><th>Aktual Sertif.</th><th>Target Klien Baru</th><th>Aktual Klien</th><th>Aksi</th></tr></thead>
<tbody>
<?php for($m=1;$m<=12;$m++):
$t=$targets_data[$m]??null;
$a=$actual[$m];
$rev_pct=$t&&$t['revenue_target']>0?min(100,round(($a['revenue']/$t['revenue_target'])*100)):0;
$is_future=$year>(int)date('Y')||($year==(int)date('Y')&&$m>(int)date('n'));
?>
<tr style="<?=$is_future?'opacity:.5':''?>">
<td><strong><?=$months_id[$m]?></strong></td>
<td>Rp <?=number_format($t?$t['revenue_target']:0,0,',','.')?></td>
<td>Rp <?=number_format($a['revenue'],0,',','.')?></td>
<td style="min-width:120px"><?php if($t&&$t['revenue_target']>0):?>
<div class="progress" style="margin-bottom:3px"><div class="progress-bar <?=$rev_pct<50?'red':($rev_pct<80?'orange':'') ?>" style="width:<?=$rev_pct?>%"></div></div>
<div style="font-size:11px;color:#6b7280"><?=$rev_pct?>%</div>
<?else:?><span style="font-size:12px;color:#9ca3af">— belum diset</span><?php endif;?></td>
<td><?=$t?$t['certifications_target']:0?></td>
<td><?=$a['certifications']?></td>
<td><?=$t?$t['new_clients_target']:0?></td>
<td><?=$a['new_clients']?></td>
<td><button class="btn btn-xs btn-outline" onclick="openTargetModal(<?=$m?>,<?=$t?$t['revenue_target']:0?>,<?=$t?$t['certifications_target']:0?>,<?=$t?$t['new_clients_target']:0?>,<?=$t?$t['renewals_target']:0?>,'<?=e($t?$t['notes']:'')?>','<?=$months_id[$m]?>')">Set Target</button></td>
</tr>
<?php endfor;?>
</tbody></table></div></div></div></main></div>
<div class="modal-overlay" id="mTarget"><div class="modal"><div class="modal-header"><div class="modal-title" id="targetModalTitle">Set Target</div><button class="modal-close" onclick="closeModal('mTarget')">✕</button></div>
<form method="post"><?=csrf_field()?>
<input type="hidden" name="year" value="<?=$year?>">
<input type="hidden" name="month" id="targetMonth">
<div class="modal-body"><div class="form-grid">
<div class="form-group form-full"><label class="form-label">Target Revenue (Rp)</label><input type="number" name="revenue_target" id="tRevenue" class="form-input" min="0" step="100000"></div>
<div class="form-group"><label class="form-label">Target Sertifikasi Baru</label><input type="number" name="certifications_target" id="tCerts" class="form-input" min="0"></div>
<div class="form-group"><label class="form-label">Target Klien Baru</label><input type="number" name="new_clients_target" id="tClients" class="form-input" min="0"></div>
<div class="form-group form-full"><label class="form-label">Target Perpanjangan</label><input type="number" name="renewals_target" id="tRenewals" class="form-input" min="0"></div>
<div class="form-group form-full"><label class="form-label">Catatan</label><textarea name="notes" id="tNotes" class="form-textarea"></textarea></div>
</div></div>
<div class="modal-footer"><button type="button" class="btn btn-outline" onclick="closeModal('mTarget')">Batal</button><button type="submit" class="btn btn-primary">💾 Simpan Target</button></div>
</form></div></div>
<script src="/admin/assets/admin.js"></script>
<script>
function openTargetModal(m,rev,certs,clients,renewals,notes,monthName){
    document.getElementById('targetMonth').value=m;
    document.getElementById('targetModalTitle').textContent='Set Target: '+monthName+' <?=$year?>';
    document.getElementById('tRevenue').value=rev;
    document.getElementById('tCerts').value=certs;
    document.getElementById('tClients').value=clients;
    document.getElementById('tRenewals').value=renewals;
    document.getElementById('tNotes').value=notes;
    openModal('mTarget');
}
</script>
</body></html>
