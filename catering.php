<?php
require_once __DIR__ . '/config.php';
$s = get_all_settings();
// Hub: Jasa Catering & Konsumsi Instansi Pemerintah
$canonical = 'https://wahanatotalita.com/catering/';
$meta_title = 'Jasa Catering Instansi Pemerintah & BUMN Yogyakarta — Wahana Totalita';
$meta_desc  = 'Jasa catering, snack box, dan konsumsi rapat untuk instansi pemerintah dan BUMN di Yogyakarta. Halal, lengkap dokumen SPJ, LPSE & PADI terdaftar. Pengadaan langsung < Rp 200 juta.';

$schema = [
  [
    '@context' => 'https://schema.org',
    '@type'    => 'BreadcrumbList',
    'itemListElement' => [
      ['@type'=>'ListItem','position'=>1,'name'=>'Beranda','item'=>'https://wahanatotalita.com/'],
      ['@type'=>'ListItem','position'=>2,'name'=>'Layanan','item'=>'https://wahanatotalita.com/layanan/'],
      ['@type'=>'ListItem','position'=>3,'name'=>'Catering Instansi','item'=>$canonical],
    ],
  ],
  [
    '@context' => 'https://schema.org',
    '@type'    => 'FAQPage',
    'mainEntity' => [
      [
        '@type' => 'Question',
        'name'  => 'Apakah catering dari Wahana Totalita tersertifikasi halal?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Ya. Seluruh menu catering Wahana Totalita menggunakan bahan-bahan halal dan disiapkan oleh mitra dapur yang memperhatikan standar kehalalan. Untuk kegiatan instansi pemerintah dan BUMN, kehalalan adalah standar wajib yang selalu kami penuhi. Untuk kegiatan khusus yang memerlukan sertifikat halal resmi dari MUI, kami dapat berkoordinasi dengan mitra dapur bersertifikat MUI.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apa saja dokumen administrasi yang tersedia untuk keperluan SPJ?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Dokumen administrasi yang kami siapkan untuk keperluan SPJ instansi: (1) Surat Penawaran Harga bermaterai; (2) RAB (Rincian Anggaran Biaya) per item; (3) Faktur Pajak (untuk pembelian di atas Rp 1 juta); (4) Kuitansi/bukti pembayaran resmi; (5) Berita Acara Serah Terima (BAST); (6) Foto pelaksanaan konsumsi/catering; (7) Daftar menu yang disajikan. Semua dokumen diterbitkan oleh PT Kreasi Ultimate Berjaya dengan legalitas lengkap.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Berapa minimum order dan jangkauan area layanan?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Minimum order: 20 box/porsi untuk snack box dan nasi box. Untuk prasmanan/buffet minimum 50 pax. Jangkauan layanan: seluruh wilayah Yogyakarta (Kota Yogyakarta, Sleman, Bantul, Kulon Progo, Gunung Kidul) dan sekitarnya termasuk Solo dan Magelang untuk pesanan besar. Pengiriman gratis dalam radius 15 km dari pusat kota Yogyakarta.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Bagaimana mekanisme pengadaan catering melalui LPSE untuk instansi pemerintah?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Wahana Totalita terdaftar di LPSE dan PADI UMKM untuk kategori Catering & Snack. Pengadaan catering untuk kegiatan dinas yang nilainya di bawah Rp 200 juta dapat dilakukan melalui pengadaan langsung (PL) — tidak perlu tender. PPK/Pejabat Pengadaan cukup menghubungi kami, kami siapkan surat penawaran, RAB, dan seluruh dokumen yang diperlukan. Proses cepat, administrasi beres, dan SPJ aman.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apakah bisa memesan catering paket lengkap termasuk peralatan makan?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Ya. Untuk paket prasmanan dan gala dinner, kami menyediakan peralatan makan lengkap (piring, gelas, sendok, garpu), meja display, tudung saji, dan petugas serving. Untuk nasi box dan snack box, disajikan dalam kemasan siap santap. Paket all-in juga tersedia termasuk dekorasi meja makan sederhana untuk acara formal instansi.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Berapa harga snack box dan nasi box untuk rapat dinas?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Harga disesuaikan dengan menu dan volume pesanan. Kisaran harga: snack box Rp 15.000–35.000 per box, nasi box Rp 35.000–75.000 per box, prasmanan mulai Rp 50.000 per pax (tergantung menu dan jumlah). Harga sudah termasuk kemasan dan pengiriman dalam Yogyakarta. Untuk penawaran resmi dengan RAB yang dapat digunakan untuk pengajuan anggaran, silakan hubungi kami via WhatsApp.'],
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
<section style="background:linear-gradient(135deg,#0A4A2E 0%,#C6621C 100%);color:#fff;padding:60px 20px 50px;">
  <div style="max-width:900px;margin:0 auto;">
    <nav aria-label="breadcrumb" style="font-size:0.85rem;opacity:0.8;margin-bottom:16px;">
      <a href="/" style="color:#f5e6a3;">Beranda</a> &rsaquo;
      <span>Catering Instansi</span>
    </nav>
    <h1 style="font-size:clamp(1.6rem,4vw,2.4rem);font-weight:700;margin:0 0 16px;">
      Jasa Catering &amp; Konsumsi untuk Instansi Pemerintah dan BUMN
    </h1>
    <p style="font-size:1.1rem;opacity:0.92;max-width:720px;margin:0 0 10px;line-height:1.7;">
      Konsumsi rapat, snack box seminar, prasmanan gathering, hingga gala dinner kedinasan — Wahana Totalita menyediakan layanan catering lengkap untuk semua jenis kegiatan instansi pemerintah dan BUMN di Yogyakarta. Halal, tepat waktu, dan dokumen SPJ beres.
    </p>
    <div style="display:flex;flex-wrap:wrap;gap:10px;margin:18px 0 28px;">
      <span style="background:rgba(255,255,255,0.18);padding:6px 14px;border-radius:20px;font-size:0.85rem;">✓ LPSE &amp; PADI Terdaftar</span>
      <span style="background:rgba(255,255,255,0.18);padding:6px 14px;border-radius:20px;font-size:0.85rem;">✓ Halal</span>
      <span style="background:rgba(255,255,255,0.18);padding:6px 14px;border-radius:20px;font-size:0.85rem;">✓ Faktur Pajak &amp; SPJ Lengkap</span>
      <span style="background:rgba(255,255,255,0.18);padding:6px 14px;border-radius:20px;font-size:0.85rem;">✓ Pengadaan Langsung &lt; Rp 200 juta</span>
      <span style="background:rgba(255,255,255,0.18);padding:6px 14px;border-radius:20px;font-size:0.85rem;">✓ Min. 20 box</span>
    </div>
    <a href="https://wa.me/628122969435?text=Halo%2C+saya+ingin+info+jasa+catering+untuk+kegiatan+instansi+kami+di+Yogyakarta.+Mohon+kirim+harga+dan+menu."
       target="_blank" rel="noopener"
       style="display:inline-block;background:#fff;color:#0A4A2E;padding:14px 32px;border-radius:6px;font-weight:700;text-decoration:none;font-size:1rem;">
      Minta Penawaran Harga
    </a>
  </div>
</section>

<main style="max-width:960px;margin:0 auto;padding:40px 20px 60px;">

  <!-- PAKET LAYANAN -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:24px;">
      Paket Layanan Catering
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:20px;">
      <?php
      $pakets = [
        ['☕','Snack Box & Minuman','Rapat, FGD, sosialisasi. Kombinasi kue basah + kue kering + minuman (air mineral, teh, kopi). Kemasan rapi, label instansi tersedia. Min. 20 box.','Rp 15.000 – 35.000/box','#e8f4eb'],
        ['🍱','Nasi Box / Lunch Box','Seminar, workshop, pelatihan. Nasi + lauk 2–3 item + sayur + kerupuk + buah + air mineral. Kemasan food-grade steril. Min. 20 box.','Rp 35.000 – 75.000/box','#fff8f0'],
        ['🍽️','Prasmanan / Buffet','Gathering, halal bihalal, rapat besar (≥50 orang). Menu lengkap: nasi, 3–4 lauk, sayur, buah, dessert, minuman. Termasuk peralatan makan dan petugas serving.','Mulai Rp 55.000/pax','#e8f0f7'],
        ['🥂','Gala Dinner Kedinasan','Acara seremonial formal, kunjungan tamu VVIP, malam penghargaan. Menu 4-5 course, dekorasi meja, MC makan malam, dan layanan premium.','Mulai Rp 125.000/pax','#f7f4e8'],
        ['🏕️','Konsumsi Outbound','Paket konsumsi untuk kegiatan outbound dan team building: bekal lapangan, makan siang di lokasi, snack sore, dan makan malam api unggun.','Paket disesuaikan','#e8f4eb'],
        ['🎪','Konsumsi Seminar/Expo','Coffee break pagi + siang, makan siang prasmanan, snack sore. Untuk acara 1–3 hari. Dapat dikombinasikan dengan layanan EO Wahana.','Paket disesuaikan','#fff8f0'],
      ];
      foreach ($pakets as $p): ?>
      <div style="background:<?php echo $p[4]; ?>;border-radius:10px;padding:20px;border-top:4px solid #0A4A2E;">
        <div style="font-size:1.8rem;margin-bottom:10px;"><?php echo $p[0]; ?></div>
        <div style="font-weight:700;color:#0A4A2E;margin-bottom:6px;font-size:0.95rem;"><?php echo $p[1]; ?></div>
        <p style="color:#555;font-size:0.86rem;line-height:1.6;margin:0 0 10px;"><?php echo $p[2]; ?></p>
        <div style="background:#0A4A2E;color:#fff;padding:6px 12px;border-radius:4px;font-size:0.85rem;font-weight:600;display:inline-block;"><?php echo $p[3]; ?></div>
      </div>
      <?php endforeach; ?>
    </div>
    <p style="color:#666;font-size:0.85rem;margin-top:16px;font-style:italic;">* Harga dapat berubah sesuai menu dan volume. Hubungi kami untuk penawaran resmi dan RAB yang dapat digunakan untuk pengajuan anggaran.</p>
  </section>

  <!-- MENU UNGGULAN -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Pilihan Menu
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px;">
      <?php
      $menus = [
        ['🍛','Menu Nusantara','Nasi putih/kuning/uduk + ayam goreng/bakar/opor + rendang/semur daging + tumis sayur + lalapan + sambal + kerupuk. Menu paling populer untuk kegiatan dinas.'],
        ['🥗','Menu Sehat & Vegetarian','Nasi merah/putih + tempe/tahu olahan + tumis sayuran beragam + soup + buah segar. Cocok untuk instansi yang memperhatikan gizi pegawai.'],
        ['🍜','Menu Kontemporer','Pilihan lebih modern: nasi dengan lauk fusion, pasta, salad, dan minuman sehat. Untuk gathering dan event yang ingin kesan berbeda.'],
        ['🎂','Snack Premium','Kue tradisional Yogyakarta (klepon, lemper, onde-onde, tart) + kue modern (finger food, pastry) + minuman premium (es cincau, wedang uwuh, jus segar).'],
      ];
      foreach ($menus as $m): ?>
      <div style="background:#fff;border:1px solid #e0e0e0;border-radius:8px;padding:18px;">
        <div style="font-size:1.8rem;margin-bottom:10px;"><?php echo $m[0]; ?></div>
        <div style="font-weight:600;color:#0A4A2E;margin-bottom:8px;"><?php echo $m[1]; ?></div>
        <p style="color:#555;font-size:0.86rem;line-height:1.6;margin:0;"><?php echo $m[2]; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- PROCUREMENT -->
  <section style="margin-bottom:48px;background:#f0f7f3;border-radius:10px;padding:28px;">
    <h2 style="color:#0A4A2E;font-size:1.4rem;margin:0 0 6px;">Pengadaan Catering untuk Instansi Pemerintah</h2>
    <p style="color:#555;font-size:0.9rem;margin:0 0 20px;line-height:1.7;">Wahana Totalita terdaftar di LPSE dan PADI UMKM sebagai vendor <strong>Catering & Snack</strong>. Pengadaan di bawah Rp 200 juta melalui mekanisme pengadaan langsung — tidak perlu tender.</p>
    <div style="overflow-x:auto;">
      <table style="width:100%;border-collapse:collapse;font-size:0.88rem;background:#fff;border-radius:8px;overflow:hidden;">
        <thead>
          <tr style="background:#0A4A2E;color:#fff;">
            <th style="padding:10px 14px;text-align:left;">Kebutuhan SPJ</th>
            <th style="padding:10px 14px;text-align:left;">Yang Kami Siapkan</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $docs = [
            ['Surat Penawaran','Resmi, bermaterai, kop PT Kreasi Ultimate Berjaya'],
            ['RAB Rinci','Per item menu dengan harga satuan — mudah diverifikasi PPK'],
            ['NPWP & Faktur Pajak','Faktur pajak diterbitkan untuk pembelian ≥ Rp 1 juta'],
            ['Kuitansi Resmi','Bukti pembayaran resmi bermaterai'],
            ['Berita Acara (BAST)','Serah terima konsumsi — ditandatangani penerima'],
            ['Foto Dokumentasi','Foto persiapan dan penyajian konsumsi'],
            ['Daftar Menu Tersaji','Rincian menu yang dihidangkan sesuai SPK'],
          ];
          foreach ($docs as $i => $d):
            $bg = $i%2===0?'#fff':'#f9f9f9';
          ?>
          <tr style="background:<?php echo $bg; ?>;">
            <td style="padding:9px 14px;border-bottom:1px solid #eee;font-weight:600;color:#0A4A2E;"><?php echo $d[0]; ?></td>
            <td style="padding:9px 14px;border-bottom:1px solid #eee;color:#444;"><?php echo $d[1]; ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </section>

  <!-- KEUNGGULAN -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Keunggulan Wahana Totalita untuk Catering Instansi
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:14px;">
      <?php
      $keunggulan = [
        ['🏛️','Paham Protokol Kedinasan','Berpengalaman menangani konsumsi untuk kegiatan formal instansi pemerintah — memahami tata kelola, protokol, dan standar administrasi yang diperlukan.'],
        ['📋','Satu Vendor, Banyak Layanan','Konsumsi + EO + outbound + wisata dalam satu vendor — sederhanakan proses pengadaan dan koordinasi kegiatan instansi Anda.'],
        ['⏱️','Tepat Waktu Dijamin','Konsumsi yang terlambat mengganggu jalannya acara dinas. Kami memiliki sistem jadwal ketat dengan buffer waktu untuk memastikan pengiriman tepat waktu.'],
        ['📄','Administrasi Beres','Seluruh dokumen yang dibutuhkan untuk SPJ sudah disiapkan sejak awal — tidak perlu bolak-balik minta kelengkapan administrasi.'],
        ['✅','Halal & Higienis','Seluruh menu halal, disiapkan di dapur higienis, dikemas dalam kemasan food-grade yang aman dan rapi untuk kegiatan formal.'],
        ['🎯','Fleksibel & Dapat Dikustom','Menu, kemasan, label, dan jadwal dapat disesuaikan dengan kebutuhan spesifik acara — termasuk menu untuk tamu VVIP atau kebutuhan diet khusus.'],
      ];
      foreach ($keunggulan as $k): ?>
      <div style="background:#fff;border:1px solid #e0e0e0;border-radius:8px;padding:16px;">
        <div style="font-size:1.4rem;margin-bottom:8px;"><?php echo $k[0]; ?></div>
        <div style="font-weight:600;color:#0A4A2E;margin-bottom:6px;font-size:0.9rem;"><?php echo $k[1]; ?></div>
        <p style="color:#555;font-size:0.85rem;line-height:1.6;margin:0;"><?php echo $k[2]; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- CROSS LINKS -->
  <section style="margin-bottom:48px;background:#fff8f0;border-radius:10px;padding:24px;">
    <h2 style="color:#0A4A2E;font-size:1.3rem;margin:0 0 16px;">Paket Lengkap Kegiatan Instansi</h2>
    <p style="color:#555;line-height:1.8;margin:0 0 18px;font-size:0.9rem;">Gabungkan layanan catering dengan layanan lain Wahana Totalita untuk kegiatan yang lebih efisien dan terkoordinasi.</p>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:12px;">
      <?php
      $cross = [
        ['/event-organizer/','Event Organizer Kedinasan','Seminar, rakor, upacara — EO + konsumsi dalam satu paket.'],
        ['/outbound/','Outbound & Team Building','Konsumsi makan siang lapangan + snack untuk outbound.'],
        ['/wisata-karyawan/','Wisata Karyawan','Paket all-in wisata + konsumsi selama perjalanan dinas.'],
      ];
      foreach ($cross as $c): ?>
      <a href="<?php echo $c[0]; ?>" style="display:block;background:#fff;border:1px solid #e0c090;border-radius:8px;padding:14px;text-decoration:none;" onmouseover="this.style.boxShadow='0 2px 8px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='none'">
        <div style="font-weight:600;color:#0A4A2E;margin-bottom:4px;font-size:0.9rem;"><?php echo $c[1]; ?></div>
        <div style="color:#666;font-size:0.83rem;"><?php echo $c[2]; ?></div>
      </a>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- FAQ -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:24px;">Pertanyaan yang Sering Diajukan</h2>
    <?php
    $faqs = [
      ['Apakah catering dari Wahana Totalita tersertifikasi halal?','Ya. Seluruh menu halal dan disiapkan oleh mitra dapur yang memperhatikan standar kehalalan. Untuk kegiatan instansi pemerintah, ini adalah standar wajib yang selalu kami penuhi.'],
      ['Apa saja dokumen administrasi yang tersedia untuk keperluan SPJ?','Kami siapkan: Surat Penawaran Harga, RAB rinci, Faktur Pajak, kuitansi resmi, BAST, foto dokumentasi, dan daftar menu tersaji. Semua dokumen diterbitkan oleh PT Kreasi Ultimate Berjaya.'],
      ['Berapa minimum order dan jangkauan area layanan?','Minimum 20 box untuk snack/nasi box, 50 pax untuk prasmanan. Jangkauan: seluruh Yogyakarta. Pengiriman gratis radius 15 km dari pusat kota.'],
      ['Bagaimana mekanisme pengadaan melalui LPSE?','Wahana terdaftar LPSE dan PADI UMKM kategori Catering & Snack. Nilai di bawah Rp 200 juta dapat diproses melalui pengadaan langsung — PPK hubungi kami, kami siapkan seluruh dokumen.'],
      ['Apakah bisa memesan paket lengkap termasuk peralatan makan?','Ya. Paket prasmanan dan gala dinner sudah termasuk peralatan makan, meja display, dan petugas serving. Dekorasi meja sederhana juga tersedia untuk acara formal.'],
      ['Berapa harga snack box dan nasi box untuk rapat dinas?','Snack box Rp 15.000–35.000/box, nasi box Rp 35.000–75.000/box. Untuk penawaran resmi dengan RAB yang bisa digunakan pengajuan anggaran, hubungi kami via WhatsApp.'],
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
  <section style="background:linear-gradient(135deg,#0A4A2E,#C6621C);color:#fff;border-radius:12px;padding:40px;text-align:center;">
    <h2 style="margin:0 0 12px;font-size:1.6rem;">Butuh Konsumsi untuk Kegiatan Instansi Anda?</h2>
    <p style="opacity:0.9;margin:0 0 10px;line-height:1.7;max-width:580px;margin-left:auto;margin-right:auto;">
      Hubungi kami sekarang untuk penawaran harga dan RAB resmi yang dapat langsung digunakan untuk pengajuan anggaran.
    </p>
    <p style="opacity:0.75;font-size:0.9rem;margin:0 0 24px;">Respon penawaran dalam 2 jam kerja · Dokumen SPJ lengkap</p>
    <a href="https://wa.me/628122969435?text=Halo%2C+saya+ingin+pesan+catering+untuk+kegiatan+instansi+kami.+Mohon+kirim+menu+dan+harga+beserta+info+pengadaan+LPSE."
       target="_blank" rel="noopener"
       style="display:inline-block;background:#fff;color:#0A4A2E;padding:14px 36px;border-radius:6px;font-weight:700;text-decoration:none;font-size:1.05rem;">
      WhatsApp: 0812-2969-435
    </a>
  </section>

</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>
</html>
