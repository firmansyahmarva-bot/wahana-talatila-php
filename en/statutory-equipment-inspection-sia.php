<?php
/**
 * en/statutory-equipment-inspection-sia.php
 * Statutory Equipment Inspection (Riksa Uji / SIA) in Indonesia
 */
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/en-nav.php';

$page_title = 'Statutory Equipment Inspection Indonesia (Riksa Uji SIA): Legal Machinery Certification — Wahana Totalita';
$meta_desc = 'Comprehensive guide to statutory machinery inspection (Riksa Uji) and SIA permits in Indonesia under Permenaker 08/2020 and 38/2016. Cranes, pressure vessels, boilers, electrical, and PJK3 testing.';
$canonical = SITE_URL . '/en/statutory-equipment-inspection-sia/';
$current_slug = 'statutory-equipment-inspection-sia';
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
<link rel="alternate" hreflang="id" href="https://wahanatotalita.com/riksa-uji/" />
<link rel="alternate" hreflang="zh-Hans" href="https://wahanatotalita.com/zh/sio-alat-berat/" />
<meta name="robots" content="index, follow">
<meta name="keywords" content="Riksa Uji Indonesia, statutory equipment inspection, SIA permit Kemnaker, PJK3 Riksa Uji, crane load testing Indonesia, pressure vessel inspection Disnaker">
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
        { "@type": "ListItem", "position": 3, "name": "Statutory Equipment Inspection (SIA)", "item": "<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>" }
      ]
    },
    {
      "@type": "Article",
      "@id": "<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>#article",
      "headline": "Statutory Equipment Inspection in Indonesia: Riksa Uji & SIA Guide",
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

<?php render_en_header($current_slug, 'Equipment Inspection (SIA)'); ?>

<section class="en-hero">
  <div class="en-container">
    <div class="en-breadcrumb">
      <a href="/">Home</a> &rsaquo; <a href="/en/">English OHS Hub</a> &rsaquo; <span>Statutory Equipment Inspection (SIA)</span>
    </div>
    <div class="en-hero-pill">
      <span>Machinery Certification · Permenaker No. 08/2020 &amp; 38/2016</span>
    </div>
    <h1>Statutory Machinery Inspection (Riksa Uji / SIA) in Indonesia: Pre-Commissioning &amp; Annual Certification</h1>
    <p class="en-hero-lead">
      Essential compliance for foreign contractors and plant managers: understanding mandatory third-party PJK3 technical inspection, load testing, and government operating license (SIA) issuance.
    </p>

    <div class="en-trust-bar">
      <div class="en-trust-item">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <div>
          <strong>Licensed PJK3 Body</strong>
          <span>Authorized testing authority</span>
        </div>
      </div>
      <div class="en-trust-item">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <div>
          <strong>Surat Izin Alat (SIA)</strong>
          <span>Official government operating permit</span>
        </div>
      </div>
      <div class="en-trust-item">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <div>
          <strong>Annual Re-Testing</strong>
          <span>Statutory 12-month re-certification</span>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="en-container">
  <div class="en-body-grid">
    <main>
      <section class="en-card">
        <span class="en-sec-badge">Statutory Mandate</span>
        <h2 class="en-sec-title">What is Riksa Uji and Why Must Machines Be Certified?</h2>
        <p class="en-text">
          Under Indonesian law, no heavy industrial machine, lifting apparatus, or pressurized vessel can be operated legally without an official <strong>Surat Izin Alat (SIA)</strong> or <strong>Surat Keterangan Kelayakan K3</strong> issued by the Ministry of Manpower. The technical testing protocol through which this permit is granted is known as <strong>Riksa Uji (Pemeriksaan dan Pengujian)</strong>.
        </p>
        <p class="en-text">
          Statutory inspection must be executed strictly by an authorized <strong>Perusahaan Jasa K3 (PJK3 Riksa Uji)</strong> licensed by Kemnaker, such as <strong>PT Wahana Totalita Konsultan</strong>.
        </p>

        <div class="en-alert-box">
          <strong>Mandatory for All Imported and Leased Equipment</strong>
          <p>
            When international contractors import specialized equipment or lease local cranes and forklifts in Indonesia, the manufacturer’s CE or ASME stamp is not enough for operational clearance. The equipment must pass on-site testing by a licensed Indonesian PJK3 inspector before site commissioning.
          </p>
        </div>
      </section>

      <section class="en-card">
        <span class="en-sec-badge">Equipment Scope</span>
        <h2 class="en-sec-title">Equipment Categories Requiring Mandatory Statutory Testing</h2>
        <div class="en-table-wrap">
          <table class="en-table">
            <thead>
              <tr>
                <th>Category</th>
                <th>Governing Statute</th>
                <th>Equipment Included</th>
                <th>Inspection Frequency</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><strong>Lifting &amp; Transport Plant (PAA)</strong></td>
                <td>Permenaker 08/2020</td>
                <td>Mobile cranes, overhead cranes, forklifts, excavators, gondolas, elevators</td>
                <td>Initial + Every 1 Year (Re-test: 2 Years)</td>
              </tr>
              <tr>
                <td><strong>Power &amp; Production Plant (PTP)</strong></td>
                <td>Permenaker 38/2016</td>
                <td>Diesel gensets, turbines, rolling mills, furnaces, stamping presses</td>
                <td>Initial + Every 1 Year</td>
              </tr>
              <tr>
                <td><strong>Steam &amp; Pressure Vessels (PUBT)</strong></td>
                <td>Permenaker 37/2016</td>
                <td>Steam boilers, air compressor receivers, autoclaves, LPG storage tanks</td>
                <td>Initial + Every 1 to 2 Years</td>
              </tr>
              <tr>
                <td><strong>Electrical &amp; Lightning</strong></td>
                <td>Permenaker 12/2015 &amp; 02/1989</td>
                <td>Lightning arrestors, power transformers, main distribution switchboards</td>
                <td>Initial + Every 1 to 2 Years</td>
              </tr>
              <tr>
                <td><strong>Fire Protection Systems</strong></td>
                <td>Kepmenaker 186/1999</td>
                <td>Fire hydrant piping, sprinkler networks, smoke detection, foam systems</td>
                <td>Initial + Every 1 Year</td>
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
