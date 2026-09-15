<?php
/** HEADER — <head> + top bar + navigation. PediaK3 (non-commercial library). */
require_once SMK3_ROOT . '/includes/schema.php';

$canonical = page_url($page['key']);
$imgAbs    = $SITE['base_url'] . img_path($page['key']);
$fullTitle = $page['title'] . ' | ' . $SITE['site_name'];
$schema    = build_schema($page, $SITE, $faq);
?><!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($fullTitle) ?></title>
<meta name="description" content="<?= e($page['meta']) ?>">
<link rel="canonical" href="<?= e($canonical) ?>">
<meta name="robots" content="index, follow, max-image-preview:large">

<meta property="og:locale" content="id_ID">
<meta property="og:type" content="<?= $page['type'] === 'home' ? 'website' : 'article' ?>">
<meta property="og:site_name" content="<?= e($SITE['site_name']) ?>">
<meta property="og:title" content="<?= e($page['title']) ?>">
<meta property="og:description" content="<?= e($page['meta']) ?>">
<meta property="og:url" content="<?= e($canonical) ?>">
<meta property="og:image" content="<?= e($imgAbs) ?>">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?= e($page['title']) ?>">
<meta name="twitter:description" content="<?= e($page['meta']) ?>">
<meta name="twitter:image" content="<?= e($imgAbs) ?>">

<link rel="icon" type="image/svg+xml" href="/assets/img/favicon.svg">
<link rel="preload" href="/assets/css/site.css" as="style">
<link rel="stylesheet" href="/assets/css/site.css">
<script type="application/ld+json"><?= json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
</head>
<body>
<a class="skip-link" href="#konten">Langsung ke konten</a>
<div class="topbar">
  <div class="wrap topbar-inner">
    <span><?= e($SITE['tagline']) ?> — konten edukasi, bukan situs komersial</span>
    <span class="topbar-contact">
      <a href="mailto:<?= e($SITE['email']) ?>"><?= e($SITE['email']) ?></a>
    </span>
  </div>
</div>
<header class="site-header">
  <div class="wrap header-inner">
    <a class="brand" href="/" aria-label="<?= e($SITE['site_name']) ?> — Beranda">
      <img src="/assets/img/logo.svg" alt="<?= e($SITE['site_name']) ?> — Pustaka Pengetahuan K3" width="190" height="42">
    </a>
    <input type="checkbox" id="nav-toggle" class="nav-toggle" aria-hidden="true">
    <label for="nav-toggle" class="nav-burger" aria-label="Buka menu navigasi">
      <span></span><span></span><span></span>
    </label>
    <nav class="site-nav" aria-label="Navigasi utama">
      <ul>
        <?php foreach ($SITE['nav'] as $label => $navKey): ?>
        <li><a href="<?= e(page_url($navKey)) ?>"<?= $navKey === $page['key'] ? ' aria-current="page"' : '' ?>><?= e($label) ?></a></li>
        <?php endforeach; ?>
      </ul>
    </nav>
    <a class="btn btn-accent header-cta" href="<?= e(page_url('kontribusi')) ?>">Kirim Artikel</a>
  </div>
</header>
<main id="konten">
