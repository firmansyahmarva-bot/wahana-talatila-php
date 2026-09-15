<?php
/**
 * MASTER PAGE MANIFEST — single source of truth for all 25 pages.
 * Built directly from "Internal Linking Architecture — Final" (approved).
 *
 * Fields:
 *  n        int    page number 1–25, matches the approved architecture doc
 *  path     string URL path from site root, trailing slash ('' = home)
 *  parent   ?string silo pillar key for breadcrumb (null = depth-1 page)
 *  type     string home|hub|reference|glossary|article
 *  title    string SEO <title> (brand suffix added by header.php)
 *  h1       string on-page H1
 *  meta     string meta description
 *  related  array  up to 3 keys shown in the "Baca Juga" box (siblings are
 *                  NOT repeated here — hub.php already lists real children)
 *  cta      bool   true only for the 7 pages allowed a conversion CTA
 *  wa_prefill string page-specific WhatsApp prefilled message (cta pages only)
 *  ext      ?string key into config/site.php 'external' for an optional
 *                  secondary link to a VERIFIED real main-site page
 *  img_alt  string alt text for the featured image
 */

return [

/* ============ HOME — Master Pillar ============ */

'home' => [
  'n' => 1, 'path' => '', 'parent' => null, 'type' => 'home',
  'title' => 'Ahli K3 Umum: Panduan Lengkap Sertifikasi, Tugas, dan Karir 2026',
  'h1'    => 'Ahli K3 Umum: Panduan Lengkap dari Dasar Hukum sampai Karir',
  'meta'  => 'Panduan lengkap Ahli K3 Umum: dasar hukum, syarat, cara sertifikasi Kemnaker vs BNSP, biaya, gaji, hingga praktik P2K3, SMK3, dan HIRADC.',
  'related' => [],
  'cta' => true, 'wa_prefill' => 'Halo, saya baru membaca panduan Ahli K3 Umum dan ingin tanya lebih lanjut.',
  'img_alt' => 'Ilustrasi Ahli K3 Umum mengawasi penerapan keselamatan dan kesehatan kerja di perusahaan',
],

/* ============ SILO A — Dasar Hukum & Legal (pillar + 3 children) ============ */

'a' => [
  'n' => 2, 'path' => 'dasar-hukum-k3/', 'parent' => null, 'type' => 'hub',
  'title' => 'Dasar Hukum K3 di Indonesia: UU, Permenaker, dan PP Lengkap',
  'h1'    => 'Dasar Hukum K3 di Indonesia: UU No. 1/1970 hingga PP No. 50/2012',
  'meta'  => 'Penjelasan lengkap dasar hukum K3 di Indonesia: UU No. 1 Tahun 1970, Permenaker No. PER-02/MEN/1992, PP No. 50/2012, dan SKKNI 38/2019.',
  'related' => ['c', 'e', 'f3'], 'cta' => false,
  'img_alt' => 'Ilustrasi dokumen peraturan perundang-undangan K3 di Indonesia',
],
'a1' => [
  'n' => 3, 'path' => 'dasar-hukum-k3/tugas-dan-wewenang-ahli-k3-umum/', 'parent' => 'a', 'type' => 'article',
  'title' => 'Tugas dan Wewenang Ahli K3 Umum Berdasarkan Permenaker 02/1992',
  'h1'    => 'Tugas dan Wewenang Ahli K3 Umum di Perusahaan',
  'meta'  => 'Tugas dan wewenang Ahli K3 Umum menurut Permenaker No. PER-02/MEN/1992 — peran AK3U mengawasi penerapan K3 di perusahaan.',
  'related' => ['a2', 'a3', 'f3'], 'cta' => false,
  'img_alt' => 'Ilustrasi Ahli K3 Umum melakukan pengawasan dan pelaporan K3 di perusahaan',
],
'a2' => [
  'n' => 4, 'path' => 'dasar-hukum-k3/syarat-ahli-k3-umum/', 'parent' => 'a', 'type' => 'article',
  'title' => 'Syarat Ahli K3 Umum 2026: Pendidikan, Usia, dan Dokumen',
  'h1'    => 'Syarat Menjadi Ahli K3 Umum: Lengkap dan Terbaru',
  'meta'  => 'Syarat mengikuti pelatihan dan sertifikasi Ahli K3 Umum: pendidikan minimal, usia, pengalaman kerja, dan dokumen yang dibutuhkan.',
  'related' => ['a1', 'a3', 'b5'], 'cta' => false,
  'img_alt' => 'Ilustrasi dokumen persyaratan pendaftaran Ahli K3 Umum',
],
'a3' => [
  'n' => 5, 'path' => 'dasar-hukum-k3/cara-menjadi-ahli-k3-umum/', 'parent' => 'a', 'type' => 'article',
  'title' => 'Cara Menjadi Ahli K3 Umum: Tahapan Lengkap dari Awal',
  'h1'    => 'Cara Menjadi Ahli K3 Umum: Panduan Tahap demi Tahap',
  'meta'  => 'Proses lengkap menjadi Ahli K3 Umum: pendaftaran, pelatihan, evaluasi tertulis, praktik kerja lapangan, hingga penerbitan SKP Kemnaker.',
  'related' => ['a2', 'b', 'f2'],
  'cta' => true, 'wa_prefill' => 'Halo, saya ingin tanya proses dan jadwal pelatihan Ahli K3 Umum.', 'ext' => 'wt_jadwal',
  'img_alt' => 'Ilustrasi tahapan proses sertifikasi Ahli K3 Umum',
],

/* ============ SILO B — Sertifikasi & Karir (pillar + 5 children) ============ */

'b' => [
  'n' => 6, 'path' => 'sertifikasi-kemnaker-vs-bnsp/', 'parent' => null, 'type' => 'hub',
  'title' => 'Sertifikat Ahli K3 Umum: Kemnaker vs BNSP, Ini Bedanya',
  'h1'    => 'Sertifikat Ahli K3 Umum Kemnaker vs BNSP: Perbandingan Netral',
  'meta'  => 'Perbandingan objektif sertifikat Ahli K3 Umum Kemnaker dan BNSP: dasar hukum, proses, biaya, masa berlaku, dan pengakuan di dunia kerja.',
  'related' => ['d', 'b2', 'e1'],
  'cta' => true, 'wa_prefill' => 'Halo, saya ingin konsultasi memilih sertifikasi Ahli K3 Umum Kemnaker atau BNSP.', 'ext' => 'wt_jadwal',
  'img_alt' => 'Ilustrasi perbandingan sertifikat Ahli K3 Umum Kemnaker dan BNSP',
],
'b1' => [
  'n' => 7, 'path' => 'sertifikasi-kemnaker-vs-bnsp/masa-berlaku-dan-perpanjangan-skp/', 'parent' => 'b', 'type' => 'article',
  'title' => 'Masa Berlaku dan Cara Perpanjangan SKP Ahli K3 Umum',
  'h1'    => 'Masa Berlaku dan Perpanjangan SKP Ahli K3 Umum',
  'meta'  => 'Berapa lama masa berlaku SKP Ahli K3 Umum, dan bagaimana cara memperpanjangnya secara online melalui Kemnaker?',
  'related' => ['b2', 'b3', 'f3'],
  'cta' => true, 'wa_prefill' => 'Halo, saya ingin bantuan soal perpanjangan SKP Ahli K3 Umum.',
  'img_alt' => 'Ilustrasi proses perpanjangan SKP Ahli K3 Umum secara online',
],
'b2' => [
  'n' => 8, 'path' => 'sertifikasi-kemnaker-vs-bnsp/biaya-sertifikasi-ahli-k3-umum/', 'parent' => 'b', 'type' => 'article',
  'title' => 'Biaya Sertifikasi Ahli K3 Umum 2026: Rincian PNBP dan Pelatihan',
  'h1'    => 'Biaya Sertifikasi Ahli K3 Umum: Rincian Lengkap',
  'meta'  => 'Rincian biaya Ahli K3 Umum: komponen PNBP resmi, biaya pelatihan, dan kisaran total biaya sertifikasi Kemnaker maupun BNSP.',
  'related' => ['b1', 'e1', 'b3'],
  'cta' => true, 'wa_prefill' => 'Halo, saya ingin tanya rincian biaya dan jadwal pelatihan Ahli K3 Umum.', 'ext' => 'wt_jadwal',
  'img_alt' => 'Ilustrasi rincian biaya sertifikasi Ahli K3 Umum',
],
'b3' => [
  'n' => 9, 'path' => 'sertifikasi-kemnaker-vs-bnsp/gaji-dan-jenjang-karir/', 'parent' => 'b', 'type' => 'article',
  'title' => 'Gaji Ahli K3 Umum 2026: Kisaran dan Jenjang Karir HSE',
  'h1'    => 'Gaji dan Jenjang Karir Ahli K3 Umum di Indonesia',
  'meta'  => 'Kisaran gaji Ahli K3 Umum fresh graduate hingga senior, serta jenjang karir dari HSE Officer sampai HSE Manager.',
  'related' => ['b2', 'b4', 'd'], 'cta' => false,
  'img_alt' => 'Ilustrasi jenjang karir Ahli K3 Umum dari HSE Officer hingga Manager',
],
'b4' => [
  'n' => 10, 'path' => 'sertifikasi-kemnaker-vs-bnsp/prospek-kerja-dan-contoh-cv-hse/', 'parent' => 'b', 'type' => 'article',
  'title' => 'Prospek Kerja Ahli K3 Umum dan Contoh CV HSE Officer',
  'h1'    => 'Prospek Kerja dan Contoh CV HSE Officer',
  'meta'  => 'Peluang kerja Ahli K3 Umum di berbagai industri, plus contoh struktur CV HSE Officer yang menonjolkan sertifikasi dan kompetensi K3.',
  'related' => ['b3', 'a2', 'b5'], 'cta' => false,
  'img_alt' => 'Ilustrasi contoh CV HSE Officer dengan sertifikasi Ahli K3 Umum',
],
'b5' => [
  'n' => 11, 'path' => 'sertifikasi-kemnaker-vs-bnsp/ahli-k3-umum-fresh-graduate/', 'parent' => 'b', 'type' => 'article',
  'title' => 'Ahli K3 Umum untuk Fresh Graduate: Syarat dan Cara Mulai',
  'h1'    => 'Ahli K3 Umum untuk Fresh Graduate: Panduan Memulai Karir HSE',
  'meta'  => 'Apakah fresh graduate bisa ikut Ahli K3 Umum? Syarat, biaya, dan strategi memulai karir HSE dari nol untuk lulusan baru semua jurusan.',
  'related' => ['a2', 'b3', 'b1'],
  'cta' => true, 'wa_prefill' => 'Halo, saya fresh graduate dan ingin konsultasi gratis soal Ahli K3 Umum.',
  'img_alt' => 'Ilustrasi fresh graduate memulai karir sebagai Ahli K3 Umum',
],

/* ============ SILO C — Praktik & Kompetensi (pillar + 6 children) ============ */

'c' => [
  'n' => 12, 'path' => 'p2k3/', 'parent' => null, 'type' => 'hub',
  'title' => 'P2K3: Panitia Pembina Keselamatan dan Kesehatan Kerja',
  'h1'    => 'P2K3: Pengertian, Struktur, dan Tugasnya di Perusahaan',
  'meta'  => 'Apa itu P2K3? Struktur organisasi, tugas, dan perusahaan yang wajib membentuk Panitia Pembina Keselamatan dan Kesehatan Kerja.',
  'related' => ['a', 'c2', 'c6'], 'cta' => false,
  'img_alt' => 'Ilustrasi struktur organisasi P2K3 di perusahaan',
],
'c1' => [
  'n' => 13, 'path' => 'p2k3/smk3/', 'parent' => 'c', 'type' => 'article',
  'title' => 'SMK3: Sistem Manajemen K3 Berdasarkan PP No. 50/2012',
  'h1'    => 'SMK3: Sistem Manajemen Keselamatan dan Kesehatan Kerja',
  'meta'  => 'Penjelasan SMK3 sesuai PP No. 50 Tahun 2012: siapa yang wajib menerapkan, elemen utama, dan kaitannya dengan peran Ahli K3 Umum.',
  'related' => ['c', 'c6', 'a'], 'cta' => false,
  'img_alt' => 'Ilustrasi penerapan Sistem Manajemen K3 (SMK3) di perusahaan',
],
'c2' => [
  'n' => 14, 'path' => 'p2k3/hiradc-hirarc/', 'parent' => 'c', 'type' => 'article',
  'title' => 'HIRADC/HIRARC: Cara Membuat dan Contoh Template',
  'h1'    => 'HIRADC/HIRARC: Identifikasi Bahaya dan Penilaian Risiko',
  'meta'  => 'Panduan membuat HIRADC/HIRARC lengkap dengan contoh template identifikasi bahaya dan penilaian risiko yang bisa langsung diterapkan.',
  'related' => ['c3', 'c4', 'f1'], 'cta' => false,
  'img_alt' => 'Ilustrasi tabel HIRADC identifikasi bahaya dan penilaian risiko',
],
'c3' => [
  'n' => 15, 'path' => 'p2k3/jsa-job-safety-analysis/', 'parent' => 'c', 'type' => 'article',
  'title' => 'JSA (Job Safety Analysis): Panduan dan Contoh Lengkap',
  'h1'    => 'JSA (Job Safety Analysis): Panduan dan Contoh',
  'meta'  => 'Apa itu JSA dan bagaimana cara membuatnya? Panduan Job Safety Analysis lengkap dengan contoh penerapan di lapangan.',
  'related' => ['c2', 'c4', 'c'], 'cta' => false,
  'img_alt' => 'Ilustrasi lembar kerja Job Safety Analysis (JSA)',
],
'c4' => [
  'n' => 16, 'path' => 'p2k3/apd-alat-pelindung-diri/', 'parent' => 'c', 'type' => 'article',
  'title' => 'APD K3: Jenis, Fungsi, dan Standar SNI Lengkap',
  'h1'    => 'APD: Jenis, Fungsi, dan Standar SNI',
  'meta'  => 'Jenis-jenis Alat Pelindung Diri (APD) K3, fungsinya masing-masing, dan standar SNI yang wajib dipenuhi di tempat kerja.',
  'related' => ['c2', 'c3', 'c'], 'cta' => false,
  'img_alt' => 'Ilustrasi jenis-jenis Alat Pelindung Diri (APD) sesuai standar SNI',
],
'c5' => [
  'n' => 17, 'path' => 'p2k3/p3k-dan-tanggap-darurat/', 'parent' => 'c', 'type' => 'article',
  'title' => 'P3K dan Tanggap Darurat di Tempat Kerja: Panduan Lengkap',
  'h1'    => 'P3K dan Tanggap Darurat di Tempat Kerja',
  'meta'  => 'Prosedur P3K dan rencana tanggap darurat di tempat kerja: struktur tim, fasilitas wajib, dan langkah penanganan kondisi darurat.',
  'related' => ['c', 'c6', 'f1'], 'cta' => false,
  'img_alt' => 'Ilustrasi fasilitas P3K dan prosedur tanggap darurat di tempat kerja',
],
'c6' => [
  'n' => 18, 'path' => 'p2k3/audit-dan-inspeksi-k3/', 'parent' => 'c', 'type' => 'article',
  'title' => 'Audit dan Inspeksi K3: Checklist dan Praktik Terbaik',
  'h1'    => 'Audit dan Inspeksi K3: Checklist dan Praktik Terbaik',
  'meta'  => 'Perbedaan audit dan inspeksi K3, checklist praktis, serta praktik terbaik untuk memastikan kepatuhan penerapan K3 di perusahaan.',
  'related' => ['c1', 'c', 'f1'], 'cta' => false,
  'img_alt' => 'Ilustrasi checklist audit dan inspeksi K3',
],

/* ============ SILO D — Industry Application (standalone, no children) ============ */

'd' => [
  'n' => 19, 'path' => 'k3-di-berbagai-sektor-industri/', 'parent' => null, 'type' => 'reference',
  'title' => 'K3 di Berbagai Sektor Industri: Konstruksi hingga Migas',
  'h1'    => 'K3 di Berbagai Sektor Industri',
  'meta'  => 'Penerapan K3 di sektor konstruksi, manufaktur, migas dan pertambangan, serta perkantoran — risiko utama dan regulasi khusus tiap sektor.',
  'related' => ['b', 'b3', 'e'],
  'cta' => true, 'wa_prefill' => 'Halo, saya ingin tanya pelatihan K3 sesuai sektor industri kami.', 'ext' => 'wt_perusahaan',
  'img_alt' => 'Ilustrasi penerapan K3 di berbagai sektor industri',
],

/* ============ SILO E — Data & Trends (pillar + 1 child) ============ */

'e' => [
  'n' => 20, 'path' => 'statistik-kecelakaan-kerja-indonesia/', 'parent' => null, 'type' => 'hub',
  'title' => 'Statistik Kecelakaan Kerja di Indonesia: Data Terbaru',
  'h1'    => 'Statistik Kecelakaan Kerja di Indonesia',
  'meta'  => 'Data dan tren kecelakaan kerja di Indonesia dari BPJS Ketenagakerjaan dan Kemnaker — sektor paling berisiko dan implikasinya bagi perusahaan.',
  'related' => ['e1', 'a', 'd'], 'cta' => false,
  'img_alt' => 'Ilustrasi grafik statistik kecelakaan kerja di Indonesia',
],
'e1' => [
  'n' => 21, 'path' => 'statistik-kecelakaan-kerja-indonesia/sertifikasi-ahli-k3-umum-gratis-2026/', 'parent' => 'e', 'type' => 'article',
  'title' => 'Sertifikasi Ahli K3 Umum Gratis 2026 dari Kemnaker: Info Lengkap',
  'h1'    => 'Program Sertifikasi Ahli K3 Umum Gratis 2026 (Kemnaker)',
  'meta'  => 'Info terbaru program pelatihan dan sertifikasi Ahli K3 Umum gratis dari Kemnaker tahun 2026: syarat, cara daftar, dan kuota.',
  'related' => ['a3', 'b2', 'e'],
  'cta' => true, 'wa_prefill' => 'Halo, saya ingin info jadwal pembinaan/sertifikasi Ahli K3 Umum terbaru.', 'ext' => 'wt_jadwal',
  'img_alt' => 'Ilustrasi program sertifikasi Ahli K3 Umum gratis dari Kemnaker 2026',
],

/* ============ SILO F — Reference Layer (4 standalone utilities) ============ */

'f1' => [
  'n' => 22, 'path' => 'investigasi-kecelakaan-kerja/', 'parent' => null, 'type' => 'reference',
  'title' => 'Investigasi Kecelakaan Kerja: Metode dan Pelaporan',
  'h1'    => 'Investigasi Kecelakaan Kerja: Metode dan Pelaporan',
  'meta'  => 'Metode investigasi kecelakaan kerja yang tepat dan cara menyusun laporan investigasi sesuai standar K3 di Indonesia.',
  'related' => ['c2', 'c6', 'c'], 'cta' => false,
  'img_alt' => 'Ilustrasi proses investigasi dan pelaporan kecelakaan kerja',
],
'f2' => [
  'n' => 23, 'path' => 'contoh-soal-ujian-ahli-k3-umum/', 'parent' => null, 'type' => 'reference',
  'title' => 'Contoh Soal Ujian Ahli K3 Umum dan Tips Persiapan',
  'h1'    => 'Contoh Soal dan Persiapan Ujian Ahli K3 Umum',
  'meta'  => 'Contoh soal evaluasi Ahli K3 Umum dan tips persiapan menghadapi ujian, termasuk gambaran studi kasus yang sering muncul.',
  'related' => ['a3', 'b5', 'f4'], 'cta' => false,
  'img_alt' => 'Ilustrasi persiapan ujian evaluasi Ahli K3 Umum',
],
'f3' => [
  'n' => 24, 'path' => 'glosarium-istilah-k3/', 'parent' => null, 'type' => 'glossary',
  'title' => 'Glosarium Istilah K3 (A-Z): Kamus Lengkap Keselamatan Kerja',
  'h1'    => 'Glosarium Istilah K3 (A–Z)',
  'meta'  => 'Kamus istilah K3 dari A sampai Z: HIRADC, JSA, APD, P2K3, SMK3, dan istilah keselamatan kerja lain dijelaskan singkat dan jelas.',
  'related' => [], 'cta' => false,
  'img_alt' => 'Ilustrasi buku glosarium istilah keselamatan dan kesehatan kerja',
],
'f4' => [
  'n' => 25, 'path' => 'faq-ahli-k3-umum/', 'parent' => null, 'type' => 'reference',
  'title' => 'FAQ Ahli K3 Umum: Pertanyaan yang Sering Diajukan',
  'h1'    => 'FAQ Ahli K3 Umum',
  'meta'  => 'Jawaban atas pertanyaan paling sering diajukan seputar Ahli K3 Umum: syarat, biaya, masa berlaku, hingga prospek kerja.',
  'related' => ['home', 'a3', 'b'], 'cta' => false,
  'img_alt' => 'Ilustrasi pertanyaan umum seputar Ahli K3 Umum',
],

];
