<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/glossary-functions.php';

$s       = get_all_settings();
$certNum = sanitize(get_query_param('cert') ?: ($_GET['cert'] ?? ($_POST['cert_number'] ?? '')));
$result  = null;
$searched = false;

if ($certNum) {
    $searched = true;
    $result   = verify_certificate($certNum);
}

$metaTitle = 'Cara Cek & Verifikasi Sertifikat K3 Kemnaker & BNSP Online | Wahana Totalita';
$metaDesc  = 'Panduan resmi cara cek keaslian sertifikat K3 Kemnaker RI (TemanK3) dan BNSP online. Portal verifikasi alumni Wahana Totalita, ciri sertifikat asli, dan perpanjangan lisensi K3.';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($metaTitle) ?></title>
<meta name="description" content="<?= e($metaDesc) ?>">
<link rel="canonical" href="<?= SITE_URL ?>/verifikasi/">
<style><?php
$_core_css_file = __DIR__ . '/../assets/css/core.min.css';
if (is_file($_core_css_file)) {
    readfile($_core_css_file);
} else {
    readfile(__DIR__ . '/../assets/css/tokens.css');
    readfile(__DIR__ . '/../assets/css/core.css');
}
?></style>
<link rel="stylesheet" href="<?= asset_v('/assets/css/components.min.css') ?>" media="print" onload="this.media='all'">
<noscript><link rel="stylesheet" href="<?= asset_v('/assets/css/components.min.css') ?>"></noscript>
<?= theme_css_vars($s) ?>

<!-- Structured Data: WebPage & FAQPage for High SEO Visibility -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "WebPage",
      "@id": "<?= SITE_URL ?>/verifikasi/#webpage",
      "url": "<?= SITE_URL ?>/verifikasi/",
      "name": "Panduan & Verifikasi Sertifikat K3 Online Kemnaker RI & BNSP",
      "description": "<?= e($metaDesc) ?>"
    },
    {
      "@type": "FAQPage",
      "mainEntity": [
        {
          "@type": "Question",
          "name": "Bagaimana cara cek keaslian sertifikat K3 Kemnaker RI?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Sertifikat dan Lisensi K3 Kemnaker RI dapat diverifikasi melalui portal resmi TemanK3 (temank3.kemnaker.go.id) pada menu Pemeriksaan Sertifikat/Lisensi dengan memasukkan nomor registrasi atau NIK pemegang."
          }
        },
        {
          "@type": "Question",
          "name": "Berapa lama masa berlaku sertifikat K3?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Secara umum, Surat Keputusan Penunjukan (SKP) dan Lisensi Kewenangan K3 dari Kemnaker RI serta Sertifikat Kompetensi BNSP memiliki masa berlaku 3 tahun dan dapat diperpanjang (renewal)."
          }
        },
        {
          "@type": "Question",
          "name": "Apakah sertifikat K3 yang sudah habis masa berlakunya masih bisa diperpanjang?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Bisa. Anda dapat mengajukan perpanjangan lisensi / sertifikat K3 melalui PJK3 resmi seperti Wahana Totalita dengan menyertakan salinan sertifikat lama, surat keterangan kerja dari perusahaan, dan dokumen persyaratan pendukung."
          }
        }
      ]
    }
  ]
}
</script>

<style>
/* Modern styling consistent with Wahana Totalita tokens */
.verif-hero {
  background: linear-gradient(135deg, var(--brand, #103A5C) 0%, var(--brand-dark, #0B2C46) 100%);
  padding: 64px 0 54px;
  text-align: center;
  color: #ffffff;
}
.verif-hero .badge-tag {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: rgba(255,255,255,0.12);
  border: 1px solid rgba(255,255,255,0.22);
  color: #FDE8DA;
  font-size: 0.85rem;
  font-weight: 600;
  padding: 6px 16px;
  border-radius: 999px;
  margin-bottom: 16px;
}
.verif-hero h1 {
  font-size: clamp(1.8rem, 4vw, 2.7rem);
  font-weight: 800;
  line-height: 1.25;
  margin: 0 auto 16px;
  max-width: 820px;
}
.verif-hero p {
  font-size: 1.05rem;
  opacity: 0.9;
  max-width: 700px;
  margin: 0 auto 28px;
  line-height: 1.6;
}
.quick-nav {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  gap: 12px;
  margin-top: 20px;
}
.quick-nav a {
  background: rgba(255,255,255,0.15);
  color: #fff;
  text-decoration: none;
  font-size: 0.9rem;
  font-weight: 600;
  padding: 10px 18px;
  border-radius: 8px;
  border: 1px solid rgba(255,255,255,0.25);
  transition: all .2s ease;
}
.quick-nav a:hover {
  background: var(--accent, #F06A25);
  border-color: var(--accent, #F06A25);
  transform: translateY(-2px);
}

/* Sections */
.verif-section {
  padding: 56px 0;
}
.verif-section-alt {
  background: var(--surface-subtle, #F8FAFC);
}
.section-title {
  text-align: center;
  max-width: 720px;
  margin: 0 auto 36px;
}
.section-title h2 {
  font-size: clamp(1.5rem, 3vw, 2.1rem);
  color: var(--brand, #103A5C);
  margin-bottom: 10px;
  font-weight: 800;
}
.section-title p {
  color: var(--mut, #5A6B7B);
  font-size: 1rem;
  margin: 0;
}

/* Portal Grid */
.portal-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
  gap: 28px;
  max-width: 1020px;
  margin: 0 auto;
}
.portal-card {
  background: #ffffff;
  border: 1px solid var(--border, #DCE6EE);
  border-radius: 16px;
  padding: 32px;
  box-shadow: 0 4px 18px rgba(16, 58, 92, 0.05);
  display: flex;
  flex-direction: column;
  position: relative;
  transition: transform .2s ease, box-shadow .2s ease;
}
.portal-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 10px 28px rgba(16, 58, 92, 0.1);
}
.portal-header {
  display: flex;
  align-items: center;
  gap: 14px;
  margin-bottom: 18px;
}
.portal-icon {
  width: 52px;
  height: 52px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.8rem;
  background: var(--brand-light, #E8F0F7);
}
.portal-card h3 {
  font-size: 1.25rem;
  font-weight: 700;
  color: var(--brand, #103A5C);
  margin: 0 0 4px;
}
.portal-card .portal-sub {
  font-size: 0.85rem;
  color: var(--mut, #5A6B7B);
  font-weight: 600;
}
.step-list {
  margin: 0 0 24px;
  padding-left: 0;
  list-style: none;
  font-size: 0.95rem;
  color: #334155;
  flex-grow: 1;
}
.step-list li {
  position: relative;
  padding-left: 32px;
  margin-bottom: 14px;
  line-height: 1.5;
}
.step-list li::before {
  content: counter(step-counter);
  counter-increment: step-counter;
  position: absolute;
  left: 0;
  top: 1px;
  width: 22px;
  height: 22px;
  border-radius: 50%;
  background: var(--brand, #103A5C);
  color: #fff;
  font-size: 0.75rem;
  font-weight: 700;
  display: flex;
  align-items: center;
  justify-content: center;
}
.portal-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  background: var(--brand, #103A5C);
  color: #fff;
  text-decoration: none;
  padding: 13px 20px;
  border-radius: 10px;
  font-weight: 700;
  font-size: 0.95rem;
  text-align: center;
  transition: all .2s ease;
}
.portal-btn:hover {
  background: var(--brand-mid, #16486E);
  color: #fff;
}
.portal-btn.btn-accent {
  background: var(--accent, #F06A25);
}
.portal-btn.btn-accent:hover {
  background: var(--accent-dark, #C2410C);
}

/* Local Search Box for Alumni */
.local-search-container {
  max-width: 680px;
  margin: 0 auto;
  background: #ffffff;
  border: 1px solid var(--border, #DCE6EE);
  border-radius: 16px;
  padding: 32px;
  box-shadow: 0 6px 24px rgba(0,0,0,0.04);
}
.local-search-box {
  display: flex;
  gap: 10px;
  margin-top: 16px;
}
@media (max-width: 640px) {
  .local-search-box {
    flex-direction: column;
  }
}
.local-search-box input {
  flex-grow: 1;
  padding: 14px 18px;
  border: 2px solid var(--border, #DCE6EE);
  border-radius: 10px;
  font-size: 1rem;
  font-family: monospace;
  text-transform: uppercase;
  letter-spacing: 1px;
}
.local-search-box input:focus {
  outline: none;
  border-color: var(--brand, #103A5C);
  box-shadow: 0 0 0 4px rgba(16, 58, 92, 0.08);
}
.local-search-box button {
  background: var(--accent, #F06A25);
  color: #fff;
  border: none;
  padding: 14px 24px;
  border-radius: 10px;
  font-size: 1rem;
  font-weight: 700;
  cursor: pointer;
  white-space: nowrap;
  transition: background .2s ease;
}
.local-search-box button:hover {
  background: var(--accent-dark, #C2410C);
}

/* Result Styles */
.result-box {
  margin-top: 24px;
  border-radius: 14px;
  padding: 24px;
  text-align: center;
}
.result-valid {
  background: #F0FDF4;
  border: 2px solid #059669;
}
.result-invalid {
  background: #FFF1F2;
  border: 2px solid #E11D48;
}
.cert-table {
  background: #ffffff;
  border-radius: 10px;
  border: 1px solid #E2E8F0;
  margin-top: 16px;
  padding: 14px 20px;
  text-align: left;
}
.cert-row {
  display: flex;
  justify-content: space-between;
  padding: 8px 0;
  border-bottom: 1px solid #F1F5F9;
  font-size: 0.92rem;
}
.cert-row:last-child {
  border-bottom: none;
}
.cert-row .lbl { color: #64748B; }
.cert-row .val { font-weight: 700; color: #0F172A; }

/* Features & Characteristics Grid */
.features-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: 20px;
  max-width: 1040px;
  margin: 0 auto;
}
.feature-card {
  background: #ffffff;
  border: 1px solid var(--border, #DCE6EE);
  border-radius: 12px;
  padding: 22px;
  text-align: left;
}
.feature-card .feat-icon {
  font-size: 2rem;
  margin-bottom: 12px;
}
.feature-card h4 {
  font-size: 1.05rem;
  font-weight: 700;
  color: var(--brand, #103A5C);
  margin: 0 0 8px;
}
.feature-card p {
  font-size: 0.88rem;
  color: var(--mut, #5A6B7B);
  line-height: 1.5;
  margin: 0;
}

/* CTA Banner */
.renewal-cta {
  background: linear-gradient(135deg, var(--brand-dark, #0B2C46) 0%, var(--brand, #103A5C) 100%);
  border-radius: 20px;
  padding: 48px 32px;
  color: #ffffff;
  text-align: center;
  max-width: 960px;
  margin: 0 auto;
  box-shadow: 0 12px 36px rgba(11, 44, 70, 0.15);
}
.renewal-cta h3 {
  font-size: clamp(1.6rem, 3.2vw, 2.3rem);
  font-weight: 800;
  margin: 0 0 14px;
}
.renewal-cta p {
  font-size: 1.05rem;
  opacity: 0.92;
  max-width: 680px;
  margin: 0 auto 28px;
  line-height: 1.6;
}
.cta-buttons {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  gap: 16px;
}
.cta-btn-wa {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  background: #25D366;
  color: #ffffff;
  text-decoration: none;
  font-weight: 700;
  font-size: 1.05rem;
  padding: 14px 28px;
  border-radius: 12px;
  box-shadow: 0 4px 14px rgba(37, 211, 102, 0.35);
  transition: all .2s ease;
}
.cta-btn-wa:hover {
  background: #1EBE5B;
  color: #fff;
  transform: translateY(-2px);
}
.cta-btn-schedule {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  background: var(--accent, #F06A25);
  color: #ffffff;
  text-decoration: none;
  font-weight: 700;
  font-size: 1.05rem;
  padding: 14px 28px;
  border-radius: 12px;
  box-shadow: 0 4px 14px rgba(240, 106, 37, 0.35);
  transition: all .2s ease;
}
.cta-btn-schedule:hover {
  background: var(--accent-dark, #C2410C);
  color: #fff;
  transform: translateY(-2px);
}

/* FAQ Section */
.faq-wrap {
  max-width: 820px;
  margin: 0 auto;
}
.faq-item {
  background: #ffffff;
  border: 1px solid var(--border, #DCE6EE);
  border-radius: 12px;
  margin-bottom: 14px;
  padding: 20px 24px;
}
.faq-item h4 {
  margin: 0 0 10px;
  font-size: 1.05rem;
  font-weight: 700;
  color: var(--brand, #103A5C);
}
.faq-item p {
  margin: 0;
  font-size: 0.95rem;
  color: #475569;
  line-height: 1.6;
}
</style>
</head>
<body>
<?php include __DIR__ . '/../includes/navbar.php'; ?>

<!-- HERO SECTION -->
<header class="verif-hero">
  <div class="container">
    <div class="badge-tag">🛡️ Panduan Resmi & Verifikasi K3</div>
    <h1>Panduan Cek & Verifikasi Keaslian Sertifikat K3 Online</h1>
    <p>Cek keaslian sertifikat dan lisensi K3 Kemnaker RI melalui TemanK3, BNSP, serta portal verifikasi alumni Wahana Totalita Konsultan.</p>
    
    <div class="quick-nav">
      <a href="#portal-resmi">🌐 Portal Kemnaker & BNSP</a>
      <a href="#verifikasi-wahana">🔍 Cek Sertifikat Alumni</a>
      <a href="#ciri-keaslian">📜 Ciri Sertifikat Asli</a>
      <a href="#renewal">⏳ Perpanjangan Lisensi (Renewal)</a>
    </div>
  </div>
</header>

<!-- SECTION 1: RESMI KEMNAKER & BNSP DIRECTORY -->
<section class="verif-section verif-section-alt" id="portal-resmi">
  <div class="container">
    <div class="section-title">
      <h2>Cara Cek Sertifikat Melalui Portal Resmi Pemerintah</h2>
      <p>Untuk sertifikat yang diterbitkan oleh Kementerian Ketenagakerjaan RI atau Badan Nasional Sertifikasi Profesi, gunakan jalur resmi di bawah ini:</p>
    </div>

    <div class="portal-grid">
      <!-- Kemnaker RI -->
      <div class="portal-card">
        <div class="portal-header">
          <div class="portal-icon">🏛️</div>
          <div>
            <h3>Kemnaker RI (TemanK3)</h3>
            <span class="portal-sub">Layanan Langsung e-PERSONEL & SKP K3</span>
          </div>
        </div>
        <p style="font-size:0.92rem;color:#475569;margin-bottom:14px">Pengecekan langsung Surat Keputusan Penunjukan (SKP) dan Lisensi Ahli K3 Umum, Operator, Paramedis, & Teknisi:</p>
        <ol class="step-list" style="counter-reset: step-counter;">
          <li>Klik tombol verifikasi langsung di bawah untuk menuju form pencarian resmi Kemnaker.</li>
          <li>Ketikkan <strong>Nama Lengkap</strong> dan <strong>Tanggal Lahir</strong> atau Nomor Register lisensi Anda.</li>
          <li>Sistem TemanK3 akan memvalidasi status keaktifan lisensi & masa berlakunya.</li>
        </ol>
        <div style="display:flex;flex-direction:column;gap:10px;margin-top:auto">
          <a href="https://temank3.kemnaker.go.id/page/cari_personel" target="_blank" rel="noopener nofollow" class="portal-btn">
            🔍 Form Cek Sertifikat & Lisensi (TemanK3) ↗
          </a>
          <a href="https://temank3.kemnaker.go.id/page/cari_skp_ahli" target="_blank" rel="noopener nofollow" style="text-align:center;font-size:0.85rem;color:var(--brand,#103A5C);font-weight:600;text-decoration:none">
            📄 Cek SKP & Kartu Kewenangan Ahli K3 ↗
          </a>
        </div>
      </div>

      <!-- BNSP -->
      <div class="portal-card">
        <div class="portal-header">
          <div class="portal-icon">🦅</div>
          <div>
            <h3>BNSP (Badan Nasional Sertifikasi Profesi)</h3>
            <span class="portal-sub">Layanan Cek Sertifikasi Kompetensi</span>
          </div>
        </div>
        <p style="font-size:0.92rem;color:#475569;margin-bottom:14px">Pengecekan langsung Sertifikat Kompetensi Profesi K3 yang diterbitkan melalui LSP berlisensi BNSP:</p>
        <ol class="step-list" style="counter-reset: step-counter;">
          <li>Klik tombol cek sertifikat BNSP di bawah untuk membuka sistem verifikasi pusat.</li>
          <li>Masukkan <strong>Nomor Blanko</strong> atau <strong>Nomor Sertifikat</strong> yang tertera pada sertifikat fisik.</li>
          <li>Periksa kecocokan nama, bidang kompetensi K3, dan masa berlakunya.</li>
        </ol>
        <div style="display:flex;flex-direction:column;gap:10px;margin-top:auto">
          <a href="https://bnsp.go.id/check-certification" target="_blank" rel="noopener nofollow" class="portal-btn btn-accent">
            🔍 Form Pengecekan Sertifikat BNSP ↗
          </a>
          <a href="https://bnsp.go.id/list-sertifikasi" target="_blank" rel="noopener nofollow" style="text-align:center;font-size:0.85rem;color:var(--accent,#F06A25);font-weight:600;text-decoration:none">
            📋 Cek Daftar Skema & Jadwal Sertifikasi BNSP ↗
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 2: CEK SERTIFIKAT ALUMNI WAHANA TOTALITA -->
<section class="verif-section" id="verifikasi-wahana">
  <div class="container">
    <div class="section-title">
      <h2>Verifikasi Sertifikat Alumni Wahana Totalita</h2>
      <p>Khusus peserta yang menyelesaikan pelatihan sertifikasi langsung bersama <strong>PT Wahana Totalita Konsultan</strong>.</p>
    </div>

    <div class="local-search-container">
      <p style="margin:0 0 8px;font-size:0.95rem;color:#334155;text-align:center">
        Masukkan nomor sertifikat pelatihan internal Anda di bawah ini:
      </p>
      
      <form method="GET" action="/verifikasi/#verifikasi-wahana">
        <div class="local-search-box">
          <input type="text" name="cert" value="<?= e($certNum) ?>" placeholder="Contoh: CERT-2024-XXXXXX" autocomplete="off" required>
          <button type="submit">🔍 Cek Data</button>
        </div>
      </form>

      <?php if ($searched): ?>
        <?php if ($result && ($result['is_valid'] ?? true)): ?>
          <div class="result-box result-valid">
            <div style="font-size:2.4rem;margin-bottom:6px">✅</div>
            <h3 style="color:#059669;margin:0 0 6px">Sertifikat Terverifikasi Valid</h3>
            <p style="color:#475569;margin:0;font-size:0.9rem">Data sertifikat terdaftar resmi dalam sistem pelatihan Wahana Totalita Konsultan.</p>
            
            <div class="cert-table">
              <div class="cert-row"><span class="lbl">No. Sertifikat</span><span class="val" style="font-family:monospace"><?= e($result['cert_number']) ?></span></div>
              <div class="cert-row"><span class="lbl">Nama Pemegang</span><span class="val"><?= e($result['holder_name'] ?? $result['client_name'] ?? '-') ?></span></div>
              <div class="cert-row"><span class="lbl">Program Pelatihan</span><span class="val"><?= e($result['training_name'] ?? '-') ?></span></div>
              <div class="cert-row"><span class="lbl">Tanggal Selesai</span><span class="val"><?= format_date($result['completion_date'] ?? $result['issued_date'] ?? date('Y-m-d')) ?></span></div>
              <?php if (!empty($result['expiry_date'])): ?>
              <div class="cert-row"><span class="lbl">Masa Berlaku</span><span class="val" style="color:<?= strtotime($result['expiry_date']) < time() ? '#dc2626' : '#059669' ?>"><?= format_date($result['expiry_date']) ?></span></div>
              <?php endif; ?>
            </div>

            <div style="margin-top:20px;display:flex;gap:12px;justify-content:center;flex-wrap:wrap">
              <a href="<?= wa_url('Halo Wahana Totalita, saya ingin konfirmasi sertifikat nomor ' . $certNum) ?>" class="portal-btn" style="background:#059669;padding:10px 20px">💬 Konfirmasi Resmi via WhatsApp</a>
              <a href="/jadwal/" class="portal-btn btn-accent" style="padding:10px 20px">📅 Jadwal Pelatihan & Renewal</a>
            </div>
          </div>
        <?php else: ?>
          <div class="result-box result-invalid">
            <div style="font-size:2.4rem;margin-bottom:6px">ℹ️</div>
            <h3 style="color:#E11D48;margin:0 0 8px">Nomor Tidak Ditemukan di Arsip Kami</h3>
            <p style="color:#475569;font-size:0.92rem;line-height:1.6;margin:0 0 16px">
              Nomor sertifikat <strong><?= e($certNum) ?></strong> tidak terdaftar dalam database alumni internal Wahana Totalita.
            </p>
            <div style="background:#fff;border-radius:10px;padding:16px;text-align:left;font-size:0.88rem;color:#475569;border:1px solid #FECDD3">
              <strong>Catatan Penting:</strong>
              <ul style="margin:8px 0 0;padding-left:20px">
                <li>Jika sertifikat Anda dikeluarkan oleh lembaga/PJK3 lain, periksa langsung di portal nasional <a href="https://temank3.kemnaker.go.id" target="_blank" rel="noopener nofollow" style="color:#0284c7;font-weight:600">TemanK3 Kemnaker</a> atau <a href="https://bnsp.go.id" target="_blank" rel="noopener nofollow" style="color:#0284c7;font-weight:600">BNSP</a> di atas.</li>
                <li>Jika Anda adalah alumni Wahana Totalita namun data belum tampil, silakan kirim foto sertifikat Anda ke admin kami untuk pengecekan berkas fisik.</li>
              </ul>
            </div>
            <a href="<?= wa_url('Halo admin Wahana Totalita, mohon bantuan cek nomor sertifikat ' . $certNum) ?>" class="portal-btn" style="background:#103A5C;margin-top:16px;padding:11px 22px">
              💬 Bantuan Pengecekan via WhatsApp
            </a>
          </div>
        <?php endif; ?>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- SECTION 3: CIRI-CIRI KEASLIAN SERTIFIKAT K3 -->
<section class="verif-section verif-section-alt" id="ciri-keaslian">
  <div class="container">
    <div class="section-title">
      <h2>Ciri-Ciri Sertifikat K3 Resmi & Asli</h2>
      <p>Pastikan sertifikat K3 yang Anda miliki atau terima memenuhi standar keaslian berikut:</p>
    </div>

    <div class="features-grid">
      <div class="feature-card">
        <div class="feat-icon">✨</div>
        <h4>1. Blanko Resmi & Hologram</h4>
        <p>Sertifikat Kemnaker RI dan BNSP menggunakan kertas blanko resmi dengan hologram pengaman khusus serta cap lambang negara (Garuda Emas).</p>
      </div>

      <div class="feature-card">
        <div class="feat-icon">🔢</div>
        <h4>2. Nomor Registrasi Unik</h4>
        <p>Memiliki nomor seri registrasi yang sinkron dengan database Kementerian Ketenagakerjaan RI atau sistem Badan Nasional Sertifikasi Profesi.</p>
      </div>

      <div class="feature-card">
        <div class="feat-icon">✍️</div>
        <h4>3. Pejabat & QR Validasi</h4>
        <p>Ditandatangani oleh pejabat resmi Kemnaker RI (Direktur Bina Kelembagaan K3) atau Master Assesor LSP BNSP, disertai barcode/QR code verifikasi.</p>
      </div>

      <div class="feature-card">
        <div class="feat-icon">🏢</div>
        <h4>4. Diselenggarakan PJK3 Resmi</h4>
        <p>Hanya diselenggarakan oleh Perusahaan Jasa K3 (PJK3) berizin resmi seperti PT Wahana Totalita Konsultan, bukan perorangan atau calo.</p>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 4: HIGH-CONVERTING CTA BANNER (RENEWAL & PELATIHAN BARU) -->
<section class="verif-section" id="renewal">
  <div class="container">
    <div class="renewal-cta">
      <h3>Masa Berlaku Sertifikat K3 Anda Habis?</h3>
      <p>
        Lisensi K3 Kemnaker dan Sertifikat Kompetensi BNSP wajib diperpanjang (renewal) setiap <strong>3 tahun</strong> agar tetap sah digunakan dalam pekerjaan dan audit SMK3 perusahaan. Wahana Totalita siap membantu proses perpanjangan secara resmi, cepat, dan terpercaya.
      </p>
      
      <div class="cta-buttons">
        <a href="<?= wa_url('Halo Wahana Totalita, saya ingin konsultasi perpanjangan (renewal) lisensi / sertifikat K3') ?>" class="cta-btn-wa">
          💬 Konsultasi Renewal via WhatsApp
        </a>
        <a href="/jadwal/" class="cta-btn-schedule">
          📅 Jadwal Pelatihan K3 Terbaru
        </a>
      </div>
    </div>
  </div>
</section>

<!-- SECTION 5: FAQ ACCORDION / LIST -->
<section class="verif-section verif-section-alt">
  <div class="container">
    <div class="section-title">
      <h2>Pertanyaan Umum (FAQ)</h2>
      <p>Jawaban seputar pengecekan dan masa berlaku sertifikat K3</p>
    </div>

    <div class="faq-wrap">
      <div class="faq-item">
        <h4>Berapa lama masa berlaku sertifikat & lisensi K3?</h4>
        <p>Surat Keputusan Penunjukan (SKP) dan Lisensi K3 dari Kemnaker RI berlaku selama 3 tahun. Sertifikat Kompetensi BNSP juga memiliki masa berlaku 3 tahun dan harus diperpanjang (asesmen ulang/renewal) sebelum habis masa berlakunya.</p>
      </div>

      <div class="faq-item">
        <h4>Mengapa nomor sertifikat saya tidak ditemukan di TemanK3?</h4>
        <p>Kemungkinan penyebabnya: (1) Ada jeda waktu pemrosesan data (batch baru membutuhkan waktu sinkronisasi ke server pusat Kemnaker), (2) Terdapat salah ketik karakter nomor registrasi atau NIK, atau (3) Sertifikat diterbitkan oleh lembaga tidak resmi / tidak berizin.</p>
      </div>

      <div class="faq-item">
        <h4>Apakah sertifikat K3 yang mati/kadaluwarsa masih bisa diperpanjang?</h4>
        <p>Bisa! Anda dapat mengajukan perpanjangan lisensi K3 melalui PJK3 resmi Wahana Totalita dengan melampirkan berkas sertifikat lama, fotokopi KTP, pas foto, dan surat keterangan masih aktif bekerja dari perusahaan Anda.</p>
      </div>

      <div class="faq-item">
        <h4>Apa perbedaan sertifikat K3 Kemnaker RI dengan K3 BNSP?</h4>
        <p>Sertifikat Kemnaker RI memberikan Lisensi Kewenangan hukum bagi tenaga kerja (seperti Ahli K3 Umum, Operator Crane, dll) untuk ditunjuk di perusahaan sesuai regulasi Ketenagakerjaan. Sedangkan Sertifikat BNSP merupakan bukti pengakuan kompetensi kerja berbasis standar SKKNI.</p>
      </div>
    </div>
  </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
<script src="<?= SITE_URL ?>/assets/js/main.js"></script>
</body>
</html>
