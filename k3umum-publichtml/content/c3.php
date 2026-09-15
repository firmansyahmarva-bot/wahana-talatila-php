<?php
$updated = '2026-07-20';
?>
<p><strong>JSA (Job Safety Analysis)</strong> — kadang disebut JHA (Job Hazard Analysis) — adalah teknik memecah satu pekerjaan menjadi langkah-langkah kecil, lalu mengidentifikasi bahaya di setiap langkah tersebut secara spesifik. Berbeda dari <?= ilink('c2', 'HIRADC') ?> yang memetakan bahaya di level proses atau area kerja, JSA fokus ke satu jenis pekerjaan secara mendetail.</p>

<h2 id="kapan-pakai-jsa">Kapan JSA Digunakan?</h2>
<div class="icon-grid">
  <div class="icon-grid-item"><span class="ig-icon"><?= icon('warning') ?></span><div><strong>Pekerjaan berisiko tinggi</strong><p>Bekerja di ketinggian, ruang terbatas, pekerjaan panas (hot work), atau melibatkan bahan berbahaya.</p></div></div>
  <div class="icon-grid-item"><span class="ig-icon"><?= icon('edit') ?></span><div><strong>Pekerjaan baru atau jarang dilakukan</strong><p>Prosedur yang belum standar, atau baru pertama kali dilakukan tim tersebut.</p></div></div>
  <div class="icon-grid-item"><span class="ig-icon"><?= icon('clipboard-check') ?></span><div><strong>Setelah insiden atau nyaris celaka</strong><p>Meninjau ulang langkah kerja untuk mencegah insiden serupa terulang.</p></div></div>
</div>

<h2 id="cara-membuat">Cara Membuat JSA</h2>
<ol class="timeline-horizontal">
  <li><span class="th-num">1</span><strong>Uraikan langkah kerja</strong><p>Pecah pekerjaan jadi tahapan berurutan, sekecil mungkin.</p></li>
  <li><span class="th-num">2</span><strong>Identifikasi bahaya per langkah</strong><p>Tanyakan: apa yang bisa salah di setiap tahapan ini?</p></li>
  <li><span class="th-num">3</span><strong>Tentukan pengendalian</strong><p>Tindakan pencegahan spesifik untuk tiap bahaya yang teridentifikasi.</p></li>
  <li><span class="th-num">4</span><strong>Komunikasikan ke pekerja</strong><p>JSA yang tidak dikomunikasikan ke pelaksana lapangan tidak ada gunanya.</p></li>
</ol>

<h2 id="contoh-tabel">Contoh Ringkas Tabel JSA</h2>
<div class="table-scroll">
  <table>
    <thead><tr><th>Langkah Kerja</th><th>Potensi Bahaya</th><th>Pengendalian</th></tr></thead>
    <tbody>
      <tr><td>Menaiki tangga menuju platform kerja</td><td>Terjatuh dari ketinggian</td><td>Gunakan full body harness, pastikan tangga terkunci</td></tr>
      <tr><td>Mengoperasikan alat pemotong</td><td>Terpotong, terkena serpihan</td><td>Gunakan sarung tangan dan kacamata pelindung sesuai standar <?= ilink('c4', 'APD') ?></td></tr>
    </tbody>
  </table>
</div>

<?php $faq = [
  ['q' => 'Apakah JSA wajib dibuat untuk semua pekerjaan?', 'a' => 'Idealnya untuk pekerjaan berisiko tinggi, baru, atau jarang dilakukan. Pekerjaan rutin berisiko rendah biasanya cukup mengikuti prosedur standar yang sudah ada.'],
  ['q' => 'Siapa yang membuat JSA?', 'a' => 'Umumnya dibuat bersama antara pengawas kerja, pekerja yang akan melaksanakan tugas, dan petugas K3 — bukan dibuat sepihak tanpa melibatkan pelaksana lapangan.'],
]; ?>
