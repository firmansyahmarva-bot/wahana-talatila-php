<?php
require_once __DIR__ . '/config.php';
$s = get_all_settings();
// Hub: K3 & Pelatihan untuk Satuan Pengamanan
$canonical = 'https://wahanatotalita.com/pelatihan-satpam/';
$meta_title = 'Pelatihan K3 & Keamanan untuk Satuan Pengamanan (Satpam) — Wahana Totalita Yogyakarta';
$meta_desc  = 'Pelatihan K3 untuk petugas satuan pengamanan: bahaya kerja satpam, P3K, pemadam kebakaran, evakuasi darurat, dan keselamatan petugas keamanan. Bersertifikat Kemnaker RI, Yogyakarta.';

$schema = [
  [
    '@context' => 'https://schema.org',
    '@type'    => 'BreadcrumbList',
    'itemListElement' => [
      ['@type'=>'ListItem','position'=>1,'name'=>'Beranda','item'=>'https://wahanatotalita.com/'],
      ['@type'=>'ListItem','position'=>2,'name'=>'Pelatihan','item'=>'https://wahanatotalita.com/pelatihan/'],
      ['@type'=>'ListItem','position'=>3,'name'=>'Pelatihan K3 Satpam','item'=>$canonical],
    ],
  ],
  [
    '@context' => 'https://schema.org',
    '@type'    => 'FAQPage',
    'mainEntity' => [
      [
        '@type' => 'Question',
        'name'  => 'Apa saja bahaya K3 yang dihadapi petugas satpam setiap hari?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Petugas satpam menghadapi bahaya K3 yang unik dan sering diabaikan: (1) Bahaya ergonomi dari berdiri/patroli berjam-jam — menyebabkan nyeri punggung dan varises; (2) Bahaya shift malam — gangguan ritme sirkadian, kelelahan kronis, peningkatan risiko kecelakaan; (3) Bahaya psikososial — stres dari konflik dengan pengunjung/masyarakat, potensi kekerasan fisik dan verbal; (4) Bahaya lingkungan — paparan cuaca ekstrem saat patroli luar, kebisingan, pencahayaan buruk saat malam; (5) Bahaya lone worker (bekerja sendirian) — terlambat mendapat pertolongan saat kecelakaan terjadi.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apakah satpam wajib mendapat pelatihan K3?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Ya. UU No. 1 Tahun 1970 tentang Keselamatan Kerja berlaku untuk semua pekerja termasuk petugas satpam. Pemberi kerja wajib memberikan perlindungan K3 kepada satpam yang bekerja di fasilitas mereka. Selain itu, dalam konteks K3 bangunan dan fasilitas, satpam sering menjadi petugas pertama yang merespons kedaruratan — sehingga pelatihan P3K, pemadam kebakaran dasar, dan prosedur evakuasi adalah kompetensi yang wajib mereka miliki.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apa perbedaan pelatihan K3 satpam dengan pelatihan Gada Pratama?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Gada Pratama adalah pelatihan profesi satpam yang diatur Polri (Perkap 24/2007), wajib dilakukan melalui BUJP (Badan Usaha Jasa Pengamanan) berlisensi, dan mencakup hukum keamanan, teknik pengamanan fisik, dan bela diri dasar. Pelatihan K3 satpam dari Wahana Totalita berbeda: fokus pada keselamatan dan kesehatan petugas itu sendiri — P3K, pemadam kebakaran, ergonomi patroli, manajemen stres shift malam, dan prosedur darurat. Keduanya saling melengkapi dan sama-sama dibutuhkan oleh satpam yang profesional.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apa saja sertifikasi K3 yang relevan untuk satpam dan petugas keamanan?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Sertifikasi K3 yang relevan untuk petugas satpam: (1) Sertifikat Petugas P3K Tempat Kerja (Permenaker 15/2008) — wajib ada di setiap tempat kerja, satpam sering ditunjuk sebagai petugas P3K; (2) Sertifikat Petugas Penanggulangan Kebakaran Kelas D/C (Permenaker 4/1980) — satpam di gedung bertingkat dan fasilitas industri wajib memiliki; (3) Pelatihan Evakuasi Darurat — respons pertama saat gempa, kebakaran, dan insiden lain. Wahana Totalita menyediakan ketiga sertifikasi ini yang diakui Kemnaker RI.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Berapa peserta minimum untuk pelatihan in-house satpam?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Minimum 10 peserta untuk program in-house khusus satpam. Program dapat disesuaikan dengan jadwal shift — kami menyediakan opsi pelatihan yang dibagi menjadi 2 sesi untuk satpam yang tidak bisa meninggalkan pos sekaligus. Lokasi pelatihan bisa di area fasilitas Anda sendiri, termasuk praktik lapangan menggunakan APAR dan jalur evakuasi yang sesungguhnya — jauh lebih efektif dari latihan teori saja.'],
      ],
      [
        '@type' => 'Question',
        'name'  => 'Apakah instansi pemerintah bisa menganggarkan pelatihan K3 untuk satpam?',
        'acceptedAnswer' => ['@type'=>'Answer','text'=>'Ya. Pelatihan K3 untuk satpam/petugas keamanan instansi dapat dianggarkan melalui pos pengembangan kompetensi pegawai atau pos keselamatan dan kesehatan kerja dalam DIPA. Wahana Totalita terdaftar di LPSE dan PADI UMKM, sehingga pengadaan dapat dilakukan melalui mekanisme pengadaan langsung (nilai di bawah Rp 200 juta). Semua dokumen SPJ tersedia: surat penawaran, RAB, sertifikat peserta, BAST, dan laporan pelaksanaan.'],
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
<section style="background:linear-gradient(135deg,#1a1a2e 0%,#0A4A2E 100%);color:#fff;padding:60px 20px 50px;">
  <div style="max-width:900px;margin:0 auto;">
    <nav aria-label="breadcrumb" style="font-size:0.85rem;opacity:0.8;margin-bottom:16px;">
      <a href="/" style="color:#f5c06a;">Beranda</a> &rsaquo;
      <a href="/pelatihan/" style="color:#f5c06a;">Pelatihan</a> &rsaquo;
      <span>K3 Satuan Pengamanan</span>
    </nav>
    <h1 style="font-size:clamp(1.6rem,4vw,2.4rem);font-weight:700;margin:0 0 16px;">
      Pelatihan K3 &amp; Keselamatan untuk Satuan Pengamanan (Satpam)
    </h1>
    <p style="font-size:1.1rem;opacity:0.92;max-width:720px;margin:0 0 10px;line-height:1.7;">
      Satpam adalah garda terdepan keamanan fasilitas — tapi siapa yang menjaga keselamatan satpam itu sendiri? Shift malam, patroli sendirian, potensi konflik fisik, dan respons darurat adalah risiko nyata yang membutuhkan kompetensi K3 khusus. Program ini membekali satpam dengan kemampuan P3K, pemadaman kebakaran, evakuasi darurat, dan manajemen keselamatan diri.
    </p>
    <div style="display:flex;flex-wrap:wrap;gap:10px;margin:18px 0 28px;">
      <span style="background:rgba(255,255,255,0.15);padding:6px 14px;border-radius:20px;font-size:0.85rem;">✓ Sertifikat Kemnaker RI</span>
      <span style="background:rgba(255,255,255,0.15);padding:6px 14px;border-radius:20px;font-size:0.85rem;">✓ Praktik Lapangan APAR</span>
      <span style="background:rgba(255,255,255,0.15);padding:6px 14px;border-radius:20px;font-size:0.85rem;">✓ Bisa In-house di Fasilitas Anda</span>
      <span style="background:rgba(255,255,255,0.15);padding:6px 14px;border-radius:20px;font-size:0.85rem;">✓ Min. 10 peserta</span>
    </div>
    <a href="https://wa.me/628122969435?text=Halo%2C+saya+ingin+info+pelatihan+K3+untuk+satuan+pengamanan+(satpam)+kami."
       target="_blank" rel="noopener"
       style="display:inline-block;background:#C6621C;color:#fff;padding:14px 32px;border-radius:6px;font-weight:700;text-decoration:none;font-size:1rem;">
      Konsultasi Program
    </a>
  </div>
</section>

<main style="max-width:960px;margin:0 auto;padding:40px 20px 60px;">

  <!-- BAHAYA K3 SATPAM -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:20px;">
      Bahaya K3 yang Spesifik untuk Petugas Keamanan
    </h2>
    <p style="line-height:1.8;color:#333;margin-bottom:20px;">
      Profesi satpam memiliki profil risiko K3 yang unik — berbeda dari pekerja kantor maupun pekerja industri. Kombinasi shift malam, lone working, interaksi dengan publik yang tidak terduga, dan respons terhadap kedaruratan menciptakan paparan risiko yang harus dikelola secara profesional.
    </p>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:16px;">
      <?php
      $hazards = [
        ['🌙','Bahaya Shift Malam','Gangguan ritme sirkadian (circadian disruption), kurang tidur kronis, penurunan kewaspadaan menjelang dini hari, dan peningkatan risiko kecelakaan saat shift 00.00–04.00. Risiko jangka panjang: gangguan metabolik, kardiovaskular, dan kesehatan mental.','#1a1a2e'],
        ['🚶','Bahaya Ergonomi Patroli','Berdiri statis berjam-jam di pos jaga menyebabkan varises dan nyeri punggung bawah. Patroli jarak jauh tanpa perencanaan ergonomis menambah risiko cedera muskuloskeletal. Alas kaki yang tidak tepat memperburuk masalah lutut dan telapak kaki.','#0A4A2E'],
        ['⚡','Bahaya Lone Worker','Petugas yang berjaga sendirian menghadapi risiko tanpa ada yang segera membantu jika terjadi kecelakaan, pingsan, atau serangan. Sistem check-in berkala dan dead man\'s switch adalah kontrol K3 wajib untuk lone worker.','#4a1a0a'],
        ['😤','Bahaya Psikososial','Konflik dengan pengunjung/masyarakat, ancaman verbal, potensi kekerasan fisik, dan tekanan dari situasi darurat yang tidak terlatih adalah sumber stres psikologis berat yang sering berujung burnout dan trauma.','#1a1a4a'],
        ['🔥','Bahaya Responden Darurat','Satpam sering menjadi responden pertama saat kebakaran, kecelakaan, atau insiden keamanan — tanpa pelatihan memadai, mereka menjadi korban kedua. Kompetensi pemadam kebakaran dan P3K adalah kewajiban, bukan pilihan.','#4a0a0a'],
        ['☀️','Bahaya Lingkungan Fisik','Paparan panas/hujan saat patroli outdoor, kebisingan di area parkir atau loading dock, pencahayaan buruk saat patroli malam, dan paparan bahan kimia atau asap di area industri.','#0a2a0a'],
      ];
      foreach ($hazards as $h): ?>
      <div style="background:<?php echo $h[3]; ?>;color:#fff;border-radius:8px;padding:18px;">
        <div style="font-size:1.5rem;margin-bottom:8px;"><?php echo $h[0]; ?></div>
        <div style="font-weight:700;margin-bottom:8px;font-size:0.95rem;"><?php echo $h[1]; ?></div>
        <p style="font-size:0.85rem;line-height:1.6;opacity:0.9;margin:0;"><?php echo $h[2]; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- PROGRAM -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:24px;">
      Program Pelatihan K3 untuk Satuan Pengamanan
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:20px;">
      <?php
      $programs = [
        ['P3K untuk Petugas Keamanan','/pelatihan/pelatihan-petugas-p3k-kemnaker-ri/','Pertolongan pertama untuk satpam: penanganan trauma, luka tusuk/sayat, patah tulang, serangan jantung, tersedak. Sertifikat Kemnaker RI. Satpam sering menjadi petugas P3K pertama di fasilitas.','Lihat Program P3K'],
        ['Penanggulangan Kebakaran','/penanggulangan-kebakaran/','Teori dan praktik APAR, prosedur evakuasi, koordinasi dengan damkar, pemadaman awal kebakaran kecil. Wajib untuk satpam gedung bertingkat, mall, dan fasilitas industri.','Lihat Program'],
        ['Evakuasi Darurat & Emergency Response',null,'Prosedur evakuasi massal, titik kumpul, komunikasi darurat, bantuan evakuasi orang berkebutuhan khusus, koordinasi dengan tim darurat. Praktik langsung di fasilitas Anda.','Tanya via WhatsApp'],
        ['K3 Satpam — Program Komprehensif',null,'Program 2 hari khusus satpam: identifikasi bahaya di tempat kerja, APD untuk satpam, pengelolaan stres shift malam, lone worker safety, pertolongan pertama, dan pemadam kebakaran dasar. Sertifikat dari Wahana Totalita.','Tanya via WhatsApp'],
        ['Manajemen Keselamatan Fasilitas',null,'Untuk Kepala Satpam dan Security Manager: risk assessment fasilitas, penyusunan prosedur keamanan (SOP), sistem pelaporan insiden, koordinasi K3 antara tim keamanan dan K3 perusahaan.','Tanya via WhatsApp'],
        ['Kesehatan Mental & Stres Kerja Satpam',null,'Pengelolaan stres dari shift malam dan konflik, teknik relaksasi, tanda-tanda burnout, dan dukungan psikologis sederhana untuk satpam. In-house, 4 jam (half-day).','Tanya via WhatsApp'],
      ];
      foreach ($programs as $p):
        if ($p[1]) {
          $btn_href = $p[1]; $btn_target = ''; $btn_label = $p[3]; $btn_bg = '#0A4A2E';
        } else {
          $btn_href = 'https://wa.me/628122969435?text=Halo%2C+saya+ingin+info+program+'.urlencode($p[0]).'+untuk+satuan+pengamanan+kami.';
          $btn_target = ' target="_blank" rel="noopener"';
          $btn_label = 'Tanya via WhatsApp';
          $btn_bg = '#C6621C';
        }
      ?>
      <div style="background:#fff;border:1px solid #ddd;border-radius:8px;overflow:hidden;display:flex;flex-direction:column;">
        <div style="background:#1a1a2e;color:#fff;padding:12px 16px;">
          <div style="font-weight:600;font-size:0.93rem;"><?php echo $p[0]; ?></div>
        </div>
        <div style="padding:14px 16px;flex:1;">
          <p style="color:#555;font-size:0.87rem;line-height:1.6;margin:0;"><?php echo $p[2]; ?></p>
        </div>
        <div style="padding:0 16px 16px;">
          <a href="<?php echo $btn_href; ?>"<?php echo $btn_target; ?>
             style="display:block;text-align:center;background:<?php echo $btn_bg; ?>;color:#fff;padding:10px;border-radius:5px;text-decoration:none;font-weight:600;font-size:0.88rem;">
            <?php echo $btn_label; ?>
          </a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- KEWAJIBAN HUKUM -->
  <section style="margin-bottom:48px;background:#f0f7f3;border-radius:10px;padding:28px;">
    <h2 style="color:#0A4A2E;font-size:1.4rem;margin:0 0 16px;">Kewajiban Hukum Pengusaha terhadap K3 Satpam</h2>
    <p style="line-height:1.8;color:#333;margin-bottom:20px;">UU No. 1/1970 mewajibkan setiap pengusaha melindungi <em>semua</em> pekerja — termasuk satpam outsourcing yang bekerja di fasilitas mereka. Ini artinya pemberi kerja tidak bisa melepas tanggung jawab K3 hanya karena satpam berstatus karyawan BUJP (vendor keamanan).</p>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:14px;">
      <?php
      $kewajiban = [
        ['UU 1/1970 Pasal 9','Pengusaha wajib menjelaskan bahaya dan cara pencegahannya kepada semua pekerja di fasilitasnya, termasuk pekerja outsourcing.'],
        ['Permenaker 15/2008','Wajib tersedia petugas P3K di setiap tempat kerja. Satpam sering menjadi petugas P3K yang ditunjuk — dan harus terlatih.'],
        ['Permenaker 4/1980','Wajib tersedia APAR dan petugas yang terlatih menggunakannya. Satpam sebagai responden pertama harus kompeten mengoperasikan APAR.'],
        ['PP 50/2012','Perusahaan ≥100 karyawan wajib SMK3 — program K3 harus mencakup semua pekerja termasuk satpam, cleaning service, dan outsourcing lain.'],
      ];
      foreach ($kewajiban as $k): ?>
      <div style="background:#fff;border-radius:6px;padding:14px;">
        <div style="font-weight:600;color:#0A4A2E;margin-bottom:6px;font-size:0.88rem;"><?php echo $k[0]; ?></div>
        <p style="color:#555;font-size:0.84rem;line-height:1.6;margin:0;"><?php echo $k[1]; ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- FAQ -->
  <section style="margin-bottom:48px;">
    <h2 style="color:#0A4A2E;font-size:1.6rem;border-bottom:3px solid #C6621C;padding-bottom:8px;margin-bottom:24px;">Pertanyaan yang Sering Diajukan</h2>
    <?php
    $faqs = [
      ['Apa saja bahaya K3 yang dihadapi petugas satpam setiap hari?','Satpam menghadapi: (1) Bahaya ergonomi dari berdiri/patroli berjam-jam; (2) Bahaya shift malam — kelelahan kronis dan gangguan ritme sirkadian; (3) Bahaya psikososial — stres dari konflik dan potensi kekerasan; (4) Bahaya lone worker — terlambat mendapat pertolongan; (5) Bahaya sebagai responden darurat tanpa pelatihan memadai; (6) Paparan lingkungan fisik (panas, hujan, kebisingan).'],
      ['Apakah satpam wajib mendapat pelatihan K3?','Ya. UU 1/1970 berlaku untuk semua pekerja termasuk satpam. Satpam juga sering menjadi petugas P3K dan responden kebakaran pertama, sehingga pelatihan P3K dan pemadam kebakaran bukan pilihan — ini kewajiban hukum pemberi kerja.'],
      ['Apa perbedaan pelatihan K3 satpam dengan pelatihan Gada Pratama?','Gada Pratama (Polri) = pelatihan profesi pengamanan (teknik bela diri, hukum, dll) melalui BUJP. Pelatihan K3 satpam dari Wahana = keselamatan satpam itu sendiri (P3K, APAR, evakuasi, manajemen risiko). Keduanya berbeda dan saling melengkapi.'],
      ['Apa saja sertifikasi K3 yang relevan untuk satpam?','(1) Sertifikat Petugas P3K Kemnaker RI (Permenaker 15/2008); (2) Sertifikat Petugas Pemadam Kebakaran Kelas D/C (Permenaker 4/1980); (3) Sertifikat Pelatihan Evakuasi Darurat. Wahana menyediakan ketiga program ini.'],
      ['Berapa peserta minimum untuk pelatihan in-house satpam?','Minimum 10 peserta. Program bisa dibagi 2 sesi untuk satpam yang berjaga dalam shift berbeda. Praktik APAR dan evakuasi dilakukan langsung di fasilitas Anda — jauh lebih efektif.'],
      ['Apakah instansi pemerintah bisa menganggarkan pelatihan K3 satpam?','Ya, melalui pos pengembangan kompetensi pegawai atau anggaran K3 dalam DIPA. Wahana terdaftar LPSE dan PADI UMKM — pengadaan langsung tersedia. Semua dokumen SPJ kami siapkan.'],
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
  <section style="background:linear-gradient(135deg,#1a1a2e,#0A4A2E);color:#fff;border-radius:12px;padding:40px;text-align:center;">
    <h2 style="margin:0 0 12px;font-size:1.6rem;">Lindungi Petugas Keamanan Anda</h2>
    <p style="opacity:0.9;margin:0 0 28px;line-height:1.7;max-width:600px;margin-left:auto;margin-right:auto;">
      Satpam yang terlatih K3 adalah aset — bukan beban. Hubungi kami untuk konsultasi program pelatihan K3 yang sesuai profil risiko fasilitas dan jumlah satpam Anda.
    </p>
    <a href="https://wa.me/628122969435?text=Halo%2C+saya+ingin+info+pelatihan+K3+untuk+satuan+pengamanan+(satpam)+kami.+Mohon+kirim+info+program+dan+biaya."
       target="_blank" rel="noopener"
       style="display:inline-block;background:#C6621C;color:#fff;padding:14px 36px;border-radius:6px;font-weight:700;text-decoration:none;font-size:1.05rem;">
      WhatsApp: 0812-2969-435
    </a>
  </section>

</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>
</html>
