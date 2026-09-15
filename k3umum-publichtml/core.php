<?php
/**
 * CORE — front loader included by every page stub.
 * A stub sets $PAGE_KEY, then requires this file.
 */

declare(strict_types=1);

if (!isset($PAGE_KEY)) { http_response_code(500); exit('PAGE_KEY not set'); }

define('K3U_ROOT', __DIR__);

$SITE  = require K3U_ROOT . '/config/site.php';
$PAGES = require K3U_ROOT . '/config/pages.php';

if (!isset($PAGES[$PAGE_KEY])) { http_response_code(404); exit('Unknown page'); }

$page = $PAGES[$PAGE_KEY] + ['key' => $PAGE_KEY];

require K3U_ROOT . '/includes/helpers.php';

/* ---- capture content ---- */
$faq       = [];   // content files may fill: [['q'=>..., 'a'=>...], ...]
$howto     = [];   // content files may fill: ['name'=>..., 'steps'=>['...','...']]
$updated   = null; // content files set an ISO date of last substantive update
$terms     = [];   // glossary.php content only: [['term'=>..,'def'=>..,'link'=>?key], ...]
$contentFile = K3U_ROOT . '/content/' . $PAGE_KEY . '.php';
if (!is_file($contentFile)) { http_response_code(500); exit('Missing content: ' . htmlspecialchars($PAGE_KEY)); }

ob_start();
require $contentFile;
$content_html = ob_get_clean();

/* ---- render ---- */
$template = K3U_ROOT . '/templates/' . $page['type'] . '.php'; // home|hub|reference|glossary|article
require $template;
