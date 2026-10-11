<?php
/**
 * en/chemical-safety-officer-requirements.php
 * Chemical Safety Officer (K3 Kimia) Requirements under Kepmenaker 187/1999
 */
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/en-nav.php';

$page_title = 'Chemical Safety in Indonesia (K3 Kimia): Officer & Expert Mandates — Wahana Totalita';
$meta_desc = 'Comprehensive guide to chemical safety compliance in Indonesia under Kepmenaker No. 187/MEN/1999. Major hazard thresholds, Petugas K3 Kimia, Ahli K3 Kimia, and Disnaker hazardous substance approvals.';
$canonical = SITE_URL . '/en/chemical-safety-officer-requirements/';
$current_slug = 'chemical-safety-officer-requirements';
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
<link rel="alternate" hreflang="id" href="https://wahanatotalita.com/k3-kimia.php" />
<link rel="alternate" hreflang="zh-Hans" href="https://wahanatotalita.com/zh/k3-kimia/" />
<meta name="robots" content="index, follow">
<meta name="keywords" content="chemical safety Indonesia, K3 Kimia, Kepmenaker 187 1999, Ahli K3 Kimia, Petugas K3 Kimia, hazardous chemicals management Indonesia, MSDS LDKB Indonesia">
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
        { "@type": "ListItem", "position": 3, "name": "Chemical Safety (K3 Kimia)", "item": "<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>" }
      ]
    },
    {
      "@type": "Article",
      "@id": "<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>#article",
      "headline": "Chemical Safety in Indonesia (K3 Kimia): Regulatory Overview",
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

<?php render_en_header($current_slug, 'Chemical Safety Requirements'); ?>

<section class="en-hero">
  <div class="en-container">
    <div class="en-breadcrumb">
      <a href="/">Home</a> &rsaquo; <a href="/en/">English OHS Hub</a> &rsaquo; <span>Chemical Safety (K3 Kimia)</span>
    </div>
    <div class="en-hero-pill">
      <span>Hazardous Substances · Kepmenaker No. 187/MEN/1999</span>
    </div>
    <h1>Chemical Safety (K3 Kimia) in Indonesia: Officer Ratios &amp; Hazard Potentials</h1>
    <p class="en-hero-lead">
      Statutory compliance for manufacturing plants, smelters, chemical storage terminals, and processing facilities: understanding Threshold Quantity (NKT) classifications and mandatory Kemnaker chemical officer staffing.
    </p>

    <div class="en-trust-bar">
      <div class="en-trust-item">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <div>
          <strong>Kepmenaker 187/1999</strong>
          <span>Statutory hazardous chemical law</span>
        </div>
      </div>
      <div class="en-trust-item">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <div>
          <strong>Major vs Medium Hazard</strong>
          <span>NKT Threshold Quantities</span>
        </div>
      </div>
      <div class="en-trust-item">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <div>
          <strong>Petugas &amp; Ahli K3 Kimia</strong>
          <span>Mandatory certified personnel quotas</span>
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
        <h2 class="en-sec-title">Hazard Potential Categorization in Indonesia</h2>
        <p class="en-text">
          Under <strong>Minister of Manpower Decree No. Kep. 187/MEN/1999</strong>, all enterprises handling, manufacturing, storing, or transporting hazardous chemicals must submit a chemical inventory declaration to the local labor office (<em>Disnaker</em>). The facility is officially categorized based on <strong>Threshold Quantities (Nilai Ambang Kuantitas - NKT)</strong>:
        </p>

        <div class="en-law-grid">
          <div class="en-law-card">
            <strong>Major Hazard Potential (Potensi Bahaya Besar)</strong>
            <p>Chemical storage volumes exceed statutory NKT levels (e.g., >10 tons of toxic gases, >50 tons of highly flammable liquids). Mandates at least <strong>1 certified Ahli K3 Kimia</strong> and <strong>2 certified Petugas K3 Kimia per shift</strong>.</p>
          </div>
          <div class="en-law-card">
            <strong>Medium Hazard Potential (Potensi Bahaya Menengah)</strong>
            <p>Chemical volumes below NKT levels but presenting workplace risks. Mandates at least <strong>1 certified Petugas K3 Kimia per non-shift operation</strong>.</p>
          </div>
        </div>
      </section>

      <section class="en-card">
        <span class="en-sec-badge">Technical Mandates</span>
        <h2 class="en-sec-title">Required Documentation for Disnaker Audits</h2>
        <ul style="padding-left: 20px; line-height: 1.8; color: #374151;">
          <li><strong>Indonesian Material Safety Data Sheets (LDKB / MSDS):</strong> Every chemical container must feature an MSDS translated into Bahasa Indonesia.</li>
          <li><strong>Chemical Hazard Identification &amp; Risk Assessment (HIRADC / IBPR):</strong> Documented chemical exposure controls and toxic gas leak emergency procedures.</li>
          <li><strong>Statutory Waste &amp; Storage Licensing:</strong> Storage bunding compliance, safety shower inspections, and specialized PPE.</li>
        </ul>
      </section>
    </main>

    <?php render_en_sidebar($current_slug); ?>
  </div>
</div>

<?php render_en_footer(); ?>
</body>
</html>
