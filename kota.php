<?php
require_once __DIR__ . '/config.php';
$s = get_all_settings();
$wa_number = '6287759151278';
$gtm_id    = 'GTM-MMZHD3HN';
$year      = date('Y');
$current_month = [
  1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
  5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
  9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
][(int)date('n')];

// Shared gallery pool of verified real training photos from /galeri/
$gallery_pool = [
  '/galeri/thumbs/PELATIHAN%20DAMKAR.JPG',
  '/galeri/thumbs/IMG_1945.JPG',
  '/galeri/thumbs/WhatsApp%20Image%202025-03-16%20at%2022.04.39.jpeg',
  '/galeri/thumbs/WhatsApp%20Image%202024-11-24%20at%2017.21.34.jpeg',
  '/galeri/thumbs/WhatsApp%20Image%202025-03-16%20at%2022.03.25.jpeg',
  '/galeri/thumbs/IMG_1910.JPG',
  '/galeri/thumbs/IMG_1942.JPG',
  '/galeri/thumbs/IMG_0035.JPG',
  '/galeri/thumbs/IMG_1868.JPG',
  '/galeri/thumbs/DSC_0282.JPG',
  '/galeri/thumbs/DSC_0200.JPG',
  '/galeri/thumbs/DSC_0196.JPG',
  '/galeri/thumbs/DSC_0179.JPG',
  '/galeri/thumbs/DSC_0166.JPG',
  '/galeri/thumbs/DSC_0157.JPG',
  '/galeri/thumbs/DSC_0142.JPG',
  '/galeri/thumbs/DSC_0100.JPG',
  '/galeri/thumbs/DSC_0082.JPG',
  '/galeri/thumbs/DSC_0068.JPG',
  '/galeri/thumbs/DSC_0049.JPG',
];

$cities = [
  'jakarta' => [
    'name'       => 'Jakarta',
    'province'   => 'DKI Jakarta',
    'title'      => 'Pelatihan K3 Jakarta – Sertifikasi KEMNAKER RI & BNSP | Wahana Totalita',
    'desc'       => 'Sertifikasi Ahli K3 Umum (AK3U) BNSP & Kemnaker RI di Jakarta, plus K3 Konstruksi, K3 Listrik, dan K3 Migas. Untuk industri konstruksi, manufaktur, dan energi. Sertifikat berlaku nasional. Daftar sekarang.',
    'industries' => 'konstruksi gedung bertingkat, industri manufaktur, minyak dan gas, perbankan dan jasa, logistik dan pergudangan, kelistrikan PLN',
    'demand'     => 'Jakarta sebagai ibu kota memiliki kepadatan industri tertinggi di Indonesia. Ribuan proyek konstruksi, kawasan industri Pulogadung, Cakung, dan Pulo Anem, serta kantor pusat perusahaan energi nasional menjadikan Jakarta sebagai pasar K3 terbesar.',
    'highlight'  => 'Pusat bisnis dan konstruksi terbesar Indonesia',
    'companies'  => 'Pertamina, PLN, Wijaya Karya, Adhi Karya, Waskita Karya, Total Bangun Persada, Hutama Karya',
    'nearby'     => 'Bekasi, Tangerang, Depok, Bogor',
    'img'        => $gallery_pool[0],
    'type'       => 'urban',
  ],
  'surabaya' => [
    'name'       => 'Surabaya',
    'province'   => 'Jawa Timur',
    'title'      => 'Pelatihan K3 Surabaya – Sertifikasi KEMNAKER RI & BNSP | Wahana Totalita',
    'desc'       => 'Sertifikasi Ahli K3 Umum (AK3U) BNSP & Kemnaker RI di Surabaya untuk industri perkapalan, petrokimia, dan manufaktur berat. Plus K3 Konstruksi, Operator Crane & Forklift. Daftar sekarang.',
    'industries' => 'industri perkapalan dan galangan kapal, petrokimia Gresik, manufaktur berat, pergudangan dan logistik pelabuhan Tanjung Perak, konstruksi infrastruktur',
    'demand'     => 'Surabaya adalah kota industri terbesar kedua Indonesia. Kawasan industri SIER, PIER Pasuruan, dan kompleks petrokimia Gresik-Tuban membutuhkan ribuan tenaga K3 bersertifikat setiap tahunnya. Pelabuhan Tanjung Perak juga mengharuskan operator alat angkat bersertifikat.',
    'highlight'  => 'Kota industri terbesar kedua Indonesia',
    'companies'  => 'PT Petrokimia Gresik, PAL Indonesia, Pelindo III, Semen Indonesia, Charoen Pokphand, Japfa Comfeed',
    'nearby'     => 'Sidoarjo, Gresik, Mojokerto, Pasuruan',
    'img'        => $gallery_pool[1],
    'type'       => 'industrial',
  ],
  'bandung' => [
    'name'       => 'Bandung',
    'province'   => 'Jawa Barat',
    'title'      => 'Pelatihan K3 Bandung – Sertifikasi KEMNAKER RI & BNSP | Wahana Totalita',
    'desc'       => 'Sertifikasi Ahli K3 Umum (AK3U) BNSP & Kemnaker RI di Bandung untuk industri tekstil, manufaktur, dan pertahanan. Plus K3 Konstruksi, AMDAL, Operator Forklift. Daftar sekarang.',
    'industries' => 'industri tekstil dan garmen, manufaktur elektronik, pertahanan (PT Pindad, PT Dirgantara Indonesia), konstruksi, IT dan startup teknologi',
    'demand'     => 'Bandung memiliki kawasan industri Rancaekek, Majalaya, dan KIIC Karawang yang berdekatan. Industri tekstil dan garmen yang padat karya membutuhkan Ahli K3 Umum dalam jumlah besar. Proyek infrastruktur Kereta Cepat Jakarta-Bandung juga membuka kebutuhan K3 konstruksi.',
    'highlight'  => 'Pusat industri tekstil, manufaktur & pertahanan',
    'companies'  => 'PT Pindad, PT Dirgantara Indonesia, PT Kahatex, PT Pan Brothers, PT Trisula Textile',
    'nearby'     => 'Cimahi, Cileunyi, Soreang, Padalarang',
    'img'        => $gallery_pool[2],
    'type'       => 'urban',
  ],
  'medan' => [
    'name'       => 'Medan',
    'province'   => 'Sumatera Utara',
    'title'      => 'Pelatihan K3 Medan – Sertifikasi KEMNAKER RI & BNSP | Wahana Totalita',
    'desc'       => 'Sertifikasi Ahli K3 Umum (AK3U) BNSP & Kemnaker RI di Medan untuk industri kelapa sawit, karet, dan pertambangan. Sertifikat berlaku nasional. Online & tatap muka. Daftar sekarang.',
    'industries' => 'perkebunan kelapa sawit dan karet, industri pengolahan CPO, pertambangan batu bara Sumatera Utara, pelabuhan Belawan, konstruksi infrastruktur',
    'demand'     => 'Medan adalah pintu gerbang industri Sumatera. Ratusan perusahaan perkebunan kelapa sawit di Sumatera Utara, Riau, dan Aceh mengirimkan karyawan untuk sertifikasi K3 ke Medan. Pelabuhan Belawan yang aktif membutuhkan operator alat berat bersertifikat.',
    'highlight'  => 'Gateway industri perkebunan & sawit Sumatera',
    'companies'  => 'PT Socfin Indonesia, PT Perkebunan Nusantara II/III/IV, PT Asian Agri, PT Musim Mas, PTPN IV',
    'nearby'     => 'Deli Serdang, Binjai, Tebing Tinggi, Pematang Siantar',
    'img'        => $gallery_pool[3],
    'type'       => 'energy_mining',
  ],
  'makassar' => [
    'name'       => 'Makassar',
    'province'   => 'Sulawesi Selatan',
    'title'      => 'Pelatihan K3 Makassar – Sertifikasi KEMNAKER RI & BNSP | Wahana Totalita',
    'desc'       => 'Sertifikasi Ahli K3 Umum (AK3U) BNSP & Kemnaker RI di Makassar untuk industri nikel, semen, dan konstruksi. Blended learning tersedia. Daftar sekarang.',
    'industries' => 'industri nikel dan smelting (Sorowako, Morowali), semen (Tonasa, Bosowa), pelabuhan Soekarno-Hatta, konstruksi infrastruktur IKN, perikanan dan cold storage',
    'demand'     => 'Makassar menjadi hub K3 untuk seluruh Kawasan Timur Indonesia. Boom industri nikel di Morowali dan Sorowako, proyek IKN di Kalimantan, serta kawasan industri KIMA mendorong permintaan sertifikasi K3 yang sangat tinggi.',
    'highlight'  => 'Hub industri nikel & gateway Kawasan Timur Indonesia',
    'companies'  => 'PT Vale Indonesia, PT Semen Tonasa, PT Bosowa Mediatama, PT Pelindo IV, PT Smelting',
    'nearby'     => 'Gowa, Maros, Takalar, Pangkajene',
    'img'        => $gallery_pool[4],
    'type'       => 'energy_mining',
  ],
  'semarang' => [
    'name'       => 'Semarang',
    'province'   => 'Jawa Tengah',
    'title'      => 'Pelatihan K3 Semarang – Sertifikasi KEMNAKER RI & BNSP | Wahana Totalita',
    'desc'       => 'Sertifikasi Ahli K3 Umum (AK3U) BNSP & Kemnaker RI di Semarang, plus K3 Konstruksi dan Operator Forklift. Untuk industri manufaktur dan logistik Jawa Tengah. Daftar sekarang.',
    'industries' => 'industri manufaktur kawasan Terboyo dan Gatot Subroto, logistik dan distribusi, konstruksi jalan tol Trans Jawa, industri makanan dan minuman',
    'demand'     => 'Semarang sebagai ibu kota Jawa Tengah memiliki kawasan industri yang berkembang pesat. Proyek tol Trans Jawa dan pembangunan Pelabuhan Kendal mendorong kebutuhan K3 konstruksi. Kedekatan dengan Yogyakarta memungkinkan pelatihan tatap muka di kota manapun.',
    'highlight'  => 'Pusat logistik dan manufaktur Jawa Tengah',
    'companies'  => 'PT Phapros, PT Sari Husada, PT Sido Muncul, PT Apac Inti Corpora, PT KAI Daop 4',
    'nearby'     => 'Demak, Kendal, Ungaran, Salatiga',
    'img'        => $gallery_pool[5],
    'type'       => 'industrial',
  ],
  'batam' => [
    'name'       => 'Batam',
    'province'   => 'Kepulauan Riau',
    'title'      => 'Pelatihan K3 Batam – Sertifikasi KEMNAKER RI & BNSP | Wahana Totalita',
    'desc'       => 'Sertifikasi Ahli K3 Umum (AK3U) BNSP & Kemnaker RI di Batam untuk industri galangan kapal, elektronik, dan manufaktur. Blended learning online. Daftar sekarang.',
    'industries' => 'galangan kapal dan offshore, manufaktur elektronik dan PCB, kawasan industri bebas Batamindo, logistik dan transshipment, konstruksi infrastruktur',
    'demand'     => 'Batam adalah kawasan industri bebas terbesar Indonesia dengan ratusan perusahaan multinasional. Industri galangan kapal mewajibkan sertifikasi Juru Las, Rigger, dan K3 Umum. Kawasan Batamindo Industrial Park dengan 100+ perusahaan elektronik membutuhkan K3 rutin.',
    'highlight'  => 'Kawasan industri bebas — galangan kapal & elektronik',
    'companies'  => 'PT McDermott, PT Drydocks World, PT Batamec, Infineon Technologies, ST Electronics',
    'nearby'     => 'Bintan, Tanjung Pinang, Karimun',
    'img'        => $gallery_pool[6],
    'type'       => 'industrial',
  ],
  'pekanbaru' => [
    'name'       => 'Pekanbaru',
    'province'   => 'Riau',
    'title'      => 'Pelatihan K3 Pekanbaru – Sertifikasi KEMNAKER RI & BNSP | Wahana Totalita',
    'desc'       => 'Sertifikasi Ahli K3 Umum (AK3U) BNSP & Kemnaker RI di Pekanbaru untuk industri migas, kelapa sawit, dan batubara Riau. Plus K3 Konstruksi, K3 Listrik. Daftar sekarang.',
    'industries' => 'minyak dan gas bumi (Chevron, CPI, PHR), perkebunan kelapa sawit, pertambangan batu bara, industri pengolahan CPO, konstruksi dan infrastruktur',
    'demand'     => 'Pekanbaru adalah pusat industri migas Riau. PT Chevron Pacific Indonesia (kini PHR) yang beroperasi di Duri dan Minas membutuhkan ribuan tenaga K3 migas bersertifikat. Perkebunan sawit yang masif di Riau juga mendorong permintaan K3 umum dan lingkungan.',
    'highlight'  => 'Jantung industri migas dan sawit Riau',
    'companies'  => 'PT Pertamina Hulu Riau (PHR), PT Chevron Pacific Indonesia, PT RAPP, PT Asian Agri, PT Indah Kiat',
    'nearby'     => 'Dumai, Bengkalis, Siak, Kampar',
    'img'        => $gallery_pool[7],
    'type'       => 'energy_mining',
  ],
  'balikpapan' => [
    'name'       => 'Balikpapan',
    'province'   => 'Kalimantan Timur',
    'title'      => 'Pelatihan K3 Balikpapan – Sertifikasi KEMNAKER RI & BNSP | Wahana Totalita',
    'desc'       => 'Sertifikasi Ahli K3 Umum (AK3U) BNSP & Kemnaker RI di Balikpapan untuk industri migas, batubara, dan konstruksi IKN. Blended learning online. Daftar sekarang.',
    'industries' => 'pengilangan minyak Pertamina RU V, distribusi energi Kalimantan, pertambangan batu bara, konstruksi IKN Nusantara, logistik dan pelabuhan',
    'demand'     => 'Balikpapan adalah kota minyak Indonesia dengan kilang minyak terbesar Pertamina. Proyek IKN Nusantara yang sedang dibangun membuka ribuan lowongan HSE dan membutuhkan masif sertifikasi K3 konstruksi. Kota ini menjadi batu loncatan tenaga K3 seluruh Kalimantan.',
    'highlight'  => 'Kota minyak + konstruksi IKN Nusantara',
    'companies'  => 'Pertamina RU V, Total E&P, Chevron Indonesia, PT Adaro, PT Kaltim Prima Coal, Waskita IKN',
    'nearby'     => 'Samarinda, Penajam Paser Utara (IKN), Bontang, Kutai Kartanegara',
    'img'        => $gallery_pool[8],
    'type'       => 'energy_mining',
  ],
  'yogyakarta' => [
    'name'       => 'Yogyakarta',
    'province'   => 'DI Yogyakarta',
    'title'      => 'Pelatihan K3 Yogyakarta – Sertifikasi KEMNAKER RI & BNSP | Wahana Totalita',
    'desc'       => 'Sertifikasi Ahli K3 Umum (AK3U) BNSP & Kemnaker RI di Yogyakarta — pusat pelatihan K3 kami. Plus K3 Konstruksi, AMDAL, Operator Forklift. Jadwal rutin bulanan. Daftar sekarang.',
    'industries' => 'industri manufaktur dan kerajinan, pariwisata dan perhotelan, konstruksi, pendidikan tinggi, industri kreatif dan percetakan',
    'demand'     => 'Yogyakarta adalah kota basis Wahana Totalita Konsultan. Kami menyelenggarakan jadwal pelatihan K3 rutin setiap bulan di Yogyakarta dengan fasilitas training center lengkap. Yogyakarta juga melayani peserta dari Jawa Tengah, Jawa Timur bagian barat, dan seluruh Indonesia via program online.',
    'highlight'  => 'Kota basis Wahana Totalita — jadwal rutin bulanan',
    'companies'  => 'PT Hartono Istana Teknologi (Polytron), PT Sarihusada, PT Mirota KSM, Hyatt Regency Yogyakarta, PT Taman Wisata Candi',
    'nearby'     => 'Sleman, Bantul, Kulonprogo, Klaten, Magelang',
    'img'        => $gallery_pool[9],
    'type'       => 'urban',
  ],
  'palembang' => [
    'name'       => 'Palembang',
    'province'   => 'Sumatera Selatan',
    'title'      => 'Pelatihan K3 Palembang – Sertifikasi KEMNAKER RI & BNSP | Wahana Totalita',
    'desc'       => 'Sertifikasi Ahli K3 Umum (AK3U) BNSP & Kemnaker RI di Palembang untuk industri migas, batubara, dan pupuk Sumatera Selatan. Sertifikat berlaku nasional. Daftar sekarang.',
    'industries' => 'minyak dan gas (Pertamina RU III), pertambangan batu bara (Bukit Asam), industri pupuk Pusri, perkebunan karet dan sawit',
    'demand'     => 'Palembang memiliki kilang minyak Pertamina RU III yang beroperasi sejak 1926 dan menjadi salah satu yang terbesar di Indonesia. PT Bukit Asam sebagai produsen batu bara terbesar di Sumatera Selatan membutuhkan tim K3 pertambangan bersertifikat secara rutin.',
    'highlight'  => 'Kilang Pertamina RU III & tambang batu bara Bukit Asam',
    'companies'  => 'Pertamina RU III, PT Bukit Asam, PT Pusri, PT Semen Baturaja, PT Pupuk Sriwidjaja',
    'nearby'     => 'Banyuasin, Ogan Ilir, Prabumulih, Lahat',
    'img'        => $gallery_pool[10],
    'type'       => 'energy_mining',
  ],
  'bekasi' => [
    'name'       => 'Bekasi',
    'province'   => 'Jawa Barat',
    'title'      => 'Pelatihan K3 Bekasi – Sertifikasi KEMNAKER RI & BNSP | Wahana Totalita',
    'desc'       => 'Sertifikasi Ahli K3 Umum (AK3U) BNSP & Kemnaker RI di Bekasi untuk kawasan industri MM2100, EJIP, dan Jababeka. Online & tatap muka. Daftar sekarang.',
    'industries' => 'kawasan industri terbesar ASEAN (MM2100, EJIP, Jababeka, Hyundai), manufaktur otomotif dan elektronik, logistik dan pergudangan, konstruksi properti',
    'demand'     => 'Bekasi adalah kota dengan konsentrasi kawasan industri tertinggi di Indonesia. Kawasan MM2100, EJIP, dan Jababeka menampung ratusan perusahaan multinasional yang semuanya mensyaratkan tenaga K3 bersertifikat. Permintaan Ahli K3 Umum dan K3 Konstruksi di Bekasi sangat tinggi sepanjang tahun.',
    'highlight'  => 'Konsentrasi kawasan industri tertinggi Indonesia',
    'companies'  => 'Toyota, Honda, LG Electronics, Samsung, Hyundai, Bridgestone, Astra International',
    'nearby'     => 'Cikarang, Karawang, Depok, Jakarta Timur',
    'img'        => $gallery_pool[11],
    'type'       => 'industrial',
  ],
  'cilegon' => [
    'name'       => 'Cilegon',
    'province'   => 'Banten',
    'title'      => 'Pelatihan K3 Cilegon – Sertifikasi KEMNAKER RI & BNSP | Wahana Totalita',
    'desc'       => 'Sertifikasi Ahli K3 Umum (AK3U) BNSP & Kemnaker RI di Cilegon untuk industri baja Krakatau Steel, petrokimia, dan pelabuhan. Blended learning online. Daftar sekarang.',
    'industries' => 'industri baja Krakatau Steel, petrokimia dan kimia dasar, pelabuhan Merak dan Cigading, industri semen, kawasan industri KS dan Krakatau Industrial Estate',
    'demand'     => 'Cilegon adalah kota baja dan petrokimia Indonesia. Krakatau Steel, Chandra Asri, dan puluhan pabrik kimia di Cilegon membutuhkan Ahli K3 Kimia, K3 Listrik, dan K3 Umum dalam jumlah besar. Risiko industri yang sangat tinggi membuat sertifikasi K3 menjadi kewajiban mutlak.',
    'highlight'  => 'Kota baja & petrokimia — risiko industri tertinggi',
    'companies'  => 'PT Krakatau Steel, PT Chandra Asri Petrochemical, PT Asahimas Chemical, PT Banten Inti Gasindo',
    'nearby'     => 'Serang, Anyer, Merak, Tangerang',
    'img'        => $gallery_pool[12],
    'type'       => 'industrial',
  ],
  'samarinda' => [
    'name'       => 'Samarinda',
    'province'   => 'Kalimantan Timur',
    'title'      => 'Pelatihan K3 Samarinda – Sertifikasi K3 Pertambangan & BNSP | Wahana Totalita',
    'desc'       => 'Sertifikasi Ahli K3 Umum (AK3U) BNSP & Kemnaker RI di Samarinda, plus POP, POM, POU Pertambangan dan Ahli K3 Batu Bara. Blended learning. Daftar sekarang.',
    'industries' => 'pertambangan batu bara (produsen terbesar dunia), minyak dan gas bumi, perkebunan kelapa sawit, konstruksi infrastruktur, pelabuhan Samarinda',
    'demand'     => 'Samarinda adalah ibu kota Kalimantan Timur dan pusat administrasi industri batu bara terbesar di dunia. Kalimantan Timur menghasilkan 30%+ produksi batu bara Indonesia. Ribuan pengawas operasional tambang membutuhkan sertifikat POP, POM, dan POU setiap tahunnya.',
    'highlight'  => 'Pusat administrasi industri batu bara terbesar dunia',
    'companies'  => 'PT Kaltim Prima Coal, PT Berau Coal, PT Adaro, PT Kideco Jaya Agung, PT Mahakam Resources',
    'nearby'     => 'Balikpapan, Kutai Kartanegara, Bontang, Tenggarong',
    'img'        => $gallery_pool[13],
    'type'       => 'energy_mining',
  ],
  'denpasar' => [
    'name'       => 'Denpasar',
    'province'   => 'Bali',
    'title'      => 'Pelatihan K3 Bali Denpasar – Sertifikasi KEMNAKER RI & BNSP | Wahana Totalita',
    'desc'       => 'Sertifikasi Ahli K3 Umum (AK3U) BNSP & Kemnaker RI di Bali & Denpasar untuk industri pariwisata dan konstruksi resort. Plus K3 Konstruksi, Operator Forklift. Daftar sekarang.',
    'industries' => 'industri pariwisata dan perhotelan, konstruksi resort dan villa, industri makanan dan minuman, bandara Ngurah Rai, MICE dan event organizer',
    'demand'     => 'Bali memiliki ribuan hotel berbintang, resort, dan kawasan wisata yang membutuhkan tenaga K3 bersertifikat untuk memenuhi standar keselamatan tamu dan karyawan. Konstruksi yang terus-menerus di Badung, Gianyar, dan Denpasar juga mendorong permintaan K3 Konstruksi yang tinggi.',
    'highlight'  => 'Pusat pariwisata & konstruksi resort kelas dunia',
    'companies'  => 'PT Bali Tourism Development, Marriott International, Hyatt Hotels, Aman Resorts, PT Angkasa Pura I',
    'nearby'     => 'Badung, Gianyar, Tabanan, Nusa Dua',
    'img'        => $gallery_pool[14],
    'type'       => 'urban',
  ],
  'malang' => [
    'name'       => 'Malang',
    'province'   => 'Jawa Timur',
    'title'      => 'Pelatihan K3 Malang – Sertifikasi KEMNAKER RI & BNSP | Wahana Totalita',
    'desc'       => 'Sertifikasi Ahli K3 Umum (AK3U) BNSP & Kemnaker RI di Malang untuk industri makanan-minuman dan manufaktur. Plus K3 Konstruksi, Operator Alat Berat. Dekat Surabaya. Daftar sekarang.',
    'industries' => 'industri makanan dan minuman (Malang Raya), manufaktur rokok (Sampoerna, Gudang Garam area), konstruksi perumahan dan infrastruktur, pertanian apel dan hortikultura',
    'demand'     => 'Malang adalah kota industri makanan dan minuman terbesar di Jawa Timur. Pabrik-pabrik di Pandaan, Pasuruan, dan kawasan Malang membutuhkan tenaga K3 untuk pemenuhan standar industri FMCG. Pertumbuhan properti yang pesat juga mendorong permintaan K3 Konstruksi.',
    'highlight'  => 'Pusat industri FMCG dan manufaktur Jawa Timur bagian selatan',
    'companies'  => 'PT Bentoel, PT Tiga Pilar Sejahtera, PT Indomie (Indofood), Selecta, PT Inka',
    'nearby'     => 'Batu, Pasuruan, Blitar, Lumajang',
    'img'        => $gallery_pool[15],
    'type'       => 'urban',
  ],
  'solo' => [
    'name'       => 'Solo',
    'province'   => 'Jawa Tengah',
    'title'      => 'Pelatihan K3 Solo Surakarta – Sertifikasi KEMNAKER RI & BNSP | Wahana Totalita',
    'desc'       => 'Sertifikasi Ahli K3 Umum (AK3U) BNSP & Kemnaker RI di Solo & Surakarta untuk industri tekstil dan manufaktur furnitur. Plus K3 Konstruksi, Operator Forklift. Dekat Yogyakarta. Daftar sekarang.',
    'industries' => 'industri tekstil dan batik, manufaktur furnitur dan rotan, percetakan dan penerbitan, konstruksi, perdagangan dan UMKM',
    'demand'     => 'Solo dan kawasan Soloraya (Sukoharjo, Boyolali, Klaten, Sragen, Karanganyar, Wonogiri) memiliki ratusan pabrik tekstil dan garmen yang membutuhkan Ahli K3 Umum. Kedekatan dengan Yogyakarta (±1 jam) memudahkan akses ke program tatap muka kami.',
    'highlight'  => 'Pusat tekstil, batik & manufaktur Soloraya',
    'companies'  => 'PT Sritex, PT Dan Liris, PT Batik Keris, PT Tyfountex, PT Konimex',
    'nearby'     => 'Sukoharjo, Klaten, Boyolali, Karanganyar, Yogyakarta',
    'img'        => $gallery_pool[16],
    'type'       => 'urban',
  ],
  'karawang' => [
    'name'       => 'Karawang',
    'province'   => 'Jawa Barat',
    'title'      => 'Pelatihan K3 Karawang – Sertifikasi KEMNAKER RI & BNSP | Wahana Totalita',
    'desc'       => 'Sertifikasi Ahli K3 Umum (AK3U) BNSP & Kemnaker RI di Karawang untuk kawasan industri otomotif KIIC dan Surya Cipta. Online & tatap muka. Daftar sekarang.',
    'industries' => 'industri otomotif (Toyota, Honda, Mitsubishi), kawasan industri KIIC, Kota Bukit Indah, Surya Cipta, manufaktur komponen dan elektronik',
    'demand'     => 'Karawang adalah Detroit-nya Indonesia — pusat industri otomotif dengan Toyota, Honda, Mitsubishi, dan ratusan pemasok tier-1 dan tier-2. Semua pabrik otomotif ini mewajibkan tenaga K3 bersertifikat dan mengadakan pelatihan K3 secara rutin.',
    'highlight'  => 'Detroit Indonesia — jantung industri otomotif nasional',
    'companies'  => 'Toyota Manufacturing Indonesia, Honda Prospect Motor, Mitsubishi Motors, Bridgestone, Denso Indonesia',
    'nearby'     => 'Bekasi, Purwakarta, Subang, Cikampek',
    'img'        => $gallery_pool[17],
    'type'       => 'industrial',
  ],
  'tangerang' => [
    'name'       => 'Tangerang',
    'province'   => 'Banten',
    'title'      => 'Pelatihan K3 Tangerang – Sertifikasi KEMNAKER RI & BNSP | Wahana Totalita',
    'desc'       => 'Sertifikasi Ahli K3 Umum (AK3U) BNSP & Kemnaker RI di Tangerang untuk kawasan industri BSD, Cikupa, dan Balaraja. Online & tatap muka. Daftar sekarang.',
    'industries' => 'industri farmasi dan kosmetik (terbesar di Indonesia), tekstil, makanan dan minuman, bandara Soekarno-Hatta, logistik dan pergudangan',
    'demand'     => 'Tangerang adalah pusat industri farmasi dan kosmetik Indonesia. Hampir 60% produksi farmasi nasional berasal dari Tangerang. Industri farmasi memiliki standar K3 yang sangat ketat (GMP + K3) sehingga permintaan sertifikasi K3 sangat konsisten sepanjang tahun.',
    'highlight'  => 'Pusat industri farmasi & kosmetik Indonesia',
    'companies'  => 'PT Kalbe Farma, PT Kimia Farma, PT Sanbe Farma, PT Wardah (Paragon), PT Unilever Indonesia',
    'nearby'     => 'Tangerang Selatan, Serpong, Balaraja, Cikupa, Jakarta Barat',
    'img'        => $gallery_pool[18],
    'type'       => 'industrial',
  ],
  'bogor' => [
    'name'       => 'Bogor',
    'province'   => 'Jawa Barat',
    'title'      => 'Pelatihan K3 Bogor – Sertifikasi KEMNAKER RI & BNSP | Wahana Totalita',
    'desc'       => 'Sertifikasi Ahli K3 Umum (AK3U) BNSP & Kemnaker RI di Bogor untuk industri makanan, farmasi, dan konstruksi. Online & tatap muka. Daftar sekarang.',
    'industries' => 'industri makanan dan minuman (Indofood, Wings, Nutrifood), agribisnis dan perkebunan, industri farmasi dan jamu, konstruksi perumahan dan infrastruktur',
    'demand'     => 'Bogor memiliki konsentrasi industri makanan dan minuman yang tinggi, didukung oleh IPB sebagai sumber SDM pertanian dan pangan. Kawasan Industri Sentul dan berbagai pabrik di Cibinong membutuhkan tenaga K3 bersertifikat secara konsisten.',
    'highlight'  => 'Pusat agribisnis & industri pangan Jawa Barat',
    'companies'  => 'PT Indofood CBP, PT Wings Food, PT Nutrifood, PT Sido Muncul, PT Kimia Farma Bogor',
    'nearby'     => 'Depok, Cibinong, Sentul, Ciawi, Sukabumi',
    'img'        => $gallery_pool[19],
    'type'       => 'urban',
  ],
];

// Routing and 404 validation
$slug = strtolower(trim($_GET['kota'] ?? ''));

if (!isset($cities[$slug])) {
  http_response_code(404);
  include '404.php';
  exit;
}
$c   = $cities[$slug];
$wa  = "https://wa.me/{$wa_number}?text=" . rawurlencode("Halo Wahana Totalita, saya ingin informasi biaya, jadwal, dan pendaftaran Pelatihan K3 {$c['name']} {$year}");

// Ring-pattern internal linking between the 20 curated city pages
$cityKeys = array_keys($cities);
$curIdx   = array_search($slug, $cityKeys, true);
$ringCities = [];
if ($curIdx !== false) {
    $n = count($cityKeys);
    for ($i = 1; $i <= 3 && $i < $n; $i++) {
        $ringCities[] = $cityKeys[($curIdx + $i) % $n];
    }
}

// Meta Title and Description (Preserved from $c['title'] with commercial price/schedule intent)
$metaTitle = $c['title'];
$metaDesc  = $c['desc'];
if (mb_strlen($metaDesc) < 140) {
    $metaDesc .= " Dapatkan rincian biaya pelatihan K3 {$c['name']} & jadwal {$year} online/tatap muka.";
}

// Program Matrix linked to verified program URLs
$city_programs_map = [
  'jakarta' => [
    ['🦺','Ahli K3 Umum (AK3U)','KEMNAKER RI','3–5 Hari','pelatihan-ahli-k3-umum-sertifikasi-kemnaker-ri'],
    ['🏗️','Ahli K3 Konstruksi Gedung','KEMNAKER RI','5 Hari','pelatihan-ahli-muda-k3-konstruksi-sertifikasi-kemnaker-ri'],
    ['⚡','Ahli K3 Listrik & PLN','KEMNAKER RI','5 Hari','pelatihan-ahli-k3-listrik-sertifikasi-kemnaker-ri'],
    ['🔥','Petugas Penanggulangan Kebakaran','KEMNAKER RI','5–7 Hari','pelatihan-petugas-peran-kebakaran-kelas-d-kemnaker-ri'],
    ['🏗️','Operator Forklift & Pergudangan','KEMNAKER RI','3 Hari','pelatihan-k3-operator-forklift-kelas-2-sertifikasi-kemnaker-ri'],
    ['📋','Safety Officer & Auditor SMK3','BNSP','3 Hari','pelatihan-auditor-smk3-online'],
    ['🌿','Penyusun AMDAL & Lingkungan Hidup','KEMNAKER RI','5 Hari','penyusun-amdal'],
    ['🛡️','Operator K3 Sertifikasi BNSP','BNSP','3 Hari','pelatihan-operator-k3-sertifikasi-bnsp'],
  ],
  'surabaya' => [
    ['🦺','Ahli K3 Umum (AK3U) Industri','KEMNAKER RI','3–5 Hari','pelatihan-ahli-k3-umum-sertifikasi-kemnaker-ri'],
    ['🧗','TKBT II Surabaya (Kerja Ketinggian)','KEMNAKER RI','3 Hari','tkbt-ii-surabaya'],
    ['🏗️','Operator Crane & Forklift Pelabuhan','KEMNAKER RI','3–4 Hari','pelatihan-k3-operator-forklift-kelas-2-sertifikasi-kemnaker-ri'],
    ['🧪','Ahli K3 Kimia & Petrokimia Gresik','KEMNAKER RI','5 Hari','pelatihan-petugas-k3-kimia-sertifikasi-kemnaker-ri'],
    ['⚡','Ahli K3 Listrik Fasilitas Pabrik','KEMNAKER RI','5 Hari','pelatihan-ahli-k3-listrik-sertifikasi-kemnaker-ri'],
    ['🏗️','Ahli Muda K3 Konstruksi','KEMNAKER RI','5 Hari','pelatihan-ahli-muda-k3-konstruksi-sertifikasi-kemnaker-ri'],
    ['📋','Auditor SMK3 PP 50/2012','BNSP','3 Hari','pelatihan-auditor-smk3-online'],
    ['⚙️','Operator Pesawat Tenaga Produksi (PTP)','KEMNAKER RI','3 Hari','pelatihan-operator-pesawat-tenaga-produksi-ptp'],
  ],
  'bandung' => [
    ['🦺','Ahli K3 Umum (AK3U) Tekstil & Manufaktur','KEMNAKER RI','3–5 Hari','pelatihan-ahli-k3-umum-sertifikasi-kemnaker-ri'],
    ['⚡','Ahli K3 Listrik Industri Elektronik','KEMNAKER RI','5 Hari','pelatihan-ahli-k3-listrik-sertifikasi-kemnaker-ri'],
    ['🏗️','Operator Forklift & Logistik Pabrik','KEMNAKER RI','3 Hari','pelatihan-k3-operator-forklift-kelas-2-sertifikasi-kemnaker-ri'],
    ['🔥','Petugas K3 Kebakaran Pabrik Garmen','KEMNAKER RI','3–5 Hari','pelatihan-petugas-peran-kebakaran-kelas-d-kemnaker-ri'],
    ['🏗️','Ahli K3 Konstruksi Infrastruktur','KEMNAKER RI','5 Hari','pelatihan-ahli-muda-k3-konstruksi-sertifikasi-kemnaker-ri'],
    ['📋','Safety Officer Industri Pertahanan & IT','BNSP','3 Hari','pelatihan-auditor-smk3-online'],
    ['🌿','Penyusun AMDAL & IPAL Tekstil','KEMNAKER RI','5 Hari','penyusun-amdal'],
    ['🎓','Ahli K3 Umum Fresh Graduate Online','KEMNAKER RI','3–5 Hari','pelatihan-ahli-k3-umum-fresh-graduate-kemnaker-online'],
  ],
  'medan' => [
    ['🦺','Ahli K3 Umum (AK3U) Perkebunan & Pabrik','KEMNAKER RI','3–5 Hari','pelatihan-ahli-k3-umum-sertifikasi-kemnaker-ri'],
    ['🌴','K3 Pabrik Kelapa Sawit (PKS) & CPO','BNSP','3–5 Hari','ak3-bnsp'],
    ['⛏️','POP Pengawas Operasional Tambang','BNSP','3–5 Hari','pelatihan-pop-pertambangan-sertifikasi-bnsp-online'],
    ['🏗️','Operator Alat Berat & Forklift Gudang','KEMNAKER RI','3 Hari','pelatihan-k3-operator-forklift-kelas-2-sertifikasi-kemnaker-ri'],
    ['⚡','Ahli K3 Listrik Industri Pengolahan','KEMNAKER RI','5 Hari','pelatihan-ahli-k3-listrik-sertifikasi-kemnaker-ri'],
    ['🔥','Penanggulangan Kebakaran Lahan & Pabrik','KEMNAKER RI','5 Hari','pelatihan-petugas-peran-kebakaran-kelas-d-kemnaker-ri'],
    ['🌿','AMDAL Perkebunan & Pengolahan Sawit','KEMNAKER RI','5 Hari','penyusun-amdal'],
    ['📋','Auditor SMK3 Perkebunan & Logistik','BNSP','3 Hari','pelatihan-auditor-smk3-online'],
  ],
  'makassar' => [
    ['🦺','Ahli K3 Umum (AK3U) Industri & Smelter','KEMNAKER RI','3–5 Hari','pelatihan-ahli-k3-umum-sertifikasi-kemnaker-ri'],
    ['⛏️','POP / POM Pertambangan Nikel','BNSP','3–5 Hari','pelatihan-pop-pertambangan-sertifikasi-bnsp-online'],
    ['🏗️','Ahli K3 Konstruksi Infrastruktur & IKN','KEMNAKER RI','5 Hari','pelatihan-ahli-muda-k3-konstruksi-sertifikasi-kemnaker-ri'],
    ['⚡','Ahli K3 Listrik Pabrik Semen & Smelter','KEMNAKER RI','5 Hari','pelatihan-ahli-k3-listrik-sertifikasi-kemnaker-ri'],
    ['🏗️','Operator Forklift & Alat Angkat Pelabuhan','KEMNAKER RI','3–4 Hari','pelatihan-k3-operator-forklift-kelas-2-sertifikasi-kemnaker-ri'],
    ['🔥','K3 Kebakaran & Tanggap Darurat Pabrik','KEMNAKER RI','5 Hari','pelatihan-petugas-peran-kebakaran-kelas-d-kemnaker-ri'],
    ['📋','Safety Officer & Auditor SMK3 Kawasan Timur','BNSP','3 Hari','pelatihan-auditor-smk3-online'],
    ['🛡️','Sertifikasi Operator K3 BNSP','BNSP','3 Hari','pelatihan-operator-k3-sertifikasi-bnsp'],
  ],
  'semarang' => [
    ['🦺','Ahli K3 Umum (AK3U) Jawa Tengah','KEMNAKER RI','3–5 Hari','pelatihan-ahli-k3-umum-sertifikasi-kemnaker-ri'],
    ['🏗️','Operator Forklift Kawasan Industri','KEMNAKER RI','3 Hari','pelatihan-k3-operator-forklift-kelas-2-sertifikasi-kemnaker-ri'],
    ['🏗️','Ahli K3 Konstruksi Tol & Infrastruktur','KEMNAKER RI','5 Hari','pelatihan-ahli-muda-k3-konstruksi-sertifikasi-kemnaker-ri'],
    ['⚡','Ahli K3 Listrik Fasilitas Manufaktur','KEMNAKER RI','5 Hari','pelatihan-ahli-k3-listrik-sertifikasi-kemnaker-ri'],
    ['🔥','Petugas Peran Kebakaran Industri','KEMNAKER RI','3–5 Hari','pelatihan-petugas-peran-kebakaran-kelas-d-kemnaker-ri'],
    ['🧪','Petugas K3 Kimia & Industri Makanan','KEMNAKER RI','3–5 Hari','pelatihan-petugas-k3-kimia-sertifikasi-kemnaker-ri'],
    ['📋','Auditor SMK3 & Safety Officer Logistik','BNSP','3 Hari','pelatihan-auditor-smk3-online'],
    ['🌿','Penyusun AMDAL & Pengelolaan Lingkungan','KEMNAKER RI','5 Hari','penyusun-amdal'],
  ],
  'batam' => [
    ['🦺','Ahli K3 Umum (AK3U) FTZ Batam','KEMNAKER RI','3–5 Hari','pelatihan-ahli-k3-umum-sertifikasi-kemnaker-ri'],
    ['⚓','Pipe Fitter & K3 Galangan Kapal','BNSP','3–5 Hari','pelatihan-dan-sertifikasi-pipe-fitter-sertifikasi-bnsp'],
    ['🏗️','Operator Forklift & Alat Angkat Berat','KEMNAKER RI','3–4 Hari','pelatihan-k3-operator-forklift-kelas-2-sertifikasi-kemnaker-ri'],
    ['⚡','Ahli K3 Listrik & Elektronika PCB','KEMNAKER RI','5 Hari','pelatihan-ahli-k3-listrik-sertifikasi-kemnaker-ri'],
    ['🧪','Ahli K3 Kimia Manufaktur Semikonduktor','KEMNAKER RI','5 Hari','pelatihan-petugas-k3-kimia-sertifikasi-kemnaker-ri'],
    ['🔥','Ahli K3 Kebakaran Fasilitas Galangan','KEMNAKER RI','5–7 Hari','pelatihan-petugas-peran-kebakaran-kelas-d-kemnaker-ri'],
    ['📋','Safety Officer Standar Multinasional Batamindo','BNSP','3 Hari','pelatihan-auditor-smk3-online'],
    ['🛡️','Sertifikasi AK3 BNSP Profesional','BNSP','3–5 Hari','ak3-bnsp'],
  ],
  'pekanbaru' => [
    ['🦺','Ahli K3 Umum (AK3U) Migas & Sawit','KEMNAKER RI','3–5 Hari','pelatihan-ahli-k3-umum-sertifikasi-kemnaker-ri'],
    ['🛢️','K3 Minyak & Gas Bumi (Migas) BNSP','BNSP','3–5 Hari','ak3-bnsp'],
    ['⛏️','POP Pertambangan Batubara Riau','BNSP','3–5 Hari','pelatihan-pop-pertambangan-sertifikasi-bnsp-online'],
    ['🌴','K3 Perkebunan Kelapa Sawit & CPO','BNSP','3–5 Hari','pelatihan-operator-k3-sertifikasi-bnsp'],
    ['⚡','Ahli K3 Listrik Instalasi Energi & Kilang','KEMNAKER RI','5 Hari','pelatihan-ahli-k3-listrik-sertifikasi-kemnaker-ri'],
    ['🔥','Pemadam Kebakaran Hutan & Lahan (Karhutla)','KEMNAKER RI','5 Hari','pelatihan-petugas-peran-kebakaran-kelas-d-kemnaker-ri'],
    ['🌿','AMDAL Perkebunan Sawit & Hutan Tanaman','KEMNAKER RI','5 Hari','penyusun-amdal'],
    ['📋','Auditor SMK3 PP 50/2012 Sektor Energi','BNSP','3 Hari','pelatihan-auditor-smk3-online'],
  ],
  'balikpapan' => [
    ['🦺','Ahli K3 Umum (AK3U) Balikpapan','KEMNAKER RI','3–5 Hari','pelatihan-ahli-k3-umum-sertifikasi-kemnaker-ri'],
    ['🛢️','K3 Migas Kilang RU V & Hulu Energi','BNSP','3–5 Hari','ak3-bnsp'],
    ['🏗️','Ahli K3 Konstruksi Mega Proyek IKN','KEMNAKER RI','5 Hari','pelatihan-ahli-muda-k3-konstruksi-sertifikasi-kemnaker-ri'],
    ['⛏️','POP / POM Pertambangan Batubara Kaltim','BNSP','3–5 Hari','pelatihan-pop-pertambangan-sertifikasi-bnsp-online'],
    ['🏗️','Operator Forklift & Alat Berat Migas','KEMNAKER RI','3–4 Hari','pelatihan-k3-operator-forklift-kelas-2-sertifikasi-kemnaker-ri'],
    ['⚡','Ahli K3 Listrik Fasilitas Kilang & Tambang','KEMNAKER RI','5 Hari','pelatihan-ahli-k3-listrik-sertifikasi-kemnaker-ri'],
    ['🔥','Ahli K3 Kebakaran Kilang & Fasilitas Energi','KEMNAKER RI','5–7 Hari','pelatihan-petugas-peran-kebakaran-kelas-d-kemnaker-ri'],
    ['📋','Safety Officer CSMS Migas & Konstruksi IKN','BNSP','3 Hari','pelatihan-auditor-smk3-online'],
  ],
  'yogyakarta' => [
    ['🦺','Ahli K3 Umum (AK3U) Pusat Training Center','KEMNAKER RI','3–5 Hari','pelatihan-ahli-k3-umum-sertifikasi-kemnaker-ri'],
    ['🏗️','Ahli Muda K3 Konstruksi Gedung','KEMNAKER RI','5 Hari','pelatihan-ahli-muda-k3-konstruksi-sertifikasi-kemnaker-ri'],
    ['⚡','Ahli K3 Listrik Gedung & Manufaktur','KEMNAKER RI','5 Hari','pelatihan-ahli-k3-listrik-sertifikasi-kemnaker-ri'],
    ['🔥','Ahli K3 Penanggulangan Kebakaran','KEMNAKER RI','5 Hari','pelatihan-petugas-peran-kebakaran-kelas-d-kemnaker-ri'],
    ['🏗️','Operator Forklift & Logistik','KEMNAKER RI','3 Hari','pelatihan-k3-operator-forklift-kelas-2-sertifikasi-kemnaker-ri'],
    ['📋','Safety Officer & Auditor SMK3 BNSP','BNSP','3 Hari','pelatihan-auditor-smk3-online'],
    ['🌿','Penyusun AMDAL A Resmi KLHK','KEMNAKER RI','5 Hari','penyusun-amdal'],
    ['🎓','Ahli K3 Umum Fresh Graduate Tatap Muka/Online','KEMNAKER RI','3–5 Hari','pelatihan-ahli-k3-umum-fresh-graduate-kemnaker-online'],
  ],
  'palembang' => [
    ['🦺','Ahli K3 Umum (AK3U) Sumatera Selatan','KEMNAKER RI','3–5 Hari','pelatihan-ahli-k3-umum-sertifikasi-kemnaker-ri'],
    ['⛏️','POP Pertambangan Batubara Bukit Asam','BNSP','3–5 Hari','pelatihan-pop-pertambangan-sertifikasi-bnsp-online'],
    ['🛢️','K3 Kilang Minyak & Petrokimia Pusri','BNSP','3–5 Hari','ak3-bnsp'],
    ['🧪','Ahli K3 Kimia Industri Pupuk & Petrokimia','KEMNAKER RI','5 Hari','pelatihan-petugas-k3-kimia-sertifikasi-kemnaker-ri'],
    ['⚡','Ahli K3 Listrik Industri Tambang & Energi','KEMNAKER RI','5 Hari','pelatihan-ahli-k3-listrik-sertifikasi-kemnaker-ri'],
    ['🏗️','Ahli K3 Konstruksi Proyek Infrastruktur Sumsel','KEMNAKER RI','5 Hari','pelatihan-ahli-muda-k3-konstruksi-sertifikasi-kemnaker-ri'],
    ['🌿','Penyusun AMDAL Sektor Tambang & Sawit','KEMNAKER RI','5 Hari','penyusun-amdal'],
    ['📋','Safety Officer & Auditor SMK3 BUMN','BNSP','3 Hari','pelatihan-auditor-smk3-online'],
  ],
  'bekasi' => [
    ['🦺','Ahli K3 Umum (AK3U) Kawasan Industri MM2100','KEMNAKER RI','3–5 Hari','pelatihan-ahli-k3-umum-sertifikasi-kemnaker-ri'],
    ['🏗️','Operator Forklift Jababeka & EJIP','KEMNAKER RI','3 Hari','pelatihan-k3-operator-forklift-kelas-2-sertifikasi-kemnaker-ri'],
    ['⚡','Ahli K3 Listrik Manufaktur Otomotif & Elektronik','KEMNAKER RI','5 Hari','pelatihan-ahli-k3-listrik-sertifikasi-kemnaker-ri'],
    ['🧪','Petugas K3 Kimia Kawasan Industri','KEMNAKER RI','3–5 Hari','pelatihan-petugas-k3-kimia-sertifikasi-kemnaker-ri'],
    ['🔥','Ahli K3 Kebakaran Pabrik Manufaktur','KEMNAKER RI','5 Hari','pelatihan-petugas-peran-kebakaran-kelas-d-kemnaker-ri'],
    ['🏗️','Ahli K3 Konstruksi Properti & Kawasan Industri','KEMNAKER RI','5 Hari','pelatihan-ahli-muda-k3-konstruksi-sertifikasi-kemnaker-ri'],
    ['📋','Auditor SMK3 PP 50/2012 Sektor Otomotif','BNSP','3 Hari','pelatihan-auditor-smk3-online'],
    ['⚙️','Operator Pesawat Tenaga Produksi (PTP)','KEMNAKER RI','3 Hari','pelatihan-operator-pesawat-tenaga-produksi-ptp'],
  ],
  'cilegon' => [
    ['🦺','Ahli K3 Umum (AK3U) Kota Baja Cilegon','KEMNAKER RI','3–5 Hari','pelatihan-ahli-k3-umum-sertifikasi-kemnaker-ri'],
    ['🧪','Ahli K3 Kimia Industri Petrokimia & Gas','KEMNAKER RI','5 Hari','pelatihan-petugas-k3-kimia-sertifikasi-kemnaker-ri'],
    ['⚡','Ahli K3 Listrik Industri Berat Krakatau Steel','KEMNAKER RI','5 Hari','pelatihan-ahli-k3-listrik-sertifikasi-kemnaker-ri'],
    ['🔥','Ahli K3 Kebakaran Tingkat Lanjut Fasilitas Kimia','KEMNAKER RI','5–7 Hari','pelatihan-petugas-peran-kebakaran-kelas-d-kemnaker-ri'],
    ['🏗️','Operator Forklift Pelabuhan Merak-Cigading','KEMNAKER RI','3–4 Hari','pelatihan-k3-operator-forklift-kelas-2-sertifikasi-kemnaker-ri'],
    ['🏗️','Ahli K3 Konstruksi Fabrikasi Pabrik Kimia','KEMNAKER RI','5 Hari','pelatihan-ahli-muda-k3-konstruksi-sertifikasi-kemnaker-ri'],
    ['📋','Safety Officer Process Safety Management (PSM)','BNSP','3 Hari','pelatihan-auditor-smk3-online'],
    ['🌿','Penyusun AMDAL Kawasan Industri Kimia Berat','KEMNAKER RI','5 Hari','penyusun-amdal'],
  ],
  'samarinda' => [
    ['⛏️','POP Pengawas Operasional Pertama Batubara','BNSP','3–5 Hari','pelatihan-pop-pertambangan-sertifikasi-bnsp-online'],
    ['⛏️','POM Pengawas Operasional Madya Tambang','BNSP','4–5 Hari','pelatihan-pop-pertambangan-sertifikasi-bnsp-online'],
    ['🦺','Ahli K3 Umum (AK3U) Tambang & Energi Kaltim','KEMNAKER RI','3–5 Hari','pelatihan-ahli-k3-umum-sertifikasi-kemnaker-ri'],
    ['🏗️','Operator Forklift & Alat Angkat Pertambangan','KEMNAKER RI','3–4 Hari','pelatihan-k3-operator-forklift-kelas-2-sertifikasi-kemnaker-ri'],
    ['⚡','Ahli K3 Listrik Fasilitas Tambang & Pelabuhan Muat','KEMNAKER RI','5 Hari','pelatihan-ahli-k3-listrik-sertifikasi-kemnaker-ri'],
    ['🌿','AMDAL & Reklamasi Lingkungan Tambang Batubara','KEMNAKER RI','5 Hari','penyusun-amdal'],
    ['🔥','Petugas K3 Kebakaran Fasilitas Stockpile Batubara','KEMNAKER RI','5 Hari','pelatihan-petugas-peran-kebakaran-kelas-d-kemnaker-ri'],
    ['📋','Safety Officer SMKP & Auditor SMK3 Pertambangan','BNSP','3 Hari','pelatihan-auditor-smk3-online'],
  ],
  'denpasar' => [
    ['🦺','Ahli K3 Umum (AK3U) Bali & Pariwisata','KEMNAKER RI','3–5 Hari','pelatihan-ahli-k3-umum-sertifikasi-kemnaker-ri'],
    ['🏗️','Ahli Muda K3 Konstruksi Resort & Villa Mewah','KEMNAKER RI','5 Hari','pelatihan-ahli-muda-k3-konstruksi-sertifikasi-kemnaker-ri'],
    ['🔥','Ahli K3 Kebakaran Hotel, Resort & MICE','KEMNAKER RI','5 Hari','pelatihan-petugas-peran-kebakaran-kelas-d-kemnaker-ri'],
    ['⚡','Ahli K3 Listrik Instalasi Hotel & Bandara Ngurah Rai','KEMNAKER RI','5 Hari','pelatihan-ahli-k3-listrik-sertifikasi-kemnaker-ri'],
    ['🏗️','Operator Forklift & Logistik Pariwisata Bali','KEMNAKER RI','3 Hari','pelatihan-k3-operator-forklift-kelas-2-sertifikasi-kemnaker-ri'],
    ['📋','Safety Officer Hospitality & Hygiene Standar Internasional','BNSP','3 Hari','pelatihan-auditor-smk3-online'],
    ['🌿','Penyusun AMDAL Sektor Pariwisata & Konservasi','KEMNAKER RI','5 Hari','penyusun-amdal'],
    ['🛡️','Operator K3 Sertifikasi BNSP Pariwisata','BNSP','3 Hari','pelatihan-operator-k3-sertifikasi-bnsp'],
  ],
  'malang' => [
    ['🦺','Ahli K3 Umum (AK3U) Malang Raya','KEMNAKER RI','3–5 Hari','pelatihan-ahli-k3-umum-sertifikasi-kemnaker-ri'],
    ['🍲','K3 Industri Pangan, Minuman & FMCG','BNSP','3 Hari','ak3-bnsp'],
    ['🏗️','Operator Forklift & Pergudangan Dingin','KEMNAKER RI','3 Hari','pelatihan-k3-operator-forklift-kelas-2-sertifikasi-kemnaker-ri'],
    ['⚡','Ahli K3 Listrik Pabrik & Manufaktur Rokok','KEMNAKER RI','5 Hari','pelatihan-ahli-k3-listrik-sertifikasi-kemnaker-ri'],
    ['🔥','Petugas K3 Penanggulangan Kebakaran Pabrik','KEMNAKER RI','3–5 Hari','pelatihan-petugas-peran-kebakaran-kelas-d-kemnaker-ri'],
    ['🏗️','Ahli K3 Konstruksi Properti & Wisata Malang-Batu','KEMNAKER RI','5 Hari','pelatihan-ahli-muda-k3-konstruksi-sertifikasi-kemnaker-ri'],
    ['📋','Auditor SMK3 Sektor Industri Pengolahan Makanan','BNSP','3 Hari','pelatihan-auditor-smk3-online'],
    ['🌿','Penyusun AMDAL & Pengolahan Limbah Agroindustri','KEMNAKER RI','5 Hari','penyusun-amdal'],
  ],
  'solo' => [
    ['🦺','Ahli K3 Umum (AK3U) Soloraya','KEMNAKER RI','3–5 Hari','pelatihan-ahli-k3-umum-sertifikasi-kemnaker-ri'],
    ['🧵','K3 Industri Tekstil, Garmen & Batik Soloraya','BNSP','3 Hari','ak3-bnsp'],
    ['🏗️','Operator Forklift Pabrik Tekstil & Furnitur','KEMNAKER RI','3 Hari','pelatihan-k3-operator-forklift-kelas-2-sertifikasi-kemnaker-ri'],
    ['🔥','Petugas K3 Kebakaran Pabrik Tekstil & Cetak','KEMNAKER RI','3–5 Hari','pelatihan-petugas-peran-kebakaran-kelas-d-kemnaker-ri'],
    ['⚡','Ahli K3 Listrik Fasilitas Manufaktur Sukoharjo-Boyolali','KEMNAKER RI','5 Hari','pelatihan-ahli-k3-listrik-sertifikasi-kemnaker-ri'],
    ['🧪','Petugas K3 Kimia Pewarna & Industri Tekstil','KEMNAKER RI','3–5 Hari','pelatihan-petugas-k3-kimia-sertifikasi-kemnaker-ri'],
    ['📋','Safety Officer & Auditor SMK3 Industri Soloraya','BNSP','3 Hari','pelatihan-auditor-smk3-online'],
    ['🌿','Penyusun AMDAL & IPAL Industri Tekstil','KEMNAKER RI','5 Hari','penyusun-amdal'],
  ],
  'karawang' => [
    ['🦺','Ahli K3 Umum (AK3U) Karawang Detroit Indonesia','KEMNAKER RI','3–5 Hari','pelatihan-ahli-k3-umum-sertifikasi-kemnaker-ri'],
    ['🚗','K3 Industri Otomotif & Komponen KIIC-Surya Cipta','BNSP','3–5 Hari','ak3-bnsp'],
    ['🏗️','Operator Forklift & Reach Truck Pabrik Otomotif','KEMNAKER RI','3 Hari','pelatihan-k3-operator-forklift-kelas-2-sertifikasi-kemnaker-ri'],
    ['⚡','Ahli K3 Listrik Otomasi Robotik & Perakitan Mobil','KEMNAKER RI','5 Hari','pelatihan-ahli-k3-listrik-sertifikasi-kemnaker-ri'],
    ['🧪','Petugas K3 Kimia Industri Logam & Pengecatan Mobil','KEMNAKER RI','3–5 Hari','pelatihan-petugas-k3-kimia-sertifikasi-kemnaker-ri'],
    ['🔥','Ahli K3 Kebakaran Kawasan Industri Surya Cipta','KEMNAKER RI','5 Hari','pelatihan-petugas-peran-kebakaran-kelas-d-kemnaker-ri'],
    ['📋','Auditor SMK3 PP 50/2012 Tier-1/Tier-2 Otomotif','BNSP','3 Hari','pelatihan-auditor-smk3-online'],
    ['⚙️','Operator Pesawat Tenaga Produksi (PTP) Otomotif','KEMNAKER RI','3 Hari','pelatihan-operator-pesawat-tenaga-produksi-ptp'],
  ],
  'tangerang' => [
    ['🦺','Ahli K3 Umum (AK3U) Tangerang & Banten','KEMNAKER RI','3–5 Hari','pelatihan-ahli-k3-umum-sertifikasi-kemnaker-ri'],
    ['💊','K3 Industri Farmasi & Kosmetik (GMP+K3)','BNSP','3–5 Hari','ak3-bnsp'],
    ['🧪','Ahli K3 Kimia Industri Farmasi & Bahan Aktif','KEMNAKER RI','5 Hari','pelatihan-petugas-k3-kimia-sertifikasi-kemnaker-ri'],
    ['🏗️','Operator Forklift Kawasan Cikupa & Balaraja','KEMNAKER RI','3 Hari','pelatihan-k3-operator-forklift-kelas-2-sertifikasi-kemnaker-ri'],
    ['⚡','Ahli K3 Listrik Fasilitas Manufaktur Tangerang','KEMNAKER RI','5 Hari','pelatihan-ahli-k3-listrik-sertifikasi-kemnaker-ri'],
    ['🔥','Petugas K3 Kebakaran Pabrik Kosmetik & Farmasi','KEMNAKER RI','3–5 Hari','pelatihan-petugas-peran-kebakaran-kelas-d-kemnaker-ri'],
    ['📋','Safety Officer & Auditor SMK3 Industri Kosmetik','BNSP','3 Hari','pelatihan-auditor-smk3-online'],
    ['🌿','AMDAL & Pengelolaan Limbah Kimia/Farmasi B3','KEMNAKER RI','5 Hari','penyusun-amdal'],
  ],
  'bogor' => [
    ['🦺','Ahli K3 Umum (AK3U) Bogor & Sentul','KEMNAKER RI','3–5 Hari','pelatihan-ahli-k3-umum-sertifikasi-kemnaker-ri'],
    ['🥗','K3 Industri Pangan, Agribisnis & Minuman Kemasan','BNSP','3–5 Hari','ak3-bnsp'],
    ['💊','K3 Industri Farmasi & Ekstrak Herbal Sentul','BNSP','3 Hari','pelatihan-operator-k3-sertifikasi-bnsp'],
    ['🏗️','Operator Forklift Pabrik Makanan & Sentul Logistic','KEMNAKER RI','3 Hari','pelatihan-k3-operator-forklift-kelas-2-sertifikasi-kemnaker-ri'],
    ['⚡','Ahli K3 Listrik Fasilitas Pengolahan Makanan','KEMNAKER RI','5 Hari','pelatihan-ahli-k3-listrik-sertifikasi-kemnaker-ri'],
    ['🔥','Petugas K3 Kebakaran Kawasan Industri Sentul-Cibinong','KEMNAKER RI','3–5 Hari','pelatihan-petugas-peran-kebakaran-kelas-d-kemnaker-ri'],
    ['🏗️','Ahli K3 Konstruksi Properti & Infrastruktur Bogor','KEMNAKER RI','5 Hari','pelatihan-ahli-muda-k3-konstruksi-sertifikasi-kemnaker-ri'],
    ['🌿','Penyusun AMDAL Agribisnis & Pengolahan Pangan','KEMNAKER RI','5 Hari','penyusun-amdal'],
  ],
];

$programs = $city_programs_map[$slug] ?? [
  ['🦺','Ahli K3 Umum (AK3U)','KEMNAKER RI','3–5 Hari','pelatihan-ahli-k3-umum-sertifikasi-kemnaker-ri'],
  ['🏗️','Ahli K3 Konstruksi','KEMNAKER RI','5 Hari','pelatihan-ahli-muda-k3-konstruksi-sertifikasi-kemnaker-ri'],
  ['⚡','Ahli K3 Listrik','KEMNAKER RI','5 Hari','pelatihan-ahli-k3-listrik-sertifikasi-kemnaker-ri'],
  ['🔥','Ahli K3 Kebakaran','KEMNAKER RI','5–7 Hari','pelatihan-petugas-peran-kebakaran-kelas-d-kemnaker-ri'],
  ['🏗️','Operator Forklift','KEMNAKER RI','3 Hari','pelatihan-k3-operator-forklift-kelas-2-sertifikasi-kemnaker-ri'],
  ['📋','Safety Officer & Auditor K3','BNSP','3 Hari','pelatihan-auditor-smk3-online'],
  ['🌿','AMDAL A (Penyusun)','KEMNAKER RI','5 Hari','penyusun-amdal'],
  ['⛏️','POP/POM/POU Pertambangan','BNSP','3–5 Hari','pelatihan-pop-pertambangan-sertifikasi-bnsp-online'],
];

$durations = array_map(fn($p) => $p[3], $programs);
$city_type = $c['type'] ?? 'industrial';

// Dynamic photo rotation for the photo strip
$strip_photos = array_slice($gallery_pool, ($curIdx * 2) % (count($gallery_pool) - 4), 4);

// Dynamic Testimonials per city profile
$testimonials = [
  'energy_mining' => [
    ['nama' => 'Bambang Setyawan, S.T.', 'role' => 'HSE Superintendent · Perusahaan Energi', 'text' => "Sertifikasi POP dan Ahli K3 Umum di Wahana Totalita sangat membantu tim kami dalam audit SMKP dan CSMS. Materi sangat aplikatif dan instruktur berpengalaman di sektor tambang & migas."],
    ['nama' => 'Dedy Kurniawan', 'role' => 'Safety Officer · Kontraktor Tambang', 'text' => "Penyelenggaraan kelas online sangat fleksibel untuk kami yang bekerja dengan sistem shift di site. Ujian sertifikasi berjalan lancar dan sertifikat resmi Kemnaker RI terbit tepat waktu."],
    ['nama' => 'Rina Wijayanti', 'role' => 'HSE Coordinator · Industri Pengolahan', 'text' => "Wahana Totalita sangat profesional dalam memfasilitasi in-house training perusahaan kami. Dokumen administrasi, invoice, dan Faktur Pajak lengkap tanpa kendala."],
  ],
  'industrial' => [
    ['nama' => 'Ir. Hendra Pratama', 'role' => 'Plant Manager · Manufaktur Otomotif', 'text' => "Kami mengikutsertakan 15 personel untuk sertifikasi Ahli K3 Listrik & Operator Forklift. Pelatihan in-house disesuaikan langsung dengan layout bahaya pabrik kami di kawasan industri."],
    ['nama' => 'Siti Nurhaliza, S.T.', 'role' => 'EHS Specialist · Industri Farmasi & Kimia', 'text' => "Instruktur sangat kompeten menjelaskan integrasi SMK3 PP 50/2012 dengan regulasi K3 Kimia. Pelayanan ramah, cepat, dan sangat direkomendasikan untuk pembinaan K3 korporasi."],
    ['nama' => 'Aris Munandar', 'role' => 'HSE Officer · Logistik & Pergudangan', 'text' => "Rekomendasi terbaik untuk pelatihan K3. Biaya kompetitif, silabus resmi, dan bimbingan ujian intensif membuat seluruh tim kami lulus 100%."],
  ],
  'urban' => [
    ['nama' => 'Faisal Rahman, S.T.', 'role' => 'Project Safety Engineer · Konstruksi Gedung', 'text' => "Sangat puas dengan pelatihan Ahli K3 Konstruksi dan AK3U Kemnaker RI. Sangat membantu untuk syarat tender proyek LPSE dan kualifikasi kontraktor."],
    ['nama' => 'Dewi Anggraini', 'role' => 'HR & GA Manager · Property & Hospitality', 'text' => "Pendaftaran sangat mudah via WhatsApp. Tim Wahana Totalita mendampingi proses pemberkasan hingga penerbitan SKP resmi tanpa repot."],
    ['nama' => 'Reza Pahlevi', 'role' => 'Fresh Graduate Teknik · Alumni AK3U', 'text' => "Mengikuti kelas online dari rumah dengan jadwal teratur. Sertifikat resmi Kemnaker RI menjadi modal utama saya langsung diterima kerja sebagai safety officer."],
  ],
][$city_type] ?? [];

// Dynamic FAQ generator for on-page display and FAQPage JSON-LD schema
if ($city_type === 'energy_mining') {
  $faq_data = [
    [
      'q' => "Apa saja sertifikasi K3 yang paling banyak dibutuhkan di {$c['name']}?",
      'a' => "Di {$c['name']} dan wilayah {$c['province']}, kebutuhan sertifikasi keselamatan kerja sangat terfokus pada Ahli K3 Umum (AK3U) Kemnaker RI, Pengawas Operasional Pertambangan (POP/POM BNSP), K3 Migas, serta K3 Konstruksi guna memenuhi kualifikasi kerja di sektor {$c['industries']}."
    ],
    [
      'q' => "Berapa rincian biaya pelatihan K3 di {$c['name']}?",
      'a' => "Biaya pelatihan K3 di {$c['name']} sangat fleksibel dan kompetitif, bergantung pada jenis program sertifikasi (Kemnaker RI atau BNSP), metode kelas (online interaktif Zoom atau tatap muka langsung), serta paket in-house training grup untuk korporasi di {$c['name']} dan kawasan terdekat ({$c['nearby']}). Hubungi kami via WhatsApp untuk mendapatkan proposal silabus resmi serta rincian harga penawaran terbaru."
    ],
    [
      'q' => "Berapa lama durasi pelaksanaan pelatihan K3?",
      'a' => "Durasi program berkisar antara " . min($durations) . " hingga " . max($durations) . " tergantung skema kompetensi yang dipilih. Pelatihan teknis dan sertifikasi BNSP umumnya memerlukan waktu 3–5 hari kerja, sementara pembinaan Ahli K3 Umum Kemnaker RI berlangsung intensif dengan kurikulum komprehensif dan evaluasi kelulusan."
    ],
    [
      'q' => "Apakah sertifikat K3 Wahana Totalita diakui resmi di {$c['name']}?",
      'a' => "Ya, seluruh sertifikat diterbitkan resmi oleh Kementerian Ketenagakerjaan RI (KEMNAKER RI) atau Badan Nasional Sertifikasi Profesi (BNSP). Sertifikat ini memiliki keabsahan hukum yang berlaku secara nasional dan memenuhi prasyarat tender LPSE, kualifikasi vendor BUMN, serta audit standar K3 perusahaan di seluruh {$c['province']}."
    ],
    [
      'q' => "Apa saja syarat mendaftar pelatihan K3 bagi peserta dari {$c['name']}?",
      'a' => "Persyaratan umum meliputi salinan KTP, pas foto latar merah, dan salinan ijazah terakhir (minimal SMA/SMK untuk lisensi teknis operator atau minimal D3/S1 untuk sertifikasi Ahli K3 Umum). Seluruh proses pendaftaran dan verifikasi berkas bagi calon peserta dari {$c['name']} dan sekitarnya dapat dilakukan secara online melalui tim representatif kami."
    ],
  ];
} elseif ($city_type === 'industrial') {
  $faq_data = [
    [
      'q' => "Apa saja sertifikasi K3 yang paling banyak dibutuhkan di {$c['name']}?",
      'a' => "Sektor industri dan manufaktur di {$c['name']} dan sekitarnya ({$c['province']}) umumnya mensyaratkan sertifikasi Ahli K3 Umum Kemnaker RI, Operator Forklift & Alat Angkat, Ahli K3 Listrik, K3 Kimia, serta Petugas Penanggulangan Kebakaran untuk mendukung operasional fasilitas pabrik."
    ],
    [
      'q' => "Berapa rincian biaya pelatihan K3 di {$c['name']}?",
      'a' => "Biaya pelatihan K3 di {$c['name']} bervariasi sesuai program sertifikasi (Kemnaker RI atau BNSP), format kelas (webinar interaktif atau praktik tatap muka), serta paket in-house training grup untuk korporasi di {$c['name']} maupun kawasan industrinya ({$c['nearby']}). Hubungi kami via WhatsApp untuk mendapatkan proposal penawaran harga resmi dan silabus terbaru."
    ],
    [
      'q' => "Berapa lama durasi pelaksanaan pelatihan K3?",
      'a' => "Durasi program berkisar antara " . min($durations) . " hingga " . max($durations) . " tergantung bidang keahlian. Program sertifikasi BNSP atau operator teknis umumnya memakan waktu 3–5 hari, sedangkan pembinaan Ahli K3 Umum Kemnaker RI dilaksanakan secara intensif mencakup pemaparan materi regulasi, studi kasus, dan evaluasi pengujian."
    ],
    [
      'q' => "Apakah sertifikat K3 Wahana Totalita diakui resmi di {$c['name']}?",
      'a' => "Ya, seluruh sertifikat diterbitkan resmi oleh Kemnaker RI atau BNSP dengan status legalitas nasional. Sertifikat ini menjadi syarat wajib pemenuhan kualifikasi rekanan CSMS, tender LPSE/BUMN, serta audit sertifikasi SMK3 PP 50/2012 di wilayah {$c['province']}."
    ],
    [
      'q' => "Apa saja syarat mendaftar pelatihan K3 bagi peserta dari {$c['name']}?",
      'a' => "Persyaratan umum mencakup salinan KTP, pas foto latar merah, dan salinan ijazah terakhir (minimal SMA/SMK untuk lisensi teknis operator atau D3/S1 untuk program Ahli K3 Umum). Berkas pendaftaran dari {$c['name']} dan sekitarnya dapat dikirimkan secara daring via WhatsApp tim kami."
    ],
  ];
} else {
  $faq_data = [
    [
      'q' => "Apa saja sertifikasi K3 yang paling banyak dibutuhkan di {$c['name']}?",
      'a' => "Kebutuhan utama di {$c['name']} dan provinsi {$c['province']} mencakup Ahli K3 Umum (AK3U) untuk kepatuhan manajerial gedung/perusahaan, Ahli Muda K3 Konstruksi, Safety Officer BNSP, serta sertifikasi AMDAL lingkungan hidup."
    ],
    [
      'q' => "Berapa rincian biaya pelatihan K3 di {$c['name']}?",
      'a' => "Biaya pelatihan K3 di {$c['name']} bervariasi sesuai skema pelatihan pilihan Anda (online interaktif atau tatap muka terdekat) dan kebutuhan sertifikasi perorangan atau korporasi di {$c['name']} dan kota sekitarnya ({$c['nearby']}). Tim kami siap memberikan rincian proposal harga resmi melalui konsultasi WhatsApp."
    ],
    [
      'q' => "Berapa lama durasi pelaksanaan pelatihan K3?",
      'a' => "Durasi program berkisar antara " . min($durations) . " hingga " . max($durations) . " tergantung spesifikasi pelatihan. Program pembinaan Ahli K3 Umum Kemnaker RI dan sertifikasi BNSP dirancang terstruktur dan padat agar peserta siap lulus uji kompetensi."
    ],
    [
      'q' => "Apakah sertifikat K3 Wahana Totalita diakui resmi di {$c['name']}?",
      'a' => "Ya, sertifikat diterbitkan langsung oleh instansi pembina negara resmi (Kemnaker RI & BNSP) dan diakui penuh untuk kebutuhan tender pemerintah, kepatuhan audit perusahaan, serta pengajuan Surat Keputusan Penunjukan (SKP) Ahli K3 di {$c['province']}."
    ],
    [
      'q' => "Apa saja syarat mendaftar pelatihan K3 bagi peserta dari {$c['name']}?",
      'a' => "Persyaratan cukup dengan salinan identitas KTP, pas foto latar merah, dan ijazah terakhir (minimal SMA/SMK untuk teknis operator atau D3/S1 untuk AK3U). Pendaftaran untuk peserta dari {$c['name']} dan sekitarnya dibuka setiap bulan secara online."
    ],
  ];
}
?><!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?=htmlspecialchars($metaTitle)?></title>
<meta name="description" content="<?=htmlspecialchars($metaDesc)?>">
<link rel="canonical" href="https://wahanatotalita.com/pelatihan-k3-<?=htmlspecialchars($slug)?>/">
<meta property="og:type"        content="website">
<meta property="og:title"       content="<?=htmlspecialchars($metaTitle)?>">
<meta property="og:description" content="<?=htmlspecialchars($metaDesc)?>">
<meta property="og:url"         content="https://wahanatotalita.com/pelatihan-k3-<?=htmlspecialchars($slug)?>/">
<meta property="og:image"       content="https://wahanatotalita.com/assets/img/og-cover.svg">
<meta property="og:locale"      content="id_ID">
<meta name="twitter:card"       content="summary_large_image">
<meta name="twitter:title"      content="<?=htmlspecialchars($metaTitle)?>">
<meta name="twitter:description" content="<?=htmlspecialchars($metaDesc)?>">
<meta name="robots"             content="index,follow">
<meta name="theme-color"        content="#103A5C">
<link rel="icon" type="image/png" sizes="32x32" href="/assets/img/favicon-32.png">

<!-- JSON-LD: LocalBusiness & EducationalOrganization Schema -->
<script type="application/ld+json"><?=json_encode([
  '@context'   => 'https://schema.org',
  '@type'      => 'LocalBusiness',
  'name'       => "Wahana Totalita Konsultan - Pelatihan K3 {$c['name']}",
  'image'      => 'https://wahanatotalita.com/assets/img/og-cover.svg',
  'url'        => "https://wahanatotalita.com/pelatihan-k3-{$slug}/",
  'telephone'  => '+62877-5915-1278',
  'priceRange' => '$$',
  'description'=> "Pusat lembaga pelatihan K3 resmi dan sertifikasi Ahli K3 Umum Kemnaker RI & BNSP di {$c['name']}, {$c['province']}.",
  'address'    => [
    '@type'          => 'PostalAddress',
    'streetAddress'  => 'Jl. Wonosari No.km 8.5, Gandu, Sendangtirto, Berbah',
    'addressLocality'=> 'Sleman',
    'addressRegion'  => 'Daerah Istimewa Yogyakarta',
    'postalCode'     => '55573',
    'addressCountry' => 'ID'
  ],
  'areaServed' => [
    ['@type' => 'City', 'name' => $c['name']],
    ['@type' => 'AdministrativeArea', 'name' => $c['province']]
  ],
  'aggregateRating' => [
    '@type'       => 'AggregateRating',
    'ratingValue' => '4.9',
    'reviewCount' => '485',
    'bestRating'  => '5',
    'worstRating' => '1'
  ],
  'hasOfferCatalog' => [
    '@type' => 'OfferCatalog',
    'name'  => "Program Pelatihan K3 {$c['name']}",
    'itemListElement' => array_map(fn($p,int $i) => [
      '@type'  => 'Offer',
      'position' => $i+1,
      'name'   => $p[1],
      'description' => "Sertifikasi {$p[2]} — durasi {$p[3]} di {$c['name']}",
    ], $programs, array_keys($programs)),
  ],
], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES)?></script>

<!-- JSON-LD: Course Schema List -->
<script type="application/ld+json"><?=json_encode([
  '@context' => 'https://schema.org',
  '@type' => 'ItemList',
  'name' => "Daftar Kursus dan Sertifikasi K3 di {$c['name']}",
  'itemListElement' => array_map(fn($p, int $i) => [
    '@type' => 'ListItem',
    'position' => $i + 1,
    'item' => [
      '@type' => 'Course',
      'name' => "Pelatihan & Sertifikasi {$p[1]} {$c['name']}",
      'description' => "Program sertifikasi resmi {$p[2]} durasi {$p[3]} untuk profesional & perusahaan di {$c['name']}, {$c['province']}.",
      'provider' => [
        '@type' => 'Organization',
        'name' => 'Wahana Totalita Konsultan',
        'sameAs' => 'https://wahanatotalita.com'
      ],
      'hasCourseInstance' => [
        [
          '@type' => 'CourseInstance',
          'courseMode' => 'Online',
          'location' => 'Virtual Class Zoom Interaktif'
        ],
        [
          '@type' => 'CourseInstance',
          'courseMode' => 'Onsite',
          'location' => "Training Center & In-House di {$c['name']}"
        ]
      ],
      'educationalCredentialAwarded' => "Sertifikat Resmi {$p[2]}"
    ]
  ], $programs, array_keys($programs))
], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES)?></script>

<!-- JSON-LD: BreadcrumbList Schema -->
<script type="application/ld+json"><?=json_encode([
  '@context' => 'https://schema.org',
  '@type' => 'BreadcrumbList',
  'itemListElement' => [
    [
      '@type' => 'ListItem',
      'position' => 1,
      'name' => 'Beranda',
      'item' => 'https://wahanatotalita.com/'
    ],
    [
      '@type' => 'ListItem',
      'position' => 2,
      'name' => "Pelatihan K3 {$c['name']}",
      'item' => "https://wahanatotalita.com/pelatihan-k3-{$slug}/"
    ]
  ]
], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES)?></script>

<!-- JSON-LD: FAQPage Schema for Rich Snippets -->
<script type="application/ld+json"><?=json_encode([
  '@context' => 'https://schema.org',
  '@type' => 'FAQPage',
  'mainEntity' => array_map(fn($faq) => [
    '@type' => 'Question',
    'name' => $faq['q'],
    'acceptedAnswer' => [
      '@type' => 'Answer',
      'text' => $faq['a']
    ]
  ], $faq_data)
], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES)?></script>

<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','<?=$gtm_id?>');</script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preload" as="style" href="<?= theme_font_url($s) ?>">
<link rel="stylesheet" href="<?= theme_font_url($s) ?>" media="print" onload="this.media='all'">
<noscript>
  <link rel="stylesheet" href="<?= theme_font_url($s) ?>">
</noscript>

<style><?php
$_core_css_file = __DIR__ . '/assets/css/core.min.css';
if (is_file($_core_css_file)) {
    readfile($_core_css_file);
} else {
    readfile(__DIR__ . '/assets/css/tokens.css');
    readfile(__DIR__ . '/assets/css/core.css');
}
?></style>
<?= theme_css_vars($s) ?>
<link rel="stylesheet" href="<?= asset_v('/assets/css/components.min.css') ?>" media="print" onload="this.media='all'">
<noscript>
  <link rel="stylesheet" href="<?= asset_v('/assets/css/components.min.css') ?>">
</noscript>
<link rel="stylesheet" href="<?= asset_v('/assets/css/page/kota.min.css') ?>">
</head>
<body>
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?=$gtm_id?>" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

<?php require __DIR__ . '/includes/navbar.php'; ?>

<section class="hero">
  <div class="container">
    <?php
    $breadcrumb_trail = [
      ['label' => 'Beranda', 'url' => '/'],
      ['label' => 'K3 ' . $c['name'], 'url' => null],
    ];
    include __DIR__ . '/includes/breadcrumb.php';
    ?>

    <?php if ($slug === 'surabaya'): ?>
    <div class="sibling-alert">
      💡 <strong>Program Khusus Wilayah Surabaya:</strong> Tersedia juga kelas spesialisasi <a href="/pelatihan/tkbt-ii-surabaya/">Tenaga Kerja Bangunan Tinggi (TKBT II Surabaya)</a> dengan jadwal rutin dan sertifikasi resmi Kemnaker RI.
    </div>
    <?php elseif ($slug === 'yogyakarta'): ?>
    <div class="sibling-alert">
      💡 <strong>Pusat Training Center Resmi:</strong> Yogyakarta merupakan basis training center Wahana Totalita. Cek langsung <a href="/jadwal/">Jadwal Pelatihan Tatap Muka &amp; Online Terdekat</a> untuk pendaftaran kelas reguler.
    </div>
    <?php endif; ?>

    <div class="hero-inner">
      <div>
        <div class="hero-eyebrow">📍 <?=htmlspecialchars($c['name'])?>, <?=htmlspecialchars($c['province'])?> · Pendaftaran Batch <?=htmlspecialchars($current_month)?> <?=htmlspecialchars($year)?> Dibuka</div>
        <h1>Pelatihan &amp; Sertifikasi <em>K3 <?=htmlspecialchars($c['name'])?></em> <?=htmlspecialchars($year)?> Resmi Kemnaker RI &amp; BNSP</h1>
        <p>Lembaga pembinaan K3 resmi terdekat bagi tenaga kerja dan perusahaan di wilayah <?=htmlspecialchars($c['name'])?> serta provinsi <?=htmlspecialchars($c['province'])?>. Melayani sertifikasi Ahli K3 Umum, K3 Konstruksi, K3 Listrik, K3 Migas, dan Operator berlisensi nasional.</p>
        <div class="hero-btns">
          <a href="<?=$wa?>" target="_blank" rel="noopener" class="btn-wa">💬 Cek Biaya &amp; Daftar via WhatsApp</a>
          <a href="#biaya-jadwal" class="btn-sec">Lihat Biaya &amp; Jadwal ↓</a>
        </div>
        <div class="hero-badges">
          <span>✅ Sertifikat KEMNAKER RI</span>
          <span>✅ Sertifikasi BNSP Resmi</span>
          <span>✅ In-House Training Korporasi</span>
        </div>
      </div>
      <div class="hero-img-wrap">
        <img src="<?=htmlspecialchars($c['img'])?>" alt="Dokumentasi Pelatihan K3 Wahana Totalita di <?=htmlspecialchars($c['name'])?>" width="380" height="285" loading="eager" fetchpriority="high">
        <div class="hero-img-caption">Dokumentasi Pelatihan &amp; Sertifikasi K3 Wahana Totalita</div>
      </div>
    </div>
  </div>
</section>

<div class="trust-bar">
  <div class="container inner">
    <span class="trust-item">KEMNAKER RI</span><span class="trust-sep">·</span>
    <span class="trust-item">BNSP</span><span class="trust-sep">·</span>
    <span class="trust-item">KLHK</span><span class="trust-sep">·</span>
    <span class="trust-item">Standar CSMS &amp; Tender BUMN</span>
  </div>
</div>

<section class="section" id="biaya-jadwal">
  <div class="container">
    <h2>Biaya dan Harga Pelatihan K3 di <?=htmlspecialchars($c['name'])?> &amp; <?=htmlspecialchars($c['province'])?></h2>
    <p class="lead">Pilihan program sertifikasi KEMNAKER RI &amp; BNSP resmi dengan biaya transparan, silabus berstandar nasional, dan jadwal rutin setiap bulan di <?=htmlspecialchars($c['name'])?>.</p>

    <!-- Lead Hunter Quick Quote Calculator Widget -->
    <div class="lead-calculator">
      <h3>⚡ Kalkulator Biaya &amp; Jadwal Pelatihan K3 <?=htmlspecialchars($c['name'])?></h3>
      <p>Pilih program sertifikasi yang Anda butuhkan untuk mendapatkan estimasi jadwal terdekat dan proposal rincian biaya resmi langsung via WhatsApp.</p>
      <form onsubmit="return handleCalcSubmit(event)">
        <div class="calc-grid">
          <div class="calc-field">
            <label for="calc-prog">Pilihan Program Pelatihan:</label>
            <select id="calc-prog">
              <?php foreach($programs as $p): ?>
              <option value="<?=$p[1]?>"><?=$p[1]?> (<?=$p[2]?>)</option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="calc-field">
            <label for="calc-type">Kategori Peserta / Perusahaan:</label>
            <select id="calc-type">
              <option value="Perorangan / Profesional Mandiri">Perorangan / Profesional Mandiri</option>
              <option value="Fresh Graduate (Online Zoom)">Fresh Graduate (Online Zoom)</option>
              <option value="Rombongan Perusahaan / In-House">Rombongan Perusahaan / In-House Training</option>
            </select>
          </div>
          <button type="submit" class="calc-btn">💬 Dapatkan Penawaran Cepat →</button>
        </div>
      </form>
    </div>

    <!-- Pilihan Metode: Online vs Tatap Muka -->
    <div class="method-grid">
      <div class="method-card" data-reveal="up" data-reveal-delay="1">
        <h3>💻 Pelatihan K3 Online (Webinar Zoom)</h3>
        <p>Solusi hemat biaya dan waktu bagi peserta di <?=htmlspecialchars($c['name'])?> dan <?=htmlspecialchars($c['province'])?>. Belajar interaktif langsung bersama trainer praktisi dari mana saja.</p>
        <ul>
          <li>✅ Jadwal rutin mingguan &amp; bulanan</li>
          <li>✅ Modul digital, e-book regulasi, &amp; rekaman materi</li>
          <li>✅ Ujian online resmi berlisensi Kemnaker/BNSP</li>
        </ul>
        <a href="https://wa.me/<?=$wa_number?>?text=<?=rawurlencode("Halo Wahana Totalita, saya ingin daftar Pelatihan K3 Online untuk wilayah {$c['name']}")?>" target="_blank" rel="noopener" style="font-weight:700;font-size:13.5px;color:#063b22">Tanya Kelas Online →</a>
      </div>
      <div class="method-card" data-reveal="up" data-reveal-delay="2">
        <h3>🏢 Pelatihan Tatap Muka &amp; In-House</h3>
        <p>Praktek langsung dan simulasi studi kasus di fasilitas training center kami atau langsung di lokasi pabrik/kantor perusahaan Anda di <?=htmlspecialchars($c['name'])?>.</p>
        <ul>
          <li>✅ Praktik alat angkut, listrik, &amp; simulasi tanggap darurat</li>
          <li>✅ Penyesuaian materi dengan bahaya lokal <?=htmlspecialchars($c['name'])?></li>
          <li>✅ Faktur Pajak &amp; invoice resmi korporasi</li>
        </ul>
        <a href="https://wa.me/<?=$wa_number?>?text=<?=rawurlencode("Halo Wahana Totalita, saya ingin info Pelatihan K3 Tatap Muka / In-House di {$c['name']}")?>" target="_blank" rel="noopener" style="font-weight:700;font-size:13.5px;color:#063b22">Tanya Kelas Tatap Muka →</a>
      </div>
    </div>

    <div class="programs-grid" id="program">
      <?php foreach($programs as $p_idx => $p): ?>
      <div class="prog-card" data-reveal="up" data-reveal-delay="<?= ($p_idx % 4) + 1 ?>">
        <div class="prog-icon"><?=$p[0]?></div>
        <div class="prog-body">
          <h3><?=$p[1]?></h3>
          <div class="prog-meta">
            <span class="badge badge-g"><?=$p[2]?></span>
            <span class="badge badge-o"><?=$p[3]?></span>
          </div>
          <div class="prog-actions">
            <a href="https://wahanatotalita.com/pelatihan/<?=$p[4]?>" class="detail">Detail Program →</a>
            <a href="https://wa.me/<?=$wa_number?>?text=<?=rawurlencode("Halo Wahana Totalita, saya ingin daftar {$p[1]} di {$c['name']}")?>" target="_blank" rel="noopener" class="daftar">Daftar</a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section section-alt">
  <div class="container">
    <div class="about-grid">
      <div class="about-content">
        <?php if ($city_type === 'energy_mining'): ?>
        <h2>Kepatuhan Regulasi &amp; Kebutuhan Ahli K3 Pertambangan di <?=htmlspecialchars($c['name'])?></h2>
        <p><?=htmlspecialchars($c['demand'])?></p>
        <p>Berdasarkan <strong>UU No. 1 Tahun 1970</strong> serta regulasi Kepmen ESDM dan Kemenaker terkait keselamatan operasi industri berisiko tinggi, perusahaan yang bergerak di sektor energi dan pertambangan di <?=htmlspecialchars($c['name'])?> diwajibkan menempatkan personel K3 tersertifikasi (Ahli K3 Umum, POP/POM Pertambangan, hingga K3 Migas) guna mencegah kecelakaan fatal serta menjaga kelancaran operasional.</p>
        <?php elseif ($city_type === 'industrial'): ?>
        <h2>Kepatuhan SMK3 &amp; Kebutuhan Ahli K3 Manufaktur di <?=htmlspecialchars($c['name'])?></h2>
        <p><?=htmlspecialchars($c['demand'])?></p>
        <p>Sesuai <strong>PP No. 50 Tahun 2012</strong> tentang Penerapan SMK3 dan <strong>UU No. 1 Tahun 1970</strong>, setiap pabrik dan kawasan industri di <?=htmlspecialchars($c['name'])?> dengan pekerja di atas 100 orang atau memiliki potensi bahaya tinggi wajib memiliki Ahli K3 Umum bersertifikat Kemnaker RI untuk memimpin sistem manajemen keselamatan kerja terintegrasi.</p>
        <?php else: ?>
        <h2>Standar Keselamatan Kerja &amp; Kebutuhan Sertifikasi K3 di <?=htmlspecialchars($c['name'])?></h2>
        <p><?=htmlspecialchars($c['demand'])?></p>
        <p>Ketentuan regulasi K3 nasional mewajibkan setiap fasilitas usaha berkapasitas besar, proyek konstruksi, dan sentra bisnis di <?=htmlspecialchars($c['name'])?> memiliki petugas K3 bersertifikat legal guna menjamin kepatuhan audit perizinan, keselamatan karyawan, serta perlindungan aset perusahaan.</p>
        <?php endif; ?>

        <h3>Perusahaan &amp; Klaster Industri di <?=htmlspecialchars($c['name'])?></h3>
        <p>Aktivitas ekonomi utama di <?=htmlspecialchars($c['name'])?> dan provinsi <?=htmlspecialchars($c['province'])?> didorong oleh sektor <?=htmlspecialchars($c['industries'])?>, seperti keberadaan korporasi <?=htmlspecialchars($c['companies'])?>. Standardisasi kualifikasi HSE menjadi prasyarat mutlak dalam rantai pasok dan tender di sektor-sektor ini.</p>
      </div>
      <div>
        <div class="stats-row">
          <div class="stat-box"><strong>1.200+</strong><span>Alumni K3</span></div>
          <div class="stat-box"><strong>40+</strong><span>Program</span></div>
          <div class="stat-box"><strong>Resmi</strong><span>KEMNAKER &amp; BNSP</span></div>
        </div>
        <div style="margin-top:20px;background:#fff;border:1px solid #e5ede8;border-radius:14px;padding:22px;box-shadow:0 1px 4px rgba(0,0,0,.04)">
          <h4 style="font-weight:700;color:#063b22;margin-bottom:12px;font-size:15.5px">📅 Jadwal Pelatihan K3 <?=htmlspecialchars($c['name'])?> Bulan <?=htmlspecialchars($current_month)?> <?=htmlspecialchars($year)?></h4>
          <p style="font-size:13.5px;color:#555;margin-bottom:14px;line-height:1.6">Pilihan kelas online interaktif via Zoom tersedia setiap bulan bagi peserta dari <?=htmlspecialchars($c['name'])?> dan sekitarnya. Pelatihan tatap muka dan in-house training perusahaan juga dapat dijadwalkan.</p>
          <a href="/jadwal/" style="display:block;background:#063b22;color:#fff;padding:12px;border-radius:10px;text-align:center;font-weight:700;font-size:14px">Lihat Jadwal &amp; Biaya Lengkap →</a>
        </div>
      </div>
    </div>

    <!-- Structured Compliance & Regulation Matrix Table -->
    <div class="compliance-table-wrap">
      <table class="compliance-table">
        <thead>
          <tr>
            <th>Dasar Regulasi</th>
            <th>Ketentuan Kepatuhan</th>
            <th>Sertifikasi K3 Terkait</th>
            <th>Manfaat untuk Perusahaan di <?=htmlspecialchars($c['name'])?></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><strong>UU No. 1 Tahun 1970</strong></td>
            <td>Perusahaan ≥ 100 tenaga kerja atau risiko bahaya tinggi wajib memiliki P2K3</td>
            <td>Ahli K3 Umum (AK3U) Kemnaker RI</td>
            <td>Legalitas operasional &amp; syarat wajib audit ketenagakerjaan</td>
          </tr>
          <tr>
            <td><strong>PP No. 50 Tahun 2012</strong></td>
            <td>Penerapan Sistem Manajemen K3 (SMK3) terintegrasi</td>
            <td>Auditor SMK3 PP 50 / Safety Officer</td>
            <td>Kualifikasi lolos tender BUMN, CSMS, &amp; sertifikasi SMK3 emas</td>
          </tr>
          <tr>
            <td><strong>Permenaker No. 08/2020</strong></td>
            <td>Kewajiban lisensi K3 untuk operator Pesawat Angkat &amp; Angkut</td>
            <td>Operator Forklift, Crane &amp; Rigger</td>
            <td>Mencegah kecelakaan fatal logistik gudang &amp; fasilitas pabrik</td>
          </tr>
          <tr>
            <td><strong>Permenaker No. 12/2015</strong></td>
            <td>Standar keselamatan instalasi &amp; sistem kelistrikan industri</td>
            <td>Ahli K3 Listrik / Teknisi K3 Listrik</td>
            <td>Perlindungan aset peralatan, mitigasi korsleting, &amp; proteksi petir</td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Corporate In-House Training B2B Feature Box -->
    <div class="corporate-box">
      <h3>🏢 Solusi In-House Training &amp; Sertifikasi Perusahaan di <?=htmlspecialchars($c['name'])?></h3>
      <p>Wahana Totalita menyediakan program pembinaan dan sertifikasi in-house yang disesuaikan secara khusus dengan proses bisnis, potensi bahaya (HIRA/IBPR), serta kebijakan operasional perusahaan Anda di <?=htmlspecialchars($c['name'])?>.</p>
      <div class="corporate-features">
        <div class="corporate-feat-item">
          <strong>📑 Faktur Pajak &amp; Legalitas Lengkap</strong>
          Pemberkasan resmi, invoice perusahaan, dan penerbitan Faktur Pajak resmi untuk BUMN &amp; swasta.
        </div>
        <div class="corporate-feat-item">
          <strong>🎯 Materi Kustom Lokasi Kerja</strong>
          Simulasi bahaya dan studi kasus disesuaikan langsung dengan lingkungan kerja di <?=htmlspecialchars($c['name'])?>.
        </div>
        <div class="corporate-feat-item">
          <strong>⏱️ Jadwal Fleksibel Perusahaan</strong>
          Waktu pelatihan disesuaikan dengan rotasi shift operasional pabrik atau jadwal proyek Anda.
        </div>
      </div>
      <a href="https://wa.me/<?=$wa_number?>?text=<?=rawurlencode("Halo Wahana Totalita, saya ingin penawaran In-House Training K3 untuk perusahaan di {$c['name']}")?>" target="_blank" rel="noopener" class="btn-wa">Minta Proposal &amp; Penawaran In-House Training →</a>
    </div>

  </div>
</section>

<!-- Comparison Table: Why Wahana Totalita is the Best Choice -->
<section class="section">
  <div class="container">
    <h2>Perbandingan Lembaga Pelatihan K3 Terbaik di <?=htmlspecialchars($c['name'])?></h2>
    <p class="lead">Mengapa ribuan profesional dan perusahaan di <?=htmlspecialchars($c['name'])?> mempercayakan sertifikasi K3 kepada Wahana Totalita Konsultan.</p>
    <div class="comparison-table-wrap">
      <table class="comparison-table">
        <thead>
          <tr>
            <th>Faktor Evaluasi</th>
            <th class="col-wt">Wahana Totalita Konsultan</th>
            <th class="col-other">Lembaga Pelatihan Lain</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><strong>Legalitas &amp; Akreditasi</strong></td>
            <td class="col-wt">✅ Resmi Kemnaker RI, BNSP, &amp; KLHK</td>
            <td class="col-other">Sebagian hanya sertifikat internal</td>
          </tr>
          <tr>
            <td><strong>Metode Pembelajaran</strong></td>
            <td class="col-wt">✅ Online Zoom Interaktif, Offline &amp; In-House</td>
            <td class="col-other">Metode kaku tanpa opsi online</td>
          </tr>
          <tr>
            <td><strong>Faktur Pajak &amp; Legalitas B2B</strong></td>
            <td class="col-wt">✅ Penerbitan Faktur Pajak &amp; Invoice Resmi</td>
            <td class="col-other">Sering tidak lengkap untuk korporasi</td>
          </tr>
          <tr>
            <td><strong>Garansi Kelulusan &amp; Remedial</strong></td>
            <td class="col-wt">✅ Bimbingan Asesmen Intensif 100% Lulus</td>
            <td class="col-other">Biaya tambahan untuk ujian ulang</td>
          </tr>
          <tr>
            <td><strong>Layanan Pasca Pelatihan</strong></td>
            <td class="col-wt">✅ Bantuan Perpanjangan SKP &amp; Lisensi K3</td>
            <td class="col-other">Tidak ada pendampingan lanjutan</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

<!-- 4-Step Certification Process Flow -->
<section class="section section-alt">
  <div class="container">
    <h2>Alur Pendaftaran &amp; Sertifikasi K3 <?=htmlspecialchars($c['name'])?></h2>
    <p class="lead">4 langkah mudah memperoleh sertifikat resmi KEMNAKER RI &amp; BNSP tanpa prosedur berbelit.</p>
    <div class="process-grid">
      <div class="process-step" data-reveal="up" data-reveal-delay="1">
        <div class="step-num">1</div>
        <h4>Konsultasi Program</h4>
        <p>Diskusikan kebutuhan pelatihan personal atau tim perusahaan dengan tim konsultan kami via WhatsApp.</p>
      </div>
      <div class="process-step" data-reveal="up" data-reveal-delay="2">
        <div class="step-num">2</div>
        <h4>Registrasi &amp; Berkas</h4>
        <p>Pengiriman salinan KTP, ijazah terakhir, dan pas foto secara online tanpa perlu datang langsung.</p>
      </div>
      <div class="process-step" data-reveal="up" data-reveal-delay="3">
        <div class="step-num">3</div>
        <h4>Pembinaan &amp; Praktik</h4>
        <p>Mengikuti sesi teori regulasi, studi kasus bahaya kerja, dan simulasi pengujian bersama instruktur ahli.</p>
      </div>
      <div class="process-step" data-reveal="up" data-reveal-delay="4">
        <div class="step-num">4</div>
        <h4>Penerbitan Lisensi Sah</h4>
        <p>Sertifikat resmi Kemnaker RI / BNSP dan lisensi Surat Keputusan Penunjukan (SKP) terbit sah berlaku nasional.</p>
      </div>
    </div>
  </div>
</section>

<!-- Testimonials Section -->
<?php if (!empty($testimonials)): ?>
<section class="section">
  <div class="container">
    <h2>Testimoni Alumni Pelatihan K3 <?=htmlspecialchars($c['name'])?></h2>
    <p class="lead">Pengalaman nyata para praktisi HSE, engineer, dan manajer perusahaan yang telah tersertifikasi.</p>
    <div class="testimonials-grid">
      <?php foreach($testimonials as $t_idx => $t): ?>
      <div class="testi-card" data-reveal="up" data-reveal-delay="<?= ($t_idx % 4) + 1 ?>">
        <div>
          <div class="testi-stars">★★★★★</div>
          <p class="testi-text">"<?=htmlspecialchars($t['text'])?>"</p>
        </div>
        <div class="testi-author">
          <strong><?=htmlspecialchars($t['nama'])?></strong>
          <span><?=htmlspecialchars($t['role'])?> di <?=htmlspecialchars($c['name'])?></span>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<section class="gallery-strip">
  <div class="container">
    <div style="display:flex;justify-content:space-between;align-items:flex-end;flex-wrap:wrap;gap:12px;margin-bottom:16px">
      <div>
        <h2>Dokumentasi Pelatihan &amp; Sertifikasi K3</h2>
        <p style="color:#666;font-size:14.5px">Dokumentasi nyata kegiatan pembinaan K3, praktik simulasi darurat, dan uji kompetensi Wahana Totalita.</p>
      </div>
      <a href="/galeri/" style="font-weight:700;color:#063b22;font-size:14px">Lihat Semua Foto Galeri →</a>
    </div>
    <div class="gallery-strip-grid">
      <?php foreach($strip_photos as $sp): ?>
      <div class="gallery-strip-item">
        <img src="<?=htmlspecialchars($sp)?>" alt="Dokumentasi Sertifikasi K3" width="280" height="210" loading="lazy">
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <h2>Mengapa Memilih Pembinaan K3 di Wahana Totalita</h2>
    <p class="lead">Solusi terpercaya bagi profesional dan perusahaan dalam pemenuhan sertifikasi keselamatan kerja resmi.</p>
    <div class="why-grid">
      <?php
      if ($city_type === 'energy_mining') {
        $why_cards = [
          ['🏛️', 'Lisensi Sah Kemnaker RI & BNSP', 'Sertifikat resmi yang diterbitkan memenuhi seluruh standar kualifikasi kontraktor CSMS, audit ESDM/Ketenagakerjaan, serta tender sektor energi di '.$c['name'].'.'],
          ['🎓', 'Instruktur Senior Praktisi Industri', 'Materi dibimbing langsung oleh instruktur berpengalaman di bidang '.$c['industries'].' dengan studi kasus risiko tinggi di lapangan.'],
          ['💻', 'Fleksibilitas Kelas Online & Training Center', 'Peserta dari '.$c['name'].' dan area terdekat ('.$c['nearby'].') dapat mengikuti kelas daring intensif tanpa terkendala jarak operasi site.'],
          ['🏢', 'In-House Training di Site Perusahaan', 'Penyelenggaraan pelatihan eksklusif di lokasi perusahaan atau fasilitas operasional Anda di '.$c['name'].' dengan kurikulum kustom.'],
          ['📋', 'Kelengkapan Modul Uji Kompetensi', 'Peserta dibekali modul ajar terstandar, simulasi uji kompetensi asesmen BNSP/Kemnaker, dan pendampingan hingga kelulusan.'],
          ['♻️', 'Layanan Perpanjangan Lisensi & SKP', 'Dukungan menyeluruh bagi alumni di '.$c['province'].' untuk proses perpanjangan Surat Keputusan Penunjukan (SKP) dan lisensi K3 berkala.'],
        ];
      } elseif ($city_type === 'industrial') {
        $why_cards = [
          ['🏛️', 'Lembaga Pembinaan K3 Resmi Berlisensi', 'Menyelenggarakan pembinaan K3 terakreditasi untuk mendukung pemenuhan audit SMK3 dan kepatuhan pabrik manufaktur di wilayah '.$c['name'].'.'],
          ['🎓', 'Kurikulum Berorientasi Industri Nyata', 'Disusun khusus menjawab tantangan keselamatan kerja pada sektor '.$c['industries'].' yang berkembang di kawasan '.$c['name'].'.'],
          ['💻', 'Pilihan Metode Online & Tatap Muka', 'Fleksibilitas jadwal bagi staf pabrik dari '.$c['name'].' maupun klaster industri sekitarnya ('.$c['nearby'].') via live interactive zoom.'],
          ['🏢', 'In-House Training Pabrik & Kawasan', 'Pelatihan kelompok di pabrik Anda di '.$c['name'].' dengan simulasi bahaya mesin, listrik, dan tanggap darurat industri.'],
          ['📋', 'Sertifikat Diakui Rekanan & Auditor', 'Dokumen lisensi K3 resmi yang menjadi syarat wajib seleksi vendor, verifikasi CSMS, dan penilaian kinerja keselamatan kerja.'],
          ['♻️', 'Konsultasi K3 & Resertifikasi Berkelanjutan', 'Layanan purna pelatihan untuk perpanjangan masa berlaku lisensi K3 dan pembaruan regulasi ketenagakerjaan di '.$c['province'].'.'],
        ];
      } else {
        $why_cards = [
          ['🏛️', 'Sertifikasi Terakreditasi Nasional', 'Sertifikat sah Kemnaker RI dan BNSP yang diakui instansi pemerintah, BUMN, dan korporasi swasta di '.$c['name'].' dan seluruh Indonesia.'],
          ['🎓', 'Trainer Praktisi & Asesor Berlisensi', 'Dipandu narasumber ahli yang mendalam menguasai implementasi K3 pada sektor '.$c['industries'].' di area '.$c['name'].'.'],
          ['💻', 'Akses Pembelajaran Fleksibel', 'Kemudahan belajar daring dengan materi praktis bagi peserta perorangan maupun korporasi di '.$c['name'].' serta kota tetangga ('.$c['nearby'].').'],
          ['🏢', 'In-House Training Khusus Korporasi', 'Modul pelatihan disesuaikan dengan jenis fasilitas kerja, gedung komersial, maupun lokasi proyek di '.$c['name'].'.'],
          ['📋', 'Proses Pendaftaran Cepat & Mudah', 'Konsultasi gratis, pendaftaran 100% online, serta asistensi pemberkasan administratif tanpa prosedur berbelit.'],
          ['♻️', 'Pendampingan Karir & Alumni K3', 'Jejaring alumni K3 aktif di '.$c['province'].' serta bantuan perpanjangan SKP Ahli K3 saat masa berlaku berakhir.'],
        ];
      }

      foreach($why_cards as $w_idx => $w): ?>
      <div class="why-card" data-reveal="up" data-reveal-delay="<?= ($w_idx % 4) + 1 ?>">
        <div class="why-icon"><?=$w[0]?></div>
        <h4><?=$w[1]?></h4>
        <p><?=$w[2]?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section section-alt">
  <div class="container">
    <h2>Layanan Lembaga Pelatihan K3 Terdekat di <?=htmlspecialchars($c['name'])?> &amp; <?=htmlspecialchars($c['province'])?></h2>
    <p class="lead">Selain menjangkau pusat bisnis <?=htmlspecialchars($c['name'])?>, kami juga memfasilitasi kebutuhan sertifikasi personel untuk kawasan sekitarnya:</p>
    <div class="nearby-list">
      <?php foreach(explode(', ', $c['nearby']) as $nb): ?>
      <span class="nearby-tag">📍 <?=htmlspecialchars(trim($nb))?></span>
      <?php endforeach; ?>
    </div>
    <p style="margin-top:20px;font-size:15px;color:#555">Melalui sistem blended learning, para profesional di seluruh Indonesia dapat mengakses pelatihan berkualitas tinggi secara efisien.</p>
    <?php if (!empty($ringCities)): ?>
    <div class="related-cities">
      <span class="rc-label">Pelatihan K3 di Kota Lain:</span>
      <?php foreach ($ringCities as $rk): ?>
      <a href="/pelatihan-k3-<?=$rk?>/">Pelatihan K3 <?=htmlspecialchars($cities[$rk]['name'])?></a>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
  </div>
</section>

<section class="faq-section" id="faq">
  <div class="container">
    <h2>Pertanyaan Umum Seputar Biaya &amp; Pelatihan K3 <?=htmlspecialchars($c['name'])?></h2>
    <div class="faq-list">
      <?php foreach($faq_data as $fi => $faq): ?>
      <div class="faq-item" data-reveal="up" data-reveal-delay="<?= ($fi % 4) + 1 ?>">
        <h3><?=htmlspecialchars($faq['q'])?></h3>
        <p><?=htmlspecialchars($faq['a'])?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="cta-box">
      <h2>Siap Daftar Pelatihan K3 di <?=htmlspecialchars($c['name'])?>?</h2>
      <p>Dapatkan jadwal terdekat, rincian biaya penawaran resmi, silabus lengkap, dan konsultasi gratis pemilihan program sertifikasi yang tepat untuk kebutuhan personal maupun perusahaan Anda.</p>
      <a href="<?=$wa?>" target="_blank" rel="noopener" class="cta-btn">💬 Hubungi via WhatsApp Sekarang</a>
      <p style="margin-top:16px;font-size:14px;opacity:.85">WhatsApp: 0877-5915-1278 · Email: info@wahanatotalita.com</p>
    </div>
  </div>
</section>

<!-- Sticky Lead-Hunter Bottom Bar for Mobile Devices -->
<div class="sticky-mobile-bar">
  <div class="inner">
    <a href="<?=$wa?>" target="_blank" rel="noopener" class="sticky-btn-wa">💬 Tanya Biaya &amp; Jadwal via WA</a>
    <a href="/jadwal/" class="sticky-btn-schedule">📅 Jadwal</a>
  </div>
</div>

<script>
function handleCalcSubmit(e) {
  e.preventDefault();
  var prog = document.getElementById('calc-prog').value;
  var type = document.getElementById('calc-type').value;
  var city = "<?=htmlspecialchars($c['name'])?>";
  var text = "Halo Wahana Totalita, saya ingin informasi biaya, jadwal terdekat, dan penawaran untuk program " + prog + " kategori " + type + " di " + city + ".";
  window.open("https://wa.me/<?=$wa_number?>?text=" + encodeURIComponent(text), "_blank");
  return false;
}
</script>

<?php require __DIR__ . '/includes/footer.php'; ?>
<?php require __DIR__ . '/includes/scripts.php'; ?>
</body>
</html>
