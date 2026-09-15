<?php
$updated = '2026-07-20';
?>
<p>Sertifikat Ahli K3 Umum tidak berlaku selamanya. Baik jalur Kemnaker maupun BNSP sama-sama membatasi masa berlaku <strong>3 tahun</strong> — tapi cara memperpanjangnya berbeda jauh antara keduanya, dan ini sering jadi kejutan bagi yang baru pertama kali mengalami masa perpanjangan.</p>

<div class="compare-grid">
  <div class="compare-card is-recommended">
    <span class="compare-badge">Lebih Ringan</span>
    <h3>Perpanjangan Jalur Kemnaker</h3>
    <ul>
      <li><span class="ci"><?= icon('check') ?></span> Perpanjang SKP dan lisensi K3</li>
      <li><span class="ci"><?= icon('check') ?></span> Tanpa ujian ulang</li>
      <li><span class="ci"><?= icon('check') ?></span> Melampirkan bukti pengalaman kerja di bidang K3</li>
    </ul>
  </div>
  <div class="compare-card">
    <h3>Perpanjangan Jalur BNSP</h3>
    <ul>
      <li><span class="ci"><?= icon('check') ?></span> Wajib ujian ulang</li>
      <li><span class="ci"><?= icon('check') ?></span> Menyesuaikan skema kompetensi terkini</li>
    </ul>
  </div>
</div>

<h2 id="cara-perpanjang">Cara Memperpanjang SKP (Jalur Kemnaker)</h2>
<ol class="timeline-horizontal">
  <li><span class="th-num">1</span><strong>Ajukan permohonan</strong><p>Diajukan ke Kemnaker RI sebelum masa berlaku habis.</p></li>
  <li><span class="th-num">2</span><strong>Lampirkan bukti pengalaman</strong><p>Bukti pengalaman kerja di bidang K3 selama masa berlaku sebelumnya.</p></li>
  <li><span class="th-num">3</span><strong>Pelatihan penyegaran (jika diperlukan)</strong><p>Sebagian kasus mensyaratkan pelatihan singkat sebagai penyegaran.</p></li>
  <li><span class="th-num">4</span><strong>Lengkapi dokumen administratif</strong><p>Termasuk surat rekomendasi dari perusahaan tempat bekerja.</p></li>
</ol>

<div class="callout callout-warning">
  <span class="callout-icon"><?= icon('warning') ?></span>
  <p><strong>Batas waktu penting:</strong> perpanjangan SKP dapat dilakukan maksimal 1 tahun setelah masa berlaku habis. Lewat dari itu, Anda harus mengikuti <?= ilink('a3', 'pelatihan Ahli K3 Umum dari awal') ?> — bukan sekadar perpanjang.</p>
</div>

<h2 id="konsekuensi">Konsekuensi Jika Tidak Diperpanjang</h2>
<p>Ahli K3 Umum yang SKP-nya tidak diperpanjang <strong>kehilangan wewenang resminya</strong> — tidak bisa lagi menjalankan tugas sebagai Ahli K3 di perusahaan, dan tidak berwenang menandatangani dokumen atau laporan K3 terkait. Ini berdampak langsung ke kepatuhan perusahaan, bukan cuma status pribadi.</p>

<div class="callout callout-info">
  <span class="callout-icon"><?= icon('info') ?></span>
  <p>Butuh bantuan mengurus perpanjangan SKP Anda? <a href="<?= e(wa_url('Halo, saya ingin bantuan soal perpanjangan SKP Ahli K3 Umum.')) ?>">Tanya langsung via WhatsApp</a>.</p>
</div>

<?php $faq = [
  ['q' => 'Apakah perpanjangan SKP Kemnaker perlu ujian ulang?', 'a' => 'Tidak. Jalur Kemnaker hanya memerlukan perpanjangan SKP dan lisensi dengan melampirkan bukti pengalaman kerja, tanpa ujian ulang — berbeda dari jalur BNSP.'],
  ['q' => 'Apa yang terjadi jika SKP terlambat diperpanjang lebih dari 1 tahun?', 'a' => 'Pemegang sertifikat harus mengikuti pelatihan Ahli K3 Umum dari awal, bukan sekadar mengajukan perpanjangan.'],
]; ?>
