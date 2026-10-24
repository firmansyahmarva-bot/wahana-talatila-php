/* Restored from the original tools/kalkulator-biaya-k3.php in origin/main. */

let currentRatio = 4;

function setRatio(val){
  currentRatio = val;
  document.getElementById('btnHeinrich').classList.toggle('active', val === 4);
  document.getElementById('btnBird').classList.toggle('active', val === 10);
  document.getElementById('ratioLabel').textContent = val === 4 ? 'Rasio 1 : 4 (Heinrich)' : 'Rasio 1 : 10 (Frank Bird)';
  calcCost();
}

function resetCostForm(){
  document.getElementById('inpMedis').value = 10000000;
  document.getElementById('inpSantunan').value = 5000000;
  document.getElementById('inpKerusakanAlat').value = 15000000;
  document.getElementById('inpInvestasi').value = 25000000;
  calcCost();
}

function formatRupiah(num){
  return 'Rp ' + Math.round(num).toLocaleString('id-ID');
}

function calcCost(){
  const medis = parseFloat(document.getElementById('inpMedis').value) || 0;
  const santunan = parseFloat(document.getElementById('inpSantunan').value) || 0;
  const alat = parseFloat(document.getElementById('inpKerusakanAlat').value) || 0;
  const investasi = parseFloat(document.getElementById('inpInvestasi').value) || 1;

  const directTotal = medis + santunan + alat;
  const indirectTotal = directTotal * currentRatio;
  const totalCost = directTotal + indirectTotal;

  document.getElementById('iceDirectVal').textContent = formatRupiah(directTotal);
  document.getElementById('iceIndirectVal').textContent = formatRupiah(indirectTotal);
  document.getElementById('outTotalCost').textContent = formatRupiah(totalCost);

  // ROI calculation
  if(investasi > 0){
    const netSavings = totalCost - investasi;
    const roiPercent = (netSavings / investasi) * 100;
    const multiplier = (totalCost / investasi).toFixed(2);

    document.getElementById('outRoi').textContent = (roiPercent > 0 ? '+' : '') + roiPercent.toFixed(1) + '%';
    document.getElementById('outRoiDesc').textContent = `Setiap Rp 1 investasi K3 menghemat Rp ${multiplier} potensi kerugian`;
  }
}

function printCostReport(){
  const directVal = document.getElementById('iceDirectVal').textContent;
  const indirectVal = document.getElementById('iceIndirectVal').textContent;
  const totalVal = document.getElementById('outTotalCost').textContent;
  const roiVal = document.getElementById('outRoi').textContent;
  const ratioText = currentRatio === 4 ? 'Heinrich (1 : 4)' : 'Frank Bird Jr. (1 : 10)';

  const win = window.open('', '_blank');
  win.document.write(`<!DOCTYPE html><html><head><title>Executive Brief: Analisis Biaya Kecelakaan K3</title>
  <style>
    body{font-family:'Segoe UI',Arial,sans-serif;padding:32px;max-width:760px;margin:0 auto;color:#0F172A;line-height:1.5}
    h1{font-size:16pt;margin:0;color:#0D233A;border-bottom:2px solid #0D233A;padding-bottom:8px}
    .sub{font-size:8.5pt;color:#64748B;margin:6px 0 16px}
    table{width:100%;border-collapse:collapse;margin:16px 0;font-size:10pt}
    th,td{border:1px solid #CBD5E1;padding:8px 12px;text-align:left}
    th{background:#F1F5F9;color:#0D233A}
    .sig{margin-top:40px;display:grid;grid-template-columns:1fr 1fr;gap:40px;text-align:center;font-size:9pt}
    .line{margin-top:60px;border-top:1px solid #000;font-weight:bold}
  </style>
  </head><body>
  <h1>EXECUTIVE REPORT: ANALISIS KERUGIAN BIAYA KECELAKAAN KERJA</h1>
  <div class="sub">Kajian Teori Gunung Es K3 (Iceberg Principle) &amp; Cost-Benefit Analysis</div>
  <table>
    <tr><th>Komponen Biaya</th><th>Estimasi Nilai Kerugian</th><th>Keterangan</th></tr>
    <tr><td>Biaya Langsung (Direct Cost)</td><td><strong>${directVal}</strong></td><td>Medis, kompensasi &amp; perbaikan fisik alat</td></tr>
    <tr><td>Biaya Tersembunyi (Indirect Cost)</td><td><strong style="color:#C2410C">${indirectVal}</strong></td><td>Model Rasio ${ratioText}</td></tr>
    <tr style="background:#F8FAFC"><td><strong>TOTAL KERUGIAN FINANSIAL</strong></td><td style="font-size:12pt;font-weight:bold;color:#0D233A">${totalVal}</td><td>Beban langsung terhadap kas operasional</td></tr>
    <tr><td>Return on Investment (ROI) Pencegahan</td><td style="font-weight:bold;color:#166534">${roiVal}</td><td>Potensi proteksi kerugian per Rp 1 biaya K3</td></tr>
  </table>
  <div class="sig">
    <div>Disusun oleh,<br><strong>Ahli K3 Umum / HSE Manager</strong><div class="line">( ___________________________ )</div></div>
    <div>Menyetujui,<br><strong>Direktur Keuangan / Direktur Operasional</strong><div class="line">( ___________________________ )</div></div>
  </div>
  </body></html>`);
  win.document.close();
  win.print();
}

function toggleFaq(btn){
  btn.parentElement.classList.toggle('active');
}

window.addEventListener('DOMContentLoaded', calcCost);
