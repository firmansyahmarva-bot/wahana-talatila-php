<?php
/** @var Engine\Content\ContentRepository $content */
$categories = $content->categories();
$bodyHtml = '<div class="wrap"><section class="category-page"><h1>Categories</h1><div class="grid grid-3">';
foreach ($categories as $category) {
    $bodyHtml .= $templates->renderComponent('card', [
        'title' => $category['title'] ?? $category['slug'],
        'href' => '/category/' . ($category['slug'] ?? ''),
        'badge' => $category['title'] ?? $category['slug'] ?? '',
    ]);
}
$bodyHtml .= '</div></section></div>';

echo $templates->renderLayout('base', array_merge(get_defined_vars(), ['bodyHtml' => $bodyHtml]));
