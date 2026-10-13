<?php
/**
 * p3k.php — Hub Page: Pelatihan P3K di Tempat Kerja
 * Powered by includes/hub-layout.php
 */
require_once __DIR__ . '/config.php';

$hub_data = [
    'slug'        => 'p3k',
    'badge'       => 'P3K di Tempat Kerja',
    'title'       => 'Pelatihan P3K di Tempat Kerja: Sertifikasi Kemnaker RI & BNSP',
    'meta_title'  => 'Pelatihan P3K di Tempat Kerja Sertifikasi Kemnaker RI — Wahana Totalita',
    'meta_desc'   => 'Pelatihan Petugas P3K di Tempat Kerja bersertifikat resmi Kemnaker RI & BNSP sesuai Permenaker No. 15 Tahun 2008. Silabus CPR, jadwal, dan biaya terjangkau.',
    'intro_lead'  => 'Sertifikasi resmi Petugas P3K di tempat kerja sesuai Permenaker No. 15 Tahun 2008 untuk penanganan darurat medis kerja dan kepatuhan audit SMK3.',
    'intro'       => [
        'Pelatihan Pertolongan Pertama Pada Kecelakaan (P3K) di Tempat Kerja adalah program pembinaan wajib untuk membekali personel perusahaan dengan keterampilan medis darurat sebelum bantuan medis profesional tiba. Kewajiban ini diatur ketat dalam UU No. 1 Tahun 1970 dan Permenaker No. 15 Tahun 2008.',
        'Setiap perusahaan dengan tingkat bahaya rendah wajib memiliki sekurang-kurangnya 1 orang Petugas P3K untuk setiap 150 pekerja, dan 1 orang untuk setiap 100 pekerja di tempat kerja berisiko tinggi. Memiliki Petugas P3K berlisensi resmi Kemnaker RI memastikan kesiapsiagaan tanggap darurat dan kepatuhan audit SMK3 PP No. 50/2012.',
    ],
    'regulasi'    => [
        ['nomor' => 'Permenaker No. 15 Tahun 2008', 'desc' => 'Tentang Pertolongan Pertama pada Kecelakaan di Tempat Kerja. Mewajibkan penunjukan Petugas P3K berlisensi dan penyediaan ruang serta kotak P3K standar.'],
        ['nomor' => 'UU No. 1 Tahun 1970', 'desc' => 'Pasal 3 ayat (1) butir e mewajibkan pengusaha memberikan pertolongan pada kecelakaan kerja secara cepat dan memadai.'],
        ['nomor' => 'Kep. Dirjen Binwasnaker No. 53/2009', 'desc' => 'Pedoman teknis pembinaan dan pemberian lisensi Petugas P3K di tempat kerja oleh Kementerian Ketenagakerjaan RI.'],
    ],
    'comparison'  => [
        'headers' => ['Aspek Evaluasi', 'Petugas P3K Kemnaker RI', 'Petugas P3K First Aid BNSP'],
        'rows'    => [
            ['Dasar Regulasi', 'Permenaker No. 15 Tahun 2008', 'SKKNI Standar Kompetensi Kerja Nasional'],
            ['Sertifikasi & Lisensi', 'Sertifikat & Lisensi Resmi KEMNAKER RI', 'Sertifikat Kompetensi BNSP'],
            ['Kewajiban Legal', 'Wajib untuk kepatuhan hukum & audit Disnaker', 'Bukti kompetensi profesi terstandarisasi'],
            ['Durasi Pelatihan', '3 Hari Pelatihan (±30 Jam Tatap Muka)', '2–3 Hari Pelatihan & Uji Asesmen'],
            ['Masa Berlaku', 'Lisensi 3 Tahun (dapat diperpanjang)', 'Sertifikat 3 Tahun (perpanjangan asesmen)'],
        ],
    ],
    'programs'    => [
        [
            'slug'          => 'pelatihan-petugas-p3k-sertifikasi-kemnaker-ri',
            'name'          => 'Pelatihan & Lisensi Petugas P3K Kemnaker RI',
            'cert'          => 'Kemnaker RI',
            'mode'          => 'Tatap Muka & Praktik CPR',
            'duration'      => '3 Hari Pelatihan',
            'desc'          => 'Program pembinaan resmi bagi calon Petugas P3K perusahaan dengan kurikulum wajib Permenaker 15/2008, praktik RJP/CPR menggunakan manikin, penanganan fraktur, luka bakar, dan pengoperasian AED.',
            'target_peserta'=> 'Karyawan yang ditunjuk sebagai Petugas P3K resmi, tim tanggap darurat, HRGA, paramedis perusahaan',
        ],
        [
            'slug'          => 'pelatihan-petugas-p3k-sertifikasi-bnsp',
            'name'          => 'Pelatihan & Uji Kompetensi Petugas P3K BNSP',
            'cert'          => 'Sertifikasi BNSP',
            'mode'          => 'Blended / Uji Kompetensi',
            'duration'      => '3 Hari Pelatihan',
            'desc'          => 'Sertifikasi kompetensi berbasis standar SKKNI untuk menguji keterampilan pertolongan pertama, identifikasi korban cedera, resusitasi, serta pengelolaan logistik kotak P3K di fasilitas kerja.',
            'target_peserta'=> 'Safety committee, petugas keamanan gedung, tim rescue, personel operasional industri',
        ],
        [
            'slug'          => 'pelatihan-petugas-p3k-first-aid-online',
            'name'          => 'Pelatihan First Aid & Tanggap Darurat Medis',
            'cert'          => 'Sertifikasi BNSP / Kompetensi',
            'mode'          => 'Online / In-House',
            'duration'      => '2 Hari Pelatihan',
            'desc'          => 'Pelatihan intensif first responder untuk menangani pendarahan, syok, trauma benda tumpul, evakuasi tandu, dan pertolongan awal darurat di lingkungan perkantoran dan ritel.',
            'target_peserta'=> 'Resepsionis, supervisor, guru, pelatih olahraga, staf operasional umum',
        ],
    ],
    'syarat'      => [
        'Pendidikan minimal SLTA / SMA / SMK sederajat',
        'Surat rekomendasi / penugasan kerja dari perusahaan (atau pernyataan mandiri)',
        'Surat keterangan sehat jasmani dari dokter (mampu melakukan CPR dan penanganan fisik korban)',
        'Salinan KTP legalisir, ijazah terakhir, dan pas foto resmi background merah',
    ],
    'materi'      => [
        'Dasar-dasar K3 dan regulasi P3K di tempat kerja (Permenaker No. 15/2008)',
        'Prinsip dasar penilaian korban: DR-ABC (Danger, Response, Airway, Breathing, Circulation)',
        'Resusitasi Jantung Paru (RJP/CPR) dewasa, anak, dan bayi sesuai standar AHA/ERC',
        'Penggunaan Automated External Defibrillator (AED) dan pembebasan sumbatan jalan napas',
        'Tatalaksana pendarahan, penanganan syok, luka bakar, dan keracunan zat kimia',
        'Cedera muskuloskeletal: patah tulang, dislokasi, teknik pembidaian (splinting) dan pembalutan',
        'Evakuasi medis: teknik pemindahan korban darurat, penggunaan tandu dan spinal board',
        'Pemeriksaan, pengelolaan, dan pengisian kotak P3K standar Form A, B, dan C',
    ],
    'faqs'        => [
        [
            'q' => 'Apakah semua perusahaan wajib memiliki Petugas P3K bersertifikat?',
            'a' => 'Ya. Permenaker No. 15/2008 Pasal 2 mewajibkan setiap pengusaha dan pengurus menyediakan Petugas P3K berlisensi resmi di tempat kerja. Rasio wajibnya adalah 1 orang per 150 pekerja untuk tempat kerja potensi bahaya rendah, dan 1 orang per 100 pekerja untuk potensi bahaya tinggi.',
        ],
        [
            'q' => 'Apa perbedaan sertifikat P3K Kemnaker RI dengan BNSP?',
            'a' => 'Sertifikat dan Lisensi Kemnaker RI adalah kewajiban hukum untuk kepatuhan inspeksi ketenagakerjaan dan pemenuhan audit SMK3. Sedangkan sertifikasi BNSP menguji kompetensi kerja individu berbasis SKKNI yang diakui secara nasional untuk portofolio keahlian profesi.',
        ],
        [
            'q' => 'Berapa lama lisensi Petugas P3K berlaku dan bagaimana perpanjangannya?',
            'a' => 'Lisensi Petugas P3K Kemnaker RI berlaku selama 3 tahun. Lisensi dapat diperpanjang melalui evaluasi portofolio kegiatan P3K dan rekomendasi dokter perusahaan atau dinas ketenagakerjaan sebelum masa berlaku berakhir.',
        ],
        [
            'q' => 'Apakah pelatihan P3K mencakup praktik CPR langsung?',
            'a' => 'Ya, pelatihan tatap muka Wahana Totalita mengalokasikan 60% porsi waktu untuk demonstrasi dan praktik langsung menggunakan manikin CPR berteknologi sensor serta unit trainer AED.',
        ],
        [
            'q' => 'Apa saja jenis kotak P3K yang wajib disediakan perusahaan?',
            'a' => 'Permenaker 15/2008 mengelompokkan kotak P3K menjadi Tipe A (untuk ≤25 pekerja), Tipe B (untuk ≤50 pekerja), dan Tipe C (untuk ≤100 pekerja), dengan daftar isi wajib mencakup kasa steril, mitela, plester cepat, gunting perban, peniti, sarung tangan lateks, masker, pinset, dan povidone iodine.',
        ],
    ],
];

require __DIR__ . '/includes/hub-layout.php';