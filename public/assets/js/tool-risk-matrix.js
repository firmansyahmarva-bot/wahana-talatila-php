/* Restored from the original tools/risk-matrix.php in origin/main. */

let curL = 3;
let curC = 3;

const matrixDefinitions = {
  // Score mapping: L x C
  getScore: (l, c) => l * c,
  getLevel: (score) => {
    if(score >= 15) return { cat: 'EKSTREM (EXTREME RISK)', cls: 'cell-ext', time: 'Hentikan pekerjaan seketika! Tindakan segera wajib.', text: 'Pekerjaan dilarang dimulai atau dilanjutkan. Sumber bahaya wajib diisolasi atau dieliminasi segera. Diperlukan otorisasi level Direksi untuk melanjutkan.' };
    if(score >= 10) return { cat: 'TINGGI (HIGH RISK)', cls: 'cell-high', time: 'Mitigasi wajib diterapkan dalam 24 jam kerja.', text: 'Diperlukan tindakan mitigasi spesifik, Izin Kerja Khusus (PTW), instruksi kerja ketat, dan supervisi langsung oleh HSE Officer.' };
    if(score >= 5)  return { cat: 'SEDANG (MEDIUM RISK)', cls: 'cell-med', time: 'Mitigasi diperlukan dalam 7 hari kerja.', text: 'Pekerjaan dapat dijalankan dengan pengawasan supervisor dan kepatuhan terhadap SOP operasional serta kelengkapan APD standar.' };
    return { cat: 'RENDAH (LOW RISK)', cls: 'cell-low', time: 'Tinjauan rutin saat inspeksi berkala.', text: 'Risiko dapat diterima secara luas (Broadly Acceptable). Lakukan pemantauan berkala dan pastikan pekerja memahami dasar keselamatan kerja.' };
  }
};

let riskRegister = [
  { activity: "Pengelasan pipa di atas perancah ketinggian 6 meter", l: 4, c: 4, score: 16, cat: "EKSTREM", control: "Pasang Full Body Harness 100% tie-off, fire blanket, & fire watch standby" },
  { activity: "Pengoperasian forklift di area lorong gudang bahan baku", l: 3, c: 3, score: 9, cat: "SEDANG", control: "Marka jalur pejalan kaki, batas kecepatan 10 km/jam, klakson blind spot" },
  { activity: "Penyusunan kardus arsip dokumen di lemari kantor", l: 2, c: 1, score: 2, cat: "RENDAH", control: "Gunakan tangga pijak step stool berkaki karet stabil" }
];

function initMatrix(){
  const grid = document.getElementById('matrixGrid');
  grid.innerHTML = '';

  // Top labels (Consequence 1 to 5)
  const headerX = document.createElement('div');
  headerX.className = 'matrix-header-x';
  headerX.textContent = 'KEPARAHAN DAMPAK (CONSEQUENCE) →';
  grid.appendChild(headerX);

  // Rows from L=5 down to L=1
  const lLabels = {
    5: '5 - Hampir Pasti',
    4: '4 - Sering',
    3: '3 - Mungkin',
    2: '2 - Jarang',
    1: '1 - S. Jarang'
  };

  for(let l = 5; l >= 1; l--){
    const yHeader = document.createElement('div');
    yHeader.className = 'matrix-header-y';
    yHeader.textContent = lLabels[l];
    grid.appendChild(yHeader);

    for(let c = 1; c <= 5; c++){
      const score = l * c;
      const info = matrixDefinitions.getLevel(score);
      const cell = document.createElement('div');
      cell.className = `matrix-cell ${info.cls}`;
      cell.id = `cell-${l}-${c}`;
      cell.innerHTML = `<span>${score}</span><small>L${l}xC${c}</small>`;
      cell.onclick = () => selectCell(l, c);
      grid.appendChild(cell);
    }
  }

  updateSelection();
  renderRiskRegister();
}

function selectCell(l, c){
  curL = l;
  curC = c;
  document.getElementById('selL').value = l;
  document.getElementById('selC').value = c;
  updateSelection();
}

function onSelectChange(){
  curL = parseInt(document.getElementById('selL').value);
  curC = parseInt(document.getElementById('selC').value);
  updateSelection();
}

function updateSelection(){
  document.querySelectorAll('.matrix-cell').forEach(c => c.classList.remove('selected'));
  const activeCell = document.getElementById(`cell-${curL}-${curC}`);
  if(activeCell) activeCell.classList.add('selected');

  const score = curL * curC;
  const info = matrixDefinitions.getLevel(score);

  const numEl = document.getElementById('scoreNum');
  numEl.textContent = score;
  numEl.className = `score-badge ${info.cls}`;

  const catEl = document.getElementById('scoreCat');
  catEl.textContent = info.cat;

  document.getElementById('scoreTime').textContent = info.time;
  document.getElementById('actionGuide').textContent = info.text;

  // Labels
  document.getElementById('labelL').textContent = `Tingkat ${curL}`;
  document.getElementById('labelC').textContent = `Tingkat ${curC}`;
}

function addToRiskRegister(){
  const act = document.getElementById('regActivity').value.trim();
  const ctrl = document.getElementById('regControl').value.trim();
  if(!act || !ctrl){
    alert('Mohon isi nama aktivitas dan rencana tindakan pengendalian!');
    return;
  }

  const score = curL * curC;
  const info = matrixDefinitions.getLevel(score);

  riskRegister.push({
    activity: act,
    l: curL,
    c: curC,
    score: score,
    cat: info.cat.split(' ')[0],
    control: ctrl
  });

  document.getElementById('regActivity').value = '';
  document.getElementById('regControl').value = '';
  renderRiskRegister();
}

function deleteRegItem(idx){
  riskRegister.splice(idx, 1);
  renderRiskRegister();
}

function renderRiskRegister(){
  const tbody = document.getElementById('regBody');
  tbody.innerHTML = '';

  riskRegister.forEach((item, idx) => {
    const info = matrixDefinitions.getLevel(item.score);
    const tr = document.createElement('tr');
    tr.innerHTML = `
      <td style="text-align:center;font-weight:bold;color:var(--slate-600)">${idx + 1}</td>
      <td><strong>${escapeHtml(item.activity)}</strong></td>
      <td style="text-align:center">${item.l}</td>
      <td style="text-align:center">${item.c}</td>
      <td style="text-align:center;font-weight:bold">${item.score}</td>
      <td style="text-align:center"><span style="padding:2px 8px;border-radius:4px;font-size:0.75rem;font-weight:bold" class="${info.cls}">${item.cat}</span></td>
      <td>${escapeHtml(item.control)}</td>
      <td style="text-align:center">
        <button style="border:none;background:#FEE2E2;color:#991B1B;padding:2px 8px;border-radius:4px;cursor:pointer;font-weight:bold" onclick="deleteRegItem(${idx})">✕</button>
      </td>
    `;
    tbody.appendChild(tr);
  });
}

function escapeHtml(text){
  return String(text).replace(/[&<>"']/g, function(m){
    return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m];
  });
}

function printRiskRegister(){
  const win = window.open('', '_blank');
  win.document.write(`<!DOCTYPE html><html><head><title>Risk Register K3 - ISO 31000</title>
  <style>
    body{font-family:'Segoe UI',Arial,sans-serif;padding:32px;max-width:860px;margin:0 auto;color:#0F172A;line-height:1.5}
    h1{font-size:16pt;margin:0;color:#0D233A;border-bottom:2px solid #0D233A;padding-bottom:8px}
    .sub{font-size:8.5pt;color:#64748B;margin:6px 0 16px}
    table{width:100%;border-collapse:collapse;margin-top:12px;font-size:9pt}
    th,td{border:1px solid #CBD5E1;padding:8px 10px;text-align:left}
    th{background:#F1F5F9;color:#0D233A}
    .sig{margin-top:40px;display:grid;grid-template-columns:1fr 1fr;gap:40px;text-align:center;font-size:9pt}
    .line{margin-top:60px;border-top:1px solid #000;font-weight:bold}
  </style>
  </head><body>
  <h1>DOKUMEN RISK REGISTER K3 (HIRARC)</h1>
  <div class="sub">Berdasarkan Standar Evaluasi Matriks 5x5 ISO 31000:2018 &amp; SMK3 PP 50/2012</div>
  <table>
    <thead>
      <tr>
        <th style="width:30px">No</th>
        <th>Aktivitas Kerja / Potensi Bahaya</th>
        <th style="width:40px">L</th>
        <th style="width:40px">C</th>
        <th style="width:50px">Skor</th>
        <th style="width:90px">Level</th>
        <th>Rencana Tindakan Pengendalian</th>
      </tr>
    </thead>
    <tbody>
      ${riskRegister.map((r, i) => `
        <tr>
          <td style="text-align:center">${i+1}</td>
          <td><strong>${escapeHtml(r.activity)}</strong></td>
          <td style="text-align:center">${r.l}</td>
          <td style="text-align:center">${r.c}</td>
          <td style="text-align:center"><strong>${r.score}</strong></td>
          <td style="text-align:center">${r.cat}</td>
          <td>${escapeHtml(r.control)}</td>
        </tr>
      `).join('')}
    </tbody>
  </table>
  <div class="sig">
    <div>Divalidasi oleh,<br><strong>Ahli K3 Umum / HSE Manager</strong><div class="line">( ___________________________ )</div></div>
    <div>Disetujui oleh,<br><strong>General Manager / Kepala Operasi</strong><div class="line">( ___________________________ )</div></div>
  </div>
  </body></html>`);
  win.document.close();
  win.print();
}

function toggleFaq(btn){
  btn.parentElement.classList.toggle('active');
}

window.addEventListener('DOMContentLoaded', initMatrix);
