<?php
$updated = '2026-07-18';
$faq = [
  ['q' => 'Di mana membaca teks resmi peraturan K3?', 'a' => 'Di JDIH Kemnaker (jdih.kemnaker.go.id) dan portal peraturan.go.id. PediaK3 merangkum dan menjelaskan — teks resmi selalu menjadi rujukan akhir.'],
  ['q' => 'Apakah UU 1/1970 masih berlaku?', 'a' => 'Masih. UU No. 1 Tahun 1970 tetap menjadi induk hukum keselamatan kerja Indonesia dan menjadi dasar bagi puluhan peraturan pelaksana di bawahnya.'],
];
?>
<p><strong>Regulasi K3 Indonesia tersusun berlapis: satu undang-undang induk, peraturan pemerintah, dan puluhan peraturan menteri yang mengatur bahaya spesifik.</strong> Topik ini memetakan lapisan-lapisan itu dan membahas peraturan yang paling sering dipakai praktisi.</p>

<h2 id="peta">Peta Singkat Hierarki Regulasi K3</h2>
<ul>
  <li><strong>Undang-undang</strong>: <?= ilink('uu-1-1970-keselamatan-kerja', 'UU 1/1970 Keselamatan Kerja') ?> (induk) dan UU 13/2003 Ketenagakerjaan (Pasal 86–87: hak pekerja atas K3 dan kewajiban SMK3).</li>
  <li><strong>Peraturan Pemerintah</strong>: <?= ilink('smk3-pp-50-2012', 'PP 50/2012') ?> tentang Penerapan SMK3.</li>
  <li><strong>Peraturan Menteri</strong>: mengatur bahaya dan objek spesifik — <?= ilink('permenaker-5-2018-lingkungan-kerja', 'lingkungan kerja') ?>, <?= ilink('permenaker-8-2020-alat-angkat', 'pesawat angkat-angkut') ?>, <?= ilink('permenaker-15-2008-p3k', 'P3K') ?>, APD, listrik, ketinggian, kebakaran, dan lainnya.</li>
</ul>

<h2 id="cara-membaca">Cara Kami Menyajikan Regulasi</h2>
<p>Setiap entri regulasi di pustaka ini <em>merangkum dan menjelaskan</em> — bukan menyalin teks pasal. Kami mencantumkan nomor resmi, pokok pengaturan, siapa yang terdampak, dan kaitannya dengan praktik, lalu menautkan ke sumber resmi di <?= ext_link('jdih_kemnaker', 'JDIH Kemnaker') ?> dan <?= ext_link('peraturan_go_id', 'peraturan.go.id') ?> untuk teks otentiknya. Penutup topik ini, <?= ilink('sanksi-pelanggaran-k3', 'entri sanksi') ?>, merangkum konsekuensi hukum bila kewajiban-kewajiban itu dilanggar.</p>
