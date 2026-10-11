<?php
declare(strict_types=1);

if (PHP_SAPI !== 'cli') {
    http_response_code(403);
    exit('CLI only.');
}

require_once __DIR__ . '/../config.php';
require_once ROOT_PATH . '/includes/mailer.php';

// Prevent two overlapping runs (e.g. a slow batch still running when the next minute ticks).
$lockFile = __DIR__ . '/.sending.lock';
$lockHandle = fopen($lockFile, 'c');
if (!$lockHandle || !flock($lockHandle, LOCK_EX | LOCK_NB)) {
    fwrite(STDERR, "send-queue: another run is already in progress, skipping.\n");
    exit(0);
}

touch(__DIR__ . '/.last-run');

$settings = mailer_load_smtp_settings();
$batchSize = max(1, (int)($settings['batch_size'] ?? 25));
$today = date('Y-m-d');
$now = date('H:i:s');

$pdo = db();
$campaigns = $pdo->query("SELECT * FROM campaigns WHERE status IN ('queued','sending') ORDER BY id ASC")->fetchAll();

foreach ($campaigns as $campaign) {
    $campaignId = (int)$campaign['id'];

    // Roll the daily counter over on a new calendar day — this is what lets a
    // multi-day campaign resume automatically with no manual restart.
    if ($campaign['sent_today_date'] !== $today) {
        $pdo->prepare('UPDATE campaigns SET sent_today = 0, sent_today_date = ? WHERE id = ?')->execute([$today, $campaignId]);
        $campaign['sent_today'] = 0;
    }

    if ((int)$campaign['sent_today'] >= (int)$campaign['daily_limit']) {
        continue; // today's cap reached — next attempt will be tomorrow
    }
    if ($now < $campaign['send_window_start'] || $now > $campaign['send_window_end']) {
        continue; // outside today's sending window — next cron tick inside the window will pick it up
    }

    $remainingToday = (int)$campaign['daily_limit'] - (int)$campaign['sent_today'];
    $limit = min($batchSize, $remainingToday);
    if ($limit <= 0) {
        continue;
    }

    $stmt = $pdo->prepare(
        "SELECT cr.id AS recipient_id, c.id AS contact_id, c.email, c.name, c.unsubscribe_token
         FROM campaign_recipients cr
         JOIN contacts c ON c.id = cr.contact_id
         WHERE cr.campaign_id = ? AND cr.status = 'pending' AND c.status = 'active'
         ORDER BY cr.id ASC LIMIT " . (int)$limit
    );
    $stmt->execute([$campaignId]);
    $batch = $stmt->fetchAll();

    if (!$batch) {
        // No sendable recipients left (either all done, or remaining ones unsubscribed) — close it out.
        $pdo->prepare("UPDATE campaigns SET status='sent', sent_at=NOW() WHERE id=?")->execute([$campaignId]);
        fwrite(STDOUT, "Campaign #$campaignId: complete.\n");
        continue;
    }

    if ($campaign['status'] === 'queued') {
        $pdo->prepare("UPDATE campaigns SET status='sending' WHERE id=?")->execute([$campaignId]);
    }

    $fieldValues = json_decode((string)$campaign['field_data'], true) ?: [];
    $mail = mailer_build_phpmailer();
    $sentCount = 0;

    foreach ($batch as $row) {
        $systemTokens = [
            'contact_name'    => $row['name'] !== '' ? $row['name'] : 'Bapak/Ibu',
            'unsubscribe_url' => mailer_url('unsubscribe.php?t=' . $row['unsubscribe_token']),
            'site_url'        => SITE_URL,
            'site_logo_url'   => SITE_LOGO_URL,
            'current_year'    => date('Y'),
        ];
        $html = mailer_render_template($campaign['template_slug'], $fieldValues, $systemTokens);

        if ($html === null) {
            $pdo->prepare("UPDATE campaign_recipients SET status='failed', error_message='Template files missing', sent_at=NOW() WHERE id=?")
                ->execute([$row['recipient_id']]);
            $pdo->prepare('UPDATE campaigns SET total_failed = total_failed + 1 WHERE id = ?')->execute([$campaignId]);
            continue;
        }

        $result = mailer_send_html($mail, $row['email'], $row['name'], $campaign['subject'], $html);

        if ($result['ok']) {
            $pdo->prepare("UPDATE campaign_recipients SET status='sent', sent_at=NOW() WHERE id=?")->execute([$row['recipient_id']]);
            $pdo->prepare('UPDATE campaigns SET total_sent = total_sent + 1, sent_today = sent_today + 1 WHERE id = ?')->execute([$campaignId]);
            $sentCount++;
        } else {
            $pdo->prepare("UPDATE campaign_recipients SET status='failed', error_message=?, sent_at=NOW() WHERE id=?")
                ->execute([substr((string)$result['error'], 0, 500), $row['recipient_id']]);
            $pdo->prepare('UPDATE campaigns SET total_failed = total_failed + 1 WHERE id = ?')->execute([$campaignId]);
        }
    }

    $mail->smtpClose();
    fwrite(STDOUT, "Campaign #$campaignId: sent $sentCount in this run.\n");
}

flock($lockHandle, LOCK_UN);
fclose($lockHandle);
