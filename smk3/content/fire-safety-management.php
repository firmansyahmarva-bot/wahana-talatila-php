<?php
/** #46 — Fire Safety Management. Editorial link: wt_kebakaran. */
$updated = '2026-08-10';
$faq = [
  ['q' => 'Apa dasar hukum utama pengelolaan Manajemen Keselamatan Kebakaran di tempat kerja Indonesia?', 'a' => 'Dasar hukum utamanya adalah **Kepmenaker No. Kep-186/MEN/1999** tentang Unit Penanggulangan Kebakaran, Permenaker No. 04/1980 (APAR), Permenaker No. 02/1983 (Alarm Otomatik), dan PP No. 50 Tahun 2012 Kriteria 6.7.'],
  ['q' => 'Berapa jumlah rasio Petugas Peran Kebakaran (Kelas D) yang wajib dimiliki perusahaan?', 'a' => 'Berdasarkan Kepmenaker 186/1999, rasio minimal Petugas Peran Kebakaran (Kelas D) adalah **2 orang untuk setiap 25 orang tenaga kerja** di tempat kerja risiko bahaya kebakaran ringan/sedang.'],
  ['q' => 'Seberapa sering inspeksi fisik APAR dan simulasi evakuasi kebakaran wajib dilaksanakan?', 'a' => 'Inspeksi visual APAR wajib dilakukan **1 bulan sekali** (tercatat di Kartu Gantung), pemeriksaan teknis 6-bulanan, dan Simulasi Tanggap Darurat Kebakaran (*Fire Evacuation Drill*) wajib dilaksanakan minimal **1 kali dalam 1 tahun**.'],
  ['q' => 'Apa saja 4 jenjang lisensi K3 Penanggulangan Kebakaran Kemnaker RI?', 'a' => 'Jenjang Lisensi Kebakaran Kemnaker terdiri dari: **Kelas D** (Petugas Peran Kebakaran), **Kelas C** (Regu Penanggulangan Kebakaran), **Kelas B** (Koordinator Penanggulangan Kebakaran), dan **Kelas A** (Ahli K3 Spesialis Penanggulangan Kebakaran).'],
];
?>
<div class="note"><strong>Catatan Regulasi:</strong> Pengaturan keselamatan kebakaran mengacu pada Kepmenaker No. Kep-186/MEN/1999 dan PP No. 50 Tahun 2012 Kriteria 6.7. Untuk penyelenggaraan sertifikasi Petugas Kebakaran Kelas D, C, B, A Kemnaker RI, hubungi spesialis K3 <?= ext_link('wt_kebakaran', 'Wahana Totalita Konsultan') ?> per 2026.</div>

<p>Dalam sebuah audit eksternal SMK3 di sebuah gudang logistik tekstil di Bandung, auditor menerbitkan **Temuan Mayor Kriteria 6.7.1** karena 12 unit APAR Powder 6kg terhalang oleh tumpukan palet barang, pintu darurat (*Emergency Exit*) dikunci dari luar dengan gembok rantai demi alasan keamanan barang, dan perusahaan tidak pernah menyelenggarakan simulasi evakuasi kebakaran dalam 3 tahun terakhir. Kebakaran adalah bencana paling menghancurkan yang sanggup meratakan aset usaha ratusan miliar dalam waktu kurang dari 2 jam. Artikel ini membedah Kepmenaker No. 186/1999, matriks proteksi aktif &amp; pasif, struktur organisasi tim tanggap darurat Kelas A–D, serta 5 tahap pelaksanaan simulasi evakuasi berkelas audit.</p>

<h2 id="proteksi-aktif-pasif">Matriks Komparatif Proteksi Kebakaran Aktif &amp; Pasif</h2>
<div class="table-scroll"><table>
  <tr>
    <th>Kategori Proteksi</th>
    <th>Komponen Sarana Proteksi</th>
    <th>Fungsi Utama Lapangan</th>
    <th>Kewajiban Pengujian &amp; Inspeksi Berkala</th>
  </tr>
  <tr>
    <td rowspan="3"><strong>Proteksi Aktif (Active Protection)</strong></td>
    <td>APAR (Alat Pemadam Api Ringan)</td>
    <td>Pemadaman api mula (tahap awal).</td>
    <td>Inspeksi visual bulanan &amp; uji tekanan 5 tahunan.</td>
  </tr>
  <tr>
    <td>Sistem Hydrant &amp; Pompa Damkar</td>
    <td>Pasokan air pemadaman api besar.</td>
    <td>Pengujian mingguan *Jockey &amp; Diesel Pump* beban.</td>
  </tr>
  <tr>
    <td>Smoke &amp; Heat Detector / Alarm</td>
    <td>Pendeteksian dini &amp; peringatan dini.</td>
    <td>Pengujian fungsi zonal &amp; baterai cadangan 6-bulan.</td>
  </tr>
  <tr>
    <td rowspan="2"><strong>Proteksi Pasif (Passive Protection)</strong></td>
    <td>Kompartementasi &amp; Dinding Tahan Api</td>
    <td>Menahan penyerbaran api &amp; asap (2-4 jam).</td>
    <td>Pemeriksaan integritas celah *fire stop* kabel.</td>
  </tr>
  <tr>
    <td>Jalur Evakuasi &amp; Pintu Darurat</td>
    <td>Sarana penyelamatan jiwa ke Titik Kumpul.</td>
    <td>Bebas rintangan 100% &amp; lampu *Exit Sign* menyala.</td>
  </tr>
</table></div>

<h2 id="struktur-tim-kebakaran">Struktur 4 Jenjang Petugas Kebakaran (Kepmenaker 186/1999)</h2>
<p>Pengurusan organisasi tanggap darurat kebakaran tempat kerja dibagi dalam 4 jenjang kompetensi Kemnaker:</p>

<div class="table-scroll"><table>
  <tr>
    <th>Jenjang Kelas</th>
    <th>Nama Sertifikasi Lisensi</th>
    <th>Rasio Kebutuhan Wajib</th>
    <th>Tanggung Jawab Operasional Utama</th>
  </tr>
  <tr>
    <td><strong>Kelas D</strong></td>
    <td>Petugas Peran Kebakaran</td>
    <td>2 orang per 25 pekerja per unit.</td>
    <td>Pemadaman awal APAR &amp; pemandu jalur evakuasi unit kerja.</td>
  </tr>
  <tr>
    <td><strong>Kelas C</strong></td>
    <td>Regu Penanggulangan Kebakaran</td>
    <td>1 Regu per shift (minimal 2-5 orang).</td>
    <td>Pengoperasian hidran &amp; pemadaman tim internal pabrik/gedung.</td>
  </tr>
  <tr>
    <td><strong>Kelas B</strong></td>
    <td>Koordinator Kebakaran</td>
    <td>1 orang per tempat kerja risiko sedang.</td>
    <td>Memimpin penanggulangan &amp; koordinasi dengan Damkar Kota.</td>
  </tr>
  <tr>
    <td><strong>Kelas A</strong></td>
    <td>Ahli K3 Spesialis Kebakaran</td>
    <td>1 orang per tempat kerja risiko berat.</td>
    <td>Mendesain sistem proteksi &amp; analisis audit kebakaran.</td>
  </tr>
</table></div>

<h2 id="5-tahap-simulasi">5 Tahap Pelaksanaan Simulasi Evakuasi Kebakaran (Evacuation Drill)</h2>
<ol class="steps">
  <li><strong>Tahap 1 — Penyusunan Skenario &amp; Tim Warden (H-14):</strong> Tetapkan titik lokasi api fiktif (misal: Ruang Server), jalur evakuasi alternatif, dan tunjuk *Floor Warden* di tiap lantai.</li>
  <li><strong>Tahap 2 — Aktivasi Alarm &amp; Panggilan Darurat (Hari-H):</strong> Bunyikan Sirine Alarm Kebakaran (*Break Glass / Smoke Test*), tim Kelas D memadamkan APAR, dan hubungi Dinas Damkar setempat.</li>
  <li><strong>Tahap 3 — Evakuasi Teratur ke Titik Kumpul (Assembly Point):</strong> Pekerja keluar melalui Pintu Darurat tanpa panik (Dilarang menggunakan Lift!). *Floor Warden* mengarahkan ke Titik Kumpul.</li>
  <li><strong>Tahap 4 — Penghitungan Kepala Pekerja (Head Count Roll Call):</strong> *Chief Warden* melakukan verifikasi absensi di Titik Kumpul untuk memastikan zero korban tertinggal.</li>
  <li><strong>Tahap 5 — Evaluasi Waktu Response &amp; Pelaporan Risalah Drill:</strong> Hitung total durasi evakuasi (Target standar &lt;5 menit). Catat kendala dan terbitkan Laporan Evaluasi Simulasi untuk Bukti Audit SMK3.</li>
</ol>

<p>Dengan menerapkan Manajemen Keselamatan Kebakaran secara komprehensif, memelihara sarana proteksi fisik, dan melatih tim petugas kebakaran Kelas D–A secara rutin, perusahaan Anda dijamin siap menghadapi audit sertifikasi SMK3 PP 50/2012 serta melindungi aset bisnis dari bencana kebakaran.</p>

