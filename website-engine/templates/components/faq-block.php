<?php
/** @var array $faqs */
?>
<section style="padding:var(--space-lg);">
  <h2 style="font-family:var(--font-heading);">FAQ</h2>
  <?php foreach (($faqs ?? []) as $faq): ?>
    <div style="margin-bottom:var(--space-md);">
      <strong><?= htmlspecialchars($faq['question'] ?? '') ?></strong>
      <p><?= htmlspecialchars($faq['answer'] ?? '') ?></p>
    </div>
  <?php endforeach; ?>
</section>
