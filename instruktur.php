<?php
require_once __DIR__ . '/config.php';
$s = get_all_settings();
/**
 * instruktur.php
 * Instructor/trust page. Zero DB dependency, modeled on sertifikasi-bnsp.php.
 *
 * Roster: 14 real named instructors recovered from a 2012 Wayback Machine
 * snapshot of the old site, cleared for publication by Berro. Names/credentials
 * are stated neutrally with no living/deceased status implied either way,
 * per instruction. Remaining 6 slots are generic certified-instructor profiles
 * (no invented names).
 */
$wa_number = '6287759151278';
$wa_join = rawurlencode('Halo, saya ingin bergabung sebagai instruktur K3 di Wahana Totalita');
$wa_join_url = "https://wa.me/{$wa_number}?text={$wa_join}";
$year = date('Y');

$instruktur = [
    ['name' => 'Baldric Siregar', 'cred' => 'Dr., MBA., Ak.', 'spec' => 'Manajemen & Audit K3'],
    ['name' => 'Hari Purnomo', 'cred' => 'Dr. Ir., MT', 'spec' => 'Teknik Industri & Ergonomi'],
    ['name' => 'Viktor Malau', 'cred' => 'Dr. Ir., DEA', 'spec' => 'K3 Industri & Lingkungan'],
    ['name' => 'M. Kusumawan Herliansyah', 'cred' => 'Dr., ST., MT.', 'spec' => 'Teknik Mesin & Keselamatan'],
    ['name' => 'Arman Hakim Nasution', 'cred' => 'Ir., M.Eng', 'spec' => 'Manajemen Risiko Industri'],
    ['name' => 'Rini Dharmastiti', 'cred' => 'Ir., MSc, PhD', 'spec' => 'Ergonomi & Keselamatan Kerja'],
    ['name' => 'R.I. Triyanto', 'cred' => 'Capt., M.Mar', 'spec' => 'Keselamatan Maritim & IATA'],
    ['name' => 'H. Zaenal M. Sofro', 'cred' => 'M.D., AIFM', 'spec' => 'Kesehatan Kerja & Kedokteran Olahraga'],
    ['name' => 'Marlin Maryudi', 'cred' => 'Praktisi K3 Bersertifikat', 'spec' => 'Pusdiklat Migas Cepu'],
    ['name' => 'Putut Prasetyo', 'cred' => 'Praktisi K3 Bersertifikat', 'spec' => 'Pusdiklat Migas Cepu'],
    ['name' => 'Suwoyo', 'cred' => 'ST', 'spec' => 'Pusdiklat Migas Cepu'],
    ['name' => 'Slamet Riyadi', 'cred' => 'ST., MEng', 'spec' => 'Pusdiklat Migas Cepu'],
    ['name' => 'Sutrisno', 'cred' => 'Praktisi K3 Bersertifikat', 'spec' => 'Pusdiklat Migas Cepu'],
    ['name' => 'Bambang Setyo', 'cred' => 'Praktisi K3 Bersertifikat', 'spec' => 'Pusdiklat Migas Cepu'],
];

$genericSlots = [
    'Ahli K3 Umum & SMK3', 'K3 Konstruksi & Bekerja di Ketinggian',
    'Auditor Sistem Manajemen K3', 'ISO 45001 / 14001 / 9001',
    'K3 Kimia & Bahan Berbahaya', 'Investigasi Kecelakaan Kerja',
];
foreach ($genericSlots as $sp) {
    $instruktur[] = ['name' => 'Instruktur K3 Nasional', 'cred' => 'Tersertifikasi Kemnaker RI / BNSP', 'spec' => $sp];
}
?>
<?php
$page_title = 'Instruktur K3 Berpengalaman Yogyakarta';
$meta_desc = 'Wahana Totalita Konsultan didukung oleh instruktur K3 nasional dari Pusdiklat Migas Cepu, akademisi, dan praktisi industri berpengalaman lebih dari 15 tahun.';
$page_css = array_merge($page_css ?? [], ['instruktur']);
require __DIR__ . '/includes/head.php';
?>
<script type="application/ld+json">
<?= json_encode([
  '@context' => 'https://schema.org',
  '@type'    => 'ItemList',
  'name'     => 'Daftar Instruktur dan Tenaga Ahli K3 Wahana Totalita',
  'itemListElement' => array_map(function($ins, $i) {
      $p = [
          '@type'    => 'Person',
          'name'     => $ins['name'],
          'jobTitle' => 'Instruktur ' . $ins['spec'],
          'worksFor' => [
              '@type' => 'Organization',
              '@id'   => SITE_URL . '/#organization',
              'name'  => 'Wahana Totalita Konsultan',
          ],
          'knowsAbout' => $ins['spec'],
      ];
      if (!empty($ins['cred'])) {
          $p['hasCredential'] = [
              '@type'              => 'EducationalOccupationalCredential',
              'name'               => $ins['cred'],
              'credentialCategory' => 'Gelar Akademik / Sertifikasi Profesi',
          ];
      }
      return [
          '@type'    => 'ListItem',
          'position' => $i + 1,
          'item'     => $p,
      ];
  }, array_slice($instruktur, 0, 14), array_keys(array_slice($instruktur, 0, 14)))
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) ?>
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ProfessionalService",
  "@id": "<?= SITE_URL ?>/#organization",
  "name": "Wahana Totalita Konsultan",
  "telephone": "+6287759151278",
  "url": "<?= SITE_URL ?>/instruktur/",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Jl. Wonosari KM 8.5",
    "addressLocality": "Sleman",
    "addressRegion": "DIY",
    "addressCountry": "ID"
  }
}
</script>
<?php require __DIR__ . '/includes/navbar.php'; ?>
<section class="hero">
  <div class="container inner">
    <div class="hero-badge">🎓 Tenaga Ahli Kami</div>
    <h1>Instruktur &amp; Tenaga Ahli Kami</h1>
    <p class="hero-sub">Kualitas pelatihan K3 kami didukung oleh instruktur berpengalaman lintas industri di seluruh Indonesia.</p>
  </div>
</section>

<section class="white">
<div class="container">
  <p class="intro-text">Kualitas pelatihan K3 kami didukung oleh instruktur yang tidak hanya memiliki sertifikasi resmi, tetapi juga pengalaman lapangan nyata di industri migas, pertambangan, konstruksi, dan manufaktur Indonesia. Kami telah bekerja sama dengan instruktur-instruktur berikut dalam menyelenggarakan program pelatihan K3 kami.</p>
</div>
</section>

<section>
<div class="container">
  <h2 class="section-title">Instruktur &amp; Tenaga Ahli</h2>
  <p class="section-subtitle">Praktisi bersertifikat dari berbagai bidang spesialisasi K3</p>
  <div class="instruktur-grid">
    <?php foreach ($instruktur as $i): ?>
    <div class="instruktur-card">
      <h3><?= htmlspecialchars($i['name']) ?></h3>
      <span class="instruktur-cred"><?= htmlspecialchars($i['cred']) ?></span>
      <p><?= htmlspecialchars($i['spec']) ?></p>
    </div>
    <?php endforeach; ?>
  </div>
</div>
</section>

<section class="white">
<div class="container-sm">
  <h2 class="section-title">Kualifikasi Instruktur Kami</h2>
  <ul class="qual-list">
    <li>Tersertifikasi Kemnaker RI / BNSP</li>
    <li>Pengalaman industri minimum 10 tahun</li>
    <li>Latar belakang akademik S1–S3</li>
    <li>Aktif sebagai pengawas ketenagakerjaan / praktisi lapangan</li>
  </ul>
</div>
</section>

<section class="final-cta">
  <div class="container-sm">
    <h2>Bergabung sebagai Instruktur</h2>
    <p>Anda praktisi K3 bersertifikat dengan pengalaman industri yang ingin berbagi keahlian? Kami terbuka untuk kolaborasi dengan instruktur berkualitas di seluruh Indonesia.</p>
    <a href="<?=$wa_join_url?>" class="btn-wa" target="_blank" rel="noopener">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a6.47 6.47 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
      Gabung sebagai Instruktur
    </a>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
</body>
</html>
