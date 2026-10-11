<?php
/**
 * k3-perkantoran.php — Hub Page
 * Powered by includes/hub-layout.php
 */
require_once __DIR__ . '/config.php';

$hub_data = array (
  'badge' => 'K3 Perkantoran & Gedung',
  'title' => 'Pelatihan K3 Perkantoran: Standar Keselamatan Gedung & Ergonomi Kerja',
  'meta_title' => 'Pelatihan K3 Perkantoran Sesuai Permenkes No. 48/2016 — Wahana Totalita',
  'meta_desc' => 'Pelatihan K3 Perkantoran resmi sesuai Permenkes No. 48 Tahun 2016. Ergonomi komputer, keselamatan gedung bertingkat, evakuasi kebakaran & P3K. Silabus lengkap.',
  'intro_lead' => 'Pelatihan K3 Perkantoran resmi untuk kepatuhan Permenkes No. 48 Tahun 2016 mencakup ergonomi display unit, keselamatan gedung, dan tim tanggap darurat kantor.',
  'intro' => 
  array (
    0 => 'Lingkungan perkantoran sering kali dianggap memiliki risiko rendah, padahal bahaya ergonomi (Carpal Tunnel Syndrome, Low Back Pain), kelelahan visual akibat monitor komputer, kualitas udara dalam ruangan (Sick Building Syndrome), dan bahaya kebakaran di gedung bertingkat tinggi menimbulkan kerugian produktivitas dan biaya medis yang sangat besar.',
    1 => 'Permenkes No. 48 Tahun 2016 tentang Standar Keselamatan dan Kesehatan Kerja Perkantoran mewajibkan setiap pimpinan kantor atau pengelola gedung menyediakan lingkungan kerja yang ergonomis, sehat, dan memiliki tim tanggap darurat yang terlatih.',
  ),
  'regulasi' => 
  array (
    0 => 
    array (
      'nomor' => 'Permenkes No. 48 Tahun 2016',
      'desc' => 'Standar Keselamatan dan Kesehatan Kerja Perkantoran — mengatur persyaratan keselamatan gedung, tata udara, ergonomi, dan sanitasi kantor.',
    ),
    1 => 
    array (
      'nomor' => 'Permenaker No. 05 Tahun 2018',
      'desc' => 'K3 Lingkungan Kerja — mengatur pencahayaan minimal meja kerja (lux) dan kualitas udara dalam ruangan (Indoor Air Quality).',
    ),
    2 => 
    array (
      'nomor' => 'UU No. 1 Tahun 1970',
      'desc' => 'Kewajiban penyelenggaraan keselamatan kerja di setiap tempat kerja komersial dan perkantoran.',
    ),
  ),
  'comparison' => 
  array (
    'headers' => 
    array (
      0 => 'Aspek Evaluasi',
      1 => 'Petugas K3 Kantor / Floor Warden',
      2 => 'Pengelola Fasilitas / GA Manager',
    ),
    'rows' => 
    array (
      0 => 
      array (
        0 => 'Peran Pokok',
        1 => 'Pemandu evakuasi lantai kerja & first aid kantor',
        2 => 'Penanggung jawab fasilitas gedung & kepatuhan K3',
      ),
      1 => 
      array (
        0 => 'Fokus Keahlian',
        1 => 'Simulasi evakuasi, inspeksi APAR lantai, P3K',
        2 => 'Ergonomi workstation, audit gedung & perizinan',
      ),
      2 => 
      array (
        0 => 'Pendidikan Minimal',
        1 => 'Minimal SMA / SMK sederajat',
        2 => 'D3 / S1 Manajemen, Teknik atau Kesehatan',
      ),
      3 => 
      array (
        0 => 'Durasi Pelatihan',
        1 => '±16–24 Jam Pelatihan (2–3 Hari)',
        2 => '±24–32 Jam Pelatihan (3–4 Hari)',
      ),
      4 => 
      array (
        0 => 'Sertifikasi',
        1 => 'Sertifikat K3 Perkantoran & Tanggap Darurat',
        2 => 'Sertifikat Pengelola K3 Perkantoran',
      ),
    ),
  ),
  'programs' => 
  array (
    0 => 
    array (
      'slug' => 'pelatihan-petugas-p3k-sertifikasi-bnsp',
      'name' => 'Pelatihan First Aid & P3K Gedung Perkantoran BNSP',
      'cert' => 'Sertifikasi BNSP',
      'mode' => 'Tatap Muka & Praktik Kantor',
      'duration' => '3 Hari Pelatihan',
      'desc' => 'Pelatihan penanganan darurat medis di lingkungan kantor: pingsan, serangan jantung mendadak, tersedak, luka sayat, dan tata kelola kotak P3K standar Permenaker 15/2008.',
      'target_peserta' => 'Resepsionis, HRGA, floor warden, staf operasional umum, security gedung perkantoran',
    ),
    1 => 
    array (
      'slug' => 'pelatihan-petugas-peran-kebakaran-kelas-d-kemnaker-ri',
      'name' => 'Pelatihan Petugas Peran Kebakaran Gedung (Kelas D) Kemnaker',
      'cert' => 'Kemnaker RI',
      'mode' => 'Tatap Muka & Praktik APAR Gedung',
      'duration' => '3 Hari Pelatihan',
      'desc' => 'Sertifikasi tim pemadam api dini dan pemandu evakuasi tangga darurat gedung bertingkat komersial sesuai Kepmenaker No. 186/1999.',
      'target_peserta' => 'Security gedung, floor warden perkantoran, facility engineer, koordinator tenant',
    ),
  ),
  'syarat' => 
  array (
    0 => 'Pendidikan minimal SMA / SMK / D3 / S1 seluruh jurusan',
    1 => 'Salinan KTP legalisir dan pas foto resmi background merah',
    2 => 'Surat rekomendasi / penugasan kerja dari perusahaan tempat bekerja',
  ),
  'materi' => 
  array (
    0 => 'Regulasi K3 Perkantoran Permenkes No. 48 Tahun 2016 & Kebijakan Kantor Sehat',
    1 => 'Ergonomi Meja Kerja (Workstation Ergonomics): Penyetelan Kursi, Monitor, dan Keyboard Komputer',
    2 => 'Pencegahan Musculoskeletal Disorders (MSDs) & Program Gerakan Peregangan di Tempat Duduk (Brisk Walking)',
    3 => 'Kualitas Udara Dalam Ruangan (Indoor Air Quality - IAQ) & Pencegahan Sindrom Gedung Sakit (SBS)',
    4 => 'Prosedur Tanggap Darurat Kebakaran & Gempa Bumi di Gedung Bertingkat Tinggi',
    5 => 'Manajemen Jalur Evakuasi, Signage Darurat, Titik Kumpul (Muster Point), dan Peran Floor Warden',
    6 => 'Pemeriksaan Kotak P3K Perkantoran & Pertolongan Medis Pertama Karyawan Sakit Mendadak',
  ),
  'faqs' => 
  array (
    0 => 
    array (
      'q' => 'Apakah perusahaan rintisan / startup di perkantoran wajib menerapkan K3?',
      'a' => 'Ya. Permenkes No. 48 Tahun 2016 berlaku untuk seluruh jenis perkantoran pemerintah maupun swasta tanpa memandang sektor industri atau ukuran bisnis.',
    ),
    1 => 
    array (
      'q' => 'Apa saja keluhan kesehatan paling umum di lingkungan perkantoran?',
      'a' => 'Keluhan paling umum meliputi nyeri punggung bawah (LBP), ketegangan leher/bahu, mata lelah (Computer Vision Syndrome), dan stres kerja akibat beban kerja mental.',
    ),
    2 => 
    array (
      'q' => 'Berapa lama masa berlaku sertifikat pelatihan K3 Perkantoran?',
      'a' => 'Sertifikat pelatihan berlaku selama 3 tahun dan dapat diperbarui melalui program pelatihan penyegaran.',
    ),
    3 => 
    array (
      'q' => 'Apakah pelatihan K3 Perkantoran bisa diselenggarakan secara daring?',
      'a' => 'Ya, kami menyelenggarakan kelas online via Zoom interaktif yang sangat cocok untuk perusahaan dengan sistem kerja hybrid atau WFH.',
    ),
  ),
  'related_hubs' => 
  array (
    0 => 
    array (
      'slug' => 'p3k',
      'name' => 'P3K di Tempat Kerja',
      'badge' => 'Kemnaker & BNSP',
      'desc' => 'Sertifikasi petugas first aid resmi untuk pemenuhan kotak P3K gedung kantor.',
    ),
    1 => 
    array (
      'slug' => 'penanggulangan-kebakaran',
      'name' => 'Penanggulangan Kebakaran',
      'badge' => 'Kemnaker RI',
      'desc' => 'Simulasi evakuasi kebakaran gedung bertingkat dan sertifikasi tim peran damkar.',
    ),
    2 => 
    array (
      'slug' => 'k3-psikososial',
      'name' => 'K3 Psikososial & Ergonomi',
      'badge' => 'Kemnaker & BNSP',
      'desc' => 'Pengendalian stres kerja, work-life balance, dan asesmen ergonomi kantor.',
    ),
    3 => 
    array (
      'slug' => 'k3-listrik',
      'name' => 'K3 Listrik',
      'badge' => 'Kemnaker RI',
      'desc' => 'Inspeksi instalasi kabel stop kontak lantai kerja dan panel ruang server.',
    ),
  ),
  'slug' => 'k3-perkantoran',
);

require __DIR__ . '/includes/hub-layout.php';
