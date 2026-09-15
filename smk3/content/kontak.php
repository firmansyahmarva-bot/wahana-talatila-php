<?php
/** MONEY — Kontak & Konsultasi Gratis (with form → kirim.php). */
$updated = '2026-07-17';
if (session_status() === PHP_SESSION_NONE) { session_start(); }
$formError = $_SESSION['form_error'] ?? null;
unset($_SESSION['form_error']);
$faq = [
  ['q' => 'Seberapa cepat saya mendapat balasan?', 'a' => 'Pesan WhatsApp umumnya kami balas dalam hitungan menit sampai beberapa jam pada jam kerja (Senin–Jumat, 08.00–17.00 WIB). Formulir email dibalas paling lambat 1 hari kerja.'],
  ['q' => 'Apakah konsultasi awal berbayar?', 'a' => 'Tidak. Diskusi awal untuk memahami kebutuhan Anda sepenuhnya gratis dan tidak mengikat.'],
  ['q' => 'Informasi apa yang sebaiknya saya siapkan?', 'a' => 'Sektor usaha, perkiraan jumlah pekerja, jumlah lokasi kerja, kondisi sistem K3 saat ini (jika ada), dan target waktu Anda. Semakin lengkap, semakin tajam rekomendasi awal kami.'],
  ['q' => 'Apakah data yang saya kirim aman?', 'a' => 'Data Anda hanya digunakan untuk merespons permintaan konsultasi dan tidak dibagikan ke pihak lain.'],
];
?>
<div class="wrap wrap-narrow">
  <header class="article-head">
    <h1><?= e($page['h1']) ?></h1>
  </header>

  <div class="article-body">
    <p>Apa pun tahap Anda saat ini — baru mencari tahu kewajiban SMK3, sedang menyusun anggaran, atau sudah siap memulai — jalur tercepat mendapat jawaban adalah bertanya langsung. Pilih cara yang paling nyaman:</p>

    <h2 id="whatsapp">Cara Tercepat: WhatsApp</h2>
    <p>Klik tombol di bawah, ceritakan kebutuhan Anda, dan tim kami akan merespons cepat pada jam kerja (Senin–Jumat, 08.00–17.00 WIB).</p>
    <p><a class="btn btn-wa" href="<?= e(wa_url()) ?>" rel="noopener">Chat WhatsApp: <?= e($SITE['wa_display']) ?></a></p>

    <h2 id="form">Atau Kirim Formulir Konsultasi</h2>
    <p>Lebih suka tertulis? Isi formulir berikut — pesan Anda masuk langsung ke <?= e($SITE['email']) ?> dan dibalas maksimal 1 hari kerja.</p>

    <?php if ($formError): ?>
    <div class="note" role="alert"><strong>Perhatian:</strong> <?= e($formError) ?></div>
    <?php endif; ?>

    <form class="form" action="/kirim.php" method="post">
      <div>
        <label for="f-nama">Nama Anda *</label>
        <input id="f-nama" name="nama" type="text" required maxlength="120" autocomplete="name">
      </div>
      <div>
        <label for="f-perusahaan">Nama Perusahaan</label>
        <input id="f-perusahaan" name="perusahaan" type="text" maxlength="160" autocomplete="organization">
      </div>
      <div>
        <label for="f-email">Email *</label>
        <input id="f-email" name="email" type="email" required maxlength="160" autocomplete="email">
      </div>
      <div>
        <label for="f-telepon">No. Telepon / WhatsApp</label>
        <input id="f-telepon" name="telepon" type="tel" maxlength="30" autocomplete="tel">
      </div>
      <div>
        <label for="f-kebutuhan">Kebutuhan Utama</label>
        <select id="f-kebutuhan" name="kebutuhan">
          <option value="Konsultasi umum SMK3">Konsultasi umum SMK3</option>
          <option value="Pendampingan sertifikasi dari awal">Pendampingan sertifikasi dari awal</option>
          <option value="Audit internal / persiapan audit">Audit internal / persiapan audit</option>
          <option value="Perpanjangan (resertifikasi)">Perpanjangan (resertifikasi)</option>
          <option value="Pelatihan / training awareness">Pelatihan / training awareness</option>
          <option value="Lainnya">Lainnya</option>
        </select>
      </div>
      <div>
        <label for="f-pesan">Ceritakan kondisi &amp; kebutuhan Anda *</label>
        <textarea id="f-pesan" name="pesan" rows="6" required maxlength="5000" placeholder="Contoh: Kami perusahaan manufaktur ±250 karyawan di Bekasi, belum pernah sertifikasi SMK3, target ikut tender akhir tahun…"></textarea>
      </div>
      <div style="position:absolute;left:-9999px" aria-hidden="true">
        <label for="f-website">Website</label>
        <input id="f-website" name="website" type="text" tabindex="-1" autocomplete="off">
      </div>
      <p class="form-note">* wajib diisi. Data Anda hanya digunakan untuk merespons permintaan ini.</p>
      <button class="btn btn-primary" type="submit">Kirim Pesan</button>
    </form>

    <h2 id="info-kontak">Informasi Kontak</h2>
    <div class="table-scroll"><table>
      <tr><th>Kanal</th><th>Detail</th></tr>
      <tr><td>WhatsApp</td><td><a href="<?= e(wa_url()) ?>" rel="noopener"><?= e($SITE['wa_display']) ?></a></td></tr>
      <tr><td>Email</td><td><a href="mailto:<?= e($SITE['email']) ?>"><?= e($SITE['email']) ?></a></td></tr>
      <tr><td>Perusahaan</td><td><?= e($SITE['org_name']) ?>, <?= e($SITE['org_city']) ?>, Indonesia</td></tr>
      <tr><td>Jam kerja</td><td>Senin–Jumat, 08.00–17.00 WIB</td></tr>
    </table></div>

    <h2 id="sambil-menunggu">Sambil Menunggu Balasan</h2>
    <p>Jika Anda ingin memahami dulu gambaran besarnya, tiga bacaan ini tempat terbaik memulai: <?= ilink('regulasi', 'panduan lengkap PP 50/2012') ?>, <?= ilink('biaya', 'rincian biaya sertifikasi') ?>, dan <?= ilink('lama-proses-sertifikasi-smk3', 'berapa lama prosesnya') ?>.</p>
  </div>
</div>
