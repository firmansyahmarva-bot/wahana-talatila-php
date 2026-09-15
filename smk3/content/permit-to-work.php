<?php
/** #43 — Permit to Work. */
$updated = '2026-08-10';
$faq = [
  ['q' => 'Jenis pekerjaan apa saja yang wajib menggunakan Sistem Permit to Work (PTW)?', 'a' => 'Pekerjaan Panas (*Hot Work*), Masuk Ruang Terbatas (*Confined Space Entry*), Bekerja di Ketinggian (*Working at Height*), Pekerjaan Penggalian (*Excavation*), Pekerjaan Listrik Bertegangan (*Electrical Work*), dan Pekerjaan Pengangkatan Berat (*Critical Lifting*).'],
  ['q' => 'Siapa yang berwenang menandatangani pengesahan lembar Izin Kerja Aman (PTW)?', 'a' => 'Izin Kerja wajib disahkan oleh 3 pihak: **Applicant** (Supervisor Pelaksana), **Area Owner / Gas Tester** (Pemilik Area / Penguji Gas), dan **Authorized Person / Approver** (Manajer HSE / Manajer Operasional Area).'],
  ['q' => 'Berapa lama masa berlaku maksimal untuk 1 lembar dokumen Izin Kerja (PTW)?', 'a' => 'Masa berlaku standar Izin Kerja adalah **1 Shift Kerja (maksimal 8–12 jam)**. Jika pekerjaan belum selesai, wajib dilakukan revalidasi ulang di lokasi sebelum shift berikutnya dimulai.'],
  ['q' => 'Apakah Sistem Izin Kerja Aman (PTW) berlaku untuk kontraktor luar?', 'a' => 'Sangat wajib. Seluruh subkontraktor dan teknisi luar yang bekerja di fasilitas perusahaan wajib mematuhi sistem PTW perusahaan tuan rumah (*host company*) sebelum menyentuh alat/lokasi.'],
];
?>
<div class="note"><strong>Catatan Regulasi:</strong> Pengendalian izin kerja aman mengacu pada PP No. 50 Tahun 2012 Elemen 6.1 (Sistem Izin Kerja) dan standar industri CSMS. Untuk penataan sistem PTW terpadu dan verifikasi dokumen Izin Kerja Aman, hubungi konsultan spesialis <?= ext_link('wt_smk3', 'Wahana Totalita Konsultan') ?> per 2026.</div>

<p>Di sebuah pabrik pengolahan minyak kelapa sawit di Dumai, ledakan hebat meratakan bangunan tanki penampung biogas dan menewaskan 2 pekerja teknisi kontraktor. Investigasi penegak hukum membeberkan fakta memilukan: pengelasan pipa di atas tangki dilakukan tanpa adanya dokumen **Permit to Work (PTW) / Izin Kerja Panas** dan tanpa adanya pengujian kadar gas beracun (*Gas Test*) sebelumnya. Manajer Operasional dan Supervisor Kontraktor ditetapkan sebagai tersangka pidana karena membiarkan pekerjaan berisiko tinggi berjalan tanpa otorisasi tertulis. Permit to Work (PTW) bukan sekadar formulir administrasi, melainkan mekanisme penguncian (*isolation & authorization gate*) hukum dan teknis yang mencegah terjadinya tragedi fatal. Artikel ini membedah 6 jenis izin kerja wajib, alur approval 6 tahap, matriks peran penanggung jawab, dan audit kecukupan PTW.</p>

<h2 id="6-jenis-ptw">6 Jenis Izin Kerja Aman (PTW) Wajib dalam SMK3 PP 50/2012</h2>

<div class="table-scroll"><table>
  <tr>
    <th>Jenis Izin Kerja (PTW)</th>
    <th>Kriteria Pekerjaan Wajib</th>
    <th>Persyaratan Pengendalian Khas Wajib Dipenuhi</th>
  </tr>
  <tr>
    <td><strong>1. Hot Work Permit (Izin Kerja Panas)</strong></td>
    <td>Pengelasan, pemotongan blender las, gerinda, &amp; penggunaan api terbuka.</td>
    <td>Pembersihan radius 10m, ketersediaan APAR &amp; *Fire Blanket*, serta penunjukan *Fire Watcher*.</td>
  </tr>
  <tr>
    <td><strong>2. Confined Space Permit (Izin Ruang Terbatas)</strong></td>
    <td>Masuk ke dalam tangki, silo, manhole, galian >1.5m, &amp; bejana tekan.</td>
    <td>*Gas Test* (O2, LEL, H2S, CO), ventilasi blower, LOTO, &amp; penunjukan *Standby Person*.</td>
  </tr>
  <tr>
    <td><strong>3. Working at Height Permit (Izin Ketinggian)</strong></td>
    <td>Pekerjaan pada ketinggian &ge;1.8 meter tanpa *guardrail* permanen.</td>
    <td>Pemeriksaan *Full Body Harness* ganda, titik angkur terkualifikasi, &amp; tagging *Scaffolding*.</td>
  </tr>
  <tr>
    <td><strong>4. Electrical &amp; LOTO Permit (Izin Listrik &amp; Isolasi)</strong></td>
    <td>Perbaikan panel listrik bertegangan &amp; perawatan mesin berenergi.</td>
    <td>Isolasi sakelar utama, pemasangan *Gembok LOTO (Lockout Tagout)*, &amp; pengujian tegangan nol.</td>
  </tr>
  <tr>
    <td><strong>5. Excavation Permit (Izin Penggalian)</strong></td>
    <td>Galian tanah kedalaman &gt;1 meter di area fasilitas operasional.</td>
    <td>Pemetaan jalur pipa/kabel bawah tanah (*detector scan*), kemiringan dinding galian (*shoring*).</td>
  </tr>
  <tr>
    <td><strong>6. Cold / General Work Permit (Izin Pekerjaan Dingin)</strong></td>
    <td>Pekerjaan perbaikan mekanikal non-rutin yang berisiko tinggi.</td>
    <td>Lampiran JSA teknis &amp; pengamanan area (*Barricade Tape*).</td>
  </tr>
</table></div>

<h2 id="alur-approval">Alur Kerja 6 Tahap Pengurusan Izin Kerja Aman (PTW Workflow)</h2>
<ol class="steps">
  <li><strong>Tahap 1 — Pengajuan &amp; Penyusunan JSA (H-1 / Sebelum Kerja):</strong> Supervisor Pelaksana mengajukan draft PTW dilampiri dokumen JSA teknis yang telah ditandatangani kru.</li>
  <li><strong>Tahap 2 — Pemeriksaan Kondisi Fisik Lapangan &amp; Gas Testing:</strong> *Gas Tester* / HSE Officer turun ke lokasi untuk menguji kadar Oksigen (19.5%–23.5%), gas mudah terbakar (&lt;10% LEL), dan gas beracun (0 ppm H2S/CO).</li>
  <li><strong>Tahap 3 — Pemasangan Pengendalian &amp; Isolasi Energi (LOTO):</strong> Teknisi memasang gembok LOTO pada panel sakelar dan memasang pita barikade di sekeliling lokasi kerja.</li>
  <li><strong>Tahap 4 — Otorisasi &amp; Pengesahan Tanda Tangan:</strong> *Authorized Person* (Manajer Area) memverifikasi ulang seluruh checklist sebelum menandatangani lembar PTW resmi.</li>
  <li><strong>Tahap 5 — Pelaksanaan Terkontrol &amp; Monitoring Berkala:</strong> Pekerjaan dimulai di bawah pengawasan *Fire Watcher* / *Standby Person*. *Gas Test* diulang setiap 2–4 jam sekali.</li>
  <li><strong>Tahap 6 — Penutupan Izin Kerja (Permit Closure):</strong> Setelah pekerjaan selesai, lokasi dibersihkan, LOTO dilepas, dan 3 pihak menandatangani kolom Penutupan PTW.</li>
</ol>

<h2 id="matriks-peran">Matriks Tanggung Jawab 4 Pihak Pengelola Sistem PTW</h2>
<div class="table-scroll"><table>
  <tr>
    <th>Peran Penanggung Jawab</th>
    <th>Tugas &amp; Tanggung Jawab Operasional</th>
    <th>Bukti Verifikasi dalam Audit</th>
  </tr>
  <tr>
    <td><strong>Applicant (Pelaksana)</strong></td>
    <td>Menyusun JSA, memastikan APD kru lengkap, &amp; mematuhi batas waktu PTW.</td>
    <td>Tanda tangan pada kolom Pengaju PTW.</td>
  </tr>
  <tr>
    <td><strong>Gas Tester / Inspector</strong></td>
    <td>Menguji atmosfer udara dengan *Gas Detector* terkalibrasi &amp; cek fisik safety.</td>
    <td>Isian angka O2/LEL &amp; tanda tangan di kolom Gas Test.</td>
  </tr>
  <tr>
    <td><strong>Authorized Person (Approver)</strong></td>
    <td>Memutus izin boleh/tidaknya pekerjaan berjalan berdasarkan verifikasi fisik.</td>
    <td>Tanda tangan pada kolom Pengesahan Utama.</td>
  </tr>
  <tr>
    <td><strong>Fire Watcher / Standby Person</strong></td>
    <td>Berjaga penuh di luar lokasi (tanpa ikut bekerja) untuk merespon kondisi darurat.</td>
    <td>Tanda tangan di kolom Petugas Jaga Khusus.</td>
  </tr>
</table></div>

<h2 id="5-temuan-audit-ptw">5 Temuan Audit Eksternal Terkait PTW yang Sering Menggugurkan Sertifikasi</h2>
<ol>
  <li><strong>PTW Ditandatangani dari Balik Meja (Tanpa Kunjungan Lapangan):</strong> Auditor menemukan jam pengesahan PTW bertanggal sama padahal lokasi pabrik berjarak 2 km dari kantor.</li>
  <li><strong>Hasil Gas Testing Ditulis Angka Fiktif Seragam:</strong> Kolom gas test diisi angka tulisan tangan sama persis ("20.9% O2, 0% LEL") untuk 10 hari berturut-turut tanpa sertifikat kalibrasi *Gas Detector*.</li>
  <li><strong>PTW Kedaluwarsa Tetap Dipakai Bekerja:</strong> Pekerjaan shift malam tetap berjalan menggunakan lembar PTW shift pagi yang sudah habis masa berlakunya tanpa revalidasi.</li>
  <li><strong>Petugas Fire Watcher Ikut Mengelas:</strong> *Fire Watcher* yang seharusnya berjaga memegang APAR justru ikut memegang stang las. Ini adalah Temuan Pelanggaran Integritas Mayor.</li>
  <li><strong>Tidak Ada Kolom Penutupan Izin Kerja (Permit Closure):</strong> Pekerjaan telah selesai 1 bulan lalu tetapi lembar PTW tidak pernah ditutup resmi oleh Manajer Area.</li>
</ol>

<p>Dengan menerapkan Sistem Permit to Work (PTW) yang disiplin, transparan, dan ketat, perusahaan Anda tidak hanya mengamankan kepatuhan audit SMK3 PP 50/2012 tetapi juga melindungi nyawa seluruh pekerja dari risiko kecelakaan fatal.</p>
