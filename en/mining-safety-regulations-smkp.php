<?php
/**
 * en/mining-safety-regulations-smkp.php
 * Mining Safety Regulations in Indonesia: SMKP Minerba & POP/POM/POU
 */
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/en-nav.php';

$page_title = 'Mining Safety in Indonesia: SMKP Minerba & POP/POM Certification — Wahana Totalita';
$meta_desc = 'Comprehensive guide to Indonesian mining safety compliance under Kepmen ESDM No. 1827 K/30/MEM/2018. SMKP Minerba audit criteria, KTT mandates, and POP, POM, POU operational supervisor certifications.';
$canonical = SITE_URL . '/en/mining-safety-regulations-smkp/';
$current_slug = 'mining-safety-regulations-smkp';
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
<link rel="alternate" hreflang="id" href="https://wahanatotalita.com/k3-pertambangan.php" />
<link rel="alternate" hreflang="zh-Hans" href="https://wahanatotalita.com/zh/k3-pertambangan/" />
<meta name="robots" content="index, follow">
<meta name="keywords" content="mining safety Indonesia, SMKP Minerba audit, Kepmen ESDM 1827 2018, POP POM POU certification, Kepala Teknik Tambang KTT, nickel coal mining safety Indonesia">
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
        { "@type": "ListItem", "position": 3, "name": "Mining Safety Regulations (SMKP)", "item": "<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>" }
      ]
    },
    {
      "@type": "Article",
      "@id": "<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>#article",
      "headline": "Mining Safety in Indonesia: SMKP Minerba & Operational Supervision Guide",
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

<?php render_en_header($current_slug, 'Mining Safety (SMKP)'); ?>

<section class="en-hero">
  <div class="en-container">
    <div class="en-breadcrumb">
      <a href="/">Home</a> &rsaquo; <a href="/en/">English OHS Hub</a> &rsaquo; <span>Mining Safety (SMKP)</span>
    </div>
    <div class="en-hero-pill">
      <span>Mining Sector · Kepmen ESDM No. 1827 K/30/MEM/2018</span>
    </div>
    <h1>Mining Safety (SMKP) in Indonesia: Legal Framework &amp; Competency Standards</h1>
    <p class="en-hero-lead">
      Statutory compliance for foreign mining concession holders, nickel smelters, and mining service contractors (IUJP): understanding SMKP Minerba audits, KTT appointment, and POP/POM/POU certifications.
    </p>

    <div class="en-trust-bar">
      <div class="en-trust-item">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <div>
          <strong>Kepmen 1827/2018</strong>
          <span>ESDM mining safety guideline</span>
        </div>
      </div>
      <div class="en-trust-item">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <div>
          <strong>SMKP Minerba</strong>
          <span>Seven-element mining safety system</span>
        </div>
      </div>
      <div class="en-trust-item">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <div>
          <strong>POP / POM / POU</strong>
          <span>Statutory frontline mining supervisors</span>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="en-container">
  <div class="en-body-grid">
    <main>
      <section class="en-card">
        <span class="en-sec-badge">ESDM Regulatory Domain</span>
        <h2 class="en-sec-title">Dual Jurisdiction: Kemnaker vs Ditjen Minerba</h2>
        <p class="en-text">
          Mining operations in Indonesia are unique: while general labor law is policed by the Ministry of Manpower (Kemnaker), mining technical safety is strictly regulated by the <strong>Ministry of Energy and Mineral Resources (Kementerian ESDM - Ditjen Minerba)</strong> under <strong>Decree No. 1827 K/30/MEM/2018</strong>.
        </p>
        <p class="en-text">
          Every mining company (IUP holder) and mining contractor (IUJP holder) must establish a specialized safety management system known as <strong>SMKP Minerba (Sistem Manajemen Keselamatan Pertambangan)</strong>.
        </p>

        <div class="en-law-grid">
          <div class="en-law-card">
            <strong>Head of Mining Engineering (KTT)</strong>
            <p>Every concession must appoint an approved <strong>Kepala Teknik Tambang (KTT)</strong> endorsed by the Chief Mine Inspector (KaIT) who holds supreme operational liability over the mine.</p>
          </div>
          <div class="en-law-card">
            <strong>POP — Operational Supervisor</strong>
            <p><strong>Pengawas Operasional Pertama (POP)</strong>: Frontline pit supervisors, pit foremen, and shift leaders must pass government competency assessment.</p>
          </div>
          <div class="en-law-card">
            <strong>POM — Middle Supervisor</strong>
            <p><strong>Pengawas Operasional Madya (POM)</strong>: Department superintendents and pit captains responsible for safety compliance across mining contractors.</p>
          </div>
          <div class="en-law-card">
            <strong>POU — Senior Executive</strong>
            <p><strong>Pengawas Operasional Utama (POU)</strong>: Mining General Managers and Operations Directors responsible for strategic safety governance.</p>
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
