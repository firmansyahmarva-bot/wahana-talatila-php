<?php
/**
 * CRON: Send Newsletter
 * Schedule: Daily at 07:00 WIB (00:00 UTC)
 * Command:  php /home/u566907099/public_html/cron/send-newsletter.php
 *
 * Sends pending newsletters from the newsletter_queue table.
 * Falls back to PHPMailer via SMTP (Hostinger) if Evolution WA not configured.
 */
define('CRON_RUN', true);
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/notification-functions.php';

$pdo   = get_pdo();
$start = microtime(true);
$sent  = 0;
$failed = 0;
$log   = [];

// ── 1. Check if there's a pending newsletter campaign to send ───────────────
$campaign = $pdo->query(
    "SELECT * FROM newsletter_campaigns
     WHERE status='scheduled' AND scheduled_at <= NOW()
     ORDER BY scheduled_at ASC LIMIT 1"
)->fetch();

if (!$campaign) {
    echo "[" . date('Y-m-d H:i:s') . "] No campaigns scheduled. Exiting.\n";
    exit(0);
}

echo "[" . date('Y-m-d H:i:s') . "] Starting campaign #{$campaign['id']}: {$campaign['subject']}\n";

// Mark as sending to prevent duplicate runs
$pdo->prepare("UPDATE newsletter_campaigns SET status='sending', started_at=NOW() WHERE id=?")
    ->execute([$campaign['id']]);

// ── 2. Get active subscribers not yet sent this campaign ────────────────────
$subscribers = $pdo->prepare(
    "SELECT ns.* FROM newsletter_subscribers ns
     WHERE ns.is_active = 1
     AND ns.id NOT IN (
         SELECT subscriber_id FROM newsletter_sends
         WHERE campaign_id = ? AND status IN ('sent','bounced')
     )
     ORDER BY ns.subscribed_at ASC
     LIMIT 200"  // batch of 200 per run to stay within shared hosting limits
);
$subscribers->execute([$campaign['id']]);
$subscribers = $subscribers->fetchAll();

if (empty($subscribers)) {
    $pdo->prepare("UPDATE newsletter_campaigns SET status='completed', completed_at=NOW() WHERE id=?")
        ->execute([$campaign['id']]);
    echo "[" . date('Y-m-d H:i:s') . "] No subscribers left. Campaign marked complete.\n";
    exit(0);
}

echo "[" . date('Y-m-d H:i:s') . "] Sending to " . count($subscribers) . " subscribers...\n";

// ── 3. Build email body ──────────────────────────────────────────────────────
$body_template = $campaign['body_html'] ?: nl2br(e($campaign['body_text'] ?? ''));
$site_name     = get_setting('site_name', 'Wahana Totalita');
$site_url      = SITE_URL;

// ── 4. Send via PHPMailer ────────────────────────────────────────────────────
$smtp_settings = [
    'host'     => get_setting('smtp_host',     'smtp.hostinger.com'),
    'port'     => (int)get_setting('smtp_port', '465'),
    'username' => get_setting('smtp_user',     ''),
    'password' => get_setting('smtp_pass',     ''),
    'from'     => get_setting('smtp_from',     get_setting('site_email', '')),
    'from_name'=> get_setting('smtp_from_name', $site_name),
    'secure'   => get_setting('smtp_secure',   'ssl'),
];

foreach ($subscribers as $sub) {
    // Personalise body
    $token     = $sub['unsubscribe_token'] ?: bin2hex(random_bytes(16));
    if (!$sub['unsubscribe_token']) {
        $pdo->prepare('UPDATE newsletter_subscribers SET unsubscribe_token=? WHERE id=?')
            ->execute([$token, $sub['id']]);
    }
    $unsub_url = $site_url . '/newsletter/unsubscribe/?token=' . $token;
    $body = str_replace(
        ['{{name}}', '{{email}}', '{{unsub_url}}', '{{site_url}}', '{{site_name}}'],
        [e($sub['name'] ?: 'Rekan K3'), e($sub['email']), $unsub_url, $site_url, $site_name],
        $body_template
    );

    // Append mandatory unsubscribe footer
    $body .= "\n\n<p style='font-size:11px;color:#9ca3af;text-align:center;margin-top:32px'>"
           . "Kamu menerima email ini karena berlangganan newsletter K3 dari <a href='{$site_url}'>{$site_name}</a>.<br>"
           . "<a href='{$unsub_url}' style='color:#9ca3af'>Berhenti berlangganan</a>"
           . "</p>";

    $ok = send_email_smtp(
        $smtp_settings,
        $sub['email'],
        $sub['name'] ?: '',
        $campaign['subject'],
        $body
    );

    // Log send attempt
    $pdo->prepare(
        "INSERT INTO newsletter_sends (campaign_id, subscriber_id, status, sent_at)
         VALUES (?,?,?,NOW())
         ON DUPLICATE KEY UPDATE status=VALUES(status), sent_at=NOW()"
    )->execute([$campaign['id'], $sub['id'], $ok ? 'sent' : 'failed']);

    if ($ok) { $sent++; } else { $failed++; }

    // Throttle: 1 email per 0.1s to avoid SMTP rate limits on shared hosting
    usleep(100000);
}

// ── 5. Update campaign stats ─────────────────────────────────────────────────
$total_sent = (int)$pdo->prepare("SELECT COUNT(*) FROM newsletter_sends WHERE campaign_id=? AND status='sent'")
    ->execute([$campaign['id']]) ? $pdo->query("SELECT COUNT(*) FROM newsletter_sends WHERE campaign_id={$campaign['id']} AND status='sent'")->fetchColumn() : $sent;

// Check if all subscribers have been sent to
$remaining = (int)$pdo->prepare(
    "SELECT COUNT(*) FROM newsletter_subscribers ns
     WHERE ns.is_active=1
     AND ns.id NOT IN (SELECT subscriber_id FROM newsletter_sends WHERE campaign_id=? AND status IN ('sent','bounced'))"
)->execute([$campaign['id']]) ? $pdo->query("SELECT COUNT(*) FROM newsletter_subscribers ns WHERE ns.is_active=1 AND ns.id NOT IN (SELECT subscriber_id FROM newsletter_sends WHERE campaign_id={$campaign['id']} AND status IN ('sent','bounced'))")->fetchColumn() : 0;

$new_status = $remaining > 0 ? 'sending' : 'completed';
$pdo->prepare("UPDATE newsletter_campaigns SET status=?, sent_count=?, failed_count=?, completed_at=? WHERE id=?")
    ->execute([$new_status, $total_sent, $failed, $new_status==='completed'?date('Y-m-d H:i:s'):null, $campaign['id']]);

$elapsed = round(microtime(true) - $start, 2);
echo "[" . date('Y-m-d H:i:s') . "] Done. Sent: {$sent}, Failed: {$failed}, Remaining: {$remaining}, Time: {$elapsed}s\n";
