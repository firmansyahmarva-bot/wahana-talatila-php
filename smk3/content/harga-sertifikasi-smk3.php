<?php
/** MONEY — Paket Harga Sertifikasi SMK3. */
$updated = '2026-08-10';
$faq = [
  ['q' => 'Mengapa harga jasa pendampingan sertifikasi SMK3 tidak dicantumkan sebagai tarif tunggal yang kaku?', 'a' => 'Karena beban kerja pendampingan sangat bergantung pada kondisi fisik awal perusahaan, kualifikasi kriteria yang ditargetkan (64, 122, atau 166 kriteria), serta ketersediaan personil lisensi K3 di lokasi. Penawaran harga mengikat diberikan secara transparan setelah tahap Gap Analysis.'],
  ['q' => 'Apakah honorarium Lembaga Audit Eksternal Kemnaker sudah termasuk dalam paket harga konsultan?', 'a' => 'Belum. Honorarium Lembaga Audit Eksternal dibayarkan langsung oleh perusahaan kepada Lembaga Audit Independen yang ditunjuk Kemnaker (seperti PT Sucofindo, PT Surveyor Indonesia, atau PT Biro Klasifikasi Indonesia). Konsultan membantu memfasilitasi pengajuan permohonan audit.'],
  ['q' => 'Bagaimana skema pembayaran bertahap (milestone) paket pendampingan SMK3?', 'a' => 'Skema standar pembayaran dibagi dalam 4 tahap: 30% Uang Muka (Kick-off), 30% Penyelesaian Dokumen & Pengesahan P2K3, 30% Pelaksanaan Audit Eksternal, dan 10% Pelunasan setelah Surat Keterangan Lulus (SKL) terbit.'],
  ['q' => 'Apakah ada jaminan kelulusan dari pihak konsultan K3?', 'a' => 'Keputusan sertifikasi resmi berada di tangan Kemnaker RI dan Lembaga Audit Independen. Jaminan kami adalah jaminan metodologi kerja: Gap Analysis menyeluruh, penyiapan dokumen berbasis proses bisnis nyata, dan simulasi audit ketat hingga perusahaan dinyatakan 100% siap saat diaudit.'],
];
?>
<div class="wrap wrap-narrow">
  <header class="article-head">
    <h1><?= e($page['h1']) ?></h1>
    <p class="article-meta">Diperbarui: <time datetime="<?= e($updated) ?>"><?= tgl_id($updated) ?></time></p>
  </header>

  <figure class="article-figure">
    <img src="<?= e(img_path($page['key'])) ?>" alt="<?= e($page['img_alt']) ?>" width="960" height="480" fetchpriority="high">
  </figure>

  <div class="article-body">
    <div class="note"><strong>Catatan Regulasi:</strong> Paket harga pendampingan sertifikasi SMK3 mengacu pada pemenuhan kriteria Lampiran II PP No. 50 Tahun 2012. Untuk rincian estimasi biaya dan proposal resmi transparan, konsultasikan bersama tim spesialis <?= ext_link('wt_smk3', 'Wahana Totalita Konsultan') ?> per 2026.</div>

    <p>Pertanyaan pertama dari setiap pimpinan perusahaan saat merencanakan sertifikasi keselamatan kerja adalah: <em>"Berapa investasi harga paket yang harus dialokasikan?"</em> Jawaban transparan dan profesional tergantung pada tingkat kesiapan awal operasional Anda. Kami menyajikan kerangka paket harga pendampingan SMK3 secara terbuka berdasarkan skala bisnis, tingkat risiko tempat kerja, dan cakupan kriteria audit Kemnaker RI.</p>

    <h2 id="paket">3 Pilihan Paket Pendampingan Sertifikasi SMK3</h2>
    <div class="price-cards">
      <div class="price-card">
        <span class="kicker">Skala Kecil / Starters</span>
        <p class="price">Kisaran: Rp 15 – 35 Juta</p>
        <p>Diperuntukkan bagi perusahaan dengan 100–200 pekerja, 1 lokasi kantor/gudang, dan risiko sedang. Menargetkan **Tingkat Awal (64 Kriteria Audit)**.</p>
        <ul class="check-list">
          <li>Gap Analysis awal di 1 lokasi tempat kerja</li>
          <li>Penyusunan Manual &amp; 64 Prosedur Inti SMK3</li>
          <li>Penyusunan Register HIRADC &amp; SOP Operasional</li>
          <li>Pengurusan Pengesahan SK P2K3 ke Disnaker</li>
          <li>1x Pelatihan Training Awareness K3 Karyawan</li>
          <li>Audit Internal &amp; Pendampingan Audit Eksternal</li>
        </ul>
      </div>

      <div class="price-card is-featured">
        <span class="kicker">Skala Menengah / Growing</span>
        <p class="price">Kisaran: Rp 35 – 90 Juta</p>
        <p>Diperuntukkan bagi perusahaan pabrik manufaktur, kontraktor Menengah, atau 1–2 lokasi. Menargetkan **Tingkat Transisi / Lanjutan (122–166 Kriteria)**.</p>
        <ul class="check-list">
          <li>Seluruh fitur Paket Skala Kecil, ditambah:</li>
          <li>Penyusunan Dokumentasi 12 Elemen Lengkap</li>
          <li>HIRADC Kompleks &amp; Prosedur LOTO / PTW</li>
          <li>Pelatihan Bertingkat (Manajemen, P2K3, Operator)</li>
          <li>Simulasi Audit Eksternal (Mock Audit Penuh)</li>
          <li>Pendampingan Penutupan Temuan Audit (CAR)</li>
        </ul>
      </div>

      <div class="price-card">
        <span class="kicker">Skala Besar / Enterprise</span>
        <p class="price">Kisaran: Rp 90 – 200+ Juta</p>
        <p>Diperuntukkan bagi perusahaan Holding Multi-site, EPC, Mining, atau Migas. Menargetkan **Tingkat Lanjutan Bendera Emas (166 Kriteria)**.</p>
        <ul class="check-list">
          <li>Seluruh fitur Paket Skala Menengah, ditambah:</li>
          <li>Rollout Multi-lokasi / Multi-site Proyek</li>
          <li>Integrasi Sistem Terpadu (SMK3 + ISO 45001 + CSMS)</li>
          <li>Audit Keselamatan Sub-Kontraktor (Sub-con CSMS)</li>
          <li>Pendampingan Pasca-Audit &amp; Resertifikasi</li>
        </ul>
      </div>
    </div>

    <div class="note"><strong>Prinsip Transparansi Harga:</strong> Kisaran biaya di atas merupakan acuan estimasi pasar pendampingan di Indonesia. Penawaran harga pasti disajikan dalam dokumen Proposal Resmi setelah tim konsultan kami melakukan wawancara kondisi awal perusahaan Anda.</div>

    <h2 id="faktor-penentu">5 Faktor Utama yang Mempengaruhi Besaran Harga Paket</h2>
    <div class="table-scroll"><table>
      <tr>
        <th>Faktor Penentu Harga</th>
        <th>Pengaruh Kualitatif terhadap Total Investasi</th>
      </tr>
      <tr>
        <td><strong>1. Jumlah Tenaga Kerja &amp; Lokasi Site</strong></td>
        <td>Memengaruhi alokasi hari kerja (Man-Days) konsultan dan tarif resmi Man-Days Lembaga Audit Eksternal.</td>
      </tr>
      <tr>
        <td><strong>2. Kesiapan Sistem Manajemen Awal</strong></td>
        <td>Perusahaan yang sudah mengantongi sertifikat ISO 9001 atau ISO 14001 mendapatkan keringanan biaya pendampingan hingga 30%.</td>
      </tr>
      <tr>
        <td><strong>3. Tingkat Penilaian yang Dituju</strong></td>
        <td>Cakupan Kriteria Awal (64 kriteria) membutuhkan waktu penyusunan dokumen yang lebih ringkas dibanding Kriteria Lanjutan (166 kriteria).</td>
      </tr>
      <tr>
        <td><strong>4. Kelengkapan Legalitas &amp; Riksa Uji Alat</strong></td>
        <td>Kebutuhan pembinaan Ahli K3 Umum baru atau Riksa Uji peralatan mati menjadi komponen biaya independen di luar jasa konsultan.</td>
      </tr>
      <tr>
        <td><strong>5. Kompleksitas Risiko Operasional</strong></td>
        <td>Industri dengan potensi bahaya tinggi (kimia B3, peledakan, kerja lepas pantai) menuntut kualifikasi tim konsultan spesialis.</td>
      </tr>
    </table></div>

    <h2 id="di-luar-paket">Komponen Anggaran di Luar Paket Konsultan yang Perlu Diingat</h2>
    <ul>
      <li><strong>Honorarium Lembaga Audit Eksternal:</strong> Dibayarkan resmi kepada Lembaga Audit (Sucofindo, Surveyor Indonesia, BKI, dll) berdasar Man-Days.</li>
      <li><strong>Biaya Pembinaan &amp; Lisensi K3 Personil:</strong> Sertifikasi Ahli K3 Umum (Sekretaris P2K3) dan Kartu Lisensi SIO Operator (Forklift, Crane, Welder).</li>
      <li><strong>Biaya Riksa Uji Peralatan Utilitas:</strong> Pengujian fisik Bejana Tekan, Boiler, Lift, Instalasi Fire Hydran, dan Pesawat Angkat-Angkut oleh PJK3 Riksa Uji.</li>
      <li><strong>Biaya Pengukuran Lingkungan Kerja &amp; MCU:</strong> Pengujian laboratorium parameter kebisingan/debu dan pemeriksaan kesehatan berkala karyawan.</li>
    </ul>

    <h2 id="alur-pemesanan">4 Langkah Mudah Mendapatkan Penawaran Resmi</h2>
    <ol class="steps">
      <li><strong>Pengisian Informasi Perusahaan:</strong> Hubungi tim konsultan kami via WhatsApp atau Formulir Kontak dengan menyebutkan nama perusahaan, sektor industri, jumlah karyawan, dan lokasi site.</li>
      <li><strong>Diskusi Assessment Gratis (15 Menit):</strong> Tim spesialis K3 kami melakukan wawancara singkat via telepon/video call untuk mengukur kesiapan awal sistem Anda.</li>
      <li><strong>Penerbitan Proposal Penawaran Resmi:</strong> Dalam 1–2 hari kerja, kami menerbitkan Proposal Penawaran tertulis yang memuat rincian lingkup kerja, jadwal milestone, dan skema pembayaran.</li>
      <li><strong>Penandatanganan Kontrak &amp; Kick-Off Proyek:</strong> Setelah disetujui, proyek pendampingan langsung dimulai dengan penunjukan Lead Consultant resmi.</li>
    </ol>
  </div>

  <div class="cta-block">
    <h2>Minta Penawaran Proposal SMK3 Sesuai Kondisi Perusahaan Anda</h2>
    <p>Sampaikan sektor usaha, jumlah pekerja, dan lokasi — tim kami akan menerbitkan estimasi Proposal Anggaran Resmi secara cepat.</p>
    <div class="cta-actions">
      <a class="btn btn-wa" href="<?= e(wa_url('Halo, saya ingin minta proposal penawaran pendampingan sertifikasi SMK3. Perusahaan/sektor/jumlah pekerja: ')) ?>" rel="noopener">WhatsApp: <?= e($SITE['wa_display']) ?></a>
      <a class="btn btn-outline" style="background:#fff" href="<?= e(page_url('kontak')) ?>">Kirim Formulir Penawaran</a>
    </div>
  </div>
</div>

