<?php
require_once __DIR__ . '/config.php';
$s = get_all_settings();
/**
 * k3-pertambangan.php
 * K3 Pertambangan hub page (POP, POM, POU, Juru Ledak). Zero DB
 * dependency, modeled on k3-konstruksi.php / k3-listrik.php.
 *
 * Real training slugs verified via catalog2026/real_trainings.json:
 * pelatihan-pop-pertambangan-sertifikasi-bnsp-online (BNSP, Rp4.500.000)
 * pelatihan-pom-pertambangan-sertifikasi-bnsp-online (BNSP, Rp5.500.000)
 * pelatihan-pou-pertambangan-sertifikasi-bnsp-online (BNSP, Rp7.000.000)
 * No dedicated Juru Ledak product found in catalog — WA-inquiry card used
 * instead of a fabricated slug (same gap-handling precedent as
 * k3-ketinggian.php / k3-konstruksi.php).
 */
$wa_number = '6287759151278';
$wa_msg = rawurlencode('Halo, saya ingin mendaftar pelatihan K3 Pertambangan (POP/POM/POU). Mohon info jadwal dan biaya?');
$wa_url = "https://wa.me/{$wa_number}?text={$wa_msg}";
$year = date('Y');

$compare = [
    ['aspek' => 'Kepanjangan', 'pop' => 'Pengawas Operasional Pertama', 'pom' => 'Pengawas Operasional Madya', 'pou' => 'Pengawas Operasional Utama'],
    ['aspek' => 'Level', 'pop' => 'Supervisor lapangan', 'pom' => 'Superintendent / Senior', 'pou' => 'Manager / KTT'],
    ['aspek' => 'Tanggung jawab', 'pop' => 'Pengawasan shift harian', 'pom' => 'Pengawasan departemen', 'pou' => 'Pengawasan seluruh site'],
    ['aspek' => 'Pendidikan min.', 'pop' => 'SMA/SMK + 2 thn tambang', 'pom' => 'D3/S1 + 3 thn tambang', 'pou' => 'S1 + 5 thn tambang'],
    ['aspek' => 'Sertifikasi', 'pop' => 'BNSP', 'pom' => 'BNSP', 'pou' => 'BNSP'],
    ['aspek' => 'Berlaku', 'pop' => '3 tahun', 'pom' => '3 tahun', 'pou' => '3 tahun'],
];

$wajibIkut = [
    'Supervisor dan foreman di site tambang batubara, nikel, emas, atau mineral lainnya',
    'Superintendent yang memimpin departemen operasi tambang',
    'Manager operasional dan Kepala Teknik Tambang (KTT)',
    'HSE Officer di perusahaan kontraktor tambang',
    'Staf ESDM/pemerintah daerah yang mengawasi IUP',
];

$syaratPOP = [
    'Ijazah minimal SMA/SMK sederajat',
    'Pengalaman kerja di tambang minimal 2 tahun',
    'Fotokopi KTP, ijazah, surat keterangan kerja dari perusahaan tambang, pas foto 3×4 (4 lembar)',
];
$syaratPOM = [
    'Ijazah minimal D3/S1 bidang teknik atau pertambangan',
    'Pengalaman kerja di tambang minimal 3 tahun, atau lulus POP + 2 tahun',
];
$syaratPOU = [
    'Ijazah S1 bidang teknik atau pertambangan',
    'Pengalaman kerja di tambang minimal 5 tahun, atau lulus POM + 3 tahun',
];

$tujuan = [
    'Memahami regulasi K3 Pertambangan (Kepmen ESDM 1827/2018)',
    'Mengidentifikasi bahaya tambang: longsor, gas beracun, debu mineral, ledakan',
    'Melakukan pengawasan operasional harian sesuai standar ESDM',
    'Menyusun laporan K3 bulanan dan tahunan ke Inspektur Tambang',
    'Mengelola program keselamatan tambang secara sistematis',
    'Menginvestigasi dan melaporkan kecelakaan tambang',
];

$materiPOP = [
    'Regulasi K3 Pertambangan Indonesia (Kepmen ESDM 1827/2018, PP 55/2010)',
    'Identifikasi bahaya dan risiko di area tambang',
    'Pengawasan kerja harian dan safety briefing',
    'Keselamatan alat berat (excavator, dump truck, bulldozer)',
    'Keselamatan peledakan (pengenalan, bukan juru ledak)',
    'APD untuk tambang terbuka dan tambang bawah tanah',
    'Pelaporan kecelakaan dan near miss',
    'P3K dan tanggap darurat di area tambang',
];
$materiPOM = [
    'Manajemen program K3 departemen',
    'Pengelolaan kontraktor di site tambang',
    'Investigasi kecelakaan tambang (metode SCAT)',
    'Audit K3 internal tambang',
    'Pelaporan K3 kepada Inspektur Tambang ESDM',
    'Manajemen bahan peledak (administrasi)',
];
$materiPOU = [
    'SMK3 Pertambangan secara menyeluruh',
    'Peran dan tanggung jawab Kepala Teknik Tambang (KTT)',
    'Hubungan dengan Inspektur Tambang dan ESDM',
    'Manajemen krisis dan bencana tambang',
    'Aspek hukum pidana kecelakaan tambang',
];

$metode = [
    'Pelatihan tatap muka di Yogyakarta',
    'In-house training di site tambang (minimum 10 peserta) — instruktur berpengalaman industri tambang',
    'Sertifikasi BNSP setelah lulus ujian teori dan praktik',
];

$skemas = [
    ['name' => 'Pelatihan POP (Pengawas Operasional Pertama)', 'cert' => 'Sertifikasi BNSP', 'slug' => 'pelatihan-pop-pertambangan-sertifikasi-bnsp-online'],
    ['name' => 'Pelatihan POM (Pengawas Operasional Madya)', 'cert' => 'Sertifikasi BNSP', 'slug' => 'pelatihan-pom-pertambangan-sertifikasi-bnsp-online'],
    ['name' => 'Pelatihan POU (Pengawas Operasional Utama)', 'cert' => 'Sertifikasi BNSP', 'slug' => 'pelatihan-pou-pertambangan-sertifikasi-bnsp-online'],
];

$terkait = [
    ['label' => 'Pelatihan K3 Konstruksi', 'url' => '/k3-konstruksi/'],
    ['label' => 'Pelatihan K3 Ketinggian', 'url' => '/k3-ketinggian/'],
    ['label' => 'Panduan Lengkap K3', 'url' => '/keselamatan-kerja/'],
    ['label' => 'Sertifikasi BNSP', 'url' => '/sertifikasi-bnsp/'],
];

$faqs = [
    ['q' => 'Apakah POP wajib untuk semua karyawan tambang?', 'a' => 'Tidak semua. POP wajib dimiliki oleh karyawan yang menjalankan fungsi pengawasan — supervisor, foreman, dan kepala regu. Operator alat berat tidak wajib POP tetapi wajib memiliki sertifikasi operatornya sendiri.'],
    ['q' => 'Apakah sertifikat POP bisa digunakan di semua jenis tambang?', 'a' => 'Ya. Sertifikat POP/POM/POU yang diterbitkan BNSP berlaku untuk semua jenis pertambangan di Indonesia: batubara, nikel, emas, timah, bauksit, dan mineral lainnya, baik tambang terbuka maupun bawah tanah.'],
    ['q' => 'Berapa lama sertifikat POP berlaku dan bagaimana perpanjangannya?', 'a' => 'Sertifikat POP, POM, dan POU berlaku 3 tahun. Perpanjangan dilakukan melalui uji kompetensi ulang atau pelatihan penyegaran sebelum masa berlaku habis.'],
    ['q' => 'Apakah bisa langsung ambil POM tanpa POP?', 'a' => 'Bisa, jika memenuhi persyaratan langsung: ijazah D3/S1 teknik/pertambangan dan pengalaman kerja di tambang minimal 3 tahun. Namun bagi yang belum memiliki pengalaman cukup, disarankan mulai dari POP.'],
    ['q' => 'Apa itu Inspektur Tambang dan hubungannya dengan K3 Pertambangan?', 'a' => 'Inspektur Tambang adalah pegawai ESDM yang berwenang melakukan pemeriksaan, pengujian, dan pengawasan K3 di site tambang. Pemegang IUP wajib memberikan akses penuh kepada Inspektur Tambang dan melaporkan setiap kecelakaan tambang dalam 1×24 jam.'],
    ['q' => 'Apakah pelatihan POP bisa dilakukan in-house di site tambang?', 'a' => 'Ya. Kami melayani in-house training POP/POM/POU langsung di site tambang Anda dengan minimum 10 peserta. Instruktur kami berpengalaman di industri pertambangan dan memahami kondisi lapangan.'],
];
?>
<?php
$page_title = 'Pelatihan K3 Pertambangan (POP, POM, POU & Juru Ledak) — Sertifikasi BNSP';
$meta_desc = 'Pelatihan K3 Pertambangan bersertifikat BNSP. Program POP, POM, POU, dan Juru Ledak sesuai Kepmen ESDM 1827/2018. Wajib untuk industri tambang. Yogyakarta & in-house. 0877-5915-1278.';
require __DIR__ . '/includes/head.php';
?>
<script type="application/ld+json">
{"@context":"https://schema.org","@type":"BreadcrumbList","itemListElement":[
  {"@type":"ListItem","position":1,"name":"Beranda","item":"https://wahanatotalita.com/"},
  {"@type":"ListItem","position":2,"name":"Pelatihan","item":"https://wahanatotalita.com/pelatihan/"},
  {"@type":"ListItem","position":3,"name":"K3 Pertambangan","item":"https://wahanatotalita.com/k3-pertambangan/"}
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
.compare-table{width:100%;border-collapse:collapse;background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 2px 12px rgba(0,0,0,.05);min-width:640px}
.three-col{display:grid;grid-template-columns:repeat(3,1fr);gap:14px}
@media(max-width:900px){.three-col{grid-template-columns:1fr}}
.scheme-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1rem}
@media(max-width:900px){.scheme-grid{grid-template-columns:1fr}}
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
    <div class="hero-badge">⛏️ K3 Pertambangan</div>
    <h1>Pelatihan K3 Pertambangan: POP, POM, POU &amp; Juru Ledak Bersertifikat BNSP</h1>
    <p class="hero-sub">Sertifikasi resmi BNSP sesuai Kepmen ESDM No. 1827 K/30/MEM/2018.</p>
    <div><a href="<?=$wa_url?>" class="btn-wa" target="_blank" rel="noopener">💬 Konsultasi Jadwal &amp; Biaya</a></div>
  </div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">Apa itu K3 Pertambangan?</h2>
  <p class="intro-text">K3 Pertambangan adalah penerapan keselamatan dan kesehatan kerja khusus untuk industri pertambangan — meliputi tambang batubara, nikel, emas, timah, bauksit, dan mineral lainnya. Pertambangan adalah salah satu sektor paling berbahaya: risiko ledakan, longsor tambang, paparan debu mineral (pneumokoniosis), gas beracun, dan kecelakaan alat berat. Peraturan K3 Pertambangan di Indonesia lebih ketat dari sektor lain karena risiko bencana massal yang tinggi.</p>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">Dasar Hukum K3 Pertambangan</h2>
  <h3 class="sub-title">Kepmen ESDM No. 1827 K/30/MEM/2018 tentang Pedoman Pelaksanaan Kaidah Teknik Pertambangan yang Baik</h3>
  <ul class="law-list">
    <li>Wajib bagi seluruh Pemegang IUP, IUPK, dan Kontrak Karya</li>
    <li>Mewajibkan pengangkatan Pengawas Operasional bersertifikat (POP/POM/POU) di seluruh area tambang</li>
    <li>Kepala Teknik Tambang (KTT) bertanggung jawab atas seluruh K3 di site tambang</li>
    <li>Perusahaan wajib memiliki program K3 tahunan yang dilaporkan ke ESDM</li>
  </ul>
  <h3 class="sub-title">PP No. 55 Tahun 2010 tentang Pembinaan dan Pengawasan Penyelenggaraan Pengelolaan Usaha Pertambangan</h3>
  <ul class="law-list">
    <li>Pengawasan K3 dilakukan oleh Inspektur Tambang dari ESDM</li>
    <li>Pelanggaran K3 dapat berujung pencabutan IUP</li>
  </ul>
</div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">Tingkatan Sertifikasi K3 Pertambangan</h2>
  <div class="compare-table-wrap">
  <table class="compare-table">
    <thead><tr><th>Aspek</th><th>POP</th><th>POM</th><th>POU</th></tr></thead>
    <tbody>
      <?php foreach ($compare as $row): ?>
      <tr><td><?= htmlspecialchars($row['aspek']) ?></td><td><?= htmlspecialchars($row['pop']) ?></td><td><?= htmlspecialchars($row['pom']) ?></td><td><?= htmlspecialchars($row['pou']) ?></td></tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  </div>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">Siapa yang Wajib Ikut Pelatihan K3 Pertambangan?</h2>
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
  <div class="three-col">
    <div>
      <h3 class="sub-title">POP</h3>
      <ul class="plain-list">
        <?php foreach ($syaratPOP as $s): ?>
        <li><?= htmlspecialchars($s) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div>
      <h3 class="sub-title">POM</h3>
      <ul class="plain-list">
        <?php foreach ($syaratPOM as $s): ?>
        <li><?= htmlspecialchars($s) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div>
      <h3 class="sub-title">POU</h3>
      <ul class="plain-list">
        <?php foreach ($syaratPOU as $s): ?>
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
  <h3 class="sub-title">POP (±40 jam)</h3>
  <ul class="plain-list">
    <?php foreach ($materiPOP as $m): ?>
    <li><?= htmlspecialchars($m) ?></li>
    <?php endforeach; ?>
  </ul>
  <h3 class="sub-title">POM (±40 jam — ditambah)</h3>
  <ul class="plain-list">
    <?php foreach ($materiPOM as $m): ?>
    <li><?= htmlspecialchars($m) ?></li>
    <?php endforeach; ?>
  </ul>
  <h3 class="sub-title">POU (±40 jam — ditambah)</h3>
  <ul class="plain-list">
    <?php foreach ($materiPOU as $m): ?>
    <li><?= htmlspecialchars($m) ?></li>
    <?php endforeach; ?>
  </ul>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">Program Juru Ledak</h2>
  <p class="intro-text">Selain sertifikasi POP/POM/POU, kami juga menyelenggarakan pelatihan Juru Ledak Kelas II sesuai Permenaker No. Per.02/Men/1984 untuk operator yang langsung menangani bahan peledak di tambang. Hubungi kami untuk jadwal dan persyaratan.</p>
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
  <h2 class="section-title">Program Pelatihan K3 Pertambangan Kami</h2>
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
  <div class="inquiry-card">
    <p>Program Juru Ledak dan pelatihan pertambangan lainnya kami selenggarakan sesuai permintaan (in-house maupun kelompok). Hubungi kami untuk jadwal dan penawaran terbaru.</p>
    <a href="<?=$wa_url?>" class="btn-wa" target="_blank" rel="noopener" style="margin-top:0">💬 Tanya Jadwal Juru Ledak</a>
  </div>
</div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">Program K3 Terkait</h2>
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
    <p>Hubungi kami untuk info jadwal dan biaya pelatihan K3 Pertambangan POP, POM, atau POU.</p>
    <a href="<?=$wa_url?>" class="btn-wa" target="_blank" rel="noopener">💬 Konsultasi via WhatsApp</a>
  </div>
</section>

<?php
require_once __DIR__ . '/includes/hub-category-map.php';
$hub_article_cats = $HUB_CATEGORY_MAP['mining']['article_cats'] ?? [];
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
