<?php
require_once __DIR__ . '/../config.php';
$s = get_all_settings();
?>
<?php
$page_title = 'JSA Builder Online Gratis — Buat Job Safety Analysis';
$meta_desc = 'Buat JSA (Job Safety Analysis) online gratis. Isi form langkah pekerjaan, potensi bahaya, risk level dan tindakan pencegahan — langsung cetak ke PDF. Untuk HSE officer Indonesia.';
require __DIR__ . '/../includes/head.php';
?>
<link rel="manifest" href="/manifest.json">
<style>
:root{--primary:#1a6b3a;--primary-d:#145530;--accent:#f5a623;--bg:#f8fafc;--card:#fff;--text:#1a202c;--muted:#6b7280;--radius:12px;--shadow:0 2px 16px rgba(0,0,0,.09)}
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Segoe UI',system-ui,sans-serif;background:var(--bg);color:var(--text);line-height:1.6}
a{color:var(--primary);text-decoration:none}
.container{max-width:1080px;margin:0 auto;padding:0 20px}
nav{background:#fff;border-bottom:1px solid #e5e7eb;padding:14px 0;position:sticky;top:0;z-index:100;box-shadow:0 1px 6px rgba(0,0,0,.06)}
.nav-inner{display:flex;align-items:center;justify-content:space-between}
.nav-logo{display:flex;align-items:center;gap:10px;font-weight:700;color:var(--primary);font-size:1rem}
.nav-logo svg{width:32px;height:32px}
.nav-cta{background:var(--primary);color:#fff;padding:8px 18px;border-radius:8px;font-size:.85rem;font-weight:600}
.hero{background:linear-gradient(135deg,#0f4c2a,#1a6b3a);color:#fff;padding:44px 0 32px;text-align:center}
.hero-badge{background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.25);border-radius:50px;padding:5px 16px;font-size:.8rem;font-weight:600;display:inline-block;margin-bottom:14px}
.hero h1{font-size:clamp(1.5rem,3vw,2.2rem);font-weight:800;margin-bottom:10px}
.hero h1 span{color:var(--accent)}
.hero p{opacity:.88;max-width:540px;margin:0 auto}
.main{padding:36px 0 80px}
.form-section{background:var(--card);border-radius:var(--radius);padding:28px;box-shadow:var(--shadow);border:1px solid #e5e7eb;margin-bottom:24px}
.form-section h2{font-size:1rem;font-weight:700;margin-bottom:18px;color:var(--primary);display:flex;align-items:center;gap:8px}
.grid-2{display:grid;grid-template-columns:1fr 1fr;gap:16px}
.grid-3{display:grid;grid-template-columns:1fr 1fr 1fr;gap:16px}
.form-group{margin-bottom:14px}
.form-group label{display:block;font-size:.85rem;font-weight:600;margin-bottom:5px;color:#374151}
.form-group input,.form-group select,.form-group textarea{width:100%;padding:9px 13px;border:2px solid #e5e7eb;border-radius:7px;font-size:.88rem;font-family:inherit;color:var(--text);background:#fff;transition:border .2s}
.form-group input:focus,.form-group select:focus,.form-group textarea:focus{border-color:var(--primary);outline:none}
.form-group textarea{min-height:60px;resize:vertical}
/* STEP TABLE */
.step-table-wrap{overflow-x:auto;margin-top:8px}
.step-table{width:100%;border-collapse:collapse;font-size:.83rem}
.step-table th{background:var(--primary);color:#fff;padding:10px 12px;text-align:left;font-size:.78rem;white-space:nowrap}
.step-table td{padding:8px;border-bottom:1px solid #f3f4f6;vertical-align:top}
.step-table td input,.step-table td select,.step-table td textarea{width:100%;border:1px solid #e5e7eb;border-radius:5px;padding:7px;font-size:.82rem;font-family:inherit;background:#fff;color:var(--text)}
.step-table td input:focus,.step-table td select:focus,.step-table td textarea:focus{border-color:var(--primary);outline:none}
.step-table td textarea{min-height:52px;resize:vertical}
.step-num{width:36px;text-align:center;font-weight:700;color:var(--muted)}
.btn-del{background:#fee2e2;color:#dc2626;border:none;border-radius:5px;padding:5px 10px;cursor:pointer;font-size:.8rem}
.risk-low{color:#16a34a;font-weight:700}
.risk-medium{color:#d97706;font-weight:700}
.risk-high{color:#c2410c;font-weight:700}
.risk-extreme{color:#dc2626;font-weight:700}
.btn-add-step{background:#f0fdf4;color:var(--primary);border:2px dashed #86efac;border-radius:8px;padding:12px;width:100%;font-size:.9rem;font-weight:600;cursor:pointer;margin-top:12px;transition:all .2s}
.btn-add-step:hover{background:#dcfce7}
/* ACTIONS BAR */
.actions-bar{display:flex;gap:12px;flex-wrap:wrap;margin-bottom:24px;align-items:center}
.btn-primary{background:var(--primary);color:#fff;border:none;border-radius:8px;padding:12px 24px;font-size:.92rem;font-weight:700;cursor:pointer;display:flex;align-items:center;gap:8px;transition:background .2s}
.btn-primary:hover{background:var(--primary-d)}
.btn-secondary{background:#f3f4f6;color:var(--text);border:1px solid #e5e7eb;border-radius:8px;padding:12px 20px;font-size:.88rem;font-weight:600;cursor:pointer;display:flex;align-items:center;gap:6px}
.btn-secondary:hover{background:#e5e7eb}
.btn-wa{background:#25D366;color:#fff;border:none;border-radius:8px;padding:12px 20px;font-size:.88rem;font-weight:600;cursor:pointer;display:flex;align-items:center;gap:6px}
/* SIGNATURE */
.sig-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-top:8px}
.sig-box{border:1px solid #e5e7eb;border-radius:8px;padding:16px;text-align:center}
.sig-box .sig-line{border-bottom:1px solid #374151;height:40px;margin-bottom:8px}
.sig-box p{font-size:.78rem;color:var(--muted)}
/* PRINT PREVIEW */
#printArea{display:none}
@media print{
  body{background:#fff}
  nav,.actions-bar,.form-section:not(#printPreviewSection),.cta-strip,footer,.tools-training-cta,.tool-article,a[href^="https://wa"]{display:none!important}
  #printArea{display:block!important}
  .print-jsa{font-family:Arial,sans-serif;padding:20px;font-size:9pt}
  .print-header{text-align:center;border-bottom:2px solid #000;padding-bottom:10px;margin-bottom:16px}
  .print-header h2{font-size:14pt;margin-bottom:4px}
  .print-meta{display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin-bottom:16px;font-size:8pt}
  .print-meta-item{border:1px solid #ccc;padding:6px 10px;border-radius:4px}
  .print-meta-item strong{display:block;font-size:7pt;color:#666;margin-bottom:2px}
  .print-steps{width:100%;border-collapse:collapse;font-size:8pt}
  .print-steps th{background:#1a6b3a;color:#fff;padding:7px 10px;text-align:left}
  .print-steps td{padding:7px 10px;border:1px solid #e5e7eb;vertical-align:top}
  .print-steps tr:nth-child(even) td{background:#f9fafb}
  .print-sigs{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-top:24px}
  .print-sig-box{border-top:1px solid #000;padding-top:6px;text-align:center;font-size:8pt}
  .print-footer{text-align:center;font-size:7pt;color:#999;margin-top:20px;border-top:1px solid #e5e7eb;padding-top:8px}
}
.cta-strip{background:var(--primary);color:#fff;border-radius:12px;padding:28px;text-align:center;margin:40px 0}
.cta-strip h3{font-size:1.1rem;font-weight:700;margin-bottom:8px}
.cta-strip p{opacity:.88;font-size:.88rem;margin-bottom:16px}
footer{background:#111827;color:#9ca3af;padding:30px 0;text-align:center;font-size:.83rem}
footer a{color:#6ee7b7}
.toast{position:fixed;bottom:80px;left:50%;transform:translateX(-50%) translateY(20px);background:#1a6b3a;color:#fff;padding:10px 24px;border-radius:50px;font-size:.88rem;font-weight:600;opacity:0;transition:all .3s;pointer-events:none;z-index:999}
.toast.show{opacity:1;transform:translateX(-50%) translateY(0)}
@media(max-width:768px){
  .grid-2,.grid-3,.sig-grid{grid-template-columns:1fr}
  .step-table th:nth-child(4),.step-table td:nth-child(4){display:none}
}
.tools-training-cta{padding:40px 0}
.tools-training-cta h2{font-size:1.3rem;font-weight:800;margin:0 0 16px;text-align:center;color:#0A4A2E}
.tools-training-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(230px,1fr));gap:16px}
.tools-training-card{background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:18px;display:flex;flex-direction:column}
.tools-training-card h3{font-size:.95rem;font-weight:700;margin:0 0 8px}
.tools-training-card h3 a{color:#0A4A2E;text-decoration:none}
.tools-training-card p{font-size:.85rem;color:#555;line-height:1.6;margin:0 0 12px;flex:1}
.tools-training-btn{display:inline-block;background:#0A4A2E;color:#fff;font-weight:700;font-size:.85rem;padding:8px 14px;border-radius:8px;text-decoration:none;text-align:center}
.tool-article{padding:12px 0 8px}
.tool-article h2{font-size:1.15rem;font-weight:800;color:var(--primary);margin:28px 0 14px}
.tool-article h2:first-child{margin-top:0}
.tool-article p{font-size:.92rem;color:#374151;line-height:1.8;margin-bottom:14px}
.tool-article ol{padding-left:20px;font-size:.92rem;line-height:1.9;color:#374151;margin-bottom:8px}
.tool-article ol li{margin-bottom:8px}
.faq-item{margin-bottom:16px}
.faq-item h3{font-size:.95rem;font-weight:700;color:var(--text);margin-bottom:6px}
.faq-item p{font-size:.9rem;color:#374151;margin:0}
</style>
<script type="application/ld+json">
{
  "@context":"https://schema.org",
  "@type":"SoftwareApplication",
  "name":"JSA Builder Online",
  "applicationCategory":"BusinessApplication",
  "operatingSystem":"Web",
  "offers":{"@type":"Offer","price":"0","priceCurrency":"IDR"},
  "description":"Buat Job Safety Analysis (JSA) online gratis. Isi form, cetak PDF.",
  "url":"https://wahanatotalita.com/tools/jsa-builder",
  "provider":{"@type":"Organization","name":"Wahana Totalita Konsultan"}
}
</script>
<script type="application/ld+json">
{"@context":"https://schema.org","@type":"FAQPage","mainEntity":[{"@type":"Question","name":"Apa bedanya JSA dengan IBPR?","acceptedAnswer":{"@type":"Answer","text":"IBPR menilai risiko pada tingkat aktivitas atau proses kerja secara umum, sedangkan JSA memecah satu aktivitas menjadi langkah-langkah kerja yang lebih rinci dan menganalisis bahaya di setiap langkahnya. Keduanya saling melengkapi — IBPR untuk pemetaan risiko menyeluruh, JSA untuk panduan kerja aman langkah demi langkah."}},{"@type":"Question","name":"Kapan JSA wajib dibuat sebelum bekerja?","acceptedAnswer":{"@type":"Answer","text":"JSA sebaiknya dibuat untuk semua pekerjaan berisiko tinggi atau non-rutin, seperti bekerja di ketinggian, pekerjaan panas (hot work), confined space entry, pekerjaan listrik, dan pekerjaan yang memerlukan izin kerja (Permit to Work)."}},{"@type":"Question","name":"Apakah JSA yang dibuat di tool ini bisa langsung digunakan sebagai dasar penerbitan Permit to Work?","acceptedAnswer":{"@type":"Answer","text":"Ya, dokumen JSA yang dicetak dari tool ini sudah mencakup identitas pekerjaan, langkah kerja, bahaya, level risiko, pengendalian, dan tanda tangan — cukup lengkap untuk dilampirkan sebagai dasar PTW. Pastikan tetap ditinjau dan disetujui oleh supervisor/HSE Manager sebelum pekerjaan dimulai."}}]}
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
    <div class="hero-badge">📋 JSA Tool Gratis</div>
    <h1><span>JSA Builder</span> Online<br>Job Safety Analysis Otomatis</h1>
    <p>Isi form, tambah langkah pekerjaan, potensi bahaya dan tindakan pencegahan — langsung cetak ke PDF. Gratis, tanpa daftar.</p>
  </div>
</section>

<section class="main">
  <div class="container">

    <!-- ACTIONS BAR -->
    <div class="actions-bar">
      <button class="btn-primary" onclick="printJSA()">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
        Cetak / Simpan PDF
      </button>
      <button class="btn-secondary" onclick="addStep()">+ Tambah Langkah</button>
      <button class="btn-secondary" onclick="clearAll()">↺ Baru / Reset</button>
      <a href="https://wa.me/6287759151278?text=Halo%20Wahana%2C%20saya%20ingin%20konsultasi%20JSA%20dan%20prosedur%20K3" target="_blank" class="btn-wa">
        <svg viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
        Konsultasi JSA
      </a>
    </div>

    <!-- HEADER INFO -->
    <div class="form-section">
      <h2>📄 Informasi Umum JSA</h2>
      <div class="grid-2">
        <div class="form-group">
          <label>Nama / Judul Pekerjaan</label>
          <input type="text" id="jobTitle" placeholder="cth: Pekerjaan Pengelasan di Ketinggian">
        </div>
        <div class="form-group">
          <label>Nomor Dokumen JSA</label>
          <input type="text" id="docNumber" placeholder="cth: JSA-K3-2025-001">
        </div>
        <div class="form-group">
          <label>Departemen / Bagian</label>
          <input type="text" id="department" placeholder="cth: Maintenance Dept.">
        </div>
        <div class="form-group">
          <label>Lokasi Pekerjaan</label>
          <input type="text" id="location" placeholder="cth: Workshop Area B, Lantai 3">
        </div>
        <div class="form-group">
          <label>Tanggal Berlaku</label>
          <input type="date" id="jsaDate" value="<?php echo date('Y-m-d'); ?>">
        </div>
        <div class="form-group">
          <label>Supervisor / PIC</label>
          <input type="text" id="supervisor" placeholder="cth: Budi Santoso">
        </div>
        <div class="form-group">
          <label>Perusahaan</label>
          <input type="text" id="company" placeholder="cth: PT. Karya Maju Bersama">
        </div>
        <div class="form-group">
          <label>Nomor Izin Kerja / PTW (jika ada)</label>
          <input type="text" id="ptwNumber" placeholder="cth: PTW-2025-0241">
        </div>
      </div>
      <div class="form-group">
        <label>APD Wajib untuk Pekerjaan Ini</label>
        <input type="text" id="ppe" placeholder="cth: Helm K3, Safety Harness, Kacamata Las, Sarung Tangan Kulit, Sepatu Safety, APAR">
      </div>
      <div class="form-group">
        <label>Kondisi / Persyaratan Khusus</label>
        <input type="text" id="conditions" placeholder="cth: Hanya boleh dilakukan saat cuaca cerah, wajib ada pengawas di bawah">
      </div>
    </div>

    <!-- STEPS TABLE -->
    <div class="form-section">
      <h2>📝 Langkah Pekerjaan, Bahaya & Pengendalian</h2>
      <div class="step-table-wrap">
        <table class="step-table">
          <thead>
            <tr>
              <th style="width:40px">#</th>
              <th style="min-width:160px">Langkah Pekerjaan</th>
              <th style="min-width:180px">Potensi Bahaya</th>
              <th style="min-width:80px">Level Risiko</th>
              <th style="min-width:200px">Tindakan Pencegahan / Pengendalian</th>
              <th style="min-width:100px">APD Spesifik</th>
              <th style="width:50px">Hapus</th>
            </tr>
          </thead>
          <tbody id="stepsBody">
            <!-- steps added by JS -->
          </tbody>
        </table>
      </div>
      <button class="btn-add-step" onclick="addStep()">+ Tambah Langkah Pekerjaan</button>
    </div>

    <!-- EMERGENCY & CONTACTS -->
    <div class="form-section">
      <h2>🚒 Kontak Darurat & Prosedur Emergency</h2>
      <div class="grid-3">
        <div class="form-group">
          <label>No. Emergency / P3K</label>
          <input type="text" id="emerPhone" placeholder="cth: 119 / ext 112">
        </div>
        <div class="form-group">
          <label>Lokasi APAR Terdekat</label>
          <input type="text" id="aparLoc" placeholder="cth: Koridor Area B, 20m dari area kerja">
        </div>
        <div class="form-group">
          <label>Lokasi Kotak P3K</label>
          <input type="text" id="p3kLoc" placeholder="cth: Pos Security, Lantai 1">
        </div>
      </div>
      <div class="form-group">
        <label>Prosedur Darurat Singkat</label>
        <textarea id="emerProc" placeholder="cth: 1) Hentikan pekerjaan. 2) Amankan area. 3) Hubungi supervisior dan medical. 4) Jangan pindahkan korban sampai medical tiba."></textarea>
      </div>
    </div>

    <!-- SIGNATURES -->
    <div class="form-section">
      <h2>✍️ Tanda Tangan & Persetujuan</h2>
      <div class="sig-grid">
        <div class="sig-box">
          <div class="sig-line"></div>
          <p><strong>Dibuat oleh</strong><br>HSE Officer</p>
          <input type="text" id="sig1name" placeholder="Nama" style="margin-top:8px;width:100%;border:1px solid #e5e7eb;border-radius:5px;padding:6px;font-size:.82rem">
        </div>
        <div class="sig-box">
          <div class="sig-line"></div>
          <p><strong>Disetujui oleh</strong><br>Supervisor / Foreman</p>
          <input type="text" id="sig2name" placeholder="Nama" style="margin-top:8px;width:100%;border:1px solid #e5e7eb;border-radius:5px;padding:6px;font-size:.82rem">
        </div>
        <div class="sig-box">
          <div class="sig-line"></div>
          <p><strong>Mengetahui</strong><br>HSE Manager</p>
          <input type="text" id="sig3name" placeholder="Nama" style="margin-top:8px;width:100%;border:1px solid #e5e7eb;border-radius:5px;padding:6px;font-size:.82rem">
        </div>
      </div>
    </div>

    <div class="actions-bar">
      <button class="btn-primary" onclick="printJSA()">🖨 Cetak / Simpan PDF</button>
      <button class="btn-secondary" onclick="addStep()">+ Tambah Langkah</button>
    </div>

    <div class="cta-strip">
      <h3>🎓 Pelajari Cara Membuat JSA yang Benar</h3>
      <p>Pelatihan K3 Umum kami mencakup praktik JSA, IBPR, dan prosedur kerja aman sesuai standar KEMNAKER.</p>
      <a href="https://wa.me/6287759151278?text=Halo%20Wahana%2C%20saya%20pakai%20JSA%20Builder%20dan%20ingin%20tanya%20pelatihan%20K3" target="_blank" rel="noopener"
         style="background:#25D366;color:#fff;padding:12px 28px;border-radius:8px;font-weight:700;display:inline-flex;align-items:center;gap:8px">
        📱 Tanya Jadwal Pelatihan K3
      </a>
    </div>
  </div>
</section>

<section class="tool-article">
  <div class="container">
    <h2>Cara Menggunakan JSA Builder</h2>
    <ol>
      <li>Isi Informasi Umum JSA — nama/judul pekerjaan, nomor dokumen, departemen, lokasi, tanggal berlaku, supervisor/PIC, perusahaan, dan nomor izin kerja (PTW) jika ada.</li>
      <li>Cantumkan APD wajib dan kondisi/persyaratan khusus untuk pekerjaan tersebut pada kolom yang tersedia.</li>
      <li>Klik "+ Tambah Langkah Pekerjaan" untuk memecah pekerjaan menjadi tahapan-tahapan kecil dan berurutan.</li>
      <li>Untuk setiap langkah, isi Potensi Bahaya, pilih Level Risiko (Low/Medium/High/Extreme), lalu isi Tindakan Pencegahan/Pengendalian dan APD spesifik yang dibutuhkan pada langkah tersebut.</li>
      <li>Lengkapi kontak darurat, lokasi APAR dan P3K, serta prosedur darurat singkat pada bagian Kontak Darurat & Prosedur Emergency.</li>
      <li>Isi nama pada bagian tanda tangan (dibuat oleh, disetujui oleh, mengetahui), lalu klik "Cetak / Simpan PDF" untuk menghasilkan dokumen JSA siap tanda tangan basah.</li>
    </ol>

    <h2>Manfaat JSA Builder untuk Keselamatan Kerja</h2>
    <p>JSA (Job Safety Analysis) adalah metode sistematis untuk memecah sebuah pekerjaan menjadi langkah-langkah kecil, lalu mengidentifikasi bahaya spesifik di setiap langkah beserta cara mengendalikannya. Berbeda dengan IBPR yang menilai risiko pada level aktivitas atau proses, JSA berfokus pada urutan langkah kerja yang lebih rinci — sehingga sangat cocok digunakan sebelum pekerjaan berisiko tinggi seperti bekerja di ketinggian, pekerjaan panas, atau confined space entry.</p>
    <p>Dengan JSA Builder ini, supervisor atau HSE Officer dapat menyusun dokumen JSA langsung di lokasi kerja tanpa perlu template Word atau Excel terpisah. Setiap langkah pekerjaan, bahaya, level risiko, dan tindakan pengendalian tersusun rapi dalam satu tabel, lengkap dengan kolom APD spesifik per langkah — bukan sekadar APD umum di awal dokumen.</p>
    <p>JSA yang dibuat sebelum pekerjaan dimulai juga menjadi alat komunikasi penting dalam toolbox meeting atau safety briefing. Pekerja yang terlibat bisa memahami urutan kerja yang aman, bahaya apa yang mengintai di setiap tahap, dan apa yang harus dilakukan untuk mencegahnya — bukan hanya membaca dokumen setelah insiden terjadi.</p>
    <p>Dokumen JSA yang ditandatangani oleh pembuat, penyetuju, dan yang mengetahui juga menjadi bukti akuntabilitas dan kepatuhan saat terjadi audit K3 atau investigasi insiden, sekaligus menjadi syarat pendukung sebelum penerbitan izin kerja (Permit to Work) untuk pekerjaan berisiko tinggi.</p>

    <h2>Dasar Hukum yang Relevan</h2>
    <p>JSA merupakan bagian dari implementasi Sistem Manajemen Keselamatan dan Kesehatan Kerja (SMK3) yang diwajibkan dalam PP No. 50 Tahun 2012, khususnya pada elemen pengendalian operasional yang mengharuskan setiap pekerjaan berisiko memiliki prosedur kerja aman. Kewajiban dasar penyediaan lingkungan kerja yang aman juga merujuk pada UU No. 1 Tahun 1970 tentang Keselamatan Kerja, yang mewajibkan pengurus tempat kerja memberi petunjuk yang diperlukan sesuai pekerjaan yang akan dilakukan.</p>

    <h2>Pertanyaan Umum</h2>
    <div class="faq-item">
      <h3>Apa bedanya JSA dengan IBPR?</h3>
      <p>IBPR menilai risiko pada tingkat aktivitas atau proses kerja secara umum, sedangkan JSA memecah satu aktivitas menjadi langkah-langkah kerja yang lebih rinci dan menganalisis bahaya di setiap langkahnya. Keduanya saling melengkapi — IBPR untuk pemetaan risiko menyeluruh, JSA untuk panduan kerja aman langkah demi langkah.</p>
    </div>
    <div class="faq-item">
      <h3>Kapan JSA wajib dibuat sebelum bekerja?</h3>
      <p>JSA sebaiknya dibuat untuk semua pekerjaan berisiko tinggi atau non-rutin, seperti bekerja di ketinggian, pekerjaan panas (hot work), confined space entry, pekerjaan listrik, dan pekerjaan yang memerlukan izin kerja (Permit to Work).</p>
    </div>
    <div class="faq-item">
      <h3>Apakah JSA yang dibuat di tool ini bisa langsung digunakan sebagai dasar penerbitan Permit to Work?</h3>
      <p>Ya, dokumen JSA yang dicetak dari tool ini sudah mencakup identitas pekerjaan, langkah kerja, bahaya, level risiko, pengendalian, dan tanda tangan — cukup lengkap untuk dilampirkan sebagai dasar PTW. Pastikan tetap ditinjau dan disetujui oleh supervisor/HSE Manager sebelum pekerjaan dimulai.</p>
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

<!-- PRINT AREA (hidden on screen, shown in print) -->
<div id="printArea">
  <div class="print-jsa" id="printJsaContent"></div>
</div>

<footer>
  <div class="container">
    <p><a href="/tools/">← Semua Tools K3</a> | <a href="/tools/risk-matrix">Risk Matrix</a> | <a href="/tools/ibpr-generator">IBPR Generator</a> | <a href="/">Wahana Totalita</a></p>
    <p style="margin-top:8px">© <?php echo date('Y'); ?> Wahana Totalita Konsultan, Yogyakarta</p>
  </div>
</footer>

<a href="https://wa.me/6287759151278" target="_blank" style="position:fixed;bottom:24px;right:24px;background:#25D366;width:52px;height:52px;border-radius:50%;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 14px rgba(37,211,102,.4);z-index:999">
  <svg viewBox="0 0 24 24" fill="white" width="26" height="26"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
</a>
<div class="toast" id="toast"></div>

<script>
let stepCount = 0;

function g(id){ return document.getElementById(id)?.value?.trim()||''; }

function addStep(){
  stepCount++;
  const tbody = document.getElementById('stepsBody');
  const tr = document.createElement('tr');
  tr.id = `step-${stepCount}`;
  tr.innerHTML = `
    <td class="step-num">${stepCount}</td>
    <td><textarea placeholder="cth: Pasang scaffolding, nyalakan mesin las..." rows="2"></textarea></td>
    <td><textarea placeholder="cth: Terjatuh dari ketinggian, percikan api, asap las..." rows="2"></textarea></td>
    <td>
      <select onchange="updateRiskColor(this)">
        <option value="">— Pilih —</option>
        <option value="low" class="risk-low">Low</option>
        <option value="medium" class="risk-medium">Medium</option>
        <option value="high" class="risk-high">High</option>
        <option value="extreme" class="risk-extreme">Extreme</option>
      </select>
    </td>
    <td><textarea placeholder="cth: Gunakan full body harness, periksa scaffolding, sediakan fire watch..." rows="2"></textarea></td>
    <td><textarea placeholder="cth: Safety harness, helm, kacamata las" rows="2"></textarea></td>
    <td><button class="btn-del" onclick="removeStep(${stepCount})">✕</button></td>
  `;
  tbody.appendChild(tr);
  tr.querySelector('textarea').focus();
}

function removeStep(n){
  const el = document.getElementById(`step-${n}`);
  if(el) el.remove();
  renumberSteps();
}

function renumberSteps(){
  document.querySelectorAll('#stepsBody tr').forEach((tr,i)=>{
    const numCell = tr.querySelector('.step-num');
    if(numCell) numCell.textContent = i+1;
  });
}

function updateRiskColor(sel){
  sel.className = sel.value ? `risk-${sel.value}` : '';
}

function getStepsData(){
  const rows = [];
  document.querySelectorAll('#stepsBody tr').forEach((tr,i)=>{
    const tds = tr.querySelectorAll('td');
    if(tds.length >= 6){
      rows.push({
        no: i+1,
        step:  tds[1].querySelector('textarea')?.value || '',
        hazard:tds[2].querySelector('textarea')?.value || '',
        risk:  tds[3].querySelector('select')?.value || '',
        control:tds[4].querySelector('textarea')?.value || '',
        ppe:   tds[5].querySelector('textarea')?.value || '',
      });
    }
  });
  return rows;
}

function printJSA(){
  const steps = getStepsData();
  const riskColors = {low:'#16a34a',medium:'#d97706',high:'#c2410c',extreme:'#dc2626'};

  const html = `
    <div class="print-header">
      <h2>JOB SAFETY ANALYSIS (JSA)</h2>
      <p style="font-size:10pt;color:#666">Form No. Dok: ${g('docNumber')||'—'}</p>
    </div>
    <div class="print-meta">
      <div class="print-meta-item"><strong>NAMA PEKERJAAN</strong>${g('jobTitle')||'—'}</div>
      <div class="print-meta-item"><strong>DEPARTEMEN</strong>${g('department')||'—'}</div>
      <div class="print-meta-item"><strong>TANGGAL</strong>${g('jsaDate')||'—'}</div>
      <div class="print-meta-item"><strong>LOKASI</strong>${g('location')||'—'}</div>
      <div class="print-meta-item"><strong>SUPERVISOR</strong>${g('supervisor')||'—'}</div>
      <div class="print-meta-item"><strong>NO. PTW</strong>${g('ptwNumber')||'—'}</div>
      <div class="print-meta-item" style="grid-column:1/-1"><strong>PERUSAHAAN</strong>${g('company')||'—'}</div>
      <div class="print-meta-item" style="grid-column:1/-1"><strong>APD WAJIB</strong>${g('ppe')||'—'}</div>
    </div>
    <table class="print-steps">
      <thead>
        <tr>
          <th style="width:32px">#</th>
          <th>Langkah Pekerjaan</th>
          <th>Potensi Bahaya</th>
          <th style="width:70px">Risk Level</th>
          <th>Tindakan Pencegahan</th>
          <th>APD Spesifik</th>
        </tr>
      </thead>
      <tbody>
        ${steps.map(s=>`
          <tr>
            <td style="text-align:center">${s.no}</td>
            <td>${s.step||'—'}</td>
            <td>${s.hazard||'—'}</td>
            <td style="text-align:center;color:${riskColors[s.risk]||'#374151'};font-weight:700">${s.risk?s.risk.toUpperCase():'—'}</td>
            <td>${s.control||'—'}</td>
            <td>${s.ppe||'—'}</td>
          </tr>
        `).join('')}
        ${!steps.length ? '<tr><td colspan="6" style="text-align:center;color:#999;padding:20px">Tidak ada langkah pekerjaan</td></tr>' : ''}
      </tbody>
    </table>
    ${g('emerPhone')||g('aparLoc') ? `
    <div style="margin-top:16px;padding:10px;border:1px solid #e5e7eb;border-radius:4px;font-size:8pt">
      <strong>KONTAK DARURAT:</strong> ${g('emerPhone')} &nbsp;|&nbsp;
      <strong>APAR:</strong> ${g('aparLoc')} &nbsp;|&nbsp;
      <strong>P3K:</strong> ${g('p3kLoc')}
      ${g('emerProc') ? `<br><strong>PROSEDUR DARURAT:</strong> ${g('emerProc')}` : ''}
    </div>` : ''}
    <div class="print-sigs">
      <div class="print-sig-box">Dibuat oleh: ${g('sig1name')||'_________________'}<br>HSE Officer</div>
      <div class="print-sig-box">Disetujui oleh: ${g('sig2name')||'_________________'}<br>Supervisor</div>
      <div class="print-sig-box">Mengetahui: ${g('sig3name')||'_________________'}<br>HSE Manager</div>
    </div>
    <div class="print-footer">Dibuat menggunakan JSA Builder Online Gratis — wahanatotalita.com/tools/jsa-builder</div>
  `;

  document.getElementById('printJsaContent').innerHTML = html;
  window.print();
}

function clearAll(){
  if(confirm('Reset semua data JSA?')){
    ['jobTitle','docNumber','department','location','jsaDate','supervisor','company','ptwNumber','ppe','conditions','emerPhone','aparLoc','p3kLoc','emerProc','sig1name','sig2name','sig3name'].forEach(id=>{ const el=document.getElementById(id); if(el) el.value = id==='jsaDate'?new Date().toISOString().split('T')[0]:''; });
    document.getElementById('stepsBody').innerHTML = '';
    stepCount = 0;
    addStep(); addStep(); addStep();
  }
}

function showToast(msg){
  const t = document.getElementById('toast');
  t.textContent = msg;
  t.classList.add('show');
  setTimeout(()=>t.classList.remove('show'), 2500);
}

// Init with 3 empty steps
addStep(); addStep(); addStep();
</script>
</body>
</html>
