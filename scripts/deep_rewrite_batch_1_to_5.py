"""
scripts/deep_rewrite_batch_1_to_5.py
Generates and uploads authoritative, 1,500+ word guides for Articles 1 to 5.
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
# ARTICLE 1: BIAYA PELATIHAN AHLI K3 UMUM KEMNAKER RI 2026
# ==============================================================================
art1_content = """
<h2>Berapa Biaya Pelatihan Ahli K3 Umum Kemnaker RI Tahun 2026?</h2>
<p>Bagi calon profesional Keselamatan dan Kesehatan Kerja (K3) maupun manajemen Human Resources (HRD) perusahaan, salah satu pertanyaan paling mendasar sebelum memutuskan mendaftar adalah: <strong>Berapa sebenarnya rincian biaya pelatihan Ahli K3 Umum (AK3U) bersertifikasi resmi Kementerian Ketenagakerjaan RI di tahun 2026?</strong> Mengapa harga di pasaran bisa berkisar dari Rp 4.500.000 hingga lebih dari Rp 8.500.000? Fasilitas apa saja yang wajib diterima peserta tanpa ada biaya tersembunyi, dan bagaimana cara memastikan bahwa lembaga yang Anda pilih adalah Perusahaan Jasa K3 (PJK3) resmi yang terdaftar di Kemnaker RI?</p>

<p>Di tahun 2026, standar tarif pembinaan calon Ahli K3 Umum di Indonesia berada pada rentang <strong>Rp 4.500.000 hingga Rp 5.800.000 untuk metode Online Blended Learning</strong>, dan <strong>Rp 6.800.000 hingga Rp 8.800.000 untuk metode Tatap Muka (Offline Classroom)</strong>. Perbedaan nominal ini bukan sekadar margin keuntungan penyelenggara, melainkan ditentukan secara ketat oleh komponen operasional riil: metode praktikum (PKL), akomodasi hotel berbintang, konsumsi harian, biaya pengawasan resmi pengawas ketenagakerjaan, serta pengurusan berkas legalitas kenegaraan (Sertifikat, Surat Keputusan Penunjukan / SKP, dan Lisensi Kewenangan).</p>

<h2>Tabel Komparasi Menyeluruh: Online Blended Learning vs Tatap Muka (Offline)</h2>
<p>Untuk membantu Anda memilih metode yang paling efisien sesuai ketersediaan anggaran dan waktu luang, berikut adalah tabel perbandingan komparatif antara kelas daring (online) dan kelas luring (offline) di PJK3 Wahana Totalita Konsultan:</p>

<table>
  <thead>
    <tr>
      <th>Parameter Penilaian</th>
      <th>Kelas Online Blended Learning</th>
      <th>Kelas Tatap Muka (Offline Yogyakarta)</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>Rentang Biaya Investasi 2026</strong></td>
      <td>Rp 4.500.000 – Rp 5.800.000 / peserta</td>
      <td>Rp 6.800.000 – Rp 8.800.000 / peserta</td>
    </tr>
    <tr>
      <td><strong>Durasi &amp; Jam Pelajaran (JPL)</strong></td>
      <td>12 Hari Kerja Efektif (~120 JPL Standar Kemnaker)</td>
      <td>12 Hari Kerja Efektif (~120 JPL Standar Kemnaker)</td>
    </tr>
    <tr>
      <td><strong>Media &amp; Sarana Belajar</strong></td>
      <td>Aplikasi Zoom Cloud Meetings HD + Cloud LMS Google Classroom</td>
      <td>Ruang Ballroom Hotel Berbintang / Training Center Ber-AC Penuh</td>
    </tr>
    <tr>
      <td><strong>Pelaksanaan Praktik Kerja Lapangan (PKL)</strong></td>
      <td>Observasi Virtual Video Industri 360&deg; + Analisis Dokumen Daring</td>
      <td>Kunjungan Lapangan Langsung ke Kawasan Industri Pabrik Mitra Resmi</td>
    </tr>
    <tr>
      <td><strong>Konsumsi &amp; Akomodasi Harian</strong></td>
      <td>Mandiri di kediaman / kantor masing-masing peserta</td>
      <td>2x Coffee Break Premium + 1x Makan Siang Prasmanan Hotel setiap hari</td>
    </tr>
    <tr>
      <td><strong>Legalitas yang Didapatkan</strong></td>
      <td>Sertifikat Kemnaker + SKP + Lisensi (Dokumen Fisik Dikirim Gratis)</td>
      <td>Sertifikat Kemnaker + SKP + Lisensi (Penyerahan Langsung / Kirim)</td>
    </tr>
    <tr>
      <td><strong>Kebutuhan Perangkat Peserta</strong></td>
      <td>Laptop/PC, Webcam Aktif, Headset, Koneksi Internet Stabil min. 10 Mbps</td>
      <td>Pakaian Kemeja Putih, Celana Gelap Formal, Alat Tulis Standar</td>
    </tr>
    <tr>
      <td><strong>Profil Peserta yang Cocok</strong></td>
      <td>Karyawan aktif, profesional jarak jauh/luar pulau, fresh graduate hemat biaya</td>
      <td>Delegasi korporat yang membutuhkan fokus isolasi penuh bebas tugas harian</td>
    </tr>
  </tbody>
</table>

<h2>Rincian Komponen Fasilitas All-In yang Wajib Anda Terima</h2>
<p>Banyak calon peserta terjebak oleh iklan digital yang menawarkan biaya kursus K3 murah di bawah Rp 3.500.000. Namun, saat pelatihan berjalan atau saat kelulusan tiba, peserta dikenai pungutan tambahan jutaan rupiah untuk biaya administrasi ujian evaluasi, biaya cetak kartu lisensi, atau ongkos kirim berkas sertifikat. Di <strong>PT Wahana Totalita Konsultan</strong>, seluruh pembiayaan bersifat <strong>transparan, pasti, dan All-Inclusive</strong>. Rincian fasilitas yang Anda peroleh mencakup:</p>

<h3>1. Paket Berkas Legalitas Resmi Negara dari Kemnaker RI</h3>
<ul>
  <li><strong>Sertifikat Pembinaan Calon Ahli K3 Umum:</strong> Diterbitkan langsung oleh Kementerian Ketenagakerjaan RI, ditandatangani pejabat Direktur Bina Kelembagaan K3, memiliki nomor registrasi nasional yang terverifikasi di portal Teman K3. Berlaku seumur hidup sebagai bukti kompetensi personal.</li>
  <li><strong>Surat Keputusan Penunjukan (SKP) Ahli K3:</strong> Diterbitkan bagi peserta utusan perusahaan yang melampirkan surat rekomendasi direksi. Dokumen ini melegalkan kewenangan Anda bertindak sebagai sekretaris P2K3 di perusahaan tempat Anda bekerja. Berlaku 3 tahun.</li>
  <li><strong>Lisensi Kewenangan Ahli K3 (Kartu Kewenangan):</strong> Kartu lisensi berfoto resmi dari Kemnaker RI yang memuat nomor penunjukan dan masa berlaku 3 tahun.</li>
  <li><strong>Lencana (Pin) Resmi K3 Nasional:</strong> Pin logam lambang K3 Kemnaker RI untuk seragam dinas.</li>
  <li><strong>Surat Keterangan Lulus Sementara (SKL):</strong> Diterbitkan langsung oleh PJK3 Wahana Totalita segera setelah sidang PKL selesai, berguna untuk keperluan mendesak audit ISO atau lamaran kerja sebelum fisik sertifikat Kemnaker turun.</li>
</ul>

<h3>2. Materi, Kit Pelatihan, dan Sarana Pembelajaran Eksklusif</h3>
<ul>
  <li><strong>Himpunan Peraturan Perundangan K3:</strong> 2 jilid buku fisik tebal memuat kompilasi lengkap UU No. 1/1970, Peraturan Pemerintah, Permenaker, dan Surat Edaran teknis yang menjadi referensi utama praktisi K3.</li>
  <li><strong>Modul Ajar Komprehensif:</strong> Buku materi modul pelatihan lengkap, panduan identifikasi bahaya risiko (HIRADC/IBPRP), panduan investigasi kecelakaan kerja, dan audit internal SMK3 PP 50/2012.</li>
  <li><strong>Exclusive Training Kit:</strong> Tas ransel/backpack laptop formal, polo shirt eksklusif Wahana K3, buku catatan, pena seminar, dan name tag peserta.</li>
  <li><strong>Bebas Ongkos Kirim ke Seluruh Indonesia:</strong> Berkas kit pelatihan dan dokumen legalitas fisik sertifikat dikirim langsung ke alamat rumah atau kantor Anda via ekspedisi terpercaya (JNE YES / TIKI ONS) tanpa biaya tambahan sepeser pun.</li>
</ul>

<h2>Bedah Struktur Biaya Operasional PJK3: Mengapa Biaya AK3U Bernilai Jutaan Rupiah?</h2>
<p>Sebagian orang bertanya-tanya, apa yang menyebabkan sertifikasi Ahli K3 Umum memerlukan biaya sekitar Rp 4,5 juta hingga Rp 8,5 juta? Sebagai transparansi profesional, berikut adalah pos-pos pengeluaran wajib yang dialokasikan dalam penyelenggaraan pembinaan resmi standar Kemnaker RI:</p>
<ol>
  <li><strong>Penerimaan Negara Bukan Pajak (PNBP) &amp; Administrasi Registrasi Kemnaker:</strong> Setiap peserta yang didaftarkan ke portal Teman K3 Kemnaker RI memerlukan proses verifikasi legalitas ijazah, alokasi blanko sertifikat resmi ber-security paper berhologram kenegaraan, serta pencetakan kartu lisensi chip/barcode.</li>
  <li><strong>Honorarium &amp; Transportasi Pengawas Spesialis K3 Kemnaker RI:</strong> Sesuai ketentuan Permenaker No. 02/MEN/1992, materi perundangan dan teknis K3 tidak boleh diajarkan sembarang orang. Pengajar wajib merupakan Pengawas Ketenagakerjaan Spesialis K3 dari Kementerian Ketenagakerjaan RI dan Disnaker Provinsi, didukung praktisi industri bersertifikat TOT.</li>
  <li><strong>Biaya Observasi Praktik Kerja Lapangan (PKL) Industri:</strong> Penyelenggaraan PKL memerlukan koordinasi lintas institusi dengan pabrik manufaktur mitra atau penyusunan materi video studi kasus komprehensif, penyusunan laporan kelompok, serta honorarium dewan penguji sidang seminar PKL.</li>
  <li><strong>Pengadaan Buku Himpunan Peraturan Perundangan K3 Fisik:</strong> Kompilasi undang-undang K3 mencakup ribuan halaman peraturan cetak berkualitas tinggi yang dibagikan secara cuma-cuma kepada peserta sebagai pegangan karir seumur hidup.</li>
  <li><strong>Akomodasi Hotel &amp; F&amp;B Premium (Untuk Kelas Offline):</strong> Sewa ruangan ballroom hotel berbintang di Yogyakarta selama 12 hari berturut-turut, fasilitas projector multimedia, sound system, coffee break 2 kali sehari, dan makan siang prasmanan bergizi tinggi.</li>
</ol>

<h2>Waspada Modus Pelatihan K3 Bodong dan Ilegal: Kenali Perbedaannya</h2>
<p>Seiring meningkatnya syarat kepemilikan sertifikat Ahli K3 Umum untuk melamar kerja di sektor pertambangan, minyak dan gas (migas), konstruksi BUMN, dan manufaktur, oknum calo pelatihan tidak bertanggung jawab kian marak. Mereka menawarkan sertifikat instan tanpa proses belajar dan tanpa ujian evaluasi Kemnaker RI. Anda wajib waspada terhadap tanda-tanda bahaya (<em>red flags</em>) berikut:</p>

<table>
  <thead>
    <tr>
      <th>Indikator Keabsahan</th>
      <th>PJK3 Resmi (Wahana Totalita Konsultan)</th>
      <th>Lembaga Kursus Abal-Abal / Calo</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>Surat Keputusan Penunjukan PJK3</strong></td>
      <td>Memiliki SK Penunjukan resmi PJK3 Bidang Pembinaan K3 dari Kemnaker RI yang masih aktif.</td>
      <td>Hanya berbadan hukum yayasan/CV biasa tanpa SK PJK3 dari Ditjen Binwasnaker &amp; K3.</td>
    </tr>
    <tr>
      <td><strong>Registrasi Portal Teman K3</strong></td>
      <td>Setiap peserta diinput dan didaftarkan pada database Teman K3 resmi (temank3.kemnaker.go.id).</td>
      <td>Tidak memiliki akun PJK3 di Teman K3; registrasi dilakukan secara manual fiktif.</td>
    </tr>
    <tr>
      <td><strong>Durasi Waktu Pelatihan</strong></td>
      <td>Wajib 12 hari kerja penuh (sesuai kurikulum Permenaker No. 02/MEN/1992).</td>
      <td>Menjanjikan kursus kilat 2–3 hari selesai atau bahkan langsung terima sertifikat tanpa kelas.</td>
    </tr>
    <tr>
      <td><strong>Instruktur &amp; Penguji</strong></td>
      <td>Pengawas Spesialis K3 Kemnaker RI, Pejabat Disnaker Provinsi, dan Praktisi Senior K3.</td>
      <td>Pengajar non-sertifikasi tanpa kehadiran pengawas ketenagakerjaan resmi pada saat evaluasi.</td>
    </tr>
    <tr>
      <td><strong>Hasil Ujian Akhir</strong></td>
      <td>Sertifikat bertanda tangan barcode digital resmi Kemnaker RI yang dapat dipindai keabsahannya.</td>
      <td>Hanya menerbitkan sertifikat internal lembaga atau sertifikat Kemnaker palsu hasil rekayasa grafis.</td>
    </tr>
  </tbody>
</table>

<h2>Skema Pembayaran Fleksibel dan Panduan Pengajuan Dana Perusahaan</h2>
<p>Bagi peserta mandiri (fresh graduate dan jobseeker), Wahana Totalita Konsultan menyediakan fasilitas <strong>skema pembayaran bertahap (cicilan tanpa bunga)</strong>. Peserta cukup membayarkan uang muka (DP) pendaftaran sebesar Rp 1.000.000 untuk mengamankan slot kelas dan menerima pengiriman modul ajar. Pelunasan sisa biaya dapat diangsur secara fleksibel sebelum hari evaluasi ujian Kemnaker berlangsung.</p>

<p>Sementara itu, bagi peserta korporat (utusan perusahaan), kami menyediakan kelengkapan administrasi penagihan profesional secara lengkap, meliputi:</p>
<ol>
  <li>Surat Penawaran Resmi (Quotation) lengkap dengan rincian silabus materi standar Kemnaker RI.</li>
  <li>Surat Konfirmasi Pendaftaran (Confirmation Letter) bermaterai.</li>
  <li>Faktur Pajak Elektronik (e-Faktur PPh 23 / PPN 11%) resmi terdaftar di DJP.</li>
  <li>Invoice tagihan dengan termin pembayaran fleksibel (CBD atau COD sesuai kontrak kerjasama corporate).</li>
  <li>Laporan evaluasi kehadiran peserta dan transkrip nilai pasca-pelatihan untuk arsip Human Capital Management (HCM).</li>
</ol>

<h2>Menghitung ROI (Return on Investment) Sertifikasi Ahli K3 Umum</h2>
<p>Biaya investasi sekitar Rp 5 juta untuk sertifikasi Ahli K3 Umum sering kali dianggap pengeluaran besar oleh sebagian orang. Namun, jika dihitung secara rasional dari perspektif keuntungan karir dan bisnis, sertifikasi ini memberikan tingkat pengembalian investasi (ROI) yang luar biasa tinggi:</p>
<ul>
  <li><strong>Bagi Profesional Individu:</strong> Rata-rata gaji awal (starting salary) seorang Safety Officer bersertifikasi Kemnaker RI di Indonesia berkisar antara Rp 6.000.000 hingga Rp 12.000.000 per bulan, tergantung industri. Biaya pelatihan Anda akan tertutupi hanya dalam 1 bulan pertama masa kerja Anda.</li>
  <li><strong>Bagi Perusahaan:</strong> Mempekerjakan Ahli K3 Umum bersertifikat resmi melindungi perusahaan dari ancaman sanksi pidana kurungan dan denda akibat pelanggaran UU No. 1/1970, menurunkan rasio kecelakaan kerja (Zero Accident), menekan premi asuransi aset, serta membuka peluang memenangkan tender bernilai miliaran rupiah di BUMN dan LPSE yang mensyaratkan personil K3 tersertifikasi.</li>
</ul>

<h2>Tahapan Pendaftaran Pelatihan di Wahana Totalita Konsultan</h2>
<p>Proses registrasi pembinaan Ahli K3 Umum di Wahana Totalita Konsultan dirancang sangat praktis dan cepat melalui langkah-langkah berikut:</p>
<ol>
  <li><strong>Konsultasi &amp; Pemilihan Jadwal:</strong> Hubungi Tim Corporate Advisor kami via WhatsApp untuk mengecek ketersediaan jadwal terdekat dan promo cashback bulan berjalan.</li>
  <li><strong>Pengisian Formulir Online:</strong> Mengisi data diri lengkap dan mengunggah berkas syarat (KTP, Ijazah minimal D3/S1 semua jurusan, pasfoto background merah, dan surat keterangan kerja jika ada).</li>
  <li><strong>Pembayaran Booking Fee:</strong> Melakukan transfer komitmen DP ke rekening resmi bank perusahaan PT Wahana Totalita Konsultan.</li>
  <li><strong>Penerimaan Training Kit:</strong> Modul 2 jilid undang-undang K3 dan perlengkapan seminar dikirimkan ke alamat Anda sebelum hari pertama pelatihan dimulai.</li>
  <li><strong>Pelaksanaan Pelatihan 12 Hari:</strong> Mengikuti sesi interaktif Zoom, bimbingan praktisi, penyusunan laporan PKL, seminar presentasi, dan evaluasi online resmi Kemnaker RI.</li>
</ol>
"""

art1_faqs = [
    {
        "question": "Apakah biaya pelatihan Ahli K3 Umum sudah termasuk biaya ujian dan pengiriman sertifikat?",
        "answer": "Ya, di Wahana Totalita Konsultan seluruh biaya bersifat All-In tanpa biaya tersembunyi. Biaya sudah mencakup pendaftaran di portal Teman K3 Kemnaker, honorarium pengawas Kemenaker, bimbingan ujian evaluasi, modul 2 jilid himpunan perundangan fisik, training kit eksklusif, serta pengiriman sertifikat asli, SKP, dan kartu lisensi ke alamat rumah/kantor Anda di seluruh wilayah Indonesia secara gratis."
    },
    {
        "question": "Apakah lulusan D3 atau S1 Non-Teknik dikenakan biaya pelatihan yang sama?",
        "answer": "Sama persis. Tidak ada diskriminasi biaya berdasarkan latar belakang pendidikan. Baik lulusan teknik, manajemen, hukum, kesehatan masyarakat, psikologi, maupun jurusan sosial lainnya dikenakan tarif investasi yang sama persis sesuai paket kelas (Online Blended Learning atau Tatap Muka Offline)."
    },
    {
        "question": "Berapa lama fisik Sertifikat, SKP, dan Lisensi Kemnaker terbit setelah ujian?",
        "answer": "Penerbitan dokumen legalitas negara dari Kementerian Ketenagakerjaan RI umumnya membutuhkan waktu verifikasi dan cetak berkisar antara 1,5 hingga 3 bulan pasca kelulusan sidang. Namun, segera setelah pelatihan selesai dan dinyatakan lulus, Wahana Totalita Konsultan langsung menerbitkan Surat Keterangan Lulus Sementara (SKL) resmi yang sah digunakan untuk melamar pekerjaan atau keperluan audit perusahaan."
    },
    {
        "question": "Apakah pembayaran biaya pelatihan bisa dicicil?",
        "answer": "Bisa. Kami menyediakan skema pembayaran cicilan fleksibel bagi peserta mandiri/fresh graduate. Anda cukup membayar DP booking sebesar Rp 1.000.000 untuk mengamankan kursi dan mendapatkan pengiriman modul fisik, kemudian sisa pelunasan dapat dicicil sebelum evaluasi ujian akhir Kemnaker dilaksanakan."
    },
    {
        "question": "Apa perbedaan fasilitas kelas Online Blended Learning dan Offline Yogyakarta?",
        "answer": "Materi, durasi 12 hari (120 JPL), kurikulum, penguji, dan sertifikat Kemnaker yang diperoleh 100% identik dan memiliki status legalitas yang sama persis. Perbedaannya hanya terletak pada media belajar (Zoom vs Ballroom Hotel) dan pelaksanaan PKL (analisis video virtual industri vs kunjungan fisik langsung ke pabrik mitra di Yogyakarta) serta fasilitas makan siang/coffee break pada kelas offline."
    }
]

# ==============================================================================
# ARTICLE 2: SYARAT AHLI K3 UMUM KEMNAKER NON-TEKNIK
# ==============================================================================
art2_content = """

<h2>Tahapan Lengkap Sidang PKL bagi Peserta Non-Teknik: Dari Observasi ke Dewan Penguji</h2>
<p>Kekhawatiran terbesar peserta non-teknik biasanya memuncak saat memasuki sesi Praktik Kerja Lapangan (PKL) pada hari ke-9 dan ke-10 pembinaan. Padahal, jika Anda memahami sistematika ilmiah penyusunan laporan PKL standar Kemnaker RI, proses ini justru menjadi ajang pembuktian kapasitas analitis Anda.</p>

<p>Berikut adalah 4 tahapan kunci dalam menuntaskan PKL dengan nilai A:</p>
<ol>
  <li><strong>Observasi Video Industri &amp; Pemetaan Temuan:</strong> Dalam metode online blended learning, peserta disajikan rekaman video operasional pabrik atau proyek secara detail. Tugas Anda adalah mencatat setiap temuan kondisi tidak aman (Unsafe Conditions) seperti kabel terkelupas, lantai licin, ketiadaan safety sign, serta tindakan tidak aman (Unsafe Acts) seperti pekerja tidak mengenakan helm atau merokok di dekat drum solvent.</li>
  <li><strong>Kompilasi Temuan Positif dan Negatif:</strong> Laporan PKL Kemnaker RI wajib memuat keseimbangan antara temuan positif (hal-hal baik yang sudah dipatuhi perusahaan) dan temuan negatif (pelanggaran regulasi). Sebagai sarjana non-teknis, Anda dapat memberikan apresiasi pada tata kelola SOP, rambu visual, dan komitmen manajemen pada temuan positif.</li>
  <li><strong>Penyusunan Matriks Dasar Hukum &amp; Rekomendasi Solutif:</strong> Pada setiap temuan negatif, cantumkan pasal spesifik dari Undang-Undang atau Permenaker yang dilanggar, kemudian buat saran perbaikan yang realistis (jangka pendek, menengah, dan panjang). Ketepatan mengutip pasal inilah yang paling diapresiasi oleh tim pengawas ketenagakerjaan.</li>
  <li><strong>Presentasi Kelompok dan Ujian Tanya Jawab Sidang:</strong> Dalam sesi sidang pleno, masing-masing anggota kelompok mempresentasikan satu bidang pengawasan (misal: Kelembagaan K3 &amp; Keahlian K3, Mekanik &amp; Pesawat Uap, Listrik &amp; Kebakaran, Kesehatan Kerja &amp; Lingkungan Kerja). Kuasai materi bidang Anda dan jawablah pertanyaan penguji dengan tenang berbasis regulasi tertulis.</li>
</ol>

<h2>Checklist Kelayakan Dokumen Pendaftaran Sebelum Submit ke Teman K3</h2>
<p>Sebelum mengirimkan dokumen pendaftaran ke Wahana Totalita Konsultan, pastikan Anda telah memeriksa kelengkapan berkas berikut guna menghindari penolakan verifikasi oleh sistem Kemnaker:</p>
<ul>
  <li>Ijazah D3/D4/S1 asli telah dipindai (scan) lurus tanpa terpotong, format PDF/JPG kapasitas di bawah 2 MB.</li>
  <li>NIK pada KTP terdaftar aktif di Dukcapil nasional dan sinkron dengan database Kemnaker.</li>
  <li>Pasfoto formal mengenakan jas gelap dan kemeja putih dengan latar belakang warna merah solid (bukan editan kasar).</li>
  <li>Mengisi surat fakta integritas kesediaan mengikuti seluruh jam pelajaran pelatihan tanpa absen.</li>
</ul>

<h2>Bolehkah Jurusan Non-Teknik Menjadi Ahli K3 Umum Kemnaker RI?</h2>
<p>Banyak lulusan perguruan tinggi dari disiplin ilmu sosial, ekonomi, hukum, psikologi, komunikasi, hingga pendidikan mengurungkan niat berkarir di bidang Keselamatan dan Kesehatan Kerja (K3) karena terbentur anggapan keliru bahwa profesi ini hanya diperuntukkan bagi sarjana Teknik Sipil, Mesin, Elektro, atau Kimia. <strong>Apakah benar sarjana non-teknis tidak bisa menjadi Ahli K3 Umum resmi bersertifikasi Kemnaker RI? Jawabannya adalah sama sekali TIDAK BENAR.</strong></p>

<p>Kementerian Ketenagakerjaan Republik Indonesia secara eksplisit membuka pintu selebar-lebarnya bagi lulusan perguruan tinggi dari <strong>SELURUH JURUSAN</strong> untuk mengikuti pembinaan calon Ahli K3 Umum. Di era industri modern saat ini, kompetensi K3 tidak lagi dipandang semata-mata sebagai urusan kalkulasi teknis mesin, melainkan telah bertransformasi menjadi <em>Culture &amp; Behavior Management</em>, kepatuhan hukum regulasi, audit sistem manajemen (SMK3 PP 50/2012 / ISO 45001), serta komunikasi keselamatan interaktif di semua lini organisasi.</p>

<h2>Landasan Hukum Resmi: Permenaker No. Per.02/MEN/1992</h2>
<p>Ketentuan mengenai kualifikasi calon personil Ahli Keselamatan dan Kesehatan Kerja diatur secara berkekuatan hukum tetap dalam <strong>Peraturan Menteri Tenaga Kerja RI No. Per.02/MEN/1992 tentang Tata Cara Penunjukan Kewajiban dan Wewenang Ahli Keselamatan dan Kesehatan Kerja</strong>. Pada Bab III mengenai Syarat-Syarat Penunjukan Ahli K3, Pasal 3 ayat (1) menyatakan secara gamblang:</p>
<blockquote>
  <p>"Untuk dapat ditunjuk sebagai Ahli Keselamatan dan Kesehatan Kerja harus memenuhi syarat-syarat sebagai berikut:<br>
  a. Berpendidikan Sarjana, Sarjana Muda atau Sederajat dengan ketentuan:<br>
  - Sarjana dengan pengalaman kerja sesuai dengan bidang keahliannya sekurang-kurangnya 2 (dua) tahun;<br>
  - Sarjana Muda atau Sederajat dengan pengalaman kerja sesuai dengan bidang keahliannya sekurang-kurangnya 4 (empat) tahun;<br>
  b. Berbadan sehat;<br>
  c. Berkelakuan baik;<br>
  d. Bekerja penuh pada perusahaan yang bersangkutan;<br>
  e. Lulus seleksi dari Tim Penilai."</p>
</blockquote>

<p>Perhatikan bahwa dalam pasal tersebut, <strong>tidak ada satu frasa pun yang mewajibkan ijazah harus berlatar belakang teknik</strong>. Kualifikasi minimal yang diakui pemerintah adalah ijazah Diploma 3 (D3) atau Strata 1 (S1) dari perguruan tinggi terakreditasi nasional, terlepas dari program studinya. Baik Anda lulusan Manajemen Bisnis, Ilmu Hukum, Akuntansi, Sastra Inggris, Ilmu Komunikasi, Administrasi Publik, Kesehatan Masyarakat, Farmasi, hingga Biologi, Anda memiliki hak hukum yang setara untuk menyandang gelar dan lisensi Ahli K3 Umum.</p>

<h2>Matriks Pemetaan: Keunggulan Kompetensi Jurusan Non-Teknik di Bidang K3</h2>
<p>Faktanya, implementasi K3 di tempat kerja membutuhkan perpaduan holistik antara pemahaman teknis bahaya fisik dan keahlian manajerial. Lulusan non-teknik justru membawa kekuatan unik yang sangat dibutuhkan oleh departemen QHSE (Quality, Health, Safety, and Environment):</p>

<table>
  <thead>
    <tr>
      <th>Latar Belakang Pendidikan</th>
      <th>Kekuatan &amp; Kompetensi Alami</th>
      <th>Kontribusi Nyata dalam Tim K3 Perusahaan</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>Ilmu Hukum (Sarjana Hukum)</strong></td>
      <td>Penguasaan perundang-undangan, compliance audit, analisa klausul kontrak kerja vendor/subkontraktor.</td>
      <td>Memastikan perusahaan terhindar dari sanksi hukum pidana/perdata K3, penyusunan SOP legal, penanganan investigasi forensik ketenagakerjaan.</td>
    </tr>
    <tr>
      <td><strong>Kesehatan Masyarakat / Keperawatan</strong></td>
      <td>Epidemiologi, kesehatan kerja (Occupational Health), surveilans biologis, ergonomi, promosi gaya hidup sehat.</td>
      <td>Pengelolaan Medical Check-Up (MCU) berkala, pencegahan Penyakit Akibat Kerja (PAK), manajemen klinik perusahaan dan ergonomi kantor.</td>
    </tr>
    <tr>
      <td><strong>Psikologi / Manajemen SDM</strong></td>
      <td>Behavior-Based Safety (BBS), psikologi industri, manajemen stres kerja, rekrutmen berbasis safety mindset.</td>
      <td>Membangun budaya selamat (safety culture), mereduksi tindakan tidak aman (unsafe acts) karyawan yang menyumbang 88% kecelakaan kerja.</td>
    </tr>
    <tr>
      <td><strong>Ilmu Komunikasi / Hubungan Masyarakat</strong></td>
      <td>Public speaking persuasif, kampanye visual, media edukasi kreatif, manajemen krisis media pasca insiden.</td>
      <td>Memimpin Safety Induction, Toolbox Meeting (TBM), Safety Talk harian, serta perancangan poster dan video K3 yang menarik dan efektif.</td>
    </tr>
    <tr>
      <td><strong>Manajemen / Akuntansi / Ekonomi</strong></td>
      <td>Perencanaan anggaran (budgeting), analisis biaya-manfaat (Cost-Benefit Analysis), audit sistem manajemen.</td>
      <td>Perhitungan Return on Safety Investment (ROSI), audit dokumentasi SMK3 PP 50/2012, efisiensi belanja APD dan pemeliharaan alat K3.</td>
    </tr>
  </tbody>
</table>

<h2>Berkas Dokumen Persyaratan Pendaftaran Calon Ahli K3 Umum</h2>
<p>Bagi calon peserta non-teknis (baik berstatus karyawan perusahaan maupun fresh graduate mandiri yang belum bekerja), berikut adalah checklist dokumen administratif yang wajib dipersiapkan untuk pendaftaran di PJK3 Wahana Totalita Konsultan:</p>
<ol>
  <li><strong>Salinan Ijazah Terakhir (Minimal D3/D4/S1):</strong> Scan warna asli atau fotokopi legalisir basah dari kampus. Bagi fresh graduate yang ijazahnya belum terbit, dapat menggunakan Surat Keterangan Lulus (SKL) resmi dari pihak rektorat/dekanat.</li>
  <li><strong>Kartu Tanda Penduduk (KTP):</strong> Scan warna e-KTP yang masih berlaku dengan data NIK terbaca jelas.</li>
  <li><strong>Surat Keterangan Bekerja / Rekomendasi Perusahaan:</strong> Khusus bagi peserta utusan perusahaan yang menginginkan penerbitan SKP dan Lisensi atas nama perusahaannya. Bagi peserta fresh graduate / mandiri, dokumen ini digantikan dengan <em>Surat Pernyataan Mandiri</em> yang format resminya disediakan oleh Wahana Totalita Konsultan.</li>
  <li><strong>Pasfoto Formal Terbaru:</strong> File pasfoto formal berlatar belakang merah polos dengan pakaian kemeja putih dan jas formal gelap (dilarang menggunakan kaos polo atau selfie).</li>
  <li><strong>Curriculum Vitae (CV):</strong> Lembar riwayat hidup singkat memuat riwayat pendidikan formal dan kontak aktif.</li>
</ol>

<h2>Strategi dan Tips Sukses Lulus Pembinaan AK3U bagi Peserta Non-Teknik</h2>
<p>Bagi Anda yang tidak memiliki latar belakang ilmu eksakta, materi pembinaan pada minggu pertama yang membahas pengawasan mekanik, bejana tekan, instalasi uap boiler, proteksi kebakaran, dan kelistrikan mungkin terdengar intimidatif. Namun, instruktur di Wahana Totalita Konsultan menerapkan pendekatan andragogi (pembelajaran orang dewasa) berbasis analogi praktis dan studi kasus visual.</p>

<p>Berikut adalah 5 tips strategis agar Anda dapat lulus dengan predikat memuaskan:</p>
<ul>
  <li><strong>Fokus pada Logika Bahaya Regulasi, Bukan Rumus Fisika Rumit:</strong> Pembinaan calon Ahli K3 Umum Kemnaker RI tidak menguji Anda untuk menghitung tegangan listrik atau termodinamika pipa secara matematis, melainkan menguji pemahaman Anda terhadap <em>kepatuhan batas aman (Safety Margin)</em>, jarak aman, pemasangan safety device (safety valve, interlock), serta kelengkapan riksa uji berkala sesuai Permenaker.</li>
  <li><strong>Kuasai Peta Himpunan Peraturan Perundangan:</strong> Saat ujian evaluasi berlangsung, Anda diuji kemampuannya mencari dasar hukum secara cepat dan akurat. Gunakan sticky notes berwarna pada buku himpunan undang-undang K3 Anda berdasarkan topik (Mekanik = Permenaker 08/2020; Bejana Tekan = Permenaker 37/2016; Listrik = Permenaker 12/2015; Kebakaran = Kepmenaker 186/1999).</li>
  <li><strong>Pahami Pola 5 Tahap Hirarki Pengendalian Risiko:</strong> Setiap kali menghadapi soal studi kasus kecelakaan kerja di ujian, selesaikan dengan menerapkan hirarki pengendalian standar ISO 45001 dan SMK3: Eliminasi &rarr; Substitusi &rarr; Rekayasa Teknik (Engineering Control) &rarr; Pengendalian Administratif &rarr; Alat Pelindung Diri (APD). Pola ini selalu mendapatkan nilai maksimal dari tim penguji Ditjen Binwasnaker.</li>
  <li><strong>Aktif Berkolaborasi dalam Tim Studi Kasus PKL:</strong> Dalam pembagian kelompok Praktik Kerja Lapangan (PKL), peserta non-teknik biasanya dipasangkan dengan rekan peserta berlatar belakang teknik. Manfaatkan kesempatan ini untuk bertukar perspektif: rekan teknik menganalisis kondisi fisik mesin, sementara Anda menyusun matriks risiko, regulasi kepatuhan hukum, dan alur SOP-nya.</li>
  <li><strong>Pelajari Bank Soal Simulasi Ujian Kemnaker:</strong> Wahana Totalita Konsultan menyediakan bank soal try-out evaluasi komprehensif, mencakup soal pilihan ganda, essay kasus kecelakaan kerja, dan studi tata cara pelaporan P2K3, sehingga Anda sudah sangat familiar sebelum hari ujian sesungguhnya tiba.</li>
</ul>

<h2>Studi Kasus Nyata: Mengapa HRD Memilih Sarjana Non-Teknik untuk Posisi K3</h2>
<p>Dalam praktiknya di lapangan industri modern, perusahaan seringkali menemukan kendala ketika menunjuk insinyur teknik murni sebagai kepala keselamatan kerja. Kendala tersebut adalah kecenderungan fokus semata pada mesin dan peralatan, namun kerap kesulitan saat harus mengaudit kepatuhan regulasi, menangani serikat pekerja, atau merancang kampanye keselamatan yang menarik empati buruh lapangan.</p>

<p>Sebagai contoh, sebuah pabrik manufaktur multinasional di Cikarang mengangkat seorang sarjana Ilmu Hukum yang bersertifikasi Ahli K3 Umum sebagai Safety Compliance Officer. Hasilnya, perusahaan berhasil menuntaskan audit SMK3 PP 50/2012 dengan skor 94% (Kategori Emas / Bendera Emas), menyelesaikan seluruh perizinan riksa uji alat angkat angkut yang sempat tertunda, serta menyusun SOP Izin Kerja Selamat (Permit to Work) yang tahan gugatan hukum saat terjadi sengketa ketenagakerjaan.</p>

<h2>Peluang Karir dan Jenjang Gaji Ahli K3 Non-Teknik</h2>
<p>Lulusan non-teknik yang memegang lisensi Ahli K3 Umum Kemnaker RI memiliki keunggulan kompetitif luar biasa di bursa kerja nasional. Berbagai posisi strategis siap menyerap kompetensi Anda:</p>
<ul>
  <li><strong>Safety Officer / HSE Officer:</strong> Bertanggung jawab atas inspeksi harian, briefing toolbox, pemantauan APD, dan pengurusan izin kerja selamat (Permit to Work). Gaji rata-rata: Rp 5.500.000 – Rp 9.000.000/bulan.</li>
  <li><strong>HSE Compliance &amp; Document Controller:</strong> Mengelola pemenuhan regulasi hukum K3, pelaporan triwulanan P2K3 ke Disnaker, serta pengarsipan audit SMK3 dan ISO 45001. Posisi ini sangat ideal bagi sarjana Hukum dan Administrasi. Gaji rata-rata: Rp 6.000.000 – Rp 10.000.000/bulan.</li>
  <li><strong>Behavioral Safety &amp; Training Specialist:</strong> Merancang program pembudayaan keselamatan, pelatihan internal staf, dan promosi kesehatan kerja. Sangat cocok bagi lulusan Psikologi dan Komunikasi. Gaji rata-rata: Rp 7.000.000 – Rp 12.000.000/bulan.</li>
  <li><strong>HSE Auditor &amp; Management Representative:</strong> Memimpin jalannya audit internal sistem manajemen keselamatan dan memfasilitasi audit eksternal dari badan sertifikasi independen. Gaji rata-rata: Rp 10.000.000 – Rp 18.000.000/bulan.</li>
</ul>
"""

art2_faqs = [
    {
        "question": "Apakah fresh graduate non-teknik yang belum pernah bekerja bisa mendaftar?",
        "answer": "Bisa. Fresh graduate lulusan D3 atau S1 dari semua jurusan diperbolehkan mengikuti pembinaan calon Ahli K3 Umum melalui jalur mandiri. Setelah dinyatakan lulus, peserta mandiri akan langsung menerima Sertifikat Pembinaan Calon Ahli K3 Umum resmi Kemnaker RI yang berlaku seumur hidup. Saat nantinya telah bekerja di perusahaan, sertifikat tersebut tinggal dilampirkan bersama surat rekomendasi direksi untuk penerbitan SKP dan Lisensi Ahli K3."
    },
    {
        "question": "Mengapa dalam Permenaker 02/1992 disebutkan syarat pengalaman kerja 2 tahun untuk sarjana?",
        "answer": "Klausul pengalaman kerja 2 tahun (untuk S1) atau 4 tahun (untuk D3) pada teks Permenaker No. 02/MEN/1992 sejatinya merujuk pada persyaratan penerbitan Surat Keputusan Penunjukan (SKP) operasional di perusahaan bersangkutan. Untuk mengikuti program pelatihan pembinaan dan memperoleh Sertifikat Kompetensi Calon Ahli K3 Umum, Kemnaker RI memberikan dispensasi penuh bagi lulusan baru (fresh graduate) demi mencetak kader-kader keselamatan kerja baru secara masif di Indonesia."
    },
    {
        "question": "Apakah nilai sertifikat Ahli K3 Umum jurusan non-teknik berbeda dengan jurusan teknik?",
        "answer": "Sama sekali tidak ada perbedaan. Format sertifikat, nomor registrasi nasional Teman K3, tandatangan pejabat Kemnaker RI, serta status legalitasnya 100% identik. Di lembar sertifikat resmi Kemnaker, tidak dicantumkan jurusan asal peserta, melainkan hanya menyatakan bahwa pemegang sertifikat telah memenuhi syarat kualifikasi sebagai Calon Ahli Keselamatan dan Kesehatan Kerja Umum."
    },
    {
        "question": "Jurusan non-teknik apa saja yang paling banyak dibutuhkan di industri K3?",
        "answer": "Jurusan non-teknik dengan serapan pasar kerja K3 tertinggi antara lain: Kesehatan Masyarakat (Occupational Health & Safety), Ilmu Hukum (Regulatory Compliance & Legal HSE), Psikologi (Behavior-Based Safety & Ergonomi Kognitif), Manajemen/Akuntansi (Audit SMK3 & Budgeting QHSE), serta Ilmu Komunikasi (Safety Campaign & Induction Training)."
    },
    {
        "question": "Apakah peserta non-teknik dijamin bisa lulus dalam pelatihan di Wahana Totalita Konsultan?",
        "answer": "Tingkat kelulusan peserta non-teknis di Wahana Totalita Konsultan mencapai lebih dari 98,5%. Kurikulum dan metode bimbingan kami dirancang interaktif dan aplikatif tanpa rumus teoritis rumit, dilengkapi sesi review materi harian, simulasi ujian try-out, serta pendampingan intensif dari mentor praktisi senior hingga sidang PKL selesai."
    }
]

# ==============================================================================
# ARTICLE 3: MASA BERLAKU SERTIFIKAT AHLI K3 UMUM PERPANJANGAN SKP
# ==============================================================================
art3_content = """

<h2>Checklist Audit Berkas Perpanjangan SKP Kemnaker: Panduan HRD dan HSE Officer</h2>
<p>Untuk mempermudah verifikasi internal di perusahaan Anda sebelum berkas diserahkan ke PJK3 Wahana Totalita, silakan gunakan tabel checklist audit berikut:</p>

<table>
  <thead>
    <tr>
      <th>No</th>
      <th>Item Dokumen Wajib</th>
      <th>Kriteria Validasi Kemnaker RI</th>
      <th>Status Verifikasi</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>1</td>
      <td>Surat Permohonan Direksi</td>
      <td>Kop resmi perusahaan, bermaterai Rp 10.000, tandatangan basah Direktur Utama / HR Director.</td>
      <td>Wajib Lengkap</td>
    </tr>
    <tr>
      <td>2</td>
      <td>Sertifikat Calon Ahli K3 Asli</td>
      <td>Scan warna halaman depan dan belakang memuat nomor registrasi nasional.</td>
      <td>Wajib Lengkap</td>
    </tr>
    <tr>
      <td>3</td>
      <td>SKP dan Kartu Lisensi Lama</td>
      <td>Fisik asli diserahkan ke Kemnaker untuk penarikan dan arsip pembaharuan.</td>
      <td>Wajib Lengkap</td>
    </tr>
    <tr>
      <td>4</td>
      <td>Laporan Triwulanan P2K3</td>
      <td>Minimal 4 laporan triwulan terakhir dengan cap tanda terima stempel Disnaker Provinsi/Kabupaten.</td>
      <td>Wajib Lengkap</td>
    </tr>
    <tr>
      <td>5</td>
      <td>Hasil Medical Check-Up (MCU)</td>
      <td>Pemeriksaan fisik lengkap dari dokter pemeriksa kesehatan kerja bersertifikat Kemnaker.</td>
      <td>Wajib Lengkap</td>
    </tr>
    <tr>
      <td>6</td>
      <td>Pasfoto Resmi Background Merah</td>
      <td>Pasfoto terbaru ukuran 3x4 dan 4x6 masing-masing 4 lembar berseragam kemeja/jas.</td>
      <td>Wajib Lengkap</td>
    </tr>
  </tbody>
</table>

<h2>Tata Cara Penyusunan Laporan Triwulanan P2K3 Sesuai Permenaker No. 04/1987</h2>
<p>Banyak permohonan perpanjangan SKP tertunda berbulan-bulan di Ditjen Binwasnaker hanya karena berkas laporan P2K3 yang dilampirkan tidak sesuai format baku. Berdasarkan Permenaker No. Per-04/MEN/1987 tentang P2K3 serta Tata Cara Penunjukan Ahli Keselamatan Kerja, laporan triwulanan wajib memuat:</p>
<ol>
  <li><strong>Struktur Organisasi P2K3 Terkini:</strong> Memuat nama Ketua P2K3 (unsur pimpinan perusahaan) dan Sekretaris P2K3 (Ahli K3 Umum ber-SKP) serta seksi-seksi bidang pengawasan.</li>
  <li><strong>Data Jam Kerja Selamat dan Jam Kerja Hilang:</strong> Rekapitulasi total jam kerja seluruh karyawan (Safe Manhours), jumlah kecelakaan nihil, atau rincian insiden jika terjadi kecelakaan (Lost Time Injury / LTI).</li>
  <li><strong>Analisis Statistik Frekuensi dan Keparahan (Frequency Rate &amp; Severity Rate):</strong> Rumus perhitungan standar Kemnaker untuk mengukur tingkat kekerapan dan keparahan cedera kerja.</li>
  <li><strong>Rangkuman Rapat Rutin Bulanan P2K3:</strong> Notulensi rapat keselamatan bulanan bersama perwakilan buruh/pekerja, isu-isu bahaya yang dilaporkan, dan tindakan korektif yang telah disetujui direksi.</li>
  <li><strong>Bukti Pengesahan Disnaker Setempat:</strong> Tanda terima fisik atau tanda tangan barcode pejabat Pengawas Ketenagakerjaan Disnaker setempat.</li>
</ol>

<h2>Masa Berlaku Sertifikat Ahli K3 Umum: Jangan Sampai Salah Kaprah!</h2>
<p>Salah satu kebingungan paling umum di kalangan praktisi keselamatan kerja pemula dan manajemen HRD adalah memahami <strong>masa berlaku dokumen Ahli K3 Umum Kemnaker RI</strong>. Seringkali muncul kekhawatiran: <em>"Apakah sertifikat Ahli K3 Umum saya akan hangus setelah 3 tahun dan saya wajib mengulang pelatihan 12 hari dari awal dengan biaya jutaan rupiah lagi?"</em></p>

<p>Jawaban tegasnya adalah: <strong>TIDAK PERLU mengulang pelatihan</strong>. Namun, terdapat perbedaan krusial yang wajib Anda pahami antara <strong>Sertifikat Pembinaan Calon Ahli K3 Umum</strong> dan <strong>Surat Keputusan Penunjukan (SKP) beserta Kartu Lisensi Kewenangan Ahli K3</strong>. Memahami perbedaan hukum kedua dokumen ini adalah kunci untuk menjaga status legalitas Anda sebagai pengawas keselamatan kerja resmi di mata Kementerian Ketenagakerjaan RI dan auditor sertifikasi internasional.</p>

<h2>Membedah 3 Dokumen Resmi Ahli K3 Umum Kemnaker RI</h2>
<p>Ketika Anda menyelesaikan pembinaan pembinaan Ahli K3 Umum melalui PJK3 resmi, pemerintah menerbitkan 3 instrumen legalitas kenegaraan yang memiliki fungsi dan masa aktif berbeda:</p>

<table>
  <thead>
    <tr>
      <th>Jenis Dokumen</th>
      <th>Pihak yang Ditunjuk / Melekat Pada</th>
      <th>Masa Berlaku Dokumen</th>
      <th>Kewajiban Perpanjangan</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>Sertifikat Pembinaan Calon Ahli K3 Umum</strong></td>
      <td>Melekat pada <strong>Pribadi Individu</strong> (Nama &amp; NIK Peserta)</td>
      <td><strong>SEUMUR HIDUP</strong> (Tidak Pernah Kadaluwarsa)</td>
      <td>Tidak perlu diperpanjang selamanya. Bukti permanen Anda telah lulus kualifikasi pengetahuan K3.</td>
    </tr>
    <tr>
      <td><strong>Surat Keputusan Penunjukan (SKP) Ahli K3</strong></td>
      <td>Melekat pada <strong>Hubungan Kerja</strong> antara Individu dan Perusahaan Pemberi Kerja</td>
      <td><strong>3 (Tiga) Tahun</strong> sejak tanggal penerbitan SK Menteri</td>
      <td><strong>WAJIB DIPERPANJANG</strong> setiap 3 tahun sekali selama Anda masih menjabat sebagai Ahli K3 di perusahaan tersebut.</td>
    </tr>
    <tr>
      <td><strong>Lisensi Kewenangan Ahli K3 (Kartu Lisensi)</strong></td>
      <td>Melekat bersama SKP sebagai kartu identitas dinas berfoto</td>
      <td><strong>3 (Tiga) Tahun</strong> (Masa aktif sinkron dengan SKP)</td>
      <td><strong>WAJIB DIPERPANJANG</strong> bersamaan dengan SKP melalui pengajuan berkas permohonan ke Kemnaker RI.</td>
    </tr>
  </tbody>
</table>

<h2>Dasar Regulasi: Permenaker No. Per-02/MEN/1992 &amp; Filosofi di Baliknya</h2>
<p>Landasan yuridis pembatasan masa berlaku SKP dan Lisensi diatur dalam <strong>Permenaker No. Per-02/MEN/1992 Pasal 7</strong>, yang menyatakan bahwa surat penunjukan sebagai Ahli K3 berlaku untuk jangka waktu 3 tahun dan dapat diperpanjang atas permohonan perusahaan tempat yang bersangkutan bekerja.</p>

<p>Mengapa pemerintah membatasi masa berlaku SKP hanya selama 3 tahun? Alasan utamanya adalah <strong>pengawasan aktif dan evaluasi kinerja</strong>. Pemerintah ingin memastikan bahwa:</p>
<ol>
  <li><strong>Pemegang Amanah Masih Aktif Bekerja:</strong> Memastikan personil yang bersangkutan memang benar-benar masih menjadi karyawan aktif di perusahaan tersebut dan bukan sekadar "pinjam nama" untuk formalitas tender.</li>
  <li><strong>Laporan P2K3 Disampaikan Berkala:</strong> Memastikan Panitia Pembina Keselamatan dan Kesehatan Kerja (P2K3) di perusahaan benar-benar berjalan aktif dengan dibuktikan adanya laporan triwulanan yang rutin diserahkan ke Dinas Tenaga Kerja setempat.</li>
  <li><strong>Kesehatan Fisik dan Mental Terjaga:</strong> Memastikan personil Ahli K3 masih dalam kondisi sehat jasmani dan rohani untuk menjalankan tanggung jawab pengawasan risiko tinggi melalui hasil uji Medical Check-Up (MCU) berkala.</li>
  <li><strong>Pemutakhiran Regulasi Ketenagakerjaan:</strong> Memastikan praktisi K3 terus memperbarui pemahamannya terhadap perubahan regulasi keselamatan kerja nasional yang terbit dalam 3 tahun terakhir.</li>
</ol>

<h2>Risiko Fatal bagi Perusahaan Jika SKP Ahli K3 Dibiarkan Kadaluwarsa</h2>
<p>Membiarkan SKP dan Lisensi Ahli K3 melewati masa tenggang (expired) tanpa diperpanjang menimbulkan konsekuensi hukum dan bisnis yang sangat serius bagi korporasi:</p>
<ul>
  <li><strong>Gugur Otomatis dalam Evaluasi Tender LPSE / Proyek BUMN:</strong> Seluruh panitia lelang pengadaan barang dan jasa pemerintah (LPSE) serta BUMN mensyaratkan personil Ahli K3 yang memiliki SKP dan Lisensi aktif. Dokumen yang kedaluwarsa berstatus gugur administrasi dan tidak dapat dinegosiasikan.</li>
  <li><strong>Temuan Kritis (Major Non-Conformance) Audit SMK3 &amp; ISO 45001:</strong> Auditor eksternal SMK3 PP 50/2012 maupun badan sertifikasi ISO 45001:2018 akan menerbitkan temuan ketidaksesuaian mayor jika sekretaris P2K3 yang ditunjuk tidak memiliki legitimasi SKP yang aktif dari Kemnaker RI.</li>
  <li><strong>Laporan Triwulanan P2K3 Ditolak Dinas Tenaga Kerja:</strong> Disnaker provinsi tidak akan mengesahkan laporan kegiatan keselamatan kerja berkala jika penanggung jawab K3 tidak berlisensi aktif.</li>
  <li><strong>Ancaman Sanksi Pidana UU No. 1 Tahun 1970:</strong> Manajemen perusahaan dapat dianggap mengabaikan kewajiban penyediaan pengawas keselamatan kerja berkualifikasi resmi sesuai perintah undang-undang ketenagakerjaan.</li>
</ul>

<h2>Syarat Berkas Administrasi Perpanjangan SKP &amp; Lisensi Ahli K3</h2>
<p>Untuk memproses perpanjangan SKP dan Lisensi Ahli K3 Umum yang hampir atau telah habis masa berlakunya, perusahaan wajib melengkapi dokumen-dokumen persyaratan berikut melalui PJK3 resmi Wahana Totalita Konsultan:</p>
<ol>
  <li><strong>Surat Permohonan Perpanjangan SKP Resmi:</strong> Dibuat di atas kop surat perusahaan, ditujukan kepada Direktur Bina Kelembagaan K3 Ditjen Binwasnaker &amp; K3 Kemnaker RI, dan ditandatangani oleh pimpinan direksi bermaterai Rp 10.000.</li>
  <li><strong>Sertifikat Pembinaan Calon Ahli K3 Umum Asli:</strong> Salinan scan warna resolusi tinggi (depan dan belakang).</li>
  <li><strong>SKP dan Lisensi Lama (Asli):</strong> Surat Keputusan Penunjukan dan kartu lisensi lama yang akan diperpanjang.</li>
  <li><strong>Laporan Rekapitulasi Kegiatan K3 (Laporan Triwulanan P2K3):</strong> Bukti laporan berkala pelaksanaan K3 di perusahaan selama minimal 1 tahun terakhir yang telah disahkan/dicap oleh Dinas Tenaga Kerja setempat.</li>
  <li><strong>Surat Keterangan Pemeriksaan Kesehatan (MCU):</strong> Hasil uji kesehatan berkala personil Ahli K3 bersangkutan dari dokter pemeriksa kesehatan tenaga kerja yang ber-SKP.</li>
  <li><strong>Pasfoto Formal Terbaru:</strong> File foto formal berlatar belakang merah mengenakan kemeja putih dan jas gelap.</li>
  <li><strong>Salinan Bukti Kepesertaan BPJS Ketenagakerjaan:</strong> Bukti aktif pembayaran iuran BPJS Ketenagakerjaan personil bersangkutan di perusahaan tersebut.</li>
</ol>

<h2>Bagaimana Jika Ahli K3 Pindah Perusahaan? (Prosedur Mutasi / Alih SKP)</h2>
<p>Pertanyaan yang paling sering dialami praktisi: <em>"Saya sudah memiliki SKP di PT A, tetapi bulan depan saya pindah kerja ke PT B. Apakah SKP saya otomatis hangus dan saya harus ujian lagi?"</em></p>
<p>Jawabannya: <strong>SKP Anda di PT A tidak bisa digunakan di PT B</strong>, karena SKP mengikat nama individu pada satu badan hukum perusahaan tertentu. Namun, Anda <strong>TIDAK PERLU mengulang pelatihan 12 hari</strong>. Yang wajib Anda tempuh adalah prosedur <strong>Mutasi / Alih Perusahaan SKP Ahli K3</strong>. Berkas yang diperlukan mencakup:</p>
<ul>
  <li><strong>Surat Pelepasan / Keterangan Tidak Berkeberatan:</strong> Diterbitkan oleh manajemen PT A (perusahaan lama) yang menyatakan bahwa yang bersangkutan telah resmi mengundurkan diri dan perusahaan lama tidak berkeberatan SKP-nya dialihkan ke perusahaan baru.</li>
  <li><strong>Surat Permohonan Penerbitan SKP Baru:</strong> Dibuat oleh direksi PT B (perusahaan baru) yang memohon penerbitan penunjukan baru atas nama karyawan tersebut.</li>
  <li><strong>Salinan Sertifikat Pembinaan Calon Ahli K3 Umum:</strong> Scan warna sertifikat asli milik individu.</li>
  <li><strong>SKP dan Kartu Lisensi Asli dari Perusahaan Lama:</strong> Dokumen fisik dikembalikan ke Kemnaker RI untuk ditarik dan digantikan dengan blanko baru.</li>
  <li><strong>Surat Kontrak Kerja / Surat Keputusan Pengangkatan:</strong> Bukti ikatan hubungan kerja sah di PT B.</li>
</ul>

<h2>Panduan Mengatasi Kendala: Jika Perusahaan Lama Menolak Memberi Surat Pelepasan</h2>
<p>Dalam kondisi tertentu, karyawan keluar dari perusahaan lama karena perselisihan atau perusahaan lama telah bangkrut dan tutup operasional sehingga tidak bisa menerbitkan surat pelepasan SKP. Jangan panik, Kemnaker RI memberikan solusi administratif:</p>
<ol>
  <li>Lampirkan <strong>Surat Pengalaman Kerja (Paklaring)</strong> atau bukti tanda terima surat pengunduran diri (one month notice) yang sah.</li>
  <li>Buat <strong>Surat Pernyataan Bermaterai Rp 10.000</strong> yang ditandatangani oleh individu bersangkutan, yang menyatakan secara sadar bahwa hubungan kerja dengan perusahaan lama telah berakhir secara hukum dan memohon pengalihan SKP ke perusahaan baru secara mandiri.</li>
  <li>Konsultasikan dokumen tersebut kepada tim legal PJK3 Wahana Totalita Konsultan agar berkas Anda dibantu verifikasinya di hadapan Direktorat Bina Kelembagaan K3.</li>
</ol>

<h2>Timeline Proses dan Estimasi Waktu Penerbitan SKP Baru di Kemnaker</h2>
<p>Proses perpanjangan maupun alih SKP saat ini dilakukan secara semi-daring melalui sistem informasi pelayanan ketenagakerjaan terintegrasi Kemnaker RI (Teman K3). Estimasi waktu pengerjaan berkas umumnya memakan waktu <strong>30 hingga 60 hari kerja</strong> tergantung antrean verifikasi di Direktorat Jenderal Pengawasan Ketenagakerjaan dan K3.</p>

<p>Oleh karena itu, kami sangat merekomendasikan perusahaan untuk memulai proses pemberkasan perpanjangan <strong>minimal 2 hingga 3 bulan sebelum masa berlaku SKP berakhir</strong>, agar tidak terjadi kekosongan legalitas operasional di lapangan. Kecepatan penerbitan SKP sangat bergantung pada kelengkapan laporan kegiatan P2K3 triwulanan dan validitas hasil pemeriksaan kesehatan (MCU) personil. Tim konsultan Wahana Totalita siap melakukan pra-audit berkas Anda secara gratis sebelum submit ke sistem Teman K3 Kemnaker RI guna menjamin proses berjalan mulus tanpa revisi berulang.</p>
"""

art3_faqs = [
    {
        "question": "Apakah saya harus mengulang ujian pelatihan 12 hari jika SKP Ahli K3 saya sudah expired bertahun-tahun?",
        "answer": "Tidak perlu. Sertifikat Pembinaan Calon Ahli K3 Umum Anda berlaku seumur hidup dan tidak akan pernah kadaluwarsa. Anda hanya perlu mengajukan proses perpanjangan administratif SKP dan Lisensi tanpa perlu mengikuti kelas pelatihan ataupun ujian tertulis dari awal lagi."
    },
    {
        "question": "Berapa lama sebelum tanggal expired perpanjangan SKP sebaiknya diajukan?",
        "answer": "Sangat dianjurkan untuk mengajukan berkas permohonan perpanjangan minimal 2 hingga 3 bulan sebelum masa berlaku SKP dan Lisensi berakhir. Hal ini guna mengantisipasi durasi verifikasi dokumen di Kemnaker RI sehingga dokumen baru sudah terbit sebelum dokumen lama habis masa berlakunya."
    },
    {
        "question": "Apakah pemegang sertifikat fresh graduate (mandiri) memiliki SKP?",
        "answer": "Belum. Peserta jalur mandiri (fresh graduate) baru memperoleh Sertifikat Pembinaan Calon Ahli K3 Umum resmi seumur hidup. SKP dan Lisensi baru akan diterbitkan saat Anda telah diterima bekerja di suatu perusahaan dan perusahaan tersebut mengajukan surat penunjukan resmi ke Kemnaker RI."
    },
    {
        "question": "Bagaimana jika perusahaan lama menolak memberikan surat pelepasan SKP?",
        "answer": "Jika perusahaan lama tidak kooperatif atau telah tutup operasi, Anda dapat melampirkan Surat Pengalaman Kerja (Paklaring) resmi, surat pengunduran diri yang telah ditandatangani, dan surat pernyataan bermaterai bahwa Anda telah resmi tidak lagi memiliki ikatan dinas dengan perusahaan tersebut untuk diajukan ke Kemnaker RI."
    },
    {
        "question": "Bisakah perpanjangan SKP Ahli K3 Umum diurus melalui Wahana Totalita Konsultan?",
        "answer": "Sangat bisa. Wahana Totalita Konsultan melayani jasa pengurusan perpanjangan SKP, perpanjangan Lisensi, dan mutasi alih perusahaan Ahli K3 Umum secara cepat, resmi, dan transparan terintegrasi langsung dengan Ditjen Binwasnaker & K3 Kemnaker RI."
    }
]

# ==============================================================================
# ARTICLE 4: PERBEDAAN AHLI K3 UMUM VS AHLI K3 SPESIALIS
# ==============================================================================
art4_content = """

<h2>Matriks Analisis Kebutuhan Pelatihan K3 (Training Needs Analysis - TNA HSE)</h2>
<p>Bagi Departemen People &amp; Culture atau HRD yang sedang menyusun rencana anggaran pelatihan (Annual Training Budget), menentukan kapan harus mengirim staf ke kelas Ahli K3 Umum vs Ahli K3 Spesialis dapat dipandu menggunakan matriks kebutuhan berikut:</p>

<table>
  <thead>
    <tr>
      <th>Kondisi Organisasi &amp; Operasional</th>
      <th>Kebutuhan Sertifikasi Prioritas 1</th>
      <th>Kebutuhan Sertifikasi Prioritas 2</th>
      <th>Target Outcome Bisnis</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Perusahaan baru beroperasi atau memiliki &gt;100 karyawan tanpa personil K3 resmi</td>
      <td><strong>Ahli K3 Umum Kemnaker RI</strong></td>
      <td>Auditor Internal SMK3 PP 50/2012</td>
      <td>Pembentukan P2K3 resmi, izin kepatuhan Disnaker, fondasi SMK3.</td>
    </tr>
    <tr>
      <td>Pabrik manufaktur dengan konsumsi listrik besar, gardu trafo, genset industri</td>
      <td>Ahli K3 Umum (Manajerial)</td>
      <td><strong>Ahli K3 Listrik Kemnaker</strong></td>
      <td>Kepatuhan Permenaker 12/2015, izin riksa uji genset &amp; petir.</td>
    </tr>
    <tr>
      <td>Kontraktor konstruksi mengikuti lelang proyek PUPR, jembatan, gedung tinggi</td>
      <td>Petugas Keselamatan Konstruksi</td>
      <td><strong>Ahli Muda K3 Konstruksi (SKK LPJK)</strong></td>
      <td>Lolos evaluasi teknis tender LPSE, penyusunan dokumen RKK tender.</td>
    </tr>
    <tr>
      <td>Gudang logistik besar mengoperasikan belasan unit Forklift &amp; Reach Truck</td>
      <td>Ahli K3 Umum</td>
      <td><strong>Operator Forklift Lisensi Kemnaker</strong></td>
      <td>Kepatuhan Permenaker 08/2020, mencegah kecelakaan forklift terbalik.</td>
    </tr>
    <tr>
      <td>Industri kimia, cat, pestisida, atau pabrik tekstil pemakai bahan pelarut beracun</td>
      <td>Ahli K3 Umum</td>
      <td><strong>Ahli K3 Kimia &amp; Petugas K3 Kimia</strong></td>
      <td>Kepatuhan Kepmenaker 187/1999, penyusunan SDS &amp; mitigasi ledakan gas.</td>
    </tr>
  </tbody>
</table>

<h2>Studi Kasus: Kolaborasi Sinergis Ahli K3 Umum dan Spesialis di Pabrik Perakitan</h2>
<p>Untuk melihat bagaimana kedua peran ini bekerja berdampingan di dunia nyata, perhatikan skenario di sebuah pabrik perakitan komponen elektronika otomotif:</p>
<p><strong>Ahli K3 Umum</strong> bertindak sebagai konseptor makro: menyusun Manual SMK3 perusahaan, memimpin rapat bulanan P2K3 bersama General Manager, mengaudit kelengkapan dokumen Job Safety Analysis (JSA), menghitung angka statistik kecelakaan kerja, dan melaporkan kinerja keselamatan ke Dinas Tenaga Kerja setiap kuartal.</p>
<p>Di saat yang sama, <strong>Ahli K3 Listrik</strong> fokus menguji instalasi panel pembagi daya (LVMDP), memastikan sistem pembumian (grounding) berada di bawah 5 Ohm sesuai PUIL 2011, serta mengawasi teknisi saat melakukan pekerjaan bertegangan (Lockout/Tagout - LOTO). Sementara itu, <strong>Ahli K3 Penanggulangan Kebakaran</strong> menguji tekanan air pada instalasi pipa hydrant, memelihara alarm smoke detector, dan memimpin simulasi fire drill tahunan seluruh penghuni gedung.</p>
<p>Kombinasi sinergis inilah yang menciptakan ekosistem keselamatan kerja yang paripurna, nir-kecelakaan (Zero Accident), dan siap menghadapi audit sertifikasi berstandar dunia seperti ISO 45001 maupun SMK3 PP 50/2012 tingkat 166 kriteria. Dengan pembagian peran yang terdefinisi jelas, perusahaan tidak hanya patuh secara hukum ketenagakerjaan, tetapi juga meningkatkan efisiensi operasional dan reputasi bisnis di mata klien internasional.</p>

<h2>Ahli K3 Umum vs Ahli K3 Spesialis: Memahami Peta Karir Keselamatan Kerja</h2>
<p>Dalam dunia Keselamatan dan Kesehatan Kerja (K3) di Indonesia, seringkali timbul kebingungan di kalangan profesional maupun manajemen perusahaan mengenai perbedaan peran antara <strong>Ahli K3 Umum (AK3U)</strong> dan <strong>Ahli K3 Spesialis</strong>. Banyak yang mengira bahwa memiliki sertifikat Ahli K3 Umum sudah cukup untuk menangani semua risiko teknis di pabrik, instalasi listrik tegangan tinggi, proyek konstruksi bendungan, hingga operasional bejana uap bertekanan ribuan bar. Begitu pula sebaliknya, banyak pencari kerja pemula yang bingung harus mengambil sertifikasi yang mana terlebih dahulu.</p>

<p>Sebagai analogi sederhana di dunia medis: <strong>Ahli K3 Umum adalah "Dokter Umum"</strong> yang menguasai seluruh aspek kesehatan preventif, sistem manajemen keselamatan, kepatuhan perundangan, dan audit menyeluruh di tempat kerja. Sedangkan <strong>Ahli K3 Spesialis adalah "Dokter Spesialis Bedah atau Jantung"</strong> yang memiliki kompetensi teknis tingkat tinggi yang mendalam pada instrumen atau potensi bahaya spesifik tertentu sesuai mandat peraturan perundangan terkait.</p>

<h2>Tabel Komparasi Menyeluruh: Ahli K3 Umum vs Spesialis Resmi Kemnaker RI</h2>
<p>Berikut adalah tabel perbandingan komparatif yang membedah kualifikasi, regulasi, durasi belajar, dan kewenangan hukum kedua kelompok personil K3 ini:</p>

<table>
  <thead>
    <tr>
      <th>Dimensi Komparasi</th>
      <th>Ahli K3 Umum (Generalist)</th>
      <th>Ahli K3 Spesialis (Subject Matter Expert)</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>Dasar Hukum Regulasi</strong></td>
      <td>Permenaker No. Per.02/MEN/1992</td>
      <td>Permenaker teknis spesifik (Permenaker 01/80, 12/15, 186/99, dll)</td>
    </tr>
    <tr>
      <td><strong>Kualifikasi Pendidikan Masuk</strong></td>
      <td>Minimal D3 / S1 dari <strong>SEMUA JURUSAN</strong></td>
      <td>Mayoritas mensyaratkan <strong>D3/S1 Rumpun TEKNIK</strong> sesuai bidangnya</td>
    </tr>
    <tr>
      <td><strong>Syarat Pengalaman Kerja</strong></td>
      <td>Bebas untuk sertifikat (Fresh graduate diakomodasi)</td>
      <td>Wajib memiliki pengalaman kerja riil di bidang spesifik (min. 2 tahun)</td>
    </tr>
    <tr>
      <td><strong>Fokus Ruang Lingkup Kerja</strong></td>
      <td>Sistem Manajemen K3 (SMK3 PP 50/2012), kelembagaan P2K3, regulasi makro</td>
      <td>Pengawasan teknis instrumen bahaya tinggi, kalkulasi batas beban &amp; riksa uji</td>
    </tr>
    <tr>
      <td><strong>Durasi Waktu Pembinaan</strong></td>
      <td>12 Hari Kerja Efektif (~120 Jam Pelajaran)</td>
      <td>Bervariasi: 6 hingga 20 Hari Kerja tergantung spesialisasi</td>
    </tr>
    <tr>
      <td><strong>Kewenangan Legalitas</strong></td>
      <td>Menjadi Sekretaris Panitia Pembina K3 (P2K3) perusahaan</td>
      <td>Mengesahkan kelayakan teknis peralatan, inspeksi proteksi, dan izin operasi</td>
    </tr>
    <tr>
      <td><strong>Kebutuhan di Industri</strong></td>
      <td>Wajib di setiap perusahaan dengan &gt;100 pekerja atau risiko tinggi</td>
      <td>Wajib di industri spesifik yang mengoperasikan mesin/alat dengan bahaya ekstrem</td>
    </tr>
  </tbody>
</table>

<h2>Mengenal 8 Rumpun Ahli K3 Spesialis Resmi Kemnaker RI</h2>
<p>Kementerian Ketenagakerjaan RI menetapkan sejumlah kualifikasi Ahli K3 Spesialis yang memiliki lisensi penunjukan mandiri di luar Ahli K3 Umum. Berikut adalah 8 rumpun spesialisasi utama yang paling banyak dicari industri:</p>

<h3>1. Ahli K3 Konstruksi (Permenaker No. 01/MEN/1980 &amp; Permen PUPR 10/2021)</h3>
<p>Bertanggung jawab atas manajemen keselamatan di proyek rekayasa konstruksi sipil, gedung bertingkat tinggi, jembatan, bendungan, dan infrastruktur jalan. Menguasai Rencana Keselamatan Konstruksi (RKK), inspeksi perancah (scaffolding), penggalian dalam (excavation), dan pekerjaan struktur berat.</p>

<h3>2. Ahli K3 Listrik (Permenaker No. 12 Tahun 2015 &amp; Kepdirjen 48/2015)</h3>
<p>Dibutuhkan pada industri pembangkit listrik, transmisi, gardu induk, dan pabrik dengan kapasitas instalasi listrik di atas 200 kVA. Memiliki kewenangan merencanakan, memasang, memeriksa, dan menguji instalasi listrik, sistem proteksi petir, serta grounding sistem.</p>

<h3>3. Ahli K3 Penanggulangan Kebakaran (Kepmenaker No. Kep.186/MEN/1999)</h3>
<p>Merupakan personil tingkat tertinggi (Tingkat Ahli / Kelas A) dalam hirarki tim tanggap darurat kebakaran gedung. Berwenang mengaudit sistem proteksi aktif (sprinkler, hydrant, alarm, smoke damper) dan proteksi pasif (fire compartment, emergency exit) serta menyusun skenario Hospital/Industrial Disaster Management.</p>

<h3>4. Ahli K3 Kimia (Kepmenaker No. Kep.187/MEN/1999)</h3>
<p>Wajib dimiliki oleh perusahaan yang memproduksi, menyimpan, atau menggunakan Bahan Berbahaya dan Beracun (B3) melebihi Nilai Ambang Kuantitas (NAK). Menguasai penyusunan Lembar Data Keselamatan Bahan (LDKB / SDS), pencegahan kecelakaan industri kimia besar (Major Accident Hazard), dan mitigasi ledakan gas beracun.</p>

<h3>5. Ahli K3 Pesawat Uap &amp; Bejana Tekan (PUBT - Permenaker No. 01/1988 &amp; Permenaker 37/2016)</h3>
<p>Mengawasi operasional boiler bertekanan tinggi di pabrik kelapa sawit, PLTU, tekstil, dan industri petrokimia. Memiliki wewenang menguji ketebalan dinding bejana (ultrasonic test), mengkalibrasi safety valve, dan mengevaluasi hydrotest.</p>

<h3>6. Ahli K3 Pesawat Angkat &amp; Pesawat Angkut (PAPA - Permenaker No. 08 Tahun 2020)</h3>
<p>Mengawasi kelaikan operasional alat angkat berat seperti Tower Crane, Mobile Crane, Overhead Crane, Forklift, Passenger Hoist, dan Excavator. Menghitung Rigger Load Chart, inspeksi wire rope, dan load test beban angkat.</p>

<h3>7. Ahli K3 Lingkungan Kerja &amp; Higiene Industri (Permenaker No. 05 Tahun 2018)</h3>
<p>Fokus pada pengukuran dan pengendalian faktor bahaya lingkungan kerja di pabrik: pengukuran kebisingan (decibel), pencahayaan (lux), iklim kerja (ISBB), getaran mekanis, debu respirabel, dan faktor kimia/biologis udara kerja.</p>

<h3>8. Ahli K3 Bekerja di Ketinggian &amp; Ruang Terbatas (Permenaker 09/2016 &amp; Kepdirjen 113/2006)</h3>
<p>Mengawasi pekerjaan di area berisiko jatuh tinggi (Work at Height) menggunakan sistem Rope Access / Fall Arrest, serta pekerjaan di dalam tangki, silo, manhole, dan gorong-gorong (Confined Space) dengan pengujian gas atmosfer berbahaya (oxygen deficiency / toxic gas monitoring).</p>

<h2>Analisis Matriks Kebutuhan: Kapan Perusahaan Wajib Mengangkat Ahli Spesialis?</h2>
<p>Banyak HRD keliru menganggap bahwa satu orang Ahli K3 Umum sudah cukup untuk seluruh area pabrik. Namun berdasarkan peraturan pengawasan ketenagakerjaan spesifik, berikut adalah ambang batas wajib kepemilikan personil spesialis:</p>
<ol>
  <li><strong>Instalasi Listrik:</strong> Permenaker 12/2015 mewajibkan perusahaan yang memiliki pembangkitan listrik lebih dari 200 kVA memiliki minimal 1 orang Ahli K3 Listrik dan Teknisi K3 Listrik berlisensi.</li>
  <li><strong>Penggunaan Bahan Kimia Berbahaya:</strong> Kepmenaker 186/1999 dan 187/1999 mewajibkan perusahaan dengan potensi bahaya kimia besar mempekerjakan minimal 2 orang Ahli K3 Kimia dan 5 orang Petugas K3 Kimia yang bertugas secara bergantian (shift).</li>
  <li><strong>Pengoperasian Bejana Uap Boiler:</strong> Pabrik yang mengoperasikan boiler dengan kapasitas uap &gt; 10 ton/jam wajib memiliki Ahli K3 Spesialis PUBT dan Operator Boiler Kelas 1 berlisensi Kemnaker.</li>
  <li><strong>Proyek Konstruksi Bernilai Tinggi:</strong> Proyek konstruksi dengan nilai kontrak di atas Rp 100 miliar wajib menempatkan Ahli Utama K3 Konstruksi dan tim Ahli Madya K3 Konstruksi secara penuh waktu (full-time).</li>
</ol>

<h2>Roadmap Karir K3: Mana yang Sebaiknya Diambil Terlebih Dahulu?</h2>
<p>Bagi praktisi pemula, <strong>Jalur Terbaik adalah MENGAMBIL AHLI K3 UMUM TERLEBIH DAHULU</strong>. Mengapa demikian?</p>
<ol>
  <li><strong>Fondasi Sistemik:</strong> Pembinaan AK3U memberikan pemahaman komprehensif mengenai kerangka hukum perundangan, manajemen risiko (HIRADC), audit SMK3, dan tata kelola P2K3 yang menjadi payung bagi seluruh standar teknis.</li>
  <li><strong>Pintu Masuk Terluas di Pasar Kerja:</strong> Lebih dari 85% lowongan kerja HSE pemula hingga intermediate (HSE Officer, Safety Coordinator) mempersyaratkan sertifikat Ahli K3 Umum Kemnaker RI sebagai kualifikasi minimum mutlak.</li>
  <li><strong>Batu Loncatan Menuju Spesialisasi:</strong> Setelah bekerja 1–2 tahun dan mengetahui potensi bahaya dominan di perusahaan Anda (misalnya jika Anda bekerja di pabrik kimia, Anda akan diarahkan mengambil Ahli K3 Kimia; jika di kontraktor EPC, Anda diarahkan mengambil Ahli K3 Konstruksi), barulah Anda mengambil sertifikasi spesialis yang relevan.</li>
</ol>

<h2>Rekomendasi Pemilihan Sertifikasi Berdasarkan Sektor Industri</h2>
<p>Agar investasi pelatihan Anda tepat sasaran, berikut panduan pemilihan sertifikasi berdasarkan sektor tempat Anda berkarir:</p>
<ul>
  <li><strong>Sektor Migas &amp; Pertambangan:</strong> Ahli K3 Umum + POP Pertambangan / Ahli K3 Kimia + Sertifikasi Ruang Terbatas (Confined Space).</li>
  <li><strong>Sektor EPC &amp; Konstruksi Sipil:</strong> Ahli K3 Umum + Ahli K3 Konstruksi (Jenjang Muda/Madya) + Scaffolding / Bekerja di Ketinggian (TKBT).</li>
  <li><strong>Sektor Manufaktur &amp; Pabrik Otomotif:</strong> Ahli K3 Umum + Ahli K3 Listrik + Ahli K3 Pesawat Angkat Angkut (Forklift &amp; Crane) + Auditor Internal SMK3.</li>
  <li><strong>Sektor Rumah Sakit &amp; Fasyankes:</strong> Ahli K3 Umum + Petugas K3RS BNSP + Ahli K3 Kebakaran (Kelas A/B) + Pengelolaan Limbah Medis B3 (PPLB3).</li>
</ul>
"""

art4_faqs = [
    {
        "question": "Apakah seorang sarjana boleh langsung mengambil sertifikasi Ahli K3 Spesialis tanpa memiliki sertifikat Ahli K3 Umum?",
        "answer": "Bisa, asalkan peserta memenuhi syarat kualifikasi spesifik (seperti latar belakang ijazah teknik relevan dan pengalaman kerja di bidang spesifik tersebut). Namun, secara praktis sangat dianjurkan memiliki sertifikat Ahli K3 Umum terlebih dahulu karena AK3U memberikan landasan regulasi dan sistem manajemen keselamatan nasional yang mendasari seluruh aturan spesialis."
    },
    {
        "question": "Apakah Ahli K3 Umum boleh mengesahkan izin kelaikan teknis lift, boiler, atau instalasi listrik di pabrik?",
        "answer": "Tidak boleh. Ahli K3 Umum hanya berwenang dari sisi manajemen risiko, pengawasan kepatuhan SOP, dan kelembagaan P2K3. Untuk pengesahan riksa uji kelaikan teknis peralatan bertekanan tinggi atau instalasi listrik, kewenangannya berada di tangan Pengawas Spesialis K3 Ketenagakerjaan dan Perusahaan PJK3 Bidang Riksa Uji yang didukung Ahli K3 Spesialis terkait."
    },
    {
        "question": "Mana yang gajinya lebih tinggi: Ahli K3 Umum atau Ahli K3 Spesialis?",
        "answer": "Pada tingkat awal (junior), standar gaji relatif seimbang berkisar Rp 6 juta - Rp 9 juta. Namun pada tingkat menengah ke atas (senior), Ahli K3 Spesialis (terutama Spesialis Kimia, Migas, Listrik Tegangan Tinggi, dan Konstruksi Bawah Tanah) cenderung memiliki nilai remunerasi lebih tinggi (Rp 15 juta - Rp 30+ juta/bulan) karena kelangkaan keahlian teknis yang sangat terbatas di pasaran."
    },
    {
        "question": "Apakah Wahana Totalita Konsultan menyelenggarakan pelatihan Ahli K3 Spesialis?",
        "answer": "Ya. Selain pelatihan unggulan Ahli K3 Umum, Wahana Totalita Konsultan menyelenggarakan pembinaan resmi Kemnaker RI untuk Ahli K3 Listrik, Ahli K3 Konstruksi, Ahli K3 Penanggulangan Kebakaran, Teknisi K3 Ketinggian (TKBT/TKPK), Teknisi Ruang Terbatas (Confined Space), hingga Operator Pesawat Angkat Angkut."
    },
    {
        "question": "Berapa lama masa berlaku lisensi untuk Ahli K3 Spesialis?",
        "answer": "Sama seperti Ahli K3 Umum, Surat Keputusan Penunjukan (SKP) dan Kartu Lisensi Ahli K3 Spesialis memiliki masa berlaku resmi selama 3 (tiga) tahun sejak tanggal diterbitkan, dan wajib diperpanjang secara berkala oleh perusahaan yang bersangkutan."
    }
]

# ==============================================================================
# ARTICLE 5: SYARAT BIAYA AHLI MUDA K3 KONSTRUKSI TENDER LPSE
# ==============================================================================
art5_content = """

<h2>Panduan Format Tabel IBPRP (Identifikasi Bahaya, Penilaian Risiko, dan Peluang)</h2>
<p>Sebagai Ahli Muda Keselamatan Konstruksi, keahlian utama yang diuji dalam dokumen lelang tender LPSE maupun asesmen BNSP adalah penyusunan tabel IBPRP sesuai format Lampiran Permen PUPR No. 10 Tahun 2021. Format standar ini memuat kolom-kolom analitis berikut:</p>

<table>
  <thead>
    <tr>
      <th>No</th>
      <th>Uraian Pekerjaan Proyek</th>
      <th>Identifikasi Bahaya (Skenario Bahaya)</th>
      <th>Tingkat Keparahan (Severity 1-5)</th>
      <th>Tingkat Kekerapan (Likelihood 1-5)</th>
      <th>Tingkat Risiko (TR = S x L)</th>
      <th>Rencana Tindakan Pengendalian Awal</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>1</td>
      <td>Pekerjaan Galian Tanah Pondasi (Kedalaman &gt; 2 meter)</td>
      <td>Dinding galian longsor menimbun pekerja galian bawah tanah</td>
      <td>4 (Kematian / Cedera Berat)</td>
      <td>3 (Sedang Terjadi)</td>
      <td><strong>12 (Tinggi / High Risk)</strong></td>
      <td>Pemasangan sheet pile / shoring penahan tanah, pembuatan tangga akses evakuasi darurat, larangan alat berat mendekat bibir galian minimal 1,5 meter.</td>
    </tr>
    <tr>
      <td>2</td>
      <td>Pemasangan Bekisting Plat Lantai Ketinggian 15 Meter</td>
      <td>Pekerja jatuh dari tepi lantai kerja terbuka / perancah patah</td>
      <td>5 (Bencana Kematian Massal)</td>
      <td>3 (Sedang Terjadi)</td>
      <td><strong>15 (Ekstrem / Extreme Risk)</strong></td>
      <td>Pemasangan safety net di bawah lantai kerja, pemasangan guardrail standar, kewajiban full body harness double lanyard dikaitkan pada lifeline mandiri.</td>
    </tr>
    <tr>
      <td>3</td>
      <td>Pengecoran Struktur Beton dengan Concrete Pump Truck</td>
      <td>Pipa boom pompa beton pecah atau outrigger amblas terguling</td>
      <td>4 (Cedera Parah / Rusak Aset)</td>
      <td>2 (Kecil Kemungkinan)</td>
      <td><strong>8 (Sedang / Medium Risk)</strong></td>
      <td>Uji ketebalan pipa boom, pemadatan tanah dudukan outrigger dengan plat baja bantalan tebal, inspeksi surat izin alat (SIA) dan SIO operator.</td>
    </tr>
  </tbody>
</table>

<h2>Studi Kasus: Mengapa Kontraktor Digugurkan Pokja LPSE Akibat Salah Sertifikat K3</h2>
<p>Sebuah kontraktor menengah di Jawa Tengah mengikuti tender pembangunan gedung rumah sakit daerah senilai Rp 45 Miliar di sistem LPSE. Dalam dokumen penawaran teknis, pada bagian personil K3 Konstruksi, kontraktor mengunggah sertifikat Ahli K3 Umum Kemnaker RI milik project manager mereka.</p>
<p>Saat evaluasi teknis diumumkan, kontraktor dinyatakan <strong>GUGUR / TIDAK MEMENUHI SYARAT (TMS)</strong>. Panitia Pokja Pemilihan memberikan catatan resmi bahwa berdasarkan Lembar Data Pemilihan (LDP), disyaratkan 1 orang Ahli Muda K3 Konstruksi yang memiliki Sertifikat Standar Kompetensi Kerja (SKK) Jenjang 7 yang teregistrasi di LPJK/SIKI PUPR. Penyedia hanya melampirkan sertifikat Ahli K3 Umum yang bukan merupakan kompetensi keselamatan konstruksi sesuai Permen PUPR 10/2021.</p>
<p>Kerugian yang dialami kontraktor sangat nyata: kehilangan peluang kontrak proyek puluhan miliar hanya karena kelalaian memperbarui sertifikat personil. Inilah alasan mengapa Wahana Totalita Konsultan secara intensif mengedukasi seluruh rekanan kontraktor untuk memastikan personil teknisnya memegang SKK Konstruksi Jenjang 7 resmi sebelum dokumen penawaran diunggah ke SPSE.</p>

<h2>Syarat &amp; Biaya Sertifikasi Ahli Muda K3 Konstruksi untuk Syarat Wajib Tender LPSE</h2>
<p>Dalam setiap proses pengadaan barang dan jasa pemerintah yang diselenggarakan melalui portal Layanan Pengadaan Secara Elektronik (LPSE), khususnya paket pekerjaan konstruksi sipil dan arsitektur, <strong>ketersediaan personil bersertifikat Ahli K3 Konstruksi merupakan syarat mutlak dalam Dokumen Pemilihan (Dokmil)</strong>. Ketiadaan personil dengan sertifikat kompetensi yang valid dipastikan membuat penawaran kontraktor <strong>Gugur Otomatis pada Tahap Evaluasi Teknis</strong>, tanpa peduli seberapa murah penawaran harga yang Anda ajukan.</p>

<p>Bagi kontraktor pelaksana, konsultan pengawas, maupun <em>fresh graduate</em> teknik sipil dan arsitektur, memahami <strong>persyaratan pendaftaran, rincian biaya investasi 2026, dan perbedaan antara sertifikasi Kemnaker RI vs SKK Konstruksi BNSP/LPJK</strong> adalah hal fundamental untuk memenangkan proyek bernilai miliaran rupiah.</p>

<h2>Landasan Hukum Wajib Ahli K3 Konstruksi: UU No. 2 Tahun 2017 &amp; Permen PUPR 10/2021</h2>
<p>Kewajiban penempatan personil K3 Konstruksi di lapangan proyek didasarkan pada kerangka hukum yang sangat ketat:</p>
<ul>
  <li><strong>Undang-Undang No. 2 Tahun 2017 tentang Jasa Konstruksi:</strong> Pasal 70 ayat (1) menegaskan bahwa setiap tenaga kerja konstruksi yang bekerja di bidang jasa konstruksi wajib memiliki Sertifikat Standar Kompetensi Kerja (SKK). Pengguna jasa dan/atau penyedia jasa dilarang mempekerjakan tenaga kerja konstruksi yang tidak bersertifikat.</li>
  <li><strong>Peraturan Menteri Pekerjaan Umum dan Perumahan Rakyat No. 10 Tahun 2021 tentang Pedoman Sistem Manajemen Keselamatan Konstruksi (SMKK):</strong> Mewajibkan kontraktor menyusun Rencana Keselamatan Konstruksi (RKK) dan menyediakan Unit Keselamatan Konstruksi (UKK) yang dipimpin oleh Ahli K3 Konstruksi atau Ahli Keselamatan Konstruksi berlisensi resmi.</li>
  <li><strong>Surat Edaran Menteri PUPR terkait Kriteria Risiko Proyek:</strong>
    <ul>
      <li><em>Proyek Risiko Keselamatan Konstruksi Kecil:</em> Minimal dipimpin oleh Petugas Keselamatan Konstruksi atau Ahli Muda K3 Konstruksi.</li>
      <li><em>Proyek Risiko Keselamatan Konstruksi Sedang:</em> Wajib dipimpin oleh Ahli Madya K3 Konstruksi.</li>
      <li><em>Proyek Risiko Keselamatan Konstruksi Besar (Nilai proyek &gt; Rp 100 Miliar atau berisiko tinggi):</em> Wajib dipimpin oleh Ahli Utama K3 Konstruksi berpengalaman.</li>
    </ul>
  </li>
</ul>

<h2>Dualisme Sertifikasi: Kemnaker RI vs BNSP/LPJK (Jangan Sampai Salah Beli!)</h2>
<p>Salah satu penyebab paling tragis kegagalan kontraktor dalam tender LPSE adalah salah melampirkan sertifikat personil. Banyak penyedia jasa mengunggah sertifikat Ahli K3 Konstruksi keluaran Kemnaker RI untuk tender proyek di bawah Kementerian PUPR, yang berujung diskualifikasi teknis. Berikut perbedaan yang wajib Anda cermati:</p>

<table>
  <thead>
    <tr>
      <th>Karakteristik Pembanding</th>
      <th>Sertifikasi Ahli K3 Konstruksi Kemnaker RI</th>
      <th>Sertifikasi SKK Konstruksi LPJK / BNSP</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>Dasar Payung Regulasi</strong></td>
      <td>Permenaker No. Per.01/MEN/1980 tentang K3 Konstruksi Bangunan</td>
      <td>UU No. 2/2017 &amp; Permen PUPR No. 10/2021 (Sistem Manajemen Keselamatan Konstruksi)</td>
    </tr>
    <tr>
      <td><strong>Lembaga Penerbit</strong></td>
      <td>Kementerian Ketenagakerjaan RI (Ditjen Binwasnaker &amp; K3)</td>
      <td>Badan Nasional Sertifikasi Profesi (BNSP) melalui Lembaga Sertifikasi Profesi (LSP) terlisensi LPJK</td>
    </tr>
    <tr>
      <td><strong>Sebutan / Jenjang Kualifikasi</strong></td>
      <td>Ahli K3 Konstruksi (Muda, Madya, Utama)</td>
      <td>Ahli Muda Keselamatan Konstruksi (Jenjang 7), Madya (Jenjang 8), Utama (Jenjang 9)</td>
    </tr>
    <tr>
      <td><strong>Basis Verifikasi Tender LPSE</strong></td>
      <td>Diakui untuk pengawasan tenaga kerja, audit SMK3 Kemnaker, dan tender industri non-PUPR</td>
      <td><strong>WAJIB MUTLAK untuk tender LPSE PUPR</strong> dan terintegrasi langsung dengan database SIKI PUPR melalui QR Code</td>
    </tr>
    <tr>
      <td><strong>Masa Berlaku Sertifikat</strong></td>
      <td>Sertifikat seumur hidup, SKP &amp; Lisensi 3 Tahun</td>
      <td>Sertifikat Kompetensi Kerja berlaku <strong>5 (Lima) Tahun</strong></td>
    </tr>
  </tbody>
</table>

<p><em>Rekomendasi Terbaik:</em> Di Wahana Totalita Konsultan, kami menyediakan kedua jalur sertifikasi tersebut. Jika target utama Anda adalah memenangkan tender infrastruktur di kementerian/dinas PUPR dan LPSE nasional, pastikan Anda mengambil program <strong>SKK Konstruksi BNSP/LPJK Jenjang 7 (Ahli Muda)</strong>.</p>

<h2>Rincian Biaya Pelatihan &amp; Uji Kompetensi Ahli Muda K3 Konstruksi 2026</h2>
<p>Biaya investasi sertifikasi Ahli Muda K3 Konstruksi di tahun 2026 sangat bergantung pada jalur yang Anda pilih:</p>
<ul>
  <li><strong>Kelas Online Blended Learning (Uji Kompetensi Daring via Zoom):</strong> Berkisar antara <strong>Rp 4.500.000 hingga Rp 6.000.000 / peserta</strong>. Sudah mencakup pembekalan materi SMKK, penyusunan portofolio asesmen, biaya uji Tempat Uji Kompetensi (TUK) LSP resmi, verifikasi asesor BNSP, dan penerbitan sertifikat fisik ber-QR code SIKI LPJK.</li>
  <li><strong>Kelas Tatap Muka (Offline Workshop &amp; Asesmen Langsung):</strong> Berkisar antara <strong>Rp 7.000.000 hingga Rp 9.500.000 / peserta</strong>. Sudah termasuk fasilitas akomodasi ruang ujian hotel berbintang, konsumsi makan siang/coffee break, bimbingan tatap muka, dan pendampingan asesmen langsung oleh asesor kompetensi.</li>
</ul>

<h2>Syarat Kualifikasi Pendidikan &amp; Berkas Pendaftaran</h2>
<p>Untuk mengikuti uji sertifikasi Ahli Muda K3 Konstruksi / Ahli Muda Keselamatan Konstruksi (Jenjang 7), calon peserta wajib memenuhi kriteria dasar dan dokumen pendukung berikut:</p>
<ol>
  <li><strong>Latar Belakang Ijazah Minimal:</strong>
    <ul>
      <li>Sarjana Strata 1 (S1) atau D4 rumpun Teknik Sipil, Arsitektur, Lingkungan, Mekanikal, Elektrikal, atau K3 dengan pengalaman kerja proyek konstruksi minimal 0–1 tahun (Fresh Graduate jurusan linear diperbolehkan mengikuti skema pemula).</li>
      <li>Diploma 3 (D3) rumpun Teknik dengan pengalaman kerja di lapangan konstruksi minimal 2 hingga 3 tahun.</li>
    </ul>
  </li>
  <li><strong>Dokumen Administratif:</strong>
    <ul>
      <li>Scan warna Ijazah asli dan Transkrip Nilai resmi perguruan tinggi.</li>
      <li>Scan warna e-KTP dan Nomor Pokok Wajib Pajak (NPWP) aktif.</li>
      <li>Pasfoto formal berlatar belakang merah resolusi tinggi.</li>
      <li>Curriculum Vitae (CV) / Portofolio Pengalaman Kerja Proyek Konstruksi (mencantumkan nama proyek, lokasi, durasi, dan uraian tugas keselamatan kerja yang pernah dikerjakan).</li>
      <li>Surat Rekomendasi / Keterangan Pengalaman Kerja dari kontraktor pelaksana tempat bekerja sebelumnya (jika ada).</li>
    </ul>
  </li>
</ol>

<h2>Silabus Materi Inti yang Diujikan dalam Sertifikasi</h2>
<p>Dalam proses asesmen kompetensi Ahli Muda Keselamatan Konstruksi, peserta diuji atas 8 unit kompetensi inti standar SKKNI, yang meliputi:</p>
<ul>
  <li><strong>Penyusunan Rencana Keselamatan Konstruksi (RKK):</strong> Merancang dokumen RKK tender dan RKK pelaksanaan sesuai format standar Lampiran Permen PUPR 10/2021.</li>
  <li><strong>Identifikasi Bahaya, Penilaian Risiko, dan Penentuan Pengendalian (IBPRP):</strong> Menyusun tabel matriks risiko proyek mulai dari pekerjaan tanah, pondasi tiang pancang, struktur beton bertulang, hingga finishing ketinggian.</li>
  <li><strong>Perhitungan Biaya Penerapan SMKK dalam RAB Proyek:</strong> Menghitung rincian 9 item biaya SMKK (APD, pagar pengaman, jaring pengaman, spanduk K3, asuransi, MCU pekerja, personil K3) yang wajib masuk dalam penawaran tender.</li>
  <li><strong>Prosedur Izin Kerja Selamat (Permit to Work):</strong> Mengaudit izin kerja panas (hot work), izin kerja ruang terbatas (confined space), izin angkat crane (lifting permit), dan izin kerja ketinggian (working at height).</li>
  <li><strong>Inspeksi Perancah (Scaffolding) dan Alat Berat:</strong> Menilai kelaikan pemasangan perancah modular/tubular, penempatan outrigger crane, dan inspeksi grounding instalasi genset proyek.</li>
  <li><strong>Rencana Tanggap Darurat dan Evakuasi Lapangan:</strong> Simulasi penanganan korban jatuh dari ketinggian, runtuhan tanah galian (trench collapse), dan kebakaran bedeng pekerja.</li>
</ul>

<h2>Panduan Lolos Asesmen Asesor BNSP: Tips Portofolio Proyek</h2>
<p>Banyak calon asesor gagal dalam asesmen wawancara bukan karena kurang pintar, melainkan karena portofolio proyek yang diajukan tidak memenuhi kaidah bukti kompetensi (Valid, Asli, Terkini, Memadai / VATM). Berikut tips praktis dari Master Asesor Wahana Totalita:</p>
<ol>
  <li><strong>Siapkan Bukti Riil Dokumen Pelaksanaan Lapangan:</strong> Jangan hanya melampirkan teks teori. Bawalah salinan dokumen Job Safety Analysis (JSA) yang telah ditandatangani mandor dan site engineer, daftar hadir Toolbox Meeting mingguan, foto-foto inspeksi APD, serta surat izin kerja selamat (PTW) yang pernah Anda terbitkan.</li>
  <li><strong>Kuasai Format Rencana Keselamatan Konstruksi (RKK):</strong> Pahami perbedaan antara RKK Penawaran (pada saat tender lelang) dan RKK Pelaksanaan (saat proyek mulai berjalan). Jelaskan dengan fasih matriks IBPRP yang Anda buat.</li>
  <li><strong>Jelaskan Alur Penanganan Insiden Konstruksi:</strong> Jika ditanya skenario kecelakaan, jelaskan secara runtut mulai dari pertolongan pertama (P3K), pengamanan tempat kejadian (garis pembatas), investigasi akar penyebab (Root Cause Analysis), hingga pelaporan resmi ke Dinas PUPR dan Kemenaker dalam waktu 2x24 jam.</li>
</ol>

<h2>Keuntungan Ganda Bagi Kontraktor dan Pemegang Sertifikat</h2>
<p>Kepemilikan sertifikat Ahli Muda K3 Konstruksi memberikan dampak langsung:</p>
<ul>
  <li><strong>Bagi Perusahaan Kontraktor:</strong> Menjamin kelulusan syarat personil manajerial inti pada dokumen lelang LPSE, memenuhi syarat Surat Izin Usaha Jasa Konstruksi (IUJK / NIB Berbasis Risiko), dan menaikkan skor teknis prakualifikasi rekanan BUMN Karya (Waskita, WIKA, PP, Adhi Karya, Hutama Karya).</li>
  <li><strong>Bagi Profesional Individu:</strong> Menjadi komoditas personil yang sangat dicari di industri konstruksi dengan honor sewa SKK personil atau gaji tetap lapangan berkisar antara Rp 7.000.000 hingga Rp 14.000.000 per bulan tergantung skala proyek yang ditangani.</li>
</ul>
"""

art5_faqs = [
    {
        "question": "Apakah lulusan baru (fresh graduate) S1 Teknik Sipil boleh langsung mengambil Ahli Muda K3 Konstruksi?",
        "answer": "Bisa. Untuk jenjang kualifikasi Ahli Muda Keselamatan Konstruksi (Jenjang 7) versi BNSP/LPJK, lulusan S1/D4 jurusan teknik sipil, arsitektur, dan rumpun teknik terkait diberikan dispensasi skema pembinaan fresh graduate dengan melampirkan portofolio magang, tugas akhir (skripsi), atau sertifikat pelatihan keselamatan konstruksi."
    },
    {
        "question": "Apakah sertifikat Ahli Muda K3 Konstruksi langsung terdaftar di sistem SIKI PUPR?",
        "answer": "Ya. Sertifikat Standar Kompetensi Kerja (SKK) yang diterbitkan oleh Lembaga Sertifikasi Profesi (LSP) terlisensi BNSP dan terakreditasi LPJK secara otomatis tercatat di portal SIKI (Sistem Informasi Konstruksi Indonesia) Kementerian PUPR dan dapat langsung dicek keabsahannya via scan barcode oleh panitia Pokja lelang LPSE."
    },
    {
        "question": "Bisakah satu personil Ahli K3 Konstruksi digunakan untuk beberapa paket tender LPSE sekaligus?",
        "answer": "Sesuai regulasi LKPP dan Permen PUPR, personil inti manajerial (termasuk Ahli K3 Konstruksi) tidak boleh tumpang tindih (overlap) jadwal penugasan pada proyek yang sedang berjalan. Satu personil hanya dapat ditugaskan penuh pada satu kontrak kerja pelaksanaan proyek yang aktif."
    },
    {
        "question": "Apa perbedaan mendasar antara Petugas Keselamatan Konstruksi dan Ahli Muda K3 Konstruksi?",
        "answer": "Petugas Keselamatan Konstruksi diperuntukkan bagi proyek konstruksi berskala risiko kecil dengan nilai anggaran tertentu dan biasanya memiliki jenjang kualifikasi teknisi (Jenjang 4 atau 5). Sementara Ahli Muda K3 Konstruksi (Jenjang 7) merupakan level jabatan manajerial ahli yang berwenang memimpin Unit Keselamatan Konstruksi pada proyek risiko sedang dan besar."
    },
    {
        "question": "Berapa lama proses penerbitan SKK Konstruksi dari sejak ujian asesmen?",
        "answer": "Setelah dinyatakan kompeten oleh tim asesor pada saat uji kompetensi (asesmen), proses penerbitan blanko digital ber-QR code resmi dari BNSP dan LPJK memakan waktu berkisar antara 7 hingga 14 hari kerja kerja."
    }
]

articles_data = [
    {
        "slug": "biaya-pelatihan-ahli-k3-umum-kemnaker-2026",
        "title": "Biaya Pelatihan Ahli K3 Umum Kemnaker RI 2026: Rincian Lengkap & Fasilitas All-In",
        "meta_title": "Biaya Pelatihan Ahli K3 Umum Kemnaker RI 2026: Rincian Lengkap & Fasilitas All-In",
        "meta_desc": "Rincian biaya resmi pelatihan Ahli K3 Umum Kemnaker 2026. Bandingkan biaya online Zoom vs tatap muka Yogyakarta, fasilitas all-in, skema cicilan & tips bebas calo.",
        "keywords": "biaya pelatihan ahli k3 umum kemnaker 2026, harga kursus k3 umum, biaya sertifikasi ahli k3 umum resmi, rincian biaya ak3u kemnaker, pjk3 resmi yogyakarta",
        "content": art1_content.strip(),
        "faq_data": art1_faqs
    },
    {
        "slug": "syarat-ahli-k3-umum-kemnaker-non-teknik",
        "title": "Syarat Ahli K3 Umum Kemnaker RI untuk Jurusan Non-Teknik: Panduan Lengkap Karir Safety",
        "meta_title": "Syarat Ahli K3 Umum Kemnaker untuk Jurusan Non-Teknik: Panduan Lengkap Karir Safety",
        "meta_desc": "Panduan resmi syarat Ahli K3 Umum Kemnaker untuk lulusan non-teknik (Hukum, Manajemen, Kesmas, Psikologi). Pelajari dasar hukum Permenaker 02/1992, berkas & tips lulus.",
        "keywords": "syarat ahli k3 umum non teknik, ahli k3 umum jurusan ips, syarat pembinaan k3 umum sarjana hukum, permenaker 02 1992 k3 umum, prospek kerja hse officer non teknik",
        "content": art2_content.strip(),
        "faq_data": art2_faqs
    },
    {
        "slug": "masa-berlaku-sertifikat-ahli-k3-umum-perpanjangan-skp",
        "title": "Masa Berlaku Sertifikat Ahli K3 Umum & Prosedur Perpanjangan SKP Kemnaker RI",
        "meta_title": "Masa Berlaku Sertifikat Ahli K3 Umum & Prosedur Perpanjangan SKP Kemnaker RI",
        "meta_desc": "Pahami masa berlaku sertifikat Ahli K3 Umum (seumur hidup) vs SKP & Lisensi (3 tahun). Panduan resmi syarat perpanjangan, mutasi perusahaan & biaya resmi 2026.",
        "keywords": "masa berlaku sertifikat ahli k3 umum, cara perpanjang skp ahli k3 umum, syarat perpanjangan lisensi k3 kemnaker, mutasi perusahaan ahli k3 umum, biaya perpanjang skp ak3u",
        "content": art3_content.strip(),
        "faq_data": art3_faqs
    },
    {
        "slug": "perbedaan-ahli-k3-umum-vs-ahli-k3-spesialis",
        "title": "Perbedaan Ahli K3 Umum vs Ahli K3 Spesialis: Panduan Roadmap Karir & Regulasi",
        "meta_title": "Perbedaan Ahli K3 Umum vs Ahli K3 Spesialis: Panduan Roadmap Karir & Regulasi",
        "meta_desc": "Bandingkan tugas, kualifikasi, biaya, dan gaji Ahli K3 Umum vs 8 Ahli K3 Spesialis (Konstruksi, Listrik, Kebakaran, Kimia, dll). Tentukan roadmap sertifikasi terbaik.",
        "keywords": "perbedaan ahli k3 umum dan spesialis, jenis ahli k3 spesialis kemnaker, ahli k3 listrik vs umum, ahli k3 konstruksi kemnaker, jenjang karir hse officer",
        "content": art4_content.strip(),
        "faq_data": art4_faqs
    },
    {
        "slug": "syarat-biaya-ahli-muda-k3-konstruksi-tender-lpse",
        "title": "Syarat & Biaya Sertifikasi Ahli Muda K3 Konstruksi untuk Syarat Wajib Tender LPSE",
        "meta_title": "Syarat & Biaya Sertifikasi Ahli Muda K3 Konstruksi untuk Syarat Wajib Tender LPSE",
        "meta_desc": "Panduan lengkap syarat, biaya, dan materi sertifikasi Ahli Muda K3 Konstruksi (SKK Jenjang 7 LPJK/BNSP). Lolos evaluasi teknis tender LPSE & regulasi Permen PUPR 10/2021.",
        "keywords": "syarat ahli muda k3 konstruksi, biaya sertifikasi k3 konstruksi lpse, skk konstruksi jenjang 7 bnsp lpjk, permen pupr 10 2021 smkk, kursus k3 konstruksi tender proyek",
        "content": art5_content.strip(),
        "faq_data": art5_faqs
    }
]

def main():
    print("=== DEEP REWRITE BATCH 1 TO 5 (Target: >= 1,500 words per article) ===")
    for item in articles_data:
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
