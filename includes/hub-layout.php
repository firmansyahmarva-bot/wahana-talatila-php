<?php
/**
 * includes/hub-layout.php
 * Master Layout Template for Wahana Totalita 23 Sector Hub Pages.
 * 
 * Features:
 * - Desktop Sticky WhatsApp Lead Sidebar (Priority #1)
 * - Mobile Persistent WhatsApp Floating Bottom Bar
 * - Authority Training Program Cards (Direct links to /pelatihan/[slug]/)
 * - Sibling Hub Cross-Linking + Complete 23-Hub Industrial Directory Mesh
 * - Automatic JSON-LD Schema (BreadcrumbList, FAQPage)
 * - Zero Cheap Emojis (Pure sharp SVG icons throughout)
 */

if (!isset($hub_data)) {
    die('Hub data required.');
}

$s = get_all_settings();
$wa_number = $s['wa_number'] ?? '6281235036420';

$hub_slug   = $hub_data['slug'] ?? '';
$page_title = $hub_data['meta_title'] ?? ($hub_data['title'] . ' — Wahana Totalita');
$meta_desc  = $hub_data['meta_desc'] ?? ($hub_data['title'] . '. Pelatihan resmi sertifikasi Kemnaker RI & BNSP. Jadwal terdekat dan biaya.');
$canonical  = SITE_URL . '/' . trim($hub_slug, '/') . '/';

// Pre-fill WhatsApp message
$hero_wa_msg = 'Halo Wahana Totalita, saya ingin informasi silabus dan jadwal terdekat pelatihan ' . ($hub_data['title'] ?? 'K3');
$hero_wa_url = wa_url($hero_wa_msg, $wa_number);

// Breadcrumb Schema
$breadcrumb_schema = [
    '@context' => 'https://schema.org',
    '@type'    => 'BreadcrumbList',
    'itemListElement' => [
        ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => SITE_URL . '/'],
        ['@type' => 'ListItem', 'position' => 2, 'name' => 'Keselamatan Kerja', 'item' => SITE_URL . '/keselamatan-kerja/'],
        ['@type' => 'ListItem', 'position' => 3, 'name' => $hub_data['title'], 'item' => $canonical],
    ],
];

// FAQ Schema
$faq_schema = null;
if (!empty($hub_data['faqs'])) {
    $faq_schema = [
        '@context' => 'https://schema.org',
        '@type'    => 'FAQPage',
        'mainEntity' => array_map(fn($f) => [
            '@type' => 'Question',
            'name'  => $f['q'],
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']],
        ], $hub_data['faqs']),
    ];
}

// 23 Hub Directory Mesh Data (4 Sectors)
$HUB_DIRECTORY_MESH = [
    'Konstruksi & Kelistrikan' => [
        ['url' => '/k3-listrik/',               'name' => 'K3 Listrik (Teknisi & Ahli)'],
        ['url' => '/k3-konstruksi/',            'name' => 'K3 Konstruksi'],
        ['url' => '/k3-ketinggian/',            'name' => 'K3 Ketinggian (TKBT/TKPK)'],
        ['url' => '/k3-pesawat-angkat-angkut/', 'name' => 'K3 Pesawat Angkat Angkut'],
        ['url' => '/k3-pesawat-uap/',           'name' => 'K3 Pesawat Uap & Bejana Tekan'],
    ],
    'Pabrik & Manufaktur' => [
        ['url' => '/k3-kimia/',                 'name' => 'K3 Kimia (Petugas & Ahli)'],
        ['url' => '/higiene-industri/',         'name' => 'Higiene Industri (HIMU/HIMA)'],
        ['url' => '/penanggulangan-kebakaran/', 'name' => 'Penanggulangan Kebakaran'],
        ['url' => '/p3k/',                      'name' => 'P3K di Tempat Kerja'],
        ['url' => '/k3-manufaktur/',            'name' => 'K3 Manufaktur & Pabrik'],
        ['url' => '/juru-las/',                 'name' => 'Juru Las (Welder Kemnaker/BNSP)'],
    ],
    'Migas, Tambang & Energi' => [
        ['url' => '/k3-migas/',                 'name' => 'K3 Migas & Energi'],
        ['url' => '/k3-pertambangan/',          'name' => 'K3 Pertambangan (POP/POM)'],
        ['url' => '/operator-alat-berat/',      'name' => 'Operator Alat Berat (Forklift/Loader)'],
    ],
    'Fasilitas & Sektor Spesifik' => [
        ['url' => '/k3-rumah-sakit/',           'name' => 'K3 Rumah Sakit & Faskes'],
        ['url' => '/k3-laboratorium/',          'name' => 'K3 Laboratorium'],
        ['url' => '/k3-perkantoran/',           'name' => 'K3 Perkantoran & Gedung'],
        ['url' => '/k3-transportasi/',          'name' => 'K3 Transportasi & Logistik'],
        ['url' => '/k3-pangan/',                'name' => 'K3 Industri Pangan & HACCP'],
        ['url' => '/k3-psikososial/',           'name' => 'K3 Psikososial & Ergonomi'],
        ['url' => '/pelatihan-iso/',            'name' => 'Pelatihan ISO (45001/9001/14001)'],
        ['url' => '/smk3/',                     'name' => 'Penerapan & Audit SMK3 PP 50'],
    ],
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($page_title) ?></title>
<meta name="description" content="<?= e($meta_desc) ?>">
<link rel="canonical" href="<?= htmlspecialchars($canonical) ?>">

<!-- Open Graph -->
<meta property="og:type" content="website">
<meta property="og:title" content="<?= e($page_title) ?>">
<meta property="og:description" content="<?= e($meta_desc) ?>">
<meta property="og:url" content="<?= htmlspecialchars($canonical) ?>">
<meta property="og:site_name" content="<?= e($s['site_name'] ?? 'Wahana Totalita') ?>">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preload" href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;600;700;800&family=Source+Sans+3:wght@400;600;700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;600;700;800&family=Source+Sans+3:wght@400;600;700&display=swap">
</noscript>

<link rel="stylesheet" href="/assets/css/base.css">
<link rel="stylesheet" href="/assets/css/components.min.css">
<link rel="stylesheet" href="/assets/css/page/hub-master.css">
<?= theme_css_vars($s) ?>

<!-- Structured Data -->
<script type="application/ld+json"><?= json_encode($breadcrumb_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?></script>
<?php if ($faq_schema): ?>
<script type="application/ld+json"><?= json_encode($faq_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?></script>
<?php endif; ?>
</head>
<body>

<?php require __DIR__ . '/navbar.php'; ?>

<!-- ─── HERO ─── -->
<header class="hub-hero">
  <div class="container">
    <nav class="hub-breadcrumb" aria-label="Breadcrumb">
      <a href="/">Beranda</a>
      <span aria-hidden="true">&rsaquo;</span>
      <a href="/keselamatan-kerja/">Bidang K3</a>
      <span aria-hidden="true">&rsaquo;</span>
      <span aria-current="page"><?= e($hub_data['badge'] ?? 'Bidang Keahlian') ?></span>
    </nav>

    <div class="hub-badge-wrap">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
      <span><?= e($hub_data['badge'] ?? 'Sertifikasi Resmi') ?></span>
    </div>

    <h1><?= e($hub_data['title']) ?></h1>
    <p class="hub-hero-sub"><?= e($hub_data['intro_lead'] ?? $hub_data['meta_desc']) ?></p>

    <!-- Quick Lead Hook Box -->
    <div class="hub-hero-lead-box">
      <div class="hub-lead-text">
        <div class="hub-lead-icon">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
        </div>
        <div>
          <strong>Dapatkan Silabus Resmi &amp; Jadwal Terdekat</strong>
          <div style="font-size:12.5px;color:rgba(255,255,255,0.8);">Konsultasikan kebutuhan sertifikasi personil atau corporate training via WhatsApp</div>
        </div>
      </div>
      <a href="<?= e($hero_wa_url) ?>" class="hub-btn-lead-wa" target="_blank" rel="noopener">
        <svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
        <span>Minta Jadwal &amp; Silabus via WA</span>
      </a>
    </div>

  </div>
</header>

<!-- ─── WRAPPER (2 COLUMNS) ─── -->
<div class="hub-wrapper">
  <div class="container hub-grid-layout">

    <!-- LEFT COLUMN: MAIN CONTENT -->
    <main class="hub-main">

      <!-- SECTION: PENGENALAN -->
      <?php if (!empty($hub_data['intro'])): ?>
      <section class="hub-card-section">
        <div class="hub-sec-header">
          <span class="hub-sec-eyebrow">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
            Ruang Lingkup
          </span>
          <h2 class="hub-sec-title">Apa itu <?= e($hub_data['title']) ?>?</h2>
        </div>
        <div class="hub-prose">
          <?= is_array($hub_data['intro']) ? implode('', array_map(fn($p) => "<p>{$p}</p>", $hub_data['intro'])) : $hub_data['intro'] ?>
        </div>
      </section>
      <?php endif; ?>

      <!-- SECTION: DASAR HUKUM -->
      <?php if (!empty($hub_data['regulasi'])): ?>
      <section class="hub-card-section">
        <div class="hub-sec-header">
          <span class="hub-sec-eyebrow">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
            Kepatuhan Regulasi
          </span>
          <h2 class="hub-sec-title">Dasar Hukum &amp; Standar Regulasi</h2>
        </div>
        <div class="hub-regulasi-grid">
          <?php foreach ($hub_data['regulasi'] as $reg): ?>
          <div class="hub-regulasi-item">
            <div class="hub-regulasi-title">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
              <span><?= e($reg['nomor']) ?></span>
            </div>
            <p class="hub-regulasi-desc"><?= e($reg['desc']) ?></p>
          </div>
          <?php endforeach; ?>
        </div>
      </section>
      <?php endif; ?>

      <!-- ═══════════════════════════════════════════════════════════
           SECTION: PROGRAM PELATIHAN UTAMA (THE MONEY CARDS)
           Direct Authority Links to /pelatihan/[slug]/
           ═══════════════════════════════════════════════════════════ -->
      <?php if (!empty($hub_data['programs'])): ?>
      <section class="hub-card-section" style="border-color:#bbf7d0;background:#fafdfb;">
        <div class="hub-sec-header">
          <span class="hub-sec-eyebrow">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            Program Sertifikasi Resmi
          </span>
          <h2 class="hub-sec-title">Program Pelatihan &amp; Sertifikasi <?= e($hub_data['badge'] ?? '') ?></h2>
          <p style="font-size:14px;color:var(--hub-muted);margin:6px 0 0;">Pilih skema sertifikasi yang sesuai dengan kualifikasi dan kewenangan kerja Anda.</p>
        </div>

        <div class="hub-program-cards">
          <?php foreach ($hub_data['programs'] as $prog): 
            $prog_url = '/pelatihan/' . trim($prog['slug'], '/') . '/';
            $prog_wa_msg = $prog['wa_text'] ?? ('Halo Wahana Totalita, saya ingin informasi biaya dan jadwal terdekat pelatihan ' . $prog['name']);
            $prog_wa_url = wa_url($prog_wa_msg, $wa_number);
          ?>
          <article class="hub-prog-card">
            <div class="hub-prog-card-top">
              <div class="hub-prog-badges">
                <span class="hub-prog-badge-cert">
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                  <?= e($prog['cert']) ?>
                </span>
                <?php if (!empty($prog['mode'])): ?>
                <span class="hub-prog-badge-mode"><?= e($prog['mode']) ?></span>
                <?php endif; ?>
                <?php if (!empty($prog['duration'])): ?>
                <span class="hub-prog-badge-duration"><?= e($prog['duration']) ?></span>
                <?php endif; ?>
              </div>
            </div>

            <h3 class="hub-prog-title">
              <a href="<?= e($prog_url) ?>"><?= e($prog['name']) ?></a>
            </h3>

            <p class="hub-prog-desc"><?= e($prog['desc']) ?></p>

            <?php if (!empty($prog['target_peserta'])): ?>
            <div class="hub-prog-meta-specs">
              <div class="hub-meta-spec-item">
                <strong>Sasaran Peserta</strong>
                <span><?= e($prog['target_peserta']) ?></span>
              </div>
              <div class="hub-meta-spec-item">
                <strong>Legalitas Lisensi</strong>
                <span>Sertifikat Resmi &amp; SKP KEMNAKER / BNSP RI</span>
              </div>
            </div>
            <?php endif; ?>

            <div class="hub-prog-actions">
              <a href="<?= e($prog_url) ?>" class="hub-btn-prog-detail">
                <span>Lihat Silabus &amp; Jadwal Lengkap</span>
                <span aria-hidden="true">&rarr;</span>
              </a>
              <a href="<?= e($prog_wa_url) ?>" class="hub-btn-prog-wa" target="_blank" rel="noopener">
                <svg viewBox="0 0 24 24" fill="currentColor" width="15" height="15"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
                <span>Konsultasi WA</span>
              </a>
            </div>
          </article>
          <?php endforeach; ?>
        </div>
      </section>
      <?php endif; ?>

      <!-- SECTION: PERBANDINGAN LEVEL (JIKA ADA) -->
      <?php if (!empty($hub_data['comparison'])): ?>
      <section class="hub-card-section">
        <div class="hub-sec-header">
          <span class="hub-sec-eyebrow">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
            Panduan Kualifikasi
          </span>
          <h2 class="hub-sec-title">Perbandingan Jenjang &amp; Kewenangan</h2>
        </div>
        <div class="hub-table-wrap">
          <table class="hub-table">
            <thead>
              <tr>
                <?php foreach ($hub_data['comparison']['headers'] as $th): ?>
                <th><?= e($th) ?></th>
                <?php endforeach; ?>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($hub_data['comparison']['rows'] as $row): ?>
              <tr>
                <?php foreach ($row as $cell): ?>
                <td><?= e($cell) ?></td>
                <?php endforeach; ?>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </section>
      <?php endif; ?>

      <!-- SECTION: PERSYARATAN & KURIKULUM -->
      <?php if (!empty($hub_data['syarat']) || !empty($hub_data['materi'])): ?>
      <section class="hub-card-section">
        <?php if (!empty($hub_data['syarat'])): ?>
        <div class="hub-sec-header">
          <span class="hub-sec-eyebrow">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><polyline points="17 11 19 13 23 9"/></svg>
            Kriteria
          </span>
          <h2 class="hub-sec-title">Persyaratan Peserta Pelatihan</h2>
        </div>
        <ul class="hub-check-list" style="margin-bottom:28px;">
          <?php foreach ($hub_data['syarat'] as $s_item): ?>
          <li>
            <svg class="hub-check-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
            <span><?= e($s_item) ?></span>
          </li>
          <?php endforeach; ?>
        </ul>
        <?php endif; ?>

        <?php if (!empty($hub_data['materi'])): ?>
        <div class="hub-sec-header">
          <span class="hub-sec-eyebrow">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
            Kurikulum
          </span>
          <h2 class="hub-sec-title">Materi &amp; Silabus Pelatihan</h2>
        </div>
        <ol class="hub-num-list">
          <?php foreach ($hub_data['materi'] as $m_item): ?>
          <li>
            <span class="hub-num-badge">✓</span>
            <span><?= e($m_item) ?></span>
          </li>
          <?php endforeach; ?>
        </ol>
        <?php endif; ?>
      </section>
      <?php endif; ?>

      <!-- B2B / IN-HOUSE CORPORATE BANNER -->
      <div class="hub-b2b-box">
        <div class="hub-b2b-content">
          <h3>Butuh In-House Training untuk Perusahaan?</h3>
          <p>Wahana Totalita melayani pelatihan langsung di lokasi pabrik/site perusahaan Anda di seluruh Indonesia, serta pengadaan resmi instansi via LPSE dan PADI UMKM.</p>
        </div>
        <a href="<?= wa_url('Halo Wahana Totalita, saya ingin konsultasi penawaran In-House Training untuk perusahaan kami', $wa_number) ?>" class="hub-btn-b2b" target="_blank" rel="noopener">
          Minta Proposal Resmi &rarr;
        </a>
      </div>

      <!-- FAQ ACCORDION -->
      <?php if (!empty($hub_data['faqs'])): ?>
      <section class="hub-card-section">
        <div class="hub-sec-header">
          <span class="hub-sec-eyebrow">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
            Tanya Jawab
          </span>
          <h2 class="hub-sec-title">Pertanyaan Umum (FAQ)</h2>
        </div>
        <div class="hub-faq-list">
          <?php foreach ($hub_data['faqs'] as $idx => $faq): ?>
          <div class="hub-faq-item">
            <button class="hub-faq-question" type="button" aria-expanded="false" onclick="toggleHubFaq(this)">
              <span><?= e($faq['q']) ?></span>
              <svg class="hub-faq-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
            </button>
            <div class="hub-faq-answer">
              <p><?= e($faq['a']) ?></p>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </section>
      <?php endif; ?>

      <!-- SIBLING HUBS (Cross-linking 4 related hubs) -->
      <?php if (!empty($hub_data['related_hubs'])): ?>
      <section class="hub-card-section">
        <div class="hub-sec-header">
          <span class="hub-sec-eyebrow">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/></svg>
            Interlink Terkait
          </span>
          <h2 class="hub-sec-title">Bidang Keahlian K3 Terkait Lainnya</h2>
        </div>
        <div class="hub-sibling-grid">
          <?php foreach ($hub_data['related_hubs'] as $sh): ?>
          <a href="/<?= trim($sh['slug'], '/') ?>/" class="hub-sibling-card">
            <span class="hub-sibling-badge"><?= e($sh['badge'] ?? 'Sertifikasi K3') ?></span>
            <h3 class="hub-sibling-title"><?= e($sh['name']) ?></h3>
            <p class="hub-sibling-desc"><?= e($sh['desc']) ?></p>
            <span class="hub-sibling-link">
              <span>Lihat Program</span>
              <span aria-hidden="true">&rarr;</span>
            </span>
          </a>
          <?php endforeach; ?>
        </div>
      </section>
      <?php endif; ?>

      <!-- 23 HUB COMPLETE DIRECTORY MESH -->
      <section class="hub-directory-mesh">
        <div class="hub-sec-header" style="margin-bottom:12px;">
          <span class="hub-sec-eyebrow">Direktori Lengkap</span>
          <h3 style="font-size:1.15rem;font-weight:800;color:var(--hub-dark);margin:0;">
            Jelajahi 23 Bidang Keahlian K3 &amp; Sertifikasi Indonesia
          </h3>
          <p style="font-size:13px;color:var(--hub-muted);margin:4px 0 0;">
            Pusat pelatihan sertifikasi resmi KEMNAKER RI dan BNSP untuk seluruh sektor industri nasional.
          </p>
        </div>
        <div class="hub-mesh-cols">
          <?php foreach ($HUB_DIRECTORY_MESH as $sec_title => $hubs): ?>
          <div class="hub-mesh-group">
            <h4><?= e($sec_title) ?></h4>
            <ul class="hub-mesh-links">
              <?php foreach ($hubs as $hb): ?>
              <li><a href="<?= e($hb['url']) ?>"><?= e($hb['name']) ?></a></li>
              <?php endforeach; ?>
            </ul>
          </div>
          <?php endforeach; ?>
        </div>
      </section>

    </main>

    <!-- RIGHT COLUMN: DESKTOP STICKY SIDEBAR (Priority #1) -->
    <aside class="hub-sticky-sidebar">
      <div class="hub-sidebar-card">
        <div class="hub-sb-status">
          <span class="hub-sb-status-dot"></span>
          <span>Konsultan Online &bull; Respon Cepat</span>
        </div>

        <h3 class="hub-sb-title">Konsultasi Pelatihan <?= e($hub_data['badge'] ?? 'K3') ?></h3>
        <p class="hub-sb-sub">Dapatkan informasi jadwal terdekat, rincian biaya, dan silabus lengkap langsung dari konsultan kami.</p>

        <a href="<?= e($hero_wa_url) ?>" class="hub-sb-btn-wa" target="_blank" rel="noopener">
          <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
          <span>Chat WhatsApp Konsultan</span>
        </a>

        <a href="<?= wa_url('Halo Wahana, mohon kirimkan PDF silabus dan kalender jadwal pelatihan ' . ($hub_data['title'] ?? ''), $wa_number) ?>" class="hub-sb-btn-secondary" target="_blank" rel="noopener">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
          <span>Unduh Silabus via WA</span>
        </a>

        <ul class="hub-sb-trust-list">
          <li class="hub-sb-trust-item">
            <svg class="hub-sb-trust-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
            <span>Sertifikasi Kemnaker RI / BNSP Resmi</span>
          </li>
          <li class="hub-sb-trust-item">
            <svg class="hub-sb-trust-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
            <span>PJK3 Berlisensi &amp; Berpengalaman sejak 2008</span>
          </li>
          <li class="hub-sb-trust-item">
            <svg class="hub-sb-trust-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
            <span>Terdaftar di LPSE &amp; PADI UMKM</span>
          </li>
          <li class="hub-sb-trust-item">
            <svg class="hub-sb-trust-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
            <span>Kelas Public (Jogja) &amp; In-House Nasional</span>
          </li>
        </ul>
      </div>
    </aside>

  </div>
</div>

<!-- ─── MOBILE STICKY FLOATING BOTTOM BAR (Priority #1 Mobile) ─── -->
<div class="hub-mobile-sticky-bar" id="hubMobileSticky">
  <div class="hub-msb-info">
    <p class="hub-msb-title"><?= e($hub_data['badge'] ?? 'Pelatihan K3') ?></p>
    <p class="hub-msb-sub">Konsultasi Jadwal &amp; Biaya (Respon Cepat)</p>
  </div>
  <a href="<?= e($hero_wa_url) ?>" class="hub-msb-btn" target="_blank" rel="noopener">
    <svg viewBox="0 0 24 24" fill="currentColor" width="15" height="15"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
    <span>Chat WA</span>
  </a>
</div>

<?php require __DIR__ . '/footer.php'; ?>
<?php require __DIR__ . '/scripts.php'; ?>

<script>
function toggleHubFaq(btn) {
  var expanded = btn.getAttribute('aria-expanded') === 'true';
  btn.setAttribute('aria-expanded', !expanded);
  var ans = btn.nextElementSibling;
  ans.classList.toggle('open', !expanded);
}
</script>
</body>
</html>
