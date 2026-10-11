<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/partials/auth.php';
require_auth('invoices');
$pdo = get_pdo();

// Generate invoice number
function gen_invoice_number(PDO $pdo): string {
    $prefix = 'INV/WT/' . date('Y/m/');
    $last = $pdo->query("SELECT invoice_number FROM invoices WHERE invoice_number LIKE '{$prefix}%' ORDER BY id DESC LIMIT 1")->fetchColumn();
    $seq = $last ? (int)substr($last,-4)+1 : 1;
    return $prefix . str_pad($seq,4,'0',STR_PAD_LEFT);
}

if ($_SERVER['REQUEST_METHOD']==='POST' && csrf_verify($_POST['csrf_token']??'')) {
    $a = $_POST['action']??'';
    if ($a==='save') {
        $id        = (int)($_POST['id']??0);
        $company_id= ($_POST['company_id']??'')?((int)$_POST['company_id']):null;
        $client_id = ($_POST['client_id']??'')?((int)$_POST['client_id']):null;
        $issue     = $_POST['issue_date']??date('Y-m-d');
        $due       = $_POST['due_date']??date('Y-m-d',strtotime('+30 days'));
        $disc      = (float)($_POST['discount']??0);
        $tax       = (float)($_POST['tax']??0);
        $notes     = trim($_POST['notes']??'');
        $items     = $_POST['items']??[];

        $subtotal = 0;
        foreach ($items as &$it) {
            $it['quantity']   = max(1,(int)($it['quantity']??1));
            $it['unit_price'] = (float)($it['unit_price']??0);
            $it['total']      = $it['quantity'] * $it['unit_price'];
            $subtotal        += $it['total'];
        }
        $total = $subtotal - $disc + $tax;

        if ($id) {
            $pdo->prepare("UPDATE invoices SET company_id=?,client_id=?,issue_date=?,due_date=?,subtotal=?,discount=?,tax=?,total_amount=?,notes=?,updated_at=NOW() WHERE id=?")
                ->execute([$company_id,$client_id,$issue,$due,$subtotal,$disc,$tax,$total,$notes,$id]);
            $pdo->prepare("DELETE FROM invoice_items WHERE invoice_id=?")->execute([$id]);
        } else {
            $inv_num = gen_invoice_number($pdo);
            $pdo->prepare("INSERT INTO invoices (invoice_number,company_id,client_id,issue_date,due_date,subtotal,discount,tax,total_amount,notes,status,created_by) VALUES (?,?,?,?,?,?,?,?,?,'draft',?)")
                ->execute([$inv_num,$company_id,$client_id,$issue,$due,$subtotal,$disc,$tax,$total,$notes,current_user_id()]);
            $id = (int)$pdo->lastInsertId();
        }
        foreach ($items as $it) {
            if (trim($it['description']??'')) {
                $pdo->prepare("INSERT INTO invoice_items (invoice_id,description,quantity,unit_price,total) VALUES (?,?,?,?,?)")
                    ->execute([$id,$it['description'],$it['quantity'],$it['unit_price'],$it['total']]);
            }
        }
        flash_set('success','Invoice disimpan.');
    } elseif ($a==='status') {
        $pdo->prepare("UPDATE invoices SET status=?,updated_at=NOW() WHERE id=?")->execute([$_POST['status'],(int)$_POST['id']]);
        flash_set('success','Status invoice diperbarui.');
    } elseif ($a==='delete') {
        $pdo->prepare("DELETE FROM invoices WHERE id=?")->execute([(int)$_POST['id']]);
        flash_set('success','Invoice dihapus.');
    }
    redirect(SITE_URL.'/admin/invoices.php');
}

$filter = $_GET['filter']??'all';
$search = trim($_GET['q']??'');
$page   = max(1,(int)($_GET['page']??1)); $per=20; $offset=($page-1)*$per;
$where  = "WHERE 1=1";
$params = [];
if ($filter!=='all') { $where .= " AND i.status=?"; $params[]=$filter; }
if ($search) { $where .= " AND (i.invoice_number LIKE ? OR COALESCE(co.name,cl.name) LIKE ?)"; $s="%$search%"; $params=array_merge($params,[$s,$s]); }
$stC=$pdo->prepare("SELECT COUNT(*) FROM invoices i LEFT JOIN companies co ON co.id=i.company_id LEFT JOIN clients cl ON cl.id=i.client_id $where");
$stC->execute($params); $total=(int)$stC->fetchColumn();
$stmt=$pdo->prepare("SELECT i.*, COALESCE(co.name,cl.name,'Individual') AS recipient FROM invoices i LEFT JOIN companies co ON co.id=i.company_id LEFT JOIN clients cl ON cl.id=i.client_id $where ORDER BY i.created_at DESC LIMIT $per OFFSET $offset");
$stmt->execute($params); $invoices=$stmt->fetchAll();
$total_pages=ceil($total/$per);
$companies=$pdo->query("SELECT id,name FROM companies WHERE is_active=1 ORDER BY name")->fetchAll();
$clients_list=$pdo->query("SELECT id,name FROM clients WHERE is_active=1 ORDER BY name")->fetchAll();
$courses=$pdo->query("SELECT id,name,price FROM trainings WHERE is_active=1 ORDER BY name")->fetchAll();
$edit=null; $edit_items=[];
if(!empty($_GET['edit'])){
    $st=$pdo->prepare("SELECT * FROM invoices WHERE id=?"); $st->execute([(int)$_GET['edit']]); $edit=$st->fetch();
    if($edit){$si=$pdo->prepare("SELECT * FROM invoice_items WHERE invoice_id=?"); $si->execute([$edit['id']]); $edit_items=$si->fetchAll();}
}
$counts=['all'=>$pdo->query("SELECT COUNT(*) FROM invoices")->fetchColumn(),'sent'=>$pdo->query("SELECT COUNT(*) FROM invoices WHERE status='sent'")->fetchColumn(),'partial'=>$pdo->query("SELECT COUNT(*) FROM invoices WHERE status='partial'")->fetchColumn(),'unpaid'=>$pdo->query("SELECT COUNT(*) FROM invoices WHERE status IN ('sent','partial','overdue')")->fetchColumn(),'paid'=>$pdo->query("SELECT COUNT(*) FROM invoices WHERE status='paid'")->fetchColumn()];
$flash=flash_get();
?><!DOCTYPE html><html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Invoice — Admin</title><meta name="robots" content="noindex,nofollow"><link rel="stylesheet" href="/admin/assets/admin.css"></head>
<body><div class="admin-layout"><div class="mobile-overlay" id="mobileOverlay"></div>
<?php require __DIR__.'/partials/sidebar.php';?>
<main class="admin-main">
<div class="admin-topbar"><button class="topbar-hamburger" id="hamburger"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg></button><div class="topbar-title">Manajemen Invoice</div><div class="topbar-actions"><a href="/admin/accounts.php" class="topbar-btn">Dashboard</a><button class="topbar-btn topbar-btn-primary" onclick="openModal('mInv')">+ Invoice Baru</button></div></div>
<div class="admin-content">
<?php if($flash):?><div id="flash-message" class="alert alert-<?=$flash['type']==='success'?'success':'error'?>"><?=e($flash['message'])?></div><?php endif;?>
<div class="card">
<div class="filter-bar">
<div class="filter-chips">
<?php foreach(['all'=>"Semua ({$counts['all']})",'unpaid'=>"Belum Lunas ({$counts['unpaid']})",'partial'=>"Sebagian ({$counts['partial']})",'paid'=>"Lunas ({$counts['paid']})"] as $k=>$v):?>
<a href="?filter=<?=$k?>&q=<?=urlencode($search)?>" class="filter-chip <?=$filter===$k?'active':''?>"><?=$v?></a>
<?php endforeach;?>
</div>
<div class="filter-search"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg><form method="get" style="flex:1"><input type="hidden" name="filter" value="<?=e($filter)?>"><input type="text" name="q" placeholder="Cari no. invoice atau nama..." value="<?=e($search)?>" style="border:none;outline:none;width:100%;font-size:13px;background:none;padding:8px 0"></form></div>
</div>
<div class="table-wrap"><table class="admin-table"><thead><tr><th>No Invoice</th><th>Kepada</th><th>Tgl Invoice</th><th>Jatuh Tempo</th><th>Total</th><th>Terbayar</th><th>Status</th><th>Aksi</th></tr></thead><tbody>
<?php if(empty($invoices)):?><tr><td colspan="8"><div class="empty-state"><div class="empty-state-icon">📋</div><h3>Belum ada invoice</h3></div></td></tr>
<?php else: foreach($invoices as $inv):?>
<tr>
<td><strong style="font-family:monospace;font-size:12px"><?=e($inv['invoice_number'])?></strong></td>
<td><?=e($inv['recipient'])?></td>
<td><?=date('d M Y',strtotime($inv['issue_date']))?></td>
<td><?=date('d M Y',strtotime($inv['due_date']))?></td>
<td>Rp <?=number_format($inv['total_amount'],0,',','.')?></td>
<td>Rp <?=number_format($inv['paid_amount'],0,',','.')?></td>
<td>
<form method="post" style="display:inline"><?=csrf_field()?><input type="hidden" name="action" value="status"><input type="hidden" name="id" value="<?=$inv['id']?>">
<select name="status" class="form-select" style="padding:3px 8px;font-size:12px;width:auto" onchange="this.form.submit()">
<?php foreach(['draft'=>'Draft','sent'=>'Terkirim','partial'=>'Sebagian','paid'=>'Lunas','overdue'=>'Terlambat','cancelled'=>'Batal'] as $k=>$v):?>
<option value="<?=$k?>" <?=$inv['status']===$k?'selected':''?>><?=$v?></option>
<?php endforeach;?></select></form>
</td>
<td><div style="display:flex;gap:6px">
<a href="?edit=<?=$inv['id']?>" class="btn btn-xs btn-outline">Edit</a>
<a href="/admin/payments.php?invoice_id=<?=$inv['id']?>" class="btn btn-xs btn-primary">+ Bayar</a>
<form method="post" style="display:inline" onsubmit="return confirm('Hapus invoice ini?')">
<?=csrf_field()?><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?=$inv['id']?>"><button type="submit" class="btn btn-xs btn-danger">Hapus</button></form>
</div></td></tr>
<?php endforeach; endif;?>
</tbody></table></div>
<?php if($total_pages>1):?><div class="pagination"><div class="page-info"><?=($offset+1)?>–<?=min($offset+$per,$total)?> dari <?=$total?></div><?php for($p=1;$p<=$total_pages;$p++):?><a href="?filter=<?=e($filter)?>&q=<?=urlencode($search)?>&page=<?=$p?>" class="page-btn <?=$p===$page?'active':''?>"><?=$p?></a><?php endfor;?></div><?php endif;?>
</div></div></main></div>
<!-- Invoice Modal -->
<div class="modal-overlay <?=$edit?'open':''?>" id="mInv"><div class="modal" style="max-width:700px">
<div class="modal-header"><div class="modal-title"><?=$edit?'Edit Invoice':'Invoice Baru'?></div><button class="modal-close" onclick="closeModal('mInv')">✕</button></div>
<form method="post"><?=csrf_field()?><input type="hidden" name="action" value="save"><input type="hidden" name="id" value="<?=$edit['id']??0?>">
<div class="modal-body">
<div class="form-grid">
<div class="form-group"><label class="form-label">Perusahaan</label><select name="company_id" class="form-select"><option value="">— Pilih Perusahaan —</option><?php foreach($companies as $co):?><option value="<?=$co['id']?>" <?=($edit['company_id']??'')==$co['id']?'selected':''?>><?=e($co['name'])?></option><?php endforeach;?></select></div>
<div class="form-group"><label class="form-label">Peserta Individual</label><select name="client_id" class="form-select"><option value="">— Pilih Peserta —</option><?php foreach($clients_list as $cl):?><option value="<?=$cl['id']?>" <?=($edit['client_id']??'')==$cl['id']?'selected':''?>><?=e($cl['name'])?></option><?php endforeach;?></select></div>
<div class="form-group"><label class="form-label">Tgl Invoice</label><input type="date" name="issue_date" class="form-input" value="<?=$edit['issue_date']??date('Y-m-d')?>"></div>
<div class="form-group"><label class="form-label">Jatuh Tempo</label><input type="date" name="due_date" class="form-input" value="<?=$edit['due_date']??date('Y-m-d',strtotime('+30 days'))?>"></div>
</div>
<!-- Items table -->
<div style="margin:16px 0 8px;font-size:13px;font-weight:700">Item / Program Pelatihan</div>
<table style="width:100%;border-collapse:collapse;font-size:12px">
<thead><tr style="background:#f0f4f8"><th style="padding:6px 8px;text-align:left">Deskripsi</th><th style="padding:6px 8px;width:60px">Qty</th><th style="padding:6px 8px;width:120px">Harga</th><th style="padding:6px 8px;width:120px">Total</th><th style="width:30px"></th></tr></thead>
<tbody id="invoice-items-body">
<?php
$show_items = !empty($edit_items) ? $edit_items : [['description'=>'','quantity'=>1,'unit_price'=>0,'total'=>0]];
foreach($show_items as $i=>$it):?>
<tr class="invoice-item-row">
<td><input class="form-input form-input-sm" name="items[<?=$i?>][description]" value="<?=e($it['description']??'')?>" required></td>
<td><input class="form-input form-input-sm item-qty" name="items[<?=$i?>][quantity]" type="number" value="<?=$it['quantity']??1?>" min="1"></td>
<td><input class="form-input form-input-sm item-price" name="items[<?=$i?>][unit_price]" type="number" value="<?=$it['unit_price']??0?>"></td>
<td><input class="form-input form-input-sm item-total" name="items[<?=$i?>][total]" type="number" value="<?=$it['total']??0?>" readonly></td>
<td><button type="button" class="btn btn-xs btn-danger" onclick="this.closest('tr').remove();recalcInvoice()">✕</button></td>
</tr>
<?php endforeach;?>
</tbody>
</table>
<button type="button" class="btn btn-sm btn-outline" onclick="addInvoiceRow()" style="margin-top:8px">+ Tambah Baris</button>
<div style="display:flex;justify-content:flex-end;margin-top:12px;gap:16px">
<div style="text-align:right">
<div style="font-size:12px;color:#6b7280">Subtotal: <strong id="invoice-subtotal">Rp 0</strong></div>
<div style="font-size:12px;color:#6b7280;margin-top:4px">Diskon: <input type="number" name="discount" id="invoice-discount" value="<?=$edit['discount']??0?>" style="width:100px;padding:3px 6px;border:1px solid #e5e9ef;border-radius:4px;font-size:12px"></div>
<div style="font-size:12px;color:#6b7280;margin-top:4px">Pajak: <input type="number" name="tax" id="invoice-tax" value="<?=$edit['tax']??0?>" style="width:100px;padding:3px 6px;border:1px solid #e5e9ef;border-radius:4px;font-size:12px"></div>
<div style="font-size:15px;font-weight:800;margin-top:8px;color:#0A4A2E">TOTAL: <span id="invoice-total">Rp 0</span></div>
<input type="hidden" name="total_amount" id="invoice-total-hidden">
</div></div>
<div class="form-group" style="margin-top:8px"><label class="form-label">Catatan</label><textarea name="notes" class="form-textarea" rows="2"><?=e($edit['notes']??'')?></textarea></div>
</div>
<div class="modal-footer"><button type="button" class="btn btn-outline" onclick="closeModal('mInv')">Batal</button><button type="submit" class="btn btn-primary">💾 Simpan Invoice</button></div>
</form></div></div>
<script src="/admin/assets/admin.js"></script>
<script>
// Global recalcInvoice — must be global for inline onclick handlers
function recalcInvoice(){
  var subtotal=0;
  document.querySelectorAll('tr.invoice-item-row').forEach(function(row){
    var qty=parseFloat(row.querySelector('.item-qty')?.value||0);
    var price=parseFloat(row.querySelector('.item-price')?.value||0);
    var total=qty*price;
    var tf=row.querySelector('.item-total');
    if(tf)tf.value=total.toFixed(0);
    subtotal+=total;
  });
  var disc=parseFloat(document.getElementById('invoice-discount')?.value||0);
  var tax=parseFloat(document.getElementById('invoice-tax')?.value||0);
  var total=subtotal-disc+tax;
  var stEl=document.getElementById('invoice-subtotal');
  var ttEl=document.getElementById('invoice-total');
  if(stEl)stEl.textContent='Rp '+subtotal.toLocaleString('id-ID');
  if(ttEl)ttEl.textContent='Rp '+total.toLocaleString('id-ID');
  var hidTotal=document.getElementById('invoice-total-hidden');
  if(hidTotal)hidTotal.value=total.toFixed(0);
}
document.addEventListener('DOMContentLoaded',function(){recalcInvoice();});<?php if($edit):?>openModal('mInv');<?php endif;?></script>
</body></html>
