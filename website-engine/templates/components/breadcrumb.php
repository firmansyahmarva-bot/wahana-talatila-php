<?php
/** @var array $seo */
$items = $seo['breadcrumbs']['itemListElement'] ?? null;
if ($items):
?>
<div class="wrap">
<nav class="breadcrumb" aria-label="breadcrumb">
  <?php foreach ($items as $i => $item): ?>
    <?php if ($i > 0): ?><span class="sep">/</span><?php endif; ?>
    <a href="<?= htmlspecialchars($item['item']) ?>"><?= htmlspecialchars($item['name']) ?></a>
  <?php endforeach; ?>
</nav>
</div>
<?php endif; ?>
