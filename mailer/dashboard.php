<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';
require_login();

$pdo = db();
$activeContacts = (int)$pdo->query("SELECT COUNT(*) FROM contacts WHERE status = 'active'")->fetchColumn();
$totalContacts = (int)$pdo->query('SELECT COUNT(*) FROM contacts')->fetchColumn();
$totalCampaigns = (int)$pdo->query('SELECT COUNT(*) FROM campaigns')->fetchColumn();
$sentToday = (int)$pdo->query("SELECT COALESCE(SUM(sent_today),0) FROM campaigns WHERE sent_today_date = CURDATE()")->fetchColumn();
$inProgress = (int)$pdo->query("SELECT COUNT(*) FROM campaigns WHERE status IN ('queued','sending')")->fetchColumn();

$lastRun = cron_last_run();
$cronStale = $lastRun === null || (time() - $lastRun) > 600; // no run in 10 min

$recent = $pdo->query('SELECT id, name, status, total_recipients, total_sent, total_failed, created_at FROM campaigns ORDER BY id DESC LIMIT 6')->fetchAll();

layout_header('Dashboard', 'dashboard');
?>

<div class="stat-grid">
  <div class="stat-card"><div class="num"><?= number_format($activeContacts) ?></div><div class="label">Active contacts (<?= number_format($totalContacts) ?> total)</div></div>
  <div class="stat-card"><div class="num"><?= number_format($totalCampaigns) ?></div><div class="label">Campaigns</div></div>
  <div class="stat-card"><div class="num"><?= number_format($sentToday) ?></div><div class="label">Emails sent today</div></div>
  <div class="stat-card"><div class="num"><?= number_format($inProgress) ?></div><div class="label">Campaigns in progress</div></div>
  <div class="stat-card <?= $cronStale ? 'warn' : '' ?>">
    <div class="num"><?= $lastRun ? e(time_ago($lastRun)) : 'never' ?></div>
    <div class="label">Cron last ran<?= $cronStale ? ' — check crontab' : '' ?></div>
  </div>
</div>

<div class="card">
  <h2>Recent campaigns</h2>
  <?php if (!$recent): ?>
    <p class="muted">No campaigns yet. <a href="<?= e(mailer_url('compose.php')) ?>">Create your first one</a>.</p>
  <?php else: ?>
    <div class="table-wrap">
      <table>
        <thead><tr><th>Name</th><th>Status</th><th>Progress</th><th>Created</th><th></th></tr></thead>
        <tbody>
        <?php foreach ($recent as $c): ?>
          <tr>
            <td><?= e($c['name']) ?></td>
            <td><span class="badge badge-<?= e($c['status']) ?>"><?= e($c['status']) ?></span></td>
            <td><?= (int)$c['total_sent'] ?> sent / <?= (int)$c['total_failed'] ?> failed / <?= (int)$c['total_recipients'] ?> total</td>
            <td class="muted small"><?= e($c['created_at']) ?></td>
            <td><a href="<?= e(mailer_url('campaign-detail.php?id=' . (int)$c['id'])) ?>">View</a></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</div>

<div class="actions-row">
  <a class="btn" href="<?= e(mailer_url('compose.php')) ?>">New Campaign</a>
  <a class="btn btn-outline" href="<?= e(mailer_url('contacts-import.php')) ?>">Import Contacts</a>
</div>

<?php layout_footer(); ?>
