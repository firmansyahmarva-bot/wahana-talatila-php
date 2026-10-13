<?php
/**
 * k3-kimia.php — Hub Page: Pelatihan K3 Kimia (Petugas & Ahli K3 Kimia)
 * Powered by includes/hub-layout.php
 */
require_once __DIR__ . '/config.php';

$hub_data = [
    'slug'        => 'k3-kimia',
    'badge'       => 'K3 Bahan Kimia Berbahaya',
    'title'       => 'Pelatihan K3 Kimia: Petugas & Ahli K3 Kimia Kemnaker RI',
    'meta_title'  => 'Pelatihan K3 Kimia (Petugas & Ahli) Sertifikasi Kemnaker RI — Wahana Totalita',
    'meta_desc'   => 'Pelatihan K3 Kimia resmi bersertifikat Kemnaker RI sesuai Kepmenaker No. 187/MEN/1999. Program Petugas & Ahli K3 Kimia. Silabus, jadwal & biaya terjangkau.',
    'intro_lead'  => 'Sertifikasi resmi Kemnaker RI untuk Petugas K3 Kimia dan Ahli K3 Kimia sesuai mandat Kepmenaker No. 187/MEN/1999 guna mitigasi kecelakaan bahan kimia berbahaya.',
    'intro'       => [
        'Penggunaan Bahan Kimia Berbahaya (BKB) dalam proses industri manufaktur, farmasi, petrokimia, dan laboratorium komersial membawa risiko tinggi seperti keracunan gas, luka bakar kimiawi, reaksi ledakan eksotermik, hingga pencemaran lingkungan massal. Setiap siklus bahan kimia — mulai dari penerimaan, penyimpanan di tangki/gudang, pemindahan, hingga pembuangan limbah B3 — memerlukan prosedur pengendalian teknis yang ketat.',
        'Sesuai mandat Kepmenaker No. 187/MEN/1999 tentang Pengendalian Bahan Kimia Berbahaya di Tempat Kerja, perusahaan dengan potensi bahaya besar wajib mempekerjakan sekurang-kurangnya 1 orang Ahli K3 Kimia dan 2 orang Petugas K3 Kimia, sedangkan perusahaan dengan potensi bahaya menengah wajib memiliki minimal 1 orang Petugas K3 Kimia bersertifikat resmi Kementerian Ketenagakerjaan RI.',
    ],
    'regulasi'    => [
        ['nomor' => 'Kepmenaker No. 187/MEN/1999', 'desc' => 'Tentang Pengendalian Bahan Kimia Berbahaya di Tempat Kerja. Mengatur kewajiban penyediaan Petugas & Ahli K3 Kimia, penyusunan SDS/LDK, penetapan kategori potensi bahaya, dan dokumen MPPKB.'],
        ['nomor' => 'PP No. 74 Tahun 2001', 'desc' => 'Tentang Pengelolaan Bahan Berbahaya dan Beracun (B3). Standar nasional klasifikasi, penyimpanan, pelabelan simbol bahaya, dan pengangkutan bahan beracun.'],
        ['nomor' => 'Permenaker No. 05 Tahun 2018', 'desc' => 'K3 Lingkungan Kerja — menetapkan Nilai Ambang Batas (NAB) faktor kimia di udara tempat kerja serta indikator pajanan biologis pekerja.'],
        ['nomor' => 'UU No. 1 Tahun 1970', 'desc' => 'Pasal 3 mewajibkan syarat keselamatan kerja untuk mencegah dan mengendalikan timbulnya penyakit akibat kerja dan keracunan akibat paparan bahan kimia.'],
    ],
    'comparison'  => [
        'headers' => ['Aspek Evaluasi', 'Petugas K3 Kimia', 'Ahli K3 Kimia'],
        'rows'    => [
            ['Peran Pokok Industri', 'Pelaksana teknis operasional & logistik BKB', 'Perencana sistem, auditor & penanggung jawab teknis'],
            ['Kategori Wajib Pabrik', 'Wajib di potensi bahaya kimia menengah & besar', 'Wajib mutlak pada industri potensi bahaya kimia besar'],
            ['Wewenang Lapangan', 'Pemeriksaan SDS, simbol GHS, APD & spill kit', 'Penyusunan MPPKB, analisis HAZOP & audit keselamatan proses'],
            ['Durasi Pelatihan', '±60 Jam Pembinaan (6 Hari Pelatihan)', '±80 Jam Pembinaan (10–12 Hari Kerja)'],
            ['Pendidikan Minimal', 'SMA / SMK + pengalaman di penanganan kimia', 'D3 / S1 Teknik Kimia, Mesin, MIPA atau bidang eksakta'],
            ['Sertifikasi & Lisensi', 'Sertifikat & Lisensi Petugas K3 Kimia Kemnaker', 'SKP & Lisensi Ahli K3 Kimia Resmi Kemnaker RI'],
        ],
    ],
    'programs'    => [
        [
            'slug'          => 'pelatihan-petugas-k3-kimia-sertifikasi-kemnaker-ri',
            'name'          => 'Pelatihan Petugas K3 Kimia Sertifikasi Kemnaker RI',
            'cert'          => 'Kemnaker RI',
            'mode'          => 'Tatap Muka & Praktik Lab/Gudang',
            'duration'      => '6 Hari Pelatihan',
            'desc'          => 'Pembinaan kompetensi resmi bagi teknisi dan operator gudang kimia industri. Membekali kemampuan membaca Lembar Data Keselamatan (SDS/MSDS 16 poin), penandaan label piktogram GHS, penanganan insiden tumpahan kimia menggunakan spill kit, dan tata cara penyimpanan aman.',
            'target_peserta'=> 'Operator gudang B3, analis laboratorium, supervisor proses produksi, safety officer pabrik farmasi/tekstil/cat',
        ],
        [
            'slug'          => 'pelatihan-ahli-k3-kimia-sertifikasi-kemnaker-ri',
            'name'          => 'Pelatihan Ahli K3 Kimia Sertifikasi Kemnaker RI',
            'cert'          => 'Kemnaker RI',
            'mode'          => 'Blended / Tatap Muka',
            'duration'      => '12 Hari Pelatihan',
            'desc'          => 'Kualifikasi tenaga ahli K3 kimia tingkat manajerial untuk memimpin sistem keselamatan bahan kimia, merancang Dokumen Manajemen Program Pencegahan Kecelakaan Besar (MPPKB), evaluasi integritas tangki timbun, dan pelaporan berkala kepatuhan ke Kemnaker RI.',
            'target_peserta'=> 'HSE manager pabrik petrokimia/pupuk, chemical process engineer, kepala laboratorium uji, konsultan K3 industri',
        ],
        [
            'slug'          => 'pelatihan-hazard-dan-operability-studies-hazops-sertifikasi-bnsp',
            'name'          => 'Pelatihan Hazard & Operability Studies (HAZOPs) BNSP',
            'cert'          => 'Sertifikasi BNSP',
            'mode'          => 'Blended / Online',
            'duration'      => '3 Hari Pelatihan',
            'desc'          => 'Pelatihan metodologi identifikasi bahaya kualitatif terstruktur untuk mengevaluasi penyimpangan proses industri (aliran, temperatur, tekanan) pada sistem perpipaan dan reaktor kimia guna mencegah ledakan maupun pelepasan gas beracun.',
            'target_peserta'=> 'Process engineer, plant designer, safety auditor, inspektur keselamatan proses fasilitas migas dan petrokimia',
        ],
    ],
    'syarat'      => [
        'Ijazah minimal SMA/SMK sederajat (untuk Petugas) atau D3/S1 Teknik/Kimia/MIPA/K3 (untuk Ahli K3)',
        'Surat penugasan / rekomendasi dari pimpinan perusahaan pengutus (atau surat pernyataan mandiri)',
        'Salinan KTP legalisir, ijazah terakhir, transkrip nilai, dan pas foto resmi background merah',
        'Surat keterangan sehat dari dokter (menyatakan tidak buta warna total/parsial)',
    ],
    'materi'      => [
        'Kebijakan K3 Nasional & Regulasi Kepmenaker No. 187/MEN/1999 tentang Pengendalian BKB',
        'Klasifikasi Bahan Kimia Berbahaya berdasarkan Sistem Harmonisasi Global (GHS) PBB',
        'Studi Komprehensif & Penyusunan Lembar Data Keselamatan (Safety Data Sheet - SDS) 16 Poin',
        'Manajemen Pergudangan Kimia: Kompatibilitas Penyimpanan, Bundwall, dan Ventilasi Anti-Ledakan',
        'Prosedur Tanggap Darurat Tumpahan Bahan Kimia: Prosedur Spill Kit, Netralisasi & APD Respirator BKB',
        'Pengendalian Paparan Faktor Kimia Lingkungan Kerja & Monitoring Nilai Ambang Batas (NAB)',
        'Manajemen Program Pencegahan Kecelakaan Besar (MPPKB) & Analisis Kuantitatif Risiko Kimia',
        'PKL Observasi Lapangan Pabrik Kimia, Penyusunan Laporan Evaluasi & Ujian Sertifikasi Kemnaker RI',
    ],
    'faqs'        => [
        [
            'q' => 'Apa kriteria perusahaan yang wajib memiliki Petugas dan Ahli K3 Kimia?',
            'a' => 'Sesuai Kepmenaker No. 187/MEN/1999, perusahaan yang memproduksi atau menggunakan Bahan Kimia Berbahaya (BKB) dikelompokkan menjadi potensi bahaya menengah dan besar berdasarkan kuantitas bahan kimia yang ada. Perusahaan potensi bahaya menengah wajib memiliki minimal 1 Petugas K3 Kimia, sedangkan potensi bahaya besar wajib memiliki minimal 1 Ahli K3 Kimia dan 2 Petugas K3 Kimia.',
        ],
        [
            'q' => 'Apa perbedaan pokok antara MSDS dengan SDS?',
            'a' => 'MSDS (Material Safety Data Sheet) adalah format lama yang belum seragam secara global. SDS (Safety Data Sheet) adalah format standar internasional modern berdasarkan sistem GHS (Globally Harmonized System) dengan struktur wajib 16 bab terstandarisasi yang kini resmi diadopsi oleh regulasi ketenagakerjaan Indonesia.',
        ],
        [
            'q' => 'Berapa lama masa berlaku sertifikat dan lisensi K3 Kimia Kemnaker RI?',
            'a' => 'Sertifikat pembinaan Kemnaker RI berlaku seumur hidup sebagai bukti kompetensi. Sementara Lisensi Kewenangan / SKP Petugas dan Ahli K3 Kimia berlaku selama 3 tahun dan dapat diperpanjang secara berkala sebelum masa berlaku berakhir.',
        ],
        [
            'q' => 'Apakah pelatihan Petugas K3 Kimia dapat diikuti oleh karyawan lulusan SMA/SMK?',
            'a' => 'Ya. Syarat pendidikan untuk skema Petugas K3 Kimia adalah minimal SLTA/SMA/SMK sederajat dengan pengalaman kerja di fasilitas yang menangani bahan kimia berbahaya.',
        ],
    ],
    'related_hubs'=> [
        [
            'slug'  => 'higiene-industri',
            'name'  => 'Higiene Industri (HIMU/HIMA)',
            'badge' => 'BNSP & Kemnaker',
            'desc'  => 'Pengukuran paparan debu, uap kimia, kebisingan, dan pemantauan ergonomi lingkungan kerja.',
        ],
        [
            'slug'  => 'p3k',
            'name'  => 'P3K di Tempat Kerja',
            'badge' => 'Kemnaker & BNSP',
            'desc'  => 'Pertolongan pertama pada korban percikan kimia, luka bakar asam/basa, dan keracunan inhalasi.',
        ],
        [
            'slug'  => 'penanggulangan-kebakaran',
            'name'  => 'Penanggulangan Kebakaran',
            'badge' => 'Kemnaker RI',
            'desc'  => 'Pemadaman kebakaran bahan kimia reaktif, media busa (foam system), dan fire fighting B3.',
        ],
        [
            'slug'  => 'k3-laboratorium',
            'name'  => 'K3 Laboratorium',
            'badge' => 'Kemnaker & BNSP',
            'desc'  => 'Standar biosafety, chemical fume hood, dan penanganan reagen kimia di lingkungan laboratorium.',
        ],
    ],
];

require __DIR__ . '/includes/hub-layout.php';