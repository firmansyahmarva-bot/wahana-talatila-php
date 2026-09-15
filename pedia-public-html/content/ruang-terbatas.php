<?php
$updated = '2026-07-18';
$faq = [
  ['q' => 'Apa kriteria ruang terbatas (confined space)?', 'a' => 'Ruang yang cukup besar untuk dimasuki pekerja, memiliki akses masuk-keluar terbatas, dan tidak dirancang untuk ditempati terus-menerus — misalnya tangki, silo, sumur, gorong-gorong, dan bejana.'],
  ['q' => 'Gas apa yang paling sering membunuh di ruang terbatas?', 'a' => 'Kekurangan oksigen (di bawah 19,5%), hidrogen sulfida (H2S), karbon monoksida (CO), dan metana. Semuanya tidak terlihat, dan beberapa tidak berbau pada konsentrasi mematikan.'],
  ['q' => 'Berapa kadar oksigen yang aman untuk masuk?', 'a' => 'Umumnya 19,5%–23,5%. Di bawah itu berisiko hipoksia; di atas itu memperbesar bahaya kebakaran.'],
];
?>
<p><strong>Ruang terbatas (confined space) adalah ruang yang cukup besar untuk dimasuki pekerja, aksesnya terbatas, dan tidak dirancang untuk dihuni terus-menerus — kombinasi yang membuat bahaya atmosfer di dalamnya mematikan dalam hitungan menit.</strong> Regulasi nasional terbarunya adalah Permenaker No. 11 Tahun 2023 tentang K3 pada Pekerjaan di Ruang Terbatas.</p>

<h2 id="bahaya">Bahaya Utama</h2>
<ul>
  <li><strong>Atmosfer berbahaya</strong>: kekurangan oksigen, gas beracun (H<sub>2</sub>S, CO), serta gas/uap mudah menyala.</li>
  <li><strong>Engulfment</strong>: tenggelam dalam material curah — biji-bijian, pasir, lumpur.</li>
  <li><strong>Konfigurasi ruang</strong>: dinding mengerucut atau lantai miring yang menjebak pekerja.</li>
  <li><strong>Bahaya lain</strong>: energi mesin yang tidak diisolasi, panas, kebisingan, dan banjir mendadak.</li>
</ul>

<h2 id="prosedur">Prosedur Masuk yang Aman</h2>
<ol>
  <li><strong>Identifikasi dan klasifikasi</strong> semua ruang terbatas di area kerja; pasang rambu larangan masuk.</li>
  <li><strong>Izin kerja (permit to entry)</strong> diterbitkan sebelum setiap entri — memuat hasil pengukuran gas, pengendalian, dan daftar personel.</li>
  <li><strong>Isolasi energi dan pembilasan</strong>: blanking pipa, lockout-tagout, ventilasi paksa.</li>
  <li><strong>Pengukuran gas</strong> oleh petugas kompeten — sebelum masuk dan berkala selama pekerjaan; urutan uji: oksigen, gas mudah menyala, lalu gas beracun.</li>
  <li><strong>Petugas jaga (attendant)</strong> tetap di luar, memantau terus dan memegang komunikasi.</li>
  <li><strong>Rencana penyelamatan</strong> dengan peralatan siap pakai — tripod, full body harness, SCBA.</li>
</ol>

<h2 id="peran">Peran dan Kompetensi</h2>
<p>Regulasi mensyaratkan personel kompeten: petugas yang masuk, petugas jaga, pengawas, petugas pengukur gas (deteksi gas), dan tim penyelamat. Semuanya wajib mendapat <?= ilink('induksi-dan-pelatihan-k3', 'pelatihan khusus') ?>, dan <?= ilink('alat-pelindung-diri', 'APD pernapasan') ?> dipilih dari hasil pengukuran — respirator penyaring tidak boleh dipakai pada atmosfer kurang oksigen; wajib SCBA atau airline.</p>

<h2 id="kesalahan-umum">Kesalahan yang Berulang</h2>
<p>Tiga kegagalan paling sering: masuk tanpa pengukuran gas ("kelihatannya aman"), ventilasi dianggap cukup padahal gas yang lebih berat dari udara mengendap di dasar, dan penyelamatan spontan tanpa alat oleh rekan kerja — pola yang membuat lebih dari separuh korban ruang terbatas justru para calon penolong, sebagaimana dibedah di <?= ilink('studi-kasus-ruang-terbatas', 'studi kasus ruang terbatas') ?>. Ketiganya dicegah oleh disiplin izin kerja, bagian dari pengendalian administratif dalam <?= ilink('hierarki-pengendalian-risiko', 'hierarki pengendalian risiko') ?>.</p>
