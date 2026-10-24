/* Restored from the original tools/laporan-insiden.php in origin/main. */

function printIncidentReport(){
  const tipe = document.getElementById('inpTipeInsiden').value;
  const tgl = document.getElementById('inpTglWaktu').value || new Date().toLocaleString('id-ID');
  const tkp = document.getElementById('inpLokasiTKP').value;
  const korban = document.getElementById('inpNamaKorban').value;
  const jabatan = document.getElementById('inpJabatanKorban').value;
  const cedera = document.getElementById('inpBagianTubuh').value;
  const kronologi = document.getElementById('inpKronologi').value;
  const unsafeAct = document.getElementById('inpUnsafeAct').value;
  const unsafeCond = document.getElementById('inpUnsafeCond').value;
  const w1 = document.getElementById('why1').value;
  const w2 = document.getElementById('why2').value;
  const w3 = document.getElementById('why3').value;
  const w4 = document.getElementById('why4').value;
  const w5 = document.getElementById('why5').value;

  const win = window.open('', '_blank');
  win.document.write(`<!DOCTYPE html><html><head><title>Laporan Investigasi Insiden K3</title>
  <style>
    body{font-family:'Segoe UI',Arial,sans-serif;padding:32px;max-width:860px;margin:0 auto;color:#0F172A;line-height:1.5}
    h1{font-size:16pt;margin:0;color:#0D233A;border-bottom:2px solid #0D233A;padding-bottom:8px}
    .sub{font-size:8.5pt;color:#64748B;margin:6px 0 16px}
    table{width:100%;border-collapse:collapse;margin:12px 0;font-size:9pt}
    th,td{border:1px solid #CBD5E1;padding:8px 10px;text-align:left}
    th{background:#F1F5F9;color:#0D233A;width:24%}
    .why-box{background:#F8FAFC;border:1px solid #CBD5E1;padding:10px;margin:6px 0;font-size:8.5pt}
    .sig{margin-top:40px;display:grid;grid-template-columns:1fr 1fr;gap:40px;text-align:center;font-size:9pt}
    .line{margin-top:60px;border-top:1px solid #000;font-weight:bold}
  </style>
  </head><body>
  <h1>FORMULIR LAPORAN INVESTIGASI KECELAKAAN KERJA (K3)</h1>
  <div class="sub">Standar Permenaker No. PER.03/MEN/1998 &amp; Format Evaluasi P2K3</div>
  <table>
    <tr><th>Kategori Insiden</th><td><strong>${tipe}</strong></td></tr>
    <tr><th>Waktu &amp; Lokasi TKP</th><td>${tgl} | ${tkp}</td></tr>
    <tr><th>Data Korban</th><td><strong>${korban}</strong> (${jabatan})</td></tr>
    <tr><th>Dampak Cedera Tubuh</th><td>${cedera}</td></tr>
    <tr><th>Kronologi Peristiwa</th><td>${kronologi}</td></tr>
    <tr><th>Penyebab Langsung</th><td>Tindakan: ${unsafeAct}<br>Kondisi: ${unsafeCond}</td></tr>
  </table>

  <h3>Rantai Analisis 5-Why (Root Cause Analysis):</h3>
  <div class="why-box"><strong>Why 1:</strong> ${w1}</div>
  <div class="why-box"><strong>Why 2:</strong> ${w2}</div>
  <div class="why-box"><strong>Why 3:</strong> ${w3}</div>
  <div class="why-box"><strong>Why 4:</strong> ${w4}</div>
  <div class="why-box" style="background:#FFF2EA;border-color:#E8611A"><strong>Akar Masalah (Why 5):</strong> <strong>${w5}</strong></div>

  <div class="sig">
    <div>Investigator Lapangan,<br><strong>Ahli K3 Umum / Sekretaris P2K3</strong><div class="line">( ___________________________ )</div></div>
    <div>Mengetahui &amp; Menyetujui,<br><strong>Ketua P2K3 / Site Manager</strong><div class="line">( ___________________________ )</div></div>
  </div>
  </body></html>`);
  win.document.close();
  win.print();
}

function toggleFaq(btn){
  btn.parentElement.classList.toggle('active');
}

window.addEventListener('DOMContentLoaded', () => {
  const now = new Date();
  now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
  document.getElementById('inpTglWaktu').value = now.toISOString().slice(0,16);
});
