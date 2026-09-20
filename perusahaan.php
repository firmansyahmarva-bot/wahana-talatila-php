<?php
/**
 * perusahaan.php — B2B corporate training landing page (Google Ads ready).
 * Target: HSE/HR/GA managers & corporate decision makers (NOT individual students).
 * Goal: WhatsApp inquiries + proposal requests from companies.
 * Reuses includes/navbar.php + scripts.php and the site theme variables.
 * Slim ad-page footer on purpose (full site footer removed to reduce exit paths).
 */
require_once __DIR__ . '/config.php';

$s = get_all_settings();

$wa_number  = preg_replace('/\D/', '', get_setting('wa_number', '6287759151278'));
$phone_disp = '0' . substr($wa_number, 2);
$phone_disp = trim(chunk_split($phone_disp, 4, '-'), '-');
$wa_diskusi = "https://wa.me/{$wa_number}?text=" . rawurlencode('Halo, saya dari perusahaan dan ingin konsultasi kebutuhan training K3 untuk tim kami. Mohon dibantu.');
$wa_proposal= "https://wa.me/{$wa_number}?text=" . rawurlencode('Halo, kami ingin minta proposal training K3 / in house training untuk perusahaan kami. Mohon dikirimkan penawarannya.');
$wa_service = fn(string $svc) => "https://wa.me/{$wa_number}?text=" . rawurlencode("Halo, kami tertarik dengan {$svc} untuk perusahaan kami. Mohon info silabus & penawarannya.");
$year = date('Y');

$page_title = 'Training K3 Perusahaan — In House Training & Sertifikasi | Wahana Totalita';
$meta_desc  = 'Training K3 perusahaan & In House Training K3 resmi KEMNAKER RI dan BNSP. Corporate HSE training, konsultasi ISO, sertifikasi K3 untuk industri seluruh Indonesia. Proposal dalam 24 jam.';
$canon_url  = SITE_URL . '/perusahaan';

/* ── Data ─────────────────────────────────────────────────── */
$pains = [
  ['<svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18M12 14v3M12 19h.01"/></svg>','Audit SMK3 Sudah di Depan Mata','Auditor datang beberapa bulan lagi, tapi dokumen belum rapi dan personel belum kompeten. Satu temuan mayor bisa menggagalkan sertifikasi yang sudah dinanti direksi.'],
  ['<svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/></svg>','Sertifikat Personel Hampir Kedaluwarsa','Lisensi Ahli K3, operator, dan petugas Anda punya masa berlaku. Telat perpanjang = personel tidak sah bekerja, dan operasional bisa terhenti mendadak.'],
  ['<svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6M9 15l2 2 4-4"/></svg>','Kalah Tender karena Persyaratan K3','Klien & CSMS mensyaratkan personel bersertifikat KEMNAKER/BNSP. Tanpa itu, penawaran terbaik pun gugur di tahap pra-kualifikasi — sebelum harga dibuka.'],
  ['<svg viewBox="0 0 24 24"><path d="M12 9v4m0 4h.01M10.3 3.9 1.8 18a2 2 0 0 0 1.7 3h17a2 2 0 0 0 1.7-3L13.7 3.9a2 2 0 0 0-3.4 0z"/></svg>','Target Zero Accident Terancam','Satu kecelakaan kerja berarti investigasi, kompensasi, reputasi rusak, dan KPI HSE merah. Pencegahan lewat pelatihan selalu jauh lebih murah daripada satu insiden.'],
  ['<svg viewBox="0 0 24 24"><path d="M9 11l3 3 8-8"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>','Temuan Compliance KEMNAKER','Inspeksi pengawas ketenagakerjaan menemukan kewajiban training Kemnaker yang belum dipenuhi? Sanksi administratif dan proyek tertunda adalah risikonya.'],
  ['<svg viewBox="0 0 24 24"><circle cx="9" cy="7" r="4"/><path d="M2 21c0-4 3-6 7-6s7 2 7 6M19 8v6M22 11h-6"/></svg>','Karyawan Baru & Gap Kompetensi HSE','Rekrutmen berjalan cepat, tapi onboarding K3 tertinggal. Karyawan baru yang belum terlatih adalah risiko berjalan di lantai produksi Anda setiap hari.'],
];

$services = [
  ['<svg viewBox="0 0 24 24"><path d="M3 21h18M5 21V7l8-4v18M19 21V11l-6-4"/></svg>','In House Training K3','Corporate safety training di lokasi perusahaan Anda — materi disesuaikan proses & risiko industri, hemat biaya untuk grup besar.'],
  ['<svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>','Public Training','Kirim 1–5 karyawan mengikuti jadwal reguler kami — training Kemnaker & BNSP setiap bulan, online maupun tatap muka.'],
  ['<svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 1 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 1 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 1 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 1 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>','Konsultasi Sistem Manajemen','Pendampingan SMK3 PP 50/2012, ISO 45001, ISO 14001, ISO 9001 — dari gap analysis hingga sistem berjalan.'],
  ['<svg viewBox="0 0 24 24"><path d="M12 2l3 6 6 .9-4.5 4.3 1 6.3L12 17l-5.5 2.8 1-6.3L3 8.9 9 8z"/></svg>','Pendampingan Sertifikasi K3','Kami dampingi personel & perusahaan hingga lulus sertifikasi K3 KEMNAKER RI maupun BNSP — termasuk administrasinya.'],
  ['<svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>','Audit Internal','Pelaksanaan & pelatihan auditor internal SMK3/ISO agar perusahaan selalu siap menghadapi audit eksternal.'],
  ['<svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6M16 13H8M16 17H8M10 9H8"/></svg>','Penyusunan Dokumen','Manual, prosedur, IBPR/HIRADC, JSA, dan dokumen CSMS — disusun sesuai standar klien & regulator.'],
  ['<svg viewBox="0 0 24 24"><path d="M3 11l18-8-8 18-2-8z"/></svg>','Safety Campaign','Program budaya K3: safety talk, bulan K3 nasional, kampanye visual, hingga observasi perilaku (BBS).'],
  ['<svg viewBox="0 0 24 24"><path d="M12 2a7 7 0 0 1 7 7c0 3-2 5-3 6l-1 6h-6l-1-6c-1-1-3-3-3-6a7 7 0 0 1 7-7z"/></svg>','Emergency Response','Pelatihan & simulasi tanggap darurat: kebakaran, P3K, evakuasi, hingga penyusunan ERP perusahaan.'],
];

$programs = [
  ['Mandatory Training KEMNAKER','Ahli K3 Umum, K3 Listrik, Operator Forklift, TKBT/TKPK, Petugas P3K, Damkar','Training Kemnaker wajib'],
  ['Sertifikasi BNSP','Sertifikasi K3 berbasis kompetensi: Auditor SMK3, Petugas K3, dan skema BNSP lainnya','Sertifikasi BNSP'],
  ['Custom In House Training','Materi dirancang khusus sesuai risiko site, temuan audit, dan SOP perusahaan Anda','Custom In House Training'],
  ['Soft Skills & Pelatihan Karyawan','Komunikasi K3, 5S/5R, safety leadership dasar, dan pengembangan SDM operasional','Soft Skills Training'],
  ['ISO & Sistem Manajemen','ISO 45001, ISO 14001, ISO 9001, SMK3 PP 50/2012 — awareness hingga auditor internal','Training ISO'],
  ['Environmental / Lingkungan','Pengelolaan limbah B3, pengendalian pencemaran, kepatuhan lingkungan industri','Training Lingkungan'],
  ['Mining Safety','POP, POM, POU — pengawas operasional pertambangan sesuai regulasi ESDM','Training Mining Safety'],
  ['HSE Leadership','Safety leadership untuk supervisor, superintendent, dan manager lini produksi','Training HSE Leadership'],
];

$reasons = [
  ['<svg viewBox="0 0 24 24"><path d="M13 2L3 14h9l-1 8 10-12h-9z"/></svg>','Proposal dalam 24 Jam','Diskusi hari ini, proposal + quotation resmi masuk email Anda besok. Tanpa menunggu berminggu-minggu.'],
  ['<svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>','Jadwal Fleksibel','Weekday, weekend, atau menyesuaikan shift produksi — training mengikuti operasional Anda, bukan sebaliknya.'],
  ['<svg viewBox="0 0 24 24"><path d="M3 21h18M5 21V7l8-4v18M19 21V11l-6-4"/></svg>','Bisa In House di Site Anda','Instruktur datang ke lokasi perusahaan di mana pun di Indonesia — hemat akomodasi, produksi tetap jalan.'],
  ['<svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 4-6 8-6s8 2 8 6"/></svg>','Instruktur Praktisi Industri','Pengajar adalah praktisi aktif di konstruksi, tambang, dan manufaktur — studi kasus nyata, bukan sekadar teori.'],
  ['<svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M9 12l2 2 4-4"/></svg>','Sertifikat Resmi & Diakui','Sertifikat KEMNAKER RI & BNSP yang sah untuk audit SMK3, CSMS, dan persyaratan tender.'],
  ['<svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6M9 15l2 2 4-4"/></svg>','Administrasi Dibantu Penuh','Vendor registration, invoice, faktur pajak, hingga penerbitan sertifikat — semua kami urus sampai selesai.'],
  ['<svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3a15 15 0 0 1 0 18 15 15 0 0 1 0-18z"/></svg>','Training Seluruh Indonesia','Jaringan instruktur training safety Indonesia dari Sumatera hingga Papua — respons cepat, biaya efisien.'],
  ['<svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>','Support Setelah Training','Konsultasi implementasi pasca-pelatihan tanpa biaya tambahan — kami pastikan ilmunya diterapkan.'],
];

$industries = [
  ['<svg viewBox="0 0 24 24"><path d="M2 20h20M4 20V10l5 3v-3l5 3V4h6v16"/></svg>','Manufacturing'],
  ['<svg viewBox="0 0 24 24"><path d="M2 20l4-9 4 5 3-7 4 6 3-4 2 9z"/></svg>','Mining'],
  ['<svg viewBox="0 0 24 24"><path d="M2 20h20M4 20V8l6 4V8l6 4V4h4v16"/></svg>','Construction'],
  ['<svg viewBox="0 0 24 24"><path d="M12 2a7 7 0 0 1 7 7c0 5-7 13-7 13S5 14 5 9a7 7 0 0 1 7-7z"/><circle cx="12" cy="9" r="2.5"/></svg>','Oil &amp; Gas'],
  ['<svg viewBox="0 0 24 24"><path d="M13 2L3 14h9l-1 8 10-12h-9z"/></svg>','Power Plant'],
  ['<svg viewBox="0 0 24 24"><path d="M12 22V8M12 8c-4 0-7-3-7-6 3 0 6 1 7 4 1-3 4-4 7-4 0 3-3 6-7 6zM7 22c0-3 2-5 5-5s5 2 5 5"/></svg>','Palm Oil'],
  ['<svg viewBox="0 0 24 24"><path d="M10 2v6L4 18a2 2 0 0 0 2 3h12a2 2 0 0 0 2-3l-6-10V2M8 2h8M6.5 14h11"/></svg>','Chemical'],
  ['<svg viewBox="0 0 24 24"><rect x="1" y="6" width="14" height="11" rx="1"/><path d="M15 10h4l3 4v3h-7zM6 20a2 2 0 1 0 0-.01M19 20a2 2 0 1 0 0-.01"/></svg>','Logistics'],
  ['<svg viewBox="0 0 24 24"><path d="M3 21h18M5 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16M12 7v6M9 10h6"/></svg>','Hospital'],
  ['<svg viewBox="0 0 24 24"><path d="M3 21h18M4 21V9l8-6 8 6v12M9 21v-6h6v6"/></svg>','Government'],
];

$process = [
  ['Konsultasi','Ceritakan tantangan K3 perusahaan Anda via WhatsApp — gratis.'],
  ['Analisis Kebutuhan','Kami petakan gap kompetensi & kewajiban regulasi tim Anda.'],
  ['Proposal','Silabus, jadwal, instruktur, dan investasi — dalam 24 jam.'],
  ['Penjadwalan','Tanggal dikunci menyesuaikan operasional & shift produksi.'],
  ['Pelaksanaan','Training berjalan di site Anda atau kelas kami.'],
  ['Sertifikasi','Sertifikat resmi KEMNAKER/BNSP diproses & diterbitkan.'],
  ['Reporting','Laporan hasil & rekomendasi tindak lanjut untuk manajemen.'],
  ['After Sales Support','Konsultasi implementasi berlanjut setelah training selesai.'],
];

$packages = [
  ['IN-HOUSE TRAINING','Ideal untuk 10–100 peserta','Perusahaan dengan banyak personel yang butuh pelatihan serentak di lokasi sendiri.',
    ['Materi custom sesuai risiko industri Anda','Hemat biaya per peserta hingga 40%','Tanpa biaya perjalanan peserta','Jadwal menyesuaikan operasional','Sertifikat resmi seluruh peserta'],'In House Training K3',true],
  ['PUBLIC TRAINING','Karyawan mengikuti jadwal kami','Kebutuhan 1–5 peserta per program tanpa menunggu kuota internal terpenuhi.',
    ['Jadwal reguler setiap bulan','Networking antar praktisi K3','Online (Zoom) atau tatap muka','Biaya per peserta transparan','Sertifikat resmi KEMNAKER/BNSP'],'Public Training K3',false],
  ['CONSULTING &amp; CERTIFICATION','Pendampingan hingga lulus audit','Perusahaan yang mengejar sertifikasi SMK3, ISO 45001/14001/9001, atau kualifikasi CSMS.',
    ['Gap analysis & roadmap kepatuhan','Penyusunan dokumen lengkap','Pelatihan auditor internal','Pendampingan saat audit eksternal','Garansi pendampingan sampai lulus'],'Konsultasi & Sertifikasi',false],
];

$testimonials = [
  ['AH','"Kami berhasil menutup seluruh temuan audit klien dalam satu semester. Tim Wahana responsif dan benar-benar memahami kebutuhan kontraktor."','Andi H.','HSE Manager','Konstruksi Nasional','Lulus audit CSMS klien — nihil temuan mayor'],
  ['SR','"Training K3 perusahaan yang mereka rancang langsung menjawab temuan audit SMK3 kami. Instrukturnya praktisi, contoh kasusnya nyata dan langsung diterapkan di lini produksi."','Sari R.','HRD Manager','Manufaktur Otomotif','Sertifikasi SMK3 tercapai di audit pertama'],
  ['BP','"Administrasi sangat cepat — quotation sehari jadi, sertifikat tidak pakai lama. Untuk kebutuhan tender migas, kecepatan seperti ini sangat berharga."','Bambang P.','Training Coordinator','Kontraktor Migas','Lolos pra-kualifikasi tender tepat waktu'],
];

$faqs = [
  ['Apakah training bisa dilaksanakan di lokasi perusahaan kami?','Bisa. In house training K3 adalah layanan utama kami — instruktur datang ke site Anda di mana pun di Indonesia, lengkap dengan modul, alat peraga, dan administrasi sertifikasi.'],
  ['Berapa jumlah minimum peserta?','Untuk in house training, umumnya mulai 10 peserta agar biaya per orang efisien. Di bawah itu, karyawan Anda dapat bergabung di jadwal public training kami yang berjalan setiap bulan.'],
  ['Apakah materi training bisa disesuaikan dengan perusahaan kami?','Bisa. Kurikulum kami sesuaikan dengan proses kerja, risiko spesifik site, temuan audit, dan SOP perusahaan Anda — bukan materi generik.'],
  ['Berapa lama durasi training?','Bervariasi per program: 1–3 hari untuk sebagian besar pelatihan karyawan dan sertifikasi BNSP, hingga 12 hari untuk pembinaan Ahli K3 Umum KEMNAKER.'],
  ['Apakah sertifikatnya resmi?','Ya. Sertifikat diterbitkan resmi oleh KEMNAKER RI atau BNSP, berlaku nasional, dan sah digunakan untuk audit SMK3, CSMS, dan persyaratan tender.'],
  ['Apakah melayani seluruh Indonesia?','Ya. Jaringan instruktur kami tersebar di berbagai kota — kami rutin melaksanakan corporate HSE training dari Sumatera hingga Papua, plus opsi online via Zoom.'],
  ['Bagaimana proses pengajuan proposal?','Sederhana: hubungi kami via WhatsApp, ceritakan kebutuhan Anda, dan proposal lengkap (silabus, jadwal, investasi) kami kirim maksimal 1×24 jam kerja.'],
  ['Bagaimana termin pembayarannya?','Kami terbiasa dengan proses procurement perusahaan: vendor registration, PO, invoice, dan faktur pajak. Termin pembayaran fleksibel sesuai kesepakatan.'],
];
?>
<!DOCTYPE html>
<html lang="id" translate="no">
<head>
<meta charset="UTF-8">
<meta name="google" content="notranslate">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($page_title) ?></title>
<meta name="description" content="<?= e($meta_desc) ?>">
<link rel="canonical" href="<?= e($canon_url) ?>">
<meta name="robots" content="index,follow">
<meta property="og:type"        content="website">
<meta property="og:locale"      content="id_ID">
<meta property="og:site_name"   content="<?= e($s['site_name'] ?? 'Wahana Totalita Konsultan') ?>">
<meta property="og:title"       content="<?= e($page_title) ?>">
<meta property="og:description" content="<?= e($meta_desc) ?>">
<meta property="og:url"         content="<?= e($canon_url) ?>">
<meta property="og:image"       content="<?= SITE_URL . e($s['og_image'] ?? '/assets/img/og-cover.svg') ?>">
<meta property="og:image:width"  content="1200">
<meta property="og:image:height" content="630">
<meta name="twitter:card"        content="summary_large_image">
<meta name="twitter:title"       content="<?= e($page_title) ?>">
<meta name="twitter:description" content="<?= e($meta_desc) ?>">
<meta name="twitter:image"       content="<?= SITE_URL . e($s['og_image'] ?? '/assets/img/og-cover.svg') ?>">
<meta name="theme-color"        content="<?= e(is_valid_hex($s['theme_color_primary'] ?? '') ? $s['theme_color_primary'] : '#0A4A2E') ?>">
<script type="application/ld+json"><?= json_encode([
  '@context' => 'https://schema.org',
  '@type'    => 'Organization',
  'name'     => 'Wahana Totalita Konsultan',
  'alternateName' => 'PT Wahana Totalita Konsultan',
  'url'      => 'https://wahanatotalita.com',
  'logo'     => 'https://wahanatotalita.com/assets/images/logo.png',
  'foundingDate' => '2001',
  'address'  => [
    '@type' => 'PostalAddress',
    'streetAddress' => 'Jl. Wonosari No.km 8.5',
    'addressLocality' => 'Sleman',
    'addressRegion' => 'DI Yogyakarta',
    'postalCode' => '55573',
    'addressCountry' => 'ID',
  ],
  'telephone' => '+62812-2969-435',
  'numberOfEmployees' => ['@type' => 'QuantitativeValue', 'minValue' => 10],
  'areaServed' => 'ID',
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?></script>
<script type="application/ld+json"><?= json_encode([
  '@context' => 'https://schema.org',
  '@type'    => 'Service',
  'name'     => 'Training K3 Perusahaan & In House Training K3',
  'serviceType' => 'Corporate HSE Training, In House Training K3, Sertifikasi K3 KEMNAKER & BNSP, Konsultasi ISO',
  'provider' => ['@type'=>'EducationalOrganization','name'=>$s['site_name'] ?? 'Wahana Totalita Konsultan','url'=>SITE_URL,'telephone'=>'+'.$wa_number],
  'areaServed' => ['@type'=>'Country','name'=>'Indonesia'],
  'audience' => ['@type'=>'BusinessAudience','name'=>'HSE Manager, HSE Officer, HR Manager, GA Manager, Training Coordinator, Factory Manager'],
  'description' => $meta_desc,
  'url' => $canon_url,
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?></script>
<script type="application/ld+json"><?= json_encode([
  '@context' => 'https://schema.org',
  '@type'    => 'FAQPage',
  'mainEntity' => array_map(fn($f) => [
    '@type' => 'Question',
    'name'  => $f[0],
    'acceptedAnswer' => ['@type'=>'Answer','text'=>$f[1]],
  ], $faqs),
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?></script>
<script type="application/ld+json"><?= json_encode([
  '@context' => 'https://schema.org',
  '@type'    => 'BreadcrumbList',
  'itemListElement' => [
    ['@type'=>'ListItem','position'=>1,'name'=>'Beranda','item'=>SITE_URL.'/'],
    ['@type'=>'ListItem','position'=>2,'name'=>'Training K3 Perusahaan','item'=>$canon_url],
  ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?></script>
<?php if (!empty($s['gtm_id'])): ?>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','<?= e($s['gtm_id']) ?>');</script>
<?php endif; ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preload" href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;600;700;800&family=Source+Sans+3:wght@400;600;700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;600;700;800&family=Source+Sans+3:wght@400;600;700&display=swap">
</noscript>

<style><?php
$_core_css_file = __DIR__ . '/assets/css/core.min.css';
if (is_file($_core_css_file)) {
    readfile($_core_css_file);
} else {
    readfile(__DIR__ . '/assets/css/core.css');
}
?></style>
<link rel="stylesheet" href="<?= asset_v('/assets/css/perusahaan.css') ?>">
<?= theme_css_vars($s) ?>
</head>
<body>
<?php if (!empty($s['gtm_id'])): ?>
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?= e($s['gtm_id']) ?>" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<?php endif; ?>

<?php require __DIR__ . '/includes/navbar.php'; ?>

<main id="konten-utama">

<!-- ═══ 1 · HERO ═══ -->
<section class="pr-hero">
  <div class="container pr-hero-inner">
    <div class="pr-hero-copy">
      <span class="pr-eyebrow">Training K3 Perusahaan · In House &amp; Public</span>
      <h1>Training K3 &amp; Sertifikasi Resmi untuk <em>Perusahaan Anda</em> — di Seluruh Indonesia</h1>
      <p class="pr-lead">In house training K3, corporate HSE training, sertifikasi KEMNAKER RI &amp; BNSP, dan konsultasi ISO. Dipercaya 200+ perusahaan manufaktur, tambang, konstruksi, dan migas untuk memenuhi regulasi dan mencapai zero accident.</p>
      <div class="pr-hero-cta">
        <a class="btn-primary pr-btn-lg" href="<?= e($wa_proposal) ?>" target="_blank" rel="noopener">Minta Proposal</a>
        <a class="btn-outline pr-btn-lg" href="<?= e($wa_diskusi) ?>" target="_blank" rel="noopener">Konsultasi Gratis</a>
      </div>
      <p class="pr-reassure">&#10003; Proposal dalam 24 jam &nbsp;·&nbsp; &#10003; Resmi KEMNAKER RI &amp; BNSP &nbsp;·&nbsp; &#10003; Tanpa komitmen</p>
    </div>
    <div class="pr-hero-media">
      <img src="https://images.unsplash.com/photo-1504917595217-d4dc5ebe6122?auto=format&fit=crop&w=760&q=70"
           alt="Tim HSE mengikuti training K3 perusahaan di lingkungan industri Indonesia"
           width="760" height="507" fetchpriority="high" decoding="async">
    </div>
  </div>
</section>

<!-- ═══ 2 · TRUST ═══ -->
<section class="pr-trustband" aria-label="Kredibilitas Wahana Totalita">
  <div class="container">
    <div class="pr-trustnum">
      <div class="pr-tn"><b>200+</b><span>Perusahaan Dilayani</span></div>
      <div class="pr-tn"><b>5000+</b><span>Peserta Dilatih</span></div>
      <div class="pr-tn"><b>15+</b><span>Tahun Pengalaman</span></div>
      <div class="pr-tn"><b>30+</b><span>Provinsi Terjangkau</span></div>
    </div>
    <div class="pr-clients">
      <p>Dipercaya tim HSE &amp; HRD dari:</p>
      <div class="pr-client-chips">
        <span>PT Badak NGL</span><span>Pupuk Kujang</span><span>Indonesia Power</span><span>Pertamina</span><span>PT Itokoh Ceperindo</span><span>+ ratusan perusahaan lainnya</span>
      </div>
    </div>
  </div>
</section>

<!-- ═══ 2.5 · FOUNDING STORY ═══ -->
<section class="pr-section">
  <div class="container">
    <div class="pr-head">
      <span class="pr-eyebrow">Perjalanan Kami</span>
      <h2>Berdiri sejak 2001, Wahana Totalita resmi berbadan hukum pada 2006</h2>
      <p>Berawal sebagai praktik pelatihan Keselamatan dan Kesehatan Kerja di Yogyakarta pada 2001, kami resmi berbadan hukum pada 2006 melalui Akte Notaris No. 01 tanggal 3 Agustus 2006 (Notaris H. Hamdani, SH), dengan Tanda Daftar Perusahaan (TDP) 120237001899 dan SIUP 503/0347/Mkr/XI/2011. Sejak saat itu, kami terus melayani perusahaan di seluruh Indonesia dengan pelatihan dan sertifikasi K3 yang resmi dan diakui.</p>
    </div>
  </div>
</section>

<!-- ═══ 3 · PAIN POINTS ═══ -->
<section class="pr-section">
  <div class="container">
    <div class="pr-head">
      <span class="pr-eyebrow">Masalah yang Kami Selesaikan</span>
      <h2>Tantangan Ini Sedang Dihadapi Perusahaan Anda?</h2>
      <p>Setiap minggu kami menerima pertanyaan yang sama dari HSE Manager dan HRD di seluruh Indonesia. Mungkin salah satunya sedang ada di meja Anda:</p>
    </div>
    <div class="pr-grid pr-grid-3">
      <?php foreach ($pains as $i => $p): ?>
      <div class="pr-card pr-problem" data-reveal="up" data-reveal-delay="<?= ($i % 4) + 1 ?>">
        <div class="pr-ic pr-ic-warn"><?= $p[0] ?></div>
        <h3><?= $p[1] ?></h3>
        <p><?= $p[2] ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- CTA strip -->
<section class="pr-ctastrip" aria-label="Ajakan konsultasi">
  <div class="container pr-ctastrip-inner">
    <p><b>Sedang menghadapi salah satu masalah di atas?</b> Ceritakan situasinya — kami balas dengan solusi &amp; proposal dalam 24 jam.</p>
    <a class="btn-primary" href="<?= e($wa_diskusi) ?>" target="_blank" rel="noopener">Konsultasi Gratis via WhatsApp</a>
  </div>
</section>

<!-- ═══ 4 · LAYANAN ═══ -->
<section class="pr-section pr-section-alt" id="layanan">
  <div class="container">
    <div class="pr-head">
      <span class="pr-eyebrow">Solusi Wahana Totalita</span>
      <h2>Satu Partner untuk Seluruh Kebutuhan Corporate Safety Training</h2>
      <p>Dari pelatihan karyawan hingga lulus audit — satu vendor, satu standar layanan, satu penanggung jawab.</p>
    </div>
    <div class="pr-grid pr-grid-4">
      <?php foreach ($services as $i => $sv): ?>
      <div class="pr-card pr-service" data-reveal="up" data-reveal-delay="<?= ($i % 4) + 1 ?>">
        <div class="pr-ic"><?= $sv[0] ?></div>
        <h3><?= $sv[1] ?></h3>
        <p><?= $sv[2] ?></p>
        <a class="pr-link" href="<?= e($wa_service(strip_tags($sv[1]))) ?>" target="_blank" rel="noopener">Pelajari Layanan
          <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        </a>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ═══ 4.5 · TRUST: KLIEN & INSTRUKTUR ═══ -->
<section>
  <div class="container">
    <h2>Dipercaya oleh 70+ Perusahaan Besar</h2>
    <p>Sejak 2001, kami telah melayani lebih dari 70 perusahaan BUMN dan multinasional —
    dari sektor migas, pertambangan, perbankan, hingga manufaktur.
    <a href="/klien/">Lihat daftar klien kami →</a></p>

    <h2>Instruktur Berpengalaman</h2>
    <p>Program pelatihan kami didukung oleh jaringan instruktur K3 bersertifikat nasional,
    termasuk praktisi dari Pusdiklat Migas Cepu, akademisi S2/S3 bidang K3, dan
    pengawas ketenagakerjaan berpengalaman.
    <a href="/instruktur/">Kenali instruktur kami →</a></p>
  </div>
</section>

<!-- ═══ 5 · PROGRAM ═══ -->
<section class="pr-section" id="program">
  <div class="container">
    <div class="pr-head">
      <span class="pr-eyebrow">Kategori Program</span>
      <h2>100+ Program Training Kemnaker, BNSP, ISO &amp; Soft Skills</h2>
      <p>Semua program tersedia sebagai public training maupun in house training di lokasi perusahaan Anda. Lihat juga <a href="/jadwal/">jadwal pelatihan terdekat</a>.</p>
    </div>
    <div class="pr-grid pr-grid-4">
      <?php foreach ($programs as $i => $pg): ?>
      <div class="pr-card pr-program" data-reveal="up" data-reveal-delay="<?= ($i % 4) + 1 ?>">
        <h3><?= $pg[0] ?></h3>
        <p><?= $pg[1] ?></p>
        <a class="pr-link" href="<?= e($wa_service($pg[2])) ?>" target="_blank" rel="noopener">Minta Silabus &amp; Harga
          <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        </a>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ═══ 6 · WHY CHOOSE US ═══ -->
<section class="pr-section pr-section-alt">
  <div class="container">
    <div class="pr-head">
      <span class="pr-eyebrow">Kenapa Dipilih Perusahaan</span>
      <h2>Standar Layanan yang Dirancang untuk Kebutuhan Korporasi</h2>
    </div>
    <div class="pr-grid pr-grid-4">
      <?php foreach ($reasons as $i => $r): ?>
      <div class="pr-card pr-reason" data-reveal="up" data-reveal-delay="<?= ($i % 4) + 1 ?>">
        <div class="pr-ic"><?= $r[0] ?></div>
        <h3><?= $r[1] ?></h3>
        <p><?= $r[2] ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ═══ 7 · INDUSTRI ═══ -->
<section class="pr-section pr-section-dark">
  <div class="container">
    <div class="pr-head">
      <span class="pr-eyebrow">Bidang Industri</span>
      <h2>Berpengalaman Melayani Berbagai Sektor Industri</h2>
    </div>
    <div class="pr-industries">
      <?php foreach ($industries as $ind): ?>
      <div class="pr-industry"><span class="pr-ind-ic"><?= $ind[0] ?></span><span><?= $ind[1] ?></span></div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- CTA strip -->
<section class="pr-ctastrip" aria-label="Ajakan proposal">
  <div class="container pr-ctastrip-inner">
    <p><b>Industri Anda ada di daftar?</b> Kami sudah punya kurikulum &amp; instruktur yang memahami risiko sektor Anda.</p>
    <a class="btn-primary" href="<?= e($wa_proposal) ?>" target="_blank" rel="noopener">Minta Proposal Sekarang</a>
  </div>
</section>

<!-- ═══ 8 · PROSES ═══ -->
<section class="pr-section">
  <div class="container">
    <div class="pr-head">
      <span class="pr-eyebrow">Corporate Training Process</span>
      <h2>Dari Konsultasi hingga After Sales — Proses yang Jelas</h2>
    </div>
    <ol class="pr-timeline pr-timeline-8">
      <?php foreach ($process as $i => $st): ?>
      <li>
        <span class="pr-step-num"><?= $i + 1 ?></span>
        <h3><?= $st[0] ?></h3>
        <p><?= $st[1] ?></p>
      </li>
      <?php endforeach; ?>
    </ol>
    <div class="pr-center">
      <a class="btn-primary pr-btn-lg" href="<?= e($wa_diskusi) ?>" target="_blank" rel="noopener">Mulai dari Langkah 1 — Konsultasi Gratis</a>
    </div>
  </div>
</section>

<!-- ═══ 9 · PAKET ═══ -->
<section class="pr-section pr-section-alt" id="paket">
  <div class="container">
    <div class="pr-head">
      <span class="pr-eyebrow">Corporate Packages</span>
      <h2>Pilih Skema yang Sesuai Kebutuhan Perusahaan</h2>
    </div>
    <div class="pr-grid pr-grid-3 pr-packages">
      <?php foreach ($packages as $i => $pk): ?>
      <div class="pr-package<?= $pk[5] ? ' pr-package-featured' : '' ?>" data-reveal="up" data-reveal-delay="<?= ($i % 4) + 1 ?>">
        <?php if ($pk[5]): ?><span class="pr-badge">Paling Populer</span><?php endif; ?>
        <h3><?= $pk[0] ?></h3>
        <p class="pr-pkg-for"><strong>Best for:</strong> <?= $pk[1] ?></p>
        <p class="pr-pkg-desc"><?= $pk[2] ?></p>
        <ul>
          <?php foreach ($pk[3] as $b): ?>
          <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6 9 17l-5-5"/></svg><?= $b ?></li>
          <?php endforeach; ?>
        </ul>
        <a class="<?= $pk[5] ? 'btn-primary' : 'btn-outline' ?> pr-btn-block" href="<?= e($wa_service(strip_tags($pk[4]))) ?>" target="_blank" rel="noopener">Diskusikan Paket Ini</a>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ═══ 10 · SUCCESS STORIES ═══ -->
<section class="pr-section">
  <div class="container">
    <div class="pr-head">
      <span class="pr-eyebrow">Success Stories</span>
      <h2>Dampak Nyata bagi Bisnis Klien Kami</h2>
    </div>
    <div class="pr-grid pr-grid-3">
      <?php foreach ($testimonials as $i => $t): ?>
      <figure class="pr-testi" data-reveal="up" data-reveal-delay="<?= ($i % 4) + 1 ?>">
        <div class="pr-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
        <blockquote><?= $t[1] ?></blockquote>
        <p class="pr-outcome"><svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6 9 17l-5-5"/></svg> <?= $t[5] ?></p>
        <figcaption>
          <span class="pr-av"><?= $t[0] ?></span>
          <span><b><?= $t[2] ?></b><small><?= $t[3] ?> · <?= $t[4] ?></small></span>
        </figcaption>
      </figure>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ═══ 11 · FAQ ═══ -->
<section class="pr-section pr-section-alt" id="faq">
  <div class="container">
    <div class="pr-head">
      <span class="pr-eyebrow">Pertanyaan Umum</span>
      <h2>Yang Sering Ditanyakan HRD &amp; Tim HSE</h2>
    </div>
    <div class="pr-faq">
      <?php foreach ($faqs as $k => $f): ?>
      <details<?= $k === 0 ? ' open' : '' ?> data-reveal="up" data-reveal-delay="<?= ($k % 4) + 1 ?>">
        <summary><?= e($f[0]) ?></summary>
        <p><?= e($f[1]) ?></p>
      </details>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ═══ 12 · FINAL CTA ═══ -->
<section class="pr-final">
  <div class="container pr-final-inner">
    <h2>Siap Meningkatkan Kompetensi Tim HSE Perusahaan Anda?</h2>
    <p>Diskusikan kebutuhan training K3 perusahaan, sertifikasi, dan kepatuhan Anda — gratis, tanpa komitmen, proposal dalam 24 jam.</p>
    <div class="pr-final-cta">
      <a class="pr-btn-white" href="<?= e($wa_diskusi) ?>" target="_blank" rel="noopener">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M17.5 14.4c-.3-.1-1.8-.9-2-1-.3-.1-.5-.1-.7.1-.2.3-.8 1-.9 1.2-.2.2-.3.2-.6.1-.3-.2-1.3-.5-2.4-1.5-.9-.8-1.5-1.8-1.7-2-.2-.3 0-.5.1-.6l.5-.5c.1-.2.2-.3.3-.5.1-.2 0-.4 0-.5l-.9-2.2c-.2-.6-.5-.5-.7-.5h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-1 2.5s1.1 2.9 1.2 3.1c.1.2 2.1 3.2 5.1 4.5.7.3 1.3.5 1.7.6.7.2 1.4.2 1.9.1.6-.1 1.8-.7 2-1.4.2-.7.2-1.3.2-1.4-.1-.1-.3-.2-.6-.3M12 2a10 10 0 0 0-8.6 15l-1.3 4.7 4.8-1.3A10 10 0 1 0 12 2z"/></svg>
        Chat WhatsApp Sekarang
      </a>
      <a class="pr-btn-ghost" href="<?= e($wa_proposal) ?>" target="_blank" rel="noopener">Minta Proposal</a>
    </div>
    <p class="pr-final-phone">Atau telepon langsung: <a href="tel:+<?= e($wa_number) ?>"><?= e($phone_disp) ?></a></p>
    <div class="pr-badges">
      <span>&#10003; Resmi KEMNAKER RI</span>
      <span>&#10003; Sertifikasi BNSP</span>
      <span>&#10003; 15+ Tahun Pengalaman</span>
      <span>&#10003; Melayani Seluruh Indonesia</span>
    </div>
  </div>
</section>

</main>

<!-- Slim ad-page footer (full site footer intentionally omitted) -->
<footer class="pr-foot">
  <div class="container pr-foot-inner">
    <div class="pr-foot-links">
      <a href="/">Beranda</a><a href="/jadwal/">Jadwal Pelatihan</a><a href="/artikel/">Artikel K3</a><a href="/csms">Template CSMS</a><a href="/kebijakan-privasi">Kebijakan Privasi</a>
    </div>
    <p>&#128241; <?= e($phone_disp) ?> &nbsp;·&nbsp; &#9993;&#65039; info@wahanatotalita.com &nbsp;·&nbsp; &#128205; Yogyakarta, Indonesia</p>
    <p class="pr-foot-copy">&copy; <?= $year ?> <?= e($s['site_name'] ?? 'Wahana Totalita Konsultan') ?></p>
  </div>
</footer>

<!-- Sticky CTA (desktop + mobile, appears after scroll) -->
<div class="pr-sticky" id="pr-sticky">
  <div class="pr-sticky-info">Training K3 Perusahaan<b>Proposal dalam 24 jam — konsultasi gratis</b></div>
  <a class="btn-outline pr-sticky-secondary" href="<?= e($wa_diskusi) ?>" target="_blank" rel="noopener">Konsultasi</a>
  <a class="btn-primary" href="<?= e($wa_proposal) ?>" target="_blank" rel="noopener">Minta Proposal</a>
</div>

<?php require __DIR__ . '/includes/scripts.php'; ?>
<script>
(function(){
  var bar=document.getElementById('pr-sticky'),shown=false;
  window.addEventListener('scroll',function(){
    var show=window.scrollY>560;
    if(show!==shown){shown=show;bar.classList.toggle('pr-sticky-show',show);document.body.classList.toggle('pr-has-sticky',show);}
  },{passive:true});
})();
</script>
</body>
</html>

