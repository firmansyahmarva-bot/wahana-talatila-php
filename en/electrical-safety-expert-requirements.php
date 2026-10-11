<?php
/**
 * en/electrical-safety-expert-requirements.php
 * Electrical Safety (K3 Listrik) Regulations under Permenaker 12/2015
 */
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/en-nav.php';

$page_title = 'Electrical Safety Regulations Indonesia (K3 Listrik): Expert Mandates — Wahana Totalita';
$meta_desc = 'Comprehensive guide to electrical safety compliance in Indonesia under Permenaker No. 12/2015. Statutory quotas for Teknisi K3 Listrik and Ahli K3 Listrik, high-voltage testing, and PUIL standards.';
$canonical = SITE_URL . '/en/electrical-safety-expert-requirements/';
$current_slug = 'electrical-safety-expert-requirements';
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
<link rel="alternate" hreflang="id" href="https://wahanatotalita.com/k3-listrik.php" />
<link rel="alternate" hreflang="zh-Hans" href="https://wahanatotalita.com/zh/" />
<meta name="robots" content="index, follow">
<meta name="keywords" content="electrical safety Indonesia, K3 Listrik, Permenaker 12 2015, Ahli K3 Listrik, Teknisi K3 Listrik, PUIL 2020 Indonesia, electrical inspection Disnaker">
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
        { "@type": "ListItem", "position": 3, "name": "Electrical Safety (K3 Listrik)", "item": "<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>" }
      ]
    },
    {
      "@type": "Article",
      "@id": "<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>#article",
      "headline": "Electrical Safety Regulations in Indonesia: Permenaker No. 12/2015 Guide",
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

<?php render_en_header($current_slug, 'Electrical Safety Regulations'); ?>

<section class="en-hero">
  <div class="en-container">
    <div class="en-breadcrumb">
      <a href="/">Home</a> &rsaquo; <a href="/en/">English OHS Hub</a> &rsaquo; <span>Electrical Safety (K3 Listrik)</span>
    </div>
    <div class="en-hero-pill">
      <span>Power Systems · Permenaker No. 12/2015</span>
    </div>
    <h1>Electrical Safety (K3 Listrik) in Indonesia: Statutory Staffing &amp; Installation Testing</h1>
    <p class="en-hero-lead">
      Statutory requirements for high-voltage power installations, substations, and industrial manufacturing plants: mandatory ratios for Teknisi K3 Listrik and Ahli K3 Listrik, PUIL standards, and annual grounding verification.
    </p>

    <div class="en-trust-bar">
      <div class="en-trust-item">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <div>
          <strong>Permenaker 12/2015</strong>
          <span>Statutory electrical safety decree</span>
        </div>
      </div>
      <div class="en-trust-item">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <div>
          <strong>>200 kVA Capacity</strong>
          <span>Threshold requiring certified experts</span>
        </div>
      </div>
      <div class="en-trust-item">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <div>
          <strong>Annual Inspection (SIA)</strong>
          <span>Mandatory lightning &amp; transformer testing</span>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="en-container">
  <div class="en-body-grid">
    <main>
      <section class="en-card">
        <span class="en-sec-badge">Statutory Personnel Quotas</span>
        <h2 class="en-sec-title">When is an Electrical Safety Expert Legally Mandatory?</h2>
        <p class="en-text">
          Under <strong>Minister of Manpower Regulation No. 12 of 2015</strong>, companies generating, transmitting, or consuming electrical power are legally subject to strict certified personnel thresholds:
        </p>

        <div class="en-law-grid">
          <div class="en-law-card">
            <strong>Power Capacity >200 kVA</strong>
            <p>Every industrial facility operating electrical generation or consumption capacity exceeding <strong>200 kVA</strong> must employ at least <strong>one certified Ahli K3 Listrik (Electrical OHS Expert)</strong> possessing an official Kemnaker appointment decree (SKP).</p>
          </div>
          <div class="en-law-card">
            <strong>Maintenance &amp; High-Voltage Work</strong>
            <p>Technicians involved in electrical maintenance, distribution panels, and switchgear operation must hold a <strong>Teknisi K3 Listrik license</strong> issued by Kemnaker or BNSP.</p>
          </div>
        </div>
      </section>

      <section class="en-card">
        <span class="en-sec-badge">Inspection Mandates</span>
        <h2 class="en-sec-title">Annual Statutory Testing of Electrical Installations</h2>
        <p class="en-text">
          In addition to certified staff, all electrical installations must undergo periodic statutory testing (<em>Riksa Uji</em>) by a licensed PJK3 inspection body:
        </p>
        <ul style="padding-left: 20px; line-height: 1.8; color: #374151;">
          <li><strong>Lightning Protection Systems (Penangkal Petir):</strong> Earth resistance testing (must not exceed 5 Ohms under Permenaker 02/1989), inspected every 2 years.</li>
          <li><strong>Power Generators &amp; Transformers:</strong> Insulation resistance, dielectric oil analysis, and protective relay trip testing.</li>
          <li><strong>Thermographic Infrared Audits:</strong> Hotspot detection across main distribution boards (MDB) to prevent catastrophic factory fires.</li>
        </ul>
      </section>
    </main>

    <?php render_en_sidebar($current_slug); ?>
  </div>
</div>

<?php render_en_footer(); ?>
</body>
</html>
