<?php
$updated = '2026-07-18';
$faq = [
  ['q' => 'Apa beda debu, fume, gas, dan uap?', 'a' => 'Debu: partikel padat dari proses mekanis (gerinda, penghancuran). Fume: partikel sangat halus dari kondensasi logam menguap (pengelasan). Gas: zat berwujud gas pada suhu ruang (CO, H2S). Uap: fase gas dari cairan (pelarut). Jenisnya menentukan alat ukur dan APD-nya.'],
  ['q' => 'Penyakit apa yang paling sering timbul dari udara tempat kerja?', 'a' => 'Pneumokoniosis (paru akibat debu — silikosis, asbestosis), asma kerja, PPOK akibat kerja, dan keracunan gas akut seperti CO. Sebagian besar tak bisa disembuhkan, hanya dicegah.'],
];
?>
<p><strong>Pencemaran udara di tempat kerja — debu, fume, gas, dan uap — adalah jalur pajanan penyakit akibat kerja yang paling umum: dihirup setiap hari, tak terlihat, dan efeknya baru muncul bertahun-tahun kemudian.</strong> Pengendaliannya diatur lewat NAB kimia dalam <?= ilink('permenaker-5-2018-lingkungan-kerja', 'Permenaker 5/2018') ?>.</p>

<h2 id="sumber">Sumber Tipikal</h2>
<ul>
  <li><strong>Proses mekanis</strong>: gerinda, pemotongan, pengamplasan, penghancuran → debu (termasuk silika kristalin dari beton/batu).</li>
  <li><strong>Proses termal</strong>: pengelasan (fume logam), pengecoran, pembakaran tidak sempurna (CO).</li>
  <li><strong>Bahan kimia</strong>: pengecatan dan pelarut (uap organik), pembersihan, laboratorium.</li>
  <li><strong>Proses biologis/penguraian</strong>: H<sub>2</sub>S di IPAL, sumur, dan <?= ilink('ruang-terbatas', 'ruang terbatas') ?>.</li>
</ul>

<h2 id="dampak">Dampak Kesehatan</h2>
<p>Akut: iritasi, pusing, sesak, hingga keracunan fatal (CO, H<sub>2</sub>S). Kronis: pneumokoniosis, asma kerja, kerusakan organ oleh pelarut, dan kanker akibat karsinogen (asbes, benzena, silika) — sebagian besar tercatat dalam daftar <?= ilink('penyakit-akibat-kerja', 'penyakit akibat kerja') ?>.</p>

<h2 id="pengukuran">Pengukuran dan Standar</h2>
<p>Pajanan diukur dengan sampling udara zona pernapasan pekerja lalu dibandingkan terhadap <?= ilink('nilai-ambang-batas', 'NAB kimia') ?> (ppm atau mg/m³, rata-rata 8 jam) — termasuk batas singkat (STEL) dan kadar tertinggi (KTD) untuk zat berefek akut. Identifikasi bahan mengacu pada Lembar Data Keselamatan (LDK/SDS) setiap bahan kimia yang digunakan.</p>

<h2 id="pengendalian">Pengendalian — dari Sumber ke Pekerja</h2>
<ol>
  <li><strong>Eliminasi/substitusi</strong>: ganti bahan (cat berbasis air, pasir blasting non-silika).</li>
  <li><strong>Rekayasa</strong>: proses tertutup, ventilasi pengeluaran setempat (local exhaust) tepat di titik timbul, metode basah untuk debu, ventilasi umum sebagai pelengkap.</li>
  <li><strong>Administratif</strong>: rotasi untuk memangkas durasi pajanan, area terpisah untuk proses kotor, housekeeping vakum (bukan disapu kering).</li>
  <li><strong><?= ilink('alat-pelindung-diri', 'APD pernapasan') ?></strong>: dipilih sesuai kontaminan dan kadarnya — masker partikulat untuk debu, respirator kartrid untuk uap organik, dan udara suplai untuk kondisi kekurangan oksigen; fit test menentukan efektivitasnya.</li>
</ol>

<h2 id="pemantauan-kesehatan">Pemantauan Kesehatan</h2>
<p>Pekerja terpajan masuk program <?= ilink('pemeriksaan-kesehatan-tenaga-kerja', 'pemeriksaan kesehatan khusus') ?> — spirometri berkala, rontgen dada untuk debu fibrogenik, dan biomonitoring untuk pelarut/logam. Tren hasil kelompok adalah indikator paling jujur apakah pengendalian benar-benar bekerja.</p>
