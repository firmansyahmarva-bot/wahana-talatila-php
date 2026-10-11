<?php
/**
 * purnabakti/index.php — Master Authority Hub for Pelatihan Masa Persiapan Pensiun (Purnabakti / MPP)
 * URL: /purnabakti/
 */
require_once dirname(__DIR__) . '/config.php';
require_once dirname(__DIR__) . '/includes/purnabakti-data.php';

$s = get_all_settings();
$wa_number = preg_replace('/\D/', '', get_setting('wa_number', '6287759151278'));

// Filter parameters
$search   = trim($_GET['q'] ?? '');
$kategori = trim($_GET['kategori'] ?? '');

$filter = [];
if ($search !== '')   $filter['q'] = $search;
if ($kategori !== '') $filter['kategori'] = $kategori;

$items        = get_all_purnabakti_items($filter);
$categories   = get_purnabakti_categories();
$totalFound   = count($items);

$page_title  = 'Pelatihan Masa Persiapan Pensiun (MPP) Yogyakarta — BUMN, ASN & Korporasi | Wahana Totalita';
$meta_desc   = 'Program pelatihan purnabakti & persiapan pensiun eksekutif di Yogyakarta. Kurikulum 4 pilar (mental, finansial, kesehatan, wirausaha), hotel *4, plus pasangan & kunjungan usaha.';
$canonical   = SITE_URL . '/purnabakti/';

$default_wa_text = "Halo Wahana Totalita, saya dari bagian HR / Manajemen Perusahaan. Kami ingin konsultasi dan meminta proposal resmi Pelatihan Masa Persiapan Pensiun (MPP) di Yogyakarta. Mohon infonya.";
$default_wa_url  = "https://wa.me/{$wa_number}?text=" . rawurlencode($default_wa_text);

// Schema.org Graph
$schema_graph = [
    [
        '@type'        => 'Organization',
        '@id'          => SITE_URL . '/#organization',
        'name'         => 'PT Wahana Totalita Konsultan',
        'url'          => SITE_URL,
        'description'  => 'Lembaga Konsultan Pengembangan SDM, Pelatihan Masa Persiapan Pensiun (MPP) & Sertifikasi Kompetensi Terakreditasi.',
        'contactPoint' => [
            '@type'             => 'ContactPoint',
            'telephone'         => '+62-877-5915-1278',
            'contactType'       => 'Corporate Human Capital & Procurement Service',
            'availableLanguage' => ['Indonesian', 'English']
        ]
    ],
    [
        '@type' => 'BreadcrumbList',
        '@id'   => $canonical . '#breadcrumb',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => SITE_URL . '/'],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Pelatihan Purnabakti (MPP)', 'item' => $canonical]
        ]
    ],
    [
        '@type'       => 'Service',
        '@id'         => $canonical . '#service',
        'name'        => 'Pelatihan Masa Persiapan Pensiun (MPP) & Wisata Wirausaha Yogyakarta',
        'provider'    => ['@id' => SITE_URL . '/#organization'],
        'serviceType' => 'Executive Retirement Transition Training & Corporate Living Laboratory',
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
                'name'  => 'Mengapa Daerah Istimewa Yogyakarta menjadi destinasi utama pelatihan purnabakti korporasi?',
                'answerCount' => 1,
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text'  => 'Yogyakarta memiliki ekosistem retirement ideal: suasana budaya yang tenang dan ramah, biaya hidup terjangkau, serta living laboratory kewirausahaan pensiun yang sangat kaya mulai dari greenhouse melon hidroponik di Sleman, peternakan terpadu kambing etawa di lereng Merapi, sentra perikanan bioflok di Bantul, hingga bisnis homestay dan kuliner heritage yang dipimpin langsung oleh mantan purnawirawan BUMN.'
                ]
            ],
            [
                '@type' => 'Question',
                'name'  => 'Apa saja 4 pilar utama kurikulum pelatihan masa persiapan pensiun Wahana Totalita?',
                'answerCount' => 1,
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text'  => 'Kurikulum kami mengintegrasikan: (1) Pilar Psikologis & Spiritualitas untuk mengatasi Post-Power Syndrome dan menata hubungan bersama pasangan, (2) Pilar Finansial & Investasi Aman untuk mengelola uang pesangon/DPLK bebas investasi bodong, (3) Pilar Kesehatan & Wellness Usia Emas untuk pencegahan penyakit degeneratif, dan (4) Pilar Kewirausahaan & Studi Lapangan ke unit usaha nyata.'
                ]
            ],
            [
                '@type' => 'Question',
                'name'  => 'Mengapa program purnabakti sangat direkomendasikan mengikutsertakan suami/istri (pasangan)?',
                'answerCount' => 1,
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text'  => 'Pensiun adalah transformasi kehidupan keluarga. Pasangan adalah mitra hidup harian yang terdampak langsung oleh perubahan jadwal, pengelolaan kas rumah tangga, dan pemilihan aktivitas pensiun. Menghadirkan pasangan memastikan tidak ada friksi harapan dan menyelaraskan komitmen bersama dalam menjalani babak hidup baru.'
                ]
            ],
            [
                '@type' => 'Question',
                'name'  => 'Apakah Wahana Totalita melayani pengadaan B2B BUMN dan LPSE instansi pemerintah dengan kelengkapan SPK dan faktur pajak?',
                'answerCount' => 1,
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text'  => 'Ya, Wahana Totalita adalah badan hukum PT resmi dengan NPWP, status PKP, terdaftar di LPSE dan PADI UMKM BUMN. Kami menyediakan dokumen pengadaan lengkap: Kerangka Acuan Kerja (KAK/TOR), Surat Perjanjian Kerja (SPK), Berita Acara Serah Terima (BAST), kuitansi bermeterai, serta Faktur Pajak PPh 23 dan PPN.'
                ]
            ],
            [
                '@type' => 'Question',
                'name'  => 'Berapa durasi ideal dan estimasi biaya per peserta untuk pelatihan MPP?',
                'answerCount' => 1,
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text'  => 'Durasi paling direkomendasikan adalah 4 Hari 3 Malam di Yogyakarta dengan hotel bintang 4. Biaya reguler public training mulai dari Rp 7.500.000 / orang, sedangkan paket eksekutif all-in bersama pasangan berkisar antara Rp 14.500.000 hingga Rp 17.500.000 per pasang, sudah mencakup hotel, konsumsi penuh, transportasi wisata, praktisi narasumber, tiket masuk usaha, dan gala dinner.'
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
/* Purnabakti Hub Styles */
.mpp-hero {
  background: linear-gradient(135deg, #091e36 0%, #102d4f 50%, #0d2238 100%);
  color: #fff;
  padding: 60px 0 52px;
  position: relative;
  overflow: hidden;
  border-bottom: 4px solid #f59e0b;
}
.mpp-hero::before {
  content: "";
  position: absolute;
  top: 0; right: 0; bottom: 0; left: 0;
  background: radial-gradient(circle at 80% 20%, rgba(245, 158, 11, 0.12) 0%, transparent 60%);
  pointer-events: none;
}
.mpp-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: rgba(245, 158, 11, 0.16);
  border: 1px solid rgba(245, 158, 11, 0.45);
  color: #fde68a;
  font-size: 13px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: .06em;
  padding: 6px 14px;
  border-radius: 99px;
  margin-bottom: 16px;
}
.mpp-hero h1 {
  font-size: clamp(26px, 4vw, 44px);
  font-weight: 800;
  line-height: 1.25;
  margin-bottom: 18px;
  color: #ffffff;
}
.mpp-hero h1 em {
  font-style: normal;
  color: #fbbf24;
}
.mpp-hero p.lead {
  font-size: clamp(15px, 1.8vw, 17.5px);
  color: #e2e8f0;
  max-width: 840px;
  line-height: 1.65;
  margin-bottom: 28px;
}
.mpp-hero-actions {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  align-items: center;
}
.mpp-btn-wa {
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
.mpp-btn-wa:hover {
  background: #20ba5a;
  transform: translateY(-2px);
  color: #fff;
}
.mpp-btn-outline {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: rgba(255,255,255,0.08);
  color: #fff;
  border: 1px solid rgba(255,255,255,0.28);
  font-weight: 600;
  font-size: 15px;
  padding: 13px 22px;
  border-radius: 10px;
  text-decoration: none;
}
.mpp-btn-outline:hover {
  background: rgba(255,255,255,0.18);
  color: #fff;
}
.mpp-trust-bar {
  display: flex;
  flex-wrap: wrap;
  gap: 22px;
  margin-top: 34px;
  padding-top: 22px;
  border-top: 1px solid rgba(255,255,255,0.12);
  font-size: 13.5px;
  color: #94a3b8;
}
.mpp-trust-bar span {
  display: flex;
  align-items: center;
  gap: 8px;
  color: #f1f5f9;
}
.mpp-trust-bar svg {
  width: 18px;
  height: 18px;
  color: #fbbf24;
}

/* 4 Pillars Presentation */
.mpp-pillars-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  gap: 20px;
  margin-top: 28px;
}
.mpp-pillar-item {
  background: #fff;
  border: 1px solid #e2e8f0;
  border-radius: 12px;
  padding: 24px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.03);
  position: relative;
  overflow: hidden;
  border-top: 4px solid #f59e0b;
}
.mpp-pillar-item h4 {
  font-size: 17px;
  font-weight: 800;
  color: #0f172a;
  margin: 0 0 10px;
}
.mpp-pillar-item p {
  font-size: 13.5px;
  color: #475569;
  line-height: 1.55;
  margin: 0;
}

/* Category Filter Chips */
.mpp-filter-section {
  background: #f8fafc;
  padding: 20px 0;
  border-bottom: 1px solid #e2e8f0;
}
.mpp-filter-bar {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  align-items: center;
  justify-content: center;
}
.mpp-filter-chip {
  padding: 8px 18px;
  border-radius: 99px;
  font-size: 13.5px;
  font-weight: 600;
  text-decoration: none;
  background: #fff;
  color: #334155;
  border: 1px solid #cbd5e1;
  transition: all .2s;
}
.mpp-filter-chip:hover {
  background: #f1f5f9;
  border-color: #94a3b8;
  color: #0f172a;
}
.mpp-filter-chip.active {
  background: #091e36;
  color: #fff;
  border-color: #091e36;
}

/* Programs Grid */
.mpp-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
  gap: 24px;
  margin-top: 32px;
}
.mpp-card {
  background: #fff;
  border: 1px solid #e2e8f0;
  border-radius: 14px;
  padding: 26px;
  display: flex;
  flex-direction: column;
  transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
  box-shadow: 0 4px 14px rgba(0,0,0,0.03);
}
.mpp-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 12px 26px rgba(0,0,0,0.08);
  border-color: #f59e0b;
}
.mpp-card-tag {
  font-size: 11.5px;
  font-weight: 700;
  text-transform: uppercase;
  color: #b45309;
  background: #fef3c7;
  border: 1px solid #fde68a;
  padding: 3px 10px;
  border-radius: 6px;
  align-self: flex-start;
  margin-bottom: 12px;
}
.mpp-card h3 {
  font-size: 19px;
  font-weight: 800;
  color: #0f172a;
  margin: 0 0 10px;
  line-height: 1.35;
}
.mpp-card h3 a {
  color: inherit;
  text-decoration: none;
}
.mpp-card h3 a:hover {
  color: #d97706;
}
.mpp-card p.desc {
  font-size: 14px;
  color: #475569;
  line-height: 1.55;
  margin-bottom: 16px;
  flex-grow: 1;
}
.mpp-card-price-box {
  background: #f8fafc;
  border-radius: 8px;
  padding: 12px 14px;
  font-size: 13px;
  color: #334155;
  margin-bottom: 18px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.mpp-card-price-box strong {
  font-size: 16px;
  color: #0A4A2E;
  font-weight: 800;
}
.mpp-card-actions {
  display: flex;
  gap: 10px;
  align-items: center;
}
.mpp-card-btn {
  flex: 1;
  text-align: center;
  padding: 10px 14px;
  border-radius: 8px;
  font-size: 13.5px;
  font-weight: 700;
  text-decoration: none;
}
.mpp-card-btn-primary {
  background: #091e36;
  color: #fff;
}
.mpp-card-btn-primary:hover {
  background: #102d4f;
  color: #fff;
}
.mpp-card-btn-wa {
  background: #25D366;
  color: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 42px;
  padding: 10px 0;
}
.mpp-card-btn-wa:hover {
  background: #20ba5a;
  color: #fff;
}

/* Calculator Box */
.mpp-calc-box {
  background: linear-gradient(135deg, #091e36 0%, #153e6b 100%);
  color: #fff;
  border-radius: 16px;
  padding: 36px 32px;
  margin: 48px 0;
  border: 1px solid rgba(245, 158, 11, 0.3);
}
.mpp-calc-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(290px, 1fr));
  gap: 32px;
  align-items: center;
}
.mpp-calc-form label {
  display: block;
  font-size: 13px;
  font-weight: 600;
  color: #cbd5e1;
  margin-bottom: 6px;
}
.mpp-calc-form select, .mpp-calc-form input {
  width: 100%;
  padding: 11px 14px;
  border-radius: 8px;
  border: 1px solid #334155;
  background: #0f172a;
  color: #fff;
  font-size: 14.5px;
  margin-bottom: 16px;
}
.mpp-calc-result {
  background: rgba(255,255,255,0.06);
  border: 1px solid rgba(255,255,255,0.15);
  border-radius: 12px;
  padding: 24px;
  text-align: center;
}
.mpp-calc-result h4 {
  color: #fde68a;
  font-size: 13px;
  text-transform: uppercase;
  letter-spacing: .08em;
  margin: 0 0 8px;
}
.mpp-calc-result .val {
  font-size: clamp(24px, 3.5vw, 36px);
  font-weight: 800;
  color: #34d399;
  margin-bottom: 6px;
}
.mpp-calc-result p {
  color: #cbd5e1;
  font-size: 13px;
  margin-bottom: 20px;
}

/* Pricing Table */
.mpp-table-box {
  background: #fff;
  border: 1px solid #e2e8f0;
  border-radius: 12px;
  overflow-x: auto;
  margin-top: 24px;
}
.mpp-table {
  width: 100%;
  border-collapse: collapse;
  text-align: left;
  font-size: 14px;
}
.mpp-table th {
  background: #091e36;
  color: #fff;
  padding: 14px 18px;
  font-weight: 700;
  font-size: 13px;
  text-transform: uppercase;
  letter-spacing: .04em;
}
.mpp-table td {
  padding: 14px 18px;
  border-bottom: 1px solid #f1f5f9;
  color: #334155;
  vertical-align: top;
}
.mpp-table tr:hover td {
  background: #f8fafc;
}

/* Jogja Living Lab Section */
.mpp-lab-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  gap: 20px;
  margin-top: 28px;
}
.mpp-lab-card {
  background: #f8fafc;
  border: 1px solid #e2e8f0;
  border-radius: 12px;
  padding: 22px;
}
.mpp-lab-card h4 {
  font-size: 16.5px;
  font-weight: 800;
  color: #0f172a;
  margin: 0 0 8px;
}
.mpp-lab-card p {
  font-size: 13.5px;
  color: #475569;
  line-height: 1.55;
  margin: 0;
}
.mpp-lab-loc {
  display: inline-block;
  margin-top: 10px;
  font-size: 12px;
  font-weight: 700;
  color: #b45309;
}
</style>
</head>
<body>

<?php require dirname(__DIR__) . '/includes/navbar.php'; ?>

<!-- HERO -->
<section class="mpp-hero">
  <div class="container">
    <div class="mpp-badge">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
      Executive Retirement Transition &amp; Corporate Living Lab
    </div>
    <h1>Pelatihan Masa Persiapan Pensiun <em>(MPP)</em> di Yogyakarta</h1>
    <p class="lead">
      Bekali insan terbaik korporasi Anda menyongsong masa purnabakti yang bermakna, sejahtera finansial, dan sehat lahir batin. Program komprehensif 4 hari 3 malam di Yogyakarta: <strong>Kesiapan Mental, Proteksi Uang Pesangon Bebas Penipuan, Wellness Usia Emas, &amp; Kunjungan Usaha Nyata Bersama Pasangan.</strong>
    </p>

    <div class="mpp-hero-actions">
      <a href="<?= $default_wa_url ?>" class="mpp-btn-wa" target="_blank" rel="noopener">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
        Minta Proposal &amp; Silabus Resmi (B2B HR)
      </a>
      <a href="#katalog" class="mpp-btn-outline">Pilihan Program &amp; Silabus (<?= count(get_all_purnabakti_items()) ?>)</a>
    </div>

    <div class="mpp-trust-bar">
      <span><svg viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>Rekanan Resmi LPSE &amp; BUMN PADI UMKM</span>
      <span><svg viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>Hotel Bintang 4 &amp; Fasilitas VIP Pasangan</span>
      <span><svg viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>Narasumber Certified (CFP, Psikolog &amp; Dokter)</span>
      <span><svg viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>Kunjungan Usaha Riil di Sleman &amp; Bantul</span>
    </div>
  </div>
</section>

<!-- 4 PILLARS EXPLANATION -->
<section style="padding: 56px 0 40px; background: #fff;">
  <div class="container">
    <div style="text-align:center; max-width:760px; margin:0 auto 32px;">
      <span style="color:#b45309; font-weight:700; font-size:13px; text-transform:uppercase; letter-spacing:.08em;">Kurikulum Holistik Teruji</span>
      <h2 style="font-size:clamp(22px, 3.2vw, 34px); color:#0f172a; font-weight:800; margin:6px 0 12px;">
        Empat Pilar Kesiapan Purna Tugas Bahagia &amp; Berdaya
      </h2>
      <p style="color:#64748b; font-size:15px; margin:0;">
        Program kami dirancang tidak hanya untuk mengisi waktu luang, tetapi memberikan transformasi menyeluruh bagi purnawirawan korporasi dan pasangannya:
      </p>
    </div>

    <div class="mpp-pillars-grid">
      <div class="mpp-pillar-item">
        <h4>1. Pilar Psikologis &amp; Spiritual</h4>
        <p>
          Mengatasi Post-Power Syndrome, restrukturisasi identitas diri lepas dari atribut jabatan kantor, dialog keterbukaan bersama pasangan, dan menemukan Ikigai (makna hidup baru).
        </p>
      </div>

      <div class="mpp-pillar-item">
        <h4>2. Pilar Finansial &amp; Proteksi Aset</h4>
        <p>
          Pengelolaan uang pesangon BUMN &amp; DPLK dengan Strategi 3 Keranjang (Likuiditas, Pendapatan Tetap, Pertumbuhan). Mitigasi 5 ciri investasi bodong dan perencanaan waris keluarga.
        </p>
      </div>

      <div class="mpp-pillar-item">
        <h4>3. Pilar Kesehatan &amp; Wellness</h4>
        <p>
          Skrining kebugaran (Mini MCU), nutrisi ramah gula/garam usia 50+, senam vitalitas lansia low-impact, manajemen tidur tanpa obat kimia, dan ergonomi rumah aman jatuh.
        </p>
      </div>

      <div class="mpp-pillar-item">
        <h4>4. Pilar Wirausaha &amp; Living Lab</h4>
        <p>
          Studi lapangan langsung ke unit usaha nyata di Yogyakarta: Agribisnis greenhouse hidroponik Sleman, peternakan terpadu kambing etawa Kaliurang, kuliner, dan boutique homestay.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- INTERACTIVE B2B RETIREMENT BUDGET CALCULATOR -->
<section style="padding: 20px 0; background: #fff;">
  <div class="container">
    <div class="mpp-calc-box">
      <div class="mpp-calc-grid">
        <div class="mpp-calc-form">
          <span style="color:#fde68a; font-weight:700; font-size:12px; text-transform:uppercase; letter-spacing:.08em;">B2B Corporate Cost Estimator</span>
          <h3 style="color:#fff; font-size:24px; font-weight:800; margin:6px 0 16px;">Simulasi Estimasi Anggaran MPP Instansi</h3>
          
          <label for="calc-peserta">Jumlah Karyawan Peserta Purna Tugas:</label>
          <input type="number" id="calc-peserta" min="5" max="200" value="10">

          <label for="calc-tipe">Format Pendampingan:</label>
          <select id="calc-tipe">
            <option value="pasangan">Plus Pasangan (Suami/Istri Ikut Serta - Rekomendasi)</option>
            <option value="individu">Hanya Karyawan (Tanpa Pasangan)</option>
          </select>

          <label for="calc-durasi">Durasi &amp; Paket Pelaksanaan di Yogyakarta:</label>
          <select id="calc-durasi">
            <option value="4h3m">4 Hari 3 Malam (Executive Hotel *4 All-In + 3 Kunjungan Usaha)</option>
            <option value="3h2m">3 Hari 2 Malam (Intensive Hotel *4 All-In + 2 Kunjungan Usaha)</option>
          </select>
        </div>

        <div class="mpp-calc-result">
          <h4>Perkiraan Alokasi Anggaran Investasi:</h4>
          <div class="val" id="calc-total">Rp 155.000.000</div>
          <p id="calc-detail">Estimasi untuk 10 pasang (20 orang), 4H3M Hotel *4 Yogyakarta, Fullboard, Transport &amp; Kunjungan Usaha.</p>
          <a href="<?= $default_wa_url ?>" id="calc-wa-btn" class="mpp-btn-wa" target="_blank" rel="noopener" style="justify-content:center;">
            Kirim Rincian Ini ke WhatsApp HR
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FILTER SECTION -->
<section class="mpp-filter-section" id="katalog">
  <div class="container">
    <div class="mpp-filter-bar">
      <a href="/purnabakti/" class="mpp-filter-chip <?= empty($kategori) ? 'active' : '' ?>">Semua Program (<?= count(get_all_purnabakti_items()) ?>)</a>
      <?php foreach ($categories as $catKey => $catLabel): ?>
      <a href="/purnabakti/?kategori=<?= $catKey ?>" class="mpp-filter-chip <?= ($kategori === $catKey) ? 'active' : '' ?>">
        <?= htmlspecialchars($catLabel) ?>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- SERVICES GRID -->
<section style="padding: 48px 0 60px; background: #fff;">
  <div class="container">
    <div style="display:flex; justify-content:space-between; align-items:flex-end; flex-wrap:wrap; gap:16px;">
      <div>
        <span style="color:#b45309; font-weight:700; font-size:13px; text-transform:uppercase; letter-spacing:.08em;">Katalog Program Masa Persiapan Pensiun</span>
        <h2 style="font-size:clamp(22px, 3vw, 32px); color:#0f172a; font-weight:800; margin:6px 0 0;">
          Pilih Silabus &amp; Program yang Sesuai Kebutuhan Karyawan
        </h2>
      </div>
      <p style="color:#64748b; font-size:14px; margin:0;">
        Menampilkan <strong><?= $totalFound ?></strong> modul spesialisasi purnabakti
      </p>
    </div>

    <div class="mpp-grid">
      <?php foreach ($items as $item): 
        $item_wa_text = "Halo Wahana Totalita, saya ingin meminta proposal resmi untuk program: {$item['judul']}. Mohon info jadwal dan penawaran biayanya.";
        $item_wa_url  = "https://wa.me/{$wa_number}?text=" . rawurlencode($item_wa_text);
      ?>
      <article class="mpp-card">
        <span class="mpp-card-tag"><?= htmlspecialchars($item['kategori_label']) ?></span>
        <h3><a href="/purnabakti/<?= htmlspecialchars($item['slug']) ?>/"><?= htmlspecialchars($item['judul']) ?></a></h3>
        <p class="desc"><?= htmlspecialchars($item['tagline']) ?></p>

        <div class="mpp-card-price-box">
          <div>
            <span style="display:block; font-size:11.5px; color:#64748b; text-transform:uppercase;">Investasi Mulai:</span>
            <strong><?= htmlspecialchars($item['biaya_standar']) ?></strong>
          </div>
          <div style="text-align:right;">
            <span style="display:block; font-size:11.5px; color:#64748b;">Durasi Pelatihan:</span>
            <span style="font-weight:700; color:#0f172a;"><?= htmlspecialchars($item['durasi_program']) ?></span>
          </div>
        </div>

        <div class="mpp-card-actions">
          <a href="/purnabakti/<?= htmlspecialchars($item['slug']) ?>/" class="mpp-card-btn mpp-card-btn-primary">
            Lihat Silabus &amp; Jadwal &rarr;
          </a>
          <a href="<?= $item_wa_url ?>" class="mpp-card-btn mpp-card-btn-wa" target="_blank" rel="noopener" title="Konsultasi WhatsApp">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
          </a>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- JOGJA LIVING LAB SHOWCASE -->
<section style="padding: 50px 0; background: #f8fafc; border-top: 1px solid #e2e8f0; border-bottom: 1px solid #e2e8f0;">
  <div class="container">
    <div style="text-align:center; max-width:760px; margin:0 auto 28px;">
      <span style="color:#b45309; font-weight:700; font-size:13px; text-transform:uppercase; letter-spacing:.08em;">The Living Laboratory Advantage</span>
      <h2 style="font-size:clamp(22px, 3vw, 32px); color:#0f172a; font-weight:800; margin:6px 0 12px;">
        Destinasi Kunjungan Usaha Nyata di Yogyakarta
      </h2>
      <p style="color:#64748b; font-size:15px; margin:0;">
        Bukan sekadar wisata biasa, peserta diajak membedah langsung neraca operasional, modal awal, dan kiat sukses para pemilik bisnis purnawirawan di Yogyakarta:
      </p>
    </div>

    <div class="mpp-lab-grid">
      <div class="mpp-lab-card">
        <h4>Greenhouse Melon Hidroponik Presisi</h4>
        <p>
          Budidaya melon premium varietas Jepang dengan fertigasi otomatis di lahan terbatas. Panen per 75 hari dengan serapan pasar supermarket Jakarta &amp; Surabaya yang pasti.
        </p>
        <span class="mpp-lab-loc">&bull; Lokasi: Sleman, D.I. Yogyakarta</span>
      </div>

      <div class="mpp-lab-card">
        <h4>Peternakan Terintegrasi Kambing Etawa</h4>
        <p>
          Pengolahan susu kambing organik pasteurisasi, pakan silase hemat tenaga, dan pemanfaatan kotoran menjadi pupuk padat/cair bernilai ekonomis tinggi.
        </p>
        <span class="mpp-lab-loc">&bull; Lokasi: Lereng Merapi, Kaliurang</span>
      </div>

      <div class="mpp-lab-card">
        <h4>Budidaya Ikan Nila Bioflok Modern</h4>
        <p>
          Teknologi kolam bulat terpal hemat air dan hemat pakan di pekarangan rumah. Menghasilkan panen ikan segar higienis untuk rantai pasok restoran kuliner.
        </p>
        <span class="mpp-lab-loc">&bull; Lokasi: Bantul, D.I. Yogyakarta</span>
      </div>

      <div class="mpp-lab-card">
        <h4>Boutique Homestay &amp; Wisata Kuliner</h4>
        <p>
          Manajemen perhotelan mikro dan kafe bernuansa heritage asri. Kolaborasi dengan Online Travel Agent (OTA) untuk mendulang passive income tanpa stres operasional.
        </p>
        <span class="mpp-lab-loc">&bull; Lokasi: Kota Jogja &amp; Kulon Progo</span>
      </div>
    </div>
  </div>
</section>

<!-- TRANSPARENT B2B PRICING TABLE -->
<section style="padding: 50px 0; background: #fff;">
  <div class="container">
    <div style="text-align:center; max-width:760px; margin:0 auto 28px;">
      <span style="color:#b45309; font-weight:700; font-size:13px; text-transform:uppercase; letter-spacing:.08em;">Transparansi Biaya &amp; Paket Korporasi</span>
      <h2 style="font-size:clamp(22px, 3vw, 32px); color:#0f172a; font-weight:800; margin:6px 0 12px;">
        Tabel Paket Investasi Pelatihan Purnabakti Yogyakarta
      </h2>
      <p style="color:#64748b; font-size:15px; margin:0;">
        Pilihan skema fleksibel untuk anggaran perusahaan swasta, standar BUMN, maupun Standar Biaya Masukan (SBM) APBN/APBD:
      </p>
    </div>

    <div class="mpp-table-box">
      <table class="mpp-table">
        <thead>
          <tr>
            <th>Paket Pelatihan</th>
            <th>Durasi &amp; Fasilitas</th>
            <th>Tarif Perorangan</th>
            <th>Tarif Plus Pasangan</th>
            <th>Keterangan Tambahan</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><strong>Paket Public Training Reguler</strong><br><small>Jadwal Bulanan di Hotel Bintang 4 Jogja</small></td>
            <td>3 Hari 2 Malam<br>Workshop di Kelas + 1 Kunjungan Usaha</td>
            <td><strong>Rp 7.500.000</strong></td>
            <td><strong>Rp 12.500.000</strong></td>
            <td>Tanpa kamar menginap (Non-Residential)</td>
          </tr>
          <tr>
            <td><strong>Paket Executive All-In (+ Pasangan)</strong><br><small>Program Favorit BUMN &amp; Korporasi</small></td>
            <td>4 Hari 3 Malam<br>Hotel *4, 3 Kunjungan Usaha, Gala Dinner</td>
            <td><strong>Rp 11.500.000</strong></td>
            <td><strong>Rp 16.500.000</strong></td>
            <td>All-In Kamar Twin/Double, Konsumsi &amp; Transportasi</td>
          </tr>
          <tr>
            <td><strong>Paket In-House BUMN / Pemda Cohort</strong><br><small>Khusus Rombongan 15–30 Pasang</small></td>
            <td>4 Hari 3 Malam<br>Customized Syllabus, Bus Eksklusif, VIP YIA</td>
            <td><strong>Rp 10.000.000</strong></td>
            <td><strong>Rp 14.500.000</strong></td>
            <td>Termasuk Pembuatan Video Dokumenter Kenangan HC</td>
          </tr>
          <tr>
            <td><strong>Paket Bimtek ASN / PNS (B2G LPSE)</strong><br><small>Standar SBM Kemenkeu &amp; KAK Pemda</small></td>
            <td>3 Hari 2 Malam<br>Modul Taspen, BKN, SPJ &amp; Faktur Pajak Sah</td>
            <td><strong>Rp 6.500.000</strong></td>
            <td><strong>Rp 13.500.000</strong></td>
            <td>Didukung Kuitansi Riil, SPK, BAST &amp; Bukti PPh 23/PPN</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

<!-- FAQ SECTION -->
<section style="padding: 50px 0; background: #f8fafc; border-top: 1px solid #e2e8f0;">
  <div class="container">
    <div style="text-align:center; max-width:700px; margin:0 auto 36px;">
      <span style="color:#b45309; font-weight:700; font-size:13px; text-transform:uppercase; letter-spacing:.08em;">Informasi Pengadaan &amp; Tanya Jawab</span>
      <h2 style="font-size:clamp(22px, 3vw, 30px); color:#0f172a; font-weight:800; margin:6px 0 0;">
        FAQ Pelatihan Masa Persiapan Pensiun
      </h2>
    </div>

    <div style="max-width:840px; margin:0 auto; display:flex; flex-direction:column; gap:14px;">
      <details style="background:#fff; border:1px solid #e2e8f0; border-radius:10px; padding:16px 20px;">
        <summary style="font-weight:700; color:#0f172a; cursor:pointer; font-size:15.5px;">Kapan waktu paling ideal bagi instansi mendaftarkan karyawan ikut pelatihan MPP?</summary>
        <p style="margin:12px 0 0; color:#475569; font-size:14px; line-height:1.6;">
          Waktu paling ideal adalah <strong>1 hingga 3 tahun sebelum Batas Usia Pensiun (BUP)</strong>. Rentang waktu ini memberikan ruang yang cukup bagi calon pensiunan dan pasangannya untuk menyerap materi psikologis, merencanakan portofolio keuangan tanpa terburu-buru, serta mulai merintis atau menguji coba ide bisnis dalam skala kecil sebelum penghasilan tetap dari gaji bulanan resmi berhenti.
        </p>
      </details>

      <details style="background:#fff; border:1px solid #e2e8f0; border-radius:10px; padding:16px 20px;">
        <summary style="font-weight:700; color:#0f172a; cursor:pointer; font-size:15.5px;">Bagaimana kesiapan legalitas Wahana Totalita untuk tender LPSE dan BUMN e-Procurement?</summary>
        <p style="margin:12px 0 0; color:#475569; font-size:14px; line-height:1.6;">
          Wahana Totalita Konsultan berbadan hukum PT resmi dengan NIB berbasis risiko, NPWP, Pengusaha Kena Pajak (PKP), dan terdaftar di portal LPSE LKPP serta PADI UMKM BUMN. Kami menyediakan dokumen lengkap: Kerangka Acuan Kerja (KAK), penawaran harga resmi, draf SPK, BAST, dan Faktur Pajak sah (PPh 23 dan PPN).
        </p>
      </details>

      <details style="background:#fff; border:1px solid #e2e8f0; border-radius:10px; padding:16px 20px;">
        <summary style="font-weight:700; color:#0f172a; cursor:pointer; font-size:15.5px;">Apakah perusahaan luar pulau seperti Kalimantan atau Sumatera bisa difasilitasi penuh penjemputannya di Bandara YIA Jogja?</summary>
        <p style="margin:12px 0 0; color:#475569; font-size:14px; line-height:1.6;">
          Tentu. Sebagian besar klien BUMN dan korporasi pertambangan/perkebunan kami berasal dari Balikpapan, Samarinda, Pekanbaru, Palembang, dan Medan. Tim kami menyediakan layanan VIP Airport Handling di Bandara Internasional Yogyakarta (YIA) di Kulon Progo, mengawal penanganan bagasi, menyediakan armada bus pariwisata eksekutif AC, dan langsung mengantar ke hotel rekanan bintang 4 di pusat Yogyakarta.
        </p>
      </details>

      <details style="background:#fff; border:1px solid #e2e8f0; border-radius:10px; padding:16px 20px;">
        <summary style="font-weight:700; color:#0f172a; cursor:pointer; font-size:15.5px;">Apakah ada kegiatan khusus bagi para istri/suami (pasangan) selama pelatihan berlangsung?</summary>
        <p style="margin:12px 0 0; color:#475569; font-size:14px; line-height:1.6;">
          Ya. Pasangan mengikuti sesi pleno bersama untuk modul psikologi keluarga, kesehatan gizi rumah tangga, dan studi lapangan wirausaha. Selain itu, kami juga menyediakan sesi paralel khusus pasangan seperti workshop kreasi batik sutra tradisional, seni merangkai tanaman hias, atau cooking class resep sehat Nusantara sementara para pensiunan mengikuti pendalaman teknis cashflow pesangon.
        </p>
      </details>
    </div>
  </div>
</section>

<!-- BOTTOM CTA -->
<section style="background:#091e36; color:#fff; padding:54px 0; text-align:center; border-top:1px solid #1e293b;">
  <div class="container">
    <h2 style="color:#fff; font-size:clamp(22px, 3.5vw, 32px); margin:0 0 14px; font-weight:800;">Wujudkan Masa Pensiun Karyawan yang Bahagia, Sehat &amp; Mandiri</h2>
    <p style="color:#cbd5e1; font-size:16px; max-width:680px; margin:0 auto 26px; line-height:1.6;">
      Konsultasikan jadwal pelaksanaan in-house korporasi Anda, permintaan silabus kustom, dan penawaran biaya resmi bersama tim konsultan Wahana Totalita.
    </p>
    <a href="<?= $default_wa_url ?>" class="mpp-btn-wa" target="_blank" rel="noopener" style="font-size:16px; padding:15px 34px;">
      Hubungi Konsultan MPP via WhatsApp (0877-5915-1278)
    </a>
  </div>
</section>

<?php require dirname(__DIR__) . '/includes/footer.php'; ?>

<script>
// Interactive Budget Calculator Logic
document.addEventListener('DOMContentLoaded', function() {
  const inputPeserta = document.getElementById('calc-peserta');
  const selectTipe   = document.getElementById('calc-tipe');
  const selectDurasi = document.getElementById('calc-durasi');
  const elTotal      = document.getElementById('calc-total');
  const elDetail     = document.getElementById('calc-detail');
  const btnWa        = document.getElementById('calc-wa-btn');

  function calculate() {
    let n = parseInt(inputPeserta.value) || 10;
    if (n < 1) n = 1;
    const tipe = selectTipe.value;
    const durasi = selectDurasi.value;

    let ratePerUnit = 0;
    if (tipe === 'pasangan') {
      ratePerUnit = (durasi === '4h3m') ? 15500000 : 13500000;
    } else {
      ratePerUnit = (durasi === '4h3m') ? 10500000 : 8500000;
    }

    // Cohort discount
    if (n >= 20) ratePerUnit *= 0.92;
    else if (n >= 15) ratePerUnit *= 0.95;

    const total = Math.round(n * ratePerUnit);
    const formatted = 'Rp ' + total.toLocaleString('id-ID');

    elTotal.textContent = formatted;
    
    const labelTipe = (tipe === 'pasangan') ? `${n} Pasang Karyawan & Pasangan` : `${n} Karyawan (Individu)`;
    const labelDurasi = (durasi === '4h3m') ? '4 Hari 3 Malam' : '3 Hari 2 Malam';
    elDetail.textContent = `Estimasi alokasi untuk ${labelTipe}, paket ${labelDurasi} Hotel Bintang 4 Yogyakarta (Fullboard, Field Trip, Narasumber).`;

    const waMsg = `Halo Wahana Totalita, saya telah menghitung simulasi anggaran Pelatihan MPP di Yogyakarta: ${labelTipe}, Durasi ${labelDurasi}, Estimasi: ${formatted}. Mohon kirimkan proposal resmi dan detail silabusnya ke perusahaan kami.`;
    btnWa.href = `https://wa.me/<?= $wa_number ?>?text=` + encodeURIComponent(waMsg);
  }

  inputPeserta.addEventListener('input', calculate);
  selectTipe.addEventListener('change', calculate);
  selectDurasi.addEventListener('change', calculate);
  calculate();
});
</script>
<script src="/assets/js/main.js" defer></script>
</body>
</html>
