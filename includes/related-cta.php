<?php
/**
 * related-cta.php — contextual "next step" block for otherwise dead-end
 * content pages (glossary, incidents, forum, tools, resources, jobs,
 * articles, static city pages, gallery).
 *
 * Usage:
 *   echo related_cta('city', 'ahli-k3-kimia-bandung');
 *   echo related_cta('article', $article['category']);
 *
 * Fails silent (returns '') when the map has no entry for the given type/
 * context — never renders a broken or empty box. Renders at most ~5 links,
 * as an editorial "next step", not a link farm. Styling comes entirely
 * from components.css (.related-cta*) — no inline <style> here.
 *
 * Only 'city' and 'article' have real data behind them right now
 * ($STATIC_CITY_MAP / $HUB_CATEGORY_MAP from includes/hub-category-map.php,
 * both built in T15). glossary/incident/forum/tool/resource/job need
 * DB-derived category maps that weren't available when this was built —
 * those branches are wired to fail silent until that data exists; add the
 * matching array to hub-category-map.php and a case below, same pattern.
 */

require_once __DIR__ . '/hub-category-map.php';

function related_cta(string $cta_type, string $context_key): string {
    global $STATIC_CITY_MAP, $HUB_CATEGORY_MAP, $ARTICLE_CAT_TO_SLUG;

    $links = []; // ['href' => ..., 'label' => ...]
    $wa_message = '';

    switch ($cta_type) {

        case 'city':
            if (empty($STATIC_CITY_MAP[$context_key])) return '';
            $c = $STATIC_CITY_MAP[$context_key];
            $links[] = ['href' => $c['parent'], 'label' => 'Info Lengkap & Jadwal'];
            $links[] = ['href' => $c['hub'], 'label' => 'Program Sejenis Lainnya'];
            $links[] = ['href' => '/jadwal/', 'label' => 'Lihat Semua Jadwal'];
            foreach (array_slice($c['siblings'], 0, 2) as $sib) {
                $label = ucwords(str_replace('-', ' ', $sib));
                $links[] = ['href' => "/pelatihan/{$sib}/", 'label' => $label];
            }
            $wa_message = 'Halo, saya ingin tanya soal pelatihan ini — boleh minta info jadwal dan biaya?';
            break;

        case 'article':
            if (empty($ARTICLE_CAT_TO_SLUG[$context_key])) return '';
            $slug = $ARTICLE_CAT_TO_SLUG[$context_key];
            if (empty($HUB_CATEGORY_MAP[$slug])) return '';
            $hub = $HUB_CATEGORY_MAP[$slug];
            $links[] = ['href' => $hub['hub_url'], 'label' => $hub['hub_name']];
            $subs = array_slice($hub['sub_hubs'] ?? [], 0, 3, true);
            foreach ($subs as $url => $name) {
                $links[] = ['href' => $url, 'label' => $name];
            }
            $wa_message = 'Halo, saya baca artikel di situs Wahana Totalita dan ingin tanya soal pelatihan ' . $hub['hub_name'] . '.';
            break;

        case 'gallery':
            // No per-item category lookup needed here — every gallery page
            // should point at the same two destinations, so this doesn't
            // wait on a DB category map like the others below.
            $links[] = ['href' => '/pelatihan/', 'label' => 'Lihat Semua Program'];
            $links[] = ['href' => '/jadwal/', 'label' => 'Jadwal Pelatihan Terdekat'];
            $links[] = ['href' => '/keselamatan-kerja/', 'label' => 'Keselamatan Kerja'];
            $wa_message = 'Halo, saya lihat galeri dokumentasi pelatihan di situs Wahana Totalita dan ingin tanya info program.';
            break;

        // Not yet backed by data — fail silent until a DB-derived category
        // map is added to hub-category-map.php for each of these.
        case 'glossary':
        case 'incident':
        case 'forum':
        case 'tool':
        case 'resource':
        case 'job':
            return '';

        default:
            return '';
    }

    if (empty($links)) return '';
    $links = array_slice($links, 0, 5);

    $html = '<aside class="related-cta">';
    $html .= '<div class="related-cta-title">Langkah Selanjutnya</div>';
    $html .= '<ul class="related-cta-list">';
    foreach ($links as $l) {
        $html .= '<li><a href="' . e($l['href']) . '">' . e($l['label']) . '</a></li>';
    }
    $html .= '</ul>';
    if ($wa_message !== '' && function_exists('wa_url')) {
        $html .= '<a href="' . e(wa_url($wa_message)) . '" class="related-cta-wa" target="_blank" rel="noopener">Tanya via WhatsApp</a>';
    }
    $html .= '</aside>';

    return $html;
}
