<?php
/** #47 — Industrial Hygiene. Editorial link: wt_higiene. */
$updated = '2026-08-10';
$faq = [
  ['q' => 'Apa definisi Higiene Industri (Industrial Hygiene) dalam kriteria audit SMK3?', 'a' => 'Higiene Industri adalah ilmu dan seni antisipasi, rekognisi, evaluasi, dan pengendalian bahaya kesehatan di tempat kerja (Fisika, Kimia, Biologi, Ergonomi, Psikososial) untuk mencegah penyakit akibat kerja (PAK).'],
  ['q' => 'Apa regulasi acuan utama Nilai Ambang Batas (NAB) Lingkungan Kerja di Indonesia?', 'a' => 'Regulasi utamanya adalah **Permenaker No. 5 Tahun 2018** tentang K3 Lingkungan Kerja, yang mengatur standar NAB kebisingan, iklim kerja, debu, paparan B3, pencahayaan, serta kualitas udara dalam ruangan.'],
  ['q' => 'Berapa frekuensi wajib pengukuran faktor lingkungan kerja oleh PJK3 terakreditasi?', 'a' => 'Pengukuran lingkungan kerja wajib dilakukan minimal **1 kali dalam 1 tahun** (atau segera dilakukan jika terdapat perubahan mesin/proses produksi baru) oleh PJK3 Riksa Uji Lingkungan Kerja terdaftar Kemnaker.'],
  ['q' => 'Bagaimana mengintegrasikan hasil Pengukuran Lingkungan Kerja dengan Pemeriksaan Kesehatan (MCU)?', 'a' => 'Hasil pengukuran faktor bahaya wajib menentukan jenis *Panel MCU Spesifik*: Pekerja di area kebisingan >85 dB wajib tes **Audiometri**, pekerja terpapar debu silika wajib tes **Spirometri/Rontgen**, dan pekerja kimia B3 tes **Biological Monitoring**.'],
];
?>
<div class="note"><strong>Catatan Regulasi:</strong> Pengaturan Higiene Industri mengacu pada Permenaker No. 5 Tahun 2018 dan PP No. 50 Tahun 2012 Kriteria 6.9 (Pengukuran Lingkungan Kerja). Untuk pelaksanaan Riksa Uji Lingkungan Kerja &amp; Sertifikasi Hiperkes Dokter/Perawat, hubungi konsultan K3 <?= ext_link('wt_higiene', 'Wahana Totalita Konsultan') ?> per 2026.</div>

<p>Di sebuah pabrik tekstil dan pencelupan kain di Majalaya, 14 pekerja lini produksi mengeluhkan sesak napas berat dan 6 operator mesin tenun mengalami penurunan pendengaran permanen (*Noise-Induced Hearing Loss*). Saat auditor eksternal SMK3 melakukan pemeriksaan, perusahaan dijatuhi **Temuan Mayor Kriteria 6.9.1** karena selama 4 tahun beroperasi, pabrik tidak pernah melakukan pengujian kebisingan dan kadar debu melayang (*Total Dust*), serta lembar MCU karyawan hanya berupa tes darah dasar tanpa pengujian audiometri dan spirometri. Kecelakaan kerja melukai secara instan, namun bahaya kesehatan kerja (*Health Hazards*) membunuh secara sunyi melalui Penyakit Akibat Kerja (PAK). Artikel ini membedah 5 kelompok bahaya kesehatan, siklus kerja AREC, matriks NAB Permenaker 5/2018, dan integrasi data lingkungan kerja dengan MCU spesifik.</p>

<h2 id="5-kelompok-bahaya">5 Kelompok Bahaya Kesehatan Kerja (Industrial Health Hazards)</h2>
<div class="table-scroll"><table>
  <tr>
    <th>Kategori Bahaya</th>
    <th>Faktor Risiko Spesifik</th>
    <th>Standar NAB Baku (Permenaker 5/2018)</th>
    <th>Penyakit Akibat Kerja (PAK) Potential</th>
  </tr>
  <tr>
    <td><strong>1. Bahaya Fisika</strong></td>
    <td>Kebisingan, Iklim Kerja Panas, Getaran *Hand-Arm*, Pencahayaan.</td>
    <td>Bising: 85 dBA (8 jam kerja); ISBB Panas: 28.0°C (Beban Kerja Berat).</td>
    <td>Ketulian (NIHL), *Heat Stroke*, *Vibration White Finger*.</td>
  </tr>
  <tr>
    <td><strong>2. Bahaya Kimia</strong></td>
    <td>Debu Silika, Uap Pelarut Solvent, Gas Asam B3, *Fume* Las.</td>
    <td>Debu Respirabel: 3 mg/m³; Pelarut Toluena: 20 ppm.</td>
    <td>Silikosis Paru, Asma Kerja, Dermatitis Kontak Kimia, Kanker.</td>
  </tr>
  <tr>
    <td><strong>3. Bahaya Biologi</strong></td>
    <td>Jamur *AC Spore*, Bakteri *Legionella*, Virus, Limbah Medis B3.</td>
    <td>Total Angka Kuman Udara &lt; 500 CFU/m³ (Ruang Kerja).</td>
    <td>Infeksi Saluran Pernapasan, *Sick Building Syndrome*, TBC.</td>
  </tr>
  <tr>
    <td><strong>4. Bahaya Ergonomi</strong></td>
    <td>Postur Janggal, Pengangkatan Manual Berat (&gt;25kg), Gerakan Repetitif.</td>
    <td>REBA / RULA Index Score &lt; 4 (Risiko Rendah).</td>
    <td>*Musculoskeletal Disorders (MSDs)*, HNP / Syaraf Terjepit.</td>
  </tr>
  <tr>
    <td><strong>5. Bahaya Psikososial</strong></td>
    <td>Beban Kerja Berlebih, Shift Malam Kronis, Stres Organisasi.</td>
    <td>Survei Kuesioner DASS-21 / SDS (Kategori Normal).</td>
    <td>*Burnout*, Insomnia Kronis, Hipertensi Stres Kerja.</td>
  </tr>
</table></div>

<h2 id="siklus-arec">Siklus Kerja Higiene Industri 4-Tahap (AREC Framework)</h2>
<ol class="steps">
  <li><strong>Tahap 1 — Antisipasi (Anticipation):</strong> Identifikasi potensi risiko kesehatan sebelum bahan kimia/mesin baru dibeli melalui evaluasi dokumen *Safety Data Sheet* (SDS/MSDS).</li>
  <li><strong>Tahap 2 — Rekognisi (Recognition):</strong> Pemetaan lapangan (*Walkthrough Survey*) untuk mendata lokasi mana yang memiliki emisi debu, suara bising, dan panas tinggi dalam dokumen HIRADC.</li>
  <li><strong>Tahap 3 — Evaluasi (Evaluation):</strong> Melakukan pengukuran kuantitatif menggunakan alat terkalibrasi (*Sound Level Meter, Dust Sampler, Gas Detector*) oleh PJK3 Lingkungan Kerja.</li>
  <li><strong>Tahap 4 — Pengendalian (Control):</strong> Menerapkan hierarki pengendalian K3: Substitusi bahan berbahaya, Pemasangan *Local Exhaust Ventilation (LEV)*, Rotasi Kerja, dan APD Respirator/Earplug.</li>
</ol>

<h2 id="integrasi-mcu">Matriks Integrasi: Data Pengukuran Lingkungan ↔ Panel MCU Spesifik</h2>
<div class="table-scroll"><table>
  <tr>
    <th>Hasil Pengukuran Lingkungan Kerja</th>
    <th>Panel Pemeriksaan Kesehatan Wajib (MCU Karyawan)</th>
    <th>Indikator Dini Gangguan Kesehatan</th>
  </tr>
  <tr>
    <td>Area Kebisingan Mesin &gt; 85 dB(A)</td>
    <td><strong>Tes Audiometri (Hearing Test)</strong> berkala 1 tahun sekali.</td>
    <td>Penurunan ambang dengar frekuensi 4000 Hz (*Notch*).</td>
  </tr>
  <tr>
    <td>Area Paparan Debu Kayu / Semen / Silika</td>
    <td><strong>Tes Spirometri (Fungsi Paru) + Rontgen Thorax PA</strong>.</td>
    <td>Penurunan nilai FEV1/FVC (&lt;70% kapasitas vital).</td>
  </tr>
  <tr>
    <td>Area Penggunaan Bahan Kimia B3 (Solvent)</td>
    <td><strong>Tes Biomonitoring Darah &amp; Urin (Fungsi Hati/Ginjal)</strong>.</td>
    <td>Peningkatan SGOT/SGPT &amp; Kadar Kreatinin di atas normal.</td>
  </tr>
  <tr>
    <td>Area Pengangkatan Manual Gudang Logistik</td>
    <td><strong>Pemeriksaan Fisik Musculoskeletal + X-Ray Lumbosakral</strong>.</td>
    <td>Gejala nyeri pinggang bawah (*Low Back Pain*).</td>
  </tr>
</table></div>

<p>Dengan menerapkan Manajemen Higiene Industri secara sistematis, mengukur parameter lingkungan kerja sesuai Permenaker 5/2018, dan menyelaraskan panel MCU pekerja, perusahaan Anda tidak hanya mengamankan nilai audit SMK3 PP 50/2012 tetapi juga menjamin kesehatan jangka panjang seluruh aset SDM Anda.</p>

