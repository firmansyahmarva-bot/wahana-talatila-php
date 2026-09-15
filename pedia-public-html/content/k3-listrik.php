<?php
$updated = '2026-07-18';
$faq = [
  ['q' => 'Apa regulasi utama K3 listrik di Indonesia?', 'a' => 'Permenaker No. 12 Tahun 2015 tentang K3 Listrik di Tempat Kerja (diubah sebagian oleh Permenaker 33/2015), yang mengacu pada PUIL sebagai standar teknis instalasi.'],
  ['q' => 'Berapa tegangan yang sudah berbahaya bagi manusia?', 'a' => 'Arus, bukan tegangan, yang membunuh — arus bolak-balik puluhan miliampere melewati jantung sudah bisa fatal. Tegangan 50 V AC pada kondisi tertentu sudah dianggap berbahaya.'],
  ['q' => 'Siapa yang boleh mengerjakan instalasi listrik di tempat kerja?', 'a' => 'Personel yang kompeten dan berlisensi — teknisi K3 listrik atau ahli K3 bidang listrik sesuai lingkup pekerjaannya.'],
];
?>
<p><strong>K3 listrik adalah upaya perlindungan tenaga kerja dan aset dari bahaya kelistrikan — sengatan (electric shock), busur api (arc flash), dan kebakaran akibat listrik.</strong> Regulasi pokoknya Permenaker No. 12 Tahun 2015 tentang K3 Listrik di Tempat Kerja, dengan PUIL (Persyaratan Umum Instalasi Listrik) sebagai standar teknisnya.</p>

<h2 id="bahaya-listrik">Tiga Bahaya Kelistrikan</h2>
<ul>
  <li><strong>Sengatan listrik</strong> — arus melewati tubuh; efeknya dari kejut otot sampai fibrilasi jantung. Keparahan ditentukan besar arus, jalur lintasan, dan lamanya kontak.</li>
  <li><strong>Busur api (arc flash)</strong> — pelepasan energi mendadak bersuhu ribuan derajat; menyebabkan luka bakar berat dan ledakan tekanan meski tanpa menyentuh konduktor.</li>
  <li><strong>Kebakaran listrik</strong> — beban lebih, sambungan longgar, isolasi rusak, dan korsleting; penyebab kebakaran industri paling umum, dibahas juga di <?= ilink('kebakaran-di-tempat-kerja', 'entri kebakaran') ?>.</li>
</ul>

<h2 id="pokok-regulasi">Pokok Pengaturan Permenaker 12/2015</h2>
<ul>
  <li>Perencanaan, pemasangan, penggunaan, dan pemeliharaan instalasi listrik wajib sesuai standar (PUIL dan standar terkait).</li>
  <li>Pemeriksaan dan pengujian instalasi wajib dilakukan sebelum digunakan, setelah perubahan, dan secara berkala oleh personel berwenang.</li>
  <li>Kegiatan pada instalasi terpasang wajib dilakukan oleh teknisi/ahli K3 listrik yang kompeten dan berlisensi.</li>
</ul>

<h2 id="pengendalian">Pengendalian Praktis</h2>
<p>Mengikuti <?= ilink('hierarki-pengendalian-risiko', 'hierarki pengendalian') ?>:</p>
<ol>
  <li><strong>Rekayasa</strong>: proteksi arus sisa (RCD/ELCB), pembumian yang baik, isolasi ganda, penutup panel, dan pemisahan jarak aman jaringan bertegangan.</li>
  <li><strong>Administratif</strong>: prosedur lockout-tagout (LOTO) sebelum perbaikan, izin kerja listrik, uji tidak bertegangan sebelum menyentuh, rambu, dan inspeksi rutin kabel fleksibel serta alat portabel.</li>
  <li><strong><?= ilink('alat-pelindung-diri', 'APD') ?></strong>: sarung tangan isolasi sesuai kelas tegangan, sepatu dielektrik, dan pakaian tahan busur api untuk pekerjaan berisiko arc flash.</li>
</ol>

<h2 id="kebiasaan-fatal">Kebiasaan Fatal yang Sering Ditemui</h2>
<p>Perbaikan dalam keadaan bertegangan "karena cuma sebentar", steker bertumpuk pada satu titik, kabel terkelupas dililit isolasi seadanya, dan panel dibiarkan terbuka. Semua muncul berulang dalam <?= ilink('investigasi-kecelakaan-kerja', 'investigasi kecelakaan') ?> — dan semuanya murah dicegah dibanding akibatnya.</p>
