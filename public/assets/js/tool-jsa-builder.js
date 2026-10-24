/* Restored from the original tools/jsa-builder.php in origin/main. */

// Templates database for instant high-value generation
const jsaTemplates = {
  ketinggian: {
    title: "Pemasangan & Inspeksi Perancah Scaffolding (Ketinggian > 2m)",
    steps: [
      { step: "Pemeriksaan kondisi fisik komponen scaffolding (pipa, clamp, baseplate, catwalk)", hazard: "Pipa retak/bengkok, clamp aus berisiko patah saat menahan beban", risk: "HIGH", control: "Inspeksi visual pra-pakai, singkirkan material cacat, gunakan scaffolder berlisensi Kemnaker", pic: "Scaffolder Inspector" },
      { step: "Perataan dan pemadatan tanah landasan pemasangan baseplate", hazard: "Struktur perancah amblas atau miring akibat tanah lunak", risk: "HIGH", control: "Gunakan sole plate papan kayu solid minimal tebal 5 cm, pasang jack base waterpass", pic: "Supervisor Lapangan" },
      { step: "Ereksi rangka scaffolding, ledger, transom, dan cross-bracing", hazard: "Pekerja terjatuh dari ketinggian saat memasang pipa atas", risk: "HIGH", control: "Wajib memakai Full Body Harness double lanyard 100% tie-off ke anchor point independen", pic: "Mandor & Pekerja" },
      { step: "Pemasangan papan lantai kerja (catwalk) dan toeboard penahan", hazard: "Papan patah atau bergeser, celah longgar menyebabkan tersandung", risk: "MED", control: "Pasang lantai kerja rapat tanpa celah (> 20mm), pasang toeboard minimal tinggi 15 cm", pic: "Tim Scaffolder" },
      { step: "Pemasangan guardrail (top rail 110cm & mid rail 60cm)", hazard: "Pekerja tergelincir jatuh dari tepi perancah", risk: "HIGH", control: "Pasang railing ganda sesuai standar Permenaker No. 09/2016, pasang jaring safety net", pic: "Scaffolder" },
      { step: "Inspeksi akhir dan pemasangan Scafftag (Tag Hijau / Merah)", hazard: "Pekerja umum menggunakan perancah belum selesai / tidak aman", risk: "MED", control: "Inspeksi Ahli K3 / Scaffolder Bersertifikat, pasang Tag Hijau jika lulus, Tag Merah jika belum aman", pic: "HSE Officer" }
    ]
  },
  hotwork: {
    title: "Pekerjaan Pengelasan dan Pemotongan Besi (Hot Work)",
    steps: [
      { step: "Pemeriksaan area kerja radius 11 meter dari bahan mudah terbakar", hazard: "Percikan bunga api las menyambar solar, thinner, kayu, atau kardus", risk: "HIGH", control: "Singkirkan semua bahan B3 mudah terbakar radius 11m, tutup celah dengan fire blanket tahan api", pic: "Fire Watcher" },
      { step: "Inspeksi kabel mesin las, trafo, stang las, dan grounding clamp", hazard: "Kabel terkelupas menyebabkan sengatan listrik 380V atau korsleting", risk: "HIGH", control: "Gunakan mesin las yang telah diuji tagging bulanan, pasang grounding rapat pada benda kerja", pic: "Welder / Teknisi" },
      { step: "Penyiapan tabung gas asetilen & oksigen untuk proses cutting", hazard: "Kebocoran gas LPG/asetilen memicu ledakan tabung silinder", risk: "HIGH", control: "Pastikan tabung berdiri tegak terikat rantai, pasang flash back arrestor di regulator dan torch", pic: "Fitter" },
      { step: "Pelaksanaan proses pengelasan benda kerja", hazard: "Radiasi sinar UV/IR menyilaukan mata, asap beracun (fume) terhirup", risk: "MED", control: "Gunakan welding helmet auto-darkening shade 10-12, gunakan respirator khusus asap las (particulate filter)", pic: "Welder" },
      { step: "Pemantauan pasca pengelasan (Fire Watch Standby 30 menit)", hazard: "Bara tersembunyi menyala menjadi api setelah pekerja meninggalkan lokasi", risk: "HIGH", control: "Fire watcher standby dengan APAR powder 6kg minimal 30 menit setelah pekerjaan selesai", pic: "Petugas Fire Watch" }
    ]
  },
  confined: {
    title: "Pembersihan & Inspeksi Tangki Ruang Terbatas (Confined Space)",
    steps: [
      { step: "Isolasi energi mekanis, perpipaan, dan listrik (LOTO)", hazard: "Cairan kimia masuk atau mixer tangki menyala otomatis secara mendadak", risk: "HIGH", control: "Pasang blind flange fisik pada pipa masuk, pasang padlock dan Tag LOTO pada breaker listrik", pic: "Mekanik & HSE" },
      { step: "Pengujian atmosfer gas berbahaya (Gas Testing) pra-masuk", hazard: "Kekurangan oksigen (< 19.5%), paparan gas beracun (H2S, CO), ledakan LEL", risk: "HIGH", control: "Uji dengan 4-gas detector terkalibrasi di 3 level ketinggian (atas, tengah, bawah tangki)", pic: "Petugas Gas Tester" },
      { step: "Ventilasi udara paksa dengan blower mekanis", hazard: "Akumulasi gas beracun selama pekerjaan pembersihan berlangsung", risk: "HIGH", control: "Nyalakan blower udara segar terus menerus, arahkan exhaust jauh dari pintu masuk", pic: "Attendant" },
      { step: "Personel masuk ke dalam tangki menggunakan APD lengkap", hazard: "Pekerja pingsan atau terjebak di dalam tangki", risk: "HIGH", control: "Wajib kenakan harness dengan retrieval lifeline, sediakan breathing apparatus (SCBA/airline)", pic: "Entrant" },
      { step: "Pengawasan kontinu oleh Petugas Jaga Ruang Terbatas (Attendant)", hazard: "Keterlambatan tindakan evakuasi saat entrant mengalami kondisi darurat", risk: "HIGH", control: "Attendant standby 100% di luar manhole, catat log waktu masuk-keluar, siapkan tripot rescue", pic: "Standby Attendant" }
    ]
  },
  lifting: {
    title: "Pengangkatan Generator 10 Ton Menggunakan Mobile Crane",
    steps: [
      { step: "Pemeriksaan dokumen sertifikasi crane (SILO) dan lisensi operator (SIO)", hazard: "Kegagalan mekanis crane, ketidakmampuan operator mengendalikan beban", risk: "HIGH", control: "Pastikan SILO Kemnaker masih aktif, operator memiliki SIO Crane Kelas 1 / 2 resmi", pic: "HSE Inspector" },
      { step: "Inspeksi outrigger crane dan kestabilan landasan tanah", hazard: "Tanah amblas menyebabkan crane terguling (tip-over)", risk: "HIGH", control: "Pasang outrigger full extend, pasang pelat baja/kayu keras tebal di bawah ponton outrigger", pic: "Rigging Supervisor" },
      { step: "Inspeksi alat bantu angkat (webbing sling, shackle, spreader bar)", hazard: "Sling putus, shackle bengkok meluncurkan beban jatuh ke bawah", risk: "HIGH", control: "Cek SWL (Safe Working Load), tolak sling yang sobek/terpotong, gunakan safety latch pada hook", pic: "Rigger Bersertifikat" },
      { step: "Sterilisasi area radius putar crane (Swing Radius Barricade)", hazard: "Pekerja tertimpa beban ayun atau terjepit counterweight crane", risk: "HIGH", control: "Pasang barikade pita merah-putih di sekeliling radius putar, dilarang melintas di bawah beban", pic: "Safety Man" },
      { step: "Pengangkatan beban dan pemanduan arah menggunakan tagline", hazard: "Beban berputar tak terkendali mengenai struktur gedung sekitar", risk: "MED", control: "Gunakan tali pemandu (tagline) minimal 2 sisi, komando hanya dari 1 orang rigger berompi terang", pic: "Rigger & Tagman" }
    ]
  },
  galian: {
    title: "Pekerjaan Penggalian Tanah Pondasi Kedalaman > 2 Meter",
    steps: [
      { step: "Pengecekan jalur utilitas bawah tanah (kabel listrik, pipa gas, air)", hazard: "Mengenai kabel tegangan tinggi memicu ledakan atau pipa air pecah", risk: "HIGH", control: "Survei utilitas bawah tanah dengan cable locator, gali manual hati-hati di titik kritis", pic: "Surveyor & Pengawas" },
      { step: "Penggalian menggunakan excavator dan pembentukan kemiringan (sloping)", hazard: "Pekerja tertabrak swing excavator atau tanah longsor mendadak", risk: "HIGH", control: "Jaga jarak 5 meter dari excavator, buat kemiringan (bench/slope) rasio 1:1 sesuai jenis tanah", pic: "Operator & Mandor" },
      { step: "Pemasangan proteksi dinding penahan tanah (shoring/sheet pile)", hazard: "Dinding galian runtuh menimbun pekerja di dasar lubang", risk: "HIGH", control: "Pasang sistem penahan tanah (shoring) untuk galian > 1.5m, inspeksi pasca hujan", pic: "Supervisor Sipil" },
      { step: "Penyediaan tangga akses keluar masuk lubang galian", hazard: "Pekerja terpeleset jatuh ke lubang atau terjebak saat kondisi darurat", risk: "MED", control: "Sediakan tangga akses setiap jarak 7.5 meter, ujung tangga menonjol 1 meter di atas tanah", pic: "Mandor" },
      { step: "Penempatan tumpukan tanah galian (spoil pile)", hazard: "Beban tanah di tepi galian memicu keruntuhan dinding", risk: "HIGH", control: "Tempatkan tumpukan tanah minimal 1 meter dari bibir tepi galian", pic: "Pengawas Lapangan" }
    ]
  },
  listrik: {
    title: "Perbaikan & Perawatan Panel Listrik Tegangan Menengah (20kV)",
    steps: [
      { step: "Penerbitan Izin Kerja Listrik dan Prosedur LOTO (Lock Out Tag Out)", hazard: "Pekerja lain menyalakan breaker utama saat teknisi bekerja", risk: "HIGH", control: "Putus breaker utama, pasang pad-lock pribadi dan danger tag, simpan kunci di lockbox", pic: "Teknisi Listrik & HSE" },
      { step: "Verifikasi kondisi Nol Energi (Zero Voltage Testing)", hazard: "Tegangan sisa pada kapasitor atau kesalahan pemutusan jalur kabel", risk: "HIGH", control: "Uji dengan voltage detector terkalibrasi, lakukan pelepasan arus tanah (grounding discharge)", pic: "Ahli K3 Listrik" },
      { step: "Pemasangan Grounding Portabel Sementara", hazard: "Tegangan induksi dari kabel berdekatan yang masih aktif", risk: "HIGH", control: "Pasang portable earthing lead pada ketiga fasa kabel sebelum disentuh tangan", pic: "Teknisi Listrik" },
      { step: "Pembersihan isolator dan pengencangan baut busbar", hazard: "Paparan debu partikel atau bahaya Arc Flash jika alat terjatuh", risk: "HIGH", control: "Wajib kenakan APD Arc Flash Kit (face shield, sarung tangan isolasi 20kV, pakaian FR)", pic: "Teknisi Listrik" },
      { step: "Pelepasan gembok LOTO dan uji coba penyalaan kembali", hazard: "Peralatan/personel tertinggal di dalam panel saat tegangan dimasukkan", risk: "HIGH", control: "Inspeksi housekeeping (pastikan tidak ada kunci pas tertinggal), tutup panel rapat sebelum ON", pic: "Supervisor Listrik" }
    ]
  }
};

let currentSteps = [];

function loadTemplate(key){
  const t = jsaTemplates[key];
  if(!t) return;
  document.querySelectorAll('.preset-bar .preset-btn').forEach(b => b.classList.remove('active'));
  [...document.querySelectorAll('[onclick]')].find(button => button.getAttribute('onclick') === `loadTemplate('${key}')`)?.classList.add('active');

  document.getElementById('inpJudulKerja').value = t.title;
  currentSteps = JSON.parse(JSON.stringify(t.steps));
  renderSteps();
}

function renderSteps(){
  const tbody = document.getElementById('jsaBody');
  tbody.innerHTML = '';

  currentSteps.forEach((s, idx) => {
    const tr = document.createElement('tr');
    tr.innerHTML = `
      <td style="text-align:center;font-weight:bold;color:var(--slate-600)">${idx + 1}</td>
      <td><textarea onchange="updateStep(${idx}, 'step', this.value)">${escapeHtml(s.step)}</textarea></td>
      <td><textarea onchange="updateStep(${idx}, 'hazard', this.value)">${escapeHtml(s.hazard)}</textarea></td>
      <td style="text-align:center">
        <select class="risk-select ${s.risk === 'HIGH' ? 'risk-high' : (s.risk === 'MED' ? 'risk-med' : 'risk-low')}" onchange="updateRisk(${idx}, this)">
          <option value="HIGH" ${s.risk === 'HIGH' ? 'selected' : ''}>TINGGI (H)</option>
          <option value="MED" ${s.risk === 'MED' ? 'selected' : ''}>SEDANG (M)</option>
          <option value="LOW" ${s.risk === 'LOW' ? 'selected' : ''}>RENDAH (L)</option>
        </select>
      </td>
      <td><textarea onchange="updateStep(${idx}, 'control', this.value)">${escapeHtml(s.control)}</textarea></td>
      <td><input type="text" class="form-input" style="font-size:0.84rem" value="${escapeHtml(s.pic)}" onchange="updateStep(${idx}, 'pic', this.value)"></td>
      <td style="text-align:center">
        <button class="btn-del-step" type="button" onclick="deleteStep(${idx})" title="Hapus Baris">✕</button>
      </td>
    `;
    tbody.appendChild(tr);
  });
}

function addJsaStep(){
  currentSteps.push({
    step: "Langkah kerja baru...",
    hazard: "Potensi bahaya teridentifikasi...",
    risk: "MED",
    control: "Tindakan pengendalian hierarki K3...",
    pic: "Petugas Terkait"
  });
  renderSteps();
}

function updateStep(idx, field, val){
  if(currentSteps[idx]){
    currentSteps[idx][field] = val;
  }
}

function updateRisk(idx, selectEl){
  const val = selectEl.value;
  if(currentSteps[idx]){
    currentSteps[idx].risk = val;
    selectEl.className = 'risk-select ' + (val === 'HIGH' ? 'risk-high' : (val === 'MED' ? 'risk-med' : 'risk-low'));
  }
}

function deleteStep(idx){
  if(currentSteps.length <= 1){
    alert('Minimal harus ada 1 langkah kerja dalam JSA!');
    return;
  }
  currentSteps.splice(idx, 1);
  renderSteps();
}

function escapeHtml(text){
  return String(text).replace(/[&<>"']/g, function(m){
    return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m];
  });
}

function exportCsv(){
  const title = document.getElementById('inpJudulKerja').value;
  let csv = 'No,Urutan Langkah Kerja,Potensi Bahaya,Tingkat Risiko,Tindakan Pengendalian,Penanggung Jawab\n';
  currentSteps.forEach((s, idx) => {
    csv += `"${idx+1}","${s.step.replace(/"/g, '""')}","${s.hazard.replace(/"/g, '""')}","${s.risk}","${s.control.replace(/"/g, '""')}","${s.pic.replace(/"/g, '""')}"\n`;
  });

  const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
  const link = document.createElement("a");
  link.href = URL.createObjectURL(blob);
  link.download = `JSA_${title.replace(/[^a-zA-Z0-9]/g, '_')}.csv`;
  link.click();
}

function printOfficialJsa(){
  const title = document.getElementById('inpJudulKerja').value;
  const lokasi = document.getElementById('inpLokasi').value;
  const supervisor = document.getElementById('inpSupervisor').value;
  const hse = document.getElementById('inpHse').value;
  const ptw = document.getElementById('inpPtw').value;
  const tgl = document.getElementById('inpTanggal').value || new Date().toLocaleDateString('id-ID');

  const win = window.open('', '_blank');
  win.document.write(`<!DOCTYPE html><html><head><title>JSA Form - ${title}</title>
  <style>
    body{font-family:'Segoe UI',Arial,sans-serif;padding:24px;max-width:960px;margin:0 auto;color:#0F172A;line-height:1.4}
    .header{border-bottom:3px solid #0D233A;padding-bottom:12px;margin-bottom:16px;display:flex;justify-content:space-between;align-items:flex-end}
    h1{font-size:16pt;margin:0;color:#0D233A}
    .sub{font-size:8.5pt;color:#64748B}
    table.meta{width:100%;border-collapse:collapse;margin-bottom:16px;font-size:9pt}
    table.meta td{padding:4px 8px;border:1px solid #CBD5E1}
    table.meta th{background:#F1F5F9;text-align:left;padding:4px 8px;border:1px solid #CBD5E1;width:18%}
    table.data{width:100%;border-collapse:collapse;margin:12px 0;font-size:8.5pt}
    table.data th{background:#0D233A;color:#fff;padding:8px;border:1px solid #0D233A;text-align:left}
    table.data td{padding:8px;border:1px solid #CBD5E1;vertical-align:top}
    .badge-h{background:#FEE2E2;color:#991B1B;padding:2px 6px;border-radius:4px;font-weight:bold;font-size:8pt}
    .badge-m{background:#FEF3C7;color:#92400E;padding:2px 6px;border-radius:4px;font-weight:bold;font-size:8pt}
    .badge-l{background:#DCFCE7;color:#166534;padding:2px 6px;border-radius:4px;font-weight:bold;font-size:8pt}
    .sig-grid{display:grid;grid-template-columns:1fr 1fr 1fr;gap:20px;margin-top:28px;text-align:center;font-size:8.5pt}
    .sig-line{margin-top:50px;border-top:1px solid #000;font-weight:bold;padding-top:4px}
  </style>
  </head><body>
  <div class="header">
    <div>
      <h1>JOB SAFETY ANALYSIS (JSA) / ANALISIS KESELAMATAN KERJA</h1>
      <div class="sub">Standar Operasional Keselamatan Kerja &amp; Lampiran Izin Kerja (PTW)</div>
    </div>
    <div style="text-align:right">
      <span style="background:#E8611A;color:#fff;padding:3px 8px;border-radius:4px;font-weight:bold;font-size:8pt">FORMULIR K3 RESMI</span>
    </div>
  </div>

  <table class="meta">
    <tr>
      <th>Nama Pekerjaan</th><td><strong>${title}</strong></td>
      <th>No. Izin Kerja (PTW)</th><td><strong>${ptw}</strong></td>
    </tr>
    <tr>
      <th>Lokasi / Proyek</th><td>${lokasi}</td>
      <th>Tanggal Pelaksanaan</th><td>${tgl}</td>
    </tr>
    <tr>
      <th>Pengawas Pekerjaan</th><td>${supervisor}</td>
      <th>Ahli K3 / HSE Officer</th><td>${hse}</td>
    </tr>
  </table>

  <table class="data">
    <thead>
      <tr>
        <th style="width:30px;text-align:center">No</th>
        <th style="width:25%">Urutan Langkah Kerja</th>
        <th style="width:25%">Potensi Bahaya Teridentifikasi</th>
        <th style="width:65px;text-align:center">Risiko</th>
        <th>Tindakan Pengendalian (Hierarki K3)</th>
        <th style="width:15%">Penanggung Jawab</th>
      </tr>
    </thead>
    <tbody>
      ${currentSteps.map((s, idx) => `
        <tr>
          <td style="text-align:center">${idx + 1}</td>
          <td>${escapeHtml(s.step)}</td>
          <td>${escapeHtml(s.hazard)}</td>
          <td style="text-align:center">
            <span class="${s.risk === 'HIGH' ? 'badge-h' : (s.risk === 'MED' ? 'badge-m' : 'badge-l')}">${s.risk}</span>
          </td>
          <td>${escapeHtml(s.control)}</td>
          <td>${escapeHtml(s.pic)}</td>
        </tr>
      `).join('')}
    </tbody>
  </table>

  <div class="sig-grid">
    <div>
      Disusun &amp; Dilaksanakan oleh,<br>
      <strong>Pengawas Lapangan / Supervisor</strong>
      <div class="sig-line">${supervisor}</div>
    </div>
    <div>
      Diverifikasi oleh,<br>
      <strong>Ahli K3 Umum / HSE Officer</strong>
      <div class="sig-line">${hse}</div>
    </div>
    <div>
      Disetujui oleh,<br>
      <strong>Pimpinan Proyek / Site Manager</strong>
      <div class="sig-line">( ___________________________ )</div>
    </div>
  </div>
  </body></html>`);
  win.document.close();
  win.print();
}

function toggleFaq(btn){
  btn.parentElement.classList.toggle('active');
}

// Initial load
window.addEventListener('DOMContentLoaded', () => {
  document.getElementById('inpTanggal').valueAsDate = new Date();
  loadTemplate('ketinggian');
});
