<?php
require_once __DIR__ . '/config.php';
$s = get_all_settings();
// Hub: Pelatihan Manajemen & Pengembangan SDM
$canonical = 'https://wahanatotalita.com/pelatihan-manajemen-sdm/';
$meta_title = 'Pelatihan Manajemen & Pengembangan SDM Instansi Pemerintah — Wahana Totalita Yogyakarta';
$meta_desc  = 'Pelatihan manajemen, kepemimpinan, soft skills, dan pengembangan SDM untuk ASN, BUMN, dan swasta di Yogyakarta. Sesuai PermenpanRB 13/2022 dan UU ASN. Bersertifikat, in-house & publik.';

$schema = [
  [
    '@context' => 'https://schema.org',
    '@type'    => 'BreadcrumbList',
    'itemListElement' => [
      ['@type'=>'ListItem','position'=>1,'name'=>'Beranda','item'=>'https://wahanatotalita.com/'],
      ['@type'=>'ListItem','position'=>2,'name'=>'Pelatihan','item'=>'https://wahanatotalita.com/pelatihan/'],
      ['@type'=>'ListItem','position'=>3,'name'=>'Pelatihan Manajemen & SDM','item'=>$canonical],
    ],
  ],
  [
    '@context' => 'https://schema.org',
    '@type'    => 'FAQPage',
    'mainEntity' => [
      [
        '@type' => 'Question',
        'name'  => 'Apakah pelatihan manajemen dan soft skills wajib untuk ASN?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Ya. UU No. 5 Tahun 2014 tentang ASN mewajibkan pengembangan kompetensi bagi setiap PNS minimal 20 jam pelajaran per tahun. PermenpanRB No. 13 Tahun 2022 memperinci bahwa pengembangan kompetensi mencakup kompetensi teknis, manajerial, dan sosio-kultural. Pelatihan manajemen, kepemimpinan, komunikasi, dan soft skills termasuk dalam kompetensi manajerial dan sosio-kultural yang wajib dipenuhi. Anggaran pengembangan kompetensi ASN diatur tersendiri dalam DIPA instansi.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Berapa jam pelajaran yang diakui dari pelatihan manajemen untuk ASN?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Setiap program pelatihan memiliki bobot jam pelajaran (JP) yang berbeda tergantung kurikulum. Pelatihan 1 hari setara dengan 8-10 JP, pelatihan 2 hari 16-20 JP, dan seterusnya. Total kewajiban ASN adalah 20 JP per tahun. Wahana Totalita menerbitkan sertifikat yang mencantumkan jumlah JP, sehingga peserta dapat menggunakannya sebagai bukti pemenuhan kewajiban pengembangan kompetensi yang dilaporkan ke Biro SDM instansi masing-masing.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apakah bisa diselenggarakan secara in-house di kantor instansi kami?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Ya, ini justru format yang paling banyak dipilih instansi pemerintah dan BUMN. Pelatihan in-house berarti seluruh peserta dari instansi Anda, materi disesuaikan dengan konteks dan kebutuhan organisasi, dan diselenggarakan di lokasi yang Anda tentukan. Wahana Totalita menyediakan trainer, modul, sertifikat, dan semua kebutuhan administrasi termasuk laporan pelaksanaan untuk kebutuhan pelaporan SIMPEG/BKN. Minimum peserta in-house: 15 orang.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apakah pelatihan ini bisa masuk mekanisme pengadaan langsung LPSE?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Ya. Wahana Totalita terdaftar di LPSE dan PADI UMKM untuk kategori Pendidikan dan Pelatihan (Jasa Konsultan). Paket pelatihan manajemen dan SDM yang nilainya di bawah Rp 200 juta dapat diproses melalui pengadaan langsung (PL). Kami menyiapkan semua dokumen yang dibutuhkan: surat penawaran, RAB, profil perusahaan, NIB, NPWP, akta, dan laporan pelaksanaan untuk proses SPJ.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apa saja topik yang paling banyak diminta instansi pemerintah?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Topik yang paling sering diminta instansi pemerintah dan BUMN: (1) Kepemimpinan Transformasional untuk Pejabat Eselon III dan IV; (2) Pelayanan Prima dan Komunikasi Publik untuk staf front-office; (3) Manajemen Konflik dan Mediasi; (4) Manajemen Keuangan Dasar untuk non-keuangan; (5) Public Speaking dan Presentasi Efektif; (6) Manajemen Waktu dan Produktivitas; (7) Team Building dan Kolaborasi; (8) Manajemen Perubahan (Change Management) untuk reformasi birokrasi.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apakah sertifikat pelatihan manajemen dari Wahana Totalita diakui?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Sertifikat Wahana Totalita diterbitkan oleh PT Kreasi Ultimate Berjaya yang memiliki legalitas lengkap (NIB, NPWP, Akta Notaris). Untuk pelatihan soft skills dan manajemen, sertifikat ini diakui sebagai bukti pengembangan kompetensi non-sertifikasi dan dapat digunakan untuk pelaporan pengembangan kompetensi ASN ke Biro SDM. Untuk kompetensi teknis yang memerlukan sertifikasi BNSP atau Kemnaker, kami juga menyediakan program sertifikasi resmi yang terpisah.'],
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
<section style="background:linear-gradient(135deg,#0A4A2E 0%,#1a3a5c 60%,#2d1a4a 100%);color:#fff;padding:60px 20px 50px;">
  <div style="max-width:900px;margin:0 auto;">
    <nav aria-label="breadcrumb" style="font-size:0.85rem;opacity:0.8;margin-bottom:16px;">
      <a href="/" style="color:#f5c06a;">Beranda</a> &rsaquo;
      <a href="/pelatihan/" style="color:#f5c06a;">Pelatihan</a> &rsaquo;
      <span>Manajemen &amp; Pengembangan SDM</span>
    </nav>
    <h1 style="font-size:clamp(1.6rem,4vw,2.4rem);font-weight:700;margin:0 0 16px;">
      Pelatihan Manajemen &amp; Pengembangan SDM
    </h1>
    <p style="font-size:1.1rem;opacity:0.92;max-width:720px;margin:0 0 10px;line-height:1.7;">
      Program pengembangan kompetensi manajerial dan sosio-kultural untuk ASN, BUMN, dan swasta — mulai kepemimpinan, komunikasi, pelayanan publik, hingga manajemen keuangan dan SDM. Sesuai kewajiban 20 JP per tahun per UU ASN No. 5/2014.
    </p>
    <div style="display:flex;flex-wrap:wrap;gap:10px;margin:20px 0 28px;">
      <span style="background:rgba(255,255,255,0.15);padding:6px 14px;border-radius:20px;font-size:0.85rem;">✓ LPSE &amp; PADI Terdaftar</span>
      <span style="background:rgba(255,255,255,0.15);padding:6px 14px;border-radius:20px;font-size:0.85rem;">✓ In-house &amp; Public Training</span>
      <span style="background:rgba(255,255,255,0.15);padding:6px 14px;border-radius:20px;font-size:0.85rem;">✓ Sertifikat Resmi + Laporan</span>
      <span style="background:rgba(255,255,255,0.15);padding:6px 14px;border-radius:20px;font-size:0.85rem;">✓ Pengadaan Langsung &lt; Rp 200 juta</span>
    </div>
    <a href="https://wa.me/628122969435?text=Halo%2C+saya+ingin+konsultasi+program+pelatihan+manajemen+dan+pengembangan+SDM+untuk+instansi+kami."
       target="_blank" rel="noopener"
       style="display:inline-block;background:#C6621C;color:#fff;padding:14px 32px;border-radius:6px;font-weight:700;text-decoration:none;font-size:1rem;">
      Konsultasi Program Gratis
    </a>
  </div>
</section>

<main style="max-width:960px;margin:0 auto;padding:40px 20px 60px;">

  <!-- REGULASI -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Dasar Hukum Pengembangan Kompetensi ASN
    </h2>
    <p style="line-height:1.8;color:#333;margin-bottom:20px;">
      Pengembangan kompetensi bukan sekadar program pilihan — ini <strong>kewajiban hukum</strong> bagi setiap instansi pemerintah. Anggaran diklat yang tidak terserap adalah anggaran yang terbuang, dan kompetensi pegawai yang stagnan adalah risiko birokrasi nyata.
    </p>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:16px;">
      <?php
      $regs = [
        ['UU No. 5/2014','ASN — Pasal 70: setiap PNS berhak dan wajib mengikuti pengembangan kompetensi minimal <strong>20 JP per tahun</strong>. Instansi wajib menyusun rencana pengembangan kompetensi dalam RKA.','#e8f4eb'],
        ['PP No. 17/2020','Manajemen PNS — mengatur jenis pengembangan kompetensi: pendidikan, pelatihan klasikal, non-klasikal (e-learning, coaching, mentoring, magang), dan pertukaran PNS-Swasta.','#e8f0f7'],
        ['PermenpanRB No. 13/2022','Pengembangan kompetensi mencakup 3 jenis: (1) Kompetensi Teknis, (2) Kompetensi Manajerial (kepemimpinan, perencanaan, pengorganisasian), (3) Kompetensi Sosio-kultural (komunikasi, pelayanan publik, kolaborasi).','#f7f4e8'],
        ['Perpres No. 81/2010','Grand Design Reformasi Birokrasi 2010–2025 — pengembangan SDM aparatur sebagai pilar utama reformasi birokrasi Indonesia. Pelatihan kepemimpinan dan manajemen perubahan termasuk prioritas nasional.','#f7ece8'],
      ];
      foreach ($regs as $r): ?>
      <div style="background:<?php echo $r[2]; ?>;border-radius:8px;padding:18px;border-left:4px solid #0A4A2E;">
        <div style="font-weight:700;color:#0A4A2E;margin-bottom:8px;font-size:0.9rem;"><?php echo $r[0]; ?></div>
        <div style="color:#444;font-size:0.87rem;line-height:1.65;"><?php echo $r[1]; ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- 5 KLASTER PROGRAM -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:24px;">
      5 Klaster Program Pengembangan Kompetensi
    </h2>
    <?php
    $clusters = [
      [
        'no'    => '1',
        'icon'  => '🎯',
        'title' => 'Kepemimpinan & Manajerial',
        'color' => '#f0f7f3',
        'border'=> '#0A4A2E',
        'topics'=> ['Kepemimpinan Transformasional', 'Manajemen Perubahan (Change Management)', 'Pengambilan Keputusan Strategis', 'Manajemen Konflik dan Negosiasi', 'Coaching & Mentoring untuk Manajer', 'Perencanaan dan Evaluasi Kinerja (SKP/LAKIP)'],
        'target'=> 'Pejabat eselon II–IV, kepala unit, supervisor, calon pemimpin.',
      ],
      [
        'no'    => '2',
        'icon'  => '💬',
        'title' => 'Komunikasi & Interpersonal',
        'color' => '#fff8f0',
        'border'=> '#C6621C',
        'topics'=> ['Public Speaking & Presentasi Efektif', 'Komunikasi Asertif di Tempat Kerja', 'Penulisan Dinas dan Surat Resmi', 'Fasilitasi Rapat yang Produktif', 'Komunikasi Lintas Generasi (Gen Z di ASN)', 'Media Relations untuk Humas Instansi'],
        'target'=> 'Semua level pegawai, staf humas, sekretaris, bendahara, arsiparis.',
      ],
      [
        'no'    => '3',
        'icon'  => '🤝',
        'title' => 'Pelayanan Publik & Customer Service',
        'color' => '#f0f7f3',
        'border'=> '#0A4A2E',
        'topics'=> ['Pelayanan Prima (Service Excellence) ASN', 'Penanganan Komplain Masyarakat', 'Etika Pegawai dan Kode Etik ASN', 'Standard Operating Procedure Pelayanan', 'Membangun Budaya Inovatif di Instansi', 'Zona Integritas dan WBK/WBBM'],
        'target'=> 'Staf front-office, petugas loket, customer service, pegawai pelayanan publik.',
      ],
      [
        'no'    => '4',
        'icon'  => '📊',
        'title' => 'Manajemen Keuangan & Administrasi',
        'color' => '#fff8f0',
        'border'=> '#C6621C',
        'topics'=> ['Manajemen Keuangan Dasar untuk Non-Keuangan', 'Perencanaan Anggaran dan DIPA', 'Pengadaan Barang/Jasa Pemerintah (dasar)', 'Tata Kelola Arsip dan Dokumen', 'Laporan Keuangan Instansi (SAKIP/LAKIP)', 'Manajemen Risiko Organisasi Publik'],
        'target'=> 'Staf administrasi, bendahara, pejabat pengadaan, pengelola BMN.',
      ],
      [
        'no'    => '5',
        'icon'  => '👥',
        'title' => 'Manajemen SDM & Pengembangan Organisasi',
        'color' => '#f0f7f3',
        'border'=> '#0A4A2E',
        'topics'=> ['Manajemen Talenta (Talent Management)', 'Analisis Jabatan dan Evaluasi Jabatan', 'Penilaian Kinerja Pegawai (SKP Baru PP 30/2019)', 'Perencanaan Kebutuhan Pegawai (ABK)', 'Budaya Organisasi dan Employee Engagement', 'Manajemen Pengetahuan (Knowledge Management)'],
        'target'=> 'Biro SDM, Bagian Kepegawaian, HR BUMN, analis jabatan.',
      ],
    ];
    foreach ($clusters as $c): ?>
    <div style="background:<?php echo $c['color']; ?>;border-radius:10px;padding:22px;margin-bottom:18px;border-left:5px solid <?php echo $c['border']; ?>;">
      <h3 style="color:#0A4A2E;margin:0 0 14px;font-size:1.05rem;display:flex;align-items:center;gap:10px;">
        <span style="font-size:1.4rem;"><?php echo $c['icon']; ?></span>
        Klaster <?php echo $c['no']; ?>: <?php echo $c['title']; ?>
      </h3>
      <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:8px;margin-bottom:14px;">
        <?php foreach ($c['topics'] as $t): ?>
        <div style="background:rgba(255,255,255,0.7);border-radius:5px;padding:8px 12px;font-size:0.88rem;color:#333;border-left:3px solid <?php echo $c['border']; ?>;">
          <?php echo $t; ?>
        </div>
        <?php endforeach; ?>
      </div>
      <div style="font-size:0.85rem;color:#666;font-style:italic;">
        <strong style="color:#0A4A2E;">Target peserta:</strong> <?php echo $c['target']; ?>
      </div>
    </div>
    <?php endforeach; ?>
  </section>

  <!-- FORMAT PELATIHAN -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:24px;">
      Format Penyelenggaraan
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px;">
      <?php
      $formats = [
        ['🏢','In-House Training','Diselenggarakan di kantor atau aula instansi Anda. Materi disesuaikan dengan kebutuhan dan konteks organisasi. Minimum 15 peserta. Paling efisien secara anggaran untuk kelompok besar.','#0A4A2E'],
        ['🏛️','Public Training','Jadwal terbuka — peserta dari berbagai instansi bergabung. Cocok untuk 1–5 orang dari satu instansi. Kesempatan networking lintas instansi. Diselenggarakan di Yogyakarta.','#1a6b42'],
        ['💻','Blended Learning','Kombinasi sesi tatap muka dan modul e-learning. Materi pre-training dikirim H-7. Sesi tatap muka fokus pada praktik dan diskusi kasus. Cocok untuk peserta dengan jadwal padat.','#0A3A5A'],
        ['🏕️','Residential Training','Format 2–3 hari dengan penginapan — maksimalkan fokus dan team building. Wahana menyediakan paket all-in termasuk akomodasi, konsumsi, dan aktivitas. Sinergi dengan program outbound.','#5a2d0a'],
      ];
      foreach ($formats as $f): ?>
      <div style="background:<?php echo $f[3]; ?>;color:#fff;border-radius:10px;padding:20px;">
        <div style="font-size:1.8rem;margin-bottom:10px;"><?php echo $f[0]; ?></div>
        <div style="font-weight:700;font-size:1rem;margin-bottom:10px;"><?php echo $f[1]; ?></div>
        <p style="font-size:0.87rem;line-height:1.6;opacity:0.9;margin:0;"><?php echo $f[2]; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- PROGRAM CARDS -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:24px;">
      Program Unggulan
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:20px;">
      <?php
      $programs = [
        ['Kepemimpinan Transformasional','1–2 hari | Semua level manajerial. Teori kepemimpinan modern, gaya kepemimpinan situasional, membangun visi bersama, dan mendorong perubahan dari dalam organisasi.'],
        ['Pelayanan Prima (Service Excellence)','1 hari | Staf pelayanan publik. Standar pelayanan 5C (Cepat, Cermat, Cerdas, Cermat, Care), penanganan komplain, dan SOP pelayanan prima berbasis ZI/WBK.'],
        ['Public Speaking & Presentasi Efektif','1–2 hari | Semua level. Teknik berbicara di depan umum, desain slide yang komunikatif, mengelola gugup, dan menyampaikan pesan dengan dampak.'],
        ['Manajemen Konflik & Negosiasi','1 hari | Pejabat & supervisor. Pemetaan konflik, teknik deeskalasi, win-win negotiation, dan mediasi internal organisasi.'],
        ['Manajemen Waktu & Produktivitas','1 hari | Semua level. Matriks Eisenhower, teknik Pomodoro, digital distraction management, dan membangun sistem kerja personal yang berkelanjutan.'],
        ['Manajemen SDM untuk Non-HR','1 hari | Kepala unit & eselon IV. Pemahaman dasar SKP, wawancara kinerja, coaching pegawai, dan mengelola dinamika tim.'],
        ['Budaya Organisasi & Change Management','1–2 hari | Eselon II–III & tim reformasi birokrasi. Diagnosis budaya organisasi, model perubahan Kotter 8-step, mengelola resistensi, dan sustaining change.'],
        ['Penulisan Dinas & Surat Resmi','1 hari | Staf administrasi & sekretaris. Tata naskah dinas (PermenpanRB 80/2012), format surat resmi, notula rapat, laporan dinas, dan nota dinas.'],
      ];
      foreach ($programs as $p): ?>
      <div style="background:#fff;border:1px solid #ddd;border-radius:8px;overflow:hidden;display:flex;flex-direction:column;">
        <div style="background:#0A4A2E;color:#fff;padding:12px 16px;">
          <div style="font-weight:600;font-size:0.93rem;"><?php echo $p[0]; ?></div>
        </div>
        <div style="padding:14px 16px;flex:1;">
          <p style="color:#555;font-size:0.87rem;line-height:1.6;margin:0;"><?php echo $p[1]; ?></p>
        </div>
        <div style="padding:0 16px 16px;">
          <a href="<?php echo 'https://wa.me/628122969435?text=Halo%2C+saya+ingin+info+program+' . urlencode($p[0]) . '+untuk+instansi+kami.+Mohon+kirim+proposal+dan+harga.'; ?>"
             target="_blank" rel="noopener"
             style="display:block;text-align:center;background:#C6621C;color:#fff;padding:10px;border-radius:5px;text-decoration:none;font-weight:600;font-size:0.88rem;">
            Minta Proposal &amp; Harga
          </a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- PROCUREMENT INSTANSI -->
  <section style="margin-bottom:48px;background:#f0f7f3;border-radius:10px;padding:30px;">
    <h2 style="color:#0A4A2E;font-size:1.4rem;margin:0 0 16px;">
      Mekanisme Pengadaan untuk Instansi Pemerintah &amp; BUMN
    </h2>
    <p style="line-height:1.8;color:#333;margin-bottom:20px;">
      Wahana Totalita memahami proses administrasi pengadaan dari sisi instansi. Semua dokumen siap kami sediakan sehingga proses SPJ berjalan lancar.
    </p>
    <div style="overflow-x:auto;">
      <table style="width:100%;border-collapse:collapse;font-size:0.9rem;background:#fff;border-radius:8px;overflow:hidden;">
        <thead>
          <tr style="background:#0A4A2E;color:#fff;">
            <th style="padding:12px 16px;text-align:left;">Kebutuhan Instansi</th>
            <th style="padding:12px 16px;text-align:left;">Yang Kami Sediakan</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $proc = [
            ['Surat Penawaran Harga','Surat penawaran resmi dengan kop PT Kreasi Ultimate Berjaya, ditandatangani dan bermaterai'],
            ['RAB (Rencana Anggaran Biaya)','Rincian biaya transparan: honorarium trainer, modul, sertifikat, konsumsi, dan lain-lain'],
            ['Dokumen Legalitas','NIB (OSS), NPWP, Akta Pendirian, SK Kemenkumham, SIUP — tersedia lengkap dan terkini'],
            ['NPWP & Faktur Pajak','Faktur pajak resmi untuk kebutuhan pembukuan dan pelaporan pajak instansi'],
            ['Laporan Pelaksanaan','Laporan lengkap: daftar hadir, foto kegiatan, materi pelatihan, dan evaluasi peserta'],
            ['Sertifikat Peserta','Sertifikat individual bermaterai dengan nama, topik, tanggal, dan jumlah JP tercantum'],
            ['BAST (Berita Acara)','Berita Acara Serah Terima pelaksanaan kegiatan untuk kelengkapan berkas SPJ'],
          ];
          foreach ($proc as $i => $p):
            $bg = $i%2===0?'#fff':'#f9f9f9';
          ?>
          <tr style="background:<?php echo $bg; ?>;">
            <td style="padding:10px 16px;border-bottom:1px solid #eee;font-weight:600;color:#0A4A2E;"><?php echo $p[0]; ?></td>
            <td style="padding:10px 16px;border-bottom:1px solid #eee;color:#444;font-size:0.87rem;"><?php echo $p[1]; ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </section>

  <!-- ALUR KERJA -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:24px;">
      Alur Kerja — Dari Konsultasi ke Sertifikat
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(140px,1fr));gap:0;">
      <?php
      $steps = [
        ['01','Konsultasi Kebutuhan','Identifikasi gap kompetensi, target peserta, jadwal, dan anggaran.'],
        ['02','Proposal & Penawaran','Kami kirim proposal lengkap + RAB dalam 1 hari kerja.'],
        ['03','Finalisasi & SPK','Tandatangani SPK/kontrak. Kami siapkan semua materi & logistik.'],
        ['04','Pelaksanaan','Training dijalankan sesuai jadwal — trainer berpengalaman, modul siap.'],
        ['05','Sertifikat & Laporan','Sertifikat peserta + laporan lengkap dikirim maksimal 3 hari setelah training.'],
        ['06','SPJ Beres','Semua dokumen untuk SPJ tersedia lengkap — BAST, faktur pajak, laporan.'],
      ];
      foreach ($steps as $i => $s):
        $is_last = $i === count($steps)-1;
      ?>
      <div style="text-align:center;padding:20px 10px;position:relative;">
        <?php if (!$is_last): ?>
        <div style="position:absolute;top:35px;right:-1px;width:2px;height:30px;background:#C6621C;display:none;"></div>
        <?php endif; ?>
        <div style="width:50px;height:50px;background:#C6621C;color:#fff;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:1rem;margin:0 auto 12px;"><?php echo $s[0]; ?></div>
        <div style="font-weight:600;color:#0A4A2E;margin-bottom:6px;font-size:0.9rem;"><?php echo $s[1]; ?></div>
        <p style="color:#555;font-size:0.82rem;line-height:1.5;margin:0;"><?php echo $s[2]; ?></p>
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
        ['/outbound/','Outbound & Team Building','Penguatan tim secara experiential — pelengkap sempurna setelah pelatihan manajemen.'],
        ['/event-organizer/','Event Organizer Kedinasan','Seminar, workshop, dan rapat dinas yang dikelola profesional.'],
        ['/wisata-karyawan/','Wisata & Gathering Karyawan','Paket wisata dan rekreasi untuk peningkatan motivasi pegawai.'],
        ['/smk3/','SMK3 & ISO 45001','Sistem Manajemen K3 untuk instansi dan BUMN.'],
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
      ['Apakah pelatihan manajemen dan soft skills wajib untuk ASN?','Ya. UU ASN No. 5/2014 mewajibkan setiap PNS mengikuti pengembangan kompetensi minimal 20 JP per tahun. Pelatihan manajemen, kepemimpinan, dan soft skills termasuk dalam kompetensi manajerial dan sosio-kultural yang wajib dipenuhi. Anggaran diatur tersendiri dalam DIPA instansi.'],
      ['Berapa jam pelajaran (JP) yang diakui dari pelatihan ini?','Pelatihan 1 hari setara 8–10 JP, pelatihan 2 hari 16–20 JP. Wahana menerbitkan sertifikat yang mencantumkan jumlah JP sehingga peserta dapat menggunakannya sebagai bukti pemenuhan kewajiban pengembangan kompetensi yang dilaporkan ke Biro SDM.'],
      ['Apakah bisa diselenggarakan secara in-house di kantor instansi kami?','Ya, dan ini format yang paling banyak dipilih. Seluruh peserta dari instansi Anda, materi disesuaikan konteks organisasi, diselenggarakan di lokasi yang Anda tentukan. Wahana menyediakan trainer, modul, sertifikat, dan laporan lengkap. Minimum peserta in-house: 15 orang.'],
      ['Apakah program ini bisa masuk mekanisme pengadaan langsung LPSE?','Ya. Wahana Totalita terdaftar di LPSE dan PADI UMKM untuk kategori Pendidikan dan Pelatihan. Paket di bawah Rp 200 juta dapat diproses melalui pengadaan langsung. Semua dokumen SPJ tersedia: surat penawaran, RAB, BAST, faktur pajak, dan laporan pelaksanaan.'],
      ['Apa saja topik yang paling banyak diminta instansi pemerintah?','Topik terpopuler: Kepemimpinan Transformasional (eselon III–IV), Pelayanan Prima untuk front-office, Public Speaking & Presentasi, Manajemen Konflik, Manajemen Waktu & Produktivitas, Penulisan Dinas, Budaya ZI/WBK, dan Manajemen SDM untuk kepala unit.'],
      ['Apakah sertifikat dari Wahana Totalita diakui untuk pelaporan SKP/SIMPEG?','Sertifikat Wahana Totalita diterbitkan oleh PT Kreasi Ultimate Berjaya (legalitas lengkap: NIB, NPWP, Akta). Diakui sebagai bukti pengembangan kompetensi non-sertifikasi untuk pelaporan ke Biro SDM dan SIMPEG. Untuk kompetensi yang memerlukan sertifikasi BNSP atau Kemnaker, kami memiliki program sertifikasi resmi yang terpisah.'],
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
  <section style="background:linear-gradient(135deg,#0A4A2E,#1a3a5c);color:#fff;border-radius:12px;padding:40px;text-align:center;">
    <h2 style="margin:0 0 12px;font-size:1.6rem;">Siap Meningkatkan Kompetensi Pegawai Anda?</h2>
    <p style="opacity:0.9;margin:0 0 10px;line-height:1.7;max-width:600px;margin-left:auto;margin-right:auto;">
      Konsultasikan kebutuhan pelatihan instansi Anda. Kami bantu identifikasi gap kompetensi, susun proposal yang sesuai anggaran, dan pastikan proses SPJ berjalan lancar.
    </p>
    <p style="opacity:0.75;font-size:0.9rem;margin:0 0 24px;">Minimum 15 peserta untuk in-house · Respon proposal dalam 1 hari kerja</p>
    <a href="https://wa.me/628122969435?text=Halo%2C+saya+ingin+konsultasi+program+pelatihan+manajemen+dan+pengembangan+SDM+untuk+instansi+kami.+Mohon+kirim+proposal."
       target="_blank" rel="noopener"
       style="display:inline-block;background:#C6621C;color:#fff;padding:14px 36px;border-radius:6px;font-weight:700;text-decoration:none;font-size:1.05rem;">
      WhatsApp: 0812-2969-435
    </a>
  </section>

</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
</body>
</html>
