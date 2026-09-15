<?php
require_once __DIR__ . '/config.php';
$s = get_all_settings();
// Hub: Jasa Akomodasi & Hotel Arrangement Instansi Pemerintah
$canonical = 'https://wahanatotalita.com/akomodasi/';
$meta_title = 'Jasa Akomodasi & Hotel Arrangement Instansi Pemerintah Yogyakarta — Wahana Totalita';
$meta_desc  = 'Jasa pemesanan hotel, akomodasi, dan penginapan untuk kegiatan dinas instansi pemerintah dan BUMN di Yogyakarta. Harga terjangkau, lengkap dokumen SPJ, LPSE & PADI terdaftar.';

$schema = [
  [
    '@context' => 'https://schema.org',
    '@type'    => 'BreadcrumbList',
    'itemListElement' => [
      ['@type'=>'ListItem','position'=>1,'name'=>'Beranda','item'=>'https://wahanatotalita.com/'],
      ['@type'=>'ListItem','position'=>2,'name'=>'Layanan','item'=>'https://wahanatotalita.com/layanan/'],
      ['@type'=>'ListItem','position'=>3,'name'=>'Akomodasi Instansi','item'=>$canonical],
    ],
  ],
  [
    '@context' => 'https://schema.org',
    '@type'    => 'FAQPage',
    'mainEntity' => [
      [
        '@type' => 'Question',
        'name'  => 'Apakah pemesanan hotel melalui Wahana Totalita dilengkapi faktur pajak untuk SPJ?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Ya. Seluruh pemesanan akomodasi melalui Wahana Totalita dilengkapi dokumen administrasi lengkap untuk keperluan SPJ instansi: surat penawaran harga, RAB (Rincian Anggaran Biaya) per kamar/malam, faktur pajak (PPN), kuitansi resmi, dan Berita Acara Serah Terima (BAST). Dokumen diterbitkan oleh PT Kreasi Ultimate Berjaya yang memiliki NPWP aktif dan legalitas lengkap.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apa keunggulan memesan akomodasi melalui Wahana dibanding langsung ke hotel?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Keunggulan utama: (1) Satu vendor untuk seluruh kegiatan — akomodasi, konsumsi, transportasi, dan outbound dalam satu SPK, sehingga proses administrasi pengadaan lebih sederhana; (2) Dokumen SPJ lengkap dari satu sumber — tidak perlu mengumpulkan invoice dari beberapa pihak; (3) Wahana terdaftar LPSE dan PADI UMKM — pengadaan langsung tanpa tender untuk nilai di bawah Rp 200 juta; (4) Negosiasi harga grup — akses ke rate korporat yang lebih kompetitif dari harga retail; (5) Penanganan perubahan — jika ada peserta yang batal atau jumlah berubah, Wahana yang menangani koordinasi dengan hotel.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Kategori hotel apa saja yang tersedia untuk kegiatan dinas?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Wahana Totalita dapat membantu pemesanan berbagai kategori hotel sesuai ketentuan biaya perjalanan dinas dalam Standar Biaya Masukan (SBM) Kementerian Keuangan: Bintang 1-2 (untuk staf/fungsional): rata-rata Rp 500.000–700.000/malam; Bintang 3 (untuk eselon IV-III): rata-rata Rp 700.000–1.200.000/malam; Bintang 4 (untuk eselon II): rata-rata Rp 1.200.000–2.000.000/malam; Bintang 5 / Boutique (untuk eselon I dan Menteri/setara): sesuai SBM yang berlaku. Kami memiliki jaringan hotel di seluruh Yogyakarta dan dapat mencari pilihan terbaik sesuai anggaran dan ketentuan SBM instansi Anda.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apakah tersedia paket akomodasi plus konsumsi dan transportasi?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Ya, dan ini adalah pilihan yang paling sering diambil instansi. Wahana Totalita menyediakan paket all-in yang menggabungkan akomodasi + konsumsi + transportasi lokal dalam satu paket terintegrasi. Keuntungan: satu vendor, satu kontrak/SPK, satu faktur — proses administrasi jauh lebih sederhana. Paket ini khususnya populer untuk kegiatan pelatihan, rapat koordinasi luar kota, dan outbound instansi.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Berapa jauh sebelum acara pemesanan akomodasi harus dilakukan?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Rekomendasi: minimal 2 minggu sebelum acara untuk pemesanan biasa, dan 1 bulan lebih untuk acara besar (≥50 kamar) atau periode peak season (libur nasional, akhir tahun, masa wisuda). Yogyakarta adalah kota tujuan wisata dan MICE yang sangat populer — ketersediaan kamar hotel bisa sangat terbatas terutama di hotel bintang 3 ke atas selama musim ramai. Hubungi kami segera setelah anggaran dan jadwal kegiatan ditetapkan untuk mendapatkan pilihan hotel terbaik di kisaran harga yang sesuai.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apa saja fasilitas yang biasanya diperlukan untuk kegiatan pelatihan dan rapat dinas?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Fasilitas yang umum diperlukan untuk kegiatan dinas di hotel: Ruang meeting (kapasitas sesuai jumlah peserta, layout classroom/U-shape/theater), proyektor dan layar, sound system, flipchart, akses WiFi cepat, konsumsi coffee break dan makan siang (tersedia dalam paket), parkir untuk kendaraan peserta, dan resepsionis yang memahami tamu korporat. Untuk acara yang lebih formal: OHP/LCD wireless presenter, live streaming facility, breakout room, dan dekorasi panggung. Wahana mengkoordinasikan semua kebutuhan ini dengan manajemen hotel atas nama instansi Anda.'],
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
<section style="background:linear-gradient(135deg,#0A4A2E 0%,#2a4a6a 100%);color:#fff;padding:60px 20px 50px;">
  <div style="max-width:900px;margin:0 auto;">
    <nav aria-label="breadcrumb" style="font-size:0.85rem;opacity:0.8;margin-bottom:16px;">
      <a href="/" style="color:#a0d8f5;">Beranda</a> &rsaquo;
      <span>Akomodasi Instansi</span>
    </nav>
    <h1 style="font-size:clamp(1.6rem,4vw,2.4rem);font-weight:700;margin:0 0 16px;">
      Jasa Akomodasi &amp; Hotel Arrangement untuk Instansi Pemerintah &amp; BUMN
    </h1>
    <p style="font-size:1.05rem;opacity:0.92;max-width:720px;margin:0 0 10px;line-height:1.7;">
      Pemesanan hotel, penginapan, dan venue untuk kegiatan dinas di Yogyakarta — dengan dokumen administrasi lengkap untuk SPJ, harga sesuai SBM Kemenkeu, dan layanan koordinasi penuh dari satu vendor terpercaya yang sudah terdaftar di LPSE dan PADI UMKM.
    </p>
    <div style="display:flex;flex-wrap:wrap;gap:10px;margin:18px 0 28px;">
      <span style="background:rgba(255,255,255,0.16);padding:6px 14px;border-radius:20px;font-size:0.85rem;">✓ LPSE &amp; PADI Terdaftar</span>
      <span style="background:rgba(255,255,255,0.16);padding:6px 14px;border-radius:20px;font-size:0.85rem;">✓ Faktur Pajak &amp; SPJ Lengkap</span>
      <span style="background:rgba(255,255,255,0.16);padding:6px 14px;border-radius:20px;font-size:0.85rem;">✓ Sesuai SBM Kemenkeu</span>
      <span style="background:rgba(255,255,255,0.16);padding:6px 14px;border-radius:20px;font-size:0.85rem;">✓ Bintang 1–5 tersedia</span>
      <span style="background:rgba(255,255,255,0.16);padding:6px 14px;border-radius:20px;font-size:0.85rem;">✓ Paket all-in tersedia</span>
    </div>
    <a href="https://wa.me/628122969435?text=Halo%2C+saya+ingin+info+jasa+akomodasi+dan+hotel+arrangement+untuk+kegiatan+dinas+instansi+kami+di+Yogyakarta."
       target="_blank" rel="noopener"
       style="display:inline-block;background:#C6621C;color:#fff;padding:14px 32px;border-radius:6px;font-weight:700;text-decoration:none;font-size:1rem;">
      Minta Penawaran Hotel
    </a>
  </div>
</section>

<main style="max-width:960px;margin:0 auto;padding:40px 20px 60px;">

  <!-- LAYANAN -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:24px;">
      Layanan Akomodasi yang Kami Sediakan
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:20px;">
      <?php
      $services = [
        ['🏨','Hotel Arrangement Rapat Dinas','Pemesanan kamar dan ruang meeting untuk rapat koordinasi, rapat teknis, dan FGD. Kami koordinasikan layout ruangan, peralatan presentasi, dan konsumsi rapat sesuai kebutuhan instansi.','#e8f4eb'],
        ['🎓','Venue Pelatihan & Workshop','Hotel dengan fasilitas training room untuk pelatihan multi-hari. Layout classroom, U-shape, atau theater. Paket termasuk akomodasi peserta dan konsumsi selama pelatihan.','#e8f0f7'],
        ['🌿','Penginapan Outbound & Retreat','Resor dan penginapan dengan area outdoor untuk outbound dan team building instansi. Kombinasi akomodasi + makan + fasilitas outbound dalam satu paket.','#f0f7e8'],
        ['✈️','Perjalanan Dinas & Study Tour','Akomodasi untuk perjalanan dinas ke Yogyakarta dari instansi luar kota — termasuk hotel untuk delegasi kunjungan kerja, study banding, dan studi lapangan.','#fff8f0'],
        ['🎪','MICE & Gathering Karyawan','Hotel dengan ballroom dan convention hall untuk gathering tahunan, halal bihalal, dan acara besar instansi. Wahana menghandle teknis EO sekaligus akomodasi.','#f7f4e8'],
        ['🏕️','Wisata Karyawan Menginap','Paket wisata karyawan dengan akomodasi: hotel di Yogyakarta + destinasi (Bromo, Bali, Lombok, Labuan Bajo) — termasuk transport dan sightseeing program.','#e8f0f7'],
      ];
      foreach ($services as $s): ?>
      <div style="background:<?php echo $s[3]; ?>;border-radius:10px;padding:20px;border-top:4px solid #0A4A2E;">
        <div style="font-size:1.8rem;margin-bottom:10px;"><?php echo $s[0]; ?></div>
        <div style="font-weight:700;color:#0A4A2E;margin-bottom:8px;font-size:0.95rem;"><?php echo $s[1]; ?></div>
        <p style="color:#555;font-size:0.87rem;line-height:1.6;margin:0;"><?php echo $s[2]; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- KATEGORI HOTEL & SBM -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Kategori Hotel &amp; Kesesuaian SBM Kemenkeu
    </h2>
    <p style="line-height:1.8;color:#333;margin-bottom:16px;">
      Pemilihan kategori hotel untuk kegiatan dinas harus sesuai dengan <strong>Standar Biaya Masukan (SBM)</strong> yang ditetapkan Kementerian Keuangan setiap tahun berdasarkan golongan atau eselon pegawai. Kami membantu memastikan pilihan hotel sesuai ketentuan ini agar SPJ dapat dipertanggungjawabkan.
    </p>
    <div style="overflow-x:auto;">
      <table style="width:100%;border-collapse:collapse;font-size:0.9rem;">
        <thead>
          <tr style="background:#0A4A2E;color:#fff;">
            <th style="padding:10px 14px;text-align:left;">Kategori</th>
            <th style="padding:10px 14px;text-align:left;">Untuk</th>
            <th style="padding:10px 14px;text-align:left;">Kisaran Tarif di Yogyakarta</th>
            <th style="padding:10px 14px;text-align:left;">Contoh Hotel</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $hotels = [
            ['Bintang 2','Staf/fungsional, golongan I–II','Rp 450.000 – 700.000/malam','Fave Hotel, Amaris, All Nite & Day'],
            ['Bintang 3','Pejabat eselon IV–III, golongan III','Rp 700.000 – 1.200.000/malam','Grand Zuri, Ros In, Horison'],
            ['Bintang 4','Pejabat eselon II, golongan IV','Rp 1.200.000 – 2.200.000/malam','Sheraton, Tentrem, Hyatt Place'],
            ['Bintang 5','Pejabat eselon I / setara','Rp 2.200.000+/malam','The Westin, Ramayana Resort, Alila'],
            ['Resor/Retreat','Outbound & team building','Paket all-in, negosiasi','Plataran Borobudur, Lokal Yogya'],
          ];
          foreach ($hotels as $i => $h):
            $bg = $i%2===0?'#fff':'#f5f5f5';
          ?>
          <tr style="background:<?php echo $bg; ?>;">
            <td style="padding:9px 14px;border-bottom:1px solid #eee;font-weight:600;color:#0A4A2E;"><?php echo $h[0]; ?></td>
            <td style="padding:9px 14px;border-bottom:1px solid #eee;color:#444;font-size:0.87rem;"><?php echo $h[1]; ?></td>
            <td style="padding:9px 14px;border-bottom:1px solid #eee;color:#444;"><?php echo $h[2]; ?></td>
            <td style="padding:9px 14px;border-bottom:1px solid #eee;color:#666;font-size:0.85rem;"><?php echo $h[3]; ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <p style="color:#888;font-size:0.82rem;margin-top:10px;font-style:italic;">* Kisaran tarif perkiraan, dapat berubah sesuai musim dan ketersediaan. Tarif SBM resmi mengacu pada Peraturan Menteri Keuangan yang berlaku di tahun berjalan.</p>
  </section>

  <!-- PROCUREMENT SECTION -->
  <section style="margin-bottom:48px;background:#f0f7f3;border-radius:10px;padding:28px;">
    <h2 style="color:#0A4A2E;font-size:1.4rem;margin:0 0 14px;">Mekanisme Pengadaan Akomodasi untuk Instansi</h2>
    <p style="color:#333;line-height:1.8;margin:0 0 18px;font-size:0.92rem;">Wahana Totalita terdaftar di LPSE dan PADI UMKM untuk kategori <strong>Jasa Travel &amp; Akomodasi</strong>. Seluruh nilai pengadaan di bawah Rp 200 juta dapat diproses melalui pengadaan langsung.</p>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:14px;">
      <?php
      $docs = [
        ['📄','Surat Penawaran Harga','Resmi bermaterai dari PT Kreasi Ultimate Berjaya, mencantumkan rincian per kamar/malam dan per paket.'],
        ['📊','RAB Rinci','Rincian anggaran per komponen: tarif kamar, pajak hotel, meeting room, dan layanan tambahan.'],
        ['🧾','Faktur Pajak','Faktur pajak (PPN) diterbitkan untuk nilai ≥ Rp 1 juta. NPWP aktif dan PKP.'],
        ['📋','Berita Acara (BAST)','Berita Acara Serah Terima layanan — ditandatangani oleh penerima layanan dari instansi.'],
        ['📸','Dokumentasi','Foto check-in peserta, ruang meeting, dan fasilitas hotel sebagai bukti pelaksanaan.'],
        ['📑','Kuitansi Resmi','Bukti pembayaran resmi bermaterai sesuai nilai transaksi.'],
      ];
      foreach ($docs as $d): ?>
      <div style="background:#fff;border-radius:6px;padding:14px;">
        <div style="font-size:1.3rem;margin-bottom:6px;"><?php echo $d[0]; ?></div>
        <div style="font-weight:600;color:#0A4A2E;margin-bottom:4px;font-size:0.88rem;"><?php echo $d[1]; ?></div>
        <p style="color:#555;font-size:0.83rem;line-height:1.5;margin:0;"><?php echo $d[2]; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- PAKET TERPADU -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Paket Terpadu — Satu Vendor, Semua Kebutuhan
    </h2>
    <p style="line-height:1.8;color:#333;margin-bottom:20px;">
      Wahana Totalita adalah <strong>one-stop solution</strong> untuk seluruh kebutuhan kegiatan instansi pemerintah dan BUMN. Gabungkan akomodasi dengan layanan lain dalam satu kontrak untuk menyederhanakan proses administrasi.
    </p>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(210px,1fr));gap:16px;">
      <?php
      $packages = [
        ['/pelatihan-manajemen-sdm/','🎓 Pelatihan + Akomodasi','Hotel + ruang training + konsumsi + sertifikat. Paket paling populer untuk diklat multi-hari.'],
        ['/outbound/','🏕️ Outbound + Penginapan','Resor outbound all-in: aktivitas + makan + menginap dalam satu paket terkoordinasi.'],
        ['/wisata-karyawan/','✈️ Wisata + Hotel','Paket perjalanan karyawan: destinasi + akomodasi + transportasi + guide.'],
        ['/event-organizer/','🎪 Gathering + Venue','Event organizer kedinasan: ballroom, dekorasi, MC, konsumsi, dan penginapan delegasi.'],
      ];
      foreach ($packages as $p): ?>
      <a href="<?php echo $p[0]; ?>" style="display:block;background:#fff;border:1px solid #ddd;border-radius:8px;padding:16px;text-decoration:none;" onmouseover="this.style.boxShadow='0 2px 8px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='none'">
        <div style="font-size:1.4rem;margin-bottom:8px;"><?php echo substr($p[1],0,2); ?></div>
        <div style="font-weight:600;color:#0A4A2E;margin-bottom:6px;font-size:0.93rem;"><?php echo substr($p[1],2); ?></div>
        <div style="color:#555;font-size:0.84rem;line-height:1.5;"><?php echo $p[2]; ?></div>
      </a>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- FAQ -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:24px;">Pertanyaan yang Sering Diajukan</h2>
    <?php
    $faqs = [
      ['Apakah pemesanan hotel melalui Wahana dilengkapi faktur pajak untuk SPJ?','Ya. Semua pemesanan dilengkapi: surat penawaran, RAB rinci, faktur pajak PPN, kuitansi resmi, BAST, dan dokumentasi foto. Diterbitkan oleh PT Kreasi Ultimate Berjaya (NPWP aktif, PKP).'],
      ['Apa keunggulan memesan akomodasi melalui Wahana dibanding langsung ke hotel?','(1) Satu vendor untuk semua kebutuhan — akomodasi + konsumsi + training + outbound dalam satu SPK; (2) Dokumen SPJ dari satu sumber; (3) LPSE & PADI terdaftar — pengadaan langsung tanpa tender; (4) Rate korporat lebih kompetitif; (5) Wahana yang koordinasikan perubahan peserta/jadwal dengan hotel.'],
      ['Kategori hotel apa yang sesuai untuk kegiatan dinas?','Sesuai SBM Kemenkeu: bintang 2 untuk staf/golongan I-II, bintang 3 untuk eselon IV-III, bintang 4 untuk eselon II, bintang 5 untuk eselon I ke atas. Kami membantu memilih hotel yang sesuai ketentuan SBM agar SPJ aman.'],
      ['Apakah tersedia paket akomodasi plus konsumsi dan transportasi?','Ya. Paket all-in (akomodasi + konsumsi + transportasi lokal) adalah pilihan paling populer. Satu vendor, satu SPK, satu faktur — proses administrasi jauh lebih sederhana.'],
      ['Berapa jauh sebelum acara pemesanan harus dilakukan?','Minimal 2 minggu untuk acara biasa, 1 bulan untuk ≥50 kamar atau peak season. Yogyakarta sangat ramai — hotel bintang 3 ke atas bisa penuh berbulan-bulan sebelumnya di musim ramai.'],
      ['Apa saja fasilitas hotel yang biasanya diperlukan untuk pelatihan dinas?','Training room (layout classroom/U-shape), proyektor, sound system, WiFi, coffee break, makan siang. Untuk acara formal: OHP wireless, breakout room, live streaming, dekorasi panggung. Wahana mengkoordinasikan semua ini dengan hotel.'],
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
  <section style="background:linear-gradient(135deg,#0A4A2E,#2a4a6a);color:#fff;border-radius:12px;padding:40px;text-align:center;">
    <h2 style="margin:0 0 12px;font-size:1.6rem;">Butuh Akomodasi untuk Kegiatan Dinas di Yogyakarta?</h2>
    <p style="opacity:0.9;margin:0 0 10px;line-height:1.7;max-width:580px;margin-left:auto;margin-right:auto;">
      Hubungi kami sekarang — kami kirimkan pilihan hotel sesuai anggaran dan ketentuan SBM, lengkap dengan penawaran harga resmi yang siap digunakan untuk pengajuan anggaran.
    </p>
    <p style="opacity:0.75;font-size:0.9rem;margin:0 0 24px;">Respon penawaran dalam 2 jam kerja · Dokumen SPJ lengkap dari satu vendor</p>
    <a href="https://wa.me/628122969435?text=Halo%2C+saya+ingin+info+akomodasi+hotel+untuk+kegiatan+dinas+instansi+kami+di+Yogyakarta.+Mohon+kirim+pilihan+dan+harga."
       target="_blank" rel="noopener"
       style="display:inline-block;background:#C6621C;color:#fff;padding:14px 36px;border-radius:6px;font-weight:700;text-decoration:none;font-size:1.05rem;">
      WhatsApp: 0812-2969-435
    </a>
  </section>

</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>
</html>
