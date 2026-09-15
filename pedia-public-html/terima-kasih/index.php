<?php
/* Hand-written thank-you page — noindex, outside the manifest. Never a managed stub. */
$dari = ($_GET['dari'] ?? '') === 'kontribusi' ? 'kontribusi' : 'kontak';
?><!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Terima Kasih | PediaK3</title>
<meta name="robots" content="noindex, nofollow">
<link rel="icon" type="image/svg+xml" href="/assets/img/favicon.svg">
<link rel="stylesheet" href="/assets/css/site.css">
</head>
<body>
<main id="konten">
  <article class="article">
    <div class="wrap wrap-narrow" style="padding-top:3rem;padding-bottom:3rem">
      <?php if ($dari === 'kontribusi'): ?>
      <h1>Terima Kasih — Naskah Anda Sudah Kami Terima</h1>
      <p>Naskah Anda masuk ke antrean <strong>reviu redaksi</strong>. Tidak ada naskah yang terbit otomatis — redaksi akan memeriksa akurasi, rujukan, dan kesesuaian gaya, lalu menghubungi Anda melalui email jika naskah disetujui terbit atau membutuhkan revisi.</p>
      <p>Proses reviu biasanya memakan waktu beberapa hari kerja.</p>
      <?php else: ?>
      <h1>Terima Kasih — Pesan Anda Sudah Terkirim</h1>
      <p>Redaksi akan membalas melalui email pada jam kerja.</p>
      <?php endif; ?>
      <p><a href="/">&larr; Kembali ke Beranda</a></p>
    </div>
  </article>
</main>
</body>
</html>
