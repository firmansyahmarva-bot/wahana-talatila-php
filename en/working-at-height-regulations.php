<?php
/**
 * en/working-at-height-regulations.php
 * Working at Height Regulations in Indonesia under Permenaker 09/2016
 */
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/en-nav.php';

$page_title = 'Working at Height Regulations Indonesia: TKBT & TKPK Permenaker 09/2016 — Wahana Totalita';
$meta_desc = 'Comprehensive guide to working at height safety in Indonesia under Permenaker No. 09/2016. TKBT (Building & Structure) vs TKPK (Rope Access) certification, fall protection plans, and PPE compliance.';
$canonical = SITE_URL . '/en/working-at-height-regulations/';
$current_slug = 'working-at-height-regulations';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8') ?></title>
<meta name="description" content="<?= htmlspecialchars($meta_desc, ENT_QUOTES, 'UTF-8') ?>">
<link rel="canonical" href="<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>">
<link rel="alternate" hreflang="en" href="<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>" />
<link rel="alternate" hreflang="id" href="https://wahanatotalita.com/k3-ketinggian.php" />
<link rel="alternate" hreflang="zh-Hans" href="https://wahanatotalita.com/zh/" />
<meta name="robots" content="index, follow">
<meta name="keywords" content="working at height Indonesia, Permenaker 09 2016, TKBT 1 2, TKPK rope access Indonesia, fall protection regulations Indonesia, working at heights certification Kemnaker">
<meta name="author" content="PT Wahana Totalita Konsultan">

<meta property="og:type" content="article">
<meta property="og:site_name" content="Wahana Totalita Konsultan">
<meta property="og:locale" content="en_US">
<meta property="og:title" content="<?= htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:description" content="<?= htmlspecialchars($meta_desc, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:url" content="<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:image" content="https://wahanatotalita.com/assets/img/og-cover.jpg">

<link rel="stylesheet" href="<?= asset_v('/assets/css/page/en.min.css') ?>">

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "BreadcrumbList",
      "@id": "<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>#breadcrumb",
      "itemListElement": [
        { "@type": "ListItem", "position": 1, "name": "Home", "item": "https://wahanatotalita.com/" },
        { "@type": "ListItem", "position": 2, "name": "English OHS Hub", "item": "https://wahanatotalita.com/en/" },
        { "@type": "ListItem", "position": 3, "name": "Working at Height Regulations", "item": "<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>" }
      ]
    },
    {
      "@type": "Article",
      "@id": "<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>#article",
      "headline": "Working at Height Regulations in Indonesia: Permenaker 09/2016 Guide",
      "description": "<?= htmlspecialchars($meta_desc, ENT_QUOTES, 'UTF-8') ?>",
      "inLanguage": "en-US",
      "mainEntityOfPage": "<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>",
      "datePublished": "2026-09-01T08:00:00+07:00",
      "dateModified": "2026-10-01T12:00:00+07:00",
      "publisher": {
        "@type": "Organization",
        "name": "PT Wahana Totalita Konsultan",
        "url": "https://wahanatotalita.com",
        "logo": { "@type": "ImageObject", "url": "https://wahanatotalita.com/assets/img/logo-wt.png" }
      }
    }
  ]
}
</script>
</head>
<body>

<?php render_en_header($current_slug, 'Working at Height Regulations'); ?>

<section class="en-hero">
  <div class="en-container">
    <div class="en-breadcrumb">
      <a href="/">Home</a> &rsaquo; <a href="/en/">English OHS Hub</a> &rsaquo; <span>Working at Height Regulations</span>
    </div>
    <div class="en-hero-pill">
      <span>High-Risk Safety · Permenaker No. 09/2016</span>
    </div>
    <h1>Working at Height in Indonesia: The Permenaker 09/2016 Compliance Guide</h1>
    <p class="en-hero-lead">
      Statutory requirements for elevated construction, telecommunication towers, roof maintenance, and structural rigging: understanding the mandatory distinction between TKBT (Structural Access) and TKPK (Rope Access).
    </p>

    <div class="en-trust-bar">
      <div class="en-trust-item">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <div>
          <strong>Permenaker 09/2016</strong>
          <span>Work at height statute</span>
        </div>
      </div>
      <div class="en-trust-item">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <div>
          <strong>TKBT vs TKPK</strong>
          <span>Fixed structure vs rope access</span>
        </div>
      </div>
      <div class="en-trust-item">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <div>
          <strong>1.8m Statutory Threshold</strong>
          <span>Mandatory fall protection trigger</span>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="en-container">
  <div class="en-body-grid">
    <main>
      <section class="en-card">
        <span class="en-sec-badge">Statutory Threshold</span>
        <h2 class="en-sec-title">What Legally Defines Working at Height in Indonesia?</h2>
        <p class="en-text">
          Under <strong>Permenaker No. 09 of 2016</strong>, working at height (<em>Bekerja Pada Ketinggian</em>) is defined as any activity conducted on a surface differing in elevation by <strong>1.8 meters or more</strong> from the base ground level where a risk of falling exists.
        </p>
        <p class="en-text">
          Employers are legally prohibited from allowing workers to execute tasks above 1.8 meters unless they possess a formal Work at Height Plan (<em>Rencana Kerja Pada Ketinggian</em>), inspected full-body harnesses, and certified personnel.
        </p>

        <div class="en-law-grid">
          <div class="en-law-card">
            <strong>TKBT — Tenaga Kerja Bangunan Tinggi</strong>
            <p>For personnel working on scaffolds, permanent ladders, elevated walkways, and structural platforms. Divided into <strong>TKBT Tingkat 1</strong> (basic elevated work) and <strong>TKBT Tingkat 2</strong> (supervisors and rigging technicians).</p>
          </div>
          <div class="en-law-card">
            <strong>TKPK — Tenaga Kerja Pada Ketinggian (Rope Access)</strong>
            <p>For personnel suspended by ropes without scaffolding (facade work, offshore flares, wind turbine blades). Divided into <strong>TKPK Tingkat 1</strong> (technician), <strong>Tingkat 2</strong> (advanced rigger), and <strong>Tingkat 3</strong> (rope access team leader &amp; rescuer).</p>
          </div>
        </div>
      </section>
    </main>

    <?php render_en_sidebar($current_slug); ?>
  </div>
</div>

<?php render_en_footer(); ?>
</body>
</html>
