<?php
/**
 * penanggulangan-kebakaran.php — Hub Page: Penanggulangan Kebakaran (Kelas D–A)
 * Powered by includes/hub-layout.php
 */
require_once __DIR__ . '/config.php';

$hub_data = [
    'slug'        => 'penanggulangan-kebakaran',
    'badge'       => 'Penanggulangan Kebakaran',
    'title'       => 'Pelatihan Penanggulangan Kebakaran: Sertifikasi Kemnaker RI (Kelas D, C, B, A)',
    'meta_title'  => 'Pelatihan Penanggulangan Kebakaran Kelas A–D Sertifikasi Kemnaker RI — Wahana Totalita',
    'meta_desc'   => 'Pelatihan K3 Penanggulangan Kebakaran resmi bersertifikat Kemnaker RI sesuai Kepmenaker No. 186/MEN/1999. Kelas D, C, B, A & Pengkaji Teknis BNSP. Silabus & jadwal.',
    'intro_lead'  => 'Sertifikasi resmi Kemnaker RI untuk Petugas Peran Kebakaran, Regu Pemadam, Koordinator UPK, dan Ahli Spesialis sesuai regulasi Kepmenaker No. 186/MEN/1999.',
    'intro'       => [
        'Kebakaran di tempat kerja merupakan bencana berisiko tinggi yang dapat melumpuhkan kegiatan operasional, merusak infrastruktur industri, serta mengancam keselamatan pekerja dalam hitungan menit. Data statistik mencatat kebakaran fasilitas komersial dan pabrik menimbulkan kerugian triliunan rupiah setiap tahunnya di Indonesia.',
        'Sesuai mandat Kepmenaker No. 186/MEN/1999, setiap pengurus atau pengusaha wajib mencegah, mengurangi, dan memadamkan kebakaran dengan membentuk Unit Penanggulangan Kebakaran (UPK) berjenjang. Memiliki personil berlisensi resmi Kemnaker RI (Kelas D, C, B, atau A) memastikan kepatuhan hukum penuh, kesiapsiagaan tanggap darurat, dan perlindungan optimal aset perusahaan.',
    ],
    'regulasi'    => [
        ['nomor' => 'Kepmenaker No. 186/MEN/1999', 'desc' => 'Tentang Unit Penanggulangan Kebakaran di Tempat Kerja. Mengatur struktur UPK (Kelas D, C, B, A), rasio jumlah petugas wajib, dan kurikulum pembinaan teknis.'],
        ['nomor' => 'UU No. 1 Tahun 1970', 'desc' => 'Pasal 3 ayat (1) mewajibkan syarat keselamatan kerja untuk mencegah, mengurangi, dan memadamkan kebakaran, serta menyediakan sarana evakuasi darurat.'],
        ['nomor' => 'Permenaker No. 04/MEN/1980', 'desc' => 'Syarat-syarat pemasangan, penempatan, dan pemeliharaan Alat Pemadam Api Ringan (APAR) di seluruh fasilitas kerja.'],
        ['nomor' => 'Instruksi Menaker No. Ins.11/M/BW/1997', 'desc' => 'Pengawasan khusus K3 penanggulangan kebakaran di tempat kerja dengan potensi bahaya kebakaran sedang dan tinggi.'],
    ],
    'comparison'  => [
        'headers' => ['Aspek Evaluasi', 'Kelas D (Petugas Peran)', 'Kelas C (Regu Pemadam)', 'Kelas B (Koordinator UPK)', 'Kelas A (Ahli Spesialis)'],
        'rows'    => [
            ['Peran & Tanggung Jawab', 'First responder pemadam APAR & evakuasi', 'Regu inti pemadam hydrant & rescue SCBA', 'Koordinator sistem & mitigasi UPK gedung', 'Penanggung jawab teknis senior & auditor'],
            ['Rasio Wajib Regulasi', '2 Petugas per 20 Karyawan', 'Min 2 Regu per Gedung / Pabrik', '1 Koordinator per 250–300 Pekerja', 'Wajib di Industri Bahaya Sangat Tinggi'],
            ['Durasi Pelatihan', '3 Hari (±30 Jam Pembinaan)', '6 Hari (±60 Jam Pembinaan)', '6 Hari (±60 Jam Pembinaan)', '12 Hari (±100 Jam Pembinaan)'],
            ['Syarat Minimal', 'Minimal SMP / SMA Sederajat', 'SMA/SMK + Sertifikat Kelas D', 'D3/S1 + Sertifikat Kelas C', 'S1 Teknik/K3 + Pengalaman Kelas B'],
            ['Sertifikasi & Lisensi', 'Kemnaker RI (Lisensi 3 Tahun)', 'Kemnaker RI (Lisensi 5 Tahun)', 'Kemnaker RI (Lisensi 5 Tahun)', 'SKP & Lisensi Kemnaker RI (5 Tahun)'],
        ],
    ],
    'programs'    => [
        [
            'slug'          => 'pelatihan-petugas-peran-kebakaran-kelas-d-kemnaker-ri',
            'name'          => 'Pelatihan Petugas Peran Kebakaran Kelas D Kemnaker RI',
            'cert'          => 'Kemnaker RI',
            'mode'          => 'Tatap Muka & Praktik Live Fire',
            'duration'      => '3 Hari Pelatihan',
            'desc'          => 'Program pembinaan sertifikasi dasar untuk mencetak first responder terlatih dalam pengoperasian APAR metode PASS, penanganan selimut api (fire blanket), serta manajemen evakuasi darurat penghuni gedung.',
            'target_peserta'=> 'Security, floor warden, operator mesin, resepsionis, supervisor gudang, perawat faskes',
        ],
        [
            'slug'          => 'pelatihan-regu-penanggulangan-kebakaran-kelas-c-sertifikasi-kemnaker-ri',
            'name'          => 'Pelatihan Regu Penanggulangan Kebakaran Kelas C Kemnaker RI',
            'cert'          => 'Kemnaker RI',
            'mode'          => 'Tatap Muka & Fire Ground',
            'duration'      => '6 Hari Pelatihan',
            'desc'          => 'Pembinaan tim pemadam industri untuk menguasai pengoperasian pompa hydrant, manuver selang bertekanan, pemakaian alat bantu pernapasan mandiri (SCBA), serta taktik penyelamatan korban dalam ruang berasap.',
            'target_peserta'=> 'Anggota fire brigade perusahaan, teknisi utilitas pabrik, safety officer, koordinator tanggap darurat',
        ],
        [
            'slug'          => 'pelatihan-pengkaji-teknis-proteksi-kebakaran-sertifikasi-bnsp',
            'name'          => 'Pelatihan Pengkaji Teknis Proteksi Kebakaran BNSP',
            'cert'          => 'Sertifikasi BNSP',
            'mode'          => 'Blended / Uji Kompetensi',
            'duration'      => '3 Hari Pelatihan',
            'desc'          => 'Sertifikasi kompetensi nasional berbasis SKKNI untuk menguji kemampuan audit dan evaluasi keandalan sistem proteksi aktif (sprinkler, hydrant, alarm) dan proteksi pasif bangunan gedung komersial.',
            'target_peserta'=> 'Building manager, auditor K3, konsultan proteksi kebakaran, mechanical/electrical engineer',
        ],
        [
            'slug'          => 'online-training-fire-watcher',
            'name'          => 'Pelatihan Fire Watcher (Pengawas Pekerjaan Panas)',
            'cert'          => 'Sertifikasi Kompetensi',
            'mode'          => 'Online / In-House',
            'duration'      => '2 Hari Pelatihan',
            'desc'          => 'Pelatihan spesialis pengawasan pekerjaan panas (hot work: pengelasan, cutting, grinding) guna mendeteksi potensi penyalaan percikan api, menjaga perimeter kerja aman, dan kesiapan APAR darurat.',
            'target_peserta'=> 'Safety inspector kontraktor, supervisor fabrikasi, teknisi pemeliharaan, surveyor tanggap darurat',
        ],
    ],
    'syarat'      => [
        'Pendidikan minimal SMP/SMA sederajat (Kelas D), SMA/SMK (Kelas C), D3/S1 teknik/K3 (Kelas B & A)',
        'Surat penugasan atau rekomendasi dari perusahaan pengutus (atau surat pernyataan mandiri)',
        'Surat keterangan sehat dari dokter (menyatakan tidak memiliki riwayat asma akut atau gangguan jantung)',
        'Salinan KTP legalisir, ijazah terakhir, dan pas foto resmi background merah',
    ],
    'materi'      => [
        'Fenomena dan teori dasar api: segitiga api, proses pembakaran, dan dinamika kebakaran flashover',
        'Klasifikasi kebakaran (Kelas A, B, C, D) dan pemilihan media pemadam yang presisi',
        'Teknik pemadaman awal menggunakan APAR (Dry Chemical, CO2, Foam, Clean Agent) dengan metode PASS',
        'Instalasi sistem proteksi kebakaran aktif: fire alarm, pompa hidran, smoke detector, dan automatic sprinkler',
        'Teknik operasional selang hidran, penggulungan, penyambungan kopling, dan pola semprotan nozel',
        'Penggunaan Self-Contained Breathing Apparatus (SCBA) untuk pencarian korban dan penyelamatan (Search & Rescue)',
        'Penyusunan Rencana Tanggap Darurat Kebakaran (Fire ERP) dan manajemen alur evakuasi muster point',
        'Simulasi pemadaman api nyata (Live Fire Exercise) di bawah panduan instruktur PJK3 resmi',
    ],
    'faqs'        => [
        [
            'q' => 'Berapa rasio jumlah petugas pemadam kebakaran yang wajib disediakan di perusahaan?',
            'a' => 'Berdasarkan Kepmenaker No. 186/MEN/1999 Pasal 6, sekurang-kurangnya 2 orang Petugas Peran Kebakaran (Kelas D) wajib ada untuk setiap 20 orang tenaga kerja. Untuk tempat kerja dengan potensi bahaya kebakaran sedang dan tinggi, perusahaan juga wajib membentuk Regu Kebakaran (Kelas C) dan Koordinator UPK (Kelas B).',
        ],
        [
            'q' => 'Apa perbedaan antara Petugas Kelas D dengan Anggota Regu Kelas C?',
            'a' => 'Petugas Kelas D bertugas memadamkan api dini dengan APAR dan memimpin evakuasi darurat karyawan di lantainya. Sementara Anggota Regu Kelas C adalah regu pemadam terlatih yang bertindak menyerang kebakaran besar dengan instalasi hydrant pabrik, memakai SCBA, dan bekerja sama dengan dinas pemadam kebakaran.',
        ],
        [
            'q' => 'Bagaimana jika perusahaan ingin mendaftarkan personil untuk Kelas B atau Kelas A?',
            'a' => 'Wahana Totalita menyelenggarakan pelatihan Koordinator UPK (Kelas B) dan Ahli K3 Spesialis Kebakaran (Kelas A) melalui skema public training berkala atau in-house training eksklusif di perusahaan Anda. Silakan hubungi konsultan kami via WhatsApp untuk mendapatkan proposal silabus dan penjadwalan.',
        ],
        [
            'q' => 'Berapa lama masa berlaku sertifikat dan lisensi K3 Penanggulangan Kebakaran?',
            'a' => 'Sertifikat pembinaan Kemnaker RI berlaku seumur hidup sebagai bukti kelulusan personil. Lisensi kerja operasional dan SKP berlaku selama 3 tahun untuk Kelas D, dan 5 tahun untuk Kelas C, B, dan A, yang dapat diperpanjang melalui evaluasi perpanjangan berkala.',
        ],
    ],
    'related_hubs'=> [
        [
            'slug'  => 'k3-listrik',
            'name'  => 'K3 Listrik',
            'badge' => 'Kemnaker RI',
            'desc'  => 'Mitigasi korsleting, panel hubung singkat, dan sistem grounding instalasi pabrik.',
        ],
        [
            'slug'  => 'p3k',
            'name'  => 'P3K di Tempat Kerja',
            'badge' => 'Kemnaker & BNSP',
            'desc'  => 'Pertolongan medis darurat untuk luka bakar, syok, trauma inhalasi asap, dan resusitasi.',
        ],
        [
            'slug'  => 'k3-kimia',
            'name'  => 'K3 Bahan Kimia',
            'badge' => 'Kemnaker RI',
            'desc'  => 'Manajemen bahan mudah terbakar (flammable), gas bertekanan, dan bahaya ledakan kimia.',
        ],
        [
            'slug'  => 'k3-konstruksi',
            'name'  => 'K3 Konstruksi',
            'badge' => 'Kemnaker & BNSP',
            'desc'  => 'Pengawasan keselamatan kerja proyek sipil, proteksi api temporary, dan tanggap darurat.',
        ],
    ],
];

require __DIR__ . '/includes/hub-layout.php';