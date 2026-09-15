<?php
$updated = '2026-07-20';
?>
<p>Audit dan inspeksi K3 sering dianggap sama, padahal berbeda dari sisi tujuan, frekuensi, dan siapa yang melakukannya. Memahami bedanya penting supaya perusahaan tidak salah menyusun program pengawasan K3-nya.</p>

<h2 id="beda-audit-inspeksi">Audit vs Inspeksi — Apa Bedanya?</h2>
<div class="compare-grid">
  <div class="compare-card">
    <h3>Audit K3</h3>
    <ul>
      <li><span class="ci"><?= icon('check') ?></span> Sistematis, mengacu ke standar formal (mis. 166 kriteria <?= ilink('c1', 'SMK3') ?>)</li>
      <li><span class="ci"><?= icon('check') ?></span> Biasanya dilakukan lembaga audit independen bersertifikat</li>
      <li><span class="ci"><?= icon('check') ?></span> Frekuensi jarang — umumnya per beberapa tahun untuk sertifikasi</li>
      <li><span class="ci"><?= icon('check') ?></span> Hasilnya menentukan status sertifikasi (kurang/baik/memuaskan)</li>
    </ul>
  </div>
  <div class="compare-card">
    <h3>Inspeksi K3</h3>
    <ul>
      <li><span class="ci"><?= icon('check') ?></span> Praktis, berbasis checklist harian/mingguan/bulanan</li>
      <li><span class="ci"><?= icon('check') ?></span> Dilakukan internal — Ahli K3, pengawas, atau anggota P2K3</li>
      <li><span class="ci"><?= icon('check') ?></span> Frekuensi tinggi — rutin dan berulang</li>
      <li><span class="ci"><?= icon('check') ?></span> Hasilnya berupa temuan yang segera ditindaklanjuti</li>
    </ul>
  </div>
</div>

<h2 id="checklist-inspeksi">Contoh Poin Checklist Inspeksi K3</h2>
<ul>
  <li>Kondisi dan kelengkapan <?= ilink('c4', 'APD') ?> yang digunakan pekerja</li>
  <li>Kondisi alat pemadam api ringan (APAR) dan jalur evakuasi</li>
  <li>Kerapian area kerja (housekeeping) dan potensi bahaya tersandung/terpeleset</li>
  <li>Kelengkapan dan masa berlaku kotak <?= ilink('c5', 'P3K') ?></li>
  <li>Kepatuhan terhadap prosedur kerja aman (JSA) untuk pekerjaan berisiko tinggi</li>
</ul>

<h2 id="praktik-terbaik">Praktik Terbaik</h2>
<ol class="timeline-horizontal">
  <li><span class="th-num">1</span><strong>Jadwalkan rutin</strong><p>Inspeksi berkala, bukan hanya saat ada insiden atau kunjungan eksternal.</p></li>
  <li><span class="th-num">2</span><strong>Dokumentasikan temuan</strong><p>Catat setiap temuan dengan foto dan tenggat waktu tindak lanjut yang jelas.</p></li>
  <li><span class="th-num">3</span><strong>Tindak lanjuti, bukan cuma catat</strong><p>Temuan tanpa tindak lanjut hanya jadi arsip, tidak mengurangi risiko nyata.</p></li>
</ol>

<?php $faq = [
  ['q' => 'Siapa yang berwenang melakukan audit SMK3?', 'a' => 'Audit SMK3 untuk keperluan sertifikasi dilakukan oleh lembaga audit independen yang ditunjuk pemerintah, bukan tim internal perusahaan.'],
  ['q' => 'Apakah inspeksi K3 wajib dilakukan setiap hari?', 'a' => 'Tidak ada aturan baku frekuensinya, tapi praktik terbaik menyarankan inspeksi rutin (harian untuk area berisiko tinggi, mingguan/bulanan untuk area umum) agar temuan bisa ditangani sebelum jadi insiden.'],
]; ?>
