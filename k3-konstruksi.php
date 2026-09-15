<?php
require_once __DIR__ . '/config.php';
$s = get_all_settings();
/**
 * k3-konstruksi.php
 * K3 Konstruksi hub page (Supervisor, Ahli Muda/Madya/Utama). Zero DB
 * dependency, modeled on k3-listrik.php.
 *
 * NOTE: verified Permen PU No. 05/PRT/M/2014 before writing. The real
 * regulation defines a 2-tier project classification (Potensi Bahaya
 * K3 Tinggi: dangerous work and/or >=100 workers and/or contract
 * value > Rp 100 miliar -> wajib Ahli K3 Konstruksi; Potensi Bahaya
 * K3 Rendah -> wajib Petugas/Supervisor K3 Konstruksi) — NOT the
 * 3-way Rp 10M/100M banded mapping to Muda/Madya/Utama that was
 * originally briefed. The Muda/Madya/Utama jenjang is a real,
 * separate BNSP/Kemnaker competency ladder (experience-based), not a
 * fixed project-value band defined by this specific regulation. The
 * "Dasar Hukum" section and FAQ #1 below reflect the corrected,
 * verified structure.
 *
 * Also: only 2 real training products exist in the catalog for this
 * topic — Supervisor K3 Konstruksi and Ahli Muda K3 Konstruksi (BNSP).
 * No Madya/Utama product page exists yet, so the "Program Pelatihan
 * Kami" section links those 2 real slugs plus a WhatsApp inquiry card
 * for Madya/Utama, rather than fabricating slugs.
 */
$wa_number = '628122969435';
$wa_msg = rawurlencode('Halo, saya ingin mendaftar pelatihan K3 Konstruksi (Supervisor/Ahli K3 Muda/Madya). Mohon info jadwal dan biaya?');
$wa_url = "https://wa.me/{$wa_number}?text={$wa_msg}";
$year = date('Y');

$compare = [
    ['aspek' => 'Level', 'sup' => 'Pelaksana lapangan', 'muda' => 'Junior Expert', 'madya' => 'Senior Expert', 'utama' => 'Chief Expert'],
    ['aspek' => 'Kebutuhan tipikal', 'sup' => 'Proyek potensi bahaya rendah', 'muda' => 'Proyek skala kecil-menengah', 'madya' => 'Proyek kompleksitas menengah-tinggi', 'utama' => 'Proyek skala besar/berisiko tinggi'],
    ['aspek' => 'Durasi', 'sup' => '±40 jam', 'muda' => '±40 jam', 'madya' => '±40 jam', 'utama' => '±40 jam'],
    ['aspek' => 'Pendidikan min.', 'sup' => 'SMA/SMK + pengalaman', 'muda' => 'D3/S1 Teknik', 'madya' => 'D3/S1 Teknik + 3 thn', 'utama' => 'S1 Teknik + 6 thn'],
    ['aspek' => 'Sertifikasi', 'sup' => 'Kemnaker RI', 'muda' => 'BNSP', 'madya' => 'BNSP', 'utama' => 'BNSP'],
];

$wajibIkut = [
    'Site manager dan project manager proyek konstruksi',
    'Safety officer di kontraktor dan subkontraktor',
    'Pengawas lapangan (foreman/mandor) yang mengelola pekerja konstruksi',
    'Konsultan pengawas yang ditunjuk oleh pemilik proyek',
    'Staf HSE di perusahaan konstruksi yang mengikuti tender pemerintah (LPSE)',
    'Kontraktor swasta yang ingin memenuhi syarat kualifikasi tender',
];

$syaratSup = [
    'Ijazah minimal SMA/SMK sederajat',
    'Pengalaman kerja di bidang konstruksi minimal 2 tahun',
    'Fotokopi KTP, pas foto 3×4 (4 lembar), fotokopi ijazah, surat keterangan kerja',
];
$syaratMuda = [
    'Ijazah minimal D3/S1 Teknik Sipil, Arsitektur, atau bidang relevan',
    'Fotokopi KTP, pas foto, ijazah, transkrip nilai',
];
$syaratMadya = [
    'S1 Teknik + pengalaman K3 Konstruksi minimal 3 tahun, atau lulus Ahli K3 Muda + 2 tahun pengalaman',
];
$syaratUtama = [
    'S1 Teknik + pengalaman K3 Konstruksi minimal 6 tahun, atau lulus Ahli K3 Madya + 3 tahun pengalaman',
];

$tujuan = [
    'Memahami regulasi K3 Konstruksi (Permenaker 1/1980 dan Permen PU 05/2014)',
    'Mengidentifikasi bahaya dan risiko di proyek konstruksi',
    'Menyusun Rencana K3 Kontrak (RK3K) sesuai standar pemerintah',
    'Mengelola SMK3 Konstruksi secara sistematis',
    'Melakukan inspeksi keselamatan scaffolding, alat berat, dan galian',
    'Menyusun laporan K3 dan investigasi kecelakaan konstruksi',
];

$materiSup = [
    'Regulasi K3 Konstruksi Indonesia',
    'Identifikasi bahaya dan penilaian risiko konstruksi (HIRARC)',
    'Keselamatan scaffolding, perancah, dan pekerjaan di ketinggian',
    'Keselamatan galian dan pekerjaan tanah',
    'Keselamatan pengangkatan (rigging) dan crane',
    'APD untuk konstruksi',
    'P3K dan tanggap darurat di proyek konstruksi',
    'Izin kerja (work permit) konstruksi',
];
$materiAhli = [
    'Sistem Manajemen K3 Konstruksi (SMK3-K)',
    'Rencana K3 Kontrak (RK3K) — format dan isi',
    'Audit K3 Konstruksi',
    'Investigasi kecelakaan konstruksi',
    'Pelaporan K3 kepada Dinas Ketenagakerjaan',
    'Standar internasional: OHSAS 18001 / ISO 45001 di konstruksi',
];

$metode = [
    'Pelatihan tatap muka di Yogyakarta',
    'In-house training di lokasi proyek (minimum 10 peserta)',
    'Sertifikasi Kemnaker RI / BNSP setelah ujian teori dan praktik',
];

$skemas = [
    ['name' => 'Supervisor K3 Konstruksi', 'cert' => 'Sertifikasi BNSP', 'slug' => 'supervisor-k3-konstruksi'],
    ['name' => 'Ahli Muda K3 Konstruksi', 'cert' => 'Sertifikasi BNSP', 'slug' => 'pelatihan-ahli-muda-k3-konstruksi-online'],
];

$terkait = [
    ['label' => 'Pelatihan K3 Ketinggian', 'url' => '/k3-ketinggian/'],
    ['label' => 'Pelatihan K3 Listrik', 'url' => '/k3-listrik/'],
    ['label' => 'Panduan Lengkap K3', 'url' => '/keselamatan-kerja/'],
    ['label' => 'Sertifikasi BNSP', 'url' => '/sertifikasi-bnsp/'],
];

$faqs = [
    ['q' => 'Apakah wajib ada Ahli K3 Konstruksi di setiap proyek pemerintah?', 'a' => 'Ya. Berdasarkan Permen PU No. 05/PRT/M/2014, proyek konstruksi dengan potensi bahaya K3 tinggi — yaitu pekerjaan berbahaya, dan/atau mempekerjakan 100 pekerja atau lebih, dan/atau bernilai kontrak di atas Rp 100 miliar — wajib memiliki Ahli K3 Konstruksi. Proyek dengan potensi bahaya rendah cukup memiliki Petugas/Supervisor K3 Konstruksi.'],
    ['q' => 'Apakah sertifikat K3 Konstruksi diperlukan untuk ikut tender LPSE?', 'a' => 'Ya. Dokumen kualifikasi tender pekerjaan konstruksi pemerintah mensyaratkan tenaga ahli K3 Konstruksi bersertifikat sebagai salah satu syarat administrasi. Tanpa sertifikat ini, penawaran dapat digugurkan pada tahap evaluasi dokumen.'],
    ['q' => 'Berapa lama sertifikat K3 Konstruksi berlaku?', 'a' => 'Sertifikat K3 Konstruksi berlaku 3 tahun dan dapat diperpanjang melalui registrasi ulang dan pelatihan penyegaran.'],
    ['q' => 'Apa itu RK3K dan siapa yang wajib membuatnya?', 'a' => 'Rencana K3 Kontrak (RK3K) adalah dokumen perencanaan keselamatan kerja yang wajib disusun oleh penyedia jasa konstruksi sebelum memulai proyek. RK3K memuat identifikasi bahaya, rencana pengendalian risiko, prosedur tanggap darurat, dan anggaran K3 proyek.'],
    ['q' => 'Apakah Ahli K3 Konstruksi Muda bisa langsung naik ke Madya?', 'a' => 'Ya, dengan syarat: setelah lulus Ahli K3 Muda, minimal 2 tahun pengalaman kerja di bidang K3 Konstruksi, kemudian mengikuti pelatihan dan ujian Ahli K3 Madya.'],
    ['q' => 'Apa perbedaan Supervisor K3 Konstruksi dan Ahli K3 Konstruksi?', 'a' => 'Supervisor K3 Konstruksi bertugas di lapangan langsung — memastikan APD digunakan, menjalankan safety briefing harian, dan mengawasi pekerjaan berisiko. Ahli K3 Konstruksi bertugas di level manajemen — menyusun RK3K, mengaudit sistem K3, dan bertanggung jawab terhadap kepatuhan regulasi proyek secara keseluruhan.'],
];
?>
<?php
$page_title = 'Pelatihan K3 Konstruksi (Ahli K3 Muda, Madya & Supervisor) — Sertifikasi Kemnaker RI';
$meta_desc = 'Pelatihan K3 Konstruksi bersertifikat Kemnaker RI & BNSP. Program Ahli K3 Konstruksi Muda, Madya, dan Supervisor K3 Konstruksi. Wajib untuk proyek konstruksi. Yogyakarta & in-house. 0812-2969-435.';
require __DIR__ . '/includes/head.php';
?>
<script type="application/ld+json">
{"@context":"https://schema.org","@type":"BreadcrumbList","itemListElement":[
  {"@type":"ListItem","position":1,"name":"Beranda","item":"https://wahanatotalita.com/"},
  {"@type":"ListItem","position":2,"name":"Pelatihan","item":"https://wahanatotalita.com/pelatihan/"},
  {"@type":"ListItem","position":3,"name":"K3 Konstruksi","item":"https://wahanatotalita.com/k3-konstruksi/"}
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
.four-col{display:grid;grid-template-columns:repeat(4,1fr);gap:14px}
@media(max-width:900px){.four-col{grid-template-columns:repeat(2,1fr)}}
@media(max-width:640px){.four-col{grid-template-columns:1fr}}
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
    <div class="hero-badge">🏗️ K3 Konstruksi</div>
    <h1>Pelatihan K3 Konstruksi: Ahli K3 Muda, Madya &amp; Supervisor Bersertifikat Kemnaker RI</h1>
    <p class="hero-sub">Sertifikasi resmi Kemnaker RI &amp; BNSP sesuai Permenaker No. 1 Tahun 1980 dan Permen PU No. 05/PRT/M/2014.</p>
    <div><a href="<?=$wa_url?>" class="btn-wa" target="_blank" rel="noopener">💬 Konsultasi Jadwal &amp; Biaya</a></div>
  </div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">Apa itu K3 Konstruksi?</h2>
  <p class="intro-text">K3 Konstruksi adalah penerapan keselamatan dan kesehatan kerja pada proyek konstruksi bangunan, jalan, jembatan, bendungan, dan infrastruktur lainnya. Sektor konstruksi adalah industri dengan tingkat kecelakaan kerja fatal tertinggi di Indonesia — mencakup jatuh dari ketinggian, tertimpa material, terkena alat berat, dan runtuhnya struktur bangunan. Berdasarkan data BPJS Ketenagakerjaan, sektor konstruksi menyumbang lebih dari 32% kecelakaan kerja setiap tahun.</p>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">Dasar Hukum K3 Konstruksi</h2>
  <h3 class="sub-title">Permenaker No. 1 Tahun 1980 tentang K3 pada Konstruksi Bangunan</h3>
  <ul class="law-list">
    <li>Kewajiban penerapan K3 pada semua proyek konstruksi</li>
    <li>Standar keselamatan untuk scaffolding, galian, pengangkatan, dan pekerjaan di ketinggian</li>
    <li>Kewajiban penggunaan APD di area konstruksi</li>
  </ul>
  <h3 class="sub-title">Permen PU No. 05/PRT/M/2014 tentang SMK3 Konstruksi Bidang PU</h3>
  <ul class="law-list">
    <li>Wajib untuk semua proyek konstruksi yang didanai APBN/APBD</li>
    <li>Proyek berpotensi bahaya K3 tinggi — pekerjaan berbahaya, dan/atau ≥100 pekerja, dan/atau nilai kontrak di atas Rp 100 miliar — wajib memiliki Ahli K3 Konstruksi</li>
    <li>Proyek berpotensi bahaya K3 rendah wajib memiliki Petugas/Supervisor K3 Konstruksi</li>
    <li>Penyedia jasa yang tidak memiliki tenaga K3 Konstruksi tidak dapat mengikuti tender pemerintah</li>
  </ul>
  <p class="intro-text" style="margin-top:12px">Catatan: jenjang Ahli K3 Konstruksi (Muda, Madya, Utama) merupakan tingkatan kompetensi profesi berdasarkan pengalaman kerja sesuai skema sertifikasi BNSP/Kemnaker RI — proyek yang lebih besar dan kompleks umumnya mensyaratkan jenjang yang lebih tinggi sesuai ketentuan kualifikasi tender masing-masing instansi.</p>
</div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">Tingkatan Sertifikasi K3 Konstruksi</h2>
  <div class="compare-table-wrap">
  <table class="compare-table">
    <thead><tr><th>Aspek</th><th>Supervisor K3 Konstruksi</th><th>Ahli K3 Muda</th><th>Ahli K3 Madya</th><th>Ahli K3 Utama</th></tr></thead>
    <tbody>
      <?php foreach ($compare as $row): ?>
      <tr><td><?= htmlspecialchars($row['aspek']) ?></td><td><?= htmlspecialchars($row['sup']) ?></td><td><?= htmlspecialchars($row['muda']) ?></td><td><?= htmlspecialchars($row['madya']) ?></td><td><?= htmlspecialchars($row['utama']) ?></td></tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  </div>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">Siapa yang Wajib Ikut Pelatihan K3 Konstruksi?</h2>
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
  <div class="four-col">
    <div>
      <h3 class="sub-title">Supervisor K3 Konstruksi</h3>
      <ul class="plain-list">
        <?php foreach ($syaratSup as $s): ?>
        <li><?= htmlspecialchars($s) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div>
      <h3 class="sub-title">Ahli K3 Konstruksi Muda</h3>
      <ul class="plain-list">
        <?php foreach ($syaratMuda as $s): ?>
        <li><?= htmlspecialchars($s) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div>
      <h3 class="sub-title">Ahli K3 Konstruksi Madya</h3>
      <ul class="plain-list">
        <?php foreach ($syaratMadya as $s): ?>
        <li><?= htmlspecialchars($s) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div>
      <h3 class="sub-title">Ahli K3 Konstruksi Utama</h3>
      <ul class="plain-list">
        <?php foreach ($syaratUtama as $s): ?>
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
  <h3 class="sub-title">Supervisor K3 Konstruksi (±40 jam)</h3>
  <ul class="plain-list">
    <?php foreach ($materiSup as $m): ?>
    <li><?= htmlspecialchars($m) ?></li>
    <?php endforeach; ?>
  </ul>
  <h3 class="sub-title">Ahli K3 Konstruksi (±40 jam — ditambah)</h3>
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
  <h2 class="section-title">Program Pelatihan K3 Konstruksi Kami</h2>
  <div class="scheme-grid">
    <?php foreach ($skemas as $sk): ?>
    <div class="scheme-card">
      <span class="scheme-cert"><?= htmlspecialchars($sk['cert']) ?></span>
      <h3><a href="/pelatihan/<?= htmlspecialchars($sk['slug']) ?>/"><?= htmlspecialchars($sk['name']) ?></a></h3>
      <a href="/pelatihan/<?= htmlspecialchars($sk['slug']) ?>/" class="scheme-link">Lihat Program &rarr;</a>
    </div>
    <?php endforeach; ?>
  </div>
  <div class="inquiry-card">
    <p>Program Ahli K3 Konstruksi Madya dan Utama kami selenggarakan sesuai permintaan (in-house maupun kelompok). Hubungi kami untuk jadwal dan penawaran terbaru.</p>
    <a href="<?=$wa_url?>" class="btn-wa" target="_blank" rel="noopener" style="margin-top:0">💬 Tanya Jadwal Ahli K3 Madya/Utama</a>
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
    <p>Hubungi kami untuk info jadwal dan biaya pelatihan K3 Konstruksi Supervisor, Ahli Muda, atau Madya.</p>
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
