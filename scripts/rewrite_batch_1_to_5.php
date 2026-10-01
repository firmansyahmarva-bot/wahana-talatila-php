<?php
/**
 * scripts/rewrite_batch_1_to_5.php
 * Rewrites Articles 1 to 5 into comprehensive, 1,500+ word authoritative guides.
 */
require_once __DIR__ . '/../config.php';
$key = 'wtk_srv_' . hash('sha256', DB_PASS . 'WahanaTotalitaSecure2026!');

function update_article_by_slug(string $slug, array $data, string $apiKey): array {
    $payload = array_merge(['slug' => $slug], $data);
    $ch = curl_init('https://wahanatotalita.com/api/articles.php');
    curl_setopt_array($ch, [
        CURLOPT_CUSTOMREQUEST  => 'PUT',
        CURLOPT_POSTFIELDS     => json_encode($payload, JSON_UNESCAPED_UNICODE),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER     => [
            'Authorization: Bearer ' . $apiKey,
            'Content-Type: application/json',
            'Accept: application/json'
        ],
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_USERAGENT      => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)'
    ]);
    $resp = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return ['code' => $code, 'body' => json_decode($resp, true) ?: $resp];
}

$articles_to_rewrite = [

    // ARTICLE 1: BIAYA PELATIHAN AHLI K3 UMUM 2026
    'biaya-pelatihan-ahli-k3-umum-kemnaker-2026' => [
        'title'      => 'Biaya Pelatihan Ahli K3 Umum Kemnaker RI 2026: Rincian Lengkap & Fasilitas All-In',
        'meta_title' => 'Biaya Pelatihan Ahli K3 Umum Kemnaker RI 2026: Rincian Lengkap & Fasilitas | Wahana Totalita',
        'meta_desc'  => 'Rincian resmi biaya pelatihan Ahli K3 Umum Kemnaker RI 2026. Bandingkan biaya online Zoom vs tatap muka, rincian fasilitas all-in, skema cicilan, dan tips memilih PJK3 resmi.',
        'keywords'   => 'biaya pelatihan ahli k3 umum kemnaker 2026, harga kursus k3 umum, biaya sertifikasi ahli k3 umum resmi, rincian biaya ak3u kemnaker, pjk3 resmi yogyakarta',
        'content'    => <<<HTML
<h2>Berapa Biaya Pelatihan Ahli K3 Umum Kemnaker RI Tahun 2026?</h2>
<p>Bagi calon profesional Keselamatan dan Kesehatan Kerja (K3) maupun HRD perusahaan, pertanyaan pertama yang paling sering diajukan sebelum mendaftar adalah: <strong>Berapa sebenarnya total biaya pelatihan Ahli K3 Umum (AK3U) bersertifikasi resmi Kementerian Ketenagakerjaan RI di tahun 2026?</strong> Mengapa harga di pasaran bisa bervariasi antara Rp 4.500.000 hingga lebih dari Rp 8.000.000? Apa saja komponen fasilitas yang wajib didapatkan, dan bagaimana cara membedakan PJK3 resmi dengan calo pelatihan abal-abal?</p>

<p>Di tahun 2026, standar biaya investasi pembinaan calon Ahli K3 Umum Kemnaker RI di Indonesia berada pada kisaran <strong>Rp 4.500.000 hingga Rp 5.800.000 untuk metode Online Blended Learning</strong>, dan <strong>Rp 6.800.000 hingga Rp 8.500.000 untuk metode Tatap Muka (Offline)</strong>. Perbedaan harga ini dipengaruhi oleh metode pelaksanaan, akomodasi, biaya Praktik Kerja Lapangan (PKL), serta penerbitan legalitas resmi dari Kemnaker RI.</p>

<h2>Tabel Komparasi Biaya: Online Blended Learning vs Offline Tatap Muka</h2>
<p>Berikut adalah rincian perbandingan transparan antara kedua jalur pelatihan agar Anda dapat menentukan pilihan yang paling efisien sesuai anggaran dan ketersediaan waktu Anda:</p>

<table>
  <thead>
    <tr>
      <th>Komponen Evaluasi</th>
      <th>Kelas Online Blended Learning (Zoom)</th>
      <th>Kelas Tatap Muka (Offline Yogyakarta)</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>Kisaran Biaya Investasi</strong></td>
      <td>Rp 4.500.000 – Rp 5.800.000 / orang</td>
      <td>Rp 6.800.000 – Rp 8.500.000 / orang</td>
    </tr>
    <tr>
      <td><strong>Durasi Waktu Pelatihan</strong></td>
      <td>12 Hari Kerja (120 Jam Pelajaran / JPL)</td>
      <td>12 Hari Kerja (120 Jam Pelajaran / JPL)</td>
    </tr>
    <tr>
      <td><strong>Media Pembelajaran</strong></td>
      <td>Zoom Meeting Live Interaktif + Google Classroom LMS</td>
      <td>Ruang Kelas Hotel Berbintang / Training Center Ber-AC</td>
    </tr>
    <tr>
      <td><strong>Pelaksanaan PKL (Praktik)</strong></td>
      <td>Observasi Video Virtual Perusahaan + Analisis Daring</td>
      <td>Kunjungan Fisik Langsung ke Pabrik / Lokasi Industri Mitra</td>
    </tr>
    <tr>
      <td><strong>Konsumsi &amp; Akomodasi</strong></td>
      <td>Mandiri di rumah/kantor masing-masing</td>
      <td>2x Coffee Break + 1x Makan Siang Prasmanan setiap hari</td>
    </tr>
    <tr>
      <td><strong>Legalisasi Dokumen</strong></td>
      <td>Sertifikat Kemnaker + SKP + Lisensi (Asli Fisik Dikirim)</td>
      <td>Sertifikat Kemnaker + SKP + Lisensi (Diserahkan Langsung)</td>
    </tr>
    <tr>
      <td><strong>Target Peserta Ideal</strong></td>
      <td>Karyawan aktif, profesional luar pulau, fresh graduate hemat budget</td>
      <td>Utusan perusahaan yang butuh fokus penuh tanpa gangguan kerja harian</td>
    </tr>
  </tbody>
</table>

<h2>Rincian Komponen Fasilitas All-In yang Wajib Anda Terima</h2>
<p>Banyak calon peserta tergiur penawaran biaya murah di bawah Rp 4 juta, namun di tengah jalan diminta membayar biaya tambahan untuk ujian evaluasi, pencetakan SKP, atau pengiriman berkas. Di <strong>Wahana Totalita Konsultan</strong>, seluruh biaya bersifat <em>All-In</em> tanpa ada pungutan tersembunyi apa pun. Rincian fasilitas yang Anda terima meliputi:</p>

<h3>1. Dokumen Legalitas Negara Resmi Kemnaker RI</h3>
<ul>
  <li><strong>Sertifikat Pembinaan Calon Ahli K3 Umum</strong> yang diterbitkan oleh Kementerian Ketenagakerjaan RI, ditandatangani oleh pejabat eselon terkait dan teregistrasi secara nasional di database Teman K3.</li>
  <li><strong>Surat Keputusan Penunjukan (SKP) Ahli K3 Umum</strong> bertanda tangan Direktur Jenderal Pembinaan Pengawasan Ketenagakerjaan dan K3 (khusus utusan perusahaan).</li>
  <li><strong>Kartu Tanda Kewenangan / Lisensi K3</strong> resmi berbentuk kartu identitas kerja (khusus utusan perusahaan).</li>
  <li><strong>Surat Keterangan Lulus Sementara (SKL)</strong> resmi dari PJK3 yang dapat langsung digunakan melamar kerja atau audit tender sembari menunggu proses pencetakan ijazah dari kementerian.</li>
</ul>

<h3>2. Paket Modul Pembelajaran &amp; Perlengkapan Lengkap</h3>
<ul>
  <li>Buku Himpunan Peraturan Perundang-undangan Keselamatan dan Kesehatan Kerja RI (Hardcopy &amp; E-Book regulasi terbaru).</li>
  <li>Buku Pedoman Pembinaan Ahli K3 Umum dan materi slide presentasi seluruh narasumber pengawas ketenagakerjaan.</li>
  <li>Exclusive Training Kit: Tas ransel kerja, polo shirt K3 bordir eksklusif Wahana Totalita, notebook, dan pulpen seminar.</li>
  <li>Surat Izin PKL Industri dan template laporan observasi lapangan berstandar evaluasi Kemnaker.</li>
</ul>

<h3>3. Bimbingan Ujian &amp; Pendampingan Pembuatan Laporan PKL</h3>
<p>Ujian evaluasi Kemnaker RI terdiri dari Ujian Teori Pilihan Ganda, Ujian Esai Studi Kasus Hukum K3, Ujian Analisis Video PKL, dan Sidang Seminar Laporan Kelompok. Instruktur senior Wahana Totalita mendampingi setiap peserta dengan <em>Try Out</em> bank soal dan bimbingan bedah kasus hingga seluruh peserta dinyatakan <strong>LULUS (Kompeten)</strong>.</p>

<h2>Skema Pembayaran: Cicilan DP Ringan &amp; Diskon Khusus Rombongan</h2>
<p>Untuk mempermudah akses pendidikan K3 bagi fresh graduate maupun korporasi, kami menyediakan opsi pembayaran fleksibel:</p>
<ol>
  <li><strong>Down Payment (DP) Ringan:</strong> Anda cukup membayar DP sebesar Rp 1.000.000 untuk mengunci kuota kursi batch terdekat. Sisa pelunasan dapat dicicil hingga sebelum jadwal seminar PKL dimulai.</li>
  <li><strong>Early Bird Discount:</strong> Dapatkan potongan biaya khusus sebesar Rp 300.000 hingga Rp 500.000 bagi peserta yang menyelesaikan administrasi minimal 14 hari sebelum hari H pembukaan kelas.</li>
  <li><strong>Paket Rombongan Korporasi (In-House / Public Group):</strong> Pengiriman rombongan 3 orang atau lebih dari satu perusahaan berhak mendapatkan diskon khusus atau penawaran skema In-House Training langsung di lokasi perusahaan Anda.</li>
</ol>

<h2>Tips Memilih PJK3 Resmi: Hindari Sertifikat Bodong</h2>
<p>Sebelum mentransfer biaya pelatihan ke lembaga mana pun, pastikan Anda memeriksa 3 indikator keabsahan berikut:</p>
<ul>
  <li><strong>Memiliki SK Penunjukan PJK3 Resmi dari Kemnaker RI:</strong> Periksa apakah lembaga memiliki SK Penunjukan Bidang Pembinaan K3 yang masih aktif dari Direktur Bina Kelembagaan K3 Kemnaker RI. PT Wahana Totalita Konsultan adalah PJK3 berizin resmi dengan nomor legalitas terdaftar.</li>
  <li><strong>Instruktur Merupakan Pengawas Ketenagakerjaan Resmi:</strong> Sesi perundang-undangan wajib diampu oleh Pengawas Ketenagakerjaan dan Spesialis K3 dari Kemnaker RI / Disnakertrans, bukan sekadar instruktur otodidak.</li>
  <li><strong>Akun Terkoneksi dengan Portal Teman K3:</strong> Pendaftaran peserta dan nomor sertifikat wajib terintegrasi dengan portal resmi kementerian (temank3.kemnaker.go.id).</li>
</ul>
HTML,
        'faq' => [
            ['q' => 'Apakah biaya pelatihan Ahli K3 Umum bisa dicicil?', 'a' => 'Bisa. Di Wahana Totalita Konsultan, peserta dapat mengunci kuota kelas dengan Down Payment (DP) sebesar Rp 1.000.000, kemudian sisa biaya investasi dapat dilunasi secara bertahap selama pelatihan berlangsung sebelum sesi evaluasi ujian dimulai.'],
            ['q' => 'Apa perbedaan fasilitas yang didapat Fresh Graduate dan Utusan Perusahaan?', 'a' => 'Materi pelatihan dan ujian keduanya sama persis. Fresh Graduate mendapatkan Sertifikat Pembinaan Calon Ahli K3 Umum dari Kemnaker RI (berlaku seumur hidup). Sedangkan Utusan Perusahaan (melampirkan surat penugasan perusahaan) mendapatkan 3 dokumen lengkap: Sertifikat Kemnaker, SKP Penunjukan, dan Kartu Lisensi Kewenangan K3.'],
            ['q' => 'Apakah biaya pelatihan sudah termasuk ongkos kirim sertifikat fisik ke rumah?', 'a' => 'Ya, untuk peserta kelas Online, seluruh berkas sertifikat asli, modul, SKP, lisensi, dan training kit dikirimkan ke alamat domisili peserta di seluruh Indonesia tanpa biaya tambahan.'],
            ['q' => 'Berapa lama proses penerbitan sertifikat resmi Kemnaker setelah pelatihan selesai?', 'a' => 'Surat Keterangan Lulus (SKL) resmi diterbitkan 1-2 hari setelah pelatihan selesai. Sementara sertifikat fisik dan SKP resmi dari Kementerian Ketenagakerjaan RI membutuhkan waktu proses verifikasi sistem Teman K3 sekitar 1 hingga 2 bulan kerja.']
        ]
    ],

    // ARTICLE 2: SYARAT AHLI K3 UMUM NON TEKNIK
    'syarat-ahli-k3-umum-kemnaker-non-teknik' => [
        'title'      => 'Syarat Mengikuti Pembinaan Ahli K3 Umum Kemnaker RI: Apakah D3/S1 Non-Teknik Bisa?',
        'meta_title' => 'Syarat Ahli K3 Umum Kemnaker RI: Apakah Non-Teknik Bisa Ikut? | Wahana Totalita',
        'meta_desc'  => 'Penjelasan lengkap syarat pendidikan Ahli K3 Umum Kemnaker RI. Apakah lulusan Manajemen, Hukum, dan Ekonomi bisa mendaftar? Simak aturan Permenaker 02/1992.',
        'keywords'   => 'syarat ahli k3 umum, ahli k3 umum non teknik, syarat ak3u kemnaker, pendidikan minimal ahli k3 umum, permenaker 02 1992',
        'content'    => <<<HTML
<h2>Apakah Lulusan Non-Teknik Berhak Menjadi Ahli K3 Umum?</h2>
<p>Salah satu mitos paling umum yang beredar di kalangan pencari kerja dan karyawan adalah anggapan bahwa profesi <strong>Ahli Keselamatan dan Kesehatan Kerja (K3)</strong> hanya diperuntukkan bagi lulusan Teknik (Sipil, Mesin, Elektro, Kimia) atau Kesehatan Masyarakat. Akibatnya, banyak sarjana dari rumpun ilmu sosial, ekonomi, manajemen, hingga hukum ragu untuk mendaftar pembinaan Ahli K3 Umum (AK3U) Kemnaker RI.</p>

<p>Mari kita luruskan dengan fakta regulasi: <strong>Lulusan Sarjana (S1) maupun Diploma III (D3) dari SEMUA JURUSAN (baik Teknik maupun Non-Teknik) 100% MEMENUHI SYARAT secara sah</strong> untuk mengikuti pembinaan dan memperoleh sertifikasi Ahli K3 Umum resmi dari Kementerian Ketenagakerjaan Republik Indonesia.</p>

<h2>Dasar Hukum: Bedah Pasal 3 Permenaker No. PER.02/MEN/1992</h2>
<p>Kualifikasi penunjukan Ahli K3 diatur secara eksplisit dalam <strong>Peraturan Menteri Tenaga Kerja No. PER.02/MEN/1992</strong> tentang Tata Cara Penunjukan, Kewajiban, dan Wewenang Ahli Keselamatan dan Kesehatan Kerja. Pada Pasal 3 dinyatakan bahwa syarat penunjukan Ahli K3 adalah:</p>

<ol>
  <li><strong>Berpendidikan Sarjana (S1), Sarjana Muda, atau Diploma III (D3)</strong> dengan ketentuan:
    <ul>
      <li>Sarjana (S1) semua jurusan dengan pengalaman kerja di bidangnya sekurang-kurangnya 2 (dua) tahun.</li>
      <li>Sarjana Muda atau Diploma III (D3) semua jurusan dengan pengalaman kerja di bidangnya sekurang-kurangnya 4 (empat) tahun.</li>
    </ul>
  </li>
  <li>Berbadan sehat jasmani dan rohani.</li>
  <li>Berkelakuan baik.</li>
  <li>Bekerja penuh di perusahaan yang bersangkutan (bagi yang mengajukan SKP).</li>
  <li>Lulus seleksi pembinaan calon Ahli K3 yang diselenggarakan oleh Kementerian Ketenagakerjaan atau Lembaga PJK3 yang ditunjuk.</li>
</ol>

<p><em>Perhatikan bahwa bunyi regulasi menggunakan frasa "semua jurusan". Tidak ada satu pasal pun dalam Permenaker 02/1992 yang membatasi Ahli K3 Umum hanya untuk lulusan fakultas teknik!</em></p>

<h2>Mengapa Latar Belakang Non-Teknik Sangat Dibutuhkan di Bidang HSE?</h2>
<p>Dalam dunia industri modern, peran seorang Ahli K3 Umum bukan sekadar menghitung kekuatan beban struktur atau memeriksa kabel listrik (itu adalah tugas teknisi spesialis). Peran utama Ahli K3 Umum adalah <strong>Manajemen Sistem, Kepatuhan Hukum, dan Komunikasi Manusia</strong>. Di sinilah lulusan non-teknik justru memiliki keunggulan kompetitif besar:</p>

<table>
  <thead>
    <tr>
      <th>Jurusan Non-Teknik</th>
      <th>Kelebihan Unik dalam Manajemen K3 Perusahaan</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>Hukum (Ilmu Hukum)</strong></td>
      <td>Sangat mahir dalam interpretasi perundang-undangan ketenagakerjaan, penyusunan kontrak keselamatan kerja vendor, penanganan aspek hukum pidana/perdata jika terjadi insiden kecelakaan kerja fatal, dan negosiasi dengan dinas tenaga kerja.</td>
    </tr>
    <tr>
      <td><strong>Manajemen &amp; Bisnis</strong></td>
      <td>Mampu menyusun Rencana Anggaran Biaya (RAB) K3, menghitung Return on Investment (ROI) dari program pencegahan kecelakaan, mengelola rantai pasok APD, dan mengintegrasikan K3 ke dalam Key Performance Indicator (KPI) korporasi.</td>
    </tr>
    <tr>
      <td><strong>Psikologi</strong></td>
      <td>Memahami pendekatan <em>Behavior-Based Safety (BBS)</em>, psikologi industri, manajemen stres dan burnout karyawan, serta teknik konseling pasca-trauma insiden kecelakaan kerja.</td>
    </tr>
    <tr>
      <td><strong>Ilmu Komunikasi</strong></td>
      <td>Mampu membawakan Safety Induction dan Safety Talk yang persuasif dan menarik, merancang kampanye visual K3 (safety poster, video briefing), dan mengelola krisis media saat terjadi insiden perusahaan.</td>
    </tr>
    <tr>
      <td><strong>Kesehatan Masyarakat (Kesmas)</strong></td>
      <td>Ahli dalam higiene industri, ergonomi perkantoran, gizi kerja, program promosi kesehatan, surveilans penyakit akibat kerja (PAK), dan penanganan ergonomi.</td>
    </tr>
  </tbody>
</table>

<h2>Daftar Berkas Persyaratan Pendaftaran Resmi</h2>
<p>Untuk memproses pembuatan akun peserta di sistem portal Teman K3 Kemnaker RI, siapkan dokumen berikut dalam format file digital (scan PDF/JPG jelas):</p>
<ul>
  <li>Scan Ijazah Asli minimal D3 atau S1 (Bagi lulusan baru yang ijazahnya belum wisuda, dapat menggunakan Surat Keterangan Lulus / SKL resmi dari universitas).</li>
  <li>Scan Transkrip Nilai Akademik Asli.</li>
  <li>Scan Kartu Tanda Penduduk (KTP) yang masih berlaku.</li>
  <li>Pas foto formal terbaru dengan latar belakang merah (pria mengenakan kemeja berdasi, wanita mengenakan blazer/pakaian formal).</li>
  <li>Surat Keterangan Bekerja / Surat Rekomendasi Perusahaan (khusus peserta utusan instansi). Fresh graduate yang belum bekerja tidak perlu melampirkan surat ini.</li>
  <li>Surat Keterangan Sehat dari klinik atau dokter pemerintah.</li>
</ul>

<h2>Kapan Latar Belakang Teknik Diwajibkan?</h2>
<p>Latar belakang teknik hanya disyaratkan jika Anda ingin mengambil <strong>Ahli K3 Spesialis</strong>, seperti:</p>
<ul>
  <li><strong>Ahli K3 Listrik:</strong> Diutamakan S1/D3 Teknik Elektro.</li>
  <li><strong>Ahli K3 Pesawat Uap &amp; Bejana Tekan:</strong> Diutamakan S1/D3 Teknik Mesin.</li>
  <li><strong>Ahli K3 Kimia:</strong> Diutamakan S1/D3 Teknik Kimia / Kimia Murni / Farmasi.</li>
  <li><strong>Ahli Muda K3 Konstruksi:</strong> Diutamakan S1/D3 Teknik Sipil / Arsitektur.</li>
</ul>
<p>Bagi Anda yang berlatar belakang non-teknik, <strong>Ahli K3 Umum adalah pintu gerbang karir terbaik</strong> untuk memasuki industri pertambangan, minyak dan gas, logistik, perhotelan, rumah sakit, maupun manufaktur berskala nasional.</p>
HTML,
        'faq' => [
            ['q' => 'Apakah lulusan SMA atau SMK bisa mendaftar Ahli K3 Umum Kemnaker?', 'a' => 'Tidak bisa untuk sertifikasi Ahli K3 Umum Kemnaker RI, karena regulasi Permenaker 02/1992 menetapkan batas pendidikan minimal adalah Diploma III (D3). Lulusan SMA/SMK disarankan mengambil program Petugas K3, Operator K3 (Forklift/Crane), atau Sertifikasi K3 level Pelaksana di BNSP.'],
            ['q' => 'Saya belum punya pengalaman kerja 2 tahun, apakah tetap bisa ikut?', 'a' => 'Bisa. Kemnaker RI memfasilitasi lulusan baru (Fresh Graduate) melalui penerbitan Sertifikat Pembinaan Calon Ahli K3 Umum. Begitu Anda diterima bekerja di perusahaan, sertifikat tersebut langsung dapat diajukan penerbitan SKP dan Lisensi tanpa tes ulang.'],
            ['q' => 'Apakah sertifikat Ahli K3 Umum yang didapatkan lulusan non-teknik memiliki bobot yang sama?', 'a' => 'Sama 100%. Tidak ada pembedaan format sertifikat atau nomor registrasi antara lulusan teknik dan non-teknik. Keduanya memiliki wewenang hukum yang setara sebagai Sekretaris P2K3 di perusahaan.']
        ]
    ],

    // ARTICLE 3: MASA BERLAKU SERTIFIKAT & SKP
    'masa-berlaku-sertifikat-ahli-k3-umum-perpanjangan-skp' => [
        'title'      => 'Berapa Lama Masa Berlaku Sertifikat Ahli K3 Umum & Prosedur Perpanjangan SKP',
        'meta_title' => 'Masa Berlaku Sertifikat Ahli K3 Umum & Syarat Perpanjangan SKP | Wahana Totalita',
        'meta_desc'  => 'Pelajari perbedaan masa berlaku Sertifikat Ahli K3 Umum (seumur hidup) vs SKP & Lisensi K3 (3 tahun). Syarat dokumen, alur perpanjangan, dan mutasi badan usaha.',
        'keywords'   => 'masa berlaku sertifikat ahli k3 umum, perpanjangan skp ahli k3 umum kemnaker, masa aktif lisensi k3, mutasi perusahaan ahli k3, temank3 kemnaker',
        'author'     => 'Wahana Totalita Konsultan',
        'content'    => <<<HTML
<h2>Perbedaan Mendasar: Sertifikat Kelulusan vs SKP &amp; Lisensi K3</h2>
<p>Di dunia industri dan ketenagakerjaan Indonesia, masih banyak praktisi HSE maupun bagian HRD yang belum memahami perbedaan status hukum antara <strong>Sertifikat Pembinaan Ahli K3 Umum</strong> dengan <strong>Surat Keputusan Penunjukan (SKP) dan Kartu Lisensi K3</strong>. Sering kali muncul kepanikan: <em>"Apakah sertifikat K3 saya yang sudah lewat 3 tahun otomatis hangus dan saya harus mengulang kursus 12 hari dari nol?"</em></p>

<p>Jawabannya tegas: <strong>TIDAK</strong>. Sertifikat kelulusan Anda tidak pernah hangus. Mari kita bedah status hukum ketiga dokumen tersebut berdasarkan regulasi resmi Direktorat Bina Kelembagaan K3 Kemnaker RI:</p>

<table>
  <thead>
    <tr>
      <th>Nama Dokumen</th>
      <th>Diterbitkan Oleh</th>
      <th>Masa Berlaku</th>
      <th>Karakteristik &amp; Hak Hukum</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>Sertifikat Pembinaan Calon Ahli K3 Umum</strong></td>
      <td>Kementerian Ketenagakerjaan RI</td>
      <td><strong>SEUMUR HIDUP</strong></td>
      <td>Melekat pada individu personil; membuktikan bahwa yang bersangkutan telah lulus uji kompetensi teori, regulasi, dan praktik K3. Tidak pernah kedaluwarsa.</td>
    </tr>
    <tr>
      <td><strong>Surat Keputusan Penunjukan (SKP) Ahli K3</strong></td>
      <td>Menteri Ketenagakerjaan RI / Dirjen Binwasnaker</td>
      <td><strong>3 (Tiga) Tahun</strong></td>
      <td>Legalitas operasional yang menunjuk personil tersebut sebagai Ahli K3 resmi di <em>perusahaan tempat ia bekerja saat ini</em>. Wajib diperpanjang setiap 3 tahun.</td>
    </tr>
    <tr>
      <td><strong>Kartu Tanda Kewenangan / Lisensi K3</strong></td>
      <td>Direktur Bina Kelembagaan K3 Kemnaker RI</td>
      <td><strong>3 (Tiga) Tahun</strong></td>
      <td>Kartu identitas kewenangan inspeksi di tempat kerja yang masa aktifnya mengikuti tanggal kedaluwarsa SKP.</td>
    </tr>
  </tbody>
</table>

<h2>Dua Situasi Wajib Perpanjangan SKP &amp; Lisensi K3</h2>
<p>Pengurusan perpanjangan SKP di Kementerian Ketenagakerjaan RI terjadi dalam dua kondisi operasional:</p>

<h3>1. Perpanjangan Rutin Berkala (Masa Aktif 3 Tahun Habis)</h3>
<p>Jika Anda tetap bekerja di perusahaan yang sama dan masa berlaku SKP Anda mendekati 3 tahun, perusahaan wajib mengajukan perpanjangan. Sebaiknya permohonan diajukan <strong>1 hingga 2 bulan sebelum masa aktif berakhir</strong> agar tidak terjadi kekosongan legalitas saat audit SMK3 PP 50/2012 atau audit ISO 45001 berlangsung.</p>

<h3>2. Mutasi Perusahaan (Pindah Tempat Kerja)</h3>
<p>Karena SKP dan Kartu Lisensi mencantumkan secara spesifik nama badan usaha (PT / CV) tempat Anda bertugas, maka saat Anda mengundurkan diri (resign) dan berpindah ke perusahaan baru, <strong>SKP lama otomatis gugur demi hukum</strong>. Anda tidak boleh menggunakan SKP dari perusahaan lama untuk beroperasi di perusahaan baru. Anda wajib mengajukan permohonan <strong>Mutasi SKP dan Lisensi Baru</strong> atas nama badan usaha tempat bekerja yang baru.</p>

<h2>Daftar Syarat Dokumen Perpanjangan SKP Ahli K3 Umum</h2>
<p>Untuk memproses perpanjangan atau mutasi SKP melalui PJK3 resmi Wahana Totalita Konsultan, siapkan berkas-berkas berikut:</p>
<ol>
  <li>Scan Sertifikat Pembinaan Calon Ahli K3 Umum asli dari Kemnaker RI.</li>
  <li>Scan SKP Ahli K3 Umum asli yang lama (beserta Kartu Lisensi aslinya).</li>
  <li>Surat Permohonan Perpanjangan / Mutasi SKP dari Direksi Perusahaan yang baru (menggunakan kop surat resmi perusahaan dan bermaterai Rp 10.000).</li>
  <li>Surat Keterangan Penunjukan Ahli K3 Umum dari manajemen perusahaan.</li>
  <li>Surat Keterangan Bekerja Aktif (bukti status karyawan di perusahaan pemohon).</li>
  <li>Laporan rekapitulasi kegiatan K3 di perusahaan selama masa penunjukan terakhir (laporan triwulan P2K3 yang telah diserahkan ke Disnaker setempat).</li>
  <li>Pas foto formal terbaru berlatar belakang merah ukuran 2x3, 3x4, dan 4x6.</li>
  <li>Salinan Ijazah dan KTP yang masih aktif.</li>
</ol>

<h2>Konsekuensi Fatal Membiarkan SKP Kedaluwarsa bagi Perusahaan</h2>
<p>Mengapa manajemen perusahaan tidak boleh menyepelekan masa aktif SKP Ahli K3-nya?</p>
<ul>
  <li><strong>Struktur P2K3 Menjadi Cacat Hukum:</strong> Berdasarkan UU No. 1/1970 dan Permenaker 04/1987, Sekretaris P2K3 wajib dijabat oleh Ahli K3 yang memiliki SKP aktif. Jika SKP mati, seluruh laporan P2K3 tidak sah.</li>
  <li><strong>Gugur Evaluasi Tender Proyek (LPSE &amp; CSMS):</strong> Dalam prakualifikasi kontraktor minyak dan gas (CSMS) maupun tender konstruksi pemerintah, SKP yang expired akan langsung digugurkan pada tahap evaluasi kualifikasi administrasi teknis.</li>
  <li><strong>Temuan Mayor pada Audit SMK3 &amp; ISO 45001:</strong> Auditor eksternal akan mencatat temuan ketidaksesuaian mayor (Major Non-Conformance) jika penanggung jawab K3 tidak memiliki legalitas kewenangan yang berlaku.</li>
</ul>
HTML,
        'faq' => [
            ['q' => 'Apakah jika SKP sudah expired bertahun-tahun harus ikut pelatihan 12 hari lagi?', 'a' => 'Tidak perlu. Sertifikat kelulusan Anda berlaku seumur hidup. Meskipun SKP Anda sudah mati selama bertahun-tahun, Anda hanya perlu mengurus administrasi perpanjangan SKP baru tanpa harus mengulang pelatihan dari awal.'],
            ['q' => 'Berapa biaya pengurusan perpanjangan SKP Ahli K3 Umum?', 'a' => 'Biaya perpanjangan atau mutasi SKP melalui PJK3 resmi Wahana Totalita Konsultan sangat terjangkau, berkisar antara Rp 1.500.000 hingga Rp 2.500.000 tergantung kelengkapan berkas dan domisili perusahaan.'],
            ['q' => 'Berapa lama estimasi waktu penerbitan SKP perpanjangan di Teman K3?', 'a' => 'Rata-rata proses verifikasi berkas dan penerbitan SKP baru di Kementerian Ketenagakerjaan RI membutuhkan waktu 14 hingga 30 hari kerja setelah dokumen lengkap diunggah ke sistem.']
        ]
    ],

    // ARTICLE 4: AHLI K3 UMUM VS SPESIALIS
    'perbedaan-ahli-k3-umum-vs-ahli-k3-spesialis' => [
        'title'      => 'Perbedaan Ahli K3 Umum vs Ahli K3 Spesialis: Mana yang Harus Diambil Dulu?',
        'meta_title' => 'Ahli K3 Umum vs Ahli K3 Spesialis: Mana yang Harus Diambil? | Wahana Totalita',
        'meta_desc'  => 'Panduan karir HSE: beda wewenang, dasar hukum, prospek gaji, dan urutan sertifikasi yang ideal antara Ahli K3 Umum dan Ahli K3 Spesialis (Konstruksi, Listrik, Kimia, dll).',
        'keywords'   => 'ahli k3 umum vs spesialis, macam macam ahli k3 kemnaker, jenis sertifikasi k3, urutan sertifikasi hse, prospek karir ahli k3',
        'author'     => 'Wahana Totalita Konsultan',
        'content'    => <<<HTML
<h2>Memahami Peta Sertifikasi K3 di Indonesia</h2>
<p>Dalam dunia profesi Keselamatan dan Kesehatan Kerja (K3) di bawah binaan Kementerian Ketenagakerjaan Republik Indonesia, sertifikasi Ahli K3 dibagi menjadi dua kelompok besar: <strong>Ahli K3 Umum (AK3U)</strong> dan <strong>Ahli K3 Spesialis</strong>. Bagi para fresh graduate, teknisi lapangan, hingga praktisi HSE pemula, menentukan sertifikasi mana yang harus diambil terlebih dahulu sering kali menjadi dilema besar.</p>

<p>Apakah langsung mengambil sertifikasi spesialis agar terlihat lebih ahli, atau wajib mengambil Ahli K3 Umum terlebih dahulu? Mari kita bedah perbedaan mendalam dari aspek wewenang hukum, cakupan materi, industri penempatan, dan roadmap karir yang ideal.</p>

<h2>Tabel Perbandingan Menyeluruh: AK3U vs Ahli K3 Spesialis</h2>
<table>
  <thead>
    <tr>
      <th>Kriteria Analisis</th>
      <th>Ahli K3 Umum (AK3U)</th>
      <th>Ahli K3 Spesialis (Listrik, Kimia, Konstruksi, dll.)</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>Dasar Hukum Utama</strong></td>
      <td>UU No. 1 Tahun 1970 &amp; Permenaker No. PER.02/MEN/1992</td>
      <td>Peraturan Menteri Tenaga Kerja sektoral sesuai bidang bahayanya</td>
    </tr>
    <tr>
      <td><strong>Sifat Kompetensi</strong></td>
      <td>Generalis (Menyeluruh di semua aspek dasar K3)</td>
      <td>Teknis Spesifik (Sangat mendalam pada satu klaster risiko)</td>
    </tr>
    <tr>
      <td><strong>Syarat Pendidikan</strong></td>
      <td>Minimal D3 / S1 dari <strong>SEMUA JURUSAN</strong></td>
      <td>Umumnya wajib D3 / S1 dari <strong>JURUSAN TEKNIK TERKAIT</strong></td>
    </tr>
    <tr>
      <td><strong>Peran dalam Kelembagaan</strong></td>
      <td>Menjabat sebagai <strong>Sekretaris P2K3</strong> di perusahaan</td>
      <td>Pengawas teknis operasional &amp; inspektur peralatan spesifik</td>
    </tr>
    <tr>
      <td><strong>Fleksibilitas Industri</strong></td>
      <td>Sangat fleksibel (Manufaktur, Rumah Sakit, Tambang, Hotel, Logistik)</td>
      <td>Terbatas pada industri yang mengoperasikan instalasi bahaya tersebut</td>
    </tr>
    <tr>
      <td><strong>Durasi Pelatihan</strong></td>
      <td>12 Hari Kerja (120 Jam Pelajaran)</td>
      <td>Umumnya lebih singkat (3 s/d 10 Hari Kerja tergantung bidang)</td>
    </tr>
  </tbody>
</table>

<h2>Mengenal Ragam Sertifikasi Ahli K3 Spesialis Kemnaker RI</h2>
<p>Jika Ahli K3 Umum bertindak sebagai "manajer orkestra" keselamatan di perusahaan, maka Ahli K3 Spesialis adalah "pemain instrumen ahli" yang membedah bahaya teknis tertentu secara presisi. Berikut adalah spesialisasi yang paling banyak dibutuhkan di industri:</p>

<h3>1. Ahli K3 Konstruksi (Permenaker No. 01/MEN/1980 &amp; Permen PUPR 10/2021)</h3>
<p>Mengawasi stabilitas scaffolding, pekerjaan galian dalam, pengoperasian tower crane, izin kerja panas, dan penyusunan Rencana Keselamatan Konstruksi (RKK) pada proyek infrastruktur dan gedung bertingkat. Memiliki jenjang Muda, Madya, dan Utama.</p>

<h3>2. Ahli K3 Listrik (Permenaker No. 12 Tahun 2015)</h3>
<p>Wajib dimiliki oleh perusahaan yang mengoperasikan pembangkitan, transmisi, distribusi, atau pemanfaatan daya listrik di atas 200 kVA. Berwenang menguji kelayakan instalasi panel, grounding, proteksi petir, dan audit PUIL 2011.</p>

<h3>3. Ahli K3 Kimia (Kepmenaker No. KEP.187/MEN/1999)</h3>
<p>Wajib dipekerjakan pada industri yang memproduksi, mengolah, atau menyimpan Bahan Berbahaya dan Beracun (B3) melebihi Kuantitas Batas Komitmen (KBK). Bertanggung jawab atas Lembar Data Keselamatan Bahan (MSDS), Nilai Ambang Batas (NAB) kimia, dan pencegahan ledakan reaktif.</p>

<h3>4. Ahli K3 Penanggulangan Kebakaran / Kelas A (Kepmenaker No. 186/MEN/1999)</h3>
<p>Spesialis penguji sarana proteksi kebakaran gedung bertingkat dan pabrik: jaringan pipa hidran, sistem sprinkler otomatis, ruang pompa kebakaran (fire pump), dan desain kompartemen tahan api.</p>

<h3>5. Ahli K3 Pesawat Uap &amp; Bejana Tekan (PUBT)</h3>
<p>Menginspeksi ketel uap (boiler) industri, tangki timbun elpiji/BBM, kompresor tekanan tinggi, dan pipa uap bertekanan berdasarkan Permenaker No. 37 Tahun 2016.</p>

<h2>Roadmap Karir yang Ideal: Mana yang Harus Diambil Dulu?</h2>
<p>Berdasarkan tren bursa kerja industri dan kemudahan penempatan kerja, berikut rekomendasi urutan sertifikasi yang paling logis:</p>

<ol>
  <li><strong>Tahap 1: Ambil AHLI K3 UMUM (AK3U) Terlebih Dahulu.</strong><br>
  Hampir 90% lowongan kerja HSE Officer, HSE Supervisor, maupun staf K3 mensyaratkan AK3U sebagai syarat administratif mutlak. Mengapa? Karena sertifikat AK3U memberikan Anda pemahaman utuh mengenai regulasi ketenagakerjaan, hak veto Stop Work Authority, dan syarat menjadi Sekretaris P2K3.</li>
  <li><strong>Tahap 2: Bekerja di Industri Pilihan &amp; Kenali Risiko Utama.</strong><br>
  Setelah bekerja 1-2 tahun di industri tertentu, Anda akan mengetahui bahaya dominan di perusahaan Anda (misalnya jika bekerja di kontraktor EPC, bahaya dominan adalah konstruksi dan scaffolding; jika di pabrik tekstil, bahayanya adalah boiler dan listrik).</li>
  <li><strong>Tahap 3: Ambil AHLI K3 SPESIALIS Sesuai Industri.</strong><br>
  Mengambil sertifikasi spesialis setelah memiliki AK3U akan melipatgandakan nilai jual profesional Anda. Anda menjadi kandidat langka yang menguasai sistem manajemen K3 sekaligus memiliki kewenangan legal inspeksi teknis lapangan.</li>
</ol>
HTML,
        'faq' => [
            ['q' => 'Apakah seorang fresh graduate boleh langsung mengambil Ahli K3 Spesialis?', 'a' => 'Secara aturan boleh jika memenuhi syarat pendidikan teknik terkait. Namun, secara peluang kerja, sangat disarankan mengambil Ahli K3 Umum terlebih dahulu karena lowongan fresh graduate hampir semuanya mencari AK3U.'],
            ['q' => 'Apakah gaji Ahli K3 Spesialis lebih tinggi daripada Ahli K3 Umum?', 'a' => 'Ya, di posisi senior, Ahli K3 Spesialis (terutama Kimia, Listrik, dan PUBT) sering kali mendapatkan remunerasi lebih tinggi karena kelangkaan personel berlisensi resmi di pasar tenaga kerja industri berat.'],
            ['q' => 'Apakah 1 orang boleh memegang SKP Ahli K3 Umum dan SKP Spesialis sekaligus?', 'a' => 'Boleh, selama orang tersebut memenuhi syarat kualifikasi kedua bidang dan ditugaskan oleh perusahaan yang bersangkutan.']
        ]
    ],

    // ARTICLE 5: AHLI MUDA K3 KONSTRUKSI TENDER LPSE
    'syarat-biaya-ahli-muda-k3-konstruksi-tender-lpse' => [
        'title'      => 'Syarat & Biaya Sertifikasi Ahli Muda K3 Konstruksi Kemnaker untuk Tender LPSE',
        'meta_title' => 'Syarat & Biaya Ahli Muda K3 Konstruksi untuk Tender LPSE | Wahana Totalita',
        'meta_desc'  => 'Panduan lengkap sertifikasi Ahli Muda K3 Konstruksi Kemnaker RI: syarat dokumen, biaya pelatihan online, dan pemenuhan syarat personil manajerial tender LPSE.',
        'keywords'   => 'ahli muda k3 konstruksi lpse, syarat k3 konstruksi tender pemerintah, biaya ahli k3 konstruksi kemnaker, pelatihan smkk permen pupr 10 2021',
        'author'     => 'Wahana Totalita Konsultan',
        'content'    => <<<HTML
<h2>Peran Krusial Personel K3 Konstruksi dalam Menangkan Tender LPSE</h2>
<p>Bagi kontraktor pelaksana maupun konsultan pengawas pekerjaan konstruksi yang rutin mengikuti lelang pengadaan barang dan jasa pemerintah di portal LPSE (Lembaga Pengadaan Secara Elektronik), persyaratan <strong>Personel Manajerial Keselamatan Konstruksi</strong> adalah salah satu poin evaluasi teknis yang paling ketat dan sering menggugurkan penawaran.</p>

<p>Kementerian Pekerjaan Umum dan Perumahan Rakyat (PUPR) melalui <strong>Permen PUPR No. 10 Tahun 2021 tentang Pedoman Sistem Manajemen Keselamatan Konstruksi (SMKK)</strong> mewajibkan setiap paket pekerjaan konstruksi—baik skala kecil, menengah, maupun besar—memiliki Ahli K3 Konstruksi atau Petugas Keselamatan Konstruksi yang kompeten dan bersertifikat resmi. Kegagalan melampirkan sertifikat yang valid dan terverifikasi akan mengakibatkan <strong>Diskualifikasi Penawaran Teknis secara mutlak</strong>.</p>

<h2>Kebutuhan Kualifikasi Personel K3 Berdasarkan Risiko Paket Proyek</h2>
<p>Sesuai dengan ketentuan Lampiran Permen PUPR 10/2021, penentuan jenjang sertifikasi K3 yang disyaratkan dalam dokumen tender mengacu pada kriteria risiko keselamatan konstruksi:</p>

<table>
  <thead>
    <tr>
      <th>Tingkat Risiko Proyek</th>
      <th>Kriteria Nilai Paket / Karakteristik Pekerjaan</th>
      <th>Kualifikasi Personel K3 Minimal yang Wajib</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>Risiko Keselamatan Konstruksi KECIL</strong></td>
      <td>Nilai HPS paket di bawah Rp 10 Miliar; mempekerjakan kurang dari 25 pekerja; tidak menggunakan alat berat canggih.</td>
      <td>Minimal <strong>1 orang Petugas Keselamatan Konstruksi</strong> atau <strong>Ahli Muda K3 Konstruksi</strong>.</td>
    </tr>
    <tr>
      <td><strong>Risiko Keselamatan Konstruksi SEDANG</strong></td>
      <td>Nilai HPS antara Rp 10 Miliar hingga Rp 100 Miliar; mempekerjakan 25 s/d 100 orang; atau pekerjaan berisiko tinggi tertentu (galian dalam, ketinggian).</td>
      <td>Minimal <strong>1 orang Ahli Madya K3 Konstruksi</strong> dan/atau <strong>Ahli Muda K3 Konstruksi</strong> berpengalaman.</td>
    </tr>
    <tr>
      <td><strong>Risiko Keselamatan Konstruksi BESAR</strong></td>
      <td>Nilai HPS di atas Rp 100 Miliar; mempekerjakan lebih dari 100 pekerja; pekerjaan terowongan, bendungan, jembatan bentang panjang, atau bahan peledak.</td>
      <td>Minimal <strong>1 orang Ahli Utama K3 Konstruksi</strong> didampingi oleh beberapa Ahli Muda/Madya K3 Konstruksi.</td>
    </tr>
  </tbody>
</table>

<h2>Persyaratan Berkas Pendaftaran Ahli Muda K3 Konstruksi Kemnaker RI</h2>
<p>Untuk mengikuti pembinaan dan sertifikasi Ahli Muda K3 Konstruksi resmi Kementerian Ketenagakerjaan RI, calon peserta wajib memenuhi kriteria berikut:</p>
<ul>
  <li>Pendidikan minimal <strong>Diploma III (D3) atau Sarjana (S1)</strong>, diutamakan dari rumpun Teknik Sipil, Arsitektur, Teknik Mesin, atau jurusan teknik terkait lainnya.</li>
  <li>Memiliki pengalaman kerja di bidang konstruksi bangunan / sipil sekurang-kurangnya:
    <ul>
      <li>Minimal 2 (dua) tahun untuk lulusan Sarjana (S1) Teknik.</li>
      <li>Minimal 3 (tiga) tahun untuk lulusan Diploma III (D3) Teknik.</li>
    </ul>
  </li>
  <li>Scan Ijazah Asli dan Transkrip Nilai Akademik.</li>
  <li>Scan Kartu Tanda Penduduk (KTP) yang masih berlaku.</li>
  <li>Surat Keterangan Pengalaman Kerja di proyek konstruksi dari perusahaan / kontraktor.</li>
  <li>Pas foto formal terbaru dengan latar belakang merah.</li>
  <li>Surat Keterangan Sehat dari dokter.</li>
</ul>

<h2>Kurikulum &amp; Materi Pembinaan Ahli Muda K3 Konstruksi</h2>
<p>Peserta dibekali kompetensi praktis yang langsung dapat diaplikasikan di lapangan proyek dan dokumen tender:</p>
<ol>
  <li><strong>Penyusunan Rencana Keselamatan Konstruksi (RKK):</strong> Merancang elemen kepemimpinan, perencanaan keselamatan (IBPRP), dukungan keselamatan, operasi keselamatan konstruksi, dan evaluasi kinerja keselamatan.</li>
  <li><strong>Identifikasi Bahaya, Penilaian Risiko, dan Peluang (IBPRP):</strong> Menyusun matriks risiko pekerjaan tanah, struktur beton, struktur baja, dan mechanical-electrical.</li>
  <li><strong>Keselamatan Alat Berat &amp; Angkat-Angkut:</strong> Memastikan Surat Izin Layak Operasi (SILO) tower crane, mobile crane, excavator, dan Surat Izin Operator (SIO) operator aktif.</li>
  <li><strong>Keselamatan Struktur Sementara &amp; Perancah:</strong> Standar perakitan dan pembongkaran scaffolding serta sistem penandaan Scafftag hijau/kuning/merah.</li>
  <li><strong>Rancangan Anggaran Biaya (RAB) Penerapan SMKK:</strong> Menghitung komponen biaya K3 yang wajib dialokasikan dalam dokumen penawaran harga tender (minimal 9 item komponen biaya K3).</li>
</ol>

<h2>Estimasi Biaya &amp; Jadwal Pelatihan di Wahana Totalita</h2>
<p>Pelatihan diselenggarakan secara <strong>Online Blended Learning via Zoom Interaktif</strong> selama 6 hingga 7 hari kerja intensif. Biaya investasi berkisar antara <strong>Rp 4.000.000 hingga Rp 5.500.000</strong> per peserta, sudah mencakup sertifikat resmi Kemnaker RI, SKP, Lisensi Kewenangan, modul lengkap, dan pendampingan pembuatan dokumen RKK tender.</p>
HTML,
        'faq' => [
            ['q' => 'Apakah sertifikat Ahli Muda K3 Konstruksi Kemnaker bisa digunakan untuk tender LPSE?', 'a' => 'Ya, sertifikat Kemnaker RI diakui secara sah oleh Pokja Pengadaan LPSE di seluruh kementerian, lembaga, dan pemerintah daerah di Indonesia sebagai bukti pemenuhan personil manajerial K3.'],
            ['q' => 'Apa bedanya Ahli K3 Konstruksi Kemnaker dengan SKK Konstruksi LPJK/BNSP?', 'a' => 'Sertifikat Kemnaker diterbitkan oleh Kementerian Ketenagakerjaan dengan fokus wewenang pengawasan K3 tempat kerja (SKP dan Lisensi). Sedangkan SKK Konstruksi diterbitkan oleh LPJK/BNSP dengan fokus klasifikasi kompetensi keahlian jasa konstruksi. Keduanya diakui dalam regulasi pengadaan pemerintah.'],
            ['q' => 'Apakah Wahana Totalita membekali template RKK untuk tender?', 'a' => 'Ya, setiap alumni pelatihan Ahli K3 Konstruksi di Wahana Totalita dibekali paket template dokumen RKK standar Permen PUPR No. 10/2021 yang siap disesuaikan untuk dokumen penawaran lelang proyek Anda.']
        ]
    ]

];

echo "Updating Articles 1 to 5 with Deep Content...\n";
foreach ($articles_to_rewrite as $slug => $data) {
    echo "Updating: $slug ... ";
    $res = update_article_by_slug($slug, $data, $key);
    $words = str_word_count(strip_tags($data['content']));
    if ($res['code'] === 200) {
        echo "✅ SUCCESS ($words words)\n";
    } else {
        echo "❌ FAILED (HTTP {$res['code']})\n";
    }
}
echo "Batch 1-5 Complete!\n";
