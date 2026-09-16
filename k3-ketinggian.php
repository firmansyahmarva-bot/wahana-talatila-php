<?php
/**
 * k3-ketinggian.php — Hub Page: Pelatihan K3 Ketinggian (TKBT & TKPK)
 * Powered by includes/hub-layout.php
 */
require_once __DIR__ . '/config.php';

$hub_data = [
    'slug'        => 'k3-ketinggian',
    'badge'       => 'K3 Bekerja di Ketinggian',
    'title'       => 'Pelatihan K3 Ketinggian: Sertifikasi TKBT & TKPK Kemnaker RI',
    'meta_title'  => 'Pelatihan K3 Ketinggian (TKBT & TKPK) Sertifikasi Kemnaker RI — Wahana Totalita',
    'meta_desc'   => 'Pelatihan K3 Bekerja pada Ketinggian resmi bersertifikat Kemnaker RI sesuai Permenaker No. 09 Tahun 2016. Program TKBT 1-2 & TKPK 1-3. Silabus & jadwal.',
    'intro_lead'  => 'Sertifikasi resmi Kemnaker RI untuk Tenaga Kerja Bangunan Tinggi (TKBT) dan Tenaga Kerja pada Ketinggian (TKPK) sesuai Permenaker No. 09 Tahun 2016.',
    'intro'       => [
        'Bekerja pada ketinggian (working at height) merupakan aktivitas kerja dengan potensi kecelakaan fatal tertinggi di sektor konstruksi, telekomunikasi, manufaktur, dan pemeliharaan gedung bertingkat. Berdasarkan Permenaker No. 09 Tahun 2016, pekerjaan pada ketinggian didefinisikan sebagai aktivitas kerja pada permukaan tanah atau perairan yang memiliki perbedaan elevasi 1,8 meter atau lebih dengan potensi jatuh.',
        'Kementerian Ketenagakerjaan RI mewajibkan setiap personil yang bekerja, merencanakan, maupun mengawasi pekerjaan ketinggian untuk memiliki lisensi resmi K3. Program pembinaan mencakup skema Tenaga Kerja Bangunan Tinggi (TKBT) untuk struktur perancah/platform dan Tenaga Kerja pada Ketinggian (TKPK) berbasis akses tali (rope access).',
    ],
    'regulasi'    => [
        ['nomor' => 'Permenaker No. 09 Tahun 2016', 'desc' => 'Tentang Keselamatan dan Kesehatan Kerja dalam Pekerjaan pada Ketinggian. Mewajibkan sertifikasi TKBT & TKPK, lisensi alat pelindung jatuh, dan penyusunan dokumen rencana tanggap darurat.'],
        ['nomor' => 'UU No. 1 Tahun 1970', 'desc' => 'Pasal 2 dan 3 mewajibkan syarat-syarat keselamatan kerja dalam setiap pekerjaan pembersihan, pemeliharaan, pembongkaran, dan pendirian bangunan bertingkat.'],
        ['nomor' => 'Kepdirjen Binwasnaker No. 45/2008', 'desc' => 'Pedoman teknis keselamatan kerja bekerja di ketinggian dengan menggunakan teknik akses tali (rope access) di sektor industri.'],
    ],
    'comparison'  => [
        'headers' => ['Aspek Evaluasi', 'TKBT (Bangunan Tinggi)', 'TKPK (Akses Tali)', 'Pengawas / Supervisor K3'],
        'rows'    => [
            ['Metode Akses Kerja', 'Lantai kerja tetap, scaffold & tangga', 'Sistem 2 Tali (Rope Access Vertikal)', 'Inspeksi sistem & pengawasan lapangan'],
            ['Area Kerja Tipikal', 'Atap pabrik, tower BTS, perancah gedung', 'Sisi luar gedung bertingkat, tebing, rig', 'Seluruh perimeter elevasi proyek konstruksi'],
            ['Kewenangan Mandiri', 'Bekerja dengan penahan jatuh (fall arrest)', 'Bekerja mandiri suspensi tali vertikal', 'Menerbitkan working permit & JSA ketinggian'],
            ['Durasi Pelatihan', '3 Hari Pelatihan (±24 Jam)', '5 Hari Pelatihan (±40 Jam)', '3 Hari Pelatihan (±30 Jam)'],
            ['Sertifikasi & Lisensi', 'Lisensi K3 TKBT Kemnaker RI', 'Lisensi K3 TKPK Kemnaker RI', 'Sertifikat Kompetensi BNSP'],
        ],
    ],
    'programs'    => [
        [
            'slug'          => 'pelatihan-tkbt-tingkat-2-kemnaker-ri',
            'name'          => 'Pelatihan Tenaga Kerja Bangunan Tinggi (TKBT) Kemnaker RI',
            'cert'          => 'Kemnaker RI',
            'mode'          => 'Tatap Muka & Praktik Ketinggian',
            'duration'      => '3 Hari Pelatihan',
            'desc'          => 'Pembinaan kompetensi wajib bagi teknisi yang bekerja di struktur perancah (scaffolding), atap pabrik, tower telekomunikasi BTS, dan platform kerja tetap. Materi mencakup pemakaian full body harness, lanyard shock absorber, anchor point, dan teknik penyelamatan mandiri.',
            'target_peserta'=> 'Teknisi tower BTS, pemasang panel surya atap, pekerja scaffolding, maintenance gedung, safety inspector',
        ],
        [
            'slug'          => 'pelatihan-tkpk-tingkat-1-kemnaker-ri',
            'name'          => 'Pelatihan Tenaga Kerja pada Ketinggian (TKPK) Rope Access Kemnaker RI',
            'cert'          => 'Kemnaker RI',
            'mode'          => 'Tatap Muka & Tower Rope Access',
            'duration'      => '5 Hari Pelatihan',
            'desc'          => 'Sertifikasi keahlian akses tali (rope access) untuk manuver vertikal naik-turun menggunakan sistem 2 tali (working rope & backup safety rope), pembuatan simpul jangkar, teknik traversing, dan evakuasi korban tergantung di tali (vertical rescue).',
            'target_peserta'=> 'Pekerja gondola gedung, window cleaner fasad, teknisi rig migas, tim SAR vertikal, juru rawat silo',
        ],
        [
            'slug'          => 'supervisor-k3-konstruksi',
            'name'          => 'Pelatihan Supervisor K3 Konstruksi & Pekerjaan Ketinggian BNSP',
            'cert'          => 'Sertifikasi BNSP',
            'mode'          => 'Blended / Online',
            'duration'      => '3 Hari Pelatihan',
            'desc'          => 'Sertifikasi kompetensi pengawasan keselamatan pekerjaan elevasi tinggi di proyek sipil dan gedung komersial, mencakup penerbitan izin kerja ketinggian (Working at Height Permit), inspeksi perancah, dan proteksi pencegahan benda jatuh.',
            'target_peserta'=> 'Mandor konstruksi, safety supervisor, site engineer, inspektur K3 proyek gedung bertingkat',
        ],
    ],
    'syarat'      => [
        'Usia minimal 18 tahun, sehat jasmani dan rohani',
        'Surat keterangan dokter menyatakan tidak memiliki riwayat fobia ketinggian (acrophobia), epilepsi, atau asma akut',
        'Fotokopi KTP legalisir, ijazah minimal SMA/SMK sederajat, dan pas foto background merah',
        'Surat penugasan dari perusahaan atau surat pernyataan mandiri',
    ],
    'materi'      => [
        'Kebijakan K3 Nasional & Pemahaman Regulasi Permenaker No. 09 Tahun 2016 tentang Bekerja di Ketinggian',
        'Identifikasi Bahaya Jatuh (Fall Hazards) & Hierarki Pengendalian Perlindungan Bahaya Jatuh',
        'Pemilihan, Pemeriksaan, dan Perawatan Alat Pelindung Jatuh Perorangan (APJP): Full Body Harness, Lanyard, Carabiner',
        'Standar Titik Tambat (Anchor Points): Anchor Permanen vs Anchor Temporary & Perhitungan Beban Aman',
        'Sistem Penahan Jatuh (Personal Fall Arrest System - PFAS) & Perhitungan Fall Clearance Minimum',
        'Prosedur Bekerja Aman di Perancah (Scaffolding), Tangga Portabel, dan Platform Gondola',
        'Manajemen Bahaya Trauma Gantung (Suspension Trauma) dan Taktik Pertolongan Korban Jatuh',
        'Praktik Lapangan: Donning Harness, Manuver Anchor, dan Simulasi Vertical Rescue',
    ],
    'faqs'        => [
        [
            'q' => 'Berapa batas ketinggian minimum yang mewajibkan penerapan K3 Ketinggian di Indonesia?',
            'a' => 'Berdasarkan Permenaker No. 09 Tahun 2016, pekerjaan pada ketinggian adalah setiap kegiatan kerja yang dilakukan pada ketinggian 1,8 meter atau lebih dari permukaan tanah atau lantai kerja tetap yang memiliki potensi jatuh.',
        ],
        [
            'q' => 'Apa perbedaan mendasar antara sertifikasi TKBT dengan TKPK?',
            'a' => 'TKBT (Tenaga Kerja Bangunan Tinggi) diperuntukkan bagi pekerja yang bekerja pada lantai kerja tetap, struktur atap, tower BTS, atau perancah dengan alat penahan jatuh standar. Sedangkan TKPK (Tenaga Kerja pada Ketinggian) mengkhususkan diri pada metode akses tali (rope access) di mana pekerja menggantung di udara menggunakan sistem tali ganda.',
        ],
        [
            'q' => 'Berapa lama masa berlaku sertifikat dan lisensi K3 Ketinggian Kemnaker RI?',
            'a' => 'Lisensi K3 TKBT dan TKPK Kemnaker RI berlaku selama 3 tahun dan dapat diperpanjang melalui evaluasi portofolio atau pelatihan penyegaran berkala sebelum masa berlaku habis.',
        ],
        [
            'q' => 'Apakah peralatan praktik disediakan selama pelatihan di Wahana Totalita?',
            'a' => 'Ya, seluruh peralatan praktik berstandar EN/CE/UIAA (full body harness, helmet, shock-absorbing lanyard, carabiner, ascender, descender, backup device) disediakan lengkap oleh Wahana Totalita di training ground kami.',
        ],
    ],
    'related_hubs'=> [
        [
            'slug'  => 'k3-konstruksi',
            'name'  => 'K3 Konstruksi',
            'badge' => 'Kemnaker & BNSP',
            'desc'  => 'Pengawasan keselamatan struktur sipil, perancah gedung, dan manajemen SMKK proyek.',
        ],
        [
            'slug'  => 'k3-pesawat-angkat-angkut',
            'name'  => 'K3 Pesawat Angkat & Angkut',
            'badge' => 'Kemnaker RI',
            'desc'  => 'Operasional crane, hoist, gondola dan pengawasan perlengkapan rigging pengangkatan.',
        ],
        [
            'slug'  => 'k3-listrik',
            'name'  => 'K3 Listrik',
            'badge' => 'Kemnaker RI',
            'desc'  => 'Keselamatan instalasi listrik bertegangan tinggi di tower transmisi dan gardu induk.',
        ],
        [
            'slug'  => 'penanggulangan-kebakaran',
            'name'  => 'Penanggulangan Kebakaran',
            'badge' => 'Kemnaker RI',
            'desc'  => 'Mitigasi evakuasi darurat gedung bertingkat, tangga darurat, dan tim fire warden.',
        ],
    ],
];

require __DIR__ . '/includes/hub-layout.php';