<?php
require_once __DIR__ . '/../config.php';
$s = get_all_settings();
?>
<?php
$page_title = 'Kalkulator Paparan Kebisingan Online Gratis — NAB Kebisingan K3';
$meta_desc = 'Kalkulator paparan kebisingan online gratis. Hitung dosis paparan berdasarkan tingkat dB dan jam kerja. Bandingkan dengan NAB Permenaker No.5/2018 (85 dB/8 jam). Gratis untuk HSE officer.';
require __DIR__ . '/../includes/head.php';
?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "SoftwareApplication",
  "applicationCategory": "BusinessApplication",
  "name": "Kalkulator Paparan Kebisingan Online Gratis — NAB Kebisingan K3",
  "description": "Kalkulator paparan kebisingan online gratis. Hitung dosis paparan berdasarkan tingkat dB dan jam kerja. Bandingkan dengan NAB Permenaker No.5/2018 (85 dB/8 jam). Gratis untuk HSE officer.",
  "url": "https://wahanatotalita.com/tools/kalkulator-kebisingan/",
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
.container{max-width:920px;margin:0 auto;padding:0 20px}
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
.form-group input,.form-group select{width:100%;padding:9px 13px;border:2px solid #e5e7eb;border-radius:7px;font-size:.88rem;background:#fff;color:var(--text)}
.form-group input:focus,.form-group select:focus{border-color:var(--primary);outline:none}
.expo-table{width:100%;border-collapse:collapse;margin-bottom:12px}
.expo-table th{background:#f3f4f6;padding:8px 10px;text-align:left;font-size:.8rem;font-weight:600;color:var(--muted)}
.expo-table td{padding:8px;border-bottom:1px solid #f3f4f6;vertical-align:middle}
.expo-table td input{width:100%;border:1px solid #e5e7eb;border-radius:5px;padding:6px;font-size:.85rem;background:#fff}
.btn-add{background:#f0fdf4;color:var(--primary);border:2px dashed #86efac;border-radius:7px;padding:9px;width:100%;font-size:.85rem;font-weight:600;cursor:pointer;margin-bottom:14px}
.btn-add:hover{background:#dcfce7}
.btn-del{background:#fee2e2;color:#dc2626;border:none;border-radius:4px;padding:4px 8px;cursor:pointer;font-size:.78rem}
.btn-calc{width:100%;background:var(--primary);color:#fff;border:none;border-radius:9px;padding:13px;font-size:.95rem;font-weight:700;cursor:pointer}
.btn-calc:hover{background:var(--primary-d)}
/* RESULT */
.result-panel{display:none}
.result-panel.show{display:block}
.dose-meter{background:#f9fafb;border-radius:12px;padding:20px;text-align:center;margin-bottom:16px;border:2px solid #e5e7eb}
.dose-meter.safe{border-color:#16a34a;background:#f0fdf4}
.dose-meter.warn{border-color:#d97706;background:#fffbeb}
.dose-meter.danger{border-color:#dc2626;background:#fef2f2}
.dose-value{font-size:3rem;font-weight:900;line-height:1}
.dose-label{font-size:.85rem;color:var(--muted);margin-top:4px}
.dose-verdict{font-size:1rem;font-weight:700;margin-top:12px;padding:8px 16px;border-radius:50px;display:inline-block}
.verdict-safe{background:#dcfce7;color:#16a34a}
.verdict-warn{background:#fef3c7;color:#d97706}
.verdict-danger{background:#fee2e2;color:#dc2626}
.result-detail{display:flex;flex-direction:column;gap:10px}
.result-row{display:flex;justify-content:space-between;align-items:center;padding:10px 14px;background:#f9fafb;border-radius:8px;font-size:.85rem}
.result-row strong{font-weight:700}
.nab-table{width:100%;border-collapse:collapse;font-size:.82rem;margin-top:20px}
.nab-table th{background:var(--primary);color:#fff;padding:9px 12px;text-align:left;font-size:.78rem}
.nab-table td{padding:8px 12px;border-bottom:1px solid #f3f4f6}
.nab-table tr:hover td{background:#f9fafb}
.info-box{background:#f0fdf4;border-left:4px solid var(--primary);border-radius:8px;padding:16px 20px;margin-top:20px}
.info-box h4{font-size:.9rem;font-weight:700;color:var(--primary);margin-bottom:8px}
.info-box p,.info-box li{font-size:.82rem;color:#374151;line-height:1.6}
.info-box ul{padding-left:16px}
.cta-strip{background:var(--primary);color:#fff;border-radius:12px;padding:24px;text-align:center;margin:36px 0}
.cta-strip h3{font-size:1rem;font-weight:700;margin-bottom:8px}
.cta-strip p{opacity:.88;font-size:.85rem;margin-bottom:14px}
footer{background:#111827;color:#9ca3af;padding:30px 0;text-align:center;font-size:.83rem}
footer a{color:#6ee7b7}
@media(max-width:768px){.layout{grid-template-columns:1fr}}
@media print{nav,footer,.cta-strip,.tools-training-cta,.btn-calc,.btn-add{display:none!important}}
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
    <a href="https://wa.me/6287759151278" target="_blank" class="nav-cta">📱 Konsultasi</a>
  </div>
</nav>

<section class="hero">
  <div class="container">
    <div class="hero-badge">🔊 Kalkulator Kebisingan</div>
    <h1>Kalkulator Paparan <span>Kebisingan</span><br>NAB Sesuai Permenaker 5/2018</h1>
    <p>Hitung dosis paparan kebisingan kumulatif dan bandingkan dengan Nilai Ambang Batas (NAB) Indonesia. Gratis, langsung pakai.</p>
  </div>
</section>

<section class="main">
  <div class="container">
    <div class="layout">
      <div>
        <div class="panel">
          <h2>🔊 Input Data Paparan Kebisingan</h2>
          <p style="font-size:.82rem;color:var(--muted);margin-bottom:16px">Tambahkan setiap sumber kebisingan dengan tingkat dB dan durasi paparan per hari kerja.</p>

          <table class="expo-table">
            <thead>
              <tr>
                <th>Sumber Kebisingan</th>
                <th style="width:80px">dB(A)</th>
                <th style="width:70px">Jam/Hari</th>
                <th style="width:40px"></th>
              </tr>
            </thead>
            <tbody id="noiseBody"></tbody>
          </table>
          <button class="btn-add" onclick="addNoiseRow()">+ Tambah Sumber Kebisingan</button>

          <div class="form-group">
            <label>Nama Pekerja / Area (opsional)</label>
            <input type="text" id="workerName" placeholder="cth: Operator Mesin Produksi, Area A">
          </div>
          <div class="form-group">
            <label>Jam Kerja per Hari</label>
            <select id="workHours">
              <option value="8" selected>8 jam (standar)</option>
              <option value="10">10 jam</option>
              <option value="12">12 jam</option>
            </select>
          </div>
          <button class="btn-calc" onclick="calculate()">🔊 Hitung Dosis Paparan</button>
        </div>

        <div class="info-box">
          <h4>📏 Tabel NAB Kebisingan Indonesia (Permenaker 5/2018)</h4>
          <table class="nab-table">
            <thead><tr><th>Tingkat Kebisingan</th><th>Durasi Maks/Hari</th></tr></thead>
            <tbody>
              <tr><td>85 dB(A)</td><td>8 jam</td></tr>
              <tr><td>88 dB(A)</td><td>4 jam</td></tr>
              <tr><td>91 dB(A)</td><td>2 jam</td></tr>
              <tr><td>94 dB(A)</td><td>1 jam</td></tr>
              <tr><td>97 dB(A)</td><td>30 menit</td></tr>
              <tr><td>100 dB(A)</td><td>15 menit</td></tr>
              <tr><td>103 dB(A)</td><td>7.5 menit</td></tr>
              <tr><td>≥ 140 dB(A)</td><td>Sesaat (impulsif)</td></tr>
            </tbody>
          </table>
          <p style="margin-top:10px;font-size:.78rem">NAB = Nilai Ambang Batas. Paparan di atas NAB wajib dilengkapi Hearing Protection Device (HPD) dan program Hearing Conservation.</p>
        </div>
      </div>

      <div>
        <div class="result-panel" id="resultPanel">
          <!-- filled by JS -->
        </div>
        <div id="placeholder" style="background:var(--card);border-radius:var(--radius);padding:50px 24px;text-align:center;color:var(--muted);box-shadow:var(--shadow);border:1px solid #e5e7eb">
          <div style="font-size:3rem;margin-bottom:12px">🔊</div>
          <p>Tambahkan sumber kebisingan dan klik <strong>Hitung</strong> untuk melihat dosis paparan dan status NAB</p>
        </div>

        <div class="info-box" style="margin-top:20px">
          <h4>💡 Cara Mengurangi Paparan Kebisingan (Hierarki Pengendalian)</h4>
          <ul>
            <li><strong>Eliminasi:</strong> hentikan sumber kebisingan jika tidak esensial</li>
            <li><strong>Substitusi:</strong> ganti mesin bising dengan yang lebih senyap</li>
            <li><strong>Engineering:</strong> buat enclosure, peredam suara, insulasi getaran</li>
            <li><strong>Administratif:</strong> rotasi kerja, kurangi jam paparan</li>
            <li><strong>APD:</strong> Ear Plug (SNR ~27dB) atau Ear Muff (SNR ~30dB)</li>
          </ul>
        </div>

        <div class="cta-strip">
          <h3>🎓 Pelajari Higiene Industri & K3 Kesehatan Kerja</h3>
          <p>Sertifikasi HSE Officer mencakup pengukuran NAB, higiene industri, dan program Hearing Conservation sesuai Permenaker 5/2018.</p>
          <a href="https://wa.me/6287759151278?text=Halo%20Wahana%2C%20saya%20pakai%20kalkulator%20kebisingan%20dan%20ingin%20tanya%20pelatihan%20HSE%20Officer" target="_blank" rel="noopener"
             style="background:#25D366;color:#fff;padding:11px 24px;border-radius:8px;font-weight:700;display:inline-flex;align-items:center;gap:8px">
            📱 Tanya Pelatihan HSE Officer
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

<a href="https://wa.me/6287759151278" target="_blank" style="position:fixed;bottom:24px;right:24px;background:#25D366;width:52px;height:52px;border-radius:50%;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 14px rgba(37,211,102,.4);z-index:999">
  <svg viewBox="0 0 24 24" fill="white" width="26" height="26"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
</a>

<script>
let noiseCount = 0;

// NAB durations based on Permenaker 5/2018 (OSHA formula: T = 8/(2^((L-85)/3)))
function getNABDuration(dB){
  if(dB < 85) return 999; // no limit
  return 8 / Math.pow(2, (dB - 85) / 3);
}

function addNoiseRow(){
  noiseCount++;
  const tbody = document.getElementById('noiseBody');
  const tr = document.createElement('tr');
  tr.id = `nr-${noiseCount}`;
  tr.innerHTML = `
    <td><input type="text" placeholder="cth: Mesin CNC" id="ns-${noiseCount}"></td>
    <td><input type="number" placeholder="85" min="0" max="200" id="nd-${noiseCount}" oninput="calcRow(${noiseCount})"></td>
    <td><input type="number" placeholder="8" min="0" max="24" step="0.5" id="nh-${noiseCount}" oninput="calcRow(${noiseCount})"></td>
    <td><button class="btn-del" onclick="delNoise(${noiseCount})">✕</button></td>
  `;
  tbody.appendChild(tr);
}

function delNoise(n){
  const el = document.getElementById(`nr-${n}`);
  if(el) el.remove();
}

function calcRow(n){}

function calculate(){
  const rows = document.querySelectorAll('#noiseBody tr');
  if(!rows.length){ alert('Tambahkan minimal satu sumber kebisingan'); return; }

  let dose = 0;
  let details = [];

  rows.forEach(tr=>{
    const idMatch = tr.id.match(/nr-(\d+)/);
    if(!idMatch) return;
    const n = idMatch[1];
    const src = document.getElementById(`ns-${n}`)?.value || `Sumber ${n}`;
    const dB  = parseFloat(document.getElementById(`nd-${n}`)?.value || 0);
    const hrs = parseFloat(document.getElementById(`nh-${n}`)?.value || 0);
    if(!dB || !hrs) return;

    const T = getNABDuration(dB); // allowed hours
    const contribution = hrs / T;
    dose += contribution;
    details.push({src, dB, hrs, T, contribution});
  });

  const dosePercent = dose * 100;
  const status = dose < 0.5 ? 'safe' : dose < 1.0 ? 'warn' : 'danger';
  const statusText = dose < 0.5 ? '✅ Aman' : dose < 1.0 ? '⚠️ Mendekati Batas' : '⛔ Melebihi NAB!';
  const statusBadge = dose < 0.5 ? 'verdict-safe' : dose < 1.0 ? 'verdict-warn' : 'verdict-danger';

  const rec = dose >= 1.0
    ? '<li><strong>Wajib gunakan APD kebisingan (Ear Plug/Ear Muff)</strong></li><li>Evaluasi engineering control (enclosure, peredam)</li><li>Kurangi jam paparan / rotasi pekerja</li><li>Lakukan audiometri berkala untuk pekerja terdampak</li>'
    : dose >= 0.5
    ? '<li>Pertimbangkan penggunaan Ear Plug sebagai tindakan preventif</li><li>Monitor secara berkala — masih dalam batas tapi mendekati</li><li>Lakukan pengukuran NAB ulang secara periodik</li>'
    : '<li>Paparan masih dalam batas aman</li><li>Tetap pertahankan kondisi ini</li><li>Lakukan pengukuran berkala setiap 6 bulan</li>';

  document.getElementById('placeholder').style.display = 'none';
  const panel = document.getElementById('resultPanel');
  panel.className = 'result-panel show';
  panel.innerHTML = `
    <div class="panel">
      <h2>📊 Hasil Perhitungan Dosis Paparan</h2>
      <div class="dose-meter ${status}">
        <div class="dose-value">${dosePercent.toFixed(1)}%</div>
        <div class="dose-label">Dosis Paparan Kumulatif (NAB = 100%)</div>
        <div class="dose-verdict ${statusBadge}">${statusText}</div>
      </div>

      <div class="result-detail">
        ${details.map(d=>`
          <div class="result-row">
            <span><strong>${d.src}</strong> — ${d.dB} dB(A) × ${d.hrs} jam</span>
            <span style="color:${d.contribution>=1?'#dc2626':d.contribution>=0.5?'#d97706':'#16a34a'};font-weight:700">${(d.contribution*100).toFixed(1)}%</span>
          </div>
        `).join('')}
      </div>

      <div style="background:#f9fafb;border-radius:8px;padding:14px;margin-top:14px;font-size:.82rem">
        <strong>Formula:</strong> Dosis = Σ(C₁/T₁ + C₂/T₂ + ...) × 100%<br>
        C = durasi paparan aktual | T = durasi maksimal yang diperbolehkan (NAB)<br>
        <strong>Referensi:</strong> Permenaker No.5 Tahun 2018 tentang K3 Lingkungan Kerja
      </div>

      <div style="background:#f0fdf4;border-left:4px solid var(--primary);border-radius:8px;padding:14px;margin-top:14px">
        <strong style="font-size:.88rem;color:var(--primary)">Rekomendasi Tindakan:</strong>
        <ul style="padding-left:16px;margin-top:8px;font-size:.82rem;line-height:1.7">
          ${rec}
        </ul>
      </div>

      <button onclick="window.print()" style="width:100%;background:var(--primary);color:#fff;border:none;border-radius:8px;padding:11px;font-size:.88rem;font-weight:600;cursor:pointer;margin-top:14px">🖨 Cetak Laporan</button>
    </div>
  `;
}

// Init 2 rows
addNoiseRow(); addNoiseRow();
// Pre-fill example
document.getElementById('nd-1').value = 88;
document.getElementById('nh-1').value = 6;
document.getElementById('ns-1').value = 'Mesin Press';
document.getElementById('nd-2').value = 92;
document.getElementById('nh-2').value = 2;
document.getElementById('ns-2').value = 'Kompresor';
</script>
</body>
</html>
