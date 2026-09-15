<?php
/** @var array $manifest */
/** @var array $seo */
/** @var array $nav */
/** @var array $footerNav */
/** @var array $slots */
/** @var Engine\Render\TemplateEngine $templates */
/** @var string $theme */
/** @var string $bodyHtml */
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($seo['meta']['title'] ?? $manifest['brand'] ?? '') ?></title>
  <meta name="description" content="<?= htmlspecialchars($seo['meta']['description'] ?? '') ?>">
  <link rel="canonical" href="<?= htmlspecialchars($seo['canonical'] ?? '') ?>">
  <link rel="stylesheet" href="/assets/theme-<?= htmlspecialchars($theme) ?>.css">
  <link rel="stylesheet" href="/assets/site.css">
  <?php if (!empty($seo['schema'])): ?>
  <script type="application/ld+json"><?= json_encode($seo['schema'], JSON_UNESCAPED_SLASHES) ?></script>
  <?php endif; ?>
  <?php if (!empty($seo['breadcrumbs'])): ?>
  <script type="application/ld+json"><?= json_encode($seo['breadcrumbs'], JSON_UNESCAPED_SLASHES) ?></script>
  <?php endif; ?>
</head>
<body style="font-family:var(--font-body);color:var(--color-text);background:var(--color-background);margin:0;">
<a class="skip-link" href="#main">Skip to content</a>
<?php foreach ($slots as $slot): ?>
  <?php if (str_ends_with($slot, 'header')): ?>
    <?= $templates->renderComponent($slot, get_defined_vars()) ?>
  <?php endif; ?>
<?php endforeach; ?>
<main id="main">
<?php foreach ($slots as $slot): ?>
  <?php if (str_ends_with($slot, 'header') || str_ends_with($slot, 'footer')): ?>
    <?php continue; ?>
  <?php endif; ?>
  <?php if ($slot === 'content'): ?>
    <?= $bodyHtml ?? '' ?>
  <?php else: ?>
    <?= $templates->renderComponent($slot, get_defined_vars()) ?>
  <?php endif; ?>
<?php endforeach; ?>
</main>
<?php foreach ($slots as $slot): ?>
  <?php if (str_ends_with($slot, 'footer')): ?>
    <?= $templates->renderComponent($slot, get_defined_vars()) ?>
  <?php endif; ?>
<?php endforeach; ?>
</body>
</html>
