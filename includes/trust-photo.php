<?php
/**
 * Trust-photo helper — real training photos instead of hotlinked stock.
 *
 * Pool source: /images/pelatihan-001.webp .. pelatihan-067.webp (see
 * includes/hub-category-map.php for $PHOTO_POOL_* and the category-mapping
 * TODO). Never serves from /galeri/ originals (2-7 MB each) — only the
 * compressed /images/ pool or /galeri/thumbs/.
 */

require_once __DIR__ . '/hub-category-map.php';

/**
 * Pick a real training photo for a page context.
 *
 * @param string $context  e.g. article category ('K3'), training category
 *                          slug, or a sector-hub slug. Used only to seed a
 *                          deterministic pick so the same page is stable.
 * @return string  Absolute site path to a .webp, or '' if the pool is empty
 *                  (caller must render nothing in that case — fail silent).
 */
function trust_photo(string $context = ''): string {
    global $PHOTO_POOL_DIR, $PHOTO_POOL_COUNT, $PHOTO_POOL_CATEGORIES;

    if ($PHOTO_POOL_COUNT < 1) return '';

    // Category-matched subset, once $PHOTO_POOL_CATEGORIES is filled in.
    $pool = $PHOTO_POOL_CATEGORIES[$context] ?? range(1, $PHOTO_POOL_COUNT);
    if (empty($pool)) return '';

    // Deterministic pick: same context always resolves to the same photo,
    // different contexts spread across the pool.
    $seed  = $context !== '' ? $context : (string) mt_rand();
    $index = abs(crc32($seed)) % count($pool);
    $n     = $pool[$index];

    $file = sprintf('pelatihan-%03d.webp', $n);
    $base = defined('SITE_URL') ? rtrim(SITE_URL, '/') : '';
    return $base . $PHOTO_POOL_DIR . $file;
}

/**
 * Render a horizontal strip of real gallery/training photos.
 * Renders nothing (empty string) if the pool can't supply enough distinct
 * photos — fail silent, no broken images, no obviously wrong content.
 *
 * @param string $context
 * @param int    $count    How many photos in the strip (default 4)
 * @return string  HTML, or '' if nothing suitable is available
 */
function trust_photo_strip(string $context = '', int $count = 4): string {
    global $PHOTO_POOL_COUNT, $PHOTO_POOL_DIR, $PHOTO_POOL_CATEGORIES;

    if ($PHOTO_POOL_COUNT < 1) return '';

    $pool = $PHOTO_POOL_CATEGORIES[$context] ?? range(1, $PHOTO_POOL_COUNT);
    if (count($pool) < 1) return '';

    $count = max(1, min($count, count($pool)));

    // Deterministic shuffle seeded by context so repeat views are stable.
    $seed = $context !== '' ? $context : 'default';
    mt_srand(crc32($seed));
    $picked = $pool;
    shuffle($picked);
    mt_srand(); // restore non-deterministic state for the rest of the request
    $picked = array_slice($picked, 0, $count);

    $items = '';
    foreach ($picked as $n) {
        $file = sprintf('pelatihan-%03d.webp', $n);
        $src  = e($PHOTO_POOL_DIR . $file);
        $items .= '<a href="/galeri/" class="trust-photo-strip-item">'
                . '<img src="' . $src . '" alt="Dokumentasi pelatihan K3 Wahana Totalita" '
                . 'width="200" height="140" loading="lazy" decoding="async">'
                . '</a>';
    }

    if ($items === '') return '';

    return '<div class="trust-photo-strip">' . $items . '</div>';
}
