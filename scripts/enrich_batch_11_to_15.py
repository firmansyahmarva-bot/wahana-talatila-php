"""
scripts/enrich_batch_11_to_15.py
Safely injects authoritative, deep sections into articles 11, 12, 13, 14, 15.
"""
import sys

art11_extra = """
<h2>Struktur Organisasi Tanggap Darurat Kebakaran (Fire Emergency Organization)</h2>
<p>Dalam implementasi Kepmenaker 186/1999, perusahaan wajib membentuk bagan struktur organisasi Tim Tanggap Darurat Kebakaran (Emergency Response Team / ERT) yang memiliki rantai komando (Chain of Command) yang jelas saat sirine evakuasi berbunyi:</p>

<table>
  <thead>
    <tr>
      <th>Posisi Jabatan ERT</th>
      <th>Kualifikasi Kompetensi</th>
      <th>Tindakan Operasional Saat Terjadi Kebakaran</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>Ketua Tim ERT (Emergency Commander)</strong></td>
      <td>Direktur Operasional / Plant Manager didampingi Ahli K3 Kebakaran (Kelas A)</td>
      <td>Memegang komando tertinggi di Pusat Komando Krisis (Emergency Command Center), memutuskan evakuasi total gedung, dan berkomunikasi dengan Dinas Damkar Kota.</td>
    </tr>
    <tr>
      <td><strong>Komandan Regu Pemadam (Fire Chief)</strong></td>
      <td>Koordinator Damkar Kelas B Kemnaker</td>
      <td>Memimpin langsung pergerakan regu pemadam di zona kebakaran (Hot Zone), menentukan taktik pemadaman, dan membagi tugas personil regu.</td>
    </tr>
    <tr>
      <td><strong>Regu Pemadam Inti (Fire Fighting Unit)</strong></td>
      <td>Regu Penanggulangan Kebakaran Kelas C</td>
      <td>Mengenakan pakaian tahan panas dan SCBA, menyambungkan selang hidran ke pilar, mendobrak pintu ruangan, dan memadamkan sumber api secara ofensif.</td>
    </tr>
    <tr>
      <td><strong>Regu Evakuasi &amp; Pemandu Lantai (Floor Warden)</strong></td>
      <td>Petugas Peran Kebakaran Kelas D</td>
      <td>Menyisir setiap ruangan lantai, memastikan tidak ada orang tertinggal di toilet/kamar, memandu massa menuju tangga darurat dengan tenang tanpa dorong-dorongan.</td>
    </tr>
    <tr>
      <td><strong>Regu Pertolongan Pertama (P3K / Medical Rescue)</strong></td>
      <td>Petugas P3K Berlisensi Kemnaker</td>
      <td>Mendirikan posko medis darurat di area aman (Assembly Point), memberikan oksigen pada korban sesak napas (smoke inhalation), dan merawat luka bakar.</td>
    </tr>
    <tr>
      <td><strong>Regu Pengamanan &amp; Utilitas (Security &amp; Utility)</strong></td>
      <td>Teknisi K3 Listrik &amp; Tim Keamanan</td>
      <td>Mematikan aliran listrik utama gedung (LVMDP), mematikan katup pipa gas elpiji/amonia, mengamankan pintu gerbang masuk untuk armada Damkar dinas kota.</td>
    </tr>
  </tbody>
</table>

<h2>Matriks Pemeliharaan &amp; Riksa Uji Sarana Proteksi Kebakaran Gedung</h2>
<p>Kesiapan sarana pemadam api sangat bergantung pada kedisiplinan pemeliharaan berkala. Ahli K3 Kebakaran wajib menyusun jadwal audit proteksi berikut:</p>
<ol>
  <li><strong>Pemeriksaan Harian / Mingguan:</strong> Memastikan jalur menuju kotak hidran dan tabung APAR tidak terhalang tumpukan barang atau palet barang (Clear Access). Menghidupkan pompa jockey (Jockey Pump) otomatis untuk mengecek stabilitas tekanan pipa hidran.</li>
  <li><strong>Pemeriksaan Bulanan:</strong> Memeriksa segel fisik APAR, menimbang berat tabung CO2 (jika berkurang &gt; 10% wajib diisi ulang), membalik tabung dry chemical powder agar bubuk tidak menggumpal padat, dan menguji fungsi tombol darurat manual call point (break glass).</li>
  <li><strong>Pemeriksaan Enam Bulanan:</strong> Uji semprot air nozzle hidran terjauh, pengujian aktivasi smoke detector menggunakan aerosol gas tester, dan uji transfer otomatis genset darurat saat simulasi pemadaman listrik.</li>
  <li><strong>Pemeriksaan &amp; Pengujian Tahunan (Riksa Uji Resmi Kemnaker):</strong> Uji hidrostatis (Hydrostatic Test) tabung pemadam dan pipa instalasi hydrant oleh Pengawas Spesialis K3 Penanggulangan Kebakaran Kemnaker RI untuk memperpanjang Surat Pengesahan Pemakaian Instalasi Kebakaran.</li>
</ol>

<h2>Studi Kasus: Proteksi Kebakaran Ruang Server Data Center dengan Clean Agent</h2>
<p>Sebuah bank swasta nasional memasang tabung APAR serbuk kimia (Dry Chemical Powder) di dalam ruang server komputer utama mereka. Ketika terjadi korsleting kecil pada rak server, petugas menyemprotkan bubuk kimia tersebut. Meskipun api padam, residu serbuk kimia yang bersifat korosif dan abrasif meresap ke dalam motherboard ribuan server, menyebabkan kerusakan total pada infrastruktur TI bank tersebut dengan kerugian puluhan miliar rupiah.</p>
<p>Kasus ini menjadi pembelajaran berharga bagi peserta Damkar di Wahana Totalita Konsultan: ruang berharga tinggi (Server, Laboratorium, Arsip Kertas) <strong>DILARANG menggunakan media pemadam serbuk atau air</strong>. Ruang server wajib diproteksi dengan sistem <em>Clean Agent Gas Total Flooding</em> (seperti FM-200 / HFC-227ea atau Novec 1230 / FK-5-1-12) yang memadamkan api dengan memutus reaksi rantai kimia dalam tempo &lt; 10 detik tanpa meninggalkan residu sedikit pun dan aman bagi pernapasan manusia.</p>
"""

art12_extra = """
<h2>Tata Cara Penyusunan Dokumen Rincian Teknis TPS Limbah B3</h2>
<p>Pasca berlakunya UU Cipta Kerja dan PP 22/2021, Izin TPS Limbah B3 tidak lagi berdiri sendiri, melainkan diintegrasikan ke dalam <strong>Persetujuan Lingkungan (Amdal atau UKL-UPL)</strong> dalam bentuk dokumen <em>Rincian Teknis Penyimpanan Limbah B3 (Rintek TPS LB3)</em>. Seorang PPLB3 bertanggung jawab menyusun dokumen ini dengan kelengkapan teknis:</p>
<ol>
  <li><strong>Identitas Sumber &amp; Kode Limbah:</strong> Memetakan seluruh limbah B3 yang dihasilkan dari proses produksi (contoh: oli bekas kode B105d, aki bekas B102d, majun bekas terkontaminasi B110d, sludge IPAL B351-1, kemasan bekas B3 B104d).</li>
  <li><strong>Spesifikasi Desain TPS:</strong> Gambar layout tata letak TPS, gambar denah tampak depan/samping, perhitungan kapasitas tampung total vs volume timbulan bulanan, rancangan saluran drainase tumpahan dan bak pengumpul (sump pit).</li>
  <li><strong>Sistem Ventilasi &amp; Penerangan:</strong> Perhitungan bukaan sirkulasi udara alami atau pemasangan exhaust fan explosion-proof untuk mencegah akumulasi uap solvent beracun.</li>
  <li><strong>Prosedur Standar Operasional (SOP):</strong> Meliputi SOP penyimpanan dan pengemasan, SOP inspeksi mingguan, SOP tanggap darurat tumpahan, dan SOP alur penyerahan ke transporter berizin.</li>
</ol>

<h2>Matriks Kompatibilitas Penyimpanan Limbah B3 di Dalam TPS</h2>
<p>Kesalahan paling berbahaya di dalam TPS Limbah B3 adalah menempatkan dua jenis limbah berbeda sifat secara berdekatan. Jika terjadi kebocoran drum secara simultan, percampuran kimia dapat memicu ledakan atau gas beracun mematikan:</p>

<table>
  <thead>
    <tr>
      <th>Karakteristik Limbah B3</th>
      <th>Zat yang TIDAK Boleh Disimpan Bersebelahan</th>
      <th>Potensi Reaksi Katastropik</th>
      <th>Syarat Pemisahan Fisik Wajib</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>Limbah Mudah Menyala (Flammable)</strong></td>
      <td>Bahan Pengoksidasi Kuat (Oxidizer seperti Hidrogen Peroksida, Asam Nitrat)</td>
      <td>Memicu kebakaran spontan dan ledakan hebat tanpa sumber pemantik.</td>
      <td>Wajib dipisahkan oleh dinding pembatas tahan api (Firewall) minimal 2 jam atau jarak fisik minimal 10 meter.</td>
    </tr>
    <tr>
      <td><strong>Limbah Asam Kuat (Corrosive Acid pH &lt; 2)</strong></td>
      <td>Limbah Sianida atau Sulfida</td>
      <td>Pencampuran asam dengan sianida seketika melepaskan gas hidrogen sianida (HCN) yang mematikan dalam satu tarikan napas.</td>
      <td>Wajib diletakkan di tanggul penampung (bund wall) terpisah tanpa saluran drainase yang bersatu.</td>
    </tr>
    <tr>
      <td><strong>Limbah Asam Kuat</strong></td>
      <td>Limbah Basa Kuat (Corrosive Base pH &gt; 12)</td>
      <td>Reaksi netralisasi eksotermik dahsyat yang mendidihkan cairan dan menyemburkan asam panas ke udara.</td>
      <td>Penyimpanan wajib menggunakan bak penampung sekunder (secondary containment pallet) mandiri.</td>
    </tr>
  </tbody>
</table>

<h2>Integrasi Manifest Elektronik (Festronik) di Portal SIMPEL KLHK</h2>
<p>Pemerintah Indonesia telah menghapus lembar manifest fisik kertas 7 rangkap dan menggantikannya dengan sistem <strong>Festronik (Manifest Elektronik)</strong> yang terintegrasi di portal SIMPEL KLHK. Seorang personil PPLB3 wajib menguasai alur 4 tahap Festronik:</p>
<ul>
  <li><strong>Tahap 1 - Pembuatan Draft Manifest oleh Penghasil:</strong> Menginput data jenis limbah, kode limbah, jumlah berat timbangan aktual (kg/ton), dan nomor kendaraan transporter berizin.</li>
  <li><strong>Tahap 2 - Validasi Pengangkutan (Transporter Approval):</strong> Pengemudi transporter memverifikasi fisik muatan dan menandatangani secara digital saat armada berangkat dari gerbang pabrik.</li>
  <li><strong>Tahap 3 - Penerimaan oleh Pemanfaat / Pengolah (Receiver Approval):</strong> Perusahaan pengolah akhir menimbang kembali muatan dan mengonfirmasi penerimaan di portal.</li>
  <li><strong>Tahap 4 - Penutupan Manifest &amp; Arsip Legalitas:</strong> Manifest resmi tertutup (Closed Status) menjadi bukti sah bagi KLHK bahwa limbah B3 telah dimusnahkan secara legal tanpa ada kebocoran di perjalanan.</li>
</ul>
"""

art13_extra = """
<h2>Perancangan &amp; Troubleshooting IPAL Biologis: Sistem Lumpur Aktif vs MBBR</h2>
<p>Bagi personil Penanggung Jawab Pengendalian Pencemaran Air (PPPA), memahami dinamika biologis mikroorganisme di dalam bak aerasi adalah kompetensi inti untuk menjaga baku mutu air limbah efluen. Dua teknologi paling populer yang diajarkan di Wahana Totalita adalah:</p>
<ol>
  <li><strong>Sistem Lumpur Aktif Konvensional (Activated Sludge Process):</strong> Mengandalkan biomassa tersuspensi mikroba aerob (bakteri pengurai) untuk memangsa bahan organik karbon (BOD/COD). PPPA wajib mengontrol rasio makanan terhadap mikroorganisme (Food to Mass ratio / F/M ratio berkisar 0,2–0,5 kg BOD/kg MLSS.hari), menjaga kadar oksigen terlarut (Dissolved Oxygen / DO minimal 2,0 mg/L), dan mengontrol indeks volume lumpur (Sludge Volume Index / SVI di bawah 150 mL/g agar tidak terjadi lumpur mengapung / Sludge Bulking).</li>
  <li><strong>Moving Bed Biofilm Reactor (MBBR):</strong> Memanfaatkan media pembawa plastik terapung (bio-carrier media) berdensitas tinggi di dalam kolam aerasi sebagai tempat melekatnya koloni biofilm bakteri. Sistem MBBR memiliki keunggulan tahan terhadap beban kejut hidrolik dan konsentrasi COD tinggi, sehingga sangat ideal untuk industri tekstil dan farmasi yang memiliki lahan terbatas.</li>
</ol>

<h2>Prosedur Pengambilan Sampel Air Limbah Sesuai SNI 6989.59:2008</h2>
<p>Salah satu bukti portofolio wajib uji asesmen PPPA BNSP adalah penguasaan teknik sampling air limbah yang sah di mata hukum laboratorium penguji:</p>

<table>
  <thead>
    <tr>
      <th>Tahapan Sampling</th>
      <th>Standar Prosedur Operasional SNI</th>
      <th>Potensi Kesalahan yang Menggugurkan Hasil Uji</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>Titik Lokasi Sampling</strong></td>
      <td>Diambil tepat pada titik penaatan (Outlet Titik Pelepasan Akhir) sebelum air menyatu dengan saluran umum.</td>
      <td>Mengambil sampel di kolam penampungan tengah atau melakukan pengenceran dengan air kran (pelanggaran pidana lingkungan).</td>
    </tr>
    <tr>
      <td><strong>Wadah &amp; Botol Sampel</strong></td>
      <td>Botol kaca gelap untuk uji minyak lemak dan pestisida; botol polietilen (HDPE) bersih untuk uji logam berat dan BOD/COD.</td>
      <td>Menggunakan botol air mineral bekas yang masih mengandung residu organik minuman.</td>
    </tr>
    <tr>
      <td><strong>Pengawetan Sampel (Preservation)</strong></td>
      <td>Sampel logam berat diawetkan dengan asam nitrat (HNO3) pekat hingga pH &lt; 2; sampel COD diawetkan dengan asam sulfat (H2SO4) pekat hingga pH &lt; 2.</td>
      <td>Membiarkan sampel tanpa bahan pengawet pada suhu ruang sehingga mikroba mengurai parameter sebelum dianalisis di lab.</td>
    </tr>
    <tr>
      <td><strong>Penyimpanan Dingin (Ice Box)</strong></td>
      <td>Sampel segera disimpan di dalam cool box bersuhu 4&deg;C (&plusmn; 2&deg;C) dan dikirim ke laboratorium KAN dalam kurun waktu &lt; 24 jam.</td>
      <td>Paparan sinar matahari langsung yang menaikkan suhu sampel dan memicu penguapan gas terlarut.</td>
    </tr>
  </tbody>
</table>

<h2>Perhitungan Beban Emisi Cerobong &amp; Pengambilan Sampel Isokinetik untuk PPPU</h2>
<p>Bagi Penanggung Jawab Pengendalian Pencemaran Udara (PPPU), pelaporan neraca beban emisi tahunan memerlukan rumus kalkulasi ilmiah:</p>
<p style="text-align:center; font-weight:bold; font-size:1.05em; background:#f8fafc; padding:12px; border-left:4px solid #0284c7; border-radius:6px;">
Beban Emisi (kg/tahun) = Konsentrasi Polutan Terukur (mg/Nm&sup3;) &times; Laju Alir Gas Buang Cerobong (Nm&sup3;/detik) &times; Jam Operasional Tahunan (jam) &times; 0,0036
</p>
<p>Selain itu, PPPU wajib memastikan lubang sampling (Sampling Port) cerobong pabrik memenuhi kaidah <strong>8D dan 2D</strong> (jarak minimal 8 kali diameter cerobong dari gangguan aliran bawah seperti elbow/blower, dan minimal 2 kali diameter dari puncak cerobong atas) agar pengambilan sampel debu partikulat memenuhi kaidah <em>Sampling Isokinetik</em> sesuai SNI 7117.17:2009.</p>
"""

art14_extra = """
<h2>Format Standar Perumusan Temuan Audit ISO 45001: PLOR Formula</h2>
<p>Dalam kurikulum pembinaan Lead Auditor berstandar IRCA di Wahana Totalita Konsultan, peserta dilatih secara intensif untuk merumuskan temuan audit secara profesional menggunakan kaidah <strong>PLOR (Problem, Location, Objective Evidence, Reference)</strong>:</p>

<table>
  <thead>
    <tr>
      <th>Komponen PLOR</th>
      <th>Definisi Baku</th>
      <th>Contoh Penerapan Nyata dalam Lembar Temuan Audit</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>P - Problem (Masalah)</strong></td>
      <td>Pernyataan jelas mengenai kegagalan sistem yang ditemukan tanpa menyalahkan individu.</td>
      <td>Sistem identifikasi bahaya dan pengendalian risiko tidak mencakup seluruh aktivitas pemeliharaan mesin non-rutin.</td>
    </tr>
    <tr>
      <td><strong>L - Location (Lokasi)</strong></td>
      <td>Tempat spesifik, departemen, atau lini produksi tempat temuan diverifikasi.</td>
      <td>Di Lini Perakitan 2, Departemen Stamping &amp; Pressing PT ABC.</td>
    </tr>
    <tr>
      <td><strong>O - Objective Evidence (Bukti Objektif)</strong></td>
      <td>Fakta riil yang dilihat, didengar, atau diverifikasi langsung melalui dokumen/data.</td>
      <td>Ditemukan 2 teknisi sedang melakukan perbaikan hidrolik mesin press tanpa dokumen Job Safety Analysis (JSA) dan tanpa menerapkan gembok LOTO pada panel pemutus daya no. SW-04.</td>
    </tr>
    <tr>
      <td><strong>R - Reference (Dasar Acuan)</strong></td>
      <td>Klausul dan sub-klausul spesifik ISO 45001:2018 yang dilanggar.</td>
      <td>Bertentangan dengan persyaratan <strong>ISO 45001:2018 Klausul 8.1.2 (Menghilangkan bahaya dan mengurangi risiko K3)</strong> dan SOP Internal no. SOP-HSE-012 Rev.03.</td>
    </tr>
  </tbody>
</table>

<h2>Teknik Menghadapi Auditee Sulit &amp; Situasi Konflik dalam Audit</h2>
<p>Seorang Lead Auditor tidak hanya diuji penguasaan dokumennya, melainkan juga kecerdasan emosional dan psikologi komunikasi. Berikut taktik menghadapi skenario sulit:</p>
<ol>
  <li><strong>Auditee yang Bersikap Defensif atau Agresif:</strong> Bila auditee membantah temuan secara emosional, auditor wajib tetap tenang, tidak terpancing debat kusir, dan mengulang kembali bukti objektif yang dicatat secara faktual: <em>"Kami mengerti penjelasan Bapak, namun bukti fisik yang kami verifikasi di lapangan menunjukkan SOP belum diterapkan secara konsisten. Mari kita fokus pada bagaimana sistem ini dapat diperbaiki bersama."</em></li>
  <li><strong>Auditee yang Menolak Memberikan Dokumen:</strong> Jika auditee menolak menunjukkan rekam jejak pelatihan atau hasil MCU pekerja dengan dalih rahasia perusahaan, Lead Auditor menjelaskan bahwa audit dilindungi oleh kesepakatan kerahasiaan (Non-Disclosure Agreement / NDA), dan ketiadaan bukti akan dicatat sebagai ketidakmampuan membuktikan kesesuaian klausul terkait.</li>
  <li><strong>Upaya Penyuapan atau Gratifikasi:</strong> Menolak secara tegas dan santun setiap pemberian hadiah mewah atau fasilitas di luar jadwal audit, demi menjaga independensi dan integritas kode etik profesional auditor IRCA.</li>
</ol>

<h2>Jenjang Karir Registrasi Auditor di CQI | IRCA Global</h2>
<p>Setelah menuntaskan pelatihan dan lulus ujian tertulis di Wahana Totalita, peserta berhak mendaftarkan profil profesionalnya ke portal registrasi CQI | IRCA dengan 4 tingkatan jenjang:</p>
<ul>
  <li><strong>Provisional Auditor:</strong> Lulusan baru kursus Lead Auditor yang belum memiliki pengalaman audit mandiri di lapangan.</li>
  <li><strong>Auditor:</strong> Telah menyelesaikan minimal 4 kali audit pihak ketiga (minimal 20 hari kerja audit) di bawah supervisi Lead Auditor berpengalaman.</li>
  <li><strong>Lead Auditor:</strong> Telah memimpin tim audit minimal 3 kali audit penuh sebagai ketua tim dan memenuhi jam terbang audit yang dipersyaratkan.</li>
  <li><strong>Principal Auditor:</strong> Jenjang pakar tertinggi yang diakui sebagai rujukan ahli dalam sengketa audit internasional dan perumus kebijakan sistem manajemen dunia.</li>
</ul>
"""

art15_extra = """
<h2>Struktur Standar Penyusunan Project Specific HSE Plan untuk Tender</h2>
<p>Dalam tahap seleksi tender (Tender Award), kontraktor yang lolos prakualifikasi CSMS diwajibkan menyusun <strong>Rencana K3LL Khusus Proyek (Project Specific HSE Plan)</strong> yang disesuaikan persis dengan lokasi dan lingkup kerja klien. HSE Plan yang memenangkan nilai tertinggi wajib memuat 7 bab utama:</p>
<ol>
  <li><strong>Bab 1 - Gambaran Umum Proyek &amp; Sasaran K3LL (HSE Targets):</strong> Memuat komitmen Zero Fatality, Target Jam Kerja Selamat (misal: 500.000 Safe Manhours), target induksi K3 100% pekerja baru, dan target frekuensi inspeksi mingguan.</li>
  <li><strong>Bab 2 - Struktur Organisasi K3LL Lapangan (Project HSE Organization):</strong> Bagan rantai komando K3 di lokasi proyek, menempatkan Project HSE Manager berkoordinasi langsung dengan Project Manager dan Project Director client.</li>
  <li><strong>Bab 3 - Analisis Risiko &amp; Mitigasi Spesifik Lokasi:</strong> Matriks HIRADC untuk pekerjaan kritis proyek (contoh: penggalian tanah basah, erection girder jembatan dengan mobile crane kapasitas 100 Ton, instalasi pipa migas bertekanan tinggi).</li>
  <li><strong>Bab 4 - Standar Pengendalian Operasional (Operational Safety Controls):</strong> SOP Izin Kerja Selamat (Permit to Work System), SOP Pengangkatan Kritis (Critical Lifting Plan), SOP Pengendalian Bahan Kimia, dan spesifikasi APD standar SNI/ANSI yang dibagikan cuma-cuma kepada seluruh pekerja.</li>
  <li><strong>Bab 5 - Program Kesehatan Kerja &amp; Industrial Hygiene:</strong> Syarat Medical Check-Up (MCU) Fit to Work seluruh kru sebelum mobilisasi, program pemantauan kebisingan, dan penyediaan klinik P3K lapangan lengkap dengan paramedis bersertifikat.</li>
  <li><strong>Bab 6 - Rencana Tanggap Darurat &amp; Evakuasi Medis (ERP &amp; MEDEVAC):</strong> Peta jalur evakuasi proyek, lokasi titik kumpul aman (Assembly Point), nomor telepon darurat rumah sakit rujukan terdekat, dan SOP ambulans darurat siaga 24 jam di lokasi.</li>
  <li><strong>Bab 7 - Program Audit, Inspeksi, &amp; Kampanye K3:</strong> Jadwal Management Safety Walkthrough bulanan, program penghargaan keselamatan bagi pekerja teladan (Safety Award), dan jadwal pertemuan Komite K3 mingguan.</li>
</ol>

<h2>Penghitungan Rumus Statistik Keselamatan: LTI, LTIFR, &amp; TRIFR</h2>
<p>Dalam evaluasi CSMS fase pemantauan pelaksanaan (Work in Progress / WIP), kontraktor wajib melaporkan kinerja keselamatan setiap bulan kepada pemilik proyek menggunakan indikator lagging terstandarisasi internasional:</p>

<table>
  <thead>
    <tr>
      <th>Indikator Statistik K3</th>
      <th>Definisi Resmi</th>
      <th>Rumus Standar Internasional (OSHA / ANSI)</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>LTI (Lost Time Injury)</strong></td>
      <td>Jumlah kasus kecelakaan kerja yang mengakibatkan pekerja tidak mampu kembali bekerja pada shift kerja berikutnya.</td>
      <td>Total kumulatif jumlah kasus insiden LTI dalam periode kontrak.</td>
    </tr>
    <tr>
      <td><strong>LTIFR (Lost Time Injury Frequency Rate)</strong></td>
      <td>Tingkat frekuensi kecelakaan berakibat hari kerja hilang per satu juta jam kerja orang.</td>
      <td><strong>(Jumlah Kasus LTI &times; 1.000.000) &divide; Total Jam Kerja Orang Kumulatif</strong></td>
    </tr>
    <tr>
      <td><strong>TRIFR (Total Recordable Incident Frequency Rate)</strong></td>
      <td>Tingkat frekuensi seluruh insiden yang dapat dicatat (Kematian + LTI + Perawatan Medis / MTC + Tugas Terbatas / RWC).</td>
      <td><strong>(Total Kasus Recordable &times; 1.000.000) &divide; Total Jam Kerja Orang Kumulatif</strong></td>
    </tr>
    <tr>
      <td><strong>SR (Severity Rate / Tingkat Keparahan)</strong></td>
      <td>Jumlah total hari kerja yang hilang akibat kecelakaan per satu juta jam kerja orang.</td>
      <td><strong>(Jumlah Hari Kerja Hilang &times; 1.000.000) &divide; Total Jam Kerja Orang Kumulatif</strong></td>
    </tr>
  </tbody>
</table>

<p>Klien migas dan tambang umumnya mematok target <strong>LTIFR = 0,00</strong> dan <strong>TRIFR &le; 1,00</strong>. Jika angka insiden kontraktor melampaui batas toleransi tersebut, pemilik proyek berhak menerbitkan Surat Peringatan K3, menjatuhkan sanksi denda finansial, hingga melakukan pemutusan kontrak kerja sepihak demi menjaga keselamatan seluruh area operasional.</p>
"""

with open('scripts/deep_rewrite_batch_11_to_15.py', 'r', encoding='utf-8') as f:
    code = f.read()

code = code.replace('art11_content = """', 'art11_content = """\n' + art11_extra)
code = code.replace('art12_content = """', 'art12_content = """\n' + art12_extra)
code = code.replace('art13_content = """', 'art13_content = """\n' + art13_extra)
code = code.replace('art14_content = """', 'art14_content = """\n' + art14_extra)
code = code.replace('art15_content = """', 'art15_content = """\n' + art15_extra)

with open('scripts/deep_rewrite_batch_11_to_15.py', 'w', encoding='utf-8') as f:
    f.write(code)

print("Enrichment for batch 11 to 15 injected successfully!")
