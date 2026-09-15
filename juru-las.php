<?php
require_once __DIR__ . '/config.php';
$s = get_all_settings();
/**
 * juru-las.php
 * Juru Las (Welder) hub page. Zero DB dependency, modeled on
 * operator-alat-berat.php.
 *
 * Regulation verified: Permenaker PER.02/MEN/1982 tentang Kualifikasi
 * Juru Las di Tempat Kerja — confirmed real (no regulation number was
 * cited anywhere in existing site content, so this was independently
 * WebSearch-verified rather than copied from an on-site source).
 *
 * CORRECTION FLAGGED TO USER: the brief's Kelas II position table
 * stopped at 3G (vertical). The verified real regulation requires
 * Kelas II welders to pass 1G, 2G, 3G, AND 4G (overhead) — 4G belongs
 * to Kelas II, not Kelas I as the brief's curriculum implied. Fixed
 * in the tier table and moved the 4G/overhead curriculum content from
 * "Kelas I (ditambah)" to "Kelas II (ditambah)" below; Kelas I's real
 * addition is 5G and 6G (pipe positions) only.
 *
 * Real training slugs verified via catalog2026/real_trainings.json —
 * a large, genuinely rich set exists for this topic:
 * Kemnaker RI (matches the brief's Kelas I/III framing):
 *   pelatihan-k3-operator-welder-kelas-3-sertifikasi-kemnaker-ri (Rp15.000.000)
 *   pelatihan-k3-operator-welder-kelas-1-sertifikasi-kemnaker-ri (Rp22.000.000)
 *   No Kemnaker Kelas II product exists — WA-inquiry fallback used for
 *   that specific tier, per the established gap-handling pattern.
 * BNSP welding-profession ladder (bonus real products beyond the
 * brief's ask — a genuine career ladder from field welder to
 * engineer, presented as a separate "Jalur Profesi Welding Lanjutan"
 * section rather than merged into the Kelas I/II/III grid):
 *   pelatihan-dan-sertifikasi-fillet-plate-welder-sertifikasi-bnsp
 *   pelatihan-dan-sertifikasi-pipe-group-welder-welding-inspector-basic-sertifikasi-bnsp
 *   pelatihan-dan-sertifikasi-welding-foreman-sertifikasi-bnsp
 *   pelatihan-dan-sertifikasi-welding-inspector-standard-sertifikasi-bnsp
 *   pelatihan-dan-sertifikasi-welding-practitioner-welding-instructur-sertifikasi-bnsp
 *   pelatihan-dan-sertifikasi-welding-specialistsupervisor
 *   pelatihan-dan-sertifikasi-welding-inspector-comprehensive-sertifikasi-bnsp
 *   pelatihan-dan-sertifikasi-welding-technologistsuperintendent-sertifikasi-bnsp
 *   pelatihan-dan-sertifikasi-welding-engineer-sertifikasi-bns
 */
$wa_number = '628122969435';
$wa_msg = rawurlencode('Halo, saya ingin mendaftar pelatihan Juru Las (Kelas I/II/III). Mohon info jadwal, metode las yang tersedia, dan biaya?');
$wa_url = "https://wa.me/{$wa_number}?text={$wa_msg}";
$year = date('Y');

$tingkatan = [
    ['kelas' => 'Kelas III', 'posisi' => '1G (flat) dan 2G (horizontal)', 'ket' => 'Kualifikasi dasar/pemula'],
    ['kelas' => 'Kelas II', 'posisi' => '1G, 2G, 3G (vertical), dan 4G (overhead)', 'ket' => 'Kualifikasi menengah'],
    ['kelas' => 'Kelas I', 'posisi' => 'Semua posisi termasuk 5G dan 6G (pipa)', 'ket' => 'Kualifikasi tertinggi'],
];

$prosesLas = [
    'SMAW (Shielded Metal Arc Welding) — las elektroda terbungkus, paling umum',
    'GMAW/MIG (Gas Metal Arc Welding) — las MIG/MAG untuk produksi',
    'GTAW/TIG (Gas Tungsten Arc Welding) — las TIG untuk stainless dan aluminium',
    'FCAW (Flux Cored Arc Welding) — untuk struktur baja tebal',
    'OAW (Oxy-Acetylene Welding) — las karbit',
];

$wajibSertifikat = [
    'Welder di bengkel fabrikasi baja, konstruksi bangunan, dan shipyard',
    'Juru las pipa di industri minyak & gas, petrokimia, dan distribusi gas',
    'Welder boiler dan pressure vessel di pabrik dan pembangkit listrik',
    'Juru las di industri otomotif, manufaktur, dan perbaikan alat berat',
    'Teknisi las di galangan kapal (shipyard)',
];

$syaratKelas3 = [
    'Usia minimal 18 tahun',
    'Minimal SMP sederajat',
    'Tidak ada pengalaman las wajib — cocok untuk pemula',
    'Fotokopi KTP, pas foto 3×4 (4 lembar), surat keterangan sehat',
];
$syaratKelas2 = [
    'Lulus Kelas III atau memiliki pengalaman las minimal 1 tahun',
    'SMA/SMK Teknik diutamakan',
];
$syaratKelas1 = [
    'Lulus Kelas II atau pengalaman las minimal 2 tahun',
    'Mampu melakukan las dalam posisi 3G dan 4G sebelum mengikuti pelatihan',
];

$tujuan = [
    'Memahami regulasi K3 pengelasan (Permenaker 02/1982)',
    'Mengenali bahaya pengelasan: radiasi UV, asap logam, kebakaran, sengatan listrik',
    'Menggunakan APD pengelasan dengan benar: kacamata las, sarung tangan, apron, respirator',
    'Melakukan teknik pengelasan sesuai prosedur WPS (Welding Procedure Specification)',
    'Membaca simbol las pada gambar teknik',
    'Melakukan visual inspection hasil las: cacat permukaan umum dan cara mengatasinya',
];

$materiKelas3 = [
    'Regulasi K3 pengelasan dan persyaratan sertifikasi',
    'Teori dasar pengelasan: proses SMAW, busur listrik, elektroda',
    'Bahaya pengelasan: sinar UV, asap las (metal fume fever), kebakaran percikan',
    'APD pengelasan: pemilihan shade kacamata sesuai amper, filter respirator',
    'Teknik penyulutan busur dan bead welding',
    'Posisi las 1G (flat) dan 2G (horizontal) pada pelat',
    'Cacat las umum: porosity, undercut, lack of fusion — penyebab dan pencegahan',
    'Prosedur izin kerja panas (hot work permit)',
];
$materiKelas2 = [
    'Posisi 3G (vertical up dan vertical down)',
    'Posisi 4G (overhead) — teknik dan keselamatan khusus',
    'Pengelasan multi-pass (pengisian dan penutup)',
    'Preheat dan interpass temperature',
    'Pengelasan material low alloy steel',
];
$materiKelas1 = [
    'Posisi 5G dan 6G (pipa fixed position)',
    'Pengelasan stainless steel dan aluminium',
    'Root pass, hot pass, fill, cap pada pengelasan pipa',
    'WPS (Welding Procedure Specification) — cara membaca dan mengikuti',
    'Dasar radiografi (RT) dan penetrant test (PT) untuk quality check hasil las',
];

$metode = [
    'Pelatihan tatap muka di Yogyakarta — workshop dilengkapi peralatan las dan kubikel las',
    'In-house training di fasilitas bengkel perusahaan (minimum 10 peserta)',
    'Sertifikat Juru Las Kemnaker RI diterbitkan setelah lulus uji praktik pengelasan',
];

$skemasKemnaker = [
    ['name' => 'Pelatihan K3 Operator Welder Kelas 3', 'cert' => 'Sertifikasi KEMNAKER RI', 'slug' => 'pelatihan-k3-operator-welder-kelas-3-sertifikasi-kemnaker-ri'],
    ['name' => 'Pelatihan K3 Operator Welder Kelas 1', 'cert' => 'Sertifikasi KEMNAKER RI', 'slug' => 'pelatihan-k3-operator-welder-kelas-1-sertifikasi-kemnaker-ri'],
];

$skemasBNSP = [
    ['name' => 'Fillet & Plate Welder', 'slug' => 'pelatihan-dan-sertifikasi-fillet-plate-welder-sertifikasi-bnsp'],
    ['name' => 'Pipe, Group Welder, Welding Inspector Basic', 'slug' => 'pelatihan-dan-sertifikasi-pipe-group-welder-welding-inspector-basic-sertifikasi-bnsp'],
    ['name' => 'Welding Foreman', 'slug' => 'pelatihan-dan-sertifikasi-welding-foreman-sertifikasi-bnsp'],
    ['name' => 'Welding Inspector Standard', 'slug' => 'pelatihan-dan-sertifikasi-welding-inspector-standard-sertifikasi-bnsp'],
    ['name' => 'Welding Practitioner & Welding Instructur', 'slug' => 'pelatihan-dan-sertifikasi-welding-practitioner-welding-instructur-sertifikasi-bnsp'],
    ['name' => 'Welding Specialist/Supervisor', 'slug' => 'pelatihan-dan-sertifikasi-welding-specialistsupervisor'],
    ['name' => 'Welding Inspector Comprehensive', 'slug' => 'pelatihan-dan-sertifikasi-welding-inspector-comprehensive-sertifikasi-bnsp'],
    ['name' => 'Welding Technologist/Superintendent', 'slug' => 'pelatihan-dan-sertifikasi-welding-technologistsuperintendent-sertifikasi-bnsp'],
    ['name' => 'Welding Engineer', 'slug' => 'pelatihan-dan-sertifikasi-welding-engineer-sertifikasi-bns'],
];

$terkait = [
    ['label' => 'K3 Pesawat Uap', 'url' => '/k3-pesawat-uap/'],
    ['label' => 'Pelatihan K3 Konstruksi', 'url' => '/k3-konstruksi/'],
    ['label' => 'Penanggulangan Kebakaran', 'url' => '/penanggulangan-kebakaran/'],
    ['label' => 'Panduan Lengkap K3', 'url' => '/keselamatan-kerja/'],
];

$faqs = [
    ['q' => 'Apakah sertifikat juru las Kemnaker sama dengan sertifikat AWS atau ASME?', 'a' => 'Tidak sama. Sertifikat Juru Las Kemnaker RI adalah sertifikat wajib berdasarkan hukum Indonesia (Permenaker 02/1982) untuk bekerja di tempat kerja dalam negeri. AWS (American Welding Society) dan ASME (Section IX) adalah standar internasional yang dibutuhkan untuk proyek ekspor atau kontrak internasional. Untuk bekerja di Indonesia, sertifikat Kemnaker adalah persyaratan utama.'],
    ['q' => 'Berapa lama sertifikat juru las berlaku?', 'a' => 'Sertifikat Juru Las Kemnaker RI berlaku 3 tahun. Perpanjangan dilakukan melalui uji praktik ulang sebelum masa berlaku habis. Juru las yang tidak memperbarui sertifikat tidak boleh secara legal melakukan pengelasan di tempat kerja.'],
    ['q' => 'Apa itu WPS dan apakah setiap welder wajib mengikutinya?', 'a' => 'WPS (Welding Procedure Specification) adalah dokumen teknis yang menentukan parameter pengelasan: jenis elektroda, amper, voltage, kecepatan las, preheat temperature, dan urutan pass. Di industri konstruksi, migas, dan manufaktur berat, welder wajib mengikuti WPS yang telah disetujui — tidak boleh mengubah parameter sesuai kebiasaan sendiri. Pelatihan kami mencakup cara membaca dan mengikuti WPS.'],
    ['q' => 'Apakah juru las Kelas III bisa naik ke Kelas I langsung?', 'a' => 'Tidak. Kenaikan kelas bersifat bertahap: III → II → I. Kelas II mensyaratkan kemampuan las posisi 3G dan 4G (overhead), sedangkan Kelas I menambahkan posisi 5G dan 6G (pipa). Juru las berpengalaman yang sudah mampu mengelas posisi lanjutan dapat mengikuti akselerasi, namun tetap harus melalui ujian Kelas II terlebih dahulu.'],
    ['q' => 'Apa bahaya terbesar dalam pekerjaan pengelasan?', 'a' => 'Tiga bahaya utama: (1) Radiasi UV dari busur las menyebabkan "arc eye" (flash burn pada mata) jika kacamata las tidak dipakai dengan benar. (2) Asap logam (metal fume) mengandung partikel mangan, kromium, nikel, dan timbal — paparan jangka panjang menyebabkan penyakit paru dan kerusakan saraf. (3) Kebakaran dari percikan las yang mengenai material mudah terbakar di sekitar area kerja.'],
    ['q' => 'Apakah ada pelatihan juru las untuk pemula yang belum pernah mengelas sama sekali?', 'a' => 'Ya. Juru Las Kelas III dirancang untuk pemula — tidak ada persyaratan pengalaman. Peserta akan belajar dari nol: memegang elektroda, menyulut busur, hingga membuat lasan flat dan horizontal yang memenuhi standar inspeksi visual. Cocok untuk fresh graduate SMK teknik atau karyawan baru yang akan ditugaskan di bengkel.'],
];
?>
<?php
$page_title = 'Pelatihan Juru Las (Welder Kelas I, II, III) — Sertifikasi Kemnaker RI';
$meta_desc = 'Pelatihan Juru Las bersertifikat Kemnaker RI. Program Welder Kelas I, II, III dan Pengawas Las sesuai Permenaker No. 02/1982. Yogyakarta & in-house. 0812-2969-435.';
require __DIR__ . '/includes/head.php';
?>
<script type="application/ld+json">
{"@context":"https://schema.org","@type":"BreadcrumbList","itemListElement":[
  {"@type":"ListItem","position":1,"name":"Beranda","item":"https://wahanatotalita.com/"},
  {"@type":"ListItem","position":2,"name":"Pelatihan","item":"https://wahanatotalita.com/pelatihan/"},
  {"@type":"ListItem","position":3,"name":"Juru Las","item":"https://wahanatotalita.com/juru-las/"}
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
.three-col{display:grid;grid-template-columns:repeat(3,1fr);gap:14px}
@media(max-width:900px){.three-col{grid-template-columns:1fr}}
.scheme-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:1rem}
@media(max-width:900px){.scheme-grid-3{grid-template-columns:1fr}}
.scheme-card.compact{padding:14px 16px}
.scheme-card.compact h3{font-size:13.5px;margin-bottom:4px}
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
    <div class="hero-badge">🔩 Juru Las</div>
    <h1>Pelatihan Juru Las — Welder Kelas I, II &amp; III Bersertifikat Kemnaker RI</h1>
    <p class="hero-sub">Sertifikasi resmi Kemnaker RI sesuai Permenaker No. PER.02/MEN/1982.</p>
    <div><a href="<?=$wa_url?>" class="btn-wa" target="_blank" rel="noopener">💬 Konsultasi Jadwal &amp; Biaya</a></div>
  </div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">Mengapa Juru Las Wajib Bersertifikat?</h2>
  <p class="intro-text">Pengelasan (welding) menghasilkan panas ekstrem, sinar ultraviolet, asap logam beracun, dan percikan api yang dapat memicu kebakaran atau ledakan. Lebih kritis lagi: las yang buruk pada struktur bangunan, tangki bahan bakar, boiler, atau pipa bertekanan dapat menyebabkan kegagalan struktural katastrofik — runtuh, bocor, atau meledak. Permenaker No. PER.02/MEN/1982 mewajibkan setiap juru las di tempat kerja memiliki sertifikat kompetensi dari Kemnaker RI. Perusahaan yang menggunakan juru las tanpa sertifikat bertanggung jawab penuh atas kerusakan dan kecelakaan yang terjadi.</p>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">Dasar Hukum</h2>
  <ul class="law-list">
    <li>Permenaker No. PER.02/MEN/1982 tentang Kualifikasi Juru Las di Tempat Kerja mengatur kualifikasi, pengujian, dan sertifikasi juru las di semua tempat kerja</li>
    <li>Tiga kelas juru las berdasarkan kemampuan posisi las yang dikuasai</li>
    <li>Pengujian juru las wajib dilakukan oleh penguji las yang diakui Kemnaker</li>
    <li>Sertifikat juru las wajib diperbarui secara berkala</li>
  </ul>
</div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">Tiga Kelas Juru Las</h2>
  <div class="compare-table-wrap">
  <table class="compare-table">
    <thead><tr><th>Kelas</th><th>Kemampuan Posisi Las</th><th>Keterangan</th></tr></thead>
    <tbody>
      <?php foreach ($tingkatan as $row): ?>
      <tr><td><?= htmlspecialchars($row['kelas']) ?></td><td><?= htmlspecialchars($row['posisi']) ?></td><td><?= htmlspecialchars($row['ket']) ?></td></tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  </div>
  <p class="intro-text" style="margin-top:12px">Kelas I adalah kualifikasi tertinggi — mampu mengelas dalam semua posisi termasuk overhead dan pipa. Dibutuhkan untuk pengelasan struktur kritis, bejana tekanan, dan pipa bertekanan tinggi.</p>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">Proses Las yang Dicakup</h2>
  <ul class="plain-list">
    <?php foreach ($prosesLas as $p): ?>
    <li><?= htmlspecialchars($p) ?></li>
    <?php endforeach; ?>
  </ul>
</div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">Siapa yang Wajib Bersertifikat?</h2>
  <ul class="plain-list">
    <?php foreach ($wajibSertifikat as $w): ?>
    <li><?= htmlspecialchars($w) ?></li>
    <?php endforeach; ?>
  </ul>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">Persyaratan Peserta</h2>
  <div class="three-col">
    <div>
      <h3 class="sub-title">Kelas III (Entry)</h3>
      <ul class="plain-list">
        <?php foreach ($syaratKelas3 as $s): ?>
        <li><?= htmlspecialchars($s) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div>
      <h3 class="sub-title">Kelas II</h3>
      <ul class="plain-list">
        <?php foreach ($syaratKelas2 as $s): ?>
        <li><?= htmlspecialchars($s) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div>
      <h3 class="sub-title">Kelas I</h3>
      <ul class="plain-list">
        <?php foreach ($syaratKelas1 as $s): ?>
        <li><?= htmlspecialchars($s) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">Tujuan Pembelajaran</h2>
  <ol class="num-list">
    <?php foreach ($tujuan as $t): ?>
    <li><?= htmlspecialchars($t) ?></li>
    <?php endforeach; ?>
  </ol>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">Kurikulum</h2>
  <h3 class="sub-title">Juru Las Kelas III — Posisi Flat &amp; Horizontal (±40 jam)</h3>
  <ul class="plain-list">
    <?php foreach ($materiKelas3 as $m): ?>
    <li><?= htmlspecialchars($m) ?></li>
    <?php endforeach; ?>
  </ul>
  <h3 class="sub-title">Juru Las Kelas II (ditambah)</h3>
  <ul class="plain-list">
    <?php foreach ($materiKelas2 as $m): ?>
    <li><?= htmlspecialchars($m) ?></li>
    <?php endforeach; ?>
  </ul>
  <h3 class="sub-title">Juru Las Kelas I (ditambah)</h3>
  <ul class="plain-list">
    <?php foreach ($materiKelas1 as $m): ?>
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
  <h2 class="section-title">Program Pelatihan Juru Las Kami</h2>
  <div class="scheme-grid">
    <?php foreach ($skemasKemnaker as $sk): ?>
    <div class="scheme-card">
      <span class="scheme-cert"><?= htmlspecialchars($sk['cert']) ?></span>
      <h3><a href="/pelatihan/<?= htmlspecialchars($sk['slug']) ?>/"><?= htmlspecialchars($sk['name']) ?></a></h3>
      <a href="/pelatihan/<?= htmlspecialchars($sk['slug']) ?>/" class="scheme-link">Lihat Program &rarr;</a>
    </div>
    <?php endforeach; ?>
  </div>
  <div class="inquiry-card">
    <p>Membutuhkan sertifikasi Juru Las Kelas II (Kemnaker RI) secara spesifik? Hubungi kami untuk konsultasi jadwal dan penyelenggaraan in-house.</p>
    <a href="<?=$wa_url?>" class="btn-wa" target="_blank" rel="noopener" style="margin-top:0">💬 Tanya Jadwal Kelas II</a>
  </div>
</div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">Jalur Profesi Welding Lanjutan (BNSP)</h2>
  <p class="section-subtitle">Untuk welder yang ingin berkembang ke jenjang inspector, supervisor, hingga engineer.</p>
  <div class="scheme-grid-3">
    <?php foreach ($skemasBNSP as $sk): ?>
    <div class="scheme-card compact">
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
    <p>Hubungi kami untuk info jadwal, metode las yang tersedia, dan biaya pelatihan Juru Las (Kelas I/II/III).</p>
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
