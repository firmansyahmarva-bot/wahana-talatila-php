<?php
/** @var array $homepage */
$search = $homepage['search'] ?? [];
if ($search === []) {
    return;
}
?>
<section class="section tight">
  <div class="wrap">
    <div class="search-bar">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--color-ink-soft)" stroke-width="2" aria-hidden="true"><circle cx="11" cy="11" r="7"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      <input type="text" placeholder="<?= htmlspecialchars($search['placeholder'] ?? '') ?>" aria-label="<?= htmlspecialchars($search['label'] ?? 'Search') ?>">
      <button class="btn btn-primary btn-sm" type="button"><?= htmlspecialchars($search['cta_label'] ?? 'Search') ?></button>
    </div>
    <?php if (!empty($search['quick_links'])): ?>
    <div class="quick-links">
      <?php if (!empty($search['quick_links_label'])): ?><span><?= htmlspecialchars($search['quick_links_label']) ?></span><?php endif; ?>
      <?php foreach ($search['quick_links'] as $link): ?>
        <a class="chip" href="#"><?= htmlspecialchars($link) ?></a>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
  </div>
</section>
