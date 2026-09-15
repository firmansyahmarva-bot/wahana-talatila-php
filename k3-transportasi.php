<?php
require_once __DIR__ . '/config.php';
$s = get_all_settings();
// Hub: K3 Transportasi & Keselamatan Berkendara
$canonical = 'https://wahanatotalita.com/k3-transportasi/';
$meta_title = 'K3 Transportasi & Keselamatan Berkendara — Fleet Safety Management | Wahana Totalita';
$meta_desc  = 'Pelatihan K3 transportasi: defensive driving, fleet safety management, journey management plan, dan keselamatan pengemudi instansi pemerintah & BUMN. Sesuai UU LLAJ No. 22/2009. Yogyakarta.';

$schema = [
  [
    '@context' => 'https://schema.org',
    '@type'    => 'BreadcrumbList',
    'itemListElement' => [
      ['@type'=>'ListItem','position'=>1,'name'=>'Beranda','item'=>'https://wahanatotalita.com/'],
      ['@type'=>'ListItem','position'=>2,'name'=>'Pelatihan','item'=>'https://wahanatotalita.com/pelatihan/'],
      ['@type'=>'ListItem','position'=>3,'name'=>'K3 Transportasi','item'=>$canonical],
    ],
  ],
  [
    '@context' => 'https://schema.org',
    '@type'    => 'FAQPage',
    'mainEntity' => [
      [
        '@type' => 'Question',
        'name'  => 'Apa regulasi K3 yang berlaku untuk keselamatan berkendara di instansi dan perusahaan?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Regulasi K3 transportasi di Indonesia: (1) UU No. 22/2009 tentang Lalu Lintas dan Angkutan Jalan (LLAJ) — kewajiban pengemudi, standar kendaraan, dan sanksi pelanggaran; (2) UU No. 1/1970 tentang Keselamatan Kerja — kendaraan operasional instansi dan perusahaan termasuk tempat kerja; (3) PP No. 55/2012 tentang Kendaraan — standar laik jalan, uji berkala; (4) Permenaker No. 5/2018 tentang K3 Lingkungan Kerja — termasuk fasilitas kendaraan operasional; (5) SNI ISO 39001 — Sistem Manajemen Keselamatan Lalu Lintas Jalan yang dapat diterapkan oleh organisasi.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apa itu Defensive Driving dan mengapa penting untuk pengemudi dinas?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Defensive Driving adalah teknik berkendara yang mengutamakan antisipasi bahaya dan pencegahan kecelakaan, bukan sekadar mematuhi rambu lalu lintas. Pengemudi defensif aktif memantau lingkungan sekitar, mempertahankan jarak aman, mengantisipasi kesalahan pengemudi lain, dan selalu menyiapkan jalur melarikan diri. Penting untuk pengemudi dinas karena: (1) Kecelakaan kendaraan dinas berimplikasi hukum dan reputasi instansi; (2) Pengemudi dinas sering membawa pejabat VVIP atau dokumen penting; (3) Kecelakaan berkendara adalah penyebab kematian akibat kerja nomor 1 di Indonesia; (4) Premi asuransi kendaraan dinas dapat ditekan dengan catatan kecelakaan nol.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apa itu Journey Management Plan (JMP) dan kapan diperlukan?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Journey Management Plan (JMP) adalah prosedur tertulis yang harus diselesaikan sebelum perjalanan dinas jarak jauh atau perjalanan berisiko tinggi. JMP mencakup: rute yang akan ditempuh dan alternatifnya, kondisi kendaraan (pre-trip inspection), kondisi pengemudi (jam istirahat terakhir, kondisi kesehatan), titik check-in selama perjalanan, prosedur darurat jika terjadi kecelakaan atau mogok, dan kontak darurat. JMP adalah kontrol keselamatan wajib di industri migas, pertambangan, dan perusahaan dengan banyak perjalanan dinas jarak jauh. Banyak kecelakaan fatal di jalan dapat dicegah jika JMP diterapkan dengan disiplin.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Berapa biaya kecelakaan kendaraan dinas bagi instansi pemerintah?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Biaya kecelakaan kendaraan dinas jauh melampaui biaya perbaikan fisik kendaraan. Komponen biaya total mencakup: biaya perbaikan/penggantian kendaraan (langsung), biaya perawatan medis korban (ditanggung instansi jika kecelakaan saat dinas), hilangnya produktivitas selama masa pemulihan, biaya hukum dan ganti rugi pihak ketiga, kenaikan premi asuransi, waktu manajemen untuk menangani kasus, dan dampak reputasi instansi. Penelitian KNKT menunjukkan bahwa biaya tidak langsung kecelakaan berkisar 4–10x biaya langsung. Program defensive driving dengan investasi relatif kecil dapat menghemat biaya ini secara signifikan.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apakah semua pengemudi kendaraan dinas wajib mengikuti pelatihan keselamatan berkendara?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Kewajiban hukum spesifik bervariasi berdasarkan jenis kendaraan: pengemudi kendaraan angkutan umum dan barang wajib memiliki SIM sesuai dan mengikuti uji kompetensi berkala (UU 22/2009). Untuk kendaraan operasional dinas, tidak ada regulasi yang mewajibkan pelatihan defensive driving secara eksplisit, namun UU 1/1970 mengharuskan pengusaha menjamin keselamatan pekerja — termasuk saat menggunakan kendaraan dinas. Best practice: setiap pengemudi dinas harus mengikuti pelatihan defensive driving sebelum diberi izin mengemudikan kendaraan instansi, dan diulang setiap 2 tahun.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apa saja isi pemeriksaan pra-perjalanan (pre-trip inspection) yang benar?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Pre-trip inspection wajib mencakup: (1) LIGHTS — semua lampu berfungsi (headlight, rem, sein, hazard); (2) OIL — level oli mesin dalam batas normal; (3) WATER — level air radiator dan reservoir; (4) BRAKES — uji rem di tempat aman; (5) AIR — tekanan ban semua roda (termasuk ban cadangan); (6) GAS/BAHAN BAKAR — pastikan cukup untuk perjalanan; (7) EMERGENCY KIT — segitiga pengaman, APAR kendaraan, kotak P3K; (8) SIM & DOKUMEN KENDARAAN — STNK, asuransi, surat jalan; (9) KONDISI PENGEMUDI — tidur cukup, tidak mengonsumsi obat yang menyebabkan kantuk. Checklist ini harus menjadi SOP tertulis di setiap unit pengelola kendaraan instansi.'],
      ],
    ],
  ],
  [
    '@context' => 'https://schema.org',
    '@type'    => 'Organization',
    'name'     => 'Wahana Totalita Konsultan',
    'url'      => 'https://wahanatotalita.com',
    'telephone'=> '+628122969435',
    'address'  => ['@type'=>'PostalAddress','addressLocality'=>'Yogyakarta','addressRegion'=>'DI Yogyakarta','addressCountry'=>'ID'],
  ],
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo htmlspecialchars($meta_title); ?></title>
  <meta name="description" content="<?php echo htmlspecialchars($meta_desc); ?>">
  <link rel="canonical" href="<?php echo $canonical; ?>">
  <meta property="og:title"       content="<?php echo htmlspecialchars($meta_title); ?>">
  <meta property="og:description" content="<?php echo htmlspecialchars($meta_desc); ?>">
  <meta property="og:url"         content="<?php echo $canonical; ?>">
  <meta property="og:type"        content="website">
  <meta property="og:locale"      content="id_ID">
  <?php foreach ($schema as $schemaItem): ?>
  <script type="application/ld+json"><?php echo json_encode($schemaItem, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT); ?></script>
  <?php endforeach; ?>
  <?php include 'includes/head.php'; ?>
</head>
<body>
<?php include __DIR__ . '/includes/navbar.php'; ?>

<!-- HERO -->
<section style="background:linear-gradient(135deg,#1a1a0a 0%,#0A4A2E 60%,#3a2a00 100%);color:#fff;padding:60px 20px 50px;">
  <div style="max-width:900px;margin:0 auto;">
    <nav aria-label="breadcrumb" style="font-size:0.85rem;opacity:0.8;margin-bottom:16px;">
      <a href="/" style="color:#f5e0a0;">Beranda</a> &rsaquo;
      <a href="/pelatihan/" style="color:#f5e0a0;">Pelatihan</a> &rsaquo;
      <span>K3 Transportasi</span>
    </nav>
    <h1 style="font-size:clamp(1.6rem,4vw,2.4rem);font-weight:700;margin:0 0 16px;">
      K3 Transportasi &amp; Keselamatan Berkendara untuk Instansi &amp; BUMN
    </h1>
    <p style="font-size:1.05rem;opacity:0.92;max-width:720px;margin:0 0 10px;line-height:1.7;">
      Kecelakaan lalu lintas adalah penyebab kematian akibat kerja nomor satu di Indonesia — jauh melampaui kecelakaan di area pabrik atau konstruksi. Setiap instansi pemerintah dan BUMN yang memiliki armada kendaraan dinas menanggung risiko ini setiap hari. Program K3 transportasi Wahana Totalita membekali pengemudi dan manajer fleet dengan sistem keselamatan yang terbukti menurunkan angka kecelakaan.
    </p>
    <p style="font-size:0.88rem;opacity:0.75;margin:0 0 24px;">Regulasi: UU 22/2009 (LLAJ) &nbsp;|&nbsp; UU 1/1970 &nbsp;|&nbsp; PP 55/2012 &nbsp;|&nbsp; SNI ISO 39001</p>
    <a href="https://wa.me/628122969435?text=Halo%2C+saya+ingin+info+program+pelatihan+K3+Transportasi+dan+keselamatan+berkendara+untuk+instansi+kami."
       target="_blank" rel="noopener"
       style="display:inline-block;background:#C6621C;color:#fff;padding:14px 32px;border-radius:6px;font-weight:700;text-decoration:none;font-size:1rem;">
      Konsultasi Program
    </a>
  </div>
</section>

<main style="max-width:960px;margin:0 auto;padding:40px 20px 60px;">

  <!-- STATISTIK -->
  <section style="margin-bottom:48px;background:#fff8f0;border-radius:10px;padding:28px;">
    <h2 style="color:#0A4A2E;font-size:1.4rem;margin:0 0 16px;">Mengapa K3 Transportasi Kritis?</h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:16px;margin-bottom:20px;">
      <?php
      $stats = [
        ['#1','Kecelakaan lalu lintas adalah penyebab kematian akibat kerja nomor satu — lebih tinggi dari kecelakaan konstruksi dan tambang digabung (ILO/WHO).'],
        ['4–10x','Biaya tidak langsung kecelakaan kendaraan (hilang produktivitas, hukum, reputasi) 4–10x lebih tinggi dari biaya perbaikan kendaraan saja.'],
        ['90%','Lebih dari 90% kecelakaan lalu lintas disebabkan faktor manusia (human error) — bukan kegagalan kendaraan atau kondisi jalan.'],
        ['30%','Program defensive driving yang terstruktur terbukti menurunkan angka kecelakaan armada hingga 30–50% (NHTSA, Fleet Safety Council).'],
      ];
      foreach ($stats as $s): ?>
      <div style="text-align:center;background:#fff;border-radius:8px;padding:18px;border-top:4px solid #C6621C;">
        <div style="font-size:2rem;font-weight:800;color:#C6621C;margin-bottom:8px;"><?php echo $s[0]; ?></div>
        <p style="color:#555;font-size:0.84rem;line-height:1.5;margin:0;"><?php echo $s[1]; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- BAHAYA -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Bahaya K3 Utama di Lingkungan Transportasi
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:16px;">
      <?php
      $hazards = [
        ['😴','Kelelahan Pengemudi (Driver Fatigue)','Mengemudi lebih dari 4 jam tanpa istirahat meningkatkan risiko microsleep — tertidur 2–3 detik yang cukup untuk melewati jalur dan menabrak kendaraan lain. Faktor risiko: shift malam, perjalanan malam, dan tekanan untuk memenuhi jadwal yang tidak realistis.','#3a2a00'],
        ['📱','Distraksi (Distracted Driving)','Menggunakan ponsel saat mengemudi meningkatkan risiko kecelakaan 4x lipat — setara dengan mengemudi dalam kondisi mabuk. Termasuk distraksi dari GPS, makan, dan mengobrol dengan penumpang. Kebijakan "no phone while driving" yang ketat adalah kontrol pertama.','#1a1a0a'],
        ['🚗','Kondisi Kendaraan Tidak Laik','Rem blong, ban gundul, lampu rusak, dan sistem kemudi yang tidak berfungsi adalah bahaya mekanis yang bisa dicegah 100% dengan program inspeksi dan perawatan preventif. Banyak kecelakaan fatal terjadi karena kendaraan dinas tidak diperiksa secara rutin.','#0a2a00'],
        ['🌧️','Kondisi Jalan & Cuaca Ekstrem','Jalan licin saat hujan, kabut tebal di pegunungan, dan banjir di jalan rendah menuntut pengemudi dengan keterampilan khusus. Pengemudi yang tidak terlatih sering bereaksi salah — menginjak rem mendadak di jalan licin justru menyebabkan kendaraan tergelincir.','#0a1a2a'],
        ['⏰','Tekanan Waktu & Jadwal','Pengemudi dinas sering dihadapkan pada tekanan untuk tiba tepat waktu — mendorong perilaku mengemudi berisiko seperti ngebut, menyalip di tikungan, dan mengabaikan rambu. Journey Management Plan (JMP) adalah solusinya: jadwal yang realistis dengan buffer waktu.','#2a0a00'],
        ['🍺','Alkohol & Obat-obatan','UU LLAJ melarang mengemudi dalam pengaruh alkohol (BAC > 0,3 mg/liter) atau obat-obatan yang mempengaruhi kemampuan mengemudi. Banyak obat flu, antihistamin, dan penenang menyebabkan kantuk berat yang berbahaya saat mengemudi.','#1a0a1a'],
      ];
      foreach ($hazards as $h): ?>
      <div style="background:<?php echo $h[3]; ?>;color:#fff;border-radius:8px;padding:18px;">
        <div style="font-size:1.5rem;margin-bottom:8px;"><?php echo $h[0]; ?></div>
        <div style="font-weight:700;margin-bottom:8px;font-size:0.92rem;"><?php echo $h[1]; ?></div>
        <p style="font-size:0.84rem;line-height:1.6;opacity:0.9;margin:0;"><?php echo $h[2]; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- DEFENSIVE DRIVING -->
  <section style="margin-bottom:48px;background:#f0f7f3;border-radius:10px;padding:28px;">
    <h2 style="color:#0A4A2E;font-size:1.4rem;margin:0 0 14px;">Defensive Driving — 5 Prinsip Smith System</h2>
    <p style="color:#333;line-height:1.8;margin:0 0 18px;font-size:0.92rem;">Smith System adalah metodologi defensive driving paling banyak digunakan di dunia untuk armada korporat dan instansi. Terdiri dari 5 prinsip yang bekerja bersama untuk menciptakan pengemudi yang selalu satu langkah lebih maju dari bahaya.</p>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:14px;">
      <?php
      $smith = [
        ['1','Aim High in Steering','Pandang jauh ke depan (12–15 detik) — bukan hanya bumper kendaraan di depan. Memberikan waktu reaksi lebih bagi pengemudi untuk merespons bahaya sebelum terlambat.'],
        ['2','Get the Big Picture','Pantau semua yang terjadi di sekitar kendaraan — depan, belakang, kiri, kanan. Cek kaca spion setiap 5–8 detik. Waspadai titik buta.'],
        ['3','Keep Your Eyes Moving','Jangan terpaku pada satu titik. Mata yang bergerak aktif mendeteksi bahaya lebih cepat dan mencegah highway hypnosis (mengantuk di jalan panjang lurus).'],
        ['4','Leave Yourself an Out','Selalu ada ruang untuk "kabur" jika terjadi darurat — jangan terjepit. Pertahankan jarak aman dan hindari mengemudi di titik buta kendaraan besar.'],
        ['5','Make Sure They See You','Pastikan pengemudi lain, pejalan kaki, dan pengendara motor menyadari keberadaan Anda. Gunakan lampu, klakson (dengan bijak), dan hindari zona buta kendaraan lain.'],
      ];
      foreach ($smith as $s): ?>
      <div style="background:#fff;border-radius:6px;padding:14px;border-top:3px solid #C6621C;">
        <div style="font-weight:800;font-size:1.3rem;color:#C6621C;margin-bottom:4px;"><?php echo $s[0]; ?></div>
        <div style="font-weight:600;color:#0A4A2E;margin-bottom:6px;font-size:0.88rem;"><?php echo $s[1]; ?></div>
        <p style="color:#555;font-size:0.83rem;line-height:1.5;margin:0;"><?php echo $s[2]; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- PROGRAM PELATIHAN -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:24px;">
      Program Pelatihan K3 Transportasi
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:20px;">
      <?php
      $programs = [
        ['Defensive Driving untuk Pengemudi Dinas','1–2 hari | Semua pengemudi kendaraan dinas instansi dan BUMN. Teori dan simulasi: 5 prinsip Smith System, bahaya kelelahan, distraksi, cuaca ekstrem, dan penanganan darurat.'],
        ['Journey Management Plan (JMP) Training','1 hari | Dispatcher, koordinator kendaraan, dan pejabat pengadaan. Penyusunan JMP, checklist pra-perjalanan, sistem check-in, dan prosedur darurat di jalan.'],
        ['Fleet Safety Management','1–2 hari | Manajer logistik dan kepala bagian umum. Sistem manajemen keselamatan armada: inspeksi kendaraan, catatan pengemudi, analisis insiden, dan SNI ISO 39001.'],
        ['Penanganan Darurat di Jalan','Half-day | Semua pengemudi. Apa yang dilakukan saat ban pecah di jalan bebas hambatan, rem blong, kendaraan terbakar, dan kecelakaan — termasuk P3K korban kecelakaan lalin.'],
        ['Pre-Trip Vehicle Inspection','Half-day | Pengemudi dan petugas pool kendaraan. Checklist inspeksi kendaraan sebelum operasi: LIGHTS-OIL-WATER-BRAKES-AIR-GAS, dokumen, dan kondisi pengemudi.'],
        ['K3 Pengangkutan Barang Berbahaya (ADR)','1–2 hari | Pengemudi dan dispatcher angkutan barang berbahaya. Klasifikasi dangerous goods, tanda peringatan, dokumen angkutan, dan prosedur darurat tumpahan di jalan.'],
      ];
      foreach ($programs as $p): ?>
      <div style="background:#fff;border:1px solid #e0d0a0;border-radius:8px;overflow:hidden;display:flex;flex-direction:column;">
        <div style="background:#3a2a00;color:#fff;padding:12px 16px;">
          <div style="font-weight:600;font-size:0.93rem;"><?php echo $p[0]; ?></div>
        </div>
        <div style="padding:14px 16px;flex:1;">
          <p style="color:#555;font-size:0.87rem;line-height:1.6;margin:0;"><?php echo $p[1]; ?></p>
        </div>
        <div style="padding:0 16px 16px;">
          <a href="<?php echo 'https://wa.me/628122969435?text=Halo%2C+saya+ingin+info+program+'.urlencode($p[0]).' untuk pengemudi/armada instansi kami.'; ?>"
             target="_blank" rel="noopener"
             style="display:block;text-align:center;background:#C6621C;color:#fff;padding:10px;border-radius:5px;text-decoration:none;font-weight:600;font-size:0.88rem;">
            Tanya via WhatsApp
          </a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- RELATED -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.4rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">Topik K3 Terkait</h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:14px;">
      <?php
      $related = [
        ['/operator-alat-berat/','Operator Alat Berat','SIO/SIMPER untuk operator — termasuk pengemudi kendaraan berat.'],
        ['/k3-konstruksi/','K3 Konstruksi','Keselamatan kendaraan & alat di area proyek konstruksi.'],
        ['/k3-migas/','K3 Migas','Fleet safety untuk operasi migas dan road transport BBM.'],
        ['/p3k/','Pelatihan P3K','Pertolongan pertama — termasuk untuk korban kecelakaan lalu lintas.'],
      ];
      foreach ($related as $r): ?>
      <a href="<?php echo $r[0]; ?>" style="display:block;background:#fff;border:1px solid #e0d0a0;border-radius:8px;padding:14px;text-decoration:none;" onmouseover="this.style.boxShadow='0 2px 8px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='none'">
        <div style="font-weight:600;color:#3a2a00;margin-bottom:4px;font-size:0.92rem;"><?php echo $r[1]; ?></div>
        <div style="color:#666;font-size:0.84rem;"><?php echo $r[2]; ?></div>
      </a>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- FAQ -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:24px;">Pertanyaan yang Sering Diajukan</h2>
    <?php
    $faqs = [
      ['Apa regulasi K3 yang berlaku untuk keselamatan berkendara instansi?','UU 22/2009 (LLAJ — kewajiban pengemudi dan standar kendaraan), UU 1/1970 (K3 semua tempat kerja termasuk kendaraan dinas), PP 55/2012 (standar laik jalan), dan SNI ISO 39001 (Sistem Manajemen Keselamatan Lalu Lintas Jalan).'],
      ['Apa itu Defensive Driving dan mengapa penting untuk pengemudi dinas?','Defensive driving adalah teknik berkendara yang mengutamakan antisipasi bahaya. Penting karena: kecelakaan lalu lintas adalah penyebab kematian kerja #1 di Indonesia, kecelakaan kendaraan dinas berdampak hukum dan reputasi instansi, dan 90% kecelakaan disebabkan faktor manusia yang bisa dilatih.'],
      ['Apa itu Journey Management Plan (JMP)?','JMP adalah prosedur tertulis sebelum perjalanan jauh: rute, kondisi kendaraan dan pengemudi, titik check-in, dan prosedur darurat. Wajib di industri migas dan tambang, dan best practice untuk semua armada instansi.'],
      ['Berapa biaya kecelakaan kendaraan dinas bagi instansi?','Biaya tidak langsung (hilang produktivitas, hukum, reputasi) 4–10x lebih tinggi dari biaya perbaikan kendaraan. Program defensive driving dengan investasi kecil bisa mencegah biaya besar ini.'],
      ['Apakah pengemudi kendaraan dinas wajib mengikuti pelatihan keselamatan berkendara?','UU 1/1970 mewajibkan pengusaha menjamin keselamatan pekerja termasuk saat menggunakan kendaraan dinas. Best practice: pelatihan defensive driving sebelum diberi izin mengemudi kendaraan instansi, diulang setiap 2 tahun.'],
      ['Apa saja isi pemeriksaan pra-perjalanan (pre-trip inspection) yang benar?','Checklist LIGHTS-OIL-WATER-BRAKES-AIR-GAS + emergency kit + dokumen kendaraan (STNK, asuransi, surat jalan) + kondisi pengemudi (tidur cukup, tidak mengonsumsi obat yang menyebabkan kantuk). Harus menjadi SOP tertulis di setiap pool kendaraan instansi.'],
    ];
    foreach ($faqs as $faq): ?>
    <div style="border:1px solid #e0e0e0;border-radius:8px;margin-bottom:12px;overflow:hidden;">
      <button onclick="var a=this.nextElementSibling;a.style.display=a.style.display==='block'?'none':'block';this.querySelector('span').textContent=a.style.display==='block'?'−':'+'"
              style="width:100%;text-align:left;padding:16px 20px;background:#f9f9f9;border:none;cursor:pointer;font-weight:600;color:#0A4A2E;font-size:0.95rem;display:flex;justify-content:space-between;align-items:center;">
        <?php echo htmlspecialchars($faq[0]); ?>
        <span style="font-size:1.2rem;font-weight:700;color:#C6621C;min-width:20px;text-align:center;">+</span>
      </button>
      <div style="display:none;padding:16px 20px;color:#444;line-height:1.8;background:#fff;border-top:1px solid #e0e0e0;"><?php echo htmlspecialchars($faq[1]); ?></div>
    </div>
    <?php endforeach; ?>
  </section>

  <!-- CTA -->
  <section style="background:linear-gradient(135deg,#3a2a00,#0A4A2E);color:#fff;border-radius:12px;padding:40px;text-align:center;">
    <h2 style="margin:0 0 12px;font-size:1.6rem;">Kurangi Risiko Kecelakaan Armada Anda</h2>
    <p style="opacity:0.9;margin:0 0 28px;line-height:1.7;max-width:600px;margin-left:auto;margin-right:auto;">
      Program defensive driving dan fleet safety management yang tepat bisa menurunkan angka kecelakaan armada instansi hingga 30–50%. Konsultasikan kebutuhan Anda sekarang.
    </p>
    <a href="https://wa.me/628122969435?text=Halo%2C+saya+ingin+info+program+pelatihan+K3+Transportasi+dan+defensive+driving+untuk+pengemudi+dinas+kami."
       target="_blank" rel="noopener"
       style="display:inline-block;background:#C6621C;color:#fff;padding:14px 36px;border-radius:6px;font-weight:700;text-decoration:none;font-size:1.05rem;">
      WhatsApp: 0812-2969-435
    </a>
  </section>


<?php
require_once __DIR__ . '/includes/hub-category-map.php';
$hub_article_cats = $HUB_CATEGORY_MAP['k3']['article_cats'] ?? [];
include __DIR__ . '/includes/hub-artikel-terkait.php';
?>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>
</html>
