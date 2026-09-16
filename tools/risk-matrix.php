<?php
require_once __DIR__ . '/../config.php';
$s = get_all_settings();
?>
<?php
$page_title = 'Risk Matrix 5x5 Interaktif Online Gratis — Kalkulator Risiko K3';
$meta_desc = 'Risk matrix 5x5 interaktif online gratis. Klik likelihood dan severity — langsung dapat risk level, warna indikator dan rekomendasi pengendalian. Untuk IBPR, HIRARC, SMK3.';
require __DIR__ . '/../includes/head.php';
?>
<link rel="manifest" href="/manifest.json">
<style>
:root{--primary:#1a6b3a;--primary-d:#145530;--accent:#f5a623;--bg:#f8fafc;--card:#fff;--text:#1a202c;--muted:#6b7280;--radius:12px;--shadow:0 2px 16px rgba(0,0,0,.09);
  --low:#22c55e;--medium:#f59e0b;--high:#f97316;--extreme:#ef4444}
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Segoe UI',system-ui,sans-serif;background:var(--bg);color:var(--text);line-height:1.6}
a{color:var(--primary);text-decoration:none}
.container{max-width:1000px;margin:0 auto;padding:0 20px}
nav{background:#fff;border-bottom:1px solid #e5e7eb;padding:14px 0;position:sticky;top:0;z-index:100;box-shadow:0 1px 6px rgba(0,0,0,.06)}
.nav-inner{display:flex;align-items:center;justify-content:space-between}
.nav-logo{display:flex;align-items:center;gap:10px;font-weight:700;color:var(--primary);font-size:1rem}
.nav-logo svg{width:32px;height:32px}
.nav-cta{background:var(--primary);color:#fff;padding:8px 18px;border-radius:8px;font-size:.85rem;font-weight:600}
.hero{background:linear-gradient(135deg,#0f4c2a,#1a6b3a);color:#fff;padding:48px 0 36px;text-align:center}
.hero-badge{background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.25);border-radius:50px;padding:5px 16px;font-size:.8rem;font-weight:600;display:inline-block;margin-bottom:16px}
.hero h1{font-size:clamp(1.5rem,3vw,2.2rem);font-weight:800;margin-bottom:12px}
.hero h1 span{color:var(--accent)}
.hero p{opacity:.88;max-width:560px;margin:0 auto}
.main{padding:40px 0 80px}
.layout{display:grid;grid-template-columns:1fr 1fr;gap:32px;align-items:start}
.panel{background:var(--card);border-radius:var(--radius);padding:28px;box-shadow:var(--shadow);border:1px solid #e5e7eb}
.panel h2{font-size:1.05rem;font-weight:700;margin-bottom:18px}
/* MATRIX */
.matrix-wrap{overflow-x:auto}
.matrix-table{border-collapse:separate;border-spacing:3px;margin:0 auto}
.matrix-table td,.matrix-table th{padding:10px 8px;text-align:center;border-radius:6px;font-size:.8rem;cursor:pointer;transition:all .2s;min-width:70px}
.matrix-table .corner{background:transparent;cursor:default}
.matrix-table .row-label{background:#f3f4f6;font-weight:700;font-size:.75rem;cursor:default;color:var(--muted);min-width:80px;text-align:right;padding-right:12px}
.matrix-table .col-label{background:#f3f4f6;font-weight:700;font-size:.75rem;cursor:default;color:var(--muted)}
.cell-low{background:#bbf7d0;color:#14532d}
.cell-medium{background:#fde68a;color:#78350f}
.cell-high{background:#fed7aa;color:#9a3412}
.cell-extreme{background:#fecaca;color:#7f1d1d}
.cell-low:hover,.cell-medium:hover,.cell-high:hover,.cell-extreme:hover{filter:brightness(.88);transform:scale(1.06)}
.cell-selected{outline:3px solid #1a6b3a;outline-offset:1px;transform:scale(1.1);z-index:10;position:relative}
.score-num{font-weight:800;font-size:1rem}
.score-label{font-size:.68rem;margin-top:1px}
/* RESULT CARD */
.risk-result{display:none;margin-top:20px}
.risk-result.show{display:block}
.risk-level-card{border-radius:12px;padding:24px;text-align:center;color:#fff}
.risk-level-card.low{background:linear-gradient(135deg,#16a34a,#22c55e)}
.risk-level-card.medium{background:linear-gradient(135deg,#d97706,#f59e0b)}
.risk-level-card.high{background:linear-gradient(135deg,#ea580c,#f97316)}
.risk-level-card.extreme{background:linear-gradient(135deg,#dc2626,#ef4444)}
.risk-score-big{font-size:4rem;font-weight:900;line-height:1}
.risk-level-name{font-size:1.4rem;font-weight:800;margin:8px 0 4px}
.risk-level-id{font-size:.9rem;opacity:.9}
.action-list{background:rgba(0,0,0,.15);border-radius:8px;padding:16px;margin-top:16px;text-align:left}
.action-list h4{font-size:.88rem;font-weight:700;margin-bottom:10px}
.action-list ul{list-style:none;font-size:.83rem;display:flex;flex-direction:column;gap:6px}
.action-list li::before{content:"→ "}
/* INPUT FORM */
.form-group{margin-bottom:16px}
.form-group label{display:block;font-size:.88rem;font-weight:600;margin-bottom:6px}
.form-group input,.form-group select,.form-group textarea{width:100%;padding:10px 14px;border:2px solid #e5e7eb;border-radius:8px;font-size:.88rem;background:#fff;color:var(--text)}
.form-group input:focus,.form-group select:focus,.form-group textarea:focus{border-color:var(--primary);outline:none}
.form-group textarea{min-height:60px;resize:vertical;font-family:inherit}
.btn-add{background:var(--primary);color:#fff;border:none;border-radius:8px;padding:10px 20px;font-size:.88rem;font-weight:600;cursor:pointer;margin-top:4px;width:100%}
.btn-wa{background:#25D366;color:#fff;border:none;border-radius:8px;padding:10px 20px;font-size:.88rem;font-weight:600;cursor:pointer;width:100%;margin-top:8px;text-align:center;display:block}
/* REGISTER TABLE */
.register-wrap{margin-top:40px}
.register-wrap h3{font-size:1.1rem;font-weight:700;margin-bottom:16px}
.register-table{width:100%;border-collapse:collapse;font-size:.82rem}
.register-table th{background:var(--primary);color:#fff;padding:10px 12px;text-align:left;font-size:.78rem}
.register-table td{padding:9px 12px;border-bottom:1px solid #f3f4f6;vertical-align:top}
.register-table tr:hover td{background:#f9fafb}
.badge-low{background:#dcfce7;color:#16a34a;padding:2px 10px;border-radius:50px;font-weight:700;font-size:.75rem;white-space:nowrap}
.badge-medium{background:#fef3c7;color:#d97706;padding:2px 10px;border-radius:50px;font-weight:700;font-size:.75rem;white-space:nowrap}
.badge-high{background:#ffedd5;color:#c2410c;padding:2px 10px;border-radius:50px;font-weight:700;font-size:.75rem;white-space:nowrap}
.badge-extreme{background:#fee2e2;color:#dc2626;padding:2px 10px;border-radius:50px;font-weight:700;font-size:.75rem;white-space:nowrap}
.empty-state{text-align:center;padding:40px;color:var(--muted);font-size:.88rem}
.btn-actions{display:flex;gap:10px;margin-top:16px;flex-wrap:wrap}
.btn-secondary{background:#f3f4f6;color:var(--text);border:1px solid #e5e7eb;border-radius:8px;padding:9px 18px;font-size:.85rem;font-weight:600;cursor:pointer}
.btn-secondary:hover{background:#e5e7eb}
.btn-danger{background:#fee2e2;color:#dc2626;border:1px solid #fecaca;border-radius:8px;padding:9px 18px;font-size:.85rem;font-weight:600;cursor:pointer}
/* LEGEND */
.legend{display:flex;gap:12px;flex-wrap:wrap;margin-top:16px}
.legend-item{display:flex;align-items:center;gap:6px;font-size:.8rem}
.legend-dot{width:14px;height:14px;border-radius:3px}
.info-box{background:#f0fdf4;border-left:4px solid var(--primary);border-radius:8px;padding:16px 20px;margin-top:24px}
.info-box h4{font-size:.9rem;font-weight:700;color:var(--primary);margin-bottom:8px}
.info-box p,.info-box li{font-size:.83rem;color:#374151;line-height:1.6}
.info-box ul{padding-left:16px}
.cta-strip{background:var(--primary);color:#fff;border-radius:12px;padding:28px;text-align:center;margin:40px 0}
.cta-strip h3{font-size:1.1rem;font-weight:700;margin-bottom:8px}
.cta-strip p{opacity:.88;font-size:.88rem;margin-bottom:16px}
footer{background:#111827;color:#9ca3af;padding:30px 0;text-align:center;font-size:.83rem}
footer a{color:#6ee7b7}
.toast{position:fixed;bottom:80px;left:50%;transform:translateX(-50%) translateY(20px);background:#1a6b3a;color:#fff;padding:10px 24px;border-radius:50px;font-size:.88rem;font-weight:600;opacity:0;transition:all .3s;pointer-events:none;z-index:999}
.toast.show{opacity:1;transform:translateX(-50%) translateY(0)}
@media(max-width:768px){
  .layout{grid-template-columns:1fr}
  .matrix-table td,.matrix-table th{min-width:52px;padding:8px 4px;font-size:.7rem}
  .score-num{font-size:.85rem}
}
@media print{
  nav,footer,.cta-strip,.btn-actions,.btn-add,.btn-wa,.tools-training-cta{display:none!important}
  body{background:#fff}
}
.tools-training-cta{padding:40px 0}
.tools-training-cta h2{font-size:1.3rem;font-weight:800;margin:0 0 16px;text-align:center;color:#0A4A2E}
.tools-training-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(230px,1fr));gap:16px}
.tools-training-card{background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:18px;display:flex;flex-direction:column}
.tools-training-card h3{font-size:.95rem;font-weight:700;margin:0 0 8px}
.tools-training-card h3 a{color:#0A4A2E;text-decoration:none}
.tools-training-card p{font-size:.85rem;color:#555;line-height:1.6;margin:0 0 12px;flex:1}
.tools-training-btn{display:inline-block;background:#0A4A2E;color:#fff;font-weight:700;font-size:.85rem;padding:8px 14px;border-radius:8px;text-decoration:none;text-align:center}
</style>
<script type="application/ld+json">
{
  "@context":"https://schema.org",
  "@type":"SoftwareApplication",
  "name":"Risk Matrix 5x5 Interaktif Online",
  "applicationCategory":"BusinessApplication",
  "operatingSystem":"Web",
  "offers":{"@type":"Offer","price":"0","priceCurrency":"IDR"},
  "description":"Risk matrix 5x5 online gratis untuk HSE officer — klik likelihood dan severity, dapat risk level, warna, dan rekomendasi pengendalian.",
  "url":"https://wahanatotalita.com/tools/risk-matrix",
  "provider":{"@type":"Organization","name":"Wahana Totalita Konsultan"}
}
</script>
<nav>
  <div class="container nav-inner">
    <a href="/" class="nav-logo">
      <svg viewBox="0 0 40 40" fill="none"><circle cx="20" cy="20" r="20" fill="#1a6b3a"/><path d="M20 8l3 9h9l-7 5 3 9-8-6-8 6 3-9-7-5h9z" fill="#f5a623"/></svg>
      Wahana Totalita
    </a>
    <a href="/tools/" style="color:var(--muted);font-size:.88rem">← Semua Tools</a>
    <a href="https://wa.me/6287759151278" target="_blank" class="nav-cta">📱 Konsultasi</a>
  </div>
</nav>

<section class="hero">
  <div class="container">
    <div class="hero-badge">📊 Risk Assessment Tool</div>
    <h1>Risk Matrix <span>5×5 Interaktif</span><br>Gratis Online</h1>
    <p>Klik likelihood dan severity — langsung dapat risk level, warna indikator, dan rekomendasi pengendalian risiko.</p>
  </div>
</section>

<section class="main">
  <div class="container">
    <div class="layout">

      <!-- LEFT: MATRIX -->
      <div>
        <div class="panel">
          <h2>📊 Klik Sel untuk Menghitung Risiko</h2>
          <div class="matrix-wrap">
            <table class="matrix-table" id="riskMatrix">
              <tr id="matrixHeader"></tr>
              <!-- rows filled by JS -->
            </table>
          </div>

          <div class="legend">
            <div class="legend-item"><div class="legend-dot" style="background:#bbf7d0"></div>Low (1-4)</div>
            <div class="legend-item"><div class="legend-dot" style="background:#fde68a"></div>Medium (5-9)</div>
            <div class="legend-item"><div class="legend-dot" style="background:#fed7aa"></div>High (10-16)</div>
            <div class="legend-item"><div class="legend-dot" style="background:#fecaca"></div>Extreme (17-25)</div>
          </div>

          <div class="risk-result" id="riskResult"></div>
        </div>

        <div class="info-box">
          <h4>📐 Cara Membaca Risk Matrix</h4>
          <ul>
            <li><strong>Likelihood</strong> (Kemungkinan): 1=Rare sampai 5=Almost Certain</li>
            <li><strong>Severity</strong> (Keparahan): 1=Insignificant sampai 5=Catastrophic</li>
            <li><strong>Risk Score</strong> = Likelihood × Severity</li>
            <li>Low (hijau): cukup prosedur standar</li>
            <li>Medium (kuning): tindakan perbaikan dalam 30 hari</li>
            <li>High (oranye): tindakan segera, max 7 hari</li>
            <li>Extreme (merah): hentikan pekerjaan, tindakan segera</li>
          </ul>
        </div>
      </div>

      <!-- RIGHT: INPUT + REGISTER -->
      <div>
        <div class="panel">
          <h2>📋 Tambah ke Risk Register</h2>
          <div class="form-group">
            <label>Aktivitas / Pekerjaan</label>
            <input type="text" id="rActivity" placeholder="cth: Pekerjaan Pengelasan di Ketinggian">
          </div>
          <div class="form-group">
            <label>Identifikasi Bahaya</label>
            <input type="text" id="rHazard" placeholder="cth: Percikan api, terjatuh dari ketinggian">
          </div>
          <div class="form-group">
            <label>Konsekuensi / Risiko</label>
            <input type="text" id="rConsequence" placeholder="cth: Kebakaran, cedera berat, kematian">
          </div>
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
            <div class="form-group">
              <label>Likelihood (1-5)</label>
              <select id="rLikelihood" onchange="updateRegisterPreview()">
                <option value="1">1 — Rare</option>
                <option value="2">2 — Unlikely</option>
                <option value="3" selected>3 — Possible</option>
                <option value="4">4 — Likely</option>
                <option value="5">5 — Almost Certain</option>
              </select>
            </div>
            <div class="form-group">
              <label>Severity (1-5)</label>
              <select id="rSeverity" onchange="updateRegisterPreview()">
                <option value="1">1 — Insignificant</option>
                <option value="2">2 — Minor</option>
                <option value="3" selected>3 — Moderate</option>
                <option value="4">4 — Major</option>
                <option value="5">5 — Catastrophic</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label>Pengendalian yang Ada</label>
            <textarea id="rExisting" placeholder="cth: APD standar, briefing K3 sebelum kerja"></textarea>
          </div>
          <div class="form-group">
            <label>Pengendalian Tambahan</label>
            <textarea id="rAdditional" placeholder="cth: Perancah bersertifikat, safety harness, izin kerja PTW"></textarea>
          </div>
          <div class="form-group">
            <label>PIC / Penanggung Jawab</label>
            <input type="text" id="rPIC" placeholder="cth: Supervisor Area, HSE Officer">
          </div>
          <button class="btn-add" onclick="addToRegister()">+ Tambah ke Risk Register</button>
          <a href="https://wa.me/6287759151278?text=Halo%20Wahana%2C%20saya%20butuh%20bantuan%20IBPR%20dan%20risk%20assessment" target="_blank" class="btn-wa">📱 Konsultasi Risk Assessment K3</a>
        </div>
      </div>
    </div>

    <!-- REGISTER TABLE -->
    <div class="register-wrap">
      <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;flex-wrap:wrap;gap:12px">
        <h3>📋 Risk Register (<span id="regCount">0</span> item)</h3>
        <div class="btn-actions" style="margin:0">
          <button class="btn-secondary" onclick="printRegister()">🖨 Print</button>
          <button class="btn-secondary" onclick="copyRegister()">📋 Copy CSV</button>
          <button class="btn-danger" onclick="clearRegister()">🗑 Clear All</button>
        </div>
      </div>
      <div style="overflow-x:auto">
        <table class="register-table">
          <thead>
            <tr>
              <th>#</th>
              <th>Aktivitas</th>
              <th>Bahaya</th>
              <th>Konsekuensi</th>
              <th>L</th>
              <th>S</th>
              <th>Score</th>
              <th>Level</th>
              <th>Kontrol Tambahan</th>
              <th>PIC</th>
            </tr>
          </thead>
          <tbody id="registerBody">
            <tr><td colspan="10" class="empty-state">Belum ada data. Isi form di atas dan klik "+ Tambah ke Risk Register"</td></tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="cta-strip">
      <h3>🎓 Kuasai Risk Assessment Secara Profesional</h3>
      <p>Pelatihan Ahli K3 Umum mencakup metodologi IBPR, risk matrix, hierarki pengendalian, dan implementasi SMK3 PP 50/2012.</p>
      <a href="https://wa.me/6287759151278?text=Halo%20Wahana%2C%20saya%20gunakan%20risk%20matrix%20tool%20dan%20ingin%20tanya%20pelatihan%20K3" target="_blank" rel="noopener" class="btn-wa" style="display:inline-flex;align-items:center;gap:8px;padding:12px 28px;border-radius:8px;font-weight:700">
        <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
        Tanya Pelatihan Risk Assessment K3
      </a>
    </div>
  </div>
</section>

<section class="tools-training-cta">
  <div class="container">
    <h2>Tingkatkan Kompetensi K3 Anda</h2>
    <div class="tools-training-grid">
      <div class="tools-training-card">
        <h3><a href="/pelatihan/pelatihan-ahli-k3-umum-sertifikasi-bnsp-online/">Pelatihan Ahli K3 Umum</a></h3>
        <p>Sertifikasi wajib bagi praktisi K3 perusahaan, resmi BNSP, materi regulasi &amp; manajemen risiko.</p>
        <a href="/pelatihan/pelatihan-ahli-k3-umum-sertifikasi-bnsp-online/" class="tools-training-btn">Lihat Program &rarr;</a>
      </div>
      <div class="tools-training-card">
        <h3><a href="/pelatihan/pelatihan-petugas-p3k-sertifikasi-bnsp/">Pelatihan Petugas P3K | Sertifikasi BNSP</a></h3>
        <p>Pelatihan penanganan darurat dan P3K di tempat kerja, sertifikasi BNSP, wajib untuk perusahaan.</p>
        <a href="/pelatihan/pelatihan-petugas-p3k-sertifikasi-bnsp/" class="tools-training-btn">Lihat Program &rarr;</a>
      </div>
      <div class="tools-training-card">
        <h3><a href="/pelatihan/pelatihan-operator-k3-sertifikasi-bnsp/">Pelatihan Operator K3 | Sertifikasi BNSP</a></h3>
        <p>Kompetensi dasar keselamatan kerja untuk operator, sertifikasi resmi BNSP, untuk semua industri.</p>
        <a href="/pelatihan/pelatihan-operator-k3-sertifikasi-bnsp/" class="tools-training-btn">Lihat Program &rarr;</a>
      </div>
      <div class="tools-training-card">
        <h3><a href="/jadwal/">Jadwal Pelatihan Terdekat</a></h3>
        <p>Lihat jadwal batch pelatihan K3 terbaru — online dan offline di berbagai kota.</p>
        <a href="/jadwal/" class="tools-training-btn">Lihat Jadwal &rarr;</a>
      </div>
    </div>
  </div>
</section>

<footer>
  <div class="container">
    <p><a href="/tools/">← Semua Tools K3</a> | <a href="/tools/ibpr-generator">IBPR Generator</a> | <a href="/tools/jsa-builder">JSA Builder</a> | <a href="/">Wahana Totalita</a></p>
    <p style="margin-top:8px">© <?php echo date('Y'); ?> Wahana Totalita Konsultan, Yogyakarta</p>
  </div>
</footer>

<a href="https://wa.me/6287759151278" target="_blank" style="position:fixed;bottom:24px;right:24px;background:#25D366;width:52px;height:52px;border-radius:50%;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 14px rgba(37,211,102,.4);z-index:999">
  <svg viewBox="0 0 24 24" fill="white" width="26" height="26"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
</a>

<div class="toast" id="toast"></div>

<script>
const likelihoods = [
  {id:5, label:'5 — Almost Certain', id_label:'Hampir Pasti'},
  {id:4, label:'4 — Likely', id_label:'Kemungkinan Besar'},
  {id:3, label:'3 — Possible', id_label:'Mungkin Terjadi'},
  {id:2, label:'2 — Unlikely', id_label:'Kecil Kemungkinan'},
  {id:1, label:'1 — Rare', id_label:'Sangat Jarang'},
];
const severities = [
  {id:1, label:'1 — Insignificant', id_label:'Tidak Signifikan'},
  {id:2, label:'2 — Minor', id_label:'Ringan'},
  {id:3, label:'3 — Moderate', id_label:'Sedang'},
  {id:4, label:'4 — Major', id_label:'Besar'},
  {id:5, label:'5 — Catastrophic', id_label:'Katastropik'},
];

const controls = {
  low: {
    title:'LOW RISK — Risiko Rendah',
    id_title:'Risiko Rendah',
    color:'low',
    actions:[
      'Kelola dengan prosedur standar yang sudah ada',
      'Pastikan semua pekerja paham prosedur kerja',
      'Review berkala minimal 1 tahun sekali',
      'Catat dalam risk register untuk monitoring',
    ]
  },
  medium: {
    title:'MEDIUM RISK — Risiko Sedang',
    id_title:'Risiko Sedang',
    color:'medium',
    actions:[
      'Buat rencana aksi pengendalian dalam 30 hari',
      'Pastikan APD sesuai dipakai semua waktu',
      'Sertakan dalam agenda rapat K3 bulanan',
      'Pertimbangkan engineering control tambahan',
      'Lakukan inspeksi area minimal 2x per minggu',
    ]
  },
  high: {
    title:'HIGH RISK — Risiko Tinggi',
    id_title:'Risiko Tinggi',
    color:'high',
    actions:[
      'Ambil tindakan segera, maksimal 7 hari kerja',
      'Supervisor wajib hadir dan mengawasi langsung',
      'Buat Izin Kerja (PTW) sebelum memulai',
      'Tambah engineering control / eliminasi bahaya',
      'Lakukan JSA ulang sebelum setiap shift',
      'Lapor ke manajemen dan HSE Manager',
    ]
  },
  extreme: {
    title:'EXTREME RISK — Risiko Ekstrem',
    id_title:'Risiko Ekstrem',
    color:'extreme',
    actions:[
      '⛔ HENTIKAN PEKERJAAN SEGERA',
      'Jangan lanjutkan sampai risiko dikurangi',
      'Lapor langsung ke Direktur / Top Management',
      'Butuh sign-off dari HSE Manager dan Site Manager',
      'Evaluasi eliminasi total bahaya jika memungkinkan',
      'Siapkan rencana darurat sebelum memulai kembali',
    ]
  }
};

let selectedL = null, selectedS = null;
let riskRegister = [];

function getRiskLevel(score){
  if(score <= 4) return 'low';
  if(score <= 9) return 'medium';
  if(score <= 16) return 'high';
  return 'extreme';
}
function getRiskClass(score){
  if(score <= 4) return 'cell-low';
  if(score <= 9) return 'cell-medium';
  if(score <= 16) return 'cell-high';
  return 'cell-extreme';
}

function buildMatrix(){
  const table = document.getElementById('riskMatrix');
  // Header row
  const header = document.getElementById('matrixHeader');
  header.innerHTML = '<th class="corner">L \\ S</th>';
  severities.forEach(s=>{
    const th = document.createElement('th');
    th.className = 'col-label';
    th.innerHTML = `S${s.id}<br><span style="font-weight:400">${s.id_label}</span>`;
    header.appendChild(th);
  });

  likelihoods.forEach(l=>{
    const tr = document.createElement('tr');
    const rowTh = document.createElement('th');
    rowTh.className = 'row-label';
    rowTh.innerHTML = `L${l.id} ${l.id_label}`;
    tr.appendChild(rowTh);

    severities.forEach(s=>{
      const score = l.id * s.id;
      const td = document.createElement('td');
      td.className = getRiskClass(score);
      td.id = `cell-${l.id}-${s.id}`;
      td.innerHTML = `<div class="score-num">${score}</div><div class="score-label">${getRiskLevel(score).toUpperCase()}</div>`;
      td.onclick = ()=>selectCell(l.id, s.id, score);
      tr.appendChild(td);
    });
    table.appendChild(tr);
  });
}

function selectCell(l, s, score){
  // Remove previous selection
  document.querySelectorAll('.cell-selected').forEach(el=>el.classList.remove('cell-selected'));
  document.getElementById(`cell-${l}-${s}`).classList.add('cell-selected');
  selectedL = l; selectedS = s;

  // Update dropdowns
  document.getElementById('rLikelihood').value = l;
  document.getElementById('rSeverity').value = s;

  const level = getRiskLevel(score);
  const ctrl = controls[level];
  const lLabel = likelihoods.find(x=>x.id===l);
  const sLabel = severities.find(x=>x.id===s);

  const result = document.getElementById('riskResult');
  result.className = 'risk-result show';
  result.innerHTML = `
    <div class="risk-level-card ${level}">
      <div class="risk-score-big">${score}</div>
      <div class="risk-level-name">${ctrl.title}</div>
      <div class="risk-level-id">Likelihood: L${l} (${lLabel.id_label}) × Severity: S${s} (${sLabel.id_label})</div>
      <div class="action-list">
        <h4>Tindakan yang Diperlukan:</h4>
        <ul>
          ${ctrl.actions.map(a=>`<li>${a}</li>`).join('')}
        </ul>
      </div>
    </div>
  `;
}

function updateRegisterPreview(){
  const l = parseInt(document.getElementById('rLikelihood').value);
  const s = parseInt(document.getElementById('rSeverity').value);
  if(l && s) selectCell(l,s,l*s);
}

function addToRegister(){
  const activity = document.getElementById('rActivity').value.trim();
  const hazard   = document.getElementById('rHazard').value.trim();
  const consequence = document.getElementById('rConsequence').value.trim();
  const l = parseInt(document.getElementById('rLikelihood').value);
  const s = parseInt(document.getElementById('rSeverity').value);
  const existing    = document.getElementById('rExisting').value.trim();
  const additional  = document.getElementById('rAdditional').value.trim();
  const pic         = document.getElementById('rPIC').value.trim();

  if(!activity || !hazard){
    showToast('⚠️ Isi minimal Aktivitas dan Bahaya');
    return;
  }

  const score = l * s;
  const level = getRiskLevel(score);
  riskRegister.push({activity, hazard, consequence, l, s, score, level, existing, additional, pic});
  renderRegister();
  showToast('✅ Ditambahkan ke Risk Register!');

  // Clear fields
  ['rActivity','rHazard','rConsequence','rExisting','rAdditional','rPIC'].forEach(id=>document.getElementById(id).value='');
}

function renderRegister(){
  const tbody = document.getElementById('registerBody');
  document.getElementById('regCount').textContent = riskRegister.length;
  if(!riskRegister.length){
    tbody.innerHTML = '<tr><td colspan="10" class="empty-state">Belum ada data.</td></tr>';
    return;
  }
  tbody.innerHTML = riskRegister.map((r,i)=>`
    <tr>
      <td>${i+1}</td>
      <td>${r.activity}</td>
      <td>${r.hazard}</td>
      <td>${r.consequence||'—'}</td>
      <td style="text-align:center">${r.l}</td>
      <td style="text-align:center">${r.s}</td>
      <td style="text-align:center;font-weight:800">${r.score}</td>
      <td><span class="badge-${r.level}">${r.level.toUpperCase()}</span></td>
      <td>${r.additional||'—'}</td>
      <td>${r.pic||'—'}</td>
    </tr>
  `).join('');
}

function clearRegister(){
  if(!riskRegister.length) return;
  if(confirm('Hapus semua data risk register?')){ riskRegister=[]; renderRegister(); }
}

function printRegister(){ window.print(); }

function copyRegister(){
  if(!riskRegister.length){ showToast('Belum ada data'); return; }
  const header = 'No,Aktivitas,Bahaya,Konsekuensi,L,S,Score,Level,Kontrol Tambahan,PIC';
  const rows = riskRegister.map((r,i)=>
    `${i+1},"${r.activity}","${r.hazard}","${r.consequence||''}",${r.l},${r.s},${r.score},${r.level},"${r.additional||''}","${r.pic||''}"`
  );
  navigator.clipboard.writeText([header,...rows].join('\n'))
    .then(()=>showToast('✅ Risk Register disalin sebagai CSV!'));
}

function showToast(msg){
  const t = document.getElementById('toast');
  t.textContent = msg;
  t.classList.add('show');
  setTimeout(()=>t.classList.remove('show'), 2800);
}

buildMatrix();
// Pre-select a cell to show example
selectCell(3,3,9);
</script>
</body>
</html>
