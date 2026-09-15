<?php
/** @var array $homepage */
$products = $homepage['products'] ?? [];
$items = $products['items'] ?? [];
if ($items === []) {
    return;
}
?>
<section class="section">
  <div class="wrap">
    <div class="section-head">
      <div>
        <h2><?= htmlspecialchars($products['heading'] ?? '') ?></h2>
        <?php if (!empty($products['desc'])): ?><p class="desc"><?= htmlspecialchars($products['desc']) ?></p><?php endif; ?>
      </div>
    </div>
    <div class="grid grid-3">
      <?php foreach ($items as $p): ?>
        <?php $price = $p['price'] ?? ''; $plainPrice = in_array($price, ['Custom quote', 'Per engagement'], true); ?>
        <div class="card product-card">
          <div class="icon-tile" aria-hidden="true"><?= htmlspecialchars(strtoupper(substr($p['name'] ?? '', 0, 1))) ?></div>
          <h3><?= htmlspecialchars($p['name'] ?? '') ?></h3>
          <p class="desc"><?= htmlspecialchars($p['desc'] ?? '') ?></p>
          <?php if ($price !== ''): ?>
            <div class="price"><?= $plainPrice ? htmlspecialchars($price) : '<b>' . htmlspecialchars($price) . '</b>' ?></div>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
