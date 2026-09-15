<?php
$updated = '2026-07-20';

$howto = [
  'name' => 'Cara Membuat HIRADC',
  'steps' => [
    ['name' => 'Identifikasi bahaya', 'text' => 'Petakan setiap potensi bahaya di setiap tahap pekerjaan atau proses.'],
    ['name' => 'Nilai risiko', 'text' => 'Hitung tingkat risiko dari kombinasi kemungkinan (likelihood) dan tingkat keparahan (severity).'],
    ['name' => 'Tentukan pengendalian', 'text' => 'Pilih langkah pengendalian mengikuti hierarki: eliminasi, substitusi, rekayasa teknik, administratif, lalu APD.'],
    ['name' => 'Dokumentasikan dan tinjau ulang', 'text' => 'Catat dalam tabel HIRADC dan tinjau ulang secara berkala atau saat ada perubahan proses.'],
  ],
];
?>
<p><strong>HIRADC</strong> (Hazard Identification, Risk Assessment and Determining Control) — sering juga disebut <strong>HIRARC</strong> — adalah metode inti manajemen risiko K3: mengenali bahaya, menilai seberapa besar risikonya, lalu menentukan cara mengendalikannya. Ini bukan formalitas administratif, tapi tulang punggung penerapan <?= ilink('c1', 'SMK3') ?> di lapangan.</p>

<h2 id="matriks-risiko">Matriks Penilaian Risiko</h2>
<p>Tingkat risiko umumnya dihitung dengan rumus sederhana:</p>
<div class="callout callout-info">
  <span class="callout-icon"><?= icon('info') ?></span>
  <p><strong>Tingkat Risiko = Kemungkinan (Likelihood) × Keparahan (Severity)</strong>. Semakin tinggi nilainya, semakin prioritas pengendaliannya.</p>
</div>

<h2 id="hierarki-pengendalian">Hierarki Pengendalian Risiko</h2>
<p>Urutan ini bukan pilihan bebas — pengendalian di level atas selalu lebih diutamakan daripada level bawah:</p>
<ol class="timeline">
  <li><strong>Eliminasi</strong><p>Menghilangkan sumber bahaya sepenuhnya — paling efektif, paling jarang bisa dilakukan penuh.</p></li>
  <li><strong>Substitusi</strong><p>Mengganti bahan, alat, atau proses dengan yang lebih rendah risikonya.</p></li>
  <li><strong>Rekayasa Teknik (Engineering Control)</strong><p>Modifikasi desain alat, mesin, atau tata letak untuk mengurangi paparan bahaya.</p></li>
  <li><strong>Administratif</strong><p>Prosedur kerja, rotasi shift, pelatihan, rambu peringatan.</p></li>
  <li><strong>Alat Pelindung Diri (APD)</strong><p>Lapisan pengendalian terakhir — lihat <?= ilink('c4', 'jenis dan standar APD') ?>.</p></li>
</ol>

<h2 id="hiradc-vs-jsa">HIRADC vs JSA — Apa Bedanya?</h2>
<p>HIRADC bersifat sistemik — memetakan bahaya di seluruh proses atau area kerja. <?= ilink('c3', 'JSA (Job Safety Analysis)') ?> lebih spesifik ke satu jenis pekerjaan, langkah demi langkah. Keduanya saling melengkapi, bukan saling menggantikan.</p>

<?php $faq = [
  ['q' => 'Apa beda HIRADC dan HIRARC?', 'a' => 'Keduanya merujuk pada metode yang sama — identifikasi bahaya dan penilaian risiko — hanya penamaan yang berbeda di lapangan.'],
  ['q' => 'Kapan HIRADC perlu ditinjau ulang?', 'a' => 'Secara berkala sesuai kebijakan perusahaan, dan wajib segera ditinjau ulang setiap ada perubahan proses, alat, atau bahan kerja.'],
]; ?>
