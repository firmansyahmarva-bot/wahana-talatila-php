<?php
/**
 * en/confined-space-safety-standards.php
 * Confined Space Safety Standards in Indonesia under Permenaker 11/2023
 */
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/en-nav.php';

$page_title = 'Confined Space Safety Indonesia: Permenaker 11/2023 Statutory Guide — Wahana Totalita';
$meta_desc = 'Comprehensive guide to confined space entry compliance in Indonesia under the updated Permenaker No. 11/2023. Gas atmospheric testing, Authorized Entrant, Standby Person, and Rescue Team mandates.';
$canonical = SITE_URL . '/en/confined-space-safety-standards/';
$current_slug = 'confined-space-safety-standards';
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
<link rel="alternate" hreflang="id" href="https://wahanatotalita.com/pelatihan/" />
<link rel="alternate" hreflang="zh-Hans" href="https://wahanatotalita.com/zh/" />
<meta name="robots" content="index, follow">
<meta name="keywords" content="confined space Indonesia, Permenaker 11 2023, ruang terbatas Kemnaker, Teknisi K3 Ruang Terbatas, Madya Utama confined space, gas detector testing permit Indonesia">
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
        { "@type": "ListItem", "position": 3, "name": "Confined Space Safety Standards", "item": "<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>" }
      ]
    },
    {
      "@type": "Article",
      "@id": "<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>#article",
      "headline": "Confined Space Safety in Indonesia: Permenaker No. 11/2023 Guide",
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

<?php render_en_header($current_slug, 'Confined Space Standards'); ?>

<section class="en-hero">
  <div class="en-container">
    <div class="en-breadcrumb">
      <a href="/">Home</a> &rsaquo; <a href="/en/">English OHS Hub</a> &rsaquo; <span>Confined Space Standards</span>
    </div>
    <div class="en-hero-pill">
      <span>High-Risk Safety · Permenaker No. 11/2023</span>
    </div>
    <h1>Confined Space Safety (K3 Ruang Terbatas) in Indonesia: The Permenaker 11/2023 Mandate</h1>
    <p class="en-hero-lead">
      Statutory requirements for entering storage tanks, underground vessels, culverts, silos, and ship holds: atmospheric gas testing, entry permit systems, and certified entrant/rescuer ratios.
    </p>

    <div class="en-trust-bar">
      <div class="en-trust-item">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <div>
          <strong>Permenaker 11/2023</strong>
          <span>Updated statutory confined space law</span>
        </div>
      </div>
      <div class="en-trust-item">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <div>
          <strong>Entry Permit System</strong>
          <span>Mandatory written Izin Masuk</span>
        </div>
      </div>
      <div class="en-trust-item">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <div>
          <strong>Madya &amp; Utama Ratios</strong>
          <span>Certified entrant &amp; supervisor quotas</span>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="en-container">
  <div class="en-body-grid">
    <main>
      <section class="en-card">
        <span class="en-sec-badge">Statutory Overview</span>
        <h2 class="en-sec-title">The Modernized Permenaker 11/2023 Framework</h2>
        <p class="en-text">
          Replacing older regulatory circulars, <strong>Minister of Manpower Regulation No. 11 of 2023</strong> establishes strict statutory protocols for entering, cleaning, inspecting, or welding inside any <strong>Ruang Terbatas (Confined Space)</strong> in Indonesia.
        </p>
        <p class="en-text">
          A confined space is defined as an area with restricted entry/exit, not intended for continuous human occupancy, and prone to atmospheric oxygen deficiency (<19.5%), oxygen enrichment (>23.5%), toxic gas build-up, or engulfment hazards.
        </p>

        <div class="en-law-grid">
          <div class="en-law-card">
            <strong>Petugas K3 Ruang Terbatas (Madya)</strong>
            <p>Certified Authorized Entrants and Standby Persons. Legally qualified to enter the space, operate continuous 4-gas atmospheric monitors, and maintain communication with the outside standby watch.</p>
          </div>
          <div class="en-law-card">
            <strong>Teknisi K3 Ruang Terbatas (Utama)</strong>
            <p>Confined Space Supervisors and Entry Permit Issuers. Legally authorized to perform pre-entry gas clearance tests, authorize the written Entry Permit, and oversee isolation (LOTO).</p>
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
