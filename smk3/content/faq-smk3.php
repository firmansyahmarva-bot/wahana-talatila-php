<?php
/** #40 — FAQ SMK3. FAQ array = seluruh isi utama (FAQPage schema kaya). */
$updated = '2026-08-10';
$faq = [
  ['q' => 'Apa itu SMK3 (Sistem Manajemen Keselamatan dan Kesehatan Kerja)?', 'a' => 'SMK3 adalah bagian dari sistem manajemen perusahaan secara keseluruhan dalam rangka pengendalian risiko yang berkaitan dengan kegiatan kerja guna terciptanya tempat kerja yang aman, efisien, dan produktif berdasarkan PP No. 50 Tahun 2012.'],
  ['q' => 'Siapa saja perusahaan yang WAJIB menerapkan SMK3 di Indonesia?', 'a' => 'Berdasarkan UU No. 13/2003 Psl 87 & PP No. 50/2012 Psl 5, wajib bagi: (1) Perusahaan yang mempekerjakan tenaga kerja minimal 100 orang, ATAU (2) Perusahaan yang mempunyai tingkat potensi bahaya tinggi (Konstruksi, Manufaktur, Pertambangan, Migas, Kimia, Transportasi).'],
  ['q' => 'Apa dasar hukum utama pelaksanaan sertifikasi SMK3 di Indonesia?', 'a' => 'Dasar hukum utamanya: UU No. 1 Tahun 1970 (K3), UU No. 13 Tahun 2003 Pasal 87 (Ketenagakerjaan), PP No. 50 Tahun 2012 (Penerapan SMK3), dan Permenaker No. 26 Tahun 2014 (Penilaian Audit SMK3).'],
  ['q' => 'Berapa jumlah total kriteria audit SMK3 PP 50/2012?', 'a' => 'Total kriteria audit SMK3 adalah **166 Kriteria** yang terbagi dalam 12 Elemen Utama. Penerapan dibagi 3 tingkat: Tingkat Awal (64 Kriteria), Tingkat Transisi (122 Kriteria), dan Tingkat Lanjutan (166 Kriteria).'],
  ['q' => 'Bagaimana sistem penilaian dan kriteria kelulusan audit SMK3?', 'a' => 'Kelulusan dinilai dari persentase kriteria terpenuhi: Kategori Kurang (<60%), Kategori Baik (60%–84% + Sertifikat Perak), dan Kategori Memuaskan (85%–100% + Sertifikat & Bendera Emas).'],
  ['q' => 'Siapa yang berwenang menerbitkan Sertifikat dan Bendera SMK3 resmi?', 'a' => 'Sertifikat dan Bendera Emas diterbitkan secara resmi oleh **Menteri Ketenagakerjaan Republik Indonesia (Kemnaker RI)** berdasarkan laporan hasil audit Lembaga Audit Eksternal Resmi.'],
  ['q' => 'Berapa lama masa berlaku Sertifikat SMK3 Kemnaker RI?', 'a' => 'Sertifikat SMK3 berlaku selama **3 (tiga) Tahun**. Sebelum masa berlaku habis, perusahaan wajib mengajukan Audit Resertifikasi.'],
  ['q' => 'Berapa rata-rata estimasi biaya sertifikasi SMK3 PP 50/2012?', 'a' => 'Estimasi total biaya bervariasi sesuai skala usaha: Perusahaan Kecil (Rp 50M–64M), Perusahaan Menengah (Rp 112M–142M), dan Perusahaan Besar/Multi-site (Rp 210M–350M+). Biaya mencakup Pendampingan Konsultan & Man-Days Lembaga Audit.'],
  ['q' => 'Berapa lama durasi total proses sertifikasi SMK3 dari nol hingga sertifikat terbit?', 'a' => 'Durasi normal berkisar antara **3 hingga 6 bulan kalender**, mencakup tahap Gap Analysis, pengesahan SK P2K3 Disnaker, penyusunan SOP/HIRADC, pengumpulan bukti penerapan 3 bulan, dan Audit Eksternal.'],
  ['q' => 'Apa perbedaan mendasar antara SMK3 PP 50/2012 dan Sertifikasi ISO 45001:2018?', 'a' => 'SMK3 bersifat Wajib Hukum (*Mandatory*) di Indonesia dengan kriteria preskriptif Kemnaker, sedangkan ISO 45001 bersifat Sukarela (*Voluntary*) standar internasional.'],
  ['q' => 'Apa itu P2K3 dan apa kewajibannya dalam SMK3?', 'a' => 'P2K3 (Panitia Pembina K3) adalah badan bipartit perwakilan manajemen dan pekerja yang disahkan Disnaker. Ketua P2K3 wajib dijabat Direktur Utama dan Sekretaris wajib Ahli K3 Umum Kemnaker.'],
  ['q' => 'Apakah perusahaan wajib memiliki Ahli K3 Umum bersertifikat Kemnaker?', 'a' => 'Wajib. Ahli K3 Umum diperlukan untuk menduduki posisi Sekretaris P2K3 dan mengelola administrasi kearsipan K3 perusahaan.'],
  ['q' => 'Apa itu dokumen HIRADC / IBPR?', 'a' => 'HIRADC (Hazard Identification, Risk Assessment, and Determining Control) adalah dokumen perencanaan dasar yang memetakan seluruh bahaya, risiko, dan pengendalian K3 di fasilitas kerja.'],
  ['q' => 'Apa sanksi bagi perusahaan yang tidak menerapkan SMK3?', 'a' => 'Sanksi administratif berjenjang sesuai UU 13/2003 Psl 190 (Teguran, Pembatasan Kegiatan, Pembekuan Izin Usaha) serta gugur otomatis dari syarat Tender LPSE / BUMN.'],
  ['q' => 'Apakah 1 Sertifikat SMK3 dapat berlaku untuk seluruh lokasi cabang (Multi-site)?', 'a' => 'Sertifikat mencantumkan lokasi tempat kerja yang diaudit. Jika perusahaan menginginkan multi-site, seluruh cabang wajib diikutsertakan dalam lingkup audit.'],
  ['q' => 'Apa saja bukti fisik yang diperiksa auditor selain berkas dokumen?', 'a' => 'Auditor memeriksa kondisi sarana fisik (APAR, SILO Mesin, LOTO, Pintu Darurat), rekaman bukti transaksi 3 bulan, dan wawancara langsung pekerja lapangan.'],
  ['q' => 'Bisakah perusahaan baru berdiri (Startup) langsung mengajukan audit SMK3?', 'a' => 'Bisa, asalkan perusahaan telah memiliki tempat kerja operasional, SK P2K3 Disnaker, dan mengumpulkan bukti penerapan rutin minimal 3 bulan.'],
  ['q' => 'Dapatkah proses sertifikasi SMK3 dilakukan mandiri tanpa konsultan?', 'a' => 'Dapat dilakukan mandiri jika perusahaan memiliki tim HSE internal berpengalaman yang menguasai 166 kriteria audit. Konsultan digunakan untuk efisiensi waktu.'],
  ['q' => 'Apa itu Audit Internal SMK3 dan seberapa sering wajib dilaksanakan?', 'a' => 'Audit Internal adalah pemeriksaan mandiri berkala oleh auditor internal perusahaan. Wajib dilakukan minimal **1 kali dalam 1 tahun**.'],
  ['q' => 'Kapan waktu terbaik mulai menyiapkan proses perpanjangan (Resertifikasi)?', 'a' => 'Persiapan wajib dimulai **6 hingga 10 bulan sebelum masa berlaku sertifikat 3 tahun habis** untuk mengantisipasi antrean Lembaga Audit Kemnaker.'],
  ['q' => 'Apa perbedaan Penghargaan Bendera Emas dan Bendera Perak SMK3?', 'a' => 'Bendera Emas diberikan untuk pencapaian &ge;85% kriteria audit Lanjutan (166 Kriteria). Bendera Perak untuk pencapaian 60%–84% kriteria Transisi (122 Kriteria).'],
  ['q' => 'Apakah gedung perkantoran perusahaan jasa wajib menerapkan SMK3?', 'a' => 'Tetap Wajib jika mempekerjakan &ge;100 karyawan. Penerapan difokuskan pada bahaya perkantoran (Ergonomi, Fire Safety, Listrik, Evakuasi).'],
  ['q' => 'Bagaimana kaitan Sertifikat SMK3 dengan syarat CSMS di industri Migas/Mining?', 'a' => 'Sertifikat SMK3 menjadi bukti otentik penilaian tertinggi pada kualifikasi administrasi CSMS (*Contractor Safety Management System*).'],
  ['q' => 'Apakah seluruh dokumen SMK3 wajib berbahasa Indonesia?', 'a' => 'Wajib berbahasa Indonesia agar dipahami pekerja dan auditor Kemnaker RI. Perusahaan multinasional dapat menggunakan format Bilingual.'],
  ['q' => 'Apa yang dimaksud dengan Temuan Kategori Kritis dalam audit SMK3?', 'a' => 'Temuan Kritis adalah pelanggaran fatal terhadap norma K3 yang berpotensi langsung menyebabkan kematian (misal: alat berat tanpa SILO, pengelasan tanpa PTW).'],
  ['q' => 'Berapa lama batas waktu penutupan temuan CAR (Corrective Action Report) pasca-audit?', 'a' => 'Perusahaan diberikan waktu maksimal **1 bulan (30 hari kerja)** untuk menutup seluruh temuan CAR dan menyerahkan bukti perbaikan ke Lembaga Audit.'],
  ['q' => 'Apakah Surat Keterangan Lulus (SKL) resmi dapat digunakan untuk tender sebelum sertifikat fisik terbit?', 'a' => 'Sangat Bisa. SKL resmi terbitan Kemnaker RI sah hukumnya digunakan sebagai pengganti sertifikat fisik dalam seluruh proses tender LPSE & BUMN.'],
  ['q' => 'Bagaimana cara memverifikasi keaslian Sertifikat SMK3 Kemnaker RI?', 'a' => 'Keaslian sertifikat dapat diverifikasi melalui nomor register SK Menteri pada database resmi Direktorat Bina K3 Kemnaker RI.'],
  ['q' => 'Ke mana kami dapat berkonsultasi gratis mengenai persiapan sertifikasi SMK3?', 'a' => 'Anda dapat berkonsultasi langsung dengan Tim Spesialis K3 Wahana Totalita Konsultan untuk analisis kebutuhan perusahaan Anda.'],
];
?>
<div class="note"><strong>Catatan Regulasi:</strong> FAQ SMK3 disusun berdasarkan kompilasi PP No. 50 Tahun 2012, Permenaker No. 26 Tahun 2014, dan regulasi K3 Ketenagakerjaan terbaru per 2026.</div>

<p>Halaman ini menyajikan direktori tanya-jawab terlengkap seputar Sertifikasi SMK3 PP 50/2012 di Indonesia. Seluruh jawaban disusun secara tegas, akurat, dan merujuk pada ketentuan hukum ketenagakerjaan terkini.</p>

<h2 id="direktori-faq">29 Pertanyaan &amp; Jawaban Resmi Seputar SMK3</h2>

<div class="faq-list">
<?php foreach ($faq as $idx => $f): ?>
  <div class="faq-item" id="faq-<?= $idx + 1 ?>">
    <h3><?= ($idx + 1) ?>. <?= htmlspecialchars($f['q']) ?></h3>
    <p><?= $f['a'] ?></p>
  </div>
<?php endforeach; ?>
</div>

<p>Butuh pendalaman lebih lanjut? Baca panduan lengkap kami mengenai <?= ilink('regulasi', 'PP 50/2012') ?>, <?= ilink('166-kriteria-smk3', '166 Kriteria Audit') ?>, dan <?= ilink('biaya', 'Rincian Biaya Sertifikasi SMK3') ?>.</p>

