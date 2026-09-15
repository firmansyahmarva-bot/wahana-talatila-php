<?php
require_once __DIR__ . '/../config.php';
$s = get_all_settings();
?>
<?php
$page_title = 'Database Regulasi K3 Indonesia — Peraturan K3 Lengkap';
$meta_desc = 'Database regulasi K3 Indonesia yang dapat dicari: UU, PP, Permenaker, Kepmenaker tentang K3. Ringkasan, pasal penting, dan sanksi. Update 2024. Gratis untuk HSE officer.';
require __DIR__ . '/../includes/head.php';
?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "SoftwareApplication",
  "applicationCategory": "BusinessApplication",
  "name": "Database Regulasi K3 Indonesia — Peraturan K3 Lengkap",
  "description": "Database regulasi K3 Indonesia yang dapat dicari: UU, PP, Permenaker, Kepmenaker tentang K3. Ringkasan, pasal penting, dan sanksi. Update 2024. Gratis untuk HSE officer.",
  "url": "https://wahanatotalita.com/tools/regulasi-k3/",
  "provider": {"@type": "Organization", "name": "Wahana Totalita", "url": "https://wahanatotalita.com"},
  "offers": {"@type": "Offer", "price": "0", "priceCurrency": "IDR"}
}
</script>
<script type="application/ld+json">
{"@context":"https://schema.org","@type":"FAQPage","mainEntity":[{"@type":"Question","name":"Apakah database ini mencakup semua regulasi K3 yang berlaku di Indonesia?","acceptedAnswer":{"@type":"Answer","text":"Database ini mencakup lebih dari 40 regulasi K3 yang paling sering dibutuhkan HSE Officer, mulai dari UU dasar hingga Permenaker teknis terbaru. Namun untuk topik yang sangat spesifik atau regulasi sektoral tertentu, disarankan tetap merujuk ke JDIH Kemnaker untuk daftar lengkap dan terkini."}},{"@type":"Question","name":"Apakah ringkasan di database ini bisa dijadikan rujukan hukum resmi?","acceptedAnswer":{"@type":"Answer","text":"Ringkasan di database ini disusun untuk memudahkan pemahaman awal, bukan pengganti teks resmi peraturan. Untuk keperluan hukum, audit, atau kepatuhan formal, selalu rujuk pada naskah resmi regulasi dari Kemnaker atau lembaran negara."}},{"@type":"Question","name":"Seberapa sering database regulasi ini diperbarui?","acceptedAnswer":{"@type":"Answer","text":"Database ini diperbarui setiap kali ada regulasi K3 baru atau revisi signifikan terbit dari Kementerian Ketenagakerjaan, sehingga HSE Officer tetap mendapat referensi yang relevan dengan perkembangan regulasi terkini."}}]}
</script>
<link rel="manifest" href="/manifest.json">
<style>
:root{--primary:#1a6b3a;--primary-d:#145530;--accent:#f5a623;--bg:#f8fafc;--card:#fff;--text:#1a202c;--muted:#6b7280;--radius:12px;--shadow:0 2px 16px rgba(0,0,0,.09)}
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Segoe UI',system-ui,sans-serif;background:var(--bg);color:var(--text);line-height:1.6}
a{color:var(--primary);text-decoration:none}
.container{max-width:1060px;margin:0 auto;padding:0 20px}
nav{background:#fff;border-bottom:1px solid #e5e7eb;padding:14px 0;position:sticky;top:0;z-index:100;box-shadow:0 1px 6px rgba(0,0,0,.06)}
.nav-inner{display:flex;align-items:center;justify-content:space-between}
.nav-logo{display:flex;align-items:center;gap:10px;font-weight:700;color:var(--primary);font-size:1rem}
.nav-logo svg{width:32px;height:32px}
.nav-cta{background:var(--primary);color:#fff;padding:8px 18px;border-radius:8px;font-size:.85rem;font-weight:600}
.hero{background:linear-gradient(135deg,#0f4c2a,#1a6b3a);color:#fff;padding:44px 0 32px;text-align:center}
.hero-badge{background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.25);border-radius:50px;padding:5px 16px;font-size:.8rem;font-weight:600;display:inline-block;margin-bottom:14px}
.hero h1{font-size:clamp(1.5rem,3vw,2.2rem);font-weight:800;margin-bottom:10px}
.hero h1 span{color:var(--accent)}
.hero p{opacity:.88;max-width:560px;margin:0 auto}
.main{padding:36px 0 80px}
.filter-bar{display:flex;gap:12px;flex-wrap:wrap;margin-bottom:24px;align-items:center}
.filter-bar input{flex:1;min-width:200px;padding:10px 16px;border:2px solid #e5e7eb;border-radius:8px;font-size:.9rem;background:#fff}
.filter-bar input:focus{border-color:var(--primary);outline:none}
.cat-btn{background:#fff;border:2px solid #e5e7eb;border-radius:50px;padding:7px 16px;font-size:.82rem;font-weight:600;cursor:pointer;color:var(--muted);transition:all .2s;white-space:nowrap}
.cat-btn.active,.cat-btn:hover{background:var(--primary);border-color:var(--primary);color:#fff}
.stats-bar{display:flex;gap:16px;flex-wrap:wrap;margin-bottom:24px}
.stat-chip{background:#f0fdf4;border:1px solid #86efac;border-radius:8px;padding:8px 16px;font-size:.82rem;font-weight:600;color:var(--primary)}
.reg-table{width:100%;border-collapse:collapse;font-size:.85rem}
.reg-table th{background:var(--primary);color:#fff;padding:11px 14px;text-align:left;font-size:.8rem;white-space:nowrap}
.reg-table td{padding:11px 14px;border-bottom:1px solid #f3f4f6;vertical-align:top}
.reg-table tr:hover td{background:#f9fafb}
.badge-uu{background:#dcfce7;color:#16a34a;padding:2px 10px;border-radius:50px;font-size:.72rem;font-weight:700;white-space:nowrap}
.badge-pp{background:#dbeafe;color:#2563eb;padding:2px 10px;border-radius:50px;font-size:.72rem;font-weight:700;white-space:nowrap}
.badge-permenaker{background:#ede9fe;color:#7c3aed;padding:2px 10px;border-radius:50px;font-size:.72rem;font-weight:700;white-space:nowrap}
.badge-kepmenaker{background:#fef3c7;color:#b45309;padding:2px 10px;border-radius:50px;font-size:.72rem;font-weight:700;white-space:nowrap}
.badge-iso{background:#ffedd5;color:#c2410c;padding:2px 10px;border-radius:50px;font-size:.72rem;font-weight:700;white-space:nowrap}
.reg-num{font-weight:700;color:var(--primary);font-size:.85rem}
.reg-title{font-size:.85rem;line-height:1.4}
.reg-summary{font-size:.78rem;color:var(--muted);margin-top:3px;line-height:1.5}
.hidden-row{display:none}
.cta-strip{background:var(--primary);color:#fff;border-radius:12px;padding:24px;text-align:center;margin:36px 0}
.cta-strip h3{font-size:1rem;font-weight:700;margin-bottom:8px}
.cta-strip p{opacity:.88;font-size:.85rem;margin-bottom:14px}
footer{background:#111827;color:#9ca3af;padding:30px 0;text-align:center;font-size:.83rem}
footer a{color:#6ee7b7}
@media print{nav,footer,.cta-strip,.tools-training-cta,.tool-article{display:none!important}}
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
    <div class="hero-badge">⚖️ Database Regulasi K3</div>
    <h1>Database <span>Regulasi K3</span><br>Indonesia Lengkap</h1>
    <p>Cari peraturan K3 — UU, PP, Permenaker, Kepmenaker — beserta ringkasan dan pasal penting. Update 2024. Gratis.</p>
  </div>
</section>

<section class="main">
  <div class="container">
    <div class="filter-bar">
      <input type="text" id="regSearch" placeholder="🔍 Cari regulasi... (cth: K3, SMK3, kebakaran, ketinggian, listrik)" oninput="filterReg()">
      <button class="cat-btn active" onclick="filterCat(this,'all')">Semua</button>
      <button class="cat-btn" onclick="filterCat(this,'uu')">UU</button>
      <button class="cat-btn" onclick="filterCat(this,'pp')">PP</button>
      <button class="cat-btn" onclick="filterCat(this,'permenaker')">Permenaker</button>
      <button class="cat-btn" onclick="filterCat(this,'kepmenaker')">Kepmenaker</button>
    </div>

    <div class="stats-bar">
      <div class="stat-chip">📋 <span id="regCount">40+</span> Regulasi</div>
      <div class="stat-chip">🔄 Update: 2024</div>
      <div class="stat-chip">🔍 Bisa dicari & difilter</div>
    </div>

    <div style="overflow-x:auto">
      <table class="reg-table">
        <thead>
          <tr><th>Jenis</th><th>Nomor & Tahun</th><th>Judul</th><th>Ringkasan & Poin Penting</th></tr>
        </thead>
        <tbody id="regBody"></tbody>
      </table>
    </div>

    <div class="cta-strip">
      <h3>🎓 Pahami Regulasi K3 Lebih Dalam</h3>
      <p>Pelatihan Ahli K3 Umum KEMNAKER RI memberikan pemahaman mendalam tentang regulasi K3 dan implementasi SMK3 di tempat kerja.</p>
      <a href="https://wa.me/6281235036420?text=Halo%20Wahana%2C%20saya%20gunakan%20database%20regulasi%20K3%20dan%20ingin%20tanya%20pelatihan%20K3" target="_blank" rel="noopener"
         style="background:#25D366;color:#fff;padding:11px 24px;border-radius:8px;font-weight:700;display:inline-flex;align-items:center;gap:8px">
        📱 Tanya Pelatihan Ahli K3 Umum
      </a>
    </div>
  </div>
</section>

<section class="tool-article">
  <div class="container">
    <h2>Cara Menggunakan Database Regulasi K3</h2>
    <ol>
      <li>Gunakan kolom pencarian untuk mengetik kata kunci — nama regulasi, nomor, atau topik (cth: kebisingan, ketinggian, listrik, kebakaran).</li>
      <li>Filter berdasarkan jenis regulasi dengan tombol kategori: UU, PP, Permenaker, atau Kepmenaker.</li>
      <li>Baca ringkasan singkat setiap regulasi pada kolom "Ringkasan & Poin Penting" untuk memahami inti pengaturannya tanpa membuka dokumen aslinya.</li>
      <li>Kombinasikan pencarian kata kunci dengan filter kategori untuk mempersempit hasil sesuai kebutuhan spesifik Anda.</li>
      <li>Gunakan hasil pencarian sebagai referensi awal, lalu rujuk dokumen resmi regulasi tersebut (dari Kemnaker atau JDIH) untuk kepastian hukum.</li>
    </ol>

    <h2>Manfaat Database Regulasi K3 untuk Keselamatan Kerja</h2>
    <p>Regulasi K3 di Indonesia tersebar dalam puluhan Undang-Undang, Peraturan Pemerintah, Peraturan Menteri Ketenagakerjaan (Permenaker), dan Keputusan Menteri Ketenagakerjaan (Kepmenaker) yang terbit dari tahun 1970 hingga saat ini. Bagi HSE Officer, mengingat dan menemukan regulasi yang tepat untuk situasi tertentu — misalnya batas kebisingan, syarat APAR, atau prosedur LOTO — bisa memakan waktu lama jika harus mencari satu per satu di berbagai sumber.</p>
    <p>Database Regulasi K3 ini mengumpulkan lebih dari 40 regulasi penting dalam satu tempat, lengkap dengan ringkasan poin-poin utamanya, sehingga bisa langsung dicari dan difilter berdasarkan jenis dan topik. Ini sangat membantu saat menyusun dokumen K3 seperti IBPR, JSA, atau SOP yang mengharuskan pencantuman dasar hukum yang relevan.</p>
    <p>Memahami regulasi yang berlaku juga penting untuk memastikan perusahaan tidak melanggar ketentuan yang dapat berakibat sanksi administratif, pencabutan izin usaha, hingga sanksi pidana — terutama untuk regulasi terkait bahan kimia berbahaya, pengelolaan limbah B3, dan keselamatan konstruksi yang memiliki konsekuensi hukum yang cukup berat.</p>
    <p>Database ini juga bermanfaat sebagai bahan persiapan sebelum audit SMK3, sertifikasi Ahli K3, atau saat menyusun kebijakan K3 perusahaan yang harus selaras dengan regulasi nasional terbaru.</p>

    <h2>Dasar Hukum yang Relevan</h2>
    <p>UU No. 1 Tahun 1970 tentang Keselamatan Kerja adalah payung hukum utama yang menjadi dasar seluruh regulasi turunan K3 di Indonesia, termasuk PP No. 50 Tahun 2012 tentang SMK3 dan berbagai Peraturan Menteri Ketenagakerjaan yang mengatur aspek teknis K3 secara lebih spesifik. Memahami hierarki regulasi ini — dari undang-undang, peraturan pemerintah, hingga peraturan menteri — membantu HSE Officer menentukan regulasi mana yang menjadi acuan utama versus acuan teknis pelengkap untuk setiap topik K3.</p>

    <h2>Pertanyaan Umum</h2>
    <div class="faq-item">
      <h3>Apakah database ini mencakup semua regulasi K3 yang berlaku di Indonesia?</h3>
      <p>Database ini mencakup lebih dari 40 regulasi K3 yang paling sering dibutuhkan HSE Officer, mulai dari UU dasar hingga Permenaker teknis terbaru. Namun untuk topik yang sangat spesifik atau regulasi sektoral tertentu, disarankan tetap merujuk ke JDIH Kemnaker untuk daftar lengkap dan terkini.</p>
    </div>
    <div class="faq-item">
      <h3>Apakah ringkasan di database ini bisa dijadikan rujukan hukum resmi?</h3>
      <p>Ringkasan di database ini disusun untuk memudahkan pemahaman awal, bukan pengganti teks resmi peraturan. Untuk keperluan hukum, audit, atau kepatuhan formal, selalu rujuk pada naskah resmi regulasi dari Kemnaker atau lembaran negara.</p>
    </div>
    <div class="faq-item">
      <h3>Seberapa sering database regulasi ini diperbarui?</h3>
      <p>Database ini diperbarui setiap kali ada regulasi K3 baru atau revisi signifikan terbit dari Kementerian Ketenagakerjaan, sehingga HSE Officer tetap mendapat referensi yang relevan dengan perkembangan regulasi terkini. Perubahan regulasi yang menggantikan peraturan lama juga dicatat agar pengguna tidak salah merujuk ke aturan yang sudah tidak berlaku.</p>
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
    <p><a href="/tools/">← Semua Tools K3</a> | <a href="/artikel/perbedaan-sertifikasi-kemnaker-dan-bnsp/">KEMNAKER vs BNSP</a> | <a href="/">Wahana Totalita</a></p>
    <p style="margin-top:8px">© <?php echo date('Y'); ?> Wahana Totalita Konsultan, Yogyakarta</p>
  </div>
</footer>

<a href="https://wa.me/6281235036420" target="_blank" style="position:fixed;bottom:24px;right:24px;background:#25D366;width:52px;height:52px;border-radius:50%;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 14px rgba(37,211,102,.4);z-index:999">
  <svg viewBox="0 0 24 24" fill="white" width="26" height="26"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
</a>

<script>
const regs = [
  {type:'uu',no:'UU No.1/1970',title:'Keselamatan Kerja',summary:'Undang-undang dasar K3 di Indonesia. Mengatur kewajiban pengusaha, hak pekerja, syarat K3, dan pengawasan K3. Berlaku di semua tempat kerja.'},
  {type:'uu',no:'UU No.13/2003',title:'Ketenagakerjaan',summary:'Mengatur perlindungan tenaga kerja termasuk keselamatan dan kesehatan kerja, jam kerja, istirahat, dan kompensasi kecelakaan.'},
  {type:'uu',no:'UU No.36/2009',title:'Kesehatan (termasuk Kesehatan Kerja)',summary:'Pasal 164-166 mengatur K3 di tempat kerja, kewajiban pemeriksaan kesehatan, dan hak pekerja atas lingkungan kerja yang sehat.'},
  {type:'uu',no:'UU No.32/2009',title:'Perlindungan dan Pengelolaan Lingkungan Hidup',summary:'Mengatur pengelolaan limbah B3, izin lingkungan, dan sanksi pidana untuk pelanggaran lingkungan.'},
  {type:'uu',no:'UU No.3/1992',title:'Jaminan Sosial Tenaga Kerja (Jamsostek)',summary:'Dasar jaminan kecelakaan kerja (JKK), jaminan kematian, dan jaminan hari tua. Kini telah digantikan oleh BPJS Ketenagakerjaan.'},
  {type:'pp',no:'PP No.50/2012',title:'Penerapan Sistem Manajemen Keselamatan dan Kesehatan Kerja (SMK3)',summary:'Regulasi utama SMK3 di Indonesia. Wajib bagi perusahaan dengan ≥100 karyawan atau risiko tinggi. Mencakup 12 elemen SMK3 dan audit internal/eksternal.'},
  {type:'pp',no:'PP No.44/2015',title:'Penyelenggaraan Program Jaminan Kecelakaan Kerja (JKK) dan Jaminan Kematian',summary:'Mengatur manfaat JKK, tata cara klaim, besaran santunan, dan prosedur pelaporan kecelakaan ke BPJS Ketenagakerjaan.'},
  {type:'pp',no:'PP No.88/2019',title:'Kesehatan Kerja',summary:'Mengatur upaya kesehatan kerja: pemeriksaan kesehatan awal dan berkala, program kesehatan kerja, dan kewajiban perusahaan dalam bidang kesehatan kerja.'},
  {type:'pp',no:'PP No.36/2005',title:'Pelaksanaan UU Bangunan Gedung (termasuk K3 Konstruksi)',summary:'Mengatur K3 konstruksi bangunan gedung, prosedur izin, keselamatan struktur, dan instalasi.'},
  {type:'permenaker',no:'Permenaker No.5/2018',title:'K3 Lingkungan Kerja — NAB Faktor Fisika dan Kimia',summary:'Menetapkan Nilai Ambang Batas (NAB) untuk kebisingan (85 dB/8 jam), debu, bahan kimia, suhu, pencahayaan, getaran, dan radiasi di tempat kerja.'},
  {type:'permenaker',no:'Permenaker No.1/1980',title:'K3 pada Konstruksi Bangunan',summary:'Syarat K3 di sektor konstruksi: scaffolding, penggalian, pekerjaan atap, alat berat, dan pelindungan jatuh.'},
  {type:'permenaker',no:'Permenaker No.2/1980',title:'Pemeriksaan Kesehatan Tenaga Kerja',summary:'Kewajiban pemeriksaan kesehatan awal (sebelum bekerja), berkala (minimal 1 tahun), dan khusus untuk pekerja di pekerjaan berbahaya.'},
  {type:'permenaker',no:'Permenaker No.4/1980',title:'Syarat Pemasangan dan Pemeliharaan APAR',summary:'Spesifikasi teknis APAR, jarak penempatan (max 23m), ketinggian pemasangan (125cm), klasifikasi kebakaran, dan kewajiban inspeksi.'},
  {type:'permenaker',no:'Permenaker No.1/1982',title:'Bejana Tekan (Pressure Vessel)',summary:'Syarat teknis bejana bertekanan, prosedur pengujian, izin pemakaian, dan kewajiban operator. Bejana tekan wajib dapat sertifikat dari Disnaker.'},
  {type:'permenaker',no:'Permenaker No.2/1982',title:'Kualifikasi Juru Las di Tempat Kerja',summary:'Syarat kompetensi juru las, ujian kualifikasi, dan jenis sertifikat juru las untuk pekerjaan las di industri.'},
  {type:'permenaker',no:'Permenaker No.5/1985',title:'Pesawat Angkat dan Angkut (Crane, Forklift)',summary:'Syarat teknis pesawat angkat, kualifikasi operator crane/forklift, inspeksi berkala, dan batas beban aman (SWL).'},
  {type:'permenaker',no:'Permenaker No.1/1989',title:'Kualifikasi dan Syarat Operator K3 Ketinggian',summary:'Kualifikasi operator scaffolding, tower crane, gondola, dan persyaratan K3 bekerja di ketinggian.'},
  {type:'permenaker',no:'Permenaker No.3/1998',title:'Tata Cara Pelaporan dan Pemeriksaan Kecelakaan',summary:'Prosedur pelaporan kecelakaan kerja ke Disnaker: dalam 2x24 jam (kecelakaan fatal/berat), investigasi, dan laporan akhir.'},
  {type:'permenaker',no:'Permenaker No.8/2010',title:'Alat Pelindung Diri (APD)',summary:'Kewajiban pengusaha menyediakan APD, jenis APD yang diakui, standar APD, dan kewajiban pekerja menggunakan APD.'},
  {type:'permenaker',no:'Permenaker No.9/2010',title:'Operator dan Petugas Pesawat Angkat-Angkut',summary:'Syarat kompetensi operator crane, forklift, hoist, dan pesawat angkat lainnya. Sertifikat operator wajib dari KEMNAKER.'},
  {type:'permenaker',no:'Permenaker No.13/2011',title:'NAB Faktor Fisika dan Faktor Kimia di Tempat Kerja',summary:'Update NAB kimia — TLV-TWA, TLV-STEL, dan TLV-C untuk 600+ bahan kimia. Pedoman higiene industri Indonesia.'},
  {type:'permenaker',no:'Permenaker No.7/2020',title:'Rencana Keselamatan Konstruksi',summary:'Mengatur Rencana Keselamatan Konstruksi (RKK) yang wajib dibuat untuk proyek konstruksi di Indonesia.'},
  {type:'permenaker',no:'Permenaker No.10/2020',title:'K3 Instalasi Listrik',summary:'Syarat K3 instalasi listrik, kualifikasi teknisi listrik, prosedur LOTO, dan pemeriksaan instalasi berkala.'},
  {type:'kepmenaker',no:'Kepmenaker No.187/1999',title:'Pengendalian Bahan Kimia Berbahaya',summary:'Mengatur identifikasi B3 di tempat kerja, kewajiban menyediakan SDS, pelatihan penanganan B3, dan sistem tanggap darurat kimia.'},
  {type:'kepmenaker',no:'Kepmenaker No.51/1999',title:'NAB Faktor Fisika di Tempat Kerja',summary:'NAB awal untuk kebisingan, getaran, radiasi panas, radiasi sinar ultraviolet, dan tekanan udara (sudah diupdate oleh Permenaker 5/2018).'},
  {type:'kepmenaker',no:'Kepmenaker No.75/2002',title:'Pemberlakuan SNI Nomor SNI-04-0225-2000 tentang PUIL 2000',summary:'Wajibkan Persyaratan Umum Instalasi Listrik (PUIL) 2000 di semua instalasi listrik industri dan komersial di Indonesia.'},
  {type:'kepmenaker',no:'Kepmenaker No.555/1996',title:'K3 pada Usaha Pertambangan Umum',summary:'Syarat K3 di sektor pertambangan: prosedur penambangan, bahan peledak, ventilasi tambang, dan kualifikasi pengawas tambang (POP/POM/POU).'},
  {type:'kepmenaker',no:'Kepmenaker No.1827/2018',title:'Pedoman Pelaksanaan Kaidah Teknik Pertambangan yang Baik',summary:'Update pedoman K3 pertambangan termasuk sistem manajemen K3 pertambangan dan persyaratan pengawas operasional.'},
  {type:'permenaker',no:'Permenaker No.12/2015',title:'K3 Listrik di Tempat Kerja',summary:'Mengatur keselamatan listrik di tempat kerja: pemeriksaan instalasi, kualifikasi teknisi listrik K3, dan prosedur keselamatan LOTO.'},
  {type:'permenaker',no:'Permenaker No.38/2016',title:'K3 Pesawat Tenaga dan Produksi',summary:'Syarat K3 mesin produksi: guarding, inspeksi, kualifikasi operator, dan register pesawat tenaga dan produksi di Disnaker.'},
  {type:'permenaker',no:'Permenaker No.11/2023',title:'K3 pada Pekerjaan Konstruksi',summary:'Regulasi terbaru K3 konstruksi: SMKK (Sistem Manajemen K3 Konstruksi), kompetensi tenaga ahli K3 konstruksi, dan audit K3.'},
  {type:'permenaker',no:'Permenaker No.6/2017',title:'K3 Elevator dan Eskalator',summary:'Syarat K3 elevator/lift dan eskalator: inspeksi berkala, sertifikasi teknisi, prosedur darurat, dan batas kapasitas angkut.'},
  {type:'permenaker',no:'Permenaker No.16/2016',title:'Tata Cara Pemberian Penghargaan K3 (Zero Accident Award)',summary:'Program penghargaan K3 dari KEMNAKER RI: syarat, kriteria, dan prosedur pengajuan Zero Accident Award, SMK3 Award.'},
  {type:'permenaker',no:'Permenaker No.18/2020',title:'Keselamatan dan Kesehatan Kerja Lingkungan Kerja',summary:'Update peraturan K3 lingkungan kerja mencakup faktor fisika, kimia, biologi, ergonomi, dan psikososial di tempat kerja.'},
  {type:'pp',no:'PP No.14/1993',title:'Penyelenggaraan Program Jamsostek',summary:'Tata cara pembayaran iuran Jamsostek (kini BPJS Ketenagakerjaan) dan kewajiban pelaporan kecelakaan kerja kepada BPJS.'},
  {type:'uu',no:'UU No.24/2011',title:'BPJS (Badan Penyelenggara Jaminan Sosial)',summary:'Mengatur pembentukan BPJS Kesehatan dan BPJS Ketenagakerjaan, cakupan program JKK, JKM, JHT, JP, dan kewajiban perusahaan mendaftarkan pekerja.'},
  {type:'permenaker',no:'Permenaker No.33/2016',title:'Tata Cara Pengawasan Ketenagakerjaan',summary:'Prosedur pengawasan K3 oleh Pengawas Ketenagakerjaan: pemeriksaan, nota pemeriksaan, dan tindak lanjut.'},
  {type:'permenaker',no:'Permenaker No.4/2014',title:'K3 Bekerja pada Ketinggian',summary:'Regulasi spesifik bekerja di ketinggian: definisi, sistem izin kerja, jenis APD jatuh (PFAS), inspeksi, dan kualifikasi teknisi bekerja di ketinggian.'},
  {type:'kepmenaker',no:'Kepmenaker No.186/1999',title:'Unit Penanggulangan Kebakaran di Tempat Kerja',summary:'Kewajiban membentuk unit pemadam kebakaran, klasifikasi potensi bahaya kebakaran (kelas A-D), dan persyaratan personel pemadam.'},
  {type:'permenaker',no:'Permenaker No.1/1978',title:'Keselamatan dan Kesehatan Kerja Penerbangan dan Penerbangan Daratan',summary:'K3 untuk pekerjaan di bidang penerbangan: ground handling, ground support equipment, dan prosedur darurat.'},
];

let activeFilter = 'all';

function renderRegs(list){
  const tbody = document.getElementById('regBody');
  document.getElementById('regCount').textContent = list.length;
  if(!list.length){
    tbody.innerHTML = '<tr><td colspan="4" style="text-align:center;padding:40px;color:var(--muted)">Tidak ada hasil.</td></tr>';
    return;
  }
  tbody.innerHTML = list.map(r=>`
    <tr>
      <td><span class="badge-${r.type}">${r.type.toUpperCase()}</span></td>
      <td class="reg-num">${r.no}</td>
      <td class="reg-title">${r.title}</td>
      <td class="reg-summary">${r.summary}</td>
    </tr>
  `).join('');
}

function filterReg(){
  const q = document.getElementById('regSearch').value.toLowerCase().trim();
  let list = regs;
  if(activeFilter !== 'all') list = list.filter(r=>r.type===activeFilter);
  if(q) list = list.filter(r=>(r.no+r.title+r.summary).toLowerCase().includes(q));
  renderRegs(list);
}

function filterCat(btn, cat){
  document.querySelectorAll('.cat-btn').forEach(b=>b.classList.remove('active'));
  btn.classList.add('active');
  activeFilter = cat;
  filterReg();
}

renderRegs(regs);
</script>
</body>
</html>
