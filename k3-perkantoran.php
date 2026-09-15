<?php
require_once __DIR__ . '/config.php';
$s = get_all_settings();
// Hub: K3 Perkantoran
$canonical = 'https://wahanatotalita.com/k3-perkantoran/';
$meta_title = 'K3 Perkantoran — Keselamatan & Kesehatan Kerja di Kantor | Wahana Totalita';
$meta_desc  = 'Panduan lengkap K3 Perkantoran: ergonomi workstation, kualitas udara dalam ruangan, evakuasi darurat, dan sertifikasi K3 untuk lingkungan kantor. Permenaker 5/2018. Yogyakarta.';

$schema = [
  [
    '@context' => 'https://schema.org',
    '@type'    => 'BreadcrumbList',
    'itemListElement' => [
      ['@type'=>'ListItem','position'=>1,'name'=>'Beranda','item'=>'https://wahanatotalita.com/'],
      ['@type'=>'ListItem','position'=>2,'name'=>'Pelatihan','item'=>'https://wahanatotalita.com/pelatihan/'],
      ['@type'=>'ListItem','position'=>3,'name'=>'K3 Perkantoran','item'=>$canonical],
    ],
  ],
  [
    '@context' => 'https://schema.org',
    '@type'    => 'FAQPage',
    'mainEntity' => [
      [
        '@type' => 'Question',
        'name'  => 'Apakah regulasi K3 berlaku untuk lingkungan kantor?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Ya. UU No. 1 Tahun 1970 tentang Keselamatan Kerja berlaku untuk semua tempat kerja termasuk kantor, bukan hanya pabrik atau industri berat. Permenaker No. 5 Tahun 2018 mengatur nilai ambang batas (NAB) faktor fisika dan kimia di lingkungan kerja termasuk kantor — kebisingan, pencahayaan, suhu, dan kualitas udara.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apa bahaya K3 yang paling umum di lingkungan kantor?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Lima bahaya K3 paling umum di kantor: (1) Ergonomi buruk — postur tubuh salah saat menggunakan komputer menyebabkan nyeri punggung, leher, dan RSI (Repetitive Strain Injury); (2) Kualitas udara dalam ruangan (IAQ) — AC yang tidak terawat, debu, dan senyawa organik volatil (VOC) dari furnitur; (3) Pencahayaan tidak memadai — menyebabkan kelelahan mata dan sakit kepala; (4) Bahaya kebakaran dan evakuasi — banyak kantor tidak memiliki prosedur darurat yang jelas; (5) Psychosocial hazard — stres kerja berlebihan, beban kerja tidak seimbang, dan konflik interpersonal.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Berapa standar pencahayaan minimal untuk lingkungan kantor di Indonesia?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Berdasarkan Permenaker No. 5 Tahun 2018, pencahayaan minimal untuk pekerjaan kantor adalah 300 lux untuk ruang kerja umum dan 500 lux untuk pekerjaan yang membutuhkan ketelitian tinggi (desain, analisis dokumen). Pencahayaan di bawah standar menyebabkan kelelahan mata, sakit kepala, dan penurunan produktivitas.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apakah perusahaan dengan karyawan di bawah 100 orang wajib membentuk P2K3?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Tidak wajib. P2K3 (Panitia Pembina Keselamatan dan Kesehatan Kerja) wajib dibentuk oleh perusahaan dengan karyawan ≥100 orang, atau perusahaan dengan potensi bahaya tinggi meskipun jumlah karyawan lebih sedikit. Perusahaan dengan karyawan lebih sedikit tetap harus memenuhi persyaratan K3 dasar, namun tidak harus membentuk P2K3 formal.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apa itu VDT Syndrome dan bagaimana mencegahnya?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'VDT Syndrome (Video Display Terminal Syndrome) adalah kumpulan gejala yang dialami oleh pekerja yang menggunakan layar komputer terlalu lama: mata lelah/kering, sakit kepala, penglihatan kabur, nyeri leher dan bahu. Pencegahan: aturan 20-20-20 (setiap 20 menit, lihat objek 20 kaki/6 meter selama 20 detik), posisi monitor tepat (sedikit di bawah garis mata, jarak 50–70 cm), pencahayaan ruangan memadai, dan istirahat reguler.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Sertifikasi apa yang relevan untuk petugas K3 di lingkungan perkantoran?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Beberapa sertifikasi relevan untuk K3 perkantoran: (1) Petugas P3K Tingkat I (Permenaker 15/2008) — wajib ada di setiap tempat kerja termasuk kantor; (2) Petugas Peran Kebakaran Kelas D (Kepmenaker 186/1999) — untuk kantor dengan risiko kebakaran; (3) Ahli K3 Umum Kemnaker RI — untuk petugas K3 yang bertanggung jawab atas sistem K3 kantor secara keseluruhan; (4) Ergonomi Assessor — untuk penilaian dan perbaikan workstation komputer.'],
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
<section style="background:linear-gradient(135deg,#0A4A2E 0%,#1a6b42 100%);color:#fff;padding:60px 20px 50px;">
  <div style="max-width:900px;margin:0 auto;">
    <nav aria-label="breadcrumb" style="font-size:0.85rem;opacity:0.8;margin-bottom:16px;">
      <a href="/" style="color:#f5c06a;">Beranda</a> &rsaquo;
      <a href="/pelatihan/" style="color:#f5c06a;">Pelatihan</a> &rsaquo;
      <span>K3 Perkantoran</span>
    </nav>
    <h1 style="font-size:clamp(1.6rem,4vw,2.4rem);font-weight:700;margin:0 0 16px;">
      K3 Perkantoran — Keselamatan &amp; Kesehatan Kerja di Lingkungan Kantor
    </h1>
    <p style="font-size:1.1rem;opacity:0.92;max-width:700px;margin:0 0 28px;line-height:1.7;">
      Kantor bukan zona bebas risiko. Ergonomi buruk, kualitas udara dalam ruangan, bahaya kebakaran, dan psychosocial hazard memengaruhi produktivitas dan kesehatan ribuan pekerja kantoran setiap hari. Permenaker No. 5 Tahun 2018 dan UU 1/1970 berlaku untuk semua tempat kerja — termasuk kantor Anda.
    </p>
    <a href="https://wa.me/628122969435?text=Halo%2C+saya+ingin+konsultasi+pelatihan+K3+Perkantoran+untuk+tim+kami.+Mohon+info+program+dan+biaya."
       target="_blank" rel="noopener"
       style="display:inline-block;background:#C6621C;color:#fff;padding:14px 32px;border-radius:6px;font-weight:700;text-decoration:none;font-size:1rem;">
      Konsultasi Program K3 Kantor
    </a>
  </div>
</section>

<main style="max-width:960px;margin:0 auto;padding:40px 20px 60px;">

  <!-- REGULASI -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Regulasi K3 yang Berlaku untuk Lingkungan Kantor
    </h2>
    <p style="line-height:1.8;color:#333;margin-bottom:16px;">
      Banyak perusahaan jasa dan perkantoran keliru mengira bahwa regulasi K3 hanya berlaku untuk industri berat, konstruksi, atau pabrik. Faktanya, <strong>UU No. 1 Tahun 1970 tentang Keselamatan Kerja</strong> berlaku untuk <em>semua</em> tempat kerja di Indonesia — termasuk kantor, bank, rumah sakit, hotel, dan institusi pemerintah.
    </p>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:16px;margin-top:24px;">
      <?php
      $regs = [
        ['UU No. 1 Tahun 1970','Keselamatan Kerja — berlaku untuk semua tempat kerja, mewajibkan syarat-syarat K3 dan pemeriksaan tempat kerja'],
        ['Permenaker No. 5/2018','Nilai Ambang Batas (NAB) faktor fisika dan kimia — kebisingan, pencahayaan, suhu, getaran, dan kualitas udara di lingkungan kerja termasuk kantor'],
        ['Permenaker No. 15/2008','Pertolongan Pertama pada Kecelakaan (P3K) — wajib ada petugas P3K dan kotak P3K di setiap tempat kerja'],
        ['Kepmenaker No. 186/1999','Penanggulangan Kebakaran — wajib ada petugas peran kebakaran, APAR, dan prosedur evakuasi'],
        ['PP No. 50/2012','SMK3 — wajib bagi perusahaan ≥100 karyawan atau berisiko tinggi, berlaku pula untuk kantor skala besar'],
        ['Permenaker No. 8/2010','APD — kewajiban penggunaan alat pelindung diri yang relevan di tempat kerja termasuk sektor jasa'],
      ];
      foreach ($regs as $reg): ?>
      <div style="background:#f0f7f3;border-left:4px solid #0A4A2E;border-radius:0 8px 8px 0;padding:16px;">
        <div style="font-weight:700;color:#0A4A2E;margin-bottom:6px;font-size:0.9rem;"><?php echo $reg[0]; ?></div>
        <div style="color:#444;font-size:0.88rem;line-height:1.6;"><?php echo $reg[1]; ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- BAHAYA K3 DI KANTOR -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:24px;">
      5 Bahaya K3 Utama di Lingkungan Kantor
    </h2>
    <?php
    $lux = [
      ['Lorong, toilet, gudang','50–100 lux'],
      ['Ruang pertemuan / rapat','200–300 lux'],
      ['Ruang kerja komputer umum','300 lux'],
      ['Pekerjaan membaca/menulis intensif','500 lux'],
      ['Pekerjaan desain / analisis dokumen','750–1.000 lux'],
    ];
    $luxRows = '';
    foreach ($lux as $i => $l) {
      $bg = $i % 2 === 0 ? '#fff' : '#f5f5f5';
      $luxRows .= '<tr style="background:' . $bg . ';"><td style="padding:7px 12px;border-bottom:1px solid #eee;">' . $l[0] . '</td><td style="padding:7px 12px;border-bottom:1px solid #eee;font-weight:600;">' . $l[1] . '</td></tr>';
    }
    $hazards = [
      [
        'no'    => '1',
        'title' => 'Bahaya Ergonomi — Penyebab Utama Sakit Punggung & RSI',
        'color' => '#e8f4eb',
        'content' => '<p style="line-height:1.8;color:#333;margin:0 0 12px;">Ergonomi yang buruk adalah bahaya K3 paling umum di kantor namun paling sering diabaikan. Postur tubuh yang salah saat duduk dalam waktu lama menyebabkan: nyeri punggung bawah (low back pain), nyeri leher dan bahu, <em>Repetitive Strain Injury</em> (RSI) pada pergelangan tangan dan jari, serta <em>VDT Syndrome</em> akibat paparan layar komputer berkepanjangan.</p>
        <p style="line-height:1.8;color:#333;margin:0;font-size:0.9rem;"><strong>Standar workstation ergonomis:</strong> Tinggi kursi diatur agar kaki menapak rata di lantai, lutut 90°. Monitor di bawah garis mata, jarak 50–70 cm. Keyboard dan mouse sejajar siku dalam posisi rileks. Sandaran punggung mendukung lumbar. Posisi dokumen kerja setinggi mata untuk menghindari menunduk.</p>',
      ],
      [
        'no'    => '2',
        'title' => 'Kualitas Udara Dalam Ruangan (Indoor Air Quality / IAQ)',
        'color' => '#e8f0f7',
        'content' => '<p style="line-height:1.8;color:#333;margin:0 0 12px;">Gedung kantor modern yang tertutup rapat dengan sistem AC terpusat sering mengalami masalah IAQ — kondisi yang disebut <em>Sick Building Syndrome</em>. Sumber polutan: AC yang jarang dibersihkan (debu, jamur, bakteri Legionella), VOC (senyawa organik volatil) dari cat, karpet, dan furnitur baru, CO₂ yang menumpuk dari pernapasan penghuni, dan debu dari dokumen serta peralatan elektronik.</p>
        <p style="line-height:1.8;color:#333;margin:0;font-size:0.9rem;"><strong>Permenaker 5/2018 mengatur:</strong> Kadar CO₂ maksimal 5.000 ppm (8 jam kerja). Suhu ruangan kerja 18–30°C. Kelembaban 40–60%. Kecepatan aliran udara 0,15–0,25 m/detik. Pemeliharaan sistem ventilasi dan AC secara berkala adalah kewajiban K3, bukan sekadar kenyamanan.</p>',
      ],
      [
        'no'    => '3',
        'title' => 'Pencahayaan (Illuminasi) — NAB Sesuai Jenis Pekerjaan',
        'color' => '#f7f4e8',
        'content' => '<p style="line-height:1.8;color:#333;margin:0 0 12px;">Pencahayaan yang tidak memadai atau berlebihan sama-sama berbahaya. Kekurangan cahaya menyebabkan kelelahan mata, sakit kepala, dan penurunan akurasi kerja. Pencahayaan berlebihan atau silau (<em>glare</em>) dari jendela dan layar komputer menyebabkan ketidaknyamanan visual dan kesalahan kerja.</p>
        <div style="overflow-x:auto;margin-top:12px;"><table style="width:100%;border-collapse:collapse;font-size:0.88rem;">
          <tr style="background:#0A4A2E;color:#fff;"><th style="padding:8px 12px;text-align:left;">Jenis Pekerjaan Kantor</th><th style="padding:8px 12px;text-align:left;">NAB Pencahayaan (Permenaker 5/2018)</th></tr>'
          . $luxRows .
        '</table></div>',
      ],
      [
        'no'    => '4',
        'title' => 'Bahaya Kebakaran & Kesiapan Evakuasi',
        'color' => '#f7ece8',
        'content' => '<p style="line-height:1.8;color:#333;margin:0 0 12px;">Kantor memiliki beban api yang signifikan: kertas, furnitur, peralatan listrik, dan kabel. Kepmenaker No. 186 Tahun 1999 mewajibkan setiap perusahaan memiliki unit penanggulangan kebakaran terlatih, APAR yang sesuai kelas kebakaran, jalur evakuasi yang jelas dan tidak terhalang, serta prosedur darurat yang dipahami seluruh karyawan.</p>
        <p style="line-height:1.8;color:#333;margin:0;font-size:0.9rem;"><strong>Tiga kewajiban minimum kantor:</strong> (1) APAR kelas ABC (powder atau CO₂) tersedia dan diperiksa berkala; (2) Peta jalur evakuasi terpasang di setiap lantai dan mudah terlihat; (3) Minimal satu <em>Petugas Peran Kebakaran Kelas D</em> per lantai atau per 25 karyawan sesuai Kepmenaker 186/1999.</p>',
      ],
      [
        'no'    => '5',
        'title' => 'Psychosocial Hazard — Bahaya yang Tidak Terlihat',
        'color' => '#ede8f7',
        'content' => '<p style="line-height:1.8;color:#333;margin:0 0 12px;"><em>Psychosocial hazard</em> adalah faktor pekerjaan yang berdampak pada kesehatan mental dan fisik pekerja: beban kerja berlebihan dan tenggat waktu tidak realistis, konflik antar karyawan atau dengan atasan, ketidakjelasan peran (role ambiguity), kurangnya kontrol atas pekerjaan, dan ancaman pekerjaan atau ketidakstabilan kerja. WHO dan ILO mengakui psychosocial hazard sebagai risiko K3 yang harus dikelola seperti bahaya fisik lainnya.</p>
        <p style="line-height:1.8;color:#333;margin:0;font-size:0.9rem;"><strong>Kepmenaker No. 4 Tahun 2026</strong> (terbaru) memperkuat kewajiban pengelolaan risiko psikososial di tempat kerja. Wahana Totalita menyediakan pelatihan <em>Risiko Psikososial K3</em> sesuai regulasi terbaru ini.</p>',
      ],
    ];
    foreach ($hazards as $h): ?>
    <div style="background:<?php echo $h['color']; ?>;border-radius:10px;padding:24px;margin-bottom:20px;border-left:5px solid #0A4A2E;">
      <h3 style="color:#0A4A2E;margin:0 0 14px;font-size:1.1rem;">
        <?php echo $h['no']; ?>. <?php echo $h['title']; ?>
      </h3>
      <?php echo $h['content']; ?>
    </div>
    <?php endforeach; ?>
  </section>

  <!-- WORKSTATION CHECKLIST -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Checklist Ergonomi Workstation Komputer
    </h2>
    <p style="line-height:1.8;color:#333;margin-bottom:20px;">
      Gunakan checklist ini untuk mengevaluasi workstation komputer di kantor Anda. Setiap item yang tidak terpenuhi adalah potensi risiko K3 yang perlu diperbaiki.
    </p>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:16px;">
      <?php
      $checklists = [
        ['🪑','Kursi','Tinggi dapat diatur ✓ | Sandaran lumbar ✓ | Roda untuk mobilitas ✓ | Sandaran tangan (armrest) ✓'],
        ['🖥️','Monitor','Posisi sedikit di bawah garis mata ✓ | Jarak 50–70 cm ✓ | Tidak ada silau (glare) dari jendela ✓ | Kecerahan sesuai kondisi ruangan ✓'],
        ['⌨️','Keyboard & Mouse','Sejajar siku dalam posisi rileks ✓ | Mouse dalam jangkauan tanpa meregangkan lengan ✓ | Pergelangan tidak menekuk saat mengetik ✓'],
        ['🦶','Posisi Tubuh','Kaki menapak rata di lantai atau footrest ✓ | Lutut 90° ✓ | Punggung lurus dengan sandaran ✓ | Bahu rileks ✓'],
        ['💡','Pencahayaan','Minimal 300 lux untuk kerja komputer ✓ | Tidak ada bayangan di area kerja ✓ | Layar tidak memantul cahaya ✓'],
        ['⏱️','Istirahat','Istirahat 5–10 menit setiap 1 jam ✓ | Aturan 20-20-20 untuk mata ✓ | Peregangan leher dan punggung berkala ✓'],
      ];
      foreach ($checklists as $c): ?>
      <div style="background:#fff;border:1px solid #ddd;border-radius:8px;padding:18px;">
        <div style="font-size:1.8rem;margin-bottom:8px;"><?php echo $c[0]; ?></div>
        <div style="font-weight:700;color:#0A4A2E;margin-bottom:8px;"><?php echo $c[1]; ?></div>
        <div style="color:#555;font-size:0.85rem;line-height:1.7;"><?php echo $c[2]; ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- P2K3 -->
  <section style="margin-bottom:48px;background:#f0f7f3;border-radius:10px;padding:30px;">
    <h2 style="color:#0A4A2E;font-size:1.4rem;margin:0 0 16px;">
      P2K3 — Panitia Pembina K3 untuk Kantor Besar
    </h2>
    <p style="line-height:1.8;color:#333;margin-bottom:16px;">
      Perusahaan atau instansi dengan <strong>100 karyawan atau lebih</strong> wajib membentuk P2K3 (Panitia Pembina Keselamatan dan Kesehatan Kerja) berdasarkan Permenaker No. 4 Tahun 1987. P2K3 adalah badan bipartit yang beranggotakan perwakilan pengusaha dan pekerja, bertugas memberikan saran dan pertimbangan mengenai masalah K3 di tempat kerja.
    </p>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:16px;">
      <?php
      $p2k3 = [
        ['Struktur P2K3','Ketua (pimpinan perusahaan), Sekretaris (Ahli K3 Umum), Anggota (perwakilan pekerja dan manajemen)'],
        ['Pertemuan Rutin','Minimal satu kali per bulan — mendiskusikan kondisi K3, laporan kecelakaan, dan program peningkatan'],
        ['Pelaporan','Laporan P2K3 diserahkan ke Disnaker setempat setiap 3 bulan sekali'],
        ['Sekretaris P2K3','Wajib dijabat oleh Ahli K3 Umum bersertifikat Kemnaker RI — ini yang paling sering tidak terpenuhi'],
      ];
      foreach ($p2k3 as $p): ?>
      <div style="background:#fff;border-radius:6px;padding:16px;">
        <div style="font-weight:600;color:#0A4A2E;margin-bottom:6px;font-size:0.95rem;"><?php echo $p[0]; ?></div>
        <div style="color:#555;font-size:0.88rem;line-height:1.6;"><?php echo $p[1]; ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- SERTIFIKASI -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:24px;">
      Sertifikasi K3 yang Relevan untuk Lingkungan Kantor
    </h2>
    <p style="color:#555;margin-bottom:24px;line-height:1.7;">
      Berikut sertifikasi dan pelatihan K3 yang wajib atau sangat direkomendasikan untuk lingkungan kantor. Hubungi Wahana Totalita untuk jadwal dan penawaran harga program di bawah ini.
    </p>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:20px;">
      <?php
      $certs = [
        [
          'title' => 'Ahli K3 Umum — Kemnaker RI',
          'desc'  => 'Wajib ada di perusahaan dengan ≥100 karyawan. Sekretaris P2K3 harus Ahli K3 Umum.',
          'slug'  => '/pelatihan/ahli-k3-umum-kemnaker-ri/',
          'label' => 'Lihat Program',
        ],
        [
          'title' => 'Petugas P3K Tingkat I',
          'desc'  => 'Wajib ada di setiap tempat kerja. Untuk kantor risiko rendah: 1 petugas per 100 karyawan.',
          'slug'  => '/pelatihan/pelatihan-petugas-p3k-kemnaker-ri/',
          'label' => 'Lihat Program',
        ],
        [
          'title' => 'Petugas Peran Kebakaran Kelas D',
          'desc'  => 'Petugas pemadam kebakaran tingkat dasar. Wajib per lantai atau per 25 karyawan.',
          'slug'  => '/pelatihan/pelatihan-petugas-peran-kebakaran-kelas-d/',
          'label' => 'Lihat Program',
        ],
        [
          'title' => 'Ergonomi & K3 Perkantoran',
          'desc'  => 'Pelatihan khusus untuk tim HR, fasilitas, dan HSE dalam mengelola risiko ergonomi dan IAQ.',
          'slug'  => null,
          'label' => 'Tanya via WA',
        ],
        [
          'title' => 'ISO 45001 — Internal Auditor',
          'desc'  => 'Untuk kantor yang menerapkan Sistem Manajemen K3 terintegrasi.',
          'slug'  => '/pelatihan-iso/',
          'label' => 'Lihat Program',
        ],
        [
          'title' => 'Risiko Psikososial K3',
          'desc'  => 'Pengelolaan risiko psikososial di tempat kerja sesuai Kepmenaker 4/2026.',
          'slug'  => null,
          'label' => 'Tanya via WA',
        ],
      ];
      foreach ($certs as $c):
        $href = $c['slug']
          ? $c['slug']
          : 'https://wa.me/628122969435?text=Halo%2C+saya+ingin+info+program+' . urlencode($c['title']) . '+untuk+kantor+kami.';
        $target = $c['slug'] ? '' : ' target="_blank" rel="noopener"';
        $btn_bg = $c['slug'] ? '#0A4A2E' : '#C6621C';
      ?>
      <div style="background:#fff;border:1px solid #ddd;border-radius:8px;overflow:hidden;display:flex;flex-direction:column;">
        <div style="background:#0A4A2E;color:#fff;padding:14px 16px;">
          <div style="font-weight:600;font-size:0.95rem;"><?php echo $c['title']; ?></div>
        </div>
        <div style="padding:14px 16px;flex:1;">
          <p style="color:#555;font-size:0.9rem;line-height:1.6;margin:0;"><?php echo $c['desc']; ?></p>
        </div>
        <div style="padding:0 16px 16px;">
          <a href="<?php echo $href; ?>"<?php echo $target; ?>
             style="display:block;text-align:center;background:<?php echo $btn_bg; ?>;color:#fff;padding:10px;border-radius:5px;text-decoration:none;font-weight:600;font-size:0.9rem;">
            <?php echo $c['label']; ?>
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
        ['/higiene-industri/','Higiene Industri & Hiperkes','NAB faktor fisika-kimia, dokter & paramedis perusahaan'],
        ['/p3k/','Pelatihan P3K','Pertolongan pertama — wajib di semua tempat kerja'],
        ['/penanggulangan-kebakaran/','K3 Kebakaran','Kelas D hingga Ahli K3 Spesialis Kebakaran'],
        ['/smk3/','SMK3 & ISO 45001','Sistem manajemen K3 nasional dan internasional'],
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
      ['Apakah regulasi K3 berlaku untuk lingkungan kantor?','Ya. UU No. 1 Tahun 1970 tentang Keselamatan Kerja berlaku untuk semua tempat kerja termasuk kantor, bukan hanya pabrik atau industri berat. Permenaker No. 5 Tahun 2018 mengatur nilai ambang batas (NAB) faktor fisika dan kimia di lingkungan kerja termasuk kantor — kebisingan, pencahayaan, suhu, dan kualitas udara.'],
      ['Apa bahaya K3 yang paling umum di lingkungan kantor?','Lima bahaya K3 paling umum di kantor: (1) Ergonomi buruk — postur tubuh salah menyebabkan nyeri punggung dan RSI; (2) Kualitas udara dalam ruangan (IAQ) — AC tidak terawat, debu, VOC; (3) Pencahayaan tidak memadai — kelelahan mata dan sakit kepala; (4) Bahaya kebakaran — banyak kantor tidak memiliki prosedur darurat yang memadai; (5) Psychosocial hazard — stres kerja, beban berlebihan, konflik interpersonal.'],
      ['Berapa standar pencahayaan minimal untuk lingkungan kantor di Indonesia?','Berdasarkan Permenaker No. 5 Tahun 2018, pencahayaan minimal untuk pekerjaan kantor adalah 300 lux untuk ruang kerja umum dan 500 lux untuk pekerjaan yang membutuhkan ketelitian tinggi. Pencahayaan di bawah standar menyebabkan kelelahan mata, sakit kepala, dan penurunan produktivitas.'],
      ['Apakah perusahaan dengan karyawan di bawah 100 orang wajib membentuk P2K3?','Tidak wajib. P2K3 wajib dibentuk oleh perusahaan dengan karyawan ≥100 orang, atau perusahaan dengan potensi bahaya tinggi. Perusahaan yang lebih kecil tetap harus memenuhi persyaratan K3 dasar, namun tidak harus membentuk P2K3 formal.'],
      ['Apa itu VDT Syndrome dan bagaimana mencegahnya?','VDT Syndrome (Video Display Terminal Syndrome) adalah kumpulan gejala dari penggunaan layar komputer terlalu lama: mata lelah/kering, sakit kepala, penglihatan kabur, nyeri leher dan bahu. Pencegahan: aturan 20-20-20 (setiap 20 menit, lihat objek 6 meter selama 20 detik), posisi monitor tepat (jarak 50–70 cm), pencahayaan ruangan memadai, dan istirahat berkala.'],
      ['Sertifikasi apa yang relevan untuk petugas K3 di lingkungan perkantoran?','Sertifikasi relevan untuk K3 perkantoran: (1) Petugas P3K Tingkat I — wajib ada di setiap tempat kerja; (2) Petugas Peran Kebakaran Kelas D — untuk kantor dengan risiko kebakaran; (3) Ahli K3 Umum Kemnaker RI — untuk petugas K3 bertanggung jawab atas sistem K3 kantor; (4) Ergonomi Assessor — untuk penilaian dan perbaikan workstation komputer.'],
    ];
    foreach ($faqs as $i => $faq): ?>
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
    <h2 style="margin:0 0 12px;font-size:1.6rem;">Tingkatkan Standar K3 Kantor Anda</h2>
    <p style="opacity:0.9;margin:0 0 28px;line-height:1.7;max-width:600px;margin-left:auto;margin-right:auto;">
      Dari pelatihan P3K, ergonomi, hingga pembentukan P2K3 dan sertifikasi Ahli K3 Umum — Wahana Totalita siap mendampingi kantor Anda memenuhi semua kewajiban K3.
    </p>
    <a href="https://wa.me/628122969435?text=Halo%2C+saya+ingin+konsultasi+program+K3+Perkantoran+untuk+instansi%2Fperusahaan+kami.+Mohon+info+lebih+lanjut."
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
