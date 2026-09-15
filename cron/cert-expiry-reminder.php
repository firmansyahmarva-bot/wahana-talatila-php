<?php
/**
 * cron/cert-expiry-reminder.php
 * Send WA/email reminders for certificates expiring in 90, 30, 7 days.
 * Hostinger cron: 0 9 * * * php /home/u566907099/public_html/cron/cert-expiry-reminder.php
 */
if (PHP_SAPI !== 'cli' && (!isset($_GET['cron_key']) || $_GET['cron_key'] !== getenv('CRON_SECRET'))) {
    http_response_code(403); exit('Forbidden');
}
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/notification-functions.php';

$pdo = get_pdo();
$days_list = [90, 30, 7];
$sent = 0;

// Check certifications table (our platform certs)
foreach ($days_list as $days) {
    try {
        $stmt = $pdo->prepare(
            "SELECT c.*, cl.name, cl.email, cl.phone, t_name.name AS training_name
             FROM certifications c
             LEFT JOIN clients cl ON cl.id = c.client_id
             LEFT JOIN user_registrations ur ON ur.id = c.registration_id
             LEFT JOIN training_batches tb ON tb.id = ur.batch_id
             LEFT JOIN trainings t_name ON t_name.id = tb.training_id
             WHERE c.expiry_date = DATE_ADD(CURDATE(), INTERVAL ? DAY)
               AND c.is_valid = 1
               AND c.reminder_sent = 0"
        );
        $stmt->execute([$days]);
        $certs = $stmt->fetchAll();
        foreach ($certs as $cert) {
            $message = "⚠️ *Reminder Sertifikasi K3* ⚠️\n\nYth. {$cert['name']},\n\nSertifikasi *{$cert['training_name']}* Anda akan berakhir dalam *{$days} hari* ({$cert['expiry_date']}).\n\nRenewal sekarang untuk tetap compliance! Hub: wa.me/6281235036420\n\n_Wahana Totalita Konsultan_";
            if (!empty($cert['phone'])) {
                send_wa_notification($cert['phone'], $message);
                log_wa_sent($cert['phone'], $message, true);
            }
            if (!empty($cert['email'])) {
                send_email($cert['email'], $cert['name'], "Sertifikasi K3 Anda Segera Berakhir — {$days} Hari Lagi", "<pre>$message</pre>");
            }
            $pdo->prepare('UPDATE certifications SET reminder_sent = 1 WHERE id = ?')->execute([$cert['id']]);
            $sent++;
        }
    } catch (Exception $e) { error_log('[cert-reminder] ' . $e->getMessage()); }
}

echo date('[Y-m-d H:i:s]') . " Cert expiry reminders sent: $sent\n";
