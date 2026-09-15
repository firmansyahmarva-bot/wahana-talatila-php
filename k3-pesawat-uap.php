<?php
require_once __DIR__ . '/config.php';
$s = get_all_settings();
/**
 * k3-pesawat-uap.php
 * K3 Pesawat Uap & Bejana Tekanan hub page (Operator Boiler). Zero
 * DB dependency, modeled on p3k.php.
 *
 * Real training slugs verified via catalog2026/real_trainings.json:
 * pelatihan-k3-operator-boiler-kelas-2-sertifikasi-kemnaker-ri (Kemnaker RI, Rp6.500.000)
 * pelatihan-teknisi-bejana-tekan-sertifikasi-kemnaker-ri (Kemnaker RI, Rp10.500.000)
 * No real dedicated "Operator Boiler Kelas I" or "Pengawas Spesialis
 * K3 Pesawat Uap" product exists — WA-inquiry fallback used for those
 * two, per the established gap-handling pattern.
 *
 * WebSearch verification:
 * - UU Uap 1930 (Stoom Ordonnantie 1930): confirmed real, in effect
 *   since 1 Jan 1931, still the governing law for boilers in Indonesia.
 * - Boiler class split confirmed: Kelas II <=10 ton uap/jam, Kelas I
 *   >10 ton uap/jam. The brief's extra "ATAU <=1 MW / tekanan" capacity
 *   criteria could not be verified against a specific source, so the
 *   tier table below uses only the confirmed ton-based threshold
 *   rather than publishing an unverified MW/MPa figure.
 * - Permenaker No. 37/2016 confirmed real, effective 27 Des 2016,
 *   replaces Permenaker 01/1982. Added one verified detail not in the
 *   original brief: bejana tekanan wajib uji hidrostatik maksimal
 *   setiap 5 tahun; tangki timbun wajib pemeriksaan visual setiap 2
 *   tahun dan uji menyeluruh setiap 5 tahun.
 */
$wa_number = '628122969435';
$wa_msg = rawurlencode('Halo, saya ingin mendaftar pelatihan K3 Pesawat Uap / Operator Boiler (Kelas I/II). Mohon info jadwal dan biaya?');
$wa_url = "https://wa.me/{$wa_number}?text={$wa_msg}";
$year = date('Y');

$tingkatan = [
    ['kelas' => 'Operator Kelas II', 'kapasitas' => '≤ 10 ton uap/jam', 'ket' => 'Boiler skala menengah'],
    ['kelas' => 'Operator Kelas I', 'kapasitas' => '> 10 ton uap/jam', 'ket' => 'Boiler skala besar dan PLTU'],
    ['kelas' => 'Pengawas Spesialis K3', 'kapasitas' => 'Semua ukuran', 'ket' => 'Mengawasi, memeriksa, mengesahkan'],
];

$wajibSertifikat = [
    'Operator boiler di pabrik tekstil, kertas, makanan/minuman, kimia, dan karet',
    'Operator boiler di hotel berbintang dan rumah sakit (untuk sistem pemanas dan laundry)',
    'Operator boiler di PLTU (Pembangkit Listrik Tenaga Uap)',
    'Teknisi yang menangani kompresor udara, autoclave, dan tangki LPG/CNG',
    'Pengawas K3 yang bertanggung jawab atas izin operasi pesawat uap di perusahaan',
];

$syaratKelas2 = [
    'Ijazah minimal SMP sederajat',
    'Sehat jasmani dan rohani',
    'Fotokopi KTP, pas foto 3×4 (4 lembar), surat keterangan sehat',
];
$syaratKelas1 = [
    'Ijazah minimal SMA/SMK Teknik sederajat',
    'Pengalaman sebagai Operator Kelas II minimal 2 tahun (diutamakan)',
    'Persyaratan dokumen sama seperti Operator Kelas II',
];
$syaratPengawas = [
    'Ijazah minimal D3/S1 Teknik Mesin atau relevan',
    'Pengalaman di bidang pesawat uap minimal 3 tahun',
];

$tujuan = [
    'Memahami regulasi K3 Pesawat Uap dan Bejana Tekanan (UU Uap 1930, Permenaker 37/2016)',
    'Mengoperasikan boiler dengan aman: start-up, operasi normal, dan shutdown',
    'Melakukan inspeksi harian boiler dan sistem perpipaan',
    'Memahami fungsi dan cara pengujian alat pengaman: safety valve, pressure gauge, water level gauge',
    'Menangani kondisi darurat: over-pressure, dry firing (kering tanpa air), kebocoran uap',
    'Memahami persyaratan Akte Ijin dan prosedur perpanjangan izin boiler',
];

$materiKelas2 = [
    'Regulasi K3 Pesawat Uap (UU Uap 1930) dan persyaratan Akte Ijin',
    'Konstruksi dan komponen boiler: drum, tube, burner, safety valve',
    'Prinsip perpindahan panas dan pembentukan uap',
    'Bahan bakar boiler: gas, solar, batubara, biomassa',
    'Prosedur start-up dan shutdown boiler yang aman',
    'Pembacaan instrumen: pressure gauge, temperature gauge, water level gauge',
    'Pengolahan air boiler (water treatment) untuk mencegah scaling dan korosi',
    'Penanganan darurat: over-pressure, kering tanpa air, kebocoran',
];
$materiKelas1 = [
    'Boiler kapasitas besar dan HRSG (Heat Recovery Steam Generator)',
    'Sistem kontrol otomatis boiler (DCS/PLC)',
    'Efisiensi pembakaran dan optimasi energi',
    'Analisis air boiler: hardness, pH, TDS, O₂ terlarut',
    'Prosedur pemeriksaan berkala dan hydraulic test',
    'Persyaratan teknis PLTU',
];
$materiBejana = [
    'Klasifikasi bejana tekanan (Permenaker 37/2016)',
    'Alat pengaman: pressure relief valve, rupture disc, pressure switch',
    'Inspeksi visual dan NDT (Non-Destructive Testing) dasar',
    'Prosedur hidrostatis test bejana tekanan (maksimal setiap 5 tahun)',
    'Keselamatan tangki LPG dan kompresor udara',
];

$metode = [
    'Pelatihan tatap muka di Yogyakarta — termasuk demonstrasi langsung pada unit boiler',
    'In-house training di fasilitas perusahaan (minimum 10 peserta)',
    'SIO diterbitkan oleh Kemnaker RI setelah lulus ujian teori dan praktik',
];

$skemas = [
    ['name' => 'Pelatihan K3 Operator Boiler Kelas 2', 'cert' => 'Sertifikasi KEMNAKER RI', 'slug' => 'pelatihan-k3-operator-boiler-kelas-2-sertifikasi-kemnaker-ri'],
    ['name' => 'Pelatihan Teknisi Bejana Tekan', 'cert' => 'Sertifikasi KEMNAKER RI', 'slug' => 'pelatihan-teknisi-bejana-tekan-sertifikasi-kemnaker-ri'],
];

$terkait = [
    ['label' => 'Pelatihan K3 Listrik', 'url' => '/k3-listrik/'],
    ['label' => 'K3 Pesawat Angkat Angkut', 'url' => '/k3-pesawat-angkat-angkut/'],
    ['label' => 'Panduan Lengkap K3', 'url' => '/keselamatan-kerja/'],
    ['label' => 'Sertifikasi BNSP', 'url' => '/sertifikasi-bnsp/'],
];

$faqs = [
    ['q' => 'Apakah setiap boiler di Indonesia wajib memiliki Akte Ijin?', 'a' => 'Ya. Berdasarkan Undang-Undang Uap 1930 yang masih berlaku, setiap boiler wajib memiliki Akte Ijin dari Kemnaker RI sebelum boleh dioperasikan. Akte Ijin diterbitkan setelah boiler diperiksa dan dinyatakan layak oleh pengawas K3 atau PJK3 yang ditunjuk. Mengoperasikan boiler tanpa Akte Ijin adalah pelanggaran hukum.'],
    ['q' => 'Apa yang terjadi jika boiler dioperasikan tanpa operator bersertifikat?', 'a' => 'Selain risiko kecelakaan yang sangat tinggi, perusahaan dapat dikenai sanksi administratif oleh Disnaker, diwajibkan menghentikan operasi boiler, dan bertanggung jawab secara pidana jika terjadi kecelakaan. Operator tanpa SIO juga tidak dilindungi secara hukum jika terlibat insiden.'],
    ['q' => 'Apa perbedaan boiler dan bejana tekanan?', 'a' => 'Boiler (pesawat uap) menggunakan panas untuk menghasilkan uap bertekanan. Bejana tekanan adalah wadah yang berisi fluida (gas atau cair) bertekanan tanpa proses pemanasan aktif — contoh: tangki LPG, kompresor udara, autoclave, dan filter bertekanan. Keduanya diatur berbeda: boiler oleh UU Uap 1930, bejana tekanan oleh Permenaker 37/2016.'],
    ['q' => 'Berapa lama SIO Operator Pesawat Uap berlaku?', 'a' => 'SIO Operator Pesawat Uap berlaku 5 tahun dan dapat diperpanjang melalui uji ulang kompetensi sebelum masa berlaku habis.'],
    ['q' => 'Seberapa berbahaya ledakan boiler dibandingkan kebakaran biasa?', 'a' => 'Ledakan boiler jauh lebih destruktif daripada kebakaran biasa. Ketika boiler meledak, energi yang tersimpan dalam uap bertekanan dilepaskan seketika — setara dengan ledakan bahan peledak. Pecahan metal dapat terlontar ratusan meter dan gelombang tekanan dapat merobohkan bangunan di sekitarnya. Ini sebabnya regulasi boiler di Indonesia sudah ada sejak 1930.'],
    ['q' => 'Apakah kompresor udara di bengkel juga termasuk bejana tekanan?', 'a' => 'Ya. Tangki penyimpanan udara bertekanan pada kompresor termasuk dalam kategori bejana tekanan yang diatur Permenaker 37/2016. Perusahaan wajib memastikan kompresor memiliki sertifikat kelayakan dan dilengkapi safety valve yang berfungsi. Kompresor yang tangkinya sudah berkarat dan tidak diperiksa secara berkala menjadi bom waktu.'],
];
?>
<?php
$page_title = 'Pelatihan K3 Pesawat Uap & Bejana Tekanan (Operator Boiler) — Sertifikasi Kemnaker RI';
$meta_desc = 'Pelatihan K3 Pesawat Uap dan Bejana Tekanan bersertifikat Kemnaker RI. Program Operator Boiler Kelas I & II dan Pengawas K3 Pesawat Uap sesuai Undang-Undang Uap 1930 dan Permenaker 37/2016. 0812-2969-435.';
require __DIR__ . '/includes/head.php';
?>
<script type="application/ld+json">
{"@context":"https://schema.org","@type":"BreadcrumbList","itemListElement":[
  {"@type":"ListItem","position":1,"name":"Beranda","item":"https://wahanatotalita.com/"},
  {"@type":"ListItem","position":2,"name":"Pelatihan","item":"https://wahanatotalita.com/pelatihan/"},
  {"@type":"ListItem","position":3,"name":"K3 Pesawat Uap","item":"https://wahanatotalita.com/k3-pesawat-uap/"}
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
.compare-table{width:100%;border-collapse:collapse;background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 2px 12px rgba(0,0,0,.05);min-width:520px}
.three-col{display:grid;grid-template-columns:repeat(3,1fr);gap:14px}
@media(max-width:900px){.three-col{grid-template-columns:1fr}}
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
    <div class="hero-badge">🔥 K3 Pesawat Uap</div>
    <h1>Pelatihan K3 Pesawat Uap dan Bejana Tekanan — Operator Boiler Bersertifikat Kemnaker RI</h1>
    <p class="hero-sub">Sertifikasi resmi Kemnaker RI sesuai Undang-Undang Uap 1930 dan Permenaker No. 37 Tahun 2016.</p>
    <div><a href="<?=$wa_url?>" class="btn-wa" target="_blank" rel="noopener">💬 Konsultasi Jadwal &amp; Biaya</a></div>
  </div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">Apa itu Pesawat Uap dan Bejana Tekanan?</h2>
  <p class="intro-text">Pesawat Uap (boiler) adalah alat yang menggunakan panas untuk menghasilkan uap bertekanan tinggi yang digunakan dalam proses industri, pembangkit listrik, dan sistem pemanas. Bejana Tekanan (pressure vessel) adalah wadah tertutup yang berisi gas, uap, atau cairan bertekanan di atas tekanan atmosfer — termasuk tangki LPG, kompresor, autoclave, dan reaktor kimia. Keduanya menyimpan energi luar biasa besar: kegagalan boiler atau bejana tekanan bisa menyebabkan ledakan katastrofik yang meratakan bangunan. Di Indonesia pengawasannya diatur sejak 1930.</p>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">Dasar Hukum</h2>
  <h3 class="sub-title">Undang-Undang Uap 1930 (Stoom Ordonnantie 1930)</h3>
  <ul class="law-list">
    <li>Regulasi tertua yang masih berlaku di Indonesia, berlaku sejak 1 Januari 1931</li>
    <li>Setiap boiler wajib memiliki Akte Ijin (izin penggunaan) dari Kemnaker sebelum dioperasikan</li>
    <li>Operator boiler wajib bersertifikat Kemnaker RI — tanpa SIO tidak boleh mengoperasikan boiler</li>
    <li>Inspeksi berkala wajib oleh pengawas K3 atau PJK3 yang ditunjuk Kemnaker</li>
  </ul>
  <h3 class="sub-title">Permenaker No. 37 Tahun 2016 tentang K3 Bejana Tekanan dan Tangki Timbun</h3>
  <ul class="law-list">
    <li>Mengatur standar keselamatan bejana tekanan, tangki penyimpanan, dan pipa bertekanan</li>
    <li>Wajib ada pemeriksaan dan pengujian sebelum pertama kali digunakan</li>
    <li>Wajib dipasang alat pengaman: pressure gauge, safety valve, dan rupture disc</li>
    <li>Bejana tekanan wajib uji hidrostatik maksimal setiap 5 tahun; tangki timbun wajib pemeriksaan visual setiap 2 tahun dan uji menyeluruh setiap 5 tahun</li>
    <li>Setiap bejana tekanan wajib memiliki sertifikat kelayakan dari Kemnaker</li>
  </ul>
</div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">Tingkatan Sertifikasi Operator Pesawat Uap</h2>
  <div class="compare-table-wrap">
  <table class="compare-table">
    <thead><tr><th>Kelas</th><th>Kapasitas Boiler</th><th>Keterangan</th></tr></thead>
    <tbody>
      <?php foreach ($tingkatan as $row): ?>
      <tr><td><?= htmlspecialchars($row['kelas']) ?></td><td><?= htmlspecialchars($row['kapasitas']) ?></td><td><?= htmlspecialchars($row['ket']) ?></td></tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  </div>
  <p class="intro-text" style="margin-top:12px">Operator Kelas I dapat mengoperasikan semua boiler termasuk yang masuk kewenangan Kelas II. Operator Kelas II tidak boleh mengoperasikan boiler Kelas I.</p>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">Siapa yang Wajib Bersertifikat?</h2>
  <ul class="plain-list">
    <?php foreach ($wajibSertifikat as $w): ?>
    <li><?= htmlspecialchars($w) ?></li>
    <?php endforeach; ?>
  </ul>
</div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">Persyaratan Peserta</h2>
  <div class="three-col">
    <div>
      <h3 class="sub-title">Operator Kelas II</h3>
      <ul class="plain-list">
        <?php foreach ($syaratKelas2 as $s): ?>
        <li><?= htmlspecialchars($s) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div>
      <h3 class="sub-title">Operator Kelas I</h3>
      <ul class="plain-list">
        <?php foreach ($syaratKelas1 as $s): ?>
        <li><?= htmlspecialchars($s) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div>
      <h3 class="sub-title">Pengawas Spesialis K3 Pesawat Uap</h3>
      <ul class="plain-list">
        <?php foreach ($syaratPengawas as $s): ?>
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
  <h3 class="sub-title">Operator Pesawat Uap Kelas II (±40 jam)</h3>
  <ul class="plain-list">
    <?php foreach ($materiKelas2 as $m): ?>
    <li><?= htmlspecialchars($m) ?></li>
    <?php endforeach; ?>
  </ul>
  <h3 class="sub-title">Operator Pesawat Uap Kelas I (±40 jam — ditambah)</h3>
  <ul class="plain-list">
    <?php foreach ($materiKelas1 as $m): ?>
    <li><?= htmlspecialchars($m) ?></li>
    <?php endforeach; ?>
  </ul>
  <h3 class="sub-title">Bejana Tekanan — Materi Tambahan</h3>
  <ul class="plain-list">
    <?php foreach ($materiBejana as $m): ?>
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
  <h2 class="section-title">Program Pelatihan K3 Pesawat Uap Kami</h2>
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
    <p>Membutuhkan sertifikasi Operator Boiler Kelas I atau Pengawas Spesialis K3 Pesawat Uap secara spesifik? Hubungi kami untuk konsultasi jadwal dan penyelenggaraan in-house.</p>
    <a href="<?=$wa_url?>" class="btn-wa" target="_blank" rel="noopener" style="margin-top:0">💬 Tanya Jadwal Kelas I/Pengawas</a>
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
    <p>Hubungi kami untuk info jadwal dan biaya pelatihan K3 Pesawat Uap / Operator Boiler (Kelas I/II).</p>
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
