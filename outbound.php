<?php
require_once __DIR__ . '/config.php';
$s = get_all_settings();
// Hub: Outbound Training & Team Building
$canonical = 'https://wahanatotalita.com/outbound/';
$meta_title = 'Outbound Training & Team Building Yogyakarta — untuk Instansi & BUMN | Wahana Totalita';
$meta_desc  = 'Outbound training dan team building profesional di Yogyakarta untuk instansi pemerintah, BUMN, dan korporasi. Program kepemimpinan, team cohesion, dan pengembangan SDM. Hubungi: 0877-5915-1278.';

$schema = [
  [
    '@context' => 'https://schema.org',
    '@type'    => 'BreadcrumbList',
    'itemListElement' => [
      ['@type'=>'ListItem','position'=>1,'name'=>'Beranda','item'=>'https://wahanatotalita.com/'],
      ['@type'=>'ListItem','position'=>2,'name'=>'Pelatihan','item'=>'https://wahanatotalita.com/pelatihan/'],
      ['@type'=>'ListItem','position'=>3,'name'=>'Outbound Training','item'=>$canonical],
    ],
  ],
  [
    '@context' => 'https://schema.org',
    '@type'    => 'FAQPage',
    'mainEntity' => [
      [
        '@type' => 'Question',
        'name'  => 'Apa perbedaan outbound training dan team building biasa?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Outbound training menggabungkan aktivitas fisik di luar ruangan (outdoor) dengan sesi pembelajaran yang terstruktur — setiap aktivitas dirancang untuk mencapai tujuan pengembangan tertentu: kepemimpinan, komunikasi, kepercayaan tim, atau pemecahan masalah. Fasilitator terlatih memimpin sesi debriefing setelah setiap aktivitas untuk mengaitkan pengalaman lapangan dengan konteks pekerjaan nyata. Team building biasa umumnya hanya aktivitas rekreasi tanpa tujuan pembelajaran yang terstruktur.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Berapa peserta minimum dan maksimum untuk program outbound?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Program outbound Wahana Totalita dapat mengakomodasi kelompok mulai dari 20 peserta (satu angkatan kecil) hingga 500+ peserta (kegiatan instansi skala besar). Untuk kelompok besar, program dibagi ke dalam sub-kelompok 8–12 orang per tim dengan fasilitator masing-masing, sehingga kualitas pembelajaran tetap terjaga. Hubungi kami untuk proposal sesuai jumlah peserta Anda.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apakah program outbound bisa dilaksanakan di dalam kantor (indoor)?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Ya. Kami menyediakan program indoor team building yang cocok untuk gedung kantor, aula, atau ballroom hotel — tanpa perlu venue outdoor khusus. Aktivitas indoor mencakup: problem-solving games, simulasi leadership, creative workshop, communication challenges, dan games kolaboratif yang tidak membutuhkan ruang luas. Program indoor ideal untuk musim hujan, peserta dengan keterbatasan fisik, atau kegiatan setengah hari.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Berapa lama waktu ideal untuk program outbound training?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Durasi ideal bergantung pada tujuan: (1) Setengah hari (4 jam) — team building ringan, fokus pada satu tema seperti komunikasi atau energizer pasca rapat; (2) Satu hari penuh (8 jam) — program komprehensif dengan 4–6 aktivitas, cocok untuk annual gathering atau departemen baru; (3) Dua hari satu malam (2D1N) — program pengembangan SDM intensif dengan sesi malam dan refleksi mendalam; (4) Tiga hari dua malam — untuk leadership development program atau training angkatan baru.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apakah outbound training bisa dimasukkan ke dalam anggaran pelatihan instansi pemerintah?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Ya. Program outbound training dan team building dapat dimasukkan dalam mata anggaran pengembangan SDM (kegiatan pelatihan dan pengembangan kompetensi pegawai) atau kegiatan pembinaan kepegawaian. Wahana Totalita terdaftar di LPSE dan PADI UMKM sehingga dapat menjadi vendor resmi untuk pengadaan langsung di bawah Rp 200 juta. Kami menyediakan dokumen administrasi lengkap: SPK, kuitansi, faktur pajak, dan laporan kegiatan.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Lokasi mana yang tersedia untuk outbound training di Yogyakarta?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Wahana Totalita memiliki jaringan venue outbound di wilayah Yogyakarta dan sekitarnya: kawasan lereng Merapi (Kaliurang), Pantai Selatan (Parangtritis, Baron, Kukup), area persawahan dan perkebunan di Sleman dan Bantul, fasilitas olahraga dan resort di Kulon Progo, serta venue indoor di hotel-hotel bintang 3–5 di kota Yogyakarta. Program juga tersedia di luar Yogyakarta untuk instansi yang menginginkan destinasi wisata tertentu.'],
      ],
    ],
  ],
  [
    '@context' => 'https://schema.org',
    '@type'    => 'Organization',
    'name'     => 'Wahana Totalita Konsultan',
    'url'      => 'https://wahanatotalita.com',
    'telephone'=> '+6287759151278',
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
<section style="background:linear-gradient(135deg,#0A4A2E 0%,#1a6b42 60%,#2d8a5a 100%);color:#fff;padding:60px 20px 50px;">
  <div style="max-width:900px;margin:0 auto;">
    <nav aria-label="breadcrumb" style="font-size:0.85rem;opacity:0.8;margin-bottom:16px;">
      <a href="/" style="color:#f5c06a;">Beranda</a> &rsaquo;
      <a href="/pelatihan/" style="color:#f5c06a;">Pelatihan</a> &rsaquo;
      <span>Outbound Training</span>
    </nav>
    <h1 style="font-size:clamp(1.6rem,4vw,2.4rem);font-weight:700;margin:0 0 16px;">
      Outbound Training &amp; Team Building Yogyakarta
    </h1>
    <p style="font-size:1.1rem;opacity:0.92;max-width:720px;margin:0 0 10px;line-height:1.7;">
      Program pengembangan SDM berbasis experiential learning untuk instansi pemerintah, BUMN, dan korporasi. Dipercaya oleh 70+ instansi sejak 2012 — dari Dinas, BUMN, hingga perusahaan swasta nasional di wilayah Yogyakarta dan sekitarnya.
    </p>
    <p style="font-size:0.92rem;opacity:0.8;margin:0 0 28px;">
      ✅ Terdaftar LPSE &amp; PADI UMKM &nbsp;|&nbsp; ✅ Pengadaan langsung &lt; Rp 200 juta &nbsp;|&nbsp; ✅ Dokumen administrasi lengkap
    </p>
    <a href="https://wa.me/6287759151278?text=Halo%2C+saya+ingin+konsultasi+program+outbound+training%2Fteam+building+untuk+instansi+kami.+Mohon+info+jadwal+dan+penawaran."
       target="_blank" rel="noopener"
       style="display:inline-block;background:#C6621C;color:#fff;padding:14px 32px;border-radius:6px;font-weight:700;text-decoration:none;font-size:1rem;">
      Minta Proposal &amp; Penawaran Harga
    </a>
  </div>
</section>

<main style="max-width:960px;margin:0 auto;padding:40px 20px 60px;">

  <!-- MENGAPA OUTBOUND -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Mengapa Outbound Training Efektif untuk Pengembangan SDM?
    </h2>
    <p style="line-height:1.8;color:#333;margin-bottom:16px;">
      Penelitian dalam bidang experiential learning menunjukkan bahwa manusia menyerap dan mempertahankan informasi jauh lebih baik ketika mereka <em>mengalami</em> sesuatu secara langsung dibandingkan hanya mendengarkan atau membaca. Outbound training menggunakan prinsip ini — setiap aktivitas dirancang untuk menciptakan pengalaman yang terasa nyata, diikuti dengan sesi debriefing yang menghubungkan pengalaman tersebut dengan tantangan kerja sehari-hari.
    </p>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px;margin-top:20px;">
      <?php
      $benefits = [
        ['🧠','70% lebih diingat','Pembelajaran experiential tersimpan lebih lama dibanding metode klasikal'],
        ['🤝','Tim lebih kohesif','Aktivitas bersama membangun kepercayaan yang sulit diciptakan di dalam kantor'],
        ['🎯','Tujuan terukur','Setiap aktivitas dikaitkan dengan kompetensi spesifik yang ingin dikembangkan'],
        ['⚡','Energi organisasi naik','Peserta kembali ke kantor dengan semangat dan perspektif baru'],
      ];
      foreach ($benefits as $b): ?>
      <div style="background:#f0f7f3;border-radius:8px;padding:18px;text-align:center;">
        <div style="font-size:2rem;margin-bottom:8px;"><?php echo $b[0]; ?></div>
        <div style="font-weight:600;color:#0A4A2E;margin-bottom:6px;font-size:0.95rem;"><?php echo $b[1]; ?></div>
        <div style="color:#555;font-size:0.85rem;line-height:1.5;"><?php echo $b[2]; ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- TUJUAN PENGEMBANGAN -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:24px;">
      Tujuan Pengembangan yang Dapat Dicapai
    </h2>
    <p style="color:#555;margin-bottom:20px;line-height:1.7;">
      Setiap program dirancang sesuai kebutuhan spesifik klien. Berikut tema dan kompetensi yang paling sering diminta instansi dan korporasi:
    </p>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(270px,1fr));gap:20px;">
      <?php
      $goals = [
        [
          'icon'  => '👑',
          'title' => 'Kepemimpinan (Leadership)',
          'color' => '#e8f4eb',
          'items' => ['Pengambilan keputusan di bawah tekanan','Delegasi dan kepercayaan kepada tim','Komunikasi visi dan arah kepada bawahan','Manajemen konflik dan negosiasi'],
        ],
        [
          'icon'  => '🤝',
          'title' => 'Kerja Sama Tim (Team Cohesion)',
          'color' => '#e8f0f7',
          'items' => ['Membangun kepercayaan antar anggota tim','Peran dan tanggung jawab dalam tim','Komunikasi efektif saat tekanan tinggi','Mengatasi perbedaan gaya kerja'],
        ],
        [
          'icon'  => '💡',
          'title' => 'Kreativitas & Problem Solving',
          'color' => '#f7f4e8',
          'items' => ['Berpikir out-of-the-box dalam situasi terbatas','Pendekatan sistematis terhadap masalah kompleks','Inovasi dan adaptasi perubahan','Design thinking sederhana'],
        ],
        [
          'icon'  => '📣',
          'title' => 'Komunikasi & Kolaborasi',
          'color' => '#ede8f7',
          'items' => ['Komunikasi lintas departemen','Active listening dan empati','Presentasi dan penyampaian ide','Feedback yang konstruktif'],
        ],
        [
          'icon'  => '🏆',
          'title' => 'Motivasi & Engagement',
          'color' => '#f7ece8',
          'items' => ['Membangun motivasi internal tim','Menyelaraskan nilai pribadi dengan nilai organisasi','Merayakan pencapaian bersama','Re-energize tim pasca tekanan proyek besar'],
        ],
        [
          'icon'  => '🔄',
          'title' => 'Change Management',
          'color' => '#e8f4eb',
          'items' => ['Memperkenalkan perubahan organisasi','Mengelola resistensi perubahan','Membangun growth mindset','Adaptasi dengan teknologi dan proses baru'],
        ],
      ];
      foreach ($goals as $g): ?>
      <div style="background:<?php echo $g['color']; ?>;border-radius:8px;padding:20px;">
        <div style="font-size:1.8rem;margin-bottom:8px;"><?php echo $g['icon']; ?></div>
        <div style="font-weight:600;color:#0A4A2E;margin-bottom:12px;font-size:1rem;"><?php echo $g['title']; ?></div>
        <ul style="margin:0;padding-left:18px;color:#444;font-size:0.88rem;line-height:1.8;">
          <?php foreach ($g['items'] as $item): ?>
          <li><?php echo $item; ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- FORMAT PROGRAM -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:24px;">
      Format Program — Pilih Sesuai Kebutuhan
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:20px;">
      <?php
      $formats = [
        [
          'title'    => '⏱️ Half Day (4 Jam)',
          'sub'      => 'Ideal untuk energizer',
          'bg'       => '#0A4A2E',
          'items'    => ['Pembukaan & ice breaking','2–3 aktivitas terfokus','Sesi debriefing singkat','Penutup & foto bersama'],
          'best_for' => 'Annual gathering, setelah rapat besar, departemen baru',
        ],
        [
          'title'    => '☀️ Full Day (8 Jam)',
          'sub'      => 'Program paling populer',
          'bg'       => '#1a6b42',
          'items'    => ['Pembukaan & forming tim','4–6 aktivitas bertema','Sesi makan siang bersama','Debriefing mendalam','Games penutup & penghargaan'],
          'best_for' => 'HUT instansi, program tahunan SDM, pembinaan pegawai',
        ],
        [
          'title'    => '🌙 2D1N',
          'sub'      => 'Pengembangan intensif',
          'bg'       => '#0A3A5A',
          'items'    => ['Program hari 1 lengkap','Sesi refleksi malam hari','Games trust building malam','Program hari 2 + closing ceremony','Sertifikat peserta'],
          'best_for' => 'Leadership development, penerimaan pegawai baru, tim manajemen',
        ],
        [
          'title'    => '🏕️ 3D2N',
          'sub'      => 'Transformasi SDM mendalam',
          'bg'       => '#5a2d0A',
          'items'    => ['Leadership camp penuh','Simulasi situasi nyata','Presentasi action plan','Komitmen perubahan','Sertifikat & laporan evaluasi'],
          'best_for' => 'Diklat kepemimpinan, talent program, calon pemimpin unit',
        ],
      ];
      foreach ($formats as $f): ?>
      <div style="border-radius:8px;overflow:hidden;display:flex;flex-direction:column;border:1px solid #ddd;">
        <div style="background:<?php echo $f['bg']; ?>;color:#fff;padding:16px;">
          <div style="font-weight:700;font-size:1rem;"><?php echo $f['title']; ?></div>
          <div style="font-size:0.82rem;opacity:0.85;margin-top:4px;"><?php echo $f['sub']; ?></div>
        </div>
        <div style="padding:14px 16px;flex:1;background:#fff;">
          <ul style="margin:0 0 12px;padding-left:18px;color:#444;font-size:0.88rem;line-height:1.8;">
            <?php foreach ($f['items'] as $item): ?>
            <li><?php echo $item; ?></li>
            <?php endforeach; ?>
          </ul>
          <div style="font-size:0.82rem;color:#0A4A2E;font-weight:600;">🎯 <?php echo $f['best_for']; ?></div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- AKTIVITAS UNGGULAN -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Aktivitas Unggulan
    </h2>
    <p style="color:#555;margin-bottom:20px;line-height:1.7;">
      Setiap aktivitas dirancang oleh fasilitator berpengalaman dengan mempertimbangkan tujuan pembelajaran, kondisi fisik peserta, dan ketersediaan venue. Berikut aktivitas yang paling sering diminta:
    </p>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:16px;">
      <?php
      $activities = [
        ['🪵','Flying Fox & High Ropes','Membangun keberanian, kepercayaan diri, dan kepercayaan kepada tim pemandu — metafora nyata tentang mengambil risiko terkalkulasi.'],
        ['🔍','Amazing Race / Treasure Hunt','Kompetisi navigasi berbasis tim yang menguji komunikasi, strategi, dan adaptasi rencana saat kondisi berubah.'],
        ['🥁','Drum Circle','Aktivitas kolaboratif berbasis ritme — seluruh peserta bermain perkusi bersama, menghasilkan harmoni dari keberagaman individu.'],
        ['🚣','Arung Jeram (Rafting)','Kerja sama tim dalam kondisi penuh adrenalin. Tersedia di Sungai Progo dan Elo, Magelang (dekat Yogyakarta).'],
        ['🧩','Problem Solving Games','Tantangan fisik dan mental yang hanya bisa diselesaikan dengan koordinasi tim — melatih kepemimpinan situasional dan komunikasi efektif.'],
        ['🔥','Malam Refleksi & Api Unggun','Sesi emosional yang membangun ikatan tim di luar rutinitas kerja — sharing, apresiasi, dan komitmen bersama.'],
        ['🎭','Simulasi Kepemimpinan','Role play skenario manajemen nyata: krisis proyek, konflik tim, negosiasi stakeholder — lalu dianalisis bersama fasilitator.'],
        ['🌱','Corporate Farming','Bercocok tanam bersama — metafora tentang investasi jangka panjang, sabar menunggu hasil, dan merawat dengan konsisten.'],
      ];
      foreach ($activities as $a): ?>
      <div style="background:#fff;border:1px solid #e0e0e0;border-radius:8px;padding:16px;">
        <div style="font-size:1.8rem;margin-bottom:8px;"><?php echo $a[0]; ?></div>
        <div style="font-weight:600;color:#0A4A2E;margin-bottom:6px;font-size:0.9rem;"><?php echo $a[1]; ?></div>
        <p style="color:#555;font-size:0.85rem;line-height:1.5;margin:0;"><?php echo $a[2]; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- UNTUK INSTANSI PEMERINTAH -->
  <section style="margin-bottom:48px;background:#f0f7f3;border-radius:10px;padding:30px;">
    <h2 style="color:#0A4A2E;font-size:1.4rem;margin:0 0 16px;">
      Khusus untuk Instansi Pemerintah &amp; BUMN
    </h2>
    <p style="line-height:1.8;color:#333;margin-bottom:20px;">
      Wahana Totalita memiliki pengalaman panjang melayani instansi pemerintah dan BUMN di wilayah DIY dan sekitarnya. Kami memahami kebutuhan spesifik pengadaan pemerintah — mulai dari mekanisme LPSE, penganggaran di mata anggaran yang tepat, hingga kelengkapan dokumen administrasi.
    </p>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:16px;">
      <?php
      $gov = [
        ['📋','Dokumen Lengkap','SPK, BA pelaksanaan, kuitansi, faktur pajak, laporan kegiatan, dan foto dokumentasi — semua siap kami sediakan.'],
        ['🏛️','LPSE & PADI Terdaftar','Terdaftar sebagai vendor resmi pengadaan langsung. Dapat melalui mekanisme penunjukan langsung di bawah Rp 200 juta.'],
        ['💼','Paket All-in-One','Venue, konsumsi, fasilitator, peralatan, akomodasi, dan transportasi dapat dikemas dalam satu paket harga untuk kemudahan penganggaran.'],
        ['📊','Laporan Evaluasi','Laporan kegiatan lengkap termasuk foto, daftar hadir, evaluasi peserta, dan rekomendasi tindak lanjut — sesuai kebutuhan pelaporan instansi.'],
      ];
      foreach ($gov as $g): ?>
      <div style="background:#fff;border-radius:6px;padding:16px;">
        <div style="font-size:1.6rem;margin-bottom:8px;"><?php echo $g[0]; ?></div>
        <div style="font-weight:600;color:#0A4A2E;margin-bottom:6px;font-size:0.9rem;"><?php echo $g[1]; ?></div>
        <p style="color:#555;font-size:0.85rem;line-height:1.6;margin:0;"><?php echo $g[2]; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- LOKASI -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Pilihan Lokasi di Yogyakarta &amp; Sekitarnya
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(230px,1fr));gap:16px;">
      <?php
      $locations = [
        ['🌋','Lereng Merapi — Kaliurang','Suasana sejuk, aktivitas alam terbuka, view Gunung Merapi. Cocok untuk program alam dan kepemimpinan.'],
        ['🌊','Pantai Selatan — Parangtritis, Baron, Kukup','Aktivitas pantai, outbound pasir, refleksi sore di tepi laut. Kesan mendalam untuk tim.'],
        ['🌾','Pedesaan Sleman & Bantul','Persawahan, perkebunan, suasana pedesaan — cocok untuk corporate farming dan program kebersamaan.'],
        ['⛰️','Kulon Progo — Bukit Menoreh','Trekking, flying fox, dan aktivitas alam bertema petualangan dengan panorama perbukitan.'],
        ['🏨','Hotel & Resort Yogyakarta','Indoor dan outdoor terintegrasi. Tersedia di hotel bintang 3–5 kota Yogyakarta untuk program kombinasi.'],
        ['🚀','Di Luar Yogyakarta','Program tersedia di Bali, Lombok, Bromo, Labuan Bajo, atau destinasi lain sesuai permintaan klien.'],
      ];
      foreach ($locations as $l): ?>
      <div style="background:#fff;border:1px solid #ddd;border-radius:8px;padding:16px;border-top:3px solid #0A4A2E;">
        <div style="font-size:1.8rem;margin-bottom:8px;"><?php echo $l[0]; ?></div>
        <div style="font-weight:600;color:#0A4A2E;margin-bottom:6px;font-size:0.9rem;"><?php echo $l[1]; ?></div>
        <p style="color:#555;font-size:0.85rem;line-height:1.5;margin:0;"><?php echo $l[2]; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- PROSES -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:24px;">
      Alur Kerja — Dari Konsultasi hingga Laporan
    </h2>
    <div style="position:relative;">
      <?php
      $steps = [
        ['1','Konsultasi Kebutuhan','Diskusi tujuan, jumlah peserta, anggaran, dan waktu pelaksanaan. Gratis, tidak mengikat.'],
        ['2','Proposal & Penawaran','Kami kirimkan proposal program lengkap dan penawaran harga dalam 1×24 jam kerja.'],
        ['3','Finalisasi Desain Program','Setelah sepakat, kami rancang rundown detail, aktivitas, dan briefing fasilitator.'],
        ['4','Pelaksanaan','Hari-H: tim fasilitator kami hadir, semua logistik sudah disiapkan. Klien tinggal hadir.'],
        ['5','Laporan Kegiatan','Dalam 3 hari kerja pasca kegiatan: laporan lengkap, foto, daftar hadir, dan evaluasi peserta.'],
      ];
      foreach ($steps as $i => $step): ?>
      <div style="display:flex;gap:20px;margin-bottom:20px;align-items:flex-start;">
        <div style="background:#0A4A2E;color:#fff;width:40px;height:40px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:1rem;flex-shrink:0;"><?php echo $step[0]; ?></div>
        <div style="background:#f9f9f9;border:1px solid #e0e0e0;border-radius:8px;padding:14px 18px;flex:1;">
          <div style="font-weight:600;color:#0A4A2E;margin-bottom:4px;"><?php echo $step[1]; ?></div>
          <div style="color:#555;font-size:0.9rem;line-height:1.6;"><?php echo $step[2]; ?></div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- RELATED -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.4rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Program Pengembangan SDM Terkait
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(210px,1fr));gap:16px;">
      <?php
      $related = [
        ['/keselamatan-kerja/','Pelatihan K3 Umum','Sertifikasi K3 dan pengembangan kompetensi keselamatan kerja'],
        ['/pelatihan-iso/','Pelatihan ISO','Sistem manajemen mutu, lingkungan, dan K3 internasional'],
        ['/smk3/','SMK3 & Audit','Sistem Manajemen K3 nasional — PP 50/2012'],
        ['/pelatihan/','Semua Program','Lihat katalog lengkap pelatihan Wahana Totalita'],
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
      ['Apa perbedaan outbound training dan team building biasa?','Outbound training menggabungkan aktivitas fisik outdoor dengan sesi pembelajaran terstruktur — setiap aktivitas dirancang untuk tujuan pengembangan spesifik. Fasilitator terlatih memimpin debriefing yang menghubungkan pengalaman lapangan dengan konteks kerja nyata. Team building biasa umumnya hanya aktivitas rekreasi tanpa tujuan pembelajaran yang terstruktur.'],
      ['Berapa peserta minimum dan maksimum untuk program outbound?','Program kami dapat mengakomodasi 20 hingga 500+ peserta. Untuk kelompok besar, dibagi menjadi sub-kelompok 8–12 orang per tim dengan fasilitator masing-masing. Hubungi kami untuk proposal sesuai jumlah peserta Anda.'],
      ['Apakah program outbound bisa dilaksanakan di dalam kantor (indoor)?','Ya. Kami menyediakan program indoor team building untuk gedung kantor, aula, atau ballroom hotel. Aktivitas indoor mencakup problem-solving games, simulasi leadership, creative workshop, dan games kolaboratif yang tidak membutuhkan ruang luas.'],
      ['Berapa lama waktu ideal untuk program outbound training?','Setengah hari (4 jam) untuk energizer ringan; satu hari penuh (8 jam) untuk program komprehensif; 2D1N untuk pengembangan intensif; 3D2N untuk leadership development mendalam. Kami akan merekomendasikan durasi yang tepat berdasarkan tujuan dan anggaran Anda.'],
      ['Apakah outbound training bisa dimasukkan ke dalam anggaran instansi pemerintah?','Ya. Program dapat masuk di mata anggaran pengembangan SDM atau pembinaan kepegawaian. Wahana Totalita terdaftar di LPSE dan PADI UMKM — dapat menjadi vendor untuk pengadaan langsung di bawah Rp 200 juta. Dokumen administrasi lengkap tersedia.'],
      ['Lokasi mana yang tersedia untuk outbound training di Yogyakarta?','Lereng Merapi (Kaliurang), Pantai Selatan (Parangtritis, Baron, Kukup), pedesaan Sleman & Bantul, Bukit Menoreh Kulon Progo, hotel & resort kota Yogyakarta, dan destinasi luar kota atas permintaan.'],
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
  <section style="background:linear-gradient(135deg,#0A4A2E,#1a6b42);color:#fff;border-radius:12px;padding:40px;text-align:center;">
    <h2 style="margin:0 0 12px;font-size:1.6rem;">Siap Membangun Tim yang Lebih Kuat?</h2>
    <p style="opacity:0.9;margin:0 0 28px;line-height:1.7;max-width:600px;margin-left:auto;margin-right:auto;">
      Ceritakan kebutuhan Anda — jumlah peserta, tujuan, dan anggaran. Kami kirimkan proposal dan penawaran harga dalam 1×24 jam kerja.
    </p>
    <a href="https://wa.me/6287759151278?text=Halo%2C+saya+ingin+konsultasi+program+outbound+training%2Fteam+building+untuk+instansi%2Fperusahaan+kami.+Mohon+info+program+dan+penawaran+harga."
       target="_blank" rel="noopener"
       style="display:inline-block;background:#C6621C;color:#fff;padding:14px 36px;border-radius:6px;font-weight:700;text-decoration:none;font-size:1.05rem;margin-right:12px;">
      WhatsApp: 0877-5915-1278
    </a>
    <a href="/pelatihan/"
       style="display:inline-block;background:transparent;color:#fff;padding:14px 28px;border-radius:6px;font-weight:600;text-decoration:none;font-size:1rem;border:2px solid rgba(255,255,255,0.6);margin-top:10px;">
      Lihat Semua Program
    </a>
  </section>

</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
</body>
</html>
