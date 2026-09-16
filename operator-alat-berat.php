<?php
require_once __DIR__ . '/config.php';
$s = get_all_settings();
/**
 * operator-alat-berat.php
 * Operator Alat Berat hub page (excavator, bulldozer, grader, etc).
 * Zero DB dependency, modeled on k3-pesawat-uap.php.
 *
 * Real training slug verified via catalog2026/real_trainings.json —
 * only ONE general product exists, no per-machine-type (excavator/
 * bulldozer/grader) slugs:
 * pelatihan-k3-operator-alat-berat-sertifikasi-kemnaker-ri (Kemnaker RI, Rp6.000.000)
 * The "Program Pelatihan Kami" section below reflects this — a single
 * real card plus a WA-inquiry note for machine-specific certification
 * requests, per the established gap-handling pattern (this hub has
 * fewer real products than the brief assumed, same situation as
 * k3-pesawat-angkat-angkut.php).
 *
 * Regulation: no specific Permenaker number was cited anywhere in the
 * existing site content for alat berat (only generic "alat berat"
 * mentions in k3-pertambangan.php/k3-pesawat-angkat-angkut.php, no
 * regulation number attached). WebSearch verification found heavy
 * equipment (excavator, bulldozer, wheel loader, etc.) operator SIO
 * is governed by the same Permenaker No. 8 Tahun 2020 tentang K3
 * Pesawat Angkat dan Angkut (PAA) used for k3-pesawat-angkat-angkut.php
 * — these machines fall under the PAA regulatory umbrella in
 * Indonesia — under the general framework of UU No. 1 Tahun 1970.
 * SIO validity of 5 years confirmed via the same search.
 */
$wa_number = '6287759151278';
$wa_msg = rawurlencode('Halo, saya ingin mendaftar pelatihan Operator Alat Berat (Excavator/Bulldozer/Grader). Mohon info jadwal dan biaya?');
$wa_url = "https://wa.me/{$wa_number}?text={$wa_msg}";
$year = date('Y');

$jenisAlat = [
    ['jenis' => 'Excavator / Backhoe', 'fungsi' => 'Penggalian, pemindahan tanah', 'sektor' => 'Konstruksi, pertambangan'],
    ['jenis' => 'Bulldozer', 'fungsi' => 'Penimbunan, perataan, pendorongan material', 'sektor' => 'Konstruksi, pertambangan, land clearing'],
    ['jenis' => 'Motor Grader', 'fungsi' => 'Perataan permukaan jalan', 'sektor' => 'Konstruksi jalan, tambang'],
    ['jenis' => 'Wheel Loader', 'fungsi' => 'Pemuatan material ke truk', 'sektor' => 'Pertambangan, konstruksi, pelabuhan'],
    ['jenis' => 'Compactor / Vibro Roller', 'fungsi' => 'Pemadatan tanah dan aspal', 'sektor' => 'Konstruksi jalan'],
    ['jenis' => 'Road Roller', 'fungsi' => 'Pemadatan permukaan jalan', 'sektor' => 'Konstruksi jalan'],
    ['jenis' => 'Dump Truck (off-road)', 'fungsi' => 'Pengangkutan material dalam site', 'sektor' => 'Pertambangan'],
];

$wajibSIO = [
    'Semua operator yang secara langsung mengoperasikan alat berat di proyek konstruksi atau site tambang',
    'Operator yang mengoperasikan alat berat milik subkontraktor — tanggung jawab tetap pada perusahaan utama',
    'Operator baru yang belum memiliki SIO wajib dalam pengawasan operator bersertifikat',
    'Kontraktor yang mengikuti tender pemerintah — dokumen kualifikasi sering mensyaratkan daftar operator bersertifikat',
];

$syaratPeserta = [
    'Usia minimal 18 tahun',
    'Ijazah minimal SMP sederajat (SMA/SMK Teknik diutamakan)',
    'Sehat jasmani dan rohani — tidak buta warna, penglihatan normal',
    'Pengalaman mengoperasikan alat berat diutamakan tapi tidak wajib',
    'Fotokopi KTP, pas foto 3×4 (4 lembar), surat keterangan sehat',
];

$tujuan = [
    'Memahami regulasi K3 operator alat berat dan persyaratan SIO Kemnaker RI',
    'Mengenal komponen utama alat berat dan sistem hidrolik',
    'Mengoperasikan alat berat dengan teknik yang aman dan efisien',
    'Melakukan pre-use inspection (P2H — Pemeriksaan dan Perawatan Harian)',
    'Menerapkan prosedur keselamatan di area kerja: komunikasi, zona aman, rambu alat berat',
    'Menangani kondisi darurat: alat terperosok, kebakaran alat, kabel listrik tersentuh',
];

$materiExcavator = [
    'Regulasi K3 operator alat berat',
    'Komponen excavator: boom, arm, bucket, undercarriage, swing motor',
    'Sistem hidrolik dan cara kerjanya',
    'Teknik penggalian: sudut galian, pembuangan spoil, galian di lereng',
    'Keselamatan galian dalam: risiko longsor, deteksi utilitas bawah tanah',
    'Operasi excavator di area sempit dan lereng tidak stabil',
    'Prosedur pre-use inspection (P2H)',
    'Komunikasi dengan rigger dan pengawas lapangan',
];
$materiBulldozer = [
    'Komponen bulldozer: blade, ripper, track, final drive',
    'Teknik pushing, dozing, dan ripping',
    'Operasi di lereng: maksimal kemiringan aman, teknik naik-turun lereng',
    'Land clearing: prosedur aman menebang pohon dengan bulldozer',
    'Keselamatan di tepi jurang dan di dekat galian',
];
$materiGrader = [
    'Komponen grader: moldboard, scarifier, circle drive, tandem drive',
    'Teknik perataan: rough grading, fine grading, shoulder grading',
    'Pembentukan cross-section jalan dan superelevasi',
    'Operasi grader pada material berbeda: tanah, sirtu, base course',
];
$materiP2H = [
    'Prosedur P2H sebelum mulai kerja',
    'Titik pemeriksaan: oli, coolant, hydraulic oil, ban/track, lampu, alarm mundur',
    'Pengisian form P2H dan pelaporan kerusakan',
    'Larangan operasi: kapan alat TIDAK boleh dijalankan',
];

$metode = [
    'Pelatihan tatap muka di Yogyakarta — termasuk praktik langsung mengoperasikan alat',
    'In-house training di site konstruksi atau tambang (minimum 10 peserta) — paling efisien karena peserta berlatih dengan alat yang akan mereka gunakan sehari-hari',
    'SIO diterbitkan Kemnaker RI setelah lulus ujian teori dan praktik',
];

$terkait = [
    ['label' => 'Pelatihan K3 Pertambangan', 'url' => '/k3-pertambangan/'],
    ['label' => 'Pelatihan K3 Konstruksi', 'url' => '/k3-konstruksi/'],
    ['label' => 'K3 Pesawat Angkat Angkut', 'url' => '/k3-pesawat-angkat-angkut/'],
    ['label' => 'Panduan Lengkap K3', 'url' => '/keselamatan-kerja/'],
];

$faqs = [
    ['q' => 'Apakah SIO alat berat berlaku untuk semua merek excavator?', 'a' => 'Ya. SIO operator alat berat dari Kemnaker RI tidak terikat pada merek tertentu. Operator excavator bersertifikat dapat mengoperasikan excavator merek Komatsu, Hitachi, Caterpillar, Volvo, atau merek lainnya — selama jenis dan kapasitasnya sesuai dengan SIO yang dimiliki.'],
    ['q' => 'Berapa lama SIO operator alat berat berlaku?', 'a' => 'SIO operator alat berat berlaku 5 tahun dan dapat diperpanjang melalui uji ulang kompetensi sebelum masa berlaku habis. Perpanjangan dilakukan dengan mengajukan permohonan ke Disnaker setempat disertai bukti pengalaman kerja selama masa berlaku SIO.'],
    ['q' => 'Apa itu P2H dan mengapa wajib dilakukan setiap hari?', 'a' => 'P2H (Pemeriksaan dan Perawatan Harian) adalah inspeksi rutin yang wajib dilakukan operator sebelum mengoperasikan alat berat setiap shift. Tujuannya: mendeteksi kerusakan sebelum alat dioperasikan — rem blong, kebocoran oli, atau track yang longgar dapat menyebabkan kecelakaan fatal. Di perusahaan yang patuh K3, operator yang skip P2H dapat langsung diskors.'],
    ['q' => 'Apakah operator excavator bisa langsung mengoperasikan bulldozer?', 'a' => 'Tidak. SIO bersifat spesifik per jenis alat. Operator excavator bersertifikat tidak boleh mengoperasikan bulldozer kecuali memiliki SIO bulldozer tersendiri. Setiap jenis alat berat membutuhkan pelatihan dan SIO yang berbeda karena cara operasi, bahaya, dan tekniknya berbeda.'],
    ['q' => 'Apakah ada batasan usia untuk menjadi operator alat berat?', 'a' => 'Batas minimum 18 tahun. Tidak ada batas maksimum secara regulasi, namun perusahaan umumnya mensyaratkan surat keterangan sehat dari dokter — terutama untuk pemeriksaan penglihatan, pendengaran, dan kondisi fisik umum yang diperlukan untuk mengoperasikan alat berat dengan aman.'],
    ['q' => 'Apakah bisa in-house training di site proyek kami yang sedang berjalan?', 'a' => 'Ya, dan ini opsi yang paling efisien. Peserta berlatih langsung dengan alat yang akan mereka gunakan di lapangan yang sudah mereka kenal. Minimum 10 peserta. Tim instruktur dan penguji kami datang ke lokasi. Hubungi kami untuk jadwal koordinasi.'],
];
?>
<?php
$page_title = 'Pelatihan Operator Alat Berat (Excavator, Bulldozer, Grader) — SIO Kemnaker RI';
$meta_desc = 'Pelatihan Operator Alat Berat bersertifikat Kemnaker RI. Program SIO Excavator, Bulldozer, Motor Grader, Compactor, dan Wheel Loader. Yogyakarta & in-house. 0877-5915-1278.';
require __DIR__ . '/includes/head.php';
?>
<script type="application/ld+json">
{"@context":"https://schema.org","@type":"BreadcrumbList","itemListElement":[
  {"@type":"ListItem","position":1,"name":"Beranda","item":"https://wahanatotalita.com/"},
  {"@type":"ListItem","position":2,"name":"Pelatihan","item":"https://wahanatotalita.com/pelatihan/"},
  {"@type":"ListItem","position":3,"name":"Operator Alat Berat","item":"https://wahanatotalita.com/operator-alat-berat/"}
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
.scheme-grid{display:grid;grid-template-columns:1fr;gap:1rem;max-width:420px}
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
    <div class="hero-badge">🚜 Operator Alat Berat</div>
    <h1>Pelatihan Operator Alat Berat — SIO Excavator, Bulldozer &amp; Grader Bersertifikat Kemnaker RI</h1>
    <p class="hero-sub">Sertifikasi resmi Kemnaker RI untuk operator excavator, bulldozer, motor grader, dan alat berat lainnya.</p>
    <div><a href="<?=$wa_url?>" class="btn-wa" target="_blank" rel="noopener">💬 Konsultasi Jadwal &amp; Biaya</a></div>
  </div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">Apa itu Alat Berat dan Mengapa Operatornya Wajib Bersertifikat?</h2>
  <p class="intro-text">Alat berat adalah peralatan mekanis bertenaga besar yang digunakan untuk pekerjaan konstruksi, pertambangan, dan infrastruktur — mencakup excavator, bulldozer, motor grader, wheel loader, compactor, dan road roller. Alat berat adalah salah satu sumber kecelakaan kerja paling fatal: tertimpa, terlindas, terbalik, atau jatuh dari tebing. Kemnaker RI mewajibkan setiap operator alat berat memiliki SIO (Surat Ijin Operasi) sebelum mengoperasikan alat — perusahaan yang menggunakan operator tanpa SIO dapat dikenai sanksi pidana.</p>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">Dasar Hukum</h2>
  <ul class="law-list">
    <li>UU No. 1 Tahun 1970 tentang Keselamatan Kerja — dasar hukum umum kewajiban SIO bagi operator alat/mesin berisiko</li>
    <li>Permenaker No. 8 Tahun 2020 tentang K3 Pesawat Angkat dan Angkut (PAA) — mengatur secara rinci kualifikasi dan lisensi operator alat berat seperti excavator, bulldozer, dan wheel loader</li>
    <li>Setiap operator wajib memiliki SIO sesuai jenis dan kelas alat yang dioperasikan</li>
    <li>Perusahaan wajib memastikan alat berat diperiksa dan diuji berkala oleh pengawas K3 atau PJK3</li>
  </ul>
</div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">Jenis Alat Berat dan SIO yang Dibutuhkan</h2>
  <div class="compare-table-wrap">
  <table class="compare-table">
    <thead><tr><th>Jenis Alat Berat</th><th>Fungsi Utama</th><th>Sektor</th></tr></thead>
    <tbody>
      <?php foreach ($jenisAlat as $row): ?>
      <tr><td><?= htmlspecialchars($row['jenis']) ?></td><td><?= htmlspecialchars($row['fungsi']) ?></td><td><?= htmlspecialchars($row['sektor']) ?></td></tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  </div>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">Siapa yang Wajib Memiliki SIO Alat Berat?</h2>
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
  <ul class="plain-list">
    <?php foreach ($syaratPeserta as $s): ?>
    <li><?= htmlspecialchars($s) ?></li>
    <?php endforeach; ?>
  </ul>
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
  <h3 class="sub-title">Operator Excavator (±40 jam)</h3>
  <ul class="plain-list">
    <?php foreach ($materiExcavator as $m): ?>
    <li><?= htmlspecialchars($m) ?></li>
    <?php endforeach; ?>
  </ul>
  <h3 class="sub-title">Operator Bulldozer (±40 jam)</h3>
  <ul class="plain-list">
    <?php foreach ($materiBulldozer as $m): ?>
    <li><?= htmlspecialchars($m) ?></li>
    <?php endforeach; ?>
  </ul>
  <h3 class="sub-title">Operator Motor Grader (±40 jam)</h3>
  <ul class="plain-list">
    <?php foreach ($materiGrader as $m): ?>
    <li><?= htmlspecialchars($m) ?></li>
    <?php endforeach; ?>
  </ul>
  <h3 class="sub-title">P2H — Pemeriksaan dan Perawatan Harian (semua jenis)</h3>
  <ul class="plain-list">
    <?php foreach ($materiP2H as $m): ?>
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
  <h2 class="section-title">Program Pelatihan Operator Alat Berat Kami</h2>
  <div class="scheme-grid">
    <div class="scheme-card">
      <div class="scheme-card-media">
        <img src="<?= training_img_url('', 'k3', 'pelatihan-k3-operator-alat-berat-sertifikasi-kemnaker-ri') ?>" alt="Pelatihan K3 Operator Alat Berat" loading="lazy" width="360" height="170">
        <span class="scheme-cert">Sertifikasi Kemnaker RI</span>
      </div>
      <div class="scheme-card-body">
        <h3><a href="/pelatihan/pelatihan-k3-operator-alat-berat-sertifikasi-kemnaker-ri/">Pelatihan K3 Operator Alat Berat (Excavator, Loader, Dozer)</a></h3>
        <div class="scheme-actions">
          <a href="/pelatihan/pelatihan-k3-operator-alat-berat-sertifikasi-kemnaker-ri/" class="scheme-link">Silabus &amp; Jadwal &rarr;</a>
          <a href="https://wa.me/<?=$wa_number?>?text=<?=rawurlencode('Halo Wahana Totalita, saya ingin informasi pelatihan Operator Alat Berat')?>" class="scheme-btn-wa" target="_blank" rel="noopener">Chat WA</a>
        </div>
      </div>
    </div>
  </div>
  <div class="inquiry-card">
    <p>Membutuhkan sertifikasi khusus per jenis alat (SIO Excavator, Bulldozer, Motor Grader, Wheel Loader, atau Compactor secara terpisah)? Hubungi kami untuk konsultasi jadwal dan penyelenggaraan in-house sesuai kebutuhan armada Anda.</p>
    <a href="<?=$wa_url?>" class="btn-wa" target="_blank" rel="noopener" style="margin-top:0">💬 Tanya Sertifikasi per Jenis Alat</a>
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
    <p>Hubungi kami untuk info jadwal dan biaya pelatihan Operator Alat Berat (Excavator/Bulldozer/Grader).</p>
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
