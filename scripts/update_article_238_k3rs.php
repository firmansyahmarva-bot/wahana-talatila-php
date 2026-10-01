<?php
require_once __DIR__ . '/../config.php';

$key = 'wtk_srv_' . hash('sha256', DB_PASS . 'WahanaTotalitaSecure2026!');

$article_id = 238;

$deep_content = <<<HTML
<h2>Paradoks Keselamatan: Rumah Sakit Sebagai Tempat Kerja Berisiko Tinggi</h2>
<p>Banyak masyarakat berasumsi bahwa rumah sakit adalah tempat yang paling steril, aman, dan menyehatkan. Namun, dari sudut pandang <strong>Keselamatan dan Kesehatan Kerja (K3)</strong>, rumah sakit justru merupakan salah satu lingkungan kerja paling berbahaya dan kompleks di dunia. Berbeda dari pabrik manufaktur atau proyek konstruksi yang umumnya menghadapi bahaya mekanis dan fisik yang homogen, fasilitas pelayanan kesehatan (fasyankes) menghadapkan tenaga kesehatan (nakes) dan karyawan non-medis pada kombinasi bahaya simultan: agen biologis patogen, radiasi pengion, obat-obatan sitotoksik pemicu kanker, gas anestesi buang, beban kerja psikososial ekstrem, hingga potensi kebakaran di area rawat inap dengan pasien yang tidak mampu menyelamatkan diri (non-ambulatory patients).</p>

<p>Data global dari Organisasi Kesehatan Dunia (WHO) dan ILO menunjukkan bahwa tenaga kesehatan memiliki tingkat kecelakaan kerja dan penyakit akibat kerja (PAK) yang signifikan, mulai dari cedera tertusuk jarum suntik (<em>Needle Stick Injuries</em> / NSI), penularan infeksi airborne seperti Tuberkulosis (TBC), hingga gangguan muskuloskeletal (MSDs) kronis akibat pemindahan pasien tirah baring secara manual. Oleh karena itu, penerapan <strong>Keselamatan dan Kesehatan Kerja Rumah Sakit (K3RS)</strong> bukan lagi sekadar formalitas administratif, melainkan kewajiban hukum mutlak dan pilar utama kelangsungan operasional rumah sakit.</p>

<h2>Landasan Hukum K3RS: Permenkes No. 66 Tahun 2016 & UU No. 17 Tahun 2023</h2>
<p>Di Indonesia, kerangka hukum penyelenggaraan K3 di lingkungan fasyankes diatur secara tegas melalui beberapa regulasi hierarkis:</p>
<ul>
  <li><strong>Undang-Undang No. 1 Tahun 1970 tentang Keselamatan Kerja:</strong> Menetapkan rumah sakit sebagai tempat kerja dengan potensi bahaya yang wajib menyelenggarakan pembinaan keselamatan kerja bagi seluruh personel.</li>
  <li><strong>Undang-Undang No. 17 Tahun 2023 tentang Kesehatan:</strong> Mengamanatkan bahwa pengelola fasilitas pelayanan kesehatan wajib menjamin kesehatan dan keselamatan tenaga medis, tenaga kesehatan, pasien, pendamping pasien, serta pengunjung melalui pemenuhan standar K3 yang terakreditasi.</li>
  <li><strong>Peraturan Menteri Kesehatan No. 66 Tahun 2016 tentang Keselamatan dan Kesehatan Kerja Rumah Sakit (Permenkes 66/2016):</strong> Menjadi "kitab suci" operasional K3RS di Indonesia, yang menguraikan secara rinci standar manajemen risiko, standar keselamatan fasilitas, pelayanan kesehatan kerja, hingga kelembagaan Komite/Instalasi K3RS.</li>
  <li><strong>Standar Akreditasi Rumah Sakit Kementerian Kesehatan (STARKES / KARS):</strong> Khususnya pada Bab <strong>Manajemen Fasilitas dan Keselamatan (MFK)</strong> yang memuat 11 standar penilaian ketat (MFK 1 hingga MFK 11). Ketersediaan program K3RS yang terintegrasi dan personil yang memiliki sertifikasi kompetensi resmi menjadi penentu utama kelulusan Akreditasi Paripurna (Bintang Lima).</li>
</ul>

<h2>Matriks Identifikasi Bahaya Unik di Rumah Sakit (Hospital Hazard Matrix)</h2>
<p>Guna memitigasi insiden secara preventif, Tim K3RS wajib memetakan profil risiko di setiap unit kerja rumah sakit, mulai dari instalasi gawat darurat (IGD), ruang operasi (OK), rawat inap, laboratorium patologi, radiologi, farmasi, gizi, laundry, hingga instalasi pengolahan air limbah (IPAL):</p>

<table>
  <thead>
    <tr>
      <th>Kategori Bahaya</th>
      <th>Contoh Spesifik di Rumah Sakit</th>
      <th>Unit Kerja Paling Berisiko</th>
      <th>Langkah Mitigasi Standar</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>Bahaya Biologis (Infectious Hazards)</strong></td>
      <td>Virus Hepatitis B/C, HIV, Mycobacterium tuberculosis, bakteri nosokomial resisten obat (MRSA), jamur patogen.</td>
      <td>IGD, ICU, Ruang Isolasi Airborne, Laboratorium, Kamar Jenazah.</td>
      <td>Vaksinasi berkala nakes, penggunaan Safety Syringe, SOP Post-Exposure Prophylaxis (PEP), ruang isolasi bertekanan negatif berfilter HEPA.</td>
    </tr>
    <tr>
      <td><strong>Bahaya Fisika &amp; Radiasi</strong></td>
      <td>Sinar-X pengion, radiasi gamma, medan magnet kuat (MRI), laser bedah, bising ruang genset/boiler.</td>
      <td>Radiologi, Kedokteran Nuklir, Radioterapi, CSSD, Kamar Operasi.</td>
      <td>Ruang berpelindung timbal (Pb), TLD Badge pemantau dosis personal, izin BAPETEN, SOP safety MRI non-feromagnetik.</td>
    </tr>
    <tr>
      <td><strong>Bahaya Kimiawi &amp; Sitotoksik</strong></td>
      <td>Obat kemoterapi / antineoplastik, gas anestesi (Isoflurane, Sevoflurane), formalin, etilen oksida (EtO), disinfektan klorin.</td>
      <td>Depo Farmasi Sitotoksik, Kamar Bedah, Patologi Anatomi, CSSD.</td>
      <td>Biological Safety Cabinet (BSC) Kelas II B2, scavenging system gas anestesi, eye wash station, spill kit kimia dan sitotoksik.</td>
    </tr>
    <tr>
      <td><strong>Bahaya Ergonomi</strong></td>
      <td>Mengangkat/memindahkan pasien tirah baring, posisi statis membungkuk saat operasi berjam-jam, repetitive motion laboratorium.</td>
      <td>Ruang Rawat Inap, Kamar Bedah, Fisioterapi, Rekam Medis.</td>
      <td>Penyediaan alat bantu transfer pasien (slide board, patient lifter), pelatihan teknik manual handling ergonomis, kursi kerja adjustable.</td>
    </tr>
    <tr>
      <td><strong>Bahaya Psikososial</strong></td>
      <td>Beban kerja shift malam tinggi, kelelahan emosional (burnout), kekerasan verbal/fisik dari keluarga pasien di IGD.</td>
      <td>IGD, ICU, Ruang Psikiatri, Unit Pendaftaran Pasien.</td>
      <td>Pengaturan jadwal jaga shift yang manusiawi, sistem alarm darurat panik (Panic Button) di IGD, pendampingan psikologis karyawan.</td>
    </tr>
  </tbody>
</table>

<h2>10 Standar Program Wajib K3RS Berdasarkan Permenkes 66/2016</h2>
<p>Berdasarkan Pasal 4 Permenkes No. 66 Tahun 2016, manajemen rumah sakit diwajibkan menyelenggarakan 10 pilar keselamatan yang saling terintegrasi:</p>

<h3>1. Manajemen Risiko K3RS</h3>
<p>Penyusunan profil risiko menyeluruh menggunakan metode <em>Hazard Identification, Risk Assessment, and Determining Control (HIRADC)</em>, analisis kerentanan bahaya (<em>Hazard Vulnerability Assessment</em> / HVA), serta <em>Failure Mode and Effects Analysis</em> (FMEA) untuk proses-proses pelayanan kritis.</p>

<h3>2. Keselamatan dan Keamanan Fasilitas Fisik</h3>
<p>Pengawasan akses area rentan (ruang bayi, farmasi sentral, genset), pemasangan kamera CCTV 24 jam, identifikasi staf dan pengunjung menggunakan kartu tanda pengenal (badge ID), serta pengawasan keselamatan proyek konstruksi/renovasi internal menggunakan protokol <em>Pre-Construction Risk Assessment</em> (PCRA) dan pengendalian infeksi ICRA.</p>

<h3>3. Pelayanan Kesehatan Kerja bagi Karyawan Rumah Sakit</h3>
<p>Penyelenggaraan pemeriksaan kesehatan sebelum bekerja (prakerja), pemeriksaan berkala tahunan (Medical Check-Up / MCU), dan pemeriksaan khusus bagi staf yang bertugas di area radiasi atau sitotoksik. Program mencakup imunisasi wajib Hepatitis B bagi nakes yang berhadapan dengan cairan tubuh, serta penanganan cepat kecelakaan kerja melalui alur tatalaksana pajanan jarum suntik (Needle Stick Injury Protocol).</p>

<h3>4. Pengelolaan Bahan Berbahaya dan Beracun (B3) Medis &amp; Limbah B3</h3>
<p>Pengendalian rantai pasok B3 mulai dari penerimaan, inventarisasi lembar data keselamatan (MSDS/LDKB), penyimpanan di Tempat Penyimpanan Sementara (TPS) Limbah B3 yang memiliki izin lingkungan dan persetujuan teknis, pelabelan simbol B3 internasional, penyediaan Spill Kit tumpahan darah/kimia di setiap bangsal, hingga pengangkutan berizin yang terdata di sistem Festronik KLHK.</p>

<h3>5. Pencegahan dan Pengendalian Kebakaran (Fire Safety)</h3>
<p>Pemeriksaan dan pengujian berkala terhadap sarana proteksi kebakaran aktif (APAR bersertifikasi, sistem sprinkler otomatis, detektor asap/panas, sistem alarm sentral, dan jaringan hidran gedung) serta proteksi pasif (kompartemen dinding tahan api, pintu darurat tahan api dengan panic bar, dan tangga darurat kedap asap). Setiap lantai rawat inap wajib memiliki denah evakuasi horizontal dan vertikal yang mempertimbangkan prioritas evakuasi pasien kritis (ICU/NICU).</p>

<h3>6. Pengelolaan Sistem Utilitas Vital Rumah Sakit</h3>
<p>Pemeliharaan sistem penunjang hidup yang tidak boleh padam sedetik pun: pasokan daya listrik darurat (genset dengan transfer switch otomatis &lt; 10 detik dan UPS ruang operasi), sistem pasokan gas medis sentral (O2, N2O, udara tekan medis, vacuum suction), cadangan air bersih minimal 3x24 jam, serta pengendalian sistem tata udara (HVAC) bertekanan positif di ruang bedah dan bertekanan negatif di ruang isolasi infeksi.</p>

<h3>7. Pengelolaan Peralatan Medis (Medical Equipment Safety)</h3>
<p>Uji fungsi alat kesehatan baru, pemeliharaan preventif terencana, kalibrasi berkala tahunan yang tersertifikasi oleh Balai Pengamanan Fasilitas Kesehatan (BPFK / LPFK), penarikan alat yang mengalami kerusakan (recall protocol), serta pelaporan insiden alat kesehatan ke e-Watch Alkes Kemenkes RI.</p>

<h3>8. Kesiapsiagaan Menghadapi Bencana (Hospital Disaster Plan / HDP)</h3>
<p>Penyusunan dokumen rencana penanggulangan bencana terpadu (HDP) yang membagi respon rumah sakit dalam menghadapi bencana internal (kebakaran, ledakan gas, kebocoran bahan kimia) maupun bencana eksternal (gempa bumi, korban massal kecelakaan lalu lintas, wabah epidemi). Rumah sakit wajib memberlakukan kode darurat (Emergency Codes) yang dihafal seluruh karyawan:</p>
<ul>
  <li><strong>Code Red:</strong> Bahaya kebakaran dan aktivasi tim pemadam api.</li>
  <li><strong>Code Blue:</strong> Henti jantung / henti nafas dan aktivasi Tim Resusitasi Medis.</li>
  <li><strong>Code Pink:</strong> Penculikan bayi atau anak di lingkungan rumah sakit.</li>
  <li><strong>Code Black:</strong> Ancaman bom atau ancaman pembunuhan bersenjata.</li>
  <li><strong>Code Orange:</strong> Tumpahan bahan berbahaya atau kontaminasi B3 skala besar.</li>
  <li><strong>Code Purple:</strong> Evakuasi total seluruh penghuni gedung.</li>
</ul>

<h3>9. Pengelolaan Lingkungan Kerja &amp; Ergonomi Fasyankes</h3>
<p>Pengukuran berkala kualitas fisik lingkungan kerja: pencahayaan ruang operasi (minimal 300-500 lux di ruang umum dan 10.000-20.000 lux di meja bedah), kelembaban dan suhu ruangan, mikrobiologi udara ruang operasi, dan penyesuaian postur kerja perawat.</p>

<h3>10. Pendidikan, Sosialisasi, dan Pelatihan K3RS Seluruh Staf</h3>
<p>Pelaksanaan orientasi K3RS wajib bagi setiap pegawai baru, magang, peserta PPDS, dan tenaga alih daya (cleaning service, security, gizi). Melakukan simulasi kebakaran dan evakuasi berkala minimal 1 tahun sekali yang melibatkan seluruh staf rumah sakit.</p>

<h2>Struktur Organisasi K3RS: Komite vs Instalasi</h2>
<p>Sesuai dengan ketentuan Permenkes 66/2016, kelembagaan K3 di rumah sakit disesuaikan dengan kelas dan kompleksitas fasilitas:</p>
<ul>
  <li><strong>Rumah Sakit Kelas A dan B:</strong> Wajib membentuk <strong>Instalasi K3RS</strong> yang bersifat struktural dan operasional, dipimpin oleh Kepala Instalasi K3RS purna waktu (full time), didampingi oleh <strong>Komite K3RS</strong> sebagai organ penasihat independen kebijakan.</li>
  <li><strong>Rumah Sakit Kelas C dan D:</strong> Sekurang-kurangnya wajib memiliki <strong>Komite K3RS</strong> atau Tim K3RS yang ditetapkan langsung melalui Surat Keputusan (SK) Direktur Utama.</li>
</ul>
<p>Struktur Komite/Instalasi K3RS <strong>wajib berada langsung di bawah Direktur Utama Rumah Sakit</strong>, bukan di bawah kepala bagian umum atau logistik. Penempatan langsung ini bertujuan agar rekomendasi mitigasi bahaya memiliki otoritas hukum penuh dan tidak terbentur birokrasi anggaran internal saat menghadapi potensi insiden fatal.</p>

<h2>Sertifikasi Petugas K3RS BNSP: Standar Emas Penilaian Akreditasi</h2>
<p>Dalam instrumen survei akreditasi rumah sakit (STARKES), surveyor Bab MFK akan memeriksa kualifikasi personil yang ditunjuk mengelola K3. Penunjukan personil tanpa sertifikasi kompetensi resmi akan menjadi temuan mayor (<em>non-compliance</em>).</p>

<p>Sertifikasi <strong>Petugas K3 Fasilitas Pelayanan Kesehatan (K3 Fasyankes / K3RS)</strong> yang diterbitkan oleh <strong>Badan Nasional Sertifikasi Profesi (BNSP)</strong> melalui Lembaga Sertifikasi Profesi (LSP) terakreditasi merupakan bukti pengakuan kompetensi formal nasional. Skema ini mengacu pada Standar Kompetensi Kerja Nasional Indonesia (SKKNI) Bidang Keselamatan dan Kesehatan Kerja:</p>

<ul>
  <li><strong>Unit Kompetensi 1:</strong> Menerapkan peraturan perundang-undangan K3 di lingkungan fasilitas pelayanan kesehatan.</li>
  <li><strong>Unit Kompetensi 2:</strong> Melakukan identifikasi potensi bahaya biologi, fisika, kimia, dan ergonomi di fasyankes.</li>
  <li><strong>Unit Kompetensi 3:</strong> Menentukan dan menerapkan Alat Pelindung Diri (APD) sesuai level hazard klinis.</li>
  <li><strong>Unit Kompetensi 4:</strong> Melakukan inspeksi berkala fasilitas keselamatan dan sarana proteksi kebakaran rumah sakit.</li>
  <li><strong>Unit Kompetensi 5:</strong> Menyusun dan mengevaluasi Prosedur Tanggap Darurat Bencana Fasyankes.</li>
  <li><strong>Unit Kompetensi 6:</strong> Mengelola dokumen limbah medis B3 dan pelaporan insiden keselamatan kerja.</li>
  <li><strong>Unit Kompetensi 7:</strong> Membantu pelaksanaan audit internal program MFK akreditasi rumah sakit.</li>
</ul>

<h2>Roadmap Menghadapi Survei Akreditasi STARKES Bab MFK</h2>
<p>Bagi rumah sakit yang sedang mempersiapkan diri menghadapi survei akreditasi, pastikan dokumen telusur dan kesiapan lapangan berikut telah selesai dikerjakan:</p>
<ol>
  <li><strong>SK Direktur:</strong> Pengangkatan Komite/Instalasi K3RS dan program kerja tahunan K3RS yang ditandatangani pimpinan puncak.</li>
  <li><strong>Pedoman &amp; SOP Lengkap:</strong> Buku Pedoman K3RS, SOP Penanganan Tertusuk Jarum, SOP Tumpahan B3/Sitotoksik, SOP Evakuasi Pasien ICU, dan SOP Pemeliharaan Genset.</li>
  <li><strong>Bukti Kalibrasi &amp; Izin Resmi:</strong> Sertifikat kalibrasi alkes oleh BPFK, izin pemanfaatan radiasi BAPETEN, surat izin TPS Limbah B3, dan sertifikat pengesahan pemakaian genset/boiler dari Disnaker.</li>
  <li><strong>Dokumentasi Simulasi:</strong> Laporan berkala simulasi kebakaran (Drill Code Red) lengkap dengan foto, absensi staf, notulen evaluasi waktu respon (response time), dan perbaikan temuan.</li>
  <li><strong>Sertifikat Kompetensi Personel:</strong> Sertifikat Petugas K3RS BNSP, sertifikat Ahli K3 Umum Kemnaker, dan sertifikat Petugas Proteksi Radiasi (PPR) yang masih berlaku.</li>
</ol>

<h2>Pelatihan &amp; Sertifikasi Petugas K3RS di Wahana Totalita Konsultan</h2>
<p>Wahana Totalita Konsultan menyelenggarakan <strong>Pelatihan &amp; Sertifikasi Petugas K3 Rumah Sakit (K3RS) Berlisensi BNSP</strong> secara reguler, baik melalui metode <em>Blended Learning Online via Zoom</em> interaktif maupun <em>In-House Training</em> langsung di rumah sakit Anda.</p>

<p>Keunggulan program K3RS di Wahana Totalita:</p>
<ul>
  <li><strong>Instruktur Praktisi Senior:</strong> Dibimbing langsung oleh dokter spesialis kedokteran okupasi (Sp.Ok), praktisi Komite K3RS RS Tipe A, dan asesor kompetensi BNSP berpengalaman.</li>
  <li><strong>Bedah Dokumen Akreditasi MFK:</strong> Peserta dibekali modul aplikatif, template dokumen HVA, FMEA, formulir audit MFK, dan format laporan triwulan K3RS.</li>
  <li><strong>Bimbingan Portofolio Asesmen:</strong> Pendampingan intensif penyusunan dokumen portofolio uji kompetensi hingga dinyatakan <em>Kompeten (K)</em> oleh Asesor LSP BNSP.</li>
  <li><strong>Sertifikat Resmi Ganda:</strong> Peserta memperoleh Sertifikat Pelatihan 32 JPL dari Wahana Totalita Konsultan dan Sertifikat Kompetensi Nasional dari Badan Nasional Sertifikasi Profesi (BNSP).</li>
</ul>
HTML;

$faqs = [
    [
        'q' => 'Apakah setiap rumah sakit wajib memiliki Komite atau Instalasi K3RS?',
        'a' => 'Ya. Sesuai Pasal 11 Permenkes No. 66 Tahun 2016, setiap rumah sakit wajib membentuk Komite atau Instalasi K3RS yang bertanggung jawab langsung kepada Direktur Utama Rumah Sakit. Keberadaan organ K3RS ini merupakan elemen penilaian mutlak dalam akreditasi rumah sakit (STARKES).'
    ],
    [
        'q' => 'Apa perbedaan antara Komite K3RS dengan Komite Keselamatan Pasien (KP-RS)?',
        'a' => 'Komite Keselamatan Pasien (KP-RS) berfokus pada pencegahan Kejadian Tidak Diharapkan (KTD) pada pasien akibat kesalahan prosedur klinis, obat, atau diagnosis. Sementara Komite K3RS berfokus pada keselamatan tenaga kerja (dokter, perawat, staf penunjang, cleaning service) dan pengelolaan keselamatan fasilitas fisik, kebakaran, B3, utilitas, dan bencana.'
    ],
    [
        'q' => 'Siapa yang boleh menjabat sebagai Ketua Komite atau Kepala Instalasi K3RS?',
        'a' => 'Berdasarkan Permenkes 66/2016, Ketua Komite atau Kepala Instalasi K3RS diprioritaskan dijabat oleh tenaga medis (dokter) atau tenaga kesehatan masyarakat / sanitarian / perawat yang memiliki kualifikasi pendidikan tambahan dan sertifikasi kompetensi di bidang Keselamatan dan Kesehatan Kerja Rumah Sakit.'
    ],
    [
        'q' => 'Berapa lama masa berlaku sertifikat Petugas K3RS BNSP?',
        'a' => 'Sertifikat kompetensi Petugas K3RS yang diterbitkan oleh Badan Nasional Sertifikasi Profesi (BNSP) berlaku selama 3 (tiga) tahun secara nasional dan dapat diperpanjang melalui proses perpanjangan portofolio asesmen ulang di LSP terlisensi.'
    ],
    [
        'q' => 'Bagaimana alur penanganan darurat jika tenaga kesehatan tertusuk jarum suntik bekas pasien (Needle Stick Injury)?',
        'a' => 'Langkah darurat mencakup: (1) Jangan panik, segera cuci luka di bawah air mengalir dengan sabun antiseptik tanpa memencet jaringan secara berlebihan, (2) Lapor segera ke supervisor dan Komite K3RS/PPI dalam waktu < 2 jam, (3) Lakukan skrining darah donor pasien dan nakes (HBsAg, Anti-HCV, Anti-HIV), (4) Berikan terapi profilaksis pasca pajanan (Post-Exposure Prophylaxis / PEP) jika terindikasi, dan (5) Pantau tindak lanjut serologis berkala pada bulan ke-3 dan ke-6.'
    ]
];

$payload = [
    'id'         => $article_id,
    'title'      => 'Standar K3 Rumah Sakit Sesuai Permenkes 66/2016 & Sertifikasi Petugas K3RS BNSP',
    'meta_title' => 'Panduan Lengkap Standar K3 Rumah Sakit (Permenkes 66/2016) & Sertifikasi Petugas K3RS BNSP | Wahana Totalita',
    'meta_desc'  => 'Pelajari 10 standar wajib K3 Rumah Sakit sesuai Permenkes 66/2016, matriks bahaya klinis, persiapan akreditasi STARKES Bab MFK, dan uji sertifikasi Petugas K3RS BNSP.',
    'keywords'   => 'k3 rumah sakit, permenkes 66 2016, petugas k3rs bnsp, mfk starkes akreditasi rumah sakit, needle stick injury hse rs, komite k3rs',
    'content'    => $deep_content,
    'faq'        => $faqs
];

$ch = curl_init('https://wahanatotalita.com/api/articles.php');
curl_setopt_array($ch, [
    CURLOPT_CUSTOMREQUEST  => 'PUT',
    CURLOPT_POSTFIELDS     => json_encode($payload, JSON_UNESCAPED_UNICODE),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER     => [
        'Authorization: Bearer ' . $key,
        'Content-Type: application/json',
        'Accept: application/json'
    ],
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_USERAGENT      => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)'
]);
$resp = curl_exec($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "HTTP Code: $code\n";
$data = json_decode($resp, true);
echo "Message: " . ($data['message'] ?? 'No message') . "\n";
echo "Content Length in DB: " . strlen($data['data']['content'] ?? '') . " bytes\n";
echo "Word Count approximately: " . str_word_count(strip_tags($data['data']['content'] ?? '')) . " words\n";
