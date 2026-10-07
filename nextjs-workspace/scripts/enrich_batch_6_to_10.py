"""
scripts/enrich_batch_6_to_10.py
Safely injects authoritative, deep sections into articles 6, 7, 8, 9, 10.
"""
import sys

art6_extra = """
<h2>Matriks 6 Tindakan Berbahaya (Unsafe Acts) Operator Forklift &amp; Mitigasi K3</h2>
<p>Berdasarkan data statistik investigasi kecelakaan kerja Kementerian Ketenagakerjaan RI, lebih dari 85% insiden forklift fatal disebabkan oleh tindakan tidak aman pengemudi. Berikut adalah 6 tindakan berisiko tinggi dan pengendalian wajibnya:</p>

<table>
  <thead>
    <tr>
      <th>Tindakan Tidak Aman (Unsafe Act)</th>
      <th>Potensi Bahaya Fatal</th>
      <th>Standar Operasional Prosedur (SOP) Kemnaker</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>Membawa Beban Terlalu Tinggi Saat Berjalan</strong></td>
      <td>Unit terguling ke samping saat berbelok akibat titik pusat gravitasi naik tinggi.</td>
      <td>Garpu wajib diturunkan hingga berjarak hanya 15–20 cm dari lantai saat unit bergerak.</td>
    </tr>
    <tr>
      <td><strong>Mengemudi Maju Saat Pandangan Terhalang Muatan</strong></td>
      <td>Menabrak pejalan kaki, tiang racking, atau infrastruktur pabrik.</td>
      <td>Jika beban menutupi pandangan depan, operator <strong>WAJIB mengemudikan forklift secara mundur</strong> dengan kepala menoleh ke belakang.</td>
    </tr>
    <tr>
      <td><strong>Menuruni Ramp / Lereng dengan Posisi Maju</strong></td>
      <td>Beban tergelincir jatuh dari garpu dan menimpa area bawah lereng.</td>
      <td>Saat menuruni turunan dengan muatan, forklift <strong>wajib berjalan mundur</strong> agar beban selalu bersandar pada sandaran tiang (backrest).</td>
    </tr>
    <tr>
      <td><strong>Mengangkat Orang Menggunakan Garpu Polos</strong></td>
      <td>Pekerja terpeleset jatuh dari ketinggian tanpa pengaman.</td>
      <td>Dilarang keras menaikkan orang dengan garpu atau palet kayu. Wajib menggunakan <em>Safety Man Basket (Work Platform)</em> resmi berpengunci kancing garpu.</td>
    </tr>
    <tr>
      <td><strong>Menikung Cepat di Persimpangan Blind Spot</strong></td>
      <td>Tabrakan dengan forklift lain atau melindas pejalan kaki di lorong.</td>
      <td>Wajib membunyikan klakson sebelum persimpangan, memperlambat kecepatan maksimal 5 km/jam, dan melihat cermin cembung persimpangan.</td>
    </tr>
    <tr>
      <td><strong>Melompat Keluar Saat Forklift Terguling</strong></td>
      <td>Tertimpa tiang pelindung kabin (Overhead Guard) yang mematahkan leher/tubuh.</td>
      <td>Tetap berada di dalam kabin, pegang erat roda kemudi, tahan kaki pada lantai, dan condongkan badan berlawanan dengan arah jatuhnya unit.</td>
    </tr>
  </tbody>
</table>

<h2>Prosedur Pengisian Baterai Listrik &amp; Pengisian BBM Forklift Sesuai Standar K3</h2>
<p>Area pengisian bahan bakar atau pengisian baterai forklift (Charging Station) menyimpan risiko kebakaran dan ledakan kimia yang signifikan. Operator bersertifikat dilatih mematuhi standar keselamatan berikut:</p>
<ol>
  <li><strong>Ventilasi Khusus Gas Hidrogen:</strong> Saat baterai forklift elektrik (Lead-Acid) diisi ulang, terjadi pelepasan gas hidrogen yang sangat mudah meledak. Ruang charging wajib memiliki ventilasi mekanis keluar (exhaust fan) yang menyala terus-menerus dan bebas dari sumber percikan api atau rokok.</li>
  <li><strong>Penyediaan Sarana Emergency Eye Wash:</strong> Larutan asam sulfat elektrolit baterai sangat korosif. Stasiun pengisian baterai wajib dilengkapi instalasi pencuci mata darurat (emergency eye wash) yang dapat dijangkau dalam tempo &lt; 10 detik.</li>
  <li><strong>Penggunaan APD Kimia Lengkap:</strong> Operator yang mengisi air aki wajib mengenakan kacamata pelindung (chemical splash goggles), sarung tangan karet nitril tebal, dan celemek karet tahan asam (chemical apron).</li>
  <li><strong>Prosedur Pengisian BBM Solar:</strong> Mesin forklift diesel wajib dimatikan penuh, tuas rem parkir diaktifkan, dan alat pemadam api ringan (APAR jenis Powder 6 kg) harus tersedia dalam jarak 3 meter.</li>
</ol>

<h2>Perbedaan Wajib: SIO Operator vs Surat Izin Alat (SIA / Suket Kelaikan Unit)</h2>
<p>Banyak pengelola pabrik menganggap jika operator sudah memiliki SIO, maka forklift otomatis legal beroperasi. Ini adalah kekeliruan fatal. Kementerian Ketenagakerjaan membedakan secara tegas:</p>
<ul>
  <li><strong>SIO (Surat Izin Operator) / Lisensi K3:</strong> Melekat pada <strong>KOMPETENSI PERSONIL MANUSIA</strong> yang mengemudikan alat. Diterbitkan oleh Kemnaker RI setelah personil lulus pelatihan dan ujian. Berlaku 5 tahun.</li>
  <li><strong>SIA (Surat Izin Alat) / Surat Keterangan Kelaikan K3 Unit:</strong> Melekat pada <strong>FISIK MESIN FORKLIFT</strong> bersangkutan. Diterbitkan oleh Dinas Tenaga Kerja Provinsi setelah dilakukan pemeriksaan dan pengujian (Riksa Uji) berkala oleh Perusahaan Jasa K3 (PJK3) Bidang Riksa Uji. Berlaku 1 tahun dan wajib diperpanjang tahunan.</li>
</ul>
"""

art7_extra = """
<h2>Checklist Harian Inspeksi Scaffolding untuk Tim HSE Proyek</h2>
<p>Sebelum mengizinkan pekerja menaiki perancah setiap pagi, tim K3 dan pengawas perancah wajib mengisi lembar inspeksi harian (Daily Scaffold Inspection Checklist):</p>

<table>
  <thead>
    <tr>
      <th>No</th>
      <th>Titik Kritis Pemeriksaan</th>
      <th>Standar Kelayakan K3</th>
      <th>Kondisi (OK / Reject)</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>1</td>
      <td>Bantalan Kayu &amp; Base Plate</td>
      <td>Kayu tidak lapuk, tebal &ge; 38 mm, base plate baja menempel rata tanpa rongga.</td>
      <td>Wajib OK</td>
    </tr>
    <tr>
      <td>2</td>
      <td>Kelurusan Tiang Standard</td>
      <td>Tiang vertikal tegak lurus sempurna, deviasi kemiringan &lt; 1:300 dari total tinggi.</td>
      <td>Wajib OK</td>
    </tr>
    <tr>
      <td>3</td>
      <td>Penguncian Klem (Coupler)</td>
      <td>Klem hidup (swivel) dan klem mati (right-angle) dikencangkan dengan torsi 40–50 Nm.</td>
      <td>Wajib OK</td>
    </tr>
    <tr>
      <td>4</td>
      <td>Lantai Kerja (Planking)</td>
      <td>Papan terpasang rapat tanpa lubang, kedua ujung papan terkunci klem penahan.</td>
      <td>Wajib OK</td>
    </tr>
    <tr>
      <td>5</td>
      <td>Pagar Pengaman Guardrail</td>
      <td>Top rail (1 meter), mid rail (50 cm), dan toeboard (15 cm) terpasang di semua sisi terbuka.</td>
      <td>Wajib OK</td>
    </tr>
    <tr>
      <td>6</td>
      <td>Tangga Akses (Ladder)</td>
      <td>Tangga terikat kokoh pada tiang, kemiringan 4:1 (75 derajat), terpasang bordes istirahat tiap 6 meter.</td>
      <td>Wajib OK</td>
    </tr>
    <tr>
      <td>7</td>
      <td>Ikatan Dinding (Wall Ties)</td>
      <td>Terikat kuat pada kolom beton atau anchor dynabolt gedung setiap 4 meter vertikal.</td>
      <td>Wajib OK</td>
    </tr>
  </tbody>
</table>

<h2>Analisis Kegagalan Struktur: Mengapa Scaffolding Bisa Roboh (Structural Collapse)?</h2>
<p>Investigasi forensik ketenagakerjaan terhadap kasus robohnya perancah di proyek-proyek besar di Indonesia mengidentifikasi 4 faktor penyebab paling dominan:</p>
<ol>
  <li><strong>Kegagalan Daya Dukung Tanah Pondasi (Soil Bearing Failure):</strong> Perancah didirikan di atas tanah timbunan lunak tanpa pemadatan, atau dekat bibir galian drainase terbuka. Saat hujan lebat mengguyur, tanah amblas sehingga salah satu tiang standard kehilangan tumpuan dan memicu keruntuhan domino seluruh struktur.</li>
  <li><strong>Peniadaan Ikatan Dinding (Omission of Wall Ties):</strong> Seringkali pekerja melepas ikatan klem ke dinding gedung demi memudahkan pekerjaan pemasangan fasad kaca atau panel ACP, tanpa memasang ikatan pengganti. Tanpa ikatan dinding, beban terpaan angin lateral akan menggulingkan perancah dengan mudah.</li>
  <li><strong>Beban Berlebih Tak Terkendali (Overloading):</strong> Mengabaikan batas Safe Working Load (SWL). Menumpuk tumpukan bata merah, semen puluhan zak, atau mesin gerinda potong di atas satu bentang lantai kerja yang hanya dirancang untuk tugas ringan (light duty 150 kg/m&sup2;).</li>
  <li><strong>Penggunaan Pipa Karat dan Klem Retak:</strong> Memakai material scaffolding afkiran yang telah berkarat tebal sehingga ketebalan dinding pipa berkurang di bawah 3,2 mm (standar SNI/BS 1139), mengakibatkan tiang mengalami tekuk (buckling) saat menerima beban tekan aksial.</li>
</ol>

<h2>Prosedur Standar Pembongkaran Perancah yang Aman (Scaffold Dismantling)</h2>
<p>Proses pembongkaran scaffolding justru membawa risiko kecelakaan lebih tinggi dibandingkan proses perakitan. Teknisi perancah bersertifikat wajib mengikuti urutan langkah terbalik berikut:</p>
<ul>
  <li>Sterilisasi area bawah perancah: pasang garis pembatas (barricade tape) dan rambu dilarang melintas dalam radius 5 meter di sekeliling struktur.</li>
  <li>Pekerja wajib menerapkan 100% Tie-Off (mengaitkan lanyard harness secara bergantian ke titik angkur mandiri sebelum melangkah).</li>
  <li>Pembongkaran dilakukan <strong>tingkat demi tingkat dari paling atas menuju ke bawah</strong>. Dilarang keras melepas komponen pada tingkat bawah sementara tingkat atas masih terpasang.</li>
  <li><strong>Dilarang Menjatuhkan Material dari Ketinggian:</strong> Seluruh pipa, klem, dan papan lantai wajib diturunkan menggunakan tali tambang (gin wheel / pulley system) atau diserahkan secara estafet tangan.</li>
</ul>
"""

art8_extra = """
<h2>Penyusunan Single Line Diagram &amp; Koordinasi Proteksi untuk Ahli K3 Listrik</h2>
<p>Salah satu kompetensi tingkat lanjut yang diuji pada sertifikasi Ahli K3 Spesialis Listrik adalah kemampuan membaca, mengevaluasi, dan merancang <strong>Diagram Garis Tunggal (Single Line Diagram / SLD)</strong> sistem distribusi tenaga listrik pabrik. SLD yang akurat adalah syarat mutlak audit SMK3 dan investigasi kebakaran.</p>

<p>Ahli K3 Listrik wajib memastikan hal-hal teknis berikut pada SLD:</p>
<ol>
  <li><strong>Kapasitas Pemutus Daya (Breaking Capacity):</strong> Nilai kapasitas pemutusan (kA) dari Air Circuit Breaker (ACB) dan Moulded Case Circuit Breaker (MCCB) pada panel utama (LVMDP) harus lebih besar daripada arus gangguan hubung singkat maksimum (Isc max) yang dapat disuplai oleh transformator PLN atau genset. Jika breaking capacity lebih kecil, pemutus daya akan meledak saat terjadi korsleting.</li>
  <li><strong>Diskriminasi &amp; Selektivitas Proteksi (Protection Coordination):</strong> Jika terjadi korsleting di mesin produksi pada ujung cabang, pemutus daya lokal (branch MCB) harus trip lebih dahulu dalam waktu mili-detik sebelum pemutus daya feeder atau incoming trip, sehingga pemadaman listrik tidak melumpuhkan seluruh pabrik.</li>
  <li><strong>Pemasangan Residual Current Device (RCD / ELCB):</strong> Sesuai PUIL 2011, sirkuit stop kontak yang dapat dijangkau oleh manusia wajib diproteksi dengan gawai arus sisa (RCD) dengan sensitivitas arus bocor maksimal <strong>30 mA</strong> guna memutus tegangan sentuh sebelum mematikan jantung manusia.</li>
</ol>

<h2>Matriks Klasifikasi Area Berbahaya Kebakaran &amp; Ledakan (Hazardous Area Classification)</h2>
<p>Di industri petrokimia, pabrik cat, depo migas, dan pengolahan tepung, uap dan debu mudah terbakar dapat meledak seketika dipicu oleh percikan api saklar listrik biasa. Ahli K3 Listrik wajib memahami zonasi bahaya sesuai standar IEC 60079 dan PUIL:</p>

<table>
  <thead>
    <tr>
      <th>Klasifikasi Zona Bahaya</th>
      <th>Frekuensi Kehadiran Gas / Debu Mudah Terbakar</th>
      <th>Spesifikasi Peralatan Listrik yang Wajib Digunakan</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>Zone 0 (Gas) / Zone 20 (Debu)</strong></td>
      <td>Atmosfer bahan peledak hadir secara <strong>terus-menerus atau dalam jangka waktu lama</strong> (misal: di dalam tangki bahan bakar).</td>
      <td>Hanya peralatan bervalidasi <em>Intrinsically Safe Ex 'ia'</em> dengan batasan energi listrik ekstra rendah tanpa potensi percikan apa pun.</td>
    </tr>
    <tr>
      <td><strong>Zone 1 (Gas) / Zone 21 (Debu)</strong></td>
      <td>Atmosfer bahan peledak kemungkinan besar <strong>dapat terjadi dalam operasi normal</strong> (misal: area ventilasi pengisian drum pelarut).</td>
      <td>Peralatan berpelindung ledakan Flameproof / Explosion-Proof (Ex 'd'), Peningkatan Keamanan (Ex 'e'), atau Enkapsulasi (Ex 'm').</td>
    </tr>
    <tr>
      <td><strong>Zone 2 (Gas) / Zone 22 (Debu)</strong></td>
      <td>Atmosfer bahan peledak <strong>tidak mungkin terjadi dalam operasi normal</strong>, dan jika terjadi hanya berlangsung sangat singkat akibat kebocoran tak sengaja.</td>
      <td>Peralatan berstandar non-sparking (Ex 'n') atau peralatan industri bersegel rapat IP65 dengan sertifikasi ATEX.</td>
    </tr>
  </tbody>
</table>

<h2>Checklist Audit Riksa Uji Instalasi Penyalur Petir &amp; Pembumian</h2>
<p>Berdasarkan Permenaker No. 02/MEN/1989 tentang Pengawasan Instalasi Penyalur Petir, pengujian berkala mencakup:</p>
<ul>
  <li>Pemeriksaan fisik runcingan tombak penangkap petir (air termination) dari korosi dan oksidasi.</li>
  <li>Pemeriksaan sambungan klem uji (test joint) pada ketinggian 1,5–2 meter dari permukaan tanah.</li>
  <li>Pengujian kontinuitas konduktor penyalur petir menggunakan Ohmmeter akurat.</li>
  <li>Pengukuran resistansi tahanan sebaran tanah menggunakan <em>Digital Earth Tester 3 Kutub</em> (Metode Jatuh Potensial / Fall of Potential Method) dengan menancapkan elektroda bantu pada jarak 5 dan 10 meter. Nilai wajib &le; 5 Ohm.</li>
</ul>
"""

art9_extra = """
<h2>Prosedur Spading &amp; Blinding Pipa (Positive Isolation) pada Ruang Terbatas</h2>
<p>Salah satu penyebab paling sering terjadinya kecelakaan maut di ruang terbatas industri proses kimia adalah <strong>kebocoran katup pipa (leaking valve)</strong>. Seringkali tim pemeliharaan mengira menutup katup kran (closed valve) sudah cukup aman. Namun, tekanan fluida dapat merembes melewati dudukan valve yang aus dan membanjiri tangki dengan cairan beracun saat pekerja berada di dalam.</p>

<p>Standar K3 Kemnaker RI mewajibkan penerapan <strong>Isolasi Positif (Positive Isolation)</strong> melalui pemasangan pelat buta (Blind Flange / Spade):</p>
<ol>
  <li><strong>Pelepasan Baut Flensa Pipa:</strong> Baut sambungan flensa pipa dilepas secara hati-hati dengan mengenakan APD pelindung cipratan bahan kimia.</li>
  <li><strong>Penyisipan Pelat Buta Baja (Spade Insertion):</strong> Menyisipkan pelat baja padat berketebalan terukur yang dirancang menahan tekanan kerja pipa penuh ke dalam celah flensa, diapit oleh dua paking gasket baru.</li>
  <li><strong>Pengencangan Baut &amp; Pemasangan Tag Bahaya:</strong> Baut flensa dikencangkan kembali dan digantungkan kartu tag peringatan bahwa pipa telah di-blind untuk pekerjaan confined space.</li>
  <li><strong>Metode Double Block and Bleed (DBB):</strong> Jika pemasangan spade tidak memungkinkan, wajib menggunakan sistem dua katup tertutup berurutan dengan satu katup pembuang (bleed valve) terbuka di antara keduanya untuk memantau rembesan.</li>
</ol>

<h2>Protokol Penyelamatan Darurat Tanpa Memasuki Ruangan (Non-Entry Rescue)</h2>
<p>Lebih dari 60% korban tewas dalam insiden confined space adalah para penolong yang bertindak impulsif. Oleh karena itu, prosedur <em>Non-Entry Rescue</em> adalah protokol lini pertama yang wajib dikuasai Petugas Madya:</p>

<table>
  <thead>
    <tr>
      <th>Langkah Penyelamatan</th>
      <th>Uraian Tindakan Kritis Petugas Madya &amp; Tim Safety</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>1. Aktivasi Alarm Darurat</strong></td>
      <td>Segera tekan tombol alarm darurat atau hubungi radio kontrol tanggap darurat perusahaan untuk memobilisasi regu penyelamat terlatih.</td>
    </tr>
    <tr>
      <td><strong>2. Evaluasi Kondisi Visual</strong></td>
      <td>Amati posisi korban melalui lubang manhole tanpa memasukkan kepala melewati bibir manhole sama sekali.</td>
    </tr>
    <tr>
      <td><strong>3. Putar Katrol Tripod Penyelamat (Rescue Winch)</strong></td>
      <td>Karena korban telah terhubung ke tali harness sejak awal masuk, segera pasang tuas katrol winch tripod dan putar untuk mengangkat korban keluar secara mekanis.</td>
    </tr>
    <tr>
      <td><strong>4. Bantuan Pernapasan &amp; Pertolongan Pertama (P3K)</strong></td>
      <td>Begitu korban berhasil ditarik keluar ke udara bebas, periksa nadi dan pernapasan (ABC P3K). Jika korban henti napas, pasangkan tabung oksigen murni (Resuscitator) dan lakukan kompresi dada CPR.</td>
    </tr>
  </tbody>
</table>

<h2>Checklist Pra-Masuk Ruang Terbatas (Pre-Entry Verification)</h2>
<p>Sebelum mengizinkan pekerja pertama melangkahkan kaki ke dalam lubang manhole, supervisor K3 wajib memverifikasi checklist berikut:</p>
<ul>
  <li>Surat Izin Masuk Ruang Terbatas (Entry Permit) telah ditandatangani oleh Manajer Fasilitas / HSE Head.</li>
  <li>Hasil uji gas detector menunjukkan: Oksigen 20.9%, H2S 0 ppm, CO 0 ppm, LEL 0%. Hasil dicatat pada papan kontrol pintu masuk.</li>
  <li>Blower ventilasi mekanis telah dihidupkan minimal 15 menit sebelum masuk dan diarahkan ke bagian terdalam tangki.</li>
  <li>Tripod, katrol penyelamat (winch), tali tambat, dan full body harness dalam kondisi terinspeksi tanpa cacat.</li>
  <li>Tersedia minimal 2 tabung SCBA (Self-Contained Breathing Apparatus) cadangan di dekat lokasi kerja untuk antisipasi tim rescue.</li>
</ul>
"""

art10_extra = """
<h2>Kriteria Afkir &amp; Masa Pakai Webbing Full Body Harness Sesuai Standar K3</h2>
<p>Alat Pelindung Jatuh Personal (Full Body Harness) adalah sabuk pengaman terakhir antara hidup dan mati pekerja ketinggian. Seringkali di proyek konstruksi ditemukan pekerja memakai harness yang sudah getas, terkena percikan las, atau berjamur. Instruktur Wahana Totalita mengajarkan <strong>Kriteria Afkir (Discard Criteria)</strong> harness:</p>
<ol>
  <li><strong>Batas Usia Pakai Maksimum:</strong> Mengacu pada standar pabrikan internasional (EN/ANSI/OSHA), usia pakai tali webbing sintetis (poliester/poliamida) adalah <strong>maksimal 5 tahun sejak tanggal produksi</strong>, terlepas dari apakah harness tersebut sering dipakai atau jarang dipakai, karena degradasi polimer terjadi secara alami akibat paparan oksigen dan suhu.</li>
  <li><strong>Pernah Mengalami Beban Jatuh (Impact Load):</strong> Setiap body harness atau lanyard absorber yang pernah menahan tubuh pekerja saat insiden jatuh terjadi <strong>WAJIB SEGERA DIMUSNAHKAN DAN DIGUNTING</strong> agar tidak dipakai kembali. Struktur serat benang internal telah meregang dan kehilangan elastisitasnya.</li>
  <li><strong>Kerusakan Fisik Serat Webbing:</strong> Terdapat serat benang yang terpotong, robek tepi lebih dari 1 mm, benang jahitan penahan beban (stitching) terurai, terbakar percikan gerinda las, atau terpapar asam/basa kimia yang membuat tali mengeras kaku.</li>
  <li><strong>Deformasi Cincin Logam (D-Ring &amp; Buckle):</strong> Cincin baja D-Ring bengkok, retak rambut, korosi berkarat dalam, atau lidah pengunci gesper (buckle) tidak mengancing otomatis dengan sempurna.</li>
</ol>

<h2>Protokol Evakuasi Korban Tergantung (Suspension Trauma Rescue Protocol)</h2>
<p>Bila terjadi insiden pekerja jatuh dan tertahan oleh tali harness di udara bebas, hitungan menit sangat menentukan keselamatan nyawanya. Waktu maksimal penyelamatan adalah <strong>kurang dari 10 menit</strong>:</p>

<table>
  <thead>
    <tr>
      <th>Menit Pasca Jatuh</th>
      <th>Kondisi Medis Tubuh Korban Tergantung</th>
      <th>Tindakan Evakuasi Vertical Rescue</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>Menit 0 – 3</strong></td>
      <td>Korban sadar, panik, merasakan nyeri hebat pada pangkal paha akibat tekanan tali harness.</td>
      <td>Instruksikan korban untuk memasang tali pijakan kaki (Suspension Relief Strap) dan mengayunkan kaki seperti mengayuh sepeda guna memompa sirkulasi darah vena.</td>
    </tr>
    <tr>
      <td><strong>Menit 3 – 5</strong></td>
      <td>Volume darah yang tertahan di tungkai bawah mencapai 20–30%, suplai oksigen ke otak menurun drastis, korban mulai pusing dan keringat dingin.</td>
      <td>Tim TKPK 3 meluncurkan sistem tali penyelamatan (Rescue Hauling / Lowering Kit) menuju titik posisi korban tergantung.</td>
    </tr>
    <tr>
      <td><strong>Menit 5 – 10</strong></td>
      <td>Korban jatuh pingsan (hilang kesadaran). Risiko henti jantung dan kerusakan otak permanen dimulai.</td>
      <td>Rescuer mengaitkan tali korban ke perangkat descender evakuasi, memotong lanyard korban yang tersangkut, dan menurunkan korban ke permukaan lantai.</td>
    </tr>
    <tr>
      <td><strong>Pasca Evakuasi (PENTING!)</strong></td>
      <td><strong>DILARANG LANGSUNG MEMBARINGKAN KORBAN SECARA TERLENTANG!</strong></td>
      <td>Darah kotor bervolume besar yang terperangkap di kaki akan mengalir serentak ke jantung (Reflow Syndrome / Cardiac Arrest). Posisikan korban dalam posisi setengah duduk (Semi-Fowler) selama 30 menit sambil diberi oksigen.</td>
    </tr>
  </tbody>
</table>

<h2>Perancangan Sistem Jalur Tali Pengaman Horisontal (Horizontal Lifeline)</h2>
<p>Bagi personil TKBT Tingkat I dan TKPK Tingkat 2, perancangan jalur lifeline baja (Wire Rope Lifeline) di atap pabrik wajib memperhitungkan gaya defleksi dinamis. Tali kawat baja berdiameter minimal 8–10 mm wajib dipasang dengan span maksimal 15 meter antar bracket penyangga, dilengkapi perangkat peredam kejut inline absorber (Line Shock Absorber) untuk membatasi beban tarikan pada struktur atap saat menahan jatuh simultan 2 orang pekerja.</p>
"""

with open('scripts/deep_rewrite_batch_6_to_10.py', 'r', encoding='utf-8') as f:
    code = f.read()

code = code.replace('art6_content = """', 'art6_content = """\n' + art6_extra)
code = code.replace('art7_content = """', 'art7_content = """\n' + art7_extra)
code = code.replace('art8_content = """', 'art8_content = """\n' + art8_extra)
code = code.replace('art9_content = """', 'art9_content = """\n' + art9_extra)
code = code.replace('art10_content = """', 'art10_content = """\n' + art10_extra)

with open('scripts/deep_rewrite_batch_6_to_10.py', 'w', encoding='utf-8') as f:
    f.write(code)

print("Enrichment for batch 6 to 10 injected successfully!")
