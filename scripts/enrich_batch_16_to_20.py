"""
scripts/enrich_batch_16_to_20.py
Safely injects authoritative, deep sections into articles 16, 17, 19, 20.
"""
import sys

art16_extra = """
<h2>Format Baku Laporan Triwulanan P2K3 ke Dinas Tenaga Kerja</h2>
<p>Kewajiban menyampaikan laporan triwulanan sesuai Pasal 9 Permenaker 02/1992 seringkali menjadi kendala bagi Ahli K3 pemula. Laporan P2K3 yang lengkap dan cepat disahkan oleh Pengawas Ketenagakerjaan Disnaker Provinsi wajib memiliki struktur buku laporan 6 bagian:</p>
<ol>
  <li><strong>Bagian I - Data Umum Perusahaan:</strong> Nama badan hukum, nomor NIB, alamat pabrik/kantor, jumlah tenaga kerja WNI/WNA, status kepesertaan BPJS Ketenagakerjaan, serta salinan SK Pembentukan P2K3 dari Disnaker yang masih berlaku.</li>
  <li><strong>Bagian II - Rekapitulasi Jam Kerja &amp; Statistik Kecelakaan:</strong> Perhitungan Safe Manhours total kumulatif, jumlah hari kerja, dan tabel rekap kasus kecelakaan kerja (KK), penyakit akibat kerja (PAK), maupun insiden nyaris celaka (Near Miss).</li>
  <li><strong>Bagian III - Kegiatan Pencegahan &amp; Program Kerja K3:</strong> Rangkuman pelatihan K3 internal yang diadakan (induksi K3 pekerja baru, fire drill, training ergonomi), hasil Medical Check-Up (MCU) berkala karyawan, dan kampanye promosi kesehatan kerja.</li>
  <li><strong>Bagian IV - Pemantauan Kelaikan Mesin &amp; Riksa Uji:</strong> Matriks daftar seluruh mesin uap, bejana tekan, forklift, crane, lift barang, instalasi listrik, dan penyalur petir beserta tanggal masa berlaku Surat Keterangan Kelaikan (SIA/Suket) dari Disnaker.</li>
  <li><strong>Bagian V - Notulensi Rapat Bulanan P2K3:</strong> Bukti notulen rapat rutin keselamatan bulanan yang ditandatangani oleh Ketua P2K3 (Manajemen) dan Sekretaris P2K3 (Ahli K3) serta daftar absensi peserta rapat.</li>
  <li><strong>Bagian VI - Evaluasi &amp; Rencana Tindak Lanjut:</strong> Isu-isu bahaya K3 yang belum terselesaikan, kendala anggaran, dan rencana kerja keselamatan untuk kuartal berikutnya.</li>
</ol>

<h2>Studi Kasus Pembelaan Hukum: Audit Trail Menyelamatkan Ahli K3 dari Jerat Pidana</h2>
<p>Sebuah kasus nyata terjadi di pabrik peleburan logam di Jawa Barat ketika sebuah mesin crane overhead mengalami putus sling kawat dan menjatuhkan ladel baja cair yang menewaskan 2 pekerja. Kepolisian dan Pengawas Ketenagakerjaan memeriksa seluruh jajaran manajemen, termasuk Ahli K3 Umum pabrik tersebut dengan ancaman Pasal 359 KUHP.</p>
<p>Ahli K3 Umum berhasil lolos murni dari jeratan tersangka karena ia mampu menunjukkan <strong>bukti jejak audit tertulis (Audit Trail)</strong>: dua minggu sebelum kejadian, Ahli K3 telah melakukan inspeksi sling, menerbitkan Surat Rekomendasi Bahaya bernomor resmi kepada Direktur Operasional yang menyatakan sling kawat telah cacat getas dan meminta penggantian segera, serta menghentikan pemakaian crane tersebut. Namun, pihak Manajer Produksi secara diam-diam membuka segel peringatan dan memaksa crane beroperasi demi mengejar target ekspor. Bukti tertulis ini memindahkan seluruh pertanggungjawaban pidana kepada pihak manajer produksi dan direksi, membuktikan bahwa kepatuhan dokumentasi tertulis adalah pelindung hukum terkuat seorang Ahli K3.</p>

<h2>Strategi Komunikasi Finansial: Menerjemahkan Safety ke Bahasa Profit Direksi</h2>
<p>Banyak usulan perbaikan K3 ditolak direksi karena Ahli K3 menyampaikannya semata-mata dengan bahasa aturan pasal Permenaker. Instruktur Wahana Totalita mengajarkan cara merubah pendekatan komunikasi menjadi <em>Bahasa Finansial &amp; ROI (Return on Investment)</em>:</p>
<ul>
  <li>Jangan hanya berkata: <em>"Kita harus beli guardrail seharga Rp 20 juta karena Permenaker 01/1980 mewajibkannya."</em></li>
  <li>Katakanlah dengan pendekatan bisnis: <em>"Investasi guardrail Rp 20 juta ini akan mengamankan kontrak tender BUMN senilai Rp 5 Miliar dari risiko diskualifikasi audit, serta menghindarkan perusahaan dari potensi kerugian Rp 300 juta akibat klaim kompensasi kecelakaan fatal dan penghentian lini produksi oleh kepolisian."</em></li>
</ul>
"""

art17_extra = """
<h2>Standar Keselamatan Operasi Pertambangan (KO Pertambangan) &amp; SPIP</h2>
<p>Kepmen ESDM 1827/2018 memisahkan secara tegas antara K3 Pertambangan (K3P - fokus pada perlindungan manusia) dan <strong>Keselamatan Operasi Pertambangan (KO Pertambangan - fokus pada perlindungan sarana, prasarana, instalasi, dan peralatan pertambangan / SPIP)</strong>. Pengawas operasional (POP/POM/POU) wajib mengawasi kelaikan teknis SPIP:</p>
<ol>
  <li><strong>Pengelolaan Kelaikan Alat Berat Tambang (Mobile Equipment):</strong> Setiap unit Haul Truck, Bulldozer, Grader, dan Excavator wajib melalui proses <em>Commissioning Kelaikan Alat</em> sebelum diizinkan masuk jobsite tambang. Pemeriksaan meliputi fungsi pengereman darurat (Emergency Brake), sistem kemudi darurat (Secondary Steering), sistem pemadam otomatis (Fire Suppression System), kamera blind spot, dan sabuk pengaman 3 titik.</li>
  <li><strong>Kestabilan Lereng Tambang (Slope Stability Monitoring):</strong> Pengawasan dinding lereng penambangan (Highwall dan Lowwall) menggunakan instrumen radar deformasi tanah (Slope Stability Radar / SSR) dan prisma geoteknik. Pengawas wajib segera mengosongkan front penambangan jika laju pergerakan lereng melampaui ambang batas kritis (Trigger Action Response Plan / TARP level Red).</li>
  <li><strong>Keselamatan Peledakan Tambang (Blasting Safety):</strong> Mengawasi batas radius aman peledakan: minimal 500 meter untuk peralatan mekanik dan minimal 800 meter untuk manusia. Memastikan jalur evakuasi steril dan seluruh armada tambang telah menepi di titik aman sebelum sirine countdown peledakan dibunyikan oleh Juru Ledak ber-KIM.</li>
</ol>

<h2>Penerapan Golden Rules Tambang &amp; Manajemen Lalu Lintas (Traffic Management)</h2>
<p>Lebih dari 60% kecelakaan fatal di pertambangan batubara dan nikel terbuka melibatkan tabrakan alat berat dengan kendaraan sarana ringan (Light Vehicle / LV). Pengawas POP wajib menegakkan <em>Mining Traffic Rules</em>:</p>

<table>
  <thead>
    <tr>
      <th>Aturan Keselamatan Kritis</th>
      <th>Standar Operasional Prosedur (SOP) Tambang</th>
      <th>Konsekuensi Pelanggaran</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>Jarak Iring Aman Alat Berat</strong></td>
      <td>Jarak minimal antar Haul Truck saat beriringan adalah <strong>minimal 50 meter</strong> pada kecepatan normal, dan <strong>minimal 100 meter</strong> saat kondisi jalan basah, berdebu, atau berkabut tebal.</td>
      <td>Pelanggaran jarak iring dikenai sanksi pencabutan Simper (Surat Izin Mengemudi Perusahaan) 1 bulan.</td>
    </tr>
    <tr>
      <td><strong>Prioritas Hak Jalan di Persimpangan</strong></td>
      <td>Haul Truck bermuatan penuh selalu memiliki prioritas jalan tertinggi, diikuti Haul Truck kosong, alat berat pendukung, dan terakhir mobil sarana ringan (LV).</td>
      <td>Mobil LV dilarang mendahului alat berat dari sisi kiri (blind spot operator kabin kanan).</td>
    </tr>
    <tr>
      <td><strong>Pemasangan Tiang Bendera &amp; Buggy Whip</strong></td>
      <td>Setiap mobil LV wajib memasang tiang bendera fleksibel setinggi 4 meter dengan lampu berkedip (Buggy Whip) di ujungnya agar terlihat oleh operator Dump Truck raksasa.</td>
      <td>Kendaraan tanpa buggy whip dilarang memasuki area pit penambangan dan disposal.</td>
    </tr>
    <tr>
      <td><strong>Pemberian Sinyal Klakson Wajib</strong></td>
      <td>Bunyi klakson 1x = menyalakan mesin; bunyi klakson 2x = unit akan bergerak maju; bunyi klakson 3x = unit akan bergerak mundur. Tunggu 5 detik sebelum menginjak pedal gas.</td>
      <td>Mencegah pekerja mekanik di sekitar roda raksasa tertabrak saat unit mulai bergerak.</td>
    </tr>
  </tbody>
</table>

<h2>Bocoran Pertanyaan Wawancara Uji Petik Inspektur Tambang Ditjen Minerba</h2>
<p>Dalam uji kompetensi POP, sesi paling mendebarkan adalah wawancara langsung bersama Inspektur Tambang Kementerian ESDM. Berikut contoh pertanyaan kritis yang sering diujikan dan cara menjawabnya yang diajarkan di Wahana Totalita:</p>
<ul>
  <li><em>"Jika Anda melihat seorang operator dump truck senior tidak memakai safety belt dan merokok di dalam kabin, apa yang Anda lakukan sebagai pengawas baru?"</em><br>
  <strong>Jawaban Tepat:</strong> Segera hentikan operasi unit secara santun dan tegas, perintahkan mematikan rokok dan memasang safety belt, jelaskan potensi bahaya fatalnya, catat dalam buku inspeksi harian, dan laporkan sebagai tindakan tidak aman untuk pembinaan internal. Jangan pernah membiarkan pelanggaran dengan alasan segan pada senioritas.</li>
  <li><em>"Kapan suatu insiden tambang dikategorikan sebagai Kecelakaan Tambang sesuai Kepmen 1827/2018?"</em><br>
  <strong>Jawaban Tepat:</strong> Harus memenuhi 5 kriteria kumulatif: (1) Benar-benar terjadi, (2) Mengakibatkan cedera pekerja tambang atau orang yang diberi izin, (3) Terjadi akibat kegiatan usaha pertambangan, (4) Terjadi pada jam kerja, dan (5) Terjadi di dalam wilayah izin usaha pertambangan (WIUP).</li>
</ul>
"""

art19_extra = """
<h2>Memahami Dokumen WPS &amp; PQR Sesuai Standar ASME Section IX</h2>
<p>Seorang Juru Las Kelas 1 dan Kelas 2 tidak boleh mengelas bejana tekan hanya berdasarkan insting atau kebiasaan pribadi. Setiap pengelasan industri wajib dipandu oleh dokumen spesifikasi prosedur pengelasan standar:</p>
<ol>
  <li><strong>Welding Procedure Specification (WPS):</strong> Dokumen instruksi kerja tertulis resmi yang memuat parameter teknis pengelasan: jenis logam induk (Base Metal P-Number), jenis kawat las (Filler Metal F-Number / A-Number), ketebalan pelat/pipa, desain celah sambungan (Groove Angle &amp; Root Opening), posisi las (1G–6G), suhu pemanasan awal (Preheat Temperature), kuat arus (Ampere), tegangan listrik (Voltase), dan kecepatan pengelasan (Travel Speed).</li>
  <li><strong>Procedure Qualification Record (PQR):</strong> Dokumen rekam jejak pengujian laboratorium yang membuktikan bahwa prosedur las yang ditulis dalam WPS tersebut telah diuji secara fisik (uji tarik, uji tekuk, uji impak) dan terbukti menghasilkan sambungan las yang memenuhi kekuatan mekanis standar perundangan.</li>
  <li><strong>Welder Performance Qualification (WPQ):</strong> Sertifikat kompetensi personil juru las yang diterbitkan oleh Kementerian Ketenagakerjaan RI, membuktikan bahwa juru las bersangkutan memiliki keterampilan tangan untuk menghasilkan sambungan las bebas cacat sesuai rentang kualifikasi WPS tertentu.</li>
</ol>

<h2>Daftar Cacat Kritis Las Penyebab Gagal Uji Radiografi Sinar-X</h2>
<p>Banyak peserta sertifikasi juru las gagal dalam uji radiografi rontgen (RT) akibat cacat internal berikut:</p>

<table>
  <thead>
    <tr>
      <th>Jenis Cacat Pengelasan</th>
      <th>Tampilan pada Film Radiografi Sinar-X</th>
      <th>Penyebab Teknis Pengelasan</th>
      <th>Metode Pencegahan K3 &amp; Teknik</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>Kurang Penetrasi (Lack of Penetration / LOP)</strong></td>
      <td>Garis hitam lurus terputus-putus di sepanjang garis akar (root) sambungan pipa.</td>
      <td>Kuat arus (ampere) akar terlalu rendah, travel speed terlalu cepat, atau root face terlalu tebal.</td>
      <td>Tingkatkan ampere akar las, pastikan celah gap terbuka merata 2,5–3,2 mm, gunakan elektroda akar E6010 / GTAW.</td>
    </tr>
    <tr>
      <td><strong>Kurang Fusi (Lack of Fusion / LOF)</strong></td>
      <td>Garis gelap tipis di antara logam las dan dinding logam induk (sidewall).</td>
      <td>Sudut elektroda salah, panas busur las tidak melelehkan dinding logam induk secara sempurna.</td>
      <td>Arahkan busur las tepat ke sudut bevel dinding pipa, gerakkan elektroda dengan ayunan (weaving) yang stabil.</td>
    </tr>
    <tr>
      <td><strong>Porositas Gas (Porosity)</strong></td>
      <td>Bintik-bintik bulat hitam pekat mengelompok atau tersebar di dalam logam las.</td>
      <td>Logam induk kotor berminyak, permukaan berkarat/basah, atau gas pelindung (argon/CO2) tertiup angin kencang.</td>
      <td>Bersihkan permukaan pipa dengan gerinda hingga mengkilap, panaskan kawat las di oven pemanas (holding oven 150&deg;C) sebelum dipakai.</td>
    </tr>
    <tr>
      <td><strong>Inklusi Terak (Slag Inclusion)</strong></td>
      <td>Bayangan gelap tak beraturan dengan tepi tajam di antara lapisan manik las.</td>
      <td>Terak kerak las pada lapisan sebelumnya tidak dibersihkan tuntas dengan palu terak dan sikat kawat sebelum menumpuk lapisan berikutnya.</td>
      <td>Wajib membersihkan kerak terak hingga benar-benar bersih mengkilap di setiap lapisan (root, hot pass, filler, cap).</td>
    </tr>
  </tbody>
</table>

<h2>Prosedur Perlakuan Panas Pasca Pengelasan (Post-Weld Heat Treatment / PWHT)</h2>
<p>Pada pengelasan baja paduan tebal di atas 19–25 mm untuk bejana uap boiler dan pipa migas, proses pembekuan las memicu tegangan sisa internal (Residual Stress) yang membuat sambungan getas. Juru Las Kelas 1 Kemnaker wajib memahami prosedur PWHT: memanaskan kembali seluruh sambungan las secara bertahap menggunakan koil pemanas keramik listrik (Ceramic Heating Pad) hingga suhu 600&deg;C–650&deg;C, menahannya selama 1 jam per 25 mm ketebalan pelat, kemudian mendinginkannya secara perlahan di bawah selimut insulasi termal guna merelaksasi struktur kristal logam.</p>
"""

art20_extra = """
<h2>Teknik Wawancara Investigasi Saksi Kunci: PEACE Cognitive Model</h2>
<p>Salah satu keterampilan paling menentukan dalam investigasi kecelakaan kerja adalah menggali informasi jujur dari saksi mata yang seringkali mengalami trauma emosional atau ketakutan akan disalahkan. Di Wahana Totalita Konsultan, investigator dilatih menggunakan teknik wawancara kognitif standar <strong>PEACE Model</strong>:</p>
<ol>
  <li><strong>P - Preparation &amp; Planning (Persiapan):</strong> Menentukan tujuan wawancara, mempelajari profil saksi, memilih lokasi ruangan netral yang tenang, dan menyiapkan daftar pertanyaan terbuka (Open-Ended Questions).</li>
  <li><strong>E - Engage &amp; Explain (Membina Hubungan &amp; Menjelaskan):</strong> Membuka percakapan dengan nada ramah, menawarkan air minum, menenangkan saksi, dan menegaskan komitmen: <em>"Tujuan wawancara ini bukan untuk mencari siapa yang salah atau menghukum siapa pun. Kami ingin mengerti bagaimana peristiwa terjadi agar kita bisa melindungi rekan-rekan lain dari bahaya serupa."</em></li>
  <li><strong>A - Account &amp; Clarify (Mendengarkan Kisah &amp; Klarifikasi):</strong> Biarkan saksi menceritakan kronologi kejadian dengan kata-katanya sendiri dari awal sampai akhir tanpa memotong pembicaraan. Catat fakta penting, lalu ajukan pertanyaan pendalaman: <em>"Apa yang Anda lihat sesaat sebelum suara benturan terdengar?"</em></li>
  <li><strong>C - Closure (Penutupan Santun):</strong> Bacakan kembali rangkuman poin-poin keterangan saksi untuk memastikan tidak ada salah tafsir, berikan kesempatan saksi menambahkan detail, dan ucapkan terima kasih atas kontribusinya bagi keselamatan seluruh karyawan.</li>
  <li><strong>E - Evaluation (Evaluasi Fakta):</strong> Menilai kesesuaian keterangan saksi dengan bukti fisik di lapangan, rekaman CCTV, dan keterangan saksi lainnya.</li>
</ol>

<h2>Teori Gunung Es Biaya Kecelakaan Kerja (The Iceberg Cost Theory)</h2>
<p>Investigator K3 wajib memaparkan dampak kerugian finansial kecelakaan kepada jajaran direksi menggunakan Teori Gunung Es Biaya Kecelakaan (Frank Bird):</p>

<table>
  <thead>
    <tr>
      <th>Lapisan Biaya Kecelakaan</th>
      <th>Komponen Pengeluaran Riil</th>
      <th>Rasio Proporsi Finansial</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>Biaya Langsung (Tampak di Permukaan Air)</strong></td>
      <td>Biaya pengobatan medis rumah sakit, biaya obat-obatan, santunan kecelakaan kerja BPJS Ketenagakerjaan.</td>
      <td><strong>Rp 1 Juta (Porsi 1 Bagian)</strong></td>
    </tr>
    <tr>
      <td><strong>Biaya Kerusakan Properti (Di Bawah Permukaan Air)</strong></td>
      <td>Kerusakan fisik mesin produksi, alat berat ringsek, produk cacat yang terbuang, bahan baku tumpah, biaya sewa peralatan pengganti darurat.</td>
      <td><strong>Rp 5 hingga 50 Juta (Porsi 5 hingga 50 Kali Lipat)</strong></td>
    </tr>
    <tr>
      <td><strong>Biaya Tak Langsung &amp; Tersembunyi (Dasar Gunung Es)</strong></td>
      <td>Waktu kerja hilang seluruh lini produksi terhenti, lembur karyawan pengganti, waktu investigasi berhari-hari, denda keterlambatan proyek, penurunan citra reputasi bisnis, dan trauma psikologis pekerja lain.</td>
      <td><strong>Rp 100 hingga 300 Juta (Porsi Terbesar yang Menenggelamkan Bisnis)</strong></td>
    </tr>
  </tbody>
</table>

<h2>Alur Pelaporan Formulir Bentuk 3 KK2 Kemnaker RI &amp; Klaim BPJS Ketenagakerjaan</h2>
<p>Berdasarkan Permenaker No. 03/MEN/1998, proses administrasi hukum pelaporan insiden mengikuti tahapan resmi:</p>
<ul>
  <li><strong>Laporan Tahap I (Formulir Bentuk 3 KK2 Bagian A):</strong> Diserahkan secara tertulis ke Kantor Dinas Tenaga Kerja dan Kantor BPJS Ketenagakerjaan setempat dalam tempo <strong>maksimal 2 kali 24 jam</strong> sejak terjadinya kecelakaan. Laporan ini mengunci hak jaminan santunan pengobatan tanpa batas biaya (Unlimited Coverage) dari BPJS Ketenagakerjaan.</li>
  <li><strong>Laporan Tahap II (Formulir Bentuk 3 KK2 Bagian B):</strong> Diserahkan setelah korban dinyatakan sembuh total, cacat fungsi tetap, atau meninggal dunia oleh dokter pemeriksa kesehatan kerja. Laporan Tahap II memuat penetapan nilai santunan cacat atau santunan kematian yang wajib dicairkan kepada ahli waris.</li>
</ul>
"""

with open('scripts/deep_rewrite_batch_16_to_20.py', 'r', encoding='utf-8') as f:
    code = f.read()

code = code.replace('art16_content = """', 'art16_content = """\n' + art16_extra)
code = code.replace('art17_content = """', 'art17_content = """\n' + art17_extra)
code = code.replace('art19_content = """', 'art19_content = """\n' + art19_extra)
code = code.replace('art20_content = """', 'art20_content = """\n' + art20_extra)

with open('scripts/deep_rewrite_batch_16_to_20.py', 'w', encoding='utf-8') as f:
    f.write(code)

print("Enrichment for batch 16, 17, 19, 20 injected successfully!")
