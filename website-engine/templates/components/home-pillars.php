<?php
/** @var array $homepage */
$pillars = $homepage['pillars'] ?? [];
$items = $pillars['items'] ?? [];
if ($items === []) {
    return;
}
?>
<section class="section">
  <div class="wrap">
    <div class="section-head">
      <div>
        <h2><?= htmlspecialchars($pillars['heading'] ?? '') ?></h2>
        <?php if (!empty($pillars['desc'])): ?><p class="desc"><?= htmlspecialchars($pillars['desc']) ?></p><?php endif; ?>
      </div>
    </div>
    <div class="pillars">
      <?php foreach ($items as $p): ?>
        <div class="pillar-card">
          <div class="swatch" aria-hidden="true">
            <svg width="46" height="46" viewBox="0 0 24 24" fill="none" stroke="var(--color-ink-soft)" stroke-width="1.2"><rect x="3" y="3" width="18" height="18" rx="3"/><path d="M3 15l4-4 4 4 5-6 5 5"/></svg>
          </div>
          <div class="tag"><?= htmlspecialchars($p['tag'] ?? '') ?></div>
          <h3><?= htmlspecialchars($p['name'] ?? '') ?></h3>
          <p class="desc"><?= htmlspecialchars($p['desc'] ?? '') ?></p>
          <div class="card-foot">Learn more →</div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
