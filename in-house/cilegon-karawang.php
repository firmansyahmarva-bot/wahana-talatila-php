<?php
/**
 * in-house/cilegon-karawang.php — B2B Regional Enterprise Hub
 * Clean URL: /in-house-training/cilegon-karawang/
 * Regional Focus: Koridor Banten & Jawa Barat (Cilegon, Serang, KIIC Karawang, Suryacipta, Jababeka Cikarang)
 * Industry Focus: Petrokimia, Industri Kimia Dasar, Pabrik Baja/Smelter, Manufaktur Otomotif & Pergudangan
 */
require_once dirname(__DIR__) . '/config.php';

$s = get_all_settings();
$wa_number  = '6287759151278';
$meta_title = 'In-House Training K3 Cilegon & Karawang: K3 Kimia, Boiler & Forklift | Wahana Totalita';
$meta_desc  = 'Layanan in-house training K3 resmi di kawasan industri Cilegon (KIEC) dan Karawang (KIIC/Suryacipta). Sertifikasi Petugas/Ahli K3 Kimia, Operator Boiler, Forklift & SMK3 PP 50/2012 on-site.';
$page_url   = SITE_URL . '/in-house-training/cilegon-karawang/';

$wa_msg = 'Halo Wahana Totalita, kami dari pabrik/perusahaan ingin meminta penawaran in-house training K3 Kimia / Boiler / Alat Angkat di area Cilegon / Karawang.';
$wa_quote_url = wa_url($wa_msg, $wa_number);

$faqs = [
    [
        'q' => 'Bagaimana skema in-house training jika pabrik kami beroperasi 24 jam dengan sistem continuous shift?',
        'a' => 'Kami sangat memahami karakteristik pabrik kimia dan manufaktur berat di Cilegon dan Karawang. Modul teori dan praktik dapat kami bagi menjadi beberapa kelompok (batch) atau rotasi sesi pagi dan sore, sehingga lini produksi pabrik tetap berjalan penuh tanpa ada kekosongan operator di unit kerja.'
    ],
    [
        'q' => 'Apakah sertifikasi K3 Kimia mengacu pada Kepmenaker No. 187/1999?',
        'a' => 'Ya, kurikulum Petugas K3 Kimia dan Ahli K3 Kimia mengacu penuh pada Keputusan Menteri Tenaga Kerja No. KEP. 187/MEN/1999 tentang Pengendalian Bahan Kimia Berbahaya di Tempat Kerja. Sertifikat, Surat Keputusan Penunjukan (SKP), dan Lisensi K3 diterbitkan langsung oleh Kementerian Ketenagakerjaan RI.'
    ],
    [
        'q' => 'Apakah ada biaya tiket pesawat untuk in-house training di kawasan Cilegon dan Karawang?',
        'a' => 'Tidak ada. Tim instruktur kami bermobilisasi melalui jalur darat langsung via Tol Jakarta-Merak (akses Cilegon/Serang) dan Tol Layang MBZ / Jakarta-Cikampek (akses KIIC/Suryacipta). Hal ini membuat penawaran in-house training koridor Banten-Jabar jauh lebih hemat dan kompetitif.'
    ],
    [
        'q' => 'Apakah praktik operator boiler menggunakan unit ketel uap pabrik kami?',
        'a' => 'Benar. Praktik operator boiler (Kelas 1 atau Kelas 2) diselenggarakan langsung di ruang boiler (boiler room) pabrik Anda dengan bimbingan instruktur spesialis uap & bejana tekan, memastikan peserta terlatih mengatasi indikasi overpressure dan emergency shutdown pada mesin riil.'
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
            ['@type' => 'ListItem', 'position' => 3, 'name' => 'Cilegon & Karawang', 'item' => $page_url]
        ]
    ],
    [
        '@type'        => 'Service',
        '@id'          => $page_url . '#service',
        'name'         => 'In-House Training K3 Petrokimia, Boiler & Alat Angkat Cilegon & Karawang',
        'provider'     => ['@id' => SITE_URL . '/#organization'],
        'serviceType'  => 'Petrochemical, Chemical, Boiler, and Industrial Equipment Certification',
        'description'  => $meta_desc,
        'areaServed'   => [
            ['@type' => 'City', 'name' => 'Cilegon'],
            ['@type' => 'City', 'name' => 'Karawang'],
            ['@type' => 'AdministrativeArea', 'name' => 'Banten'],
            ['@type' => 'AdministrativeArea', 'name' => 'Jawa Barat']
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

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preload" href="<?= theme_font_url($s) ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="<?= theme_font_url($s) ?>"></noscript>
<link rel="stylesheet" href="<?= asset_v('/assets/css/core.min.css') ?>">
<link rel="stylesheet" href="<?= asset_v('/assets/css/components.min.css') ?>">
<?= theme_css_vars($s) ?>
<style>
/* Dedicated Regional Enterprise Hub Styles */
.reg-hero {
  background: linear-gradient(135deg, #09261a 0%, #0A4A2E 55%, #1b533a 100%);
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
  background: linear-gradient(90deg, #3B82F6, #25D366);
}
.reg-badge-top {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: rgba(59, 130, 246, 0.2);
  border: 1px solid rgba(59, 130, 246, 0.4);
  color: #bfdbfe;
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
  color: #3B82F6;
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
    <div class="reg-badge-top">🏭 Koridor Manufaktur, Petrokimia &amp; Smelter Baja</div>
    <h1>In-House Training K3 Cilegon &amp; Karawang: K3 Kimia, Boiler &amp; Forklift On-Site</h1>
    <p class="lead">Solusi sertifikasi kepatuhan regulasi Kemnaker RI &amp; BNSP untuk pabrik kimia, petrokimia, peleburan baja, otomotif, dan logistik di Kawasan Industri Cilegon (KIEC), Serang, Karawang (KIIC/Suryacipta), dan Cikarang (Jababeka/GIIC). Instruktur berpengalaman langsung hadir di fasilitas pabrik Anda.</p>
    <div class="reg-cta-row">
      <a href="<?= $wa_quote_url ?>" class="reg-btn-wa" target="_blank" rel="noopener">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
        Minta Proposal Cilegon &amp; Karawang (24 Jam)
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
        <strong>Akses Darat Cepat Tol Langsung</strong>
        Tol Jakarta-Merak (Cilegon) &amp; Tol MBZ Cikampek (Karawang)
      </div>
      <div class="reg-logistics-item">
        <strong>Regulasi Sektoral Utama</strong>
        Kepmenaker 187/1999, Permenaker 01/1988, Permenaker 08/2020
      </div>
      <div class="reg-logistics-item">
        <strong>Nol Biaya Tiket Pesawat</strong>
        Efisiensi anggaran maksimal untuk korporasi Banten &amp; Jabar
      </div>
      <div class="reg-logistics-item">
        <strong>Penyesuaian Shift Pabrik</strong>
        Rotasi materi teori &amp; praktik tanpa mematikan lini produksi
      </div>
    </div>
  </div>
</div>

<!-- MAIN PROGRAMS GRID -->
<section class="reg-content-sec">
  <div class="container">
    <div style="max-width:760px;">
      <p style="color:#0A4A2E;font-weight:700;font-size:13.5px;letter-spacing:.08em;text-transform:uppercase;margin-bottom:8px;">Program Prioritas In-House</p>
      <h2 style="font-size:clamp(22px,3vw,30px);color:#0f172a;font-weight:800;margin:0 0 12px;">Sertifikasi Kepatuhan Industri Kimia Berat, Boiler &amp; Manufaktur</h2>
      <p style="color:#64748b;font-size:15px;line-height:1.6;">Menjawab tuntutan kepatuhan inspeksi pengawas ketenagakerjaan Banten &amp; Disnakertrans Jawa Barat, audit SMK3 PP 50/2012, serta audit sertifikasi ISO 45001/ISO 14001 industri.</p>
    </div>

    <div class="reg-card-grid">
      <!-- Card 1 -->
      <div class="reg-prog-card">
        <span class="reg-prog-cert">KEMNAKER RI</span>
        <h3>Petugas &amp; Ahli K3 Kimia (Kepmenaker 187/1999)</h3>
        <p>Wajib bagi industri petrokimia, pabrik pupuk, plastik, cat, dan farmasi dengan potensi bahaya besar/menengah bahan kimia berbahaya (BKB).</p>
        <ul class="reg-prog-topics">
          <li>Penyusunan Lembar Data Keselamatan Bahan (LDKB / SDS)</li>
          <li>Identifikasi &amp; penetapan Nilai Ambang Kuantitas (NAK)</li>
          <li>Penanganan ceceran kimia &amp; Emergency Response Plan</li>
          <li>Surat Keputusan Penunjukan (SKP) &amp; Lisensi K3 Kemnaker</li>
        </ul>
      </div>

      <!-- Card 2 -->
      <div class="reg-prog-card">
        <span class="reg-prog-cert">KEMNAKER RI</span>
        <h3>Operator Boiler / Pesawat Uap (Kelas 1 &amp; 2)</h3>
        <p>Sertifikasi resmi Permenaker No. 01/1988 untuk operator ketel uap industri tekstil, kertas, makanan, dan pembangkit listrik captive pabrik.</p>
        <ul class="reg-prog-topics">
          <li>Pengoperasian aman ketel pipa air &amp; ketel pipa api</li>
          <li>Pemeriksaan katup pengaman (safety valve) &amp; water level gauge</li>
          <li>Penanganan endapan kerak, blowdown, &amp; risiko ledakan</li>
          <li>Praktik langsung di ruang ketel uap (boiler room) pabrik</li>
        </ul>
      </div>

      <!-- Card 3 -->
      <div class="reg-prog-card">
        <span class="reg-prog-cert">KEMNAKER RI</span>
        <h3>Operator Forklift &amp; Overhead Crane (Permenaker 08/2020)</h3>
        <p>Sertifikasi dan Lisensi K3 (SIO) resmi untuk operator material handling di pergudangan logistik, assembly otomotif, dan workshop baja.</p>
        <ul class="reg-prog-topics">
          <li>Pemeriksaan harian pra-operasi (Pre-Use Inspection)</li>
          <li>Kestabilan manuver beban forklift &amp; pusat gravitasi</li>
          <li>Operasional overhead crane kabin &amp; pendant control</li>
          <li>Uji praktik manuver langsung di warehouse klien</li>
        </ul>
      </div>

      <!-- Card 4 -->
      <div class="reg-prog-card">
        <span class="reg-prog-cert">PP 50/2012 &amp; BNSP</span>
        <h3>Sistem Manajemen K3 (SMK3) &amp; Auditor Internal</h3>
        <p>Pelatihan dan bimbingan teknis penerapan 64, 122, atau 166 kriteria SMK3 PP No. 50/2012 untuk meraih Sertifikat &amp; Bendera Emas Kemnaker RI.</p>
        <ul class="reg-prog-topics">
          <li>Penyusunan Pedoman, Manual, &amp; Prosedur K3 Pabrik</li>
          <li>Pelatihan Auditor Internal SMK3 terakreditasi</li>
          <li>Simulasi pra-audit kesiapan sertifikasi audit eksternal</li>
          <li>Integrasi sistem ISO 45001:2018 &amp; ISO 14001:2015</li>
        </ul>
      </div>
    </div>

    <!-- MOBILIZATION SPECIFICATIONS -->
    <div class="reg-specs-box">
      <h3>Ketentuan Operasional &amp; Logistik Mobilisasi Banten &amp; Jawa Barat</h3>
      <p style="color:#64748b;font-size:14.5px;line-height:1.6;">Dirancang khusus untuk kawasan industri Cilegon, Serang, Karawang, dan Bekasi-Cikarang:</p>
      <div class="reg-specs-list">
        <div class="reg-spec-item">
          <h4>🚗 Mobilisasi Akses Darat</h4>
          <p>Instruktur diberangkatkan via tol direct tanpa menunggu tiket penerbangan. Memungkinkan penjadwalan mendesak (lead time cepat).</p>
        </div>
        <div class="reg-spec-item">
          <h4>🏭 Praktik di Ruang Kerja Klien</h4>
          <p>Uji kompetensi boiler, forklift, dan bejana tekan dilakukan pada fasilitas kerja asli peserta di pabrik.</p>
        </div>
        <div class="reg-spec-item">
          <h4>🕒 Fleksibel Terhadap Shift Pabrik</h4>
          <p>Jadwal kelas dapat dibagi bertahap menjadi 2 kelompok (shift pagi &amp; malam) demi menjaga kelangsungan output pabrik.</p>
        </div>
        <div class="reg-spec-item">
          <h4>📜 Penagihan B2B Sesuai SOP Vendor</h4>
          <p>PO / SPK korporat, faktur pajak PPN elektronik resmi, dan invoice bertahap sesuai kebijakan finance Anda.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FAQ -->
<section class="section-faq" style="padding:56px 0;background:#fff;">
  <div class="container">
    <div style="text-align:center;max-width:700px;margin:0 auto 36px;">
      <p style="color:#0A4A2E;font-weight:700;font-size:13.5px;letter-spacing:.08em;text-transform:uppercase;margin-bottom:8px;">FAQ Pabrik Cilegon &amp; Karawang</p>
      <h2 style="font-size:clamp(22px,3vw,30px);color:#0f172a;font-weight:800;">Pertanyaan Seputar In-House Training Koridor Industri</h2>
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
<section style="background:#09261a;color:#fff;padding:50px 0;text-align:center;">
  <div class="container">
    <h2 style="color:#fff;font-size:26px;margin-bottom:12px;">Butuh Pelatihan In-House di KIEC Cilegon atau KIIC Karawang?</h2>
    <p style="color:#d1fae5;font-size:15.5px;max-width:620px;margin:0 auto 24px;">Hubungi tim konsultan Wahana Totalita hari ini. Kami bantu penyesuaian kurikulum dan pengiriman proposal penawaran harga korporat resmi dalam 24 jam.</p>
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
