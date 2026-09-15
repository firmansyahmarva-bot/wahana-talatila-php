<?php
/** @var array $homepage */
$process = $homepage['process'] ?? [];
$steps = $process['steps'] ?? [];
if ($steps === []) {
    return;
}
?>
<section class="section">
  <div class="wrap">
    <div class="section-head">
      <div>
        <h2><?= htmlspecialchars($process['heading'] ?? '') ?></h2>
        <?php if (!empty($process['desc'])): ?><p class="desc"><?= htmlspecialchars($process['desc']) ?></p><?php endif; ?>
      </div>
    </div>
    <div class="process-line">
      <?php foreach ($steps as $i => $s): ?>
        <div class="process-step">
          <div class="process-num"><?= str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) ?></div>
          <h3><?= htmlspecialchars($s['name'] ?? '') ?></h3>
          <p><?= htmlspecialchars($s['desc'] ?? '') ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
