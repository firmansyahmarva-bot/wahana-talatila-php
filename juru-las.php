<?php
/**
 * juru-las.php — Hub Page
 * Powered by includes/hub-layout.php
 */
require_once __DIR__ . '/config.php';

$hub_data = array (
  'badge' => 'Juru Las (Welder)',
  'title' => 'Pelatihan & Sertifikasi Juru Las (Welder Kelas I, II & III) Kemnaker RI & BNSP',
  'meta_title' => 'Pelatihan Juru Las (Welder Kelas 1, 2, 3) Kemnaker RI & BNSP — Wahana Totalita',
  'meta_desc' => 'Sertifikasi Juru Las resmi Kemnaker RI & BNSP sesuai Permenaker No. 02/MEN/1982. Skema pengelasan SMAW, GTAW, GMAW Kelas 1-3. Silabus & jadwal.',
  'intro_lead' => 'Sertifikasi resmi Juru Las (Welder) Kelas 1, 2, dan 3 berlisensi Kemnaker RI dan sertifikat kompetensi BNSP sesuai Permenaker No. 02/MEN/1982.',
  'intro' => 
  array (
    0 => 'Aktivitas pengelasan dalam fabrikasi struktur baja, ketel uap, bejana bertekanan, dan jaringan pipa migas menuntut tingkat presisi dan integritas metalurgi yang sempurna. Cacat lasan (seperti porositas, lack of fusion, atau retak sambungan) dapat memicu kegagalan struktural fatal yang berujung pada ledakan atau runtuhnya konstruksi pabrik.',
    1 => 'Permenaker No. 02/MEN/1982 tentang Kualifikasi Juru Las di Tempat Kerja mewajibkan setiap juru las yang bekerja pada konstruksi bertekanan dan struktur kritis untuk memiliki Lisensi Kerja Juru Las resmi dari Kementerian Ketenagakerjaan RI, dikelompokkan ke dalam Kelas 1 (semua posisi pengelasan), Kelas 2 (posisi tertentu), dan Kelas 3 (posisi dasar).',
  ),
  'regulasi' => 
  array (
    0 => 
    array (
      'nomor' => 'Permenaker No. 02/MEN/1982',
      'desc' => 'Kualifikasi Juru Las di Tempat Kerja — mengatur klasifikasi Juru Las Kelas 1, 2, dan 3, pengujian radiografi (X-Ray), dan masa berlaku lisensi las.',
    ),
    1 => 
    array (
      'nomor' => 'Undang-Undang Uap Tahun 1930',
      'desc' => 'Mewajibkan pengelasan konstruksi ketel uap dan pipa bertekanan dikerjakan oleh juru las berlisensi resmi Kemnaker RI.',
    ),
    2 => 
    array (
      'nomor' => 'ASME Section IX & AWS D1.1',
      'desc' => 'Standar internasional pengelasan bejana tekan dan struktur baja yang diintegrasikan dalam kurikulum pembinaan teknis.',
    ),
  ),
  'comparison' => 
  array (
    'headers' => 
    array (
      0 => 'Aspek Evaluasi',
      1 => 'Juru Las Kelas 3 (Dasar)',
      2 => 'Juru Las Kelas 2 (Menengah)',
      3 => 'Juru Las Kelas 1 (Pipa Tekanan)',
    ),
    'rows' => 
    array (
      0 => 
      array (
        0 => 'Posisi Pengelasan',
        1 => 'Posisi 1G, 2G, 1F, 2F (Plat datar/horizontal)',
        2 => 'Posisi 3G, 4G, 3F, 4F (Plat vertikal/overhead)',
        3 => 'Posisi 5G, 6G, 6GR (Pipa miring tetap & segala posisi)',
      ),
      1 => 
      array (
        0 => 'Lingkup Pekerjaan',
        1 => 'Struktur umum tanpa beban tekanan tinggi',
        2 => 'Struktur gedung, jembatan, tanki non-tekanan',
        3 => 'Pipa migas, boiler, bejana tekan, offshore',
      ),
      2 => 
      array (
        0 => 'Pengujian Sambungan',
        1 => 'Uji visual & uji lengkung (bending test)',
        2 => 'Uji visual, bending & penetrant test',
        3 => 'Uji radiografi (X-Ray) & ultrasonic test (UT)',
      ),
      3 => 
      array (
        0 => 'Durasi Kursus',
        1 => '±30 Jam Pelatihan (3–4 Hari)',
        2 => '±40 Jam Pelatihan (4–5 Hari)',
        3 => '±50 Jam Pelatihan (6 Hari Kerja)',
      ),
      4 => 
      array (
        0 => 'Sertifikasi',
        1 => 'Lisensi Juru Las Kemnaker RI',
        2 => 'Lisensi Juru Las Kemnaker RI',
        3 => 'Lisensi Juru Las Kelas 1 Kemnaker RI',
      ),
    ),
  ),
  'programs' => 
  array (
    0 => 
    array (
      'slug' => 'pelatihan-k3-juru-las-welder-kelas-1-kemnaker-ri',
      'name' => 'Pelatihan Juru Las Kelas 1 Kemnaker RI (Posisi 6G Pipa)',
      'cert' => 'Kemnaker RI',
      'mode' => 'Tatap Muka & Praktik Bengkel Las',
      'duration' => '6 Hari Pelatihan',
      'desc' => 'Kualifikasi tertinggi juru las profesional untuk pengelasan pipa tetap segala posisi (5G/6G) pada ketel uap, bejana tekan, dan perpipaan migas. Uji hasil lasan wajib lolos pemeriksaan radiografi/X-Ray resmi Kemnaker RI.',
      'target_peserta' => 'Welder industri migas, tukang las boiler/pipa panas, teknisi fabrikasi galangan kapal',
    ),
    1 => 
    array (
      'slug' => 'pelatihan-k3-juru-las-welder-kelas-2-kemnaker-ri',
      'name' => 'Pelatihan Juru Las Kelas 2 Kemnaker RI (Posisi 3G/4G Plat)',
      'cert' => 'Kemnaker RI',
      'mode' => 'Tatap Muka & Praktik Bengkel Las',
      'duration' => '5 Hari Pelatihan',
      'desc' => 'Sertifikasi kompetensi pengelasan plat baja posisi vertikal dan overhead (3G/4G SMAW/GMAW). Membekali teknik penyetelan amper, penetrasi akar las, serta pencegahan undercut dan porosity.',
      'target_peserta' => 'Tukang las struktur gedung, fabrikator tangki timbun, teknisi karoseri dan rangka baja',
    ),
    2 => 
    array (
      'slug' => 'online-training-fire-watcher',
      'name' => 'Pelatihan Fire Watcher (Pengawas Pekerjaan Panas/Las)',
      'cert' => 'Sertifikasi Kompetensi',
      'mode' => 'Online / In-House',
      'duration' => '2 Hari Pelatihan',
      'desc' => 'Pelatihan pengawasan keselamatan mendampingi juru las saat pekerjaan panas (hot work) guna mengantisipasi percikan api las, mengamankan bahan mudah terbakar, dan kesiapan APAR darurat.',
      'target_peserta' => 'Safety inspector pengelasan, mandor fabrikasi, supervisor bengkel las',
    ),
  ),
  'syarat' => 
  array (
    0 => 'Usia minimal 18 tahun, sehat jasmani dan rohani',
    1 => 'Ijazah minimal SMP / SMA / SMK sederajat',
    2 => 'Surat keterangan sehat mata dari dokter (tidak buta warna)',
    3 => 'Salinan KTP legalisir, ijazah terakhir, dan pas foto resmi background merah',
  ),
  'materi' => 
  array (
    0 => 'Regulasi K3 Pengelasan Permenaker No. 02/MEN/1982 & Standar Pengelasan Nasional',
    1 => 'Pengenalan Karakteristik Metalurgi Las, Jenis Elektroda, dan Gas Pelindung (Argon/CO2)',
    2 => 'Prosedur Pengelasan Standar (Welding Procedure Specification - WPS & PQR)',
    3 => 'Teknik Pengelasan Shielded Metal Arc Welding (SMAW), GTAW (Argon/TIG), dan GMAW/MIG',
    4 => 'Identifikasi dan Pencegahan Cacat Las (Welding Defects): Cracking, Slag Inclusion, Undercut',
    5 => 'Metode Pengujian Tidak Merusak (Non-Destructive Testing): Visual, Dye Penetrant, Radiografi (X-Ray)',
    6 => 'K3 Pekerjaan Panas: Bahaya Radiasi Sinar UV, Asap Las (Welding Fumes), Bahaya Kebakaran & APD Las',
    7 => 'Praktik Pengelasan Uji Benda Kerja di Bengkel Las & Ujian Sertifikasi Kemnaker RI',
  ),
  'faqs' => 
  array (
    0 => 
    array (
      'q' => 'Apa beda Juru Las Kelas 1, 2, dan 3 menurut Kemnaker RI?',
      'a' => 'Kelas 3 berwenang mengelas sambungan plat pada posisi 1G dan 2G. Kelas 2 berwenang mengelas plat posisi 3G dan 4G serta pipa putar (1G pipa). Kelas 1 berwenang mengelas sambungan pipa posisi tetap (5G, 6G, 6GR) dan segala jenis sambungan bejana bertekanan tinggi.',
    ),
    1 => 
    array (
      'q' => 'Berapa lama masa berlaku lisensi Juru Las Kemnaker RI?',
      'a' => 'Lisensi kerja Juru Las berlaku selama 3 tahun dan dapat diperpanjang melalui registrasi ulang dan pemeriksaan hasil kerja pengelasan.',
    ),
    2 => 
    array (
      'q' => 'Apakah benda kerja hasil las diuji laboratorium sebelum lisensi terbit?',
      'a' => 'Ya, seluruh benda uji hasil praktik peserta akan diuji melalui uji mekanik (bending test) dan uji tanpa rusak (radiografi/X-Ray) sesuai kualifikasi kelas yang diambil.',
    ),
    3 => 
    array (
      'q' => 'Apakah pemula yang belum pernah mengelas bisa ikut pelatihan ini?',
      'a' => 'Untuk Kelas 1 dan 2 disyaratkan telah memiliki dasar teknik pengelasan. Bagi pemula disarankan mengambil kelas pembinaan dasar atau Juru Las Kelas 3.',
    ),
  ),
  'related_hubs' => 
  array (
    0 => 
    array (
      'slug' => 'k3-pesawat-uap',
      'name' => 'K3 Pesawat Uap',
      'badge' => 'Kemnaker RI',
      'desc' => 'Pengelasan ketel uap, bejana bertekanan, dan pipa steam bertekanan tinggi.',
    ),
    1 => 
    array (
      'slug' => 'k3-konstruksi',
      'name' => 'K3 Konstruksi',
      'badge' => 'Kemnaker & BNSP',
      'desc' => 'Pengawasan pengelasan rangka baja gedung bertingkat dan jembatan.',
    ),
    2 => 
    array (
      'slug' => 'penanggulangan-kebakaran',
      'name' => 'Penanggulangan Kebakaran',
      'badge' => 'Kemnaker RI',
      'desc' => 'Mitigasi bahaya percikan api pekerjaan panas (hot work) dan tata kelola APAR.',
    ),
    3 => 
    array (
      'slug' => 'k3-migas',
      'name' => 'K3 Migas & Energi',
      'badge' => 'BNSP & Kemnaker',
      'desc' => 'Pengelasan instalasi pipa transmisi gas, kilang minyak, dan platform lepas pantai.',
    ),
  ),
  'slug' => 'juru-las',
);

require __DIR__ . '/includes/hub-layout.php';
