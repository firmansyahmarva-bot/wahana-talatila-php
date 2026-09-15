<?php
/** HUB 3 — SMK3 per Sektor Industri. */
$updated = '2026-07-17';
$faq = [
  ['q' => 'Apakah kriteria audit SMK3 berbeda per industri?', 'a' => 'Kriterianya sama — 166 kriteria berlaku untuk semua sektor. Yang berbeda adalah bukti penerapannya: pengendalian risiko yang relevan, program operasional yang dibutuhkan, dan titik berat pemeriksaan auditor menyesuaikan profil bahaya masing-masing industri.'],
  ['q' => 'Perusahaan kami punya beberapa lokasi dengan kegiatan berbeda. Bagaimana penerapannya?', 'a' => 'Sistemnya satu, penerapannya menyesuaikan tiap lokasi: HIRADC, program, dan pengendalian dibuat per site sesuai risikonya, sementara kebijakan, prosedur inti, dan struktur tanggung jawab tetap seragam di level perusahaan.'],
  ['q' => 'Sektor kami sudah punya sistem K3 khusus (SMKP/SMKK/K3RS). Apakah masih perlu SMK3?', 'a' => 'Sering kali ya, karena dasar hukum dan penggunaannya berbeda — misalnya SMK3 diminta dalam tender atau CSMS sementara sistem sektoral diwajibkan regulator teknis. Kabar baiknya, sebagian besar persyaratannya beririsan sehingga bisa dipenuhi dengan satu sistem terintegrasi.'],
];
?>
<p>Kriteria audit SMK3 memang satu untuk semua — tetapi tidak ada dua industri yang menerapkannya dengan cara yang sama. Bahaya dominan konstruksi (jatuh dari ketinggian, alat berat) berbeda dengan rumah sakit (infeksi, radiasi, kekerasan kerja), dan berbeda lagi dengan migas (process safety, kebakaran-ledakan). Panduan ini adalah pintu masuk ke seri artikel penerapan SMK3 per sektor: apa yang khas di tiap industri, regulasi sektoral yang berdampingan dengan PP 50/2012, dan di mana biasanya letak kesulitannya.</p>

<h2 id="prinsip">Prinsip yang Sama, Titik Berat yang Berbeda</h2>
<p>Semua sektor tetap melalui siklus yang sama — kebijakan, perencanaan berbasis <?= ilink('hiradc-dalam-smk3', 'HIRADC') ?>, pelaksanaan, pemantauan, peninjauan — dan diaudit dengan <?= ilink('166-kriteria-smk3', 'kriteria yang sama') ?>. Perbedaannya muncul di tiga hal:</p>
<ul>
  <li><strong>Profil risiko dominan</strong> — menentukan program operasional mana yang wajib kuat: izin kerja, proteksi kebakaran, higiene industri, keselamatan alat berat, dan seterusnya.</li>
  <li><strong>Regulasi sektoral pendamping</strong> — beberapa sektor punya sistem manajemen K3 khusus yang berjalan berdampingan dengan SMK3.</li>
  <li><strong>Tekanan pasar</strong> — di sektor tertentu, sertifikat SMK3 diminta bukan oleh pengawas melainkan oleh klien (tender, CSMS, akreditasi).</li>
</ul>

<h2 id="peta-sektor">Peta Cepat: 8 Sektor dalam Seri Ini</h2>
<div class="table-scroll"><table>
  <tr><th>Sektor</th><th>Risiko dominan</th><th>Regulasi/kerangka pendamping</th><th>Pendorong utama sertifikasi</th></tr>
  <tr><td><?= ilink('smk3-konstruksi', 'Konstruksi') ?></td><td>Jatuh dari ketinggian, alat berat, tertimpa</td><td>SMKK (Permen PUPR 10/2021)</td><td>Tender pemerintah/LPSE</td></tr>
  <tr><td><?= ilink('smk3-manufaktur', 'Manufaktur') ?></td><td>Mesin, bahan kimia, kebisingan, ergonomi</td><td>Regulasi teknis Kemnaker per objek K3</td><td>Kepatuhan + audit pelanggan</td></tr>
  <tr><td><?= ilink('smk3-pertambangan', 'Pertambangan') ?></td><td>Alat berat, peledakan, kestabilan lereng</td><td>SMKP Minerba (Permen ESDM 26/2018)</td><td>Kewajiban ganda SMKP + SMK3</td></tr>
  <tr><td><?= ilink('smk3-migas', 'Minyak &amp; Gas') ?></td><td>Kebakaran/ledakan, process safety, H2S</td><td>CSMS klien KKKS, standar internasional</td><td>Prakualifikasi CSMS</td></tr>
  <tr><td><?= ilink('smk3-logistik', 'Logistik') ?></td><td>Forklift, penataan gudang, kelelahan pengemudi</td><td>Regulasi transportasi &amp; angkat-angkut</td><td>Audit prinsipal &amp; efisiensi klaim</td></tr>
  <tr><td><?= ilink('smk3-rumah-sakit', 'Rumah Sakit') ?></td><td>Biologis, kimia, radiasi, kekerasan kerja</td><td>K3RS (Permenkes 66/2016), akreditasi</td><td>Akreditasi &amp; kepatuhan</td></tr>
  <tr><td><?= ilink('smk3-epc', 'EPC') ?></td><td>Gabungan konstruksi + proses + multi-site</td><td>Standar klien lintas sektor</td><td>Kontrak proyek besar</td></tr>
  <tr><td><?= ilink('smk3-umkm', 'UMKM') ?></td><td>Bervariasi; sering tanpa sistem sama sekali</td><td>—</td><td>Masuk rantai pasok perusahaan besar</td></tr>
</table></div>

<h2 id="sistem-sektoral">Ketika Satu Perusahaan Menghadapi Dua Sistem</h2>
<p>Tiga sektor menghadapi "sistem kembar" — dan pertanyaan yang selalu sama: <em>apakah harus membangun dua sistem terpisah?</em> Jawabannya tidak, bila dikerjakan dengan cerdas:</p>
<h3>Konstruksi: SMK3 + SMKK</h3>
<p>SMKK (Sistem Manajemen Keselamatan Konstruksi) diwajibkan Kementerian PUPR untuk pekerjaan konstruksi, dengan instrumen khas seperti RKK (Rencana Keselamatan Konstruksi). SMK3 tetap relevan sebagai sistem korporat dan syarat tender. Strategi umum: SMK3 sebagai sistem induk perusahaan, RKK/SMKK sebagai penerapan per proyek yang menarik dari sistem induk.</p>
<h3>Pertambangan: SMK3 + SMKP</h3>
<p>SMKP Minerba diwajibkan Kementerian ESDM bagi pemegang izin pertambangan, diaudit dengan mekanismenya sendiri. Elemen-elemennya sangat beririsan dengan SMK3 — kebijakan, manajemen risiko, pengendalian operasional — sehingga satu set dokumen bisa dipetakan ke dua sistem dengan matriks korelasi.</p>
<h3>Rumah Sakit: SMK3 + K3RS</h3>
<p>Permenkes 66/2016 mengatur K3RS yang menjadi bagian penilaian akreditasi. Prinsipnya sejalan dengan PP 50/2012; integrasi yang rapi menghindarkan tim K3RS dari dokumentasi ganda.</p>

<h2 id="pola-kesulitan">Pola Kesulitan yang Berulang Lintas Sektor</h2>
<ul>
  <li><strong>Subkontraktor dan pekerja tidak tetap.</strong> Konstruksi, EPC, dan logistik bergantung pada tenaga kerja yang datang-pergi. Sistem harus menjangkau mereka: induksi, pengawasan, dan bukti kompetensi — auditor pasti memeriksa ini.</li>
  <li><strong>Lokasi tersebar.</strong> Penerapan bagus di kantor pusat tetapi kosong di site kedua adalah temuan klasik. Audit mencuplik lokasi, bukan hanya kantor pusat.</li>
  <li><strong>Program teknis yang lemah.</strong> Sistem manajemen rapi tetapi izin kerja, proteksi kebakaran, atau pengukuran lingkungan kerja tidak jalan — pemeriksaan lapangan akan membongkarnya. Seri <?= ilink('k3-pendukung', 'topik K3 pendukung') ?> membahas program-program ini satu per satu.</li>
</ul>

<h2 id="cara-pakai">Cara Memakai Seri Ini</h2>
<p>Baca artikel sektor Anda untuk memahami titik berat penerapan dan regulasi pendampingnya, lalu kembali ke <?= ilink('implementasi', 'panduan implementasi step-by-step') ?> untuk urutan pengerjaannya. Jika perusahaan Anda lintas sektor (misalnya EPC yang masuk area migas), baca kedua artikel yang relevan — persyaratan klien biasanya mengikuti sektor lokasi kerja, bukan sektor badan usaha Anda.</p>
<p>Seri ini dimulai dari sektor dengan tekanan sertifikasi paling tinggi: <?= ilink('smk3-konstruksi', 'SMK3 untuk perusahaan konstruksi') ?>.</p>

<h2 id="ringkasan">Ringkasan</h2>
<ul>
  <li>Kriteria audit SMK3 sama untuk semua sektor; yang berbeda adalah profil risiko, regulasi pendamping, dan tekanan pasarnya.</li>
  <li>Konstruksi, tambang, dan rumah sakit menghadapi sistem sektoral kembar — integrasikan, jangan bangun dua sistem.</li>
  <li>Kesulitan lintas sektor yang paling umum: subkontraktor, multi-lokasi, dan program teknis yang lemah di lapangan.</li>
</ul>
