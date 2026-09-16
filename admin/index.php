<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/partials/auth.php';
require_auth('dashboard');

$pdo   = get_pdo();
$stats = get_dashboard_stats();
$role  = current_role();

// ── Expiry alerts (30 days) ───────────────────────────────────────────────
$expiring = [];
if (can('certifications')) {
    $stmt = $pdo->query(
        "SELECT c.*, cl.name AS client_name, cl.phone AS client_phone,
                t.name AS course_name,
                DATEDIFF(c.expiry_date, NOW()) AS days_left
         FROM certifications c
         JOIN clients cl ON cl.id = c.client_id
         JOIN trainings t ON t.id  = c.course_id
         WHERE c.expiry_date BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 30 DAY)
         ORDER BY c.expiry_date ASC
         LIMIT 10"
    );
    $expiring = $stmt->fetchAll();
}

// ── Recent leads ──────────────────────────────────────────────────────────
$recent_leads = [];
if (can('leads')) {
    $stmt = $pdo->query(
        "SELECT l.*, t.name AS course_name
         FROM leads l
         LEFT JOIN trainings t ON t.id = l.course_id
         WHERE l.status = 'new'
         ORDER BY l.created_at DESC
         LIMIT 5"
    );
    $recent_leads = $stmt->fetchAll();
}

// ── Today's calendar events ───────────────────────────────────────────────
$today_events = $pdo->query(
    "SELECT * FROM calendar_events WHERE event_date = CURDATE() ORDER BY start_time ASC"
)->fetchAll();

// ── Upcoming events (next 7 days) ─────────────────────────────────────────
$upcoming_events = $pdo->query(
    "SELECT * FROM calendar_events
     WHERE event_date BETWEEN DATE_ADD(CURDATE(), INTERVAL 1 DAY) AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)
     ORDER BY event_date ASC, start_time ASC
     LIMIT 5"
)->fetchAll();

// ── This month revenue vs target ─────────────────────────────────────────
$monthly_revenue = [];
if (can('accounts')) {
    $stmt = $pdo->query(
        "SELECT MONTH(payment_date) AS m, SUM(amount) AS total
         FROM payments
         WHERE YEAR(payment_date) = YEAR(NOW())
         GROUP BY MONTH(payment_date)
         ORDER BY m ASC"
    );
    $monthly_revenue = $stmt->fetchAll();
}

$page_title = 'Dashboard';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard — Wahana Totalita Admin</title>
<meta name="robots" content="noindex,nofollow">
<link rel="stylesheet" href="/admin/assets/admin.css">
<?php if (can('accounts')): ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<?php endif; ?>
</head>
<body>
<div class="admin-layout">
  <div class="mobile-overlay" id="mobileOverlay"></div>
  <?php require __DIR__ . '/partials/sidebar.php'; ?>

  <main class="admin-main">
    <!-- Topbar -->
    <div class="admin-topbar">
      <button class="topbar-hamburger" id="hamburger" aria-label="Menu">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
      </button>
      <div class="topbar-title">
        Dashboard
        <span style="font-size:13px;font-weight:400;color:#6b7280;margin-left:8px"><?= date('l, d F Y') ?></span>
      </div>
      <div class="topbar-actions">
        <?php if (can('certifications')): ?>
        <a href="/admin/certifications.php" class="topbar-btn">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11"/></svg>
          Tambah Sertifikasi
        </a>
        <?php endif; ?>
        <a href="/admin/calendar.php" class="topbar-btn topbar-btn-primary">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
          Kalender
        </a>
      </div>
    </div>

    <div class="admin-content">

      <?php $flash = flash_get(); if ($flash): ?>
      <div id="flash-message" class="alert alert-<?= $flash['type'] === 'success' ? 'success' : 'error' ?>">
        <?= $flash['type'] === 'success' ? '✅' : '⚠️' ?> <?= e($flash['message']) ?>
      </div>
      <?php endif; ?>

      <!-- ── EXPIRY ALERT BANNER ── -->
      <?php if (!empty($expiring)): ?>
      <div class="alert alert-warning" style="margin-bottom:20px">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        <div>
          <strong><?= count($expiring) ?> sertifikasi akan kedaluwarsa dalam 30 hari.</strong>
          <a href="/admin/certifications.php?filter=expiring_soon" style="color:#854d0e;font-weight:600;margin-left:8px">Lihat semua →</a>
        </div>
      </div>
      <?php endif; ?>

      <!-- ── TODAY EVENTS BANNER ── -->
      <?php if (!empty($today_events)): ?>
      <div class="alert alert-info" style="margin-bottom:20px">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        <div>
          <strong>Hari ini:</strong>
          <?php foreach ($today_events as $ev): ?>
          <span style="margin-left:8px">📌 <?= e($ev['title']) ?></span>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endif; ?>

      <!-- ── STAT CARDS ── -->
      <div class="stats-grid">

        <!-- Clients -->
        <div class="stat-card green">
          <div class="stat-card-icon">👥</div>
          <div class="stat-card-num"><?= number_format($stats['total_clients'] ?? 0) ?></div>
          <div class="stat-card-label">Total Peserta</div>
        </div>

        <!-- Active certs -->
        <div class="stat-card blue">
          <div class="stat-card-icon">🎓</div>
          <div class="stat-card-num"><?= number_format($stats['active_certs'] ?? 0) ?></div>
          <div class="stat-card-label">Sertifikasi Aktif</div>
        </div>

        <!-- Expiring soon -->
        <div class="stat-card yellow">
          <div class="stat-card-icon">⏰</div>
          <div class="stat-card-num"><?= number_format($stats['expiring_soon'] ?? 0) ?></div>
          <div class="stat-card-label">Akan Kedaluwarsa (30 hari)</div>
          <?php if (($stats['expiring_soon'] ?? 0) > 0): ?>
          <div class="stat-card-sub"><a href="/admin/certifications.php?filter=expiring_soon" style="color:#d97706">Lihat detail →</a></div>
          <?php endif; ?>
        </div>

        <!-- Expired -->
        <div class="stat-card red">
          <div class="stat-card-icon">❌</div>
          <div class="stat-card-num"><?= number_format($stats['expired_certs'] ?? 0) ?></div>
          <div class="stat-card-label">Sudah Expired</div>
        </div>

        <?php if (can('accounts')): ?>
        <!-- Revenue this month -->
        <div class="stat-card orange">
          <div class="stat-card-icon">💰</div>
          <div class="stat-card-num" style="font-size:18px">Rp <?= number_format($stats['total_revenue'] ?? 0, 0, ',', '.') ?></div>
          <div class="stat-card-label">Pendapatan Bulan Ini</div>
          <?php if (($stats['revenue_target'] ?? 0) > 0): ?>
          <div style="margin-top:10px">
            <div class="progress">
              <div class="progress-bar orange" style="width:<?= $stats['revenue_progress'] ?>%"></div>
            </div>
            <div style="font-size:11px;color:#6b7280;margin-top:4px"><?= $stats['revenue_progress'] ?>% dari target</div>
          </div>
          <?php endif; ?>
        </div>

        <!-- Unpaid invoices -->
        <div class="stat-card red">
          <div class="stat-card-icon">📋</div>
          <div class="stat-card-num"><?= number_format($stats['unpaid_invoices'] ?? 0) ?></div>
          <div class="stat-card-label">Invoice Belum Lunas</div>
          <?php if (($stats['unpaid_amount'] ?? 0) > 0): ?>
          <div class="stat-card-sub">Rp <?= number_format($stats['unpaid_amount'], 0, ',', '.') ?></div>
          <?php endif; ?>
        </div>
        <?php endif; ?>

        <?php if (can('leads')): ?>
        <!-- New leads -->
        <div class="stat-card purple">
          <div class="stat-card-icon">📨</div>
          <div class="stat-card-num"><?= number_format($stats['new_leads'] ?? 0) ?></div>
          <div class="stat-card-label">Lead Baru</div>
        </div>
        <?php endif; ?>
      </div>

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px">

        <!-- ── EXPIRING SOON TABLE ── -->
        <?php if (can('certifications') && !empty($expiring)): ?>
        <div class="card" style="grid-column: 1/-1">
          <div class="card-header">
            <div class="card-title">⏰ Sertifikasi Akan Kedaluwarsa (30 Hari)</div>
            <a href="/admin/certifications.php?filter=expiring_soon" class="btn btn-sm btn-outline">Lihat Semua</a>
          </div>
          <div class="table-wrap">
            <table class="admin-table">
              <thead>
                <tr>
                  <th>Peserta</th>
                  <th>Program</th>
                  <th>Tgl Kadaluwarsa</th>
                  <th>Sisa Hari</th>
                  <th>WhatsApp</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($expiring as $c): ?>
                <tr>
                  <td><strong><?= e($c['client_name']) ?></strong></td>
                  <td><?= e($c['course_name']) ?></td>
                  <td><?= date('d M Y', strtotime($c['expiry_date'])) ?></td>
                  <td>
                    <span class="badge <?= $c['days_left'] <= 7 ? 'badge-expired' : 'badge-expiring' ?>">
                      <?= $c['days_left'] ?> hari
                    </span>
                  </td>
                  <td>
                    <?php
                    $wa_msg = "Halo {$c['client_name']}, sertifikasi *{$c['course_name']}* Anda akan kedaluwarsa pada " . date('d M Y', strtotime($c['expiry_date'])) . " ({$c['days_left']} hari lagi).\n\nSegera perpanjang di wahanatotalita.com\n📱 wa.me/6287759151278";
                    ?>
                    <?php if ($c['client_phone']): ?>
                    <button class="btn btn-xs btn-wa"
                            onclick="sendWA('<?= e($c['client_phone']) ?>','<?= e(addslashes($wa_msg)) ?>')">
                      📱 Ingatkan
                    </button>
                    <?php endif; ?>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
        <?php endif; ?>

        <!-- ── REVENUE CHART ── -->
        <?php if (can('accounts')): ?>
        <div class="card">
          <div class="card-header">
            <div class="card-title">📈 Pendapatan <?= date('Y') ?></div>
            <a href="/admin/reports.php" class="btn btn-sm btn-outline">Detail</a>
          </div>
          <div class="card-body">
            <div class="chart-container" style="height:220px">
              <canvas id="revenueChart"></canvas>
            </div>
          </div>
        </div>
        <?php endif; ?>

        <!-- ── UPCOMING CALENDAR ── -->
        <div class="card">
          <div class="card-header">
            <div class="card-title">📅 Agenda Mendatang</div>
            <a href="/admin/calendar.php" class="btn btn-sm btn-outline">Buka Kalender</a>
          </div>
          <div class="card-body" style="padding:12px 16px">
            <?php if (empty($upcoming_events)): ?>
            <div class="empty-state" style="padding:24px">
              <div class="empty-state-icon">📭</div>
              <p>Tidak ada agenda dalam 7 hari ke depan</p>
            </div>
            <?php else: ?>
            <?php foreach ($upcoming_events as $ev): ?>
            <div style="display:flex;gap:12px;padding:9px 0;border-bottom:1px solid var(--border, #e5e9ef)">
              <div style="width:36px;height:36px;border-radius:8px;background:<?= e($ev['color']) ?>22;color:<?= e($ev['color']) ?>;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;flex-shrink:0">
                <?= date('d', strtotime($ev['event_date'])) ?>
              </div>
              <div>
                <div style="font-size:13px;font-weight:600"><?= e($ev['title']) ?></div>
                <div style="font-size:11px;color:#6b7280"><?= date('d M Y', strtotime($ev['event_date'])) ?><?= $ev['start_time'] ? ' · ' . substr($ev['start_time'],0,5) : '' ?></div>
              </div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
          </div>
        </div>

        <!-- ── NEW LEADS ── -->
        <?php if (can('leads') && !empty($recent_leads)): ?>
        <div class="card">
          <div class="card-header">
            <div class="card-title">📨 Lead Baru</div>
            <a href="/admin/leads.php" class="btn btn-sm btn-outline">Semua Lead</a>
          </div>
          <div class="table-wrap">
            <table class="admin-table">
              <thead><tr><th>Nama</th><th>Perusahaan</th><th>Program</th><th>Aksi</th></tr></thead>
              <tbody>
                <?php foreach ($recent_leads as $lead): ?>
                <tr>
                  <td><strong><?= e($lead['name']) ?></strong></td>
                  <td><?= e($lead['company'] ?? '-') ?></td>
                  <td style="font-size:11px"><?= e($lead['course_name'] ?? '-') ?></td>
                  <td>
                    <?php if ($lead['phone']): ?>
                    <button class="btn btn-xs btn-wa"
                            onclick="sendWA('<?= e($lead['phone']) ?>','Halo <?= e($lead['name']) ?>, terima kasih telah menghubungi Wahana Totalita. Kami siap membantu informasi pelatihan sertifikasi Anda. Kapan Anda bisa kami hubungi?')">
                      📱 WA
                    </button>
                    <?php endif; ?>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
        <?php endif; ?>

      </div><!-- /grid -->
    </div><!-- /content -->
  </main>
</div>

<script src="/admin/assets/admin.js"></script>
<?php if (can('accounts') && !empty($monthly_revenue)): ?>
<script>
var months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
var data = new Array(12).fill(0);
<?php foreach ($monthly_revenue as $row): ?>
data[<?= (int)$row['m'] - 1 ?>] = <?= (float)$row['total'] ?>;
<?php endforeach; ?>
new Chart(document.getElementById('revenueChart'), {
  type: 'bar',
  data: {
    labels: months,
    datasets: [{
      label: 'Pendapatan',
      data: data,
      backgroundColor: '#0A4A2E',
      borderRadius: 5,
    }]
  },
  options: {
    responsive: true, maintainAspectRatio: false,
    plugins: { legend: { display: false } },
    scales: {
      y: { ticks: { callback: function(v){ return 'Rp '+v.toLocaleString('id-ID'); }, font:{size:10} }, grid:{color:'#f0f4f8'} },
      x: { ticks: { font:{size:10} }, grid:{display:false} }
    }
  }
});
</script>
<?php endif; ?>
</body>
</html>
