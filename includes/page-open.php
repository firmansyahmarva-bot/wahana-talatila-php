<?php
/**
 * Page wrapper (open half) — config + head + navbar + <main> opener.
 *
 * Usage:
 *   $page_title = '...'; $meta_desc = '...'; $page_css = ['sector']; // optional
 *   require __DIR__ . '/includes/page-open.php';
 *   ... page body ...
 *   require __DIR__ . '/includes/page-close.php';
 */

require_once __DIR__ . '/../config.php';
if (!isset($s)) $s = get_all_settings();
require __DIR__ . '/head.php';
require __DIR__ . '/navbar.php';
?>
<main>
