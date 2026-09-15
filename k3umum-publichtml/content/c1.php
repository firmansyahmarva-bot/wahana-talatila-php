<?php
$updated = '2026-07-20';
?>
<p><strong>SMK3 (Sistem Manajemen Keselamatan dan Kesehatan Kerja)</strong> adalah bagian dari sistem manajemen perusahaan secara keseluruhan yang mengelola risiko K3 secara terstruktur — bukan sekadar kumpulan aturan, tapi siklus perencanaan, penerapan, pengukuran, dan tinjauan berkelanjutan. Dasar hukumnya adalah <?= ilink('a', 'PP No. 50 Tahun 2012') ?> tentang Penerapan SMK3.</p>

<h2 id="wajib-smk3">Siapa yang Wajib Menerapkan SMK3?</h2>
<p>Perusahaan yang mempekerjakan minimal 100 orang, atau perusahaan dengan tingkat risiko bahaya tinggi berapa pun jumlah karyawannya, wajib menerapkan SMK3 sesuai PP 50/2012.</p>

<h2 id="struktur-kriteria">Struktur Penilaian: 12 Elemen, 166 Kriteria</h2>
<p>Penerapan SMK3 dinilai melalui audit terhadap 12 elemen yang dijabarkan menjadi total 166 kriteria. Tingkat penerapan yang diaudit bertahap sesuai tingkat pencapaian perusahaan:</p>
<div class="stat-grid">
  <div class="stat-card"><b>64</b><span>Kriteria — Tingkat Awal</span></div>
  <div class="stat-card"><b>122</b><span>Kriteria — Tingkat Transisi</span></div>
  <div class="stat-card"><b>166</b><span>Kriteria — Tingkat Lanjutan</span></div>
</div>

<h2 id="hasil-audit">Kategori Hasil Audit</h2>
<div class="table-scroll">
  <table>
    <thead><tr><th>Pencapaian</th><th>Kategori</th></tr></thead>
    <tbody>
      <tr><td>Kurang dari 60%</td><td>Kurang</td></tr>
      <tr><td>60% – 84%</td><td>Baik</td></tr>
      <tr><td>85% – 100%</td><td>Memuaskan</td></tr>
    </tbody>
  </table>
</div>
<p>Sertifikat SMK3 yang diterbitkan berdasarkan hasil audit ini berlaku selama <strong>3 tahun</strong>. Detail mekanisme auditnya sendiri dibahas di <?= ilink('c6', 'halaman Audit dan Inspeksi K3') ?>.</p>

<div class="callout callout-info">
  <span class="callout-icon"><?= icon('info') ?></span>
  <p>Ahli K3 Umum bukan pemilik tunggal tanggung jawab SMK3 — tapi dalam praktiknya sering menjadi salah satu penggerak utama penerapannya di lapangan, terutama lewat perannya di <?= ilink('c', 'P2K3') ?>.</p>
</div>

<?php $faq = [
  ['q' => 'Apa beda SMK3 dengan P2K3?', 'a' => 'P2K3 adalah forum/komite kerja sama K3, sedangkan SMK3 adalah sistem manajemen menyeluruh yang mencakup 12 elemen dan 166 kriteria. Keduanya saling melengkapi, bukan saling menggantikan.'],
  ['q' => 'Berapa lama sertifikat SMK3 berlaku?', 'a' => 'Sertifikat SMK3 berlaku 3 tahun sejak diterbitkan berdasarkan hasil audit.'],
]; ?>
