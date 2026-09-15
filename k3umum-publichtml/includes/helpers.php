<?php
/**
 * HELPERS — small functions used by templates and content files.
 */

/** Absolute canonical URL for a page key. */
function page_url(string $key): string {
  global $SITE, $PAGES;
  return $SITE['base_url'] . '/' . $PAGES[$key]['path'];
}

/** Escaped internal <a> for a page key. Optional custom anchor text (use to rotate anchors). */
function ilink(string $key, ?string $text = null): string {
  global $PAGES;
  $t = $text ?? $PAGES[$key]['h1'];
  return '<a href="' . e(page_url($key)) . '">' . e($t) . '</a>';
}

/**
 * Link to a VERIFIED real page on the main domain, URL managed centrally in
 * config/site.php 'external'. This subdomain carries no other links to the
 * main domain or sister subdomains — every use of this helper should trace
 * back to a $page['ext'] value on one of the 7 CTA-eligible pages.
 */
function ext_link(string $key, string $anchor): string {
  global $SITE;
  if (!isset($SITE['external'][$key])) return e($anchor);
  return '<a href="' . e($SITE['external'][$key]) . '">' . e($anchor) . '</a>';
}

/** WhatsApp click-to-chat URL. Defaults to the page's own wa_prefill, falls back to site default. */
function wa_url(?string $custom = null): string {
  global $SITE, $page;
  $msg = $custom ?? ($page['wa_prefill'] ?? $SITE['wa_prefill']);
  return 'https://wa.me/' . $SITE['wa_number'] . '?text=' . rawurlencode($msg);
}

/** Indonesian-formatted date from ISO string, e.g. '2026-07-20' -> '20 Juli 2026'. */
function tgl_id(string $iso): string {
  static $bulan = [1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
  $t = strtotime($iso);
  return date('j', $t) . ' ' . $bulan[(int)date('n', $t)] . ' ' . date('Y', $t);
}

/** HTML-escape shorthand. */
function e(string $s): string {
  return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

/** Estimated reading time in minutes, ~200 words/min for Indonesian body text. */
function reading_time(string $html): int {
  $words = str_word_count(strip_tags($html));
  return max(1, (int)ceil($words / 200));
}

/** Build a table of contents from <h2 id="...">Heading</h2> tags in content. */
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

/** Which content icon a page's badge/card-chip uses. Mirrors build/gen_svg.php's $ICON_FOR — keep in sync. */
function page_icon_name(string $key): string {
  static $map = [
    'home' => 'shield-check',
    'a' => 'file-text', 'a1' => 'file-text', 'a2' => 'file-text', 'a3' => 'file-text',
    'b' => 'award', 'b1' => 'award', 'b2' => 'award', 'b3' => 'award', 'b4' => 'award', 'b5' => 'graduation-cap',
    'c' => 'clipboard-check', 'c1' => 'clipboard-check', 'c2' => 'clipboard-check', 'c3' => 'clipboard-check',
    'c4' => 'clipboard-check', 'c5' => 'clipboard-check', 'c6' => 'clipboard-check',
    'd' => 'factory',
    'e' => 'bar-chart', 'e1' => 'bar-chart',
    'f1' => 'search', 'f2' => 'edit', 'f3' => 'book-open', 'f4' => 'help-circle',
  ];
  return $map[$key] ?? 'shield-check';
}

/** Inline utility icon (24x24), e.g. icon('check', 'ic-sm'). Defined in config/icons.php. */
function icon(string $name, string $class = ''): string {
  static $ICONS = null;
  if ($ICONS === null) $ICONS = require K3U_ROOT . '/config/icons.php';
  $path = $ICONS[$name] ?? '';
  $cls = $class ? ' class="' . e($class) . '"' : '';
  return '<svg' . $cls . ' viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $path . '</svg>';
}

/** All depth-1 pages (the 9 pillars/utilities), ordered by page number. */
function all_pillars(): array {
  global $PAGES;
  $out = [];
  foreach ($PAGES as $k => $p) {
    if ($k !== 'home' && $p['parent'] === null) $out[$k] = $p;
  }
  uasort($out, fn($a, $b) => $a['n'] <=> $b['n']);
  return $out;
}

/** Children of a given pillar key, ordered by page number. */
function pillar_children(string $pillarKey): array {
  global $PAGES;
  $out = [];
  foreach ($PAGES as $k => $p) {
    if ($p['parent'] === $pillarKey) $out[$k] = $p;
  }
  uasort($out, fn($a, $b) => $a['n'] <=> $b['n']);
  return $out;
}

/** Breadcrumb trail for a page: [['label'=>..,'url'=>?..], ...] last item has no url. */
function breadcrumb_trail(array $page): array {
  global $PAGES;
  $trail = [['label' => 'Beranda', 'url' => page_url('home')]];
  if ($page['key'] === 'home') { return [['label' => 'Beranda', 'url' => null]]; }
  if ($page['parent'] !== null) {
    $parent = $PAGES[$page['parent']];
    $trail[] = ['label' => $parent['h1'], 'url' => page_url($page['parent'])];
  }
  $trail[] = ['label' => $page['h1'], 'url' => null];
  return $trail;
}
