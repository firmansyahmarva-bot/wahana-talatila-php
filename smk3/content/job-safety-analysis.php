<?php
/** #42 — JSA (Job Safety Analysis) dalam SMK3. */
$updated = '2026-08-10';
$faq = [
  ['q' => 'Kapan JSA (Job Safety Analysis) wajib dibuat oleh tim lapangan?', 'a' => 'JSA wajib dibuat untuk pekerjaan berisiko tinggi (panas, ketinggian, ruang terbatas), pekerjaan non-rutin/perbaikan darurat, pekerjaan yang belum memiliki Instruksi Kerja (IK), dan sebagai lampiran wajib dokumen Izin Kerja Aman (PTW).'],
  ['q' => 'Apa perbedaan mendasar antara JSA dan HIRADC dalam kriteria SMK3 PP 50/2012?', 'a' => 'HIRADC adalah pemetaan risiko Makro organisasi (berlaku tahunan untuk seluruh departemen), sedangkan JSA adalah analisis risiko Mikro teknis (berlaku per tugas pekerjaan spesifik langkah demi langkah sebelum eksekusi).'],
  ['q' => 'Siapa yang bertanggung jawab menyusun dan menandatangani lembar JSA?', 'a' => 'JSA wajib disusun bersama oleh Supervisor Lapangan (Pelaksana) dan Teknisi/Pekerja yang akan mengeksekusi tugas tersebut. HSE Officer bertindak sebagai fasilitator verifikasi kualitas isi JSA.'],
  ['q' => 'Apakah dokumen JSA hasil buatan 1 tahun lalu boleh dipakai ulang?', 'a' => 'Boleh dijadikan patokan dasar (Baseline JSA), namun WAJIB ditinjau ulang dan didiskusikan kembali dalam Toolbox Meeting (TBM) untuk menyesuaikan kondisi lokasi, peralatan, dan anggota tim hari ini.'],
];
?>
<div class="note"><strong>Catatan Regulasi:</strong> Pengendalian operasional analisis keselamatan kerja (JSA) mengacu pada PP No. 50 Tahun 2012 Elemen 6 (Keamanan Pengoperasian) dan Permenaker No. 5 Tahun 1996. Untuk mengunduh formulir JSA terstandar dan pelatihan pengisian JSA lapangan, hubungi spesialis K3 <?= ext_link('wt_smk3', 'Wahana Totalita Konsultan') ?> per 2026.</div>

<p>Dalam verifikasi dokumen audit eksternal SMK3 di sebuah proyek pembangkit listrik di Jepara, auditor menghentikan pengelasan pipa uap bertekanan tinggi karena lembar JSA yang ditunjukkan foreman proyek merupakan lembar hasil fotokopi tanggal 3 bulan lalu yang mencantumkan nama 4 pekerja yang hari itu sedang cuti. Auditor mencatat **Temuan Mayor Kriteria 6.1.1** karena perusahaan memperlakukan JSA sekadar ritual kearsipan (*paperwork exercise*) tanpa ada sosialisasi bahaya riil di lapangan. JSA adalah benteng pertahanan terakhir keselamatan pekerja sebelum menyentuh mesin dan area berbahaya. Artikel ini membedah perbedaan JSA vs HIRADC, 4 langkah penyusunan instrumen JSA berkelas audit, contoh kasus teknis, dan panduan menjaga efektivitas JSA di tempat kerja.</p>

<h2 id="jsa-vs-hiradc">Matriks Perbedaan Komparatif: JSA vs HIRADC</h2>
<div class="table-scroll"><table>
  <tr>
    <th>Fitur Evaluasi</th>
    <th>HIRADC / IBPR (Tingkat Makro)</th>
    <th>JSA / Job Safety Analysis (Tingkat Mikro)</th>
  </tr>
  <tr>
    <td><strong>Cakupan Analisis</strong></td>
    <td>Seluruh proses bisnis, mesin, &amp; departemen perusahaan.</td>
    <td>Satu tugas pekerjaan teknis spesifik (contoh: Las Pipa).</td>
  </tr>
  <tr>
    <td><strong>Penanggung Jawab Utama</strong></td>
    <td>Manajer HSE &amp; Pengurus P2K3.</td>
    <td>Supervisor Lapangan &amp; Kru Pelaksana Pekerjaan.</td>
  </tr>
  <tr>
    <td><strong>Waktu Pembuatan &amp; Tinjauan</strong></td>
    <td>Ditinjau 1 tahun sekali / pasca-insiden mayor.</td>
    <td>Dibuat sebelum pekerjaan dimulai (H-1 / saat TBM).</td>
  </tr>
  <tr>
    <td><strong>Tingkat Kedalaman</strong></td>
    <td>Identifikasi hazard umum per area kerja.</td>
    <td>Membedah urutan langkah teknis 1 per 1 secara rinci.</td>
  </tr>
  <tr>
    <td><strong>Penggunaan dalam Audit</strong></td>
    <td>Bukti Perencanaan K3 (Elemen 2 PP 50/2012).</td>
    <td>Bukti Pengendalian Operasional (Elemen 6 PP 50/2012).</td>
  </tr>
</table></div>

<h2 id="4-langkah-penyusunan">4 Langkah Praktis Menyusun JSA Kualitas Tinggi di Lapangan</h2>
<ol class="steps">
  <li><strong>Langkah 1 — Uraikan Pekerjaan Menjadi Urutan Langkah Baku (5–10 Langkah):</strong> Jangan terlalu umum (misal: "kerjakan las") dan jangan terlalu detail (misal: "ambil pulpen"). Bagi pekerjaan dalam urutan logis dari persiapan, eksekusi, hingga pembersihan.</li>
  <li><strong>Langkah 2 — Identifikasi Bahaya Spesifik pada Setiap Langkah:</strong> Tanyakan pada tim: *"Apa yang bisa membuat pekerja celaka di langkah ini?"* Evaluasi bahaya listrik, mekanik, uap bertekanan, posisi jepit (*pinch point*), dan ketinggian.</li>
  <li><strong>Langkah 3 — Tetapkan Pengendalian Mengikuti Hierarki K3:</strong> Prioritaskan rekayasa teknik (barikade, LOTO, ekstraktor asap) sebelum menetapkan APD. Jangan gunakan kata mengambang seperti "Hati-hati", tetapi tuliskan aksi konkret (misal: "Pasang Barikade Radius 5 Meter").</li>
  <li><strong>Langkah 4 — Briefingkan &amp; Mintakan Tanda Tangan Seluruh Kru:</strong> Jelaskan isi JSA saat *Toolbox Meeting* sebelum alat dinyalakan. Tanda tangan pekerja adalah bukti bahwa mereka mengerti risiko dan sepakat mematuhi prosedur.</li>
</ol>

<h2 id="contoh-tabel-jsa">Contoh Tabel JSA Teknis: Pengelasan Pipa Uap di Area Tangki B3</h2>
<div class="table-scroll"><table>
  <tr>
    <th>No</th>
    <th>Urutan Langkah Pekerjaan</th>
    <th>Identifikasi Potensi Bahaya</th>
    <th>Tindakan Pengendalian Aman yang Wajib</th>
  </tr>
  <tr>
    <td>1</td>
    <td>Persiapan area &amp; mobilisasi mesin las.</td>
    <td>Kabel las terkelupas (Sengatan Listrik) &amp; jalur evakuasi tersumbat.</td>
    <td>Inspeksi ELCB &amp; fisik kabel las, rapikan jalur kabel melayang (*cable bridge*).</td>
  </tr>
  <tr>
    <td>2</td>
    <td>Pembersihan area dari cairan mudah terbakar.</td>
    <td>Percikan api mengenai sisa bahan bakar (Kebakaran).</td>
    <td>Pembersihan radius 10m, pasang *Fire Blanket*, siapkan APAR Powder 6kg + *Fire Watcher*.</td>
  </tr>
  <tr>
    <td>3</td>
    <td>Pengelasan pipa uap (*Hot Work*).</td>
    <td>Paparan sinar UV, uap beracun, &amp; luka bakar.</td>
    <td>Gunakan Kedok Las Auto-darkening, APD Appron Kulit, &amp; pasang Ekstraktor Fume Portable.</td>
  </tr>
  <tr>
    <td>4</td>
    <td>Pemeriksaan pasca-pengelasan &amp; pembersihan.</td>
    <td>Bara bara tertinggal memicu kebakaran tersembunyi.</td>
    <td>*Fire Watcher* wajib *standby* pengawasan area minimal 30 menit setelah las selesai.</td>
  </tr>
</table></div>

<h2 id="menjaga-kualitas">Cara Menjaga JSA Tetap Efektif &amp; Terhindar dari Temuan Audit</h2>
<ul class="check-list">
  <li><strong>Larang Keras Praktek Copy-Paste JSA Mentah:</strong> Setiap JSA wajib mencantumkan Lokasi Spesifik, Tanggal Hari Ini, dan Nama Pekerja yang bertugas hari itu.</li>
  <li><strong>Integrasikan JSA ke dalam Sistem Permit to Work (PTW):</strong> JSA adalah lampiran wajib yang dikunci bersama formulir Izin Kerja Panas, Ketinggian, dan Ruang Terbatas.</li>
  <li><strong>Lakukan Inspeksi Kualitas JSA oleh HSE Officer:</strong> Lakukan pencuplikan (*sampling*) mingguan ke area proyek untuk mencocokkan tindakan pengendalian di tabel JSA dengan kondisi riil di lapangan.</li>
</ul>

<p>JSA yang disusun secara jujur dan dinamis bersama pekerja lapangan tidak hanya meloloskan perusahaan Anda dari pemeriksaan audit SMK3 PP 50/2012, tetapi merupakan instrumen paling ampuh untuk mencegah kecelakaan fatal (*Zero Accident*).</p>

