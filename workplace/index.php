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
$page_css = array_merge($page_css ?? [], ['workplace']);
require __DIR__ . '/../includes/head.php';
$shared_head = ob_get_clean();
$shared_head = preg_replace('~<title>.*?</title>~s', '<title>' . e($page_title) . '</title>', $shared_head, 1);
echo $shared_head;
?>

<?php require __DIR__ . '/../includes/navbar.php'; ?>

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
          <span style="font-size:12px;color:var(--slate-400)">PT Industri Manufaktur &amp; Konstruksi Indonesia</span>
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
      <a href="<?= wa_url('Halo Wahana Totalita, kami dari perusahaan ingin meminta penawaran proposal In-House Training K3') ?>" class="btn-wp-primary" target="_blank" rel="noopener" style="background:var(--whatsapp);box-shadow:0 8px 24px color-mix(in srgb, var(--whatsapp) 40%, transparent);border:none;">
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