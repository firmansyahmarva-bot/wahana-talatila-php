<?php /** HOWTO BLOCK — visible numbered steps for step-by-step pages (e.g. A3, C2). */
if (!empty($howto)):
?>
<section class="howto" aria-labelledby="howto-h">
  <h2 id="howto-h"><?= e($howto['name'] ?? $page['h1']) ?></h2>
  <ol class="howto-steps">
    <?php foreach ($howto['steps'] as $i => $s): ?>
    <li>
      <span class="step-num"><?= $i + 1 ?></span>
      <div><?php if (is_array($s)): ?><strong><?= e($s['name']) ?></strong><?= isset($s['text']) ? '<p>' . e($s['text']) . '</p>' : '' ?><?php else: ?><?= e($s) ?><?php endif; ?></div>
    </li>
    <?php endforeach; ?>
  </ol>
</section>
<?php endif; ?>
