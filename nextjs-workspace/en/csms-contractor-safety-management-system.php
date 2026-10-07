<?php
/**
 * en/csms-contractor-safety-management-system.php
 * CSMS Pre-Qualification Guide for Indonesia Oil & Gas and Industrial EPC
 */
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/en-nav.php';

$page_title = 'CSMS Indonesia: Contractor Safety Management System Pre-Qualification — Wahana Totalita';
$meta_desc = 'How foreign EPC contractors pass Contractor Safety Management System (CSMS) pre-qualification in Indonesia for Pertamina, PLN, MIND ID, and major multinational tenders.';
$canonical = SITE_URL . '/en/csms-contractor-safety-management-system/';
$current_slug = 'csms-contractor-safety-management-system';
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
<link rel="alternate" hreflang="id" href="https://wahanatotalita.com/csms.php" />
<link rel="alternate" hreflang="zh-Hans" href="https://wahanatotalita.com/zh/" />
<meta name="robots" content="index, follow">
<meta name="keywords" content="CSMS Indonesia, Contractor Safety Management System, Pertamina CSMS pre-qualification, CSMS scoring EPC Indonesia, HSE prequalification oil gas Indonesia">
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
        { "@type": "ListItem", "position": 3, "name": "CSMS Pre-Qualification Guide", "item": "<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>" }
      ]
    },
    {
      "@type": "Article",
      "@id": "<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>#article",
      "headline": "CSMS Indonesia: Contractor Safety Management System Pre-Qualification",
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

<?php render_en_header($current_slug, 'CSMS Pre-Qualification'); ?>

<section class="en-hero">
  <div class="en-container">
    <div class="en-breadcrumb">
      <a href="/">Home</a> &rsaquo; <a href="/en/">English OHS Hub</a> &rsaquo; <span>CSMS Pre-Qualification</span>
    </div>
    <div class="en-hero-pill">
      <span>Contractor Safety · Tender Gatekeeper</span>
    </div>
    <h1>Contractor Safety Management System (CSMS) in Indonesia: Passing Pre-Qualification</h1>
    <p class="en-hero-lead">
      How foreign contractors, equipment suppliers, and engineering firms score above 85% on CSMS evaluations for Pertamina, PLN, Vale, Freeport, and major infrastructure tenders.
    </p>

    <div class="en-trust-bar">
      <div class="en-trust-item">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <div>
          <strong>Tender Gatekeeper</strong>
          <span>Mandatory score to bid on projects</span>
        </div>
      </div>
      <div class="en-trust-item">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <div>
          <strong>Six CSMS Phases</strong>
          <span>Assessment through close-out</span>
        </div>
      </div>
      <div class="en-trust-item">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <div>
          <strong>Evidence Verification</strong>
          <span>Audited documentation defense</span>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="en-container">
  <div class="en-body-grid">
    <main>
      <section class="en-card">
        <span class="en-sec-badge">Tender Pre-Condition</span>
        <h2 class="en-sec-title">What is CSMS in the Indonesian Context?</h2>
        <p class="en-text">
          In Indonesia, the <strong>Contractor Safety Management System (CSMS)</strong> is a standardized qualification mechanism utilized by energy operators (Pertamina, Medco, BP Tangguh), mining conglomerates (Freeport, Vale, Bukit Asam), and state utilities (PLN) to systematically vet contractor HSE capability before awarding contracts.
        </p>
        <p class="en-text">
          If your company does not achieve the required threshold score (typically <strong>70% for medium risk</strong> and <strong>80-85% for high-risk projects</strong>) during the initial CSMS Pre-Qualification phase, your technical and commercial bid packets are disqualified automatically.
        </p>
      </section>

      <section class="en-card">
        <span class="en-sec-badge">Evaluation Elements</span>
        <h2 class="en-sec-title">The Core Pillars of Indonesian CSMS Audits</h2>
        <div class="en-law-grid">
          <div class="en-law-card">
            <strong>1. Leadership &amp; Commitment</strong>
            <p>Signed HSE policy by the Board of Directors, executive field safety walkthrough logs, and allocated safety budgets.</p>
          </div>
          <div class="en-law-card">
            <strong>2. Risk Management (HIRADC)</strong>
            <p>Job Safety Analysis (JSA) registers, Hazard Identification Risk Assessment (IBPR), and Standard Operating Procedures (SOP).</p>
          </div>
          <div class="en-law-card">
            <strong>3. Statutory Competency</strong>
            <p>Documented records of certified Indonesian <a href="/en/safety-officer-ak3-umum-requirements/">Ahli K3 Umum</a>, certified <a href="/en/heavy-equipment-operator-license-sio/">SIO equipment operators</a>, and medical check-ups.</p>
          </div>
          <div class="en-law-card">
            <strong>4. Equipment Inspection</strong>
            <p>Valid statutory testing certificates (<a href="/en/statutory-equipment-inspection-sia/">SIA</a>) for all heavy equipment, cranes, welding sets, and scaffolding to be mobilized.</p>
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
