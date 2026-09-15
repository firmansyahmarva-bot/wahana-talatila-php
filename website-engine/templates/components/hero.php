<?php
/** @var Engine\Content\ContentEntity|null $entity */
/** @var Engine\Content\ContentRepository $content */
if ($entity === null) {
    return;
}
$pillarSlug = $entity->get('pillar_slug');
$eyebrow = null;
if (is_string($pillarSlug)) {
    $pillar = $content->findPage($pillarSlug);
    $eyebrow = $pillar?->title;
} elseif ($entity->type === 'pillar') {
    $eyebrow = $entity->title;
}
?>
<div class="wrap">
<section class="page-hero">
  <?php if ($eyebrow !== null): ?><div class="eyebrow"><b><?= htmlspecialchars($eyebrow) ?></b></div><?php endif; ?>
  <h1><?= htmlspecialchars($entity->title) ?></h1>
</section>
</div>
