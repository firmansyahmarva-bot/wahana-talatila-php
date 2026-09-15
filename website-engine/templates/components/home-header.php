<?php
/** @var array $manifest */
/** @var array $nav */
/** @var array $homepage */
$brand = $manifest['brand'] ?? $manifest['name'] ?? '';
$logo = $manifest['logo'] ?? null;
$hasLogoImage = is_string($logo) && (str_starts_with($logo, 'http://') || str_starts_with($logo, 'https://') || str_starts_with($logo, '/'));
$headerCta = $homepage['header_cta'] ?? [];
?>
<header class="site">
  <div class="header-inner">
    <a class="logo" href="/">
      <?php if ($hasLogoImage): ?>
        <img src="<?= htmlspecialchars($logo) ?>" alt="<?= htmlspecialchars($brand) ?> logo">
      <?php else: ?>
        <span class="mark"><?= htmlspecialchars(strtoupper(substr($brand, 0, 1))) ?></span>
      <?php endif; ?>
      <?= htmlspecialchars($brand) ?>
    </a>
    <nav class="primary">
      <?php foreach (($nav['items'] ?? []) as $item): ?>
        <a href="<?= htmlspecialchars($item['path']) ?>"><?= htmlspecialchars($item['label']) ?></a>
      <?php endforeach; ?>
    </nav>
    <div class="header-cta">
      <?php if (!empty($headerCta['secondary'])): ?>
        <a class="ghost-link" href="<?= htmlspecialchars($headerCta['secondary']['href'] ?? '#') ?>">
          <?= htmlspecialchars($headerCta['secondary']['label'] ?? '') ?>
        </a>
      <?php endif; ?>
      <?php if (!empty($headerCta['primary'])): ?>
        <a class="btn btn-primary btn-sm" href="<?= htmlspecialchars($headerCta['primary']['href'] ?? '#') ?>">
          <?= htmlspecialchars($headerCta['primary']['label'] ?? '') ?>
        </a>
      <?php endif; ?>
    </div>
  </div>
</header>
