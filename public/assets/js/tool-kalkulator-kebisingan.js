/* Restored from the original tools/kalkulator-kebisingan.php in origin/main. */

let noiseRows = [
  { area: "Ruang Genset / Kompresor", dba: 91, hours: 1.5 },
  { area: "Lantai Produksi Mesin Stamping", dba: 88, hours: 3.0 },
  { area: "Ruang Kontrol / Office", dba: 70, hours: 3.5 }
];

// Reference T for Permenaker 5/2018 (3dB exchange rate, 85dB = 8h)
function getAllowedTime(dba){
  if(dba <= 80) return 24;
  return 8 / Math.pow(2, (dba - 85) / 3);
}

function initNoiseTable(){
  const tbody = document.getElementById('noiseBody');
  tbody.innerHTML = '';

  noiseRows.forEach((r, idx) => {
    const tAllowed = getAllowedTime(r.dba);
    const tr = document.createElement('tr');
    tr.innerHTML = `
      <td><input type="text" class="noise-input" value="${escapeHtml(r.area)}" onchange="updateNoiseRow(${idx}, 'area', this.value)"></td>
      <td><input type="number" class="noise-input" value="${r.dba}" min="50" max="140" oninput="updateNoiseRow(${idx}, 'dba', this.value)"></td>
      <td><input type="number" class="noise-input" value="${r.hours}" min="0" max="24" step="0.25" oninput="updateNoiseRow(${idx}, 'hours', this.value)"></td>
      <td style="font-weight:bold;color:var(--navy)">${formatHours(tAllowed)}</td>
      <td style="text-align:center">
        <button style="border:none;background:#FEE2E2;color:#991B1B;padding:4px 8px;border-radius:4px;cursor:pointer;font-weight:bold" onclick="delNoiseRow(${idx})">✕</button>
      </td>
    `;
    tbody.appendChild(tr);
  });

  calcNoise();
}

function updateNoiseRow(idx, field, val){
  if(noiseRows[idx]){
    noiseRows[idx][field] = field === 'area' ? val : parseFloat(val) || 0;
    initNoiseTable();
  }
}

function addNoiseRow(){
  noiseRows.push({ area: "Area Kerja Baru", dba: 85, hours: 2 });
  initNoiseTable();
}

function delNoiseRow(idx){
  if(noiseRows.length <= 1){
    alert('Minimal harus ada 1 sumber kebisingan!');
    return;
  }
  noiseRows.splice(idx, 1);
  initNoiseTable();
}

function formatHours(h){
  if(h >= 24) return "> 24 Jam";
  if(h >= 1) return h.toFixed(2) + " Jam";
  const mins = h * 60;
  if(mins >= 1) return mins.toFixed(1) + " Menit";
  return (mins * 60).toFixed(0) + " Detik";
}

function calcNoise(){
  let totalDose = 0;
  let maxDba = 0;

  noiseRows.forEach(r => {
    const tAllowed = getAllowedTime(r.dba);
    if(tAllowed > 0){
      totalDose += (r.hours / tAllowed);
    }
    if(r.dba > maxDba) maxDba = r.dba;
  });

  const dosePercent = totalDose * 100;

  // Equivalent TWA 8h
  let twa = 0;
  if(totalDose > 0){
    twa = 16.61 * Math.log10(totalDose) + 85;
  } else {
    twa = 0;
  }

  // APD Derating
  const hpdType = document.getElementById('hpdType').value;
  const nrr = parseFloat(document.getElementById('hpdNrr').value) || 0;
  let prot = 0;

  if(hpdType === 'plug'){
    prot = Math.max(0, (nrr - 7) * 0.5);
  } else if(hpdType === 'muff'){
    prot = Math.max(0, (nrr - 7) * 0.7);
  } else if(hpdType === 'dual'){
    prot = Math.max(0, (nrr - 7) * 0.7) + 5;
  }

  const atEar = Math.max(0, maxDba - prot);

  document.getElementById('outDose').textContent = dosePercent.toFixed(1) + '%';
  document.getElementById('outTwa').textContent = twa.toFixed(1) + ' dBA';
  document.getElementById('outHpdProt').textContent = prot.toFixed(1) + ' dBA';
  document.getElementById('outAtEar').textContent = atEar.toFixed(1) + ' dBA';

  const badge = document.getElementById('statusBadge');
  const txt = document.getElementById('statusText');
  const icon = document.getElementById('statusIcon');
  const reco = document.getElementById('rekomendasiList');

  if(dosePercent > 100 || twa > 85){
    badge.className = 'status-box status-danger';
    icon.textContent = '⚠️';
    txt.textContent = 'BAHAYA: Dosis paparan kebisingan MELAMPAUI Nilai Ambang Batas (NAB)!';
    reco.innerHTML = `
      <li>Wajib pasang rambu peringatan kewajiban APD pendengaran (Hearing Protection Zone).</li>
      <li>Terapkan pengendalian teknis (enclosure mesin bising, isolasi getaran, silencer).</li>
      <li>Batasi waktu kerja / rotasi tenaga kerja agar dosis harian di bawah 100%.</li>
      <li>Lakukan pemeriksaan audiometri berkala setiap tahun bagi pekerja terpapar.</li>
    `;
  } else if(dosePercent > 50 || twa >= 82){
    badge.className = 'status-box status-warn';
    icon.textContent = '⚡';
    txt.textContent = 'WASPADA: Paparan mendekati batas NAB (Action Level > 82 dBA).';
    reco.innerHTML = `
      <li>Sediakan APD penutup telinga dan pastikan dipakai dengan benar.</li>
      <li>Lakukan pemeliharaan rutin pada mesin untuk mengurangi getaran suara.</li>
      <li>Lakukan monitoring lingkungan kerja secara periodik.</li>
    `;
  } else {
    badge.className = 'status-box status-safe';
    icon.textContent = '✓';
    txt.textContent = 'AMAN: Paparan kebisingan berada di bawah Nilai Ambang Batas (NAB).';
    reco.innerHTML = `
      <li>Tingkat kebisingan aman untuk shift kerja standar 8 jam/hari.</li>
      <li>Pertahankan pemeliharaan mesin secara berkala.</li>
    `;
  }
}

function escapeHtml(text){
  return String(text).replace(/[&<>"']/g, function(m){
    return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m];
  });
}

function printNoiseReport(){
  const dose = document.getElementById('outDose').textContent;
  const twa = document.getElementById('outTwa').textContent;
  const prot = document.getElementById('outHpdProt').textContent;
  const atEar = document.getElementById('outAtEar').textContent;

  const win = window.open('', '_blank');
  win.document.write(`<!DOCTYPE html><html><head><title>Laporan Penilaian Paparan Kebisingan</title>
  <style>
    body{font-family:'Segoe UI',Arial,sans-serif;padding:32px;max-width:760px;margin:0 auto;color:#0F172A;line-height:1.5}
    h1{font-size:16pt;margin:0;color:#0D233A;border-bottom:2px solid #0D233A;padding-bottom:8px}
    .sub{font-size:8.5pt;color:#64748B;margin:6px 0 16px}
    table{width:100%;border-collapse:collapse;margin:16px 0;font-size:9pt}
    th,td{border:1px solid #CBD5E1;padding:8px 10px;text-align:left}
    th{background:#F1F5F9;color:#0D233A}
    .sig{margin-top:40px;display:grid;grid-template-columns:1fr 1fr;gap:40px;text-align:center;font-size:9pt}
    .line{margin-top:60px;border-top:1px solid #000;font-weight:bold}
  </style>
  </head><body>
  <h1>LAPORAN EVALUASI PAPARAN KEBISINGAN TEMPAT KERJA</h1>
  <div class="sub">Standar Permenaker RI No. 5 Tahun 2018 tentang K3 Lingkungan Kerja</div>
  <table>
    <tr><th>Area / Sumber Mesin</th><th>Tingkat Bising (dBA)</th><th>Durasi Paparan</th><th>Batas Waktu Izin</th></tr>
    ${noiseRows.map(r => `<tr><td>${escapeHtml(r.area)}</td><td>${r.dba} dBA</td><td>${r.hours} Jam</td><td>${formatHours(getAllowedTime(r.dba))}</td></tr>`).join('')}
  </table>
  <h3>Hasil Evaluasi Kumulatif:</h3>
  <table>
    <tr><td>Total Dosis Paparan Kebisingan (D)</td><td><strong>${dose}</strong></td></tr>
    <tr><td>Time-Weighted Average 8-Jam (TWA)</td><td><strong>${twa}</strong></td></tr>
    <tr><td>Proteksi Riil APD (NRR Derated)</td><td><strong>${prot}</strong></td></tr>
    <tr><td>Tingkat Kebisingan Efektif di Telinga</td><td><strong>${atEar}</strong></td></tr>
  </table>
  <div class="sig">
    <div>Diperiksa oleh,<br><strong>Ahli K3 Lingkungan Kerja</strong><div class="line">( ___________________________ )</div></div>
    <div>Mengetahui,<br><strong>Pimpinan Pabrik / HSE Manager</strong><div class="line">( ___________________________ )</div></div>
  </div>
  </body></html>`);
  win.document.close();
  win.print();
}

function toggleFaq(btn){
  btn.parentElement.classList.toggle('active');
}

window.addEventListener('DOMContentLoaded', initNoiseTable);
