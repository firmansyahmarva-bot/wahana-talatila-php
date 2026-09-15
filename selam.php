<?php
require_once __DIR__ . '/config.php';
$s = get_all_settings();
// Hub: Pelatihan Selam & Scuba Diving
$canonical = 'https://wahanatotalita.com/selam/';
$meta_title = 'Pelatihan Selam & Scuba Diving — CMAS, NAUI & Commercial Diving | Wahana Totalita';
$meta_desc  = 'Pelatihan selam profesional dan rekreasional: CMAS, NAUI, Scientific Diving, Commercial Diving. Untuk oil & gas, penyelamatan, riset bawah laut. Yogyakarta. Hubungi: 0812-2969-435.';

$schema = [
  [
    '@context' => 'https://schema.org',
    '@type'    => 'BreadcrumbList',
    'itemListElement' => [
      ['@type'=>'ListItem','position'=>1,'name'=>'Beranda','item'=>'https://wahanatotalita.com/'],
      ['@type'=>'ListItem','position'=>2,'name'=>'Pelatihan','item'=>'https://wahanatotalita.com/pelatihan/'],
      ['@type'=>'ListItem','position'=>3,'name'=>'Pelatihan Selam','item'=>$canonical],
    ],
  ],
  [
    '@context' => 'https://schema.org',
    '@type'    => 'FAQPage',
    'mainEntity' => [
      [
        '@type' => 'Question',
        'name'  => 'Apa perbedaan selam rekreasional dan selam komersial (commercial diving)?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Selam rekreasional dilakukan untuk hobi atau olahraga, dengan kedalaman umumnya tidak melebihi 40 meter dan menggunakan sirkuit terbuka (open circuit). Sertifikasinya melalui POSSI/CMAS, NAUI, atau PADI. Selam komersial adalah kegiatan penyelaman dalam rangka pekerjaan — inspeksi pipa bawah laut, perawatan offshore platform, konstruksi pelabuhan, atau SAR. Selam komersial memiliki regulasi K3 tersendiri, peralatan khusus, dan sertifikasi yang berbeda dari selam rekreasional.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apakah ada persyaratan kesehatan untuk mengikuti pelatihan selam?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Ya. Sebelum mengikuti pelatihan selam, peserta wajib melakukan medical check-up selam yang mencakup: pemeriksaan paru-paru (tidak ada riwayat pneumotoraks spontan), jantung (EKG normal), telinga dan sinus (tidak ada gangguan yang menghalangi ekualisasi), dan tidak memiliki kondisi yang dikontraindikasikan untuk menyelam seperti epilepsi, diabetes tidak terkontrol, atau asma parah. Sertifikat layak selam dari dokter berwenang diperlukan sebelum pelatihan dimulai.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Berapa kedalaman maksimal untuk penyelam bersertifikat CMAS atau NAUI?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Batasan kedalaman bergantung pada level sertifikasi: CMAS/NAUI Open Water (level 1) — maksimal 20 meter; CMAS/NAUI Advanced (level 2) — maksimal 40 meter; CMAS/NAUI Divemaster (level 3) — hingga 40 meter dengan pengawasan; instruktur dan penyelam teknis dapat melebihi 40 meter dengan sertifikasi khusus dan gas campuran (trimix). Untuk penyelam komersial, kedalaman diatur oleh regulasi tersendiri dan membutuhkan sertifikasi commercial diver.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apakah pelatihan selam Wahana Totalita diakui untuk keperluan industri oil & gas?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Wahana Totalita menyediakan pelatihan selam yang mencakup aspek K3 untuk keperluan industri termasuk oil & gas. Untuk penyelam komersial yang bekerja di platform lepas pantai, sertifikasi IMCA (International Marine Contractors Association) atau ADCI (Association of Diving Contractors International) biasanya menjadi standar yang diminta kontraktor internasional. Hubungi kami untuk konsultasi program yang sesuai dengan kebutuhan industri Anda.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apa itu Scientific Diving dan siapa yang membutuhkannya?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Scientific Diving adalah penyelaman yang dilakukan dalam rangka riset atau survei ilmiah — penelitian terumbu karang, biota laut, arkeologi bawah air, survei lingkungan perairan, atau pemantauan pipa bawah laut. Dibutuhkan oleh: peneliti LIPI/BRIN, mahasiswa kelautan dan biologi laut, tim AMDAL untuk proyek pesisir, dan konsultan lingkungan perairan. Sertifikasi scientific diving memiliki persyaratan protokol keselamatan yang lebih ketat dari selam rekreasional.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Berapa lama waktu yang dibutuhkan untuk mendapatkan sertifikat selam dasar?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Program Open Water Diver (level 1/CMAS* atau NAUI Scuba Diver) membutuhkan waktu: 2–3 hari teori dan latihan kolam renang, ditambah 4 penyelaman terbuka (open water dives) di laut atau danau. Total waktu efektif sekitar 4–7 hari tergantung kondisi cuaca dan ketersediaan lokasi penyelaman. Setelah lulus, peserta menerima kartu selam (C-card) yang diakui secara internasional.'],
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
<section style="background:linear-gradient(135deg,#0A3A5A 0%,#0A4A2E 60%,#1a6b42 100%);color:#fff;padding:60px 20px 50px;">
  <div style="max-width:900px;margin:0 auto;">
    <nav aria-label="breadcrumb" style="font-size:0.85rem;opacity:0.8;margin-bottom:16px;">
      <a href="/" style="color:#f5c06a;">Beranda</a> &rsaquo;
      <a href="/pelatihan/" style="color:#f5c06a;">Pelatihan</a> &rsaquo;
      <span>Pelatihan Selam</span>
    </nav>
    <h1 style="font-size:clamp(1.6rem,4vw,2.4rem);font-weight:700;margin:0 0 16px;">
      Pelatihan Selam &amp; Scuba Diving — CMAS, NAUI &amp; Commercial Diving
    </h1>
    <p style="font-size:1.1rem;opacity:0.92;max-width:720px;margin:0 0 28px;line-height:1.7;">
      Dari selam rekreasional hingga commercial diving untuk industri oil &amp; gas, maritim, dan riset kelautan. Wahana Totalita menyediakan pelatihan selam bersertifikat internasional dengan instruktur berpengalaman dan standar keselamatan tertinggi.
    </p>
    <a href="https://wa.me/628122969435?text=Halo%2C+saya+ingin+info+program+pelatihan+selam+(CMAS%2FNAUI%2FCommercial+Diving).+Mohon+info+jadwal+dan+biaya."
       target="_blank" rel="noopener"
       style="display:inline-block;background:#C6621C;color:#fff;padding:14px 32px;border-radius:6px;font-weight:700;text-decoration:none;font-size:1rem;">
      Tanya Info Pelatihan Selam
    </a>
  </div>
</section>

<main style="max-width:960px;margin:0 auto;padding:40px 20px 60px;">

  <!-- MENGAPA SELAM PENTING -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Mengapa Pelatihan Selam Bersertifikat Penting?
    </h2>
    <p style="line-height:1.8;color:#333;margin-bottom:16px;">
      Menyelam tanpa sertifikasi yang valid bukan hanya berbahaya — di banyak konteks profesional dan industri, ini juga ilegal. Di Indonesia, penyelam yang bekerja di lingkungan industri (offshore platform, konstruksi pelabuhan, inspeksi pipa, SAR) wajib memiliki sertifikasi yang diakui. Bahkan untuk selam rekreasional, sertifikasi adalah syarat mutlak untuk menyewa peralatan dan mengikuti penyelaman di hampir seluruh resort dan dive center di dunia.
    </p>
    <p style="line-height:1.8;color:#333;">
      Indonesia adalah negara kepulauan dengan garis pantai terpanjang kedua di dunia — kebutuhan tenaga selam terlatih sangat tinggi, mulai dari industri kelautan, pertambangan lepas pantai, riset lingkungan, hingga pariwisata bahari. Sertifikasi selam yang tepat membuka peluang karir dan operasional yang tidak bisa diakses tanpanya.
    </p>
  </section>

  <!-- JALUR SERTIFIKASI -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:24px;">
      Jalur Sertifikasi Selam — Dari Pemula hingga Profesional
    </h2>

    <!-- Selam Rekreasional -->
    <div style="margin-bottom:32px;">
      <h3 style="color:#0A4A2E;font-size:1.2rem;background:#f0f7f3;padding:12px 16px;border-radius:6px;margin:0 0 16px;">
        🤿 Selam Rekreasional — CMAS &amp; NAUI
      </h3>
      <p style="line-height:1.8;color:#333;margin-bottom:16px;">
        CMAS (Confédération Mondiale des Activités Subaquatiques) adalah badan selam internasional tertua yang memiliki hubungan resmi dengan UNESCO. POSSI (Persatuan Olahraga Selam Seluruh Indonesia) adalah anggota CMAS di Indonesia. NAUI (National Association of Underwater Instructors) adalah badan sertifikasi selam internasional terkemuka dengan standar pengajaran tinggi.
      </p>
      <div style="overflow-x:auto;">
        <table style="width:100%;border-collapse:collapse;font-size:0.92rem;">
          <thead>
            <tr style="background:#0A4A2E;color:#fff;">
              <th style="padding:10px 14px;text-align:left;">Level</th>
              <th style="padding:10px 14px;text-align:left;">CMAS</th>
              <th style="padding:10px 14px;text-align:left;">NAUI Setara</th>
              <th style="padding:10px 14px;text-align:left;">Kedalaman Maks</th>
              <th style="padding:10px 14px;text-align:left;">Durasi Pelatihan</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $levels = [
              ['Pemula','CMAS 1 Bintang (*)','NAUI Scuba Diver','20 meter','4–7 hari'],
              ['Menengah','CMAS 2 Bintang (**)','NAUI Advanced Scuba Diver','40 meter','3–5 hari (setelah level 1)'],
              ['Mahir','CMAS 3 Bintang (***)','NAUI Divemaster','40 meter + supervisi','5–7 hari (setelah level 2)'],
              ['Instruktur','CMAS Instruktur','NAUI Instructor','Tidak terbatas','Program khusus + ujian'],
            ];
            foreach ($levels as $i => $lv):
              $bg = $i%2===0?'#fff':'#f5f5f5';
            ?>
            <tr style="background:<?php echo $bg; ?>;">
              <td style="padding:9px 14px;border-bottom:1px solid #eee;font-weight:600;color:#0A4A2E;"><?php echo $lv[0]; ?></td>
              <td style="padding:9px 14px;border-bottom:1px solid #eee;"><?php echo $lv[1]; ?></td>
              <td style="padding:9px 14px;border-bottom:1px solid #eee;"><?php echo $lv[2]; ?></td>
              <td style="padding:9px 14px;border-bottom:1px solid #eee;"><?php echo $lv[3]; ?></td>
              <td style="padding:9px 14px;border-bottom:1px solid #eee;"><?php echo $lv[4]; ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Selam Profesional -->
    <div style="margin-bottom:32px;">
      <h3 style="color:#0A4A2E;font-size:1.2rem;background:#f0f7f3;padding:12px 16px;border-radius:6px;margin:0 0 16px;">
        🏗️ Commercial Diving — Selam Profesional Industri
      </h3>
      <p style="line-height:1.8;color:#333;margin-bottom:16px;">
        Commercial diving (selam komersial) berbeda fundamental dari selam rekreasional. Penyelam komersial bekerja di lingkungan berisiko tinggi — platform minyak lepas pantai, konstruksi dermaga, inspeksi dan pemeliharaan infrastruktur bawah air — dengan durasi kerja, kedalaman, dan tekanan yang melampaui standar rekreasional.
      </p>
      <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:16px;">
        <?php
        $commercial = [
          ['Inshore/Nearshore Diver','Penyelaman di perairan dangkal (&lt;30m): pelabuhan, dermaga, sungai, danau. Inspeksi lambung kapal, pembersihan propeler, perbaikan konstruksi bawah air.'],
          ['Offshore Diver','Penyelaman di laut lepas termasuk platform minyak &amp; gas. Sertifikasi IMCA atau ADCI menjadi standar minimum untuk kontraktor internasional.'],
          ['Saturation Diver','Penyelaman sangat dalam (100m+) menggunakan teknik saturasi — tinggal di dalam sistem ruang bertekanan selama beberapa hari. Spesialisasi tertinggi dan terbayar terbaik dalam dunia selam komersial.'],
          ['Dive Supervisor','Mengawasi operasi penyelaman dari permukaan, memastikan prosedur keselamatan, mengelola tim penyelam dan peralatan. Tidak harus menyelam aktif.'],
        ];
        foreach ($commercial as $c): ?>
        <div style="background:#fff;border:1px solid #ddd;border-radius:8px;padding:16px;border-left:4px solid #C6621C;">
          <div style="font-weight:600;color:#0A4A2E;margin-bottom:8px;font-size:0.95rem;"><?php echo $c[0]; ?></div>
          <p style="color:#555;font-size:0.88rem;line-height:1.6;margin:0;"><?php echo $c[1]; ?></p>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Scientific Diving -->
    <div>
      <h3 style="color:#0A4A2E;font-size:1.2rem;background:#f0f7f3;padding:12px 16px;border-radius:6px;margin:0 0 16px;">
        🔬 Scientific Diving — Selam untuk Riset &amp; Lingkungan
      </h3>
      <p style="line-height:1.8;color:#333;margin-bottom:16px;">
        Scientific diving adalah penyelaman yang dilakukan dalam rangka penelitian atau survei ilmiah. Digunakan oleh: peneliti BRIN/LIPI untuk studi ekosistem terumbu karang dan biota laut, tim AMDAL untuk proyek pesisir dan lepas pantai yang memerlukan data bawah laut, konsultan lingkungan yang melakukan pemantauan kualitas perairan, serta arkeolog bawah air.
      </p>
      <div style="background:#f0f7f3;border-radius:8px;padding:20px;">
        <div style="font-weight:600;color:#0A4A2E;margin-bottom:12px;">Cakupan program Scientific Diving:</div>
        <ul style="margin:0;padding-left:20px;color:#444;line-height:2;">
          <li>Protokol keselamatan scientific diving (standar lebih ketat dari rekreasional)</li>
          <li>Teknik pengambilan sampel dan dokumentasi bawah air</li>
          <li>Penggunaan peralatan riset bawah laut: kamera, video, transek, kuadrat</li>
          <li>Pencatatan data di bawah air (slate, underwater writing tools)</li>
          <li>Foto dan video bawah air untuk dokumentasi ilmiah</li>
          <li>Protokol transek terumbu karang (Reef Check, Manta Tow)</li>
          <li>Manajemen dekompresi dan batas paparan penyelaman berulang</li>
        </ul>
      </div>
    </div>
  </section>

  <!-- KESELAMATAN SELAM -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      K3 dalam Kegiatan Selam — Protokol Keselamatan Wajib
    </h2>
    <p style="line-height:1.8;color:#333;margin-bottom:20px;">
      Selam adalah kegiatan berisiko tinggi yang membutuhkan disiplin protokol keselamatan yang ketat. Kecelakaan selam — dari barotrauma hingga decompression sickness (DCS) — hampir selalu dapat dicegah dengan penerapan prosedur yang benar.
    </p>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(270px,1fr));gap:16px;">
      <?php
      $safety = [
        [
          'icon' => '🩺',
          'title'=> 'Medical Fitness Check',
          'desc' => 'Pemeriksaan medis selam wajib sebelum pelatihan. Paru-paru, jantung, telinga, sinus, dan kondisi umum harus dinyatakan layak selam oleh dokter berwenang. Beberapa kondisi kontraindikasi absolut: epilepsi, pneumotoraks spontan, asma parah tidak terkontrol.',
        ],
        [
          'icon' => '📋',
          'title'=> 'Dive Planning & Dive Tables',
          'desc' => 'Setiap penyelaman harus direncanakan — kedalaman maksimal, waktu bawah (bottom time), interval permukaan, dan batas nitrogen. Penggunaan dive computer atau tabel dekompresi (NOAA, US Navy) wajib untuk mencegah DCS.',
        ],
        [
          'icon' => '🤝',
          'title'=> 'Buddy System',
          'desc' => 'Selam tidak pernah dilakukan sendirian. Sistem buddy (pasangan selam) adalah protokol keselamatan dasar — setiap penyelam bertanggung jawab memantau pasangannya dan siap memberikan pertolongan pertama bawah air.',
        ],
        [
          'icon' => '🔧',
          'title'=> 'Pre-Dive Equipment Check',
          'desc' => 'BWRAF atau "Begin With Review And Friend" — prosedur pengecekan peralatan sebelum masuk air: Buoyancy (BCD), Weights (pemberat), Releases (rilis), Air (pasokan udara), Final (pemeriksaan akhir bersama buddy).',
        ],
        [
          'icon' => '🆘',
          'title'=> 'Emergency Procedures',
          'desc' => 'Setiap penyelam harus hafal: prosedur naik darurat (emergency ascent), penanganan kehabisan udara, tindakan pertama DCS (oksigen 100% dan evakuasi ke ruang hiperbarik), serta lokasi ruang hiperbarik terdekat.',
        ],
        [
          'icon' => '⏱️',
          'title'=> 'Surface Interval & Repetitive Dives',
          'desc' => 'Penyelaman berulang dalam satu hari membutuhkan interval permukaan yang cukup untuk melepas nitrogen dari jaringan tubuh. Mengabaikan interval permukaan adalah penyebab utama DCS pada penyelam rekreasional.',
        ],
      ];
      foreach ($safety as $s): ?>
      <div style="background:#fff;border:1px solid #e0e0e0;border-radius:8px;padding:18px;">
        <div style="font-size:1.8rem;margin-bottom:8px;"><?php echo $s['icon']; ?></div>
        <div style="font-weight:600;color:#0A4A2E;margin-bottom:8px;"><?php echo $s['title']; ?></div>
        <p style="color:#555;font-size:0.88rem;line-height:1.6;margin:0;"><?php echo $s['desc']; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- PERSYARATAN -->
  <section style="margin-bottom:48px;background:#f0f7f3;border-radius:10px;padding:30px;">
    <h2 style="color:#0A4A2E;font-size:1.4rem;margin:0 0 20px;">
      Persyaratan Peserta Pelatihan Selam
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:20px;">
      <?php
      $reqs = [
        ['Usia Minimum','17 tahun untuk program penuh (CMAS 1*/NAUI). Peserta 12–16 tahun dapat mengikuti program junior dengan pendampingan orang tua/wali.'],
        ['Kemampuan Berenang','Mampu berenang minimal 200 meter tanpa alat bantu dan bertahan di air selama 10 menit. Bukan berarti harus perenang mahir — cukup nyaman di air.'],
        ['Kondisi Kesehatan','Surat keterangan layak selam dari dokter. Tidak memiliki kondisi kontraindikasi: epilepsi, penyakit jantung tidak terkontrol, pneumotoraks spontan, asma parah.'],
        ['Dokumen','KTP/paspor, pas foto 3×4 (4 lembar), surat keterangan dokter, dan formulir pendaftaran yang diisi lengkap.'],
      ];
      foreach ($reqs as $r): ?>
      <div style="background:#fff;border-radius:6px;padding:16px;">
        <div style="font-weight:600;color:#0A4A2E;margin-bottom:8px;"><?php echo $r[0]; ?></div>
        <p style="color:#555;font-size:0.9rem;line-height:1.6;margin:0;"><?php echo $r[1]; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- PROGRAM CARDS -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:24px;">
      Program Pelatihan Selam Wahana Totalita
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:20px;">
      <?php
      $programs = [
        ['CMAS 1 Bintang (Open Water)','Selam rekreasional level dasar. Sertifikat diakui internasional. Termasuk 4 open water dives.','4–7 hari'],
        ['CMAS 2 Bintang (Advanced)','Level menengah — kedalaman hingga 40m, navigasi bawah air, penyelaman malam. Prasyarat: CMAS 1*.','3–5 hari'],
        ['CMAS 3 Bintang (Divemaster)','Level mahir — manajemen kelompok selam, rescue, pengawasan penyelaman. Prasyarat: CMAS 2**.','5–7 hari'],
        ['Scientific Diving','Pelatihan selam untuk keperluan riset dan survei lingkungan. Termasuk teknik pengambilan data bawah air.','Kustom'],
        ['Commercial Diving Awareness','Pengenalan selam komersial — prosedur, peralatan, regulasi K3 industri. Untuk oil & gas, maritim.','3 hari'],
        ['Rescue Diver','Teknik penyelamatan penyelam dalam kesulitan, penanganan darurat bawah air, prosedur evakuasi.','3–5 hari'],
      ];
      foreach ($programs as $p):
        $wa = 'Halo%2C+saya+ingin+info+program+pelatihan+' . urlencode($p[0]) . '.+Mohon+info+jadwal+dan+biaya.';
      ?>
      <div style="background:#fff;border:1px solid #ddd;border-radius:8px;overflow:hidden;display:flex;flex-direction:column;">
        <div style="background:linear-gradient(135deg,#0A3A5A,#0A4A2E);color:#fff;padding:14px 16px;">
          <div style="font-weight:600;font-size:0.95rem;"><?php echo $p[0]; ?></div>
        </div>
        <div style="padding:14px 16px;flex:1;">
          <p style="color:#555;font-size:0.88rem;line-height:1.6;margin:0 0 10px;"><?php echo $p[1]; ?></p>
          <div style="font-size:0.85rem;color:#555;">⏱️ Durasi: <strong><?php echo $p[2]; ?></strong></div>
        </div>
        <div style="padding:0 16px 16px;">
          <a href="https://wa.me/628122969435?text=<?php echo $wa; ?>"
             target="_blank" rel="noopener"
             style="display:block;text-align:center;background:#C6621C;color:#fff;padding:10px;border-radius:5px;text-decoration:none;font-weight:600;font-size:0.9rem;">
            Tanya Jadwal &amp; Harga
          </a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- SIAPA YANG MEMBUTUHKAN -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Siapa yang Membutuhkan Pelatihan Selam Profesional?
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px;">
      <?php
      $users = [
        ['🛢️','Oil & Gas','Inspektor pipa, welder bawah air, operator ROV, platform maintenance'],
        ['⚓','Maritim & Pelabuhan','Inspeksi lambung kapal, konstruksi dermaga, pengerukan, salvage'],
        ['🔬','Riset & AMDAL','BRIN/LIPI, konsultan lingkungan, monitoring ekosistem perairan'],
        ['🪖','TNI AL & Basarnas','Penyelam tempur, tim SAR, penyelamatan underwater'],
        ['🐠','Pariwisata Bahari','Dive guide, dive instructor, resort diving operations'],
        ['🎓','Mahasiswa Kelautan','Program studi kelautan, biologi laut, teknik perkapalan'],
      ];
      foreach ($users as $u): ?>
      <div style="background:#fff;border:1px solid #ddd;border-radius:8px;padding:16px;text-align:center;">
        <div style="font-size:2rem;margin-bottom:8px;"><?php echo $u[0]; ?></div>
        <div style="font-weight:600;color:#0A4A2E;margin-bottom:6px;font-size:0.9rem;"><?php echo $u[1]; ?></div>
        <div style="color:#666;font-size:0.82rem;line-height:1.5;"><?php echo $u[2]; ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- RELATED -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.4rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Program Terkait
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(210px,1fr));gap:16px;">
      <?php
      $related = [
        ['/k3-migas/','K3 Minyak & Gas','Sertifikasi K3 untuk industri migas termasuk offshore'],
        ['/k3-ketinggian/','K3 Ketinggian','Bekerja di ketinggian — regulasi dan sertifikasi'],
        ['/p3k/','Pelatihan P3K','Pertolongan pertama termasuk untuk keadaan darurat diving'],
        ['/keselamatan-kerja/','K3 Umum','Sertifikasi Ahli K3 Umum Kemnaker RI'],
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
      ['Apa perbedaan selam rekreasional dan selam komersial (commercial diving)?','Selam rekreasional dilakukan untuk hobi atau olahraga, dengan kedalaman umumnya tidak melebihi 40 meter. Sertifikasinya melalui POSSI/CMAS atau NAUI. Selam komersial adalah kegiatan penyelaman dalam rangka pekerjaan — inspeksi pipa, konstruksi offshore, SAR. Selam komersial memiliki regulasi K3 tersendiri, peralatan khusus, dan sertifikasi yang berbeda dari selam rekreasional.'],
      ['Apakah ada persyaratan kesehatan untuk mengikuti pelatihan selam?','Ya. Peserta wajib melakukan medical check-up selam: pemeriksaan paru-paru, jantung, telinga, dan sinus. Beberapa kondisi kontraindikasi absolut: epilepsi, pneumotoraks spontan, asma parah tidak terkontrol, dan diabetes yang tidak terkontrol. Sertifikat layak selam dari dokter diperlukan sebelum pelatihan.'],
      ['Berapa kedalaman maksimal untuk penyelam bersertifikat CMAS atau NAUI?','CMAS/NAUI Open Water (level 1): maksimal 20 meter. CMAS/NAUI Advanced (level 2): maksimal 40 meter. CMAS/NAUI Divemaster (level 3): hingga 40 meter dengan pengawasan. Untuk kedalaman lebih dari 40 meter diperlukan sertifikasi selam teknis (technical diving) dengan gas campuran.'],
      ['Apakah pelatihan selam Wahana Totalita diakui untuk keperluan industri oil & gas?','Wahana Totalita menyediakan pelatihan selam yang mencakup aspek K3 industri termasuk oil & gas. Untuk penyelam komersial di platform lepas pantai internasional, sertifikasi IMCA atau ADCI biasanya menjadi standar tambahan yang diminta kontraktor. Hubungi kami untuk konsultasi program yang sesuai.'],
      ['Apa itu Scientific Diving dan siapa yang membutuhkannya?','Scientific Diving adalah penyelaman untuk riset atau survei ilmiah — penelitian terumbu karang, biota laut, arkeologi bawah air, survei lingkungan perairan. Dibutuhkan oleh peneliti BRIN/LIPI, mahasiswa kelautan, tim AMDAL untuk proyek pesisir, dan konsultan lingkungan perairan.'],
      ['Berapa lama waktu yang dibutuhkan untuk mendapatkan sertifikat selam dasar?','Program Open Water Diver (CMAS 1*/NAUI Scuba Diver) membutuhkan 2–3 hari teori dan latihan kolam, ditambah 4 penyelaman terbuka di laut atau danau. Total sekitar 4–7 hari tergantung kondisi cuaca. Setelah lulus, peserta menerima C-card (kartu selam) yang diakui secara internasional.'],
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
  <section style="background:linear-gradient(135deg,#0A3A5A,#0A4A2E);color:#fff;border-radius:12px;padding:40px;text-align:center;">
    <h2 style="margin:0 0 12px;font-size:1.6rem;">Siap Memulai Perjalanan Selam Anda?</h2>
    <p style="opacity:0.9;margin:0 0 28px;line-height:1.7;max-width:600px;margin-left:auto;margin-right:auto;">
      Dari CMAS Open Water hingga Commercial Diving — Wahana Totalita siap mendampingi dengan instruktur berpengalaman, standar keselamatan internasional, dan sertifikat yang diakui secara global.
    </p>
    <a href="https://wa.me/628122969435?text=Halo%2C+saya+ingin+info+program+pelatihan+selam+di+Wahana+Totalita.+Mohon+info+jadwal+dan+biaya."
       target="_blank" rel="noopener"
       style="display:inline-block;background:#C6621C;color:#fff;padding:14px 36px;border-radius:6px;font-weight:700;text-decoration:none;font-size:1.05rem;">
      WhatsApp: 0812-2969-435
    </a>
  </section>

</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
</body>
</html>
