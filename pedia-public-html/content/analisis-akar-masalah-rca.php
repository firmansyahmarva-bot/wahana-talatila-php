<?php
$updated = '2026-07-18';
$faq = [
  ['q' => 'Kapan berhenti bertanya "mengapa"?', 'a' => 'Ketika jawaban sudah berada pada sesuatu yang bisa diperbaiki sistem manajemen — prosedur, desain, kompetensi, alokasi sumber daya. Jika jawaban terakhir masih "karena pekerja lalai", galinya belum selesai.'],
  ['q' => 'RCA pakai 5 Why atau fishbone?', 'a' => 'Keduanya saling melengkapi: fishbone melebar (memetakan semua faktor kandidat), 5 Why mendalam (menelusuri satu jalur sebab). Praktik yang baik: fishbone dulu untuk kasus kompleks, lalu 5 Why pada cabang yang paling berkontribusi.'],
];
?>
<p><strong>Analisis akar masalah (Root Cause Analysis/RCA) adalah teknik menelusuri penyebab dasar di balik penyebab langsung sebuah kejadian — karena memperbaiki gejala hanya menunda kecelakaan berikutnya.</strong></p>

<h2 id="tiga-lapis">Tiga Lapis Penyebab</h2>
<ol>
  <li><strong>Penyebab langsung</strong>: tindakan tidak aman (bekerja tanpa mengaitkan harness) dan kondisi tidak aman (pagar pengaman hilang).</li>
  <li><strong>Penyebab perantara</strong>: mengapa tindakan/kondisi itu ada — prosedur tidak dikenal, pengawasan longgar, alat tidak tersedia.</li>
  <li><strong>Akar masalah</strong>: kegagalan sistem manajemen — tidak ada penilaian risiko untuk tugas itu, pelatihan tidak dianggarkan, perawatan tidak terjadwal, tekanan produksi mengalahkan keselamatan.</li>
</ol>

<h2 id="lima-why">Metode 5 Why</h2>
<p>Bertanya "mengapa" berantai dari kejadian sampai akar sistemik. Contoh kasus terjatuh dari tangga:</p>
<ol>
  <li>Mengapa terjatuh? — Anak tangga patah.</li>
  <li>Mengapa patah? — Retak lama tidak diketahui.</li>
  <li>Mengapa tidak diketahui? — Tangga tidak pernah diinspeksi.</li>
  <li>Mengapa tidak diinspeksi? — Tidak ada program inspeksi alat kerja.</li>
  <li>Mengapa tidak ada? — Sistem manajemen tidak menetapkan inspeksi berkala sebagai persyaratan. ← <em>akar masalah yang bisa diperbaiki</em>.</li>
</ol>
<p>Aturan mainnya: jawaban harus faktual (bukan dugaan), dan setiap "mengapa" boleh bercabang bila penyebabnya lebih dari satu.</p>

<h2 id="fishbone">Diagram Fishbone (Ishikawa)</h2>
<p>Memetakan faktor kandidat dalam kategori tulang ikan — umumnya <em>Manusia, Mesin/Alat, Metode, Material, Lingkungan, Manajemen</em> — dengan kejadian di kepala ikan. Tim mengisi tiap kategori dari bukti <?= ilink('investigasi-kecelakaan-kerja', 'investigasi') ?>, lalu menandai faktor yang paling berkontribusi untuk digali dengan 5 Why.</p>

<h2 id="jebakan">Jebakan yang Harus Dihindari</h2>
<ul>
  <li><strong>Berhenti di manusia</strong>: "human error" adalah titik awal pertanyaan, bukan kesimpulan.</li>
  <li><strong>Satu akar tunggal</strong>: kecelakaan serius hampir selalu multikausal — kombinasi lubang-lubang pertahanan yang kebetulan segaris (model keju Swiss).</li>
  <li><strong>Rekomendasi lemah</strong>: "sosialisasi ulang" dan "lebih berhati-hati" adalah tanda RCA belum sampai akar; rekomendasi kuat mengubah desain, sistem, atau sumber daya sesuai <?= ilink('hierarki-pengendalian-risiko', 'hierarki pengendalian') ?>.</li>
</ul>

<h2 id="latihan">Melatih Kemampuan RCA</h2>
<p>Cara terbaik: praktikkan pada kasus nyata yang sudah selesai — tiga <?= ilink('studi-kasus', 'studi kasus di topik ini') ?> ditulis dengan struktur RCA persis untuk latihan itu, dan hasilnya layak dibahas di forum <?= ilink('p2k3', 'P2K3') ?>.</p>
