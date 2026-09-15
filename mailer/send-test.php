<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';
require_login();
require_once ROOT_PATH . '/includes/mailer.php';

if (!is_post()) {
    redirect(mailer_url('campaigns.php'));
}
csrf_verify();

$id = (int)($_POST['id'] ?? 0);
$testEmail = trim((string)($_POST['test_email'] ?? ''));

$stmt = db()->prepare('SELECT * FROM campaigns WHERE id = ?');
$stmt->execute([$id]);
$campaign = $stmt->fetch();

if (!$campaign) {
    flash_set('error', 'Campaign not found.');
    redirect(mailer_url('campaigns.php'));
}
if (!filter_var($testEmail, FILTER_VALIDATE_EMAIL)) {
    flash_set('error', 'Enter a valid test email address.');
    redirect(mailer_url('compose.php?id=' . $id));
}

$fieldValues = json_decode((string)$campaign['field_data'], true) ?: [];
$systemTokens = [
    'contact_name'    => 'Test Recipient',
    'unsubscribe_url' => mailer_url('unsubscribe.php?t=test'),
    'site_url'        => SITE_URL,
    'site_logo_url'   => SITE_LOGO_URL,
    'current_year'    => date('Y'),
];
$html = mailer_render_template($campaign['template_slug'], $fieldValues, $systemTokens);

if ($html === null) {
    flash_set('error', 'Template files are missing on the server.');
    redirect(mailer_url('compose.php?id=' . $id));
}

$mail = mailer_build_phpmailer();
$mail->SMTPKeepAlive = false;
$result = mailer_send_html($mail, $testEmail, 'Test Recipient', '[TEST] ' . $campaign['subject'], $html);
$mail->smtpClose();

if ($result['ok']) {
    flash_set('success', "Test email sent to $testEmail.");
} else {
    flash_set('error', 'Failed to send test email: ' . $result['error']);
}
redirect(mailer_url('compose.php?id=' . $id));
