<?php
require_once __DIR__ . '/config.php';
$s = get_all_settings();
/**
 * k3-ketinggian.php
 * K3 Bekerja pada Ketinggian hub page (Tingkat 1/2/3 - TKPK). Zero DB
 * dependency, modeled on k3-kimia.php.
 *
 * NOTE: no dedicated "K3 Ketinggian" training exists in the real
 * catalog (catalog2026/real_trainings.json) — unlike K3 Kimia, which
 * had 2 real matches. The closest real, verified match is
 * supervisor-k3-konstruksi (its curriculum explicitly covers bekerja
 * di ketinggian). The "Program Pelatihan Kami" section below links to
 * that real training plus a WhatsApp inquiry card instead of
 * fabricating Tingkat 1/2/3 product slugs that don't exist yet.
 */
$wa_number = '6287759151278';
$wa_msg = rawurlencode('Halo, saya ingin mendaftar pelatihan K3 Ketinggian (Tingkat 1/2/3). Mohon info jadwal dan biaya?');
$wa_url = "https://wa.me/{$wa_number}?text={$wa_msg}";
$year = date('Y');

$compare = [
    ['aspek' => 'Level', 't1' => 'Pelaksana dasar', 't2' => 'Pelaksana mandiri', 't3' => 'Pengawas senior'],
    ['aspek' => 'Boleh bekerja', 't1' => 'Di bawah pengawasan', 't2' => 'Mandiri', 't3' => 'Mandiri + supervisi'],
    ['aspek' => 'Boleh mengawasi', 't1' => 'Tidak', 't2' => 'Tingkat 1', 't3' => 'Tingkat 1 & 2'],
    ['aspek' => 'Durasi pelatihan', 't1' => '±40 jam', 't2' => '±40 jam', 't3' => '±40 jam'],
    ['aspek' => 'Prasyarat', 't1' => 'Tidak ada pengalaman wajib', 't2' => 'Lulus Tingkat 1', 't3' => 'Lulus Tingkat 2'],
    ['aspek' => 'Sertifikasi', 't1' => 'Kemnaker RI', 't2' => 'Kemnaker RI', 't3' => 'Kemnaker RI'],
];

$wajibIkut = [
    'Pekerja konstruksi yang bekerja di scaffolding, atap, atau struktur tinggi',
    'Teknisi telekomunikasi yang memanjat tower BTS',
    'Pekerja pemasangan atau pemeliharaan panel surya atap',
    'Pekerja gondola dan window cleaning gedung bertingkat',
    'Rigger dan scaffolder di industri minyak & gas',
    'HSE Officer yang bertanggung jawab atas area ketinggian',
];

$syaratT1 = [
    'Usia minimal 18 tahun',
    'Sehat jasmani dan rohani (surat keterangan dokter)',
    'Tidak ada riwayat fobia ketinggian (acrophobia)',
    'Fotokopi KTP, pas foto 3×4 (4 lembar), surat keterangan sehat',
];
$syaratT2 = [
    'Lulus pelatihan K3 Ketinggian Tingkat 1 (sertifikat asli)',
    'Pengalaman kerja di ketinggian minimal 1 tahun',
];
$syaratT3 = [
    'Lulus pelatihan K3 Ketinggian Tingkat 2 (sertifikat asli)',
    'Pengalaman kerja di ketinggian minimal 2 tahun',
];

$tujuan = [
    'Memahami regulasi K3 ketinggian sesuai Permenaker 9/2016',
    'Mengidentifikasi bahaya dan risiko jatuh dari ketinggian',
    'Menggunakan alat pelindung jatuh (harness, lanyard, anchor point) dengan benar',
    'Melakukan inspeksi peralatan sebelum penggunaan',
    'Menerapkan prosedur penyelamatan darurat (rescue) dari ketinggian',
    'Membuat Job Safety Analysis (JSA) untuk pekerjaan di ketinggian',
];

$materiT1 = [
    'Regulasi K3 Ketinggian (Permenaker 9/2016)',
    'Anatomi kecelakaan jatuh dari ketinggian',
    'Jenis-jenis bahaya kerja di ketinggian',
    'Sistem perlindungan jatuh: guardrail, safety net, personal fall arrest system (PFAS)',
    'Alat Pelindung Diri (APD) ketinggian: harness, lanyard, helmet, gloves',
    'Cara memakai dan memeriksa harness body (donning & doffing)',
    'Teknik akses tali dasar (rope access level 1)',
    'Prosedur darurat dan evakuasi sederhana',
];
$materiT2 = [
    'Perencanaan pekerjaan pada ketinggian',
    'Anchor points: jenis, kekuatan minimum, inspeksi',
    'Teknik scaffolding dan penggunaan tangga',
    'Pengawasan dan briefing keselamatan',
    'Job Safety Analysis (JSA) untuk area ketinggian',
    'Prosedur ijin kerja (work permit) untuk pekerjaan ketinggian',
];
$materiT3 = [
    'Manajemen program K3 ketinggian',
    'Audit dan inspeksi sistem perlindungan jatuh',
    'Investigasi insiden jatuh dari ketinggian',
    'Pelatihan dan kompetensi Tingkat 1 & 2',
    'Rescue plan: perencanaan dan simulasi penyelamatan',
];

$metode = [
    'Pelatihan tatap muka di Yogyakarta (termasuk praktik dengan harness & peralatan)',
    'In-house training di lokasi perusahaan (minimum 10 peserta) — alat praktik disediakan Wahana Totalita',
    'Sertifikasi Kemnaker RI diterbitkan setelah lulus ujian teori dan praktik',
];

$terkait = [
    ['label' => 'Pelatihan K3 Kimia', 'url' => '/k3-kimia/'],
    ['label' => 'Panduan Lengkap K3', 'url' => '/keselamatan-kerja/'],
    ['label' => 'Sertifikasi BNSP', 'url' => '/sertifikasi-bnsp/'],
    ['label' => 'Pelatihan Supervisor K3 Konstruksi', 'url' => '/pelatihan/supervisor-k3-konstruksi/'],
];

$faqs = [
    ['q' => 'Berapa ketinggian minimum yang termasuk "bekerja pada ketinggian" di Indonesia?', 'a' => 'Permenaker No. 9 Tahun 2016 mendefinisikan pekerjaan pada ketinggian sebagai pekerjaan yang dilakukan pada ketinggian 1,8 meter atau lebih dari permukaan tanah atau lantai tetap.'],
    ['q' => 'Apakah sertifikat K3 Ketinggian berlaku untuk semua industri?', 'a' => 'Ya. Sertifikasi Kemnaker RI berlaku di seluruh Indonesia untuk semua sektor yang melibatkan pekerjaan di ketinggian: konstruksi, telekomunikasi, pertambangan, minyak & gas, dan pemeliharaan gedung.'],
    ['q' => 'Berapa lama sertifikat K3 Ketinggian berlaku?', 'a' => 'Sertifikat K3 Ketinggian berlaku 3 tahun dan dapat diperpanjang melalui pelatihan penyegaran (refreshing).'],
    ['q' => 'Apakah wajib mengikuti Tingkat 1 sebelum Tingkat 2?', 'a' => 'Ya. Tingkatan bersifat progresif. Peserta harus menyelesaikan dan lulus Tingkat 1 terlebih dahulu sebelum dapat mendaftar Tingkat 2, dan demikian seterusnya.'],
    ['q' => 'Alat apa saja yang digunakan saat pelatihan praktik?', 'a' => 'Peserta akan berlatih menggunakan full body harness, shock-absorbing lanyard, karabiner, anchor sling, dan helmet. Semua alat disediakan Wahana Totalita selama sesi praktik.'],
    ['q' => 'Apakah bisa in-house di lokasi proyek kami?', 'a' => 'Ya, kami melayani in-house training K3 Ketinggian dengan minimum 10 peserta. Tim instruktur kami akan datang ke lokasi Anda lengkap dengan peralatan praktik.'],
];
?>
<?php
$page_title = 'Pelatihan K3 Bekerja pada Ketinggian (Tingkat 1, 2 & 3) — Sertifikasi Kemnaker RI';
$meta_desc = 'Pelatihan K3 Bekerja pada Ketinggian resmi bersertifikat Kemnaker RI. Program Tingkat 1, 2, dan 3 sesuai Permenaker No. 9 Tahun 2016. Yogyakarta & in-house. Hubungi: 0877-5915-1278.';
require __DIR__ . '/includes/head.php';
?>
<script type="application/ld+json">
{"@context":"https://schema.org","@type":"BreadcrumbList","itemListElement":[
  {"@type":"ListItem","position":1,"name":"Beranda","item":"https://wahanatotalita.com/"},
  {"@type":"ListItem","position":2,"name":"Pelatihan","item":"https://wahanatotalita.com/pelatihan/"},
  {"@type":"ListItem","position":3,"name":"K3 Ketinggian","item":"https://wahanatotalita.com/k3-ketinggian/"}
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
.compare-table th{background:#0A4A2E;color:#fff;padding:11px 12px;text-align:left;font-size:12.5px}
.compare-table td{padding:11px 12px;border-bottom:1px solid #f3f4f6;font-size:13px;color:#374151}
.two-col3{display:grid;grid-template-columns:1fr 1fr 1fr;gap:16px}
@media(max-width:768px){.two-col3{grid-template-columns:1fr}}
.inquiry-card{background:#fff;border:2px dashed #0A4A2E;border-radius:14px;padding:22px;text-align:center;max-width:520px;margin:0 auto}
.inquiry-card p{font-size:13.5px;color:#4b5563;margin-bottom:14px}
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
    <div class="hero-badge">🧗 K3 Ketinggian</div>
    <h1>Pelatihan K3 Bekerja pada Ketinggian: Sertifikasi Resmi Kemnaker RI (Tingkat 1, 2 &amp; 3)</h1>
    <p class="hero-sub">Sertifikasi resmi Kemnaker RI sesuai Permenaker No. 9 Tahun 2016 tentang Keselamatan dan Kesehatan Kerja dalam Pekerjaan pada Ketinggian.</p>
    <div><a href="<?=$wa_url?>" class="btn-wa" target="_blank" rel="noopener">💬 Konsultasi Jadwal &amp; Biaya</a></div>
  </div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">Apa itu K3 Bekerja pada Ketinggian?</h2>
  <p class="intro-text">Berdasarkan Permenaker No. 9 Tahun 2016, pekerjaan pada ketinggian didefinisikan sebagai pekerjaan yang dilakukan pada ketinggian 1,8 meter atau lebih di atas permukaan tanah atau lantai tetap. Risiko utama dari pekerjaan ini adalah terjatuh dari ketinggian (fall hazard) — salah satu penyebab kecelakaan kerja fatal terbesar di Indonesia, dengan data BPJS Ketenagakerjaan menunjukkan kecelakaan jatuh dari ketinggian menyumbang sekitar 18% dari total kematian akibat kecelakaan kerja yang diklaim.</p>
  <p class="intro-text">Industri yang paling terdampak regulasi ini meliputi konstruksi, telekomunikasi (pemasangan tower), minyak &amp; gas (rig, scaffold), pemeliharaan gedung bertingkat, pemasangan panel surya atap, dan pertambangan. Sertifikasi K3 Ketinggian di Indonesia — dikenal juga dengan istilah TKPK (Tenaga Kerja Pada Ketinggian) — dibagi menjadi tiga tingkatan progresif: Tingkat 1, Tingkat 2, dan Tingkat 3.</p>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">Dasar Hukum — Permenaker No. 9 Tahun 2016</h2>
  <p class="intro-text">Peraturan Menteri Ketenagakerjaan No. 9 Tahun 2016 tentang Keselamatan dan Kesehatan Kerja dalam Pekerjaan pada Ketinggian mengatur kewajiban dasar sebagai berikut:</p>
  <ul class="law-list">
    <li>Pasal 2: Pengusaha wajib menerapkan K3 dalam setiap pekerjaan pada ketinggian</li>
    <li>Pekerjaan pada ketinggian hanya boleh dilakukan oleh tenaga kerja yang telah mendapat pelatihan dan sertifikasi sesuai tingkatannya</li>
    <li>Pengusaha wajib menyediakan peralatan pelindung jatuh (fall protection) yang memenuhi standar</li>
    <li>Wajib ada petugas pengawas bekerja pada ketinggian di setiap lokasi kerja</li>
    <li>Sanksi ketidakpatuhan: penghentian pekerjaan dan denda administratif</li>
  </ul>
</div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">Tingkatan Sertifikasi K3 Ketinggian</h2>
  <table class="compare-table">
    <thead><tr><th>Aspek</th><th>Tingkat 1</th><th>Tingkat 2</th><th>Tingkat 3</th></tr></thead>
    <tbody>
      <?php foreach ($compare as $row): ?>
      <tr><td><?= htmlspecialchars($row['aspek']) ?></td><td><?= htmlspecialchars($row['t1']) ?></td><td><?= htmlspecialchars($row['t2']) ?></td><td><?= htmlspecialchars($row['t3']) ?></td></tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">Siapa yang Wajib Ikut Pelatihan K3 Ketinggian?</h2>
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
  <div class="two-col3">
    <div>
      <h3 class="sub-title">Tingkat 1 (Entry Level)</h3>
      <ul class="plain-list">
        <?php foreach ($syaratT1 as $s): ?>
        <li><?= htmlspecialchars($s) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div>
      <h3 class="sub-title">Tingkat 2</h3>
      <ul class="plain-list">
        <?php foreach ($syaratT2 as $s): ?>
        <li><?= htmlspecialchars($s) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div>
      <h3 class="sub-title">Tingkat 3</h3>
      <ul class="plain-list">
        <?php foreach ($syaratT3 as $s): ?>
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
  <h3 class="sub-title">Tingkat 1 (±40 jam)</h3>
  <ul class="plain-list">
    <?php foreach ($materiT1 as $m): ?>
    <li><?= htmlspecialchars($m) ?></li>
    <?php endforeach; ?>
  </ul>
  <h3 class="sub-title">Tingkat 2 (±40 jam — ditambah)</h3>
  <ul class="plain-list">
    <?php foreach ($materiT2 as $m): ?>
    <li><?= htmlspecialchars($m) ?></li>
    <?php endforeach; ?>
  </ul>
  <h3 class="sub-title">Tingkat 3 (±40 jam — ditambah)</h3>
  <ul class="plain-list">
    <?php foreach ($materiT3 as $m): ?>
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
  <h2 class="section-title">Program Pelatihan K3 Ketinggian Kami</h2>
  <div class="inquiry-card">
    <p>Program sertifikasi K3 Ketinggian Tingkat 1, 2, dan 3 kami selenggarakan sesuai permintaan (in-house maupun kelompok). Hubungi tim kami untuk jadwal terdekat dan penawaran, atau lihat <a href="/pelatihan/supervisor-k3-konstruksi/" style="color:#0A4A2E;font-weight:700">Pelatihan Supervisor K3 Konstruksi</a> kami yang turut mencakup materi bekerja di ketinggian.</p>
    <a href="<?=$wa_url?>" class="btn-wa" target="_blank" rel="noopener" style="margin-top:0">💬 Tanya Jadwal K3 Ketinggian</a>
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
    <p>Hubungi kami untuk info jadwal dan biaya pelatihan K3 Ketinggian Tingkat 1, 2, atau 3.</p>
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
