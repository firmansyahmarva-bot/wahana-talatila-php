<?php
/** #45 — Confined Space. */
$updated = '2026-08-10';
$faq = [
  ['q' => 'Fasilitas kerja apa saja yang masuk dalam kategori Ruang Terbatas (Confined Space)?', 'a' => 'Tangki penampungan kimia/BBM, Silo semen/biji-bijian, Boiler, Bejana Tekan, Manhole saluran limbah, Ruang Pompa Bawah Tanah (*Pit*), Digester, dan Galian tanah kedalaman >1.5 meter.'],
  ['q' => 'Berapa ambang batas kadar Oksigen (O2) dan Gas Beracun yang aman untuk memasuki Ruang Terbatas?', 'a' => 'Kadar Oksigen wajib berada di rentang **19.5% – 23.5%**. Gas Mudah Terbakar harus **<10% LEL**, Gas H2S **<10 ppm**, dan Gas CO **<25 ppm**. Jika di luar rentang ini, dilarang keras masuk!'],
  ['q' => 'Apakah Petugas Jaga Utama (Standby Person / Attendant) diperbolehkan masuk menolong pekerja yang pingsan di dalam?', 'a' => 'Sangat Dilarang keras! Attendant WAJIB tetap berada di luar pintu masuk dan memicu Prosedur Tanggap Darurat (*Rescue Plan*). 60% fatalitas ruang terbatas terjadi pada petugas penolong yang nekat masuk tanpa SCBA.'],
  ['q' => 'Sertifikasi kompetensi Kemnaker apa yang wajib dimiliki oleh tim pengerjaan Ruang Terbatas?', 'a' => 'Teknisi yang bekerja wajib mengantongi Lisensi **Petugas Utama Ruang Terbatas (Entrant)** dan **Petugas Madya Ruang Terbatas (Attendant/Gas Tester)** resmi terbitan Kemnaker RI.'],
];
?>
<div class="note"><strong>Catatan Regulasi:</strong> Pengaturan K3 Ruang Terbatas mengacu pada Kepmenaker No. Kep-187/MEN/1999 dan Surat Edaran Kemnaker SE No. 01/MEN/2012. Untuk pendampingan sertifikasi Petugas Ruang Terbatas &amp; pengadaan *Gas Detector* terkalibrasi, hubungi spesialis K3 <?= ext_link('wt_smk3', 'Wahana Totalita Konsultan') ?> per 2026.</div>

<p>Dalam sebuah pekerjaan pembersihan sisa endapan di dalam tangki bahan bakar di pelabuhan Tanjung Perak Surabaya, 3 pekerja ditemukan tewas mengenaskan di dasar tangki. Tragedi bermula saat pekerja pertama pingsan akibat paparan gas racun asam sulfida (H2S) konsentrasi 150 ppm. Pekerja kedua dan ketiga yang berada di luar langsung melompat masuk tanpa mengenakan alat bantu pernapasan (SCBA) untuk menolong — dan ikut roboh dalam hitungan 30 detik. Ruang Terbatas (*Confined Space*) adalah jebakan maut paling tidak terlihat di industri. Artikel ini membedah identifikasi hazard atmosfer, matriks threshold pengujian gas, 3 peran teknis pengurus (Entrant, Attendant, Supervisor), dan skenario penyelamatan darurat tanpa masuk (*Non-Entry Rescue*).</p>

<h2 id="threshold-gas">Matriks Threshold Ambang Batas Pengujian Atmosfer (Gas Testing)</h2>
<p>Sebelum menerbitkan *Entry Permit*, *Gas Tester* wajib mencatat parameter pengukuran atmosfer menggunakan *Gas Detector* 4-in-1 terkalibrasi:</p>

<div class="table-scroll"><table>
  <tr>
    <th>Parameter Gas Teruji</th>
    <th>Rentang Ambang Batas Aman</th>
    <th>Status Tindakan Lapangan</th>
  </tr>
  <tr>
    <td><strong>Oksigen (O2)</strong></td>
    <td><strong>19.5% – 23.5%</strong></td>
    <td>&lt;19.5% (Asfiksia/Sesak); &gt;23.5% (Bahaya Peledakan Hebat). Wajib Blower!</td>
  </tr>
  <tr>
    <td><strong>Gas Combustible (LEL)</strong></td>
    <td><strong>&lt; 10% LEL</strong></td>
    <td>&ge;10% LEL: STOP! Dilarang masuk. Bahaya peledakan percikan api.</td>
  </tr>
  <tr>
    <td><strong>Hidrogen Sulfida (H2S)</strong></td>
    <td><strong>&lt; 10 PPM</strong></td>
    <td>&ge;10 PPM: Wajib menggunakan SCBA / Air-line Respirator.</td>
  </tr>
  <tr>
    <td><strong>Karbon Monoksida (CO)</strong></td>
    <td><strong>&lt; 25 PPM</strong></td>
    <td>&ge;25 PPM: Berbahaya bagi sistem saraf &amp; jantung. Pakai SCBA!</td>
  </tr>
</table></div>

<h2 id="4-tahap-entry">4 Tahap Pengendalian Masuk Ruang Terbatas (Confined Space Entry)</h2>
<ol class="steps">
  <li><strong>Tahap 1 — Isolasi Total &amp; Purging B3 (LOTO &amp; Blanking):</strong> Pasang gembok LOTO pada pompa inlet/outlet dan pasang pelat *Blind Flange* untuk memutus aliran cairan/gas ke dalam tangki.</li>
  <li><strong>Tahap 2 — Ventilasi Paksa (Forced Blower Mechanical Ventilation):</strong> Nyalakan blower pembuang udara bersih minimal 30–60 menit sebelum dilakukan pengujian gas awal. Blower wajib terus menyala selama ada pekerja di dalam.</li>
  <li><strong>Tahap 3 — Gas Testing Berlapis (Top, Middle, Bottom):</strong> *Gas Tester* mengukur kadar gas di 3 level kedalaman tangki (karena berat jenis gas berbeda: H2S mengendap di dasar, Methane melayang di atas).</li>
  <li><strong>Tahap 4 — Otentikasi Izin Kerja &amp; Penyiapan Tripod Rescue:</strong> Pasang Tripod winch *Rescue System* di atas pintu manhole dan pastikan *Attendant* berjaga di luar.</li>
</ol>

<h2 id="matriks-peran-entrant">Matriks Tanggung Jawab 3 Peran Utama Pekerjaan Ruang Terbatas</h2>
<div class="table-scroll"><table>
  <tr>
    <th>Posisi Tugas</th>
    <th>Wewenang &amp; Tanggung Jawab Operasional</th>
    <th>Syarat Lisensi Wajib Kemnaker</th>
  </tr>
  <tr>
    <td><strong>Pekerja Utama (Entrant)</strong></td>
    <td>Masuk bekerja di dalam tangki, memakai *Harness* &amp; APD, &amp; segera keluar jika alarm gas berbunyi.</td>
    <td>Lisensi Petugas Utama Ruang Terbatas.</td>
  </tr>
  <tr>
    <td><strong>Petugas Jaga (Attendant)</strong></td>
    <td>Berjaga di luar manhole, catat log *in/out*, pantau Blower, &amp; pemicu *Rescue*. **DILARANG MASUK!**</td>
    <td>Lisensi Petugas Madya Ruang Terbatas.</td>
  </tr>
  <tr>
    <td><strong>Supervisor Masuk (Entry Supv)</strong></td>
    <td>Memverifikasi hasil *Gas Test*, otorisasi *Entry Permit*, &amp; hentikan kerja jika cuaca buruk.</td>
    <td>Ahli K3 Umum / Supervisor Terkualifikasi.</td>
  </tr>
</table></div>

<h2 id="non-entry-rescue">Skenario Penyelamatan Tanpa Masuk (Non-Entry Rescue Protocol)</h2>
<p>Aturan emas keselamatan ruang terbatas: **Jangan pernah mengorbankan nyawa penolong!** Sistem *Rescue* wajib mengutamakan *Non-Entry Rescue*:</p>

<div class="note"><strong>Mekanisme Non-Entry Rescue:</strong><br>
Setiap *Entrant* yang masuk ke tangki wajib mengenakan *Full Body Harness* yang terus terikat pada tali *Lifeline* yang terhubung ke *Winch Cable* pada Tripod di luar manhole. Jika *Entrant* pingsan, *Attendant* di luar cukup memutar tuas *Winch* untuk menarik korban keluar secara mekanis dalam waktu &lt;2 menit tanpa ada satu pun personil penolong yang perlu masuk ke dalam tangki beracun.</div>

<p>Dengan menerapkan Standar K3 Ruang Terbatas yang ketat, disiplin *Gas Testing*, dan kesiapsiagaan *Non-Entry Rescue*, perusahaan Anda tidak hanya mengamankan nilai audit sertifikasi SMK3 PP 50/2012 tetapi juga menyelamatkan nyawa para teknisi lapangan.</p>

