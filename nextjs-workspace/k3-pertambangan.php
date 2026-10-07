<?php
/**
 * k3-pertambangan.php — Hub Page
 * Powered by includes/hub-layout.php
 */
require_once __DIR__ . '/config.php';

$hub_data = array (
  'badge' => 'K3 Pertambangan',
  'title' => 'Pelatihan K3 Pertambangan: Pengawas Operasional Pratama (POP) & Madya (POM) BNSP',
  'meta_title' => 'Pelatihan K3 Pertambangan (POP & POM) BNSP | Wahana Totalita',
  'meta_desc' => 'Pelatihan Pengawas Operasional Pratama (POP) & Madya (POM) Tambang bersertifikat resmi BNSP sesuai Kepmen ESDM No. 1827/2018. Silabus, jadwal & biaya.',
  'intro_lead' => 'Sertifikasi kompetensi resmi BNSP untuk Pengawas Operasional Pratama (POP) dan Madya (POM) sesuai regulasi Kepmen ESDM No. 1827 K/30/MEM/2018.',

  'intro' => 
  array (
    0 => 'Industri pertambangan mineral dan batubara memiliki karakteristik operasional berskala masif dengan potensi bahaya tinggi, mulai dari kestabilan lereng tambang terbuka (open pit), operasional alat berat raksasa (heavy dump truck & excavator), bahaya ledakan bahan peledak (blasting), hingga terowongan tambang bawah tanah (underground mining).',
    1 => 'Keputusan Menteri ESDM No. 1827 K/30/MEM/2018 mewajibkan setiap pemegang IUP/IUPK mengangkat Pengawas Operasional yang memiliki sertifikasi kompetensi resmi dari BNSP, dengan jenjang Pengawas Operasional Pratama (POP), Pengawas Operasional Madya (POM), hingga Pengawas Operasional Utama (POU).',
  ),
  'regulasi' => 
  array (
    0 => 
    array (
      'nomor' => 'Kepmen ESDM No. 1827 K/30/MEM/2018',
      'desc' => 'Pedoman Pelaksanaan Kaidah Teknik Pertambangan yang Baik — dasar hukum wajib penunjukan KTT, PTL, dan Pengawas Operasional bersertifikat.',
    ),
    1 => 
    array (
      'nomor' => 'UU No. 3 Tahun 2020 tentang Pertambangan Minerba',
      'desc' => 'Mewajibkan pemegang izin usaha pertambangan menerapkan kaidah keselamatan operasi pertambangan dan keselamatan lingkungan.',
    ),
    2 => 
    array (
      'nomor' => 'Permen ESDM No. 26 Tahun 2018',
      'desc' => 'Tentang Pelaksanaan Kaidah Pertambangan yang Baik dan Pengawasan Pertambangan Mineral dan Batubara.',
    ),
  ),
  'comparison' => 
  array (
    'headers' => 
    array (
      0 => 'Aspek Evaluasi',
      1 => 'POP (Pratama)',
      2 => 'POM (Madya)',
      3 => 'POU (Utama)',
    ),
    'rows' => 
    array (
      0 => 
      array (
        0 => 'Tingkat Pengawasan',
        1 => 'Pengawas lini depan (Frontline Supervisor)',
        2 => 'Pengawas tingkat menengah (Superintendent/Manager)',
        3 => 'Pimpinan tertinggi operasional / KTT',
      ),
      1 => 
      array (
        0 => 'Fokus Tanggung Jawab',
        1 => 'Inspeksi pit, safety talk harian, JSA & investigasi insiden',
        2 => 'Evaluasi program K3 pertambangan & audit SMKP',
        3 => 'Perumusan kebijakan keselamatan tambang total',
      ),
      2 => 
      array (
        0 => 'Pendidikan Minimal',
        1 => 'SMA/SMK (min 10 thn exp) / D3 (min 3 thn) / S1 (min 1 thn)',
        2 => 'Lulus POP + pengalaman min 1 tahun di level pengawas',
        3 => 'Lulus POM + pengalaman min 1 tahun di level POM',
      ),
      3 => 
      array (
        0 => 'Durasi Kursus',
        1 => '±30 Jam Pelatihan (3–4 Hari)',
        2 => '±40 Jam Pelatihan (4–5 Hari)',
        3 => '±40 Jam Pelatihan (5 Hari)',
      ),
      4 => 
      array (
        0 => 'Sertifikasi',
        1 => 'Sertifikat Kompetensi Kerja BNSP',
        2 => 'Sertifikat Kompetensi Kerja BNSP',
        3 => 'Sertifikat Kompetensi Kerja BNSP',
      ),
    ),
  ),
  'programs' => 
  array (
    0 => 
    array (
      'slug' => 'pelatihan-pengawas-operasional-pratama-pop-pertambangan-bnsp',
      'name' => 'Pelatihan Pengawas Operasional Pratama (POP) Tambang BNSP',
      'cert' => 'Sertifikasi BNSP',
      'mode' => 'Blended / Uji Kompetensi',
      'duration' => '4 Hari Pelatihan',
      'desc' => 'Sertifikasi kompetensi wajib bagi pengawas lapangan front line di tambang minerba. Mempelajari pelaksanaan inspeksi tambang, investigasi kecelakaan, analisis keselamatan pekerjaan (JSA), dan safety meeting sesuai Kepmen ESDM 1827/2018.',
      'target_peserta' => 'Foreman pit, supervisor tambang, pengawas hauling road, safety officer kontraktor tambang batubara/mineral',
    ),
    1 => 
    array (
      'slug' => 'operator-alat-berat',
      'name' => 'Pelatihan & SIO Operator Alat Berat Tambang Kemnaker RI',
      'cert' => 'Kemnaker RI',
      'mode' => 'Tatap Muka & Praktik Unit',
      'duration' => '4 Hari Pelatihan',
      'desc' => 'Sertifikasi lisensi SIO resmi untuk operator alat berat tambang: Excavator, Wheel Loader, Bulldozer, dan Dump Truck sesuai Permenaker No. 08/2020.',
      'target_peserta' => 'Operator alat berat pit tambang, driver hauling truck, teknisi mekanik alat berat',
    ),
  ),
  'syarat' => 
  array (
    0 => 'Pendidikan minimal SLTA/SMK (pengalaman min 10 thn), D3 Teknik (pengalaman min 3 thn), atau S1 Teknik (pengalaman min 1 thn) di pertambangan',
    1 => 'Surat rekomendasi / penugasan kerja dari Kepala Teknik Tambang (KTT) perusahaan',
    2 => 'Curriculum Vitae (CV) portofolio pengalaman kerja dan bukti kegiatan pengawasan lapangan',
    3 => 'Salinan KTP legalisir, ijazah terakhir, transkrip nilai, dan pas foto resmi background merah',
  ),
  'materi' => 
  array (
    0 => 'Kaidah Teknik Pertambangan yang Baik & Regulasi Kepmen ESDM No. 1827 K/30/MEM/2018',
    1 => 'Tugas dan Tanggung Jawab Pengawas Operasional Pratama (POP) Tambang Minerba',
    2 => 'Teknik dan Prosedur Pelaksanaan Inspeksi Keselamatan Pertambangan (Pit, Hauling, Disposal)',
    3 => 'Investigasi Kecelakaan Tambang, Rekonstruksi Kejadian, dan Pembuatan Laporan Resmi KTT',
    4 => 'Penyusunan Job Safety Analysis (JSA) dan Standar Operasional Prosedur (SOP) Pertambangan',
    5 => 'Penyelenggaraan Pertemuan Keselamatan Kerja Pertambangan (Safety Talk/Toolbox Meeting)',
    6 => 'Penerapan Sistem Manajemen Keselamatan Pertambangan (SMKP Minerba)',
    7 => 'Simulasi Wawancara Uji Asesmen Kompetensi BNSP Bersama Asesor Bersertifikat',
  ),
  'faqs' => 
  array (
    0 => 
    array (
      'q' => 'Mengapa sertifikat POP wajib dimiliki pengawas di area tambang?',
      'a' => 'Berdasarkan Kepmen ESDM No. 1827/2018, perusahaan tambang dilarang mengangkat pengawas operasional lapangan yang belum memiliki sertifikat kompetensi POP dari BNSP. Keberadaan personil POP merupakan syarat mutlak kepatuhan hukum operasi tambang.',
    ),
    1 => 
    array (
      'q' => 'Berapa lama masa berlaku sertifikat kompetensi POP Tambang BNSP?',
      'a' => 'Sertifikat kompetensi POP BNSP berlaku selama 5 tahun dan dapat diperpanjang melalui mekanisme asesmen portofolio atau uji resertifikasi sebelum masa berlaku berakhir.',
    ),
    2 => 
    array (
      'q' => 'Apakah lulusan non-teknik bisa mengikuti uji kompetensi POP?',
      'a' => 'Bisa, asalkan memiliki pengalaman kerja di operasional pertambangan dengan durasi masa kerja yang memenuhi syarat skema LSP Minerba (misal D3 non-teknik minimal 5 tahun, S1 non-teknik minimal 3 tahun).',
    ),
    3 => 
    array (
      'q' => 'Apakah Wahana Totalita memfasilitasi pembinaan dan uji kompetensi POP?',
      'a' => 'Ya, Wahana Totalita menyelenggarakan bimbingan intensif persiapan POP bersama praktisi tambang senior serta fasilitasi asesmen resmi uji kompetensi LSP Pertambangan terakreditasi BNSP.',
    ),
  ),
  'related_hubs' => 
  array (
    0 => 
    array (
      'slug' => 'operator-alat-berat',
      'name' => 'Operator Alat Berat',
      'badge' => 'Kemnaker & BNSP',
      'desc' => 'Sertifikasi SIO Excavator, Dozer, Wheel Loader, dan Dump Truck tambang.',
    ),
    1 => 
    array (
      'slug' => 'k3-migas',
      'name' => 'K3 Migas & Energi',
      'badge' => 'BNSP & ESDM',
      'desc' => 'Pengawasan keselamatan operasi pengeboran migas, kilang, dan transmisi pipa energi.',
    ),
    2 => 
    array (
      'slug' => 'k3-lingkungan',
      'name' => 'K3 Lingkungan',
      'badge' => 'Kemnaker & BNSP',
      'desc' => 'Pengelolaan air asam tambang, reklamasi pascatambang, dan baku mutu lingkungan.',
    ),
    3 => 
    array (
      'slug' => 'k3-konstruksi',
      'name' => 'K3 Konstruksi',
      'badge' => 'Kemnaker & BNSP',
      'desc' => 'Pengawasan keselamatan infrastruktur jalan tambang, crusher plant, dan jembatan timbang.',
    ),
  ),
  'slug' => 'k3-pertambangan',
);

require __DIR__ . '/includes/hub-layout.php';
