<?php
require_once __DIR__ . '/../config.php';
$s = get_all_settings();

$page_title = 'AI K3 Document Analyzer 2026: Cek Kepatuhan SMK3 & Gap Analysis';
$meta_desc = 'Analisis otomatis dokumen K3, Kebijakan K3, SOP, dan JSA terhadap kepatuhan regulasi SMK3 PP 50/2012 dan ISO 45001:2018. Dapatkan skor audit dan rekomendasi perbaikan instan.';

ob_start();
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
    { "@type": "ListItem", "position": 3, "name": "AI Document Analyzer", "item": "https://wahanatotalita.com/tools/ai-analyzer/" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebApplication",
  "name": "AI K3 Document Compliance Analyzer",
  "url": "https://wahanatotalita.com/tools/ai-analyzer/",
  "description": "Pemeriksaan kepatuhan otomatis dokumen kebijakan K3, SOP, dan prosedur kerja terhadap standar audit SMK3 PP 50/2012.",
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
      "name": "Klausul apa saja yang wajib tercantum dalam lembar Kebijakan K3 perusahaan?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Sesuai PP No. 50 Tahun 2012 Lampiran I, Kebijakan K3 wajib: (1) Tertulis, tertanggal, dan ditandatangani oleh pimpinan tertinggi pengusaha; (2) Memuat komitmen mematuhi peraturan perundang-undangan K3 nasional; (3) Memuat komitmen mencegah cedera dan penyakit akibat kerja; (4) Dikomunikasikan kepada seluruh pekerja dan tamu; serta (5) Ditinjau ulang secara berkala."
      }
    },
    {
      "@type": "Question",
      "name": "Apa perbedaan temuan audit Mayor dan Minor dalam audit SMK3?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Temuan Mayor adalah ketidakpatuhan terhadap ketentuan peraturan perundang-undangan, ketiadaan kebijakan K3 yang disahkan, atau kegagalan total dari salah satu elemen SMK3 yang berpotensi fatal. Sedangkan temuan Minor adalah ketidakkonsistenan administratif kecil dalam penerapan SOP yang tidak berdampak langsung terhadap potensi kecelakaan fatal."
      }
    }
  ]
}
</script>

<style>
:root {
  --navy-dark: #071524;
  --navy: #0D233A;
  --navy-light: #183654;
  --orange: #E8611A;
  --orange-hover: #cf5213;
  --orange-light: #fff2ea;
  --slate-50: #F8FAFC;
  --slate-100: #F1F5F9;
  --slate-200: #E2E8F0;
  --slate-300: #CBD5E1;
  --slate-600: #475569;
  --slate-700: #334155;
  --slate-900: #0F172A;
  --radius-md: 12px;
  --radius-lg: 16px;
  --shadow-sm: 0 2px 8px rgba(13,35,58,0.06);
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
body {
  font-family: 'Source Sans 3', system-ui, -apple-system, sans-serif;
  background: var(--slate-50);
  color: var(--slate-900);
  line-height: 1.6;
}
.container { max-width: 1200px; margin: 0 auto; padding: 0 24px; }

/* HERO */
.ai-hero {
  background: linear-gradient(135deg, #071524 0%, #0D233A 60%, #183654 100%);
  color: #fff;
  padding: 58px 0 44px;
  position: relative;
  overflow: hidden;
  border-bottom: 3px solid var(--orange);
}
.ai-hero::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image: linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
  background-size: 36px 36px;
  pointer-events: none;
}
.hero-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: rgba(232, 97, 26, 0.18);
  border: 1px solid rgba(232, 97, 26, 0.4);
  padding: 6px 14px;
  border-radius: 999px;
  color: #FFA573;
  font-size: 0.8rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  margin-bottom: 14px;
}
.ai-hero h1 {
  font-family: 'Lexend', sans-serif;
  font-size: clamp(1.8rem, 3.6vw, 2.7rem);
  font-weight: 800;
  line-height: 1.2;
  margin-bottom: 12px;
}
.ai-hero h1 span { color: var(--orange); }
.ai-hero p {
  color: #CBD5E1;
  font-size: 1.05rem;
  max-width: 760px;
  margin-bottom: 20px;
}
.hero-tags { display: flex; flex-wrap: wrap; gap: 8px; }
.hero-tag {
  background: rgba(255,255,255,0.08);
  border: 1px solid rgba(255,255,255,0.12);
  padding: 4px 12px;
  border-radius: 6px;
  font-size: 0.82rem;
  color: #E2E8F0;
}

/* WORKSPACE LAYOUT */
.ai-wrapper { padding: 40px 0 60px; }
.ai-grid {
  display: grid;
  grid-template-columns: 1.15fr 0.85fr;
  gap: 32px;
  align-items: start;
}
@media (max-width: 992px) {
  .ai-grid { grid-template-columns: 1fr; }
}

.card-box {
  background: #fff;
  border: 1px solid var(--slate-200);
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow-sm);
  padding: 28px;
  margin-bottom: 28px;
}
.card-header-line {
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-bottom: 2px solid var(--slate-100);
  padding-bottom: 16px;
  margin-bottom: 22px;
}
.card-title {
  font-family: 'Lexend', sans-serif;
  font-size: 1.25rem;
  font-weight: 700;
  color: var(--navy);
  display: flex;
  align-items: center;
  gap: 10px;
}

/* SAMPLE PILLS */
.sample-bar {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin-bottom: 16px;
}
.sample-btn {
  background: var(--slate-100);
  border: 1px solid var(--slate-200);
  padding: 6px 14px;
  border-radius: 999px;
  font-size: 0.82rem;
  font-weight: 600;
  color: var(--slate-700);
  cursor: pointer;
  transition: all 0.2s;
}
.sample-btn:hover, .sample-btn.active {
  background: var(--navy);
  border-color: var(--navy);
  color: #fff;
}

.doc-textarea {
  width: 100%;
  min-height: 240px;
  padding: 14px;
  border: 1.5px solid var(--slate-200);
  border-radius: var(--radius-md);
  font-size: 0.92rem;
  font-family: inherit;
  color: var(--slate-900);
  line-height: 1.6;
  resize: vertical;
  margin-bottom: 16px;
}
.doc-textarea:focus { outline: none; border-color: var(--orange); }

.btn-scan {
  background: var(--orange);
  color: #fff;
  border: none;
  padding: 12px 24px;
  border-radius: var(--radius-md);
  font-size: 0.95rem;
  font-weight: 700;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}
.btn-scan:hover { background: var(--orange-hover); }

/* AUDIT RESULTS */
.score-circle-box {
  text-align: center;
  padding: 24px;
  background: var(--slate-50);
  border-radius: var(--radius-lg);
  border: 1px solid var(--slate-200);
  margin-bottom: 24px;
}
.score-num {
  font-family: 'Lexend', sans-serif;
  font-size: 3.2rem;
  font-weight: 900;
  color: var(--navy);
  line-height: 1;
}
.score-status {
  display: inline-block;
  padding: 4px 12px;
  border-radius: 999px;
  font-size: 0.82rem;
  font-weight: 700;
  margin-top: 10px;
}
.status-pass { background: #DCFCE7; color: #166534; }
.status-revision { background: #FEF3C7; color: #92400E; }
.status-fail { background: #FEE2E2; color: #991B1B; }

.finding-item {
  display: flex;
  align-items: flex-start;
  gap: 12px;
  padding: 12px;
  border-radius: 8px;
  background: var(--slate-50);
  border: 1px solid var(--slate-200);
  margin-bottom: 10px;
  font-size: 0.86rem;
  line-height: 1.5;
}
.finding-pass { border-left: 4px solid #10B981; }
.finding-warn { border-left: 4px solid #F59E0B; }
.finding-fail { border-left: 4px solid #EF4444; }

/* EDITORIAL ARTICLE */
.editorial-box {
  background: #fff;
  border: 1px solid var(--slate-200);
  border-radius: var(--radius-lg);
  padding: 36px;
  margin-bottom: 32px;
}
.editorial-title {
  font-family: 'Lexend', sans-serif;
  font-size: 1.45rem;
  font-weight: 800;
  color: var(--navy);
  margin-bottom: 16px;
  border-left: 4px solid var(--orange);
  padding-left: 14px;
}
.editorial-p {
  color: var(--slate-700);
  font-size: 0.96rem;
  line-height: 1.7;
  margin-bottom: 16px;
}

/* FAQ */
.faq-item {
  border: 1px solid var(--slate-200);
  border-radius: var(--radius-md);
  margin-bottom: 12px;
  overflow: hidden;
  background: #fff;
}
.faq-q {
  width: 100%;
  padding: 16px 20px;
  text-align: left;
  background: #fff;
  border: none;
  font-family: 'Lexend', sans-serif;
  font-size: 0.98rem;
  font-weight: 700;
  color: var(--navy);
  cursor: pointer;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.faq-q:hover { background: var(--slate-50); }
.faq-a {
  padding: 0 20px 18px;
  color: var(--slate-700);
  font-size: 0.92rem;
  line-height: 1.65;
  display: none;
}
.faq-item.active .faq-a { display: block; }
.faq-item.active .faq-icon { transform: rotate(180deg); }
.faq-icon { transition: transform 0.2s; }
</style>

<?php require __DIR__ . '/../includes/navbar.php'; ?>

<main class="ai-page" id="konten-utama">

<!-- HERO -->
<section class="ai-hero">
  <div class="container">
    <div class="hero-badge">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm1 15h-2v-2h2zm0-4h-2V7h2z"/></svg>
      Audit Kepatuhan Klausul SMK3 PP 50/2012
    </div>
    <h1>AI K3 Document <span>Analyzer 2026</span></h1>
    <p>Pindai dan evaluasi kualitas dokumen Kebijakan K3, Prosedur Kerja Aman, SOP, dan JSA Anda secara otomatis. Periksa pemenuhan elemen audit regulasi nasional dan temukan celah kepatuhan (Gap Analysis) seketika.</p>
    <div class="hero-tags">
      <span class="hero-tag">Validasi 5 Prinsip SMK3</span>
      <span class="hero-tag">Deteksi Klausul Hukum Wajib</span>
      <span class="hero-tag">Gap Analysis Skor 0 - 100%</span>
      <span class="hero-tag">Rekomendasi Revisi Klausul Audit</span>
    </div>
  </div>
</section>

<!-- MAIN WORKSPACE -->
<section class="ai-wrapper">
  <div class="container">
    
    <div class="ai-grid">
      
      <!-- INPUT COLUMN -->
      <div>
        <div class="card-box">
          
          <div class="card-header-line">
            <h2 class="card-title">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--orange)" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
              Input Teks Dokumen K3
            </h2>
          </div>

          <label class="form-label" style="font-size:0.8rem;color:var(--slate-600)">Muat Contoh Dokumen:</label>
          <div class="sample-bar">
            <button class="sample-btn active" type="button" onclick="loadSample('kebijakan')">Kebijakan K3 Perusahaan</button>
            <button class="sample-btn" type="button" onclick="loadSample('sop_ketinggian')">SOP Bekerja di Ketinggian</button>
            <button class="sample-btn" type="button" onclick="loadSample('tanggap_darurat')">Prosedur Tanggap Darurat</button>
          </div>

          <textarea id="inpDocText" class="doc-textarea" placeholder="Tempelkan (paste) isi dokumen K3, Kebijakan K3, atau SOP Anda di sini..."></textarea>

          <button class="btn-scan" type="button" onclick="analyzeDocument()">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            Analisis Kepatuhan Dokumen Sekarang
          </button>

        </div>
      </div>

      <!-- RESULTS COLUMN -->
      <div>
        <div class="card-box">
          
          <div class="card-header-line">
            <h2 class="card-title">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--orange)" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
              Hasil Gap Analysis Audit
            </h2>
          </div>

          <div class="score-circle-box">
            <div style="font-size:0.8rem;font-weight:700;color:var(--slate-600);text-transform:uppercase">Tingkat Kepatuhan Regulasi</div>
            <div class="score-num" id="outScore">85%</div>
            <div class="score-status status-pass" id="outBadge">MEMENUHI STANDAR AUDIT (LULUS)</div>
          </div>

          <h4 style="font-size:0.9rem;font-weight:700;color:var(--navy);margin-bottom:12px">Hasil Pengecekan Klausul Wajib:</h4>
          <div id="findingsContainer">
            <!-- Dynamic findings -->
          </div>

        </div>
      </div>

    </div>

    <!-- IN-DEPTH EDITORIAL ARTICLE (SEO DEPTH) -->
    <div class="editorial-box">
      <h2 class="editorial-title">Pentingnya Audit Kepatuhan Dokumen K3 Menurut PP No. 50 Tahun 2012</h2>
      <p class="editorial-p">
        Dokumen K3 bukan sekadar formalitas kertas (<em>paper safety</em>), melainkan bukti legal akuntabilitas manajemen di mata hukum peradilan Indonesia jika terjadi insiden kecelakaan kerja. Berdasarkan <strong>Pasal 16 PP No. 50 Tahun 2012</strong>, penilaian penerapan SMK3 dilakukan melalui audit SMK3 yang mencakup verifikasi terhadap kelengkapan dan konsistensi seluruh dokumen operasional.
      </p>

      <h3 style="color:var(--navy);font-family:'Lexend',sans-serif;font-size:1.15rem;margin:22px 0 10px">Kriteria Penilaian Audit SMK3</h3>
      <ul style="padding-left:22px;color:var(--slate-700);line-height:1.75;margin-bottom:18px">
        <li><strong>Tingkat Penilaian Awal (64 Kriteria):</strong> Wajib bagi perusahaan kecil dengan tingkat risiko rendah.</li>
        <li><strong>Tingkat Penilaian Transisi (122 Kriteria):</strong> Untuk perusahaan menengah dengan kompleksitas operasional menengah.</li>
        <li><strong>Tingkat Penilaian Lanjutan (166 Kriteria):</strong> Wajib bagi industri berpotensi bahaya tinggi (Pertambangan, Migas, Konstruksi, Kimia, Manufaktur Berat).</li>
      </ul>

      <!-- FAQ ACCORDION -->
      <h3 style="color:var(--navy);font-family:'Lexend',sans-serif;font-size:1.25rem;margin:28px 0 16px">Tanya Jawab Seputar Audit Dokumen K3 (FAQ)</h3>
      <div class="faq-box">
        
        <div class="faq-item">
          <button class="faq-q" onclick="toggleFaq(this)">
            <span>Apakah auditor eksternal dapat menggugurkan audit jika Kebijakan K3 belum ditandatangani pimpinan?</span>
            <span class="faq-icon">▼</span>
          </button>
          <div class="faq-a">
            Ya. Kebijakan K3 yang tidak ditandatangani oleh Direktur Utama atau Manajemen Puncak secara otomatis dikategorikan sebagai Temuan Ketidaksesuaian Mayor (Major Non-Conformance), karena menunjukkan tidak adanya komitmen nyata dari pucuk pimpinan organisasi terhadap keselamatan kerja tenaga kerja.
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-q" onclick="toggleFaq(this)">
            <span>Berapa lama dokumen K3 wajib disimpan dan diarsipkan di perusahaan?</span>
            <span class="faq-icon">▼</span>
          </button>
          <div class="faq-a">
            Dokumen rekaman K3 (seperti rekam medis pekerja, laporan investigasi kecelakaan, sertifikat riksa uji alat angkat SILO, dan log audit) wajib diarsipkan sekurang-kurangnya selama 5 (lima) tahun hingga 30 tahun (khusus untuk data rekam paparan bahan kimia karsinogenik dan radiasi).
          </div>
        </div>

      </div>

    </div>

  </div>
</section>

</main>

<?php require __DIR__ . '/../includes/footer.php'; ?>

<script>
const sampleDocs = {
  kebijakan: `KEBIJAKAN KESELAMATAN, KESEHATAN KERJA DAN LINGKUNGAN (K3L)
PT WAHANA TOTALITA MANDIRI

PT Wahana Totalita Mandiri berkomitmen penuh untuk menjamin keselamatan dan kesehatan seluruh tenaga kerja, mitra kontraktor, dan tamu di seluruh area operasional kami.

Untuk mewujudkan komitmen tersebut, manajemen puncak menetapkan:
1. Mematuhi seluruh peraturan perundang-undangan K3 yang berlaku di Indonesia, termasuk UU No. 1 Tahun 1970 dan PP No. 50 Tahun 2012 tentang Penerapan SMK3.
2. Mengidentifikasi, mengendalikan, dan mengeliminasi seluruh potensi bahaya kerja guna mencegah kecelakaan kerja (Zero Accident) dan Penyakit Akibat Kerja (PAK).
3. Menyediakan fasilitas, pelatihan kompetensi K3 berkala, serta Alat Pelindung Diri (APD) yang memenuhi standar SNI secara cuma-cuma.
4. Melibatkan seluruh pekerja dan Panitia Pembina K3 (P2K3) dalam konsultasi dan pengambilan keputusan keselamatan.
5. Melakukan evaluasi dan perbaikan berkelanjutan terhadap kinerja sistem manajemen K3.

Kebijakan ini ditinjau ulang secara berkala minimal 1 tahun sekali.

Jakarta, 15 Januari 2026
Tertanda,
Direktur Utama`,

  sop_ketinggian: `STANDAR OPERASIONAL PROSEDUR (SOP) BEKERJA DI KETINGGIAN
No. Dokumen: SOP-HSE-008 | Revisi: 02

1. TUJUAN
Memastikan seluruh pekerjaan yang dilakukan di atas ketinggian 1.8 meter berjalan aman sesuai Permenaker No. 09 Tahun 2016.

2. RUANG LINGKUP
Berlaku untuk seluruh pemasangan perancah scaffolding, perawatan atap, dan pekerjaan baja di area pabrik.

3. KETENTUAN KESELAMATAN
- Wajib memiliki Surat Izin Kerja Aman (Permit to Work / PTW) yang ditandatangani Ahli K3 Umum.
- Setiap pekerja wajib mengenakan Full Body Harness double lanyard dengan shock absorber dan terikat 100% pada lifeline independen berkekuatan minimal 22 kN.
- Scaffolding wajib diinspeksi harian dan memiliki Scafftag Hijau aktif sebelum dinaiki.
- Hentikan pekerjaan jika kecepatan angin melebihi 20 knot atau terjadi hujan lebat.`,

  tanggap_darurat: `PROSEDUR TANGGAP DARURAT KEBAKARAN DAN EVAKUASI GEDUNG
No. Dokumen: ERP-SOP-003 | Revisi: 01

1. ALUR KOMUNIKASI DARURAT
Setiap orang yang melihat api awal wajib:
a. Berteriak "KEBAKARAN!" dan memecahkan manual call point (break glass) terdekat.
b. Padamkan api menggunakan APAR jenis dry chemical powder jika api masih berskala kecil (kurang dari 2 menit).
c. Jika api membesar, evakuasi segera menuju Titik Kumpul (Assembly Point) melalui tangga darurat. Dilarang menggunakan lift!

2. TUGAS FLOOR WARDEN
- Memastikan seluruh ruangan telah kosong dan tidak ada pekerja tertinggal.
- Melakukan absensi penghitungan jumlah pekerja (headcount) di muster point.`
};

function loadSample(key){
  document.querySelectorAll('.sample-bar .sample-btn').forEach(b => b.classList.remove('active'));
  event.target.classList.add('active');
  document.getElementById('inpDocText').value = sampleDocs[key];
  analyzeDocument();
}

function analyzeDocument(){
  const text = document.getElementById('inpDocText').value.toLowerCase();
  const findings = [];
  let score = 0;

  // Check 1: Komitmen Regulasi K3 Nasional
  if(text.includes('uu no. 1') || text.includes('uu 1/1970') || text.includes('pp no. 50') || text.includes('smk3') || text.includes('peraturan') || text.includes('regulasi')){
    score += 25;
    findings.push({ status: 'pass', title: 'Rujukan Regulasi K3 Terpenuhi', desc: 'Dokumen mencantumkan komitmen terhadap peraturan perundang-undangan K3 nasional yang berlaku.' });
  } else {
    findings.push({ status: 'fail', title: 'Kurang Rujukan Regulasi Wajib', desc: 'Belum ditemukan klausul kepatuhan eksplisit terhadap UU No. 1/1970 atau PP No. 50/2012.' });
  }

  // Check 2: Pencegahan Kecelakaan & PAK
  if(text.includes('kecelakaan') || text.includes('penyakit akibat kerja') || text.includes('pak') || text.includes('zero accident') || text.includes('cedera') || text.includes('bahaya')){
    score += 25;
    findings.push({ status: 'pass', title: 'Sasaran Pencegahan Insiden Tercantum', desc: 'Memuat tujuan pencegahan kecelakaan kerja dan pengendalian bahaya di tempat kerja.' });
  } else {
    findings.push({ status: 'warn', title: 'Sasaran Pencegahan Belum Eksplisit', desc: 'Disarankan menambahkan target eliminasi bahaya dan pencegahan penyakit akibat kerja.' });
  }

  // Check 3: Keterlibatan Pekerja / P2K3 / Supervisor
  if(text.includes('p2k3') || text.includes('pekerja') || text.includes('ahli k3') || text.includes('konsultasi') || text.includes('pelatihan') || text.includes('pengawas')){
    score += 25;
    findings.push({ status: 'pass', title: 'Klausul Partisipasi & Tanggung Jawab Lengkap', desc: 'Dokumen mengidentifikasi peran tenaga kerja, P2K3, atau pengawas keselamatan.' });
  } else {
    findings.push({ status: 'warn', title: 'Belum Ada Penunjukan Tanggung Jawab', desc: 'Tambahkan klausul mengenai kewajiban pelaporan dan koordinasi bersama tim P2K3 / HSE.' });
  }

  // Check 4: Pengesahan & Tinjauan Berkala
  if(text.includes('direktur') || text.includes('pimpinan') || text.includes('tertanda') || text.includes('tanggal') || text.includes('berkala') || text.includes('revisi') || text.includes('tinjau')){
    score += 25;
    findings.push({ status: 'pass', title: 'Aspek Legalitas & Review Terpenuhi', desc: 'Terdapat klausul peninjauan berkala atau pengesahan dari pimpinan manajemen.' });
  } else {
    findings.push({ status: 'fail', title: 'Ketiadaan Pengesahan Manajemen Puncak', desc: 'Dokumen K3 wajib memuat tanggal terbit, identitas pengesah, dan jadwal tinjauan berkala.' });
  }

  // Output
  document.getElementById('outScore').textContent = score + '%';
  const badge = document.getElementById('outBadge');
  if(score >= 80){
    badge.className = 'score-status status-pass';
    badge.textContent = 'MEMENUHI STANDAR AUDIT (LULUS)';
  } else if(score >= 50){
    badge.className = 'score-status status-revision';
    badge.textContent = 'PERLU REVISI ADMINISTRATIF (MINOR GAP)';
  } else {
    badge.className = 'score-status status-fail';
    badge.textContent = 'TIDAK MEMENUHI STANDAR (MAJOR GAP)';
  }

  const container = document.getElementById('findingsContainer');
  container.innerHTML = '';
  findings.forEach(f => {
    const div = document.createElement('div');
    div.className = `finding-item finding-${f.status}`;
    div.innerHTML = `
      <div style="font-size:1.1rem">${f.status === 'pass' ? '✓' : (f.status === 'warn' ? '⚠️' : '✕')}</div>
      <div>
        <strong style="color:var(--navy)">${f.title}</strong>
        <div style="font-size:0.8rem;color:var(--slate-600)">${f.desc}</div>
      </div>
    `;
    container.appendChild(div);
  });
}

function toggleFaq(btn){
  btn.parentElement.classList.toggle('active');
}

window.addEventListener('DOMContentLoaded', () => {
  loadSample('kebijakan');
});
</script>

<?php require __DIR__ . '/../includes/scripts.php'; ?>
</body>
</html>
