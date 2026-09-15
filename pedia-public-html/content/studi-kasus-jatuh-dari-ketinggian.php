<?php
$updated = '2026-07-18';
$faq = [
  ['q' => 'Mengapa jatuh dari ketinggian dominan di konstruksi?', 'a' => 'Karena hampir semua fase konstruksi bekerja di ketinggian dengan kondisi berubah setiap hari — tepi terbuka, lubang, perancah berpindah — sementara tekanan jadwal mendorong jalan pintas.'],
  ['q' => 'Ketinggian berapa yang sudah bisa fatal?', 'a' => 'Jatuh dari 2 meter sudah bisa mematikan tergantung posisi jatuh dan permukaan. Anggapan "masih rendah, tidak perlu pengaman" adalah salah satu pembunuh paling konsisten.'],
];
?>
<p><strong>Kasus komposit berikut menggambarkan pola jatuh dari ketinggian yang paling sering berulang di proyek konstruksi Indonesia — dianonimkan dan digeneralisasi untuk pembelajaran.</strong></p>

<h2 id="kronologi">Kronologi Tipikal</h2>
<p>Pekerja finishing ditugaskan merapikan tepi lantai 4 sebuah proyek. Railing tepi di segmen itu dilepas dua hari sebelumnya untuk mengangkat material dan belum dipasang kembali. Ia memakai full body harness — tetapi tidak dikaitkan, karena tidak ada titik angkur di area itu dan "hanya sebentar". Saat menunduk menarik selang, ia kehilangan keseimbangan dan jatuh 12 meter. Izin kerja ketinggian tidak diterbitkan untuk tugas "kecil" itu; pengawas sedang di zona lain.</p>

<h2 id="analisis">Analisis Penyebab Berlapis</h2>
<ul>
  <li><strong>Penyebab langsung</strong>: bekerja di tepi terbuka tanpa proteksi kolektif dan tanpa harness terkait.</li>
  <li><strong>Penyebab perantara</strong>: railing dilepas tanpa prosedur pengembalian dan tanpa penandaan area; tidak tersedia angkur di zona kerja; tugas dianggap terlalu kecil untuk <?= ilink('bekerja-di-ketinggian', 'izin kerja ketinggian') ?>; pengawasan tidak menjangkau.</li>
  <li><strong>Akar masalah</strong>: sistem tidak mengelola proteksi kolektif sebagai barang kritis (siapa boleh melepas, siapa wajib mengembalikan, kapan); perencanaan angkur tidak masuk desain metode kerja; norma "sebentar saja tidak apa-apa" dibiarkan hidup — kegagalan <?= ilink('budaya-k3', 'budaya K3') ?> yang dipelihara bertahun-tahun.</li>
</ul>

<h2 id="pelajaran">Pelajaran Pencegahan</h2>
<ol>
  <li><strong>Proteksi kolektif dulu</strong>: railing, jaring, penutup lubang — melindungi semua orang tanpa syarat perilaku, sesuai <?= ilink('hierarki-pengendalian-risiko', 'hierarki pengendalian') ?>.</li>
  <li>Perlakukan pelepasan proteksi kolektif seperti izin kerja: dicatat, diberi batas waktu, ada penanggung jawab pengembalian, area ditandai.</li>
  <li>Rencanakan titik angkur/lifeline <em>sebelum</em> pekerjaan dimulai — harness tanpa angkur adalah hiasan.</li>
  <li>Tidak ada tugas "terlalu kecil" di tepi terbuka; aturan sederhana yang bisa dipegang semua orang.</li>
  <li>Rescue plan: korban tergantung di harness harus turun dalam hitungan menit.</li>
</ol>

<h2 id="cek-mandiri">Periksa di Tempat Anda Hari Ini</h2>
<p>Jalan keliling 15 menit: adakah tepi/lubang tanpa proteksi? Adakah railing yang "sementara" dilepas? Di mana pekerja ketinggian terdekat mengaitkan harnessnya? Temuan sekecil apa pun layak masuk <?= ilink('investigasi-kecelakaan-kerja', 'sistem pelaporan bahaya') ?> — sebelum menjadi laporan <?= ilink('pelaporan-kecelakaan-kerja', 'kecelakaan 2×24 jam') ?>.</p>
