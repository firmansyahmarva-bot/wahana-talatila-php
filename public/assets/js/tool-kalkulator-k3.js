/* Restored from the original tools/kalkulator-k3.php in origin/main. */

let currentMultiplier = 1000000;

const presets = {
  manufaktur: { workers: 150, hours: 312000, lti: 2, days: 14, nonLti: 5, nearMiss: 28, frPast: 9.6, hoursPast: 300000 },
  konstruksi: { workers: 300, hours: 624000, lti: 4, days: 38, nonLti: 12, nearMiss: 64, frPast: 7.2, hoursPast: 600000 },
  migas:       { workers: 500, hours: 1040000, lti: 0, days: 0, nonLti: 3, nearMiss: 110, frPast: 1.1, hoursPast: 1000000 },
  gudang:      { workers: 80,  hours: 166400, lti: 1, days: 6, nonLti: 4, nearMiss: 19, frPast: 5.8, hoursPast: 160000 }
};

function loadPreset(key){
  const p = presets[key];
  if(!p) return;
  document.querySelectorAll('.preset-pills .pill-btn').forEach(btn => btn.classList.remove('active'));
  [...document.querySelectorAll('[onclick]')].find(button => button.getAttribute('onclick') === `loadPreset('${key}')`)?.classList.add('active');

  document.getElementById('inpJumlahPekerja').value = p.workers;
  document.getElementById('inpJamKerjaOrang').value = p.hours;
  document.getElementById('inpJumlahKasusLTI').value = p.lti;
  document.getElementById('inpHariHilang').value = p.days;
  document.getElementById('inpKasusNonLTI').value = p.nonLti;
  document.getElementById('inpNearMiss').value = p.nearMiss;
  document.getElementById('inpFrLalu').value = p.frPast;
  document.getElementById('inpHoursLalu').value = p.hoursPast;
  calculateK3();
}

function setMultiplier(val){
  currentMultiplier = val;
  document.getElementById('btnKemnaker').classList.toggle('active', val === 1000000);
  document.getElementById('btnOsha').classList.toggle('active', val === 200000);
  document.getElementById('labelBasis').textContent = val === 1000000 ? 'Basis: 1.000.000 Jam' : 'Basis: 200.000 Jam';
  calculateK3();
}

function resetForm(){
  document.getElementById('inpJumlahPekerja').value = 100;
  document.getElementById('inpJamKerjaOrang').value = 200000;
  document.getElementById('inpJumlahKasusLTI').value = 0;
  document.getElementById('inpHariHilang').value = 0;
  document.getElementById('inpKasusNonLTI').value = 0;
  document.getElementById('inpNearMiss').value = 0;
  document.getElementById('inpFrLalu').value = '';
  document.getElementById('inpHoursLalu').value = '';
  calculateK3();
}

function calculateK3(){
  const workers = parseFloat(document.getElementById('inpJumlahPekerja').value) || 1;
  const hours = parseFloat(document.getElementById('inpJamKerjaOrang').value) || 1;
  const lti = parseFloat(document.getElementById('inpJumlahKasusLTI').value) || 0;
  const days = parseFloat(document.getElementById('inpHariHilang').value) || 0;
  const nonLti = parseFloat(document.getElementById('inpKasusNonLTI').value) || 0;
  const nearMiss = parseFloat(document.getElementById('inpNearMiss').value) || 0;

  // FR & SR
  const fr = (lti * currentMultiplier) / hours;
  const sr = (days * currentMultiplier) / hours;

  // Incident Rate (% per 100 workers)
  const ir = (lti / workers) * 100;

  // Average Lost Time Rate
  const altr = lti > 0 ? (days / lti) : 0;

  document.getElementById('outFR').textContent = fr.toFixed(2);
  document.getElementById('outSR').textContent = sr.toFixed(2);
  document.getElementById('outIR').textContent = ir.toFixed(2) + '%';
  document.getElementById('outALTR').textContent = altr.toFixed(2);

  // Safe T-Score calculation
  const frPast = parseFloat(document.getElementById('inpFrLalu').value);
  const hoursPast = parseFloat(document.getElementById('inpHoursLalu').value);

  if(!isNaN(frPast) && !isNaN(hoursPast) && hoursPast > 0){
    const diff = fr - frPast;
    const denominator = Math.sqrt((frPast / hours) * currentMultiplier);
    let safeT = 0;
    if(denominator > 0){
      safeT = diff / Math.sqrt((frPast / (hours / currentMultiplier)));
    }
    const scoreVal = safeT.toFixed(2);
    document.getElementById('outSafeTScore').textContent = (safeT > 0 ? '+' : '') + scoreVal;

    const badge = document.getElementById('badgeSafeT');
    if(safeT < -2.0){
      badge.className = 'safe-t-badge safe-t-good';
      badge.textContent = 'Membaik Signifikan (Safe T-Score < -2.0)';
    } else if(safeT > 2.0){
      badge.className = 'safe-t-badge safe-t-bad';
      badge.textContent = 'Memburuk Signifikan (Safe T-Score > +2.0)';
    } else {
      badge.className = 'safe-t-badge safe-t-normal';
      badge.textContent = 'Fluktuasi Normal (-2.0 s/d +2.0)';
    }
  } else {
    document.getElementById('outSafeTScore').textContent = 'N/A';
    document.getElementById('badgeSafeT').className = 'safe-t-badge safe-t-normal';
    document.getElementById('badgeSafeT').textContent = 'Masukkan data periode lalu untuk Safe T-Score';
  }

  // Heinrich Pyramid levels
  document.getElementById('pyrFatal').textContent = '0 Kasus';
  document.getElementById('pyrLTI').textContent = `${lti} Kasus`;
  document.getElementById('pyrNonLTI').textContent = `${nonLti} Kasus`;
  document.getElementById('pyrNearMiss').textContent = `${nearMiss} Kejadian`;
}

function copyResultSummary(){
  const fr = document.getElementById('outFR').textContent;
  const sr = document.getElementById('outSR').textContent;
  const ir = document.getElementById('outIR').textContent;
  const altr = document.getElementById('outALTR').textContent;
  const basis = currentMultiplier.toLocaleString('id-ID');

  const text = `=== REKAP LAPORAN STATISTIK K3 (Wahana Totalita) ===\nBasis Multiplier: ${basis} Jam Kerja\nFrequency Rate (FR): ${fr}\nSeverity Rate (SR): ${sr}\nIncident Rate (IR): ${ir}\nAverage Lost Time (ALTR): ${altr} Hari/Kasus\nSumber Kalkulator: https://wahanatotalita.com/tools/kalkulator-k3/`;

  navigator.clipboard.writeText(text).then(()=>{
    alert('Ringkasan statistik K3 berhasil disalin ke clipboard!');
  });
}

function printOfficialReport(){
  const workers = document.getElementById('inpJumlahPekerja').value;
  const hours = document.getElementById('inpJamKerjaOrang').value;
  const lti = document.getElementById('inpJumlahKasusLTI').value;
  const days = document.getElementById('inpHariHilang').value;
  const fr = document.getElementById('outFR').textContent;
  const sr = document.getElementById('outSR').textContent;
  const ir = document.getElementById('outIR').textContent;
  const altr = document.getElementById('outALTR').textContent;
  const basis = currentMultiplier.toLocaleString('id-ID');

  const win = window.open('', '_blank');
  win.document.write(`<!DOCTYPE html><html><head><title>Laporan Statistik K3 - Rekap P2K3</title>
  <style>
    body{font-family:'Segoe UI',Arial,sans-serif;padding:32px;max-width:760px;margin:0 auto;color:#0F172A;line-height:1.6}
    .header{border-bottom:3px solid #0D233A;padding-bottom:12px;margin-bottom:20px;display:flex;justify-content:space-between;align-items:flex-end}
    h1{font-size:18pt;margin:0;color:#0D233A}
    .sub{font-size:9pt;color:#64748B}
    table{width:100%;border-collapse:collapse;margin:16px 0;font-size:10pt}
    th,td{border:1px solid #CBD5E1;padding:8px 12px;text-align:left}
    th{background:#F1F5F9;color:#0D233A}
    .badge{display:inline-block;padding:2px 8px;border-radius:4px;font-weight:bold;background:#E8611A;color:#fff;font-size:8.5pt}
    .sig-grid{display:grid;grid-template-columns:1fr 1fr;gap:40px;margin-top:40px;text-align:center}
    .sig-line{margin-top:60px;border-top:1px solid #000;font-weight:bold}
  </style>
  </head><body>
  <div class="header">
    <div>
      <h1>LEMBAR REKAPITULASI STATISTIK K3</h1>
      <div class="sub">Berdasarkan Kepmenaker No. KEP.372/MEN/1989 &amp; Format Evaluasi P2K3</div>
    </div>
    <div style="text-align:right">
      <span class="badge">RESMI P2K3</span><br>
      <span class="sub">Dicetak: ${new Date().toLocaleDateString('id-ID')}</span>
    </div>
  </div>

  <h3>I. Data Operasional &amp; Jam Kerja Orang (JKO)</h3>
  <table>
    <tr><th style="width:50%">Parameter</th><th>Nilai Tercatat</th></tr>
    <tr><td>Jumlah Tenaga Kerja Rata-rata</td><td><strong>${workers} Orang</strong></td></tr>
    <tr><td>Total Jam Kerja Orang (JKO) Selamat</td><td><strong>${Number(hours).toLocaleString('id-ID')} Jam</strong></td></tr>
    <tr><td>Kasus Kecelakaan Hilang Hari (LTI)</td><td><strong>${lti} Kasus</strong></td></tr>
    <tr><td>Total Hari Kerja Hilang (LTD)</td><td><strong>${days} Hari</strong></td></tr>
    <tr><td>Standar Pengali (Basis Multiplier)</td><td><strong>${basis} Jam Kerja</strong></td></tr>
  </table>

  <h3>II. Indikator Kinerja K3 (OHS Lagging Indicators)</h3>
  <table>
    <tr><th>Indikator Statistik</th><th>Hasil Perhitungan</th><th>Keterangan / Interpretasi</th></tr>
    <tr><td><strong>Frequency Rate (FR)</strong></td><td style="font-size:12pt;font-weight:bold;color:#E8611A">${fr}</td><td>Frekuensi LTI per unit jam kerja</td></tr>
    <tr><td><strong>Severity Rate (SR)</strong></td><td style="font-size:12pt;font-weight:bold;color:#0D233A">${sr}</td><td>Tingkat keparahan hari kerja hilang</td></tr>
    <tr><td><strong>Incident Rate (IR)</strong></td><td><strong>${ir}</strong></td><td>Persentase pekerja terkena insiden</td></tr>
    <tr><td><strong>Average Lost Time (ALTR)</strong></td><td><strong>${altr} Hari/Kasus</strong></td><td>Rata-rata hari hilang per peristiwa LTI</td></tr>
  </table>

  <div class="sig-grid">
    <div>
      Dibuat oleh,<br>
      <strong>Sekretaris P2K3 / Ahli K3 Umum</strong>
      <div class="sig-line">( _____________________________ )</div>
      No. Reg SKP: ___________________
    </div>
    <div>
      Disetujui oleh,<br>
      <strong>Ketua P2K3 / Pimpinan Perusahaan</strong>
      <div class="sig-line">( _____________________________ )</div>
      Tanggal: _______________________
    </div>
  </div>
  </body></html>`);
  win.document.close();
  win.print();
}

function toggleFaq(btn){
  const item = btn.parentElement;
  item.classList.toggle('active');
}

// Initial calculation on load
window.addEventListener('DOMContentLoaded', calculateK3);
