<?php
/**
 * k3-pangan.php — Hub Page
 * Powered by includes/hub-layout.php
 */
require_once __DIR__ . '/config.php';

$hub_data = array (
  'badge' => 'K3 Industri Pangan',
  'title' => 'Pelatihan K3 Industri Pangan: Higiene Sanitasi, HACCP & FSSC 22000',
  'meta_title' => 'Pelatihan K3 Industri Pangan (Higiene, HACCP, ISO 22000) — Wahana Totalita',
  'meta_desc' => 'Pelatihan K3 Industri Pangan & Keamanan Pangan bersertifikat resmi. Higiene Sanitasi, HACCP, FSSC 22000 & Good Manufacturing Practices (GMP). Silabus & jadwal.',
  'intro_lead' => 'Pelatihan integrasi K3 dan Keamanan Pangan (Food Safety) untuk pemenuhan standar GMP, HACCP, dan ISO 22000 di industri pengolahan makanan & minuman.',
  'intro' => 
  array (
    0 => 'Industri pengolahan makanan, minuman, dan kemasan pangan memiliki tuntutan ganda: melindungi keselamatan tenaga kerja dari bahaya mesin pemotong/pemanas serta menjamin kebersihan dan higienitas produk dari kontaminasi silang (cross-contamination) mikroba, zat kimia, maupun benda asing.',
    1 => 'Kombinasi standar K3 industri dengan prinsip Hazard Analysis Critical Control Point (HACCP) dan Good Manufacturing Practices (GMP) memastikan fasilitas produksi beroperasi aman bagi pekerja sekaligus menghasilkan pangan yang higienis dan bersertifikasi halal/BPOM.',
  ),
  'regulasi' => 
  array (
    0 => 
    array (
      'nomor' => 'UU No. 18 Tahun 2012 tentang Pangan',
      'desc' => 'Mewajibkan pemenuhan standar sanitasi dan keamanan pangan di seluruh rantai produksi komersial.',
    ),
    1 => 
    array (
      'nomor' => 'Permenkes No. 1096 Tahun 2011',
      'desc' => 'Higiene Sanitasi Jasaboga — standar kelayakan fasilitas pengolahan makanan, dapur, dan kesehatan penjamah makanan.',
    ),
    2 => 
    array (
      'nomor' => 'ISO 22000 / FSSC 22000',
      'desc' => 'Standar internasional sistem manajemen keamanan pangan yang terintegrasi dengan prinsip K3 manufaktur.',
    ),
  ),
  'comparison' => 
  array (
    'headers' => 
    array (
      0 => 'Aspek Evaluasi',
      1 => 'Penjamah Makanan (Food Handler)',
      2 => 'Tim Pengendali Mutu / HACCP Team Leader',
    ),
    'rows' => 
    array (
      0 => 
      array (
        0 => 'Peran Pokok',
        1 => 'Karyawan lini pengolahan, pembersihan & packaging',
        2 => 'Penyusun dokumen HACCP, auditor internal & QA manager',
      ),
      1 => 
      array (
        0 => 'Fokus Bahaya',
        1 => 'Kebersihan personal, pemakaian hairnet, sarung tangan',
        2 => 'Verifikasi Critical Control Points (CCP) & audit GMP',
      ),
      2 => 
      array (
        0 => 'Pendidikan Minimal',
        1 => 'Minimal SMP / SMA sederajat',
        2 => 'D3 / S1 Teknologi Pangan, Kimia, Biologi atau Gizi',
      ),
      3 => 
      array (
        0 => 'Durasi Pelatihan',
        1 => '±16 Jam Pelatihan (2 Hari)',
        2 => '±24 Jam Pelatihan (3 Hari)',
      ),
      4 => 
      array (
        0 => 'Sertifikasi',
        1 => 'Sertifikat Higiene Sanitasi Pangan BNSP',
        2 => 'Sertifikat Kompetensi HACCP / ISO 22000 BNSP',
      ),
    ),
  ),
  'programs' => 
  array (
    0 => 
    array (
      'slug' => 'pelatihan-internal-auditor-iso-45001-online',
      'name' => 'Pelatihan Internal Auditor ISO 22000 / ISO 45001 Online',
      'cert' => 'Sertifikasi Kompetensi',
      'mode' => 'Online / Interactive Zoom',
      'duration' => '2 Hari Pelatihan',
      'desc' => 'Pelatihan metodologi audit sistem manajemen mutu dan keselamatan pangan terintegrasi K3 industri pengolahan.',
      'target_peserta' => 'QA/QC supervisor, tim HACCP, auditor internal pabrik makanan, staf kepatuhan regulasi BPOM',
    ),
  ),
  'syarat' => 
  array (
    0 => 'Pendidikan minimal SMA/SMK sederajat (Penjamah Pangan) atau D3/S1 Sains/Teknologi Pangan (HACCP Team)',
    1 => 'Salinan KTP legalisir, ijazah terakhir, dan pas foto resmi background merah',
    2 => 'Surat keterangan sehat dan bebas penyakit menular dari fasilitas kesehatan',
  ),
  'materi' => 
  array (
    0 => 'Kebijakan K3 Industri Manufaktur Pangan & Regulasi Keamanan Pangan Nasional (BPOM)',
    1 => 'Prinsip Good Manufacturing Practices (GMP) dan Standar Sanitasi Operasional (SSOP)',
    2 => '7 Prinsip HACCP: Analisis Bahaya Biologi/Kimia/Fisik & Penentuan Titik Kendali Kritis (CCP)',
    3 => 'Kebersihan Pribadi Penjamah Pangan (Personal Hygiene), APD Makanan, dan Fasilitas Cuci Tangan',
    4 => 'Keselamatan Operasional Mesin Pengolahan Makanan: Mesin Pengaduk, Conveyor, Oven & Cold Storage',
    5 => 'Pengendalian Hama Terpadu (Integrated Pest Management) di Fasilitas Pengolahan dan Gudang',
    6 => 'Prosedur Pembersihan & Sanitasi Mesin (Cleaning in Place - CIP) & Penanganan Bahan Kimia Sanitizer',
  ),
  'faqs' => 
  array (
    0 => 
    array (
      'q' => 'Apa perbedaan antara K3 pabrik makanan dengan HACCP?',
      'a' => 'K3 berfokus melindungi pekerja dari cedera (seperti terpotong mesin, terpeleset lantai basah, luka bakar oven). Sedangkan HACCP berfokus melindungi konsumen dari bahaya kontaminasi makanan yang dihasilkan.',
    ),
    1 => 
    array (
      'q' => 'Apakah penjamah makanan wajib memiliki sertifikat higiene sanitasi?',
      'a' => 'Ya, Permenkes mewajibkan penjamah makanan memiliki sertifikat kompetensi pelatihan higiene sanitasi yang dikeluarkan oleh lembaga terakreditasi.',
    ),
    2 => 
    array (
      'q' => 'Berapa lama sertifikat pelatihan keamanan pangan berlaku?',
      'a' => 'Sertifikat pelatihan umumnya berlaku selama 3 tahun dan dapat diperpanjang melalui sertifikasi ulang kompetensi.',
    ),
    3 => 
    array (
      'q' => 'Apakah melayani pelatihan in-house di pabrik pengolahan pangan?',
      'a' => 'Ya, Wahana Totalita melayani pelatihan in-house disesuaikan langsung dengan lini proses dan jenis produk olahan pabrik Anda.',
    ),
  ),
  'related_hubs' => 
  array (
    0 => 
    array (
      'slug' => 'k3-manufaktur',
      'name' => 'K3 Manufaktur',
      'badge' => 'Kemnaker & BNSP',
      'desc' => 'Keselamatan mesin lini produksi, conveyor pabrik, dan prosedur LOTO industri.',
    ),
    1 => 
    array (
      'slug' => 'pelatihan-iso',
      'name' => 'Pelatihan ISO & QHSE',
      'badge' => 'ISO Internasional',
      'desc' => 'Sertifikasi audit ISO 22000 (Pangan), ISO 45001 (K3), dan ISO 9001 (Mutu).',
    ),
    2 => 
    array (
      'slug' => 'higiene-industri',
      'name' => 'Higiene Industri',
      'badge' => 'BNSP & Kemnaker',
      'desc' => 'Pengukuran sanitasi industri, kualitas air bersih, dan pemantauan ergonomi pekerja.',
    ),
    3 => 
    array (
      'slug' => 'k3-kimia',
      'name' => 'K3 Bahan Kimia',
      'badge' => 'Kemnaker RI',
      'desc' => 'Penyimpanan bahan sanitizer, desinfektan kimia, dan bahan aditif industri pangan.',
    ),
  ),
  'slug' => 'k3-pangan',
);

require __DIR__ . '/includes/hub-layout.php';
