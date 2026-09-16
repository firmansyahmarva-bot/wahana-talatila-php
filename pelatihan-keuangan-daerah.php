<?php
require_once __DIR__ . '/config.php';
$s = get_all_settings();
// Hub: Pelatihan Keuangan Daerah & Akuntansi Pemerintahan
$canonical = 'https://wahanatotalita.com/pelatihan-keuangan-daerah/';
$meta_title = 'Pelatihan Keuangan Daerah & Akuntansi Pemerintahan Yogyakarta — Wahana Totalita';
$meta_desc  = 'Pelatihan keuangan daerah, akuntansi pemerintahan, bendahara instansi, dan pengelolaan APBD untuk ASN dan pegawai pemerintah di Yogyakarta. Bersertifikat, dokumen SPJ lengkap.';

$schema = [
  [
    '@context' => 'https://schema.org',
    '@type'    => 'BreadcrumbList',
    'itemListElement' => [
      ['@type'=>'ListItem','position'=>1,'name'=>'Beranda','item'=>'https://wahanatotalita.com/'],
      ['@type'=>'ListItem','position'=>2,'name'=>'Pelatihan','item'=>'https://wahanatotalita.com/pelatihan/'],
      ['@type'=>'ListItem','position'=>3,'name'=>'Pelatihan Keuangan Daerah','item'=>$canonical],
    ],
  ],
  [
    '@context' => 'https://schema.org',
    '@type'    => 'FAQPage',
    'mainEntity' => [
      [
        '@type' => 'Question',
        'name'  => 'Apa saja regulasi utama yang wajib dipahami bendahara instansi pemerintah?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Bendahara instansi pemerintah wajib memahami: UU 17/2003 tentang Keuangan Negara (landasan hukum pengelolaan APBN/APBD), UU 1/2004 tentang Perbendaharaan Negara (pengaturan kas dan SPJ), PP 71/2010 tentang SAP (Standar Akuntansi Pemerintahan — akrual basis sejak 2015), PMK 213/2013 tentang Sistem Akuntansi dan Pelaporan Keuangan Pemerintah Pusat, Permendagri 77/2020 tentang Pedoman Teknis Pengelolaan Keuangan Daerah (untuk pemda), dan UU 15/2004 tentang pemeriksaan BPK. Pemahaman menyeluruh regulasi-regulasi ini adalah fondasi pertanggungjawaban keuangan yang aman.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apakah pelatihan keuangan dari Wahana Totalita dapat digunakan sebagai bukti pengembangan kompetensi ASN?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Ya. Sertifikat pelatihan dari Wahana Totalita dapat digunakan sebagai bukti pengembangan kompetensi ASN dalam rangka pemenuhan kewajiban 20 JP pengembangan per tahun sesuai UU ASN 5/2014 dan PP 17/2020. Sertifikat mencantumkan jumlah jam pelajaran, materi pelatihan, dan ditandatangani oleh instruktur berpengalaman. Untuk kebutuhan pengakuan formal dari BKN/BKPSDM, pastikan pelatihan sesuai ketentuan yang berlaku di instansi Anda.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apa perbedaan akuntansi pemerintah dengan akuntansi komersial yang perlu dipahami ASN?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Ada beberapa perbedaan mendasar: (1) Basis akuntansi: pemerintah menggunakan akrual (PP 71/2010) namun untuk penganggaran masih berbasis kas-modifikasian; (2) Tujuan laporan: pemerintah fokus pada akuntabilitas dan transparansi publik, bukan profit; (3) Standar: SAP (Standar Akuntansi Pemerintahan) yang berbeda dari SAK (Standar Akuntansi Keuangan PSAK); (4) Komponen laporan: pemerintah menyusun LRA (Laporan Realisasi Anggaran), LO (Laporan Operasional), Neraca, LPE (Laporan Perubahan Ekuitas), dan CaLK; (5) Pengawasan: pemerintah diaudit BPK (eksternal) dan APIP/Inspektorat (internal). Pelatihan kami membahas semua aspek ini secara praktis.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apa saja risiko hukum yang dihadapi bendahara instansi jika SPJ tidak benar?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Risiko hukum bendahara akibat SPJ tidak benar cukup serius: (1) Tuntutan ganti rugi kerugian negara oleh BPK (UU 15/2004) — bendahara dapat dituntut mengganti kerugian dari kantong pribadi; (2) Sanksi administratif: teguran, penilaian kinerja buruk, atau diberhentikan dari jabatan bendahara; (3) Sanksi pidana korupsi (UU 31/1999 jo UU 20/2001) jika terbukti menyalahgunakan keuangan negara — ancaman penjara 1–20 tahun dan denda yang sangat besar; (4) Temuan BPK yang dapat merusak reputasi instansi. Pelatihan kami secara khusus membahas praktik penyusunan SPJ yang aman dan sesuai ketentuan.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apa itu sistem SIPD dan SiLPA yang wajib dipahami pengelola keuangan daerah?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'SIPD (Sistem Informasi Pemerintahan Daerah) adalah platform digital terintegrasi Kemendagri untuk pengelolaan keuangan daerah: perencanaan (RPJMD, RKPD), penganggaran (KUA-PPAS, RKA-SKPD), penatausahaan, dan pelaporan keuangan daerah. Wajib digunakan seluruh pemda berdasarkan Permendagri 70/2019. SiLPA (Sisa Lebih Pembiayaan Anggaran) adalah selisih lebih antara realisasi pendapatan dan belanja APBD dalam satu tahun anggaran — wajib dimasukkan dalam perhitungan APBD tahun berikutnya. Pelatihan kami mencakup praktik penggunaan SIPD dan pemahaman pengelolaan SiLPA.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Berapa lama dan apa format pelatihan keuangan yang tersedia di Wahana Totalita?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Format pelatihan yang tersedia: (1) In-house 1 hari (6–8 JP): overview regulasi terkini, cocok untuk pembaruan pengetahuan staf keuangan; (2) In-house 2 hari (14–16 JP): pembahasan mendalam + praktik penyusunan laporan, paling populer; (3) Workshop intensif 3 hari (21 JP): modul lengkap + simulasi audit BPK + studi kasus; (4) Blended learning: pre-modul online + 1 hari tatap muka; (5) Refresher briefing 4 jam: khusus update regulasi terbaru (Permendagri, PMK baru). Semua format mencakup dokumen SPJ lengkap untuk pencairan anggaran pelatihan dinas.'],
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
<section style="background:linear-gradient(135deg,#0A3A5A 0%,#0A4A2E 60%,#1a4a0a 100%);color:#fff;padding:60px 20px 50px;">
  <div style="max-width:900px;margin:0 auto;">
    <nav aria-label="breadcrumb" style="font-size:0.85rem;opacity:0.8;margin-bottom:16px;">
      <a href="/" style="color:#a0d8f5;">Beranda</a> &rsaquo;
      <a href="/pelatihan/" style="color:#a0d8f5;">Pelatihan</a> &rsaquo;
      <span>Keuangan Daerah</span>
    </nav>
    <h1 style="font-size:clamp(1.6rem,4vw,2.4rem);font-weight:700;margin:0 0 16px;">
      Pelatihan Keuangan Daerah &amp; Akuntansi Pemerintahan untuk ASN
    </h1>
    <p style="font-size:1.05rem;opacity:0.92;max-width:720px;margin:0 0 10px;line-height:1.7;">
      Pelatihan bendahara instansi, pengelolaan APBD, akuntansi berbasis akrual (PP 71/2010), penyusunan SPJ, dan audit keuangan pemerintah — untuk ASN dan pengelola keuangan daerah di Yogyakarta, DIY, dan sekitarnya. In-house, tersertifikat, dokumen pengadaan langsung lengkap.
    </p>
    <div style="display:flex;flex-wrap:wrap;gap:10px;margin:18px 0 28px;">
      <span style="background:rgba(255,255,255,0.16);padding:6px 14px;border-radius:20px;font-size:0.85rem;">✓ Sesuai PP 71/2010 SAP Akrual</span>
      <span style="background:rgba(255,255,255,0.16);padding:6px 14px;border-radius:20px;font-size:0.85rem;">✓ Permendagri 77/2020</span>
      <span style="background:rgba(255,255,255,0.16);padding:6px 14px;border-radius:20px;font-size:0.85rem;">✓ Poin JP ASN (UU 5/2014)</span>
      <span style="background:rgba(255,255,255,0.16);padding:6px 14px;border-radius:20px;font-size:0.85rem;">✓ LPSE &amp; PADI Terdaftar</span>
      <span style="background:rgba(255,255,255,0.16);padding:6px 14px;border-radius:20px;font-size:0.85rem;">✓ Instruktur berpengalaman</span>
    </div>
    <a href="https://wa.me/6287759151278?text=Halo%2C+saya+ingin+info+pelatihan+keuangan+daerah+dan+akuntansi+pemerintahan+untuk+instansi+kami+di+Yogyakarta."
       target="_blank" rel="noopener"
       style="display:inline-block;background:#C6621C;color:#fff;padding:14px 32px;border-radius:6px;font-weight:700;text-decoration:none;font-size:1rem;">
      Konsultasi Program Pelatihan
    </a>
  </div>
</section>

<main style="max-width:960px;margin:0 auto;padding:40px 20px 60px;">

  <!-- REGULASI DASAR -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:24px;">
      Regulasi Utama Pengelolaan Keuangan Pemerintah
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:18px;">
      <?php
      $regs = [
        ['UU 17/2003','Keuangan Negara','Landasan hukum tertinggi pengelolaan APBN/APBD. Mengatur prinsip pengelolaan keuangan negara: efisien, efektif, transparan, bertanggung jawab, dan taat azas.','#e8f4eb'],
        ['UU 1/2004','Perbendaharaan Negara','Mengatur pengelolaan kas negara, penunjukan bendahara, pertanggungjawaban bendahara, dan mekanisme SPJ. Dasar hukum tugas dan tanggung jawab bendahara instansi.','#e8eef7'],
        ['PP 71/2010','Standar Akuntansi Pemerintahan (SAP)','Standar akuntansi berbasis akrual yang wajib diterapkan seluruh entitas pemerintah sejak 2015. Mengatur komponen laporan keuangan pemerintah: LRA, LO, Neraca, LPE, CaLK.','#f0f7e8'],
        ['Permendagri 77/2020','Pedoman Teknis Pengelolaan Keuangan Daerah','Menggantikan Permendagri 13/2006, mengatur teknis pengelolaan keuangan daerah mulai dari perencanaan APBD hingga pertanggungjawaban dan audit.','#fff8f0'],
        ['UU 15/2004','Pemeriksaan BPK','Mengatur kewenangan BPK memeriksa pengelolaan keuangan negara dan mekanisme tuntutan ganti rugi kepada bendahara yang menyebabkan kerugian negara.','#f7f0f7'],
        ['UU ASN 5/2014 & PP 17/2020','Pengembangan Kompetensi ASN','Mewajibkan setiap ASN mengembangkan kompetensi minimal 20 JP per tahun. Pelatihan keuangan termasuk dalam pengembangan kompetensi teknis yang diakui.','#f7f4e8'],
      ];
      foreach ($regs as $r): ?>
      <div style="background:<?php echo $r[3]; ?>;border-radius:10px;padding:20px;border-left:5px solid #0A4A2E;">
        <div style="font-weight:800;color:#C6621C;font-size:0.9rem;margin-bottom:4px;"><?php echo $r[0]; ?></div>
        <div style="font-weight:700;color:#0A4A2E;margin-bottom:8px;font-size:0.93rem;"><?php echo $r[1]; ?></div>
        <p style="color:#555;font-size:0.86rem;line-height:1.6;margin:0;"><?php echo $r[2]; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- TOPIK PELATIHAN -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Topik Pelatihan Keuangan yang Tersedia
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:20px;">
      <?php
      $clusters = [
        ['💰','Pengelolaan Keuangan Daerah (APBD)','Siklus APBD: perencanaan (KUA-PPAS, RKA-SKPD), penetapan, pelaksanaan, dan pertanggungjawaban. Pengelolaan kas daerah, penerbitan SPD, SPP, SPM, dan SP2D. Penggunaan sistem SIPD Kemendagri.'],
        ['📋','Penatausahaan Keuangan & SPJ','Teknik penyusunan SPJ yang aman: dokumen administrasi, bukti pengeluaran, verifikasi kwitansi, checklist kelengkapan. Pencegahan temuan BPK atas SPJ tidak valid.'],
        ['📊','Akuntansi Pemerintahan Berbasis Akrual','Penerapan SAP (PP 71/2010): perbedaan LRA dan LO, penjurnalan akrual, penyusunan neraca, dan CaLK. Rekonsiliasi internal antara pencatatan bendahara dan bagian akuntansi.'],
        ['🏦','Perbendaharaan Negara & Fungsi Bendahara','Tanggung jawab hukum bendahara (UU 1/2004), registrasi di RKAKL, koordinasi dengan KPPN, pengelolaan UP/TUP/LS, rekonsiliasi bank, dan pertanggungjawaban akhir tahun.'],
        ['🔍','Audit Internal & Persiapan Pemeriksaan BPK','Prosedur dan substansi pemeriksaan BPK. Peran APIP/Inspektorat. Checklist kesiapan audit: dokumentasi, rekonsiliasi, temuan terdahulu. Tindak lanjut hasil pemeriksaan (TLHP).'],
        ['💻','Aplikasi Keuangan Pemerintah (SIPD, SIMDA)','Praktik penggunaan SIPD (Sistem Informasi Pemerintahan Daerah) untuk APBD daerah, SIMDA (untuk pemda pengguna), dan aplikasi pendukung lain. Penginputan data dan pelaporan digital.'],
      ];
      foreach ($clusters as $c): ?>
      <div style="background:#fff;border:1px solid #ddd;border-radius:10px;padding:20px;border-top:4px solid #C6621C;">
        <div style="font-size:1.8rem;margin-bottom:10px;"><?php echo $c[0]; ?></div>
        <div style="font-weight:700;color:#0A4A2E;margin-bottom:8px;font-size:0.95rem;"><?php echo $c[1]; ?></div>
        <p style="color:#555;font-size:0.87rem;line-height:1.6;margin:0;"><?php echo $c[2]; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- PROGRAM CARDS -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Program Pelatihan Keuangan
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:18px;">
      <?php
      $programs = [
        ['Pengelolaan Keuangan Daerah Komprehensif','2 hari / 14 JP','ASN pengelola keuangan (PPK, PPTK, staf keuangan), Kepala Sub-Bagian Keuangan, Kasubbag Perencanaan'],
        ['Pelatihan Bendahara Pengeluaran','1 hari / 8 JP','Bendahara pengeluaran, bendahara pengeluaran pembantu, dan calon bendahara yang baru ditunjuk'],
        ['Akuntansi Pemerintahan Akrual (PP 71/2010)','2 hari / 14 JP','Staf akuntansi, operator SIMDA/SIPD, dan pejabat keuangan yang perlu update kompetensi SAP akrual'],
        ['Penyusunan Laporan Keuangan Pemerintah','2 hari / 14 JP','Kepala Sub-Bagian Akuntansi, operator laporan, dan PPKD/PPK-SKPD yang bertanggung jawab menyusun laporan keuangan akhir tahun'],
        ['Audit Internal & Kesiapan Pemeriksaan BPK','1 hari / 8 JP','Inspektur, auditor APIP, PPK, dan pejabat yang sering berinteraksi dengan tim BPK'],
        ['Pelatihan Pengadaan Barang/Jasa & SPJ','1 hari / 8 JP','Panitia pengadaan, PPK, dan bendahara yang menangani pertanggungjawaban belanja pengadaan'],
        ['Manajemen Risiko Keuangan Instansi','1 hari / 8 JP','Pejabat struktural eselon III–IV, Kepala Bagian Keuangan, dan APIP'],
        ['Update Regulasi Keuangan Terbaru','Half-day / 4 JP','Seluruh staf keuangan, sebagai refresher tahunan untuk update Permendagri, PMK, dan SE terbaru'],
      ];
      foreach ($programs as $p): ?>
      <div style="background:#f9f9f9;border:1px solid #e0e0e0;border-radius:8px;padding:18px;">
        <div style="font-weight:700;color:#0A4A2E;margin-bottom:6px;font-size:0.93rem;"><?php echo $p[0]; ?></div>
        <div style="font-size:0.82rem;color:#C6621C;font-weight:600;margin-bottom:6px;"><?php echo $p[1]; ?></div>
        <div style="font-size:0.83rem;color:#666;margin-bottom:14px;line-height:1.5;"><?php echo $p[2]; ?></div>
        <a href="https://wa.me/6287759151278?text=Halo%2C+saya+tertarik+pelatihan+<?php echo urlencode($p[0]); ?>+untuk+instansi+kami.+Mohon+info+jadwal+dan+harga."
           target="_blank" rel="noopener"
           style="display:inline-block;background:#0A4A2E;color:#fff;padding:7px 16px;border-radius:4px;text-decoration:none;font-size:0.82rem;font-weight:600;">
          Tanya via WhatsApp →
        </a>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- RISIKO & ASPEK HUKUM -->
  <section style="margin-bottom:48px;background:#fff8f0;border-radius:10px;padding:28px;border-left:6px solid #C6621C;">
    <h2 style="color:#0A4A2E;font-size:1.4rem;margin:0 0 16px;">Risiko Hukum Bendahara — Mengapa Pelatihan Ini Penting</h2>
    <p style="color:#333;line-height:1.8;margin:0 0 16px;font-size:0.92rem;">Bendahara instansi memiliki tanggung jawab hukum yang sangat besar. Kesalahan dalam penyusunan SPJ atau pengelolaan kas negara bisa berujung pada:</p>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:14px;">
      <?php
      $risks = [
        ['⚖️','Tuntutan Ganti Rugi BPK','Berdasarkan UU 15/2004, BPK dapat menetapkan kerugian negara dan menuntut bendahara untuk mengganti dari harta pribadi.'],
        ['🚨','Pidana Korupsi (UU 31/1999)','Jika terbukti menyalahgunakan, ancaman penjara 1–20 tahun dan denda hingga miliaran rupiah.'],
        ['📉','Nilai LHKPN & Penilaian Kinerja','Temuan BPK berdampak negatif pada penilaian kinerja instansi secara keseluruhan dan karier pejabat yang bersangkutan.'],
        ['🔒','Pemberhentian dari Jabatan','Bendahara yang sering bermasalah dapat diberhentikan dari jabatan keuangan dan dikenakan hukuman disiplin ASN.'],
      ];
      foreach ($risks as $r): ?>
      <div style="background:#fff;border-radius:6px;padding:14px;">
        <div style="font-size:1.3rem;margin-bottom:6px;"><?php echo $r[0]; ?></div>
        <div style="font-weight:600;color:#C6621C;margin-bottom:4px;font-size:0.88rem;"><?php echo $r[1]; ?></div>
        <p style="color:#555;font-size:0.83rem;line-height:1.5;margin:0;"><?php echo $r[2]; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- LAPORAN KEUANGAN PEMERINTAH -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Komponen Laporan Keuangan Pemerintah (SAP PP 71/2010)
    </h2>
    <div style="overflow-x:auto;">
      <table style="width:100%;border-collapse:collapse;font-size:0.9rem;">
        <thead>
          <tr style="background:#0A4A2E;color:#fff;">
            <th style="padding:10px 14px;text-align:left;">Komponen Laporan</th>
            <th style="padding:10px 14px;text-align:left;">Basis</th>
            <th style="padding:10px 14px;text-align:left;">Isi / Cakupan</th>
            <th style="padding:10px 14px;text-align:left;">Pengguna Utama</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $reports = [
            ['LRA (Laporan Realisasi Anggaran)','Kas','Ikhtisar sumber, alokasi, dan pemakaian sumber daya keuangan dikelola pemerintah. Menunjukkan realisasi vs anggaran.','DPR/DPRD, pengawas anggaran'],
            ['LO (Laporan Operasional)','Akrual','Pendapatan-LO dan beban periode berjalan. Tidak termasuk transaksi modal/pembiayaan.','Auditor, penyusun laporan'],
            ['Neraca','Akrual','Posisi aset, kewajiban, dan ekuitas pemerintah pada tanggal tertentu (biasanya 31 Desember).','BPK, Kemenkeu, publik'],
            ['LPE (Lap. Perubahan Ekuitas)','Akrual','Kenaikan/penurunan ekuitas selama periode pelaporan. Jembatan antara Neraca dan LO.','Auditor, BPK'],
            ['CaLK (Catatan atas Laporan Keuangan)','Gabungan','Penjelasan naratif dan kuantitatif atas pos-pos dalam LRA, LO, Neraca, dan LPE. Sangat penting untuk audit BPK.','BPK, APIP, publik'],
            ['LAK (Lap. Arus Kas) — hanya BUN','Kas','Arus kas masuk dan keluar dari kegiatan operasi, investasi, dan pembiayaan. Hanya untuk Bendahara Umum Negara/Daerah.','Kemenkeu/BUD'],
          ];
          foreach ($reports as $i => $r):
            $bg = $i%2===0?'#fff':'#f5f5f5';
          ?>
          <tr style="background:<?php echo $bg; ?>;">
            <td style="padding:9px 14px;border-bottom:1px solid #eee;font-weight:600;color:#0A4A2E;font-size:0.88rem;"><?php echo $r[0]; ?></td>
            <td style="padding:9px 14px;border-bottom:1px solid #eee;"><span style="background:<?php echo $r[1]==='Akrual'?'#e8f4eb':($r[1]==='Kas'?'#fff8f0':'#f0f0f0'); ?>;padding:3px 8px;border-radius:12px;font-size:0.8rem;font-weight:600;"><?php echo $r[1]; ?></span></td>
            <td style="padding:9px 14px;border-bottom:1px solid #eee;color:#444;font-size:0.86rem;"><?php echo $r[2]; ?></td>
            <td style="padding:9px 14px;border-bottom:1px solid #eee;color:#666;font-size:0.84rem;"><?php echo $r[3]; ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </section>

  <!-- PROCUREMENT TABLE -->
  <section style="margin-bottom:48px;background:#f0f7f3;border-radius:10px;padding:28px;">
    <h2 style="color:#0A4A2E;font-size:1.4rem;margin:0 0 14px;">Dokumen Pengadaan — SPJ Pelatihan untuk Instansi</h2>
    <p style="color:#333;line-height:1.7;margin:0 0 16px;font-size:0.92rem;">Terdaftar LPSE dan PADI UMKM kategori <strong>Pendidikan dan Pelatihan</strong>. Pengadaan langsung tanpa tender untuk nilai di bawah Rp 200 juta. Dokumen SPJ lengkap:</p>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:12px;">
      <?php
      $docs = [
        ['📄','Surat Penawaran Harga','Resmi bermaterai dari PT Kreasi Ultimate Berjaya, rinci per program dan per peserta.'],
        ['📊','RAB Pelatihan','Rincian per komponen: instruktur, modul, konsumsi, sertifikat, dan fasilitas.'],
        ['🧾','Faktur Pajak (PPN)','Faktur pajak resmi untuk pengeluaran yang memerlukan pajak pertambahan nilai.'],
        ['📋','BAST Pelatihan','Berita Acara Serah Terima: ditandatangani perwakilan instansi sebagai bukti pelaksanaan.'],
        ['📸','Dokumentasi Foto','Foto kegiatan pelatihan: presensi, sesi materi, dan foto peserta bersama instruktur.'],
        ['📜','Daftar Hadir + Sertifikat','Daftar hadir ditandatangani peserta, sertifikat berlogo dan ditandatangani resmi.'],
      ];
      foreach ($docs as $d): ?>
      <div style="background:#fff;border-radius:6px;padding:14px;">
        <div style="font-size:1.3rem;margin-bottom:6px;"><?php echo $d[0]; ?></div>
        <div style="font-weight:600;color:#0A4A2E;margin-bottom:4px;font-size:0.87rem;"><?php echo $d[1]; ?></div>
        <p style="color:#555;font-size:0.82rem;line-height:1.5;margin:0;"><?php echo $d[2]; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- RELATED LINKS -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.4rem;border-bottom:2px solid #e0e0e0;padding-bottom:8px;margin-bottom:16px;">Pelatihan Terkait untuk Instansi</h2>
    <div style="display:flex;flex-wrap:wrap;gap:12px;">
      <?php
      $related = [
        ['/pelatihan-manajemen-sdm/','Pelatihan Manajemen SDM & Leadership ASN'],
        ['/akomodasi/','Akomodasi Hotel untuk Diklat Instansi'],
        ['/event-organizer/','Event Organizer Kegiatan Kedinasan'],
        ['/catering/','Catering & Konsumsi Kegiatan Dinas'],
      ];
      foreach ($related as $r): ?>
      <a href="<?php echo $r[0]; ?>" style="display:inline-block;background:#fff;border:1px solid #c0d8c8;border-radius:6px;padding:10px 16px;color:#0A4A2E;text-decoration:none;font-size:0.88rem;font-weight:600;" onmouseover="this.style.background='#e8f4eb'" onmouseout="this.style.background='#fff'"><?php echo $r[1]; ?></a>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- FAQ -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:24px;">Pertanyaan yang Sering Diajukan</h2>
    <?php
    $faqs = [
      ['Regulasi utama apa yang wajib dipahami bendahara instansi?','UU 17/2003 (Keuangan Negara), UU 1/2004 (Perbendaharaan Negara), PP 71/2010 (SAP akrual), Permendagri 77/2020 (keuangan daerah), UU 15/2004 (audit BPK), dan UU ASN 5/2014 (pengembangan kompetensi 20 JP/tahun).'],
      ['Apakah sertifikat pelatihan Wahana diakui untuk pemenuhan JP ASN?','Ya. Sertifikat kami dapat digunakan sebagai bukti pengembangan kompetensi ASN (20 JP/tahun per UU ASN 5/2014 dan PP 17/2020). Sertifikat mencantumkan jumlah JP, materi, dan ditandatangani instruktur berpengalaman.'],
      ['Apa perbedaan utama akuntansi pemerintah vs akuntansi komersial?','Standar berbeda (SAP vs SAK/PSAK), tujuan berbeda (akuntabilitas publik vs profit), laporan berbeda (LRA + LO + Neraca + LPE + CaLK vs neraca + laporan laba rugi komersial), dan diaudit BPK (bukan akuntan publik biasa).'],
      ['Apa risiko hukum bendahara jika SPJ tidak benar?','Tuntutan ganti rugi kerugian negara (BPK, UU 15/2004), sanksi administratif/pemberhentian jabatan, dan jika terbukti menyalahgunakan — pidana korupsi (UU 31/1999, ancaman 1–20 tahun penjara + denda besar).'],
      ['Apa itu SIPD dan SiLPA yang wajib dipahami pengelola keuangan daerah?','SIPD = platform digital Kemendagri untuk pengelolaan keuangan daerah (Permendagri 70/2019), wajib semua pemda. SiLPA = sisa lebih pembiayaan anggaran (selisih realisasi APBD) — wajib masuk perhitungan APBD tahun berikutnya.'],
      ['Berapa lama dan format apa pelatihan keuangan yang tersedia?','In-house 1 hari (8 JP), 2 hari (14 JP), atau workshop 3 hari (21 JP). Ada juga blended learning dan refresher half-day (4 JP) untuk update regulasi terbaru. Semua format termasuk dokumen SPJ lengkap.'],
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
  <section style="background:linear-gradient(135deg,#0A3A5A,#0A4A2E);color:#fff;border-radius:12px;padding:40px;text-align:center;">
    <h2 style="margin:0 0 12px;font-size:1.6rem;">Rencanakan Pelatihan Keuangan untuk Instansi Anda</h2>
    <p style="opacity:0.9;margin:0 0 10px;line-height:1.7;max-width:580px;margin-left:auto;margin-right:auto;">
      Hubungi kami untuk mendapatkan proposal pelatihan keuangan daerah yang disesuaikan dengan kebutuhan dan anggaran instansi Anda — dilengkapi dokumen pengadaan langsung yang siap digunakan.
    </p>
    <p style="opacity:0.75;font-size:0.9rem;margin:0 0 24px;">LPSE &amp; PADI terdaftar · Pengadaan langsung &lt; Rp 200 juta · Dokumen SPJ lengkap</p>
    <a href="https://wa.me/6287759151278?text=Halo%2C+saya+ingin+proposal+pelatihan+keuangan+daerah+untuk+instansi+kami.+Mohon+info+program+dan+harga."
       target="_blank" rel="noopener"
       style="display:inline-block;background:#C6621C;color:#fff;padding:14px 36px;border-radius:6px;font-weight:700;text-decoration:none;font-size:1.05rem;">
      WhatsApp: 0877-5915-1278
    </a>
  </section>

</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>
</html>
