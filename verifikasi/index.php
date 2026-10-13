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
<?php require __DIR__ . '/../includes/css.php'; ?>

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

<link rel="stylesheet" href="<?= asset_v('/assets/css/page/verifikasi.css') ?>">
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
        <p style="font-size:0.92rem;color:var(--slate-600);margin-bottom:14px">Pengecekan langsung Surat Keputusan Penunjukan (SKP) dan Lisensi Ahli K3 Umum, Operator, Paramedis, & Teknisi:</p>
        <ol class="step-list" style="counter-reset: step-counter;">
          <li>Klik tombol verifikasi langsung di bawah untuk menuju form pencarian resmi Kemnaker.</li>
          <li>Ketikkan <strong>Nama Lengkap</strong> dan <strong>Tanggal Lahir</strong> atau Nomor Register lisensi Anda.</li>
          <li>Sistem TemanK3 akan memvalidasi status keaktifan lisensi & masa berlakunya.</li>
        </ol>
        <div style="display:flex;flex-direction:column;gap:10px;margin-top:auto">
          <a href="https://temank3.kemnaker.go.id/page/cari_personel" target="_blank" rel="noopener nofollow" class="portal-btn">
            🔍 Form Cek Sertifikat & Lisensi (TemanK3) ↗
          </a>
          <a href="https://temank3.kemnaker.go.id/page/cari_skp_ahli" target="_blank" rel="noopener nofollow" style="text-align:center;font-size:0.85rem;color:var(--brand,var(--brand));font-weight:600;text-decoration:none">
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
        <p style="font-size:0.92rem;color:var(--slate-600);margin-bottom:14px">Pengecekan langsung Sertifikat Kompetensi Profesi K3 yang diterbitkan melalui LSP berlisensi BNSP:</p>
        <ol class="step-list" style="counter-reset: step-counter;">
          <li>Klik tombol cek sertifikat BNSP di bawah untuk membuka sistem verifikasi pusat.</li>
          <li>Masukkan <strong>Nomor Blanko</strong> atau <strong>Nomor Sertifikat</strong> yang tertera pada sertifikat fisik.</li>
          <li>Periksa kecocokan nama, bidang kompetensi K3, dan masa berlakunya.</li>
        </ol>
        <div style="display:flex;flex-direction:column;gap:10px;margin-top:auto">
          <a href="https://bnsp.go.id/check-certification" target="_blank" rel="noopener nofollow" class="portal-btn btn-accent">
            🔍 Form Pengecekan Sertifikat BNSP ↗
          </a>
          <a href="https://bnsp.go.id/list-sertifikasi" target="_blank" rel="noopener nofollow" style="text-align:center;font-size:0.85rem;color:var(--accent,var(--accent));font-weight:600;text-decoration:none">
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
      <p style="margin:0 0 8px;font-size:0.95rem;color:var(--slate-700);text-align:center">
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
            <h3 style="color:var(--success);margin:0 0 6px">Sertifikat Terverifikasi Valid</h3>
            <p style="color:var(--slate-600);margin:0;font-size:0.9rem">Data sertifikat terdaftar resmi dalam sistem pelatihan Wahana Totalita Konsultan.</p>
            
            <div class="cert-table">
              <div class="cert-row"><span class="lbl">No. Sertifikat</span><span class="val" style="font-family:monospace"><?= e($result['cert_number']) ?></span></div>
              <div class="cert-row"><span class="lbl">Nama Pemegang</span><span class="val"><?= e($result['holder_name'] ?? $result['client_name'] ?? '-') ?></span></div>
              <div class="cert-row"><span class="lbl">Program Pelatihan</span><span class="val"><?= e($result['training_name'] ?? '-') ?></span></div>
              <div class="cert-row"><span class="lbl">Tanggal Selesai</span><span class="val"><?= format_date($result['completion_date'] ?? $result['issued_date'] ?? date('Y-m-d')) ?></span></div>
              <?php if (!empty($result['expiry_date'])): ?>
              <div class="cert-row"><span class="lbl">Masa Berlaku</span><span class="val" style="color:<?= strtotime($result['expiry_date']) < time() ? 'var(--danger)' : 'var(--success)' ?>"><?= format_date($result['expiry_date']) ?></span></div>
              <?php endif; ?>
            </div>

            <div style="margin-top:20px;display:flex;gap:12px;justify-content:center;flex-wrap:wrap">
              <a href="<?= wa_url('Halo Wahana Totalita, saya ingin konfirmasi sertifikat nomor ' . $certNum) ?>" class="portal-btn" style="background:var(--success);padding:10px 20px">💬 Konfirmasi Resmi via WhatsApp</a>
              <a href="/jadwal/" class="portal-btn btn-accent" style="padding:10px 20px">📅 Jadwal Pelatihan & Renewal</a>
            </div>
          </div>
        <?php else: ?>
          <div class="result-box result-invalid">
            <div style="font-size:2.4rem;margin-bottom:6px">ℹ️</div>
            <h3 style="color:var(--danger);margin:0 0 8px">Nomor Tidak Ditemukan di Arsip Kami</h3>
            <p style="color:var(--slate-600);font-size:0.92rem;line-height:1.6;margin:0 0 16px">
              Nomor sertifikat <strong><?= e($certNum) ?></strong> tidak terdaftar dalam database alumni internal Wahana Totalita.
            </p>
            <div style="background:var(--surface);border-radius:10px;padding:16px;text-align:left;font-size:0.88rem;color:var(--slate-600);border:1px solid var(--danger-border)">
              <strong>Catatan Penting:</strong>
              <ul style="margin:8px 0 0;padding-left:20px">
                <li>Jika sertifikat Anda dikeluarkan oleh lembaga/PJK3 lain, periksa langsung di portal nasional <a href="https://temank3.kemnaker.go.id" target="_blank" rel="noopener nofollow" style="color:var(--info);font-weight:600">TemanK3 Kemnaker</a> atau <a href="https://bnsp.go.id" target="_blank" rel="noopener nofollow" style="color:var(--info);font-weight:600">BNSP</a> di atas.</li>
                <li>Jika Anda adalah alumni Wahana Totalita namun data belum tampil, silakan kirim foto sertifikat Anda ke admin kami untuk pengecekan berkas fisik.</li>
              </ul>
            </div>
            <a href="<?= wa_url('Halo admin Wahana Totalita, mohon bantuan cek nomor sertifikat ' . $certNum) ?>" class="portal-btn" style="background:var(--brand);margin-top:16px;padding:11px 22px">
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
