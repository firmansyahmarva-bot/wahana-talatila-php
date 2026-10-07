<?php
require_once __DIR__ . '/config.php';
$s = get_all_settings();
// Hub: Pelatihan Pengadaan Barang/Jasa Pemerintah (PBJP)
$canonical = 'https://wahanatotalita.com/pelatihan-pengadaan-barang-jasa/';
$meta_title = 'Pelatihan Pengadaan Barang Jasa Pemerintah (PBJP) Yogyakarta — Wahana Totalita';
$meta_desc  = 'Pelatihan pengadaan barang dan jasa pemerintah (PBJP) untuk PPK, PPTK, panitia pengadaan, dan ASN di Yogyakarta. Perpres 16/2018, Perlem LKPP, e-Purchasing, SiRUP, LPSE.';

$schema = [
  [
    '@context' => 'https://schema.org',
    '@type'    => 'BreadcrumbList',
    'itemListElement' => [
      ['@type'=>'ListItem','position'=>1,'name'=>'Beranda','item'=>'https://wahanatotalita.com/'],
      ['@type'=>'ListItem','position'=>2,'name'=>'Pelatihan','item'=>'https://wahanatotalita.com/pelatihan/'],
      ['@type'=>'ListItem','position'=>3,'name'=>'Pelatihan PBJP','item'=>$canonical],
    ],
  ],
  [
    '@context' => 'https://schema.org',
    '@type'    => 'FAQPage',
    'mainEntity' => [
      [
        '@type' => 'Question',
        'name'  => 'Apa perbedaan PPK, PPTK, dan Pokja Pemilihan dalam pengadaan pemerintah?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Dalam sistem pengadaan pemerintah berdasarkan Perpres 16/2018: PPK (Pejabat Pembuat Komitmen) adalah pejabat yang ditetapkan PA/KPA untuk melaksanakan pengadaan — bertanggung jawab atas perencanaan, penandatanganan kontrak, dan pengendalian pelaksanaan kontrak. PPTK (Pejabat Pelaksana Teknis Kegiatan) membantu PPK dalam administrasi kegiatan di lingkup SKPD. Pokja Pemilihan (dahulu Pokja ULP) adalah tim yang bertugas melaksanakan pemilihan penyedia — membuat dokumen pemilihan, mengumumkan tender, dan menetapkan pemenang. Ketiganya memiliki kewenangan, tanggung jawab, dan risiko hukum yang berbeda.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apa metode pengadaan yang berlaku berdasarkan Perpres 16/2018?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Berdasarkan Perpres 16/2018 jo Perpres 12/2021, metode pengadaan barang/jasa pemerintah adalah: (1) E-Purchasing untuk barang/jasa yang ada di katalog elektronik LKPP; (2) Pengadaan Langsung untuk nilai ≤ Rp 200 juta (barang/pekerjaan konstruksi/jasa lainnya) atau ≤ Rp 100 juta (jasa konsultansi); (3) Penunjukan Langsung untuk kondisi tertentu (darurat, kerahasiaan, satu penyedia); (4) Tender Cepat untuk spek dan harga sudah jelas; (5) Tender untuk umum di atas ambang pengadaan langsung; (6) Seleksi untuk jasa konsultansi badan usaha. Pemilihan metode harus tepat sesuai ketentuan — kesalahan metode adalah temuan BPK.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apa saja kesalahan pengadaan yang paling sering ditemukan BPK?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Temuan BPK yang paling sering terjadi dalam pengadaan: (1) Pemecahan paket — memecah kegiatan menjadi beberapa paket kecil untuk menghindari tender (melanggar Pasal 22 Perpres 16/2018); (2) Spesifikasi teknis mengarah ke merek/produk tertentu; (3) Tidak menggunakan e-Catalog untuk barang yang tersedia di katalog LKPP; (4) Kontrak tidak sesuai ketentuan — HPS tidak wajar, jaminan tidak lengkap; (5) Addendum melampaui batas; (6) Pembayaran tidak sesuai progres fisik/prestasi; (7) Denda keterlambatan tidak dipungut dari penyedia yang terlambat selesai. Pelatihan kami membahas seluruh aspek pencegahan temuan ini.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apakah Wahana Totalita terdaftar sebagai penyedia jasa pelatihan di LKPP atau SiKAP?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'PT Kreasi Ultimate Berjaya (Wahana Totalita) terdaftar di PADI UMKM dan LPSE DIY untuk kategori Pendidikan dan Pelatihan. SiKAP (Sistem Informasi Kinerja Penyedia) LKPP mencatat data penyedia berdasarkan riwayat pengadaan yang telah dilaksanakan. Untuk konfirmasi status terkini di SiKAP, hubungi kami langsung via WhatsApp — kami siapkan dokumen legalitas lengkap untuk keperluan verifikasi instansi Anda.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apa itu SiRUP dan mengapa wajib diisi sebelum pengadaan dimulai?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'SiRUP (Sistem Informasi Rencana Umum Pengadaan) adalah aplikasi LKPP tempat seluruh instansi pemerintah wajib mengumumkan rencana pengadaan sebelum tahun anggaran berjalan dan sebelum pengadaan dilaksanakan. Kewajiban ini diatur dalam Perpres 16/2018 dan dipertegas Perlem LKPP. Manfaat SiRUP: transparansi pengadaan, basis data bagi penyedia untuk mempersiapkan penawaran, dan bahan monitoring KPK/BPKP. Jika pengadaan dilaksanakan tanpa terlebih dahulu diumumkan di SiRUP, ini adalah temuan administratif BPK. Pelatihan kami mencakup praktik pengisian dan pembaruan data di SiRUP.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Berapa besaran denda keterlambatan yang wajib dikenakan kepada penyedia dan bagaimana cara menghitungnya?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Berdasarkan Perlem LKPP 12/2021, denda keterlambatan penyedia adalah 1/1000 (satu per seribu) dari nilai kontrak atau nilai bagian kontrak yang belum diselesaikan, per hari kalender keterlambatan. Contoh: kontrak Rp 100 juta, terlambat 10 hari → denda Rp 100 juta × 1/1000 × 10 = Rp 1.000.000. Denda ini WAJIB dipungut — tidak dipungutnya denda keterlambatan adalah temuan BPK dan masuk kategori kerugian negara. Denda dipotong dari pembayaran atau dicairkan dari jaminan pelaksanaan.'],
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
<section style="background:linear-gradient(135deg,#2a0a5a 0%,#0A4A2E 70%,#0A3A5A 100%);color:#fff;padding:60px 20px 50px;">
  <div style="max-width:900px;margin:0 auto;">
    <nav aria-label="breadcrumb" style="font-size:0.85rem;opacity:0.8;margin-bottom:16px;">
      <a href="/" style="color:#a0d8f5;">Beranda</a> &rsaquo;
      <a href="/pelatihan/" style="color:#a0d8f5;">Pelatihan</a> &rsaquo;
      <span>Pengadaan Barang/Jasa</span>
    </nav>
    <h1 style="font-size:clamp(1.6rem,4vw,2.4rem);font-weight:700;margin:0 0 16px;">
      Pelatihan Pengadaan Barang/Jasa Pemerintah (PBJP) Yogyakarta
    </h1>
    <p style="font-size:1.05rem;opacity:0.92;max-width:720px;margin:0 0 10px;line-height:1.7;">
      Pelatihan komprehensif pengadaan barang dan jasa pemerintah untuk PPK, PPTK, Pokja Pemilihan, dan staf keuangan instansi — mencakup Perpres 16/2018 jo Perpres 12/2021, e-Purchasing, SiRUP, LPSE, kontrak pemerintah, dan pencegahan temuan BPK. In-house di instansi Anda, dokumen SPJ lengkap.
    </p>
    <div style="display:flex;flex-wrap:wrap;gap:10px;margin:18px 0 28px;">
      <span style="background:rgba(255,255,255,0.16);padding:6px 14px;border-radius:20px;font-size:0.85rem;">✓ Perpres 16/2018 & 12/2021</span>
      <span style="background:rgba(255,255,255,0.16);padding:6px 14px;border-radius:20px;font-size:0.85rem;">✓ Perlem LKPP Terbaru</span>
      <span style="background:rgba(255,255,255,0.16);padding:6px 14px;border-radius:20px;font-size:0.85rem;">✓ Poin JP ASN</span>
      <span style="background:rgba(255,255,255,0.16);padding:6px 14px;border-radius:20px;font-size:0.85rem;">✓ Studi Kasus Temuan BPK</span>
      <span style="background:rgba(255,255,255,0.16);padding:6px 14px;border-radius:20px;font-size:0.85rem;">✓ Pengadaan Langsung tersedia</span>
    </div>
    <a href="https://wa.me/6287759151278?text=Halo%2C+saya+ingin+info+pelatihan+pengadaan+barang+jasa+pemerintah+%28PBJP%29+untuk+instansi+kami+di+Yogyakarta."
       target="_blank" rel="noopener"
       style="display:inline-block;background:#C6621C;color:#fff;padding:14px 32px;border-radius:6px;font-weight:700;text-decoration:none;font-size:1rem;">
      Konsultasi Program Pelatihan
    </a>
  </div>
</section>

<main style="max-width:960px;margin:0 auto;padding:40px 20px 60px;">

  <!-- REGULASI -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:24px;">
      Regulasi Utama Pengadaan Barang/Jasa Pemerintah
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:18px;">
      <?php
      $regs = [
        ['Perpres 16/2018','Pengadaan Barang/Jasa Pemerintah','Regulasi induk pengadaan pemerintah yang berlaku. Menetapkan prinsip, metode, pelaku, dan tata cara pengadaan. Diubah sebagian oleh Perpres 12/2021 untuk memperkuat UMKM dan produk dalam negeri.','#e8f4eb'],
        ['Perpres 12/2021','Perubahan Perpres 16/2018','Memperkuat keberpihakan pada produk dalam negeri (PDN) dan UMKM: ambang pengadaan langsung naik, kewajiban e-Purchasing diperluas, dan pengaturan P3DN dipertegas.','#e8eef7'],
        ['Perlem LKPP 12/2021','Pedoman Pengadaan Barang/Jasa Pemerintah','Petunjuk teknis pelaksanaan Perpres 16/2018 — mengatur detail prosedur, dokumen, dan standar untuk setiap metode pengadaan.','#f0f7e8'],
        ['Perlem LKPP 11/2021','E-Katalog dan E-Purchasing','Mengatur penggunaan katalog elektronik nasional, sektoral, dan lokal. E-Purchasing wajib didahulukan jika barang/jasa tersedia di katalog LKPP.','#fff8f0'],
        ['Perlem LKPP 9/2018','Jabatan Fungsional PPBJ','Mengatur Jabatan Fungsional Pengelola Pengadaan Barang/Jasa (PPBJ) — kompetensi, jenjang, angka kredit, dan kewenangan PPBJ dalam proses pengadaan.','#f7f4e8'],
        ['UU 2/2017 & PP 22/2020','Jasa Konstruksi','Regulasi khusus untuk pengadaan pekerjaan konstruksi: persyaratan SBUJK, SBU subkontraktor, dan K3 konstruksi yang wajib dipenuhi penyedia jasa konstruksi.','#f0e8f7'],
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

  <!-- METODE PENGADAAN -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Metode Pengadaan (Perpres 16/2018 jo 12/2021)
    </h2>
    <div style="overflow-x:auto;">
      <table style="width:100%;border-collapse:collapse;font-size:0.88rem;">
        <thead>
          <tr style="background:#0A4A2E;color:#fff;">
            <th style="padding:10px 14px;text-align:left;">Metode</th>
            <th style="padding:10px 14px;text-align:left;">Nilai / Kondisi</th>
            <th style="padding:10px 14px;text-align:left;">Yang Melaksanakan</th>
            <th style="padding:10px 14px;text-align:left;">Catatan Penting</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $methods = [
            ['E-Purchasing','Tidak ada batas nilai — wajib jika tersedia di e-Catalog','PPK / Pejabat Pengadaan','Didahulukan! Jika barang/jasa ada di katalog LKPP, e-purchasing WAJIB dilakukan terlebih dahulu.'],
            ['Pengadaan Langsung','≤ Rp 200 jt (B/PK/JL) atau ≤ Rp 100 jt (JK)','Pejabat Pengadaan (1 orang)','Tidak perlu tender — cukup 1 penawaran dan negosiasi. Wahana Totalita masuk kategori ini.'],
            ['Penunjukan Langsung','Kondisi tertentu: darurat, kerahasiaan, 1 penyedia di pasar','PPK + Pokja','Harus ada justifikasi tertulis yang kuat. Sering jadi temuan BPK jika alasannya lemah.'],
            ['Tender Cepat','Spesifikasi dan harga sudah jelas, ada di SIKAP','Pokja Pemilihan','Proses lebih cepat dari tender biasa — cocok untuk barang standar yang spesifikasi sudah baku.'],
            ['Tender / Seleksi','> Rp 200 jt (B/PK/JL) atau > Rp 100 jt (JK)','Pokja Pemilihan (min. 3 orang)','Proses paling panjang: pengumuman, dokumen, evaluasi, sanggah, penetapan pemenang.'],
            ['Swakelola','Nilai bervariasi, dilaksanakan sendiri/instansi lain','PPK + Tim Pelaksana Swakelola','4 tipe swakelola. Bukan berarti bebas administrasi — tetap perlu perencanaan dan SPJ yang ketat.'],
          ];
          foreach ($methods as $i => $m):
            $bg = $i%2===0?'#fff':'#f5f5f5';
          ?>
          <tr style="background:<?php echo $bg; ?>;">
            <td style="padding:9px 14px;border-bottom:1px solid #eee;font-weight:700;color:#0A4A2E;font-size:0.87rem;"><?php echo $m[0]; ?></td>
            <td style="padding:9px 14px;border-bottom:1px solid #eee;color:#444;font-size:0.85rem;"><?php echo $m[1]; ?></td>
            <td style="padding:9px 14px;border-bottom:1px solid #eee;color:#555;font-size:0.84rem;"><?php echo $m[2]; ?></td>
            <td style="padding:9px 14px;border-bottom:1px solid #eee;color:#666;font-size:0.83rem;"><?php echo $m[3]; ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </section>

  <!-- PERAN DALAM PENGADAAN -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Peran &amp; Tanggung Jawab dalam Pengadaan
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:16px;">
      <?php
      $roles = [
        ['background:#0A4A2E;color:#fff','PA / KPA','Pengguna Anggaran / Kuasa Pengguna Anggaran','Menetapkan PPK, Pokja, dan Pejabat Pengadaan. Bertanggung jawab atas pengelolaan anggaran kegiatan secara keseluruhan. Menandatangani kontrak bernilai besar.'],
        ['background:#1a5a3a;color:#fff','PPK','Pejabat Pembuat Komitmen','Menetapkan HPS dan spesifikasi teknis, menandatangani kontrak, mengendalikan pelaksanaan kontrak, menerima hasil pekerjaan, dan mengajukan pembayaran. Risiko hukum tertinggi.'],
        ['background:#0A3A5A;color:#fff','Pokja Pemilihan','Kelompok Kerja Pemilihan (min. 3 org)','Membuat dokumen pemilihan, melaksanakan proses tender/seleksi, mengevaluasi penawaran, menetapkan pemenang, dan membuat laporan pemilihan.'],
        ['background:#3a2a0a;color:#fff','Pejabat Pengadaan','1 orang untuk pengadaan langsung','Khusus untuk pengadaan langsung dan penunjukan langsung di bawah ambang batas. Menetapkan penyedia, mengklarifikasi spesifikasi, dan mendokumentasikan proses.'],
        ['background:#5a0a2a;color:#fff','PPTK','Pejabat Pelaksana Teknis Kegiatan','Membantu PPK dalam administrasi kegiatan di SKPD: koordinasi teknis, verifikasi progres, penyiapan dokumen tagihan, dan monitoring pelaksanaan di lapangan.'],
        ['background:#2a5a0a;color:#fff','Pengelola Keuangan','Bendahara + Staf Keuangan','Verifikasi kelengkapan dokumen pembayaran, penerbitan SPP dan SPM, koordinasi dengan BPPKAD/KPPN, dan penyusunan laporan keuangan kegiatan.'],
      ];
      foreach ($roles as $r): ?>
      <div style="<?php echo $r[0]; ?>;border-radius:10px;padding:18px;">
        <div style="font-size:1.1rem;font-weight:800;margin-bottom:4px;opacity:0.9;"><?php echo $r[1]; ?></div>
        <div style="font-weight:700;font-size:0.88rem;margin-bottom:8px;opacity:0.85;"><?php echo $r[2]; ?></div>
        <p style="font-size:0.84rem;line-height:1.6;margin:0;opacity:0.82;"><?php echo $r[3]; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- TEMUAN BPK -->
  <section style="margin-bottom:48px;background:#fff3f0;border-radius:10px;padding:28px;border-left:6px solid #C6621C;">
    <h2 style="color:#0A4A2E;font-size:1.4rem;margin:0 0 14px;">⚠ Temuan BPK Paling Sering — Pahami Sebelum Terlambat</h2>
    <p style="color:#333;line-height:1.7;margin:0 0 16px;font-size:0.92rem;">Berdasarkan laporan IHPS BPK, ini adalah temuan paling berulang dalam pengadaan pemerintah yang wajib diketahui setiap PPK dan Pokja:</p>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(230px,1fr));gap:14px;">
      <?php
      $findings = [
        ['🔪','Pemecahan Paket','Memecah satu paket besar menjadi beberapa paket kecil untuk menghindari tender (Pasal 22 Perpres 16/2018). Risiko: tuntutan pidana korupsi.'],
        ['📋','HPS Tidak Wajar','HPS jauh di atas atau di bawah harga pasar tanpa justifikasi yang memadai. Pembuatan HPS wajib berdasarkan survei harga yang terdokumentasi.'],
        ['🔖','Spek Mengarah ke Merek','Spesifikasi teknis yang hanya bisa dipenuhi satu merek/penyedia tanpa justifikasi. Melanggar prinsip persaingan sehat.'],
        ['⏰','Denda Tidak Dipungut','Tidak mengenakan denda 1/1000 per hari kepada penyedia yang terlambat. BPK menghitung ini sebagai kerugian negara.'],
        ['📦','Volume Tidak Sesuai','Pembayaran tidak sesuai volume/progres pekerjaan yang sebenarnya diselesaikan. Temuan paling sering di pekerjaan konstruksi dan pengadaan barang.'],
        ['💻','Tidak Pakai E-Catalog','Membeli barang melalui pengadaan langsung/tender padahal barang tersedia di katalog elektronik LKPP — melanggar kewajiban e-purchasing.'],
      ];
      foreach ($findings as $f): ?>
      <div style="background:#fff;border-radius:6px;padding:14px;border-top:3px solid #C6621C;">
        <div style="font-size:1.3rem;margin-bottom:6px;"><?php echo $f[0]; ?></div>
        <div style="font-weight:600;color:#C6621C;margin-bottom:4px;font-size:0.88rem;"><?php echo $f[1]; ?></div>
        <p style="color:#555;font-size:0.83rem;line-height:1.5;margin:0;"><?php echo $f[2]; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- PROGRAM PELATIHAN -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Program Pelatihan PBJP yang Tersedia
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:18px;">
      <?php
      $programs = [
        ['Pengadaan Barang/Jasa Dasar (PPK & Pejabat Pengadaan)','2 hari / 14 JP','PPK baru, PPTK, Pejabat Pengadaan, dan staf yang baru menangani pengadaan. Fokus: alur, metode, dokumen, dan HPS.'],
        ['Pengelolaan Kontrak Pemerintah','1 hari / 8 JP','PPK, PPTK, dan pengawas lapangan yang mengelola kontrak aktif. Fokus: jenis kontrak, addendum, denda, BAST, dan pembayaran.'],
        ['E-Purchasing & Katalog Elektronik LKPP','Half-day / 4 JP','Seluruh staf pengadaan yang perlu update cara belanja di e-Catalog LKPP — prosedur, verifikasi produk, dan pembayaran melalui SPSE.'],
        ['SiRUP & Perencanaan Pengadaan','Half-day / 4 JP','Perencana anggaran, PPK, dan staf keuangan. Praktik mengisi SiRUP, membuat RUP SKPD, dan integrasi dengan RKA-SKPD.'],
        ['Pokja Pemilihan — Tender & Seleksi','2 hari / 14 JP','Anggota Pokja Pemilihan, LPSE admin, dan PPK yang ingin memahami proses tender dari sisi panitia. Termasuk evaluasi penawaran dan sanggah.'],
        ['Pencegahan Korupsi dalam Pengadaan','1 hari / 8 JP','Semua pelaku pengadaan. Kolaborasi dengan KPK/Inspektorat: titik rawan korupsi, gratifikasi, dan cara melaporkan penyimpangan.'],
        ['Update Regulasi Pengadaan Terbaru','Half-day / 4 JP','Refresher tahunan untuk semua staf pengadaan: update Perpres, Perlem LKPP, dan SE LKPP terbaru yang mempengaruhi praktik sehari-hari.'],
        ['Pengadaan Pekerjaan Konstruksi (PPK & Pokja)','2 hari / 14 JP','PPK dan Pokja yang menangani tender konstruksi. Fokus: spesifikasi teknis, HPS konstruksi, sub-kontraktor, K3 konstruksi, dan BAST.'],
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

  <!-- ALUR PENGADAAN LANGSUNG -->
  <section style="margin-bottom:48px;background:#f0f7f3;border-radius:10px;padding:28px;">
    <h2 style="color:#0A4A2E;font-size:1.4rem;margin:0 0 16px;">Alur Pengadaan Langsung (Nilai ≤ Rp 200 Juta)</h2>
    <p style="color:#555;font-size:0.9rem;margin:0 0 20px;line-height:1.7;">Wahana Totalita termasuk dalam kategori ini. Berikut alur standar yang wajib dipahami PPK dan Pejabat Pengadaan:</p>
    <div style="display:flex;flex-direction:column;gap:12px;">
      <?php
      $steps = [
        ['1','Persiapan','PPK menetapkan spesifikasi teknis, HPS (berdasarkan survei harga), dan rancangan kontrak/SPK.'],
        ['2','Pemilihan Penyedia','Pejabat Pengadaan mengundang 1 (satu) penyedia yang memenuhi kualifikasi, meminta penawaran harga.'],
        ['3','Klarifikasi & Negosiasi','Pejabat Pengadaan melakukan klarifikasi teknis dan negosiasi harga agar sesuai atau di bawah HPS.'],
        ['4','Penetapan Penyedia','PPK menerbitkan Surat Penunjukan Penyedia Barang/Jasa (SPPBJ) kepada penyedia yang ditetapkan.'],
        ['5','Penandatanganan SPK/Kontrak','PPK menandatangani Surat Perintah Kerja (SPK) atau kontrak — minimal memuat ruang lingkup, harga, dan waktu.'],
        ['6','Pelaksanaan & Pembayaran','Penyedia melaksanakan pekerjaan. Setelah selesai dan BAST ditandatangani, PPK mengajukan pembayaran.'],
      ];
      foreach ($steps as $s): ?>
      <div style="display:flex;align-items:flex-start;gap:14px;background:#fff;border-radius:8px;padding:14px 18px;">
        <div style="background:#0A4A2E;color:#fff;width:32px;height:32px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:0.9rem;flex-shrink:0;"><?php echo $s[0]; ?></div>
        <div>
          <div style="font-weight:700;color:#0A4A2E;margin-bottom:4px;font-size:0.93rem;"><?php echo $s[1]; ?></div>
          <p style="color:#555;font-size:0.86rem;line-height:1.6;margin:0;"><?php echo $s[2]; ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- RELATED LINKS -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.4rem;border-bottom:2px solid #e0e0e0;padding-bottom:8px;margin-bottom:16px;">Pelatihan &amp; Layanan Terkait</h2>
    <div style="display:flex;flex-wrap:wrap;gap:12px;">
      <?php
      $related = [
        ['/pelatihan-keuangan-daerah/','Pelatihan Keuangan Daerah & SPJ'],
        ['/pelatihan-manajemen-sdm/','Pelatihan Manajemen SDM & Leadership ASN'],
        ['/smk3/','Konsultasi SMK3 & Audit K3'],
        ['/catering/','Catering & Konsumsi Kegiatan Instansi'],
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
      ['Apa perbedaan PPK, PPTK, dan Pokja Pemilihan?','PPK = bertanggung jawab penuh atas pelaksanaan kontrak dan pembayaran. PPTK = membantu PPK secara teknis di SKPD. Pokja = melaksanakan proses tender/seleksi pemilihan penyedia. Tanggung jawab dan risiko hukum ketiganya berbeda.'],
      ['Apa saja metode pengadaan berdasarkan Perpres 16/2018?','E-Purchasing (wajib jika ada di e-catalog), Pengadaan Langsung (≤ Rp 200 jt), Penunjukan Langsung (kondisi tertentu), Tender Cepat, Tender, dan Seleksi. Wahana Totalita masuk kategori pengadaan langsung.'],
      ['Apa temuan BPK yang paling sering terjadi dalam pengadaan?','Pemecahan paket, HPS tidak wajar, spesifikasi mengarah ke merek, denda keterlambatan tidak dipungut, volume tidak sesuai progres, dan tidak menggunakan e-catalog untuk barang yang tersedia di LKPP.'],
      ['Apakah Wahana terdaftar di PADI dan LPSE?','Ya. PT Kreasi Ultimate Berjaya (Wahana Totalita) terdaftar di PADI UMKM dan LPSE DIY untuk kategori Pendidikan dan Pelatihan. Pengadaan langsung tanpa tender untuk nilai di bawah Rp 200 juta.'],
      ['Apa itu SiRUP dan mengapa wajib diisi sebelum pengadaan?','SiRUP = Sistem Informasi Rencana Umum Pengadaan — tempat instansi mengumumkan rencana pengadaan sebelum dilaksanakan (Perpres 16/2018). Pengadaan tanpa pengumuman di SiRUP adalah temuan administratif BPK.'],
      ['Berapa denda keterlambatan penyedia dan bagaimana menghitungnya?','1/1000 dari nilai kontrak per hari kalender keterlambatan (Perlem LKPP 12/2021). Contoh: kontrak Rp 100 juta, terlambat 10 hari → denda Rp 1.000.000. Tidak memungut denda = kerugian negara (temuan BPK).'],
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
  <section style="background:linear-gradient(135deg,#2a0a5a,#0A4A2E);color:#fff;border-radius:12px;padding:40px;text-align:center;">
    <h2 style="margin:0 0 12px;font-size:1.6rem;">Siap Meningkatkan Kompetensi Pengadaan Tim Anda?</h2>
    <p style="opacity:0.9;margin:0 0 10px;line-height:1.7;max-width:580px;margin-left:auto;margin-right:auto;">
      Hubungi kami untuk mendapatkan proposal pelatihan PBJP yang disesuaikan — in-house di instansi Anda, jadwal fleksibel, instruktur berpengalaman, dan dokumen SPJ lengkap siap pakai.
    </p>
    <p style="opacity:0.75;font-size:0.9rem;margin:0 0 24px;">Pengadaan langsung tanpa tender · LPSE &amp; PADI terdaftar · Nilai di bawah Rp 200 juta</p>
    <a href="https://wa.me/6287759151278?text=Halo%2C+saya+ingin+proposal+pelatihan+pengadaan+barang+jasa+pemerintah+%28PBJP%29+untuk+instansi+kami."
       target="_blank" rel="noopener"
       style="display:inline-block;background:#C6621C;color:#fff;padding:14px 36px;border-radius:6px;font-weight:700;text-decoration:none;font-size:1.05rem;">
      WhatsApp: 0877-5915-1278
    </a>
  </section>

</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>
</html>
