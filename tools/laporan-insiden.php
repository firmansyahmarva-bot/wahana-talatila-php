<?php
require_once __DIR__ . '/../config.php';
$s = get_all_settings();

$page_title = 'Formulir Laporan Insiden K3 Online 2026: Investigasi 5-Why & SCAT Model';
$meta_desc = 'Buat formulir laporan investigasi kecelakaan kerja K3 resmi sesuai Permenaker 03/1998. Dilengkapi analisis akar masalah 5-Why, SCAT model, matriks CAPA, dan cetak form gratis.';

ob_start();
$page_css = array_merge($page_css ?? [], ['tools-laporan-insiden']);
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
    { "@type": "ListItem", "position": 3, "name": "Laporan Insiden", "item": "https://wahanatotalita.com/tools/laporan-insiden/" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebApplication",
  "name": "Generator Laporan & Investigasi Insiden K3 Online",
  "url": "https://wahanatotalita.com/tools/laporan-insiden/",
  "description": "Aplikasi formulir laporan kecelakaan kerja dan analisis akar penyebab 5-Why serta SCAT model sesuai regulasi Permenaker No. 03/1998.",
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
      "name": "Berapa batas waktu wajib pelaporan kecelakaan kerja ke Dinas Tenaga Kerja?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Berdasarkan Permenaker No. 03/MEN/1998 Pasal 3, pengurus atau pengusaha wajib melaporkan tiap kecelakaan kerja yang terjadi di tempat kerja kepada Kepala Kantor Departemen Tenaga Kerja setempat dalam waktu tidak lebih dari 2 x 24 jam terhitung sejak terjadinya kecelakaan."
      }
    },
    {
      "@type": "Question",
      "name": "Apa tujuan utama investigasi kecelakaan kerja?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Tujuan utama investigasi kecelakaan K3 bukanlah untuk mencari kesalahan atau menghukum individu (blame culture), melainkan untuk menemukan kelemahan sistem manajemen dan akar penyebab mendasar (root cause) guna merancang tindakan korektif dan pencegahan (CAPA) agar kecelakaan serupa tidak terulang kembali di masa depan."
      }
    },
    {
      "@type": "Question",
      "name": "Bagaimana cara melakukan analisis akar masalah menggunakan metode 5-Why?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Metode 5-Why dilakukan dengan menanyakan pertanyaan 'Mengapa?' secara beruntun minimal 5 kali terhadap suatu peristiwa. Pertanyaan pertama mengidentifikasi penyebab langsung (immediate cause), dan pertanyaan-pertanyaan berikutnya menggali lebih dalam hingga menemukan kegagalan sistemik (manajemen, pelatihan, SOP, atau pemeliharaan) sebagai akar masalah."
      }
    }
  ]
}
</script>


<?php require __DIR__ . '/../includes/navbar.php'; ?>

<main class="inc-page" id="konten-utama">

<!-- HERO -->
<section class="inc-hero">
  <div class="container">
    <div class="hero-badge">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
      Permenaker No. 03/MEN/1998 &amp; SCAT Model
    </div>
    <h1>Formulir Laporan Insiden K3 <span>&amp; 5-Why</span></h1>
    <p>Dokumentasikan kejadian kecelakaan kerja dan near miss secara profesional. Lakukan investigasi akar masalah sistemik menggunakan metode 5-Why, tetapkan Corrective &amp; Preventive Action (CAPA), dan cetak formulir resmi.</p>
    <div class="hero-tags">
      <span class="hero-tag">Kewajiban Lapor 2x24 Jam</span>
      <span class="hero-tag">SCAT Unsafe Acts &amp; Conditions</span>
      <span class="hero-tag">Analisis 5-Why Root Cause</span>
      <span class="hero-tag">Matriks Tindakan Koreksi (CAPA)</span>
    </div>
  </div>
</section>

<!-- MAIN WORKSPACE -->
<section class="inc-wrapper">
  <div class="container">
    
    <div class="card-box">
      
      <!-- STEP 1: INCIDENT METADATA -->
      <div class="card-header-line">
        <h2 class="card-title">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--orange)" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
          1. Data Umum &amp; Klasifikasi Insiden
        </h2>
        <span style="font-size:0.8rem;color:var(--slate-600)">Format Standar Disnaker &amp; BPJS TK</span>
      </div>

      <div class="form-grid-3">
        <div class="form-field">
          <label class="form-label" for="inpTipeInsiden">Kategori Tingkat Keparahan</label>
          <select id="inpTipeInsiden" class="form-input">
            <option value="LTI">Lost Time Injury (LTI - Ada Hari Hilang)</option>
            <option value="NonLTI">Medical Treatment Case (Rawat Medis / Non-LTI)</option>
            <option value="FAC">First Aid Case (Pertolongan Pertama / P3K)</option>
            <option value="NearMiss">Near Miss (Hampir Celaka / Nyaris Celaka)</option>
            <option value="Property">Kerusakan Aset / Properti</option>
            <option value="Fatal">Kecelakaan Fatal / Meninggal Dunia</option>
          </select>
        </div>
        <div class="form-field">
          <label class="form-label" for="inpTglWaktu">Tanggal &amp; Waktu Kejadian</label>
          <input type="datetime-local" id="inpTglWaktu" class="form-input">
        </div>
        <div class="form-field">
          <label class="form-label" for="inpLokasiTKP">Lokasi Spesifik TKP</label>
          <input type="text" id="inpLokasiTKP" class="form-input" value="Lantai 2 Area Mesin Pemotong Plat, Workshop A">
        </div>
      </div>

      <div class="form-grid-3">
        <div class="form-field">
          <label class="form-label" for="inpNamaKorban">Nama Lengkap Korban</label>
          <input type="text" id="inpNamaKorban" class="form-input" value="Budi Santoso">
        </div>
        <div class="form-field">
          <label class="form-label" for="inpJabatanKorban">Jabatan / Departemen</label>
          <input type="text" id="inpJabatanKorban" class="form-input" value="Operator Fabrikasi / Produksi">
        </div>
        <div class="form-field">
          <label class="form-label" for="inpBagianTubuh">Bagian Tubuh yang Mengalami Cedera</label>
          <input type="text" id="inpBagianTubuh" class="form-input" value="Telapak Tangan Kiri (Luka Robek 4 cm)">
        </div>
      </div>

      <div class="form-field">
        <label class="form-label" for="inpKronologi">Kronologi Singkat Peristiwa</label>
        <textarea id="inpKronologi" class="form-input">Saat memotong plat baja tipis berukuran 2 meter menggunakan mesin shearing hidrolik, korban mencoba menahan posisi plat yang miring dengan tangan kiri tanpa mengenakan sarung tangan tahan potong. Tangan korban terselip di bawah penjepit mesin saat pedal diinjak.</textarea>
      </div>

      <!-- STEP 2: SCAT DIRECT CAUSES -->
      <div class="card-header-line" style="margin-top:30px">
        <h2 class="card-title">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--orange)" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
          2. Penyebab Langsung (Direct Causes - SCAT Model)
        </h2>
      </div>

      <div class="form-grid-2">
        <div class="form-field">
          <label class="form-label" for="inpUnsafeAct">Tindakan Tidak Aman (Unsafe Acts)</label>
          <select id="inpUnsafeAct" class="form-input">
            <option value="Tidak Memakai APD yang Diwajibkan">Tidak Memakai APD yang Diwajibkan (Sarung Tangan)</option>
            <option value="Melepas / Melumpuhkan Pelindung Mesin">Melepas / Melumpuhkan Pelindung Mesin (Guard)</option>
            <option value="Bekerja Tergesa-gesa / Mengambil Jalan Pintas">Bekerja Tergesa-gesa / Mengambil Jalan Pintas</option>
            <option value="Mengoperasikan Alat Tanpa Wewenang/SIO">Mengoperasikan Alat Tanpa Wewenang/SIO</option>
            <option value="Posisi / Postur Kerja Salah / Janggal">Posisi / Postur Kerja Salah / Janggal</option>
          </select>
        </div>
        <div class="form-field">
          <label class="form-label" for="inpUnsafeCond">Kondisi Tidak Aman (Unsafe Conditions)</label>
          <select id="inpUnsafeCond" class="form-input">
            <option value="Pelindung Mesin (Safety Guard) Tidak Terpasang">Pelindung Mesin (Safety Guard) Tidak Terpasang</option>
            <option value="Penerangan Lampu Kurang Memadai di Area Kerja">Penerangan Lampu Kurang Memadai di Area Kerja</option>
            <option value="Lantai Kerja Licin / Ceceran Oli">Lantai Kerja Licin / Ceceran Oli</option>
            <option value="Peralatan Rusak / Aus / Modifikasi">Peralatan Rusak / Aus / Modifikasi</option>
            <option value="Housekeeping Berantakan / Celah Sempit">Housekeeping Berantakan / Celah Sempit</option>
          </select>
        </div>
      </div>

      <!-- STEP 3: 5-WHY ROOT CAUSE ANALYSIS -->
      <div class="card-header-line" style="margin-top:30px">
        <h2 class="card-title">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--orange)" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
          3. Analisis Rantai Akar Masalah (5-Why Analysis)
        </h2>
      </div>

      <div class="why-step-box">
        <div class="why-label">Why 1: Mengapa tangan korban mengalami luka robek?</div>
        <input type="text" id="why1" class="form-input" value="Karena tangan korban terjepit plat baja yang terpotong pisau hidrolik.">
      </div>
      <div class="why-step-box">
        <div class="why-label">Why 2: Mengapa tangan korban bisa mendekat ke area pisau pemotong?</div>
        <input type="text" id="why2" class="form-input" value="Karena korban menahan plat baja secara manual dengan tangan, bukan menggunakan alat bantu penjepit (clamp tool).">
      </div>
      <div class="why-step-box">
        <div class="why-label">Why 3: Mengapa korban menahan secara manual tanpa alat penjepit?</div>
        <input type="text" id="why3" class="form-input" value="Karena alat penjepit magnetik sedang rusak dan belum ada penggantinya di bengkel.">
      </div>
      <div class="why-step-box">
        <div class="why-label">Why 4: Mengapa alat penjepit rusak tidak segera diganti oleh supervisor?</div>
        <input type="text" id="why4" class="form-input" value="Karena tidak ada prosedur inspeksi pra-operasional (pre-use check) sebelum shift dimulai.">
      </div>
      <div class="why-step-box" style="border:2px solid var(--orange);background:var(--orange-light)">
        <div class="why-label" style="color:var(--orange-hover)">Why 5 (Akar Masalah Sistemik / Root Cause):</div>
        <input type="text" id="why5" class="form-input" style="font-weight:700" value="Kelemahan sistem pemeliharaan perkakas kerja dan ketiadaan verifikasi JSA/SOP pra-kerja oleh supervisor.">
      </div>

      <!-- STEP 4: CAPA TABLE -->
      <div class="card-header-line" style="margin-top:30px">
        <h2 class="card-title">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--orange)" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
          4. Tindakan Koreksi &amp; Pencegahan (CAPA)
        </h2>
      </div>

      <table class="capa-table">
        <thead>
          <tr>
            <th>Rencana Tindakan Korektif &amp; Preventif</th>
            <th style="width:180px">Penanggung Jawab (PIC)</th>
            <th style="width:140px">Target Selesai</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Pengadaan unit clamp penahan plat baja magnetik baru yang terstandarisir.</td>
            <td><strong>Dept. Procurement</strong></td>
            <td>3 Hari Kerja</td>
          </tr>
          <tr>
            <td>Pemasangan sensor interlock guard pada mesin shearing (mesin otomatis mati jika tangan mendekat).</td>
            <td><strong>Tim Maintenance</strong></td>
            <td>7 Hari Kerja</td>
          </tr>
          <tr>
            <td>Re-training SOP pemotongan plat dan kewajiban sarung tangan Cut Level 5 bagi seluruh operator.</td>
            <td><strong>HSE Officer</strong></td>
            <td>1 Minggu</td>
          </tr>
        </tbody>
      </table>

      <!-- BUTTONS -->
      <div style="display:flex;gap:12px;margin-top:24px">
        <button class="btn-submit-inc" type="button" onclick="printIncidentReport()">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
          Cetak Formulir Laporan Investigasi Resmi
        </button>
      </div>

    </div>

    <!-- IN-DEPTH EDITORIAL ARTICLE (SEO DEPTH) -->
    <div class="editorial-box">
      <h2 class="editorial-title">Prosedur Investigasi Kecelakaan Kerja Sesuai Standar K3 Nasional</h2>
      <p class="editorial-p">
        Berdasarkan <strong>Peraturan Menteri Tenaga Kerja RI No. PER.03/MEN/1998 tentang Tata Cara Pelaporan dan Pemeriksaan Kecelakaan Kerja</strong>, setiap kecelakaan yang menimpa tenaga kerja wajib dilaporkan kepada Kantor Departemen Tenaga Kerja setempat dalam kurun waktu <strong>2 x 24 jam</strong> sejak terjadinya kecelakaan.
      </p>

      <h3 style="color:var(--navy);font-family:'Lexend',sans-serif;font-size:1.15rem;margin:22px 0 10px">Prinsip Analisis SCAT (Systematic Cause Analysis Technique)</h3>
      <p class="editorial-p">
        Model SCAT membagi penyebab kecelakaan menjadi 3 lapisan kausalitas:
      </p>
      <ol style="padding-left:22px;color:var(--slate-700);line-height:1.75;margin-bottom:18px">
        <li><strong>Gejala / Dampak (Incident):</strong> Kerusakan raga, cedera fisik, atau kerugian properti.</li>
        <li><strong>Penyebab Langsung (Immediate Causes):</strong> Terdiri dari Tindakan Tidak Aman (<em>Unsafe Acts</em>) dan Kondisi Tidak Aman (<em>Unsafe Conditions</em>) di tempat kejadian perkara.</li>
        <li><strong>Akar Penyebab Dasar (Basic Causes):</strong> Faktor personal pekerja (kurang kompetensi, stres, motivasi salah) dan faktor pekerjaan (standar kerja minim, pengadaan alat kurang layak, pemeliharaan buruk).</li>
      </ol>

      <!-- FAQ ACCORDION -->
      <h3 style="color:var(--navy);font-family:'Lexend',sans-serif;font-size:1.25rem;margin:28px 0 16px">Tanya Jawab Seputar Investigasi Insiden K3 (FAQ)</h3>
      <div class="faq-box">
        
        <div class="faq-item">
          <button class="faq-q" onclick="toggleFaq(this)">
            <span>Mengapa bukti fisik di Tempat Kejadian Perkara (TKP) tidak boleh diubah sebelum difoto?</span>
            <span class="faq-icon">▼</span>
          </button>
          <div class="faq-a">
            Mengubah posisi alat, membersihkan tumpahan oli, atau membuang material di TKP sebelum diinspeksi oleh Ahli K3 atau Pengawas Ketenagakerjaan dapat menghilangkan bukti kunci mekanis dan fisik. Pasal 5 Permenaker 03/1998 melarang mengubah keadaan tempat kecelakaan kecuali untuk pertolongan darurat korban atau mencegah bahaya yang lebih besar.
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-q" onclick="toggleFaq(this)">
            <span>Siapa saja anggota tim investigasi kecelakaan kerja di perusahaan?</span>
            <span class="faq-icon">▼</span>
          </button>
          <div class="faq-a">
            Tim investigasi idealnya dipimpin oleh Ahli K3 Umum bersama Pengawas Lapangan (Supervisor area kejadian), teknisi ahli mesin terkait, perwakilan serikat pekerja/rekan kerja, serta didukung oleh Pimpinan P2K3 perusahaan.
          </div>
        </div>

      </div>

    </div>

  </div>
</section>

</main>

<?php require __DIR__ . '/../includes/footer.php'; ?>

<script>
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
  <div class="why-box" style="background:var(--accent-light);border-color:var(--accent)"><strong>Akar Masalah (Why 5):</strong> <strong>${w5}</strong></div>

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
</script>

<?php require __DIR__ . '/../includes/scripts.php'; ?>
</body>
</html>
