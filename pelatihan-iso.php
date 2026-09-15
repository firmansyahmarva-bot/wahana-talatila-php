<?php
require_once __DIR__ . '/config.php';
$s = get_all_settings();
// Hub: Pelatihan ISO 9001 / ISO 14001 / ISO 45001
$canonical = 'https://wahanatotalita.com/pelatihan-iso/';
$meta_title = 'Pelatihan ISO 9001, ISO 14001 & ISO 45001 — Internal & Lead Auditor | Wahana Totalita';
$meta_desc  = 'Pelatihan sertifikasi ISO 9001:2015, ISO 14001:2015, dan ISO 45001:2018 untuk Internal Auditor dan Lead Auditor. Diakui internasional. Yogyakarta & in-house. Hubungi: 0812-2969-435.';

$schema = [
  [
    '@context' => 'https://schema.org',
    '@type'    => 'BreadcrumbList',
    'itemListElement' => [
      ['@type'=>'ListItem','position'=>1,'name'=>'Beranda','item'=>'https://wahanatotalita.com/'],
      ['@type'=>'ListItem','position'=>2,'name'=>'Pelatihan','item'=>'https://wahanatotalita.com/pelatihan/'],
      ['@type'=>'ListItem','position'=>3,'name'=>'Pelatihan ISO','item'=>$canonical],
    ],
  ],
  [
    '@context' => 'https://schema.org',
    '@type'    => 'FAQPage',
    'mainEntity' => [
      [
        '@type' => 'Question',
        'name'  => 'Apakah sertifikat Internal Auditor ISO dari Wahana Totalita diakui secara internasional?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Sertifikat Internal Auditor yang kami terbitkan adalah sertifikat pelatihan yang diakui sebagai bukti kompetensi audit internal. Untuk pengakuan internasional penuh seperti IRCA Registered Lead Auditor, peserta perlu mengikuti jalur sertifikasi IRCA/CQI tambahan. Hubungi kami untuk informasi program yang sesuai kebutuhan Anda.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Berapa lama proses perusahaan mendapatkan sertifikat ISO setelah pelatihan?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Pelatihan auditor dan proses sertifikasi ISO adalah dua hal berbeda. Pelatihan Internal Auditor mempersiapkan tim Anda untuk mengaudit sistem yang sudah berjalan. Proses sertifikasi ISO perusahaan oleh lembaga sertifikasi terakreditasi KAN membutuhkan 6–18 bulan tergantung kesiapan sistem. Kami juga menyediakan layanan konsultasi pendampingan implementasi jika dibutuhkan.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apakah ISO 9001, ISO 14001, dan ISO 45001 bisa diintegrasikan?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Ya, dan ini sangat direkomendasikan. Ketiga standar menggunakan High Level Structure (HLS) yang sama — klausul 4 hingga 10 identik. Perusahaan yang sudah memiliki ISO 9001 dapat menambahkan ISO 14001 dan ISO 45001 dengan effort jauh lebih kecil. Sistem terintegrasi ini disebut IMS (Integrated Management System).'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apakah ISO 45001 menggantikan SMK3 PP 50/2012?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Tidak. Keduanya tetap berlaku secara paralel. SMK3 adalah kewajiban hukum Indonesia — tidak bisa digantikan oleh standar internasional manapun. ISO 45001 adalah standar sukarela internasional yang saling melengkapi SMK3. Perusahaan yang menjalankan keduanya memiliki sistem K3 yang paling kuat — memenuhi kewajiban hukum sekaligus diakui internasional.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Siapa yang harus mengikuti pelatihan Internal Auditor ISO di perusahaan?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Minimal 2–3 orang per standar ISO yang dimiliki perusahaan — untuk memastikan program audit internal dapat berjalan meskipun ada auditor yang tidak hadir. Idealnya: Manajer Mutu/HSE/Lingkungan ditambah 1–2 staf dari departemen berbeda untuk objektivitas audit lintas departemen.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apakah ada pelatihan ISO Awareness untuk karyawan umum yang bukan auditor?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Ya. Selain Internal Auditor dan Lead Auditor, kami juga menyediakan pelatihan ISO Awareness — sesi setengah hari atau satu hari untuk mensosialisasikan standar ISO kepada seluruh karyawan. Pelatihan ini penting sebelum audit sertifikasi agar semua karyawan memahami apa yang diaudit dan bagaimana menjawab pertanyaan auditor.'],
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
<!-- GTM noscript -->

<?php include __DIR__ . '/includes/navbar.php'; ?>

<!-- HERO -->
<section style="background:linear-gradient(135deg,#0A4A2E 0%,#1a6b42 100%);color:#fff;padding:60px 20px 50px;">
  <div style="max-width:900px;margin:0 auto;">
    <nav aria-label="breadcrumb" style="font-size:0.85rem;opacity:0.8;margin-bottom:16px;">
      <a href="/" style="color:#f5c06a;">Beranda</a> &rsaquo;
      <a href="/pelatihan/" style="color:#f5c06a;">Pelatihan</a> &rsaquo;
      <span>Pelatihan ISO</span>
    </nav>
    <h1 style="font-size:clamp(1.6rem,4vw,2.4rem);font-weight:700;margin:0 0 16px;">
      Pelatihan ISO 9001, ISO 14001 &amp; ISO 45001
    </h1>
    <p style="font-size:1.1rem;opacity:0.92;max-width:700px;margin:0 0 28px;line-height:1.7;">
      Sertifikasi <strong>Internal Auditor</strong> dan <strong>Lead Auditor</strong> untuk tiga standar ISO utama. Diakui internasional — wajib bagi perusahaan yang memasok BUMN, mengikuti tender, atau beroperasi di pasar ekspor.
    </p>
    <a href="https://wa.me/628122969435?text=Halo%2C+saya+ingin+mendaftar+pelatihan+ISO+(9001%2F14001%2F45001).+Mohon+info+jadwal+dan+biaya."
       target="_blank" rel="noopener"
       style="display:inline-block;background:#C6621C;color:#fff;padding:14px 32px;border-radius:6px;font-weight:700;text-decoration:none;font-size:1rem;">
      Daftar Sekarang via WhatsApp
    </a>
  </div>
</section>

<main style="max-width:960px;margin:0 auto;padding:40px 20px 60px;">

  <!-- WHY ISO -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Mengapa Sertifikasi ISO Penting untuk Perusahaan Indonesia?
    </h2>
    <p style="line-height:1.8;color:#333;">
      Standar ISO (International Organization for Standardization) adalah sistem manajemen yang diakui di seluruh dunia. Di Indonesia, sertifikasi ISO semakin menjadi syarat wajib dalam kualifikasi vendor BUMN dan BUMS besar, tender pemerintah kategori tertentu, persyaratan ekspor ke pasar internasional, dan penilaian reputasi perusahaan oleh calon klien besar. Perusahaan bersertifikat ISO menunjukkan bahwa mereka memiliki sistem yang terstandarisasi, terdokumentasi, dan diaudit secara independen — bukan hanya klaim tanpa bukti.
    </p>
    <p style="line-height:1.8;color:#333;margin-top:12px;">
      Untuk mempertahankan sertifikasi ISO, setiap perusahaan <strong>wajib melakukan audit internal secara berkala</strong> sebelum audit eksternal oleh lembaga sertifikasi. Inilah mengapa memiliki <em>Internal Auditor ISO yang terlatih</em> di dalam organisasi bukan pilihan — melainkan keharusan.
    </p>
  </section>

  <!-- TIGA STANDAR -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:24px;">
      Tiga Standar ISO Utama yang Kami Sediakan
    </h2>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:24px;">

      <!-- ISO 9001 -->
      <div style="background:#f9f9f9;border:1px solid #ddd;border-radius:8px;padding:24px;border-top:4px solid #0A4A2E;">
        <h3 style="color:#0A4A2E;margin:0 0 12px;font-size:1.15rem;">ISO 9001:2015 — Sistem Manajemen Mutu (QMS)</h3>
        <p style="line-height:1.7;color:#444;font-size:0.95rem;">
          Standar paling banyak diterapkan di dunia — lebih dari 1 juta sertifikat aktif di 170+ negara. Berfokus pada kepuasan pelanggan, konsistensi produk/layanan, dan perbaikan berkelanjutan (<em>continual improvement</em>). Wajib atau sangat direkomendasikan untuk perusahaan manufaktur, jasa konstruksi, konsultan, dan vendor yang melayani BUMN atau perusahaan multinasional.
        </p>
      </div>

      <!-- ISO 14001 -->
      <div style="background:#f9f9f9;border:1px solid #ddd;border-radius:8px;padding:24px;border-top:4px solid #1a6b42;">
        <h3 style="color:#0A4A2E;margin:0 0 12px;font-size:1.15rem;">ISO 14001:2015 — Sistem Manajemen Lingkungan (EMS)</h3>
        <p style="line-height:1.7;color:#444;font-size:0.95rem;">
          Standar internasional untuk pengelolaan dampak lingkungan secara sistematis. Membantu perusahaan mengurangi limbah, meningkatkan efisiensi energi, dan memenuhi regulasi lingkungan. Kompatibel penuh dengan ISO 9001 dan ISO 45001 — dapat diintegrasikan dalam satu sistem manajemen terpadu (IMS). Relevan untuk manufaktur, pertambangan, minyak &amp; gas, konstruksi, dan industri dengan dampak lingkungan signifikan.
        </p>
      </div>

      <!-- ISO 45001 -->
      <div style="background:#f9f9f9;border:1px solid #ddd;border-radius:8px;padding:24px;border-top:4px solid #C6621C;">
        <h3 style="color:#0A4A2E;margin:0 0 12px;font-size:1.15rem;">ISO 45001:2018 — Sistem Manajemen K3 (OHSMS)</h3>
        <p style="line-height:1.7;color:#444;font-size:0.95rem;">
          Menggantikan OHSAS 18001 secara global. Fokus pada pencegahan cedera dan penyakit akibat kerja dengan pendekatan risiko proaktif. Menggunakan struktur High Level Structure (HLS) yang sama dengan ISO 9001 dan ISO 14001 — integrasi menjadi lebih mudah. Di Indonesia, ISO 45001 saling melengkapi dengan SMK3 (PP 50/2012) — keduanya wajib berjalan bersama.
        </p>
      </div>

    </div>
  </section>

  <!-- INTERNAL vs LEAD AUDITOR TABLE -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Internal Auditor vs Lead Auditor — Apa Bedanya?
    </h2>
    <p style="line-height:1.8;color:#333;margin-bottom:20px;">
      Sebelum mendaftar, penting memahami perbedaan dua level sertifikasi ISO agar Anda memilih program yang tepat sesuai peran dan kebutuhan organisasi.
    </p>
    <div style="overflow-x:auto;">
      <table style="width:100%;border-collapse:collapse;font-size:0.95rem;">
        <thead>
          <tr style="background:#0A4A2E;color:#fff;">
            <th style="padding:12px 16px;text-align:left;">Aspek</th>
            <th style="padding:12px 16px;text-align:left;">Internal Auditor ISO</th>
            <th style="padding:12px 16px;text-align:left;">Lead Auditor ISO</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $rows = [
            ['Peran','Mengaudit sistem manajemen perusahaan sendiri','Memimpin tim audit eksternal atau sertifikasi'],
            ['Dibutuhkan oleh','Semua perusahaan bersertifikat ISO','Konsultan, lembaga sertifikasi, perusahaan besar'],
            ['Durasi pelatihan','±16–24 jam (2–3 hari)','±40 jam (5 hari)'],
            ['Prasyarat','Pemahaman dasar standar ISO','Lulus Internal Auditor atau pengalaman audit'],
            ['Pengakuan','Internal perusahaan','Internasional (IRCA, CQI, dll)'],
            ['Output','Laporan audit internal','Laporan audit eksternal / sertifikasi'],
          ];
          foreach ($rows as $i => $r):
            $bg = $i % 2 === 0 ? '#fff' : '#f5f5f5';
          ?>
          <tr style="background:<?php echo $bg; ?>;">
            <td style="padding:10px 16px;font-weight:600;color:#0A4A2E;border-bottom:1px solid #e0e0e0;"><?php echo $r[0]; ?></td>
            <td style="padding:10px 16px;border-bottom:1px solid #e0e0e0;color:#333;"><?php echo $r[1]; ?></td>
            <td style="padding:10px 16px;border-bottom:1px solid #e0e0e0;color:#333;"><?php echo $r[2]; ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </section>

  <!-- SIAPA YANG MEMBUTUHKAN -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Siapa yang Membutuhkan Pelatihan ISO?
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:16px;">
      <?php
      $targets = [
        ['👔','Manajer Mutu (QA/QC)','Bertanggung jawab atas sistem ISO 9001 perusahaan'],
        ['🌿','HSE Manager','Mengelola ISO 14001 & ISO 45001 secara terintegrasi'],
        ['🏗️','Tim Internal Auditor','Melaksanakan audit internal wajib sebelum audit eksternal'],
        ['💼','Konsultan Manajemen','Mendampingi klien meraih dan mempertahankan sertifikasi ISO'],
        ['🏭','Vendor & Subkontraktor BUMN','Diminta memiliki ISO oleh klien utama sebagai syarat kualifikasi'],
        ['🎓','Fresh Graduate / Staf Baru','Meningkatkan kompetensi dan daya saing karir di bidang QA/HSE'],
      ];
      foreach ($targets as $t): ?>
      <div style="background:#fff;border:1px solid #ddd;border-radius:8px;padding:18px;text-align:center;">
        <div style="font-size:2rem;margin-bottom:10px;"><?php echo $t[0]; ?></div>
        <div style="font-weight:600;color:#0A4A2E;margin-bottom:6px;font-size:0.95rem;"><?php echo $t[1]; ?></div>
        <div style="color:#555;font-size:0.85rem;line-height:1.5;"><?php echo $t[2]; ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- KURIKULUM -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Kurikulum — Internal Auditor ISO (±24 Jam / 3 Hari)
    </h2>

    <?php
    $hari = [
      [
        'label' => 'Hari 1 — Pemahaman Standar ISO',
        'items' => [
          'Sejarah ISO dan struktur High Level Structure (HLS) — mengapa ketiga standar menggunakan kerangka yang sama',
          'Klausul 4–10 standar ISO yang dipilih: persyaratan, intent, dan implementasi praktis',
          'Perbedaan "shall" (wajib) vs "should" (disarankan) dalam bahasa standar',
          'Studi kasus: implementasi standar di berbagai industri — manufaktur, konstruksi, jasa',
          'Dokumentasi wajib: kebijakan, tujuan, prosedur, rekaman — apa yang harus ada',
        ],
      ],
      [
        'label' => 'Hari 2 — Teknik Audit',
        'items' => [
          'Siklus audit: perencanaan → pelaksanaan → pelaporan → tindak lanjut',
          'Dokumen audit: audit plan, checklist, nonconformity report (NCR)',
          'Teknik interview: pertanyaan terbuka vs tertutup, active listening, probing questions',
          'Teknik sampling: stratified sampling, random sampling — berapa sampel yang cukup?',
          'Simulasi audit: role play auditor dan auditee — latihan nyata di kelas',
        ],
      ],
      [
        'label' => 'Hari 3 — Praktik, Pelaporan & Ujian',
        'items' => [
          'Penulisan temuan: good findings vs bad findings — contoh nyata dan koreksinya',
          'Klasifikasi temuan: NC Mayor, NC Minor, Observasi, Peluang Perbaikan (OFI)',
          'Penulisan laporan audit yang efektif — struktur, bahasa, dan tingkat detail',
          'Tindakan korektif: root cause analysis (5-Why, Fishbone), CAPA, verifikasi efektivitas',
          'Ujian tertulis — peserta yang lulus menerima sertifikat pelatihan',
        ],
      ],
    ];
    foreach ($hari as $h): ?>
    <div style="margin-bottom:24px;background:#f9f9f9;border-radius:8px;overflow:hidden;">
      <div style="background:#0A4A2E;color:#fff;padding:12px 20px;font-weight:600;"><?php echo $h['label']; ?></div>
      <ul style="margin:0;padding:16px 20px 16px 36px;color:#333;line-height:1.8;">
        <?php foreach ($h['items'] as $item): ?>
        <li style="margin-bottom:4px;"><?php echo $item; ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <?php endforeach; ?>
  </section>

  <!-- METODE PELATIHAN -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Metode Pelatihan
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:20px;">
      <?php
      $metodes = [
        ['📍 Tatap Muka — Yogyakarta','Pelatihan di kelas dengan fasilitator berpengalaman. Kombinasi teori, studi kasus nyata, diskusi kelompok, dan simulasi audit dua arah.'],
        ['🏢 In-House Training','Pelatihan di lokasi perusahaan Anda (minimum 10 peserta). Simulasi audit menggunakan dokumen sistem manajemen perusahaan sendiri — hasilnya langsung relevan dan aplikatif.'],
        ['📜 Sertifikasi Tersedia','Sertifikat pelatihan diterbitkan oleh Wahana Totalita. Program IRCA/CQI Lead Auditor tersedia atas permintaan untuk kebutuhan pengakuan internasional.'],
      ];
      foreach ($metodes as $m): ?>
      <div style="background:#fff;border:1px solid #ddd;border-radius:8px;padding:20px;border-left:4px solid #C6621C;">
        <div style="font-weight:600;color:#0A4A2E;margin-bottom:8px;font-size:1rem;"><?php echo $m[0]; ?></div>
        <p style="color:#555;line-height:1.7;margin:0;font-size:0.95rem;"><?php echo $m[1]; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- PROGRAM CARDS (WA inquiry — no DB slugs found) -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:24px;">
      Program Pelatihan ISO yang Tersedia
    </h2>
    <p style="color:#555;margin-bottom:24px;line-height:1.7;">
      Kami menyediakan program pelatihan ISO untuk ketiga standar utama, dalam dua level (Internal Auditor dan Lead Auditor), serta program ISO Awareness untuk karyawan umum. Hubungi kami untuk jadwal dan penawaran harga.
    </p>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:20px;">
      <?php
      $programs = [
        ['ISO 9001:2015 — Internal Auditor','Sistem Manajemen Mutu','2–3 hari','iso-9001/internal-auditor'],
        ['ISO 9001:2015 — Lead Auditor','Sistem Manajemen Mutu','5 hari','iso-9001/lead-auditor'],
        ['ISO 14001:2015 — Internal Auditor','Sistem Manajemen Lingkungan','2–3 hari','iso-14001/internal-auditor'],
        ['ISO 14001:2015 — Lead Auditor','Sistem Manajemen Lingkungan','5 hari','iso-14001/lead-auditor'],
        ['ISO 45001:2018 — Internal Auditor','Sistem Manajemen K3','2–3 hari','iso-45001/internal-auditor'],
        ['ISO Awareness Training','Untuk seluruh karyawan','0,5–1 hari','iso-awareness'],
      ];
      foreach ($programs as $p):
        $wa_text = 'Halo%2C+saya+ingin+info+program+pelatihan+' . urlencode($p[0]) . '.+Mohon+info+jadwal+dan+biaya.';
      ?>
      <div style="background:#fff;border:1px solid #ddd;border-radius:8px;overflow:hidden;display:flex;flex-direction:column;">
        <div style="background:#0A4A2E;color:#fff;padding:14px 16px;">
          <div style="font-weight:600;font-size:0.95rem;"><?php echo $p[0]; ?></div>
          <div style="font-size:0.8rem;opacity:0.85;margin-top:4px;"><?php echo $p[1]; ?></div>
        </div>
        <div style="padding:14px 16px;flex:1;">
          <div style="font-size:0.85rem;color:#555;margin-bottom:4px;">⏱️ Durasi: <strong><?php echo $p[2]; ?></strong></div>
          <div style="font-size:0.85rem;color:#555;">📜 Sertifikat pelatihan resmi</div>
        </div>
        <div style="padding:0 16px 16px;">
          <a href="https://wa.me/628122969435?text=<?php echo $wa_text; ?>"
             target="_blank" rel="noopener"
             style="display:block;text-align:center;background:#C6621C;color:#fff;padding:10px;border-radius:5px;text-decoration:none;font-weight:600;font-size:0.9rem;">
            Tanya Jadwal &amp; Harga
          </a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- INTEGRASI IMS -->
  <section style="margin-bottom:48px;background:#f0f7f3;border-radius:10px;padding:30px;">
    <h2 style="color:#0A4A2E;font-size:1.4rem;margin:0 0 16px;">
      Integrasi ISO: Sistem Manajemen Terpadu (IMS)
    </h2>
    <p style="line-height:1.8;color:#333;margin-bottom:16px;">
      ISO 9001, ISO 14001, dan ISO 45001 semuanya menggunakan <strong>High Level Structure (HLS)</strong> — kerangka klausul yang identik (4 hingga 10). Ini berarti perusahaan yang sudah memiliki satu standar dapat menambahkan standar lain dengan usaha yang jauh lebih kecil, karena dokumentasi inti (konteks organisasi, kepemimpinan, perencanaan, dukungan, operasional, evaluasi kinerja, dan peningkatan) dapat diintegrasikan.
    </p>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px;">
      <?php
      $integrations = [
        ['QMS (ISO 9001)','Kepuasan Pelanggan &amp; Mutu Produk','#0A4A2E'],
        ['EMS (ISO 14001)','Dampak Lingkungan &amp; Regulasi','#1a6b42'],
        ['OHSMS (ISO 45001)','K3 Karyawan &amp; Pencegahan Kecelakaan','#C6621C'],
      ];
      foreach ($integrations as $int): ?>
      <div style="background:#fff;border-radius:6px;padding:16px;text-align:center;border-top:3px solid <?php echo $int[2]; ?>;">
        <div style="font-weight:700;color:<?php echo $int[2]; ?>;margin-bottom:6px;font-size:1rem;"><?php echo $int[0]; ?></div>
        <div style="color:#555;font-size:0.9rem;"><?php echo $int[1]; ?></div>
      </div>
      <?php endforeach; ?>
    </div>
    <p style="color:#555;margin-top:16px;font-size:0.95rem;line-height:1.7;">
      <strong>IMS = QMS + EMS + OHSMS.</strong> Satu sistem, satu audit internal, satu audit eksternal — lebih efisien dan lebih komprehensif. Wahana Totalita dapat membantu Anda merancang jalur implementasi IMS yang sesuai dengan skala dan industri perusahaan Anda.
    </p>
  </section>

  <!-- RELATED -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.4rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Program Terkait
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(210px,1fr));gap:16px;">
      <?php
      $related = [
        ['/smk3/','SMK3 & Audit PP 50/2012','Sistem Manajemen K3 nasional yang wajib bagi perusahaan ≥100 karyawan'],
        ['/k3-lingkungan/','K3 Lingkungan & AMDAL','AMDAL, UKL-UPL, PROPER, pengelolaan limbah B3'],
        ['/keselamatan-kerja/','K3 Umum & Ahli K3','Sertifikasi Ahli K3 Umum Kemnaker RI dan BNSP'],
        ['/sertifikasi-bnsp/','Sertifikasi BNSP','Semua program sertifikasi kompetensi berstandar nasional'],
      ];
      foreach ($related as $r): ?>
      <a href="<?php echo $r[0]; ?>" style="display:block;background:#fff;border:1px solid #ddd;border-radius:8px;padding:16px;text-decoration:none;transition:box-shadow 0.2s;" onmouseover="this.style.boxShadow='0 2px 10px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='none'">
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
      [
        'q' => 'Apakah sertifikat Internal Auditor ISO dari Wahana Totalita diakui secara internasional?',
        'a' => 'Sertifikat Internal Auditor yang kami terbitkan adalah sertifikat pelatihan yang diakui sebagai bukti kompetensi audit internal. Untuk pengakuan internasional penuh seperti IRCA Registered Lead Auditor, peserta perlu mengikuti jalur sertifikasi IRCA/CQI tambahan. Hubungi kami untuk informasi program yang sesuai kebutuhan Anda.',
      ],
      [
        'q' => 'Berapa lama proses perusahaan mendapatkan sertifikat ISO setelah pelatihan?',
        'a' => 'Pelatihan auditor dan proses sertifikasi ISO adalah dua hal berbeda. Pelatihan Internal Auditor mempersiapkan tim Anda untuk mengaudit sistem yang sudah berjalan. Proses sertifikasi ISO perusahaan oleh lembaga sertifikasi terakreditasi KAN membutuhkan 6–18 bulan tergantung kesiapan sistem. Kami juga menyediakan layanan konsultasi pendampingan implementasi jika dibutuhkan.',
      ],
      [
        'q' => 'Apakah ISO 9001, ISO 14001, dan ISO 45001 bisa diintegrasikan?',
        'a' => 'Ya, dan ini sangat direkomendasikan. Ketiga standar menggunakan High Level Structure (HLS) yang sama — klausul 4 hingga 10 identik. Perusahaan yang sudah memiliki ISO 9001 dapat menambahkan ISO 14001 dan ISO 45001 dengan effort jauh lebih kecil. Sistem terintegrasi ini disebut IMS (Integrated Management System).',
      ],
      [
        'q' => 'Apakah ISO 45001 menggantikan SMK3 PP 50/2012?',
        'a' => 'Tidak. Keduanya tetap berlaku secara paralel. SMK3 adalah kewajiban hukum Indonesia — tidak bisa digantikan oleh standar internasional manapun. ISO 45001 adalah standar sukarela internasional yang saling melengkapi SMK3. Perusahaan yang menjalankan keduanya memiliki sistem K3 yang paling kuat — memenuhi kewajiban hukum sekaligus diakui internasional.',
      ],
      [
        'q' => 'Siapa yang harus mengikuti pelatihan Internal Auditor ISO di perusahaan?',
        'a' => 'Minimal 2–3 orang per standar ISO yang dimiliki perusahaan — untuk memastikan program audit internal dapat berjalan meskipun ada auditor yang tidak hadir. Idealnya: Manajer Mutu/HSE/Lingkungan ditambah 1–2 staf dari departemen berbeda untuk objektivitas audit lintas departemen.',
      ],
      [
        'q' => 'Apakah ada pelatihan ISO Awareness untuk karyawan umum yang bukan auditor?',
        'a' => 'Ya. Selain Internal Auditor dan Lead Auditor, kami juga menyediakan pelatihan ISO Awareness — sesi setengah hari atau satu hari untuk mensosialisasikan standar ISO kepada seluruh karyawan. Pelatihan ini penting sebelum audit sertifikasi agar semua karyawan memahami apa yang diaudit dan bagaimana menjawab pertanyaan auditor.',
      ],
    ];
    foreach ($faqs as $i => $faq):
    ?>
    <div style="border:1px solid #e0e0e0;border-radius:8px;margin-bottom:12px;overflow:hidden;">
      <button onclick="var a=this.nextElementSibling;a.style.display=a.style.display==='block'?'none':'block';this.querySelector('span').textContent=a.style.display==='block'?'−':'+'"
              style="width:100%;text-align:left;padding:16px 20px;background:#f9f9f9;border:none;cursor:pointer;font-weight:600;color:#0A4A2E;font-size:0.95rem;display:flex;justify-content:space-between;align-items:center;">
        <?php echo htmlspecialchars($faq['q']); ?>
        <span style="font-size:1.2rem;font-weight:700;color:#C6621C;min-width:20px;text-align:center;">+</span>
      </button>
      <div style="display:none;padding:16px 20px;color:#444;line-height:1.8;background:#fff;border-top:1px solid #e0e0e0;">
        <?php echo htmlspecialchars($faq['a']); ?>
      </div>
    </div>
    <?php endforeach; ?>
  </section>

  <!-- CTA -->
  <section style="background:linear-gradient(135deg,#0A4A2E,#1a6b42);color:#fff;border-radius:12px;padding:40px;text-align:center;">
    <h2 style="margin:0 0 12px;font-size:1.6rem;">Siap Meningkatkan Kompetensi Audit ISO?</h2>
    <p style="opacity:0.9;margin:0 0 28px;line-height:1.7;max-width:600px;margin-left:auto;margin-right:auto;">
      Hubungi tim Wahana Totalita untuk informasi jadwal, biaya, dan opsi in-house training. Kami siap menyesuaikan program dengan kebutuhan industri dan skala perusahaan Anda.
    </p>
    <a href="https://wa.me/628122969435?text=Halo%2C+saya+ingin+mendaftar+pelatihan+ISO+(9001%2F14001%2F45001).+Mohon+info+jadwal+dan+biaya."
       target="_blank" rel="noopener"
       style="display:inline-block;background:#C6621C;color:#fff;padding:14px 36px;border-radius:6px;font-weight:700;text-decoration:none;font-size:1.05rem;margin-right:12px;">
      WhatsApp: 0812-2969-435
    </a>
    <a href="/pelatihan/"
       style="display:inline-block;background:transparent;color:#fff;padding:14px 28px;border-radius:6px;font-weight:600;text-decoration:none;font-size:1rem;border:2px solid rgba(255,255,255,0.6);margin-top:10px;">
      Lihat Semua Pelatihan
    </a>
  </section>


<?php
require_once __DIR__ . '/includes/hub-category-map.php';
$hub_article_cats = $HUB_CATEGORY_MAP['system-management']['article_cats'] ?? [];
include __DIR__ . '/includes/hub-artikel-terkait.php';
?>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
</body>
</html>
