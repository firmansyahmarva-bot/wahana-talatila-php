<?php
$updated = '2026-07-18';
$faq = [
  ['q' => 'Apa saja jenis limbah industri?', 'a' => 'Berdasarkan wujud: padat, cair, dan gas/emisi. Berdasarkan sifat: limbah B3 dan non-B3. Tiap kombinasi punya jalur pengelolaan dan dasar hukum sendiri.'],
  ['q' => 'Apa itu hierarki pengelolaan limbah?', 'a' => 'Urutan prioritas: cegah/kurangi di sumber, guna ulang, daur ulang, pulihkan (termasuk energi), olah, dan terakhir timbun. Semakin ke atas semakin murah dan aman.'],
];
?>
<p><strong>Pengelolaan limbah industri adalah kewajiban setiap kegiatan usaha: memastikan limbah padat, cair, gas, maupun B3 tidak mencemari lingkungan dan tidak membahayakan manusia — dengan urutan prioritas dari pencegahan di sumber sampai penimbunan akhir.</strong></p>

<h2 id="jenis">Jenis Limbah Industri</h2>
<ul>
  <li><strong>Padat non-B3</strong>: sisa produksi, kemasan, skrap — dikelola melalui pengurangan, pemilahan, daur ulang, dan kerja sama pengelola sampah.</li>
  <li><strong>Cair</strong>: air limbah proses, pendingin, domestik — wajib memenuhi baku mutu sebelum dibuang; dibahas tuntas di <?= ilink('pengelolaan-air-limbah', 'entri air limbah dan IPAL') ?>.</li>
  <li><strong>Gas/emisi</strong>: cerobong dan emisi fugitive — diatur baku mutu emisi; sisi dalam-pabriknya dibahas di <?= ilink('pencemaran-udara-tempat-kerja', 'entri pencemaran udara tempat kerja') ?>.</li>
  <li><strong>B3</strong>: jalur paling ketat — lihat <?= ilink('limbah-b3', 'entri limbah B3') ?>.</li>
</ul>

<h2 id="hierarki">Hierarki Pengelolaan</h2>
<ol>
  <li><strong>Pencegahan dan pengurangan di sumber</strong> — efisiensi bahan, substitusi, perawatan proses; selalu yang termurah.</li>
  <li><strong>Guna ulang (reuse)</strong> — kemasan kembali, air proses disirkulasi.</li>
  <li><strong>Daur ulang (recycle)</strong> — skrap logam, kertas, plastik terpilah.</li>
  <li><strong>Pemulihan (recovery)</strong> — energi atau material dari limbah.</li>
  <li><strong>Pengolahan</strong> — IPAL, insinerasi berizin, stabilisasi.</li>
  <li><strong>Penimbunan</strong> — pilihan terakhir, di fasilitas yang memenuhi syarat.</li>
</ol>
<p>Logikanya identik dengan <?= ilink('hierarki-pengendalian-risiko', 'hierarki pengendalian risiko K3') ?>: kendalikan di sumber sebelum mengandalkan penanganan di ujung (end-of-pipe).</p>

<h2 id="kewajiban">Kerangka Kewajiban</h2>
<p>Kewajiban pengelolaan limbah tercantum dalam dokumen lingkungan perusahaan (<?= ilink('amdal-ukl-upl', 'AMDAL/UKL-UPL') ?>) dan perizinan berusahanya: jenis limbah yang boleh dihasilkan, cara mengelolanya, baku mutu buangan, dan kewajiban pemantauan serta pelaporan berkala. Ketaatan terhadap semua itu adalah inti penilaian <?= ilink('proper-klhk', 'PROPER') ?>.</p>

<h2 id="praktik">Praktik yang Membuat Program Berjalan</h2>
<p>Pemilahan di sumber dengan wadah berlabel jelas, neraca limbah bulanan, penunjukan penanggung jawab, kontrak hanya dengan pengelola berizin (periksa izinnya, bukan brosurnya), dan audit internal rutin — kebiasaan yang sama yang membuat <?= ilink('sistem-manajemen-k3', 'SMK3') ?> hidup.</p>
