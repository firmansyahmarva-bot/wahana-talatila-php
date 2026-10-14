<?php
// 1. Convert klien.php
$klienPhp = file_get_contents('klien.php');
// Extract content inside <main> or between navbar and footer
preg_match('/<!-- TOP NAV -->.*?(<section.*?)<\?php require __DIR__ \. \'\/includes\/footer\.php\'; \?>/s', $klienPhp, $mKlien);
$klienBody = $mKlien[1] ?? '';
// replace php tags
$klienBody = preg_replace('/<\?=\s*e\(\$wa_url\)\s*\?>/', 'https://wa.me/6287759151278?text=Halo%20Wahana%20Totalita%2C%20kami%20dari%20perusahaan%20ingin%20konsultasi%20program%20pelatihan%20K3%20%26%20proposal%20in-house%20training.', $klienBody);
$klienBody = preg_replace('/<\?=\s*e\(\$phone_disp\)\s*\?>/', '0877-5915-1278', $klienBody);
$klienBody = preg_replace('/<\?=\s*e\(\$wa_number\)\s*\?>/', '6287759151278', $klienBody);
$klienBody = preg_replace('/<\?=\s*\$year\s*\?>/', '2026', $klienBody);

$klienAstro = "---
import Layout from '../layouts/Layout.astro';

const pageTitle = 'Klien & Portofolio Perusahaan — 70+ BUMN & Multinasional';
const metaDesc = 'Daftar klien & rekam jejak Wahana Totalita Konsultan sejak 2008. Dipercaya lebih dari 70+ korporasi BUMN, Migas, Pertambangan, Perbankan, dan Manufaktur di seluruh Indonesia.';
const canonical = 'https://wahanatotalita.com/klien/';

const schemas = [
  {
    '@context': 'https://schema.org',
    '@type': 'BreadcrumbList',
    itemListElement: [
      { '@type': 'ListItem', position: 1, name: 'Beranda', item: 'https://wahanatotalita.com/' },
      { '@type': 'ListItem', position: 2, name: 'Klien & Portofolio', item: canonical },
    ],
  },
];
---

<Layout
  title={pageTitle}
  description={metaDesc}
  canonical={canonical}
  schemas={schemas}
  pageCss={['/assets/css/page/klien.css']}
>
  <main id=\"konten-utama\">
    $klienBody
  </main>
</Layout>
";
file_put_contents('src/pages/klien.astro', $klienAstro);
echo "Wrote src/pages/klien.astro\n";

// 2. Convert instruktur.php
$insPhp = file_get_contents('instruktur.php');
preg_match('/<\?php require __DIR__ \. \'\/includes\/navbar\.php\'; \?>(.*?)<\?php require __DIR__ \. \'\/includes\/footer\.php\'; \?>/s', $insPhp, $mIns);
$insBody = $mIns[1] ?? '';
$insBody = preg_replace('/<\?=\s*e\(\$wa_join_url\)\s*\?>/', 'https://wa.me/6287759151278?text=' . rawurlencode('Halo, saya ingin bergabung sebagai instruktur K3 di Wahana Totalita'), $insBody);
$insBody = preg_replace('/<\?=\s*\$year\s*\?>/', '2026', $insBody);

$insAstro = "---
import Layout from '../layouts/Layout.astro';

const pageTitle = 'Instruktur K3 Berpengalaman Yogyakarta';
const metaDesc = 'Wahana Totalita Konsultan didukung oleh instruktur K3 nasional dari Pusdiklat Migas Cepu, akademisi, dan praktisi industri berpengalaman lebih dari 15 tahun.';
const canonical = 'https://wahanatotalita.com/instruktur/';

const schemas = [
  {
    '@context': 'https://schema.org',
    '@type': 'BreadcrumbList',
    itemListElement: [
      { '@type': 'ListItem', position: 1, name: 'Beranda', item: 'https://wahanatotalita.com/' },
      { '@type': 'ListItem', position: 2, name: 'Instruktur K3', item: canonical },
    ],
  },
];
---

<Layout
  title={pageTitle}
  description={metaDesc}
  canonical={canonical}
  schemas={schemas}
  pageCss={['/assets/css/page/instruktur.css']}
>
  <main id=\"konten-utama\">
    $insBody
  </main>
</Layout>
";
file_put_contents('src/pages/instruktur.astro', $insAstro);
echo "Wrote src/pages/instruktur.astro\n";

// 3. Convert layanan-pemerintah.php
$b2gPhp = file_get_contents('layanan-pemerintah.php');
preg_match('/<\?php require __DIR__ \. \'\/includes\/navbar\.php\'; \?>(.*?)<\?php require __DIR__ \. \'\/includes\/footer\.php\'; \?>/s', $b2gPhp, $mB2g);
$b2gBody = $mB2g[1] ?? '';
$b2gBody = preg_replace('/<\?=\s*e\(\$wa_url\)\s*\?>/', 'https://wa.me/6287759151278?text=' . rawurlencode('Halo Wahana Totalita, kami dari instansi pemerintah/BUMN ingin konsultasi pengadaan pelatihan K3 dan permohonan RAB resmi. Mohon informasinya.'), $b2gBody);
$b2gBody = preg_replace('/<\?=\s*e\(\$wa_inhouse_url\)\s*\?>/', 'https://wa.me/6287759151278?text=' . rawurlencode('Halo Wahana Totalita, kami ingin mengajukan penawaran In-House Training K3 untuk instansi kami. Mohon kirimkan company profile dan proposal.'), $b2gBody);
$b2gBody = preg_replace('/<\?=\s*\$year\s*\?>/', '2026', $b2gBody);
$b2gBody = preg_replace('/<\?=\s*e\(\$phone_disp\)\s*\?>/', '0877-5915-1278', $b2gBody);

$b2gAstro = "---
import Layout from '../layouts/Layout.astro';

const pageTitle = 'Vendor Pelatihan K3 Pemerintah & BUMN — Pengadaan Resmi LPSE';
const metaDesc = 'Vendor pelatihan K3 resmi Kemnaker RI & BNSP untuk pengadaan instansi pemerintah, BUMN, kementerian, dan dinas. Siap SPK pengadaan langsung, LPSE, dan RAB 24 jam.';
const canonical = 'https://wahanatotalita.com/layanan-pemerintah/';

const schemas = [
  {
    '@context': 'https://schema.org',
    '@type': 'ProfessionalService',
    '@id': 'https://wahanatotalita.com/layanan-pemerintah#service',
    name: 'Vendor Pelatihan K3 & Pengadaan B2G Wahana Totalita Konsultan',
    alternateName: 'Penyedia Jasa Pelatihan K3 Instansi Pemerintah & BUMN',
    serviceType: 'Vendor Pelatihan K3, In-House Safety Training, & Sertifikasi Resmi',
    provider: {
      '@type': 'EducationalOrganization',
      name: 'Wahana Totalita Konsultan',
      url: 'https://wahanatotalita.com',
      telephone: '+6287759151278',
      email: 'info@wahanatotalita.com',
    },
    areaServed: { '@type': 'Country', name: 'Indonesia' },
  },
  {
    '@context': 'https://schema.org',
    '@type': 'BreadcrumbList',
    itemListElement: [
      { '@type': 'ListItem', position: 1, name: 'Beranda', item: 'https://wahanatotalita.com/' },
      { '@type': 'ListItem', position: 2, name: 'Layanan Pemerintah & BUMN', item: canonical },
    ],
  },
];
---

<Layout
  title={pageTitle}
  description={metaDesc}
  canonical={canonical}
  schemas={schemas}
  pageCss={['/assets/css/page/layanan-pemerintah.css']}
>
  $b2gBody
</Layout>
";
file_put_contents('src/pages/layanan-pemerintah.astro', $b2gAstro);
echo "Wrote src/pages/layanan-pemerintah.astro\n";
