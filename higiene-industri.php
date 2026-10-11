<?php
/**
 * higiene-industri.php — Hub Page
 * Powered by includes/hub-layout.php
 */
require_once __DIR__ . '/config.php';

$hub_data = array (
  'badge' => 'Higiene Industri',
  'title' => 'Pelatihan Higiene Industri: Sertifikasi HIMU, HIMA & HIU BNSP',
  'meta_title' => 'Pelatihan Higiene Industri (HIMU, HIMA, HIU) Sertifikasi BNSP — Wahana Totalita',
  'meta_desc' => 'Pelatihan Higiene Industri Muda (HIMU) & Madya (HIMA) bersertifikat resmi BNSP sesuai Permenaker No. 05 Tahun 2018. Pengukuran bahaya kerja, silabus & jadwal.',
  'intro_lead' => 'Sertifikasi kompetensi resmi BNSP untuk Higiene Industri Muda (HIMU), Madya (HIMA), dan Utama (HIU) sesuai standar Permenaker No. 05 Tahun 2018.',
  'intro' => 
  array (
    0 => 'Higiene Industri adalah ilmu dan seni dalam mengantisipasi, mengenali, mengevaluasi, dan mengendalikan faktor-faktor bahaya lingkungan kerja (fisik, kimia, biologi, ergonomi, psikososial) yang dapat menyebabkan penyakit akibat kerja (PAK), gangguan kesehatan, maupun ketidaknyamanan signifikan pada tenaga kerja.',
    1 => 'Permenaker No. 05 Tahun 2018 tentang Keselamatan dan Kesehatan Kerja Lingkungan Kerja mewajibkan perusahaan melakukan pemantauan dan pengukuran faktor bahaya kerja secara berkala oleh personil yang tersertifikasi kompetensi Higiene Industri resmi dari BNSP.',
  ),
  'regulasi' => 
  array (
    0 => 
    array (
      'nomor' => 'Permenaker No. 05 Tahun 2018',
      'desc' => 'K3 Lingkungan Kerja — mengatur standar Nilai Ambang Batas (NAB) faktor fisika dan kimia, faktor biologi, ergonomi, dan sanitasi tempat kerja.',
    ),
    1 => 
    array (
      'nomor' => 'UU No. 1 Tahun 1970',
      'desc' => 'Pasal 3 dan Pasal 8 mewajibkan pencegahan dan pengendalian penyakit akibat kerja serta pemeliharaan kesehatan lingkungan kerja.',
    ),
    2 => 
    array (
      'nomor' => 'SKKNI No. 209 Tahun 2008',
      'desc' => 'Standar Kompetensi Kerja Nasional Indonesia bidang Higiene Industri yang menjadi acuan sertifikasi HIMU, HIMA, dan HIU.',
    ),
  ),
  'comparison' => 
  array (
    'headers' => 
    array (
      0 => 'Aspek Evaluasi',
      1 => 'HIMU (Higiene Industri Muda)',
      2 => 'HIMA (Higiene Industri Madya)',
      3 => 'HIU (Higiene Industri Utama)',
    ),
    'rows' => 
    array (
      0 => 
      array (
        0 => 'Peran Pokok',
        1 => 'Teknisi pengukuran & sampling lapangan',
        2 => 'Evaluator data lingkungan kerja & kontrol',
        3 => 'Perancang kebijakan, auditor & konsultan HI',
      ),
      1 => 
      array (
        0 => 'Fokus Keahlian',
        1 => 'Pengukuran kebisingan, debu, ISBB & lux',
        2 => 'Analisis paparan, ventilasi & evaluasi PAK',
        3 => 'Manajemen program komprehensif seluruh plant',
      ),
      2 => 
      array (
        0 => 'Durasi Kursus',
        1 => '±32 Jam Pelatihan (4 Hari)',
        2 => '±40 Jam Pelatihan (5 Hari)',
        3 => '±40 Jam Pelatihan (5 Hari)',
      ),
      3 => 
      array (
        0 => 'Pendidikan Minimal',
        1 => 'D3 / S1 Ilmu Eksakta / Kesehatan / Teknik',
        2 => 'D3 / S1 + Pengalaman HIMU minimal 2 tahun',
        3 => 'S1 + Pengalaman HIMA minimal 3 tahun',
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
      'slug' => 'pelatihan-higiene-industri-muda-himu-sertifikasi-bnsp',
      'name' => 'Pelatihan Higiene Industri Muda (HIMU) BNSP',
      'cert' => 'Sertifikasi BNSP',
      'mode' => 'Blended / Uji Kompetensi',
      'duration' => '4 Hari Pelatihan',
      'desc' => 'Sertifikasi kompetensi personil pelaksana pengukuran faktor lingkungan kerja. Mempelajari pengoperasian Sound Level Meter (kebisingan), Lux Meter (pencahayaan), Heat Stress Monitor (iklim kerja), dan personal dust sampler.',
      'target_peserta' => 'HSE officer, industrial hygienist junior, teknisi laboratorium lingkungan, staf medis perusahaan',
    ),
    1 => 
    array (
      'slug' => 'pelatihan-higiene-industri-madya-hima-sertifikasi-bnsp',
      'name' => 'Pelatihan Higiene Industri Madya (HIMA) BNSP',
      'cert' => 'Sertifikasi BNSP',
      'mode' => 'Blended / Uji Kompetensi',
      'duration' => '5 Hari Pelatihan',
      'desc' => 'Kualifikasi analis dan pengambil keputusan program higiene industri. Fokus pada evaluasi paparan terhadap NAB Permenaker 5/2018, perancangan sistem ventilasi industri (local exhaust), dan audit program pengendalian bahaya kerja.',
      'target_peserta' => 'HSE supervisor, dokter kesehatan kerja, manajer fasilitas pabrik, konsultan lingkungan industri',
    ),
  ),
  'syarat' => 
  array (
    0 => 'Ijazah minimal D3/S1 bidang Teknik, Kesehatan Masyarakat, MIPA, atau bidang eksakta',
    1 => 'Surat rekomendasi kerja dari instansi atau perusahaan pengutus',
    2 => 'Curriculum Vitae (CV) portofolio pengalaman di bidang K3/lingkungan kerja',
    3 => 'Salinan KTP legalisir, ijazah terakhir, transkrip nilai, dan pas foto resmi background merah',
  ),
  'materi' => 
  array (
    0 => 'Pengantar Higiene Industri & Regulasi K3 Lingkungan Kerja Permenaker No. 05 Tahun 2018',
    1 => 'Antisipasi dan Pengenalan Bahaya Faktor Fisik: Kebisingan, Getaran, Iklim Kerja (ISBB), Radiasi',
    2 => 'Teknik Sampling dan Pengukuran Faktor Kimia: Gas Beracun, Uap Organik, dan Debu Respirabel',
    3 => 'Pemantauan Faktor Biologi, Ergonomi Industri (REBA/RULA), dan Kualitas Udara Dalam Ruangan (IAQ)',
    4 => 'Prinsip Rekayasa Ventilasi Industri: General Ventilation & Local Exhaust Ventilation (LEV)',
    5 => 'Program Konservasi Pendengaran (Hearing Conservation Program) & Pemilihan APD Tepat Guna',
    6 => 'Praktik Kalibrasi & Pengoperasian Instrumen Pengukuran Lingkungan Kerja',
    7 => 'Penyusunan Laporan Hasil Uji dan Asesmen Sertifikasi Kompetensi BNSP',
  ),
  'faqs' => 
  array (
    0 => 
    array (
      'q' => 'Apakah perusahaan wajib melakukan pengukuran lingkungan kerja berkala?',
      'a' => 'Ya. Permenaker No. 05 Tahun 2018 mewajibkan pengurus atau pengusaha melakukan pengukuran dan pengendalian lingkungan kerja secara berkala untuk memastikan seluruh faktor bahaya berada di bawah Nilai Ambang Batas (NAB).',
    ),
    1 => 
    array (
      'q' => 'Apa perbedaan antara HIMU dan HIMA?',
      'a' => 'HIMU (Muda) berfokus pada keterampilan teknis pengukuran dan pengambilan sampel di lapangan menggunakan instrumen uji. HIMA (Madya) berwenang mengevaluasi data hasil ukur, merancang rekayasa pengendalian teknis (seperti ventilasi), dan mengelola program kesehatan kerja preventif.',
    ),
    2 => 
    array (
      'q' => 'Berapa lama masa berlaku sertifikat kompetensi BNSP Higiene Industri?',
      'a' => 'Sertifikat kompetensi yang diterbitkan oleh BNSP berlaku selama 3 tahun dan dapat diperpanjang melalui proses resertifikasi / asesmen portofolio.',
    ),
    3 => 
    array (
      'q' => 'Apakah pelatihan Higiene Industri bisa dilakukan secara daring?',
      'a' => 'Pelatihan teori dapat dilaksanakan secara interaktif daring, sedangkan sesi simulasi instrumen dan uji asesmen kompetensi dilakukan melalui demonstrasi metode asesmen BNSP resmi.',
    ),
  ),
  'related_hubs' => 
  array (
    0 => 
    array (
      'slug' => 'k3-lingkungan',
      'name' => 'K3 Lingkungan Kerja',
      'badge' => 'Kemnaker & BNSP',
      'desc' => 'Pengujian baku mutu emisi, pengelolaan limbah B3, dan amdal industri.',
    ),
    1 => 
    array (
      'slug' => 'k3-kimia',
      'name' => 'K3 Kimia',
      'badge' => 'Kemnaker RI',
      'desc' => 'Pengendalian uap bahan kimia beracun, SDS, dan sistem penyimpanan aman.',
    ),
    2 => 
    array (
      'slug' => 'k3-laboratorium',
      'name' => 'K3 Laboratorium',
      'badge' => 'Kemnaker & BNSP',
      'desc' => 'Standar biosafety level, biological safety cabinet, dan kalibrasi alat ukur.',
    ),
    3 => 
    array (
      'slug' => 'k3-psikososial',
      'name' => 'K3 Psikososial & Ergonomi',
      'badge' => 'Kemnaker & BNSP',
      'desc' => 'Mitigasi kelelahan kerja, stres lingkungan kerja, dan penilaian ergonomi manual handling.',
    ),
  ),
  'slug' => 'higiene-industri',
);

require __DIR__ . '/includes/hub-layout.php';
