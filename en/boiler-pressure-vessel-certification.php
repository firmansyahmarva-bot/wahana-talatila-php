<?php
/**
 * en/boiler-pressure-vessel-certification.php
 * Boilers and Pressure Vessels (PUBT) Regulations under Permenaker 37/2016
 */
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/en-nav.php';

$page_title = 'Boilers & Pressure Vessels Indonesia: Permenaker 37/2016 Statutory Guide — Wahana Totalita';
$meta_desc = 'Comprehensive guide to statutory certification for steam boilers, air receivers, and pressure vessels (PUBT) in Indonesia under Permenaker No. 37/2016. Hydrostatic testing, thickness gauging, and licensed boiler operators.';
$canonical = SITE_URL . '/en/boiler-pressure-vessel-certification/';
$current_slug = 'boiler-pressure-vessel-certification';
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
<link rel="alternate" hreflang="id" href="https://wahanatotalita.com/k3-pesawat-uap.php" />
<link rel="alternate" hreflang="zh-Hans" href="https://wahanatotalita.com/zh/" />
<meta name="robots" content="index, follow">
<meta name="keywords" content="boiler certification Indonesia, pressure vessel inspection Permenaker 37 2016, PUBT Kemnaker, hydrostatic test Indonesia, operator boiler Kelas 1 2, bejana tekan Disnaker">
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
        { "@type": "ListItem", "position": 3, "name": "Boiler & Pressure Vessel Certification", "item": "<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>" }
      ]
    },
    {
      "@type": "Article",
      "@id": "<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>#article",
      "headline": "Boilers & Pressure Vessels in Indonesia: Permenaker 37/2016 Statutory Guide",
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

<?php render_en_header($current_slug, 'Boilers & Pressure Vessels'); ?>

<section class="en-hero">
  <div class="en-container">
    <div class="en-breadcrumb">
      <a href="/">Home</a> &rsaquo; <a href="/en/">English OHS Hub</a> &rsaquo; <span>Boilers &amp; Pressure Vessels</span>
    </div>
    <div class="en-hero-pill">
      <span>Steam &amp; Pressurized Systems · Permenaker No. 37/2016</span>
    </div>
    <h1>Boilers &amp; Pressure Vessels (PUBT) in Indonesia: Statutory Inspection &amp; Operator Licensing</h1>
    <p class="en-hero-lead">
      Statutory testing protocols for steam boilers, compressed air receivers, autoclaves, and pressurized storage tanks: ultrasonic thickness gauging, hydrostatic test pressures, and mandatory certified boiler operator quotas.
    </p>

    <div class="en-trust-bar">
      <div class="en-trust-item">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <div>
          <strong>Permenaker 37/2016</strong>
          <span>Pressure vessel legislation</span>
        </div>
      </div>
      <div class="en-trust-item">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <div>
          <strong>Hydrostatic Testing</strong>
          <span>Mandatory pressure proof verification</span>
        </div>
      </div>
      <div class="en-trust-item">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <div>
          <strong>Certified Boiler Operators</strong>
          <span>Class 1 &amp; Class 2 SIO licenses</span>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="en-container">
  <div class="en-body-grid">
    <main>
      <section class="en-card">
        <span class="en-sec-badge">Statutory Framework</span>
        <h2 class="en-sec-title">Understanding Indonesian Steam &amp; Pressure Vessel Laws</h2>
        <p class="en-text">
          Due to catastrophic explosion risks, pressurized equipment in Indonesia is regulated by both the historical <strong>Steam Act of 1930 (Stoomordonnantie 1930)</strong> and the modernized <strong>Minister of Manpower Regulation No. 37 of 2016</strong> concerning Pressure Vessels and Storage Tanks (<em>Bejana Tekanan dan Tangki Timbun</em>).
        </p>
        <p class="en-text">
          Every pressure vessel operating at a design pressure exceeding <strong>1 kg/cm² (0.1 MPa)</strong> must undergo statutory verification, safety valve (PSV) calibration, and ultrasonic wall thickness measurement prior to commissioning.
        </p>

        <div class="en-table-wrap">
          <table class="en-table">
            <thead>
              <tr>
                <th>Equipment Type</th>
                <th>Testing Procedure</th>
                <th>Mandatory Personnel</th>
                <th>Statutory Cycle</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><strong>Steam Boilers (Ketel Uap)</strong></td>
                <td>Internal inspection, thickness gauging, hydrostatic test (1.5x working pressure), PSV pop test</td>
                <td><strong>Operator Boiler Kelas I &amp; II</strong> (Kemnaker SIO)</td>
                <td>Annual Inspection / 2-Year Full Test</td>
              </tr>
              <tr>
                <td><strong>Air Receivers &amp; Compressors</strong></td>
                <td>Visual shell check, NDT wall thickness measurement, safety relief valve verification</td>
                <td>Trained maintenance technician</td>
                <td>Every 2 Years</td>
              </tr>
              <tr>
                <td><strong>LPG / Chemical Storage Tanks</strong></td>
                <td>NDT radiographic/ultrasonic weld seams, earthing continuity test, leakage proofing</td>
                <td>Certified Chemical Officer</td>
                <td>Initial + Every 5 Years</td>
              </tr>
            </tbody>
          </table>
        </div>
      </section>
    </main>

    <?php render_en_sidebar($current_slug); ?>
  </div>
</div>

<?php render_en_footer(); ?>
</body>
</html>
