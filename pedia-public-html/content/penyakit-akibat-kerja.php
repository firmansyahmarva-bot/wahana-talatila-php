<?php
$updated = '2026-07-18';
$faq = [
  ['q' => 'Apa dasar hukum penetapan PAK?', 'a' => 'Perpres No. 7 Tahun 2019 tentang Penyakit Akibat Kerja, yang memuat daftar jenis PAK yang berhak atas manfaat JKK, ditambah Permenaker terkait tata cara diagnosisnya.'],
  ['q' => 'Apakah PAK ditanggung BPJS Ketenagakerjaan?', 'a' => 'Ya. PAK yang ditetapkan sesuai ketentuan mendapat manfaat Jaminan Kecelakaan Kerja (JKK): perawatan, santunan upah, santunan cacat, hingga santunan kematian — bahkan bila gejala muncul setelah hubungan kerja berakhir (dengan batas waktu tertentu).'],
  ['q' => 'Contoh PAK yang paling umum di Indonesia?', 'a' => 'Gangguan pendengaran akibat bising (NIHL), penyakit paru akibat debu (pneumokoniosis), dermatitis kontak akibat kimia, dan gangguan otot-rangka akibat kerja (MSDs).'],
];
?>
<p><strong>Penyakit Akibat Kerja (PAK) adalah penyakit yang disebabkan oleh pekerjaan dan/atau lingkungan kerja.</strong> Dasar penetapannya Perpres No. 7 Tahun 2019, yang memuat daftar penyakit yang berhak atas manfaat Jaminan Kecelakaan Kerja.</p>

<h2 id="jenis">Kelompok PAK menurut Perpres 7/2019</h2>
<ul>
  <li><strong>Penyakit karena pajanan faktor</strong>: kimia (pelarut, logam berat, pestisida), fisika (bising → tuli, getaran → gangguan vaskular, radiasi), dan biologi (infeksi terkait pekerjaan).</li>
  <li><strong>Penyakit berdasarkan sistem organ</strong>: penyakit saluran pernapasan (pneumokoniosis, asma kerja), penyakit kulit (dermatitis kontak), gangguan otot-rangka, dan gangguan mental tertentu.</li>
  <li><strong>Kanker akibat kerja</strong>: akibat karsinogen seperti asbes dan benzena.</li>
  <li><strong>Penyakit spesifik lainnya</strong> yang dibuktikan hubungan kausalnya dengan pekerjaan.</li>
</ul>

<h2 id="diagnosis">Tujuh Langkah Diagnosis PAK</h2>
<p>Diagnosis okupasi yang baku menempuh tujuh langkah: (1) tegakkan diagnosis klinis; (2) identifikasi pajanan di pekerjaan; (3) tentukan hubungan pajanan dengan penyakit; (4) nilai besarnya pajanan — di sinilah data pengukuran <?= ilink('nilai-ambang-batas', 'NAB') ?> dan <?= ilink('permenaker-5-2018-lingkungan-kerja', 'lingkungan kerja') ?> menjadi bukti; (5) periksa faktor individu; (6) singkirkan faktor di luar pekerjaan; (7) tetapkan diagnosis PAK.</p>

<h2 id="pencegahan">Pencegahan</h2>
<p>PAK dicegah di tiga lini: <em>primer</em> — kendalikan pajanan mengikuti <?= ilink('hierarki-pengendalian-risiko', 'hierarki pengendalian') ?>; <em>sekunder</em> — deteksi dini lewat <?= ilink('pemeriksaan-kesehatan-tenaga-kerja', 'pemeriksaan berkala dan khusus') ?>; <em>tersier</em> — tata laksana, kompensasi, dan penempatan kembali pekerja yang sakit.</p>

<h2 id="jaminan">Jaminan dan Pelaporan</h2>
<p>PAK yang ditetapkan mendapat manfaat JKK penuh. Kasus PAK juga wajib dicatat dan dilaporkan sebagaimana kecelakaan kerja — mekanismenya dibahas di <?= ilink('pelaporan-kecelakaan-kerja', 'entri pelaporan kecelakaan kerja') ?>. Bagi perusahaan, satu kasus PAK yang terkonfirmasi hampir selalu berarti ada pajanan berlebih yang sedang dialami pekerja lain — sinyal untuk mengaudit ulang pengendalian.</p>
