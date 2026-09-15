<?php /** BREADCRUMB — visible trail, max depth 2 (Beranda > Pillar > Child). */
$trail = breadcrumb_trail($page);
?>
<nav class="breadcrumb" aria-label="Breadcrumb">
  <ol>
    <?php foreach ($trail as $t): ?>
    <li><?php if ($t['url']): ?><a href="<?= e($t['url']) ?>"><?= e($t['label']) ?></a><?php else: ?><span aria-current="page"><?= e($t['label']) ?></span><?php endif; ?></li>
    <?php endforeach; ?>
  </ol>
</nav>
