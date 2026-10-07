<?php
/**
 * en/p2k3-safety-committee-requirements.php
 * Legal Requirements for Establishing P2K3 Safety Committees in Indonesia
 */
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/en-nav.php';

$page_title = 'P2K3 Safety Committee Indonesia: Legal Mandate & Formation Guide — Wahana Totalita';
$meta_desc = 'Comprehensive guide to establishing a statutory P2K3 Committee (Panitia Pembina K3) in Indonesia under Permenaker No. 04/MEN/1987. Structure, Ahli K3 Umum secretary role, and quarterly reporting.';
$canonical = SITE_URL . '/en/p2k3-safety-committee-requirements/';
$current_slug = 'p2k3-safety-committee-requirements';
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
<link rel="alternate" hreflang="id" href="https://wahanatotalita.com/regulasi/" />
<link rel="alternate" hreflang="zh-Hans" href="https://wahanatotalita.com/zh/ahli-k3-umum/" />
<meta name="robots" content="index, follow">
<meta name="keywords" content="P2K3 committee Indonesia, Panitia Pembina K3, Permenaker 04 1987, P2K3 quarterly report, safety committee formation Indonesia, Ahli K3 Umum secretary">
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
        { "@type": "ListItem", "position": 3, "name": "P2K3 Safety Committee Requirements", "item": "<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>" }
      ]
    },
    {
      "@type": "Article",
      "@id": "<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>#article",
      "headline": "P2K3 Safety Committee Indonesia: Legal Mandate & Formation Guide",
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

<?php render_en_header($current_slug, 'P2K3 Committee Requirements'); ?>

<section class="en-hero">
  <div class="en-container">
    <div class="en-breadcrumb">
      <a href="/">Home</a> &rsaquo; <a href="/en/">English OHS Hub</a> &rsaquo; <span>P2K3 Committee Requirements</span>
    </div>
    <div class="en-hero-pill">
      <span>Corporate Governance · Permenaker No. 04/MEN/1987</span>
    </div>
    <h1>Establishing a P2K3 Safety Committee in Indonesia: A Foreign Employer's Guide</h1>
    <p class="en-hero-lead">
      Statutory requirements for structuring, registering, and administering the mandatory Occupational Health &amp; Safety Committee (Panitia Pembina Keselamatan dan Kesehatan Kerja - P2K3) with the Indonesian Ministry of Manpower.
    </p>

    <div class="en-trust-bar">
      <div class="en-trust-item">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <div>
          <strong>Permenaker 04/1987</strong>
          <span>Statutory legal basis</span>
        </div>
      </div>
      <div class="en-trust-item">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <div>
          <strong>Mandatory Secretary</strong>
          <span>Must be certified Ahli K3 Umum</span>
        </div>
      </div>
      <div class="en-trust-item">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <div>
          <strong>Quarterly Filings</strong>
          <span>Official reporting to Disnaker</span>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="en-container">
  <div class="en-body-grid">
    <main>
      <section class="en-card">
        <span class="en-sec-badge">Statutory Obligation</span>
        <h2 class="en-sec-title">What is P2K3 and Who Must Establish It?</h2>
        <p class="en-text">
          Under <strong>Minister of Manpower Regulation No. 04/MEN/1987</strong>, every company operating in Indonesia must establish a <strong>P2K3 (Panitia Pembina Keselamatan dan Kesehatan Kerja)</strong>—a dedicated bipartite internal committee ensuring continuous workplace health and safety compliance.
        </p>
        <p class="en-text">
          A P2K3 committee is legally mandatory if your enterprise meets either of the following statutory thresholds:
        </p>
        <ul style="padding-left: 20px; line-height: 1.8; color: #374151;">
          <li><strong>Employing 100 or more workers:</strong> Regardless of industry type.</li>
          <li><strong>Employing fewer than 100 workers, but classified as high-risk:</strong> Involving flammable or explosive chemicals, high pressure, radiation, ionizing energy, smelting, high voltage, or deep excavations.</li>
        </ul>

        <div class="en-alert-box">
          <strong>Non-Compliance Risk During Labor Audits</strong>
          <p>
            Operating a manufacturing plant, logistics hub, or construction site in Indonesia without a formally approved P2K3 decree issued by the local labor office (<em>Disnaker</em>) is an immediate trigger for administrative sanctions and blocks eligibility for government and BUMN project tenders.
          </p>
        </div>
      </section>

      <section class="en-card">
        <span class="en-sec-badge">Organizational Structure</span>
        <h2 class="en-sec-title">Statutory Composition of the P2K3 Committee</h2>
        <p class="en-text">
          Indonesian law strictly defines the internal leadership positions within the P2K3 committee:
        </p>

        <div class="en-table-wrap">
          <table class="en-table">
            <thead>
              <tr>
                <th>P2K3 Position</th>
                <th>Statutory Requirement</th>
                <th>Role &amp; Legal Responsibility</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><strong>Chairman (Ketua)</strong></td>
                <td>Top Executive / General Manager / Plant Director</td>
                <td>Must hold top executive decision-making authority over corporate operational budgets and plant safety expenditures. Can be an expatriate.</td>
              </tr>
              <tr>
                <td><strong>Secretary (Sekretaris)</strong></td>
                <td>Certified Indonesian <a href="/en/safety-officer-ak3-umum-requirements/">Ahli K3 Umum</a></td>
                <td><strong>Strictly mandatory:</strong> Must hold an active SKP (Surat Keputusan Penunjukan) and license from Kemnaker. Responsible for technical oversight and statutory reporting.</td>
              </tr>
              <tr>
                <td><strong>Members (Anggota)</strong></td>
                <td>Equal representation of management &amp; worker representatives</td>
                <td>Includes departmental supervisors, production managers, HR reps, and worker union delegates.</td>
              </tr>
            </tbody>
          </table>
        </div>
      </section>

      <section class="en-card">
        <span class="en-sec-badge">Operational Duties</span>
        <h2 class="en-sec-title">Mandatory Quarterly Reporting (Laporan Triwulan P2K3)</h2>
        <p class="en-text">
          Forming the committee is only the initial step. Article 12 of Permenaker 04/1987 legally obligates the company to submit a <strong>Quarterly P2K3 Report (Laporan Triwulan)</strong> once every three months to the local Provincial Manpower Office (<em>Disnaker</em>).
        </p>
        <p class="en-text">The quarterly submission must incorporate:</p>
        <ul style="padding-left: 20px; line-height: 1.8; color: #374151;">
          <li>Monthly safety statistics: total working hours, minor and major incident counts, Lost Time Injury Frequency Rate (LTIFR), and Severity Rate (SR).</li>
          <li>Hazard identification, risk assessment, and operational control (HIRADC / IBPR) audits.</li>
          <li>Certificates of routine medical check-ups (MCU) conducted on factory floor workers.</li>
          <li>Renewal tracking for equipment inspection certificates (<a href="/en/statutory-equipment-inspection-sia/">SIA</a>) and operator permits (<a href="/en/heavy-equipment-operator-license-sio/">SIO</a>).</li>
        </ul>
      </section>

      <section class="en-card">
        <span class="en-sec-badge">Registration Process</span>
        <h2 class="en-sec-title">Step-by-Step Approval Roadmap</h2>
        <div class="en-law-grid">
          <div class="en-law-card">
            <strong>Step 1: AK3U Certification</strong>
            <p>Ensure your company has at least one permanent Indonesian employee fully certified as an Ahli K3 Umum by the Ministry of Manpower.</p>
          </div>
          <div class="en-law-card">
            <strong>Step 2: Internal Structure Decree</strong>
            <p>Issue an internal Board of Directors Decree establishing the P2K3 committee roster signed by the President Director.</p>
          </div>
          <div class="en-law-card">
            <strong>Step 3: Disnaker Legalization</strong>
            <p>Submit the committee dossier, employee list, and AK3U credentials to the local Disnaker office to receive the official Government P2K3 Legalization Decree (SK Pengesahan).</p>
          </div>
          <div class="en-law-card">
            <strong>Step 4: Routine Reporting</strong>
            <p>Administer monthly committee meetings and file statutory reports every quarter without interruption.</p>
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
