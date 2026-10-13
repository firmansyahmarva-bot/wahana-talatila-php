<?php
/**
 * Shared breadcrumb component.
 *
 * Renders the exact same markup every page that used to hand-roll its own
 * breadcrumb was already producing (<nav aria-label="Breadcrumb"><ol
 * class="breadcrumb">...) so no CSS changes are needed anywhere — plus
 * BreadcrumbList JSON-LD, which no page currently emits.
 *
 * Usage:
 *   $breadcrumb_trail = [
 *     ['label' => 'Beranda', 'url' => '/'],
 *     ['label' => 'K3 ' . $c['name'], 'url' => null], // current page: no url
 *   ];
 *   include __DIR__ . '/includes/breadcrumb.php';
 *
 * Does not change, add, or remove any page URL — it only standardizes how
 * the breadcrumb trail (already decided by the including page) is rendered.
 */

if (!empty($breadcrumb_trail)) {
    $n = count($breadcrumb_trail);

    echo '<nav aria-label="Breadcrumb"><ol class="breadcrumb">';
    foreach ($breadcrumb_trail as $i => $crumb) {
        $isLast = ($i === $n - 1);
        echo '<li>';
        if (!$isLast && !empty($crumb['url'])) {
            echo '<a href="' . htmlspecialchars($crumb['url']) . '">' . htmlspecialchars($crumb['label']) . '</a>';
        } else {
            echo '<span aria-current="page">' . htmlspecialchars($crumb['label']) . '</span>';
        }
        echo '</li>';
        if (!$isLast) echo '<li>&rsaquo;</li>';
    }
    echo '</ol></nav>';

    $ldItems = [];
    foreach ($breadcrumb_trail as $i => $crumb) {
        $item = ['@type' => 'ListItem', 'position' => $i + 1, 'name' => $crumb['label']];
        if (!empty($crumb['url'])) {
            $item['item'] = (strpos($crumb['url'], 'http') === 0)
                ? $crumb['url']
                : 'https://wahanatotalita.com' . $crumb['url'];
        }
        $ldItems[] = $item;
    }
    echo '<script type="application/ld+json">' . json_encode([
        '@context'        => 'https://schema.org',
        '@type'           => 'BreadcrumbList',
        'itemListElement' => $ldItems,
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>';
}
