<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/partials/auth.php';
require_auth('accounts');

$pdo = get_pdo();
$year  = (int)($_GET['year']  ?? date('Y'));
$month = (int)($_GET['month'] ?? date('n'));

// ── Summary ───────────────────────────────────────────────────────────────
$revenue_month  = (float)$pdo->prepare("SELECT COALESCE(SUM(amount),0) FROM payments WHERE YEAR(payment_date)=? AND MONTH(payment_date)=?")->execute([$year,$month]) ? $pdo->prepare("SELECT COALESCE(SUM(amount),0) FROM payments WHERE YEAR(payment_date)=? AND MONTH(payment_date)=?")->execute([$year,$month]) : 0;

// Fix: use proper queries
$stmt = $pdo->prepare("SELECT COALESCE(SUM(amount),0) FROM payments WHERE YEAR(payment_date)=? AND MONTH(payment_date)=?");
$stmt->execute([$year,$month]); $revenue_month = (float)$stmt->fetchColumn();

$stmt = $pdo->prepare("SELECT COALESCE(SUM(amount),0) FROM payments WHERE YEAR(payment_date)=?");
$stmt->execute([$year]); $revenue_year = (float)$stmt->fetchColumn();

$stmt = $pdo->prepare("SELECT COALESCE(SUM(amount),0) FROM expenses WHERE YEAR(expense_date)=? AND MONTH(expense_date)=?");
$stmt->execute([$year,$month]); $expenses_month = (float)$stmt->fetchColumn();

$stmt = $pdo->query("SELECT COUNT(*) FROM invoices WHERE status IN ('sent','partial','overdue')");
$unpaid_count = (int)$stmt->fetchColumn();

$stmt = $pdo->query("SELECT COALESCE(SUM(total_amount-paid_amount),0) FROM invoices WHERE status IN ('sent','partial','overdue')");
$unpaid_amount = (float)$stmt->fetchColumn();

// Target this month
$stmt = $pdo->prepare("SELECT * FROM targets WHERE year=? AND month=?");
$stmt->execute([$year,$month]); $target = $stmt->fetch();

// Monthly revenue chart (12 months)
$stmt = $pdo->prepare("SELECT MONTH(payment_date) AS m, SUM(amount) AS total FROM payments WHERE YEAR(payment_date)=? GROUP BY MONTH(payment_date) ORDER BY m");
$stmt->execute([$year]); $chart_data = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

// Monthly expenses chart
$stmt = $pdo->prepare("SELECT MONTH(expense_date) AS m, SUM(amount) AS total FROM expenses WHERE YEAR(expense_date)=? GROUP BY MONTH(expense_date) ORDER BY m");
$stmt->execute([$year]); $exp_data = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

// Recent invoices
$recent_invoices = $pdo->query(
    "SELECT i.*, COALESCE(co.name, cl.name, 'Individual') AS recipient
     FROM invoices i
     LEFT JOIN companies co ON co.id = i.company_id
     LEFT JOIN clients cl ON cl.id = i.client_id
     ORDER BY i.created_at DESC LIMIT 10"
)->fetchAll();

// Expense categories this month
$stmt = $pdo->prepare("SELECT category, SUM(amount) AS total FROM expenses WHERE YEAR(expense_date)=? AND MONTH(expense_date)=? GROUP BY category ORDER BY total DESC");
$stmt->execute([$year,$month]); $exp_by_cat = $stmt->fetchAll();

$months_id = ['','Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
$flash = flash_get();
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Keuangan — Wahana Totalita Admin</title>
<meta name="robots" content="noindex,nofollow">
<link rel="stylesheet" href="/admin/assets/admin.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
</head>
<body>
<div class="admin-layout">
  <div class="mobile-overlay" id="mobileOverlay"></div>
  <?php require __DIR__ . '/partials/sidebar.php'; ?>
  <main class="admin-main">
    <div class="admin-topbar">
      <button class="topbar-hamburger" id="hamburger"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg></button>
      <div class="topbar-title">Dashboard Keuangan</div>
      <div class="topbar-actions">
        <!-- Month/Year selector -->
        <form method="get" style="display:flex;gap:8px;align-items:center">
          <select name="month" class="form-select" style="width:auto;padding:7px 10px">
            <?php for ($m=1;$m<=12;$m++): ?>
            <option value="<?= $m ?>" <?= $m===$month?'selected':'' ?>><?= $months_id[$m] ?></option>
            <?php endfor; ?>
          </select>
          <select name="year" class="form-select" style="width:auto;padding:7px 10px">
            <?php for ($y=date('Y');$y>=date('Y')-3;$y--): ?>
            <option value="<?= $y ?>" <?= $y===$year?'selected':'' ?>><?= $y ?></option>
            <?php endfor; ?>
          </select>
          <button type="submit" class="btn btn-outline btn-sm">Tampilkan</button>
        </form>
        <a href="/admin/invoices.php" class="topbar-btn topbar-btn-primary">+ Invoice Baru</a>
      </div>
    </div>

    <div class="admin-content">
      <?php if ($flash): ?>
      <div id="flash-message" class="alert alert-<?= $flash['type']==='success'?'success':'error' ?>"><?= e($flash['message']) ?></div>
      <?php endif; ?>

      <!-- Stats -->
      <div class="stats-grid">
        <div class="stat-card green">
          <div class="stat-card-icon">💵</div>
          <div class="stat-card-num" style="font-size:18px">Rp <?= number_format($revenue_month,0,',','.') ?></div>
          <div class="stat-card-label">Pendapatan <?= $months_id[$month] ?> <?= $year ?></div>
          <?php if ($target && $target['revenue_target'] > 0):
            $prog = min(100, round(($revenue_month/$target['revenue_target'])*100)); ?>
          <div style="margin-top:10px">
            <div class="progress"><div class="progress-bar <?= $prog<50?'red':($prog<80?'orange':'') ?>" style="width:<?= $prog ?>%"></div></div>
            <div style="font-size:11px;color:#6b7280;margin-top:3px"><?= $prog ?>% dari target Rp <?= number_format($target['revenue_target'],0,',','.') ?></div>
          </div>
          <?php endif; ?>
        </div>
        <div class="stat-card blue">
          <div class="stat-card-icon">📊</div>
          <div class="stat-card-num" style="font-size:18px">Rp <?= number_format($revenue_year,0,',','.') ?></div>
          <div class="stat-card-label">Total Pendapatan <?= $year ?></div>
        </div>
        <div class="stat-card orange">
          <div class="stat-card-icon">📤</div>
          <div class="stat-card-num" style="font-size:18px">Rp <?= number_format($expenses_month,0,',','.') ?></div>
          <div class="stat-card-label">Pengeluaran <?= $months_id[$month] ?></div>
          <div class="stat-card-sub">Profit: Rp <?= number_format($revenue_month-$expenses_month,0,',','.') ?></div>
        </div>
        <div class="stat-card red">
          <div class="stat-card-icon">⏳</div>
          <div class="stat-card-num"><?= $unpaid_count ?></div>
          <div class="stat-card-label">Invoice Belum Lunas</div>
          <div class="stat-card-sub">Rp <?= number_format($unpaid_amount,0,',','.') ?></div>
        </div>
      </div>

      <div style="display:grid;grid-template-columns:2fr 1fr;gap:20px">

        <!-- Revenue vs Expenses chart -->
        <div class="card">
          <div class="card-header">
            <div class="card-title">📈 Pendapatan vs Pengeluaran <?= $year ?></div>
          </div>
          <div class="card-body">
            <div class="chart-container">
              <canvas id="finChart"></canvas>
            </div>
          </div>
        </div>

        <!-- Expense breakdown -->
        <div class="card">
          <div class="card-header">
            <div class="card-title">Pengeluaran per Kategori</div>
          </div>
          <div class="card-body" style="padding:12px 16px">
            <?php if (empty($exp_by_cat)): ?>
            <div class="empty-state" style="padding:20px"><p>Belum ada pengeluaran bulan ini</p></div>
            <?php else: ?>
            <?php
            $cat_labels = ['instructor'=>'Instruktur','venue'=>'Venue','materials'=>'Materi','transport'=>'Transport','marketing'=>'Marketing','operational'=>'Operasional','other'=>'Lainnya'];
            $total_exp = array_sum(array_column($exp_by_cat,'total'));
            foreach ($exp_by_cat as $ec):
              $pct = $total_exp > 0 ? round(($ec['total']/$total_exp)*100) : 0;
            ?>
            <div style="margin-bottom:10px">
              <div style="display:flex;justify-content:space-between;font-size:12px;margin-bottom:4px">
                <span><?= $cat_labels[$ec['category']] ?? $ec['category'] ?></span>
                <span style="font-weight:600">Rp <?= number_format($ec['total'],0,',','.') ?> (<?= $pct ?>%)</span>
              </div>
              <div class="progress"><div class="progress-bar orange" style="width:<?= $pct ?>%"></div></div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
          </div>
        </div>

        <!-- Recent invoices -->
        <div class="card" style="grid-column:1/-1">
          <div class="card-header">
            <div class="card-title">Invoice Terbaru</div>
            <div style="display:flex;gap:8px">
              <a href="/admin/invoices.php?filter=unpaid" class="btn btn-sm btn-outline">Belum Bayar (<?= $unpaid_count ?>)</a>
              <a href="/admin/invoices.php" class="btn btn-sm btn-primary">Semua Invoice</a>
            </div>
          </div>
          <div class="table-wrap">
            <table class="admin-table">
              <thead>
                <tr>
                  <th>No Invoice</th>
                  <th>Kepada</th>
                  <th>Tgl Invoice</th>
                  <th>Jatuh Tempo</th>
                  <th>Total</th>
                  <th>Terbayar</th>
                  <th>Sisa</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php if (empty($recent_invoices)): ?>
                <tr><td colspan="9"><div class="empty-state"><div class="empty-state-icon">📋</div><h3>Belum ada invoice</h3><p><a href="/admin/invoices.php" style="color:var(--green)">Buat invoice pertama →</a></p></div></td></tr>
                <?php else: ?>
                <?php foreach ($recent_invoices as $inv): ?>
                <tr>
                  <td><strong style="font-family:monospace"><?= e($inv['invoice_number']) ?></strong></td>
                  <td><?= e($inv['recipient']) ?></td>
                  <td><?= date('d M Y', strtotime($inv['issue_date'])) ?></td>
                  <td><?= date('d M Y', strtotime($inv['due_date'])) ?></td>
                  <td>Rp <?= number_format($inv['total_amount'],0,',','.') ?></td>
                  <td>Rp <?= number_format($inv['paid_amount'],0,',','.') ?></td>
                  <td>Rp <?= number_format($inv['total_amount']-$inv['paid_amount'],0,',','.') ?></td>
                  <td><span class="badge badge-<?= $inv['status'] ?>"><?= ucfirst($inv['status']) ?></span></td>
                  <td>
                    <div style="display:flex;gap:6px">
                      <a href="/admin/invoices.php?edit=<?= $inv['id'] ?>" class="btn btn-xs btn-outline">Edit</a>
                      <?php if ($inv['status'] !== 'paid'): ?>
                      <a href="/admin/payments.php?invoice_id=<?= $inv['id'] ?>" class="btn btn-xs btn-primary">+ Bayar</a>
                      <?php endif; ?>
                    </div>
                  </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
  </main>
</div>

<script src="/admin/assets/admin.js"></script>
<script>
var months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
var revData = new Array(12).fill(0);
var expData = new Array(12).fill(0);
<?php foreach ($chart_data as $m => $total): ?>revData[<?= (int)$m-1 ?>] = <?= (float)$total ?>;<?php endforeach; ?>
<?php foreach ($exp_data  as $m => $total): ?>expData[<?= (int)$m-1 ?>] = <?= (float)$total ?>;<?php endforeach; ?>
new Chart(document.getElementById('finChart'), {
  type: 'bar',
  data: {
    labels: months,
    datasets: [
      { label: 'Pendapatan', data: revData, backgroundColor: '#0A4A2E', borderRadius: 4 },
      { label: 'Pengeluaran', data: expData, backgroundColor: '#C6621C', borderRadius: 4 }
    ]
  },
  options: {
    responsive: true, maintainAspectRatio: false,
    plugins: { legend: { position: 'bottom', labels:{ font:{size:11} } } },
    scales: {
      y: { ticks:{ callback: function(v){ return 'Rp '+v.toLocaleString('id-ID'); }, font:{size:10} }, grid:{color:'#f0f4f8'} },
      x: { ticks:{ font:{size:10} }, grid:{display:false} }
    }
  }
});
</script>
</body>
</html>
