<?php
require_once __DIR__ . '/config.php';
$s = get_all_settings();
// Hub: Pelatihan Teknologi Informasi & Digital untuk ASN / Instansi
$canonical = 'https://wahanatotalita.com/pelatihan-teknologi-informasi/';
$meta_title = 'Pelatihan Teknologi Informasi & Digital untuk ASN Yogyakarta — Wahana Totalita';
$meta_desc  = 'Pelatihan IT, komputer, SPBE, transformasi digital, dan keamanan siber untuk ASN dan pegawai pemerintah di Yogyakarta. Sesuai Perpres 95/2018, in-house, dokumen SPJ lengkap.';

$schema = [
  [
    '@context' => 'https://schema.org',
    '@type'    => 'BreadcrumbList',
    'itemListElement' => [
      ['@type'=>'ListItem','position'=>1,'name'=>'Beranda','item'=>'https://wahanatotalita.com/'],
      ['@type'=>'ListItem','position'=>2,'name'=>'Pelatihan','item'=>'https://wahanatotalita.com/pelatihan/'],
      ['@type'=>'ListItem','position'=>3,'name'=>'Pelatihan Teknologi Informasi','item'=>$canonical],
    ],
  ],
  [
    '@context' => 'https://schema.org',
    '@type'    => 'FAQPage',
    'mainEntity' => [
      [
        '@type' => 'Question',
        'name'  => 'Apa itu SPBE dan mengapa instansi pemerintah wajib menerapkannya?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'SPBE (Sistem Pemerintahan Berbasis Elektronik) adalah penyelenggaraan pemerintahan yang memanfaatkan teknologi informasi dan komunikasi untuk memberikan layanan kepada masyarakat, sesama instansi pemerintah, dan aparatur sipil negara. Berdasarkan Perpres 95/2018 tentang SPBE, seluruh instansi pemerintah pusat dan daerah diwajibkan menerapkan SPBE. Tujuannya: meningkatkan kualitas layanan publik, efisiensi birokrasi, transparansi, dan akuntabilitas pemerintahan. Evaluasi SPBE dilakukan Kemenpan-RB setiap tahun — nilainya berpengaruh pada penilaian kinerja instansi dan kepala daerah. Pelatihan digital untuk ASN adalah prasyarat utama keberhasilan transformasi SPBE.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apa saja kompetensi digital yang wajib dimiliki ASN di era SPBE?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Berdasarkan Surat Edaran MenpanRB dan roadmap transformasi digital pemerintah, kompetensi digital yang wajib dimiliki ASN meliputi: (1) Literasi digital dasar: penggunaan aplikasi perkantoran (Office 365/Google Workspace), email resmi pemerintah, dan manajemen file; (2) Keamanan siber dasar: mengenali phishing, pengelolaan kata sandi, dan proteksi data; (3) Penggunaan aplikasi pemerintah: SIPD, SIMPEG, e-Office, SPSE, SIMDA sesuai fungsi jabatan; (4) Komunikasi digital: video conference, kolaborasi online, dan etika digital; (5) Analisis data dasar: membaca laporan dashboard, membuat visualisasi sederhana, dan interpretasi data kinerja. Kompetensi ini masuk dalam pengembangan kompetensi ASN (20 JP/tahun) sesuai UU ASN 5/2014.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apa ancaman keamanan siber yang paling sering menimpa instansi pemerintah?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Ancaman siber yang paling sering menimpa instansi pemerintah Indonesia: (1) Phishing email — email palsu yang meniru tampilan instansi resmi atau vendor untuk mencuri kredensial login; (2) Ransomware — malware yang mengenkripsi data dan meminta tebusan (pernah menyerang instansi besar di Indonesia); (3) Credential stuffing — menggunakan kombinasi username/password yang bocor dari pelanggaran data lain untuk mencoba login ke sistem pemerintah; (4) Insider threat — kebocoran data oleh pegawai yang disengaja atau tidak; (5) Social engineering — manipulasi psikologis untuk mendapatkan akses atau informasi sensitif. BSSN (Badan Siber dan Sandi Negara) melaporkan jutaan serangan siber ke instansi pemerintah setiap tahun.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apakah pelatihan IT dari Wahana Totalita dapat digunakan untuk pemenuhan JP ASN?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Ya. Pelatihan teknologi informasi dan kompetensi digital termasuk dalam kategori pengembangan kompetensi teknis ASN yang dapat digunakan untuk memenuhi kewajiban 20 JP per tahun sesuai UU ASN 5/2014 dan PP 17/2020. Sertifikat pelatihan Wahana Totalita mencantumkan jumlah JP, topik, dan ditandatangani oleh penyelenggara. Untuk validasi formal di sistem informasi pengembangan kompetensi (SIMPEG/Simdiklat) instansi, koordinasikan dengan BKPSDM atau Bagian Kepegawaian masing-masing instansi.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apa itu e-Office dan aplikasi apa saja yang umum digunakan instansi pemerintah?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'e-Office atau Sistem Informasi Manajemen Perkantoran Elektronik adalah aplikasi untuk otomasi surat menyurat dan disposisi secara digital — menggantikan proses manual kertas. Aplikasi e-Office yang umum di pemerintah daerah: TNDE (Tata Naskah Dinas Elektronik) dari Kemenpan-RB, Srikandi (sistem persuratan Kominfo), dan berbagai aplikasi e-Office yang dikembangkan masing-masing daerah. Selain e-Office, aplikasi wajib yang perlu dikuasai ASN tergantung fungsinya: SIPD (keuangan daerah), SIMPEG/BKN (kepegawaian), SPSE/LPSE (pengadaan), SiRUP (rencana pengadaan), dan E-Lapkin (laporan kinerja). Pelatihan Wahana mencakup orientasi dan praktik penggunaan aplikasi-aplikasi ini.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Berapa lama dan format apa pelatihan IT yang tersedia untuk instansi?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Format pelatihan IT yang tersedia: (1) Workshop 1 hari (8 JP): fokus pada satu topik atau aplikasi spesifik — misalnya "Microsoft Office untuk Perkantoran" atau "Keamanan Siber Dasar"; (2) Bootcamp 2 hari (14 JP): gabungan beberapa topik digital yang saling berkaitan; (3) Pelatihan berjenjang (multi-sesi): seri pelatihan mingguan/bulanan untuk transformasi digital bertahap; (4) Blended learning: pre-modul online + 1 hari tatap muka hands-on; (5) Refresher 4 jam: update tools atau fitur baru yang perlu diketahui tim. Semua format tersedia in-house di kantor instansi atau di venue yang disediakan Wahana — dilengkapi dokumen SPJ lengkap untuk pencairan anggaran.'],
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
<section style="background:linear-gradient(135deg,#0A2A5A 0%,#0A4A2E 70%,#0a3a4a 100%);color:#fff;padding:60px 20px 50px;">
  <div style="max-width:900px;margin:0 auto;">
    <nav aria-label="breadcrumb" style="font-size:0.85rem;opacity:0.8;margin-bottom:16px;">
      <a href="/" style="color:#a0d8f5;">Beranda</a> &rsaquo;
      <a href="/pelatihan/" style="color:#a0d8f5;">Pelatihan</a> &rsaquo;
      <span>Teknologi Informasi</span>
    </nav>
    <h1 style="font-size:clamp(1.6rem,4vw,2.4rem);font-weight:700;margin:0 0 16px;">
      Pelatihan Teknologi Informasi &amp; Transformasi Digital untuk ASN
    </h1>
    <p style="font-size:1.05rem;opacity:0.92;max-width:720px;margin:0 0 10px;line-height:1.7;">
      Program pelatihan IT dan kompetensi digital untuk ASN dan pegawai instansi pemerintah: literasi digital, Microsoft Office, keamanan siber, SPBE, e-Office, dan analisis data — mendukung kewajiban transformasi digital pemerintah sesuai <strong>Perpres 95/2018 tentang SPBE</strong>. In-house di instansi Anda, dokumen SPJ lengkap, bersertifikat.
    </p>
    <div style="display:flex;flex-wrap:wrap;gap:10px;margin:18px 0 28px;">
      <span style="background:rgba(255,255,255,0.16);padding:6px 14px;border-radius:20px;font-size:0.85rem;">✓ Perpres 95/2018 SPBE</span>
      <span style="background:rgba(255,255,255,0.16);padding:6px 14px;border-radius:20px;font-size:0.85rem;">✓ Poin JP ASN (UU 5/2014)</span>
      <span style="background:rgba(255,255,255,0.16);padding:6px 14px;border-radius:20px;font-size:0.85rem;">✓ LPSE &amp; PADI Terdaftar</span>
      <span style="background:rgba(255,255,255,0.16);padding:6px 14px;border-radius:20px;font-size:0.85rem;">✓ Semua level kompetensi</span>
    </div>
    <a href="https://wa.me/628122969435?text=Halo%2C+saya+ingin+info+pelatihan+teknologi+informasi+dan+digital+untuk+ASN%2Finstansi+kami+di+Yogyakarta."
       target="_blank" rel="noopener"
       style="display:inline-block;background:#C6621C;color:#fff;padding:14px 32px;border-radius:6px;font-weight:700;text-decoration:none;font-size:1rem;">
      Konsultasi Program Digital ASN
    </a>
  </div>
</section>

<main style="max-width:960px;margin:0 auto;padding:40px 20px 60px;">

  <!-- SPBE CONTEXT -->
  <section style="margin-bottom:48px;background:#e8f0ff;border-radius:10px;padding:28px;border-left:6px solid #0A2A5A;">
    <h2 style="color:#0A2A5A;font-size:1.4rem;margin:0 0 14px;">Konteks: Mengapa Pelatihan Digital ASN Mendesak?</h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:14px;">
      <?php
      $context = [
        ['📋','Perpres 95/2018 SPBE','Seluruh instansi wajib evaluasi SPBE tahunan oleh MenpanRB — nilai SPBE berpengaruh langsung pada penilaian kinerja instansi dan kepala daerah.'],
        ['👨‍💻','20 JP/Tahun per UU ASN','Setiap ASN wajib mengembangkan kompetensi minimal 20 JP per tahun — kompetensi digital adalah salah satu prioritas nasional.'],
        ['🔒','Ancaman Siber Meningkat','BSSN melaporkan jutaan serangan siber per tahun ke instansi pemerintah — pelatihan keamanan siber bukan lagi pilihan.'],
        ['📊','Efisiensi Anggaran','Instansi dengan ASN kompeten digital mampu mengurangi ketergantungan pada vendor eksternal dan meningkatkan produktivitas layanan publik.'],
      ];
      foreach ($context as $c): ?>
      <div style="background:#fff;border-radius:8px;padding:16px;">
        <div style="font-size:1.5rem;margin-bottom:8px;"><?php echo $c[0]; ?></div>
        <div style="font-weight:700;color:#0A2A5A;margin-bottom:4px;font-size:0.9rem;"><?php echo $c[1]; ?></div>
        <p style="color:#555;font-size:0.84rem;line-height:1.5;margin:0;"><?php echo $c[2]; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- KLASTER KOMPETENSI -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Klaster Kompetensi Digital yang Tersedia
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(270px,1fr));gap:20px;">
      <?php
      $clusters = [
        ['💻','Literasi Digital & Produktivitas Perkantoran','Microsoft Office 365 (Word, Excel, PowerPoint, Teams), Google Workspace, manajemen email dan kalender, cloud storage, dan kolaborasi online. Untuk semua level — dari dasar hingga mahir.'],
        ['🔒','Keamanan Siber untuk Non-IT (Awareness)','Mengenali dan menghindari phishing, pengelolaan kata sandi yang aman, proteksi data pribadi, etika digital, dan prosedur pelaporan insiden siber. Wajib untuk semua ASN.'],
        ['🏛️','Aplikasi Pemerintah (SPBE Tools)','Praktik penggunaan aplikasi pemerintah sesuai jabatan: SIPD, SIMPEG, e-Office/Srikandi, SPSE/LPSE, SiRUP, E-Lapkin, dan dashboard monitoring SPBE.'],
        ['📊','Analisis Data & Visualisasi Dasar','Mengolah dan memvisualisasikan data kinerja instansi: Excel Power Query, membaca dashboard BI, dasar statistik untuk laporan, dan presentasi data kepada pimpinan.'],
        ['🤖','AI & Teknologi Terkini untuk Pemerintah','Pemanfaatan AI (termasuk ChatGPT/Gemini) secara etis dan produktif untuk pekerjaan ASN, otomasi tugas berulang, dan isu integritas data dalam era AI.'],
        ['📱','Transformasi Digital & Change Management','Membangun mindset digital, mengelola perubahan budaya kerja menuju digital, komunikasi perubahan, dan quick wins transformasi SPBE di SKPD masing-masing.'],
      ];
      foreach ($clusters as $c): ?>
      <div style="background:#fff;border:1px solid #ddd;border-radius:10px;padding:20px;border-top:4px solid #0A2A5A;">
        <div style="font-size:1.8rem;margin-bottom:10px;"><?php echo $c[0]; ?></div>
        <div style="font-weight:700;color:#0A2A5A;margin-bottom:8px;font-size:0.95rem;"><?php echo $c[1]; ?></div>
        <p style="color:#555;font-size:0.87rem;line-height:1.6;margin:0;"><?php echo $c[2]; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- PROGRAM CARDS -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Program Pelatihan IT yang Tersedia
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(255px,1fr));gap:18px;">
      <?php
      $programs = [
        ['Microsoft Office 365 untuk ASN (Dasar-Mahir)','1–2 hari / 8–14 JP','Semua ASN. Word (surat dinas, laporan), Excel (data keuangan, absensi, RAB), PowerPoint (presentasi pimpinan), dan Teams (rapat daring).'],
        ['Keamanan Siber Awareness untuk ASN','Half-day / 4 JP','Semua ASN wajib. Phishing, password security, proteksi data, etika media sosial dinas, dan cara melapor insiden siber ke BSSN/CSIRT.'],
        ['Manajemen Data & Excel Lanjutan','1 hari / 8 JP','Staf keuangan, perencanaan, dan pelaporan. Pivot table, Power Query, formula lanjutan, dan membuat dashboard laporan otomatis.'],
        ['Sosialisasi & Praktik e-Office/Srikandi','Half-day / 4 JP','Seluruh staf yang menggunakan e-Office. Praktik buat surat, disposisi, arsip digital, dan tracking surat masuk/keluar.'],
        ['Pemanfaatan AI untuk Produktivitas ASN','Half-day / 4 JP','Semua ASN. Cara menggunakan AI (ChatGPT, Gemini) untuk membuat draft, analisis dokumen, dan meningkatkan produktivitas — plus isu etika dan integritas.'],
        ['Transformasi Digital & SPBE untuk Pimpinan','Half-day / 4 JP','Kepala Dinas, Camat, Kades, dan eselon II-III. Pemahaman SPBE, peran pimpinan dalam transformasi digital, dan evaluasi SPBE MenpanRB.'],
        ['Google Workspace untuk Kolaborasi Tim','1 hari / 8 JP','Tim yang menggunakan Google Workspace: Docs, Sheets, Drive, Meet, dan Forms. Kolaborasi real-time dan manajemen dokumen bersama.'],
        ['Analisis Data untuk Pengambilan Keputusan','1 hari / 8 JP','Kepala Bidang dan staf perencanaan. Membaca dan menginterpretasi data kinerja, membuat visualisasi, dan menyusun rekomendasi berbasis data.'],
      ];
      foreach ($programs as $p): ?>
      <div style="background:#f9f9f9;border:1px solid #e0e0e0;border-radius:8px;padding:18px;">
        <div style="font-weight:700;color:#0A2A5A;margin-bottom:6px;font-size:0.93rem;"><?php echo $p[0]; ?></div>
        <div style="font-size:0.82rem;color:#C6621C;font-weight:600;margin-bottom:6px;"><?php echo $p[1]; ?></div>
        <div style="font-size:0.83rem;color:#666;margin-bottom:14px;line-height:1.5;"><?php echo $p[2]; ?></div>
        <a href="https://wa.me/628122969435?text=Halo%2C+saya+tertarik+pelatihan+<?php echo urlencode($p[0]); ?>+untuk+instansi+kami.+Mohon+info+jadwal+dan+harga."
           target="_blank" rel="noopener"
           style="display:inline-block;background:#0A2A5A;color:#fff;padding:7px 16px;border-radius:4px;text-decoration:none;font-size:0.82rem;font-weight:600;">
          Tanya via WhatsApp →
        </a>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- KEAMANAN SIBER ANCAMAN -->
  <section style="margin-bottom:48px;background:#fff0f0;border-radius:10px;padding:28px;border-left:6px solid #C6621C;">
    <h2 style="color:#0A4A2E;font-size:1.4rem;margin:0 0 14px;">⚠ Ancaman Siber Paling Umum di Instansi Pemerintah</h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(230px,1fr));gap:14px;">
      <?php
      $threats = [
        ['🎣','Phishing Email','Email palsu mengatasnamakan instansi resmi, BPJS, atau bank — memancing ASN klik link berbahaya atau memasukkan password.'],
        ['🔐','Ransomware','Malware yang mengenkripsi seluruh data komputer dan jaringan — meminta tebusan untuk mengembalikan akses. Sudah menyerang instansi besar Indonesia.'],
        ['📱','Social Engineering','Manipulasi psikologis via telepon, pesan, atau tatap muka untuk mendapatkan informasi sensitif atau akses sistem.'],
        ['🔑','Credential Stuffing','Menggunakan kombinasi username/password yang bocor dari platform lain untuk mencoba login ke sistem pemerintah.'],
        ['💾','Insider Threat','Kebocoran data oleh ASN yang tidak sengaja (misconfiguration, salah kirim) atau disengaja (sabotase, korupsi data).'],
        ['🌐','Situs Palsu (Defacement)','Website instansi di-hack dan tampilan diubah untuk mempermalukan atau menyebarkan informasi palsu.'],
      ];
      foreach ($threats as $t): ?>
      <div style="background:#fff;border-radius:6px;padding:14px;border-top:3px solid #C6621C;">
        <div style="font-size:1.3rem;margin-bottom:6px;"><?php echo $t[0]; ?></div>
        <div style="font-weight:600;color:#C6621C;margin-bottom:4px;font-size:0.88rem;"><?php echo $t[1]; ?></div>
        <p style="color:#555;font-size:0.83rem;line-height:1.5;margin:0;"><?php echo $t[2]; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- SPJ TABLE -->
  <section style="margin-bottom:48px;background:#f0f7f3;border-radius:10px;padding:28px;">
    <h2 style="color:#0A4A2E;font-size:1.4rem;margin:0 0 14px;">Dokumen Pengadaan untuk Instansi</h2>
    <p style="color:#333;line-height:1.7;margin:0 0 16px;font-size:0.92rem;">LPSE dan PADI terdaftar kategori <strong>Pendidikan dan Pelatihan</strong>. Pengadaan langsung tanpa tender di bawah Rp 200 juta. Dokumen SPJ tersedia:</p>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:12px;">
      <?php
      $docs = ['Surat Penawaran Harga','RAB Rinci per Program','Faktur Pajak (PPN)','BAST Pelatihan','Daftar Hadir Peserta','Sertifikat Pelatihan','Dokumentasi Foto','Kuitansi Resmi'];
      foreach ($docs as $d): ?>
      <div style="background:#fff;border-radius:6px;padding:12px;border-left:3px solid #0A4A2E;font-size:0.86rem;color:#444;font-weight:600;"><?php echo $d; ?></div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- RELATED LINKS -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.4rem;border-bottom:2px solid #e0e0e0;padding-bottom:8px;margin-bottom:16px;">Pelatihan Lain untuk ASN</h2>
    <div style="display:flex;flex-wrap:wrap;gap:12px;">
      <?php
      $related = [
        ['/pelatihan-manajemen-sdm/','Pelatihan Manajemen SDM & Leadership'],
        ['/pelatihan-keuangan-daerah/','Pelatihan Keuangan Daerah & SPJ'],
        ['/pelatihan-pengadaan-barang-jasa/','Pelatihan PBJP Pemerintah'],
        ['/akomodasi/','Hotel & Akomodasi Diklat Instansi'],
      ];
      foreach ($related as $r): ?>
      <a href="<?php echo $r[0]; ?>" style="display:inline-block;background:#fff;border:1px solid #a0b8d0;border-radius:6px;padding:10px 16px;color:#0A2A5A;text-decoration:none;font-size:0.88rem;font-weight:600;" onmouseover="this.style.background='#e8f0ff'" onmouseout="this.style.background='#fff'"><?php echo $r[1]; ?></a>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- FAQ -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:24px;">Pertanyaan yang Sering Diajukan</h2>
    <?php
    $faqs = [
      ['Apa itu SPBE dan mengapa instansi wajib menerapkannya?','SPBE (Sistem Pemerintahan Berbasis Elektronik) — Perpres 95/2018 mewajibkan semua instansi pusat dan daerah. Evaluasi SPBE tahunan MenpanRB mempengaruhi penilaian kinerja instansi dan kepala daerah. Kompetensi digital ASN adalah fondasi keberhasilan SPBE.'],
      ['Kompetensi digital apa yang wajib dimiliki ASN?','Literasi digital dasar (Office, email), keamanan siber (phishing awareness), penggunaan aplikasi pemerintah (SIPD, e-Office, SPSE sesuai jabatan), komunikasi digital, dan analisis data sederhana. Masuk dalam pengembangan kompetensi 20 JP/tahun (UU ASN 5/2014).'],
      ['Ancaman siber apa yang paling sering menimpa instansi pemerintah?','Phishing email, ransomware, social engineering, credential stuffing, insider threat (kebocoran data ASN), dan defacement website. BSSN melaporkan jutaan serangan siber ke pemerintah setiap tahun.'],
      ['Apakah sertifikat pelatihan IT Wahana diakui untuk JP ASN?','Ya. Kompetensi digital masuk pengembangan kompetensi teknis ASN (20 JP/tahun). Sertifikat mencantumkan JP dan topik. Untuk validasi di SIMPEG/Simdiklat, koordinasikan dengan BKPSDM atau Bagian Kepegawaian instansi.'],
      ['Apa itu e-Office dan aplikasi pemerintah apa yang perlu dikuasai ASN?','e-Office/Srikandi = sistem surat dinas elektronik. Aplikasi lain per fungsi: SIPD (keuangan), SIMPEG/BKN (kepegawaian), SPSE/LPSE (pengadaan), SiRUP (rencana pengadaan), E-Lapkin (kinerja). Pelatihan Wahana mencakup orientasi dan praktik semua aplikasi ini.'],
      ['Format pelatihan IT apa yang tersedia?','Workshop 1 hari (8 JP), bootcamp 2 hari (14 JP), pelatihan berjenjang multi-sesi, blended learning (online + tatap muka), dan refresher 4 jam. In-house di kantor instansi atau venue Wahana. Semua format dilengkapi dokumen SPJ lengkap.'],
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
  <section style="background:linear-gradient(135deg,#0A2A5A,#0A4A2E);color:#fff;border-radius:12px;padding:40px;text-align:center;">
    <h2 style="margin:0 0 12px;font-size:1.6rem;">Tingkatkan Kompetensi Digital Tim ASN Anda</h2>
    <p style="opacity:0.9;margin:0 0 10px;line-height:1.7;max-width:580px;margin-left:auto;margin-right:auto;">
      Dari literasi digital dasar hingga keamanan siber dan analisis data — Wahana Totalita menyediakan pelatihan IT yang disesuaikan dengan kebutuhan instansi Anda, dilengkapi dokumen SPJ lengkap.
    </p>
    <p style="opacity:0.75;font-size:0.9rem;margin:0 0 24px;">LPSE &amp; PADI terdaftar · Pengadaan langsung &lt; Rp 200 juta · Sertifikat + SPJ lengkap</p>
    <a href="https://wa.me/628122969435?text=Halo%2C+saya+ingin+proposal+pelatihan+teknologi+informasi+dan+digital+untuk+instansi+kami.+Mohon+info+program+dan+harga."
       target="_blank" rel="noopener"
       style="display:inline-block;background:#C6621C;color:#fff;padding:14px 36px;border-radius:6px;font-weight:700;text-decoration:none;font-size:1.05rem;">
      WhatsApp: 0812-2969-435
    </a>
  </section>

</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>
</html>
