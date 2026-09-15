<?php
$updated = '2026-07-18';
$faq = [
  ['q' => 'Apa definisi NAB?', 'a' => 'Standar faktor bahaya di tempat kerja sebagai kadar/intensitas rata-rata tertimbang waktu (time weighted average) yang dapat diterima tenaga kerja tanpa mengakibatkan penyakit atau gangguan kesehatan, dalam pekerjaan sehari-hari selama tidak melebihi 8 jam sehari atau 40 jam seminggu.'],
  ['q' => 'Apakah di bawah NAB berarti pasti aman?', 'a' => 'Tidak mutlak. NAB adalah rata-rata populasi — individu sensitif tetap bisa terdampak di bawah NAB. NAB adalah garis pengendalian minimum, bukan target; prinsipnya tetap serendah mungkin yang dapat diupayakan.'],
  ['q' => 'Bagaimana jika hasil pengukuran melebihi NAB?', 'a' => 'Wajib dilakukan pengendalian sesuai hierarki: rekayasa teknis, pembatasan waktu pajanan, dan APD — lalu pengukuran ulang untuk memastikan efektivitasnya.'],
];
?>
<p><strong>Nilai Ambang Batas (NAB) adalah standar kadar atau intensitas faktor bahaya yang dapat diterima tenaga kerja selama 8 jam sehari atau 40 jam seminggu tanpa mengakibatkan gangguan kesehatan.</strong> Angka-angka resminya dimuat dalam lampiran <?= ilink('permenaker-5-2018-lingkungan-kerja', 'Permenaker 5/2018') ?>.</p>

<h2 id="fungsi">Fungsi NAB</h2>
<p>NAB adalah penggaris higiene industri: pembanding hasil pengukuran untuk memutuskan perlu-tidaknya pengendalian, dasar menetapkan lama pajanan yang diizinkan, dan bukti objektif dalam penilaian dugaan <?= ilink('penyakit-akibat-kerja', 'penyakit akibat kerja') ?>.</p>

<h2 id="contoh">Contoh Angka NAB yang Paling Sering Dipakai</h2>
<ul>
  <li><strong>Kebisingan</strong>: 85 dBA untuk 8 jam/hari. Naik 3 dBA = waktu pajanan yang diperbolehkan terpangkas separuh (88 dBA → 4 jam; 91 dBA → 2 jam).</li>
  <li><strong>Iklim kerja panas</strong>: dinyatakan dalam ISBB (Indeks Suhu Basah dan Bola) dengan pengaturan siklus kerja-istirahat sesuai beban kerja.</li>
  <li><strong>Getaran</strong>: NAB getaran lengan-tangan dan seluruh tubuh dalam m/det².</li>
  <li><strong>Bahan kimia</strong>: ratusan zat dengan NAB masing-masing dalam ppm atau mg/m³ — beberapa dilengkapi PSD/STEL (batas pajanan singkat 15 menit) dan KTD (kadar tertinggi yang tidak boleh dilampaui sesaat pun).</li>
</ul>

<h2 id="pengukuran">Bagaimana NAB Diukur</h2>
<p>Pengukuran dilakukan personel/lembaga kompeten dengan alat terkalibrasi: sound level meter dan noise dosimeter untuk bising, heat stress monitor untuk iklim kerja, serta pompa sampling udara dan analisis laboratorium untuk kimia — dibandingkan sebagai rata-rata tertimbang waktu (TWA) terhadap NAB. Metodologi dan frekuensinya mengikuti <?= ilink('permenaker-5-2018-lingkungan-kerja', 'Permenaker 5/2018') ?>.</p>

<h2 id="tindak-lanjut">Tindak Lanjut Hasil</h2>
<p>Melebihi NAB berarti wajib mengendalikan mengikuti <?= ilink('hierarki-pengendalian-risiko', 'hierarki pengendalian') ?> — peredaman sumber bising, ventilasi untuk <?= ilink('pencemaran-udara-tempat-kerja', 'pencemar udara') ?>, rotasi pajanan, sampai <?= ilink('alat-pelindung-diri', 'APD') ?> yang sesuai. Pekerja yang terpajan di area melebihi NAB juga masuk sasaran <?= ilink('pemeriksaan-kesehatan-tenaga-kerja', 'pemeriksaan kesehatan khusus') ?> (misalnya audiometri berkala untuk area bising).</p>
