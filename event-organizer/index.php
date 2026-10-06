<?php
/**
 * event-organizer/index.php — Master Authority Hub for Corporate Meetings, Government MICE & HSE Statutory Event Organizer
 * URL: /event-organizer/
 */
require_once dirname(__DIR__) . '/config.php';
require_once dirname(__DIR__) . '/includes/event-data.php';

$s = get_all_settings();
$wa_number = preg_replace('/\D/', '', get_setting('wa_number', '6287759151278'));

// Filter parameters
$search   = trim($_GET['q'] ?? '');
$kategori = trim($_GET['kategori'] ?? '');

$filter = [];
if ($search !== '')   $filter['q'] = $search;
if ($kategori !== '') $filter['kategori'] = $kategori;

$items        = get_all_event_items($filter);
$categories   = get_event_categories();
$totalFound   = count($items);

$page_title  = 'Event Organizer BUMN, Pemerintah & HSE K3 Indonesia — Vendor LPSE / INAPROC LKPP | Wahana Totalita';
$meta_desc   = 'Penyelenggara acara resmi B2B & B2G nasional: Rapat Kerja BUMN, Paket Meeting SBM Kemenkeu, Acara VVIP Menteri, Peringatan Bulan K3 Nasional & Emergency Fire Drill. Terdaftar LPSE / INAPROC LKPP.';
$canonical   = SITE_URL . '/event-organizer/';

$default_wa_text = "Halo Wahana Totalita, saya dari bagian Pengadaan / HR / HSE Perusahaan. Kami membutuhkan proposal penawaran resmi Event Organizer (Rapat Kerja / MICE Kedinasan / HSE Event). Mohon dihubungi untuk konsultasi KAK dan RAB.";
$default_wa_url  = "https://wa.me/{$wa_number}?text=" . rawurlencode($default_wa_text);

// Schema.org Graph
$schema_faqs = [
    [
        '@type' => 'Question',
        'name'  => 'Mengapa Wahana Totalita menjadi pilihan utama vendor event organizer bagi instansi pemerintah dan BUMN?',
        'acceptedAnswer' => [
            '@type' => 'Answer',
            'text'  => 'Wahana Totalita adalah badan hukum PT resmi dengan status PKP yang terdaftar aktif di LPSE, SiRUP, dan INAPROC LKPP. Kami memiliki rekam jejak memenangkan tender resmi pemerintah (seperti Tender Paket Meeting LKPP Rp 81,6 Juta dan pengadaan KLHK), memiliki pemahaman mendalam atas Standar Biaya Masukan (SBM) Kemenkeu, serta menjamin kelengkapan administrasi 100% siap audit BPK/Inspektorat (SPK, KAK, BAST, Faktur Pajak PPh 23 & PPN).'
        ]
    ],
    [
        '@type' => 'Question',
        'name'  => 'Apa keunggulan Wahana Totalita dalam menyelenggarakan kegiatan HSE dan K3 Statutory?',
        'acceptedAnswer' => [
            '@type' => 'Answer',
            'text'  => 'Berbeda dari EO konvensional, Wahana Totalita merupakan Perusahaan Jasa K3 (PJK3) berlisensi resmi Kementerian Ketenagakerjaan RI. Kami berwenang menyelenggarakan Bulan K3 Nasional, Safety Day, Simulasi Tanggap Darurat Kebakaran (Fire Drill), dan Contractor Safety Stand-Down dengan instruktur bersertifikat serta menerbitkan sertifikat pelatihan dan laporan teknis yang sah untuk audit SMK3 PP 50/2012 dan ISO 45001.'
        ]
    ],
    [
        '@type' => 'Question',
        'name'  => 'Apakah Wahana Totalita melayani penyelenggaraan acara di luar Yogyakarta dan Jawa Tengah?',
        'acceptedAnswer' => [
            '@type' => 'Answer',
            'text'  => 'Ya. Kami melayani skala nasional dengan rekam jejak operasional di wilayah Jabodetabek (Jakarta, Bogor, Depok, Tangerang, Bekasi), Surakarta (Solo), Yogyakarta, Surabaya, Cilegon, Karawang, Balikpapan / IKN Nusantara, Morowali, hingga Batam. Tim produksi, sound system, rigging, LED screen, dan tenaga ahli kami siap dimobilisasi ke seluruh Indonesia.'
        ]
    ],
    [
        '@type' => 'Question',
        'name'  => 'Bagaimana mekanisme penyesuaian biaya dengan pagu Standar Biaya Masukan (SBM) Kementerian Keuangan?',
        'acceptedAnswer' => [
            '@type' => 'Answer',
            'text'  => 'Tim kami terbiasa menyusun Rencana Anggaran Biaya (RAB) berbasis Peraturan Menteri Keuangan (PMK) tentang Standar Biaya Masukan terbaru. Seluruh komponen mulai dari paket meeting fullday/fullboard hotel bintang, uang harian, honorarium narasumber, kit peserta, hingga transportasi disesuaikan presisi agar tidak melampaui batas pagu DIPA satuan kerja.'
        ]
    ],
    [
        '@type' => 'Question',
        'name'  => 'Bagaimana pengalaman Wahana Totalita dalam menangani acara VVIP dan protokoler Menteri?',
        'acceptedAnswer' => [
            '@type' => 'Answer',
            'text'  => 'Kami memiliki pengalaman langsung menyelenggarakan kunjungan kerja VVIP Menteri Kabinet di Solo dan Yogyakarta. Kami memahami protokoler ketat kedinasan, koordinasi pengamanan Paspampres/Protokol Kementerian, tata letak ruang transit VVIP, sistem audio darurat redundan, hingga tata urutan acara sesuai tata krama kenegaraan.'
        ]
    ]
];

$schema_graph = [
    [
        '@type'        => 'Organization',
        '@id'          => SITE_URL . '/#organization',
        'name'         => 'PT Wahana Totalita Konsultan',
        'url'          => SITE_URL,
        'description'  => 'Penyelenggara Pertemuan Korporasi, MICE Kedinasan Pemerintah & HSE Statutory Event Berlisensi PJK3 Kemnaker RI.',
        'contactPoint' => [
            '@type'             => 'ContactPoint',
            'telephone'         => '+62-877-5915-1278',
            'contactType'       => 'Corporate MICE & Government Procurement Service',
            'availableLanguage' => ['Indonesian', 'English']
        ]
    ],
    [
        '@type' => 'BreadcrumbList',
        '@id'   => $canonical . '#breadcrumb',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => SITE_URL . '/'],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Event Organizer B2B & B2G', 'item' => $canonical]
        ]
    ],
    [
        '@type'       => 'Service',
        '@id'         => $canonical . '#service',
        'name'        => 'Corporate Meetings, Government MICE & HSE Event Organizer Indonesia',
        'provider'    => ['@id' => SITE_URL . '/#organization'],
        'serviceType' => 'Enterprise Event Management & Government Procurement Service',
        'description' => $meta_desc,
        'areaServed'  => [
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
<title><?= htmlspecialchars($page_title) ?></title>
<meta name="description" content="<?= htmlspecialchars($meta_desc) ?>">
<link rel="canonical" href="<?= htmlspecialchars($canonical) ?>">

<meta property="og:type" content="website">
<meta property="og:site_name" content="Wahana Totalita Konsultan">
<meta property="og:title" content="<?= htmlspecialchars($page_title) ?>">
<meta property="og:description" content="<?= htmlspecialchars($meta_desc) ?>">
<meta property="og:url" content="<?= htmlspecialchars($canonical) ?>">
<meta property="og:image" content="<?= SITE_URL ?>/assets/img/inaproc-tender-winner.png">

<script type="application/ld+json">
<?= json_encode(['@context' => 'https://schema.org', '@graph' => $schema_graph], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) ?>
</script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="<?= theme_font_url($s) ?>" media="print" onload="this.media='all'">
<noscript><link rel="stylesheet" href="<?= theme_font_url($s) ?>"></noscript>
<style><?php
$_core_css_file = dirname(__DIR__) . '/assets/css/core.min.css';
if (is_file($_core_css_file)) {
    readfile($_core_css_file);
} else {
    readfile(dirname(__DIR__) . '/assets/css/tokens.css');
    readfile(dirname(__DIR__) . '/assets/css/core.css');
}
?></style>
<link rel="stylesheet" href="<?= asset_v('/assets/css/components.min.css') ?>" media="print" onload="this.media='all'">
<noscript><link rel="stylesheet" href="<?= asset_v('/assets/css/components.min.css') ?>"></noscript>
<?= theme_css_vars($s) ?>

<style>
/* Modern Executive Event Organizer Styles */
.eo-hero {
  background: linear-gradient(135deg, #091a2e 0%, #0d2847 45%, #081d33 100%);
  color: #fff;
  padding: 68px 0 54px;
  position: relative;
  overflow: hidden;
  border-bottom: 4px solid #2563eb;
}
.eo-hero::before {
  content: "";
  position: absolute;
  top: 0; right: 0; bottom: 0; left: 0;
  background: radial-gradient(circle at 85% 15%, rgba(37, 99, 235, 0.16) 0%, transparent 60%);
  pointer-events: none;
}
.eo-hero-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin-bottom: 18px;
}
.eo-badge {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  background: rgba(37, 99, 235, 0.2);
  border: 1px solid rgba(96, 165, 250, 0.45);
  color: #93c5fd;
  font-size: 12.5px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: .06em;
  padding: 6px 14px;
  border-radius: 99px;
}
.eo-badge.gold {
  background: rgba(245, 158, 11, 0.2);
  border-color: rgba(245, 158, 11, 0.5);
  color: #fde68a;
}
.eo-hero h1 {
  font-size: clamp(26px, 4vw, 45px);
  font-weight: 800;
  line-height: 1.25;
  margin-bottom: 18px;
  color: #ffffff;
}
.eo-hero h1 span.highlight {
  color: #60a5fa;
}
.eo-hero p.lead {
  font-size: clamp(15px, 1.8vw, 17.5px);
  color: #cbd5e1;
  max-width: 860px;
  line-height: 1.65;
  margin-bottom: 26px;
}
.eo-hero-actions {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
}
.eo-btn-wa {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  background: #25D366;
  color: #fff;
  font-weight: 700;
  font-size: 15px;
  padding: 13px 26px;
  border-radius: 10px;
  text-decoration: none;
  transition: transform .2s ease, background .2s ease;
  box-shadow: 0 4px 14px rgba(37, 211, 102, 0.35);
}
.eo-btn-wa:hover {
  background: #20ba5a;
  transform: translateY(-2px);
  color: #fff;
}
.eo-btn-tender {
  display: inline-flex;
  align-items: center;
  gap: 9px;
  background: rgba(255,255,255,0.08);
  color: #fff;
  border: 1px solid rgba(255,255,255,0.28);
  font-weight: 600;
  font-size: 15px;
  padding: 13px 22px;
  border-radius: 10px;
  text-decoration: none;
}
.eo-btn-tender:hover {
  background: rgba(255,255,255,0.18);
  color: #fff;
}
.eo-trust-strip {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
  margin-top: 36px;
  padding-top: 24px;
  border-top: 1px solid rgba(255,255,255,0.14);
  font-size: 13.5px;
  color: #94a3b8;
}
.eo-trust-strip span {
  display: flex;
  align-items: center;
  gap: 8px;
}
.eo-trust-strip svg {
  color: #60a5fa;
  flex-shrink: 0;
}

/* Tender Proof Callout */
.eo-proof-banner {
  background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
  border: 1px solid #334155;
  border-radius: 16px;
  padding: 24px 28px;
  margin: 36px 0;
  display: flex;
  flex-wrap: wrap;
  gap: 24px;
  align-items: center;
  color: #fff;
  box-shadow: 0 8px 24px rgba(0,0,0,0.15);
}
.eo-proof-icon {
  width: 56px;
  height: 56px;
  border-radius: 14px;
  background: rgba(37, 99, 235, 0.2);
  border: 1px solid rgba(59, 130, 246, 0.4);
  display: flex;
  align-items: center;
  justify-content: center;
  color: #60a5fa;
  flex-shrink: 0;
}
.eo-proof-text {
  flex: 1;
  min-width: 260px;
}
.eo-proof-text h3 {
  font-size: 17.5px;
  font-weight: 800;
  margin: 0 0 6px;
  color: #f8fafc;
}
.eo-proof-text p {
  margin: 0;
  font-size: 14px;
  color: #cbd5e1;
  line-height: 1.5;
}
.eo-proof-badge-group {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin-top: 10px;
}
.eo-proof-tag {
  font-size: 11.5px;
  background: rgba(255,255,255,0.08);
  border: 1px solid rgba(255,255,255,0.18);
  padding: 4px 10px;
  border-radius: 6px;
  color: #93c5fd;
  font-weight: 600;
}
.eo-proof-action {
  flex-shrink: 0;
}
.eo-proof-btn {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: #2563eb;
  color: #fff;
  padding: 10px 18px;
  border-radius: 8px;
  font-weight: 700;
  font-size: 13.5px;
  text-decoration: none;
  transition: background .2s ease;
}
.eo-proof-btn:hover {
  background: #1d4ed8;
  color: #fff;
}

/* Category Filter Tabs */
.eo-nav-tabs {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin: 28px 0 34px;
}
.eo-tab-btn {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: #fff;
  border: 1px solid #cbd5e1;
  color: #334155;
  font-size: 14px;
  font-weight: 600;
  padding: 10px 18px;
  border-radius: 10px;
  text-decoration: none;
  transition: all .2s ease;
}
.eo-tab-btn:hover, .eo-tab-btn.active {
  background: #0f172a;
  border-color: #0f172a;
  color: #fff;
}
.eo-tab-count {
  background: rgba(0,0,0,0.08);
  padding: 2px 7px;
  border-radius: 99px;
  font-size: 12px;
}
.eo-tab-btn.active .eo-tab-count {
  background: rgba(255,255,255,0.2);
  color: #fff;
}

/* Services Grid */
.eo-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
  gap: 26px;
  margin-bottom: 50px;
}
@media (max-width: 640px) {
  .eo-grid {
    grid-template-columns: 1fr;
  }
}
.eo-card {
  background: #fff;
  border: 1px solid #e2e8f0;
  border-radius: 16px;
  padding: 26px;
  display: flex;
  flex-direction: column;
  transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
  position: relative;
}
.eo-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 12px 28px rgba(0,0,0,0.07);
  border-color: #93c5fd;
}
.eo-card-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  margin-bottom: 14px;
}
.eo-card-cat {
  font-size: 12px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: .05em;
  padding: 4px 10px;
  border-radius: 6px;
}
.eo-cat-hse {
  background: #fef2f2;
  color: #dc2626;
  border: 1px solid #fecaca;
}
.eo-cat-gov {
  background: #eff6ff;
  color: #2563eb;
  border: 1px solid #bfdbfe;
}
.eo-cat-corp {
  background: #f0fdf4;
  color: #16a34a;
  border: 1px solid #bbf7d0;
}
.eo-cat-gala {
  background: #fdf4ff;
  color: #9333ea;
  border: 1px solid #f5d0fe;
}
.eo-cat-cap {
  background: #fffbeb;
  color: #d97706;
  border: 1px solid #fde68a;
}
.eo-card-inaproc-tag {
  font-size: 11px;
  font-weight: 700;
  background: #f8fafc;
  color: #475569;
  border: 1px solid #e2e8f0;
  padding: 3px 8px;
  border-radius: 4px;
}
.eo-card h2 {
  font-size: 19px;
  font-weight: 800;
  line-height: 1.35;
  margin: 0 0 10px;
  color: #0f172a;
}
.eo-card h2 a {
  color: inherit;
  text-decoration: none;
}
.eo-card h2 a:hover {
  color: #2563eb;
}
.eo-card p.tagline {
  font-size: 13.5px;
  color: #475569;
  line-height: 1.55;
  margin-bottom: 16px;
  flex: 1;
}
.eo-card-meta {
  background: #f8fafc;
  border-radius: 10px;
  padding: 12px 14px;
  margin-bottom: 18px;
  font-size: 12.5px;
  color: #64748b;
  display: flex;
  flex-direction: column;
  gap: 6px;
}
.eo-card-meta-row {
  display: flex;
  justify-content: space-between;
  gap: 8px;
}
.eo-card-meta-row strong {
  color: #1e293b;
}
.eo-card-highlights {
  list-style: none;
  padding: 0;
  margin: 0 0 18px;
  font-size: 13px;
  color: #334155;
}
.eo-card-highlights li {
  position: relative;
  padding-left: 18px;
  margin-bottom: 6px;
  line-height: 1.45;
}
.eo-card-highlights li::before {
  content: "✓";
  position: absolute;
  left: 0;
  color: #2563eb;
  font-weight: 800;
}
.eo-card-bottom {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  padding-top: 14px;
  border-top: 1px solid #f1f5f9;
}
.eo-card-price {
  font-size: 12.5px;
  color: #64748b;
}
.eo-card-price strong {
  display: block;
  font-size: 15px;
  color: #0f172a;
}
.eo-card-btn {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: #0f172a;
  color: #fff;
  font-size: 13px;
  font-weight: 700;
  padding: 9px 16px;
  border-radius: 8px;
  text-decoration: none;
  transition: background .2s ease;
}
.eo-card-btn:hover {
  background: #2563eb;
  color: #fff;
}

/* SBM & Event Cost Estimator Tool */
.eo-calc-section {
  background: #f8fafc;
  border: 1px solid #e2e8f0;
  border-radius: 20px;
  padding: 38px 34px;
  margin: 44px 0 54px;
}
.eo-calc-header {
  max-width: 760px;
  margin-bottom: 26px;
}
.eo-calc-header h2 {
  font-size: 24px;
  font-weight: 800;
  color: #0f172a;
  margin: 0 0 8px;
}
.eo-calc-header p {
  font-size: 14.5px;
  color: #64748b;
  margin: 0;
  line-height: 1.6;
}
.eo-calc-grid {
  display: grid;
  grid-template-columns: 1fr 1fr 1fr;
  gap: 20px;
  margin-bottom: 24px;
}
@media (max-width: 860px) {
  .eo-calc-grid {
    grid-template-columns: 1fr;
  }
}
.eo-calc-field label {
  display: block;
  font-size: 13px;
  font-weight: 700;
  color: #334155;
  margin-bottom: 8px;
}
.eo-calc-field select, .eo-calc-field input {
  width: 100%;
  padding: 12px 14px;
  border: 1px solid #cbd5e1;
  border-radius: 10px;
  background: #fff;
  font-size: 14px;
  color: #0f172a;
}
.eo-calc-result-box {
  background: #0f172a;
  border-radius: 14px;
  padding: 24px 28px;
  color: #fff;
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
  align-items: center;
  justify-content: space-between;
}
.eo-calc-result-col {
  flex: 1;
  min-width: 220px;
}
.eo-calc-result-lbl {
  font-size: 12px;
  text-transform: uppercase;
  color: #94a3b8;
  letter-spacing: .05em;
  margin-bottom: 4px;
}
.eo-calc-result-val {
  font-size: clamp(20px, 3vw, 28px);
  font-weight: 800;
  color: #38bdf8;
}
.eo-calc-result-sub {
  font-size: 13px;
  color: #cbd5e1;
}
.eo-calc-cta {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: #25D366;
  color: #fff;
  font-weight: 700;
  font-size: 14.5px;
  padding: 12px 22px;
  border-radius: 10px;
  text-decoration: none;
  transition: transform .2s ease;
}
.eo-calc-cta:hover {
  transform: translateY(-2px);
  color: #fff;
}

/* Moat / Comparison Matrix */
.eo-moat-section {
  padding: 40px 0;
}
.eo-moat-section h2 {
  font-size: clamp(22px, 3.2vw, 32px);
  font-weight: 800;
  color: #0f172a;
  text-align: center;
  margin-bottom: 12px;
}
.eo-moat-section p.sub {
  text-align: center;
  font-size: 15px;
  color: #64748b;
  max-width: 760px;
  margin: 0 auto 34px;
  line-height: 1.6;
}
.eo-table-wrap {
  overflow-x: auto;
  border: 1px solid #e2e8f0;
  border-radius: 14px;
  box-shadow: 0 4px 16px rgba(0,0,0,0.03);
  margin-bottom: 40px;
}
.eo-table {
  width: 100%;
  border-collapse: collapse;
  font-size: 14px;
  background: #fff;
}
.eo-table th {
  padding: 14px 18px;
  text-align: left;
  font-weight: 700;
  background: #f8fafc;
  color: #1e293b;
  border-bottom: 2px solid #e2e8f0;
}
.eo-table th.brand-col {
  background: #0f172a;
  color: #60a5fa;
  font-size: 15px;
}
.eo-table td {
  padding: 14px 18px;
  border-bottom: 1px solid #f1f5f9;
  vertical-align: middle;
  color: #334155;
}
.eo-table tr:last-child td {
  border-bottom: none;
}
.eo-table td.brand-col {
  background: #f0f7ff;
  font-weight: 600;
  color: #0c4a6e;
}

/* Regional Reach Section */
.eo-regions-box {
  background: linear-gradient(135deg, #091a2e 0%, #172554 100%);
  color: #fff;
  border-radius: 18px;
  padding: 36px 32px;
  margin: 40px 0 50px;
}
.eo-regions-box h3 {
  font-size: 22px;
  font-weight: 800;
  margin: 0 0 10px;
  color: #f8fafc;
}
.eo-regions-box p {
  color: #cbd5e1;
  font-size: 14.5px;
  line-height: 1.6;
  margin-bottom: 24px;
}
.eo-regions-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 16px;
}
.eo-region-pill {
  background: rgba(255,255,255,0.07);
  border: 1px solid rgba(255,255,255,0.15);
  border-radius: 10px;
  padding: 12px 16px;
}
.eo-region-pill strong {
  display: block;
  font-size: 14.5px;
  color: #93c5fd;
  margin-bottom: 4px;
}
.eo-region-pill span {
  font-size: 12.5px;
  color: #cbd5e1;
}

/* FAQs */
.eo-faq-box {
  margin: 40px 0 54px;
}
.eo-faq-item {
  background: #fff;
  border: 1px solid #e2e8f0;
  border-radius: 12px;
  margin-bottom: 14px;
  overflow: hidden;
}
.eo-faq-q {
  padding: 18px 22px;
  font-weight: 700;
  font-size: 15.5px;
  color: #0f172a;
  cursor: pointer;
  display: flex;
  justify-content: space-between;
  align-items: center;
  user-select: none;
}
.eo-faq-q::after {
  content: "+";
  font-size: 20px;
  color: #2563eb;
  transition: transform .2s ease;
}
.eo-faq-item.open .eo-faq-q::after {
  transform: rotate(45deg);
}
.eo-faq-a {
  padding: 0 22px 18px;
  font-size: 14.5px;
  color: #475569;
  line-height: 1.65;
  display: none;
}
.eo-faq-item.open .eo-faq-a {
  display: block;
}

/* Bottom CTA */
.eo-cta-banner {
  background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
  color: #fff;
  border-radius: 20px;
  padding: 44px 36px;
  text-align: center;
  margin: 50px 0;
  position: relative;
  overflow: hidden;
}
.eo-cta-banner h2 {
  font-size: clamp(24px, 3.6vw, 36px);
  font-weight: 800;
  margin-bottom: 14px;
  color: #fff;
}
.eo-cta-banner p {
  font-size: 16px;
  color: #dbeafe;
  max-width: 720px;
  margin: 0 auto 28px;
  line-height: 1.6;
}
.eo-cta-actions {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  justify-content: center;
}
</style>
</head>
<body>

<?php include dirname(__DIR__) . '/includes/navbar.php'; ?>

<!-- ═══════════════════════════════════════════════════ HERO -->
<section class="eo-hero">
  <div class="container">
    
    <div class="eo-hero-badges">
      <span class="eo-badge">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2L1 21h22L12 2zm0 3.99L19.53 19H4.47L12 5.99zM11 16h2v2h-2zm0-6h2v4h-2z"/></svg>
        PJK3 Resmi Kemnaker RI
      </span>
      <span class="eo-badge gold">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
        Pemenang Tender LKPP / INAPROC
      </span>
      <span class="eo-badge">
        Standar Biaya Masukan (SBM) Kemenkeu
      </span>
    </div>

    <h1>
      Event Organizer BUMN, Pemerintah &amp; <span class="highlight">HSE Statutory</span> Indonesia
    </h1>

    <p class="lead">
      Penyelenggara terpercaya pertemuan korporasi, rapat koordinasi kedinasan, acara VVIP Menteri, serta agenda wajib K3 (Bulan K3 Nasional, Emergency Fire Drill, dan Rapat P2K3). Legalitas PT PKP terverifikasi LPSE/INAPROC dengan administrasi SPK, BAST, dan Faktur Pajak lengkap.
    </p>

    <div class="eo-hero-actions">
      <a href="<?= $default_wa_url ?>" target="_blank" rel="noopener" class="eo-btn-wa">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
        Konsultasi &amp; Request Proposal
      </a>
      <a href="#katalog-program" class="eo-btn-tender">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m6 9 6 6 6-6"/></svg>
        Telusuri 24 Program Unggulan
      </a>
    </div>

    <div class="eo-trust-strip">
      <span>
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
        Terdaftar Resmi LPSE, SiRUP &amp; INAPROC LKPP
      </span>
      <span>
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
        Badan Usaha PKP (Faktur Pajak PPh 23 / PPN 11%)
      </span>
      <span>
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
        PJK3 Lisensi Kemnaker RI (SKP Aktif)
      </span>
      <span>
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
        Protokol Acara VVIP Menteri Kabinet Teruji
      </span>
    </div>

  </div>
</section>

<!-- ═══════════════════════════════════════════════════ MAIN CONTENT -->
<main class="container" style="padding-top: 36px; padding-bottom: 60px;">

  <!-- Breadcrumb -->
  <nav aria-label="Breadcrumb" style="font-size: 13.5px; color: #64748b; margin-bottom: 24px;">
    <a href="/" style="color: #64748b; text-decoration: none;">Beranda</a>
    <span style="margin: 0 6px;">/</span>
    <strong style="color: #0f172a;">Event Organizer BUMN, Pemerintah &amp; HSE</strong>
  </nav>

  <!-- Tender Proof Callout Banner -->
  <section class="eo-proof-banner" aria-label="Bukti Pemenang Tender LKPP INAPROC">
    <div class="eo-proof-icon">
      <svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/></svg>
    </div>
    <div class="eo-proof-text">
      <h3>Bukti Otentik: Pemenang Tender Paket Meeting LKPP &amp; Kontrak Resmi Kementerian</h3>
      <p>
        Wahana Totalita telah diverifikasi dan memenangkan paket pengadaan resmi pemerintah pada portal INAPROC (seperti <em>Tender Paket Meeting LKPP Rp 81.609.400,-</em> dan kontrak P3E Jawa Kementerian LHK). Kami bukan calo; kami adalah penyedia langsung berbadan hukum resmi dengan rekam jejak sempurna.
      </p>
      <div class="eo-proof-badge-group">
        <span class="eo-proof-tag">ID Paket INAPROC Terverifikasi</span>
        <span class="eo-proof-tag">Kesesuaian Pagu SBM PMK</span>
        <span class="eo-proof-tag">Pemeriksaan BPK &amp; Inspektorat Lolos</span>
        <span class="eo-proof-tag">Faktur Pajak Elektronik DJP</span>
      </div>
    </div>
    <div class="eo-proof-action">
      <a href="<?= $default_wa_url ?>" target="_blank" rel="noopener" class="eo-proof-btn">
        Minta Portofolio &amp; KAK
      </a>
    </div>
  </section>

  <!-- SBM & Event Cost Estimator Tool -->
  <section class="eo-calc-section" id="kalkulator-sbm">
    <div class="eo-calc-header">
      <span class="eo-badge" style="margin-bottom: 8px;">Kalkulator Anggaran Kedinasan</span>
      <h2>Simulasi Estimasi Biaya Event &amp; Pagu SBM Kemenkeu</h2>
      <p>
        Gunakan kalkulator di bawah ini untuk mengestimasikan kebutuhan pagu anggaran rapat kedinasan, agenda HSE perusahaan, atau paket residential hotel sesuai standar acuan biaya.
      </p>
    </div>

    <div class="eo-calc-grid">
      <div class="eo-calc-field">
        <label for="event_type">Format / Jenis Acara</label>
        <select id="event_type" onchange="calculateEventCost()">
          <option value="fullday">Paket Meeting Fullday (SBM Kemenkeu)</option>
          <option value="fullboard">Paket Meeting Fullboard Residential (Hotel *4)</option>
          <option value="hse_drill">Emergency Fire Drill &amp; Simulasi K3</option>
          <option value="bulan_k3">Peringatan Bulan K3 Nasional (All-In)</option>
          <option value="raker_bumn">Rapat Kerja Tahunan (Raker) Direksi BUMN</option>
          <option value="gathering">Corporate Gathering &amp; Gala Dinner</option>
        </select>
      </div>

      <div class="eo-calc-field">
        <label for="event_loc">Wilayah Lokasi Pelaksanaan</label>
        <select id="event_loc" onchange="calculateEventCost()">
          <option value="solo_jogja">Solo &amp; Yogyakarta (Paling Efisien)</option>
          <option value="jakarta">Jabodetabek / Jakarta</option>
          <option value="surabaya">Surabaya / Jawa Timur</option>
          <option value="ikn_balikpapan">Balikpapan &amp; IKN Nusantara</option>
          <option value="industri_luar">Kawasan Industri (Cilegon / Morowali / Lainnya)</option>
        </select>
      </div>

      <div class="eo-calc-field">
        <label for="pax_count">Jumlah Peserta (Pax)</label>
        <select id="pax_count" onchange="calculateEventCost()">
          <option value="30">30 Peserta (Executive / P2K3)</option>
          <option value="50" selected>50 Peserta (Standard Kedinasan)</option>
          <option value="100">100 Peserta (Rakornas / Bimtek)</option>
          <option value="200">200 Peserta (Safety Day / Seminar)</option>
          <option value="500">500+ Peserta (Gathering Akbar / Apel K3)</option>
        </select>
      </div>
    </div>

    <div class="eo-calc-result-box">
      <div class="eo-calc-result-col">
        <div class="eo-calc-result-lbl">Estimasi Standar per Peserta</div>
        <div class="eo-calc-result-val" id="calc_rate_pax">Rp 450.000 / pax</div>
        <div class="eo-calc-result-sub" id="calc_pax_note">Include Ballroom, 2x Coffee Break, 1x Lunch &amp; Audio Visual</div>
      </div>
      <div class="eo-calc-result-col">
        <div class="eo-calc-result-lbl">Total Estimasi Anggaran (RAB Acuan)</div>
        <div class="eo-calc-result-val" id="calc_total_budget" style="color: #4ade80;">Rp 22.500.000</div>
        <div class="eo-calc-result-sub" id="calc_total_note">Disesuaikan dengan SBM PMK Kemenkeu &amp; Pajak Resmi</div>
      </div>
      <div>
        <a id="calc_wa_btn" href="<?= $default_wa_url ?>" target="_blank" rel="noopener" class="eo-calc-cta">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
          Konsultasikan RAB Ini
        </a>
      </div>
    </div>
  </section>

  <!-- Programs Filter Bar -->
  <section id="katalog-program" style="margin-top: 50px;">
    <div style="text-align: center; max-width: 820px; margin: 0 auto 30px;">
      <span class="eo-badge">Katalog Lengkap Layanan Event</span>
      <h2 style="font-size: clamp(24px, 3.4vw, 36px); font-weight: 800; color: #0f172a; margin-top: 10px;">
        24 Spesialisasi Acara Korporasi, Kedinasan &amp; Statutory K3
      </h2>
      <p style="font-size: 15px; color: #64748b; line-height: 1.6;">
        Pilih pilar layanan di bawah ini untuk melihat spesifikasi teknis peralatan, susunan acara, deliverables dokumen audit, dan rincian biaya resmi.
      </p>
    </div>

    <div class="eo-nav-tabs">
      <a href="/event-organizer/" class="eo-tab-btn <?= empty($kategori) ? 'active' : '' ?>">
        Semua Program <span class="eo-tab-count">24</span>
      </a>
      <?php foreach ($categories as $catKey => $catLabel): 
        $catCount = count(get_all_event_items(['kategori' => $catKey]));
      ?>
      <a href="/event-organizer/?kategori=<?= urlencode($catKey) ?>#katalog-program" 
         class="eo-tab-btn <?= $kategori === $catKey ? 'active' : '' ?>">
        <?= htmlspecialchars($catLabel) ?> <span class="eo-tab-count"><?= $catCount ?></span>
      </a>
      <?php endforeach; ?>
    </div>

    <!-- 24 Programs Grid -->
    <div class="eo-grid">
      <?php foreach ($items as $item): 
        $catClass = match($item['kategori']) {
          'hse-safety'         => 'eo-cat-hse',
          'government-mice'    => 'eo-cat-gov',
          'corporate-meetings' => 'eo-cat-corp',
          'milestone-gala'     => 'eo-cat-gala',
          'capacity-building'  => 'eo-cat-cap',
          default              => 'eo-cat-gov'
        };
      ?>
      <article class="eo-card">
        <div class="eo-card-top">
          <span class="eo-card-cat <?= $catClass ?>">
            <?= htmlspecialchars($item['kategori_label']) ?>
          </span>
          <span class="eo-card-inaproc-tag">
            <?= htmlspecialchars($item['inaproc_relevance']) ?>
          </span>
        </div>

        <h2>
          <a href="/event-organizer/<?= htmlspecialchars($item['slug']) ?>/">
            <?= htmlspecialchars($item['judul']) ?>
          </a>
        </h2>

        <p class="tagline">
          <?= htmlspecialchars($item['tagline']) ?>
        </p>

        <div class="eo-card-meta">
          <div class="eo-card-meta-row">
            <span>Durasi Pelaksanaan:</span>
            <strong><?= htmlspecialchars($item['durasi_event']) ?></strong>
          </div>
          <div class="eo-card-meta-row">
            <span>Target Peserta:</span>
            <strong><?= htmlspecialchars($item['b2b_min_peserta']) ?></strong>
          </div>
          <div class="eo-card-meta-row">
            <span>Cakupan Wilayah:</span>
            <strong><?= htmlspecialchars(implode(', ', array_slice($item['city_mentions'], 0, 4))) ?></strong>
          </div>
        </div>

        <ul class="eo-card-highlights">
          <?php foreach (array_slice($item['highlight_pillars'], 0, 3) as $hl): ?>
            <li><?= htmlspecialchars($hl) ?></li>
          <?php endforeach; ?>
        </ul>

        <div class="eo-card-bottom">
          <div class="eo-card-price">
            Estimasi Biaya
            <strong><?= htmlspecialchars($item['biaya_standar']) ?></strong>
          </div>
          <a href="/event-organizer/<?= htmlspecialchars($item['slug']) ?>/" class="eo-card-btn">
            Lihat Proposal
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </a>
        </div>
      </article>
      <?php endforeach; ?>
    </div>

  </section>

  <!-- Moat & Vendor Comparison Section -->
  <section class="eo-moat-section">
    <h2>Mengapa Memilih Wahana Totalita Dibanding Event Organizer Biasa?</h2>
    <p class="sub">
      Penyelenggaraan acara kedinasan kementerian dan statutory K3 industri memiliki risiko hukum tinggi. Ketidaksesuaian administrasi dapat menjadi temuan audit Inspektorat/BPK, dan kegagalan simulasi darurat berdampak pada pembatalan sertifikasi SMK3.
    </p>

    <div class="eo-table-wrap">
      <table class="eo-table">
        <thead>
          <tr>
            <th style="width: 28%;">Parameter Penyelenggaraan</th>
            <th class="brand-col" style="width: 36%;">Wahana Totalita Konsultan (PJK3 &amp; MICE)</th>
            <th style="width: 36%;">Event Organizer (EO) Biasa / Komersial</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><strong>Legalitas &amp; Lisensi K3</strong></td>
            <td class="brand-col">Resmi PJK3 SKP Kemnaker RI + Terakreditasi BNSP. Berwenang menerbitkan sertifikat K3 dan dokumen audit.</td>
            <td>Hanya izin usaha EO umum (KBLI MICE). Tidak memiliki lisensi K3 resmi Kemnaker RI.</td>
          </tr>
          <tr>
            <td><strong>Portal Pengadaan Pemerintah</strong></td>
            <td class="brand-col">Terdaftar aktif di LPSE, SiRUP, INAPROC LKPP, dan PADI UMKM BUMN. Berpengalaman menang tender langsung.</td>
            <td>Seringkali meminjam bendera PT pihak ketiga (subkontrak calo), rawan masalah administrasi.</td>
          </tr>
          <tr>
            <td><strong>Kepatuhan Standar Biaya (SBM)</strong></td>
            <td class="brand-col">Paham rincian PMK SBM Kemenkeu. Penyusunan RAB presisi mencegah pagu minus dan temuan BPK.</td>
            <td>Menggunakan struktur margin komersial tanpa memahami batasan pagu DIPA dinas.</td>
          </tr>
          <tr>
            <td><strong>Pengalaman Protokoler VVIP</strong></td>
            <td class="brand-col">Teruji menangani Kunjungan Kerja Menteri Kabinet, Walikota, Dirjen &amp; Direksi Holding BUMN di Solo/Jogja.</td>
            <td>Terbiasa acara hiburan umum/konser, kurang menguasai etiket protokoler kenegaraan.</td>
          </tr>
          <tr>
            <td><strong>Simulasi Tanggap Darurat &amp; Fire Drill</strong></td>
            <td class="brand-col">Didampingi instruktur K3 berlisensi &amp; praktisi Damkar. Menghasilkan Laporan Audit Pemenuhan SMK3 PP 50/2012.</td>
            <td>Hanya simulasi teatrikal tanpa validasi regulasi; ditolak oleh auditor sertifikasi K3.</td>
          </tr>
          <tr>
            <td><strong>Kelengkapan Dokumen SPJ</strong></td>
            <td class="brand-col">Lengkap 100%: KAK/TOR, SPK resmi, BAST bertanda tangan, Faktur Pajak PPh 23 / PPN, dan LPJ 4K.</td>
            <td>Sering terlambat mengirimkan kuitansi bermeterai dan faktur pajak elektronik.</td>
          </tr>
          <tr>
            <td><strong>Jangkauan Operasional</strong></td>
            <td class="brand-col">Seluruh Indonesia (Jabodetabek, Solo, Jogja, Surabaya, Balikpapan/IKN, Cilegon, Morowali, Batam).</td>
            <td>Terbatas pada satu kota lokal; biaya membengkak jika keluar daerah.</td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>

  <!-- Regional Reach & Logistics Capability -->
  <section class="eo-regions-box">
    <div style="max-width: 800px;">
      <span class="eo-badge gold" style="margin-bottom: 12px;">Kemampuan Logistik &amp; Produksi Nasional</span>
      <h3>Melayani Penyelenggaraan Acara di Seluruh Titik Strategis Indonesia</h3>
      <p>
        Wahana Totalita memiliki jaringan tim produksi mandiri, penyewaan rigging, videotron LED screen indoor/outdoor, tata suara profesional, serta narasumber terakreditasi yang siap dimobilisasi ke kota-kota pusat bisnis, pemerintahan, dan kawasan industri di Indonesia:
      </p>
    </div>

    <div class="eo-regions-grid">
      <div class="eo-region-pill">
        <strong>Solo &amp; D.I. Yogyakarta</strong>
        <span>Hub Utama MICE, Raker BUMN, Acara Menteri, &amp; Destinasi Meeting Paling Efisien Biaya.</span>
      </div>
      <div class="eo-region-pill">
        <strong>Jabodetabek (Jakarta)</strong>
        <span>Kementerian Pusat, Kantor Pusat BUMN, Hotel Bintang 5 Sudirman-Thamrin, &amp; ICE BSD.</span>
      </div>
      <div class="eo-region-pill">
        <strong>Surabaya &amp; Jawa Timur</strong>
        <span>Rakornas Regional Timur, Kawasan Industri Rungkut/Gresik, &amp; Manufaktur Berat.</span>
      </div>
      <div class="eo-region-pill">
        <strong>Balikpapan &amp; IKN Nusantara</strong>
        <span>Pertambangan Batubara, Migas, Sektor Energi, &amp; Rapat Strategis Proyek IKN.</span>
      </div>
      <div class="eo-region-pill">
        <strong>Cilegon &amp; Karawang</strong>
        <span>Kawasan Petrokimia, Baja Berat, Safety Stand-Down Kontraktor &amp; Industri Manufaktur Otomotif.</span>
      </div>
      <div class="eo-region-pill">
        <strong>Morowali &amp; Luar Jawa</strong>
        <span>Smelter Nikel, Industri Pertambangan Remote, &amp; Emergency Response Team Drill Lapangan.</span>
      </div>
    </div>
  </section>

  <!-- Frequently Asked Questions (FAQ) Accordion -->
  <section class="eo-faq-box">
    <div style="text-align: center; max-width: 760px; margin: 0 auto 30px;">
      <span class="eo-badge">Tanya Jawab Pengadaan</span>
      <h2 style="font-size: 26px; font-weight: 800; color: #0f172a; margin-top: 8px;">
        Pertanyaan Umum Terkait Event Organizer B2B &amp; B2G
      </h2>
      <p style="font-size: 14.5px; color: #64748b;">
        Informasi seputar mekanisme penunjukan langsung, pagu anggaran, tender INAPROC, dan kustomisasi KAK.
      </p>
    </div>

    <?php foreach ($schema_faqs as $idx => $f): ?>
    <div class="eo-faq-item <?= $idx === 0 ? 'open' : '' ?>" onclick="this.classList.toggle('open')">
      <div class="eo-faq-q">
        <?= htmlspecialchars($f['name']) ?>
      </div>
      <div class="eo-faq-a">
        <?= htmlspecialchars($f['acceptedAnswer']['text']) ?>
      </div>
    </div>
    <?php endforeach; ?>
  </section>

  <!-- Bottom CTA Banner -->
  <section class="eo-cta-banner">
    <h2>Butuh Penyelenggara Acara yang Aman Secara Hukum &amp; Memahami SBM?</h2>
    <p>
      Diskusikan kebutuhan Kerangka Acuan Kerja (KAK), penyusunan RAB, atau jadwal survey venue bersama tim konsultan MICE dan HSE Wahana Totalita.
    </p>
    <div class="eo-cta-actions">
      <a href="<?= $default_wa_url ?>" target="_blank" rel="noopener" class="eo-btn-wa">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
        Konsultasi KAK &amp; Pengadaan via WhatsApp
      </a>
      <a href="mailto:info@wahanatotalita.com" class="eo-btn-tender">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
        Kirim Dokumen via Email
      </a>
    </div>
  </section>

</main>

<script>
// Interactive SBM & Event Cost Estimator
function calculateEventCost() {
  const eventType = document.getElementById('event_type').value;
  const eventLoc  = document.getElementById('event_loc').value;
  const paxCount  = parseInt(document.getElementById('pax_count').value, 10);

  // Base rate per pax
  let baseRate = 450000;
  let notePax  = "Ballroom, 2x Coffee Break, 1x Lunch & Audio Visual";
  
  if (eventType === 'fullday') {
    baseRate = 450000;
    notePax  = "Ballroom Hotel *4, 2x Coffee Break, 1x Lunch & Audio Standard SBM";
  } else if (eventType === 'fullboard') {
    baseRate = 1250000;
    notePax  = "Kamar Twin Hotel *4, 3x Makan, 2x Snack, Ballroom & Meeting Kit Lengkap";
  } else if (eventType === 'hse_drill') {
    baseRate = 650000;
    notePax  = "Simulator Api, APAR, Foam B3, Instruktur PJK3 Kemnaker & Sertifikat";
  } else if (eventType === 'bulan_k3') {
    baseRate = 550000;
    notePax  = "Panggung Apel, Rigging, Safety Demo, Spanduk Kampanye & Souvenir K3";
  } else if (eventType === 'raker_bumn') {
    baseRate = 1450000;
    notePax  = "VIP Executive Suite Hotel *5, Gala Dinner, Sound Redundan & Fasilitator";
  } else if (eventType === 'gathering') {
    baseRate = 850000;
    notePax  = "Gala Dinner, Panggung LED Videotron, Artis/MC, Lighting & Sound 20.000W";
  }

  // Location multiplier
  let locMult = 1.0;
  if (eventLoc === 'solo_jogja') locMult = 1.0;
  else if (eventLoc === 'surabaya') locMult = 1.15;
  else if (eventLoc === 'jakarta') locMult = 1.35;
  else if (eventLoc === 'ikn_balikpapan') locMult = 1.55;
  else if (eventLoc === 'industri_luar') locMult = 1.45;

  const ratePax = Math.round(baseRate * locMult);
  const totalBudget = ratePax * paxCount;

  // Format to IDR
  const fRate = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(ratePax);
  const fTotal = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(totalBudget);

  document.getElementById('calc_rate_pax').innerText = fRate + ' / pax';
  document.getElementById('calc_pax_note').innerText = notePax;
  document.getElementById('calc_total_budget').innerText = fTotal;

  // Update WA Link
  const typeText = document.getElementById('event_type').options[document.getElementById('event_type').selectedIndex].text;
  const locText = document.getElementById('event_loc').options[document.getElementById('event_loc').selectedIndex].text;
  const waMsg = "Halo Wahana Totalita, saya mencoba kalkulator event di website. Kami ada rencana acara: " + typeText + ", Lokasi: " + locText + ", Peserta: " + paxCount + " pax (Estimasi: " + fTotal + "). Mohon dikirimkan proposal teknis & KAK resminya.";
  const waLink = "https://wa.me/<?= $wa_number ?>?text=" + encodeURIComponent(waMsg);
  document.getElementById('calc_wa_btn').setAttribute('href', waLink);
}

// Initial calculation run
calculateEventCost();
</script>

<?php include dirname(__DIR__) . '/includes/footer.php'; ?>

</body>
</html>
