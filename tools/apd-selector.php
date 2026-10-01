<?php
require_once __DIR__ . '/../config.php';
$s = get_all_settings();

$page_title = 'Panduan Pemilihan APD K3 2026: Standar Permenaker 08/2010, SNI & ANSI';
$meta_desc = 'Panduan lengkap pemilihan Alat Pelindung Diri (APD) K3 sesuai Permenaker No. 08/2010, standar SNI, ANSI, & EN. Evaluasi spesifikasi teknis 7 organ tubuh dan checklist inspeksi.';

ob_start();
require __DIR__ . '/../includes/head.php';
$shared_head = ob_get_clean();
$shared_head = preg_replace('~<title>.*?</title>~s', '<title>' . e($page_title) . '</title>', $shared_head, 1);
echo $shared_head;

// Master database of PPE specifications
$apdList = [
  [
    "id" => "kepala",
    "kategori" => "Pelindung Kepala (Head Protection)",
    "nama" => "Safety Helmet (Helm Keselamatan)",
    "standar" => "SNI ISO 3873:2012 / ANSI Z89.1 (Tipe I & II, Kelas E, G, C)",
    "bahaya" => "Tertimpa benda jatuh, benturan struktur rendah, kontak listrik tegangan tinggi.",
    "spesifikasi" => "Cangkang HDPE / ABS tahan benturan, suspensi 4 atau 6 titik, chin strap elastis, tahan voltase listrik hingga 20.000V (Kelas E).",
    "masa_pakai" => "Umur pakai maksimal 3 - 5 tahun dari tanggal pembuatan, atau langsung diganti jika pernah terkena benturan keras.",
    "inspeksi" => "Periksa retakan mikro pada cangkang, kelenturan suspensi harness, dan elastisitas tali dagu."
  ],
  [
    "id" => "mata",
    "kategori" => "Pelindung Mata & Wajah (Eye & Face Protection)",
    "nama" => "Safety Goggles & Face Shield",
    "standar" => "SNI 16-0158-1987 / ANSI Z87.1+ / EN 166",
    "bahaya" => "Percikan bahan kimia asam/basa, partikel gerinda kecepatan tinggi, radiasi sinar UV/las.",
    "spesifikasi" => "Lensa polikarbonat anti-fog & anti-scratch dengan proteksi samping (side shield), pelindung wajah transparan asetat untuk cairan kimia.",
    "masa_pakai" => "Ganti saat lensa tergores buram atau pita karet pengikat mengendur.",
    "inspeksi" => "Pastikan kejernihan pandangan bebas distorsi dan segel bantalan silikon menempel rapat pada lekuk wajah."
  ],
  [
    "id" => "pernapasan",
    "kategori" => "Pelindung Pernapasan (Respiratory Protection)",
    "nama" => "Respirator Partikulat & Gas (Half/Full Face)",
    "standar" => "SNI 19-3998-1995 / NIOSH 42 CFR 84 (N95, P100) / EN 14387",
    "bahaya" => "Inhalasi debu silika, uap pelarut organik (VOC), gas beracun (H2S, CO, NH3), asap logam (fume).",
    "spesifikasi" => "Bodi silikon food-grade hypoallergenic, katup ekshalasi ganda, cartridge kombinasi filter partikulat + adsorben karbon aktif.",
    "masa_pakai" => "Cartridge gas wajib diganti saat tercium bau kimia atau sesuai batas jam jenuh (breakthrough time).",
    "inspeksi" => "Uji segel tekanan positif (hembus napas) dan tekanan negatif (tarik napas) sebelum memasuki area kerja terkontaminasi."
  ],
  [
    "id" => "telinga",
    "kategori" => "Pelindung Pendengaran (Hearing Protection)",
    "nama" => "Earplug & Earmuff (Sumbat & Tutup Telinga)",
    "standar" => "ANSI S3.19 / EN 352-1 (Earmuff) & EN 352-2 (Earplug)",
    "bahaya" => "Kebisingan mesin di atas NAB 85 dBA, suara letupan mendadak impulsif.",
    "spesifikasi" => "Earplug busa poliuretan expand perlahan (NRR 28-33 dB), earmuff berkantong busa kedap dengan headband pegas baja (NRR 22-30 dB).",
    "masa_pakai" => "Earplug sekali pakai dibuang setelah 1 shift; Earmuff diganti bantalan busanya setiap 6 bulan.",
    "inspeksi" => "Pastikan bantalan earmuff tidak pecah/kaku dan busa earplug kembali ke bentuk semula saat diremas."
  ],
  [
    "id" => "tangan",
    "kategori" => "Pelindung Tangan (Hand Protection)",
    "nama" => "Sarung Tangan K3 (Safety Gloves)",
    "standar" => "SNI 06-0652-2005 / EN 388 (Mekanik) / EN 374 (Kimia) / EN 407 (Panas)",
    "bahaya" => "Tergores plat besi tajam, tersiram asam pekat, panas lelehan logam, sengatan arus listrik.",
    "spesifikasi" => "Sarung tangan anti-potong serat Kevlar/HPPE (Cut Level 5), sarung tangan nitril tebal tahan kimia, sarung tangan kulit las, sarung tangan isolasi listrik berlabel kelas tegangan.",
    "masa_pakai" => "Ganti saat lapisan nitril melar/tembus kimia atau serat kain berlubang pada ujung jari.",
    "inspeksi" => "Uji tiup udara untuk mendeteksi kebocoran jarum mikro pada sarung tangan kimia dan isolasi listrik."
  ],
  [
    "id" => "kaki",
    "kategori" => "Pelindung Kaki (Foot Protection)",
    "nama" => "Safety Shoes / Safety Boots",
    "standar" => "SNI 7079:2009 / SNI 0111:2009 / ASTM F2413 / EN ISO 20345 (S1P, S3)",
    "bahaya" => "Tertimpa benda berat hingga 200 Joule, tertusuk paku lantai, tergelincir oli, sengatan listrik tanah.",
    "spesifikasi" => "Pelindung jari baja/komposit (Steel/Composite Toe Cap), pelat sol baja anti-tusuk (Steel Midsole), sol poliuretan tahan minyak dan licin (Anti-slip / Oil Resistant).",
    "masa_pakai" => "Maksimal 1 - 2 tahun tergantung keausan kembangan sol tapak luar.",
    "inspeksi" => "Periksa keausan sol bawah, pastikan tutup baja tidak menonjol menembus kulit sepatu."
  ],
  [
    "id" => "ketinggian",
    "kategori" => "Perlindungan Jatuh (Fall Protection)",
    "nama" => "Full Body Harness & Lanyard Shock Absorber",
    "standar" => "SNI 0420:2018 / ANSI Z359.11 / EN 361 & EN 355",
    "bahaya" => "Terjatuh dari ketinggian > 1.8 meter, benturan fatal ke tanah atau struktur bawah.",
    "spesifikasi" => "Anyaman serat poliester kekuatan tarik minimal 22 kN, D-ring punggung (dorsal) baja tempa, double lanyard dengan energy absorber peredam kejut benturan.",
    "masa_pakai" => "Maksimal 5 tahun dari tanggal perakitan pabrik, atau langsung dimusnahkan jika pernah menahan beban orang jatuh.",
    "inspeksi" => "Periksa jahitan webbing dari benang putus, karat pada D-ring, dan pastikan sobekan indikator jatuh (fall indicator) masih utuh."
  ]
];
?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    { "@type": "ListItem", "position": 1, "name": "Beranda", "item": "https://wahanatotalita.com/" },
    { "@type": "ListItem", "position": 2, "name": "Tools K3", "item": "https://wahanatotalita.com/tools/" },
    { "@type": "ListItem", "position": 3, "name": "Panduan APD", "item": "https://wahanatotalita.com/tools/apd-selector.php" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebApplication",
  "name": "Panduan Pemilihan APD K3 Standar SNI & Permenaker 08/2010",
  "url": "https://wahanatotalita.com/tools/apd-selector.php",
  "description": "Pedoman teknis pemilihan dan inspeksi kelayakan Alat Pelindung Diri (APD) K3 untuk seluruh organ tubuh sesuai standar SNI, ANSI, dan EN.",
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
      "name": "Bolehkah perusahaan memotong gaji pekerja untuk pembelian APD?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "TIDAK BOLEH. Pasal 2 Permenaker No. 08/MEN/VII/2010 secara tegas mewajibkan pengusaha untuk menyediakan Alat Pelindung Diri (APD) bagi pekerja/buruh di tempat kerja secara CUMA-CUMA (gratis). Pemotongan gaji untuk pembelian APD wajib merupakan pelanggaran hukum ketenagakerjaan."
      }
    },
    {
      "@type": "Question",
      "name": "Kapan helm safety (safety helmet) harus diganti meskipun tidak terlihat retak?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Safety helmet memiliki masa pakai pabrikan rata-rata 3 hingga 5 tahun karena paparan radiasi sinar UV matahari dan perubahan suhu lingkungan dapat menyebabkan degradasi polimer plastik menjadi getas. Selain itu, jika helm pernah terbentur keras oleh benda jatuh, helm wajib segera dimusnahkan dan diganti baru seketika."
      }
    },
    {
      "@type": "Question",
      "name": "Mengapa sabuk pengaman pinggang (safety belt) dilarang untuk pekerjaan ketinggian?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Sabuk pengaman pinggang (waist belt) dilarang digunakan sebagai penahan jatuh (fall arrest) berdasarkan Permenaker 09/2016 dan standar internasional karena saat pekerja terjatuh bebas, gaya sentakan mendadak akan terpusat di pinggang dan tulang belakang, yang dapat menyebabkan patah tulang punggung atau kerusakan organ dalam fatal. Pekerjaan ketinggian wajib menggunakan Full Body Harness."
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
.apd-hero {
  background: linear-gradient(135deg, #071524 0%, #0D233A 60%, #183654 100%);
  color: #fff;
  padding: 58px 0 44px;
  position: relative;
  overflow: hidden;
  border-bottom: 3px solid var(--orange);
}
.apd-hero::before {
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
.apd-hero h1 {
  font-family: 'Lexend', sans-serif;
  font-size: clamp(1.8rem, 3.6vw, 2.7rem);
  font-weight: 800;
  line-height: 1.2;
  margin-bottom: 12px;
}
.apd-hero h1 span { color: var(--orange); }
.apd-hero p {
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
.apd-wrapper { padding: 40px 0 60px; }

/* FILTER PILLS */
.filter-bar {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin-bottom: 28px;
}
.filter-btn {
  background: #fff;
  border: 1.5px solid var(--slate-300);
  padding: 8px 16px;
  border-radius: 999px;
  font-size: 0.86rem;
  font-weight: 600;
  color: var(--slate-700);
  cursor: pointer;
  transition: all 0.2s;
}
.filter-btn:hover, .filter-btn.active {
  background: var(--navy);
  border-color: var(--navy);
  color: #fff;
}

/* APD CARDS GRID */
.apd-cards-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
  gap: 24px;
  margin-bottom: 40px;
}
@media (max-width: 600px) {
  .apd-cards-grid { grid-template-columns: 1fr; }
}

.apd-card {
  background: #fff;
  border: 1px solid var(--slate-200);
  border-radius: var(--radius-lg);
  padding: 24px;
  box-shadow: var(--shadow-sm);
  display: flex;
  flex-direction: column;
  transition: transform 0.2s, box-shadow 0.2s;
}
.apd-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 10px 24px rgba(13,35,58,0.08);
}
.apd-badge {
  font-size: 0.75rem;
  font-weight: 700;
  color: var(--orange);
  text-transform: uppercase;
  margin-bottom: 6px;
  letter-spacing: 0.04em;
}
.apd-title {
  font-family: 'Lexend', sans-serif;
  font-size: 1.18rem;
  font-weight: 800;
  color: var(--navy);
  margin-bottom: 8px;
}
.apd-standard {
  background: var(--slate-100);
  padding: 4px 10px;
  border-radius: 6px;
  font-size: 0.78rem;
  font-weight: 600;
  color: var(--slate-700);
  margin-bottom: 14px;
  display: inline-block;
}
.apd-spec-list {
  font-size: 0.86rem;
  color: var(--slate-700);
  line-height: 1.6;
  margin-bottom: 16px;
  flex-grow: 1;
}
.apd-spec-list div { margin-bottom: 8px; }
.apd-spec-list strong { color: var(--navy); }

.apd-inspect-box {
  background: var(--slate-50);
  border: 1px solid var(--slate-200);
  border-radius: 8px;
  padding: 12px;
  font-size: 0.8rem;
  color: var(--slate-600);
  margin-top: auto;
}
.apd-inspect-box strong { color: var(--navy); }

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

<main class="apd-page" id="konten-utama">

<!-- HERO -->
<section class="apd-hero">
  <div class="container">
    <div class="hero-badge">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
      Permenaker No. 08/MEN/VII/2010 &amp; SNI
    </div>
    <h1>Panduan Pemilihan APD K3 <span>Lengkap 2026</span></h1>
    <p>Pedoman standar spesifikasi teknis Alat Pelindung Diri (APD) untuk seluruh organ tubuh manusia. Memenuhi standar SNI, ANSI, dan EN Eropa lengkap dengan panduan inspeksi kelayakan pra-pakai.</p>
    <div class="hero-tags">
      <span class="hero-tag">7 Kategori Perlindungan Organ Tubuh</span>
      <span class="hero-tag">Standar SNI &amp; ANSI / EN Terverifikasi</span>
      <span class="hero-tag">Checklist Pra-Pakai &amp; Masa Kadaluarsa</span>
      <span class="hero-tag">Kewajiban Pengusaha Menyediakan Cuma-Cuma</span>
    </div>
  </div>
</section>

<!-- MAIN WORKSPACE -->
<section class="apd-wrapper">
  <div class="container">
    
    <!-- FILTER BAR -->
    <div class="filter-bar">
      <button class="filter-btn active" type="button" onclick="filterApd('all', this)">Semua APD (7 Organ Tubuh)</button>
      <button class="filter-btn" type="button" onclick="filterApd('kepala', this)">Kepala (Helmet)</button>
      <button class="filter-btn" type="button" onclick="filterApd('mata', this)">Mata &amp; Wajah</button>
      <button class="filter-btn" type="button" onclick="filterApd('pernapasan', this)">Pernapasan (Respirator)</button>
      <button class="filter-btn" type="button" onclick="filterApd('telinga', this)">Pendengaran (Earplug)</button>
      <button class="filter-btn" type="button" onclick="filterApd('tangan', this)">Tangan (Gloves)</button>
      <button class="filter-btn" type="button" onclick="filterApd('kaki', this)">Kaki (Safety Shoes)</button>
      <button class="filter-btn" type="button" onclick="filterApd('ketinggian', this)">Ketinggian (Harness)</button>
    </div>

    <!-- SERVER-RENDERED APD SPECIFICATION CARDS -->
    <div class="apd-cards-grid" id="apdCards">
      <?php foreach ($apdList as $a): ?>
      <div class="apd-card" data-cat="<?php echo e($a['id']); ?>">
        <div class="apd-badge"><?php echo e($a['kategori']); ?></div>
        <h3 class="apd-title"><?php echo e($a['nama']); ?></h3>
        <div class="apd-standard">Standar: <?php echo e($a['standar']); ?></div>
        
        <div class="apd-spec-list">
          <div><strong>Potensi Bahaya:</strong> <?php echo e($a['bahaya']); ?></div>
          <div><strong>Spesifikasi Wajib:</strong> <?php echo e($a['spesifikasi']); ?></div>
          <div><strong>Masa Pakai / Kadaluarsa:</strong> <?php echo e($a['masa_pakai']); ?></div>
        </div>

        <div class="apd-inspect-box">
          <strong>Poin Kritis Inspeksi Pra-Pakai:</strong><br>
          <?php echo e($a['inspeksi']); ?>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- IN-DEPTH EDITORIAL ARTICLE (SEO DEPTH) -->
    <div class="editorial-box">
      <h2 class="editorial-title">Kewajiban Hukum Penyediaan Alat Pelindung Diri di Tempat Kerja</h2>
      <p class="editorial-p">
        Berdasarkan <strong>Peraturan Menteri Tenaga Kerja dan Transmigrasi RI No. PER.08/MEN/VII/2010 tentang Alat Pelindung Diri</strong>, pengusaha diwajibkan menyediakan APD bagi pekerja/buruh di tempat kerja secara CUMA-CUMA, wajib mencantumkan Standar Nasional Indonesia (SNI) atau standar internasional yang setara, serta wajib mengumumkan instruksi tertulis dan memasang rambu-rambu APD di lokasi kerja.
      </p>

      <h3 style="color:var(--navy);font-family:'Lexend',sans-serif;font-size:1.15rem;margin:22px 0 10px">Prinsip Hirarki Pengendalian Bahaya: Mengapa APD Adalah Garis Terakhir?</h3>
      <p class="editorial-p">
        Dalam ilmu Keselamatan Kerja modern, pemakaian APD menempati peringkat terbawah (garis pertahanan terakhir / <em>last line of defense</em>). Alasan utama mengapa APD berada di tingkat terbawah adalah:
      </p>
      <ul style="padding-left:22px;color:var(--slate-700);line-height:1.75;margin-bottom:20px">
        <li><strong>Bahaya Tetap Ada:</strong> APD tidak menghilangkan atau mengurangi sumber bahaya itu sendiri, melainkan hanya membangun perisai sementara pada tubuh pekerja.</li>
        <li><strong>Faktor Kesalahan Manusia (Human Factor):</strong> Jika APD dipakai dengan ukuran longgar, terpasang miring, atau dilepas sesaat karena gerah, pekerja seketika kehilangan seluruh perlindungan dan rentan terkena bahaya fatal.</li>
        <li><strong>Menimbulkan Ketidaknyamanan Fisik:</strong> Penggunaan APD yang lama dapat meningkatkan beban panas tubuh (heat stress), membatasi bidang pandang mata, atau mengurangi kelincahan pergerakan jari tangan.</li>
      </ul>

      <!-- FAQ ACCORDION -->
      <h3 style="color:var(--navy);font-family:'Lexend',sans-serif;font-size:1.25rem;margin:28px 0 16px">Tanya Jawab Seputar Pemilihan APD K3 (FAQ)</h3>
      <div class="faq-box">
        
        <div class="faq-item">
          <button class="faq-q" onclick="toggleFaq(this)">
            <span>Bagaimana jika pekerja menolak menggunakan APD yang sudah disediakan?</span>
            <span class="faq-icon">▼</span>
          </button>
          <div class="faq-a">
            Pasal 12 huruf b UU No. 1 Tahun 1970 menyatakan bahwa tenaga kerja WAJIB memakai alat-alat perlindungan diri yang diwajibkan. Jika pekerja menolak memakai APD setelah diberikan pembinaan, manajemen berhak memberikan sanksi indisipliner (Surat Peringatan / SP) hingga menonaktifkan pekerja dari area bahaya demi keselamatan bersama.
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-q" onclick="toggleFaq(this)">
            <span>Apakah APD bekas pekerja lama boleh dihibahkan ke pekerja baru?</span>
            <span class="faq-icon">▼</span>
          </button>
          <div class="faq-a">
            Untuk APD yang bersentuhan langsung dengan kulit dan bersifat higienis (seperti earplug, sepatu safety, sarung tangan kain, dan masker respirator), APD TIDAK BOLEH dipindahtangankan karena risiko penularan infeksi dermatologis dan saluran napas. Namun untuk APD struktural (seperti safety helmet atau full body harness), pemindahtanganan diperbolehkan asalkan telah melalui proses dekontaminasi dan inspeksi kelayakan fisik oleh Petugas K3.
          </div>
        </div>

      </div>

    </div>

  </div>
</section>

</main>

<?php require __DIR__ . '/../includes/footer.php'; ?>

<script>
function filterApd(cat, btn){
  document.querySelectorAll('.filter-bar .filter-btn').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');

  const cards = document.querySelectorAll('.apd-card');
  cards.forEach(card => {
    if(cat === 'all' || card.getAttribute('data-cat') === cat){
      card.style.display = 'flex';
    } else {
      card.style.display = 'none';
    }
  });
}

function toggleFaq(btn){
  btn.parentElement.classList.toggle('active');
}
</script>

<?php require __DIR__ . '/../includes/scripts.php'; ?>
</body>
</html>
