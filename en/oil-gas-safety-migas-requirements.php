<?php
/**
 * en/oil-gas-safety-migas-requirements.php
 * Oil & Gas Safety (K3 Migas) Regulations in Indonesia
 */
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/en-nav.php';

$page_title = 'Oil & Gas Safety in Indonesia (K3 Migas): Ditjen Migas & SKT Guide — Wahana Totalita';
$meta_desc = 'Comprehensive guide to upstream and downstream oil & gas safety regulations in Indonesia. Ditjen Migas technical directives, SKT Migas vendor certification, and certified Migas personnel competencies.';
$canonical = SITE_URL . '/en/oil-gas-safety-migas-requirements/';
$current_slug = 'oil-gas-safety-migas-requirements';
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
<link rel="alternate" hreflang="id" href="https://wahanatotalita.com/k3-migas.php" />
<link rel="alternate" hreflang="zh-Hans" href="https://wahanatotalita.com/zh/" />
<meta name="robots" content="index, follow">
<meta name="keywords" content="oil gas safety Indonesia, K3 Migas, Ditjen Migas certification, SKT Migas vendor pre-qualification, Pengawas K3 Migas, safety officer oil gas Indonesia">
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
        { "@type": "ListItem", "position": 3, "name": "Oil & Gas Safety (K3 Migas)", "item": "<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>" }
      ]
    },
    {
      "@type": "Article",
      "@id": "<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>#article",
      "headline": "Oil & Gas Safety in Indonesia: Ditjen Migas & Contractor Safety Guide",
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

<?php render_en_header($current_slug, 'Oil & Gas Safety (Migas)'); ?>

<section class="en-hero">
  <div class="en-container">
    <div class="en-breadcrumb">
      <a href="/">Home</a> &rsaquo; <a href="/en/">English OHS Hub</a> &rsaquo; <span>Oil &amp; Gas Safety (Migas)</span>
    </div>
    <div class="en-hero-pill">
      <span>Hydrocarbon Sector · Ditjen Migas Framework</span>
    </div>
    <h1>Oil &amp; Gas Safety (K3 Migas) in Indonesia: Regulatory Directives &amp; Contractor Approvals</h1>
    <p class="en-hero-lead">
      Statutory compliance for offshore platforms, onshore drilling, LNG terminals, and refineries: Ditjen Migas technical approvals, SKT Migas contractor qualification, and certified oil &amp; gas safety personnel.
    </p>

    <div class="en-trust-bar">
      <div class="en-trust-item">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <div>
          <strong>Ditjen Migas</strong>
          <span>Directorate General of Oil &amp; Gas</span>
        </div>
      </div>
      <div class="en-trust-item">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <div>
          <strong>SKT Migas</strong>
          <span>Mandatory vendor registration</span>
        </div>
      </div>
      <div class="en-trust-item">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <div>
          <strong>Operator K3 Migas</strong>
          <span>BNSP / Migas certified competencies</span>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="en-container">
  <div class="en-body-grid">
    <main>
      <section class="en-card">
        <span class="en-sec-badge">Hydrocarbon Regulatory Framework</span>
        <h2 class="en-sec-title">Navigating Ditjen Migas Safety Oversight</h2>
        <p class="en-text">
          Operations within the upstream exploration (KKKS operators) and downstream refining, storage, and distribution of hydrocarbons in Indonesia fall under the strict oversight of the <strong>Directorate General of Oil and Gas (Ditjen Migas)</strong> and <strong>SKK Migas</strong>.
        </p>
        <p class="en-text">
          Foreign service providers, equipment vendors, and EPC contractors must fulfill three fundamental requirements before performing work on any oil &amp; gas concession:
        </p>
        <ul style="padding-left: 20px; line-height: 1.8; color: #374151;">
          <li><strong>SKT Migas (Surat Kemampuan Usaha Penunjang):</strong> Formal proof of technical, financial, and HSE capability approved by Ditjen Migas.</li>
          <li><strong>CSMS Pre-Qualification:</strong> Achieving an approved score (usually >80%) under the operator's <a href="/en/csms-contractor-safety-management-system/">Contractor Safety Management System</a>.</li>
          <li><strong>Certified Personnel:</strong> Manning the project with personnel certified as <em>Operator K3 Migas</em>, <em>Pengawas K3 Migas</em>, or <em>Auditor SMK3</em>.</li>
        </ul>
      </section>
    </main>

    <?php render_en_sidebar($current_slug); ?>
  </div>
</div>

<?php render_en_footer(); ?>
</body>
</html>
