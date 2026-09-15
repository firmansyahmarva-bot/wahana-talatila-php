<?php
require_once __DIR__ . '/../config.php';
$s = get_all_settings();
?>
<?php
$page_title = 'Panduan Pemilihan APD Online Gratis — Alat Pelindung Diri K3';
$meta_desc = 'Panduan interaktif pemilihan APD (Alat Pelindung Diri) online gratis. Pilih jenis bahaya atau pekerjaan — sistem rekomendasikan APD yang wajib dipakai sesuai standar K3 Indonesia.';
require __DIR__ . '/../includes/head.php';
?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "SoftwareApplication",
  "applicationCategory": "BusinessApplication",
  "name": "Panduan Pemilihan APD Online Gratis — Alat Pelindung Diri K3",
  "description": "Panduan interaktif pemilihan APD (Alat Pelindung Diri) online gratis. Pilih jenis bahaya atau pekerjaan — sistem rekomendasikan APD yang wajib dipakai sesuai standar K3 Indonesia.",
  "url": "https://wahanatotalita.com/tools/apd-selector/",
  "provider": {"@type": "Organization", "name": "Wahana Totalita", "url": "https://wahanatotalita.com"},
  "offers": {"@type": "Offer", "price": "0", "priceCurrency": "IDR"}
}
</script>
<link rel="manifest" href="/manifest.json">
<style>
:root{--primary:#1a6b3a;--primary-d:#145530;--accent:#f5a623;--bg:#f8fafc;--card:#fff;--text:#1a202c;--muted:#6b7280;--radius:12px;--shadow:0 2px 16px rgba(0,0,0,.09)}
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Segoe UI',system-ui,sans-serif;background:var(--bg);color:var(--text);line-height:1.6}
a{color:var(--primary);text-decoration:none}
.container{max-width:1040px;margin:0 auto;padding:0 20px}
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
.hazard-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(160px,1fr));gap:12px;margin-bottom:32px}
.hazard-btn{background:var(--card);border:2px solid #e5e7eb;border-radius:12px;padding:18px 12px;text-align:center;cursor:pointer;transition:all .2s;font-size:.88rem;font-weight:600}
.hazard-btn:hover{border-color:var(--primary);background:#f0fdf4}
.hazard-btn.active{border-color:var(--primary);background:#f0fdf4;color:var(--primary)}
.hazard-btn .icon{font-size:1.8rem;display:block;margin-bottom:6px}
.result-section{display:none}
.result-section.show{display:block}
.apd-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:16px;margin-bottom:24px}
.apd-card{background:var(--card);border-radius:12px;border:1px solid #e5e7eb;padding:18px;box-shadow:var(--shadow)}
.apd-card.mandatory{border-color:#16a34a;border-width:2px}
.apd-card.recommended{border-color:#d97706}
.apd-header{display:flex;align-items:center;gap:10px;margin-bottom:8px}
.apd-icon{font-size:1.6rem}
.apd-name{font-size:.92rem;font-weight:700}
.apd-badge{font-size:.72rem;padding:2px 10px;border-radius:50px;font-weight:700;display:inline-block;margin-bottom:6px}
.badge-mandatory{background:#dcfce7;color:#16a34a}
.badge-recommended{background:#fef3c7;color:#d97706}
.apd-desc{font-size:.8rem;color:var(--muted);line-height:1.5}
.apd-standard{font-size:.75rem;color:#9ca3af;margin-top:6px;font-style:italic}
.risk-alert{background:#fee2e2;border-left:4px solid #dc2626;border-radius:8px;padding:14px 18px;margin-bottom:20px;font-size:.88rem}
.risk-alert strong{color:#dc2626}
.inspection-checklist{background:#f0fdf4;border-radius:10px;padding:18px;margin-top:16px}
.inspection-checklist h4{font-size:.9rem;font-weight:700;color:var(--primary);margin-bottom:10px}
.chk-item{display:flex;align-items:center;gap:8px;font-size:.83rem;margin-bottom:8px;cursor:pointer}
.chk-item input[type=checkbox]{width:16px;height:16px;accent-color:var(--primary);cursor:pointer}
.chk-item.checked{text-decoration:line-through;color:var(--muted)}
.info-box{background:#f0fdf4;border-left:4px solid var(--primary);border-radius:8px;padding:16px 20px;margin-top:20px}
.info-box h4{font-size:.9rem;font-weight:700;color:var(--primary);margin-bottom:8px}
.info-box li{font-size:.82rem;color:#374151;line-height:1.7}
.info-box ul{padding-left:16px}
.cta-strip{background:var(--primary);color:#fff;border-radius:12px;padding:24px;text-align:center;margin:36px 0}
.cta-strip h3{font-size:1rem;font-weight:700;margin-bottom:8px}
.cta-strip p{opacity:.88;font-size:.85rem;margin-bottom:14px}
footer{background:#111827;color:#9ca3af;padding:30px 0;text-align:center;font-size:.83rem}
footer a{color:#6ee7b7}
.tools-training-cta{padding:40px 0}
.tools-training-cta h2{font-size:1.3rem;font-weight:800;margin:0 0 16px;text-align:center;color:#0A4A2E}
.tools-training-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(230px,1fr));gap:16px}
.tools-training-card{background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:18px;display:flex;flex-direction:column}
.tools-training-card h3{font-size:.95rem;font-weight:700;margin:0 0 8px}
.tools-training-card h3 a{color:#0A4A2E;text-decoration:none}
.tools-training-card p{font-size:.85rem;color:#555;line-height:1.6;margin:0 0 12px;flex:1}
.tools-training-btn{display:inline-block;background:#0A4A2E;color:#fff;font-weight:700;font-size:.85rem;padding:8px 14px;border-radius:8px;text-decoration:none;text-align:center}
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
    <div class="hero-badge">🦺 Panduan APD Gratis</div>
    <h1><span>Panduan Pemilihan APD</span><br>Interaktif Online</h1>
    <p>Pilih jenis bahaya atau jenis pekerjaan — sistem langsung rekomendasikan APD yang wajib dan disarankan beserta cara inspeksinya.</p>
  </div>
</section>

<section class="main">
  <div class="container">
    <h2 style="font-size:1.1rem;font-weight:700;margin-bottom:16px">Pilih Jenis Bahaya atau Jenis Pekerjaan:</h2>

    <div class="hazard-grid" id="hazardGrid">
      <!-- filled by JS -->
    </div>

    <div class="result-section" id="resultSection">
      <!-- filled by JS -->
    </div>

    <div class="info-box">
      <h4>📋 Hierarki Pengendalian Risiko (HIRARKI APD = Terakhir)</h4>
      <ul>
        <li><strong>1. Eliminasi</strong> — hilangkan bahaya dari sumbernya</li>
        <li><strong>2. Substitusi</strong> — ganti dengan bahan/proses yang lebih aman</li>
        <li><strong>3. Engineering Control</strong> — rekayasa teknik (guard, ventilasi, enclosure)</li>
        <li><strong>4. Administratif</strong> — prosedur kerja, rotasi, pelatihan, tanda peringatan</li>
        <li><strong>5. APD</strong> — hanya sebagai LINI TERAKHIR, bukan pengganti kontrol yang lebih tinggi</li>
      </ul>
    </div>

    <div class="cta-strip">
      <h3>🎓 Pelajari APD dan Higiene Industri Secara Mendalam</h3>
      <p>Pelatihan K3 Umum KEMNAKER RI mencakup pemilihan APD, fit test, program higiene industri, dan audit SMK3.</p>
      <a href="https://wa.me/6281235036420?text=Halo%20Wahana%2C%20saya%20pakai%20panduan%20APD%20gratis%20dan%20ingin%20tanya%20pelatihan%20K3" target="_blank" rel="noopener"
         style="background:#25D366;color:#fff;padding:11px 24px;border-radius:8px;font-weight:700;display:inline-flex;align-items:center;gap:8px">
        📱 Tanya Pelatihan K3
      </a>
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
    <p><a href="/tools/">← Semua Tools K3</a> | <a href="/tools/kalkulator-k3">Kalkulator LTIR</a> | <a href="/tools/risk-matrix">Risk Matrix</a> | <a href="/">Wahana Totalita</a></p>
    <p style="margin-top:8px">© <?php echo date('Y'); ?> Wahana Totalita Konsultan, Yogyakarta</p>
  </div>
</footer>

<a href="https://wa.me/6281235036420" target="_blank" style="position:fixed;bottom:24px;right:24px;background:#25D366;width:52px;height:52px;border-radius:50%;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 14px rgba(37,211,102,.4);z-index:999">
  <svg viewBox="0 0 24 24" fill="white" width="26" height="26"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
</a>

<script>
const hazards = [
  {id:'konstruksi',icon:'🏗️',label:'Konstruksi',risk:'HIGH',alert:'Area konstruksi memiliki risiko tinggi benda jatuh, jatuh dari ketinggian, dan paparan debu.',
    apd:[
      {icon:'⛑️',name:'Helm Keselamatan',type:'mandatory',desc:'Helm kelas A atau B untuk perlindungan dari benda jatuh. Wajib di seluruh area konstruksi.',standard:'SNI 0339:2021'},
      {icon:'👟',name:'Sepatu Safety',type:'mandatory',desc:'Sepatu dengan toe cap baja dan anti-slip. Wajib setiap saat di area konstruksi.',standard:'SNI 7037:2022'},
      {icon:'🥽',name:'Kacamata Pelindung',type:'mandatory',desc:'Safety glasses atau goggles untuk perlindungan dari debu, serpihan, dan puing.',standard:'ANSI Z87.1'},
      {icon:'🧤',name:'Sarung Tangan',type:'mandatory',desc:'Sarung tangan kulit atau impact-resistant untuk perlindungan tangan.',standard:'EN 388'},
      {icon:'🦺',name:'Rompi Reflektif',type:'mandatory',desc:'High-visibility vest kelas 2 minimum. Wajib di area dengan lalu lintas kendaraan.',standard:'ANSI 107'},
      {icon:'😷',name:'Masker Debu',type:'recommended',desc:'Respirator N95 atau P2 untuk pekerjaan yang menghasilkan debu (cutting, grinding, demolisi).',standard:'NIOSH N95'},
      {icon:'🪝',name:'Full Body Harness',type:'mandatory',desc:'Wajib untuk pekerjaan di atas 1.8 meter. Harus di-inspect sebelum dipakai.',standard:'SNI 7823:2022'},
    ],
    checks:['Helm tidak ada retak atau penyok besar','Tali harness tidak ada abrasi atau potongan','Kaca kacamata tidak baret parah','Sepatu safety sol tidak terlepas','Sarung tangan tidak ada lubang besar']
  },
  {id:'las',icon:'🔥',label:'Pengelasan / Las',risk:'HIGH',alert:'Bahaya percikan api, radiasi UV, asap las, dan kebakaran.',
    apd:[
      {icon:'⛑️',name:'Helm/Topeng Las',type:'mandatory',desc:'Auto-darkening welding helmet atau topeng las dengan filter lens yang sesuai untuk melindungi mata dan wajah dari radiasi UV/IR.',standard:'ANSI Z87.1'},
      {icon:'🧤',name:'Sarung Tangan Las',type:'mandatory',desc:'Sarung tangan kulit lengan panjang untuk perlindungan dari percikan api dan panas.',standard:'EN 12477'},
      {icon:'🥽',name:'Kacamata Pelindung',type:'mandatory',desc:'Safety glasses di bawah topeng las untuk perlindungan saat mengangkat topeng.',standard:'EN 169'},
      {icon:'👟',name:'Sepatu Safety',type:'mandatory',desc:'Sepatu kulit dengan toe cap baja, tahan percikan api.',standard:'SNI 7037'},
      {icon:'😷',name:'Respirator Las',type:'mandatory',desc:'Half-face respirator dengan filter asap las (OV/P100) untuk area berventilasi buruk.',standard:'NIOSH'},
      {icon:'🧥',name:'Apron/Jaket Las',type:'mandatory',desc:'Apron kulit atau flame-resistant jacket untuk perlindungan dari percikan api dan radiasi panas.',standard:'ANSI/ISEA 105'},
    ],
    checks:['Lens topeng las tidak retak dan shading sesuai','Sarung tangan kulit tidak bolong atau terbakar','Jaket/apron tidak ada sobekan besar','Respirator filter tidak expired','Tidak ada bahan mudah terbakar dalam radius 10 meter']
  },
  {id:'kimia',icon:'⚗️',label:'Bahan Kimia / B3',risk:'HIGH',alert:'Paparan bahan kimia berbahaya dapat menyebabkan iritasi, keracunan, atau penyakit kronis. Selalu baca SDS/MSDS.',
    apd:[
      {icon:'🥽',name:'Kacamata/Face Shield',type:'mandatory',desc:'Chemical splash goggles atau face shield untuk perlindungan mata dan wajah dari percikan kimia.',standard:'ANSI Z87.1'},
      {icon:'🧤',name:'Sarung Tangan Kimia',type:'mandatory',desc:'Pilih material sesuai bahan kimia: nitrile (solvents), neoprene (asam/basa), butyl (keton/ester). Periksa chemical resistance chart.',standard:'EN 374'},
      {icon:'😷',name:'Respirator Kimia',type:'mandatory',desc:'Half-face atau full-face respirator dengan kartrid OV (Organic Vapor) atau acid gas sesuai jenis bahan kimia.',standard:'NIOSH'},
      {icon:'🥼',name:'Apron/Baju Kimia',type:'mandatory',desc:'Chemical resistant apron atau coverall sesuai tingkat risiko. Untuk highly hazardous: full chemical suit.',standard:'EN 13982'},
      {icon:'👟',name:'Sepatu/Boot Kimia',type:'mandatory',desc:'Chemical resistant boots untuk pekerjaan dengan risiko tumpahan kimia besar.',standard:'EN 13287'},
    ],
    checks:['Baca SDS untuk APD yang tepat sebelum kerja','Integritas sarung tangan tidak ada lubang atau retakan','Filter respirator belum expired','Eye wash station berfungsi di area kimia','Spill kit tersedia dan lengkap']
  },
  {id:'ketinggian',icon:'🪜',label:'Bekerja di Ketinggian',risk:'EXTREME',alert:'WAJIB: Full body harness + anchor point + izin kerja di ketinggian untuk setiap pekerjaan di atas 1.8 meter.',
    apd:[
      {icon:'🪝',name:'Full Body Harness',type:'mandatory',desc:'Full body harness kelas A (work positioning) atau kelas B (fall arrest). Wajib untuk pekerjaan di atas 1.8m.',standard:'SNI 7823:2022 / EN 361'},
      {icon:'🔗',name:'Lanyard / Energy Absorber',type:'mandatory',desc:'Lanyard dengan shock absorber untuk perlindungan fall arrest. Panjang max 1.8m. Twin-tail lanyard untuk pindah anchor.',standard:'EN 354 / EN 355'},
      {icon:'⛑️',name:'Helm Keselamatan',type:'mandatory',desc:'Helm dengan chin strap yang terpasang. Wajib di semua area ketinggian.',standard:'SNI 0339:2021'},
      {icon:'👟',name:'Sepatu Anti-Slip',type:'mandatory',desc:'Sepatu dengan grip outsole yang baik. Khusus untuk bekerja di atap: sepatu khusus roofing.',standard:'EN ISO 20345'},
      {icon:'🧤',name:'Sarung Tangan Grip',type:'recommended',desc:'Sarung tangan anti-slip untuk pekerjaan di tangga atau scaffolding.',standard:'EN 388'},
    ],
    checks:['Strap harness tidak ada abrasi, sobekan, atau jahitan terlepas','Karabiner/hook berfungsi dengan mulus, tidak ada karat','Energy absorber belum pernah terguncang (hanya sekali pakai setelah fall event)','Lanyard tidak ada potongan atau kerusakan','Anchor point memiliki kekuatan min 15 kN']
  },
  {id:'listrik',icon:'⚡',label:'Pekerjaan Listrik',risk:'HIGH',alert:'Bahaya sengatan listrik, arc flash, dan kebakaran. Wajib LOTO sebelum pekerjaan listrik apapun.',
    apd:[
      {icon:'🧤',name:'Sarung Tangan Insulated',type:'mandatory',desc:'Electrical insulating gloves sesuai voltage class. Class 00 (500V), Class 0 (1000V), Class 2 (17kV). Wajib di pekerjaan listrik.',standard:'IEC 60903'},
      {icon:'🥽',name:'Safety Glasses / Arc Flash',type:'mandatory',desc:'Safety glasses untuk pekerjaan umum listrik. Arc flash face shield (min 8 cal/cm²) untuk pekerjaan pada panel bertegangan.',standard:'ANSI Z87.1 / NFPA 70E'},
      {icon:'⛑️',name:'Helm Non-Konduktif',type:'mandatory',desc:'Helm kelas E (Electrical) yang diuji hingga 20.000V. Hindari helm dengan lubang ventilasi logam.',standard:'ANSI/ISEA Z89.1 Class E'},
      {icon:'🧥',name:'Pakaian FR / Arc Flash',type:'mandatory',desc:'Flame-resistant clothing dengan rating arc flash sesuai NFPA 70E Hazard Risk Category (HRC). Untuk HRC 2+: coverall FR min 8 cal/cm².',standard:'NFPA 70E'},
      {icon:'👟',name:'Sepatu Dielektrik',type:'mandatory',desc:'Sepatu dengan insole dielektrik yang diuji sesuai standar listrik.',standard:'ASTM F2413'},
    ],
    checks:['Cek tanggal expired sarung tangan listrik (max 6 bulan setelah test date)','Tidak ada lubang kecil pun di sarung tangan (inflate test)','Helm kelas E - tidak ada keretakan','Pakaian FR tidak terkontaminasi minyak/bahan mudah terbakar','LOTO sudah terpasang dan diverifikasi sebelum kerja']
  },
  {id:'kebisingan',icon:'🔊',label:'Area Bising',risk:'MEDIUM',alert:'NAB kebisingan = 85 dB(A) untuk 8 jam. Paparan di atas NAB wajib APD pendengaran.',
    apd:[
      {icon:'👂',name:'Ear Plug',type:'mandatory',desc:'Ear plug foam disposable NRR 29-33 dB atau reusable ear plug. Cara pasang: gulung, tarik daun telinga ke atas-belakang, masukkan.',standard:'ANSI S3.19 / SNI'},
      {icon:'🎧',name:'Ear Muff',type:'recommended',desc:'Ear muff untuk area di atas 95 dB atau untuk pemakaian di atas 4 jam. NRR 25-31 dB. Lebih mudah dipakai dengan benar.',standard:'ANSI S3.19'},
      {icon:'⛑️',name:'Helm dengan Ear Muff',type:'recommended',desc:'Helmet-mounted ear muff untuk area konstruksi/industri berat. Kombinasi perlindungan kepala dan pendengaran.',standard:'EN 352-3'},
    ],
    checks:['Ear plug tidak keras/kaku (harus lentur dan bisa kembali ke bentuk semula)','Ear muff bantalan tidak robek atau kering/retak','Pastikan ear plug dipasang dengan benar (gulung tipis, masukkan sampai flush)','Hearing test / audiometri dilakukan minimal setahun sekali untuk pekerja terdampak']
  },
  {id:'debu',icon:'💨',label:'Debu & Partikel',risk:'MEDIUM',alert:'Paparan debu silika, asbes, atau debu logam dapat menyebabkan penyakit paru permanen.',
    apd:[
      {icon:'😷',name:'Respirator N95/P2',type:'mandatory',desc:'Respirator minimal N95 (95% filter) untuk debu partikel umum. P100 untuk debu logam, silika, atau debu radioaktif.',standard:'NIOSH N95 / AS/NZS 1716'},
      {icon:'🥽',name:'Safety Glasses',type:'mandatory',desc:'Safety glasses dengan side shield untuk perlindungan mata dari debu.',standard:'ANSI Z87.1'},
      {icon:'⛑️',name:'Helm',type:'recommended',desc:'Helm dengan pelindung wajah untuk proses sandblasting atau demolisi.',standard:'SNI 0339'},
      {icon:'🥼',name:'Coverall / Tyvek',type:'recommended',desc:'Disposable coverall Tyvek untuk pekerjaan asbes atau debu tinggi. Jangan bawa pakaian kerja berdebu ke rumah.',standard:'EN 13982 Type 5/6'},
    ],
    checks:['Respirator fit dengan baik — tidak ada celah di sekitar hidung','Seal check sebelum memasuki area berdebu (negative pressure test)','Filter respirator tidak basah atau berdebu lebat (ganti jika sukar bernapas)','Tidak ada tanda abrasion pada seal area respirator']
  },
  {id:'panas',icon:'🌡️',label:'Panas / Radiasi Panas',risk:'MEDIUM',alert:'Heat stress berbahaya terutama di area outdoor atau dekat furnace/boiler. Hidrasi dan istirahat sangat penting.',
    apd:[
      {icon:'🧢',name:'Topi Pelindung Matahari',type:'mandatory',desc:'Wide-brim sun hat atau helm dengan pelindung leher untuk outdoor. UV protection rating 50+.',standard:'AS/NZS 4399'},
      {icon:'🧥',name:'Pakaian Terang / Breathable',type:'recommended',desc:'Pakaian berwarna terang, breathable (polyester mesh atau katun). Hindari pakaian gelap di outdoor panas.',standard:'—'},
      {icon:'🥽',name:'Kacamata Anti-UV',type:'recommended',desc:'Safety glasses dengan UV 400 filter untuk outdoor. Melindungi dari UV yang merusak mata.',standard:'ANSI Z87.1'},
      {icon:'🧤',name:'Sarung Tangan Panas',type:'mandatory',desc:'Heat-resistant gloves untuk area dekat sumber panas (furnace, oven, boiler). Rating sesuai suhu operasi.',standard:'EN 407'},
      {icon:'🦺',name:'Rompi Pendingin',type:'recommended',desc:'Cooling vest dengan ice pack atau evaporative untuk pekerja di area sangat panas (>35°C WBGT).',standard:'—'},
    ],
    checks:['Pakaian bersih dan tidak terkontaminasi bahan mudah terbakar','Sarung tangan panas tidak bolong atau retak','Cooling vest ice pack masih dingin (ganti setiap 2-3 jam)','Suplai air minum cukup di area kerja']
  },
  {id:'confined',icon:'🕳️',label:'Ruang Terbatas',risk:'EXTREME',alert:'WAJIB: Test gas, permit entry, attendant standby, retrieval system. JANGAN masuk confined space sendirian.',
    apd:[
      {icon:'😷',name:'SCBA / Supplied Air',type:'mandatory',desc:'Self-Contained Breathing Apparatus untuk confined space yang tidak aman (O2 defisiensi, toxic atmosphere). TIDAK BISA diganti respirator biasa.',standard:'NIOSH / EN 137'},
      {icon:'🪝',name:'Full Body Harness + Retrieval',type:'mandatory',desc:'Full body harness kelas D (confined space rescue) dengan tripod retrieval system. Wajib untuk confined space vertical entry.',standard:'EN 361'},
      {icon:'⛑️',name:'Helm dengan Chin Strap',type:'mandatory',desc:'Helm dengan chin strap kencang untuk confined space. Penting untuk proses retrieval.',standard:'SNI 0339'},
      {icon:'🔦',name:'Lampu Intrinsically Safe',type:'mandatory',desc:'Lampu senter atau headlamp yang intrinsically safe (Ex-rated) untuk confined space berpotensi explosive atmosphere.',standard:'ATEX / IECEx'},
      {icon:'📱',name:'Gas Detector',type:'mandatory',desc:'Personal gas detector (O2, LEL, H2S, CO) wajib dibawa ke dalam confined space dan dikalibrasi sebelum entry.',standard:'IEC 60079'},
    ],
    checks:['SCBA cylinder terisi penuh (min 90% atau sesuai SOP)','Face piece SCBA tidak ada retak, seal bersih','Gas detector dikalibrasi dan bump-test sehari sebelumnya','Retrieval system terpasang dan attendant siap','SEMUA langkah permit entry sudah selesai sebelum masuk']
  },
  {id:'medis',icon:'🏥',label:'Kesehatan / Medis',risk:'MEDIUM',alert:'Perlindungan dari paparan darah, cairan tubuh, dan patogen (Bloodborne Pathogens).',
    apd:[
      {icon:'🧤',name:'Sarung Tangan Latex/Nitrile',type:'mandatory',desc:'Sarung tangan sekali pakai untuk penanganan pasien atau sampel biologis. Nitrile lebih baik (bebas latex allergy).',standard:'EN 455'},
      {icon:'😷',name:'Masker Bedah / N95',type:'mandatory',desc:'Masker bedah untuk proteksi dasar. N95 untuk prosedur aerosol-generating atau risiko airborne disease.',standard:'ASTM F2100 / NIOSH N95'},
      {icon:'🥽',name:'Eye Protection / Face Shield',type:'mandatory',desc:'Safety glasses atau face shield untuk prosedur dengan risiko percikan darah/cairan tubuh.',standard:'ANSI Z87.1'},
      {icon:'🥼',name:'Gown / Apron',type:'mandatory',desc:'Disposable gown atau apron impermeable untuk prosedur dengan risiko percikan atau kontaminasi pakaian.',standard:'EN 14126'},
    ],
    checks:['Sarung tangan tidak ada lubang dan tidak expired','Masker tidak rusak atau basah','Sarung tangan SELALU dilepas dengan teknik yang benar (don\'t touch outer surface)','Hand hygiene sebelum dan sesudah melepas APD']
  },
];

function buildHazardGrid(){
  const grid = document.getElementById('hazardGrid');
  grid.innerHTML = hazards.map(h=>`
    <div class="hazard-btn" id="hbtn-${h.id}" onclick="selectHazard('${h.id}')">
      <span class="icon">${h.icon}</span>
      ${h.label}
    </div>
  `).join('');
}

function selectHazard(id){
  document.querySelectorAll('.hazard-btn').forEach(b=>b.classList.remove('active'));
  document.getElementById(`hbtn-${id}`).classList.add('active');

  const h = hazards.find(x=>x.id===id);
  const section = document.getElementById('resultSection');
  section.className = 'result-section show';

  section.innerHTML = `
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:16px">
      <span style="font-size:2rem">${h.icon}</span>
      <div>
        <h2 style="font-size:1.2rem;font-weight:800">${h.label} — Rekomendasi APD</h2>
        <span style="font-size:.78rem;background:${h.risk==='EXTREME'?'#fee2e2':h.risk==='HIGH'?'#ffedd5':'#fef3c7'};color:${h.risk==='EXTREME'?'#dc2626':h.risk==='HIGH'?'#c2410c':'#b45309'};padding:2px 12px;border-radius:50px;font-weight:700">Risk Level: ${h.risk}</span>
      </div>
    </div>
    <div class="risk-alert"><strong>⚠️ Perhatian:</strong> ${h.alert}</div>
    <div class="apd-grid">
      ${h.apd.map(a=>`
        <div class="apd-card ${a.type}">
          <div class="apd-header">
            <span class="apd-icon">${a.icon}</span>
            <span class="apd-name">${a.name}</span>
          </div>
          <span class="apd-badge badge-${a.type}">${a.type==='mandatory'?'⚠️ WAJIB':'✓ Disarankan'}</span>
          <div class="apd-desc">${a.desc}</div>
          <div class="apd-standard">Standar: ${a.standard}</div>
        </div>
      `).join('')}
    </div>
    <div class="inspection-checklist">
      <h4>✅ Checklist Inspeksi APD Sebelum Kerja</h4>
      ${h.checks.map((c,i)=>`
        <label class="chk-item" id="chk-${i}">
          <input type="checkbox" onchange="toggleCheck('chk-${i}')"> ${c}
        </label>
      `).join('')}
    </div>
    <div style="display:flex;gap:12px;margin-top:16px;flex-wrap:wrap">
      <button onclick="window.print()" style="background:var(--primary);color:#fff;border:none;border-radius:8px;padding:10px 20px;font-size:.85rem;font-weight:600;cursor:pointer">🖨 Print Checklist</button>
      <a href="https://wa.me/6281235036420?text=Halo%20Wahana%2C%20saya%20pakai%20panduan%20APD%20untuk%20${encodeURIComponent(h.label)}%20dan%20ingin%20konsultasi%20K3" target="_blank" style="background:#25D366;color:#fff;border-radius:8px;padding:10px 20px;font-size:.85rem;font-weight:600;display:inline-flex;align-items:center;gap:6px">📱 Konsultasi K3</a>
    </div>
  `;
  section.scrollIntoView({behavior:'smooth',block:'start'});
}

function toggleCheck(id){
  const label = document.getElementById(id);
  label.classList.toggle('checked');
}

buildHazardGrid();
</script>
</body>
</html>
