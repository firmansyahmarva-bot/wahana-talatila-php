<?php
/**
 * SITEMAP — generated live from the manifest. Never hand-edited.
 * Served as /sitemap.xml via .htaccess rewrite.
 * Exactly the 50 canonical pages; nothing else.
 */
$SITE  = require __DIR__ . '/config/site.php';
$PAGES = require __DIR__ . '/config/pages.php';

header('Content-Type: application/xml; charset=UTF-8');

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

uasort($PAGES, fn($a, $b) => $a['n'] <=> $b['n']);

foreach ($PAGES as $p) {
  $loc = $SITE['base_url'] . '/' . $p['path'];
  $priority = match ($p['type']) {
    'money' => $p['n'] === 1 ? '1.0' : '0.9',
    'hub'   => '0.8',
    default => '0.6',
  };
  $changefreq = $p['n'] === 49 ? 'weekly' : 'monthly'; // blog updates more often
  echo "  <url>\n";
  echo '    <loc>' . htmlspecialchars($loc, ENT_XML1) . "</loc>\n";
  echo "    <changefreq>{$changefreq}</changefreq>\n";
  echo "    <priority>{$priority}</priority>\n";
  echo "  </url>\n";
}
echo '</urlset>' . "\n";
