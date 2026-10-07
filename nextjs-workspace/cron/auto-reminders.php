<?php
/**
 * cron/auto-reminders.php
 * Generate daily staff reminders for all roles.
 * Hostinger cron: 0 7 * * * php /home/u566907099/public_html/cron/auto-reminders.php
 */
if (PHP_SAPI !== 'cli' && (!isset($_GET['cron_key']) || $_GET['cron_key'] !== getenv('CRON_SECRET'))) {
    http_response_code(403); exit('Forbidden');
}
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/notification-functions.php';

$count = generate_auto_reminders();
echo date('[Y-m-d H:i:s]') . " Auto-reminders: $count tasks created\n";
