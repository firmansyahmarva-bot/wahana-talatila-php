<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';
require_login();
require_once ROOT_PATH . '/includes/mailer.php';

if (is_post()) {
    csrf_verify();
    $action = (string)($_POST['action'] ?? '');

    if ($action === 'save') {
        $ok = mailer_save_smtp_settings([
            'host'                 => trim((string)($_POST['host'] ?? '')),
            'port'                 => (int)($_POST['port'] ?? 465),
            'encryption'           => ($_POST['encryption'] ?? 'ssl') === 'tls' ? 'tls' : 'ssl',
            'username'             => trim((string)($_POST['username'] ?? '')),
            'password'             => (string)($_POST['password'] ?? ''),
            'from_email'           => trim((string)($_POST['from_email'] ?? '')),
            'from_name'            => trim((string)($_POST['from_name'] ?? '')),
            'daily_limit_default'  => max(1, (int)($_POST['daily_limit_default'] ?? 500)),
            'window_start_default' => (string)($_POST['window_start_default'] ?? '10:00'),
            'window_end_default'   => (string)($_POST['window_end_default'] ?? '17:00'),
            'batch_size'           => max(1, (int)($_POST['batch_size'] ?? 25)),
        ]);
        flash_set($ok ? 'success' : 'error', $ok ? 'Settings saved.' : 'Could not write settings file — check folder permissions on config/.');
        redirect(mailer_url('settings.php'));
    }

    if ($action === 'test_connection') {
        $to = trim((string)($_POST['test_to'] ?? ''));
        if (!filter_var($to, FILTER_VALIDATE_EMAIL)) {
            flash_set('error', 'Enter a valid email to send the connectivity test to.');
            redirect(mailer_url('settings.php'));
        }
        $mail = mailer_build_phpmailer();
        $mail->SMTPKeepAlive = false;
        $html = '<p style="font-family:Arial,sans-serif;font-size:14px;color:#1a1a1a">SMTP connection works. This is a connectivity test from Wahana Mailer settings.</p>';
        $result = mailer_send_html($mail, $to, 'Wahana Mailer', 'Wahana Mailer — SMTP test', $html);
        $mail->smtpClose();
        flash_set($result['ok'] ? 'success' : 'error', $result['ok'] ? "Test email sent to $to." : 'SMTP error: ' . $result['error']);
        redirect(mailer_url('settings.php'));
    }
}

$settings = mailer_load_smtp_settings();
$lastRun = cron_last_run();

layout_header('Settings', 'settings');
?>

<div class="card">
  <h2>SMTP</h2>
  <p class="muted small">Credentials are stored in <code>/mailer/config/smtp-settings.json</code> — outside the database, blocked from web access by .htaccess.</p>
  <form method="post">
    <?= csrf_field() ?>
    <input type="hidden" name="action" value="save">
    <div class="form-grid">
      <div class="form-row"><label>SMTP host</label><input type="text" name="host" value="<?= e($settings['host']) ?>" required></div>
      <div class="form-row"><label>Port</label><input type="number" name="port" value="<?= (int)$settings['port'] ?>" required></div>
      <div class="form-row"><label>Encryption</label>
        <select name="encryption">
          <option value="ssl" <?= $settings['encryption'] === 'ssl' ? 'selected' : '' ?>>SSL (port 465)</option>
          <option value="tls" <?= $settings['encryption'] === 'tls' ? 'selected' : '' ?>>TLS (port 587)</option>
        </select>
      </div>
      <div></div>
      <div class="form-row"><label>SMTP username</label><input type="text" name="username" value="<?= e($settings['username']) ?>" required></div>
      <div class="form-row"><label>SMTP password</label><input type="password" name="password" placeholder="•••••••• (leave blank to keep current)"></div>
      <div class="form-row"><label>From email</label><input type="email" name="from_email" value="<?= e($settings['from_email']) ?>" required></div>
      <div class="form-row"><label>From name</label><input type="text" name="from_name" value="<?= e($settings['from_name']) ?>" required></div>
    </div>
    <h3 class="small muted" style="margin-top:20px">Defaults for new campaigns</h3>
    <div class="form-grid">
      <div class="form-row"><label>Default daily limit</label><input type="number" name="daily_limit_default" min="1" value="<?= (int)$settings['daily_limit_default'] ?>"></div>
      <div class="form-row"><label>Batch size per cron run</label><input type="number" name="batch_size" min="1" max="200" value="<?= (int)$settings['batch_size'] ?>"></div>
      <div class="form-row"><label>Default start time</label><input type="time" name="window_start_default" value="<?= e($settings['window_start_default']) ?>"></div>
      <div class="form-row"><label>Default end time</label><input type="time" name="window_end_default" value="<?= e($settings['window_end_default']) ?>"></div>
    </div>
    <button type="submit" class="btn">Save Settings</button>
  </form>
</div>

<div class="card">
  <h2>Test SMTP connectivity</h2>
  <form method="post" class="form-inline">
    <?= csrf_field() ?>
    <input type="hidden" name="action" value="test_connection">
    <div class="form-row" style="flex:1;min-width:220px"><label>Send test to</label><input type="email" name="test_to" required></div>
    <div class="form-row"><button type="submit" class="btn btn-outline">Send Test</button></div>
  </form>
</div>

<div class="card">
  <h2>Cron health</h2>
  <p class="muted"><?= $lastRun ? 'Last run: ' . e(time_ago($lastRun)) . ' (' . e(date('Y-m-d H:i:s', $lastRun)) . ')' : 'The cron job has not run yet.' ?></p>
  <p class="small muted">Expected crontab entry (adjust the path to your account): <br><code>* * * * * /usr/bin/php /home/USER/domains/wahanatotalita.com/public_html/mailer/cron/send-queue.php</code></p>
</div>

<?php layout_footer(); ?>
