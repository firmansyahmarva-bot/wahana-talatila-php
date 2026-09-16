<?php
/**
 * k3-pesawat-angkat-angkut.php — Hub Page
 * Powered by includes/hub-layout.php
 */
require_once __DIR__ . '/config.php';

$hub_data = array (
  'badge' => 'Pesawat Angkat & Angkut',
  'title' => 'Pelatihan K3 Pesawat Angkat Angkut (Crane, Forklift & Rigger) Kemnaker RI',
  'meta_title' => 'Pelatihan K3 Pesawat Angkat Angkut (Crane, Forklift, Rigger) Kemnaker RI — Wahana Totalita',
  'meta_desc' => 'Pelatihan & SIO resmi K3 Pesawat Angkat Angkut sesuai Permenaker No. 08 Tahun 2020. Operator Forklift, Mobile Crane, Overhead Crane & Rigger Kemnaker RI.',
  'intro_lead' => 'Sertifikasi dan Lisensi K3 (SIO) resmi Kemnaker RI untuk operator crane, forklift, rigger dan peralatan angkat industri sesuai Permenaker No. 08 Tahun 2020.',
  'intro' => 
  array (
    0 => 'Pengoperasian Pesawat Angkat dan Pesawat Angkut (PAA) di lingkungan industri manufaktur, pergudangan logistik, dermaga pelabuhan, dan proyek konstruksi memiliki risiko kecelakaan fatal yang sangat tinggi. Bahaya operasional mencakup kegagalan struktur crane, beban terjatuh (falling load), tipping/tergulingnya alat berat, hingga sengatan listrik akibat kontak dengan jaringan tegangan tinggi.',
    1 => 'Berdasarkan Permenaker No. 08 Tahun 2020 tentang Keselamatan dan Kesehatan Kerja Pesawat Angkat dan Pesawat Angkut, setiap personil yang mengoperasikan, memandu, atau memelihara peralatan angkat wajib memiliki Surat Izin Operator (SIO) dan Lisensi K3 resmi yang diterbitkan langsung oleh Kementerian Ketenagakerjaan RI.',
  ),
  'regulasi' => 
  array (
    0 => 
    array (
      'nomor' => 'Permenaker No. 08 Tahun 2020',
      'desc' => 'Tentang K3 Pesawat Angkat dan Pesawat Angkut. Regulasi komprehensif pengganti Per.05/Men/1985 yang mengatur standar teknis, pemeriksaan berkala, dan lisensi SIO operator PAA.',
    ),
    1 => 
    array (
      'nomor' => 'UU No. 1 Tahun 1970',
      'desc' => 'Pasal 2 dan 3 mewajibkan syarat keselamatan kerja pada setiap tempat kerja yang menggunakan mesin, pesawat, alat kerja, dan instalasi mekanis berdaya besar.',
    ),
    2 => 
    array (
      'nomor' => 'Permenaker No. 38 Tahun 2016',
      'desc' => 'Tentang K3 Pesawat Tenaga dan Produksi yang menjadi payung integrasi keselamatan mesin penggerak industri.',
    ),
  ),
  'comparison' => 
  array (
    'headers' => 
    array (
      0 => 'Aspek Evaluasi',
      1 => 'Operator Crane (Kelas I–III)',
      2 => 'Operator Forklift (Kelas I–II)',
      3 => 'Juru Ikat / Rigger',
    ),
    'rows' => 
    array (
      0 => 
      array (
        0 => 'Fungsi Pokok',
        1 => 'Mengoperasikan Mobile, Overhead, Tower Crane',
        2 => 'Operasional unit forklift & reach truck',
        3 => 'Mengikat, menghitung rigging & memandu beban',
      ),
      1 => 
      array (
        0 => 'Penentuan Kelas',
        1 => 'Berdasarkan tonase & kapasitas angkat crane',
        2 => 'Berdasarkan kapasitas unit (<15 Ton vs >15 Ton)',
        3 => 'Spesialis pengikatan beban & sinyal pandu',
      ),
      2 => 
      array (
        0 => 'Masa Berlaku SIO',
        1 => 'Lisensi SIO Kemnaker RI berlaku 5 tahun',
        2 => 'Lisensi SIO Kemnaker RI berlaku 5 tahun',
        3 => 'Lisensi K3 Rigger Kemnaker RI berlaku 5 tahun',
      ),
      3 => 
      array (
        0 => 'Durasi Kursus',
        1 => '±30–40 Jam Pelatihan (3–4 Hari)',
        2 => '±30 Jam Pelatihan (3 Hari)',
        3 => '±30 Jam Pelatihan (3 Hari)',
      ),
      4 => 
      array (
        0 => 'Pendidikan Minimal',
        1 => 'Minimal SMP / SMA sederajat',
        2 => 'Minimal SMP / SMA sederajat',
        3 => 'Minimal SMP / SMA sederajat',
      ),
    ),
  ),
  'programs' => 
  array (
    0 => 
    array (
      'slug' => 'pelatihan-k3-operator-forklift-kelas-2-sertifikasi-kemnaker-ri',
      'name' => 'Pelatihan & SIO Operator Forklift Kelas 2 Kemnaker RI',
      'cert' => 'Kemnaker RI',
      'mode' => 'Tatap Muka & Praktik Alat',
      'duration' => '3 Hari Pelatihan',
      'desc' => 'Sertifikasi kompetensi dan penerbitan Lisensi SIO Kemnaker RI untuk operator forklift berkapasitas hingga 15 ton. Materi mencakup load chart, daily inspection, manuver di gang sempit pabrik, dan traffic management gudang.',
      'target_peserta' => 'Operator forklift gudang, staf logistik pabrik, operator reach truck, teknisi material handling',
    ),
    1 => 
    array (
      'slug' => 'pelatihan-k3-operator-crane-kelas-3-sertifikasi-kemnaker-ri',
      'name' => 'Pelatihan & SIO Operator Crane Kemnaker RI',
      'cert' => 'Kemnaker RI',
      'mode' => 'Tatap Muka & Praktik Unit',
      'duration' => '4 Hari Pelatihan',
      'desc' => 'Sertifikasi lisensi SIO resmi untuk operator crane industri (Mobile Crane / Overhead Crane / Hoist). Meliputi load moment indicator, perhitungan sudut boom, radius aman, dan prosedur tanggap darurat angkat beban.',
      'target_peserta' => 'Operator crane pabrik, teknisi hoist overhead, operator truck crane proyek konstruksi',
    ),
    2 => 
    array (
      'slug' => 'operator-rigger',
      'name' => 'Pelatihan Juru Ikat Beban (Rigger) Kemnaker RI',
      'cert' => 'Kemnaker RI',
      'mode' => 'Tatap Muka & Praktik Rigging',
      'duration' => '3 Hari Pelatihan',
      'desc' => 'Pembinaan kompetensi personil rigging untuk memilih webbing sling, wire rope, shackle, menghitung titik berat (center of gravity), sudut pengikatan aman, serta komunikasi sinyal standar internasional ke operator crane.',
      'target_peserta' => 'Rigger lapangan, helper crane, teknisi pengikatan beban galangan kapal, staf safety lifting',
    ),
  ),
  'syarat' => 
  array (
    0 => 'Usia minimal 18 tahun, sehat jasmani dan rohani',
    1 => 'Ijazah minimal SMP / SMA / SMK sederajat',
    2 => 'Surat keterangan sehat dari dokter (tidak buta warna dan tidak memiliki gangguan pendengaran/keseimbangan)',
    3 => 'Salinan KTP legalisir, ijazah terakhir, dan pas foto resmi background merah',
  ),
  'materi' => 
  array (
    0 => 'Kebijakan K3 Nasional & Pemahaman Regulasi Permenaker No. 08 Tahun 2020 tentang PAA',
    1 => 'Prinsip Kerja, Komponen Utama, dan Perlengkapan Pengaman (Safety Devices) Crane & Forklift',
    2 => 'Pemeriksaan Harian (Pre-Use Inspection Checklist) dan Pengujian Fungsi Kelayakan Operasi',
    3 => 'Perhitungan Titik Berat, Sudut Tali, Tabel Beban (Load Chart) dan Kapasitas Angkat Aman (SWL)',
    4 => 'Teknik Pengikatan Beban (Rigging Practice): Penggunaan Sling Webbing, Rantai, dan Shackle',
    5 => 'Komunikasi Standar Operasi: Hand Signals Internasional dan Prosedur Radio Komunikasi Dua Arah',
    6 => 'Pencegahan Kecelakaan Kerja: Manuver Ruang Terbatas, Tanah Lembek, Beban Blind Lift',
    7 => 'Praktik Operasional Unit & Ujian Evaluasi Sertifikasi Kemnaker RI',
  ),
  'faqs' => 
  array (
    0 => 
    array (
      'q' => 'Apakah setiap operator crane dan forklift wajib memiliki Lisensi K3 / SIO Kemnaker RI?',
      'a' => 'Ya. Sesuai Permenaker No. 08 Tahun 2020 Pasal 140, setiap pengurus atau pengusaha wajib mempekerjakan operator Pesawat Angkat dan Pesawat Angkut yang memiliki Surat Izin Operator (SIO) dan Lisensi K3 yang masih berlaku dari Kementerian Ketenagakerjaan RI.',
    ),
    1 => 
    array (
      'q' => 'Berapa lama masa berlaku SIO dan Lisensi K3 Operator PAA?',
      'a' => 'Surat Izin Operator (SIO) dan Lisensi K3 Operator Kemnaker RI berlaku selama 5 tahun dan dapat diperpanjang melalui evaluasi berkala dan pemeriksaan kesehatan kerja.',
    ),
    2 => 
    array (
      'q' => 'Apa perbedaan antara Operator Forklift Kelas 1 dan Kelas 2?',
      'a' => 'Operator Forklift Kelas 2 berwenang mengoperasikan unit forklift dengan kapasitas angkat sampai dengan 15 ton. Sedangkan Operator Forklift Kelas 1 berwenang mengoperasikan unit forklift dengan kapasitas di atas 15 ton.',
    ),
    3 => 
    array (
      'q' => 'Apakah pelatihan operator PAA mencakup praktik langsung mengoperasikan unit?',
      'a' => 'Ya, seluruh pelatihan operator PAA Wahana Totalita mengalokasikan waktu wajib untuk sesi praktik unit nyata di bawah bimbingan instruktur ahli PJK3 resmi berlisensi.',
    ),
  ),
  'related_hubs' => 
  array (
    0 => 
    array (
      'slug' => 'operator-alat-berat',
      'name' => 'Operator Alat Berat',
      'badge' => 'Kemnaker & BNSP',
      'desc' => 'Sertifikasi SIO Excavator, Wheel Loader, Bulldozer dan Vibro Roller.',
    ),
    1 => 
    array (
      'slug' => 'k3-konstruksi',
      'name' => 'K3 Konstruksi',
      'badge' => 'Kemnaker & BNSP',
      'desc' => 'Pengawasan keselamatan lifting proyek sipil, tower crane, dan rigging plan.',
    ),
    2 => 
    array (
      'slug' => 'k3-ketinggian',
      'name' => 'K3 Ketinggian (TKBT)',
      'badge' => 'Kemnaker RI',
      'desc' => 'Keselamatan operator gondola fasad dan teknisi elevated work platform.',
    ),
    3 => 
    array (
      'slug' => 'k3-pesawat-uap',
      'name' => 'K3 Pesawat Uap & Bejana',
      'badge' => 'Kemnaker RI',
      'desc' => 'Sertifikasi operator boiler industri dan pengawasan bejana bertekanan.',
    ),
  ),
  'slug' => 'k3-pesawat-angkat-angkut',
);

require __DIR__ . '/includes/hub-layout.php';
