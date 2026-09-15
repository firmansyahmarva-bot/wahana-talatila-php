<?php
require_once __DIR__ . '/config.php';
$s = get_all_settings();
// Hub: K3 Psikososial & Kesehatan Mental Kerja
$canonical = 'https://wahanatotalita.com/k3-psikososial/';
$meta_title = 'K3 Psikososial & Kesehatan Mental di Tempat Kerja — Wahana Totalita Yogyakarta';
$meta_desc  = 'Pelatihan K3 psikososial dan kesehatan mental kerja: stres, burnout, bullying, beban kerja. Sesuai Kepmenaker 4/2026 dan Permenaker 5/2018. Yogyakarta, DIY, nasional.';

$schema = [
  [
    '@context' => 'https://schema.org',
    '@type'    => 'BreadcrumbList',
    'itemListElement' => [
      ['@type'=>'ListItem','position'=>1,'name'=>'Beranda','item'=>'https://wahanatotalita.com/'],
      ['@type'=>'ListItem','position'=>2,'name'=>'K3','item'=>'https://wahanatotalita.com/keselamatan-kerja/'],
      ['@type'=>'ListItem','position'=>3,'name'=>'K3 Psikososial','item'=>$canonical],
    ],
  ],
  [
    '@context' => 'https://schema.org',
    '@type'    => 'FAQPage',
    'mainEntity' => [
      [
        '@type' => 'Question',
        'name'  => 'Apa yang dimaksud dengan bahaya psikososial di tempat kerja?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Bahaya psikososial adalah kondisi kerja yang berpotensi menimbulkan dampak negatif pada kesehatan mental, emosional, dan sosial pekerja. Menurut Permenaker 5/2018, faktor psikologi merupakan salah satu dari 5 faktor bahaya di lingkungan kerja yang harus diidentifikasi dan dikendalikan. Contoh bahaya psikososial: beban kerja berlebih (overload), tekanan waktu yang tidak realistis, ketidakjelasan peran, konflik antarpersonal, bullying/harassment, isolasi sosial, shift malam yang panjang, dan kurangnya kontrol atas pekerjaan. Dampaknya: stres kronis, burnout, depresi, kecemasan, gangguan tidur, hingga kondisi fisik seperti tekanan darah tinggi dan penyakit jantung.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apa isi Kepmenaker 4/2026 tentang K3 Psikososial?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Kepmenaker 4/2026 tentang Keselamatan dan Kesehatan Kerja Psikososial mewajibkan pengusaha untuk: (1) Melakukan identifikasi dan penilaian risiko psikososial secara berkala; (2) Menerapkan program pengendalian faktor psikososial di tempat kerja; (3) Menyediakan dukungan psikologis bagi pekerja yang membutuhkan; (4) Melaporkan kasus gangguan kesehatan mental akibat kerja; dan (5) Mengintegrasikan manajemen risiko psikososial ke dalam SMK3. Ini adalah regulasi pertama di Indonesia yang secara spesifik dan komprehensif mengatur K3 psikososial — merespons meningkatnya angka burnout dan gangguan mental akibat kerja pasca-pandemi.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apa perbedaan stres kerja, burnout, dan depresi akibat kerja?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Ketiganya berbeda meski saling terkait: Stres kerja adalah respons fisiologis dan psikologis terhadap tuntutan pekerjaan yang melebihi kemampuan adaptasi — bersifat sementara dan bisa pulih jika stressor berkurang. Burnout adalah kondisi kelelahan kronis akibat stres kerja jangka panjang yang tidak terselesaikan — ditandai kelelahan emosional, depersonalisasi (sinisme terhadap pekerjaan/rekan), dan berkurangnya rasa pencapaian (reduced personal accomplishment). WHO telah mengklasifikasikan burnout sebagai occupational phenomenon (fenomena pekerjaan) sejak 2019. Depresi akibat kerja (work-related depression) adalah gangguan kesehatan mental yang lebih berat yang dipicu atau diperburuk oleh kondisi kerja, memerlukan penanganan profesional psikolog/psikiater, dan diakui sebagai penyakit akibat kerja yang masuk cakupan BPJS Ketenagakerjaan JKK.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apakah gangguan kesehatan mental akibat kerja termasuk penyakit akibat kerja yang ditanggung BPJS?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Ya. Berdasarkan Perpres 7/2019 tentang Penyakit Akibat Kerja, gangguan kesehatan mental yang disebabkan oleh faktor risiko di tempat kerja dapat dikategorikan sebagai penyakit akibat kerja dan ditanggung oleh program Jaminan Kecelakaan Kerja (JKK) BPJS Ketenagakerjaan. Namun penetapan penyakit akibat kerja memerlukan penilaian oleh dokter spesialis okupasi yang menentukan hubungan kausal antara kondisi kerja dan gangguan kesehatan mental yang dialami. Tren klaim K3 psikososial melalui BPJS meningkat signifikan sejak 2022.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Program apa yang bisa dilakukan perusahaan untuk mencegah burnout karyawan?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Program pencegahan burnout yang efektif meliputi: (1) Employee Assistance Program (EAP) — layanan konseling rahasia yang bisa diakses karyawan kapan saja; (2) Workload assessment berkala — evaluasi beban kerja dan redistribusi jika ada ketimpangan; (3) Pelatihan manajer dalam mengenali tanda-tanda burnout pada tim; (4) Kebijakan "right to disconnect" — tidak mewajibkan respons email/chat di luar jam kerja; (5) Cuti pemulihan atau sabbatical bagi yang sudah menunjukkan gejala; (6) Olahraga dan wellness program; (7) Redesain alur kerja untuk mengurangi tuntutan yang tidak perlu; (8) Pelatihan mindfulness dan manajemen stres. Pelatihan Wahana Totalita membantu HR dan supervisor merancang program pencegahan yang sesuai konteks organisasi.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Bagaimana cara mengidentifikasi bahaya psikososial di tempat kerja?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Identifikasi bahaya psikososial dilakukan melalui: (1) Survey/kuesioner tervalidasi — seperti Copenhagen Psychosocial Questionnaire (COPSOQ), Job Demands-Resources (JD-R), atau kuesioner yang dikembangkan sesuai konteks Indonesia; (2) Focus Group Discussion (FGD) dengan perwakilan karyawan dari berbagai level; (3) Analisis data absensi, turnover, dan klaim kesehatan — pola yang konsisten menunjukkan masalah sistemik; (4) Wawancara exit — informasi dari karyawan yang mengundurkan diri tentang kondisi kerja; (5) Observasi langsung proses kerja; dan (6) Review kebijakan dan prosedur manajemen. Hasil identifikasi harus didokumentasikan dalam penilaian risiko dan masuk dalam program K3 perusahaan sesuai Kepmenaker 4/2026.'],
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
<section style="background:linear-gradient(135deg,#1a0a3a 0%,#2a1a4a 40%,#0A4A2E 100%);color:#fff;padding:60px 20px 50px;">
  <div style="max-width:900px;margin:0 auto;">
    <nav aria-label="breadcrumb" style="font-size:0.85rem;opacity:0.8;margin-bottom:16px;">
      <a href="/" style="color:#c0a0ff;">Beranda</a> &rsaquo;
      <a href="/keselamatan-kerja/" style="color:#c0a0ff;">K3</a> &rsaquo;
      <span>K3 Psikososial</span>
    </nav>
    <div style="display:inline-block;background:#C6621C;color:#fff;padding:4px 12px;border-radius:12px;font-size:0.8rem;font-weight:700;margin-bottom:12px;">🆕 Kepmenaker 4/2026 — Regulasi Baru</div>
    <h1 style="font-size:clamp(1.6rem,4vw,2.4rem);font-weight:700;margin:0 0 16px;">
      K3 Psikososial &amp; Kesehatan Mental di Tempat Kerja
    </h1>
    <p style="font-size:1.05rem;opacity:0.92;max-width:720px;margin:0 0 10px;line-height:1.7;">
      Program pelatihan dan konsultasi K3 psikososial: identifikasi risiko stres kerja, pencegahan burnout, penanganan bullying/harassment, dan manajemen kesehatan mental karyawan — sesuai <strong>Kepmenaker 4/2026</strong> dan Permenaker 5/2018 faktor psikologi. Untuk HR, manajer, dan pengurus K3 di seluruh sektor.
    </p>
    <div style="display:flex;flex-wrap:wrap;gap:10px;margin:18px 0 28px;">
      <span style="background:rgba(255,255,255,0.16);padding:6px 14px;border-radius:20px;font-size:0.85rem;">🆕 Kepmenaker 4/2026</span>
      <span style="background:rgba(255,255,255,0.16);padding:6px 14px;border-radius:20px;font-size:0.85rem;">✓ Permenaker 5/2018</span>
      <span style="background:rgba(255,255,255,0.16);padding:6px 14px;border-radius:20px;font-size:0.85rem;">✓ WHO Burnout Framework</span>
      <span style="background:rgba(255,255,255,0.16);padding:6px 14px;border-radius:20px;font-size:0.85rem;">✓ Untuk semua sektor</span>
    </div>
    <a href="https://wa.me/628122969435?text=Halo%2C+saya+ingin+info+pelatihan+K3+psikososial+dan+kesehatan+mental+kerja+untuk+perusahaan%2Finstansi+kami."
       target="_blank" rel="noopener"
       style="display:inline-block;background:#C6621C;color:#fff;padding:14px 32px;border-radius:6px;font-weight:700;text-decoration:none;font-size:1rem;">
      Konsultasi Program K3 Psikososial
    </a>
  </div>
</section>

<main style="max-width:960px;margin:0 auto;padding:40px 20px 60px;">

  <!-- MENGAPA PENTING -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Mengapa K3 Psikososial Semakin Mendesak?
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(210px,1fr));gap:16px;margin-bottom:24px;">
      <?php
      $stats = [
        ['#0A4A2E','🧠','1 dari 3 pekerja','Mengalami stres kerja kronis menurut survei WHO / ILO untuk kawasan Asia Pasifik — mayoritas tidak pernah melapor.'],
        ['#3a1a5a','💸','3-4x biaya tidak langsung','Gangguan psikososial menghasilkan biaya tersembunyi: absensi, turnover, penurunan produktivitas, dan klaim kesehatan yang jauh melebihi biaya penanganan.'],
        ['#1a3a0a','📈','Breakout query GSC','Pencarian "k3 psikososial" dan "Kepmenaker 4/2026" naik tajam — menunjukkan urgensi industri untuk memahami regulasi baru ini.'],
        ['#3a2a0a','⚖️','Kewajiban hukum baru','Kepmenaker 4/2026 mewajibkan perusahaan mengidentifikasi, menilai, dan mengendalikan risiko psikososial — tidak lagi sukarela.'],
      ];
      foreach ($stats as $s): ?>
      <div style="background:<?php echo $s[0]; ?>;color:#fff;border-radius:10px;padding:20px;">
        <div style="font-size:1.6rem;margin-bottom:8px;"><?php echo $s[1]; ?></div>
        <div style="font-weight:700;font-size:1.05rem;margin-bottom:6px;"><?php echo $s[2]; ?></div>
        <p style="font-size:0.84rem;line-height:1.6;margin:0;opacity:0.85;"><?php echo $s[3]; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- REGULASI -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:24px;">
      Dasar Hukum K3 Psikososial di Indonesia
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:18px;">
      <?php
      $regs = [
        ['Kepmenaker 4/2026','K3 Psikososial (BARU)','Regulasi pertama di Indonesia yang secara spesifik mengatur K3 psikososial: kewajiban identifikasi risiko, program pengendalian, dukungan psikologis, dan pelaporan — berlaku untuk seluruh sektor.','#f0e8ff'],
        ['Permenaker 5/2018','K3 Lingkungan Kerja','Memasukkan faktor psikologi sebagai salah satu dari 5 faktor bahaya lingkungan kerja wajib diidentifikasi dan dikendalikan. Dasar hukum pertama yang menyebut psikososial secara eksplisit.','#e8f4eb'],
        ['UU 1/1970','Keselamatan Kerja','Pasal 3 mewajibkan pengusaha menciptakan lingkungan kerja yang sehat secara menyeluruh — termasuk kondisi psikologis pekerja. Landasan hukum dasar seluruh K3 termasuk psikososial.','#e8eef7'],
        ['PP 50/2012','SMK3','Mensyaratkan identifikasi bahaya dan penilaian risiko yang komprehensif — yang kini diperluas mencakup risiko psikososial sesuai Kepmenaker 4/2026.','#fff8f0'],
        ['Perpres 7/2019','Penyakit Akibat Kerja','Mengakui gangguan mental akibat kerja sebagai penyakit akibat kerja yang dapat diklaim melalui BPJS Ketenagakerjaan program JKK.','#f7f4e8'],
        ['WHO ICD-11','Klasifikasi Burnout','WHO resmi mengklasifikasikan burnout sebagai occupational phenomenon (QD85) sejak 2019 — diakui internasional sebagai konsekuensi stres kerja kronis yang tidak terkelola.','#f0f7e8'],
      ];
      foreach ($regs as $r): ?>
      <div style="background:<?php echo $r[3]; ?>;border-radius:10px;padding:20px;border-left:5px solid #1a0a3a;">
        <div style="font-weight:800;color:#C6621C;font-size:0.9rem;margin-bottom:4px;"><?php echo $r[0]; ?></div>
        <div style="font-weight:700;color:#0A4A2E;margin-bottom:8px;font-size:0.93rem;"><?php echo $r[1]; ?></div>
        <p style="color:#555;font-size:0.86rem;line-height:1.6;margin:0;"><?php echo $r[2]; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- JENIS BAHAYA PSIKOSOSIAL -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Jenis Bahaya Psikososial di Tempat Kerja
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:16px;">
      <?php
      $hazards = [
        ['background:#1a0a3a','😰','Beban Kerja Berlebih (Work Overload)','Tuntutan kerja melebihi kapasitas fisik dan mental pekerja secara konsisten — deadline tidak realistis, job description yang tidak jelas, dan misi yang terus berubah.'],
        ['background:#2a0a2a','🎭','Konflik Peran & Ambiguitas','Ketidakjelasan tugas dan tanggung jawab, ekspektasi yang saling bertentangan dari berbagai atasan, atau peran yang tidak sesuai dengan kompetensi.'],
        ['background:#0a2a3a','😔','Kurangnya Kontrol & Otonomi','Pekerja tidak punya kendali atas cara dan kecepatan kerja — micromanagement ekstrem yang merusak motivasi dan kepercayaan diri.'],
        ['background:#2a1a0a','😡','Bullying & Harassment','Perlakuan tidak menghormati, intimidasi, diskriminasi, pelecehan seksual, atau pengucilan di tempat kerja — baik dari atasan maupun rekan kerja.'],
        ['background:#0a1a0a','🌙','Shift Kerja & Jam Kerja Panjang','Shift malam, on-call 24 jam, jam kerja yang panjang (>48 jam/minggu), dan kurangnya waktu pemulihan — merusak ritme sirkadian dan relasi sosial.'],
        ['background:#3a0a0a','🔇','Isolasi Sosial & Lone Worker','Bekerja sendirian dalam waktu lama — satpam malam, pengemudi jarak jauh, pekerja remote tanpa dukungan sosial yang memadai.'],
      ];
      foreach ($hazards as $h): ?>
      <div style="background:<?php echo $h[0]; ?>;color:#fff;border-radius:10px;padding:20px;">
        <div style="font-size:1.8rem;margin-bottom:10px;"><?php echo $h[1]; ?></div>
        <div style="font-weight:700;font-size:0.95rem;margin-bottom:8px;color:#ffc0e0;"><?php echo $h[2]; ?></div>
        <p style="font-size:0.85rem;line-height:1.6;margin:0;opacity:0.85;"><?php echo $h[3]; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- BURNOUT VS STRES -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Memahami Kontinum: Stres → Burnout → Depresi
    </h2>
    <div style="overflow-x:auto;">
      <table style="width:100%;border-collapse:collapse;font-size:0.88rem;">
        <thead>
          <tr style="background:#1a0a3a;color:#fff;">
            <th style="padding:10px 14px;text-align:left;">Kondisi</th>
            <th style="padding:10px 14px;text-align:left;">Definisi</th>
            <th style="padding:10px 14px;text-align:left;">Gejala Utama</th>
            <th style="padding:10px 14px;text-align:left;">Penanganan</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $conditions = [
            ['Stres Kerja (Akut)','Respons fisiologis & psikologis terhadap tuntutan pekerjaan — bersifat sementara','Tegang, mudah marah, sulit konsentrasi, gangguan tidur sementara','Istirahat cukup, manajemen waktu, komunikasi dengan atasan'],
            ['Stres Kerja Kronis','Stres yang berlangsung berbulan-bulan tanpa resolusi — sudah mulai memengaruhi kesehatan','Kelelahan permanen, nyeri otot, penurunan imunitas, relasi sosial memburuk','Konseling, penilaian ulang beban kerja, perubahan kondisi kerja'],
            ['Burnout','Sindrom kelelahan kerja kronis: kelelahan emosional + depersonalisasi + hilangnya rasa pencapaian (WHO QD85)','Kelelahan total, sinisme/detachment dari pekerjaan, merasa tidak berguna','EAP, cuti pemulihan, intervensi organisasi, konseling profesional'],
            ['Depresi Akibat Kerja','Gangguan kesehatan mental yang dipicu/diperburuk kondisi kerja — penyakit akibat kerja (Perpres 7/2019)','Hilang motivasi total, anhedonia, pikiran negatif persisten, sulit berfungsi','Psikolog/psikiater, farmakoterapi jika perlu, cuti medis, BPJS JKK'],
          ];
          foreach ($conditions as $i => $c):
            $bg = $i%2===0?'#fff':'#f5f5f5';
          ?>
          <tr style="background:<?php echo $bg; ?>;">
            <td style="padding:9px 14px;border-bottom:1px solid #eee;font-weight:700;color:#1a0a3a;font-size:0.87rem;"><?php echo $c[0]; ?></td>
            <td style="padding:9px 14px;border-bottom:1px solid #eee;color:#444;font-size:0.84rem;"><?php echo $c[1]; ?></td>
            <td style="padding:9px 14px;border-bottom:1px solid #eee;color:#555;font-size:0.83rem;"><?php echo $c[2]; ?></td>
            <td style="padding:9px 14px;border-bottom:1px solid #eee;color:#0A4A2E;font-size:0.83rem;font-weight:600;"><?php echo $c[3]; ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </section>

  <!-- PROGRAM -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Program Pelatihan K3 Psikososial
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:18px;">
      <?php
      $programs = [
        ['Identifikasi & Penilaian Risiko Psikososial','1 hari / 8 JP','HR Manager, Safety Officer, dan pengurus K3. Metodologi survei psikososial (COPSOQ, JD-R), FGD, analisis data absensi, dan pelaporan sesuai Kepmenaker 4/2026.'],
        ['Pelatihan Manajer: Mengenali Tanda Burnout','Half-day / 4 JP','Supervisor, manajer lini, dan kepala divisi. Cara mendeteksi gejala stres/burnout pada anggota tim, pendekatan empatik, dan langkah intervensi awal.'],
        ['Manajemen Stres & Resiliensi Karyawan','1 hari / 8 JP','Semua karyawan. Teknik manajemen stres berbasis bukti: mindfulness, cognitive restructuring, time management, dan membangun resiliensi.'],
        ['Pencegahan Bullying & Harassment di Tempat Kerja','Half-day / 4 JP','HR, manajer, dan seluruh karyawan. Definisi, dampak hukum, mekanisme pelaporan, dan membangun budaya kerja yang aman dan inklusif.'],
        ['Wellbeing Program Design untuk HR','1 hari / 8 JP','HR Business Partner dan C-level. Merancang Employee Assistance Program (EAP), kebijakan mental health, dan mengintegrasikan psikososial ke dalam SMK3.'],
        ['Kepmenaker 4/2026 — Sosialisasi & Compliance','Half-day / 4 JP','HR, Legal, K3, dan manajemen. Pemahaman isi Kepmenaker 4/2026, kewajiban pelaporan, dan gap analysis terhadap kondisi perusahaan saat ini.'],
      ];
      foreach ($programs as $p): ?>
      <div style="background:#f9f9f9;border:1px solid #e0e0e0;border-radius:8px;padding:18px;">
        <div style="font-weight:700;color:#0A4A2E;margin-bottom:6px;font-size:0.93rem;"><?php echo $p[0]; ?></div>
        <div style="font-size:0.82rem;color:#C6621C;font-weight:600;margin-bottom:6px;"><?php echo $p[1]; ?></div>
        <div style="font-size:0.83rem;color:#666;margin-bottom:14px;line-height:1.5;"><?php echo $p[2]; ?></div>
        <a href="https://wa.me/628122969435?text=Halo%2C+saya+tertarik+pelatihan+<?php echo urlencode($p[0]); ?>+untuk+perusahaan%2Finstansi+kami."
           target="_blank" rel="noopener"
           style="display:inline-block;background:#1a0a3a;color:#fff;padding:7px 16px;border-radius:4px;text-decoration:none;font-size:0.82rem;font-weight:600;">
          Tanya via WhatsApp →
        </a>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- HIERARKI PENGENDALIAN -->
  <section style="margin-bottom:48px;background:#f0f0ff;border-radius:10px;padding:28px;">
    <h2 style="color:#0A4A2E;font-size:1.4rem;margin:0 0 16px;">Hierarki Pengendalian Risiko Psikososial</h2>
    <p style="color:#333;line-height:1.8;margin:0 0 16px;font-size:0.92rem;">Pengendalian risiko psikososial mengikuti hierarki yang sama seperti K3 fisik — dari yang paling efektif (eliminasi sumber bahaya) hingga yang paling lemah (perlindungan individual):</p>
    <div style="display:flex;flex-direction:column;gap:10px;">
      <?php
      $controls = [
        ['1 — Eliminasi','Hilangkan sumber stres yang tidak perlu: hapus rapat yang tidak produktif, eliminasi pelaporan duplikat, kurangi beban administrasi yang tidak bernilai.','#0A4A2E'],
        ['2 — Substitusi','Ganti proses kerja yang menyebabkan stres: otomasi tugas repetitif membosankan, rotasi jabatan untuk karyawan yang stuck, redesain alur kerja.','#1a5a3a'],
        ['3 — Rekayasa / Desain Ulang Pekerjaan','Redesain job design: kejelasan peran, autonomi yang cukup, feedback berkala, tim yang kohesif, beban kerja yang realistis, fleksibilitas jadwal.','#0A3A5A'],
        ['4 — Administratif / Kebijakan','Kebijakan anti-bullying, jam kerja maksimum, mandatory cuti, right to disconnect, program mentoring, jalur eskalasi konflik yang aman.','#3a1a5a'],
        ['5 — Perlindungan Individual (EAP)','Employee Assistance Program: konseling individual, aplikasi mindfulness, pelatihan resiliensi — TAPI ini hanya melengkapi, bukan pengganti pengendalian di level 1-4.','#5a0a2a'],
      ];
      foreach ($controls as $c): ?>
      <div style="display:flex;align-items:flex-start;gap:12px;background:#fff;border-radius:8px;padding:14px 16px;">
        <div style="background:<?php echo $c[2]; ?>;color:#fff;padding:6px 12px;border-radius:4px;font-size:0.82rem;font-weight:700;white-space:nowrap;flex-shrink:0;"><?php echo $c[0]; ?></div>
        <p style="color:#444;font-size:0.87rem;line-height:1.6;margin:0;"><?php echo $c[1]; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- RELATED LINKS -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.4rem;border-bottom:2px solid #e0e0e0;padding-bottom:8px;margin-bottom:16px;">Topik K3 Terkait</h2>
    <div style="display:flex;flex-wrap:wrap;gap:12px;">
      <?php
      $related = [
        ['/k3-perkantoran/','K3 Perkantoran & Ergonomi'],
        ['/k3-rumah-sakit/','K3 Rumah Sakit & Burnout Nakes'],
        ['/smk3/','Sistem Manajemen K3 (SMK3)'],
        ['/higiene-industri/','Higiene Industri & Faktor Lingkungan'],
        ['/pelatihan-manajemen-sdm/','Pelatihan SDM & Leadership ASN'],
      ];
      foreach ($related as $r): ?>
      <a href="<?php echo $r[0]; ?>" style="display:inline-block;background:#fff;border:1px solid #c0c0e0;border-radius:6px;padding:10px 16px;color:#0A4A2E;text-decoration:none;font-size:0.88rem;font-weight:600;" onmouseover="this.style.background='#f0e8ff'" onmouseout="this.style.background='#fff'"><?php echo $r[1]; ?></a>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- FAQ -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:24px;">Pertanyaan yang Sering Diajukan</h2>
    <?php
    $faqs = [
      ['Apa yang dimaksud bahaya psikososial di tempat kerja?','Kondisi kerja yang berdampak negatif pada kesehatan mental pekerja: beban kerja berlebih, konflik peran, kurangnya kontrol, bullying/harassment, shift malam panjang, dan isolasi sosial. Wajib diidentifikasi dan dikendalikan sesuai Permenaker 5/2018 dan Kepmenaker 4/2026.'],
      ['Apa isi Kepmenaker 4/2026 tentang K3 Psikososial?','Mewajibkan perusahaan: identifikasi dan penilaian risiko psikososial berkala, program pengendalian, dukungan psikologis bagi pekerja, dan pelaporan. Regulasi pertama di Indonesia yang secara komprehensif mengatur K3 psikososial.'],
      ['Apa perbedaan stres kerja, burnout, dan depresi akibat kerja?','Stres = respons sementara yang bisa pulih. Burnout = kelelahan kronis + depersonalisasi + hilangnya rasa pencapaian (WHO QD85). Depresi akibat kerja = gangguan mental lebih berat yang butuh penanganan profesional — diakui sebagai penyakit akibat kerja (Perpres 7/2019).'],
      ['Apakah gangguan mental akibat kerja ditanggung BPJS Ketenagakerjaan?','Ya. Perpres 7/2019 mengakui gangguan kesehatan mental akibat kondisi kerja sebagai penyakit akibat kerja — dapat diklaim melalui JKK BPJS Ketenagakerjaan setelah dinilai dokter spesialis okupasi yang menetapkan hubungan kausal.'],
      ['Program apa yang efektif mencegah burnout karyawan?','Employee Assistance Program (EAP), workload assessment berkala, pelatihan manajer mengenali burnout, kebijakan right to disconnect, cuti pemulihan, dan yang terpenting: redesain job design agar beban kerja realistis — bukan hanya program wellness individual.'],
      ['Bagaimana cara mengidentifikasi bahaya psikososial di perusahaan?','Survei tervalidasi (COPSOQ, JD-R), FGD dengan karyawan, analisis data absensi/turnover/klaim kesehatan, wawancara exit, observasi proses kerja, dan review kebijakan manajemen. Hasil harus masuk dalam penilaian risiko dan program K3 sesuai Kepmenaker 4/2026.'],
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
    <h2 style="margin:0 0 12px;font-size:1.6rem;">Jadikan Tempat Kerja Anda Sehat Secara Mental</h2>
    <p style="opacity:0.9;margin:0 0 10px;line-height:1.7;max-width:580px;margin-left:auto;margin-right:auto;">
      Kepmenaker 4/2026 sudah berlaku — mulai program K3 psikososial sekarang sebelum menjadi kewajiban yang terlambat dipenuhi. Hubungi kami untuk gap analysis dan proposal program yang sesuai skala perusahaan Anda.
    </p>
    <p style="opacity:0.75;font-size:0.9rem;margin:0 0 24px;">Berlaku untuk semua sektor · Instansi pemerintah &amp; swasta · In-house di lokasi Anda</p>
    <a href="https://wa.me/628122969435?text=Halo%2C+saya+ingin+info+pelatihan+K3+psikososial+dan+kesehatan+mental+kerja.+Tolong+kirim+info+program+dan+harga."
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
