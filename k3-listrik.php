<?php
/**
 * k3-listrik.php — Hub Page: Pelatihan K3 Listrik (Teknisi & Ahli K3 Listrik)
 * Powered by includes/hub-layout.php
 */
require_once __DIR__ . '/config.php';

$hub_data = [
    'slug'        => 'k3-listrik',
    'badge'       => 'K3 Kelistrikan & PUIL',
    'title'       => 'Pelatihan K3 Listrik: Teknisi & Ahli K3 Listrik Kemnaker RI',
    'meta_title'  => 'Pelatihan K3 Listrik (Teknisi & Ahli) Sertifikasi Kemnaker RI — Wahana Totalita',
    'meta_desc'   => 'Pelatihan K3 Listrik resmi bersertifikat Kemnaker RI sesuai Permenaker No. 12 Tahun 2015. Program Teknisi & Ahli K3 Listrik. Silabus, jadwal, dan biaya terjangkau.',
    'intro_lead'  => 'Sertifikasi resmi Kemnaker RI untuk teknisi dan pengawas instalasi listrik industri sesuai regulasi Permenaker No. 12 Tahun 2015 dan standar PUIL 2020.',
    'intro'       => [
        'K3 Listrik adalah penerapan standar keselamatan dan kesehatan kerja pada perencanaan, pemasangan, pengoperasian, pemeliharaan, dan inspeksi instalasi listrik di lingkungan industri serta gedung komersial. Bahaya listrik mencakup sengatan listrik (electric shock), kebakaran akibat korsleting, ledakan panel, hingga pelepasan energi busur api (arc flash).',
        'Sesuai ketentuan nasional, kecelakaan fatal akibat listrik menduduki peringkat ketiga tertinggi di Indonesia. Oleh karena itu, Kementerian Ketenagakerjaan RI mewajibkan setiap tempat kerja yang mengoperasikan instalasi pembangkit, transmisi, distribusi, maupun pemanfaatan energi listrik di atas batas aman untuk memiliki tenaga kerja yang kompeten dan bersertifikat resmi.',
    ],
    'regulasi'    => [
        ['nomor' => 'Permenaker No. 12 Tahun 2015', 'desc' => 'Tentang Keselamatan dan Kesehatan Kerja Listrik di Tempat Kerja. Mewajibkan penunjukan Teknisi dan Ahli K3 Listrik pada instalasi bertegangan di atas 50V AC atau 120V DC.'],
        ['nomor' => 'SNI 0225:2020 (PUIL 2020)', 'desc' => 'Persyaratan Umum Instalasi Listrik 2020 sebagai standar wajib perancangan, proteksi arus lebih, sistem pembumian (grounding), dan mitigasi bahaya termal listrik.'],
        ['nomor' => 'UU No. 1 Tahun 1970', 'desc' => 'Pasal 2 dan 3 mewajibkan syarat keselamatan kerja pada setiap tempat kerja yang menggunakan, memproduksi, membangkitkan, atau menyalurkan tenaga listrik.'],
    ],
    'comparison'  => [
        'headers' => ['Aspek Evaluasi', 'Teknisi K3 Listrik', 'Ahli K3 Listrik'],
        'rows'    => [
            ['Peran Pokok', 'Pelaksana teknis operasional & maintenance', 'Perencana, pengawas, auditor & penanggung jawab'],
            ['Kewenangan', 'Bekerja pada instalasi listrik & LOTO', 'Mengesahkan laporan, audit PUIL & rekomendasi mitigasi'],
            ['Durasi Kursus', '±40 Jam Pelatihan (6 Hari)', '±120 Jam Pelatihan (12 Hari Kerja)'],
            ['Pendidikan Minimal', 'SMK Teknik Listrik / Elektro sederajat', 'D3 / S1 Teknik (Diutamakan Elektro / Listrik)'],
            ['Sertifikasi', 'Sertifikat & Lisensi KEMNAKER RI', 'SKP & Lisensi Ahli K3 Listrik KEMNAKER RI'],
        ],
    ],
    'programs'    => [
        [
            'slug'          => 'pelatihan-k3-teknisi-listrik-sertifikasi-kemnaker-ri',
            'name'          => 'Pelatihan & Sertifikasi Teknisi K3 Listrik Kemnaker RI',
            'cert'          => 'Kemnaker RI',
            'mode'          => 'Tatap Muka & Praktik',
            'duration'      => '6 Hari Pelatihan',
            'desc'          => 'Program pembinaan kompetensi bagi teknisi dan maintenance engineer untuk melaksanakan pekerjaan operasional, perawatan instalasi listrik, pengukuran grounding, dan prosedur Lockout/Tagout (LOTO) secara aman sesuai standar Kemnaker RI.',
            'target_peserta'=> 'Teknisi listrik, electrical maintenance, supervisor utilitas, teknisi panel industri',
        ],
        [
            'slug'          => 'pelatihan-ahli-k3-listrik-sertifikasi-kemnaker-ri',
            'name'          => 'Pelatihan & Sertifikasi Ahli K3 Listrik Kemnaker RI',
            'cert'          => 'Kemnaker RI',
            'mode'          => 'Blended / Tatap Muka',
            'duration'      => '12 Hari Pelatihan',
            'desc'          => 'Kualifikasi tertinggi pengawas K3 listrik yang berwenang melakukan inspeksi kelayakan instalasi listrik, perhitungan arus hubung singkat, evaluasi proteksi arc flash, serta pelaporan berkala kepatuhan PUIL ke dinas ketenagakerjaan.',
            'target_peserta'=> 'Electrical engineer, HSE coordinator, manager fasilitas, konsultan instalasi listrik',
        ],
    ],
    'syarat'      => [
        'Ijazah minimal SMK Teknik (untuk Teknisi) atau D3/S1 Teknik Elektro/Listrik/Mesin (untuk Ahli K3 Listrik)',
        'Surat rekomendasi / keterangan kerja dari perusahaan pengutus (atau surat pernyataan mandiri bagi fresh graduate)',
        'Fotokopi KTP, salinan ijazah terakhir legalisir, dan pas foto resmi background merah',
        'Surat keterangan sehat jasmani dari dokter (menyatakan tidak buta warna total/parsial)',
    ],
    'materi'      => [
        'Kebijakan K3 Nasional dan Pemahaman Regulasi Permenaker No. 12 Tahun 2015',
        'Persyaratan Umum Instalasi Listrik (PUIL 2020) & Standar Proteksi Kebakaran Listrik',
        'Identifikasi Bahaya Listrik: Sengatan Arus, Korsleting, Beban Lebih & Pelepasan Arc Flash',
        'Sistem Proteksi Instalasi: RCD/ELCB, Circuit Breaker, Pembumian (Grounding) & Penangkal Petir',
        'Prosedur Isolasi Energi Berbahaya — Lockout / Tagout (LOTO) pada Panel Distribusi',
        'Teknik Inspeksi Berkala, Pengukuran Tahanan Isolasi Megger & Pengujian Kelayakan Panel',
        'Pertolongan Pertama pada Kecelakaan Kerja Akibat Arus Listrik (P3K Listrik)',
        'Praktek Kerja Lapangan (PKL) Mandiri / Evaluasi Studi Kasus Industri dan Ujian Lisensi Kemnaker RI',
    ],
    'faqs'        => [
        [
            'q' => 'Apakah perusahaan wajib memiliki Teknisi dan Ahli K3 Listrik?',
            'a' => 'Ya. Sesuai Permenaker No. 12 Tahun 2015 Pasal 10, perusahaan yang memiliki instalasi listrik dengan pembangkitan lebih dari 200 kVA wajib memiliki minimal satu orang Ahli K3 Listrik. Sementara untuk pekerjaan pemeliharaan dan operasional harian, teknisi pelaksana wajib memiliki lisensi Teknisi K3 Listrik.',
        ],
        [
            'q' => 'Apa perbedaan mendasar sertifikasi Teknisi vs Ahli K3 Listrik?',
            'a' => 'Teknisi K3 Listrik berperan sebagai pelaksana teknis di lapangan (maintenance, instalasi fisik, dan penerapan LOTO). Ahli K3 Listrik memiliki kewenangan manajerial dan kepengawasan yang lebih tinggi, termasuk mengaudit instalasi sesuai PUIL, menandatangani dokumen evaluasi K3 listrik, dan berkoordinasi dengan pengawas ketenagakerjaan.',
        ],
        [
            'q' => 'Berapa masa berlaku sertifikat dan lisensi K3 Listrik Kemnaker RI?',
            'a' => 'Lisensi K3 dan Surat Keputusan Penunjukan (SKP) dari Kementerian Ketenagakerjaan RI berlaku selama 3 tahun dan dapat diperpanjang melalui proses perpanjangan lisensi / evaluasi berkala sebelum masa berlaku habis.',
        ],
        [
            'q' => 'Apakah pelatihan K3 Listrik bisa diikuti secara online?',
            'a' => 'Sesuai kurikulum Kemnaker RI, pelatihan Teknisi dan Ahli K3 Listrik memiliki modul teori yang dapat dilakukan secara daring (interactive Zoom) serta sesi praktik pengukuran dan pengujian lapangan yang diselenggarakan secara tatap muka di Yogyakarta atau in-house di perusahaan peserta.',
        ],
    ],
    'related_hubs'=> [
        [
            'slug'  => 'k3-konstruksi',
            'name'  => 'K3 Konstruksi',
            'badge' => 'Kemnaker & BNSP',
            'desc'  => 'Sertifikasi Ahli Muda, Madya, dan Utama pengawasan keselamatan proyek sipil & gedung.',
        ],
        [
            'slug'  => 'k3-ketinggian',
            'name'  => 'K3 Bekerja di Ketinggian (TKBT)',
            'badge' => 'Kemnaker RI',
            'desc'  => 'Lisensi keselamatan bekerja di struktur tiang, scaffold, tower transmisi, dan atap.',
        ],
        [
            'slug'  => 'k3-pesawat-angkat-angkut',
            'name'  => 'K3 Pesawat Angkat & Angkut',
            'badge' => 'Kemnaker RI',
            'desc'  => 'Sertifikasi operator forklift, mobile crane, overhead crane, dan rigger industri.',
        ],
        [
            'slug'  => 'penanggulangan-kebakaran',
            'name'  => 'Penanggulangan Kebakaran',
            'badge' => 'Kemnaker RI',
            'desc'  => 'Petugas peran kebakaran Kelas D, regu pemadam Kelas C, koordinator B, dan Ahli Muda K3 Damkar.',
        ],
    ],
];

require __DIR__ . '/includes/hub-layout.php';
