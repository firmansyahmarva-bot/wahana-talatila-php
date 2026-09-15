<?php
/**
 * MASTER PAGE MANIFEST — single source of truth for all 50 pages.
 *
 * Everything is driven from here: URLs, titles, metas, breadcrumbs,
 * the crawl chain (prev/next), related links, money-page targets,
 * featured images, and the sitemap. Never hand-edit links in content
 * files when the manifest can express them.
 *
 * Fields per page:
 *  n        int    page number 1–50 (matches the approved architecture)
 *  path     string URL path from site root, always with trailing slash ('' = home)
 *  title    string SEO <title> (brand suffix added by header.php)
 *  h1       string on-page H1
 *  meta     string meta description
 *  hub      string money|regulasi|implementasi|industri|biaya|pendukung
 *  type     string money|hub|article
 *  prev     string key of previous page in the crawl chain
 *  next     string key of next page in the crawl chain
 *  related  array  exactly 3 keys of related articles
 *  money    string key of the most relevant money page for the contextual CTA
 *  img_alt  string alt text for the featured SVG (file = assets/img/{key}.svg)
 */

return [

/* ============ MONEY PAGES (1–5) ============ */

'home' => [
  'n' => 1, 'path' => '',
  'title' => 'SMK3 Indonesia: Panduan Lengkap & Jasa Konsultan Sertifikasi',
  'h1'    => 'Panduan Lengkap SMK3 Indonesia: Regulasi, Implementasi, hingga Sertifikasi',
  'meta'  => 'Panduan SMK3 terlengkap di Indonesia: PP 50/2012, 166 kriteria, implementasi, biaya sertifikasi, plus jasa konsultan SMK3 berpengalaman. Konsultasi gratis.',
  'hub' => 'money', 'type' => 'money',
  'prev' => 'tentang-kami', 'next' => 'regulasi',
  'related' => ['regulasi', 'implementasi', 'biaya'],
  'money' => 'jasa-konsultan-smk3',
  'img_alt' => 'Ilustrasi sistem manajemen keselamatan dan kesehatan kerja SMK3 di Indonesia',
],

'jasa-konsultan-smk3' => [
  'n' => 2, 'path' => 'jasa-konsultan-smk3/',
  'title' => 'Jasa Konsultan SMK3 Berpengalaman — Pendampingan sampai Sertifikat',
  'h1'    => 'Jasa Konsultan SMK3: Pendampingan Penuh dari Gap Analysis sampai Sertifikat',
  'meta'  => 'Jasa konsultan SMK3 PP 50/2012: gap analysis, penyusunan dokumen, pelatihan, pendampingan audit. Berpengalaman lintas industri. Konsultasi awal gratis.',
  'hub' => 'money', 'type' => 'money',
  'prev' => '', 'next' => '',
  'related' => ['implementasi', 'cara-memilih-konsultan-smk3', 'lama-proses-sertifikasi-smk3'],
  'money' => 'kontak',
  'img_alt' => 'Ilustrasi konsultan SMK3 mendampingi tim perusahaan menyiapkan sertifikasi',
],

'jasa-audit-sertifikasi-smk3' => [
  'n' => 3, 'path' => 'jasa-audit-sertifikasi-smk3/',
  'title' => 'Jasa Audit & Persiapan Sertifikasi SMK3 — Siap Audit Kemnaker',
  'h1'    => 'Jasa Audit Internal & Persiapan Sertifikasi SMK3',
  'meta'  => 'Persiapan audit SMK3 menyeluruh: audit internal, simulasi audit eksternal, perbaikan temuan, pendampingan saat audit lembaga sertifikasi. Konsultasi gratis.',
  'hub' => 'money', 'type' => 'money',
  'prev' => '', 'next' => '',
  'related' => ['jenis-audit-smk3', 'checklist-kesiapan-audit-smk3', '166-kriteria-smk3'],
  'money' => 'kontak',
  'img_alt' => 'Ilustrasi proses audit SMK3 dengan checklist dan dokumen pemeriksaan',
],

'harga-sertifikasi-smk3' => [
  'n' => 4, 'path' => 'harga-sertifikasi-smk3/',
  'title' => 'Paket Harga Sertifikasi SMK3 — Perusahaan Kecil, Menengah, Besar',
  'h1'    => 'Paket Harga Sertifikasi SMK3 untuk Perusahaan Kecil, Menengah, dan Besar',
  'meta'  => 'Kisaran biaya dan paket pendampingan sertifikasi SMK3 sesuai skala perusahaan dan tingkat penerapan. Transparan, tanpa biaya tersembunyi. Minta penawaran.',
  'hub' => 'money', 'type' => 'money',
  'prev' => '', 'next' => '',
  'related' => ['biaya', 'lama-proses-sertifikasi-smk3', 'faq-smk3'],
  'money' => 'kontak',
  'img_alt' => 'Ilustrasi perbandingan paket harga sertifikasi SMK3 berdasarkan skala perusahaan',
],

'kontak' => [
  'n' => 5, 'path' => 'kontak/',
  'title' => 'Kontak & Konsultasi Gratis SMK3 — Hubungi Tim Kami',
  'h1'    => 'Konsultasi Gratis SMK3: Hubungi Tim Kami',
  'meta'  => 'Konsultasikan kebutuhan SMK3 perusahaan Anda secara gratis. Hubungi via WhatsApp atau formulir — tim kami merespons cepat pada jam kerja.',
  'hub' => 'money', 'type' => 'money',
  'prev' => '', 'next' => '',
  'related' => ['jasa-konsultan-smk3', 'harga-sertifikasi-smk3', 'faq-smk3'],
  'money' => 'jasa-konsultan-smk3',
  'img_alt' => 'Ilustrasi konsultasi SMK3 melalui telepon, WhatsApp, dan email',
],

/* ============ HUB 1 — REGULASI (6–14) ============ */

'regulasi' => [
  'n' => 6, 'path' => 'regulasi/',
  'title' => 'PP No. 50 Tahun 2012 tentang SMK3: Panduan Lengkap',
  'h1'    => 'PP No. 50 Tahun 2012 tentang Penerapan SMK3: Panduan Lengkap',
  'meta'  => 'Panduan lengkap PP 50/2012: siapa yang wajib menerapkan SMK3, 5 prinsip dasar, 12 elemen, 166 kriteria, mekanisme audit, dan sanksinya. Dijelaskan praktis.',
  'hub' => 'regulasi', 'type' => 'hub',
  'prev' => 'home', 'next' => '166-kriteria-smk3',
  'related' => ['sanksi-tidak-menerapkan-smk3', 'smk3-vs-iso-45001', 'implementasi'],
  'money' => 'jasa-konsultan-smk3',
  'img_alt' => 'Ilustrasi dokumen Peraturan Pemerintah Nomor 50 Tahun 2012 tentang SMK3',
],

'166-kriteria-smk3' => [
  'n' => 7, 'path' => 'regulasi/166-kriteria-smk3/',
  'title' => '166 Kriteria SMK3: Penjelasan Lengkap per Elemen',
  'h1'    => '166 Kriteria SMK3: Penjelasan Lengkap dan Cara Memenuhinya',
  'meta'  => '166 kriteria audit SMK3 dijelaskan per elemen: pembagian tingkat awal (64), transisi (122), lanjutan (166), kategori temuan, dan tips pemenuhannya.',
  'hub' => 'regulasi', 'type' => 'article',
  'prev' => 'regulasi', 'next' => '12-elemen-smk3',
  'related' => ['12-elemen-smk3', 'jenis-audit-smk3', 'checklist-kesiapan-audit-smk3'],
  'money' => 'jasa-audit-sertifikasi-smk3',
  'img_alt' => 'Ilustrasi daftar 166 kriteria audit SMK3 dengan tanda centang',
],

'12-elemen-smk3' => [
  'n' => 8, 'path' => 'regulasi/12-elemen-smk3/',
  'title' => '12 Elemen Utama SMK3 Berdasarkan PP 50/2012',
  'h1'    => '12 Elemen Utama SMK3 dan Apa yang Diperiksa Auditor di Setiap Elemen',
  'meta'  => '12 elemen audit SMK3 dari pembangunan komitmen hingga pengumpulan data: isi tiap elemen, contoh penerapan, dan kesalahan umum perusahaan.',
  'hub' => 'regulasi', 'type' => 'article',
  'prev' => '166-kriteria-smk3', 'next' => 'jenis-audit-smk3',
  'related' => ['166-kriteria-smk3', 'dokumen-wajib-smk3', 'implementasi'],
  'money' => 'jasa-konsultan-smk3',
  'img_alt' => 'Ilustrasi 12 elemen utama sistem manajemen K3 dalam diagram terstruktur',
],

'jenis-audit-smk3' => [
  'n' => 9, 'path' => 'regulasi/jenis-audit-smk3/',
  'title' => 'Jenis dan Tahapan Audit SMK3: Internal & Eksternal',
  'h1'    => 'Jenis dan Tahapan Audit SMK3: Dari Audit Internal sampai Sertifikat',
  'meta'  => 'Perbedaan audit internal dan eksternal SMK3, tingkat penilaian awal/transisi/lanjutan, alur audit lembaga sertifikasi, dan cara mempersiapkannya.',
  'hub' => 'regulasi', 'type' => 'article',
  'prev' => '12-elemen-smk3', 'next' => 'sanksi-tidak-menerapkan-smk3',
  'related' => ['checklist-kesiapan-audit-smk3', '166-kriteria-smk3', 'lama-proses-sertifikasi-smk3'],
  'money' => 'jasa-audit-sertifikasi-smk3',
  'img_alt' => 'Ilustrasi auditor memeriksa penerapan SMK3 di fasilitas perusahaan',
],

'sanksi-tidak-menerapkan-smk3' => [
  'n' => 10, 'path' => 'regulasi/sanksi-tidak-menerapkan-smk3/',
  'title' => 'Sanksi Perusahaan yang Tidak Menerapkan SMK3',
  'h1'    => 'Sanksi bagi Perusahaan yang Tidak Menerapkan SMK3: Hukum, Administratif, dan Bisnis',
  'meta'  => 'Risiko hukum dan bisnis bila perusahaan wajib SMK3 tidak menerapkannya: dasar hukum, sanksi administratif, dampak tender, dan cara memastikan kepatuhan.',
  'hub' => 'regulasi', 'type' => 'article',
  'prev' => 'jenis-audit-smk3', 'next' => 'masa-berlaku-sertifikat-smk3',
  'related' => ['regulasi', 'smk3-umkm', 'implementasi'],
  'money' => 'jasa-konsultan-smk3',
  'img_alt' => 'Ilustrasi palu hukum dan dokumen sanksi terkait kepatuhan SMK3',
],

'masa-berlaku-sertifikat-smk3' => [
  'n' => 11, 'path' => 'regulasi/masa-berlaku-sertifikat-smk3/',
  'title' => 'Masa Berlaku Sertifikat SMK3 & Kapan Harus Diperbarui',
  'h1'    => 'Masa Berlaku Sertifikat SMK3: Durasi, Pengawasan, dan Persiapan Perpanjangan',
  'meta'  => 'Sertifikat SMK3 berlaku 3 tahun. Pelajari hitungan masa berlaku, kewajiban selama periode sertifikat, dan kapan mulai menyiapkan resertifikasi.',
  'hub' => 'regulasi', 'type' => 'article',
  'prev' => 'sanksi-tidak-menerapkan-smk3', 'next' => 'perpanjangan-sertifikat-smk3',
  'related' => ['perpanjangan-sertifikat-smk3', 'jenis-audit-smk3', 'biaya'],
  'money' => 'jasa-audit-sertifikasi-smk3',
  'img_alt' => 'Ilustrasi kalender dan sertifikat SMK3 dengan masa berlaku tiga tahun',
],

'perpanjangan-sertifikat-smk3' => [
  'n' => 12, 'path' => 'regulasi/perpanjangan-sertifikat-smk3/',
  'title' => 'Cara Perpanjangan Sertifikat SMK3: Prosedur & Persiapan',
  'h1'    => 'Cara Perpanjangan (Resertifikasi) Sertifikat SMK3 Tanpa Terlambat',
  'meta'  => 'Prosedur resertifikasi SMK3: kapan mengajukan, dokumen yang disiapkan, proses audit ulang, dan strategi agar tingkat pencapaian naik, bukan turun.',
  'hub' => 'regulasi', 'type' => 'article',
  'prev' => 'masa-berlaku-sertifikat-smk3', 'next' => 'smk3-vs-iso-45001',
  'related' => ['masa-berlaku-sertifikat-smk3', 'checklist-kesiapan-audit-smk3', 'jasa-audit-sertifikasi-smk3'],
  'money' => 'jasa-audit-sertifikasi-smk3',
  'img_alt' => 'Ilustrasi proses perpanjangan sertifikat SMK3 dengan siklus pembaruan',
],

'smk3-vs-iso-45001' => [
  'n' => 13, 'path' => 'regulasi/smk3-vs-iso-45001/',
  'title' => 'SMK3 vs ISO 45001: Perbedaan & Mana yang Dipilih',
  'h1'    => 'SMK3 vs ISO 45001: Perbedaan Mendasar dan Mana yang Perusahaan Anda Butuhkan',
  'meta'  => 'Perbandingan SMK3 PP 50/2012 dan ISO 45001: status hukum, struktur, audit, biaya, pengakuan tender. Termasuk strategi integrasi keduanya.',
  'hub' => 'regulasi', 'type' => 'article',
  'prev' => 'perpanjangan-sertifikat-smk3', 'next' => 'ak3-umum-vs-smk3',
  'related' => ['regulasi', 'biaya', 'manajemen-risiko-k3'],
  'money' => 'jasa-konsultan-smk3',
  'img_alt' => 'Ilustrasi perbandingan sertifikasi SMK3 dan ISO 45001 secara berdampingan',
],

'ak3-umum-vs-smk3' => [
  'n' => 14, 'path' => 'regulasi/ak3-umum-vs-smk3/',
  'title' => 'AK3 Umum vs SMK3: Apa Bedanya dan Mana yang Wajib',
  'h1'    => 'AK3 Umum vs SMK3: Dua Hal Berbeda yang Sering Tertukar',
  'meta'  => 'AK3 Umum adalah kompetensi personel, SMK3 adalah sistem perusahaan. Pahami perbedaan, hubungan keduanya, dan kebutuhan perusahaan Anda.',
  'hub' => 'regulasi', 'type' => 'article',
  'prev' => 'smk3-vs-iso-45001', 'next' => 'implementasi',
  'related' => ['regulasi', 'cara-membentuk-p2k3', 'training-awareness-smk3'],
  'money' => 'jasa-konsultan-smk3',
  'img_alt' => 'Ilustrasi perbedaan ahli K3 umum sebagai personel dan SMK3 sebagai sistem',
],

/* ============ HUB 2 — IMPLEMENTASI (15–23) ============ */

'implementasi' => [
  'n' => 15, 'path' => 'implementasi/',
  'title' => 'Cara Implementasi SMK3 di Perusahaan: Panduan Step-by-Step',
  'h1'    => 'Cara Implementasi SMK3 di Perusahaan: Panduan Step-by-Step dari Nol sampai Audit',
  'meta'  => 'Langkah implementasi SMK3 dari komitmen manajemen, kebijakan K3, P2K3, HIRADC, dokumen, hingga siap audit. Panduan praktis dengan urutan yang benar.',
  'hub' => 'implementasi', 'type' => 'hub',
  'prev' => 'ak3-umum-vs-smk3', 'next' => 'gap-analysis-smk3',
  'related' => ['regulasi', 'dokumen-wajib-smk3', 'lama-proses-sertifikasi-smk3'],
  'money' => 'jasa-konsultan-smk3',
  'img_alt' => 'Ilustrasi tahapan implementasi SMK3 di perusahaan langkah demi langkah',
],

'gap-analysis-smk3' => [
  'n' => 16, 'path' => 'implementasi/gap-analysis-smk3/',
  'title' => 'Gap Analysis SMK3: Panduan, Metode, dan Contoh',
  'h1'    => 'Gap Analysis SMK3: Cara Mengukur Jarak Kondisi Perusahaan ke 166 Kriteria',
  'meta'  => 'Panduan gap analysis SMK3: metode penilaian, contoh format, cara membaca hasil, dan menyusun rencana perbaikan sebelum audit sertifikasi.',
  'hub' => 'implementasi', 'type' => 'article',
  'prev' => 'implementasi', 'next' => 'dokumen-wajib-smk3',
  'related' => ['166-kriteria-smk3', 'checklist-kesiapan-audit-smk3', 'implementasi'],
  'money' => 'jasa-konsultan-smk3',
  'img_alt' => 'Ilustrasi analisis kesenjangan penerapan SMK3 dengan grafik penilaian',
],

'dokumen-wajib-smk3' => [
  'n' => 17, 'path' => 'implementasi/dokumen-wajib-smk3/',
  'title' => 'Dokumen Wajib SMK3: Daftar Lengkap & Hierarkinya',
  'h1'    => 'Dokumen Wajib SMK3: Daftar Lengkap yang Diminta Auditor',
  'meta'  => 'Daftar dokumen SMK3 dari manual, prosedur, instruksi kerja, sampai rekaman: hierarki dokumen, contoh judul, dan kesalahan dokumentasi paling umum.',
  'hub' => 'implementasi', 'type' => 'article',
  'prev' => 'gap-analysis-smk3', 'next' => 'contoh-kebijakan-k3',
  'related' => ['template-dokumen-smk3', 'contoh-kebijakan-k3', '166-kriteria-smk3'],
  'money' => 'jasa-konsultan-smk3',
  'img_alt' => 'Ilustrasi hierarki dokumen SMK3 berbentuk piramida dari manual hingga rekaman',
],

'contoh-kebijakan-k3' => [
  'n' => 18, 'path' => 'implementasi/contoh-kebijakan-k3/',
  'title' => 'Contoh Kebijakan K3 Perusahaan yang Memenuhi PP 50/2012',
  'h1'    => 'Contoh Kebijakan K3 Perusahaan: Struktur, Isi Wajib, dan Kesalahan Umum',
  'meta'  => 'Cara menyusun kebijakan K3 yang sah menurut PP 50/2012: unsur wajib, contoh kerangka, proses penetapan, sosialisasi, dan tinjauan berkala.',
  'hub' => 'implementasi', 'type' => 'article',
  'prev' => 'dokumen-wajib-smk3', 'next' => 'cara-membentuk-p2k3',
  'related' => ['dokumen-wajib-smk3', 'implementasi', 'training-awareness-smk3'],
  'money' => 'jasa-konsultan-smk3',
  'img_alt' => 'Ilustrasi dokumen kebijakan K3 perusahaan yang ditandatangani pimpinan',
],

'cara-membentuk-p2k3' => [
  'n' => 19, 'path' => 'implementasi/cara-membentuk-p2k3/',
  'title' => 'Cara Membentuk P2K3: Syarat, Prosedur, dan Pengesahan',
  'h1'    => 'Cara Membentuk P2K3 (Panitia Pembina K3) Sampai Disahkan Disnaker',
  'meta'  => 'Prosedur pembentukan P2K3: syarat perusahaan, susunan panitia, peran sekretaris ahli K3 umum, pengajuan pengesahan ke Disnaker, dan tugas rutinnya.',
  'hub' => 'implementasi', 'type' => 'article',
  'prev' => 'contoh-kebijakan-k3', 'next' => 'struktur-organisasi-p2k3',
  'related' => ['struktur-organisasi-p2k3', 'ak3-umum-vs-smk3', 'implementasi'],
  'money' => 'jasa-konsultan-smk3',
  'img_alt' => 'Ilustrasi rapat pembentukan Panitia Pembina Keselamatan dan Kesehatan Kerja',
],

'struktur-organisasi-p2k3' => [
  'n' => 20, 'path' => 'implementasi/struktur-organisasi-p2k3/',
  'title' => 'Struktur Organisasi P2K3 yang Ideal + Contoh Bagan',
  'h1'    => 'Struktur Organisasi P2K3 yang Ideal untuk Berbagai Ukuran Perusahaan',
  'meta'  => 'Susunan P2K3 yang efektif: ketua, sekretaris, anggota, perwakilan pekerja. Contoh bagan untuk perusahaan kecil hingga multi-site, plus pembagian tugas.',
  'hub' => 'implementasi', 'type' => 'article',
  'prev' => 'cara-membentuk-p2k3', 'next' => 'hiradc-dalam-smk3',
  'related' => ['cara-membentuk-p2k3', 'contoh-kebijakan-k3', 'training-awareness-smk3'],
  'money' => 'jasa-konsultan-smk3',
  'img_alt' => 'Ilustrasi bagan struktur organisasi P2K3 dengan ketua, sekretaris, dan anggota',
],

'hiradc-dalam-smk3' => [
  'n' => 21, 'path' => 'implementasi/hiradc-dalam-smk3/',
  'title' => 'HIRADC dalam SMK3: Fungsi, Posisi, dan Kaitannya dengan Kriteria',
  'h1'    => 'HIRADC dalam SMK3: Jantung Pengendalian Risiko yang Diperiksa Auditor',
  'meta'  => 'Peran HIRADC dalam SMK3: identifikasi bahaya, penilaian risiko, penentuan pengendalian, kaitannya dengan kriteria audit, dan kapan wajib ditinjau ulang.',
  'hub' => 'implementasi', 'type' => 'article',
  'prev' => 'struktur-organisasi-p2k3', 'next' => 'cara-menyusun-hiradc',
  'related' => ['cara-menyusun-hiradc', 'manajemen-risiko-k3', 'job-safety-analysis'],
  'money' => 'jasa-konsultan-smk3',
  'img_alt' => 'Ilustrasi proses HIRADC identifikasi bahaya dan penilaian risiko kerja',
],

'cara-menyusun-hiradc' => [
  'n' => 22, 'path' => 'implementasi/cara-menyusun-hiradc/',
  'title' => 'Cara Menyusun HIRADC dengan Contoh Tabel Lengkap',
  'h1'    => 'Cara Menyusun HIRADC Langkah demi Langkah (dengan Contoh Tabel)',
  'meta'  => 'Tutorial menyusun HIRADC: memetakan aktivitas, mengidentifikasi bahaya, matriks risiko 5x5, hierarki pengendalian, dan contoh tabel siap pakai.',
  'hub' => 'implementasi', 'type' => 'article',
  'prev' => 'hiradc-dalam-smk3', 'next' => 'template-dokumen-smk3',
  'related' => ['hiradc-dalam-smk3', 'job-safety-analysis', 'manajemen-risiko-k3'],
  'money' => 'jasa-konsultan-smk3',
  'img_alt' => 'Ilustrasi tabel HIRADC dengan kolom bahaya, risiko, dan pengendalian',
],

'template-dokumen-smk3' => [
  'n' => 23, 'path' => 'implementasi/template-dokumen-smk3/',
  'title' => 'Template Dokumen SMK3: Kerangka Siap Pakai per Kategori',
  'h1'    => 'Template Dokumen SMK3: Kerangka Siap Pakai dan Cara Menyesuaikannya',
  'meta'  => 'Kerangka template dokumen SMK3 per kategori: manual, prosedur, IK, formulir. Cara menyesuaikan dengan proses bisnis agar lolos audit, bukan sekadar copy-paste.',
  'hub' => 'implementasi', 'type' => 'article',
  'prev' => 'cara-menyusun-hiradc', 'next' => 'industri',
  'related' => ['dokumen-wajib-smk3', 'contoh-kebijakan-k3', 'gap-analysis-smk3'],
  'money' => 'jasa-konsultan-smk3',
  'img_alt' => 'Ilustrasi kumpulan template dokumen SMK3 yang tersusun rapi',
],

/* ============ HUB 3 — INDUSTRI (24–32) ============ */

'industri' => [
  'n' => 24, 'path' => 'industri/',
  'title' => 'SMK3 per Sektor Industri: Panduan Lengkap Semua Sektor',
  'h1'    => 'SMK3 per Sektor Industri: Kebutuhan Khas Setiap Sektor dari Konstruksi sampai UMKM',
  'meta'  => 'Penerapan SMK3 berbeda di tiap sektor. Panduan khusus konstruksi, manufaktur, tambang, migas, logistik, rumah sakit, EPC, dan UMKM dalam satu tempat.',
  'hub' => 'industri', 'type' => 'hub',
  'prev' => 'template-dokumen-smk3', 'next' => 'smk3-konstruksi',
  'related' => ['implementasi', 'regulasi', 'biaya'],
  'money' => 'jasa-konsultan-smk3',
  'img_alt' => 'Ilustrasi berbagai sektor industri yang menerapkan SMK3 di Indonesia',
],

'smk3-konstruksi' => [
  'n' => 25, 'path' => 'industri/smk3-konstruksi/',
  'title' => 'SMK3 untuk Perusahaan Konstruksi: Wajib Tender & Cara Penerapan',
  'h1'    => 'SMK3 untuk Perusahaan Konstruksi: Syarat Tender dan Strategi Penerapannya',
  'meta'  => 'SMK3 di konstruksi: kaitan dengan SMKK PUPR, syarat tender LPSE, risiko dominan proyek, dan urutan penerapan yang realistis untuk kontraktor.',
  'hub' => 'industri', 'type' => 'article',
  'prev' => 'industri', 'next' => 'smk3-manufaktur',
  'related' => ['working-at-height', 'job-safety-analysis', 'smk3-epc'],
  'money' => 'jasa-konsultan-smk3',
  'img_alt' => 'Ilustrasi proyek konstruksi dengan penerapan sistem manajemen K3',
],

'smk3-manufaktur' => [
  'n' => 26, 'path' => 'industri/smk3-manufaktur/',
  'title' => 'SMK3 untuk Perusahaan Manufaktur: Panduan Penerapan Pabrik',
  'h1'    => 'SMK3 untuk Perusahaan Manufaktur: Dari Mesin Produksi sampai Gudang Bahan Kimia',
  'meta'  => 'Penerapan SMK3 di pabrik: bahaya mesin, LOTO, bahan kimia, ergonomi, kebisingan. Prioritas kriteria yang paling sering jadi temuan audit di manufaktur.',
  'hub' => 'industri', 'type' => 'article',
  'prev' => 'smk3-konstruksi', 'next' => 'smk3-pertambangan',
  'related' => ['hiradc-dalam-smk3', 'fire-safety-management', 'industrial-hygiene'],
  'money' => 'jasa-konsultan-smk3',
  'img_alt' => 'Ilustrasi pabrik manufaktur dengan pengaman mesin dan rambu K3',
],

'smk3-pertambangan' => [
  'n' => 27, 'path' => 'industri/smk3-pertambangan/',
  'title' => 'SMK3 untuk Perusahaan Pertambangan & Kaitannya dengan SMKP',
  'h1'    => 'SMK3 untuk Perusahaan Pertambangan: Posisinya di Samping SMKP Minerba',
  'meta'  => 'Perusahaan tambang mengenal SMKP Minerba dan SMK3 PP 50/2012. Pahami perbedaan, irisan, dan strategi memenuhi keduanya tanpa sistem ganda.',
  'hub' => 'industri', 'type' => 'article',
  'prev' => 'smk3-manufaktur', 'next' => 'smk3-migas',
  'related' => ['manajemen-risiko-k3', 'permit-to-work', 'smk3-migas'],
  'money' => 'jasa-konsultan-smk3',
  'img_alt' => 'Ilustrasi area pertambangan dengan alat berat dan sistem keselamatan kerja',
],

'smk3-migas' => [
  'n' => 28, 'path' => 'industri/smk3-migas/',
  'title' => 'SMK3 untuk Perusahaan Minyak dan Gas: Panduan Sektor Migas',
  'h1'    => 'SMK3 untuk Perusahaan Minyak dan Gas: Standar Tinggi, Ekspektasi Lebih Tinggi',
  'meta'  => 'SMK3 di sektor migas: hubungan dengan CSMS kontraktor, process safety, permit to work, dan mengapa KKKS menuntut lebih dari sekadar sertifikat.',
  'hub' => 'industri', 'type' => 'article',
  'prev' => 'smk3-pertambangan', 'next' => 'smk3-logistik',
  'related' => ['permit-to-work', 'confined-space', 'fire-safety-management'],
  'money' => 'jasa-konsultan-smk3',
  'img_alt' => 'Ilustrasi fasilitas minyak dan gas dengan sistem keselamatan proses',
],

'smk3-logistik' => [
  'n' => 29, 'path' => 'industri/smk3-logistik/',
  'title' => 'SMK3 untuk Perusahaan Logistik dan Pergudangan',
  'h1'    => 'SMK3 untuk Logistik dan Pergudangan: Forklift, Racking, dan Keselamatan Transportasi',
  'meta'  => 'Penerapan SMK3 di logistik: keselamatan forklift, penataan gudang, kelelahan pengemudi, dan kriteria audit yang paling relevan untuk sektor ini.',
  'hub' => 'industri', 'type' => 'article',
  'prev' => 'smk3-migas', 'next' => 'smk3-rumah-sakit',
  'related' => ['hiradc-dalam-smk3', 'job-safety-analysis', 'training-awareness-smk3'],
  'money' => 'jasa-konsultan-smk3',
  'img_alt' => 'Ilustrasi gudang logistik dengan forklift dan jalur keselamatan',
],

'smk3-rumah-sakit' => [
  'n' => 30, 'path' => 'industri/smk3-rumah-sakit/',
  'title' => 'SMK3 untuk Rumah Sakit dan Fasilitas Kesehatan (K3RS)',
  'h1'    => 'SMK3 untuk Rumah Sakit: Titik Temu PP 50/2012 dan K3RS',
  'meta'  => 'SMK3 di rumah sakit: hubungan dengan K3RS dan akreditasi, bahaya biologis, kimia, radiasi, serta strategi integrasi agar tidak tumpang tindih.',
  'hub' => 'industri', 'type' => 'article',
  'prev' => 'smk3-logistik', 'next' => 'smk3-epc',
  'related' => ['industrial-hygiene', 'manajemen-risiko-k3', 'fire-safety-management'],
  'money' => 'jasa-konsultan-smk3',
  'img_alt' => 'Ilustrasi rumah sakit dengan penerapan keselamatan kerja tenaga medis',
],

'smk3-epc' => [
  'n' => 31, 'path' => 'industri/smk3-epc/',
  'title' => 'SMK3 untuk Perusahaan EPC: Multi-Proyek, Multi-Standar',
  'h1'    => 'SMK3 untuk Perusahaan EPC: Mengelola K3 Lintas Proyek dan Lintas Standar',
  'meta'  => 'Tantangan SMK3 di perusahaan EPC: proyek tersebar, subkontraktor berlapis, tuntutan klien migas/tambang, dan cara membangun satu sistem untuk semua.',
  'hub' => 'industri', 'type' => 'article',
  'prev' => 'smk3-rumah-sakit', 'next' => 'smk3-umkm',
  'related' => ['smk3-konstruksi', 'smk3-migas', 'permit-to-work'],
  'money' => 'jasa-konsultan-smk3',
  'img_alt' => 'Ilustrasi proyek EPC dengan koordinasi engineering procurement construction',
],

'smk3-umkm' => [
  'n' => 32, 'path' => 'industri/smk3-umkm/',
  'title' => 'SMK3 untuk UMKM: Apakah Wajib? Ini Ketentuannya',
  'h1'    => 'SMK3 untuk UMKM: Apakah Wajib, dan Kapan Sebaiknya Mulai?',
  'meta'  => 'Apakah UMKM wajib SMK3? Batasan 100 pekerja dan potensi bahaya tinggi dijelaskan, plus pendekatan penerapan bertahap yang masuk akal untuk usaha kecil.',
  'hub' => 'industri', 'type' => 'article',
  'prev' => 'smk3-epc', 'next' => 'biaya',
  'related' => ['regulasi', 'sanksi-tidak-menerapkan-smk3', 'biaya'],
  'money' => 'kontak',
  'img_alt' => 'Ilustrasi usaha kecil menengah yang mulai menerapkan keselamatan kerja',
],

/* ============ HUB 4 — BIAYA / DECISION (33–40) ============ */

'biaya' => [
  'n' => 33, 'path' => 'biaya/',
  'title' => 'Biaya Sertifikasi SMK3: Rincian Lengkap Semua Komponen',
  'h1'    => 'Biaya Sertifikasi SMK3: Rincian Lengkap Semua Komponen dan Kisarannya',
  'meta'  => 'Rincian biaya sertifikasi SMK3: komponen audit lembaga sertifikasi, konsultan, pelatihan, perbaikan sarana. Kisaran per skala perusahaan dan cara menghemat.',
  'hub' => 'biaya', 'type' => 'hub',
  'prev' => 'smk3-umkm', 'next' => 'lama-proses-sertifikasi-smk3',
  'related' => ['harga-sertifikasi-smk3', 'lama-proses-sertifikasi-smk3', 'cara-memilih-konsultan-smk3'],
  'money' => 'harga-sertifikasi-smk3',
  'img_alt' => 'Ilustrasi kalkulasi komponen biaya sertifikasi SMK3',
],

'lama-proses-sertifikasi-smk3' => [
  'n' => 34, 'path' => 'biaya/lama-proses-sertifikasi-smk3/',
  'title' => 'Berapa Lama Proses Sertifikasi SMK3? Timeline Realistis',
  'h1'    => 'Berapa Lama Proses Sertifikasi SMK3? Timeline Realistis per Tahap',
  'meta'  => 'Durasi realistis sertifikasi SMK3 dari gap analysis sampai sertifikat terbit: rincian per tahap, faktor yang mempercepat/memperlambat, dan tips efisiensi.',
  'hub' => 'biaya', 'type' => 'article',
  'prev' => 'biaya', 'next' => 'cara-memilih-konsultan-smk3',
  'related' => ['implementasi', 'biaya', 'jenis-audit-smk3'],
  'money' => 'jasa-konsultan-smk3',
  'img_alt' => 'Ilustrasi timeline tahapan proses sertifikasi SMK3',
],

'cara-memilih-konsultan-smk3' => [
  'n' => 35, 'path' => 'biaya/cara-memilih-konsultan-smk3/',
  'title' => 'Cara Memilih Konsultan SMK3 Terpercaya: 9 Kriteria Penting',
  'h1'    => 'Cara Memilih Konsultan SMK3 Terpercaya: 9 Kriteria yang Wajib Dicek',
  'meta'  => 'Panduan memilih konsultan SMK3: legalitas PJK3, rekam jejak, metodologi, transparansi biaya, dan pertanyaan yang harus Anda ajukan sebelum kontrak.',
  'hub' => 'biaya', 'type' => 'article',
  'prev' => 'lama-proses-sertifikasi-smk3', 'next' => 'ciri-konsultan-smk3-abal-abal',
  'related' => ['ciri-konsultan-smk3-abal-abal', 'biaya', 'jasa-konsultan-smk3'],
  'money' => 'jasa-konsultan-smk3',
  'img_alt' => 'Ilustrasi evaluasi dan seleksi konsultan SMK3 dengan daftar kriteria',
],

'ciri-konsultan-smk3-abal-abal' => [
  'n' => 36, 'path' => 'biaya/ciri-konsultan-smk3-abal-abal/',
  'title' => 'Ciri-Ciri Konsultan SMK3 Abal-Abal yang Harus Dihindari',
  'h1'    => 'Ciri-Ciri Konsultan SMK3 Abal-Abal (dan Kerugian yang Mereka Timbulkan)',
  'meta'  => 'Waspadai konsultan SMK3 abal-abal: janji sertifikat pasti lulus, dokumen copy-paste, tanpa legalitas. Kenali tanda bahayanya sebelum perusahaan rugi.',
  'hub' => 'biaya', 'type' => 'article',
  'prev' => 'cara-memilih-konsultan-smk3', 'next' => 'checklist-kesiapan-audit-smk3',
  'related' => ['cara-memilih-konsultan-smk3', 'template-dokumen-smk3', 'biaya'],
  'money' => 'jasa-konsultan-smk3',
  'img_alt' => 'Ilustrasi tanda peringatan terhadap praktik konsultan SMK3 tidak kredibel',
],

'checklist-kesiapan-audit-smk3' => [
  'n' => 37, 'path' => 'biaya/checklist-kesiapan-audit-smk3/',
  'title' => 'Checklist Kesiapan Audit SMK3: Siap Diaudit atau Belum?',
  'h1'    => 'Checklist Kesiapan Audit SMK3: Ukur Sendiri Kesiapan Perusahaan Anda',
  'meta'  => 'Checklist kesiapan audit SMK3 per area: dokumen, lapangan, personel, rekaman. Gunakan sebelum mengundang lembaga audit agar tidak gagal di temuan mayor.',
  'hub' => 'biaya', 'type' => 'article',
  'prev' => 'ciri-konsultan-smk3-abal-abal', 'next' => 'studi-kasus-sertifikasi-smk3',
  'related' => ['jenis-audit-smk3', 'gap-analysis-smk3', 'jasa-audit-sertifikasi-smk3'],
  'money' => 'jasa-audit-sertifikasi-smk3',
  'img_alt' => 'Ilustrasi checklist persiapan audit SMK3 dengan item terverifikasi',
],

'studi-kasus-sertifikasi-smk3' => [
  'n' => 38, 'path' => 'biaya/studi-kasus-sertifikasi-smk3/',
  'title' => 'Studi Kasus Sertifikasi SMK3: Pola Perusahaan yang Berhasil',
  'h1'    => 'Studi Kasus Sertifikasi SMK3: Pola yang Berulang pada Perusahaan yang Berhasil',
  'meta'  => 'Pelajaran dari skenario sertifikasi SMK3 di lapangan: kondisi awal, hambatan umum, intervensi yang berhasil, dan pencapaian tingkat lanjutan.',
  'hub' => 'biaya', 'type' => 'article',
  'prev' => 'checklist-kesiapan-audit-smk3', 'next' => 'training-awareness-smk3',
  'related' => ['implementasi', 'lama-proses-sertifikasi-smk3', 'checklist-kesiapan-audit-smk3'],
  'money' => 'jasa-konsultan-smk3',
  'img_alt' => 'Ilustrasi perjalanan perusahaan mencapai sertifikasi SMK3 tingkat lanjutan',
],

'training-awareness-smk3' => [
  'n' => 39, 'path' => 'biaya/training-awareness-smk3/',
  'title' => 'Training Awareness SMK3 untuk Karyawan: Materi & Metode',
  'h1'    => 'Training Awareness SMK3 untuk Karyawan: Materi, Metode, dan Buktinya untuk Audit',
  'meta'  => 'Panduan training awareness SMK3: siapa yang wajib ikut, materi inti, metode efektif, dan dokumentasi pelatihan yang diakui auditor sebagai bukti.',
  'hub' => 'biaya', 'type' => 'article',
  'prev' => 'studi-kasus-sertifikasi-smk3', 'next' => 'faq-smk3',
  'related' => ['implementasi', 'contoh-kebijakan-k3', 'cara-membentuk-p2k3'],
  'money' => 'jasa-konsultan-smk3',
  'img_alt' => 'Ilustrasi sesi pelatihan kesadaran SMK3 untuk karyawan perusahaan',
],

'faq-smk3' => [
  'n' => 40, 'path' => 'biaya/faq-smk3/',
  'title' => 'FAQ SMK3: Jawaban 25+ Pertanyaan yang Paling Sering Diajukan',
  'h1'    => 'FAQ SMK3: Jawaban atas Pertanyaan yang Paling Sering Diajukan',
  'meta'  => 'Kumpulan jawaban ringkas seputar SMK3: kewajiban, audit, sertifikat, biaya, durasi, konsultan, dan penerapan — dijawab langsung tanpa berbelit.',
  'hub' => 'biaya', 'type' => 'article',
  'prev' => 'training-awareness-smk3', 'next' => 'k3-pendukung',
  'related' => ['regulasi', 'biaya', 'implementasi'],
  'money' => 'kontak',
  'img_alt' => 'Ilustrasi tanya jawab seputar sistem manajemen K3',
],

/* ============ HUB 5 — K3 PENDUKUNG (41–50) ============ */

'k3-pendukung' => [
  'n' => 41, 'path' => 'k3-pendukung/',
  'title' => 'Topik K3 Pendukung SMK3: JSA, PTW, Fire Safety & Lainnya',
  'h1'    => 'Topik K3 Pendukung SMK3: Program Operasional yang Menghidupkan Sistem',
  'meta'  => 'SMK3 butuh program operasional: JSA, permit to work, kerja di ketinggian, ruang terbatas, proteksi kebakaran, higiene industri, manajemen risiko.',
  'hub' => 'pendukung', 'type' => 'hub',
  'prev' => 'faq-smk3', 'next' => 'job-safety-analysis',
  'related' => ['implementasi', 'hiradc-dalam-smk3', 'industri'],
  'money' => 'jasa-konsultan-smk3',
  'img_alt' => 'Ilustrasi rangkaian program K3 operasional pendukung SMK3',
],

'job-safety-analysis' => [
  'n' => 42, 'path' => 'k3-pendukung/job-safety-analysis/',
  'title' => 'JSA (Job Safety Analysis) dalam SMK3: Panduan & Contoh',
  'h1'    => 'JSA (Job Safety Analysis) dalam SMK3: Cara Membuat dan Contohnya',
  'meta'  => 'Panduan JSA: kapan digunakan, bedanya dengan HIRADC, langkah penyusunan per tahapan kerja, dan contoh JSA untuk pekerjaan berisiko tinggi.',
  'hub' => 'pendukung', 'type' => 'article',
  'prev' => 'k3-pendukung', 'next' => 'permit-to-work',
  'related' => ['hiradc-dalam-smk3', 'permit-to-work', 'cara-menyusun-hiradc'],
  'money' => 'jasa-konsultan-smk3',
  'img_alt' => 'Ilustrasi analisis keselamatan pekerjaan per tahapan tugas',
],

'permit-to-work' => [
  'n' => 43, 'path' => 'k3-pendukung/permit-to-work/',
  'title' => 'Permit to Work: Panduan Sistem Izin Kerja Aman & Contoh Format',
  'h1'    => 'Permit to Work (Izin Kerja Aman): Panduan Sistem dan Contoh Formatnya',
  'meta'  => 'Sistem permit to work: jenis izin kerja (hot work, ketinggian, ruang terbatas), alur persetujuan, peran authorized person, dan contoh format PTW.',
  'hub' => 'pendukung', 'type' => 'article',
  'prev' => 'job-safety-analysis', 'next' => 'working-at-height',
  'related' => ['confined-space', 'working-at-height', 'job-safety-analysis'],
  'money' => 'jasa-konsultan-smk3',
  'img_alt' => 'Ilustrasi formulir izin kerja aman dengan tanda tangan persetujuan',
],

'working-at-height' => [
  'n' => 44, 'path' => 'k3-pendukung/working-at-height/',
  'title' => 'Working at Height: Regulasi K3 Ketinggian & Sertifikasi TKPK',
  'h1'    => 'Working at Height: Regulasi Bekerja di Ketinggian dan Sertifikasi TKPK',
  'meta'  => 'K3 bekerja di ketinggian: Permenaker 9/2016, hierarki pengendalian jatuh, sistem proteksi, kompetensi TKPK 1-3, dan kaitannya dengan kriteria SMK3.',
  'hub' => 'pendukung', 'type' => 'article',
  'prev' => 'permit-to-work', 'next' => 'confined-space',
  'related' => ['permit-to-work', 'smk3-konstruksi', 'job-safety-analysis'],
  'money' => 'jasa-konsultan-smk3',
  'img_alt' => 'Ilustrasi pekerja menggunakan full body harness saat bekerja di ketinggian',
],

'confined-space' => [
  'n' => 45, 'path' => 'k3-pendukung/confined-space/',
  'title' => 'Confined Space: Prosedur Keselamatan Kerja Ruang Terbatas',
  'h1'    => 'Confined Space: Prosedur Keselamatan Ruang Terbatas dari Izin sampai Rescue',
  'meta'  => 'Keselamatan ruang terbatas: identifikasi confined space, pengujian gas, izin masuk, peran attendant, rencana rescue, dan kompetensi petugasnya.',
  'hub' => 'pendukung', 'type' => 'article',
  'prev' => 'working-at-height', 'next' => 'fire-safety-management',
  'related' => ['permit-to-work', 'smk3-migas', 'industrial-hygiene'],
  'money' => 'jasa-konsultan-smk3',
  'img_alt' => 'Ilustrasi pekerja memasuki ruang terbatas dengan pengawasan dan deteksi gas',
],

'fire-safety-management' => [
  'n' => 46, 'path' => 'k3-pendukung/fire-safety-management/',
  'title' => 'Fire Safety Management dalam SMK3: Proteksi & Tanggap Darurat',
  'h1'    => 'Fire Safety Management dalam SMK3: Proteksi Kebakaran dan Kesiapan Tanggap Darurat',
  'meta'  => 'Manajemen keselamatan kebakaran: proteksi aktif-pasif, tim tanggap darurat kelas A-D, simulasi evakuasi, dan kriteria SMK3 yang memeriksanya.',
  'hub' => 'pendukung', 'type' => 'article',
  'prev' => 'confined-space', 'next' => 'industrial-hygiene',
  'related' => ['smk3-manufaktur', 'manajemen-risiko-k3', 'training-awareness-smk3'],
  'money' => 'jasa-konsultan-smk3',
  'img_alt' => 'Ilustrasi sistem proteksi kebakaran gedung dengan APAR dan jalur evakuasi',
],

'industrial-hygiene' => [
  'n' => 47, 'path' => 'k3-pendukung/industrial-hygiene/',
  'title' => 'Industrial Hygiene & Kaitannya dengan SMK3: Panduan Praktis',
  'h1'    => 'Industrial Hygiene dan Kaitannya dengan SMK3: Mengendalikan Bahaya yang Tak Terlihat',
  'meta'  => 'Higiene industri dalam SMK3: bahaya fisik, kimia, biologis, ergonomi; pengukuran lingkungan kerja, NAB, pemeriksaan kesehatan, dan kriterianya.',
  'hub' => 'pendukung', 'type' => 'article',
  'prev' => 'fire-safety-management', 'next' => 'manajemen-risiko-k3',
  'related' => ['smk3-rumah-sakit', 'smk3-manufaktur', 'hiradc-dalam-smk3'],
  'money' => 'jasa-konsultan-smk3',
  'img_alt' => 'Ilustrasi pengukuran faktor lingkungan kerja seperti kebisingan dan debu',
],

'manajemen-risiko-k3' => [
  'n' => 48, 'path' => 'k3-pendukung/manajemen-risiko-k3/',
  'title' => 'Manajemen Risiko K3: Panduan Lengkap Identifikasi sampai Kontrol',
  'h1'    => 'Manajemen Risiko K3: Panduan Lengkap dari Identifikasi sampai Pemantauan',
  'meta'  => 'Kerangka manajemen risiko K3: identifikasi bahaya, analisis dan evaluasi risiko, hierarki pengendalian, pemantauan, dan integrasinya ke SMK3.',
  'hub' => 'pendukung', 'type' => 'article',
  'prev' => 'industrial-hygiene', 'next' => 'blog',
  'related' => ['hiradc-dalam-smk3', 'cara-menyusun-hiradc', 'job-safety-analysis'],
  'money' => 'jasa-konsultan-smk3',
  'img_alt' => 'Ilustrasi matriks risiko dan siklus manajemen risiko K3',
],

'blog' => [
  'n' => 49, 'path' => 'blog/',
  'title' => 'Blog SMK3: Berita & Update Regulasi K3 Terbaru',
  'h1'    => 'Blog: Berita dan Update Regulasi K3 Terbaru',
  'meta'  => 'Update perkembangan regulasi K3 dan SMK3 Indonesia: peraturan baru, perubahan kebijakan Kemnaker, tren penegakan, dan artinya bagi perusahaan Anda.',
  'hub' => 'pendukung', 'type' => 'article',
  'prev' => 'manajemen-risiko-k3', 'next' => 'tentang-kami',
  'related' => ['regulasi', 'sanksi-tidak-menerapkan-smk3', 'faq-smk3'],
  'money' => 'kontak',
  'img_alt' => 'Ilustrasi pembaruan berita dan regulasi keselamatan kerja terbaru',
],

'tentang-kami' => [
  'n' => 50, 'path' => 'tentang-kami/',
  'title' => 'Tentang Kami: Tim Ahli SMK3 di Balik Panduan Ini',
  'h1'    => 'Tentang Kami: Tim Ahli SMK3 di Balik Panduan Ini',
  'meta'  => 'Kenali tim di balik panduan SMK3 ini: latar belakang, metodologi kerja, prinsip layanan, dan komitmen kami pada praktik K3 yang benar di Indonesia.',
  'hub' => 'pendukung', 'type' => 'article',
  'prev' => 'blog', 'next' => 'home',
  'related' => ['jasa-konsultan-smk3', 'kontak', 'studi-kasus-sertifikasi-smk3'],
  'money' => 'kontak',
  'img_alt' => 'Ilustrasi tim konsultan keselamatan dan kesehatan kerja profesional',
],

];
