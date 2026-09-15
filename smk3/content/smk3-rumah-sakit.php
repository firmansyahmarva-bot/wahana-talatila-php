<?php
/** #30 — SMK3 untuk Rumah Sakit dan Fasilitas Kesehatan. */
$updated = '2026-07-17';
$faq = [
  ['q' => 'Apa itu K3RS dan bedanya dengan SMK3?', 'a' => 'K3RS (Keselamatan dan Kesehatan Kerja Rumah Sakit) diatur Permenkes No. 66 Tahun 2016 dan menjadi bagian dari standar perumahsakitan serta akreditasi. SMK3 (PP 50/2012) adalah kewajiban ketenagakerjaan lintas sektor. Prinsipnya sejalan — rumah sakit besar umumnya menyentuh keduanya.'],
  ['q' => 'Apakah rumah sakit wajib SMK3?', 'a' => 'Rumah sakit dengan 100 pekerja atau lebih memenuhi kriteria kewajiban — dan mayoritas rumah sakit menengah-besar melampaui angka itu bila menghitung seluruh tenaga: medis, penunjang, administrasi, dan pekerja alih daya.'],
  ['q' => 'Siapa yang sebaiknya memimpin integrasi SMK3 dan K3RS?', 'a' => 'Unit/komite K3RS yang sudah ada adalah motor alaminya, diperkuat personel dengan kompetensi Ahli K3 dan dukungan direksi. Kuncinya mandat: satu tim, satu sistem, dua kerangka kepatuhan.'],
];
?>
<p>Rumah sakit adalah tempat kerja yang unik: orang datang untuk disembuhkan, sementara para penyembuhnya menghadapi katalog bahaya terlengkap dari semua sektor — infeksi, bahan kimia sitotoksik, radiasi, gas medis, beban angkat pasien, jam kerja panjang, hingga kekerasan dari pasien. Artikel ini membahas penerapan SMK3 di fasilitas kesehatan: titik temunya dengan K3RS dan akreditasi, peta bahaya khas rumah sakit, dan strategi integrasi agar tim tidak mengerjakan tiga dokumentasi untuk satu pekerjaan.</p>

<h2 id="k3rs">SMK3, K3RS, dan Akreditasi: Tiga Kerangka Satu Tujuan</h2>
<div class="table-scroll"><table>
  <tr><th>Kerangka</th><th>Dasar</th><th>Fokus</th></tr>
  <tr><td>SMK3</td><td>PP 50/2012 (Kemnaker)</td><td>Sistem manajemen K3 perusahaan — 166 kriteria, audit, sertifikat</td></tr>
  <tr><td>K3RS</td><td>Permenkes 66/2016</td><td>Standar K3 khusus rumah sakit: dari manajemen risiko sampai pengelolaan B3, prasarana, dan kesiapan bencana</td></tr>
  <tr><td>Akreditasi RS</td><td>Standar akreditasi yang berlaku</td><td>Mutu &amp; keselamatan menyeluruh — memuat elemen manajemen fasilitas dan keselamatan yang beririsan dengan K3</td></tr>
</table></div>
<p>Ketiganya menuntut hal-hal yang sama pada intinya: identifikasi risiko, pengendalian, kesiapan darurat, kompetensi, dan tinjauan. Rumah sakit yang memperlakukannya sebagai tiga proyek terpisah akan menguras komite K3RS-nya; yang cerdas membangun <strong>satu sistem dengan matriks pemetaan tiga arah</strong> — pola integrasi yang sama seperti sektor lain di <?= ilink('industri', 'seri SMK3 per industri') ?>.</p>

<h2 id="peta-bahaya">Peta Bahaya Khas Fasilitas Kesehatan</h2>
<ul>
  <li><strong>Biologis</strong> — pajanan patogen lewat jarum suntik (needlestick), kontak cairan tubuh, penyakit menular udara. Pengendalian: kewaspadaan standar, safety box, alur pasca-pajanan yang semua staf tahu, imunisasi pekerja berisiko.</li>
  <li><strong>Kimia</strong> — desinfektan, sitostatika, gas anestesi, reagen laboratorium: LDK, ventilasi, APD sesuai, penanganan tumpahan — beririsan dengan program <?= ilink('industrial-hygiene', 'higiene industri') ?>.</li>
  <li><strong>Radiasi</strong> — radiologi dan radioterapi: proteksi radiasi, pemantauan dosis personal, izin dan kompetensi sesuai ketentuan badan pengawas.</li>
  <li><strong>Ergonomi</strong> — mengangkat dan memindahkan pasien adalah penyumbang cedera punggung terbesar perawat: alat bantu transfer, teknik, dan kecukupan personel.</li>
  <li><strong>Psikososial</strong> — shift panjang, beban emosional, dan kekerasan dari pasien/keluarga: manajemen kelelahan, prosedur penanganan kekerasan, dukungan pekerja.</li>
  <li><strong>Kebakaran &amp; listrik</strong> — okupansi berisiko tinggi: pasien tidak bisa mengevakuasi diri. Proteksi, jalur evakuasi, dan latihan yang memperhitungkan evakuasi pasien — kerangka di <?= ilink('fire-safety-management', 'fire safety management') ?>.</li>
  <li><strong>Gas medis &amp; utilitas</strong> — oksigen (pengayaan O2 = risiko kebakaran), gas bertekanan, genset, boiler: riksa-uji dan pemeliharaan terdokumentasi.</li>
</ul>

<h2 id="pekerja-lengkap">Jangan Lupa: "Pekerja" Bukan Hanya Tenaga Medis</h2>
<p>Lingkup SMK3 mencakup semua yang bekerja di tempat kerja Anda: teknisi pemeliharaan (pekerjaan listrik, ketinggian, <?= ilink('confined-space', 'ruang terbatas') ?> seperti tangki dan shaft), petugas laundry dan gizi (panas, kimia, ergonomi), cleaning service dan pengelola limbah (benda tajam, infeksius), petugas keamanan, hingga pekerja alih daya. Kecelakaan pada mereka adalah kecelakaan di tempat kerja Anda — dan auditor akan mewawancarai mereka juga.</p>

<h2 id="strategi">Strategi Integrasi yang Realistis</h2>
<ol class="steps">
  <li><strong>Jadikan komite/unit K3RS sebagai motor tunggal</strong> — perkuat dengan kompetensi Ahli K3; pastikan struktur <?= ilink('cara-membentuk-p2k3', 'P2K3') ?> terpenuhi dan disahkan (bisa selaras dengan komite yang ada).</li>
  <li><strong>Satu register risiko.</strong> HIRADC rumah sakit yang mencakup area klinis dan non-klinis — jangan pisahkan "risiko akreditasi" dan "risiko SMK3"; metodenya di <?= ilink('cara-menyusun-hiradc', 'cara menyusun HIRADC') ?>.</li>
  <li><strong>Petakan tiga arah.</strong> Matriks kriteria SMK3 ↔ standar K3RS ↔ elemen akreditasi terkait, dengan penanda dokumen yang melayani ketiganya.</li>
  <li><strong>Manfaatkan ritme akreditasi.</strong> RS terbiasa self-assessment dan telusur — format yang sama persis dengan audit SMK3. Latihan telusur akreditasi adalah simulasi audit gratis.</li>
  <li><strong>Lengkapi delta ketenagakerjaan</strong> — laporan P2K3 triwulanan, riksa-uji peralatan dalam rezim Kemnaker, pemeriksaan kesehatan tenaga kerja (termasuk non-medis) — lalu menuju <?= ilink('jenis-audit-smk3', 'audit sertifikasi') ?>.</li>
</ol>

<h2 id="ringkasan">Ringkasan</h2>
<ul>
  <li>Rumah sakit menyentuh tiga kerangka — SMK3, K3RS (Permenkes 66/2016), akreditasi — yang intinya sama: satu sistem, matriks pemetaan tiga arah.</li>
  <li>Peta bahayanya terlengkap dari semua sektor: biologis, kimia, radiasi, ergonomi, psikososial, kebakaran, gas medis.</li>
  <li>Lingkup mencakup seluruh pekerja — teknisi, laundry, gizi, cleaning, keamanan — bukan hanya tenaga medis.</li>
  <li>Budaya telusur akreditasi adalah modal besar: rumah sakit yang siap akreditasi biasanya separuh jalan menuju siap audit SMK3.</li>
</ul>
