<?php
require_once __DIR__ . '/config.php';
$s = get_all_settings();
/**
 * ak3u-gratis.php
 * Free K3 study guide + AK3U practice quiz — top-of-funnel SEO page.
 * Zero DB dependency, modeled on sertifikasi-bnsp.php.
 */
$wa_number = '6287759151278';
$wa_msg = rawurlencode('Halo, saya ingin tanya jadwal dan biaya pelatihan AK3U');
$wa_url = "https://wa.me/{$wa_number}?text={$wa_msg}";
$year = date('Y');

$dasarHukum = [
    ['title' => 'UU No. 1 Tahun 1970', 'desc' => 'Undang-undang dasar Keselamatan Kerja di Indonesia — payung hukum utama seluruh regulasi K3.'],
    ['title' => 'PP No. 50 Tahun 2012', 'desc' => 'Mengatur Penerapan Sistem Manajemen Keselamatan dan Kesehatan Kerja (SMK3) di perusahaan.'],
    ['title' => 'Permenaker No. 26 Tahun 2014', 'desc' => 'Mengatur penyelenggaraan penilaian penerapan SMK3 dan kompetensi K3 bidang kelistrikan.'],
    ['title' => 'Permenaker No. 4 Tahun 1987', 'desc' => 'Mengatur Panitia Pembina Keselamatan dan Kesehatan Kerja (P2K3) serta tata cara penunjukan Ahli K3.'],
    ['title' => 'Permenaker No. 13 Tahun 2025', 'desc' => 'Regulasi terbaru mengenai P2K3 yang memperbarui ketentuan sebelumnya sesuai perkembangan dunia kerja.'],
];

$quiz = [
    ['q' => 'Kepanjangan dari HIRARC adalah...', 'opt' => ['A. Hazard Identification, Risk Assessment and Risk Control', 'B. Health Inspection Rapid Action Response Center', 'C. Hazard Inspection Report and Risk Communication', 'D. Human Injury Rate and Risk Calculation'], 'ans' => 'A'],
    ['q' => 'Berapa jam kerja maksimal yang diperbolehkan lembur dalam sehari menurut regulasi ketenagakerjaan?', 'opt' => ['A. 2 jam', 'B. 3 jam', 'C. 4 jam', 'D. 6 jam'], 'ans' => 'C'],
    ['q' => 'APD yang wajib digunakan saat bekerja di ketinggian di atas 1,8 meter adalah...', 'opt' => ['A. Sarung tangan', 'B. Full body harness', 'C. Kacamata safety', 'D. Ear plug'], 'ans' => 'B'],
    ['q' => 'Near miss adalah istilah untuk...', 'opt' => ['A. Kecelakaan fatal', 'B. Kejadian yang hampir menyebabkan cedera namun tidak terjadi', 'C. Kerusakan alat berat', 'D. Pelanggaran administratif'], 'ans' => 'B'],
    ['q' => 'Skor risiko dalam matriks HIRARC dihitung dengan rumus...', 'opt' => ['A. Likelihood + Severity', 'B. Likelihood x Severity', 'C. Severity - Likelihood', 'D. Severity / Likelihood'], 'ans' => 'B'],
    ['q' => 'Batas waktu pelaporan kecelakaan kerja fatal ke Disnaker menurut Permenaker No. 3/1998 adalah...', 'opt' => ['A. 1x24 jam', 'B. 2x24 jam', 'C. 7 hari', 'D. 14 hari'], 'ans' => 'B'],
    ['q' => 'P2K3 wajib dibentuk oleh perusahaan dengan jumlah karyawan minimal...', 'opt' => ['A. 25 orang', 'B. 50 orang', 'C. 100 orang', 'D. 200 orang'], 'ans' => 'C'],
    ['q' => 'Tujuan utama dari Permit to Work (izin kerja) adalah...', 'opt' => ['A. Mempercepat pekerjaan', 'B. Memastikan pekerjaan berisiko tinggi dikendalikan sebelum dimulai', 'C. Mengurangi biaya proyek', 'D. Menambah jumlah pekerja'], 'ans' => 'B'],
    ['q' => 'Yang bukan merupakan elemen SMK3 menurut PP No. 50/2012 adalah...', 'opt' => ['A. Penetapan kebijakan K3', 'B. Perencanaan K3', 'C. Pemasaran produk', 'D. Peninjauan dan peningkatan kinerja'], 'ans' => 'C'],
    ['q' => 'LOTO dalam konteks K3 adalah singkatan dari...', 'opt' => ['A. Lock Out Tag Out', 'B. Level of Task Operation', 'C. Line of Total Output', 'D. Local Operational Training Order'], 'ans' => 'A'],
];

$istilah = [
    ['term' => 'HIRARC', 'def' => 'Metode identifikasi bahaya, penilaian, dan pengendalian risiko di tempat kerja.'],
    ['term' => 'JSA', 'def' => 'Job Safety Analysis — analisis keselamatan kerja per langkah pekerjaan.'],
    ['term' => 'APD', 'def' => 'Alat Pelindung Diri — perlengkapan yang melindungi pekerja dari bahaya spesifik.'],
    ['term' => 'P2K3', 'def' => 'Panitia Pembina Keselamatan dan Kesehatan Kerja di perusahaan.'],
    ['term' => 'SMK3', 'def' => 'Sistem Manajemen Keselamatan dan Kesehatan Kerja sesuai PP No. 50/2012.'],
    ['term' => 'Near Miss', 'def' => 'Kejadian yang hampir menyebabkan cedera atau kerugian, namun tidak terjadi.'],
    ['term' => 'Permit to Work', 'def' => 'Sistem izin kerja tertulis untuk pekerjaan berisiko tinggi.'],
    ['term' => 'SOP', 'def' => 'Standard Operating Procedure — prosedur kerja standar yang wajib diikuti.'],
    ['term' => 'TBM (Tool Box Meeting)', 'def' => 'Briefing K3 singkat sebelum pekerjaan dimulai, juga dikenal sebagai safety talk.'],
    ['term' => 'LOTO', 'def' => 'Lock Out Tag Out — prosedur isolasi energi sebelum perbaikan mesin.'],
];

$faqs = [
    ['q' => 'Di mana bisa belajar K3 secara gratis?', 'a' => 'Anda bisa mempelajari materi dasar K3 dari sumber resmi seperti BPJS Ketenagakerjaan dan Kemnaker RI, serta melalui panduan gratis di halaman ini sebagai persiapan awal sebelum mengikuti pelatihan resmi.'],
    ['q' => 'Apakah ada ujian K3 online gratis?', 'a' => 'BNSP menyediakan skema uji kompetensi resmi, namun pelatihan yang menjadi syarat mengikuti uji kompetensi tersebut tetap berbayar dan harus diselenggarakan oleh lembaga pelatihan yang terakreditasi.'],
    ['q' => 'Berapa biaya pelatihan AK3U resmi?', 'a' => 'Biaya bervariasi tergantung jenis sertifikasi (Kemnaker RI atau BNSP) dan format pelatihan (online/offline). Hubungi kami untuk mendapatkan penawaran biaya terbaru.'],
    ['q' => 'Apakah lulus belajar mandiri cukup untuk ujian AK3U?', 'a' => 'Tidak. Belajar mandiri dapat membantu pemahaman awal, namun pelatihan resmi dari lembaga terakreditasi wajib diikuti sebelum peserta dapat mengikuti ujian dan memperoleh sertifikasi AK3U yang sah.'],
];
?>
<?php
$page_title = 'Belajar K3 Gratis — Panduan & Simulasi Soal Ahli K3 Umum';
$meta_desc = 'Akses panduan belajar K3 gratis, kisi-kisi soal AK3U, dan materi dasar Keselamatan dan Kesehatan Kerja. Wahana Totalita Konsultan Yogyakarta.';
$page_css = array_merge($page_css ?? [], ['ak3u-gratis']);
require __DIR__ . '/includes/head.php';
?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ProfessionalService",
  "name": "Wahana Totalita Konsultan",
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
<?php require __DIR__ . '/includes/navbar.php'; ?>
<section class="hero">
  <div class="container inner">
    <div class="hero-badge">📚 Materi Gratis</div>
    <h1>Belajar K3 Gratis: Panduan &amp; Simulasi Soal AK3U</h1>
    <p class="hero-sub">Materi belajar K3 gratis sebagai bentuk komitmen kami terhadap peningkatan budaya keselamatan di Indonesia.</p>
    <div><a href="<?=$wa_url?>" class="btn-wa" target="_blank" rel="noopener">💬 Tanya Pelatihan Resmi</a></div>
  </div>
</section>

<section class="white">
<div class="container">
  <p class="intro-text">Kami menyediakan materi belajar K3 gratis sebagai bentuk komitmen kami terhadap peningkatan budaya keselamatan di Indonesia. Gunakan panduan ini sebagai persiapan sebelum mengikuti pelatihan resmi Ahli K3 Umum.</p>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">Dasar Hukum K3 yang Wajib Dikuasai</h2>
  <div class="law-list">
    <?php foreach ($dasarHukum as $l): ?>
    <div class="law-item"><strong><?= htmlspecialchars($l['title']) ?></strong><span><?= htmlspecialchars($l['desc']) ?></span></div>
    <?php endforeach; ?>
  </div>
</div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">10 Contoh Soal AK3U + Kunci Jawaban</h2>
  <div class="quiz-list">
    <?php foreach ($quiz as $i => $qz): ?>
    <div class="quiz-item">
      <div class="q-num">Soal #<?= $i+1 ?></div>
      <div class="q-text"><?= htmlspecialchars($qz['q']) ?></div>
      <ul class="q-opts">
        <?php foreach ($qz['opt'] as $o): ?><li><?= htmlspecialchars($o) ?></li><?php endforeach; ?>
      </ul>
      <span class="q-ans">Kunci Jawaban: <?= htmlspecialchars($qz['ans']) ?></span>
    </div>
    <?php endforeach; ?>
  </div>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">Istilah Penting dalam K3 yang Sering Muncul di Ujian</h2>
  <div class="term-grid">
    <?php foreach ($istilah as $t): ?>
    <div class="term-card"><strong><?= htmlspecialchars($t['term']) ?></strong><span><?= htmlspecialchars($t['def']) ?></span></div>
    <?php endforeach; ?>
  </div>
</div>
</section>

<section class="white">
<div class="container-sm">
  <h2 class="section-title" style="text-align:center">Pertanyaan yang Sering Ditanyakan</h2>
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
    <h2>Siap Ikut Pelatihan Resmi?</h2>
    <p>Hubungi kami untuk jadwal dan biaya pelatihan Ahli K3 Umum terbaru.</p>
    <a href="<?=$wa_url?>" class="btn-wa" target="_blank" rel="noopener">💬 Tanya Jadwal &amp; Biaya AK3U</a>
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
