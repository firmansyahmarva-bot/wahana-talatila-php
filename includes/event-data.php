<?php
/**
 * includes/event-data.php
 * Master dataset and helper functions for Corporate Meetings, Government MICE & HSE Statutory Event Organizer Hub.
 * Tailored for Enterprise B2B (BUMN, Multinational, Industrial Mining/O&G) and B2G (Kementerian, Lembaga, Pemda - SPSE/INAPROC LKPP).
 * Execution Coverage: Nationwide Indonesia (Jabodetabek, Solo, Yogyakarta, Surabaya, Balikpapan/IKN, Cilegon, Morowali, Batam).
 */

function get_all_event_items(array $filter = []): array {
    static $items = null;
    if ($items === null) {
        $items = [
            'bulan-k3-nasional' => [
                "slug" => "bulan-k3-nasional",
                "judul" => "Peringatan Bulan K3 Nasional (12 Jan – 12 Feb) & HSE Campaign Perusahaan",
                "kategori" => "hse-safety",
                "kategori_label" => "HSE & Statutory Safety",
                "tagline" => "Penyelenggaraan terpadu Bulan K3 Nasional: Apel K3, seminar keselamatan kerja, safety competition, pameran K3, dan malam apresiasi pekerja.",
                "meta_title" => "EO Bulan K3 Nasional Perusahaan & BUMN — Paket Acara 12 Jan - 12 Feb",
                "meta_desc" => "Jasa EO peringatan Bulan K3 Nasional untuk BUMN, pabrik & korporasi. Apel bendera K3, lomba pemadaman api, safety expo, seminar ahli & malam penganugerahan.",
                "keywords" => [
                    "eo bulan k3 nasional",
                    "paket peringatan bulan k3 bumn",
                    "event organizer safety day perusahaan",
                    "lomba k3 fire and rescue relay",
                    "vendor acara bulan k3 pabrik",
                    "pembina upacara apel bulan k3 kemnaker",
                ],
                "target_klien" => "Direksi, HSE Manager, General Manager Pabrik, dan Panitia Pembina K3 (P2K3) BUMN, Manufaktur, Migas, Tambang, dan Konstruksi.",
                "durasi_event" => "1 Hari Acara Puncak (Kick-Off / Closing) atau Rangkaian 1 Bulan Penuh",
                "lokasi_layanan" => "Seluruh Indonesia (Jakarta, Cilegon, Surabaya, Karawang, Balikpapan, Solo, Jogja, Makassar)",
                "biaya_standar" => "Rp 45.000.000 / paket acara kick-off",
                "biaya_batch" => "Rp 95.000.000 / paket rangkaian lengkap 1 bulan",
                "b2b_min_peserta" => "Disesuaikan mulai 50 hingga 2.500 karyawan pabrik/site",
                "inaproc_relevance" => "Penyelenggaraan sesuai Kepmenaker tentang Petunjuk Pelaksanaan Bulan K3 Nasional & terdaftar resmi di SPSE INAPROC.",
                "city_mentions" => [
                    "Jakarta",
                    "Cilegon",
                    "Karawang",
                    "Surabaya",
                    "Balikpapan",
                    "Solo",
                    "Yogyakarta",
                ],
                "companies_mentions" => [
                    "PT Pertamina (Persero)",
                    "PT PLN (Persero)",
                    "PT Krakatau Steel",
                    "PT Semen Indonesia",
                    "PT Pupuk Kaltim",
                ],
                "highlight_pillars" => [
                    "Upacara Apel Pembukaan & Penutupan Bulan K3 Resmi Standar Kemnaker RI",
                    "Safety Games & Competitions: Fire & Rescue Relay, First Aid Scavenger, Cerdas Cermat K3",
                    "Seminar & Talkshow Akbar Bersama Pengawas K3 Kemnaker & Praktisi Industri",
                    "Pameran Alat Pelindung Diri (APD Expo) & Malam Anugerah K3 Pekerja Teladan",
                ],
                "deskripsi_lengkap" => "Peringatan Bulan Keselamatan dan Kesehatan Kerja (K3) Nasional yang berlangsung setiap tanggal 12 Januari hingga 12 Februari merupakan agenda wajib tahunan bagi seluruh perusahaan di Indonesia berdasarkan Keputusan Menteri Ketenagakerjaan RI. Bagi korporasi berskala besar, BUMN energi, industri manufaktur berat, serta kontraktor pertambangan di kawasan industri seperti Cilegon, Karawang, Balikpapan, dan Gresik, Bulan K3 Nasional bukan sekadar seremoni formalitas. Momentum ini adalah katalis utama untuk memperkuat safety culture, menyegarkan kesadaran bahaya kerja, serta mendemonstrasikan komitmen zero accident kepada regulator dan pemangku kepentingan.\n\nNamun, mengorganisir rangkaian kegiatan selama satu bulan penuh yang melibatkan ratusan hingga ribuan pekerja operasional, manajemen puncak, hingga kontraktor pendukung sering kali membebani divisi HSE internal. Dibutuhkan Event Organizer yang tidak hanya menguasai tata panggung pameran dan sound system, tetapi paham secara substansial regulasi K3, standar inspeksi keselamatan kerja, dan protokol protokoler apel resmi bendera K3.\n\nWahana Totalita Konsultan hadir sebagai mitra strategis penyelenggara Bulan K3 Nasional terpadu di seluruh Indonesia. Berbekal lisensi PJK3 resmi Kemnaker RI dan rekam jejak pemenang pengadaan pemerintah di SPSE INAPROC, kami menangani seluruh spektrum acara secara terstruktur: mulai dari penyiapan lapangan apel upacara, naskah ikrar K3, perlengkapan simulasi lomba pemadaman api (Fire Drill Relay), tata kelola expo stan K3, hingga malam puncak awarding night.",
                "spesifikasi_teknis" => [
                    [
                        "item" => "Panggung Utama & Backdrop",
                        "spek" => "Panggung Modular Rigging / Indoor Hall, Backdrop Printing High-Res & LED Videotron P3",
                    ],
                    [
                        "item" => "Sound System & Sirine Apel",
                        "spek" => "Line Array Sound System 5.000 - 15.000 Watt, Sirine Kick-Off K3, Mic Wireless Shure",
                    ],
                    [
                        "item" => "Arena Lomba & Alat Praktik",
                        "spek" => "Drum Simulasi Api, APAR Powder & CO2, Pipa Rintangan, Tandu Lipat P3K, Manikin CPR",
                    ],
                    [
                        "item" => "Dokumentasi & Broadcast",
                        "spek" => "Multikamera Video Full HD, Drone Aerial 4K, Live Streaming YouTube/Zoom untuk multi-site",
                    ],
                ],
                "susunan_acara" => [
                    [
                        "fase" => "07.00 - 08.30",
                        "agenda" => "Upacara Apel Resmi Bulan K3 Nasional: Pengibaran Bendera Merah Putih & Bendera K3, Pembacaan Ikrar K3, Amanat Pembina Apel",
                    ],
                    [
                        "fase" => "08.30 - 09.00",
                        "agenda" => "Seremoni Kick-Off: Penekanan Tombol Sirine / Pemukulan Gong, Safety Walk Direksi, Pelepasan Burung/Balon Simbolis",
                    ],
                    [
                        "fase" => "09.00 - 12.00",
                        "agenda" => "Safety Competition: Lomba Ketangkasan Pemadaman Api Menggunakan Karung Basah & APAR Beregu Karyawan",
                    ],
                    [
                        "fase" => "13.00 - 15.30",
                        "agenda" => "Seminar K3 Nasional: Pembahasan Isu Strategis Regulasi K3 Terbaru bersama Pengawas Ketenagakerjaan",
                    ],
                    [
                        "fase" => "15.30 - 16.30",
                        "agenda" => "Pengumuman Pemenang Lomba, Penyerahan Sertifikat Karyawan Berprestasi K3, Penutupan Acara",
                    ],
                ],
                "deliverables_output" => [
                    "Laporan Pelaksanaan Kegiatan Bulan K3 Berjilid Lengkap untuk Arsip Audit Disnaker & SMK3",
                    "Video Sinematik Dokumenter Rangkaian Kegiatan Resolusi 4K untuk Publikasi Corcomm / Humas",
                    "Piala, Medali & Sertifikat Juara Lomba K3 Bertanda Tangan P2K3 & Manajemen",
                    "Dokumen Pengadaan Resmi: SPK, BAST, Kuitansi Bermeterai, dan Faktur Pajak PPh 23 / PPN",
                ],
                "faqs" => [
                    [
                        "q" => "Apakah Wahana Totalita bisa membantu mengurus perizinan upacara dan koordinasi dengan Disnaker setempat?",
                        "a" => "Ya, kami membantu menyusun surat pemberitahuan kegiatan Bulan K3 ke Disnaker provinsi/kabupaten setempat serta menyiapkan naskah resmi sambutan Menteri Ketenagakerjaan untuk dibacakan pembina upacara.",
                    ],
                    [
                        "q" => "Apakah lomba safety bisa disesuaikan dengan jenis bahaya spesifik di pabrik kami?",
                        "a" => "Sangat bisa. Kami merancang customized safety games seperti lomba confined space rescue untuk pabrik semen, lomba cerdas cermat penanganan tumpahan kimia untuk pabrik petrokimia, atau lomba first aid triage untuk pertambangan.",
                    ],
                    [
                        "q" => "Berapa lama waktu persiapan ideal untuk menyelenggarakan peringatan Bulan K3?",
                        "a" => "Idealnya persiapan dimulai 3 hingga 4 minggu sebelum tanggal 12 Januari agar penyusunan materi promosi internal, pendaftaran peserta lomba, dan logistik panggung dapat dimatangkan optimal.",
                    ],
                ],
            ],
            'safety-day-hse-awards' => [
                "slug" => "safety-day-hse-awards",
                "judul" => "Corporate Safety Day & Annual HSE Awards Night Perusahaan",
                "kategori" => "hse-safety",
                "kategori_label" => "HSE & Statutory Safety",
                "tagline" => "Malam penganugerahan keselamatan kerja: apresiasi jam kerja selamat tanpa kecelakaan (Zero Accident), stan pameran K3, dan malam keakraban keluarga.",
                "meta_title" => "EO Safety Day & HSE Awards Perusahaan — Anugerah Zero Accident BUMN",
                "meta_desc" => "Penyelenggara corporate safety day & annual HSE awards night di seluruh Indonesia. Panggung penganugerahan jam kerja selamat tanpa LTI, trofi kristal, gala dinner & live music.",
                "keywords" => [
                    "event organizer safety day perusahaan",
                    "penyelenggara safety awards zero accident",
                    "annual hse awards night bumn",
                    "anugerah jam kerja selamat lti",
                    "malam penganugerahan keselamatan kerja",
                    "eo safety campaign korporasi",
                ],
                "target_klien" => "Divisi HSE, Corporate Secretary, dan Panitia Keselamatan Perusahaan Multinasional, BUMN, Kontraktor EPC, dan Manufaktur Skala Besar.",
                "durasi_event" => "1 Hari Penuh (Siang: Safety Exhibition, Malam: Gala Dinner & Awarding Night)",
                "lokasi_layanan" => "Seluruh Indonesia (Hotel Ballroom Bintang 4-5 di Jakarta, Surabaya, Solo, Jogja, Balikpapan, Batam)",
                "biaya_standar" => "Rp 55.000.000 / paket mini ballroom (100 pax)",
                "biaya_batch" => "Rp 135.000.000 / paket grand ballroom (300 - 500 pax)",
                "b2b_min_peserta" => "100 peserta karyawan & manajemen",
                "inaproc_relevance" => "Sesuai standar verifikasi penghargaan keselamatan kerja Kemnaker RI & kualifikasi pengadaan resmi SPSE.",
                "city_mentions" => [
                    "Jakarta",
                    "Surabaya",
                    "Solo",
                    "Yogyakarta",
                    "Balikpapan",
                    "Medan",
                    "Batam",
                ],
                "companies_mentions" => [
                    "PT Telkom Indonesia",
                    "PT Vale Indonesia",
                    "PT Pertamina EP",
                    "PT Freeport Indonesia",
                    "PT Bukit Asam Tbk",
                ],
                "highlight_pillars" => [
                    "Panggung Megah Awarding Night dengan Tata Lampu Moving Beam & LED Screen P3",
                    "Pemberian Tropi Kristal Eksklusif & Sertifikat Zero Accident Milestone Jam Kerja Selamat",
                    "Safety Exhibition Zone: Pameran Inovasi Alat K3 Karyawan (Kaizen / QCC K3)",
                    "Gala Dinner Eksklusif, MC Profesional Bilingual, dan Live Acoustic / Band Entertainment",
                ],
                "deskripsi_lengkap" => "Mencapai jutaan jam kerja selamat tanpa kecelakaan kerja berat (Lost Time Injury - LTI) merupakan prestasi monumental yang diraih berkat kedisiplinan ribuan personel di lapangan. Banyak korporasi multinasional dan BUMN energi menyelenggarakan Corporate Safety Day dan Annual HSE Awards sebagai ritual tahunan untuk memberikan penghargaan setinggi-tingginya kepada departemen, kontraktor, dan individu yang menunjukkan teladan keselamatan kerja tanpa kompromi.\n\nCorporate Safety Day bukan sekadar pesta perayaan; acara ini adalah instrumen psikologis yang sangat ampuh untuk memperkuat kepemilikan nilai-nilai keselamatan (safety ownership). Saat pekerja garis depan dipanggil naik ke atas panggung berkarpet merah, menerima piala kristal di hadapan dewan direksi, dan disaksikan oleh rekan sejawatnya, standar kepatuhan K3 di seluruh lini operasi akan melonjak drastis.\n\nWahana Totalita merancang Safety Day & HSE Awards dengan sentuhan produksi berstandar internasional. Kami memadukan zona pameran edukatif (Safety Exhibition & Health Booth) pada siang hari dengan kemegahan Gala Dinner Awarding Night pada malam hari. Setiap detail piala penghargaan, video nominasi profil divisi zero accident, animasi grafis hitung mundur jam kerja selamat, hingga naskah MC disusun dengan presisi agar menggetarkan emosi dan membakar semangat keselamatan kerja tim Anda.",
                "spesifikasi_teknis" => [
                    [
                        "item" => "Ballroom & Staging",
                        "spek" => "Grand Ballroom Hotel Bintang 4/5, Panggung Custom Lebar 12-16 Meter, Karpet Merah VIP",
                    ],
                    [
                        "item" => "Visual Display",
                        "spek" => "LED Screen P3 Indoor High-Refresh Rate (Dimensi 8x4 meter atau 10x3 meter Curved)",
                    ],
                    [
                        "item" => "Lighting & Ambience",
                        "spek" => "Moving Head Beam 230/380W, Par LED 54x3W, Follow Spot, Smoke Machine Haze",
                    ],
                    [
                        "item" => "Tropi & Plakat",
                        "spek" => "Trofi Logam/Kristal Grafir Laser 3D Custom Logo Perusahaan, Sertifikat Bingkai Emas",
                    ],
                ],
                "susunan_acara" => [
                    [
                        "fase" => "15.00 - 18.00",
                        "agenda" => "Registrasi Tamu, Red Carpet Photo Booth 360, Kunjungan Pameran Inovasi K3 & Mini MCU",
                    ],
                    [
                        "fase" => "18.30 - 19.15",
                        "agenda" => "Opening Video Countdown Milestones Jam Kerja Selamat, Tarian Pembuka Modern, Sambutan Direktur Utama",
                    ],
                    [
                        "fase" => "19.15 - 20.00",
                        "agenda" => "Gala Dinner Spesial Prasmanan Bintang 5, Iringan Live Acoustic Band",
                    ],
                    [
                        "fase" => "20.00 - 21.30",
                        "agenda" => "Sesi Penganugerahan HSE Awards: Kategori Departemen Zero Accident, Best Safety Officer, Inovasi K3 Terbaik",
                    ],
                    [
                        "fase" => "21.30 - 22.00",
                        "agenda" => "Doorprize Utama, Foto Bersama Dewan Direksi & Pemenang, Lagu Penutup Kebersamaan",
                    ],
                ],
                "deliverables_output" => [
                    "Paket Trofi Kristal & Piagam Penghargaan Resmi Zero Accident bertanda tangan Direksi",
                    "Video Profil Nominasi & Video Sinematik Acara Format 4K UHD",
                    "Dokumentasi Foto Resolusi Tinggi dengan Akses Link Google Drive Instan untuk Tamu",
                    "Laporan Pertanggungjawaban Acara Lengkap dengan Faktur Pajak PPh 23 dan PPN",
                ],
                "faqs" => [
                    [
                        "q" => "Bisakah Wahana Totalita membantu membuatkan kategori nominasi dan kriteria penilaian safety award?",
                        "a" => "Ya, konsultan K3 kami menyediakan matriks kriteria penilaian objektif meliputi: rasio jam kerja selamat tanpa LTI, tingkat partisipasi safety observation/hazard report, kepatuhan APD, dan inovasi keselamatan.",
                    ],
                    [
                        "q" => "Apakah acara ini bisa digabungkan dengan family day atau mendatangkan keluarga karyawan?",
                        "a" => "Sangat bisa. Kami memiliki konsep Family Safety Day di mana pasangan dan anak-anak diajak memahami peran penting keselamatan kerja orang tua mereka melalui permainan interaktif ramah anak.",
                    ],
                    [
                        "q" => "Di kota mana saja Wahana Totalita dapat menyelenggarakan Safety Day?",
                        "a" => "Kami melayani penyelenggaraan di seluruh kota besar dan kawasan industri Indonesia: Jabodetabek, Surabaya, Cilegon, Balikpapan, Solo, Jogja, Medan, hingga site terpencil di Kalimantan dan Sulawesi.",
                    ],
                ],
            ],
            'emergency-drill-simulasi-kebakaran' => [
                "slug" => "emergency-drill-simulasi-kebakaran",
                "judul" => "Fire Drill & Simulasi Tanggap Darurat Kebakaran Gedung/Pabrik",
                "kategori" => "hse-safety",
                "kategori_label" => "HSE & Statutory Safety",
                "tagline" => "Latihan tanggap darurat kebakaran berskala penuh: koordinasi Damkar, aktivasi alarm & evakuasi gedung, penanggulangan korban, dan video audit SMK3.",
                "meta_title" => "EO Fire Drill & Simulasi Kebakaran Gedung Pabrik — Latihan Darurat K3",
                "meta_desc" => "Jasa EO simulasi tanggap darurat kebakaran (fire drill) gedung bertingkat & pabrik industri. Koordinasi dinas pemadam kebakaran, rute evakuasi, tim P3K & video audit SMK3.",
                "keywords" => [
                    "eo fire drill gedung dan pabrik",
                    "jasa simulasi kebakaran perusahaan",
                    "simulasi evakuasi darurat k3 tahunan",
                    "latihan pemadaman api gedung bertingkat",
                    "skenario emergency drill pabrik",
                    "video simulasi tanggap darurat audit smk3",
                ],
                "target_klien" => "Building Manager Gedung Bertingkat, HSE Manager Kawasan Industri, Pabrik Manufaktur, Rumah Sakit, Hotel, dan Kantor BUMN.",
                "durasi_event" => "1 Hari Pelaksanaan (Briefing Skenario, Eksekusi Lapangan, dan Evaluasi Debriefing)",
                "lokasi_layanan" => "Seluruh Wilayah Indonesia (In-House di Site / Gedung Klien)",
                "biaya_standar" => "Rp 25.000.000 / drill gedung perkantoran skala menengah",
                "biaya_batch" => "Rp 55.000.000 / drill pabrik industri terpadu (+ Armada Damkar & Ambulance)",
                "b2b_min_peserta" => "Melibatkan seluruh penghuni gedung (50 - 1.000+ orang)",
                "inaproc_relevance" => "Pemenuhan wajib UU No. 1/1970, Permenaker No. 04/1980, dan elemen audit SMK3 PP 50/2012 kriteria 6.7.",
                "city_mentions" => [
                    "Jakarta",
                    "Surabaya",
                    "Semarang",
                    "Solo",
                    "Yogyakarta",
                    "Cilegon",
                    "Bandung",
                    "Balikpapan",
                ],
                "companies_mentions" => [
                    "Gedung Perkantoran BUMN",
                    "Kementerian",
                    "RSUD / Rumah Sakit Swasta",
                    "Pabrik Manufaktur Otomotif",
                    "Hotel Bintang 4-5",
                ],
                "highlight_pillars" => [
                    "Penyusunan Emergency Response Plan (ERP) & Skenario Kebakaran Realistis",
                    "Perizinan Resmi & Koordinasi Dinas Pemadam Kebakaran (Damkar) serta Kepolisian Setempat",
                    "Efek Asap Teatrikal Aman (Non-Toxic Smoke Generator) & Evakuasi Pasien/Korban Terluka",
                    "Evaluasi Waktu Evakuasi (Evacuation Time Record) & Pembuatan Video Dokumentasi Audit SMK3",
                ],
                "deskripsi_lengkap" => "Kepatuhan terhadap Sistem Manajemen K3 (SMK3 PP 50/2012 Kriteria 6.7) dan standar internasional ISO 45001 mewajibkan setiap pengelola fasilitas kerja menguji keandalan sistem tanggap darurat secara berkala sekurang-kurangnya sekali dalam setahun. Kebakaran di fasilitas manufaktur atau gedung perkantoran bertingkat tinggi bukan sekadar masalah ketersediaan tabung APAR; ancaman sesungguhnya terletak pada kepanikan massal, terhambatnya jalur evakuasi darurat, kegagalan fungsi alarm, dan ketidaksiapan tim regu pemadam kebakaran internal (Fire Warden).\n\nMelaksanakan latihan simulasi kebakaran (Fire Drill) berskala besar membutuhkan perencanaan teknis yang sangat matang agar latihan berjalan mendekati situasi riil tanpa memicu kepanikan warga sekitar atau mengganggu instalasi penting operasional gedung.\n\nWahana Totalita Konsultan menyediakan layanan terpadu penyelenggaraan Fire Drill & Simulasi Evakuasi Darurat K3 di seluruh Indonesia. Tim kami menyusun skenario tanggap darurat yang terukur, mengurus izin resmi dan mendatangkan armada mobil pemadam kebakaran Pemda serta ambulans gawat darurat, menyediakan mesin asap simulasi non-toksik, menugaskan 'korban' simulasi untuk menguji respons tim First Aid, dan mengukur waktu evakuasi aktual hingga seluruh personel berkumpul aman di Assembly Point.\n\nSeluruh proses direkam oleh tim videografer profesional untuk menghasilkan Laporan Evaluasi Tanggap Darurat Resmi dan Video Rekapitulasi Drill yang siap dipresentasikan di hadapan Auditor SMK3, Auditor Asuransi, maupun Pengawas Ketenagakerjaan.",
                "spesifikasi_teknis" => [
                    [
                        "item" => "Perangkat Simulasi",
                        "spek" => "2x High-Output Non-Toxic Smoke Generator (Mesin Asap Aman untuk Koridor), Sirene Darurat Portabel",
                    ],
                    [
                        "item" => "Alat Pemadam & Perlindungan",
                        "spek" => "20x APAR Powder & CO2 untuk praktik karyawan, Drum Pembakaran Terkontrol, Baju Tahan Panas Fireman",
                    ],
                    [
                        "item" => "Perlengkapan Medis & Evakuasi",
                        "spek" => "Tandu Lipat Scoop Stretcher, Neck Collar, Spalk Pembidaian, Make-Up Efek Luka Bakar Simulasi",
                    ],
                    [
                        "item" => "Koordinasi Instansi Luar",
                        "spek" => "Surat Izin Resmi Pemda, Pendampingan 1 Unit Mobil Pompa Damkar & 1 Unit Mobil Ambulans PMI/RS",
                    ],
                ],
                "susunan_acara" => [
                    [
                        "fase" => "08.00 - 09.00",
                        "agenda" => "Table-Top Exercise & Briefing Peran: Fire Warden, Floor Marshal, Tim Evakuasi, Tim Medis P3K",
                    ],
                    [
                        "fase" => "09.30 - 09.35",
                        "agenda" => "Aktivasi Titik Api Simulasi di Lantai/Area Target, Pemicuan Alarm Kebakaran Gedung, Pengumuman Evakuasi",
                    ],
                    [
                        "fase" => "09.35 - 09.50",
                        "agenda" => "Evakuasi Total Gedung melalui Tangga Darurat menuju Titik Kumpul (Assembly Point), Simulasi Pemadaman Awal APAR",
                    ],
                    [
                        "fase" => "09.50 - 10.05",
                        "agenda" => "Kedatangan Armada Damkar (Sirene Aktif), Evakuasi Korban Terjebak Menggunakan Tandu, Penanganan Triase Medis",
                    ],
                    [
                        "fase" => "10.05 - 10.20",
                        "agenda" => "Head Count (Penghitungan Jumlah Karyawan) di Assembly Point oleh masing-masing Floor Marshal",
                    ],
                    [
                        "fase" => "10.30 - 11.30",
                        "agenda" => "Debriefing Bersama Pejabat Damkar, Pengumuman Waktu Respon Evakuasi, Pelatihan Singkat Penggunaan APAR Praktis",
                    ],
                ],
                "deliverables_output" => [
                    "Laporan Resmi Hasil Evaluasi Simulasi Kebakaran & Catatan Waktu Evakuasi untuk Audit SMK3",
                    "Sertifikat Pelatihan Partisipasi Tanggap Darurat Kebakaran untuk Anggota Tim Fire Warden",
                    "Video Dokumentasi Drill Profesional Full HD & 4K Aerial Drone untuk Arsip HSE dan Perusahaan",
                    "Kelengkapan Dokumen Pengadaan B2B/B2G: SPK, BAST, Kuitansi, dan Faktur Pajak PPh 23",
                ],
                "faqs" => [
                    [
                        "q" => "Apakah mesin asap yang digunakan aman bagi penderita asma atau tidak meninggalkan residu di komputer?",
                        "a" => "Asap simulasi yang kami gunakan berbasis water-based glycols food-grade standar teatrikal internasional. Asap ini tidak beracun, tidak berbau tajam, tidak memicu korosi perangkat elektronik, dan cepat menghilang setelah ventilasi dibuka.",
                    ],
                    [
                        "q" => "Berapa target waktu evakuasi yang ideal untuk sebuah gedung bertingkat?",
                        "a" => "Standar keselamatan internasional menetapkan waktu evakuasi gedung bertingkat yang ideal adalah di bawah 3 hingga 5 menit sejak alarm berbunyi hingga lantai dinyatakan steril dan seluruh penghuni tiba di Assembly Point.",
                    ],
                    [
                        "q" => "Apakah simulasi ini dapat dihitung sebagai bukti pemenuhan klausul tanggap darurat audit SMK3 / ISO 45001?",
                        "a" => "Ya, 100% diakui secara sah oleh Auditor Eksternal SMK3 Kemnaker RI maupun Badan Sertifikasi ISO 45001 karena dilengkapi skenario tertulis, absensi, berita acara, dan dokumentasi video.",
                    ],
                ],
            ],
            'simulasi-tanggap-darurat-industri' => [
                "slug" => "simulasi-tanggap-darurat-industri",
                "judul" => "Simulasi Tanggap Darurat Industri (B3 Kimia, Confined Space & Gempa)",
                "kategori" => "hse-safety",
                "kategori_label" => "HSE & Statutory Safety",
                "tagline" => "Skenario tanggap darurat industri bahaya tinggi: tumpahan bahan kimia B3, evakuasi gempa bumi, pertolongan ruang terbatas, dan insiden medis massal.",
                "meta_title" => "Simulasi Tanggap Darurat Industri B3 & Ruang Terbatas — Emergency Response Drill",
                "meta_desc" => "Jasa EO skenario latihan tanggap darurat industri bahaya tinggi di Indonesia: penanganan tumpahan kimia B3, evakuasi ruang terbatas (confined space), gempa & medis.",
                "keywords" => [
                    "jasa simulasi tanggap darurat industri",
                    "emergency response drill b3 kimia",
                    "simulasi evakuasi ruang terbatas k3",
                    "latihan penanganan tumpahan bahan berbahaya",
                    "simulasi gempa bumi pabrik industri",
                    "skenario tanggap darurat petrokimia tambang",
                ],
                "target_klien" => "Industri Kimia, Kilang Minyak/Gas, Pembangkit Listrik (PLTU/PLTG), Smelter Tambang, Industri Semen, dan Farmasi.",
                "durasi_event" => "1 - 2 Hari (Termasuk Workshop Analisis Bahaya & Skenario Lapangan)",
                "lokasi_layanan" => "Seluruh Indonesia (Cilegon, Balikpapan, Gresik, Morowali, Karawang, Cilacap, Batam)",
                "biaya_standar" => "Rp 35.000.000 / skenario darurat spesifik",
                "biaya_batch" => "Rp 75.000.000 / paket simulasi multi-hazard terintegrasi",
                "b2b_min_peserta" => "Tim Emergency Response Team (ERT) & Karyawan Operasional Pabrik",
                "inaproc_relevance" => "Pemenuhan kepatuhan Permenaker No. 187/1999 (B3 Kimia), Kepmen ESDM, dan audit SMK3.",
                "city_mentions" => [
                    "Cilegon",
                    "Balikpapan",
                    "Gresik",
                    "Morowali",
                    "Karawang",
                    "Cilacap",
                    "Batam",
                    "Surabaya",
                ],
                "companies_mentions" => [
                    "Kawasan Industri Cilegon",
                    "Kilang Pertamina",
                    "Smelter Nikel Morowali",
                    "PT Pupuk Indonesia",
                    "PT Chandra Asri",
                ],
                "highlight_pillars" => [
                    "Skenario Tumpahan Bahan Berbahaya & Beracun (B3 Spill Response & Neutralization)",
                    "Penyelamatan Korban di Ruang Terbatas (Confined Space Rescue & Tripod Hoist)",
                    "Protokol Dekontaminasi Mandiri & Penggunaan Baju HAZMAT Level B/C",
                    "Integrasi Incident Command System (ICS) Antar-Unit Operasional Pabrik",
                ],
                "deskripsi_lengkap" => "Fasilitas industri dengan kategori potensi bahaya besar (Major Hazard Installation) seperti pabrik petrokimia, depo migas, smelter pengolahan logam, dan pembangkit listrik menghadapi risiko kecelakaan kerja yang sangat kompleks di luar kebakaran biasa. Skenario kebocoran gas beracun (H2S/Ammonia), tumpahan asam pekat korosif, pingsannya pekerja di dalam tangki ruang terbatas (Confined Space), hingga ancaman gempa bumi tektonik yang merusak struktur pipa memerlukan respons tanggap darurat berkecepatan tinggi dengan prosedur teknis yang tanpa cela.\n\nKesalahan dalam penanganan awal insiden B3 dapat berakibat fatal bagi petugas penolong sendiri akibat paparan zat kimia berbahaya tanpa pelindung yang sesuai.\n\nWahana Totalita merancang Simulasi Tanggap Darurat Industri Bahaya Tinggi yang dipandu langsung oleh Tenaga Ahli K3 Kimia, Dokter Kesehatan Kerja, dan Instruktur Penyelamatan Ruang Terbatas bersertifikat Kemnaker RI. Kami menyusun matriks skenario berbasis Analisis Risiko Instalasi klien, menyediakan alat bantu simulasi cairan netralisir, drum tumpahan berbusa, peralatan vertical rescue & tripod hoist, serta zona dekontaminasi portable.\n\nLatihan ini menguji ketangguhan Incident Command System (ICS) perusahaan: bagaimana komandan tanggap darurat membagi tugas regu penindak (ERT), regu isolasi area, regu medis triage, dan juru bicara komunikasi krisis ke publik dan regulator.",
                "spesifikasi_teknis" => [
                    [
                        "item" => "Peralatan B3 & Spill Kit",
                        "spek" => "Spill Kit Drum 240L, Absorbent Boom/Pillow, Larutan Netralisir Simulasi, Smoke Fogger Pewarna",
                    ],
                    [
                        "item" => "Alat Pelindung Khusus",
                        "spek" => "Pakaian Pelindung Kimia HAZMAT Tychem, SCBA (Self-Contained Breathing Apparatus), Masker Full-Face",
                    ],
                    [
                        "item" => "Penyelamatan Ruang Terbatas",
                        "spek" => "Rescue Tripod Aluminium, Man-Rider Winch, Full Body Harness Fall Arrest, Gas Detector Multi-Sensor",
                    ],
                    [
                        "item" => "Dekontaminasi Darurat",
                        "spek" => "Tenda Dekontaminasi Portabel, Emergency Eye Wash & Shower Simulasi, Kantong Limbah B3",
                    ],
                ],
                "susunan_acara" => [
                    [
                        "fase" => "08.00 - 09.30",
                        "agenda" => "Briefing Keselamatan (Safety Induction) & Simulasi Table-Top Komando Insiden (ICS)",
                    ],
                    [
                        "fase" => "09.30 - 10.00",
                        "agenda" => "Inisiasi Insiden: Skenario Kebocoran Katup Pipa Bahan Kimia & Satu Korban Pingsan di Dalam Bak Reaktor",
                    ],
                    [
                        "fase" => "10.00 - 10.30",
                        "agenda" => "Aktivasi Alarm B3, Evakuasi Karyawan Menentang Arah Angin (Cross-Wind/Up-Wind), Pengisolasian Zona Bahaya",
                    ],
                    [
                        "fase" => "10.30 - 11.15",
                        "agenda" => "Penyelamatan Ruang Terbatas oleh Tim ERT menggunakan Tripod & SCBA, Evakuasi Korban ke Tenda Dekontaminasi",
                    ],
                    [
                        "fase" => "11.15 - 11.45",
                        "agenda" => "Penutupan Kebocoran Kimia (Capping Tool), Pemasangan Absorbent Boom, Pembersihan Limbah Tumpahan B3",
                    ],
                    [
                        "fase" => "13.00 - 15.00",
                        "agenda" => "Debriefing Komprehensif: Evaluasi Waktu Tindak, Analisis Kekurangan Prosedur ERP, Rekomendasi Audit",
                    ],
                ],
                "deliverables_output" => [
                    "Laporan Audit Kesiapsiagaan Tanggap Darurat Industri (Emergency Preparedness Audit Report)",
                    "Matriks Evaluasi Kemampuan Tim ERT & Catatan Waktu Respon Penyelamatan",
                    "Video Dokumentasi Full HD Multikamera untuk Arsip Kepatuhan Regulasi Lingkungan Hidup (KLHK) & Disnaker",
                    "Kelengkapan Dokumen Pengadaan B2B: SPK, BAST, Laporan Kegiatan Berjilid, dan Faktur Pajak Sah",
                ],
                "faqs" => [
                    [
                        "q" => "Apakah cairan simulasi tumpahan kimia yang digunakan aman bagi lantai pabrik dan lingkungan?",
                        "a" => "Ya, kami menggunakan bahan simulasi non-toksik berbasis pewarna ramah lingkungan dan sabun biodegradable yang 100% aman bagi tanah, saluran drainase, dan kesehatan personel.",
                    ],
                    [
                        "q" => "Bisakah skenario disesuaikan dengan jenis bahan kimia spesifik di pabrik kami seperti amonia atau asam sulfat?",
                        "a" => "Sangat bisa. Kami menyesuaikan lembar SDS (Safety Data Sheet) aktual bahan kimia di pabrik Anda, termasuk penentuan jarak zona aman isolasi dan APD yang wajib digunakan tim penindak.",
                    ],
                    [
                        "q" => "Apakah Wahana Totalita menyediakan peralatan SCBA dan Tripod jika perusahaan kami belum memiliki alat lengkap?",
                        "a" => "Ya, kami dapat menyediakan perlengkapan tambahan meliputi SCBA operasional, Gas Detector portabel, dan Rescue Tripod untuk keperluan latihan.",
                    ],
                ],
            ],
            'rapat-berkala-p2k3' => [
                "slug" => "rapat-berkala-p2k3",
                "judul" => "Fasilitasi Rapat Berkala P2K3 & Sidang Komite K3 Perusahaan",
                "kategori" => "hse-safety",
                "kategori_label" => "HSE & Statutory Safety",
                "tagline" => "Penyelenggaraan sidang triwulanan/tahunan Panitia Pembina K3: venue hotel eksekutif, fasilitator Ahli K3 bersertifikat, dan penyusunan notulen resmi Disnaker.",
                "meta_title" => "EO Rapat Berkala P2K3 Perusahaan — Fasilitasi Sidang Komite K3 Disnaker",
                "meta_desc" => "Jasa EO fasilitasi rapat berkala P2K3 triwulanan & tahunan perusahaan di seluruh Indonesia. Venue meeting hotel bintang 4, notulen standar Disnaker & konsultan K3.",
                "keywords" => [
                    "eo rapat p2k3 perusahaan",
                    "fasilitasi rapat panitia pembina k3",
                    "paket rapat p2k3 hotel disnaker",
                    "laporan triwulan p2k3 permenaker",
                    "sidang komite keselamatan kerja perusahaan",
                    "tempat rapat p2k3 eksekutif",
                ],
                "target_klien" => "Ketua P2K3, Sekretaris P2K3 (Ahli K3 Umum), Serikat Pekerja, dan Manajemen Puncak Perusahaan dengan jumlah tenaga kerja >100 orang.",
                "durasi_event" => "1 Hari (Halfday / Fullday Meeting) atau 2 Hari 1 Malam (Residential Retreat)",
                "lokasi_layanan" => "Seluruh Indonesia (Yogyakarta, Solo, Jakarta, Surabaya, Semarang, Balikpapan)",
                "biaya_standar" => "Rp 15.000.000 / paket meeting lokal (20 pax)",
                "biaya_batch" => "Rp 35.000.000 / paket residential hotel *4 (2D1N)",
                "b2b_min_peserta" => "15 - 30 anggota komite P2K3",
                "inaproc_relevance" => "Kewajiban statutori berdasarkan UU No. 1/1970 Pasal 10 & Permenaker No. Per.04/MEN/1987.",
                "city_mentions" => [
                    "Yogyakarta",
                    "Solo",
                    "Jakarta",
                    "Surabaya",
                    "Semarang",
                    "Balikpapan",
                    "Cilegon",
                ],
                "companies_mentions" => [
                    "BUMN Manufaktur",
                    "Perusahaan Jasa Keuangan & Perbankan",
                    "Rumah Sakit",
                    "Pabrik Tekstil & Garment",
                ],
                "highlight_pillars" => [
                    "Venue Ruang Rapat Eksekutif Hotel Bintang 4 yang Kondusif Bebas Distraksi Kerja Harian",
                    "Pendampingan Ahli K3 Umum Senior sebagai Fasilitator Netral Antara Serikat Pekerja & Manajemen",
                    "Penyusunan Format Notulen Rapat P2K3 Terstandar yang Langsung Siap Dikirim ke Disnaker",
                    "Evaluasi Statistik Kecelakaan Kerja (FR & SR) dan Rencana Tindak Lanjut Program K3",
                ],
                "deskripsi_lengkap" => "Pasal 10 Undang-Undang No. 1 Tahun 1970 jo. Permenaker No. Per.04/MEN/1987 mengamanatkan bahwa setiap tempat kerja yang mempekerjakan 100 orang atau lebih, atau kurang dari 100 orang dengan tingkat bahaya tinggi, wajib membentuk Panitia Pembina Keselamatan dan Kesehatan Kerja (P2K3). Salah satu kewajiban hukum utama P2K3 adalah mengadakan sidang atau rapat berkala sekurang-kurangnya satu kali dalam sebulan atau triwulan untuk membahas kondisi keselamatan kerja di tempat kerja.\n\nNamun pada kenyataannya, rapat P2K3 internal sering kali terbentur kendala: ruangan rapat di pabrik yang bising, distraksi panggilan pekerjaan mendadak bagi para anggota komite, hingga perdebatan tanpa arah antara perwakilan pekerja dan manajemen mengenai anggaran perbaikan fasilitas keselamatan.\n\nWahana Totalita menyediakan layanan profesional Fasilitasi Rapat Berkala P2K3 di luar kantor (off-site meeting) di hotel berbintang yang tenang dan representatif. Kami menghadirkan suasana sidang yang profesional dan terstruktur, didampingi oleh Fasilitator K3 Senior independen yang menjembatani dialog secara konstruktif.\n\nTim kami memastikan seluruh temuan inspeksi lapangan dibahas tuntas, angka kecelakaan kerja (Frequency Rate & Severity Rate) dianalisis secara saintifik, dan dokumen Notulen Sidang P2K3 tersusun rapi sesuai format standar pelaporan ke Dinas Tenaga Kerja provinsi.",
                "spesifikasi_teknis" => [
                    [
                        "item" => "Meeting Room",
                        "spek" => "U-Shape Executive Boardroom Hotel Bintang 4/5 dengan Kursi Ergonomis Kulit",
                    ],
                    [
                        "item" => "Presentation Audio Visual",
                        "spek" => "Motorized Projector Screen / TV LED 75 Inch 4K, Wireless Presentation Clicker, Mic Conference Delegate",
                    ],
                    [
                        "item" => "Fasilitasi & Notulensi",
                        "spek" => "Notulis Profesional Berpengalaman K3, Laptop & Printer Warna di Ruangan untuk Cetak Langsung Notulen",
                    ],
                    [
                        "item" => "Konsumsi Meeting",
                        "spek" => "Executive Lunch Buffet & 2x Coffee Break Rendah Gula dengan Pastry Pilihan Chef Hotel",
                    ],
                ],
                "susunan_acara" => [
                    [
                        "fase" => "08.30 - 09.00",
                        "agenda" => "Registrasi Anggota P2K3, Morning Coffee & Pembagian Dokumen Laporan Kinerja K3 Triwulan",
                    ],
                    [
                        "fase" => "09.00 - 09.30",
                        "agenda" => "Pembukaan Sidang oleh Ketua P2K3 (Top Management) & Pengesahan Notulen Rapat Sebelumnya",
                    ],
                    [
                        "fase" => "09.30 - 11.00",
                        "agenda" => "Pemaparan Sekretaris P2K3: Statistik FR/SR, Laporan Investigasi Insiden, Status Perbaikan Bahaya",
                    ],
                    [
                        "fase" => "11.00 - 12.30",
                        "agenda" => "Tanggapan Perwakilan Serikat Pekerja & Diskusi Terarah Dipandu Fasilitator Independen Wahana Totalita",
                    ],
                    [
                        "fase" => "12.30 - 13.30",
                        "agenda" => "Makan Siang Bersama & Networking Santai Manajemen-Pekerja",
                    ],
                    [
                        "fase" => "13.30 - 15.30",
                        "agenda" => "Perumusan Rekomendasi Tindakan K3 untuk Direksi & Penandatanganan Notulen Rapat Bersama",
                    ],
                ],
                "deliverables_output" => [
                    "Buku Notulen Sidang P2K3 Resmi Bertanda Tangan Lengkap Ketua & Sekretaris P2K3",
                    "Draf Surat Laporan Triwulan P2K3 Format Standar Siap Kirim ke Pengawas Ketenagakerjaan Disnaker",
                    "Matriks Action Plan Tindak Lanjut Bahaya dengan Penanggung Jawab & Tenggat Waktu Jelas",
                    "Dokumen Penagihan Resmi: SPK, BAST, Kuitansi Sah, dan Faktur Pajak PPh 23",
                ],
                "faqs" => [
                    [
                        "q" => "Apakah menyelenggarakan rapat P2K3 di luar kantor diperbolehkan oleh Disnaker?",
                        "a" => "Sangat diperbolehkan dan justru dinilai positif oleh Pengawas Ketenagakerjaan karena membuktikan keseriusan manajemen dalam mengalokasikan anggaran khusus demi efektivitas pembinaan K3.",
                    ],
                    [
                        "q" => "Apakah Wahana Totalita dapat membantu menghitungkan angka Frequency Rate (FR) dan Severity Rate (SR)?",
                        "a" => "Ya, konsultan kami membantu mengolah data jam kerja karyawan dan data kecelakaan untuk menghitung angka FR dan SR sesuai standar rumus Kepmenaker.",
                    ],
                    [
                        "q" => "Berapa lama laporan notulen rapat P2K3 harus disimpan oleh perusahaan?",
                        "a" => "Berdasarkan regulasi ketenagakerjaan, seluruh arsip notulen dan bukti laporan triwulan P2K3 wajib disimpan minimal 5 tahun sebagai bukti kepatuhan hukum saat audit ketenagakerjaan.",
                    ],
                ],
            ],
            'tinjauan-manajemen-smk3-iso45001' => [
                "slug" => "tinjauan-manajemen-smk3-iso45001",
                "judul" => "Rapat Tinjauan Manajemen SMK3 PP 50/2012 & ISO 45001 Perusahaan",
                "kategori" => "hse-safety",
                "kategori_label" => "HSE & Statutory Safety",
                "tagline" => "Management Review Retreat: evaluasi pencapaian sasaran K3, audit finding closure, penyelarasan strategi direksi, dan workshop perencanaan K3 tahun depan.",
                "meta_title" => "EO Rapat Tinjauan Manajemen SMK3 & ISO 45001 — Management Review Retreat",
                "meta_desc" => "Penyelenggara rapat tinjauan manajemen (Management Review Meeting) SMK3 PP 50/2012 & ISO 45001 di hotel & resort seluruh Indonesia. Venue eksklusif & auditor pendamping.",
                "keywords" => [
                    "rapat tinjauan manajemen smk3",
                    "management review meeting iso 45001 venue",
                    "workshop tinjauan manajemen pp 50 2012",
                    "eo retreat direksi tinjauan k3",
                    "tempat rapat tinjauan manajemen bumn",
                    "klausul 9.3 tinjauan manajemen iso 45001",
                ],
                "target_klien" => "Board of Directors, General Manager, MR (Management Representative), Tim Auditor Internal SMK3/ISO, dan Kepala Departemen.",
                "durasi_event" => "2 Hari 1 Malam atau 3 Hari 2 Malam (Residential Workshop Retreat)",
                "lokasi_layanan" => "Seluruh Indonesia (Yogyakarta, Bandung, Bali, Solo, Malang/Batu, Bogor)",
                "biaya_standar" => "Rp 2.250.000 / pax (Paket All-In Hotel Bintang 4)",
                "biaya_batch" => "Rp 45.000.000 / paket rombongan (20 pax 2D1N)",
                "b2b_min_peserta" => "15 - 35 orang jajaran eksekutif",
                "inaproc_relevance" => "Pemenuhan wajib Klausul 9.3 ISO 45001:2018 dan Lampiran II PP No. 50 Tahun 2012 Elemen 1.4.",
                "city_mentions" => [
                    "Yogyakarta",
                    "Bandung",
                    "Bali",
                    "Solo",
                    "Malang",
                    "Bogor",
                    "Jakarta",
                    "Surabaya",
                ],
                "companies_mentions" => [
                    "BUMN Konstruksi",
                    "Perusahaan Manufaktur Otomotif",
                    "Mining Contractor",
                    "Industri Makanan & Minuman",
                ],
                "highlight_pillars" => [
                    "Pemenuhan Wajib Seluruh Parameter Input Tinjauan Manajemen (Klausul 9.3 ISO 45001 & PP 50/2012)",
                    "Suasana Resort Bernuansa Alam yang Memicu Pemikiran Strategis Jangka Panjang Direksi",
                    "Didampingi Lead Auditor K3 Eksternal untuk Memastikan Temuan Audit Tertutup Sempurna",
                    "Penyusunan Rencana Kerja & Anggaran Perusahaan (RKAP) Bidang K3 untuk Tahun Mendatang",
                ],
                "deskripsi_lengkap" => "Klausul 9.3 standar sistem manajemen keselamatan ISO 45001:2018 dan Lampiran II PP 50 Tahun 2012 secara tegas mensyaratkan manajemen puncak untuk meninjau sistem manajemen K3 organisasi pada interval waktu yang direncanakan. Tinjauan Manajemen (Management Review) bukan rapat operasional biasa, melainkan forum tertinggi di mana Dewan Direksi dan pimpinan unit kerja mengevaluasi kesesuaian, kecukupan, dan efektivitas berkelanjutan dari kebijakan K3 perusahaan.\n\nBanyak perusahaan gagal memanfaatkan momentum ini karena rapat diadakan terburu-buru di sela-sela jam kantor harian, sehingga hanya menghasilkan formalitas kertas tanpa komitmen anggaran nyata.\n\nWahana Totalita merancang program Management Review Retreat SMK3 & ISO 45001 yang menggabungkan keseriusan evaluasi audit dengan suasana penyegaran pikiran di resort dan hotel berbintang di destinasi strategis seperti Yogyakarta, Solo, Bandung, Batu, dan Bali. Kami menyiapkan format agenda lengkap yang mengacu persis pada 12 input wajib tinjauan manajemen (status tindakan audit terdahulu, perubahan konteks eksternal/internal, pemenuhan regulasi, kinerja K3, kecukupan sumber daya, dan peluang peningkatan berkelanjutan).\n\nDipandu oleh Tenaga Ahli Lead Auditor dari tim kami, jajaran pimpinan tidak hanya menyelesaikan kewajiban audit, tetapi merumuskan peta jalan (Roadmap) K3 korporasi yang terintegrasi dengan Rencana Kerja dan Anggaran Perusahaan (RKAP).",
                "spesifikasi_teknis" => [
                    [
                        "item" => "Venue & Akomodasi",
                        "spek" => "Resort / Hotel Bintang 4-5 dengan Fasilitas Meeting Room Privat dan Kamar Deluxe Single/Twin",
                    ],
                    [
                        "item" => "Perangkat Kerja Rapat",
                        "spek" => "Setup Round Table / Hollow Square, Dual Screen Projector, Sound System Digital, Wireless Mic",
                    ],
                    [
                        "item" => "Fasilitator & Auditor",
                        "spek" => "Lead Auditor IRCA / Auditor SMK3 Senior Kemnaker RI yang memandu sesi review",
                    ],
                    [
                        "item" => "Dokumentasi Lengkap",
                        "spek" => "Penyusunan Laporan Tinjauan Manajemen Cetak Hardcover untuk Bukti Lembaga Sertifikasi",
                    ],
                ],
                "susunan_acara" => [
                    [
                        "fase" => "Hari 1 - 09.00 - 12.00",
                        "agenda" => "Pembukaan oleh Direktur Utama, Review Pencapaian Kinerja K3 & Status Tindak Lanjut Audit Sebelumnya",
                    ],
                    [
                        "fase" => "Hari 1 - 13.00 - 17.00",
                        "agenda" => "Bedah 12 Input Tinjauan Manajemen per Departemen, Analisis Kebutuhan Sumber Daya & Regulasi Baru",
                    ],
                    [
                        "fase" => "Hari 1 - 19.00 - 21.00",
                        "agenda" => "Executive Dinner Santai & Informal Discussion Membangun Sinergi Antar-Direksi",
                    ],
                    [
                        "fase" => "Hari 2 - 08.30 - 12.00",
                        "agenda" => "Perumusan Output Keputusan Tinjauan Manajemen: Perubahan Kebijakan, Alokasi Anggaran, Target Baru",
                    ],
                    [
                        "fase" => "Hari 2 - 13.00 - 15.00",
                        "agenda" => "Penandatanganan Berita Acara Tinjauan Manajemen & Foto Bersama Delegasi",
                    ],
                ],
                "deliverables_output" => [
                    "Buku Laporan Tinjauan Manajemen SMK3 & ISO 45001 Resmi Sesuai Klausul Auditor Eksternal",
                    "Matriks Keputusan Direksi (Management Review Output & Resource Allocation)",
                    "Paket Akomodasi & Konsumsi Fullboard Meeting Tanpa Beban Tagihan Terpisah",
                    "Dokumen Administrasi B2B Lengkap: SPK, BAST, Laporan Kegiatan, dan Faktur Pajak PPh 23",
                ],
                "faqs" => [
                    [
                        "q" => "Apakah format laporan yang dihasilkan dijamin lolos saat audit resertifikasi ISO 45001?",
                        "a" => "Ya, struktur pelaporan kami dirancang persis mengikuti checklist auditor lembaga sertifikasi internasional (seperti BSI, SGS, TUV, Sucofindo, dll.) sehingga dijamin memenuhi persyaratan klausul 9.3.",
                    ],
                    [
                        "q" => "Berapa lama durasi ideal untuk rapat tinjauan manajemen yang efektif?",
                        "a" => "Durasi paling ideal adalah 2 Hari 1 Malam (2D1N) format residential agar seluruh agenda evaluasi dan perumusan target dapat dibahas tuntas tanpa terburu-buru.",
                    ],
                    [
                        "q" => "Bisakah kegiatan ini dikombinasikan dengan sesi outbound santai di hari kedua?",
                        "a" => "Sangat bisa. Kami sering memadukan hari pertama untuk sidang tinjauan manajemen serius dan hari kedua untuk wisata santai atau lava tour Merapi / team building pimpinan.",
                    ],
                ],
            ],
            'safety-stand-down-townhall-kontraktor' => [
                "slug" => "safety-stand-down-townhall-kontraktor",
                "judul" => "Safety Stand-Down & Townhall K3 Kontraktor (CSMS Alignment)",
                "kategori" => "hse-safety",
                "kategori_label" => "HSE & Statutory Safety",
                "tagline" => "Pertemuan akbar penyelarasan keselamatan vendor: sosialisasi Golden Safety Rules, evaluasi audit CSMS, dan pakta integritas K3 di site industri.",
                "meta_title" => "EO Safety Stand-Down & Townhall K3 Kontraktor — Sosialisasi CSMS Vendor",
                "meta_desc" => "Jasa EO penyelenggaraan Safety Stand-Down & Townhall K3 Kontraktor di site tambang, migas & pabrik. Penyelarasan CSMS, sosialisasi Golden Rules & pakta integritas.",
                "keywords" => [
                    "safety stand down kontraktor tambang migas",
                    "townhall k3 kontraktor csms",
                    "sosialisasi golden safety rules vendor",
                    "eo pertemuan kontraktor keselamatan kerja",
                    "vendor k3 alignment meeting",
                    "acara pakta integritas k3 vendor bumn",
                ],
                "target_klien" => "Project Manager EPC, HSE Manager Tambang/Migas, Procurement/Vendor Management, dan Direktur Utama Perusahaan Kontraktor.",
                "durasi_event" => "Halfday (4 Jam) hingga 1 Hari Penuh di Site Pabrik / Hotel Convention Terdekat",
                "lokasi_layanan" => "Seluruh Kawasan Operasi Tambang & Pabrik Indonesia (Balikpapan, Cilegon, Riau, Morowali, Gresik, Sorong)",
                "biaya_standar" => "Rp 35.000.000 / paket townhall lokal (50 vendor)",
                "biaya_batch" => "Rp 75.000.000 / paket skala besar multi-kontraktor (150 - 300 vendor)",
                "b2b_min_peserta" => "50 hingga 300 perwakilan pimpinan kontraktor",
                "inaproc_relevance" => "Kepatuhan implementasi Contractor Safety Management System (CSMS) & regulasi pengadaan barang/jasa.",
                "city_mentions" => [
                    "Balikpapan",
                    "Cilegon",
                    "Pekanbaru",
                    "Morowali",
                    "Gresik",
                    "Sorong",
                    "Jakarta",
                    "Surabaya",
                ],
                "companies_mentions" => [
                    "Pertamina Hulu Rokan",
                    "PT Freeport Indonesia",
                    "PT Vale Indonesia",
                    "Krakatau Posco",
                    "PT Timah Tbk",
                ],
                "highlight_pillars" => [
                    "Penyelenggaraan Sesi Henti Kerja Sejenak (Safety Stand-Down) di Lapangan / Ballroom",
                    "Sosialisasi Ketat Golden Safety Rules & Kebijakan Sanksi Pelanggaran K3 Kontraktor",
                    "Seremoni Penandatanganan Pakta Integritas K3 Serentak di Atas Spanduk Raksasa",
                    "Pemberian Penghargaan Kontraktor Terbaik Kinerja CSMS (Best Safety Contractor Award)",
                ],
                "deskripsi_lengkap" => "Kecelakaan kerja fatal (fatality) di sektor pertambangan, minyak dan gas, serta konstruksi berat sering kali menimpa tenaga kerja pihak ketiga atau kontraktor pendukung. Kesenjangan budaya keselamatan (safety culture gap) antara standar pemilik proyek (owner) dan para subkontraktor di lapangan merupakan faktor risiko tertinggi. Untuk menjembatani jurang ini, perusahaan-perusahaan terkemuka secara periodik menggelar Safety Stand-Down—penghentian sementara aktivitas kerja untuk berkumpul bersama mengevaluasi insiden—dan Contractor Safety Townhall.\n\nPenyelenggaraan acara yang melibatkan puluhan hingga ratusan direktur dan safety manager perusahaan vendor mitra memerlukan tata kelola acara yang tegas, teratur, dan berwibawa.\n\nWahana Totalita menyediakan solusi menyeluruh untuk pelaksanaan Contractor Safety Townhall & CSMS Alignment di seluruh site industri Indonesia. Kami menyiapkan panggung presentasi audiovisual profesional, materi sosialisasi Golden Rules yang komunikatif, prosesi penandatanganan Pakta Integritas K3 di atas backdrop digital atau kanvas komitmen bersama, hingga sesi pemberian penghargaan bagi vendor dengan skor audit CSMS tertinggi.\n\nAcara ini secara terbukti mengubah persepsi kontraktor: dari yang semula menganggap K3 sebagai beban biaya menjadi komitmen bersama demi keselamatan jiwa setiap pekerja di lapangan.",
                "spesifikasi_teknis" => [
                    [
                        "item" => "Panggung & Media Komitmen",
                        "spek" => "Panggung Utama Backdrop LED, Kanvas Komitmen Pakta Integritas Panjang 6 Meter",
                    ],
                    [
                        "item" => "Sistem Audio & Multimedia",
                        "spek" => "Line Array Sound System Outdoor/Indoor, Multi-Screen Display, Headset Mic untuk Presenter",
                    ],
                    [
                        "item" => "Registrasi & ID Badge",
                        "spek" => "Sistem Registrasi QR-Code Cepat untuk Ratusan Perwakilan Vendor, Lanyard Eksklusif",
                    ],
                    [
                        "item" => "Cinderamata & Penghargaan",
                        "spek" => "Plakat Best Contractor K3, Buku Pedoman CSMS Hardcover untuk Setiap Pimpinan Vendor",
                    ],
                ],
                "susunan_acara" => [
                    [
                        "fase" => "08.00 - 08.45",
                        "agenda" => "Registrasi Peserta Vendor, Safety Induction Ruangan, Morning Coffee & Networking",
                    ],
                    [
                        "fase" => "08.45 - 09.15",
                        "agenda" => "Pembukaan oleh General Manager / Vice President, Pemutaran Video Refleksi Insiden K3",
                    ],
                    [
                        "fase" => "09.15 - 10.30",
                        "agenda" => "Pemaparan Evaluasi CSMS: Analisis Pelanggaran Lapangan, Standar Golden Rules, & Kebijakan Stop Work Authority",
                    ],
                    [
                        "fase" => "10.30 - 11.15",
                        "agenda" => "Sesi Tanya Jawab Terbuka antara Pemilik Proyek dan Asosiasi Kontraktor Mitra",
                    ],
                    [
                        "fase" => "11.15 - 11.45",
                        "agenda" => "Penandatanganan Serentak Pakta Integritas K3 Kepatuhan Kontraktor & Foto Bersama Komitmen",
                    ],
                    [
                        "fase" => "11.45 - 12.30",
                        "agenda" => "Penganugerahan Best Safety Contractor Award, Makan Siang Bersama & Penutupan",
                    ],
                ],
                "deliverables_output" => [
                    "Dokumen Pakta Integritas K3 Asli Bertanda Tangan Lengkap Seluruh Direktur Vendor Mitra",
                    "Video Dokumentasi & Siaran Berita Internal untuk Publikasi Media Korporasi / Hubungan Masyarakat",
                    "Laporan Pelaksanaan CSMS Alignment Meeting untuk Arsip Pengawasan Ketenagakerjaan & Migas/ESDM",
                    "Dokumen Penagihan B2B Resmi: SPK, BAST, Laporan Kegiatan, dan Faktur Pajak PPh 23",
                ],
                "faqs" => [
                    [
                        "q" => "Apakah acara ini bisa dilaksanakan langsung di area camp atau tenda proyek lapangan tambang?",
                        "a" => "Bisa. Kami memiliki peralatan sound system, panggung portabel, genset mandiri, dan tenda roder berpendingin udara yang siap didirikan di lokasi proyek remote.",
                    ],
                    [
                        "q" => "Bisakah Wahana Totalita membantu memfasilitasi pre-qualification audit CSMS vendor?",
                        "a" => "Ya, sebagai lembaga konsultan K3, tim kami juga dapat membantu perusahaan menyusun pedoman penilaian CSMS dan memverifikasi dokumen kelaikan K3 vendor sebelum acara townhall.",
                    ],
                    [
                        "q" => "Berapa kapasitas peserta kontraktor yang pernah ditangani Wahana Totalita?",
                        "a" => "Kami berpengalaman mengelola pertemuan koordinasi vendor mulai dari 30 perusahaan lokal hingga pertemuan akbar yang dihadiri 500+ pimpinan vendor nasional.",
                    ],
                ],
            ],
            'paket-meeting-fullday-kemenkeu' => [
                "slug" => "paket-meeting-fullday-kemenkeu",
                "judul" => "Pengadaan Paket Fullday Meeting Kedinasan Sesuai SBM Kemenkeu",
                "kategori" => "government-mice",
                "kategori_label" => "Government & Public MICE",
                "tagline" => "Layanan rapat kedinasan 8 jam tanpa menginap: 1x makan siang, 2x coffee break, meeting kit, kuitansi riil, SPJ lengkap & e-Faktur pajak.",
                "meta_title" => "Paket Fullday Meeting Kedinasan Sesuai SBM Kemenkeu — LPSE & SPSE INAPROC",
                "meta_desc" => "Vendor pengadaan paket fullday meeting kedinasan pemerintah di hotel bintang 4 seluruh Indonesia. Tarif sesuai SBM Kemenkeu, SPJ lengkap, BAST & faktur pajak.",
                "keywords" => [
                    "paket fullday meeting kemenkeu sbm",
                    "biaya fullday meeting kedinasan",
                    "sewa ruang rapat 8 jam instansi",
                    "pengadaan paket meeting lpse lkpp",
                    "vendor meeting kemenkeu jogja solo jakarta",
                    "tarif sbm paket meeting luar kota",
                ],
                "target_klien" => "PPK, Bendahara Pengeluaran, Pejabat Pengadaan Satker Kementerian, Lembaga Negara, dan SKPD Pemda Seluruh Indonesia.",
                "durasi_event" => "1 Hari Kerja (8 Jam Efektif Pertemuan Rapat)",
                "lokasi_layanan" => "Seluruh Indonesia (Yogyakarta, Solo, Jakarta, Surabaya, Semarang, Balikpapan, Makassar, Medan)",
                "biaya_standar" => "Rp 350.000 – Rp 480.000 / orang (Tepat Plafon SBM PMK Kemenkeu)",
                "biaya_batch" => "Rp 17.500.000 / paket 50 peserta (All-In Fasilitas & SPJ)",
                "b2b_min_peserta" => "20 hingga 200 peserta rapat instansi",
                "inaproc_relevance" => "Pemenang resmi tender Pengadaan Paket Meeting LKPP di SPSE INAPROC & Pusat Pengendalian Lingkungan Hidup Jawa.",
                "city_mentions" => [
                    "Yogyakarta",
                    "Solo",
                    "Jakarta",
                    "Surabaya",
                    "Semarang",
                    "Balikpapan",
                    "Makassar",
                    "Medan",
                ],
                "companies_mentions" => [
                    "Kementerian Keuangan",
                    "Kementerian LHK / P3E Jawa",
                    "LKPP",
                    "Kementerian PUPR",
                    "Pemerintah Provinsi",
                ],
                "highlight_pillars" => [
                    "Kepatuhan 100% Plafon Standar Biaya Masukan (SBM) Peraturan Menteri Keuangan",
                    "Rekanan Resmi Hotel Bintang 4 di Pusat Kota Seluruh Wilayah Indonesia",
                    "Kelengkapan Dokumen SPJ Lengkap: Kuitansi Riil, Daftar Hadir, BAST, SPK & Faktur Pajak PPh 23",
                    "Fasilitas Meeting Kit Lengkap: Blocknote, Ballpoint, Hand Sanitizer, & Perlengkapan Presentasi",
                ],
                "deskripsi_lengkap" => "Pengadaan paket rapat pertemuan di luar kantor bagi instansi pemerintah (Kementerian, Lembaga, dan Pemerintah Daerah) diatur secara ketat oleh Peraturan Menteri Keuangan tentang Standar Biaya Masukan (SBM). Bagi Pejabat Pembuat Komitmen (PPK) dan Pejabat Pengadaan, memilih vendor penyelenggara paket meeting fullday bukan hanya soal kemewahan menu makan siang hotel, melainkan kepatuhan regulasi pengadaan barang/jasa pemerintah dan akuntabilitas kelengkapan Surat Pertanggungjawaban (SPJ) yang siap diaudit oleh BPK maupun Inspektorat.\n\nWahana Totalita Konsultan adalah mitra terpercaya instansi pemerintah yang telah terbukti memenangkan tender resmi Pengadaan Paket Meeting LKPP di portal SPSE INAPROC dan berkontrak dengan satuan kerja kementerian seperti Pusat Pengendalian Lingkungan Hidup Wilayah Jawa (P3E KLHK).\n\nKami menyediakan paket Fullday Meeting (8 jam pertemuan, 1 kali makan siang prasmanan, dan 2 kali rehat kopi) di hotel-hotel bintang 4 rekanan pemerintah di seluruh kota Indonesia. Rincian penawaran harga kami dirancang presisi berada di bawah pagu SBM, dilengkapi kuitansi riil hotel, berita acara serah terima pekerjaan (BAST), daftar hadir peserta terverifikasi, dan Faktur Pajak sah (PPh 23 & PPN) sehingga proses pencairan anggaran SP2D di KPPN berjalan mulus tanpa temuan.",
                "spesifikasi_teknis" => [
                    [
                        "item" => "Ruang Meeting",
                        "spek" => "Function Room Hotel Bintang 4, Setup U-Shape / Classroom / Round Table Ber-AC Dingin",
                    ],
                    [
                        "item" => "Konsumsi SBM",
                        "spek" => "1x Makan Siang Prasmanan Variasi Nusantara, 2x Coffee Break dengan 3 Macam Snack Tradisional & Modern",
                    ],
                    [
                        "item" => "Alat Presentasi",
                        "spek" => "Screen & LCD Projector High-Lumens / TV LED, Laser Pointer Clicker, 2 Unit Mic Wireless Shure",
                    ],
                    [
                        "item" => "Meeting Kit Peserta",
                        "spek" => "Seminar Bag / Map Dokumen, Blocknote Bergaris, Ballpoint Gel, Permen & Air Mineral Botol Kaca",
                    ],
                ],
                "susunan_acara" => [
                    [
                        "fase" => "08.00 - 08.30",
                        "agenda" => "Registrasi Peserta Rapat, Pembagian Meeting Kit & Morning Coffee Break Pertama",
                    ],
                    [
                        "fase" => "08.30 - 09.00",
                        "agenda" => "Pembukaan Resmi oleh Pejabat Pembuat Komitmen (PPK) / Kepala Satker, Lagu Kebangsaan Indonesia Raya",
                    ],
                    [
                        "fase" => "09.00 - 12.00",
                        "agenda" => "Sesi Rapat Pleno I: Pemaparan Materi Teknis / Pembahasan Kebijakan Kedinasan",
                    ],
                    [
                        "fase" => "12.00 - 13.00",
                        "agenda" => "Ishoma (Istirahat, Sholat, Makan Siang Prasmanan di Restoran Hotel)",
                    ],
                    [
                        "fase" => "13.00 - 15.30",
                        "agenda" => "Sesi Rapat Pleno II: Diskusi Terarah / Perumusan Draft Keputusan Kedinasan",
                    ],
                    [
                        "fase" => "15.30 - 16.00",
                        "agenda" => "Afternoon Coffee Break Kedua & Finalisasi Notulen Rapat",
                    ],
                    [
                        "fase" => "16.00 - 16.30",
                        "agenda" => "Penutupan Rapat oleh Pimpinan Sidang, Penandatanganan Berita Acara, & Penyelesaian Administrasi SPJ",
                    ],
                ],
                "deliverables_output" => [
                    "Bundel Berkas SPJ Lengkap: Kuitansi Bermeterai, Daftar Hadir Peserta, Undangan, Notulen, & BAST",
                    "Faktur Pajak Elektronik (e-Faktur PPh Pasal 23 & PPN) Resmi Validasi DJP",
                    "Laporan Dokumentasi Kegiatan Berjilid Rapi dengan Foto Resolusi Tinggi untuk Lampiran SP2D KPPN",
                    "Dokumen Pengadaan Langsung: Surat Penawaran Harga, Surat Perintah Kerja (SPK), dan BAST Hasil Pekerjaan",
                ],
                "faqs" => [
                    [
                        "q" => "Apakah harga paket fullday meeting Wahana Totalita dijamin tidak melebihi pagu SBM PMK Kemenkeu?",
                        "a" => "Dijamin 100%. Kami selalu memverifikasi tabel SBM PMK tahun anggaran berjalan untuk kota pelaksanaan yang dipilih sehingga harga penawaran kami tepat atau berada di bawah pagu resmi.",
                    ],
                    [
                        "q" => "Bagaimana mekanisme pembayaran jika instansi kami menggunakan sistem Uang Persediaan (UP) atau LS KPPN?",
                        "a" => "Kami sangat fleksibel melayani pembayaran melalui mekanisme Uang Persediaan (UP), Uang Muka, maupun Pembayaran Langsung (LS/SP2D) setelah BAST ditandatangani dan berkas SPJ diverifikasi oleh bendahara pengeluaran.",
                    ],
                    [
                        "q" => "Apakah Wahana Totalita dapat menyediakan paket meeting di luar pulau Jawa seperti di Balikpapan atau Makassar?",
                        "a" => "Ya, jaringan hotel mitra kami tersebar di seluruh ibu kota provinsi di Indonesia. Kami siap memfasilitasi kebutuhan rapat dinas Anda di kota manapun.",
                    ],
                ],
            ],
            'paket-meeting-fullboard-residential' => [
                "slug" => "paket-meeting-fullboard-residential",
                "judul" => "Paket Fullboard Meeting Residential Instansi (Menginap Sesuai SBM)",
                "kategori" => "government-mice",
                "kategori_label" => "Government & Public MICE",
                "tagline" => "Rapat konsinyering kedinasan menginap: kamar hotel bintang 4-5 twin/single, 3x makan, 2x coffee break, ballroom eksklusif & kepatuhan penuh SBM.",
                "meta_title" => "Paket Fullboard Meeting Residential Kedinasan — Vendor INAPROC SBM Kemenkeu",
                "meta_desc" => "Jasa EO paket fullboard meeting kedinasan menginap (residential) di Yogyakarta, Solo, Jakarta & seluruh Indonesia. Kamar hotel twin share, ballroom, SPJ & faktur pajak.",
                "keywords" => [
                    "paket fullboard meeting lpse",
                    "biaya meeting menginap kedinasan sbm",
                    "paket konsinyering instansi hotel",
                    "sewa hotel konsinyering kemenkeu",
                    "vendor paket meeting luar kota",
                    "eo meeting residential bumn",
                ],
                "target_klien" => "Satuan Kerja Kementerian, Lembaga Non-Kementerian, Dinas Pemerintah Daerah, dan BUMN yang menyelenggarakan konsinyering penyusunan regulasi/laporan.",
                "durasi_event" => "2 Hari 1 Malam (2D1N) atau 3 Hari 2 Malam (3D2N) Menginap di Hotel",
                "lokasi_layanan" => "Seluruh Indonesia (Yogyakarta, Solo, Bandung, Bogor, Bali, Surabaya, Jakarta, Malang)",
                "biaya_standar" => "Rp 1.150.000 – Rp 1.650.000 / orang / hari (Twin Share Sesuai SBM)",
                "biaya_batch" => "Rp 57.500.000 / paket rombongan 50 orang (2D1N)",
                "b2b_min_peserta" => "30 hingga 500 peserta konsinyering",
                "inaproc_relevance" => "Rekam jejak pemenang berkontrak pengadaan paket meeting di portal SPSE INAPROC LKPP & kepatuhan audit BPK.",
                "city_mentions" => [
                    "Yogyakarta",
                    "Solo",
                    "Bandung",
                    "Bogor",
                    "Bali",
                    "Surabaya",
                    "Jakarta",
                    "Malang",
                ],
                "companies_mentions" => [
                    "Kementerian Kelautan & Perikanan",
                    "Kementerian ESDM",
                    "Badan Kepegawaian Negara (BKN)",
                    "Kemenkumham",
                    "Pemerintah Kota/Kabupaten",
                ],
                "highlight_pillars" => [
                    "Akomodasi Kamar Hotel Bintang 4 Pilihan (Twin Sharing / Single Sesuai Golongan ASN)",
                    "Konsumsi Penuh Fullboard: Sarapan Pagi, Makan Siang, Makan Malam Spesial & 2x Coffee Break",
                    "Ruang Sidang Pleno & Ruang Komisi Khusus untuk Pembahasan Konsinyering Intensif",
                    "Fasilitasi Logistik Tiket, Penjemputan Stasiun/Bandara & Dokumen Pertanggungjawaban SPJ Sah",
                ],
                "deskripsi_lengkap" => "Kegiatan rapat konsinyering atau penelaahan rancangan peraturan perundang-undangan dan evaluasi program kerja tahunan instansi pemerintah sering kali membutuhkan fokus tinggi tanpa gangguan rutinitas kantor. Oleh sebab itu, skema Paket Rapat Fullboard di Luar Kota (Residential Meeting) di hotel berbintang menjadi format standar yang dialokasikan dalam DIPA kementerian dan APBD dinas daerah.\n\nMenyelenggarakan paket meeting residential yang melibatkan puluhan hingga ratusan pejabat dari berbagai wilayah membutuhkan ketelitian tinggi dalam pembagian kamar (rooming list sesuai golongan PNS), pengaturan menu makanan bersertifikat halal, hingga kepatuhan harga satuan kamar terhadap tabel SBM Kemenkeu per provinsi.\n\nWahana Totalita Konsultan adalah mitra berpengalaman pengadaan paket meeting residential pemerintah di berbagai destinasi unggulan seperti Yogyakarta, Solo, Bandung, Bogor, dan Bali. Sebagai badan usaha yang terdaftar di SPSE INAPROC dan berstatus PKP resmi, kami menyediakan one-stop management: pemesanan alokasi kamar hotel berbintang, penyiapan ruang sidang utama dan ruang rapat kelompok kerja (breakout rooms), fasilitas sound system digital, penjemputan armada bus bandara/stasiun, hingga penyusunan laporan kegiatan dan kuitansi pertanggungjawaban keuangan negara yang akuntabel.",
                "spesifikasi_teknis" => [
                    [
                        "item" => "Akomodasi Hotel",
                        "spek" => "Kamar Hotel Bintang 4 Deluxe Twin / Single Room Berpendingin Udara, Air Panas, WiFi Cepat",
                    ],
                    [
                        "item" => "Konsumsi Fullboard",
                        "spek" => "Sarapan Pagi Buffet, Makan Siang & Makan Malam Prasmanan Chef Hotel, 2x Coffee Break Harian",
                    ],
                    [
                        "item" => "Ruang Rapat Pleno",
                        "spek" => "Ballroom Utama Kapasitas 100-300 Orang, Setup Classroom dengan Jarak Nyaman, Panggung Pidato",
                    ],
                    [
                        "item" => "Ruang Rapat Komisi",
                        "spek" => "2-4 Ruang Rapat Tambahan (Breakout Rooms) untuk Sidang Kelompok Kerja / Pembahasan Klaster",
                    ],
                ],
                "susunan_acara" => [
                    [
                        "fase" => "Hari 1 - 12.00 - 14.00",
                        "agenda" => "Kedatangan Delegasi di Hotel, Check-in Kamar, Makan Siang Prasmanan Selamat Datang",
                    ],
                    [
                        "fase" => "Hari 1 - 14.00 - 17.30",
                        "agenda" => "Sidang Pleno Pembukaan Konsinyering, Arahan Pejabat Eselon, Coffee Break Sore",
                    ],
                    [
                        "fase" => "Hari 1 - 19.00 - 22.00",
                        "agenda" => "Makan Malam Bersama & Lanjutan Rapat Sesi Malam: Pembahasan Draf Regulasi per Komisi",
                    ],
                    [
                        "fase" => "Hari 2 - 06.30 - 08.00",
                        "agenda" => "Sarapan Pagi Buffet di Restoran Hotel",
                    ],
                    [
                        "fase" => "Hari 2 - 08.30 - 12.00",
                        "agenda" => "Sidang Pleno Laporan Hasil Komisi, Perumusan Rekomendasi Akhir Konsinyering, Coffee Break Pagi",
                    ],
                    [
                        "fase" => "Hari 2 - 12.00 - 13.30",
                        "agenda" => "Penutupan Resmi Rapat, Penyelesaian Administrasi SPD/SPJ, Makan Siang & Check-out Hotel",
                    ],
                ],
                "deliverables_output" => [
                    "Berkas SPJ Fullboard Lengkap: Kuitansi Riil Hotel, Rooming List Berstempel, Daftar Hadir, & BAST",
                    "Faktur Pajak Elektronik PPh 23 dan PPN Sah Terverifikasi Direktorat Jenderal Pajak",
                    "Buku Prosiding / Notulen Hasil Konsinyering Berjilid Rapi untuk Laporan Pimpinan Satker",
                    "Dokumen Kontrak Pengadaan: Surat Perjanjian Kerja (SPK), BAST Hasil Pekerjaan, dan Kuitansi Resmi",
                ],
                "faqs" => [
                    [
                        "q" => "Bagaimana pengaturan kamar jika ada pejabat Eselon II yang berhak atas kamar single sesuai SBM?",
                        "a" => "Kami memisahkan alokasi kamar single untuk pejabat eselon II/I dan kamar twin sharing untuk staf/eselon III-IV sesuai ketentuan plafon SBM perorangan tanpa mencampuradukkan tagihan.",
                    ],
                    [
                        "q" => "Apakah peserta dari luar kota bisa difasilitasi penjemputannya dari bandara atau stasiun?",
                        "a" => "Bisa. Kami menyediakan armada HiAce Luxury atau Bus Pariwisata AC khusus penjemputan delegasi dari Bandara YIA Jogja, Adi Soemarmo Solo, atau stasiun kereta menuju hotel.",
                    ],
                    [
                        "q" => "Apakah paket ini dapat dipesan melalui mekanisme Pengadaan Langsung di bawah Rp 200 juta?",
                        "a" => "Ya, sebagian besar paket konsinyering instansi berada pada rentang Rp 40 juta hingga Rp 180 juta yang sangat sesuai dengan mekanisme Pengadaan Langsung SPK di sistem SPSE LPSE.",
                    ],
                ],
            ],
            'rapat-koordinasi-nasional-rakornas' => [
                "slug" => "rapat-koordinasi-nasional-rakornas",
                "judul" => "EO Rapat Koordinasi Nasional (Rakornas) Kementerian & Lembaga",
                "kategori" => "government-mice",
                "kategori_label" => "Government & Public MICE",
                "tagline" => "Konvensi akbar kedinasan tingkat nasional: produksi panggung LED videotron, registrasi digital barcode, VVIP protocol, dan live streaming hybrid.",
                "meta_title" => "EO Rakornas Kementerian & Lembaga — Konvensi Kedinasan Skala Nasional",
                "meta_desc" => "Event organizer rapat koordinasi nasional (Rakornas) kementerian & lembaga negara di Yogyakarta, Solo & Jakarta. Panggung LED videotron, registrasi barcode & SPSE.",
                "keywords" => [
                    "eo rakornas kementerian",
                    "penyelenggara rapat koordinasi nasional",
                    "vendor eo konvensi kedinasan",
                    "eo rapat pimpinan nasional",
                    "paket rakornas bumn lpse",
                    "mice kedinasan solo jogja jakarta",
                ],
                "target_klien" => "Sekretariat Jenderal Kementerian, Badan Nasional, Lembaga Pemerintah Non-Kementerian (LPNK), dan Kantor Pusat BUMN.",
                "durasi_event" => "2 Hari 1 Malam hingga 3 Hari 2 Malam (Konvensi Nasional 300 - 1.500 Delegasi)",
                "lokasi_layanan" => "Yogyakarta, Solo (Surakarta), Jakarta, Surabaya, Bali, Semarang",
                "biaya_standar" => "Rp 85.000.000 / paket produksi panggung & audiovisual utama",
                "biaya_batch" => "Rp 185.000.000 – Rp 450.000.000 / paket full event management (Tender LPSE)",
                "b2b_min_peserta" => "200 hingga 1.500 peserta delegasi seluruh Indonesia",
                "inaproc_relevance" => "Kualifikasi tender terbuka SPSE INAPROC & pengalaman menangani paket meeting kementerian.",
                "city_mentions" => [
                    "Yogyakarta",
                    "Solo",
                    "Jakarta",
                    "Surabaya",
                    "Bali",
                    "Semarang",
                ],
                "companies_mentions" => [
                    "Kementerian LHK",
                    "Kementerian Keuangan",
                    "Kementerian Perhubungan",
                    "Kementerian Dalam Negeri",
                    "BUMN Holding",
                ],
                "highlight_pillars" => [
                    "Panggung Utama Megah Konvensi Nasional dengan Backdrop LED Videotron P3 Curved 12x4 Meter",
                    "Sistem Registrasi Digital Barcode Cepat & Pencetakan ID Card Peserta Otomatis di Lokasi",
                    "Tata Suara Line Array Concert Grade & Siaran Langsung Multi-Kamera Hybrid Broadcast 4K",
                    "Manajemen Protokoler VIP/VVIP untuk Menteri, Gubernur, dan Jajaran Eselon I",
                ],
                "deskripsi_lengkap" => "Rapat Koordinasi Nasional (Rakornas) merupakan agenda tahunan paling bergengsi bagi kementerian atau lembaga pemerintah di mana menteri, gubernur, bupati/walikota, dan kepala dinas dari 38 provinsi berkumpul untuk menyelaraskan kebijakan strategis nasional. Menyelenggarakan Rakornas dengan peserta mencapai 500 hingga 1.500 orang menuntut kecakapan manajemen MICE (Meetings, Incentives, Conferences, Exhibitions) kelas satu.\n\nKeterlambatan registrasi peserta, gangguan tata suara saat lagu kebangsaan dinyanyikan, atau kekacauan alur protokoler VIP saat menteri memasuki ruangan adalah risiko fatal yang tidak boleh terjadi dalam acara kenegaraan.\n\nWahana Totalita Konsultan memiliki kompetensi matang dan rekam jejak terverifikasi dalam mengelola konvensi kedinasan tingkat nasional. Kami menghadirkan sistem registrasi barcode instan yang mampu memproses ratusan tamu dalam hitungan menit tanpa antrean panjang, instalasi panggung visual LED videotron beresolusi ultra-tinggi, tata lampu elegan, tim protokoler terlatih berkoordinasi dengan pengamanan pejabat tinggi, serta manajemen transit hotel dan transportasi delegasi yang rapi.\n\nDidukung status hukum PT resmi dan rekam jejak pemenang tender SPSE INAPROC, kami siap bermitra melalui proses tender resmi LPSE kementerian maupun pengadaan terintegrasi e-Katalog.",
                "spesifikasi_teknis" => [
                    [
                        "item" => "Panggung & Megatron",
                        "spek" => "Panggung Utama Convention Hall 16x6 Meter, LED Videotron P3 Ultra High-Def (Dimensi 12x4 Meter)",
                    ],
                    [
                        "item" => "Tata Suara & Konferensi",
                        "spek" => "Line Array Sound System 20.000 Watt, Digital Audio Mixer Yamaha, 4 Mic Podium VIP, 8 Wireless Shure",
                    ],
                    [
                        "item" => "Sistem Registrasi Digital",
                        "spek" => "4x Meja Registrasi Digital Barcode Scanner, Printer ID Card Thermal Instan, Display Nama Otomatis",
                    ],
                    [
                        "item" => "Broadcast & Live Feed",
                        "spek" => "4 Kamera Sony FX6 / Panasonic Broadcast dengan Jimmy Jib Crane, Live Video Switcher Blackmagic, Zoom/YT",
                    ],
                ],
                "susunan_acara" => [
                    [
                        "fase" => "Hari 1 - 07.30 - 08.45",
                        "agenda" => "Registrasi Digital Delegasi Nasional, Pembagian Kit Konvensi, Welcoming Instrumental Gamelan/Orchestra",
                    ],
                    [
                        "fase" => "Hari 1 - 09.00 - 09.30",
                        "agenda" => "Opening Ceremony: Lagu Indonesia Raya, Tarian Tradisional Selamat Datang, Laporan Panitia Sekjen",
                    ],
                    [
                        "fase" => "Hari 1 - 09.30 - 10.30",
                        "agenda" => "Keynote Speech & Pembukaan Resmi oleh Menteri / Pejabat Tinggi Negara, Penekanan Tombol LED Sirine",
                    ],
                    [
                        "fase" => "Hari 1 - 10.30 - 12.30",
                        "agenda" => "Sesi Pleno I: Pemaparan Kebijakan Strategis Nasional oleh Para Direktur Jenderal",
                    ],
                    [
                        "fase" => "Hari 1 - 12.30 - 13.30",
                        "agenda" => "Makan Siang Banquet VIP di Ballroom & Networking Antar-Kepala Dinas Seluruh Indonesia",
                    ],
                    [
                        "fase" => "Hari 1 - 13.30 - 17.00",
                        "agenda" => "Sesi Pleno II & Diskusi Panel Antar-Kementerian Terkait",
                    ],
                    [
                        "fase" => "Hari 1 - 19.30 - 21.30",
                        "agenda" => "Gala Dinner Keakraban Nasional, Penyerahan Penghargaan Kinerja Dinas Terbaik, Penampilan Musik",
                    ],
                    [
                        "fase" => "Hari 2 - 08.30 - 12.00",
                        "agenda" => "Sesi Pembacaan Deklarasi / Rekomendasi Rakornas, Penandatanganan Komitmen Bersama, Penutupan",
                    ],
                ],
                "deliverables_output" => [
                    "Buku Prosiding Hasil Rakornas Berjilid Eksklusif Hardcover & Rekaman Video Arsip Resmi Kenegaraan",
                    "Video Highlight Dokumenter 3 Menit untuk Publikasi Berita Televisi & Humas Kementerian",
                    "Database Kehadiran Digital Seluruh Delegasi dari 38 Provinsi (Ekspor Excel & PDF)",
                    "Dokumen Pertanggungjawaban Tender LPSE Lengkap: SPK, BAST, Kuitansi, dan Faktur Pajak PPh 23 / PPN",
                ],
                "faqs" => [
                    [
                        "q" => "Apakah Wahana Totalita sanggup menangani acara kenegaraan yang dihadiri Presiden atau Menteri?",
                        "a" => "Sangat sanggup. Tim protokoler kami sangat familiar berkoordinasi dengan Paspampres (Pasukan Pengamanan Presiden), protokol kementerian, dan kepolisian daerah dalam menerapkan standar ring pengamanan VVIP.",
                    ],
                    [
                        "q" => "Berapa kapasitas gedung konvensi terbesar yang dapat dikelola di Yogyakarta dan Solo?",
                        "a" => "Di Yogyakarta kami bermitra dengan Grand Pacific Hall, JEC (Jogja Expo Center), dan ballroom hotel bintang 5 (kapasitas hingga 3.000 orang). Di Solo kami mengelola acara di De Tjolomadoe dan Alila Grand Ballroom.",
                    ],
                    [
                        "q" => "Apakah Wahana Totalita terdaftar di e-Katalog LKPP untuk jasa MICE dan Event Organizer?",
                        "a" => "Ya, badan hukum kami terdaftar di portal pengadaan nasional dan siap melakukan transaksi melalui skema e-Purchasing e-Katalog maupun tender LPSE.",
                    ],
                ],
            ],
            'bimbingan-teknis-bimtek-kedinasan' => [
                "slug" => "bimbingan-teknis-bimtek-kedinasan",
                "judul" => "Penyelenggaraan Bimbingan Teknis (Bimtek) & Diklat ASN Pemerintah",
                "kategori" => "government-mice",
                "kategori_label" => "Government & Public MICE",
                "tagline" => "Penyelenggara bimtek & workshop aparatur sipil negara: narasumber bersertifikat, akomodasi hotel bintang 4, seminar kit kulit, dan sertifikat berstandar BKN.",
                "meta_title" => "EO Bimtek & Diklat ASN Pemerintah — Penyelenggara Resmi LPSE",
                "meta_desc" => "Jasa EO bimbingan teknis (Bimtek) & pelatihan kedinasan ASN Pemda & kementerian di Yogyakarta, Solo, Jakarta & Bandung. Narasumber ahli, modul, sertifikat & SPJ.",
                "keywords" => [
                    "penyelenggara bimtek asn pemda",
                    "eo pelatihan kedinasan skpd",
                    "paket bimtek dinas luar kota",
                    "biaya bimtek per orang jogja solo",
                    "vendor diklat kepegawaian lpse",
                    "eo bimbingan teknis keuangan daerah",
                ],
                "target_klien" => "Badan Kepegawaian & Pengembangan SDM (BKPSDM), Dinas Teknis Pemda, Bagian Organisasi, dan Sekretariat DPRD Seluruh Indonesia.",
                "durasi_event" => "3 Hari 2 Malam (3D2N) atau 4 Hari 3 Malam (4D3N)",
                "lokasi_layanan" => "Yogyakarta, Solo, Bandung, Malang, Jakarta, Bali, Batam",
                "biaya_standar" => "Rp 4.500.000 / peserta (Paket Non-Residential)",
                "biaya_batch" => "Rp 6.500.000 / peserta (Paket All-In Residential Hotel Bintang 4)",
                "b2b_min_peserta" => "25 hingga 100 orang per angkatan diklat",
                "inaproc_relevance" => "Kepatuhan UU No. 20/2023 tentang ASN, standar kurikulum LAN RI, dan terdaftar di portal pengadaan pemerintah.",
                "city_mentions" => [
                    "Yogyakarta",
                    "Solo",
                    "Bandung",
                    "Malang",
                    "Jakarta",
                    "Bali",
                    "Batam",
                ],
                "companies_mentions" => [
                    "BKPSDM Kabupaten/Kota",
                    "Bappeda",
                    "Dinas Kesehatan",
                    "Dinas Pendidikan",
                    "Inspektorat Daerah",
                ],
                "highlight_pillars" => [
                    "Kurikulum Teknis Mutakhir Mengacu Regulasi Kementerian Terkait & Standar BKN/LAN",
                    "Narasumber Praktisi Senior, Widyaiswara Utama, dan Akademisi Berpengalaman",
                    "Akomodasi Hotel Bintang 4 Nyaman, Makanan Higienis, & Fasilitas Ruang Belajar Modern",
                    "Sertifikat Kelulusan Resmi & Laporan Evaluasi Kompetensi Peserta Berjilid Lengkap",
                ],
                "deskripsi_lengkap" => "Peningkatan kompetensi pegawai negeri sipil dan aparatur sipil negara (ASN) merupakan amanat Undang-Undang No. 20 Tahun 2023 tentang Aparatur Sipil Negara, di mana setiap pegawai berhak atas pengembangan kompetensi minimal 20 jam pelajaran per tahun. Bimbingan Teknis (Bimtek) luar kota di kota-kota yang ramah akademis seperti Yogyakarta, Solo, dan Bandung menjadi pilihan utama bagi dinas-dinas daerah untuk meng-upgrade keahlian pegawai dalam pengelolaan keuangan daerah (SIPD), pengadaan barang/jasa pemerintah, penyusunan LPPD/LAKIP, hingga kepatuhan hukum kepegawaian.\n\nMenyelenggarakan Bimtek yang bermutu memerlukan sinergi antara narasumber yang kredibel, ruang kelas yang interaktif, dan administrasi keuangan yang patuh pada Standar Biaya Masukan (SBM).\n\nWahana Totalita Konsultan memadukan keahlian akademis dan keandalan manajemen acara. Kami menyiapkan narasumber berkompeten dari kementerian teknis (Kemenkeu, Kemendagri, BKN, LKPP), menyediakan modul pembelajaran cetak dan flashdisk, seminar kit kulit eksklusif, serta mengawal seluruh proses ujian evaluasi. Dokumen pertanggungjawaban (SPJ, kuitansi riil, lembar absensi, dan sertifikat kelulusan berstempel) disiapkan secara tuntas sehingga panitia dinas dapat kembali ke daerah dengan rasa aman dan akuntabel.",
                "spesifikasi_teknis" => [
                    [
                        "item" => "Ruang Belajar & Kelas",
                        "spek" => "Classroom Setup Hotel Bintang 4, Meja Lebar dengan Colokan Listrik per Meja, AC Dingin",
                    ],
                    [
                        "item" => "Perangkat Edukasi",
                        "spek" => "LCD Projector High Lumens, Flipchart & Spidol Warna, Laser Pointer, Mic Wireless",
                    ],
                    [
                        "item" => "Kit Peserta Eksklusif",
                        "spek" => "Tas Ransel / Tas Selempang Kulit Premium, Buku Modul Hardcopy, Flashdisk Materi, ID Card",
                    ],
                    [
                        "item" => "Sertifikat Kelulusan",
                        "spek" => "Sertifikat Bimtek Tebal Berhologram dengan Jam Pembelajaran (JP) & Nomor Registrasi Resmi",
                    ],
                ],
                "susunan_acara" => [
                    [
                        "fase" => "Hari 1 - 13.00 - 15.00",
                        "agenda" => "Kedatangan Peserta, Registrasi, Pembagian Kit Bimtek, dan Check-in Hotel",
                    ],
                    [
                        "fase" => "Hari 1 - 15.30 - 17.30",
                        "agenda" => "Opening Ceremony oleh Kepala Dinas/BKPSDM & Pre-Test Pengukuran Pemahaman Awal",
                    ],
                    [
                        "fase" => "Hari 2 - 08.30 - 12.00",
                        "agenda" => "Sesi Modul I & II: Pemaparan Kebijakan Teknis oleh Narasumber Utama Kementerian",
                    ],
                    [
                        "fase" => "Hari 2 - 13.00 - 17.00",
                        "agenda" => "Sesi Modul III: Simulasi Praktik Kasus & Bedah Aplikasi Sistem Informasi Pemerintahan",
                    ],
                    [
                        "fase" => "Hari 3 - 08.30 - 11.30",
                        "agenda" => "Sesi Post-Test, Evaluasi Kelulusan, Penyerahan Sertifikat Simbolis, & Penutupan Resmi",
                    ],
                    [
                        "fase" => "Hari 3 - 12.00 - 13.00",
                        "agenda" => "Makan Siang & Check-out Hotel Menuju Bandara / Stasiun",
                    ],
                ],
                "deliverables_output" => [
                    "Sertifikat Bimbingan Teknis Resmi dengan Bobot Jam Pelajaran (JP) Terverifikasi",
                    "Laporan Pelaksanaan Bimtek & Hasil Analisis Pre-Test/Post-Test Peserta",
                    "Berkas SPJ Lengkap Sesuai Permendagri/Perbup: Kuitansi, SPK, BAST, dan Faktur Pajak PPh 23",
                    "Flashdisk Kumpulan Regulasi & Materi Presentasi Narasumber untuk Seluruh Peserta",
                ],
                "faqs" => [
                    [
                        "q" => "Apakah narasumber yang dihadirkan bersertifikat dan diakui oleh kementerian terkait?",
                        "a" => "Ya, seluruh narasumber kami adalah widyaiswara utama, pejabat fungsional perancang kebijakan, atau praktisi bersertifikasi BNSP/kementerian terkait.",
                    ],
                    [
                        "q" => "Bisakah tema Bimtek dirancang khusus sesuai permasalahan riil di dinas kami?",
                        "a" => "Sangat bisa. Kami menyediakan layanan In-House Bimtek dengan kurikulum yang dirancang khusus (tailor-made) berdasarkan kebutuhan analisis jabatan dinas Anda.",
                    ],
                    [
                        "q" => "Apakah biaya paket Bimtek sudah mencakup penginapan dan makan selama kegiatan?",
                        "a" => "Untuk Paket Residential, seluruh biaya sudah all-in mencakup akomodasi hotel bintang 4 (kamar twin share), makan 3x sehari, dan coffee break tanpa biaya tersembunyi.",
                    ],
                ],
            ],
            'event-vvip-kunjungan-menteri' => [
                "slug" => "event-vvip-kunjungan-menteri",
                "judul" => "EO Kunjungan Kerja Menteri, Pejabat Tinggi Negara & Protokol VVIP",
                "kategori" => "government-mice",
                "kategori_label" => "Government & Public MICE",
                "tagline" => "Manajemen acara protokoler kenegaraan: koordinasi pengamanan VVIP, tenda roder berpendingin udara, panggung utama, press room & holding lounge.",
                "meta_title" => "EO Kunjungan Menteri & Pejabat Tinggi Negara — Protokoler VVIP Solo & Jogja",
                "meta_desc" => "Jasa EO protokoler kunjungan kerja menteri, gubernur & pejabat tinggi negara di Solo, Yogyakarta & Jawa Tengah. Tenda roder AC VIP, red carpet, press room & pengamanan.",
                "keywords" => [
                    "eo kunjungan menteri solo jogja jakarta",
                    "protokoler acara menteri jawa tengah",
                    "eo peresmian proyek bumn",
                    "groundbreaking ceremony vendor",
                    "tenda roder ac vip kunjungan presiden",
                    "vendor protokoler kementerian lkpp",
                ],
                "target_klien" => "Kementerian (KLHK, Kemenhub, Kemendikbud, PUPR, Kemenperin), Kantor Gubernur, BUMN Pelaksana Proyek Strategis Nasional.",
                "durasi_event" => "1 Hari Puncak Acara (Persiapan & Gladi Bersih H-2 sampai H-1)",
                "lokasi_layanan" => "Solo (Surakarta), Yogyakarta, Semarang, Boyolali, Karanganyar, Jakarta, dan Kawasan Proyek Strategis Nasional",
                "biaya_standar" => "Rp 75.000.000 / paket seremoni kunjungan kerja VIP",
                "biaya_batch" => "Rp 185.000.000 – Rp 350.000.000 / paket kenegaraan akbar (+ Tenda Roder AC Raksasa & Panggung Megah)",
                "b2b_min_peserta" => "Disesuaikan mulai 50 pejabat VIP hingga 1.000 tamu undangan",
                "inaproc_relevance" => "Portofolio nyata menangani kunjungan Menteri Lingkungan Hidup di Solo & pemenang kontrak SPSE INAPROC.",
                "city_mentions" => [
                    "Solo",
                    "Yogyakarta",
                    "Semarang",
                    "Boyolali",
                    "Karanganyar",
                    "Jakarta",
                    "Cilegon",
                ],
                "companies_mentions" => [
                    "Kementerian LHK / P3E Jawa",
                    "Kementerian Perhubungan",
                    "Kementerian PUPR",
                    "PT Kereta Api Indonesia",
                    "Pelindo",
                ],
                "highlight_pillars" => [
                    "Penerapan Protokoler Kenegaraan Ketat Sesuai UU No. 9 Tahun 2010 tentang Keprotokolan",
                    "Instalasi Tenda Roder Semi-Permanen Mewah Berpendingin Udara (Standing AC 5PK) di Area Proyek",
                    "Holding Room VVIP Eksklusif Dilengkapi Sofa Kulit, Karpet Merah, & Toilet VVIP Kontainer",
                    "Koordinasi Pengamanan Sinergis dengan Protokol Kementerian, TNI, Polri, dan Paspampres",
                ],
                "deskripsi_lengkap" => "Kunjungan kerja Menteri Republik Indonesia, pejabat setingkat menteri, atau pimpinan lembaga tinggi negara merupakan agenda dengan tingkat risiko protokoler tertinggi. Kesalahan sekecil apa pun dalam tata tempat (seating arrangement), keterlambatan pergerakan iring-iringan kendaraan dinas, kegagalan tata suara saat sambutan kenegaraan, atau ketidaknyamanan ruang transit (holding room) dapat mencoreng martabat instansi penyelenggara dan pemerintah daerah.\\n\\nWahana Totalita Konsultan memiliki rekam jejak nyata yang terbukti sukses mengelola kunjungan resmi Menteri di Solo (Jawa Tengah) dan berbagai proyek strategis di Yogyakarta. Kami memahami secara mendalam tata urutan protokoler resmi kenegaraan berdasarkan UU No. 9 Tahun 2010, mulai dari penyambutan di tangga bandara/pintu masuk, urutan menyanyikan lagu Indonesia Raya dan doa, penataan tempat duduk VIP VVIP, hingga alur penekanan tombol sirine peresmian.\\n\\nUntuk acara di lapangan terbuka atau lokasi pabrik yang belum memiliki gedung representatif, kami menyediakan fasilitas tenda roder bentang bebas ber-AC sejuk, partisi ruang transit VIP tertutup kedap suara, area konferensi pers untuk media massa, panggung megah berlayar LED videotron, hingga penyediaan hidangan boga beringin standar jamuan kenegaraan.",
                "spesifikasi_teknis" => [
                    [
                        "item" => "Tenda Roder VIP",
                        "spek" => "Tenda Roder Aluminium Struktur Bentang 10-20 Meter, Plafon Dekorasi Kain Mewah, Flooring Karpet Tebal",
                    ],
                    [
                        "item" => "Pendingin Ruangan (HVAC)",
                        "spek" => "10-20 Unit Standing AC 5 PK & Misty Fan untuk Menjaga Suhu Tetap 20-22 Derajat Celcius di Lapangan Terbuka",
                    ],
                    [
                        "item" => "Holding Room VVIP",
                        "spek" => "Ruang Transit Tertutup, Sofa Kulit Single & Double VIP, Meja Teh, Air Mineral Premium, Toilet VIP Mobile",
                    ],
                    [
                        "item" => "Panggung & Display",
                        "spek" => "Panggung Protokoler Karpet Merah, Meja Podium Kenegaraan Lambang Garuda, LED Screen P3, Tombol Sirine LED",
                    ],
                ],
                "susunan_acara" => [
                    [
                        "fase" => "H-1 15.00 - 18.00",
                        "agenda" => "Gladi Bersih Ketat Bersama Tim Protokol Kementerian, Kepolisian, dan Pembawa Acara (MC Protokoler)",
                    ],
                    [
                        "fase" => "Hari H - 08.00 - 09.00",
                        "agenda" => "Sterilisasi Area Acara oleh Petugas Pengamanan, Kedatangan Tamu Undangan & Pemeriksaan Metal Detector",
                    ],
                    [
                        "fase" => "Hari H - 09.30 - 09.45",
                        "agenda" => "Kedatangan Rombongan Menteri di Holding Room VVIP, Transit & Ramah Tamah Singkat bersama Pimpinan Instansi",
                    ],
                    [
                        "fase" => "Hari H - 09.45 - 10.00",
                        "agenda" => "Prosesi Masuk Ruang Utama Diiringi Lagu Kebangsaan Indonesia Raya & Doa Bersama",
                    ],
                    [
                        "fase" => "Hari H - 10.00 - 11.00",
                        "agenda" => "Laporan Pimpinan Proyek, Sambutan Resmi Menteri, & Prosesi Simbolis Penekanan Tombol Peresmian / Penandatanganan Prasasti",
                    ],
                    [
                        "fase" => "Hari H - 11.00 - 11.30",
                        "agenda" => "Tinjauan Lapangan (Site Inspection) Rombongan Menteri didampingi Media Massa, Doorstop Interview di Press Corner",
                    ],
                    [
                        "fase" => "Hari H - 11.30 - 12.30",
                        "agenda" => "Jamuan Santap Siang VVIP Ramah Tamah, Pelepasan Rombongan Menteri Menuju Bandara",
                    ],
                ],
                "deliverables_output" => [
                    "Prasasti Peresmian Granit / Logam Kuningan Ukir Resmi Bertanda Tangan Basah Menteri",
                    "Video Liputan Berita Kenegaraan Siap Siar untuk Humas Kementerian & Stasiun Televisi Nasional",
                    "Album Foto Dokumentasi Kenegaraan Eksklusif Hardcover untuk Kenang-Kenangan Menteri & Direksi",
                    "Dokumen Pengadaan Resmi: SPK, BAST, Kuitansi, dan Faktur Pajak PPh 23 / PPN",
                ],
                "faqs" => [
                    [
                        "q" => "Apakah Wahana Totalita berpengalaman menangani peresmian proyek yang dihadiri menteri di luar pulau Jawa?",
                        "a" => "Ya, tim produksi kami terbiasa memobilisasi logistik tenda roder, panggung, dan genset berdaya besar ke kawasan industri dan lokasi proyek strategis di seluruh Indonesia.",
                    ],
                    [
                        "q" => "Bagaimana koordinasi dengan pihak protokoler kementerian dan Paspampres?",
                        "a" => "Tim Liaison Officer (LO) kami memiliki protokol perwira yang berpengalaman menjalin komunikasi langsung dengan Biro Humas & Protokol kementerian sejak H-7 hingga acara selesai.",
                    ],
                    [
                        "q" => "Apakah prasasti batu marmer atau kuningan peresmian sudah termasuk dalam paket acara?",
                        "a" => "Ya, kami menyediakan prasasti batu marmer hitam Itali atau plat kuningan tebal dengan grafir laser presisi tinggi lengkap dengan pulpen prasasti emas resmi.",
                    ],
                ],
            ],
            'vendor-pengadaan-lpse-inaproc' => [
                "slug" => "vendor-pengadaan-lpse-inaproc",
                "judul" => "Profil Vendor Resmi Pengadaan Event & Meeting LPSE SPSE INAPROC",
                "kategori" => "government-mice",
                "kategori_label" => "Government & Public MICE",
                "tagline" => "Landing page kredibilitas pengadaan instansi: legalitas PT lengkap, NPWP, status PKP aktif, KBLI MICE terdaftar, dan rekam jejak pemenang tender LKPP.",
                "meta_title" => "Vendor Resmi Pengadaan Event & Meeting LPSE INAPROC — PT Wahana Totalita",
                "meta_desc" => "Profil resmi penyedia jasa event organizer & paket meeting pemerintah terdaftar di SPSE INAPROC LKPP & PADI UMKM BUMN. Legalitas PKP lengkap, BAST & e-Faktur sah.",
                "keywords" => [
                    "vendor eo terdaftar inaproc lpse",
                    "profil vendor pengadaan paket meeting lkpp",
                    "syarat spk eo pemerintah pkp",
                    "penyedia mice e katalog lkpp",
                    "legalitas pt event organizer bumn",
                    "rekanan resmi pengadaan instansi pemerintah",
                ],
                "target_klien" => "Pokja Pemilihan UKPBJ, Pejabat Pengadaan, Auditor Inspektorat, dan Tim Pengadaan BUMN Seluruh Indonesia.",
                "durasi_event" => "Layanan Pengadaan Terbuka Sepanjang Tahun Anggaran (APBN, APBD, dan Anggaran BUMN)",
                "lokasi_layanan" => "Seluruh Wilayah Republik Indonesia",
                "biaya_standar" => "Pengadaan Langsung SPK di bawah Rp 200.000.000",
                "biaya_batch" => "Tender Terbuka / Seleksi Cepat di atas Rp 200.000.000",
                "b2b_min_peserta" => "Disesuaikan dengan Kerangka Acuan Kerja (KAK / TOR) Pengadaan",
                "inaproc_relevance" => "Terbukti berkontrak resmi di sistem SPSE INAPROC Nasional: Tender Paket Meeting LKPP & P3E Wilayah Jawa.",
                "city_mentions" => [
                    "Jakarta",
                    "Yogyakarta",
                    "Solo",
                    "Surabaya",
                    "Semarang",
                    "Balikpapan",
                    "Medan",
                    "Makassar",
                ],
                "companies_mentions" => [
                    "Lembaga Kebijakan Pengadaan Barang/Jasa Pemerintah (LKPP)",
                    "Kementerian LHK",
                    "Kementerian Keuangan",
                    "BUMN PADI UMKM",
                    "Pemerintah Daerah",
                ],
                "highlight_pillars" => [
                    "Badan Usaha Resmi Berbadan Hukum PT dengan Nomor Induk Berusaha (NIB) Berbasis Risiko",
                    "Pengusaha Kena Pajak (PKP) Aktif dengan Kepatuhan Pajak Lengkap (NPWP & Konfirmasi Status Wajib Pajak KSWP Valid)",
                    "KBLI Terdaftar Lengkap: Jasa Penyelenggara Pertemuan, Perjalanan Insentif, Konferensi dan Pameran (MICE)",
                    "Rekam Jejak Kinerja Baik (Performance Record) Terverifikasi di Portal SPSE INAPROC LKPP",
                ],
                "deskripsi_lengkap" => "Dalam tata kelola pengadaan barang dan jasa pemerintah sesuai Peraturan Presiden No. 12 Tahun 2021 dan perubahannya, Pejabat Pembuat Komitmen (PPK) serta Pejabat Pengadaan memikul tanggung jawab hukum mutlak atas legalitas dan kualifikasi penyedia yang ditunjuk. Menunjuk vendor yang tidak berstatus PKP, tidak memiliki KBLI yang sesuai, atau tidak memiliki rekam jejak di sistem pengadaan nasional SPSE INAPROC mengandung risiko temuan fatal saat audit Badan Pemeriksa Keuangan (BPK) maupun Aparat Pengawasan Intern Pemerintah (APIP).\\n\\nPT Wahana Totalita Konsultan adalah badan usaha resmi berbadan hukum Perseroan Terbatas (PT) yang memenuhi seluruh kualifikasi administratif, teknis, dan finansial pengadaan pemerintah. Profil kami terdaftar dan terverifikasi secara aktif di portal nasional SPSE INAPROC LKPP serta ekosistem PADI UMKM BUMN.\\n\\nKeunggulan bermitra dengan PT Wahana Totalita Konsultan:\\n1. Kualifikasi Pajak Sah: Kami berstatus Pengusaha Kena Pajak (PKP) aktif, memiliki status KSWP (Konfirmasi Status Wajib Pajak) valid di DJP, dan selalu menerbitkan e-Faktur Pajak PPh Pasal 23 dan PPN yang sah.\\n2. Rekam Jejak Pemenang Tender: Telah terbukti memenangkan tender resmi paket meeting pemerintah seperti Tender Paket Meeting LKPP (Nilai Rp 81.609.400,-) dan berkontrak dengan Pusat Pengendalian Lingkungan Hidup Wilayah Jawa.\\n3. Kesiapan Sistem Pembayaran Pemerintah: Kami sangat familiar dan siap menerima sistem pembayaran uang persediaan (UP), ganti uang (GU), maupun pembayaran langsung (LS / SP2D KPPN) setelah Berita Acara Serah Terima (BAST) pekerjaan diterbitkan.",
                "spesifikasi_teknis" => [
                    [
                        "item" => "Bentuk Badan Hukum",
                        "spek" => "Perseroan Terbatas (PT) Resmi Kemenkumham RI",
                    ],
                    [
                        "item" => "Nomor Induk Berusaha (NIB)",
                        "spek" => "NIB Berbasis Risiko dengan KBLI MICE & Jasa Penyelenggaraan Konvensi",
                    ],
                    [
                        "item" => "Status Perpajakan",
                        "spek" => "NPWP Perusahaan, Pengukuhan Pengusaha Kena Pajak (PKP), e-Faktur Terintegrasi DJP Online",
                    ],
                    [
                        "item" => "Sertifikasi Kompetensi",
                        "spek" => "PJK3 Resmi Kemnaker RI, Personel Bersertifikasi BNSP MICE & Tenaga Ahli K3",
                    ],
                ],
                "susunan_acara" => [
                    [
                        "fase" => "Tahap 1",
                        "agenda" => "Penyampaian Kerangka Acuan Kerja (KAK / TOR) dan Undangan Pengadaan Langsung / Tender",
                    ],
                    [
                        "fase" => "Tahap 2",
                        "agenda" => "Pengiriman Dokumen Penawaran Teknis, Penawaran Biaya (RAB), dan Kelengkapan Kualifikasi Administrasi",
                    ],
                    [
                        "fase" => "Tahap 3",
                        "agenda" => "Klarifikasi dan Negosiasi Teknis/Harga bersama Pejabat Pengadaan / Pokja Pemilihan UKPBJ",
                    ],
                    [
                        "fase" => "Tahap 4",
                        "agenda" => "Penerbitan Surat Perintah Kerja (SPK) / Surat Perjanjian Kontrak Resmi di Sistem SPSE",
                    ],
                    [
                        "fase" => "Tahap 5",
                        "agenda" => "Pelaksanaan Pekerjaan di Lapangan dengan Pengawasan Mutu Ketat sesuai KAK",
                    ],
                    [
                        "fase" => "Tahap 6",
                        "agenda" => "Pemeriksaan Hasil Pekerjaan, Penandatanganan BAST, Penyerahan Berkas SPJ & Penerbitan Faktur Pajak",
                    ],
                ],
                "deliverables_output" => [
                    "Profil Perusahaan Lengkap (Company Profile) Berisi Salinan Legalitas NIB, NPWP, PKP, dan Akta Notaris",
                    "Portofolio Riwayat Kontrak & Bukti Pemenang Tender Resmi di Sistem SPSE INAPROC",
                    "Kelengkapan Dokumen Kontrak Pengadaan: Draf SPK, BAST Pekerjaan, Kuitansi Bermeterai, & Faktur Pajak Sah",
                    "Jaminan Pelaksanaan / Jaminan Pemeliharaan Bank (Bank Guarantee) Jika Dipersyaratkan Tender",
                ],
                "faqs" => [
                    [
                        "q" => "Apakah PT Wahana Totalita Konsultan dapat memproses transaksi langsung melalui e-Purchasing e-Katalog?",
                        "a" => "Ya, kami memiliki etalase produk jasa yang siap ditransaksikan melalui e-Purchasing e-Katalog LKPP untuk mempermudah proses belanja pemerintah.",
                    ],
                    [
                        "q" => "Apakah dokumen penawaran harga dari Wahana Totalita sudah mencakup pajak-pajak negara?",
                        "a" => "Setiap draf penawaran dan RAB kami mencantumkan perincian harga dasar, PPN 11%, dan pemotongan PPh Pasal 23 secara transparan sesuai kaidah perpajakan pengadaan barang/jasa.",
                    ],
                    [
                        "q" => "Bagaimana jika instansi kami membutuhkan konsultasi penyusunan draf KAK/RAB sebelum pengadaan dimulai?",
                        "a" => "Tim spesialis pengadaan kami dengan senang hati membantu PPK atau pejabat pengadaan dalam menyusun draf KAK, spesifikasi teknis, dan perkiraan biaya HPS yang realistis dan patuh regulasi.",
                    ],
                ],
            ],
            'rapat-kerja-tahunan-raker-bumn' => [
                "slug" => "rapat-kerja-tahunan-raker-bumn",
                "judul" => "EO Rapat Kerja Tahunan (Raker) & Kick-Off Meeting Korporasi BUMN",
                "kategori" => "corporate-meetings",
                "kategori_label" => "Corporate Strategy & Meetings",
                "tagline" => "Penyelenggaraan raker tahunan strategis: plenary hall hotel bintang 4-5, breakout rooms, LED backdrop, gala dinner santai, dan executive transportation.",
                "meta_title" => "EO Rapat Kerja Tahunan (Raker) BUMN & Korporasi — Vendor Meeting MICE",
                "meta_desc" => "Jasa EO rapat kerja tahunan (Raker) & kick-off meeting BUMN di Yogyakarta, Solo, Bali, Bandung & Surabaya. Hotel bintang 5, plenary room, LED screen & gala dinner.",
                "keywords" => [
                    "eo rapat kerja tahunan raker bumn",
                    "paket annual company meeting hotel bintang 5",
                    "vendor raker nasional perusahaan",
                    "eo corporate kick off meeting",
                    "sewa ballroom raker direksi",
                    "paket meeting tahunan bumn jogja solo bali",
                ],
                "target_klien" => "Corporate Secretary, Direksi Human Capital, Kepala Divisi Perencanaan Strategis BUMN, Perbankan, dan Perusahaan Swasta Nasional.",
                "durasi_event" => "3 Hari 2 Malam (3D2N) atau 2 Hari 1 Malam (2D1N) Format Residential",
                "lokasi_layanan" => "Yogyakarta, Solo, Bali (Nusa Dua), Bandung, Surabaya, Balikpapan, Jakarta",
                "biaya_standar" => "Rp 2.950.000 / pax (Paket 3D2N Hotel Bintang 4)",
                "biaya_batch" => "Rp 3.850.000 / pax (Paket Executive Hotel Bintang 5 + Gala Dinner & Tour)",
                "b2b_min_peserta" => "30 hingga 250 peserta eksekutif",
                "inaproc_relevance" => "Kualifikasi pengadaan resmi BUMN melalui e-Procurement dan PADI UMKM BUMN.",
                "city_mentions" => [
                    "Yogyakarta",
                    "Solo",
                    "Bali",
                    "Bandung",
                    "Surabaya",
                    "Balikpapan",
                    "Jakarta",
                ],
                "companies_mentions" => [
                    "PT Bank Mandiri (Persero) Tbk",
                    "PT Bank Rakyat Indonesia (BRI)",
                    "PT PLN (Persero)",
                    "PT Pelabuhan Indonesia",
                    "PT Telkom Indonesia",
                ],
                "highlight_pillars" => [
                    "Akomodasi Hotel Bintang 4-5 Mewah di Pusat Destinasi MICE Unggulan Indonesia",
                    "Setup Plenary Room & Breakout Rooms dengan Sistem Audio Visual Ultra-Modern",
                    "Panggung Megah Backdrop LED Screen P3 untuk Presentasi Target & KPI Korporasi",
                    "Malam Keakraban (Gala Dinner Santai), Executive Tour, & Bus Pariwisata VIP",
                ],
                "deskripsi_lengkap" => "Rapat Kerja Tahunan (Raker) dan Kick-Off Meeting Korporasi adalah momen paling krusial dalam kalender bisnis sebuah organisasi. Di sinilah Dewan Direksi dan pimpinan unit bisnis dari seluruh nusantara berkumpul untuk mengevaluasi realisasi target tahun lalu, membedah peta persaingan pasar, dan menyepakati target Key Performance Indicator (KPI) tahun mendatang. Menyelenggarakan Raker tahunan di luar kota seperti Yogyakarta, Solo, Bali, atau Bandung telah terbukti secara ilmiah meningkatkan fokus strategis, mempererat kohesi antar-direksi, dan membangkitkan energi kepemimpinan baru.\\n\\nNamun, mengelola logistik Raker eksekutif yang dihadiri oleh jajaran direksi, komisaris, dan ratusan kepala cabang menuntut kesempurnaan eksekusi: mulai dari ketepatan waktu penjemputan VIP di bandara, kestabilan jaringan internet untuk presentasi data finansial rahasia, privasi ruang rapat pleno, hingga transisi mulus ke malam gala dinner santai.\\n\\nWahana Totalita Konsultan adalah mitra tepercaya korporasi dan perbankan terkemuka dalam menyelenggarakan Raker Tahunan bergengsi. Kami mengelola seluruh rantai kebutuhan acara secara terintegrasi (turn-key service): negosiasi harga korporat hotel bintang 5 terbaik, instalasi layar LED raksasa dengan animasi grafis pembuka yang memukau, pembagian ruang sidang komisi (breakout rooms), penyusunan naskah MC dwibahasa, hingga penyelenggaraan acara santai pelepas penat seperti Lava Tour Jeep Merapi atau Gala Dinner bernuansa budaya lokal.",
                "spesifikasi_teknis" => [
                    [
                        "item" => "Ballroom Pleno",
                        "spek" => "Grand Ballroom Hotel Bintang 4/5, Setup Classroom Luas dengan Meja Eksekutif Linen Tebal",
                    ],
                    [
                        "item" => "Breakout Rooms",
                        "spek" => "3-6 Ruang Rapat Tambahan untuk Pembahasan Komisi Bisnis / Divisi Kerja",
                    ],
                    [
                        "item" => "Visual Display",
                        "spek" => "Layar LED Screen P3 High-Definition Lebar 8-12 Meter, Sistem Switcher Multi-Laptop Presenter",
                    ],
                    [
                        "item" => "Transportasi VIP",
                        "spek" => "Armada Bus Pariwisata Eksekutif AC Seat 2-2 & Mobil Toyota Alphard / Innova Reborn untuk Direksi",
                    ],
                ],
                "susunan_acara" => [
                    [
                        "fase" => "Hari 1 - 12.00 - 15.00",
                        "agenda" => "Penjemputan VIP Delegasi di Bandara, Check-in Kamar Hotel Bintang 4/5, Welcome Refreshment",
                    ],
                    [
                        "fase" => "Hari 1 - 16.00 - 18.00",
                        "agenda" => "Opening Ceremony Raker: Keynote Speech Direktur Utama & Pemutaran Video Kilas Balik Pencapaian Perusahaan",
                    ],
                    [
                        "fase" => "Hari 1 - 19.00 - 21.00",
                        "agenda" => "Welcome Dinner Santai di Poolside / Restoran Heritage Hotel",
                    ],
                    [
                        "fase" => "Hari 2 - 08.30 - 12.00",
                        "agenda" => "Sesi Sidang Pleno I: Pemaparan Strategi Korporasi, Target Keuangan, & Arah Kebijakan Dewan Komisaris",
                    ],
                    [
                        "fase" => "Hari 2 - 13.00 - 17.30",
                        "agenda" => "Sesi Sidang Komisi (Breakout Session): Pembahasan Rinci Target KPI per Direktorat / Wilayah Kerja",
                    ],
                    [
                        "fase" => "Hari 2 - 19.30 - 22.00",
                        "agenda" => "Gala Dinner Keakraban, Penyerahan Penghargaan Cabang Berkinerja Terbaik, Live Band Performance",
                    ],
                    [
                        "fase" => "Hari 3 - 08.30 - 11.30",
                        "agenda" => "Pleno Penandatanganan Komitmen Target KPI Bersama Seluruh Kepala Divisi, Closing Remarks, Check-out",
                    ],
                ],
                "deliverables_output" => [
                    "Buku Prosiding Kompilasi Ketetapan Raker Tahunan Resmi untuk Panduan Kerja Seluruh Cabang",
                    "Video Dokumentasi Raker Sinematik 4K & Foto Bersama Direksi Bingkai Eksklusif",
                    "Flashdisk Kartu Nama Eksklusif Berisi Seluruh Materi Presentasi Direksi",
                    "Dokumen Penagihan B2B Lengkap: SPK, BAST, Laporan Kegiatan Berjilid, dan Faktur Pajak PPh 23",
                ],
                "faqs" => [
                    [
                        "q" => "Apakah Wahana Totalita bisa membantu memilihkan hotel bintang 5 dengan akses ballroom privat di Jogja atau Bali?",
                        "a" => "Tentu. Kami memiliki kontrak rekanan korporat dengan jaringan hotel bintang 5 ternama (seperti Hyatt Regency, Tentrem, Marriott, Alila, Mulia Bali, dll.) dengan harga korporasi kompetitif.",
                    ],
                    [
                        "q" => "Bagaimana dengan kerahasiaan data keuangan perusahaan selama sesi presentasi raker?",
                        "a" => "Kami menjamin kerahasiaan 100%. Tim teknis audiovisual kami menandatangani Non-Disclosure Agreement (NDA) resmi dan mengamankan jalur transfer file presentasi.",
                    ],
                    [
                        "q" => "Bisakah di hari terakhir diselipkan agenda city tour atau belanja oleh-oleh khas daerah?",
                        "a" => "Sangat bisa. Kami menyediakan itinerary fleksibel yang mencakup kunjungan ke sentra cenderamata khas atau wisata heritage sebelum pengantaran ke bandara.",
                    ],
                ],
            ],
            'executive-board-retreat-bod-boc' => [
                "slug" => "executive-board-retreat-bod-boc",
                "judul" => "Executive Board Retreat (BOD & BOC Strategic Meeting Resort Bintang 5)",
                "kategori" => "corporate-meetings",
                "kategori_label" => "Corporate Strategy & Meetings",
                "tagline" => "Rapat strategis privat dewan direksi & komisaris: luxury private villa / resort bintang 5, fine dining, kerahasiaan tinggi, dan fasilitas VVIP.",
                "meta_title" => "Executive Board Retreat BOD BOC — Tempat Rapat Direksi & Komisaris BUMN",
                "meta_desc" => "Jasa penyelenggara executive board retreat BOD & BOC BUMN dan korporasi di luxury resort Yogyakarta, Bali, Magelang & Bandung. Privasi tinggi, fine dining & mobil VIP.",
                "keywords" => [
                    "executive board retreat bod boc",
                    "tempat rapat direksi komisaris bumn private",
                    "eo retreat pimpinan perusahaan",
                    "luxury boardroom resort bintang 5",
                    "rapat strategis rahasia direksi",
                    "exclusive executive meeting planner",
                ],
                "target_klien" => "Dewan Direksi (BOD), Dewan Komisaris (BOC), Komite Audit, dan Pemegang Saham Utama Korporasi.",
                "durasi_event" => "2 Hari 1 Malam (2D1N) atau 3 Hari 2 Malam (3D2N) Format Eksklusif Privat",
                "lokasi_layanan" => "Yogyakarta, Magelang (Borobudur Luxury), Bali (Ubud / Nusa Dua), Bandung, Bogor",
                "biaya_standar" => "Rp 65.000.000 / paket pertemuan privat (10-15 orang)",
                "biaya_batch" => "Rp 145.000.000 / paket all-in luxury retreat (+ Villa Mewah & Private Dining)",
                "b2b_min_peserta" => "8 hingga 20 orang pimpinan puncak",
                "inaproc_relevance" => "Kualifikasi pengadaan jasa rapat eksekutif BUMN & korporasi dengan standar tata kelola Good Corporate Governance (GCG).",
                "city_mentions" => [
                    "Yogyakarta",
                    "Magelang",
                    "Bali",
                    "Bandung",
                    "Bogor",
                    "Jakarta",
                    "Solo",
                ],
                "companies_mentions" => [
                    "BUMN Perbankan",
                    "Holding BUMN Energi",
                    "Perusahaan Investasi / Private Equity",
                    "Konglomerasi Multinasional",
                ],
                "highlight_pillars" => [
                    "Lokasi Privat Terpencil yang Menjamin Kerahasiaan 100% dari Paparan Publik & Media",
                    "Akomodasi Luxury Villa / Suite Room Resort Bintang 5 Bernuansa Alam Menenangkan",
                    "Fasilitas Rapat Boardroom Kedap Suara dengan Layar Presentasi OLED Ultra-Jernih",
                    "Pengalaman Kuliner Fine Dining Privat Bersama Chef Ternama & Transportasi Alphard VIP",
                ],
                "deskripsi_lengkap" => "Keputusan-keputusan paling fundamental sebuah korporasi—seperti akuisisi perusahaan, merger anak usaha, restrukturisasi utang triliunan rupiah, hingga suksesi kepemimpinan puncak—tidak pernah dibahas di ruang rapat kantor biasa yang rentan kebocoran informasi. Dewan Direksi (Board of Directors) dan Dewan Komisaris (Board of Commissioners) membutuhkan lingkungan pertemuan yang menawarkan privasi absolut, ketenangan batin, serta kenyamanan tingkat tinggi yang memungkinkan pemikiran reflektif mendalam.\\n\\nExecutive Board Retreat adalah seni meramu pertemuan formal dengan relaksasi kelas atas. Keberhasilan acara ini sangat bergantung pada detail-detail tak kasat mata: kesiapan tim pelayanan yang tidak mencolok (discreet service), kerahasiaan materi cetak rapat, pengaturan suhu ruangan yang sempurna, hingga sajian kuliner bergizi tinggi yang menjaga stamina para pengambil keputusan.\\n\\nWahana Totalita merancang Executive Board Retreat di destinasi peristirahatan paling prestisius di Indonesia: mulai dari resort lereng bukit Menoreh Magelang berlatar Candi Borobudur, villa privat tebing Nusa Dua Bali, hingga resort asri Kaliurang Yogyakarta. Kami memastikan setiap pimpinan mendapatkan kendaraan jemputan privat Toyota Alphard, ruang rapat tertutup dengan pengamanan sinyal, naskah notulensi rapat yang dikunci enkripsi, dan jamuan santap malam privat (Private Chef Dining) yang berkelas dunia.",
                "spesifikasi_teknis" => [
                    [
                        "item" => "Venue Pertemuan",
                        "spek" => "Private Presidential Villa / Luxury Boardroom Kedap Suara dengan Pemandangan Alam Asri",
                    ],
                    [
                        "item" => "Peralatan Presentasi",
                        "spek" => "TV Display OLED 85 Inch 4K, Wireless Encrypted Screen Sharing, Sistem Audio Jernih Bertenaga Halus",
                    ],
                    [
                        "item" => "Transportasi VVIP",
                        "spek" => "Kendaraan Pribadi Toyota Alphard / Vellfire Terbaru untuk Setiap Anggota Dewan Direksi",
                    ],
                    [
                        "item" => "Layanan Jamuan",
                        "spek" => "Private Butler Service, Customized Fine Dining 5-Course Menu oleh Executive Chef Bintang 5",
                    ],
                ],
                "susunan_acara" => [
                    [
                        "fase" => "Hari 1 - 13.00 - 15.00",
                        "agenda" => "Penjemputan Privat Bandara menggunakan Alphard VIP, Check-in Presidential Suite / Luxury Villa",
                    ],
                    [
                        "fase" => "Hari 1 - 15.30 - 18.00",
                        "agenda" => "Sesi Refleksi I: Dialog Terbuka Santai mengenai Dinamika Makroekonomi & Visi Jangka Panjang Korporasi",
                    ],
                    [
                        "fase" => "Hari 1 - 19.00 - 21.30",
                        "agenda" => "Private Fine Dining Bersama Dewan Komisaris di Gazebo Tertutup bernuansa Gemericik Air",
                    ],
                    [
                        "fase" => "Hari 2 - 08.30 - 12.00",
                        "agenda" => "Sidang Strategis Tertutup (Executive Session): Pengambilan Keputusan Krusial & Arah Investasi",
                    ],
                    [
                        "fase" => "Hari 2 - 13.00 - 15.30",
                        "agenda" => "Sesi Sinergi Harmonisasi BOD-BOC, Pengesahan Risalah Rapat Direksi, Penutupan Acara",
                    ],
                    [
                        "fase" => "Hari 2 - 16.00 - 17.30",
                        "agenda" => "Pengantaran VVIP Kembali ke Bandara Menuju Jakarta",
                    ],
                ],
                "deliverables_output" => [
                    "Risalah Rapat Direksi & Dewan Komisaris Terenkripsi dengan Standar Kerahasiaan Tingkat Tinggi",
                    "Dokumentasi Foto Eksklusif Cetak Terbatas Khusus Arsip Sekretariat Perusahaan (Corsec)",
                    "Paket Penginapan & Jamuan All-In Tanpa Rincian yang Membingungkan",
                    "Dokumen Penagihan Resmi: SPK, BAST, Kuitansi, dan Faktur Pajak PPh 23",
                ],
                "faqs" => [
                    [
                        "q" => "Bagaimana Wahana Totalita menjamin kerahasiaan materi rapat direksi yang bersifat rahasia negara / pasar modal?",
                        "a" => "Seluruh personel kami terikat pakta kerahasiaan hukum (NDA). Materi cetak hanya dicetak di lokasi dan seluruh draf sisa langsung dimusnahkan dengan paper shredder di hadapan Corsec.",
                    ],
                    [
                        "q" => "Apakah menu makanan bisa disesuaikan dengan pantangan diet kesehatan masing-masing direktur?",
                        "a" => "Ya, sebelum acara dimulai kami meminta profil diet khusus (misal: rendah garam, bebas gluten, vegetarian, atau ramah diabetes) yang akan dimasak khusus oleh chef pribadi.",
                    ],
                    [
                        "q" => "Berapa kapasitas peserta ideal untuk program executive retreat ini?",
                        "a" => "Jumlah peserta paling ideal adalah antara 8 hingga 15 orang agar tercipta suasana percakapan yang intim, mendalam, dan bebas sekat formalitas yang kaku.",
                    ],
                ],
            ],
            'national-sales-conference-nsm' => [
                "slug" => "national-sales-conference-nsm",
                "judul" => "National Sales Conference (NSM) & Marketing Kick-Off Meeting",
                "kategori" => "corporate-meetings",
                "kategori_label" => "Corporate Strategy & Meetings",
                "tagline" => "Konferensi pemicu semangat tim penjualan: panggung berenergi tinggi, visual hitung mundur target, live DJ/band energizer, dan sales awarding night.",
                "meta_title" => "EO National Sales Conference (NSM) & Marketing Kick-Off — Vendor Konvensi Penjualan",
                "meta_desc" => "Event organizer national sales conference (NSM) & kick-off marketing perusahaan di Jakarta, Jogja, Surabaya & Bali. Panggung energik, LED visual target & sales awards.",
                "keywords" => [
                    "national sales conference nsm eo",
                    "kick off meeting marketing perusahaan",
                    "sales convention awards night",
                    "eo temu wiraniaga nasional",
                    "paket nsm gathering hotel",
                    "vendor konvensi penjualan bumn swasta",
                ],
                "target_klien" => "Sales Director, Marketing VP, Commercial Head Perusahaan Fast Moving Consumer Goods (FMCG), Farmasi, Otomotif, Perbankan, dan Properti.",
                "durasi_event" => "2 Hari 1 Malam (2D1N) atau 3 Hari 2 Malam (3D2N)",
                "lokasi_layanan" => "Yogyakarta, Surabaya, Jakarta, Bali, Solo, Semarang, Medan",
                "biaya_standar" => "Rp 65.000.000 / paket produksi panggung energik (150 pax)",
                "biaya_batch" => "Rp 150.000.000 – Rp 275.000.000 / paket all-in konvensi akbar (300 - 600 sales force)",
                "b2b_min_peserta" => "100 hingga 1.000 wiraniaga / sales force",
                "inaproc_relevance" => "Kualifikasi pengadaan profesional sektor korporasi BUMN perbankan, telekomunikasi, dan swasta multinasional.",
                "city_mentions" => [
                    "Yogyakarta",
                    "Surabaya",
                    "Jakarta",
                    "Bali",
                    "Solo",
                    "Semarang",
                    "Medan",
                ],
                "companies_mentions" => [
                    "Industri Farmasi & Healthcare",
                    "Perusahaan FMCG Nasional",
                    "Perbankan & Asuransi",
                    "Distributor Otomotif",
                    "Telekomunikasi",
                ],
                "highlight_pillars" => [
                    "Panggung Pemicu Semangat (High-Energy Motivational Stage) dengan Desain Visual Futuristik",
                    "Efek Khusus Spektakuler: Cold Fireworks / Sparks, CO2 Jet, Confetti Cannons, & Sound Bombastis",
                    "Sesi Sales Awarding Night: Penyerahan Cincin Emas, Plakat Champion, & Doorprize Kendaraan",
                    "Motivational Speaker Ternama & Aktivasi Yel-Yel Kebangkitan Target Penjualan",
                ],
                "deskripsi_lengkap" => "Para pejuang garis depan penjualan (Sales Force) adalah ujung tombak pendapatan perusahaan. Menghadapi target omzet tahunan yang terus meningkat di tengah kompetisi pasar yang agresif, tenaga penjual membutuhkan lebih dari sekadar angka-angka di slide Excel. Mereka membutuhkan suntikan motivasi yang meledak-ledak, rasa bangga atas pencapaian tahun lalu, dan keyakinan mental baja bahwa target kuota baru dapat ditembus bersama-sama.\\n\\nNational Sales Conference (NSM) atau Annual Sales Convention adalah panggung pembuktian bagi sang juara. Desain acara yang monoton, ruangan yang redup, atau pembawa acara yang pasif akan membunuh energi para wiraniaga.\\n\\nWahana Totalita Konsultan merancang National Sales Conference dengan standar produksi konser energi tinggi. Kami menggabungkan instalasi panggung futuristik, efek pencahayaan moving head yang dinamis, video visual intro hitung mundur target miliaran rupiah di layar LED raksasa, dentuman musik energik pengiring setiap pengumuman pemenang Sales Champion, hingga semburan confetti dan kembang api dingin (cold pyro) saat target korporasi dideklarasikan.\\n\\nSetiap wiraniaga yang melangkah keluar dari ruangan konvensi akan membawa semangat membara dan komitmen tanpa batas untuk memenangkan pasar di wilayah masing-masing.",
                "spesifikasi_teknis" => [
                    [
                        "item" => "Panggung Konvensi",
                        "spek" => "Panggung Lebar 14-18 Meter dengan Runway Catwalk untuk Juara Sales, Backdrop LED P3 Curved",
                    ],
                    [
                        "item" => "Special Effects (SFX)",
                        "spek" => "4x Cold Spark Machine (Kembang Api Dingin Indoor Aman), 4x CO2 Jet Cannon, 2x Confetti Blower",
                    ],
                    [
                        "item" => "Tata Suara & Musik",
                        "spek" => "Line Array Sound System 15.000 Watt Bass Bertenaga, DJ Set / Live Band Musik Energizer",
                    ],
                    [
                        "item" => "Piala Juara Sales",
                        "spek" => "Piala Bergilir Emas Raksasa, Plakat Juara Logam Grafir 3D, Mock-Up Kunci Cek Raksasa",
                    ],
                ],
                "susunan_acara" => [
                    [
                        "fase" => "Hari 1 - 13.00 - 15.30",
                        "agenda" => "Kedatangan Tim Sales se-Indonesia, Yel-Yel Penyambutan di Foyer, Registrasi ID Badge Champion",
                    ],
                    [
                        "fase" => "Hari 1 - 16.00 - 17.30",
                        "agenda" => "Opening Bombastis: Video Hitung Mundur, Efek CO2 Jet, Tarian Pembuka Energik, Sambutan Sales Director",
                    ],
                    [
                        "fase" => "Hari 1 - 19.30 - 22.30",
                        "agenda" => "Sales Awarding Night: Penganugerahan Top Sales, Best Branch Manager, Rookie of the Year, Live DJ Performance",
                    ],
                    [
                        "fase" => "Hari 2 - 08.30 - 10.30",
                        "agenda" => "Sesi Motivasi Akbar bersama Pembicara Motivator Nasional Papan Atas",
                    ],
                    [
                        "fase" => "Hari 2 - 10.30 - 12.30",
                        "agenda" => "Pemaparan Strategi Pemasaran Produk Baru & Peluncuran Kampanye Iklan Nasional",
                    ],
                    [
                        "fase" => "Hari 2 - 13.30 - 15.00",
                        "agenda" => "Deklarasi Janji Target Omzet Korporasi, Hujan Confetti Kebersamaan, & Penutupan",
                    ],
                ],
                "deliverables_output" => [
                    "Piala Bergilir Champion, Plakat Penghargaan Wiraniaga Terbaik, & Sertifikat Prestasi Penjualan",
                    "Video Highlight Acara Berkecepatan Tinggi (Same-Day Edit Video) untuk Segera Dibagikan ke Status Medsos Karyawan",
                    "Dokumentasi Foto Aksi Panggung Lengkap dengan Backdrop Foto Booth 360",
                    "Dokumen Penagihan B2B Lengkap: SPK, BAST, Laporan Kegiatan, dan Faktur Pajak PPh 23",
                ],
                "faqs" => [
                    [
                        "q" => "Apakah efek kembang api dingin (cold spark) dan CO2 jet aman digunakan di dalam ballroom hotel?",
                        "a" => "Sangat aman. Cold spark machine kami tidak menggunakan mesiu, tidak menghasilkan panas membakar, dan tidak memicu detektor asap hotel (smoke detector).",
                    ],
                    [
                        "q" => "Bisakah Wahana Totalita membantu mengundang motivator penjualan nasional ternama?",
                        "a" => "Ya, kami memiliki jaringan kerja sama langsung dengan deretan pembicara motivasi dan trainer penjualan terkemuka di Indonesia.",
                    ],
                    [
                        "q" => "Apakah acara ini bisa dipadukan dengan sesi peluncuran produk baru (product launch)?",
                        "a" => "Sangat bisa. Kami sering memadukan konvensi sales tahunan dengan unveiling produk baru di atas panggung menggunakan tirai hidrolik atau animasi grafis 3D.",
                    ],
                ],
            ],
            'townhall-meeting-all-hands' => [
                "slug" => "townhall-meeting-all-hands",
                "judul" => "Corporate Townhall Meeting & All-Hands Hybrid Multi-Site",
                "kategori" => "corporate-meetings",
                "kategori_label" => "Corporate Strategy & Meetings",
                "tagline" => "Rapat akbar komunikasi direksi & karyawan: siaran langsung multi-site tanpa delay, studio panggung interaktif, dan sesi Q&A digital transparan.",
                "meta_title" => "EO Townhall Meeting Perusahaan & All-Hands Hybrid — Siaran Multi-Cabang",
                "meta_desc" => "Jasa EO corporate townhall meeting & all-hands hybrid di Jakarta, Jogja, Surabaya & site industri. Panggung studio, siaran multi-site tanpa lag, Q&A digital & direksi.",
                "keywords" => [
                    "eo townhall meeting perusahaan",
                    "all hands meeting hybrid multisite",
                    "vendor live streaming rapat akbar karyawan",
                    "paket townhall bumn jakarta jogja",
                    "broadcast multi cabang perusahaan",
                    "rapat akbar komunikasi direksi karyawan",
                ],
                "target_klien" => "Internal Communication, Corporate Secretary, HR Division, dan Dewan Direksi Perusahaan dengan Cabang/Pabrik Tersebar di Indonesia.",
                "durasi_event" => "Halfday (3-4 Jam) Format Siaran Langsung Hybrid",
                "lokasi_layanan" => "Studio Utama di Jakarta / Yogyakarta / Surabaya dengan Sambungan Multi-Site Seluruh Indonesia",
                "biaya_standar" => "Rp 35.000.000 / paket broadcast multi-site standar",
                "biaya_batch" => "Rp 75.000.000 / paket panggung studio LED + 5 titik sambungan interaktif luar pulau",
                "b2b_min_peserta" => "Audience fisik 100 - 300 pax + ribuan peserta daring via platform internal",
                "inaproc_relevance" => "Kualifikasi pengadaan jasa teknologi informasi & komunikasi korporat BUMN dan swasta.",
                "city_mentions" => [
                    "Jakarta",
                    "Yogyakarta",
                    "Surabaya",
                    "Balikpapan",
                    "Medan",
                    "Makassar",
                    "Cilegon",
                ],
                "companies_mentions" => [
                    "Perusahaan Startup Teknologi & Fintech",
                    "BUMN Telekomunikasi",
                    "Perbankan Nasional",
                    "Holding Pertambangan",
                    "FMCG Multisite",
                ],
                "highlight_pillars" => [
                    "Infrastruktur Jaringan Internet Dedicated Bebas Gangguan dengan Backup Redundant Simultan",
                    "Setup Studio Panggung Modern Berlatar Belakang LED Screen & Tata Lampu Broadcast TV",
                    "Integrasi Siaran Multi-Titik Interaktif Dua Arah (Jakarta, Pabrik Jawa, Site Tambang Luar Jawa)",
                    "Sistem Tanya Jawab Anonim Digital Interaktif (Slido / Mentimeter) Tanpa Rasa Takut",
                ],
                "deskripsi_lengkap" => "Transparansi komunikasi dari Dewan Direksi ke seluruh jajaran karyawan di berbagai cabang, depo, dan pabrik terpencil adalah pilar utama budaya kerja modern. Corporate Townhall Meeting atau All-Hands Meeting berkala diadakan agar pimpinan puncak dapat menyampaikan kondisi keuangan terkini, arah strategi baru, meredam rumor restrukturisasi, serta mendengar aspirasi langsung dari pekerja di garis terdepan.\\n\\nNamun, menggelar Townhall hybrid yang menghubungkan kantor pusat di Jakarta dengan pabrik di Cilegon, smelter di Morowali, dan kantor cabang di Balikpapan dan Medan membutuhkan keandalan teknologi tingkat tinggi. Delay audio yang mengganggu, tayangan video yang patah-patah, atau kendala mikrofon saat sesi tanya jawab akan menghancurkan kewibawaan acara.\\n\\nWahana Totalita menyediakan solusi produksi Corporate Townhall & All-Hands Hybrid bertaraf stasiun televisi. Kami membangun panggung studio megah di lokasi sentral lengkap dengan pencahayaan broadcast anti-silau, mengerahkan sistem video switching multi-kamera, menyediakan koneksi internet satelit/fiber optik dedicated dengan jalur cadangan instan, serta menyambungkan interaksi dua arah secara real-time tanpa jeda.\\n\\nDengan integrasi platform Q&A digital, karyawan dari seluruh penjuru Indonesia dapat mengajukan pertanyaan kritis secara transparan dan dijawab lugas oleh jajaran direksi.",
                "spesifikasi_teknis" => [
                    [
                        "item" => "Studio Staging",
                        "spek" => "Panggung Studio Minimalis Modern, Sofa Eksekutif Direksi, Meja Barstool Kaca, LED Backdrop P2.5",
                    ],
                    [
                        "item" => "Broadcast Video",
                        "spek" => "3x Kamera Studio Broadcast Full HD dengan Lensa Telefoto, Teleprompter Kaca untuk Direksi",
                    ],
                    [
                        "item" => "Koneksi Internet",
                        "spek" => "Internet Dedicated Bandwidth 100 Mbps Simetris 1:1 dengan Backup Failover 4G/Satelit",
                    ],
                    [
                        "item" => "Platform Interaktif",
                        "spek" => "Integrasi Akun Enterprise Zoom Webinar / MS Teams / YouTube Private, Layar Moderasi Q&A Digital",
                    ],
                ],
                "susunan_acara" => [
                    [
                        "fase" => "09.00 - 09.30",
                        "agenda" => "Pengecekan Sambungan Teknis (Sound & Video Check) dengan Seluruh Kantor Cabang / Site Luar Pulau",
                    ],
                    [
                        "fase" => "09.30 - 09.35",
                        "agenda" => "Video Opening Bumper Animasi Korporasi, Sambutan Pembawa Acara (MC Internal)",
                    ],
                    [
                        "fase" => "09.35 - 10.15",
                        "agenda" => "Pemaparan Utama Direktur Utama: Kinerja Finansial, Milestone Pencapaian, & Fokus Prioritas Kuartal Ini",
                    ],
                    [
                        "fase" => "10.15 - 10.45",
                        "agenda" => "Pemaparan Direksi Terkait (Operasional, SDM, Keuangan) mengenai Kebijakan Baru Karyawan",
                    ],
                    [
                        "fase" => "10.45 - 11.45",
                        "agenda" => "Sesi Tanya Jawab Terbuka (Ask Me Anything): Interaksi Langsung Karyawan Site & Pertanyaan Terpilih dari Aplikasi",
                    ],
                    [
                        "fase" => "11.45 - 12.00",
                        "agenda" => "Pesan Penutup Penuh Inspirasi dari Direksi, Pengumuman Karyawan Beruntung Doorprize, Penutupan Acara",
                    ],
                ],
                "deliverables_output" => [
                    "Master Rekaman Video Broadcast Full HD Lengkap dengan Grafis Nama Direksi & Paparan Slide",
                    "Laporan Analisis Partisipasi Karyawan (Attendance Rate, Engagement Metric, & Arsip Pertanyaan Q&A)",
                    "Klip Video Ringkasan 2 Menit (Highlight Reels) untuk Diunggah di Portal Komunikasi Internal",
                    "Dokumen Penagihan Resmi B2B: SPK, BAST, Laporan Pelaksanaan, dan Faktur Pajak PPh 23",
                ],
                "faqs" => [
                    [
                        "q" => "Apakah siaran townhall dijamin aman dari kebocoran ke pihak luar perusahaan?",
                        "a" => "Sangat aman. Kami menggunakan server streaming private berenkripsi tinggi yang diproteksi password atau Single Sign-On (SSO) email korporat internal.",
                    ],
                    [
                        "q" => "Bisakah staf di site tambang terpencil yang sinyalnya terbatas tetap ikut menyaksikan?",
                        "a" => "Bisa. Sistem kami menyediakan fitur adaptive bitrate streaming yang otomatis menyesuaikan resolusi video ke koneksi internet terendah agar audio tetap terdengar jernih tanpa putus.",
                    ],
                    [
                        "q" => "Apakah disediakan teleprompter agar direktur tidak perlu menunduk membaca catatan saat berbicara?",
                        "a" => "Ya, kami menyediakan teleprompter kaca profesional tepat di depan lensa kamera sehingga tatapan direktur selalu terhubung mantap ke hadapan karyawan.",
                    ],
                ],
            ],
            'annual-employee-gathering' => [
                "slug" => "annual-employee-gathering",
                "judul" => "Corporate Annual Employee Gathering & Family Day Nasional",
                "kategori" => "milestone-gala",
                "kategori_label" => "Milestones, Ceremonies & Galas",
                "tagline" => "Pesta kebersamaan karyawan & keluarga: konsep tematik outdoor/indoor, panggung hiburan megah, fun team bonding, doorprize akbar, dan bazaar kuliner.",
                "meta_title" => "EO Annual Employee Gathering & Family Day Perusahaan — Vendor Acara Nasional",
                "meta_desc" => "Event organizer annual employee gathering & family day perusahaan di Yogyakarta, Solo, Bali, Bandung & Malang. Konsep tematik, panggung musik, doorprize & anak.",
                "keywords" => [
                    "paket annual gathering perusahaan nasional",
                    "eo employee gathering jawa bali",
                    "family gathering perusahaan besar",
                    "eo family day bumn",
                    "paket gathering karyawan menginap",
                    "vendor acara keakraban perusahaan",
                ],
                "target_klien" => "Serikat Pekerja, Panitia HUT Perusahaan, Divisi HR & GA BUMN, dan Korporasi Swasta Berskala 200 hingga 3.000 Peserta.",
                "durasi_event" => "1 Hari Acara (One-Day Picnic) atau 2 Hari 1 Malam (Residential Gathering)",
                "lokasi_layanan" => "Yogyakarta, Solo, Bali, Bandung, Malang/Batu, Bogor, Semarang, Surabaya",
                "biaya_standar" => "Rp 75.000.000 / paket gathering lokal (200 pax)",
                "biaya_batch" => "Rp 175.000.000 – Rp 450.000.000 / paket gathering akbar keluarga (500 - 1.500 pax)",
                "b2b_min_peserta" => "150 hingga 3.000 orang karyawan beserta keluarga",
                "inaproc_relevance" => "Kualifikasi pengadaan jasa penyelenggaraan acara kesejahteraan pegawai terdaftar resmi di SPSE & PADI UMKM.",
                "city_mentions" => [
                    "Yogyakarta",
                    "Solo",
                    "Bali",
                    "Bandung",
                    "Malang",
                    "Bogor",
                    "Semarang",
                    "Surabaya",
                ],
                "companies_mentions" => [
                    "PT Kereta Api Indonesia",
                    "PT Semen Gresik",
                    "PT Bio Farma",
                    "Bank BNI",
                    "Perusahaan Manufaktur",
                ],
                "highlight_pillars" => [
                    "Tema Acara Unik & Kreatif (Misal: Nusantara Heritage, Tropical Carnival, Retro Festival)",
                    "Panggung Hiburan Konser Musik Spektakuler dengan Tata Suara 20.000 Watt & Bintang Tamu",
                    "Kids Corner & Fun Games Edukatif Aman untuk Anak-Anak Balita hingga Remaja",
                    "Sistem Pengundian Doorprize Digital Otomatis yang Fair, Cepat, dan Transparan",
                ],
                "deskripsi_lengkap" => "Rutinitas kerja yang padat selama setahun penuh sering kali menguras energi mental karyawan dan menciptakan kejenuhan di tempat kerja. Annual Employee Gathering dan Family Day adalah investasi kebahagiaan terbesar yang dapat diberikan perusahaan kepada karyawannya. Mengajak karyawan beserta pasangan dan anak-anak berkumpul di lingkungan terbuka yang asri menghadirkan rasa kebersamaan yang tulus, mencairkan sekat hierarki jabatan, dan menumbuhkan rasa bangga mendalam terhadap almamater perusahaan.\\n\\nNamun, mengelola acara massal yang dihadiri oleh ratusan anak-anak, ibu-ibu, dan para pekerja menuntut kesiapan manajemen kerumunan (crowd management) dan standar keselamatan yang sangat ketat: mulai dari tenda peneduh yang luas, ketersediaan posko medis darurat, toilet portabel yang bersih, hingga katering makanan yang lezat dan berlimpah tanpa antrean mengular.\\n\\nWahana Totalita Konsultan adalah spesialis penyelenggaraan Employee Gathering & Family Day berskala ratusan hingga ribuan peserta di berbagai destinasi wisata terkemuka di Jawa dan Bali. Kami menghadirkan atmosfer karnaval yang meriah: panggung musik megah dengan bintang tamu artis ternama, zona permainan anak (bouncy castle, mini outbound edukatif, face painting), stan jajanan pasar tradisional Nusantara, sistem undian doorprize digital yang mendebarkan, hingga cinderamata berkesan yang dibawa pulang ke rumah.",
                "spesifikasi_teknis" => [
                    [
                        "item" => "Panggung Konser",
                        "spek" => "Panggung Rigging Outdoor 12x10 Meter, Cover Atap Terpal Tebal, Backdrop Printing Raksasa / LED",
                    ],
                    [
                        "item" => "Tata Suara & Musik",
                        "spek" => "Line Array Sound System 20.000 Watt, Instrumen Band Lengkap, Monitor Stage, Wireless Mic Shure",
                    ],
                    [
                        "item" => "Kids Playland Zone",
                        "spek" => "2x Istana Balon Raksasa (Bouncy Castle), Arena Mandi Bola, Tenda Mewarnai & Kerajinan Tangan Anak",
                    ],
                    [
                        "item" => "Keamanan & Medis",
                        "spek" => "Posko Medis Lengkap dengan Dokter Siaga & Ambulans, Tim Pengamanan Internal Crowd Control",
                    ],
                ],
                "susunan_acara" => [
                    [
                        "fase" => "07.30 - 08.30",
                        "agenda" => "Kedatangan Rombongan Karyawan & Keluarga, Registrasi Gelang Barcode, Pembagian Snack Box & Kupon Doorprize",
                    ],
                    [
                        "fase" => "08.30 - 09.15",
                        "agenda" => "Senam Pagi Bersama (Zumba / Senam Ceria), Tarian Pembuka Maskot Perusahaan, Sambutan Direktur Utama",
                    ],
                    [
                        "fase" => "09.15 - 11.30",
                        "agenda" => "Aktivitas Kebersamaan: Fun Family Games Antar-Keluarga, Pembukaan Zona Bazar Makanan & Kids Playland",
                    ],
                    [
                        "fase" => "11.30 - 13.00",
                        "agenda" => "Makan Siang Bersama Menu Spesial Nusantara & Sholat Berjamaah",
                    ],
                    [
                        "fase" => "13.00 - 15.00",
                        "agenda" => "Konser Musik Bintang Tamu, Pengundian Doorprize Elektronik, Sepeda Motor & Hadiah Utama Mobil",
                    ],
                    [
                        "fase" => "15.00 - 15.30",
                        "agenda" => "Pengumuman Juara Kostum Terbaik, Foto Bersama Seluruh Keluarga Besar, Pelepasan Balon Cita-Cita",
                    ],
                ],
                "deliverables_output" => [
                    "Sistem Pengundian Doorprize Digital Terverifikasi dengan Rekapitulasi Data Pemenang Otomatis",
                    "Video Dokumenter Family Day Penuh Keceriaan Resolusi 4K dengan Pengambilan Gambar Drone Udara",
                    "Album Foto Dokumentasi Digital Beresolusi Tinggi Siap Akses untuk Seluruh Karyawan",
                    "Dokumen Administrasi B2B Lengkap: SPK, BAST, Laporan Kegiatan Berjilid, dan Faktur Pajak PPh 23",
                ],
                "faqs" => [
                    [
                        "q" => "Apakah lokasi gathering ramah untuk lansia dan anak-anak balita?",
                        "a" => "Pasti. Kami selalu memilih venue dengan kontur tanah datar, bebas becek, memiliki banyak area teduh, dan akses jalur kursi roda / stroller yang aman.",
                    ],
                    [
                        "q" => "Bagaimana jika saat acara berlangsung tiba-tiba turun hujan lebat?",
                        "a" => "Kami selalu menerapkan protokol kontinjensi cuaca (weather contingency plan): menyediakan tenda peneduh kapasitas 100% peserta atau memilih venue dengan kombinasi area semi-indoor yang memadai.",
                    ],
                    [
                        "q" => "Bisakah Wahana Totalita membantu pengadaan doorprize seperti sepeda motor dan alat elektronik?",
                        "a" => "Bisa. Kami dapat mengurus pengadaan seluruh barang doorprize, pembungkusan pita hadiah, hingga pengiriman barang ke alamat pemenang.",
                    ],
                ],
            ],
            'gala-dinner-awarding-night' => [
                "slug" => "gala-dinner-awarding-night",
                "judul" => "Gala Dinner Perusahaan, Malam Apresiasi & Long Service Awards",
                "kategori" => "milestone-gala",
                "kategori_label" => "Milestones, Ceremonies & Galas",
                "tagline" => "Kemegahan malam penganugerahan korporasi: red carpet entry, 360 photobooth, panggung lighting megah, live orchestra/band, dan trofi kristal eksklusif.",
                "meta_title" => "EO Gala Dinner Perusahaan & Long Service Awards — Malam Apresiasi Mewah",
                "meta_desc" => "Jasa EO gala dinner perusahaan & malam penganugerahan masa bakti (Long Service Awards) di hotel bintang 5 Yogyakarta, Solo, Jakarta & Bali. Panggung mewah & orkestra.",
                "keywords" => [
                    "eo gala dinner awards night bumn",
                    "malam apresiasi karyawan panggung mewah",
                    "eo malam penganugerahan perusahaan",
                    "long service award corporate dinner",
                    "sewa ballroom gala dinner bintang 5",
                    "vendor awarding night korporasi",
                ],
                "target_klien" => "Human Capital Directorate, Corporate Secretary, dan Panitia Malam Apresiasi BUMN, Perbankan, dan Perusahaan Multinasional.",
                "durasi_event" => "1 Malam Acara Puncak (18.30 – 22.30 WIB di Grand Ballroom)",
                "lokasi_layanan" => "Yogyakarta, Solo, Jakarta, Bali, Surabaya, Bandung, Semarang",
                "biaya_standar" => "Rp 65.000.000 / paket ballroom menengah (150 pax)",
                "biaya_batch" => "Rp 160.000.000 – Rp 350.000.000 / paket grand ballroom megah (300 - 800 pax)",
                "b2b_min_peserta" => "100 hingga 1.000 tamu undangan kehormatan",
                "inaproc_relevance" => "Kualifikasi pengadaan resmi BUMN melalui tender e-Procurement dan PADI UMKM.",
                "city_mentions" => [
                    "Yogyakarta",
                    "Solo",
                    "Jakarta",
                    "Bali",
                    "Surabaya",
                    "Bandung",
                    "Semarang",
                ],
                "companies_mentions" => [
                    "Bank Mandiri",
                    "PT Telkom Indonesia",
                    "PT Astra International",
                    "PT Pegadaian",
                    "PT Jasa Marga",
                ],
                "highlight_pillars" => [
                    "Prosesi Masuk Karpet Merah VIP Lengkap dengan Instalasi Photo Booth 360 Video Slow-Motion",
                    "Penyerahan Penghargaan Masa Kerja Emas (10, 20, 30 Tahun) & Cincin Logam Mulia / Plakat",
                    "Tata Panggung Teatrikal Mewah Berlayar LED Videotron P3 Lengkap dengan Efek Pencahayaan Megah",
                    "Jamuan Makan Malam Set Menu / Buffet Bintang 5 Diiringi Mini Chamber Orchestra / Live Band Ternama",
                ],
                "deskripsi_lengkap" => "Malam penganugerahan penghargaan masa kerja (Long Service Awards) dan Gala Dinner Perusahaan adalah puncak kehormatan bagi para karyawan yang telah mendedikasikan puluhan tahun hidupnya membesarkan korporasi. Ini adalah malam di mana keringat dan loyalitas diakui secara bermartabat di hadapan keluarga, dewan komisaris, dan dewan direksi. Nuansa elegan, tata meja jamuan makan malam (table setting) yang rapi, dan atmosfer emosional yang menyentuh hati adalah kunci utama suksesnya sebuah malam apresiasi.\\n\\nKesalahan tata suara, presentasi visual nama karyawan yang salah eja, atau alur acara yang kaku dan membosankan akan merusak keindahan momen sakral yang telah ditunggu selama puluhan tahun tersebut.\\n\\nWahana Totalita Konsultan menghadirkan produksi Gala Dinner & Awarding Night berkelas bintang lima. Kami menciptakan pintu masuk spektakuler dengan red carpet walk dan photo booth 360 derajat, video profil kenangan perjalanan karier para wisudawan purnabakti yang menguras air mata haru, prosesi penyerahan pin emas dan trofi kristal yang anggun, hingga jamuan santap malam mewah yang diiringi lantunan musik orkestra atau band ternama.\\n\\nSetiap tamu undangan pulang dengan perasaan bangga, dihargai, dan memiliki ikatan emosional yang semakin tak tergoyahkan kepada perusahaan.",
                "spesifikasi_teknis" => [
                    [
                        "item" => "Grand Ballroom",
                        "spek" => "Grand Ballroom Hotel Bintang 5 dengan Setup Round Table Banquet 8-10 Orang per Meja, Kursi Cover Pita",
                    ],
                    [
                        "item" => "Panggung Teatrikal",
                        "spek" => "Panggung Megah Lebar 16 Meter, Backdrop LED Videotron P3 Curved, Sayap Panggung Desain 3D Custom",
                    ],
                    [
                        "item" => "Tata Cahaya Panggung",
                        "spek" => "Moving Beam 380W, Profile Spotlight, Par LED Ambiance, Ground Fog Machine untuk Prosesi Pengalungan",
                    ],
                    [
                        "item" => "Photo Booth Eksklusif",
                        "spek" => "360 Spin Video Booth dengan Lampu Ring Light LED & Backdrop Floral/Mirror Eksklusif",
                    ],
                    [
                        "item" => "Penghargaan Fisik",
                        "spek" => "Trofi Kristal Optik Grafir 3D Dalam Logo Perusahaan, Bingkai Piagam Beludru Biru/Merah Marun",
                    ],
                ],
                "susunan_acara" => [
                    [
                        "fase" => "18.00 - 19.00",
                        "agenda" => "Kedatangan Tamu Berbusana Formal / Batik Sutra, Red Carpet Walk, Sesi Foto 360 Booth & Canapé Cocktail",
                    ],
                    [
                        "fase" => "19.00 - 19.15",
                        "agenda" => "Opening Video Countdown Megah, Tarian Selamat Datang Kontemporer, Sambutan Direktur Utama",
                    ],
                    [
                        "fase" => "19.15 - 20.00",
                        "agenda" => "Jamuan Santap Malam Spesial 4-Course Dinner / Buffet Mewah Diiringi Alunan Mini Orchestra",
                    ],
                    [
                        "fase" => "20.00 - 21.30",
                        "agenda" => "Prosesi Utama Awarding: Penganugerahan Masa Kerja 10, 20, 30 Tahun, Penyerahan Pin Emas & Trofi oleh Direksi",
                    ],
                    [
                        "fase" => "21.30 - 22.00",
                        "agenda" => "Penampilan Bintang Tamu Artis / Band Nasional, Doorprize Spesial, Lagu Bersama Penuh Kehangatan",
                    ],
                ],
                "deliverables_output" => [
                    "Trofi Kristal Mewah & Piagam Penghargaan Masa Bakti Resmi Bertanda Tangan Dewan Direksi",
                    "Video Dokumenter Kilas Balik Karier & Video Rekapitulasi Malam Apresiasi Resolusi 4K",
                    "Galeri Foto Digital Interaktif dengan Tautan Unduh Cepat untuk Seluruh Karyawan & Keluarga",
                    "Laporan Pelaksanaan Acara Lengkap dengan Faktur Pajak PPh 23 dan PPN Resmi",
                ],
                "faqs" => [
                    [
                        "q" => "Apakah Wahana Totalita bisa menyediakan pengadaan pin emas murni atau plakat kristal berlogo perusahaan?",
                        "a" => "Ya, kami bermitra langsung dengan produsen logam mulia dan pengrajin kristal resmi untuk mencetak pin emas kadar 24 karat / 18 karat bersertifikat resmi.",
                    ],
                    [
                        "q" => "Bisakah tema dekorasi ballroom disesuaikan dengan identitas warna korporasi kami?",
                        "a" => "Sangat bisa. Kami merancang seluruh tema visual mulai dari dekorasi foyer, pencahayaan panggung, taplak meja, hingga grafis LED agar serasi dengan corporate color identity Anda.",
                    ],
                    [
                        "q" => "Apakah disediakan pembawa acara (MC) profesional yang fasih memandu acara formal dan santai?",
                        "a" => "Ya, kami menyediakan MC profesional berpengalaman (bilingual Indonesia-Inggris) yang piawai menjaga martabat acara formal sekaligus mencairkan suasana keakraban.",
                    ],
                ],
            ],
            'groundbreaking-peresmian-proyek' => [
                "slug" => "groundbreaking-peresmian-proyek",
                "judul" => "Upacara Groundbreaking, Peletakan Batu Pertama & Peresmian Proyek",
                "kategori" => "milestone-gala",
                "kategori_label" => "Milestones, Ceremonies & Galas",
                "tagline" => "Seremoni peluncuran fasilitas industri: tombol sirine interaktif, peletakan batu pertama simbolis, tenda roder AC lapangan, prasasti granit & katering VIP.",
                "meta_title" => "EO Groundbreaking & Peresmian Proyek Pabrik — Upacara Peletakan Batu Pertama",
                "meta_desc" => "Jasa EO upacara groundbreaking peletakan batu pertama & peresmian proyek pabrik / gedung di seluruh Indonesia. Tenda roder AC lapangan, prasasti peresmian & tombol sirine.",
                "keywords" => [
                    "eo groundbreaking peletakan batu pertama pabrik",
                    "peresmian proyek strategis nasional bumn",
                    "opening ceremony fasilitas industri",
                    "tenda roder peresmian pabrik kawasan industri",
                    "vendor prasasti batu peresmian menteri",
                    "upacara peresmian gedung baru",
                ],
                "target_klien" => "Direksi Properti, General Contractor EPC, Pimpinan Proyek BUMN, Pemilik Pabrik Kawasan Industri, dan Kementerian PUPR.",
                "durasi_event" => "1 Hari Acara Puncak di Lokasi Proyek Konstruksi / Fasilitas Baru",
                "lokasi_layanan" => "Seluruh Kawasan Industri & Site Proyek Indonesia (Cilegon, Karawang, Balikpapan, Solo, Gresik, Morowali, Batam)",
                "biaya_standar" => "Rp 65.000.000 / paket seremoni proyek skala menengah",
                "biaya_batch" => "Rp 150.000.000 – Rp 280.000.000 / paket peresmian akbar kenegaraan (+ Tenda Roder Raksasa & Panggung)",
                "b2b_min_peserta" => "50 hingga 500 tamu VIP, investor, dan pejabat pemerintah",
                "inaproc_relevance" => "Kualifikasi pengadaan resmi jasa seremoni proyek pemerintah dan BUMN infrastruktur.",
                "city_mentions" => [
                    "Cilegon",
                    "Karawang",
                    "Balikpapan",
                    "Solo",
                    "Gresik",
                    "Morowali",
                    "Batam",
                    "Jakarta",
                ],
                "companies_mentions" => [
                    "BUMN Karya (Wika, Waskita, Adhi Karya, PP)",
                    "PT Semen Indonesia",
                    "Kawasan Industri Terpadu",
                    "Pengembang Properti",
                ],
                "highlight_pillars" => [
                    "Instalasi Kotak Pasir Groundbreaking Mewah Dilengkapi Sekop Emas & Helm Proyek VIP",
                    "Tombol Sirine LED Interaktif / Layar Touchscreen Peluncuran Resmi yang Menggetarkan Panggung",
                    "Tenda Roder Semi-Permanen Bersih Berpendingin Udara di Tengah Lokasi Lapangan Proyek yang Masih Tanah",
                    "Penyediaan Prasasti Batu Marmer Hitam / Plat Logam Kuningan Bertanda Tangan Pejabat Negara",
                ],
                "deskripsi_lengkap" => "Upacara peletakan batu pertama (Groundbreaking Ceremony) dan peresmian selesainya pembangunan pabrik (Inauguration Ceremony) menandai kelahiran investasi triliunan rupiah yang disaksikan oleh para pemegang saham, mitra perbankan, bupati/wali kota, hingga menteri terkait. Menyelenggarakan acara di lokasi proyek yang masih berupa hamparan tanah merah berdebu atau di dalam pabrik yang sedang proses commissioning menghadirkan tantangan logistik yang sangat berat.\\n\\nDebu tanah yang mengotori sepatu para pejabat tinggi, cuaca terik yang membuat ruangan gerah, atau kegagalan mekanisme tombol sirine peresmian adalah mimpi buruk bagi pimpinan proyek.\\n\\nWahana Totalita Konsultan adalah pakar penyelenggaraan Groundbreaking dan Peresmian Proyek Industri di seluruh penjuru Indonesia. Kami menyulap area proyek yang kasar menjadi venue pesta yang higienis, sejuk, dan elegan: kami memasang lantai kayu panggung berkarpet tebal di atas tanah, mendirikan tenda roder ber-AC dingin, menyiapkan kotak pasir peletakan batu pertama berlapis kain sutra lengkap dengan sekop berlapis emas dan helm proyek custom logo emas untuk para direksi, hingga menyediakan prasasti marmer hitam elegan yang siap ditandatangani dengan tinta emas abadi.",
                "spesifikasi_teknis" => [
                    [
                        "item" => "Venue Lapangan",
                        "spek" => "Tenda Roder Bentang Bebas Aluminium, Flooring Kayu Rata Seluruh Area, Karpet Merah / Hijau Tebal",
                    ],
                    [
                        "item" => "Mekanisme Groundbreaking",
                        "spek" => "Kotak Pasir Marmer Custom, 6x Sekop Upacara Gagang Emas, 6x Helm Proyek Putih Mengkilap Logo Emas",
                    ],
                    [
                        "item" => "Mekanisme Peresmian",
                        "spek" => "Tombol Sirine Pilar Kristal LED Interaktif, Tirai Penutup Logo Hidrolik Drop-Down, Confetti Cannons",
                    ],
                    [
                        "item" => "Prasasti Kenegaraan",
                        "spek" => "Batu Marmer Hitam Carara / Nero Marquina Ukuran 60x90 cm dengan Grafir Emas & Dudukan Kayu Jati",
                    ],
                ],
                "susunan_acara" => [
                    [
                        "fase" => "08.30 - 09.30",
                        "agenda" => "Kedatangan Tamu Undangan, Pemeriksaan Protokol K3 Lapangan (Safety Induction), Morning Coffee di Tenda VIP",
                    ],
                    [
                        "fase" => "09.30 - 09.45",
                        "agenda" => "Menyanyikan Lagu Indonesia Raya, Penayangan Video Animasi 3D Desain Masa Depan Fasilitas Proyek",
                    ],
                    [
                        "fase" => "09.45 - 10.15",
                        "agenda" => "Laporan Direktur Proyek, Sambutan Investor Utama, & Sambutan Kepala Daerah / Menteri",
                    ],
                    [
                        "fase" => "10.15 - 10.45",
                        "agenda" => "Prosesi Sakral Groundbreaking: Peletakan Batu Pertama Menggunakan Sekop Emas & Penekanan Tombol Sirine",
                    ],
                    [
                        "fase" => "10.45 - 11.15",
                        "agenda" => "Penandatanganan Prasasti Marmer oleh Pejabat Utama, Pemotongan Tumpeng Tanda Syukur, Doa Bersama",
                    ],
                    [
                        "fase" => "11.15 - 12.30",
                        "agenda" => "Kunjungan Lapangan Menggunakan Mobil Golf VIP / Berjalan di Jalur Karpet Khusus, Jamuan Makan Siang",
                    ],
                ],
                "deliverables_output" => [
                    "Prasasti Peresmian Granit / Marmer Berkualitas Tinggi yang Siap Dipasang Permanen di Lobi Fasilitas Baru",
                    "Video Dokumentasi Groundbreaking Sinematik Termasuk Pengambilan Gambar Udara Drone 4K Proyek",
                    "Sekop Emas Kenang-Kenangan dalam Kotak Beludru Eksklusif untuk Simpanan Direksi",
                    "Dokumen Penagihan Resmi: SPK, BAST, Laporan Kegiatan, dan Faktur Pajak PPh 23",
                ],
                "faqs" => [
                    [
                        "q" => "Apakah lokasi proyek yang belum ada sambungan listrik PLN tetap bisa menggunakan AC dan soundsystem besar?",
                        "a" => "Tentu. Kami menyediakan paket genset silent berdaya 60 KVA hingga 150 KVA mandiri lengkap dengan operator siaga dan cadangan bahan bakar solar.",
                    ],
                    [
                        "q" => "Bagaimana cara mengatasi kondisi jalan akses proyek yang masih berlumpur atau berdebu?",
                        "a" => "Kami menyediakan jalur pedestrian temporer (wooden pathway) berlapis karpet merah dari area parkir VIP langsung menuju pintu masuk tenda utama sehingga sepatu tamu tetap bersih.",
                    ],
                    [
                        "q" => "Berapa lama proses pembuatan prasasti marmer sebelum hari peresmian?",
                        "a" => "Pembuatan prasasti marmer dengan grafir laser presisi dan pengecatan tinta emas membutuhkan waktu 3 hingga 5 hari kerja setelah teks disetujui.",
                    ],
                ],
            ],
            'hut-perusahaan-anniversary' => [
                "slug" => "hut-perusahaan-anniversary",
                "judul" => "Peringatan Hari Ulang Tahun (HUT) Perusahaan & Korporasi Anniversary",
                "kategori" => "milestone-gala",
                "kategori_label" => "Milestones, Ceremonies & Galas",
                "tagline" => "Perayaan hari jadi perusahaan: konser musik spektakuler, terowongan sejarah kilas balik (milestone tunnel exhibition), pemotongan tumpeng, dan perayaan akbar.",
                "meta_title" => "EO Peringatan HUT Perusahaan & Anniversary Korporasi — Perayaan Hari Jadi",
                "meta_desc" => "Jasa EO perayaan HUT perusahaan & anniversary BUMN di seluruh Indonesia. Panggung konser spektakuler, pameran milestone sejarah korporasi, tumpeng & live band.",
                "keywords" => [
                    "eo perayaan hut perusahaan anniversary bumn",
                    "konser musik internal ulang tahun pt",
                    "vendor pameran korporasi",
                    "paket acara hari jadi perusahaan",
                    "milestone tunnel exhibition korporat",
                    "eo hari ulang tahun kantor",
                ],
                "target_klien" => "Panitia HUT Perusahaan, Corporate Communication, Hubungan Masyarakat (Humas), dan Direksi Korporasi BUMN & Swasta.",
                "durasi_event" => "1 Hari Acara Puncak atau Rangkaian Acara Festival Sepanjang Pekan HUT",
                "lokasi_layanan" => "Seluruh Indonesia (Jakarta, Surabaya, Yogyakarta, Solo, Bandung, Medan, Balikpapan)",
                "biaya_standar" => "Rp 75.000.000 / paket perayaan indoor auditorium (200 pax)",
                "biaya_batch" => "Rp 185.000.000 – Rp 450.000.000 / paket festival akbar (+ Konser Musik & Terowongan Sejarah)",
                "b2b_min_peserta" => "200 hingga 2.500 karyawan dan mitra bisnis",
                "inaproc_relevance" => "Kualifikasi pengadaan resmi jasa penyelenggara acara perayaan hari jadi BUMN dan instansi pemerintah.",
                "city_mentions" => [
                    "Jakarta",
                    "Surabaya",
                    "Yogyakarta",
                    "Solo",
                    "Bandung",
                    "Medan",
                    "Balikpapan",
                ],
                "companies_mentions" => [
                    "BUMN Perbankan",
                    "PT Pegadaian",
                    "PT Pos Indonesia",
                    "Perusahaan Jasa Asuransi",
                    "Holding Industri",
                ],
                "highlight_pillars" => [
                    "Instalasi Lorong Kilas Balik Sejarah Perusahaan (Milestone Tunnel Exhibition) Berlampu Interaktif",
                    "Panggung Megah Festival Musik Lengkap dengan Line Array Sound System 25.000 Watt & Lighting Show",
                    "Seremoni Sakral Pemotongan Tumpeng Megah 7 Tingkat Bersama Jajaran Direksi & Pendiri Perusahaan",
                    "Peluncuran Logo / Slogan Baru Korporasi (Corporate Rebranding Reveal) dengan Animasi 3D Memukau",
                ],
                "deskripsi_lengkap" => "Peringatan Hari Ulang Tahun (HUT) perusahaan—terutama tonggak sejarah istimewa seperti Lustrum, HUT ke-10, Perak (25 tahun), atau Emas (50 tahun)—adalah momentum refleksi historis yang sangat berharga. Acara ini bukan sekadar pesta hiburan biasa, melainkan manifestasi ketahanan korporasi melewati pasang surut ekonomi, penghormatan kepada para perintis terdahulu, serta penegasan visi kepemimpinan untuk melompat lebih tinggi di masa depan.\\n\\nMerayakan hari jadi perusahaan membutuhkan perpaduan harmonis antara rasa haru mengenang sejarah perjuangan masa lalu dan antusiasme membakar semangat menyambut masa depan yang gemilang.\\n\\nWahana Totalita Konsultan merancang perayaan HUT Perusahaan dengan konsep artistik yang megah dan berkelas. Kami membangun Terowongan Milestone Sejarah (History Tunnel) yang memamerkan memorabilia foto masa lalu, artefak produk pertama, hingga pencapaian rekor masa kini sebelum tamu memasuki ruang utama. Di panggung utama, kami menghadirkan seremoni pemotongan tumpeng megah, peluncuran logo/slogan baru korporasi yang dramatis di layar LED videotron, hingga pementasan konser musik dari artis nasional yang menghibur seluruh karyawan.",
                "spesifikasi_teknis" => [
                    [
                        "item" => "Terowongan Sejarah",
                        "spek" => "Tunnel Box Dimensi 12x3 Meter, Panel Akrilik Menyala LED, Foto Arsip Bersejarah, Display Artefak Kaca",
                    ],
                    [
                        "item" => "Panggung Utama",
                        "spek" => "Panggung Konser Modular Lebar 16 Meter, Rigging Aluminium Kokoh, Layar LED Videotron P3 Lebar 12 Meter",
                    ],
                    [
                        "item" => "Lighting & Laser",
                        "spek" => "Lighting Show Terprogram: Beam 380W, Laser RGB 10W, Strobo, Smoke Machine Haze Tebal",
                    ],
                    [
                        "item" => "Tumpeng Syukuran",
                        "spek" => "Tumpeng Kuning Megah Bertingkat 7 Lengkap dengan 15 Lauk Nusantara Tradisional Penata Saji Budaya",
                    ],
                ],
                "susunan_acara" => [
                    [
                        "fase" => "15.00 - 18.00",
                        "agenda" => "Kunjungan Lorong Sejarah (Milestone Tunnel Walk), Pameran Inovasi Unit Bisnis, Photo Booth Interaktif",
                    ],
                    [
                        "fase" => "18.30 - 19.15",
                        "agenda" => "Pemutaran Video Dokumenter Napak Tilas Perjalanan Perusahaan, Sambutan Direktur Utama & Sesepuh Pendiri",
                    ],
                    [
                        "fase" => "19.15 - 19.45",
                        "agenda" => "Prosesi Sakral Pemotongan Tumpeng Ulang Tahun, Penyerahan Potongan Pertama kepada Karyawan Tertua & Termuda",
                    ],
                    [
                        "fase" => "19.45 - 20.30",
                        "agenda" => "Makan Malam Bersama Diiringi Lantunan Musik Nostalgia Perjalanan Korporasi",
                    ],
                    [
                        "fase" => "20.30 - 22.00",
                        "agenda" => "Konser Musik Perayaan Bersama Bintang Tamu Artis Nasional, Doorprize Akbar, Pesta Konfeti Emas",
                    ],
                ],
                "deliverables_output" => [
                    "Buku Kenangan Sejarah Perusahaan (Coffee Table Book) Desain Eksklusif Hardcover",
                    "Video Sinematik Napak Tilas Sejarah Perusahaan Format 4K untuk Materi Corcomm Sepanjang Tahun",
                    "Dokumentasi Foto Resolusi Tinggi Seluruh Rangkaian Perayaan",
                    "Dokumen Penagihan B2B Lengkap: SPK, BAST, Laporan Kegiatan, dan Faktur Pajak PPh 23",
                ],
                "faqs" => [
                    [
                        "q" => "Apakah Wahana Totalita bisa mengelola perayaan HUT yang berlangsung selama beberapa hari (HUT Festival)?",
                        "a" => "Bisa. Kami berpengalaman mengelola rangkaian pekan HUT yang mencakup bazar UMKM, donor darah, turnamen olahraga internal, hingga malam konser puncak.",
                    ],
                    [
                        "q" => "Bisakah konsep terowongan sejarah dipasang secara semi-permanen di lobi kantor kami?",
                        "a" => "Bisa. Kami dapat merancang instalasi pameran sejarah yang dapat dibongkar-pasang atau dipasang permanen sebagai galeri mini korporasi di lobi kantor Anda.",
                    ],
                    [
                        "q" => "Bagaimana dengan perizinan keramaian kepolisian jika mendatangkan artis nasional terkenal?",
                        "a" => "Tim legal dan produksi kami menangani seluruh kepengurusan izin keramaian dari Polres/Polda setempat, koordinasi pengamanan, hingga koordinasi tim medis.",
                    ],
                ],
            ],
            'capacity-building-asn-bumn' => [
                "slug" => "capacity-building-asn-bumn",
                "judul" => "Capacity Building & Character Building SDM (Outdoor & Indoor)",
                "kategori" => "capacity-building",
                "kategori_label" => "Capacity Building & Leadership",
                "tagline" => "Peningkatan kapasitas & karakter kerja: dipandu psikolog industri, dinamika kelompok, pemecahan masalah kolaboratif, dan laporan asesmen SDM.",
                "meta_title" => "Paket Capacity Building ASN & BUMN — Character Building & Outbound SDM",
                "meta_desc" => "Jasa EO capacity building & character building pegawai ASN, dinas Pemda & BUMN di Yogyakarta, Solo & Tawangmangu. Fasilitator psikolog, outbound & evaluasi SDM.",
                "keywords" => [
                    "paket capacity building asn bumn",
                    "outbound instansi pemerintah kementerian",
                    "character building pegawai dinas",
                    "biaya capacity building pemda per orang",
                    "experiential learning team building",
                    "eo outbound capacity building jogja solo",
                ],
                "target_klien" => "Kepala Badan Kepegawaian (BKPSDM), Kadiv Human Capital BUMN, Sekretariat Dinas Pemda, dan Balai Pelatihan Teknis.",
                "durasi_event" => "2 Hari 1 Malam (2D1N) atau 3 Hari 2 Malam (3D2N) Format Outbound & Workshop",
                "lokasi_layanan" => "Yogyakarta (Kaliurang / Merapi), Solo / Tawangmangu, Malang / Batu, Bandung, Bogor",
                "biaya_standar" => "Rp 1.650.000 / peserta (Paket 2D1N Hotel *3/*4 Kaliurang / Solo)",
                "biaya_batch" => "Rp 2.450.000 / peserta (Paket 3D2N Hotel *4 + Lava Tour Merapi & Gala Dinner)",
                "b2b_min_peserta" => "30 hingga 300 orang pegawai instansi",
                "inaproc_relevance" => "Pemenuhan mata anggaran pengembangan kapasitas SDM (DIPA APBN/APBD) & terdaftar di SPSE INAPROC.",
                "city_mentions" => [
                    "Yogyakarta",
                    "Solo",
                    "Tawangmangu",
                    "Malang",
                    "Bandung",
                    "Bogor",
                    "Semarang",
                ],
                "companies_mentions" => [
                    "BKPSDM Pemda",
                    "Dinas Pendapatan Daerah",
                    "BUMN Perbankan",
                    "Kementerian PUPR",
                    "Inspektorat",
                ],
                "highlight_pillars" => [
                    "Metode Experiential Learning yang Diampu Langsung oleh Fasilitator Psikolog Industri Terdaftar",
                    "Permainan Simulasi Dinamika Tim yang Menghancurkan Silo Mental (Silo Mentality) Antar-Bagian",
                    "Lokasi Alam Pegunungan Asri yang Sejuk (Lereng Merapi Kaliurang atau Lereng Lawu Tawangmangu)",
                    "Laporan Evaluasi Psikologis Dinamika Tim (Team Assessment Report) untuk Rekomendasi Pimpinan",
                ],
                "deskripsi_lengkap" => "Kinerja sebuah institusi pemerintah atau korporasi kerap kali terhambat bukan karena kurangnya anggaran, melainkan karena fenomena 'Silo Mentality'—kondisi di mana masing-masing bagian bekerja sendiri-sendiri, ketiadaan rasa saling percaya, komunikasi yang kaku antar-generasi pegawai, serta pudarnya integritas pengabdian. Program Capacity Building dan Character Building hadir sebagai intervensi psikologis terencana untuk membongkar kebekuan tersebut.\\n\\nOutbound Capacity Building bukan sekadar berpanas-panasan main tarik tambang tanpa arah. Program yang efektif harus memiliki landasan psikologi kerja yang kokoh, di mana setiap aktivitas fisik dirancang untuk menguji kepemimpinan, komunikasi asertif, empati, dan resiliensi menghadapi tekanan.\\n\\nWahana Totalita Konsultan memadukan keindahan alam Yogyakarta dan Solo dengan metodologi Experiential Learning berstandar internasional. Seluruh sesi dipandu oleh Fasilitator Psikolog Industri dan Tenaga Ahli K3 bersertifikat. Peserta diajak menghadapi tantangan simulasi terstruktur, dilanjutkan dengan sesi perenungan (debriefing) mendalam untuk mengaitkan pengalaman permainan dengan realitas birokrasi dan target korporasi.\\n\\nHasil akhirnya adalah tim kerja yang solid, tangguh, memiliki etos pelayanan prima, dan bebas dari sekat-sekat departmental.",
                "spesifikasi_teknis" => [
                    [
                        "item" => "Lokasi Lapangan",
                        "spek" => "Resort / Area Alam Terbuka Rumput Rata Hijau Berhawa Sejuk (Kaliurang / Tawangmangu / Batu)",
                    ],
                    [
                        "item" => "Perlengkapan Outbound",
                        "spek" => "Peralatan Games Team Building Kayu & Tali Standar Safety Internasional, Megaphone, Sound System Lapangan",
                    ],
                    [
                        "item" => "Fasilitator Ahli",
                        "spek" => "Lead Facilitator Psikolog Industri Terdaftar, Master Game, dan Tim Instruktur Rescue Medis Lapangan",
                    ],
                    [
                        "item" => "Akomodasi & Transport",
                        "spek" => "Kamar Hotel Bintang 3-4 (Twin Sharing), Bus Pariwisata AC Eksekutif, Konsumsi Makanan Sehat",
                    ],
                ],
                "susunan_acara" => [
                    [
                        "fase" => "Hari 1 - 08.00 - 10.30",
                        "agenda" => "Perjalanan Menuju Venue Alam Pegunungan Menggunakan Bus Eksekutif, Ice Breaking Bus",
                    ],
                    [
                        "fase" => "Hari 1 - 10.30 - 12.00",
                        "agenda" => "In-Door Session: Pemaparan Mindset Karakter Unggul & Penyusunan Komitmen Belajar bersama Psikolog",
                    ],
                    [
                        "fase" => "Hari 1 - 13.00 - 17.00",
                        "agenda" => "Out-Door Challenge: Simulasi Dinamika Tim, Leadership Relay, Problem Solving Lapangan, Debriefing",
                    ],
                    [
                        "fase" => "Hari 1 - 19.30 - 21.30",
                        "agenda" => "Malam Renungan Keakraban: Refleksi Pengabdian, Api Unggun Simbolis, Penampilan Seni Spontanitas",
                    ],
                    [
                        "fase" => "Hari 2 - 06.30 - 08.00",
                        "agenda" => "Senam Pagi Kebugaran & Sarapan Sehat Nusantara",
                    ],
                    [
                        "fase" => "Hari 2 - 08.30 - 11.30",
                        "agenda" => "Final Synergy Challenge & Komitmen Bersama Budaya Kerja Baru, Penyerahan Laporan Evaluasi, Penutupan",
                    ],
                ],
                "deliverables_output" => [
                    "Laporan Evaluasi Dinamika Tim (Team Dynamic Assessment Report) Resmi untuk Arsip BKPSDM / HC",
                    "Video Dokumenter Transformasi Karakter Format 4K & Foto Bersama Bingkai Kenangan",
                    "Piagam Penghargaan Partisipasi Pembinaan Karakter untuk Masing-Masing Peserta",
                    "Dokumen SPJ Lengkap Sesuai Ketentuan APBD/APBN: SPK, BAST, Kuitansi, dan Faktur Pajak PPh 23",
                ],
                "faqs" => [
                    [
                        "q" => "Apakah aktivitas outbound aman bagi pegawai yang berusia lanjut atau memiliki riwayat penyakit?",
                        "a" => "Sangat aman. Sebelum kegiatan kami menyebarkan formulir skrining kesehatan. Seluruh aktivitas disesuaikan dengan prinsip Low-Impact Challenge yang menekankan kerja otak dan kolaborasi tim, bukan ketahanan fisik ekstrem.",
                    ],
                    [
                        "q" => "Bisakah dikombinasikan dengan kegiatan wisata lava tour Merapi atau petik buah?",
                        "a" => "Sangat bisa. Kami memiliki paket populer kombinasi outbound karakter di pagi hari dan wisata adventure Lava Tour Jeep Merapi di sore hari.",
                    ],
                    [
                        "q" => "Apakah Wahana Totalita menyediakan laporan tertulis mengenai profil perilaku masing-masing kelompok peserta?",
                        "a" => "Ya, tim psikolog kami menyusun laporan observasi dinamika kelompok yang memetakan pola komunikasi, potensi kepemimpinan, dan hambatan koordinasi tim.",
                    ],
                ],
            ],
            'leadership-camp-management-trainee' => [
                "slug" => "leadership-camp-management-trainee",
                "judul" => "Leadership Development Camp & Supervisory Team Building",
                "kategori" => "capacity-building",
                "kategori_label" => "Capacity Building & Leadership",
                "tagline" => "Kawah candradimuka calon pemimpin: simulasi krisis malam hari, high ropes confidence course, manajemen strategi, dan pembentukan kepemimpinan adaptif.",
                "meta_title" => "EO Leadership Camp Management Trainee (MT) — Kawah Candradimuka Pemimpin",
                "meta_desc" => "Penyelenggara leadership development camp & supervisory outbound untuk calon pimpinan & Management Trainee BUMN. High ropes, simulasi krisis malam & debriefing.",
                "keywords" => [
                    "leadership camp management trainee mt",
                    "supervisory development program outbound",
                    "kawah candradimuka calon pimpinan",
                    "bootcamp kepemimpinan karyawan bumn",
                    "eo leadership training camp jogja",
                    "experiential leadership development",
                ],
                "target_klien" => "Management Trainee (MT), Officer Development Program (ODP), Supervisor Baru, dan Calon Manajer BUMN serta Korporasi Nasional.",
                "durasi_event" => "3 Hari 2 Malam (3D2N) Bootcamp Intensif di Area Alam Pegunungan",
                "lokasi_layanan" => "Kawasan Lereng Gunung Merapi (Yogyakarta), Gunung Lawu (Solo), Gunung Salak (Bogor), Batu (Malang)",
                "biaya_standar" => "Rp 2.450.000 / peserta (Paket 3D2N Standar Camp & Resort)",
                "biaya_batch" => "Rp 3.250.000 / peserta (Paket Exclusive Bootcamp + High Ropes & Military-Style Simulation)",
                "b2b_min_peserta" => "25 hingga 100 calon pemimpin muda",
                "inaproc_relevance" => "Kualifikasi program pelatihan pengembangan kepemimpinan talenta muda BUMN & instansi pemerintah.",
                "city_mentions" => [
                    "Yogyakarta",
                    "Solo",
                    "Bogor",
                    "Malang",
                    "Bandung",
                    "Jakarta",
                    "Surabaya",
                ],
                "companies_mentions" => [
                    "Program MT Perbankan",
                    "BUMN Karya",
                    "Industri Manufaktur Otomotif",
                    "Mining Trainee",
                    "FMCG Trainee",
                ],
                "highlight_pillars" => [
                    "Metode Semi-Militer & Experiential Learning Terukur Tanpa Perpeloncoan yang Merendahkan Martabat",
                    "High Ropes Course (Flying Fox, Two-Line Bridge, Rappelling) untuk Membangun Keberanian Mental",
                    "Simulasi Pengambilan Keputusan Krisis Malam Hari (Night Strategic Crisis Navigation)",
                    "Sesi Coaching 1-on-1 bersama Mantan Direktur BUMN & Psikolog Asesor Kepemimpinan",
                ],
                "deskripsi_lengkap" => "Para lulusan terbaik program Management Trainee (MT) dan supervisor baru adalah calon nahkoda masa depan korporasi. Namun, kecerdasan akademis dari kampus ternama sering kali belum teruji saat dihadapkan pada realitas kepemimpinan lapangan: tekanan target yang mencekam, keharusan mengambil keputusan di tengah ketidakpastian informasi, mengelola bawahan yang usianya jauh lebih tua, serta menjaga integritas moral saat menghadapi godaan.\\n\\nLeadership Development Camp adalah kawah candradimuka modern. Program ini bukan latihan fisik perpeloncoan tanpa makna, melainkan simulasi terstruktur bertekanan tinggi yang menguji karakter, ketahanan mental (grit), kecerdasan emosional, dan kepemimpinan adaptif peserta di alam terbuka.\\n\\nWahana Totalita merancang Bootcamp Kepemimpinan Calon Pemimpin di kawasan pegunungan berhawa dingin. Kami menggabungkan rintangan tali tinggi (High Ropes Course) untuk memecahkan batas ketakutan diri, navigasi kompas malam hari (Night Crisis Navigation) yang menuntut delegasi tugas dan komunikasi presisi, simulasi strategi pertahanan tim, serta sesi debriefing mendalam bersama para mantan eksekutif senior BUMN.\\n\\nPeserta kembali ke kantor dengan transformasi mental yang nyata: siap memimpin dengan keteladanan, berani bertanggung jawab, dan tangguh menghadapi badai disrupsi bisnis.",
                "spesifikasi_teknis" => [
                    [
                        "item" => "Instalasi High Ropes",
                        "spek" => "Tower Tali Standar UIAA: Flying Fox 150 Meter, Two-Line Bridge, Rappelling Tebing, Harness Petzl & Helm",
                    ],
                    [
                        "item" => "Peralatan Navigasi",
                        "spek" => "Kompas Prisma Militer, Peta Topografi Skenario, Radio Komunikasi HT Walkie Talkie per Regu, Senter Kepala",
                    ],
                    [
                        "item" => "Instruktur Pengampu",
                        "spek" => "Instruktur Bersertifikat Asosiasi Experiential Learning Indonesia (AELI), Fasilitator Psikolog, Tim Medis K3",
                    ],
                    [
                        "item" => "Akomodasi Camp",
                        "spek" => "Glamping / Barak Militer Modern Bersih atau Resort Pegunungan Bintang 3 dengan Ranjang Nyaman",
                    ],
                ],
                "susunan_acara" => [
                    [
                        "fase" => "Hari 1 - 09.00 - 12.00",
                        "agenda" => "Tiba di Camp Kawah Candradimuka, Penyerahan Seragam Rimba, Pembagian Peleton & Pembacaan Pakta Disiplin",
                    ],
                    [
                        "fase" => "Hari 1 - 13.00 - 17.30",
                        "agenda" => "High Ropes Challenge: Mengatasi Ketakutan Pribadi, Kepercayaan Diri di Ketinggian, Saling Mengamankan (Belaying)",
                    ],
                    [
                        "fase" => "Hari 1 - 19.30 - 22.00",
                        "agenda" => "Simulasi Kepemimpinan Skenario Krisis Bisnis & Debriefing Karakter Kepemimpinan bersama Asesor",
                    ],
                    [
                        "fase" => "Hari 2 - 05.30 - 08.00",
                        "agenda" => "Latihan Ketahanan Fisik Pagi, Mandi Air Dingin Gunung, Sarapan Komando Bersama",
                    ],
                    [
                        "fase" => "Hari 2 - 08.30 - 16.30",
                        "agenda" => "Expedition & Strategy Mission: Navigasi Medan Menantang, Pemecahan Masalah Kolaboratif Lintas Kelompok",
                    ],
                    [
                        "fase" => "Hari 2 - 20.00 - 23.00",
                        "agenda" => "Night Strategic Crisis Exercise: Menavigasi Ketidakpastian di Tengah Gelap Malam, Komitmen Janji Pemimpin",
                    ],
                    [
                        "fase" => "Hari 3 - 08.00 - 11.30",
                        "agenda" => "Upacara Pembasuhan Diri & Pengukuhan Pemimpin Muda, Penyematan Pin Kepemimpinan oleh Direksi, Penutupan",
                    ],
                ],
                "deliverables_output" => [
                    "Laporan Individual Leadership Profile (Asesmen Karakter, Ketahanan Mental, & Gaya Kepemimpinan)",
                    "Pin Logam Eksklusif Kawah Candradimuka & Sertifikat Kelulusan Bootcamp Kepemimpinan",
                    "Video Dokumenter Transformasi Perjuangan Resolusi 4K untuk Inspirasi Perusahaan",
                    "Dokumen Pertanggungjawaban B2B Lengkap: SPK, BAST, Laporan Kegiatan Berjilid, dan Faktur Pajak PPh 23",
                ],
                "faqs" => [
                    [
                        "q" => "Apakah ada unsur kekerasan fisik atau perpeloncoan dalam leadership camp ini?",
                        "a" => "Sama sekali TIDAK ADA. Kami menjunjung tinggi etika pelatihan modern berbasis humanistik. Tekanan yang diberikan adalah tekanan psikologis skenario pengambilan keputusan dan tantangan fisik terukur yang diawasi tenaga medis K3.",
                    ],
                    [
                        "q" => "Bagaimana standar keselamatan pada wahana tali tinggi (high ropes)?",
                        "a" => "Seluruh perlengkapan keselamatan kami (carabiner, harness, tali kernmantle) bersertifikat internasional UIAA/CE dan selalu diinspeksi kelayakannya sebelum dipakai oleh tim rescue bersertifikat K3 Ketinggian Kemnaker RI.",
                    ],
                    [
                        "q" => "Apakah pihak manajemen atau direksi perusahaan bisa hadir saat upacara pengukuhan kelulusan?",
                        "a" => "Sangat dianjurkan. Kehadiran direktur pada hari terakhir untuk menyematkan pin tanda lulus memberikan dampak emosional yang luar biasa bagi motivasi masa depan para calon pemimpin muda.",
                    ],
                ],
            ],
            'outbound-safety-challenge-k3' => [
                "slug" => "outbound-safety-challenge-k3",
                "judul" => "Safety Culture Outbound & Emergency Team Challenge K3",
                "kategori" => "capacity-building",
                "kategori_label" => "Capacity Building & Leadership",
                "tagline" => "Outbound signature Wahana Totalita: integrasi permainan alam terbuka dengan keterampilan tanggap darurat, estafet pemadaman api, dan penyelamatan darurat.",
                "meta_title" => "Outbound Safety Culture K3 & Emergency Challenge — Team Building Keselamatan Kerja",
                "meta_desc" => "Jasa EO outbound safety culture K3 & emergency team challenge di Yogyakarta, Solo & kawasan industri. Estafet pemadaman api, penyelamatan darurat & team building.",
                "keywords" => [
                    "outbound safety culture k3",
                    "emergency team challenge tambang pabrik",
                    "team building tanggap darurat k3",
                    "lomba ketangkasan safety karyawan",
                    "paket outbound k3 terpadu jogja",
                    "safety adventure team challenge",
                ],
                "target_klien" => "Karyawan Pabrik Manufaktur, Kontraktor Tambang, Personel Operasi Kilang Migas, dan Tim Logistik.",
                "durasi_event" => "1 Hari Penuh (8 Jam) atau 2 Hari 1 Malam (2D1N)",
                "lokasi_layanan" => "Yogyakarta (Kaliurang / Pantai Baron), Solo, Tawangmangu, Cilegon, Balikpapan",
                "biaya_standar" => "Rp 650.000 / peserta (Paket One-Day Outbound Safety Challenge)",
                "biaya_batch" => "Rp 1.950.000 / peserta (Paket 2D1N Hotel Bintang 4 + Sertifikasi First Aid Basic)",
                "b2b_min_peserta" => "30 hingga 500 karyawan",
                "inaproc_relevance" => "Integrasi kepatuhan pembudayaan K3 nasional dan peningkatan kompetensi praktis tanggap darurat.",
                "city_mentions" => [
                    "Yogyakarta",
                    "Solo",
                    "Tawangmangu",
                    "Cilegon",
                    "Balikpapan",
                    "Surabaya",
                    "Karawang",
                ],
                "companies_mentions" => [
                    "Industri Kimia & Petrokimia",
                    "Kontraktor Pertambangan",
                    "Pabrik Semen & Peleburan Logam",
                    "Perusahaan Logistik & Gudang",
                ],
                "highlight_pillars" => [
                    "Inovasi Perdana di Indonesia: Memadukan Fun Outbound dengan Keterampilan Nyata Keselamatan Kerja",
                    "Rintangan Estafet Pemadaman Api Menggunakan Karung Basah & APAR Powder Berwaktu Tercepat",
                    "Tantangan Tandu Darurat Melintasi Sungai & Rintangan Lumpur (Emergency Stretcher Obstacle)",
                    "Instruktur Bersertifikasi Ahli K3 Umum Kemnaker RI & Fire Safety Officer Berpengalaman",
                ],
                "deskripsi_lengkap" => "Banyak perusahaan merasa jenuh dengan permainan outbound konvensional yang itu-itu saja (seperti memindahkan bola dengan tali atau menyeberangi jaring laba-laba) yang sering dinilai tidak memiliki korelasi nyata dengan tantangan keselamatan kerja di lantai pabrik. Di sisi lain, pelatihan K3 di dalam kelas sering dianggap membosankan dan cepat dilupakan karyawan begitu kembali bekerja.\\n\\nWahana Totalita Konsultan menciptakan program unggulan bertajuk Safety Culture Outbound & Emergency Team Challenge K3. Program ini menggabungkan adrenalin dan keceriaan team building alam terbuka dengan latihan keterampilan tanggap darurat yang nyata dan menyelamatkan nyawa.\\n\\nSetiap pos permainan dirancang menguji refleks keselamatan dan kekompakan tim: pos estafet pemadaman api drum berkobar, pos penyelamatan korban pingsan melintasi rintangan alam menggunakan tandu darurat rakitan, pos pencarian bahaya tersembunyi (Hazard Hunt), hingga pos komunikasi radio darurat. Karyawan berkompetisi dengan penuh tawa, namun secara subliminal menanamkan memori otot (muscle memory) mengenai cara kerja APAR, penanganan patah tulang, dan kecepatan mengambil keputusan saat terjadi insiden di tempat kerja.",
                "spesifikasi_teknis" => [
                    [
                        "item" => "Arena Rintangan Api",
                        "spek" => "Drum Baja Simulasi Api Terkontrol, 30x Tabung APAR Dry Chemical Powder & CO2, Karung Goni Basah",
                    ],
                    [
                        "item" => "Arena Tandu Darurat",
                        "spek" => "Tandu Lipat Medis, Bambu & Tali Pramuka untuk Perakitan Tandu Improvisasi, Rintangan Jaring Merayap",
                    ],
                    [
                        "item" => "Perangkat Keselamatan",
                        "spek" => "Kacamata Safety Goggles, Sarung Tangan Kulit Tahan Panas, Rompi Reflektif per Warna Tim",
                    ],
                    [
                        "item" => "Tim Medis & P3K",
                        "spek" => "Posko Medis Siaga Penuh dengan Tenaga Paramedis, Tabung Oksigen Portabel, dan Mobil Ambulans",
                    ],
                ],
                "susunan_acara" => [
                    [
                        "fase" => "08.00 - 08.45",
                        "agenda" => "Kedatangan di Lokasi Alam Terbuka, Safety Induction Lapangan, Pembagian Rompi Warna & Yel-Yel Safety Tim",
                    ],
                    [
                        "fase" => "08.45 - 09.30",
                        "agenda" => "Energizer Games: Refleks Kepatuhan Rambu Bahaya & Latihan Kekompakan Komunikasi Sinyal Darurat",
                    ],
                    [
                        "fase" => "09.30 - 12.00",
                        "agenda" => "The Safety Amazing Race: Menjelajahi 4 Pos Tantangan (Fire Attack, First Aid Rescue, Hazard Hunt, Chemical Spill)",
                    ],
                    [
                        "fase" => "12.00 - 13.30",
                        "agenda" => "Makan Siang Bersama di Tenda Barak Alam & Istirahat Santai",
                    ],
                    [
                        "fase" => "13.30 - 15.30",
                        "agenda" => "Final Battle: Simulasi Penyelamatan Pabrik Serentak Melawan Waktu, Pemadaman Api Massal",
                    ],
                    [
                        "fase" => "15.30 - 16.30",
                        "agenda" => "Debriefing Ahli K3: Mengaitkan Aksi Lapangan dengan Budaya Kerja Pabrik, Penyerahan Piala Safety Champion",
                    ],
                ],
                "deliverables_output" => [
                    "Piala Bergilir Safety Team Champion & Medali Ketangkasan Tanggap Darurat untuk Seluruh Juara",
                    "Sertifikat Keterampilan Tanggap Darurat K3 Dasar (Basic Emergency Awareness) untuk Setiap Peserta",
                    "Video Dokumenter Aksi Heroik Tim Penuh Semangat Format 4K & Foto Dokumentasi",
                    "Dokumen Penagihan B2B Lengkap: SPK, BAST, Laporan Pelaksanaan Kegiatan, dan Faktur Pajak PPh 23",
                ],
                "faqs" => [
                    [
                        "q" => "Apakah peserta awam yang belum pernah memegang APAR bisa mengikuti permainan ini?",
                        "a" => "Bisa dan justru sangat direkomendasikan. Sebelum lomba dimulai, instruktur K3 kami memberikan demonstrasi teknik PASS (Pull, Aim, Squeeze, Sweep) sehingga seluruh karyawan wanita maupun pria berani memadamkan api.",
                    ],
                    [
                        "q" => "Bagaimana jika ada api yang tidak terkontrol saat permainan berlangsung?",
                        "a" => "Seluruh area api berada di bawah pengawasan ketat Fire Safety Officer dengan tabung pemadam cadangan bertekanan tinggi dan selang air siaga.",
                    ],
                    [
                        "q" => "Di mana saja lokasi favorit penyelenggaraan Outbound Safety Challenge ini?",
                        "a" => "Lokasi paling populer adalah kawasan Kaliurang dan lereng Merapi Yogyakarta, Tawangmangu Solo, kawasan pantai selatan Jogja, serta hutan pinus perkemahan di Jawa Barat dan Jawa Timur.",
                    ],
                ],
            ],
        ];
    }

    if (empty($filter)) {
        return $items;
    }

    $res = [];
    foreach ($items as $slug => $data) {
        if (!empty($filter['kategori']) && $data['kategori'] !== $filter['kategori']) {
            continue;
        }
        if (!empty($filter['q'])) {
            $q = mb_strtolower($filter['q']);
            $haystack = mb_strtolower($data['judul'] . ' ' . $data['tagline'] . ' ' . $data['meta_desc'] . ' ' . implode(' ', $data['keywords'] ?? []));
            if (!str_contains($haystack, $q)) {
                continue;
            }
        }
        $res[$slug] = $data;
    }
    return $res;
}

function get_event_item(string $slug): ?array {
    $items = get_all_event_items();
    return $items[$slug] ?? null;
}

function get_event_categories(): array {
    return [
        'hse-safety'         => 'HSE & K3 Statutory Event',
        'government-mice'    => 'Government MICE & Tender LKPP',
        'corporate-meetings' => 'Corporate Strategy & Meetings',
        'milestone-gala'     => 'Milestone Celebration & Gala',
        'capacity-building'  => 'Capacity Building & Leadership'
    ];
}

function get_related_event_items(string $current_slug, ?string $kategori = null, int $limit = 3): array {
    $items = get_all_event_items();
    $related = [];
    
    // First try same category
    if ($kategori) {
        foreach ($items as $slug => $data) {
            if ($slug === $current_slug) continue;
            if ($data['kategori'] === $kategori) {
                $related[$slug] = $data;
                if (count($related) >= $limit) return array_values($related);
            }
        }
    }
    
    // Fallback fill with others
    foreach ($items as $slug => $data) {
        if ($slug === $current_slug || isset($related[$slug])) continue;
        $related[$slug] = $data;
        if (count($related) >= $limit) break;
    }
    
    return array_values($related);
}
