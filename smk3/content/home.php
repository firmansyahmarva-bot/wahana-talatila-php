<?php
/** HOME — authority landing page (~2,000 words). */
$updated = '2026-07-17';
$faq = [
  ['q' => 'Apa itu SMK3?', 'a' => 'SMK3 (Sistem Manajemen Keselamatan dan Kesehatan Kerja) adalah bagian dari sistem manajemen perusahaan yang digunakan untuk mengendalikan risiko K3 dalam aktivitas kerja. Penerapannya di Indonesia diatur oleh PP No. 50 Tahun 2012.'],
  ['q' => 'Perusahaan apa saja yang wajib menerapkan SMK3?', 'a' => 'Perusahaan yang mempekerjakan minimal 100 orang pekerja, atau perusahaan dengan tingkat potensi bahaya tinggi meskipun jumlah pekerjanya kurang dari 100 orang.'],
  ['q' => 'Berapa lama sertifikat SMK3 berlaku?', 'a' => 'Sertifikat SMK3 berlaku selama 3 tahun sejak diterbitkan, dan perusahaan perlu menjalani audit ulang (resertifikasi) sebelum masa berlakunya habis.'],
  ['q' => 'Berapa biaya sertifikasi SMK3?', 'a' => 'Biaya bervariasi menurut skala perusahaan dan kondisi awal penerapan. Sebagai kisaran pasar: perusahaan kecil sekitar Rp10–30 juta, menengah Rp30–100 juta, dan besar di atas Rp100 juta untuk keseluruhan proses. Rincian komponen biaya dibahas di halaman biaya kami.'],
  ['q' => 'Apakah SMK3 sama dengan ISO 45001?', 'a' => 'Tidak. SMK3 adalah kewajiban hukum di Indonesia berdasarkan PP 50/2012, sedangkan ISO 45001 adalah standar internasional yang bersifat sukarela. Banyak perusahaan menerapkan keduanya secara terintegrasi.'],
];
?>
<section class="hero">
  <div class="wrap">
    <span class="kicker" style="color:#f6b569">PUSAT PANDUAN SMK3 INDONESIA</span>
    <h1>Panduan Lengkap SMK3: dari Regulasi PP 50/2012 sampai Sertifikat di Tangan</h1>
    <p>50 panduan praktis yang ditulis dari pengalaman lapangan — membantu HSE manager, HR, dan pemilik perusahaan memahami kewajiban SMK3, menerapkannya dengan benar, dan lulus audit sertifikasi tanpa membuang waktu dan biaya.</p>
    <div class="cta-actions">
      <a class="btn btn-accent" href="<?= e(page_url('jasa-konsultan-smk3')) ?>">Lihat Layanan Konsultan</a>
      <a class="btn btn-wa" href="<?= e(wa_url()) ?>" rel="noopener">Konsultasi Gratis via WhatsApp</a>
    </div>
    <ul class="hero-badges">
      <li>Dikelola tim <?= e($SITE['org_name']) ?></li>
      <li>Berbasis PP No. 50 Tahun 2012</li>
      <li>Pengalaman lintas industri</li>
    </ul>
  </div>
</section>

<section class="section">
  <div class="wrap">
    <h2 id="mengapa-smk3">Mengapa SMK3 Tidak Bisa Ditunda</h2>
    <p class="section-lead">SMK3 bukan sekadar dokumen untuk dipajang. Ia adalah kewajiban hukum, syarat masuk banyak tender, dan — bila diterapkan dengan benar — sistem yang benar-benar menurunkan angka kecelakaan kerja.</p>
    <div class="grid-3">
      <div class="card">
        <h3>Kewajiban Hukum</h3>
        <p>UU Ketenagakerjaan No. 13 Tahun 2003 Pasal 87 mewajibkan setiap perusahaan menerapkan SMK3 yang terintegrasi dengan sistem manajemen perusahaan. PP No. 50 Tahun 2012 merinci kewajiban ini: perusahaan dengan minimal 100 pekerja atau berpotensi bahaya tinggi wajib menerapkannya. Selengkapnya di <?= ilink('regulasi', 'panduan PP 50/2012') ?>.</p>
      </div>
      <div class="card">
        <h3>Syarat Bisnis &amp; Tender</h3>
        <p>Sertifikat SMK3 semakin sering menjadi syarat kualifikasi tender pemerintah maupun swasta, prakualifikasi CSMS di sektor migas, dan penilaian vendor perusahaan besar. Tanpa sertifikat, banyak pintu bisnis tertutup sebelum penawaran Anda dibaca.</p>
      </div>
      <div class="card">
        <h3>Perlindungan Nyata</h3>
        <p>Perusahaan yang menerapkan SMK3 dengan serius memiliki proses identifikasi bahaya, pengendalian risiko, dan kesiapan tanggap darurat yang berjalan — bukan hanya di atas kertas. Hasilnya: lebih sedikit kecelakaan, lebih sedikit jam kerja hilang, dan reputasi yang lebih kuat.</p>
      </div>
    </div>
  </div>
</section>

<section class="section section-alt">
  <div class="wrap">
    <h2 id="lima-topik">Jelajahi 5 Topik Utama</h2>
    <p class="section-lead">Seluruh isi situs ini tersusun dalam lima topik yang mengikuti perjalanan nyata perusahaan: memahami aturan, menerapkan sistem, menyesuaikan dengan industri, mengambil keputusan biaya, lalu memperkuat program K3 operasional.</p>
    <div class="grid-2">
      <a class="card card-link" href="<?= e(page_url('regulasi')) ?>">
        <span class="kicker">Topik 1 — Regulasi</span>
        <h3>PP 50/2012, Kriteria, Audit &amp; Sanksi</h3>
        <p>Dasar hukum SMK3, 166 kriteria, 12 elemen, jenis audit, masa berlaku sertifikat, hingga perbandingan dengan ISO 45001.</p>
        <span class="more">9 panduan &rarr;</span>
      </a>
      <a class="card card-link" href="<?= e(page_url('implementasi')) ?>">
        <span class="kicker">Topik 2 — Implementasi</span>
        <h3>Langkah Penerapan di Perusahaan</h3>
        <p>Gap analysis, dokumen wajib, kebijakan K3, pembentukan P2K3, HIRADC, sampai template dokumen yang benar penggunaannya.</p>
        <span class="more">9 panduan &rarr;</span>
      </a>
      <a class="card card-link" href="<?= e(page_url('industri')) ?>">
        <span class="kicker">Topik 3 — Industri</span>
        <h3>SMK3 per Sektor Industri</h3>
        <p>Konstruksi, manufaktur, pertambangan, migas, logistik, rumah sakit, EPC, hingga UMKM — karena tiap sektor punya tantangan berbeda.</p>
        <span class="more">9 panduan &rarr;</span>
      </a>
      <a class="card card-link" href="<?= e(page_url('biaya')) ?>">
        <span class="kicker">Topik 4 — Biaya &amp; Keputusan</span>
        <h3>Biaya, Durasi &amp; Memilih Konsultan</h3>
        <p>Rincian komponen biaya, timeline realistis, cara memilih konsultan terpercaya, checklist kesiapan audit, dan FAQ lengkap.</p>
        <span class="more">8 panduan &rarr;</span>
      </a>
      <a class="card card-link" href="<?= e(page_url('k3-pendukung')) ?>">
        <span class="kicker">Topik 5 — K3 Pendukung</span>
        <h3>Program Operasional K3</h3>
        <p>JSA, permit to work, kerja di ketinggian, ruang terbatas, proteksi kebakaran, higiene industri, dan manajemen risiko K3.</p>
        <span class="more">9 panduan &rarr;</span>
      </a>
      <div class="card" style="background:var(--c-primary);color:#fff">
        <span class="kicker" style="color:#f6b569">Butuh Jalur Cepat?</span>
        <h3 style="color:#fff">Didampingi Konsultan dari Awal</h3>
        <p style="color:#d5e5f3">Jika Anda mengejar tenggat tender atau audit, tim kami bisa memetakan kondisi perusahaan Anda dan menyusun jalur tercepat menuju sertifikat.</p>
        <a class="btn btn-accent" href="<?= e(page_url('jasa-konsultan-smk3')) ?>">Pelajari Layanan Kami</a>
      </div>
    </div>
  </div>
</section>

<section class="section">
  <div class="wrap">
    <h2 id="artikel-unggulan">Artikel yang Paling Banyak Dicari</h2>
    <div class="grid-3">
      <a class="card card-link" href="<?= e(page_url('166-kriteria-smk3')) ?>">
        <span class="kicker">Regulasi</span>
        <h3>166 Kriteria SMK3</h3>
        <p>Apa saja yang dinilai auditor, dan bagaimana kriteria terbagi ke tingkat awal, transisi, dan lanjutan.</p>
      </a>
      <a class="card card-link" href="<?= e(page_url('biaya')) ?>">
        <span class="kicker">Biaya</span>
        <h3>Biaya Sertifikasi SMK3</h3>
        <p>Komponen biaya yang sering tidak dihitung perusahaan, plus kisaran realistis per skala usaha.</p>
      </a>
      <a class="card card-link" href="<?= e(page_url('cara-menyusun-hiradc')) ?>">
        <span class="kicker">Implementasi</span>
        <h3>Cara Menyusun HIRADC</h3>
        <p>Langkah demi langkah dengan contoh tabel — dokumen inti yang hampir selalu diperiksa auditor.</p>
      </a>
      <a class="card card-link" href="<?= e(page_url('checklist-kesiapan-audit-smk3')) ?>">
        <span class="kicker">Audit</span>
        <h3>Checklist Kesiapan Audit</h3>
        <p>Ukur sendiri kesiapan perusahaan Anda sebelum mengundang lembaga audit.</p>
      </a>
      <a class="card card-link" href="<?= e(page_url('smk3-vs-iso-45001')) ?>">
        <span class="kicker">Komparasi</span>
        <h3>SMK3 vs ISO 45001</h3>
        <p>Dua standar yang sering dianggap sama padahal berbeda status hukum dan mekanismenya.</p>
      </a>
      <a class="card card-link" href="<?= e(page_url('cara-membentuk-p2k3')) ?>">
        <span class="kicker">Implementasi</span>
        <h3>Cara Membentuk P2K3</h3>
        <p>Syarat, susunan panitia, dan proses pengesahan ke Disnaker — prasyarat penting sebelum audit.</p>
      </a>
    </div>
  </div>
</section>

<section class="section section-alt">
  <div class="wrap">
    <h2 id="layanan">Layanan Pendampingan SMK3</h2>
    <p class="section-lead">Kami mendampingi perusahaan pada titik mana pun perjalanannya — baru mulai dari nol, sedang memperbaiki sistem, atau mengejar resertifikasi.</p>
    <div class="grid-3">
      <div class="card">
        <h3><?= ilink('jasa-konsultan-smk3', 'Konsultan SMK3') ?></h3>
        <p>Pendampingan penuh: gap analysis, penyusunan dokumen, pelatihan, implementasi lapangan, sampai lulus audit sertifikasi.</p>
      </div>
      <div class="card">
        <h3><?= ilink('jasa-audit-sertifikasi-smk3', 'Audit &amp; Persiapan Sertifikasi') ?></h3>
        <p>Audit internal menyeluruh dan simulasi audit eksternal agar temuan diselesaikan sebelum auditor sungguhan datang.</p>
      </div>
      <div class="card">
        <h3><?= ilink('harga-sertifikasi-smk3', 'Paket Sesuai Skala Perusahaan') ?></h3>
        <p>Paket untuk perusahaan kecil, menengah, dan besar dengan lingkup kerja yang jelas dan biaya transparan.</p>
      </div>
    </div>
  </div>
</section>

<section class="section">
  <div class="wrap">
    <h2 id="industri-kami">Industri yang Kami Layani</h2>
    <p class="section-lead">Pendekatan penerapan SMK3 kami menyesuaikan profil risiko masing-masing sektor:</p>
    <div class="grid-4">
      <a class="card card-link" href="<?= e(page_url('smk3-konstruksi')) ?>"><h3>Konstruksi</h3></a>
      <a class="card card-link" href="<?= e(page_url('smk3-manufaktur')) ?>"><h3>Manufaktur</h3></a>
      <a class="card card-link" href="<?= e(page_url('smk3-pertambangan')) ?>"><h3>Pertambangan</h3></a>
      <a class="card card-link" href="<?= e(page_url('smk3-migas')) ?>"><h3>Minyak &amp; Gas</h3></a>
      <a class="card card-link" href="<?= e(page_url('smk3-logistik')) ?>"><h3>Logistik</h3></a>
      <a class="card card-link" href="<?= e(page_url('smk3-rumah-sakit')) ?>"><h3>Rumah Sakit</h3></a>
      <a class="card card-link" href="<?= e(page_url('smk3-epc')) ?>"><h3>EPC</h3></a>
      <a class="card card-link" href="<?= e(page_url('smk3-umkm')) ?>"><h3>UMKM</h3></a>
    </div>
  </div>
</section>

<section class="section section-alt">
  <div class="wrap wrap-narrow">
    <h2 id="cara-kerja">Bagaimana Kami Bekerja</h2>
    <ol class="steps">
      <li><strong>Konsultasi awal (gratis).</strong> Kami dengarkan kondisi, target, dan tenggat Anda — lalu beri gambaran jujur tentang jalur yang paling masuk akal.</li>
      <li><strong>Gap analysis.</strong> Tim kami menilai kondisi perusahaan terhadap 166 kriteria SMK3 dan menyusun peta jalan perbaikan yang terukur.</li>
      <li><strong>Implementasi terarah.</strong> Penyusunan dokumen, pembentukan P2K3, pelatihan, dan perbaikan lapangan — dikerjakan bersama tim internal Anda agar sistem benar-benar hidup.</li>
      <li><strong>Audit internal &amp; simulasi.</strong> Kami menguji sistem seperti auditor eksternal menguji, sehingga temuan selesai sebelum audit sebenarnya.</li>
      <li><strong>Pendampingan audit sertifikasi.</strong> Saat lembaga audit datang, tim Anda siap — dan kami mendampingi sampai sertifikat terbit.</li>
    </ol>
    <div class="cta-actions">
      <a class="btn btn-wa" href="<?= e(wa_url()) ?>" rel="noopener">Diskusikan Kebutuhan Anda — Gratis</a>
      <a class="btn btn-outline" href="<?= e(page_url('kontak')) ?>">Atau Kirim Formulir</a>
    </div>
  </div>
</section>

<section class="section">
  <div class="wrap wrap-narrow">
    <h2 id="mulai-membaca">Mulai Membaca Panduan Lengkapnya</h2>
    <p>Cara terbaik memahami SMK3 adalah mengikutinya secara berurutan. Mulailah dari dasar hukumnya: <?= ilink('regulasi', 'PP No. 50 Tahun 2012 tentang SMK3 — Panduan Lengkap') ?>. Dari sana, setiap artikel akan mengantar Anda ke artikel berikutnya sampai seluruh 50 panduan selesai Anda jelajahi.</p>
  </div>
</section>
