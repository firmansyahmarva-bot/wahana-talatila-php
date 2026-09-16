<?php
/**
 * sertifikasi-bnsp.php — Hub Page
 * Powered by includes/hub-layout.php
 */
require_once __DIR__ . '/config.php';

$hub_data = array (
  'badge' => 'Sertifikasi Profesi BNSP',
  'title' => 'Pelatihan Sertifikasi BNSP: Uji Kompetensi K3 & Profesi Nasional',
  'meta_title' => 'Pelatihan Sertifikasi BNSP (Ahli K3, POP, Auditor, First Aid) — Wahana Totalita',
  'meta_desc' => 'Layanan Uji Kompetensi & Sertifikasi Profesi BNSP berlogo Garuda Emas. Skema Ahli K3 Umum, Ahli K3 Konstruksi, POP Tambang, First Aid, Higiene Industri.',
  'intro_lead' => 'Layanan bimbingan intensif dan fasilitasi uji kompetensi sertifikasi profesi BNSP dengan lisensi resmi logo Garuda Emas untuk seluruh skema keahlian K3 nasional.',
  'intro' => 
  array (
    0 => 'Badan Nasional Sertifikasi Profesi (BNSP) adalah lembaga independen yang dibentuk oleh Pemerintah Indonesia berdasarkan UU No. 13 Tahun 2003 untuk menjamin mutu kompetensi tenaga kerja melalui pengakuan sertifikasi profesi berstandar SKKNI (Standar Kompetensi Kerja Nasional Indonesia).',
    1 => 'Sertifikat kompetensi BNSP berlogo Garuda Emas diakui secara nasional maupun regional ASEAN (melalui kerangka MRA), menjadi bukti valid integritas keahlian profesi yang diakui oleh dunia industri, BUMN, kontraktor multinasional, dan instansi pemerintah.',
  ),
  'regulasi' => 
  array (
    0 => 
    array (
      'nomor' => 'UU No. 13 Tahun 2003 tentang Ketenagakerjaan',
      'desc' => 'Pasal 18 mengatur hak tenaga kerja memperoleh sertifikasi kompetensi kerja melalui Badan Nasional Sertifikasi Profesi.',
    ),
    1 => 
    array (
      'nomor' => 'PP No. 10 Tahun 2018 tentang BNSP',
      'desc' => 'Mengatur tugas, fungsi, dan wewenang BNSP dalam menyelenggarakan sertifikasi kompetensi profesi nasional.',
    ),
    2 => 
    array (
      'nomor' => 'SKKNI Berbagai Bidang K3',
      'desc' => 'Standar Kompetensi Kerja Nasional Indonesia yang menjadi tolak ukur pengujian unit kompetensi oleh asesor berlisensi.',
    ),
  ),
  'comparison' => 
  array (
    'headers' => 
    array (
      0 => 'Aspek Evaluasi',
      1 => 'Sertifikasi Kemnaker RI',
      2 => 'Sertifikasi Profesi BNSP',
    ),
    'rows' => 
    array (
      0 => 
      array (
        0 => 'Fungsi Pokok',
        1 => 'Kepatuhan regulasi hukum & penunjukan operasional',
        2 => 'Pengakuan kompetensi profesi keahlian kerja individu',
      ),
      1 => 
      array (
        0 => 'Dokumen Terbit',
        1 => 'Sertifikat Pembinaan & Lisensi K3 / SKP',
        2 => 'Sertifikat Kompetensi Kerja berlogo Garuda Emas',
      ),
      2 => 
      array (
        0 => 'Pengakuan Pasar',
        1 => 'Wajib hukum untuk audit Disnaker & SMK3 pabrik',
        2 => 'Standar keahlian profesi tender, BUMN, KKKS & ASEAN',
      ),
      3 => 
      array (
        0 => 'Metode Evaluasi',
        1 => 'Ujian regulasi, teori pembinaan & studi kasus',
        2 => 'Uji portofolio bukti kerja, wawancara & observasi asesor',
      ),
      4 => 
      array (
        0 => 'Masa Berlaku',
        1 => 'Lisensi 3–5 tahun (wajib diperpanjang)',
        2 => 'Sertifikat 3 tahun (perpanjangan uji kompetensi)',
      ),
    ),
  ),
  'programs' => 
  array (
    0 => 
    array (
      'slug' => 'pelatihan-ahli-k3-umum-sertifikasi-bnsp',
      'name' => 'Pelatihan & Uji Kompetensi Ahli K3 Umum BNSP',
      'cert' => 'Sertifikasi BNSP',
      'mode' => 'Blended / Uji Kompetensi',
      'duration' => '4 Hari Pelatihan',
      'desc' => 'Sertifikasi kompetensi Ahli K3 Umum berbasis SKKNI untuk membuktikan kepakaran identifikasi bahaya, penyusunan kebijakan K3, dan kepemimpinan keselamatan kerja.',
      'target_peserta' => 'HSE officer, lulusan D3/S1 teknik/kesehatan, supervisor operasional, calon konsultan K3',
    ),
    1 => 
    array (
      'slug' => 'pelatihan-ahli-muda-k3-konstruksi-online',
      'name' => 'Pelatihan Ahli Muda K3 Konstruksi BNSP',
      'cert' => 'Sertifikasi BNSP',
      'mode' => 'Blended / Online',
      'duration' => '5 Hari Pelatihan',
      'desc' => 'Sertifikasi kompetensi keselamatan proyek konstruksi berbasis SMKK untuk syarat tender LPSE dan pengawasan site.',
      'target_peserta' => 'Site engineer, pelaksana proyek sipil, konsultan pengawas, tenaga ahli tender',
    ),
    2 => 
    array (
      'slug' => 'pelatihan-petugas-p3k-sertifikasi-bnsp',
      'name' => 'Pelatihan Petugas P3K (First Aid) BNSP',
      'cert' => 'Sertifikasi BNSP',
      'mode' => 'Tatap Muka & Praktik CPR',
      'duration' => '3 Hari Pelatihan',
      'desc' => 'Sertifikasi kompetensi first responder darurat medis di fasilitas kerja industri dan komersial.',
      'target_peserta' => 'Tim tanggap darurat, security officer, paramedis, staf umum perusahaan',
    ),
  ),
  'syarat' => 
  array (
    0 => 'Pendidikan minimal sesuai skema LSP (SMA/SMK untuk level operator, D3/S1 untuk level ahli/analis)',
    1 => 'Curriculum Vitae (CV) portofolio pengalaman kerja yang relevan dengan unit kompetensi',
    2 => 'Bukti kerja (job description, laporan kerja, sertifikat pelatihan pendukung, SOP)',
    3 => 'Salinan KTP legalisir, ijazah terakhir, transkrip nilai, dan pas foto resmi background merah',
  ),
  'materi' => 
  array (
    0 => 'Pemahaman Standar Kompetensi Kerja Nasional Indonesia (SKKNI) Bidang K3',
    1 => 'Penyusunan Portofolio Bukti Kompetensi Kerja (Form APL-01 dan APL-02)',
    2 => 'Identifikasi Bahaya dan Penilaian Risiko di Lingkungan Kerja (HIRARC/IBPR)',
    3 => 'Perancangan Sistem Pengendalian Risiko & Penyusunan Izin Kerja Bahaya Tinggi (PTW)',
    4 => 'Teknik Komunikasi K3, Presentasi Safety Briefing, dan Pelaporan Investigasi Insiden',
    5 => 'Simulasi Wawancara Asesmen Mandiri & Uji Demonstrasi Asesor Kompetensi BNSP',
  ),
  'faqs' => 
  array (
    0 => 
    array (
      'q' => 'Apa beda sertifikasi BNSP dengan Kemnaker RI?',
      'a' => 'Kemnaker RI berfokus pada perizinan hukum dan kewenangan legal operasional di Indonesia. BNSP berfokus pada pengakuan standarisasi kompetensi kerja profesi berbasis SKKNI yang diakui secara luas di industri nasional maupun regional.',
    ),
    1 => 
    array (
      'q' => 'Berapa lama masa berlaku sertifikat BNSP?',
      'a' => 'Sertifikat kompetensi yang diterbitkan oleh BNSP berlaku selama 3 tahun dan dapat diperpanjang melalui proses resertifikasi / asesmen portofolio.',
    ),
    2 => 
    array (
      'q' => 'Apakah ada ujian tertulis dalam sertifikasi BNSP?',
      'a' => 'Asesmen BNSP menggunakan metode holistik: verifikasi portofolio bukti kerja, ujian tertulis/lisan, dan wawancara kompetensi bersama asesor terlisensi.',
    ),
    3 => 
    array (
      'q' => 'Apakah Wahana Totalita bekerjasama dengan LSP resmi?',
      'a' => 'Ya, Wahana Totalita bermitra resmi dengan Lembaga Sertifikasi Profesi (LSP) berlisensi BNSP untuk memfasilitasi uji kompetensi seluruh skema K3.',
    ),
  ),
  'related_hubs' => 
  array (
    0 => 
    array (
      'slug' => 'k3-konstruksi',
      'name' => 'K3 Konstruksi',
      'badge' => 'Kemnaker & BNSP',
      'desc' => 'Uji kompetensi Ahli Muda, Madya, Utama K3 Konstruksi bersertifikat BNSP.',
    ),
    1 => 
    array (
      'slug' => 'k3-migas',
      'name' => 'K3 Migas',
      'badge' => 'BNSP & ESDM',
      'desc' => 'Uji kompetensi Pengawas K3 Migas dan Operator K3 Migas berlisensi BNSP.',
    ),
    2 => 
    array (
      'slug' => 'k3-pertambangan',
      'name' => 'K3 Pertambangan',
      'badge' => 'BNSP & ESDM',
      'desc' => 'Uji kompetensi Pengawas Operasional Pratama (POP) dan Madya (POM) tambang.',
    ),
    3 => 
    array (
      'slug' => 'higiene-industri',
      'name' => 'Higiene Industri',
      'badge' => 'BNSP & Kemnaker',
      'desc' => 'Sertifikasi kompetensi HIMU, HIMA, dan HIU resmi dari BNSP.',
    ),
  ),
  'slug' => 'sertifikasi-bnsp',
);

require __DIR__ . '/includes/hub-layout.php';
