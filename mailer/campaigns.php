<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';
require_login();

$campaigns = db()->query('SELECT * FROM campaigns ORDER BY id DESC')->fetchAll();

layout_header('Campaigns', 'campaigns');
?>

<div class="actions-row" style="margin-top:-6px;margin-bottom:20px">
  <a class="btn" href="<?= e(mailer_url('compose.php')) ?>">New Campaign</a>
</div>

<div class="table-wrap">
  <table>
    <thead><tr><th>Name</th><th>Subject</th><th>Template</th><th>Status</th><th>Progress</th><th>Daily limit</th><th></th></tr></thead>
    <tbody>
    <?php foreach ($campaigns as $c): ?>
      <tr>
        <td><?= e($c['name']) ?></td>
        <td><?= e($c['subject']) ?></td>
        <td class="muted small"><?= e($c['template_slug']) ?></td>
        <td><span class="badge badge-<?= e($c['status']) ?>"><?= e($c['status']) ?></span></td>
        <td><?= (int)$c['total_sent'] ?> / <?= (int)$c['total_recipients'] ?></td>
        <td class="muted small"><?= (int)$c['daily_limit'] ?>/day, <?= e(substr((string)$c['send_window_start'], 0, 5)) ?>–<?= e(substr((string)$c['send_window_end'], 0, 5)) ?></td>
        <td>
          <?php if ($c['status'] === 'draft'): ?>
            <a href="<?= e(mailer_url('compose.php?id=' . (int)$c['id'])) ?>">Edit</a>
          <?php else: ?>
            <a href="<?= e(mailer_url('campaign-detail.php?id=' . (int)$c['id'])) ?>">View</a>
          <?php endif; ?>
        </td>
      </tr>
    <?php endforeach; ?>
    <?php if (!$campaigns): ?><tr><td colspan="7" class="muted">No campaigns yet.</td></tr><?php endif; ?>
    </tbody>
  </table>
</div>

<?php layout_footer(); ?>
