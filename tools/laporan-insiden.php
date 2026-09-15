<?php
require_once __DIR__ . '/../config.php';
$s = get_all_settings();
?>
<?php
$page_title = 'Form Laporan Insiden / Near Miss Online Gratis — Generator K3';
$meta_desc = 'Form laporan insiden dan near miss online gratis. Panduan langkah demi langkah investigasi 5-Why. Isi form, cetak ke PDF. Untuk HSE officer Indonesia.';
require __DIR__ . '/../includes/head.php';
?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "SoftwareApplication",
  "applicationCategory": "BusinessApplication",
  "name": "Form Laporan Insiden / Near Miss Online Gratis — Generator K3",
  "description": "Form laporan insiden dan near miss online gratis. Panduan langkah demi langkah investigasi 5-Why. Isi form, cetak ke PDF. Untuk HSE officer Indonesia.",
  "url": "https://wahanatotalita.com/tools/laporan-insiden/",
  "provider": {"@type": "Organization", "name": "Wahana Totalita", "url": "https://wahanatotalita.com"},
  "offers": {"@type": "Offer", "price": "0", "priceCurrency": "IDR"}
}
</script>
<script type="application/ld+json">
{"@context":"https://schema.org","@type":"FAQPage","mainEntity":[{"@type":"Question","name":"Apakah near miss (hampir celaka) wajib dilaporkan meskipun tidak ada cedera?","acceptedAnswer":{"@type":"Answer","text":"Ya. Near miss justru sangat penting dilaporkan karena menjadi sinyal peringatan dini sebelum kecelakaan sesungguhnya terjadi. Perusahaan dengan budaya pelaporan near miss yang kuat umumnya memiliki tingkat kecelakaan serius yang jauh lebih rendah."}},{"@type":"Question","name":"Apa itu metode 5-Why dan mengapa penting dalam investigasi insiden?","acceptedAnswer":{"@type":"Answer","text":"Metode 5-Why adalah teknik menanyakan \"mengapa\" secara berulang (biasanya lima kali) terhadap suatu masalah untuk menemukan akar penyebabnya, bukan hanya gejala permukaan. Metode ini penting agar tindakan perbaikan menyasar penyebab sistemik, bukan sekadar menyalahkan individu."}},{"@type":"Question","name":"Berapa lama batas waktu pelaporan kecelakaan kerja ke Disnaker?","acceptedAnswer":{"@type":"Answer","text":"Berdasarkan Permenaker No. 3/1998, kecelakaan kerja yang mengakibatkan korban meninggal atau cedera berat wajib dilaporkan ke Disnaker/Kemnaker setempat maksimal dalam waktu 2x24 jam sejak kejadian."}}]}
</script>
<link rel="manifest" href="/manifest.json">
<style>
:root{--primary:#1a6b3a;--primary-d:#145530;--accent:#f5a623;--bg:#f8fafc;--card:#fff;--text:#1a202c;--muted:#6b7280;--radius:12px;--shadow:0 2px 16px rgba(0,0,0,.09)}
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Segoe UI',system-ui,sans-serif;background:var(--bg);color:var(--text);line-height:1.6}
a{color:var(--primary);text-decoration:none}
.container{max-width:860px;margin:0 auto;padding:0 20px}
nav{background:#fff;border-bottom:1px solid #e5e7eb;padding:14px 0;position:sticky;top:0;z-index:100;box-shadow:0 1px 6px rgba(0,0,0,.06)}
.nav-inner{display:flex;align-items:center;justify-content:space-between}
.nav-logo{display:flex;align-items:center;gap:10px;font-weight:700;color:var(--primary);font-size:1rem}
.nav-logo svg{width:32px;height:32px}
.nav-cta{background:var(--primary);color:#fff;padding:8px 18px;border-radius:8px;font-size:.85rem;font-weight:600}
.hero{background:linear-gradient(135deg,#0f4c2a,#1a6b3a);color:#fff;padding:40px 0 30px;text-align:center}
.hero-badge{background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.25);border-radius:50px;padding:5px 16px;font-size:.8rem;font-weight:600;display:inline-block;margin-bottom:14px}
.hero h1{font-size:clamp(1.4rem,3vw,2rem);font-weight:800;margin-bottom:10px}
.hero h1 span{color:var(--accent)}
.hero p{opacity:.88;max-width:520px;margin:0 auto}
.main{padding:32px 0 80px}
.panel{background:var(--card);border-radius:var(--radius);padding:26px;box-shadow:var(--shadow);border:1px solid #e5e7eb;margin-bottom:20px}
.panel h2{font-size:1rem;font-weight:700;margin-bottom:16px;color:var(--primary)}
.grid-2{display:grid;grid-template-columns:1fr 1fr;gap:14px}
.grid-3{display:grid;grid-template-columns:1fr 1fr 1fr;gap:14px}
.form-group{margin-bottom:14px}
.form-group label{display:block;font-size:.85rem;font-weight:600;margin-bottom:5px}
.form-group input,.form-group select,.form-group textarea{width:100%;padding:9px 13px;border:2px solid #e5e7eb;border-radius:7px;font-size:.88rem;font-family:inherit;background:#fff;color:var(--text)}
.form-group input:focus,.form-group select:focus,.form-group textarea:focus{border-color:var(--primary);outline:none}
.form-group textarea{min-height:68px;resize:vertical}
.type-tabs{display:flex;gap:0;background:#f3f4f6;border-radius:8px;padding:3px;margin-bottom:16px}
.type-tab{flex:1;padding:9px 8px;border:none;background:transparent;border-radius:6px;font-size:.82rem;font-weight:600;cursor:pointer;color:var(--muted);transition:all .2s;text-align:center}
.type-tab.active{background:var(--primary);color:#fff}
.why-item{display:flex;gap:10px;align-items:flex-start;margin-bottom:10px}
.why-num{background:var(--primary);color:#fff;border-radius:50%;width:28px;height:28px;display:flex;align-items:center;justify-content:center;font-size:.82rem;font-weight:700;flex-shrink:0;margin-top:8px}
.why-item input{flex:1;padding:9px 13px;border:2px solid #e5e7eb;border-radius:7px;font-size:.88rem;background:#fff}
.why-item input:focus{border-color:var(--primary);outline:none}
.actions-bar{display:flex;gap:12px;flex-wrap:wrap;margin:20px 0}
.btn-primary{background:var(--primary);color:#fff;border:none;border-radius:8px;padding:11px 22px;font-size:.9rem;font-weight:700;cursor:pointer;display:flex;align-items:center;gap:7px}
.btn-primary:hover{background:var(--primary-d)}
.btn-secondary{background:#f3f4f6;color:var(--text);border:1px solid #e5e7eb;border-radius:8px;padding:11px 18px;font-size:.88rem;font-weight:600;cursor:pointer}
.cta-strip{background:var(--primary);color:#fff;border-radius:12px;padding:24px;text-align:center;margin:32px 0}
.cta-strip h3{font-size:1rem;font-weight:700;margin-bottom:8px}
.cta-strip p{opacity:.88;font-size:.85rem;margin-bottom:14px}
footer{background:#111827;color:#9ca3af;padding:30px 0;text-align:center;font-size:.83rem}
footer a{color:#6ee7b7}
@media(max-width:640px){.grid-2,.grid-3{grid-template-columns:1fr}}
@media print{nav,.actions-bar,footer,.cta-strip,.tools-training-cta,.tool-article{display:none!important}body{background:#fff}}
.tools-training-cta{padding:40px 0}
.tools-training-cta h2{font-size:1.3rem;font-weight:800;margin:0 0 16px;text-align:center;color:#0A4A2E}
.tools-training-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(230px,1fr));gap:16px}
.tools-training-card{background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:18px;display:flex;flex-direction:column}
.tools-training-card h3{font-size:.95rem;font-weight:700;margin:0 0 8px}
.tools-training-card h3 a{color:#0A4A2E;text-decoration:none}
.tools-training-card p{font-size:.85rem;color:#555;line-height:1.6;margin:0 0 12px;flex:1}
.tools-training-btn{display:inline-block;background:#0A4A2E;color:#fff;font-weight:700;font-size:.85rem;padding:8px 14px;border-radius:8px;text-decoration:none;text-align:center}
.tool-article{padding:12px 0 8px}
.tool-article h2{font-size:1.15rem;font-weight:800;color:var(--primary);margin:28px 0 14px}
.tool-article h2:first-child{margin-top:0}
.tool-article p{font-size:.92rem;color:#374151;line-height:1.8;margin-bottom:14px}
.tool-article ol{padding-left:20px;font-size:.92rem;line-height:1.9;color:#374151;margin-bottom:8px}
.tool-article ol li{margin-bottom:8px}
.faq-item{margin-bottom:16px}
.faq-item h3{font-size:.95rem;font-weight:700;color:var(--text);margin-bottom:6px}
.faq-item p{font-size:.9rem;color:#374151;margin:0}
</style>
<nav>
  <div class="container nav-inner">
    <a href="/" class="nav-logo">
      <svg viewBox="0 0 40 40" fill="none"><circle cx="20" cy="20" r="20" fill="#1a6b3a"/><path d="M20 8l3 9h9l-7 5 3 9-8-6-8 6 3-9-7-5h9z" fill="#f5a623"/></svg>
      Wahana Totalita
    </a>
    <a href="/tools/" style="color:var(--muted);font-size:.88rem">← Semua Tools</a>
    <a href="https://wa.me/6281235036420" target="_blank" class="nav-cta">📱 Konsultasi</a>
  </div>
</nav>

<section class="hero">
  <div class="container">
    <div class="hero-badge">⚠️ Form Laporan K3</div>
    <h1>Form <span>Laporan Insiden & Near Miss</span><br>Online Gratis</h1>
    <p>Panduan langkah demi langkah investigasi insiden. Isi form, analisis akar masalah dengan 5-Why, cetak laporan.</p>
  </div>
</section>

<section class="main">
  <div class="container">
    <div class="actions-bar">
      <button class="btn-primary" onclick="window.print()">🖨 Print / Simpan PDF</button>
      <button class="btn-secondary" onclick="clearForm()">↺ Form Baru</button>
    </div>

    <!-- JENIS LAPORAN -->
    <div class="panel">
      <h2>⚠️ Jenis Laporan</h2>
      <div class="type-tabs">
        <button class="type-tab active" id="tab-near-miss" onclick="setType('near-miss')">⚡ Near Miss / Hampir Celaka</button>
        <button class="type-tab" id="tab-first-aid" onclick="setType('first-aid')">🩹 First Aid Case (FAC)</button>
        <button class="type-tab" id="tab-lti" onclick="setType('lti')">🏥 LTI / Kecelakaan Serius</button>
        <button class="type-tab" id="tab-property" onclick="setType('property')">⚙️ Kerusakan Properti</button>
      </div>
      <div id="typeDesc" style="background:#f0fdf4;border-radius:8px;padding:12px;font-size:.83rem;color:#374151">
        <strong>Near Miss:</strong> Kejadian yang hampir menyebabkan cedera atau kerugian, namun tidak terjadi karena keberuntungan. Wajib dilaporkan untuk mencegah insiden sesungguhnya.
      </div>
    </div>

    <!-- INFORMASI INSIDEN -->
    <div class="panel">
      <h2>📋 Informasi Insiden</h2>
      <div class="grid-3">
        <div class="form-group"><label>Tanggal Kejadian</label><input type="date" id="incDate" value="<?php echo date('Y-m-d'); ?>"></div>
        <div class="form-group"><label>Waktu Kejadian</label><input type="time" id="incTime"></div>
        <div class="form-group"><label>No. Laporan</label><input type="text" id="reportNo" placeholder="cth: INC-2025-001"></div>
      </div>
      <div class="grid-2">
        <div class="form-group"><label>Lokasi Kejadian</label><input type="text" id="location" placeholder="cth: Area Produksi B, mesin press no. 5"></div>
        <div class="form-group"><label>Departemen</label><input type="text" id="dept" placeholder="cth: Departemen Produksi"></div>
      </div>
      <div class="form-group">
        <label>Deskripsi Kejadian (Apa yang terjadi? Urutan kejadian?)</label>
        <textarea id="description" placeholder="Deskripsikan urutan kejadian secara kronologis. Apa yang sedang dilakukan, apa yang terjadi, apa konsekuensinya..."></textarea>
      </div>
      <div class="grid-2">
        <div class="form-group"><label>Kondisi Cuaca / Lingkungan</label><input type="text" id="weather" placeholder="cth: Cuaca cerah, lantai kering, pencahayaan baik"></div>
        <div class="form-group"><label>Saksi (nama)</label><input type="text" id="witnesses" placeholder="cth: Budi Santoso, Ahmad Rahman"></div>
      </div>
    </div>

    <!-- DATA KORBAN -->
    <div class="panel" id="victimSection">
      <h2>🧑 Data Korban / Orang yang Terlibat</h2>
      <div class="grid-3">
        <div class="form-group"><label>Nama</label><input type="text" id="victimName" placeholder="Nama korban"></div>
        <div class="form-group"><label>Jabatan / Pekerjaan</label><input type="text" id="victimJob" placeholder="cth: Operator Mesin"></div>
        <div class="form-group"><label>Masa Kerja</label><input type="text" id="victimTenure" placeholder="cth: 2 tahun 3 bulan"></div>
      </div>
      <div class="grid-2">
        <div class="form-group"><label>Cedera yang Diderita (jika ada)</label><input type="text" id="injury" placeholder="cth: Luka lecet di tangan kiri, 3 cm"></div>
        <div class="form-group"><label>Bagian Tubuh yang Terkena</label><input type="text" id="bodyPart" placeholder="cth: Tangan kiri, jari telunjuk"></div>
      </div>
      <div class="grid-2">
        <div class="form-group"><label>Penanganan Medis yang Diberikan</label><input type="text" id="medTreatment" placeholder="cth: P3K di klinik perusahaan, bebat luka"></div>
        <div class="form-group"><label>APD yang Dipakai Saat Kejadian</label><input type="text" id="ppeWorn" placeholder="cth: Helm, sepatu safety (tidak pakai sarung tangan)"></div>
      </div>
    </div>

    <!-- ANALISIS AKAR MASALAH 5-WHY -->
    <div class="panel">
      <h2>🔍 Analisis Akar Masalah — Metode 5-Why</h2>
      <p style="font-size:.82rem;color:var(--muted);margin-bottom:16px">Mulai dari masalah, tanyakan "mengapa?" hingga menemukan akar masalah sesungguhnya.</p>

      <div class="form-group">
        <label>Masalah / Insiden (titik awal)</label>
        <input type="text" id="problem" placeholder="cth: Pekerja terpeleset dan jatuh di area produksi">
      </div>

      <div id="whyContainer">
        <div class="why-item"><div class="why-num">1</div><input type="text" id="why1" placeholder="Mengapa kejadian ini bisa terjadi?"></div>
        <div class="why-item"><div class="why-num">2</div><input type="text" id="why2" placeholder="Mengapa hal pada #1 bisa terjadi?"></div>
        <div class="why-item"><div class="why-num">3</div><input type="text" id="why3" placeholder="Mengapa hal pada #2 bisa terjadi?"></div>
        <div class="why-item"><div class="why-num">4</div><input type="text" id="why4" placeholder="Mengapa hal pada #3 bisa terjadi?"></div>
        <div class="why-item"><div class="why-num">5</div><input type="text" id="why5" placeholder="Mengapa hal pada #4 bisa terjadi? (Akar Masalah)"></div>
      </div>

      <div class="form-group" style="margin-top:16px">
        <label>Akar Masalah / Root Cause (kesimpulan)</label>
        <textarea id="rootCause" placeholder="Simpulkan akar masalah sesungguhnya dari analisis 5-Why di atas..."></textarea>
      </div>
    </div>

    <!-- TINDAKAN PERBAIKAN -->
    <div class="panel">
      <h2>✅ Tindakan Perbaikan & Pencegahan (CAPA)</h2>
      <div class="form-group">
        <label>Corrective Action — Tindakan untuk memperbaiki yang sudah terjadi</label>
        <textarea id="corrective" placeholder="cth: 1) Bersihkan tumpahan oli segera. 2) Pasang rambu lantai licin. 3) Audit APD pekerja area tersebut..."></textarea>
      </div>
      <div class="form-group">
        <label>Preventive Action — Tindakan untuk mencegah kejadian serupa</label>
        <textarea id="preventive" placeholder="cth: 1) Buat prosedur pembersihan tumpahan dalam 15 menit. 2) Inspeksi mingguan kondisi lantai. 3) Sediakan absorbent di setiap mesin..."></textarea>
      </div>
      <div class="grid-3">
        <div class="form-group"><label>PIC CAPA</label><input type="text" id="capaPIC" placeholder="Nama PIC"></div>
        <div class="form-group"><label>Target Selesai</label><input type="date" id="capaTarget"></div>
        <div class="form-group"><label>Status</label>
          <select id="capaStatus">
            <option value="open">Open</option>
            <option value="in-progress">In Progress</option>
            <option value="closed">Closed</option>
          </select>
        </div>
      </div>
    </div>

    <!-- APPROVALS -->
    <div class="panel">
      <h2>✍️ Dibuat & Disetujui Oleh</h2>
      <div class="grid-3">
        <div class="form-group"><label>Dilaporkan Oleh</label><input type="text" id="reportedBy" placeholder="Nama + Jabatan"></div>
        <div class="form-group"><label>Supervisor / Atasan Langsung</label><input type="text" id="supervisorName" placeholder="Nama + Jabatan"></div>
        <div class="form-group"><label>HSE Officer / Manager</label><input type="text" id="hseOfficer" placeholder="Nama + Jabatan"></div>
      </div>
    </div>

    <div class="actions-bar">
      <button class="btn-primary" onclick="window.print()">🖨 Print / Simpan PDF</button>
      <button class="btn-secondary" onclick="clearForm()">↺ Form Baru</button>
    </div>

    <div class="cta-strip">
      <h3>🎓 Pelajari Investigasi Insiden Secara Profesional</h3>
      <p>Pelatihan Ahli K3 Umum KEMNAKER RI mencakup metodologi investigasi kecelakaan, CAPA, dan pelaporan K3 yang benar.</p>
      <a href="https://wa.me/6281235036420?text=Halo%20Wahana%2C%20saya%20pakai%20form%20laporan%20insiden%20dan%20ingin%20tanya%20pelatihan%20K3" target="_blank" rel="noopener"
         style="background:#25D366;color:#fff;padding:11px 24px;border-radius:8px;font-weight:700;display:inline-flex;align-items:center;gap:8px">
        📱 Tanya Pelatihan Investigasi K3
      </a>
    </div>
  </div>
</section>

<section class="tool-article">
  <div class="container">
    <h2>Cara Menggunakan Form Laporan Insiden</h2>
    <ol>
      <li>Pilih Jenis Laporan yang sesuai — Near Miss, First Aid Case, LTI/Kecelakaan Serius, atau Kerusakan Properti.</li>
      <li>Isi Informasi Insiden: tanggal, waktu, nomor laporan, lokasi kejadian, departemen, deskripsi kronologis, kondisi lingkungan, dan saksi.</li>
      <li>Jika ada korban, lengkapi Data Korban — nama, jabatan, masa kerja, cedera yang diderita, bagian tubuh terkena, penanganan medis, dan APD yang dipakai saat kejadian.</li>
      <li>Lakukan Analisis Akar Masalah dengan metode 5-Why — mulai dari masalah, lalu tanyakan "mengapa?" hingga lima tingkat untuk menemukan akar masalah sesungguhnya.</li>
      <li>Tuliskan Tindakan Perbaikan (Corrective Action) dan Tindakan Pencegahan (Preventive Action), lengkap dengan PIC, target selesai, dan status CAPA.</li>
      <li>Lengkapi bagian tanda tangan (dilaporkan oleh, supervisor, HSE Officer), lalu klik "Print / Simpan PDF" untuk mencetak laporan resmi.</li>
    </ol>

    <h2>Manfaat Form Laporan Insiden untuk Keselamatan Kerja</h2>
    <p>Melaporkan insiden — termasuk near miss sekalipun — adalah fondasi dari budaya K3 yang proaktif. Statistik keselamatan kerja menunjukkan bahwa untuk setiap satu kecelakaan serius, ada ratusan near miss yang mendahuluinya. Form Laporan Insiden ini membantu perusahaan menangkap kejadian-kejadian kecil sebelum berkembang menjadi kecelakaan fatal.</p>
    <p>Dengan struktur form yang konsisten, setiap insiden dicatat dengan detail yang sama — kronologi, korban, kondisi lingkungan, dan saksi — sehingga data insiden bisa dianalisis secara agregat untuk melihat pola atau area berisiko tinggi dari waktu ke waktu.</p>
    <p>Fitur analisis 5-Why yang terintegrasi mendorong tim K3 untuk tidak berhenti pada penyebab permukaan (misalnya "pekerja lalai"), melainkan menggali hingga akar masalah sistemik — seperti kurangnya prosedur, pelatihan, atau perawatan alat — yang jika tidak diperbaiki akan terus menyebabkan insiden berulang.</p>
    <p>Dokumentasi CAPA (Corrective and Preventive Action) yang lengkap dengan PIC dan target waktu juga memastikan tindak lanjut investigasi benar-benar dijalankan, bukan hanya menjadi laporan yang berhenti di atas kertas — sekaligus menjadi bukti kepatuhan saat audit SMK3.</p>

    <h2>Dasar Hukum yang Relevan</h2>
    <p>Kewajiban pelaporan dan investigasi kecelakaan kerja diatur dalam Permenaker No. 3 Tahun 1998 tentang Tata Cara Pelaporan dan Pemeriksaan Kecelakaan, yang mewajibkan pengusaha melaporkan kecelakaan kerja ke Disnaker setempat maksimal 2x24 jam untuk kasus fatal/berat. Kewajiban dasar penyediaan sistem pelaporan dan investigasi insiden juga menjadi bagian dari elemen pemantauan dan evaluasi dalam PP No. 50 Tahun 2012 tentang SMK3. Keterlambatan atau kelalaian pelaporan dapat berakibat sanksi administratif bagi perusahaan, sehingga sistem pencatatan insiden yang rapi dan tepat waktu menjadi bagian penting dari kepatuhan hukum K3.</p>

    <h2>Pertanyaan Umum</h2>
    <div class="faq-item">
      <h3>Apakah near miss (hampir celaka) wajib dilaporkan meskipun tidak ada cedera?</h3>
      <p>Ya. Near miss justru sangat penting dilaporkan karena menjadi sinyal peringatan dini sebelum kecelakaan sesungguhnya terjadi. Perusahaan dengan budaya pelaporan near miss yang kuat umumnya memiliki tingkat kecelakaan serius yang jauh lebih rendah.</p>
    </div>
    <div class="faq-item">
      <h3>Apa itu metode 5-Why dan mengapa penting dalam investigasi insiden?</h3>
      <p>Metode 5-Why adalah teknik menanyakan "mengapa" secara berulang (biasanya lima kali) terhadap suatu masalah untuk menemukan akar penyebabnya, bukan hanya gejala permukaan. Metode ini penting agar tindakan perbaikan menyasar penyebab sistemik, bukan sekadar menyalahkan individu.</p>
    </div>
    <div class="faq-item">
      <h3>Berapa lama batas waktu pelaporan kecelakaan kerja ke Disnaker?</h3>
      <p>Berdasarkan Permenaker No. 3/1998, kecelakaan kerja yang mengakibatkan korban meninggal atau cedera berat wajib dilaporkan ke Disnaker/Kemnaker setempat maksimal dalam waktu 2x24 jam sejak kejadian. Laporan awal dapat menyusul dengan laporan lengkap setelah investigasi selesai dilakukan.</p>
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
    <p><a href="/tools/">← Semua Tools K3</a> | <a href="/tools/risk-matrix">Risk Matrix</a> | <a href="/tools/jsa-builder">JSA Builder</a> | <a href="/">Wahana Totalita</a></p>
    <p style="margin-top:8px">© <?php echo date('Y'); ?> Wahana Totalita Konsultan, Yogyakarta</p>
  </div>
</footer>

<a href="https://wa.me/6281235036420" target="_blank" style="position:fixed;bottom:24px;right:24px;background:#25D366;width:52px;height:52px;border-radius:50%;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 14px rgba(37,211,102,.4);z-index:999">
  <svg viewBox="0 0 24 24" fill="white" width="26" height="26"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
</a>

<script>
const typeDescs = {
  'near-miss': '<strong>Near Miss:</strong> Kejadian yang hampir menyebabkan cedera atau kerugian, namun tidak terjadi. Wajib dilaporkan untuk mencegah insiden sesungguhnya.',
  'first-aid': '<strong>First Aid Case (FAC):</strong> Cedera ringan yang ditangani dengan P3K, tidak memerlukan penanganan medis lebih lanjut dan tidak absen.',
  'lti': '<strong>LTI (Lost Time Injury):</strong> Cedera yang menyebabkan korban tidak dapat bekerja minimal 1 hari kerja setelah kejadian. Wajib investigasi mendalam.',
  'property': '<strong>Kerusakan Properti:</strong> Insiden yang menyebabkan kerusakan peralatan, mesin, atau aset perusahaan tanpa cedera manusia.',
};

function setType(t){
  document.querySelectorAll('.type-tab').forEach(b=>b.classList.remove('active'));
  document.getElementById(`tab-${t}`).classList.add('active');
  document.getElementById('typeDesc').innerHTML = typeDescs[t];
}

function clearForm(){
  if(!confirm('Reset semua data form?')) return;
  document.querySelectorAll('input,select,textarea').forEach(el=>{
    if(el.type==='date') el.value=new Date().toISOString().split('T')[0];
    else if(el.tagName==='SELECT') el.selectedIndex=0;
    else el.value='';
  });
}
</script>
</body>
</html>
