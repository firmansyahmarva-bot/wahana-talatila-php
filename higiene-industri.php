<?php
require_once __DIR__ . '/config.php';
$s = get_all_settings();
/**
 * higiene-industri.php
 * Higiene Industri & Hiperkes hub page. Zero DB dependency, modeled
 * on juru-las.php.
 *
 * Real training slugs verified via catalog2026/real_trainings.json:
 * pelatihan-ahli-higiene-industri-muda-sertifikasi-bnsp (BNSP, Rp7.000.000)
 * pelatihan-ahli-higiene-industri-madya-sertifikasi-bnsp (BNSP, Rp8.500.000)
 * pelatihan-ahli-higiene-industri-utama-sertifikasi-bnsp (BNSP, Rp8.500.000)
 * pelatihan-higiene-industri-muda-himu-online (BNSP, Rp7.750.000)
 * pelatihan-higiene-industri-madya-hima-online (BNSP, Rp8.750.000)
 * pelatihan-ahli-muda-lingkungan-kerja-sertifikasi-kemnaker-ri (Kemnaker RI, Rp9.000.000)
 * No dedicated "Hiperkes Dokter/Paramedis" or standalone "Pengukuran
 * Kebisingan" product exists — WA-inquiry fallback used for those,
 * per the established gap-handling pattern.
 *
 * Permenaker No. 5/2018 WebSearch-verified: 85 dB(A)/8 jam NAB
 * kebisingan confirmed, and confirmed it replaces Permenaker 13/2011
 * as briefed. One accuracy addition (not a correction): the
 * regulation's scope is broader than "faktor fisika dan kimia" —
 * it covers 5 categories (fisika, kimia, biologi, ergonomi,
 * psikologi), noted in the Dasar Hukum section below.
 */
$wa_number = '628122969435';
$wa_msg = rawurlencode('Halo, saya ingin mendaftar pelatihan Higiene Industri / Hiperkes. Mohon info program dan jadwal yang tersedia.');
$wa_url = "https://wa.me/{$wa_number}?text={$wa_msg}";
$year = date('Y');

$faktorBahaya = [
    ['faktor' => 'Kebisingan', 'sumber' => 'Mesin produksi, kompresor, genset', 'nab' => '85 dB(A) / 8 jam', 'dampak' => 'Ketulian akibat kerja (NIHL)'],
    ['faktor' => 'Debu Respirable', 'sumber' => 'Penggerindaan, semen, silika, batubara', 'nab' => '3 mg/m³ (debu umum)', 'dampak' => 'Pneumokoniosis, silikosis'],
    ['faktor' => 'Bahan Kimia di Udara', 'sumber' => 'Pelarut, asam, logam berat', 'nab' => 'Per TLV masing-masing zat', 'dampak' => 'Keracunan organ, kanker'],
    ['faktor' => 'Suhu (ISBB)', 'sumber' => 'Dapur, peleburan logam, outdoor', 'nab' => '28°C (kerja berat)', 'dampak' => 'Heat stroke, kelelahan panas'],
    ['faktor' => 'Getaran', 'sumber' => 'Gerinda tangan, kendaraan, bor', 'nab' => '5 m/s² (tangan-lengan)', 'dampak' => 'HAVS, kerusakan sendi'],
    ['faktor' => 'Pencahayaan', 'sumber' => 'Ruang kerja, gudang', 'nab' => '300 lux (kerja halus)', 'dampak' => 'Kelelahan mata, kecelakaan'],
    ['faktor' => 'Radiasi UV', 'sumber' => 'Las busur, sinar matahari outdoor', 'nab' => 'Per ACGIH TLV', 'dampak' => 'Katarak, kanker kulit'],
];

$programInfo = [
    ['t' => 'Ahli Higiene Industri', 'd' => 'Kompetensi identifikasi, pengukuran, dan pengendalian bahaya lingkungan kerja jenjang Muda, Madya, Utama.', 'slug' => 'pelatihan-ahli-higiene-industri-muda-sertifikasi-bnsp', 'cert' => 'Sertifikasi BNSP'],
    ['t' => 'Hiperkes untuk Dokter Perusahaan', 'd' => 'Kompetensi kedokteran kerja wajib bagi dokter yang bertugas di klinik perusahaan.', 'slug' => null, 'cert' => null],
    ['t' => 'Hiperkes untuk Paramedis / Perawat Perusahaan', 'd' => 'Kompetensi wajib bagi perawat/bidan yang bertugas di klinik perusahaan.', 'slug' => null, 'cert' => null],
    ['t' => 'Pengukuran dan Pengendalian Kebisingan', 'd' => 'Teknik pengukuran kebisingan dengan Sound Level Meter dan program konservasi pendengaran.', 'slug' => null, 'cert' => null],
    ['t' => 'Pengukuran Kualitas Udara Tempat Kerja', 'd' => 'Sampling dan analisis debu, gas, dan uap bahan kimia di lingkungan kerja.', 'slug' => null, 'cert' => null],
];

$wajibIkut = [
    'HSE Officer yang bertanggung jawab atas program kesehatan kerja',
    'Dokter dan perawat perusahaan (wajib Hiperkes sesuai Permenaker 01/1976 dan 01/1979)',
    'Petugas K3 di pabrik yang terpapar kebisingan, debu, atau bahan kimia',
    'Laboratorium atau PJK3 yang melakukan jasa pengukuran lingkungan kerja',
    'Manajer HR yang mengelola program MCU (Medical Check-Up) dan PAK',
];

$tujuan = [
    'Memahami Permenaker 5/2018 dan nilai ambang batas (NAB) faktor fisika dan kimia',
    'Mengidentifikasi bahaya higiene industri di tempat kerja: anticipation → recognition',
    'Melakukan pengukuran kebisingan, debu, kimia, suhu, dan pencahayaan dengan instrumen yang benar',
    'Mengevaluasi hasil pengukuran terhadap NAB dan regulasi',
    'Merekomendasikan pengendalian bahaya: eliminasi, substitusi, engineering control, APD',
    'Menyusun laporan pengukuran lingkungan kerja untuk Disnaker',
];

$modul = [
    ['t' => 'Modul 1 — Dasar Higiene Industri', 'items' => [
        'Sejarah dan ruang lingkup Higiene Industri',
        'Regulasi: Permenaker 5/2018, UU 1/1970, Kepmenaker 187/1999',
        'Konsep anticipation, recognition, evaluation, control (AREC)',
        'Penyakit Akibat Kerja (PAK): klasifikasi, pelaporan, kompensasi BPJSTK',
    ]],
    ['t' => 'Modul 2 — Bahaya Fisika', 'items' => [
        'Kebisingan: pengukuran dengan Sound Level Meter dan dosimeter, TWA calculation, hearing conservation program',
        'Getaran: hand-arm vibration syndrome (HAVS), whole-body vibration',
        'Suhu lingkungan: ISBB (Indeks Suhu Bola Basah), kerja di panas dan dingin',
        'Pencahayaan: lux meter, standar pencahayaan per jenis pekerjaan',
        'Radiasi non-ionisasi: UV, inframerah, gelombang mikro',
    ]],
    ['t' => 'Modul 3 — Bahaya Kimia', 'items' => [
        'Klasifikasi bahan kimia berbahaya di udara',
        'Teknik sampling: personal sampling vs area sampling',
        'Alat sampling: impinger, filter cassette, charcoal tube, ORBO tube',
        'Analisis laboratorium: kromatografi, spektrofotometri',
        'IDLH, TLV-TWA, TLV-STEL — pengertian dan penerapan',
    ]],
    ['t' => 'Modul 4 — Pengendalian Bahaya', 'items' => [
        'Hirarki pengendalian: eliminasi → substitusi → engineering → APD',
        'Ventilasi industri: LEV (Local Exhaust Ventilation) dan dilution ventilation',
        'Hearing conservation program: audiometri baseline dan periodik',
        'Program monitoring biologis (biological monitoring)',
    ]],
    ['t' => 'Modul 5 — Pengukuran dan Pelaporan', 'items' => [
        'Perencanaan survei higiene industri',
        'Teknik sampling yang valid: jumlah sampel, durasi, lokasi',
        'Interpretasi hasil dan perbandingan dengan NAB',
        'Format laporan pengukuran lingkungan kerja (Permenaker 5/2018)',
        'Praktik: pengukuran kebisingan dan pencahayaan langsung',
    ]],
];

$metode = [
    'Pelatihan tatap muka di Yogyakarta — termasuk praktik penggunaan Sound Level Meter, Lux Meter, dan alat sampling udara',
    'In-house training di fasilitas perusahaan (minimum 10 peserta)',
    'Sertifikasi Kemnaker RI/BNSP diterbitkan setelah lulus ujian teori dan praktik',
];

$skemas = [
    ['name' => 'Pelatihan Ahli Higiene Industri Muda', 'cert' => 'Sertifikasi BNSP', 'slug' => 'pelatihan-ahli-higiene-industri-muda-sertifikasi-bnsp'],
    ['name' => 'Pelatihan Ahli Higiene Industri Madya', 'cert' => 'Sertifikasi BNSP', 'slug' => 'pelatihan-ahli-higiene-industri-madya-sertifikasi-bnsp'],
    ['name' => 'Pelatihan Ahli Higiene Industri Utama', 'cert' => 'Sertifikasi BNSP', 'slug' => 'pelatihan-ahli-higiene-industri-utama-sertifikasi-bnsp'],
    ['name' => 'Pelatihan Higiene Industri Muda (HIMU)', 'cert' => 'Sertifikasi BNSP', 'slug' => 'pelatihan-higiene-industri-muda-himu-online'],
    ['name' => 'Pelatihan Higiene Industri Madya (HIMA)', 'cert' => 'Sertifikasi BNSP', 'slug' => 'pelatihan-higiene-industri-madya-hima-online'],
    ['name' => 'Pelatihan Ahli Muda Lingkungan Kerja', 'cert' => 'Sertifikasi KEMNAKER RI', 'slug' => 'pelatihan-ahli-muda-lingkungan-kerja-sertifikasi-kemnaker-ri'],
];

$terkait = [
    ['label' => 'Pelatihan K3 Kimia', 'url' => '/k3-kimia/'],
    ['label' => 'SMK3 & ISO 45001', 'url' => '/smk3/'],
    ['label' => 'Panduan Lengkap K3', 'url' => '/keselamatan-kerja/'],
    ['label' => 'Sertifikasi BNSP', 'url' => '/sertifikasi-bnsp/'],
];

$faqs = [
    ['q' => 'Apa beda Higiene Industri dengan K3 secara umum?', 'a' => 'K3 secara umum berfokus pada pencegahan kecelakaan (accident prevention). Higiene Industri berfokus pada pencegahan penyakit akibat kerja (PAK) yang timbul dari paparan jangka panjang terhadap bahaya kimia, fisika, dan biologi — yang sering tidak terasa akut tapi merusak kesehatan selama bertahun-tahun. Keduanya merupakan bagian dari sistem EHS yang komprehensif.'],
    ['q' => 'Apa itu NAB dan mengapa penting?', 'a' => 'NAB (Nilai Ambang Batas) adalah konsentrasi atau intensitas faktor bahaya di lingkungan kerja yang dianggap masih aman untuk paparan 8 jam/hari selama 40 jam/minggu. Jika pengukuran menunjukkan paparan di atas NAB, perusahaan wajib mengambil tindakan pengendalian. Permenaker 5/2018 menetapkan NAB untuk faktor fisika, kimia, biologi, ergonomi, dan psikologi di tempat kerja.'],
    ['q' => 'Seberapa sering pengukuran lingkungan kerja wajib dilakukan?', 'a' => 'Permenaker 5/2018 tidak menetapkan frekuensi tunggal — tergantung jenis bahaya dan hasil pengukuran sebelumnya. Umumnya: minimal setahun sekali untuk area dengan potensi paparan. Jika hasil mendekati atau melebihi NAB, frekuensi harus ditingkatkan dan tindakan pengendalian segera dilakukan.'],
    ['q' => 'Apakah dokter perusahaan wajib ikut Hiperkes?', 'a' => 'Ya. Permenaker No. PER.01/MEN/1976 mewajibkan setiap dokter yang bekerja di perusahaan untuk memiliki sertifikat Hiperkes. Tanpa sertifikat ini, dokter tidak dapat menjalankan fungsi kedokteran kerja secara legal — termasuk menandatangani hasil MCU dan menetapkan diagnosis PAK.'],
    ['q' => 'Apakah perusahaan kecil perlu mengukur kebisingan?', 'a' => 'Ya, jika area kerjanya bising. Permenaker 5/2018 tidak membedakan skala perusahaan. Bengkel kecil dengan gerinda atau kompresor bisa mengekspos karyawannya pada kebisingan di atas 85 dB — melebihi NAB. Paparan selama 5-10 tahun dapat menyebabkan ketulian permanen yang menjadi tanggung jawab perusahaan.'],
    ['q' => 'Apa itu HAVS dan siapa yang berisiko?', 'a' => 'HAVS (Hand-Arm Vibration Syndrome) adalah penyakit akibat paparan getaran tangan-lengan jangka panjang — dari gerinda, bor, gergaji rantai, atau kendaraan. Gejala: Raynaud\'s phenomenon (jari memutih saat dingin), mati rasa, nyeri sendi. Berisiko: operator gerinda, tukang las, operator chainsaw, pengemudi alat berat. Tidak bisa disembuhkan — hanya bisa dicegah dengan mengurangi waktu paparan.'],
];
?>
<?php
$page_title = 'Pelatihan Higiene Industri & Hiperkes — Pengukuran NAB & Sertifikasi Kemnaker RI';
$meta_desc = 'Pelatihan Higiene Industri dan Hiperkes bersertifikat Kemnaker RI. Program Ahli Higiene Industri, pengukuran NAB kebisingan, debu, kimia, dan pencahayaan sesuai Permenaker No. 5 Tahun 2018. 0812-2969-435.';
require __DIR__ . '/includes/head.php';
?>
<script type="application/ld+json">
{"@context":"https://schema.org","@type":"BreadcrumbList","itemListElement":[
  {"@type":"ListItem","position":1,"name":"Beranda","item":"https://wahanatotalita.com/"},
  {"@type":"ListItem","position":2,"name":"Pelatihan","item":"https://wahanatotalita.com/pelatihan/"},
  {"@type":"ListItem","position":3,"name":"Higiene Industri","item":"https://wahanatotalita.com/higiene-industri/"}
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
.compare-table{width:100%;border-collapse:collapse;background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 2px 12px rgba(0,0,0,.05);min-width:640px}
.info-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:14px}
@media(max-width:900px){.info-grid{grid-template-columns:1fr}}
.info-card{background:#fff;border:1.5px solid #e5e7eb;border-radius:12px;padding:16px 18px}
.info-card h3{font-size:14.5px;font-weight:700;color:#0A4A2E;margin-bottom:6px}
.info-card p{font-size:13px;color:#4b5563;margin-bottom:8px}
.info-card .no-slug{font-size:12px;color:#C6621C;font-weight:700}
.module-grid{display:flex;flex-direction:column;gap:14px}
.module-card{background:#fff;border:1.5px solid #e5e7eb;border-radius:12px;padding:18px 20px}
.module-card h3{font-size:14.5px;font-weight:700;color:#0A4A2E;margin-bottom:10px}
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
    <div class="hero-badge">🔬 Higiene Industri</div>
    <h1>Pelatihan Higiene Industri dan Hiperkes — Pengukuran NAB Bersertifikat Kemnaker RI</h1>
    <p class="hero-sub">Sertifikasi resmi Kemnaker RI/BNSP sesuai Permenaker No. 5 Tahun 2018.</p>
    <div><a href="<?=$wa_url?>" class="btn-wa" target="_blank" rel="noopener">💬 Konsultasi Jadwal &amp; Biaya</a></div>
  </div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">Apa itu Higiene Industri?</h2>
  <p class="intro-text">Higiene Industri (Industrial Hygiene) adalah ilmu yang mengidentifikasi, mengukur, mengevaluasi, dan mengendalikan bahaya lingkungan kerja yang dapat menyebabkan penyakit akibat kerja (PAK) — bukan kecelakaan fisik, melainkan gangguan kesehatan jangka panjang. Bahaya yang diukur: kebisingan (noise), debu industri, bahan kimia di udara, getaran, pencahayaan, suhu ekstrem, dan radiasi non-ionisasi. Di Indonesia, Higiene Industri dipadukan dengan Hiperkes (Higiene Perusahaan dan Kesehatan Kerja) — keduanya diatur oleh Permenaker No. 5 Tahun 2018.</p>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">Dasar Hukum — Permenaker No. 5 Tahun 2018</h2>
  <ul class="law-list">
    <li>Menggantikan Permenaker 13/2011 tentang NAB Faktor Fisika dan Kimia</li>
    <li>Mewajibkan pengukuran faktor bahaya lingkungan kerja secara berkala — mencakup 5 kategori: fisika, kimia, biologi, ergonomi, dan psikologi</li>
    <li>Menetapkan NAB (Nilai Ambang Batas) untuk berbagai faktor: kebisingan (85 dB untuk 8 jam), debu respirable, suhu ISBB, pencahayaan, getaran, radiasi UV</li>
    <li>Pengukuran wajib dilakukan oleh personel kompeten atau PJK3 bidang pemeriksaan/pengujian</li>
    <li>Hasil pengukuran wajib dilaporkan ke Disnaker setempat</li>
  </ul>
</div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">Faktor Bahaya Lingkungan Kerja yang Wajib Diukur</h2>
  <div class="compare-table-wrap">
  <table class="compare-table">
    <thead><tr><th>Faktor</th><th>Contoh Sumber</th><th>NAB/Standar</th><th>Dampak Kesehatan</th></tr></thead>
    <tbody>
      <?php foreach ($faktorBahaya as $row): ?>
      <tr><td><?= htmlspecialchars($row['faktor']) ?></td><td><?= htmlspecialchars($row['sumber']) ?></td><td><?= htmlspecialchars($row['nab']) ?></td><td><?= htmlspecialchars($row['dampak']) ?></td></tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  </div>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">Program Sertifikasi Higiene Industri</h2>
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
  <h2 class="section-title">Siapa yang Membutuhkan Pelatihan Ini?</h2>
  <ul class="plain-list">
    <?php foreach ($wajibIkut as $w): ?>
    <li><?= htmlspecialchars($w) ?></li>
    <?php endforeach; ?>
  </ul>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">Hiperkes untuk Dokter dan Paramedis Perusahaan</h2>
  <p class="intro-text">Berdasarkan Permenaker No. PER.01/MEN/1976 (dokter) dan No. PER.01/MEN/1979 (paramedis), setiap dokter dan perawat/bidan yang bekerja di perusahaan wajib mengikuti pelatihan Hiperkes. Sertifikat Hiperkes adalah syarat wajib untuk mendapatkan izin praktik di klinik perusahaan dan menjadi dasar pelaksanaan Medical Check-Up (MCU) karyawan.</p>
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
  <h2 class="section-title">Kurikulum — Ahli Higiene Industri (±40 jam)</h2>
  <div class="module-grid">
    <?php foreach ($modul as $m): ?>
    <div class="module-card">
      <h3><?= htmlspecialchars($m['t']) ?></h3>
      <ul class="plain-list">
        <?php foreach ($m['items'] as $item): ?>
        <li><?= htmlspecialchars($item) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <?php endforeach; ?>
  </div>
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
  <h2 class="section-title">Program Pelatihan Higiene Industri Kami</h2>
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
    <p>Hubungi kami untuk info program dan jadwal pelatihan Higiene Industri / Hiperkes.</p>
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
