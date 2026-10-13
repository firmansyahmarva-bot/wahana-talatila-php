<?php
require_once __DIR__ . '/../config.php';
$s = get_all_settings();

$page_title = 'Kalkulator Biaya Kecelakaan Kerja 2026: Teori Gunung Es Heinrich & Bird';
$meta_desc = 'Hitung total kerugian finansial akibat kecelakaan kerja berdasarkan Teori Gunung Es K3 (Heinrich 1:4 & Bird 1:10). Analisis biaya langsung, biaya tak langsung, dan ROI program K3.';

ob_start();
$page_css = array_merge($page_css ?? [], ['tools-kalkulator-biaya-k3']);
require __DIR__ . '/../includes/head.php';
$shared_head = ob_get_clean();
$shared_head = preg_replace('~<title>.*?</title>~s', '<title>' . e($page_title) . '</title>', $shared_head, 1);
echo $shared_head;
?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    { "@type": "ListItem", "position": 1, "name": "Beranda", "item": "https://wahanatotalita.com/" },
    { "@type": "ListItem", "position": 2, "name": "Tools K3", "item": "https://wahanatotalita.com/tools/" },
    { "@type": "ListItem", "position": 3, "name": "Kalkulator Biaya K3", "item": "https://wahanatotalita.com/tools/kalkulator-biaya-k3/" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebApplication",
  "name": "Kalkulator Biaya Kecelakaan Kerja & ROI K3",
  "url": "https://wahanatotalita.com/tools/kalkulator-biaya-k3/",
  "description": "Kalkulator analisis biaya kecelakaan kerja langsung vs tersembunyi menggunakan teori gunung es Heinrich dan Frank Bird beserta estimasi ROI pencegahan K3.",
  "applicationCategory": "BusinessApplication",
  "operatingSystem": "All",
  "offers": { "@type": "Offer", "price": "0", "priceCurrency": "IDR" }
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "Apa itu Teori Gunung Es (Iceberg Theory) dalam biaya kecelakaan K3?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Teori Gunung Es mengilustrasikan bahwa biaya langsung kecelakaan (biaya medis dan klaim asuransi) hanyalah puncak gunung es yang terlihat di atas permukaan laut. Bagian terbesar dari kerugian finansial perusahaan (biaya tersembunyi/tak langsung) berada di bawah permukaan laut dengan nilai 4 hingga 10 kali lipat lebih besar, seperti terhentinya lini produksi, jam kerja investigasi, denda regulasi, dan hilangnya reputasi bisnis."
      }
    },
    {
      "@type": "Question",
      "name": "Berapa rasio perbandingan biaya langsung dan tidak langsung menurut Heinrich dan Frank Bird?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "H.W. Heinrich (1931) menetapkan rasio biaya langsung dibanding biaya tidak langsung adalah 1 : 4. Sedangkan penelitian lanjutan oleh Frank E. Bird Jr. (1969) dan studi modern menunjukkan rasio kerugian terselubung bisa mencapai 1 : 10 hingga 1 : 50 tergantung jenis industri dan dampak terhadap aset operasional."
      }
    },
    {
      "@type": "Question",
      "name": "Bagaimana cara meyakinkan manajemen puncak (C-Level) untuk berinvestasi dalam program K3?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Gunakan kalkulasi Return on Investment (ROI) K3: tunjukkan bahwa setiap Rp 1 yang diinvestasikan pada pencegahan keselamatan kerja rata-rata menghemat Rp 4 hingga Rp 6 dari potensi kerugian kecelakaan kerja tersembunyi yang dapat mengancam kelangsungan arus kas perusahaan."
      }
    }
  ]
}
</script>


<?php require __DIR__ . '/../includes/navbar.php'; ?>

<main class="cost-page" id="konten-utama">

<!-- HERO -->
<section class="cost-hero">
  <div class="container">
    <div class="hero-badge">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 1v22M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
      Teori Heinrich &amp; Frank Bird Jr.
    </div>
    <h1>Kalkulator Biaya Kecelakaan Kerja <span>2026</span></h1>
    <p>Hitung total kerugian finansial tersembunyi (Hidden Indirect Costs) akibat kecelakaan kerja menggunakan Teori Gunung Es K3, serta susun analisis Return on Investment (ROI) program keselamatan untuk jajaran Direksi.</p>
    <div class="hero-tags">
      <span class="hero-tag">Rasio Heinrich 1 : 4</span>
      <span class="hero-tag">Rasio Frank Bird 1 : 10</span>
      <span class="hero-tag">Direct vs Indirect Cost Breakdown</span>
      <span class="hero-tag">Cost-Benefit Analysis K3</span>
    </div>
  </div>
</section>

<!-- MAIN WORKSPACE -->
<section class="cost-wrapper">
  <div class="container">
    
    <div class="cost-grid">
      
      <!-- INPUT COLUMN -->
      <div>
        <div class="card-box">
          
          <div class="card-header-line">
            <h2 class="card-title">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--orange)" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M16 8h-6a2 2 0 1 0 0 4h4a2 2 0 1 1 0 4H8"/><path d="M12 6v2m0 8v2"/></svg>
              Input Biaya Langsung (Direct Costs)
            </h2>
            <button type="button" class="ratio-btn" onclick="resetCostForm()" style="padding:4px 10px;font-size:0.8rem">Reset</button>
          </div>

          <label class="form-label">Pilih Model Rasio Gunung Es K3</label>
          <div class="ratio-toggle">
            <button type="button" id="btnHeinrich" class="ratio-btn active" onclick="setRatio(4)">
              Heinrich Ratio (1 : 4)<br><small>Manufaktur &amp; Umum</small>
            </button>
            <button type="button" id="btnBird" class="ratio-btn" onclick="setRatio(10)">
              Frank Bird Ratio (1 : 10)<br><small>Konstruksi, Migas &amp; Tambang</small>
            </button>
          </div>

          <div class="form-field">
            <label class="form-label" for="inpMedis">
              Biaya Perawatan Medis &amp; Rumah Sakit
              <small>Rupiah (IDR)</small>
            </label>
            <input type="number" id="inpMedis" class="form-input" value="15000000" min="0" oninput="calcCost()">
          </div>

          <div class="form-field">
            <label class="form-label" for="inpSantunan">
              Santunan / Kompensasi di Luar BPJS Ketenagakerjaan
              <small>Rupiah (IDR)</small>
            </label>
            <input type="number" id="inpSantunan" class="form-input" value="10000000" min="0" oninput="calcCost()">
          </div>

          <div class="form-field">
            <label class="form-label" for="inpKerusakanAlat">
              Biaya Perbaikan / Penggantian Mesin &amp; Fasilitas Rusak
              <small>Rupiah (IDR)</small>
            </label>
            <input type="number" id="inpKerusakanAlat" class="form-input" value="25000000" min="0" oninput="calcCost()">
          </div>

          <div style="border-top:1px dashed var(--slate-300);padding-top:16px;margin-top:16px">
            <label class="form-label">
              Anggaran Investasi Program Pencegahan K3 (Untuk Analisis ROI)
              <small>Rupiah (IDR)</small>
            </label>
            <input type="number" id="inpInvestasi" class="form-input" value="30000000" min="0" oninput="calcCost()">
          </div>

        </div>
      </div>

      <!-- RESULTS COLUMN -->
      <div>
        <div class="card-box">
          
          <div class="card-header-line">
            <h2 class="card-title">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--orange)" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
              Visualisasi Teori Gunung Es K3
            </h2>
            <span id="ratioLabel" style="font-size:0.78rem;font-weight:700;color:var(--orange);background:var(--orange-light);padding:4px 8px;border-radius:4px">
              Rasio 1 : 4
            </span>
          </div>

          <!-- ICEBERG BOX -->
          <div class="iceberg-box">
            <div class="ice-surface-line">
              <span style="font-size:0.8rem;text-transform:uppercase;letter-spacing:0.04em">Permukaan Laut (Visible)</span>
              <strong id="iceDirectLabel">Biaya Langsung</strong>
            </div>
            
            <div class="ice-top">
              <div style="font-size:0.75rem;color:var(--slate-600);text-transform:uppercase">Biaya Langsung (Terlihat)</div>
              <div style="font-size:1.3rem;font-weight:800;color:var(--navy)" id="iceDirectVal">Rp 50.000.000</div>
              <div style="font-size:0.78rem;color:var(--slate-600);margin-top:4px">Kompensasi, medis, perbaikan mesin langsung</div>
            </div>

            <div class="ice-bottom">
              <div style="font-size:0.75rem;color:var(--info-bg);text-transform:uppercase;margin-bottom:2px">Biaya Tersembunyi (Di Bawah Permukaan)</div>
              <div style="font-size:1.6rem;font-weight:900;color:var(--surface)" id="iceIndirectVal">Rp 200.000.000</div>
              <div style="font-size:0.8rem;color:var(--info-bg);margin-top:6px;line-height:1.5">
                • Waktu terbuang pekerja &amp; pengawas<br>
                • Gangguan jadwal &amp; keterlambatan produksi<br>
                • Biaya rekrutmen &amp; pelatihan pengganti<br>
                • Penurunan moral tim &amp; denda regulasi
              </div>
            </div>
          </div>

          <!-- TOTAL RESULTS -->
          <div class="stat-card featured">
            <div class="stat-meta">Total Estimasi Kerugian Finansial</div>
            <div class="stat-val" id="outTotalCost">Rp 250.000.000</div>
            <div class="stat-desc">Biaya Langsung + Biaya Tersembunyi</div>
          </div>

          <div class="stat-card">
            <div class="stat-meta">Estimasi Return on Investment (ROI) K3</div>
            <div class="stat-val" id="outRoi" style="color:var(--success-dark)">566.7%</div>
            <div class="stat-desc" id="outRoiDesc">Setiap Rp 1 investasi K3 menghemat Rp 6.67 potensi kerugian</div>
          </div>

          <button type="button" class="form-input" onclick="printCostReport()" style="background:var(--orange);color:var(--surface);border:none;font-weight:700;padding:12px;cursor:pointer;margin-top:10px">
            Cetak Executive Summary untuk Direksi
          </button>

        </div>
      </div>

    </div>

    <!-- IN-DEPTH EDITORIAL ARTICLE (SEO DEPTH) -->
    <div class="editorial-box">
      <h2 class="editorial-title">Memahami Teori Gunung Es Biaya Kecelakaan Kerja (Iceberg Theory)</h2>
      <p class="editorial-p">
        Dalam manajemen keuangan dan K3, banyak pengusaha beranggapan bahwa kecelakaan kerja telah ditanggung sepenuhnya oleh asuransi (seperti BPJS Ketenagakerjaan). Pandangan keliru ini dibantah secara empiris oleh <strong>Herbert William Heinrich (1931)</strong> dan dilanjutkan oleh <strong>Frank E. Bird Jr. (1969)</strong> melalui model Teori Gunung Es (<em>The Iceberg Principle of Accident Costs</em>).
      </p>

      <h3 style="color:var(--navy);font-family:'Lexend',sans-serif;font-size:1.15rem;margin:22px 0 10px">Rincian Komponen Biaya Tidak Langsung (Indirect Costs)</h3>
      <p class="editorial-p">
        Biaya tersembunyi yang ditanggung langsung oleh kas perusahaan (tanpa dapat diklaim asuransi) meliputi:
      </p>
      <ul style="padding-left:22px;color:var(--slate-700);line-height:1.75;margin-bottom:18px">
        <li><strong>Biaya Waktu Kerja yang Hilang:</strong> Saat insiden terjadi, seluruh lini produksi berhenti. Puluhan rekan kerja berhenti bekerja untuk menonton atau menolong korban.</li>
        <li><strong>Biaya Waktu Pengawas &amp; Manajemen:</strong> Jam kerja manajer dan supervisor tersita untuk investigasi TKP, menyusun Berita Acara, berkoordinasi dengan kepolisian/Disnaker, dan hadir di sidang hukum.</li>
        <li><strong>Biaya Keterlambatan Pengiriman (Penalty Deliveries):</strong> Terhentinya mesin pabrik memicu kegagalan tenggat waktu kontrak, denda penalti keterlambatan, hingga pembatalan PO dari klien.</li>
        <li><strong>Biaya Rekrutmen &amp; Pelatihan Pengganti:</strong> Biaya mencari tenaga kerja pengganti sementara (temporary worker) dan waktu transfer keahlian (learning curve) yang lambat.</li>
        <li><strong>Kerusakan Reputasi Bisnis (Reputational Damage):</strong> Kehilangan sertifikasi, skor penilaian tender CSMS (Contractor Safety Management System) anjlok, sehingga didiskualifikasi dari proyek bernilai miliaran rupiah.</li>
      </ul>

      <!-- FAQ ACCORDION -->
      <h3 style="color:var(--navy);font-family:'Lexend',sans-serif;font-size:1.25rem;margin:28px 0 16px">Tanya Jawab Seputar Biaya Kecelakaan Kerja (FAQ)</h3>
      <div class="faq-box">
        
        <div class="faq-item">
          <button class="faq-q" onclick="toggleFaq(this)">
            <span>Apakah benar seluruh biaya kecelakaan kerja ditanggung oleh BPJS Ketenagakerjaan?</span>
            <span class="faq-icon">▼</span>
          </button>
          <div class="faq-a">
            Tidak. BPJS Ketenagakerjaan hanya menanggung biaya medis pengobatan rumah sakit (sesuai plafon) dan santunan cacat/kematian normatif. BPJS sama sekali tidak menanggung kerugian waktu produksi pabrik yang terhenti, kerusakan mesin produksi, denda keterlambatan proyek, investigasi forensik K3, maupun penurunan harga saham/reputasi bisnis perusahaan.
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-q" onclick="toggleFaq(this)">
            <span>Bagaimana cara menghitung Return on Investment (ROI) dari program K3?</span>
            <span class="faq-icon">▼</span>
          </button>
          <div class="faq-a">
            Rumus ROI K3 adalah: <code>ROI = [(Estimasi Total Biaya Kecelakaan yang Dicegah - Anggaran Biaya K3) / Anggaran Biaya K3] × 100%</code>. Dengan membuktikan bahwa program K3 menghasilkan rasio penghematan finansial nyata, manajemen keselamatan bertransformasi dari sekadar "pusat biaya" (cost center) menjadi pelindung profitabilitas bisnis (value protector).
          </div>
        </div>

      </div>

    </div>

  </div>
</section>

</main>

<?php require __DIR__ . '/../includes/footer.php'; ?>

<script>
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
    </head><body>
  <h1>EXECUTIVE REPORT: ANALISIS KERUGIAN BIAYA KECELAKAAN KERJA</h1>
  <div class="sub">Kajian Teori Gunung Es K3 (Iceberg Principle) &amp; Cost-Benefit Analysis</div>
  <table>
    <tr><th>Komponen Biaya</th><th>Estimasi Nilai Kerugian</th><th>Keterangan</th></tr>
    <tr><td>Biaya Langsung (Direct Cost)</td><td><strong>${directVal}</strong></td><td>Medis, kompensasi &amp; perbaikan fisik alat</td></tr>
    <tr><td>Biaya Tersembunyi (Indirect Cost)</td><td><strong style="color:var(--accent-dark)">${indirectVal}</strong></td><td>Model Rasio ${ratioText}</td></tr>
    <tr style="background:var(--slate-50)"><td><strong>TOTAL KERUGIAN FINANSIAL</strong></td><td style="font-size:12pt;font-weight:bold;color:var(--brand)">${totalVal}</td><td>Beban langsung terhadap kas operasional</td></tr>
    <tr><td>Return on Investment (ROI) Pencegahan</td><td style="font-weight:bold;color:var(--success-dark)">${roiVal}</td><td>Potensi proteksi kerugian per Rp 1 biaya K3</td></tr>
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
</script>

<?php require __DIR__ . '/../includes/scripts.php'; ?>
</body>
</html>
