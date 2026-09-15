<?php
$updated = '2026-07-18';
if (session_status() === PHP_SESSION_NONE) { session_start(); }
$formError = $_SESSION['form_error'] ?? null;
unset($_SESSION['form_error']);
$faq = [
  ['q' => 'Apakah kontribusi dibayar?', 'a' => 'Tidak — PediaK3 non-komersial. Imbal balik kontributor adalah atribusi nama (dan kredensial) pada artikel yang terbit serta kontribusi nyata bagi komunitas K3 Indonesia.'],
  ['q' => 'Berapa lama proses reviu?', 'a' => 'Umumnya beberapa hari kerja. Redaksi menghubungi Anda via email bila naskah diterima, perlu revisi, atau belum dapat diterbitkan.'],
  ['q' => 'Bolehkah naskah yang pernah terbit di tempat lain?', 'a' => 'Tidak. Kami hanya menerima naskah orisinal yang belum pernah dipublikasikan, demi kualitas dan menghindari duplikasi konten.'],
];
?>
<p><strong>PediaK3 terbuka untuk kontribusi praktisi K3/HSE — Ahli K3, dokter okupasi, higienis industri, praktisi lingkungan, dan akademisi.</strong> Alurnya sederhana: <em>kirim naskah → reviu redaksi → disetujui admin → terbit</em>. Tidak ada naskah yang terbit otomatis.</p>

<h2 id="ketentuan">Ketentuan Naskah</h2>
<ul>
  <li><strong>Topik</strong>: K3, kesehatan kerja, atau lingkungan industri — sesuai enam topik utama situs ini.</li>
  <li><strong>Orisinal</strong>: karya sendiri, belum pernah terbit di mana pun, bukan hasil salin-tempel.</li>
  <li><strong>Berbasis rujukan</strong>: fakta hukum dan angka teknis mencantumkan sumbernya (peraturan resmi, standar, literatur) — lihat <?= ilink('standar-editorial', 'standar editorial kami') ?>.</li>
  <li><strong>Non-promosi</strong>: tanpa menjual produk/jasa, tanpa tautan komersial.</li>
  <li><strong>Panjang</strong>: idealnya 600–1.500 kata, bahasa Indonesia yang jelas.</li>
  <li><strong>Anonimisasi</strong>: studi kasus wajib menghilangkan identitas perusahaan dan korban.</li>
</ul>

<h2 id="alur">Alur Setelah Anda Mengirim</h2>
<ol>
  <li>Naskah tersimpan di antrean reviu dan redaksi menerima notifikasi.</li>
  <li>Redaksi memeriksa akurasi, orisinalitas, dan kesesuaian — status naskah Anda: <em>menunggu reviu</em>.</li>
  <li>Redaksi menghubungi Anda: diterima (dengan jadwal terbit), perlu revisi, atau ditolak beserta alasannya.</li>
  <li>Naskah yang disetujui disunting seperlunya lalu terbit dengan atribusi nama dan kredensial Anda.</li>
</ol>

<h2 id="form">Formulir Pengiriman Naskah</h2>
<?php if ($formError): ?>
<div class="note" role="alert"><p><strong><?= e($formError) ?></strong></p></div>
<?php endif; ?>
<form class="form" action="/kirim-artikel.php" method="post" id="form-kontribusi">
  <p style="position:absolute;left:-9999px" aria-hidden="true"><label>Website <input type="text" name="website" tabindex="-1" autocomplete="off"></label></p>
  <p><label for="f-nama">Nama lengkap *</label><br><input id="f-nama" type="text" name="nama" required maxlength="120"></p>
  <p><label for="f-email">Email aktif *</label><br><input id="f-email" type="email" name="email" required maxlength="120"></p>
  <p><label for="f-kredensial">Kredensial / profesi (mis. Ahli K3 Umum, dokter okupasi)</label><br><input id="f-kredensial" type="text" name="kredensial" maxlength="200"></p>
  <p><label for="f-judul">Judul naskah *</label><br><input id="f-judul" type="text" name="judul" required maxlength="150"></p>
  <p><label for="f-naskah">Isi naskah * (teks polos; minimal ±500 karakter)</label><br><textarea id="f-naskah" name="naskah" rows="14" required></textarea></p>
  <p><label for="f-referensi">Daftar referensi / sumber</label><br><textarea id="f-referensi" name="referensi" rows="4"></textarea></p>
  <p><button class="btn btn-accent" type="submit">Kirim Naskah untuk Direviu</button></p>
  <p><small>Dengan mengirim, Anda menyatakan naskah orisinal dan menyetujui <?= ilink('syarat-ketentuan', 'syarat & ketentuan') ?> serta <?= ilink('kebijakan-privasi', 'kebijakan privasi') ?>.</small></p>
</form>
