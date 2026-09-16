<?php
require_once __DIR__ . '/../config.php';
$s = get_all_settings();
?>
<?php
$page_title = 'Kalkulator LTIR TRIR Statistik K3 Online Gratis';
$meta_desc = 'Kalkulator statistik K3 online gratis: hitung LTIR, TRIR, LTISR, Frequency Rate, Severity Rate otomatis. Standar OSHA & International. Cocok untuk laporan bulanan HSE officer.';
require __DIR__ . '/../includes/head.php';
?>
<link rel="manifest" href="/manifest.json">
<style>
:root{--primary:#1a6b3a;--primary-d:#145530;--accent:#f5a623;--bg:#f8fafc;--card:#fff;--text:#1a202c;--muted:#6b7280;--radius:12px;--shadow:0 2px 16px rgba(0,0,0,.09)}
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Segoe UI',system-ui,sans-serif;background:var(--bg);color:var(--text);line-height:1.6}
a{color:var(--primary);text-decoration:none}
.container{max-width:1000px;margin:0 auto;padding:0 20px}
nav{background:#fff;border-bottom:1px solid #e5e7eb;padding:14px 0;position:sticky;top:0;z-index:100;box-shadow:0 1px 6px rgba(0,0,0,.06)}
.nav-inner{display:flex;align-items:center;justify-content:space-between}
.nav-logo{display:flex;align-items:center;gap:10px;font-weight:700;color:var(--primary);font-size:1rem}
.nav-logo svg{width:32px;height:32px}
.nav-back{color:var(--muted);font-size:.88rem;display:flex;align-items:center;gap:6px}
.nav-cta{background:var(--primary);color:#fff;padding:8px 18px;border-radius:8px;font-size:.85rem;font-weight:600}
.hero{background:linear-gradient(135deg,#0f4c2a,#1a6b3a);color:#fff;padding:48px 0 36px;text-align:center}
.hero-badge{background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.25);border-radius:50px;padding:5px 16px;font-size:.8rem;font-weight:600;display:inline-block;margin-bottom:16px}
.hero h1{font-size:clamp(1.6rem,3.5vw,2.4rem);font-weight:800;margin-bottom:12px}
.hero h1 span{color:var(--accent)}
.hero p{opacity:.88;max-width:580px;margin:0 auto}
.main{padding:40px 0 80px}
.calc-layout{display:grid;grid-template-columns:1fr 1fr;gap:32px;align-items:start}
/* INPUT PANEL */
.panel{background:var(--card);border-radius:var(--radius);padding:28px;box-shadow:var(--shadow);border:1px solid #e5e7eb}
.panel h2{font-size:1.1rem;font-weight:700;margin-bottom:20px;display:flex;align-items:center;gap:8px}
.panel h2 svg{width:20px;height:20px;color:var(--primary)}
.form-group{margin-bottom:18px}
.form-group label{display:block;font-size:.88rem;font-weight:600;color:var(--text);margin-bottom:6px}
.form-group label span{font-size:.78rem;color:var(--muted);font-weight:400}
.form-group input,.form-group select{width:100%;padding:10px 14px;border:2px solid #e5e7eb;border-radius:8px;font-size:.92rem;color:var(--text);transition:border .2s;background:#fff}
.form-group input:focus,.form-group select:focus{border-color:var(--primary);outline:none}
.divider{border:none;border-top:1px solid #f3f4f6;margin:20px 0}
.standard-toggle{display:flex;gap:0;background:#f3f4f6;border-radius:8px;padding:3px}
.std-btn{flex:1;padding:8px;border:none;background:transparent;border-radius:6px;font-size:.85rem;font-weight:600;cursor:pointer;color:var(--muted);transition:all .2s}
.std-btn.active{background:var(--primary);color:#fff}
.btn-calc{width:100%;background:var(--primary);color:#fff;border:none;border-radius:10px;padding:14px;font-size:1rem;font-weight:700;cursor:pointer;margin-top:8px;transition:background .2s;display:flex;align-items:center;justify-content:center;gap:8px}
.btn-calc:hover{background:var(--primary-d)}
.btn-reset{width:100%;background:#f3f4f6;color:var(--muted);border:none;border-radius:10px;padding:10px;font-size:.88rem;font-weight:600;cursor:pointer;margin-top:8px}
/* RESULTS PANEL */
.results{display:flex;flex-direction:column;gap:16px}
.result-card{background:var(--card);border-radius:var(--radius);padding:20px;box-shadow:var(--shadow);border:1px solid #e5e7eb}
.result-card.highlight{border-color:var(--primary)}
.result-header{display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:12px}
.result-name{font-size:.88rem;font-weight:600;color:var(--muted)}
.result-value{font-size:2.4rem;font-weight:900;line-height:1}
.result-value.safe{color:#16a34a}
.result-value.warn{color:#d97706}
.result-value.danger{color:#dc2626}
.result-badge{font-size:.75rem;padding:3px 10px;border-radius:50px;font-weight:700}
.badge-safe{background:#dcfce7;color:#16a34a}
.badge-warn{background:#fef3c7;color:#d97706}
.badge-danger{background:#fee2e2;color:#dc2626}
.badge-neutral{background:#f3f4f6;color:#6b7280}
.result-desc{font-size:.8rem;color:var(--muted);margin-top:8px;line-height:1.5}
.result-formula{font-size:.75rem;color:#9ca3af;margin-top:6px;font-family:monospace;background:#f9fafb;padding:4px 8px;border-radius:4px}
.results-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px}
/* PLACEHOLDER */
.placeholder{text-align:center;padding:60px 20px;color:var(--muted)}
.placeholder svg{width:60px;height:60px;opacity:.3;margin-bottom:16px}
.placeholder p{font-size:.9rem}
/* ACTIONS */
.result-actions{display:flex;gap:10px;margin-top:16px}
.btn-copy{background:#f3f4f6;color:var(--text);border:1px solid #e5e7eb;border-radius:8px;padding:9px 18px;font-size:.85rem;font-weight:600;cursor:pointer;display:flex;align-items:center;gap:6px;transition:all .2s}
.btn-copy:hover{background:var(--primary);color:#fff;border-color:var(--primary)}
.btn-print{background:var(--primary);color:#fff;border:none;border-radius:8px;padding:9px 18px;font-size:.85rem;font-weight:600;cursor:pointer;display:flex;align-items:center;gap:6px}
/* INFO BOX */
.info-box{background:#f0fdf4;border-left:4px solid var(--primary);border-radius:8px;padding:16px 20px;margin:24px 0}
.info-box h4{font-size:.9rem;font-weight:700;color:var(--primary);margin-bottom:8px}
.info-box p,.info-box li{font-size:.83rem;color:#374151;line-height:1.6}
.info-box ul{padding-left:16px}
/* REFERENCE TABLE */
.ref-table{width:100%;border-collapse:collapse;font-size:.85rem;margin-top:16px}
.ref-table th{background:var(--primary);color:#fff;padding:10px 14px;text-align:left;font-size:.8rem}
.ref-table td{padding:9px 14px;border-bottom:1px solid #f3f4f6}
.ref-table tr:hover td{background:#f9fafb}
.ref-table .good{color:#16a34a;font-weight:700}
.ref-table .avg{color:#d97706;font-weight:700}
.ref-table .bad{color:#dc2626;font-weight:700}
/* CTA */
.cta-strip{background:var(--primary);color:#fff;border-radius:12px;padding:28px;text-align:center;margin:40px 0}
.cta-strip h3{font-size:1.1rem;font-weight:700;margin-bottom:8px}
.cta-strip p{opacity:.88;font-size:.88rem;margin-bottom:16px}
.btn-wa{background:#25D366;color:#fff;padding:12px 28px;border-radius:8px;font-weight:700;font-size:.9rem;display:inline-flex;align-items:center;gap:8px}
footer{background:#111827;color:#9ca3af;padding:30px 0;text-align:center;font-size:.83rem}
footer a{color:#6ee7b7}
.toast{position:fixed;bottom:80px;left:50%;transform:translateX(-50%) translateY(20px);background:#1a6b3a;color:#fff;padding:10px 24px;border-radius:50px;font-size:.88rem;font-weight:600;opacity:0;transition:all .3s;pointer-events:none;z-index:999}
.toast.show{opacity:1;transform:translateX(-50%) translateY(0)}
@media(max-width:768px){
  .calc-layout{grid-template-columns:1fr}
  .results-grid{grid-template-columns:1fr}
}
@media print{
  nav,footer,.btn-calc,.btn-reset,.result-actions,.cta-strip,.tools-training-cta,.wa-float{display:none!important}
  .calc-layout{grid-template-columns:1fr}
  .panel{box-shadow:none;border:1px solid #ccc}
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
  "name":"Kalkulator LTIR TRIR Statistik K3",
  "applicationCategory":"BusinessApplication",
  "operatingSystem":"Web",
  "offers":{"@type":"Offer","price":"0","priceCurrency":"IDR"},
  "description":"Kalkulator statistik K3 online gratis: LTIR, TRIR, LTISR, Frequency Rate, Severity Rate. Standar OSHA dan International.",
  "url":"https://wahanatotalita.com/tools/kalkulator-k3",
  "provider":{"@type":"Organization","name":"Wahana Totalita Konsultan","url":"https://wahanatotalita.com"}
}
</script>
<nav>
  <div class="container nav-inner">
    <a href="/" class="nav-logo">
      <svg viewBox="0 0 40 40" fill="none"><circle cx="20" cy="20" r="20" fill="#1a6b3a"/><path d="M20 8l3 9h9l-7 5 3 9-8-6-8 6 3-9-7-5h9z" fill="#f5a623"/></svg>
      Wahana Totalita
    </a>
    <a href="/tools/" class="nav-back">← Semua Tools</a>
    <a href="https://wa.me/6287759151278?text=Halo%20Wahana%2C%20ingin%20konsultasi%20K3" target="_blank" rel="noopener" class="nav-cta">📱 Konsultasi</a>
  </div>
</nav>

<section class="hero">
  <div class="container">
    <div class="hero-badge">🧮 Kalkulator K3 Gratis</div>
    <h1>Kalkulator <span>LTIR · TRIR · LTISR</span><br>Statistik K3 Online</h1>
    <p>Masukkan data jam kerja dan kecelakaan — semua KPI keselamatan dihitung otomatis. Gratis, tanpa daftar, tanpa download.</p>
  </div>
</section>

<section class="main">
  <div class="container">
    <div class="calc-layout">

      <!-- INPUT PANEL -->
      <div>
        <div class="panel">
          <h2>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="4" y="2" width="16" height="20" rx="2"/><line x1="8" y1="7" x2="16" y2="7"/><line x1="8" y1="11" x2="16" y2="11"/><line x1="8" y1="15" x2="11" y2="15"/></svg>
            Data Input
          </h2>

          <div class="form-group">
            <label>Standar Perhitungan</label>
            <div class="standard-toggle">
              <button class="std-btn active" id="btnIntl" onclick="setStd('intl')">🌍 International (1.000.000)</button>
              <button class="std-btn" id="btnOsha" onclick="setStd('osha')">🇺🇸 OSHA (200.000)</button>
            </div>
          </div>

          <div class="form-group">
            <label>Periode <span>— pilih untuk konteks interpretasi</span></label>
            <select id="periode">
              <option value="bulan">Bulan ini</option>
              <option value="triwulan">Triwulan</option>
              <option value="semester">Semester</option>
              <option value="tahunan" selected>Tahunan</option>
            </select>
          </div>

          <hr class="divider">

          <div class="form-group">
            <label>Total Jam Kerja (Man-Hours) <span>— jam kerja seluruh karyawan</span></label>
            <input type="number" id="manHours" placeholder="cth: 1200000" min="0" oninput="autoCalc()">
          </div>

          <div class="form-group">
            <label>Jumlah Karyawan <span>— opsional, untuk referensi</span></label>
            <input type="number" id="employees" placeholder="cth: 500" min="0">
          </div>

          <hr class="divider">
          <p style="font-size:.82rem;color:var(--muted);margin-bottom:12px;font-weight:600">Jenis Kecelakaan/Insiden</p>

          <div class="form-group">
            <label>Fatality (Meninggal) <span>— kasus kematian akibat kerja</span></label>
            <input type="number" id="fatality" placeholder="0" min="0" value="0" oninput="autoCalc()">
          </div>

          <div class="form-group">
            <label>LTI — Lost Time Injury <span>— absen ≥1 hari kerja</span></label>
            <input type="number" id="lti" placeholder="0" min="0" value="0" oninput="autoCalc()">
          </div>

          <div class="form-group">
            <label>Total Hari Hilang (Lost Days) <span>— total hari tidak masuk akibat LTI</span></label>
            <input type="number" id="lostDays" placeholder="0" min="0" value="0" oninput="autoCalc()">
          </div>

          <div class="form-group">
            <label>RWC — Restricted Work Case <span>— kerja terbatas/dipindah tugas</span></label>
            <input type="number" id="rwc" placeholder="0" min="0" value="0" oninput="autoCalc()">
          </div>

          <div class="form-group">
            <label>MTC — Medical Treatment Case <span>— diobati lebih dari P3K</span></label>
            <input type="number" id="mtc" placeholder="0" min="0" value="0" oninput="autoCalc()">
          </div>

          <div class="form-group">
            <label>FAC — First Aid Case <span>— hanya P3K, tidak absen</span></label>
            <input type="number" id="fac" placeholder="0" min="0" value="0" oninput="autoCalc()">
          </div>

          <div class="form-group">
            <label>Near Miss / Hampir Celaka <span>— insiden tanpa cedera</span></label>
            <input type="number" id="nearMiss" placeholder="0" min="0" value="0" oninput="autoCalc()">
          </div>

          <button class="btn-calc" onclick="calculate()">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" width="18" height="18"><path d="M9 9l3 3m0 0l3-3m-3 3V4m0 12a9 9 0 1 1 0-18 9 9 0 0 1 0 18z"/></svg>
            Hitung Sekarang
          </button>
          <button class="btn-reset" onclick="resetForm()">↺ Reset</button>
        </div>

        <div class="info-box" style="margin-top:20px">
          <h4>💡 Apa itu Man-Hours?</h4>
          <p>Man-Hours = Jumlah Karyawan × Jam Kerja per Hari × Hari Kerja per Tahun</p>
          <p style="margin-top:6px">Contoh: 500 orang × 8 jam × 300 hari = <strong>1.200.000 man-hours</strong></p>
        </div>
      </div>

      <!-- RESULTS PANEL -->
      <div class="results" id="resultsPanel">
        <div class="placeholder" id="placeholder">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M9 7H6a2 2 0 00-2 2v9a2 2 0 002 2h9a2 2 0 002-2v-3M9 7V5a2 2 0 012-2h2a2 2 0 012 2v2M9 7h6M9 12h6m-3-3v6"/></svg>
          <p>Isi data di kiri dan klik <strong>Hitung Sekarang</strong><br>untuk melihat hasil statistik K3</p>
        </div>
        <!-- Results inject here -->
      </div>
    </div>

    <!-- REFERENCE TABLE -->
    <div class="info-box" style="margin-top:40px">
      <h4>📊 Tabel Referensi — Nilai LTIR per Industri (Indonesia)</h4>
      <table class="ref-table">
        <thead>
          <tr><th>Industri</th><th>LTIR Sangat Baik</th><th>LTIR Rata-rata</th><th>LTIR Perlu Perhatian</th></tr>
        </thead>
        <tbody>
          <tr><td>Konstruksi</td><td class="good">&lt; 1.0</td><td class="avg">1.0 – 3.5</td><td class="bad">&gt; 3.5</td></tr>
          <tr><td>Pertambangan</td><td class="good">&lt; 0.8</td><td class="avg">0.8 – 2.5</td><td class="bad">&gt; 2.5</td></tr>
          <tr><td>Migas / Oil & Gas</td><td class="good">&lt; 0.5</td><td class="avg">0.5 – 1.5</td><td class="bad">&gt; 1.5</td></tr>
          <tr><td>Manufaktur</td><td class="good">&lt; 1.5</td><td class="avg">1.5 – 4.0</td><td class="bad">&gt; 4.0</td></tr>
          <tr><td>Kesehatan / Rumah Sakit</td><td class="good">&lt; 2.0</td><td class="avg">2.0 – 5.0</td><td class="bad">&gt; 5.0</td></tr>
          <tr><td>Logistik / Transportasi</td><td class="good">&lt; 2.0</td><td class="avg">2.0 – 4.5</td><td class="bad">&gt; 4.5</td></tr>
        </tbody>
      </table>
      <p style="margin-top:10px;font-size:.78rem;color:var(--muted)">Catatan: nilai referensi bersifat indikatif. Setiap perusahaan memiliki target LTIR yang berbeda sesuai standar industri dan persyaratan klien.</p>
    </div>

    <div class="info-box">
      <h4>📐 Rumus Perhitungan</h4>
      <ul>
        <li><strong>LTIR</strong> = (LTI + Fatality) × Faktor ÷ Man-Hours</li>
        <li><strong>TRIR</strong> = (Fatality + LTI + RWC + MTC) × Faktor ÷ Man-Hours</li>
        <li><strong>LTISR / Severity Rate</strong> = Total Lost Days × Faktor ÷ Man-Hours</li>
        <li><strong>Frequency Rate (FR)</strong> = (LTI + Fatality) × Faktor ÷ Man-Hours</li>
        <li><strong>Faktor OSHA</strong> = 200.000 | <strong>Faktor International</strong> = 1.000.000</li>
      </ul>
    </div>

    <div class="cta-strip">
      <h3>🎓 Ingin Belajar Lebih Dalam tentang Statistik K3?</h3>
      <p>Ikuti Pelatihan Ahli K3 Umum KEMNAKER RI — materi mencakup analisis statistik K3, investigasi insiden, dan manajemen K3 komprehensif.</p>
      <a href="https://wa.me/6287759151278?text=Halo%20Wahana%2C%20saya%20pakai%20kalkulator%20K3%20dan%20ingin%20tanya%20pelatihan%20Ahli%20K3%20Umum" target="_blank" rel="noopener" class="btn-wa">
        <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
        Tanya Jadwal Pelatihan K3
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
    <p><a href="/tools/">← Kembali ke Semua Tools K3</a> &nbsp;|&nbsp; <a href="/">Wahana Totalita Konsultan</a> &nbsp;|&nbsp; <a href="https://wa.me/6287759151278" target="_blank">WhatsApp</a></p>
    <p style="margin-top:8px">© <?php echo date('Y'); ?> Wahana Totalita Konsultan, Yogyakarta</p>
  </div>
</footer>

<a href="https://wa.me/6287759151278" target="_blank" rel="noopener" class="wa-float"
   style="position:fixed;bottom:24px;right:24px;background:#25D366;width:52px;height:52px;border-radius:50%;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 14px rgba(37,211,102,.4);z-index:999">
  <svg viewBox="0 0 24 24" fill="white" width="26" height="26"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
</a>

<div class="toast" id="toast"></div>

<script>
let standard = 'intl';
let factor = 1000000;

function setStd(s){
  standard = s;
  factor = s === 'osha' ? 200000 : 1000000;
  document.getElementById('btnIntl').classList.toggle('active', s==='intl');
  document.getElementById('btnOsha').classList.toggle('active', s==='osha');
  if(document.getElementById('placeholder').style.display==='none') calculate();
}

function getVal(id){ return parseFloat(document.getElementById(id).value)||0; }

function autoCalc(){
  if(getVal('manHours') > 0) calculate();
}

function calculate(){
  const mh = getVal('manHours');
  if(!mh || mh <= 0){
    showToast('⚠️ Masukkan Total Jam Kerja terlebih dahulu');
    return;
  }

  const fatal = getVal('fatality');
  const lti   = getVal('lti');
  const ld    = getVal('lostDays');
  const rwc   = getVal('rwc');
  const mtc   = getVal('mtc');
  const fac   = getVal('fac');
  const nm    = getVal('nearMiss');

  const ltir  = ((lti + fatal) * factor) / mh;
  const trir  = ((fatal + lti + rwc + mtc) * factor) / mh;
  const ltisr = (ld * factor) / mh;
  const fr    = ltir; // same as LTIR in most standards
  const sr    = ltisr;
  const totalInc = fatal + lti + rwc + mtc + fac;

  // Determine status
  function ltirStatus(v){
    if(v <= 0) return 'safe';
    if(v <= 2) return 'safe';
    if(v <= 5) return 'warn';
    return 'danger';
  }
  function ltirBadge(v){
    if(v <= 0) return {cls:'badge-neutral',txt:'No Incident'};
    if(v <= 2) return {cls:'badge-safe',txt:'✓ Baik'};
    if(v <= 5) return {cls:'badge-warn',txt:'⚠ Perlu Perhatian'};
    return {cls:'badge-danger',txt:'⛔ Tinggi'};
  }

  function fmt(n){ return n.toFixed(2); }

  const ltirB = ltirBadge(ltir);
  const trirB = ltirBadge(trir);
  const periode = document.getElementById('periode').value;
  const stdLabel = standard === 'osha' ? 'OSHA (200.000 MH)' : 'International (1.000.000 MH)';

  document.getElementById('placeholder').style.display = 'none';

  document.getElementById('resultsPanel').innerHTML = `
    <div class="result-card highlight">
      <div class="result-header">
        <div>
          <div class="result-name">LTIR — Lost Time Injury Rate</div>
          <div class="result-value ${ltirStatus(ltir)}">${fmt(ltir)}</div>
          <div class="result-formula">(${lti+fatal} × ${factor.toLocaleString()}) ÷ ${mh.toLocaleString()}</div>
        </div>
        <span class="result-badge ${ltirB.cls}">${ltirB.txt}</span>
      </div>
      <div class="result-desc">Jumlah insiden yang menyebabkan kehilangan waktu kerja per ${factor.toLocaleString()} jam kerja. Standar: ${stdLabel}</div>
    </div>

    <div class="results-grid">
      <div class="result-card">
        <div class="result-name">TRIR — Total Recordable Incident Rate</div>
        <div class="result-value ${ltirStatus(trir)}">${fmt(trir)}</div>
        <div class="result-formula">${fatal+lti+rwc+mtc} kasus × ${factor.toLocaleString()} ÷ ${mh.toLocaleString()}</div>
        <div class="result-desc">Semua insiden tercatat (Fatality+LTI+RWC+MTC)</div>
        <span class="result-badge ${trirB.cls}" style="display:inline-block;margin-top:6px">${trirB.txt}</span>
      </div>
      <div class="result-card">
        <div class="result-name">LTISR — Severity Rate</div>
        <div class="result-value ${ld>0?'warn':'safe'}">${fmt(ltisr)}</div>
        <div class="result-formula">${ld} hari × ${factor.toLocaleString()} ÷ ${mh.toLocaleString()}</div>
        <div class="result-desc">Tingkat keparahan — hari kerja hilang per ${factor.toLocaleString()} jam</div>
      </div>
      <div class="result-card">
        <div class="result-name">Frequency Rate (FR)</div>
        <div class="result-value ${ltirStatus(fr)}">${fmt(fr)}</div>
        <div class="result-formula">FR = LTIR (${stdLabel})</div>
        <div class="result-desc">Frekuensi kecelakaan per ${factor.toLocaleString()} jam</div>
      </div>
      <div class="result-card">
        <div class="result-name">Total Insiden Tercatat</div>
        <div class="result-value ${totalInc>0?'warn':'safe'}">${totalInc}</div>
        <div class="result-desc">Fatal:${fatal} · LTI:${lti} · RWC:${rwc} · MTC:${mtc} · FAC:${fac}</div>
      </div>
    </div>

    <div class="result-card">
      <div class="result-name" style="margin-bottom:12px;font-size:.9rem;font-weight:700">Near Miss Ratio — Rasio Piramida Heinrich</div>
      <div style="display:flex;gap:12px;flex-wrap:wrap;font-size:.85rem">
        <div style="text-align:center;padding:12px;background:#f9fafb;border-radius:8px;flex:1">
          <div style="font-size:1.4rem;font-weight:800;color:#1a6b3a">${nm}</div>
          <div style="color:var(--muted)">Near Miss</div>
        </div>
        <div style="text-align:center;padding:12px;background:#f9fafb;border-radius:8px;flex:1">
          <div style="font-size:1.4rem;font-weight:800;color:#d97706">${lti+fatal}</div>
          <div style="color:var(--muted)">LTI+Fatal</div>
        </div>
        <div style="text-align:center;padding:12px;background:#f9fafb;border-radius:8px;flex:1">
          <div style="font-size:1.4rem;font-weight:800;color:var(--muted)">${nm > 0 ? (nm/(lti+fatal||1)).toFixed(1)+'x' : 'N/A'}</div>
          <div style="color:var(--muted)">Rasio</div>
        </div>
      </div>
      <p class="result-desc" style="margin-top:12px">Teori Heinrich: untuk setiap 1 LTI terdapat ~29 insiden minor dan ~300 hampir celaka. Rasio tinggi = budaya laporan baik.</p>
    </div>

    <div style="background:#f9fafb;border-radius:10px;padding:16px;font-size:.83rem;color:var(--muted)">
      <strong>Ringkasan — ${periode.toUpperCase()} | ${stdLabel}</strong><br>
      Man-Hours: <strong>${mh.toLocaleString()}</strong> | Karyawan: <strong>${getVal('employees')||'—'}</strong><br>
      LTIR: <strong>${fmt(ltir)}</strong> | TRIR: <strong>${fmt(trir)}</strong> | LTISR: <strong>${fmt(ltisr)}</strong>
    </div>

    <div class="result-actions">
      <button class="btn-copy" onclick="copyResult()">📋 Copy Hasil</button>
      <button class="btn-print" onclick="window.print()">🖨 Print Laporan</button>
    </div>
  `;
}

function copyResult(){
  const mh = getVal('manHours');
  const fatal = getVal('fatality');
  const lti   = getVal('lti');
  const ld    = getVal('lostDays');
  const rwc   = getVal('rwc');
  const mtc   = getVal('mtc');
  if(!mh) return;
  const ltir  = (((lti+fatal)*factor)/mh).toFixed(2);
  const trir  = (((fatal+lti+rwc+mtc)*factor)/mh).toFixed(2);
  const ltisr = ((ld*factor)/mh).toFixed(2);
  const text = `=== STATISTIK K3 ===\nMan-Hours: ${mh.toLocaleString()}\nLTIR: ${ltir}\nTRIR: ${trir}\nLTISR: ${ltisr}\nStandar: ${standard==='osha'?'OSHA (200.000)':'International (1.000.000)'}\nSumber: wahanatotalita.com/tools/kalkulator-k3`;
  navigator.clipboard.writeText(text).then(()=>showToast('✅ Hasil disalin ke clipboard!'));
}

function resetForm(){
  ['manHours','employees','fatality','lti','lostDays','rwc','mtc','fac','nearMiss'].forEach(id=>{
    document.getElementById(id).value = ['fatality','lti','lostDays','rwc','mtc','fac','nearMiss'].includes(id) ? '0' : '';
  });
  document.getElementById('resultsPanel').innerHTML = document.getElementById('placeholder').outerHTML;
  document.getElementById('placeholder').style.display = '';
}

function showToast(msg){
  const t = document.getElementById('toast');
  t.textContent = msg;
  t.classList.add('show');
  setTimeout(()=>t.classList.remove('show'), 2800);
}
</script>
</body>
</html>
