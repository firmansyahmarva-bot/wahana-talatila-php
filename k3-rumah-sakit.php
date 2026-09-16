<?php
/**
 * k3-rumah-sakit.php — Hub Page
 * Powered by includes/hub-layout.php
 */
require_once __DIR__ . '/config.php';

$hub_data = array (
  'badge' => 'K3 Rumah Sakit & Faskes',
  'title' => 'Pelatihan K3 Rumah Sakit: Standar KARS & Akreditasi Faskes Kemnaker/BNSP',
  'meta_title' => 'Pelatihan K3 Rumah Sakit (K3RS) Standar KARS & Kemnaker — Wahana Totalita',
  'meta_desc' => 'Pelatihan K3 Rumah Sakit (K3RS) resmi sesuai Permenkes No. 66 Tahun 2016 dan standar akreditasi KARS. Manajemen risiko klinis, limbah B3 medis & BHS. Silabus & jadwal.',
  'intro_lead' => 'Pelatihan K3 Rumah Sakit (K3RS) untuk pemenuhan regulasi Permenkes No. 66 Tahun 2016 dan standar Manajemen Fasilitas & Keselamatan (MFK) akreditasi KARS.',
  'intro' => 
  array (
    0 => 'Fasilitas Pelayanan Kesehatan (Rumah Sakit, Klinik, dan Puskesmas) memiliki kompleksitas bahaya kerja yang unik, mencakup risiko pajanan penyakit infeksius (nosokomial/BBP), radiasi diagnostik, paparan gas anestesi, sitotoksik farmasi, limbah medis B3, serta potensi kebakaran pada area rawat inap berpenghuni rentan.',
    1 => 'Permenkes No. 66 Tahun 2016 tentang Keselamatan dan Kesehatan Kerja Rumah Sakit mewajibkan pembentukan Komite/Instalasi K3RS yang dipimpin oleh personil terlatih dan kompeten guna menjamin keselamatan pasien (patient safety), tenaga kesehatan, dan pengunjung faskes.',
  ),
  'regulasi' => 
  array (
    0 => 
    array (
      'nomor' => 'Permenkes No. 66 Tahun 2016',
      'desc' => 'Standar Keselamatan dan Kesehatan Kerja Rumah Sakit (K3RS) — dasar wajib manajemen risiko keselamatan kerja di seluruh tipe RS.',
    ),
    1 => 
    array (
      'nomor' => 'Standar Akreditasi KARS / STARKES',
      'desc' => 'Bab Manajemen Fasilitas dan Keselamatan (MFK) mensyaratkan inspeksi sarana proteksi kebakaran, B3 medis, dan disaster plan faskes.',
    ),
    2 => 
    array (
      'nomor' => 'Permen LHK No. P.56/2015',
      'desc' => 'Tata Cara dan Persyaratan Teknis Pengelolaan Limbah Bahan Berbahaya dan Beracun dari Fasilitas Pelayanan Kesehatan.',
    ),
  ),
  'comparison' => 
  array (
    'headers' => 
    array (
      0 => 'Aspek Evaluasi',
      1 => 'Petugas K3RS Faskes',
      2 => 'Koordinator / Komite K3RS',
    ),
    'rows' => 
    array (
      0 => 
      array (
        0 => 'Peran Pokok',
        1 => 'Pelaksana teknis keselamatan bangsal, limbah & APD',
        2 => 'Pimpinan komite K3RS, perencana MFK & auditor KARS',
      ),
      1 => 
      array (
        0 => 'Lingkup Tugas',
        1 => 'Monitoring spill kit medis, limbah tajam, tabung oksigen',
        2 => 'Penyusunan HVA, HIRA rumah sakit & koordinasi dinas',
      ),
      2 => 
      array (
        0 => 'Pendidikan Minimal',
        1 => 'D3 / S1 Kesehatan, Perawat, atau Tenaga Medis',
        2 => 'S1 Kesehatan Masyarakat / Dokter / Tenaga K3',
      ),
      3 => 
      array (
        0 => 'Durasi Pelatihan',
        1 => '±30 Jam Pelatihan (3 Hari)',
        2 => '±40 Jam Pelatihan (4–5 Hari)',
      ),
      4 => 
      array (
        0 => 'Sertifikasi',
        1 => 'Sertifikat Kompetensi Faskes / Kemnaker',
        2 => 'Sertifikat K3RS / Akreditasi KARS',
      ),
    ),
  ),
  'programs' => 
  array (
    0 => 
    array (
      'slug' => 'pelatihan-petugas-p3k-sertifikasi-bnsp',
      'name' => 'Pelatihan First Aid & Tanggap Darurat Medis RS BNSP',
      'cert' => 'Sertifikasi BNSP',
      'mode' => 'Tatap Muka / Blended',
      'duration' => '3 Hari Pelatihan',
      'desc' => 'Program tanggap darurat medis, penanganan korban henti jantung (CPR), luka bakar, dan penanganan trauma di lingkungan faskes.',
      'target_peserta' => 'Perawat ruangan, paramedis, staf ambulans, staf IGD dan tim code blue rumah sakit',
    ),
    1 => 
    array (
      'slug' => 'pelatihan-regu-penanggulangan-kebakaran-kelas-c-sertifikasi-kemnaker-ri',
      'name' => 'Pelatihan Proteksi Kebakaran Rumah Sakit Kemnaker RI',
      'cert' => 'Kemnaker RI',
      'mode' => 'Tatap Muka & Praktik Evakuasi Pasien',
      'duration' => '4 Hari Pelatihan',
      'desc' => 'Pelatihan tim tanggap darurat kebakaran faskes (Code Red) mencakup evakuasi pasien rawat inap, penggunaan tandu dan selimut tahan api, serta pengamanan gas medis.',
      'target_peserta' => 'Security rumah sakit, tim code red faskes, perawat penanggung jawab shift, staf teknisi utilitas',
    ),
  ),
  'syarat' => 
  array (
    0 => 'Pendidikan minimal D3/S1 Keperawatan, Kesehatan Masyarakat, Farmasi, Kedokteran, atau tenaga kesehatan faskes',
    1 => 'Surat penugasan / rekomendasi dari direksi atau manajemen rumah sakit/faskes',
    2 => 'Salinan KTP legalisir, ijazah terakhir, dan pas foto resmi background merah',
  ),
  'materi' => 
  array (
    0 => 'Kebijakan Nasional K3RS & Integrasi Standar Akreditasi KARS / STARKES',
    1 => 'Hazard Vulnerability Assessment (HVA) dan Analisis Risiko Keselamatan Pasien & Staf',
    2 => 'Pengelolaan B3 Medis, Sitotoksik, Gas Medis (O2/N2O), dan Limbah Infeksius Tajam',
    3 => 'Kesiapsiagaan Tanggap Darurat Bencana Faskes (Hospital Disaster Plan) & Kode Kedaruratan (Code Red, Blue, Black)',
    4 => 'Pencegahan dan Pengendalian Infeksi (PPI) Terintegrasi K3: APD Medis, Pajanan Jarum Suntik (Needlestick Injury)',
    5 => 'Ergonomi Rumah Sakit: Teknik Pemindahan Pasien (Patient Handling) & Pencegahan Nyeri Punggung Perawat',
    6 => 'Audit Manajemen Fasilitas dan Keselamatan (MFK) & Penyusunan Laporan Mutu K3RS',
  ),
  'faqs' => 
  array (
    0 => 
    array (
      'q' => 'Apakah seluruh rumah sakit wajib menerapkan sistem K3RS?',
      'a' => 'Ya. Permenkes No. 66 Tahun 2016 mewajibkan setiap rumah sakit membentuk satuan kerja K3RS independen yang bertanggung jawab langsung kepada direktur utama rumah sakit.',
    ),
    1 => 
    array (
      'q' => 'Bagaimana kaitan sertifikasi K3RS dengan akreditasi KARS?',
      'a' => 'Elemen K3RS merupakan penilaian mutlak dalam Bab MFK (Manajemen Fasilitas dan Keselamatan) akreditasi rumah sakit. Tanpa komite dan bukti pelatihan K3RS, faskes akan kehilangan poin akreditasi paripurna.',
    ),
    2 => 
    array (
      'q' => 'Apakah pelatihan ini bisa diselenggarakan in-house di rumah sakit kami?',
      'a' => 'Ya, kami melayani penyelenggaraan In-House Training K3RS terakreditasi langsung di rumah sakit Anda dengan simulasi evakuasi bangsal dan penanganan kode darurat.',
    ),
    3 => 
    array (
      'q' => 'Berapa lama masa berlaku sertifikat pelatihan K3RS?',
      'a' => 'Sertifikat pelatihan berlaku selama 3 tahun dan menjadi bukti kompetensi personil dalam audit berkala Disnaker maupun survei akreditasi KARS.',
    ),
  ),
  'related_hubs' => 
  array (
    0 => 
    array (
      'slug' => 'k3-laboratorium',
      'name' => 'K3 Laboratorium',
      'badge' => 'Kemnaker & BNSP',
      'desc' => 'Standar biosafety, chemical safety, dan penanganan patogen laboratorium medis.',
    ),
    1 => 
    array (
      'slug' => 'p3k',
      'name' => 'P3K di Tempat Kerja',
      'badge' => 'Kemnaker & BNSP',
      'desc' => 'Pertolongan pertama medis, resusitasi jantung paru dan tata kelola kotak P3K.',
    ),
    2 => 
    array (
      'slug' => 'penanggulangan-kebakaran',
      'name' => 'Penanggulangan Kebakaran',
      'badge' => 'Kemnaker RI',
      'desc' => 'Taktik penanganan kebakaran faskes (Code Red) dan evakuasi pasien rawat inap.',
    ),
    3 => 
    array (
      'slug' => 'k3-kimia',
      'name' => 'K3 Bahan Kimia',
      'badge' => 'Kemnaker RI',
      'desc' => 'Pengelolaan disinfektan medis, formalin, dan bahan kimia beracun rumah sakit.',
    ),
  ),
  'slug' => 'k3-rumah-sakit',
);

require __DIR__ . '/includes/hub-layout.php';
