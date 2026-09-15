<?php
/**
 * THANK-YOU PAGE — shown after form submit. noindex, outside the 50-page
 * architecture on purpose (not in manifest, not in sitemap, blocked in robots).
 */
$SITE = require dirname(__DIR__) . '/config/site.php';
$wa = 'https://wa.me/' . $SITE['wa_number'] . '?text=' . rawurlencode('Halo, saya baru saja mengirim formulir konsultasi SMK3 dari website. Saya ingin melanjutkan diskusi.');
?><!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Pesan Terkirim — Terima Kasih | <?= htmlspecialchars($SITE['site_name']) ?></title>
<meta name="robots" content="noindex, nofollow">
<link rel="icon" type="image/svg+xml" href="/assets/img/favicon.svg">
<link rel="stylesheet" href="/assets/css/site.css">
</head>
<body>
<main id="konten">
  <section class="hero">
    <div class="wrap">
      <h1>Terima Kasih — Pesan Anda Sudah Kami Terima</h1>
      <p>Tim kami akan menghubungi Anda melalui email atau telepon pada jam kerja. Ingin jawaban lebih cepat? Lanjutkan langsung lewat WhatsApp — biasanya kami merespons dalam hitungan menit.</p>
      <div class="cta-actions">
        <a class="btn btn-wa" href="<?= htmlspecialchars($wa) ?>" rel="noopener">Lanjutkan via WhatsApp: <?= htmlspecialchars($SITE['wa_display']) ?></a>
        <a class="btn btn-outline" style="background:#fff" href="/">Kembali ke Beranda</a>
      </div>
    </div>
  </section>
  <section class="section">
    <div class="wrap wrap-narrow">
      <h2>Sambil Menunggu, Anda Mungkin Ingin Membaca:</h2>
      <ul>
        <li><a href="/regulasi/">PP No. 50 Tahun 2012 tentang SMK3: Panduan Lengkap</a></li>
        <li><a href="/biaya/">Biaya Sertifikasi SMK3: Rincian Lengkap Semua Komponen</a></li>
        <li><a href="/biaya/checklist-kesiapan-audit-smk3/">Checklist Kesiapan Audit SMK3</a></li>
      </ul>
    </div>
  </section>
</main>
</body>
</html>
