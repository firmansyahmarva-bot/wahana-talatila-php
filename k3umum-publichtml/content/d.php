<?php
$updated = '2026-07-20';
?>
<p>Prinsip dasar K3 (<?= ilink('a', 'UU No. 1/1970') ?>, <?= ilink('c1', 'SMK3') ?>) berlaku universal — tapi penerapannya di lapangan sangat berbeda antar sektor. Setiap industri punya regulasi tambahan, risiko dominan, dan sistem manajemen keselamatannya sendiri. Ini juga memengaruhi <?= ilink('b3', 'besaran gaji dan jenjang karir') ?> Ahli K3 Umum di masing-masing sektor.</p>

<h2 id="konstruksi">Konstruksi</h2>
<p>Sektor dengan risiko kecelakaan tertinggi karena sifat pekerjaan yang dinamis dan berpindah-pindah. Diatur melalui <strong>SMKK (Sistem Manajemen Keselamatan Konstruksi)</strong> sesuai PP No. 14 Tahun 2021 dan Permen PUPR No. 10 Tahun 2021. Risiko dominan: jatuh dari ketinggian, tertimpa material, kecelakaan alat berat.</p>

<h2 id="manufaktur">Manufaktur</h2>
<p>Risiko berpusat pada mesin produksi, bahan kimia, kebisingan, dan ergonomi kerja berulang. Umumnya tunduk pada kerangka <?= ilink('c1', 'SMK3') ?> standar (PP 50/2012) plus regulasi spesifik seperti K3 Listrik (Permenaker No. 12 Tahun 2015) untuk instalasi kelistrikan pabrik.</p>

<h2 id="migas-tambang">Migas dan Pertambangan</h2>
<div class="compare-grid">
  <div class="compare-card">
    <h3>Migas</h3>
    <ul>
      <li><span class="ci"><?= icon('check') ?></span> Diatur SMKM (Sistem Manajemen Keselamatan Migas)</li>
      <li><span class="ci"><?= icon('check') ?></span> Dasar: Kepmen ESDM No. 176.K/MG.01/MEM.M/2024</li>
      <li><span class="ci"><?= icon('check') ?></span> Risiko dominan: kebakaran, ledakan, gas beracun</li>
    </ul>
  </div>
  <div class="compare-card">
    <h3>Pertambangan</h3>
    <ul>
      <li><span class="ci"><?= icon('check') ?></span> Diatur SMKP (Sistem Manajemen Keselamatan Pertambangan)</li>
      <li><span class="ci"><?= icon('check') ?></span> Dasar: Permen ESDM No. 26 Tahun 2018</li>
      <li><span class="ci"><?= icon('check') ?></span> Risiko dominan: longsor, alat berat, ruang terbatas</li>
    </ul>
  </div>
</div>
<p>Kedua sektor ini umumnya mensyaratkan kompetensi tambahan di luar AK3U dasar — bukan pengganti, tapi lapisan sertifikasi lanjutan.</p>

<h2 id="perkantoran">Perkantoran</h2>
<p>Sering dianggap "bebas risiko," padahal tetap tunduk pada kerangka umum K3 (UU 1/1970, PP 50/2012) — dengan fokus berbeda: ergonomi kerja duduk lama, kualitas udara dalam ruangan, kesiapan tanggap darurat gedung bertingkat (evakuasi, jalur darurat), dan kesehatan mental/psikososial pekerja kantor.</p>

<h2 id="regulasi-lintas-sektor">Regulasi Lintas Sektor yang Relevan di Banyak Industri</h2>
<div class="table-scroll">
  <table>
    <thead><tr><th>Topik</th><th>Regulasi</th></tr></thead>
    <tbody>
      <tr><td>Bekerja di ketinggian</td><td>Permenaker No. 9 Tahun 2016</td></tr>
      <tr><td>K3 Listrik</td><td>Permenaker No. 12 Tahun 2015</td></tr>
      <tr><td>Penanggulangan kebakaran</td><td>Kepmenaker No. Kep.186/Men/1999</td></tr>
    </tbody>
  </table>
</div>

<?php $faq = [
  ['q' => 'Apakah Ahli K3 Umum bisa bekerja di semua sektor?', 'a' => 'Sertifikat AK3U berlaku lintas sektor sebagai dasar, tapi sektor berisiko tinggi seperti migas dan pertambangan umumnya mensyaratkan sertifikasi tambahan sesuai regulasi sektor masing-masing.'],
  ['q' => 'Sektor mana yang paling banyak membutuhkan Ahli K3 Umum?', 'a' => 'Konstruksi, manufaktur, migas, dan pertambangan secara historis menjadi sektor dengan permintaan HSE tertinggi karena tingkat risikonya, tapi kebutuhan ini terus meluas ke sektor lain.'],
]; ?>
