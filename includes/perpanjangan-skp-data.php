<?php
/**
 * includes/perpanjangan-skp-data.php
 * Master dataset and helper functions for Perpanjangan SKP & Lisensi K3 Kemnaker / BNSP Hub.
 * Statutory administrative renewal services without retaking full coursework.
 */

function get_all_perpanjangan_skp_items(array $filter = []): array {
    static $items = null;
    if ($items === null) {
        $items = [
            'ahli-k3-umum' => [
                'slug'           => 'ahli-k3-umum',
                'judul'          => 'Perpanjangan SKP & Lisensi Ahli K3 Umum Kemnaker RI',
                'kategori'       => 'kemnaker-ahli-k3',
                'kategori_label' => 'SKP Kemnaker RI',
                'dasar_hukum'    => 'Permenaker No. Per.02/MEN/1992 tentang Tata Cara Penunjukan, Kewajiban dan Wewenang Ahli K3',
                'tagline'        => 'Proses administratif resmi ke Kemnaker RI untuk memperpanjang SK Penunjukan dan Lisensi Ahli K3 Umum tanpa pelatihan ulang.',
                'meta_title'     => 'Perpanjangan SKP Ahli K3 Umum Kemnaker: Syarat, Biaya & Waktu Proses',
                'meta_desc'      => 'Jasa perpanjangan SKP & Lisensi Ahli K3 Umum Kemnaker resmi. Proses administratif cepat 7-14 hari tanpa kursus ulang. Cek syarat dokumen & biaya disini.',
                'keywords'       => ['perpanjangan skp ahli k3 umum', 'biaya perpanjang skp ak3u', 'syarat perpanjangan lisensi k3 umum', 'skp ahli k3 umum berlaku selama', 'perpanjangan skp 2026'],
                'masa_berlaku'   => '3 (tiga) tahun sejak tanggal penetapan SKP',
                'biaya_standar'  => 'Rp 1.850.000',
                'biaya_batch'    => 'Rp 1.550.000 / orang (min. 3 berkas)',
                'durasi_proses'  => '7 – 14 hari kerja setelah berkas lengkap diverifikasi',
                'city_keyword'   => 'Jakarta & Jawa Barat',
                'deskripsi_lengkap' => 'Surat Keputusan Penunjukan (SKP) dan Kartu Lisensi Kewenangan Ahli K3 Umum memiliki masa berlaku 3 tahun. Selama masih dalam masa tenggang toleransi (belum expired lebih dari 1 tahun), Anda tidak perlu mengulang pembinaan 12 hari yang memakan biaya besar. Wahana Totalita membantu verifikasi Laporan Kegiatan K3 semesteran perusahaan, pendaftaran akun TemanK3, dan pengawalan berkas ke Direktorat Bina Pengawasan Ketenagakerjaan dan K3 Kemnaker RI hingga SKP fisik dan lisensi baru terbit di Jakarta.',
                'syarat_dokumen' => [
                    'Scan Asli SKP dan Lisensi Kewenangan Ahli K3 Umum periode sebelumnya',
                    'Scan Asli Sertifikat Calon Ahli K3 Umum (Kemnaker RI)',
                    'Surat Permohonan Perpanjangan resmi dari pimpinan perusahaan (kop surat berstempel)',
                    'Surat Keterangan Kerja aktif sebagai Ahli K3 di perusahaan saat ini',
                    'Laporan Rekapitulasi Kegiatan K3 / Notulen P2K3 di tempat kerja selama masa penunjukan (format kami sediakan)',
                    'Salinan KTP & Ijazah terakhir (minimal D3/S1 sesuai SKP awal)',
                    'Pas foto berwarna terbaru ukuran 3x4 dan 4x6 (latar belakang merah)'
                ],
                'alur_proses' => [
                    'Pemeriksaan Berkas Digital (Kirim foto/scan via WhatsApp untuk review kelayakan dalam 15 menit)',
                    'Penyusunan Berkas & Formulir Laporan K3 (Pendampingan format laporan kegiatan K3 perusahaan)',
                    'Input Data & Pengajuan ke Sistem Kemnaker RI (Pengurusan PNBP & verifikasi pejabat pengawas)',
                    'Penerbitan SKP & Lisensi Baru (Pengiriman dokumen asli berhologram resmi ke alamat perusahaan)'
                ],
                'faqs' => [
                    [
                        'q' => 'SKP Ahli K3 Umum berlaku berapa lama?',
                        'a' => 'SKP dan Lisensi Ahli K3 Umum Kemnaker RI berlaku selama 3 (tiga) tahun. Setelah masa 3 tahun habis, pengurus perusahaan wajib mengajukan perpanjangan administratif agar wewenang legal menandatangani dokumen K3 tidak gugur.'
                    ],
                    [
                        'q' => 'Berapa lama proses nunggunya sampai SKP baru terbit?',
                        'a' => 'Rata-rata waktu pemrosesan adalah 7 hingga 14 hari kerja setelah berkas fisik dan laporan kegiatan diverifikasi lengkap oleh Pengawas Ketenagakerjaan Kemnaker RI.'
                    ],
                    [
                        'q' => 'Apakah proses perpanjangan SKP bisa dilakukan secara online tanpa datang ke kantor?',
                        'a' => 'Bisa 100% online. Seluruh scan dokumen dan pas foto cukup dikirimkan via WhatsApp atau Google Drive. Dokumen SKP dan Lisensi fisik yang sudah terbit akan kami kirimkan via kurir berasuransi ke kantor Anda.'
                    ]
                ]
            ],

            'mutasi-perusahaan' => [
                'slug'           => 'mutasi-perusahaan',
                'judul'          => 'Jasa Mutasi SKP Ahli K3 Antar Perusahaan (Pindah PT / Perubahan Penunjukan)',
                'kategori'       => 'kemnaker-ahli-k3',
                'kategori_label' => 'SKP Kemnaker RI',
                'dasar_hukum'    => 'Permenaker No. Per.02/MEN/1992 Pasal 7 & Kepdirjen Binwasnaker',
                'tagline'        => 'Layanan mutasi penunjukan SKP dan Lisensi Ahli K3 dari perusahaan lama ke tempat kerja baru resmi Kemnaker RI.',
                'meta_title'     => 'Jasa Mutasi SKP Ahli K3 Kemnaker: Pindah Perusahaan Cepat & Resmi',
                'meta_desc'      => 'Jasa mutasi SKP Ahli K3 pindah perusahaan resmi Kemnaker RI. Solusi ganti nama PT di lisensi K3 tanpa kursus ulang. Syarat mudah & proses legal.',
                'keywords'       => ['mutasi skp ahli k3 umum', 'pindah perusahaan skp k3', 'ganti pt lisensi ahli k3', 'mutasi penunjukan ahli k3 kemnaker', 'cara mutasi skp ak3u'],
                'masa_berlaku'   => '3 (tiga) tahun penunjukan baru di perusahaan terkini',
                'biaya_standar'  => 'Rp 2.450.000',
                'biaya_batch'    => 'Rp 2.100.000 / orang (min. 2 berkas)',
                'durasi_proses'  => '10 – 16 hari kerja',
                'city_keyword'   => 'Surabaya & Jabodetabek',
                'deskripsi_lengkap' => 'SKP Ahli K3 bersifat melekat pada badan usaha yang mengajukan penunjukan awal. Apabila seorang Ahli K3 berpindah tempat kerja, mengundurkan diri, atau perusahaan mengalami merger/ganti nama di kota industri seperti Surabaya atau Jabodetabek, maka SKP lama otomatis tidak sah untuk mewakili perusahaan baru. Melalui prosedur mutasi penunjukan resmi Kemnaker RI, Anda tidak perlu mengikuti pelatihan ulang; sertifikat asli calon Ahli K3 dialihkan ke penunjukan badan usaha baru secara sah.',
                'syarat_dokumen' => [
                    'Scan Asli SKP dan Lisensi K3 di perusahaan lama',
                    'Scan Asli Sertifikat Pembinaan Calon Ahli K3 Kemnaker RI',
                    'Surat Keterangan Pengunduran Diri / Surat Pelepasan dari perusahaan lama (jika ada)',
                    'Surat Permohonan Penunjukan Baru dari pimpinan perusahaan saat ini',
                    'Surat Pernyataan Kerja Penuh Waktu (Full-Time) bermaterai di PT baru',
                    'Struktur Organisasi P2K3 di perusahaan baru yang mencantumkan nama pemohon',
                    'Salinan KTP, Ijazah, dan pas foto 3x4 & 4x6 latar belakang merah'
                ],
                'alur_proses' => [
                    'Review Kelengkapan Berkas Pelepasan PT Lama & Penerimaan PT Baru',
                    'Penyusunan Berkas Pengalihan Penunjukan Badan Usaha',
                    'Pengajuan ke Subdit Pengawasan Norma K3 Kemnaker RI',
                    'Penerbitan SKP & Kartu Kewenangan Baru atas nama PT yang baru'
                ],
                'faqs' => [
                    [
                        'q' => 'Apakah mutasi SKP memerlukan tanda tangan dari pimpinan perusahaan lama?',
                        'a' => 'Idealnya ada surat pelepasan/keterangan berhenti kerja dari PT lama. Namun jika perusahaan lama sudah tutup atau ada kendala komunikasi, tim regulasi Wahana Totalita memiliki prosedur klarifikasi legal ke dinas terkait agar hak keprofesian Anda tetap terlindungi.'
                    ],
                    [
                        'q' => 'Apakah nomor registrasi sertifikat K3 akan berubah saat mutasi PT?',
                        'a' => 'Tidak. Nomor registrasi sertifikat kompetensi dasar Anda tetap sama, yang diperbarui adalah Surat Keputusan Penunjukan (SKP) dan Kartu Lisensi Kewenangan yang mencantumkan nama badan usaha terkini.'
                    ]
                ]
            ],

            'ahli-k3-listrik' => [
                'slug'           => 'ahli-k3-listrik',
                'judul'          => 'Perpanjangan SKP & Lisensi Ahli K3 Listrik & Teknisi Listrik Kemnaker',
                'kategori'       => 'kemnaker-ahli-k3',
                'kategori_label' => 'SKP Kemnaker RI',
                'dasar_hukum'    => 'Permenaker No. 12 Tahun 2015 tentang K3 Listrik di Tempat Kerja',
                'tagline'        => 'Pembaharuan masa berlaku lisensi kewenangan pengawasan teknis dan instalasi kelistrikan pabrik berdaya tinggi.',
                'meta_title'     => 'Perpanjangan SKP Ahli K3 Listrik & Teknisi Kemnaker: Biaya & Syarat',
                'meta_desc'      => 'Jasa perpanjangan SKP Ahli K3 Listrik dan Lisensi Teknisi Listrik resmi Kemnaker RI. Proses administratif cepat tanpa re-training. Konsultasi WhatsApp.',
                'keywords'       => ['perpanjangan skp ahli k3 listrik', 'perpanjangan lisensi teknisi k3 listrik', 'syarat perpanjang lisensi listrik kemnaker', 'biaya perpanjang ak3 listrik'],
                'masa_berlaku'   => '3 (tiga) tahun untuk Ahli K3 Listrik; 3 tahun untuk Teknisi Listrik',
                'biaya_standar'  => 'Rp 2.250.000',
                'biaya_batch'    => 'Rp 1.950.000 / orang',
                'durasi_proses'  => '10 – 14 hari kerja',
                'city_keyword'   => 'Cilegon & Karawang',
                'deskripsi_lengkap' => 'Pabrik petrokimia Cilegon dan manufaktur otomotif Karawang yang memiliki pembangkitan atau instalasi listrik di atas 200 kVA diwajibkan mempekerjakan Ahli K3 Listrik berpenunjukan aktif. Lisensi yang kedaluwarsa membuat pengawasan instalasi bertegangan tinggi kehilangan legalitas hukum. Kami memfasilitasi perpanjangan SKP Ahli K3 Listrik dan Teknisi K3 Listrik Kemnaker secara resmi.',
                'syarat_dokumen' => [
                    'Scan SKP & Lisensi K3 Listrik periode sebelumnya',
                    'Scan Sertifikat Pembinaan Kemnaker RI',
                    'Surat Permohonan Perpanjangan dari pimpinan pabrik',
                    'Laporan Pengawasan Instalasi Listrik Semesteran di tempat kerja',
                    'Salinan KTP, Ijazah Teknik Elektro/Mesin, dan pas foto resmi'
                ],
                'alur_proses' => [
                    'Verifikasi Laporan Inspeksi Kelistrikan yang Ditandatangani Pemohon',
                    'Pendaftaran Pembaharuan ke Direktorat Bina Pengawasan PNK3',
                    'Penerbitan SKP & Lisensi Ahli/Teknisi K3 Listrik yang diperbarui'
                ],
                'faqs' => [
                    [
                        'q' => 'Apa bedanya perpanjangan SKP Ahli K3 Listrik dengan Teknisi K3 Listrik?',
                        'a' => 'Ahli K3 Listrik berwenang merencanakan, mengawasi, dan mengesahkan sistem instalasi (termasuk SKP penunjukan menteri), sedangkan Teknisi K3 Listrik berwenang pada pemasangan, pemeliharaan, dan perbaikan operasional.'
                    ]
                ]
            ],

            'ahli-k3-konstruksi' => [
                'slug'           => 'ahli-k3-konstruksi',
                'judul'          => 'Perpanjangan SKP Ahli K3 Konstruksi Kemnaker (Muda, Madya, Utama)',
                'kategori'       => 'kemnaker-ahli-k3',
                'kategori_label' => 'SKP Kemnaker RI',
                'dasar_hukum'    => 'Permenaker No. Per.01/MEN/1980 tentang K3 pada Konstruksi Bangunan',
                'tagline'        => 'Pembaharuan legalitas penunjukan Ahli K3 Konstruksi untuk syarat kualifikasi tender LPSE dan proyek EPC nasional.',
                'meta_title'     => 'Perpanjangan SKP Ahli K3 Konstruksi Kemnaker: Syarat Tender LPSE',
                'meta_desc'      => 'Jasa perpanjangan SKP Ahli K3 Konstruksi Kemnaker (Muda, Madya, Utama). Syarat mutlak tender proyek LPSE & IKN. Proses resmi, cepat, dan bergaransi.',
                'keywords'       => ['perpanjangan skp ahli k3 konstruksi', 'perpanjangan ahli muda k3 konstruksi', 'syarat tender lpse ahli k3', 'biaya perpanjang ak3 konstruksi'],
                'masa_berlaku'   => '3 (tiga) tahun',
                'biaya_standar'  => 'Rp 2.250.000',
                'biaya_batch'    => 'Rp 1.950.000 / orang',
                'durasi_proses'  => '10 – 14 hari kerja',
                'city_keyword'   => 'Balikpapan & IKN Nusantara',
                'deskripsi_lengkap' => 'Kontraktor pelaksana proyek infrastruktur IKN Nusantara dan proyek gedung bertingkat wajib menyertakan SKP Ahli K3 Konstruksi yang masih aktif dalam dokumen penawaran tender LPSE. Keterlambatan perpanjangan berisiko menggugurkan dokumen tender perusahaan. Kami membantu pengurusan perpanjangan SKP Ahli Muda, Madya, dan Utama Konstruksi resmi Kemnaker RI.',
                'syarat_dokumen' => [
                    'Scan SKP dan Lisensi Ahli K3 Konstruksi terdahulu',
                    'Sertifikat Pembinaan Kemnaker RI',
                    'Surat Permohonan Perpanjangan dari kontraktor / PT pemohon',
                    'Laporan Pelaksanaan RK3K / SMKK Proyek Konstruksi terkini',
                    'Pas foto 3x4 & 4x6 latar belakang merah'
                ],
                'alur_proses' => [
                    'Review berkas laporan keselamatan proyek konstruksi',
                    'Koordinasi dengan Pengawas Ketenagakerjaan Spesialis K3 Konstruksi',
                    'Penerbitan SKP & Lisensi baru siap pakai untuk tender'
                ],
                'faqs' => [
                    [
                        'q' => 'Apakah SKP Ahli K3 Konstruksi yang sedang diproses perpanjangan bisa mendapatkan Surat Keterangan untuk tender?',
                        'a' => 'Bisa. Begitu berkas resmi masuk dan terdaftar di sistem Kemnaker RI, kami dapat memfasilitasi penerbitan Surat Keterangan Sedang Proses (Resi Resmi PJK3/Kemnaker) yang lazim diterima pokja tender sebagai bukti kepatuhan.'
                    ]
                ]
            ],

            'ahli-k3-kimia' => [
                'slug'           => 'ahli-k3-kimia',
                'judul'          => 'Perpanjangan SKP Ahli K3 Kimia & Petugas Kimia Kemnaker RI',
                'kategori'       => 'kemnaker-ahli-k3',
                'kategori_label' => 'SKP Kemnaker RI',
                'dasar_hukum'    => 'Kepmenaker No. Kep.187/MEN/1999 tentang Pengendalian Bahan Kimia Berbahaya',
                'tagline'        => 'Pembaharuan lisensi pengawasan penanganan bahan kimia berbahaya (B3), LDKB/MSDS, dan dokumen pengendalian potensi bahaya besar.',
                'meta_title'     => 'Perpanjangan SKP Ahli K3 Kimia & Petugas Kimia Kemnaker Resmi',
                'meta_desc'      => 'Jasa perpanjangan SKP Ahli K3 Kimia & Lisensi Petugas K3 Kimia Kemnaker RI. Kepatuhan audit Kepmenaker 187/1999 industri B3 & manufaktur kimia.',
                'keywords'       => ['perpanjangan skp ahli k3 kimia', 'lisensi petugas k3 kimia', 'syarat perpanjang k3 kimia', 'biaya perpanjang skp kimia'],
                'masa_berlaku'   => '3 (tiga) tahun',
                'biaya_standar'  => 'Rp 2.250.000',
                'biaya_batch'    => 'Rp 1.950.000 / orang',
                'durasi_proses'  => '10 – 14 hari kerja',
                'city_keyword'   => 'Cilegon & Gresik',
                'deskripsi_lengkap' => 'Industri kimia petrokimia di Cilegon dan kawasan industri Gresik dengan potensi bahaya besar (Major Hazard Installation) wajib memiliki Ahli K3 Kimia dengan penunjukan SKP sah. Layanan kami memfasilitasi perpanjangan berkala dengan pelaporan audit bahan kimia sesuai Kepmenaker 187/1999.',
                'syarat_dokumen' => [
                    'Scan Asli SKP dan Lisensi K3 Kimia lama',
                    'Sertifikat Pembinaan Kemnaker RI',
                    'Surat Permohonan Perpanjangan dari manajemen pabrik',
                    'Dokumen Penetapan Potensi Bahaya Bahan Kimia (Besar/Menengah)',
                    'Laporan Pengawasan Bahan B3 Semesteran & pas foto resmi'
                ],
                'alur_proses' => [
                    'Verifikasi dokumen pelaporan bahan kimia berbahaya',
                    'Pengajuan pembaharuan lisensi ke Direktorat PNK3',
                    'Penerbitan SKP dan Lisensi K3 Kimia aktif'
                ],
                'faqs' => [
                    [
                        'q' => 'Kapan pabrik kimia wajib memperpanjang SKP Ahli K3 Kimia?',
                        'a' => 'Pengajuan perpanjangan sebaiknya dilakukan paling lambat 1–2 bulan sebelum tanggal kedaluwarsa 3 tahun terlewati agar kontinuitas pengawasan dokumen B3 tetap terjaga.'
                    ]
                ]
            ],

            'ahli-k3-kebakaran' => [
                'slug'           => 'ahli-k3-kebakaran',
                'judul'          => 'Perpanjangan Lisensi Damkar Kemnaker (Kelas D, C, B, A & Ahli K3 Kebakaran)',
                'kategori'       => 'kemnaker-ahli-k3',
                'kategori_label' => 'SKP Kemnaker RI',
                'dasar_hukum'    => 'Kepmenaker No. Kep.186/MEN/1999 tentang Unit Penanggulangan Kebakaran di Tempat Kerja',
                'tagline'        => 'Perpanjangan Lisensi Petugas Peran Kebakaran (Kelas D), Regu (Kelas C), Koordinator (Kelas B), dan Ahli Spesialis Kebakaran (Kelas A).',
                'meta_title'     => 'Perpanjangan Lisensi Damkar Kemnaker Kelas D, C, B, A & SKP Ahli',
                'meta_desc'      => 'Jasa perpanjangan lisensi damkar Kemnaker RI kelas D, C, B, A dan SKP Ahli K3 Kebakaran. Syarat mudah, resmi, dan cepat untuk audit proteksi kebakaran.',
                'keywords'       => ['perpanjangan lisensi damkar kemnaker', 'perpanjangan damkar kelas d', 'lisensi k3 kebakaran', 'perpanjangan ahli k3 kebakaran'],
                'masa_berlaku'   => '3 (tiga) tahun untuk lisensi dan SKP spesialis',
                'biaya_standar'  => 'Rp 1.950.000',
                'biaya_batch'    => 'Rp 1.650.000 / orang (min. 3 orang)',
                'durasi_proses'  => '7 – 12 hari kerja',
                'city_keyword'   => 'Jakarta & Semarang',
                'deskripsi_lengkap' => 'Unit penanggulangan kebakaran di gedung perkantoran bertingkat Jakarta dan kawasan industri Semarang memerlukan tim fire brigade yang memiliki lisensi aktif. Perpanjangan lisensi Kelas D (Petugas Peran), Kelas C (Regu Pemadam), Kelas B (Koordinator), dan Kelas A (Ahli Spesialis) memastikan sertifikasi fire safety perusahaan selalu patuh regulasi.',
                'syarat_dokumen' => [
                    'Scan Lisensi / SKP Damkar lama',
                    'Sertifikat Pembinaan Damkar Kemnaker RI',
                    'Surat Permohonan Perpanjangan dari perusahaan',
                    'Laporan Simulasi Tanggap Darurat Kebakaran tahunan',
                    'Pas foto 3x4 & 4x6 latar belakang merah'
                ],
                'alur_proses' => [
                    'Verifikasi lisensi dan struktur tim tanggap darurat gedung',
                    'Pengajuan administrasi ke Kementerian Ketenagakerjaan RI',
                    'Penerbitan kartu lisensi damkar yang baru'
                ],
                'faqs' => [
                    [
                        'q' => 'Apakah lisensi Damkar Kelas D dan C bisa diperpanjang secara kolektif satu perusahaan?',
                        'a' => 'Bisa. Perpanjangan kolektif seluruh regu pemadam pabrik justru sangat dianjurkan dan mendapatkan potongan tarif batch khusus dari Wahana Totalita.'
                    ]
                ]
            ],

            'auditor-smk3' => [
                'slug'           => 'auditor-smk3',
                'judul'          => 'Perpanjangan SKP Auditor SMK3 Kemnaker RI (PP No. 50 Tahun 2012)',
                'kategori'       => 'kemnaker-ahli-k3',
                'kategori_label' => 'SKP Kemnaker RI',
                'dasar_hukum'    => 'Permenaker No. 26 Tahun 2014 tentang Penyelenggaraan Penilaian Penerapan SMK3',
                'tagline'        => 'Pembaharuan SK Penunjukan dan Kartu Lisensi Auditor Eksternal / Internal SMK3 resmi Kementerian Ketenagakerjaan.',
                'meta_title'     => 'Perpanjangan SKP Auditor SMK3 Kemnaker: Syarat & Alur Resmi',
                'meta_desc'      => 'Jasa perpanjangan SKP Auditor SMK3 Kemnaker RI (PP 50/2012). Pertahankan wewenang audit sertifikasi bendera emas. Proses resmi, cepat, & transparan.',
                'keywords'       => ['perpanjangan skp auditor smk3', 'auditor smk3 kemnaker perpanjang', 'lisensi auditor smk3', 'syarat perpanjang auditor smk3'],
                'masa_berlaku'   => '3 (tiga) tahun',
                'biaya_standar'  => 'Rp 2.500.000',
                'biaya_batch'    => 'Rp 2.200.000 / orang',
                'durasi_proses'  => '10 – 16 hari kerja',
                'city_keyword'   => 'Jakarta & Bandung',
                'deskripsi_lengkap' => 'Auditor SMK3 memiliki kewenangan hukum melakukan penilaian penerapan Sistem Manajemen Keselamatan dan Kesehatan Kerja sesuai PP 50/2012. SK Penunjukan Auditor yang habis masa berlaku tidak sah digunakan untuk menandatangani Laporan Audit K3 lembaga sertifikasi. Wahana Totalita membantu proses perpanjangan SKP Auditor SMK3 secara tuntas.',
                'syarat_dokumen' => [
                    'Scan SKP dan Lisensi Auditor SMK3 lama',
                    'Sertifikat Pelatihan Auditor SMK3 Kemnaker RI',
                    'Surat Permohonan Perpanjangan dari Lembaga Audit / Perusahaan',
                    'Logbook / Bukti Pengalaman Audit SMK3 yang telah dilaksanakan',
                    'Pas foto 3x4 & 4x6 latar belakang merah'
                ],
                'alur_proses' => [
                    'Verifikasi logbook jam terbang audit K3 pemohon',
                    'Pengajuan berkas ke Direktorat PNK3 Kemnaker',
                    'Penerbitan SKP Auditor SMK3 baru'
                ],
                'faqs' => [
                    [
                        'q' => 'Apakah wajib menyertakan logbook bukti audit untuk perpanjangan Auditor SMK3?',
                        'a' => 'Ya, pengawas Kemnaker mensyaratkan bukti keterlibatan dalam kegiatan audit K3 internal maupun eksternal selama masa berlaku 3 tahun sebelumnya sebagai bukti pemeliharaan kompetensi.'
                    ]
                ]
            ],

            'skp-sudah-kadaluwarsa' => [
                'slug'           => 'skp-sudah-kadaluwarsa',
                'judul'          => 'Solusi SKP K3 Sudah Kadaluwarsa / Expired: Refresher K3 Tanpa Ulang Dari Nol',
                'kategori'       => 'kemnaker-ahli-k3',
                'kategori_label' => 'SKP Kemnaker RI',
                'dasar_hukum'    => 'Surat Edaran Kemnaker RI tentang Batas Toleransi dan Pembinaan Penyegaran (Refresher) Ahli K3',
                'tagline'        => 'Panduan resmi bagi praktisi yang SKP-nya telah mati lebih dari 1 tahun. Solusi cepat tanpa harus ikut kursus 12 hari penuh.',
                'meta_title'     => 'SKP K3 Sudah Kadaluwarsa? Solusi Perpanjangan & Refresher Resmi',
                'meta_desc'      => 'SKP Ahli K3 sudah kadaluwarsa lebih dari 1 tahun? Masih bisa aktif kembali via program Refresher K3 resmi Kemnaker tanpa mengulang dari nol. Cek solusinya!',
                'keywords'       => ['skp kadaluwarsa', 'skp sudah mati apakah harus pelatihan ulang', 'refresher skp k3', 'toleransi expired skp k3', 'perpanjangan skp lewat 1 tahun'],
                'masa_berlaku'   => '3 (tiga) tahun penunjukan baru setelah refresher',
                'biaya_standar'  => 'Rp 3.850.000',
                'biaya_batch'    => 'Rp 3.300.000 / orang',
                'durasi_proses'  => 'Program penyegaran 2 hari + proses terbit 10 hari',
                'city_keyword'   => 'Seluruh Indonesia',
                'deskripsi_lengkap' => 'Banyak praktisi K3 panik saat mendapati SKP-nya sudah expired lebih dari 1 atau 2 tahun karena berpindah tugas atau terlupa. Regulasi Kemnaker menyediakan skema Pembinaan Penyegaran (Refresher K3) resmi. Melalui skema ini, pemegang sertifikat lama cukup mengikuti review regulasi dan evaluasi singkat (2 hari) tanpa harus membayar biaya penuh pembinaan awal 12 hari.',
                'syarat_dokumen' => [
                    'Scan Asli Sertifikat Pembinaan Calon Ahli K3 Kemnaker (Sertifikat tidak pernah hangus seumur hidup)',
                    'Scan SKP dan Lisensi lama yang telah expired',
                    'Surat Keterangan Kebutuhan Penunjukan dari perusahaan tempat bekerja saat ini',
                    'KTP, Ijazah terakhir, dan pas foto resmi'
                ],
                'alur_proses' => [
                    'Pengecekan Keaslian Sertifikat Dasar di Database Kemnaker RI',
                    'Pendaftaran Sesi Refresher K3 Resmi PJK3 Wahana Totalita',
                    'Evaluasi Ulang Pemahaman Regulasi Ketenagakerjaan Terkini',
                    'Penerbitan SKP & Lisensi Kewenangan Aktif Kembali'
                ],
                'faqs' => [
                    [
                        'q' => 'Apakah sertifikat Ahli K3 Umum saya hangus jika SKP expired bertahun-tahun?',
                        'a' => 'TIDAK HANGUS. Sertifikat kompetensi kelulusan Kemnaker berlaku seumur hidup. Yang expired hanyalah Surat Keputusan Penunjukan (SKP) dan Kartu Lisensi Kewenangannya. Oleh karena itu, Anda berhak mengikuti skema Refresher K3.'
                    ]
                ]
            ],

            // PILAR 2: SIO OPERATOR & TEKNISI KEMNAKER (HARGA STANDAR Rp 1.750.000 / BATCH Rp 1.500.000)
            'sio-forklift' => [
                'slug'           => 'sio-forklift',
                'judul'          => 'Perpanjangan SIO & Lisensi K3 Operator Forklift Kemnaker RI',
                'kategori'       => 'kemnaker-sio-operator',
                'kategori_label' => 'SIO Operator Kemnaker',
                'dasar_hukum'    => 'Permenaker No. 8 Tahun 2020 tentang K3 Pesawat Angkat dan Pesawat Angkut',
                'tagline'        => 'Perpanjangan resmi Surat Izin Operator (SIO) Forklift Kelas I dan Kelas II tanpa ujian praktik ulang.',
                'meta_title'     => 'Perpanjangan SIO Forklift Kemnaker Resmi: Biaya, Syarat & Proses Cepat',
                'meta_desc'      => 'Jasa perpanjangan SIO Forklift Kemnaker Kelas 1 & 2 resmi. Biaya mulai Rp 1.500.000,- proses cepat tanpa tes ulang. Syarat mudah kirim WhatsApp.',
                'keywords'       => ['perpanjangan sio forklift', 'biaya perpanjang sio forklift kemnaker', 'syarat perpanjangan lisensi forklift', 'sio forklift expired', 'perpanjangan lisensi operator forklift'],
                'masa_berlaku'   => '5 (lima) tahun untuk lisensi K3 operator Kemnaker',
                'biaya_standar'  => 'Rp 1.750.000',
                'biaya_batch'    => 'Rp 1.500.000 / lisensi (min. 3 unit)',
                'durasi_proses'  => '7 – 10 hari kerja',
                'city_keyword'   => 'Bekasi & Cikarang',
                'deskripsi_lengkap' => 'Kawasan industri pergudangan Cikarang dan Bekasi memiliki ribuan unit forklift yang beroperasi 24 jam. Pengawas Disnaker dan auditor CSMS secara rutin merazia masa berlaku SIO operator. Mengemudikan forklift dengan SIO kedaluwarsa melanggar Permenaker 8/2020. Layanan kami memfasilitasi perpanjangan SIO Forklift Kelas 1 (kapasitas > 15 ton) dan Kelas 2 (kapasitas < 15 ton) secara resmi tanpa perlu tes praktik ulang.',
                'syarat_dokumen' => [
                    'Scan Asli SIO / Lisensi K3 Operator Forklift lama',
                    'Scan Sertifikat Pembinaan Operator Forklift Kemnaker RI',
                    'Surat Keterangan Masih Bekerja Mengoperasikan Forklift dari perusahaan',
                    'Surat Keterangan Sehat dari dokter / klinik',
                    'Salinan KTP dan pas foto 3x4 (2 lembar latar merah)'
                ],
                'alur_proses' => [
                    'Review berkas foto SIO via WhatsApp',
                    'Registrasi perpanjangan ke sistem TemanK3 Ditjen Binwasnaker',
                    'Pencetakan Lisensi K3 & Buku Kerja Operator baru',
                    'Pengiriman kartu SIO fisik ber-barcode resmi ke perusahaan'
                ],
                'faqs' => [
                    [
                        'q' => 'Berapa biaya perpanjangan SIO Forklift Kemnaker?',
                        'a' => 'Biaya perpanjangan retail adalah Rp 1.750.000,- per lisensi. Untuk pendaftaran rombongan / batch perusahaan (minimal 3 lisensi), biaya khusus menjadi Rp 1.500.000,- per lisensi.'
                    ],
                    [
                        'q' => 'Apakah operator harus datang ke lokasi untuk tes praktik lagi?',
                        'a' => 'Tidak perlu. Selama SIO lama masih dalam batas masa tenggang, proses perpanjangan murni administratif melalui verifikasi jam terbang kerja dari perusahaan.'
                    ]
                ]
            ],

            'sio-crane' => [
                'slug'           => 'sio-crane',
                'judul'          => 'Perpanjangan SIO Operator Crane Kemnaker (Mobile, Overhead & Tower Crane)',
                'kategori'       => 'kemnaker-sio-operator',
                'kategori_label' => 'SIO Operator Kemnaker',
                'dasar_hukum'    => 'Permenaker No. 8 Tahun 2020 tentang K3 Pesawat Angkat dan Pesawat Angkut',
                'tagline'        => 'Perpanjangan Lisensi K3 Operator Crane Kelas 1, 2, 3 dan Rigger resmi Kementerian Ketenagakerjaan.',
                'meta_title'     => 'Perpanjangan SIO Crane Kemnaker: Mobile, Overhead & Tower Crane',
                'meta_desc'      => 'Jasa perpanjangan SIO Crane Kemnaker resmi (Mobile, Overhead, Tower, Crawler). Biaya mulai Rp 1.500.000. Proses cepat tanpa tes ulang.',
                'keywords'       => ['perpanjangan sio crane', 'biaya perpanjang lisensi crane kemnaker', 'sio overhead crane expired', 'perpanjangan operator mobile crane'],
                'masa_berlaku'   => '5 (lima) tahun',
                'biaya_standar'  => 'Rp 1.750.000',
                'biaya_batch'    => 'Rp 1.500.000 / lisensi (min. 3 lisensi)',
                'durasi_proses'  => '7 – 12 hari kerja',
                'city_keyword'   => 'Balikpapan & Batam',
                'deskripsi_lengkap' => 'Proyek erection di Balikpapan dan galangan kapal Batam mewajibkan seluruh operator crane memiliki lisensi Kemnaker yang berlaku aktif. Kami memproses perpanjangan SIO Operator Mobile Crane, Overhead Crane, Tower Crane, Crawler Crane Kelas 1, 2, 3 dan Petugas Juru Ikat (Rigger).',
                'syarat_dokumen' => [
                    'Scan SIO / Lisensi Crane lama & Sertifikat Kemnaker',
                    'Surat Keterangan Kerja Operator Crane dari perusahaan',
                    'Surat Keterangan Sehat dokter (tidak buta warna)',
                    'KTP dan pas foto resmi 3x4 latar belakang merah'
                ],
                'alur_proses' => [
                    'Verifikasi kelas kapasitas crane (Kelas 1 > 100 Ton, Kelas 2 25-100 Ton, Kelas 3 < 25 Ton)',
                    'Pengajuan pembaharuan lisensi di sistem Kemnaker RI',
                    'Penerbitan SIO & Buku Kerja Operator baru'
                ],
                'faqs' => [
                    [
                        'q' => 'Berapa tahun masa berlaku lisensi operator crane Kemnaker?',
                        'a' => 'Lisensi K3 Operator Crane Kemnaker RI berlaku selama 5 (lima) tahun dan wajib diperpanjang sebelum tanggal berakhir.'
                    ]
                ]
            ],

            'sio-boiler-ketel-uap' => [
                'slug'           => 'sio-boiler-ketel-uap',
                'judul'          => 'Perpanjangan SIO Operator Boiler & Ketel Uap Kemnaker RI',
                'kategori'       => 'kemnaker-sio-operator',
                'kategori_label' => 'SIO Operator Kemnaker',
                'dasar_hukum'    => 'Permenaker No. 01 Tahun 1988 tentang Kwalifikasi dan Syarat-Syarat Operator Pesawat Uap',
                'tagline'        => 'Pembaharuan Lisensi K3 Operator Boiler Kelas 1 dan Kelas 2 untuk industri kelapa sawit, tekstil, dan pembangkit.',
                'meta_title'     => 'Perpanjangan SIO Operator Boiler Kemnaker Kelas 1 & 2 Resmi',
                'meta_desc'      => 'Jasa perpanjangan SIO Operator Boiler Kemnaker RI Kelas 1 & 2. Syarat audit pabrik sawit PKS & industri tekstil. Biaya mulai Rp 1.500.000,- proses cepat.',
                'keywords'       => ['perpanjangan sio boiler', 'sio operator ketel uap kemnaker', 'perpanjangan lisensi boiler kelas 1 2', 'biaya perpanjang sio boiler'],
                'masa_berlaku'   => '5 (lima) tahun',
                'biaya_standar'  => 'Rp 1.750.000',
                'biaya_batch'    => 'Rp 1.500.000 / lisensi',
                'durasi_proses'  => '7 – 12 hari kerja',
                'city_keyword'   => 'Pekanbaru & Medan',
                'deskripsi_lengkap' => 'Pabrik Kelapa Sawit (PKS) di Riau (Pekanbaru, Dumai) dan Sumatera Utara (Medan) beroperasi dengan ketel uap bertekanan tinggi yang wajib diawasi Operator Boiler Kelas 1 dan 2 berlisensi aktif. Jangan biarkan audit RSPO/ISPO terkendala SIO mati. Kami urus perpanjangannya secara tuntas.',
                'syarat_dokumen' => [
                    'Scan SIO / Lisensi Operator Boiler lama',
                    'Sertifikat Pembinaan Operator Pesawat Uap Kemnaker RI',
                    'Surat Keterangan Aktif Bekerja dari Manajemen PKS / Pabrik',
                    'KTP, Surat Keterangan Sehat, dan pas foto 3x4 latar merah'
                ],
                'alur_proses' => [
                    'Pengecekan keabsahan SIO Kelas 1 atau Kelas 2',
                    'Pengurusan perpanjangan ke Pengawas Ketenagakerjaan Spesialis Uap',
                    'Penerbitan SIO dan Buku Kerja Operator Boiler baru'
                ],
                'faqs' => [
                    [
                        'q' => 'Berapa biaya perpanjangan SIO Boiler?',
                        'a' => 'Tarif perpanjangan perorangan adalah Rp 1.750.000,- dan tarif batch perusahaan (minimal 3 lisensi operator PKS) adalah Rp 1.500.000,- per orang.'
                    ]
                ]
            ],

            'lisensi-ketinggian-tkbt-tkpk' => [
                'slug'           => 'lisensi-ketinggian-tkbt-tkpk',
                'judul'          => 'Perpanjangan Lisensi Bekerja di Ketinggian TKBT & TKPK Kemnaker',
                'kategori'       => 'kemnaker-sio-operator',
                'kategori_label' => 'SIO Operator Kemnaker',
                'dasar_hukum'    => 'Permenaker No. 9 Tahun 2016 tentang K3 dalam Pekerjaan pada Ketinggian',
                'tagline'        => 'Pembaharuan Lisensi Tenaga Kerja Bangunan Tinggi (TKBT 1, 2) dan Tenaga Kerja Pada Ketinggian / Rope Access (TKPK 1, 2, 3).',
                'meta_title'     => 'Perpanjangan Lisensi TKBT & TKPK Ketinggian Kemnaker Resmi',
                'meta_desc'      => 'Jasa perpanjangan lisensi K3 ketinggian TKBT 1 & 2 serta TKPK 1, 2, 3 Kemnaker RI. Biaya mulai Rp 1.500.000. Proses cepat tanpa tes panjat ulang.',
                'keywords'       => ['perpanjangan lisensi tkbt 2', 'perpanjangan tkpk kemnaker', 'lisensi rope access expired', 'perpanjang sio bekerja di ketinggian'],
                'masa_berlaku'   => '3 (tiga) tahun untuk lisensi ketinggian',
                'biaya_standar'  => 'Rp 1.750.000',
                'biaya_batch'    => 'Rp 1.500.000 / lisensi',
                'durasi_proses'  => '7 – 10 hari kerja',
                'city_keyword'   => 'Jakarta & Bandung',
                'deskripsi_lengkap' => 'Pekerja pembersih kaca fasad gedung Jakarta dan teknisi maintenance tower telekomunikasi di Bandung wajib memegang Lisensi TKBT atau TKPK Kemnaker yang aktif. Bekerja di ketinggian tanpa lisensi sah berpotensi menghentikan izin kerja (Working at Height Permit). Kami bantu perpanjangan administratif tanpa perlu tes panjat ulang.',
                'syarat_dokumen' => [
                    'Scan Lisensi Ketinggian (TKBT / TKPK) periode terdahulu',
                    'Sertifikat Pembinaan Kemnaker RI',
                    'Surat Keterangan Sehat dokter (bebas vertigo dan epilepsi)',
                    'Surat Keterangan Kerja dari perusahaan pemberi kerja',
                    'Pas foto 3x4 latar belakang merah'
                ],
                'alur_proses' => [
                    'Verifikasi kualifikasi tingkat TKBT atau TKPK (Rope Access)',
                    'Pengajuan ke Direktorat PNK3 Kemnaker RI',
                    'Penerbitan kartu lisensi kerja ketinggian baru'
                ],
                'faqs' => [
                    [
                        'q' => 'Apakah teknisi rope access TKPK wajib melampirkan logbook pemanjatan?',
                        'a' => 'Ya, untuk TKPK tingkat 2 dan 3, logbook jam kerja pemanjatan sangat membantu mempercepat proses validasi pengawas Kemnaker.'
                    ]
                ]
            ],

            'buku-lisensi-juru-las' => [
                'slug'           => 'buku-lisensi-juru-las',
                'judul'          => 'Perpanjangan Buku Kerja Las & Lisensi Juru Las (Welder) Kemnaker',
                'kategori'       => 'kemnaker-sio-operator',
                'kategori_label' => 'SIO Operator Kemnaker',
                'dasar_hukum'    => 'Permenaker No. 02 Tahun 1982 tentang Kwalifikasi Juru Las di Tempat Kerja',
                'tagline'        => 'Perpanjangan Lisensi Juru Las Kelas 1, Kelas 2, dan Kelas 3 serta pembaharuan cap buku kerja welder resmi Kemnaker.',
                'meta_title'     => 'Perpanjangan Lisensi Juru Las Welder Kemnaker Kelas 1, 2, 3 Resmi',
                'meta_desc'      => 'Jasa perpanjangan lisensi juru las (welder) & cap buku kerja las Kemnaker Kelas 1, 2, 3. Biaya mulai Rp 1.500.000. Cepat, resmi untuk audit fabrikasi.',
                'keywords'       => ['perpanjangan lisensi juru las', 'perpanjangan buku kerja las kemnaker', 'biaya perpanjang welder kemnaker', 'sio juru las kelas 1 2 3'],
                'masa_berlaku'   => '3 (tiga) tahun',
                'biaya_standar'  => 'Rp 1.750.000',
                'biaya_batch'    => 'Rp 1.500.000 / lisensi',
                'durasi_proses'  => '7 – 10 hari kerja',
                'city_keyword'   => 'Batam & Cilegon',
                'deskripsi_lengkap' => 'Pabrik fabrikasi baja berat di Cilegon dan galangan kapal Batam mewajibkan pengelasan bejana tekan dan konstruksi kritis dikerjakan juru las berlisensi aktif. Lisensi juru las yang kedaluwarsa dapat membatalkan sertifikasi WPS/PQR hasil pengelasan.',
                'syarat_dokumen' => [
                    'Scan Asli Lisensi Juru Las dan Buku Kerja Welder lama',
                    'Sertifikat Pembinaan Juru Las Kemnaker RI',
                    'Surat Keterangan Aktif Mengelas dari bengkel/pabrik',
                    'Surat Keterangan Sehat dokter (terutama pemeriksaan mata)',
                    'Pas foto 3x4 latar belakang merah'
                ],
                'alur_proses' => [
                    'Pengecekan kualifikasi pengelasan (Kelas 1 semua posisi, Kelas 2 pipa/plat terbatas, Kelas 3 plat)',
                    'Pengesahan pembaharuan buku kerja las ke dinas ketenagakerjaan',
                    'Penyerahan lisensi welder dan buku kerja aktif'
                ],
                'faqs' => [
                    [
                        'q' => 'Berapa biaya perpanjangan lisensi juru las Kemnaker?',
                        'a' => 'Biaya perorangan adalah Rp 1.750.000,- per juru las. Untuk rombongan fabrikator/workshop (minimal 3 orang), tarif batch hemat adalah Rp 1.500.000,- per lisensi.'
                    ]
                ]
            ],

            'sio-alat-berat-excavator' => [
                'slug'           => 'sio-alat-berat-excavator',
                'judul'          => 'Perpanjangan SIO Alat Berat Tambang & Konstruksi Kemnaker (Excavator, Loader, Dozer)',
                'kategori'       => 'kemnaker-sio-operator',
                'kategori_label' => 'SIO Operator Kemnaker',
                'dasar_hukum'    => 'Permenaker No. 8 Tahun 2020 tentang K3 Pesawat Angkat dan Pesawat Angkut',
                'tagline'        => 'Pembaharuan Lisensi K3 Operator Excavator, Wheel Loader, Bulldozer, dan Dump Truck resmi Kementerian Ketenagakerjaan.',
                'meta_title'     => 'Perpanjangan SIO Alat Berat Excavator & Loader Kemnaker Resmi',
                'meta_desc'      => 'Jasa perpanjangan SIO alat berat tambang & konstruksi Kemnaker RI (Excavator, Bulldozer, Loader). Biaya mulai Rp 1.500.000,- proses cepat tanpa tes ulang.',
                'keywords'       => ['perpanjangan sio excavator', 'sio alat berat kemnaker expired', 'perpanjangan lisensi wheel loader', 'biaya perpanjang sio bulldozer'],
                'masa_berlaku'   => '5 (lima) tahun',
                'biaya_standar'  => 'Rp 1.750.000',
                'biaya_batch'    => 'Rp 1.500.000 / lisensi (min. 3 unit)',
                'durasi_proses'  => '7 – 12 hari kerja',
                'city_keyword'   => 'Samarinda & Banjarbaru',
                'deskripsi_lengkap' => 'Operasional tambang batubara di Samarinda dan Banjarbaru (Kalimantan Selatan) menuntut kualifikasi ketat bagi operator alat gali-muat. SIO yang mati mengakibatkan operator dilarang masuk area pit tambang. Kami memfasilitasi perpanjangan SIO operator alat berat Kemnaker secara cepat dan legal.',
                'syarat_dokumen' => [
                    'Scan SIO / Lisensi K3 Alat Berat lama',
                    'Sertifikat Pembinaan Kemnaker RI',
                    'Surat Keterangan Masih Mengoperasikan Alat Berat dari kontraktor tambang/proyek',
                    'Surat Keterangan Sehat dan pas foto 3x4 latar merah'
                ],
                'alur_proses' => [
                    'Verifikasi jenis unit alat berat (Excavator, Loader, Bulldozer)',
                    'Input perpanjangan ke sistem Kemnaker RI',
                    'Penerbitan SIO dan buku kerja baru'
                ],
                'faqs' => [
                    [
                        'q' => 'Berapa biaya perpanjangan SIO excavator?',
                        'a' => 'Biaya perorangan adalah Rp 1.750.000,- dan harga rombongan kontraktor tambang (minimal 3 lisensi) adalah Rp 1.500.000,- per lisensi.'
                    ]
                ]
            ],

            // PILAR 3: BNSP SERTIFIKASI ONLINE / UJI RCC (HARGA Rp 2.500.000)
            'rcc-bnsp-k3-online' => [
                'slug'           => 'rcc-bnsp-k3-online',
                'judul'          => 'Perpanjangan Sertifikat BNSP K3 Online (RCC / Uji Pemeliharaan Kompetensi)',
                'kategori'       => 'bnsp-rcc-online',
                'kategori_label' => 'Sertifikasi BNSP (RCC)',
                'dasar_hukum'    => 'Pedoman BNSP 201 & 202 tentang Pemeliharaan Sertifikasi dan Pengakuan Kompetensi Terkini',
                'tagline'        => 'Layanan 100% online perpanjangan masa berlaku sertifikat kompetensi K3 berlogo Garuda BNSP via portofolio kerja.',
                'meta_title'     => 'Cara Perpanjang Sertifikat BNSP Online: Biaya & Syarat Uji RCC Resmi',
                'meta_desc'      => 'Cara perpanjang sertifikat BNSP K3 online resmi (Uji RCC). Biaya Rp 2.500.000,- proses cepat tanpa tes tertulis ulang. Portofolio kerja verified LSP.',
                'keywords'       => ['cara perpanjang sertifikat bnsp online', 'apakah sertifikat bnsp bisa diperpanjang', 'biaya perpanjangan sertifikat bnsp', 'uji rcc bnsp k3', 'perpanjangan sertifikasi bnsp online'],
                'masa_berlaku'   => '3 (tiga) tahun sejak tanggal penetapan sertifikat baru',
                'biaya_standar'  => 'Rp 2.500.000',
                'biaya_batch'    => 'Rp 2.200.000 / orang (min. 3 berkas)',
                'durasi_proses'  => '5 – 10 hari kerja (Asesmen Wawancara Online Zoom ±30 menit)',
                'city_keyword'   => 'Seluruh Indonesia (100% Online)',
                'deskripsi_lengkap' => 'Sertifikat kompetensi berlogo Garuda Emas BNSP memiliki masa berlaku 3 tahun. Berdasarkan pedoman BNSP, sertifikat dapat diperpanjang melalui skema Recognition of Current Competency (RCC) / Uji Pemeliharaan Kompetensi. Praktisi tidak perlu mengulang pelatihan teori atau ujian tertulis berhari-hari; cukup membuktikan bukti portofolio kerja aktif di bidang K3 dan verifikasi wawancara online bersama asesor LSP resmi.',
                'syarat_dokumen' => [
                    'Scan Asli Sertifikat BNSP lama yang akan diperpanjang',
                    'Curriculum Vitae (CV) pengalaman kerja terbaru di bidang K3',
                    'Bukti Portofolio Kerja 1–2 tahun terakhir (Contoh dokumen JSA, Laporan Inspeksi K3, Safety Induction, atau Notulen P2K3)',
                    'Surat Keterangan Kerja aktif dari perusahaan saat ini',
                    'Scan KTP, Ijazah terakhir, dan pas foto formal'
                ],
                'alur_proses' => [
                    'Pengumpulan & Validasi Portofolio Kerja via WhatsApp/Drive',
                    'Pendaftaran ke LSP Terlisensi BNSP Mitra Resmi Wahana Totalita',
                    'Sesi Asesmen Wawancara Singkat via Zoom bersama Asesor (±30 menit)',
                    'Penerbitan Sertifikat Kompetensi Baru Berlogo Garuda Emas BNSP'
                ],
                'faqs' => [
                    [
                        'q' => 'Apakah sertifikat BNSP bisa diperpanjang secara online?',
                        'a' => 'Bisa 100% online. Mulai dari pengiriman bukti portofolio kerja hingga sesi wawancara verifikasi kompetensi bersama Asesor LSP dilakukan melalui aplikasi Zoom tanpa perlu hadir fisik.'
                    ],
                    [
                        'q' => 'Berapa biaya perpanjangan sertifikat BNSP?',
                        'a' => 'Biaya perpanjangan resmi skema RCC BNSP adalah Rp 2.500.000,- all-in (termasuk biaya asesmen LSP, pencetakan blangko resmi BNSP berhologram Garuda, dan pengiriman sertifikat ke alamat Anda).'
                    ],
                    [
                        'q' => 'Berapa lama prosesnya dari pendaftaran sampai sertifikat terbit?',
                        'a' => 'Jadwal wawancara online dapat diatur dalam 2–3 hari kerja setelah portofolio lengkap. Sertifikat fisik diterbitkan LSP dan BNSP dalam waktu 7 hingga 14 hari kerja.'
                    ]
                ]
            ],

            'rcc-bnsp-lingkungan' => [
                'slug'           => 'rcc-bnsp-lingkungan',
                'judul'          => 'Perpanjangan Sertifikat BNSP Lingkungan Hidup Online (POPAL, PPPA, PPPU, Limbah B3)',
                'kategori'       => 'bnsp-rcc-online',
                'kategori_label' => 'Sertifikasi BNSP (RCC)',
                'dasar_hukum'    => 'Permen LHK No. P.03/MENLHK/SETJEN/KUM.1/2/2018 tentang Standar Kompetensi Personel Pengendalian Pencemaran',
                'tagline'        => 'Pembaharuan sertifikat kompetensi Penanggung Jawab Air Limbah (POPAL/PPPA), Pengendalian Udara (POIPPU/PPPU), dan Limbah B3 (OPLB3/MPLB3).',
                'meta_title'     => 'Perpanjangan Sertifikat BNSP Lingkungan Online: POPAL, PPPA & PPPU',
                'meta_desc'      => 'Jasa perpanjangan sertifikat BNSP Lingkungan Hidup resmi online (POPAL, PPPA, PPPU, Limbah B3). Biaya Rp 2.500.000 proses cepat portofolio kerja.',
                'keywords'       => ['perpanjangan popal bnsp', 'perpanjangan sertifikat pppa', 'perpanjang pppu online', 'uji rcc limbah b3 bnsp', 'biaya perpanjang bnsp lingkungan'],
                'masa_berlaku'   => '3 (tiga) tahun',
                'biaya_standar'  => 'Rp 2.500.000',
                'biaya_batch'    => 'Rp 2.200.000 / orang',
                'durasi_proses'  => '5 – 10 hari kerja (Wawancara Online Zoom)',
                'city_keyword'   => 'Riau & Surabaya',
                'deskripsi_lengkap' => 'Pabrik di kawasan industri Surabaya dan pabrik sawit Riau diwajibkan oleh Dinas Lingkungan Hidup & KLHK memiliki personel bersertifikat POPAL, PPPA, PPPU, atau PLB3 yang masih berlaku aktif untuk syarat pelaporan SIMPEL KLHK. Sertifikat yang kedaluwarsa berpotensi menurunkan peringkat PROPER pabrik. Layanan RCC online kami memperpanjang sertifikat lingkungan Anda secara cepat.',
                'syarat_dokumen' => [
                    'Scan Sertifikat BNSP Lingkungan lama (POPAL / PPPA / PPPU / PLB3)',
                    'CV & Surat Keterangan Kerja mengelola IPAL / Cerobong / TPS Limbah B3',
                    'Portofolio Hasil Pemantauan (Logbook IPAL harian, hasil uji lab kualitas air/emisi, neraca limbah B3)',
                    'KTP, Ijazah, dan pas foto resmi'
                ],
                'alur_proses' => [
                    'Review kelengkapan logbook pemantauan lingkungan perusahaan',
                    'Pendaftaran RCC ke LSP Lingkungan Hidup Terakreditasi BNSP',
                    'Wawancara teknis singkat via Zoom',
                    'Penerbitan sertifikat kompetensi lingkungan hidup baru'
                ],
                'faqs' => [
                    [
                        'q' => 'Apakah portofolio pengolahan air limbah atau emisi wajib melampirkan hasil lab?',
                        'a' => 'Ya, salinan laporan hasil uji lab lingkungan berkala dari laboratorium terakreditasi KAN menjadi bukti kuat bahwa Anda aktif mengendalikan pencemaran selama memegang sertifikat.'
                    ]
                ]
            ],

            'rcc-bnsp-pop-pom-mining' => [
                'slug'           => 'rcc-bnsp-pop-pom-mining',
                'judul'          => 'Perpanjangan Sertifikat BNSP POP & POM Tambang Minerba Online',
                'kategori'       => 'bnsp-rcc-online',
                'kategori_label' => 'Sertifikasi BNSP (RCC)',
                'dasar_hukum'    => 'Kepmen ESDM No. 1827 K/30/MEM/2018 tentang Kaidah Pertambangan yang Baik',
                'tagline'        => 'Pembaharuan sertifikat Pengawas Operasional Pertama (POP) dan Pengawas Operasional Madya (POM) Pertambangan via asesmen RCC online.',
                'meta_title'     => 'Perpanjangan Sertifikat POP & POM Tambang BNSP Online Resmi',
                'meta_desc'      => 'Jasa perpanjangan sertifikat POP & POM Pertambangan Minerba BNSP online resmi. Syarat legal pengawas operasional tambang KESDM. Biaya Rp 2.500.000.',
                'keywords'       => ['perpanjangan pop tambang', 'perpanjang sertifikat pom bnsp', 'uji rcc pop pertambangan online', 'biaya perpanjang pop tambang minerba'],
                'masa_berlaku'   => '3 (tiga) tahun',
                'biaya_standar'  => 'Rp 2.500.000',
                'biaya_batch'    => 'Rp 2.200.000 / orang',
                'durasi_proses'  => '5 – 10 hari kerja (Wawancara Online)',
                'city_keyword'   => 'Balikpapan & Sangatta',
                'deskripsi_lengkap' => 'Inspektur Tambang Kementerian ESDM di Balikpapan dan Sangatta (Kalimantan Timur) secara ketat memeriksa Kartu Pengawas Operasional (KPO) dan sertifikat POP/POM tambang. Pengawas yang sertifikatnya kedaluwarsa tidak sah melakukan inspeksi K3 pertambangan atau pengesahan JSA pit. Perpanjang sertifikat Anda via skema RCC online tanpa meninggalkan site tambang.',
                'syarat_dokumen' => [
                    'Scan Sertifikat POP atau POM Minerba BNSP lama',
                    'Curriculum Vitae ringkas pengalaman mengawas di pit tambang',
                    'Portofolio Inspeksi (Form laporan inspeksi K3 tambang, investigasi insiden, atau safety talk pit)',
                    'Surat Keterangan Penunjukan Pengawas Operasional dari KTT (Kepala Teknik Tambang)',
                    'KTP dan pas foto latar merah'
                ],
                'alur_proses' => [
                    'Upload berkas portofolio pengawasan tambang',
                    'Pendaftaran ke LSP Pertambangan Minerba Terlisensi BNSP',
                    'Asesmen wawancara online via Zoom',
                    'Terbit sertifikat kompetensi POP/POM baru'
                ],
                'faqs' => [
                    [
                        'q' => 'Apakah proses perpanjangan POP tambang bisa dilakukan dari mess site tambang?',
                        'a' => 'Bisa 100% online selama memiliki koneksi internet stabil untuk mengikuti sesi asesmen Zoom selama 30–45 menit bersama asesor.'
                    ]
                ]
            ]
        ];
    }

    if (empty($filter)) {
        return $items;
    }

    $filtered = [];
    foreach ($items as $key => $item) {
        if (!empty($filter['kategori']) && $item['kategori'] !== $filter['kategori']) {
            continue;
        }
        if (!empty($filter['q'])) {
            $q = mb_strtolower($filter['q']);
            $searchString = mb_strtolower($item['judul'] . ' ' . $item['tagline'] . ' ' . $item['city_keyword'] . ' ' . implode(' ', $item['keywords']));
            if (!str_contains($searchString, $q)) {
                continue;
            }
        }
        $filtered[$key] = $item;
    }

    return $filtered;
}

function get_perpanjangan_skp_item(string $slug): ?array {
    $items = get_all_perpanjangan_skp_items();
    return $items[$slug] ?? null;
}

function get_perpanjangan_skp_categories(): array {
    return [
        'kemnaker-ahli-k3'     => 'SKP Ahli K3 Kemnaker',
        'kemnaker-sio-operator' => 'SIO Operator & Teknisi',
        'bnsp-rcc-online'       => 'Sertifikasi BNSP (RCC Online)'
    ];
}

function get_related_perpanjangan_skp(string $currentSlug, string $kategori, int $limit = 3): array {
    $items = get_all_perpanjangan_skp_items();
    $related = [];

    foreach ($items as $slug => $item) {
        if ($slug === $currentSlug) continue;
        if ($item['kategori'] === $kategori) {
            $related[$slug] = $item;
            if (count($related) >= $limit) return $related;
        }
    }

    foreach ($items as $slug => $item) {
        if ($slug === $currentSlug || isset($related[$slug])) continue;
        $related[$slug] = $item;
        if (count($related) >= $limit) break;
    }

    return $related;
}
