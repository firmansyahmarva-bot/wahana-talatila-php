<?php
require_once __DIR__ . '/config.php';
$s = get_all_settings();
/**
 * k3-pesawat-angkat-angkut.php
 * K3 Pesawat Angkat dan Angkut (PAA) hub page — crane, forklift,
 * rigger. Zero DB dependency, modeled on k3-lingkungan.php.
 *
 * Real training slugs verified via catalog2026/real_trainings.json
 * + fixes/new-trainings.sql (rigger added earlier this session, run
 * per user's "4 sql run already" confirmation):
 * pelatihan-k3-operator-forklift-kelas-2-sertifikasi-kemnaker-ri (Kemnaker RI)
 * pelatihan-k3-operator-crane-kelas-3-sertifikasi-kemnaker-ri (Kemnaker RI)
 * operator-rigger (Kemnaker RI)
 * No real dedicated Hoist or Gondola operator product exists in the
 * catalog — those two use the WA-inquiry fallback per the established
 * gap-handling pattern (k3-ketinggian.php / k3-lingkungan.php precedent).
 *
 * Permenaker No. 8 Tahun 2020 WebSearch-verified: replaces Per.05/
 * Men/1985 (confirmed, also replaces Per.09/Men/VII/2010 and Kepmenaker
 * 452/1996 — added as extra accurate detail, not in original brief).
 */
$wa_number = '6287759151278';
$wa_msg = rawurlencode('Halo, saya ingin mendaftar pelatihan K3 Pesawat Angkat Angkut (Crane/Forklift/Rigger). Mohon info jadwal dan biaya?');
$wa_url = "https://wa.me/{$wa_number}?text={$wa_msg}";
$year = date('Y');

$jenisPAA = [
    ['jenis' => 'Overhead Crane / Gantry Crane', 'kelas' => 'Kelas I & II', 'ket' => 'Berdasarkan kapasitas angkat'],
    ['jenis' => 'Mobile Crane / Truck Crane', 'kelas' => 'Kelas I & II', 'ket' => 'Crane bergerak di lapangan'],
    ['jenis' => 'Tower Crane', 'kelas' => 'Kelas I', 'ket' => 'Proyek konstruksi gedung tinggi'],
    ['jenis' => 'Forklift', 'kelas' => 'Kelas I & II', 'ket' => 'Berdasarkan kapasitas & ketinggian angkat'],
    ['jenis' => 'Hoist Listrik', 'kelas' => 'Kelas I & II', 'ket' => 'Chain hoist dan wire rope hoist'],
    ['jenis' => 'Gondola', 'kelas' => 'Kelas I', 'ket' => 'Pemeliharaan gedung bertingkat'],
    ['jenis' => 'Excavator (untuk pengangkatan)', 'kelas' => 'Kelas I', 'ket' => 'Dengan attachment khusus'],
    ['jenis' => 'Rigger / Juru Ikat', 'kelas' => 'Kelas I & II', 'ket' => 'Spesialis pengikatan beban'],
];

$wajibSIO = [
    'Semua operator yang secara langsung mengoperasikan crane, forklift, hoist, atau gondola',
    'Rigger (juru ikat) yang bertanggung jawab mengikat dan memandu beban angkat',
    'Teknisi pemeliharaan yang melakukan perbaikan pada PAA',
    'Pengawas operasi crane di proyek konstruksi dan pabrik',
];

$syaratOperator = [
    'Usia minimal 18 tahun',
    'Ijazah minimal SMP/SMA sederajat',
    'Sehat jasmani dan rohani (tidak buta warna, tidak gangguan keseimbangan)',
    'Fotokopi KTP, pas foto 3×4 (4 lembar), surat keterangan sehat dari dokter',
];
$syaratRigger = [
    'Usia minimal 18 tahun',
    'Pengalaman kerja di area pengangkatan minimal 1 tahun diutamakan',
    'Persyaratan dokumen sama seperti operator PAA',
];

$tujuan = [
    'Memahami regulasi K3 PAA sesuai Permenaker 8/2020',
    'Mengoperasikan PAA dengan aman sesuai kapasitas dan prosedur',
    'Melakukan inspeksi harian (pre-use inspection) sebelum pengoperasian',
    'Menghitung kapasitas angkat, radius kerja, dan load chart',
    'Menerapkan prosedur komunikasi standar antara operator dan rigger',
    'Menangani situasi darurat: beban terjatuh, alat macet, angin kencang',
];

$materiCrane = [
    'Regulasi K3 PAA (Permenaker 8/2020)',
    'Komponen dan mekanisme crane',
    'Load chart dan kapasitas angkat',
    'Pemilihan sling, shackle, dan rigging equipment',
    'Prosedur pre-use inspection',
    'Teknik pengoperasian aman: radius, clearance, blind lift',
    'Komunikasi standar operator-rigger (hand signal & radio)',
    'Tanggap darurat: prosedur saat overload, power failure, angin kencang',
];
$materiForklift = [
    'Regulasi K3 forklift',
    'Komponen forklift: mast, forks, counterweight, tyres',
    'Kapasitas angkat dan load centre',
    'Teknik pengambilan, pengangkatan, dan penempatan beban',
    'Keselamatan di gudang: traffic management, pedestrian zone',
    'Inspeksi forklift harian (checklist)',
    'Prosedur aman di area miring, sempit, dan berdebu',
];
$materiRigger = [
    'Jenis dan kapasitas alat ikat (sling, chain, shackle, eyebolt)',
    'Tabel beban dan sudut pengikatan',
    'Teknik ikatan dasar dan lanjutan',
    'Inspeksi alat ikat sebelum penggunaan',
    'Komunikasi dengan operator crane',
    'Prosedur angkat tandem (dua crane)',
];

$metode = [
    'Pelatihan tatap muka di Yogyakarta — termasuk praktik langsung dengan alat',
    'In-house training di lokasi perusahaan (minimum 10 peserta) — efisien untuk perusahaan dengan banyak operator',
    'SIO diterbitkan oleh Kemnaker RI setelah lulus ujian teori dan praktik',
];

$skemas = [
    ['name' => 'Pelatihan K3 Operator Forklift Kelas 2', 'cert' => 'Sertifikasi KEMNAKER RI', 'slug' => 'pelatihan-k3-operator-forklift-kelas-2-sertifikasi-kemnaker-ri'],
    ['name' => 'Pelatihan K3 Operator Crane Kelas 3', 'cert' => 'Sertifikasi KEMNAKER RI', 'slug' => 'pelatihan-k3-operator-crane-kelas-3-sertifikasi-kemnaker-ri'],
    ['name' => 'Pelatihan Rigger / Juru Ikat K3', 'cert' => 'Sertifikasi Kemnaker RI', 'slug' => 'operator-rigger'],
];

$terkait = [
    ['label' => 'Pelatihan K3 Konstruksi', 'url' => '/k3-konstruksi/'],
    ['label' => 'Pelatihan K3 Pertambangan', 'url' => '/k3-pertambangan/'],
    ['label' => 'Panduan Lengkap K3', 'url' => '/keselamatan-kerja/'],
    ['label' => 'Sertifikasi BNSP', 'url' => '/sertifikasi-bnsp/'],
];

$faqs = [
    ['q' => 'Apa itu SIO dan mengapa operator PAA wajib memilikinya?', 'a' => 'SIO (Surat Ijin Operasi) adalah lisensi resmi dari Kemnaker RI yang membuktikan bahwa operator telah memenuhi kompetensi K3 untuk mengoperasikan jenis PAA tertentu. Tanpa SIO, operator tidak boleh secara legal mengoperasikan crane, forklift, atau hoist di tempat kerja. Perusahaan yang membiarkan operator tanpa SIO beroperasi dapat dikenai sanksi pidana.'],
    ['q' => 'Apakah SIO crane bisa digunakan untuk semua jenis crane?', 'a' => 'Tidak. SIO bersifat spesifik per jenis dan kelas crane. Operator overhead crane Kelas II tidak otomatis boleh mengoperasikan mobile crane atau tower crane. Setiap jenis dan kelas PAA membutuhkan SIO tersendiri.'],
    ['q' => 'Berapa lama SIO berlaku?', 'a' => 'SIO PAA berlaku 5 tahun dan dapat diperpanjang melalui uji ulang kompetensi sebelum masa berlaku habis.'],
    ['q' => 'Apa beda Kelas I dan Kelas II operator crane?', 'a' => 'Kelas II untuk crane dengan kapasitas lebih kecil dan kompleksitas lebih rendah. Kelas I untuk crane kapasitas besar dan operasi lebih kompleks. Operator Kelas I dapat mengoperasikan semua unit yang masuk kewenangan Kelas II, tetapi tidak sebaliknya.'],
    ['q' => 'Apakah rigger perlu SIO atau cukup sertifikat pelatihan?', 'a' => 'Rigger wajib memiliki SIO Rigger dari Kemnaker RI — bukan sekadar sertifikat pelatihan. Prosesnya sama: pelatihan → ujian → terbit SIO. Tanpa SIO Rigger, seseorang tidak boleh secara legal melakukan pekerjaan pengikatan beban di area pengangkatan.'],
    ['q' => 'Bisakah pelatihan operator crane dilakukan langsung di pabrik kami?', 'a' => 'Ya. Kami melayani in-house training operator PAA di lokasi perusahaan dengan minimum 10 peserta. Instruktur dan peralatan praktik kami bawa ke lokasi Anda. Ini lebih efisien untuk perusahaan dengan banyak operator yang perlu disertifikasi sekaligus.'],
];
?>
<?php
$page_title = 'Pelatihan K3 Pesawat Angkat Angkut (Crane, Forklift, Rigger) — Sertifikasi Kemnaker RI';
$meta_desc = 'Pelatihan K3 Pesawat Angkat dan Angkut bersertifikat Kemnaker RI. Program Operator Crane, Forklift, Rigger, Hoist sesuai Permenaker No. 8 Tahun 2020. Yogyakarta & in-house. 0877-5915-1278.';
require __DIR__ . '/includes/head.php';
?>
<script type="application/ld+json">
{"@context":"https://schema.org","@type":"BreadcrumbList","itemListElement":[
  {"@type":"ListItem","position":1,"name":"Beranda","item":"https://wahanatotalita.com/"},
  {"@type":"ListItem","position":2,"name":"Pelatihan","item":"https://wahanatotalita.com/pelatihan/"},
  {"@type":"ListItem","position":3,"name":"K3 Pesawat Angkat Angkut","item":"https://wahanatotalita.com/k3-pesawat-angkat-angkut/"}
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
.compare-table{width:100%;border-collapse:collapse;background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 2px 12px rgba(0,0,0,.05);min-width:560px}
.two-col{display:grid;grid-template-columns:repeat(2,1fr);gap:14px}
@media(max-width:640px){.two-col{grid-template-columns:1fr}}
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
    <div class="hero-badge">🏗️ K3 Pesawat Angkat Angkut</div>
    <h1>Pelatihan K3 Pesawat Angkat dan Angkut — Operator Crane, Forklift &amp; Rigger Bersertifikat Kemnaker RI</h1>
    <p class="hero-sub">Sertifikasi resmi Kemnaker RI sesuai Permenaker No. 8 Tahun 2020.</p>
    <div><a href="<?=$wa_url?>" class="btn-wa" target="_blank" rel="noopener">💬 Konsultasi Jadwal &amp; Biaya</a></div>
  </div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">Apa itu Pesawat Angkat dan Angkut?</h2>
  <p class="intro-text">Pesawat Angkat dan Angkut (PAA) adalah peralatan mekanis yang digunakan untuk memindahkan, mengangkat, atau menurunkan barang dan orang di tempat kerja. Mencakup: crane (overhead, mobile, tower), forklift, hoist, gondola, conveyor, dan excavator yang digunakan untuk pengangkatan. Kecelakaan akibat PAA — tertimpa beban jatuh, crane ambruk, forklift terguling — termasuk kategori kecelakaan kerja fatal. Permenaker No. 8 Tahun 2020 mewajibkan operator PAA memiliki sertifikasi Kemnaker RI sebelum mengoperasikan alat.</p>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">Dasar Hukum — Permenaker No. 8 Tahun 2020</h2>
  <ul class="law-list">
    <li>Menggantikan Permenaker No. Per.05/Men/1985 (juga Per.09/Men/VII/2010 dan Kepmenaker 452/1996)</li>
    <li>Setiap operator PAA wajib memiliki Surat Ijin Operasi (SIO) dari Kemnaker RI</li>
    <li>Perusahaan wajib memiliki Surat Pengesahan Pemakaian (SP) untuk setiap unit PAA</li>
    <li>PAA wajib diperiksa dan diuji secara berkala oleh pengawas K3 atau PJK3</li>
    <li>Penggunaan operator tanpa SIO: sanksi pidana dan administratif untuk perusahaan</li>
  </ul>
</div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">Jenis PAA dan Kelas Sertifikasi</h2>
  <div class="compare-table-wrap">
  <table class="compare-table">
    <thead><tr><th>Jenis PAA</th><th>Kelas</th><th>Keterangan</th></tr></thead>
    <tbody>
      <?php foreach ($jenisPAA as $row): ?>
      <tr><td><?= htmlspecialchars($row['jenis']) ?></td><td><?= htmlspecialchars($row['kelas']) ?></td><td><?= htmlspecialchars($row['ket']) ?></td></tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  </div>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">Siapa yang Wajib Memiliki SIO?</h2>
  <ul class="plain-list">
    <?php foreach ($wajibSIO as $w): ?>
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
      <h3 class="sub-title">Operator PAA (Crane, Forklift, Hoist)</h3>
      <ul class="plain-list">
        <?php foreach ($syaratOperator as $s): ?>
        <li><?= htmlspecialchars($s) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div>
      <h3 class="sub-title">Rigger / Juru Ikat Kelas I</h3>
      <ul class="plain-list">
        <?php foreach ($syaratRigger as $s): ?>
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
  <h2 class="section-title">Kurikulum</h2>
  <div class="three-col">
    <div>
      <h3 class="sub-title">Operator Crane (±40 jam)</h3>
      <ul class="plain-list">
        <?php foreach ($materiCrane as $m): ?>
        <li><?= htmlspecialchars($m) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div>
      <h3 class="sub-title">Operator Forklift (±40 jam)</h3>
      <ul class="plain-list">
        <?php foreach ($materiForklift as $m): ?>
        <li><?= htmlspecialchars($m) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div>
      <h3 class="sub-title">Rigger Kelas I (±40 jam)</h3>
      <ul class="plain-list">
        <?php foreach ($materiRigger as $m): ?>
        <li><?= htmlspecialchars($m) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
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
  <h2 class="section-title">Program Pelatihan PAA Kami</h2>
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
    <p>Membutuhkan sertifikasi operator Hoist atau Gondola secara spesifik? Hubungi kami untuk konsultasi jadwal dan penyelenggaraan in-house.</p>
    <a href="<?=$wa_url?>" class="btn-wa" target="_blank" rel="noopener" style="margin-top:0">💬 Tanya Jadwal Hoist/Gondola</a>
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
    <p>Hubungi kami untuk info jadwal dan biaya pelatihan K3 Pesawat Angkat Angkut (Crane/Forklift/Rigger).</p>
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
