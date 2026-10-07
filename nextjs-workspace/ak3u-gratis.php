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
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Source Sans 3',system-ui,sans-serif;color:#1a1a2e;line-height:1.7;-webkit-font-smoothing:antialiased}
.container{max-width:900px;margin:0 auto;padding:0 20px}
.container-sm{max-width:680px;margin:0 auto;padding:0 20px}
.hero{background:linear-gradient(160deg,#0A4A2E 0%,#1a6b45 60%,#0d5535 100%);color:#fff;padding:64px 0 56px;position:relative;overflow:hidden;text-align:center}
.hero::before{content:'';position:absolute;inset:0;background:radial-gradient(circle at 15% 60%,rgba(198,98,28,.25),transparent 55%),radial-gradient(circle at 85% 20%,rgba(255,255,255,.07),transparent 40%)}
.hero::after{content:'';position:absolute;bottom:-1px;left:0;right:0;height:48px;background:linear-gradient(to bottom right,transparent 49%,#f5f5f2 50%)}
.hero .inner{position:relative;z-index:1}
.hero-badge{display:inline-flex;align-items:center;gap:6px;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.25);color:#fff;font-size:11px;font-weight:800;padding:6px 16px;border-radius:20px;text-transform:uppercase;letter-spacing:.08em;margin-bottom:20px}
.hero h1{font-size:clamp(1.6rem,4.5vw,2.5rem);font-weight:800;line-height:1.2;margin-bottom:14px;letter-spacing:-.02em}
.hero-sub{font-size:1rem;color:rgba(255,255,255,.85);max-width:600px;margin:0 auto}
.btn-wa{display:inline-flex;align-items:center;justify-content:center;gap:10px;background:#25D366;color:#fff;padding:16px 32px;border-radius:14px;font-size:16px;font-weight:800;text-decoration:none;box-shadow:0 6px 24px rgba(37,211,102,.4);margin-top:24px}
section{padding:48px 0;background:#f5f5f2}
section.white{background:#fff}
h2.section-title{font-size:1.5rem;font-weight:800;color:#111827;margin-bottom:20px;letter-spacing:-.02em}
.intro-text{font-size:15.5px;color:#374151;line-height:1.85;max-width:720px;margin:0 auto 8px}
.law-list{display:flex;flex-direction:column;gap:10px}
.law-item{background:#fff;border:1.5px solid #e5e7eb;border-radius:10px;padding:14px 18px}
.law-item strong{display:block;font-size:14.5px;color:#0A4A2E;margin-bottom:3px}
.law-item span{font-size:13.5px;color:#4b5563}
.quiz-list{display:flex;flex-direction:column;gap:14px}
.quiz-item{background:#fff;border:1.5px solid #e5e7eb;border-radius:12px;padding:18px 20px}
.quiz-item .q-num{font-weight:800;color:#0A4A2E;font-size:14px;margin-bottom:6px}
.quiz-item .q-text{font-size:14.5px;font-weight:600;color:#111827;margin-bottom:10px}
.quiz-item .q-opts{list-style:none;font-size:13.5px;color:#4b5563;line-height:1.9;margin-bottom:8px}
.quiz-item .q-ans{font-size:13px;font-weight:700;color:#0A4A2E;background:#f0fdf4;display:inline-block;padding:4px 12px;border-radius:20px}
.term-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:12px}
@media(max-width:640px){.term-grid{grid-template-columns:1fr}}
.term-card{background:#fff;border:1.5px solid #e5e7eb;border-radius:10px;padding:14px 16px}
.term-card strong{display:block;font-size:14px;color:#0A4A2E;margin-bottom:3px}
.term-card span{font-size:13px;color:#4b5563}
.faq-list{max-width:740px;margin:0 auto}
.faq-item{background:#fff;border:1.5px solid #e5e7eb;border-radius:12px;margin-bottom:.75rem;overflow:hidden}
.faq-q{width:100%;background:none;border:none;text-align:left;padding:16px 20px;font-family:inherit;font-size:15px;font-weight:700;color:#111827;cursor:pointer;display:flex;justify-content:space-between;align-items:center}
.faq-q:hover{background:#f9fafb}
.faq-q[aria-expanded="true"]{background:#0A4A2E;color:#fff}
.faq-arrow{transition:transform .3s}
.faq-q[aria-expanded="true"] .faq-arrow{transform:rotate(180deg)}
.faq-a{padding:0 20px;max-height:0;overflow:hidden;transition:max-height .3s ease,padding .3s;font-size:14.5px;color:#374151;line-height:1.75}
.faq-a.open{max-height:300px;padding:14px 20px 18px}
.final-cta{background:linear-gradient(135deg,#0A4A2E,#1a5e38);color:#fff;padding:56px 0;text-align:center}
.final-cta h2{font-size:1.8rem;font-weight:800;margin-bottom:10px}
.final-cta p{font-size:15px;color:rgba(255,255,255,.85)}
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
