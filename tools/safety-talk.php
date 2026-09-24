<?php
require_once __DIR__ . '/../config.php';
$s = get_all_settings();
?>
<?php
$page_title = '100 Materi Safety Talk Harian K3 2026: Singkat, Jelas + Absensi';
$meta_desc = '100 Materi Safety Talk Harian & Toolbox Meeting (TBM) K3 terlengkap 2026! Dilengkapi fakta, poin diskusi, teknologi K3 & AI, hingga lembar daftar hadir. Gratis cetak!';
ob_start();
require __DIR__ . '/../includes/head.php';
$shared_head = ob_get_clean();
$shared_head = preg_replace('~<title>.*?</title>~s', '<title>' . e($page_title) . '</title>', $shared_head, 1);
echo $shared_head;

// ---------------------------------------------------------------
// SINGLE SOURCE OF TRUTH: the 100 safety-talk topics.
// This same array is used to (1) server-render the cards below
// so Google indexes the full content immediately, and (2) power
// the client-side search/filter/modal/print JS further down.
// ---------------------------------------------------------------
$talks = [
  ["w" => 1, "cat" => "umum", "title" => "Penggunaan APD yang Benar", "desc" => "Cara memilih, memakai, melepas, dan merawat Alat Pelindung Diri sesuai standar K3.", "tags" => ["APD", "Umum"], "stat" => "40% kecelakaan kerja dapat dicegah dengan penggunaan APD yang tepat dan disiplin.", "points" => ["Apa saja APD wajib di area kerja ini?", "Apakah APD yang Anda pakai kondisinya masih layak?", "Bagaimana cara membersihkan dan menyimpan APD?", "Kapan APD harus diganti dengan yang baru?"], "steps" => ["Periksa kondisi APD sebelum dipakai", "Pastikan ukuran APD sesuai bentuk tubuh", "Gunakan urutan memakai APD yang benar", "Simpan APD di tempat bersih dan kering setelah dipakai"]],
  ["w" => 2, "cat" => "ketinggian", "title" => "Bekerja di Ketinggian dengan Aman", "desc" => "Prosedur keselamatan bekerja di atas 1.8 meter: full body harness, scaffolding, dan anchor point.", "tags" => ["Ketinggian", "Harness"], "stat" => "25% kematian akibat kecelakaan kerja disebabkan jatuh dari ketinggian.", "points" => ["Apakah full body harness sudah diinspeksi hari ini?", "Di mana titik anchor point yang dinilai aman?", "Apakah PTW Ketinggian sudah ditandatangani?", "Siapa yang memiliki lisensi bekerja di ketinggian?"], "steps" => ["Inspeksi harness dan lanyard sebelum dipakai", "Hookkan lanyard ke anchor point kuat di atas kepala", "Gunakan double lanyard saat berpindah posisi", "Pasang barikade di bawah area kerja ketinggian"]],
  ["w" => 3, "cat" => "kebakaran", "title" => "Pencegahan Kebakaran & Penggunaan APAR", "desc" => "Teori segitiga api, kelas kebakaran, teknik P.A.S.S pada APAR, dan jalur evakuasi.", "tags" => ["Kebakaran", "APAR"], "stat" => "Kerugian rata-rata kebakaran pabrik mencapai miliaran rupiah per insiden.", "points" => ["Di mana lokasi APAR terdekat dari area kerja Anda?", "Apakah jarum tekanan APAR masih di area hijau?", "Bagaimana teknik P.A.S.S saat memadamkan api?", "Siapa yang harus dihubungi saat terjadi insiden kebakaran?"], "steps" => ["Jaga area kerja bebas dari penumpukan sampah mudah terbakar", "Periksa pin dan segel APAR secara berkala", "Gunakan metode P.A.S.S (Pull, Aim, Squeeze, Sweep)", "Jika api membesar, segera evakuasi dan tekan alarm"]],
  ["w" => 4, "cat" => "listrik", "title" => "Keselamatan Listrik di Tempat Kerja", "desc" => "Bahaya sengatan listrik, pengamanan panel, grounding, dan pencegahan korsleting.", "tags" => ["Listrik", "Panel"], "stat" => "Sengatan listrik 220V dapat menyebabkan fibrilasi jantung dalam kurun waktu 0.1 detik.", "points" => ["Apakah kabel alat yang dipakai ada yang terkelupas?", "Apakah panel listrik tertutup dan berlabel jelas?", "Siapa yang berwenang melakukan perbaikan listrik?", "Bagaimana pertolongan pertama korban tersengat listrik?"], "steps" => ["Inspeksi kabel dan steker sebelum disambungkan ke sumber listrik", "Jangan menyentuh saklar atau alat listrik dengan tangan basah", "Matikan aliran listrik sebelum membersihkan atau memperbaiki alat", "Gunakan alat listrik bercangkang isolasi ganda (double insulation)"]],
  ["w" => 5, "cat" => "kimia", "title" => "Penanganan Bahan Kimia Berbahaya (B3)", "desc" => "Membaca Lembar Data Keselamatan Bahan (LDKB/SDS), piktogram bahaya, dan APD khusus.", "tags" => ["B3", "SDS"], "stat" => "60% kecelakaan bahan kimia terjadi karena pekerja tidak membaca SDS terlebih dahulu.", "points" => ["Di mana dokumen SDS untuk bahan kimia yang Anda pakai?", "Apa piktogram bahaya yang tertera pada kemasan?", "APD apa yang wajib dipakai saat menangani B3 ini?", "Bagaimana tindakan darurat jika bahan terpapar ke mata/kulit?"], "steps" => ["Baca dan pahami SDS sebelum membuka kemasan B3", "Gunakan respirator dan sarung tangan tahan kimia yang sesuai", "Pastikan ventilasi area cukup saat menggunakan bahan kimia evaporatif", "Cuci tangan dan bilas kulit segera jika terkena cipratan B3"]],
  ["w" => 6, "cat" => "umum", "title" => "Housekeeping & Penerapan 5S", "desc" => "Prinsip Ringkas, Rapi, Resik, Rawat, Rajin (5S) untuk area kerja yang aman dan efisien.", "tags" => ["5S", "Housekeeping"], "stat" => "Housekeeping yang buruk menjadi faktor penyebab 15% insiden terpeleset dan tersandung.", "points" => ["Apakah area kerja Anda bebas dari genangan oli atau air?", "Apakah akses jalan dan tangga terhalang tumpukan barang?", "Di mana tempat penyimpanan alat kerja setelah selesai?", "Apakah sampah dipisah sesuai jenisnya?"], "steps" => ["Singkirkan barang yang tidak diperlukan dari lokasi kerja", "Kembalikan peralatan ke tempatnya semula setelah dipakai", "Bersihkan ceceran oli atau cairan segera dengan absorbent", "Pastikan jalur evakuasi tidak tertutup barang apapun"]],
  ["w" => 7, "cat" => "umum", "title" => "Near Miss — Melaporkan Hampir Celaka", "desc" => "Pentingnya melaporkan kejadian near miss untuk mencegah kecelakaan berat di masa depan.", "tags" => ["Near Miss", "Budaya K3"], "stat" => "Menurut Piramida Heinrich, di balik 1 kecelakaan fatal terdapat 300 kejadian near miss.", "points" => ["Apakah Anda pernah mengalami hampir celaka di lokasi ini?", "Mengapa sebagian orang enggan melaporkan near miss?", "Bagaimana cara mengisi formulir Laporan Near Miss?", "Apa manfaat laporan near miss bagi keselamatan tim?"], "steps" => ["Segera amankan bahaya jika memungkinkan", "Laporkan kejadian near miss kepada supervisor atau HSE", "Tulis kronologi kejadian secara jujur tanpa rasa takut disalahkan", "Diskusikan tindakan pencegahan bersama seluruh anggota tim"]],
  ["w" => 8, "cat" => "kesehatan", "title" => "Ergonomi & Manual Handling", "desc" => "Teknik mengangkat beban manual yang benar untuk mencegah cedera tulang belakang (LBP).", "tags" => ["Ergonomi", "Manual Handling"], "stat" => "30% kasus penyakit akibat kerja (PAK) di industri manufaktur adalah cedera otot dan tulang.", "points" => ["Berapa batas beban maksimal yang aman diangkat satu orang?", "Bagaimana posisi punggung dan lutut saat mengangkat?", "Kapan Anda harus menggunakan alat bantu angkat?", "Apakah Anda merasakan nyeri punggung setelah bekerja?"], "steps" => ["Nilai berat dan ukuran barang sebelum diangkat", "Posisikan kaki selebar bahu dan dekatkan beban ke tubuh", "Tekuk lutut dan angkat menggunakan kekuatan otot kaki, bukan punggung", "Minta bantuan rekan kerja jika beban melebihi 25 kg"]],
  ["w" => 9, "cat" => "kebakaran", "title" => "Prosedur Evakuasi Darurat", "desc" => "Langkah yang harus dilakukan saat alarm darurat berbunyi dan penentuan titik kumpul (muster point).", "tags" => ["Evakuasi", "Muster Point"], "stat" => "Waktu evakuasi aman gedung bertingkat idealnya di bawah 3 menit dari alarm awal.", "points" => ["Di mana titik kumpul aman (muster point) terdekat?", "Siapa petugas fire warden di lantai/area Anda?", "Mengapa dilarang menggunakan lift saat evakuasi kebakaran?", "Apa yang dilakukan jika ada rekan yang tidak berada di titik kumpul?"], "steps" => ["Tetap tenang saat alarm sirine berbunyi", "Tinggalkan pekerjaan dan keluar melalui jalur evakuasi", "Jangan kembali mengambil barang pribadi yang tertinggal", "Laporkan diri Anda ke pimpinan assembly point untuk penghitungan jumlah"]],
  ["w" => 10, "cat" => "umum", "title" => "Investigasi Kecelakaan & Metode 5-Why", "desc" => "Mencari akar penyebab masalah (root cause) dari suatu insiden tanpa menyalahkan individu.", "tags" => ["Investigasi", "5-Why"], "stat" => "80% insiden disebabkan oleh kelemahan sistem manajemen dan prosedur, bukan human error semata.", "points" => ["Apa perbedaan penyebab langsung dan akar masalah?", "Bagaimana prinsip menanyakan 'Mengapa' sebanyak 5 kali?", "Siapa saja yang wajib terlibat dalam investigasi insiden?", "Mengapa bukti fisik di TKP tidak boleh diubah sebelum difoto?"], "steps" => ["Amankan lokasi kejadian kecelakaan segera", "Kumpulkan fakta, foto lokasi, dan data teknis", "Wawancarai saksi mata dengan pendekatan simpatik", "Gunakan metode 5-Why untuk menemukan koreksi sistem"]],
  ["w" => 11, "cat" => "ketinggian", "title" => "Penggunaan Scaffolding yang Aman", "desc" => "Inspeksi perancah, tag hijau/merah, beban maksimal, dan akses tangga.", "tags" => ["Scaffolding", "Ketinggian"], "stat" => "4.500 cedera scaffolding terjadi tiap tahun karena modifikasi tidak resmi.", "points" => ["Apakah scaffolding memiliki tag hijau aktif?", "Apakah papan perancah terpasang rapat?", "Apakah outrigger dan baseplate stabil?", "Siapa scaffolder tersertifikasi di site?"], "steps" => ["Cek status tag scaffolding sebelum naik", "Gunakan tangga akses khusus, jangan memanjat pipa", "Pastikan handrail dan toeboard terpasang rapat", "Dilarang memindahkan komponen scaffolding sendiri"]],
  ["w" => 12, "cat" => "listrik", "title" => "Lock Out Tag Out (LOTO) 6 Langkah", "desc" => "Prosedur mengunci dan menandai sumber energi sebelum perbaikan mesin.", "tags" => ["LOTO", "Isolasi"], "stat" => "LOTO mencegah lebih dari 120 kematian dan 50.000 cedera per tahun.", "points" => ["Siapa pemegang kunci LOTO mesin ini?", "Bagaimana cara melakukan tes verifikasi nol energi?", "Kapan tag merah boleh dilepas?", "Apa risiko jika LOTO diabaikan?"], "steps" => ["Identifikasi seluruh sumber energi (listrik, hidrolik, pneumatik)", "Matikan mesin dan putus sumber daya utama", "Pasang pad-lock pribadi dan tag LOTO beridentitas", "Lakukan tes coba nyalakan untuk verifikasi isolasi total"]],
  ["w" => 13, "cat" => "kimia", "title" => "Respirator & Fit Test Pernapasan", "desc" => "Jenis filter respirator, uji kerapatan (fit test), dan pemeliharaan alat.", "tags" => ["Respirator", "Fit Test"], "stat" => "Paparan debu dan uap beracun menyebabkan 2 juta kematian industri/tahun.", "points" => ["Filter tipe apa yang cocok untuk gas/debu ini?", "Bagaimana cara uji seal tekanan positif & negatif?", "Kapan cartridge respirator harus diganti?", "Di mana tempat menyimpan respirator yang benar?"], "steps" => ["Pilih tipe filter sesuai SDS bahan kimia", "Lakukan fit test sebelum memasuki area terkontaminasi", "Ganti filter jika tarikan napas terasa berat atau tercium bau", "Simpan dalam kantong klip kedap udara setelah dibersihkan"]],
  ["w" => 14, "cat" => "kesehatan", "title" => "Heat Stress & Pencegahan Dehidrasi", "desc" => "Bahaya suhu tinggi, gejala heat exhaustion vs heat stroke, dan pola minum.", "tags" => ["Heat Stress", "Kesehatan"], "stat" => "Heat stroke dapat fatal dalam waktu 10-15 menit jika tidak ditangani medis.", "points" => ["Berapa gelas air yang sudah Anda minum hari ini?", "Apa beda keringat dingin berlebih vs kulit kering panas?", "Di mana tempat istirahat teduh terdekat?", "Bagaimana pertolongan pertama korban pingsan kepanasan?"], "steps" => ["Minum air putih 200 ml setiap 20 menit saat bekerja di cuaca panas", "Manfaatkan waktu istirahat di area teduh ber-AC atau berangin", "Gunakan pakaian kerja yang menyerap keringat dan berwarna terang", "Segera kompres es dan panggil ambulans jika korban berhenti berkeringat"]],
  ["w" => 15, "cat" => "alatberat", "title" => "Defensive Driving & Blind Spot Kendaraan", "desc" => "Mengemudi aman di area proyek/site, batas kecepatan, dan zona titik buta.", "tags" => ["Defensive Driving", "Blind Spot"], "stat" => "25% kecelakaan fatal di lokasi kerja melibatkan kendaraan operasional.", "points" => ["Di mana saja titik blind spot truk atau excavator ini?", "Berapa batas kecepatan maksimal di area lapangan?", "Apakah sabuk pengaman sudah terpasang?", "Bagaimana cara komunikasi driver dengan pejalan kaki?"], "steps" => ["Patuhi batas kecepatan area proyek (max 20 km/jam)", "Bunyikan klakson 2 kali sebelum maju dan 3 kali sebelum mundur", "Pastikan kontak mata dengan operator sebelum melintas di sekitar alat berat", "Selalu gunakan sabuk pengaman 3 titik saat mengemudi"]],
  ["w" => 16, "cat" => "kesehatan", "title" => "Pencegahan Musculoskeletal Disorders (MSDs)", "desc" => "Penataan posisi duduk, berdiri, dan gerakan repetitive saat bekerja.", "tags" => ["MSDs", "Ergonomi"], "stat" => "50% klaim kesehatan pekerja terkait masalah gangguan otot rangka.", "points" => ["Apakah tinggi layar komputer/meja sudah setinggi mata?", "Sudah berapa lama Anda dalam posisi duduk/berdiri statis?", "Apakah jari/pergelangan tangan terasa kesemutan?", "Gerakan peregangan apa yang paling cocok untuk otot Anda?"], "steps" => ["Atur posisi kursi agar paha sejajar lantai dan punggung tertopang", "Lakukan peregangan singkat (stretching) setiap 45 menit", "Variasikan tugas kerja untuk menghindari gerakan berulang yang lama", "Hindari membungkuk saat mengetik atau mengangkat barang"]],
  ["w" => 17, "cat" => "kebakaran", "title" => "Izin Kerja Panas (Hot Work Permit)", "desc" => "Bahaya las, gerinda, pemotongan besi, pemantau api (fire watch), dan APAR.", "tags" => ["Hot Work", "Las"], "stat" => "10% kebakaran hebat industri dipicu oleh percikan pekerjaan panas.", "points" => ["Apakah area 10 meter sekitar lokasi las sudah bersih dari B3?", "Apakah ada APAR siap pakai di sebelah juru las?", "Siapa yang bertugas sebagai fire watch?", "Berapa lama pemantauan dilakukan setelah pekerjaan selesai?"], "steps" => ["Terbitkan Hot Work Permit dan Lakukan gas test jika di area terbatas", "Tutup celah lantai/dinding dengan terpal tahan api (fire blanket)", "Siapkan fire watch dengan APAR terisi penuh selama kerja berlangsung", "Tetap pantau area kerja minimal 30 menit setelah proses las selesai"]],
  ["w" => 18, "cat" => "tambang", "title" => "Bekerja di Ruang Terbatas (Confined Space)", "desc" => "Pengujian kadar oksigen/gas beracun, ventilation fan, dan petugas jaga.", "tags" => ["Confined Space", "Ruang Terbatas"], "stat" => "60% korban jiwa confined space adalah penyelamat tanpa APD pernapasan.", "points" => ["Apakah kadar oksigen berada di rentang aman (19.5% - 23.5%)?", "Apakah alat detektor gas 4-in-1 sudah dikalibrasi?", "Siapa attendant (petugas jaga) yang berada di luar tangki?", "Bagaimana jalur komunikasi dan penarikan darurat?"], "steps" => ["Lakukan pengujian gas atmosfer (O2, LEL, H2S, CO) sebelum masuk", "Nyalakan blower ventilasi mekanis secara terus menerus", "Wajib ada 1 petugas attendant standby di luar pintu masuk", "Gunakan harness dan tali penyelamat (retrieval line)"]],
  ["w" => 19, "cat" => "kesehatan", "title" => "Pertolongan Pertama (P3K) & Prinsip DRABC", "desc" => "Langkah cepat penanganan korban pingsan, pendarahan, dan cedera.", "tags" => ["P3K", "First Aid"], "stat" => "Penanganan P3K yang tepat dalam 4 menit pertama menyelamatkan 50% nyawa.", "points" => ["Di mana lokasi kotak P3K terdekat di gedung ini?", "Apa arti urutan Danger, Response, Airway, Breathing, Circulation?", "Siapa petugas P3K tersertifikasi di tim kita?", "Nomor darurat medis berapa yang harus dihubungi?"], "steps" => ["D - Danger: Amankan lokasi kejadian dari bahaya lanjutan", "R - Response: Cek kesadaran korban dengan menepuk bahu", "A & B: Buka jalan napas dan periksa hembusan napas", "C - Call: Hubungi tim medis internal atau ambulans 119"]],
  ["w" => 20, "cat" => "umum", "title" => "Safety Observation Card (SOC) & Feedback", "desc" => "Teknik melakukan observasi perilaku aman dan mengoreksi tindakan berbahaya.", "tags" => ["SOC", "Observasi"], "stat" => "Perusahaan dengan program SOC aktif berhasil menurunkan LTIR hingga 40%.", "points" => ["Berapa target kartu SOC yang ditulis tim Anda bulan ini?", "Bagaimana cara memberi teguran yang sopan tapi tegas?", "Apakah kartu SOC digunakan untuk mengapresiasi hal positif?", "Bagaimana tindak lanjut hasil temuan SOC?"], "steps" => ["Amati perilaku kerja rekan tanpa mengganggu konsentrasi mereka", "Beri pujian langsung jika melihat perilaku kerja sangat aman", "Hentikan dan diskusikan risiko jika melihat tindakan tidak aman", "Catat dalam lembar/aplikasi SOC untuk analisis tren keselamatan"]],
  ["w" => 21, "cat" => "ketinggian", "title" => "Keselamatan Penggunaan Tangga (Ladder Safety)", "desc" => "Aturan rasio 4:1, 3 titik kontak, inspeksi karet kaki, dan batas beban.", "tags" => ["Tangga", "Ketinggian"], "stat" => "Lebih dari 300 cedera tangga terjadi tiap tahun akibat posisi miring.", "points" => ["Apakah karet dudukan kaki tangga dalam kondisi utuh?", "Apakah sudut kemiringan tangga sudah memenuhi aturan 4:1?", "Apakah Anda selalu menjaga 3 titik kontak saat naik?", "Boleh kah berdiri di anak tangga paling atas?"], "steps" => ["Periksa keutuhan struktur tangga aluminum/fibreglass sebelum dipakai", "Posisikan tangga dengan kemiringan 75 derajat (rasio 4:1)", "Pertahankan 3 titik kontak (2 tangan 1 kaki / 1 tangan 2 kaki)", "Dilarang membawa alat berat di tangan saat memanjat tangga"]],
  ["w" => 22, "cat" => "kimia", "title" => "Penanganan Tumpahan Bahan Kimia (Spill Kit)", "desc" => "Cara menggunakan absorbent pad, boomer, dan APD saat tumpahan B3.", "tags" => ["Spill Kit", "Tumpahan"], "stat" => "Tumpahan kimia yang terlambat ditangani berisiko mencemari tanah & air.", "points" => ["Di mana lokasi ember/kotak Spill Kit terdekat?", "APD apa yang harus dipakai sebelum menyentuh tumpahan?", "Apakah Anda tahu beda kain absorbent untuk oli vs air?", "Ke mana limbah bekas pembersihan tumpahan dibuang?"], "steps" => ["Amankan area tumpahan dan jauhkan sumber nyala api", "Gunakan APD lengkap (sarung tangan B3, kacamata, bot safety)", "Bendung ikatan tumpahan dengan absorbent boom/sausage", "Masukkan absorbent yang terkontaminasi ke dalam kantong limbah B3"]],
  ["w" => 23, "cat" => "kesehatan", "title" => "Stress, Fatigue & Pola Tidur Pekerja", "desc" => "Pengaruh kurang tidur terhadap konsentrasi, micro-sleep, dan kelelahan.", "tags" => ["Fatigue", "Kesehatan"], "stat" => "Pekerja yang kurang tidur (< 6 jam) 3 kali lebih berisiko mengalami kecelakaan.", "points" => ["Berapa jam Anda tidur rata-rata dalam semalam?", "Apa tanda-tanda tubuh Anda mengalami micro-sleep?", "Bagaimana prosedur lapor jika merasa sangat mengantuk saat kerja?", "Apakah Anda banyak bergantung pada minuman berkafein tinggi?"], "steps" => ["Usahakan tidur berkualitas minimal 7-8 jam sebelum shift kerja", "Jika mengantuk berat saat mengoperasikan mesin, SEGERA lapor supervisor", "Lakukan peregangan ringan dan minum air putih dingin", "Hindari mengonsumsi kafein berlebih mendekati akhir shift"]],
  ["w" => 24, "cat" => "umum", "title" => "Sistem Izin Kerja (Permit to Work / PTW)", "desc" => "Jenis izin kerja khusus (ketinggian, panas, confined space, penggalian).", "tags" => ["PTW", "Izin Kerja"], "stat" => "80% insiden pekerjaan berisiko tinggi disebabkan tidak adanya dokumen PTW valid.", "points" => ["Pekerjaan apa saja di lokasi ini yang wajib dokumen PTW?", "Apakah syarat pra-pekerjaan pada PTW sudah diverifikasi?", "Siapa yang berwenang menandatangani persetujuan PTW?", "Kapan izin kerja PTW dinyatakan kedaluwarsa?"], "steps" => ["Identifikasi kategori risiko pekerjaan sebelum dimulai", "Lengkapi checklist keselamatan dan lampirkan JSA/IBPR", "Minta verifikasi fisik lokasi dari HSE atau Authorizer", "Tutup dokumen PTW setelah area kerja dibersihkan dan aman"]],
  ["w" => 25, "cat" => "umum", "title" => "Visible Safety Leadership bagi Supervisor", "desc" => "Peran pengawas dalam memberi contoh perilaku K3 di lapangan.", "tags" => ["Leadership", "Budaya K3"], "stat" => "Tim dengan pengawas peduli K3 memiliki tingkat insiden 55% lebih rendah.", "points" => ["Apakah supervisor Anda rutin hadir di safety talk harian?", "Bagaimana respons pimpinan saat ada usulan perbaikan K3?", "Apakah pimpinan konsisten memakai APD lengkap di lapangan?", "Apakah keselamatan menjadi agenda utama setiap rapat operasional?"], "steps" => ["Jadikan K3 sebagai prioritas pertama sebelum pembicaraan target produksi", "Berikan teladan nyata dengan selalu mematuhi seluruh aturan K3", "Berikan apresiasi terbuka kepada pekerja yang disiplin K3", "Tindak lanjuti setiap temuan bahaya lapangan tanpa menunda"]],
  ["w" => 26, "cat" => "lingkungan", "title" => "Pengelolaan TPS Limbah B3 & Pemilahan", "desc" => "Kriteria penyimpanan sementara limbah B3, labeling, dan izin TPS.", "tags" => ["TPS B3", "Lingkungan"], "stat" => "Pelanggaran pembuangan limbah B3 ilegal terancam pidana & denda berat.", "points" => ["Manakah simbol label untuk limbah beracun vs infeksius?", "Berapa lama batas maksimal penyimpanan limbah B3 di TPS?", "Apakah TPS B3 dilengkapi drum penampung tumpahan (spill tray)?", "Siapa transporter resmi penarik limbah B3 perusahaan?"], "steps" => ["Pisahkan sampah domestik, daur ulang, dan limbah B3 di tempatnya", "Pastikan drum limbah B3 tertutup rapat dan diberi label jelas", "Catat volume masuk-keluar limbah B3 di buku neraca TPS", "Dilarang membuang sisa cairan B3 ke saluran got umum"]],
  ["w" => 27, "cat" => "umum", "title" => "Hak Menghentikan Pekerjaan (Stop Work Authority)", "desc" => "Wewenang setiap pekerja untuk menghentikan tugas jika menemukan bahaya.", "tags" => ["SWA", "Budaya K3"], "stat" => "Perusahaan yang menerapkan SWA aktif memiliki fatalitas mendekati 0.", "points" => ["Apakah Anda tahu bahwa Anda BERHAK menghentikan kerja yang berbahaya?", "Apakah ada sanksi jika Anda menggunakan SWA dengan niat baik?", "Bagaimana cara menyuarakan SWA secara profesional di lapangan?", "Siapa yang mengevaluasi ulang sebelum kerja boleh dilanjutkan?"], "steps" => ["Gunakan SWA jika melihat kondisi/tindakan berbahaya mengancam nyawa", "Sampaikan informasi penghentian kerja dengan sopan dan jelas", "Diskusikan solusi pengendalian bahaya bersama supervisor & HSE", "Lanjutkan pekerjaan HANYA setelah lokasi dipastikan aman"]],
  ["w" => 28, "cat" => "alatberat", "title" => "Operasi Lift Crane & Inspeksi Rigging", "desc" => "Kapasitas angkut aman (SWL), load chart, kawat seling, dan rigger.", "tags" => ["Crane", "Rigging"], "stat" => "Kecelakaan crane sering berakibat fatal dan kehancuran struktur hebat.", "points" => ["Apakah sertifikat SILO crane masih berlaku?", "Di mana posisi load chart di dalam kabin operator?", "Bagaimana kondisi kawat seling/webbing sling (ada serat putus)?", "Apakah rigger sudah memakai rompi khusus pemberi aba-aba?"], "steps" => ["Periksa kondisi fisik kawat seling, shackle, dan hook sebelum lifting", "Pastikan outrigger crane terpasang penuh di atas landasan padat", "Dilarang melintas atau berdiri di bawah beban yang sedang terangkat", "Patuhi instruksi sinyal tangan hanya dari 1 orang rigger yang ditunjuk"]],
  ["w" => 29, "cat" => "alatberat", "title" => "Keselamatan Operasional Forklift", "desc" => "Batas kecepatan di dalam gudang, ketinggian garpu, dan bahaya terguling.", "tags" => ["Forklift", "Gudang"], "stat" => "Terguling (tip-over) adalah penyebab kematian terbanyak operator forklift.", "points" => ["Berapa kapasitas beban maksimal pada plat nama forklift?", "Bagaimana posisi tinggi garpu saat membawa beban berjalan?", "Apakah alarm mundur dan lampu rotari (beacon) berfungsi?", "Apa yang dilakukan jika beban menghalangi pandangan ke depan?"], "steps" => ["Lakukan P2H (Pemeriksaan Pra-Harian) forklift sebelum shift", "Jalankan forklift dengan garpu berjarak 10-15 cm dari lantai", "Jika beban menutupi pandangan depan, kemudikan forklift mundur", "Kurangi kecepatan dan bunyikan klakson di setiap persimpangan gudang"]],
  ["w" => 30, "cat" => "kesehatan", "title" => "Keamanan Pangan & Kebersihan Mess/Kantin", "desc" => "Pencegahan keracunan makanan, sanitasi air, dan kebersihan dapur.", "tags" => ["Kesehatan", "Kantin"], "stat" => "Keracunan makanan dapat melumpuhkan operasional shift kerja sekaligus.", "points" => ["Apakah fasilitas tempat makan di lokasi bersih dan terbebas dari lalat?", "Apakah juru masak kantin sudah melalui tes kesehatan rutin?", "Apakah Anda selalu mencuci tangan sebelum mengambil makanan?", "Bagaimana cara menyimpan sisa makanan agar tidak basi?"], "steps" => ["Cuci tangan pakai sabun di air mengalir sebelum dan sesudah makan", "Hindari mengonsumsi makanan yang berbau atau berubah warna", "Jaga kebersihan meja makan dan buang sisa makanan di tempatnya", "Laporkan ke tim medis jika mengalami gejala mual/diare massal"]],
  ["w" => 31, "cat" => "kebakaran", "title" => "Emergency Response Plan (ERP) & Tim Tanggap Darurat", "desc" => "Struktur organisasi ERP, peran warden, first aider, dan komunikasi.", "tags" => ["ERP", "Tanggap Darurat"], "stat" => "Respons darurat yang terorganisir menekan korban hingga 80%.", "points" => ["Siapa ketua tim tanggap darurat (Emergency Commander) di site?", "Di mana tombol manual break-glass alarm terdekat?", "Frekuensi radio berapa yang digunakan khusus jalur darurat?", "Berapa kali simulasi tanggap darurat dilakukan dalam setahun?"], "steps" => ["Hafalkan nomor telepon darurat internal dan pos komando", "Ikuti petunjuk dari floor warden saat terjadi kondisi darurat", "Jangan menyebarkan berita hoaks/spekulasi saat insiden terjadi", "Ikuti gladi simulasi tanggap darurat dengan serius"]],
  ["w" => 32, "cat" => "kesehatan", "title" => "Keselamatan Bekerja Shift Malam (Night Shift)", "desc" => "Menjaga ritme sirkadian, pencahayaan memadai, dan pengawasan ekstra.", "tags" => ["Shift Malam", "Fatigue"], "stat" => "Risiko kesalahan kerja meningkat 30% pada pukul 02.00 - 05.00 pagi.", "points" => ["Apakah penerangan di area kerja malam Anda sudah mencukupi?", "Bagaimana sistem komunikasi check-in berkala untuk pekerja solo?", "Apakah Anda memanfaatkan waktu istirahat malam dengan baik?", "Bagaimana kesiapan tim medis di shift malam?"], "steps" => ["Pastikan lampu sorot penerangan menerangi seluruh area kerja", "Tingkatkan frekuensi komunikasi antar rekan kerja di jam rawan kantuk", "Konsumsi makanan ringan tinggi protein dan batasi kopi manis", "Lakukan pergantian tugas berisiko tinggi secara berkala"]],
  ["w" => 33, "cat" => "umum", "title" => "Keselamatan Cuaca Ekstrem, Petir & Hujan", "desc" => "Aturan 30-30 untuk petir, angin kencang, dan tempat perlindungan aman.", "tags" => ["Petir", "Cuaca Ekstrem"], "stat" => "Indonesia memiliki intensitas sambaran petir harian tertinggi di dunia.", "points" => ["Bagaimana cara menghitung jarak petir dengan jeda guntur?", "Di mana lokasi shelter petir ber-grounding aman di lapangan?", "Kapan pekerjaan outdoor wajib dihentikan akibat hujan deras?", "Apakah struktur kanopi outdoor aman dari risiko angin kencang?"], "steps" => ["Gunakan Aturan 30-30: jika jeda kilat-guntur < 30 detik, stop kerja", "Segera tinggalkan area terbuka, struktur tinggi, dan objek logam", "Berlindung di dalam bangunan tertutup atau dalam kendaraan kabin baja", "Tunggu 30 menit setelah suara guntur terakhir sebelum kembali bekerja"]],
  ["w" => 34, "cat" => "umum", "title" => "Keselamatan Power Tools & Pelindung (Guarding)", "desc" => "Inspeksi gerinda, bor tangan, gergaji mesin, dan pelindung mekanis.", "tags" => ["Power Tools", "Guarding"], "stat" => "40% cedera tangan disebabkan gerinda tanpa pelindung (shield/guard).", "points" => ["Apakah pelindung (guard) pada mesin gerinda terpasang sempurna?", "Apakah tombol saklar on/off berfungsi normal dan tidak tersangkut?", "Apakah saklar kabel memakai pengaman RCD/GFCI?", "APD mata/wajah apa yang wajib dipakai saat mengerinda?"], "steps" => ["Dilarang melepas guard pelindung bawaan pabrik pada power tools", "Periksa batu gerinda dari retakan sebelum dipasang pada mesin", "Gunakan kacamata safety + face shield saat mengerinda", "Cabut steker dari stopkontak saat mengganti mata bor atau mata gerinda"]],
  ["w" => 35, "cat" => "kimia", "title" => "Keselamatan Laboratorium & Bahan Biohazard", "desc" => "Penggunaan lemari asam (fume hood), pembuangan jarum/kaca, dan APD.", "tags" => ["Lab", "Biohazard"], "stat" => "Kecelakaan laboratorium sering kali melibatkan hirupan uap kimia beracun.", "points" => ["Apakah lemari asam (fume hood) menyedot uap dengan baik?", "Di mana tempat pembuangan khusus limbah tajam (sharp container)?", "Apakah eyewash station berfungsi dan airnya jernih?", "Bolehkah membawa makanan/minuman ke dalam laboratorium?"], "steps" => ["Dilarang keras makan, minum, atau menyimpan makanan di laboratorium", "Lakukan pencampuran bahan reaktif hanya di dalam lemari asam", "Gunakan jas lab, sarung tangan nitril, dan kacamata safety lab", "Buang jarum suntik dan pecahan kaca ke dalam kotak biohazard khusus"]],
  ["w" => 36, "cat" => "listrik", "title" => "Keselamatan Ruang Server & Fasilitas IT", "desc" => "Bahaya sistem pemadam CO2/clean agent, kabel berantakan, & listrik statis.", "tags" => ["Server", "IT Safety"], "stat" => "Kebakaran ruang server berisiko merusak seluruh data penting perusahaan.", "points" => ["Apakah kabel-kabel jaringan di bawah lantai raised floor rapi?", "Bagaimana tanda alarm sebelum gas pemadam CO2 disemprotkan?", "Apakah Anda memakai gelang antistatis saat memegang board elektronik?", "Siapa yang memiliki hak akses memasuki ruangan server?"], "steps" => ["Jaga ruang server tetap bersih dari kardus bekas dan bahan mudah terbakar", "Jika alarm pemadam gas berbunyi, SEGERA keluar dan tutup pintu rapat", "Gunakan kabel tray agar tidak ada kabel berserakan di jalan laluan", "Dilarang membawa cairan atau minuman ke dekat rak server"]],
  ["w" => 37, "cat" => "umum", "title" => "Keselamatan Bengkel / Workshop Manufaktur", "desc" => "Penataan mesin bubut, skrap, las, pembersihan tatal besi, & APD.", "tags" => ["Workshop", "Bengkel"], "stat" => "Tatal logam berputar pada mesin bubut berpotensi menyabet anggota tubuh.", "points" => ["Apakah tombol emergency stop pada mesin bubut mudah dijangkau?", "Apakah Anda melepas cincin, jam tangan, & baju longgar di bengkel?", "Gunakan kuas atau kail untuk membersihkan tatal, bukan tangan!", "Apakah lantai bengkel bebas dari ceceran oli pelumas?"], "steps" => ["Lepas perhiasan, dasi, atau pakaian longgar sebelum mengoperasikan mesin", "Pastikan emergency stop button berfungsi sempurna pada setiap mesin", "Gunakan kaca pelindung transparan pada mesin gerinda duduk", "Bersihkan tatal/beram besi menggunakan tongkat pembersih khusus"]],
  ["w" => 38, "cat" => "kesehatan", "title" => "Pencegahan Penyakit Menular di Tempat Kerja", "desc" => "Etika batuk, sanitasi fasilitas umum, imunisasi, dan isolasi mandiri.", "tags" => ["Kesehatan", "Penyakit Menular"], "stat" => "Satu pekerja sakit yang dipaksakan masuk dapat menginfeksi seisi tim.", "points" => ["Apakah Anda merasa demam, batuk, atau flu berat hari ini?", "Apakah ventilasi udara di dalam ruangan kerja berputar baik?", "Bagaimana etika menutup hidung dan mulut saat bersin?", "Apakah Anda sudah melengkapi imunisasi kesehatan harian?"], "steps" => ["Jangan memaksakan masuk kerja jika mengalami gejala penyakit menular", "Gunakan masker dan cuci tangan teratur di fasilitas umum", "Tutup mulut menggunakan siku bagian dalam saat batuk atau bersin", "Laporkan ke tim medis perusahaan untuk rekomendasi istirahat"]],
  ["w" => 39, "cat" => "alatberat", "title" => "Manual Handling & Alat Bantu Hand Truck/Pallet", "desc" => "Kapasitas angkut hand pallet, posisi dorong vs tarik, dan jalan miring.", "tags" => ["Pallet Jack", "Logistik"], "stat" => "Kecelakaan tergilas roda hand pallet sering mencederai kaki pekerja.", "points" => ["Berapa kapasitas tonase maksimal pada dongkrak hand pallet?", "Apakah lebih aman mendorong atau menarik hand pallet?", "Bagaimana kondisi roda hand pallet (apakah ada ganjalan besi)?", "Apakah jalur lorong gudang cukup lebar untuk berpapasan?"], "steps" => ["Posisikan beban seimbang di tengah kedua kaki garpu hand pallet", "Lebih dianjurkan MENDORONG hand pallet daripada menariknya", "Gunakan sepatu safety bertutup baja (steel toe boots)", "Dilarang menumpuk barang terlalu tinggi hingga menghalangi pandangan"]],
  ["w" => 40, "cat" => "konstruksi", "title" => "Keselamatan Pekerjaan Galian & Excavation", "desc" => "Shoring (penyangga), sloping (kemiringan), proteksi tanah longsor.", "tags" => ["Galian", "Shoring"], "stat" => "Longsoran 1 meter kubik tanah memiliki berat sekitar 1.5 ton.", "points" => ["Apakah galian dengan kedalaman > 1.2 meter sudah dipasang shoring?", "Apakah ada tangga akses keluar-masuk galian setiap jarak 7.5 meter?", "Berapa jarak aman penumpukan tanah galian dari bibir lubang?", "Apakah sudah dilakukan tes jaringan listrik/pipa bawah tanah?"], "steps" => ["Pasang sistem penyangga dinding tanah (shoring) pada galian dalam", "Tempatkan tumpukan tanah galian minimal 1 meter dari tepi galian", "Periksa kestabilan tanah setiap hari terutama setelah hujan turun", "Sediakan tangga akses yang menonjol 1 meter di atas permukaan"]],
  ["w" => 41, "cat" => "umum", "title" => "Induksi K3 Pekerja Baru & Tamu (Onboarding)", "desc" => "Pemahaman risiko area, kewajiban APD, jalur evakuasi, dan aturan site.", "tags" => ["Induksi", "Visitor"], "stat" => "70% kecelakaan pekerja baru terjadi dalam 90 hari pertama bekerja.", "points" => ["Apakah semua pekerja baru telah lulus tes induksi K3?", "Apakah tamu/visitor didampingi oleh personel escort terlatih?", "Apakah stiker helm induksi telah terpasang rapi?", "Apakah pekerja baru mengenal supervisor dan kawan kerjanya?"], "steps" => ["Wajib ikuti materi induksi K3 sebelum memasuki area operasional", "Pahami seluruh potensi bahaya spesifik di lokasi penugasan", "Tanyakan kepada supervisor senior jika ada prosedur yang membingungkan", "Dampingi tamu (visitor) dan pastikan mereka mengenakan APD wajib"]],
  ["w" => 42, "cat" => "lingkungan", "title" => "Pencegahan Tumpahan Pelumas & Drip Pan", "desc" => "Penggunaan nampan penampung oli (drip pan) di bawah generator/alat.", "tags" => ["Drip Pan", "Oli"], "stat" => "Satu liter oli bekas yang bocor dapat merusak 1 juta liter air bersih.", "points" => ["Apakah genset dan kompresor outdoor sudah dialasi drip pan?", "Apakah valve pembuangan drip pan dalam posisi tertutup?", "Di mana penampungan akhir oli bekas di lokasi proyek?", "Bagaimana tindakan jika drip pan terisi air hujan ber-oli?"], "steps" => ["Pasang drip pan di bawah setiap titik potensi bocoran pelumas mesin", "Kuras dan pindahkan minyak yang tertampung di drip pan secara berkala", "Gunakan kain absorbent pad untuk menyerap lapisan minyak di atas air", "Buang sisa filter oli dan oli bekas ke dalam drum limbah B3"]],
  ["w" => 43, "cat" => "umum", "title" => "Keselamatan Pekerjaan Outdoor Malam Hari", "desc" => "Rompi reflektif (high-vis), penerangan area, dan sistem kawan (buddy).", "tags" => ["Outdoor", "Malam"], "stat" => "Risiko tertabrak kendaraan di malam hari 4 kali lipat dari siang hari.", "points" => ["Apakah rompi Anda memantulkan cahaya (reflective strip) dengan terang?", "Apakah lampu menara penerangan (tower lamp) diarahkan dengan pas?", "Apakah Anda bekerja berpasangan (buddy system)?", "Bagaimana sarana komunikasi radio genggam antar personel?"], "steps" => ["Wajib mengenakan rompi reflektif standar Kelas 2 atau Kelas 3", "Pastikan penerangan menara minimal 50 lux di titik area kerja", "Terapkan buddy system, dilarang bekerja seorang diri di area terpencil", "Bawalah senter genggam cadangan untuk keadaan darurat lampu padam"]],
  ["w" => 44, "cat" => "kebakaran", "title" => "Inspeksi Bulanan APAR & Kartu Gantungan", "desc" => "Cek tekanan manometer, selang, tabung dari karat, dan lokasi APAR.", "tags" => ["APAR", "Inspeksi"], "stat" => "60% APAR di lapangan terbukti rusak saat dibutuhkan akibat tak diinspeksi.", "points" => ["Apakah segel plastik dan pin pengaman APAR masih utuh?", "Apakah jarum indikator tekanan menunjuk tepat pada zona hijau?", "Apakah selang nozzle retak, tersumbat, atau pecah?", "Apakah kartu gantungan inspeksi bulanan sudah di-paraf?"], "steps" => ["Inspeksi seluruh unit APAR secara berkala setiap bulan sekali", "Pastikan posisi APAR tidak terhalang oleh tumpukan barang/meja", "Balikkan tabung APAR powder sesekali agar media tepung tidak menggumpal", "Segera kirim APAR ke bengkel pengisian jika tekanan berkurang"]],
  ["w" => 45, "cat" => "listrik", "title" => "Keselamatan Bejana Tekan & Safety Valve", "desc" => "Inspeksi kompresor, tangki angin, safety relief valve, & kran air.", "tags" => ["Pressure Vessel", "Kompresor"], "stat" => "Ledakan tangki angin kompresor dapat menghancurkan dinding bangunan.", "points" => ["Apakah sertifikat izin layak K3 tangki tekan masih berlaku?", "Apakah katup pengaman (safety relief valve) ditest berfungsi?", "Apakah air kondensasi di dasar tangki dikuras setiap hari?", "Berapa batas tekanan kerja maksimum (MAWP) yang tertera?"], "steps" => ["Kuras air kondensasi di dalam tangki kompresor setiap akhir shift", "Dilarang mengubah atau mengunci setelan safety relief valve", "Pastikan pengukur tekanan (pressure gauge) berfungsi akurat", "Hentikan pengoperasian jika terdengar getaran abnormal atau kebocoran"]],
  ["w" => 46, "cat" => "kimia", "title" => "Keselamatan Tabung Gas Bertekanan (Silinder)", "desc" => "Penyimpanan berantai, penutup valve, pemisahan O2 & asetilen.", "tags" => ["Gas Silinder", "Asetilen"], "stat" => "Tabung gas yang tumbang dan valve-nya patah dapat meluncur seperti roket.", "points" => ["Apakah tabung gas berdiri tegak dan diikat dengan rantai besi?", "Apakah tabung oksigen dipisah minimal 6 meter dari tabung gas mudah terbakar?", "Apakah kap pelindung valve terpasang saat tabung dipindahkan?", "Bagaimana cara mengecek kebocoran gas dengan air sabun?"], "steps" => ["Selalu ikat tabung gas dengan rantai atau bracket penahan yang kuat", "Gunakan troli khusus tabung untuk memindahkan silinder, jangan menggelindingkannya", "Pisahkan penyimpanan tabung Oksigen dari Asetilen/LPG", "Tutup rapat valve utama dan pasang kap pengaman jika tak dipakai"]],
  ["w" => 47, "cat" => "tambang", "title" => "Keselamatan Pekerjaan penyelaman Industri", "desc" => "Diving permit, tabel dekompresi, standby diver, & sistem komunikasi.", "tags" => ["Diving", "Underwater"], "stat" => "Penyakit dekompresi (the bends) berisiko fatal pada penyelam industri.", "points" => ["Apakah seluruh penyelam memiliki lisensi commercial diver aktif?", "Apakah ada penyelam cadangan (standby diver) di atas kapal?", "Bagaimana keandalan kompresor udara bernapas (breathing air)?", "Di mana lokasi kompresor hiperbarik (decompression chamber) terdekat?"], "steps" => ["Lengkapi dokumen Izin Kerja Penyelaman dan riset arus air", "Gunakan sistem komunikasi kabel laut terhubung ke pos pengawas permukaan", "Patuhi batas waktu penyelaman dan kedalaman sesuai tabel dekompresi", "Pastikan ketersediaan pasokan udara darurat (bailout bottle)"]],
  ["w" => 48, "cat" => "alatberat", "title" => "Pencegahan Fatigue Operator Alat Berat", "desc" => "Fit to work test, rekam jam kerja, jeda istirahat, & tes reaksi.", "tags" => ["Fatigue", "Operator"], "stat" => "15% kecelakaan fatal di pertambangan dipicu operator ketiduran (micro-sleep).", "points" => ["Berapa jam total operator mengemudi dalam shift ini?", "Apakah tes reaksi/fatigue check pra-shift telah dilakukan?", "Apakah pendingin udara (AC) di kabin berfungsi sejuk?", "Bagaimana respons operator saat dipanggil lewat radio radio?"], "steps" => ["Batasi jam kerja mengoperasikan alat berat maksimal 12 jam per shift", "Wajibkan istirahat 15 menit setiap 4 jam mengemudi terus-menerus", "Lakukan fatigue check pra-shift dengan mengukur reaksi mata/otak", "Tarik operator keluar kabin jika menunjukkan tanda-tanda mengantuk"]],
  ["w" => 49, "cat" => "umum", "title" => "Arti Warna Rambu K3 & Pemasangan Barikade", "desc" => "Merah (Larangan/Fire), Kuning (Waspada), Biru (Wajib), Hijau (Aman).", "tags" => ["Rambu K3", "Barikade"], "stat" => "30% kecelakaan terjadi karena pekerja mengabaikan rambu peringatan.", "points" => ["Apa beda makna barikade pita merah-putih vs kuning-hitam?", "Apakah lokasi bahaya di area Anda sudah dipasang rambu jelas?", "Siapa yang berwenang melepas barikade keselamatan?", "Apakah arti lambang rambu berbentuk lingkaran biru?"], "steps" => ["Merah: Larangan keras / Pemadam Api; Kuning: Peringatan Bahaya", "Biru: Perintah Wajib (misal wajib pakai APD); Hijau: Petunjuk Informasi/Pertolongan", "Barikade Merah = DILARANG masuk tanpa izin khusus pengawas area", "Pasang barikade yang cukup luas mengelilingi potensi bahaya"]],
  ["w" => 50, "cat" => "umum", "title" => "Pencegahan Cedera Tangan & Jari (Pinch Point)", "desc" => "Titik jepit (pinch point), roda gigi, pintu hidrolik, & sarung tangan.", "tags" => ["Cedera Tangan", "Pinch Point"], "stat" => "Cedera jari & tangan mendominasi 25% dari total kasus kecelakaan kerja.", "points" => ["Di mana saja letak titik jepit (pinch point) pada mesin ini?", "Apakah sarung tangan yang dipakai sesuai dengan jenis pekerjaan?", "Mengapa dilarang pakai sarung tangan saat mengoperasikan mesin berputar?", "Bagaimana posisi tangan Anda saat menempatkan barang berat?"], "steps" => ["Petakan seluruh titik jepit (pinch point) sebelum memulai pekerjaan", "Jauhkan tangan dari area pergerakan engsel, roda gigi, dan silinder", "Gunakan sarung tangan anti-potong (cut-resistant) saat memegang plat tajam", "LEPAS sarung tangan kain/kulit saat bekerja di mesin bubut/bor berputar"]],
  ["w" => 51, "cat" => "umum", "title" => "Kebijakan Bebas Narkoba & Alkohol (Drug & Alcohol)", "desc" => "Pemeriksaan acak (random test), zero tolerance, & dampaknya.", "tags" => ["Narkoba", "Zero Tolerance"], "stat" => "Penggunaan obat terlarang meningkatkan risiko kecelakaan kerja 5 kali lipat.", "points" => ["Apakah Anda memahami kebijakan Zero Tolerance perusahaan?", "Bagaimana prosedur tes acak (random D&A test) di lokasi ini?", "Apakah obat resep dokter yang bikin mengantuk harus dilaporkan?", "Apa sanksi jika terbukti positif mengonsumsi alkohol saat shift?"], "steps" => ["Patuhi aturan Zero Tolerance: Alkohol & Narkoba dilarang keras", "Laporkan ke klinik perusahaan jika Anda mengonsumsi obat resep pengantuk", "Ikuti prosedur pemeriksaan tes urine/alkohol acak secara kooperatif", "Dukung lingkungan kerja yang bersih dan saling mengingatkan rekan"]],
  ["w" => 52, "cat" => "umum", "title" => "Review Evaluasi K3 Tahunan & Target KPI", "desc" => "Menilai pencapaian LTIR, Near Miss, Audit SMK3, dan target baru.", "tags" => ["Review K3", "KPI"], "stat" => "Perusahaan yang melakukan evaluasi K3 tahunan menurunkan kecelakaan 25%.", "points" => ["Berapa jumlah jam kerja selamat yang telah dicapai tim kita?", "Apa tren kecelakaan terbanyak yang terjadi sepanjang tahun lalu?", "Program K3 baru apa yang akan diluncurkan tahun ini?", "Bagaimana peran aktif Anda untuk mencapai target Zero Harm?"], "steps" => ["Tinjau kembali pencapaian indikator K3 (Lagging & Leading Indicators)", "Identifikasi kelemahan sistem dari hasil audit dan investigasi insiden", "Susun rencana aksi K3 yang terukur (SMART) untuk tahun mendatang", "Tingkatkan komitmen bersama seluruh elemen pekerja menuju Zero Incident"]],
  ["w" => 53, "cat" => "teknologi", "title" => "Penerapan AI & Computer Vision untuk Deteksi K3", "desc" => "Kamera pintar AI untuk deteksi APD, area berbahaya, dan Near Miss otomatis.", "tags" => ["AI K3", "Computer Vision"], "stat" => "Kamera AI mampu mendeteksi pelanggaran APD secara real-time dengan akurasi 98%.", "points" => ["Apakah area ini sudah terpantau oleh sistem kamera pintar AI?", "Bagaimana sistem AI memberi peringatan saat ada pekerja tanpa helm?", "Mengapa teknologi AI membantu tugas pengawasan HSE di lapangan?", "Bagaimana privasi data pekerja dijaga dalam sistem CCTV AI?"], "steps" => ["Manfaatkan notifikasi peringatan AI untuk mengoreksi tindakan unsafe", "Pastikan lensa kamera AI tidak terhalang oleh debu atau barang", "Gunakan data analitik AI untuk memetakan lokasi rawan bahaya tinggi", "Jadikan peringatan AI sebagai sarana edukasi positif bagi tim"]],
  ["w" => 54, "cat" => "teknologi", "title" => "Wearable Technology: Helm Smart & Gelang Fatigue", "desc" => "Sensor pintar detektor detak jantung, suhu tubuh, benturan, & kelelahan.", "tags" => ["Wearable Tech", "Smart Helmet"], "stat" => "Gelang sensor pintar mengurangi insiden fatigue hingga 60% pada driver tambang.", "points" => ["Bagaimana helm pintar mengirim sinyal darurat saat pekerja terjatuh?", "Apa arti indikator warna pada gelang pemantau tingkat kelelahan?", "Bagaimana sensor suhu pada smartwatch mencegah heat stroke?", "Apakah perangkat wearable K3 Anda sudah terisi daya (charge) penuh?"], "steps" => ["Kenakan perangkat wearable pintar sesuai petunjuk penggunaan", "Pastikan baterai perangkat wearable diisi daya penuh sebelum shift", "Segera respon jika gelang pintar bergetar memberi peringatan fatigue", "Laporkan ke bagian IT/HSE jika sensor perangkat mengalami kerusakan"]],
  ["w" => 55, "cat" => "teknologi", "title" => "Drone Inspection untuk Ketinggian & Confined Space", "desc" => "Penggunaan drone untuk inspeksi atap, cerobong, tangki, & area berisiko.", "tags" => ["Drone K3", "Inspeksi"], "stat" => "Penggunaan drone mengeliminasi 80% kebutuhan pekerja memanjat area bahaya.", "points" => ["Area tinggi/sempit mana yang kini bisa diinspeksi memakai drone?", "Mengapa inspeksi visual drone lebih aman dibanding man-cage?", "Sertifikasi apa yang wajib dimiliki oleh pilot drone industri?", "Bagaimana cara analisis foto/video hasil rekaman drone?"], "steps" => ["Gunakan drone untuk inspeksi awal area ketinggian berisiko ekstrem", "Pastikan pilot drone memiliki lisensi dan izin terbang area proyek", "Jaga jarak aman dari baling-baling drone yang sedang beroperasi", "Gunakan data citra thermal drone untuk mendeteksi kebocoran panas/gas"]],
  ["w" => 56, "cat" => "teknologi", "title" => "Digital Permit to Work (e-PTW) & Sensor IoT", "desc" => "Pengajuan izin kerja digital via aplikasi HP dan integrasi sensor gas IoT.", "tags" => ["e-PTW", "IoT K3"], "stat" => "Aplikasi e-PTW mempercepat proses persetujuan izin kerja hingga 70%.", "points" => ["Apakah Anda sudah mengunduh aplikasi e-PTW di HP operasional?", "Bagaimana cara memindai QR-code pada lokasi kerja sebelum mulai?", "Bagaimana sensor gas IoT mengirim data langsung ke dashboard HP?", "Apa kemudahan e-PTW dibanding formulir kertas konvensional?"], "steps" => ["Ajukan e-PTW melalui aplikasi minimal 2 jam sebelum pekerjaan dimulai", "Lampirkan foto bukti kondisi lokasi kerja pada sistem e-PTW", "Scan QR-code di lokasi untuk memverifikasi kehadiran personel valid", "Pantau pembaruan status izin kerja secara langsung di layar smartphone"]],
  ["w" => 57, "cat" => "teknologi", "title" => "AI Predictive Analytics & Analisis Risiko K3", "desc" => "Memprediksi potensi kecelakaan kerja berdasarkan data historis & cuaca.", "tags" => ["Predictive AI", "Risk Analytics"], "stat" => "Model AI prediksi K3 mampu mengantisipasi 75% insiden sebelum terjadi.", "points" => ["Bagaimana algoritma AI memprediksi hari/jam paling rawan kecelakaan?", "Data apa saja yang diolah AI untuk menghitung skor risiko harian?", "Bagaimana supervisor menggunakan skor AI untuk menyusun safety talk?", "Mengapa pelaporan data near miss yang akurat sangat penting bagi AI?"], "steps" => ["Periksa skor tingkat risiko harian yang dihasilkan oleh sistem AI", "Fokuskan pengawasan ekstra pada area yang diberi status risiko tinggi oleh AI", "Input data laporan near miss dan SOC secara jujur untuk melatih AI", "Gunakan rekomendasi tindakan dari AI saat memimpin toolbox meeting"]],
  ["w" => 58, "cat" => "kesehatan", "title" => "Pencegahan Gangguan Pendengaran (Noise & Ear Protection)", "desc" => "Desibel batas aman 85 dB, earplug vs earmuff, & audiometri.", "tags" => ["Noise", "Earplug"], "stat" => "Paparan bising > 85 dB selama 8 jam berisiko sebabkan tuli permanen.", "points" => ["Berapa nilai NRR (Noise Reduction Rating) pada sumbat telinga Anda?", "Apakah Anda bisa mendengar suara alarm saat memakai earmuff?", "Bagaimana cara mencuci earplug silikon yang benar?", "Kapan tes audiometri tahunan Anda dijadwalkan?"], "steps" => ["Wajib pakai alat pelindung telinga (APT) di area berisiko bising > 85 dB", "Gulung dan masukkan earplug hingga menyumbat saluran telinga dengan pas", "Bersihkan atau ganti earplug secara berkala agar tidak infeksi", "Batasi waktu paparan di area mesin bising tinggi"]],
  ["w" => 59, "cat" => "konstruksi", "title" => "Keselamatan Bekerja pada Pengecoran Beton", "desc" => "Tekanan pompa beton, pipa tremie, sepatu boots, & perancah bekisting.", "tags" => ["Pengecoran", "Beton"], "stat" => "Kecelakaan patahnya pipa boom beton berpotensi fatal pada pekerja di bawah.", "points" => ["Apakah perancah penyangga bekisting beton sudah diinspeksi insinyur?", "Di mana zona bahaya kibasan selang pompa beton (concrete pump)?", "APD apa yang wajib untuk mencegah iritasi kulit dari semen basah?", "Bagaimana cara aman membersihkan pipa sisa coran?"], "steps" => ["Periksa kekuatan struktur penopang bekisting sebelum penuangan beton", "Gunakan kacamata safety dan sepatu boots karet tahan air semen", "Jauhi zona jangkauan kibasan ujung selang pompa beton", "Gunakan sarung tangan karet tipis berlapis saat meratakan coran"]],
  ["w" => 60, "cat" => "konstruksi", "title" => "Keselamatan Bekerja pada Pembongkaran Bekisting", "desc" => "Risiko tertimpa kayu/besi bekisting, kuku tancap, & proteksi jatuh.", "tags" => ["Bekisting", "Konstruksi"], "stat" => "Tertimpa reruntuhan bekisting adalah penyebab cedera konstruksi tersering.", "points" => ["Apakah beton sudah mencapai umur matang (curing) yang cukup?", "Apakah area di bawah lokasi pelepasan bekisting sudah dibarikade?", "Bagaimana cara menangani kayu bekisting yang penuh paku menancap?", "Apakah pekerja pembongkaran memakai harness terikat?"], "steps" => ["Dapatkan persetujuan struktur sebelum memulai pembongkaran bekisting", "Pasang barikade dan rambu larangan melintas di area bawah bongkaran", "Cabut atau bengkokkan paku yang menonjol dari kayu bekisting", "Gunakan full body harness saat melepas bekisting di sisi tepi luar"]],
  ["w" => 61, "cat" => "listrik", "title" => "Grounding Sistem Listrik & Penyalur Petir", "desc" => "Fungsi pembumian (grounding), batasan nilai ohm, dan kawat tembaga.", "tags" => ["Grounding", "Listrik"], "stat" => "Sistem grounding yang baik (< 5 Ohm) menetralisir arus bocor berbahaya.", "points" => ["Berapa nilai resistansi tanah grounding di lokasi ini (max 5 Ohm)?", "Apakah kawat grounding terhubung erat ke bodi mesin baja?", "Bagaimana cara mengecek koneksi kawat pembumian yang korosi?", "Mengapa grounding penting saat pengisian BBM/kimia cair?"], "steps" => ["Pastikan kawat kabel grounding terpasang kuat pada rangka mesin", "Lakukan pengukuran rutin nilai tahanan tanah pembumian dengan Earth Tester", "Sambungkan kawat bonding grounding sebelum memindahkan cairan FLammable", "Jangan memotong atau melepas kabel pembumian yang terpasang"]],
  ["w" => 62, "cat" => "listrik", "title" => "Bekerja Dekat Saluran Listrik Tegangan Tinggi (SUTET)", "desc" => "Jarak aman minimum (MAD), bahaya loncatan listrik (arc-over).", "tags" => ["SUTET", "High Voltage"], "stat" => "Listrik tegangan tinggi dapat melompat tanpa perlu kontak fisik langsung.", "points" => ["Berapa jarak aman minimum (MAD) dari kabel SUTET 150kV?", "Apakah boom crane dipasang pembatas tinggi (height limiter)?", "Siapa penanggung jawab koordinasi dengan pihak PLN?", "Apa yang harus dilakukan jika kendaraan menyentuh kabel bertegangan?"], "steps" => ["Pertahankan jarak aman minimum (minimal 5 meter dari SUTET)", "Gunakan pemandu jalan (spotter) saat mengemudikan alat tinggi di bawah kabel", "Jika kendaraan menyentuh kabel: TETAP DI DALAM KABIN dan panggil bantuan", "Dilarang mendirikan perancah atau menumpuk material di bawah SUTET"]],
  ["w" => 63, "cat" => "kebakaran", "title" => "Sistem Proteksi Kebakaran Hydrant & Sprinkler", "desc" => "Tekanan pompa hydrant, selang (hose), nozel, dan jaringan sprinkler.", "tags" => ["Hydrant", "Sprinkler"], "stat" => "Sistem sprinkler otomatis memadamkan 95% kebakaran awal gedung.", "points" => ["Di mana titik hydrant box dan hydrant pilar terdekat?", "Apakah kunci pembuka valve pilar hydrant tersedia di kotak?", "Apakah kepala sprinkler terhalang oleh tumpukan barang gudang?", "Bagaimana cara menggelar selang hydrant yang tidak melilit?"], "steps" => ["Jaga jarak tumpukan barang minimal 45 cm dari kepala sprinkler", "Pastikan akses menuju pilar dan box hydrant bebas dari halangan", "Lakukan tes jalan (running test) pompa pemadam kebakaran tiap minggu", "Gulung dan keringkan selang hydrant setelah digunakan latihan"]],
  ["w" => 64, "cat" => "kimia", "title" => "Matriks Kompatibilitas Penyimpanan Bahan B3", "desc" => "Bahaya reaksi bahan kimia (oksidator, mudah terbakar, korosif).", "tags" => ["Kompatibilitas", "Storage B3"], "stat" => "Campuran bahan kimia inkompatibel dapat memicu ledakan spontan.", "points" => ["Bolehkah bahan kimia asam disimpan sejajar dengan bahan basa kuat?", "Manakah simbol untuk bahan kimia oksidator penggalak api?", "Bagaimana syarat ventilasi dan penerangan di gudang B3?", "Apakah gudang B3 memiliki bak penampung tumpahan sekunder?"], "steps" => ["Acuan penyimpanan wajib sesuai Matriks Kompatibilitas Bahan Kimia", "Pisahkan bahan oksidator dari bahan cair mudah terbakar minimal 6 meter", "Pastikan gudang B3 memiliki ventilasi udara tahan ledakan (explosion proof)", "Sediakan eyewash dan drench shower darurat di luar pintu gudang"]],
  ["w" => 65, "cat" => "tambang", "title" => "Deteksi Gas Beracun H2S & CO di Pertambangan", "desc" => "Karakteristik gas asam H2S, bau telur busuk, & gas monoksida.", "tags" => ["H2S", "Gas Beracun"], "stat" => "Gas H2S pada konsentrasi 100 ppm melumpuhkan indra penciuman seketika.", "points" => ["Berapa batas ambang paparan (TLA) gas H2S (max 10 ppm)?", "Mengapa gas H2S yang sangat pekat justru TIDAK tercium bau?", "Di mana posisi angin (wind sock) saat terjadi kebocoran gas?", "Bagaimana prosedur evakuasi saat alarm personal gas detector berbunyi?"], "steps" => ["Selalu bawa personal gas detector 4-way saat masuk area rawan gas", "Jika alarm H2S berbunyi: SEGERA lari menyilang arah angin (crosswind)", "Perhatikan arah bendera/wind sock untuk menentukan jalur evakuasi", "Dilarang menolong korban gas tanpa memakai alat bantu napas SCBA"]],
  ["w" => 66, "cat" => "tambang", "title" => "Keselamatan Sabuk Conveyor (Belt Conveyor)", "desc" => "Pull cord emergency stop, nip point roller, & pelindung sisi.", "tags" => ["Conveyor", "Tambang"], "stat" => "Kecelakaan conveyor umumnya terjadi saat pekerja membersihkan material jalan.", "points" => ["Apakah tali pemutus darurat (pull cord wire) berfungsi di sepanjang belt?", "Apakah penutup pelindung (guard) roda drum conveyor terpasang?", "Bolehkah menyeberangi belt conveyor tanpa melalui jembatan penyeberangan?", "Bagaimana prosedur LOTO sebelum perbaikan belt conveyor?"], "steps" => ["Dilarang melompati atau merayap di atas belt conveyor yang beroperasi", "Gunakan jembatan penyeberangan resmi (overpass) yang dilengkapi handrail", "Pasang LOTO sebelum melakukan pembersihan lumpur pada drum roller", "Uji fungsi kabel emergency pull-wire secara berkala per minggu"]],
  ["w" => 67, "cat" => "tambang", "title" => "Keselamatan Dinding Tambang & Slope Stability", "desc" => "Bahaya kelongsoran dinding pit, crack detector, & pemantauan radar.", "tags" => ["Slope Stability", "Tambang"], "stat" => "Kelongsoran lereng pit tambang berpotensi menimbun unit alat berat besar.", "points" => ["Apakah ada retakan baru (cracking) di tepi permukaan jenjang/crest?", "Bagaimana pembacaan radar pemantau lereng (slope monitoring radar)?", "Di mana batas jarak aman parkir alat dari tepi tebing pit?", "Apa sinyal sirine darurat jika terjadi rekahan lereng masif?"], "steps" => ["Inspeksi kondisi fisik crest dan toe lereng pit sebelum memulai shift", "Laporkan segera jika menemukan rekahan tanah atau tumposan air baru", "Patuhi batas jarak aman operasional unit dari tepi tebing pit", "Evakuasi seluruh armada keluar pit jika radar mendeteksi pergerakan kritis"]],
  ["w" => 68, "cat" => "tambang", "title" => "Jalan Angkut Tambang (Haul Road Safety)", "desc" => "Tanggul jalan (safety berm), lebar jalan, & kendaraan tambang.", "tags" => ["Haul Road", "Tambang"], "stat" => "Tanggul jalan (berm) berfungsi menahan unit komatsu terlempar keluar.", "points" => ["Berapa syarat tinggi minimal tanggul aman (minimal 3/4 diameter roda)?", "Berapa lebar jalan angkut ideal untuk dua jalur lalu lintas?", "Bagaimana aturan prioritas jalan antara HD truck vs light vehicle?", "Bagaimana jarak aman mengiringi (following distance) di jalan debu?"], "steps" => ["Jaga jarak aman mengiringi truk HD minimal 50 meter saat berdebu", "Gunakan bendera stik tinggi (buggy whip) dan lampu strobo pada mobil LV", "Berikan hak utama jalan kepada unit muatan besar HD di jalan menanjak", "Pastikan tinggi tanggul pengaman jalan memenuhi kriteria keselamatan"]],
  ["w" => 69, "cat" => "tambang", "title" => "Keselamatan Peledakan (Blasting Operations)", "desc" => "Sirine peringatan peledakan, radius aman, & clearance area.", "tags" => ["Blasting", "Peledakan"], "stat" => "Batu terbang (flyrock) peledakan dapat meluncur sejauh 500+ meter.", "points" => ["Berapa radius batas aman clearance manusia dari lokasi peledakan?", "Apa arti bunyi sirine peledakan pola 1, pola 2, dan pola 3?", "Siapa juru ledak (blaster) bersertifikat yang berwenang?", "Bagaimana prosedur penanganan jika terjadi misfire (gagal ledak)?"], "steps" => ["Kosongkan seluruh radius area bahaya peledakan sebelum sirine pertama", "Blokir seluruh jalan akses menuju lokasi blasting dengan barikade petugas", "Tunggu sinyal kode aman (all clear) dari juru ledak sebelum kembali", "Dilarang menyentuh sisa bahan peledak atau kabel detonator di lapangan"]],
  ["w" => 70, "cat" => "alatberat", "title" => "Blind Spot & Proximity Sensor Alat Berat", "desc" => "Titik buta penglihatan operator HD, excavator, & sensor radio.", "tags" => ["Blind Spot", "Proximity"], "stat" => "70% kasus tertabrak di tambang akibat LV berada di blind spot HD.", "points" => ["Di sisi mana titik buta terluas pada komatsu dump truck?", "Apakah sistem proximity alarm (peringatan jarak) di unit berfungsi?", "Bagaimana cara memarkir mobil LV agar terlihat jelas dari kabin HD?", "Berapa jarak kontak komunikasi radio yang diwajibkan?"], "steps" => ["Dilarang parkir atau berhenti di area blind spot samping/belakang HD", "Gunakan komunikasi radio dua arah sebelum mendekati unit alat berat", "Pastikan layar kamera mundur dan proximity sensor unit dalam kondisi bersih", "Jika kontak radio gagal, pertahankan jarak diam minimal 30 meter"]],
  ["w" => 71, "cat" => "alatberat", "title" => "Pencegahan Terguling saat Tipping Dump Truck", "desc" => "Landasan padat, dump stopper, garis pemandu, & muatan lengket.", "tags" => ["Dump Truck", "Tipping"], "stat" => "Dump truck rawan terguling jika tipping di tanah lembek/miring.", "points" => ["Apakah posisi tanah lokasi dumping rata dan sudah dipadatkan?", "Apakah ban belakang truk sudah menempel pada tanggul stopper?", "Bagaimana kondisi muatan tanah (apakah basah lengket di bak)?", "Mengapa dilarang menggerakkan truk maju saat bak masih terangkat tinggi?"], "steps" => ["Pastikan unit berhenti di permukaan tanah yang keras dan rata sebelum tipping", "Ganjal roda belakang pada tanggul penahan sebelum menaikkan bak vessel", "Jika vessel tersangkut tanah lengket, turunkan perlahan dan jangan dihentak", "Turunkan bak vessel hingga rapat sempurna sebelum truk bergerak maju"]],
  ["w" => 72, "cat" => "alatberat", "title" => "Batas Operasi Excavator & Swing Radius", "desc" => "Radius putaran counterweight excavator, pendorong, & garis batas.", "tags" => ["Excavator", "Swing Radius"], "stat" => "Terjepit di antara counterweight excavator dan dinding adalah fatal.", "points" => ["Berapa meter radius ayunan (swing) belakang bak excavator ini?", "Apakah barikade pita batas swing telah dipasang di sekitar excavator?", "Siapa spotter yang mengawasi pergerakan bucket excavator?", "Bolehkah berdiri di bawah jangkauan bucket excavator yang terangkat?"], "steps" => ["Pasang barikade di sekeliling radius putaran (swing radius) excavator", "Dilarang melintas di celah antara bagian belakang excavator dan dinding", "Jauhi jangkauan swing bucket minimal 5 meter saat operasi penimbunan", "Operator wajib mematikan mesin saat mekanik mendekati bagian bucket"]],
  ["w" => 73, "cat" => "alatberat", "title" => "Pemasangan Outrigger Mobile Crane & Pad Landasan", "desc" => "Landasan outrigger, dunnage papan kayu, & tanah lembek.", "tags" => ["Outrigger", "Crane"], "stat" => "Crane terguling akibat outrigger amblas ke dalam tanah lembek.", "points" => ["Apakah outrigger crane telah terentang penuh 100%?", "Apakah pad/dunnage kayu terpasang di bawah sepatu outrigger?", "Bagaimana cara mengecek tingkat kerebahan waterpass (bubble level)?", "Apakah di bawah pad outrigger terdapat pipa/drainase kosong?"], "steps" => ["Bentangkan seluruh lengan outrigger secara penuh tanpa kompromi", "Gunakan dunnage pad kayu/plat baja berukuran cukup tebal di dasar tanah", "Pastikan posisi indikator waterpass gelembung berada tepat di tengah", "Dilarang mengoperasikan crane jika outrigger amblas atau miring"]],
  ["w" => 74, "cat" => "alatberat", "title" => "Inspeksi Kawat Seling, Webbing Sling & Shackle", "desc" => "Kriteria afkir kawat seling putus, aus, kinking, & pengunci pin.", "tags" => ["Rigging", "Sling"], "stat" => "Sling putus saat pengangkatan beban berisiko menimpa pekerja.", "points" => ["Berapa jumlah kawat putus (wire break) yang mewajibkan seling diafkir?", "Apakah webbing sling kain memiliki jahitan terkelupas atau robek?", "Apakah pin shackle dikunci rapat dengan safety pin pengaman?", "Di mana tag kapasitas SWL tertera pada sling?"], "steps" => ["Inspeksi fisik seling secara menyeluruh sebelum digunakan lifting", "Afkir seling kawat jika terdapat tekukan patah (kink) atau aus > 10%", "Gunakan pelindung sudut (corner protector) agar sling kain tidak tersayat plat", "Pastikan pen pengunci shackle terpasang penuh sampai ulir habis"]],
  ["w" => 75, "cat" => "kesehatan", "title" => "Ergonomi Workstation Pengguna Komputer / Laptop", "desc" => "Tinggi kursi, jarak pandang monitor, posisi keyboard, & sudut siku.", "tags" => ["Ergonomi", "Komputer"], "stat" => "Penggunaan laptop tanpa dudukan tambahan memicu nyeri leher kronis.", "points" => ["Apakah bagian atas layar monitor sejajar dengan mata Anda?", "Apakah pergelangan tangan Anda lurus saat mengetik di keyboard?", "Apakah telapak kaki Anda menapak rata di lantai atau footrest?", "Berapa menit sekali Anda mengistirahatkan mata dari layar?"], "steps" => ["Gunakan dudukan laptop (laptop stand) dan keyboard eksternal tambahan", "Posisikan monitor berjarak sepanjang jangkauan lengan dari mata (45-70 cm)", "Terapkan aturan 20-20-20: setiap 20 menit, tatap objek sejauh 20 kaki selama 20 detik", "Atur sandaran kursi agar menopang lengkungan tulang punggung bawah"]],
  ["w" => 76, "cat" => "kesehatan", "title" => "Kesehatan Mental & Manajemen Stres Pekerja", "desc" => "Dampak stres kerja pada fokus, burn-out, & konseling EAP.", "tags" => ["Mental Health", "Stres"], "stat" => "Pekerja stres 2.5 kali lebih mudah mengalami kehilangan fokus fatal.", "points" => ["Apakah Anda merasa kewalahan dengan beban kerja saat ini?", "Bagaimana suasana komunikasi dan rasa saling menghargai di tim?", "Apakah ada fasilitas layanan konseling (EAP) di perusahaan?", "Bagaimana cara Anda menyeimbangkan waktu kerja dan keluarga?"], "steps" => ["Bicarakan kendala beban kerja secara terbuka dengan pimpinan", "Manfaatkan waktu istirahat secara berkualitas untuk menyegarkan pikiran", "Saling mendukung dan hindari tindakan perundungan (bullying) di tempat kerja", "Manfaatkan fasilitas konseling Employee Assistance Program jika membutuhkan"]],
  ["w" => 77, "cat" => "kesehatan", "title" => "Pentingnya Asupan Elektrolit & Mineral Lapangan", "desc" => "Beda air putih biasa vs larutan elektrolit saat kerja fisik berat.", "tags" => ["Elektrolit", "Kesehatan"], "stat" => "Keram otot hebat saat kerja outdoor dipicu hilangnya sodium lewat keringat.", "points" => ["Apakah Anda sering mengalami keram otot saat bekerja di lapangan?", "Kapan waktu terbaik mengonsumsi minuman mengandung elektrolit?", "Mengapa minum air gula berlebih saat panas justru bikin lemas?", "Apakah warna urine Anda jernih transparan atau kuning pekat?"], "steps" => ["Konsumsi cairan elektrolit tambahan saat bekerja berat di bawah terik matahari", "Gunakan grafik warna urine untuk memantau kecukupan dehidrasi tubuh", "Hindari minuman beralkohol dan kafein tinggi yang memicu buang air kecil", "Sediakan stok tablet garam/elektrolit di pos kesehatan lapangan"]],
  ["w" => 78, "cat" => "kesehatan", "title" => "Pencegahan Bahaya Debu Silika & Silikosis", "desc" => "Debu pemotongan beton, batu, pasir, respirator N95/P100.", "tags" => ["Silika", "Silikosis"], "stat" => "Penyakit silikosis tidak dapat disembuhkan dan merusak jaringan paru.", "points" => ["Apakah proses pemotongan beton memakai metode basah (wet cutting)?", "Apakah respirator yang dipakai berkategori N95 / P100 khusus silika?", "Bagaimana cara pembersihan debu pasir tanpa mengibaskannya?", "Apakah tes rontgen paru dilakukan rutin setiap tahun?"], "steps" => ["Gunakan metode pemotongan basah (wet method) untuk menekan penyebaran debu", "Gunakan penyedot debu khusus berfilter HEPA pada mesin gerinda beton", "Wajib mengenakan respirator elastomerik berfilter P100 di area tinggi debu", "Dilarang menyapu debu kering dengan sapu biasa, gunakan semprotan air"]],
  ["w" => 79, "cat" => "kesehatan", "title" => "Cara Pakai & Rating NRR Alat Pelindung Telinga", "desc" => "Perhitungan desibel efektif yang diredam earplug / earmuff.", "tags" => ["NRR", "Ear Protection"], "stat" => "Penggunaan earplug yang longgar hanya meredam 20% dari kapasitas aslinya.", "points" => ["Berapa nilai rating NRR yang tertera pada kemasan earplug?", "Apakah Anda menarik daun telinga ke atas-belakang saat memasukkan earplug?", "Apakah kombinasi earplug + earmuff diperlukan di kebisingan > 100 dB?", "Bagaimana cara menguji kerapatan earplug dengan suara sendiri?"], "steps" => ["Tarik daun telinga ke atas dan belakang agar saluran telinga lurus", "Gulung earplug busa hingga mengecil sebelum dimasukkan ke telinga", "Tahan earplug selama 20 detik sampai busa mengembang sempurna", "Gunakan kombinasi earplug + earmuff jika kebisingan melebihi 100 dB"]],
  ["w" => 80, "cat" => "kesehatan", "title" => "Pencegahan Cedera Mata & Eyewash Station", "desc" => "Benda asing masuk mata, percikan asam, & pengoperasian eyewash.", "tags" => ["Eye Safety", "Eyewash"], "stat" => "2.000 cedera mata kerja terjadi setiap hari akibat tidak memakai kacamata.", "points" => ["Apakah kacamata safety Anda memiliki perlindungan samping (side shield)?", "Di mana lokasi stasiun pembilas mata (eyewash station) terdekat?", "Berapa lama waktu minimal membilas mata jika terkena asam (15 menit)?", "Mengapa dilarang mengucek mata saat kemasukan gram besi?"], "steps" => ["Gunakan kacamata safety yang sesuai dengan jenis bahaya (debu/cipratan B3)", "Jika mata terkena cairan kimia, SEGERA bilas di eyewash minimal 15 menit", "Dilarang mengucek mata yang kemasukan benda asing/gram besi", "Buka kelopak mata lebar-lebar saat proses pembilasan di eyewash"]],
  ["w" => 81, "cat" => "konstruksi", "title" => "Keselamatan Pekerjaan Pembongkaran (Demolition)", "desc" => "Struktur roboh spontan, pemutusan listrik/gas, & zona barikade.", "tags" => ["Demolition", "Konstruksi"], "stat" => "Pembongkaran gedung berisiko tinggi bahaya struktur rubuh tak terduga.", "points" => ["Apakah seluruh instalasi listrik, gas, dan air sudah diputus total?", "Apakah penilai ahli telah mensurvei kestabilan bangunan?", "Berapa meter zona aman barikade pembongkaran dari dinding?", "APD pernapasan apa yang wajib saat pembongkaran gedung tua?"], "steps" => ["Pastikan pemutusan total seluruh sumber energi sebelum pembongkaran", "Mulai pembongkaran dari tingkat atas secara bertahap ke bawah", "Pasang jaring penahan debu dan barikade luas di sekeliling area", "Wajibkan penggunaan respirator dust mask dan helm industri ketat"]],
  ["w" => 82, "cat" => "konstruksi", "title" => "Keselamatan Pengangkatan Beton Precast", "desc" => "Lifting lug, kawat balok cor, sudut seling, & sling pengikat.", "tags" => ["Precast", "Konstruksi"], "stat" => "Kegagalan pengangkatan beton precast berakibat kehancuran fatal.", "points" => ["Apakah pin lifting lug pada beton precast diinspeksi retak?", "Berapa sudut bentangan seling crane yang aman (max 60 derajat)?", "Apakah penopang sementara (temporary bracing) sudah terpasang stabil?", "Di mana posisi tag line penuntun arah gerak precast?"], "steps" => ["Periksa keutuhan besi jangkar (lifting lug) beton precast sebelum diangkat", "Gunakan tali pemandu (tagline) untuk mengontrol arah ayunan beton precast", "Dilarang melepaskan kait crane sebelum temporary bracing terikat kuat", "Pastikan sudut antara seling pengangkat tidak melebihi 60 derajat"]],
  ["w" => 83, "cat" => "konstruksi", "title" => "Keselamatan Bekerja pada Konstruksi Baja", "desc" => "Ereksi rangka baja, lifelines kawat baja, harness, & angin kencang.", "tags" => ["Steel Erection", "Konstruksi"], "stat" => "Pekerja ereksi baja memiliki tingkat risiko jatuh dari ketinggian terbesar.", "points" => ["Apakah lifeline kawat baja terpasang di sepanjang balok I-beam?", "Apakah bolt baut pengikat rangka baja sudah dikencangkan sesuai torsi?", "Kapan batas kecepatan angin yang mengharuskan ereksi baja dihentikan?", "Apakah alat kerja terikat dengan lanyard tali pengaman tool tether?"], "steps" => ["Pasang sistem lifeline kawat baja di sepanjang balok rangka sebelum dipanjat", "Wajib kaitkan double lanyard harness ke lifeline secara kontinu", "Ikat seluruh peralatan kerja tangan dengan tali pengaman (tool tether)", "Hentikan pekerjaan pengangkatan rangka baja jika kecepatan angin > 20 knot"]],
  ["w" => 84, "cat" => "konstruksi", "title" => "Deteksi Pipa Bawah Tanah & Galian Trenches", "desc" => "Peta kabel bawah tanah (utility map), alat kabel locator, & penanda.", "tags" => ["Underground Utility", "Trenching"], "stat" => "Mengenai kabel listrik bertekanan tinggi bawah tanah memicu ledakan hebat.", "points" => ["Apakah survei utilitas bawah tanah (cable locator) sudah dilakukan?", "Apa arti kode warna cat penanda di atas tanah (merah=listrik, kuning=gas)?", "Berapa jarak manual digging yang diwajibkan dekat titik pipa gas?", "Siapa yang memberi izin pengotakan titik galian baru?"], "steps" => ["Periksa peta jaringan utilitas bawah tanah sebelum menggali tanah", "Gunakan alat detector kabel/pipa untuk memetakan jalur utilitas hidden", "Gunakan sekop tangan (manual digging) saat mendekati jarak 1 meter dari pipa gas", "Beri penanda cat dan tiang pancang pada titik jalur kabel listrik"]],
  ["w" => 85, "cat" => "listrik", "title" => "Keselamatan Gardu Induk & Switchgear", "desc" => "Bahaya busbar tegangan tinggi, sepatu isolasi, & alat ukur.", "tags" => ["Switchgear", "Gardu Induk"], "stat" => "Sentuhan tak sengaja pada busbar switchgear berakibat fatal seketika.", "points" => ["Apakah karpet karet isolasi listrik tergelar di depan panel switchgear?", "Apakah pintu ruangan gardu induk terkunci dan berlabel peringatan?", "Apakah tongkat penguji tegangan (hot stick) telah teruji kalibrasi?", "APD khusus arc flash apa yang wajib dipakai saat pengoperasian?"], "steps" => ["Gunakan sepatu safety beralas isolator listrik (dielectric boots)", "Dilarang membawa objek logam panjang saat memasuki gardu listrik", "Pastikan karpet karet pengaman tergelar sempurna di depan area panel", "Gunakan tongkat hot stick berisolasi saat mengoperasikan saklar tegangan tinggi"]],
  ["w" => 86, "cat" => "listrik", "title" => "Pencegahan Busur Listrik (Arc Flash Hazard)", "desc" => "Suhu loncatan arc flash 20.000 °C, pakaian arc-rated, & batas bahaya.", "tags" => ["Arc Flash", "Listrik"], "stat" => "Suhu ledakan arc flash dapat melelehkan pakaian sintesis ke dalam kulit.", "points" => ["Berapa batas jarak bahaya arc flash (arc flash boundary) pada panel ini?", "Apakah pakaian kerja Anda berkategori tahan api (Flame Resistant / FR)?", "Apakah pelindung wajah (arc flash face shield) terpasang sempurna?", "Bagaimana prosedur mematikan breaker dengan posisi berdiri di samping?"], "steps" => ["Kenakan pakaian khusus tahan api (FR suit) berkategori NFPA 70E yang sesuai", "Berdirilah di samping pintu panel saat memutar saklar saklar breaker", "Gunakan pelindung wajah dan sarung tangan tahan panas ledakan busur", "Pastikan panel tertutup rapat sebelum menaikkan tegangan utama"]],
  ["w" => 87, "cat" => "listrik", "title" => "Penggunaan Generator Portable & Kabel Sambungan", "desc" => "Grounding generator, bahaya gas CO exhaust, RCD/GFCI, & kabel.", "tags" => ["Generator", "Kabel Sambungan"], "stat" => "Pengoperasian generator di ruang tertutup menyebar gas racun CO fatal.", "points" => ["Apakah generator diletakkan di luar ruangan berudara segar?", "Apakah kabel sambungan (extension cord) dilengkapi saklar RCD?", "Apakah steker dan stopkontak berada di atas tanah yang kering?", "Bolehkah menyambung kabel dengan selotip biasa tanpa konektor?"], "steps" => ["Dilarang keras mengoperasikan generator portable di dalam ruangan tertutup", "Pasang pembumian kawat grounding pada bodi rangka generator", "Gunakan sambungan kabel outdoor bermerek tahan air yang teruji", "Pastikan beban watt peralatan tidak melebihi kapasitas watt generator"]],
  ["w" => 88, "cat" => "umum", "title" => "Keselamatan Penggunaan Udara Bertekanan (Air Gun)", "desc" => "Bahaya emboli udara di pembuluh darah, kacamata, & pelindung.", "tags" => ["Air Gun", "Udara Tekan"], "stat" => "Menyemprotkan udara tekan ke kulit dapat menyusupkan gelembung udara ke darah.", "points" => ["Mengapa dilarang menggunakan air gun untuk membersihkan debu di pakaian?", "Berapa tekanan maksimum udara semprot safety nozzle (max 30 psi)?", "APD mata apa yang wajib saat memakai alat pembersih angin tekan?", "Apakah selang angin dilengkapi penahan cambukan (whip check)?"], "steps" => ["Dilarang mengarahkan semprotan air gun ke bagian tubuh sendiri/orang lain", "Gunakan safety nozzle yang membatasi tekanan udara keluar maksimal 30 psi", "Wajib pakai kacamata safety goggle saat menyemprot bersih komponen", "Pasang tali pengaman whip check pada setiap sambungan selang angin"]],
  ["w" => 89, "cat" => "umum", "title" => "Pencegahan Benda Tajam & Sarung Tangan Anti-Potong", "desc" => "Cutter pisau otomatis, penanganan pecahan kaca, & Level Cut.", "tags" => ["Sharps", "Cut Resistant"], "stat" => "20% cedera tangan disebabkan pisau cutter yang tergelincir.", "points" => ["Apakah pisau cutter Anda memiliki fitur pisau tarik otomatis (auto-retract)?", "Berapa level ketahanan potong (Cut Level 1-5) pada sarung tangan Anda?", "Ke arah mana gerak pisau saat Anda memotong kardus/tali?", "Di mana kotak pembuangan khusus mata pisau tumpul?"], "steps" => ["Gunakan pisau utility dengan mekanisme bilah ditarik otomatis (safety cutter)", "Arahkan potongan pisau menjauhi posisi badan dan tangan penahan", "Gunakan sarung tangan rajut berlapis anti-potong (Cut Level 3-5)", "Buang sisa mata pisau tumpul ke dalam wadah kaleng tertutup khusus"]],
  ["w" => 90, "cat" => "umum", "title" => "Keselamatan Pejalan Kaki di Area Pabrik (Pedestrian Safety)", "desc" => "Jalur hijau pejalan kaki, pintu penyeberangan, & cermin cembung.", "tags" => ["Pedestrian", "Jalur Hijau"], "stat" => "Pejalan kaki di area pabrik rentan tertabrak alat angkut forklift.", "points" => ["Apakah Anda selalu berjalan di dalam garis jalur hijau pejalan kaki?", "Apakah cermin cembung tikungan jalan berfungsi membantu pandangan?", "Bolehkah berjalan sambil mengetik pesan di telepon genggam?", "Bagaimana prosedur menyeberang di jalur lintasan forklift?"], "steps" => ["Selalu berjalan di dalam marka jalur hijau khusus pejalan kaki (walkway)", "Berhenti dan tengok kanan-kiri sebelum menyeberangi lintasan kendaraan", "Dilarang menggunakan HP atau earphone musik saat berjalan di area operasional", "Manfaatkan cermin cembung di tikungan blind spot lorong pabrik"]],
  ["w" => 91, "cat" => "umum", "title" => "Keselamatan Kerja di Area Perkantoran (Office Safety)", "desc" => "Kabel malang di lantai, laci lemari besi terbuka, & tangga kantor.", "tags" => ["Office Safety", "Kantor"], "stat" => "Terpeleset dan tersandung di kantor menyumbang 10% kasus kecelakaan.", "points" => ["Apakah ada kabel komputer yang melintang di lantai laluan kantor?", "Apakah laci lemari arsip bawah dibiarkan terbuka menonjol?", "Bagaimana cara aman mengambil barang di rak tinggi kantor?", "Apakah tangga darurat gedung kantor bersih dari tumpukan kardus?"], "steps" => ["Tutup dan rapikan kabel listrik kantor menggunakan ducting penutup lantai", "Tutup kembali laci lemari arsip segera setelah mengambil dokumen", "Gunakan bangku bertingkat (step stool) aman untuk meraih rak tinggi", "Jaga kebersihan lantai dari tumpahan ceceran air minum atau kopi"]],
  ["w" => 92, "cat" => "umum", "title" => "Manajemen K3 Kontraktor & Sub-Kontraktor", "desc" => "CSMS (Contractor Safety Management System), verifikasi alat, & APD.", "tags" => ["CSMS", "Kontraktor"], "stat" => "70% insiden berat di kawasan industri melibatkan pekerja pihak ketiga.", "points" => ["Apakah kontraktor telah lulus evaluasi dokumen CSMS perusahaan?", "Apakah seluruh peralatan milik kontraktor telah diinspeksi sticker K3?", "Siapa supervisor penanggung jawab pengawas pekerjaan kontraktor?", "Apakah pekerja sub-kontraktor mengikuti safety talk harian?"], "steps" => ["Pastikan kontraktor telah memiliki dokumen CSMS yang terverifikasi aktif", "Lakukan inspeksi pra-pekerjaan terhadap seluruh mesin/alat bawaan kontraktor", "Wajibkan seluruh personel kontraktor mengikuti safety briefing harian", "Hentikan pekerjaan kontraktor jika ditemukan pelanggaran aturan K3"]],
  ["w" => 93, "cat" => "kimia", "title" => "Pemeliharaan & Pengisian Ulang Isi Spill Kit", "desc" => "Checklist isi spill kit pad, sos, plastik disposal, & segel.", "tags" => ["Spill Kit", "Refill B3"], "stat" => "Spill kit yang kosong saat insiden tumpahan berakibat pencemaran parah.", "points" => ["Apakah ember/box Spill Kit di area Anda dalam kondisi tersegel?", "Apakah jumlah ketersediaan pad dan sausage di dalamnya lengkap?", "Siapa yang bertanggung jawab memesan ulang komponen isi spill kit?", "Berapa bulan sekali checklist fisik spill kit diinspeksi?"], "steps" => ["Inspeksi kecukupan komponen isi spill kit minimal seminggu sekali", "Segera laporkan dan order ulang pad/absorbent yang telah terpakai", "Pastikan kantong plastik kuning khusus limbah B3 tersedia di dalam box", "Jaga lokasi tempat spill kit tetap bersih dan tidak tertutup barang"]],
  ["w" => 94, "cat" => "kimia", "title" => "Penanganan Bahaya Asbes & Isolasi Berbahaya", "desc" => "Inhalasi serat asbes, penyakit mesothelioma, & APD khusus.", "tags" => ["Asbes", "Mesothelioma"], "stat" => "Serat asbes mikro yang terhirup mengendap permanen di jaringan paru.", "points" => ["Apakah ada atap atau isolasi pipa di area ini yang mengandung asbes?", "Mengapa dilarang mengamplas atau memotong atap asbes dalam kondisi kering?", "Respirator tipe apa yang diwajibkan saat pembongkaran material asbes?", "Bagaimana prosedur membasahi asbes sebelum dibongkar?"], "steps" => ["Basahi material asbes dengan larutan sabun sebelum dibongkar", "Wajib kenakan respirator full-face berfilter P100 dan baju hazmat disposable", "Bungkus limbah asbes dalam 2 lapis plastik tebal berlabel Asbestos Waste", "Mandi dan bersihkan diri secara menyeluruh setelah selesai penanganan"]],
  ["w" => 95, "cat" => "lingkungan", "title" => "Pencegahan Pencemaran Air Limbah Operasional", "desc" => "Batas pH air limbah, oil catcher, grease trap, & sampling.", "tags" => ["Air Limbah", "Lingkungan"], "stat" => "Pencemaran air limbah berisiko menutup izin operasional perusahaan.", "points" => ["Apakah bak pemisah oli (oil catcher) dibersihkan dari lapisan minyak?", "Berapa nilai pH aman air buangan yang diperbolehkan (pH 6-9)?", "Apakah ada saluran limbah beracun yang bocor ke parit umum?", "Di mana titik tempat pengisian sampel air limbah berkala?"], "steps" => ["Pastikan oli dan minyak tertangkap sempurna di bak oil catcher", "Dilarang membuang sisa cairan kimia atau pelarut ke saluran air hujan", "Lakukan pengujian rutin indikator fisik pH dan kejernihan air limbah", "Bersihkan endapan lumpur bak kontrol lingkungan secara teratur"]],
  ["w" => 96, "cat" => "lingkungan", "title" => "Pemilahan Sampah Padat & Daur Ulang Industri", "desc" => "Sampah organik, anorganik, limbah B3, & konsep circular economy.", "tags" => ["Sampah", "Daur Ulang"], "stat" => "Pemilahan sampah yang benar mengurangi volume sampah TPS hingga 50%.", "points" => ["Apakah Anda membuang botol plastik ke tempat sampah yang benar?", "Manakah tempat sampah warna hijau, kuning, dan merah di lokasi?", "Apa dampak positif pemilahan sampah bagi lingkungan hidup?", "Bagaimana cara pengurangan penggunaan plastik sekali pakai di site?"], "steps" => ["Buang sampah sesuai kode warna wadah (Hijau: Organik, Kuning: Anorganik, Merah: B3)", "Daur ulang limbah kayu bekas kemasan palet menjadi barang guna", "Gunakan botol minum (tumbler) pribadi untuk menghemat wadah plastik", "Pastikan sampah medis/infeksius dibuang terpisah dari sampah umum"]],
  ["w" => 97, "cat" => "teknologi", "title" => "Keselamatan Bekerja pada Instalasi Panel Surya (Solar)", "desc" => "Risiko sengatan listrik DC tegangan tinggi, posisi atap, & isolasi.", "tags" => ["Solar Panel", "Listrik DC"], "stat" => "Arus searah (DC) dari solar panel tidak memiliki titik nol cross-over.", "points" => ["Apakah sistem pemutus arus DC (DC isolator) sudah dimatikan?", "Bagaimana mengamankan diri dari bahaya jatuh saat pasang solar atap?", "Mengapa modul solar tetap bertegangan saat terkena sinar matahari?", "APD isolasi listrik apa yang wajib dipakai saat menyambung kabel solar?"], "steps" => ["Gunakan harness terikat lifeline saat memasang panel surya di atas atap", "Tutup permukaan modul solar panel dengan terpal gelap saat proses wiring", "Matikan saklar DC isolator sebelum menyentuh kabel sambungan modul", "Gunakan sarung tangan tahan isolasi listrik berkategori voltase DC"]],
  ["w" => 98, "cat" => "teknologi", "title" => "Sistem Gembok Pintar Smart LOTO & RFID Tagging", "desc" => "Penggunaan gembok elektronik RFID, log akuntabilitas digital.", "tags" => ["Smart LOTO", "RFID"], "stat" => "Smart LOTO mencatat riwayat penguncian mesin secara real-time di server.", "points" => ["Bagaimana cara melacak siapa saja yang sedang memasang gembok LOTO?", "Apa keunggulan gembok RFID dibanding kunci gembok manual biasa?", "Bagaimana sistem memberi notifikasi jika ada LOTO yang belum dilepas?", "Apa yang dilakukan jika kartu identitas RFID penanggung jawab hilang?"], "steps" => ["Scan kartu identitas RFID Anda pada smart lockbox sebelum mulai isolasi", "Pastikan nama dan status penguncian terdaftar pada server e-LOTO", "Dilarang meminjamkan kartu RFID LOTO pribadi kepada orang lain", "Laporkan ke admin sistem jika terjadi kegagalan pembacaan sensor RFID"]],
  ["w" => 99, "cat" => "teknologi", "title" => "Simulasi Pelatihan VR (Virtual Reality) Safety", "desc" => "Simulasi kondisi darurat kebakaran, height, & hazard identification.", "tags" => ["VR Safety", "Training"], "stat" => "Pelatihan VR meningkatkan memori refleks keselamatan pekerja hingga 80%.", "points" => ["Bagaimana rasanya mengalami simulasi bahaya kebakaran via headset VR?", "Mengapa VR aman untuk melatih penanganan situasi krisis ekstrem?", "Skenario keselamatan apa saja yang tersedia di dalam modul VR K3?", "Bagaimana skor evaluasi VR digunakan untuk menilai kesiapan pekerja?"], "steps" => ["Ikuti pelatihan simulasi VR K3 dengan serius seolah berada di lapangan nyata", "Gunakan instruksi dalam VR untuk melatih refleks tindakan darurat", "Evaluasi hasil skor ketepatan langkah Anda dari laporan grafik VR", "Terapkan pemahaman navigasi bahaya VR saat bekerja secara fisik"]],
  ["w" => 100, "cat" => "umum", "title" => "Budaya K3 Kaizen & Perbaikan Berkelanjutan", "desc" => "Continuous improvement K3, saran pekerja, & komitmen Zero Harm.", "tags" => ["Kaizen K3", "Improvement"], "stat" => "Budaya K3 terbaik dibangun dari ribuan perbaikan kecil yang konsisten.", "points" => ["Ide perbaikan K3 apa yang ingin Anda usulkan untuk area ini?", "Bagaimana cara berpartisipasi dalam program Kotak Saran K3?", "Apa arti filosofi Kaizen dalam konteks keselamatan kerja?", "Bagaimana kita saling menjaga satu sama lain agar pulang selamat?"], "steps" => ["Usulkan ide perbaikan K3 sederhana namun efektif melalui kotak saran", "Lakukan perbaikan kecil (Kaizen) di area kerja Anda setiap hari", "Tingkatkan rasa kepedulian antar sesama rekan kerja (Caring Culture)", "Jadikan keselamatan kerja sebagai nilai hidup mendasar, bukan sekadar beban aturan"]],
];

// Contextual internal links: every topic points to the closest commercial hub.
// The links are intentionally category-based rather than random training links,
// so the anchor and destination remain relevant to the material being read.
$topic_destinations = [
  'umum'       => ['url' => '/pelatihan/pelatihan-ahli-k3-umum-sertifikasi-kemnaker-ri/', 'label' => 'Program Ahli K3 Umum Kemnaker RI'],
  'ketinggian' => ['url' => '/pelatihan/pelatihan-tkbt-ii-sertifikasi-kemnaker-ri/', 'label' => 'Program TKBT II Kemnaker RI'],
  'kebakaran'  => ['url' => '/pelatihan/pelatihan-regu-penanggulangan-kebakaran-kelas-c-sertifikasi-kemnaker-ri/', 'label' => 'Program Regu Kebakaran Kelas C'],
  'listrik'    => ['url' => '/pelatihan/pelatihan-ahli-k3-listrik-sertifikasi-kemnaker-ri/', 'label' => 'Program Ahli K3 Listrik Kemnaker RI'],
  'kimia'      => ['url' => '/pelatihan/pelatihan-petugas-k3-kimia-sertifikasi-kemnaker-ri/', 'label' => 'Program Petugas K3 Kimia Kemnaker RI'],
  'alatberat'  => ['url' => '/pelatihan/pelatihan-k3-operator-alat-berat-sertifikasi-kemnaker-ri/', 'label' => 'Program Operator Alat Berat Kemnaker RI'],
  'kesehatan'  => ['url' => '/pelatihan/pelatihan-petugas-p3k-sertifikasi-kemnaker-ri/', 'label' => 'Program Petugas P3K Kemnaker RI'],
  'konstruksi' => ['url' => '/pelatihan/pelatihan-ahli-muda-k3-konstruksi-sertifikasi-kemnaker-ri/', 'label' => 'Program Ahli Muda K3 Konstruksi'],
  'tambang'    => ['url' => '/pelatihan/pelatihan-pop-pertambangan-sertifikasi-bnsp-online/', 'label' => 'Program POP Pertambangan BNSP'],
  'lingkungan' => ['url' => '/pelatihan/pelatihan-ahli-muda-lingkungan-kerja-sertifikasi-kemnaker-ri/', 'label' => 'Program Ahli Muda Lingkungan Kerja'],
  'teknologi'  => ['url' => '/pelatihan/pelatihan-ahli-k3-umum-sertifikasi-bnsp-online/', 'label' => 'Program Ahli K3 Umum BNSP Online'],
];

// High-intent topic overrides send readers to the exact matching program.
$topic_overrides = [
  3  => ['url' => '/pelatihan/pelatihan-petugas-peran-kebakaran-kelas-d-kemnaker-ri/', 'label' => 'Program Petugas Kebakaran Kelas D'],
  11 => ['url' => '/pelatihan/pelatihan-k3-operator-scaffolding-sertifikasi-kemnaker-ri/', 'label' => 'Program Operator Scaffolding Kemnaker RI'],
  17 => ['url' => '/pelatihan/pelatihan-k3-operator-welder-kelas-3-sertifikasi-kemnaker-ri/', 'label' => 'Program Operator Welder Kemnaker RI'],
  18 => ['url' => '/pelatihan/pelatihan-teknisi-confined-space-sertifikasi-kemnaker-ri/', 'label' => 'Program Teknisi Confined Space Kemnaker RI'],
  19 => ['url' => '/pelatihan/pelatihan-petugas-p3k-sertifikasi-kemnaker-ri/', 'label' => 'Program Petugas P3K Kemnaker RI'],
  28 => ['url' => '/pelatihan/pelatihan-k3-operator-crane-kelas-3-sertifikasi-kemnaker-ri/', 'label' => 'Program Operator Crane Kelas 3'],
  29 => ['url' => '/pelatihan/pelatihan-k3-operator-forklift-kelas-2-sertifikasi-kemnaker-ri/', 'label' => 'Program Operator Forklift Kelas 2'],
  87 => ['url' => '/pelatihan/pelatihan-k3-operator-motor-diesel-genset-sertifikasi-kemnaker-ri/', 'label' => 'Program Operator Motor Diesel/Genset'],
];

foreach ($talks as &$talk) {
  $talk['related'] = $topic_overrides[$talk['w']]
    ?? $topic_destinations[$talk['cat']]
    ?? $topic_destinations['umum'];
}
unset($talk);

$related_trainings = [
  $topic_destinations['umum'],
  $topic_destinations['ketinggian'],
  $topic_destinations['listrik'],
  $topic_destinations['kimia'],
  $topic_destinations['alatberat'],
  $topic_destinations['konstruksi'],
  $topic_destinations['tambang'],
  $topic_destinations['lingkungan'],
];
?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "name": "Beranda",
      "item": "https://wahanatotalita.com/"
    },
    {
      "@type": "ListItem",
      "position": 2,
      "name": "Tools K3",
      "item": "https://wahanatotalita.com/tools/"
    },
    {
      "@type": "ListItem",
      "position": 3,
      "name": "Safety Talk",
      "item": "https://wahanatotalita.com/tools/safety-talk/"
    }
  ]
}
</script>
<script type="application/ld+json">
{"@context":"https://schema.org","@type":"FAQPage","mainEntity":[{"@type":"Question","name":"Berapa lama satu sesi safety talk / toolbox meeting idealnya?","acceptedAnswer":{"@type":"Answer","text":"Idealnya 5-10 menit agar pekerja tetap fokus dan tidak mengganggu jadwal kerja. Sampaikan satu topik utama, ajukan 2-3 poin diskusi, dan tutup dengan penegasan tindakan K3."}},{"@type":"Question","name":"Siapa yang seharusnya memimpin safety talk harian?","acceptedAnswer":{"@type":"Answer","text":"Idealnya dipimpin langsung oleh supervisor, foreman, atau tim HSE di lapangan untuk menunjukkan kepemimpinan K3 operasional. Dalam pelaksanaannya, materi dan pengawasan keselamatan kerja dikoordinasikan oleh Ahli K3 Umum sebagai penanggung jawab implementasi K3 di perusahaan."}},{"@type":"Question","name":"Apakah 100 topik safety talk ini gratis dan siap cetak?","acceptedAnswer":{"@type":"Answer","text":"Ya, 100% gratis! Setiap topik dilengkapi tombol cetak langsung yang mencakup lembar daftar hadir (absensi) toolbox meeting."}}]}
</script>
<link rel="manifest" href="/manifest.json">
<style>
/* ==========================================================
   2026 MODERN ENTERPRISE K3 TOOL DESIGN SYSTEM
   ========================================================== */
:root {
  --st-forest: #06402B;
  --st-forest-dark: #04291B;
  --st-forest-light: #0A5C3E;
  --st-emerald: #059669;
  --st-emerald-dark: #047857;
  --st-lime: #C8EF84;
  --st-lime-soft: #EEFAD4;
  --st-slate-50: #F8FAFC;
  --st-slate-100: #F1F5F9;
  --st-slate-200: #E2E8F0;
  --st-slate-300: #CBD5E1;
  --st-slate-600: #475569;
  --st-slate-700: #334155;
  --st-slate-800: #1E293B;
  --st-slate-900: #0F172A;
  --st-card-bg: #FFFFFF;
  --st-radius-sm: 8px;
  --st-radius-md: 12px;
  --st-radius-lg: 16px;
  --st-radius-xl: 24px;
  --st-shadow-card: 0 4px 16px -2px rgba(15, 23, 42, 0.05), 0 2px 6px -2px rgba(15, 23, 42, 0.03);
  --st-shadow-hover: 0 20px 30px -6px rgba(6, 64, 43, 0.12), 0 8px 12px -4px rgba(6, 64, 43, 0.06);
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
body {
  font-family: 'Source Sans 3', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
  background: var(--st-slate-50);
  color: var(--st-slate-900);
  line-height: 1.55;
  -webkit-font-smoothing: antialiased;
}
a { color: inherit; text-decoration: none; }
.container { max-width: 1200px; margin: 0 auto; padding: 0 24px; }

/* ─── HERO SECTION (HIGH CTR) ───────────────────────────── */
.st-hero {
  position: relative;
  background: radial-gradient(circle at 85% 15%, rgba(200, 239, 132, 0.18), transparent 32%),
              radial-gradient(circle at 15% 85%, rgba(10, 92, 62, 0.35), transparent 36%),
              linear-gradient(145deg, #032115 0%, #06402B 55%, #084D34 100%);
  color: #fff;
  padding: 68px 0 54px;
  overflow: hidden;
  border-bottom: 1px solid rgba(200, 239, 132, 0.15);
}
.st-hero::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image: linear-gradient(rgba(255, 255, 255, 0.04) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(255, 255, 255, 0.04) 1px, transparent 1px);
  background-size: 48px 48px;
  mask-image: radial-gradient(circle at 50% 50%, #000 60%, transparent 100%);
  pointer-events: none;
}
.st-hero-grid {
  display: grid;
  grid-template-columns: minmax(0, 1.35fr) minmax(280px, 0.75fr);
  gap: 48px;
  align-items: center;
  position: relative;
  z-index: 2;
}
.st-hero-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 6px 14px;
  background: rgba(200, 239, 132, 0.12);
  border: 1px solid rgba(200, 239, 132, 0.35);
  border-radius: 999px;
  color: var(--st-lime);
  font-family: 'Lexend', sans-serif;
  font-size: 0.78rem;
  font-weight: 700;
  letter-spacing: 0.05em;
  text-transform: uppercase;
  margin-bottom: 18px;
}
.st-pulse-dot {
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: var(--st-lime);
  box-shadow: 0 0 0 0 rgba(200, 239, 132, 0.7);
  animation: pulseDot 2s infinite;
}
@keyframes pulseDot {
  0% { box-shadow: 0 0 0 0 rgba(200, 239, 132, 0.7); }
  70% { box-shadow: 0 0 0 8px rgba(200, 239, 132, 0); }
  100% { box-shadow: 0 0 0 0 rgba(200, 239, 132, 0); }
}
.st-hero h1 {
  font-family: 'Lexend', sans-serif;
  font-size: clamp(2rem, 4.2vw, 3.4rem);
  font-weight: 800;
  line-height: 1.12;
  letter-spacing: -0.03em;
  color: #FFFFFF;
  margin-bottom: 16px;
}
.st-hero h1 span {
  color: var(--st-lime);
  display: block;
}
.st-hero p.st-lead {
  font-size: clamp(0.95rem, 1.4vw, 1.1rem);
  line-height: 1.65;
  color: rgba(255, 255, 255, 0.85);
  margin-bottom: 26px;
  max-width: 650px;
}

/* Hero Search Bar (Modern Elevated) */
.st-search-box {
  background: #FFFFFF;
  border-radius: 16px;
  padding: 6px 8px 6px 18px;
  display: flex;
  align-items: center;
  gap: 12px;
  box-shadow: 0 16px 40px rgba(0, 0, 0, 0.28), 0 0 0 1px rgba(255, 255, 255, 0.35);
  transition: transform 0.2s, box-shadow 0.2s;
  max-width: 680px;
}
.st-search-box:focus-within {
  transform: translateY(-2px);
  box-shadow: 0 20px 45px rgba(0, 0, 0, 0.35), 0 0 0 3px var(--st-lime);
}
.st-search-icon {
  color: var(--st-slate-600);
  display: flex;
  align-items: center;
  flex-shrink: 0;
}
.st-search-input {
  flex: 1;
  border: none;
  outline: none;
  font-family: 'Source Sans 3', sans-serif;
  font-size: 1rem;
  color: var(--st-slate-900);
  font-weight: 500;
  background: transparent;
  min-width: 0;
}
.st-search-input::placeholder { color: var(--st-slate-600); }
.st-search-btn {
  background: var(--st-forest);
  color: #fff;
  border: none;
  border-radius: 12px;
  padding: 10px 20px;
  font-family: 'Lexend', sans-serif;
  font-size: 0.85rem;
  font-weight: 700;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  transition: background 0.18s, transform 0.18s;
  flex-shrink: 0;
}
.st-search-btn:hover { background: var(--st-forest-light); transform: scale(1.02); }

/* Quick Action Chips (High CTR Boost) */
.st-quick-chips {
  display: flex;
  align-items: center;
  gap: 8px;
  flex-wrap: wrap;
  margin-top: 14px;
}
.st-quick-label {
  font-size: 0.78rem;
  color: rgba(255, 255, 255, 0.65);
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.04em;
}
.st-chip {
  background: rgba(255, 255, 255, 0.12);
  border: 1px solid rgba(255, 255, 255, 0.2);
  color: #FFFFFF;
  padding: 5px 12px;
  border-radius: 999px;
  font-size: 0.78rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.18s;
  backdrop-filter: blur(8px);
}
.st-chip:hover {
  background: var(--st-lime);
  color: var(--st-forest-dark);
  border-color: var(--st-lime);
  transform: translateY(-1px);
}

/* Trust Row */
.st-trust-row {
  display: flex;
  gap: 20px;
  flex-wrap: wrap;
  margin-top: 24px;
  font-size: 0.82rem;
  color: rgba(255, 255, 255, 0.8);
  font-weight: 600;
}
.st-trust-item {
  display: inline-flex;
  align-items: center;
  gap: 7px;
}
.st-trust-item svg { color: var(--st-lime); }

/* Hero Stat Panel Card */
.st-hero-panel {
  background: rgba(255, 255, 255, 0.08);
  border: 1px solid rgba(255, 255, 255, 0.16);
  border-radius: var(--st-radius-xl);
  padding: 28px 24px;
  backdrop-filter: blur(16px);
  box-shadow: 0 24px 50px rgba(0, 0, 0, 0.22);
}
.st-panel-eyebrow {
  font-family: 'Lexend', sans-serif;
  font-size: 0.72rem;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 0.08em;
  color: var(--st-lime);
  margin-bottom: 8px;
}
.st-hero-panel h2 {
  font-family: 'Lexend', sans-serif;
  font-size: 1.25rem;
  font-weight: 700;
  line-height: 1.35;
  color: #fff;
  margin-bottom: 20px;
}
.st-stat-matrix {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 12px;
  margin-bottom: 18px;
}
.st-stat-cell {
  background: rgba(255, 255, 255, 0.06);
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: var(--st-radius-md);
  padding: 12px 14px;
}
.st-stat-cell strong {
  display: block;
  font-family: 'Lexend', sans-serif;
  font-size: 1.45rem;
  font-weight: 800;
  color: var(--st-lime);
  line-height: 1.1;
}
.st-stat-cell span {
  font-size: 0.76rem;
  color: rgba(255, 255, 255, 0.75);
  font-weight: 500;
}
.st-panel-cta {
  display: block;
  text-align: center;
  background: var(--st-lime);
  color: var(--st-forest-dark);
  padding: 11px 16px;
  border-radius: var(--st-radius-md);
  font-family: 'Lexend', sans-serif;
  font-size: 0.85rem;
  font-weight: 700;
  transition: transform 0.18s, box-shadow 0.18s;
}
.st-panel-cta:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(200, 239, 132, 0.3);
}

/* ─── STICKY DISCOVERY & CATEGORY TABS ───────────────────── */
.st-discovery {
  position: sticky;
  top: 68px;
  z-index: 40;
  background: rgba(255, 255, 255, 0.92);
  backdrop-filter: blur(14px);
  border-bottom: 1px solid var(--st-slate-200);
  padding: 14px 0;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
}
.st-filter-bar {
  display: flex;
  gap: 8px;
  overflow-x: auto;
  padding-bottom: 4px;
  scrollbar-width: none;
  -webkit-overflow-scrolling: touch;
  scroll-behavior: smooth;
}
.st-filter-bar::-webkit-scrollbar { display: none; }
.st-cat-btn {
  flex: 0 0 auto;
  border: 1px solid var(--st-slate-200);
  background: #FFFFFF;
  color: var(--st-slate-700);
  padding: 8px 16px;
  border-radius: 999px;
  font-family: 'Source Sans 3', sans-serif;
  font-size: 0.84rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.18s;
  display: inline-flex;
  align-items: center;
  gap: 6px;
}
.st-cat-btn:hover {
  background: var(--st-slate-100);
  border-color: var(--st-slate-300);
  color: var(--st-forest);
}
.st-cat-btn.active {
  background: var(--st-forest);
  border-color: var(--st-forest);
  color: #FFFFFF;
  box-shadow: 0 4px 12px rgba(6, 64, 43, 0.25);
}

/* ─── SECTION CONTENT AREA ──────────────────────────────── */
.st-main-content {
  padding: 36px 0 60px;
}
.st-results-header {
  display: flex;
  justify-content: space-between;
  align-items: flex-end;
  gap: 16px;
  margin-bottom: 24px;
}
.st-eyebrow {
  font-family: 'Lexend', sans-serif;
  font-size: 0.78rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.06em;
  color: var(--st-emerald-dark);
  margin-bottom: 4px;
}
.st-results-header h2 {
  font-family: 'Lexend', sans-serif;
  font-size: clamp(1.4rem, 2.5vw, 1.85rem);
  font-weight: 800;
  color: var(--st-slate-900);
  letter-spacing: -0.02em;
}
.st-results-count {
  font-family: 'Lexend', sans-serif;
  font-size: 0.84rem;
  font-weight: 700;
  color: var(--st-forest);
  background: var(--st-lime-soft);
  border: 1px solid rgba(200, 239, 132, 0.6);
  padding: 6px 14px;
  border-radius: 999px;
  white-space: nowrap;
}

/* ─── CARDS GRID (MODERN 2026 SAAS STYLE) ────────────────── */
.st-grid {
  display: grid;
  grid-template-columns: repeat(3, minmax(0, 1fr));
  gap: 22px;
}
.st-card {
  background: var(--st-card-bg);
  border: 1px solid var(--st-slate-200);
  border-radius: var(--st-radius-lg);
  box-shadow: var(--st-shadow-card);
  display: flex;
  flex-direction: column;
  transition: transform 0.22s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.22s, border-color 0.22s;
  cursor: pointer;
  overflow: hidden;
  position: relative;
}
.st-card:hover {
  transform: translateY(-4px);
  box-shadow: var(--st-shadow-hover);
  border-color: rgba(6, 64, 43, 0.3);
}
.st-card.is-hidden { display: none; }

.st-card-top {
  padding: 18px 20px 0;
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 8px;
}
.st-cat-badge {
  font-family: 'Lexend', sans-serif;
  font-size: 0.68rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.04em;
  padding: 3px 8px;
  border-radius: 6px;
  border: 1px solid transparent;
}
.st-topic-id {
  font-family: 'Lexend', sans-serif;
  font-size: 0.72rem;
  font-weight: 700;
  color: var(--st-slate-600);
}

/* Category-specific pill badges */
.cat-umum { background: #ECFDF5; color: #047857; border-color: #A7F3D0; }
.cat-ketinggian { background: #FFFBEB; color: #B45309; border-color: #FDE68A; }
.cat-kebakaran { background: #FEF2F2; color: #B91C1C; border-color: #FECACA; }
.cat-listrik { background: #FEFCE8; color: #A16207; border-color: #FEF08A; }
.cat-kimia { background: #FAF5FF; color: #7E22CE; border-color: #E9D5FF; }
.cat-alatberat { background: #F0FDF4; color: #15803D; border-color: #BBF7D0; }
.cat-kesehatan { background: #F0FDF4; color: #047857; border-color: #86EFAC; }
.cat-konstruksi { background: #FFF7ED; color: #C2410C; border-color: #FED7AA; }
.cat-tambang { background: #F8FAFC; color: #475569; border-color: #CBD5E1; }
.cat-lingkungan { background: #F0FDF4; color: #166534; border-color: #BBF7D0; }
.cat-teknologi { background: #EFF6FF; color: #1D4ED8; border-color: #BFDBFE; }

.st-card-header {
  padding: 12px 20px 8px;
}
.st-card-header h3 {
  font-family: 'Lexend', sans-serif;
  font-size: 1.05rem;
  font-weight: 700;
  line-height: 1.35;
  color: var(--st-slate-900);
  letter-spacing: -0.01em;
}
.st-card-body {
  padding: 0 20px 14px;
  font-size: 0.86rem;
  line-height: 1.55;
  color: var(--st-slate-600);
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
  flex: 1;
}
.st-card-tags {
  padding: 0 20px 14px;
  display: flex;
  gap: 5px;
  flex-wrap: wrap;
}
.st-tag {
  background: var(--st-slate-100);
  color: var(--st-slate-600);
  padding: 3px 8px;
  border-radius: 999px;
  font-size: 0.7rem;
  font-weight: 600;
}

/* Card Related Link */
.st-card-related {
  margin: 0 20px 14px;
  padding: 9px 12px;
  border-radius: 10px;
  background: #F0FDF4;
  border: 1px solid #DCFCE7;
  color: #166534;
  font-size: 0.76rem;
  font-weight: 700;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 8px;
  transition: all 0.18s;
}
.st-card-related:hover {
  background: #DCFCE7;
  color: #14532D;
  transform: translateX(2px);
}

/* Card Action Footer */
.st-card-footer {
  border-top: 1px solid var(--st-slate-100);
  padding: 12px 20px 16px;
  display: flex;
  gap: 8px;
  background: #FAFBFB;
}
.st-btn-detail {
  flex: 1;
  background: var(--st-forest);
  color: #FFFFFF;
  border: none;
  border-radius: 10px;
  padding: 9px 12px;
  font-family: 'Lexend', sans-serif;
  font-size: 0.78rem;
  font-weight: 700;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
  transition: background 0.18s, transform 0.15s;
}
.st-btn-detail:hover {
  background: var(--st-forest-light);
  transform: translateY(-1px);
}
.st-btn-print {
  background: #FFFFFF;
  color: var(--st-slate-700);
  border: 1px solid var(--st-slate-200);
  border-radius: 10px;
  padding: 9px 12px;
  font-family: 'Lexend', sans-serif;
  font-size: 0.78rem;
  font-weight: 600;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
  transition: all 0.18s;
}
.st-btn-print:hover {
  background: var(--st-slate-100);
  border-color: var(--st-slate-300);
  color: var(--st-slate-900);
}

/* ─── LOAD MORE BUTTON ──────────────────────────────────── */
.st-load-more-wrapper {
  text-align: center;
  margin: 32px 0 16px;
}
.st-load-more-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  padding: 13px 26px;
  background: #FFFFFF;
  color: var(--st-forest);
  border: 1.5px solid var(--st-forest);
  border-radius: 999px;
  font-family: 'Lexend', sans-serif;
  font-size: 0.88rem;
  font-weight: 700;
  cursor: pointer;
  box-shadow: 0 4px 14px rgba(6, 64, 43, 0.08);
  transition: all 0.2s;
}
.st-load-more-btn:hover {
  background: var(--st-forest);
  color: #FFFFFF;
  box-shadow: 0 8px 24px rgba(6, 64, 43, 0.2);
  transform: translateY(-2px);
}
.st-load-more-btn[hidden] { display: none; }

/* ─── CTA STRIP (HIGH CONVERSION) ────────────────────────── */
.st-cta-strip {
  background: radial-gradient(circle at 90% 20%, rgba(200, 239, 132, 0.15), transparent 40%),
              linear-gradient(135deg, #032115 0%, #06402B 100%);
  color: #FFFFFF;
  border-radius: var(--st-radius-xl);
  padding: 40px 36px;
  margin-top: 48px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 28px;
  box-shadow: 0 20px 45px rgba(6, 64, 43, 0.16);
}
.st-cta-content h3 {
  font-family: 'Lexend', sans-serif;
  font-size: clamp(1.2rem, 2.2vw, 1.6rem);
  font-weight: 800;
  line-height: 1.25;
  margin-bottom: 8px;
  color: #FFFFFF;
}
.st-cta-content p {
  font-size: 0.92rem;
  color: rgba(255, 255, 255, 0.85);
  max-width: 620px;
}
.st-btn-wa {
  background: #25D366;
  color: #FFFFFF;
  border-radius: 12px;
  padding: 13px 24px;
  font-family: 'Lexend', sans-serif;
  font-size: 0.88rem;
  font-weight: 700;
  display: inline-flex;
  align-items: center;
  gap: 9px;
  white-space: nowrap;
  box-shadow: 0 8px 20px rgba(37, 211, 102, 0.35);
  transition: transform 0.18s, box-shadow 0.18s;
  flex-shrink: 0;
}
.st-btn-wa:hover {
  transform: translateY(-2px);
  box-shadow: 0 12px 28px rgba(37, 211, 102, 0.45);
}

/* ─── TOOL ARTICLE & FAQ SECTION ────────────────────────── */
.st-tool-article {
  background: #FFFFFF;
  padding: 64px 0;
  border-top: 1px solid var(--st-slate-200);
}
.st-article-inner { max-width: 880px; margin: 0 auto; }
.st-tool-article h2 {
  font-family: 'Lexend', sans-serif;
  font-size: clamp(1.35rem, 2.5vw, 1.85rem);
  font-weight: 800;
  color: var(--st-slate-900);
  margin: 40px 0 14px;
  letter-spacing: -0.02em;
}
.st-tool-article h2:first-child { margin-top: 0; }
.st-tool-article p {
  font-size: 0.95rem;
  line-height: 1.75;
  color: var(--st-slate-700);
  margin-bottom: 16px;
}
.st-steps-list {
  padding-left: 20px;
  font-size: 0.95rem;
  line-height: 1.75;
  color: var(--st-slate-700);
  margin-bottom: 24px;
}
.st-steps-list li { margin-bottom: 8px; }

/* FAQ Cards */
.st-faq-grid {
  display: grid;
  gap: 12px;
  margin: 16px 0 32px;
}
.st-faq-card {
  border: 1px solid var(--st-slate-200);
  border-radius: var(--st-radius-md);
  padding: 18px 22px;
  background: var(--st-slate-50);
  transition: border-color 0.2s, background 0.2s;
}
.st-faq-card:hover {
  border-color: var(--st-emerald);
  background: #FFFFFF;
}
.st-faq-card h3 {
  font-family: 'Lexend', sans-serif;
  font-size: 1rem;
  font-weight: 700;
  color: var(--st-slate-900);
  margin-bottom: 6px;
}
.st-faq-card p {
  font-size: 0.9rem;
  line-height: 1.65;
  color: var(--st-slate-600);
  margin: 0;
}
.st-faq-card a {
  color: var(--st-emerald-dark);
  font-weight: 700;
  text-decoration: underline;
  text-underline-offset: 3px;
  transition: color 0.18s;
}
.st-faq-card a:hover { color: var(--st-forest); }

/* Related Guide Banners */
.st-guide-card {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 16px;
  margin: 16px 0;
  padding: 18px 22px;
  border: 1px solid #DCFCE7;
  background: #F0FDF4;
  border-radius: var(--st-radius-md);
  color: #166534;
  transition: transform 0.18s, background 0.18s;
}
.st-guide-card:hover {
  background: #DCFCE7;
  transform: translateY(-2px);
}
.st-guide-card strong {
  display: block;
  font-family: 'Lexend', sans-serif;
  font-size: 0.95rem;
  color: #14532D;
}
.st-guide-card span {
  display: block;
  font-size: 0.82rem;
  color: #166534;
  margin-top: 3px;
}

/* Related Trainings Grid */
.st-related-trainings {
  background: var(--st-slate-50);
  padding: 56px 0;
  border-top: 1px solid var(--st-slate-200);
}
.st-related-trainings h2 {
  font-family: 'Lexend', sans-serif;
  font-size: clamp(1.35rem, 2.5vw, 1.85rem);
  font-weight: 800;
  color: var(--st-slate-900);
  margin-bottom: 20px;
}
.st-trainings-grid {
  list-style: none;
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 12px;
}
.st-training-item a {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 16px 20px;
  background: #FFFFFF;
  border: 1px solid var(--st-slate-200);
  border-radius: var(--st-radius-md);
  font-family: 'Source Sans 3', sans-serif;
  font-size: 0.92rem;
  font-weight: 700;
  color: var(--st-slate-800);
  transition: all 0.18s;
}
.st-training-item a:hover {
  border-color: var(--st-emerald);
  color: var(--st-emerald-dark);
  transform: translateY(-2px);
  box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
}

/* ─── MODERN MODAL DIALOG ───────────────────────────────── */
.st-modal-overlay {
  position: fixed;
  inset: 0;
  background: rgba(15, 23, 42, 0.65);
  backdrop-filter: blur(8px);
  z-index: 999;
  display: none;
  align-items: center;
  justify-content: center;
  padding: 20px;
  animation: fadeIn 0.2s ease;
}
.st-modal-overlay.show { display: flex; }
@keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }

.st-modal-dialog {
  background: #FFFFFF;
  border-radius: var(--st-radius-xl);
  max-width: 720px;
  width: 100%;
  max-height: 88vh;
  overflow-y: auto;
  padding: 28px;
  box-shadow: 0 30px 80px rgba(0, 0, 0, 0.35);
  animation: slideUp 0.25s cubic-bezier(0.16, 1, 0.3, 1);
}
@keyframes slideUp { from { transform: translateY(18px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }

.st-modal-head {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  gap: 16px;
  margin-bottom: 18px;
  padding-bottom: 14px;
  border-bottom: 1px solid var(--st-slate-200);
}
.st-modal-head h2 {
  font-family: 'Lexend', sans-serif;
  font-size: clamp(1.15rem, 2.2vw, 1.45rem);
  font-weight: 800;
  color: var(--st-slate-900);
  line-height: 1.3;
}
.st-btn-close {
  background: var(--st-slate-100);
  border: none;
  border-radius: 999px;
  padding: 6px 12px;
  font-family: 'Lexend', sans-serif;
  font-size: 0.78rem;
  font-weight: 700;
  color: var(--st-slate-700);
  cursor: pointer;
  transition: all 0.15s;
}
.st-btn-close:hover { background: var(--st-slate-200); color: var(--st-slate-900); }

.st-stat-box {
  background: #F0FDF4;
  border: 1px solid #BBF7D0;
  border-radius: var(--st-radius-md);
  padding: 12px 16px;
  margin-bottom: 18px;
  font-size: 0.88rem;
  color: #14532D;
  display: flex;
  gap: 10px;
  align-items: flex-start;
}
.st-modal-section { margin-bottom: 18px; }
.st-modal-section h4 {
  font-family: 'Lexend', sans-serif;
  font-size: 0.86rem;
  font-weight: 700;
  color: var(--st-forest);
  margin-bottom: 8px;
  text-transform: uppercase;
  letter-spacing: 0.04em;
}
.st-modal-section p { font-size: 0.92rem; color: var(--st-slate-700); line-height: 1.6; }
.st-discuss-box {
  background: var(--st-slate-50);
  border-left: 3px solid var(--st-forest);
  border-radius: 6px;
  padding: 9px 13px;
  margin-bottom: 6px;
  font-size: 0.88rem;
  color: var(--st-slate-800);
}
.st-action-steps {
  padding-left: 18px;
  font-size: 0.9rem;
  line-height: 1.7;
  color: var(--st-slate-700);
}
.st-action-steps li { margin-bottom: 4px; }

.st-modal-related {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  background: #FFF7ED;
  border: 1px solid #FFEDD5;
  border-radius: var(--st-radius-md);
  padding: 12px 16px;
  margin-top: 18px;
  color: #9A3412;
  font-size: 0.85rem;
  font-weight: 700;
}

.st-modal-actions {
  display: flex;
  gap: 10px;
  flex-wrap: wrap;
  margin-top: 22px;
  padding-top: 16px;
  border-top: 1px solid var(--st-slate-100);
}

/* ─── RESPONSIVE RULES ──────────────────────────────────── */
@media (max-width: 992px) {
  .st-hero-grid { grid-template-columns: 1fr; gap: 36px; }
  .st-hero-panel { display: none; }
  .st-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
  .st-trainings-grid { grid-template-columns: 1fr; }
  .st-discovery { top: 62px; }
}
@media (max-width: 640px) {
  .container { padding: 0 16px; }
  .st-hero { padding: 50px 0 40px; }
  .st-grid { grid-template-columns: 1fr; gap: 16px; }
  .st-cta-strip { flex-direction: column; align-items: flex-start; padding: 28px 20px; }
  .st-btn-wa { width: 100%; justify-content: center; }
  .st-search-btn { padding: 10px 14px; }
  .st-modal-dialog { padding: 20px 16px; border-radius: 20px 20px 0 0; max-height: 92vh; }
  .st-modal-overlay { padding: 0; align-items: flex-end; }
}
</style>

<?php require __DIR__ . '/../includes/navbar.php'; ?>
<main class="st-page" id="konten-utama">

<!-- ══════════════════════════════════════════════════════════
     HERO SECTION (HIGH CONVERTING CTR + TRUST PROOFS)
     ══════════════════════════════════════════════════════════ -->
<section class="st-hero">
  <div class="container">
    <div class="st-hero-grid">
      <div class="st-hero-content">
        <div class="st-hero-badge">
          <span class="st-pulse-dot"></span>
          Kamus &amp; Database Safety Talk K3 2026
        </div>
        <h1>
          <span>100 Materi Safety Talk Harian</span>
          Toolbox Meeting Singkat &amp; Jelas
        </h1>
        <p class="st-lead">
          Topik K3 harian terlengkap — fakta statistik, poin diskusi, teknologi K3 &amp; AI, serta lembar daftar hadir siap cetak.
        </p>

        <!-- Elevated Search Bar -->
        <div class="st-search-box">
          <span class="st-search-icon" aria-hidden="true">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
          </span>
          <input type="search" id="stSearch" class="st-search-input" placeholder="Cari topik: ketinggian, listrik, APD, atau AI..." aria-label="Cari materi safety talk" oninput="filterTalks()">
          <button type="button" class="st-search-btn" onclick="filterTalks()">
            <span>Cari Topik</span>
          </button>
        </div>

        <!-- High-CTR Quick Topic Chips -->
        <div class="st-quick-chips" aria-label="Topik Populer">
          <span class="st-quick-label">⚡ Topik Cepat:</span>
          <button type="button" class="st-chip" onclick="quickSearch('Ketinggian')">Ketinggian</button>
          <button type="button" class="st-chip" onclick="quickSearch('APD')">APD Wajib</button>
          <button type="button" class="st-chip" onclick="quickSearch('Kebakaran')">APAR &amp; Api</button>
          <button type="button" class="st-chip" onclick="quickSearch('Listrik')">LOTO &amp; Listrik</button>
          <button type="button" class="st-chip" onclick="quickSearch('Confined Space')">Ruang Terbatas</button>
          <button type="button" class="st-chip" onclick="quickSearch('Forklift')">Forklift</button>
        </div>

        <!-- Trust Badges -->
        <div class="st-trust-row" aria-label="Keunggulan materi">
          <div class="st-trust-item">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
            <span>100% Gratis &amp; Siap Cetak</span>
          </div>
          <div class="st-trust-item">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
            <span>Format Ringkas 5–10 Menit</span>
          </div>
          <div class="st-trust-item">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
            <span>Disertai Lembar Absensi (TBM)</span>
          </div>
        </div>
      </div>

      <!-- Right Stat Card -->
      <aside class="st-hero-panel" aria-label="Ringkasan database">
        <p class="st-panel-eyebrow">Pusat Materi Praktis</p>
        <h2>Satu database lengkap untuk briefing K3 setahun penuh.</h2>
        <div class="st-stat-matrix">
          <div class="st-stat-cell">
            <strong>100</strong>
            <span>Topik Terkurasi</span>
          </div>
          <div class="st-stat-cell">
            <strong>11</strong>
            <span>Kategori Sektor</span>
          </div>
          <div class="st-stat-cell">
            <strong>AI &amp; IoT</strong>
            <span>Materi Era Baru</span>
          </div>
          <div class="st-stat-cell">
            <strong>100%</strong>
            <span>Lembar Hadir TBM</span>
          </div>
        </div>
        <a href="#talkGrid" class="st-panel-cta">Jelajahi 100 Topik ↓</a>
      </aside>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════════════════
     CATEGORY DISCOVERY TABS (SMOOTH STICKY BAR)
     ══════════════════════════════════════════════════════════ -->
<div class="st-discovery">
  <div class="container">
    <div class="st-filter-bar" aria-label="Filter kategori materi">
      <button class="st-cat-btn active" onclick="filterCat(this,'all')">Semua (100)</button>
      <button class="st-cat-btn" onclick="filterCat(this,'umum')">Umum</button>
      <button class="st-cat-btn" onclick="filterCat(this,'ketinggian')">Ketinggian</button>
      <button class="st-cat-btn" onclick="filterCat(this,'kebakaran')">Kebakaran</button>
      <button class="st-cat-btn" onclick="filterCat(this,'listrik')">Listrik</button>
      <button class="st-cat-btn" onclick="filterCat(this,'kimia')">B3 &amp; Kimia</button>
      <button class="st-cat-btn" onclick="filterCat(this,'alatberat')">Alat Berat</button>
      <button class="st-cat-btn" onclick="filterCat(this,'kesehatan')">Kesehatan</button>
      <button class="st-cat-btn" onclick="filterCat(this,'konstruksi')">Konstruksi</button>
      <button class="st-cat-btn" onclick="filterCat(this,'tambang')">Tambang</button>
      <button class="st-cat-btn" onclick="filterCat(this,'lingkungan')">Lingkungan</button>
      <button class="st-cat-btn" onclick="filterCat(this,'teknologi')">Teknologi &amp; AI</button>
    </div>
  </div>
</div>

<!-- ══════════════════════════════════════════════════════════
     MAIN CARDS GRID (100 TOPICS)
     ══════════════════════════════════════════════════════════ -->
<section class="st-main-content">
  <div class="container">
    <div class="st-results-header">
      <div>
        <p class="st-eyebrow">Pilih Materi Hari Ini</p>
        <h2>Materi untuk Briefing Shift Kerja</h2>
      </div>
      <span class="st-results-count" id="stResultsCount" aria-live="polite">100 topik</span>
    </div>

    <div class="st-grid" id="talkGrid">
      <?php foreach ($talks as $i => $t): ?>
      <div class="st-card<?= $i >= 12 ? ' is-hidden' : '' ?>" data-cat="<?= htmlspecialchars($t['cat']) ?>" onclick="openModal(<?= $i ?>)">
        <div class="st-card-top">
          <span class="st-cat-badge cat-<?= htmlspecialchars($t['cat']) ?>"><?= htmlspecialchars(ucfirst($t['cat'])) ?></span>
          <span class="st-topic-id">Topik #<?= (int)$t['w'] ?></span>
        </div>
        <div class="st-card-header">
          <h3><?= htmlspecialchars($t['title']) ?></h3>
        </div>
        <div class="st-card-body"><?= htmlspecialchars($t['desc']) ?></div>
        <div class="st-card-tags">
          <?php foreach ($t['tags'] as $tag): ?>
            <span class="st-tag"><?= htmlspecialchars($tag) ?></span>
          <?php endforeach; ?>
        </div>
        <a class="st-card-related" href="<?= htmlspecialchars($t['related']['url']) ?>" onclick="event.stopPropagation()">
          <span>Pelajari: <?= htmlspecialchars($t['related']['label']) ?></span>
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
        </a>
        <div class="st-card-footer">
          <button class="st-btn-detail" onclick="event.stopPropagation();openModal(<?= $i ?>)" type="button">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
            <span>Lihat Detail</span>
          </button>
          <button class="st-btn-print" onclick="event.stopPropagation();printTalk(<?= $i ?>)" type="button" title="Cetak materi dan lembar absensi">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
            <span>Cetak</span>
          </button>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- Fallback for noscript -->
    <noscript><style>.st-card.is-hidden{display:flex}</style></noscript>

    <!-- Load More Button with remaining topic indicator -->
    <div class="st-load-more-wrapper">
      <button class="st-load-more-btn" id="stLoadMore" type="button">
        <span>Tampilkan 12 Topik Lagi (88 tersisa)</span>
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><polyline points="19 12 12 19 5 12"/></svg>
      </button>
    </div>

    <!-- High-Converting CTA Banner -->
    <div class="st-cta-strip">
      <div class="st-cta-content">
        <h3>Tingkatkan Kompetensi Memimpin Toolbox Meeting &amp; Safety Leadership</h3>
        <p>Sertifikasi Ahli K3 Umum KEMNAKER RI / BNSP mengajarkan komunikasi K3 efektif, risk assessment, dan budaya K3 industri.</p>
      </div>
      <a href="https://wa.me/6287759151278?text=Halo%20Wahana%2C%20saya%20gunakan%20materi%20100%20safety%20talk%20dan%20ingin%20tanya%20pelatihan%20K3" target="_blank" rel="noopener" class="st-btn-wa">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.664-.699c.97.53 1.871.815 2.795.815 3.183 0 5.769-2.587 5.77-5.767 0-3.181-2.587-5.766-5.769-5.766zm3.376 8.21c-.14.394-.712.723-1.026.768-.314.045-.697.07-2.008-.475-1.583-.658-2.607-2.274-2.686-2.38-.079-.105-.634-.844-.634-1.611 0-.767.4-1.144.542-1.299.143-.155.314-.194.42-.194.105 0 .211.002.303.007.098.005.228-.037.356.27.132.316.45 1.097.489 1.176.04.079.066.172.013.277-.053.106-.079.172-.158.264-.079.092-.167.206-.238.277-.08.079-.163.165-.07.324.093.159.412.68.884 1.101.608.542 1.121.71 1.28.789.158.079.251.066.344-.04.092-.106.396-.462.502-.62.106-.159.211-.132.356-.079.145.053.924.436 1.082.515.158.08.264.119.303.185.04.066.04.382-.1.776zM12 2C6.477 2 2 6.477 2 12c0 1.891.524 3.662 1.435 5.178L2 22l4.957-1.398A9.957 9.957 0 0 0 12 22c5.523 0 10-4.477 10-10S17.523 2 12 2z"/></svg>
        <span>Tanya Pelatihan K3 Resmi</span>
      </a>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════════════════
     GUIDE & FAQ SECTION (PRESERVED CONTENT + NATURAL BACKLINK)
     ══════════════════════════════════════════════════════════ -->
<section class="st-tool-article">
  <div class="container">
    <div class="st-article-inner">
      <h2>Cara Menggunakan Database 100 Materi Safety Talk</h2>
      <p>Database ini dirancang agar praktis digunakan oleh HSE Officer, Supervisor, Foreman, dan pimpinan rapat keselamatan (TBM/P5M) harian:</p>
      <ol class="st-steps-list">
        <li><strong>Pencarian Cepat:</strong> Ketik kata kunci pekerjaan hari ini (seperti <em>harian, ketinggian, alat berat, AI, listrik</em>) pada kolom pencarian di bagian atas atau klik tombol topik cepat.</li>
        <li><strong>Filter Kategori:</strong> Gunakan tombol chip kategori untuk memfilter topik spesifik industri (Konstruksi, Tambang, Manufaktur, B3, Teknologi AI K3).</li>
        <li><strong>Poin Diskusi Dua Arah:</strong> Manfaatkan 4 pertanyaan diskusi agar peserta toolbox meeting berpartisipasi aktif, bukan mendengarkan ceramah pasif.</li>
        <li><strong>Cetak Langsung + Lembar Absensi:</strong> Klik tombol "Cetak" untuk mengunduh materi lengkap yang menyatu dengan lembar formulir Daftar Hadir Toolbox Meeting.</li>
      </ol>

      <h2>Teknologi &amp; AI dalam Era Baru Safety Talk K3</h2>
      <p>Implementasi Keselamatan dan Kesehatan Kerja (K3) kini memasuki era kecerdasan buatan (AI) dan IoT. Penggunaan kamera computer vision untuk deteksi APD otomatis, sensor kelelahan (fatigue smartwatch), inspeksi drone di ketinggian, serta e-PTW berbasis sensor IoT membantu mengantisipasi bahaya sebelum insiden terjadi. Topik 53–57 dan 97–99 dirancang khusus untuk membawa wawasan keselamatan modern ini ke lapangan Anda.</p>

      <h2>Pertanyaan Umum (FAQ)</h2>
      <div class="st-faq-grid">
        <div class="st-faq-card">
          <h3>Berapa lama durasi ideal satu sesi Safety Talk / Toolbox Meeting?</h3>
          <p>Idealnya 5 hingga 10 menit di awal shift. Sampaikan 1 topik utama, ajukan 2-3 pertanyaan diskusi, dan tutup dengan komitmen tindakan K3 hari itu.</p>
        </div>
        <div class="st-faq-card">
          <h3>Siapa yang seharusnya memimpin safety talk harian?</h3>
          <p>Idealnya dipimpin langsung oleh supervisor, foreman, atau tim HSE di lapangan untuk menunjukkan kepemimpinan K3 operasional. Dalam pelaksanaannya, materi dan pengawasan keselamatan kerja dikoordinasikan oleh <a href="https://www.ak3u.my.id/ahli-k3-umum/" target="_blank" rel="noopener">Ahli K3 Umum</a> sebagai penanggung jawab implementasi K3 di perusahaan.</p>
        </div>
        <div class="st-faq-card">
          <h3>Apakah materi dan lembar absensi ini boleh didownload dan dicetak gratis?</h3>
          <p>Ya, 100% gratis digunakan oleh perusahaan, HSE officer, maupun supervisor operasional di seluruh Indonesia.</p>
        </div>
      </div>

      <a class="st-guide-card" href="/artikel/perbedaan-safety-talk-toolbox-meeting-tbm-safety-briefing/">
        <span>
          <strong>Safety Talk, Toolbox Meeting, TBM, dan Safety Briefing: Apa Bedanya?</strong>
          <span>Pilih bentuk komunikasi K3 yang tepat untuk setiap situasi kerja.</span>
        </span>
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
      </a>
      <a class="st-guide-card" href="/artikel/cara-membawakan-safety-talk-5-menit/">
        <span>
          <strong>Cara Membawakan Safety Talk 5 Menit yang Menarik</strong>
          <span>Gunakan struktur sederhana agar briefing singkat menghasilkan tindakan nyata.</span>
        </span>
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
      </a>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════════════════
     RELATED TRAININGS (CRAWLABLE INTERNAL LINKS)
     ══════════════════════════════════════════════════════════ -->
<section class="st-related-trainings">
  <div class="container">
    <h2>Pelatihan K3 Terkait</h2>
    <ul class="st-trainings-grid">
      <?php foreach ($related_trainings as $rt): ?>
      <li class="st-training-item">
        <a href="<?= htmlspecialchars($rt['url']) ?>">
          <span><?= htmlspecialchars($rt['label']) ?></span>
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
        </a>
      </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>

<!-- ══════════════════════════════════════════════════════════
     MODAL DIALOG (BLUR BACKDROP + CLEAN CARD DESIGN)
     ══════════════════════════════════════════════════════════ -->
<div class="st-modal-overlay" id="modalOverlay" onclick="closeModal(event)">
  <div class="st-modal-dialog" id="modalContent"></div>
</div>

</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>

<script>
// Single source of truth from PHP array
const talks = <?php echo json_encode($talks, JSON_UNESCAPED_UNICODE); ?>;

let activeCat = 'all';
let visibleLimit = 12;
let currentTalks = talks;

function renderTalks(list, resetLimit = false){
  if(resetLimit) visibleLimit = 12;
  currentTalks = list;
  const grid = document.getElementById('talkGrid');
  const resultsCount = document.getElementById('stResultsCount');
  const loadMore = document.getElementById('stLoadMore');
  resultsCount.textContent = `${list.length} topik`;
  
  if(!list.length){
    grid.innerHTML = `
      <div style="color:var(--st-slate-600);text-align:center;padding:50px 20px;grid-column:1/-1;background:#fff;border-radius:16px;border:1px dashed var(--st-slate-300);">
        <p style="font-family:'Lexend',sans-serif;font-size:1.15rem;font-weight:700;color:var(--st-slate-900);margin-bottom:6px">Topik Tidak Ditemukan</p>
        <p style="font-size:0.9rem;margin-bottom:16px">Coba kata kunci lain atau bersihkan pencarian untuk melihat seluruh 100 topik.</p>
        <button type="button" onclick="resetFilter()" style="background:var(--st-forest);color:#fff;border:none;border-radius:999px;padding:9px 20px;font-family:'Lexend',sans-serif;font-weight:700;font-size:0.82rem;cursor:pointer">Tampilkan Semua Topik</button>
      </div>`;
    loadMore.hidden = true;
    return;
  }
  
  grid.innerHTML = list.slice(0, visibleLimit).map(t=>`
    <div class="st-card" data-cat="${t.cat}" onclick="openModal(${t.w-1})">
      <div class="st-card-top">
        <span class="st-cat-badge cat-${t.cat}">${t.cat.toUpperCase()}</span>
        <span class="st-topic-id">Topik #${t.w}</span>
      </div>
      <div class="st-card-header">
        <h3>${t.title}</h3>
      </div>
      <div class="st-card-body">${t.desc}</div>
      <div class="st-card-tags">
        ${t.tags.map(tg=>`<span class="st-tag">${tg}</span>`).join('')}
      </div>
      <a class="st-card-related" href="${t.related.url}" onclick="event.stopPropagation()">
        <span>Pelajari: ${t.related.label}</span>
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
      </a>
      <div class="st-card-footer">
        <button class="st-btn-detail" onclick="event.stopPropagation();openModal(${t.w-1})" type="button">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
          <span>Lihat Detail</span>
        </button>
        <button class="st-btn-print" onclick="event.stopPropagation();printTalk(${t.w-1})" type="button" title="Cetak materi dan lembar absensi">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
          <span>Cetak</span>
        </button>
      </div>
    </div>
  `).join('');
  
  const remaining = Math.max(0, list.length - visibleLimit);
  loadMore.hidden = remaining === 0;
  if(remaining){
    loadMore.innerHTML = `
      <span>Tampilkan ${Math.min(12, remaining)} Topik Lagi (${remaining} tersisa)</span>
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><polyline points="19 12 12 19 5 12"/></svg>
    `;
  }
}

function resetFilter(){
  document.getElementById('stSearch').value = '';
  document.querySelectorAll('.st-cat-btn').forEach(b=>b.classList.remove('active'));
  const allBtn = document.querySelector('.st-cat-btn');
  if(allBtn) allBtn.classList.add('active');
  activeCat = 'all';
  filterTalks();
}

function quickSearch(keyword){
  const input = document.getElementById('stSearch');
  input.value = keyword;
  document.querySelectorAll('.st-cat-btn').forEach(b=>b.classList.remove('active'));
  const allBtn = document.querySelector('.st-cat-btn');
  if(allBtn) allBtn.classList.add('active');
  activeCat = 'all';
  filterTalks();
  
  const target = document.getElementById('talkGrid');
  if(target){
    const offset = 140;
    const bodyRect = document.body.getBoundingClientRect().top;
    const elementRect = target.getBoundingClientRect().top;
    const elementPosition = elementRect - bodyRect;
    const offsetPosition = elementPosition - offset;
    window.scrollTo({ top: offsetPosition, behavior: 'smooth' });
  }
}

function filterTalks(){
  const q = document.getElementById('stSearch').value.toLowerCase().trim();
  let list = talks;
  if(activeCat !== 'all') list = list.filter(t=>t.cat===activeCat);
  if(q) list = list.filter(t=>(t.w + ' ' + t.title + ' ' + t.desc + ' ' + t.tags.join(' ')).toLowerCase().includes(q));
  renderTalks(list, true);
}

function filterCat(btn, cat){
  document.querySelectorAll('.st-cat-btn').forEach(b=>b.classList.remove('active'));
  btn.classList.add('active');
  activeCat = cat;
  filterTalks();
}

document.getElementById('stLoadMore').addEventListener('click', function(){
  visibleLimit += 12;
  renderTalks(currentTalks);
});

function openModal(idx){
  const t = talks[idx];
  const modal = document.getElementById('modalContent');
  modal.innerHTML = `
    <div class="st-modal-head">
      <div>
        <span class="st-cat-badge cat-${t.cat}" style="margin-bottom:6px;display:inline-block">${t.cat.toUpperCase()}</span>
        <h2>Topik ${t.w}: ${t.title}</h2>
      </div>
      <button class="st-btn-close" onclick="closeModal()" type="button">✕ Tutup</button>
    </div>
    
    <div class="st-stat-box">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;margin-top:2px"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
      <div>
        <strong>Fakta &amp; Statistik K3:</strong> ${t.stat}
      </div>
    </div>
    
    <div class="st-modal-section">
      <h4>Ringkasan Materi</h4>
      <p>${t.desc}</p>
    </div>
    
    <div class="st-modal-section">
      <h4>Poin Diskusi Toolbox Meeting (2 Arah)</h4>
      ${t.points.map((p,i)=>`<div class="st-discuss-box"><strong>${i+1}.</strong> ${p}</div>`).join('')}
    </div>
    
    <div class="st-modal-section">
      <h4>Langkah Tindakan Lapangan (Action Points)</h4>
      <ol class="st-action-steps">${t.steps.map(s=>`<li>${s}</li>`).join('')}</ol>
    </div>
    
    <a class="st-modal-related" href="${t.related.url}">
      <span>Program Pelatihan Terkait: <strong>${t.related.label}</strong></span>
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
    </a>
    
    <div class="st-modal-actions">
      <button onclick="printTalk(${idx})" class="st-btn-detail" type="button" style="padding:11px 20px;font-size:0.84rem">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
        <span>Print Materi &amp; Lembar Absensi</span>
      </button>
      <a href="https://wa.me/6287759151278?text=Halo%20Wahana%2C%20saya%20gunakan%20materi%20safety%20talk%20dan%20ingin%20tanya%20pelatihan%20K3" target="_blank" rel="noopener" class="st-btn-wa" style="padding:11px 20px;font-size:0.84rem">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.664-.699c.97.53 1.871.815 2.795.815 3.183 0 5.769-2.587 5.77-5.767 0-3.181-2.587-5.766-5.769-5.766zm3.376 8.21c-.14.394-.712.723-1.026.768-.314.045-.697.07-2.008-.475-1.583-.658-2.607-2.274-2.686-2.38-.079-.105-.634-.844-.634-1.611 0-.767.4-1.144.542-1.299.143-.155.314-.194.42-.194.105 0 .211.002.303.007.098.005.228-.037.356.27.132.316.45 1.097.489 1.176.04.079.066.172.013.277-.053.106-.079.172-.158.264-.079.092-.167.206-.238.277-.08.079-.163.165-.07.324.093.159.412.68.884 1.101.608.542 1.121.71 1.28.789.158.079.251.066.344-.04.092-.106.396-.462.502-.62.106-.159.211-.132.356-.079.145.053.924.436 1.082.515.158.08.264.119.303.185.04.066.04.382-.1.776zM12 2C6.477 2 2 6.477 2 12c0 1.891.524 3.662 1.435 5.178L2 22l4.957-1.398A9.957 9.957 0 0 0 12 22c5.523 0 10-4.477 10-10S17.523 2 12 2z"/></svg>
        <span>Tanya Pelatihan K3</span>
      </a>
    </div>
  `;
  document.getElementById('modalOverlay').classList.add('show');
  document.body.style.overflow = 'hidden';
}

function closeModal(e){
  if(!e || e.target === document.getElementById('modalOverlay')){
    document.getElementById('modalOverlay').classList.remove('show');
    document.body.style.overflow = '';
  }
}

document.addEventListener('keydown', e=>{
  if(e.key==='Escape') {
    document.getElementById('modalOverlay').classList.remove('show');
    document.body.style.overflow = '';
  }
});

function printTalk(idx){
  const t = talks[idx];
  const win = window.open('','_blank');
  win.document.write(`<!DOCTYPE html><html><head><title>Safety Talk Topik ${t.w}: ${t.title}</title>
  <style>
  body{font-family:'Segoe UI',Arial,sans-serif;padding:24px;max-width:720px;margin:0 auto;color:#1e293b;line-height:1.5}
  h1{font-size:16pt;border-bottom:2px solid #06402B;padding-bottom:8px;margin-bottom:12px;color:#06402B}
  h3{font-size:11pt;color:#06402B;margin-top:16px;margin-bottom:6px}
  .stat{background:#F0FDF4;padding:10px 14px;border-radius:6px;font-size:9pt;margin:12px 0;border:1px solid #BBF7D0;color:#14532D}
  ol,ul{padding-left:20px;line-height:1.6;font-size:9.5pt}
  li{margin-bottom:4px}
  .footer{margin-top:28px;border-top:1px solid #E2E8F0;padding-top:8px;font-size:8pt;color:#64748B;text-align:center}
  table{width:100%;margin-top:10px;border-collapse:collapse;font-size:8.5pt}
  th{border:1px solid #CBD5E1;padding:6px;background:#F8FAFC;text-align:left}
  td{border:1px solid #CBD5E1;padding:6px;height:24px}
  </style></head><body>
  <h1>Safety Talk — Topik ${t.w}: ${t.title}</h1>
  <div class="stat"><strong>Fakta K3:</strong> ${t.stat}</div>
  <p style="font-size:9.5pt;line-height:1.6">${t.desc}</p>
  <h3>Poin Diskusi Toolbox Meeting (2 Arah)</h3>
  <ol>${t.points.map(p=>`<li>${p}</li>`).join('')}</ol>
  <h3>Langkah Tindakan Lapangan (Action Steps)</h3>
  <ol>${t.steps.map(s=>`<li>${s}</li>`).join('')}</ol>
  <div style="margin-top:18px;border:1px solid #CBD5E1;border-radius:6px;padding:12px">
    <strong style="font-size:10pt;color:#06402B">Daftar Hadir Toolbox Meeting (TBM)</strong><br>
    <div style="margin-top:6px;font-size:8.5pt;color:#475569">
      Tanggal: _______________ | Departemen/Area: _______________ | Pengawas/Fasilitator: _______________<br>
      <table>
        <tr><th style="width:36px;text-align:center">No</th><th>Nama Pekerja</th><th>Jabatan</th><th style="width:120px">Tanda Tangan</th></tr>
        ${[1,2,3,4,5,6,7,8,9,10].map(n=>`<tr><td style="text-align:center">${n}</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>`).join('')}
      </table>
    </div>
  </div>
  <div class="footer">Materi K3 Resmi dari wahanatotalita.com/tools/safety-talk/ — Wahana Totalita Konsultan</div>
  </body></html>`);
  win.document.close();
  win.print();
}
</script>
<?php require __DIR__ . '/../includes/scripts.php'; ?>
</body>
</html>
