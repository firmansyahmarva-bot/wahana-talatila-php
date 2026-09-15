<?php
/** @var array $manifest */
/** @var array $nav */
$brand = $manifest['brand'] ?? $manifest['name'] ?? '';
$logo = $manifest['logo'] ?? null;
$hasLogoImage = is_string($logo) && (str_starts_with($logo, 'http://') || str_starts_with($logo, 'https://') || str_starts_with($logo, '/'));
$phoneHref = $manifest['contact']['phone_href'] ?? null;
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
    <?php if ($phoneHref !== null): ?>
    <div class="header-cta">
      <a class="btn btn-primary btn-sm" href="https://wa.me/<?= htmlspecialchars($phoneHref) ?>">Chat WhatsApp</a>
    </div>
    <?php endif; ?>
  </div>
</header>
