<!DOCTYPE html>
<html lang="id" translate="no">
<head>
<meta charset="UTF-8">
<meta name="google" content="notranslate">

<!-- Favicon -->
<link rel="icon"             type="image/png" sizes="32x32"   href="/assets/img/favicon-32.png">
<link rel="icon"             type="image/png" sizes="16x16"   href="/assets/img/favicon-16.png">
<link rel="apple-touch-icon"                  sizes="180x180" href="/assets/img/favicon-180.png">
<link rel="shortcut icon"    type="image/x-icon"              href="/assets/img/favicon.ico">
<meta name="msapplication-TileImage" content="/assets/img/favicon-180.png">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
// ─── Homepage-only keyword-first title override ───────────────────────────
// Homepage was previously rendering brand-first via page_title() with no
// args ("Wahana Totalita Konsultan — Pelatihan K3 & Sertifikasi BNSP"),
// which only ever matched branded search queries. This flips it to
// keyword-first for the homepage specifically, so non-brand queries like
// "pelatihan k3" / "sertifikasi bnsp" / "bnsp jogja" have a shot at ranking,
// while inner pages keep using page_title() as before.
$_head_uri   = strtok($_SERVER['REQUEST_URI'] ?? '/', '?');
$_is_home    = ($_head_uri === '/' || $_head_uri === '');
$_home_title = 'Pelatihan K3 & Sertifikasi BNSP Yogyakarta | Wahana Totalita';
?>
<title><?= $_is_home ? e($_home_title) : page_title() ?></title>
<meta name="description" content="<?= e($meta_desc) ?>">
<?php $canonical = 'https://wahanatotalita.com' . strtok($_SERVER['REQUEST_URI'], '?'); ?>
<link rel="canonical" href="<?= htmlspecialchars($canonical) ?>">
<link rel="alternate" hreflang="id" href="<?= htmlspecialchars($canonical) ?>" />
<?php if ($_is_home): ?>
<link rel="alternate" hreflang="zh-Hans" href="https://wahanatotalita.com/zh/" />
<?php endif; ?>
<link rel="alternate" hreflang="x-default" href="<?= htmlspecialchars($canonical) ?>" />

<!-- Open Graph -->
<meta property="og:type"        content="website">
<meta property="og:site_name"   content="<?= e($s['site_name'] ?? '') ?>">
<meta property="og:title"       content="<?= $_is_home ? e($_home_title) : e(($s['site_name'] ?? '') . ' | Pelatihan K3 & Sertifikasi BNSP') ?>">
<meta property="og:description" content="<?= e($meta_desc) ?>">
<meta property="og:url"         content="<?= htmlspecialchars($canonical) ?>">
<meta property="og:image"       content="<?= SITE_URL . e($s['og_image'] ?? '/assets/img/og-cover.jpg') ?>">
<meta name="twitter:card"       content="summary_large_image">
<meta name="twitter:title"      content="<?= $_is_home ? e($_home_title) : e($s['site_name'] ?? '') ?>">
<meta name="theme-color"        content="<?= e(is_valid_hex($s['theme_color_primary'] ?? '') ? $s['theme_color_primary'] : '#0A4A2E') ?>">

<?php if (!empty($s['google_verify'])): ?>
<meta name="google-site-verification" content="<?= e($s['google_verify']) ?>">
<?php endif; ?>

<!-- Fonts: Space Grotesk (high-tech) + Syne (display headings) -->
<meta property="og:locale"       content="id_ID">
<meta property="og:image:width"   content="1200">
<meta property="og:image:height"  content="630">
<meta name="twitter:description"  content="<?= e($meta_desc) ?>">
<meta name="twitter:image"        content="<?= SITE_URL . e($s['og_image'] ?? '/assets/img/og-cover.jpg') ?>">

<!-- PWA / App -->
<link rel="manifest" href="/manifest.json">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="apple-mobile-web-app-title" content="<?= e($s['site_name'] ?? 'Wahana Totalita') ?>">

<!-- Performance: DNS prefetch & preconnect -->
<link rel="dns-prefetch" href="https://www.googletagmanager.com">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<!-- Google Fonts (Non-blocking async load with font-display: swap) -->
<link rel="preload" href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;600;700;800&family=Source+Sans+3:wght@400;600;700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;600;700;800&family=Source+Sans+3:wght@400;600;700&display=swap">
</noscript>

<style><?php
$_core_css_file = __DIR__ . '/../assets/css/core.min.css';
if (is_file($_core_css_file)) {
    readfile($_core_css_file);
} else {
    readfile(__DIR__ . '/../assets/css/core.css');
}
?></style>
<link rel="stylesheet" href="<?= asset_v('/assets/css/components.min.css') ?>" media="print" onload="this.media='all'">
<noscript>
  <link rel="stylesheet" href="<?= asset_v('/assets/css/components.min.css') ?>">
</noscript>
<?php if (!empty($page_css) && is_array($page_css)): foreach ($page_css as $__pc): ?>
<link rel="stylesheet" href="<?= asset_v('/assets/css/page/' . e($__pc) . '.css') ?>">
<?php endforeach; endif; ?>
<?= theme_css_vars($s) ?>

<!-- Structured Data: Organization (all pages) / full @graph (homepage only) -->
<?php require_once __DIR__ . '/schema.php'; ?>
<script type="application/ld+json"><?= build_schema_graph() ?></script>
<?php if ($_is_home): ?>
<!-- WebSite Schema: enables Google Sitelinks Searchbox (homepage only) -->
<script type="application/ld+json"><?= json_encode([
  '@context' => 'https://schema.org',
  '@type'    => 'WebSite',
  '@id'      => SITE_URL . '/#website',
  'url'      => SITE_URL . '/',
  'name'     => $s['site_name'] ?? 'Wahana Totalita Konsultan',
  'description' => $meta_desc,
  'inLanguage'  => 'id',
  'publisher'   => ['@id' => SITE_URL . '/#organization'],
  'potentialAction' => [
    '@type'       => 'SearchAction',
    'target'      => ['@type' => 'EntryPoint', 'urlTemplate' => SITE_URL . '/?s={search_term_string}'],
    'query-input' => 'required name=search_term_string',
  ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?></script>
<?php endif; ?>
</head>
<body>
<div id="scroll-progress" aria-hidden="true"></div>
<a href="#konten-utama" class="skip-link">Langsung ke konten utama</a>
<?php if (!empty($s['gtm_id'])): ?>
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?= e($s['gtm_id']) ?>" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<?php endif; ?>