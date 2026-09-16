<?php
/**
 * includes/skkni-functions.php
 * Helper functions for retrieving SKKNI & Certified Profession profiles from modular data/skkni/{slug}.php files.
 * Zero database dependency, high-performance static file loading.
 */

if (!defined('SKKNI_DATA_DIR')) {
    define('SKKNI_DATA_DIR', dirname(__DIR__) . '/data/skkni');
}

/**
 * Get a single SKKNI profession profile by slug.
 */
function get_skkni_item(string $slug): ?array {
    // Sanitize slug
    $slug = preg_replace('/[^a-z0-9\-]/', '', strtolower($slug));
    if (empty($slug)) {
        return null;
    }

    $filePath = SKKNI_DATA_DIR . '/' . $slug . '.php';
    if (!file_exists($filePath)) {
        return null;
    }

    $data = require $filePath;
    return is_array($data) ? $data : null;
}

/**
 * Get all SKKNI profession profiles with optional filtering.
 *
 * @param array $filter ['sektor' => string, 'q' => string]
 * @return array
 */
function get_all_skkni_items(array $filter = []): array {
    if (!is_dir(SKKNI_DATA_DIR)) {
        return [];
    }

    $files = glob(SKKNI_DATA_DIR . '/*.php');
    if (!$files) {
        return [];
    }

    $items = [];
    $sektorFilter = !empty($filter['sektor']) ? trim(strtolower($filter['sektor'])) : '';
    $query = !empty($filter['q']) ? trim(strtolower($filter['q'])) : '';

    foreach ($files as $file) {
        $item = require $file;
        if (!is_array($item) || empty($item['slug'])) {
            continue;
        }

        // Apply sector filter
        if ($sektorFilter !== '' && $sektorFilter !== 'semua') {
            if (strtolower(trim($item['sektor'])) !== $sektorFilter) {
                continue;
            }
        }

        // Apply search query filter
        if ($query !== '') {
            $haystack = strtolower(
                ($item['judul'] ?? '') . ' ' .
                ($item['skkni_nomor'] ?? '') . ' ' .
                ($item['sektor'] ?? '') . ' ' .
                ($item['ringkasan'] ?? '') . ' ' .
                ($item['jenjang_kkni'] ?? '')
            );
            if (strpos($haystack, $query) === false) {
                continue;
            }
        }

        $items[] = $item;
    }

    return $items;
}

/**
 * Get distinct sectors with item counts.
 */
function get_skkni_sectors(): array {
    $items = get_all_skkni_items();
    $sectors = [];

    foreach ($items as $item) {
        $sec = $item['sektor'] ?? 'Lainnya';
        if (!isset($sectors[$sec])) {
            $sectors[$sec] = 0;
        }
        $sectors[$sec]++;
    }

    return $sectors;
}

/**
 * Get related professions within the same sector (or adjacent sectors).
 */
function get_related_skkni(string $current_slug, string $sektor, int $limit = 4): array {
    $items = get_all_skkni_items();
    $sameSector = [];
    $otherSector = [];

    foreach ($items as $item) {
        if ($item['slug'] === $current_slug) {
            continue;
        }
        if ($item['sektor'] === $sektor) {
            $sameSector[] = $item;
        } else {
            $otherSector[] = $item;
        }
    }

    $result = array_merge($sameSector, $otherSector);
    return array_slice($result, 0, $limit);
}
