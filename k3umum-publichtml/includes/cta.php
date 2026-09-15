<?php
/**
 * CTA BLOCK — only rendered on the 7 pages where config/pages.php sets
 * cta=true (A3, B, B1, B2, B5, D, E1). Anchor text here is intentionally
 * transactional/navigational, never the page's own informational head-term
 * (see ARCHITECTURE.md §Anchor rules) — this keeps the CTA from competing
 * with the page's own ranking intent.
 */
if (empty($page['cta'])) return;

$extAnchors = [
  'wt_jadwal'     => 'lihat jadwal pelatihan terdekat',
  'wt_perusahaan' => 'lihat program untuk perusahaan Anda',
];
?>
<aside class="cta-block" aria-label="Ajakan konsultasi">
  <div class="cta-block-inner">
    <span class="cta-icon"><?= icon('whatsapp') ?></span>
    <div>
      <h2>Punya Pertanyaan Lebih Lanjut?</h2>
      <p>Tim kami siap membantu menjawab pertanyaan spesifik seputar topik ini untuk situasi Anda — tanpa biaya untuk sesi awal.</p>
    </div>
  </div>
  <div class="cta-actions">
    <a class="btn btn-wa" href="<?= e(wa_url($page['wa_prefill'] ?? $SITE['wa_prefill'])) ?>" rel="noopener">Chat WhatsApp: <?= e($SITE['wa_display']) ?></a>
    <?php if (!empty($page['ext']) && isset($extAnchors[$page['ext']])): ?>
    <?= ext_link($page['ext'], $extAnchors[$page['ext']]) ?>
    <?php endif; ?>
  </div>
</aside>
