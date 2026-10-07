<?php
/**
 * en/industrial-hygiene-officer-guide.php
 * Industrial Hygiene & Work Environment Standards under Permenaker 05/2018
 */
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/en-nav.php';

$page_title = 'Industrial Hygiene in Indonesia: Permenaker 05/2018 Standards — Wahana Totalita';
$meta_desc = 'Comprehensive guide to industrial hygiene and work environment compliance in Indonesia under Permenaker No. 05/2018. Threshold limit values (NAB), noise, ergonomics, and certified hygiene officers.';
$canonical = SITE_URL . '/en/industrial-hygiene-officer-guide/';
$current_slug = 'industrial-hygiene-officer-guide';
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
<link rel="alternate" hreflang="id" href="https://wahanatotalita.com/higiene-industri.php" />
<link rel="alternate" hreflang="zh-Hans" href="https://wahanatotalita.com/zh/" />
<meta name="robots" content="index, follow">
<meta name="keywords" content="industrial hygiene Indonesia, Permenaker 05 2018, Higiene Industri Kemnaker, Nilai Ambang Batas NAB Indonesia, HIMU HIMA HIU, noise lighting ergonomics testing">
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
        { "@type": "ListItem", "position": 3, "name": "Industrial Hygiene Guide", "item": "<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>" }
      ]
    },
    {
      "@type": "Article",
      "@id": "<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>#article",
      "headline": "Industrial Hygiene in Indonesia: Permenaker No. 05/2018 Standards",
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

<?php render_en_header($current_slug, 'Industrial Hygiene Standards'); ?>

<section class="en-hero">
  <div class="en-container">
    <div class="en-breadcrumb">
      <a href="/">Home</a> &rsaquo; <a href="/en/">English OHS Hub</a> &rsaquo; <span>Industrial Hygiene Guide</span>
    </div>
    <div class="en-hero-pill">
      <span>Work Environment · Permenaker No. 05/2018</span>
    </div>
    <h1>Industrial Hygiene (K3 Lingkungan Kerja) in Indonesia: Permenaker 05/2018 Mandates</h1>
    <p class="en-hero-lead">
      Statutory environmental measurement standards for manufacturing facilities, smelters, and assembly plants: physical exposure limits, ergonomics, chemical thresholds (NAB), and certified industrial hygienist quotas.
    </p>

    <div class="en-trust-bar">
      <div class="en-trust-item">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <div>
          <strong>Permenaker 05/2018</strong>
          <span>Work environment statute</span>
        </div>
      </div>
      <div class="en-trust-item">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <div>
          <strong>NAB Thresholds</strong>
          <span>Noise, heat stress &amp; chemical limits</span>
        </div>
      </div>
      <div class="en-trust-item">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <div>
          <strong>Higiene Industri Experts</strong>
          <span>HIMU, HIMA, HIU certifications</span>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="en-container">
  <div class="en-body-grid">
    <main>
      <section class="en-card">
        <span class="en-sec-badge">Statutory Exposure Limits</span>
        <h2 class="en-sec-title">The Five Workplace Factors Governed by Law</h2>
        <p class="en-text">
          Under <strong>Permenaker No. 05 of 2018</strong>, employers are legally required to maintain working conditions within strictly specified <strong>Threshold Limit Values (Nilai Ambang Batas - NAB)</strong> across five distinct operational domains:
        </p>

        <div class="en-law-grid">
          <div class="en-law-card">
            <strong>1. Physical Factors</strong>
            <p>Maximum allowable workplace noise of <strong>85 dBA for an 8-hour workday</strong>, heat stress (ISBB / WBGT), whole-body and hand-arm vibration, and statutory lux illumination standards.</p>
          </div>
          <div class="en-law-card">
            <strong>2. Chemical Factors</strong>
            <p>Airborne respirable dust, toxic solvent vapors, heavy metal particulates, and acid mist concentrations.</p>
          </div>
          <div class="en-law-card">
            <strong>3. Biological Factors</strong>
            <p>Workplace sanitation, air microbial flora testing, legionella testing in HVAC cooling towers, and food hygiene standards.</p>
          </div>
          <div class="en-law-card">
            <strong>4. Ergonomic Factors</strong>
            <p>Manual handling limits (REBA / RULA assessments), repetitive strain evaluation, and workstation biomechanics.</p>
          </div>
        </div>
      </section>

      <section class="en-card">
        <span class="en-sec-badge">Testing &amp; Reporting</span>
        <h2 class="en-sec-title">Statutory Environmental Measurement Requirements</h2>
        <p class="en-text">
          Every operating factory must engage an accredited testing laboratory or licensed PJK3 body to perform official measurements at least <strong>once every 12 months</strong>. The resulting Work Environment Testing Report (<em>Laporan Pengujian Lingkungan Kerja</em>) must be submitted to the local labor inspectorate and integrated into the <a href="/en/p2k3-safety-committee-requirements/">P2K3 quarterly filing</a>.
        </p>
      </section>
    </main>

    <?php render_en_sidebar($current_slug); ?>
  </div>
</div>

<?php render_en_footer(); ?>
</body>
</html>
