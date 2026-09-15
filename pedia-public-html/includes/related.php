<?php
/**
 * RELATED SECTION — 3 related entries + parent hub link.
 * Rendered under the body on every page. Purely editorial, no CTA.
 */
$relatedKeys = $page['related'];
$hubKey = $page['hub'] !== 'utility' ? $SITE['hub_pages'][$page['hub']] : null;
?>
<section class="related" aria-labelledby="related-h">
  <h2 id="related-h">Baca Juga</h2>
  <div class="related-grid">
    <?php foreach ($relatedKeys as $rk): if (!isset($PAGES[$rk])) continue; ?>
    <a class="related-card" href="<?= e(page_url($rk)) ?>">
      <span class="related-kicker"><?= e($SITE['hub_names'][$PAGES[$rk]['hub']]) ?></span>
      <span class="related-title"><?= e($PAGES[$rk]['h1']) ?></span>
    </a>
    <?php endforeach; ?>
  </div>
  <?php if ($hubKey && $hubKey !== $page['key']): ?>
  <p class="related-links">Kembali ke topik utama: <?= ilink($hubKey) ?>.</p>
  <?php endif; ?>
</section>
