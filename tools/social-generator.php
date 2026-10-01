<?php
require_once __DIR__ . '/../config.php';
$s = get_all_settings();

$page_title = 'Generator Banner & Poster K3 2026: Bulan K3 Nasional & Slogan K3';
$meta_desc = 'Buat poster dan banner K3 profesional online gratis untuk Bulan K3 Nasional, kampanye APD, dan media sosial. Download grafis keselamatan kerja siap cetak dan share.';

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
    { "@type": "ListItem", "position": 3, "name": "Social Generator", "item": "https://wahanatotalita.com/tools/social-generator/" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebApplication",
  "name": "Generator Poster & Banner K3 Online",
  "url": "https://wahanatotalita.com/tools/social-generator/",
  "description": "Aplikasi desain banner dan poster keselamatan kerja K3 online dengan tema Bulan K3 Nasional dan slogan budaya keselamatan kerja.",
  "applicationCategory": "DesignApplication",
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
      "name": "Kapan Bulan K3 Nasional diselenggarakan di Indonesia?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Bulan K3 Nasional diselenggarakan secara serentak di seluruh Indonesia setiap tahun mulai tanggal 12 Januari hingga 12 Februari, berdasarkan Keputusan Menteri Ketenagakerjaan RI, guna meningkatkan kesadaran dan kepatuhan norma keselamatan kerja secara masif."
      }
    },
    {
      "@type": "Question",
      "name": "Apa saja warna standar rambu keselamatan kerja menurut standar ISO 7010 dan K3?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Standar warna keselamatan kerja adalah: (1) Merah: Larangan keras atau peralatan pemadam kebakaran; (2) Kuning: Peringatan bahaya atau waspada; (3) Biru: Perintah wajib (seperti kewajiban memakai APD); (4) Hijau: Kondisi aman, jalur evakuasi, dan fasilitas pertolongan pertama (P3K)."
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
.gen-hero {
  background: linear-gradient(135deg, #071524 0%, #0D233A 60%, #183654 100%);
  color: #fff;
  padding: 58px 0 44px;
  position: relative;
  overflow: hidden;
  border-bottom: 3px solid var(--orange);
}
.gen-hero::before {
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
.gen-hero h1 {
  font-family: 'Lexend', sans-serif;
  font-size: clamp(1.8rem, 3.6vw, 2.7rem);
  font-weight: 800;
  line-height: 1.2;
  margin-bottom: 12px;
}
.gen-hero h1 span { color: var(--orange); }
.gen-hero p {
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
.gen-wrapper { padding: 40px 0 60px; }
.gen-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 32px;
  align-items: start;
}
@media (max-width: 900px) {
  .gen-grid { grid-template-columns: 1fr; }
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

/* CONTROLS */
.form-field { margin-bottom: 16px; }
.form-label {
  display: block;
  font-size: 0.84rem;
  font-weight: 700;
  color: var(--navy);
  margin-bottom: 6px;
}
.form-input {
  width: 100%;
  padding: 10px 14px;
  border: 1.5px solid var(--slate-200);
  border-radius: var(--radius-md);
  font-size: 0.92rem;
  color: var(--slate-900);
  background: #fff;
}
.form-input:focus { outline: none; border-color: var(--orange); }

.pill-group {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin-bottom: 16px;
}
.pill-btn {
  background: var(--slate-100);
  border: 1px solid var(--slate-200);
  padding: 6px 14px;
  border-radius: 999px;
  font-size: 0.8rem;
  font-weight: 600;
  color: var(--slate-700);
  cursor: pointer;
  transition: all 0.2s;
}
.pill-btn:hover, .pill-btn.active {
  background: var(--navy);
  border-color: var(--navy);
  color: #fff;
}

/* CANVAS PREVIEW */
.canvas-wrapper {
  background: var(--slate-100);
  border: 2px dashed var(--slate-300);
  border-radius: var(--radius-md);
  padding: 16px;
  display: flex;
  justify-content: center;
  align-items: center;
  margin-bottom: 20px;
  overflow: hidden;
}
#posterCanvas {
  max-width: 100%;
  height: auto;
  border-radius: 8px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.15);
}

.btn-download {
  width: 100%;
  background: var(--orange);
  color: #fff;
  border: none;
  padding: 14px;
  border-radius: var(--radius-md);
  font-size: 1rem;
  font-weight: 700;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  transition: background 0.2s;
}
.btn-download:hover { background: var(--orange-hover); }

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

<main class="gen-page" id="konten-utama">

<!-- HERO -->
<section class="gen-hero">
  <div class="container">
    <div class="hero-badge">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
      Kampanye K3 &amp; Media Promosi Keselamatan
    </div>
    <h1>Generator Banner &amp; Poster K3 <span>2026</span></h1>
    <p>Rancang materi visual edukasi K3, spanduk Bulan K3 Nasional, dan slogan keselamatan kerja untuk mading pabrik maupun media sosial perusahaan. Download resolusi tinggi siap cetak secara instan.</p>
    <div class="hero-tags">
      <span class="hero-tag">Tema Bulan K3 Nasional</span>
      <span class="hero-tag">Slogan Keselamatan Siap Pakai</span>
      <span class="hero-tag">Format 1:1, 4:5, dan 16:9 Banner</span>
      <span class="hero-tag">Export PNG HD 100% Gratis</span>
    </div>
  </div>
</section>

<!-- MAIN WORKSPACE -->
<section class="gen-wrapper">
  <div class="container">
    
    <div class="gen-grid">
      
      <!-- CONTROLS COLUMN -->
      <div>
        <div class="card-box">
          <div class="card-header-line">
            <h2 class="card-title">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--orange)" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
              Pengaturan Desain Poster
            </h2>
          </div>

          <!-- THEME PILLS -->
          <label class="form-label">Pilih Tema &amp; Slogan K3 Siap Pakai:</label>
          <div class="pill-group">
            <button class="pill-btn active" type="button" onclick="loadSlogan('bulank3')">Bulan K3 Nasional 2026</button>
            <button class="pill-btn" type="button" onclick="loadSlogan('zero')">Zero Incident / Zero Harm</button>
            <button class="pill-btn" type="button" onclick="loadSlogan('apd')">Disiplin Penggunaan APD</button>
            <button class="pill-btn" type="button" onclick="loadSlogan('height')">Bekerja Aman di Ketinggian</button>
            <button class="pill-btn" type="button" onclick="loadSlogan('housekeeping')">Penerapan 5S &amp; Housekeeping</button>
          </div>

          <!-- ASPECT RATIO -->
          <label class="form-label">Format Ukuran / Rasio Grafis:</label>
          <div class="pill-group">
            <button class="pill-btn active" id="btnRatio1" type="button" onclick="setRatio('1:1')">1:1 Square (Instagram/Post)</button>
            <button class="pill-btn" id="btnRatio2" type="button" onclick="setRatio('4:5')">4:5 Portrait (Feed IG/Poster)</button>
            <button class="pill-btn" id="btnRatio3" type="button" onclick="setRatio('16:9')">16:9 Banner (Spanduk/Slide)</button>
          </div>

          <div class="form-field">
            <label class="form-label" for="inpJudul">Judul Utama / Slogan K3</label>
            <input type="text" id="inpJudul" class="form-input" value="UTAMAKAN KESELAMATAN &amp; KESEHATAN KERJA" oninput="drawPoster()">
          </div>

          <div class="form-field">
            <label class="form-label" for="inpSub">Pesan Pengingat / Sub-teks</label>
            <input type="text" id="inpSub" class="form-input" value="Keluarga Anda Menanti Anda Pulang dengan Selamat di Rumah" oninput="drawPoster()">
          </div>

          <div class="form-field">
            <label class="form-label" for="inpCompany">Nama Perusahaan / Organisasi</label>
            <input type="text" id="inpCompany" class="form-input" value="PT WAHANA TOTALITA MANDIRI" oninput="drawPoster()">
          </div>

          <div class="form-field">
            <label class="form-label">Pilihan Gaya Warna Tema:</label>
            <div class="pill-group">
              <button class="pill-btn active" id="btnColor1" type="button" onclick="setColorTheme('navy')">Deep Navy &amp; Orange</button>
              <button class="pill-btn" id="btnColor2" type="button" onclick="setColorTheme('forest')">Safety Green &amp; White</button>
              <button class="pill-btn" id="btnColor3" type="button" onclick="setColorTheme('danger')">Safety Yellow &amp; Black</button>
            </div>
          </div>

        </div>
      </div>

      <!-- PREVIEW & DOWNLOAD COLUMN -->
      <div>
        <div class="card-box">
          <div class="card-header-line">
            <h2 class="card-title">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--orange)" stroke-width="2"><circle cx="12" cy="12" r="10"/><polygon points="10 8 16 12 10 16 10 8"/></svg>
              Live Preview Grafis
            </h2>
          </div>

          <div class="canvas-wrapper">
            <canvas id="posterCanvas" width="800" height="800"></canvas>
          </div>

          <button class="btn-download" type="button" onclick="downloadPoster()">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
            Download Poster PNG Resolusi Tinggi
          </button>
        </div>
      </div>

    </div>

    <!-- IN-DEPTH EDITORIAL ARTICLE (SEO DEPTH) -->
    <div class="editorial-box">
      <h2 class="editorial-title">Pentingnya Kampanye Visual dan Komunikasi K3 di Tempat Kerja</h2>
      <p class="editorial-p">
        Komunikasi visual melalui spanduk, banner, dan poster keselamatan kerja merupakan sarana vital dalam pembentukan budaya K3 (<em>Safety Culture</em>) sesuai dengan <strong>Permenaker No. 05 Tahun 1996 dan PP No. 50 Tahun 2012</strong> tentang Penerapan SMK3 Klausul Komunikasi dan Konsultasi.
      </p>

      <h3 style="color:var(--navy);font-family:'Lexend',sans-serif;font-size:1.15rem;margin:22px 0 10px">Prinsip Pesan Keselamatan Kerja yang Efektif</h3>
      <ul style="padding-left:22px;color:var(--slate-700);line-height:1.75;margin-bottom:18px">
        <li><strong>Ringkas dan Langsung (Clear &amp; Actionable):</strong> Hindari kalimat bertele-tele. Fokus pada pesan aksi nyata, seperti "Pakai Harness Anda" atau "Periksa Sebelum Naik".</li>
        <li><strong>Pendekatan Psikologis Positif:</strong> Mengingatkan pekerja tentang keluarga yang menunggu di rumah terbukti secara psikologis lebih efektif menurunkan perilaku berisiko dibanding pesan yang sekadar bernada ancaman hukuman.</li>
        <li><strong>Rotasi Visual Berkala:</strong> Poster K3 yang dipasang di tempat yang sama selama lebih dari 3 bulan akan mengalami <em>visual blindness</em> (diabaikan oleh pekerja). Lakukan peremajaan tema minimal sebulan sekali.</li>
      </ul>

      <!-- FAQ ACCORDION -->
      <h3 style="color:var(--navy);font-family:'Lexend',sans-serif;font-size:1.25rem;margin:28px 0 16px">Tanya Jawab Seputar Promosi K3 (FAQ)</h3>
      <div class="faq-box">
        
        <div class="faq-item">
          <button class="faq-q" onclick="toggleFaq(this)">
            <span>Kapan Bulan K3 Nasional diperingati setiap tahunnya?</span>
            <span class="faq-icon">▼</span>
          </button>
          <div class="faq-a">
            Bulan K3 Nasional diperingati secara serentak di seluruh Indonesia mulai tanggal <strong>12 Januari hingga 12 Februari</strong> setiap tahunnya berdasarkan Keputusan Menteri Ketenagakerjaan RI, guna memicu momentum kampanye keselamatan secara nasional.
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-q" onclick="toggleFaq(this)">
            <span>Apakah poster hasil generator ini bebas digunakan secara komersial?</span>
            <span class="faq-icon">▼</span>
          </button>
          <div class="faq-a">
            Ya, 100% gratis dan bebas digunakan untuk keperluan internal perusahaan, cetak spanduk di site pabrik/konstruksi, lembar buletin P2K3, maupun postingan akun LinkedIn / Instagram perusahaan.
          </div>
        </div>

      </div>

    </div>

  </div>
</section>

</main>

<?php require __DIR__ . '/../includes/footer.php'; ?>

<script>
let currentAspect = '1:1';
let currentTheme = 'navy';

const slogans = {
  bulank3: {
    title: "BULAN K3 NASIONAL 2026",
    sub: "Wujudkan Budaya K3 Unggul Menuju Zero Incident & Produktivitas Berkelanjutan"
  },
  zero: {
    title: "TARGET ZERO ACCIDENT",
    sub: "Bekerja Selamat Hari Ini, Pulang Sehat Menemui Keluarga Tercinta"
  },
  apd: {
    title: "DISIPLIN PAKAI APD",
    sub: "Alat Pelindung Diri Adalah Nyawa Kedua Anda di Area Operasional"
  },
  height: {
    title: "BEKERJA DI KETINGGIAN",
    sub: "100% Tie-Off Lanyard Harness ke Anchor Point Aman Sebelum Bergerak"
  },
  housekeeping: {
    title: "BUDAYA 5S DI TEMPAT KERJA",
    sub: "Ringkas, Rapi, Resik, Rawat, Rajin: Kunci Lingkungan Bersih dan Bebas Insiden"
  }
};

function loadSlogan(key){
  const s = slogans[key];
  if(!s) return;
  document.querySelectorAll('.pill-group .pill-btn').forEach(b => b.classList.remove('active'));
  event.target.classList.add('active');

  document.getElementById('inpJudul').value = s.title;
  document.getElementById('inpSub').value = s.sub;
  drawPoster();
}

function setRatio(r){
  currentAspect = r;
  document.getElementById('btnRatio1').classList.toggle('active', r === '1:1');
  document.getElementById('btnRatio2').classList.toggle('active', r === '4:5');
  document.getElementById('btnRatio3').classList.toggle('active', r === '16:9');

  const canvas = document.getElementById('posterCanvas');
  if(r === '1:1'){ canvas.width = 800; canvas.height = 800; }
  else if(r === '4:5'){ canvas.width = 800; canvas.height = 1000; }
  else if(r === '16:9'){ canvas.width = 1200; canvas.height = 675; }

  drawPoster();
}

function setColorTheme(theme){
  currentTheme = theme;
  document.getElementById('btnColor1').classList.toggle('active', theme === 'navy');
  document.getElementById('btnColor2').classList.toggle('active', theme === 'forest');
  document.getElementById('btnColor3').classList.toggle('active', theme === 'danger');
  drawPoster();
}

function drawPoster(){
  const canvas = document.getElementById('posterCanvas');
  const ctx = canvas.getContext('2d');
  const w = canvas.width;
  const h = canvas.height;

  const judul = document.getElementById('inpJudul').value;
  const sub = document.getElementById('inpSub').value;
  const company = document.getElementById('inpCompany').value;

  // Background
  if(currentTheme === 'navy'){
    const grad = ctx.createLinearGradient(0, 0, w, h);
    grad.addColorStop(0, '#071524');
    grad.addColorStop(1, '#0D233A');
    ctx.fillStyle = grad;
    ctx.fillRect(0, 0, w, h);

    // Border line
    ctx.strokeStyle = '#E8611A';
    ctx.lineWidth = 14;
    ctx.strokeRect(20, 20, w - 40, h - 40);

    // Badge
    ctx.fillStyle = '#E8611A';
    ctx.fillRect(w / 2 - 120, 60, 240, 36);
    ctx.fillStyle = '#FFFFFF';
    ctx.font = 'bold 15px sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('SAFETY FIRST • K3 UTAMA', w / 2, 84);

    // Title
    ctx.fillStyle = '#FFFFFF';
    ctx.font = 'bold ' + (w > 1000 ? '44px' : '36px') + ' sans-serif';
    wrapText(ctx, judul, w / 2, h / 2 - 30, w - 120, 48);

    // Subtitle
    ctx.fillStyle = '#FFA573';
    ctx.font = '20px sans-serif';
    wrapText(ctx, sub, w / 2, h / 2 + 70, w - 140, 30);

    // Footer company
    ctx.fillStyle = '#CBD5E1';
    ctx.font = 'bold 16px sans-serif';
    ctx.fillText(company, w / 2, h - 60);

  } else if(currentTheme === 'forest'){
    ctx.fillStyle = '#06402B';
    ctx.fillRect(0, 0, w, h);

    ctx.strokeStyle = '#C8EF84';
    ctx.lineWidth = 14;
    ctx.strokeRect(20, 20, w - 40, h - 40);

    ctx.fillStyle = '#C8EF84';
    ctx.fillRect(w / 2 - 120, 60, 240, 36);
    ctx.fillStyle = '#04291B';
    ctx.font = 'bold 15px sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('ZERO INCIDENT • BUDAYA K3', w / 2, 84);

    ctx.fillStyle = '#FFFFFF';
    ctx.font = 'bold ' + (w > 1000 ? '44px' : '36px') + ' sans-serif';
    wrapText(ctx, judul, w / 2, h / 2 - 30, w - 120, 48);

    ctx.fillStyle = '#C8EF84';
    ctx.font = '20px sans-serif';
    wrapText(ctx, sub, w / 2, h / 2 + 70, w - 140, 30);

    ctx.fillStyle = '#E2E8F0';
    ctx.font = 'bold 16px sans-serif';
    ctx.fillText(company, w / 2, h - 60);

  } else {
    // Yellow Danger Theme
    ctx.fillStyle = '#FDE047';
    ctx.fillRect(0, 0, w, h);

    ctx.strokeStyle = '#000000';
    ctx.lineWidth = 14;
    ctx.strokeRect(20, 20, w - 40, h - 40);

    ctx.fillStyle = '#000000';
    ctx.fillRect(w / 2 - 120, 60, 240, 36);
    ctx.fillStyle = '#FDE047';
    ctx.font = 'bold 15px sans-serif';
    ctx.textAlign = 'center';
    ctx.fillText('PERINGATAN BAHAYA K3', w / 2, 84);

    ctx.fillStyle = '#000000';
    ctx.font = 'bold ' + (w > 1000 ? '44px' : '36px') + ' sans-serif';
    wrapText(ctx, judul, w / 2, h / 2 - 30, w - 120, 48);

    ctx.fillStyle = '#713F12';
    ctx.font = 'bold 20px sans-serif';
    wrapText(ctx, sub, w / 2, h / 2 + 70, w - 140, 30);

    ctx.fillStyle = '#000000';
    ctx.font = 'bold 16px sans-serif';
    ctx.fillText(company, w / 2, h - 60);
  }
}

function wrapText(ctx, text, x, y, maxWidth, lineHeight){
  const words = text.split(' ');
  let line = '';
  let curY = y;

  for(let n = 0; n < words.length; n++){
    const testLine = line + words[n] + ' ';
    const metrics = ctx.measureText(testLine);
    if(metrics.width > maxWidth && n > 0){
      ctx.fillText(line, x, curY);
      line = words[n] + ' ';
      curY += lineHeight;
    } else {
      line = testLine;
    }
  }
  ctx.fillText(line, x, curY);
}

function downloadPoster(){
  const canvas = document.getElementById('posterCanvas');
  const link = document.createElement('a');
  link.download = `Poster_K3_${Date.now()}.png`;
  link.href = canvas.toDataURL('image/png');
  link.click();
}

function toggleFaq(btn){
  btn.parentElement.classList.toggle('active');
}

window.addEventListener('DOMContentLoaded', () => {
  drawPoster();
});
</script>

<?php require __DIR__ . '/../includes/scripts.php'; ?>
</body>
</html>
