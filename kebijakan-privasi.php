<?php
// Kebijakan Privasi — standalone, zero-DB (same self-contained pattern as the
// other marketing pages). Indexable. Required for Google Ads transparency.
$year   = date('Y');
$wa      = '6281235036420';
$email   = 'info@wahanatotalita.com';
$gtm_id  = 'GTM-MMZHD3HN';
?><?php
require_once __DIR__ . '/config.php';
$s = get_all_settings();
?>
<?php
$page_title = 'Kebijakan Privasi';
$meta_desc = 'Kebijakan Privasi Wahana Totalita Konsultan — bagaimana kami mengumpulkan, menggunakan, dan melindungi data pribadi Anda sesuai UU PDP No. 27 Tahun 2022.';
require __DIR__ . '/includes/head.php';
?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<style>
  :root{--green:#0A4A2E;--ink:#1f2937;--muted:#5a6b62}
  *{box-sizing:border-box}
  body{margin:0;font-family:'Plus Jakarta Sans',system-ui,sans-serif;color:var(--ink);line-height:1.7;background:#fff}
  .pp-top{background:var(--green);padding:14px 20px}
  .pp-top a{color:#fff;text-decoration:none;font-weight:800;font-size:18px}
  .pp-wrap{max-width:820px;margin:0 auto;padding:40px 20px 60px}
  h1{color:var(--green);font-size:1.9rem;margin:0 0 6px}
  .pp-upd{color:var(--muted);font-size:.9rem;margin-bottom:28px}
  h2{color:var(--green);font-size:1.2rem;margin:30px 0 8px}
  ul{padding-left:20px}
  a{color:var(--green)}
  .pp-foot{border-top:1px solid #e5e7eb;margin-top:40px;padding-top:20px;font-size:.9rem;color:var(--muted)}
  .pp-foot a{margin-right:10px}
</style>
<div class="pp-top"><a href="/">← Wahana Totalita Konsultan</a></div>
<div class="pp-wrap">
  <h1>Kebijakan Privasi</h1>
  <div class="pp-upd">Terakhir diperbarui: <?=$year?></div>

  <p>Wahana Totalita Konsultan ("kami") menghormati dan melindungi privasi setiap pengunjung
  serta peserta pelatihan. Kebijakan Privasi ini menjelaskan bagaimana kami mengumpulkan,
  menggunakan, menyimpan, dan melindungi data pribadi Anda, sesuai dengan
  <strong>Undang-Undang No. 27 Tahun 2022 tentang Perlindungan Data Pribadi (UU PDP)</strong>.</p>

  <h2>1. Data yang Kami Kumpulkan</h2>
  <ul>
    <li>Data identitas: nama, nomor telepon/WhatsApp, alamat email, dan nama perusahaan.</li>
    <li>Data pendaftaran pelatihan yang Anda berikan secara sukarela melalui WhatsApp atau formulir.</li>
    <li>Data teknis: alamat IP, jenis perangkat, dan perilaku kunjungan melalui cookie dan
        layanan analitik (Google Analytics / Google Tag Manager).</li>
  </ul>

  <h2>2. Cara Kami Menggunakan Data</h2>
  <ul>
    <li>Memproses pendaftaran dan administrasi pelatihan serta sertifikasi.</li>
    <li>Menghubungi Anda terkait jadwal, biaya, konfirmasi, dan informasi program.</li>
    <li>Mengirimkan pengingat (mis. masa berlaku sertifikat) jika Anda adalah peserta kami.</li>
    <li>Meningkatkan kualitas layanan dan pengalaman pada situs kami.</li>
  </ul>

  <h2>3. Cookie dan Analitik</h2>
  <p>Situs kami menggunakan cookie dan layanan analitik untuk memahami penggunaan situs.
  Anda dapat menonaktifkan cookie melalui pengaturan browser Anda. Data analitik digunakan
  hanya untuk keperluan internal dan tidak dijual kepada pihak ketiga.</p>

  <h2>4. Perlindungan dan Penyimpanan Data</h2>
  <p>Kami menerapkan langkah keamanan yang wajar untuk melindungi data Anda dari akses
  yang tidak sah. Data hanya disimpan selama diperlukan untuk tujuan di atas atau sesuai
  ketentuan hukum yang berlaku.</p>

  <h2>5. Pembagian Data kepada Pihak Ketiga</h2>
  <p>Kami <strong>tidak menjual</strong> data pribadi Anda. Data hanya dapat dibagikan kepada
  lembaga sertifikasi resmi (mis. Kemnaker RI / BNSP) sejauh diperlukan untuk menerbitkan
  sertifikat Anda, atau jika diwajibkan oleh hukum.</p>

  <h2>6. Hak Anda</h2>
  <ul>
    <li>Mengakses, memperbarui, atau memperbaiki data pribadi Anda.</li>
    <li>Meminta penghapusan data pribadi Anda sesuai ketentuan UU PDP.</li>
    <li>Menarik persetujuan penggunaan data untuk komunikasi pemasaran kapan saja.</li>
  </ul>

  <h2>7. Hubungi Kami</h2>
  <p>Untuk pertanyaan atau permintaan terkait data pribadi Anda, hubungi:</p>
  <ul>
    <li>WhatsApp: <a href="https://wa.me/<?=$wa?>">0812-3503-6420</a></li>
    <li>Email: <a href="mailto:<?=$email?>"><?=$email?></a></li>
    <li>Alamat: Yogyakarta, Indonesia</li>
  </ul>

  <div class="pp-foot">
    <a href="/">Beranda</a>
    <a href="/#produk">Semua Program</a>
    <a href="/jadwal/">Jadwal</a>
    <a href="/artikel/">Artikel</a><br><br>
    © <?=$year?> Wahana Totalita Konsultan — Yogyakarta, Indonesia
  </div>
</div>
</body>
</html>
