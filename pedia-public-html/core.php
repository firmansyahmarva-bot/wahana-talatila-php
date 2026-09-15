<?php
/**
 * CORE — front loader included by every page stub.
 * A stub sets $PAGE_KEY, then requires this file.
 * core.php loads config, captures the content file, and renders
 * the right template (home / hub / article / utility).
 */

declare(strict_types=1);

if (!isset($PAGE_KEY)) { http_response_code(500); exit('PAGE_KEY not set'); }

define('SMK3_ROOT', __DIR__);

$SITE  = require SMK3_ROOT . '/config/site.php';
$PAGES = require SMK3_ROOT . '/config/pages.php';

if (!isset($PAGES[$PAGE_KEY])) { http_response_code(404); exit('Unknown page'); }

$page = $PAGES[$PAGE_KEY] + ['key' => $PAGE_KEY];

require SMK3_ROOT . '/includes/helpers.php';

/* ---- capture content ---- */
$faq       = [];   // content files may fill this: [['q'=>..., 'a'=>...], ...]
$updated   = null; // content files may set an ISO date of last substantive update
$contentFile = SMK3_ROOT . '/content/' . $PAGE_KEY . '.php';
if (!is_file($contentFile)) { http_response_code(500); exit('Missing content: ' . htmlspecialchars($PAGE_KEY)); }

ob_start();
require $contentFile;
$content_html = ob_get_clean();

/* ---- render ---- */
$template = SMK3_ROOT . '/templates/' . $page['type'] . '.php'; // home.php | hub.php | article.php | utility.php
require $template;
