<?php
require_once __DIR__ . '/config.php';
$s = get_all_settings();
/**
 * klien.php
 * Trust/E-E-A-T page listing companies Wahana Totalita has worked with,
 * recovered from historical site content (2012-2023 Wayback archive).
 * Zero DB dependency, modeled on sertifikasi-bnsp.php.
 */
$wa_number = '6287759151278';
$wa_join = rawurlencode('Halo, saya ingin mendiskusikan program pelatihan untuk perusahaan kami');
$wa_join_url = "https://wa.me/{$wa_number}?text={$wa_join}";
$year = date('Y');

$klienGroups = [
    'Minyak, Gas & Energi' => [
        'Freeport Indonesia (PTFI)', 'Chevron Pacific Indonesia', 'BP Indonesia',
        'Total E&P Indonesie', 'ConocoPhillips Indonesia', 'CNOOC SES Ltd',
        'Inpex Corporation', 'Star Energy', 'VICO Indonesia', 'ENI Indonesia',
        'MedcoEnergi', 'Badak LNG', 'Pertamina (Persero)', 'PLN (Persero)',
        'PT PJB (Pembangkitan Jawa-Bali)',
    ],
    'Pertambangan & Industri Berat' => [
        'Adaro Energy', 'PT Indonesia Asahan Aluminium (INALUM)', 'PT Krakatau Steel',
        'PT Smelting', 'Holcim Indonesia',
    ],
    'Perbankan & Keuangan' => [
        'Bank Mandiri', 'BRI', 'BTN',
    ],
    'Industri & Manufaktur' => [
        'Pupuk Kaltim', 'Pupuk Kujang', 'Pusri', 'Biofarma', 'Peruri',
    ],
    'Jasa & Inspeksi' => [
        'Sucofindo', 'Halliburton Indonesia', 'Schlumberger Indonesia',
    ],
];

$testimonials = [
    'Salah satu klien kami dari sektor migas menyatakan bahwa program pelatihan K3 yang diikuti tim mereka sangat aplikatif dan langsung relevan dengan kondisi lapangan operasi minyak dan gas, sehingga karyawan lebih siap menghadapi audit keselamatan kerja.',
    'Salah satu klien kami dari perusahaan BUMN perbankan menyampaikan bahwa proses sertifikasi K3 untuk staf fasilitas dan gedung berjalan lancar, dengan pendampingan dokumen yang memudahkan proses administrasi internal perusahaan.',
    'Salah satu klien kami dari sektor pertambangan mengapresiasi konsistensi kualitas instruktur dan kemudahan koordinasi jadwal pelatihan, meski lokasi kerja mereka berada jauh dari Yogyakarta.',
];
?>
<?php
$page_title = 'Klien & Mitra — 70+ Perusahaan BUMN & Multinasional';
$meta_desc = 'Wahana Totalita Konsultan dipercaya oleh 70+ perusahaan BUMN dan multinasional sejak 2006. Freeport, Pertamina, PLN, Bank Mandiri, Chevron, Total E&P, dan banyak lagi.';
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
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Source Sans 3',system-ui,sans-serif;color:#1a1a2e;line-height:1.7;-webkit-font-smoothing:antialiased}
.container{max-width:1000px;margin:0 auto;padding:0 20px}
.container-sm{max-width:680px;margin:0 auto;padding:0 20px}
/* NAV */
/* HERO */
.hero{background:linear-gradient(160deg,#0A4A2E 0%,#1a6b45 60%,#0d5535 100%);color:#fff;padding:64px 0 56px;position:relative;overflow:hidden;text-align:center}
.hero::before{content:'';position:absolute;inset:0;background:radial-gradient(circle at 15% 60%,rgba(198,98,28,.25),transparent 55%),radial-gradient(circle at 85% 20%,rgba(255,255,255,.07),transparent 40%)}
.hero::after{content:'';position:absolute;bottom:-1px;left:0;right:0;height:48px;background:linear-gradient(to bottom right,transparent 49%,#f5f5f2 50%)}
.hero .inner{position:relative;z-index:1}
.hero-badge{display:inline-flex;align-items:center;gap:6px;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.25);color:#fff;font-size:11px;font-weight:800;padding:6px 16px;border-radius:20px;text-transform:uppercase;letter-spacing:.08em;margin-bottom:20px}
.hero h1{font-size:clamp(1.8rem,5vw,2.8rem);font-weight:800;line-height:1.15;margin-bottom:14px;letter-spacing:-.025em}
.hero-sub{font-size:1.05rem;color:rgba(255,255,255,.85);margin:0 auto;max-width:640px}
/* BUTTONS */
.btn-wa{display:inline-flex;align-items:center;justify-content:center;gap:10px;background:#25D366;color:#fff;padding:16px 32px;border-radius:14px;font-size:16px;font-weight:800;text-decoration:none;box-shadow:0 6px 24px rgba(37,211,102,.4);transition:transform .2s,box-shadow .2s;border:none;cursor:pointer;margin-top:24px}
.btn-wa:hover{transform:translateY(-3px);box-shadow:0 10px 32px rgba(37,211,102,.5)}
/* BODY SECTIONS */
section{padding:48px 0;background:#f5f5f2}
section.white{background:#fff}
h2.section-title{font-size:1.6rem;font-weight:800;color:#111827;margin-bottom:8px;letter-spacing:-.02em;text-align:center}
.section-subtitle{font-size:15px;color:#6b7280;text-align:center;margin-bottom:32px}
/* CLIENT GRID */
.klien-group{margin-bottom:36px}
.klien-group h3{font-size:14px;font-weight:800;color:#0A4A2E;text-transform:uppercase;letter-spacing:.06em;margin-bottom:14px;padding-bottom:8px;border-bottom:2px solid #e5e7eb}
.klien-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:12px}
.klien-card{background:#fff;border:1.5px solid #0A4A2E;border-radius:10px;padding:16px 12px;text-align:center;font-size:13.5px;font-weight:700;color:#111827;display:flex;align-items:center;justify-content:center;min-height:64px;box-shadow:0 2px 8px rgba(0,0,0,.04)}
/* TESTIMONIALS */
.testi-grid{display:grid;grid-template-columns:1fr;gap:1rem;max-width:740px;margin:0 auto}
.testi-card{background:#fff;border:1.5px solid #e5e7eb;border-radius:14px;padding:22px;position:relative}
.testi-card::before{content:'"';position:absolute;top:10px;left:16px;font-size:3rem;color:#e5e7eb;line-height:1;font-family:Georgia,serif}
.testi-text{font-size:14px;color:#374151;line-height:1.75;padding-left:22px}
/* FINAL CTA */
.final-cta{background:linear-gradient(135deg,#0A4A2E,#1a5e38);color:#fff;padding:56px 0;text-align:center}
.final-cta h2{font-size:2rem;font-weight:800;margin-bottom:10px;letter-spacing:-.02em}
.final-cta p{font-size:16px;color:rgba(255,255,255,.85)}
/* FOOTER */
.lp-footer a:hover{color:#fff}
@media(max-width:640px){
  .hero{padding:48px 0 44px}
  .hero h1{font-size:1.8rem}
  .klien-grid{grid-template-columns:repeat(2,1fr)}
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
    <div class="hero-badge">🤝 Dipercaya Sejak 2006</div>
    <h1>Klien &amp; Mitra Kami</h1>
    <p class="hero-sub">Wahana Totalita Konsultan telah dipercaya oleh lebih dari 70 perusahaan besar sejak 2006 — mulai dari BUMN strategis nasional, perusahaan minyak dan gas multinasional, hingga perbankan dan industri manufaktur. Kepercayaan mereka menjadi bukti nyata kualitas pelatihan dan layanan kami.</p>
  </div>
</section>

<!-- PERUSAHAAN YANG TELAH BERMITRA -->
<section class="white">
<div class="container">
  <h2 class="section-title">Perusahaan yang Telah Bermitra</h2>
  <p class="section-subtitle">Lintas sektor migas, pertambangan, perbankan, manufaktur, hingga jasa inspeksi</p>

  <?php foreach ($klienGroups as $group => $clients): ?>
  <div class="klien-group">
    <h3><?= htmlspecialchars($group) ?></h3>
    <div class="klien-grid">
      <?php foreach ($clients as $c): ?>
      <div class="klien-card"><?= htmlspecialchars($c) ?></div>
      <?php endforeach; ?>
    </div>
  </div>
  <?php endforeach; ?>
</div>
</section>

<!-- TESTIMONI -->
<section>
<div class="container-sm">
  <h2 class="section-title">Testimoni</h2>
  <p class="section-subtitle">Pengalaman klien yang telah bermitra dengan kami</p>
  <div class="testi-grid">
    <?php foreach ($testimonials as $t): ?>
    <div class="testi-card">
      <p class="testi-text"><?= htmlspecialchars($t) ?></p>
    </div>
    <?php endforeach; ?>
  </div>
</div>
</section>

<!-- BERGABUNG DENGAN KLIEN KAMI -->
<section class="final-cta">
  <div class="container-sm">
    <h2>Bergabung dengan Klien Kami</h2>
    <p>Ingin perusahaan Anda mendapatkan pelatihan dan sertifikasi K3 yang sama seperti klien-klien BUMN dan multinasional kami? Hubungi tim kami untuk konsultasi program.</p>
    <a href="<?=$wa_join_url?>" class="btn-wa" target="_blank" rel="noopener">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a6.47 6.47 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
      Diskusikan Program Pelatihan
    </a>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
</body>
</html>
