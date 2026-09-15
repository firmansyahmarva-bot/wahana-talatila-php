<?php
$updated = '2026-07-18';
$faq = [
  ['q' => 'Mengapa kebakaran gudang sering baru diketahui saat sudah besar?', 'a' => 'Karena gudang minim orang, deteksi mengandalkan alat — dan pada banyak kasus detektor tidak ada, tidak berfungsi, atau alarmnya tidak tersambung ke pos jaga.'],
  ['q' => 'Apa penyebab kebakaran gudang yang paling umum?', 'a' => 'Kelistrikan substandar (instalasi tidak rapi, beban berlebih), diikuti pekerjaan panas tanpa izin, merokok, dan penyimpanan bahan yang saling tidak kompatibel.'],
];
?>
<p><strong>Kasus komposit berikut disusun dari pola kebakaran gudang yang berulang di berbagai industri — dianonimkan dan digeneralisasi untuk pembelajaran, bukan menggambarkan satu perusahaan tertentu.</strong></p>

<h2 id="kronologi">Kronologi Tipikal</h2>
<p>Malam hari, gudang penyimpanan barang jadi dengan rak tinggi hampir penuh. Sebuah sambungan kabel improvisasi — dipasang bertahun lalu untuk lampu tambahan, tidak pernah masuk gambar instalasi — memanas di balik tumpukan palet plastik. Percikan kecil membakar plastik pembungkus; api merambat vertikal lewat rak, mendatar lewat kardus. Tidak ada detektor asap di zona itu. Satpam mencium asap 20 menit kemudian; APAR terdekat terhalang palet dan sudah lewat masa periksa. Saat pemadam tiba, atap sudah terbakar. Kerugian: seisi gudang, dan operasional berhenti berbulan-bulan.</p>

<h2 id="analisis">Analisis Penyebab Berlapis</h2>
<ul>
  <li><strong>Penyebab langsung</strong>: panas dari sambungan listrik substandar bertemu material mudah terbakar yang menumpuk rapat.</li>
  <li><strong>Penyebab perantara</strong>: instalasi tidak resmi lolos bertahun-tahun tanpa inspeksi <?= ilink('k3-listrik', 'kelistrikan') ?>; penyimpanan melebihi kapasitas menutup jarak aman dan akses APAR; detektor tidak dipasang di zona perluasan gudang.</li>
  <li><strong>Akar masalah</strong>: tidak ada program inspeksi listrik dan proteksi kebakaran yang mengikuti perubahan tata letak; manajemen perubahan (management of change) tidak berjalan — gudang berubah fungsi dan bertambah isi tanpa evaluasi risiko kebakaran ulang.</li>
</ul>

<h2 id="pelajaran">Pelajaran Pencegahan</h2>
<ol>
  <li>Setiap perubahan tata letak/isi gudang = evaluasi ulang risiko kebakaran — jarak rak, zona penyimpanan, kapasitas <?= ilink('kebakaran-di-tempat-kerja', 'proteksi kebakaran') ?>.</li>
  <li>Instalasi listrik hanya oleh personel kompeten, terdokumentasi, dan diinspeksi termografi berkala; larangan keras instalasi improvisasi.</li>
  <li>Deteksi dini di semua zona + alarm tersambung ke pos berpenghuni 24 jam.</li>
  <li>APAR/hidran: akses steril 1 meter, inspeksi bulanan tercatat.</li>
  <li>Latihan darurat malam hari — kebakaran gudang tidak menunggu jam kerja.</li>
</ol>

<h2 id="cek-mandiri">Periksa di Tempat Anda Hari Ini</h2>
<p>Tiga pertanyaan cepat untuk tim <?= ilink('p2k3', 'P2K3') ?>: adakah sambungan listrik yang tidak ada di gambar instalasi? Kapan terakhir zona gudang dievaluasi proteksi kebakarannya setelah berubah isi? Bisakah semua APAR dijangkau dalam 10 detik? Gunakan kerangka <?= ilink('analisis-akar-masalah-rca', 'RCA') ?> yang sama untuk near-miss listrik sekecil apa pun.</p>
