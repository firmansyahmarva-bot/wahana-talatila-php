<?php
/**
 * RELATED SECTION — 3 related articles + parent hub + relevant money page.
 * Rendered under the article body on every non-money page.
 */
$relatedKeys = $page['related'];
$hubKey   = $page['hub'] !== 'money' ? $SITE['hub_pages'][$page['hub']] : null;
$moneyKey = $page['money'];
?>
<section class="related" aria-labelledby="related-h">
  <h2 id="related-h">Baca Juga</h2>
  <div class="related-grid">
    <?php foreach ($relatedKeys as $rk): if (!isset($PAGES[$rk])) continue; ?>
    <a class="related-card" href="<?= e(page_url($rk)) ?>">
      <span class="related-kicker"><?= e($PAGES[$rk]['hub'] === 'money' ? 'Layanan' : $SITE['hub_names'][$PAGES[$rk]['hub']]) ?></span>
      <span class="related-title"><?= e($PAGES[$rk]['h1']) ?></span>
    </a>
    <?php endforeach; ?>
  </div>
  <p class="related-links">
    <?php if ($hubKey && $hubKey !== $page['key']): ?>
    Kembali ke panduan utama: <?= ilink($hubKey) ?>.
    <?php endif; ?>
    <?php if ($moneyKey !== $page['key']): ?>
    Butuh bantuan langsung? Lihat <?= ilink($moneyKey) ?>.
    <?php endif; ?>
  </p>
</section>
