<?php
/**
 * cron/score-leads.php
 * AI-score new leads using Claude (claude-haiku = very cheap).
 * Hostinger cron: 0 8 * * * php /home/u566907099/public_html/cron/score-leads.php
 */
if (PHP_SAPI !== 'cli' && (!isset($_GET['cron_key']) || $_GET['cron_key'] !== getenv('CRON_SECRET'))) {
    http_response_code(403); exit('Forbidden');
}
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/ai-functions.php';

$scored = score_leads_batch(20);
echo date('[Y-m-d H:i:s]') . " AI lead scoring: $scored leads scored\n";
