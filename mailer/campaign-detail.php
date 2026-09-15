<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';
require_login();

$pdo = db();
$id = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare('SELECT * FROM campaigns WHERE id = ?');
$stmt->execute([$id]);
$campaign = $stmt->fetch();
if (!$campaign) {
    flash_set('error', 'Campaign not found.');
    redirect(mailer_url('campaigns.php'));
}

if (is_post()) {
    csrf_verify();
    $action = (string)($_POST['action'] ?? '');
    if ($action === 'pause' && in_array($campaign['status'], ['queued', 'sending'], true)) {
        $pdo->prepare("UPDATE campaigns SET status='paused' WHERE id=?")->execute([$id]);
        flash_set('success', 'Campaign paused. Cron will skip it until resumed.');
    } elseif ($action === 'resume' && $campaign['status'] === 'paused') {
        $pdo->prepare("UPDATE campaigns SET status='queued' WHERE id=?")->execute([$id]);
        flash_set('success', 'Campaign resumed.');
    } elseif ($action === 'update_limits') {
        $dailyLimit = max(1, (int)($_POST['daily_limit'] ?? $campaign['daily_limit']));
        $windowStart = preg_match('/^\d{2}:\d{2}$/', (string)($_POST['send_window_start'] ?? '')) ? $_POST['send_window_start'] . ':00' : $campaign['send_window_start'];
        $windowEnd = preg_match('/^\d{2}:\d{2}$/', (string)($_POST['send_window_end'] ?? '')) ? $_POST['send_window_end'] . ':00' : $campaign['send_window_end'];
        $pdo->prepare('UPDATE campaigns SET daily_limit=?, send_window_start=?, send_window_end=? WHERE id=?')
            ->execute([$dailyLimit, $windowStart, $windowEnd, $id]);
        flash_set('success', 'Sending rules updated. The queue applies them from the next cron run.');
    } elseif ($action === 'retry_failed') {
        $stmt = $pdo->prepare("UPDATE campaign_recipients SET status='pending', error_message=NULL, sent_at=NULL WHERE campaign_id=? AND status='failed'");
        $stmt->execute([$id]);
        $n = $stmt->rowCount();
        $pdo->prepare("UPDATE campaigns SET total_failed = 0, status = IF(status='sent','queued',status) WHERE id=?")->execute([$id]);
        flash_set('success', "$n failed recipient(s) moved back to pending. They will be re-sent by the queue (daily limit and window still apply).");
    }
    redirect(mailer_url('campaign-detail.php?id=' . $id));
}

$counts = ['pending' => 0, 'sent' => 0, 'failed' => 0];
$rows = $pdo->prepare('SELECT status, COUNT(*) AS n FROM campaign_recipients WHERE campaign_id = ? GROUP BY status');
$rows->execute([$id]);
foreach ($rows->fetchAll() as $r) {
    $counts[$r['status']] = (int)$r['n'];
}
$total = array_sum($counts);
$donePct = $total > 0 ? round((($counts['sent'] + $counts['failed']) / $total) * 100) : 0;

$page = max(1, (int)($_GET['page'] ?? 1));
$perPage = 50;
$offset = ($page - 1) * $perPage;
$logStmt = $pdo->prepare(
    'SELECT cr.status, cr.error_message, cr.sent_at, c.email, c.name
     FROM campaign_recipients cr JOIN contacts c ON c.id = cr.contact_id
     WHERE cr.campaign_id = ? ORDER BY cr.id DESC LIMIT ' . (int)$perPage . ' OFFSET ' . (int)$offset
);
$logStmt->execute([$id]);
$log = $logStmt->fetchAll();
$totalPages = max(1, (int)ceil($total / $perPage));

layout_header('Campaign: ' . $campaign['name'], 'campaigns');
?>

<div class="card">
  <h2><?= e($campaign['subject']) ?> <span class="badge badge-<?= e($campaign['status']) ?>"><?= e($campaign['status']) ?></span></h2>
  <p class="muted small">Template: <?= e($campaign['template_slug']) ?> · Daily limit: <?= (int)$campaign['daily_limit'] ?>/day · Window: <?= e(substr((string)$campaign['send_window_start'], 0, 5)) ?>–<?= e(substr((string)$campaign['send_window_end'], 0, 5)) ?> · Sent today: <?= (int)$campaign['sent_today'] ?></p>

  <div class="progress-bar"><span style="width:<?= (int)$donePct ?>%"></span></div>
  <p class="small muted" style="margin-top:8px"><?= (int)$counts['sent'] ?> sent · <?= (int)$counts['failed'] ?> failed · <?= (int)$counts['pending'] ?> pending · <?= (int)$total ?> total (<?= (int)$donePct ?>%)</p>

  <?php if (in_array($campaign['status'], ['queued', 'sending'], true)): ?>
    <form method="post" style="display:inline"><?= csrf_field() ?><input type="hidden" name="action" value="pause"><button class="btn btn-outline btn-sm" type="submit">Pause</button></form>
  <?php elseif ($campaign['status'] === 'paused'): ?>
    <form method="post" style="display:inline"><?= csrf_field() ?><input type="hidden" name="action" value="resume"><button class="btn btn-sm" type="submit">Resume</button></form>
  <?php endif; ?>
  <?php if ($counts['failed'] > 0): ?>
    <form method="post" style="display:inline" onsubmit="return confirm('Move all <?= (int)$counts['failed'] ?> failed recipient(s) back to pending for re-sending?')">
      <?= csrf_field() ?><input type="hidden" name="action" value="retry_failed">
      <button class="btn btn-outline btn-sm" type="submit">Retry failed (<?= (int)$counts['failed'] ?>)</button>
    </form>
  <?php endif; ?>
  <a class="btn btn-outline btn-sm" target="_blank" href="<?= e(mailer_url('preview.php?id=' . $id)) ?>">Preview email</a>
</div>

<?php if ($campaign['status'] !== 'sent'): ?>
<div class="card">
  <h2>Sending rules</h2>
  <form method="post" class="form-inline">
    <?= csrf_field() ?>
    <input type="hidden" name="action" value="update_limits">
    <div class="form-row"><label>Daily limit</label><input type="number" name="daily_limit" min="1" value="<?= (int)$campaign['daily_limit'] ?>" style="width:120px"></div>
    <div class="form-row"><label>Start time</label><input type="time" name="send_window_start" value="<?= e(substr((string)$campaign['send_window_start'], 0, 5)) ?>"></div>
    <div class="form-row"><label>End time</label><input type="time" name="send_window_end" value="<?= e(substr((string)$campaign['send_window_end'], 0, 5)) ?>"></div>
    <div class="form-row"><button type="submit" class="btn btn-sm">Apply</button></div>
  </form>
  <p class="hint">Applies to this campaign from the next cron run — works while queued, sending, or paused. Emails already sent today still count against the new limit.</p>
</div>
<?php endif; ?>

<div class="card">
  <h2>Send log</h2>
  <div class="table-wrap">
    <table>
      <thead><tr><th>Recipient</th><th>Status</th><th>Sent at</th><th>Error</th></tr></thead>
      <tbody>
      <?php foreach ($log as $row): ?>
        <tr>
          <td><?= e($row['name']) ?> &lt;<?= e($row['email']) ?>&gt;</td>
          <td><span class="badge badge-<?= e($row['status']) ?>"><?= e($row['status']) ?></span></td>
          <td class="muted small"><?= e((string)$row['sent_at']) ?></td>
          <td class="muted small"><?= e((string)$row['error_message']) ?></td>
        </tr>
      <?php endforeach; ?>
      <?php if (!$log): ?><tr><td colspan="4" class="muted">No log entries yet.</td></tr><?php endif; ?>
      </tbody>
    </table>
  </div>
  <?php if ($totalPages > 1): ?>
    <div class="pagination">
      <?php for ($p = 1; $p <= $totalPages; $p++): ?>
        <?php if ($p === $page): ?><span class="current"><?= $p ?></span>
        <?php else: ?><a href="<?= e(mailer_url('campaign-detail.php?id=' . $id . '&page=' . $p)) ?>"><?= $p ?></a><?php endif; ?>
      <?php endfor; ?>
    </div>
  <?php endif; ?>
</div>

<?php layout_footer(); ?>
