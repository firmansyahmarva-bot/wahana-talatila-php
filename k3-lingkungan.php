<?php
require_once __DIR__ . '/config.php';
$s = get_all_settings();
/**
 * k3-lingkungan.php
 * K3 Lingkungan & AMDAL hub page. Zero DB dependency, modeled on
 * smk3.php.
 *
 * Real training slugs verified via catalog2026/real_trainings.json
 * (Lingkungan category has many real products — no fabrication
 * needed for the main grid):
 * penyusun-amdal (Kemnaker RI, added earlier this session via
 *   fixes/new-trainings.sql — confirmed run per user's "4 sql run
 *   already" note, not present in the stale catalog2026 JSON snapshot)
 * pelatihan-pplb3-online (BNSP — confirmed getting real GSC clicks
 *   per CLAUDE.md GSC data)
 * pelatihan-oplb3-online (BNSP)
 * pelatihan-mplb3-online (BNSP)
 * pelatihan-pertek-limbah-b3-online (BNSP)
 * pelatihan-penanggung-jawab-operasional-pengolahan-air-limbah-popal-sertifikasi-bnsp (BNSP)
 * No real dedicated "Audit Lingkungan" or "Analisis Kualitas Udara"
 * product exists — those two use a WA-inquiry card per the
 * established gap-handling pattern (k3-ketinggian.php precedent).
 *
 * CORRECTION FLAGGED TO USER: the brief cited two different,
 * inconsistent criminal-penalty figures for "operating without AMDAL"
 * (15 tahun/Rp15M in Dasar Hukum, 10 tahun/Rp10M in FAQ #6). WebSearch
 * verification of UU 32/2009 found: Pasal 109 (operating without a
 * valid environmental permit specifically) = 1-3 tahun penjara,
 * denda Rp1-3 miliar. The 15 tahun/Rp15 miliar figure is real but
 * belongs to Pasal 98 ayat 3 — the law's most severe tier, for
 * intentional pollution causing death — not for simply lacking
 * AMDAL. Both the Dasar Hukum section and FAQ #6 below use the
 * correct, properly-attributed figures instead.
 */
$wa_number = '628122969435';
$wa_msg = rawurlencode('Halo, saya ingin konsultasi pelatihan K3 Lingkungan / AMDAL. Mohon info jadwal dan program yang tersedia.');
$wa_url = "https://wa.me/{$wa_number}?text={$wa_msg}";
$year = date('Y');

$dokumenLingkungan = [
    ['dok' => 'Analisis Mengenai Dampak Lingkungan', 'singkat' => 'AMDAL', 'kapan' => 'Usaha berdampak penting besar', 'otoritas' => 'KLHK / Dinas LH'],
    ['dok' => 'Upaya Pengelolaan & Pemantauan Lingkungan', 'singkat' => 'UKL-UPL', 'kapan' => 'Dampak tidak terlalu besar', 'otoritas' => 'KLHK / Dinas LH'],
    ['dok' => 'Surat Pernyataan Pengelolaan Lingkungan', 'singkat' => 'SPPL', 'kapan' => 'Dampak sangat kecil / usaha mikro', 'otoritas' => 'Dinas LH setempat'],
    ['dok' => 'Persetujuan Teknis', 'singkat' => 'Pertek', 'kapan' => 'Pembuangan emisi/air limbah', 'otoritas' => 'KLHK'],
];

$programInfo = [
    ['t' => 'AMDAL Penyusun', 'd' => 'Kompetensi menyusun dokumen KA, ANDAL, dan RKL-RPL sesuai PP 22/2021.', 'slug' => 'penyusun-amdal', 'cert' => 'Sertifikasi Kemnaker RI'],
    ['t' => 'Pengelolaan Limbah B3', 'd' => 'Kompetensi identifikasi, pengumpulan, dan pengelolaan limbah bahan berbahaya dan beracun.', 'slug' => 'pelatihan-pplb3-online', 'cert' => 'Sertifikasi BNSP'],
    ['t' => 'Audit Lingkungan', 'd' => 'Evaluasi kepatuhan dan kinerja pengelolaan lingkungan perusahaan secara berkala.', 'slug' => null, 'cert' => null],
    ['t' => 'Pengelolaan Air Limbah (IPAL)', 'd' => 'Kompetensi penanggung jawab operasional pengolahan air limbah (POPAL).', 'slug' => 'pelatihan-penanggung-jawab-operasional-pengolahan-air-limbah-popal-sertifikasi-bnsp', 'cert' => 'Sertifikasi BNSP'],
    ['t' => 'Analisis Kualitas Udara', 'd' => 'Pemantauan dan analisis emisi serta kualitas udara di lingkungan kerja dan sekitar fasilitas.', 'slug' => null, 'cert' => null],
];

$wajibIkut = [
    'HSE Officer di perusahaan manufaktur, pertambangan, minyak & gas',
    'Staf lingkungan hidup yang bertanggung jawab atas pelaporan KLHK',
    'Konsultan lingkungan yang menyusun dokumen AMDAL dan UKL-UPL',
    'Manajer fasilitas yang mengelola TPS limbah B3',
    'Instansi pemerintah daerah (Dinas LH) yang melakukan pengawasan lingkungan',
    'Perusahaan yang ingin memperoleh PROPER Biru atau lebih tinggi dari KLHK',
];

$properTable = [
    ['peringkat' => '5', 'warna' => 'Emas', 'arti' => 'Beyond compliance — inovasi lingkungan'],
    ['peringkat' => '4', 'warna' => 'Hijau', 'arti' => 'Di atas standar regulasi'],
    ['peringkat' => '3', 'warna' => 'Biru', 'arti' => 'Memenuhi semua regulasi'],
    ['peringkat' => '2', 'warna' => 'Merah', 'arti' => 'Tidak memenuhi sebagian regulasi'],
    ['peringkat' => '1', 'warna' => 'Hitam', 'arti' => 'Melanggar regulasi secara serius'],
];

$materiAmdal = [
    'Dasar hukum AMDAL (UU 32/2009, PP 22/2021)',
    'Metodologi identifikasi dampak penting',
    'Pelingkupan (scoping) dokumen AMDAL',
    'Penyusunan Kerangka Acuan (KA-ANDAL)',
    'Teknik prakiraan dan evaluasi dampak',
    'Penyusunan RKL-RPL (Rencana Pengelolaan dan Pemantauan Lingkungan)',
    'Presentasi dokumen di sidang Komisi AMDAL',
    'Studi kasus: industri manufaktur, pertambangan, dan properti',
];
$materiB3 = [
    'Klasifikasi limbah B3 (PP 101/2014)',
    'Identifikasi limbah B3 di tempat kerja',
    'Persyaratan TPS (Tempat Penyimpanan Sementara) limbah B3',
    'Manifes limbah B3 dan sistem pelaporan',
    'Penanganan tumpahan B3 (emergency response)',
    'Simbol dan label limbah B3',
];

$metode = [
    'Pelatihan tatap muka di Yogyakarta',
    'In-house training di perusahaan (minimum 10 peserta)',
    'Sertifikasi resmi dari KLHK / Kemnaker RI sesuai program yang diambil',
];

$skemas = [
    ['name' => 'Penyusun AMDAL Bersertifikat', 'cert' => 'Sertifikasi Kemnaker RI', 'slug' => 'penyusun-amdal'],
    ['name' => 'Pelatihan PPLB3 (Pengawas Pengelolaan Limbah B3)', 'cert' => 'Sertifikasi BNSP', 'slug' => 'pelatihan-pplb3-online'],
    ['name' => 'Pelatihan OPLB3 (Operator Pengelolaan Limbah B3)', 'cert' => 'Sertifikasi BNSP', 'slug' => 'pelatihan-oplb3-online'],
    ['name' => 'Pelatihan MPLB3 (Manajer Pengelolaan Limbah B3)', 'cert' => 'Sertifikasi BNSP', 'slug' => 'pelatihan-mplb3-online'],
    ['name' => 'Pelatihan PERTEK Limbah B3', 'cert' => 'Sertifikasi BNSP', 'slug' => 'pelatihan-pertek-limbah-b3-online'],
    ['name' => 'Pelatihan POPAL (Penanggung Jawab Operasional Pengolahan Air Limbah)', 'cert' => 'Sertifikasi BNSP', 'slug' => 'pelatihan-penanggung-jawab-operasional-pengolahan-air-limbah-popal-sertifikasi-bnsp'],
];

$terkait = [
    ['label' => 'Panduan Lengkap K3', 'url' => '/keselamatan-kerja/'],
    ['label' => 'SMK3 & ISO 45001', 'url' => '/smk3/'],
    ['label' => 'Pelatihan K3 Kimia', 'url' => '/k3-kimia/'],
    ['label' => 'Sertifikasi BNSP', 'url' => '/sertifikasi-bnsp/'],
];

$faqs = [
    ['q' => 'Apa beda AMDAL dan UKL-UPL?', 'a' => 'AMDAL wajib untuk usaha/kegiatan yang berdampak penting besar terhadap lingkungan — seperti tambang skala besar, pabrik kimia, pembangkit listrik, atau proyek properti berskala luas. UKL-UPL untuk usaha yang berdampak lebih kecil. Penentuan mana yang dibutuhkan mengacu pada daftar jenis usaha dalam Permen LHK No. 4/2021.'],
    ['q' => 'Apakah AMDAL bisa dibuat sendiri oleh perusahaan?', 'a' => 'Tidak sembarangan. AMDAL wajib disusun oleh tim yang memiliki kompetensi Penyusun AMDAL bersertifikat. Perusahaan bisa membentuk tim internal bersertifikat atau menyewa konsultan lingkungan bersertifikat. Wahana Totalita menyediakan pelatihan sertifikasi Penyusun AMDAL.'],
    ['q' => 'Apa itu limbah B3 dan contohnya?', 'a' => 'Limbah B3 (Bahan Berbahaya dan Beracun) adalah sisa proses produksi yang memiliki sifat mudah meledak, mudah terbakar, reaktif, beracun, menyebabkan infeksi, atau bersifat korosif. Contoh: oli bekas, baterai, lampu neon, sisa cat, pelarut kimia, dan limbah medis.'],
    ['q' => 'Berapa lama sertifikat Penyusun AMDAL berlaku?', 'a' => 'Sertifikat Kompetensi Penyusun AMDAL umumnya berlaku beberapa tahun dan dapat diperpanjang melalui pelatihan penyegaran — masa berlaku pasti sebaiknya dikonfirmasi saat pendaftaran karena dapat menyesuaikan ketentuan terbaru.'],
    ['q' => 'Apa itu PROPER dan apakah semua perusahaan dinilai?', 'a' => 'PROPER adalah penilaian kinerja lingkungan tahunan oleh KLHK. Tidak semua perusahaan wajib ikut — PROPER menyasar perusahaan skala menengah-besar yang memiliki izin lingkungan (AMDAL atau UKL-UPL). Peringkat PROPER mempengaruhi reputasi perusahaan dan akses ke tender pemerintah.'],
    ['q' => 'Apakah ada sanksi jika perusahaan tidak memiliki dokumen lingkungan?', 'a' => 'Ya. UU PPLH No. 32/2009 Pasal 109 mengatur bahwa beroperasi tanpa izin lingkungan yang sah dapat dikenai pidana penjara 1-3 tahun dan denda Rp1-3 miliar. Untuk pelanggaran yang menyebabkan pencemaran serius hingga menimbulkan korban jiwa, sanksi bisa jauh lebih berat — hingga 15 tahun penjara dan denda Rp15 miliar (Pasal 98 ayat 3). Selain itu, izin usaha dapat dicabut dan perusahaan diwajibkan memulihkan lingkungan yang rusak.'],
];
?>
<?php
$page_title = 'Pelatihan K3 Lingkungan & AMDAL — Sertifikasi Kemnaker RI & KLHK';
$meta_desc = 'Pelatihan K3 Lingkungan, AMDAL Penyusun, Pengelolaan B3, dan Audit Lingkungan bersertifikat resmi. Sesuai UU PPLH No. 32/2009 dan PP 22/2021. Yogyakarta & in-house. 0812-2969-435.';
require __DIR__ . '/includes/head.php';
?>
<script type="application/ld+json">
{"@context":"https://schema.org","@type":"BreadcrumbList","itemListElement":[
  {"@type":"ListItem","position":1,"name":"Beranda","item":"https://wahanatotalita.com/"},
  {"@type":"ListItem","position":2,"name":"Pelatihan","item":"https://wahanatotalita.com/pelatihan/"},
  {"@type":"ListItem","position":3,"name":"K3 Lingkungan","item":"https://wahanatotalita.com/k3-lingkungan/"}
]}
</script>
<script type="application/ld+json">
<?php
echo json_encode([
    '@context' => 'https://schema.org',
    '@type'    => 'FAQPage',
    'mainEntity' => array_map(fn($f) => [
        '@type' => 'Question', 'name' => $f['q'],
        'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']],
    ], $faqs),
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
?>
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "Wahana Totalita Konsultan",
  "url": "https://wahanatotalita.com",
  "telephone": "+628122969435",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Jl. Wonosari KM 8.5",
    "addressLocality": "Sleman",
    "addressRegion": "DIY",
    "addressCountry": "ID"
  }
}
</script>
<link rel="stylesheet" href="/assets/css/page/sector.css">
<style>
.compare-table{width:100%;border-collapse:collapse;background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 2px 12px rgba(0,0,0,.05);min-width:560px}
.two-col{display:grid;grid-template-columns:repeat(2,1fr);gap:14px}
@media(max-width:640px){.two-col{grid-template-columns:1fr}}
.info-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:14px}
@media(max-width:900px){.info-grid{grid-template-columns:1fr}}
.info-card{background:#fff;border:1.5px solid #e5e7eb;border-radius:12px;padding:16px 18px}
.info-card h3{font-size:14.5px;font-weight:700;color:#0A4A2E;margin-bottom:6px}
.info-card p{font-size:13px;color:#4b5563;margin-bottom:8px}
.info-card .no-slug{font-size:12px;color:#C6621C;font-weight:700}
.inquiry-card{background:#fff;border:2px dashed #0A4A2E;border-radius:14px;padding:20px;text-align:center;margin-top:14px}
.inquiry-card p{font-size:13.5px;color:#4b5563;margin-bottom:12px}
</style>
<style id="wt-hero-height-fix-2026-07">
/* wt-hero-height-fix-2026-07: this page's own .hero is a small custom hero, not the
   homepage full-screen slideshow hero — cancel the global 100vh /
   flex-centering from style.css so it doesn't leak in here. */
.hero{min-height:auto!important;display:block!important}
</style>
<?php require __DIR__ . '/includes/navbar.php'; ?>
<section class="hero">
  <div class="container inner">
    <div class="hero-badge">🌿 K3 Lingkungan</div>
    <h1>Pelatihan K3 Lingkungan dan AMDAL — Sertifikasi Resmi KLHK &amp; Kemnaker RI</h1>
    <p class="hero-sub">Panduan lengkap AMDAL, pengelolaan limbah B3, dan sistem penilaian lingkungan PROPER.</p>
    <div><a href="<?=$wa_url?>" class="btn-wa" target="_blank" rel="noopener">💬 Konsultasi Program K3 Lingkungan</a></div>
  </div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">Apa itu K3 Lingkungan?</h2>
  <p class="intro-text">K3 Lingkungan (Environment, Health &amp; Safety / EHS) adalah integrasi antara keselamatan kerja dan pengelolaan lingkungan hidup di tempat kerja. Perusahaan tidak hanya wajib melindungi karyawan dari bahaya kerja, tetapi juga wajib memastikan operasinya tidak merusak lingkungan sekitar — termasuk pengelolaan limbah B3, pengendalian emisi, dan perlindungan sumber air. Di Indonesia, kewajiban lingkungan diatur oleh Kementerian Lingkungan Hidup dan Kehutanan (KLHK), terpisah dari Kemnaker.</p>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">Dasar Hukum K3 Lingkungan</h2>
  <h3 class="sub-title">UU No. 32 Tahun 2009 tentang Perlindungan dan Pengelolaan Lingkungan Hidup (PPLH)</h3>
  <ul class="law-list">
    <li>Setiap usaha/kegiatan yang berdampak penting wajib memiliki AMDAL</li>
    <li>Beroperasi tanpa izin lingkungan yang sah (Pasal 109): pidana penjara 1-3 tahun dan denda Rp1-3 miliar</li>
    <li>Untuk pencemaran serius yang menimbulkan korban jiwa (Pasal 98 ayat 3): sanksi hingga 15 tahun penjara dan denda hingga Rp15 miliar</li>
    <li>Wajib memiliki dokumen lingkungan yang disetujui sebelum operasi dimulai</li>
  </ul>
  <h3 class="sub-title">PP No. 22 Tahun 2021 tentang Penyelenggaraan Perlindungan dan Pengelolaan Lingkungan Hidup</h3>
  <ul class="law-list">
    <li>Menggantikan PP 27/2012 — menyederhanakan perizinan lingkungan (AMDAL, UKL-UPL, SPPL)</li>
    <li>Mengintegrasikan persetujuan lingkungan ke dalam NIB (Nomor Induk Berusaha) via OSS</li>
  </ul>
  <h3 class="sub-title">PP No. 101 Tahun 2014 tentang Pengelolaan Limbah B3</h3>
  <ul class="law-list">
    <li>Wajib bagi semua penghasil, pengumpul, pengangkut, dan pengolah limbah B3</li>
    <li>Wajib memiliki izin TPS (Tempat Penyimpanan Sementara) limbah B3</li>
    <li>Pencatatan dan pelaporan limbah B3 wajib secara berkala</li>
  </ul>
</div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">Jenis Dokumen Lingkungan di Indonesia</h2>
  <div class="compare-table-wrap">
  <table class="compare-table">
    <thead><tr><th>Dokumen</th><th>Singkatan</th><th>Kapan Dibutuhkan</th><th>Otoritas</th></tr></thead>
    <tbody>
      <?php foreach ($dokumenLingkungan as $row): ?>
      <tr><td><?= htmlspecialchars($row['dok']) ?></td><td><?= htmlspecialchars($row['singkat']) ?></td><td><?= htmlspecialchars($row['kapan']) ?></td><td><?= htmlspecialchars($row['otoritas']) ?></td></tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  </div>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">Program Sertifikasi K3 Lingkungan</h2>
  <div class="info-grid">
    <?php foreach ($programInfo as $p): ?>
    <div class="info-card">
      <h3><?= htmlspecialchars($p['t']) ?></h3>
      <p><?= htmlspecialchars($p['d']) ?></p>
      <?php if ($p['slug']): ?>
      <a href="/pelatihan/<?= htmlspecialchars($p['slug']) ?>/" class="scheme-link"><?= htmlspecialchars($p['cert']) ?> &rarr;</a>
      <?php else: ?>
      <a href="<?=$wa_url?>" class="no-slug" target="_blank" rel="noopener">💬 Hubungi Kami</a>
      <?php endif; ?>
    </div>
    <?php endforeach; ?>
  </div>
</div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">Siapa yang Membutuhkan Pelatihan K3 Lingkungan?</h2>
  <ul class="plain-list">
    <?php foreach ($wajibIkut as $w): ?>
    <li><?= htmlspecialchars($w) ?></li>
    <?php endforeach; ?>
  </ul>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">PROPER — Sistem Penilaian Kinerja Lingkungan</h2>
  <p class="intro-text">PROPER (Program Penilaian Peringkat Kinerja Perusahaan dalam Pengelolaan Lingkungan Hidup) adalah sistem penilaian tahunan KLHK:</p>
  <div class="compare-table-wrap">
  <table class="compare-table">
    <thead><tr><th>Peringkat</th><th>Warna</th><th>Artinya</th></tr></thead>
    <tbody>
      <?php foreach ($properTable as $row): ?>
      <tr><td><?= htmlspecialchars($row['peringkat']) ?></td><td><?= htmlspecialchars($row['warna']) ?></td><td><?= htmlspecialchars($row['arti']) ?></td></tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  </div>
  <p class="intro-text" style="margin-top:12px">Perusahaan dengan PROPER Merah atau Hitam berpotensi diblokir dari tender pemerintah dan mendapat sorotan publik.</p>
</div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">Kurikulum — AMDAL Penyusun</h2>
  <ul class="plain-list">
    <?php foreach ($materiAmdal as $m): ?>
    <li><?= htmlspecialchars($m) ?></li>
    <?php endforeach; ?>
  </ul>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">Kurikulum — Pengelolaan Limbah B3</h2>
  <ul class="plain-list">
    <?php foreach ($materiB3 as $m): ?>
    <li><?= htmlspecialchars($m) ?></li>
    <?php endforeach; ?>
  </ul>
</div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">Metode Pelatihan</h2>
  <ul class="plain-list">
    <?php foreach ($metode as $m): ?>
    <li><?= htmlspecialchars($m) ?></li>
    <?php endforeach; ?>
  </ul>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">Program Pelatihan K3 Lingkungan Kami</h2>
  <div class="scheme-grid">
    <?php foreach ($skemas as $sk): ?>
    <div class="scheme-card">
      <span class="scheme-cert"><?= htmlspecialchars($sk['cert']) ?></span>
      <h3><a href="/pelatihan/<?= htmlspecialchars($sk['slug']) ?>/"><?= htmlspecialchars($sk['name']) ?></a></h3>
      <a href="/pelatihan/<?= htmlspecialchars($sk['slug']) ?>/" class="scheme-link">Lihat Program &rarr;</a>
    </div>
    <?php endforeach; ?>
  </div>
</div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">Program Terkait</h2>
  <div class="link-grid">
    <?php foreach ($terkait as $tk): ?>
    <div class="link-card"><a href="<?= htmlspecialchars($tk['url']) ?>"><?= htmlspecialchars($tk['label']) ?> &rarr;</a></div>
    <?php endforeach; ?>
  </div>
</div>
</section>

<section>
<div class="container-sm">
  <h2 class="section-title" style="text-align:center">FAQ</h2>
  <div class="faq-list" style="margin-top:20px">
    <?php foreach ($faqs as $f): ?>
    <div class="faq-item">
      <button class="faq-q" aria-expanded="false" onclick="toggleFaq(this)">
        <?= htmlspecialchars($f['q']) ?>
        <svg class="faq-arrow" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
      </button>
      <div class="faq-a"><p><?= htmlspecialchars($f['a']) ?></p></div>
    </div>
    <?php endforeach; ?>
  </div>
</div>
</section>

<section class="final-cta">
  <div class="container-sm">
    <h2>Daftar &amp; Konsultasi</h2>
    <p>Hubungi kami untuk konsultasi pelatihan K3 Lingkungan atau AMDAL sesuai kebutuhan perusahaan Anda.</p>
    <a href="<?=$wa_url?>" class="btn-wa" target="_blank" rel="noopener">💬 Konsultasi via WhatsApp</a>
  </div>
</section>

<?php
require_once __DIR__ . '/includes/hub-category-map.php';
$hub_article_cats = $HUB_CATEGORY_MAP['lingkungan']['article_cats'] ?? [];
include __DIR__ . '/includes/hub-artikel-terkait.php';
?>
<?php require __DIR__ . '/includes/footer.php'; ?>
<script>
function toggleFaq(btn) {
  var expanded = btn.getAttribute('aria-expanded') === 'true';
  btn.setAttribute('aria-expanded', !expanded);
  var answer = btn.nextElementSibling;
  answer.classList.toggle('open', !expanded);
}
</script>
</body>
</html>
