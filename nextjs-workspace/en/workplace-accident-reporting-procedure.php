<?php
/**
 * en/workplace-accident-reporting-procedure.php
 * Statutory Workplace Accident Reporting and Investigation in Indonesia
 */
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/en-nav.php';

$page_title = 'Workplace Accident Reporting Indonesia: Legal 2x24-Hour Protocol — Wahana Totalita';
$meta_desc = 'Statutory guidelines for reporting workplace accidents in Indonesia under Permenaker No. 03/MEN/1998. 2x24-hour Disnaker notification, BPJS Ketenagakerjaan claims, and labor investigation procedures.';
$canonical = SITE_URL . '/en/workplace-accident-reporting-procedure/';
$current_slug = 'workplace-accident-reporting-procedure';
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
<link rel="alternate" hreflang="id" href="https://wahanatotalita.com/insiden/" />
<link rel="alternate" hreflang="zh-Hans" href="https://wahanatotalita.com/zh/kecelakaan-kerja/" />
<meta name="robots" content="index, follow">
<meta name="keywords" content="workplace accident reporting Indonesia, Permenaker 03 1998, 2x24 hour accident notice Disnaker, BPJS Ketenagakerjaan accident claim, fatal accident investigation Indonesia, Form KK2 KK3">
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
        { "@type": "ListItem", "position": 3, "name": "Workplace Accident Reporting", "item": "<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>" }
      ]
    },
    {
      "@type": "Article",
      "@id": "<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>#article",
      "headline": "Workplace Accident Reporting Procedure in Indonesia",
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

<?php render_en_header($current_slug, 'Accident Reporting Protocol'); ?>

<section class="en-hero">
  <div class="en-container">
    <div class="en-breadcrumb">
      <a href="/">Home</a> &rsaquo; <a href="/en/">English OHS Hub</a> &rsaquo; <span>Workplace Accident Reporting</span>
    </div>
    <div class="en-hero-pill">
      <span>Incident Management · Permenaker No. 03/MEN/1998</span>
    </div>
    <h1>Workplace Accident Reporting in Indonesia: The Statutory 2x24-Hour Protocol</h1>
    <p class="en-hero-lead">
      Essential statutory duties for foreign enterprise managers following an occupational injury or fatality: government notification deadlines, BPJS Ketenagakerjaan claims, and labor inspectorate investigation procedures.
    </p>

    <div class="en-trust-bar">
      <div class="en-trust-item">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <div>
          <strong>2x24-Hour Window</strong>
          <span>Strict statutory notification deadline</span>
        </div>
      </div>
      <div class="en-trust-item">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <div>
          <strong>Form KK2 &amp; KK3</strong>
          <span>Mandatory Ministry statutory filings</span>
        </div>
      </div>
      <div class="en-trust-item">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <div>
          <strong>BPJS Coordination</strong>
          <span>State social security claims</span>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="en-container">
  <div class="en-body-grid">
    <main>
      <section class="en-card">
        <span class="en-sec-badge">Statutory Emergency Procedure</span>
        <h2 class="en-sec-title">The Strict 2x24-Hour Legal Reporting Window</h2>
        <p class="en-text">
          Under <strong>Minister of Manpower Regulation No. 03/MEN/1998</strong>, when an industrial accident occurs at a workplace resulting in injury, permanent disability, or fatality, the employer is legally obligated to submit a written initial notification to the local Provincial Manpower Office (<em>Disnaker</em>) within <strong>not more than 2x24 hours (two business days)</strong>.
        </p>

        <div class="en-danger-box">
          <strong>Consequences of Late Reporting or Concealment</strong>
          <p>
            Concealing an industrial accident or missing the 2x24-hour statutory deadline constitutes a criminal infraction under Law No. 1/1970. In severe or fatal incidents, failure to notify Disnaker triggers immediate criminal investigation by Labor Civil Servant Investigators (PPNS) and local Police (POLRI), often leading to personal criminal indictments against the resident plant director.
          </p>
        </div>
      </section>

      <section class="en-card">
        <span class="en-sec-badge">Step-by-Step Incident Protocol</span>
        <h2 class="en-sec-title">Two-Stage Statutory Reporting Process</h2>

        <div class="en-law-grid">
          <div class="en-law-card">
            <strong>Stage 1: Form KK2 (Within 2x24 Hours)</strong>
            <p>Immediate notification report filed electronically or physically to Disnaker and BPJS Ketenagakerjaan. Details the time, identity of victims, location, basic event description, and immediate medical facility dispatched.</p>
          </div>
          <div class="en-law-card">
            <strong>Stage 2: Form KK3 (After Medical Closure)</strong>
            <p>Detailed technical follow-up report submitted after doctor diagnosis or recovery closure. Contains root cause analysis, lost work days, disability assessment, and medical expenditure reconciliation.</p>
          </div>
        </div>
      </section>

      <section class="en-card">
        <span class="en-sec-badge">Investigation Preparedness</span>
        <h2 class="en-sec-title">What Disnaker &amp; Police Investigators Will Inspect</h2>
        <p class="en-text">
          Following any significant workplace injury, Labor Inspectors and PPNS officers will arrive on site to inspect documentation. They will immediately demand verification of:
        </p>
        <ul style="padding-left: 20px; line-height: 1.8; color: #374151;">
          <li><strong>Operator Licenses (<a href="/en/heavy-equipment-operator-license-sio/">SIO</a>):</strong> Was the equipment operator properly certified by Kemnaker?</li>
          <li><strong>Equipment Inspection (<a href="/en/statutory-equipment-inspection-sia/">SIA</a>):</strong> Was the machine or lifting device inspected within the last 12 months with a valid certificate?</li>
          <li><strong>Job Safety Analysis (JSA / IBPR):</strong> Was a written hazard risk assessment prepared and communicated in Indonesian before high-risk execution began?</li>
          <li><strong>P2K3 Committee Legality:</strong> Does the company have a registered <a href="/en/p2k3-safety-committee-requirements/">P2K3 committee</a> and active <a href="/en/safety-officer-ak3-umum-requirements/">Ahli K3 Umum</a>?</li>
        </ul>
      </section>
    </main>

    <?php render_en_sidebar($current_slug); ?>
  </div>
</div>

<?php render_en_footer(); ?>
</body>
</html>
