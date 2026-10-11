<?php
/**
 * cron/ai-dispatcher.php
 * Hourly AI wake-up orchestrator. ONE Hostinger cron entry (every hour):
 *   php /home/u566907099/domains/wahanatotalita.com/public_html/cron/ai-dispatcher.php
 *
 *   every hour -> AI lead scoring (only touches new leads)
 *   06:00      -> AI writes & publishes one SEO article (also on first-ever run)
 *   07:00      -> incident scraper (real news -> incident database)
 *   05:00 Mon  -> weekly IndexNow ping of all URLs
 */
if (PHP_SAPI !== 'cli' && (($_GET['key'] ?? '') !== 'wahana2026ping')) {
    http_response_code(403); exit('Forbidden');
}
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/ai-functions.php';

$hour = (int)date('G');
$dow  = (int)date('N');
$log  = [date('[Y-m-d H:i]') . ' dispatcher wake (hour ' . $hour . ')'];

try {
    $n = score_leads_batch(20);
    $log[] = 'lead scoring: ' . $n . ' scored';
} catch (Throwable $e) { $log[] = 'lead scoring failed: ' . $e->getMessage(); }

$flag = __DIR__ . '/.dispatcher-bootstrapped';
// Daily article: at 06:00, on first run, OR self-heal when the newest published
// article is older than ~20h. The self-heal means a missed or failed 6am run is
// retried on the next hourly wake instead of leaving multi-day gaps.
$lastArticleAge = 999.0;
try {
    $ts = get_pdo()->query("SELECT published_at FROM articles WHERE status='published' AND published_at IS NOT NULL ORDER BY published_at DESC LIMIT 1")->fetchColumn();
    if ($ts) $lastArticleAge = (time() - strtotime((string)$ts)) / 3600;
} catch (Throwable $e) {}
$writeArticle = ($hour === 6) || !file_exists($flag) || $lastArticleAge >= 20;
if ($writeArticle) {
    @touch($flag);
    try { include __DIR__ . '/write-article.php'; $log[] = 'article run (last age ' . round($lastArticleAge, 1) . 'h)'; }
    catch (Throwable $e) { $log[] = 'article failed: ' . $e->getMessage(); }
}

// Incidents: scrape at most once per ~20h, whatever the cron schedule is
// (was gated to hour 7, which a non-hourly cron may never hit).
$incFlag = __DIR__ . '/.last-incident-scrape';
if (PHP_SAPI === 'cli' && is_file(__DIR__ . '/scrape-incidents.php')
    && (!is_file($incFlag) || (time() - filemtime($incFlag)) > 20 * 3600)) {
    @touch($incFlag);
    try { include __DIR__ . '/scrape-incidents.php'; $log[] = 'incident scraper ran'; }
    catch (Throwable $e) { $log[] = 'incidents failed: ' . $e->getMessage(); }
}

// IndexNow: ping at most once per ~6.5 days (was gated to Mon 05:00).
$idxFlag = __DIR__ . '/.last-indexnow';
if (!is_file($idxFlag) || (time() - filemtime($idxFlag)) > 6.5 * 86400) {
    @touch($idxFlag);
    $out = @file_get_contents(SITE_URL . '/indexnow-ping.php?key=wahana2026ping');
    $log[] = 'indexnow: ' . substr((string)$out, 0, 60);
}

echo implode("\n", $log), "\n";
