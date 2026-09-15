<?php
$updated = '2026-07-18';
$faq = [
  ['q' => 'Apa dasar hukum pemeriksaan kesehatan tenaga kerja?', 'a' => 'Pasal 8 UU No. 1 Tahun 1970 dan Permenakertrans No. 2 Tahun 1980 tentang Pemeriksaan Kesehatan Tenaga Kerja dalam Penyelenggaraan Keselamatan Kerja.'],
  ['q' => 'Seberapa sering pemeriksaan berkala dilakukan?', 'a' => 'Sekurang-kurangnya satu tahun sekali, kecuali ditentukan lain oleh direktur berwenang untuk pekerjaan tertentu.'],
  ['q' => 'Siapa yang menanggung biayanya?', 'a' => 'Pengusaha. Pemeriksaan kesehatan kerja adalah kewajiban perusahaan dan tidak boleh dibebankan kepada pekerja.'],
];
?>
<p><strong>Pemeriksaan kesehatan tenaga kerja adalah kewajiban pengurus menurut Pasal 8 UU 1/1970: memastikan pekerja sehat dan cocok untuk pekerjaannya, serta mendeteksi dini gangguan kesehatan akibat kerja.</strong> Tata caranya diatur Permenakertrans No. 2 Tahun 1980.</p>

<h2 id="tiga-jenis">Tiga Jenis Pemeriksaan</h2>
<ol>
  <li><strong>Pemeriksaan awal (sebelum kerja)</strong> — menilai kondisi kesehatan calon pekerja dan kecocokannya dengan pekerjaan yang akan dilakukan; menjadi data dasar (baseline) pembanding tahun-tahun berikutnya.</li>
  <li><strong>Pemeriksaan berkala</strong> — sekurang-kurangnya setahun sekali, untuk mempertahankan derajat kesehatan dan menilai kemungkinan pengaruh pekerjaan sedini mungkin.</li>
  <li><strong>Pemeriksaan khusus</strong> — untuk pekerja tertentu: yang mengalami kecelakaan atau penyakit, yang berusia lanjut atau cacat, serta yang terpajan bahaya spesifik — misalnya audiometri untuk area bising di atas <?= ilink('nilai-ambang-batas', 'NAB') ?>, spirometri untuk area berdebu, pemeriksaan biomonitoring untuk pajanan kimia.</li>
</ol>

<h2 id="isi">Apa yang Diperiksa</h2>
<p>Sesuai risiko pekerjaan: pemeriksaan fisik lengkap, laboratorium dasar, rontgen dada bila relevan, dan uji khusus mengikuti pajanan (pendengaran, fungsi paru, penglihatan, EKG untuk kerja berat). Rancangan paket pemeriksaan yang baik selalu diturunkan dari peta bahaya perusahaan — hasil pengukuran <?= ilink('permenaker-5-2018-lingkungan-kerja', 'lingkungan kerja') ?> menentukan organ sasaran mana yang dipantau.</p>

<h2 id="tindak-lanjut">Tindak Lanjut Hasil</h2>
<ul>
  <li><strong>Fit / fit dengan catatan / unfit sementara / unfit</strong> — kesimpulan kecocokan kerja yang ditindaklanjuti penempatan atau penyesuaian tugas.</li>
  <li>Temuan yang mengarah ke <?= ilink('penyakit-akibat-kerja', 'PAK') ?> ditindaklanjuti diagnosis okupasi dan pelaporan.</li>
  <li>Tren hasil kelompok (misalnya penurunan pendengaran massal di satu unit) adalah alarm untuk mengaudit pengendalian — bukan sekadar arsip.</li>
</ul>

<h2 id="dokumentasi">Dokumentasi dan Kerahasiaan</h2>
<p>Hasil pemeriksaan disimpan sebagai rekam medis rahasia; perusahaan hanya menerima kesimpulan kecocokan kerja. Statistik agregatnya dilaporkan ke <?= ilink('p2k3', 'P2K3') ?> dan menjadi bukti pemenuhan kriteria audit <?= ilink('smk3-pp-50-2012', 'SMK3') ?>.</p>
