<?php
/** @var array $homepage */
$trust = $homepage['trust'] ?? [];
$stats = $trust['stats'] ?? [];
$clients = $trust['clients'] ?? [];
$accreditations = $trust['accreditations'] ?? [];
if ($stats === [] && $clients === [] && $accreditations === []) {
    return;
}
?>
<section class="section">
  <div class="wrap">
    <div class="section-head">
      <div>
        <h2><?= htmlspecialchars($trust['heading'] ?? '') ?></h2>
      </div>
    </div>
    <?php if ($stats !== []): ?>
    <div class="stat-row">
      <?php foreach ($stats as $s): ?>
        <div class="stat-cell">
          <div class="num"><?= htmlspecialchars($s['num'] ?? '') ?></div>
          <div class="label"><?= htmlspecialchars($s['label'] ?? '') ?></div>
        </div>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
    <?php if ($clients !== []): ?>
    <div class="logo-strip">
      <?php foreach ($clients as $c): ?>
        <div class="logo-cell"><?= htmlspecialchars($c) ?></div>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
    <?php if ($accreditations !== []): ?>
    <div class="cert-row">
      <?php foreach ($accreditations as $a): ?>
        <div class="cert-badge"><span class="dot"></span><span><?= htmlspecialchars($a) ?></span></div>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
  </div>
</section>
