<?php
/**
 * layanan-pemerintah.php
 * B2G landing page — targets keywords NO competitor owns:
 *   "vendor pelatihan K3 pemerintah Indonesia", "pelatihan K3 BUMN",
 *   "penyedia pelatihan K3 LPSE", "pengadaan pelatihan K3 Dinas"
 * Zero DB dependency. Sales WhatsApp number.
 */
$wa_number = '628122969435';
$wa_tender = rawurlencode('Halo Wahana Totalita, kami dari instansi pemerintah/BUMN ingin berdiskusi mengenai pengadaan pelatihan K3. Mohon informasinya.');
$wa_url    = "https://wa.me/{$wa_number}?text={$wa_tender}";
$year = date('Y');
?>
<?php
require_once __DIR__ . '/config.php';
$s = get_all_settings();
?>
<?php
$page_title = 'Vendor Pelatihan K3 untuk Instansi Pemerintah & BUMN Indonesia';
$meta_desc = 'Vendor pelatihan dan sertifikasi K3 untuk instansi pemerintah, kementerian, BUMN, universitas, dan rumah sakit. Mendukung pengadaan langsung maupun proses LPSE di seluruh Indonesia.';
require __DIR__ . '/includes/head.php';
?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ProfessionalService",
  "name": "Pengadaan Pelatihan K3 untuk Instansi Pemerintah & BUMN",
  "serviceType": "Pelatihan & Sertifikasi K3 (B2G)",
  "provider": {
    "@type": "EducationalOrganization",
    "name": "Wahana Totalita Konsultan",
    "url": "https://wahanatotalita.com",
    "address": {"@type": "PostalAddress", "addressLocality": "Yogyakarta", "addressRegion": "DIY", "addressCountry": "ID"},
    "telephone": "+628122969435"
  },
  "areaServed": {"@type": "AdministrativeArea", "name": "Daerah Istimewa Yogyakarta"},
  "description": "Penyedia jasa pelatihan K3 bersertifikasi BNSP & KEMNAKER RI untuk instansi pemerintah, Dinas, dan BUMN. Mendukung proses pengadaan langsung maupun melalui LPSE sesuai ketentuan yang berlaku."
}
</script>
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Plus Jakarta Sans',system-ui,sans-serif;color:#1a1a2e;line-height:1.7;-webkit-font-smoothing:antialiased;background:#f5f5f2}
.container{max-width:980px;margin:0 auto;padding:0 20px}
img{max-width:100%}
a{color:inherit}
.topbar{background:#0A4A2E;padding:12px 0}
.topbar-inner{display:flex;align-items:center;justify-content:space-between}
.topbar-logo{color:#fff;font-weight:800;font-size:16px;text-decoration:none}
.topbar-back{color:rgba(255,255,255,.75);font-size:13px;text-decoration:none}
.topbar-back:hover{color:#fff}
.hero{background:linear-gradient(160deg,#0A4A2E 0%,#1a6b45 60%,#0d5535 100%);color:#fff;padding:64px 0 72px;position:relative;overflow:hidden}
.hero::before{content:'';position:absolute;inset:0;background:radial-gradient(circle at 15% 60%,rgba(198,98,28,.25),transparent 55%)}
.hero .inner{position:relative;z-index:1;max-width:720px}
.hero-badge{display:inline-flex;gap:6px;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.25);font-size:11px;font-weight:800;padding:6px 16px;border-radius:20px;text-transform:uppercase;letter-spacing:.08em;margin-bottom:20px}
.hero h1{font-size:clamp(1.9rem,5vw,2.9rem);font-weight:800;line-height:1.15;margin-bottom:16px;letter-spacing:-.025em}
.hero h1 em{color:#fb923c;font-style:normal}
.hero-sub{font-size:1.08rem;color:rgba(255,255,255,.88);margin-bottom:30px}
.btn{display:inline-flex;align-items:center;gap:8px;font-weight:700;text-decoration:none;border-radius:10px;padding:14px 26px;font-size:15px;transition:.2s}
.btn-wa{background:#25d366;color:#fff}.btn-wa:hover{background:#1fb957;transform:translateY(-2px)}
.btn-ghost{background:rgba(255,255,255,.12);color:#fff;border:1px solid rgba(255,255,255,.3)}
.trust{background:#063;padding:18px 0}
.trust-inner{display:flex;flex-wrap:wrap;gap:14px;justify-content:center}
.trust-chip{background:rgba(255,255,255,.1);color:#fff;border:1px solid rgba(255,255,255,.2);border-radius:8px;padding:8px 16px;font-size:13px;font-weight:700}
section.block{padding:56px 0}
h2{font-size:clamp(1.5rem,4vw,2rem);font-weight:800;letter-spacing:-.02em;margin-bottom:14px;color:#0A4A2E}
.lead{font-size:1.05rem;color:#444;margin-bottom:28px;max-width:680px}
.grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:18px}
.card{background:#fff;border:1px solid #e7e7e2;border-radius:14px;padding:24px}
.card h3{font-size:1.05rem;color:#0A4A2E;margin-bottom:8px}
.card p{font-size:14px;color:#555}
.card .ico{font-size:1.8rem;margin-bottom:10px}
ul.checks{list-style:none;display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:10px}
ul.checks li{background:#fff;border:1px solid #e7e7e2;border-radius:10px;padding:14px 16px;font-size:14px;font-weight:600;display:flex;gap:10px}
ul.checks li::before{content:'✓';color:#C6621C;font-weight:800}
.steps{counter-reset:s;display:grid;gap:14px}
.step{background:#fff;border:1px solid #e7e7e2;border-radius:12px;padding:20px 22px 20px 64px;position:relative}
.step::before{counter-increment:s;content:counter(s);position:absolute;left:18px;top:18px;width:32px;height:32px;background:#0A4A2E;color:#fff;border-radius:8px;display:grid;place-items:center;font-weight:800}
.step h3{color:#0A4A2E;font-size:1rem;margin-bottom:4px}
.step p{font-size:14px;color:#555}
.faq{background:#fff;border:1px solid #e7e7e2;border-radius:12px;padding:20px 22px;margin-bottom:12px}
.faq h3{font-size:1rem;color:#0A4A2E;margin-bottom:6px}
.faq p{font-size:14px;color:#555}
.cta{background:linear-gradient(135deg,#0A4A2E,#1a6b45);color:#fff;border-radius:18px;padding:44px 32px;text-align:center;margin:0 20px}
.cta h2{color:#fff}.cta p{color:rgba(255,255,255,.85);margin-bottom:24px;max-width:560px;margin-inline:auto}
footer{padding:36px 0;text-align:center;font-size:13px;color:#777}
</style>
<div class="topbar"><div class="container topbar-inner">
  <a href="/" class="topbar-logo">Wahana Totalita Konsultan</a>
  <a href="/" class="topbar-back">← Beranda</a>
</div></div>

<section class="hero"><div class="container"><div class="inner">
  <span class="hero-badge">🏛️ Layanan Business-to-Government (B2G)</span>
  <h1>Vendor Pelatihan K3 untuk <em>Instansi Pemerintah & BUMN</em> di Indonesia</h1>
  <p class="hero-sub">Wahana Totalita Konsultan adalah penyedia jasa pelatihan dan sertifikasi K3 bersertifikasi BNSP &amp; KEMNAKER RI, siap mendukung proses pengadaan pemerintah melalui mekanisme yang berlaku, termasuk pengadaan langsung maupun LPSE, untuk instansi pemerintah, BUMN, universitas, dan lembaga di seluruh Indonesia.</p>
  <a href="<?= $wa_url ?>" class="btn btn-wa" target="_blank" rel="noopener">💬 Diskusi Pengadaan via WhatsApp</a>
</div></div></section>

<div class="trust"><div class="container trust-inner">
  <span class="trust-chip">✅ PJK3</span>
  <span class="trust-chip">✅ Program BNSP</span>
  <span class="trust-chip">✅ Program Kemnaker RI</span>
  <span class="trust-chip">✅ Melayani Seluruh Indonesia</span>
  <span class="trust-chip">✅ Sejak 2018</span>
  <span class="trust-chip">✅ 65+ Program Pelatihan</span>
</div></div>

<section class="block"><div class="container">
  <h2>Mengapa Instansi Memilih Wahana Totalita</h2>
  <p class="lead">Satu penyedia untuk seluruh kebutuhan kegiatan pelatihan instansi — menyederhanakan administrasi pengadaan dan pertanggungjawaban anggaran.</p>
  <div class="grid">
    <div class="card"><div class="ico">📋</div><h3>Siap Administrasi Pengadaan</h3><p>Dokumen NPWP, NIB, SPT, dan legalitas lengkap untuk persyaratan penyedia dalam proses pengadaan langsung maupun LPSE.</p></div>
    <div class="card"><div class="ico">🎓</div><h3>Sertifikasi Resmi</h3><p>65+ program pelatihan K3 bersertifikat BNSP dan KEMNAKER RI yang sah dan diakui secara nasional.</p></div>
    <div class="card"><div class="ico">🏨</div><h3>Layanan Penuh (One-Stop)</h3><p>Pelatihan + akomodasi + konsumsi + transportasi + event organizing dalam satu paket pengadaan.</p></div>
    <div class="card"><div class="ico">📍</div><h3>Kehadiran Lokal Yogyakarta</h3><p>Kantor dan fasilitas pelatihan riil di DIY. Mudah berkoordinasi langsung dengan instansi setempat.</p></div>
  </div>
</div></section>

<section class="block" style="background:#fff;border-block:1px solid #e7e7e2"><div class="container">
  <h2>Layanan yang Dapat Masuk Pengadaan</h2>
  <p class="lead">Seluruh layanan berikut dapat disusun sebagai paket pengadaan untuk instansi pemerintah dan BUMN.</p>
  <ul class="checks">
    <li>Pelatihan &amp; Sertifikasi K3 (Ahli K3 Umum, Migas, Konstruksi, dll)</li>
    <li>Pelatihan Lingkungan &amp; Konsultasi AMDAL</li>
    <li>Pelatihan Pertambangan (POP, POM, POU)</li>
    <li>Sertifikasi Sistem Manajemen (ISO, SMK3)</li>
    <li>In-House Training di lokasi instansi</li>
    <li>Event Organizing &amp; rapat koordinasi</li>
    <li>Outbound &amp; team building</li>
    <li>Akomodasi, katering, &amp; perjalanan dinas</li>
  </ul>
  <p style="margin-top:20px">Lihat juga: <a href="/k3/">Pelatihan K3</a> • <a href="/pelatihan/">Semua Pelatihan</a> • <a href="/perusahaan/">Layanan Perusahaan</a> • <a href="/event-organizer/">Event Organizer</a></p>
</div></section>

<section class="block"><div class="container">
  <h2>Cara Menggunakan Wahana untuk Pengadaan</h2>
  <div class="steps">
    <div class="step"><h3>1. Konsultasi Kebutuhan</h3><p>Hubungi tim kami via WhatsApp. Sampaikan jenis pelatihan, jumlah peserta, dan jadwal yang direncanakan.</p></div>
    <div class="step"><h3>2. Penawaran &amp; RAB</h3><p>Kami menyusun proposal teknis dan Rencana Anggaran Biaya (RAB) sesuai pagu dan ketentuan pengadaan instansi.</p></div>
    <div class="step"><h3>3. Proses Pengadaan</h3><p>Pengadaan langsung, penunjukan langsung, atau melalui LPSE/e-katalog sesuai nilai dan regulasi yang berlaku pada instansi masing-masing.</p></div>
    <div class="step"><h3>4. Pelaksanaan &amp; Pelaporan</h3><p>Pelatihan dilaksanakan, sertifikat diterbitkan, dan dokumen pertanggungjawaban (laporan, dokumentasi, BAST) diserahkan lengkap.</p></div>
  </div>
</div></section>

<section class="block" style="background:#fff;border-block:1px solid #e7e7e2"><div class="container">
  <h2>Pertanyaan Seputar Pengadaan</h2>
  <div class="faq"><h3>Apakah Wahana Totalita dapat mendukung proses pengadaan melalui LPSE?</h3><p>Ya. Kami dapat mendukung kebutuhan dokumen administrasi serta proses pengadaan sesuai mekanisme yang berlaku, termasuk pengadaan langsung maupun melalui LPSE sesuai ketentuan instansi.</p></div>
  <div class="faq"><h3>Bisakah pengadaan dilakukan tanpa tender (pengadaan langsung)?</h3><p>Metode pengadaan mengikuti ketentuan dan regulasi yang berlaku pada instansi masing-masing. Tim kami siap membantu menyesuaikan dokumen administrasi sesuai mekanisme pengadaan yang digunakan.</p></div>
  <div class="faq"><h3>Apakah bisa satu paket pelatihan + akomodasi + konsumsi?</h3><p>Bisa. Sebagai penyedia layanan penuh, kami dapat menyusun paket yang mencakup pelatihan, akomodasi, konsumsi, transportasi, dan event organizing dalam satu kontrak pengadaan.</p></div>
  <div class="faq"><h3>Apakah sertifikat sah untuk kebutuhan instansi/BUMN?</h3><p>Ya. Sertifikat diterbitkan oleh BNSP dan KEMNAKER RI, berlaku nasional, dan sah untuk pemenuhan kompetensi serta persyaratan kepegawaian instansi maupun BUMN.</p></div>
</div></section>

<section class="block"><div class="cta">
  <h2>Rencanakan Pengadaan Pelatihan K3 Instansi Anda</h2>
  <p>Tim kami siap membantu menyusun proposal teknis dan RAB sesuai ketentuan pengadaan. Konsultasi tanpa biaya.</p>
  <a href="<?= $wa_url ?>" class="btn btn-wa" target="_blank" rel="noopener">💬 Hubungi Tim Pengadaan via WhatsApp</a>
</div></section>

<footer>© <?= $year ?> Wahana Totalita Konsultan — PT Kreasi Ultimate Berjaya · Yogyakarta · Melayani Instansi Pemerintah &amp; BUMN Seluruh Indonesia</footer>
</body>
</html>