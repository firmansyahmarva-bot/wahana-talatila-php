<?php
/**
 * k3-konstruksi.php — Hub Page: Pelatihan K3 Konstruksi (Supervisor, Ahli Muda, Madya, Utama)
 * Powered by includes/hub-layout.php
 */
require_once __DIR__ . '/config.php';

$hub_data = [
    'slug'        => 'k3-konstruksi',
    'badge'       => 'K3 Konstruksi',
    'title'       => 'Pelatihan K3 Konstruksi: Ahli Muda, Madya & Supervisor BNSP',
    'meta_title'  => 'Pelatihan Ahli K3 Konstruksi (Muda, Madya, Utama) Sertifikasi BNSP — Wahana Totalita',
    'meta_desc'   => 'Pelatihan K3 Konstruksi resmi bersertifikat BNSP & Kemnaker RI sesuai Permen PUPR No. 10/2021 & Permenaker No. 01/1980. Syarat kualifikasi tender LPSE, silabus & jadwal.',
    'intro_lead'  => 'Sertifikasi kompetensi resmi BNSP & Kemnaker RI untuk Ahli Muda K3 Konstruksi dan Supervisor lapangan guna pemenuhan SMKK dan syarat mutlak tender LPSE.',
    'intro'       => [
        'Sektor jasa konstruksi merupakan salah satu industri dengan risiko kecelakaan kerja tertinggi, melibatkan aktivitas berbahaya seperti pekerjaan di ketinggian, galian tanah dalam, pengangkatan alat berat, dan paparan cuaca ekstrem. Penerapan Sistem Manajemen Keselamatan Konstruksi (SMKK) kini menjadi kewajiban mutlak bagi setiap kontraktor pelaksana dan konsultan pengawas.',
        'Sesuai mandat Permen PUPR No. 10 Tahun 2021 dan UU No. 2 Tahun 2017 tentang Jasa Konstruksi, setiap paket pekerjaan konstruksi wajib menunjuk tenaga ahli K3 yang kompeten dan bersertifikat resmi. Kepemilikan sertifikat Ahli K3 Konstruksi BNSP bukan hanya menjamin keselamatan jiwa di area proyek, namun juga menjadi syarat administrasi gugur dalam proses lelang pengadaan barang dan jasa pemerintah (tender LPSE).',
    ],
    'regulasi'    => [
        ['nomor' => 'Permen PUPR No. 10 Tahun 2021', 'desc' => 'Pedoman Penerapan Sistem Manajemen Keselamatan Konstruksi (SMKK). Mewajibkan penyusunan RKK dan penempatan personil keselamatan konstruksi bersertifikat pada setiap paket proyek.'],
        ['nomor' => 'Permenaker No. 01/MEN/1980', 'desc' => 'Tentang Keselamatan dan Kesehatan Kerja pada Konstruksi Bangunan. Standar teknis keselamatan perancah (scaffolding), galian, tangga, alat angkat, dan perlengkapan APD pekerja.'],
        ['nomor' => 'UU No. 2 Tahun 2017 tentang Jasa Konstruksi', 'desc' => 'Pasal 59 mewajibkan pengguna dan penyedia jasa memenuhi standar keamanan, keselamatan, kesehatan, dan keberlanjutan dalam setiap penyelenggaraan jasa konstruksi.'],
        ['nomor' => 'Surat Edaran Menteri PUPR No. 11/SE/M/2019', 'desc' => 'Petunjuk teknis biaya penerapan Sistem Manajemen Keselamatan Konstruksi dalam dokumen anggaran biaya proyek.'],
    ],
    'comparison'  => [
        'headers' => ['Aspek Evaluasi', 'Supervisor K3 Konstruksi', 'Ahli Muda K3 Konstruksi', 'Ahli Madya & Utama'],
        'rows'    => [
            ['Peran Pokok Proyek', 'Pengawas teknis garis depan / mandor', 'Junior safety specialist & pengawas K3', 'Lead HSE coordinator & auditor SMKK'],
            ['Kategori Risiko Proyek', 'Proyek potensi bahaya rendah / perbaikan', 'Proyek skala kecil hingga menengah', 'Proyek kompleksitas tinggi / nilai >100M'],
            ['Kewenangan Dokumen', 'Inspeksi harian checklist & APD', 'Penyusunan RKK, IBPRP & JSA lapangan', 'Mengesahkan seluruh dokumen SMKK proyek'],
            ['Pendidikan Minimal', 'SMA/SMK + 2 tahun pengalaman kerja', 'D3 / S1 Teknik (Sipil, Arsitektur, Mesin)', 'S1 Teknik + pengalaman 3–6 tahun di K3'],
            ['Sertifikasi & Lisensi', 'Sertifikat Kompetensi BNSP', 'Sertifikat Kompetensi Resmi BNSP', 'Sertifikat BNSP / SKA Konstruksi'],
        ],
    ],
    'programs'    => [
        [
            'slug'          => 'pelatihan-ahli-muda-k3-konstruksi-online',
            'name'          => 'Pelatihan & Uji Kompetensi Ahli Muda K3 Konstruksi BNSP',
            'cert'          => 'Sertifikasi BNSP',
            'mode'          => 'Blended / Uji Kompetensi',
            'duration'      => '5 Hari Pelatihan',
            'desc'          => 'Program sertifikasi kompetensi nasional berbasis SKKNI untuk tenaga ahli keselamatan proyek sipil dan gedung. Membekali peserta kemampuan menyusun Rencana Keselamatan Konstruksi (RKK), identifikasi bahaya struktural (IBPRP), izin kerja risiko tinggi (PTW), serta kesiapan dokumen kualifikasi tender LPSE.',
            'target_peserta'=> 'Site engineer, HSE coordinator, pelaksana proyek, konsultan pengawas sipil, calon tenaga ahli tender',
        ],
        [
            'slug'          => 'supervisor-k3-konstruksi',
            'name'          => 'Pelatihan Supervisor K3 Konstruksi Sertifikasi BNSP',
            'cert'          => 'Sertifikasi BNSP',
            'mode'          => 'Tatap Muka & Online',
            'duration'      => '3 Hari Pelatihan',
            'desc'          => 'Pembinaan praktis bagi mandor dan supervisor lapangan untuk memimpin safety morning talk harian, melakukan inspeksi kelayakan perancah (scaffolding tagging), pengawasan pekerjaan galian tanah, serta penegakan disiplin APD di zona kerja aktif.',
            'target_peserta'=> 'Mandor proyek, supervisor lapangan, staf logistik proyek, safety patrol, perawat lapangan',
        ],
    ],
    'syarat'      => [
        'Ijazah minimal SMA/SMK sederajat (untuk Supervisor) atau D3/S1 Teknik Sipil/Arsitektur/Mesin/K3 (untuk Ahli Muda)',
        'Salinan KTP legalisir, ijazah terakhir, transkrip nilai, dan pas foto resmi background merah',
        'Surat keterangan pengalaman kerja atau referensi dari kontraktor/konsultan proyek konstruksi',
        'Curriculum Vitae (CV) portofolio pengalaman proyek yang relevan',
    ],
    'materi'      => [
        'Kebijakan K3 Konstruksi Nasional & Regulasi Permen PUPR No. 10/2021 tentang SMKK',
        'Identifikasi Bahaya, Penilaian Risiko, dan Pengendalian Peluang (IBPRP / HIRARC Proyek)',
        'Penyusunan Rencana Keselamatan Konstruksi (RKK) tender dan pelaksanaan lapangan',
        'Keselamatan Pekerjaan Galian Tanah, Pengendalian Longsor, dan Proteksi Shoring/Dewatering',
        'Standar Keselamatan Perancah (Scaffolding): Inspeksi Komponen, Beban Aman & Green/Red Tagging',
        'Keselamatan Pekerjaan Struktur Beton, Pengecoran, Pembesian, dan Bahaya Formwork',
        'Pengawasan Operasi Alat Berat Proyek (Excavator, Crane, Dump Truck) & Prosedur Rigging',
        'Prosedur Tanggap Darurat Kecelakaan Konstruksi, P3K Proyek, dan Simulasi Evakuasi Darurat',
    ],
    'faqs'        => [
        [
            'q' => 'Apakah sertifikat Ahli K3 Konstruksi wajib untuk mengikuti tender pemerintah (LPSE)?',
            'a' => 'Ya, mutlak wajib. Dalam dokumen kualifikasi tender jasa konstruksi Kementerian PUPR dan dinas daerah, penyedia jasa disyaratkan melampirkan bukti kepemilikan personil bersertifikat Ahli K3 Konstruksi yang masih aktif. Tanpa personil ini, dokumen penawaran akan langsung digugurkan pada tahap evaluasi teknis.',
        ],
        [
            'q' => 'Apa perbedaan sertifikasi Supervisor K3 Konstruksi dengan Ahli Muda K3 Konstruksi?',
            'a' => 'Supervisor K3 Konstruksi berperan sebagai pengawas operasional langsung di lapangan (memeriksa APD, memimpin safety briefing harian, inspeksi scaffolding). Sedangkan Ahli Muda K3 Konstruksi memiliki kewenangan manajerial dan konseptual yang lebih luas, termasuk merancang dokumen SMKK/RKK, menghitung analisis risiko IBPRP, serta berkoordinasi langsung dengan pimpinan proyek dan instansi pengawas ketenagakerjaan.',
        ],
        [
            'q' => 'Berapa lama masa berlaku sertifikat kompetensi Ahli K3 Konstruksi BNSP?',
            'a' => 'Sertifikat kompetensi yang diterbitkan oleh Badan Nasional Sertifikasi Profesi (BNSP) berlaku selama 3 tahun dan dapat diperpanjang melalui proses uji perpanjangan kompetensi / portofolio sebelum masa berlakunya berakhir.',
        ],
        [
            'q' => 'Apakah Wahana Totalita memfasilitasi pelatihan K3 Konstruksi in-house di lokasi proyek kami?',
            'a' => 'Ya, kami melayani penyelenggaraan In-House Training langsung di direksi keet atau mess proyek perusahaan Anda di seluruh wilayah Indonesia dengan instruktur praktisi senior dan asesor berlisensi.',
        ],
    ],
    'related_hubs'=> [
        [
            'slug'  => 'k3-ketinggian',
            'name'  => 'K3 Ketinggian (TKBT)',
            'badge' => 'Kemnaker RI',
            'desc'  => 'Lisensi keselamatan bekerja di struktur tiang, scaffold, tower transmisi, dan atap gedung.',
        ],
        [
            'slug'  => 'k3-pesawat-angkat-angkut',
            'name'  => 'K3 Pesawat Angkat & Angkut',
            'badge' => 'Kemnaker RI',
            'desc'  => 'Sertifikasi mobile crane, tower crane, rigger dan operator alat berat proyek.',
        ],
        [
            'slug'  => 'k3-listrik',
            'name'  => 'K3 Listrik',
            'badge' => 'Kemnaker RI',
            'desc'  => 'Mitigasi korsleting, panel temporer proyek, dan sistem grounding utilitas konstruksi.',
        ],
        [
            'slug'  => 'penanggulangan-kebakaran',
            'name'  => 'Penanggulangan Kebakaran',
            'badge' => 'Kemnaker RI',
            'desc'  => 'Proteksi kebakaran temporary proyek, fire watcher pekerjaan pengelasan, dan tata kelola APAR.',
        ],
    ],
];

require __DIR__ . '/includes/hub-layout.php';