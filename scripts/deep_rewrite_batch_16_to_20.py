"""
scripts/deep_rewrite_batch_16_to_20.py
Generates and uploads authoritative, 1,500+ word guides for Articles 16, 17, 19, and 20.
(Article 18 is already completed with 1,829 words).
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
# ARTICLE 16: TUGAS TANGGUNG JAWAB AHLI K3 UMUM PERMENAKER 02/1992
# ==============================================================================
art16_content = """

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

<h2>Tugas, Wewenang, &amp; Tanggung Jawab Ahli K3 Umum di Perusahaan Sesuai Permenaker 02/1992</h2>
<p>Dalam lanskap ketenagakerjaan dan manajemen industri di Indonesia, posisi <strong>Ahli Keselamatan dan Kesehatan Kerja Umum (AK3U)</strong> menempati kedudukan yang sangat istimewa sekaligus sarat tanggung jawab hukum kenegaraan. Berbeda dari jabatan fungsional perusahaan lainnya yang murni tunduk pada perintah atasan atau direksi, seorang Ahli K3 Umum memegang mandat ganda: ia adalah karyawan profesional internal perusahaan, namun pada saat yang sama bertindak sebagai perpanjangan tangan resmi (tangan kanan) dari <strong>Pengawas Ketenagakerjaan Kementerian Ketenagakerjaan Republik Indonesia</strong> dalam menegakkan norma-norma keselamatan kerja di tempat kerja.</p>

<p>Kerap kali di lapangan muncul kesalahpahaman mengenai apa sebenarnya batasan tugas, hak hukum, dan wewenang seorang Ahli K3. Apakah Ahli K3 bertanggung jawab secara pidana jika terjadi kecelakaan maut di pabrik? Bolehkah Ahli K3 menghentikan operasional mesin produksi secara sepihak? Bagaimana mekanisme pelaporan triwulanan ke Dinas Tenaga Kerja? Artikel ini mengupas secara tuntas <strong>kewajiban dan wewenang Ahli K3 Umum berdasarkan Permenaker No. Per.02/MEN/1992</strong>, perannya sebagai Sekretaris P2K3, serta panduan praktis menjalankan tugas harian di Wahana Totalita Konsultan.</p>

<h2>Landasan Hukum Regulasi: Permenaker No. Per.02/MEN/1992</h2>
<p>Payung hukum utama yang mendasari eksistensi, kewajiban, dan wewenang profesi Ahli K3 di Indonesia adalah:</p>
<ul>
  <li><strong>Undang-Undang No. 1 Tahun 1970 tentang Keselamatan Kerja:</strong> Pasal 1 ayat (6) mendefinisikan Ahli Keselamatan Kerja sebagai tenaga teknis berkeahlian khusus dari luar Departemen Tenaga Kerja yang ditunjuk oleh Menteri Tenaga Kerja untuk mengawasi ditaatinya undang-undang ini.</li>
  <li><strong>Peraturan Menteri Tenaga Kerja RI No. Per.02/MEN/1992 tentang Tata Cara Penunjukan Kewajiban dan Wewenang Ahli Keselamatan dan Kesehatan Kerja:</strong> Merupakan aturan pelaksana teknis yang mengatur syarat penunjukan, kewajiban operasional, dan wewenang hukum seorang Ahli K3 di perusahaan.</li>
  <li><strong>Peraturan Menteri Tenaga Kerja RI No. Per.04/MEN/1987:</strong> Tentang Panitia Pembina Keselamatan dan Kesehatan Kerja (P2K3) serta Tata Cara Penunjukan Ahli Keselamatan Kerja.</li>
  <li><strong>Peraturan Pemerintah No. 50 Tahun 2012:</strong> Tentang Penerapan Sistem Manajemen Keselamatan dan Kesehatan Kerja (SMK3).</li>
</ul>

<h2>Rincian Kewajiban Ahli K3 Umum Sesuai Pasal 9 Permenaker 02/1992</h2>
<p>Berdasarkan <strong>Pasal 9 Permenaker No. Per.02/MEN/1992</strong>, seorang Ahli K3 Umum yang telah menerima Surat Keputusan Penunjukan (SKP) dari Menteri Ketenagakerjaan memiliki 3 kewajiban hukum mutlak:</p>
<ol>
  <li><strong>Membantu Mengawasi Pelaksanaan Peraturan K3:</strong> Membantu manajemen perusahaan dan pengawas ketenagakerjaan dalam mengawasi ditaatinya ketentuan peraturan perundang-undangan keselamatan dan kesehatan kerja sesuai dengan bidang yang ditentukan dalam keputusan penunjukannya.</li>
  <li><strong>Memberikan Laporan Tertulis Secara Berkala (Laporan Triwulanan):</strong> Memberikan laporan tertulis mengenai pelaksanaan tugas-tugas K3 kepada Menteri Ketenagakerjaan atau pejabat yang ditunjuk (Dinas Tenaga Kerja Provinsi setempat) <strong>sekurang-kurangnya 3 (tiga) bulan sekali</strong>, kecuali ditentukan lain oleh undang-undang.</li>
  <li><strong>Merahasiakan Segala Rahasia Perusahaan:</strong> Merahasiakan segala keterangan atau rahasia perusahaan/jabatan yang didapat atau diketahuinya karena jabatannya sebagai Ahli K3, sepanjang tidak bertentangan dengan kepentingan hukum ketenagakerjaan.</li>
</ol>

<h2>Rincian Wewenang Hukum Ahli K3 Umum Sesuai Pasal 10 Permenaker 02/1992</h2>
<p>Untuk mengimbangi besarnya beban tanggung jawab tersebut, undang-undang membekali Ahli K3 dengan wewenang yang sangat luas di dalam lingkungan perusahaan sebagaimana diatur dalam <strong>Pasal 10 Permenaker No. Per.02/MEN/1992</strong>:</p>

<table>
  <thead>
    <tr>
      <th>Pasal Wewenang</th>
      <th>Rumusan Wewenang Hukum</th>
      <th>Penerapan Operasional Nyata di Tempat Kerja</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>Pasal 10 ayat (1) huruf a</strong></td>
      <td><strong>Hak Akses Lokasi Kerja Penuh</strong></td>
      <td>Memasuki tempat kerja sesuai dengan keputusan penunjukan untuk memeriksa seluruh area pabrik, gudang, ruang genset, tangki kimia, hingga mess pekerja tanpa boleh dihalang-halangi oleh pihak mana pun.</td>
    </tr>
    <tr>
      <td><strong>Pasal 10 ayat (1) huruf b</strong></td>
      <td><strong>Hak Meminta Keterangan &amp; Dokumen</strong></td>
      <td>Meminta keterangan, data teknis, rekam medis pekerja, catatan pemeliharaan mesin, atau dokumen kontrak subkontraktor mengenai pelaksanaan syarat-syarat K3 di tempat kerja.</td>
    </tr>
    <tr>
      <td><strong>Pasal 10 ayat (1) huruf c</strong></td>
      <td><strong>Hak Monitoring, Inspeksi, &amp; Pengujian</strong></td>
      <td>Memonitor, memeriksa, menguji, menganalisis, mengevaluasi, dan memberikan pembinaan serta pembimbingan K3 kepada seluruh tenaga kerja dan pimpinan departemen.</td>
    </tr>
  </tbody>
</table>

<h2>Hak Khusus Penghentian Pekerjaan Berbahaya (Stop Work Authority)</h2>
<p>Salah satu wewenang paling krusial yang dimiliki Ahli K3 adalah hak mengusulkan atau memberlakukan <strong>Stop Work Authority (SWA)</strong>. Apabila Ahli K3 menemukan suatu kondisi kerja yang dinilai memiliki potensi bahaya mengancam jiwa seketika (<em>Imminent Danger</em>)—misalnya pekerja mengelas di dekat tangki solvent bocor, atau perancah bergoyang keras tanpa ikatan dinding—Ahli K3 berhak dan berkewajiban menghentikan pekerjaan tersebut saat itu juga sampai tindakan pengendalian risiko dipenuhi.</p>

<h2>Peran Strategis Sebagai Sekretaris P2K3 Perusahaan (Permenaker 04/1987)</h2>
<p>Sesuai mandat <strong>Permenaker No. 04/MEN/1987 Pasal 3 ayat (2)</strong>, susunan Panitia Pembina Keselamatan dan Kesehatan Kerja (P2K3) di perusahaan terdiri dari Ketua, Sekretaris, dan Anggota. Ditegaskan bahwa <strong>Sekretaris P2K3 WAJIB dijabat oleh Ahli K3 Umum</strong> yang ber-SKP aktif dari Kemnaker RI.</p>
<p>Peran ini menempatkan Ahli K3 sebagai motor penggerak organisasi keselamatan:</p>
<ul>
  <li>Menjadwalkan dan memimpin rapat rutin bulanan P2K3 bersama jajaran manajemen dan perwakilan serikat pekerja.</li>
  <li>Menyusun program kerja tahunan K3, anggaran belanja APD, dan jadwal riksa uji peralatan berkala.</li>
  <li>Menghimpun dan menganalisis data kecelakaan kerja, menghitung nilai Frequency Rate (FR) dan Severity Rate (SR).</li>
  <li>Menyusun dokumen Laporan Triwulanan P2K3 dan menyerahkannya ke Dinas Tenaga Kerja Provinsi setempat untuk mendapatkan tanda terima resmi pengesahan.</li>
</ul>

<h2>Matriks Aktivitas Kerja Rutin Ahli K3 Umum: Harian hingga Triwulanan</h2>
<p>Berikut adalah panduan manajemen waktu dan pembagian tugas operasional profesional Ahli K3 di Wahana Totalita Konsultan:</p>

<table>
  <thead>
    <tr>
      <th>Frekuensi Waktu</th>
      <th>Uraian Tugas Operasional yang Wajib Dijalankan</th>
      <th>Output Dokumen / Rekaman Bukti</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>Harian (Daily)</strong></td>
      <td>Memimpin Safety Morning Talk / Toolbox Meeting (TBM), memverifikasi dan menerbitkan Surat Izin Kerja Selamat (Permit to Work - PTW), inspeksi keliling area pabrik/proyek (Safety Patrol), memastikan kepatuhan APD.</td>
      <td>Lembar Form PTW bertandatangan, Daftar Hadir TBM, Logbook Temuan Patrol K3.</td>
    </tr>
    <tr>
      <td><strong>Mingguan (Weekly)</strong></td>
      <td>Inspeksi sarana tanggap darurat (APAR, kotak P3K, eyewash), koordinasi K3 bersama mandor dan supervisor produksi, audit kepatuhan pengelolaan limbah padat/cair.</td>
      <td>Checklist Inspeksi APAR Mingguan, Notulensi Rapat Koordinasi Mingguan.</td>
    </tr>
    <tr>
      <td><strong>Bulanan (Monthly)</strong></td>
      <td>Menyelenggarakan Rapat Pleno P2K3 bersama Ketua P2K3 (Direktur), merekapitulasi jam kerja selamat (Safe Manhours), menginspeksi genset, kompresor, dan instalasi grounding listrik.</td>
      <td>Notulensi Rapat P2K3 Bulanan, Rekapitulasi Safe Manhours &amp; Zero Accident.</td>
    </tr>
    <tr>
      <td><strong>Triwulanan (Quarterly)</strong></td>
      <td>Menyusun buku Laporan Triwulanan P2K3 komprehensif, mengajukan permohonan riksa uji alat angkat angkut / bejana tekan ke PJK3 riksa uji, menyerahkan laporan ke Disnaker.</td>
      <td>Tanda Terima Bukti Pengesahan Laporan P2K3 dari Disnaker Provinsi.</td>
    </tr>
  </tbody>
</table>

<h2>Apakah Ahli K3 Bertanggung Jawab Pidana Jika Terjadi Kecelakaan Fatal?</h2>
<p>Pertanyaan ini paling sering mencemaskan praktisi K3 baru: <em>"Jika terjadi kecelakaan pekerja meninggal dunia di tempat kerja, apakah Ahli K3 yang akan dipenjara?"</em></p>
<p>Berdasarkan konstruksi hukum pidana ketenagakerjaan (UU No. 1 Tahun 1970 Pasal 15), pihak yang memikul pertanggungjawaban pidana atas pelanggaran keselamatan kerja adalah <strong>PENGURUS / PENGUSAHA (Direksi dan Manajemen Pemilik Usaha)</strong> yang memiliki kewenangan anggaran dan keputusan manajerial.</p>
<p>Posisi Ahli K3 adalah sebagai <strong>advisor (penasihat teknis)</strong>. Ahli K3 aman dari jeratan hukum asalkan memiliki <em>jejak bukti dokumen (Audit Trail)</em> yang membuktikan bahwa ia telah menjalankan tugasnya dengan benar: telah mengidentifikasi bahaya tersebut dalam HIRADC, telah merekomendasikan perbaikan secara tertulis kepada direksi, telah membuat SOP, dan telah mengedukasi pekerja. Namun jika Ahli K3 terbukti melakukan pembiaran, memalsukan dokumen laporan riksa uji alat, atau menandatangani izin kerja pada kondisi yang jelas-jelas berbahaya tanpa inspeksi, maka Ahli K3 dapat turut terseret dalam delik penyertaan kelalaian kerja (Pasal 359 KUHP).</p>
"""

art16_faqs = [
    {
        "question": "Apakah Ahli K3 Umum boleh merangkap jabatan sebagai manajer produksi atau HRD?",
        "answer": "Berdasarkan Permenaker No. 02/MEN/1992, Ahli K3 Umum harus dapat menjalankan tugas pengawasan keselamatan secara independen dan objektif. Di perusahaan berskala besar atau risiko tinggi, posisi Ahli K3 wajib berdiri sendiri di bawah departemen HSE agar tidak terjadi konflik kepentingan (conflict of interest) dengan target kuantitas produksi. Namun di perusahaan kecil, perangkapan fungsi dapat dimaklumi asalkan tugas sekretaris P2K3 terlaksana tertib."
    },
    {
        "question": "Apa sanksinya jika perusahaan tidak menyampaikan laporan triwulanan P2K3 ke Disnaker?",
        "answer": "Perusahaan yang lalai menyampaikan laporan triwulanan P2K3 dapat dikenai sanksi administratif berupa Nota Pemeriksaan dari Pengawas Ketenagakerjaan Disnaker, pembekuan rekomendasi penunjukan Ahli K3, pencabutan SKP Ahli K3, serta pengguguran status penghargaan Zero Accident dan audit SMK3."
    },
    {
        "question": "Bolehkah Ahli K3 Umum menghentikan sementara pekerjaan tanpa persetujuan General Manager?",
        "answer": "Boleh dan wajib, khususnya pada kondisi Imminent Danger (bahaya fatal yang mengancam nyawa seketika). Wewenang Stop Work Authority (SWA) diberikan oleh perundangan demi menyelamatkan nyawa manusia. Setelah pekerjaan dihentikan, Ahli K3 segera melaporkan kondisi tersebut kepada GM dan Ketua P2K3 beserta rekomendasi perbaikan teknisnya."
    },
    {
        "question": "Berapa lama masa berlaku Surat Keputusan Penunjukan (SKP) Ahli K3 Umum?",
        "answer": "SKP Ahli K3 Umum berlaku selama 3 (tiga) tahun sejak tanggal diterbitkan oleh Menteri Ketenagakerjaan RI, dan wajib diperpanjang secara berkala melalui permohonan resmi perusahaan bersama PJK3 Wahana Totalita Konsultan."
    },
    {
        "question": "Bagaimana cara menyusun laporan P2K3 triwulanan yang cepat disahkan oleh Disnaker?",
        "answer": "Pastikan laporan memuat bagan P2K3 resmi, data jam kerja selamat tanpa selisih, formulir statistik kecelakaan (KK2), notulensi rapat bulanan bertandatangan pimpinan, foto dokumentasi patrol K3, dan salinan SKP Ahli K3 yang masih aktif."
    }
]

# ==============================================================================
# ARTICLE 17: PERBEDAAN POP POM POU PERTAMBANGAN BNSP
# ==============================================================================
art17_content = """

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

<h2>Perbedaan POP, POM, dan POU Pertambangan: Panduan Lengkap Jenjang Karir Pengawas Tambang</h2>
<p>Industri pertambangan mineral dan batubara (minerba) adalah sektor padat modal, padat teknologi, dan berisiko bahaya tinggi (High Risk Industry). Pengoperasian alat berat raksasa (Dump Truck CAT 777, Excavator Komatsu PC2000), lereng tambang terjal ratusan meter yang rentan longsor, peledakan batuan (blasting), serta pengelolaan air asam tambang menuntut pengawasan keselamatan yang tanpa kompromi. Dalam filosofi keselamatan pertambangan dunia, <em>pengawas operasional di lapangan adalah benteng pertahanan utama pencegah terjadinya fatality</em>.</p>

<p>Kementerian Energi dan Sumber Daya Mineral (ESDM) Republik Indonesia menetapkan regulasi ketat bahwa setiap orang yang memegang jabatan pengawas lapangan di area pertambangan <strong>WAJIB memiliki Sertifikat Kompetensi Pengawas Operasional yang diakui Ditjen Minerba ESDM dan Badan Nasional Sertifikasi Profesi (BNSP)</strong>. Sertifikasi ini terbagi ke dalam 3 jenjang hierarkis: <strong>POP (Pertama), POM (Madya), dan POU (Utama)</strong>. Artikel ini mengupas secara tuntas perbedaan ketiga jenjang tersebut, landasan hukum Kepmen ESDM 1827/2018, syarat pendaftaran, unit SKKNI, hingga strategi lulus uji petik Inspektur Tambang di Wahana Totalita Konsultan.</p>

<h2>Landasan Hukum Regulasi Keselamatan Pertambangan Minerba</h2>
<p>Kewajiban standarisasi kompetensi pengawas operasional tambang berakar pada regulasi berikut:</p>
<ul>
  <li><strong>Undang-Undang No. 3 Tahun 2020:</strong> Tentang Perubahan atas UU No. 4 Tahun 2009 tentang Pertambangan Mineral dan Batubara.</li>
  <li><strong>Peraturan Menteri ESDM No. 26 Tahun 2018:</strong> Tentang Pelaksanaan Kaidah Pertambangan yang Baik dan Pengawasan Pertambangan Mineral dan Batubara.</li>
  <li><strong>Keputusan Menteri ESDM No. 1827 K/30/MEM/2018:</strong> Tentang Pedoman Pelaksanaan Kaidah Teknik Pertambangan yang Baik, khususnya <strong>Lampiran IV mengenai Pedoman Penerapan Sistem Manajemen Keselamatan Pertambangan (SMKP) Minerba</strong>. Regulasi ini menegaskan kewajiban Kepala Teknik Tambang (KTT) mengangkat Pengawas Operasional dan Pengawas Teknis yang memiliki sertifikat kompetensi.</li>
  <li><strong>Keputusan Menteri Ketenagakerjaan No. 23 Tahun 2019:</strong> Tentang Standar Kompetensi Kerja Nasional Indonesia (SKKNI) Bidang Keselamatan Pertambangan.</li>
</ul>

<h2>Tabel Komparasi Menyeluruh: POP vs POM vs POU Pertambangan</h2>
<p>Berikut adalah perbandingan mendalam mengenai persyaratan pendidikan, jenjang jabatan di lokasi tambang, dan ruang lingkup tanggung jawab ketiga tingkatan kompetensi:</p>

<table>
  <thead>
    <tr>
      <th>Dimensi Evaluasi</th>
      <th>POP (Pengawas Operasional Pertama)</th>
      <th>POM (Pengawas Operasional Madya)</th>
      <th>POU (Pengawas Operasional Utama)</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>Level Jabatan di Tambang</strong></td>
      <td>Front Line Supervisor: Foreman, Group Leader, Pengawas Lapangan, Safety Officer Tambang.</td>
      <td>Middle Management: Superintendent Tambang, Section Head, Department Head Produksi/HSE.</td>
      <td>Top Executive: General Manager Tambang, Kepala Teknik Tambang (KTT), Project Manager Kontraktor.</td>
    </tr>
    <tr>
      <td><strong>Syarat Pendidikan &amp; Pengalaman</strong></td>
      <td>- S1/D4 Teknik (pengalaman tambang min. 1 tahun)<br>- D3 Teknik (pengalaman min. 3 tahun)<br>- SMA/SMK (pengalaman min. 5 tahun)</td>
      <td>- Memegang Sertifikat POP aktif min. 1 tahun<br>- S1 Teknik (pengalaman tambang min. 3 tahun)<br>- D3 Teknik (pengalaman min. 5 tahun)<br>- SMA/SMK (pengalaman min. 8 tahun)</td>
      <td>- Memegang Sertifikat POM aktif min. 1 tahun<br>- S1 Teknik (pengalaman tambang min. 5 tahun)<br>- D3 Teknik (pengalaman min. 8 tahun)<br>- SMA/SMK (pengalaman min. 10 tahun)</td>
    </tr>
    <tr>
      <td><strong>Fokus Ruang Lingkup Wewenang</strong></td>
      <td>Taktis Lapangan: Melakukan inspeksi harian front kerja tambang, memimpin safety talk, membuat JSA, dan investigasi insiden ringan.</td>
      <td>Manajerial &amp; Integrasi: Mengelola subkontraktor tambang, audit internal SMKP, pengendalian lingkungan tambang, dan analisis kecelakaan tambang berat.</td>
      <td>Strategis &amp; Korporasi: Menetapkan kebijakan K3P korporasi, memimpin KTT, evaluasi manajemen anggaran keselamatan, dan bertanggung jawab di hadapan hukum negara.</td>
    </tr>
    <tr>
      <td><strong>Jumlah Unit Kompetensi SKKNI</strong></td>
      <td>Menguasai <strong>8 Unit Kompetensi</strong> POP</td>
      <td>Menguasai <strong>8 Unit Kompetensi</strong> POM</td>
      <td>Menguasai <strong>8 Unit Kompetensi</strong> POU</td>
    </tr>
  </tbody>
</table>

<h2>Membedah 8 Unit Kompetensi Inti POP (Pengawas Operasional Pertama)</h2>
<p>Dalam asesmen sertifikasi POP BNSP, peserta diuji atas 8 unit kompetensi standar SKKNI Minerba:</p>
<ol>
  <li><strong>PMB.PO02.001.01:</strong> Melaksanakan Peraturan Perundang-undangan Terkait Keselamatan Pertambangan.</li>
  <li><strong>PMB.PO02.002.01:</strong> Melaksanakan Tugas dan Tanggung Jawab Keselamatan Pertambangan pada Area yang Menjadi Tanggung Jawabnya.</li>
  <li><strong>PMB.PO02.003.01:</strong> Melaksanakan Pertemuan Keselamatan Pertambangan Terencana (Safety Talk / Toolbox Meeting).</li>
  <li><strong>PMB.PO02.004.01:</strong> Melaksanakan Investigasi Kecelakaan Tambang (Teknik Pengumpulan Fakta dan Analisis Sebab Akibat).</li>
  <li><strong>PMB.PO02.005.01:</strong> Melaksanakan Tugas Inspeksi Keselamatan Pertambangan di Front Penambangan, Disposal, dan Hauling Road.</li>
  <li><strong>PMB.PO02.006.01:</strong> Melaksanakan Analisis Keselamatan Pekerjaan (Job Safety Analysis / JSA).</li>
  <li><strong>PMB.PO02.007.01:</strong> Melaksanakan Evaluasi Keselamatan Pertambangan (Inspeksi Terencana &amp; Tindakan Korektif).</li>
  <li><strong>PMB.PO02.008.01:</strong> Melaksanakan Pengelolaan Lingkungan Pertambangan (Pengendalian Erosi, Sediment Trap, dan Air Asam Tambang).</li>
</ol>

<h2>Alur Proses Uji Sertifikasi: Dari Asesmen Portofolio ke Uji Petik Minerba</h2>
<p>Sertifikasi POP/POM/POU di Wahana Totalita Konsultan melibatkan tahapan ketat berstandar Ditjen Minerba ESDM:</p>
<ul>
  <li><strong>Pra-Pembekalan Materi (Coaching Clinic):</strong> Pembahasan mendalam regulasi Kepmen ESDM 1827/2018, bedah kasus kecelakaan tambang (Golden Rules Mining Safety), dan bimbingan penyusunan portofolio kerja.</li>
  <li><strong>Uji Tulis &amp; Studi Kasus:</strong> Evaluasi pemahaman teori regulasi, rambu-rambu tambang, batas kemiringan jalan angkut (Grade Hauling Road maksimal 8–12%), dan prosedur blasting.</li>
  <li><strong>Uji Wawancara Kompetensi Portofolio (Asesor LSP BNSP):</strong> Pembuktian berkas nyata (JSA asli yang pernah dibuat, laporan investigasi, foto inspeksi lapangan).</li>
  <li><strong>Sesi Uji Petik (Wawancara Panel) Bersama Inspektur Tambang ESDM:</strong> Sesi konfirmasi akhir di mana Pejabat Inspektur Tambang Kementerian ESDM menguji langsung integritas dan kesiapan mental calon pengawas sebelum merekomendasikan penerbitan sertifikat resmi.</li>
</ul>

<h2>Keuntungan Finansial dan Jenjang Karir Pengawas Tambang</h2>
<p>Memegang sertifikat POP, POM, atau POU berlogo Garuda Emas BNSP dan teregistrasi di Ditjen Minerba ESDM adalah modal utama percepatan karir di perusahaan tambang batubara, nikel, emas, dan tembaga terkemuka (seperti Adaro, Freeport, Vale, Bukit Asam, Kaltim Prima Coal, Harita Nickel):</p>
<ul>
  <li><strong>Gaji Pemegang Sertifikat POP (Supervisor / Group Leader):</strong> Berkisar antara <strong>Rp 12.000.000 hingga Rp 22.000.000 per bulan</strong> (belum termasuk tunjangan site, roster cuti, dan bonus produksi tahunan).</li>
  <li><strong>Gaji Pemegang Sertifikat POM (Superintendent / Dept Head):</strong> Berkisar antara <strong>Rp 25.000.000 hingga Rp 45.000.000 per bulan</strong>.</li>
  <li><strong>Gaji Pemegang Sertifikat POU / KTT (General Manager / Kepala Teknik Tambang):</strong> Berkisar antara <strong>Rp 60.000.000 hingga lebih dari Rp 120.000.000 per bulan</strong>.</li>
</ul>
<h2>Komitmen Wahana Totalita dalam Mencetak Pengawas Tambang Kelas Dunia</h2>
<p>Kementerian ESDM menegaskan bahwa sertifikat POP, POM, dan POU bukan sekadar lembar kertas untuk formalitas audit, melainkan bukti kompetensi hidup yang dipertaruhkan setiap hari di medan tambang yang keras dan berbahaya. Wahana Totalita Konsultan memadukan kurikulum SKKNI terbaru dengan studi kasus kecelakaan tambang riil, simulasi inspeksi front penambangan, dan pendampingan intensif bersama Master Asesor bersertifikasi nasional guna menjamin para lulusan memiliki kepemimpinan keselamatan yang tangguh dan diakui oleh seluruh grup pertambangan terkemuka di tanah air.</p>
"""

art17_faqs = [
    {
        "question": "Apakah seorang sarjana baru (fresh graduate) boleh langsung mengambil sertifikasi POP Pertambangan?",
        "answer": "Berdasarkan regulasi Ditjen Minerba ESDM dan skema BNSP, sertifikasi POP mensyaratkan pengalaman kerja nyata di kegiatan usaha pertambangan minimal 1 tahun untuk lulusan S1/D4 Teknik, 3 tahun untuk D3 Teknik, dan 5 tahun untuk SMA/SMK. Fresh graduate disarankan mengumpulkan pengalaman magang industri atau bekerja sebagai asisten safety terlebih dahulu sebelum mengikuti asesmen resmi."
    },
    {
        "question": "Bolehkah saya langsung mengambil sertifikasi POM tanpa memiliki sertifikat POP?",
        "answer": "Tidak boleh. Sistem jenjang pengawas operasional pertambangan bersifat mutlak berjenjang (Prerequisite). Seseorang hanya dapat mendaftar sertifikasi POM jika telah memiliki Sertifikat POP aktif sekurang-kurangnya 1 (satu) tahun kalender dan memenuhi persyaratan pengalaman manajerial pertambangan."
    },
    {
        "question": "Apa perbedaan mendasar antara K3 Umum Kemnaker dan POP Minerba?",
        "answer": "K3 Umum Kemnaker mengacu pada UU No. 1/1970 yang berlaku untuk seluruh jenis tempat kerja secara generalist dan berfokus pada kelembagaan P2K3. Sedangkan POP Pertambangan mengacu pada regulasi Kementerian ESDM (Kepmen 1827/2018) yang berfokus secara spesifik dan teknis pada kaidah operasional penambangan, kestabilan lereng, penanganan alat berat tambang, dan regulasi minerba."
    },
    {
        "question": "Berapa lama masa berlaku sertifikat kompetensi POP BNSP?",
        "answer": "Sertifikat Kompetensi Pengawas Operasional Pertama (POP) yang diterbitkan oleh BNSP berlaku selama 5 (lima) tahun sejak tanggal diterbitkan. Perpanjangan dilakukan melalui proses uji pemeliharaan kompetensi di LSP terkait sebelum masa berlaku habis."
    },
    {
        "question": "Apakah pelatihan dan asesmen POP Pertambangan di Wahana Totalita Konsultan diselenggarakan secara online?",
        "answer": "Ya, pembekalan materi teori dan bimbingan penyusunan portofolio dilaksanakan secara daring via Zoom interaktif, dilanjutkan dengan sesi asesmen wawancara online bersama Master Asesor LSP Perhutamindo / LSP Pertambangan terlisensi BNSP dan didampingi langsung oleh pengawas Ditjen Minerba ESDM."
    }
]

# ==============================================================================
# ARTICLE 19: PANDUAN SERTIFIKASI JURU LAS WELDER KEMNAKER
# ==============================================================================
art19_content = """

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

<h2>Panduan Lengkap Sertifikasi Juru Las (Welder) Kelas 1, 2, 3 Kemnaker RI</h2>
<p>Dalam dunia rekayasa industri modern, pengelasan (welding) adalah teknologi penyambungan logam permanen yang menjadi tulang punggung fabrikasi bejana uap boiler, tangki timbun bahan bakar (fuel storage tank), jaringan pipa transmisi minyak dan gas bumi bertekanan tinggi, konstruksi jembatan bentang panjang, hingga struktur kapal tanker offshore. Namun, sambungan las yang terlihat mulus dari luar dapat menyembunyikan cacat mikroskopis internal yang mematikan—seperti retak rambut (crack), fusi tak sempurna (lack of fusion), penetrasi dangkal, atau porositas gas yang terperangkap.</p>

<p>Jika sambungan las cacat tersebut menerima beban tekanan kerja ribuan megapascal atau getaran dinamis, pipa gas dapat meledak dahsyat atau struktur jembatan ambruk seketika. Oleh karena itu, Kementerian Ketenagakerjaan Republik Indonesia mengatur secara ketat kualifikasi personil pengelasan melalui <strong>Permenaker No. Per.02/MEN/1982 tentang Kualifikasi Juru Las di Tempat Kerja</strong>. Setiap tukang las yang mengerjakan konstruksi bejana tekan, pesawat uap, atau struktur penahan beban <strong>WAJIB memiliki Sertifikat dan Lisensi Juru Las resmi Kemnaker RI</strong>. Artikel ini membedah tuntas perbedaan Welder Kelas 1, 2, dan 3, jenis-jenis uji merusak dan non-merusak, hingga jalur sertifikasi di Wahana Totalita Konsultan.</p>

<h2>Landasan Hukum Regulasi Kualifikasi Juru Las di Indonesia</h2>
<p>Penyelenggaraan pengawasan teknik pengelasan di tempat kerja diatur dalam regulasi perundang-undangan berikut:</p>
<ul>
  <li><strong>Undang-Undang Uap Tahun 1930 (Stoomordonnantie 1930):</strong> Mengatur keselamatan ketel uap dan bejana bertekanan tinggi di Indonesia.</li>
  <li><strong>Undang-Undang No. 1 Tahun 1970 tentang Keselamatan Kerja:</strong> Menetapkan syarat keselamatan pengelasan mekanik dan tekanan.</li>
  <li><strong>Peraturan Menteri Tenaga Kerja dan Transmigrasi No. Per.02/MEN/1982:</strong> Tentang Kualifikasi Juru Las di Tempat Kerja. Regulasi ini menjadi acuan hukum pembagian tingkatan juru las ke dalam Kelas I, Kelas II, dan Kelas III.</li>
  <li><strong>Standar Kode Internasional Pengelasan:</strong> ASME Section IX (Boiler and Pressure Vessel Code), AWS D1.1 (Structural Welding Code - Steel), dan API 1104 (Welding of Pipelines and Related Facilities).</li>
</ul>

<h2>Tabel Komparasi Menyeluruh: Juru Las Kelas 1 vs Kelas 2 vs Kelas 3</h2>
<p>Berdasarkan Permenaker No. 02/MEN/1982 Bab II Pasal 3, kualifikasi juru las dibagi ke dalam 3 kelas berdasarkan posisi pengelasan dan tingkat kesulitan teknis konstruksi yang dikerjakannya:</p>

<table>
  <thead>
    <tr>
      <th>Kualifikasi Juru Las</th>
      <th>Posisi Pengelasan yang Dikuasai</th>
      <th>Lingkup Konstruksi &amp; Beban Kerja yang Diizinkan</th>
      <th>Uji Spesimen Laboratorium Wajib</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>Juru Las Kelas 3 (Tingkat Dasar)</strong></td>
      <td>Posisi Pelat &amp; Pipa Datar/Horizontal:<br><strong>1G, 2G, 1F, 2F</strong></td>
      <td>Mengelas konstruksi rangka baja non-tekanan, dudukan mesin sederhana, tangki terbuka tanpa tekanan fluida.</td>
      <td>Uji Visual (VT) + Uji Tekuk Permukaan (Face Bend) dan Uji Tekuk Akar (Root Bend) 2 spesimen.</td>
    </tr>
    <tr>
      <td><strong>Juru Las Kelas 2 (Tingkat Menengah)</strong></td>
      <td>Posisi Vertikal &amp; Di Atas Kepala:<br><strong>3G, 4G, 3F, 4F</strong> (serta mencakup seluruh posisi Kelas 3)</td>
      <td>Mengelas bejana tekan bertekanan rendah-sedang, pipa saluran air bertekanan, struktur jembatan baja, tangki bahan bakar atmosferik.</td>
      <td>Uji Visual (VT) + Uji Tarik (Tensile Test) + Uji Tekuk (Bend Test) 4 spesimen uji.</td>
    </tr>
    <tr>
      <td><strong>Juru Las Kelas 1 (Tingkat Mahir / All Position)</strong></td>
      <td>Posisi Pipa Tersulit:<br><strong>5G, 6G, 6GR</strong> (sumbu pipa miring 45&deg; tetap tanpa boleh diputar) + Seluruh Posisi Pelat</td>
      <td>Mengelas ketel uap (boiler) tekanan tinggi, pipa migas tekanan tinggi (high pressure gas pipeline), reaktor petrokimia nuklir, bejana transport B3.</td>
      <td>Uji Visual (VT) + Uji Radiografi Sinar X-Ray (RT) menyeluruh 100% + Uji Tarik + Uji Tekuk 4 spesimen.</td>
    </tr>
  </tbody>
</table>

<h2>Metode Pengujian Kualifikasi Las: NDT (Non-Destructive) &amp; DT (Destructive)</h2>
<p>Dalam pengujian kualifikasi juru las resmi Kemnaker RI, kupon las (test coupon) yang telah diselesaikan oleh peserta wajib melalui serangkaian pengujian laboratorium metalurgi:</p>
<ol>
  <li><strong>Pemeriksaan Visual (Visual Inspection):</strong> Mengecek lebar dan tinggi manik las (weld bead reinforcement), keseragaman riak las, ketiadaan undercut (alur termakan di tepi las), ketiadaan spatter berlebih, dan ketiadaan retak visual di bawah kaca pembesar.</li>
  <li><strong>Uji Radiografi Sinar-X (Radiographic Testing - NDT):</strong> Memotret struktur internal sambungan las menggunakan radiasi sinar-X atau sinar Gamma. Film rontgen akan memperlihatkan secara jelas jika terdapat cacat slag inclusion, lack of penetration, atau porositas gas mikro di dalam logam las. Standar keberterimaan mengacu pada ASME IX QW-191.</li>
  <li><strong>Uji Tekuk (Guided Bend Test - DT):</strong> Memotong spesimen las menjadi potongan balok kecil dan menekuknya pada mesin hidrolik dengan sudut 180 derajat. Pengujian meliputi <em>Face Bend</em> (menekuk permukaan luar las) dan <em>Root Bend</em> (menekuk akar tembusan las). Sambungan dinyatakan lulus jika tidak muncul retak terbuka yang melebihi 3,2 mm pada permukaan lengkung.</li>
  <li><strong>Uji Tarik (Tensile Strength Test - DT):</strong> Menarik spesimen pada mesin uji tarik hingga putus. Kuat tarik sambungan las <strong>wajib sama dengan atau lebih tinggi</strong> daripada kuat tarik minimum logam induk (Base Metal). Patah wajib terjadi di area logam induk, bukan pada garis sambungan las.</li>
</ol>

<h2>Standar K3 Pengelasan: Melindungi Welder dari Bahaya Bahaya Ekstrem</h2>
<p>Selain keterampilan mekanik tangan, juru las bersertifikat di Wahana Totalita Konsultan dibekali pemahaman K3 mendalam:</p>
<ul>
  <li><strong>Proteksi Radiasi Optik (Sinar UV &amp; Inframerah):</strong> Nyala busur las menghasilkan radiasi ultraviolet (UV) dan inframerah yang dapat memicu <em>Arc Eye / Welder's Flash</em> (luka bakar kornea mata yang sangat menyakitkan) dan katarak dini. Welder wajib memakai Helm Las (Welding Helmet) dengan lensa kaca filter otomatis (Auto-Darkening Filter / ADF) berstandar Shade 9 hingga 13.</li>
  <li><strong>Pengendalian Asap Las Beracun (Welding Fumes Control):</strong> Asap las mengandung partikel oksida logam berat (mangan, kromium heksavalen, nikel, seng) yang memicu demam asap logam (Metal Fume Fever) dan kanker paru-paru. Wajib disediakan sistem ventilasi pembuang lokal (Local Exhaust Ventilation / LEV) dan respirator partikulat N95/P100.</li>
  <li><strong>Pencegahan Sengatan Arus Las (Electric Shock):</strong> Menggunakan mesin las dengan Voltage Reduction Device (VRD) yang membatasi tegangan tanpa beban (Open Circuit Voltage) di bawah 30 Volt, serta memakai sarung tangan kulit las kering dan sepatu safety bersol isolator karet.</li>
</ul>

<h2>Masa Berlaku Lisensi Buku Kerja Juru Las Kemnaker RI</h2>
<p>Berdasarkan Permenaker 02/1982 Pasal 12, <strong>Sertifikat dan Lisensi Juru Las Kemnaker RI memiliki masa berlaku selama 3 (tiga) tahun</strong>. Lisensi ini dapat diperpanjang melalui PJK3 resmi dengan melampirkan Buku Kerja Las (Welder Logbook) yang membuktikan bahwa juru las bersangkutan aktif mengelas secara rutin tanpa jeda berhenti lebih dari 6 bulan berturut-turut.</p>
<h2>Keunggulan Uji Kualifikasi Juru Las di Wahana Totalita Konsultan</h2>
<p>Wahana Totalita Konsultan bekerjasama dengan laboratorium uji bahan metalurgi terakreditasi KAN dan Balai K3 Kementerian Ketenagakerjaan RI untuk menyelenggarakan sertifikasi Welder Kelas 1, 2, dan 3. Setiap peserta mendapatkan fasilitas kupon uji pelat dan pipa standar, kawat las berkualitas tinggi, bimbingan pengelasan posisi sulit bersama instruktur senior Welding Inspector bersertifikat CSWIP/B4T, serta pendampingan langsung pada saat uji radiografi X-Ray dan uji bending mekanik guna memastikan hasil pengelasan lulus dengan predikat memuaskan.</p>
"""

art19_faqs = [
    {
        "question": "Apakah juru las otodidak tanpa ijazah teknik boleh mengikuti sertifikasi Juru Las Kemnaker RI?",
        "answer": "Bisa. Berdasarkan Permenaker No. 02/MEN/1982, kualifikasi peserta juru las tidak membatasi jurusan ijazah formal (minimal berpendidikan dasar/menengah), asalkan peserta memiliki keterampilan dasar menyalakan busur las, mengatur ampere mesin las, dan lulus uji praktik pengelasan pelat/pipa sesuai kelas yang dituju."
    },
    {
        "question": "Bolehkah Juru Las Kelas 2 mengelas sambungan pipa boiler bertekanan 40 bar?",
        "answer": "Tidak boleh. Sesuai Permenaker 02/1982, bejana uap boiler dan pipa bertekanan tinggi dengan sambungan pipa posisi 5G atau 6G WAJIB dikerjakan oleh Juru Las Kelas 1. Juru Las Kelas 2 hanya berwenang mengerjakan konstruksi dengan posisi 1G hingga 4G dengan batasan tekanan tertentu."
    },
    {
        "question": "Apa perbedaan antara sertifikat Welder Kemnaker RI vs Welder BNSP vs ASME?",
        "answer": "Sertifikat Welder Kemnaker RI berfokus pada legalitas hukum keselamatan kerja pesawat uap dan bejana tekan di bawah undang-undang ketenagakerjaan Indonesia. Welder BNSP berbasis Standar Kompetensi Kerja Nasional Indonesia (SKKNI). Sedangkan sertifikat ASME/AWS adalah kualifikasi prosedur pengelasan internasional (WPS/PQR) yang dipersyaratkan oleh pemilik proyek multinasional."
    },
    {
        "question": "Berapa lama proses pengujian laboratorium spesimen las hingga sertifikat terbit?",
        "answer": "Pengujian laboratorium mekanik (uji tarik, tekuk) dan uji radiografi X-Ray memakan waktu sekitar 5–7 hari kerja setelah pengelasan selesai. Setelah hasil lab dinyatakan Accepted oleh tim pengawas Kemnaker RI, berkas diproses untuk penerbitan Sertifikat resmi dan Buku Kerja Las yang memakan waktu 1–2 bulan."
    },
    {
        "question": "Apakah proses pengelasan uji praktik di Wahana Totalita mencakup proses SMAW dan GTAW (TIG)?",
        "answer": "Ya. Wahana Totalita Konsultan memfasilitasi pengujian untuk berbagai proses pengelasan industri, termasuk Shielded Metal Arc Welding (SMAW / Las Listrik Elektroda), Gas Tungsten Arc Welding (GTAW / Las Argon TIG), dan Gas Metal Arc Welding (GMAW / Las MIG/MAG)."
    }
]

# ==============================================================================
# ARTICLE 20: METODE INVESTIGASI KECELAKAAN SCAT ROOT CAUSE ANALYSIS
# ==============================================================================
art20_content = """

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

<h2>Panduan Lengkap Investigasi Kecelakaan Kerja: Metode RCA, 5-Why, Fishbone, &amp; SCAT</h2>
<p>Ketika kecelakaan kerja terjadi di tempat kerja—mulai dari insiden nyaris celaka (Near Miss), cedera patah tulang pekerja, kebakaran gudang, hingga kecelakaan fatal (Fatality)—reaksi spontan banyak pimpinan perusahaan yang belum memahami esensi keselamatan adalah mencari siapa pekerja yang bersalah untuk dijatuhi sanksi surat peringatan (SP) atau pemecatan. <strong>Budaya menyalahkan (Blaming Culture) adalah musuh terbesar Keselamatan dan Kesehatan Kerja (K3)</strong>. Menyalahkan korban di ujung tombak tidak akan pernah menyelesaikan masalah, karena kondisi tidak aman dan kegagalan sistemik manajemen yang memicu kecelakaan tersebut akan tetap ada, menunggu korban berikutnya.</p>

<p>Tujuan sejati dari <strong>Investigasi Kecelakaan Kerja adalah Pembuktian Fakta (Fact-Finding, Not Fault-Finding)</strong>. Investigasi ilmiah bertujuan membongkar rantai sebab-akibat (Chain of Events), menemukan akar penyebab sistem manajemen (Root Causes), dan merumuskan tindakan korektif dan pencegahan (Corrective and Preventive Action / CAPA) agar tragedi serupa tidak pernah terulang kembali di masa depan. Artikel ini mengupas secara tuntas 5 tahapan siklus investigasi, perbandingan alat analisis RCA terpopuler (5-Why, Fishbone, SCAT Model), format laporan resmi Kemnaker RI, hingga pelatihan praktis di Wahana Totalita Konsultan.</p>

<h2>Dasar Hukum Kewajiban Pelaporan &amp; Pemeriksaan Kecelakaan Kerja</h2>
<p>Kewajiban hukum investigasi dan pelaporan kecelakaan diatur secara tegas dalam perundangan nasional:</p>
<ul>
  <li><strong>Undang-Undang No. 1 Tahun 1970 tentang Keselamatan Kerja:</strong> Pasal 11 ayat (1) mewajibkan pengurus tempat kerja melaporkan tiap kecelakaan yang terjadi dalam tempat kerja yang dipimpinnya kepada pejabat yang ditunjuk oleh Menteri Tenaga Kerja.</li>
  <li><strong>Peraturan Menteri Tenaga Kerja RI No. Per.03/MEN/1998 tentang Tata Cara Pelaporan dan Pemeriksaan Kecelakaan Kerja:</strong> Mewajibkan pengusaha melaporkan secara tertulis kecelakaan kerja dalam waktu <strong>tidak lebih dari 2 kali 24 jam</strong> sejak terjadinya kecelakaan menggunakan formulir resmi standar (Formulir Bentuk 3 KK2).</li>
  <li><strong>Peraturan Pemerintah No. 50 Tahun 2012 (SMK3):</strong> Elemen 8 mengatur tentang Pelaporan dan Perbaikan Kekurangan K3, mewajibkan perusahaan memiliki prosedur terdokumentasi mengenai penyelidikan kecelakaan kerja dan pelaporan bahaya.</li>
</ul>

<h2>5 Tahapan Siklus Investigasi Kecelakaan Kerja yang Efektif</h2>
<p>Tim Investigasi K3 di Wahana Totalita Konsultan dilatih menerapkan prosedur 5 tahap investigasi forensik industri:</p>
<ol>
  <li><strong>Tahap 1: Tanggap Darurat &amp; Pengamanan Tempat Kejadian Perkara (TKP)</strong>
    <ul>
      <li>Prioritaskan pertolongan pertama (P3K) dan evakuasi medis korban ke rumah sakit terdekat.</li>
      <li>Segera isolasi fisik area TKP dengan memasang garis pembatas keselamatan (Safety Barrier / Yellow Barricade Tape).</li>
      <li>Dilarang mengubah posisi mesin, membuang puing serpihan, atau membersihkan ceceran cairan sebelum tim investigasi selesai memotret dan mendokumentasikan fakta lapangan.</li>
    </ul>
  </li>
  <li><strong>Tahap 2: Pengumpulan Bukti &amp; Fakta Lapangan (Metode 4P)</strong>
    <ul>
      <li><em>Position (Posisi):</em> Pemetaan posisi korban, posisi tuas mesin, koordinat jatuhnya beban, sketsa gambar tata letak TKP, dan foto dari berbagai sudut.</li>
      <li><em>People (Manusia):</em> Wawancara saksi mata langsung, saksi tidak langsung, rekan kerja satu shift, mandor, dan operator alat dalam ruangan terpisah yang nyaman tanpa intimidasi.</li>
      <li><em>Parts (Peralatan &amp; Benda Fisik):</em> Mengamankan serpihan patahan baut, sling kawat yang putus, APD yang dikenakan korban, dan mengirim sampel ke lab uji metalurgi jika diperlukan.</li>
      <li><em>Paper (Dokumen Terdokumentasi):</em> Memeriksa dokumen Job Safety Analysis (JSA), formulir Permit to Work (PTW), logbook pemeliharaan mesin, sertifikat SIO operator, dan rekaman CCTV.</li>
    </ul>
  </li>
  <li><strong>Tahap 3: Pemetaan Kronologi Peristiwa (Timeline Mapping)</strong>
    <ul>
      <li>Menyusun alur urutan kejadian menit demi menit (Time Sequence Analysis) mulai dari shift pagi dimulai hingga detik terjadinya insiden kontak fisik.</li>
    </ul>
  </li>
  <li><strong>Tahap 4: Analisis Akar Penyebab Masalah (Root Cause Analysis - RCA)</strong>
    <ul>
      <li>Menerapkan metode analisis sebab-akibat untuk membedah Penyebab Langsung (Direct Causes), Penyebab Dasar (Basic/Underlying Causes), hingga Kurangnya Pengendalian Manajemen (Lack of Control).</li>
    </ul>
  </li>
  <li><strong>Tahap 5: Perumusan Tindakan Korektif (CAPA) &amp; Pelaporan Resmi</strong>
    <ul>
      <li>Menyusun rekomendasi perbaikan berbasis Hirarki Pengendalian Risiko (Eliminasi, Substitusi, Rekayasa Teknik, Administratif, APD) lengkap dengan penanggung jawab (PIC) dan batas waktu penyelesaian (deadline).</li>
      <li>Mengisi Formulir Laporan Kecelakaan Kerja Bentuk 3 KK2 Kemnaker RI dan menyerahkannya ke Dinas Tenaga Kerja dan BPJS Ketenagakerjaan setempat.</li>
    </ul>
  </li>
</ol>

<h2>Membedah 4 Alat Analisis Investigasi Paling Terbukti di Industri</h2>
<p>Berikut adalah perbandingan keunggulan 4 metodologi investigasi yang diajarkan dalam lokakarya K3:</p>

<table>
  <thead>
    <tr>
      <th>Metode Analisis</th>
      <th>Konsep Dasar Pendekatan</th>
      <th>Kelebihan Utama</th>
      <th>Kapan Paling Tepat Digunakan</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>5-Why Analysis (Metode 5 Mengapa)</strong></td>
      <td>Mengajukan pertanyaan "Mengapa hal ini terjadi?" secara berulang (rata-rata 5 kali) hingga menemukan akar masalah terdalam.</td>
      <td>Sangat praktis, cepat, tidak memerlukan software rumit, mudah dipahami pekerja lapangan.</td>
      <td>Investigasi insiden sederhana, near miss harian, atau kegagalan mekanik minor.</td>
    </tr>
    <tr>
      <td><strong>Diagram Tulang Ikan (Fishbone / Ishikawa 5M)</strong></td>
      <td>Mengelompokkan faktor penyebab ke dalam 6 kategori: Manusia (Man), Mesin (Machine), Metode (Method), Material, Lingkungan (Milieu), dan Pengukuran (Measurement).</td>
      <td>Memberikan gambaran visual komprehensif, mencegah tim investigasi terpaku hanya pada satu faktor manusia saja.</td>
      <td>Insiden dengan interaksi variabel multi-disiplin di pabrik manufaktur dan proses kimia.</td>
    </tr>
    <tr>
      <td><strong>Fault Tree Analysis (FTA)</strong></td>
      <td>Logika deduktif pohon kegagalan menggunakan gerbang logika biner Boolean (AND Gate &amp; OR Gate).</td>
      <td>Kalkulasi probabilitas kuantitatif matematis terhadap keandalan sistem keamanan otomatis.</td>
      <td>Investigasi ledakan kilang migas, kegagalan turbin pembangkit listrik, industri dirgantara.</td>
    </tr>
    <tr>
      <td><strong>SCAT Model (Systematic Cause Analysis Technique)</strong></td>
      <td>Model sebab-akibat kecelakaan modern DNV: Kerugian &rarr; Insiden Kontak &rarr; Penyebab Langsung &rarr; Penyebab Dasar &rarr; Tindakan Pengendalian Sistem Manajemen.</td>
      <td><strong>Metode paling komprehensif dan diakui auditor dunia</strong>; menghubungkan kecelakaan langsung ke kelemahan SOP audit SMK3.</td>
      <td>Insiden cedera berat, kerusakan aset bernilai miliaran rupiah, dan kasus fatality di BUMN &amp; multinasional.</td>
    </tr>
  </tbody>
</table>

<h2>Bedah Kasus Nyata Menggunakan Model SCAT (Systematic Cause Analysis Technique)</h2>
<p>Untuk memahami penerapan model SCAT secara nyata, perhatikan studi kasus berikut:</p>
<p><em>Deskripsi Insiden:</em> Seorang teknisi mekanik mengalami patah jari tangan kanan saat melakukan pelumasan rantai konveyor berjalan di pabrik pakan ternak.</p>
<ul>
  <li><strong>1. Kerugian (Loss):</strong> Cedera patah tulang jari tangan (Lost Time Injury / LTI 21 hari kerja) + Biaya pengobatan rumah sakit.</li>
  <li><strong>2. Insiden Kontak (Incident / Contact):</strong> Tangan mekanik terjepit (Caught in/between) di antara roda gigi sproket dan rantai konveyor yang sedang berputar kencang.</li>
  <li><strong>3. Penyebab Langsung (Immediate Causes):</strong>
    <ul>
      <li><em>Tindakan Tidak Aman (Unsafe Act):</em> Mekanik melumasi rantai saat mesin konveyor masih menyala dan tidak memasang gembok pengaman LOTO.</li>
      <li><em>Kondisi Tidak Aman (Unsafe Condition):</em> Penutup pelindung roda gigi (Machine Guarding) dilepas dan tidak dipasang kembali sejak perbaikan minggu lalu.</li>
    </ul>
  </li>
  <li><strong>4. Penyebab Dasar (Basic Causes):</strong>
    <ul>
      <li><em>Faktor Pribadi (Personal Factors):</em> Kurangnya pelatihan teknisi mengenai prosedur Lockout/Tagout (LOTO), persepsi risiko bahaya yang rendah (overconfidence).</li>
      <li><em>Faktor Pekerjaan (Job Factors):</em> Standar pemeliharaan pencegahan (Preventive Maintenance) tidak jelas, ketiadaan alat kuas bergagang panjang untuk pelumasan aman.</li>
    </ul>
  </li>
  <li><strong>5. Kurangnya Pengendalian Sistem Manajemen (Lack of Control):</strong>
    <ul>
      <li>Sistem Izin Kerja Selamat (PTW) tidak ditegakkan untuk pekerjaan pemeliharaan konveyor.</li>
      <li>Audit kepatuhan pemasangan guard mesin (machine guarding audit) tidak pernah dijadwalkan oleh Departemen Pemeliharaan.</li>
    </ul>
  </li>
</ul>

<h2>Rekomendasi Tindakan Korektif (CAPA) yang Efektif</h2>
<p>Berdasarkan analisis SCAT di atas, tim investigasi merumuskan tindakan perbaikan konkret:</p>
<ol>
  <li><strong>Rekayasa Teknik:</strong> Memasang penutup mesin (fixed wire mesh guard) permanen yang dilengkapi <em>Safety Interlock Switch</em> (mesin otomatis mati total seketika cover pelindung dibuka) dan memasang jalur pipa pelumasan otomatis (Auto-Greasing System) dari luar cover.</li>
  <li><strong>Pengendalian Administratif:</strong> Mewajibkan penerapan 100% prosedur LOTO dengan kunci gembok pribadi sebelum membuka panel cover mesin, serta menyelenggarakan pelatihan sertifikasi K3 Mekanik bagi seluruh staf teknisi.</li>
  <li><strong>Sistem Manajemen:</strong> Menambahkan item verifikasi pelindung mesin ke dalam formulir inspeksi K3 mingguan supervisor.</li>
</ol>
"""

art20_faqs = [
    {
        "question": "Berapa lama batas waktu maksimal pelaporan kecelakaan kerja ke Disnaker?",
        "answer": "Berdasarkan Permenaker No. Per.03/MEN/1998 Pasal 2, pengusaha atau pengurus wajib melaporkan setiap kecelakaan kerja secara tertulis kepada Kepala Kantor Departemen Tenaga Kerja setempat dalam waktu tidak lebih dari 2 kali 24 jam (2 hari kerja) terhitung sejak terjadinya kecelakaan."
    },
    {
        "question": "Apakah insiden nyaris celaka (Near Miss) wajib diinvestigasi?",
        "answer": "Sangat wajib. Mengacu pada Teori Piramida Kecelakaan (Frank Bird Pyramid), di balik 1 kecelakaan fatal terdapat 10 kecelakaan berat, 30 kecelakaan ringan, dan 600 insiden nyaris celaka (Near Miss). Menginvestigasi dan menyelesaikan akar penyebab Near Miss adalah kunci paling efektif untuk mencegah terjadinya kecelakaan fatal sebelum korban berjatuhan."
    },
    {
        "question": "Siapa saja personil yang wajib masuk dalam Tim Investigasi Kecelakaan Kerja?",
        "answer": "Tim investigasi yang ideal terdiri dari gabungan multi-fungsi: Ahli K3 Umum perusahaan (sebagai ketua teknis/fasilitator investigasi), Manajer/Supervisor departemen tempat kecelakaan terjadi, teknisi pemeliharaan terkait, perwakilan serikat pekerja/rekan kerja, dan didampingi perwakilan manajemen direksi."
    },
    {
        "question": "Bolehkah hasil investigasi kecelakaan digunakan untuk memotong gaji atau memecat pekerja korban?",
        "answer": "Tujuan K3 adalah pencegahan. Memanfaatkan laporan investigasi semata-mata untuk menghukum korban justru akan menghancurkan budaya keterbukaan (Safety Reporting Culture), di mana pekerja di masa depan akan menyembunyikan insiden dan luka kerja karena takut dipecat. Sanksi disipliner hanya boleh diterapkan bila terbukti terjadi tindakan pelanggaran sengaja (sabotase/mabuk/pidana)."
    },
    {
        "question": "Apakah Wahana Totalita Konsultan menyelenggarakan pelatihan Root Cause Analysis (RCA)?",
        "answer": "Ya. Wahana Totalita Konsultan menyelenggarakan workshop intensif Investigasi Kecelakaan Kerja & Root Cause Analysis (RCA / SCAT Method) bersertifikasi, mencakup simulasi wawancara saksi, studi kasus forensik industri, dan teknik penyusunan laporan audit yang memenuhi standar Kemnaker RI dan ISO 45001:2018."
    }
]

articles_data_batch4 = [
    {
        "slug": "tugas-tanggung-jawab-ahli-k3-umum-perusahaan-permenaker-2-1992",
        "title": "Tugas, Wewenang, & Tanggung Jawab Ahli K3 Umum Sesuai Permenaker 02/1992",
        "meta_title": "Tugas, Wewenang, & Tanggung Jawab Ahli K3 Umum Sesuai Permenaker 02/1992",
        "meta_desc": "Kupas tuntas tugas & wewenang hukum Ahli K3 Umum Permenaker 02/1992. Peran sekretaris P2K3, matriks tugas harian-triwulanan, stop work authority & jeratan pidana.",
        "keywords": "tugas ahli k3 umum di perusahaan, wewenang ahli k3 umum permenaker 02 1992, tanggung jawab sekretaris p2k3, laporan triwulanan p2k3 disnaker, stop work authority k3",
        "content": art16_content.strip(),
        "faq_data": art16_faqs
    },
    {
        "slug": "perbedaan-pop-pom-pou-pertambangan-bnsp-jenjang-karir",
        "title": "Perbedaan POP, POM, dan POU Pertambangan: Panduan Jenjang Karir Pengawas Tambang",
        "meta_title": "Perbedaan POP, POM, dan POU Pertambangan: Panduan Jenjang Karir Pengawas Tambang",
        "meta_desc": "Bandingkan syarat & jenjang karir POP vs POM vs POU pertambangan minerba Kepmen ESDM 1827/2018. 8 unit SKKNI, gaji pengawas tambang, uji petik & sertifikasi BNSP.",
        "keywords": "perbedaan pop pom pou pertambangan, sertifikasi pop minerba bnsp, gaji pengawas operasional pertama, kepmen esdm 1827 2018 smkp, uji kompetensi k3 tambang",
        "content": art17_content.strip(),
        "faq_data": art17_faqs
    },
    {
        "slug": "panduan-sertifikasi-juru-las-welder-kelas-1-2-3-kemnaker",
        "title": "Panduan Sertifikasi Juru Las (Welder) Kelas 1, 2, 3 Kemnaker RI (Permenaker 02/1982)",
        "meta_title": "Panduan Sertifikasi Juru Las (Welder) Kelas 1, 2, 3 Kemnaker RI",
        "meta_desc": "Panduan resmi kualifikasi Juru Las Kelas 1, 2, 3 Kemnaker RI Permenaker 02/1982. Posisi 1G-6G pipa boiler, uji radiografi sinar-X & tekuk, buku kerja welder 2026.",
        "keywords": "sertifikasi juru las kemnaker kelas 1 2 3, welder pipa 6g kemnaker, permenaker 02 1982 juru las, uji radiografi pengelasan asme ix, biaya sertifikasi welder yogyakarta",
        "content": art19_content.strip(),
        "faq_data": art19_faqs
    },
    {
        "slug": "metode-investigasi-kecelakaan-kerja-root-cause-analysis-scat",
        "title": "Panduan Lengkap Investigasi Kecelakaan Kerja: Metode RCA, 5-Why, Fishbone, & SCAT",
        "meta_title": "Panduan Lengkap Investigasi Kecelakaan Kerja: Metode RCA, 5-Why, Fishbone, & SCAT",
        "meta_desc": "Kuasai teknik investigasi kecelakaan kerja Permenaker 03/1998. 5 tahap investigasi 4P, perbandingan 5-Why vs Fishbone vs SCAT DNV model, CAPA & laporan Form KK2.",
        "keywords": "metode investigasi kecelakaan kerja, root cause analysis scat k3, analisis 5 why kecelakaan, form laporan kecelakaan bentuk 3 kk2, permenaker 03 1998",
        "content": art20_content.strip(),
        "faq_data": art20_faqs
    }
]

def main():
    print("=== DEEP REWRITE BATCH 16, 17, 19, 20 (Target: >= 1,500 words per article) ===")
    for item in articles_data_batch4:
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
