<?php
/**
 * en/workplace-fire-safety-classification.php
 * Workplace Fire Safety in Indonesia under Kepmenaker 186/1999
 */
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/en-nav.php';

$page_title = 'Workplace Fire Safety in Indonesia: Class A, B, C, D Officers — Wahana Totalita';
$meta_desc = 'Comprehensive guide to fire safety compliance in Indonesia under Kepmenaker No. 186/MEN/1999. Hazard risk classifications, mandatory fire warden ratios (Class D to A), and hydrants inspection.';
$canonical = SITE_URL . '/en/workplace-fire-safety-classification/';
$current_slug = 'workplace-fire-safety-classification';
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
<link rel="alternate" hreflang="id" href="https://wahanatotalita.com/penanggulangan-kebakaran.php" />
<link rel="alternate" hreflang="zh-Hans" href="https://wahanatotalita.com/zh/k3-kebakaran/" />
<meta name="robots" content="index, follow">
<meta name="keywords" content="fire safety Indonesia, Kepmenaker 186 1999, K3 Kebakaran Kelas A B C D, fire warden Indonesia, Petugas Peran Kebakaran, Ahli K3 Kebakaran, hydrant inspection Disnaker">
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
        { "@type": "ListItem", "position": 3, "name": "Workplace Fire Safety Classification", "item": "<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>" }
      ]
    },
    {
      "@type": "Article",
      "@id": "<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>#article",
      "headline": "Workplace Fire Safety Classification in Indonesia: Kepmenaker 186/1999 Guide",
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

<?php render_en_header($current_slug, 'Fire Safety Classification'); ?>

<section class="en-hero">
  <div class="en-container">
    <div class="en-breadcrumb">
      <a href="/">Home</a> &rsaquo; <a href="/en/">English OHS Hub</a> &rsaquo; <span>Fire Safety Classification</span>
    </div>
    <div class="en-hero-pill">
      <span>Emergency Response · Kepmenaker No. 186/MEN/1999</span>
    </div>
    <h1>Workplace Fire Safety in Indonesia: Statutory Quotas for Fire Wardens &amp; Fire Experts</h1>
    <p class="en-hero-lead">
      Statutory compliance for industrial buildings, warehouses, high-rises, and smelters: understanding building fire risk levels and the mandatory 4-tier fire personnel structure (Class D, C, B, A).
    </p>

    <div class="en-trust-bar">
      <div class="en-trust-item">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <div>
          <strong>Kepmenaker 186/1999</strong>
          <span>Fire safety statutory decree</span>
        </div>
      </div>
      <div class="en-trust-item">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <div>
          <strong>4-Tier Structure</strong>
          <span>Class D, C, B, A certified tiers</span>
        </div>
      </div>
      <div class="en-trust-item">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <div>
          <strong>Annual Hydrant Testing</strong>
          <span>Mandatory statutory flow rate audit</span>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="en-container">
  <div class="en-body-grid">
    <main>
      <section class="en-card">
        <span class="en-sec-badge">Statutory Quotas</span>
        <h2 class="en-sec-title">The Four Certified Fire Protection Tiers</h2>
        <p class="en-text">
          Under <strong>Kepmenaker No. Kep. 186/MEN/1999</strong>, employers must staff an organized internal firefighting unit structured into four specialized competency classes:
        </p>

        <div class="en-table-wrap">
          <table class="en-table">
            <thead>
              <tr>
                <th>Tier</th>
                <th>Official Indonesian Title</th>
                <th>Statutory Quota Threshold</th>
                <th>Primary Operational Role</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><strong>Class D</strong></td>
                <td>Petugas Peran Kebakaran</td>
                <td>At least 2 persons per 25 workers</td>
                <td>First-line floor fire wardens, evacuation leaders, portable fire extinguisher (APAR) operation</td>
              </tr>
              <tr>
                <td><strong>Class C</strong></td>
                <td>Regu Penanggulangan Kebakaran</td>
                <td>At least 2 persons per 300 workers</td>
                <td>Designated emergency response brigade, fire hydrant hose handling, breathing apparatus (SCBA)</td>
              </tr>
              <tr>
                <td><strong>Class B</strong></td>
                <td>Koordinator Penanggulangan Kebakaran</td>
                <td>At least 1 person per 100 workers</td>
                <td>Fire brigade commander, emergency drill planner, liaison with municipal Fire Department (Damkar)</td>
              </tr>
              <tr>
                <td><strong>Class A</strong></td>
                <td>Ahli K3 Penanggulangan Kebakaran</td>
                <td>Mandatory for severe risk or >300 personnel</td>
                <td>Senior Fire Safety Expert, fire protection engineering design, suppression system approvals</td>
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
