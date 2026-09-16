<?php
require_once __DIR__ . '/config.php';
$s = get_all_settings();
/**
 * instruktur.php
 * Instructor/trust page. Zero DB dependency, modeled on sertifikasi-bnsp.php.
 *
 * Roster: 14 real named instructors recovered from a 2012 Wayback Machine
 * snapshot of the old site, cleared for publication by Berro. Names/credentials
 * are stated neutrally with no living/deceased status implied either way,
 * per instruction. Remaining 6 slots are generic certified-instructor profiles
 * (no invented names).
 */
$wa_number = '6287759151278';
$wa_join = rawurlencode('Halo, saya ingin bergabung sebagai instruktur K3 di Wahana Totalita');
$wa_join_url = "https://wa.me/{$wa_number}?text={$wa_join}";
$year = date('Y');

$instruktur = [
    ['name' => 'Baldric Siregar', 'cred' => 'Dr., MBA., Ak.', 'spec' => 'Manajemen & Audit K3'],
    ['name' => 'Hari Purnomo', 'cred' => 'Dr. Ir., MT', 'spec' => 'Teknik Industri & Ergonomi'],
    ['name' => 'Viktor Malau', 'cred' => 'Dr. Ir., DEA', 'spec' => 'K3 Industri & Lingkungan'],
    ['name' => 'M. Kusumawan Herliansyah', 'cred' => 'Dr., ST., MT.', 'spec' => 'Teknik Mesin & Keselamatan'],
    ['name' => 'Arman Hakim Nasution', 'cred' => 'Ir., M.Eng', 'spec' => 'Manajemen Risiko Industri'],
    ['name' => 'Rini Dharmastiti', 'cred' => 'Ir., MSc, PhD', 'spec' => 'Ergonomi & Keselamatan Kerja'],
    ['name' => 'R.I. Triyanto', 'cred' => 'Capt., M.Mar', 'spec' => 'Keselamatan Maritim & IATA'],
    ['name' => 'H. Zaenal M. Sofro', 'cred' => 'M.D., AIFM', 'spec' => 'Kesehatan Kerja & Kedokteran Olahraga'],
    ['name' => 'Marlin Maryudi', 'cred' => 'Praktisi K3 Bersertifikat', 'spec' => 'Pusdiklat Migas Cepu'],
    ['name' => 'Putut Prasetyo', 'cred' => 'Praktisi K3 Bersertifikat', 'spec' => 'Pusdiklat Migas Cepu'],
    ['name' => 'Suwoyo', 'cred' => 'ST', 'spec' => 'Pusdiklat Migas Cepu'],
    ['name' => 'Slamet Riyadi', 'cred' => 'ST., MEng', 'spec' => 'Pusdiklat Migas Cepu'],
    ['name' => 'Sutrisno', 'cred' => 'Praktisi K3 Bersertifikat', 'spec' => 'Pusdiklat Migas Cepu'],
    ['name' => 'Bambang Setyo', 'cred' => 'Praktisi K3 Bersertifikat', 'spec' => 'Pusdiklat Migas Cepu'],
];

$genericSlots = [
    'Ahli K3 Umum & SMK3', 'K3 Konstruksi & Bekerja di Ketinggian',
    'Auditor Sistem Manajemen K3', 'ISO 45001 / 14001 / 9001',
    'K3 Kimia & Bahan Berbahaya', 'Investigasi Kecelakaan Kerja',
];
foreach ($genericSlots as $sp) {
    $instruktur[] = ['name' => 'Instruktur K3 Nasional', 'cred' => 'Tersertifikasi Kemnaker RI / BNSP', 'spec' => $sp];
}
?>
<?php
$page_title = 'Instruktur K3 Berpengalaman Yogyakarta';
$meta_desc = 'Wahana Totalita Konsultan didukung oleh instruktur K3 nasional dari Pusdiklat Migas Cepu, akademisi, dan praktisi industri berpengalaman lebih dari 15 tahun.';
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
body{font-family:'Plus Jakarta Sans',system-ui,sans-serif;color:#1a1a2e;line-height:1.7;-webkit-font-smoothing:antialiased}
.container{max-width:1000px;margin:0 auto;padding:0 20px}
.container-sm{max-width:680px;margin:0 auto;padding:0 20px}
.hero{background:linear-gradient(160deg,#0A4A2E 0%,#1a6b45 60%,#0d5535 100%);color:#fff;padding:64px 0 56px;position:relative;overflow:hidden;text-align:center}
.hero::before{content:'';position:absolute;inset:0;background:radial-gradient(circle at 15% 60%,rgba(198,98,28,.25),transparent 55%),radial-gradient(circle at 85% 20%,rgba(255,255,255,.07),transparent 40%)}
.hero::after{content:'';position:absolute;bottom:-1px;left:0;right:0;height:48px;background:linear-gradient(to bottom right,transparent 49%,#f5f5f2 50%)}
.hero .inner{position:relative;z-index:1}
.hero-badge{display:inline-flex;align-items:center;gap:6px;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.25);color:#fff;font-size:11px;font-weight:800;padding:6px 16px;border-radius:20px;text-transform:uppercase;letter-spacing:.08em;margin-bottom:20px}
.hero h1{font-size:clamp(1.8rem,5vw,2.8rem);font-weight:800;line-height:1.15;margin-bottom:14px;letter-spacing:-.025em}
.hero-sub{font-size:1.05rem;color:rgba(255,255,255,.85);margin:0 auto;max-width:640px}
.btn-wa{display:inline-flex;align-items:center;justify-content:center;gap:10px;background:#25D366;color:#fff;padding:16px 32px;border-radius:14px;font-size:16px;font-weight:800;text-decoration:none;box-shadow:0 6px 24px rgba(37,211,102,.4);transition:transform .2s,box-shadow .2s;border:none;cursor:pointer;margin-top:24px}
.btn-wa:hover{transform:translateY(-3px);box-shadow:0 10px 32px rgba(37,211,102,.5)}
section{padding:48px 0;background:#f5f5f2}
section.white{background:#fff}
h2.section-title{font-size:1.6rem;font-weight:800;color:#111827;margin-bottom:8px;letter-spacing:-.02em;text-align:center}
.section-subtitle{font-size:15px;color:#6b7280;text-align:center;margin-bottom:32px}
.intro-text{font-size:15.5px;color:#374151;line-height:1.85;max-width:720px;margin:0 auto 8px;text-align:center}
.instruktur-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:14px}
.instruktur-card{background:#fff;border:1.5px solid #e5e7eb;border-radius:12px;padding:18px;text-align:center}
.instruktur-card h3{font-size:14px;font-weight:700;color:#111827;margin-bottom:6px}
.instruktur-cred{display:inline-block;background:#f0fdf4;color:#0A4A2E;font-size:11px;font-weight:700;padding:3px 10px;border-radius:20px;margin-bottom:8px}
.instruktur-card p{font-size:12.5px;color:#6b7280}
.qual-list{list-style:none;display:flex;flex-direction:column;gap:10px;max-width:600px;margin:0 auto}
.qual-list li{background:#fff;border:1.5px solid #e5e7eb;border-radius:10px;padding:14px 18px;font-size:14.5px;color:#374151;display:flex;gap:10px}
.qual-list li::before{content:'✓';color:#0A4A2E;font-weight:800;flex-shrink:0}
.final-cta{background:linear-gradient(135deg,#0A4A2E,#1a5e38);color:#fff;padding:56px 0;text-align:center}
.final-cta h2{font-size:2rem;font-weight:800;margin-bottom:10px;letter-spacing:-.02em}
.final-cta p{font-size:16px;color:rgba(255,255,255,.85);max-width:600px;margin:0 auto}
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
<?php require __DIR__ . '/includes/navbar.php'; ?>
<section class="hero">
  <div class="container inner">
    <div class="hero-badge">🎓 Tenaga Ahli Kami</div>
    <h1>Instruktur &amp; Tenaga Ahli Kami</h1>
    <p class="hero-sub">Kualitas pelatihan K3 kami didukung oleh instruktur berpengalaman lintas industri di seluruh Indonesia.</p>
  </div>
</section>

<section class="white">
<div class="container">
  <p class="intro-text">Kualitas pelatihan K3 kami didukung oleh instruktur yang tidak hanya memiliki sertifikasi resmi, tetapi juga pengalaman lapangan nyata di industri migas, pertambangan, konstruksi, dan manufaktur Indonesia. Kami telah bekerja sama dengan instruktur-instruktur berikut dalam menyelenggarakan program pelatihan K3 kami.</p>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">Instruktur &amp; Tenaga Ahli</h2>
  <p class="section-subtitle">Praktisi bersertifikat dari berbagai bidang spesialisasi K3</p>
  <div class="instruktur-grid">
    <?php foreach ($instruktur as $i): ?>
    <div class="instruktur-card">
      <h3><?= htmlspecialchars($i['name']) ?></h3>
      <span class="instruktur-cred"><?= htmlspecialchars($i['cred']) ?></span>
      <p><?= htmlspecialchars($i['spec']) ?></p>
    </div>
    <?php endforeach; ?>
  </div>
</div>
</section>

<section class="white">
<div class="container-sm">
  <h2 class="section-title">Kualifikasi Instruktur Kami</h2>
  <ul class="qual-list">
    <li>Tersertifikasi Kemnaker RI / BNSP</li>
    <li>Pengalaman industri minimum 10 tahun</li>
    <li>Latar belakang akademik S1–S3</li>
    <li>Aktif sebagai pengawas ketenagakerjaan / praktisi lapangan</li>
  </ul>
</div>
</section>

<section class="final-cta">
  <div class="container-sm">
    <h2>Bergabung sebagai Instruktur</h2>
    <p>Anda praktisi K3 bersertifikat dengan pengalaman industri yang ingin berbagi keahlian? Kami terbuka untuk kolaborasi dengan instruktur berkualitas di seluruh Indonesia.</p>
    <a href="<?=$wa_join_url?>" class="btn-wa" target="_blank" rel="noopener">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a6.47 6.47 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
      Gabung sebagai Instruktur
    </a>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
</body>
</html>
