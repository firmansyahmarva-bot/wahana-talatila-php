<?php
/** @var array $homepage */
$categories = $homepage['categories'] ?? [];
$items = $categories['items'] ?? [];
if ($items === []) {
    return;
}
?>
<section class="section" id="categories">
  <div class="wrap">
    <div class="section-head">
      <div>
        <h2><?= htmlspecialchars($categories['heading'] ?? '') ?></h2>
        <?php if (!empty($categories['desc'])): ?><p class="desc"><?= htmlspecialchars($categories['desc']) ?></p><?php endif; ?>
      </div>
      <?php if (!empty($categories['link_label'])): ?>
        <a class="section-link" href="#"><?= htmlspecialchars($categories['link_label']) ?></a>
      <?php endif; ?>
    </div>
    <div class="grid grid-3">
      <?php foreach ($items as $c): ?>
        <div class="card">
          <div class="icon-tile" aria-hidden="true"><?= htmlspecialchars(strtoupper(substr($c['name'] ?? '', 0, 1))) ?></div>
          <h3><?= htmlspecialchars($c['name'] ?? '') ?></h3>
          <p class="desc"><?= htmlspecialchars($c['desc'] ?? '') ?></p>
          <div class="card-foot">Explore →</div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
