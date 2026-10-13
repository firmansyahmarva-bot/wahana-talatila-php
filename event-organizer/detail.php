<?php
/**
 * event-organizer/detail.php — Dedicated Program Specification & Proposal Page
 * URL: /event-organizer/{slug}/
 */
require_once dirname(__DIR__) . '/config.php';
require_once dirname(__DIR__) . '/includes/event-data.php';

$slug = trim($_GET['slug'] ?? '');
if (!$slug) {
    header('Location: ' . SITE_URL . '/event-organizer/', true, 301);
    exit;
}

$item = get_event_item($slug);
if (!$item) {
    http_response_code(404);
    include dirname(__DIR__) . '/404.php';
    exit;
}

$s = get_all_settings();
$wa_number = preg_replace('/\D/', '', get_setting('wa_number', '6287759151278'));

$canonical = SITE_URL . '/event-organizer/' . $item['slug'] . '/';

$meta_title = $item['meta_title'] . ' | Wahana Totalita';
$meta_desc  = $item['meta_desc'];

// WhatsApp Lead Generation Message
$wa_lead_msg = "Halo Wahana Totalita, saya dari bagian HR / HSE / Pengadaan Perusahaan. Kami membutuhkan proposal penawaran resmi & KAK untuk program: {$item['judul']}. Mohon dihubungi untuk konsultasi teknis dan rincian RAB.";
$wa_lead_url = "https://wa.me/{$wa_number}?text=" . rawurlencode($wa_lead_msg);

// Related programs
$related_items = get_related_event_items($item['slug'], $item['kategori'], 3);

// Structured Data FAQs
$schema_faqs = [];
foreach ($item['faqs'] as $faq) {
    $schema_faqs[] = [
        '@type' => 'Question',
        'name' => $faq['q'],
        'acceptedAnswer' => [
            '@type' => 'Answer',
            'text' => $faq['a']
        ]
    ];
}

$schema_graph = [
    [
        '@type' => 'BreadcrumbList',
        '@id'   => $canonical . '#breadcrumb',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => SITE_URL . '/'],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Event Organizer B2B & B2G', 'item' => SITE_URL . '/event-organizer/'],
            ['@type' => 'ListItem', 'position' => 3, 'name' => $item['judul'], 'item' => $canonical]
        ]
    ],
    [
        '@type'        => 'Service',
        '@id'          => $canonical . '#service',
        'name'         => $item['judul'],
        'provider'     => [
            '@type' => 'Organization',
            'name'  => 'PT Wahana Totalita Konsultan',
            'url'   => SITE_URL
        ],
        'serviceType'  => 'Corporate Event Management & Government MICE Procurement',
        'description'  => $meta_desc,
        'areaServed'   => [
            ['@type' => 'Country', 'name' => 'Indonesia']
        ]
    ],
    [
        '@type'      => 'FAQPage',
        '@id'        => $canonical . '#faq',
        'mainEntity' => $schema_faqs
    ]
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($meta_title) ?></title>
<meta name="description" content="<?= htmlspecialchars($meta_desc) ?>">
<link rel="canonical" href="<?= htmlspecialchars($canonical) ?>">

<meta property="og:type" content="article">
<meta property="og:site_name" content="Wahana Totalita Konsultan">
<meta property="og:title" content="<?= htmlspecialchars($meta_title) ?>">
<meta property="og:description" content="<?= htmlspecialchars($meta_desc) ?>">
<meta property="og:url" content="<?= htmlspecialchars($canonical) ?>">
<meta property="og:image" content="<?= SITE_URL ?>/assets/img/og-cover.jpg">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?= htmlspecialchars($meta_title) ?>">
<meta name="twitter:description" content="<?= htmlspecialchars($meta_desc) ?>">
<meta name="twitter:image" content="<?= SITE_URL ?>/assets/img/og-cover.jpg">

<script type="application/ld+json">
<?= json_encode(['@context' => 'https://schema.org', '@graph' => $schema_graph], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) ?>
</script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="<?= theme_font_url($s) ?>" media="print" onload="this.media='all'">
<noscript><link rel="stylesheet" href="<?= theme_font_url($s) ?>"></noscript>
<?php require dirname(__DIR__) . '/includes/css.php'; ?>

<link rel="stylesheet" href="<?= asset_v('/assets/css/page/event-organizer-detail.css') ?>">
</head>
<body>

<?php include dirname(__DIR__) . '/includes/navbar.php'; ?>

<!-- ═══════════════════════════════════════════════════ DETAIL HERO -->
<section class="eo-detail-hero">
  <div class="container">
    <div class="eo-detail-badges">
      <span class="eo-badge-item">
        <?= htmlspecialchars($item['kategori_label']) ?>
      </span>
      <span class="eo-badge-item gold">
        <?= htmlspecialchars($item['inaproc_relevance']) ?>
      </span>
      <span class="eo-badge-item">
        PJK3 Resmi Kemnaker RI
      </span>
    </div>

    <h1><?= htmlspecialchars($item['judul']) ?></h1>

    <p class="tagline"><?= htmlspecialchars($item['tagline']) ?></p>

    <div class="eo-meta-strip">
      <div class="eo-meta-item">
        <span class="lbl">Durasi Pelaksanaan</span>
        <strong><?= htmlspecialchars($item['durasi_event']) ?></strong>
      </div>
      <div class="eo-meta-item">
        <span class="lbl">Target Peserta</span>
        <strong><?= htmlspecialchars($item['b2b_min_peserta']) ?></strong>
      </div>
      <div class="eo-meta-item">
        <span class="lbl">Cakupan Wilayah</span>
        <strong><?= htmlspecialchars(implode(', ', array_slice($item['city_mentions'], 0, 4))) ?></strong>
      </div>
      <div class="eo-meta-item">
        <span class="lbl">Estimasi Biaya / SBM</span>
        <strong class="price"><?= htmlspecialchars($item['biaya_standar']) ?></strong>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════════════ MAIN CONTENT -->
<main class="container">
  
  <!-- Breadcrumb -->
  <nav aria-label="Breadcrumb" style="font-size: 13.5px; color: var(--slate-500); margin-top: 24px;">
    <a href="/" style="color: var(--slate-500); text-decoration: none;">Beranda</a>
    <span style="margin: 0 6px;">/</span>
    <a href="/event-organizer/" style="color: var(--slate-500); text-decoration: none;">Event Organizer B2B &amp; B2G</a>
    <span style="margin: 0 6px;">/</span>
    <strong style="color: var(--slate-900);"><?= htmlspecialchars($item['judul']) ?></strong>
  </nav>

  <div class="eo-layout">
    
    <!-- Left Column: Detailed Information -->
    <article class="eo-body">
      
      <h2>Deskripsi Operasional &amp; Standar Penyelenggaraan</h2>
      <p><?= htmlspecialchars($item['deskripsi_lengkap']) ?></p>

      <h2>Fokus Utama &amp; Pilar Keunggulan Program</h2>
      <ul style="padding-left: 20px; margin-bottom: 28px;">
        <?php foreach ($item['highlight_pillars'] as $pillar): ?>
          <li style="margin-bottom: 10px; font-weight: 600; color: var(--slate-800);">
            <?= htmlspecialchars($pillar) ?>
          </li>
        <?php endforeach; ?>
      </ul>

      <h2>Spesifikasi Teknis Peralatan &amp; Layanan Produksi</h2>
      <p style="font-size: 14.5px; color: var(--slate-500);">
        Seluruh peralatan audio visual, multimedia, tata panggung, dan sarana tanggap darurat disiapkan dengan redundansi tinggi dan standar keamanan industri:
      </p>

      <table class="eo-spec-table">
        <thead>
          <tr>
            <th style="width: 32%;">Komponen Produksi</th>
            <th style="width: 68%;">Spesifikasi &amp; Standar Operasional</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($item['spesifikasi_teknis'] as $spec): ?>
          <tr>
            <td><strong><?= htmlspecialchars($spec['item']) ?></strong></td>
            <td><?= htmlspecialchars($spec['spek'] ?? $spec['detail'] ?? '') ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <h2>Susunan Acara (Rundown Resmi Pelaksanaan)</h2>
      <p style="font-size: 14.5px; color: var(--slate-500);">
        Rundown di bawah ini merupakan susunan standar yang dapat dikustomisasi sesuai Kerangka Acuan Kerja (KAK) dan dinamika protokoler instansi Anda:
      </p>

      <div class="eo-rundown-box">
        <?php foreach ($item['susunan_acara'] as $rundown): ?>
        <div class="eo-rundown-item">
          <div class="eo-time-badge"><?= htmlspecialchars($rundown['fase']) ?></div>
          <div class="eo-rundown-content">
            <h3><?= htmlspecialchars($rundown['agenda']) ?></h3>
          </div>
        </div>
        <?php endforeach; ?>
      </div>

      <h2>Deliverables &amp; Dokumen Pertanggungjawaban (SPJ)</h2>
      <p style="font-size: 14.5px; color: var(--slate-500);">
        Kami menjamin 100% kelengkapan administratif untuk kebutuhan pelaporan internal korporasi dan audit kepatuhan BPK / Inspektorat:
      </p>

      <div class="eo-deliv-grid">
        <?php foreach ($item['deliverables_output'] as $deliv): ?>
        <div class="eo-deliv-card">
          <strong>✓ Dokumen Sah</strong><br>
          <?= htmlspecialchars($deliv) ?>
        </div>
        <?php endforeach; ?>
      </div>

      <h2>Jangkauan Eksekusi Wilayah &amp; Kota Layanan</h2>
      <p>
        Program <strong><?= htmlspecialchars($item['judul']) ?></strong> ini dilayani oleh Wahana Totalita di berbagai kota strategis dan kawasan industri di seluruh Indonesia, termasuk: 
        <strong><?= htmlspecialchars(implode(', ', $item['city_mentions'])) ?></strong>.
      </p>
      <p style="font-size: 14.5px; color: var(--slate-600);">
        Perusahaan dan instansi yang telah bekerja sama dengan tim kami berasal dari sektor energi, BUMN, perbankan, dan manufaktur seperti:
        <em><?= htmlspecialchars(implode(', ', $item['companies_mentions'])) ?></em>.
      </p>

      <h2>Alur Pengadaan &amp; Prosedur Pemesanan Resmi (B2B &amp; B2G)</h2>
      <div class="eo-flow-box">
        <div class="eo-flow-step">
          <div class="eo-step-num">1</div>
          <div class="eo-step-info">
            <strong>Konsultasi Kebutuhan &amp; Penyesuaian KAK/TOR</strong>
            <span>Diskusikan tanggal acara, lokasi kota, jumlah peserta, dan kebutuhan fasilitas khusus bersama konsultan MICE/HSE kami.</span>
          </div>
        </div>
        <div class="eo-flow-step">
          <div class="eo-step-num">2</div>
          <div class="eo-step-info">
            <strong>Pengiriman Proposal Teknis &amp; RAB SBM Resmi</strong>
            <span>Kami mengirimkan surat penawaran resmi, breakdown anggaran berbasis SBM PMK, dan profil legalitas perusahaan.</span>
          </div>
        </div>
        <div class="eo-flow-step">
          <div class="eo-step-num">3</div>
          <div class="eo-step-info">
            <strong>Penerbitan Kontrak Kerja (SPK / Purchase Order)</strong>
            <span>Penerbitan Surat Perjanjian Kerja (SPK) resmi instansi atau pemrosesan pesanan melalui e-Katalog / INAPROC LKPP.</span>
          </div>
        </div>
        <div class="eo-flow-step">
          <div class="eo-step-num">4</div>
          <div class="eo-step-info">
            <strong>Eksekusi Lapangan Berstandar CSMS &amp; VVIP</strong>
            <span>Pelaksanaan kegiatan tepat waktu dengan pendampingan Liaison Officer (LO), Sound Engineer, dan Safety Officer berlisensi.</span>
          </div>
        </div>
        <div class="eo-flow-step">
          <div class="eo-step-num">5</div>
          <div class="eo-step-info">
            <strong>Serah Terima Hasil Pekerjaan (BAST) &amp; Faktur Pajak</strong>
            <span>Penandatanganan Berita Acara Serah Terima (BAST), penyerahan LPJ berjilid &amp; media 4K, serta Faktur Pajak elektronik DJP.</span>
          </div>
        </div>
      </div>

      <!-- FAQ Section -->
      <h2>Pertanyaan Umum Terkait Program Ini</h2>
      <div class="eo-rundown-box" style="background: transparent; padding: 0; border: none;">
        <?php foreach ($item['faqs'] as $faq): ?>
        <div style="background: var(--surface); border: 1px solid var(--slate-200); border-radius: 10px; padding: 18px 20px; margin-bottom: 14px;">
          <h3 style="margin: 0 0 8px; font-size: 15.5px; color: var(--slate-900);"><?= htmlspecialchars($faq['q']) ?></h3>
          <p style="margin: 0; font-size: 14px; color: var(--slate-600); line-height: 1.6;"><?= htmlspecialchars($faq['a']) ?></p>
        </div>
        <?php endforeach; ?>
      </div>

      <!-- Related Programs -->
      <h2 style="margin-top: 40px;">Program Terkait Lainnya</h2>
      <div class="eo-related-grid">
        <?php foreach ($related_items as $rel): ?>
        <div class="eo-related-card">
          <span style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: var(--info); display: block; margin-bottom: 6px;">
            <?= htmlspecialchars($rel['kategori_label']) ?>
          </span>
          <h3>
            <a href="/event-organizer/<?= htmlspecialchars($rel['slug']) ?>/">
              <?= htmlspecialchars($rel['judul']) ?>
            </a>
          </h3>
          <p><?= htmlspecialchars(mb_substr($rel['tagline'], 0, 95)) ?>...</p>
          <a href="/event-organizer/<?= htmlspecialchars($rel['slug']) ?>/" class="link">
            Lihat Proposal &amp; Spesifikasi →
          </a>
        </div>
        <?php endforeach; ?>
      </div>

    </article>

    <!-- Right Column: Sticky Request Proposal Sidebar -->
    <aside>
      <div style="position: sticky; top: 90px;">
        
        <!-- Action Card -->
        <div class="eo-sidebar-card">
          <h3>Minta Proposal &amp; KAK Resmi</h3>
          <p>
            Dapatkan Kerangka Acuan Kerja (KAK/TOR), susunan anggaran SBM, dan profil legalitas untuk program ini.
          </p>

          <div class="eo-sidebar-price">
            <span>Estimasi Biaya Standar</span>
            <strong><?= htmlspecialchars($item['biaya_standar']) ?></strong>
          </div>

          <a href="<?= $wa_lead_url ?>" target="_blank" rel="noopener" class="eo-sidebar-btn">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
            Request Proposal via WhatsApp
          </a>
        </div>

        <!-- Vendor Credibility Card -->
        <div class="eo-sidebar-card">
          <h3>Jaminan Kepatuhan Vendor</h3>
          <ul class="eo-tender-badge-list">
            <li>
              <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
              <span>Terdaftar LPSE, SiRUP &amp; INAPROC</span>
            </li>
            <li>
              <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
              <span>Status Pengusaha Kena Pajak (PKP)</span>
            </li>
            <li>
              <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
              <span>Faktur Pajak PPh 23 / PPN 11% Terbit Cepat</span>
            </li>
            <li>
              <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
              <span>PJK3 Lisensi Resmi Kemnaker RI</span>
            </li>
            <li>
              <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
              <span>Pemenang Tender Terverifikasi LKPP</span>
            </li>
          </ul>
        </div>

        <!-- Procurement Direct Contact -->
        <div class="eo-sidebar-card" style="background: var(--slate-900); color: var(--surface);">
          <h3 style="color: var(--surface);">Layanan Pengadaan B2B/B2G</h3>
          <p style="color: var(--slate-400); font-size: 13px;">
            Butuh klarifikasi penawaran atau presentasi teknis di kantor Anda? Hubungi divisi procurement kami:
          </p>
          <div style="font-size: 14px; margin-bottom: 8px;">
            <strong style="color: var(--accent-soft);">Telepon / WA:</strong> +62 877-5915-1278
          </div>
          <div style="font-size: 14px;">
            <strong style="color: var(--accent-soft);">Email Resmi:</strong> info@wahanatotalita.com
          </div>
        </div>

      </div>
    </aside>

  </div>
</main>

<?php include dirname(__DIR__) . '/includes/footer.php'; ?>

</body>
</html>
