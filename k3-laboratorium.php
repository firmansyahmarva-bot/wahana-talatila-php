<?php
/**
 * k3-laboratorium.php — Hub Page
 * Powered by includes/hub-layout.php
 */
require_once __DIR__ . '/config.php';

$hub_data = array (
  'badge' => 'K3 Laboratorium',
  'title' => 'Pelatihan K3 Laboratorium: Biosafety, Chemical Safety & Uji Kalibrasi',
  'meta_title' => 'Pelatihan K3 Laboratorium (Chemical & Biological Safety) — Wahana Totalita',
  'meta_desc' => 'Pelatihan K3 Laboratorium kimia, biologi & mikrobiologi sesuai ISO/IEC 17025 & standar biosafety. Fume hood, spill kit, dan APD lab. Silabus & jadwal.',
  'intro_lead' => 'Sertifikasi kompetensi K3 Laboratorium pengujian kimia, mikrobiologi, dan faskes sesuai standar ISO/IEC 17025 dan Permenaker No. 05/2018.',
  'intro' => 
  array (
    0 => 'Laboratorium riset, pengujian kualitas (QC/QA), mikrobiologi, dan klinik merupakan zona kerja dengan risiko kimiawi dan biologi tinggi. Analis lab terpapar uap reagen asam kuat, pelarut organik karsinogenik, bahan reaktif, hingga agen biologis infeksius.',
    1 => 'Penerapan K3 Laboratorium yang terstandarisasi memastikan kepatuhan akreditasi laboratorium ISO/IEC 17025, perlindungan personil dari paparan zat beracun, dan pencegahan kontaminasi sampel maupun lingkungan sekitar.',
  ),
  'regulasi' => 
  array (
    0 => 
    array (
      'nomor' => 'ISO/IEC 17025:2017',
      'desc' => 'Persyaratan Umum Kompetensi Laboratorium Pengujian dan Kalibrasi (klausul fasilitas dan kondisi lingkungan kerja).',
    ),
    1 => 
    array (
      'nomor' => 'Permenaker No. 05 Tahun 2018',
      'desc' => 'Standar K3 Lingkungan Kerja — Nilai Ambang Batas (NAB) uap kimia beracun di ruang kerja laboratorium tertutup.',
    ),
    2 => 
    array (
      'nomor' => 'WHO Laboratory Biosafety Manual',
      'desc' => 'Panduan tingkat keselamatan hayati (Biosafety Level 1–4) dan pengoperasian biosafety cabinet (BSC).',
    ),
  ),
  'comparison' => 
  array (
    'headers' => 
    array (
      0 => 'Aspek Evaluasi',
      1 => 'K3 Lab Kimia',
      2 => 'K3 Lab Biologi / Medis',
    ),
    'rows' => 
    array (
      0 => 
      array (
        0 => 'Fokus Bahaya',
        1 => 'Asam kuat, pelarut organik, bahan mudah meledak',
        2 => 'Bakteri, virus patogen, biakan kultur & darah',
      ),
      1 => 
      array (
        0 => 'Peralatan Proteksi',
        1 => 'Lemari asam (Fume Hood) & safety shower',
        2 => 'Biosafety Cabinet (BSC) & autoclave dekontaminasi',
      ),
      2 => 
      array (
        0 => 'Penyimpanan Aman',
        1 => 'Berdasarkan tabel kompatibilitas kimia & SDS',
        2 => 'Cold storage terkontrol & biohazard labeling',
      ),
      3 => 
      array (
        0 => 'Durasi Pelatihan',
        1 => '±24 Jam Pelatihan (3 Hari)',
        2 => '±24 Jam Pelatihan (3 Hari)',
      ),
      4 => 
      array (
        0 => 'Sertifikasi',
        1 => 'Sertifikat Kompetensi K3 Laboratorium',
        2 => 'Sertifikat Biosafety & K3 Laboratorium',
      ),
    ),
  ),
  'programs' => 
  array (
    0 => 
    array (
      'slug' => 'pelatihan-petugas-k3-kimia-sertifikasi-kemnaker-ri',
      'name' => 'Pelatihan Petugas K3 Kimia Laboratorium Kemnaker RI',
      'cert' => 'Kemnaker RI',
      'mode' => 'Tatap Muka & Praktik Lab',
      'duration' => '6 Hari Pelatihan',
      'desc' => 'Sertifikasi resmi Kemnaker RI untuk analis dan supervisor laboratorium kimia industri. Mempelajari SDS 16 bab, netralisasi tumpahan kimia reaktif, dan sistem ventilasi lemari asam.',
      'target_peserta' => 'Analis lab QC/QA, teknisi kimia, supervisor laboratorium industri, staf litbang',
    ),
  ),
  'syarat' => 
  array (
    0 => 'Pendidikan minimal SMK Analis Kimia, D3/S1 Kimia, Farmasi, Biologi, atau Sains Terapan',
    1 => 'Salinan KTP legalisir, ijazah terakhir, dan pas foto resmi background merah',
    2 => 'Surat rekomendasi kerja dari laboratorium atau instansi pengutus',
  ),
  'materi' => 
  array (
    0 => 'Prinsip Dasar K3 Laboratorium & Regulasi Standar ISO/IEC 17025',
    1 => 'Identifikasi Bahaya Reagen Kimia: Bahan Korosif, Toksik, Reaktif Air, dan Oksidator',
    2 => 'Standar Pengoperasian Lemari Asam (Fume Hood) & Alat Pelindung Diri (Respirator Lab, Kacamata Goggles)',
    3 => 'Teknik Penanganan Tumpahan Bahan Kimia (Chemical Spill Response) & Eyewash/Safety Shower Station',
    4 => 'Prinsip Biosafety dan Biosecurity: Penggunaan Biosafety Cabinet (BSC Class I/II/III)',
    5 => 'Manajemen Penyimpanan Bahan Kimia (Chemical Incompatibility Chart) & Inventarisasi B3',
    6 => 'Pengelolaan Limbah B3 Cair & Padat Laboratorium Sebelum Diolah ke IPAL',
  ),
  'faqs' => 
  array (
    0 => 
    array (
      'q' => 'Apakah personil laboratorium wajib memiliki sertifikat K3?',
      'a' => 'Ya. Personil laboratorium wajib memiliki pemahaman K3 bersertifikat untuk memenuhi standar akreditasi KAN ISO/IEC 17025 serta audit SMK3 Kementerian Ketenagakerjaan.',
    ),
    1 => 
    array (
      'q' => 'Apakah materi mencakup cara penanganan tumpahan bahan kimia tumpah?',
      'a' => 'Ya, teknik penggunaan spill kit asam, basa, dan pelarut organik dipraktikkan secara langsung dalam modul pelatihan.',
    ),
    2 => 
    array (
      'q' => 'Berapa lama masa berlaku sertifikat K3 Laboratorium?',
      'a' => 'Sertifikat pelatihan berlaku selama 3 tahun dan dapat diperpanjang melalui program penyegaran (refresher course).',
    ),
    3 => 
    array (
      'q' => 'Apakah melayani pelatihan in-house di lab universitas atau litbang industri?',
      'a' => 'Ya, kami melayani penyelenggaraan in-house training langsung di fasilitas laboratorium perusahaan atau universitas Anda di seluruh Indonesia.',
    ),
  ),
  'related_hubs' => 
  array (
    0 => 
    array (
      'slug' => 'k3-kimia',
      'name' => 'K3 Bahan Kimia',
      'badge' => 'Kemnaker RI',
      'desc' => 'Pengelolaan bahan kimia berbahaya, SDS, dan sertifikasi Petugas K3 Kimia.',
    ),
    1 => 
    array (
      'slug' => 'k3-rumah-sakit',
      'name' => 'K3 Rumah Sakit',
      'badge' => 'KARS & Kemnaker',
      'desc' => 'Keselamatan laboratorium patologi klinik dan penanganan limbah medis infeksius.',
    ),
    2 => 
    array (
      'slug' => 'higiene-industri',
      'name' => 'Higiene Industri',
      'badge' => 'BNSP & Kemnaker',
      'desc' => 'Pengukuran kualitas udara ruang lab tertutup dan kalibrasi alat ukur lingkungan.',
    ),
    3 => 
    array (
      'slug' => 'k3-lingkungan',
      'name' => 'K3 Lingkungan',
      'badge' => 'Kemnaker & BNSP',
      'desc' => 'Baku mutu efluen air limbah lab dan manifest pengelolaan limbah B3.',
    ),
  ),
  'slug' => 'k3-laboratorium',
);

require __DIR__ . '/includes/hub-layout.php';
