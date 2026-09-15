<?php
/**
 * Auto-link first occurrence of glossary terms in HTML body text.
 *
 * Usage: $html = glossary_autolink($html, $pdo);
 *
 * Only links the FIRST occurrence of each term. Skips terms already
 * inside <a>, <h1>-<h6>, <script>, <style> tags. Case-insensitive match.
 * Limits to 10 auto-links per page to avoid over-optimization.
 */

function glossary_autolink(string $html, PDO $pdo, int $max_links = 10): string {
    static $terms = null;

    if ($terms === null) {
        $stmt = $pdo->query("SELECT term, slug FROM glossary WHERE is_active = 1 ORDER BY CHAR_LENGTH(term) DESC");
        $terms = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    if (empty($terms)) return $html;

    $linked = 0;

    foreach ($terms as $t) {
        if ($linked >= $max_links) break;

        $term = preg_quote($t['term'], '/');
        $url = '/glosarium/' . $t['slug'] . '/';

        $pattern = '/(?<!["\'>\/])(?<!<a[^>]*>)\b(' . $term . ')\b(?![^<]*<\/a>)(?![^<]*<\/h[1-6]>)(?![^<]*<\/script>)(?![^<]*<\/style>)/iu';

        $replacement = '<a href="' . e($url) . '" class="glossary-link" title="Lihat definisi: ' . e($t['term']) . '">${1}</a>';

        $result = preg_replace($pattern, $replacement, $html, 1, $count);
        if ($count > 0) {
            $html = $result;
            $linked++;
        }
    }

    return $html;
}
