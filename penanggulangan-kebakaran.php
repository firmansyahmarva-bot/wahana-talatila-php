<?php
require_once __DIR__ . '/config.php';
$s = get_all_settings();
/**
 * penanggulangan-kebakaran.php
 * Penanggulangan Kebakaran hub page (Kelas D-A). Zero DB dependency,
 * modeled on k3-pesawat-angkat-angkut.php.
 *
 * Real training slugs verified via catalog2026/real_trainings.json:
 * pelatihan-petugas-peran-kebakaran-kelas-d-kemnaker-ri (Kemnaker RI, Kelas D)
 * pelatihan-regu-penanggulangan-kebakaran-kelas-c-sertifikasi-kemnaker-ri (Kemnaker RI, Kelas C)
 * pelatihan-pengkaji-teknis-proteksi-kebakaran-sertifikasi-bnsp (BNSP — closest
 *   real match to advanced/Kelas B-A fire-protection engineering competency,
 *   presented as such, not claimed to literally be a Kemnaker Kelas B/A cert)
 * online-training-fire-watcher (bonus real related product — hot work standby)
 * No real dedicated Kemnaker Kelas B/A product exists — WA-inquiry
 * fallback used for those two tiers in the main program grid.
 *
 * CORRECTIONS FLAGGED TO USER (WebSearch-verified against Kepmenaker
 * No. 186/MEN/1999):
 * 1. Tier naming: the brief labeled Kelas C as "Koordinator Regu" and
 *    Kelas B as "Ahli K3 Madya Kebakaran". The verified official
 *    structure is: Kelas D = Petugas Peran Kebakaran, Kelas C = Regu
 *    Penanggulangan Kebakaran (team members), Kelas B = Koordinator
 *    Unit Penanggulangan Kebakaran, Kelas A = Ahli K3 Spesialis
 *    Penanggulangan Kebakaran (Penanggung Jawab Teknis). Corrected
 *    in the tier table below.
 * 2. Certificate validity (FAQ #4): the brief claimed a flat "Kelas D
 *    & C = 3 tahun, Kelas B & A = 5 tahun". Verified sources describe
 *    a two-part system instead: the competency certificate itself
 *    does not expire, but the operational license/SKP (Surat
 *    Keputusan Penunjukan) needs renewal — 3 tahun for Kelas D, 5
 *    tahun for Kelas C and above. Corrected in FAQ #4 below.
 */
$wa_number = '628122969435';
$wa_msg = rawurlencode('Halo, saya ingin mendaftar pelatihan Penanggulangan Kebakaran (Kelas D/C/B/A). Mohon info jadwal dan biaya?');
$wa_url = "https://wa.me/{$wa_number}?text={$wa_msg}";
$year = date('Y');

$tingkatan = [
    ['kelas' => 'Kelas D', 'level' => 'Petugas Peran Kebakaran', 'peran' => 'Pelaksana pemadaman lapangan', 'durasi' => '±40 jam', 'prasyarat' => 'Tidak ada'],
    ['kelas' => 'Kelas C', 'level' => 'Regu Penanggulangan Kebakaran', 'peran' => 'Anggota tim pemadam terlatih', 'durasi' => '±40 jam', 'prasyarat' => 'Lulus Kelas D'],
    ['kelas' => 'Kelas B', 'level' => 'Koordinator Unit Penanggulangan Kebakaran', 'peran' => 'Manajemen sistem kebakaran', 'durasi' => '±80 jam', 'prasyarat' => 'Lulus Kelas C + D3/S1'],
    ['kelas' => 'Kelas A', 'level' => 'Ahli K3 Spesialis Penanggulangan Kebakaran', 'peran' => 'Penanggung jawab teknis senior', 'durasi' => '±80 jam', 'prasyarat' => 'Lulus Kelas B + pengalaman'],
];

$wajibIkut = [
    'Anggota tim pemadam kebakaran (fire brigade) di pabrik, gudang, dan gedung perkantoran',
    'Security officer yang merangkap tugas fire warden',
    'HSE Officer yang bertanggung jawab atas sistem proteksi kebakaran',
    'Manajer fasilitas dan building manager gedung bertingkat',
    'Pekerja di area berisiko tinggi: pabrik kimia, tekstil, furnitur, minyak goreng, cat',
];

$syaratD = [
    'Usia minimal 18 tahun',
    'Sehat jasmani dan rohani — tidak memiliki gangguan pernapasan atau jantung serius',
    'Fotokopi KTP, pas foto 3×4 (4 lembar), surat keterangan sehat',
];
$syaratC = [
    'Lulus Kelas D (sertifikat asli)',
    'Pengalaman sebagai anggota regu pemadam minimal 1 tahun',
];
$syaratB = [
    'Lulus Kelas C dan D',
    'Ijazah minimal D3/S1 bidang teknik atau K3',
    'Pengalaman di bidang K3 kebakaran minimal 2 tahun',
];
$syaratA = [
    'Lulus Kelas B, C, dan D',
    'Pengalaman sebagai Koordinator UPK (Kelas B) minimal 3 tahun',
];

$tujuan = [
    'Memahami teori api, segitiga api, dan klasifikasi kebakaran',
    'Menggunakan APAR, hydrant, dan foam system dengan benar',
    'Melakukan evakuasi dan penyelamatan korban kebakaran',
    'Menggunakan SCBA (Self-Contained Breathing Apparatus)',
    'Menyusun rencana tanggap darurat kebakaran (Emergency Response Plan)',
    'Melakukan inspeksi sistem proteksi kebakaran (detektor, sprinkler, hydrant)',
];

$materiD = [
    'Teori api: segitiga api, tetrahedron api, proses pembakaran',
    'Klasifikasi kebakaran: A (padat), B (cair/gas), C (listrik), D (logam)',
    'Jenis APAR dan cara penggunaannya (PASS method)',
    'Teknik pemadaman dengan hydrant dan selang',
    'Prosedur evakuasi: jalur evakuasi, titik kumpul (muster point)',
    'Penggunaan SCBA dasar',
    'Praktik pemadaman api nyata (live fire exercise)',
];
$materiC = [
    'Manajemen regu pemadam',
    'Sistem komunikasi darurat kebakaran',
    'Koordinasi dengan pemadam kebakaran (Damkar) eksternal',
    'Investigasi pasca-kebakaran',
    'Pemeliharaan peralatan pemadam',
];
$materiB = [
    'Sistem proteksi kebakaran aktif: sprinkler, detektor, alarm',
    'Sistem proteksi kebakaran pasif: kompartementasi, pintu tahan api',
    'Fire risk assessment',
    'Penyusunan Emergency Response Plan (ERP)',
    'Standar NFPA dan SNI proteksi kebakaran',
    'Audit sistem proteksi kebakaran',
];
$materiA = [
    'Desain sistem proteksi kebakaran',
    'Fire engineering analysis',
    'Manajemen krisis kebakaran skala besar',
    'Koordinasi multi-instansi (Damkar, BPBD, Polisi)',
    'Program pelatihan kebakaran untuk organisasi',
];

$metode = [
    'Pelatihan tatap muka di Yogyakarta — termasuk praktik live fire exercise di area terbuka',
    'In-house training di fasilitas perusahaan (minimum 10 peserta) — efisien untuk membentuk tim UPK sekaligus',
    'Sertifikasi Kemnaker RI diterbitkan setelah lulus ujian teori dan praktik',
];

$skemas = [
    ['name' => 'Pelatihan Petugas Peran Kebakaran Kelas D', 'cert' => 'Sertifikasi KEMNAKER RI', 'slug' => 'pelatihan-petugas-peran-kebakaran-kelas-d-kemnaker-ri'],
    ['name' => 'Pelatihan Regu Penanggulangan Kebakaran Kelas C', 'cert' => 'Sertifikasi KEMNAKER RI', 'slug' => 'pelatihan-regu-penanggulangan-kebakaran-kelas-c-sertifikasi-kemnaker-ri'],
    ['name' => 'Pelatihan Pengkaji Teknis Proteksi Kebakaran', 'cert' => 'Sertifikasi BNSP', 'slug' => 'pelatihan-pengkaji-teknis-proteksi-kebakaran-sertifikasi-bnsp'],
    ['name' => 'Online Training Fire Watcher', 'cert' => 'Sertifikat Pelatihan', 'slug' => 'online-training-fire-watcher'],
];

$terkait = [
    ['label' => 'Pelatihan K3 Kimia', 'url' => '/k3-kimia/'],
    ['label' => 'Pelatihan K3 Migas', 'url' => '/k3-migas/'],
    ['label' => 'Panduan Lengkap K3', 'url' => '/keselamatan-kerja/'],
    ['label' => 'Pelatihan K3 Ketinggian', 'url' => '/k3-ketinggian/'],
];

$faqs = [
    ['q' => 'Berapa jumlah anggota UPK yang wajib dimiliki perusahaan?', 'a' => 'Berdasarkan Kepmenaker 186/1999, jumlah dan komposisi anggota Unit Penanggulangan Kebakaran (UPK) disesuaikan dengan klasifikasi tingkat risiko kebakaran tempat kerja (ringan, sedang I-III, berat) dan jumlah tenaga kerja. Tempat kerja berisiko tinggi wajib memiliki tim lengkap termasuk Regu (Kelas C), Koordinator (Kelas B), dan Ahli K3 Spesialis (Kelas A) — konsultasikan dengan kami untuk perhitungan komposisi tim sesuai klasifikasi tempat kerja Anda.'],
    ['q' => 'Apa beda APAR dan hydrant — kapan menggunakan masing-masing?', 'a' => 'APAR (Alat Pemadam Api Ringan) digunakan untuk memadamkan api tahap awal (incipient stage) sebelum menyebar. Hydrant digunakan ketika api sudah berkembang dan membutuhkan volume air besar. Aturan praktis: jika api sudah sebesar manusia, tinggalkan area dan hubungi pemadam — jangan coba padamkan sendiri.'],
    ['q' => 'Apakah semua perusahaan wajib punya tim pemadam kebakaran internal?', 'a' => 'Ya. Kepmenaker 186/1999 mewajibkan setiap tempat kerja membentuk Unit Penanggulangan Kebakaran (UPK). Skala dan komposisi tim menyesuaikan jumlah karyawan dan tingkat risiko. Tidak ada pengecualian berdasarkan ukuran perusahaan.'],
    ['q' => 'Berapa lama sertifikat penanggulangan kebakaran berlaku?', 'a' => 'Sertifikat kompetensi Kelas D dan C pada dasarnya tidak memiliki masa kadaluarsa, namun lisensi/kartu kewenangan (SKP) yang menyertainya wajib diperpanjang secara berkala — umumnya 3 tahun untuk Kelas D dan 5 tahun untuk Kelas C ke atas. Perpanjangan dilakukan melalui pelatihan penyegaran (refreshing) sebelum masa berlaku lisensi habis.'],
    ['q' => 'Apakah live fire exercise wajib dalam pelatihan?', 'a' => 'Ya, praktik pemadaman api nyata (live fire exercise) adalah bagian wajib dari pelatihan Kelas D dan C. Peserta harus membuktikan mampu menggunakan APAR dan selang pemadam secara langsung pada api nyata yang terkontrol. Ini yang membedakan sertifikat resmi Kemnaker dengan sertifikat pelatihan biasa.'],
    ['q' => 'Bisakah pelatihan kebakaran dilakukan di lokasi pabrik kami?', 'a' => 'Ya. Kami melayani in-house training penanggulangan kebakaran di lokasi perusahaan, termasuk live fire exercise di area yang telah dipersiapkan. Minimum 10 peserta. Opsi ini sangat disarankan agar anggota UPK berlatih di lingkungan kerja mereka sendiri.'],
];
?>
<?php
$page_title = 'Pelatihan Penanggulangan Kebakaran (Kelas A, B, C, D) — Sertifikasi Kemnaker RI';
$meta_desc = 'Pelatihan Penanggulangan Kebakaran resmi bersertifikat Kemnaker RI. Program Kelas D hingga Kelas A sesuai Kepmenaker No. 186/MEN/1999. Yogyakarta & in-house. 0812-2969-435.';
require __DIR__ . '/includes/head.php';
?>
<script type="application/ld+json">
{"@context":"https://schema.org","@type":"BreadcrumbList","itemListElement":[
  {"@type":"ListItem","position":1,"name":"Beranda","item":"https://wahanatotalita.com/"},
  {"@type":"ListItem","position":2,"name":"Pelatihan","item":"https://wahanatotalita.com/pelatihan/"},
  {"@type":"ListItem","position":3,"name":"Penanggulangan Kebakaran","item":"https://wahanatotalita.com/penanggulangan-kebakaran/"}
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
  "telephone": "+628122969435",
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
.compare-table{width:100%;border-collapse:collapse;background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 2px 12px rgba(0,0,0,.05);min-width:640px}
.four-col{display:grid;grid-template-columns:repeat(4,1fr);gap:14px}
@media(max-width:900px){.four-col{grid-template-columns:repeat(2,1fr)}}
@media(max-width:640px){.four-col{grid-template-columns:1fr}}
.inquiry-card{background:#fff;border:2px dashed #0A4A2E;border-radius:14px;padding:20px;text-align:center;margin-top:14px}
.inquiry-card p{font-size:13.5px;color:#4b5563;margin-bottom:12px}
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
    <div class="hero-badge">🔥 Penanggulangan Kebakaran</div>
    <h1>Pelatihan Penanggulangan Kebakaran Kelas A–D Bersertifikat Kemnaker RI</h1>
    <p class="hero-sub">Sertifikasi resmi Kemnaker RI sesuai Kepmenaker No. 186/MEN/1999.</p>
    <div><a href="<?=$wa_url?>" class="btn-wa" target="_blank" rel="noopener">💬 Konsultasi Jadwal &amp; Biaya</a></div>
  </div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">Mengapa Penanggulangan Kebakaran Wajib di Tempat Kerja?</h2>
  <p class="intro-text">Kebakaran adalah salah satu bencana terbesar yang dapat menghancurkan aset, menghentikan operasi, dan merenggut nyawa karyawan dalam hitungan menit. Data BNPB mencatat kebakaran industri dan komersial menyebabkan kerugian triliunan rupiah setiap tahun di Indonesia. Kepmenaker No. 186/MEN/1999 mewajibkan setiap perusahaan membentuk Unit Penanggulangan Kebakaran (UPK) dengan anggota bersertifikat — bukan sekadar memiliki APAR.</p>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">Dasar Hukum — Kepmenaker No. 186/MEN/1999</h2>
  <ul class="law-list">
    <li>Setiap tempat kerja wajib memiliki Unit Penanggulangan Kebakaran (UPK)</li>
    <li>Jumlah anggota UPK disesuaikan dengan jumlah karyawan dan tingkat risiko kebakaran</li>
    <li>Tempat kerja dengan risiko kebakaran tinggi (pabrik kimia, migas, tekstil, gudang) wajib memiliki Koordinator UPK (Kelas B) atau Ahli K3 Spesialis (Kelas A)</li>
    <li>Peralatan pemadam wajib diperiksa berkala dan anggota UPK wajib dilatih minimal setahun sekali</li>
    <li>Sanksi: penghentian operasi jika UPK tidak memenuhi syarat</li>
  </ul>
</div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">Tingkatan Sertifikasi Penanggulangan Kebakaran</h2>
  <div class="compare-table-wrap">
  <table class="compare-table">
    <thead><tr><th>Kelas</th><th>Level</th><th>Peran</th><th>Durasi</th><th>Prasyarat</th></tr></thead>
    <tbody>
      <?php foreach ($tingkatan as $row): ?>
      <tr><td><?= htmlspecialchars($row['kelas']) ?></td><td><?= htmlspecialchars($row['level']) ?></td><td><?= htmlspecialchars($row['peran']) ?></td><td><?= htmlspecialchars($row['durasi']) ?></td><td><?= htmlspecialchars($row['prasyarat']) ?></td></tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  </div>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">Siapa yang Wajib Ikut Pelatihan Ini?</h2>
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
  <div class="four-col">
    <div>
      <h3 class="sub-title">Kelas D (Entry Level)</h3>
      <ul class="plain-list">
        <?php foreach ($syaratD as $s): ?>
        <li><?= htmlspecialchars($s) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div>
      <h3 class="sub-title">Kelas C</h3>
      <ul class="plain-list">
        <?php foreach ($syaratC as $s): ?>
        <li><?= htmlspecialchars($s) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div>
      <h3 class="sub-title">Kelas B</h3>
      <ul class="plain-list">
        <?php foreach ($syaratB as $s): ?>
        <li><?= htmlspecialchars($s) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div>
      <h3 class="sub-title">Kelas A</h3>
      <ul class="plain-list">
        <?php foreach ($syaratA as $s): ?>
        <li><?= htmlspecialchars($s) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
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
  <h2 class="section-title">Kurikulum</h2>
  <h3 class="sub-title">Kelas D — Petugas Peran Kebakaran (±40 jam)</h3>
  <ul class="plain-list">
    <?php foreach ($materiD as $m): ?>
    <li><?= htmlspecialchars($m) ?></li>
    <?php endforeach; ?>
  </ul>
  <h3 class="sub-title">Kelas C — Regu Penanggulangan Kebakaran (±40 jam — ditambah)</h3>
  <ul class="plain-list">
    <?php foreach ($materiC as $m): ?>
    <li><?= htmlspecialchars($m) ?></li>
    <?php endforeach; ?>
  </ul>
  <h3 class="sub-title">Kelas B — Koordinator UPK (±80 jam — ditambah)</h3>
  <ul class="plain-list">
    <?php foreach ($materiB as $m): ?>
    <li><?= htmlspecialchars($m) ?></li>
    <?php endforeach; ?>
  </ul>
  <h3 class="sub-title">Kelas A — Ahli K3 Spesialis Penanggulangan Kebakaran (±80 jam — ditambah)</h3>
  <ul class="plain-list">
    <?php foreach ($materiA as $m): ?>
    <li><?= htmlspecialchars($m) ?></li>
    <?php endforeach; ?>
  </ul>
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
  <h2 class="section-title">Program Pelatihan Penanggulangan Kebakaran Kami</h2>
  <div class="scheme-grid">
    <?php foreach ($skemas as $sk): ?>
    <div class="scheme-card">
      <span class="scheme-cert"><?= htmlspecialchars($sk['cert']) ?></span>
      <h3><a href="/pelatihan/<?= htmlspecialchars($sk['slug']) ?>/"><?= htmlspecialchars($sk['name']) ?></a></h3>
      <a href="/pelatihan/<?= htmlspecialchars($sk['slug']) ?>/" class="scheme-link">Lihat Program &rarr;</a>
    </div>
    <?php endforeach; ?>
  </div>
  <div class="inquiry-card">
    <p>Membutuhkan sertifikasi Koordinator UPK (Kelas B) atau Ahli K3 Spesialis (Kelas A) secara spesifik? Hubungi kami untuk konsultasi jadwal dan penyelenggaraan in-house.</p>
    <a href="<?=$wa_url?>" class="btn-wa" target="_blank" rel="noopener" style="margin-top:0">💬 Tanya Jadwal Kelas B/A</a>
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
    <p>Hubungi kami untuk info jadwal dan biaya pelatihan Penanggulangan Kebakaran (Kelas D/C/B/A).</p>
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
