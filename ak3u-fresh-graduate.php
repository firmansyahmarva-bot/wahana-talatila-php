<?php
require_once __DIR__ . '/config.php';
$s = get_all_settings();
/**
 * ak3u-fresh-graduate.php
 * SEO landing page targeting fresh-graduate queries about Ahli K3 Umum (AK3U).
 * Zero DB dependency, modeled on sertifikasi-bnsp.php.
 */
$wa_number = '628122969435';
$wa_msg = rawurlencode('Halo, saya fresh graduate dan ingin tanya tentang pelatihan Ahli K3 Umum');
$wa_url = "https://wa.me/{$wa_number}?text={$wa_msg}";
$year = date('Y');

$syarat = [
    'Fotokopi ijazah terakhir (minimal SMA/sederajat)',
    'Pas foto berwarna 3×4 (4 lembar)',
    'Fotokopi KTP yang masih berlaku',
    'Surat keterangan sehat dari dokter',
    'Tidak wajib memiliki pengalaman kerja — sesuai ketentuan Kemnaker RI dan PP No. 50 Tahun 2012',
];

$steps = [
    ['title' => 'Pendaftaran', 'desc' => 'Daftar dan lengkapi dokumen persyaratan melalui tim Wahana Totalita.'],
    ['title' => 'Pelatihan 12 Hari', 'desc' => 'Mengikuti pelatihan Ahli K3 Umum selama 12 hari kerja, mencakup teori dan praktik.'],
    ['title' => 'Ujian Tertulis', 'desc' => 'Ujian tertulis untuk menilai pemahaman regulasi dan konsep dasar K3.'],
    ['title' => 'Ujian Praktik / Wawancara', 'desc' => 'Wawancara dan penilaian praktik oleh pengawas dari Disnakertrans.'],
    ['title' => 'Penerbitan SK Kemnaker RI', 'desc' => 'Peserta yang dinyatakan lulus menerima Surat Keputusan Penunjukan sebagai Ahli K3 Umum dari Kemnaker RI.'],
];

$modul = [
    'Dasar-Dasar Keselamatan dan Kesehatan Kerja (K3)',
    'Teknik Inspeksi K3 di Tempat Kerja',
    'Investigasi dan Pelaporan Kecelakaan Kerja',
    'HIRARC — Identifikasi Bahaya, Penilaian, dan Pengendalian Risiko',
    'Sistem Izin Kerja (Permit to Work)',
    'Sistem Manajemen K3 (SMK3) sesuai PP No. 50 Tahun 2012',
    'Pertolongan Pertama pada Kecelakaan (P3K)',
    'Dokumentasi dan Pelaporan K3',
];

$faqs = [
    ['q' => 'Apakah fresh graduate bisa ikut AK3U?', 'a' => 'Ya. Kemnaker RI tidak mensyaratkan pengalaman kerja untuk mengikuti pelatihan dan ujian Ahli K3 Umum — fresh graduate dengan ijazah minimal SMA/sederajat dapat langsung mendaftar.'],
    ['q' => 'Berapa lama pelatihan AK3U?', 'a' => 'Pelatihan Ahli K3 Umum berlangsung selama 12 hari kerja, termasuk sesi teori, praktik, dan ujian.'],
    ['q' => 'Sertifikat AK3U berlaku berapa tahun?', 'a' => 'Sertifikat dan SK Ahli K3 Umum berlaku selama 3 tahun sejak diterbitkan, dan dapat diperpanjang melalui program Refreshing K3.'],
    ['q' => 'Apakah ada ujian setelah pelatihan?', 'a' => 'Ya. Peserta mengikuti ujian tertulis serta wawancara/penilaian praktik yang dilakukan oleh pengawas dari Disnakertrans setempat.'],
    ['q' => 'Apa perbedaan AK3U Kemnaker dan BNSP?', 'a' => 'AK3U Kemnaker RI menghasilkan Surat Keputusan resmi dari pemerintah, sedangkan sertifikasi BNSP mengacu pada skema kompetensi profesi. Keduanya diakui dan dihargai di dunia industri.'],
];
?>
<?php
$page_title = 'Cara Menjadi Ahli K3 Umum untuk Fresh Graduate';
$meta_desc = 'Fresh graduate bisa langsung ambil sertifikasi Ahli K3 Umum (AK3U) tanpa pengalaman kerja. Panduan lengkap syarat, proses, dan biaya pelatihan AK3U di Yogyakarta.';
require __DIR__ . '/includes/head.php';
?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ProfessionalService",
  "name": "Wahana Totalita Konsultan",
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
body{font-family:'Plus Jakarta Sans',system-ui,sans-serif;color:#1a1a2e;line-height:1.7;-webkit-font-smoothing:antialiased}
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
.check-list{list-style:none;display:flex;flex-direction:column;gap:10px}
.check-list li{background:#fff;border:1.5px solid #e5e7eb;border-radius:10px;padding:14px 18px;font-size:14.5px;color:#374151;display:flex;gap:10px}
.check-list li::before{content:'✓';color:#0A4A2E;font-weight:800;flex-shrink:0}
.steps{display:grid;gap:1rem}
.step-card{background:#fff;border-radius:16px;padding:18px 22px;border:1.5px solid #e5e7eb;display:flex;gap:16px;align-items:flex-start;box-shadow:0 2px 12px rgba(0,0,0,.05)}
.step-num{width:40px;height:40px;border-radius:50%;background:linear-gradient(135deg,#0A4A2E,#1a6b45);color:#fff;font-weight:800;font-size:16px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.step-body h3{font-size:14.5px;font-weight:700;color:#111827;margin-bottom:4px}
.step-body p{font-size:13.5px;color:#4b5563;line-height:1.6}
.modul-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:10px}
@media(max-width:640px){.modul-grid{grid-template-columns:1fr}}
.modul-item{background:#fff;border:1.5px solid #e5e7eb;border-radius:10px;padding:12px 16px;font-size:13.5px;font-weight:600;color:#111827;display:flex;gap:10px;align-items:flex-start}
.modul-item span{color:#C6621C;font-weight:800;flex-shrink:0}
.karir-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1rem}
@media(max-width:640px){.karir-grid{grid-template-columns:1fr}}
.karir-card{background:#fff;border:1.5px solid #e5e7eb;border-radius:12px;padding:18px;text-align:center}
.karir-card strong{display:block;font-size:1.1rem;color:#0A4A2E;margin-bottom:4px}
.karir-card span{font-size:12.5px;color:#6b7280}
.link-card{background:#fff;border:2px solid #0A4A2E;border-radius:14px;padding:20px 24px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;max-width:720px;margin:0 auto}
.link-card h3{font-size:15px;font-weight:700;color:#111827}
.link-card a.btn-link{background:#0A4A2E;color:#fff;padding:10px 20px;border-radius:8px;font-weight:700;font-size:13.5px;text-decoration:none}
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
    <div class="hero-badge">🎓 Panduan Fresh Graduate</div>
    <h1>Ahli K3 Umum untuk Fresh Graduate: Bisa Langsung Ikut?</h1>
    <p class="hero-sub">Banyak fresh graduate bertanya apakah mereka bisa mengambil sertifikasi AK3U tanpa pengalaman kerja. Jawabannya: bisa.</p>
    <div><a href="<?=$wa_url?>" class="btn-wa" target="_blank" rel="noopener">💬 Tanya Jadwal Pelatihan</a></div>
  </div>
</section>

<section class="white">
<div class="container">
  <p class="intro-text">Banyak fresh graduate bertanya apakah mereka bisa mengambil sertifikasi Ahli K3 Umum (AK3U) tanpa pengalaman kerja. Jawabannya: bisa. Kemnaker RI tidak mensyaratkan pengalaman kerja untuk mengikuti pelatihan dan ujian Ahli K3 Umum. Yang diperlukan adalah ijazah minimal SMA/D3/S1 dan komitmen untuk belajar selama 12 hari pelatihan penuh.</p>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">Syarat Mengikuti Pelatihan AK3U</h2>
  <ul class="check-list">
    <?php foreach ($syarat as $s): ?>
    <li><?= htmlspecialchars($s) ?></li>
    <?php endforeach; ?>
  </ul>
</div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">Proses Sertifikasi AK3U Langkah demi Langkah</h2>
  <div class="steps">
    <?php foreach ($steps as $i => $s): ?>
    <div class="step-card">
      <div class="step-num"><?= $i+1 ?></div>
      <div class="step-body"><h3><?= htmlspecialchars($s['title']) ?></h3><p><?= htmlspecialchars($s['desc']) ?></p></div>
    </div>
    <?php endforeach; ?>
  </div>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">Apa yang Dipelajari dalam Pelatihan AK3U?</h2>
  <div class="modul-grid">
    <?php foreach ($modul as $i => $m): ?>
    <div class="modul-item"><span><?= $i+1 ?>.</span> <?= htmlspecialchars($m) ?></div>
    <?php endforeach; ?>
  </div>
</div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">Prospek Karir Setelah AK3U</h2>
  <p class="intro-text">Lulusan Ahli K3 Umum banyak diserap oleh industri migas, konstruksi, manufaktur, dan pertambangan — termasuk perusahaan BUMN dan multinasional yang menjadi klien pelatihan kami. Kisaran gaji HSE Officer/Ahli K3 Umum pemula umumnya berada di rentang Rp 5-15 juta per bulan, tergantung sektor dan lokasi penempatan.</p>
  <div class="karir-grid" style="margin-top:20px">
    <div class="karir-card"><strong>Rp 5-15 Juta</strong><span>Kisaran gaji per bulan</span></div>
    <div class="karir-card"><strong>4 Sektor</strong><span>Migas, konstruksi, manufaktur, tambang</span></div>
    <div class="karir-card"><strong>BUMN &amp; Multinasional</strong><span>Termasuk klien pelatihan kami</span></div>
  </div>
</div>
</section>

<section>
<div class="container">
  <div class="link-card">
    <h3>📘 Lihat Program Pelatihan Ahli K3 Umum</h3>
    <a href="/pelatihan/pelatihan-ahli-k3-umum-fresh-graduate-kemnaker-online/" class="btn-link">Lihat Program &rarr;</a>
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
    <h2>Siap Memulai Karier K3 Anda?</h2>
    <p>Konsultasikan jadwal dan biaya pelatihan Ahli K3 Umum bersama tim kami.</p>
    <a href="<?=$wa_url?>" class="btn-wa" target="_blank" rel="noopener">💬 Tanya Pelatihan AK3U</a>
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
