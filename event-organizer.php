<?php
require_once __DIR__ . '/config.php';
$s = get_all_settings();
// Hub: Event Organizer untuk Instansi Pemerintah & BUMN
$canonical = 'https://wahanatotalita.com/event-organizer/';
$meta_title = 'Event Organizer Instansi Pemerintah & BUMN Yogyakarta — MICE & Kedinasan | Wahana Totalita';
$meta_desc  = 'Jasa event organizer profesional untuk seminar, rapat koordinasi, pelantikan, HUT instansi, dan pameran kedinasan. Terdaftar LPSE & PADI UMKM. Yogyakarta. Hubungi: 0877-5915-1278.';

$schema = [
  [
    '@context' => 'https://schema.org',
    '@type'    => 'BreadcrumbList',
    'itemListElement' => [
      ['@type'=>'ListItem','position'=>1,'name'=>'Beranda','item'=>'https://wahanatotalita.com/'],
      ['@type'=>'ListItem','position'=>2,'name'=>'Program','item'=>'https://wahanatotalita.com/pelatihan/'],
      ['@type'=>'ListItem','position'=>3,'name'=>'Event Organizer','item'=>$canonical],
    ],
  ],
  [
    '@context' => 'https://schema.org',
    '@type'    => 'FAQPage',
    'mainEntity' => [
      [
        '@type' => 'Question',
        'name'  => 'Jenis acara kedinasan apa saja yang bisa dikelola Wahana Totalita?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Wahana Totalita mengelola berbagai jenis acara kedinasan dan korporasi: seminar dan workshop, rapat koordinasi (rakor) multi-instansi, pelantikan pejabat, hari ulang tahun (HUT) instansi, pameran dan expo kedinasan, gathering karyawan, halal bihalal, sosialisasi peraturan baru, dan peluncuran program pemerintah. Kami juga mengelola MICE (Meetings, Incentives, Conferences, Exhibitions) untuk skala besar.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apakah Wahana Totalita terdaftar sebagai vendor event organizer resmi pemerintah?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Ya. Wahana Totalita terdaftar di LPSE (Layanan Pengadaan Secara Elektronik) dan PADI UMKM sehingga dapat mengikuti proses pengadaan resmi instansi pemerintah. Untuk jasa event organizer di bawah Rp 200 juta, dapat melalui mekanisme pengadaan langsung. Kami menyediakan dokumen administrasi lengkap: penawaran harga, SPK, kuitansi, faktur pajak, BAST, dan laporan kegiatan.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Berapa kapasitas peserta yang bisa dikelola untuk satu event?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Wahana Totalita dapat mengelola acara dari skala kecil (20–50 peserta, seperti workshop atau rapat koordinasi) hingga acara besar (500–2.000 peserta, seperti HUT instansi atau pameran). Untuk acara sangat besar, kami berkoordinasi dengan venue dan vendor pendukung yang sudah menjadi mitra tetap kami.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apa yang membedakan EO kedinasan dengan event organizer biasa?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'EO kedinasan memiliki kebutuhan khusus yang berbeda dari event komersial: memahami protokol dan tata urutan acara pemerintahan, familiar dengan sistem pengadaan LPSE dan dokumen administrasi SPJ, memiliki legalitas yang memungkinkan masuk sebagai vendor pemerintah, mampu menyediakan faktur pajak resmi, dan terbiasa dengan jadwal yang bisa berubah mendadak akibat dinamika kedinasan. Wahana Totalita memiliki pengalaman panjang dalam semua aspek ini.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apakah bisa memesan EO dengan sistem paket all-in (venue, catering, dekorasi, MC)?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Ya. Kami menyediakan paket all-in yang mencakup: pemilihan dan booking venue, dekorasi sesuai tema, sound system dan lighting, MC profesional (bilingual tersedia), catering atau snack, dokumentasi foto/video, materi presentasi dan backdrop, souvenir peserta, dan laporan kegiatan. Paket all-in memudahkan penganggaran karena satu harga mencakup semua komponen.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Berapa lama waktu persiapan yang dibutuhkan untuk event kedinasan?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Untuk acara skala besar (200+ peserta) idealnya persiapan 1–2 bulan. Untuk acara skala menengah (50–200 peserta) cukup 2–3 minggu. Untuk acara kecil mendadak (di bawah 50 peserta), kami bisa persiapkan dalam 1 minggu. Hubungi kami segera — semakin awal, semakin banyak pilihan venue dan vendor pendukung terbaik yang bisa kami amankan.'],
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
<section style="background:linear-gradient(135deg,#0A4A2E 0%,#1a4a6b 100%);color:#fff;padding:60px 20px 50px;">
  <div style="max-width:900px;margin:0 auto;">
    <nav aria-label="breadcrumb" style="font-size:0.85rem;opacity:0.8;margin-bottom:16px;">
      <a href="/" style="color:#f5c06a;">Beranda</a> &rsaquo;
      <a href="/pelatihan/" style="color:#f5c06a;">Program</a> &rsaquo;
      <span>Event Organizer</span>
    </nav>
    <h1 style="font-size:clamp(1.6rem,4vw,2.4rem);font-weight:700;margin:0 0 16px;">
      Event Organizer Instansi Pemerintah, BUMN &amp; Korporasi
    </h1>
    <p style="font-size:1.1rem;opacity:0.92;max-width:720px;margin:0 0 10px;line-height:1.7;">
      Dari seminar dan rapat koordinasi hingga HUT instansi, pelantikan, dan pameran kedinasan — Wahana Totalita mengelola seluruh rangkaian acara dengan profesionalisme, ketepatan waktu, dan pemahaman mendalam tentang protokol kedinasan.
    </p>
    <p style="font-size:0.92rem;opacity:0.8;margin:0 0 28px;">
      ✅ Terdaftar LPSE &amp; PADI UMKM &nbsp;|&nbsp; ✅ Pengadaan langsung &lt; Rp 200 juta &nbsp;|&nbsp; ✅ Dokumen SPJ lengkap &nbsp;|&nbsp; ✅ Berpengalaman sejak 2012
    </p>
    <a href="https://wa.me/6287759151278?text=Halo%2C+saya+ingin+konsultasi+jasa+event+organizer+untuk+acara+kedinasan%2Fkorporasi+kami.+Mohon+info+dan+penawaran."
       target="_blank" rel="noopener"
       style="display:inline-block;background:#C6621C;color:#fff;padding:14px 32px;border-radius:6px;font-weight:700;text-decoration:none;font-size:1rem;">
      Konsultasi Acara Anda
    </a>
  </div>
</section>

<main style="max-width:960px;margin:0 auto;padding:40px 20px 60px;">

  <!-- JENIS ACARA -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:24px;">
      Jenis Acara yang Kami Kelola
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:20px;">
      <?php
      $event_types = [
        [
          'icon'  => '🎤',
          'title' => 'Seminar & Workshop Kedinasan',
          'color' => '#e8f4eb',
          'items' => [
            'Seminar nasional / regional / lokal',
            'Workshop kebijakan dan regulasi baru',
            'Bimtek (Bimbingan Teknis) instansi',
            'FGD (Focus Group Discussion) multi-pihak',
            'Sosialisasi program pemerintah',
          ],
        ],
        [
          'icon'  => '🏛️',
          'title' => 'Rapat Koordinasi (Rakor)',
          'color' => '#e8f0f7',
          'items' => [
            'Rakor lintas instansi / OPD',
            'Rapat kerja (raker) tahunan',
            'Musrenbang tingkat kota / provinsi',
            'Rapat evaluasi kinerja periodik',
            'Forum OPD dan koordinasi teknis',
          ],
        ],
        [
          'icon'  => '🎖️',
          'title' => 'Upacara & Seremonial Resmi',
          'color' => '#f7f4e8',
          'items' => [
            'Pelantikan pejabat struktural',
            'Hari Ulang Tahun (HUT) instansi',
            'Peringatan hari besar nasional',
            'Wisuda dan penyerahan sertifikat',
            'Peresmian gedung / program baru',
          ],
        ],
        [
          'icon'  => '🎪',
          'title' => 'Pameran & Expo Kedinasan',
          'color' => '#f7ece8',
          'items' => [
            'Pameran pembangunan daerah',
            'Expo produk UMKM binaan instansi',
            'Pameran inovasi layanan publik',
            'Festival budaya dan pariwisata daerah',
            'Bazar amal dan kegiatan sosial instansi',
          ],
        ],
        [
          'icon'  => '🍽️',
          'title' => 'Gathering & Halal Bihalal',
          'color' => '#ede8f7',
          'items' => [
            'Halal bihalal pasca Hari Raya',
            'Gathering akhir tahun karyawan',
            'Farewell party pejabat pensiun',
            'Welcome party pegawai baru',
            'Family gathering instansi',
          ],
        ],
        [
          'icon'  => '🏆',
          'title' => 'MICE (Meetings, Incentives, Conferences, Exhibitions)',
          'color' => '#e8f4eb',
          'items' => [
            'Konferensi nasional / internasional',
            'Incentive trip berbasis prestasi',
            'Pameran dagang dan investasi',
            'Congress dan sidang pleno',
            'Business matching antar instansi',
          ],
        ],
      ];
      foreach ($event_types as $et): ?>
      <div style="background:<?php echo $et['color']; ?>;border-radius:8px;padding:20px;">
        <div style="font-size:1.8rem;margin-bottom:8px;"><?php echo $et['icon']; ?></div>
        <div style="font-weight:600;color:#0A4A2E;margin-bottom:12px;font-size:1rem;"><?php echo $et['title']; ?></div>
        <ul style="margin:0;padding-left:18px;color:#444;font-size:0.88rem;line-height:1.9;">
          <?php foreach ($et['items'] as $item): ?>
          <li><?php echo $item; ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- LAYANAN KOMPREHENSIF -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:24px;">
      Layanan Komprehensif — Satu Vendor, Semua Kebutuhan
    </h2>
    <p style="color:#555;margin-bottom:20px;line-height:1.7;">
      Wahana Totalita menyediakan layanan event organizer end-to-end — dari perencanaan konsep hingga laporan pasca acara. Klien hanya perlu fokus pada konten dan peserta; seluruh teknis kami yang tangani.
    </p>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:16px;">
      <?php
      $services = [
        ['📐','Desain Konsep & Rundown','Merancang konsep acara, tema, tata urutan, dan jadwal detail dari pembukaan hingga penutupan'],
        ['🏟️','Venue Scouting & Booking','Rekomendasi venue sesuai kapasitas dan anggaran — hotel, gedung serbaguna, ballroom, atau outdoor'],
        ['🎨','Dekorasi & Tata Panggung','Backdrop, standing flower, podium, banner, dan dekorasi tematik sesuai identitas instansi'],
        ['🔊','Sound System & Lighting','PA system profesional, wireless mic, LCD proyektor, LED screen, dan tata cahaya sesuai skala acara'],
        ['🎙️','MC Profesional','MC berpengalaman dalam acara kedinasan — memahami protokol, bahasa formal, dan dinamika acara resmi pemerintahan'],
        ['📸','Dokumentasi Foto & Video','Fotografer dan videografer profesional. Highlight video untuk kebutuhan dokumentasi dan media sosial instansi'],
        ['🍱','Catering & Snack','Konsumsi coffee break, makan siang, atau makan malam. Termasuk koordinasi dengan vendor catering terpercaya'],
        ['🎁','Souvenir & Materi Peserta','Tas seminar, name tag, blocknote, ballpoint, materi presentasi, dan souvenir sesuai tema acara'],
        ['📋','Administrasi & Registrasi','Sistem registrasi peserta, daftar hadir, tanda terima, dan koordinasi undangan instansi terkait'],
        ['📄','Laporan Kegiatan','Laporan komprehensif pasca acara: foto dokumentasi, daftar hadir, notulen, dan evaluasi kegiatan untuk keperluan SPJ'],
      ];
      foreach ($services as $s): ?>
      <div style="background:#fff;border:1px solid #e0e0e0;border-radius:8px;padding:16px;display:flex;gap:14px;align-items:flex-start;">
        <div style="font-size:1.8rem;flex-shrink:0;"><?php echo $s[0]; ?></div>
        <div>
          <div style="font-weight:600;color:#0A4A2E;margin-bottom:4px;font-size:0.9rem;"><?php echo $s[1]; ?></div>
          <div style="color:#555;font-size:0.85rem;line-height:1.5;"><?php echo $s[2]; ?></div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- PROTOKOL KEDINASAN -->
  <section style="margin-bottom:48px;background:#f0f7f3;border-radius:10px;padding:30px;">
    <h2 style="color:#0A4A2E;font-size:1.4rem;margin:0 0 16px;">
      Kami Memahami Protokol Kedinasan
    </h2>
    <p style="line-height:1.8;color:#333;margin-bottom:20px;">
      Acara kedinasan pemerintah memiliki kompleksitas unik yang berbeda dari event komersial biasa. Salah satu MC yang tidak memahami protokol, urutan tamu VVIP yang keliru, atau format laporan yang tidak sesuai standar SPJ — bisa menjadi masalah serius. Wahana Totalita memiliki pengalaman panjang mengelola acara kedinasan di lingkungan pemerintahan Yogyakarta dan memahami nuansa-nuansa ini:
    </p>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(230px,1fr));gap:16px;">
      <?php
      $protocol = [
        ['Tata Urutan Acara','Pembukaan resmi, laporan, sambutan berurutan sesuai hierarki jabatan, penandatanganan, dan penutupan dengan aturan yang benar'],
        ['Penyebutan Gelar & Jabatan','MC terlatih menyebut gelar, pangkat, dan jabatan tamu undangan dengan benar dan lengkap sesuai standar kedinasan'],
        ['Tempat Duduk VVIP','Pengaturan kursi tamu kehormatan, posisi bendera, backdrop, dan kelengkapan protokol visual sesuai peraturan keprotokolan'],
        ['Dokumen SPJ Lengkap','Laporan kegiatan, daftar hadir, dokumentasi foto, notulen, dan semua dokumen yang dibutuhkan untuk pertanggungjawaban anggaran'],
      ];
      foreach ($protocol as $p): ?>
      <div style="background:#fff;border-radius:6px;padding:16px;">
        <div style="font-weight:600;color:#0A4A2E;margin-bottom:6px;font-size:0.9rem;"><?php echo $p[0]; ?></div>
        <p style="color:#555;font-size:0.85rem;line-height:1.6;margin:0;"><?php echo $p[1]; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- PENGADAAN PEMERINTAH -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Kemudahan Pengadaan — LPSE &amp; Pengadaan Langsung
    </h2>
    <div style="overflow-x:auto;">
      <table style="width:100%;border-collapse:collapse;font-size:0.92rem;">
        <thead>
          <tr style="background:#0A4A2E;color:#fff;">
            <th style="padding:12px 16px;text-align:left;">Kebutuhan Instansi</th>
            <th style="padding:12px 16px;text-align:left;">Yang Wahana Totalita Sediakan</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $proc = [
            ['Vendor terdaftar sistem e-procurement','Terdaftar di LPSE dan PADI UMKM — siap masuk sebagai vendor resmi'],
            ['Pengadaan langsung &lt; Rp 200 juta','Dapat ditunjuk langsung tanpa tender kompetitif untuk paket di bawah ambang batas'],
            ['Surat Penawaran Harga formal','Penawaran resmi berkop surat perusahaan dengan rincian RAB yang detail dan transparan'],
            ['SPK dan dokumen kontrak','Penandatanganan SPK sesuai format standar pemerintahan'],
            ['Faktur pajak (PKP)','Faktur pajak resmi untuk keperluan pelaporan keuangan dan SPJ instansi'],
            ['BAST (Berita Acara Serah Terima)','BAST ditandatangani setelah acara selesai — syarat pencairan pembayaran akhir'],
            ['Laporan kegiatan formal','Laporan tertulis lengkap dengan foto, daftar hadir, dan narasi kegiatan'],
          ];
          foreach ($proc as $i => $row):
            $bg = $i%2===0?'#fff':'#f5f5f5';
          ?>
          <tr style="background:<?php echo $bg; ?>;">
            <td style="padding:10px 16px;border-bottom:1px solid #eee;color:#333;"><?php echo $row[0]; ?></td>
            <td style="padding:10px 16px;border-bottom:1px solid #eee;color:#0A4A2E;font-weight:500;"><?php echo $row[1]; ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </section>

  <!-- ALUR KERJA -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:24px;">
      Alur Kerja — Dari Brief hingga Laporan
    </h2>
    <?php
    $steps = [
      ['1','Brief Acara','Diskusikan jenis acara, tanggal, jumlah peserta, anggaran, dan tujuan kegiatan. Kami dengarkan dan catat semua kebutuhan.'],
      ['2','Proposal & Penawaran','Dalam 1×24 jam: proposal konsep acara, rundown tentatif, pilihan venue, dan penawaran harga terperinci.'],
      ['3','Finalisasi Konsep','Revisi proposal sesuai masukan — konsep acara, dekorasi, susunan acara, dan konfirmasi vendor pendukung.'],
      ['4','Persiapan Teknis','2 minggu hingga H-1: booking venue, konfirmasi semua vendor, persiapan materi, gladi bersih (jika diperlukan).'],
      ['5','Pelaksanaan Acara','Hari-H: tim lapangan kami hadir dari H-3 jam untuk setup. On-site coordinator memastikan seluruh rundown berjalan.'],
      ['6','Laporan & Dokumen SPJ','Dalam 3–5 hari kerja: laporan kegiatan lengkap, foto, daftar hadir, notulen, BAST — siap untuk pelaporan keuangan.'],
    ];
    foreach ($steps as $step): ?>
    <div style="display:flex;gap:20px;margin-bottom:18px;align-items:flex-start;">
      <div style="background:#0A4A2E;color:#fff;width:40px;height:40px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:1rem;flex-shrink:0;"><?php echo $step[0]; ?></div>
      <div style="background:#f9f9f9;border:1px solid #e0e0e0;border-radius:8px;padding:14px 18px;flex:1;">
        <div style="font-weight:600;color:#0A4A2E;margin-bottom:4px;"><?php echo $step[1]; ?></div>
        <div style="color:#555;font-size:0.9rem;line-height:1.6;"><?php echo $step[2]; ?></div>
      </div>
    </div>
    <?php endforeach; ?>
  </section>

  <!-- RELATED -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.4rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Program Terkait untuk Instansi &amp; Korporasi
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(210px,1fr));gap:16px;">
      <?php
      $related = [
        ['/outbound/','Outbound Training','Team building dan pengembangan SDM di alam terbuka'],
        ['/wisata-karyawan/','Wisata Karyawan','Paket perjalanan tahunan untuk instansi dan BUMN'],
        ['/keselamatan-kerja/','Pelatihan K3','Sertifikasi K3 untuk karyawan dan perusahaan'],
        ['/pelatihan/','Semua Program','Katalog lengkap pelatihan dan jasa Wahana Totalita'],
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
      ['Jenis acara kedinasan apa saja yang bisa dikelola Wahana Totalita?','Seminar dan workshop, rapat koordinasi (rakor) multi-instansi, pelantikan pejabat, HUT instansi, pameran kedinasan, gathering karyawan, halal bihalal, sosialisasi peraturan, dan MICE skala besar. Kami juga mengelola acara gabungan (misalnya seminar + outbound + makan malam gala dinner).'],
      ['Apakah Wahana Totalita terdaftar sebagai vendor event organizer resmi pemerintah?','Ya. Kami terdaftar di LPSE dan PADI UMKM — dapat mengikuti pengadaan langsung untuk nilai di bawah Rp 200 juta. Dokumen administrasi lengkap tersedia: penawaran, SPK, kuitansi, faktur pajak, BAST, dan laporan kegiatan.'],
      ['Berapa kapasitas peserta yang bisa dikelola untuk satu event?','Dari 20 peserta (workshop kecil) hingga 2.000+ peserta (HUT instansi besar atau pameran). Untuk acara sangat besar, kami koordinasikan dengan venue dan vendor pendukung yang sudah menjadi mitra tetap.'],
      ['Apa yang membedakan EO kedinasan dengan event organizer biasa?','EO kedinasan membutuhkan pemahaman: protokol dan tata urutan acara pemerintahan, sistem pengadaan LPSE dan dokumen SPJ, penyebutan gelar dan jabatan yang benar, serta kemampuan beradaptasi dengan jadwal yang bisa berubah mendadak. Wahana Totalita berpengalaman dalam semua aspek ini sejak 2012.'],
      ['Apakah bisa memesan EO dengan sistem paket all-in?','Ya. Paket all-in mencakup: venue, dekorasi, sound system, MC, catering, dokumentasi, souvenir, administrasi peserta, dan laporan kegiatan. Satu harga, satu vendor, tanpa repot koordinasi terpisah.'],
      ['Berapa lama waktu persiapan yang dibutuhkan?','Acara besar (200+ peserta): 1–2 bulan. Acara menengah (50–200 peserta): 2–3 minggu. Acara kecil mendadak (&lt;50 peserta): 1 minggu. Semakin awal menghubungi kami, semakin banyak pilihan venue dan vendor terbaik yang bisa kami amankan.'],
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
    <h2 style="margin:0 0 12px;font-size:1.6rem;">Percayakan Acara Anda kepada Kami</h2>
    <p style="opacity:0.9;margin:0 0 28px;line-height:1.7;max-width:600px;margin-left:auto;margin-right:auto;">
      Dari konsep hingga laporan SPJ — Wahana Totalita siap menjadi mitra penyelenggaraan acara instansi Anda. Hubungi kami untuk konsultasi dan penawaran harga tanpa biaya.
    </p>
    <a href="https://wa.me/6287759151278?text=Halo%2C+saya+ingin+konsultasi+jasa+event+organizer+untuk+acara+instansi+kami.+Mohon+info+lebih+lanjut."
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
