<?php
/**
 * in-house/balikpapan-ikn.php — B2B Regional Enterprise Hub
 * Clean URL: /in-house-training/balikpapan-ikn/
 * Regional Focus: Kalimantan Timur (Balikpapan, IKN Nusantara / Sepaku, Samarinda, Kutai Kartanegara, Samboja)
 * Industry Focus: Pertambangan Batubara/Mineral, Minyak & Gas Bumi (Migas), Konstruksi EPC Infrastruktur IKN
 */
require_once dirname(__DIR__) . '/config.php';

$s = get_all_settings();
$wa_number  = '6287759151278';
$meta_title = 'In-House Training K3 Balikpapan & IKN: Sertifikasi Tambang POP/POM, Rigging & Migas | Wahana Totalita';
$meta_desc  = 'Layanan in-house training K3 resmi Kemnaker RI & BNSP di Balikpapan, Sepaku (IKN), Samarinda & Kutai. Sertifikasi POP/POM tambang, rigger crane, confined space & K3 konstruksi. Mobilisasi instruktur ke site.';
$page_url   = SITE_URL . '/in-house-training/balikpapan-ikn/';

$wa_msg = 'Halo Wahana Totalita, kami dari perusahaan ingin meminta penawaran in-house training K3 & sertifikasi on-site di area Balikpapan / IKN Kalimantan Timur.';
$wa_quote_url = wa_url($wa_msg, $wa_number);

$faqs = [
    [
        'q' => 'Bagaimana prosedur mobilisasi instruktur dan asesor Wahana Totalita ke site tambang/proyek di Kaltim?',
        'a' => 'Tim instruktur PJK3 dan asesor BNSP kami dimobilisasi melalui Bandara Internasional SAMS Sepinggan Balikpapan dan dilanjutkan perjalanan darat ke lokasi site (Balikpapan, Sepaku/IKN, Samboja, Samarinda, hingga Sangatta). Instruktur kami memiliki sertifikat MCU fit-to-work dan siap mengikuti site safety induction sesuai standar CSMS perusahaan Anda.'
    ],
    [
        'q' => 'Apakah sertifikasi Pengawas Operasional Pertama (POP) dan Madya (POM) diakui Inspektur Tambang KESDM?',
        'a' => 'Ya, 100% diakui. Sertifikasi POP dan POM diselenggarakan melalui skema resmi BNSP dan LSP Terlisensi sesuai regulasi Keputusan Menteri ESDM No. 1827 K/30/MEM/2018. Sertifikat ini memiliki registrasi resmi yang sah untuk penunjukan KTT, PTL, dan pengawas operasional legal di seluruh wilayah pertambangan Indonesia.'
    ],
    [
        'q' => 'Apakah praktik uji kompetensi Rigger dan Crane dapat menggunakan unit alat berat di workshop/yard kami?',
        'a' => 'Bisa dan sangat dianjurkan. Pada skema in-house training sertifikasi Kemnaker RI (Permenaker No. 08/2020), sesi asesmen praktik lapangan dilakukan langsung menggunakan mobile crane, overhead crane, atau alat rigging yang sudah memiliki riksa uji (SIA/Sertifikat Kelayakan Alat) yang berlaku di fasilitas klien.'
    ],
    [
        'q' => 'Berapa hari waktu yang dibutuhkan untuk proses proposal dan penjadwalan di IKN?',
        'a' => 'Dokumen proposal teknis, CV instruktur, silabus, dan penawaran biaya resmi kami terbitkan dalam 1x24 jam kerja setelah rincian jumlah peserta dan target sertifikasi diterima. Tanggal pelaksanaan dapat dikunci 1–2 minggu sebelum kegiatan untuk koordinasi tiket dan logistik site.'
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
            'availableLanguage' => ['Indonesian', 'English']
        ]
    ],
    [
        '@type' => 'BreadcrumbList',
        '@id'   => $page_url . '#breadcrumb',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => SITE_URL . '/'],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'In-House Training', 'item' => SITE_URL . '/in-house-training/'],
            ['@type' => 'ListItem', 'position' => 3, 'name' => 'Balikpapan & IKN', 'item' => $page_url]
        ]
    ],
    [
        '@type'        => 'Service',
        '@id'          => $page_url . '#service',
        'name'         => 'In-House Training K3 & Sertifikasi Site Balikpapan & IKN',
        'provider'     => ['@id' => SITE_URL . '/#organization'],
        'serviceType'  => 'Mining, Oil & Gas, and Heavy EPC Safety Certification',
        'description'  => $meta_desc,
        'areaServed'   => [
            ['@type' => 'City', 'name' => 'Balikpapan'],
            ['@type' => 'AdministrativeArea', 'name' => 'Ibu Kota Nusantara (IKN)'],
            ['@type' => 'City', 'name' => 'Samarinda'],
            ['@type' => 'AdministrativeArea', 'name' => 'Kalimantan Timur']
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

<link rel="stylesheet" href="<?= asset_v('/assets/css/style.css') ?>">
<link rel="stylesheet" href="<?= asset_v('/assets/css/additions.css') ?>">
<style>
/* Dedicated Regional Enterprise Hub Styles */
.reg-hero {
  background: linear-gradient(135deg, #041f14 0%, #0A4A2E 55%, #184d36 100%);
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
  background: linear-gradient(90deg, #E8611A, #25D366);
}
.reg-badge-top {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: rgba(232, 97, 26, 0.2);
  border: 1px solid rgba(232, 97, 26, 0.4);
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
  color: #d1fae5;
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
  color: #0A4A2E;
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
  color: #E8611A;
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
  border-left: 4px solid #0A4A2E;
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
    <div class="reg-badge-top">⛏️ Koridor Kaltim &amp; Ibu Kota Nusantara</div>
    <h1>In-House Training K3 Balikpapan &amp; IKN: Sertifikasi Tambang, Rigging &amp; Migas On-Site</h1>
    <p class="lead">Solusi sertifikasi kepatuhan resmi Kemnaker RI &amp; BNSP untuk perusahaan tambang batubara/mineral, kontraktor migas, dan pelaksana mega-proyek EPC di Balikpapan, Sepaku (IKN Nusantara), Samarinda, dan Kutai Kartanegara. Instruktur kami dimobilisasi langsung ke lokasi site/mess operasional Anda.</p>
    <div class="reg-cta-row">
      <a href="<?= $wa_quote_url ?>" class="reg-btn-wa" target="_blank" rel="noopener">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
        Minta Proposal Kaltim &amp; IKN (24 Jam)
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
        <strong>Akses Poin Mobilisasi</strong>
        Bandara SAMS Sepinggan (BPN) &amp; Tol Balikpapan-Samarinda
      </div>
      <div class="reg-logistics-item">
        <strong>Kepatuhan Standar Regulasi</strong>
        Kepmen ESDM 1827/2018 &amp; Permenaker RI
      </div>
      <div class="reg-logistics-item">
        <strong>Kualifikasi Instruktur Site</strong>
        Praktisi Senior Migas/Tambang 10+ Thn &amp; Asesor BNSP
      </div>
      <div class="reg-logistics-item">
        <strong>Kesiapan Dokumen CSMS</strong>
        Medical Check-Up (MCU) Fit, Induksi Site, Faktur Pajak Resmi
      </div>
    </div>
  </div>
</div>

<!-- MAIN PROGRAMS GRID -->
<section class="reg-content-sec">
  <div class="container">
    <div style="max-width:760px;">
      <p style="color:#0A4A2E;font-weight:700;font-size:13.5px;letter-spacing:.08em;text-transform:uppercase;margin-bottom:8px;">Program Prioritas In-House</p>
      <h2 style="font-size:clamp(22px,3vw,30px);color:#0f172a;font-weight:800;margin:0 0 12px;">Sertifikasi Kepatuhan Industri Tambang, Migas &amp; Proyek IKN</h2>
      <p style="color:#64748b;font-size:15px;line-height:1.6;">Dirancang khusus untuk memenuhi standar audit keselamatan pertambangan (SMKP), pra-kualifikasi tender CSMS Pertamina/Chevron/Total, dan keselamatan konstruksi gedung bertingkat/jembatan IKN Nusantara.</p>
    </div>

    <div class="reg-card-grid">
      <!-- Card 1 -->
      <div class="reg-prog-card">
        <span class="reg-prog-cert">BNSP &amp; KESDM</span>
        <h3>Pengawas Operasional Tambang (POP &amp; POM)</h3>
        <p>Sertifikasi kompetensi wajib Kepmen ESDM No. 1827 K/30/MEM/2018 untuk pengawas lini depan (foreman/supervisor) dan pengawas madya di tambang batubara/mineral.</p>
        <ul class="reg-prog-topics">
          <li>Pelaksanaan inspeksi pit &amp; hauling road</li>
          <li>Investigasi kecelakaan tambang &amp; JSA</li>
          <li>Safety talk &amp; implementasi kaidah teknis minerba</li>
          <li>Uji kompetensi on-site di mess/site klien</li>
        </ul>
      </div>

      <!-- Card 2 -->
      <div class="reg-prog-card">
        <span class="reg-prog-cert">KEMNAKER RI</span>
        <h3>Rigger &amp; Operator Pesawat Angkat (Crane)</h3>
        <p>Sertifikasi resmi Permenaker No. 08/2020 untuk personel juru ikat beban (rigger), operator mobile crane, crawler crane, dan boom truck di yard migas/tambang.</p>
        <ul class="reg-prog-topics">
          <li>Kalkulasi beban kerja aman (Safe Working Load / SWL)</li>
          <li>Sinyal tangan standar rigging internasional</li>
          <li>Pemeriksaan tali kawat baja, webbing sling, &amp; shackle</li>
          <li>Praktik pengangkatan langsung di site perusahaan</li>
        </ul>
      </div>

      <!-- Card 3 -->
      <div class="reg-prog-card">
        <span class="reg-prog-cert">KEMNAKER RI</span>
        <h3>K3 Ruang Terbatas (Confined Space)</h3>
        <p>Pelatihan Petugas Masuk (Entrant) dan Petugas Madya Ruang Terbatas untuk pembersihan storage tank migas, silo batubara, tangki ponton, dan terowongan drainase.</p>
        <ul class="reg-prog-topics">
          <li>Pengujian atmosfer gas beracun &amp; kekurangan oksigen</li>
          <li>Sistem izin kerja (Work Permit) &amp; isolasi LOTO</li>
          <li>Simulasi evakuasi darurat &amp; penggunaan SCBA</li>
          <li>Sertifikat resmi Kemnaker RI ber-SKP</li>
        </ul>
      </div>

      <!-- Card 4 -->
      <div class="reg-prog-card">
        <span class="reg-prog-cert">KEMNAKER RI &amp; BNSP</span>
        <h3>Ahli K3 Konstruksi Spesialis Mega-Proyek IKN</h3>
        <p>Ditujukan bagi konsorsium kontraktor BUMN &amp; swasta pelaksana proyek gedung kementerian, jalan tol, dan instalasi air di kawasan IKN Sepaku.</p>
        <ul class="reg-prog-topics">
          <li>Penyusunan Rencana Keselamatan Konstruksi (RKK)</li>
          <li>Mitigasi bahaya galian dalam &amp; kestabilan lereng</li>
          <li>K3 Ketinggian (TKBT/TKPK) untuk ereksi struktur</li>
          <li>Pemenuhan audit kepatuhan Kementerian PUPR</li>
        </ul>
      </div>
    </div>

    <!-- MOBILIZATION SPECIFICATIONS -->
    <div class="reg-specs-box">
      <h3>Ketentuan Operasional &amp; Logistik Mobilisasi Kaltim</h3>
      <p style="color:#64748b;font-size:14.5px;line-height:1.6;">Untuk memastikan kelancaran administrasi procurement korporasi, berikut protokol mobilisasi in-house Wahana Totalita di Kalimantan Timur:</p>
      <div class="reg-specs-list">
        <div class="reg-spec-item">
          <h4>✈️ Mobilisasi &amp; Transport</h4>
          <p>Flight instruktur via Bandara Balikpapan (BPN). Transport darat ke site IKN (±2 jam via tol) atau Sangatta/Kutai dikoordinasikan transparan dalam proposal.</p>
        </div>
        <div class="reg-spec-item">
          <h4>📋 Kesiapan Safety Induction</h4>
          <p>Instruktur telah siap dengan MCU Fit to Work dan dokumen pendukung sesuai regulasi CSMS tambang/migas Anda sebelum masuk gate site.</p>
        </div>
        <div class="reg-spec-item">
          <h4>⏱️ Fleksibilitas Shift Pit</h4>
          <p>Materi teori diatur pagi atau malam sesuai rotasi shift kerja lapangan, menjamin nol jam kerja yang terbuang sia-sia.</p>
        </div>
        <div class="reg-spec-item">
          <h4>🏢 Legalitas Faktur &amp; Pajak</h4>
          <p>NPWP Badan resmi, faktur pajak PPN terbit tepat waktu, dan invoice berjangka (Term of Payment) sesuai ketentuan vendor management Anda.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FAQ -->
<section class="section-faq" style="padding:56px 0;background:#fff;">
  <div class="container">
    <div style="text-align:center;max-width:700px;margin:0 auto 36px;">
      <p style="color:#0A4A2E;font-weight:700;font-size:13.5px;letter-spacing:.08em;text-transform:uppercase;margin-bottom:8px;">FAQ Site Balikpapan &amp; IKN</p>
      <h2 style="font-size:clamp(22px,3vw,30px);color:#0f172a;font-weight:800;">Pertanyaan Seputar In-House Training di Kaltim</h2>
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
<section style="background:#041f14;color:#fff;padding:50px 0;text-align:center;">
  <div class="container">
    <h2 style="color:#fff;font-size:26px;margin-bottom:12px;">Butuh Pelatihan In-House di Balikpapan, Sepaku atau Samarinda?</h2>
    <p style="color:#d1fae5;font-size:15.5px;max-width:620px;margin:0 auto 24px;">Diskusikan jadwal dan jumlah personel Anda langsung dengan Technical Advisor Wahana Totalita via WhatsApp. Proposal resmi kami terbitkan dalam 24 jam.</p>
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
