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
            $programs_by_cat = [
                'K3' => [
                    ['href' => '/pelatihan/ak3-bnsp/', 'label' => 'Ahli K3 Muda/Madya/Utama BNSP', 'cert' => 'BNSP'],
                    ['href' => '/pelatihan/pelatihan-k3-operator-forklift-kelas-2-sertifikasi-kemnaker-ri/', 'label' => 'Operator Forklift Kelas 2 Kemnaker RI', 'cert' => 'Kemnaker RI'],
                    ['href' => '/pelatihan/pelatihan-teknisi-bejana-tekan-sertifikasi-kemnaker-ri/', 'label' => 'Teknisi Bejana Tekan & Tangki Timbun', 'cert' => 'Kemnaker RI'],
                    ['href' => '/pelatihan/pelatihan-damkar-paralel-kelas-dcba-sertifikasi-kemnaker-ri/', 'label' => 'Pelatihan Damkar Kelas D/C/B/A', 'cert' => 'Kemnaker RI'],
                    ['href' => '/pelatihan/tkbt-ii-surabaya/', 'label' => 'TKBT Tingkat II (K3 Ketinggian)', 'cert' => 'Kemnaker RI'],
                ],
                'Lingkungan' => [
                    ['href' => '/pelatihan/pelatihan-dan-sertifikasi-pelaksanaan-reklamasi-pada-kegiatan-petambangan-mineral-dan-batubara-sertifikasi-bnsp/', 'label' => 'Reklamasi Pertambangan Minerba BNSP', 'cert' => 'BNSP'],
                    ['href' => '/pelatihan/ak3-bnsp/', 'label' => 'Ahli K3 Lingkungan Kerja BNSP', 'cert' => 'BNSP'],
                    ['href' => '/pelatihan/pelatihan-teknisi-bejana-tekan-sertifikasi-kemnaker-ri/', 'label' => 'Teknisi Bejana Tekan & Tangki Timbun', 'cert' => 'Kemnaker RI'],
                ],
                'Mining' => [
                    ['href' => '/pelatihan/pelatihan-dan-sertifikasi-pelaksanaan-reklamasi-pada-kegiatan-petambangan-mineral-dan-batubara-sertifikasi-bnsp/', 'label' => 'Reklamasi Pertambangan Minerba BNSP', 'cert' => 'BNSP'],
                    ['href' => '/pelatihan/pelatihan-operator-pesawat-tenaga-produksi-ptp/', 'label' => 'Operator Pesawat Tenaga & Produksi (PTP)', 'cert' => 'Kemnaker RI'],
                    ['href' => '/pelatihan/ak3-bnsp/', 'label' => 'Ahli K3 Pertambangan BNSP', 'cert' => 'BNSP'],
                ],
                'ISO' => [
                    ['href' => '/pelatihan/pelatihan-internal-auditor-iso-45001-online/', 'label' => 'Internal Auditor ISO 45001:2018', 'cert' => 'Sertifikat'],
                    ['href' => '/pelatihan/ak3-bnsp/', 'label' => 'Ahli K3 BNSP', 'cert' => 'BNSP'],
                ],
            ];
            $links = $programs_by_cat[$context_key] ?? $programs_by_cat['K3'];
            $wa_message = 'Halo Wahana Totalita, saya membaca artikel ' . $context_key . ' dan ingin konsultasi pendaftaran program pelatihan bersertifikasi.';
            $title_override = 'Program Pelatihan Resmi Rekomendasi';
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

    if ($cta_type === 'article') {
        $html = '<aside class="related-cta related-cta-programs">';
        $html .= '<div class="related-cta-header">';
        $html .= '<span class="related-cta-badge">Sertifikasi Resmi</span>';
        $html .= '<h3 class="related-cta-title">Program Pelatihan Terkait Artikel Ini</h3>';
        $html .= '<p class="related-cta-desc">Tingkatkan kompetensi dan kepatuhan regulasi perusahaan Anda bersama Wahana Totalita.</p>';
        $html .= '</div>';
        $html .= '<div class="related-cta-grid">';
        foreach ($links as $l) {
            $cert_badge = !empty($l['cert']) ? '<span class="rc-cert">' . e($l['cert']) . '</span>' : '';
            $html .= '<a href="' . e($l['href']) . '" class="related-cta-card">';
            $html .= '<div class="rc-card-top">' . $cert_badge . '<span class="rc-arrow">&rarr;</span></div>';
            $html .= '<strong class="rc-title">' . e($l['label']) . '</strong>';
            $html .= '</a>';
        }
        $html .= '</div>';
        $html .= '<div class="related-cta-actions">';
        if ($wa_message !== '' && function_exists('wa_url')) {
            $html .= '<a href="' . e(wa_url($wa_message)) . '" class="related-cta-wa" target="_blank" rel="noopener">'
                  . '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>'
                  . ' Konsultasi via WhatsApp</a>';
        }
        $html .= '<a href="/pelatihan/" class="related-cta-catalog">Lihat Semua 40+ Pelatihan &rarr;</a>';
        $html .= '</div>';
        $html .= '</aside>';
        return $html;
    }

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
