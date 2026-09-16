<?php
require_once __DIR__ . '/config.php';
$s = get_all_settings();
/**
 * sertifikasi-bnsp.php
 * Branded certification page — targets "wahana totalita" + "sertifikasi bnsp"
 * queries currently being captured by a third-party tag page (bnsp.net).
 * Zero DB dependency, modeled on perpanjangan-skp.php.
 */
$wa_number = '6287759151278';
$wa_konsul = rawurlencode('Halo, saya ingin konsultasi sertifikasi BNSP di Wahana Totalita');
$wa_konsul_url = "https://wa.me/{$wa_number}?text={$wa_konsul}";
$year = date('Y');

$skemas = [
    ['name' => 'Ahli K3 Umum', 'cert' => 'Sertifikasi BNSP', 'slug' => 'pelatihan-ahli-k3-umum-sertifikasi-bnsp'],
    ['name' => 'Ahli Muda K3 Konstruksi', 'cert' => 'Sertifikasi BNSP', 'slug' => 'pelatihan-ahli-muda-k3-konstruksi-online'],
    ['name' => 'Pengawas K3 Industri Migas', 'cert' => 'Sertifikasi BNSP', 'slug' => 'pelatihan-pengawas-k3-industri-migas-sertifikasi-bnsp'],
    ['name' => 'Operator Forklift Kelas 2', 'cert' => 'Sertifikasi Kemnaker RI', 'slug' => 'pelatihan-k3-operator-forklift-kelas-2-sertifikasi-kemnaker-ri'],
    ['name' => 'Petugas P3K', 'cert' => 'Sertifikasi BNSP', 'slug' => 'pelatihan-petugas-p3k-sertifikasi-bnsp'],
    ['name' => 'Auditor Sistem Manajemen K3', 'cert' => 'Sertifikasi BNSP', 'slug' => 'pelatihan-auditor-sistem-manajemen-k3-sertifikasi-bnsp'],
];

$faqs = [
    [
        'q' => 'Apakah Wahana Totalita terakreditasi resmi untuk sertifikasi BNSP?',
        'a' => 'Ya. Wahana Totalita Konsultan menyelenggarakan pelatihan dan uji kompetensi yang mengacu pada skema Badan Nasional Sertifikasi Profesi (BNSP) serta terdaftar sebagai lembaga pelatihan K3 yang diakui Kementerian Ketenagakerjaan RI (Kemnaker RI).',
    ],
    [
        'q' => 'Apa bedanya sertifikasi BNSP dan sertifikasi Kemnaker RI?',
        'a' => 'Sertifikasi BNSP dikeluarkan oleh Badan Nasional Sertifikasi Profesi berdasarkan skema kompetensi kerja nasional (SKKNI), sedangkan sertifikasi Kemnaker RI diterbitkan langsung oleh Kementerian Ketenagakerjaan untuk skema K3 tertentu seperti Ahli K3 Umum. Wahana Totalita menyelenggarakan pelatihan untuk kedua jalur sertifikasi ini sesuai kebutuhan peserta.',
    ],
    [
        'q' => 'Berapa lama proses sertifikasi BNSP di Wahana Totalita?',
        'a' => 'Secara umum proses berlangsung 3–5 hari kerja untuk pelatihan dan ujian, ditambah waktu penerbitan sertifikat resmi dari BNSP yang bervariasi tergantung skema. Tim kami membantu memantau proses hingga sertifikat diterima peserta.',
    ],
    [
        'q' => 'Apakah sertifikat BNSP dari Wahana Totalita berlaku di seluruh Indonesia?',
        'a' => 'Ya. Sertifikat BNSP dan Kemnaker RI yang diterbitkan setelah pelatihan di Wahana Totalita berlaku secara nasional di seluruh wilayah Indonesia, termasuk untuk keperluan tender pemerintah, proyek BUMN, dan persyaratan kerja di perusahaan swasta.',
    ],
    [
        'q' => 'Apakah pelatihan bisa dilakukan secara online atau harus tatap muka di Yogyakarta?',
        'a' => 'Tersedia kedua format — online via Zoom untuk peserta dari luar kota, maupun tatap muka langsung di kantor kami di Sleman, Yogyakarta. Kedua format menghasilkan sertifikat yang sama-sama resmi dan berlaku secara nasional.',
    ],
];
?>
<?php
$page_title = 'Sertifikasi & Uji Kompetensi BNSP di Wahana Totalita Konsultan Yogyakarta';
$meta_desc = 'Lembaga pelatihan K3 resmi bersertifikat BNSP dan Kemnaker RI. Uji kompetensi dan sertifikasi K3 di Yogyakarta sejak 2006. Konsultasi gratis 0877-5915-1278.';
require __DIR__ . '/includes/head.php';
?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ProfessionalService",
  "name": "Wahana Totalita Konsultan",
  "alternateName": "Wahana Totalita",
  "description": "Lembaga pelatihan dan uji kompetensi K3 bersertifikat BNSP dan terdaftar Kemnaker RI di Yogyakarta sejak 2006.",
  "url": "https://wahanatotalita.com/sertifikasi-bnsp/",
  "telephone": "+6287759151278",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Jl. Wonosari KM 8.5",
    "addressLocality": "Sleman",
    "addressRegion": "DIY",
    "addressCountry": "ID"
  },
  "areaServed": "Indonesia",
  "priceRange": "Rp"
}
</script>
<script type="application/ld+json">
<?php
$faqSchema = [
    '@context' => 'https://schema.org',
    '@type'    => 'FAQPage',
    'mainEntity' => array_map(function ($f) {
        return [
            '@type' => 'Question',
            'name'  => $f['q'],
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']],
        ];
    }, $faqs),
];
echo json_encode($faqSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
?>
</script>
<link rel="stylesheet" href="/assets/css/page/sector.css">
<style>
.container{max-width:900px;margin:0 auto;padding:0 20px}
/* NAV */
/* HERO */
.hero{background:linear-gradient(160deg,#0A4A2E 0%,#1a6b45 60%,#0d5535 100%);color:#fff;padding:64px 0 56px;position:relative;overflow:hidden;text-align:center}
.hero h1{font-size:clamp(1.8rem,5vw,2.8rem);font-weight:800;line-height:1.15;margin-bottom:14px;letter-spacing:-.025em}
.hero h1 em{color:#fb923c;font-style:normal}
.hero-sub{font-size:1.05rem;color:rgba(255,255,255,.85);margin-bottom:32px;max-width:560px;margin-inline:auto}
/* BUTTONS */
.btn-wa{display:inline-flex;align-items:center;justify-content:center;gap:10px;background:#25D366;color:#fff;padding:16px 32px;border-radius:14px;font-size:16px;font-weight:800;text-decoration:none;box-shadow:0 6px 24px rgba(37,211,102,.4);transition:transform .2s,box-shadow .2s;border:none;cursor:pointer}
.btn-wa:hover{transform:translateY(-3px);box-shadow:0 10px 32px rgba(37,211,102,.5)}
/* BODY SECTIONS */
section{padding:48px 0;background:#f5f5f2}
h2.section-title{font-size:1.6rem;font-weight:800;color:#111827;margin-bottom:8px;letter-spacing:-.02em;text-align:center}
.section-subtitle{font-size:15px;color:#6b7280;text-align:center;margin-bottom:32px}
/* CREDENTIALS GRID */
.cred-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:1rem}
@media(max-width:640px){.cred-grid{grid-template-columns:1fr}}
.cred-card{background:#fff;border:1.5px solid #e5e7eb;border-radius:14px;padding:20px 22px;display:flex;gap:14px;align-items:flex-start;box-shadow:0 2px 12px rgba(0,0,0,.05)}
.cred-icon{font-size:1.8rem;flex-shrink:0}
.cred-card h3{font-size:15px;font-weight:800;color:#111827;margin-bottom:4px}
.cred-card p{font-size:13.5px;color:#4b5563;line-height:1.6}
/* SCHEME GRID */
.scheme-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:1rem}
/* PROCESS STEPS */
.steps{display:grid;gap:1rem}
.step-card{background:#fff;border-radius:16px;padding:20px 24px;border:1.5px solid #e5e7eb;display:flex;gap:18px;align-items:flex-start;box-shadow:0 2px 12px rgba(0,0,0,.05);transition:border-color .2s,box-shadow .2s}
.step-card:hover{border-color:#0A4A2E;box-shadow:0 4px 20px rgba(10,74,46,.1)}
.step-num{width:44px;height:44px;border-radius:50%;background:linear-gradient(135deg,#0A4A2E,#1a6b45);color:#fff;font-weight:800;font-size:18px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.step-body h3{font-size:15px;font-weight:700;color:#111827;margin-bottom:4px}
.step-body p{font-size:13.5px;color:#4b5563;line-height:1.65}
/* FAQ */
.faq-list{max-width:740px;margin:0 auto}
.faq-q{width:100%;background:none;border:none;text-align:left;padding:16px 20px;font-family:inherit;font-size:15px;font-weight:700;color:#111827;cursor:pointer;display:flex;justify-content:space-between;align-items:center;transition:background .15s}
.faq-a{padding:0 20px;max-height:0;overflow:hidden;transition:max-height .3s ease,padding .3s;font-size:14.5px;color:#374151;line-height:1.75}
/* FINAL CTA */
.final-cta{background:linear-gradient(135deg,#0A4A2E,#1a5e38);color:#fff;padding:56px 0;text-align:center}
.final-cta h2{font-size:2rem;font-weight:800;margin-bottom:10px;letter-spacing:-.02em}
.final-cta p{font-size:16px;color:rgba(255,255,255,.85);margin-bottom:32px}
/* FOOTER */
.lp-footer a:hover{color:#fff}
@media(max-width:640px){
  .hero{padding:48px 0 44px}
  .hero h1{font-size:1.8rem}
}
</style>
<style id="wt-hero-height-fix-2026-07">
/* wt-hero-height-fix-2026-07: this page's own .hero is a small custom hero, not the
   homepage full-screen slideshow hero — cancel the global 100vh /
   flex-centering from style.css so it doesn't leak in here. */
.hero{min-height:auto!important;display:block!important}
</style>
<!-- TOP NAV -->
<?php require __DIR__ . '/includes/navbar.php'; ?>
<!-- HERO -->
<section class="hero">
  <div class="container inner">
    <div class="hero-badge">🏅 Lembaga Sertifikasi K3 Resmi</div>
    <h1>Sertifikasi <em>BNSP</em> &amp; Uji Kompetensi K3<br>di Wahana Totalita</h1>
    <p class="hero-sub">Lembaga pelatihan K3 resmi bersertifikat BNSP dan terdaftar Kemnaker RI, melayani perusahaan di seluruh Indonesia dari Yogyakarta sejak 2006.</p>
    <a href="<?=$wa_konsul_url?>" class="btn-wa" target="_blank" rel="noopener">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a6.47 6.47 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
      Konsultasi Sertifikasi BNSP
    </a>
  </div>
</section>

<!-- MENGAPA WAHANA TOTALITA -->
<section class="white">
<div class="container">
  <h2 class="section-title">Mengapa Wahana Totalita?</h2>
  <p class="section-subtitle">Lembaga pelatihan dan sertifikasi K3 dengan kredensial resmi dan rekam jejak nyata</p>
  <div class="cred-grid">
    <div class="cred-card">
      <div class="cred-icon">🏅</div>
      <div><h3>Terakreditasi BNSP</h3><p>Menyelenggarakan pelatihan dan uji kompetensi mengacu pada skema resmi Badan Nasional Sertifikasi Profesi (BNSP).</p></div>
    </div>
    <div class="cred-card">
      <div class="cred-icon">📋</div>
      <div><h3>Terdaftar Kemnaker RI</h3><p>Lembaga pelatihan K3 yang diakui Kementerian Ketenagakerjaan RI untuk skema sertifikasi seperti Ahli K3 Umum.</p></div>
    </div>
    <div class="cred-card">
      <div class="cred-icon">🏢</div>
      <div><h3>70+ Klien Korporat</h3><p>Dipercaya lebih dari 70 perusahaan lintas sektor — industri, konstruksi, energi, dan pertambangan — untuk pelatihan dan sertifikasi K3 karyawan.</p></div>
    </div>
    <div class="cred-card">
      <div class="cred-icon">📍</div>
      <div><h3>Berbasis di Yogyakarta</h3><p>Kantor kami di Jl. Wonosari KM 8.5, Sleman, Yogyakarta — melayani pelatihan tatap muka maupun online ke seluruh Indonesia sejak 2006.</p></div>
    </div>
  </div>
</div>
</section>

<!-- SKEMA SERTIFIKASI -->
<section>
<div class="container">
  <h2 class="section-title">Skema Sertifikasi yang Kami Selenggarakan</h2>
  <p class="section-subtitle">Pilih skema sesuai kebutuhan kompetensi K3 Anda</p>
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
</div>
</section>

<!-- PROSES SERTIFIKASI -->
<section class="white">
<div class="container-sm">
  <h2 class="section-title">Proses Sertifikasi</h2>
  <p class="section-subtitle">5 langkah dari pendaftaran hingga sertifikat resmi di tangan</p>
  <div class="steps">
    <div class="step-card"><div class="step-num">1</div><div class="step-body"><h3>Daftar</h3><p>Hubungi tim kami via WhatsApp untuk memilih skema sertifikasi yang sesuai kebutuhan Anda atau perusahaan.</p></div></div>
    <div class="step-card"><div class="step-num">2</div><div class="step-body"><h3>Pelatihan</h3><p>Ikuti sesi pelatihan sesuai skema — online via Zoom atau tatap muka di Yogyakarta — dengan materi teori dan praktik.</p></div></div>
    <div class="step-card"><div class="step-num">3</div><div class="step-body"><h3>Ujian Tulis</h3><p>Peserta mengikuti ujian tertulis untuk menilai pemahaman teori dan regulasi K3 sesuai skema kompetensi.</p></div></div>
    <div class="step-card"><div class="step-num">4</div><div class="step-body"><h3>Ujian Praktik</h3><p>Peserta mendemonstrasikan kompetensi praktik di hadapan asesor/instruktur sesuai standar skema sertifikasi.</p></div></div>
    <div class="step-card"><div class="step-num" style="background:linear-gradient(135deg,#C6621C,#e8852e)">5</div><div class="step-body"><h3>Penerbitan Sertifikat</h3><p>Peserta yang dinyatakan kompeten menerima sertifikat resmi BNSP atau Kemnaker RI yang berlaku secara nasional.</p></div></div>
  </div>
</div>
</section>

<!-- FAQ -->
<section>
<div class="container-sm">
  <h2 class="section-title">Pertanyaan yang Sering Ditanyakan</h2>
  <div class="faq-list" style="margin-top:28px">
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

<!-- FINAL CTA -->
<section class="final-cta">
  <div class="container-sm">
    <h2>Siap Bersertifikat BNSP?</h2>
    <p>Konsultasikan kebutuhan sertifikasi K3 perusahaan atau pribadi Anda langsung dengan tim Wahana Totalita.</p>
    <a href="<?=$wa_konsul_url?>" class="btn-wa" target="_blank" rel="noopener">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a6.47 6.47 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
      Konsultasi Sertifikasi BNSP
    </a>
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
