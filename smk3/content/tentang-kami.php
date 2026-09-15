<?php
/** #50 — Tentang Kami. Editorial link: wt_perusahaan. Closes loop → Home. */
$updated = '2026-07-17';
$faq = [
  ['q' => 'Siapa yang mengelola situs ini?', 'a' => 'Situs ini dikelola oleh tim Wahana Totalita Konsultan — lembaga pelatihan dan konsultasi K3 yang berbasis di Yogyakarta dan melayani perusahaan di seluruh Indonesia.'],
  ['q' => 'Apakah konten di situs ini bisa dijadikan dasar keputusan hukum?', 'a' => 'Konten kami bersifat edukasi praktis dan ditulis dengan kehati-hatian, tetapi bukan pengganti teks resmi peraturan maupun nasihat hukum. Untuk kepastian hukum, rujuk selalu dokumen peraturan resmi dan konsultasikan konteks spesifik perusahaan Anda.'],
  ['q' => 'Bagaimana cara meminta bantuan untuk perusahaan kami?', 'a' => 'Hubungi kami via WhatsApp atau formulir di halaman kontak. Sesi diskusi awal gratis — ceritakan kondisi dan target Anda, kami jawab dengan langkah konkret.'],
];
?>
<p>Situs ini lahir dari satu pengamatan sederhana: informasi SMK3 di internet berserakan — sepotong di sana-sini, sering saling bertentangan, dan jarang ditulis oleh orang yang pernah duduk di kedua sisi meja audit. Kami membangun panduan ini untuk mengubah itu: 50 artikel yang tersusun berurutan, ditulis dari pengalaman lapangan, dan diperbarui mengikuti perkembangan regulasi. Halaman ini memperkenalkan siapa kami, cara kami bekerja, dan prinsip yang kami pegang.</p>

<h2 id="siapa-kami">Siapa Kami</h2>
<p>Situs <strong>SMK3 Indonesia</strong> (smk3.wahanatotalita.com) dikelola oleh tim <strong>Wahana Totalita Konsultan</strong>, lembaga pelatihan dan konsultasi K3 yang berbasis di Yogyakarta dan melayani klien lintas industri di seluruh Indonesia — dari pelatihan sertifikasi personel hingga pendampingan sistem manajemen. Profil lengkap perusahaan, layanan, dan legalitas kami dapat Anda lihat di <?= ext_link('wt_perusahaan', 'halaman resmi Wahana Totalita Konsultan') ?>.</p>
<p>Tim penyusun konten situs ini menggabungkan tiga sudut pandang yang saling melengkapi: praktisi yang mendampingi implementasi di lapangan, personel dengan latar kompetensi K3 resmi (Ahli K3), dan pengalaman menghadapi audit dari sisi perusahaan. Kombinasi itulah yang membentuk gaya panduan kami: berbasis peraturan, tetapi selalu berpijak pada apa yang benar-benar terjadi di pabrik, proyek, dan fasilitas kerja.</p>

<h2 id="cara-kerja">Cara Kami Menyusun Konten</h2>
<ol>
  <li><strong>Berangkat dari peraturan</strong> — PP 50/2012 dan aturan teknis terkait adalah tulang punggung setiap artikel; kami menjelaskan dan menafsirkan secara praktis, tidak menyalin pasal.</li>
  <li><strong>Diuji pengalaman lapangan</strong> — pola temuan audit, kesalahan implementasi yang berulang, dan praktik yang terbukti bekerja: semuanya diambil dari pengamatan nyata, dengan detail yang digeneralisasi demi kerahasiaan klien.</li>
  <li><strong>Jujur tentang ketidakpastian</strong> — bila suatu praktik berbeda antarwilayah atau kisaran biaya bergantung banyak faktor, kami katakan demikian — bukan memberi angka pasti yang menyesatkan.</li>
  <li><strong>Diperbarui</strong> — regulasi bergerak; artikel kami menyertakan tanggal pembaruan dan ditinjau berkala, dengan <?= ilink('blog', 'halaman update regulasi') ?> sebagai pos pemantauannya.</li>
</ol>

<h2 id="prinsip">Prinsip Layanan yang Kami Pegang</h2>
<ul>
  <li><strong>Penilaian jujur sebelum janji.</strong> Kami tidak menjanjikan kelulusan — kami menjanjikan proses yang benar: gap analysis apa adanya, target tingkat yang realistis, dan kerja keras yang terukur. (Mengapa ini penting, baca <?= ilink('ciri-konsultan-smk3-abal-abal', 'ciri konsultan yang harus dihindari') ?>.)</li>
  <li><strong>Sistem milik Anda, bukan milik kami.</strong> Pendampingan kami selalu menyertakan transfer pengetahuan — tujuan akhirnya tim Anda mampu menjalankan dan memelihara sistem sendiri.</li>
  <li><strong>Dokumen mengikuti kenyataan.</strong> Kami menulis sistem dari proses bisnis nyata klien — bukan menjual template yang sama untuk semua orang.</li>
  <li><strong>Transparansi biaya.</strong> Lingkup, ekslusi, dan skema pembayaran tertulis sejak penawaran — tanpa biaya kejutan.</li>
</ul>

<h2 id="layanan">Apa yang Bisa Kami Bantu</h2>
<div class="grid-2">
  <div class="card">
    <h3><?= ilink('jasa-konsultan-smk3', 'Pendampingan SMK3 Menyeluruh') ?></h3>
    <p>Dari gap analysis sampai sertifikat: dokumen, P2K3, HIRADC, pelatihan, dan pendampingan audit.</p>
  </div>
  <div class="card">
    <h3><?= ilink('jasa-audit-sertifikasi-smk3', 'Audit Internal &amp; Persiapan Sertifikasi') ?></h3>
    <p>Audit internal objektif, simulasi audit eksternal, dan program penutupan temuan.</p>
  </div>
</div>

<h2 id="perjalanan">Anda Telah Sampai di Ujung Perjalanan 50 Artikel</h2>
<p>Halaman ini adalah artikel penutup dari rangkaian panduan SMK3 kami. Bila Anda mengikutinya dari awal — dari <?= ilink('regulasi', 'dasar hukum PP 50/2012') ?>, menyusuri <?= ilink('implementasi', 'implementasi') ?>, <?= ilink('industri', 'penerapan per industri') ?>, <?= ilink('biaya', 'keputusan biaya') ?>, sampai <?= ilink('k3-pendukung', 'program K3 operasional') ?> — Anda kini memegang peta lengkap yang dibutuhkan untuk membawa perusahaan menuju sertifikasi. Dan bila Anda baru tiba di sini, mulailah dari awal: <?= ilink('home', 'kembali ke Beranda') ?> dan ikuti alurnya.</p>
<p>Ada yang ingin didiskusikan tentang perusahaan Anda? <?= ilink('kontak', 'Tim kami siap membantu — konsultasi awal gratis') ?>.</p>
