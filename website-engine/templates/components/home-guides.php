<?php
/** @var array $homepage */
$guides = $homepage['guides'] ?? [];
$items = $guides['items'] ?? [];
if ($items === []) {
    return;
}
?>
<section class="section">
  <div class="wrap">
    <div class="section-head">
      <div>
        <h2><?= htmlspecialchars($guides['heading'] ?? '') ?></h2>
        <?php if (!empty($guides['desc'])): ?><p class="desc"><?= htmlspecialchars($guides['desc']) ?></p><?php endif; ?>
      </div>
      <?php if (!empty($guides['link_label'])): ?>
        <a class="section-link" href="#"><?= htmlspecialchars($guides['link_label']) ?></a>
      <?php endif; ?>
    </div>
    <div class="grid grid-4">
      <?php foreach ($items as $g): ?>
        <div class="guide-card">
          <div class="guide-thumb" aria-hidden="true"></div>
          <div class="guide-body">
            <div class="guide-cat"><?= htmlspecialchars($g['cat'] ?? '') ?></div>
            <h3><?= htmlspecialchars($g['title'] ?? '') ?></h3>
            <div class="guide-meta"><span><?= htmlspecialchars($g['date'] ?? '') ?></span><span>·</span><span><?= htmlspecialchars($g['time'] ?? '') ?></span></div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
