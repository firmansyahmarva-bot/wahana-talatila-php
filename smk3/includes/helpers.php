<?php
/**
 * HELPERS — small functions used by templates and content files.
 */

/** Absolute canonical URL for a page key. */
function page_url(string $key): string {
  global $SITE, $PAGES;
  return $SITE['base_url'] . '/' . $PAGES[$key]['path'];
}

/** Escaped internal <a> for a page key. Optional custom anchor text. */
function ilink(string $key, ?string $text = null): string {
  global $PAGES;
  $t = $text ?? $PAGES[$key]['h1'];
  return '<a href="' . e(page_url($key)) . '">' . e($t) . '</a>';
}

/**
 * Editorial link to the main domain, URL managed in config/site.php.
 * Plain editorial link — intentionally no sponsored/nofollow attributes,
 * and used at most once per key sitewide.
 */
function ext_link(string $key, string $anchor): string {
  global $SITE;
  if (!isset($SITE['external'][$key])) return e($anchor);
  return '<a href="' . e($SITE['external'][$key]) . '">' . e($anchor) . '</a>';
}

/** WhatsApp click-to-chat URL with prefilled message. */
function wa_url(?string $custom = null): string {
  global $SITE;
  $msg = $custom ?? $SITE['wa_prefill'];
  return 'https://wa.me/' . $SITE['wa_number'] . '?text=' . rawurlencode($msg);
}

/** Indonesian-formatted date from ISO string, e.g. '2026-07-17' → '17 Juli 2026'. */
function tgl_id(string $iso): string {
  static $bulan = [1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
  $t = strtotime($iso);
  return date('j', $t) . ' ' . $bulan[(int)date('n', $t)] . ' ' . date('Y', $t);
}

/** HTML-escape shorthand. */
function e(string $s): string {
  return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

/**
 * Build a table of contents from <h2 id="...">Heading</h2> tags in content.
 * Returns [['id' => ..., 'text' => ...], ...]
 */
function build_toc(string $html): array {
  $toc = [];
  if (preg_match_all('/<h2\s+id="([^"]+)"[^>]*>(.*?)<\/h2>/s', $html, $m, PREG_SET_ORDER)) {
    foreach ($m as $h) {
      $toc[] = ['id' => $h[1], 'text' => trim(strip_tags($h[2]))];
    }
  }
  return $toc;
}

/** Featured image path (relative to web root) for a page key. */
function img_path(string $key): string {
  return '/assets/img/' . $key . '.svg';
}

/** All pages of a hub, ordered by page number, excluding the hub page itself. */
function hub_children(string $hubSlug): array {
  global $PAGES;
  $out = [];
  foreach ($PAGES as $k => $p) {
    if ($p['hub'] === $hubSlug && $p['type'] === 'article') $out[$k] = $p;
  }
  uasort($out, fn($a, $b) => $a['n'] <=> $b['n']);
  return $out;
}
