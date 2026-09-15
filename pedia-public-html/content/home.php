<?php
$updated = '2026-07-18';
$faq = [
  ['q' => 'Apakah PediaK3 situs komersial?', 'a' => 'Bukan. PediaK3 adalah pustaka pengetahuan edukatif tanpa halaman harga, tanpa penawaran jasa, dan tanpa iklan. Situs ini dikelola tim redaksi Wahana Totalita Konsultan sebagai kontribusi pengetahuan untuk praktisi K3 Indonesia.'],
  ['q' => 'Bolehkah saya mengutip konten PediaK3?', 'a' => 'Boleh, dengan mencantumkan atribusi dan tautan ke halaman sumber. Ketentuan lengkap ada di halaman Syarat dan Ketentuan.'],
  ['q' => 'Bagaimana cara ikut menulis di PediaK3?', 'a' => 'Praktisi K3/HSE dapat mengirim naskah melalui halaman Kirim Artikel. Semua naskah melewati reviu redaksi sebelum terbit — tidak ada yang terbit otomatis.'],
];
?>
<p><strong>PediaK3 adalah pustaka pengetahuan terbuka tentang keselamatan dan kesehatan kerja (K3), kesehatan kerja, dan lingkungan untuk praktisi Indonesia.</strong> Seluruh entri ditulis dalam bahasa yang jelas, merujuk langsung ke peraturan perundang-undangan resmi, dan disusun saling bertaut sehingga Anda bisa menelusuri satu topik sampai tuntas — dari definisi, dasar hukum, sampai praktik di lapangan.</p>

<p>Situs ini bersifat <strong>edukatif dan non-komersial</strong>: tidak ada halaman harga, tidak ada penawaran jasa, dan tidak ada iklan. Konten dikelola oleh tim redaksi <?= e($SITE['org_name']) ?> dan terbuka untuk kontribusi praktisi HSE yang lolos reviu editorial.</p>

<h2 id="cara-pakai">Cara Menggunakan Pustaka Ini</h2>
<p>Konten tersusun dalam enam topik utama di bawah. Setiap topik dibuka oleh satu halaman ringkasan, lalu diikuti entri-entri yang membahas satu subjek secara utuh. Setiap entri regulasi menautkan ke sumber resminya di <?= ext_link('jdih_kemnaker', 'JDIH Kemnaker') ?> — kami merangkum dan menjelaskan, bukan menyalin teks peraturan.</p>

<h2 id="mulai">Mulai dari Mana?</h2>
<ul>
  <li>Baru mengenal K3? Mulai dari <?= ilink('apa-itu-k3') ?>.</li>
  <li>Mencari dasar hukum? Buka peta <?= ilink('regulasi', 'regulasi K3 Indonesia') ?>.</li>
  <li>Praktisi lapangan? Lihat <?= ilink('hierarki-pengendalian-risiko') ?> dan <?= ilink('studi-kasus', 'studi kasus kecelakaan kerja') ?>.</li>
</ul>
