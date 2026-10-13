<?php
/**
 * includes/training-faqs.php
 * Static topic FAQs for course programs, separated cleanly from routing logic.
 */

return [
    'universal' => [
        ['q' => 'Apa perbedaan sertifikasi K3 BNSP dan Kemnaker?', 'a' => 'Sertifikasi Kemnaker diterbitkan melalui lembaga pelatihan yang ditunjuk Kementerian Ketenagakerjaan RI, umumnya berupa Sertifikat Kompetensi K3 disertai SKP (Surat Keputusan Penunjukan) untuk profesi tertentu seperti Ahli K3 Umum. Sertifikasi BNSP diterbitkan oleh Lembaga Sertifikasi Profesi (LSP) berlisensi Badan Nasional Sertifikasi Profesi, mengacu pada skema SKKNI. Keduanya sah dan diakui secara nasional — banyak perusahaan atau dokumen tender mensyaratkan salah satu secara spesifik, jadi sebaiknya dicek dulu sebelum memilih jalur sertifikasi.'],
        ['q' => 'Berapa lama masa berlaku SKP dan sertifikat K3?', 'a' => 'SKP (Surat Keputusan Penunjukan) dan sertifikat kompetensi K3 dari Kemnaker umumnya berlaku 3 tahun sejak tanggal diterbitkan, dan dapat diperpanjang sebelum masa berlaku habis. Sertifikat BNSP mengikuti masa berlaku skema sertifikasi terkait, pada umumnya juga 3 tahun. Kami membantu proses perpanjangan — hubungi tim kami untuk detail dokumen yang diperlukan.'],
        ['q' => 'Bagaimana cara mengecek keaslian sertifikat K3 secara online?', 'a' => 'Sertifikat Kemnaker dapat dicek melalui sistem informasi resmi Kementerian Ketenagakerjaan, sedangkan sertifikat BNSP diverifikasi melalui portal resmi LSP penerbit. Wahana Totalita juga menyediakan halaman verifikasi sertifikat di /verifikasi/ khusus untuk alumni pelatihan kami.'],
        ['q' => 'Bagaimana proses pendaftaran pelatihan ini?', 'a' => 'Pendaftaran dilakukan via WhatsApp — tim kami mengirimkan info jadwal terdekat, syarat peserta, dan rincian biaya. Setelah konfirmasi, peserta mengisi formulir pendaftaran dan melakukan pembayaran sesuai instruksi yang diberikan.'],
        ['q' => 'Apakah sertifikat ini berlaku untuk tender pemerintah dan proyek BUMN?', 'a' => 'Ya. Sertifikat Kemnaker maupun BNSP yang diterbitkan lembaga terakreditasi berlaku secara nasional dan lazim digunakan sebagai syarat teknis dalam tender pemerintah maupun proyek BUMN/swasta di seluruh Indonesia.'],
    ],
    'clusters' => [
        'confined' => [
            'keywords' => ['confined', 'ruang-terbatas', 'tkbt', 'tkpk'],
            'faqs' => [
                ['q' => 'Apa sumber bahaya spesifik saat bekerja di ruang terbatas (confined space)?', 'a' => 'Bahaya utama di ruang terbatas meliputi: kekurangan atau kelebihan kadar oksigen, keberadaan gas beracun, gas atau uap mudah terbakar dengan konsentrasi di bawah/di atas nilai ambang batas, serta risiko engulfment (tertimbun material curah). Pekerja dan pengawas yang kompeten wajib mengukur kadar gas sebelum dan selama bekerja di ruang terbatas.'],
                ['q' => 'Berapa kadar oksigen yang aman untuk bekerja di ruang terbatas?', 'a' => 'Kadar oksigen normal di udara sekitar 20,9%. Kondisi umumnya dianggap aman untuk memasuki ruang terbatas pada rentang 19,5%–23,5%. Di bawah 19,5% berisiko kekurangan oksigen (oxygen deficient), di atas 23,5% berisiko oxygen enriched yang meningkatkan risiko kebakaran — keduanya wajib diuji Authorized Gas Tester (AGT) sebelum ruang terbatas dimasuki.'],
                ['q' => 'Apa itu Authorized Gas Tester (AGT) dan Performing Authority?', 'a' => 'Authorized Gas Tester (AGT) adalah petugas bersertifikat yang berwenang menguji kadar gas/oksigen sebelum dan selama pekerjaan di ruang terbatas. Performing Authority adalah penanggung jawab yang mengesahkan izin kerja (permit to work) dan memastikan seluruh prosedur keselamatan confined space dipatuhi sebelum pekerjaan dimulai.'],
                ['q' => 'Apa itu TKBT dan TKPK dalam pelatihan K3?', 'a' => 'TKBT (Tenaga Kerja Bekerja di Ruang Terbatas) adalah sertifikasi untuk pekerja yang bekerja di dalam ruang terbatas, terbagi menjadi TKBT 1 (madya) dan TKBT 2 (utama/pengawas). TKPK (Tenaga Kerja Penyelamat) adalah sertifikasi untuk tim penyelamat darurat ruang terbatas. Keduanya mengacu pada regulasi K3 ruang terbatas dari Kemnaker.'],
            ]
        ],
        'ptp' => [
            'keywords' => ['ptp', 'pesawat-tenaga'],
            'faqs' => [
                ['q' => 'Apa itu PTP dalam K3?', 'a' => 'PTP adalah singkatan dari Pesawat Tenaga dan Produksi — kategori peralatan K3 yang mencakup mesin penggerak, mesin perkakas, dan mesin produksi. Operator PTP wajib memiliki lisensi K3 (SIO/SIA) sesuai jenis pesawat yang dioperasikan, sebagaimana diatur dalam Permenaker No. 38 Tahun 2016.'],
                ['q' => 'Siapa yang wajib memiliki sertifikasi Operator PTP?', 'a' => 'Setiap tenaga kerja yang mengoperasikan pesawat tenaga dan produksi (mesin produksi, mesin perkakas, penggerak mula) di lingkungan kerja wajib memiliki lisensi K3 Operator PTP, diterbitkan setelah mengikuti pelatihan dan lulus uji kompetensi dari Kemnaker.'],
            ]
        ],
        'smk3' => [
            'keywords' => ['smk3', 'auditor'],
            'faqs' => [
                ['q' => 'Berapa kali audit SMK3 eksternal wajib dilakukan?', 'a' => 'Berdasarkan PP No. 50 Tahun 2012, audit SMK3 eksternal oleh auditor yang ditunjuk Kemnaker wajib dilakukan sekurang-kurangnya 1 kali dalam 3 tahun. Audit internal disarankan lebih sering (minimal setahun sekali) untuk memantau kesiapan sebelum audit eksternal.'],
                ['q' => 'Apa itu 166 kriteria dalam audit SMK3?', 'a' => '166 kriteria adalah jumlah kriteria penilaian pada tingkat audit SMK3 "lanjutan" (tertinggi) dalam 12 elemen sesuai PP 50/2012 Lampiran II. Ada juga tingkat awal (64 kriteria) dan tingkat transisi (122 kriteria) untuk perusahaan pada tahap kematangan SMK3 yang berbeda.'],
            ]
        ],
        'ak3u' => [
            'keywords' => ['ahli-k3-umum', 'ak3u'],
            'faqs' => [
                ['q' => 'Apa perbedaan Ahli K3 Umum BNSP dan Kemnaker?', 'a' => 'Ahli K3 Umum Kemnaker menghasilkan Sertifikat Kompetensi + SKP dari Kemnaker, yang menjadi syarat legal untuk menunjuk seseorang sebagai Ahli K3 Umum di perusahaan sesuai UU No. 1 Tahun 1970. Ahli K3 Umum BNSP menghasilkan sertifikat kompetensi berbasis skema SKKNI dari LSP berlisensi BNSP. Banyak perusahaan/tender secara spesifik mensyaratkan SKP Kemnaker, jadi penting mengecek persyaratan sebelum memilih jalur sertifikasi.'],
                ['q' => 'Berapa lama pelatihan Ahli K3 Umum berlangsung?', 'a' => 'Pelatihan Ahli K3 Umum umumnya berlangsung 12 hari kerja (setara 120 jam pelajaran) sesuai ketentuan Kemnaker, mencakup teori K3 dasar, peraturan perundangan, praktik lapangan, dan ujian akhir untuk memperoleh Sertifikat Kompetensi dan SKP.'],
            ]
        ],
        'forklift' => [
            'keywords' => ['forklift'],
            'faqs' => [
                ['q' => 'Apa saja syarat menjadi operator forklift bersertifikat?', 'a' => 'Syarat operator forklift: usia minimal 18 tahun, pendidikan minimal SMP/sederajat, sehat jasmani dan rohani, mengikuti pelatihan K3 Operator Forklift yang diakui Kemnaker RI, dan lulus uji kompetensi untuk mendapatkan SIO (Surat Ijin Operator) dari Dinas Ketenagakerjaan.'],
                ['q' => 'Berapa lama pelatihan operator forklift?', 'a' => 'Pelatihan operator forklift umumnya berlangsung 3–5 hari kerja, mencakup teori K3 pengoperasian forklift, praktik lapangan, dan ujian kompetensi. Peserta yang lulus mendapatkan Sertifikat Kemnaker RI dan SIO yang berlaku 5 tahun.'],
                ['q' => 'Apa bedanya SIO forklift dan sertifikat Kemnaker?', 'a' => 'SIO (Surat Ijin Operator) adalah lisensi resmi yang dikeluarkan Dinas Ketenagakerjaan setempat, wajib dimiliki setiap operator forklift yang beroperasi di Indonesia. Sertifikat Kemnaker RI adalah bukti kelulusan pelatihan K3 dari lembaga yang diakreditasi Kementerian Ketenagakerjaan — keduanya diperlukan untuk bekerja legal sebagai operator forklift.'],
                ['q' => 'Forklift dikelompokkan menjadi berapa kelas operator?', 'a' => 'Operator forklift dikelompokkan menjadi 2 kelas berdasarkan kapasitas angkat: Kelas 1 (kapasitas di atas 15 ton) dan Kelas 2 (kapasitas hingga 15 ton). Jenjang lisensi menentukan jenis dan kapasitas forklift yang boleh dioperasikan operator tersebut.'],
                ['q' => 'Berapa biaya pelatihan operator forklift?', 'a' => 'Hubungi Wahana Totalita untuk informasi biaya terkini — harga menyesuaikan jumlah peserta, lokasi pelatihan (inhouse atau di tempat kami), dan jenis sertifikasi. Konsultasi gratis via WhatsApp.'],
            ]
        ],
        'kebakaran' => [
            'keywords' => ['kebakaran', 'keb.', 'damkar', 'fire'],
            'faqs' => [
                ['q' => 'Apa saja tingkatan sertifikasi K3 Penanggulangan Kebakaran Kemnaker RI?', 'a' => 'Sesuai Kepmenaker No. KEP.186/MEN/1999, sertifikasi kebakaran terbagi dalam 4 tingkat: Petugas Peran Kebakaran (Kelas D), Regu Penanggulangan Kebakaran (Kelas C), Koordinator Unit Penanggulangan Kebakaran (Kelas B), dan Ahli K3 Spesialis Penanggulangan Kebakaran (Kelas A) sebagai penanggung jawab teknis keselamatan kebakaran tertinggi.'],
                ['q' => 'Berapa jumlah personil K3 Kebakaran yang wajib disediakan di perusahaan?', 'a' => 'Sesuai Kepmenaker 186/1999, perusahaan wajib memiliki sekurang-kurangnya 2 orang Petugas Peran Kebakaran Kelas D untuk setiap 20 orang tenaga kerja, serta Regu Kelas C dan Koordinator Kelas B disesuaikan dengan tingkat klasifikasi bahaya kebakaran tempat kerja.'],
            ]
        ],
        'lingkungan' => [
            'keywords' => ['pppa', 'popal', 'pppu', 'poippu', 'limbah', 'amdal', 'lingkungan'],
            'faqs' => [
                ['q' => 'Siapa yang wajib memiliki sertifikasi kompetensi pengendalian pencemaran (PPPA / POPAL / PPPU)?', 'a' => 'Sesuai Permen LHK No. P.05/2018 dan P.06/2018, setiap industri penghasil air limbah dan emisi gas buang wajib mempekerjakan personil yang tersertifikasi kompetensi BNSP di bidang pengelolaan lingkungan hidup, seperti POPAL (Penanggung Jawab Operasional Pengolahan Air Limbah) dan PPPA (Penanggung Jawab Pengendalian Pencemaran Air).'],
                ['q' => 'Apa perbedaan antara sertifikasi POPAL dan PPPA?', 'a' => 'POPAL berfokus pada tataran teknis operasional harian Instalasi Pengolahan Air Limbah (IPAL), troubleshooting, dan perawatan unit. Sedangkan PPPA bertanggung jawab pada level manajerial pengendalian pencemaran air secara menyeluruh, pemantauan baku mutu, evaluasi kinerja IPAL, dan pelaporan berkala ke dinas lingkungan hidup.'],
            ]
        ],
        'mining' => [
            'keywords' => ['pop', 'pom', 'pou', 'tambang', 'mining'],
            'faqs' => [
                ['q' => 'Apa syarat mengikuti uji kompetensi POP (Pengawas Operasional Pertama) Pertambangan?', 'a' => 'Syarat sertifikasi POP BNSP mengacu pada Kepmen ESDM No. 1827 K/30/MEM/2018: minimal pendidikan D3/S1 pengalaman kerja minimal 1 tahun di pertambangan minerba, atau pendidikan SMA/SMK dengan pengalaman minimal 10 tahun di industri pertambangan, dibuktikan dengan surat keterangan kerja dari KTT (Kepala Teknik Tambang).'],
                ['q' => 'Apa perbedaan tingkatan POP, POM, dan POU di pertambangan?', 'a' => 'POP (Pengawas Operasional Pertama) ditujukan untuk level foreman/frontline supervisor yang mengawasi operasional harian. POM (Pengawas Operasional Madya) untuk level superintendent/middle management. POU (Pengawas Operasional Utama) untuk pimpinan tertinggi operasional tambang/KTT.'],
            ]
        ],
        'alat_berat' => [
            'keywords' => ['excavator', 'crane', 'rigger', 'loader', 'alat-berat', 'grader', 'compactor'],
            'faqs' => [
                ['q' => 'Berapa lama masa berlaku Lisensi K3 (SIO) Operator Alat Berat?', 'a' => 'Berdasarkan Permenaker No. 8 Tahun 2020 tentang Keselamatan dan Kesehatan Kerja Pesawat Angkat dan Pesawat Angkut, Lisensi K3 / SIO (Surat Ijin Operator) berlaku selama 5 tahun sejak tanggal diterbitkan dan dapat diperpanjang kembali.'],
                ['q' => 'Apa saja syarat penerbitan Lisensi K3 (SIO) Alat Berat Kemnaker RI?', 'a' => 'Persyaratan utama: usia minimal 18 tahun, pendidikan formal minimal SMP/SMA sederajat (tergantung kelas alat), surat keterangan sehat jasmani, pas foto background merah, serta dinyatakan lulus evaluasi teori dan praktik oleh Kemnaker RI.'],
            ]
        ],
        'listrik' => [
            'keywords' => ['listrik', 'electrical'],
            'faqs' => [
                ['q' => 'Kapan perusahaan wajib memiliki Teknisi K3 Listrik dan Ahli K3 Listrik?', 'a' => 'Berdasarkan Permenaker No. 12 Tahun 2015, tempat kerja dengan pembangkitan, transmisi, distribusi, atau pemanfaatan listrik dengan kapasitas lebih dari 200 kVA wajib memiliki Teknisi K3 Listrik dan/atau Ahli K3 Listrik yang ditunjuk oleh Menteri Ketenagakerjaan.'],
            ]
        ],
        'p3k' => [
            'keywords' => ['p3k', 'first aid'],
            'faqs' => [
                ['q' => 'Berapa rasio petugas P3K yang wajib disediakan di tempat kerja?', 'a' => 'Sesuai Permenaker No. 15 Tahun 2008, untuk tempat kerja dengan potensi bahaya rendah rasio petugas P3K adalah 1 orang per 150 pekerja. Untuk tempat kerja dengan potensi bahaya tinggi (konstruksi, pertambangan, pabrik kimia), rasio wajib adalah minimal 1 orang petugas P3K per 100 pekerja.'],
            ]
        ],
    ]
];
