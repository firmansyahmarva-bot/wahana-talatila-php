<?php
/**
 * cron/scrape-incidents.php
 * Daily auto-scrape K3 news → save new incidents via Claude AI extraction.
 * Hostinger cron: 0 6 * * * php /home/u566907099/public_html/cron/scrape-incidents.php
 */
if (PHP_SAPI !== 'cli' && (!isset($_GET['cron_key']) || $_GET['cron_key'] !== getenv('CRON_SECRET'))) {
    http_response_code(403); exit('Forbidden');
}
define('SITE_URL', 'https://wahanatotalita.com');
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/incident-functions.php';

$start = microtime(true);
$saved = scrape_and_save_incidents(30);
$time  = round(microtime(true) - $start, 2);
echo date('[Y-m-d H:i:s]') . " Scrape done: $saved new incidents saved in {$time}s\n";
