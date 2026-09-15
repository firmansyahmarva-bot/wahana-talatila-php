<?php
require_once __DIR__ . '/../config.php';
$s = get_all_settings();
?>
<?php
$page_title = 'Kalkulator Biaya Kecelakaan Kerja Online Gratis — Rasio Heinrich';
$meta_desc = 'Kalkulator biaya kecelakaan kerja online gratis. Hitung biaya langsung dan tidak langsung menggunakan Rasio Heinrich (1:4). Justifikasi anggaran K3 dengan data nyata.';
require __DIR__ . '/../includes/head.php';
?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "SoftwareApplication",
  "applicationCategory": "BusinessApplication",
  "name": "Kalkulator Biaya Kecelakaan Kerja Online Gratis — Rasio Heinrich",
  "description": "Kalkulator biaya kecelakaan kerja online gratis. Hitung biaya langsung dan tidak langsung menggunakan Rasio Heinrich (1:4). Justifikasi anggaran K3 dengan data nyata.",
  "url": "https://wahanatotalita.com/tools/kalkulator-biaya-k3/",
  "provider": {"@type": "Organization", "name": "Wahana Totalita", "url": "https://wahanatotalita.com"},
  "offers": {"@type": "Offer", "price": "0", "priceCurrency": "IDR"}
}
</script>
<link rel="manifest" href="/manifest.json">
<style>
:root{--primary:#1a6b3a;--primary-d:#145530;--accent:#f5a623;--bg:#f8fafc;--card:#fff;--text:#1a202c;--muted:#6b7280;--radius:12px;--shadow:0 2px 16px rgba(0,0,0,.09)}
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Segoe UI',system-ui,sans-serif;background:var(--bg);color:var(--text);line-height:1.6}
a{color:var(--primary);text-decoration:none}
.container{max-width:900px;margin:0 auto;padding:0 20px}
nav{background:#fff;border-bottom:1px solid #e5e7eb;padding:14px 0;position:sticky;top:0;z-index:100;box-shadow:0 1px 6px rgba(0,0,0,.06)}
.nav-inner{display:flex;align-items:center;justify-content:space-between}
.nav-logo{display:flex;align-items:center;gap:10px;font-weight:700;color:var(--primary);font-size:1rem}
.nav-logo svg{width:32px;height:32px}
.nav-cta{background:var(--primary);color:#fff;padding:8px 18px;border-radius:8px;font-size:.85rem;font-weight:600}
.hero{background:linear-gradient(135deg,#0f4c2a,#1a6b3a);color:#fff;padding:44px 0 32px;text-align:center}
.hero-badge{background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.25);border-radius:50px;padding:5px 16px;font-size:.8rem;font-weight:600;display:inline-block;margin-bottom:14px}
.hero h1{font-size:clamp(1.5rem,3vw,2.2rem);font-weight:800;margin-bottom:10px}
.hero h1 span{color:var(--accent)}
.hero p{opacity:.88;max-width:560px;margin:0 auto}
.main{padding:36px 0 80px}
.layout{display:grid;grid-template-columns:1fr 1fr;gap:28px;align-items:start}
.panel{background:var(--card);border-radius:var(--radius);padding:26px;box-shadow:var(--shadow);border:1px solid #e5e7eb}
.panel h2{font-size:1rem;font-weight:700;margin-bottom:16px;color:var(--primary)}
.form-group{margin-bottom:14px}
.form-group label{display:block;font-size:.85rem;font-weight:600;margin-bottom:5px}
.form-group label span{font-size:.78rem;color:var(--muted);font-weight:400}
.form-group input{width:100%;padding:10px 14px;border:2px solid #e5e7eb;border-radius:7px;font-size:.92rem;background:#fff;color:var(--text)}
.form-group input:focus{border-color:var(--primary);outline:none}
.ratio-toggle{display:flex;gap:0;background:#f3f4f6;border-radius:8px;padding:3px;margin-bottom:16px}
.ratio-btn{flex:1;padding:8px;border:none;background:transparent;border-radius:6px;font-size:.82rem;font-weight:600;cursor:pointer;color:var(--muted);transition:all .2s}
.ratio-btn.active{background:var(--primary);color:#fff}
.btn-calc{width:100%;background:var(--primary);color:#fff;border:none;border-radius:9px;padding:13px;font-size:.95rem;font-weight:700;cursor:pointer;margin-top:8px}
.btn-calc:hover{background:var(--primary-d)}
.result-panel{display:none}
.result-panel.show{display:block}
.total-cost{background:linear-gradient(135deg,#1a6b3a,#2d8a52);color:#fff;border-radius:12px;padding:24px;text-align:center;margin-bottom:16px}
.total-amount{font-size:2.4rem;font-weight:900;line-height:1}
.total-label{font-size:.85rem;opacity:.85;margin-top:4px}
.cost-breakdown{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:14px}
.cost-card{background:#f9fafb;border-radius:10px;padding:16px;border:1px solid #e5e7eb}
.cost-card .amount{font-size:1.5rem;font-weight:800}
.cost-card .label{font-size:.78rem;color:var(--muted);margin-top:3px}
.cost-card.direct .amount{color:#dc2626}
.cost-card.indirect .amount{color:#d97706}
.iceberg{background:#eff6ff;border-radius:10px;padding:16px;margin-bottom:14px;text-align:center}
.iceberg-title{font-size:.88rem;font-weight:700;color:#1d4ed8;margin-bottom:10px}
.ice-above{background:#3b82f6;color:#fff;padding:10px;border-radius:6px 6px 0 0;font-size:.82rem}
.ice-below{background:#1e3a8a;color:#fff;padding:10px;border-radius:0 0 6px 6px;font-size:.82rem}
.roi-box{background:#f0fdf4;border:1px solid #86efac;border-radius:10px;padding:16px;margin-bottom:14px}
.roi-box h4{font-size:.88rem;font-weight:700;color:var(--primary);margin-bottom:8px}
.roi-box p{font-size:.82rem;color:#374151}
.info-box{background:#f0fdf4;border-left:4px solid var(--primary);border-radius:8px;padding:16px 20px;margin-top:20px}
.info-box h4{font-size:.9rem;font-weight:700;color:var(--primary);margin-bottom:8px}
.info-box li{font-size:.82rem;color:#374151;line-height:1.7}
.info-box ul{padding-left:16px}
.cta-strip{background:var(--primary);color:#fff;border-radius:12px;padding:24px;text-align:center;margin:36px 0}
.cta-strip h3{font-size:1rem;font-weight:700;margin-bottom:8px}
.cta-strip p{opacity:.88;font-size:.85rem;margin-bottom:14px}
footer{background:#111827;color:#9ca3af;padding:30px 0;text-align:center;font-size:.83rem}
footer a{color:#6ee7b7}
@media(max-width:768px){.layout{grid-template-columns:1fr}.cost-breakdown{grid-template-columns:1fr}}
.tools-training-cta{padding:40px 0}
.tools-training-cta h2{font-size:1.3rem;font-weight:800;margin:0 0 16px;text-align:center;color:#0A4A2E}
.tools-training-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(230px,1fr));gap:16px}
.tools-training-card{background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:18px;display:flex;flex-direction:column}
.tools-training-card h3{font-size:.95rem;font-weight:700;margin:0 0 8px}
.tools-training-card h3 a{color:#0A4A2E;text-decoration:none}
.tools-training-card p{font-size:.85rem;color:#555;line-height:1.6;margin:0 0 12px;flex:1}
.tools-training-btn{display:inline-block;background:#0A4A2E;color:#fff;font-weight:700;font-size:.85rem;padding:8px 14px;border-radius:8px;text-decoration:none;text-align:center}
</style>
<nav>
  <div class="container nav-inner">
    <a href="/" class="nav-logo">
      <svg viewBox="0 0 40 40" fill="none"><circle cx="20" cy="20" r="20" fill="#1a6b3a"/><path d="M20 8l3 9h9l-7 5 3 9-8-6-8 6 3-9-7-5h9z" fill="#f5a623"/></svg>
      Wahana Totalita
    </a>
    <a href="/tools/" style="color:var(--muted);font-size:.88rem">← Semua Tools</a>
    <a href="https://wa.me/6281235036420" target="_blank" class="nav-cta">📱 Konsultasi</a>
  </div>
</nav>

<section class="hero">
  <div class="container">
    <div class="hero-badge">💰 Kalkulator Biaya K3</div>
    <h1>Kalkulator <span>Biaya Kecelakaan</span><br>Kerja Online Gratis</h1>
    <p>Hitung total biaya kecelakaan kerja (langsung + tidak langsung) menggunakan Rasio Heinrich. Gunakan untuk justifikasi anggaran K3 ke manajemen.</p>
  </div>
</section>

<section class="main">
  <div class="container">
    <div class="layout">
      <div>
        <div class="panel">
          <h2>💰 Input Data Kecelakaan</h2>

          <div class="form-group">
            <label>Model Perhitungan</label>
            <div class="ratio-toggle">
              <button class="ratio-btn active" id="btnHeinrich" onclick="setModel('heinrich')">Heinrich (1:4)</button>
              <button class="ratio-btn" id="btnBird" onclick="setModel('bird')">Bird (1:5)</button>
              <button class="ratio-btn" id="btnOsha" onclick="setModel('osha')">OSHA (1:4.5)</button>
            </div>
          </div>

          <div class="form-group">
            <label>Biaya Langsung (Direct Cost) <span>— biaya medis, kompensasi, kerusakan peralatan terlihat</span></label>
            <input type="number" id="directCost" placeholder="cth: 50000000" min="0" oninput="autoCalc()">
          </div>

          <p style="font-size:.8rem;color:var(--muted);margin-bottom:12px;font-weight:600">Komponen Biaya Langsung (opsional — untuk rincian)</p>

          <div class="form-group">
            <label>Biaya Pengobatan / Rumah Sakit</label>
            <input type="number" id="medical" placeholder="0" min="0" oninput="syncDirect()">
          </div>
          <div class="form-group">
            <label>Kompensasi / Santunan Kecelakaan</label>
            <input type="number" id="compensation" placeholder="0" min="0" oninput="syncDirect()">
          </div>
          <div class="form-group">
            <label>Kerusakan Peralatan / Properti</label>
            <input type="number" id="equipment" placeholder="0" min="0" oninput="syncDirect()">
          </div>

          <button class="btn-calc" onclick="calculate()">💰 Hitung Total Biaya</button>
        </div>

        <div class="info-box" style="margin-top:20px">
          <h4>📐 Penjelasan Rasio Biaya Kecelakaan</h4>
          <ul>
            <li><strong>Heinrich (1:4):</strong> 1 bagian biaya langsung = 4 bagian biaya tidak langsung → total 1:5</li>
            <li><strong>Bird (1:5):</strong> lebih konservatif untuk industri berat</li>
            <li><strong>OSHA (1:4.5):</strong> standar yang digunakan OSHA untuk justifikasi program K3</li>
            <li>Biaya tidak langsung termasuk: kehilangan produktivitas, waktu investigasi, pelatihan pengganti, dampak moral karyawan, denda regulator</li>
          </ul>
        </div>
      </div>

      <div>
        <div id="placeholder" style="background:var(--card);border-radius:var(--radius);padding:60px 24px;text-align:center;color:var(--muted);box-shadow:var(--shadow);border:1px solid #e5e7eb">
          <div style="font-size:3rem;margin-bottom:12px">💰</div>
          <p>Masukkan biaya langsung kecelakaan dan klik <strong>Hitung</strong> untuk melihat estimasi total biaya nyata</p>
        </div>
        <div class="result-panel" id="resultPanel"></div>

        <div class="cta-strip" style="margin-top:24px">
          <h3>📈 Anggaran K3 Selalu Lebih Murah</h3>
          <p>Program K3 yang baik mencegah kecelakaan. Biaya pelatihan jauh lebih kecil dari total kerugian kecelakaan kerja.</p>
          <a href="https://wa.me/6281235036420?text=Halo%20Wahana%2C%20saya%20pakai%20kalkulator%20biaya%20kecelakaan%20dan%20ingin%20konsultasi%20program%20K3" target="_blank" rel="noopener"
             style="background:#25D366;color:#fff;padding:11px 24px;border-radius:8px;font-weight:700;display:inline-flex;align-items:center;gap:8px">
            📱 Konsultasi Program K3
          </a>
        </div>
      </div>
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
    <p><a href="/tools/">← Semua Tools K3</a> | <a href="/tools/kalkulator-k3">Kalkulator LTIR</a> | <a href="/">Wahana Totalita</a></p>
    <p style="margin-top:8px">© <?php echo date('Y'); ?> Wahana Totalita Konsultan, Yogyakarta</p>
  </div>
</footer>

<a href="https://wa.me/6281235036420" target="_blank" style="position:fixed;bottom:24px;right:24px;background:#25D366;width:52px;height:52px;border-radius:50%;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 14px rgba(37,211,102,.4);z-index:999">
  <svg viewBox="0 0 24 24" fill="white" width="26" height="26"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
</a>

<script>
let model = 'heinrich';
let multiplier = 4;

function setModel(m){
  model = m;
  multiplier = m==='bird' ? 5 : m==='osha' ? 4.5 : 4;
  document.getElementById('btnHeinrich').classList.toggle('active', m==='heinrich');
  document.getElementById('btnBird').classList.toggle('active', m==='bird');
  document.getElementById('btnOsha').classList.toggle('active', m==='osha');
  if(parseFloat(document.getElementById('directCost').value) > 0) calculate();
}

function syncDirect(){
  const med = parseFloat(document.getElementById('medical').value)||0;
  const comp = parseFloat(document.getElementById('compensation').value)||0;
  const equip = parseFloat(document.getElementById('equipment').value)||0;
  const total = med + comp + equip;
  if(total > 0) document.getElementById('directCost').value = total;
}

function autoCalc(){
  if(parseFloat(document.getElementById('directCost').value) > 0) calculate();
}

function fmt(n){
  if(n >= 1000000000) return 'Rp ' + (n/1000000000).toFixed(1) + ' M';
  if(n >= 1000000) return 'Rp ' + (n/1000000).toFixed(1) + ' jt';
  return 'Rp ' + n.toLocaleString('id-ID');
}
function fmtFull(n){ return 'Rp ' + n.toLocaleString('id-ID'); }

function calculate(){
  const direct = parseFloat(document.getElementById('directCost').value)||0;
  if(!direct){ alert('Masukkan biaya langsung terlebih dahulu'); return; }

  const indirect = direct * multiplier;
  const total = direct + indirect;
  const modelLabel = model==='bird' ? 'Bird (1:5)' : model==='osha' ? 'OSHA (1:4.5)' : 'Heinrich (1:4)';

  document.getElementById('placeholder').style.display = 'none';
  const panel = document.getElementById('resultPanel');
  panel.className = 'result-panel show';
  panel.innerHTML = `
    <div class="total-cost">
      <div class="total-amount">${fmt(total)}</div>
      <div class="total-label">Total Biaya Nyata Kecelakaan (Model: ${modelLabel})</div>
    </div>

    <div class="cost-breakdown">
      <div class="cost-card direct">
        <div class="amount">${fmt(direct)}</div>
        <div class="label">💸 Biaya Langsung<br><small>${fmtFull(direct)}</small></div>
      </div>
      <div class="cost-card indirect">
        <div class="amount">${fmt(indirect)}</div>
        <div class="label">🔍 Biaya Tidak Langsung (${multiplier}x)<br><small>${fmtFull(indirect)}</small></div>
      </div>
    </div>

    <div class="iceberg">
      <div class="iceberg-title">🧊 Teori Gunung Es Biaya Kecelakaan</div>
      <div class="ice-above">Di Atas Air (Terlihat): Biaya Langsung = ${fmt(direct)}<br>Medis, kompensasi, kerusakan terlihat</div>
      <div class="ice-below">Di Bawah Air (Tersembunyi): Biaya Tidak Langsung = ${fmt(indirect)}<br>Kehilangan produktivitas · Waktu investigasi · Pelatihan pengganti · Dampak moral · Denda · Reputasi</div>
    </div>

    <div class="roi-box">
      <h4>📈 ROI Program K3</h4>
      <p>Jika pelatihan K3 mencegah 1 kecelakaan seperti ini, maka program K3 dengan biaya Rp 5-50 juta menghasilkan ROI <strong>${Math.round(total / 25000000 * 100)}x-${Math.round(total / 5000000 * 100)}x lipat.</strong></p>
      <p style="margin-top:8px">Total kerugian <strong>${fmtFull(total)}</strong> ini bisa dicegah dengan investasi K3 yang jauh lebih kecil.</p>
    </div>

    <button onclick="window.print()" style="width:100%;background:var(--primary);color:#fff;border:none;border-radius:8px;padding:11px;font-size:.88rem;font-weight:600;cursor:pointer">🖨 Cetak / Simpan PDF</button>
  `;
}
</script>
</body>
</html>
