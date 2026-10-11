<?php
/**
 * en/construction-safety-system-smkk.php
 * Construction Safety Management System (SMKK) under Permen PUPR 10/2021
 */
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/en-nav.php';

$page_title = 'Construction Safety in Indonesia (SMKK PUPR): Permen 10/2021 Guide — Wahana Totalita';
$meta_desc = 'Comprehensive guide to the Construction Safety Management System (SMKK) in Indonesia under Permen PUPR No. 10/2021. RKK safety plans, Ahli K3 Konstruksi, and civil infrastructure tender compliance.';
$canonical = SITE_URL . '/en/construction-safety-system-smkk/';
$current_slug = 'construction-safety-system-smkk';
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
<link rel="alternate" hreflang="id" href="https://wahanatotalita.com/k3-konstruksi.php" />
<link rel="alternate" hreflang="zh-Hans" href="https://wahanatotalita.com/zh/" />
<meta name="robots" content="index, follow">
<meta name="keywords" content="SMKK PUPR Indonesia, Permen PUPR 10 2021, Ahli K3 Konstruksi, Rencana Keselamatan Konstruksi RKK, civil infrastructure safety Indonesia, EPC construction safety">
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
        { "@type": "ListItem", "position": 3, "name": "Construction Safety System (SMKK)", "item": "<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>" }
      ]
    },
    {
      "@type": "Article",
      "@id": "<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>#article",
      "headline": "Construction Safety System (SMKK PUPR) in Indonesia: Legal Guide",
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

<?php render_en_header($current_slug, 'Construction Safety (SMKK)'); ?>

<section class="en-hero">
  <div class="en-container">
    <div class="en-breadcrumb">
      <a href="/">Home</a> &rsaquo; <a href="/en/">English OHS Hub</a> &rsaquo; <span>Construction Safety (SMKK)</span>
    </div>
    <div class="en-hero-pill">
      <span>Infrastructure &amp; Civil EPC · Permen PUPR No. 10/2021</span>
    </div>
    <h1>Construction Safety Management (SMKK) in Indonesia: Ministry of Public Works Guidelines</h1>
    <p class="en-hero-lead">
      Statutory requirements for international EPC consortia, civil infrastructure contractors, and high-rise builders under Ministry of Public Works (PUPR) regulations: RKK plans, safety budget allocations, and certified construction experts.
    </p>

    <div class="en-trust-bar">
      <div class="en-trust-item">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <div>
          <strong>Permen PUPR 10/2021</strong>
          <span>Statutory construction safety decree</span>
        </div>
      </div>
      <div class="en-trust-item">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <div>
          <strong>Mandatory RKK Plan</strong>
          <span>Construction Safety Plan documentation</span>
        </div>
      </div>
      <div class="en-trust-item">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <div>
          <strong>Ahli K3 Konstruksi</strong>
          <span>SKA / Kemnaker licensed engineers</span>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="en-container">
  <div class="en-body-grid">
    <main>
      <section class="en-card">
        <span class="en-sec-badge">PUPR Regulatory Architecture</span>
        <h2 class="en-sec-title">What is SMKK and How Does it Govern Projects?</h2>
        <p class="en-text">
          In Indonesia, all civil engineering, infrastructure building, and construction services fall under the jurisdiction of the <strong>Ministry of Public Works and Public Housing (Kementerian PUPR)</strong> via <strong>Permen PUPR No. 10 of 2021</strong> on the Implementation of Construction Safety Management Systems (<em>Sistem Manajemen Keselamatan Konstruksi - SMKK</em>).
        </p>
        <p class="en-text">
          Any foreign contractor participating in toll roads, bridges, power station construction, dams, or urban high-rise developments must fulfill two strict contractual prerequisites:
        </p>
        <ul style="padding-left: 20px; line-height: 1.8; color: #374151;">
          <li><strong>Rencana Keselamatan Konstruksi (RKK):</strong> A comprehensive, legally binding project safety plan detailing engineering controls, hazard registers, traffic management, and emergency procedures submitted during tender bidding.</li>
          <li><strong>Dedicated SMKK Budget Line:</strong> Indonesian law prohibits contractors from absorbing safety costs into general overhead; safety costs (PPE, training, medical, equipment inspections) must be explicitly listed as a standalone Bill of Quantities item.</li>
        </ul>
      </section>
    </main>

    <?php render_en_sidebar($current_slug); ?>
  </div>
</div>

<?php render_en_footer(); ?>
</body>
</html>
