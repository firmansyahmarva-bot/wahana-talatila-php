<?php
/** @var array $homepage */
$faq = $homepage['faq'] ?? [];
$items = $faq['items'] ?? [];
if ($items === []) {
    return;
}
?>
<section class="section" id="faq">
  <div class="wrap">
    <div class="section-head">
      <div>
        <h2><?= htmlspecialchars($faq['heading'] ?? '') ?></h2>
      </div>
      <?php if (!empty($faq['link_label'])): ?>
        <a class="section-link" href="/faq"><?= htmlspecialchars($faq['link_label']) ?></a>
      <?php endif; ?>
    </div>
    <div class="faq-list">
      <?php foreach ($items as $f): ?>
        <details class="faq-item">
          <summary><?= htmlspecialchars($f['q'] ?? '') ?><span class="plus">+</span></summary>
          <div class="a"><?= htmlspecialchars($f['a'] ?? '') ?></div>
        </details>
      <?php endforeach; ?>
    </div>
  </div>
</section>
