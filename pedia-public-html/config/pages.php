<?php
/**
 * MASTER PAGE MANIFEST — pedia.wahanatotalita.com
 * 49 pages: 1 home + 6 hubs + 36 articles + 6 utility.
 * Chain (closed loop, 43 nodes): home → k3-dasar hub → … → pelaporan-kecelakaan-kerja → home.
 * Utility pages sit OUTSIDE the chain, linked sitewide via mega-footer.
 * Same engine contract as smk3_site/iso_site — see ARCHITECTURE.md.
 *
 * type: home | hub | article | utility   (NO money pages — non-commercial site)
 */

return [

/* ============ HOME (1) ============ */

'home' => [
  'n' => 1, 'path' => '',
  'title' => 'Pustaka Pengetahuan K3 & HSE Indonesia',
  'h1'    => 'PediaK3: Pustaka Pengetahuan K3, Kesehatan Kerja, dan Lingkungan Indonesia',
  'meta'  => 'Rujukan terbuka K3/HSE Indonesia: dasar K3 & SMK3, bahaya & pengendalian, regulasi Kemnaker, kesehatan kerja, limbah B3, dan studi kasus kecelakaan kerja.',
  'hub' => 'utility', 'type' => 'home',
  'prev' => 'pelaporan-kecelakaan-kerja', 'next' => 'k3-dasar',
  'related' => ['k3-dasar', 'regulasi', 'bahaya'],
  'img_alt' => 'Ilustrasi pustaka pengetahuan keselamatan dan kesehatan kerja Indonesia',
],

/* ============ PILAR 1 — K3 DASAR & SMK3 (2–8) ============ */

'k3-dasar' => [
  'n' => 2, 'path' => 'k3-dasar/',
  'title' => 'K3 Dasar & SMK3: Pengertian, Prinsip, dan Kelembagaan',
  'h1'    => 'K3 Dasar dan SMK3: Fondasi Keselamatan dan Kesehatan Kerja',
  'meta'  => 'Panduan dasar K3: pengertian dan tujuan K3, SMK3, peran Ahli K3 Umum, P2K3, budaya keselamatan, serta induksi dan pelatihan K3 di tempat kerja.',
  'hub' => 'k3-dasar', 'type' => 'hub',
  'prev' => 'home', 'next' => 'apa-itu-k3',
  'related' => ['apa-itu-k3', 'sistem-manajemen-k3', 'regulasi'],
  'img_alt' => 'Ilustrasi fondasi keselamatan dan kesehatan kerja di tempat kerja',
],

'apa-itu-k3' => [
  'n' => 3, 'path' => 'k3-dasar/apa-itu-k3/',
  'title' => 'Apa Itu K3? Pengertian, Tujuan, dan Ruang Lingkup',
  'h1'    => 'Apa Itu K3? Pengertian, Tujuan, dan Ruang Lingkupnya',
  'meta'  => 'K3 (Keselamatan dan Kesehatan Kerja) adalah upaya melindungi tenaga kerja dari kecelakaan dan penyakit akibat kerja. Pengertian, tujuan, dan dasar hukumnya.',
  'hub' => 'k3-dasar', 'type' => 'article',
  'prev' => 'k3-dasar', 'next' => 'sistem-manajemen-k3',
  'related' => ['sistem-manajemen-k3', 'uu-1-1970-keselamatan-kerja', 'budaya-k3'],
  'img_alt' => 'Ilustrasi konsep dasar keselamatan dan kesehatan kerja',
],

'sistem-manajemen-k3' => [
  'n' => 4, 'path' => 'k3-dasar/sistem-manajemen-k3/',
  'title' => 'SMK3: Pengertian, 5 Prinsip Dasar, dan Penerapannya',
  'h1'    => 'Sistem Manajemen K3 (SMK3): Pengertian, Prinsip, dan Penerapan',
  'meta'  => 'SMK3 adalah bagian sistem manajemen perusahaan untuk pengendalian risiko K3. Lima prinsip dasar SMK3 menurut PP 50/2012 dan tahapan penerapannya.',
  'hub' => 'k3-dasar', 'type' => 'article',
  'prev' => 'apa-itu-k3', 'next' => 'ahli-k3-umum',
  'related' => ['smk3-pp-50-2012', 'apa-itu-k3', 'p2k3'],
  'img_alt' => 'Ilustrasi siklus lima prinsip Sistem Manajemen Keselamatan dan Kesehatan Kerja',
],

'ahli-k3-umum' => [
  'n' => 5, 'path' => 'k3-dasar/ahli-k3-umum/',
  'title' => 'Ahli K3 Umum: Tugas, Dasar Hukum, dan Jalur Penunjukan',
  'h1'    => 'Ahli K3 Umum: Tugas, Wewenang, dan Dasar Hukum Penunjukannya',
  'meta'  => 'Ahli K3 Umum adalah tenaga teknis yang ditunjuk Kemnaker untuk mengawasi ditaatinya peraturan K3. Tugas, wewenang, syarat, dan jalur penunjukannya.',
  'hub' => 'k3-dasar', 'type' => 'article',
  'prev' => 'sistem-manajemen-k3', 'next' => 'p2k3',
  'related' => ['p2k3', 'uu-1-1970-keselamatan-kerja', 'induksi-dan-pelatihan-k3'],
  'img_alt' => 'Ilustrasi peran ahli keselamatan dan kesehatan kerja umum di perusahaan',
],

'p2k3' => [
  'n' => 6, 'path' => 'k3-dasar/p2k3/',
  'title' => 'P2K3: Fungsi, Struktur, dan Syarat Pembentukannya',
  'h1'    => 'P2K3 (Panitia Pembina K3): Fungsi, Struktur, dan Syarat Pembentukan',
  'meta'  => 'P2K3 adalah badan pembantu di tempat kerja yang mengembangkan kerja sama K3 antara pengusaha dan pekerja. Fungsi, struktur, dan dasar pembentukannya.',
  'hub' => 'k3-dasar', 'type' => 'article',
  'prev' => 'ahli-k3-umum', 'next' => 'budaya-k3',
  'related' => ['ahli-k3-umum', 'sistem-manajemen-k3', 'budaya-k3'],
  'img_alt' => 'Ilustrasi rapat panitia pembina keselamatan dan kesehatan kerja',
],

'budaya-k3' => [
  'n' => 7, 'path' => 'k3-dasar/budaya-k3/',
  'title' => 'Budaya K3: Tahapan Kematangan dan Cara Membangunnya',
  'h1'    => 'Budaya K3: Tahapan Kematangan dan Cara Membangunnya di Perusahaan',
  'meta'  => 'Budaya K3 adalah nilai dan perilaku keselamatan yang dianut seluruh organisasi. Tahapan kematangan budaya keselamatan dan langkah membangunnya.',
  'hub' => 'k3-dasar', 'type' => 'article',
  'prev' => 'p2k3', 'next' => 'induksi-dan-pelatihan-k3',
  'related' => ['induksi-dan-pelatihan-k3', 'apa-itu-k3', 'kelelahan-kerja-fatigue'],
  'img_alt' => 'Ilustrasi budaya keselamatan kerja yang melibatkan seluruh pekerja',
],

'induksi-dan-pelatihan-k3' => [
  'n' => 8, 'path' => 'k3-dasar/induksi-dan-pelatihan-k3/',
  'title' => 'Induksi & Pelatihan K3: Jenis, Materi, dan Kewajibannya',
  'h1'    => 'Induksi dan Pelatihan K3: Jenis, Materi, dan Dasar Kewajibannya',
  'meta'  => 'Induksi K3 dan pelatihan K3 adalah kewajiban pengurus menurut UU 1/1970. Jenis pelatihan, materi minimum, dan kaitannya dengan kompetensi kerja.',
  'hub' => 'k3-dasar', 'type' => 'article',
  'prev' => 'budaya-k3', 'next' => 'bahaya',
  'related' => ['ahli-k3-umum', 'budaya-k3', 'hierarki-pengendalian-risiko'],
  'img_alt' => 'Ilustrasi sesi induksi keselamatan bagi pekerja baru',
],

/* ============ PILAR 2 — BAHAYA & PENGENDALIAN (9–15) ============ */

'bahaya' => [
  'n' => 9, 'path' => 'bahaya/',
  'title' => 'Bahaya & Pengendalian Risiko K3: Panduan per Jenis Bahaya',
  'h1'    => 'Bahaya dan Pengendalian Risiko di Tempat Kerja',
  'meta'  => 'Panduan bahaya K3: hierarki pengendalian risiko, APD, bekerja di ketinggian, ruang terbatas, K3 listrik, dan pencegahan kebakaran di tempat kerja.',
  'hub' => 'bahaya', 'type' => 'hub',
  'prev' => 'induksi-dan-pelatihan-k3', 'next' => 'hierarki-pengendalian-risiko',
  'related' => ['hierarki-pengendalian-risiko', 'alat-pelindung-diri', 'k3-dasar'],
  'img_alt' => 'Ilustrasi identifikasi bahaya dan pengendalian risiko di tempat kerja',
],

'hierarki-pengendalian-risiko' => [
  'n' => 10, 'path' => 'bahaya/hierarki-pengendalian-risiko/',
  'title' => 'Hierarki Pengendalian Risiko: 5 Tingkat dan Contohnya',
  'h1'    => 'Hierarki Pengendalian Risiko K3: Lima Tingkat dan Contoh Penerapannya',
  'meta'  => 'Hierarki pengendalian risiko: eliminasi, substitusi, rekayasa teknik, administratif, dan APD. Urutan prioritas pengendalian bahaya beserta contoh nyata.',
  'hub' => 'bahaya', 'type' => 'article',
  'prev' => 'bahaya', 'next' => 'alat-pelindung-diri',
  'related' => ['alat-pelindung-diri', 'sistem-manajemen-k3', 'investigasi-kecelakaan-kerja'],
  'img_alt' => 'Ilustrasi piramida lima tingkat hierarki pengendalian risiko',
],

'alat-pelindung-diri' => [
  'n' => 11, 'path' => 'bahaya/alat-pelindung-diri/',
  'title' => 'Alat Pelindung Diri (APD): Jenis, Fungsi, dan Kewajiban',
  'h1'    => 'Alat Pelindung Diri (APD): Jenis, Fungsi, dan Kewajiban Penyediaannya',
  'meta'  => 'APD adalah alat untuk melindungi sebagian atau seluruh tubuh dari potensi bahaya. Jenis APD menurut Permenaker 8/2010, fungsi, dan kewajiban perusahaan.',
  'hub' => 'bahaya', 'type' => 'article',
  'prev' => 'hierarki-pengendalian-risiko', 'next' => 'bekerja-di-ketinggian',
  'related' => ['hierarki-pengendalian-risiko', 'bekerja-di-ketinggian', 'sanksi-pelanggaran-k3'],
  'img_alt' => 'Ilustrasi ragam alat pelindung diri dari kepala hingga kaki',
],

'bekerja-di-ketinggian' => [
  'n' => 12, 'path' => 'bahaya/bekerja-di-ketinggian/',
  'title' => 'Bekerja di Ketinggian: Syarat, Perangkat, dan Regulasinya',
  'h1'    => 'Bekerja di Ketinggian: Syarat K3, Perangkat Pelindung Jatuh, dan Regulasinya',
  'meta'  => 'Bekerja di ketinggian diatur Permenaker 9/2016: perencanaan, teknik bekerja aman, perangkat pelindung jatuh, dan kompetensi tenaga kerja ketinggian.',
  'hub' => 'bahaya', 'type' => 'article',
  'prev' => 'alat-pelindung-diri', 'next' => 'ruang-terbatas',
  'related' => ['alat-pelindung-diri', 'studi-kasus-jatuh-dari-ketinggian', 'hierarki-pengendalian-risiko'],
  'img_alt' => 'Ilustrasi pekerja menggunakan perangkat pelindung jatuh di ketinggian',
],

'ruang-terbatas' => [
  'n' => 13, 'path' => 'bahaya/ruang-terbatas/',
  'title' => 'Ruang Terbatas (Confined Space): Bahaya dan Prosedur Aman',
  'h1'    => 'Ruang Terbatas (Confined Space): Bahaya, Izin Kerja, dan Prosedur Aman',
  'meta'  => 'Ruang terbatas menyimpan bahaya atmosfer dan jebakan. Kriteria confined space, pengukuran gas, izin kerja, dan prosedur masuk yang aman.',
  'hub' => 'bahaya', 'type' => 'article',
  'prev' => 'bekerja-di-ketinggian', 'next' => 'k3-listrik',
  'related' => ['studi-kasus-ruang-terbatas', 'alat-pelindung-diri', 'nilai-ambang-batas'],
  'img_alt' => 'Ilustrasi pekerja memasuki ruang terbatas dengan izin kerja dan pengukur gas',
],

'k3-listrik' => [
  'n' => 14, 'path' => 'bahaya/k3-listrik/',
  'title' => 'K3 Listrik: Bahaya, Pengendalian, dan Permenaker 12/2015',
  'h1'    => 'K3 Listrik: Bahaya Kelistrikan, Pengendalian, dan Regulasinya',
  'meta'  => 'K3 listrik mencakup perlindungan dari sengatan, busur api, dan kebakaran listrik. Bahaya kelistrikan, pengendalian, dan pokok Permenaker 12/2015.',
  'hub' => 'bahaya', 'type' => 'article',
  'prev' => 'ruang-terbatas', 'next' => 'kebakaran-di-tempat-kerja',
  'related' => ['kebakaran-di-tempat-kerja', 'hierarki-pengendalian-risiko', 'alat-pelindung-diri'],
  'img_alt' => 'Ilustrasi pengendalian bahaya kelistrikan di tempat kerja',
],

'kebakaran-di-tempat-kerja' => [
  'n' => 15, 'path' => 'bahaya/kebakaran-di-tempat-kerja/',
  'title' => 'Kebakaran di Tempat Kerja: Pencegahan, APAR, dan Tanggap Darurat',
  'h1'    => 'Kebakaran di Tempat Kerja: Pencegahan, Proteksi, dan Tanggap Darurat',
  'meta'  => 'Pencegahan kebakaran di tempat kerja: segitiga api, klasifikasi kebakaran, APAR menurut Permenaker 4/1980, dan organisasi tanggap darurat kebakaran.',
  'hub' => 'bahaya', 'type' => 'article',
  'prev' => 'k3-listrik', 'next' => 'regulasi',
  'related' => ['studi-kasus-kebakaran-gudang', 'k3-listrik', 'alat-pelindung-diri'],
  'img_alt' => 'Ilustrasi proteksi kebakaran dan alat pemadam api ringan di tempat kerja',
],

/* ============ PILAR 3 — REGULASI K3 (16–22) ============ */

'regulasi' => [
  'n' => 16, 'path' => 'regulasi/',
  'title' => 'Regulasi K3 Indonesia: Peta UU, PP, dan Permenaker',
  'h1'    => 'Regulasi K3 Indonesia: Peta Undang-Undang, PP, dan Permenaker',
  'meta'  => 'Peta regulasi K3 Indonesia: UU 1/1970, PP 50/2012 tentang SMK3, Permenaker lingkungan kerja, alat angkat, P3K, hingga sanksi pelanggaran K3.',
  'hub' => 'regulasi', 'type' => 'hub',
  'prev' => 'kebakaran-di-tempat-kerja', 'next' => 'uu-1-1970-keselamatan-kerja',
  'related' => ['uu-1-1970-keselamatan-kerja', 'smk3-pp-50-2012', 'k3-dasar'],
  'img_alt' => 'Ilustrasi susunan peraturan perundang-undangan keselamatan kerja Indonesia',
],

'uu-1-1970-keselamatan-kerja' => [
  'n' => 17, 'path' => 'regulasi/uu-1-1970-keselamatan-kerja/',
  'title' => 'UU No. 1 Tahun 1970: Isi Pokok dan Relevansinya Kini',
  'h1'    => 'UU No. 1 Tahun 1970 tentang Keselamatan Kerja: Isi Pokok dan Relevansinya',
  'meta'  => 'UU 1/1970 adalah induk hukum keselamatan kerja Indonesia: ruang lingkup, syarat keselamatan, kewajiban pengurus dan pekerja, serta pengawasannya.',
  'hub' => 'regulasi', 'type' => 'article',
  'prev' => 'regulasi', 'next' => 'smk3-pp-50-2012',
  'related' => ['smk3-pp-50-2012', 'apa-itu-k3', 'sanksi-pelanggaran-k3'],
  'img_alt' => 'Ilustrasi undang-undang keselamatan kerja sebagai induk regulasi K3',
],

'smk3-pp-50-2012' => [
  'n' => 18, 'path' => 'regulasi/smk3-pp-50-2012/',
  'title' => 'PP 50/2012 tentang SMK3: Kewajiban, Elemen, dan Audit',
  'h1'    => 'PP No. 50 Tahun 2012 tentang Penerapan SMK3: Kewajiban, Elemen, dan Audit',
  'meta'  => 'PP 50/2012 mewajibkan SMK3 bagi perusahaan dengan 100+ pekerja atau risiko tinggi. Lima prinsip, 12 elemen audit, dan mekanisme penilaian penerapannya.',
  'hub' => 'regulasi', 'type' => 'article',
  'prev' => 'uu-1-1970-keselamatan-kerja', 'next' => 'permenaker-5-2018-lingkungan-kerja',
  'related' => ['sistem-manajemen-k3', 'uu-1-1970-keselamatan-kerja', 'pelaporan-kecelakaan-kerja'],
  'img_alt' => 'Ilustrasi elemen audit penerapan sistem manajemen K3 menurut PP 50 tahun 2012',
],

'permenaker-5-2018-lingkungan-kerja' => [
  'n' => 19, 'path' => 'regulasi/permenaker-5-2018-lingkungan-kerja/',
  'title' => 'Permenaker 5/2018: K3 Lingkungan Kerja dan NAB',
  'h1'    => 'Permenaker No. 5 Tahun 2018 tentang K3 Lingkungan Kerja dan NAB',
  'meta'  => 'Permenaker 5/2018 mengatur faktor fisika, kimia, biologi, ergonomi, dan psikologi lingkungan kerja beserta NAB dan kewajiban pengukurannya.',
  'hub' => 'regulasi', 'type' => 'article',
  'prev' => 'smk3-pp-50-2012', 'next' => 'permenaker-8-2020-alat-angkat',
  'related' => ['nilai-ambang-batas', 'pencemaran-udara-tempat-kerja', 'penyakit-akibat-kerja'],
  'img_alt' => 'Ilustrasi pengukuran faktor bahaya lingkungan kerja sesuai Permenaker 5 tahun 2018',
],

'permenaker-8-2020-alat-angkat' => [
  'n' => 20, 'path' => 'regulasi/permenaker-8-2020-alat-angkat/',
  'title' => 'Permenaker 8/2020: K3 Pesawat Angkat dan Pesawat Angkut',
  'h1'    => 'Permenaker No. 8 Tahun 2020 tentang K3 Pesawat Angkat dan Pesawat Angkut',
  'meta'  => 'Permenaker 8/2020 mengatur keselamatan crane, forklift, dan alat angkat-angkut lain: pemeriksaan, pengujian, dan kompetensi operatornya.',
  'hub' => 'regulasi', 'type' => 'article',
  'prev' => 'permenaker-5-2018-lingkungan-kerja', 'next' => 'permenaker-15-2008-p3k',
  'related' => ['bekerja-di-ketinggian', 'hierarki-pengendalian-risiko', 'sanksi-pelanggaran-k3'],
  'img_alt' => 'Ilustrasi keselamatan pengoperasian pesawat angkat dan angkut',
],

'permenaker-15-2008-p3k' => [
  'n' => 21, 'path' => 'regulasi/permenaker-15-2008-p3k/',
  'title' => 'Permenaker 15/2008: P3K di Tempat Kerja',
  'h1'    => 'Permenaker No. 15 Tahun 2008 tentang P3K di Tempat Kerja',
  'meta'  => 'Permenaker 15/2008 mewajibkan petugas P3K, kotak P3K, dan ruang P3K sesuai jumlah pekerja dan risiko. Rasio petugas dan isi kotak P3K.',
  'hub' => 'regulasi', 'type' => 'article',
  'prev' => 'permenaker-8-2020-alat-angkat', 'next' => 'sanksi-pelanggaran-k3',
  'related' => ['pemeriksaan-kesehatan-tenaga-kerja', 'penyakit-akibat-kerja', 'kebakaran-di-tempat-kerja'],
  'img_alt' => 'Ilustrasi fasilitas pertolongan pertama pada kecelakaan di tempat kerja',
],

'sanksi-pelanggaran-k3' => [
  'n' => 22, 'path' => 'regulasi/sanksi-pelanggaran-k3/',
  'title' => 'Sanksi Pelanggaran K3: Pidana, Administratif, dan Perdata',
  'h1'    => 'Sanksi Pelanggaran K3: Ancaman Pidana, Administratif, dan Perdata',
  'meta'  => 'Pelanggaran K3 dapat berujung sanksi pidana UU 1/1970, sanksi administratif UU Ketenagakerjaan, hingga gugatan perdata. Rincian dasar hukumnya.',
  'hub' => 'regulasi', 'type' => 'article',
  'prev' => 'permenaker-15-2008-p3k', 'next' => 'kesehatan-kerja',
  'related' => ['uu-1-1970-keselamatan-kerja', 'pelaporan-kecelakaan-kerja', 'alat-pelindung-diri'],
  'img_alt' => 'Ilustrasi konsekuensi hukum atas pelanggaran keselamatan kerja',
],

/* ============ PILAR 4 — KESEHATAN KERJA (23–29) ============ */

'kesehatan-kerja' => [
  'n' => 23, 'path' => 'kesehatan-kerja/',
  'title' => 'Kesehatan Kerja: PAK, Ergonomi, NAB, dan Fatigue',
  'h1'    => 'Kesehatan Kerja: Penyakit Akibat Kerja, Ergonomi, dan Higiene Industri',
  'meta'  => 'Panduan kesehatan kerja: penyakit akibat kerja, ergonomi, kelelahan (fatigue), nilai ambang batas, pemeriksaan kesehatan, dan faktor psikososial.',
  'hub' => 'kesehatan-kerja', 'type' => 'hub',
  'prev' => 'sanksi-pelanggaran-k3', 'next' => 'penyakit-akibat-kerja',
  'related' => ['penyakit-akibat-kerja', 'ergonomi-di-tempat-kerja', 'bahaya'],
  'img_alt' => 'Ilustrasi perlindungan kesehatan tenaga kerja di tempat kerja',
],

'penyakit-akibat-kerja' => [
  'n' => 24, 'path' => 'kesehatan-kerja/penyakit-akibat-kerja/',
  'title' => 'Penyakit Akibat Kerja (PAK): Jenis, Diagnosis, dan Jaminannya',
  'h1'    => 'Penyakit Akibat Kerja (PAK): Jenis, Diagnosis, dan Jaminannya',
  'meta'  => 'PAK adalah penyakit yang disebabkan pekerjaan atau lingkungan kerja. Jenis PAK menurut Perpres 7/2019, tujuh langkah diagnosis, dan jaminan JKK.',
  'hub' => 'kesehatan-kerja', 'type' => 'article',
  'prev' => 'kesehatan-kerja', 'next' => 'ergonomi-di-tempat-kerja',
  'related' => ['pemeriksaan-kesehatan-tenaga-kerja', 'nilai-ambang-batas', 'permenaker-5-2018-lingkungan-kerja'],
  'img_alt' => 'Ilustrasi diagnosis penyakit yang timbul karena hubungan kerja',
],

'ergonomi-di-tempat-kerja' => [
  'n' => 25, 'path' => 'kesehatan-kerja/ergonomi-di-tempat-kerja/',
  'title' => 'Ergonomi di Tempat Kerja: Prinsip dan Penerapannya',
  'h1'    => 'Ergonomi di Tempat Kerja: Prinsip, Risiko, dan Penerapannya',
  'meta'  => 'Ergonomi menyesuaikan pekerjaan dengan kemampuan manusia: postur kerja, manual handling, stasiun kerja, dan pencegahan gangguan otot-rangka (MSDs).',
  'hub' => 'kesehatan-kerja', 'type' => 'article',
  'prev' => 'penyakit-akibat-kerja', 'next' => 'kelelahan-kerja-fatigue',
  'related' => ['penyakit-akibat-kerja', 'kelelahan-kerja-fatigue', 'permenaker-5-2018-lingkungan-kerja'],
  'img_alt' => 'Ilustrasi postur kerja ergonomis pada stasiun kerja',
],

'kelelahan-kerja-fatigue' => [
  'n' => 26, 'path' => 'kesehatan-kerja/kelelahan-kerja-fatigue/',
  'title' => 'Kelelahan Kerja (Fatigue): Penyebab dan Pengelolaannya',
  'h1'    => 'Kelelahan Kerja (Fatigue): Penyebab, Dampak, dan Pengelolaannya',
  'meta'  => 'Fatigue menurunkan kewaspadaan dan memicu kecelakaan kerja. Penyebab kelelahan kerja, tanda-tandanya, dan pengelolaan jam kerja serta shift.',
  'hub' => 'kesehatan-kerja', 'type' => 'article',
  'prev' => 'ergonomi-di-tempat-kerja', 'next' => 'nilai-ambang-batas',
  'related' => ['psikososial-dan-stres-kerja', 'ergonomi-di-tempat-kerja', 'investigasi-kecelakaan-kerja'],
  'img_alt' => 'Ilustrasi dampak kelelahan kerja terhadap kewaspadaan pekerja',
],

'nilai-ambang-batas' => [
  'n' => 27, 'path' => 'kesehatan-kerja/nilai-ambang-batas/',
  'title' => 'Nilai Ambang Batas (NAB): Pengertian dan Contoh Angkanya',
  'h1'    => 'Nilai Ambang Batas (NAB): Pengertian, Fungsi, dan Contoh Angkanya',
  'meta'  => 'NAB adalah standar faktor bahaya yang dapat diterima pekerja 8 jam sehari tanpa gangguan kesehatan. NAB kebisingan, iklim kerja, dan bahan kimia.',
  'hub' => 'kesehatan-kerja', 'type' => 'article',
  'prev' => 'kelelahan-kerja-fatigue', 'next' => 'pemeriksaan-kesehatan-tenaga-kerja',
  'related' => ['permenaker-5-2018-lingkungan-kerja', 'pencemaran-udara-tempat-kerja', 'penyakit-akibat-kerja'],
  'img_alt' => 'Ilustrasi pengukuran nilai ambang batas faktor bahaya di tempat kerja',
],

'pemeriksaan-kesehatan-tenaga-kerja' => [
  'n' => 28, 'path' => 'kesehatan-kerja/pemeriksaan-kesehatan-tenaga-kerja/',
  'title' => 'Pemeriksaan Kesehatan Tenaga Kerja: Awal, Berkala, Khusus',
  'h1'    => 'Pemeriksaan Kesehatan Tenaga Kerja: Awal, Berkala, dan Khusus',
  'meta'  => 'Permenakertrans 2/1980 mewajibkan pemeriksaan kesehatan awal, berkala, dan khusus bagi tenaga kerja. Tujuan, cakupan, dan tindak lanjut hasilnya.',
  'hub' => 'kesehatan-kerja', 'type' => 'article',
  'prev' => 'nilai-ambang-batas', 'next' => 'psikososial-dan-stres-kerja',
  'related' => ['penyakit-akibat-kerja', 'permenaker-15-2008-p3k', 'nilai-ambang-batas'],
  'img_alt' => 'Ilustrasi pemeriksaan kesehatan berkala bagi tenaga kerja',
],

'psikososial-dan-stres-kerja' => [
  'n' => 29, 'path' => 'kesehatan-kerja/psikososial-dan-stres-kerja/',
  'title' => 'Faktor Psikososial & Stres Kerja: Sumber dan Pengendalian',
  'h1'    => 'Faktor Psikososial dan Stres Kerja: Sumber, Dampak, dan Pengendaliannya',
  'meta'  => 'Faktor psikososial — beban kerja, konflik peran, jam kerja — diakui Permenaker 5/2018 sebagai bahaya lingkungan kerja. Sumber stres dan pengendaliannya.',
  'hub' => 'kesehatan-kerja', 'type' => 'article',
  'prev' => 'pemeriksaan-kesehatan-tenaga-kerja', 'next' => 'lingkungan',
  'related' => ['kelelahan-kerja-fatigue', 'permenaker-5-2018-lingkungan-kerja', 'budaya-k3'],
  'img_alt' => 'Ilustrasi pengelolaan faktor psikososial dan stres di tempat kerja',
],

/* ============ PILAR 5 — LINGKUNGAN & LIMBAH B3 (30–36) ============ */

'lingkungan' => [
  'n' => 30, 'path' => 'lingkungan/',
  'title' => 'Lingkungan & Limbah B3: Panduan Pengelolaan untuk Industri',
  'h1'    => 'Lingkungan Hidup dan Limbah B3: Panduan Pengelolaan untuk Industri',
  'meta'  => 'Panduan lingkungan industri: limbah B3, limbah industri, pencemaran udara tempat kerja, air limbah, AMDAL/UKL-UPL, dan penilaian PROPER KLHK.',
  'hub' => 'lingkungan', 'type' => 'hub',
  'prev' => 'psikososial-dan-stres-kerja', 'next' => 'limbah-b3',
  'related' => ['limbah-b3', 'amdal-ukl-upl', 'kesehatan-kerja'],
  'img_alt' => 'Ilustrasi pengelolaan lingkungan hidup dan limbah pada kegiatan industri',
],

'limbah-b3' => [
  'n' => 31, 'path' => 'lingkungan/limbah-b3/',
  'title' => 'Limbah B3: Kriteria, Simbol, dan Kewajiban Pengelolaannya',
  'h1'    => 'Limbah B3: Kriteria, Simbol, dan Kewajiban Pengelolaannya',
  'meta'  => 'Limbah B3 adalah sisa usaha yang mengandung bahan berbahaya dan beracun. Kriteria menurut PP 22/2021, simbol-label, dan rantai kewajiban pengelolaannya.',
  'hub' => 'lingkungan', 'type' => 'article',
  'prev' => 'lingkungan', 'next' => 'pengelolaan-limbah-industri',
  'related' => ['pengelolaan-limbah-industri', 'amdal-ukl-upl', 'ruang-terbatas'],
  'img_alt' => 'Ilustrasi simbol dan penyimpanan limbah bahan berbahaya dan beracun',
],

'pengelolaan-limbah-industri' => [
  'n' => 32, 'path' => 'lingkungan/pengelolaan-limbah-industri/',
  'title' => 'Pengelolaan Limbah Industri: Jenis dan Hierarkinya',
  'h1'    => 'Pengelolaan Limbah Industri: Jenis Limbah dan Hierarki Penanganannya',
  'meta'  => 'Limbah industri terbagi padat, cair, gas, dan B3. Hierarki pengelolaan dari pengurangan di sumber hingga penimbunan akhir beserta dasar hukumnya.',
  'hub' => 'lingkungan', 'type' => 'article',
  'prev' => 'limbah-b3', 'next' => 'pencemaran-udara-tempat-kerja',
  'related' => ['limbah-b3', 'pengelolaan-air-limbah', 'proper-klhk'],
  'img_alt' => 'Ilustrasi hierarki pengelolaan limbah industri dari sumber sampai akhir',
],

'pencemaran-udara-tempat-kerja' => [
  'n' => 33, 'path' => 'lingkungan/pencemaran-udara-tempat-kerja/',
  'title' => 'Pencemaran Udara Tempat Kerja: Sumber dan Pengendaliannya',
  'h1'    => 'Pencemaran Udara di Tempat Kerja: Sumber, Dampak, dan Pengendaliannya',
  'meta'  => 'Debu, gas, uap, dan fume di tempat kerja dapat memicu penyakit paru akibat kerja. Sumber pencemar udara, NAB kimia, dan pengendalian ventilasi.',
  'hub' => 'lingkungan', 'type' => 'article',
  'prev' => 'pengelolaan-limbah-industri', 'next' => 'pengelolaan-air-limbah',
  'related' => ['nilai-ambang-batas', 'penyakit-akibat-kerja', 'alat-pelindung-diri'],
  'img_alt' => 'Ilustrasi pengendalian debu dan gas pencemar udara di area kerja',
],

'pengelolaan-air-limbah' => [
  'n' => 34, 'path' => 'lingkungan/pengelolaan-air-limbah/',
  'title' => 'Pengelolaan Air Limbah Industri: Baku Mutu dan IPAL',
  'h1'    => 'Pengelolaan Air Limbah Industri: Baku Mutu, IPAL, dan Perizinannya',
  'meta'  => 'Air limbah industri wajib diolah hingga memenuhi baku mutu sebelum dibuang. Tahapan pengolahan IPAL, baku mutu, dan persetujuan teknisnya.',
  'hub' => 'lingkungan', 'type' => 'article',
  'prev' => 'pencemaran-udara-tempat-kerja', 'next' => 'amdal-ukl-upl',
  'related' => ['pengelolaan-limbah-industri', 'amdal-ukl-upl', 'proper-klhk'],
  'img_alt' => 'Ilustrasi instalasi pengolahan air limbah industri',
],

'amdal-ukl-upl' => [
  'n' => 35, 'path' => 'lingkungan/amdal-ukl-upl/',
  'title' => 'AMDAL, UKL-UPL, dan SPPL: Perbedaan dan Kriterianya',
  'h1'    => 'AMDAL, UKL-UPL, dan SPPL: Perbedaan, Kriteria, dan Prosesnya',
  'meta'  => 'AMDAL, UKL-UPL, dan SPPL adalah tiga jenjang dokumen lingkungan menurut PP 22/2021. Kriteria usaha wajib, proses penyusunan, dan persetujuannya.',
  'hub' => 'lingkungan', 'type' => 'article',
  'prev' => 'pengelolaan-air-limbah', 'next' => 'proper-klhk',
  'related' => ['proper-klhk', 'limbah-b3', 'pengelolaan-air-limbah'],
  'img_alt' => 'Ilustrasi jenjang dokumen lingkungan hidup untuk kegiatan usaha',
],

'proper-klhk' => [
  'n' => 36, 'path' => 'lingkungan/proper-klhk/',
  'title' => 'PROPER KLHK: Peringkat Warna dan Kriteria Penilaian',
  'h1'    => 'PROPER KLHK: Peringkat Warna, Kriteria, dan Manfaatnya bagi Perusahaan',
  'meta'  => 'PROPER menilai ketaatan lingkungan perusahaan dengan peringkat emas, hijau, biru, merah, hitam. Kriteria penilaian dan manfaat mengikuti PROPER.',
  'hub' => 'lingkungan', 'type' => 'article',
  'prev' => 'amdal-ukl-upl', 'next' => 'studi-kasus',
  'related' => ['amdal-ukl-upl', 'pengelolaan-limbah-industri', 'pengelolaan-air-limbah'],
  'img_alt' => 'Ilustrasi lima peringkat warna penilaian kinerja lingkungan perusahaan',
],

/* ============ PILAR 6 — STUDI KASUS & INVESTIGASI (37–43) ============ */

'studi-kasus' => [
  'n' => 37, 'path' => 'studi-kasus/',
  'title' => 'Studi Kasus & Investigasi Kecelakaan Kerja',
  'h1'    => 'Studi Kasus dan Investigasi Kecelakaan Kerja',
  'meta'  => 'Belajar dari kecelakaan kerja: metode investigasi, analisis akar masalah, studi kasus kebakaran, jatuh dari ketinggian, ruang terbatas, dan pelaporannya.',
  'hub' => 'studi-kasus', 'type' => 'hub',
  'prev' => 'proper-klhk', 'next' => 'investigasi-kecelakaan-kerja',
  'related' => ['investigasi-kecelakaan-kerja', 'analisis-akar-masalah-rca', 'bahaya'],
  'img_alt' => 'Ilustrasi pembelajaran dari investigasi kecelakaan kerja',
],

'investigasi-kecelakaan-kerja' => [
  'n' => 38, 'path' => 'studi-kasus/investigasi-kecelakaan-kerja/',
  'title' => 'Investigasi Kecelakaan Kerja: Tahapan dan Prinsipnya',
  'h1'    => 'Investigasi Kecelakaan Kerja: Tahapan, Prinsip, dan Keluarannya',
  'meta'  => 'Investigasi kecelakaan kerja mencari penyebab, bukan kesalahan orang. Tahapan investigasi, pengumpulan bukti, dan penyusunan rekomendasi perbaikan.',
  'hub' => 'studi-kasus', 'type' => 'article',
  'prev' => 'studi-kasus', 'next' => 'analisis-akar-masalah-rca',
  'related' => ['analisis-akar-masalah-rca', 'pelaporan-kecelakaan-kerja', 'hierarki-pengendalian-risiko'],
  'img_alt' => 'Ilustrasi tim melakukan investigasi di lokasi kecelakaan kerja',
],

'analisis-akar-masalah-rca' => [
  'n' => 39, 'path' => 'studi-kasus/analisis-akar-masalah-rca/',
  'title' => 'Root Cause Analysis (RCA): Metode 5 Why dan Fishbone',
  'h1'    => 'Analisis Akar Masalah (RCA): Metode 5 Why, Fishbone, dan Penerapannya',
  'meta'  => 'RCA menelusuri penyebab dasar kecelakaan di balik penyebab langsung. Cara memakai 5 Why dan diagram fishbone beserta contoh penerapan kasus K3.',
  'hub' => 'studi-kasus', 'type' => 'article',
  'prev' => 'investigasi-kecelakaan-kerja', 'next' => 'studi-kasus-kebakaran-gudang',
  'related' => ['investigasi-kecelakaan-kerja', 'studi-kasus-kebakaran-gudang', 'budaya-k3'],
  'img_alt' => 'Ilustrasi diagram analisis akar masalah kecelakaan kerja',
],

'studi-kasus-kebakaran-gudang' => [
  'n' => 40, 'path' => 'studi-kasus/studi-kasus-kebakaran-gudang/',
  'title' => 'Studi Kasus: Kebakaran Gudang dan Pelajarannya',
  'h1'    => 'Studi Kasus Kebakaran Gudang: Kronologi Tipikal dan Pelajarannya',
  'meta'  => 'Anatomi kebakaran gudang: sumber penyalaan listrik, penyimpanan tidak aman, dan proteksi yang gagal. Analisis penyebab dan pelajaran pencegahannya.',
  'hub' => 'studi-kasus', 'type' => 'article',
  'prev' => 'analisis-akar-masalah-rca', 'next' => 'studi-kasus-jatuh-dari-ketinggian',
  'related' => ['kebakaran-di-tempat-kerja', 'k3-listrik', 'analisis-akar-masalah-rca'],
  'img_alt' => 'Ilustrasi analisis penyebab kebakaran gudang penyimpanan',
],

'studi-kasus-jatuh-dari-ketinggian' => [
  'n' => 41, 'path' => 'studi-kasus/studi-kasus-jatuh-dari-ketinggian/',
  'title' => 'Studi Kasus: Jatuh dari Ketinggian di Konstruksi',
  'h1'    => 'Studi Kasus Jatuh dari Ketinggian: Pola Kejadian di Konstruksi',
  'meta'  => 'Jatuh dari ketinggian adalah pembunuh utama di konstruksi. Pola kejadian tipikal, kegagalan pelindung jatuh, dan pelajaran pencegahan yang terbukti.',
  'hub' => 'studi-kasus', 'type' => 'article',
  'prev' => 'studi-kasus-kebakaran-gudang', 'next' => 'studi-kasus-ruang-terbatas',
  'related' => ['bekerja-di-ketinggian', 'alat-pelindung-diri', 'investigasi-kecelakaan-kerja'],
  'img_alt' => 'Ilustrasi analisis kecelakaan jatuh dari ketinggian pada proyek konstruksi',
],

'studi-kasus-ruang-terbatas' => [
  'n' => 42, 'path' => 'studi-kasus/studi-kasus-ruang-terbatas/',
  'title' => 'Studi Kasus: Fatality di Ruang Terbatas dan Penyelamat Ikut Menjadi Korban',
  'h1'    => 'Studi Kasus Ruang Terbatas: Ketika Penyelamat Ikut Menjadi Korban',
  'meta'  => 'Lebih dari separuh korban ruang terbatas adalah calon penolong. Anatomi kasus gas beracun di ruang terbatas dan pelajaran prosedur penyelamatannya.',
  'hub' => 'studi-kasus', 'type' => 'article',
  'prev' => 'studi-kasus-jatuh-dari-ketinggian', 'next' => 'pelaporan-kecelakaan-kerja',
  'related' => ['ruang-terbatas', 'nilai-ambang-batas', 'analisis-akar-masalah-rca'],
  'img_alt' => 'Ilustrasi bahaya penyelamatan tanpa prosedur di ruang terbatas',
],

'pelaporan-kecelakaan-kerja' => [
  'n' => 43, 'path' => 'studi-kasus/pelaporan-kecelakaan-kerja/',
  'title' => 'Pelaporan Kecelakaan Kerja: Kewajiban 2×24 Jam',
  'h1'    => 'Pelaporan Kecelakaan Kerja: Kewajiban, Tata Cara, dan Batas Waktunya',
  'meta'  => 'Permenaker 3/1998 mewajibkan pengurus melaporkan kecelakaan kerja dalam 2×24 jam. Jenis kejadian yang wajib dilapor dan tata cara pelaporannya.',
  'hub' => 'studi-kasus', 'type' => 'article',
  'prev' => 'studi-kasus-ruang-terbatas', 'next' => 'home',
  'related' => ['investigasi-kecelakaan-kerja', 'sanksi-pelanggaran-k3', 'smk3-pp-50-2012'],
  'img_alt' => 'Ilustrasi tata cara pelaporan kecelakaan kerja kepada instansi berwenang',
],

/* ============ UTILITY (44–49) — outside chain, mega-footer only ============ */

'tentang-redaksi' => [
  'n' => 44, 'path' => 'tentang-redaksi/',
  'title' => 'Tentang Redaksi PediaK3',
  'h1'    => 'Tentang Redaksi PediaK3',
  'meta'  => 'PediaK3 adalah pustaka pengetahuan K3/HSE non-komersial yang dikelola tim Wahana Totalita Konsultan, Yogyakarta. Misi, tim, dan cara kami bekerja.',
  'hub' => 'utility', 'type' => 'utility',
  'prev' => '', 'next' => '',
  'related' => ['standar-editorial', 'kontribusi', 'kontak'],
  'img_alt' => 'Ilustrasi tim redaksi pustaka pengetahuan K3',
],

'standar-editorial' => [
  'n' => 45, 'path' => 'standar-editorial/',
  'title' => 'Standar Editorial & Kebijakan Sitasi PediaK3',
  'h1'    => 'Standar Editorial dan Kebijakan Sitasi',
  'meta'  => 'Cara PediaK3 menjaga akurasi: rujukan ke sumber resmi, alur reviu, kebijakan koreksi, batasan konten komersial, dan kebijakan penggunaan AI.',
  'hub' => 'utility', 'type' => 'utility',
  'prev' => '', 'next' => '',
  'related' => ['tentang-redaksi', 'kontribusi', 'kebijakan-privasi'],
  'img_alt' => 'Ilustrasi proses reviu editorial artikel pengetahuan K3',
],

'kontribusi' => [
  'n' => 46, 'path' => 'kontribusi/',
  'title' => 'Kirim Artikel — Kontribusi Praktisi HSE',
  'h1'    => 'Kirim Artikel: Kontribusi untuk Praktisi HSE',
  'meta'  => 'Praktisi K3/HSE dapat mengirim artikel ke PediaK3. Semua naskah melewati reviu redaksi sebelum terbit. Ketentuan naskah dan formulir pengiriman.',
  'hub' => 'utility', 'type' => 'utility',
  'prev' => '', 'next' => '',
  'related' => ['standar-editorial', 'tentang-redaksi', 'kontak'],
  'img_alt' => 'Ilustrasi praktisi HSE mengirimkan naskah artikel untuk direviu',
],

'kontak' => [
  'n' => 47, 'path' => 'kontak/',
  'title' => 'Kontak Redaksi PediaK3',
  'h1'    => 'Kontak Redaksi',
  'meta'  => 'Hubungi redaksi PediaK3 untuk koreksi konten, izin kutip, atau pertanyaan editorial. Formulir kontak dan alamat email redaksi.',
  'hub' => 'utility', 'type' => 'utility',
  'prev' => '', 'next' => '',
  'related' => ['kontribusi', 'tentang-redaksi', 'standar-editorial'],
  'img_alt' => 'Ilustrasi saluran kontak redaksi pustaka pengetahuan K3',
],

'kebijakan-privasi' => [
  'n' => 48, 'path' => 'kebijakan-privasi/',
  'title' => 'Kebijakan Privasi PediaK3',
  'h1'    => 'Kebijakan Privasi',
  'meta'  => 'Kebijakan privasi PediaK3: data apa yang kami kumpulkan dari formulir kontak dan kontribusi, cara kami menggunakannya, dan hak Anda atas data itu.',
  'hub' => 'utility', 'type' => 'utility',
  'prev' => '', 'next' => '',
  'related' => ['syarat-ketentuan', 'kontak', 'tentang-redaksi'],
  'img_alt' => 'Ilustrasi perlindungan data pribadi pengunjung situs',
],

'syarat-ketentuan' => [
  'n' => 49, 'path' => 'syarat-ketentuan/',
  'title' => 'Syarat & Ketentuan Penggunaan PediaK3',
  'h1'    => 'Syarat dan Ketentuan Penggunaan',
  'meta'  => 'Ketentuan penggunaan konten PediaK3: sifat edukatif konten, batas tanggung jawab, aturan kutip dengan atribusi, dan ketentuan pengiriman naskah.',
  'hub' => 'utility', 'type' => 'utility',
  'prev' => '', 'next' => '',
  'related' => ['kebijakan-privasi', 'standar-editorial', 'kontak'],
  'img_alt' => 'Ilustrasi ketentuan penggunaan konten situs edukasi',
],

];
