"""
scripts/deep_rewrite_batch_6_to_10.py
Generates and uploads authoritative, 1,500+ word guides for Articles 6 to 10.
"""
import sys
import urllib.request
import json
import re

if sys.stdout.encoding != 'utf-8':
    try:
        sys.stdout.reconfigure(encoding='utf-8')
    except Exception:
        pass

API_URL = "https://wahanatotalita.com/api/articles.php"
API_KEY = "wtk_srv_fad3983cf65feca3f8f3da70d01d759a64cd889d99bafe88028732826f33066f"

def count_words(html_text: str) -> int:
    clean = re.sub(r'<[^>]+>', ' ', html_text)
    words = clean.split()
    return len(words)

def put_article(slug: str, data: dict) -> dict:
    payload = {"slug": slug}
    payload.update(data)
    req = urllib.request.Request(
        API_URL,
        data=json.dumps(payload, ensure_ascii=False).encode('utf-8'),
        headers={
            "Authorization": f"Bearer {API_KEY}",
            "Content-Type": "application/json",
            "Accept": "application/json",
            "User-Agent": "Mozilla/5.0"
        },
        method="PUT"
    )
    with urllib.request.urlopen(req) as resp:
        return json.loads(resp.read().decode('utf-8'))

# ==============================================================================
# ARTICLE 6: CARA MENDAPATKAN SIO OPERATOR FORKLIFT KEMNAKER
# ==============================================================================
art6_content = """

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

<h2>Panduan Lengkap Cara Mendapatkan SIO Operator Forklift Kemnaker RI 2026</h2>
<p>Dalam operasional rantai pasok (supply chain), pergudangan (warehouse), dan pabrik manufaktur modern, forklift merupakan tulang punggung pergerakan material berat yang tak tergantikan. Namun, di balik efisiensinya yang luar biasa, forklift juga merupakan salah satu mesin industri paling mematikan jika dioperasikan oleh personil yang tidak terlatih. Statistik kecelakaan kerja nasional mencatat bahwa ratusan insiden fatalitas, cedera amputasi, dan kerusakan infrastruktur gudang setiap tahunnya dipicu oleh manuver forklift yang ceroboh, beban berlebih, serta pengemudi yang tidak memiliki kualifikasi resmi.</p>

<p>Bagi manajemen perusahaan, mempekerjakan operator tanpa <strong>Surat Izin Operator (SIO) / Lisensi K3 resmi Kementerian Ketenagakerjaan Republik Indonesia</strong> bukan hanya membahayakan nyawa pekerja, melainkan juga pelanggaran hukum berat yang dapat berujung sanksi pidana dan penolakan klaim asuransi aset. Artikel ini mengupas tuntas cara mendapatkan SIO Forklift Kemnaker RI tahun 2026, perbedaan Kelas I vs Kelas II, materi uji praktik, hingga prosedur perpanjangan resmi di PJK3 Wahana Totalita Konsultan.</p>

<h2>Dasar Hukum Regulasi: Permenaker No. 08 Tahun 2020</h2>
<p>Landasan hukum tertinggi yang mengatur operasional forklift dan pesawat angkut di Indonesia adalah <strong>Peraturan Menteri Ketenagakerjaan No. 08 Tahun 2020 tentang Keselamatan dan Kesehatan Kerja Pesawat Angkat dan Pesawat Angkut</strong>. Regulasi ini mencabut Permenaker No. 05/MEN/1985 dan No. 09/MEN/2010 guna menyesuaikan dengan perkembangan teknologi angkat-angkut modern.</p>

<p>Berdasarkan Permenaker 08/2020 Pasal 140, setiap pengusaha atau pengurus tempat kerja <strong>WAJIB mempekerjakan Operator Pesawat Angkat dan Pesawat Angkut yang memiliki Lisensi K3 (SIO)</strong> yang diterbitkan oleh Direktur Jenderal Pembinaan Pengawasan Ketenagakerjaan dan K3 Kemnaker RI. Ditegaskan pula bahwa <em>Surat Izin Mengemudi (SIM B2 Umum) dari Kepolisian TIDAK BERLAKU dan TIDAK SAH</em> untuk mengoperasikan forklift di tempat kerja, karena SIM polisi dirancang untuk jalan raya umum, bukan untuk pesawat angkut industri dengan karakteristik kemudi roda belakang (rear-wheel steering) dan dinamika beban garpu bergerak.</p>

<h2>Klasifikasi Operator Forklift: Perbedaan Kelas I vs Kelas II</h2>
<p>Kemnaker RI membagi kualifikasi operator forklift ke dalam 2 (dua) kelas kompetensi berdasarkan kapasitas angkat maksimal unit alat yang dioperasikan:</p>

<table>
  <thead>
    <tr>
      <th>Kriteria Pembanding</th>
      <th>Operator Forklift Kelas II</th>
      <th>Operator Forklift Kelas I</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>Kapasitas Beban Angkat Unit</strong></td>
      <td>Mengoperasikan forklift dengan kapasitas angkat <strong>sampai dengan 15 Ton (&le; 15 Ton)</strong>.</td>
      <td>Mengoperasikan forklift dengan kapasitas angkat <strong>lebih dari 15 Ton (&gt; 15 Ton)</strong> serta mengawasi operator Kelas II.</td>
    </tr>
    <tr>
      <td><strong>Kualifikasi Pendidikan Minimal</strong></td>
      <td>Minimal berpendidikan <strong>SMP / Sederajat</strong>.</td>
      <td>Minimal berpendidikan <strong>SMA / SMK / Sederajat</strong>.</td>
    </tr>
    <tr>
      <td><strong>Syarat Pengalaman Kerja</strong></td>
      <td>Sekurang-kurangnya memiliki pengalaman membantu operasi forklift <strong>1 (satu) tahun</strong>.</td>
      <td>Sekurang-kurangnya memiliki pengalaman kerja sebagai operator forklift <strong>2 (dua) tahun</strong> berturut-turut.</td>
    </tr>
    <tr>
      <td><strong>Durasi Waktu Pelatihan</strong></td>
      <td>3 Hari Kerja Efektif (~30 Jam Pelajaran / JPL).</td>
      <td>4 Hari Kerja Efektif (~40 Jam Pelajaran / JPL).</td>
    </tr>
    <tr>
      <td><strong>Area Penggunaan Umum</strong></td>
      <td>Gudang logistik, pabrik FMCG, ritel distribution center, workshop perakitan.</td>
      <td>Pelabuhan peti kemas (container yard), industri baja, pertambangan, pabrik semen berat.</td>
    </tr>
  </tbody>
</table>

<h2>Fisika Kestabilan Forklift: Memahami Konsep Segitiga Kestabilan (Stability Triangle)</h2>
<p>Salah satu materi paling krusial yang diajarkan dalam pembinaan sertifikasi SIO Kemnaker adalah pemahaman tentang <strong>Segitiga Kestabilan (Stability Triangle)</strong>. Berbeda dengan mobil biasa yang memiliki 4 titik tumpu suspensi mandiri, forklift bertumpu pada 3 titik poros: dua roda depan (drive wheels) dan satu titik pivot di tengah as roda belakang (steer axle pivot pin).</p>

<p>Jika titik pusat massa gabungan (Center of Gravity / CG) antara forklift dan beban bawaan bergeser keluar dari area segitiga ini—misalnya akibat menikung terlalu tajam dalam kecepatan tinggi, membawa beban terlalu tinggi saat berjalan, atau mengerem mendadak—maka forklift akan <strong>terguling ke samping (tip-over)</strong>. Instruktur Wahana Totalita Konsultan melatih operator secara intensif untuk selalu menjaga posisi garpu hanya 15–20 cm dari permukaan lantai saat berjalan dan selalu memundurkan forklift ketika menuruni lereng/ramp dengan muatan penuh.</p>

<h2>Prosedur Standar Pemeriksaan Harian (Pre-Operation Inspection Checklist)</h2>
<p>Sebelum menyalakan kunci kontak mesin, seorang operator forklift bersertifikat wajib menjalankan inspeksi visual dan fungsional harian. Berikut checklist standar yang wajib diisi dan ditandatangani:</p>

<table>
  <thead>
    <tr>
      <th>Komponen Pemeriksaan</th>
      <th>Item yang Diinspeksi</th>
      <th>Kondisi Standar Kelaikan Operasi</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>Ban &amp; Roda (Tires &amp; Wheels)</strong></td>
      <td>Kondisi ban mati (solid) atau ban angin (pneumatic), baut roda (lug nuts).</td>
      <td>Tidak ada retak dalam, tidak ada sobekan karet, baut roda kencang lengkap.</td>
    </tr>
    <tr>
      <td><strong>Sistem Garpu &amp; Tiang (Fork &amp; Mast)</strong></td>
      <td>Kelurusan kedua bilah garpu, pin pengunci garpu, rantai angkat (leaf chain).</td>
      <td>Kedua garpu simetris rata tanah, tidak ada bengkok/retak las, rantai terlumasi baik.</td>
    </tr>
    <tr>
      <td><strong>Cairan &amp; Pelumas (Fluids)</strong></td>
      <td>Oli mesin, minyak rem, fluida hidrolik, air radiator (coolant), air aki.</td>
      <td>Volume berada di antara garis MIN dan MAX, tidak ada kebocoran oli di kolong mesin.</td>
    </tr>
    <tr>
      <td><strong>Fitur Keselamatan Aktif</strong></td>
      <td>Klakson, lampu kerja depan/belakang, rotating strobe lamp, buzzer alarm mundur.</td>
      <td>Seluruh alarm dan lampu berfungsi nyaring dan terang saat tuas mundur digerakkan.</td>
    </tr>
    <tr>
      <td><strong>Kabin &amp; Ergonomi</strong></td>
      <td>Sabuk keselamatan (seatbelt 2 titik), kaca spion, kanopi pelindung (Overhead Guard - OHG).</td>
      <td>Seatbelt mengunci otomatis saat ditarik cepat, kanopi OHG kokoh tanpa deformasi.</td>
    </tr>
  </tbody>
</table>

<h2>Uji Praktik Manuver Lapangan dalam Pelatihan Kemnaker RI</h2>
<p>Dalam uji kompetensi praktik yang disupervisi langsung oleh Pengawas Spesialis K3 Kemnaker RI, peserta pelatihan diuji pada lintasan khusus (obstacle course) yang mencakup:</p>
<ol>
  <li><strong>Manuver Lintasan S (Slalom Course):</strong> Mengendalikan forklift maju dan mundur melintasi deretan cone pembatas tanpa menyenggol atau menjatuhkan rintangan, menguji kepekaan setir roda belakang.</li>
  <li><strong>Pengambilan Beban dari Rak Bertingkat (Stacking &amp; De-stacking):</strong> Menyelipkan garpu ke dalam palet secara presisi di rak ketinggian 3 meter, memiringkan tiang mast ke belakang (tilt back), menurunkan beban ke posisi jalan aman, dan memindahkan ke palet lain.</li>
  <li><strong>Uji Pengereman Darurat &amp; Parkir Selamat:</strong> Menghentikan unit pada kecepatan operasional, menurunkan garpu menyentuh lantai dengan ujung menukik ke bawah, mengaktifkan rem tangan (parking brake), menetralkan transmisi, dan mencabut kunci kontak.</li>
</ol>

<h2>Berkas Dokumen Persyaratan Pendaftaran SIO Forklift 2026</h2>
<p>Untuk mengikuti pembinaan dan uji lisensi operator forklift di Wahana Totalita Konsultan, calon peserta wajib melengkapi dokumen administratif berikut:</p>
<ul>
  <li>Salinan Ijazah Terakhir (minimal SMP untuk Kelas II, minimal SMA/SMK untuk Kelas I).</li>
  <li>Scan warna e-KTP yang masih berlaku aktif.</li>
  <li>Surat Keterangan Berbadan Sehat dan Tidak Buta Warna dari dokter klinik/rumah sakit.</li>
  <li>Surat Pengalaman Kerja / Rekomendasi dari perusahaan tempat bekerja (atau surat pernyataan mandiri bagi peserta perorangan).</li>
  <li>File pasfoto formal ukuran 3x4 dan 2x3 latar belakang warna merah (mengenakan kemeja rapi berkerah).</li>
</ul>

<h2>Masa Berlaku Lisensi K3 (SIO) dan Prosedur Perpanjangan Resmi</h2>
<p>Berdasarkan Permenaker No. 08 Tahun 2020, <strong>Lisensi K3 Operator Forklift memiliki masa berlaku resmi selama 5 (lima) tahun</strong>. Setelah 5 tahun, operator wajib mengajukan perpanjangan lisensi melalui PJK3 resmi dengan melampirkan Lisensi lama asli, surat keterangan sehat dokter, surat rekomendasi aktif mengoperasikan forklift dari perusahaan, dan pasfoto terbaru. Operator <em>tidak perlu mengulang kelas teori dari awal</em> jika perpanjangan diajukan sebelum masa tenggang habis.</p>
"""

art6_faqs = [
    {
        "question": "Apakah saya yang belum bisa menyetir forklift sama sekali boleh ikut pelatihan SIO Kemnaker?",
        "answer": "Program sertifikasi resmi Kemnaker RI sejatinya adalah program pembinaan dan lisensi kompetensi regulasi K3. Bagi pemula yang sama sekali belum pernah menyetir forklift, Wahana Totalita Konsultan menyediakan kelas khusus Basic Training + Sertifikasi dengan tambahan sesi praktik dasar mengemudi bersama instruktur berpengalaman sebelum hari ujian tiba."
    },
    {
        "question": "Apa sanksinya bagi perusahaan jika mempekerjakan operator forklift tanpa SIO?",
        "answer": "Berdasarkan UU No. 1 Tahun 1970 dan Permenaker 08/2020, pengawas ketenagakerjaan berwenang menghentikan sementara operasional alat (segel K3), menjatuhkan denda administratif, dan apabila terjadi kecelakaan kerja fatal, manajemen perusahaan dapat dikenai tuntutan pidana kurungan atas kelalaian keselamatan kerja."
    },
    {
        "question": "Bolehkah operator forklift Kelas II mengoperasikan forklift berkapasitas 20 Ton?",
        "answer": "Tidak boleh. Operator Kelas II dibatasi secara hukum hanya untuk mengoperasikan unit forklift dengan kapasitas angkat maksimal 15 Ton. Untuk mengoperasikan unit di atas 15 Ton, operator wajib meningkatkan lisensinya (upgrade) ke Operator Forklift Kelas I."
    },
    {
        "question": "Apakah SIM B2 dari Kepolisian bisa dipakai menggantikan SIO Kemnaker?",
        "answer": "Sama sekali tidak bisa. SIM B2 adalah izin mengemudi kendaraan bermotor di jalan raya umum di bawah kepolisian, sedangkan SIO adalah lisensi K3 pengoperasian pesawat angkut industri di tempat kerja di bawah pengawasan Kementerian Ketenagakerjaan RI."
    },
    {
        "question": "Berapa lama proses penerbitan SIO dan buku kerja operator forklift Kemnaker?",
        "answer": "Setelah ujian teori dan praktik selesai serta dinyatakan lulus, proses penerbitan blanko lisensi digital dan fisik resmi Kemnaker RI memakan waktu sekitar 1 hingga 2 bulan. Namun, Wahana Totalita Konsultan akan segera menerbitkan Surat Keterangan Lulus (SKL) resmi dalam waktu 3 hari kerja pasca pelatihan untuk keperluan kerja mendesak."
    }
]

# ==============================================================================
# ARTICLE 7: STANDAR K3 SCAFFOLDING KUALIFIKASI TEKNISI INSPEKSI PERANCAH
# ==============================================================================
art7_content = """

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

<h2>Standar K3 Scaffolding: Kualifikasi Teknisi, Supervisi, &amp; Inspeksi Kelaikan Perancah</h2>
<p>Dalam proyek rekayasa konstruksi sipil, perawatan pabrik (plant turnaround), pengecatan gedung tinggi, hingga pemeliharaan struktur migas offshore, perancah atau <em>scaffolding</em> adalah platform kerja sementara yang vital. Namun, perancah juga tercatat sebagai salah satu sumber kecelakaan kerja fatalitas tertinggi di dunia konstruksi. Keruntuhan struktur perancah (scaffold collapse) dan pekerja jatuh dari lantai kerja (falls from height) selalu menjadi momok mematikan akibat kegagalan sambungan pipa, ketiadaan ikatan angkur dinding (wall ties), pondasi amblas, atau perakitan yang dilakukan oleh buruh tanpa kualifikasi kompetensi resmi.</p>

<p>Penerapan standar Keselamatan dan Kesehatan Kerja (K3) pada pekerjaan perancah tidak boleh dilakukan secara serampangan. Kementerian Ketenagakerjaan RI mewajibkan seluruh personil yang terlibat dalam perakitan, pengawasan, dan pengujian kelaikan perancah memiliki sertifikat lisensi K3 resmi. Artikel ini membedah tuntas regulasi scaffolding nasional, pembagian kualifikasi Teknisi vs Supervisi vs Inspektur Perancah, sistem Tagging hijau-kuning-merah, hingga prosedur inspeksi beban kerja aman.</p>

<h2>Landasan Hukum Regulasi K3 Perancah di Indonesia</h2>
<p>Penyelenggaraan keselamatan kerja perancah di Indonesia dipayungi oleh serangkaian regulasi hierarkis:</p>
<ul>
  <li><strong>Undang-Undang No. 1 Tahun 1970 tentang Keselamatan Kerja:</strong> Pasal 3 dan Pasal 4 menegaskan kewajiban penyediaan platform kerja dan tangga yang aman bagi pekerja di tempat kerja bertingkat.</li>
  <li><strong>Peraturan Menteri Tenaga Kerja dan Transmigrasi No. Per.01/MEN/1980 tentang K3 Konstruksi Bangunan:</strong> Bab III secara khusus mengatur standar konstruksi perancah, kekuatan bahan papan lantai kerja, palang pengaman (guardrail), papan tepi (toeboard), dan larangan membebani perancah melampaui batas aman.</li>
  <li><strong>Surat Keputusan Bersama (SKB) Menteri Tenaga Kerja dan Menteri PU No. Kep.174/MEN/1986 dan No. 104/KPTS/1986:</strong> Menetapkan Pedoman Pelaksanaan K3 pada Tempat Kegiatan Konstruksi, termasuk instruksi teknis pemasangan scaffolding modular dan pipa.</li>
  <li><strong>Permenaker No. 09 Tahun 2016 tentang K3 Dalam Pekerjaan Pada Ketinggian:</strong> Mengatur penggunaan alat pelindung jatuh personal (Fall Arrest System) bagi personil scaffolder saat merakit perancah di atas 2 meter.</li>
</ul>

<h2>Mengenal 3 Kualifikasi Personil Scaffolding Resmi Kemnaker RI</h2>
<p>Kemnaker RI membagi kompetensi profesi perancah ke dalam 3 tingkatan jenjang penugasan yang saling melengkapi:</p>

<table>
  <thead>
    <tr>
      <th>Kualifikasi Penugasan</th>
      <th>Teknisi Perancah (Scaffolder)</th>
      <th>Supervisi Perancah (Supervisor)</th>
      <th>Inspektur Perancah (Inspector)</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>Tugas &amp; Tanggung Jawab Utama</strong></td>
      <td>Melakukan pemasangan, pemeliharaan, modifikasi, dan pembongkaran fisik struktur perancah di lapangan secara aman.</td>
      <td>Mengawasi regu teknisi perancah, memastikan metode pemasangan sesuai gambar kerja (drawing), dan mengontrol JSA.</td>
      <td>Melakukan pemeriksaan menyeluruh, pengujian kelaikan kekuatan struktur (SWL), dan memberi legalitas status Scafftag (Hijau/Merah).</td>
    </tr>
    <tr>
      <td><strong>Syarat Pendidikan Masuk</strong></td>
      <td>Minimal berpendidikan <strong>SMP / Sederajat</strong>.</td>
      <td>Minimal berpendidikan <strong>SMA / SMK Teknik</strong>.</td>
      <td>Minimal berpendidikan <strong>D3 / S1 Rumpun Teknik Sipil/Mesin</strong>.</td>
    </tr>
    <tr>
      <td><strong>Pengalaman Kerja Bidang K3</strong></td>
      <td>Minimal 1 tahun membantu pekerjaan konstruksi lapangan.</td>
      <td>Minimal 2 tahun berpengalaman sebagai teknisi perancah.</td>
      <td>Minimal 2–3 tahun dalam bidang inspeksi teknik dan struktur bangunan.</td>
    </tr>
    <tr>
      <td><strong>Durasi Waktu Pembinaan</strong></td>
      <td>4 Hari Kerja Efektif (~40 Jam Pelajaran).</td>
      <td>5 Hari Kerja Efektif (~50 Jam Pelajaran).</td>
      <td>5–6 Hari Kerja Efektif (~55 Jam Pelajaran).</td>
    </tr>
    <tr>
      <td><strong>Output Dokumen Resmi</strong></td>
      <td>Sertifikat &amp; Lisensi K3 Teknisi Perancah Kemnaker RI.</td>
      <td>Sertifikat &amp; Lisensi K3 Supervisi Perancah Kemnaker RI.</td>
      <td>Sertifikat &amp; Lisensi K3 Inspektur Perancah Kemnaker RI.</td>
    </tr>
  </tbody>
</table>

<h2>Sistem Tagging Scaffolding: Kode Warna Status Keselamatan di Lapangan</h2>
<p>Salah satu sistem kontrol visual paling efektif untuk mencegah pekerja awam menaiki perancah yang belum tuntas atau tidak aman adalah sistem <strong>Scaffold Tagging (Scafftag)</strong>. Pemasangan kartu ini merupakan wewenang mutlak dari Inspektur atau Pengawas Perancah bersertifikat:</p>

<table>
  <thead>
    <tr>
      <th>Warna Scafftag</th>
      <th>Arti Status Perancah</th>
      <th>Tindakan yang Diwajibkan di Lapangan</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>GREEN TAG (Tag Hijau)</strong></td>
      <td><strong>AMAN DIGUNAKAN (SAFE FOR USE):</strong> Perancah telah diinspeksi 100%, seluruh struktur lengkap, guardrail terpasang kokoh, dan aman bagi pekerja beban kerja tertentu.</td>
      <td>Pekerja diizinkan naik dan bekerja di atas platform. Tag mencantumkan tanggal inspeksi terakhir, kapasitas beban maksimum (kg/m&sup2;), dan tanda tangan inspektur.</td>
    </tr>
    <tr>
      <td><strong>YELLOW TAG (Tag Kuning)</strong></td>
      <td><strong>PERHATIAN KHUSUS / MODIFIKASI:</strong> Perancah aman digunakan tetapi ada kondisi khusus (misalnya guardrail satu sisi dilepas sementara untuk loading material atau perancah sedang dimodifikasi sebagian).</td>
      <td>Pekerja hanya boleh naik dengan izin khusus dan <em>WAJIB mencantolkan Full Body Harness (100% Tie-Off)</em> ke angkur mandiri setiap saat.</td>
    </tr>
    <tr>
      <td><strong>RED TAG (Tag Merah)</strong></td>
      <td><strong>DILARANG KERAS DIGUNAKAN (DO NOT USE / DANGER):</strong> Perancah dalam proses perakitan, belum selesai, struktur rusak, pondasi amblas, atau sedang dalam proses pembongkaran.</td>
      <td>Siapa pun dilarang menaiki perancah kecuali regu Teknisi Scaffolder yang bertugas merakit atau membongkar dengan APD ketinggian lengkap.</td>
    </tr>
  </tbody>
</table>

<h2>Elemen Kritis Pemeriksaan Struktur Perancah Sesuai Standar K3</h2>
<p>Dalam melakukan inspeksi rutin mingguan atau pasca cuaca ekstrem (hujan badai, gempa bumi), Inspektur Perancah wajib memeriksa titik-titik krusial berikut:</p>
<ol>
  <li><strong>Dudukan Pondasi (Foundation &amp; Base Plate):</strong> Tanah tempat berpijak wajib dipadatkan secara stabil. Tiang tegak (standard) wajib beralaskan base plate baja berukuran minimal 150x150 mm dan bantalan kayu tebal (sole board / timber sill) dengan tebal minimal 38 mm untuk menyebarkan beban merata.</li>
  <li><strong>Kelurusan Tiang Vertikal (Plumbness):</strong> Penyimpangan kemiringan tiang tegak tidak boleh melebihi toleransi 1:300 atau maksimal deviasi 25 mm di sepanjang ketinggian struktur.</li>
  <li><strong>Ikatan Silang Pengaku (Cross Bracing &amp; Diagonal Bracing):</strong> Wajib dipasang di setiap bentang modul untuk menahan gaya angin lateral dan beban puntir (sway force).</li>
  <li><strong>Ikatan Pengikat ke Dinding Gedung (Wall Ties):</strong> Perancah dengan perbandingan rasio tinggi terhadap lebar dasar melebihi <strong>4:1 (Rasio Kestabilan 4 banding 1)</strong> wajib diikatkan ke struktur permanen gedung (tie-in) setiap interval 4 meter vertikal dan 6 meter horizontal.</li>
  <li><strong>Lantai Kerja Penuh (Fully Planked Platform):</strong> Papan kayu atau metal deck wajib menutupi seluruh lebar lantai kerja tanpa ada celah terbuka yang melebihi 25 mm. Ujung papan wajib terikat klem kawat (clamped) agar tidak bergeser saat diinjak.</li>
  <li><strong>Sistem Pagar Pengaman Tiga Lapis (Guardrail System):</strong> Terdiri dari Rel Atas (Top Rail) setinggi 950–1150 mm dari lantai, Rel Tengah (Mid Rail) setinggi 450–600 mm, dan Papan Tepi Kaki (Toeboard) setinggi minimal 150 mm untuk mencegah perkakas kerja jatuh menimpa orang di bawah.</li>
</ol>

<h2>Menghitung Beban Kerja Aman (Safe Working Load - SWL) Perancah</h2>
<p>Berdasarkan peruntukan beban kerjanya, perancah diklasifikasikan ke dalam 3 kelas tugas operasi (Duty Rating):</p>
<ul>
  <li><strong>Light Duty Scaffolding (Tugas Ringan):</strong> Beban kerja aman maksimal <strong>150 kg/m&sup2; (1,5 kN/m&sup2;)</strong>. Diperuntukkan bagi pekerjaan pengecatan, pembersihan kaca, inspeksi visual, atau pemeliharaan listrik ringan dengan maksimal 2 orang pekerja per bentang.</li>
  <li><strong>Medium Duty Scaffolding (Tugas Sedang):</strong> Beban kerja aman maksimal <strong>225 kg/m&sup2; (2,25 kN/m&sup2;)</strong>. Diperuntukkan bagi pekerjaan plesteran dinding, pemasangan bata ringan, dan perbaikan atap dengan penumpukan material terbatas.</li>
  <li><strong>Heavy Duty Scaffolding (Tugas Berat):</strong> Beban kerja aman maksimal <strong>300 kg/m&sup2; (3,0 kN/m&sup2;)</strong>. Diperuntukkan bagi pekerjaan pembesian struktur beton bertulang, pemasangan batu alam tebal, atau perakitan pipa industri berat.</li>
</ul>

<h2>Keuntungan Mengikuti Sertifikasi Scaffolding di Wahana Totalita Konsultan</h2>
<p>Wahana Totalita Konsultan menyelenggarakan pelatihan Teknisi dan Supervisi Perancah Kemnaker RI dengan fasilitas terlengkap di Yogyakarta dan in-house corporate di seluruh Indonesia. Peserta mendapatkan:</p>
<ul>
  <li>Praktik langsung perakitan scaffolding tubular dan frame di workshop terbuka bersertifikasi safety.</li>
  <li>Pelatihan pembacaan gambar teknik (isometric scaffold drawing) dan kalkulasi beban bending/defleksi.</li>
  <li>Instruktur praktisi senior scaffolding migas dan pengawas spesialis K3 konstruksi Kemnaker RI.</li>
  <li>Sertifikat Pembinaan, Surat Keputusan Penunjukan (SKP), dan Lisensi Kewenangan Kartu K3 resmi.</li>
</ul>
"""

art7_faqs = [
    {
        "question": "Berapa lama masa berlaku Lisensi K3 Teknisi Perancah Kemnaker RI?",
        "answer": "Lisensi K3 Teknisi Scaffolding Kemnaker RI berlaku selama 3 (tiga) tahun sejak tanggal diterbitkan. Sebelum masa berlaku habis, pemegang lisensi dapat mengajukan perpanjangan melalui PJK3 resmi dengan melampirkan lisensi lama, surat keterangan aktif bekerja di proyek dari perusahaan, dan surat keterangan sehat dokter."
    },
    {
        "question": "Apakah seorang buruh bangunan biasa boleh memasang scaffolding tanpa sertifikat?",
        "answer": "Berdasarkan Permenaker No. 01/MEN/1980 dan SKB Dua Menteri, perakitan, modifikasi, dan pembongkaran scaffolding WAJIB dilakukan oleh Teknisi Perancah yang memiliki kompetensi bersertifikat dan berada di bawah pengawasan langsung Supervisor Perancah resmi untuk mencegah keruntuhan struktur yang berakibat fatal."
    },
    {
        "question": "Kapan scaffolding wajib diinspeksi ulang oleh Inspektur Perancah?",
        "answer": "Perancah wajib diinspeksi ulang minimal setiap 7 (tujuh) hari sekali, segera setelah terjadi cuaca ekstrem (hujan lebat disertai angin kencang atau gempa bumi), setelah terjadi modifikasi/penambahan struktur, atau setelah terjadi benturan benda/kendaraan pada tiang perancah."
    },
    {
        "question": "Berapa tinggi maksimal scaffolding yang boleh berdiri bebas tanpa angkur dinding?",
        "answer": "Rasio kestabilan standar perancah yang berdiri bebas (free-standing scaffold) tanpa angkur pengikat adalah 4:1 untuk perancah di dalam ruangan tertutup (indoor) dan 3:1 untuk perancah di area luar ruangan (outdoor yang terkena beban angin). Artinya, jika lebar dasar perancah adalah 2 meter, tinggi maksimal tanpa ikatan dinding adalah 6 hingga 8 meter."
    },
    {
        "question": "Apakah peserta pelatihan mendapatkan buku pedoman saku scaffolding?",
        "answer": "Ya, seluruh peserta pelatihan di Wahana Totalita Konsultan menerima modul pedoman teknis scaffolding komprehensif, tabel kalkulasi Safe Working Load (SWL), serta buku himpunan peraturan K3 konstruksi nasional sebagai pegangan kerja."
    }
]

# ==============================================================================
# ARTICLE 8: PANDUAN SERTIFIKASI AHLI K3 LISTRIK TEKNISI K3 LISTRIK
# ==============================================================================
art8_content = """

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

<h2>Panduan Sertifikasi Ahli K3 Listrik &amp; Teknisi K3 Listrik Kemnaker RI Sesuai Permenaker 12/2015</h2>
<p>Energi listrik adalah urat nadi penggerak seluruh aktivitas industri manufaktur, gedung perkantoran komersial, pusat data (data center), hingga fasilitas kesehatan di era modern. Namun di balik kegunaannya yang vital, listrik adalah bahaya fisik yang tak kasat mata (<em>invisible hazard</em>) yang memiliki potensi destruktif mematikan. Arus listrik tegangan menengah dan rendah dapat mengalir tanpa suara, namun mampu memicu sengatan maut (electric shock), ledakan busur api bersuhu ribuan derajat celcius (arc flash), hingga kebakaran dahsyat yang melenyapkan aset perusahaan bernilai ratusan miliar rupiah.</p>

<p>Kementerian Ketenagakerjaan Republik Indonesia menerbitkan regulasi ketat yang mewajibkan perusahaan mengelola risiko kelistrikan melalui penempatan personil bersertifikat kompetensi resmi. Artikel ini mengupas secara tuntas <strong>perbedaan peran antara Teknisi K3 Listrik dan Ahli K3 Listrik</strong>, landasan hukum Permenaker No. 12 Tahun 2015, prosedur isolasi energi berbahaya (LOTO), standar pengukuran grounding PUIL 2011, serta jalur sertifikasi resmi di PJK3 Wahana Totalita Konsultan.</p>

<h2>Landasan Hukum Regulasi K3 Listrik di Indonesia</h2>
<p>Pengawasan dan standarisasi keselamatan ketenagalistrikan diatur secara komprehensif melalui regulasi perundang-undangan berikut:</p>
<ul>
  <li><strong>Undang-Undang No. 1 Tahun 1970 tentang Keselamatan Kerja:</strong> Pasal 3 ayat (1) huruf q menetapkan syarat-syarat keselamatan kerja untuk mencegah terkena aliran listrik yang berbahaya.</li>
  <li><strong>Peraturan Menteri Ketenagakerjaan No. 12 Tahun 2015 tentang Keselamatan dan Kesehatan Kerja Listrik di Tempat Kerja:</strong> Mewajibkan pengusaha merencanakan, memasang, memeriksa, menguji, dan memelihara instalasi listrik sesuai standar teknis Persyaratan Umum Instalasi Listrik (PUIL 2011) serta mempekerjakan Teknisi K3 Listrik dan Ahli K3 Listrik berlisensi.</li>
  <li><strong>Keputusan Direktur Jenderal Pembinaan Pengawasan Ketenagakerjaan No. Kep.47/PPK&amp;K3/VIII/2015:</strong> Mengatur pembinaan kompetensi calon Teknisi K3 Listrik.</li>
  <li><strong>Keputusan Direktur Jenderal Pembinaan Pengawasan Ketenagakerjaan No. Kep.48/PPK&amp;K3/VIII/2015:</strong> Mengatur pembinaan kompetensi calon Ahli K3 Spesialis Listrik.</li>
</ul>

<h2>Tabel Komparasi Menyeluruh: Teknisi K3 Listrik vs Ahli K3 Listrik</h2>
<p>Banyak praktisi HRD dan insinyur teknik keliru menyamakan fungsi kedua profesi ini. Berikut adalah pemetaan perbedaan wewenang hukum, durasi belajar, dan tanggung jawabnya:</p>

<table>
  <thead>
    <tr>
      <th>Dimensi Evaluasi</th>
      <th>Teknisi K3 Listrik (Pelaksana Lapangan)</th>
      <th>Ahli K3 Spesialis Listrik (Konseptor &amp; Penguji)</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>Dasar Keputusan Dirjen</strong></td>
      <td>Kepdirjen Binwasnaker No. Kep.47/2015</td>
      <td>Kepdirjen Binwasnaker No. Kep.48/2015</td>
    </tr>
    <tr>
      <td><strong>Kualifikasi Pendidikan Minimal</strong></td>
      <td>Minimal <strong>SMK Teknik / SMA Sederajat</strong></td>
      <td>Minimal <strong>D3 Teknik / S1 Teknik Elektro/Mesin/Fisika</strong></td>
    </tr>
    <tr>
      <td><strong>Syarat Pengalaman Kerja</strong></td>
      <td>Pengalaman kerja di bidang instalasi listrik minimal 1–2 tahun</td>
      <td>Pengalaman kerja di bidang ketenagalistrikan minimal 2–4 tahun</td>
    </tr>
    <tr>
      <td><strong>Ruang Lingkup Kewenangan</strong></td>
      <td>Melakukan pemasangan, perbaikan, pemeliharaan harian sistem listrik, dan penerapan prosedur Lockout/Tagout (LOTO).</td>
      <td>Merancang perencanaan skema instalasi listrik, menghitung koordinasi proteksi, memimpin riksa uji berkala instalasi listrik dan petir.</td>
    </tr>
    <tr>
      <td><strong>Durasi Waktu Pelatihan</strong></td>
      <td>6 Hari Kerja Efektif (~60 Jam Pelajaran)</td>
      <td>16 Hari Kerja Efektif (~160 Jam Pelajaran Standar Kemnaker)</td>
    </tr>
    <tr>
      <td><strong>Kewajiban Pengangkatan Perusahaan</strong></td>
      <td>Wajib di perusahaan yang memiliki pembangkitan, transmisi, atau pemakaian listrik &ge; 200 kVA (minimal 1 personil).</td>
      <td>Wajib di perusahaan yang memiliki pembangkitan listrik &gt; 200 kVA atau instalasi berisiko bahaya tinggi.</td>
    </tr>
  </tbody>
</table>

<h2>Mengenal 4 Bahaya Kritis Ketenagalistrikan di Industri</h2>
<p>Instruktur Wahana Totalita Konsultan menekankan penguasaan identifikasi bahaya listrik yang meliputi empat pilar utama:</p>
<ol>
  <li><strong>Sengatan Listrik (Electric Shock):</strong> Terjadi ketika tubuh manusia menjadi bagian dari sirkuit listrik tertutup menuju ground. Arus sekecil 30–50 miliampere (mA) yang melewati dada manusia sudah cukup untuk memicu <em>Ventricular Fibrillation</em> (gagal ritme jantung mematikan) dalam hitungan detik.</li>
  <li><strong>Luka Bakar Busur Api (Arc Flash Burn):</strong> Pelepasan energi listrik bertegangan tinggi melalui udara saat terjadi hubung singkat antar konduktor. Suhu arc flash dapat menembus <strong>19.000&deg; Celcius (4 kali lebih panas dari permukaan matahari)</strong>, menguapkan logam tembaga menjadi gas beracun dan membakar pakaian kerja pekerja secara instan.</li>
  <li><strong>Ledakan Tekanan Busur Api (Arc Blast):</strong> Gelombang tekanan mekanis dahsyat yang tercipta dari ekspansi cepat udara akibat panas busur api. Gelombang kejut ini mampu meremukkan tulang rusuk pekerja, meledakkan pintu kabinet panel logam, dan menerbangkan serpihan logam tajam seperti peluru.</li>
  <li><strong>Bahaya Kebakaran (Electrical Fire):</strong> Korsleting listrik, sambungan kabel yang kendur (loose connection) yang memicu titik panas resistansi (hotspot), serta pembebanan lebih (overload) pada penghantar tanpa proteksi Circuit Breaker yang terkalibrasi.</li>
</ol>

<h2>Prosedur Standar Isolasi Energi: 6 Langkah Lockout / Tagout (LOTO)</h2>
<p>Dalam pemeliharaan panel daya (Distribution Board), genset, maupun motor listrik industri, penerapan Lockout/Tagout adalah hukum wajib untuk mencegah pengaliran arus listrik yang tidak disengaja saat teknisi bekerja di dalam kabinet. Berikut 6 tahapan LOTO standar OSHA &amp; Kemnaker:</p>

<table>
  <thead>
    <tr>
      <th>Tahap</th>
      <th>Nama Prosedur LOTO</th>
      <th>Uraian Tindakan Kritis Lapangan</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>1</td>
      <td><strong>Pemberitahuan (Notify)</strong></td>
      <td>Menginformasikan kepada seluruh operator area kerja terkait bahwa pemutusan daya akan dilakukan untuk perbaikan.</td>
    </tr>
    <tr>
      <td>2</td>
      <td><strong>Pematian Normal (Shutdown)</strong></td>
      <td>Mematikan mesin dan peralatan melalui tombol kendali normal (Off / Stop).</td>
    </tr>
    <tr>
      <td>3</td>
      <td><strong>Isolasi Sumber Energi (Isolate)</strong></td>
      <td>Menarik tuas pemutus daya utama (Circuit Breaker / Disconnect Switch) untuk memutuskan kontak fisik sirkuit.</td>
    </tr>
    <tr>
      <td>4</td>
      <td><strong>Pemasangan Gembok &amp; Tag (Lock &amp; Tag)</strong></td>
      <td>Memasang gembok keselamatan (padlock pribadi) pada tuas pemutus dan menggantungkan tag bahaya LOTO berisi nama teknisi dan tanggal.</td>
    </tr>
    <tr>
      <td>5</td>
      <td><strong>Pembuangan Energi Sisa (Dissipate / Bleed)</strong></td>
      <td>Membuang muatan listrik kapasitor, melepaskan tekanan udara pneumatik terkait, dan memasang grounding temporary jika diperlukan.</td>
    </tr>
    <tr>
      <td>6</td>
      <td><strong>Uji Kondisi Nol Energi (Zero-Energy Verification)</strong></td>
      <td>Menguji konduktor menggunakan Multimeter / Voltage Tester terkalibrasi untuk memastikan tegangan listrik benar-benar 0 (Nol Volt) sebelum disentuh.</td>
    </tr>
  </tbody>
</table>

<h2>Standar Nilai Pembumian (Grounding) &amp; Proteksi Petir Sesuai PUIL 2011</h2>
<p>Seorang Ahli K3 Listrik bertanggung jawab memvalidasi sistem grounding instalasi pabrik dan penyalur petir. Mengacu pada <strong>Persyaratan Umum Instalasi Listrik (PUIL 2011) dan Permenaker No. 02/MEN/1989</strong>:</p>
<ul>
  <li>Nilai resistansi pembumian (Grounding Resistance) untuk instalasi listrik dan bodi peralatan logam <strong>wajib bernilai &le; 5 Ohm (&le; 5 &Omega;)</strong>. Pada instalasi telekomunikasi dan pusat data sensitif, nilai ideal yang disyaratkan bahkan berada di bawah 1 Ohm.</li>
  <li>Sistem proteksi petir konvensional (Franklin / Faraday Cage) maupun elektrostatis non-radioaktif wajib memiliki jalur konduktor penurunan (down conductor) yang lurus tanpa tekukan tajam dan tersambung ke elektroda bumi yang terisolasi dengan baik.</li>
  <li>Pengukuran nilai tahanan tanah wajib dilakukan minimal 1 (satu) tahun sekali menggunakan alat <em>Earth Ground Clamp Tester</em> terkalibrasi oleh personil bersertifikat resmi.</li>
</ul>

<h2>Keunggulan Pembinaan K3 Listrik di Wahana Totalita Konsultan</h2>
<p>Wahana Totalita Konsultan menghadirkan kurikulum pelatihan K3 Listrik yang mengintegrasikan simulasi software perencanaan diagram satu garis (Single Line Diagram), demonstrasi alat uji termografi inframerah (Thermal Imager Fluke) untuk mendeteksi kabel panas, serta studi kasus kegagalan trafo daya di industri.</p>
<p>Selain pemahaman regulasi PUIL, peserta pembinaan di Wahana Totalita dibekali keahlian praktis dalam menyusun <em>Standard Operating Procedure (SOP) Bekerja Pada Instalasi Listrik Tegangan Rendah dan Menengah</em>. Peserta diajarkan teknik verifikasi izin kerja listrik (Electrical Work Permit), penentuan batas jarak pendekatan aman (Flash Protection Boundary), serta pemilihan rating sarung tangan isolasi karet (Kelas 00 hingga Kelas 4 sesuai tegangan kerja AC/DC) guna menjamin zero accident di area kelistrikan industri.</p>
"""

art8_faqs = [
    {
        "question": "Apakah perusahaan yang memiliki genset 500 kVA wajib memiliki Ahli K3 Listrik?",
        "answer": "Ya. Berdasarkan Permenaker No. 12 Tahun 2015 Pasal 10, perusahaan yang menggunakan daya listrik atau memiliki pembangkit listrik dengan kapasitas di atas 200 kVA wajib mempekerjakan sekurang-kurangnya 1 (satu) orang Ahli K3 Spesialis Listrik dan Teknisi K3 Listrik berlisensi resmi Kemnaker RI."
    },
    {
        "question": "Berapa lama masa berlaku lisensi Ahli K3 Listrik dan Teknisi K3 Listrik?",
        "answer": "Surat Keputusan Penunjukan (SKP) dan Kartu Lisensi Kewenangan K3 Listrik berlaku selama 3 (tiga) tahun sejak tanggal diterbitkan. Sertifikat pembinaannya sendiri berlaku seumur hidup sebagai bukti kompetensi personal."
    },
    {
        "question": "Apakah sarjana non-teknik boleh mendaftar sertifikasi Ahli K3 Listrik?",
        "answer": "Berdasarkan Kepdirjen Binwasnaker No. Kep.48/2015, calon peserta Ahli K3 Listrik diutamakan berpendidikan minimal D3 Teknik Elektro, Listrik, Mesin, atau Fisika Terapan. Untuk sarjana non-teknik, disarankan terlebih dahulu mengambil sertifikasi Ahli K3 Umum sebelum mengajukan permohonan spesialis listrik dengan melampirkan pengalaman kerja teknis."
    },
    {
        "question": "Apa perbedaan antara APD listrik biasa dengan APD Arc Flash?",
        "answer": "Alat Pelindung Diri (APD) listrik biasa umumnya hanya terdiri dari sarung tangan isolasi karet (Rubber Dielectric Gloves) untuk menahan tegangan sentuh. Sedangkan APD Arc Flash adalah setelan pelindung khusus berbahan tahan api (Aramid / Nomex) lengkap dengan face shield pelindung mata dan balaclava yang memiliki rating perlindungan panas spesifik (Arc Thermal Performance Value / ATPV diukur dalam kal/cm&sup2;)."
    },
    {
        "question": "Bisakah pelatihan Ahli K3 Listrik dilaksanakan secara online blended learning?",
        "answer": "Bisa. Wahana Totalita Konsultan menyelenggarakan kelas Online Blended Learning di mana teori, regulasi, dan perhitungan PUIL dilaksanakan via Zoom meeting interaktif, sedangkan sesi simulasi riksa uji instalasi dan seminar evaluasi didampingi langsung oleh pengawas ketenagakerjaan Kemnaker RI."
    }
]

# ==============================================================================
# ARTICLE 9: KEWAJIBAN SERTIFIKASI TEKNISI CONFINED SPACE RUANG TERBATAS
# ==============================================================================
art9_content = """

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

<h2>Kewajiban Sertifikasi Teknisi Ruang Terbatas (Confined Space) Kemnaker RI</h2>
<p>Pekerjaan di dalam ruang terbatas atau <em>confined space</em>—seperti tangki penyimpanan minyak, bejana transport bahan kimia, silo gandum, gorong-gorong drainase utilitas, ruang palka kapal, dan terowongan bawah tanah—diakui di seluruh dunia sebagai salah satu aktivitas kerja paling berbahaya. Tragedi di ruang terbatas seringkali terjadi dalam pola klasik yang sangat memilukan: seorang pekerja pingsan di dalam tangki karena menghirup gas beracun, kemudian dua atau tiga rekan kerjanya bergegas masuk bermaksud menolong tanpa perlengkapan APD yang memadai, dan akhirnya seluruhnya tewas terpapar gas mematikan di tempat yang sama.</p>

<p>Kementerian Ketenagakerjaan Republik Indonesia menerbitkan regulasi ketat guna menghapuskan pola kecelakaan maut tersebut. Setiap orang yang memasuki, mengawasi, maupun mengamankan pekerjaan ruang terbatas <strong>WAJIB memiliki sertifikasi kompetensi resmi berlisensi Kemnaker RI</strong>. Artikel ini mengupas tuntas kualifikasi Petugas Madya vs Petugas Utama, batas aman pengujian gas atmosfer berbahaya, prosedur isolasi ventilasi, dan protokol evakuasi penyelamatan darurat (emergency rescue).</p>

<h2>Landasan Hukum Regulasi: Kepdirjen Binwasnaker No. Kep.113/DJPPK/IX/2006</h2>
<p>Dasar hukum utama penyelenggaraan K3 di ruang terbatas di Indonesia adalah <strong>Keputusan Direktur Jenderal Pembinaan Pengawasan Ketenagakerjaan No. Kep.113/DJPPK/IX/2006 tentang Pedoman Teknis Petugas Keselamatan dan Kesehatan Kerja Ruang Terbatas (Confined Space)</strong>.</p>

<p>Regulasi ini mendefinisikan ruang terbatas sebagai ruangan yang:</p>
<ol>
  <li>Cukup luas dan memiliki konfigurasi sedemikian rupa sehingga pekerja dapat masuk ke dalamnya untuk melakukan pekerjaan.</li>
  <li>Mempunyai akses masuk dan keluar yang terbatas (seperti lubang manhole tangki sempit).</li>
  <li><strong>TIDAK DIRANCANG UNTUK TEMPAT KERJA TETAP ATAU BERKELANJUTAN</strong> oleh manusia.</li>
  <li>Memiliki potensi bahaya atmosfer berbahaya, potensi penimbunan material padat curah (engulfment), atau dinding berkonfigurasi menjepit.</li>
</ol>

<h2>Perbedaan Jenjang Kualifikasi: Petugas Madya vs Petugas Utama Ruang Terbatas</h2>
<p>Pekerjaan di ruang terbatas memerlukan pembagian tugas yang mutlak dipatuhi. Pemerintah membagi personil ruang terbatas ke dalam 2 kualifikasi utama:</p>

<table>
  <thead>
    <tr>
      <th>Kriteria Pembanding</th>
      <th>Petugas Madya Ruang Terbatas (Standby Person)</th>
      <th>Petugas Utama Ruang Terbatas (Entrant)</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>Lokasi &amp; Posisi Penugasan</strong></td>
      <td><strong>DI LUAR RUANG TERBATAS</strong>, berjaga tepat di bibir pintu masuk (manhole entrance) sepanjang pekerjaan berlangsung.</td>
      <td><strong>DI DALAM RUANG TERBATAS</strong>, melakukan pekerjaan fisik pembersihan, pengelasan, atau inspeksi bejana.</td>
    </tr>
    <tr>
      <td><strong>Tugas &amp; Tanggung Jawab Kritis</strong></td>
      <td>Mencatat log keluar-masuk pekerja, memantau continuous gas detector, menjaga komunikasi verbal setiap saat, dan <strong>DILARANG KERAS MASUK ke dalam tangki saat terjadi insiden darurat</strong> (tugasnya memicu alarm rescue).</td>
      <td>Mengenakan APD pernapasan mandiri, mematuhi instruksi petugas madya, segera keluar dari tangki begitu tercium bau gas asing atau alarm detector berbunyi.</td>
    </tr>
    <tr>
      <td><strong>Kualifikasi Pendidikan Minimal</strong></td>
      <td>Minimal berpendidikan <strong>SMA / SMK Sederajat</strong>.</td>
      <td>Minimal berpendidikan <strong>SMP / Sederajat</strong>.</td>
    </tr>
    <tr>
      <td><strong>Durasi Waktu Pembinaan</strong></td>
      <td>3 Hari Kerja Efektif (~30 Jam Pelajaran).</td>
      <td>3 Hari Kerja Efektif (~30 Jam Pelajaran).</td>
    </tr>
    <tr>
      <td><strong>Sertifikat &amp; Lisensi Diterbitkan</strong></td>
      <td>Sertifikat &amp; Lisensi K3 Petugas Madya Ruang Terbatas Kemnaker RI.</td>
      <td>Sertifikat &amp; Lisensi K3 Petugas Utama Ruang Terbatas Kemnaker RI.</td>
    </tr>
  </tbody>
</table>

<h2>Uji Kualitas Udara Atmosfer: Ambang Batas 4 Gas Mematikan</h2>
<p>Sebelum surat izin kerja (Confined Space Entry Permit) diterbitkan, seorang teknisi gas tester wajib menguji atmosfer ruangan menggunakan alat <em>Multi-Gas Detector 4 in 1</em> yang terkalibrasi. Pengujian wajib dilakukan dari luar ruangan menggunakan selang sampling berurutan dari bagian atas, tengah, dan bawah tangki (karena berat jenis gas berbeda-beda). Parameter batas aman yang diwajibkan adalah:</p>

<table>
  <thead>
    <tr>
      <th>Parameter Gas</th>
      <th>Ambang Batas Aman Kemnaker / OSHA</th>
      <th>Karakteristik &amp; Dampak Bahaya Fatal</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>Kandungan Oksigen (O&sup2;)</strong></td>
      <td><strong>Antara 19,5% hingga 23,5%</strong></td>
      <td>Jika &lt; 19,5% (Asfiksia: lemas, hilang kesadaran dalam 40 detik, kematian otak). Jika &gt; 23,5% (Oxygen enriched: bahan pakaian terbakar spontan).</td>
    </tr>
    <tr>
      <td><strong>Gas Mudah Terbakar (LEL - Methane)</strong></td>
      <td><strong>Maksimal &lt; 10% LEL (Lower Explosive Limit)</strong></td>
      <td>Konsentrasi uap hidrokarbon atau gas metana yang jika mencapai titik nyala akan meledak dahsyat seketika ada percikan api gerinda atau saklar.</td>
    </tr>
    <tr>
      <td><strong>Gas Hidrogen Sulfida (H&sup2;S)</strong></td>
      <td><strong>Maksimal &lt; 10 ppm (Part Per Million)</strong></td>
      <td>Gas berbau telur busuk yang sangat mematikan di gorong-gorong/limbah; pada kadar &gt; 100 ppm melumpuhkan saraf penciuman seketika dan memicu henti napas mendadak.</td>
    </tr>
    <tr>
      <td><strong>Gas Karbon Monoksida (CO)</strong></td>
      <td><strong>Maksimal &lt; 25 ppm</strong></td>
      <td>Gas tak berwarna dan tak berbau dari sisa pembakaran genset/mesin; mengikat hemoglobin darah 200 kali lebih kuat dari oksigen, memicu sesak napas hening dan kematian.</td>
    </tr>
  </tbody>
</table>

<h2>Standar Prosedur Izin Kerja Masuk Ruang Terbatas (Entry Permit)</h2>
<p>Di Wahana Totalita Konsultan, peserta dilatih secara sistematis untuk menerapkan alur kerja keselamatan 5 tahap:</p>
<ol>
  <li><strong>Pembersihan &amp; Flushing (Purging):</strong> Menguras seluruh sisa cairan kimia atau hidrokarbon, kemudian melakukan pembilasan air atau inert gas (nitrogen) jika diperlukan.</li>
  <li><strong>Isolasi Energi Pipa &amp; Listrik (Positive Isolation):</strong> Memasang pelat buta (spade / blind flange) pada seluruh pipa pipa suplai fluida yang menuju ke tangki, serta menerapkan Lockout/Tagout (LOTO) pada motor pengaduk mixer (agitator).</li>
  <li><strong>Ventilasi Mekanis Berkelanjutan (Continuous Mechanical Ventilation):</strong> Menyalakan blower udara tekan positif (Explosion-Proof Blower Fan) untuk memasok udara segar secara terus-menerus ke dalam ruang kerja sepanjang aktivitas berlangsung.</li>
  <li><strong>Peralatan Komunikasi &amp; Pencahayaan Intrinsically Safe:</strong> Menggunakan lampu penerangan portable tegangan ekstra rendah (maksimal 24 Volt) dan handy-talkie (HT) berstandar anti-ledakan (Intrinsically Safe / ATEX Certified).</li>
  <li><strong>Sistem Penyelamatan Non-Entry Rescue:</strong> Pekerja yang masuk wajib mengenakan full body harness yang terpasang tali penyelamat (lifeline) yang terhubung ke katrol winch tripod penyelamat di atas manhole, sehingga evakuasi dapat ditarik dari luar tanpa penolong harus masuk ke dalam.</li>
</ol>

<h2>Fasilitas Pembinaan Ruang Terbatas di Wahana Totalita Konsultan</h2>
<p>Wahana Totalita Konsultan menyediakan sarana simulator tangki confined space modern untuk simulasi uji atmosfer gas riil, pelatihan evakuasi korban lemas menggunakan tripod rescue winch, serta pemakaian SCBA (Self-Contained Breathing Apparatus) berstandar internasional.</p>
<h2>Studi Kasus Pembelajaran: Tragedi di Tangki Limbah Pabrik Tekstil</h2>
<p>Sebuah insiden fatalitas ganda terjadi di sebuah pabrik tekstil di Jawa Barat ketika seorang pekerja operator IPAL ditugaskan membersihkan endapan lumpur di dasar bak ekualisasi sedalam 4 meter. Tanpa melakukan pengujian gas atmosfer dan tanpa izin kerja masuk (Entry Permit), pekerja tersebut turun melalui tangga monyet. Dalam waktu kurang dari satu menit, pekerja roboh pingsan akibat paparan gas Hidrogen Sulfida (H2S) berkonsentrasi tinggi yang terperangkap di dasar lumpur.</p>
<p>Dua rekan kerja di permukaan yang panik segera terjun ke dalam bak bermaksud menolong tanpa mengenakan masker SCBA maupun tali pengaman. Tragisnya, kedua penolong tersebut ikut kehilangan kesadaran dalam hitungan detik dan dinyatakan meninggal dunia di lokasi kejadian akibat keracunan gas akut. Tragedi memilukan ini adalah contoh nyata mengapa pelatihan kompetensi K3 Ruang Terbatas Kemnaker RI mutlak diwajibkan: untuk menanamkan pemahaman bahwa penolong tidak boleh menjadi korban berikutnya, dan setiap ruang terbatas wajib diperlakukan sebagai zona berbahaya mematikan sampai dibuktikan aman oleh detektor gas terkalibrasi.</p>
<p>Kementerian Ketenagakerjaan RI menegaskan bahwa investigasi kecelakaan ruang terbatas tidak hanya menyasar pekerja lapangan, tetapi juga meminta pertanggungjawaban hukum pengurus perusahaan dan pimpinan safety atas ketiadaan SOP, tidak tersedianya blower ventilasi, atau pembiaran personil tanpa sertifikasi resmi. Mengikuti pembinaan di Wahana Totalita Konsultan adalah langkah preventif paling cerdas untuk melindungi nyawa karyawan sekaligus reputasi korporasi dari jeratan hukum pidana ketenagakerjaan.</p>
"""

art9_faqs = [
    {
        "question": "Apakah seorang Petugas Madya boleh masuk ke dalam tangki untuk menolong rekannya yang pingsan?",
        "answer": "DILARANG KERAS. Aturan nomor satu bagi Petugas Madya (Standby Person) adalah tidak boleh masuk ke dalam ruang terbatas dalam kondisi darurat apa pun. Tugas utamanya adalah segera memicu alarm darurat, menghubungi Tim Emergency Rescue, dan melakukan evakuasi penarikan korban dari luar menggunakan tali tripod winch (Non-Entry Rescue)."
    },
    {
        "question": "Berapa lama masa berlaku Lisensi K3 Ruang Terbatas Kemnaker RI?",
        "answer": "Lisensi K3 Petugas Madya dan Petugas Utama Ruang Terbatas berlaku selama 3 (tiga) tahun sejak tanggal diterbitkan dan wajib diperpanjang secara berkala melalui PJK3 resmi."
    },
    {
        "question": "Bolehkah tabung gas elpiji atau genset ditaruh di dalam ruang terbatas saat pengelasan?",
        "answer": "Dilarang mutlak. Tabung gas bertekanan (LPG, Oksigen, Asetilen) dan mesin genset berbahan bakar bensin/solar wajib selalu diletakkan di luar ruangan terbatas di area terbuka. Hanya selang gas torch las dan kabel kerja yang boleh dimasukkan ke dalam ruangan."
    },
    {
        "question": "Apakah masker kain atau masker respirator debu cukup untuk masuk ke confined space?",
        "answer": "Sama sekali tidak cukup dan sangat berbahaya. Masker debu N95 tidak dapat melindungi dari gas beracun (H2S, CO) dan tidak dapat menambah oksigen di ruangan yang mengalami defisiensi oksigen. Di ruang terbatas berisiko tinggi, pekerja wajib menggunakan Supplied Air Respirator (SAR) atau SCBA."
    },
    {
        "question": "Berapa hari durasi pelatihan sertifikasi Confined Space di Wahana Totalita?",
        "answer": "Pelatihan berlangsung selama 3 hari kerja penuh (~30 Jam Pelajaran), mencakup teori regulasi Kepdirjen 113/2006, pengenalan instrumen gas detector, praktik isolasi ventilasi, dan simulasi penyelamatan darurat korban."
    }
]

# ==============================================================================
# ARTICLE 10: PANDUAN SERTIFIKASI TKBT II TKPK KEMNAKER
# ==============================================================================
art10_content = """

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
<p>Setiap pemasangan sistem lifeline horisontal wajib melalui pengujian beban statis (Proof Load Test) dan diverifikasi oleh Ahli K3 Bekerja di Ketinggian atau Pengawas Spesialis K3 Kemnaker RI. Dokumen sertifikasi jalur lifeline, perhitungan lendutan tali (sag calculation), serta riwayat inspeksi berkala wajib didokumentasikan dalam Buku Log Keselamatan Ketinggian perusahaan guna memastikan sistem siap menahan beban dinamis tanpa resiko keruntuhan struktur penyangga.</p>

<h2>Panduan Lengkap Sertifikasi Bekerja di Ketinggian: TKBT II vs TKPK Kemnaker RI</h2>
<p>Bekerja di ketinggian (Working at Height) diidentifikasi oleh Organisasi Perburuhan Internasional (ILO) dan Kementerian Ketenagakerjaan RI sebagai penyebab nomor satu kecelakaan kerja berkategori cedera fatal (kematian) di sektor konstruksi, pemeliharaan gedung bertingkat, telekomunikasi tower, dan fasilitas migas lepas pantai. Jatuh dari ketinggian hanya memerlukan waktu kurang dari 1 detik untuk menghantam tanah, namun dampaknya menghancurkan kehidupan pekerja dan menyeret perusahaan ke ranah hukum pidana kelalaian kerja.</p>

<p>Untuk menekan risiko maut ini, pemerintah menetapkan regulasi menyeluruh melalui <strong>Permenaker No. 09 Tahun 2016</strong>. Regulasi ini membagi kualifikasi pekerja ketinggian menjadi dua rumpun besar: <strong>Tenaga Kerja Bangunan Tinggi (TKBT)</strong> dan <strong>Tenaga Kerja Pada Ketinggian (TKPK / Rope Access)</strong>. Artikel ini mengupas secara tuntas perbedaan kedua sertifikasi ini, prinsip pencegah jatuh ABC, standar kelaikan Full Body Harness, serta panduan memilih sertifikasi yang tepat untuk kebutuhan karir dan korporasi Anda.</p>

<h2>Landasan Hukum Resmi: Permenaker No. 09 Tahun 2016</h2>
<p>Dasar hukum tertinggi keselamatan kerja ketinggian di Indonesia adalah <strong>Peraturan Menteri Ketenagakerjaan No. 09 Tahun 2016 tentang Keselamatan dan Kesehatan Kerja Dalam Pekerjaan Pada Ketinggian</strong>. Permenaker ini mendefinisikan pekerjaan pada ketinggian sebagai setiap kegiatan kerja yang dilakukan pada permukaan tanah atau perairan yang memiliki potensi bahaya jatuh akibat adanya perbedaan ketinggian <strong>sama dengan atau lebih dari 2 (dua) meter</strong>.</p>

<p>Permenaker 09/2016 Pasal 5 mewajibkan pengusaha dan pengurus tempat kerja menyediakan peralatan pencegah jatuh yang terstandarisasi, memastikan sistem angkur yang teruji beban, serta mempekerjakan personil yang memiliki <strong>Lisensi K3 Bekerja di Ketinggian</strong> resmi yang diterbitkan oleh Ditjen Binwasnaker &amp; K3 Kemnaker RI.</p>

<h2>Membedah 2 Rumpun Kualifikasi Ketinggian: TKBT vs TKPK</h2>
<p>Banyak pekerja dan HRD bingung memilih antara pelatihan TKBT dan TKPK. Berikut adalah pembedaan mendasarnya:</p>
<ul>
  <li><strong>TKBT (Tenaga Kerja Bangunan Tinggi):</strong> Dikhususkan bagi pekerja yang melakukan aktivitas di ketinggian pada <strong>struktur atau lantai kerja sementara yang memiliki pijakan fisik kokoh</strong> (seperti di atas perancah/scaffolding, lantai dek bekisting, platform catwalk, atap gedung, atau tangga bergerak) dengan memanfaatkan sistem penahan jatuh (Fall Arrest System).</li>
  <li><strong>TKPK (Tenaga Kerja Pada Ketinggian / Rope Access):</strong> Dikhususkan bagi teknisi yang bekerja pada posisi <strong>tergantung bebas di udara menggunakan sistem akses tali gantung (Rope Access)</strong> tanpa adanya lantai pijakan kaki di bawahnya (seperti pembersihan dinding kaca gedung pencakar langit, inspeksi flare tip cerobong migas, pengecatan jembatan bentang panjang, atau pemeliharaan turbin angin).</li>
</ul>

<h2>Tabel Komparasi Menyeluruh: TKBT Tingkat II vs TKPK Tingkat 1, 2, 3</h2>
<p>Berikut matriks perbandingan jenjang kualifikasi resmi Kemnaker RI:</p>

<table>
  <thead>
    <tr>
      <th>Kualifikasi Sertifikasi</th>
      <th>Metode Kerja Ketinggian</th>
      <th>Kualifikasi Pendidikan</th>
      <th>Durasi Pembinaan</th>
      <th>Ruang Lingkup Penugasan Kerja</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>TKBT Tingkat II</strong></td>
      <td>Bekerja pada struktur berpijakan tetap/sementara dengan lanyard peredam kejut.</td>
      <td>Minimal berpendidikan <strong>SD / SMP / Sederajat</strong></td>
      <td>3 Hari Kerja (~30 JPL)</td>
      <td>Pekerja konstruksi gedung, teknisi atap pabrik, perakitan scaffolding, pemeliharaan conveyor.</td>
    </tr>
    <tr>
      <td><strong>TKBT Tingkat I</strong></td>
      <td>Bekerja pada struktur berpijakan serta berwenang memasang sistem angkur horizontal dan lifeline.</td>
      <td>Minimal berpendidikan <strong>SMA / SMK Sederajat</strong></td>
      <td>4 Hari Kerja (~40 JPL)</td>
      <td>Mandor / Pengawas regu pekerja bangunan tinggi, instalatur jalur lifeline baja kawat atap.</td>
    </tr>
    <tr>
      <td><strong>TKPK Tingkat 1</strong></td>
      <td>Bekerja tergantung menggunakan 2 tali mandiri (Working Line &amp; Safety Line / Back-Up).</td>
      <td>Minimal berpendidikan <strong>SMP / Sederajat</strong></td>
      <td>5 Hari Kerja (~50 JPL)</td>
      <td>Teknisi akses tali lapangan (Rope Access Technician): cuci kaca gedung tinggi, inspeksi pipa offshore.</td>
    </tr>
    <tr>
      <td><strong>TKPK Tingkat 2</strong></td>
      <td>Merancang dan memasang sistem angkur akses tali yang kompleks serta memimpin regu kerja.</td>
      <td>Minimal berpendidikan <strong>SMA / SMK</strong> + Lisensi TKPK 1 aktif</td>
      <td>5 Hari Kerja (~50 JPL)</td>
      <td>Rigging lead, perancang sistem lintasan tali tebing/struktur rumit, penyelamatan tingkat menengah.</td>
    </tr>
    <tr>
      <td><strong>TKPK Tingkat 3</strong></td>
      <td>Penyusun rencana kerja keselamatan ketinggian, pengawas penuh, dan komandan regu Vertical Rescue.</td>
      <td>Minimal berpendidikan <strong>D3 / S1 Rumpun Teknik</strong> + Lisensi TKPK 2</td>
      <td>6 Hari Kerja (~60 JPL)</td>
      <td>HSE Manager proyek ketinggian, konsultan rope access, instruktur dan pimpinan operasi penyelamatan darurat.</td>
    </tr>
  </tbody>
</table>

<h2>Prinsip Keselamatan ABC Ketinggian (The ABC of Fall Protection)</h2>
<p>Dalam kurikulum pembinaan Wahana Totalita Konsultan, setiap personil ketinggian wajib menguasai segitiga perlindungan jatuh ABC:</p>
<ol>
  <li><strong>A - Anchorage (Titik Angkur):</strong> Titik tambat yang aman untuk menghubungkan tali penahan jatuh ke struktur kokoh. Sesuai standar EN 795 dan SNI, satu titik angkur personal wajib mampu menahan beban statis minimal <strong>15 Kilonewton (kN) atau setara dengan 1,5 Ton beban tarik</strong>.</li>
  <li><strong>B - Body Support (Penopang Tubuh):</strong> Penggunaan <em>Full Body Harness</em> berstandar EN 361. Penggunaan sabuk pinggang biasa (body belt) telah <strong>DILARANG MUTLAK</strong> oleh Kemnaker RI sejak 2016 karena jika terjadi jatuh, sabuk pinggang akan mematahkan tulang belakang pekerja dan menekan organ dalam tubuh.</li>
  <li><strong>C - Connecting Device (Perangkat Penghubung):</strong> Lanyard ganda berkait besar (Double Lanyard Big Hook) yang wajib dilengkapi dengan <strong>Peredam Kejut (Energy Absorber)</strong> berstandar EN 355. Peredam kejut berfungsi menyerap energi impak hentakan jatuh sehingga gaya yang diterima tubuh manusia dibatasi maksimal 6 kN (batas aman tulang rangka manusia).</li>
</ol>

<h2>Menghitung Jarak Jatuh Aman (Fall Clearance Calculation)</h2>
<p>Banyak pekerja memakai body harness dan mengaitkannya pada perancah, namun saat terjatuh tubuh mereka tetap membentur tanah di bawahnya. Mengapa? Karena mereka tidak memperhitungkan <strong>Total Jarak Jatuh Bebas (Fall Clearance)</strong>. Rumus perhitungan aman adalah:</p>
<p style="text-align:center; font-weight:bold; font-size:1.1em; background:#f3f4f6; padding:15px; border-radius:8px;">
Total Fall Clearance = Panjang Lanyard (1,8 m) + Robekan Absorber (1,2 m) + Jarak D-Ring ke Kaki Pekerja (1,5 m) + Faktor Keamanan Bebas / Safety Margin (1,0 m) = 5,5 Meter
</p>
<p>Artinya, jika seorang pekerja bekerja pada ketinggian <strong>di bawah 5,5 meter</strong> dari tanah, penggunaan lanyard peredam kejut standar berpotensi tidak sempat mengembang sebelum tubuh membentur lantai. Pada ketinggian rendah, solusi K3 yang tepat adalah menggunakan <em>Retractable Fall Arrester (SRL / Self-Retracting Lifeline)</em> yang mengunci otomatis dalam jarak jatuh &lt; 0,6 meter.</p>

<h2>Fasilitas Praktik Ketinggian di Wahana Totalita Konsultan</h2>
<p>Pelatihan sertifikasi TKBT dan TKPK Kemnaker RI di Wahana Totalita Konsultan diselenggarakan di Tower Training Center outdoor bersertifikasi. Peserta dibekali pemahaman simpul tali (Figure Eight, Alpine Butterfly), teknik peralihan dari tali ke tali (Rope to Rope Transfer), melewati rintangan simpul, serta simulasi penyelamatan rekan kerja yang tergantung pingsan (Suspension Trauma Rescue) dalam waktu &lt; 10 menit guna mencegah kematian akibat trauma suspensi.</p>
"""

art10_faqs = [
    {
        "question": "Apakah lulusan SMP boleh mengikuti sertifikasi TKBT Tingkat II Kemnaker RI?",
        "answer": "Bisa. Berdasarkan Permenaker No. 09 Tahun 2016, persyaratan pendidikan minimal untuk pembinaan Tenaga Kerja Bangunan Tinggi (TKBT) Tingkat II adalah berpendidikan minimal SMP atau sederajat, berbadan sehat, tidak memiliki riwayat fobia ketinggian (acrophobia), dan tidak buta warna."
    },
    {
        "question": "Berapa lama masa berlaku Lisensi K3 Bekerja di Ketinggian (TKBT/TKPK)?",
        "answer": "Lisensi K3 TKBT dan TKPK Kemnaker RI memiliki masa berlaku resmi selama 3 (tiga) tahun sejak tanggal diterbitkan. Sertifikat kompetensinya berlaku seumur hidup sebagai bukti penguasaan keterampilan."
    },
    {
        "question": "Apa itu sindrom trauma suspensi (Suspension Trauma) pada pekerja ketinggian?",
        "answer": "Suspension Trauma atau Orthostatic Shock adalah kondisi medis darurat mematikan yang terjadi saat seorang pekerja tergantung diam tidak bergerak pada harness pasca jatuh. Tekanan tali harness pada selangkangan paha membendung aliran darah vena kembali ke jantung, memicu hilangnya kesadaran dalam waktu 5-10 menit dan henti jantung jika tidak segera dievakuasi."
    },
    {
        "question": "Bolehkah saya langsung mengambil sertifikasi TKPK Tingkat 3 tanpa mengambil TKPK Tingkat 1?",
        "answer": "Tidak boleh. Sistem jenjang TKPK (Rope Access) bersifat berjenjang mutlak (prerequisite). Peserta wajib memulai dari TKPK Tingkat 1, kemudian mengumpulkan jam terbang kerja di buku log minimal 500 jam dan masa kerja 1 tahun sebelum diizinkan mendaftar ke TKPK Tingkat 2, dan demikian seterusnya menuju TKPK Tingkat 3."
    },
    {
        "question": "Apakah peserta pelatihan mendapatkan lisensi kartu K3 resmi Kemnaker RI?",
        "answer": "Ya, setelah lulus evaluasi tertulis dan ujian praktik lapangan oleh pengawas ketenagakerjaan Kemnaker RI, peserta menerima Sertifikat Pembinaan resmi, Surat Keputusan Penunjukan (SKP), Kartu Lisensi Kewenangan K3, dan Buku Kerja Ketinggian resmi Kemnaker RI."
    }
]

articles_data_batch2 = [
    {
        "slug": "cara-mendapatkan-sio-lisensi-k3-operator-forklift-kemnaker",
        "title": "Cara Mendapatkan SIO Forklift Kemnaker RI 2026: Syarat, Kelas I vs II, & Biaya Resmi",
        "meta_title": "Cara Mendapatkan SIO Forklift Kemnaker 2026: Syarat, Kelas I vs II, & Biaya Resmi",
        "meta_desc": "Panduan resmi cara mendapatkan SIO / Lisensi K3 Operator Forklift Kemnaker RI 2026. Syarat Kelas I & II, materi uji praktik, stabilitas unit & prosedur perpanjangan.",
        "keywords": "cara mendapatkan sio forklift kemnaker, syarat operator forklift kelas 1 2, biaya sertifikasi sio forklift resmi, permenaker 08 2020 forklift, lisensi k3 forklift yogyakarta",
        "content": art6_content.strip(),
        "faq_data": art6_faqs
    },
    {
        "slug": "standar-k3-scaffolding-kualifikasi-teknisi-inspeksi-perancah",
        "title": "Standar K3 Scaffolding: Kualifikasi Teknisi, Supervisi, & Inspeksi Kelaikan Perancah",
        "meta_title": "Standar K3 Scaffolding: Kualifikasi Teknisi, Supervisi, & Inspeksi Perancah",
        "meta_desc": "Panduan lengkap standar K3 scaffolding sesuai Permenaker 01/1980 & SKB 2 Menteri. Kualifikasi teknisi, scafftag hijau/kuning/merah, inspeksi SWL & sertifikasi resmi.",
        "keywords": "standar k3 scaffolding kemnaker, sertifikasi teknisi perancah scaffolder, supervisi perancah kemnaker, scafftag hijau kuning merah, permenaker 01 1980 k3 konstruksi",
        "content": art7_content.strip(),
        "faq_data": art7_faqs
    },
    {
        "slug": "panduan-sertifikasi-ahli-k3-listrik-teknisi-k3-listrik-kemnaker",
        "title": "Panduan Sertifikasi Ahli K3 Listrik & Teknisi K3 Listrik Kemnaker RI (Permenaker 12/2015)",
        "meta_title": "Panduan Sertifikasi Ahli K3 Listrik & Teknisi K3 Listrik Kemnaker RI",
        "meta_desc": "Kupas tuntas syarat & perbedaan Teknisi K3 Listrik vs Ahli K3 Listrik Permenaker 12/2015. Prosedur LOTO, pengukuran grounding PUIL 2011 & info sertifikasi resmi 2026.",
        "keywords": "sertifikasi ahli k3 listrik kemnaker, teknisi k3 listrik permenaker 12 2015, syarat kepdirjen 48 2015 listrik, prosedur loto k3 listrik, riksa uji instalasi listrik puil 2011",
        "content": art8_content.strip(),
        "faq_data": art8_faqs
    },
    {
        "slug": "kewajiban-sertifikasi-teknisi-confined-space-ruang-terbatas",
        "title": "Kewajiban Sertifikasi Teknisi Ruang Terbatas (Confined Space) Kemnaker RI",
        "meta_title": "Kewajiban Sertifikasi Teknisi Ruang Terbatas (Confined Space) Kemnaker RI",
        "meta_desc": "Panduan keselamatan kerja ruang terbatas Kepdirjen 113/2006. Perbedaan Petugas Madya vs Utama, ambang batas gas O2 H2S CO LEL, entry permit & sertifikasi Kemnaker.",
        "keywords": "sertifikasi confined space kemnaker, petugas madya ruang terbatas, petugas utama confined space, batas gas h2s co confined space, kepdirjen 113 2006 ruang terbatas",
        "content": art9_content.strip(),
        "faq_data": art9_faqs
    },
    {
        "slug": "panduan-sertifikasi-tkbt-ii-tkpk-kemnaker-pekerja-ketinggian",
        "title": "Panduan Lengkap Sertifikasi Ketinggian: Perbedaan TKBT II vs TKPK Kemnaker RI",
        "meta_title": "Panduan Lengkap Sertifikasi Ketinggian: Perbedaan TKBT II vs TKPK Kemnaker RI",
        "meta_desc": "Bandingkan syarat & jenjang sertifikasi ketinggian Permenaker 09/2016: TKBT Tingkat II vs TKPK 1 2 3 (Rope Access). Rumus fall clearance, APD harness & info kursus resmi.",
        "keywords": "perbedaan tkbt dan tkpk kemnaker, sertifikasi tkbt tingkat 2, tkpk tingkat 1 rope access, permenaker 09 2016 bekerja ketinggian, kursus safety ketinggian yogyakarta",
        "content": art10_content.strip(),
        "faq_data": art10_faqs
    }
]

def main():
    print("=== DEEP REWRITE BATCH 6 TO 10 (Target: >= 1,500 words per article) ===")
    for item in articles_data_batch2:
        words = count_words(item["content"])
        print(f"\nProcessing: {item['slug']}")
        print(f"Content Word Count: {words} words | FAQs: {len(item['faq_data'])}")
        
        res = put_article(item["slug"], {
            "title": item["title"],
            "meta_title": item["meta_title"],
            "meta_desc": item["meta_desc"],
            "keywords": item["keywords"],
            "content": item["content"],
            "faq_data": item["faq_data"]
        })
        print("API Response:", res.get("message", res))

if __name__ == "__main__":
    main()
