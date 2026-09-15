<?php
/**
 * CTA BLOCK — educational, not sales-heavy. Appears after article body.
 * WhatsApp primary, kontak page secondary.
 */
?>
<aside class="cta-block" aria-label="Ajakan konsultasi">
  <h2>Punya Pertanyaan tentang Penerapan di Perusahaan Anda?</h2>
  <p>Setiap perusahaan punya kondisi awal yang berbeda. Tim konsultan kami bisa membantu memetakan posisi Anda terhadap persyaratan SMK3 — tanpa biaya untuk sesi diskusi awal.</p>
  <div class="cta-actions">
    <a class="btn btn-wa" href="<?= e(wa_url()) ?>" rel="noopener">Chat WhatsApp: <?= e($SITE['wa_display']) ?></a>
    <a class="btn btn-outline" href="<?= e(page_url('kontak')) ?>">Kirim Pertanyaan via Formulir</a>
  </div>
</aside>
