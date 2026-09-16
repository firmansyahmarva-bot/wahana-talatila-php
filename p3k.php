<?php
require_once __DIR__ . '/config.php';
$s = get_all_settings();
/**
 * p3k.php
 * P3K di Tempat Kerja hub page. Zero DB dependency, modeled on
 * penanggulangan-kebakaran.php.
 *
 * Real training slugs verified via catalog2026/real_trainings.json —
 * all 3 exist, no content gap:
 * pelatihan-petugas-p3k-sertifikasi-kemnaker-ri (Kemnaker RI, Rp5.000.000)
 * pelatihan-petugas-p3k-sertifikasi-bnsp (BNSP, Rp3.200.000)
 * pelatihan-petugas-p3k-first-aid-online (BNSP, Rp3.000.000)
 *
 * CORRECTIONS FLAGGED TO USER (WebSearch-verified against Permenaker
 * No. 15 Tahun 2008):
 * 1. Rasio wajib Petugas P3K: the brief claimed "1 per 100 karyawan
 *    (bahaya rendah), 1 per 50 karyawan (bahaya tinggi)". The
 *    verified real ratio (Lampiran I) is the OPPOSITE direction and
 *    different numbers: bahaya RENDAH = 1 orang per 150 pekerja
 *    (untuk >150 pekerja), bahaya TINGGI = 1 orang per 100 pekerja
 *    (untuk >100 pekerja). Corrected in Dasar Hukum, the comparison
 *    table, and FAQ #1.
 * 2. Certificate validity (FAQ #4): refined using the same
 *    competency-vs-license distinction verified for the fire-training
 *    page — the P3K training certificate itself does not expire, but
 *    the operational license (per Kep. Dirjen 53/DJPPK/VIII/2009)
 *    is valid 3 years and must be renewed with an activity report.
 * 3. FAQ #6 (isi kotak P3K): expanded with additional verified real
 *    items (kain segitiga/mittela, peniti, senter, gelas cuci mata,
 *    aquades/saline, povidon iodine, alkohol 70%) and removed the
 *    brief's unverified "1 kotak per 25 karyawan" ratio claim, which
 *    could not be confirmed against the regulation text found.
 */
$wa_number = '6287759151278';
$wa_msg = rawurlencode('Halo, saya ingin mendaftar pelatihan P3K di Tempat Kerja (Tingkat I/II). Mohon info jadwal dan biaya?');
$wa_url = "https://wa.me/{$wa_number}?text={$wa_msg}";
$year = date('Y');

$compare = [
    ['aspek' => 'Lokasi kerja', 'tk1' => 'Tempat kerja bahaya rendah', 'tk2' => 'Tempat kerja bahaya tinggi'],
    ['aspek' => 'Contoh industri', 'tk1' => 'Perkantoran, ritel, jasa', 'tk2' => 'Konstruksi, manufaktur, pertambangan'],
    ['aspek' => 'Rasio wajib', 'tk1' => '1 per 150 karyawan', 'tk2' => '1 per 100 karyawan'],
    ['aspek' => 'Materi tambahan', 'tk1' => '—', 'tk2' => 'Trauma lanjutan, evakuasi medis'],
    ['aspek' => 'Durasi pelatihan', 'tk1' => '±40 jam', 'tk2' => '±40 jam'],
    ['aspek' => 'Sertifikasi', 'tk1' => 'Kemnaker RI', 'tk2' => 'Kemnaker RI'],
    ['aspek' => 'Lisensi berlaku', 'tk1' => '3 tahun', 'tk2' => '3 tahun'],
];

$wajibIkut = [
    'Karyawan yang ditunjuk sebagai Petugas P3K resmi perusahaan',
    'Security officer dan resepsionis di gedung perkantoran',
    'HSE Officer dan safety officer di semua sektor industri',
    'Perawat atau bidan perusahaan yang ingin memiliki sertifikat P3K Kemnaker RI',
    'Supervisor lapangan di konstruksi, pertambangan, dan manufaktur',
    'Anggota tim tanggap darurat perusahaan',
];

$syaratPeserta = [
    'Usia minimal 18 tahun',
    'Sehat jasmani dan rohani — mampu melakukan CPR (tidak ada gangguan fisik yang menghalangi)',
    'Minimal SMA/SMK sederajat diutamakan (tidak wajib untuk Tingkat I)',
    'Fotokopi KTP, pas foto 3×4 (4 lembar), surat keterangan sehat',
];

$tujuan = [
    'Memahami regulasi P3K di tempat kerja (Permenaker 15/2008)',
    'Melakukan penilaian korban dengan metode DR-ABC (Danger, Response, Airway, Breathing, Circulation)',
    'Melakukan CPR (Cardiopulmonary Resuscitation) dan penggunaan AED (Automated External Defibrillator)',
    'Menangani pendarahan, luka bakar, patah tulang, dan cedera kepala',
    'Menerapkan teknik evakuasi dan pemindahan korban yang aman',
    'Mengelola kotak P3K dan fasilitas P3K sesuai standar Kemnaker',
];

$modul = [
    ['t' => 'Modul 1 — Regulasi dan Konsep Dasar', 'items' => [
        'Permenaker No. 15/2008: kewajiban, rasio, fasilitas',
        'Prinsip dasar P3K: cepat, tepat, tidak memperburuk kondisi',
        'Penilaian awal korban: DR-ABC',
    ]],
    ['t' => 'Modul 2 — Henti Jantung dan Pernapasan', 'items' => [
        'Tanda-tanda henti jantung dan henti napas',
        'Teknik CPR dewasa, anak, dan bayi',
        'Penggunaan AED (Automated External Defibrillator)',
        'Teknik pembebasan jalan napas (Heimlich maneuver untuk tersedak)',
    ]],
    ['t' => 'Modul 3 — Penanganan Luka dan Pendarahan', 'items' => [
        'Klasifikasi luka: lecet, robek, tusuk, amputasi',
        'Teknik penghentian pendarahan: penekanan langsung, tourniquet',
        'Perawatan luka bakar: derajat I, II, III',
        'Penanganan keracunan: oral, inhalasi, kontak kulit',
    ]],
    ['t' => 'Modul 4 — Cedera Muskuloskeletal', 'items' => [
        'Tanda dan penanganan patah tulang terbuka dan tertutup',
        'Imobilisasi dengan bidai (splinting)',
        'Penanganan cedera kepala dan tulang belakang',
        'Dislokasi sendi — apa yang boleh dan tidak boleh dilakukan',
    ]],
    ['t' => 'Modul 5 — Kondisi Medis Darurat', 'items' => [
        'Serangan jantung: gejala dan tindakan awal',
        'Stroke: metode FAST (Face, Arms, Speech, Time)',
        'Hipoglikemia (gula darah rendah) pada diabetesi',
        'Syok: jenis, tanda, dan penanganan',
    ]],
    ['t' => 'Modul 6 — Evakuasi dan Fasilitas P3K', 'items' => [
        'Teknik pemindahan korban: drag rescue, carry, stretcher',
        'Isi kotak P3K standar Kemnaker dan cara penggunaannya',
        'Pencatatan dan pelaporan insiden P3K',
        'Praktik lapangan: simulasi skenario kecelakaan kerja',
    ]],
];

$metode = [
    'Pelatihan tatap muka di Yogyakarta — 60% praktik langsung dengan manikin CPR dan peralatan P3K',
    'In-house training di perusahaan (minimum 10 peserta) — instruktur datang ke lokasi Anda',
    'Sertifikat Petugas P3K Kemnaker RI diterbitkan setelah lulus ujian teori dan demonstrasi praktik',
];

$skemas = [
    ['name' => 'Pelatihan Petugas P3K', 'cert' => 'Sertifikasi KEMNAKER RI', 'slug' => 'pelatihan-petugas-p3k-sertifikasi-kemnaker-ri'],
    ['name' => 'Pelatihan Petugas P3K', 'cert' => 'Sertifikat BNSP', 'slug' => 'pelatihan-petugas-p3k-sertifikasi-bnsp'],
    ['name' => 'Pelatihan Petugas P3K / First Aid', 'cert' => 'Sertifikasi BNSP', 'slug' => 'pelatihan-petugas-p3k-first-aid-online'],
];

$terkait = [
    ['label' => 'Penanggulangan Kebakaran', 'url' => '/penanggulangan-kebakaran/'],
    ['label' => 'Panduan Lengkap K3', 'url' => '/keselamatan-kerja/'],
    ['label' => 'Pelatihan K3 Konstruksi', 'url' => '/k3-konstruksi/'],
    ['label' => 'Sertifikasi BNSP', 'url' => '/sertifikasi-bnsp/'],
];

$faqs = [
    ['q' => 'Apakah semua perusahaan wajib memiliki Petugas P3K bersertifikat?', 'a' => 'Ya. Permenaker No. 15/2008 mewajibkan semua tempat kerja memiliki Petugas P3K — tidak ada pengecualian berdasarkan ukuran perusahaan. Jumlah petugas yang dibutuhkan tergantung jumlah karyawan dan tingkat bahaya: minimal 1 Petugas P3K per 150 karyawan (bahaya rendah) atau 1 per 100 karyawan (bahaya tinggi).'],
    ['q' => 'Apa beda Petugas P3K bersertifikat Kemnaker dengan peserta pelatihan P3K biasa?', 'a' => 'Petugas P3K Kemnaker RI memiliki lisensi resmi dan sertifikat yang diakui secara hukum — memenuhi kewajiban Permenaker 15/2008. Pelatihan P3K biasa (tanpa sertifikasi Kemnaker) tidak memenuhi kewajiban hukum dan tidak dapat dijadikan bukti compliance saat inspeksi Disnaker.'],
    ['q' => 'Apakah CPR yang dipelajari di pelatihan ini sama dengan standar internasional?', 'a' => 'Ya. Materi CPR mengacu pada panduan American Heart Association (AHA) dan European Resuscitation Council (ERC) yang diadaptasi untuk konteks tempat kerja Indonesia. Teknik 30:2 (30 kompresi dada, 2 napas buatan) dan penggunaan AED diajarkan sesuai standar terkini.'],
    ['q' => 'Berapa lama sertifikat Petugas P3K berlaku?', 'a' => 'Sertifikat pelatihan P3K pada dasarnya tidak memiliki masa kadaluarsa, namun lisensi Petugas P3K yang menyertainya wajib diperpanjang setiap 3 tahun dengan melampirkan laporan kegiatan selama masa berlaku lisensi. Setelah lisensi habis, Petugas P3K wajib mengikuti proses perpanjangan sebelum dapat bertugas kembali secara resmi.'],
    ['q' => 'Apakah perusahaan wajib menyediakan AED?', 'a' => 'Permenaker 15/2008 tidak secara spesifik mewajibkan AED, namun sangat direkomendasikan — terutama untuk perusahaan dengan banyak karyawan atau di area terpencil yang jauh dari fasilitas medis. Pelatihan kami mencakup penggunaan AED sehingga Petugas P3K siap jika AED tersedia.'],
    ['q' => 'Apa saja isi kotak P3K yang wajib disediakan perusahaan?', 'a' => 'Berdasarkan Permenaker 15/2008, kotak P3K berisi antara lain: kasa steril, perban berbagai ukuran, plester cepat, kapas, kain segitiga (mittela), gunting, peniti, sarung tangan sekali pakai, masker, pinset, senter, gelas cuci mata, aquades/larutan saline, povidon iodine, alkohol 70%, serta buku panduan dan catatan P3K. Jumlah kotak disesuaikan dengan jumlah karyawan dan tingkat bahaya sesuai Lampiran Permenaker 15/2008.'],
];
?>
<?php
$page_title = 'Pelatihan P3K di Tempat Kerja — Petugas P3K Bersertifikat Kemnaker RI';
$meta_desc = 'Pelatihan P3K (Pertolongan Pertama pada Kecelakaan) di Tempat Kerja bersertifikat Kemnaker RI. Sesuai Permenaker No. 15 Tahun 2008. Yogyakarta & in-house. 0877-5915-1278.';
require __DIR__ . '/includes/head.php';
?>
<script type="application/ld+json">
{"@context":"https://schema.org","@type":"BreadcrumbList","itemListElement":[
  {"@type":"ListItem","position":1,"name":"Beranda","item":"https://wahanatotalita.com/"},
  {"@type":"ListItem","position":2,"name":"Pelatihan","item":"https://wahanatotalita.com/pelatihan/"},
  {"@type":"ListItem","position":3,"name":"P3K","item":"https://wahanatotalita.com/p3k/"}
]}
</script>
<script type="application/ld+json">
<?php
echo json_encode([
    '@context' => 'https://schema.org',
    '@type'    => 'FAQPage',
    'mainEntity' => array_map(fn($f) => [
        '@type' => 'Question', 'name' => $f['q'],
        'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']],
    ], $faqs),
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
?>
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "Wahana Totalita Konsultan",
  "url": "https://wahanatotalita.com",
  "telephone": "+6287759151278",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Jl. Wonosari KM 8.5",
    "addressLocality": "Sleman",
    "addressRegion": "DIY",
    "addressCountry": "ID"
  }
}
</script>
<link rel="stylesheet" href="/assets/css/page/sector.css">
<style>
.compare-table{width:100%;border-collapse:collapse;background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 2px 12px rgba(0,0,0,.05);min-width:560px}
.module-grid{display:flex;flex-direction:column;gap:14px}
.module-card{background:#fff;border:1.5px solid #e5e7eb;border-radius:12px;padding:18px 20px}
.module-card h3{font-size:14.5px;font-weight:700;color:#0A4A2E;margin-bottom:10px}
.scheme-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1rem}
@media(max-width:900px){.scheme-grid{grid-template-columns:1fr}}
</style>
<style id="wt-hero-height-fix-2026-07">
/* wt-hero-height-fix-2026-07: this page's own .hero is a small custom hero, not the
   homepage full-screen slideshow hero — cancel the global 100vh /
   flex-centering from style.css so it doesn't leak in here. */
.hero{min-height:auto!important;display:block!important}
</style>
<?php require __DIR__ . '/includes/navbar.php'; ?>
<section class="hero">
  <div class="container inner">
    <div class="hero-badge">🩹 P3K di Tempat Kerja</div>
    <h1>Pelatihan P3K di Tempat Kerja — Petugas P3K Bersertifikat Kemnaker RI</h1>
    <p class="hero-sub">Sertifikasi resmi Kemnaker RI sesuai Permenaker No. 15 Tahun 2008.</p>
    <div><a href="<?=$wa_url?>" class="btn-wa" target="_blank" rel="noopener">💬 Konsultasi Jadwal &amp; Biaya</a></div>
  </div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">Apa itu P3K di Tempat Kerja?</h2>
  <p class="intro-text">P3K (Pertolongan Pertama pada Kecelakaan) adalah tindakan penanganan awal yang diberikan kepada korban kecelakaan atau sakit mendadak di tempat kerja sebelum mendapat pertolongan medis profesional. Tindakan P3K yang cepat dan tepat dapat menentukan hidup atau mati — terutama pada kasus henti jantung (cardiac arrest), pendarahan hebat, tersedak, atau cedera tulang belakang. Permenaker No. 15 Tahun 2008 mewajibkan setiap tempat kerja memiliki Petugas P3K bersertifikat dan kotak P3K yang lengkap.</p>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">Dasar Hukum — Permenaker No. 15 Tahun 2008</h2>
  <ul class="law-list">
    <li>Setiap tempat kerja wajib menyediakan Petugas P3K yang terlatih dan bersertifikat</li>
    <li>Rasio wajib: 1 Petugas P3K per 150 karyawan (tempat kerja bahaya rendah) atau 1 per 100 karyawan (bahaya tinggi)</li>
    <li>Fasilitas wajib: kotak P3K berisi perlengkapan standar, ruang P3K (untuk fasilitas dengan jumlah karyawan besar), dan akses ke layanan medis darurat</li>
    <li>Petugas P3K wajib memiliki lisensi P3K dari Kemnaker RI — bukan sekadar pelatihan biasa</li>
    <li>Perusahaan yang tidak memenuhi kewajiban P3K dikenai sanksi administratif</li>
  </ul>
</div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">Dua Tingkat Sertifikasi P3K</h2>
  <div class="compare-table-wrap">
  <table class="compare-table">
    <thead><tr><th>Aspek</th><th>Petugas P3K Tingkat I</th><th>Petugas P3K Tingkat II</th></tr></thead>
    <tbody>
      <?php foreach ($compare as $row): ?>
      <tr><td><?= htmlspecialchars($row['aspek']) ?></td><td><?= htmlspecialchars($row['tk1']) ?></td><td><?= htmlspecialchars($row['tk2']) ?></td></tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  </div>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">Siapa yang Wajib Ikut Pelatihan P3K?</h2>
  <ul class="plain-list">
    <?php foreach ($wajibIkut as $w): ?>
    <li><?= htmlspecialchars($w) ?></li>
    <?php endforeach; ?>
  </ul>
</div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">Persyaratan Peserta</h2>
  <ul class="plain-list">
    <?php foreach ($syaratPeserta as $s): ?>
    <li><?= htmlspecialchars($s) ?></li>
    <?php endforeach; ?>
  </ul>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">Tujuan Pembelajaran</h2>
  <ol class="num-list">
    <?php foreach ($tujuan as $t): ?>
    <li><?= htmlspecialchars($t) ?></li>
    <?php endforeach; ?>
  </ol>
</div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">Kurikulum &amp; Silabus</h2>
  <p class="section-subtitle">Petugas P3K Tingkat I &amp; II (±40 jam)</p>
  <div class="module-grid">
    <?php foreach ($modul as $m): ?>
    <div class="module-card">
      <h3><?= htmlspecialchars($m['t']) ?></h3>
      <ul class="plain-list">
        <?php foreach ($m['items'] as $item): ?>
        <li><?= htmlspecialchars($item) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <?php endforeach; ?>
  </div>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">Metode Pelatihan</h2>
  <ul class="plain-list">
    <?php foreach ($metode as $m): ?>
    <li><?= htmlspecialchars($m) ?></li>
    <?php endforeach; ?>
  </ul>
</div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">Program Pelatihan P3K Kami</h2>
  <div class="scheme-grid">
    <?php foreach ($skemas as $sk): 
      $img = training_img_url('', 'k3', $sk['slug']);
      $wa_link = "https://wa.me/{$wa_number}?text=" . rawurlencode('Halo Wahana Totalita, saya ingin informasi pelatihan ' . $sk['name']);
    ?>
    <div class="scheme-card">
      <div class="scheme-card-media">
        <img src="<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($sk['name']) ?>" loading="lazy" width="360" height="170">
        <span class="scheme-cert"><?= htmlspecialchars($sk['cert']) ?></span>
      </div>
      <div class="scheme-card-body">
        <h3><a href="/pelatihan/<?= htmlspecialchars($sk['slug']) ?>/"><?= htmlspecialchars($sk['name']) ?></a></h3>
        <div class="scheme-actions">
          <a href="/pelatihan/<?= htmlspecialchars($sk['slug']) ?>/" class="scheme-link">Silabus &amp; Jadwal &rarr;</a>
          <a href="<?= $wa_link ?>" class="scheme-btn-wa" target="_blank" rel="noopener">Chat WA</a>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">Program K3 Terkait</h2>
  <div class="link-grid">
    <?php foreach ($terkait as $tk): ?>
    <div class="link-card"><a href="<?= htmlspecialchars($tk['url']) ?>"><?= htmlspecialchars($tk['label']) ?> &rarr;</a></div>
    <?php endforeach; ?>
  </div>
</div>
</section>

<section class="white">
<div class="container-sm">
  <h2 class="section-title" style="text-align:center">FAQ</h2>
  <div class="faq-list" style="margin-top:20px">
    <?php foreach ($faqs as $f): ?>
    <div class="faq-item">
      <button class="faq-q" aria-expanded="false" onclick="toggleFaq(this)">
        <?= htmlspecialchars($f['q']) ?>
        <svg class="faq-arrow" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
      </button>
      <div class="faq-a"><p><?= htmlspecialchars($f['a']) ?></p></div>
    </div>
    <?php endforeach; ?>
  </div>
</div>
</section>

<section class="final-cta">
  <div class="container-sm">
    <h2>Daftar &amp; Konsultasi</h2>
    <p>Hubungi kami untuk info jadwal dan biaya pelatihan P3K di Tempat Kerja (Tingkat I/II).</p>
    <a href="<?=$wa_url?>" class="btn-wa" target="_blank" rel="noopener">💬 Konsultasi via WhatsApp</a>
  </div>
</section>

<?php
require_once __DIR__ . '/includes/hub-category-map.php';
$hub_article_cats = $HUB_CATEGORY_MAP['k3']['article_cats'] ?? [];
include __DIR__ . '/includes/hub-artikel-terkait.php';
?>
<?php require __DIR__ . '/includes/footer.php'; ?>
<script>
function toggleFaq(btn) {
  var expanded = btn.getAttribute('aria-expanded') === 'true';
  btn.setAttribute('aria-expanded', !expanded);
  var answer = btn.nextElementSibling;
  answer.classList.toggle('open', !expanded);
}
</script>
</body>
</html>
