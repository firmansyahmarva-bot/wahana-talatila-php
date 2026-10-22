/**
 * Cloudflare Pages Redirect & 410 Rules
 *
 * HOW TO ADD A NEW REDIRECT:
 * - For an exact path redirect: add a key-value pair to EXACT_REDIRECTS below.
 *   Example: '/old-path/': '/new-path/',
 *   Both slash and no-slash lookups are supported automatically.
 * - For a 410 Gone pattern: add a substring to JUNK_PATTERNS.
 * - For a regex rule: add an entry to REGEX_RULES.
 */

// ---------------------------------------------------------------------------
// 1. Silent Junk & Bot Scanner Patterns -> 410 Gone (origin: 404.php Section 1)
// ---------------------------------------------------------------------------
export const JUNK_PATTERNS = [
  "/.env",
  "/wp-admin",
  "/wp-login",
  "/wp-content",
  "/wp-includes",
  "/wp-json",
  "/wp-sitemap",
  "/phpmyadmin",
  "/cgi-bin",
  "/.git",
  "/xmlrpc.php",
  "/.aws",
  "/vendor/",
  "/.ssh",
  "/.htpasswd",
  "/.htaccess",
  "/config.php",
  "/.well-known",
  "/actuator",
  "/telescope",
  "/database/sync_run",
  "/admin]",
  "/login",
  "/crossdomain.xml",
  "/404error_test",
  "/security.txt",
  "/cgi-sys",
  "/cdn-cgi",
  "apple-touch-icon",
  "favicon",
  "/siemens",
  "/simatic",
  "/sinamics",
  "/sirius",
  "/sitop",
  "/et200",
  "/et-200",
  "/plc",
  "/hmi",
  "/drives",
  "/automation",
  "/manufacturer",
  "/brands",
  "/brand",
  "/products",
  "/product",
  "/shop",
  "/catalog",
  "/stock",
  "/surplus",
  "/obsolete",
  "/industrial-automation",
  "/factory-automation",
  "/leadership",
  "/team",
  "/staff",
  "/about",
  "/people",
  "/contact",
  "/inquiry",
  "/feed/",
  "/feed",
  "/ads.txt",
  "/store-google-analytics-client-id",
  "/recruitment.btn.co.id",
  "/www.holcim.co.id",
  "/ib.bri.co.id",
  "https://wahanatotalita.com",
  "/assets/uploads/",
  "/jadwal/daftar/",
  "/sitemap-wahana",
  "/sitemap_index.xml"
];

// ---------------------------------------------------------------------------
// 2. Joomla Legacy Article ID Redirects (origin: .htaccess lines 28-52)
// ---------------------------------------------------------------------------
export const JOOMLA_RULES = [
  {
    "id": "5",
    "target": "/perusahaan/"
  },
  {
    "id": "8",
    "target": "/klien/"
  },
  {
    "id": "9",
    "target": "/instruktur/"
  },
  {
    "id": "10",
    "target": "/jadwal/"
  },
  {
    "id": "13",
    "target": "/k3-migas/"
  }
];

// ---------------------------------------------------------------------------
// 3. Exact Path 301 Redirects (origin: .htaccess legacy 301s, 404.php exacts, training_redirects.json)
// ---------------------------------------------------------------------------
export const EXACT_REDIRECTS = {
  // --- Legacy .htaccess specific URLs ---
  "/news/dasar-hukum-keselamatan-dan-kesehatan-kerja.html": "/artikel/dasar-hukum-keselamatan-dan-kesehatan-kerja/",
  "/news/pentingnya-k3-di-tempat-kerja.html": "/artikel/pentingnya-k3-di-tempat-kerja/",
  "/profil/tentang-kami.html": "/perusahaan/",
  "/sertifikasi.html": "/pelatihan/",
  "/partner.html": "/perusahaan/",
  "/video.html": "/",
  "/jadwal-pelatihan": "/jadwal/",
  "/jadwal-pelatihan/": "/jadwal/",
  "/layanan": "/pelatihan/",
  "/layanan/": "/pelatihan/",
  "/in-house-training": "/in-house-training/",
  "/in-house": "/in-house-training/",
  "/in-house/": "/in-house-training/",
  "/tools/index.php": "/tools/",

  // --- 404.php Section 2 & 8 Exact Match URLs ---
  "/kontak": "/perusahaan/",
  "/kontak/": "/perusahaan/",
  "/pelatihan-ahli-k3-umum": "/ahli-k3-umum/",
  "/pelatihan-ahli-k3-umum/": "/ahli-k3-umum/",
  "/pelatihan-k3": "/pelatihan/",
  "/pelatihan-k3/": "/pelatihan/",
  "/refreshing-k3": "/perpanjangan-skp/",
  "/refreshing-k3/": "/perpanjangan-skp/",
  "/artikel/investigasi-kecelakaan-kerja-metode-langkah": "/artikel/metode-investigasi-kecelakaan-kerja-root-cause-analysis-scat/",
  "/artikel/investigasi-kecelakaan-kerja-metode-langkah/": "/artikel/metode-investigasi-kecelakaan-kerja-root-cause-analysis-scat/",
  "/pelatihan/operator-rigger": "/artikel/pelatihan-rigger-juru-ikat-beban/",
  "/pelatihan/operator-rigger/": "/artikel/pelatihan-rigger-juru-ikat-beban/",
  "/pelatihan/operator-alat-berat": "/operator-alat-berat/",
  "/pelatihan/operator-alat-berat/": "/operator-alat-berat/",
  "/pelatihan/supervisor-k3-konstruksi": "/k3-konstruksi/",
  "/pelatihan/supervisor-k3-konstruksi/": "/k3-konstruksi/",
  "/pelatihan/operator-motor-diesel-genset": "/pelatihan/pelatihan-k3-operator-motor-diesel-genset-sertifikasi-kemnaker-ri/",
  "/pelatihan/operator-motor-diesel-genset/": "/pelatihan/pelatihan-k3-operator-motor-diesel-genset-sertifikasi-kemnaker-ri/",
  "/pelatihan/petugas-pemadam-kebakaran-kelas-d": "/pelatihan/pelatihan-petugas-peran-kebakaran-kelas-d-kemnaker-ri/",
  "/pelatihan/petugas-pemadam-kebakaran-kelas-d/": "/pelatihan/pelatihan-petugas-peran-kebakaran-kelas-d-kemnaker-ri/",
  "/pelatihan/operator-boiler-kelas-2": "/pelatihan/pelatihan-k3-operator-boiler-kelas-2-sertifikasi-kemnaker-ri/",
  "/pelatihan/operator-boiler-kelas-2/": "/pelatihan/pelatihan-k3-operator-boiler-kelas-2-sertifikasi-kemnaker-ri/",
  "/pelatihan/pelatihan-tkbt-tingkat-2-kemnaker-ri": "/pelatihan/pelatihan-tkbt-ii-sertifikasi-kemnaker-ri/",
  "/pelatihan/pelatihan-tkbt-tingkat-2-kemnaker-ri/": "/pelatihan/pelatihan-tkbt-ii-sertifikasi-kemnaker-ri/",
  "/pelatihan/pelatihan-tkpk-tingkat-1-kemnaker-ri": "/k3-ketinggian/",
  "/pelatihan/pelatihan-tkpk-tingkat-1-kemnaker-ri/": "/k3-ketinggian/",
  "/event-orgniser": "/event-organizer/",
  "/klient": "/klien/",
  "/tools/seafty-talk": "/tools/safety-talk/",
  "/artikel/gaji-ahli-k3-umum-di-indonesia/": "/artikel/ahli-k3-umum-ak3u-syarat-tugas-sertifikasi/",
  "/artikel/pelatihan-pengelolaan-lingkungan-hidup-ukl-upl-proper/": "/artikel/pelatihan-pengelolaan-lingkungan-hidup-untuk-perusahaan-ukl-upl-dan-proper/",
  "/pelatihan/pengawas-k3-listrik": "/pelatihan/pelatihan-ahli-k3-listrik-sertifikasi-bnsp/",
  "/pelatihan/ahli-k3-penanggulangan-kebakaran-kelas-a/": "/pelatihan/pelatihan-ahli-k3-penanggulangan-keb-kelas-a-sertifikasi-kemnaker-ri/",
  "/pelatihan/amdal-penyusun": "/pelatihan/pelatihan-teknis-pertek-limbah-b3-dan-emisi-udara-sertifikasi-bnsp/",
  "/pelatihan/ahli-k3-umum": "/pelatihan/pelatihan-ahli-k3-umum-sertifikasi-kemnaker-ri/",
  "/pelatihan/hazops/": "/pelatihan/pelatihan-hazard-dan-operability-studies-hazops-sertifikasi-bnsp/",
  "/pelatihan/operator-forklift": "/pelatihan/pelatihan-k3-operator-forklift-kelas-2-sertifikasi-kemnaker-ri/",
  "/pelatihan/ahli-k3-penanggulangan-kebakaran-kelas-a-tangerang.html": "/pelatihan/pelatihan-ahli-k3-penanggulangan-keb-kelas-a-sertifikasi-kemnaker-ri/",
  "/pelatihan/ahli-k3-listrik-bnsp/": "/pelatihan/pelatihan-ahli-k3-listrik-sertifikasi-bnsp/",
  "/pelatihan/regu-penanggulangan-kebakaran-kelas-c/": "/pelatihan/pelatihan-regu-penanggulangan-kebakaran-kelas-c-sertifikasi-kemnaker-ri/",
  "/pelatihan/tkbt-ii-banggai.html": "/pelatihan/pelatihan-tkbt-ii-sertifikasi-kemnaker-ri/",
  "/pelatihan/ahli-k3-umum-sumbawa.html": "/pelatihan/pelatihan-ahli-k3-umum-sertifikasi-kemnaker-ri/",
  "/pelatihan/ahli-k3-konstruksi": "/pelatihan/ahli-k3-konstruksi-sertifikasi-bnsp/",
  "/pelatihan/auditor-internal-k3": "/pelatihan/pelatihan-auditor-sistem-manajemen-k3-sertifikasi-bnsp/",
  "/pelatihan/pelatihan-ahli-k3-listrik": "/pelatihan/pelatihan-ahli-k3-listrik-sertifikasi-kemnaker-ri/",
  "/pelatihan-dan-sertifikasi-pengoperasian-alat-gali-muat-excavator-back-hoe-sertifikasi-bnsp": "/pelatihan/pelatihan-dan-sertifikasi-pengoperasian-alat-gali-muat-excavator-back-hoe-sertifikasi-bnsp/",
  "/pelatihan/penyusun-amdal": "/pelatihan/pelatihan-teknis-pertek-limbah-b3-dan-emisi-udara-sertifikasi-bnsp/",
  "/pelatihan-catalog": "/pelatihan/",
  "/pelatihan-kategori": "/pelatihan/",
  "/pelnanggulangan-kebakaran": "/pelatihan/k3/",
  "/kota/jakarta": "/pelatihan-k3-jakarta/",
  "/outbond": "/pelatihan/",
  "/galeri/index": "/galeri/",
  "/dafter": "/jadwal/",
  "/jadwal/daftar/83/": "/jadwal/",
  "/jadwal/daftar/79/": "/jadwal/",
  "/jadwal/daftar/39/": "/jadwal/",
  "/jadwal/daftar/37/": "/jadwal/",
  "/pelatihan/operator-scaffolding/": "/pelatihan/pelatihan-k3-operator-scaffolding-sertifikasi-kemnaker-ri/",
  "/pelatihan/operator-welder-kelas-1/": "/pelatihan/pelatihan-k3-operator-welder-kelas-1-sertifikasi-kemnaker-ri/",
  "/pelatihan/ahli-higiene-industri-muda/": "/pelatihan/pelatihan-ahli-higiene-industri-muda-sertifikasi-bnsp/",
  "/pelatihan/teknisi-ruang-terbatas/": "/pelatihan/pelatihan-teknisi-ruang-terbatas-sertifikasi-bnsp/",
  "/pelatihan/ahli-utama-ruang-terbatas-binjai/": "/pelatihan/pelatihan-ahli-utama-ruang-terbatas-sertifikasi-bnsp/",
  "/pelatihan/petugas-peran-kebakaran-kelas-d-kudus/": "/pelatihan/pelatihan-petugas-peran-kebakaran-kelas-d-kemnaker-ri/",
  "/pelatihan/pelatihan-petugas-peran-kebakaran-kelas-d/": "/pelatihan/pelatihan-petugas-peran-kebakaran-kelas-d-kemnaker-ri/",
  "/pelatihan/pelatihan-petugas-p3k-kemnaker-ri/": "/pelatihan/pelatihan-petugas-p3k-sertifikasi-kemnaker-ri/",
  "/pelatihan/operator-forklift-kelas-2/": "/pelatihan/pelatihan-k3-operator-forklift-kelas-2-sertifikasi-kemnaker-ri/",
  "/pelatihan/ahli-muda-lingkungan-kerja/": "/pelatihan/pelatihan-ahli-muda-lingkungan-kerja-sertifikasi-kemnaker-ri/",
  "/pelatihan/penanganan-bahaya-gas-h2s/": "/pelatihan/pelatihan-penanganan-bahaya-gas-h2s-sertifikasi-bnsp/",
  "/pelatihan/penanganan-bahaya-gas-h2s-maros.html": "/pelatihan/pelatihan-penanganan-bahaya-gas-h2s-sertifikasi-bnsp/",
  "/pelatihan/penyusun-amdal/": "/pelatihan/pelatihan-teknis-pertek-limbah-b3-dan-emisi-udara-sertifikasi-bnsp/",
  "/pelatihan/operator-motor-diesel-genset-mojokerto/": "/pelatihan/pelatihan-k3-operator-motor-diesel-genset-sertifikasi-kemnaker-ri/",
  "/pelatihan/operator-crane-kelas-3/": "/pelatihan/pelatihan-k3-operator-crane-kelas-3-sertifikasi-kemnaker-ri/",
  "/artikel/pelatihan-pengelolaan-lingkungan-hidup-ukl-upl-proper": "/artikel/pelatihan-pengelolaan-lingkungan-hidup-untuk-perusahaan-ukl-upl-dan-proper/",
  "/pelatihan/pelatihan-operator-pesawat-tenaga-produksi-ptp/%20s": "/pelatihan/pelatihan-operator-pesawat-tenaga-produksi-ptp/",
  "/pelatihan/pelatihan-operator-pesawat-tenaga-produksi-ptp%20%20show": "/pelatihan/pelatihan-operator-pesawat-tenaga-produksi-ptp/",
  "/forum/": "/",
  "/forum": "/",

  // --- 404.php $__legacyCourseMap ---
  "/pelatihan/pelatihan-auditor-smk3-kemnaker-ri-online": "/pelatihan/pelatihan-auditor-sistem-manajemen-k3-sertifikasi-kemnaker-ri/",
  "/pelatihan/pelatihan-k3-listrik-teknisi-kemnaker-ri": "/pelatihan/pelatihan-k3-teknisi-listrik-sertifikasi-kemnaker-ri/",
  "/pelatihan/pelatihan-k3-bekerja-di-ketinggian-tkbt-tkpk-kemnaker": "/pelatihan/pelatihan-tkbt-ii-sertifikasi-kemnaker-ri/",
  "/pelatihan/pelatihan-k3-ruang-terbatas-confined-space-kemnaker": "/pelatihan/pelatihan-teknisi-ruang-terbatas-sertifikasi-bnsp/",
  "/pelatihan/pelatihan-k3-pesawat-uap-bejana-tekan-kemnaker": "/pelatihan/pelatihan-k3-operator-boiler-kelas-2-sertifikasi-kemnaker-ri/",
  "/pelatihan/pelatihan-pengawas-operasional-pertama-pop-minerba-bnsp": "/pelatihan/pelatihan-pop-pertambangan-sertifikasi-bnsp-online/",
  "/pelatihan/pelatihan-pengawas-operasional-madya-pom-minerba-bnsp": "/pelatihan/pelatihan-pom-pertambangan-sertifikasi-bnsp-online/",
  "/pelatihan/pelatihan-penanggung-jawab-operasional-pengolahan-air-limbah-popal-bnsp": "/pelatihan/pelatihan-penanggung-jawab-operasional-pengolahan-air-limbah-popal-sertifikasi-bnsp/",
  "/pelatihan/pelatihan-pengelolaan-limbah-b3-plb3-bnsp": "/pelatihan/pelatihan-pemantauan-pengelolaan-limbah-bahan-berbahaya-dan-beracun-level-pengawas-pplb3-sertifikasi-bnsp/",
  "/pelatihan/pelatihan-penanggung-jawab-pengendalian-pencemaran-udara-poppua-bnsp": "/pelatihan/pelatihan-penanggung-jawab-pengendalian-pencemaran-udara-pppu-sertifikasi-bnsp/",
  "/pelatihan/pelatihan-internal-auditor-iso-9001-14001-45001-qhse-online": "/pelatihan/pelatihan-qhse-awareness-terintegrasi-iso-online/",
  "/pelatihan/pelatihan-higiene-industri-muda-himu-bnsp": "/pelatihan/pelatihan-ahli-higiene-industri-muda-sertifikasi-bnsp/",

  // --- data/training_redirects.json (old_slug -> target_slug) ---
  "/pelatihan/pelatihan-teknis-pertek-limbah-b3-dan-emisi-udara-sertifikasi-bnsp-1": "/pelatihan/pelatihan-teknis-pertek-limbah-b3-dan-emisi-udara-sertifikasi-bnsp/",
  "/pelatihan/pelatihan-teknis-pertek-limbah-b3-dan-emisi-udara-sertifikasi-bnsp-1/": "/pelatihan/pelatihan-teknis-pertek-limbah-b3-dan-emisi-udara-sertifikasi-bnsp/",
  "/pelatihan/pelatihan-penanggung-jawab-operasional-pengolahan-air-limbah-popal-sertifikasi-bnsp-1": "/pelatihan/pelatihan-penanggung-jawab-operasional-pengolahan-air-limbah-popal-sertifikasi-bnsp/",
  "/pelatihan/pelatihan-penanggung-jawab-operasional-pengolahan-air-limbah-popal-sertifikasi-bnsp-1/": "/pelatihan/pelatihan-penanggung-jawab-operasional-pengolahan-air-limbah-popal-sertifikasi-bnsp/",
  "/pelatihan/pelatihan-pengambilan-contoh-uji-air-pcua-sertifikasi-bnsp-1": "/pelatihan/pelatihan-pengambilan-contoh-uji-air-pcua-sertifikasi-bnsp/",
  "/pelatihan/pelatihan-pengambilan-contoh-uji-air-pcua-sertifikasi-bnsp-1/": "/pelatihan/pelatihan-pengambilan-contoh-uji-air-pcua-sertifikasi-bnsp/",
  "/pelatihan/pelatihan-operator-pengumpulan-limbah-b3-jenjang-kualifikasi-3-level-pelaksana-oplb3-sertifikasi-bnsp-1": "/pelatihan/pelatihan-operator-pengumpulan-limbah-b3-jenjang-kualifikasi-3-level-pelaksana-oplb3-sertifikasi-bnsp/",
  "/pelatihan/pelatihan-operator-pengumpulan-limbah-b3-jenjang-kualifikasi-3-level-pelaksana-oplb3-sertifikasi-bnsp-1/": "/pelatihan/pelatihan-operator-pengumpulan-limbah-b3-jenjang-kualifikasi-3-level-pelaksana-oplb3-sertifikasi-bnsp/",
  "/pelatihan/pelatihan-penanggung-jawab-operasional-instalasi-pengendalian-pencemaran-udara-poippu-sertifikasi-bnsp-1": "/pelatihan/pelatihan-penanggung-jawab-operasional-instalasi-pengendalian-pencemaran-udara-poippu-sertifikasi-bnsp/",
  "/pelatihan/pelatihan-penanggung-jawab-operasional-instalasi-pengendalian-pencemaran-udara-poippu-sertifikasi-bnsp-1/": "/pelatihan/pelatihan-penanggung-jawab-operasional-instalasi-pengendalian-pencemaran-udara-poippu-sertifikasi-bnsp/",
  "/pelatihan/pelatihan-pemantauan-pengelolaan-limbah-bahan-berbahaya-dan-beracun-level-pengawas-pplb3-sertifikasi-bnsp-1": "/pelatihan/pelatihan-pemantauan-pengelolaan-limbah-bahan-berbahaya-dan-beracun-level-pengawas-pplb3-sertifikasi-bnsp/",
  "/pelatihan/pelatihan-pemantauan-pengelolaan-limbah-bahan-berbahaya-dan-beracun-level-pengawas-pplb3-sertifikasi-bnsp-1/": "/pelatihan/pelatihan-pemantauan-pengelolaan-limbah-bahan-berbahaya-dan-beracun-level-pengawas-pplb3-sertifikasi-bnsp/",
  "/pelatihan/pelatihan-penanggung-jawab-pengendalian-pencemaran-air-pppa-sertifikasi-bnsp-1": "/pelatihan/pelatihan-penanggung-jawab-pengendalian-pencemaran-air-pppa-sertifikasi-bnsp/",
  "/pelatihan/pelatihan-penanggung-jawab-pengendalian-pencemaran-air-pppa-sertifikasi-bnsp-1/": "/pelatihan/pelatihan-penanggung-jawab-pengendalian-pencemaran-air-pppa-sertifikasi-bnsp/",
  "/pelatihan/pelatihan-penanggung-jawab-pengendalian-pencemaran-udara-pppu-sertifikasi-bnsp-1": "/pelatihan/pelatihan-penanggung-jawab-pengendalian-pencemaran-udara-pppu-sertifikasi-bnsp/",
  "/pelatihan/pelatihan-penanggung-jawab-pengendalian-pencemaran-udara-pppu-sertifikasi-bnsp-1/": "/pelatihan/pelatihan-penanggung-jawab-pengendalian-pencemaran-udara-pppu-sertifikasi-bnsp/",
  "/pelatihan/pelatihan-manajer-pengolahan-limbah-b3-jenjang-kualifikasi-6-level-pengawas-mplb3-sertifikasi-bnsp-1": "/pelatihan/pelatihan-manajer-pengolahan-limbah-b3-jenjang-kualifikasi-6-level-pengawas-mplb3-sertifikasi-bnsp/",
  "/pelatihan/pelatihan-manajer-pengolahan-limbah-b3-jenjang-kualifikasi-6-level-pengawas-mplb3-sertifikasi-bnsp-1/": "/pelatihan/pelatihan-manajer-pengolahan-limbah-b3-jenjang-kualifikasi-6-level-pengawas-mplb3-sertifikasi-bnsp/",
  "/pelatihan/pelatihan-pengumpulan-limbah-b3-jenjang-kualifikasi-6-level-pengawas-mplb3-sertifikasi-bnsp-1": "/pelatihan/pelatihan-manajer-pengolahan-limbah-b3-jenjang-kualifikasi-6-level-pengawas-mplb3-sertifikasi-bnsp/",
  "/pelatihan/pelatihan-pengumpulan-limbah-b3-jenjang-kualifikasi-6-level-pengawas-mplb3-sertifikasi-bnsp-1/": "/pelatihan/pelatihan-manajer-pengolahan-limbah-b3-jenjang-kualifikasi-6-level-pengawas-mplb3-sertifikasi-bnsp/",
  "/pelatihan/pelatihan-ahli-k3-umum-sertifikasi-bnsp": "/pelatihan/pelatihan-ahli-k3-umum-sertifikasi-bnsp-online/",
  "/pelatihan/pelatihan-ahli-k3-umum-sertifikasi-bnsp/": "/pelatihan/pelatihan-ahli-k3-umum-sertifikasi-bnsp-online/",
  "/pelatihan/pelatihan-ahli-k3-umum-kemnaker-offline": "/pelatihan/pelatihan-ahli-k3-umum-sertifikasi-kemnaker-ri/",
  "/pelatihan/pelatihan-ahli-k3-umum-kemnaker-offline/": "/pelatihan/pelatihan-ahli-k3-umum-sertifikasi-kemnaker-ri/",
  "/pelatihan/pelatihan-unit-p-keb-kelas-c-sertifikasi-kemnaker-ri": "/pelatihan/pelatihan-koordinator-unit-p-keb-kelas-b-sertifikasi-kemnaker-ri/",
  "/pelatihan/pelatihan-unit-p-keb-kelas-c-sertifikasi-kemnaker-ri/": "/pelatihan/pelatihan-koordinator-unit-p-keb-kelas-b-sertifikasi-kemnaker-ri/",
  "/pelatihan/pelatihan-pppa-online": "/pelatihan/pelatihan-penanggung-jawab-pengendalian-pencemaran-air-pppa-sertifikasi-bnsp/",
  "/pelatihan/pelatihan-pppa-online/": "/pelatihan/pelatihan-penanggung-jawab-pengendalian-pencemaran-air-pppa-sertifikasi-bnsp/",
  "/pelatihan/pelatihan-oplb3-online": "/pelatihan/pelatihan-pengambilan-contoh-uji-air-pcua-sertifikasi-bnsp/",
  "/pelatihan/pelatihan-oplb3-online/": "/pelatihan/pelatihan-pengambilan-contoh-uji-air-pcua-sertifikasi-bnsp/",
  "/pelatihan/pelatihan-hazops-online": "/pelatihan/pelatihan-hazard-dan-operability-studies-hazops-sertifikasi-bnsp/",
  "/pelatihan/pelatihan-hazops-online/": "/pelatihan/pelatihan-hazard-dan-operability-studies-hazops-sertifikasi-bnsp/",
  "/pelatihan/pelatihan-higiene-industri-madya-hima-online": "/pelatihan/pelatihan-ahli-higiene-industri-madya-sertifikasi-bnsp/",
  "/pelatihan/pelatihan-higiene-industri-madya-hima-online/": "/pelatihan/pelatihan-ahli-higiene-industri-madya-sertifikasi-bnsp/",
  "/pelatihan/pelatihan-ahli-k3-listrik-online": "/pelatihan/pelatihan-ahli-k3-listrik-sertifikasi-bnsp/",
  "/pelatihan/pelatihan-ahli-k3-listrik-online/": "/pelatihan/pelatihan-ahli-k3-listrik-sertifikasi-bnsp/",
  "/pelatihan/pelatihan-popal-penanggung-jawab-pengendalian-pencemaran-air-limbah": "/pelatihan/pelatihan-penanggung-jawab-operasional-pengolahan-air-limbah-popal-sertifikasi-bnsp/",
  "/pelatihan/pelatihan-popal-penanggung-jawab-pengendalian-pencemaran-air-limbah/": "/pelatihan/pelatihan-penanggung-jawab-operasional-pengolahan-air-limbah-popal-sertifikasi-bnsp/",
  "/pelatihan/pelatihan-pppu-online": "/pelatihan/pelatihan-penanggung-jawab-pengendalian-pencemaran-udara-pppu-sertifikasi-bnsp/",
  "/pelatihan/pelatihan-pppu-online/": "/pelatihan/pelatihan-penanggung-jawab-pengendalian-pencemaran-udara-pppu-sertifikasi-bnsp/",
  "/pelatihan/pelatihan-poippu-online": "/pelatihan/pelatihan-penanggung-jawab-operasional-instalasi-pengendalian-pencemaran-udara-poippu-sertifikasi-bnsp/",
  "/pelatihan/pelatihan-poippu-online/": "/pelatihan/pelatihan-penanggung-jawab-operasional-instalasi-pengendalian-pencemaran-udara-poippu-sertifikasi-bnsp/",
  "/pelatihan/pelatihan-pcua-online": "/pelatihan/pelatihan-pengambilan-contoh-uji-air-pcua-sertifikasi-bnsp/",
  "/pelatihan/pelatihan-pcua-online/": "/pelatihan/pelatihan-pengambilan-contoh-uji-air-pcua-sertifikasi-bnsp/",
  "/pelatihan/pelatihan-pertek-limbah-b3-online": "/pelatihan/pelatihan-teknis-pertek-limbah-b3-dan-emisi-udara-sertifikasi-bnsp/",
  "/pelatihan/pelatihan-pertek-limbah-b3-online/": "/pelatihan/pelatihan-teknis-pertek-limbah-b3-dan-emisi-udara-sertifikasi-bnsp/",
  "/pelatihan/pelatihan-authorized-gas-tester-sertifikasi-bnsp": "/pelatihan/pelatihan-authorized-gas-tester-agt-online/",
  "/pelatihan/pelatihan-authorized-gas-tester-sertifikasi-bnsp/": "/pelatihan/pelatihan-authorized-gas-tester-agt-online/",
  "/pelatihan/pelatihanpelatihan-authorized-gas-tester-agt-online": "/pelatihan/pelatihan-authorized-gas-tester-agt-online/",
  "/pelatihan/pelatihanpelatihan-authorized-gas-tester-agt-online/": "/pelatihan/pelatihan-authorized-gas-tester-agt-online/",
};

// ---------------------------------------------------------------------------
// 4. Substring City & Course Redirects (origin: 404.php Section 8b)
// ---------------------------------------------------------------------------
export const SUBSTRING_REDIRECTS = [
  {
    "substring": "operator-crane-kelas-3",
    "target": "/pelatihan/pelatihan-k3-operator-crane-kelas-3-sertifikasi-kemnaker-ri/"
  },
  {
    "substring": "operator-scaffolding-palangka-raya",
    "target": "/pelatihan/pelatihan-k3-operator-scaffolding-sertifikasi-kemnaker-ri/"
  },
  {
    "substring": "tkbt-ii-paser",
    "target": "/pelatihan/pelatihan-tkbt-ii-sertifikasi-kemnaker-ri/"
  },
  {
    "substring": "tkbt-ii-maros",
    "target": "/pelatihan/pelatihan-tkbt-ii-sertifikasi-kemnaker-ri/"
  },
  {
    "substring": "ahli-muda-lingkungan-kerja-morowali",
    "target": "/pelatihan/pelatihan-ahli-muda-lingkungan-kerja-sertifikasi-kemnaker-ri/"
  },
  {
    "substring": "regu-penanggulangan-kebakaran-kelas-c-bojonegoro",
    "target": "/pelatihan/pelatihan-regu-penanggulangan-kebakaran-kelas-c-sertifikasi-kemnaker-ri/"
  },
  {
    "substring": "ahli-utama-ruang-terbatas-gorontalo",
    "target": "/pelatihan/pelatihan-ahli-utama-ruang-terbatas-sertifikasi-bnsp/"
  },
  {
    "substring": "operator-conveyor",
    "target": "/pelatihan/"
  }
];

// ---------------------------------------------------------------------------
// 5. Pattern / Regex Rules (origin: .htaccess WP, news, tools, sitemaps, permutations)
// ---------------------------------------------------------------------------
export const REGEX_RULES = [
  // Old split sitemaps -> /sitemap.xml
  {
    regex: /^(sitemap-core|sitemap-pelatihan|sitemap-artikel|sitemap-kota|sitemap-platform|sitemap-glosarium|sitemap-regulasi|sitemap-skkni|sitemap-riksa-uji|sitemap-perpanjangan-skp|sitemap-purnabakti|sitemap-event|sitemap-kota-pelatihan)\.xml$/i,
    target: '/sitemap.xml',
    status: 301
  },
  // WordPress legacy paths -> /
  {
    regex: /^wp-(admin|content|includes|login|config|load|json|cron|signup|mail|trackback|comments)(\/.*|\.php.*)?$/i,
    target: '/',
    status: 301
  },
  // Legacy media paths
  { regex: /^foto(\/.*)?$/i, target: '/', status: 301 },
  { regex: /^info(\/.*)?$/i, target: '/perusahaan/', status: 301 },
  // Legacy /news/ paths -> 410 Gone (excluding specific exact matches handled above)
  { regex: /^news(\/.*)?$/i, status: 410 },
  // /k3 and /k3/* -> /pelatihan/k3/
  { regex: /^k3(\/.*)?$/i, target: '/pelatihan/k3/', status: 301 },
  // /in-house/* -> /in-house-training/*
  { regex: /^in-house\/([a-z0-9\-]+)\/?$/i, target: (m) => `/in-house-training/${m[1]}/`, status: 301 },
  // /tools/*.php -> /tools/*/
  { regex: /^tools\/([a-z0-9\-]+)\.php$/i, target: (m) => `/tools/${m[1]}/`, status: 301 },
  // /tools/* no-slash -> /tools/*/
  { regex: /^tools\/([a-z0-9\-]+)$/i, target: (m) => `/tools/${m[1]}/`, status: 301 },
  // /pelatihan-k3-{city} no-slash -> /pelatihan-k3-{city}/
  { regex: /^pelatihan-k3-([a-z0-9\-]+)$/i, target: (m) => `/pelatihan-k3-${m[1]}/`, status: 301 },
  // Forklift permutations & aliases
  {
    regex: /^pelatihan\/(operator-forklift|sio-forklift)(-kelas-[0-9a-z]+)?(-[a-z0-9\-]+)?(\.(html|php))?\/?$/i,
    target: '/pelatihan/pelatihan-k3-operator-forklift-kelas-2-sertifikasi-kemnaker-ri/',
    status: 301
  },
  // Ahli K3 Umum permutations & city aliases
  {
    regex: /^pelatihan\/ahli-k3-umum(-[a-z0-9\-]+)?(\.(html|php))?\/?$/i,
    target: '/pelatihan/ak3-bnsp/',
    status: 301
  }
];

// ---------------------------------------------------------------------------
// 6. Keyword-Matched Slugs (origin: 404.php Section 10)
// ---------------------------------------------------------------------------
export const KEYWORD_REDIRECTS = [
  { pattern: /(^|[-_/])smk3([-_/]|$)/i, target: '/smk3/' },
  { pattern: /(^|[-_/])bnsp([-_/]|$)/i, target: '/sertifikasi-bnsp/' },
  { pattern: /(^|[-_/])iso([-_/]|$)/i, target: '/pelatihan-iso/' },
  { pattern: /(^|[-_/])k3([-_/]|$)/i, target: '/pelatihan/k3/' }
];
