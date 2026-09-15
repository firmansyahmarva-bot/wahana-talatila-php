<?php
/** @var array $manifest */
/** @var array $footerNav */
/** @var array $homepage */
$brand = $manifest['brand'] ?? $manifest['name'] ?? '';
$logo = $manifest['logo'] ?? null;
$hasLogoImage = is_string($logo) && (str_starts_with($logo, 'http://') || str_starts_with($logo, 'https://') || str_starts_with($logo, '/'));
$footer = $homepage['footer'] ?? [];
$columns = $footer['columns'] ?? [];
$contact = $manifest['contact'] ?? [];
$socials = $manifest['social'] ?? [];
?>
<footer class="site">
  <div class="wrap">
    <div class="footer-top">
      <div class="footer-brand">
        <a class="logo" href="/">
          <?php if ($hasLogoImage): ?>
            <img src="<?= htmlspecialchars($logo) ?>" alt="<?= htmlspecialchars($brand) ?> logo">
          <?php else: ?>
            <span class="mark"><?= htmlspecialchars(strtoupper(substr($brand, 0, 1))) ?></span>
          <?php endif; ?>
          <?= htmlspecialchars($brand) ?>
        </a>
        <?php if (!empty($footer['brand_description'])): ?>
          <p><?= htmlspecialchars($footer['brand_description']) ?></p>
        <?php endif; ?>
      </div>
      <?php foreach ($columns as $col): ?>
        <div class="footer-col">
          <h4><?= htmlspecialchars($col['title'] ?? '') ?></h4>
          <ul>
            <?php foreach (($col['links'] ?? []) as $link): ?>
              <li><a href="<?= htmlspecialchars($link['href'] ?? '#') ?>"><?= htmlspecialchars($link['label'] ?? '') ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endforeach; ?>
      <?php if ($contact !== []): ?>
        <div class="footer-col">
          <h4>Contact</h4>
          <ul>
            <?php if (!empty($contact['email'])): ?>
              <li><a href="mailto:<?= htmlspecialchars($contact['email']) ?>"><?= htmlspecialchars($contact['email']) ?></a></li>
            <?php endif; ?>
            <?php if (!empty($contact['phone'])): ?>
              <li><a href="tel:<?= htmlspecialchars($contact['phone_href'] ?? $contact['phone']) ?>"><?= htmlspecialchars($contact['phone']) ?></a></li>
            <?php endif; ?>
            <?php if (!empty($contact['address'])): ?>
              <li><?= htmlspecialchars($contact['address']) ?></li>
            <?php endif; ?>
          </ul>
        </div>
      <?php endif; ?>
    </div>
    <div class="footer-bottom">
      <span>&copy; <?= date('Y') ?> <?= htmlspecialchars($brand) ?>. All rights reserved.</span>
      <?php if ($socials !== []): ?>
      <div class="socials">
        <?php foreach ($socials as $s): ?>
          <a href="<?= htmlspecialchars($s['href'] ?? '#') ?>" aria-label="<?= htmlspecialchars($s['label'] ?? '') ?>"><?= htmlspecialchars($s['icon'] ?? '') ?></a>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </div>
  </div>
</footer>
