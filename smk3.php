<?php
require_once __DIR__ . '/config.php';
$s = get_all_settings();
/**
 * smk3.php
 * SMK3 & ISO 45001 hub page. Zero DB dependency, modeled on
 * k3-pertambangan.php.
 *
 * Real training slugs verified via catalog2026/real_trainings.json —
 * all 4 exist, no content gap this time:
 * pelatihan-auditor-smk3-online (BNSP, Rp4.750.000)
 * pelatihan-csms-pengawas-smk3-kontraktor-online (BNSP, Rp3.000.000)
 * pelatihan-internal-auditor-iso-45001-online (Sertifikat Kompetensi, Rp5.000.000)
 * pelatihan-lead-auditor-iso-45001-online (Sertifikat Kompetensi, Rp7.500.000)
 *
 * PP No. 50/2012 facts WebSearch-verified: Pasal 5 threshold (>=100
 * tenaga kerja OR potensi bahaya tinggi), bendera perak 60-84%,
 * bendera emas 85-100%, sertifikat berlaku 3 tahun — all confirmed
 * accurate as briefed. One nuance added (not a correction): 166
 * kriteria/12 elemen is the "tingkat lanjutan" (advanced) audit tier;
 * PP 50/2012 also defines 64-criteria (awal) and 122-criteria
 * (transisi) tiers for companies at earlier SMK3 maturity — noted in
 * the audit section for accuracy without contradicting the brief.
 */
$wa_number = '628122969435';
$wa_msg = rawurlencode('Halo, saya ingin konsultasi penerapan SMK3 / mendaftar pelatihan Audit SMK3 Internal. Mohon info lebih lanjut.');
$wa_url = "https://wa.me/{$wa_number}?text={$wa_msg}";
$year = date('Y');

$compare = [
    ['aspek' => 'Otoritas', 'smk3' => 'Pemerintah Indonesia (Kemnaker)', 'iso' => 'Internasional (ISO)'],
    ['aspek' => 'Kewajiban', 'smk3' => 'Wajib untuk ≥100 karyawan', 'iso' => 'Sukarela'],
    ['aspek' => 'Pengakuan', 'smk3' => 'Nasional', 'iso' => 'Internasional'],
    ['aspek' => 'Audit', 'smk3' => 'Oleh auditor Kemnaker', 'iso' => 'Oleh lembaga sertifikasi terakreditasi'],
    ['aspek' => 'Hasil', 'smk3' => 'Bendera Emas / Perak', 'iso' => 'Sertifikat ISO 45001'],
    ['aspek' => 'Elemen', 'smk3' => '12 elemen, hingga 166 kriteria', 'iso' => '10 klausa (HLS)'],
    ['aspek' => 'Kompatibilitas', 'smk3' => 'Bisa diintegrasikan dengan ISO 45001', 'iso' => 'Menggantikan OHSAS 18001'],
];

$prinsip = [
    ['t' => 'Komitmen dan Kebijakan', 'd' => 'Manajemen puncak menetapkan dan menandatangani kebijakan K3 tertulis yang mencakup komitmen terhadap pemenuhan peraturan perundangan.'],
    ['t' => 'Perencanaan', 'd' => 'Identifikasi bahaya, penilaian risiko, dan penentuan pengendalian; perencanaan pemenuhan regulasi K3; penetapan sasaran K3 tahunan.'],
    ['t' => 'Penerapan dan Operasi', 'd' => 'Pelaksanaan program K3, pelatihan, komunikasi, dokumentasi, dan pengendalian operasional.'],
    ['t' => 'Pemeriksaan dan Tindakan Korektif', 'd' => 'Inspeksi, pengukuran, pemantauan, penyelidikan insiden, audit internal SMK3.'],
    ['t' => 'Tinjauan Manajemen', 'd' => 'Review berkala oleh manajemen puncak terhadap kinerja SMK3 dan penyesuaian sistem.'],
];

$elemenAudit = [
    'Pembangunan dan pemeliharaan komitmen',
    'Strategi pendokumentasian',
    'Peninjauan ulang, perancangan, dan kontrak',
    'Pengendalian dokumen',
    'Pembelian dan pengendalian produk',
    'Keamanan bekerja berdasarkan SMK3',
    'Standar pemantauan',
    'Pelaporan dan perbaikan kekurangan',
    'Pengelolaan material dan pemindahannya',
    'Pengumpulan dan penggunaan data',
    'Audit SMK3',
    'Pengembangan keterampilan dan kemampuan',
];

$wajibIkut = [
    'Manager HSE dan safety officer yang bertanggung jawab mengelola SMK3 perusahaan',
    'Auditor internal yang akan melakukan audit SMK3 sebelum audit eksternal',
    'Direksi dan manajemen puncak yang perlu memahami kewajiban hukum PP 50/2012',
    'Konsultan yang membantu perusahaan klien menerapkan SMK3',
    'Perusahaan yang bersiap meraih sertifikat bendera emas/perak',
];

$layanan = [
    ['t' => 'Pelatihan Audit SMK3 Internal', 'd' => 'Melatih tim Anda untuk melakukan audit SMK3 sendiri sebelum audit eksternal Kemnaker. Peserta mampu menggunakan kriteria audit PP 50/2012.'],
    ['t' => 'Konsultasi Penerapan SMK3', 'd' => 'Pendampingan implementasi dari gap analysis hingga siap audit. Cocok untuk perusahaan yang baru wajib menerapkan SMK3.'],
    ['t' => 'Pelatihan Pemahaman ISO 45001:2018', 'd' => 'Transisi dari OHSAS 18001 ke ISO 45001, atau implementasi baru untuk perusahaan yang menginginkan pengakuan internasional.'],
];

$skemas = [
    ['name' => 'Pelatihan Auditor SMK3', 'cert' => 'Sertifikasi BNSP', 'slug' => 'pelatihan-auditor-smk3-online'],
    ['name' => 'Pelatihan CSMS Pengawas SMK3 Kontraktor', 'cert' => 'Sertifikasi BNSP', 'slug' => 'pelatihan-csms-pengawas-smk3-kontraktor-online'],
    ['name' => 'Pelatihan Internal Auditor ISO 45001:2018', 'cert' => 'Sertifikat Kompetensi', 'slug' => 'pelatihan-internal-auditor-iso-45001-online'],
    ['name' => 'Pelatihan Lead Auditor ISO 45001:2018', 'cert' => 'Sertifikat Kompetensi', 'slug' => 'pelatihan-lead-auditor-iso-45001-online'],
];

$terkait = [
    ['label' => 'Panduan Lengkap K3', 'url' => '/keselamatan-kerja/'],
    ['label' => 'Pelatihan K3 Konstruksi', 'url' => '/k3-konstruksi/'],
    ['label' => 'Pelatihan K3 Pertambangan', 'url' => '/k3-pertambangan/'],
    ['label' => 'Sertifikasi BNSP', 'url' => '/sertifikasi-bnsp/'],
];

$faqs = [
    ['q' => 'Apakah semua perusahaan wajib menerapkan SMK3?', 'a' => 'Tidak semua. Berdasarkan PP 50/2012, SMK3 wajib diterapkan oleh perusahaan yang mempekerjakan ≥100 tenaga kerja ATAU memiliki tingkat potensi bahaya tinggi (seperti pertambangan, kimia, konstruksi) — berapapun jumlah karyawannya. Perusahaan kecil dengan potensi bahaya rendah dianjurkan tapi tidak wajib.'],
    ['q' => 'Apa perbedaan bendera emas dan perak SMK3?', 'a' => 'Bendera perak diberikan jika perusahaan mencapai skor audit 60-84% dari kriteria PP 50/2012 sesuai tingkatannya. Bendera emas diberikan jika mencapai 85-100%. Bendera emas adalah pencapaian tertinggi SMK3 di Indonesia dan menjadi keunggulan dalam tender pemerintah.'],
    ['q' => 'Seberapa sering audit SMK3 harus dilakukan?', 'a' => 'Audit SMK3 eksternal oleh auditor Kemnaker wajib dilakukan minimal sekali dalam 3 tahun. Namun perusahaan disarankan melakukan audit internal SMK3 minimal setahun sekali untuk memantau kesiapan sebelum audit eksternal.'],
    ['q' => 'Apakah SMK3 dan ISO 45001 bisa dijalankan bersamaan?', 'a' => 'Ya, dan ini praktik terbaik yang banyak diterapkan. PP 50/2012 (SMK3) memenuhi kewajiban hukum Indonesia, sedangkan ISO 45001 memberikan pengakuan internasional. Kedua sistem memiliki elemen yang saling melengkapi dan dapat diintegrasikan dalam satu sistem manajemen.'],
    ['q' => 'Apakah SMK3 diperlukan untuk tender pemerintah?', 'a' => 'Untuk tender konstruksi dan jasa yang melibatkan pekerjaan berisiko tinggi, memiliki sertifikat SMK3 (terutama bendera emas) menjadi nilai tambah signifikan dalam evaluasi teknis. Beberapa instansi secara eksplisit mensyaratkan SMK3 dalam dokumen RKS.'],
    ['q' => 'Berapa lama proses mendapatkan sertifikat SMK3?', 'a' => 'Tergantung kesiapan perusahaan. Jika sistem sudah berjalan, audit eksternal bisa dilakukan dalam 2-3 hari. Namun jika perusahaan baru mulai menerapkan SMK3 dari nol, proses implementasi membutuhkan 6-12 bulan sebelum siap diaudit.'],
];
?>
<?php
$page_title = 'SMK3 & ISO 45001: Pengertian, Penerapan, dan Sertifikasi';
$meta_desc = 'Panduan lengkap SMK3 (PP 50/2012) dan ISO 45001:2018. Pelatihan audit SMK3, konsultasi penerapan, dan sertifikasi resmi. Yogyakarta & seluruh Indonesia. Hubungi: 0812-2969-435.';
require __DIR__ . '/includes/head.php';
?>
<script type="application/ld+json">
{"@context":"https://schema.org","@type":"BreadcrumbList","itemListElement":[
  {"@type":"ListItem","position":1,"name":"Beranda","item":"https://wahanatotalita.com/"},
  {"@type":"ListItem","position":2,"name":"Pelatihan","item":"https://wahanatotalita.com/pelatihan/"},
  {"@type":"ListItem","position":3,"name":"SMK3","item":"https://wahanatotalita.com/smk3/"}
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
.num-list.compact li{padding:10px 14px 10px 42px;font-size:13px}
.principle-grid{display:flex;flex-direction:column;gap:12px}
.principle-card{background:#fff;border:1.5px solid #e5e7eb;border-radius:12px;padding:16px 18px;display:flex;gap:14px;align-items:flex-start}
.principle-num{flex-shrink:0;width:30px;height:30px;background:#0A4A2E;color:#fff;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:14px}
.principle-card h3{font-size:14.5px;font-weight:700;color:#111827;margin-bottom:4px}
.principle-card p{font-size:13px;color:#4b5563}
.service-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:14px}
@media(max-width:900px){.service-grid{grid-template-columns:1fr}}
.service-card{background:#fff;border:1.5px solid #e5e7eb;border-radius:14px;padding:20px}
.service-card h3{font-size:15px;font-weight:700;color:#0A4A2E;margin-bottom:8px}
.service-card p{font-size:13px;color:#4b5563}
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
    <div class="hero-badge">📋 SMK3 &amp; ISO 45001</div>
    <h1>SMK3 dan ISO 45001: Sistem Manajemen K3 yang Wajib Diterapkan Perusahaan</h1>
    <p class="hero-sub">Panduan lengkap penerapan SMK3 (PP 50/2012) dan ISO 45001:2018, lengkap dengan pelatihan dan pendampingan sertifikasi.</p>
    <div><a href="<?=$wa_url?>" class="btn-wa" target="_blank" rel="noopener">💬 Konsultasi Penerapan SMK3</a></div>
  </div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">Apa itu SMK3?</h2>
  <p class="intro-text">SMK3 (Sistem Manajemen Keselamatan dan Kesehatan Kerja) adalah sistem manajemen yang mengintegrasikan K3 ke dalam seluruh sistem manajemen perusahaan. Di Indonesia, SMK3 diatur oleh PP No. 50 Tahun 2012. Tujuannya: mencegah kecelakaan kerja, mengurangi penyakit akibat kerja, dan menciptakan tempat kerja yang aman, efisien, dan produktif. SMK3 bersifat wajib bagi perusahaan dengan 100+ karyawan atau tingkat potensi bahaya tinggi.</p>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">Dasar Hukum — PP No. 50 Tahun 2012</h2>
  <ul class="law-list">
    <li>Pasal 5: Perusahaan wajib menerapkan SMK3 jika memiliki ≥100 tenaga kerja ATAU memiliki tingkat potensi bahaya tinggi</li>
    <li>Perusahaan dengan &lt;100 karyawan dianjurkan (tidak wajib) menerapkan SMK3</li>
    <li>Audit SMK3 wajib dilakukan minimal 3 tahun sekali oleh auditor eksternal yang ditunjuk Kemnaker</li>
    <li>Hasil audit: sertifikat bendera emas (85-100%), bendera perak (60-84%)</li>
    <li>Pelanggaran: sanksi administratif berupa teguran tertulis hingga penghentian kegiatan</li>
  </ul>
</div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">SMK3 vs ISO 45001 — Apa Bedanya?</h2>
  <div class="compare-table-wrap">
  <table class="compare-table">
    <thead><tr><th>Aspek</th><th>SMK3 (PP 50/2012)</th><th>ISO 45001:2018</th></tr></thead>
    <tbody>
      <?php foreach ($compare as $row): ?>
      <tr><td><?= htmlspecialchars($row['aspek']) ?></td><td><?= htmlspecialchars($row['smk3']) ?></td><td><?= htmlspecialchars($row['iso']) ?></td></tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  </div>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">5 Prinsip Dasar SMK3</h2>
  <div class="principle-grid">
    <?php foreach ($prinsip as $i => $p): ?>
    <div class="principle-card">
      <span class="principle-num"><?= $i + 1 ?></span>
      <div><h3><?= htmlspecialchars($p['t']) ?></h3><p><?= htmlspecialchars($p['d']) ?></p></div>
    </div>
    <?php endforeach; ?>
  </div>
</div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">Cara Melakukan Audit SMK3</h2>
  <p class="intro-text">Audit SMK3 mengacu pada PP 50/2012 Lampiran II yang memuat kriteria audit dalam 12 elemen. Terdapat 3 tingkatan audit sesuai kesiapan perusahaan: tingkat awal (64 kriteria), tingkat transisi (122 kriteria), dan tingkat lanjutan (166 kriteria) — perusahaan dengan sistem yang sudah matang umumnya diaudit pada tingkat lanjutan. Ke-12 elemen tersebut adalah:</p>
  <ol class="num-list compact">
    <?php foreach ($elemenAudit as $e): ?>
    <li><?= htmlspecialchars($e) ?></li>
    <?php endforeach; ?>
  </ol>
  <p class="intro-text" style="margin-top:12px">Penilaian: setiap kriteria dinilai dengan skor 0 (tidak ada), 1 (sebagian), atau 2 (lengkap). Total skor ÷ skor maksimum × 100% = persentase pencapaian.</p>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">Siapa yang Wajib Ikut Pelatihan SMK3?</h2>
  <ul class="plain-list">
    <?php foreach ($wajibIkut as $w): ?>
    <li><?= htmlspecialchars($w) ?></li>
    <?php endforeach; ?>
  </ul>
</div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">Layanan SMK3 Wahana Totalita</h2>
  <div class="service-grid">
    <?php foreach ($layanan as $l): ?>
    <div class="service-card">
      <h3><?= htmlspecialchars($l['t']) ?></h3>
      <p><?= htmlspecialchars($l['d']) ?></p>
    </div>
    <?php endforeach; ?>
  </div>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">Program Pelatihan SMK3 &amp; ISO 45001 Kami</h2>
  <div class="scheme-grid">
    <?php foreach ($skemas as $sk): ?>
    <div class="scheme-card">
      <span class="scheme-cert"><?= htmlspecialchars($sk['cert']) ?></span>
      <h3><a href="/pelatihan/<?= htmlspecialchars($sk['slug']) ?>/"><?= htmlspecialchars($sk['name']) ?></a></h3>
      <a href="/pelatihan/<?= htmlspecialchars($sk['slug']) ?>/" class="scheme-link">Lihat Program &rarr;</a>
    </div>
    <?php endforeach; ?>
  </div>
</div>
</section>

<section class="white">
<div class="container">
  <h2 class="section-title">Program K3 Terkait</h2>
  <div class="link-grid">
    <?php foreach ($terkait as $tk): ?>
    <div class="link-card"><a href="<?= htmlspecialchars($tk['url']) ?>"><?= htmlspecialchars($tk['label']) ?> &rarr;</a></div>
    <?php endforeach; ?>
  </div>
</div>
</section>

<section>
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
    <p>Hubungi kami untuk konsultasi penerapan SMK3 atau pendaftaran pelatihan Audit SMK3 Internal.</p>
    <a href="<?=$wa_url?>" class="btn-wa" target="_blank" rel="noopener">💬 Konsultasi via WhatsApp</a>
  </div>
</section>

<?php
require_once __DIR__ . '/includes/hub-category-map.php';
$hub_article_cats = $HUB_CATEGORY_MAP['system-management']['article_cats'] ?? [];
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