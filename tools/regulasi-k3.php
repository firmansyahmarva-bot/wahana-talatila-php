<?php
require_once __DIR__ . '/../config.php';
$s = get_all_settings();

$page_title = 'Database Regulasi K3 Indonesia Terlengkap 2026: UU, PP, Permenaker & Sanksi Hukum';
$meta_desc = 'Kumpulan peraturan perundang-undangan K3 terlengkap di Indonesia: UU No 1/1970, PP 50/2012, Permenaker, Kepmenaker. Dilengkapi ringkasan pasal krusial dan sanksi hukum.';

ob_start();
require __DIR__ . '/../includes/head.php';
$shared_head = ob_get_clean();
$shared_head = preg_replace('~<title>.*?</title>~s', '<title>' . e($page_title) . '</title>', $shared_head, 1);
echo $shared_head;

// Master database of Indonesian K3 regulations
$regulasi = [
  [
    "id" => "uu-1-1970",
    "cat" => "uu",
    "nomor" => "Undang-Undang No. 1 Tahun 1970",
    "judul" => "Tentang Keselamatan Kerja",
    "status" => "Berlaku Penuh",
    "ringkasan" => "Payung hukum dasar keselamatan kerja di Indonesia yang mewajibkan setiap tempat kerja dengan sumber bahaya untuk menerapkan syarat-syarat keselamatan kerja bagi tenaga kerja dan orang lain di tempat kerja.",
    "pasal" => "Pasal 3 (Syarat-syarat K3), Pasal 8 (Pemeriksaan Kesehatan Berkala), Pasal 9 (Kewajiban Pembinaan K3), Pasal 10 (Pembentukan P2K3 di Perusahaan).",
    "sanksi" => "Pidana kurungan selama-lamanya 3 bulan atau denda setinggi-tingginya Rp 100.000,- (dijunctokan dengan sanksi UU Ketenagakerjaan & UU Cipta Kerja)."
  ],
  [
    "id" => "pp-50-2012",
    "cat" => "uu",
    "nomor" => "Peraturan Pemerintah No. 50 Tahun 2012",
    "judul" => "Penerapan Sistem Manajemen Keselamatan dan Kesehatan Kerja (SMK3)",
    "status" => "Berlaku Penuh",
    "ringkasan" => "Wajib bagi perusahaan yang mempekerjakan tenaga kerja minimal 100 orang ATAU memiliki tingkat potensi bahaya tinggi. Mengatur 5 prinsip dasar SMK3 dan 166 kriteria audit SMK3.",
    "pasal" => "Pasal 5 (Kewajiban Penerapan SMK3), Lampiran I (Pedoman Penerapan 5 Prinsip SMK3), Lampiran II (Pedoman Penilaian Audit SMK3).",
    "sanksi" => "Sanksi administratif berupa teguran, peringatan tertulis, pembatasan kegiatan usaha, pembekuan izin, hingga penghentian sementara operasional."
  ],
  [
    "id" => "permen-5-2018",
    "cat" => "lingkungan",
    "nomor" => "Permenaker No. 5 Tahun 2018",
    "judul" => "K3 Lingkungan Kerja",
    "status" => "Berlaku Penuh",
    "ringkasan" => "Standar Nilai Ambang Batas (NAB) faktor fisika (kebisingan 85 dBA, getaran, pencahayaan, iklim kerja panas), faktor kimia, faktor biologi, faktor ergonomi, dan faktor psikologi kerja, serta standar fasilitas sanitasi dan higiene.",
    "pasal" => "Pasal 5 - 24 (NAB Faktor Lingkungan Kerja), Pasal 25 - 44 (Penerapan Higiene & Sanitasi), Pasal 59 (Personel K3 Lingkungan Kerja).",
    "sanksi" => "Peringatan tertulis, rekomendasi perbaikan teknis dari Pengawas Ketenagakerjaan, hingga sanksi pidana ketenagakerjaan."
  ],
  [
    "id" => "permen-9-2016",
    "cat" => "mekanik",
    "nomor" => "Permenaker No. 9 Tahun 2016",
    "judul" => "K3 Bekerja Pada Ketinggian",
    "status" => "Berlaku Penuh",
    "ringkasan" => "Mengatur kewajiban perlindungan jatuh untuk pekerjaan di atas perbedaan ketinggian vertikal minimal 1.8 meter. Mengatur Tenaga Kerja Bangunan Tinggi (TKBT I & II) dan Tenaga Kerja Pada Ketinggian (TKPK I, II & III).",
    "pasal" => "Pasal 2 (Ruang Lingkup Ketinggian), Pasal 3 (Perencanaan & Penilaian Risiko), Pasal 11 - 25 (Perangkat Penahan Jatuh & Scaffolding).",
    "sanksi" => "Penghentian langsung pekerjaan di lapangan jika ditemukan bekerja di ketinggian tanpa APD penahan jatuh (Full Body Harness) atau perancah ilegal."
  ],
  [
    "id" => "permen-8-2020",
    "cat" => "mekanik",
    "nomor" => "Permenaker No. 8 Tahun 2020",
    "judul" => "K3 Pesawat Angkat dan Pesawat Angkut (PAPA)",
    "status" => "Berlaku Penuh (Menggantikan Permenaker 05/1985 & 09/2010)",
    "ringkasan" => "Ketentuan kelayakan teknik, riksa uji berkala, Surat Izin Layak Operasi (SILO), dan Surat Izin Operator (SIO) untuk crane, forklift, overhead crane, elevator, konveyor, dan alat berat angkat angkut lainnya.",
    "pasal" => "Pasal 5 - 34 (Syarat Teknis Rancang Bangun), Pasal 140 (Kewajiban Operator Bersertifikat SIO), Pasal 176 (Pemeriksaan & Pengujian Berkala).",
    "sanksi" => "Penyegelan dan pelarangan operasi alat berat di lokasi kerja jika tidak memiliki surat izin pengesahan pemakaian (SILO) aktif."
  ],
  [
    "id" => "permen-8-2010",
    "cat" => "lingkungan",
    "nomor" => "Permenaker No. 08/MEN/VII/2010",
    "judul" => "Alat Pelindung Diri (APD)",
    "status" => "Berlaku Penuh",
    "ringkasan" => "Mewajibkan pengusaha menyediakan APD secara CUMA-CUMA (gratis) kepada seluruh pekerja dan tamu. APD wajib memenuhi Standar Nasional Indonesia (SNI) atau standar internasional yang diakui.",
    "pasal" => "Pasal 2 (Kewajiban Pengusaha Menyediakan APD Gratis), Pasal 6 (Pemberitahuan & Pelatihan Pemakaian APD), Pasal 7 (Pemasangan Rambu APD Wajib).",
    "sanksi" => "Pekerja berhak menolak bekerja bila pengusaha gagal menyediakan APD yang layak sesuai potensi bahaya."
  ],
  [
    "id" => "permen-12-2015",
    "cat" => "listrik",
    "nomor" => "Permenaker No. 12 Tahun 2015",
    "judul" => "K3 Listrik di Tempat Kerja",
    "status" => "Berlaku Penuh",
    "ringkasan" => "Pemberlakuan Standar Persyaratan Umum Instalasi Listrik (PUIL 2011/2020), kewajiban Ahli K3 Spesialis Listrik dan Teknisi K3 Listrik untuk instalasi dengan daya di atas 200 kVA.",
    "pasal" => "Pasal 2 (Penerapan PUIL), Pasal 7 (Kualifikasi Personel Teknisi & Ahli K3 Listrik), Pasal 11 (Pemeriksaan dan Pengujian Instalasi Listrik Berkala).",
    "sanksi" => "Pemutusan aliran listrik oleh instansi berwenang bila instalasi dinilai berbahaya memicu sengatan arus atau kebakaran fatal."
  ],
  [
    "id" => "kepmen-186-1999",
    "cat" => "listrik",
    "nomor" => "Kepmenaker No. KEP.186/MEN/1999",
    "judul" => "Unit Penanggulangan Kebakaran di Tempat Kerja",
    "status" => "Berlaku Penuh",
    "ringkasan" => "Ketentuan pembentukan Tim Tanggap Darurat Kebakaran perusahaan yang terdiri dari Petugas Peran Kebakaran (Kelas D), Regu Kebakaran (Kelas C), Koordinator Kebakaran (Kelas B), dan Ahli K3 Spesialis Kebakaran (Kelas A).",
    "pasal" => "Pasal 2 (Kewajiban Mencegah Kebakaran), Pasal 5 - 8 (Rasio Jumlah Petugas per Jumlah Karyawan & Klasifikasi Bahaya Kebakaran).",
    "sanksi" => "Teguran administratif dan catatan merah ketidakpatuhan dalam audit sertifikasi SMK3 PP 50/2012."
  ],
  [
    "id" => "permen-4-1980",
    "cat" => "listrik",
    "nomor" => "Permenaker No. 04/MEN/1980",
    "judul" => "Syarat-Syarat Pemasangan dan Pemeliharaan APAR",
    "status" => "Berlaku Penuh",
    "ringkasan" => "Mengatur penempatan tabung APAR: tinggi penempatan maksimal 1.2 meter dari lantai, jarak antar APAR maksimal 15 meter, inspeksi fisik berkala 6 bulan sekali, dan pengetesan hidrostatik.",
    "pasal" => "Pasal 4 (Tinggi Penempatan APAR), Pasal 8 (Pemberian Tanda Rambu APAR Segitiga), Pasal 11 - 18 (Pemeriksaan 6 Bulanan & Pengujian Tabung).",
    "sanksi" => "Penyitaan atau larangan pemakaian tabung berkarat/kadaluarsa oleh pengawas K3 spesialis kebakaran."
  ],
  [
    "id" => "permen-15-2008",
    "cat" => "lingkungan",
    "nomor" => "Permenaker No. 15/MEN/VIII/2008",
    "judul" => "Pertolongan Pertama Pada Kecelakaan (P3K) di Tempat Kerja",
    "status" => "Berlaku Penuh",
    "ringkasan" => "Mengatur kewajiban penyediaan kotak P3K tipe A, B, atau C sesuai jumlah pekerja, ruang P3K, serta rasio Petugas P3K tersertifikasi Kemnaker RI.",
    "pasal" => "Pasal 3 (Kewajiban Pengusaha Menyediakan Petugas & Fasilitas P3K), Pasal 5 (Rasio Petugas P3K), Lampiran II (Daftar Isi Standar Kotak P3K).",
    "sanksi" => "Peringatan tertulis dan kewajiban melengkapi fasilitas obat-obatan darurat seketika."
  ],
  [
    "id" => "kepmen-187-1999",
    "cat" => "kimia",
    "nomor" => "Kepmenaker No. KEP.187/MEN/1999",
    "judul" => "Pengendalian Bahan Kimia Berbahaya (B3) di Tempat Kerja",
    "status" => "Berlaku Penuh",
    "ringkasan" => "Kewajiban penetapan potensi bahaya kimia (Kategori Bahaya Besar / Menengah), penyediaan Lembar Data Keselamatan Bahan (LDKB / SDS) dan label, serta penunjukan Petugas & Ahli K3 Kimia.",
    "pasal" => "Pasal 3 (Kewajiban SDS & Label), Pasal 16 (Penunjukan Petugas K3 Kimia), Pasal 17 (Penunjukan Ahli K3 Kimia).",
    "sanksi" => "Penghentian izin penyimpanan atau operasional B3 ilegal yang membahayakan lingkungan dan masyarakat sekitar."
  ],
  [
    "id" => "kepdirjen-113-2006",
    "cat" => "kimia",
    "nomor" => "Kepdirjen Binwasnaker No. KEP.113/DJPPK/IX/2006",
    "judul" => "Pedoman Teknis K3 Bekerja di Ruang Terbatas (Confined Space)",
    "status" => "Berlaku Penuh",
    "ringkasan" => "Prosedur keselamatan bekerja di dalam tangki, bejana, silo, saluran pipa bawah tanah, dan manhole: pengujian kadar gas atmosfer, ventilasi mekanis kontinu, dan penunjukan Petugas Madya / Utama Confined Space.",
    "pasal" => "Bagian II (Kriteria Ruang Terbatas Wajib Izin Masuk), Bagian IV (Sistem Izin Kerja PTW), Bagian VI (Kualifikasi Kompetensi Personel).",
    "sanksi" => "Penyegelan akses masuk tangki dan tindakan hukum jika terjadi insiden asfiksia fatal di ruang terbatas."
  ],
  [
    "id" => "permen-4-1987",
    "cat" => "uu",
    "nomor" => "Permenaker No. 04/MEN/1987",
    "judul" => "Panitia Pembina Keselamatan dan Kesehatan Kerja (P2K3)",
    "status" => "Berlaku Penuh",
    "ringkasan" => "Tata cara pembentukan P2K3 di perusahaan: ketua dijabat oleh pimpinan puncak (manajer/direktur) dan sekretaris wajib dijabat oleh Ahli K3 Umum yang memiliki Surat Keputusan Penunjukan (SKP) dari Menaker RI.",
    "pasal" => "Pasal 2 (Kewajiban Pembentukan P2K3), Pasal 3 (Susunan Pengurus Organisasi), Pasal 12 (Kewajiban Laporan Triwulan ke Disnaker).",
    "sanksi" => "Denda pidana ketenagakerjaan dan penolakan izin operasional perusahaan oleh dinas tenaga kerja."
  ],
  [
    "id" => "permen-2-1992",
    "cat" => "uu",
    "nomor" => "Permenaker No. 02/MEN/1992",
    "judul" => "Tata Cara Penunjukan Kewajiban dan Wewenang Ahli Keselamatan dan Kesehatan Kerja",
    "status" => "Berlaku Penuh",
    "ringkasan" => "Prosedur penunjukan, hak, dan kewajiban Ahli K3 Umum di tempat kerja: memiliki hak memasuki area kerja, melakukan inspeksi, dan mengusulkan penghentian pekerjaan yang membahayakan.",
    "pasal" => "Pasal 2 - 4 (Persyaratan Calon Ahli K3), Pasal 9 (Kewajiban Ahli K3), Pasal 10 (Hak & Wewenang Menghentikan Pekerjaan Berbahaya).",
    "sanksi" => "Pencabutan Surat Keputusan Penunjukan (SKP) dan lisensi Ahli K3 jika terbukti melalaikan tugas pengawasan K3."
  ]
];
?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    { "@type": "ListItem", "position": 1, "name": "Beranda", "item": "https://wahanatotalita.com/" },
    { "@type": "ListItem", "position": 2, "name": "Tools K3", "item": "https://wahanatotalita.com/tools/" },
    { "@type": "ListItem", "position": 3, "name": "Database Regulasi K3", "item": "https://wahanatotalita.com/tools/regulasi-k3.php" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "CollectionPage",
  "name": "Database Regulasi K3 Indonesia Terlengkap",
  "url": "https://wahanatotalita.com/tools/regulasi-k3.php",
  "description": "Kompilasi peraturan keselamatan dan kesehatan kerja (UU No 1/1970, PP 50/2012, Permenaker, Kepmenaker) beserta ringkasan pasal krusial dan sanksi pidana.",
  "inLanguage": "id-ID"
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "Apa dasar hukum tertinggi K3 di Indonesia?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Dasar hukum tertinggi dan payung hukum utama keselamatan kerja di Indonesia adalah Undang-Undang No. 1 Tahun 1970 tentang Keselamatan Kerja, yang kemudian diatur pelaksanaannya melalui Peraturan Pemerintah No. 50 Tahun 2012 tentang Penerapan SMK3 serta berbagai Peraturan Menteri Ketenagakerjaan (Permenaker)."
      }
    },
    {
      "@type": "Question",
      "name": "Perusahaan seperti apa yang wajib menerapkan SMK3 PP 50/2012?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Berdasarkan Pasal 5 PP 50 Tahun 2012, perusahaan yang wajib menerapkan Sistem Manajemen K3 (SMK3) adalah: (1) Perusahaan yang mempekerjakan pekerja/buruh paling sedikit 100 (seratus) orang; ATAU (2) Perusahaan yang mempunyai tingkat potensi bahaya tinggi (seperti sektor pertambangan, minyak dan gas, kimia, konstruksi, manufaktur berisiko tinggi) meskipun pekerjanya kurang dari 100 orang."
      }
    },
    {
      "@type": "Question",
      "name": "Apa syarat legalitas pembentukan P2K3 di perusahaan?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Sesuai Permenaker No. 04/MEN/1987, susunan organisasi Panitia Pembina Keselamatan dan Kesehatan Kerja (P2K3) harus terdiri dari unsur pengusaha dan pekerja, di mana Ketua P2K3 dijabat oleh Pimpinan Perusahaan dan Sekretaris P2K3 wajib dijabat oleh Ahli K3 Umum yang memiliki SKP resmi aktif dari Kementerian Ketenagakerjaan RI, lalu disahkan oleh Dinas Tenaga Kerja setempat."
      }
    }
  ]
}
</script>

<style>
:root {
  --navy-dark: #071524;
  --navy: #0D233A;
  --navy-light: #183654;
  --orange: #E8611A;
  --orange-hover: #cf5213;
  --orange-light: #fff2ea;
  --slate-50: #F8FAFC;
  --slate-100: #F1F5F9;
  --slate-200: #E2E8F0;
  --slate-300: #CBD5E1;
  --slate-600: #475569;
  --slate-700: #334155;
  --slate-900: #0F172A;
  --radius-md: 12px;
  --radius-lg: 16px;
  --shadow-sm: 0 2px 8px rgba(13,35,58,0.06);
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
body {
  font-family: 'Source Sans 3', system-ui, -apple-system, sans-serif;
  background: var(--slate-50);
  color: var(--slate-900);
  line-height: 1.6;
}
.container { max-width: 1200px; margin: 0 auto; padding: 0 24px; }

/* HERO */
.reg-hero {
  background: linear-gradient(135deg, #071524 0%, #0D233A 60%, #183654 100%);
  color: #fff;
  padding: 58px 0 44px;
  position: relative;
  overflow: hidden;
  border-bottom: 3px solid var(--orange);
}
.reg-hero::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image: linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
  background-size: 36px 36px;
  pointer-events: none;
}
.hero-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: rgba(232, 97, 26, 0.18);
  border: 1px solid rgba(232, 97, 26, 0.4);
  padding: 6px 14px;
  border-radius: 999px;
  color: #FFA573;
  font-size: 0.8rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  margin-bottom: 14px;
}
.reg-hero h1 {
  font-family: 'Lexend', sans-serif;
  font-size: clamp(1.8rem, 3.6vw, 2.7rem);
  font-weight: 800;
  line-height: 1.2;
  margin-bottom: 12px;
}
.reg-hero h1 span { color: var(--orange); }
.reg-hero p {
  color: #CBD5E1;
  font-size: 1.05rem;
  max-width: 760px;
  margin-bottom: 20px;
}
.hero-tags { display: flex; flex-wrap: wrap; gap: 8px; }
.hero-tag {
  background: rgba(255,255,255,0.08);
  border: 1px solid rgba(255,255,255,0.12);
  padding: 4px 12px;
  border-radius: 6px;
  font-size: 0.82rem;
  color: #E2E8F0;
}

/* WORKSPACE LAYOUT */
.reg-wrapper { padding: 40px 0 60px; }

/* SEARCH & FILTER BAR */
.filter-card {
  background: #fff;
  border: 1px solid var(--slate-200);
  border-radius: var(--radius-lg);
  padding: 24px;
  box-shadow: var(--shadow-sm);
  margin-bottom: 30px;
}
.search-input-box {
  position: relative;
  margin-bottom: 16px;
}
.search-icon {
  position: absolute;
  left: 14px;
  top: 50%;
  transform: translateY(-50%);
  color: var(--slate-600);
}
.reg-search-input {
  width: 100%;
  padding: 12px 14px 12px 44px;
  border: 2px solid var(--slate-200);
  border-radius: var(--radius-md);
  font-size: 0.96rem;
  color: var(--slate-900);
  transition: all 0.2s;
}
.reg-search-input:focus {
  outline: none;
  border-color: var(--orange);
  box-shadow: 0 0 0 3px rgba(232,97,26,0.12);
}

.category-pills {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
}
.cat-btn {
  background: var(--slate-100);
  border: 1px solid var(--slate-200);
  padding: 8px 16px;
  border-radius: 999px;
  font-size: 0.84rem;
  font-weight: 600;
  color: var(--slate-700);
  cursor: pointer;
  transition: all 0.2s;
}
.cat-btn:hover, .cat-btn.active {
  background: var(--navy);
  border-color: var(--navy);
  color: #fff;
}

/* REGULATION CARDS GRID */
.reg-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
  gap: 24px;
  margin-bottom: 40px;
}
@media (max-width: 600px) {
  .reg-grid { grid-template-columns: 1fr; }
}

.reg-card {
  background: #fff;
  border: 1px solid var(--slate-200);
  border-radius: var(--radius-lg);
  padding: 24px;
  box-shadow: var(--shadow-sm);
  display: flex;
  flex-direction: column;
  transition: transform 0.2s, box-shadow 0.2s;
}
.reg-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 10px 24px rgba(13,35,58,0.08);
}
.reg-badge-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 12px;
}
.badge-status {
  background: #DCFCE7;
  color: #166534;
  padding: 3px 8px;
  border-radius: 4px;
  font-size: 0.72rem;
  font-weight: 700;
}
.reg-num {
  font-family: 'Lexend', sans-serif;
  font-size: 1.12rem;
  font-weight: 800;
  color: var(--navy);
  margin-bottom: 4px;
}
.reg-sub {
  font-size: 0.88rem;
  font-weight: 600;
  color: var(--orange);
  margin-bottom: 12px;
}
.reg-desc {
  font-size: 0.86rem;
  color: var(--slate-700);
  line-height: 1.6;
  margin-bottom: 16px;
  flex-grow: 1;
}
.reg-meta-box {
  background: var(--slate-50);
  border: 1px solid var(--slate-200);
  border-radius: 8px;
  padding: 12px;
  font-size: 0.8rem;
  color: var(--slate-600);
  line-height: 1.5;
  margin-top: auto;
}
.reg-meta-box strong { color: var(--navy); }

/* EDITORIAL ARTICLE */
.editorial-box {
  background: #fff;
  border: 1px solid var(--slate-200);
  border-radius: var(--radius-lg);
  padding: 36px;
  margin-bottom: 32px;
}
.editorial-title {
  font-family: 'Lexend', sans-serif;
  font-size: 1.45rem;
  font-weight: 800;
  color: var(--navy);
  margin-bottom: 16px;
  border-left: 4px solid var(--orange);
  padding-left: 14px;
}
.editorial-p {
  color: var(--slate-700);
  font-size: 0.96rem;
  line-height: 1.7;
  margin-bottom: 16px;
}

/* FAQ */
.faq-item {
  border: 1px solid var(--slate-200);
  border-radius: var(--radius-md);
  margin-bottom: 12px;
  overflow: hidden;
  background: #fff;
}
.faq-q {
  width: 100%;
  padding: 16px 20px;
  text-align: left;
  background: #fff;
  border: none;
  font-family: 'Lexend', sans-serif;
  font-size: 0.98rem;
  font-weight: 700;
  color: var(--navy);
  cursor: pointer;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.faq-q:hover { background: var(--slate-50); }
.faq-a {
  padding: 0 20px 18px;
  color: var(--slate-700);
  font-size: 0.92rem;
  line-height: 1.65;
  display: none;
}
.faq-item.active .faq-a { display: block; }
.faq-item.active .faq-icon { transform: rotate(180deg); }
.faq-icon { transition: transform 0.2s; }
</style>

<?php require __DIR__ . '/../includes/navbar.php'; ?>

<main class="reg-page" id="konten-utama">

<!-- HERO -->
<section class="reg-hero">
  <div class="container">
    <div class="hero-badge">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
      Kumpulan Regulasi K3 Resmi Kemnaker RI
    </div>
    <h1>Database Regulasi K3 <span>Indonesia 2026</span></h1>
    <p>Database hukum keselamatan dan kesehatan kerja terlengkap di Indonesia. Akses undang-undang, peraturan pemerintah, dan permenaker resmi disertai ringkasan pasal krusial, syarat pemenuhan kepatuhan, serta sanksi pidana.</p>
    <div class="hero-tags">
      <span class="hero-tag">UU No. 1 Tahun 1970</span>
      <span class="hero-tag">PP No. 50 Tahun 2012 (SMK3)</span>
      <span class="hero-tag">Permenaker Faktor Lingkungan Kerja</span>
      <span class="hero-tag">Sanksi Hukum &amp; Pidana Ketenagakerjaan</span>
    </div>
  </div>
</section>

<!-- MAIN REGULATION REPOSITORY -->
<section class="reg-wrapper">
  <div class="container">
    
    <!-- SEARCH & FILTER -->
    <div class="filter-card">
      <div class="search-input-box">
        <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <input type="text" id="regSearch" class="reg-search-input" placeholder="Cari regulasi berdasarkan kata kunci (contoh: genset, scaffolding, apar, kebisingan, p2k3, listrik)..." oninput="filterRegulations()">
      </div>

      <div class="category-pills">
        <button class="cat-btn active" type="button" onclick="setCategory('all', this)">Semua Regulasi (<?php echo count($regulasi); ?>)</button>
        <button class="cat-btn" type="button" onclick="setCategory('uu', this)">Undang-Undang &amp; PP</button>
        <button class="cat-btn" type="button" onclick="setCategory('mekanik', this)">Mekanik &amp; Ketinggian</button>
        <button class="cat-btn" type="button" onclick="setCategory('lingkungan', this)">Lingkungan, APD &amp; P3K</button>
        <button class="cat-btn" type="button" onclick="setCategory('listrik', this)">Listrik &amp; Kebakaran</button>
        <button class="cat-btn" type="button" onclick="setCategory('kimia', this)">Kimia &amp; Ruang Terbatas</button>
      </div>
    </div>

    <!-- SERVER-RENDERED REGULATION CARDS (INDEXABLE BY GOOGLE) -->
    <div class="reg-grid" id="regCardGrid">
      <?php foreach ($regulasi as $r): ?>
      <div class="reg-card" data-cat="<?php echo e($r['cat']); ?>" data-text="<?php echo strtolower(e($r['nomor'] . ' ' . $r['judul'] . ' ' . $r['ringkasan'] . ' ' . $r['pasal'])); ?>">
        <div class="reg-badge-row">
          <span style="font-size:0.75rem;font-weight:700;color:var(--slate-600);text-transform:uppercase"><?php echo strtoupper(e($r['cat'])); ?></span>
          <span class="badge-status"><?php echo e($r['status']); ?></span>
        </div>
        <h3 class="reg-num"><?php echo e($r['nomor']); ?></h3>
        <div class="reg-sub"><?php echo e($r['judul']); ?></div>
        <p class="reg-desc"><?php echo e($r['ringkasan']); ?></p>
        <div class="reg-meta-box">
          <div style="margin-bottom:6px"><strong>Pasal Krusial:</strong> <?php echo e($r['pasal']); ?></div>
          <div><strong>Sanksi Pelanggaran:</strong> <span style="color:#991B1B"><?php echo e($r['sanksi']); ?></span></div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- IN-DEPTH EDITORIAL ARTICLE (SEO DEPTH) -->
    <div class="editorial-box">
      <h2 class="editorial-title">Hierarki Peraturan Perundang-undangan K3 di Indonesia</h2>
      <p class="editorial-p">
        Sistem hukum Keselamatan dan Kesehatan Kerja (K3) di Indonesia berakar pada konstitusi Pasal 27 ayat (2) UUD 1945 yang menjamin setiap warga negara berhak atas pekerjaan dan penghidupan yang layak bagi kemanusiaan. Penjaminan keselamatan raga dan jiwa pekerja diatur secara hierarkis melalui:
      </p>

      <ol style="padding-left:22px;color:var(--slate-700);line-height:1.75;margin-bottom:20px">
        <li><strong>Undang-Undang (Lex Generalis &amp; Lex Specialis):</strong> UU No. 1 Tahun 1970 tentang Keselamatan Kerja menjadi undang-undang pokok keselamatan, yang diperkuat oleh UU No. 13 Tahun 2003 tentang Ketenagakerjaan dan UU Cipta Kerja.</li>
        <li><strong>Peraturan Pemerintah (PP):</strong> Memberikan panduan operasional teknis berskala nasional, seperti PP No. 50 Tahun 2012 yang mewajibkan seluruh industri menerapkan 5 prinsip SMK3.</li>
        <li><strong>Peraturan Menteri Ketenagakerjaan (Permenaker):</strong> Standar teknis yang sangat spesifik mengatur batas ambang lingkungan kerja, kualifikasi operator alat berat, bejana tekan, instalasi listrik, pencegahan kebakaran, hingga kriteria APD.</li>
        <li><strong>Surat Keputusan Direktur Jenderal (Kepdirjen Binwasnaker):</strong> Petunjuk teknis operasional bagi pengawas ketenagakerjaan dan ahli K3 di lapangan (contoh: lisensi ruang terbatas, scaffolding, dan juru las).</li>
      </ol>

      <!-- FAQ ACCORDION -->
      <h3 style="color:var(--navy);font-family:'Lexend',sans-serif;font-size:1.25rem;margin:28px 0 16px">Pertanyaan Sering Diajukan Terkait Regulasi K3 (FAQ)</h3>
      <div class="faq-box">
        
        <div class="faq-item">
          <button class="faq-q" onclick="toggleFaq(this)">
            <span>Apakah perusahaan subkontraktor wajib memiliki Ahli K3 Umum?</span>
            <span class="faq-icon">▼</span>
          </button>
          <div class="faq-a">
            Ya. Berdasarkan UU 1/1970 dan Permenaker No. 02/MEN/1992 juncto Permenaker No. 04/MEN/1987, setiap badan usaha (baik kontraktor utama maupun subkontraktor) yang mempekerjakan lebih dari 100 tenaga kerja atau memiliki risiko bahaya tinggi (seperti pekerjaan konstruksi, fabrikasi, kelistrikan) wajib memiliki sekurang-kurangnya satu orang Ahli K3 Umum bersertifikasi Kemnaker RI sebagai sekretaris P2K3.
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-q" onclick="toggleFaq(this)">
            <span>Apa konsekuensi hukum jika perusahaan mengabaikan audit SMK3 PP 50/2012?</span>
            <span class="faq-icon">▼</span>
          </button>
          <div class="faq-a">
            Perusahaan yang masuk dalam kriteria wajib (pekerja ≥ 100 orang atau berisiko tinggi) namun tidak menerapkan dan mengaudit SMK3 dapat dikenakan sanksi administratif bertahap dari Pengawas Ketenagakerjaan berupa: nota pemeriksaan, peringatan tertulis, pembekuan izin operasi sementara, diskualifikasi dari tender proyek pemerintah dan BUMN, hingga sanksi pidana jika terjadi kecelakaan kerja fatal akibat ketiadaan sistem K3.
          </div>
        </div>

      </div>

    </div>

  </div>
</section>

</main>

<?php require __DIR__ . '/../includes/footer.php'; ?>

<script>
let currentCat = 'all';

function setCategory(cat, btn){
  currentCat = cat;
  document.querySelectorAll('.category-pills .cat-btn').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
  filterRegulations();
}

function filterRegulations(){
  const query = document.getElementById('regSearch').value.toLowerCase().trim();
  const cards = document.querySelectorAll('.reg-card');

  cards.forEach(card => {
    const cardCat = card.getAttribute('data-cat');
    const cardText = card.getAttribute('data-text');

    const matchCat = (currentCat === 'all' || cardCat === currentCat);
    const matchQuery = (query === '' || cardText.includes(query));

    if(matchCat && matchQuery){
      card.style.display = 'flex';
    } else {
      card.style.display = 'none';
    }
  });
}

function toggleFaq(btn){
  btn.parentElement.classList.toggle('active');
}
</script>

<?php require __DIR__ . '/../includes/scripts.php'; ?>
</body>
</html>
