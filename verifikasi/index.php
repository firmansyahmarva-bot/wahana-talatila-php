<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/glossary-functions.php';

$s       = get_all_settings();
$certNum = sanitize(get_query_param('cert') ?: ($_GET['cert'] ?? ($_POST['cert_number'] ?? '')));
$result  = null;
$searched = false;

if ($certNum) {
    $searched = true;
    $result   = verify_certificate($certNum);
}

$metaTitle = 'Verifikasi Sertifikat K3 Online | Wahana Totalita';
$metaDesc  = 'Cek keaslian sertifikat K3, BNSP, Kemnaker RI dari Wahana Totalita secara online. Masukkan nomor sertifikat untuk verifikasi instan.';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($metaTitle) ?></title>
<meta name="description" content="<?= e($metaDesc) ?>">
<link rel="canonical" href="<?= SITE_URL ?>/verifikasi/">
<style><?php
$_core_css_file = __DIR__ . '/../assets/css/core.min.css';
if (is_file($_core_css_file)) {
    readfile($_core_css_file);
} else {
    readfile(__DIR__ . '/../assets/css/tokens.css');
    readfile(__DIR__ . '/../assets/css/core.css');
}
?></style>
<link rel="stylesheet" href="<?= asset_v('/assets/css/components.min.css') ?>" media="print" onload="this.media='all'">
<noscript><link rel="stylesheet" href="<?= asset_v('/assets/css/components.min.css') ?>"></noscript>
<?= theme_css_vars($s) ?>
<!-- Schema: WebPage -->
<script type="application/ld+json">{"@context":"https://schema.org","@type":"WebPage","name":"Verifikasi Sertifikat K3","url":"<?= SITE_URL ?>/verifikasi/","description":"<?= e($metaDesc) ?>"}</script>
<style>
.verif-hero{background:linear-gradient(135deg,var(--green),#1a5c3a);padding:70px 0;text-align:center;color:#fff}
.verif-hero h1{font-size:clamp(1.8rem,4vw,2.8rem);font-weight:800;margin:0 0 12px}
.verif-box{background:#fff;border-radius:16px;max-width:600px;margin:0 auto;padding:32px;box-shadow:0 8px 32px rgba(0,0,0,.2)}
.verif-box input{width:100%;box-sizing:border-box;padding:16px 20px;border:2px solid #ddd;border-radius:12px;font-size:1.1rem;font-family:monospace;text-transform:uppercase;text-align:center;letter-spacing:2px;margin-bottom:16px}
.verif-box input:focus{outline:none;border-color:var(--green);box-shadow:0 0 0 4px rgba(10,74,46,.1)}
.verif-box button{width:100%;background:var(--orange);color:#fff;border:none;padding:14px;border-radius:12px;font-size:1.1rem;font-weight:700;cursor:pointer}
.verif-content{max-width:680px;margin:0 auto;padding:48px 20px}
.result-valid{background:#f0fdf4;border:2px solid #059669;border-radius:16px;padding:32px;text-align:center}
.result-invalid{background:#fff1f2;border:2px solid #e11d48;border-radius:16px;padding:32px;text-align:center}
.result-icon{font-size:4rem;display:block;margin-bottom:16px}
.cert-details{background:#fff;border-radius:12px;border:1px solid #eee;padding:20px;margin-top:20px;text-align:left}
.cert-row{display:flex;justify-content:space-between;padding:10px 0;border-bottom:1px solid #f0f0f0;font-size:.9rem}
.cert-row:last-child{border-bottom:none}
.cert-row .label{color:#999}
.cert-row .value{font-weight:700;color:#1a1a1a}
.how-section{padding:48px 0;background:#f8f8f8}
.how-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:24px;margin-top:32px}
.how-card{background:#fff;border-radius:12px;border:1px solid #eee;padding:24px;text-align:center}
.how-card .icon{font-size:2.5rem;margin-bottom:12px}
.how-card h3{font-size:1rem;font-weight:700;margin:0 0 8px}
.how-card p{font-size:.85rem;color:#666;margin:0}
</style>
</head>
<body>
<?php include __DIR__ . '/../includes/navbar.php'; ?>

<section class="verif-hero">
  <div class="container">
    <h1>🔐 Verifikasi Sertifikat K3</h1>
    <p style="opacity:.85;margin-bottom:28px">Cek keaslian sertifikat K3 Anda secara online. Masukkan nomor sertifikat untuk hasil instan.</p>
    <div class="verif-box">
      <form method="GET" action="/verifikasi/">
        <input type="text" name="cert" value="<?= e($certNum) ?>" placeholder="CERT-2024-XXXXXX" autocomplete="off" autofocus>
        <button type="submit">🔍 Verifikasi Sekarang</button>
      </form>
    </div>
  </div>
</section>

<div class="verif-content">
  <?php if ($searched): ?>
    <?php if ($result && $result['is_valid']): ?>
    <div class="result-valid">
      <span class="result-icon">✅</span>
      <h2 style="color:#059669;margin:0 0 8px">Sertifikat VALID</h2>
      <p style="color:#555;margin:0">Sertifikat ini dikeluarkan oleh Wahana Totalita Konsultan dan masih berlaku</p>
      <div class="cert-details">
        <div class="cert-row"><span class="label">Nomor Sertifikat</span><span class="value" style="font-family:monospace"><?= e($result['cert_number']) ?></span></div>
        <div class="cert-row"><span class="label">Nama Pemegang</span><span class="value"><?= e($result['holder_name']) ?></span></div>
        <div class="cert-row"><span class="label">Pelatihan</span><span class="value"><?= e($result['training_name']) ?></span></div>
        <div class="cert-row"><span class="label">Tanggal Terbit</span><span class="value"><?= format_date($result['issued_date']) ?></span></div>
        <?php if ($result['expiry_date']): ?>
        <div class="cert-row"><span class="label">Berlaku Hingga</span><span class="value" style="color:<?= strtotime($result['expiry_date']) < time() ? '#ef4444' : '#059669' ?>"><?= format_date($result['expiry_date']) ?></span></div>
        <?php endif; ?>
        <?php if ($result['certification_body']): ?>
        <div class="cert-row"><span class="label">Lembaga Sertifikasi</span><span class="value"><?= e($result['certification_body']) ?></span></div>
        <?php endif; ?>
        <div class="cert-row"><span class="label">Jenis Sertifikasi</span><span class="value"><?= e($result['certification_type'] ?? 'Pelatihan K3') ?></span></div>
      </div>
      <div style="margin-top:20px;display:flex;gap:12px;justify-content:center;flex-wrap:wrap">
        <a href="<?= wa_url('Halo, saya ingin konfirmasi sertifikat no '.$certNum) ?>" style="display:inline-block;background:var(--green);color:#fff;padding:10px 20px;border-radius:8px;text-decoration:none;font-weight:600">💬 Konfirmasi via WA</a>
        <a href="/jadwal/" style="display:inline-block;background:var(--orange);color:#fff;padding:10px 20px;border-radius:8px;text-decoration:none;font-weight:600">📅 Lihat Jadwal Renewal</a>
      </div>
    </div>

    <?php else: ?>
    <div class="result-invalid">
      <span class="result-icon">❌</span>
      <h2 style="color:#e11d48;margin:0 0 8px">Sertifikat Tidak Ditemukan</h2>
      <p style="color:#555;margin:0 0 20px">Nomor <strong><?= e($certNum) ?></strong> tidak terdaftar dalam sistem kami atau sudah tidak berlaku.</p>
      <p style="font-size:.875rem;color:#999">Kemungkinan penyebab: nomor salah ketik, sertifikat dari lembaga lain, atau sertifikat sudah kedaluwarsa.</p>
      <a href="<?= wa_url('Halo, saya ingin verifikasi sertifikat nomor '.$certNum) ?>" style="display:inline-block;margin-top:16px;background:var(--green);color:#fff;padding:12px 24px;border-radius:8px;text-decoration:none;font-weight:600">💬 Hubungi Kami untuk Konfirmasi</a>
    </div>
    <?php endif; ?>

  <?php else: ?>
  <div style="text-align:center;color:#999;padding:20px 0 40px">
    <p>Masukkan nomor sertifikat di atas untuk memulai verifikasi</p>
  </div>
  <?php endif; ?>
</div>

<section class="how-section">
  <div class="container">
    <h2 style="text-align:center;font-size:1.6rem;font-weight:800;margin:0 0 8px">Cara Verifikasi Sertifikat</h2>
    <p style="text-align:center;color:#666">Proses verifikasi mudah, cepat, dan gratis</p>
    <div class="how-grid">
      <div class="how-card"><div class="icon">1️⃣</div><h3>Temukan Nomor Sertifikat</h3><p>Cek bagian belakang atau bawah sertifikat fisik Anda</p></div>
      <div class="how-card"><div class="icon">2️⃣</div><h3>Masukkan Nomor</h3><p>Ketik nomor di kolom pencarian di atas (format: CERT-XXXX-XXXXXX)</p></div>
      <div class="how-card"><div class="icon">3️⃣</div><h3>Hasil Instan</h3><p>Sistem langsung menampilkan status valid atau tidak valid</p></div>
    </div>
    <div style="margin-top:32px;text-align:center">
      <a href="/jadwal/" style="display:inline-block;background:var(--orange);color:#fff;padding:14px 32px;border-radius:12px;font-weight:700;text-decoration:none">📅 Daftar Pelatihan K3 Bersertifikat</a>
    </div>
  </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
<script src="<?= SITE_URL ?>/assets/js/main.js"></script>
</body></html>
