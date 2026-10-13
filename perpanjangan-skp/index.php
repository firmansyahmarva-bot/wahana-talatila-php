<?php
/**
 * perpanjangan-skp/index.php — Master Authority Hub for Perpanjangan SKP & Lisensi K3 Kemnaker / BNSP
 * URL: /perpanjangan-skp/
 */
require_once dirname(__DIR__) . '/config.php';
require_once dirname(__DIR__) . '/includes/perpanjangan-skp-data.php';

$s = get_all_settings();
$wa_number = preg_replace('/\D/', '', get_setting('wa_number', '6287759151278'));

// Filter parameters
$search   = trim($_GET['q'] ?? '');
$kategori = trim($_GET['kategori'] ?? '');

$filter = [];
if ($search !== '')   $filter['q'] = $search;
if ($kategori !== '') $filter['kategori'] = $kategori;

$items        = get_all_perpanjangan_skp_items($filter);
$categories   = get_perpanjangan_skp_categories();
$totalFound   = count($items);

$page_title  = 'Perpanjangan SKP & Lisensi K3 Kemnaker RI Resmi | Biaya, Syarat & Proses Cepat';
$meta_desc   = 'Layanan perpanjangan SKP Ahli K3 Umum, Mutasi PT, SIO Forklift/Crane & Sertifikat BNSP online. Tanpa pelatihan ulang, proses 7-14 hari. Cek syarat & biaya disini.';
$canonical   = SITE_URL . '/perpanjangan-skp/';

$default_wa_text = "Halo Wahana Totalita, saya ingin konsultasi perpanjangan SKP / Lisensi K3 saya. Mohon dibantu cek masa berlaku dan persyaratannya.";
$default_wa_url  = "https://wa.me/{$wa_number}?text=" . rawurlencode($default_wa_text);

// Schema.org Graph
$schema_graph = [
    [
        '@type'        => 'Organization',
        '@id'          => SITE_URL . '/#organization',
        'name'         => 'PT Wahana Totalita Konsultan',
        'url'          => SITE_URL,
        'description'  => 'PJK3 Resmi Berlisensi Kementerian Ketenagakerjaan RI Bidang Pembinaan, Perpanjangan SKP/Lisensi K3 & Uji Kompetensi BNSP.',
        'contactPoint' => [
            '@type'             => 'ContactPoint',
            'telephone'         => '+62-877-5915-1278',
            'contactType'       => 'licensing & customer service',
            'availableLanguage' => ['Indonesian', 'English']
        ]
    ],
    [
        '@type' => 'BreadcrumbList',
        '@id'   => $canonical . '#breadcrumb',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => SITE_URL . '/'],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Perpanjangan SKP & Lisensi K3', 'item' => $canonical]
        ]
    ],
    [
        '@type'       => 'Service',
        '@id'         => $canonical . '#service',
        'name'        => 'Layanan Perpanjangan SKP Ahli K3 & Lisensi Kemnaker / BNSP Online',
        'provider'    => ['@id' => SITE_URL . '/#organization'],
        'serviceType' => 'Statutory Licensing Administration & Renewal',
        'description' => $meta_desc,
        'areaServed'  => [
            ['@type' => 'Country', 'name' => 'Indonesia']
        ]
    ],
    [
        '@type'      => 'FAQPage',
        '@id'        => $canonical . '#faq',
        'mainEntity' => [
            [
                '@type' => 'Question',
                'name'  => 'SKP Ahli K3 berlaku berapa lama?',
                'answerCount' => 1,
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text'  => 'Berdasarkan Permenaker No. 02/MEN/1992, SKP (Surat Keputusan Penunjukan) dan Lisensi Ahli K3 berlaku selama 3 (tiga) tahun. Sedangkan Lisensi Operator K3 Kemnaker (SIO) berlaku selama 5 tahun, dan Sertifikat Kompetensi BNSP berlaku selama 3 tahun.'
                ]
            ],
            [
                '@type' => 'Question',
                'name'  => 'Apakah SKP yang sudah kadaluwarsa harus mengulang pelatihan dari awal?',
                'answerCount' => 1,
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text'  => 'Tidak perlu jika masih dalam batas masa toleransi (kurang dari 1 tahun). Anda cukup mengajukan perpanjangan administratif. Jika sudah kadaluwarsa lebih dari 1 tahun, Anda dapat mengikuti program Refresher K3 (penyegaran 2 hari) tanpa harus membayar biaya penuh kursus 12 hari dari nol.'
                ]
            ],
            [
                '@type' => 'Question',
                'name'  => 'Berapa lama proses nunggunya sampai SKP / Lisensi baru terbit?',
                'answerCount' => 1,
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text'  => 'Waktu proses rata-rata adalah 7 hingga 14 hari kerja setelah seluruh dokumen persyaratan dan Laporan Kegiatan K3 dinyatakan lengkap dan diverifikasi oleh tim pengawas Kemnaker RI.'
                ]
            ],
            [
                '@type' => 'Question',
                'name'  => 'Apakah proses perpanjangan sertifikat BNSP bisa secara online?',
                'answerCount' => 1,
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text'  => 'Bisa 100% online. Melalui skema RCC (Recognition of Current Competency), perpanjangan sertifikat BNSP dilakukan melalui verifikasi portofolio kerja dan wawancara online bersama asesor LSP via Zoom tanpa harus hadir tatap muka.'
                ]
            ],
            [
                '@type' => 'Question',
                'name'  => 'Berapa estimasi biaya perpanjangan lisensi dan SKP K3?',
                'answerCount' => 1,
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text'  => 'Biaya perpanjangan SIO Operator mulai dari Rp 1.500.000,- (batch) hingga Rp 1.750.000,-. Perpanjangan SKP Ahli K3 Umum Rp 1.850.000,-, Mutasi PT Rp 2.450.000,-, dan Uji RCC BNSP Rp 2.500.000,- all-in termasuk PNBP dan pengiriman fisik dokumen.'
                ]
            ]
        ]
    ]
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($page_title) ?></title>
<meta name="description" content="<?= htmlspecialchars($meta_desc) ?>">
<link rel="canonical" href="<?= htmlspecialchars($canonical) ?>">

<meta property="og:type" content="website">
<meta property="og:site_name" content="Wahana Totalita Konsultan">
<meta property="og:title" content="<?= htmlspecialchars($page_title) ?>">
<meta property="og:description" content="<?= htmlspecialchars($meta_desc) ?>">
<meta property="og:url" content="<?= htmlspecialchars($canonical) ?>">
<meta property="og:image" content="<?= SITE_URL ?>/assets/img/og-cover.jpg">

<script type="application/ld+json">
<?= json_encode(['@context' => 'https://schema.org', '@graph' => $schema_graph], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) ?>
</script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="<?= theme_font_url($s) ?>" media="print" onload="this.media='all'">
<noscript><link rel="stylesheet" href="<?= theme_font_url($s) ?>"></noscript>
<?php require dirname(__DIR__) . '/includes/css.php'; ?>

<link rel="stylesheet" href="<?= asset_v('/assets/css/page/perpanjangan-skp.css') ?>">
</head>
<body>

<?php require dirname(__DIR__) . '/includes/navbar.php'; ?>

<!-- HERO -->
<section class="skp-hero">
  <div class="container">
    <div class="skp-badge">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/></svg>
      Layanan Resmi Kemnaker RI &amp; BNSP
    </div>
    <h1>Perpanjang SKP &amp; Lisensi K3 <em>Tanpa Pelatihan Ulang</em></h1>
    <p class="lead">
      SKP atau Lisensi K3 Anda mendekati tanggal kedaluwarsa atau sudah lewat masa 3 tahun? Ajukan perpanjangan administratif resmi ke Kementerian Ketenagakerjaan RI dan LSP BNSP. <strong>Proses cepat 7–14 hari kerja, tanpa harus mengulang kursus dari nol.</strong>
    </p>

    <div class="skp-hero-actions">
      <a href="<?= $default_wa_url ?>" class="skp-btn-wa" target="_blank" rel="noopener">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
        Cek Kelayakan Berkas via WhatsApp (Gratis)
      </a>
      <a href="#katalog" class="skp-btn-outline">Lihat Daftar Lisensi (<?= count(get_all_perpanjangan_skp_items()) ?>)</a>
    </div>

    <div class="skp-trust-bar">
      <span><svg viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>Birokrasi TemanK3 Resmi</span>
      <span><svg viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>Hemat Biaya hingga Rp 5 Juta</span>
      <span><svg viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>100% Pengurusan Online</span>
      <span><svg viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>Didampingi Hingga Fisik Terbit</span>
    </div>
  </div>
</section>

<!-- FILTER SECTION -->
<section class="skp-filter-section" id="katalog">
  <div class="container">
    <div class="skp-filter-bar">
      <a href="/perpanjangan-skp/" class="skp-filter-chip <?= empty($kategori) ? 'active' : '' ?>">Semua Program (<?= count(get_all_perpanjangan_skp_items()) ?>)</a>
      <?php foreach ($categories as $catKey => $catLabel): ?>
      <a href="/perpanjangan-skp/?kategori=<?= $catKey ?>" class="skp-filter-chip <?= ($kategori === $catKey) ? 'active' : '' ?>">
        <?= htmlspecialchars($catLabel) ?>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- SERVICES GRID -->
<section style="padding: 48px 0 60px; background: var(--surface);">
  <div class="container">
    <div style="display:flex; justify-content:space-between; align-items:flex-end; flex-wrap:wrap; gap:16px;">
      <div>
        <span style="color:var(--accent-dark); font-weight:700; font-size:13px; text-transform:uppercase; letter-spacing:.08em;">Katalog Pembaharuan Lisensi</span>
        <h2 style="font-size:clamp(22px, 3vw, 32px); color:var(--slate-900); font-weight:800; margin:6px 0 0;">
          Pilih Jenis SKP atau Lisensi yang Ingin Diperpanjang
        </h2>
      </div>
      <p style="color:var(--slate-500); font-size:14px; margin:0;">
        Menampilkan <strong><?= $totalFound ?></strong> skema perpanjangan aktif
      </p>
    </div>

    <div class="skp-grid">
      <?php foreach ($items as $item): 
        $item_wa_text = "Halo Wahana Totalita, saya ingin memperpanjang {$item['judul']}. Mohon info estimasi biaya dan kelengkapan dokumen yang dibutuhkan.";
        $item_wa_url  = "https://wa.me/{$wa_number}?text=" . rawurlencode($item_wa_text);
      ?>
      <article class="skp-card">
        <span class="skp-card-tag"><?= htmlspecialchars($item['kategori_label']) ?></span>
        <h3><a href="/perpanjangan-skp/<?= htmlspecialchars($item['slug']) ?>/"><?= htmlspecialchars($item['judul']) ?></a></h3>
        <p class="desc"><?= htmlspecialchars($item['tagline']) ?></p>

        <div class="skp-card-price-box">
          <div>
            <span style="display:block; font-size:11.5px; color:var(--slate-500); text-transform:uppercase;">Biaya Mulai:</span>
            <strong><?= htmlspecialchars($item['biaya_standar']) ?></strong>
          </div>
          <div style="text-align:right;">
            <span style="display:block; font-size:11.5px; color:var(--slate-500);">Masa Berlaku:</span>
            <span style="font-weight:700; color:var(--slate-900);"><?= htmlspecialchars($item['masa_berlaku']) ?></span>
          </div>
        </div>

        <div class="skp-card-actions">
          <a href="/perpanjangan-skp/<?= htmlspecialchars($item['slug']) ?>/" class="skp-card-btn skp-card-btn-primary">
            Lihat Syarat &amp; Alur &rarr;
          </a>
          <a href="<?= $item_wa_url ?>" class="skp-card-btn skp-card-btn-wa" target="_blank" rel="noopener" title="Konsultasi WhatsApp">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
          </a>
        </div>
      </article>
      <?php endforeach; ?>
    </div>

    <!-- INSTANT EXPIRY CHECKER CALLOUT -->
    <div class="skp-checker-box">
      <div class="skp-checker-grid">
        <div>
          <span style="color:var(--success-border); font-weight:700; font-size:12px; text-transform:uppercase; letter-spacing:.08em;">Verifikasi Cepat 15 Menit</span>
          <h3>Bingung Apakah SKP Anda Masih Bisa Diperpanjang?</h3>
          <p>
            Cukup foto halaman depan sertifikat atau SKP lama Anda dan kirimkan ke tim verifikasi Wahana Totalita. Kami akan mengecek sisa masa tenggang toleransi dan menerbitkan checklist berkas yang dibutuhkan secara gratis.
          </p>
        </div>
        <div style="text-align:center;">
          <a href="<?= $default_wa_url ?>" class="skp-btn-wa" target="_blank" rel="noopener" style="font-size:16px; padding:15px 32px;">
            Kirim Foto SKP via WhatsApp
          </a>
          <p style="color:var(--success-soft); font-size:12.5px; margin-top:10px;">Respon cepat 15 menit &bull; Tanpa biaya pengecekan</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- TRANSPARENT PRICING & BENEFIT COMPARISON -->
<section style="padding: 50px 0; background: var(--slate-50); border-top: 1px solid var(--slate-200); border-bottom: 1px solid var(--slate-200);">
  <div class="container">
    <div style="text-align:center; max-width:760px; margin:0 auto 28px;">
      <span style="color:var(--accent-dark); font-weight:700; font-size:13px; text-transform:uppercase; letter-spacing:.08em;">Transparansi Biaya &amp; Estimasi</span>
      <h2 style="font-size:clamp(22px, 3vw, 32px); color:var(--slate-900); font-weight:800; margin:6px 0 12px;">
        Tabel Estimasi Biaya &amp; Durasi Perpanjangan K3
      </h2>
      <p style="color:var(--slate-500); font-size:15px; margin:0;">
        Biaya all-in transparan meliputi verifikasi berkas, PNBP resmi kementerian / LSP, pencetakan blangko berhologram, dan ongkos kirim fisik dokumen bergaransi:
      </p>
    </div>

    <div class="skp-table-box">
      <table class="skp-table">
        <thead>
          <tr>
            <th>Jenis Layanan Perpanjangan</th>
            <th>Masa Berlaku</th>
            <th>Tarif Perorangan</th>
            <th>Tarif Rombongan / Batch</th>
            <th>Estimasi Waktu</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><strong>SIO Operator &amp; Teknisi Kemnaker</strong><br><small>Forklift, Crane, Boiler, Welder, Ketinggian</small></td>
            <td>5 Tahun</td>
            <td><strong>Rp 1.750.000</strong></td>
            <td><strong>Rp 1.500.000</strong> / lisensi (min. 3)</td>
            <td>7 – 10 Hari Kerja</td>
          </tr>
          <tr>
            <td><strong>SKP Ahli K3 Umum (Kemnaker RI)</strong><br><small>Pembaharuan SKP &amp; Lisensi Penunjukan</small></td>
            <td>3 Tahun</td>
            <td><strong>Rp 1.850.000</strong></td>
            <td><strong>Rp 1.550.000</strong> / orang (min. 3)</td>
            <td>7 – 14 Hari Kerja</td>
          </tr>
          <tr>
            <td><strong>Mutasi Perusahaan SKP Ahli K3</strong><br><small>Pindah PT / Perubahan Nama Badan Usaha</small></td>
            <td>3 Tahun</td>
            <td><strong>Rp 2.450.000</strong></td>
            <td><strong>Rp 2.100.000</strong> / orang</td>
            <td>10 – 16 Hari Kerja</td>
          </tr>
          <tr>
            <td><strong>SKP Ahli K3 Spesialis</strong><br><small>Listrik, Konstruksi, Kimia, Kebakaran</small></td>
            <td>3 Tahun</td>
            <td><strong>Rp 2.250.000</strong></td>
            <td><strong>Rp 1.950.000</strong> / orang</td>
            <td>10 – 14 Hari Kerja</td>
          </tr>
          <tr>
            <td><strong>Sertifikasi BNSP K3 &amp; Lingkungan (RCC)</strong><br><small>Uji Portofolio Online via Zoom (POPAL, PPPA, POP)</small></td>
            <td>3 Tahun</td>
            <td><strong>Rp 2.500.000</strong></td>
            <td><strong>Rp 2.200.000</strong> / orang</td>
            <td>5 – 10 Hari Kerja</td>
          </tr>
          <tr>
            <td><strong>Solusi SKP Kadaluwarsa > 1 Tahun</strong><br><small>Program Refresher K3 Resmi Kemnaker</small></td>
            <td>3 Tahun Baru</td>
            <td><strong>Rp 3.850.000</strong></td>
            <td><strong>Rp 3.300.000</strong> / orang</td>
            <td>Penyegaran 2 Hari</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

<!-- FAQ SECTION -->
<section style="padding: 50px 0; background: var(--surface);">
  <div class="container">
    <div style="text-align:center; max-width:700px; margin:0 auto 36px;">
      <span style="color:var(--accent-dark); font-weight:700; font-size:13px; text-transform:uppercase; letter-spacing:.08em;">Pertanyaan Kerap Diajukan</span>
      <h2 style="font-size:clamp(22px, 3vw, 30px); color:var(--slate-900); font-weight:800; margin:6px 0 0;">
        FAQ Seputar Perpanjangan SKP &amp; Lisensi K3
      </h2>
    </div>

    <div style="max-width:840px; margin:0 auto; display:flex; flex-direction:column; gap:14px;">
      <details style="background:var(--slate-50); border:1px solid var(--slate-200); border-radius:10px; padding:16px 20px;">
        <summary style="font-weight:700; color:var(--slate-900); cursor:pointer; font-size:15.5px;">SKP Ahli K3 Umum berlaku berapa lama dan berlaku berapa tahun?</summary>
        <p style="margin:12px 0 0; color:var(--slate-600); font-size:14px; line-height:1.6;">
          Berdasarkan Permenaker No. 02/MEN/1992 Pasal 3, Surat Keputusan Penunjukan (SKP) dan Lisensi Ahli K3 berlaku selama <strong>3 (tiga) tahun</strong>. Setelah 3 tahun, pengurus wajib mengajukan perpanjangan administratif ke Kemnaker RI. Sertifikat kelulusan dasarnya sendiri berlaku seumur hidup.
        </p>
      </details>

      <details style="background:var(--slate-50); border:1px solid var(--slate-200); border-radius:10px; padding:16px 20px;">
        <summary style="font-weight:700; color:var(--slate-900); cursor:pointer; font-size:15.5px;">Berapa lama proses nunggunya sampai lisensi fisik terbit?</summary>
        <p style="margin:12px 0 0; color:var(--slate-600); font-size:14px; line-height:1.6;">
          Waktu tunggu pemrosesan adalah <strong>7 hingga 14 hari kerja</strong> setelah dokumen pendukung (laporan kegiatan K3 dan surat pengantar) diverifikasi lengkap oleh Pengawas Spesialis K3 Kemnaker RI.
        </p>
      </details>

      <details style="background:var(--slate-50); border:1px solid var(--slate-200); border-radius:10px; padding:16px 20px;">
        <summary style="font-weight:700; color:var(--slate-900); cursor:pointer; font-size:15.5px;">Jika SKP sudah kadaluwarsa lebih dari 1 tahun, apakah wajib kursus ulang 12 hari?</summary>
        <p style="margin:12px 0 0; color:var(--slate-600); font-size:14px; line-height:1.6;">
          Tidak perlu mengulang 12 hari penuh dari nol. Kemnaker RI menyediakan skema <strong>Refresher K3 (Pembinaan Penyegaran 2 Hari)</strong> bagi pemilik sertifikat lama yang penunjukannya telah mati lebih dari 1 tahun. Biayanya jauh lebih hemat dibandingkan mendaftar kursus penuh.
        </p>
      </details>

      <details style="background:var(--slate-50); border:1px solid var(--slate-200); border-radius:10px; padding:16px 20px;">
        <summary style="font-weight:700; color:var(--slate-900); cursor:pointer; font-size:15.5px;">Apakah sertifikat BNSP bisa diperpanjang secara online dari luar kota?</summary>
        <p style="margin:12px 0 0; color:var(--slate-600); font-size:14px; line-height:1.6;">
          Bisa 100% online. Skema RCC (Recognition of Current Competency) BNSP dilakukan secara daring: Anda mengunggah portofolio bukti kerja K3 selama 1–2 tahun terakhir, lalu mengikuti sesi wawancara online via Zoom bersama Asesor LSP selama ±30 menit. Sertifikat fisik Garuda BNSP baru akan dikirimkan ke alamat Anda.
        </p>
      </details>
    </div>
  </div>
</section>

<!-- BOTTOM CTA -->
<section style="background:var(--brand-dark); color:var(--surface); padding:50px 0; text-align:center; border-top:1px solid var(--slate-800);">
  <div class="container">
    <h2 style="color:var(--surface); font-size:26px; margin:0 0 12px; font-weight:800;">Jangan Biarkan Kewenangan K3 Anda Terputus</h2>
    <p style="color:var(--slate-300); font-size:15.5px; max-width:640px; margin:0 auto 24px;">
      Pertahankan keabsahan legalitas tender dan kepatuhan audit SMK3 perusahaan Anda. Kirimkan berkas perpanjangan SKP atau SIO Anda hari ini.
    </p>
    <a href="<?= $default_wa_url ?>" class="skp-btn-wa" target="_blank" rel="noopener" style="font-size:16px; padding:15px 32px;">
      Konsultasi Perpanjangan via WhatsApp
    </a>
  </div>
</section>

<?php require dirname(__DIR__) . '/includes/footer.php'; ?>
<script src="/assets/js/main.js" defer></script>
</body>
</html>
