<?php
$updated = '2026-07-18';
$faq = [
  ['q' => 'Apa itu baku mutu air limbah?', 'a' => 'Ukuran batas kadar pencemar yang ditenggang ada dalam air limbah yang akan dibuang — parameter seperti BOD, COD, TSS, pH, minyak-lemak, logam berat — ditetapkan per jenis industri dan berlaku di titik penaatan.'],
  ['q' => 'Apakah membuang air limbah butuh izin?', 'a' => 'Ya. Pembuangan air limbah ke badan air atau pemanfaatannya ke tanah memerlukan Persetujuan Teknis dan SLO (Surat Kelayakan Operasional) yang terintegrasi dalam perizinan berusaha, sesuai PP 22/2021.'],
  ['q' => 'Apa parameter yang paling sering gagal?', 'a' => 'BOD/COD (beban organik), TSS (padatan tersuspensi), dan pH — biasanya karena IPAL kelebihan beban, mikroba mati, atau operasional tidak konsisten.'],
];
?>
<p><strong>Air limbah industri wajib diolah hingga memenuhi baku mutu sebelum dibuang ke lingkungan — dan sejak PP 22/2021, kelayakan sistem pengolahannya dibuktikan lewat Persetujuan Teknis dan Surat Kelayakan Operasional (SLO).</strong></p>

<h2 id="sumber-jenis">Sumber dan Jenis Air Limbah</h2>
<ul>
  <li><strong>Air limbah proses</strong>: dari produksi — kandungannya mengikuti bahan baku dan proses (organik, logam, minyak).</li>
  <li><strong>Air limbah utilitas</strong>: blowdown boiler/cooling tower, regenerasi resin.</li>
  <li><strong>Air limbah domestik</strong>: kantin, toilet, asrama.</li>
  <li><strong>Air larian terkontaminasi</strong>: hujan yang melewati area kotor atau tumpahan.</li>
</ul>

<h2 id="ipal">Tahapan Pengolahan di IPAL</h2>
<ol>
  <li><strong>Pra-pengolahan</strong>: penyaringan, pemisah minyak-lemak, ekualisasi debit dan kualitas.</li>
  <li><strong>Primer (fisika-kimia)</strong>: netralisasi pH, koagulasi-flokulasi, sedimentasi — menurunkan TSS dan logam.</li>
  <li><strong>Sekunder (biologis)</strong>: lumpur aktif, biofilter, atau anaerob — menurunkan BOD/COD; jantung IPAL yang paling sensitif terhadap kejutan beban.</li>
  <li><strong>Tersier</strong> (bila perlu): filtrasi, adsorpsi karbon, disinfeksi untuk parameter khusus.</li>
  <li><strong>Pengelolaan lumpur</strong>: sludge IPAL tertentu berstatus <?= ilink('limbah-b3', 'limbah B3') ?> dan mengikuti rantai kewajibannya.</li>
</ol>

<h2 id="kewajiban">Kewajiban Operasional</h2>
<ul>
  <li>Memenuhi <strong>baku mutu</strong> di titik penaatan; memasang alat ukur debit dan — bagi industri tertentu — pemantauan kualitas kontinu daring (SPARING).</li>
  <li><strong>Pemantauan berkala</strong> oleh laboratorium terakreditasi dan pelaporan rutin ke instansi lingkungan.</li>
  <li>Larangan pengenceran sebagai cara memenuhi baku mutu, dan larangan bypass IPAL — dua pelanggaran klasik yang berujung sanksi dan peringkat merah/hitam <?= ilink('proper-klhk', 'PROPER') ?>.</li>
</ul>

<h2 id="k3-ipal">Sisi K3 dari IPAL</h2>
<p>Bak dan saluran IPAL adalah <?= ilink('ruang-terbatas', 'ruang terbatas') ?> dengan bahaya H<sub>2</sub>S dan kekurangan oksigen; bahan kimia pengolah (asam, kaustik, klorin) menuntut <?= ilink('alat-pelindung-diri', 'APD') ?> dan penanganan yang benar. Operator IPAL yang terlatih melindungi lingkungan sekaligus dirinya sendiri.</p>
