<?php
require_once __DIR__ . '/config.php';
$s = get_all_settings();
// Hub: Paket Wisata Karyawan & Instansi
$canonical = 'https://wahanatotalita.com/wisata-karyawan/';
$meta_title = 'Paket Wisata Karyawan & Instansi Yogyakarta — BUMN, Dinas & Korporasi | Wahana Totalita';
$meta_desc  = 'Paket wisata tahunan karyawan untuk instansi pemerintah, BUMN, dan korporasi. Yogyakarta & destinasi seluruh Indonesia. Terdaftar LPSE & PADI UMKM. Hubungi: 0877-5915-1278.';

$schema = [
  [
    '@context' => 'https://schema.org',
    '@type'    => 'BreadcrumbList',
    'itemListElement' => [
      ['@type'=>'ListItem','position'=>1,'name'=>'Beranda','item'=>'https://wahanatotalita.com/'],
      ['@type'=>'ListItem','position'=>2,'name'=>'Program','item'=>'https://wahanatotalita.com/pelatihan/'],
      ['@type'=>'ListItem','position'=>3,'name'=>'Wisata Karyawan','item'=>$canonical],
    ],
  ],
  [
    '@context' => 'https://schema.org',
    '@type'    => 'FAQPage',
    'mainEntity' => [
      [
        '@type' => 'Question',
        'name'  => 'Apakah paket wisata karyawan bisa dimasukkan ke dalam anggaran instansi pemerintah?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Ya. Kegiatan wisata karyawan instansi pemerintah umumnya masuk dalam mata anggaran kegiatan pembinaan kepegawaian, peningkatan kesejahteraan pegawai, atau kegiatan motivasi dan penguatan tim. Wahana Totalita terdaftar di LPSE dan PADI UMKM sehingga dapat menjadi vendor resmi pengadaan langsung di bawah Rp 200 juta. Kami menyediakan dokumen administrasi lengkap: proposal, SPK, kuitansi, faktur pajak, dan laporan kegiatan.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Berapa peserta minimum untuk paket wisata karyawan instansi?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Paket wisata karyawan Wahana Totalita tersedia mulai dari 20 peserta. Untuk rombongan besar (100–500 orang), kami menyediakan armada bus, koordinator lapangan per kelompok, dan sistem check-in yang terorganisir. Tidak ada batas maksimum peserta — kami pernah mengelola perjalanan instansi hingga 500+ peserta dalam satu rangkaian kegiatan.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Destinasi mana yang paling populer untuk wisata karyawan dari Yogyakarta?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Dari Yogyakarta, destinasi paling populer untuk wisata karyawan: (1) Bali — destinasi favorit untuk perjalanan 3–5 hari dengan kombinasi budaya dan pantai; (2) Bromo & Ijen — untuk instansi yang menginginkan pengalaman alam pegunungan; (3) Lombok & Gili — pantai dan snorkeling, alternatif Bali yang lebih tenang; (4) Labuan Bajo & Komodo — untuk perjalanan premium; (5) Domestik Yogyakarta — untuk kegiatan setengah atau satu hari tanpa perjalanan jauh.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apakah wisata karyawan bisa dikombinasikan dengan outbound atau pelatihan?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Ya, dan ini justru paling direkomendasikan. Program kombinasi wisata + outbound sangat populer di kalangan instansi — peserta mendapatkan pengalaman rekreasi sekaligus pengembangan kompetensi. Formatnya fleksibel: hari pertama outbound/team building, hari berikutnya wisata; atau sebaliknya. Wahana Totalita mengelola keduanya secara terintegrasi sehingga klien hanya perlu berurusan dengan satu vendor.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apa saja yang termasuk dalam paket wisata karyawan Wahana Totalita?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Komponen paket dapat disesuaikan, namun umumnya mencakup: transportasi (bus pariwisata AC, tiket pesawat jika diperlukan), akomodasi (hotel sesuai budget — bintang 2 hingga 4), konsumsi (makan 3× sehari + snack), tiket masuk objek wisata, pemandu wisata, dokumentasi foto/video, souvenir, dan laporan kegiatan. Kami juga dapat menambahkan outbound facilitator, MC, atau hiburan malam sesuai permintaan.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Berapa jauh hari sebelumnya harus memesan paket wisata karyawan?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Untuk memastikan ketersediaan hotel, bus, dan tiket pesawat terbaik, idealnya pesan 1–3 bulan sebelum keberangkatan — terutama untuk musim ramai (Juni–Juli dan Desember). Namun kami juga dapat mengakomodasi pemesanan mendadak 2–3 minggu sebelumnya untuk destinasi lokal atau rombongan di bawah 50 orang. Hubungi kami segera untuk mengecek ketersediaan.'],
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
<section style="background:linear-gradient(135deg,#0A4A2E 0%,#1a6b42 50%,#0A3A5A 100%);color:#fff;padding:60px 20px 50px;">
  <div style="max-width:900px;margin:0 auto;">
    <nav aria-label="breadcrumb" style="font-size:0.85rem;opacity:0.8;margin-bottom:16px;">
      <a href="/" style="color:#f5c06a;">Beranda</a> &rsaquo;
      <a href="/pelatihan/" style="color:#f5c06a;">Program</a> &rsaquo;
      <span>Wisata Karyawan</span>
    </nav>
    <h1 style="font-size:clamp(1.6rem,4vw,2.4rem);font-weight:700;margin:0 0 16px;">
      Paket Wisata Karyawan &amp; Instansi Pemerintah
    </h1>
    <p style="font-size:1.1rem;opacity:0.92;max-width:720px;margin:0 0 10px;line-height:1.7;">
      Perjalanan wisata tahunan yang terorganisir untuk instansi pemerintah, BUMN, dan korporasi. Dari Yogyakarta ke Bali, Bromo, Lombok, Labuan Bajo, dan destinasi lainnya — satu vendor, satu SPK, tanpa repot koordinasi.
    </p>
    <p style="font-size:0.92rem;opacity:0.8;margin:0 0 28px;">
      ✅ Terdaftar LPSE &amp; PADI UMKM &nbsp;|&nbsp; ✅ Pengadaan langsung &lt; Rp 200 juta &nbsp;|&nbsp; ✅ Dipercaya 70+ instansi sejak 2012
    </p>
    <a href="https://wa.me/6287759151278?text=Halo%2C+saya+ingin+info+paket+wisata+karyawan+untuk+instansi%2Fperusahaan+kami.+Mohon+kirimkan+proposal+dan+penawaran+harga."
       target="_blank" rel="noopener"
       style="display:inline-block;background:#C6621C;color:#fff;padding:14px 32px;border-radius:6px;font-weight:700;text-decoration:none;font-size:1rem;">
      Minta Proposal Wisata Karyawan
    </a>
  </div>
</section>

<main style="max-width:960px;margin:0 auto;padding:40px 20px 60px;">

  <!-- MENGAPA WISATA KARYAWAN -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Mengapa Wisata Tahunan Karyawan Penting?
    </h2>
    <p style="line-height:1.8;color:#333;margin-bottom:16px;">
      Wisata tahunan karyawan bukan sekadar kegiatan rekreasi — ini adalah investasi dalam kesehatan mental tim, kohesivitas antar departemen, dan retensi SDM berkualitas. Karyawan yang merasa dihargai melalui kegiatan seperti ini cenderung memiliki loyalitas lebih tinggi dan produktivitas yang lebih baik setelah kembali dari perjalanan.
    </p>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px;margin-top:20px;">
      <?php
      $benefits = [
        ['😊','Kepuasan Karyawan','Wisata bersama meningkatkan employee satisfaction dan mengurangi burnout pasca kerja keras setahun'],
        ['🤝','Keakraban Tim','Momen informal di luar kantor mempererat hubungan antar karyawan lintas divisi'],
        ['🔋','Energi Baru','Karyawan kembali dengan semangat dan perspektif segar untuk menghadapi tantangan berikutnya'],
        ['🏆','Retensi SDM','Fasilitas wisata tahunan menjadi salah satu faktor karyawan memilih bertahan di organisasi'],
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

  <!-- FORMAT PAKET -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:24px;">
      Format Paket Wisata Karyawan
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:20px;">
      <?php
      $packages = [
        [
          'title' => '🏙️ Wisata Lokal Yogyakarta',
          'dur'   => 'Setengah hari – 1 hari',
          'bg'    => '#0A4A2E',
          'items' => ['Prambanan, Borobudur, Keraton','Kaliurang & Lereng Merapi','Pantai Selatan (Parangtritis, Baron)','Cave Tubing Goa Pindul','Tebing Breksi & Kalibiru'],
          'note'  => 'Tanpa biaya akomodasi & transportasi udara — paling ekonomis',
        ],
        [
          'title' => '🌋 Bromo & Ijen — Jawa Timur',
          'dur'   => '2 hari 1 malam / 3 hari 2 malam',
          'bg'    => '#5a2d0A',
          'items' => ['Sunrise Gunung Bromo','Kawah Ijen (blue fire)','Savana Teletubbies','Pantai Balekambang / Sendang Biru','Pemandangan khas Jawa Timur'],
          'note'  => 'Populer untuk instansi yang menginginkan pengalaman alam dramatis',
        ],
        [
          'title' => '🌴 Bali — Destinasi Favorit',
          'dur'   => '3 hari 2 malam / 4 hari 3 malam',
          'bg'    => '#1a6b42',
          'items' => ['Tanah Lot & Uluwatu','Ubud & sawah Tegalalang','Kuta, Seminyak, Nusa Dua','Water sport Tanjung Benoa','Pura Besakih & budaya Bali'],
          'note'  => 'Destinasi paling diminati — pilihan hotel dan aktivitas sangat lengkap',
        ],
        [
          'title' => '🏝️ Lombok & Gili',
          'dur'   => '3 hari 2 malam / 4 hari 3 malam',
          'bg'    => '#0A3A5A',
          'items' => ['Gili Trawangan, Air, Meno','Snorkeling & diving','Pantai Pink & Tangsi','Sasak Village & budaya lokal','Gunung Rinjani (opsional)'],
          'note'  => 'Alternatif Bali yang lebih tenang — pantai lebih bersih, lebih eksklusif',
        ],
        [
          'title' => '🐉 Labuan Bajo & Komodo',
          'dur'   => '3 hari 2 malam / 4 hari 3 malam',
          'bg'    => '#4a1a0A',
          'items' => ['Taman Nasional Komodo','Pulau Padar & Pink Beach','Snorkeling Kanawa Island','Sunset Gili Laba','Kota Labuan Bajo'],
          'note'  => 'Paket premium — untuk instansi yang ingin pengalaman tak terlupakan',
        ],
        [
          'title' => '✈️ Destinasi Lainnya',
          'dur'   => 'Kustom sesuai permintaan',
          'bg'    => '#2d0A5A',
          'items' => ['Raja Ampat, Papua','Wakatobi, Sulawesi','Belitung','Singapura & Malaysia','Destinasi dalam/luar negeri lainnya'],
          'note'  => 'Kami merancang itinerary untuk destinasi manapun sesuai anggaran',
        ],
      ];
      foreach ($packages as $p): ?>
      <div style="border-radius:8px;overflow:hidden;display:flex;flex-direction:column;border:1px solid #ddd;">
        <div style="background:<?php echo $p['bg']; ?>;color:#fff;padding:16px;">
          <div style="font-weight:700;font-size:0.95rem;"><?php echo $p['title']; ?></div>
          <div style="font-size:0.8rem;opacity:0.85;margin-top:4px;">⏱️ <?php echo $p['dur']; ?></div>
        </div>
        <div style="padding:14px 16px;flex:1;background:#fff;">
          <ul style="margin:0 0 12px;padding-left:18px;color:#444;font-size:0.88rem;line-height:1.8;">
            <?php foreach ($p['items'] as $item): ?>
            <li><?php echo $item; ?></li>
            <?php endforeach; ?>
          </ul>
          <div style="font-size:0.82rem;color:#0A4A2E;font-style:italic;border-top:1px solid #eee;padding-top:8px;"><?php echo $p['note']; ?></div>
        </div>
        <div style="padding:0 16px 14px;background:#fff;">
          <a href="https://wa.me/6287759151278?text=Halo%2C+saya+ingin+info+paket+wisata+<?php echo urlencode(strip_tags($p['title'])); ?>+untuk+karyawan+kami."
             target="_blank" rel="noopener"
             style="display:block;text-align:center;background:#C6621C;color:#fff;padding:9px;border-radius:5px;text-decoration:none;font-weight:600;font-size:0.88rem;">
            Tanya Harga Paket Ini
          </a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- YANG TERMASUK DALAM PAKET -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Yang Termasuk dalam Paket
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:16px;">
      <?php
      $inclusions = [
        ['🚌','Transportasi','Bus pariwisata AC (dari Yogyakarta) + angkutan lokal di destinasi. Tiket pesawat PP jika destinasi luar Jawa.'],
        ['🏨','Akomodasi','Hotel sesuai kategori yang disepakati — mulai dari bintang 2 (ekonomis) hingga bintang 4 (premium). 1 atau 2 kamar per unit.'],
        ['🍽️','Konsumsi','Makan 3× sehari sesuai menu yang disepakati. Snack di perjalanan dan air mineral sepanjang kegiatan.'],
        ['🎫','Tiket Wisata','Semua tiket masuk objek wisata yang tercantum dalam itinerary, termasuk tiket kapal/speedboat jika diperlukan.'],
        ['🧑‍💼','Tour Leader & Pemandu','Tour leader dari Wahana Totalita mendampingi seluruh perjalanan. Pemandu lokal tersedia di destinasi.'],
        ['📸','Dokumentasi','Fotografer/videografer (opsional, atas permintaan). Minimal foto dokumentasi oleh tour leader.'],
        ['🎁','Souvenir','Souvenir/kenang-kenangan khas destinasi untuk seluruh peserta (opsional, bisa disesuaikan anggaran).'],
        ['📄','Laporan Kegiatan','Laporan lengkap pasca kegiatan: daftar hadir, foto, dan narasi kegiatan — untuk kebutuhan pelaporan instansi.'],
      ];
      foreach ($inclusions as $inc): ?>
      <div style="background:#f9f9f9;border:1px solid #e0e0e0;border-radius:8px;padding:16px;display:flex;gap:14px;align-items:flex-start;">
        <div style="font-size:1.8rem;flex-shrink:0;"><?php echo $inc[0]; ?></div>
        <div>
          <div style="font-weight:600;color:#0A4A2E;margin-bottom:4px;font-size:0.9rem;"><?php echo $inc[1]; ?></div>
          <div style="color:#555;font-size:0.85rem;line-height:1.5;"><?php echo $inc[2]; ?></div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- WISATA + OUTBOUND COMBO -->
  <section style="margin-bottom:48px;background:#f0f7f3;border-radius:10px;padding:30px;">
    <h2 style="color:#0A4A2E;font-size:1.4rem;margin:0 0 16px;">
      Program Kombinasi Wisata + Outbound Training
    </h2>
    <p style="line-height:1.8;color:#333;margin-bottom:20px;">
      Program kombinasi wisata dan outbound training adalah pilihan paling populer di kalangan instansi pemerintah dan BUMN. Peserta mendapatkan dua manfaat sekaligus: pengembangan kompetensi tim melalui outbound, dan rekreasi menyenangkan melalui wisata. Satu anggaran, dua tujuan.
    </p>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px;">
      <?php
      $combos = [
        ['Format 2D1N','Hari 1: Outbound training penuh (8 jam aktivitas + debriefing). Hari 2: Wisata objek unggulan destinasi.'],
        ['Format 3D2N','Hari 1: Tiba + wisata ringan. Hari 2: Outbound training + gala dinner. Hari 3: Wisata utama + kembali.'],
        ['Format 4D3N','Hari 1–2: Outbound + team building intensif. Hari 3–4: Wisata bebas + belanja souvenir.'],
        ['Full Custom','Proporsi outbound vs wisata bisa diatur sesuai prioritas — dari 80% outbound hingga 80% wisata.'],
      ];
      foreach ($combos as $c): ?>
      <div style="background:#fff;border-radius:8px;padding:16px;border-left:4px solid #C6621C;">
        <div style="font-weight:600;color:#0A4A2E;margin-bottom:8px;font-size:0.9rem;"><?php echo $c[0]; ?></div>
        <p style="color:#555;font-size:0.85rem;line-height:1.6;margin:0;"><?php echo $c[1]; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
    <div style="margin-top:20px;">
      <a href="/outbound/"
         style="display:inline-block;background:#0A4A2E;color:#fff;padding:11px 24px;border-radius:6px;font-weight:600;text-decoration:none;font-size:0.9rem;margin-right:12px;">
        Lihat Program Outbound Training
      </a>
      <a href="https://wa.me/6287759151278?text=Halo%2C+saya+ingin+konsultasi+paket+kombinasi+wisata+dan+outbound+training+untuk+karyawan+kami."
         target="_blank" rel="noopener"
         style="display:inline-block;background:#C6621C;color:#fff;padding:11px 24px;border-radius:6px;font-weight:600;text-decoration:none;font-size:0.9rem;">
        Konsultasi Paket Combo
      </a>
    </div>
  </section>

  <!-- PENGADAAN PEMERINTAH -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Kemudahan Pengadaan untuk Instansi Pemerintah
    </h2>
    <p style="line-height:1.8;color:#333;margin-bottom:20px;">
      Wahana Totalita memahami kompleksitas pengadaan pemerintah dan telah membangun sistem yang memudahkan proses dari perencanaan hingga pelaporan. Kami bukan sekadar travel agent — kami adalah mitra pengadaan yang memahami aturan main APBN/APBD.
    </p>
    <div style="overflow-x:auto;">
      <table style="width:100%;border-collapse:collapse;font-size:0.92rem;">
        <thead>
          <tr style="background:#0A4A2E;color:#fff;">
            <th style="padding:12px 16px;text-align:left;">Kebutuhan Instansi</th>
            <th style="padding:12px 16px;text-align:left;">Solusi Wahana Totalita</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $procure = [
            ['Vendor terdaftar sistem pengadaan','Terdaftar LPSE (eProcurement pemerintah) dan PADI UMKM'],
            ['Mekanisme pengadaan langsung','Dapat melalui penunjukan langsung untuk nilai di bawah Rp 200 juta'],
            ['Dokumen administrasi lengkap','Proposal + RAB, SPK, kuitansi, faktur pajak, BAST, laporan kegiatan'],
            ['NPWP & PKP aktif','Faktur pajak resmi untuk kebutuhan SPJ keuangan instansi'],
            ['Legalitas vendor jelas','NIB aktif, akta perusahaan, TDP, dan izin usaha perjalanan wisata'],
            ['Laporan pasca kegiatan','Laporan tertulis + foto + daftar hadir untuk kebutuhan audit internal'],
          ];
          foreach ($procure as $i => $row):
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

  <!-- ALUR PEMESANAN -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:24px;">
      Alur Pemesanan Paket Wisata Karyawan
    </h2>
    <?php
    $steps = [
      ['1','Konsultasi Awal (Gratis)','Hubungi kami via WhatsApp atau telepon. Ceritakan jumlah peserta, destinasi yang diminati, anggaran, dan tanggal yang diinginkan.'],
      ['2','Proposal & Itinerary','Dalam 1×24 jam kami kirimkan proposal lengkap: itinerary hari per hari, daftar hotel, RAB, dan rincian harga paket.'],
      ['3','Revisi & Finalisasi','Kami revisi proposal sesuai masukan Anda hingga semua sesuai kebutuhan dan anggaran yang tersedia.'],
      ['4','Penandatanganan SPK','Setelah harga dan program sepakat, SPK ditandatangani dan DP (biasanya 30–50%) dibayarkan untuk konfirmasi booking.'],
      ['5','Pelaksanaan Perjalanan','Hari-H: seluruh logistik sudah disiapkan. Tour leader kami mendampingi dari keberangkatan hingga kembali ke Yogyakarta.'],
      ['6','Laporan Kegiatan','Dalam 3–5 hari kerja pasca perjalanan, laporan lengkap beserta foto dan daftar hadir kami kirimkan untuk kebutuhan SPJ.'],
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
      Program Lain untuk Instansi &amp; Korporasi
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(210px,1fr));gap:16px;">
      <?php
      $related = [
        ['/outbound/','Outbound Training','Team building dan pengembangan kepemimpinan di alam terbuka'],
        ['/keselamatan-kerja/','Pelatihan K3','Sertifikasi K3 wajib untuk karyawan dan perusahaan'],
        ['/pelatihan-iso/','Pelatihan ISO','Sistem manajemen mutu dan K3 berstandar internasional'],
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
      ['Apakah paket wisata karyawan bisa dimasukkan ke dalam anggaran instansi pemerintah?','Ya. Wisata karyawan instansi pemerintah umumnya masuk dalam mata anggaran kegiatan pembinaan kepegawaian atau peningkatan kesejahteraan pegawai. Wahana Totalita terdaftar di LPSE dan PADI UMKM — dapat menjadi vendor pengadaan langsung di bawah Rp 200 juta. Kami menyediakan dokumen administrasi lengkap: proposal, SPK, kuitansi, faktur pajak, dan laporan kegiatan.'],
      ['Berapa peserta minimum untuk paket wisata karyawan instansi?','Paket tersedia mulai dari 20 peserta. Untuk rombongan besar (100–500 orang), kami menyediakan armada bus dan koordinator per kelompok. Tidak ada batas maksimum peserta.'],
      ['Destinasi mana yang paling populer untuk wisata karyawan dari Yogyakarta?','Bali (favorit utama, 3–5 hari), Bromo & Ijen (alam dramatis, 2–3 hari), Lombok & Gili (pantai premium), Labuan Bajo & Komodo (paket premium), dan wisata lokal Yogyakarta untuk kegiatan setengah hari.'],
      ['Apakah wisata karyawan bisa dikombinasikan dengan outbound atau pelatihan?','Ya, dan ini sangat direkomendasikan. Kombinasi wisata + outbound sangat populer — peserta mendapat pengembangan kompetensi sekaligus rekreasi. Wahana Totalita mengelola keduanya dalam satu paket.'],
      ['Apa saja yang termasuk dalam paket wisata karyawan Wahana Totalita?','Umumnya mencakup: transportasi (bus pariwisata AC atau pesawat), akomodasi, konsumsi 3× sehari, tiket masuk objek wisata, pemandu wisata, tour leader, dan laporan kegiatan. Komponen dapat disesuaikan.'],
      ['Berapa jauh hari sebelumnya harus memesan paket wisata karyawan?','Ideal 1–3 bulan sebelumnya untuk destinasi favorit di musim ramai (Juni–Juli, Desember). Untuk destinasi lokal atau rombongan kecil, 2–3 minggu sebelumnya masih bisa diakomodasi.'],
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
  <section style="background:linear-gradient(135deg,#0A4A2E,#0A3A5A);color:#fff;border-radius:12px;padding:40px;text-align:center;">
    <h2 style="margin:0 0 12px;font-size:1.6rem;">Rencanakan Wisata Karyawan Tahun Ini</h2>
    <p style="opacity:0.9;margin:0 0 28px;line-height:1.7;max-width:600px;margin-left:auto;margin-right:auto;">
      Ceritakan jumlah peserta, destinasi, dan anggaran Anda — kami kirimkan proposal dan itinerary lengkap dalam 1×24 jam kerja.
    </p>
    <a href="https://wa.me/6287759151278?text=Halo%2C+saya+ingin+konsultasi+paket+wisata+karyawan+untuk+instansi%2Fperusahaan+kami.+Mohon+kirimkan+proposal."
       target="_blank" rel="noopener"
       style="display:inline-block;background:#C6621C;color:#fff;padding:14px 36px;border-radius:6px;font-weight:700;text-decoration:none;font-size:1.05rem;margin-right:12px;">
      WhatsApp: 0877-5915-1278
    </a>
    <a href="/outbound/"
       style="display:inline-block;background:transparent;color:#fff;padding:14px 28px;border-radius:6px;font-weight:600;text-decoration:none;font-size:1rem;border:2px solid rgba(255,255,255,0.6);margin-top:10px;">
      Lihat Program Outbound
    </a>
  </section>

</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
</body>
</html>
