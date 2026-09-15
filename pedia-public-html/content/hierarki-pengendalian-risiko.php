<?php
$updated = '2026-07-18';
$faq = [
  ['q' => 'Mengapa APD berada di urutan terakhir hierarki?', 'a' => 'Karena APD tidak menghilangkan bahaya — hanya mengurangi keparahan dampak pada satu orang, dan efektivitasnya bergantung pada kedisiplinan pemakaian. Pengendalian di tingkat lebih tinggi melindungi semua orang tanpa bergantung pada perilaku.'],
  ['q' => 'Apakah pengendalian boleh dikombinasikan?', 'a' => 'Justru dianjurkan. Praktik yang baik menumpuk beberapa lapis pengendalian (defense in depth) — misalnya rekayasa ventilasi + prosedur izin kerja + APD sekaligus.'],
];
?>
<p><strong>Hierarki pengendalian risiko adalah urutan prioritas dalam mengendalikan bahaya K3: eliminasi, substitusi, rekayasa teknik, pengendalian administratif, dan terakhir alat pelindung diri (APD).</strong> Semakin tinggi tingkatnya, semakin andal perlindungannya — karena semakin tidak bergantung pada perilaku manusia.</p>

<h2 id="lima-tingkat">Lima Tingkat Pengendalian</h2>
<ol>
  <li><strong>Eliminasi</strong> — menghilangkan bahaya sepenuhnya. Contoh: pekerjaan di ketinggian dihilangkan dengan merakit struktur di permukaan tanah lalu diangkat.</li>
  <li><strong>Substitusi</strong> — mengganti dengan yang lebih aman. Contoh: pelarut berbahan benzena diganti pelarut berbasis air; proses manual berisiko diganti mekanisasi.</li>
  <li><strong>Rekayasa teknik</strong> — memisahkan orang dari bahaya lewat desain. Contoh: pagar pengaman mesin, ventilasi lokal (local exhaust), pagar tepi (guardrail) di area <?= ilink('bekerja-di-ketinggian', 'kerja ketinggian') ?>, interlock pada panel listrik.</li>
  <li><strong>Administratif</strong> — mengubah cara orang bekerja: prosedur kerja aman, izin kerja (permit to work), rotasi untuk membatasi paparan, rambu, dan <?= ilink('induksi-dan-pelatihan-k3', 'pelatihan') ?>.</li>
  <li><strong><?= ilink('alat-pelindung-diri', 'APD') ?></strong> — lapis terakhir yang melindungi individu bila bahaya residual tetap ada.</li>
</ol>

<h2 id="cara-pakai">Cara Menggunakannya dalam Penilaian Risiko</h2>
<p>Hierarki dipakai setelah identifikasi bahaya dan penilaian risiko (HIRA/HIRADC atau IBPR): untuk setiap risiko yang tidak dapat diterima, pertanyaannya selalu berurutan — <em>bisakah dihilangkan? bisakah diganti? bisakah direkayasa?</em> — sebelum jatuh ke prosedur dan APD. Melompat langsung ke APD tanpa mempertimbangkan tingkat di atasnya adalah kesalahan penilaian risiko yang paling umum.</p>

<h2 id="contoh-terapan">Contoh Terapan: Bahaya Debu Gerinda</h2>
<ol>
  <li>Eliminasi: ubah desain sehingga penggerindaan tidak diperlukan.</li>
  <li>Substitusi: gunakan metode basah yang tidak menerbangkan debu.</li>
  <li>Rekayasa: pasang penghisap debu lokal pada mesin.</li>
  <li>Administratif: batasi durasi paparan, area khusus gerinda, pengukuran rutin terhadap <?= ilink('nilai-ambang-batas', 'NAB') ?>.</li>
  <li>APD: respirator sesuai jenis debu.</li>
</ol>

<h2 id="kaitan-regulasi">Kaitan dengan Regulasi</h2>
<p>Prinsip hierarki ini tertanam dalam <?= ilink('smk3-pp-50-2012', 'PP 50/2012') ?> (perencanaan K3 wajib memuat pengendalian berdasarkan urutan prioritas) dan menjadi tulang punggung standar internasional sistem manajemen K3. Hasil <?= ilink('investigasi-kecelakaan-kerja', 'investigasi kecelakaan') ?> yang baik selalu berujung pada rekomendasi di tingkat hierarki setinggi mungkin — bukan sekadar "pekerja agar lebih berhati-hati".</p>
