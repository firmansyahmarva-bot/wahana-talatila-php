<?php
require_once __DIR__ . '/config.php';
$s = get_all_settings();
/**
 * k3-listrik.php
 * K3 Listrik hub page (Teknisi & Ahli K3 Listrik). Zero DB dependency,
 * modeled on k3-kimia.php.
 *
 * NOTE: corrected a factual error found while verifying regulation
 * details before writing: Permenaker 12/2015's voltage threshold is
 * 50V AC or 120V DC (confirmed via live sources), not 75V DC as
 * originally briefed.
 */
$wa_number = '628122969435';
$wa_msg = rawurlencode('Halo, saya ingin mendaftar pelatihan K3 Listrik (Teknisi/Ahli). Mohon info jadwal dan biaya?');
$wa_url = "https://wa.me/{$wa_number}?text={$wa_msg}";
$year = date('Y');

$compare = [
    ['aspek' => 'Level', 'teknisi' => 'Pelaksana teknis', 'ahli' => 'Ahli / Expert'],
    ['aspek' => 'Pekerjaan', 'teknisi' => 'Operasi & pemeliharaan listrik', 'ahli' => 'Pengawasan & manajemen K3 listrik'],
    ['aspek' => 'Kewenangan', 'teknisi' => 'Bekerja pada instalasi listrik', 'ahli' => 'Mengesahkan, mengawasi, mengaudit'],
    ['aspek' => 'Durasi pelatihan', 'teknisi' => '±40 jam (5-6 hari)', 'ahli' => '±60 jam (8-10 hari)'],
    ['aspek' => 'Pendidikan minimum', 'teknisi' => 'SMK Teknik Listrik / sederajat', 'ahli' => 'D3/S1 Teknik Elektro atau relevan'],
    ['aspek' => 'Sertifikasi', 'teknisi' => 'Kemnaker RI', 'ahli' => 'Kemnaker RI'],
];

$wajibIkut = [
    'Teknisi listrik dan electrician di pabrik dan gedung',
    'Supervisor maintenance listrik',
    'HSE Officer yang mengawasi area instalasi listrik',
    'Petugas PLN atau kontraktor listrik di proyek konstruksi',
    'Engineer di industri minyak & gas, pertambangan, pembangkit listrik',
    'Panel builder dan operator mesin produksi bertenaga listrik',
];

$syaratTeknisi = [
    'Ijazah minimal SMK Teknik Listrik, Teknik Elektro, atau bidang teknik relevan',
    'Bekerja di perusahaan dengan instalasi listrik',
    'Fotokopi KTP, pas foto 3×4 (4 lembar), fotokopi ijazah, surat keterangan sehat',
];
$syaratAhli = [
    'Ijazah minimal D3/S1 Teknik Elektro atau bidang relevan',
    'Pengalaman kerja di bidang kelistrikan minimal 2 tahun',
    'Persyaratan dokumen sama seperti Teknisi K3 Listrik',
];

$tujuan = [
    'Memahami regulasi K3 Listrik sesuai Permenaker 12/2015',
    'Mengidentifikasi bahaya listrik: sengatan, arc flash, kebakaran, ledakan',
    'Melakukan inspeksi instalasi listrik dan panel listrik',
    'Menerapkan prosedur Lockout/Tagout (LOTO) dengan benar',
    'Menyusun dan menganalisis laporan kecelakaan akibat listrik',
    'Memastikan instalasi listrik memenuhi PUIL (Persyaratan Umum Instalasi Listrik)',
];

$materiTeknisi = [
    'Regulasi K3 Listrik (Permenaker 12/2015, PUIL 2011)',
    'Dasar-dasar kelistrikan dan bahaya listrik',
    'Klasifikasi area berbahaya listrik (hazardous area)',
    'Sistem pembumian (grounding) dan perlindungan petir',
    'Alat Pelindung Diri (APD) untuk pekerjaan listrik',
    'Prosedur Lockout/Tagout (LOTO)',
    'Inspeksi panel listrik, kabel, dan instalasi',
    'Pertolongan pertama pada kecelakaan listrik (P3K)',
];
$materiAhli = [
    'PUIL 2011 secara menyeluruh (Persyaratan Umum Instalasi Listrik)',
    'Arc flash hazard analysis dan risk assessment',
    'Manajemen program K3 Listrik',
    'Audit dan pemeriksaan instalasi listrik',
    'Sistem perlindungan (circuit breaker, fuse, RCD/ELCB)',
    'Pembuatan laporan pemeriksaan berkala instalasi listrik',
];

$metode = [
    'Pelatihan tatap muka di Yogyakarta (termasuk praktik LOTO dan inspeksi panel)',
    'In-house training di perusahaan (minimum 10 peserta)',
    'Sertifikasi Kemnaker RI diterbitkan setelah lulus ujian teori dan praktik',
];

$skemas = [
    ['name' => 'Teknisi K3 Listrik', 'cert' => 'Sertifikasi Kemnaker RI', 'slug' => 'pelatihan-k3-teknisi-listrik-sertifikasi-kemnaker-ri'],
    ['name' => 'Ahli K3 Listrik', 'cert' => 'Sertifikasi Kemnaker RI', 'slug' => 'pelatihan-ahli-k3-listrik-sertifikasi-kemnaker-ri'],
];

$terkait = [
    ['label' => 'Pelatihan K3 Kimia', 'url' => '/k3-kimia/'],
    ['label' => 'Pelatihan K3 Ketinggian', 'url' => '/k3-ketinggian/'],
    ['label' => 'Panduan Lengkap K3', 'url' => '/keselamatan-kerja/'],
    ['label' => 'Sertifikasi BNSP', 'url' => '/sertifikasi-bnsp/'],
];

$faqs = [
    ['q' => 'Apakah semua perusahaan wajib memiliki Teknisi K3 Listrik?', 'a' => 'Sesuai Permenaker 12/2015, perusahaan yang memiliki instalasi listrik tegangan di atas 50V AC atau 120V DC wajib memiliki tenaga kerja bersertifikat K3 Listrik. Ini mencakup hampir semua perusahaan manufaktur, konstruksi, dan industri.'],
    ['q' => 'Apa itu LOTO dan mengapa penting?', 'a' => 'Lockout/Tagout (LOTO) adalah prosedur keselamatan untuk memastikan mesin atau instalasi listrik berbahaya dimatikan dan tidak dapat dinyalakan kembali selama pekerjaan pemeliharaan. LOTO mencegah kecelakaan akibat energi listrik yang tidak terduga.'],
    ['q' => 'Berapa lama sertifikat K3 Listrik berlaku?', 'a' => 'Sertifikat K3 Listrik berlaku 3 tahun dan dapat diperpanjang melalui pelatihan penyegaran (refreshing course).'],
    ['q' => 'Apakah latar belakang non-teknik bisa ikut K3 Listrik?', 'a' => 'Untuk Teknisi K3 Listrik, latar belakang teknik listrik diutamakan. Untuk HSE Officer dengan latar belakang non-teknik yang ingin memahami pengawasan K3 Listrik, kami sarankan konsultasi terlebih dahulu untuk menentukan program yang sesuai.'],
    ['q' => 'Apa itu arc flash dan mengapa berbahaya?', 'a' => 'Arc flash adalah ledakan energi listrik yang terjadi saat arus listrik mengalir melalui udara antara dua konduktor. Suhu arc flash dapat mencapai sekitar 20.000°C — lebih panas dari permukaan matahari — dan dapat menyebabkan luka bakar serius atau kematian dalam hitungan milidetik.'],
    ['q' => 'Apakah K3 Listrik sama dengan sertifikasi PUIL?', 'a' => 'Tidak sama. K3 Listrik (Permenaker 12/2015) adalah sertifikasi keselamatan kerja yang dikeluarkan Kemnaker RI. PUIL adalah standar teknis instalasi listrik (SNI). Keduanya saling melengkapi — Ahli K3 Listrik wajib memahami PUIL sebagai bagian dari kompetensinya.'],
];
?>
<?php
$page_title = 'Pelatihan K3 Listrik (Teknisi & Ahli K3 Listrik) — Sertifikasi Kemnaker RI';
$meta_desc = 'Pelatihan K3 Listrik resmi bersertifikat Kemnaker RI. Program Teknisi dan Ahli K3 Listrik sesuai Permenaker No. 12 Tahun 2015. Yogyakarta & in-house. Hubungi: 0812-2969-435.';
require __DIR__ . '/includes/head.php';
?>
<script type="application/ld+json">
{"@context":"https://schema.org","@type":"BreadcrumbList","itemListElement":[
  {"@type":"ListItem","position":1,"name":"Beranda","item":"https://wahanatotalita.com/"},
  {"@type":"ListItem","position":2,"name":"Pelatihan","item":"https://wahanatotalita.com/pelatihan/"},
  {"@type":"ListItem","position":3,"name":"K3 Listrik","item":"https://wahanatotalita.com/k3-listrik/"}
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
.compare-table{width:100%;border-collapse:collapse;background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 2px 12px rgba(0,0,0,.05)}
.compare-table th{background:#0A4A2E;color:#fff;padding:11px 12px;text-align:left;font-size:12.5px}
.compare-table td{padding:11px 12px;border-bottom:1px solid #f3f4f6;font-size:13px;color:#374151}
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
    <div class="hero-badge">⚡ K3 Listrik</div>
    <h1>Pelatihan K3 Listrik: Teknisi &amp; Ahli K3 Listrik Bersertifikat Kemnaker RI</h1>
    <p class="hero-sub">Sertifikasi resmi Kemnaker RI sesuai Permenaker No. 12 Tahun 2015 tentang Keselamatan dan Kesehatan Kerja Listrik di Tempat Kerja.</p>
    <div><a href="<?=$wa_url?>" class="btn-wa" target="_blank" rel="noopener">💬 Konsultasi Jadwal &amp; Biaya</a></div>
  </div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">Apa itu K3 Listrik?</h2>
  <p class="intro-text">K3 Listrik adalah penerapan keselamatan dan kesehatan kerja pada instalasi listrik dan pekerjaan yang berhubungan dengan listrik di tempat kerja. Bahaya listrik meliputi sengatan listrik (electric shock), kebakaran akibat korsleting, ledakan, dan arc flash. Listrik adalah penyebab kecelakaan kerja fatal ketiga terbesar di Indonesia setelah jatuh dari ketinggian dan tertimpa objek.</p>
  <p class="intro-text">Industri yang paling terdampak regulasi ini meliputi manufaktur, konstruksi, minyak &amp; gas, pertambangan, pembangkit listrik, gedung perkantoran, dan rumah sakit — di mana instalasi listrik bertegangan menjadi bagian tak terpisahkan dari operasional harian.</p>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">Dasar Hukum — Permenaker No. 12 Tahun 2015</h2>
  <p class="intro-text">Peraturan Menteri Ketenagakerjaan No. 12 Tahun 2015 tentang Keselamatan dan Kesehatan Kerja Listrik di Tempat Kerja mengatur kewajiban dasar sebagai berikut:</p>
  <ul class="law-list">
    <li>Berlaku untuk instalasi listrik tegangan di atas 50 volt AC atau 120 volt DC</li>
    <li>Perusahaan wajib memiliki Teknisi K3 Listrik untuk pekerjaan operasional dan pemeliharaan instalasi listrik</li>
    <li>Perusahaan dengan instalasi listrik skala besar wajib memiliki minimal 1 Ahli K3 Listrik</li>
    <li>Pekerjaan pemasangan, pemeliharaan, dan perbaikan instalasi listrik hanya boleh dilakukan oleh tenaga kerja bersertifikat</li>
    <li>Instalasi listrik wajib diperiksa dan diuji secara berkala oleh pemeriksa yang berkompeten</li>
    <li>Sanksi ketidakpatuhan: penghentian operasi instalasi listrik yang tidak memenuhi syarat</li>
  </ul>
</div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">Teknisi K3 Listrik vs Ahli K3 Listrik</h2>
  <table class="compare-table">
    <thead><tr><th>Aspek</th><th>Teknisi K3 Listrik</th><th>Ahli K3 Listrik</th></tr></thead>
    <tbody>
      <?php foreach ($compare as $row): ?>
      <tr><td><?= htmlspecialchars($row['aspek']) ?></td><td><?= htmlspecialchars($row['teknisi']) ?></td><td><?= htmlspecialchars($row['ahli']) ?></td></tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">Siapa yang Wajib Ikut Pelatihan K3 Listrik?</h2>
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
      <h3 class="sub-title">Teknisi K3 Listrik</h3>
      <ul class="plain-list">
        <?php foreach ($syaratTeknisi as $s): ?>
        <li><?= htmlspecialchars($s) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div>
      <h3 class="sub-title">Ahli K3 Listrik</h3>
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
  <h3 class="sub-title">Teknisi K3 Listrik (±40 jam)</h3>
  <ul class="plain-list">
    <?php foreach ($materiTeknisi as $m): ?>
    <li><?= htmlspecialchars($m) ?></li>
    <?php endforeach; ?>
  </ul>
  <h3 class="sub-title">Ahli K3 Listrik (±60 jam — ditambah)</h3>
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
  <h2 class="section-title">Program Pelatihan K3 Listrik Kami</h2>
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
    <p>Hubungi kami untuk info jadwal dan biaya pelatihan K3 Listrik Teknisi atau Ahli.</p>
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
