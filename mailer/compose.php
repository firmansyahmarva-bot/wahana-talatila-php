<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';
require_login();

$pdo = db();
$smtpDefaults = mailer_load_smtp_settings();

$id = (int)($_GET['id'] ?? 0);
$campaign = null;
if ($id > 0) {
    $stmt = $pdo->prepare('SELECT * FROM campaigns WHERE id = ?');
    $stmt->execute([$id]);
    $campaign = $stmt->fetch() ?: null;
    if (!$campaign) {
        flash_set('error', 'Campaign not found.');
        redirect(mailer_url('campaigns.php'));
    }
}

// ── Handle actions ──────────────────────────────────────────────────────
if (is_post()) {
    csrf_verify();
    $action = (string)($_POST['action'] ?? '');

    if ($action === 'save_draft') {
        if ($campaign && $campaign['status'] !== 'draft') {
            flash_set('error', 'This campaign has already been queued and can no longer be edited.');
            redirect(mailer_url('campaign-detail.php?id=' . $campaign['id']));
        }

        $slug = (string)($_POST['template_slug'] ?? '');
        $tpl = mailer_get_template($slug);
        if (!$tpl) {
            flash_set('error', 'Unknown template.');
            redirect(mailer_url('compose.php'));
        }

        $name = trim((string)($_POST['name'] ?? ''));
        $subject = trim((string)($_POST['subject'] ?? ''));
        $fromName = trim((string)($_POST['from_name'] ?? '')) ?: $smtpDefaults['from_name'];
        $dailyLimit = max(1, (int)($_POST['daily_limit'] ?? $smtpDefaults['daily_limit_default']));
        $windowStart = (string)($_POST['send_window_start'] ?? $smtpDefaults['window_start_default']) . ':00';
        $windowEnd = (string)($_POST['send_window_end'] ?? $smtpDefaults['window_end_default']) . ':00';

        $fieldData = [];
        foreach ($tpl['fields'] as $field) {
            $key = (string)($field['key'] ?? '');
            if ($key === '') {
                continue;
            }
            $fieldData[$key] = (string)($_POST['field_' . $key] ?? '');
        }

        if ($name === '' || $subject === '') {
            flash_set('error', 'Campaign name and subject are required.');
            redirect(mailer_url($campaign ? 'compose.php?id=' . $campaign['id'] : 'compose.php?template=' . urlencode($slug)));
        }

        if ($campaign) {
            $stmt = $pdo->prepare(
                'UPDATE campaigns SET name=?, subject=?, template_slug=?, field_data=?, from_name=?, daily_limit=?, send_window_start=?, send_window_end=? WHERE id=?'
            );
            $stmt->execute([$name, $subject, $slug, json_encode($fieldData), $fromName, $dailyLimit, $windowStart, $windowEnd, $campaign['id']]);
            $newId = $campaign['id'];
            flash_set('success', 'Draft saved.');
        } else {
            $stmt = $pdo->prepare(
                'INSERT INTO campaigns (name, subject, template_slug, field_data, from_name, daily_limit, send_window_start, send_window_end, created_at) VALUES (?,?,?,?,?,?,?,?,NOW())'
            );
            $stmt->execute([$name, $subject, $slug, json_encode($fieldData), $fromName, $dailyLimit, $windowStart, $windowEnd]);
            $newId = (int)$pdo->lastInsertId();
            flash_set('success', 'Draft created.');
        }
        redirect(mailer_url('compose.php?id=' . $newId));
    }

    if ($action === 'queue' && $campaign) {
        if ($campaign['status'] !== 'draft') {
            flash_set('error', 'Campaign already queued.');
            redirect(mailer_url('campaign-detail.php?id=' . $campaign['id']));
        }
        $insert = $pdo->prepare(
            'INSERT IGNORE INTO campaign_recipients (campaign_id, contact_id, status)
             SELECT ?, id, "pending" FROM contacts WHERE status = "active"'
        );
        $insert->execute([$campaign['id']]);
        $count = (int)$pdo->query('SELECT COUNT(*) FROM campaign_recipients WHERE campaign_id = ' . (int)$campaign['id'])->fetchColumn();
        $pdo->prepare("UPDATE campaigns SET status='queued', total_recipients=?, queued_at=NOW() WHERE id=?")
            ->execute([$count, $campaign['id']]);
        flash_set('success', "Queued for $count recipient(s). Sending will follow the daily limit and time window automatically.");
        redirect(mailer_url('campaign-detail.php?id=' . $campaign['id']));
    }
}

// ── Read-only view once a campaign has left draft status ───────────────
if ($campaign && $campaign['status'] !== 'draft') {
    redirect(mailer_url('campaign-detail.php?id=' . $campaign['id']));
}

// ── Template picker (no template chosen yet, no existing draft) ────────
$chosenSlug = $campaign['template_slug'] ?? (string)($_GET['template'] ?? '');
$tpl = $chosenSlug !== '' ? mailer_get_template($chosenSlug) : null;

$fieldValues = [];
if ($campaign) {
    $fieldValues = json_decode((string)$campaign['field_data'], true) ?: [];
}

layout_header($campaign ? 'Edit Campaign' : 'New Campaign', 'campaigns');

if (!$tpl):
    $templates = mailer_list_templates();
    ?>
  <p class="muted">Choose a template to start a new campaign.</p>
  <div class="tpl-grid">
    <?php foreach ($templates as $t): ?>
      <div class="tpl-card">
        <div class="tpl-thumb">
          <?php if ($t['preview']): ?>
            <img src="<?= e(mailer_url('templates/' . $t['slug'] . '/' . $t['preview'])) ?>" alt="<?= e($t['name']) ?>">
          <?php else: ?><?= e($t['name']) ?><?php endif; ?>
        </div>
        <div class="tpl-body">
          <h3><?= e($t['name']) ?></h3>
          <p><?= e($t['description']) ?></p>
          <div class="actions-row"><a class="btn btn-sm" href="<?= e(mailer_url('compose.php?template=' . urlencode($t['slug']))) ?>">Use this template</a></div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
<?php else: ?>

  <form method="post" action="<?= e(mailer_url('compose.php' . ($campaign ? '?id=' . $campaign['id'] : ''))) ?>">
    <?= csrf_field() ?>
    <input type="hidden" name="action" value="save_draft">
    <input type="hidden" name="template_slug" value="<?= e($tpl['slug']) ?>">

    <div class="card">
      <h2><?= e($tpl['name']) ?> template</h2>
      <div class="form-grid">
        <div class="form-row"><label>Campaign name (internal)</label><input type="text" name="name" required value="<?= e($campaign['name'] ?? '') ?>"></div>
        <div class="form-row"><label>From name</label><input type="text" name="from_name" value="<?= e($campaign['from_name'] ?? $smtpDefaults['from_name']) ?>"></div>
      </div>
      <div class="form-row"><label>Subject</label><input type="text" name="subject" required value="<?= e($campaign['subject'] ?? '') ?>"></div>

      <?php foreach ($tpl['fields'] as $field): ?>
        <div class="form-row">
          <label><?= e((string)($field['label'] ?? $field['key'])) ?><?= !empty($field['required']) ? ' *' : '' ?></label>
          <?= mailer_render_field_input($field, (string)($fieldValues[$field['key']] ?? ($field['default'] ?? ''))) ?>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="card">
      <h2>Daily sending rules</h2>
      <div class="form-grid">
        <div class="form-row"><label>Daily limit (emails/day)</label><input type="number" name="daily_limit" min="1" value="<?= (int)($campaign['daily_limit'] ?? $smtpDefaults['daily_limit_default']) ?>"></div>
        <div></div>
        <div class="form-row"><label>Start sending at</label><input type="time" name="send_window_start" value="<?= e(substr((string)($campaign['send_window_start'] ?? $smtpDefaults['window_start_default']), 0, 5)) ?>"></div>
        <div class="form-row"><label>Stop sending at</label><input type="time" name="send_window_end" value="<?= e(substr((string)($campaign['send_window_end'] ?? $smtpDefaults['window_end_default']), 0, 5)) ?>"></div>
      </div>
      <p class="hint">If a campaign has more recipients than today's limit, the remainder sends automatically on the following day(s) inside this same window — no manual restart needed.</p>
    </div>

    <div class="actions-row">
      <button type="submit" class="btn">Save Draft</button>
      <?php if ($campaign): ?>
        <a class="btn btn-outline" target="_blank" href="<?= e(mailer_url('preview.php?id=' . $campaign['id'])) ?>">Preview</a>
      <?php endif; ?>
    </div>
  </form>

  <?php if ($campaign): ?>
    <div class="card">
      <h2>Send a test email</h2>
      <form method="post" action="<?= e(mailer_url('send-test.php')) ?>" class="form-inline">
        <?= csrf_field() ?>
        <input type="hidden" name="id" value="<?= (int)$campaign['id'] ?>">
        <div class="form-row" style="flex:1;min-width:220px"><label>Send test to</label><input type="email" name="test_email" required></div>
        <div class="form-row"><button type="submit" class="btn btn-outline">Send Test</button></div>
      </form>
    </div>

    <div class="card">
      <h2>Ready to send</h2>
      <p class="muted">Queues every active contact. Sending then happens automatically via cron, respecting the daily limit and time window above.</p>
      <form method="post" action="<?= e(mailer_url('compose.php?id=' . $campaign['id'])) ?>" onsubmit="return confirm('Queue this campaign for all active contacts? This cannot be undone.')">
        <?= csrf_field() ?>
        <input type="hidden" name="action" value="queue">
        <button type="submit" class="btn">Queue to Send</button>
      </form>
    </div>
  <?php endif; ?>

<?php endif; ?>

<?php layout_footer(); ?>
