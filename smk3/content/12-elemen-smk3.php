<?php
/** #8 — 12 Elemen Utama SMK3. */
$updated = '2026-08-10';
$faq = [
  ['q' => 'Apa perbedaan antara 5 Prinsip SMK3 dengan 12 Elemen Audit SMK3 dalam PP No. 50 Tahun 2012?', 'a' => '5 Prinsip SMK3 adalah siklus manajemen strategis (Komitmen, Perencanaan, Pelaksanaan, Pemantauan, Peninjauan), sedangkan 12 Elemen Audit adalah turunan teknis operasional preskriptif yang diaudit menggunakan 166 Kriteria.'],
  ['q' => 'Elemen audit manakah yang paling sering menjadi penyumbang Temuan Mayor saat audit eksternal?', 'a' => 'Berdasarkan statistik auditor eksternal, **Elemen 6 (Keamanan Bekerja)** dan **Elemen 7 (Standar Pemantauan)** menyumbang lebih dari 60% Temuan Ketidaksesuaian Mayor karena lemahnya pengawasan alat & riksa uji berkala.'],
  ['q' => 'Apakah seluruh 12 Elemen Audit wajib diterapkan oleh perusahaan skala kecil?', 'a' => 'Untuk penilaian Tingkat Awal (64 Kriteria), perusahaan kecil hanya diaudit pada sub-kriteria kunci dari 12 elemen tersebut. Namun untuk Tingkat Lanjutan (166 Kriteria), seluruh 12 elemen wajib dipenuhi 100%.'],
  ['q' => 'Siapa pemilik tanggung jawab (*Element Owner*) bagi masing-masing dari 12 elemen SMK3?', 'a' => 'Tanggung jawab terbagi secara lintas departemen: Elemen 1 (Direksi), Elemen 3 & 5 (Pengadaan/Procurement), Elemen 4 & 11 (Document Control & Internal Audit), Elemen 6 & 9 (Operasional Pabrik/Gudang), Elemen 12 (HRD).'],
];
?>
<div class="note"><strong>Catatan Regulasi:</strong> Struktur 12 Elemen Audit SMK3 diatur baku dalam Lampiran II PP No. 50 Tahun 2012 dan Lampiran Permenaker No. 26 Tahun 2014. Untuk konsultasi pemetaan 12 Elemen &amp; Audit Internal, hubungi tim konsultan K3 <?= ext_link('wt_smk3', 'Wahana Totalita Konsultan') ?> per 2026.</div>

<p>Dalam pelaksanaan audit eksternal SMK3 di sebuah pabrik manufaktur otomotif di Cikarang, Manajer HSE berdiri sendirian menghadapi tim auditor Kemnaker RI selama 3 hari berturut-turut. Saat auditor meminta bukti pelaksanaan evaluasi vendor pengadaan (Elemen 5) dan matriks pelatihan kompetensi HRD (Elemen 12), Manajer HSE tidak dapat menunjukkan berkas karena Manajer Pembelian dan Manajer HRD menolak terlibat dengan alasan *"K3 adalah urusan departemen HSE sendirian."* Pabrik tersebut akhirnya dinyatakan **GAGAL AUDIT** dengan skor 54%. 12 Elemen Audit SMK3 bukan sekadar daftar periksa HSE, melainkan cermin arsitektur manajemen seluruh departemen perusahaan. Artikel ini membedah rincian 12 Elemen Audit, matriks pembagian pemilik elemen (*Element Owner*), serta titik rawan ketidaksesuaian di setiap elemen.</p>

<h2 id="matriks-12-elemen">Matriks Rincian 12 Elemen Audit SMK3 &amp; Pembagian Elemen Owner</h2>

<div class="table-scroll"><table>
  <tr>
    <th>No. Elemen</th>
    <th>Judul Elemen Audit SMK3 (PP 50/2012)</th>
    <th>Jumlah Sub-Kriteria Audit</th>
    <th>Pemilik Responsibility (*Element Owner*)</th>
  </tr>
  <tr>
    <td><strong>Elemen 1</strong></td>
    <td>Pembangunan dan Pemeliharaan Komitmen</td>
    <td>25 Kriteria</td>
    <td><strong>Direktur Utama / Top Management</strong></td>
  </tr>
  <tr>
    <td><strong>Elemen 2</strong></td>
    <td>Strategi Perencanaan K3 (HIRADC &amp; Target)</td>
    <td>14 Kriteria</td>
    <td><strong>Manajer HSE &amp; Sekretaris P2K3</strong></td>
  </tr>
  <tr>
    <td><strong>Elemen 3</strong></td>
    <td>Pengendalian Perancangan &amp; Peninjauan Kontrak</td>
    <td>8 Kriteria</td>
    <td><strong>Manajer Engineering &amp; Legal Contracts</strong></td>
  </tr>
  <tr>
    <td><strong>Elemen 4</strong></td>
    <td>Pengendalian Dokumen &amp; Rekaman K3</td>
    <td>10 Kriteria</td>
    <td><strong>Document Control Manager / QMS</strong></td>
  </tr>
  <tr>
    <td><strong>Elemen 5</strong></td>
    <td>Pembelian &amp; Pengendalian Produk B3</td>
    <td>11 Kriteria</td>
    <td><strong>Manajer Pengadaan (Procurement)</strong></td>
  </tr>
  <tr>
    <td><strong>Elemen 6</strong></td>
    <td>Keamanan Bekerja Berdasarkan SMK3 (Operasional)</td>
    <td>41 Kriteria</td>
    <td><strong>Manajer Produksi &amp; Plant Manager</strong></td>
  </tr>
  <tr>
    <td><strong>Elemen 7</strong></td>
    <td>Standar Pemantauan (Inspeksi, Riksa Uji, MCU)</td>
    <td>21 Kriteria</td>
    <td><strong>Manajer Maintenance &amp; Dokter Poliklinik</strong></td>
  </tr>
  <tr>
    <td><strong>Elemen 8</strong></td>
    <td>Pelaporan &amp; Perbaikan Kekurangan (Insiden)</td>
    <td>9 Kriteria</td>
    <td><strong>Tim Investigasi Insiden P2K3</strong></td>
  </tr>
  <tr>
    <td><strong>Elemen 9</strong></td>
    <td>Pengelolaan Material &amp; Perpindahannya (Gudang)</td>
    <td>12 Kriteria</td>
    <td><strong>Manajer Logistik &amp; Kepala Gudang</strong></td>
  </tr>
  <tr>
    <td><strong>Elemen 10</strong></td>
    <td>Pengumpulan dan Penggunaan Data (Statistik K3)</td>
    <td>5 Kriteria</td>
    <td><strong>HSE Data Analyst / Staff Admin K3</strong></td>
  </tr>
  <tr>
    <td><strong>Elemen 11</strong></td>
    <td>Pemeriksaan SMK3 (Audit Internal SMK3)</td>
    <td>3 Kriteria</td>
    <td><strong>Ketua Tim Auditor Internal SMK3</strong></td>
  </tr>
  <tr>
    <td><strong>Elemen 12</strong></td>
    <td>Pengembangan Keterampilan &amp; Kemampuan (Training)</td>
    <td>7 Kriteria</td>
    <td><strong>Manajer HRD &amp; Training Center</strong></td>
  </tr>
</table></div>

<h2 id="titik-rawan">Titik Rawan Ketidaksesuaian per Kelompok Elemen</h2>
<ol>
  <li><strong>Kelompok Komitmen &amp; Dokumen (Elemen 1 &amp; 4):</strong> Kebijakan K3 tidak ditandatangani Direktur Utama terbaru, atau dokumen SOP beredar tanpa stempel *CONTROLLED COPY*.</li>
  <li><strong>Kelompok Operasional Lapangan (Elemen 6 &amp; 9):</strong> Pekerjaan panas berjalan tanpa *Permit to Work*, APAR kadaluarsa, atau penataan tabung gas B3 di gudang tidak dirantai.</li>
  <li><strong>Kelompok Pemantauan &amp; Riksa Uji (Elemen 7):</strong> Alat berat Crane/Forklift beroperasi dengan Sertifikat Izin Layak Operasi (SILO) mati, atau MCU karyawan tidak menyertakan tes audiometri di area bising.</li>
  <li><strong>Kelompok Pembelian &amp; HRD (Elemen 5 &amp; 12):</strong> Pembelian bahan kimia tanpa dokumen MSDS, atau operator forklift tidak memiliki SIO Lisensi Kemnaker.</li>
</ol>

<p>Dengan membagi kepemilikan 12 Elemen Audit secara proporsional kepada seluruh manajer departemen, penerapan SMK3 PP 50/2012 menjadi tanggung jawab bersama yang membawa jaminan keberhasilan audit sertifikasi perusahaan Anda.</p>

