<?php
/**
 * workplace/index.php
 * Dashboard K3 Perusahaan & Workplace HSE Management Hub.
 * 100% Standalone (DB-Free, zero dependency, 200 OK guaranteed).
 * Ranks for: "dashboard k3", "dashboard k3 perusahaan", "template dashboard hse excel", "monitoring k3 perusahaan"
 */
require_once __DIR__ . '/../config.php';

$s = get_all_settings();

$page_title = 'Dashboard K3 Perusahaan: Sistem Monitoring HSE & Template Excel Gratis';
$meta_desc = 'Pusat Dashboard K3 Perusahaan & Toolkit Monitoring HSE terlengkap. Dilengkapi simulasi kepatuhan online, template spreadsheet Excel FR/SR, dan program in-house training.';
$canonical_url = SITE_URL . '/workplace/';

ob_start();
require __DIR__ . '/../includes/head.php';
$shared_head = ob_get_clean();
$shared_head = preg_replace('~<title>.*?</title>~s', '<title>' . e($page_title) . '</title>', $shared_head, 1);
echo $shared_head;
?>
<style>
/* ─── Hero Executive Workplace ────────────────────────────── */
.wp-hero {
  position: relative;
  background: radial-gradient(1000px circle at 80% 15%, rgba(10, 74, 46, 0.45) 0%, rgba(16, 58, 92, 0.4) 45%, #0B1523 90%), #070e17;
  padding: clamp(54px, 7vw, 86px) 0 clamp(44px, 5vw, 68px);
  text-align: center;
  overflow: hidden;
  border-bottom: 1px solid rgba(255, 255, 255, 0.08);
}
.wp-hero::before {
  content: '';
  position: absolute; inset: 0;
  background-image: radial-gradient(rgba(255, 255, 255, 0.07) 1px, transparent 1px);
  background-size: 24px 24px;
  pointer-events: none;
}
.wp-hero .container { position: relative; z-index: 1; }
.wp-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-family: ui-monospace, monospace;
  font-size: 11.5px;
  font-weight: 700;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  color: #34d399;
  background: rgba(16, 185, 129, 0.12);
  border: 1px solid rgba(52, 211, 153, 0.28);
  padding: 4px 14px;
  border-radius: 999px;
  margin-bottom: 18px;
}
.wp-hero h1 {
  font-family: 'Lexend', system-ui, sans-serif;
  font-size: clamp(2rem, 4.4vw, 3rem);
  font-weight: 800;
  color: #ffffff;
  margin: 0 auto 16px;
  letter-spacing: -0.02em;
  max-width: 900px;
  line-height: 1.25;
}
.wp-hero p {
  font-size: 16px;
  color: #94a3b8;
  max-width: 720px;
  margin: 0 auto 30px;
  line-height: 1.7;
}
.wp-hero-actions {
  display: flex;
  gap: 14px;
  justify-content: center;
  flex-wrap: wrap;
}
.btn-wp-primary {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: linear-gradient(135deg, var(--o500, #F06A25), var(--o400, #F78F54));
  color: #fff !important;
  font-weight: 700;
  font-size: 15px;
  padding: 14px 28px;
  border-radius: 12px;
  text-decoration: none;
  box-shadow: 0 10px 24px -8px rgba(240, 106, 37, 0.6);
  transition: transform .2s, box-shadow .2s;
}
.btn-wp-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 14px 30px -8px rgba(240, 106, 37, 0.7);
}
.btn-wp-secondary {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: rgba(255, 255, 255, 0.08);
  color: #ffffff !important;
  border: 1px solid rgba(255, 255, 255, 0.2);
  backdrop-filter: blur(8px);
  font-weight: 700;
  font-size: 15px;
  padding: 14px 26px;
  border-radius: 12px;
  text-decoration: none;
  transition: all .2s;
}
.btn-wp-secondary:hover {
  background: rgba(255, 255, 255, 0.16);
  border-color: #38bdf8;
  color: #38bdf8 !important;
  transform: translateY(-2px);
}

/* ─── Interactive Live Dashboard Preview (Zero DB) ────────── */
.wp-preview-wrap {
  margin-top: 48px;
  background: rgba(15, 23, 42, 0.85);
  border: 1px solid rgba(255, 255, 255, 0.15);
  border-radius: 20px;
  padding: 30px;
  box-shadow: 0 30px 60px -20px rgba(0, 0, 0, 0.6);
  backdrop-filter: blur(16px);
  text-align: left;
}
.wp-preview-head {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 16px;
  padding-bottom: 20px;
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}
.wp-preview-title {
  color: #fff;
  font-size: 1.15rem;
  font-weight: 700;
  margin: 0;
}
.wp-preview-tabs {
  display: flex;
  gap: 8px;
  background: rgba(255, 255, 255, 0.06);
  padding: 4px;
  border-radius: 10px;
}
.wp-tab-btn {
  background: none;
  border: none;
  color: #94a3b8;
  padding: 6px 14px;
  font-size: 12.5px;
  font-weight: 600;
  border-radius: 8px;
  cursor: pointer;
  transition: all .2s;
}
.wp-tab-btn.active {
  background: #0284c7;
  color: #fff;
}
.wp-metrics-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
  gap: 18px;
  margin: 24px 0;
}
.wp-metric-card {
  background: rgba(255, 255, 255, 0.04);
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 14px;
  padding: 18px;
}
.wp-metric-lbl {
  font-size: 12px;
  color: #94a3b8;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: .05em;
  margin-bottom: 6px;
}
.wp-metric-val {
  font-size: 1.85rem;
  font-weight: 800;
  color: #fff;
  font-family: 'Lexend', sans-serif;
}
.wp-metric-val.green { color: #34d399; }
.wp-metric-val.orange { color: #fb923c; }
.wp-metric-sub {
  font-size: 11.5px;
  color: #64748b;
  margin-top: 4px;
}

/* ─── Toolkit & Download Section ───────────────────────────── */
.wp-download-section {
  padding: 72px 0;
  background: #ffffff;
}
.wp-section-head {
  text-align: center;
  max-width: 680px;
  margin: 0 auto 48px;
}
.wp-section-head h2 {
  font-size: clamp(1.6rem, 3vw, 2.2rem);
  font-weight: 800;
  color: #0f172a;
  margin: 0 0 12px;
}
.wp-section-head p {
  font-size: 15px;
  color: #64748b;
  line-height: 1.6;
  margin: 0;
}
.wp-card-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 24px;
}
.wp-tool-card {
  border-radius: 16px;
  border: 1px solid #e2e8f0;
  background: #f8fafc;
  padding: 28px;
  display: flex;
  flex-direction: column;
  transition: transform .2s, box-shadow .2s;
}
.wp-tool-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 14px 30px -10px rgba(16, 58, 92, 0.12);
  background: #fff;
}
.wp-tool-badge {
  align-self: flex-start;
  font-size: 11.5px;
  font-weight: 700;
  color: #0369a1;
  background: #e0f2fe;
  padding: 4px 10px;
  border-radius: 6px;
  margin-bottom: 16px;
}
.wp-tool-card h3 {
  font-size: 1.25rem;
  font-weight: 700;
  color: #0f172a;
  margin: 0 0 10px;
}
.wp-tool-card p {
  font-size: 14px;
  color: #475569;
  line-height: 1.6;
  margin-bottom: 20px;
  flex-grow: 1;
}
.wp-tool-feats {
  list-style: none;
  padding: 0;
  margin: 0 0 24px;
  display: flex;
  flex-direction: column;
  gap: 8px;
  font-size: 13px;
  color: #334155;
}
.wp-tool-feats li::before {
  content: "✓";
  color: #10b981;
  font-weight: bold;
  margin-right: 8px;
}

/* ─── Compliance Pillars ───────────────────────────────────── */
.wp-roles-section {
  padding: 72px 0;
  background: #f1f5f9;
  border-top: 1px solid #e2e8f0;
  border-bottom: 1px solid #e2e8f0;
}
.wp-role-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 24px;
}
.wp-role-card {
  background: #fff;
  border-radius: 16px;
  padding: 28px;
  border: 1px solid #e2e8f0;
}
.wp-role-card h3 {
  font-size: 1.2rem;
  font-weight: 700;
  color: #0f172a;
  margin: 0 0 8px;
}
.wp-role-card .role-subtitle {
  font-size: 12.5px;
  color: #0369a1;
  font-weight: 600;
  margin-bottom: 16px;
}
.wp-role-card ul {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: 10px;
  font-size: 13.5px;
  color: #475569;
}
.wp-role-card ul li::before {
  content: "•";
  color: #0284c7;
  font-weight: bold;
  margin-right: 8px;
}

/* ─── CTA Banner ───────────────────────────────────────────── */
.wp-cta-banner {
  background: linear-gradient(135deg, #092015 0%, #0F3826 100%);
  color: #fff;
  border-radius: 20px;
  padding: 44px 40px;
  margin: 54px auto;
  box-shadow: 0 20px 40px -15px rgba(10, 74, 46, 0.4);
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 32px;
  flex-wrap: wrap;
}
.wp-cta-copy h2 {
  font-size: clamp(1.4rem, 2.6vw, 1.9rem);
  font-weight: 800;
  margin: 0 0 10px;
  color: #fff;
}
.wp-cta-copy p {
  font-size: 14.5px;
  color: #bbf7d0;
  margin: 0;
  max-width: 580px;
  line-height: 1.6;
}
</style>

<!-- HERO -->
<section class="wp-hero">
  <div class="container">
    <div class="wp-eyebrow">Enterprise HSE &amp; Compliance Hub</div>
    <h1>Dashboard K3 Perusahaan &amp; Monitoring HSE Digital</h1>
    <p>Kelola keselamatan kerja, pantau masa berlaku sertifikasi &amp; lisensi K3 karyawan, serta unduh template dashboard HSE terintegrasi berbasis standar Kemnaker RI dan SMK3 PP 50/2012.</p>

    <div class="wp-hero-actions">
      <a href="#toolkit" class="btn-wp-primary">
        <span>📊 Unduh Template Dashboard Excel</span>
      </a>
      <a href="<?= wa_url('Halo Wahana Totalita, saya ingin konsultasi sistem monitoring K3 & In-House Training untuk perusahaan kami') ?>" class="btn-wp-secondary" target="_blank" rel="noopener">
        <span>💬 Konsultasi In-House Training</span>
      </a>
    </div>

    <!-- Live Preview Interactive Dashboard Component -->
    <div class="wp-preview-wrap">
      <div class="wp-preview-head">
        <div>
          <h2 class="wp-preview-title">Preview Sistem Monitoring K3 (Live Mockup)</h2>
          <span style="font-size:12px;color:#94a3b8">PT Industri Manufaktur &amp; Konstruksi Indonesia</span>
        </div>
        <div class="wp-preview-tabs">
          <button class="wp-tab-btn active" onclick="switchTab('hse', this)">HSE Manager</button>
          <button class="wp-tab-btn" onclick="switchTab('hr', this)">HR Dept</button>
          <button class="wp-tab-btn" onclick="switchTab('ceo', this)">Executive / CEO</button>
        </div>
      </div>

      <div class="wp-metrics-grid" id="metrics-container">
        <div class="wp-metric-card">
          <div class="wp-metric-lbl">Tingkat Kepatuhan (SMK3)</div>
          <div class="wp-metric-val green" id="val-comp">94.8%</div>
          <div class="wp-metric-sub">Kategori Tingkat Lanjutan</div>
        </div>
        <div class="wp-metric-card">
          <div class="wp-metric-lbl">Lisensi Aktif Karyawan</div>
          <div class="wp-metric-val" id="val-cert">48 / 52</div>
          <div class="wp-metric-sub">4 Segera Expired (< 60 hari)</div>
        </div>
        <div class="wp-metric-card">
          <div class="wp-metric-lbl">Safe Man-Hours (LTI Free)</div>
          <div class="wp-metric-val green" id="val-hours">428.500</div>
          <div class="wp-metric-sub">Jam Kerja Tanpa Kecelakaan</div>
        </div>
        <div class="wp-metric-card">
          <div class="wp-metric-lbl">Frequency Rate (FR)</div>
          <div class="wp-metric-val" id="val-fr">0.00</div>
          <div class="wp-metric-sub">Kepmenaker No. 372/1989</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- DOWNLOADABLE TOOLKIT SECTION -->
<section class="wp-download-section" id="toolkit">
  <div class="container">
    <div class="wp-section-head">
      <h2>Template &amp; Toolkit Dashboard K3 Perusahaan</h2>
      <p>Unduh spreadsheet dan framework kerja resmi untuk membantu divisi HSE &amp; HR mengotomasi pencatatan statistik dan kepatuhan hukum K3 di tempat kerja.</p>
    </div>

    <div class="wp-card-grid">
      <div class="wp-tool-card">
        <span class="wp-tool-badge">Spreadsheet Excel (.xlsx)</span>
        <h3>Template Dashboard HSE &amp; Statistik K3</h3>
        <p>Workbook spreadsheet lengkap dengan formula otomatis untuk menghitung Frequency Rate (FR), Severity Rate (SR), Safe Man-Hours, dan grafik piramida kecelakaan kerja.</p>
        <ul class="wp-tool-feats">
          <li>Formula otomatis FR &amp; SR (Kepmenaker 372/1989)</li>
          <li>Kalkulator Jam Kerja Orang Selamat bulanan</li>
          <li>Grafik visualisasi siap dimasukkan ke laporan P2K3</li>
        </ul>
        <a href="<?= wa_url('Halo Wahana Totalita, saya ingin meminta file Template Dashboard HSE & Statistik K3 (Excel)') ?>" class="btn-wp-primary" target="_blank" rel="noopener" style="text-align:center;justify-content:center;">
          📥 Download Template Excel via WA
        </a>
      </div>

      <div class="wp-tool-card">
        <span class="wp-tool-badge">Competency Matrix</span>
        <h3>Matriks Sertifikasi &amp; Lisensi K3</h3>
        <p>Template spreadsheet untuk melacak masa berlaku SKP Ahli K3, Lisensi SIO Forklift, Crane, Juru Las, dan K3 Listrik agar tidak terlewat masa perpanjangannya.</p>
        <ul class="wp-tool-feats">
          <li>Conditional formatting reminder warna (90/60/30 hari)</li>
          <li>Daftar regulasi acuan wajib per jenjang kompetensi</li>
          <li>Integrasi jadwal refresh pelatihan Wahana Totalita</li>
        </ul>
        <a href="<?= wa_url('Halo Wahana Totalita, saya ingin meminta Matriks Sertifikasi & Lisensi K3 Karyawan') ?>" class="btn-wp-primary" target="_blank" rel="noopener" style="text-align:center;justify-content:center;">
          📥 Download Matriks Lisensi
        </a>
      </div>

      <div class="wp-tool-card">
        <span class="wp-tool-badge">Audit Framework</span>
        <h3>Checklist Audit SMK3 (166 Kriteria)</h3>
        <p>Panduan checklist penilaian mandiri (self-assessment) Sistem Manajemen Keselamatan dan Kesehatan Kerja sesuai Peraturan Pemerintah No. 50 Tahun 2012.</p>
        <ul class="wp-tool-feats">
          <li>166 Kriteria audit tingkat lanjutan</li>
          <li>Kalkulasi persentase kepatuhan (Bendera Emas/Perak)</li>
          <li>Daftar bukti dokumen pemenuhan regulasi</li>
        </ul>
        <a href="<?= wa_url('Halo Wahana Totalita, saya ingin meminta Checklist Audit SMK3 PP 50/2012') ?>" class="btn-wp-primary" target="_blank" rel="noopener" style="text-align:center;justify-content:center;">
          📥 Download Checklist SMK3
        </a>
      </div>
    </div>

    <!-- CORPORATE CTA -->
    <div class="wp-cta-banner">
      <div class="wp-cta-copy">
        <h2>Perlu Training &amp; Sertifikasi untuk Tim Perusahaan Anda?</h2>
        <p>Wahana Totalita melayani In-House Training berlisensi Kemnaker RI &amp; BNSP dengan kurikulum yang dapat disesuaikan langsung dengan SOP dan risiko spesifik industri Anda.</p>
      </div>
      <a href="<?= wa_url('Halo Wahana Totalita, kami dari perusahaan ingin meminta penawaran proposal In-House Training K3') ?>" class="btn-wp-primary" target="_blank" rel="noopener" style="background:#25D366;box-shadow:0 8px 24px rgba(37,211,102,0.4);border:none;">
        💬 Minta Proposal In-House Training →
      </a>
    </div>
  </div>
</section>

<!-- ROLES / COMPLIANCE SECTOR -->
<section class="wp-roles-section">
  <div class="container">
    <div class="wp-section-head">
      <h2>Solusi Kepatuhan K3 Berdasarkan Kebutuhan Tim</h2>
      <p>Memastikan setiap level manajemen memiliki visibilitas dan kesiapan dokumen keselamatan kerja yang solid.</p>
    </div>

    <div class="wp-role-grid">
      <div class="wp-role-card">
        <h3>HSE &amp; Safety Officers</h3>
        <div class="role-subtitle">Implementasi Teknis &amp; Pencegahan Bahaya</div>
        <ul>
          <li>Identifikasi Bahaya &amp; Penilaian Risiko (IBPR / HIRADC)</li>
          <li>Pengawasan Izin Kerja Khusus (Permit to Work / PTW)</li>
          <li>Inspeksi APD &amp; Sertifikasi Laik Operasi (SIA / Riksa Uji)</li>
          <li>Penyusunan Laporan Triwulan P2K3 ke Disnaker</li>
        </ul>
      </div>

      <div class="wp-role-card">
        <h3>Human Resources &amp; GA</h3>
        <div class="role-subtitle">Kompetensi Karyawan &amp; Administrasi</div>
        <ul>
          <li>Perencanaan Training Need Analysis (TNA) K3 tahunan</li>
          <li>Pengelolaan kuota personil wajib K3 sesuai rasio pekerja</li>
          <li>Perpanjangan SKP Ahli K3 &amp; Lisensi Operator sebelum kedaluwarsa</li>
          <li>Pemeriksaan kesehatan kerja berkala (MCU karyawan)</li>
        </ul>
      </div>

      <div class="wp-role-card">
        <h3>Direksi &amp; Plant Managers</h3>
        <div class="role-subtitle">Mitigasi Risiko Hukum &amp; Keberlanjutan Bisnis</div>
        <ul>
          <li>Pemenuhan syarat wajib tender BUMN &amp; standar CSMS</li>
          <li>Pencegahan sanksi pidana UU No. 1 Tahun 1970</li>
          <li>Peningkatan reputasi perusahaan &amp; Zero Accident Award</li>
          <li>Efisiensi premi asuransi dan reduksi biaya akibat downtime insiden</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>

<script>
function switchTab(role, btn) {
  document.querySelectorAll('.wp-tab-btn').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');

  const comp = document.getElementById('val-comp');
  const cert = document.getElementById('val-cert');
  const hours = document.getElementById('val-hours');
  const fr = document.getElementById('val-fr');

  if (role === 'hse') {
    comp.textContent = '94.8%';
    cert.textContent = '48 / 52';
    hours.textContent = '428.500';
    fr.textContent = '0.00';
  } else if (role === 'hr') {
    comp.textContent = '91.2%';
    cert.textContent = '52 Personil';
    hours.textContent = '100% MCU';
    fr.textContent = '4 Perlu Refresh';
  } else if (role === 'ceo') {
    comp.textContent = 'Bendera Emas';
    cert.textContent = 'Zero Accident';
    hours.textContent = 'Rp 0 Klaim';
    fr.textContent = 'Peringkat A';
  }
}
</script>
</body>
</html>