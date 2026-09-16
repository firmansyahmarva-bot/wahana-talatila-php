<?php
require_once __DIR__ . '/config.php';
$s = get_all_settings();
// Hub: K3 Industri Manufaktur & Pabrik
$canonical = 'https://wahanatotalita.com/k3-manufaktur/';
$meta_title = 'K3 Industri Manufaktur & Pabrik — Pelatihan Keselamatan Kerja Yogyakarta';
$meta_desc  = 'Pelatihan K3 industri manufaktur dan pabrik: mesin produksi, APD, ergonomi, bahan kimia, kebakaran, dan lockout/tagout. BNSP, Kemnaker RI. Yogyakarta dan DIY.';

$schema = [
  [
    '@context' => 'https://schema.org',
    '@type'    => 'BreadcrumbList',
    'itemListElement' => [
      ['@type'=>'ListItem','position'=>1,'name'=>'Beranda','item'=>'https://wahanatotalita.com/'],
      ['@type'=>'ListItem','position'=>2,'name'=>'K3 Industri','item'=>'https://wahanatotalita.com/keselamatan-kerja/'],
      ['@type'=>'ListItem','position'=>3,'name'=>'K3 Manufaktur','item'=>$canonical],
    ],
  ],
  [
    '@context' => 'https://schema.org',
    '@type'    => 'FAQPage',
    'mainEntity' => [
      [
        '@type' => 'Question',
        'name'  => 'Apa regulasi K3 yang wajib dipatuhi industri manufaktur di Indonesia?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Industri manufaktur di Indonesia wajib mematuhi: UU 1/1970 tentang Keselamatan Kerja (kewajiban dasar pengusaha), PP 50/2012 tentang SMK3 (wajib bagi perusahaan ≥100 karyawan atau berisiko tinggi), Permenaker 38/2016 tentang K3 Pesawat Tenaga dan Produksi (mesin-mesin pabrik), Permenaker 8/2010 tentang APD (kewajiban menyediakan dan memantau pemakaian APD), Permenaker 5/2018 tentang K3 Lingkungan Kerja (NAB fisika, kimia, biologi, ergonomi, psikologi), dan Kepmenaker 187/1999 tentang Pengendalian Bahan Kimia Berbahaya. Pelanggaran berpotensi sanksi pidana dan denda yang signifikan.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apa itu prosedur Lockout/Tagout (LOTO) dan mengapa wajib diterapkan di pabrik?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Lockout/Tagout (LOTO) adalah prosedur pengendalian energi berbahaya yang memastikan mesin atau peralatan berbahaya dimatikan dan tidak dapat dinyalakan kembali secara tidak sengaja saat sedang dilakukan perawatan, perbaikan, atau pembersihan. LOTO wajib diterapkan karena mesin yang tidak dikunci dapat menyebabkan cedera serius bahkan kematian — jari terpotong, anggota badan terjepit, atau tersetrum arus listrik. Prosedur LOTO meliputi: identifikasi sumber energi, isolasi energi, penguncian (lockout), penandaan (tagout), verifikasi energi nol, dan pelepasan kunci setelah selesai. Di Indonesia, kewajiban ini mengacu pada UU 1/1970 dan turunannya terkait K3 mesin produksi.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apa saja bahaya ergonomi paling umum di lini produksi manufaktur?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Bahaya ergonomi di manufaktur antara lain: (1) Gerakan berulang — pengencangan baut, pemotongan, atau perakitan yang sama ribuan kali/hari menyebabkan cedera muskuloskeletal (MSD); (2) Postur janggal — membungkuk, memutar, atau menjangkau berulang; (3) Pengangkatan manual berlebihan — berat melebihi batas aman atau teknik angkat yang salah; (4) Tekanan kontak — telapak tangan atau pergelangan tertekan permukaan keras; (5) Getaran tangan-lengan dari penggunaan power tool. MSD adalah penyebab terbanyak absensi di industri manufaktur. Solusi: redesain stasiun kerja, alat bantu angkat, rotasi tugas, dan pelatihan teknik kerja aman.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Seberapa sering audit K3 internal wajib dilakukan di pabrik?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Berdasarkan PP 50/2012 tentang SMK3: audit internal SMK3 minimal dilakukan 1 kali per tahun. Namun praktik terbaik merekomendasikan: inspeksi harian (supervisor di lantai produksi), inspeksi mingguan (safety officer), audit departemen bulanan, dan audit SMK3 internal tahunan yang menyeluruh. Di luar itu, audit eksternal SMK3 oleh lembaga audit yang ditunjuk Kemnaker RI wajib dilakukan setiap 3 tahun bagi perusahaan ≥100 karyawan atau berisiko tinggi. Jadwal audit harus terdokumentasi dalam program K3 tahunan.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apa sanksi yang dihadapi perusahaan manufaktur jika terjadi kecelakaan kerja?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Sanksi kecelakaan kerja di manufaktur berjenjang: (1) Sanksi administratif dari Disnaker: peringatan, penghentian kegiatan sebagian, hingga penutupan usaha (UU 1/1970); (2) Kewajiban lapor kecelakaan dalam 2x24 jam dan penyusunan laporan kecelakaan (Permenaker 03/1998); (3) Klaim BPJS Ketenagakerjaan program JKK — perusahaan membayar premi, namun premi bisa naik jika kecelakaan sering terjadi; (4) Tuntutan perdata dari korban atau keluarga atas ganti rugi di luar BPJS; (5) Pidana bagi pengurus perusahaan jika terbukti lalai atau sengaja mengabaikan K3 (UU 1/1970 Pasal 15, ancaman penjara dan denda). Sistem pelaporan dan pencegahan yang baik adalah perlindungan terbaik.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'APD apa saja yang wajib tersedia di lantai produksi manufaktur?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'APD wajib di lantai produksi (disesuaikan dengan bahaya spesifik per area) meliputi: Helm/hard hat (area dengan risiko benda jatuh), Kacamata safety / face shield (area machining, pengelasan, dan bahan kimia), Earplug/earmuff (area dengan kebisingan ≥85 dB), Sarung tangan tahan potongan, panas, atau kimia (sesuai bahaya), Safety shoes / steel-toe boots (area dengan risiko tertimpa benda berat atau lantai licin), Masker/respirator (area berdebu atau bahan kimia), dan Rompi/pakaian pelindung (area pengelasan atau bahan berbahaya). Permenaker 08/2010 mewajibkan pengusaha menyediakan, memelihara, dan memantau pemakaian APD secara konsisten.'],
      ],
    ],
  ],
  [
    '@context' => 'https://schema.org',
    '@type'    => 'Organization',
    'name'     => 'Wahana Totalita Konsultan',
    'url'      => 'https://wahanatotalita.com',
    'telephone'=> '+6287759151278',
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
<section style="background:linear-gradient(135deg,#1a0a0a 0%,#3a1a0a 40%,#0A4A2E 100%);color:#fff;padding:60px 20px 50px;">
  <div style="max-width:900px;margin:0 auto;">
    <nav aria-label="breadcrumb" style="font-size:0.85rem;opacity:0.8;margin-bottom:16px;">
      <a href="/" style="color:#ffc0a0;">Beranda</a> &rsaquo;
      <a href="/keselamatan-kerja/" style="color:#ffc0a0;">K3</a> &rsaquo;
      <span>K3 Manufaktur</span>
    </nav>
    <h1 style="font-size:clamp(1.6rem,4vw,2.4rem);font-weight:700;margin:0 0 16px;">
      K3 Industri Manufaktur &amp; Pabrik — Keselamatan di Lantai Produksi
    </h1>
    <p style="font-size:1.05rem;opacity:0.92;max-width:720px;margin:0 0 10px;line-height:1.7;">
      Program pelatihan K3 komprehensif untuk industri manufaktur: keselamatan mesin produksi, Lockout/Tagout, ergonomi lini produksi, pengendalian bahan kimia, K3 kebakaran pabrik, dan SMK3 — sesuai UU 1/1970, PP 50/2012, dan Permenaker terkait. Bersertifikat BNSP &amp; Kemnaker RI.
    </p>
    <div style="display:flex;flex-wrap:wrap;gap:10px;margin:18px 0 28px;">
      <span style="background:rgba(255,255,255,0.15);padding:6px 14px;border-radius:20px;font-size:0.85rem;">✓ UU 1/1970 & PP 50/2012</span>
      <span style="background:rgba(255,255,255,0.15);padding:6px 14px;border-radius:20px;font-size:0.85rem;">✓ Permenaker 38/2016 Mesin</span>
      <span style="background:rgba(255,255,255,0.15);padding:6px 14px;border-radius:20px;font-size:0.85rem;">✓ Sertifikat BNSP / Kemnaker</span>
      <span style="background:rgba(255,255,255,0.15);padding:6px 14px;border-radius:20px;font-size:0.85rem;">✓ In-house di pabrik Anda</span>
    </div>
    <a href="https://wa.me/6287759151278?text=Halo%2C+saya+ingin+info+pelatihan+K3+manufaktur+dan+pabrik+untuk+perusahaan+kami."
       target="_blank" rel="noopener"
       style="display:inline-block;background:#C6621C;color:#fff;padding:14px 32px;border-radius:6px;font-weight:700;text-decoration:none;font-size:1rem;">
      Konsultasi Program K3 Pabrik
    </a>
  </div>
</section>

<main style="max-width:960px;margin:0 auto;padding:40px 20px 60px;">

  <!-- REGULASI -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:24px;">
      Regulasi K3 yang Wajib Dipatuhi Industri Manufaktur
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:18px;">
      <?php
      $regs = [
        ['UU 1/1970','Keselamatan Kerja','Regulasi dasar K3 yang mewajibkan pengusaha: menyediakan lingkungan kerja aman, memasang alat pengaman mesin, menyediakan APD, dan memenuhi syarat K3 yang ditetapkan.','#e8f4eb'],
        ['PP 50/2012','SMK3','Mewajibkan penerapan Sistem Manajemen K3 bagi perusahaan ≥100 karyawan atau yang memiliki potensi bahaya tinggi. Audit SMK3 eksternal setiap 3 tahun oleh lembaga terakreditasi Kemnaker.','#e8eef7'],
        ['Permenaker 38/2016','K3 Pesawat Tenaga & Produksi','Mengatur persyaratan K3 khusus untuk mesin-mesin pabrik: boiler, kompresor, motor listrik, mesin perkakas, dan pesawat produksi lainnya. Wajib riksa uji berkala.','#f0f7e8'],
        ['Permenaker 08/2010','Alat Pelindung Diri (APD)','Mewajibkan pengusaha menyediakan APD yang sesuai bahaya pekerjaan, memastikan APD digunakan, dan memelihara APD agar tetap layak.','#fff8f0'],
        ['Permenaker 05/2018','K3 Lingkungan Kerja','NAB (Nilai Ambang Batas) untuk faktor fisika (kebisingan, panas, radiasi), kimia, biologi, ergonomi, dan psikologi. Wajib pemantauan dan pengendalian berkala.','#f7f4e8'],
        ['Kepmenaker 187/1999','Pengendalian Bahan Kimia Berbahaya','Kewajiban untuk industri yang menggunakan B3 (Bahan Berbahaya Beracun): LDKB (Lembar Data Keselamatan Bahan), label, dan kuantitas ambang batas.','#f0e8f7'],
      ];
      foreach ($regs as $r): ?>
      <div style="background:<?php echo $r[3]; ?>;border-radius:10px;padding:20px;border-left:5px solid #0A4A2E;">
        <div style="font-weight:800;color:#C6621C;font-size:0.9rem;margin-bottom:4px;"><?php echo $r[0]; ?></div>
        <div style="font-weight:700;color:#0A4A2E;margin-bottom:8px;font-size:0.93rem;"><?php echo $r[1]; ?></div>
        <p style="color:#555;font-size:0.86rem;line-height:1.6;margin:0;"><?php echo $r[2]; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- BAHAYA UTAMA MANUFAKTUR -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Bahaya K3 Utama di Industri Manufaktur
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:16px;">
      <?php
      $hazards = [
        ['background:#1a0a0a','⚙️','Bahaya Mesin & Titik Jepit','Roda gigi, sabuk transmisi, poros berputar, titik penjepit (nip point) — menyebabkan cedera amputasi dan crush injury. Wajib guard/pelindung mesin dan prosedur LOTO saat maintenance.'],
        ['background:#0a1a3a','⚡','Bahaya Listrik','Sengatan listrik, busur listrik (arc flash), dan kebakaran akibat korsleting. Bahaya tertinggi di panel listrik, wiring, dan operasi mesin bertenaga listrik tinggi.'],
        ['background:#1a2a0a','🧪','Bahan Kimia & B3','Pelarut, cat, bahan pembersih, dan bahan baku kimia — paparan melalui inhalasi, kontak kulit, atau ingesti. Wajib LDKB (SDS), label B3, dan APD kimia yang sesuai.'],
        ['background:#2a1a0a','🔊','Kebisingan Industri','Mesin produksi sering menghasilkan kebisingan ≥85 dB — ambang batas paparan 8 jam. Gangguan pendengaran akibat kerja (NIHL) bersifat permanen dan tidak bisa disembuhkan.'],
        ['background:#0a2a2a','🌡️','Tekanan Panas','Lingkungan kerja di dekat furnace, oven, atau mesin produksi panas menyebabkan heat stress. Tanpa kontrol: kelelahan panas, heat stroke, hingga kematian.'],
        ['background:#2a0a2a','🏋️','Ergonomi & MSD','Pengangkatan manual berulang, postur janggal, dan gerakan repetitif di lini produksi menyebabkan MSD (Musculoskeletal Disorders) — penyebab utama absensi jangka panjang di manufaktur.'],
      ];
      foreach ($hazards as $h): ?>
      <div style="background:<?php echo $h[0]; ?>;color:#fff;border-radius:10px;padding:20px;">
        <div style="font-size:1.8rem;margin-bottom:10px;"><?php echo $h[1]; ?></div>
        <div style="font-weight:700;margin-bottom:8px;font-size:0.95rem;color:#ffd0a0;"><?php echo $h[2]; ?></div>
        <p style="font-size:0.86rem;line-height:1.6;margin:0;opacity:0.85;"><?php echo $h[3]; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- LOTO SECTION -->
  <section style="margin-bottom:48px;background:#fff8f0;border-radius:10px;padding:28px;border-left:6px solid #C6621C;">
    <h2 style="color:#0A4A2E;font-size:1.4rem;margin:0 0 14px;">Prosedur Lockout/Tagout (LOTO) — Kunci Keselamatan Mesin</h2>
    <p style="color:#333;line-height:1.8;margin:0 0 18px;font-size:0.92rem;">LOTO (Lockout/Tagout) adalah prosedur standar pengendalian energi berbahaya saat maintenance mesin. Tanpa LOTO yang benar, mesin bisa menyala tiba-tiba saat teknisi masih bekerja di dalamnya — menyebabkan cedera serius atau kematian.</p>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:12px;">
      <?php
      $loto = [
        ['1','Identifikasi','Identifikasi seluruh sumber energi mesin: listrik, pneumatik, hidrolik, mekanik, termal, gravitasi.'],
        ['2','Matikan & Isolasi','Matikan mesin melalui prosedur normal, kemudian isolasi setiap sumber energi menggunakan perangkat isolasi.'],
        ['3','Kunci (Lockout)','Pasang kunci pribadi pada setiap titik isolasi — hanya orang yang memasang kunci yang boleh membukanya.'],
        ['4','Tandai (Tagout)','Pasang tag peringatan pada setiap titik isolasi yang dikunci, mencantumkan nama dan tanggal.'],
        ['5','Verifikasi Energi Nol','Coba nyalakan mesin, cek dengan volt meter, buang tekanan sisa — pastikan benar-benar tidak ada energi tersimpan.'],
        ['6','Lepas Kunci','Setelah pekerjaan selesai dan area bersih: lepas kunci secara berurutan, baru nyalakan kembali mesin.'],
      ];
      foreach ($loto as $l): ?>
      <div style="background:#fff;border-radius:6px;padding:14px;display:flex;gap:12px;align-items:flex-start;">
        <div style="background:#C6621C;color:#fff;width:28px;height:28px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:0.85rem;flex-shrink:0;"><?php echo $l[0]; ?></div>
        <div>
          <div style="font-weight:700;color:#0A4A2E;margin-bottom:4px;font-size:0.88rem;"><?php echo $l[1]; ?></div>
          <p style="color:#555;font-size:0.83rem;line-height:1.5;margin:0;"><?php echo $l[2]; ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- APD TABLE -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      APD Wajib di Lantai Produksi Manufaktur
    </h2>
    <div style="overflow-x:auto;">
      <table style="width:100%;border-collapse:collapse;font-size:0.88rem;">
        <thead>
          <tr style="background:#0A4A2E;color:#fff;">
            <th style="padding:10px 14px;text-align:left;">APD</th>
            <th style="padding:10px 14px;text-align:left;">Area Wajib</th>
            <th style="padding:10px 14px;text-align:left;">Bahaya yang Dilindungi</th>
            <th style="padding:10px 14px;text-align:left;">Standar Referensi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $apd = [
            ['Safety Helmet','Area dengan benda jatuh dari ketinggian, overhead crane','Benda jatuh, benturan kepala','SNI 0811, EN 397'],
            ['Safety Shoes (steel-toe)','Seluruh lantai produksi','Benda berat jatuh, tertusuk, tergelincir','SNI 7037, EN ISO 20345'],
            ['Kacamata Safety / Face Shield','Area machining, grinding, welding, kimia','Serpihan, percikan, cairan berbahaya','ANSI Z87.1, EN 166'],
            ['Earplug / Earmuff','Area kebisingan ≥ 85 dB','Gangguan pendengaran permanen (NIHL)','SNI 7311, EN 352'],
            ['Sarung Tangan Safety','Machining (cut-resistant), kimia (chemical-resistant), welding (heat-resistant)','Luka potong, luka bakar, paparan kimia','EN 374, EN 388, EN 407'],
            ['Respirator / Masker','Area debu, asap las, uap kimia, cat','Gangguan saluran napas dan paru-paru','EN 149 (FFP2/FFP3), EN 140'],
            ['Pakaian Safety / Wearpack','Seluruh area produksi; wearpack anti-api untuk las','Percikan, panas, kontaminan','EN 11612 (flame resistant)'],
          ];
          foreach ($apd as $i => $a):
            $bg = $i%2===0?'#fff':'#f5f5f5';
          ?>
          <tr style="background:<?php echo $bg; ?>;">
            <td style="padding:9px 14px;border-bottom:1px solid #eee;font-weight:600;color:#0A4A2E;font-size:0.87rem;"><?php echo $a[0]; ?></td>
            <td style="padding:9px 14px;border-bottom:1px solid #eee;color:#444;font-size:0.85rem;"><?php echo $a[1]; ?></td>
            <td style="padding:9px 14px;border-bottom:1px solid #eee;color:#555;font-size:0.84rem;"><?php echo $a[2]; ?></td>
            <td style="padding:9px 14px;border-bottom:1px solid #eee;color:#777;font-size:0.82rem;"><?php echo $a[3]; ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </section>

  <!-- PROGRAM PELATIHAN -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Program Pelatihan K3 Manufaktur
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:18px;">
      <?php
      $programs = [
        ['/pelatihan/pelatihan-ahli-k3-umum-kemnaker-ri/', 'Ahli K3 Umum Kemnaker RI', 'Sertifikasi wajib untuk safety officer pabrik — 12 hari, ujian tertulis + inspeksi, sertifikat diakui Kemnaker RI secara nasional.', true],
        ['/pelatihan/pelatihan-petugas-p3k-kemnaker-ri/', 'Petugas P3K Kemnaker RI', 'Wajib ada minimal 1 petugas P3K per 25 karyawan (Permenaker 15/2008). Penanganan darurat cedera pabrik, melatih respons pertama di lini produksi.', true],
        ['/penanggulangan-kebakaran/', 'K3 Kebakaran Pabrik', 'APAR, hidran, jalur evakuasi, dan fire drill khusus industri manufaktur dengan risiko bahan kimia, debu, dan panas tinggi.', true],
        ['', 'Lockout/Tagout (LOTO)', 'Prosedur pengendalian energi berbahaya saat maintenance mesin — 6 langkah LOTO, audit LOTO, dan hands-on latihan di unit mesin percontohan.', false],
        ['', 'Ergonomi Industri & Pencegahan MSD', 'Identifikasi bahaya ergonomi di lini produksi, redesain stasiun kerja, alat bantu angkat, dan teknik angkat manual yang benar.', false],
        ['', 'Pengendalian Kebisingan & Panas', 'Pengukuran kebisingan dan heat stress, interpretasi NAB (Permenaker 5/2018), hierarki pengendalian, dan monitoring kesehatan pekerja.', false],
      ];
      foreach ($programs as $p): ?>
      <div style="background:#f9f9f9;border:1px solid #e0e0e0;border-radius:8px;padding:18px;">
        <div style="font-weight:700;color:#0A4A2E;margin-bottom:6px;font-size:0.93rem;"><?php echo $p[1]; ?></div>
        <p style="color:#666;font-size:0.84rem;line-height:1.5;margin:0 0 14px;"><?php echo $p[2]; ?></p>
        <?php if ($p[3] && $p[0]): ?>
        <a href="<?php echo $p[0]; ?>" style="display:inline-block;background:#0A4A2E;color:#fff;padding:7px 16px;border-radius:4px;text-decoration:none;font-size:0.82rem;font-weight:600;">Lihat Program →</a>
        <?php else: ?>
        <a href="https://wa.me/6287759151278?text=Halo%2C+saya+tertarik+pelatihan+<?php echo urlencode($p[1]); ?>+untuk+pabrik+kami.+Mohon+info+jadwal+dan+harga."
           target="_blank" rel="noopener"
           style="display:inline-block;background:#0A4A2E;color:#fff;padding:7px 16px;border-radius:4px;text-decoration:none;font-size:0.82rem;font-weight:600;">
          Tanya via WhatsApp →
        </a>
        <?php endif; ?>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- RELATED LINKS -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.4rem;border-bottom:2px solid #e0e0e0;padding-bottom:8px;margin-bottom:16px;">Topik K3 Terkait</h2>
    <div style="display:flex;flex-wrap:wrap;gap:12px;">
      <?php
      $related = [
        ['/k3-kimia/','K3 Bahan Kimia Berbahaya (B3)'],
        ['/k3-listrik/','K3 Kelistrikan & Instalasi'],
        ['/smk3/','Sistem Manajemen K3 (SMK3)'],
        ['/higiene-industri/','Higiene Industri & NAB'],
        ['/juru-las/','Operator Juru Las'],
        ['/operator-alat-berat/','Operator Pesawat Angkat Angkut'],
      ];
      foreach ($related as $r): ?>
      <a href="<?php echo $r[0]; ?>" style="display:inline-block;background:#fff;border:1px solid #c0d8c8;border-radius:6px;padding:10px 16px;color:#0A4A2E;text-decoration:none;font-size:0.88rem;font-weight:600;" onmouseover="this.style.background='#e8f4eb'" onmouseout="this.style.background='#fff'"><?php echo $r[1]; ?></a>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- FAQ -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:24px;">Pertanyaan yang Sering Diajukan</h2>
    <?php
    $faqs = [
      ['Regulasi K3 apa yang wajib dipatuhi industri manufaktur?','UU 1/1970, PP 50/2012 (SMK3 wajib ≥100 karyawan), Permenaker 38/2016 (K3 mesin produksi), Permenaker 08/2010 (APD), Permenaker 05/2018 (NAB lingkungan kerja), dan Kepmenaker 187/1999 (bahan kimia berbahaya).'],
      ['Apa itu LOTO dan mengapa wajib diterapkan di pabrik?','Lockout/Tagout (LOTO) = prosedur pengendalian energi berbahaya saat maintenance mesin — memastikan mesin tidak bisa dinyalakan oleh orang lain saat teknisi masih bekerja di dalamnya. Tanpa LOTO, mesin bisa menyala tiba-tiba dan menyebabkan cedera amputasi atau kematian.'],
      ['Bahaya ergonomi apa yang paling sering terjadi di lini produksi?','Gerakan berulang (repetitive strain), postur janggal, pengangkatan manual berlebihan, tekanan kontak, dan getaran tangan-lengan. MSD (Musculoskeletal Disorders) adalah penyebab terbanyak absensi di manufaktur dan bisa bersifat permanen.'],
      ['Seberapa sering audit K3 internal harus dilakukan di pabrik?','Berdasarkan PP 50/2012: minimal 1x/tahun untuk audit SMK3 internal. Praktik terbaik: inspeksi harian (supervisor), mingguan (safety officer), bulanan (audit departemen). Audit eksternal SMK3 oleh lembaga terakreditasi Kemnaker wajib setiap 3 tahun.'],
      ['Sanksi apa yang dihadapi perusahaan jika terjadi kecelakaan kerja?','Sanksi administratif Disnaker (peringatan hingga penutupan), lapor kecelakaan 2x24 jam, klaim BPJS JKK, tuntutan perdata dari korban, dan — jika terbukti lalai — pidana untuk pengurus perusahaan (UU 1/1970 Pasal 15: penjara + denda).'],
      ['APD apa saja yang wajib tersedia di lantai produksi?','Safety helmet, safety shoes (steel-toe), kacamata safety/face shield, earplug/earmuff (area ≥85 dB), sarung tangan (sesuai bahaya), respirator (area berdebu/kimia), dan pakaian safety/wearpack. Jenis APD disesuaikan bahaya spesifik setiap area (Permenaker 08/2010).'],
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
  <section style="background:linear-gradient(135deg,#1a0a0a,#0A4A2E);color:#fff;border-radius:12px;padding:40px;text-align:center;">
    <h2 style="margin:0 0 12px;font-size:1.6rem;">Jadikan Pabrik Anda Lebih Aman — Konsultasi K3 Sekarang</h2>
    <p style="opacity:0.9;margin:0 0 10px;line-height:1.7;max-width:580px;margin-left:auto;margin-right:auto;">
      Wahana Totalita menyediakan pelatihan K3 in-house langsung di pabrik Anda — melatih tim produksi, supervisor, dan safety officer dengan materi yang relevan dengan kondisi lapangan aktual.
    </p>
    <p style="opacity:0.75;font-size:0.9rem;margin:0 0 24px;">Sertifikat BNSP &amp; Kemnaker RI · Instruktur K3 berpengalaman industri · Materi disesuaikan jenis pabrik Anda</p>
    <a href="https://wa.me/6287759151278?text=Halo%2C+saya+ingin+konsultasi+pelatihan+K3+manufaktur+untuk+pabrik+kami.+Mohon+info+program+dan+harga."
       target="_blank" rel="noopener"
       style="display:inline-block;background:#C6621C;color:#fff;padding:14px 36px;border-radius:6px;font-weight:700;text-decoration:none;font-size:1.05rem;">
      WhatsApp: 0877-5915-1278
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
