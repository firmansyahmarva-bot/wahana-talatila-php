<?php
/** @var array $manifest */
/** @var array $homepage */
$hero = $homepage['hero'] ?? [];
$brand = $manifest['brand'] ?? $manifest['name'] ?? '';
if ($hero === []) {
    return;
}
?>
<section class="hero">
  <div class="grid-field"></div>
  <div class="hero-inner">
    <div>
      <div class="eyebrow"><b><?= htmlspecialchars($brand) ?></b> <?= htmlspecialchars($hero['eyebrow'] ?? '') ?></div>
      <h1>
        <?php foreach (($hero['heading_lines'] ?? []) as $i => $line): ?>
          <?= $i > 0 ? '<br>' : '' ?><?= htmlspecialchars($line) ?>
        <?php endforeach; ?>
        <?php if (!empty($hero['heading_accent'])): ?>
          <em><?= htmlspecialchars($hero['heading_accent']) ?></em>
        <?php endif; ?>
      </h1>
      <p class="lede"><?= htmlspecialchars($hero['lede'] ?? '') ?></p>
      <div class="actions">
        <?php foreach (($hero['actions'] ?? []) as $action): ?>
          <a class="btn btn-<?= htmlspecialchars($action['style'] ?? 'primary') ?>" href="<?= htmlspecialchars($action['href'] ?? '#') ?>">
            <?= htmlspecialchars($action['label'] ?? '') ?>
          </a>
        <?php endforeach; ?>
      </div>
      <?php if (!empty($hero['meta'])): ?>
      <div class="meta-row">
        <?php foreach ($hero['meta'] as $m): ?>
          <div><b><?= htmlspecialchars($m['value'] ?? '') ?></b><?= htmlspecialchars($m['label'] ?? '') ?></div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </div>
    <div class="hero-art" aria-hidden="true">
      <svg viewBox="0 0 400 400" xmlns="http://www.w3.org/2000/svg">
        <defs>
          <pattern id="dotgrid" width="24" height="24" patternUnits="userSpaceOnUse">
            <circle cx="1" cy="1" r="1" fill="var(--color-line-strong)"/>
          </pattern>
        </defs>
        <rect width="400" height="400" fill="url(#dotgrid)"/>
        <circle cx="200" cy="200" r="120" fill="none" stroke="var(--color-line-strong)" stroke-width="1"/>
        <circle cx="200" cy="200" r="86" fill="var(--color-accent-soft)" stroke="var(--color-home-accent)" stroke-width="1.5"/>
        <g stroke="var(--color-home-accent)" stroke-width="2" fill="var(--color-card)">
          <circle cx="200" cy="118" r="9"/>
          <circle cx="288" cy="230" r="9"/>
          <circle cx="140" cy="270" r="9"/>
          <circle cx="252" cy="150" r="6"/>
        </g>
        <g stroke="var(--color-ink-soft)" stroke-width="1" opacity="0.6">
          <line x1="200" y1="118" x2="252" y2="150"/>
          <line x1="252" y1="150" x2="288" y2="230"/>
          <line x1="288" y1="230" x2="140" y2="270"/>
          <line x1="140" y1="270" x2="200" y2="118"/>
        </g>
        <rect x="164" y="182" width="72" height="36" rx="6" fill="var(--color-card)" stroke="var(--color-home-accent)" stroke-width="1.5"/>
      </svg>
    </div>
  </div>
</section>
