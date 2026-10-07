"""
scripts/enrich_batch_1_to_5.py
Safely injects authoritative, deep sections into articles 2, 3, 4, 5.
"""
import sys

art2_extra = """
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
"""

art3_extra = """
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
"""

art4_extra = """
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
<p>Kombinasi inilah yang menciptakan ekosistem keselamatan kerja yang paripurna, nir-kecelakaan (Zero Accident), dan siap menghadapi audit sertifikasi berstandar dunia.</p>
"""

art5_extra = """
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
"""

with open('scripts/deep_rewrite_batch_1_to_5.py', 'r', encoding='utf-8') as f:
    code = f.read()

code = code.replace('art2_content = """', 'art2_content = """\n' + art2_extra)
code = code.replace('art3_content = """', 'art3_content = """\n' + art3_extra)
code = code.replace('art4_content = """', 'art4_content = """\n' + art4_extra)
code = code.replace('art5_content = """', 'art5_content = """\n' + art5_extra)

with open('scripts/deep_rewrite_batch_1_to_5.py', 'w', encoding='utf-8') as f:
    f.write(code)

print("Enrichment injected successfully!")
