<?php
require_once __DIR__.'/../config.php';
require_once __DIR__.'/partials/auth.php';
require_auth('leads');
$pdo=get_pdo();
if($_SERVER['REQUEST_METHOD']==='POST'&&csrf_verify($_POST['csrf_token']??'')){
    $a=$_POST['action']??'';
    if($a==='save'){
        $id=(int)($_POST['id']??0);
        $f=['name','company','phone','email','source','status','notes','followup_at'];
        $v=array_map(fn($k)=>$_POST[$k]??null,$f);
        $v[0]=trim($v[0]??''); $v[7]=($v[7]??'')?:null;
        $course_id=($_POST['course_id']??'')?((int)$_POST['course_id']):null;
        if($id){
            $conv=$v[4]==='converted'?date('Y-m-d H:i:s'):null;
            $pdo->prepare("UPDATE leads SET name=?,company=?,phone=?,email=?,source=?,status=?,notes=?,followup_at=?,course_id=?,converted_at=COALESCE(converted_at,?),updated_at=NOW() WHERE id=?")
                ->execute([...$v,$course_id,$conv,$id]);
        } else {
            $pdo->prepare("INSERT INTO leads (name,company,phone,email,source,status,notes,followup_at,course_id) VALUES (?,?,?,?,?,?,?,?,?)")
                ->execute([...$v,$course_id]);
        }
        flash_set('success','Lead disimpan.');
    } elseif($a==='delete'){$pdo->prepare("DELETE FROM leads WHERE id=?")->execute([(int)$_POST['id']]);flash_set('success','Lead dihapus.');}
    redirect(SITE_URL.'/admin/leads.php');
}
$filter=$_GET['filter']??'all'; $search=trim($_GET['q']??'');
$where="WHERE 1=1"; $params=[];
if($filter!=='all'){$where.=" AND l.status=?"; $params[]=$filter;}
if($search){$where.=" AND (l.name LIKE ? OR l.company LIKE ? OR l.phone LIKE ?)"; $s="%$search%"; $params=array_merge($params,[$s,$s,$s]);}
$stmt=$pdo->prepare("SELECT l.*,t.name AS course_name FROM leads l LEFT JOIN trainings t ON t.id=l.course_id $where ORDER BY l.created_at DESC LIMIT 50");
$stmt->execute($params); $leads=$stmt->fetchAll();
$courses=$pdo->query("SELECT id,name FROM trainings WHERE is_active=1 ORDER BY name")->fetchAll();
$edit=null; if(!empty($_GET['edit'])){$se=$pdo->prepare("SELECT * FROM leads WHERE id=?"); $se->execute([(int)$_GET['edit']]); $edit=$se->fetch();}
$status_labels=['new'=>'Baru','contacted'=>'Dihubungi','followup'=>'Follow Up','converted'=>'Konversi','lost'=>'Gagal'];
$source_labels=['website'=>'Website','whatsapp'=>'WhatsApp','instagram'=>'Instagram','referral'=>'Referral','direct'=>'Langsung','other'=>'Lainnya'];
$flash=flash_get();
?><!DOCTYPE html><html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Leads — Admin</title><meta name="robots" content="noindex,nofollow"><link rel="stylesheet" href="/admin/assets/admin.css"></head>
<body><div class="admin-layout"><div class="mobile-overlay" id="mobileOverlay"></div>
<?php require __DIR__.'/partials/sidebar.php';?>
<main class="admin-main">
<div class="admin-topbar"><button class="topbar-hamburger" id="hamburger"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg></button><div class="topbar-title">Leads & Prospek</div><div class="topbar-actions"><button class="topbar-btn topbar-btn-primary" onclick="openModal('mLead')">+ Tambah Lead</button></div></div>
<div class="admin-content">
<?php if($flash):?><div id="flash-message" class="alert alert-<?=$flash['type']==='success'?'success':'error'?>"><?=e($flash['message'])?></div><?php endif;?>
<div class="card">
<div class="filter-bar">
<div class="filter-chips">
<?php foreach(['all'=>'Semua','new'=>'Baru','contacted'=>'Dihubungi','followup'=>'Follow Up','converted'=>'Konversi','lost'=>'Gagal'] as $k=>$v):?>
<a href="?filter=<?=$k?>" class="filter-chip <?=$filter===$k?'active':''?>"><?=$v?></a>
<?php endforeach;?>
</div>
<div class="filter-search"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg><form method="get" style="flex:1"><input type="hidden" name="filter" value="<?=e($filter)?>"><input type="text" name="q" placeholder="Cari nama, perusahaan, HP..." value="<?=e($search)?>" style="border:none;outline:none;width:100%;font-size:13px;background:none;padding:8px 0"></form></div>
</div>
<div class="table-wrap"><table class="admin-table"><thead><tr><th>Nama</th><th>Perusahaan</th><th>No HP</th><th>Program Minat</th><th>Sumber</th><th>Follow Up</th><th>Status</th><th>Aksi</th></tr></thead><tbody>
<?php if(empty($leads)):?><tr><td colspan="8"><div class="empty-state"><div class="empty-state-icon">📨</div><h3>Belum ada lead</h3></div></td></tr>
<?php else: foreach($leads as $l):
$badge=['new'=>'badge-new','contacted'=>'badge-draft','followup'=>'badge-expiring','converted'=>'badge-active','lost'=>'badge-expired'];
?>
<tr>
<td><strong><?=e($l['name'])?></strong></td>
<td><?=e($l['company']??'—')?></td>
<td><?=e($l['phone']??'—')?></td>
<td style="font-size:12px"><?=e($l['course_name']??'—')?></td>
<td><span class="badge badge-draft"><?=$source_labels[$l['source']]??$l['source']?></span></td>
<td style="font-size:12px"><?=$l['followup_at']?date('d M Y',strtotime($l['followup_at'])):'—'?></td>
<td><span class="badge <?=$badge[$l['status']]??'badge-draft'?>"><?=$status_labels[$l['status']]??$l['status']?></span></td>
<td><div style="display:flex;gap:6px">
<?php if($l['phone']):?><button class="btn btn-xs btn-wa" onclick="sendWA('<?=e($l['phone'])?>','Halo <?=e($l['name'])?>, terima kasih sudah menghubungi Wahana Totalita Konsultan. Kami siap membantu informasi pelatihan sertifikasi K3 &amp; Lingkungan. Kapan Anda bisa kami hubungi?')">📱</button><?php endif;?>
<a href="?edit=<?=$l['id']?>&filter=<?=e($filter)?>" class="btn btn-xs btn-outline">Edit</a>
<form method="post" style="display:inline" onsubmit="return confirm('Hapus lead?')"><?=csrf_field()?><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?=$l['id']?>"><button type="submit" class="btn btn-xs btn-danger">Hapus</button></form>
</div></td></tr>
<?php endforeach; endif;?>
</tbody></table></div></div></div></main></div>
<div class="modal-overlay <?=$edit?'open':''?>" id="mLead"><div class="modal"><div class="modal-header"><div class="modal-title"><?=$edit?'Edit':'Tambah'?> Lead</div><button class="modal-close" onclick="closeModal('mLead')">✕</button></div>
<form method="post"><?=csrf_field()?><input type="hidden" name="action" value="save"><input type="hidden" name="id" value="<?=$edit['id']??0?>">
<div class="modal-body"><div class="form-grid">
<div class="form-group form-full"><label class="form-label">Nama <span>*</span></label><input type="text" name="name" class="form-input" value="<?=e($edit['name']??'')?>" required></div>
<div class="form-group"><label class="form-label">Perusahaan</label><input type="text" name="company" class="form-input" value="<?=e($edit['company']??'')?>"></div>
<div class="form-group"><label class="form-label">No. WhatsApp</label><input type="tel" name="phone" class="form-input" value="<?=e($edit['phone']??'')?>"></div>
<div class="form-group"><label class="form-label">Email</label><input type="email" name="email" class="form-input" value="<?=e($edit['email']??'')?>"></div>
<div class="form-group form-full"><label class="form-label">Program yang Diminati</label><select name="course_id" class="form-select"><option value="">— Belum tahu —</option><?php foreach($courses as $co):?><option value="<?=$co['id']?>" <?=($edit['course_id']??'')==$co['id']?'selected':''?>><?=e($co['name'])?></option><?php endforeach;?></select></div>
<div class="form-group"><label class="form-label">Sumber</label><select name="source" class="form-select"><?php foreach($source_labels as $k=>$v):?><option value="<?=$k?>" <?=($edit['source']??'whatsapp')===$k?'selected':''?>><?=$v?></option><?php endforeach;?></select></div>
<div class="form-group"><label class="form-label">Status</label><select name="status" class="form-select"><?php foreach($status_labels as $k=>$v):?><option value="<?=$k?>" <?=($edit['status']??'new')===$k?'selected':''?>><?=$v?></option><?php endforeach;?></select></div>
<div class="form-group form-full"><label class="form-label">Tanggal Follow Up</label><input type="date" name="followup_at" class="form-input" value="<?=$edit['followup_at']??''?>"></div>
<div class="form-group form-full"><label class="form-label">Catatan</label><textarea name="notes" class="form-textarea"><?=e($edit['notes']??'')?></textarea></div>
</div></div>
<div class="modal-footer"><button type="button" class="btn btn-outline" onclick="closeModal('mLead')">Batal</button><button type="submit" class="btn btn-primary">💾 Simpan</button></div>
</form></div></div>
<script src="/admin/assets/admin.js"></script><?php if($edit):?><script>openModal('mLead');</script><?php endif;?>
</body></html>
