<?php
require_once __DIR__.'/../config.php';
require_once __DIR__.'/partials/auth.php';
require_auth('payments');
$pdo=get_pdo();
if($_SERVER['REQUEST_METHOD']==='POST'&&csrf_verify($_POST['csrf_token']??'')){
    $a=$_POST['action']??'';
    if($a==='save'){
        $inv_id=(int)$_POST['invoice_id'];
        $amount=(float)$_POST['amount'];
        $method=$_POST['payment_method']??'transfer';
        $bank=trim($_POST['bank_name']??'');
        $ref=trim($_POST['reference_number']??'');
        $date=$_POST['payment_date']??date('Y-m-d');
        $notes=trim($_POST['notes']??'');
        $pdo->prepare("INSERT INTO payments (invoice_id,amount,payment_method,bank_name,reference_number,payment_date,confirmed_by,notes) VALUES (?,?,?,?,?,?,?,?)")
            ->execute([$inv_id,$amount,$method,$bank,$ref,$date,current_user_id(),$notes]);
        // Update invoice paid_amount and status
        $paid=(float)$pdo->prepare("SELECT COALESCE(SUM(amount),0) FROM payments WHERE invoice_id=?")->execute([$inv_id]) ? 0 : 0;
        $st=$pdo->prepare("SELECT COALESCE(SUM(amount),0) FROM payments WHERE invoice_id=?"); $st->execute([$inv_id]); $paid=(float)$st->fetchColumn();
        $st2=$pdo->prepare("SELECT total_amount FROM invoices WHERE id=?"); $st2->execute([$inv_id]); $total=(float)$st2->fetchColumn();
        $status=$paid>=$total?'paid':($paid>0?'partial':'sent');
        $pdo->prepare("UPDATE invoices SET paid_amount=?,status=?,updated_at=NOW() WHERE id=?")->execute([$paid,$status,$inv_id]);
        flash_set('success','Pembayaran dicatat.');
    } elseif($a==='delete'){
        $pdo->prepare("DELETE FROM payments WHERE id=?")->execute([(int)$_POST['id']]);
        flash_set('success','Pembayaran dihapus.');
    }
    redirect(SITE_URL.'/admin/payments.php');
}
$inv_id=(int)($_GET['invoice_id']??0);
$filter=$_GET['filter']??'all';
$where=$inv_id?"WHERE p.invoice_id=$inv_id":"WHERE 1=1";
if($filter==='paid') $where.=" AND i.status='paid'";
elseif($filter==='unpaid') $where.=" AND i.status IN('sent','partial','overdue')";
$payments=$pdo->query("SELECT p.*,i.invoice_number,COALESCE(co.name,cl.name,'Individual') AS recipient FROM payments p JOIN invoices i ON i.id=p.invoice_id LEFT JOIN companies co ON co.id=i.company_id LEFT JOIN clients cl ON cl.id=i.client_id $where ORDER BY p.payment_date DESC LIMIT 50")->fetchAll();
$invoices=$pdo->query("SELECT i.id,i.invoice_number,i.total_amount,i.paid_amount,COALESCE(co.name,cl.name,'Individual') AS recipient FROM invoices i LEFT JOIN companies co ON co.id=i.company_id LEFT JOIN clients cl ON cl.id=i.client_id WHERE i.status!='paid' AND i.status!='cancelled' ORDER BY i.issue_date DESC")->fetchAll();
$flash=flash_get();
?><!DOCTYPE html><html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Pembayaran — Admin</title><meta name="robots" content="noindex,nofollow"><link rel="stylesheet" href="/admin/assets/admin.css"></head>
<body><div class="admin-layout"><div class="mobile-overlay" id="mobileOverlay"></div>
<?php require __DIR__.'/partials/sidebar.php';?>
<main class="admin-main">
<div class="admin-topbar"><button class="topbar-hamburger" id="hamburger"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg></button><div class="topbar-title">Catat Pembayaran</div><div class="topbar-actions"><button class="topbar-btn topbar-btn-primary" onclick="openModal('mPay')">+ Catat Pembayaran</button></div></div>
<div class="admin-content">
<?php if($flash):?><div id="flash-message" class="alert alert-<?=$flash['type']==='success'?'success':'error'?>"><?=e($flash['message'])?></div><?php endif;?>
<div class="card">
<div class="filter-bar"><div class="filter-chips">
<a href="?filter=all" class="filter-chip <?=$filter==='all'?'active':''?>">Semua</a>
<a href="?filter=unpaid" class="filter-chip <?=$filter==='unpaid'?'active':''?>">Belum Lunas</a>
<a href="?filter=paid" class="filter-chip <?=$filter==='paid'?'active':''?>">Lunas</a>
</div></div>
<div class="table-wrap"><table class="admin-table"><thead><tr><th>Tgl Bayar</th><th>No Invoice</th><th>Kepada</th><th>Jumlah</th><th>Metode</th><th>No Referensi</th><th>Aksi</th></tr></thead><tbody>
<?php if(empty($payments)):?><tr><td colspan="7"><div class="empty-state"><div class="empty-state-icon">💳</div><h3>Belum ada pembayaran</h3></div></td></tr>
<?php else: foreach($payments as $p):?>
<tr>
<td><?=date('d M Y',strtotime($p['payment_date']))?></td>
<td style="font-family:monospace;font-size:12px"><?=e($p['invoice_number'])?></td>
<td><?=e($p['recipient'])?></td>
<td><strong>Rp <?=number_format($p['amount'],0,',','.')?></strong></td>
<td><?=ucfirst($p['payment_method'])?><?php if($p['bank_name']):?> — <?=e($p['bank_name'])?><?php endif;?></td>
<td style="font-size:12px"><?=e($p['reference_number']??'—')?></td>
<td><form method="post" style="display:inline" onsubmit="return confirm('Hapus catatan pembayaran ini?')">
<?=csrf_field()?><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?=$p['id']?>">
<button type="submit" class="btn btn-xs btn-danger">Hapus</button></form></td>
</tr>
<?php endforeach; endif;?>
</tbody></table></div></div></div></main></div>
<div class="modal-overlay <?=$inv_id?'open':''?>" id="mPay"><div class="modal"><div class="modal-header"><div class="modal-title">Catat Pembayaran</div><button class="modal-close" onclick="closeModal('mPay')">✕</button></div>
<form method="post"><?=csrf_field()?><input type="hidden" name="action" value="save">
<div class="modal-body"><div class="form-grid">
<div class="form-group form-full"><label class="form-label">Invoice <span>*</span></label>
<select name="invoice_id" class="form-select" required>
<option value="">-- Pilih Invoice --</option>
<?php foreach($invoices as $inv):?>
<option value="<?=$inv['id']?>" <?=$inv_id===$inv['id']?'selected':''?>><?=e($inv['invoice_number'])?> — <?=e($inv['recipient'])?> (Sisa Rp <?=number_format($inv['total_amount']-$inv['paid_amount'],0,',','.')?>)</option>
<?php endforeach;?>
</select></div>
<div class="form-group"><label class="form-label">Jumlah Bayar <span>*</span></label><input type="number" name="amount" class="form-input" min="0" step="1000" required></div>
<div class="form-group"><label class="form-label">Tanggal Bayar</label><input type="date" name="payment_date" class="form-input" value="<?=date('Y-m-d')?>"></div>
<div class="form-group"><label class="form-label">Metode Pembayaran</label>
<select name="payment_method" class="form-select">
<option value="transfer">Transfer Bank</option>
<option value="cash">Tunai</option>
<option value="virtual_account">Virtual Account</option>
<option value="cheque">Cek/Giro</option>
<option value="other">Lainnya</option>
</select></div>
<div class="form-group"><label class="form-label">Nama Bank</label><input type="text" name="bank_name" class="form-input" placeholder="BCA, BRI, Mandiri, dll"></div>
<div class="form-group"><label class="form-label">No. Referensi / Bukti</label><input type="text" name="reference_number" class="form-input" placeholder="No. transaksi, kode booking, dll"></div>
<div class="form-group form-full"><label class="form-label">Catatan</label><textarea name="notes" class="form-textarea"></textarea></div>
</div></div>
<div class="modal-footer"><button type="button" class="btn btn-outline" onclick="closeModal('mPay')">Batal</button><button type="submit" class="btn btn-primary">💾 Simpan</button></div>
</form></div></div>
<script src="/admin/assets/admin.js"></script>
<?php if($inv_id):?><script>openModal('mPay');</script><?php endif;?>
</body></html>
