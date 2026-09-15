<?php
/**
 * SITEMAP — generated live from the manifest. Never hand-edited.
 * Served as /sitemap.xml via .htaccess rewrite. Exactly the 25 canonical pages.
 * Priority weighting per ARCHITECTURE.md §9: home 1.0, pillars 0.8, F3/F4 0.7, children 0.6.
 */
$SITE  = require __DIR__ . '/config/site.php';
$PAGES = require __DIR__ . '/config/pages.php';

header('Content-Type: application/xml; charset=UTF-8');

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

uasort($PAGES, fn($a, $b) => $a['n'] <=> $b['n']);

foreach ($PAGES as $key => $p) {
  $loc = $SITE['base_url'] . '/' . $p['path'];
  if ($key === 'home') $priority = '1.0';
  elseif (in_array($key, ['f3', 'f4'], true)) $priority = '0.7';
  elseif ($p['parent'] === null) $priority = '0.8'; // silo pillars + D/F1/F2
  else $priority = '0.6'; // children
  echo "  <url>\n";
  echo '    <loc>' . htmlspecialchars($loc, ENT_XML1) . "</loc>\n";
  echo "    <changefreq>monthly</changefreq>\n";
  echo "    <priority>{$priority}</priority>\n";
  echo "  </url>\n";
}
echo '</urlset>' . "\n";
