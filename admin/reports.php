<?php
require_once __DIR__.'/../config.php';
require_once __DIR__.'/partials/auth.php';
require_auth('reports');
$pdo=get_pdo();
$year=(int)($_GET['year']??date('Y'));

// Revenue per month
$stmt=$pdo->prepare("SELECT MONTH(payment_date) AS m,SUM(amount) AS total FROM payments WHERE YEAR(payment_date)=? GROUP BY m ORDER BY m"); $stmt->execute([$year]); $rev_data=$stmt->fetchAll(PDO::FETCH_KEY_PAIR);
// Top courses by certifications
$top_courses=$pdo->prepare("SELECT t.name,COUNT(c.id) AS cnt,COALESCE(SUM(i2.total_amount),0) AS revenue FROM certifications c JOIN trainings t ON t.id=c.course_id LEFT JOIN invoice_items ii ON ii.certification_id=c.id LEFT JOIN invoices i2 ON i2.id=ii.invoice_id WHERE YEAR(c.completion_date)=? GROUP BY t.id ORDER BY cnt DESC LIMIT 10"); $top_courses->execute([$year]); $top_courses=$top_courses->fetchAll();
// Top companies
$top_companies=$pdo->prepare("SELECT co.name,COUNT(DISTINCT cl.id) AS clients,COUNT(c.id) AS certs FROM companies co JOIN clients cl ON cl.company_id=co.id LEFT JOIN certifications c ON c.client_id=cl.id AND YEAR(c.completion_date)=? GROUP BY co.id ORDER BY certs DESC LIMIT 10"); $top_companies->execute([$year]); $top_companies=$top_companies->fetchAll();
// Summary totals
$tot_rev=(float)$pdo->prepare("SELECT COALESCE(SUM(amount),0) FROM payments WHERE YEAR(payment_date)=?")->execute([$year]) ? 0 : 0;
$st=$pdo->prepare("SELECT COALESCE(SUM(amount),0) FROM payments WHERE YEAR(payment_date)=?"); $st->execute([$year]); $tot_rev=(float)$st->fetchColumn();
$st2=$pdo->prepare("SELECT COUNT(*) FROM certifications WHERE YEAR(completion_date)=?"); $st2->execute([$year]); $tot_certs=(int)$st2->fetchColumn();
$st3=$pdo->prepare("SELECT COUNT(*) FROM clients WHERE YEAR(created_at)=?"); $st3->execute([$year]); $new_clients=(int)$st3->fetchColumn();
$st4=$pdo->prepare("SELECT COUNT(*) FROM leads WHERE YEAR(created_at)=? AND status='converted'"); $st4->execute([$year]); $conv_leads=(int)$st4->fetchColumn();
$st5=$pdo->prepare("SELECT COUNT(*) FROM leads WHERE YEAR(created_at)=?"); $st5->execute([$year]); $tot_leads=(int)$st5->fetchColumn();
$months_id=['','Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
?><!DOCTYPE html><html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Laporan — Admin</title><meta name="robots" content="noindex,nofollow"><link rel="stylesheet" href="/admin/assets/admin.css"><script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script></head>
<body><div class="admin-layout"><div class="mobile-overlay" id="mobileOverlay"></div>
<?php require __DIR__.'/partials/sidebar.php';?>
<main class="admin-main">
<div class="admin-topbar"><button class="topbar-hamburger" id="hamburger"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg></button>
<div class="topbar-title">Laporan & Analitik</div>
<div class="topbar-actions"><form method="get" style="display:flex;gap:8px"><select name="year" class="form-select" style="width:auto;padding:7px 10px"><?php for($y=date('Y');$y>=date('Y')-3;$y--):?><option value="<?=$y?>" <?=$y===$year?'selected':''?>><?=$y?></option><?php endfor;?></select><button type="submit" class="btn btn-outline btn-sm">Tampilkan</button></form></div>
</div>
<div class="admin-content">
<!-- Summary stats -->
<div class="stats-grid">
<div class="stat-card green"><div class="stat-card-icon">💰</div><div class="stat-card-num" style="font-size:18px">Rp <?=number_format($tot_rev,0,',','.')?></div><div class="stat-card-label">Total Pendapatan <?=$year?></div></div>
<div class="stat-card blue"><div class="stat-card-icon">🎓</div><div class="stat-card-num"><?=$tot_certs?></div><div class="stat-card-label">Sertifikasi Diterbitkan</div></div>
<div class="stat-card purple"><div class="stat-card-icon">👥</div><div class="stat-card-num"><?=$new_clients?></div><div class="stat-card-label">Klien Baru</div></div>
<div class="stat-card orange"><div class="stat-card-icon">📨</div><div class="stat-card-num"><?=$tot_leads>0?round(($conv_leads/$tot_leads)*100).'%':'—'?></div><div class="stat-card-label">Konversi Lead (<?=$conv_leads?>/<?=$tot_leads?>)</div></div>
</div>
<div style="display:grid;grid-template-columns:2fr 1fr;gap:20px">
<!-- Revenue chart -->
<div class="card"><div class="card-header"><div class="card-title">📈 Pendapatan Per Bulan <?=$year?></div></div>
<div class="card-body"><div class="chart-container"><canvas id="revChart"></canvas></div></div></div>
<!-- Top courses -->
<div class="card"><div class="card-header"><div class="card-title">🏆 Program Terlaris</div></div>
<div class="card-body" style="padding:12px 16px">
<?php foreach($top_courses as $i=>$tc):?>
<div style="display:flex;align-items:center;gap:10px;margin-bottom:10px">
<div style="width:22px;height:22px;border-radius:50%;background:var(--green);color:#fff;font-size:10px;font-weight:800;display:flex;align-items:center;justify-content:center;flex-shrink:0"><?=$i+1?></div>
<div style="flex:1;min-width:0"><div style="font-size:12px;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis"><?=e($tc['name'])?></div>
<div style="font-size:11px;color:#6b7280"><?=$tc['cnt']?> sertifikasi</div></div>
</div>
<?php endforeach; if(empty($top_courses)):?><div class="empty-state" style="padding:20px"><p>Belum ada data</p></div><?php endif;?>
</div></div>
<!-- Top companies -->
<div class="card" style="grid-column:1/-1"><div class="card-header"><div class="card-title">🏢 Perusahaan Terbanyak Peserta</div></div>
<div class="table-wrap"><table class="admin-table"><thead><tr><th>#</th><th>Perusahaan</th><th>Total Peserta</th><th>Sertifikasi <?=$year?></th></tr></thead><tbody>
<?php foreach($top_companies as $i=>$tc):?>
<tr><td><?=$i+1?></td><td><strong><?=e($tc['name'])?></strong></td><td><?=$tc['clients']?></td><td><?=$tc['certs']?></td></tr>
<?php endforeach; if(empty($top_companies)):?><tr><td colspan="4"><div class="empty-state"><p>Belum ada data</p></div></td></tr><?php endif;?>
</tbody></table></div></div>
</div>
</div></main></div>
<script src="/admin/assets/admin.js"></script>
<script>
var months=['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
var revData=new Array(12).fill(0);
<?php foreach($rev_data as $m=>$total):?>revData[<?=(int)$m-1?>]=<?=(float)$total?>;<?php endforeach;?>
new Chart(document.getElementById('revChart'),{type:'bar',data:{labels:months,datasets:[{label:'Pendapatan',data:revData,backgroundColor:'#0A4A2E',borderRadius:5}]},options:{responsive:true,maintainAspectRatio:false,plugins:{legend:{display:false}},scales:{y:{ticks:{callback:function(v){return'Rp '+v.toLocaleString('id-ID');},font:{size:10}},grid:{color:'#f0f4f8'}},x:{ticks:{font:{size:10}},grid:{display:false}}}}});
</script>
</body></html>
