<?php
$updated = '2026-07-20';

$howto = [
  'name' => 'Tahapan Menjadi Ahli K3 Umum',
  'steps' => [
    ['name' => 'Penuhi syarat dan siapkan dokumen', 'text' => 'Pendidikan minimal, dokumen identitas, ijazah, surat keterangan sehat. Lihat rincian di halaman Syarat Ahli K3 Umum.'],
    ['name' => 'Daftar ke penyelenggara pelatihan resmi', 'text' => 'Pilih Lembaga Pelatihan Kerja (LPK) yang terakreditasi Kemnaker, atau lembaga sertifikasi kompetensi untuk jalur BNSP.'],
    ['name' => 'Ikuti pelatihan (jalur Kemnaker: 12 hari)', 'text' => '9 hari materi teori regulasi dan teknis K3, 1 hari kunjungan/observasi lapangan ke perusahaan, dilanjutkan penyusunan laporan Praktik Kerja Lapangan (PKL).'],
    ['name' => 'Ikuti evaluasi akhir', 'text' => 'Terdiri dari seminar presentasi laporan PKL di hadapan penguji, dan ujian tertulis individu yang menguji pemahaman regulasi dan teknis.'],
    ['name' => 'Terima SKP dari Kemnaker', 'text' => 'Setelah dinyatakan lulus, Surat Keputusan Penunjukan (SKP) sebagai Ahli K3 Umum diterbitkan dan berlaku 3 tahun.'],
  ],
];
?>
<p>Secara garis besar, ada dua jalur resmi untuk menjadi Ahli K3 Umum: jalur <strong>Kemnaker</strong> (Permenaker No. PER-02/MEN/1992) dan jalur <strong>BNSP</strong> (berbasis SKKNI, Kepmenaker No. 38 Tahun 2019). Keduanya sah dan diakui, tetapi prosesnya berbeda. Halaman ini menjelaskan jalur Kemnaker secara detail karena paling umum diikuti fresh graduate dan pemula — perbandingan lengkap kedua jalur ada di <?= ilink('b') ?>.</p>

<div class="callout callout-info">
  <span class="callout-icon"><?= icon('info') ?></span>
  <p>Sebelum mendaftar, pastikan dulu Anda memenuhi <?= ilink('a2', 'syarat pendidikan dan administrasi') ?> — ini akan menghemat waktu Anda di tahap pendaftaran.</p>
</div>

<h2 id="tahapan">Lima Tahapan Menjadi Ahli K3 Umum</h2>
<p>Berikut alur lengkap jalur Kemnaker, dari persiapan sampai sertifikat terbit.</p>

<h2 id="rincian-pelatihan">Rincian 12 Hari Pelatihan</h2>
<p>Pelatihan jalur Kemnaker berlangsung 12 hari kerja (umumnya Senin–Sabtu), dengan struktur sebagai berikut:</p>
<div class="stat-grid">
  <div class="stat-card"><b>9 Hari</b><span>Materi teori: regulasi K3, identifikasi bahaya, manajemen risiko</span></div>
  <div class="stat-card"><b>1 Hari</b><span>Kunjungan dan observasi lapangan ke perusahaan</span></div>
  <div class="stat-card"><b>2 Hari</b><span>Evaluasi: seminar laporan PKL + ujian tertulis individu</span></div>
</div>
<p>Selama masa teori, peserta juga menyusun laporan Praktik Kerja Lapangan (PKL) secara berkelompok berdasarkan hasil observasi — laporan ini dipresentasikan di hadapan penguji sebagai bagian dari evaluasi akhir, bukan sekadar tugas tambahan. <?= ilink('f2', 'Lihat contoh soal dan gambaran ujian tertulisnya') ?>.</p>

<h2 id="setelah-lulus">Setelah Dinyatakan Lulus</h2>
<p>Kelulusan tidak otomatis berarti Anda langsung memegang jabatan Ahli K3 di sebuah perusahaan. Yang Anda terima adalah <strong>SKP (Surat Keputusan Penunjukan)</strong> dari Kemnaker — dokumen yang menjadi dasar hukum ketika Anda ditunjuk resmi oleh perusahaan tempat bekerja. SKP ini berlaku 3 tahun dan wajib diperpanjang sebelum masa berlakunya habis.</p>
<div class="callout callout-warning">
  <span class="callout-icon"><?= icon('warning') ?></span>
  <p>Perpanjangan SKP idealnya dilakukan sebelum atau maksimal 1 tahun setelah masa berlaku habis. Lewat dari itu, Anda harus mengikuti pelatihan dari awal — bukan sekadar perpanjang.</p>
</div>

<?php $faq = [
  ['q' => 'Apakah pelatihan Ahli K3 Umum bisa diikuti secara online?', 'a' => 'Beberapa batch, termasuk program pembinaan Kemnaker, pernah diselenggarakan secara daring. Ketersediaan kelas daring tergantung penyelenggara — tanyakan langsung ke penyelenggara pilihan Anda.'],
  ['q' => 'Apakah ujian tertulisnya sulit?', 'a' => 'Materi ujian pada dasarnya mengulang apa yang sudah dibahas selama 9 hari teori. Peserta yang mengikuti seluruh sesi dengan baik umumnya tidak kesulitan.'],
]; ?>
