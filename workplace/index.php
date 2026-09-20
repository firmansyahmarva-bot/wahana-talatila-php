<?php
/**
 * workplace/index.php
 * Public landing page for Workplace K3 feature.
 * Non-logged-in users see the marketing page.
 * Logged-in users get redirected to their dashboard.
 */
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/workplace-functions.php';

$session = wp_get_session();
if ($session) {
    redirect(SITE_URL . '/workplace/dashboard/');
}

$s = get_all_settings();
?>
<?php
$page_title = 'Workplace K3 — Dashboard HSE, HR & CEO Perusahaan';
$meta_desc = 'Kelola K3 perusahaan Anda dengan Workplace Dashboard. Tracking sertifikat, K3 Score karyawan, laporan HSE real-time. Gratis untuk semua perusahaan.';
require __DIR__ . '/../includes/head.php';
<?= theme_css_vars($s) ?>
<style>
.wp-hero{background:linear-gradient(135deg,#1e3a5f,#2d5282);padding:80px 0;text-align:center;color:#fff}
.wp-hero h1{font-size:clamp(1.8rem,4vw,3rem);font-weight:800;margin:0 0 16px}
.wp-hero p{font-size:1.05rem;opacity:.85;max-width:600px;margin:0 auto 32px}
.hero-btns{display:flex;gap:16px;justify-content:center;flex-wrap:wrap}
.btn-primary{background:var(--orange);color:#fff;padding:16px 32px;border-radius:12px;text-decoration:none;font-weight:700;font-size:1.05rem}
.btn-secondary{background:rgba(255,255,255,.15);color:#fff;padding:16px 32px;border-radius:12px;text-decoration:none;font-weight:700;font-size:1.05rem;border:2px solid rgba(255,255,255,.3)}
.features{padding:72px 0;background:#f8f8f8}
.features h2{text-align:center;font-size:1.8rem;font-weight:800;margin:0 0 12px}
.features p.sub{text-align:center;color:#666;margin:0 0 48px}
.feat-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:24px}
.feat-card{background:#fff;border-radius:16px;border:1px solid #eee;padding:28px;box-shadow:0 2px 8px rgba(0,0,0,.05)}
.feat-card .icon{font-size:2.5rem;margin-bottom:16px}
.feat-card h3{font-size:1.05rem;font-weight:700;margin:0 0 10px;color:#2d5282}
.feat-card p{font-size:.875rem;color:#666;line-height:1.7;margin:0}
.roles-section{padding:72px 0}
.roles-section h2{text-align:center;font-size:1.8rem;font-weight:800;margin:0 0 12px}
.roles-section p.sub{text-align:center;color:#666;margin:0 0 48px}
.role-cards{display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:20px}
.role-card{border-radius:16px;padding:28px;text-align:center;color:#fff}
.role-hse{background:linear-gradient(135deg,#166534,#059669)}
.role-hr{background:linear-gradient(135deg,#7c3aed,#6d28d9)}
.role-ceo{background:linear-gradient(135deg,#92400e,#b45309)}
.role-card h3{font-size:1.1rem;font-weight:800;margin:16px 0 10px}
.role-card ul{list-style:none;padding:0;margin:0;font-size:.85rem;opacity:.85;text-align:left;line-height:2}
.cta{background:linear-gradient(135deg,#2d5282,#1e3a5f);padding:72px 0;text-align:center;color:#fff}
.cta h2{font-size:2rem;font-weight:800;margin:0 0 12px}
.cta p{opacity:.85;margin:0 0 28px}
</style>
<?php include __DIR__ . '/../includes/navbar.php'; ?>

<section class="wp-hero">
  <div class="container">
    <h1>🏢 Workplace K3 Dashboard</h1>
    <p>Kelola keselamatan kerja perusahaan Anda secara digital. Tracking sertifikat, K3 Score, laporan HSE — semua dalam satu platform.</p>
    <div class="hero-btns">
      <a href="/workplace/daftar/" class="btn-primary">✅ Daftar Gratis Sekarang</a>
      <a href="/workplace/login/" class="btn-secondary">🔐 Login</a>
    </div>
    <p style="margin-top:20px;font-size:.85rem;opacity:.6">Gratis untuk semua perusahaan. Tidak perlu kartu kredit.</p>
  </div>
</section>

<section class="features">
  <div class="container">
    <h2>Fitur Lengkap untuk K3 Perusahaan</h2>
    <p class="sub">Semua yang Anda butuhkan untuk compliance K3 yang lebih baik</p>
    <div class="feat-grid">
      <div class="feat-card"><div class="icon">📊</div><h3>K3 Score Real-time</h3><p>Skor K3 perusahaan dihitung otomatis dari validitas sertifikat, frekuensi pelatihan, dan kelengkapan profil karyawan.</p></div>
      <div class="feat-card"><div class="icon">🔔</div><h3>Reminder Otomatis</h3><p>Notifikasi otomatis 90, 30, dan 7 hari sebelum sertifikat karyawan kadaluarsa via WhatsApp dan email.</p></div>
      <div class="feat-card"><div class="icon">👥</div><h3>Manajemen Karyawan</h3><p>Data lengkap karyawan dengan riwayat sertifikat, pelatihan, dan status kepatuhan K3 masing-masing.</p></div>
      <div class="feat-card"><div class="icon">📈</div><h3>Laporan Eksekutif</h3><p>Dashboard CEO dengan ringkasan compliance K3 seluruh perusahaan dalam format yang mudah dipahami.</p></div>
      <div class="feat-card"><div class="icon">🔐</div><h3>Multi-Role Access</h3><p>Akses berbeda untuk HSE Manager, HR Manager, dan CEO. Setiap role hanya melihat informasi yang relevan.</p></div>
      <div class="feat-card"><div class="icon">📱</div><h3>Mobile-Friendly</h3><p>Akses dashboard dari smartphone, tablet, atau laptop. Tidak perlu install aplikasi apapun.</p></div>
    </div>
  </div>
</section>

<section class="roles-section">
  <div class="container">
    <h2>Dashboard untuk Setiap Role</h2>
    <p class="sub">Setiap pengguna mendapatkan tampilan yang relevan dengan tugasnya</p>
    <div class="role-cards">
      <div class="role-card role-hse">
        <div style="font-size:3rem">🦺</div>
        <h3>HSE Manager</h3>
        <ul>
          <li>✓ K3 Score per departemen</li>
          <li>✓ Status sertifikat semua karyawan</li>
          <li>✓ Alert kadaluarsa sertifikat</li>
          <li>✓ Rencana pelatihan rekomendasi</li>
          <li>✓ Laporan insiden & corrective action</li>
        </ul>
      </div>
      <div class="role-card role-hr">
        <div style="font-size:3rem">👩‍💼</div>
        <h3>HR Manager</h3>
        <ul>
          <li>✓ Data sertifikat karyawan</li>
          <li>✓ Jadwal pelatihan karyawan</li>
          <li>✓ Laporan compliance per divisi</li>
          <li>✓ Histori training perusahaan</li>
          <li>✓ Rekap biaya pelatihan</li>
        </ul>
      </div>
      <div class="role-card role-ceo">
        <div style="font-size:3rem">👔</div>
        <h3>CEO / Direktur</h3>
        <ul>
          <li>✓ K3 Score perusahaan keseluruhan</li>
          <li>✓ Status compliance % karyawan</li>
          <li>✓ Trend K3 bulan ke bulan</li>
          <li>✓ ROI investasi K3</li>
          <li>✓ Ringkasan eksekutif 1 halaman</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<section class="cta">
  <div class="container">
    <h2>Mulai Kelola K3 Perusahaan Anda</h2>
    <p>Gratis selamanya. Setup dalam 5 menit. Tidak perlu IT.</p>
    <a href="/workplace/daftar/" style="display:inline-block;background:var(--orange);color:#fff;padding:16px 40px;border-radius:12px;font-weight:700;font-size:1.1rem;text-decoration:none">✅ Daftar Gratis Sekarang →</a>
    <div style="margin-top:16px">
      <a href="<?= wa_url('Halo, saya ingin info Workplace K3 Dashboard untuk perusahaan kami') ?>" style="color:rgba(255,255,255,.7);font-size:.875rem;text-decoration:none">💬 Tanya via WhatsApp terlebih dahulu</a>
    </div>
  </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
<script src="<?= SITE_URL ?>/assets/js/main.js"></script>
</body></html>