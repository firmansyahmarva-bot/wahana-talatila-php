<?php
require_once __DIR__ . '/config.php';
$s = get_all_settings();
?>
<?php
$page_title = 'SKP Berlaku Berapa Lama? Perpanjangan SKP & Lisensi K3 Kemnaker';
$meta_desc = 'SKP & Lisensi Ahli K3 berlaku 3 tahun. Sudah kadaluarsa? Masih bisa diperpanjang tanpa pelatihan ulang dalam masa toleransi. Cek syarat, biaya & lama proses. Konsultasi gratis via WhatsApp.';
require __DIR__ . '/includes/head.php';
?>
<meta name="author" content="Wahana Totalita Konsultan">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="SKP Berlaku Berapa Lama? Perpanjangan SKP & Lisensi K3 Kemnaker">
<meta name="twitter:description" content="SKP & Lisensi Ahli K3 berlaku 3 tahun. Cek syarat, biaya, dan lama proses perpanjangan — tanpa pelatihan ulang selama masih dalam toleransi.">
<meta name="twitter:image" content="https://wahanatotalita.com/assets/og-perpanjangan-skp.jpg">
<meta name="theme-color" content="#0f1a30">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<style>
:root{
  --ink:#0f1a30;
  --ink-light:#1e2d4d;
  --ink-soft:#4a5568;
  --paper:#ffffff;
  --paper-warm:#f8f6f1;
  --line:#e2ddd3;
  --gold:#c9a227;
  --gold-dark:#a88420;
  --wa:#25d366;
  --wa-dark:#1da851;
  --danger:#c0392b;
  --danger-soft:#fdf2f0;
  --success:#27ae60;
  --success-soft:#eafaf1;
  --radius:16px;
  --radius-sm:10px;
  --shadow:0 4px 24px rgba(15,26,48,.08);
  --shadow-lg:0 12px 40px rgba(15,26,48,.12);
  font-size:16px;
}
*{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
body{font-family:'Inter',system-ui,-apple-system,sans-serif;color:var(--ink);background:var(--paper);line-height:1.7;-webkit-font-smoothing:antialiased}
img{max-width:100%;display:block}
a{color:inherit;text-decoration:none}
:focus-visible{outline:2.5px solid var(--gold);outline-offset:3px}
/* Header */
.site-header{
  background:var(--ink);
  color:#fff;
  position:sticky;
  top:0;
  z-index:100;
  box-shadow:0 2px 12px rgba(0,0,0,.15);
}
.header-inner{
  max-width:1140px;
  margin:0 auto;
  padding:14px 24px;
  display:flex;
  align-items:center;
  justify-content:space-between;
  gap:16px;
}
.brand{
  font-family:'Playfair Display',serif;
  font-size:20px;
  font-weight:700;
  color:#fff;
  letter-spacing:-.3px;
}
.brand span{
  color:var(--gold);
  font-weight:600;
}
.header-actions{
  display:flex;
  align-items:center;
  gap:12px;
}
.header-phone{
  display:none;
  align-items:center;
  gap:6px;
  color:rgba(255,255,255,.75);
  font-size:13px;
  font-weight:600;
  transition:color .2s;
}
.header-phone:hover{color:#fff}
.header-phone svg{width:15px;height:15px;stroke:currentColor;stroke-width:2;fill:none}
.btn-wa-header{
  display:inline-flex;
  align-items:center;
  gap:7px;
  background:var(--wa);
  color:#fff;
  font-size:13px;
  font-weight:700;
  padding:10px 18px;
  border-radius:99px;
  transition:transform .15s,background .2s;
  white-space:nowrap;
}
.btn-wa-header:hover{background:var(--wa-dark);transform:translateY(-1px)}
.btn-wa-header svg{width:16px;height:16px;fill:currentColor}
/* Container */
.container{max-width:1140px;margin:0 auto;padding:0 24px}
.container-narrow{max-width:720px;margin:0 auto;padding:0 24px}
/* Typography */
h1,h2,h3{font-family:'Playfair Display',serif;font-weight:700;line-height:1.2;letter-spacing:-.3px}
h1{font-size:clamp(2rem,5vw,3rem)}
h2{font-size:clamp(1.5rem,3.5vw,2.1rem);margin-bottom:16px}
h3{font-size:1.15rem;margin-bottom:8px}
.eyebrow{
  display:inline-block;
  font-size:11.5px;
  font-weight:800;
  letter-spacing:.14em;
  text-transform:uppercase;
  color:var(--gold-dark);
  margin-bottom:10px;
}
.section-head{max-width:640px;margin-bottom:36px}
.section-head p{color:var(--ink-soft);font-size:15.5px;margin-top:8px}
section{padding:64px 0}
.divider{height:1px;background:var(--line);border:none;max-width:1140px;margin:0 auto}
/* Hero */
.hero{
  background:linear-gradient(165deg,var(--ink) 0%,var(--ink-light) 60%,#152038 100%);
  color:#fff;
  padding:72px 0 88px;
  position:relative;
  overflow:hidden;
}
.hero::before{
  content:'';position:absolute;top:-80px;right:-80px;width:420px;height:420px;
  background:radial-gradient(circle,rgba(201,162,39,.18),transparent 60%);
  pointer-events:none;
}
.hero .container{position:relative}
.hero-badge{
  display:inline-flex;
  align-items:center;
  gap:8px;
  background:rgba(255,255,255,.08);
  border:1px solid rgba(255,255,255,.18);
  padding:8px 16px;
  border-radius:99px;
  font-size:12.5px;
  font-weight:700;
  margin-bottom:22px;
}
.hero-badge .dot{width:7px;height:7px;border-radius:50%;background:var(--gold);display:inline-block}
.hero h1{margin-bottom:18px}
.hero h1 em{
  color:var(--gold);
  font-style:normal;
}
.hero-sub{
  font-size:17px;
  color:rgba(255,255,255,.78);
  max-width:520px;
  margin-bottom:32px;
  line-height:1.7;
}
.hero-actions{display:flex;flex-wrap:wrap;gap:12px;margin-bottom:28px}
.btn{
  display:inline-flex;
  align-items:center;
  justify-content:center;
  gap:8px;
  font-weight:700;
  font-size:15px;
  border-radius:12px;
  padding:15px 26px;
  transition:transform .15s,box-shadow .15s;
  cursor:pointer;
  border:none;
}
.btn-wa{
  background:var(--wa);
  color:#fff;
  box-shadow:0 8px 22px rgba(37,211,102,.32);
}
.btn-wa:hover{transform:translateY(-2px);box-shadow:0 12px 28px rgba(37,211,102,.4)}
.btn-ghost{
  background:rgba(255,255,255,.08);
  color:#fff;
  border:1.5px solid rgba(255,255,255,.28);
}
.btn-ghost:hover{background:rgba(255,255,255,.16)}
.btn svg{width:18px;height:18px}
.btn-block{width:100%}
.hero-trust{
  display:flex;
  flex-wrap:wrap;
  gap:20px;
  font-size:13px;
  color:rgba(255,255,255,.65);
}
.hero-trust span{display:flex;align-items:center;gap:6px}
.hero-trust svg{width:16px;height:16px;stroke:var(--gold);stroke-width:2.5;fill:none}
/* Cards & Boxes */
.card{
  background:var(--paper);
  border:1.5px solid var(--line);
  border-radius:var(--radius);
  padding:28px;
  box-shadow:var(--shadow);
}
.card-good{border-color:rgba(39,174,96,.35);background:var(--success-soft)}
.card-bad{border-color:rgba(192,57,43,.3);background:var(--danger-soft)}
/* Decision */
.decision-grid{
  display:grid;
  grid-template-columns:1fr auto 1fr;
  gap:20px;
  align-items:stretch;
}
.decision-or{
  display:flex;
  align-items:center;
  justify-content:center;
  font-size:12px;
  font-weight:800;
  color:var(--ink-soft);
  letter-spacing:.1em;
  text-transform:uppercase;
}
.decision-card{
  background:var(--paper);
  border:1.5px solid var(--line);
  border-radius:var(--radius);
  padding:28px;
  box-shadow:var(--shadow);
  display:flex;
  flex-direction:column;
}
.decision-card h3{font-size:18px;margin-bottom:8px}
.decision-card p{color:var(--ink-soft);font-size:14.5px;margin-bottom:22px;flex-grow:1}
.stamp{
  display:inline-flex;align-items:center;gap:6px;
  font-size:11px;font-weight:800;
  text-transform:uppercase;letter-spacing:.08em;
  border:2px solid currentColor;border-radius:8px;padding:5px 12px;
  width:fit-content;margin-bottom:14px;
}
.stamp-green{color:var(--success)}
.stamp-red{color:var(--danger)}
/* Callout */
.callout{
  background:var(--paper-warm);
  border-radius:var(--radius);
  padding:28px;
  display:grid;
  grid-template-columns:auto 1fr;
  gap:20px;
  align-items:flex-start;
  border-left:5px solid var(--danger);
}
.callout h3{font-size:17px;color:var(--danger);margin-bottom:6px}
.callout p{color:var(--ink-soft);font-size:14.5px}
.callout p+p{margin-top:10px}
/* Pricing Table */
.pricing-table{
  width:100%;
  border-collapse:separate;
  border-spacing:0;
  background:var(--paper);
  border:1.5px solid var(--line);
  border-radius:var(--radius);
  overflow:hidden;
  box-shadow:var(--shadow);
  margin-top:8px;
}
.pricing-table th,.pricing-table td{
  padding:16px 20px;
  text-align:left;
  font-size:14.5px;
  border-bottom:1px solid var(--line);
}
.pricing-table th{
  background:var(--ink);
  color:#fff;
  font-weight:700;
  font-size:13px;
  letter-spacing:.03em;
  text-transform:uppercase;
}
.pricing-table tr:last-child td{border-bottom:none}
.pricing-table td{color:var(--ink-soft)}
.pricing-table td strong{color:var(--ink);font-weight:700}
.price-note{
  background:var(--paper-warm);
  border:1.5px solid var(--line);
  border-radius:var(--radius);
  padding:20px;
  margin-top:20px;
  font-size:14px;
  color:var(--ink-soft);
}
/* Lists */
.checklist{
  list-style:none;
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:12px;
}
.checklist li{
  display:flex;
  align-items:flex-start;
  gap:10px;
  background:var(--paper);
  border:1.5px solid var(--line);
  border-radius:var(--radius-sm);
  padding:14px 16px;
  font-size:14px;
  font-weight:600;
}
.checklist li svg{
  width:18px;height:18px;
  stroke:var(--success);stroke-width:2.5;fill:none;
  flex-shrink:0;margin-top:2px;
}
/* Timeline */
.timeline{position:relative;padding-left:52px}
.timeline::before{
  content:'';position:absolute;left:19px;top:6px;bottom:6px;width:2px;background:var(--line);
}
.tl-step{position:relative;padding-bottom:32px}
.tl-step:last-child{padding-bottom:0}
.tl-num{
  position:absolute;left:-52px;top:0;width:40px;height:40px;border-radius:50%;
  background:var(--ink);color:#fff;display:flex;align-items:center;justify-content:center;
  font-weight:800;font-size:13px;
}
.tl-step:last-child .tl-num{background:var(--gold-dark)}
.tl-step h3{font-size:16px;margin-bottom:5px;font-family:'Inter',sans-serif;font-weight:700}
.tl-step p{font-size:14px;color:var(--ink-soft)}
/* FAQ */
.faq-item{border-bottom:1px solid var(--line)}
.faq-item summary{
  list-style:none;cursor:pointer;padding:20px 4px;font-weight:700;font-size:15.5px;
  display:flex;justify-content:space-between;align-items:center;gap:16px;
}
.faq-item summary::-webkit-details-marker{display:none}
.faq-item summary::after{content:'+';font-size:22px;color:var(--gold-dark);flex-shrink:0;transition:transform .2s}
.faq-item[open] summary::after{transform:rotate(45deg)}
.faq-item p{padding:0 4px 20px;color:var(--ink-soft);font-size:14.5px;max-width:640px;line-height:1.7}
/* Final CTA */
.final{
  background:var(--ink);
  color:#fff;
  text-align:center;
  position:relative;
  overflow:hidden;
  padding:80px 0;
}
.final::before{
  content:'';position:absolute;inset:0;
  background:radial-gradient(circle at 20% 20%,rgba(201,162,39,.15),transparent 45%);
}
.final .container-narrow{position:relative}
.final h2{color:#fff;margin-bottom:12px}
.final>p{color:rgba(255,255,255,.75);margin-bottom:32px;font-size:16px}
.final-actions{display:flex;flex-wrap:wrap;justify-content:center;gap:12px}
/* Footer */
.site-footer{
  background:var(--ink);
  color:rgba(255,255,255,.5);
  text-align:center;
  padding:28px 24px;
  font-size:13px;
}
.site-footer a{color:rgba(255,255,255,.7);transition:color .2s}
.site-footer a:hover{color:#fff}
/* Sticky Mobile CTA */
.sticky-cta{
  position:fixed;
  left:0;right:0;bottom:0;
  background:#fff;
  border-top:1px solid var(--line);
  padding:10px 16px;
  display:none;
  z-index:200;
  box-shadow:0 -6px 20px rgba(0,0,0,.08);
}
/* Responsive */
@media(min-width:640px){
  .header-phone{display:flex}
}
@media(max-width:760px){
  .decision-grid{grid-template-columns:1fr}
  .decision-or{padding:8px 0}
  .callout{grid-template-columns:1fr}
  .checklist{grid-template-columns:1fr}
  .pricing-table th,.pricing-table td{padding:14px 16px;font-size:13.5px}
  .sticky-cta{display:block}
  section{padding:52px 0}
  .hero{padding:56px 0 72px}
}
@media(max-width:480px){
  .header-inner{padding:12px 16px}
  .brand{font-size:17px}
  .btn-wa-header{padding:9px 14px;font-size:12px}
  .container,.container-narrow{padding:0 16px}
  .hero-sub{font-size:15.5px}
  .btn{padding:14px 20px;font-size:14px;width:100%}
  .hero-actions .btn{width:auto}
}
</style>
<header class="site-header">
  <div class="header-inner">
    <a href="/" class="brand">Wahana <span>Totalita</span></a>
    <div class="header-actions">
      <a href="tel:+6287759151278" class="header-phone">
        <svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.362 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.338 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
        0877-5915-1278
      </a>
      <a href="https://wa.me/6287759151278?text=Halo%2C%20saya%20ingin%20perpanjang%20SKP%20Ahli%20K3%20saya.%20Mohon%20info%20prosedurnya." class="btn-wa-header" target="_blank" rel="noopener">
        <svg viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a6.47 6.47 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
        WhatsApp
      </a>
    </div>
  </div>
</header>

<section class="hero">
  <div class="container">
    <div class="hero-badge"><span class="dot"></span> SKP berlaku 3 tahun — cek masa berlaku Anda</div>
    <h1>Perpanjang SKP & Lisensi K3 <em>dengan Mudah</em> — Resmi Kemnaker & BNSP</h1>
    <p class="hero-sub">Proses administratif ke Kemnaker/Disnaker, tanpa pelatihan ulang selama SKP masih dalam toleransi. Dibantu sampai SKP baru terbit di tangan Anda.</p>
    <div class="hero-actions">
      <a href="https://wa.me/6287759151278?text=Halo%2C%20saya%20ingin%20perpanjang%20SKP%20Ahli%20K3%20saya.%20Mohon%20info%20prosedur%20dan%20biayanya." class="btn btn-wa" target="_blank" rel="noopener">
        <svg viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a6.47 6.47 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
        Konsultasi Gratis via WhatsApp
      </a>
      <a href="https://wa.me/6287759151278?text=Halo%2C%20saya%20ingin%20tanya%20soal%20perpanjangan%20SKP%20K3." class="btn btn-ghost" target="_blank" rel="noopener">Tanya Jadwal & Biaya</a>
    </div>
    <div class="hero-trust">
      <span><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>Proses Administratif</span>
      <span><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>Tanpa Pelatihan Ulang</span>
      <span><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>Dibantu Sampai Terbit</span>
    </div>
  </div>
</section>

<section>
  <div class="container-narrow">
    <span class="eyebrow">Pengenalan</span>
    <h2>Apa Itu Perpanjangan SKP & Lisensi K3?</h2>
    <p>Surat Keterangan Pengalaman (SKP) dan Lisensi Ahli K3 adalah dokumen wajib yang membuktikan kewenangan Anda sebagai tenaga ahli keselamatan dan kesehatan kerja. Setiap SKP dan Lisensi Ahli K3 yang diterbitkan Kemnaker RI maupun BNSP memiliki masa berlaku 3 tahun, dan wajib diperpanjang sebelum tanggal kadaluarsa tiba. Perpanjangan SKP adalah proses administratif ke Kemnaker atau Dinas Ketenagakerjaan setempat, bukan pelatihan, selama dokumen Anda belum melewati batas toleransi expired.</p>
    <p style="margin-top:14px">Bagi Anda yang masih memegang SKP dan Lisensi K3 dalam masa berlakunya, proses perpanjangan jauh lebih ringan dibandingkan mengulang dari awal. Tidak perlu mengikuti pelatihan ulang atau Refreshing K3 berhari-hari. Cukup siapkan dokumen, kami bantu ajukan ke instansi berwenang, dan pantau prosesnya sampai SKP baru terbit di tangan Anda. <a href="https://wa.me/6287759151278?text=Halo%2C%20saya%20ingin%20perpanjang%20SKP%20Ahli%20K3%20saya.%20Mohon%20info%20prosedurnya." style="color:var(--gold-dark);font-weight:700;text-decoration:underline" target="_blank" rel="noopener">Konsultasikan status SKP Anda via WhatsApp</a> — tim kami merespons dalam 1×24 jam.</p>
  </div>
</section>

<hr class="divider">

<section>
  <div class="container">
    <div class="section-head">
      <span class="eyebrow">Eligibilitas</span>
      <h2>Masih Bisa Diperpanjang, atau Harus Mengulang?</h2>
      <p>Jawabannya hanya ditentukan satu hal: apakah tanggal kadaluarsa SKP Anda sudah lewat atau belum.</p>
    </div>
    <div class="decision-grid">
      <div class="decision-card card-good">
        <span class="stamp stamp-green">Belum Kadaluarsa</span>
        <h3>SKP saya masih berlaku</h3>
        <p>Anda hanya perlu mengajukan perpanjangan administratif. Prosesnya jauh lebih ringan, lebih murah, dan kewenangan K3 Anda tidak terputus.</p>
        <a href="https://wa.me/6287759151278?text=Halo%2C%20saya%20ingin%20perpanjang%20SKP%20Ahli%20K3%20saya.%20Mohon%20info%20prosedurnya." class="btn btn-wa btn-block" target="_blank" rel="noopener">Ajukan Perpanjangan SKP</a>
      </div>
      <div class="decision-or">ATAU</div>
      <div class="decision-card card-bad">
        <span class="stamp stamp-red">Sudah Kadaluarsa</span>
        <h3>SKP saya sudah lewat tanggal</h3>
        <p>Jika expired lebih dari 1 tahun, biasanya wajib mengikuti Refreshing K3 atau pelatihan ulang terlebih dahulu sebelum perpanjangan bisa diproses.</p>
        <a href="https://wa.me/6287759151278?text=Halo%2C%20saya%20ingin%20tanya%20soal%20perpanjangan%20SKP%20K3.%20Kapan%20SKP%20saya%20harus%20diperpanjang%3F" class="btn btn-ghost btn-block" target="_blank" rel="noopener" style="color:var(--ink);border-color:var(--line)">Tanya Opsi Pelatihan Ulang</a>
      </div>
    </div>
  </div>
</section>

<hr class="divider">

<section>
  <div class="container-narrow">
    <div class="section-head">
      <span class="eyebrow">Pentingnya Waktu</span>
      <h2>Kenapa Perpanjangan SKP Penting?</h2>
    </div>
    <div class="callout">
      <span class="stamp stamp-red">Berisiko</span>
      <div>
        <h3>Telat Sedikit, Prosesnya Jadi Jauh Lebih Berat</h3>
        <p>Begitu tanggal kadaluarsa terlewati dan melebihi batas toleransi, perpanjangan administratif tidak bisa lagi diproses. Anda harus mengikuti Refreshing K3 atau pelatihan Ahli K3 Umum penuh dari awal — biayanya lebih besar dan waktunya lebih lama.</p>
        <p>Bandingkan dengan perpanjangan tepat waktu yang hanya proses administratif. Selisihnya bukan cuma soal biaya — ada jeda tanpa kewenangan K3 yang bisa berdampak ke posisi kerja Anda.</p>
      </div>
    </div>
    <div style="margin-top:28px">
      <ul style="list-style:none;display:grid;gap:14px">
        <li style="display:flex;gap:12px;align-items:flex-start">
          <span style="width:32px;height:32px;border-radius:50%;background:var(--success-soft);color:var(--success);display:flex;align-items:center;justify-content:center;font-weight:800;font-size:14px;flex-shrink:0">1</span>
          <div>
            <strong style="color:var(--ink)">Menjaga keabsahan kewenangan K3.</strong>
            <span style="color:var(--ink-soft);display:block;font-size:14.5px;margin-top:2px">SKP dan Lisensi yang masih berlaku adalah syarat legal bagi Ahli K3 untuk menandatangani dokumen SMK3, laporan audit, dan rekomendasi keselamatan kerja.</span>
          </div>
        </li>
        <li style="display:flex;gap:12px;align-items:flex-start">
          <span style="width:32px;height:32px;border-radius:50%;background:var(--success-soft);color:var(--success);display:flex;align-items:center;justify-content:center;font-weight:800;font-size:14px;flex-shrink:0">2</span>
          <div>
            <strong style="color:var(--ink)">Menghindari kewajiban pelatihan ulang.</strong>
            <span style="color:var(--ink-soft);display:block;font-size:14.5px;margin-top:2px">Jika SKP terlambat diperpanjang dan melewati batas toleransi, Anda wajib mengikuti Refreshing K3 atau pelatihan penuh — biayanya lebih besar dan waktunya lebih lama.</span>
          </div>
        </li>
        <li style="display:flex;gap:12px;align-items:flex-start">
          <span style="width:32px;height:32px;border-radius:50%;background:var(--success-soft);color:var(--success);display:flex;align-items:center;justify-content:center;font-weight:800;font-size:14px;flex-shrink:0">3</span>
          <div>
            <strong style="color:var(--ink)">Memenuhi syarat audit dan tender.</strong>
            <span style="color:var(--ink-soft);display:block;font-size:14.5px;margin-top:2px">Perusahaan yang mengikuti tender atau audit SMK3 / ISO 45001 wajib memiliki Ahli K3 bersertifikat aktif. SKP yang hangus bisa mengganggu kelengkapan dokumen perusahaan.</span>
          </div>
        </li>
        <li style="display:flex;gap:12px;align-items:flex-start">
          <span style="width:32px;height:32px;border-radius:50%;background:var(--success-soft);color:var(--success);display:flex;align-items:center;justify-content:center;font-weight:800;font-size:14px;flex-shrink:0">4</span>
          <div>
            <strong style="color:var(--ink)">Melindungi posisi kerja dan tanggung jawab.</strong>
            <span style="color:var(--ink-soft);display:block;font-size:14.5px;margin-top:2px">Banyak perusahaan mensyaratkan SKP aktif untuk jabatan HSE Manager, K3 Officer, atau konsultan K3. Jangan biarkan dokumen Anda terputus di tengah jabatan.</span>
          </div>
        </li>
      </ul>
    </div>
  </div>
</section>

<hr class="divider">

<section>
  <div class="container">
    <div class="section-head">
      <span class="eyebrow">Target Pengguna</span>
      <h2>Siapa yang Wajib Memperpanjang SKP?</h2>
      <p>Perpanjangan SKP dan Lisensi K3 berlaku untuk seluruh skema keahlian yang diterbitkan Kemnaker RI dan BNSP.</p>
    </div>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:16px">
      <div class="card">
        <h3>Ahli K3 Umum</h3>
        <p style="font-size:14px;color:var(--ink-soft);margin-top:6px">Skema paling umum untuk pengawas K3 di berbagai industri.</p>
      </div>
      <div class="card">
        <h3>Ahli K3 Listrik</h3>
        <p style="font-size:14px;color:var(--ink-soft);margin-top:6px">Khusus untuk tenaga ahli keselamatan di instalasi listrik dan energi.</p>
      </div>
      <div class="card">
        <h3>Ahli K3 Konstruksi</h3>
        <p style="font-size:14px;color:var(--ink-soft);margin-top:6px">Untuk proyek konstruksi dan infrastruktur.</p>
      </div>
      <div class="card">
        <h3>Ahli K3 Fire / Kebakaran</h3>
        <p style="font-size:14px;color:var(--ink-soft);margin-top:6px">Untuk sistem proteksi kebakaran dan emergency response.</p>
      </div>
      <div class="card">
        <h3>Ahli K3 Mekanik / Kimia</h3>
        <p style="font-size:14px;color:var(--ink-soft);margin-top:6px">Sesuai bidang spesialisasi masing-masing.</p>
      </div>
    </div>
    <p style="margin-top:22px;font-size:14px;color:var(--ink-soft)">Jika Anda tidak yakin skema mana yang Anda miliki, <a href="https://wa.me/6287759151278?text=Halo%2C%20saya%20ingin%20cek%20skema%20SKP%20saya%20dan%20tanya%20perpanjangannya." style="color:var(--gold-dark);font-weight:700;text-decoration:underline" target="_blank" rel="noopener">kirimkan scan SKP dan Lisensi lama Anda</a> — tim kami akan memverifikasi jenis lisensi dan prosedur yang sesuai.</p>
  </div>
</section>

<hr class="divider">

<section>
  <div class="container-narrow">
    <div class="section-head">
      <span class="eyebrow">Regulasi</span>
      <h2>Masa Berlaku & Regulasi SKP & Lisensi K3</h2>
    </div>
    <p>SKP dan Lisensi Ahli K3 diterbitkan dengan masa berlaku <strong>3 tahun</strong> sejak tanggal penerbitan. Dalam periode tersebut, Anda berhak menjalankan fungsi Ahli K3 sesuai skema keahlian yang dimiliki.</p>
    <div class="card" style="margin-top:24px">
      <h3 style="font-size:16px;font-family:'Inter',sans-serif;margin-bottom:12px">Ketentuan Perpanjangan:</h3>
      <ul style="list-style:none;display:grid;gap:10px">
        <li style="display:flex;gap:10px;align-items:flex-start;font-size:14.5px">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--success)" stroke-width="2.5" style="flex-shrink:0;margin-top:3px"><polyline points="20 6 9 17 4 12"/></svg>
          <span>Wajib diajukan sebelum tanggal kadaluarsa. Idealnya mulai proses 1–3 bulan sebelum habis masa berlaku, mengingat proses verifikasi di instansi membutuhkan waktu.</span>
        </li>
        <li style="display:flex;gap:10px;align-items:flex-start;font-size:14.5px">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--success)" stroke-width="2.5" style="flex-shrink:0;margin-top:3px"><polyline points="20 6 9 17 4 12"/></svg>
          <span>Jika SKP masih dalam masa berlaku atau baru melewati sedikit dari tanggal kadaluarsa (dalam toleransi administrasi), perpanjangan dapat dilakukan tanpa pelatihan ulang.</span>
        </li>
        <li style="display:flex;gap:10px;align-items:flex-start;font-size:14.5px">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--danger)" stroke-width="2.5" style="flex-shrink:0;margin-top:3px"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
          <span>Jika SKP sudah expired lebih dari 1 tahun, regulasi umumnya mengharuskan Anda mengikuti <strong>Refreshing K3</strong> atau pelatihan kompetensi ulang, bukan sekadar perpanjangan administrasi.</span>
        </li>
      </ul>
    </div>
    <p style="margin-top:18px;font-size:14px;color:var(--ink-soft)">Informasi di atas mengacu pada praktik pengelolaan SKP dan Lisensi Ahli K3 oleh Kemnaker RI. Untuk kepastian status spesifik Anda, silakan <a href="https://wa.me/6287759151278?text=Halo%2C%20saya%20ingin%20cek%20status%20SKP%20saya%20dan%20tanya%20batas%20toleransi%20expirednya." style="color:var(--gold-dark);font-weight:700;text-decoration:underline" target="_blank" rel="noopener">konsultasikan langsung</a> dengan menyertakan scan dokumen lama.</p>
  </div>
</section>

<hr class="divider">

<section>
  <div class="container">
    <div class="section-head">
      <span class="eyebrow">Investasi</span>
      <h2>Biaya Perpanjangan SKP & Lisensi K3</h2>
      <p>Perpanjangan SKP dan Lisensi K3 adalah proses administratif ke Kemnaker atau Disnaker, tanpa pelatihan ulang, selama SKP Anda masih dalam batas toleransi expired.</p>
    </div>
    <table class="pricing-table">
      <thead>
        <tr>
          <th>Layanan</th>
          <th>Alumni</th>
          <th>Non-Alumni / Umum</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><strong>Perpanjangan SKP & Lisensi Ahli K3 Umum (Kemnaker)</strong></td>
          <td>Mulai <strong>Rp 1.700.000</strong></td>
          <td><strong>Rp 1.800.000 – Rp 2.000.000</strong></td>
        </tr>
        <tr>
          <td><strong>Perpanjangan Lisensi & SKP Ahli K3 Listrik / Skema Lain</strong></td>
          <td>—</td>
          <td>Mulai <strong>Rp 2.000.000 – Rp 2.500.000</strong></td>
        </tr>
      </tbody>
    </table>
    <div class="price-note">
      <p><strong>Catatan penting:</strong> Harga di atas adalah estimasi pasar 2025–2026. Harga pasti dapat berbeda tergantung skema keahlian, wilayah Dinas Ketenagakerjaan, dan kelengkapan dokumen Anda. Untuk penawaran resmi, silakan <a href="https://wa.me/6287759151278?text=Halo%2C%20saya%20ingin%20tanya%20biaya%20perpanjangan%20SKP%20saya." style="color:var(--gold-dark);font-weight:700;text-decoration:underline" target="_blank" rel="noopener">konsultasi via WhatsApp</a> dengan menyertakan scan SKP dan Lisensi lama.</p>
      <p style="margin-top:10px">Jika SKP Anda sudah expired lebih dari 1 tahun, biasanya wajib mengikuti Refreshing K3 terlebih dahulu. Lihat detail program dan jadwal Refreshing K3 di halaman <a href="/refreshing-k3" style="color:var(--gold-dark);font-weight:700;text-decoration:underline">Refreshing K3</a>.</p>
    </div>
  </div>
</section>

<hr class="divider">

<section>
  <div class="container-narrow">
    <div class="section-head">
      <span class="eyebrow">Persiapan</span>
      <h2>Syarat & Dokumen Perpanjangan SKP</h2>
      <p>Persiapan dokumen yang lengkap mempercepat proses pengajuan ke Kemnaker/Disnaker.</p>
    </div>
    <ul class="checklist">
      <li><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>Fotokopi KTP yang masih berlaku</li>
      <li><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>Fotokopi SKP dan Lisensi K3 lama</li>
      <li><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>Sertifikat kompetensi Ahli K3 asli</li>
      <li><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>Pas foto 3×4 cm latar merah (4 lembar)</li>
      <li><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>Surat keterangan masih bekerja</li>
      <li><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>Laporan kegiatan K3 ringkas</li>
      <li><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>Formulir permohonan perpanjangan</li>
    </ul>
    <p style="margin-top:18px;font-size:13.5px;color:var(--ink-soft)">Beberapa Dinas Ketenagakerjaan daerah mungkin meminta dokumen tambahan sesuai ketentuan lokal. Tim Wahana Totalita akan menginformasikan kelengkapan spesifik setelah melakukan pengecekan awal terhadap SKP Anda.</p>
  </div>
</section>

<hr class="divider">

<section>
  <div class="container-narrow">
    <div class="section-head">
      <span class="eyebrow">Proses</span>
      <h2>Alur Perpanjangan SKP di Wahana Totalita</h2>
      <p>Kami menyederhanakan proses birokrasi perpanjangan SKP agar Anda bisa fokus pada pekerjaan utama.</p>
    </div>
    <div class="timeline">
      <div class="tl-step">
        <div class="tl-num">01</div>
        <h3>Kontak & Konsultasi Awal</h3>
        <p>Hubungi kami via WhatsApp, sertakan scan SKP dan Lisensi lama. Kami cek status, skema, dan kelayakan perpanjangan Anda.</p>
      </div>
      <div class="tl-step">
        <div class="tl-num">02</div>
        <h3>Pengecekan Dokumen</h3>
        <p>Tim kami memverifikasi kelengkapan dokumen dan menginformasikan jika ada yang perlu dilengkapi sebelum pengajuan.</p>
      </div>
      <div class="tl-step">
        <div class="tl-num">03</div>
        <h3>Konfirmasi Biaya & Pembayaran</h3>
        <p>Setelah dokumen lengkap, Anda menerima penawaran harga pasti sesuai skema dan wilayah. Lakukan pembayaran untuk memulai proses.</p>
      </div>
      <div class="tl-step">
        <div class="tl-num">04</div>
        <h3>Pengajuan Dokumen ke Instansi</h3>
        <p>Tim kami mengajukan berkas perpanjangan SKP ke Kemnaker RI atau Dinas Ketenagakerjaan setempat sesuai domisili dan ketentuan yang berlaku.</p>
      </div>
      <div class="tl-step">
        <div class="tl-num">05</div>
        <h3>Monitoring & Follow-up</h3>
        <p>Kami memantau status pengajuan secara berkala, melakukan follow-up ke instansi, dan menginformasikan perkembangan kepada Anda.</p>
      </div>
      <div class="tl-step">
        <div class="tl-num">06</div>
        <h3>Verifikasi oleh Instansi</h3>
        <p>Proses verifikasi internal oleh Kemnaker/Disnaker membutuhkan waktu. Selama masa tunggu, kami tetap koordinasi aktif.</p>
      </div>
      <div class="tl-step">
        <div class="tl-num">07</div>
        <h3>SKP & Lisensi Baru Terbit</h3>
        <p>Dokumen baru diterima dan dikirimkan ke alamat Anda. SKP baru berlaku penuh 3 tahun ke depan. Anda juga akan didaftarkan ke sistem pengingat kami untuk periode berikutnya.</p>
      </div>
    </div>
  </div>
</section>

<hr class="divider">

<section>
  <div class="container-narrow">
    <div class="section-head">
      <span class="eyebrow">Sebelum Menghubungi Kami</span>
      <h2>Pertanyaan yang Sering Ditanyakan</h2>
    </div>
    <details class="faq-item">
      <summary>Kapan sebaiknya saya mulai proses perpanjangan SKP?</summary>
      <p>Idealnya 1–3 bulan sebelum tanggal kadaluarsa. Proses verifikasi di instansi membutuhkan waktu 2–4 minggu, dan ada buffer untuk mengantisipasi koreksi dokumen atau kendala administrasi.</p>
    </details>
    <details class="faq-item">
      <summary>Berapa lama proses perpanjangan SKP sampai terbit?</summary>
      <p>Rata-rata 2–4 minggu setelah dokumen lengkap diajukan ke Kemnaker/Disnaker. Durasi bisa bervariasi tergantung antrean dan kebijakan instansi setempat.</p>
    </details>
    <details class="faq-item">
      <summary>Apakah SKP yang sudah expired bisa diperpanjang?</summary>
      <p>Jika expired dalam batas toleransi administrasi (biasanya kurang dari 1 tahun), masih bisa diperpanjang tanpa pelatihan ulang. Namun jika sudah lebih dari 1 tahun, umumnya wajib mengikuti Refreshing K3 atau pelatihan ulang terlebih dahulu.</p>
    </details>
    <details class="faq-item">
      <summary>Apakah saya perlu datang ke kantor Wahana Totalita atau Kemnaker?</summary>
      <p>Tidak perlu. Seluruh proses koordinasi dokumen bisa dilakukan secara online. Anda cukup mengirimkan dokumen scan, dan kami yang mengurus pengajuan ke instansi. SKP baru juga bisa dikirimkan ke alamat Anda.</p>
    </details>
    <details class="faq-item">
      <summary>Apakah ada jaminan SKP baru pasti terbit?</summary>
      <p>Kami menjamin pengajuan dokumen dilakukan sesuai prosedur resmi Kemnaker/Disnaker. Selama dokumen asli Anda valid dan tidak ada masalah di sistem kepegawaian instansi, proses perpanjangan akan berjalan normal. Kami akan terus memantau dan menginformasikan jika ada kendala.</p>
    </details>
    <details class="faq-item">
      <summary>Apakah Wahana Totalita memberikan pengingat untuk periode berikutnya?</summary>
      <p>Ya. Setelah SKP baru terbit, Anda masuk ke sistem pengingat otomatis kami. Kami akan menghubungi Anda menjelang masa perpanjangan berikutnya agar tidak terlambat lagi.</p>
    </details>
    <details class="faq-item">
      <summary>Apa bedanya perpanjangan SKP dengan Refreshing K3?</summary>
      <p>Perpanjangan SKP adalah proses administratif pengajuan dokumen ke instansi untuk memperbarui masa berlaku. Refreshing K3 adalah program pelatihan singkat yang wajib diikuti jika SKP sudah expired melebihi batas toleransi. Jika SKP Anda masih aktif, Anda tidak perlu Refreshing K3 — cukup perpanjangan administratif.</p>
    </details>
  </div>
</section>

<section class="final">
  <div class="container-narrow">
    <span class="eyebrow" style="color:rgba(255,255,255,.55)">Langkah Terakhir</span>
    <h2>Jangan Tunggu Sampai Tanggalnya Lewat</h2>
    <p>SKP Anda adalah aset profesional. Perpanjang tepat waktu, hemat biaya, dan jaga kewenangan K3 Anda tetap berjalan.</p>
    <div class="final-actions">
      <a href="https://wa.me/6287759151278?text=Halo%2C%20saya%20ingin%20perpanjang%20SKP%20Ahli%20K3%20saya.%20Mohon%20info%20prosedur%20dan%20biayanya." class="btn btn-wa" target="_blank" rel="noopener">
        <svg viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a6.47 6.47 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
        Konsultasi Gratis via WhatsApp
      </a>
      <a href="https://wa.me/6287759151278?text=Halo%2C%20saya%20ingin%20tanya%20soal%20perpanjangan%20SKP%20K3." class="btn btn-ghost" target="_blank" rel="noopener">Tanya Jadwal & Biaya</a>
    </div>
  </div>
</section>

<footer class="site-footer">
  <p>© 2026 <a href="/">Wahana Totalita Konsultan</a> &nbsp;|&nbsp; wahanatotalita.com &nbsp;|&nbsp; Yogyakarta, Indonesia &nbsp;|&nbsp; <a href="tel:+6287759151278">+62 812-2969-435</a></p>
  <p style="margin-top:6px">Layanan: <a href="/">Beranda</a> &nbsp;·&nbsp; <a href="/pelatihan-ahli-k3-umum">Pelatihan Ahli K3 Umum</a> &nbsp;·&nbsp; <a href="/refreshing-k3">Refreshing K3</a></p>
</footer>

<div class="sticky-cta">
  <a href="https://wa.me/6287759151278?text=Halo%2C%20saya%20ingin%20perpanjang%20SKP%20Ahli%20K3%20saya.%20Mohon%20info%20prosedur%20dan%20biayanya." class="btn btn-wa btn-block" target="_blank" rel="noopener">
    <svg viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a6.47 6.47 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
    Konsultasi Gratis via WhatsApp
  </a>
</div>

</body>
</html>