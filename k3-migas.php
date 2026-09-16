<?php
require_once __DIR__ . '/config.php';
$s = get_all_settings();
/**
 * k3-migas.php
 * K3 Migas hub page (Pengawas K3 Migas, H2S Safety). Zero DB
 * dependency, modeled on k3-pertambangan.php.
 *
 * CORRECTION FLAGGED TO USER: the brief's title/meta/H1 and several
 * body sections asserted "Sertifikasi Pusdiklat Migas Cepu" and that
 * Wahana Totalita is a "mitra resmi Pusdiklat Migas Cepu". No real
 * training product in catalog2026/real_trainings.json is Pusdiklat
 * Migas Cepu-certified — the real catalog only has BNSP-certified
 * "Pengawas K3 Migas" and "Penanganan Bahaya Gas H2S" products. The
 * site's own existing marketing (lp/k3-migas.php) deliberately avoids
 * naming Pusdiklat Migas Cepu, using generic "Sertifikat Resmi"
 * instead — a signal no confirmed partnership exists. Pusdiklat Migas
 * Cepu (now PPSDM Migas) itself is real and verified (WebSearch), and
 * IS the actual government body that issues these credentials in
 * Indonesia, so it is kept as factual regulatory/industry-landscape
 * context — but the specific "kami mitra resmi" / "sertifikat kami
 * diterbitkan oleh Pusdiklat Migas Cepu" claims were removed and
 * replaced with the verifiable BNSP certification the site actually
 * delivers. See report to user for full detail.
 */
$wa_number = '6287759151278';
$wa_msg = rawurlencode('Halo, saya ingin mendaftar pelatihan K3 Migas / Penanganan Bahaya Gas H2S. Mohon info jadwal dan biaya?');
$wa_url = "https://wa.me/{$wa_number}?text={$wa_msg}";
$year = date('Y');

$programTable = [
    ['program' => 'Pengawas K3 Industri Migas', 'otoritas' => 'BNSP (tersedia di Wahana Totalita)', 'sasaran' => 'Supervisor & pengawas fasilitas produksi/pengolahan'],
    ['program' => 'Penanganan Bahaya Gas H2S', 'otoritas' => 'BNSP (tersedia di Wahana Totalita)', 'sasaran' => 'Semua pekerja di area H2S'],
    ['program' => 'K3 Migas Permukaan (Operator)', 'otoritas' => 'PPSDM Migas Cepu / Ditjen Migas', 'sasaran' => 'Operator fasilitas produksi & pengolahan'],
    ['program' => 'K3 Migas Pemboran', 'otoritas' => 'PPSDM Migas Cepu / Ditjen Migas', 'sasaran' => 'Driller, toolpusher, rig crew'],
    ['program' => 'Penanggulangan Kebakaran Migas (bertingkat)', 'otoritas' => 'PPSDM Migas Cepu — sesuai Kepmenaker No. 267/2015', 'sasaran' => 'Anggota hingga fire chief / emergency commander'],
];

$wajibIkut = [
    'Operator ladang minyak, rig pengeboran, dan fasilitas pengolahan gas',
    'Teknisi pemeliharaan di kilang dan terminal BBM',
    'Anggota tim pemadam kebakaran (fire brigade) di fasilitas migas',
    'HSE Officer di perusahaan kontraktor migas (Pertamina, PHE, SKK Migas vendors)',
    'Karyawan baru yang akan ditempatkan di area migas (onshore maupun offshore)',
];

$syaratMigas = [
    'Ijazah minimal SMA/SMK sederajat (teknik diutamakan)',
    'Bekerja atau akan bekerja di fasilitas migas',
    'Fotokopi KTP, ijazah, pas foto 3×4 (4 lembar), surat keterangan sehat',
];

$tujuan = [
    'Memahami regulasi K3 Migas Indonesia dan standar internasional (API, NFPA)',
    'Mengidentifikasi bahaya spesifik migas: gas H₂S, hidrokarbon, tekanan tinggi',
    'Menerapkan prosedur keselamatan operasi pengeboran dan produksi',
    'Menggunakan SCBA (Self-Contained Breathing Apparatus) dan APD migas',
    'Menjalankan prosedur tanggap darurat: blowout, kebocoran gas, kebakaran kilang',
    'Memenuhi kompetensi dasar K3 Migas sesuai regulasi Ditjen Migas',
];

$materiMigas = [
    'Regulasi K3 Migas (UU 22/2001, PP 19/1973)',
    'Sifat dan bahaya hidrokarbon (flammability, toxicity)',
    'Bahaya gas H₂S: efek fisiologis, nilai ambang batas, detektor',
    'Sistem izin kerja (Permit to Work) di fasilitas migas',
    'Keselamatan pekerjaan panas (hot work) di area berbahaya',
    'Klasifikasi area berbahaya (hazardous area classification)',
    'APD khusus migas: FR clothing, SCBA, gas detector personal',
    'Prosedur tanggap darurat dan muster point',
];
$materiH2S = [
    'Sifat fisik dan kimia gas H₂S',
    'Nilai ambang batas dan efek fisiologis pada berbagai konsentrasi',
    'Penggunaan gas detector personal dan area monitor',
    'Prosedur evakuasi dan rescue di area terpapar H₂S',
    'Penggunaan SCBA dalam kondisi darurat H₂S',
];

$metode = [
    'Pelatihan tatap muka di Yogyakarta — termasuk praktik penggunaan alat pelindung dan simulasi tanggap darurat',
    'In-house training di fasilitas migas (minimum 10 peserta)',
    'Sertifikat BNSP diterbitkan setelah lulus ujian teori dan praktik',
];

$skemas = [
    ['name' => 'Pelatihan Pengawas K3 Industri Migas', 'cert' => 'Sertifikasi BNSP', 'slug' => 'pelatihan-pengawas-k3-industri-migas-sertifikasi-bnsp'],
    ['name' => 'Pelatihan Pengawas K3 Migas', 'cert' => 'Sertifikasi BNSP', 'slug' => 'pelatihan-pengawas-k3-migas-online'],
    ['name' => 'Pelatihan Penanganan Bahaya Gas H2S', 'cert' => 'Sertifikasi BNSP', 'slug' => 'pelatihan-penanganan-bahaya-gas-h2s-sertifikasi-bnsp'],
];

$terkait = [
    ['label' => 'Pelatihan K3 Kimia', 'url' => '/k3-kimia/'],
    ['label' => 'Pelatihan K3 Pertambangan', 'url' => '/k3-pertambangan/'],
    ['label' => 'Panduan Lengkap K3', 'url' => '/keselamatan-kerja/'],
    ['label' => 'Sertifikasi BNSP', 'url' => '/sertifikasi-bnsp/'],
];

$faqs = [
    ['q' => 'Apa bedanya sertifikasi K3 Migas dengan K3 Umum?', 'a' => 'K3 Umum (AK3U) dikeluarkan oleh Kemnaker RI dan berlaku lintas industri. Kompetensi K3 Migas lebih spesifik untuk industri minyak dan gas — mencakup bahaya khusus seperti gas H2S, tekanan tinggi, dan proses hidrokarbon. Untuk bekerja di fasilitas migas, sertifikasi K3 Migas jauh lebih relevan dan sering menjadi syarat wajib perusahaan.'],
    ['q' => 'Apa itu H₂S dan mengapa sangat berbahaya?', 'a' => 'H₂S (hidrogen sulfida) adalah gas beracun yang terbentuk secara alami dalam proses pembentukan minyak dan gas bumi. Pada konsentrasi 100 ppm sudah bisa menyebabkan kehilangan kesadaran dalam hitungan menit, dan pada 1000 ppm bisa fatal dalam satu kali tarikan nafas. Pekerja di area migas wajib memahami prosedur H₂S safety.'],
    ['q' => 'Apakah program K3 Migas bisa diselenggarakan di luar Cepu?', 'a' => 'Ya. Pelatihan K3 Migas bersertifikat BNSP dari Wahana Totalita dapat diselenggarakan di Yogyakarta maupun in-house di lokasi perusahaan Anda. Untuk kebutuhan sertifikasi resmi dari PPSDM Migas Cepu (Ditjen Migas ESDM) secara spesifik, kami dapat membantu konsultasi jalur pendaftarannya.'],
    ['q' => 'Berapa lama sertifikat K3 Migas berlaku?', 'a' => 'Sertifikat BNSP K3 Migas umumnya berlaku 3 tahun dan dapat diperpanjang melalui uji kompetensi ulang atau pelatihan penyegaran.'],
    ['q' => 'Apakah ada pelatihan K3 Migas untuk offshore (lepas pantai)?', 'a' => 'Program K3 Migas kami mencakup kompetensi dasar yang relevan untuk offshore, namun untuk sertifikasi khusus offshore (seperti BOSIET/HUET) kami sarankan menghubungi kami untuk koordinasi program yang tepat sesuai kebutuhan.'],
    ['q' => 'Perusahaan migas apa saja yang mensyaratkan sertifikat ini?', 'a' => 'Pertamina, PHE (Pertamina Hulu Energi), SKK Migas vendors, Medco Energi, Vico, dan hampir semua kontraktor EPC migas mensyaratkan kompetensi K3 Migas untuk karyawan di area operasional. Sertifikat BNSP diakui secara nasional dan menjadi salah satu bukti kompetensi yang dipertimbangkan perusahaan migas.'],
];
?>
<?php
$page_title = 'Pelatihan K3 Migas (Minyak dan Gas) — Sertifikasi BNSP & Kemnaker RI';
$meta_desc = 'Pelatihan K3 Minyak dan Gas bersertifikat BNSP & Kemnaker RI. Program Pengawas K3 Migas dan Penanganan Bahaya Gas H2S. Yogyakarta & in-house. 0877-5915-1278.';
require __DIR__ . '/includes/head.php';
?>
<script type="application/ld+json">
{"@context":"https://schema.org","@type":"BreadcrumbList","itemListElement":[
  {"@type":"ListItem","position":1,"name":"Beranda","item":"https://wahanatotalita.com/"},
  {"@type":"ListItem","position":2,"name":"Pelatihan","item":"https://wahanatotalita.com/pelatihan/"},
  {"@type":"ListItem","position":3,"name":"K3 Migas","item":"https://wahanatotalita.com/k3-migas/"}
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
.two-col{display:grid;grid-template-columns:repeat(2,1fr);gap:14px}
@media(max-width:640px){.two-col{grid-template-columns:1fr}}
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
    <div class="hero-badge">🛢️ K3 Migas</div>
    <h1>Pelatihan K3 Minyak dan Gas (Migas) — Sertifikasi BNSP &amp; Kemnaker RI</h1>
    <p class="hero-sub">Kompetensi K3 khusus industri migas: bahaya H2S, proses hidrokarbon, dan tanggap darurat kebakaran.</p>
    <div><a href="<?=$wa_url?>" class="btn-wa" target="_blank" rel="noopener">💬 Konsultasi Jadwal &amp; Biaya</a></div>
  </div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">Apa itu K3 Migas?</h2>
  <p class="intro-text">K3 Migas adalah penerapan keselamatan dan kesehatan kerja di industri minyak dan gas bumi — mencakup eksplorasi, pengeboran (drilling), produksi, pengolahan (refinery), transportasi pipa, dan distribusi BBM/LPG. Industri migas memiliki tingkat risiko ekstrem: kebakaran, ledakan, blowout, paparan gas H₂S beracun, dan tekanan tinggi. Di Indonesia, pengawasan K3 Migas dilakukan oleh Direktorat Jenderal Minyak dan Gas Bumi (Ditjen Migas) ESDM, terpisah dari pengawasan K3 Umum oleh Kemnaker.</p>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">Dasar Hukum K3 Migas</h2>
  <h3 class="sub-title">UU No. 22 Tahun 2001 tentang Minyak dan Gas Bumi</h3>
  <ul class="law-list">
    <li>Pasal 40: Badan usaha migas wajib menjamin keselamatan dan kesehatan kerja serta pengelolaan lingkungan hidup</li>
    <li>Pelanggaran ketentuan dapat berujung sanksi hingga pencabutan izin usaha</li>
  </ul>
  <h3 class="sub-title">PP No. 19 Tahun 1973 tentang Pengaturan dan Pengawasan Keselamatan Kerja di Bidang Pertambangan</h3>
  <ul class="law-list">
    <li>Mengatur standar keselamatan di instalasi pertambangan dan migas</li>
    <li>Menjadi dasar pengawasan keselamatan kerja sektor migas sebelum aturan turunan lain diterbitkan</li>
  </ul>
  <h3 class="sub-title">Kepmenaker No. 187/MEN/1999 tentang Pengendalian Bahan Kimia Berbahaya (BKB)</h3>
  <ul class="law-list">
    <li>Berlaku untuk fasilitas pengolahan dan penyimpanan bahan kimia berbahaya dalam proses migas</li>
  </ul>
  <h3 class="sub-title">Standar Internasional yang Menjadi Rujukan Industri</h3>
  <ul class="law-list">
    <li>API (American Petroleum Institute) standards</li>
    <li>NFPA (National Fire Protection Association)</li>
    <li>IOGP (International Association of Oil &amp; Gas Producers)</li>
  </ul>
</div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">Lanskap Sertifikasi K3 Migas di Indonesia</h2>
  <p class="section-subtitle">Gambaran umum jenis kompetensi K3 Migas dan lembaga yang menerbitkannya — bukan berarti seluruhnya tersedia langsung di Wahana Totalita (lihat bagian "Program Pelatihan Kami" di bawah untuk yang kami selenggarakan).</p>
  <div class="compare-table-wrap">
  <table class="compare-table">
    <thead><tr><th>Program</th><th>Otoritas Penerbit</th><th>Sasaran</th></tr></thead>
    <tbody>
      <?php foreach ($programTable as $row): ?>
      <tr><td><?= htmlspecialchars($row['program']) ?></td><td><?= htmlspecialchars($row['otoritas']) ?></td><td><?= htmlspecialchars($row['sasaran']) ?></td></tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  </div>
  <p class="intro-text" style="margin-top:12px">Catatan: Wahana Totalita menyelenggarakan pelatihan Pengawas K3 Migas dan Penanganan Bahaya Gas H2S bersertifikat BNSP secara langsung. Untuk sertifikasi resmi dari PPSDM Migas Cepu (Ditjen Migas ESDM) — seperti K3 Migas Permukaan/Pemboran atau Penanggulangan Kebakaran Migas bertingkat — kami dapat membantu konsultasi jalur pendaftaran sesuai kebutuhan Anda.</p>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">Siapa yang Wajib Ikut Pelatihan K3 Migas?</h2>
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
  <ul class="plain-list">
    <?php foreach ($syaratMigas as $s): ?>
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
  <h2 class="section-title">Kurikulum &amp; Silabus</h2>
  <div class="two-col">
    <div>
      <h3 class="sub-title">Pengawas K3 Migas (±40 jam)</h3>
      <ul class="plain-list">
        <?php foreach ($materiMigas as $m): ?>
        <li><?= htmlspecialchars($m) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div>
      <h3 class="sub-title">Penanganan Bahaya Gas H2S (±24 jam)</h3>
      <ul class="plain-list">
        <?php foreach ($materiH2S as $m): ?>
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
  <h2 class="section-title">Program Pelatihan K3 Migas Kami</h2>
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
    <p>Membutuhkan program Penanggulangan Kebakaran Migas atau sertifikasi PPSDM Migas Cepu secara spesifik? Hubungi kami untuk konsultasi kebutuhan dan jalur pendaftarannya.</p>
    <a href="<?=$wa_url?>" class="btn-wa" target="_blank" rel="noopener" style="margin-top:0">💬 Konsultasi Kebutuhan Sertifikasi</a>
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
    <p>Hubungi kami untuk info jadwal dan biaya pelatihan K3 Migas / Penanganan Bahaya Gas H2S.</p>
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
