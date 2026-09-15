<?php
/** @var array $homepage */
$cta = $homepage['final_cta'] ?? [];
if ($cta === []) {
    return;
}
?>
<section class="section tight">
  <div class="wrap">
    <div class="final-cta">
      <div>
        <h2><?= htmlspecialchars($cta['heading'] ?? '') ?></h2>
        <?php if (!empty($cta['body'])): ?><p><?= htmlspecialchars($cta['body']) ?></p><?php endif; ?>
      </div>
      <div class="actions">
        <?php foreach (($cta['actions'] ?? []) as $action): ?>
          <a class="btn btn-<?= htmlspecialchars($action['style'] ?? 'primary') ?>" href="<?= htmlspecialchars($action['href'] ?? '#') ?>">
            <?= htmlspecialchars($action['label'] ?? '') ?>
          </a>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>
