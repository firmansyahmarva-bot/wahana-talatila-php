/* Restored from the original tools/ibpr-generator.php in origin/main. */

const ibprTemplates = {
  manufaktur: [
    { act: "Pemotongan plat baja dengan mesin shearing hidrolik", cond: "R", hazard: "Jari tangan terjepit pisau pemotong, terkena gram tajam", l1: 4, c1: 4, score1: 16, cat1: "EXTREME", control: "Pemasangan interlock sensor otomatis, wajib sarung tangan Cut Level 5, SOP kerja mesin", l2: 2, c2: 2, score2: 4, cat2: "LOW" },
    { act: "Pembersihan tangki degreasing bahan kimia pelarut", cond: "NR", hazard: "Inhalasi uap pelarut organik beracun, dermatitis kulit", l1: 4, c1: 3, score1: 12, cat1: "HIGH", control: "Blower ventilasi hisap mekanis, respirator cartridge gas organik, sarung tangan nitril panjang", l2: 2, c2: 2, score2: 4, cat2: "LOW" },
    { act: "Pengoperasian forklift bongkar muat pallet di gudang", cond: "R", hazard: "Pekerja tertabrak forklift di persimpangan buta (blind spot)", l1: 3, c1: 4, score1: 12, cat1: "HIGH", control: "Marka jalur pejalan kaki warna hijau, cermin cembung tikungan, batas speed 10 km/jam", l2: 2, c2: 2, score2: 4, cat2: "LOW" }
  ],
  konstruksi: [
    { act: "Pengecoran balok lantai 4 pada scaffolding ketinggian", cond: "R", hazard: "Pekerja jatuh dari ketinggian > 10 meter, perancah rubuh", l1: 4, c1: 5, score1: 20, cat1: "EXTREME", control: "Full Body Harness 100% tie-off ke lifeline independen, inspeksi scafftag hijau, safety net", l2: 2, c2: 3, score2: 6, cat2: "MED" },
    { act: "Pengangkatan rangka baja kolom menggunakan Mobile Crane 25T", cond: "NR", hazard: "Kawat seling putus, crane terguling akibat tanah lembek", l1: 3, c1: 5, score1: 15, cat1: "EXTREME", control: "Cek SWL load chart, outrigger pad pelat baja tebal, rigger berlisensi SIO Kemnaker", l2: 1, c2: 4, score2: 4, cat2: "LOW" }
  ],
  tambang: [
    { act: "Pengangkutan bijih batubara dengan Dump Truck 50 Ton", cond: "R", hazard: "Tabrakan di jalan hauling, dump truck terbalik di jurang", l1: 3, c1: 5, score1: 15, cat1: "EXTREME", control: "Pemisahan jalur hauling, tanggul pengaman (safety bund) tinggi 3/4 diameter roda, fatigue sensor", l2: 1, c2: 4, score2: 4, cat2: "LOW" }
  ],
  logistik: [
    { act: "Penyusunan barang pada rak tinggi warehouse (High Reach)", cond: "R", hazard: "Barang pallet roboh menimpa operator reach truck", l1: 3, c1: 4, score1: 12, cat1: "HIGH", control: "Overhead guard baja pada kabin operator, batas kapasitas beban rak, wrapping stretch film rapat", l2: 1, c2: 3, score2: 3, cat2: "LOW" }
  ]
};

let currentRows = [];

function loadIbprTemplate(key){
  const t = ibprTemplates[key];
  if(!t) return;
  document.querySelectorAll('.preset-bar .preset-btn').forEach(b => b.classList.remove('active'));
  [...document.querySelectorAll('[onclick]')].find(button => button.getAttribute('onclick') === `loadIbprTemplate('${key}')`)?.classList.add('active');

  currentRows = JSON.parse(JSON.stringify(t));
  renderIbprTable();
}

function getRiskCategory(score){
  if(score >= 15) return { cat: 'EXTREME', cls: 'risk-ext' };
  if(score >= 10) return { cat: 'HIGH', cls: 'risk-high' };
  if(score >= 5)  return { cat: 'MED', cls: 'risk-med' };
  return { cat: 'LOW', cls: 'risk-low' };
}

function renderIbprTable(){
  const tbody = document.getElementById('ibprBody');
  tbody.innerHTML = '';

  currentRows.forEach((r, idx) => {
    const info1 = getRiskCategory(r.score1);
    const info2 = getRiskCategory(r.score2);

    const tr = document.createElement('tr');
    tr.innerHTML = `
      <td style="text-align:center;font-weight:bold">${idx + 1}</td>
      <td><textarea onchange="updateIbpr(${idx}, 'act', this.value)">${escapeHtml(r.act)}</textarea></td>
      <td style="text-align:center">
        <select class="form-input" style="padding:4px;font-size:0.8rem;font-weight:bold" onchange="updateIbpr(${idx}, 'cond', this.value)">
          <option value="R" ${r.cond === 'R' ? 'selected' : ''}>R</option>
          <option value="NR" ${r.cond === 'NR' ? 'selected' : ''}>NR</option>
          <option value="E" ${r.cond === 'E' ? 'selected' : ''}>E</option>
        </select>
      </td>
      <td><textarea onchange="updateIbpr(${idx}, 'hazard', this.value)">${escapeHtml(r.hazard)}</textarea></td>
      <td style="text-align:center"><input type="number" min="1" max="5" class="form-input" style="padding:4px;text-align:center" value="${r.l1}" onchange="calcRow(${idx}, 'l1', this.value)"></td>
      <td style="text-align:center"><input type="number" min="1" max="5" class="form-input" style="padding:4px;text-align:center" value="${r.c1}" onchange="calcRow(${idx}, 'c1', this.value)"></td>
      <td style="text-align:center"><span class="badge-risk ${info1.cls}">${info1.cat} (${r.score1})</span></td>
      <td><textarea onchange="updateIbpr(${idx}, 'control', this.value)">${escapeHtml(r.control)}</textarea></td>
      <td style="text-align:center"><strong style="color:var(--navy)">${r.score2}</strong></td>
      <td style="text-align:center"><span class="badge-risk ${info2.cls}">${info2.cat}</span></td>
      <td style="text-align:center">
        <button style="border:none;background:#FEE2E2;color:#991B1B;padding:2px 6px;border-radius:4px;cursor:pointer;font-weight:bold" onclick="delIbprRow(${idx})">✕</button>
      </td>
    `;
    tbody.appendChild(tr);
  });
}

function updateIbpr(idx, field, val){
  if(currentRows[idx]) currentRows[idx][field] = val;
}

function calcRow(idx, field, val){
  const r = currentRows[idx];
  if(!r) return;
  r[field] = parseInt(val) || 1;
  r.score1 = r.l1 * r.c1;
  r.score2 = Math.max(1, Math.round(r.score1 * 0.25)); // Residual risk auto estimated
  renderIbprTable();
}

function addIbprRow(){
  currentRows.push({
    act: "Aktivitas kerja baru...",
    cond: "R",
    hazard: "Potensi bahaya teridentifikasi...",
    l1: 3, c1: 3, score1: 9, cat1: "MED",
    control: "Rencana tindakan pengendalian K3...",
    l2: 1, c2: 2, score2: 2, cat2: "LOW"
  });
  renderIbprTable();
}

function delIbprRow(idx){
  if(currentRows.length <= 1){
    alert('Minimal harus ada 1 baris aktivitas dalam tabel IBPR!');
    return;
  }
  currentRows.splice(idx, 1);
  renderIbprTable();
}

function escapeHtml(text){
  return String(text).replace(/[&<>"']/g, function(m){
    return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m];
  });
}

function exportIbprCsv(){
  let csv = 'No,Aktivitas,Kondisi,Bahaya & Dampak,L_Awal,C_Awal,Skor_Awal,Tindakan Pengendalian,Skor_Sisa\n';
  currentRows.forEach((r, i) => {
    csv += `"${i+1}","${r.act.replace(/"/g, '""')}","${r.cond}","${r.hazard.replace(/"/g, '""')}","${r.l1}","${r.c1}","${r.score1}","${r.control.replace(/"/g, '""')}","${r.score2}"\n`;
  });
  const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
  const link = document.createElement("a");
  link.href = URL.createObjectURL(blob);
  link.download = `IBPR_HIRADC_${new Date().toISOString().slice(0,10)}.csv`;
  link.click();
}

function printOfficialIbpr(){
  const perush = document.getElementById('inpPerusahaan').value;
  const dept = document.getElementById('inpDepartemen').value;
  const ketua = document.getElementById('inpKetuaTim').value;
  const tgl = document.getElementById('inpTglReview').value || new Date().toLocaleDateString('id-ID');

  const win = window.open('', '_blank');
  win.document.write(`<!DOCTYPE html><html><head><title>Dokumen IBPR - ${perush}</title>
  <style>
    body{font-family:'Segoe UI',Arial,sans-serif;padding:24px;max-width:1050px;margin:0 auto;color:#0F172A;line-height:1.4}
    h1{font-size:16pt;margin:0;color:#0D233A;border-bottom:2px solid #0D233A;padding-bottom:6px}
    .sub{font-size:8.5pt;color:#64748B;margin:4px 0 12px}
    table{width:100%;border-collapse:collapse;margin:10px 0;font-size:8.5pt}
    th,td{border:1px solid #CBD5E1;padding:6px 8px;text-align:left;vertical-align:top}
    th{background:#0D233A;color:#fff}
    .sig{margin-top:30px;display:grid;grid-template-columns:1fr 1fr;gap:40px;text-align:center;font-size:9pt}
    .line{margin-top:50px;border-top:1px solid #000;font-weight:bold}
  </style>
  </head><body>
  <h1>TABEL IDENTIFIKASI BAHAYA &amp; PENILAIAN RISIKO (IBPR / HIRADC)</h1>
  <div class="sub">Perusahaan: <strong>${perush}</strong> | Dept: <strong>${dept}</strong> | Tanggal: ${tgl}</div>
  <table>
    <thead>
      <tr>
        <th style="width:25px">No</th>
        <th>Aktivitas Kerja</th>
        <th style="width:30px">Kond</th>
        <th>Potensi Bahaya &amp; Dampak</th>
        <th style="width:35px">Skor Awal</th>
        <th>Pengendalian Tambahan (Hirarki K3)</th>
        <th style="width:35px">Skor Sisa</th>
      </tr>
    </thead>
    <tbody>
      ${currentRows.map((r, i) => `
        <tr>
          <td style="text-align:center">${i+1}</td>
          <td>${escapeHtml(r.act)}</td>
          <td style="text-align:center"><strong>${r.cond}</strong></td>
          <td>${escapeHtml(r.hazard)}</td>
          <td style="text-align:center"><strong>${r.score1}</strong></td>
          <td>${escapeHtml(r.control)}</td>
          <td style="text-align:center"><strong>${r.score2}</strong></td>
        </tr>
      `).join('')}
    </tbody>
  </table>
  <div class="sig">
    <div>Disusun oleh,<br><strong>Ketua Tim HIRADC / Ahli K3 Umum</strong><div class="line">${ketua}</div></div>
    <div>Disahkan oleh,<br><strong>Pimpinan Manajemen Puncak</strong><div class="line">( ___________________________ )</div></div>
  </div>
  </body></html>`);
  win.document.close();
  win.print();
}

function toggleFaq(btn){
  btn.parentElement.classList.toggle('active');
}

window.addEventListener('DOMContentLoaded', () => {
  document.getElementById('inpTglReview').valueAsDate = new Date();
  loadIbprTemplate('manufaktur');
});
