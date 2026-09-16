<?php
require_once __DIR__ . '/config.php';
$s = get_all_settings();
// Hub: K3 & Keselamatan Maritim / Pelatihan Kelautan
$canonical = 'https://wahanatotalita.com/pelatihan-kelautan/';
$meta_title = 'Pelatihan K3 & Keselamatan Maritim — Marine Safety Training | Wahana Totalita';
$meta_desc  = 'Pelatihan K3 dan keselamatan maritim: sea survival, marine firefighting, man overboard, keselamatan pelabuhan, dan K3 di lingkungan laut. Untuk pelaut, port worker, dan industri maritim Indonesia.';

$schema = [
  [
    '@context' => 'https://schema.org',
    '@type'    => 'BreadcrumbList',
    'itemListElement' => [
      ['@type'=>'ListItem','position'=>1,'name'=>'Beranda','item'=>'https://wahanatotalita.com/'],
      ['@type'=>'ListItem','position'=>2,'name'=>'Pelatihan','item'=>'https://wahanatotalita.com/pelatihan/'],
      ['@type'=>'ListItem','position'=>3,'name'=>'Pelatihan Keselamatan Maritim','item'=>$canonical],
    ],
  ],
  [
    '@context' => 'https://schema.org',
    '@type'    => 'FAQPage',
    'mainEntity' => [
      [
        '@type' => 'Question',
        'name'  => 'Apa regulasi keselamatan maritim yang berlaku di Indonesia?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Regulasi keselamatan maritim di Indonesia: (1) UU No. 17/2008 tentang Pelayaran — mengatur keselamatan berlayar, pencegahan pencemaran, dan perlindungan lingkungan maritim; (2) Konvensi SOLAS (Safety of Life at Sea) — diadopsi Indonesia melalui IMO, mengatur standar keselamatan kapal internasional; (3) Konvensi STCW (Standards of Training, Certification and Watchkeeping) — standar kompetensi awak kapal internasional; (4) PP No. 51/2002 tentang Perkapalan; (5) Peraturan Menhub PM 70/2013 tentang Pendidikan dan Pelatihan Kepelautan. Selain itu, UU 1/1970 tentang Keselamatan Kerja tetap berlaku untuk semua pekerja di atas kapal dan di pelabuhan.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apa saja bahaya K3 yang unik di lingkungan maritim?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Bahaya K3 spesifik di lingkungan maritim: (1) Bahaya tenggelam (drowning) — risiko tertinggi; man overboard (MOB) adalah insiden fatal jika tidak ditangani dalam 2–3 menit di air dingin; (2) Bahaya kebakaran dan ledakan — kapal mengangkut bahan bakar dan kargo berbahaya, pemadaman kebakaran di atas kapal jauh lebih kompleks dari di darat; (3) Bahaya ergonomi dan stabilitas — dek bergerak, ruang kerja sempit di bawah dek, dan beban berat di ruang terbatas; (4) Bahaya kargo berbahaya (Dangerous Goods) — pengangkutan zat kimia, LPG, BBM; (5) Bahaya terisolasi — jauh dari fasilitas medis saat darurat; (6) Bahaya cuaca ekstrem — badai, ombak tinggi, angin kencang.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apa yang dimaksud dengan Basic Safety Training (BST)?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Basic Safety Training (BST) adalah pelatihan keselamatan dasar wajib bagi awak kapal sesuai Konvensi STCW 1978 yang direvisi. BST mencakup 4 modul utama: (1) Personal Survival Techniques — teknik bertahan hidup di laut, penggunaan life jacket, life raft, dan alat survival; (2) Fire Prevention and Fire Fighting — pencegahan dan pemadaman kebakaran di atas kapal; (3) Elementary First Aid — pertolongan pertama darurat di laut; (4) Personal Safety and Social Responsibilities — prosedur darurat, komunikasi bahaya, dan keselamatan diri. BST adalah syarat wajib bagi semua awak kapal yang berlayar secara internasional.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apakah pelatihan keselamatan maritim hanya untuk pelaut?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Tidak. Pelatihan keselamatan maritim relevan untuk siapa saja yang bekerja di lingkungan laut atau berbatasan dengan laut: pelaut dan ABK, petugas pelabuhan (TKBM, operator crane pelabuhan, stevedore), pekerja di platform offshore dan kapal kerja, personel Basarnas dan SAR laut, petugas patroli laut (TNI-AL, KPLP, KKP), pekerja industri perikanan dan budidaya laut, serta tim HSE perusahaan pelayaran, pertambangan laut, dan energi lepas pantai.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apa perbedaan pelatihan keselamatan maritim dengan pelatihan selam (diving)?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Pelatihan keselamatan maritim berfokus pada keselamatan di atas permukaan air dan di kapal — bertahan hidup di laut, prosedur darurat kapal, pemadam kebakaran kapal, dan penanganan kargo berbahaya. Pelatihan selam (CMAS/NAUI) berfokus pada kompetensi menyelam di bawah permukaan air — teknik scuba, perencanaan penyelaman, fisiologi bawah air, dan keselamatan penyelam. Keduanya berbeda dan masing-masing diperuntukkan bagi audiens berbeda, meskipun ada irisan pada industri offshore dan marine rescue.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apakah pelatihan ini relevan untuk perusahaan pertambangan dan energi yang memiliki operasi laut?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Sangat relevan. Perusahaan pertambangan dan energi yang memiliki operasi laut — platform offshore, kapal tender, operasi loading/unloading di sea terminal — wajib memastikan seluruh personelnya memiliki kompetensi keselamatan maritim dasar. Ini termasuk: orientasi keselamatan laut (sea induction), prosedur evakuasi platform, penggunaan alat keselamatan laut (life jacket, immersion suit, EPIRB), dan prosedur Permit to Work untuk pekerjaan di atas kapal dan platform.'],
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
<section style="background:linear-gradient(135deg,#0A2A4A 0%,#0A4A2E 70%,#0A3A5A 100%);color:#fff;padding:60px 20px 50px;">
  <div style="max-width:900px;margin:0 auto;">
    <nav aria-label="breadcrumb" style="font-size:0.85rem;opacity:0.8;margin-bottom:16px;">
      <a href="/" style="color:#a0d4f5;">Beranda</a> &rsaquo;
      <a href="/pelatihan/" style="color:#a0d4f5;">Pelatihan</a> &rsaquo;
      <span>Keselamatan Maritim</span>
    </nav>
    <h1 style="font-size:clamp(1.6rem,4vw,2.4rem);font-weight:700;margin:0 0 16px;">
      Pelatihan K3 &amp; Keselamatan Maritim
    </h1>
    <p style="font-size:1.05rem;opacity:0.92;max-width:720px;margin:0 0 10px;line-height:1.7;">
      Lingkungan laut dan maritim menghadirkan bahaya yang tidak ada di tempat kerja darat: man overboard, kebakaran kapal di tengah laut, kargo berbahaya, cuaca ekstrem, dan isolasi dari fasilitas medis. Program keselamatan maritim Wahana Totalita membekali pelaut, port worker, dan personel industri laut dengan kompetensi keselamatan yang bisa menyelamatkan nyawa.
    </p>
    <p style="font-size:0.88rem;opacity:0.75;margin:0 0 24px;">
      Regulasi: UU 17/2008 Pelayaran &nbsp;|&nbsp; SOLAS &nbsp;|&nbsp; STCW &nbsp;|&nbsp; UU 1/1970
    </p>
    <a href="https://wa.me/6287759151278?text=Halo%2C+saya+ingin+info+program+pelatihan+keselamatan+maritim+dari+Wahana+Totalita."
       target="_blank" rel="noopener"
       style="display:inline-block;background:#C6621C;color:#fff;padding:14px 32px;border-radius:6px;font-weight:700;text-decoration:none;font-size:1rem;">
      Konsultasi Program
    </a>
  </div>
</section>

<main style="max-width:960px;margin:0 auto;padding:40px 20px 60px;">

  <!-- REGULASI -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Kerangka Regulasi Keselamatan Maritim
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:16px;">
      <?php
      $regs = [
        ['UU No. 17/2008','Pelayaran — mengatur keselamatan berlayar, pencegahan pencemaran laut, dan keselamatan jiwa di atas kapal. Kementerian Perhubungan (Ditjen Hubla) adalah regulator.','#e8f4eb'],
        ['Konvensi SOLAS','Safety of Life at Sea — standar keselamatan kapal internasional: alat keselamatan, pemadam kebakaran, prosedur darurat, radio komunikasi, stabilitas kapal.','#e8f0f7'],
        ['Konvensi STCW','Standards of Training, Certification and Watchkeeping — kompetensi wajib awak kapal, termasuk Basic Safety Training (BST) yang wajib dimiliki semua ABK.','#f7f4e8'],
        ['IMDG Code','International Maritime Dangerous Goods Code — regulasi pengangkutan kargo berbahaya di laut: pengemasan, pelabelan, penanganan darurat.','#f7ece8'],
        ['MLC 2006','Maritime Labour Convention — perlindungan tenaga kerja maritim: jam kerja, keselamatan, kesehatan, dan kondisi kerja di atas kapal.','#e8f4eb'],
        ['UU 1/1970','Keselamatan Kerja — tetap berlaku untuk semua pekerja di kapal dan pelabuhan sebagai regulasi K3 dasar Indonesia.','#e8f0f7'],
      ];
      foreach ($regs as $r): ?>
      <div style="background:<?php echo $r[2]; ?>;border-radius:8px;padding:16px;border-left:4px solid #0A4A2E;">
        <div style="font-weight:700;color:#0A4A2E;margin-bottom:6px;font-size:0.9rem;"><?php echo $r[0]; ?></div>
        <div style="color:#444;font-size:0.87rem;line-height:1.6;"><?php echo $r[1]; ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- BAHAYA MARITIM -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      6 Bahaya Utama K3 di Lingkungan Maritim
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:16px;">
      <?php
      $hazards = [
        ['🌊','Man Overboard (MOB)','Jatuh ke laut adalah bahaya paling fatal di lingkungan maritim. Survival time di air tropis 4–6 jam; di air dingin hanya menit. Prosedur MOB yang benar (melempar lifebuoy, memutar kapal, pencarian) harus dilatih hingga menjadi refleks otomatis.','#0A2A4A'],
        ['🔥','Kebakaran Kapal','Kebakaran di kapal jauh lebih kompleks dari di darat: sumber air terbatas (sea water), ruang tertutup dengan asap tebal, dan tidak ada damkar yang bisa dipanggil. Semua ABK harus kompeten memadamkan api dan mengevakuasi secara mandiri.','#4A0A0A'],
        ['☠️','Kargo Berbahaya (Dangerous Goods)','Kapal kargo mengangkut ribuan jenis zat berbahaya: LPG, bahan kimia, BBM, radioaktif. Kegagalan handling atau insiden bocor/tumpah di tengah laut memerlukan respons yang terlatih khusus.','#2A0A4A'],
        ['⛽','Confined Space di Kapal','Tangki bahan bakar, ruang kargo, bilge, dan duct keel adalah confined space di kapal dengan risiko kekurangan oksigen dan gas beracun. Lebih berbahaya dari confined space di darat karena akses evakuasi lebih sulit.','#0A4A0A'],
        ['🏗️','K3 Bongkar Muat Pelabuhan','Operasi bongkar muat menggunakan crane pelabuhan, forklift, dan reach stacker dengan beban ratusan ton. Risiko: barang jatuh, kapal bergoyang, dan jalur transportasi pelabuhan yang padat.','#4A3A0A'],
        ['🌀','Cuaca Ekstrem & Stabilitas','Badai, angin kencang, dan ombak tinggi mengancam stabilitas kapal. Pekerja di dek terbuka menghadapi risiko tersapu ombak. Overloading dan muatan tidak seimbang dapat menyebabkan kapal miring berbahaya.','#0A3A4A'],
      ];
      foreach ($hazards as $h): ?>
      <div style="background:<?php echo $h[3]; ?>;color:#fff;border-radius:8px;padding:18px;">
        <div style="font-size:1.5rem;margin-bottom:8px;"><?php echo $h[0]; ?></div>
        <div style="font-weight:700;margin-bottom:8px;font-size:0.92rem;"><?php echo $h[1]; ?></div>
        <p style="font-size:0.85rem;line-height:1.6;opacity:0.9;margin:0;"><?php echo $h[2]; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- BST SECTION -->
  <section style="margin-bottom:48px;background:#e8f0f7;border-radius:10px;padding:28px;">
    <h2 style="color:#0A2A4A;font-size:1.4rem;margin:0 0 14px;">Basic Safety Training (BST) — 4 Modul Wajib STCW</h2>
    <p style="color:#333;line-height:1.8;margin:0 0 20px;">
      BST adalah pelatihan keselamatan dasar yang <strong>wajib dimiliki semua awak kapal</strong> sesuai Konvensi STCW. Terdiri dari 4 modul yang saling melengkapi:
    </p>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(210px,1fr));gap:14px;">
      <?php
      $bst = [
        ['Modul 1','Personal Survival Techniques','Bertahan hidup di laut: menggunakan life jacket, naik ke life raft, sinyal distress, teknik survival di air.'],
        ['Modul 2','Fire Prevention & Fire Fighting','Pencegahan kebakaran di kapal, klasifikasi api, teknik pemadaman, menggunakan APAR dan breathing apparatus di kapal.'],
        ['Modul 3','Elementary First Aid','Pertolongan pertama darurat di laut: RJP/BLS, penanganan trauma, penggunaan AED, dan merawat korban hingga bantuan tiba.'],
        ['Modul 4','Personal Safety & Social Responsibilities','Prosedur darurat kapal, komunikasi bahaya, keselamatan diri di lingkungan kapal, dan tanggung jawab sosial ABK.'],
      ];
      foreach ($bst as $b): ?>
      <div style="background:#fff;border-radius:8px;padding:16px;border-top:3px solid #0A2A4A;">
        <div style="font-size:0.75rem;font-weight:700;color:#C6621C;text-transform:uppercase;margin-bottom:4px;"><?php echo $b[0]; ?></div>
        <div style="font-weight:600;color:#0A2A4A;margin-bottom:8px;font-size:0.92rem;"><?php echo $b[1]; ?></div>
        <p style="color:#555;font-size:0.85rem;line-height:1.5;margin:0;"><?php echo $b[2]; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- TARGET PESERTA -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Siapa yang Membutuhkan Pelatihan Keselamatan Maritim?
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:14px;">
      <?php
      $targets = [
        ['⚓','Awak Kapal & ABK','Kewajiban STCW — semua awak kapal yang berlayar secara internasional wajib memiliki sertifikat BST.'],
        ['🏭','Petugas Pelabuhan','TKBM, operator crane, stevedore, dan staf terminal wajib memiliki kompetensi K3 di lingkungan pelabuhan.'],
        ['🛢️','Pekerja Offshore','Personel di platform minyak dan gas lepas pantai — merupakan kelompok dengan risiko keselamatan maritim tertinggi.'],
        ['🐟','Industri Perikanan','Nelayan komersial dan pekerja budidaya laut yang beroperasi di lepas pantai memerlukan pelatihan sea survival.'],
        ['🚢','HSE Perusahaan Pelayaran','Tim HSE, safety officer, dan manajer K3 perusahaan pelayaran, BUMN maritim, dan shipping company.'],
        ['🔬','Riset & Eksplorasi Laut','Tim survei dan riset kelautan, arkeologi bawah air, dan eksplorasi sumber daya laut.'],
      ];
      foreach ($targets as $t): ?>
      <div style="background:#fff;border:1px solid #c8d8e8;border-radius:8px;padding:16px;border-top:3px solid #0A2A4A;">
        <div style="font-size:1.5rem;margin-bottom:8px;"><?php echo $t[0]; ?></div>
        <div style="font-weight:600;color:#0A2A4A;margin-bottom:6px;font-size:0.9rem;"><?php echo $t[1]; ?></div>
        <p style="color:#555;font-size:0.84rem;line-height:1.55;margin:0;"><?php echo $t[2]; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- PROGRAM -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:24px;">
      Program Pelatihan Keselamatan Maritim
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:20px;">
      <?php
      $programs = [
        ['Marine Safety Awareness','Orientasi keselamatan maritim 1 hari untuk personel yang mulai bekerja di lingkungan kapal atau pelabuhan. Bahaya maritim, APD laut, prosedur darurat dasar, dan penggunaan life jacket.'],
        ['Sea Survival & Man Overboard','Teknik bertahan hidup di laut, prosedur MOB, penggunaan life raft dan survival equipment. Praktik di kolam renang (simulasi kondisi di air).'],
        ['Marine Firefighting','Pemadam kebakaran khusus lingkungan kapal: klasifikasi kebakaran kapal, sistem pemadam fix (CO2, FM200), SCBA di kapal, dan koordinasi pemadaman di ruang tertutup.'],
        ['K3 Pelabuhan & Bongkar Muat','K3 untuk TKBM dan operator alat bongkar muat: keselamatan crane pelabuhan, forklift terminal, konveyor, dan prosedur safety di area dermaga.'],
        ['Dangerous Goods & IMDG','Penanganan kargo berbahaya sesuai IMDG Code: klasifikasi DG, pengemasan dan pelabelan, stowage plan, prosedur darurat tumpahan, dan dokumen manifes kargo berbahaya.'],
        ['Offshore Safety Induction','Orientasi keselamatan untuk personel yang pertama kali bekerja di platform offshore: TEMPSC (lifeboat), helideck safety, PTW offshore, dan helicopter egress.'],
      ];
      foreach ($programs as $p): ?>
      <div style="background:#fff;border:1px solid #c8d8e8;border-radius:8px;overflow:hidden;display:flex;flex-direction:column;">
        <div style="background:#0A2A4A;color:#fff;padding:12px 16px;">
          <div style="font-weight:600;font-size:0.93rem;"><?php echo $p[0]; ?></div>
        </div>
        <div style="padding:14px 16px;flex:1;">
          <p style="color:#555;font-size:0.87rem;line-height:1.6;margin:0;"><?php echo $p[1]; ?></p>
        </div>
        <div style="padding:0 16px 16px;">
          <a href="<?php echo 'https://wa.me/6287759151278?text=Halo%2C+saya+ingin+info+program+'.urlencode($p[0]).' untuk personel maritim kami.'; ?>"
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
    <h2 style="color:#0A4A2E;font-size:1.4rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Program Terkait
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(210px,1fr));gap:14px;">
      <?php
      $related = [
        ['/selam/','Pelatihan Selam (CMAS/NAUI)','Diving profesional dan scientific diving — untuk eksplorasi bawah air.'],
        ['/k3-migas/','K3 Minyak & Gas Bumi','K3 untuk industri oil & gas termasuk operasi offshore.'],
        ['/penanggulangan-kebakaran/','Penanggulangan Kebakaran','Pemadam kebakaran darat — fondasi sebelum marine firefighting.'],
        ['/p3k/','Pelatihan P3K','Pertolongan pertama — modul wajib dalam BST.'],
      ];
      foreach ($related as $r): ?>
      <a href="<?php echo $r[0]; ?>" style="display:block;background:#fff;border:1px solid #c8d8e8;border-radius:8px;padding:14px;text-decoration:none;" onmouseover="this.style.boxShadow='0 2px 8px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='none'">
        <div style="font-weight:600;color:#0A2A4A;margin-bottom:4px;font-size:0.92rem;"><?php echo $r[1]; ?></div>
        <div style="color:#555;font-size:0.84rem;"><?php echo $r[2]; ?></div>
      </a>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- FAQ -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:24px;">Pertanyaan yang Sering Diajukan</h2>
    <?php
    $faqs = [
      ['Apa regulasi keselamatan maritim yang berlaku di Indonesia?','UU 17/2008 tentang Pelayaran, Konvensi SOLAS (keselamatan kapal internasional), Konvensi STCW (kompetensi awak kapal), IMDG Code (kargo berbahaya), MLC 2006 (perlindungan tenaga kerja maritim), dan UU 1/1970 sebagai dasar K3 nasional.'],
      ['Apa saja bahaya K3 yang unik di lingkungan maritim?','6 bahaya utama: Man Overboard (MOB), kebakaran kapal di laut lepas, kargo berbahaya (Dangerous Goods), confined space di dalam kapal (tangki, bilge), K3 bongkar muat pelabuhan, dan bahaya cuaca ekstrem/stabilitas kapal.'],
      ['Apa yang dimaksud Basic Safety Training (BST)?','BST adalah pelatihan wajib STCW untuk semua ABK, terdiri dari 4 modul: Personal Survival Techniques, Fire Prevention & Firefighting, Elementary First Aid, dan Personal Safety & Social Responsibilities.'],
      ['Apakah pelatihan keselamatan maritim hanya untuk pelaut?','Tidak. Relevan juga untuk: petugas pelabuhan (TKBM, operator crane), pekerja offshore, industri perikanan, HSE perusahaan pelayaran dan BUMN maritim, serta tim riset kelautan.'],
      ['Apa perbedaan pelatihan keselamatan maritim dengan pelatihan selam?','Keselamatan maritim = keselamatan di atas permukaan air dan di kapal (MOB, kebakaran kapal, kargo berbahaya). Pelatihan selam = kompetensi menyelam di bawah permukaan air (scuba, diving physiology). Keduanya berbeda dan untuk audiens berbeda.'],
      ['Apakah relevan untuk perusahaan pertambangan yang punya operasi laut?','Sangat relevan. Personel yang bekerja di platform offshore, kapal tender, atau sea terminal wajib memiliki kompetensi keselamatan maritim dasar: sea induction, prosedur TEMPSC/lifeboat, dan alat keselamatan laut.'],
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
  <section style="background:linear-gradient(135deg,#0A2A4A,#0A4A2E);color:#fff;border-radius:12px;padding:40px;text-align:center;">
    <h2 style="margin:0 0 12px;font-size:1.6rem;">Siapkan Tim Anda untuk Keselamatan di Laut</h2>
    <p style="opacity:0.9;margin:0 0 28px;line-height:1.7;max-width:600px;margin-left:auto;margin-right:auto;">
      Konsultasikan program keselamatan maritim yang sesuai dengan jenis operasi laut dan profil risiko tim Anda.
    </p>
    <a href="https://wa.me/6287759151278?text=Halo%2C+saya+ingin+info+program+pelatihan+keselamatan+maritim+untuk+tim+kami."
       target="_blank" rel="noopener"
       style="display:inline-block;background:#C6621C;color:#fff;padding:14px 36px;border-radius:6px;font-weight:700;text-decoration:none;font-size:1.05rem;">
      WhatsApp: 0877-5915-1278
    </a>
  </section>

</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>
</html>
