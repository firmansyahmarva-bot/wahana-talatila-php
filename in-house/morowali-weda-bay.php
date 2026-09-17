<?php
/**
 * in-house/morowali-weda-bay.php — B2B Regional Enterprise Hub
 * Clean URL: /in-house-training/morowali-weda-bay/
 * Regional Focus: Sulawesi Tengah & Maluku Utara (IMIP Morowali, IWIP Halmahera Tengah, VDNI Konawe)
 * Industry Focus: Smelter Nikel RKEF, Pabrik HPAL Baterai EV, Captive Power Plant, Juru Las & Pemeliharaan Tanur
 */
require_once dirname(__DIR__) . '/config.php';

$s = get_all_settings();
$wa_number  = '6287759151278';
$meta_title = 'In-House Training K3 Morowali & Weda Bay: Smelter Nikel, Welder & Confined Space | Wahana Totalita';
$meta_desc  = 'Layanan in-house training K3 & sertifikasi on-site di Kawasan IMIP Morowali, IWIP Weda Bay & VDNI Konawe. Sertifikasi Juru Las (Welder BNSP), K3 Confined Space Tanur, Overhead Crane & SMK3.';
$page_url   = SITE_URL . '/in-house-training/morowali-weda-bay/';

$wa_msg = 'Halo Wahana Totalita, kami dari manajemen smelter/perusahaan ingin meminta proposal in-house training K3 & sertifikasi on-site di area Morowali / Weda Bay.';
$wa_quote_url = wa_url($wa_msg, $wa_number);

$faqs = [
    [
        'q' => 'Bagaimana tim Wahana Totalita melakukan mobilisasi ke kawasan remote seperti Bahodopi Morowali atau Weda Bay Halmahera?',
        'a' => 'Instruktur dan asesor PJK3 kami berpengalaman menempuh rute mobilisasi remote site: penerbangan ke Bandara Kendari (KDI) / Luwuk (LUW) dilanjutkan transportasi darat/speedboat ke Morowali, atau penerbangan ke Ternate (TTE) dilanjutkan penyeberangan laut ke Teluk Weda. Semua kebutuhan akomodasi camp dan tiket transit terinci rapi dalam proposal penawaran kami.'
    ],
    [
        'q' => 'Apakah Wahana Totalita memfasilitasi komunikasi dan materi dengan ekspatriat / manajemen TKA?',
        'a' => 'Ya. Mengingat sebagian besar kawasan smelter di Morowali dan Weda Bay melibatkan investor asing, kami menyediakan tim yang dapat memfasilitasi technical briefing bilingual serta ringkasan kepatuhan regulasi Kemnaker RI dalam bahasa Mandarin (tersedia juga hub panduan khusus di /zh/in-house-training/).'
    ],
    [
        'q' => 'Apakah sertifikasi Juru Las (Welder) diuji langsung di workshop fabrikasi smelter?',
        'a' => 'Ya, uji pengelasan (3G, 4G, 6G SMAW/GTAW) diselenggarakan langsung di fasilitas workshop smelter klien, dilanjutkan pengujian visual dan Non-Destructive Testing (NDT) / Radiographic Testing sesuai standar SKKNI BNSP atau lisensi resmi Kemnaker RI.'
    ],
    [
        'q' => 'Mengapa pelatihan K3 Confined Space sangat krusial untuk pemeliharaan tanur smelter?',
        'a' => 'Operasional smelter RKEF dan HPAL memiliki risiko fatalitas tinggi saat proses maintenance tanur (furnace), boiler batubara, scrubber, dan tangki asam sulfat (kekurangan O2, gas CO/SO2, dan bahaya terperangkap). Pelatihan kami melatih teknisi entrant dan standby person prosedur penyelamatan (rescue) nyata dengan peralatan SCBA.'
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
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'In-House Training', 'item' => SITE_URL . '/in-house-training/'],
            ['@type' => 'ListItem', 'position' => 3, 'name' => 'Morowali & Weda Bay', 'item' => $page_url]
        ]
    ],
    [
        '@type'        => 'Service',
        '@id'          => $page_url . '#service',
        'name'         => 'In-House Training K3 Smelter Nikel Morowali & Weda Bay',
        'provider'     => ['@id' => SITE_URL . '/#organization'],
        'serviceType'  => 'Nickel Smelter, Pyrometallurgy, HPAL, and Industrial Welding Safety Certification',
        'description'  => $meta_desc,
        'areaServed'   => [
            ['@type' => 'AdministrativeArea', 'name' => 'Morowali (Sulawesi Tengah)'],
            ['@type' => 'AdministrativeArea', 'name' => 'Halmahera Tengah / Weda Bay (Maluku Utara)'],
            ['@type' => 'AdministrativeArea', 'name' => 'Konawe (Sulawesi Tenggara)']
        ],
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

<link rel="stylesheet" href="/assets/css/style.css">
<link rel="stylesheet" href="/assets/css/additions.css">
<style>
/* Dedicated Regional Enterprise Hub Styles */
.reg-hero {
  background: linear-gradient(135deg, #240c02 0%, #7c2d12 40%, #0A4A2E 100%);
  color: #fff;
  padding: 56px 0 46px;
  position: relative;
  overflow: hidden;
}
.reg-hero::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  height: 5px;
  background: linear-gradient(90deg, #F97316, #22C55E);
}
.reg-badge-top {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: rgba(249, 115, 22, 0.25);
  border: 1px solid rgba(249, 115, 22, 0.5);
  color: #fed7aa;
  font-size: 13px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: .06em;
  padding: 6px 14px;
  border-radius: 99px;
  margin-bottom: 18px;
}
.reg-hero h1 {
  font-size: clamp(26px, 3.8vw, 40px);
  font-weight: 800;
  line-height: 1.25;
  color: #fff;
  max-width: 880px;
  margin: 0 0 16px;
}
.reg-hero p.lead {
  font-size: clamp(15.5px, 1.7vw, 17.5px);
  color: #ffedd5;
  line-height: 1.6;
  max-width: 800px;
  margin: 0 0 26px;
}
.reg-cta-row {
  display: flex;
  gap: 14px;
  flex-wrap: wrap;
}
.reg-btn-wa {
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
.reg-btn-wa:hover {
  background: #20ba5a;
  transform: translateY(-2px);
}
.reg-btn-back {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: rgba(255,255,255,0.1);
  color: #fff;
  border: 1px solid rgba(255,255,255,0.25);
  font-weight: 600;
  font-size: 14.5px;
  padding: 13px 20px;
  border-radius: 10px;
  text-decoration: none;
}

/* Regional Overview Details */
.reg-logistics-bar {
  background: #0f172a;
  color: #cbd5e1;
  padding: 20px 0;
  font-size: 14px;
  border-bottom: 1px solid #1e293b;
}
.reg-logistics-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 20px;
}
.reg-logistics-item strong {
  display: block;
  color: #f8fafc;
  margin-bottom: 3px;
  font-size: 14.5px;
}

/* Programs Section */
.reg-content-sec {
  padding: 56px 0;
  background: #f8fafc;
}
.reg-card-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
  gap: 24px;
  margin-top: 32px;
}
.reg-prog-card {
  background: #fff;
  border: 1px solid #e2e8f0;
  border-radius: 14px;
  padding: 26px;
  display: flex;
  flex-direction: column;
  box-shadow: 0 4px 14px rgba(0,0,0,0.03);
}
.reg-prog-cert {
  font-size: 12px;
  font-weight: 700;
  background: #f1f5f9;
  color: #c2410c;
  padding: 4px 10px;
  border-radius: 6px;
  align-self: flex-start;
  margin-bottom: 12px;
}
.reg-prog-card h3 {
  font-size: 18.5px;
  font-weight: 800;
  color: #0f172a;
  margin: 0 0 10px;
  line-height: 1.35;
}
.reg-prog-card p {
  font-size: 14px;
  color: #475569;
  line-height: 1.55;
  margin: 0 0 14px;
}
.reg-prog-topics {
  margin: 0 0 18px;
  padding: 0;
  list-style: none;
  font-size: 13.5px;
}
.reg-prog-topics li {
  padding: 4px 0;
  color: #334155;
  display: flex;
  align-items: center;
  gap: 7px;
}
.reg-prog-topics li::before {
  content: "•";
  color: #ea580c;
  font-size: 18px;
  line-height: 0;
}

/* Mobilization Specs Section */
.reg-specs-box {
  background: #fff;
  border: 1px solid #e2e8f0;
  border-radius: 14px;
  padding: 34px;
  margin: 40px 0 0;
  box-shadow: 0 4px 16px rgba(0,0,0,0.03);
}
.reg-specs-box h3 {
  font-size: 21px;
  color: #0f172a;
  margin: 0 0 16px;
  font-weight: 800;
}
.reg-specs-list {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 18px;
  margin-top: 14px;
}
.reg-spec-item {
  background: #f8fafc;
  padding: 16px 20px;
  border-radius: 10px;
  border-left: 4px solid #c2410c;
}
.reg-spec-item h4 {
  font-size: 15px;
  color: #0f172a;
  margin: 0 0 6px;
}
.reg-spec-item p {
  font-size: 13.5px;
  color: #64748b;
  margin: 0;
  line-height: 1.5;
}
</style>
</head>
<body>

<?php require dirname(__DIR__) . '/includes/navbar.php'; ?>

<main>
<!-- HERO -->
<section class="reg-hero">
  <div class="container">
    <div class="reg-badge-top">🔥 Koridor Smelter Nikel &amp; Remote Industrial Site</div>
    <h1>In-House Training K3 Morowali &amp; Weda Bay: Smelter Nikel, Welder &amp; Confined Space</h1>
    <p class="lead">Solusi sertifikasi kepatuhan hukum dan keselamatan kerja on-site untuk industri smelter nikel RKEF, pabrik HPAL, dan pembangkit listrik captive di Kawasan Industri IMIP Morowali (Bahodopi), IWIP Weda Bay (Halmahera Tengah), dan VDNI/OSS Konawe. Instruktur PJK3 resmi hadir langsung di site Anda.</p>
    <div class="reg-cta-row">
      <a href="<?= $wa_quote_url ?>" class="reg-btn-wa" target="_blank" rel="noopener">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
        Minta Proposal Morowali &amp; Weda Bay (24 Jam)
      </a>
      <a href="/in-house-training/" class="reg-btn-back">
        &larr; Kembali ke Direktori In-House
      </a>
    </div>
  </div>
</section>

<!-- LOGISTICS BAR -->
<div class="reg-logistics-bar">
  <div class="container">
    <div class="reg-logistics-grid">
      <div class="reg-logistics-item">
        <strong>Akses Remote Site Terbukti</strong>
        Penerbangan perintis &amp; logistik penyeberangan Bahodopi / Halmahera
      </div>
      <div class="reg-logistics-item">
        <strong>Dukungan Bahasa &amp; Regulasi</strong>
        Teknis bilingual (ID-CN) untuk menjembatani compliance Kemnaker
      </div>
      <div class="reg-logistics-item">
        <strong>Pencegahan Fatalitas Smelter</strong>
        Fokus mitigasi ledakan furnace, gas beracun, &amp; confined space
      </div>
      <div class="reg-logistics-item">
        <strong>Kepatuhan Audit ESDM / Kemnaker</strong>
        Sertifikasi sah untuk inspeksi Pengawas Ketenagakerjaan resmi
      </div>
    </div>
  </div>
</div>

<!-- MAIN PROGRAMS GRID -->
<section class="reg-content-sec">
  <div class="container">
    <div style="max-width:760px;">
      <p style="color:#c2410c;font-weight:700;font-size:13.5px;letter-spacing:.08em;text-transform:uppercase;margin-bottom:8px;">Program Spesifik Smelter</p>
      <h2 style="font-size:clamp(22px,3vw,30px);color:#0f172a;font-weight:800;margin:0 0 12px;">Sertifikasi Kepatuhan &amp; Keterampilan Kritis Smelter Nikel</h2>
      <p style="color:#64748b;font-size:15px;line-height:1.6;">Menjawab tingginya risiko kecelakaan kerja di lini pyrometallurgy dan hydrometallurgy, serta memenuhi standar audit keselamatan kerja Kementerian ESDM dan Kementerian Ketenagakerjaan RI.</p>
    </div>

    <div class="reg-card-grid">
      <!-- Card 1 -->
      <div class="reg-prog-card">
        <span class="reg-prog-cert">BNSP &amp; KEMNAKER</span>
        <h3>Juru Las / Welder Fabrikasi Smelter (3G, 4G, 6G)</h3>
        <p>Sertifikasi pengelasan berkualifikasi tinggi untuk instalasi dan maintenance pipa steam bertekanan tinggi, ducting gas buang, dan tangki reaktor lelehan nikel.</p>
        <ul class="reg-prog-topics">
          <li>Pengelasan proses SMAW, GTAW (Argon), &amp; FCAW</li>
          <li>Kualifikasi posisi plat (1G–4G) dan pipa (5G, 6G)</li>
          <li>Uji visual dan NDT (Non-Destructive Testing) langsung di workshop</li>
          <li>Sertifikat Kompetensi BNSP &amp; Lisensi K3 Juru Las Kemnaker</li>
        </ul>
      </div>

      <!-- Card 2 -->
      <div class="reg-prog-card">
        <span class="reg-prog-cert">KEMNAKER RI</span>
        <h3>K3 Ruang Terbatas (Confined Space) Tanur &amp; Tangki Asam</h3>
        <p>Khusus personel maintenance furnace kiln, precipitator, baghouse, dan tangki asam sulfat pada unit HPAL dengan potensi gas SO2, CO, dan defisiensi oksigen.</p>
        <ul class="reg-prog-topics">
          <li>Prosedur isolasi energi &amp; Lockout-Tagout (LOTO)</li>
          <li>Pengukuran atmosfer berbahaya dengan Multi-Gas Detector</li>
          <li>Simulasi evakuasi darurat &amp; teknik pernapasan SCBA</li>
          <li>Sertifikat Petugas Madya &amp; Utama Ruang Terbatas Kemnaker</li>
        </ul>
      </div>

      <!-- Card 3 -->
      <div class="reg-prog-card">
        <span class="reg-prog-cert">KEMNAKER RI</span>
        <h3>Overhead Crane &amp; Operator Handling Ladle Cair</h3>
        <p>Sertifikasi operator crane Permenaker No. 08/2020 untuk pengangkatan ladle lelehan ferronickel cair bersuhu di atas 1.500°C di area tapping hall.</p>
        <ul class="reg-prog-topics">
          <li>Pemeriksaan tali kawat baja terhadap paparan panas ekstrem</li>
          <li>Sistem pengereman ganda dan limit switch overhead crane</li>
          <li>Prosedur darurat pencegahan tumpahan lelehan panas (spill)</li>
          <li>Lisensi K3 Operator Crane Kelas 1 / Kelas 2 Kemnaker RI</li>
        </ul>
      </div>

      <!-- Card 4 -->
      <div class="reg-prog-card">
        <span class="reg-prog-cert">PP 50/2012 &amp; DISNAKER</span>
        <h3>Audit Kepatuhan SMK3 &amp; Investigasi Insiden Smelter</h3>
        <p>Pendampingan audit sistematis SMK3 PP 50/2012 untuk manajemen smelter guna mencegah insiden fatalitas dan memenuhi rekomendasi investigasi pengawas.</p>
        <ul class="reg-prog-topics">
          <li>Review HIRADC unit smelter &amp; captive power plant</li>
          <li>Pelatihan Tim Investigasi Insiden Internal berbasis Root Cause Analysis</li>
          <li>Penyelarasan SOP operasional lokal dengan regulasi Indonesia</li>
          <li>Tersedia pendampingan laporan kepatuhan resmi</li>
        </ul>
      </div>
    </div>

    <!-- MOBILIZATION SPECIFICATIONS -->
    <div class="reg-specs-box">
      <h3>Ketentuan Operasional &amp; Logistik Mobilisasi Remote Site</h3>
      <p style="color:#64748b;font-size:14.5px;line-height:1.6;">Prosedur operasional Wahana Totalita untuk kawasan Morowali, Halmahera Tengah, dan sekitarnya:</p>
      <div class="reg-specs-list">
        <div class="reg-spec-item">
          <h4>✈️ Logistik Penerbangan &amp; Darat</h4>
          <p>Instruktur diberangkatkan dari bandara hub (Jakarta/Surabaya) menuju Luwuk/Kendari/Ternate, dilanjutkan penyeberangan site terjadwal.</p>
        </div>
        <div class="reg-spec-item">
          <h4>🌐 Dukungan Manajemen Bilingual</h4>
          <p>Materi presentasi dan ringkasan kepatuhan dapat didukung teks dwi-bahasa untuk memudahkan pemahaman manajemen ekspatriat.</p>
        </div>
        <div class="reg-spec-item">
          <h4>👷 Fasilitas Praktik di Pabrik</h4>
          <p>Seluruh ujian praktik (welder, crane, confined space) dilaksanakan pada fasilitas unit smelter milik klien yang sedang dalam siklus maintenance.</p>
        </div>
        <div class="reg-spec-item">
          <h4>📑 Dokumen Penagihan Resmi Perusahaan</h4>
          <p>Kelengkapan legalitas PJK3, Surat Penunjukan Kemnaker, faktur pajak resmi, dan kesiapan registrasi vendor korporat.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FAQ -->
<section class="section-faq" style="padding:56px 0;background:#fff;">
  <div class="container">
    <div style="text-align:center;max-width:700px;margin:0 auto 36px;">
      <p style="color:#c2410c;font-weight:700;font-size:13.5px;letter-spacing:.08em;text-transform:uppercase;margin-bottom:8px;">FAQ Site Smelter Nikel</p>
      <h2 style="font-size:clamp(22px,3vw,30px);color:#0f172a;font-weight:800;">Pertanyaan Seputar In-House Training di Morowali &amp; Weda Bay</h2>
    </div>
    <div class="faq-grid" style="max-width:840px;margin:0 auto;">
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

<!-- BOTTOM CTA -->
<section style="background:#1c1917;color:#fff;padding:50px 0;text-align:center;">
  <div class="container">
    <h2 style="color:#fff;font-size:26px;margin-bottom:12px;">Butuh Pelatihan In-House di Kawasan IMIP Morowali atau IWIP Weda Bay?</h2>
    <p style="color:#fed7aa;font-size:15.5px;max-width:640px;margin:0 auto 24px;">Konsultasikan kebutuhan sertifikasi juru las, confined space, atau audit keselamatan smelter Anda bersama tim ahli Wahana Totalita. Proposal resmi dalam 24 jam.</p>
    <a href="<?= $wa_quote_url ?>" class="reg-btn-wa" target="_blank" rel="noopener" style="font-size:15.5px;padding:14px 30px;">
      Konsultasi via WhatsApp (+62 877-5915-1278)
    </a>
  </div>
</section>

</main>

<?php require dirname(__DIR__) . '/includes/footer.php'; ?>
<script src="/assets/js/main.js" defer></script>
</body>
</html>
