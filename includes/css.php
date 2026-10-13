<?php
/**
 * includes/css.php — the ONE place that loads site CSS.
 *
 * Order: tokens (colors/spacing) -> core (reset, layout, typography) -> components (buttons, cards, forms...)
 *        -> shared (rules reused by several pages) -> page CSS.
 *
 * Page CSS: set `$page_css = ['my-page'];` BEFORE including head.php to load assets/css/page/my-page.css.
 * Rule: no raw colors outside tokens.css. Use var(--token).
 */
$__css_files = ['tokens', 'core', 'components', 'shared'];
foreach ($__css_files as $__c): ?>
<link rel="stylesheet" href="<?= asset_v('/assets/css/' . $__c . '.css') ?>">
<?php endforeach;
if (!empty($page_css) && is_array($page_css)):
    foreach ($page_css as $__pc): ?>
<link rel="stylesheet" href="<?= asset_v('/assets/css/page/' . e($__pc) . '.css') ?>">
<?php endforeach;
endif;
