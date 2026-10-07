<?php
/**
 * en/factory-setup-safety-checklist.php
 * New Factory & FDI Manufacturing HSE Setup Checklist for Indonesia
 */
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/en-nav.php';

$page_title = 'New Factory HSE Setup Checklist Indonesia: FDI Safety Compliance Guide — Wahana Totalita';
$meta_desc = 'End-to-end HSE onboarding checklist for foreign direct investment (FDI / PMA) companies establishing a factory or industrial facility in Indonesia. Pre-construction permits to operational commissioning.';
$canonical = SITE_URL . '/en/factory-setup-safety-checklist/';
$current_slug = 'factory-setup-safety-checklist';
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
<link rel="alternate" hreflang="id" href="https://wahanatotalita.com/" />
<link rel="alternate" hreflang="zh-Hans" href="https://wahanatotalita.com/zh/factory-roadmap/" />
<meta name="robots" content="index, follow">
<meta name="keywords" content="factory setup safety Indonesia, FDI safety compliance Indonesia, new plant commissioning HSE Indonesia, PMA factory safety permits, setting up factory in Indonesia K3">
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
        { "@type": "ListItem", "position": 3, "name": "New Factory HSE Checklist", "item": "<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>" }
      ]
    },
    {
      "@type": "Article",
      "@id": "<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>#article",
      "headline": "New Factory HSE Setup Checklist in Indonesia: Complete FDI Roadmap",
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

<?php render_en_header($current_slug, 'New Factory HSE Checklist'); ?>

<section class="en-hero">
  <div class="en-container">
    <div class="en-breadcrumb">
      <a href="/">Home</a> &rsaquo; <a href="/en/">English OHS Hub</a> &rsaquo; <span>New Factory HSE Checklist</span>
    </div>
    <div class="en-hero-pill">
      <span>Foreign Direct Investment · Practical Operational Roadmap</span>
    </div>
    <h1>New Factory HSE Setup Checklist in Indonesia: From Groundbreaking to Full Production</h1>
    <p class="en-hero-lead">
      A step-by-step statutory compliance roadmap for foreign investors (PMA), factory builders, and plant managers establishing a new manufacturing or assembly plant in Indonesia.
    </p>

    <div class="en-trust-bar">
      <div class="en-trust-item">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <div>
          <strong>Groundbreaking to COD</strong>
          <span>End-to-end statutory roadmap</span>
        </div>
      </div>
      <div class="en-trust-item">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <div>
          <strong>Disnaker Integration</strong>
          <span>Provincial labor approvals</span>
        </div>
      </div>
      <div class="en-trust-item">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <div>
          <strong>Zero Delay Guarantee</strong>
          <span>Audit-proof commissioning</span>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="en-container">
  <div class="en-body-grid">
    <main>
      <section class="en-card">
        <span class="en-sec-badge">Operational Checklist</span>
        <h2 class="en-sec-title">Phase-by-Phase Statutory HSE Implementation Plan</h2>

        <div class="en-law-grid">
          <div class="en-law-card">
            <strong>Phase 1: Civil Construction &amp; Groundbreaking</strong>
            <p>
              &bull; Secure <a href="/en/construction-safety-system-smkk/">SMKK approval</a> for main civil contractors.<br>
              &bull; Implement mandatory fall protection (<a href="/en/working-at-height-regulations/">TKBT/TKPK</a>).<br>
              &bull; Verify <a href="/en/heavy-equipment-operator-license-sio/">SIO operator permits</a> for excavators and piling rigs.
            </p>
          </div>

          <div class="en-law-card">
            <strong>Phase 2: Machinery Installation &amp; Commissioning</strong>
            <p>
              &bull; Third-party statutory testing (<a href="/en/statutory-equipment-inspection-sia/">Riksa Uji / SIA</a>) for all cranes, gensets, and air compressors.<br>
              &bull; Hydrostatic and PSV pop tests for <a href="/en/boiler-pressure-vessel-certification/">steam boilers and receivers</a>.<br>
              &bull; Certified welder verification (<a href="/en/certified-welder-regulations-indonesia/">Juru Las Kelas 1/2</a>) for high-pressure piping.
            </p>
          </div>

          <div class="en-law-card">
            <strong>Phase 3: Statutory Organization &amp; Staffing</strong>
            <p>
              &bull; Appoint and register a certified Indonesian <a href="/en/safety-officer-ak3-umum-requirements/">Ahli K3 Umum</a>.<br>
              &bull; Form and submit the bipartite <a href="/en/p2k3-safety-committee-requirements/">P2K3 Committee</a> to Disnaker.<br>
              &bull; Designate and train <a href="/en/workplace-fire-safety-classification/">Fire Wardens (Class D/C)</a>.
            </p>
          </div>

          <div class="en-law-card">
            <strong>Phase 4: Commercial Operation Date (COD) &amp; Audits</strong>
            <p>
              &bull; Establish continuous <a href="/en/workplace-accident-reporting-procedure/">incident reporting protocols</a>.<br>
              &bull; Conduct annual <a href="/en/industrial-hygiene-officer-guide/">industrial hygiene measurements</a>.<br>
              &bull; Undergo official <a href="/en/smk3-certification-guide/">SMK3 national audits</a> for Gold Flag certification.
            </p>
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
