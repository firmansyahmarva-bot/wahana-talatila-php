<?php
/**
 * k3-manufaktur.php — Hub Page
 * Powered by includes/hub-layout.php
 */
require_once __DIR__ . '/config.php';

$hub_data = array (
  'badge' => 'K3 Pabrik & Manufaktur',
  'title' => 'Pelatihan K3 Manufaktur: Keselamatan Mesin, LOTO & Audit Pabrik',
  'meta_title' => 'Pelatihan K3 Manufaktur & Pabrik (Mesin, LOTO, APD) — Wahana Totalita',
  'meta_desc' => 'Pelatihan K3 Manufaktur & Pabrik bersertifikat resmi. Pengamanan mesin produksi (machine guarding), isolasi energi LOTO, keselamatan conveyor. Silabus & jadwal.',
  'intro_lead' => 'Pelatihan keselamatan kerja industri manufaktur untuk perlindungan mesin produksi, penerapan Lockout/Tagout (LOTO), dan pencegahan kecelakaan pabrik.',
  'intro' => 
  array (
    0 => 'Lantai produksi pabrik manufaktur (otomotif, logam, tekstil, plastik, dan elektronik) dipenuhi potensi bahaya mekanis bertenaga besar seperti mesin press stamping, mesin bubut, conveyor berjalan, lengan robotik, dan transmisi roda gigi. Kelalaian pemasangan pelindung mesin dapat mengakibatkan cedera amputasi, terhimpit, hingga kematian pekerja.',
    1 => 'Penerapan K3 Manufaktur terpadu mencakup pengamanan mesin (machine guarding), prosedur isolasi energi berbahaya Lockout/Tagout (LOTO), serta pembinaan Panitia Pembina Keselamatan dan Kesehatan Kerja (P2K3) sesuai amanat UU No. 1 Tahun 1970 dan Permenaker No. 38 Tahun 2016.',
  ),
  'regulasi' => 
  array (
    0 => 
    array (
      'nomor' => 'Permenaker No. 38 Tahun 2016',
      'desc' => 'K3 Pesawat Tenaga dan Produksi — mengatur syarat keselamatan mesin gerak mula, perkakas, dan transmisi mekanis pabrik.',
    ),
    1 => 
    array (
      'nomor' => 'UU No. 1 Tahun 1970',
      'desc' => 'Pasal 2 dan 3 mewajibkan syarat keselamatan kerja pada setiap tempat kerja pengolahan bahan mentah menjadi barang jadi.',
    ),
    2 => 
    array (
      'nomor' => 'Permenaker No. 04/MEN/1987',
      'desc' => 'Tata Cara Penunjukan Ahli Keselamatan Kerja dan Pembentukan Panitia Pembina K3 (P2K3) di Tempat Kerja.',
    ),
  ),
  'comparison' => 
  array (
    'headers' => 
    array (
      0 => 'Aspek Evaluasi',
      1 => 'Operator Lini Produksi',
      2 => 'HSE Officer Manufaktur',
    ),
    'rows' => 
    array (
      0 => 
      array (
        0 => 'Peran Pokok',
        1 => 'Penerap SOP mesin, pengguna APD & pelapor near-miss',
        2 => 'Pengawas keselamatan pabrik, pembuat JSA & auditor P2K3',
      ),
      1 => 
      array (
        0 => 'Kewenangan LOTO',
        1 => 'Menerapkan padlock personal saat setting alat',
        2 => 'Menerbitkan izin kerja berbahaya & audit sistem isolasi energi',
      ),
      2 => 
      array (
        0 => 'Pendidikan Minimal',
        1 => 'Minimal SMA / SMK sederajat',
        2 => 'D3 / S1 Teknik Mesin, Industri atau K3',
      ),
      3 => 
      array (
        0 => 'Durasi Pelatihan',
        1 => '±16 Jam Pelatihan (2 Hari)',
        2 => '±30 Jam Pelatihan (3–4 Hari)',
      ),
      4 => 
      array (
        0 => 'Sertifikasi',
        1 => 'Sertifikat Pelatihan K3 Operator Mesin',
        2 => 'Sertifikat Ahli K3 Umum / K3 Manufaktur',
      ),
    ),
  ),
  'programs' => 
  array (
    0 => 
    array (
      'slug' => 'pelatihan-k3-operator-forklift-kelas-2-sertifikasi-kemnaker-ri',
      'name' => 'Pelatihan Operator Forklift Pabrik Kemnaker RI',
      'cert' => 'Kemnaker RI',
      'mode' => 'Tatap Muka & Praktik Alat',
      'duration' => '3 Hari Pelatihan',
      'desc' => 'Sertifikasi SIO resmi Kemnaker RI untuk operator forklift material handling lini produksi pabrik manufaktur.',
      'target_peserta' => 'Operator forklift pabrik, staf logistik bahan baku, teknisi gudang barang jadi',
    ),
    1 => 
    array (
      'slug' => 'pelatihan-internal-auditor-iso-45001-online',
      'name' => 'Pelatihan Internal Auditor ISO 45001 Manufaktur Online',
      'cert' => 'Sertifikasi Kompetensi',
      'mode' => 'Online / Interactive Zoom',
      'duration' => '2 Hari Pelatihan',
      'desc' => 'Pelatihan audit internal sistem manajemen K3 industri manufaktur untuk kesiapan sertifikasi bendera emas SMK3 dan ISO 45001.',
      'target_peserta' => 'HSE supervisor, production engineer, manager pabrik, internal auditor SMK3',
    ),
  ),
  'syarat' => 
  array (
    0 => 'Pendidikan minimal SMA/SMK (Operator) atau D3/S1 Teknik/K3 (Supervisor/Engineer)',
    1 => 'Salinan KTP legalisir, ijazah terakhir, dan pas foto resmi background merah',
    2 => 'Surat rekomendasi / penugasan kerja dari perusahaan manufaktur',
  ),
  'materi' => 
  array (
    0 => 'Kebijakan K3 Manufaktur Nasional & Regulasi Pesawat Tenaga Produksi Permenaker No. 38/2016',
    1 => 'Identifikasi Bahaya Mekanis: Titik Jepit (Nip Points), Bagian Berputar, Pemotong, dan Pengepres',
    2 => 'Standar Pengamanan Mesin (Machine Guarding): Fixed Guard, Interlock Guard, Light Curtain Sensor',
    3 => 'Prosedur Isolasi Energi Berbahaya — Lockout / Tagout (LOTO): 6 Langkah Wajib LOTO Zero Energy State',
    4 => 'Manajemen Keselamatan Pergudangan & Pemisahan Jalur Forklift vs Pejalan Kaki (Pedestrian Safe Zone)',
    5 => 'Keselamatan Ruang Terbatas (Confined Space) & Izin Masuk Tangki Pencampur/Silo Pabrik',
    6 => 'Pembentukan dan Pelaporan Triwulan P2K3 ke Dinas Tenaga Kerja Setempat',
  ),
  'faqs' => 
  array (
    0 => 
    array (
      'q' => 'Kapan prosedur LOTO wajib diterapkan di pabrik?',
      'a' => 'Prosedur Lockout/Tagout (LOTO) wajib diterapkan setiap kali personil melakukan perbaikan, servis, pembersihan, atau pemeliharaan mesin di mana penyalaan mesin yang tidak terduga dapat menimbulkan bahaya.',
    ),
    1 => 
    array (
      'q' => 'Apakah seluruh mesin di pabrik wajib memiliki pelindung mesin (guarding)?',
      'a' => 'Ya, Permenaker No. 38 Tahun 2016 mewajibkan setiap komponen mesin yang berputar atau bergerak bertenaga mekanis dilengkapi alat pengaman atau pelindung permanen.',
    ),
    2 => 
    array (
      'q' => 'Berapa lama masa berlaku sertifikat pelatihan K3 Manufaktur?',
      'a' => 'Sertifikat pelatihan berlaku selama 3 tahun dan dapat diperpanjang melalui penyegaran berkala.',
    ),
    3 => 
    array (
      'q' => 'Apakah melayani pelatihan in-house di lokasi pabrik kami?',
      'a' => 'Ya, kami melayani penyelenggaraan in-house training langsung di pabrik Anda dengan simulasi penandaan titik bahaya mesin nyata di lini perakitan.',
    ),
  ),
  'related_hubs' => 
  array (
    0 => 
    array (
      'slug' => 'k3-listrik',
      'name' => 'K3 Listrik',
      'badge' => 'Kemnaker RI',
      'desc' => 'Keselamatan instalasi motor listrik mesin pabrik, panel MCC, dan grounding.',
    ),
    1 => 
    array (
      'slug' => 'k3-pesawat-angkat-angkut',
      'name' => 'K3 Pesawat Angkat Angkut',
      'badge' => 'Kemnaker RI',
      'desc' => 'Sertifikasi operator forklift pabrik, hoist crane gantung, dan rigger industri.',
    ),
    2 => 
    array (
      'slug' => 'smk3',
      'name' => 'Penerapan & Audit SMK3',
      'badge' => 'Kemnaker RI',
      'desc' => 'Penerapan sistem manajemen K3 PP No. 50/2012 menuju bendera emas audit pabrik.',
    ),
    3 => 
    array (
      'slug' => 'k3-kimia',
      'name' => 'K3 Bahan Kimia',
      'badge' => 'Kemnaker RI',
      'desc' => 'Pengelolaan pelarut industri, bahan baku kimia, dan sistem penyimpanan BKB pabrik.',
    ),
  ),
  'slug' => 'k3-manufaktur',
);

require __DIR__ . '/includes/hub-layout.php';
