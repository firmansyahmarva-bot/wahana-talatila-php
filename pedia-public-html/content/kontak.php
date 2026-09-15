<?php
$updated = '2026-07-18';
if (session_status() === PHP_SESSION_NONE) { session_start(); }
$formError = $_SESSION['form_error'] ?? null;
unset($_SESSION['form_error']);
?>
<p><strong>Halaman ini untuk urusan editorial: koreksi konten, izin kutip, pertanyaan tentang rujukan, atau masukan untuk pustaka.</strong> Untuk mengirim naskah artikel, gunakan <?= ilink('kontribusi', 'formulir kontribusi') ?>.</p>

<h2 id="email">Email Redaksi</h2>
<p><a href="mailto:<?= e($SITE['email']) ?>"><?= e($SITE['email']) ?></a> — dibalas pada jam kerja.</p>

<h2 id="form">Formulir Kontak</h2>
<?php if ($formError): ?>
<div class="note" role="alert"><p><strong><?= e($formError) ?></strong></p></div>
<?php endif; ?>
<form class="form" action="/kirim.php" method="post" id="form-kontak">
  <p style="position:absolute;left:-9999px" aria-hidden="true"><label>Website <input type="text" name="website" tabindex="-1" autocomplete="off"></label></p>
  <p><label for="k-nama">Nama *</label><br><input id="k-nama" type="text" name="nama" required maxlength="120"></p>
  <p><label for="k-email">Email *</label><br><input id="k-email" type="email" name="email" required maxlength="120"></p>
  <p><label for="k-topik">Topik</label><br>
    <select id="k-topik" name="topik">
      <option value="Koreksi konten">Koreksi konten</option>
      <option value="Izin kutip">Izin kutip / penggunaan konten</option>
      <option value="Pertanyaan editorial">Pertanyaan editorial</option>
      <option value="Lainnya">Lainnya</option>
    </select></p>
  <p><label for="k-pesan">Pesan *</label><br><textarea id="k-pesan" name="pesan" rows="8" required></textarea></p>
  <p><button class="btn btn-accent" type="submit">Kirim Pesan</button></p>
</form>

<h2 id="bukan-untuk">Yang Bukan Lewat Halaman Ini</h2>
<p>PediaK3 tidak melayani permintaan penawaran jasa atau pelatihan — situs ini non-komersial. Kebutuhan semacam itu silakan langsung ke lembaga penyedia jasa pilihan Anda.</p>
