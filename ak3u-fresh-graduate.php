<?php
require_once __DIR__ . '/config.php';
$s = get_all_settings();
/**
 * ak3u-fresh-graduate.php
 * SEO landing page targeting fresh-graduate queries about Ahli K3 Umum (AK3U).
 * Zero DB dependency, modeled on sertifikasi-bnsp.php.
 */
$wa_number = '6287759151278';
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
$page_css = array_merge($page_css ?? [], ['ak3u-fresh-graduate']);
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
