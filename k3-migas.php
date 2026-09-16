<?php
/**
 * k3-migas.php — Hub Page
 * Powered by includes/hub-layout.php
 */
require_once __DIR__ . '/config.php';

$hub_data = array (
  'badge' => 'K3 Industri Migas',
  'title' => 'Pelatihan K3 Migas: Pengawas & Operator Keselamatan Migas BNSP',
  'meta_title' => 'Pelatihan K3 Migas (Pengawas & Operator) Sertifikasi BNSP — Wahana Totalita',
  'meta_desc' => 'Pelatihan K3 Industri Migas bersertifikat resmi BNSP sesuai SKKNI Migas. Pengawas K3 Migas, Operator K3 Migas, Sistem Izin Kerja Aman (PTW). Silabus & jadwal.',
  'intro_lead' => 'Sertifikasi kompetensi resmi BNSP untuk Pengawas K3 Migas dan Operator K3 Migas sesuai standar SKKNI industri minyak dan gas bumi nasional.',
  'intro' => 
  array (
    0 => 'Operasi industri minyak dan gas bumi (migas), baik di sektor hulu (eksplorasi dan pengeboran) maupun hilir (pengilangan, transmisi perpipaan, dan distribusi BBM/LPG), tergolong lingkungan kerja dengan potensi bahaya katastrofik tinggi. Risiko paparan gas beracun H2S, kebakaran hidrokarbon, ledakan gas bertekanan, dan bahaya offshore menuntut standar kualifikasi personil keselamatan kerja yang sangat ketat.',
    1 => 'Badan Nasional Sertifikasi Profesi (BNSP) melalui LSP Migas menetapkan skema sertifikasi Pengawas K3 Migas dan Operator K3 Migas berbasis SKKNI sebagai standar wajib kepatuhan dan kompetensi kerja bagi personil kontraktor maupun operator KKKS (Kontraktor Kontrak Kerja Sama) di Indonesia.',
  ),
  'regulasi' => 
  array (
    0 => 
    array (
      'nomor' => 'PP No. 11 Tahun 1979',
      'desc' => 'Tentang Keselamatan Kerja pada Pemurnian dan Pengolahan Minyak dan Gas Bumi.',
    ),
    1 => 
    array (
      'nomor' => 'UU No. 22 Tahun 2001 tentang Minyak dan Gas Bumi',
      'desc' => 'Mewajibkan standar keselamatan, kesehatan kerja, dan pengelolaan lingkungan hidup pada seluruh kegiatan usaha migas.',
    ),
    2 => 
    array (
      'nomor' => 'Kepmen ESDM No. 1827 K/30/MEM/2018',
      'desc' => 'Pedoman pelaksanaan kaidah teknik pertambangan dan energi yang baik di lingkungan industri perminyakan.',
    ),
    3 => 
    array (
      'nomor' => 'SKKNI K3 Sektor Migas',
      'desc' => 'Standar Kompetensi Kerja Nasional Indonesia untuk profesi Operator dan Pengawas K3 Industri Migas.',
    ),
  ),
  'comparison' => 
  array (
    'headers' => 
    array (
      0 => 'Aspek Evaluasi',
      1 => 'Operator K3 Migas',
      2 => 'Pengawas K3 Migas',
    ),
    'rows' => 
    array (
      0 => 
      array (
        0 => 'Peran Pokok',
        1 => 'Pelaksana teknis keselamatan lapangan & gas test',
        2 => 'Pengawas sistem, verifikator PTW & investigasi',
      ),
      1 => 
      array (
        0 => 'Tanggung Jawab',
        1 => 'Uji gas detektor, inspeksi APD, isolasi energi',
        2 => 'Audit keselamatan operasi, JSA & mitigasi darurat',
      ),
      2 => 
      array (
        0 => 'Pendidikan Minimal',
        1 => 'Minimal SMA/SMK sederajat + pengalaman',
        2 => 'D3 / S1 Teknik atau pengalaman di sektor migas',
      ),
      3 => 
      array (
        0 => 'Durasi Pelatihan',
        1 => '±30 Jam Pelatihan (3 Hari)',
        2 => '±40 Jam Pelatihan (4 Hari)',
      ),
      4 => 
      array (
        0 => 'Sertifikasi & Lisensi',
        1 => 'Sertifikat Kompetensi BNSP Migas',
        2 => 'Sertifikat Kompetensi Resmi BNSP Migas',
      ),
    ),
  ),
  'programs' => 
  array (
    0 => 
    array (
      'slug' => 'pelatihan-pengawas-k3-industri-migas-sertifikasi-bnsp',
      'name' => 'Pelatihan Pengawas K3 Industri Migas Sertifikasi BNSP',
      'cert' => 'Sertifikasi BNSP',
      'mode' => 'Blended / Uji Kompetensi',
      'duration' => '4 Hari Pelatihan',
      'desc' => 'Standarisasi kompetensi pengawas keselamatan kerja fasilitas migas. Mempelajari Sistem Izin Kerja Aman (Permit to Work), analisis keselamatan pekerjaan (JSA), prosedur isolasi energi LOTO, pengendalian gas H2S, dan audit keselamatan operasi migas.',
      'target_peserta' => 'Safety inspector migas, rig supervisor, HSE coordinator kontraktor migas, site engineer fasilitas pengolahan',
    ),
    1 => 
    array (
      'slug' => 'pelatihan-hazard-dan-operability-studies-hazops-sertifikasi-bnsp',
      'name' => 'Pelatihan HAZOPs Fasilitas Migas & Petrokimia BNSP',
      'cert' => 'Sertifikasi BNSP',
      'mode' => 'Blended / Online',
      'duration' => '3 Hari Pelatihan',
      'desc' => 'Pelatihan metodologi HAZOP untuk mengkaji desain keselamatan proses aliran fluida hidrokarbon, bejana separator, dan sistem flare gas guna mencegah kebocoran gas bertekanan.',
      'target_peserta' => 'Process safety engineer, chemical engineer, lead engineer fasilitas migas',
    ),
  ),
  'syarat' => 
  array (
    0 => 'Ijazah minimal SMA/SMK (Operator) atau D3/S1 Teknik (Pengawas)',
    1 => 'Surat rekomendasi / penugasan kerja dari perusahaan migas atau kontraktor terkait',
    2 => 'Curriculum Vitae (CV) portofolio pengalaman kerja di industri migas/energi',
    3 => 'Salinan KTP legalisir, ijazah terakhir, transkrip nilai, dan pas foto resmi background merah',
  ),
  'materi' => 
  array (
    0 => 'Peraturan Perundangan K3 Sektor Minyak dan Gas Bumi Nasional',
    1 => 'Karakteristik Bahaya Hidrokarbon & Mitigasi Bahaya Gas Beracun Hidrogen Sulfida (H2S)',
    2 => 'Sistem Izin Kerja Aman (Permit to Work - PTW): Cold Work, Hot Work, Confined Space, Radiografi',
    3 => 'Pengoperasian Alat Ukur Gas (Gas Detector): Deteksi LEL, O2, CO, dan H2S',
    4 => 'Prosedur Lockout / Tagout (LOTO) pada Pipa Transmisi dan Valve Bertekanan',
    5 => 'Job Safety Analysis (JSA) dan Hazard Identification Risk Assessment (HIRA) Fasilitas Migas',
    6 => 'Emergency Response Plan (ERP): Simulasi Abandon Platform, Kebakaran Tangki Timbun & Evakuasi',
    7 => 'Praktik Simulasi Prosedur dan Uji Asesmen Kompetensi BNSP',
  ),
  'faqs' => 
  array (
    0 => 
    array (
      'q' => 'Apakah sertifikat K3 Migas BNSP diakui oleh SKK Migas dan KKKS?',
      'a' => 'Ya, sertifikat kompetensi BNSP dengan logo Garuda Emas diakui secara resmi oleh SKK Migas, kontraktor KKKS (seperti Pertamina, Medco, BP, ExxonMobil), dan seluruh subkontraktor migas nasional.',
    ),
    1 => 
    array (
      'q' => 'Berapa lama masa berlaku sertifikat kompetensi K3 Migas BNSP?',
      'a' => 'Sertifikat kompetensi BNSP berlaku selama 3 tahun dan dapat diperpanjang melalui asesmen portofolio atau uji ulang kompetensi.',
    ),
    2 => 
    array (
      'q' => 'Apakah fresh graduate bisa mengikuti pelatihan Pengawas K3 Migas?',
      'a' => 'Fresh graduate dengan latar belakang D3/S1 Teknik dapat mengikuti pelatihan ini dengan memenuhi skema uji kompetensi yang dipersyaratkan oleh skema LSP.',
    ),
    3 => 
    array (
      'q' => 'Apakah pelatihan K3 Migas mencakup materi pengendalian bahaya gas H2S?',
      'a' => 'Ya, materi deteksi gas H2S, penggunaan SCBA darurat, dan prosedur evakuasi paparan gas beracun merupakan bagian inti dari silabus pelatihan kami.',
    ),
  ),
  'related_hubs' => 
  array (
    0 => 
    array (
      'slug' => 'k3-pertambangan',
      'name' => 'K3 Pertambangan (POP/POM)',
      'badge' => 'BNSP & ESDM',
      'desc' => 'Sertifikasi pengawas operasional industri ekstraktif dan tambang mineral/batubara.',
    ),
    1 => 
    array (
      'slug' => 'k3-kimia',
      'name' => 'K3 Bahan Kimia',
      'badge' => 'Kemnaker RI',
      'desc' => 'Pengendalian bahan mudah meledak, gas beracun, dan reaktor petrokimia.',
    ),
    2 => 
    array (
      'slug' => 'juru-las',
      'name' => 'Juru Las (Welder)',
      'badge' => 'Kemnaker RI',
      'desc' => 'Sertifikasi pengelasan pipa transmisi minyak dan instalasi bejana bertekanan migas.',
    ),
    3 => 
    array (
      'slug' => 'penanggulangan-kebakaran',
      'name' => 'Penanggulangan Kebakaran',
      'badge' => 'Kemnaker RI',
      'desc' => 'Proteksi kebakaran fasilitas hidrokarbon dan pengoperasian foam fire system.',
    ),
  ),
  'slug' => 'k3-migas',
);

require __DIR__ . '/includes/hub-layout.php';
