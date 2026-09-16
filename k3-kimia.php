<?php
require_once __DIR__ . '/config.php';
$s = get_all_settings();
/**
 * k3-kimia.php
 * K3 Kimia hub page (Petugas & Ahli K3 Kimia). Zero DB dependency,
 * modeled on keselamatan-kerja.php.
 */
$wa_number = '6287759151278';
$wa_msg = rawurlencode('Halo, saya ingin mendaftar pelatihan K3 Kimia (Petugas/Ahli). Boleh minta info jadwal dan biaya?');
$wa_url = "https://wa.me/{$wa_number}?text={$wa_msg}";
$year = date('Y');

$compare = [
    ['aspek' => 'Level', 'petugas' => 'Pelaksana / Officer', 'ahli' => 'Ahli / Expert'],
    ['aspek' => 'Durasi pelatihan', 'petugas' => '60 jam (±7 hari)', 'ahli' => '80 jam (±10 hari)'],
    ['aspek' => 'Pendidikan minimum', 'petugas' => 'SLTA/SMA + pengalaman industri kimia', 'ahli' => 'D3/S1 teknik atau kimia'],
    ['aspek' => 'Dibutuhkan oleh', 'petugas' => 'Semua perusahaan dengan BKB', 'ahli' => 'Perusahaan potensi bahaya besar'],
    ['aspek' => 'Dasar hukum', 'petugas' => 'Kepmenaker 187/1999', 'ahli' => 'Kepmenaker 187/1999'],
    ['aspek' => 'Sertifikasi', 'petugas' => 'Kemnaker RI', 'ahli' => 'Kemnaker RI'],
];

$wajibIkut = [
    'Petugas keselamatan di pabrik kimia, farmasi, pupuk, petrokimia',
    'Supervisor atau foreman di area penyimpanan BKB',
    'HSE Officer di perusahaan dengan kategori potensi bahaya besar/menengah',
    'Karyawan yang bertugas menangani, menyimpan, atau mengangkut BKB',
];

$syaratPetugas = [
    'Ijazah minimal SMA/SMK sederajat',
    'Bekerja di perusahaan yang menggunakan Bahan Kimia Berbahaya (BKB)',
    'Pas foto 3×4 (4 lembar), fotokopi KTP, fotokopi ijazah, surat keterangan sehat',
];
$syaratAhli = [
    'Ijazah minimal D3 teknik, kimia, atau bidang relevan',
    'Pengalaman kerja minimal 2 tahun di bidang K3 atau industri kimia',
    'Persyaratan dokumen sama seperti Petugas K3 Kimia',
];

$tujuan = [
    'Memahami regulasi Bahan Kimia Berbahaya (BKB) di Indonesia',
    'Mengidentifikasi bahaya kimia menggunakan sistem GHS/SDS',
    'Melakukan penilaian risiko kimia di tempat kerja',
    'Menyusun prosedur penanganan darurat kimia',
    'Mengelola Lembar Data Keselamatan (LDK/MSDS) sesuai standar',
    'Melaksanakan inspeksi dan pengawasan area BKB',
];

$materiPetugas = [
    'Regulasi K3 Kimia (Kepmenaker 187/1999, PP 74/2001)',
    'Pengenalan Bahan Kimia Berbahaya (klasifikasi GHS)',
    'Lembar Data Keselamatan (LDK/SDS/MSDS)',
    'Pelabelan dan penandaan BKB',
    'Teknik pengendalian paparan kimia (hierarki kontrol)',
    'APD untuk bahan kimia',
    'Penanganan tumpahan dan kedaruratan kimia',
    'Penyimpanan dan pengangkutan BKB yang aman',
];
$materiAhli = [
    'Risk assessment kuantitatif (HAZOP, FMEA, FTA)',
    'Manajemen Program Pencegahan Kecelakaan Besar (MPPKB)',
    'Audit K3 Kimia',
    'Laporan dan investigasi insiden kimia',
    'Persyaratan PROPER lingkungan hidup',
];

$metode = [
    'Pelatihan tatap muka (offline) di Yogyakarta',
    'Pelatihan online via Zoom (jadwal fleksibel)',
    'In-house training di perusahaan (minimum 10 peserta)',
];

$skemas = [
    ['name' => 'Petugas K3 Kimia', 'cert' => 'Sertifikasi Kemnaker RI', 'slug' => 'pelatihan-petugas-k3-kimia-sertifikasi-kemnaker-ri'],
    ['name' => 'Ahli K3 Kimia', 'cert' => 'Sertifikasi Kemnaker RI', 'slug' => 'pelatihan-ahli-k3-kimia-sertifikasi-kemnaker-ri'],
];

$terkait = [
    ['label' => 'Panduan Lengkap K3', 'url' => '/keselamatan-kerja/'],
    ['label' => 'Pelatihan HAZOPs (Sertifikasi BNSP)', 'url' => '/pelatihan/pelatihan-hazard-dan-operability-studies-hazops-sertifikasi-bnsp/'],
    ['label' => 'Pelatihan K3 Operator Forklift Kelas 2', 'url' => '/pelatihan/pelatihan-k3-operator-forklift-kelas-2-sertifikasi-kemnaker-ri/'],
    ['label' => 'Sertifikasi BNSP', 'url' => '/sertifikasi-bnsp/'],
];

$faqs = [
    ['q' => 'Apa itu Bahan Kimia Berbahaya (BKB) menurut Kepmenaker 187/1999?', 'a' => 'BKB adalah bahan kimia dalam bentuk tunggal atau campuran yang dapat membahayakan keselamatan dan kesehatan manusia serta lingkungan. Dibagi menjadi dua kategori: bahan beracun dan bahan reaktif.'],
    ['q' => 'Apakah perusahaan wajib punya Petugas K3 Kimia?', 'a' => 'Ya, jika menggunakan BKB dalam proses produksi. Potensi bahaya menengah = minimal 1 Petugas; potensi bahaya besar = minimal 1 Ahli + 2 Petugas (non-shift).'],
    ['q' => 'Berapa lama sertifikat K3 Kimia berlaku?', 'a' => '3 tahun dan dapat diperpanjang melalui penyegaran (refreshing).'],
    ['q' => 'Apakah Petugas K3 Kimia bisa diambil online?', 'a' => 'Ya, kami menyelenggarakan pelatihan online via Zoom dengan jadwal fleksibel. Ujian tetap diawasi secara virtual.'],
    ['q' => 'Apa perbedaan MSDS dan SDS?', 'a' => 'SDS (Safety Data Sheet) adalah istilah terbaru sesuai sistem GHS global. MSDS (Material Safety Data Sheet) adalah istilah lama. Keduanya merujuk dokumen yang sama, namun format SDS GHS kini menjadi standar internasional yang diadopsi Indonesia.'],
    ['q' => 'Industri apa yang paling butuh K3 Kimia?', 'a' => 'Industri kimia, farmasi, pupuk, petrokimia, pertambangan, cat, tekstil, dan semua industri yang menggunakan pelarut atau bahan reaktif dalam proses produksinya.'],
];
?>
<?php
$page_title = 'Pelatihan K3 Kimia (Petugas & Ahli K3 Kimia) — Sertifikasi Kemnaker RI';
$meta_desc = 'Pelatihan K3 Kimia resmi bersertifikat Kemnaker RI. Meliputi Petugas K3 Kimia dan Ahli K3 Kimia sesuai Kepmenaker No. 187/MEN/1999. Yogyakarta & online. Konsultasi: 0877-5915-1278.';
require __DIR__ . '/includes/head.php';
?>
<script type="application/ld+json">
{"@context":"https://schema.org","@type":"BreadcrumbList","itemListElement":[
  {"@type":"ListItem","position":1,"name":"Beranda","item":"https://wahanatotalita.com/"},
  {"@type":"ListItem","position":2,"name":"Pelatihan","item":"https://wahanatotalita.com/pelatihan/"},
  {"@type":"ListItem","position":3,"name":"K3 Kimia","item":"https://wahanatotalita.com/k3-kimia/"}
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
  "telephone": "+6287759151278",
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
.compare-table{width:100%;border-collapse:collapse;background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 2px 12px rgba(0,0,0,.05)}
.compare-table th{background:#0A4A2E;color:#fff;padding:11px 14px;text-align:left;font-size:13px}
.compare-table td{padding:11px 14px;border-bottom:1px solid #f3f4f6;font-size:13.5px;color:#374151}
.two-col{display:grid;grid-template-columns:1fr 1fr;gap:20px}
@media(max-width:640px){.two-col{grid-template-columns:1fr}}
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
    <div class="hero-badge">⚗️ K3 Kimia</div>
    <h1>Pelatihan K3 Kimia: Petugas &amp; Ahli K3 Kimia Bersertifikat Kemnaker RI</h1>
    <p class="hero-sub">Sertifikasi resmi Kemnaker RI sesuai Kepmenaker No. 187/MEN/1999 tentang Pengendalian Bahan Kimia Berbahaya di Tempat Kerja.</p>
    <div><a href="<?=$wa_url?>" class="btn-wa" target="_blank" rel="noopener">💬 Konsultasi Jadwal &amp; Biaya</a></div>
  </div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">Apa itu K3 Kimia?</h2>
  <p class="intro-text">K3 Kimia adalah cabang Keselamatan dan Kesehatan Kerja yang secara khusus menangani risiko Bahan Kimia Berbahaya (BKB) di tempat kerja — mulai dari penyimpanan, penanganan, produksi, hingga pengangkutannya. Tempat kerja yang menggunakan bahan kimia diregulasi secara terpisah dari K3 umum karena karakteristik bahayanya berbeda: reaksi kimia, toksisitas, mudah terbakar, dan dampak jangka panjang terhadap kesehatan yang tidak selalu tampak seketika. Cakupannya meliputi pabrik kimia, laboratorium, pertambangan, farmasi, dan industri manufaktur yang menggunakan bahan berbahaya dalam proses produksinya.</p>
  <p class="intro-text">Di Indonesia, kompetensi K3 Kimia dibagi menjadi dua jenjang: <strong>Petugas K3 Kimia</strong> (pelaksana lapangan) dan <strong>Ahli K3 Kimia</strong> (tenaga ahli dengan tanggung jawab pengawasan dan pengendalian program K3 kimia perusahaan).</p>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">Dasar Hukum — Kepmenaker No. 187/MEN/1999</h2>
  <p class="intro-text">Keputusan Menteri Tenaga Kerja No. 187/MEN/1999 tentang Pengendalian Bahan Kimia Berbahaya di Tempat Kerja adalah dasar hukum utama K3 Kimia di Indonesia. Regulasi ini mewajibkan setiap perusahaan yang menggunakan, menyimpan, menangani, memproduksi, atau mengangkut bahan kimia berbahaya untuk mengendalikan risikonya guna mencegah kecelakaan kerja dan penyakit akibat kerja. Kewajiban utama meliputi:</p>
  <ul class="law-list">
    <li>Perusahaan dengan Bahan Kimia Berbahaya (BKB) berpotensi bahaya besar wajib memiliki minimal 1 Ahli K3 Kimia dan 2 Petugas K3 Kimia (non-shift) atau 5 Petugas (shift)</li>
    <li>Perusahaan dengan potensi bahaya menengah wajib memiliki minimal 1 Petugas K3 Kimia</li>
    <li>Wajib memiliki Lembar Data Keselamatan (LDK/MSDS) untuk setiap BKB yang digunakan</li>
    <li>Wajib memasang label pada setiap kemasan atau wadah BKB</li>
    <li>Sanksi ketidakpatuhan: penutupan sementara atau permanen oleh pengawas ketenagakerjaan</li>
  </ul>
</div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">Petugas K3 Kimia vs Ahli K3 Kimia — Perbedaan dan Siapa yang Membutuhkan</h2>
  <table class="compare-table">
    <thead><tr><th>Aspek</th><th>Petugas K3 Kimia</th><th>Ahli K3 Kimia</th></tr></thead>
    <tbody>
      <?php foreach ($compare as $row): ?>
      <tr><td><?= htmlspecialchars($row['aspek']) ?></td><td><?= htmlspecialchars($row['petugas']) ?></td><td><?= htmlspecialchars($row['ahli']) ?></td></tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">Siapa yang Wajib Mengikuti Pelatihan K3 Kimia?</h2>
  <ul class="plain-list">
    <?php foreach ($wajibIkut as $w): ?>
    <li><?= htmlspecialchars($w) ?></li>
    <?php endforeach; ?>
  </ul>
</div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">Persyaratan Peserta</h2>
  <div class="two-col">
    <div>
      <h3 class="sub-title">Petugas K3 Kimia</h3>
      <ul class="plain-list">
        <?php foreach ($syaratPetugas as $s): ?>
        <li><?= htmlspecialchars($s) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div>
      <h3 class="sub-title">Ahli K3 Kimia</h3>
      <ul class="plain-list">
        <?php foreach ($syaratAhli as $s): ?>
        <li><?= htmlspecialchars($s) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">Tujuan Pembelajaran</h2>
  <ol class="num-list">
    <?php foreach ($tujuan as $t): ?>
    <li><?= htmlspecialchars($t) ?></li>
    <?php endforeach; ?>
  </ol>
</div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">Kurikulum &amp; Silabus</h2>
  <h3 class="sub-title">Petugas K3 Kimia (60 jam)</h3>
  <ul class="plain-list">
    <?php foreach ($materiPetugas as $m): ?>
    <li><?= htmlspecialchars($m) ?></li>
    <?php endforeach; ?>
  </ul>
  <h3 class="sub-title">Ahli K3 Kimia (80 jam — mencakup semua materi Petugas, ditambah)</h3>
  <ul class="plain-list">
    <?php foreach ($materiAhli as $m): ?>
    <li><?= htmlspecialchars($m) ?></li>
    <?php endforeach; ?>
  </ul>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">Metode Pelatihan</h2>
  <ul class="plain-list">
    <?php foreach ($metode as $m): ?>
    <li><?= htmlspecialchars($m) ?></li>
    <?php endforeach; ?>
  </ul>
</div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">Program Pelatihan K3 Kimia Kami</h2>
  <div class="scheme-grid">
    <?php foreach ($skemas as $sk): 
      $img = training_img_url('', 'k3', $sk['slug']);
      $wa_link = "https://wa.me/{$wa_number}?text=" . rawurlencode('Halo Wahana Totalita, saya ingin informasi pelatihan ' . $sk['name']);
    ?>
    <div class="scheme-card">
      <div class="scheme-card-media">
        <img src="<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($sk['name']) ?>" loading="lazy" width="360" height="170">
        <span class="scheme-cert"><?= htmlspecialchars($sk['cert']) ?></span>
      </div>
      <div class="scheme-card-body">
        <h3><a href="/pelatihan/<?= htmlspecialchars($sk['slug']) ?>/"><?= htmlspecialchars($sk['name']) ?></a></h3>
        <div class="scheme-actions">
          <a href="/pelatihan/<?= htmlspecialchars($sk['slug']) ?>/" class="scheme-link">Silabus &amp; Jadwal &rarr;</a>
          <a href="<?= $wa_link ?>" class="scheme-btn-wa" target="_blank" rel="noopener">Chat WA</a>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">Program K3 Terkait</h2>
  <div class="link-grid">
    <?php foreach ($terkait as $tk): ?>
    <div class="link-card"><a href="<?= htmlspecialchars($tk['url']) ?>"><?= htmlspecialchars($tk['label']) ?> &rarr;</a></div>
    <?php endforeach; ?>
  </div>
</div>
</section>

<section class="white">
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
    <p>Hubungi kami untuk info jadwal dan biaya pelatihan Petugas atau Ahli K3 Kimia.</p>
    <a href="<?=$wa_url?>" class="btn-wa" target="_blank" rel="noopener">💬 Konsultasi via WhatsApp</a>
  </div>
</section>

<?php
require_once __DIR__ . '/includes/hub-category-map.php';
$hub_article_cats = $HUB_CATEGORY_MAP['k3']['article_cats'] ?? [];
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
