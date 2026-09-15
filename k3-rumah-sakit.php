<?php
require_once __DIR__ . '/config.php';
$s = get_all_settings();
// Hub: K3 Rumah Sakit & Fasilitas Kesehatan
$canonical = 'https://wahanatotalita.com/k3-rumah-sakit/';
$meta_title = 'K3 Rumah Sakit & Fasilitas Kesehatan — Permenkes 66/2016 | Wahana Totalita';
$meta_desc  = 'Panduan K3 Rumah Sakit sesuai Permenkes 66/2016: bahaya biologis, radiasi, ergonomi, B3, dan manajemen insiden. Pelatihan K3RS dan sertifikasi untuk tenaga kesehatan. Yogyakarta.';

$schema = [
  [
    '@context' => 'https://schema.org',
    '@type'    => 'BreadcrumbList',
    'itemListElement' => [
      ['@type'=>'ListItem','position'=>1,'name'=>'Beranda','item'=>'https://wahanatotalita.com/'],
      ['@type'=>'ListItem','position'=>2,'name'=>'Pelatihan','item'=>'https://wahanatotalita.com/pelatihan/'],
      ['@type'=>'ListItem','position'=>3,'name'=>'K3 Rumah Sakit','item'=>$canonical],
    ],
  ],
  [
    '@context' => 'https://schema.org',
    '@type'    => 'FAQPage',
    'mainEntity' => [
      [
        '@type' => 'Question',
        'name'  => 'Apa regulasi utama yang mengatur K3 di rumah sakit?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Regulasi utama K3 di rumah sakit Indonesia: (1) Permenkes No. 66 Tahun 2016 tentang K3 Rumah Sakit — regulasi paling spesifik dan komprehensif, mewajibkan RS kelas A dan B membentuk Komite K3RS; (2) UU No. 44 Tahun 2009 tentang Rumah Sakit — pasal keselamatan pasien dan tenaga kesehatan; (3) UU No. 1 Tahun 1970 tentang Keselamatan Kerja — berlaku untuk semua tempat kerja termasuk RS; (4) PP No. 50 Tahun 2012 tentang SMK3 — wajib untuk RS dengan ≥100 karyawan.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apa saja bahaya K3 yang spesifik di lingkungan rumah sakit?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Bahaya K3 spesifik di rumah sakit meliputi: (1) Bahaya biologis — paparan patogen melalui needlestick injury, percikan darah/cairan tubuh, dan aerosol dari pasien infeksius; (2) Bahaya kimia — bahan kimia laboratorium, gas anestesi, disinfektan keras (formaldehid, glutaraldehid), dan obat sitotoksik (kemoterapi); (3) Bahaya radiasi — sinar-X di radiologi, fluoroskopi, dan terapi radiasi nuklir; (4) Bahaya ergonomi — memindahkan dan mengangkat pasien, postur janggal saat tindakan; (5) Bahaya fisik — kebisingan di ICU, getaran peralatan, dan tekanan psikologis tinggi.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apakah semua rumah sakit wajib memiliki Komite K3RS?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Permenkes 66/2016 mewajibkan pembentukan Komite K3RS atau unit yang menjalankan fungsi K3RS. Untuk RS kelas A dan B yang memiliki banyak karyawan dan kompleksitas tinggi, Komite K3RS adalah keharusan. Untuk klinik dan fasilitas kesehatan yang lebih kecil, fungsi K3 dapat diintegrasikan dengan unit lain. Namun semua fasilitas kesehatan — berapapun ukurannya — tetap wajib menerapkan prinsip K3 sesuai UU 1/1970.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apa itu needlestick injury dan bagaimana prosedur penanganannya?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Needlestick injury (NSI) adalah luka tusuk akibat jarum suntik atau benda tajam lain yang terkontaminasi darah atau cairan tubuh pasien. Ini adalah insiden K3 paling umum di fasilitas kesehatan dan berpotensi menularkan HIV, Hepatitis B, dan Hepatitis C. Prosedur penanganan segera: (1) Cuci luka dengan air mengalir dan sabun 5 menit; (2) Jangan dipencet atau dihisap; (3) Beri antiseptik (povidone iodine); (4) Laporkan ke supervisor dan unit K3RS dalam waktu 1 jam; (5) Lakukan pemeriksaan baseline dan profilaksis pasca pajanan (PEP) jika diperlukan.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apakah tenaga kesehatan wajib mengikuti pelatihan K3?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Ya. Permenkes 66/2016 mewajibkan rumah sakit menyelenggarakan program K3RS yang mencakup pelatihan bagi seluruh tenaga kesehatan dan non-kesehatan. Pelatihan minimal yang harus ada: orientasi K3RS untuk karyawan baru, penggunaan APD yang benar, penanganan B3 (bahan berbahaya beracun), prosedur evakuasi darurat, dan pelaporan insiden K3. Frekuensi: minimal setahun sekali atau setiap ada perubahan prosedur signifikan.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apa perbedaan keselamatan pasien (patient safety) dan K3 Rumah Sakit?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Keselamatan pasien (patient safety) berfokus pada mencegah insiden yang membahayakan pasien akibat pelayanan medis — medication error, infeksi nosokomial, salah identifikasi pasien. K3 Rumah Sakit (K3RS) berfokus pada melindungi tenaga kesehatan, pengunjung, dan lingkungan dari bahaya yang ada di dalam fasilitas kesehatan. Keduanya saling terkait dan harus berjalan bersamaan dalam sistem manajemen mutu dan keselamatan rumah sakit yang komprehensif.'],
      ],
    ],
  ],
  [
    '@context' => 'https://schema.org',
    '@type'    => 'Organization',
    'name'     => 'Wahana Totalita Konsultan',
    'url'      => 'https://wahanatotalita.com',
    'telephone'=> '+628122969435',
    'address'  => [
      '@type'           => 'PostalAddress',
      'addressLocality' => 'Yogyakarta',
      'addressRegion'   => 'DI Yogyakarta',
      'addressCountry'  => 'ID',
    ],
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
  <!-- GTM -->
  <?php foreach ($schema as $schemaItem): ?>
  <script type="application/ld+json"><?php echo json_encode($schemaItem, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT); ?></script>
  <?php endforeach; ?>
  <?php include 'includes/head.php'; ?>
</head>
<body>

<?php include __DIR__ . '/includes/navbar.php'; ?>

<!-- HERO -->
<section style="background:linear-gradient(135deg,#0A4A2E 0%,#1a4a6b 100%);color:#fff;padding:60px 20px 50px;">
  <div style="max-width:900px;margin:0 auto;">
    <nav aria-label="breadcrumb" style="font-size:0.85rem;opacity:0.8;margin-bottom:16px;">
      <a href="/" style="color:#f5c06a;">Beranda</a> &rsaquo;
      <a href="/pelatihan/" style="color:#f5c06a;">Pelatihan</a> &rsaquo;
      <span>K3 Rumah Sakit</span>
    </nav>
    <h1 style="font-size:clamp(1.6rem,4vw,2.4rem);font-weight:700;margin:0 0 16px;">
      K3 Rumah Sakit &amp; Fasilitas Kesehatan
    </h1>
    <p style="font-size:1.1rem;opacity:0.92;max-width:720px;margin:0 0 10px;line-height:1.7;">
      Fasilitas kesehatan adalah tempat kerja dengan risiko tertinggi — bahaya biologis, kimia, radiasi, ergonomi, dan psikososial hadir bersamaan setiap hari. Permenkes No. 66 Tahun 2016 mewajibkan setiap rumah sakit menerapkan sistem K3RS yang komprehensif untuk melindungi tenaga kesehatan, pasien, dan pengunjung.
    </p>
    <p style="font-size:0.9rem;opacity:0.8;margin:0 0 28px;">
      Dasar hukum: Permenkes No. 66/2016 &nbsp;|&nbsp; UU No. 44/2009 &nbsp;|&nbsp; UU No. 1/1970 &nbsp;|&nbsp; PP No. 50/2012
    </p>
    <a href="https://wa.me/628122969435?text=Halo%2C+saya+ingin+konsultasi+program+pelatihan+K3+Rumah+Sakit+(K3RS).+Mohon+info+program+dan+biaya."
       target="_blank" rel="noopener"
       style="display:inline-block;background:#C6621C;color:#fff;padding:14px 32px;border-radius:6px;font-weight:700;text-decoration:none;font-size:1rem;">
      Konsultasi Program K3RS
    </a>
  </div>
</section>

<main style="max-width:960px;margin:0 auto;padding:40px 20px 60px;">

  <!-- REGULASI -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Regulasi K3 yang Berlaku di Fasilitas Kesehatan
    </h2>
    <p style="line-height:1.8;color:#333;margin-bottom:16px;">
      Rumah sakit dan fasilitas kesehatan beroperasi di bawah dua kerangka regulasi yang saling melengkapi: regulasi kesehatan (dari Kemenkes) dan regulasi ketenagakerjaan (dari Kemnaker). Keduanya wajib dipenuhi secara bersamaan.
    </p>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:16px;margin-top:20px;">
      <?php
      $regs = [
        ['Permenkes No. 66/2016','K3 Rumah Sakit — regulasi paling spesifik. Mewajibkan pembentukan Komite K3RS, program K3 tertulis, dan pelaporan insiden.','#e8f4eb'],
        ['UU No. 44/2009','Rumah Sakit — kewajiban keselamatan pasien, tenaga kesehatan, dan standar pelayanan yang aman.','#e8f0f7'],
        ['UU No. 1/1970','Keselamatan Kerja — berlaku untuk semua tempat kerja termasuk RS, klinik, puskesmas, dan laboratorium.','#f7f4e8'],
        ['PP No. 50/2012','SMK3 — wajib bagi RS dengan ≥100 karyawan. Audit SMK3 oleh lembaga terakreditasi setiap 3 tahun.','#f7ece8'],
        ['Permenkes No. 7/2019','Kesehatan Lingkungan Rumah Sakit — pengelolaan limbah medis, limbah B3, air limbah, dan emisi udara.','#ede8f7'],
        ['Kepmenkes No. 432/2007','Pedoman Manajemen K3 di RS — panduan teknis penerapan K3RS sebelum Permenkes 66/2016.','#e8f4eb'],
      ];
      foreach ($regs as $r): ?>
      <div style="background:<?php echo $r[2]; ?>;border-radius:8px;padding:16px;border-left:4px solid #0A4A2E;">
        <div style="font-weight:700;color:#0A4A2E;margin-bottom:6px;font-size:0.9rem;"><?php echo $r[0]; ?></div>
        <div style="color:#444;font-size:0.88rem;line-height:1.6;"><?php echo $r[1]; ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- 5 BAHAYA UTAMA K3RS -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:24px;">
      5 Kategori Bahaya K3 di Lingkungan Rumah Sakit
    </h2>
    <?php
    $hazards = [
      [
        'no'    => '1',
        'icon'  => '🦠',
        'title' => 'Bahaya Biologis (Biological Hazards)',
        'color' => '#fff8f0',
        'border'=> '#C6621C',
        'content' => '<p style="line-height:1.8;color:#333;margin:0 0 12px;">Bahaya biologis adalah risiko terbesar dan paling khas di fasilitas kesehatan. Tenaga kesehatan terpapar patogen melalui berbagai rute: kontak langsung dengan darah atau cairan tubuh pasien, percikan (splatter) saat tindakan medis, inhalasi aerosol dari pasien infeksius (TB, COVID-19, campak), dan <strong>needlestick injury (NSI)</strong> — luka tusuk jarum yang berpotensi menularkan HIV, Hepatitis B, dan Hepatitis C.</p>
        <div style="background:#f9f9f9;border-radius:6px;padding:14px;margin-top:8px;font-size:0.88rem;"><strong style="color:#0A4A2E;">Pengendalian wajib:</strong> APD lengkap (sarung tangan, masker N95/bedah, pelindung mata, apron), prosedur recapping jarum yang aman (one-hand technique), safety needle dan sharps container, prosedur cuci tangan 5 momen WHO, dan jalur pelaporan NSI yang jelas dalam 1 jam.</div>',
      ],
      [
        'no'    => '2',
        'icon'  => '⚗️',
        'title' => 'Bahaya Kimia (Chemical Hazards)',
        'color' => '#f0f7f3',
        'border'=> '#0A4A2E',
        'content' => '<p style="line-height:1.8;color:#333;margin:0 0 12px;">Rumah sakit menggunakan ratusan bahan kimia berbahaya setiap hari. Yang paling berisiko tinggi: <strong>formaldehid</strong> (pengawet specimen, karsinogen), <strong>glutaraldehid</strong> (disinfektan alat endoskopi, iritan kuat), <strong>gas anestesi</strong> (bocor dari mesin anestesi di kamar operasi — berisiko bagi staf OK), <strong>obat sitotoksik/kemoterapi</strong> (mutagenik dan teratogenik — harus disiapkan di biosafety cabinet), dan bahan kimia laboratorium (asam, basa, pelarut organik).</p>
        <div style="background:#f9f9f9;border-radius:6px;padding:14px;margin-top:8px;font-size:0.88rem;"><strong style="color:#0A4A2E;">Pengendalian wajib:</strong> MSDS (Material Safety Data Sheet) tersedia untuk semua B3, lemari asam (fume hood) di laboratorium dan farmasi, APD kimia sesuai jenis bahan, pelatihan penanganan tumpahan B3, dan pengelolaan limbah B3 sesuai Permenkes 7/2019.</div>',
      ],
      [
        'no'    => '3',
        'icon'  => '☢️',
        'title' => 'Bahaya Radiasi (Radiation Hazards)',
        'color' => '#fff8f0',
        'border'=> '#C6621C',
        'content' => '<p style="line-height:1.8;color:#333;margin:0 0 12px;">Paparan radiasi pengion di fasilitas kesehatan bersumber dari: instalasi radiologi (foto rontgen, fluoroskopi, CT scan), Unit Kedokteran Nuklir (radiofarmaka, PET scan), dan terapi radiasi (linac untuk onkologi). Paparan kronis bahkan dalam dosis rendah meningkatkan risiko kanker, kerusakan genetik, dan gangguan reproduksi. Staf radiologi, operator kamar bedah (fluoroskopi intraoperatif), dan tenaga nuklir medis adalah kelompok paling berisiko.</p>
        <div style="background:#f9f9f9;border-radius:6px;padding:14px;margin-top:8px;font-size:0.88rem;"><strong style="color:#0A4A2E;">Pengendalian wajib:</strong> TLD (Thermoluminescent Dosimeter) / film badge wajib dipakai, batas dosis efektif 20 mSv/tahun (Perka BAPETEN 4/2013), dinding ruang rontgen berlapisan Pb (timbal), APD radiasi (apron Pb, pelindung tiroid), pemeriksaan kesehatan periodik, dan monitoring dosimetri berkala.</div>',
      ],
      [
        'no'    => '4',
        'icon'  => '🏋️',
        'title' => 'Bahaya Ergonomi — Muskuloskeletal Disorders (MSD)',
        'color' => '#f0f7f3',
        'border'=> '#0A4A2E',
        'content' => '<p style="line-height:1.8;color:#333;margin:0 0 12px;">Perawat dan fisioterapis adalah kelompok dengan insiden MSDs (Musculoskeletal Disorders) tertinggi di antara semua profesi — bahkan lebih tinggi dari pekerja konstruksi. Penyebab utama: memindahkan dan mengangkat pasien tanpa alat bantu, postur janggal saat tindakan keperawatan (memasang infus, merawat luka pada pasien di bed rendah), berdiri dalam waktu lama di kamar operasi, dan mendorong tempat tidur atau kursi roda pasien.</p>
        <div style="background:#f9f9f9;border-radius:6px;padding:14px;margin-top:8px;font-size:0.88rem;"><strong style="color:#0A4A2E;">Pengendalian wajib:</strong> Program <em>Safe Patient Handling and Mobility</em> (SPHM), training teknik transfer pasien yang benar, penyediaan alat bantu angkat (patient lift, transfer belt, slide sheet), bed yang dapat dinaik-turunkan ketinggiannya, dan penilaian ergonomi workstation perawat.</div>',
      ],
      [
        'no'    => '5',
        'icon'  => '🧠',
        'title' => 'Bahaya Psikososial — Stres Kerja Tenaga Kesehatan',
        'color' => '#fff8f0',
        'border'=> '#C6621C',
        'content' => '<p style="line-height:1.8;color:#333;margin:0 0 12px;">Stres psikologis tenaga kesehatan adalah krisis K3 yang sering tidak terlihat namun berdampak sangat besar: burnout, kelelahan welas asih (compassion fatigue), depresi, dan ansietas akibat paparan penderitaan pasien setiap hari. Shift malam berulang, beban kerja yang tidak sesuai kapasitas tim, kekerasan dari pasien atau keluarga (workplace violence), dan tekanan tuntutan hukum malpraktik adalah pemicu utama. WHO menetapkan burnout sebagai fenomena pekerjaan yang harus dikelola dalam ICD-11.</p>
        <div style="background:#f9f9f9;border-radius:6px;padding:14px;margin-top:8px;font-size:0.88em;"><strong style="color:#0A4A2E;">Pengendalian wajib:</strong> Program Employee Assistance Program (EAP), pelatihan manajemen stres dan resiliensi, debriefing psikologis pasca insiden traumatik, kebijakan anti-kekerasan terhadap tenaga kesehatan, rotasi shift yang adil, dan jalur pengaduan yang aman dan terjamin kerahasiaannya.</div>',
      ],
    ];
    foreach ($hazards as $h): ?>
    <div style="background:<?php echo $h['color']; ?>;border-radius:10px;padding:24px;margin-bottom:20px;border-left:5px solid <?php echo $h['border']; ?>;">
      <h3 style="color:#0A4A2E;margin:0 0 14px;font-size:1.05rem;display:flex;align-items:center;gap:10px;">
        <span style="font-size:1.5rem;"><?php echo $h['icon']; ?></span>
        <?php echo $h['no']; ?>. <?php echo $h['title']; ?>
      </h3>
      <?php echo $h['content']; ?>
    </div>
    <?php endforeach; ?>
  </section>

  <!-- KOMITE K3RS -->
  <section style="margin-bottom:48px;background:#f0f7f3;border-radius:10px;padding:30px;">
    <h2 style="color:#0A4A2E;font-size:1.4rem;margin:0 0 16px;">
      Komite K3RS — Struktur &amp; Kewajiban Permenkes 66/2016
    </h2>
    <p style="line-height:1.8;color:#333;margin-bottom:20px;">
      Permenkes 66/2016 mewajibkan setiap rumah sakit memiliki unit yang menjalankan fungsi K3RS. Untuk RS kelas A dan B, ini berbentuk <strong>Komite K3RS</strong> yang berdiri sendiri. Untuk RS kelas C dan D, fungsi K3RS dapat diintegrasikan dengan komite atau unit lain namun harus tetap berfungsi.
    </p>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(230px,1fr));gap:16px;">
      <?php
      $komite = [
        ['Struktur Komite K3RS','Ketua (dokter atau tenaga kesehatan senior), Sekretaris (terlatih K3), dan anggota dari berbagai unit: IGD, ICU, kamar operasi, radiologi, laboratorium, farmasi, dan sanitasi.'],
        ['Program Wajib K3RS','(1) Identifikasi bahaya dan penilaian risiko; (2) Pelatihan K3 seluruh karyawan; (3) Pemeriksaan kesehatan berkala; (4) Pengelolaan B3 dan limbah; (5) Kesiapsiagaan darurat; (6) Sistem pelaporan insiden K3.'],
        ['Pelaporan Insiden','Semua insiden K3 — NSI, tumpahan bahan kimia, kecelakaan kerja, near miss — wajib dilaporkan ke Komite K3RS. Data insiden dianalisis untuk perbaikan sistem, bukan untuk menghukum individu.'],
        ['Audit K3RS','Audit internal K3RS dilakukan minimal setahun sekali. RS dengan ≥100 karyawan juga wajib audit SMK3 eksternal setiap 3 tahun oleh lembaga audit terakreditasi Kemnaker.'],
      ];
      foreach ($komite as $k): ?>
      <div style="background:#fff;border-radius:6px;padding:16px;">
        <div style="font-weight:600;color:#0A4A2E;margin-bottom:8px;font-size:0.9rem;"><?php echo $k[0]; ?></div>
        <p style="color:#555;font-size:0.85rem;line-height:1.6;margin:0;"><?php echo $k[1]; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- LIMBAH MEDIS -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Pengelolaan Limbah Medis &amp; B3 di Fasilitas Kesehatan
    </h2>
    <p style="line-height:1.8;color:#333;margin-bottom:20px;">
      Pengelolaan limbah medis yang tidak benar adalah salah satu pelanggaran K3 dan lingkungan yang paling sering ditemukan di fasilitas kesehatan Indonesia. Permenkes 7/2019 dan PP 22/2021 mengatur kewajiban ini secara ketat.
    </p>
    <div style="overflow-x:auto;">
      <table style="width:100%;border-collapse:collapse;font-size:0.9rem;">
        <thead>
          <tr style="background:#0A4A2E;color:#fff;">
            <th style="padding:10px 14px;text-align:left;">Kategori Limbah</th>
            <th style="padding:10px 14px;text-align:left;">Contoh</th>
            <th style="padding:10px 14px;text-align:left;">Warna Wadah</th>
            <th style="padding:10px 14px;text-align:left;">Pengelolaan</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $waste = [
            ['Limbah Infeksius','Perban bekas, sarung tangan, kateter','Kuning','Insinerator atau autoklaf'],
            ['Benda Tajam (Sharps)','Jarum, pisau bedah, pecahan kaca','Kontainer khusus (kuning/merah)','Sharps container → insinerator'],
            ['Limbah Patologi','Jaringan tubuh, organ, darah','Kuning (dengan penutup rapat)','Insinerator'],
            ['Limbah Farmasi (B3)','Obat kadaluarsa, sisa kemoterapi','Ungu / coklat','Pemusnahan oleh pihak berwenang'],
            ['Limbah Kimia','Reagen laboratorium, disinfektan','Coklat','Tidak boleh dibuang ke saluran biasa'],
            ['Limbah Radioaktif','Sisa radiofarmaka, material terkontaminasi','Merah (simbol radioaktif)','Sesuai regulasi BAPETEN'],
            ['Limbah Non-Infeksius','Kertas, kemasan, makanan sisa','Hitam','Dibuang seperti sampah rumah tangga'],
          ];
          foreach ($waste as $i => $w):
            $bg = $i%2===0?'#fff':'#f5f5f5';
          ?>
          <tr style="background:<?php echo $bg; ?>;">
            <td style="padding:8px 14px;border-bottom:1px solid #eee;font-weight:600;color:#0A4A2E;"><?php echo $w[0]; ?></td>
            <td style="padding:8px 14px;border-bottom:1px solid #eee;color:#444;font-size:0.85rem;"><?php echo $w[1]; ?></td>
            <td style="padding:8px 14px;border-bottom:1px solid #eee;color:#444;"><?php echo $w[2]; ?></td>
            <td style="padding:8px 14px;border-bottom:1px solid #eee;color:#444;font-size:0.85rem;"><?php echo $w[3]; ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </section>

  <!-- PROGRAM PELATIHAN -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:24px;">
      Program Pelatihan K3 untuk Fasilitas Kesehatan
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:20px;">
      <?php
      $programs = [
        ['K3 Umum untuk Tenaga Kesehatan','Orientasi K3RS wajib untuk karyawan baru rumah sakit dan klinik — mencakup semua bahaya K3 spesifik fasilitas kesehatan.','/pelatihan/ahli-k3-umum-kemnaker-ri/','Lihat Program Ahli K3 Umum'],
        ['Petugas P3K Rumah Sakit','Pelatihan pertolongan pertama intensif untuk tenaga medis dan non-medis — BLS (Basic Life Support), CPR, AED, dan penanganan trauma.', '/pelatihan/pelatihan-petugas-p3k-kemnaker-ri/','Lihat Program P3K'],
        ['K3 Penanggulangan Kebakaran','Pelatihan pemadam kebakaran dan evakuasi darurat untuk RS — termasuk evakuasi pasien tidak mobile dan penanganan kebakaran ruang ICU/OK.','/penanggulangan-kebakaran/','Lihat Program'],
        ['Pengelolaan B3 & Limbah Medis','Pelatihan identifikasi, penyimpanan, penanganan tumpahan, dan pembuangan B3 serta limbah medis sesuai regulasi.',null,null],
        ['SMK3 Internal Auditor RS','Audit SMK3 wajib untuk RS ≥100 karyawan — pelatihan Internal Auditor yang memahami konteks fasilitas kesehatan.','/smk3/','Lihat Program SMK3'],
        ['Higiene Industri & Pengukuran NAB','Pengukuran dan pemantauan NAB faktor fisika-kimia di lingkungan kerja RS: kebisingan, pencahayaan, udara, dan biologis.','/higiene-industri/','Lihat Program Hiperkes'],
      ];
      foreach ($programs as $p):
        if ($p[2]) {
          $btn_href = $p[2];
          $btn_target = '';
          $btn_label = $p[3];
          $btn_bg = '#0A4A2E';
        } else {
          $btn_href = 'https://wa.me/628122969435?text=Halo%2C+saya+ingin+info+program+' . urlencode($p[0]) . '+untuk+fasilitas+kesehatan.';
          $btn_target = ' target="_blank" rel="noopener"';
          $btn_label = 'Tanya via WhatsApp';
          $btn_bg = '#C6621C';
        }
      ?>
      <div style="background:#fff;border:1px solid #ddd;border-radius:8px;overflow:hidden;display:flex;flex-direction:column;">
        <div style="background:#0A4A2E;color:#fff;padding:14px 16px;">
          <div style="font-weight:600;font-size:0.95rem;"><?php echo $p[0]; ?></div>
        </div>
        <div style="padding:14px 16px;flex:1;">
          <p style="color:#555;font-size:0.88rem;line-height:1.6;margin:0;"><?php echo $p[1]; ?></p>
        </div>
        <div style="padding:0 16px 16px;">
          <a href="<?php echo $btn_href; ?>"<?php echo $btn_target; ?>
             style="display:block;text-align:center;background:<?php echo $btn_bg; ?>;color:#fff;padding:10px;border-radius:5px;text-decoration:none;font-weight:600;font-size:0.9rem;">
            <?php echo $btn_label; ?>
          </a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- RELATED -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.4rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Topik K3 Terkait
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(210px,1fr));gap:16px;">
      <?php
      $related = [
        ['/higiene-industri/','Higiene Industri & Hiperkes','Dokter & paramedis perusahaan, NAB faktor fisika-kimia'],
        ['/p3k/','Pelatihan P3K','Pertolongan pertama — wajib di semua tempat kerja'],
        ['/k3-lingkungan/','K3 Lingkungan & AMDAL','Pengelolaan limbah B3 dan dampak lingkungan'],
        ['/smk3/','SMK3 & ISO 45001','Sistem Manajemen K3 — wajib RS ≥100 karyawan'],
      ];
      foreach ($related as $r): ?>
      <a href="<?php echo $r[0]; ?>" style="display:block;background:#fff;border:1px solid #ddd;border-radius:8px;padding:16px;text-decoration:none;" onmouseover="this.style.boxShadow='0 2px 10px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='none'">
        <div style="font-weight:600;color:#0A4A2E;margin-bottom:6px;font-size:0.95rem;"><?php echo $r[1]; ?></div>
        <div style="color:#555;font-size:0.85rem;line-height:1.5;"><?php echo $r[2]; ?></div>
      </a>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- FAQ -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:24px;">
      Pertanyaan yang Sering Diajukan
    </h2>
    <?php
    $faqs = [
      ['Apa regulasi utama yang mengatur K3 di rumah sakit?','Regulasi utama: Permenkes No. 66/2016 tentang K3 Rumah Sakit (paling spesifik), UU No. 44/2009 tentang Rumah Sakit, UU No. 1/1970 tentang Keselamatan Kerja, dan PP No. 50/2012 tentang SMK3 (wajib untuk RS ≥100 karyawan).'],
      ['Apa saja bahaya K3 yang spesifik di lingkungan rumah sakit?','5 kategori bahaya utama: (1) Biologis — paparan patogen, needlestick injury, aerosol infeksius; (2) Kimia — bahan laboratorium, gas anestesi, disinfektan, obat sitotoksik; (3) Radiasi — sinar-X, CT scan, terapi radiasi; (4) Ergonomi — memindahkan pasien, postur janggal; (5) Psikososial — burnout, compassion fatigue, workplace violence.'],
      ['Apakah semua rumah sakit wajib memiliki Komite K3RS?','Permenkes 66/2016 mewajibkan pembentukan Komite K3RS atau unit yang menjalankan fungsi K3RS. RS kelas A dan B wajib komite tersendiri. RS kelas C dan D dapat mengintegrasikan fungsi K3RS dengan komite lain. Semua fasilitas kesehatan tetap wajib menerapkan K3.'],
      ['Apa itu needlestick injury dan bagaimana prosedur penanganannya?','NSI adalah luka tusuk jarum yang berpotensi menularkan HIV, Hepatitis B, dan C. Penanganan segera: cuci dengan air dan sabun 5 menit, jangan dipencet, beri antiseptik, laporkan ke supervisor dan K3RS dalam 1 jam, lakukan pemeriksaan baseline dan PEP (profilaksis pasca pajanan) jika diperlukan.'],
      ['Apakah tenaga kesehatan wajib mengikuti pelatihan K3?','Ya. Permenkes 66/2016 mewajibkan RS menyelenggarakan program K3RS termasuk pelatihan bagi seluruh karyawan. Minimal: orientasi K3RS untuk karyawan baru, penggunaan APD, penanganan B3, prosedur evakuasi, dan pelaporan insiden. Frekuensi minimal setahun sekali.'],
      ['Apa perbedaan keselamatan pasien (patient safety) dan K3 Rumah Sakit?','Keselamatan pasien berfokus melindungi pasien dari insiden akibat pelayanan medis (medication error, infeksi nosokomial, salah identifikasi). K3RS berfokus melindungi tenaga kesehatan, pengunjung, dan lingkungan dari bahaya yang ada di dalam fasilitas. Keduanya harus berjalan bersamaan.'],
    ];
    foreach ($faqs as $faq): ?>
    <div style="border:1px solid #e0e0e0;border-radius:8px;margin-bottom:12px;overflow:hidden;">
      <button onclick="var a=this.nextElementSibling;a.style.display=a.style.display==='block'?'none':'block';this.querySelector('span').textContent=a.style.display==='block'?'−':'+'"
              style="width:100%;text-align:left;padding:16px 20px;background:#f9f9f9;border:none;cursor:pointer;font-weight:600;color:#0A4A2E;font-size:0.95rem;display:flex;justify-content:space-between;align-items:center;">
        <?php echo htmlspecialchars($faq[0]); ?>
        <span style="font-size:1.2rem;font-weight:700;color:#C6621C;min-width:20px;text-align:center;">+</span>
      </button>
      <div style="display:none;padding:16px 20px;color:#444;line-height:1.8;background:#fff;border-top:1px solid #e0e0e0;">
        <?php echo htmlspecialchars($faq[1]); ?>
      </div>
    </div>
    <?php endforeach; ?>
  </section>

  <!-- CTA -->
  <section style="background:linear-gradient(135deg,#0A4A2E,#1a4a6b);color:#fff;border-radius:12px;padding:40px;text-align:center;">
    <h2 style="margin:0 0 12px;font-size:1.6rem;">Konsultasikan Kebutuhan K3RS Anda</h2>
    <p style="opacity:0.9;margin:0 0 28px;line-height:1.7;max-width:600px;margin-left:auto;margin-right:auto;">
      Dari pelatihan K3 untuk seluruh staf hingga pendampingan penyusunan program K3RS dan audit SMK3 — Wahana Totalita siap mendampingi fasilitas kesehatan Anda memenuhi seluruh kewajiban regulasi.
    </p>
    <a href="https://wa.me/628122969435?text=Halo%2C+saya+ingin+konsultasi+program+K3+Rumah+Sakit+(K3RS)+untuk+fasilitas+kesehatan+kami."
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
