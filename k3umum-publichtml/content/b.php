<?php
$updated = '2026-07-20';
?>
<p>Ada dua lembaga resmi yang menerbitkan sertifikat Ahli K3 Umum di Indonesia: <strong>Kemnaker RI</strong> dan <strong>BNSP (Badan Nasional Sertifikasi Profesi)</strong>. Keduanya sah dan diakui — tapi dasar hukum, proses, dan implikasinya berbeda. Halaman ini membandingkan keduanya secara netral, tanpa merekomendasikan satu di atas yang lain, karena pilihan terbaik tergantung situasi Anda.</p>

<div class="compare-grid">
  <div class="compare-card is-recommended">
    <span class="compare-badge">Paling Umum</span>
    <h3>Jalur Kemnaker</h3>
    <ul>
      <li><span class="ci"><?= icon('check') ?></span> Dasar hukum: Permenaker No. PER-02/MEN/1992</li>
      <li><span class="ci"><?= icon('check') ?></span> Fokus pada kepatuhan regulasi K3</li>
      <li><span class="ci"><?= icon('check') ?></span> Pelatihan 12 hari kerja via LPK terakreditasi</li>
      <li><span class="ci"><?= icon('check') ?></span> Melekat pada individu <strong>dan</strong> instansi penunjuk</li>
      <li><span class="ci"><?= icon('check') ?></span> Perpanjangan setelah 3 tahun tanpa ujian ulang</li>
    </ul>
  </div>
  <div class="compare-card">
    <h3>Jalur BNSP</h3>
    <ul>
      <li><span class="ci"><?= icon('check') ?></span> Dasar hukum: Kepmenaker No. 38 Tahun 2019 (SKKNI)</li>
      <li><span class="ci"><?= icon('check') ?></span> Fokus pada pengakuan kompetensi individu</li>
      <li><span class="ci"><?= icon('check') ?></span> Uji kompetensi ±4 hari per jenjang (muda/madya/utama)</li>
      <li><span class="ci"><?= icon('check') ?></span> Melekat pada individu saja</li>
      <li><span class="ci"><?= icon('check') ?></span> Perpanjangan setelah 3 tahun dengan ujian ulang</li>
    </ul>
  </div>
</div>

<h2 id="perbandingan-detail">Perbandingan Baris per Baris</h2>
<div class="table-scroll">
  <table>
    <thead><tr><th>Aspek</th><th>Kemnaker</th><th>BNSP</th></tr></thead>
    <tbody>
      <tr><td>Dasar hukum</td><td>Permenaker No. PER-02/MEN/1992</td><td>Kepmenaker No. 38/2019 (SKKNI)</td></tr>
      <tr><td>Durasi pelatihan/uji</td><td>12 hari kerja</td><td>~4 hari per jenjang kompetensi</td></tr>
      <tr><td>Pendekatan</td><td>Kepatuhan regulasi (compliance)</td><td>Uji kompetensi (teori, praktik, wawancara)</td></tr>
      <tr><td>Masa berlaku</td><td>3 tahun</td><td>3 tahun</td></tr>
      <tr><td>Cara perpanjang</td><td>Perpanjang SKP/lisensi, tanpa ujian ulang</td><td>Wajib ujian ulang</td></tr>
      <tr><td>Melekat pada</td><td>Individu dan instansi penunjuk</td><td>Individu saja</td></tr>
    </tbody>
  </table>
</div>

<h2 id="kapan-pilih-mana">Kapan Sebaiknya Pilih yang Mana?</h2>
<div class="icon-grid">
  <div class="icon-grid-item"><span class="ig-icon"><?= icon('file-text') ?></span><div><strong>Butuh penunjukan resmi di perusahaan?</strong><p>Jalur Kemnaker lebih relevan karena SKP-nya melekat pada instansi penunjuk, sesuai kebutuhan Permenaker 02/1992.</p></div></div>
  <div class="icon-grid-item"><span class="ig-icon"><?= icon('award') ?></span><div><strong>Ingin proses lebih singkat?</strong><p>Jalur BNSP dengan durasi ±4 hari per jenjang bisa jadi pertimbangan, meski tetap harus ujian ulang tiap perpanjangan.</p></div></div>
</div>

<div class="callout callout-info">
  <span class="callout-icon"><?= icon('info') ?></span>
  <p>Tidak yakin mana yang paling cocok untuk situasi Anda (industri target, anggaran, waktu yang tersedia)? <a href="<?= e(wa_url('Halo, saya ingin konsultasi memilih sertifikasi Ahli K3 Umum Kemnaker atau BNSP.')) ?>">Tanya langsung via WhatsApp</a> — kami bantu petakan tanpa memaksakan satu pilihan.</p>
</div>

<?php $faq = [
  ['q' => 'Apakah sertifikat BNSP diakui Kemnaker?', 'a' => 'Ya, BNSP adalah lembaga sertifikasi kompetensi resmi milik pemerintah, dan sertifikatnya diakui — meski tidak secara otomatis menjadikan pemegangnya "Ahli K3" dalam pengertian penunjukan Permenaker 02/1992.'],
  ['q' => 'Bisakah punya sertifikat Kemnaker dan BNSP sekaligus?', 'a' => 'Bisa. Banyak profesional HSE mengambil keduanya secara bertahap untuk memperkuat kredensial di berbagai konteks kerja.'],
]; ?>
