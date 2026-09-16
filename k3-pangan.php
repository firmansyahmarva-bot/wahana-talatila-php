<?php
require_once __DIR__ . '/config.php';
$s = get_all_settings();
// Hub: K3 Industri Pangan & Food Safety
$canonical = 'https://wahanatotalita.com/k3-pangan/';
$meta_title = 'K3 Industri Pangan & Food Safety Training Yogyakarta — Wahana Totalita';
$meta_desc  = 'Pelatihan K3 industri pangan, food safety, higiene pengolahan makanan, GMP/CPPB, dan HACCP untuk pabrik makanan, katering, dan UMKM pangan di Yogyakarta dan DIY.';

$schema = [
  [
    '@context' => 'https://schema.org',
    '@type'    => 'BreadcrumbList',
    'itemListElement' => [
      ['@type'=>'ListItem','position'=>1,'name'=>'Beranda','item'=>'https://wahanatotalita.com/'],
      ['@type'=>'ListItem','position'=>2,'name'=>'K3','item'=>'https://wahanatotalita.com/keselamatan-kerja/'],
      ['@type'=>'ListItem','position'=>3,'name'=>'K3 Pangan','item'=>$canonical],
    ],
  ],
  [
    '@context' => 'https://schema.org',
    '@type'    => 'FAQPage',
    'mainEntity' => [
      [
        '@type' => 'Question',
        'name'  => 'Apa perbedaan K3 pangan dan food safety?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'K3 pangan (Keselamatan dan Kesehatan Kerja di industri pangan) berfokus pada keselamatan PEKERJA di unit pengolahan makanan: mencegah cedera akibat pisau, mesin pengolah, uap panas, lantai licin, dan bahan kimia pembersih. Food safety berfokus pada keamanan PRODUK untuk konsumen: mencegah kontaminasi biologis, kimia, dan fisik pada makanan yang diproduksi. Keduanya tidak terpisah — pabrik pangan yang aman untuk pekerja (K3) umumnya juga menghasilkan produk yang aman (food safety). Regulasi K3: UU 1/1970 + Permenaker terkait. Regulasi food safety: UU 18/2012 tentang Pangan + PP 86/2019 + standar BPOM.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apa itu HACCP dan apakah wajib diterapkan semua industri pangan?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'HACCP (Hazard Analysis Critical Control Points) adalah sistem pencegahan risiko keamanan pangan yang mengidentifikasi titik-titik kritis dalam proses produksi (Critical Control Points/CCP) dan menetapkan langkah pengendalian agar bahaya biologis, kimia, dan fisik tidak mencapai konsumen. Di Indonesia, HACCP diatur dalam SNI CAC/RCP 1:2011 (Codex Alimentarius). Kewajiban: wajib bagi industri pangan skala besar yang mengekspor dan/atau mendistribusikan ke seluruh Indonesia sesuai PerBPOM 8/2020. UMKM pangan skala kecil (PIRT) diwajibkan menerapkan CPPB-IRT (Cara Produksi Pangan yang Baik untuk Industri Rumah Tangga). Meskipun tidak selalu diwajibkan secara hukum, HACCP adalah prerequisite bagi pemasok modern trade (supermarket, hotel bintang) dan eksportir.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Bahaya K3 apa yang paling sering terjadi di pabrik makanan?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Bahaya K3 paling sering di industri pangan: (1) Luka sayat — pisau dan alat pengolah; bisa dikurangi dengan sarung tangan cut-resistant dan knife safety training; (2) Terpeleset dan terjatuh — lantai basah dan berminyak adalah bahaya terbesar di dapur industri; (3) Luka bakar dan paparan uap panas — oven, autoklaf, steamer, dan minyak goreng mendidih; (4) Gangguan muskuloskeletal (MSD) — berdiri lama, membungkuk berulang, dan mengangkat kontainer berat; (5) Paparan bahan kimia pembersih dan sanitiser — klorin, NaOH, asam, yang dapat menyebabkan iritasi kulit dan saluran napas; (6) Cold stress — bekerja di ruang pendingin (cold storage) dalam waktu lama; (7) Kebisingan dari mesin pengolah.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apa persyaratan higiene personal untuk pekerja di fasilitas pengolahan pangan?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Persyaratan higiene personal pekerja pangan (mengacu GMP/CPPB dan Permenkes): (1) Cuci tangan 20 detik dengan sabun dan air hangat setiap kali masuk area produksi, setelah toilet, dan setelah memegang bahan non-pangan; (2) Mengenakan pakaian kerja bersih, penutup kepala (hair net), dan masker penutup hidung-mulut; (3) Tidak mengenakan perhiasan, jam tangan, atau kuku buatan di area produksi; (4) Kuku harus pendek dan bersih, tidak bercat kuku; (5) Tidak bekerja jika mengalami penyakit menular (diare, infeksi saluran napas aktif, luka terbuka); (6) Tidak makan, minum, atau merokok di area produksi; (7) Melaporkan kondisi kesehatan yang dapat memengaruhi keamanan pangan kepada supervisor. Pelatihan higiene pangan wajib diberikan kepada setiap pekerja baru dan di-refresh tahunan.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apa saja dokumen yang diperlukan untuk mendapatkan izin PIRT (Pangan Industri Rumah Tangga)?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Untuk mengajukan Sertifikat PIRT dari Dinas Kesehatan Kabupaten/Kota: (1) Fotokopi KTP pemilik; (2) Pas foto 3×4; (3) Surat keterangan domisili usaha; (4) Denah lokasi dan denah bangunan; (5) Daftar produk yang didaftarkan; (6) Rincian komposisi dan proses produksi; (7) Contoh label kemasan; (8) Sertifikat penyuluhan keamanan pangan (PKP) dari Dinas Kesehatan — WAJIB diikuti sebelum izin diterbitkan. Wahana Totalita dapat membantu persiapan sertifikat PKP dan pelatihan food safety sebagai prasyarat PIRT. Setelah PIRT, jika usaha berkembang, wajib naik ke MD atau ML dari BPOM.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apa perbedaan PIRT, MD, dan ML yang dikeluarkan BPOM?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Tiga jenis izin edar pangan di Indonesia: PIRT (Pangan Industri Rumah Tangga) — diterbitkan Dinas Kesehatan, untuk produksi skala rumah tangga, distribusi lokal, tidak boleh untuk produk risiko tinggi (daging, susu, ikan kaleng). MD (Dalam Negeri) — izin edar BPOM untuk industri pangan dalam negeri skala menengah-besar, wajib jika distribusi nasional atau produk risiko tinggi. ML (Luar Negeri) — izin edar BPOM untuk produk pangan impor. Persyaratan BPOM jauh lebih ketat dari PIRT: GMP/CPPB wajib terpenuhi, audit fasilitas, pengujian laboratorium, dan label sesuai PerBPOM. Wahana membantu persiapan sistem K3 dan GMP sebagai fondasi sebelum mengajukan MD ke BPOM.'],
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
<section style="background:linear-gradient(135deg,#2a1a00 0%,#C6621C 50%,#0A4A2E 100%);color:#fff;padding:60px 20px 50px;">
  <div style="max-width:900px;margin:0 auto;">
    <nav aria-label="breadcrumb" style="font-size:0.85rem;opacity:0.8;margin-bottom:16px;">
      <a href="/" style="color:#ffd080;">Beranda</a> &rsaquo;
      <a href="/keselamatan-kerja/" style="color:#ffd080;">K3</a> &rsaquo;
      <span>K3 Industri Pangan</span>
    </nav>
    <h1 style="font-size:clamp(1.6rem,4vw,2.4rem);font-weight:700;margin:0 0 16px;">
      K3 Industri Pangan &amp; Food Safety Training Yogyakarta
    </h1>
    <p style="font-size:1.05rem;opacity:0.92;max-width:720px;margin:0 0 10px;line-height:1.7;">
      Pelatihan keselamatan kerja dan keamanan pangan untuk industri pengolahan makanan, katering instansi, UMKM pangan, dan dapur hotel di Yogyakarta — mencakup K3 pekerja pangan, higiene personal, GMP/CPPB, dan HACCP. Persiapan izin PIRT, MD/ML BPOM, dan audit food safety.
    </p>
    <div style="display:flex;flex-wrap:wrap;gap:10px;margin:18px 0 28px;">
      <span style="background:rgba(255,255,255,0.16);padding:6px 14px;border-radius:20px;font-size:0.85rem;">✓ UU 18/2012 & PP 86/2019</span>
      <span style="background:rgba(255,255,255,0.16);padding:6px 14px;border-radius:20px;font-size:0.85rem;">✓ GMP / CPPB / HACCP</span>
      <span style="background:rgba(255,255,255,0.16);padding:6px 14px;border-radius:20px;font-size:0.85rem;">✓ Persiapan PIRT & BPOM</span>
      <span style="background:rgba(255,255,255,0.16);padding:6px 14px;border-radius:20px;font-size:0.85rem;">✓ In-house di pabrik/dapur Anda</span>
    </div>
    <a href="https://wa.me/6287759151278?text=Halo%2C+saya+ingin+info+pelatihan+K3+industri+pangan+dan+food+safety+untuk+perusahaan%2FUMKM+kami+di+Yogyakarta."
       target="_blank" rel="noopener"
       style="display:inline-block;background:#0A4A2E;color:#fff;padding:14px 32px;border-radius:6px;font-weight:700;text-decoration:none;font-size:1rem;">
      Konsultasi Program K3 Pangan
    </a>
  </div>
</section>

<main style="max-width:960px;margin:0 auto;padding:40px 20px 60px;">

  <!-- REGULASI -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:24px;">
      Regulasi K3 &amp; Keamanan Pangan di Indonesia
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:18px;">
      <?php
      $regs = [
        ['UU 18/2012','Pangan','Landasan hukum pengelolaan pangan nasional: keamanan pangan, mutu, gizi, dan label pangan. Mewajibkan setiap pelaku usaha pangan menjamin keamanan produk yang beredar.','#fff8f0'],
        ['PP 86/2019','Keamanan Pangan','Mengatur penerapan sanitasi, higiene, GMP, dan sistem manajemen keamanan pangan. Mewajibkan pelaku usaha pangan besar menerapkan HACCP atau sistem setara.','#e8f4eb'],
        ['PerBPOM 8/2020','Persyaratan Teknis Industri Pangan','Mengatur persyaratan GMP (Good Manufacturing Practices) untuk industri pangan yang mengajukan izin edar MD ke BPOM — mencakup bangunan, mesin, higiene, dan pengendalian proses.','#e8eef7'],
        ['Permenkes 1096/2011','Higiene Sanitasi Jasaboga','Wajib untuk katering, restoran, dan industri jasaboga: persyaratan penjamah makanan, fasilitas sanitasi, dan sertifikasi higiene sanitasi dari Dinas Kesehatan.','#f0f7e8'],
        ['SNI CAC/RCP 1:2011','HACCP (Codex Alimentarius)','Standar sistem HACCP yang diadopsi Indonesia dari Codex Alimentarius — identifikasi bahaya, titik kendali kritis (CCP), batas kritis, dan sistem monitoring.','#f7f4e8'],
        ['UU 1/1970 & Permenaker','K3 Pekerja Pangan','K3 untuk keselamatan pekerja di industri pangan: mencegah cedera, penyakit akibat kerja, dan memastikan kondisi kerja yang aman di lini produksi dan dapur.','#f0e8f7'],
      ];
      foreach ($regs as $r): ?>
      <div style="background:<?php echo $r[3]; ?>;border-radius:10px;padding:20px;border-left:5px solid #C6621C;">
        <div style="font-weight:800;color:#C6621C;font-size:0.9rem;margin-bottom:4px;"><?php echo $r[0]; ?></div>
        <div style="font-weight:700;color:#0A4A2E;margin-bottom:8px;font-size:0.93rem;"><?php echo $r[1]; ?></div>
        <p style="color:#555;font-size:0.86rem;line-height:1.6;margin:0;"><?php echo $r[2]; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- BAHAYA K3 PANGAN -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Bahaya K3 Utama di Industri Pengolahan Pangan
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:16px;">
      <?php
      $hazards = [
        ['background:#3a1a00','🔪','Bahaya Pisau & Alat Potong','Luka sayat dan amputasi parsial dari pisau, slicer, dan alat pengolah. Pengendalian: sarung tangan cut-resistant, teknik pemotongan yang benar, penyimpanan pisau aman, dan perawatan ketajaman.'],
        ['background:#1a0a00','🏊','Lantai Licin & Jatuh','Lantai basah dan berminyak di dapur dan area pengolahan — penyebab terbesar kecelakaan di industri pangan. Pengendalian: lantai anti-slip, sepatu keselamatan, dan manajemen tumpahan.'],
        ['background:#4a1a00','🌡️','Luka Bakar & Uap Panas','Oven, kompor industri, steamer, autoklaf, dan minyak goreng mendidih. Pengendalian: sarung tangan tahan panas, pelindung wajah, dan prosedur penanganan peralatan panas.'],
        ['background:#001a3a','🧊','Cold Stress (Ruang Dingin)','Paparan suhu dingin ekstrem di cold storage (-18°C hingga -25°C) dalam durasi lama — hipotermia dan frostbite. Pengendalian: pakaian pelindung dingin, batas waktu masuk, dan buddy system.'],
        ['background:#1a1a00','🧴','Bahan Kimia Pembersih','Klorin, NaOH (soda api), asam sitrat, dan sanitiser kuat — kontak kulit dan inhalasi dapat menyebabkan luka bakar kimia dan gangguan saluran napas.'],
        ['background:#1a0a1a','🏋️','Ergonomi & Berdiri Lama','Mengangkat kontainer berat berulang, berdiri di permukaan keras 8 jam+, dan gerakan berulang di lini produksi — menyebabkan MSD dan varises.'],
      ];
      foreach ($hazards as $h): ?>
      <div style="background:<?php echo $h[0]; ?>;color:#fff;border-radius:10px;padding:18px;">
        <div style="font-size:1.6rem;margin-bottom:8px;"><?php echo $h[1]; ?></div>
        <div style="font-weight:700;font-size:0.93rem;margin-bottom:6px;color:#ffd080;"><?php echo $h[2]; ?></div>
        <p style="font-size:0.84rem;line-height:1.6;margin:0;opacity:0.85;"><?php echo $h[3]; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- HACCP 7 PRINSIP -->
  <section style="margin-bottom:48px;background:#f0f7f3;border-radius:10px;padding:28px;">
    <h2 style="color:#0A4A2E;font-size:1.4rem;margin:0 0 14px;">7 Prinsip HACCP — Sistem Keamanan Pangan Berbasis Risiko</h2>
    <p style="color:#333;line-height:1.8;margin:0 0 18px;font-size:0.92rem;">HACCP (Hazard Analysis Critical Control Points) adalah sistem proaktif yang mengidentifikasi titik-titik kritis dalam proses produksi dan menetapkan pengendalian sebelum bahaya terjadi — berbeda dari inspeksi produk akhir yang bersifat reaktif.</p>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:12px;">
      <?php
      $haccp = [
        ['P1','Analisis Bahaya (HA)','Identifikasi bahaya biologis (bakteri, virus), kimia (pestisida, alergen), dan fisik (serpihan logam, tulang) di setiap tahap proses.'],
        ['P2','Identifikasi CCP','Tentukan Critical Control Points — tahap proses di mana pengendalian dapat diterapkan dan penting untuk mencegah bahaya.'],
        ['P3','Batas Kritis','Tetapkan batas kritis terukur untuk setiap CCP: suhu, pH, waktu, kadar air, konsentrasi sanitiser.'],
        ['P4','Sistem Monitoring','Prosedur monitoring berkelanjutan atau berkala untuk memastikan setiap CCP selalu dalam batas kritis yang ditetapkan.'],
        ['P5','Tindakan Koreksi','Tindakan yang diambil jika monitoring menunjukkan CCP keluar dari batas kritis — termasuk disposisi produk yang terdampak.'],
        ['P6','Prosedur Verifikasi','Konfirmasi bahwa sistem HACCP berfungsi efektif: audit internal, pengujian mikrobiologi, dan kalibrasi alat ukur.'],
        ['P7','Dokumentasi & Rekaman','Semua prosedur HACCP, monitoring, koreksi, dan verifikasi harus terdokumentasi — bukti sistem berjalan dan fondasi audit eksternal.'],
      ];
      foreach ($haccp as $h): ?>
      <div style="background:#fff;border-radius:6px;padding:14px;">
        <div style="background:#C6621C;color:#fff;display:inline-block;padding:2px 8px;border-radius:4px;font-size:0.8rem;font-weight:700;margin-bottom:6px;"><?php echo $h[0]; ?></div>
        <div style="font-weight:700;color:#0A4A2E;margin-bottom:4px;font-size:0.88rem;"><?php echo $h[1]; ?></div>
        <p style="color:#555;font-size:0.82rem;line-height:1.5;margin:0;"><?php echo $h[2]; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- IZIN EDAR -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Jalur Izin Edar Produk Pangan Indonesia
    </h2>
    <div style="overflow-x:auto;">
      <table style="width:100%;border-collapse:collapse;font-size:0.88rem;">
        <thead>
          <tr style="background:#C6621C;color:#fff;">
            <th style="padding:10px 14px;text-align:left;">Izin</th>
            <th style="padding:10px 14px;text-align:left;">Diterbitkan oleh</th>
            <th style="padding:10px 14px;text-align:left;">Untuk Siapa</th>
            <th style="padding:10px 14px;text-align:left;">Prasyarat K3/GMP</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $permits = [
            ['PIRT','Dinas Kesehatan Kab/Kota','UMKM pangan skala rumah tangga, distribusi lokal, produk risiko rendah','Sertifikat Penyuluhan Keamanan Pangan (PKP) — wajib diikuti sebelum PIRT diterbitkan'],
            ['MD','BPOM (untuk domestik)','Industri pangan dalam negeri skala menengah-besar, distribusi nasional, produk risiko tinggi','GMP/CPPB lengkap, audit fasilitas oleh BPOM, pengujian lab, label sesuai PerBPOM'],
            ['ML','BPOM (untuk impor)','Importir dan distributor produk pangan impor','Dokumen impor, COA, sertifikat keamanan dari negara asal, pengujian lab Indonesia'],
            ['MD-SNI','BPOM + BSN','Produk dengan klaim SNI wajib (garam beryodium, air mineral, tepung terigu)','Sertifikasi SNI dari LSPro, plus semua persyaratan MD'],
            ['Halal','BPJPH / MUI','Semua produk pangan yang diklaim halal dan beredar di Indonesia (wajib bertahap)','Sistem Jaminan Halal (SJH), audit LPPOM MUI, tidak ada kontaminasi silang'],
          ];
          foreach ($permits as $i => $p):
            $bg = $i%2===0?'#fff':'#fff8f0';
          ?>
          <tr style="background:<?php echo $bg; ?>;">
            <td style="padding:9px 14px;border-bottom:1px solid #eee;font-weight:700;color:#C6621C;font-size:0.9rem;"><?php echo $p[0]; ?></td>
            <td style="padding:9px 14px;border-bottom:1px solid #eee;color:#444;font-size:0.85rem;"><?php echo $p[1]; ?></td>
            <td style="padding:9px 14px;border-bottom:1px solid #eee;color:#555;font-size:0.84rem;"><?php echo $p[2]; ?></td>
            <td style="padding:9px 14px;border-bottom:1px solid #eee;color:#0A4A2E;font-size:0.83rem;"><?php echo $p[3]; ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </section>

  <!-- PROGRAM PELATIHAN -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Program Pelatihan K3 &amp; Food Safety
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:18px;">
      <?php
      $programs = [
        ['K3 Dasar untuk Pekerja Pangan','Half-day / 4 JP','Semua karyawan lini produksi: identifikasi bahaya di area kerja, penggunaan APD yang benar, prosedur darurat, dan pelaporan insiden.'],
        ['Higiene Personal & Sanitasi Pangan','Half-day / 4 JP','Seluruh penjamah makanan. Teknik cuci tangan yang benar, higiene pakaian kerja, larangan di area produksi, dan tanda-tanda sakit yang wajib dilaporkan.'],
        ['GMP/CPPB untuk Industri Pangan','1 hari / 8 JP','Supervisor, QC, dan manajemen. Persyaratan Good Manufacturing Practices: bangunan, peralatan, higiene, pengendalian proses, dan dokumentasi.'],
        ['Penerapan HACCP (7 Prinsip)','2 hari / 14 JP','Tim HACCP, QA/QC, dan produksi. Analisis bahaya, penetapan CCP, batas kritis, monitoring, koreksi, verifikasi, dan dokumentasi.'],
        ['Persiapan Izin PIRT & PKP','Half-day / 4 JP','UMKM pangan yang akan mengajukan izin PIRT. Penyuluhan Keamanan Pangan (PKP) sebagai prasyarat wajib PIRT dari Dinas Kesehatan.'],
        ['K3 Dapur Katering Instansi','1 hari / 8 JP','Tim dapur katering instansi pemerintah/BUMN. K3 dapur: keselamatan memasak, higiene, manajemen tumpahan, dan keselamatan kerja saat event besar.'],
      ];
      foreach ($programs as $p): ?>
      <div style="background:#f9f9f9;border:1px solid #e0e0e0;border-radius:8px;padding:18px;">
        <div style="font-weight:700;color:#0A4A2E;margin-bottom:6px;font-size:0.93rem;"><?php echo $p[0]; ?></div>
        <div style="font-size:0.82rem;color:#C6621C;font-weight:600;margin-bottom:6px;"><?php echo $p[1]; ?></div>
        <div style="font-size:0.83rem;color:#666;margin-bottom:14px;line-height:1.5;"><?php echo $p[2]; ?></div>
        <a href="https://wa.me/6287759151278?text=Halo%2C+saya+tertarik+pelatihan+<?php echo urlencode($p[0]); ?>+untuk+usaha%2Finstansi+kami."
           target="_blank" rel="noopener"
           style="display:inline-block;background:#C6621C;color:#fff;padding:7px 16px;border-radius:4px;text-decoration:none;font-size:0.82rem;font-weight:600;">
          Tanya via WhatsApp →
        </a>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- RELATED LINKS -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.4rem;border-bottom:2px solid #e0e0e0;padding-bottom:8px;margin-bottom:16px;">Topik Terkait</h2>
    <div style="display:flex;flex-wrap:wrap;gap:12px;">
      <?php
      $related = [
        ['/catering/','Jasa Catering Instansi Pemerintah'],
        ['/k3-manufaktur/','K3 Industri Manufaktur & Pabrik'],
        ['/k3-kimia/','K3 Bahan Kimia Berbahaya (B3)'],
        ['/higiene-industri/','Higiene Industri & NAB Lingkungan'],
        ['/smk3/','Sistem Manajemen K3 (SMK3)'],
      ];
      foreach ($related as $r): ?>
      <a href="<?php echo $r[0]; ?>" style="display:inline-block;background:#fff;border:1px solid #dcc0a0;border-radius:6px;padding:10px 16px;color:#0A4A2E;text-decoration:none;font-size:0.88rem;font-weight:600;" onmouseover="this.style.background='#fff8f0'" onmouseout="this.style.background='#fff'"><?php echo $r[1]; ?></a>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- FAQ -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:24px;">Pertanyaan yang Sering Diajukan</h2>
    <?php
    $faqs = [
      ['Apa perbedaan K3 pangan dan food safety?','K3 pangan = keselamatan PEKERJA (mencegah cedera dan penyakit akibat kerja di lini produksi). Food safety = keamanan PRODUK untuk konsumen (mencegah kontaminasi makanan). Keduanya wajib diterapkan — pabrik yang aman untuk pekerja umumnya juga menghasilkan produk yang aman.'],
      ['Apa itu HACCP dan apakah wajib untuk semua industri pangan?','HACCP = sistem pengendalian bahaya berbasis analisis risiko di titik-titik kritis proses produksi (7 prinsip Codex). Wajib untuk industri besar yang distribusi nasional/ekspor (PerBPOM 8/2020). UMKM wajib CPPB-IRT. Meskipun tidak selalu diwajibkan hukum, HACCP jadi syarat modern trade dan ekspor.'],
      ['Bahaya K3 apa yang paling sering di pabrik makanan?','Luka sayat (pisau/slicer), terpeleset di lantai basah-berminyak, luka bakar (oven/uap/minyak), cold stress (cold storage), paparan bahan kimia pembersih, dan MSD akibat berdiri lama dan angkat berat berulang.'],
      ['Apa persyaratan higiene pekerja di fasilitas pengolahan pangan?','Cuci tangan 20 detik sebelum masuk area produksi, pakaian bersih + hair net + masker, tidak memakai perhiasan/jam, kuku pendek, tidak bekerja jika sakit menular, tidak makan/merokok di area produksi, dan melaporkan kondisi kesehatan.'],
      ['Dokumen apa yang diperlukan untuk izin PIRT?','KTP pemilik, pas foto, surat domisili usaha, denah bangunan, daftar produk + komposisi, contoh label — dan WAJIB: Sertifikat Penyuluhan Keamanan Pangan (PKP) dari Dinas Kesehatan yang harus diikuti sebelum PIRT diterbitkan.'],
      ['Apa perbedaan PIRT, MD, dan ML?','PIRT = izin dari Dinas Kesehatan untuk UMKM rumah tangga, distribusi lokal. MD = izin BPOM untuk industri dalam negeri, distribusi nasional, butuh GMP lengkap. ML = izin BPOM untuk produk impor. Semakin besar skala, semakin ketat persyaratan GMP dan K3-nya.'],
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
  <section style="background:linear-gradient(135deg,#2a1a00,#0A4A2E);color:#fff;border-radius:12px;padding:40px;text-align:center;">
    <h2 style="margin:0 0 12px;font-size:1.6rem;">Jadikan Fasilitas Pangan Anda Aman &amp; Siap Audit</h2>
    <p style="opacity:0.9;margin:0 0 10px;line-height:1.7;max-width:580px;margin-left:auto;margin-right:auto;">
      Dari pelatihan higiene untuk karyawan baru hingga persiapan sistem HACCP untuk izin BPOM — Wahana Totalita siap mendampingi usaha pangan Anda di setiap tahap.
    </p>
    <p style="opacity:0.75;font-size:0.9rem;margin:0 0 24px;">UMKM hingga industri besar · Persiapan PIRT, MD, HACCP · In-house di fasilitas Anda</p>
    <a href="https://wa.me/6287759151278?text=Halo%2C+saya+ingin+konsultasi+K3+dan+food+safety+untuk+usaha+pangan+kami.+Mohon+info+program+dan+harga."
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
