<?php
/**
 * in-house/index.php — Wahana Totalita Corporate In-House Training Portal
 * Clean URL: /in-house-training/
 * Target: HSE Managers, HR Directors, Plant Managers, Procurement / Vendor Management
 */
require_once dirname(__DIR__) . '/config.php';

$s = get_all_settings();
$wa_number  = '6287759151278';
$meta_title = 'In-House Training K3 Perusahaan: Layanan Sertifikasi On-Site Seluruh Indonesia | Wahana Totalita';
$meta_desc  = 'Layanan In-House Training K3 dan sertifikasi resmi Kemnaker RI & BNSP langsung di fasilitas/site perusahaan Anda. Hemat biaya hingga 40%, instruktur praktisi senior, proposal dalam 24 jam.';
$page_url   = SITE_URL . '/in-house-training/';

$wa_quote_url = wa_url('Halo Wahana Totalita, kami ingin mengajukan permintaan proposal in-house training K3 untuk perusahaan kami.', $wa_number);

$regional_hubs = [
    [
        'title'      => 'Balikpapan & IKN Nusantara',
        'badge'      => 'Koridor Tambang & Migas',
        'url'        => '/in-house-training/balikpapan-ikn/',
        'icon'       => '⛏️',
        'areas'      => 'Balikpapan, Sepaku (IKN), Samarinda, Samboja, Kutai',
        'desc'       => 'Spesialisasi sertifikasi pertambangan minerba (POP/POM BNSP), lifting equipment & rigging Kemnaker, confined space, dan K3 konstruksi infrastruktur IKN.',
        'programs'   => ['POP & POM Tambang BNSP', 'Rigger & Mobile Crane Kemnaker', 'K3 Ruang Terbatas (Confined Space)', 'Ahli K3 Konstruksi IKN']
    ],
    [
        'title'      => 'Cilegon & Karawang',
        'badge'      => 'Koridor Petrokimia & Manufaktur',
        'url'        => '/in-house-training/cilegon-karawang/',
        'icon'       => '🏭',
        'areas'      => 'Kawasan Industri KIEC Cilegon, KIIC Karawang, Suryacipta, Jababeka',
        'desc'       => 'Fokus kepatuhan industri proses kimia berat, operator bejana tekan & boiler, forklift / overhead crane, serta integrasi sistem manajemen SMK3 PP 50/2012.',
        'programs'   => ['Petugas & Ahli K3 Kimia (Kepmenaker 187/1999)', 'Operator Boiler Kelas 1 & 2', 'Operator Forklift & Overhead Crane', 'Audit Internal SMK3 PP 50/2012']
    ],
    [
        'title'      => 'Morowali & Weda Bay',
        'badge'      => 'Koridor Smelter Nikel & Remote Site',
        'url'        => '/in-house-training/morowali-weda-bay/',
        'icon'       => '🔥',
        'areas'      => 'Kawasan IMIP Morowali, IWIP Halmahera Tengah, VDNI Konawe',
        'desc'       => 'Layanan on-site terpadu untuk smelter nikel pyrometallurgy & HPAL. Juru las bersertifikat, inspeksi furnace/kiln, dan tim instruktur siap mobilisasi ke remote island.',
        'programs'   => ['Juru Las (Welder 3G/4G/6G BNSP)', 'K3 Confined Space Tangki & Tanur', 'Operator Overhead Crane Smelter', 'Safety Officer Smelter Nikel']
    ],
];

$faqs = [
    [
        'q' => 'Berapa jumlah minimum peserta untuk menyelenggarakan In-House Training?',
        'a' => 'Untuk efisiensi biaya korporat, in-house training biasanya ideal dimulai dari 5 hingga 10 peserta per kelas. Namun kami dapat menyesuaikan kapasitas rombongan hingga puluhan peserta dengan skema batch bertahap agar proses produksi operasional perusahaan tidak terganggu.'
    ],
    [
        'q' => 'Apakah sertifikat yang diterbitkan resmi dan diakui auditor SMK3/regulator?',
        'a' => 'Ya, 100% resmi. Wahana Totalita merupakan PJK3 resmi berlisensi Kementerian Ketenagakerjaan RI (SKP No. Kep. 312/BINWASPNAK-PNK3/V/2020) dan bermitra dengan Lembaga Sertifikasi Profesi (LSP) terlisensi BNSP. Sertifikat resmi ber-SKP atau berlogo Garuda Emas sah digunakan untuk audit SMK3, CSMS tender migas/tambang, dan inspeksi pengawas ketenagakerjaan.'
    ],
    [
        'q' => 'Bagaimana prosedur administrasi procurement dan penagihan (invoicing)?',
        'a' => 'Kami terbiasa dengan prosedur pengadaan B2B: pengisian formulir vendor registration, penerbitan proposal teknis & komersial resmi, penerbitan Surat Penawaran, penerimaan Purchase Order (PO) / SPK, faktur pajak resmi (PPN), dan termin pembayaran yang fleksibel sesuai perjanjian kerjasama (PKS).'
    ],
    [
        'q' => 'Apakah silabus dan materi training bisa disesuaikan dengan SOP internal pabrik/site kami?',
        'a' => 'Tentu saja. Salah satu keunggulan terbesar in-house training adalah kurikulum custom. Sebelum pelatihan dimulai, instruktur kami dapat melakukan preliminary assessment terhadap dokumen HIRADC, SOP internal, atau temuan audit pabrik/site Anda sehingga materi langsung aplikatif pada studi kasus nyata.'
    ],
    [
        'q' => 'Bagaimana jika fasilitas perusahaan kami berada di lokasi terpencil (remote area)?',
        'a' => 'Tim instruktur dan asesor Wahana Totalita berpengalaman melakukan mobilisasi ke lokasi tambang, offshore, pulau terpencil, maupun kawasan industri terpadu di seluruh Indonesia (Sumatera, Kalimantan, Jawa, Sulawesi, Maluku, hingga Papua).'
    ]
];

$schema_graph = [
    [
        '@type'       => 'Organization',
        '@id'         => SITE_URL . '/#organization',
        'name'        => 'PT Wahana Totalita Konsultan',
        'url'         => SITE_URL,
        'description' => 'PJK3 Resmi Berlisensi Kementerian Ketenagakerjaan RI (No. Kep. 312/BINWASPNAK-PNK3/V/2020) & Lembaga Pelatihan Terakreditasi BNSP.',
        'contactPoint'=> [
            '@type'             => 'ContactPoint',
            'telephone'         => '+62-877-5915-1278',
            'contactType'       => 'corporate inquiries',
            'availableLanguage' => ['Indonesian', 'English', 'Chinese']
        ]
    ],
    [
        '@type' => 'BreadcrumbList',
        '@id'   => $page_url . '#breadcrumb',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => SITE_URL . '/'],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Layanan Perusahaan', 'item' => SITE_URL . '/perusahaan/'],
            ['@type' => 'ListItem', 'position' => 3, 'name' => 'In-House Training K3', 'item' => $page_url]
        ]
    ],
    [
        '@type'        => 'Service',
        '@id'          => $page_url . '#service',
        'name'         => 'Corporate In-House Training & On-Site Certification K3',
        'provider'     => ['@id' => SITE_URL . '/#organization'],
        'serviceType'  => 'Occupational Health and Safety Training',
        'description'  => $meta_desc,
        'areaServed'   => 'Indonesia',
        'availableChannel' => [
            '@type' => 'ServiceChannel',
            'serviceUrl' => $page_url,
            'servicePhone' => '+62-877-5915-1278'
        ]
    ],
    [
        '@type'      => 'FAQPage',
        '@id'        => $page_url . '#faq',
        'mainEntity' => array_map(fn($f) => [
            '@type'          => 'Question',
            'name'           => $f['q'],
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']]
        ], $faqs)
    ]
];
?>
<!DOCTYPE html>
<html lang="id" translate="no">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($meta_title) ?></title>
<meta name="description" content="<?= e($meta_desc) ?>">
<link rel="canonical" href="<?= htmlspecialchars($page_url) ?>">
<link rel="alternate" hreflang="id" href="<?= htmlspecialchars($page_url) ?>" />
<link rel="alternate" hreflang="x-default" href="<?= htmlspecialchars($page_url) ?>" />

<meta property="og:type" content="website">
<meta property="og:site_name" content="Wahana Totalita Konsultan">
<meta property="og:title" content="<?= e($meta_title) ?>">
<meta property="og:description" content="<?= e($meta_desc) ?>">
<meta property="og:url" content="<?= htmlspecialchars($page_url) ?>">
<meta property="og:image" content="<?= SITE_URL ?>/assets/img/og-cover.jpg">

<script type="application/ld+json">
<?= json_encode(['@context' => 'https://schema.org', '@graph' => $schema_graph], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) ?>
</script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preload" href="<?= theme_font_url($s) ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="<?= theme_font_url($s) ?>"></noscript>
<link rel="stylesheet" href="<?= asset_v('/assets/css/core.min.css') ?>">
<link rel="stylesheet" href="<?= asset_v('/assets/css/components.min.css') ?>">
<?= theme_css_vars($s) ?>
<style>
/* In-House Directory Styles */
.ih-hero {
  background: linear-gradient(135deg, #062b1b 0%, #0A4A2E 50%, #125838 100%);
  color: #fff;
  padding: 56px 0 46px;
  position: relative;
}
.ih-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: rgba(255,255,255,0.12);
  border: 1px solid rgba(255,255,255,0.22);
  color: #86efac;
  font-size: 13px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: .06em;
  padding: 6px 14px;
  border-radius: 99px;
  margin-bottom: 18px;
}
.ih-hero h1 {
  font-size: clamp(28px, 4vw, 42px);
  font-weight: 800;
  line-height: 1.25;
  color: #fff;
  max-width: 860px;
  margin: 0 0 16px;
}
.ih-hero p.lead {
  font-size: clamp(16px, 1.8vw, 18px);
  color: #d1fae5;
  line-height: 1.6;
  max-width: 780px;
  margin: 0 0 26px;
}
.ih-hero-cta {
  display: flex;
  gap: 14px;
  flex-wrap: wrap;
}
.ih-btn-wa {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  background: #25D366;
  color: #062b1b;
  font-weight: 700;
  font-size: 15px;
  padding: 13px 26px;
  border-radius: 10px;
  text-decoration: none;
  transition: transform .2s ease, background .2s ease;
}
.ih-btn-wa:hover {
  background: #20ba5a;
  transform: translateY(-2px);
}
.ih-btn-secondary {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: rgba(255,255,255,0.1);
  color: #fff;
  border: 1px solid rgba(255,255,255,0.25);
  font-weight: 600;
  font-size: 15px;
  padding: 13px 22px;
  border-radius: 10px;
  text-decoration: none;
}
.ih-btn-secondary:hover {
  background: rgba(255,255,255,0.2);
}

/* Regional Enterprise Hubs Section */
.ih-hubs-wrap {
  padding: 60px 0;
  background: #f8fafc;
}
.ih-section-title {
  text-align: center;
  max-width: 760px;
  margin: 0 auto 42px;
}
.ih-section-title p.eyebrow {
  color: #0A4A2E;
  font-weight: 700;
  font-size: 13.5px;
  letter-spacing: .08em;
  text-transform: uppercase;
  margin-bottom: 8px;
}
.ih-section-title h2 {
  font-size: clamp(24px, 3.2vw, 34px);
  color: #0f172a;
  font-weight: 800;
  line-height: 1.3;
}
.ih-hubs-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
  gap: 26px;
}
.ih-hub-card {
  background: #fff;
  border: 1px solid #e2e8f0;
  border-radius: 16px;
  padding: 30px;
  display: flex;
  flex-direction: column;
  box-shadow: 0 4px 16px rgba(0,0,0,0.04);
  transition: all .25s ease;
  position: relative;
  overflow: hidden;
}
.ih-hub-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 5px;
  background: linear-gradient(90deg, #0A4A2E, #25D366);
}
.ih-hub-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 12px 28px rgba(10,74,46,0.12);
  border-color: #cbd5e1;
}
.ih-hub-badge {
  display: inline-block;
  background: #e8f4ee;
  color: #0A4A2E;
  font-size: 12px;
  font-weight: 700;
  padding: 4px 10px;
  border-radius: 6px;
  margin-bottom: 12px;
  align-self: flex-start;
}
.ih-hub-title {
  font-size: 21px;
  font-weight: 800;
  color: #0f172a;
  margin: 0 0 10px;
  display: flex;
  align-items: center;
  gap: 10px;
}
.ih-hub-areas {
  font-size: 13.5px;
  color: #64748b;
  margin-bottom: 14px;
  line-height: 1.5;
}
.ih-hub-desc {
  font-size: 14.5px;
  color: #334155;
  line-height: 1.6;
  margin-bottom: 18px;
}
.ih-hub-programs {
  margin: 0 0 22px;
  padding: 0;
  list-style: none;
}
.ih-hub-programs li {
  font-size: 13.5px;
  color: #1e293b;
  padding: 5px 0;
  display: flex;
  align-items: center;
  gap: 8px;
  border-bottom: 1px dashed #f1f5f9;
}
.ih-hub-programs li::before {
  content: "✔";
  color: #16a34a;
  font-weight: bold;
}
.ih-hub-btn {
  margin-top: auto;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  background: #0A4A2E;
  color: #fff;
  font-weight: 700;
  font-size: 14.5px;
  padding: 12px 18px;
  border-radius: 10px;
  text-decoration: none;
  transition: background .2s;
}
.ih-hub-btn:hover {
  background: #062b1b;
}

/* Comparison Table Section */
.ih-compare-section {
  padding: 60px 0;
  background: #fff;
}
.ih-table-wrap {
  overflow-x: auto;
  border-radius: 12px;
  border: 1px solid #e2e8f0;
}
.ih-table {
  width: 100%;
  border-collapse: collapse;
  text-align: left;
  font-size: 14.5px;
}
.ih-table th {
  background: #0A4A2E;
  color: #fff;
  padding: 14px 18px;
  font-weight: 700;
}
.ih-table td {
  padding: 14px 18px;
  border-bottom: 1px solid #f1f5f9;
  color: #334155;
}
.ih-table tr:nth-child(even) td {
  background: #f8fafc;
}
.ih-table .highlight {
  color: #0A4A2E;
  font-weight: 700;
}

/* Steps Process Section */
.ih-steps-section {
  padding: 60px 0;
  background: #f1f5f9;
}
.ih-steps-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: 20px;
}
.ih-step-card {
  background: #fff;
  border-radius: 12px;
  padding: 24px;
  border: 1px solid #e2e8f0;
}
.ih-step-num {
  width: 38px;
  height: 38px;
  background: #0A4A2E;
  color: #fff;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 800;
  font-size: 16px;
  margin-bottom: 14px;
}
.ih-step-card h3 {
  font-size: 17px;
  font-weight: 700;
  color: #0f172a;
  margin: 0 0 8px;
}
.ih-step-card p {
  font-size: 13.5px;
  color: #475569;
  line-height: 1.55;
  margin: 0;
}
</style>
</head>
<body>

<?php require dirname(__DIR__) . '/includes/navbar.php'; ?>

<main>
<!-- HERO -->
<section class="ih-hero">
  <div class="container">
    <div class="ih-badge">🏢 Solusi Korporasi &amp; Industri</div>
    <h1>In-House Training K3 &amp; Sertifikasi On-Site di Lokasi Perusahaan Anda</h1>
    <p class="lead">Latih seluruh tim kerja, pengawas, dan operator secara serentak langsung di site/fasilitas industri Anda. Sertifikasi resmi Kemnaker RI &amp; BNSP dengan biaya lebih efisien, kurikulum berbasis risiko riil, dan jadwal tanpa menghentikan shift produksi.</p>
    <div class="ih-hero-cta">
      <a href="<?= $wa_quote_url ?>" class="ih-btn-wa" target="_blank" rel="noopener">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
        Minta Proposal In-House (24 Jam)
      </a>
      <a href="#regional-hubs" class="ih-btn-secondary">
        Lihat Hub Koridor Regional &darr;
      </a>
    </div>
  </div>
</section>

<!-- REGIONAL HUBS CARDS -->
<section id="regional-hubs" class="ih-hubs-wrap">
  <div class="container">
    <div class="ih-section-title">
      <p class="eyebrow">Hub Regional Strategis</p>
      <h2>Pusat Mobilisasi Pelatihan In-House Sektoral</h2>
      <p style="color:#64748b;font-size:15px;margin-top:8px;">Wahana Totalita menyediakan tim instruktur dan asesor bersertifikasi yang siap ditugaskan langsung ke koridor industri dan tambang strategis di Indonesia.</p>
    </div>

    <div class="ih-hubs-grid">
      <?php foreach ($regional_hubs as $hub): ?>
      <div class="ih-hub-card">
        <span class="ih-hub-badge"><?= e($hub['badge']) ?></span>
        <h3 class="ih-hub-title"><?= $hub['icon'] ?> <?= e($hub['title']) ?></h3>
        <div class="ih-hub-areas"><strong>Cakupan Area:</strong> <?= e($hub['areas']) ?></div>
        <p class="ih-hub-desc"><?= e($hub['desc']) ?></p>
        <ul class="ih-hub-programs">
          <?php foreach ($hub['programs'] as $prog): ?>
          <li><?= e($prog) ?></li>
          <?php endforeach; ?>
        </ul>
        <a href="<?= e($hub['url']) ?>" class="ih-hub-btn">Pelajari Detail Hub &amp; Penawaran &rarr;</a>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- COMPARISON: IN-HOUSE VS PUBLIC -->
<section class="ih-compare-section">
  <div class="container">
    <div class="ih-section-title">
      <p class="eyebrow">Efisiensi Anggaran &amp; Operasional</p>
      <h2>Mengapa In-House Training Lebih Menguntungkan untuk Korporasi?</h2>
    </div>

    <div class="ih-table-wrap">
      <table class="ih-table">
        <thead>
          <tr>
            <th style="width:25%;">Parameter Evaluasi</th>
            <th style="width:37.5%;background:#083823;">In-House Training (Di Lokasi Perusahaan)</th>
            <th style="width:37.5%;background:#374151;">Public Training (Karyawan Dikirim Keluar)</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><strong>Biaya per Peserta</strong></td>
            <td class="highlight">Hemat 30% – 50% untuk rombongan minimal 5–10 orang</td>
            <td>Tarif reguler penuh per kepala tanpa diskon volume</td>
          </tr>
          <tr>
            <td><strong>Biaya Tiket &amp; Penginapan</strong></td>
            <td class="highlight">Hanya menanggung akomodasi 1–2 instruktur</td>
            <td>Perusahaan menanggung tiket, hotel, &amp; SPPD seluruh karyawan</td>
          </tr>
          <tr>
            <td><strong>Gangguan Operasional</strong></td>
            <td class="highlight">Nol downtime: jadwal diatur fleksibel sesuai shift kerja</td>
            <td>Produksi terganggu karena karyawan meninggalkan lokasi kerja</td>
          </tr>
          <tr>
            <td><strong>Relevansi Materi</strong></td>
            <td class="highlight">Studi kasus &amp; praktik menggunakan alat dan SOP perusahaan nyata</td>
            <td>Studi kasus generik dan simulator standar</td>
          </tr>
          <tr>
            <td><strong>Kerahasiaan Data (NDA)</strong></td>
            <td class="highlight">Aman. Diskusi temuan audit &amp; hazard hanya di lingkup internal</td>
            <td>Peserta bercampur dengan praktisi dari perusahaan kompetitor</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

<!-- 4 STEPS TO B2B PROCUREMENT -->
<section class="ih-steps-section">
  <div class="container">
    <div class="ih-section-title">
      <p class="eyebrow">Alur Pengadaan Cepat</p>
      <h2>4 Langkah Pelaksanaan In-House Training</h2>
    </div>

    <div class="ih-steps-grid">
      <div class="ih-step-card">
        <div class="ih-step-num">1</div>
        <h3>Konsultasi &amp; TNA</h3>
        <p>Sampaikan jumlah personel, target sertifikasi (Kemnaker/BNSP), serta kebutuhan khusus terkait shift kerja Anda via WhatsApp.</p>
      </div>
      <div class="ih-step-card">
        <div class="ih-step-num">2</div>
        <h3>Proposal &amp; Penawaran (24 Jam)</h3>
        <p>Kami mengirimkan dokumen teknis, profil instruktur, silabus modul, dan penawaran harga korporat resmi lengkap dengan NPWP &amp; legalitas PJK3.</p>
      </div>
      <div class="ih-step-card">
        <div class="ih-step-num">3</div>
        <h3>Mobilisasi &amp; Pelaksanaan</h3>
        <p>Instruktur senior dan asesor hadir di site/pabrik Anda untuk sesi teori, simulasi bahaya, dan uji praktik on-site sesuai SOP industri.</p>
      </div>
      <div class="ih-step-card">
        <div class="ih-step-num">4</div>
        <h3>Sertifikasi &amp; Laporan</h3>
        <p>Peserta yang lulus menerima sertifikat resmi ber-SKP/barcode, disertai laporan evaluasi hasil pelatihan untuk arsip manajemen.</p>
      </div>
    </div>
  </div>
</section>

<!-- FAQ -->
<section class="section-faq" style="padding:60px 0;background:#fff;">
  <div class="container">
    <div class="ih-section-title">
      <p class="eyebrow">FAQ Korporasi</p>
      <h2>Pertanyaan Umum Seputar In-House Training</h2>
    </div>
    <div class="faq-grid" style="max-width:860px;margin:0 auto;">
      <?php foreach ($faqs as $f): ?>
      <div class="faq-item">
        <button class="faq-question" onclick="this.closest('.faq-item').classList.toggle('open')">
          <span><?= e($f['q']) ?></span>
          <span class="faq-icon">+</span>
        </button>
        <div class="faq-answer"><p><?= e($f['a']) ?></p></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- FINAL B2B CTA -->
<section style="background:#0A4A2E;color:#fff;padding:50px 0;text-align:center;">
  <div class="container">
    <h2 style="color:#fff;font-size:28px;margin-bottom:12px;">Siap Mengadakan In-House Training di Perusahaan Anda?</h2>
    <p style="color:#d1fae5;font-size:16px;max-width:640px;margin:0 auto 24px;">Hubungi Account Executive Wahana Totalita sekarang untuk konsultasi jadwal, kustomisasi silabus, dan penawaran harga korporat dalam 1x24 jam.</p>
    <a href="<?= $wa_quote_url ?>" class="ih-btn-wa" target="_blank" rel="noopener" style="font-size:16px;padding:14px 32px;">
      Hubungi via WhatsApp (+62 877-5915-1278)
    </a>
  </div>
</section>

</main>

<?php require dirname(__DIR__) . '/includes/footer.php'; ?>
<script src="/assets/js/main.js" defer></script>
</body>
</html>
