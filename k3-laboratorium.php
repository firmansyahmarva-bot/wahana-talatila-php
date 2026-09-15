<?php
require_once __DIR__ . '/config.php';
$s = get_all_settings();
// Hub: K3 Laboratorium
$canonical = 'https://wahanatotalita.com/k3-laboratorium/';
$meta_title = 'K3 Laboratorium — Keselamatan Kerja Lab Penelitian, RS & Universitas | Wahana Totalita';
$meta_desc  = 'Panduan K3 laboratorium: bahaya kimia, biologis, dan radiasi di lab. Regulasi laboratorium Indonesia, pengelolaan B3, biosafety level, dan program pelatihan K3 lab untuk peneliti dan analis.';

$schema = [
  [
    '@context' => 'https://schema.org',
    '@type'    => 'BreadcrumbList',
    'itemListElement' => [
      ['@type'=>'ListItem','position'=>1,'name'=>'Beranda','item'=>'https://wahanatotalita.com/'],
      ['@type'=>'ListItem','position'=>2,'name'=>'Pelatihan','item'=>'https://wahanatotalita.com/pelatihan/'],
      ['@type'=>'ListItem','position'=>3,'name'=>'K3 Laboratorium','item'=>$canonical],
    ],
  ],
  [
    '@context' => 'https://schema.org',
    '@type'    => 'FAQPage',
    'mainEntity' => [
      [
        '@type' => 'Question',
        'name'  => 'Apa regulasi K3 yang berlaku untuk laboratorium di Indonesia?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Regulasi K3 laboratorium di Indonesia: (1) UU No. 1/1970 tentang Keselamatan Kerja — berlaku untuk semua tempat kerja termasuk lab; (2) Permenkes No. 37/2012 tentang Penyelenggaraan Laboratorium Pusat Kesehatan Masyarakat — standar keamanan lab kesehatan; (3) Permenristekdikti No. 44/2015 tentang Standar Nasional Pendidikan Tinggi — keselamatan lab universitas; (4) SNI ISO/IEC 17025 — standar kompetensi lab pengujian dan kalibrasi; (5) Permenkes No. 7/2019 tentang Kesehatan Lingkungan — pengelolaan limbah B3 lab; (6) Perka BAPETEN No. 4/2013 — proteksi radiasi untuk lab nuklir.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apa itu Biosafety Level (BSL) dan mengapa penting untuk laboratorium?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Biosafety Level (BSL) adalah sistem klasifikasi tingkat keamanan yang diperlukan untuk bekerja dengan agen biologis berbahaya. Ada 4 level: BSL-1 = agen tidak berbahaya bagi manusia sehat (E.coli non-patogen) — lab standar, APD dasar; BSL-2 = agen berpotensi bahaya ringan (Staphylococcus, Hepatitis B) — lab dengan biosafety cabinet kelas II; BSL-3 = agen menyebabkan penyakit serius yang ada pengobatannya (Mycobacterium tuberculosis, SARS-CoV-2 varian lama) — lab bertekanan negatif, akses terbatas; BSL-4 = agen penyakit mematikan tanpa pengobatan (Ebola, Marburg) — fasilitas terisolasi penuh. Sebagian besar lab klinik dan universitas bekerja di BSL-1 dan BSL-2.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'APD apa saja yang wajib digunakan di laboratorium?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'APD standar laboratorium bervariasi tergantung jenis lab dan bahan yang digunakan: (1) Jas lab (lab coat) — wajib di semua lab, melindungi kulit dan pakaian dari percikan; (2) Sarung tangan — lateks, nitril (tahan kimia), atau kriogenik (tahan suhu -200°C) tergantung bahan; (3) Kacamata pengaman/goggles — saat menggunakan bahan kimia, asam, basa; (4) Masker — minimal masker bedah untuk lab biologi, N95 untuk agen aerosol; (5) Alas kaki tertutup — wajib, sepatu terbuka dilarang; (6) Face shield — saat berisiko percikan bahan kimia atau biologis; (7) Apron — untuk pekerjaan dengan asam pekat atau bahan berbahaya volume besar.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Bagaimana cara membuang limbah laboratorium yang benar?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Pembuangan limbah laboratorium harus mengikuti kategori: (1) Limbah kimia — tidak boleh dibuang ke saluran biasa; asam dan basa harus dinetralkan atau dikumpulkan terpisah untuk pengolahan khusus; (2) Limbah biologis infeksius — disterilisasi dengan autoklaf atau dimasukkan ke wadah limbah infeksius (kantong kuning) untuk diinsinerasi; (3) Benda tajam — harus di sharps container khusus; (4) Limbah radioaktif — ditangani sesuai regulasi BAPETEN dan dikumpulkan oleh unit khusus; (5) Limbah umum — kertas, kemasan non-kontaminan — dapat dibuang sebagai sampah biasa. Dokumen catatan pengelolaan limbah B3 wajib dijaga selama 5 tahun.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apakah peneliti dan analis laboratorium wajib mendapat pelatihan K3?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Ya. UU 1/1970 mewajibkan pengusaha memberikan pelatihan K3 kepada semua pekerja — termasuk peneliti, analis, dan teknisi laboratorium. Untuk lab yang terakreditasi SNI ISO/IEC 17025, pelatihan K3 adalah persyaratan kompetensi yang harus terdokumentasi. Untuk lab universitas, Permenristekdikti 44/2015 mengatur bahwa institusi pendidikan tinggi wajib menyediakan lingkungan belajar yang aman — termasuk pelatihan K3 bagi mahasiswa yang bekerja di laboratorium.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apa yang harus dilakukan jika terjadi tumpahan bahan kimia di laboratorium?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Prosedur tumpahan bahan kimia di lab (Chemical Spill Response): (1) Jangan panik — segera informasikan orang di sekitar dan singkirkan dari area tumpahan; (2) Identifikasi bahan — cek label atau MSDS sebelum bertindak; (3) Kenakan APD yang sesuai sebelum membersihkan; (4) Untuk tumpahan kecil asam/basa — netralkan dengan sodium bikarbonat (untuk asam) atau asam sitrat (untuk basa), lap dengan absorbent; (5) Untuk tumpahan besar atau bahan sangat berbahaya — evakuasi area, hubungi petugas K3 dan supervisor; (6) Limbah hasil pembersihan tumpahan adalah limbah B3 — jangan buang ke saluran biasa; (7) Laporkan insiden dan isi formulir laporan kejadian.'],
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
<section style="background:linear-gradient(135deg,#1a0a3a 0%,#0A4A2E 100%);color:#fff;padding:60px 20px 50px;">
  <div style="max-width:900px;margin:0 auto;">
    <nav aria-label="breadcrumb" style="font-size:0.85rem;opacity:0.8;margin-bottom:16px;">
      <a href="/" style="color:#c0a0f5;">Beranda</a> &rsaquo;
      <a href="/pelatihan/" style="color:#c0a0f5;">Pelatihan</a> &rsaquo;
      <span>K3 Laboratorium</span>
    </nav>
    <h1 style="font-size:clamp(1.6rem,4vw,2.4rem);font-weight:700;margin:0 0 16px;">
      K3 Laboratorium — Keselamatan Kerja di Lab Penelitian, Klinik &amp; Universitas
    </h1>
    <p style="font-size:1.05rem;opacity:0.92;max-width:720px;margin:0 0 10px;line-height:1.7;">
      Laboratorium menyimpan kombinasi bahaya yang jarang ada di tempat kerja lain: bahan kimia korosif, agen biologis infeksius, radiasi, gas bertekanan tinggi, dan kriogenik — semua dalam satu ruang kerja yang sering kali berukuran kecil. K3 laboratorium adalah disiplin tersendiri yang membutuhkan pemahaman teknis mendalam tentang sifat setiap bahaya yang ada.
    </p>
    <p style="font-size:0.88rem;opacity:0.75;margin:0 0 24px;">Regulasi: UU 1/1970 &nbsp;|&nbsp; SNI ISO/IEC 17025 &nbsp;|&nbsp; Permenkes 7/2019 &nbsp;|&nbsp; Perka BAPETEN 4/2013</p>
    <a href="https://wa.me/628122969435?text=Halo%2C+saya+ingin+konsultasi+program+K3+Laboratorium+dari+Wahana+Totalita."
       target="_blank" rel="noopener"
       style="display:inline-block;background:#C6621C;color:#fff;padding:14px 32px;border-radius:6px;font-weight:700;text-decoration:none;font-size:1rem;">
      Konsultasi Program K3 Lab
    </a>
  </div>
</section>

<main style="max-width:960px;margin:0 auto;padding:40px 20px 60px;">

  <!-- JENIS LAB -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Jenis Laboratorium dan Profil Bahaya K3-nya
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:16px;">
      <?php
      $labs = [
        ['🔬','Lab Kimia (Universitas & Industri)','Bahaya dominan: bahan kimia berbahaya (asam, basa, pelarut organik, reagen reaktif). Risiko: percikan asam ke mata/kulit, inhalasi uap/gas, kebakaran pelarut mudah terbakar, ledakan. APD wajib: jas lab, goggles, sarung tangan nitril, lemari asam (fume hood).','#1a0a3a'],
        ['🧫','Lab Biologi & Mikrobiologi','Bahaya dominan: agen biologis (bakteri, virus, jamur, parasit). Risiko: infeksi melalui aerosol, kontak langsung, atau needlestick. Pengendalian: biosafety cabinet (BSC), APD sesuai BSL, prosedur dekontaminasi ketat, dan autoklaf untuk sterilisasi.','#0A4A2E'],
        ['☢️','Lab Radiologi & Nuklir','Bahaya: radiasi pengion dari sumber radioaktif, sinar-X, isotop radiofarmaka. Risiko: paparan kronis meningkatkan kanker, efek genetik. Wajib: dosimeter pribadi, ruang berpelindung Pb, paparan ALARA (As Low As Reasonably Achievable).','#4a1a0a'],
        ['🧊','Lab Kriogenik','Bahaya: cairan kriogenik (nitrogen cair -196°C, helium cair -269°C) — menyebabkan luka bakar dingin (frostbite) dalam hitungan detik. Risiko tambahan: ledakan dewar yang retak, dan penggantian oksigen oleh nitrogen yang menyebabkan asfiksia.','#0a2a4a'],
        ['⚗️','Lab Analitik & Kalibrasi','Bahaya: bahan kimia standar, gas referensi bertekanan tinggi, dan peralatan bertegangan tinggi. Ergonomi: posisi statis berjam-jam di depan instrumen, repetitive strain dari pipetting volume besar.','#2a4a0a'],
        ['🏥','Lab Klinik & Patologi','Bahaya biologis dari sampel darah, urin, jaringan pasien. Risiko NSI (needlestick injury) dari pengambilan dan pemrosesan sampel. Regulasi khusus: Permenkes 43/2013 tentang cara penyelenggaraan lab klinik yang baik (Good Laboratory Practice).','#4a0a2a'],
      ];
      foreach ($labs as $l): ?>
      <div style="background:<?php echo $l[3]; ?>;color:#fff;border-radius:8px;padding:18px;">
        <div style="font-size:1.5rem;margin-bottom:8px;"><?php echo $l[0]; ?></div>
        <div style="font-weight:700;margin-bottom:8px;font-size:0.93rem;"><?php echo $l[1]; ?></div>
        <p style="font-size:0.84rem;line-height:1.6;opacity:0.9;margin:0;"><?php echo $l[2]; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- BIOSAFETY LEVEL -->
  <section style="margin-bottom:48px;background:#f5f0ff;border-radius:10px;padding:28px;">
    <h2 style="color:#1a0a3a;font-size:1.4rem;margin:0 0 14px;">Sistem Biosafety Level (BSL) — Klasifikasi Lab Biologi</h2>
    <p style="color:#333;line-height:1.8;margin:0 0 20px;font-size:0.92rem;">BSL adalah standar WHO/CDC yang mengklasifikasikan tingkat keamanan berdasarkan bahaya agen biologis yang digunakan.</p>
    <div style="overflow-x:auto;">
      <table style="width:100%;border-collapse:collapse;font-size:0.88rem;background:#fff;border-radius:8px;overflow:hidden;">
        <thead>
          <tr style="background:#1a0a3a;color:#fff;">
            <th style="padding:10px 14px;text-align:left;">Level</th>
            <th style="padding:10px 14px;text-align:left;">Agen Contoh</th>
            <th style="padding:10px 14px;text-align:left;">Bahaya</th>
            <th style="padding:10px 14px;text-align:left;">Persyaratan Minimum</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $bsl = [
            ['BSL-1','E.coli non-patogen, S. cerevisiae','Sangat rendah — tidak menyebabkan penyakit pada manusia sehat','Jas lab, sarung tangan, cuci tangan, no mouth pipetting'],
            ['BSL-2','Staphylococcus, Hepatitis B, Salmonella','Sedang — dapat menyebabkan penyakit, ada pengobatan','BSL-1 + Biosafety Cabinet Kelas II, akses terbatas, autoklaf'],
            ['BSL-3','M. tuberculosis, SARS-CoV-2, West Nile virus','Tinggi — penyakit serius, berpotensi menyebar di udara','BSL-2 + ruang bertekanan negatif, HEPA filter, APD lengkap, prosedur ketat'],
            ['BSL-4','Ebola, Marburg, Lassa fever','Sangat tinggi — mematikan, tidak ada pengobatan','Fasilitas terisolasi penuh, positive pressure suit, shower dekontaminasi'],
          ];
          foreach ($bsl as $i => $b):
            $bg = $i%2===0?'#fff':'#f9f9f9';
          ?>
          <tr style="background:<?php echo $bg; ?>;">
            <td style="padding:9px 14px;border-bottom:1px solid #eee;font-weight:700;color:#1a0a3a;"><?php echo $b[0]; ?></td>
            <td style="padding:9px 14px;border-bottom:1px solid #eee;color:#444;"><?php echo $b[1]; ?></td>
            <td style="padding:9px 14px;border-bottom:1px solid #eee;color:#444;"><?php echo $b[2]; ?></td>
            <td style="padding:9px 14px;border-bottom:1px solid #eee;color:#444;font-size:0.83rem;"><?php echo $b[3]; ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </section>

  <!-- APD LAB -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      APD Standar Laboratorium — Pilih yang Tepat
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:14px;">
      <?php
      $apd = [
        ['🥼','Jas Lab (Lab Coat)','Wajib di semua lab. Lengan panjang, berbahan katun atau anti-statik untuk lab listrik. Harus dilepas sebelum keluar lab dan tidak dibawa ke kantin.','#fff'],
        ['🧤','Sarung Tangan','Lateks/nitril: bahan kimia umum. Kriogenik: nitrogen cair dan bahan suhu sangat rendah. Tahan panas: saat mengambil material dari oven/autoklaf. Jangan pernah menyentuh wajah saat memakai sarung tangan.','#fff'],
        ['🥽','Goggles / Kacamata Pengaman','Wajib saat menggunakan asam, basa, atau pelarut. Kacamata biasa tidak cukup — percikan bisa masuk dari sisi. Gunakan goggles yang menutup rapat sekeliling mata.','#fff'],
        ['😷','Masker','Masker bedah: biologi BSL-1 dan BSL-2. Masker N95/FFP2: agen aerosol, tuberkulosis. Respirator kimia dengan cartridge: uap pelarut organik dan asam volatil.','#fff'],
        ['🛡️','Face Shield','Saat risiko percikan besar: membuka wadah bertekanan, mereaksikan asam pekat. Digunakan di atas goggles, bukan pengganti goggles.','#fff'],
        ['👞','Alas Kaki','Sepatu tertutup penuh wajib — sandal, open-toe, dan high heels dilarang di semua laboratorium. Sepatu anti-slip direkomendasikan untuk lab basah.','#fff'],
      ];
      foreach ($apd as $a): ?>
      <div style="background:#fff;border:1px solid #d0c0f0;border-radius:8px;padding:16px;border-left:4px solid #1a0a3a;">
        <div style="font-size:1.4rem;margin-bottom:8px;"><?php echo $a[0]; ?></div>
        <div style="font-weight:600;color:#1a0a3a;margin-bottom:6px;font-size:0.9rem;"><?php echo $a[1]; ?></div>
        <p style="color:#555;font-size:0.84rem;line-height:1.6;margin:0;"><?php echo $a[2]; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- PROGRAM -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:24px;">
      Program Pelatihan K3 Laboratorium
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:20px;">
      <?php
      $programs = [
        ['K3 Laboratorium Dasar','Orientasi K3 lab untuk peneliti baru, mahasiswa, dan analis: identifikasi bahaya lab, penggunaan APD yang benar, MSDS/SDS, prosedur darurat tumpahan, dan pengelolaan limbah B3.'],
        ['Biosafety di Laboratorium Biologi','Klasifikasi BSL, teknik kerja aman di biosafety cabinet, dekontaminasi dan sterilisasi, penanganan jarum dan benda tajam, dan prosedur insiden pajanan biologis.'],
        ['Pengelolaan B3 & Limbah Lab','Identifikasi B3 dari label GHS, penyimpanan bahan kimia yang aman (inkompatibilitas), prosedur tumpahan kimia, dan pembuangan limbah lab sesuai regulasi Permenkes 7/2019.'],
        ['Radiasi Keselamatan Dasar (Lab Radiologi)','Dasar proteksi radiasi: prinsip ALARA, penggunaan dosimeter, zona radiasi, prosedur kerja aman di lab radiologi, dan pelaporan insiden sesuai BAPETEN.'],
        ['Audit & Inspeksi K3 Lab','Untuk laboran senior dan lab manager: penyusunan SOP K3 lab, inspeksi keselamatan periodik, penilaian risiko lab, dan persiapan akreditasi ISO/IEC 17025.'],
        ['Chemical Safety & SDS Interpretation','Membaca dan mengaplikasikan SDS (Safety Data Sheet) sesuai standar GHS: identifikasi bahaya, APD yang sesuai, penyimpanan, penanganan tumpahan, dan disposal.'],
      ];
      foreach ($programs as $p): ?>
      <div style="background:#fff;border:1px solid #d0c0f0;border-radius:8px;overflow:hidden;display:flex;flex-direction:column;">
        <div style="background:#1a0a3a;color:#fff;padding:12px 16px;">
          <div style="font-weight:600;font-size:0.93rem;"><?php echo $p[0]; ?></div>
        </div>
        <div style="padding:14px 16px;flex:1;">
          <p style="color:#555;font-size:0.87rem;line-height:1.6;margin:0;"><?php echo $p[1]; ?></p>
        </div>
        <div style="padding:0 16px 16px;">
          <a href="<?php echo 'https://wa.me/628122969435?text=Halo%2C+saya+ingin+info+program+'.urlencode($p[0]).' untuk laboratorium kami.'; ?>"
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
        ['/k3-kimia/','K3 Industri Kimia','K3 di pabrik kimia dan petrokimia — bahaya skala industri.'],
        ['/k3-rumah-sakit/','K3 Rumah Sakit','Lab klinik dan patologi dalam konteks RS — keselamatan tenaga kesehatan.'],
        ['/higiene-industri/','Higiene Industri & Hiperkes','Pengukuran NAB faktor fisika-kimia di lingkungan kerja lab.'],
        ['/k3-lingkungan/','K3 Lingkungan & AMDAL','Pengelolaan dampak lingkungan dari limbah laboratorium.'],
      ];
      foreach ($related as $r): ?>
      <a href="<?php echo $r[0]; ?>" style="display:block;background:#fff;border:1px solid #d0c0f0;border-radius:8px;padding:14px;text-decoration:none;" onmouseover="this.style.boxShadow='0 2px 8px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='none'">
        <div style="font-weight:600;color:#1a0a3a;margin-bottom:4px;font-size:0.92rem;"><?php echo $r[1]; ?></div>
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
      ['Apa regulasi K3 yang berlaku untuk laboratorium di Indonesia?','UU 1/1970 (keselamatan kerja semua tempat kerja), Permenkes 37/2012 (lab puskesmas), Permenristekdikti 44/2015 (lab universitas), SNI ISO/IEC 17025 (lab pengujian/kalibrasi), Permenkes 7/2019 (limbah B3 lab), dan Perka BAPETEN 4/2013 (lab radiologi).'],
      ['Apa itu Biosafety Level (BSL) dan mengapa penting?','BSL adalah klasifikasi 4 level keamanan untuk lab biologi berdasarkan bahaya agen yang digunakan. BSL-1: agen tidak berbahaya. BSL-2: lab klinik dan mikrobiologi umum. BSL-3: agen aerosol serius (TB, SARS-CoV-2). BSL-4: agen mematikan tanpa pengobatan. Setiap level menentukan persyaratan fasilitas dan prosedur yang wajib dipenuhi.'],
      ['APD apa saja yang wajib digunakan di laboratorium?','APD wajib: jas lab lengan panjang, sarung tangan (sesuaikan jenis dengan bahan), goggles/kacamata pengaman, masker (sesuaikan dengan agen), alas kaki tertutup penuh. Tambahan situasional: face shield, apron, respirator kimia, sarung tangan kriogenik.'],
      ['Bagaimana cara membuang limbah laboratorium yang benar?','Limbah kimia: dikumpulkan terpisah per kategori (asam, basa, pelarut), tidak boleh ke saluran umum. Limbah biologis: diautoklaf atau ke kantong limbah infeksius (kuning). Benda tajam: sharps container. Radioaktif: dikumpulkan unit khusus. Umum non-kontaminan: sampah biasa.'],
      ['Apakah peneliti dan analis laboratorium wajib mendapat pelatihan K3?','Ya. UU 1/1970 mewajibkan pelatihan K3 untuk semua pekerja. Untuk lab terakreditasi ISO/IEC 17025, pelatihan K3 adalah persyaratan kompetensi yang harus terdokumentasi.'],
      ['Apa yang harus dilakukan jika terjadi tumpahan bahan kimia di laboratorium?','Prosedur: (1) Informasikan orang di sekitar dan singkirkan dari area; (2) Identifikasi bahan dari label/SDS; (3) Kenakan APD sesuai; (4) Netralkan dan serap tumpahan (asam → soda kue, basa → asam sitrat); (5) Kumpulkan sebagai limbah B3; (6) Laporkan insiden dan isi formulir kejadian.'],
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
  <section style="background:linear-gradient(135deg,#1a0a3a,#0A4A2E);color:#fff;border-radius:12px;padding:40px;text-align:center;">
    <h2 style="margin:0 0 12px;font-size:1.6rem;">Pastikan Laboratorium Anda Aman dan Taat Regulasi</h2>
    <p style="opacity:0.9;margin:0 0 28px;line-height:1.7;max-width:600px;margin-left:auto;margin-right:auto;">
      Dari orientasi K3 untuk peneliti baru hingga audit keselamatan dan penyusunan SOP laboratorium — Wahana Totalita siap mendampingi institusi Anda.
    </p>
    <a href="https://wa.me/628122969435?text=Halo%2C+saya+ingin+konsultasi+program+K3+Laboratorium+untuk+institusi+kami."
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
