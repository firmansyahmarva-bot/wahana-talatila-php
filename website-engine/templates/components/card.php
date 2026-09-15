<?php
/** @var string $title */
/** @var string $href */
/** @var string|null $badge */
/** @var string|null $desc */
?>
<a class="card" href="<?= htmlspecialchars($href ?? '#') ?>" style="text-decoration:none;color:inherit;">
  <?php if (!empty($badge)): ?>
    <div class="icon-tile" aria-hidden="true"><?= htmlspecialchars(strtoupper(substr($badge, 0, 1))) ?></div>
  <?php endif; ?>
  <h3><?= htmlspecialchars($title ?? '') ?></h3>
  <?php if (!empty($desc)): ?><p class="desc"><?= htmlspecialchars($desc) ?></p><?php endif; ?>
  <div class="card-foot">Explore &rarr;</div>
</a>
