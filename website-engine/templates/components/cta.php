<?php
/** @var array $relatedLinks */
/** @var array $manifest */
$phoneHref = $manifest['contact']['phone_href'] ?? null;
$brand = $manifest['brand'] ?? $manifest['name'] ?? '';
?>
<div class="wrap">

<?php if ($phoneHref !== null): ?>
<section class="cta-band">
  <div>
    <h3>Ada pertanyaan?</h3>
    <p>Hubungi <?= htmlspecialchars($brand) ?> lewat WhatsApp, biasanya dibalas dalam satu hari kerja.</p>
  </div>
  <a class="btn btn-primary" href="https://wa.me/<?= htmlspecialchars($phoneHref) ?>">Chat WhatsApp</a>
</section>
<?php endif; ?>

<?php if (!empty($relatedLinks)): ?>
<section class="related">
  <h2>Related</h2>
  <div class="grid grid-3">
    <?php foreach ($relatedLinks as $link): ?>
      <?= $templates->renderComponent('card', ['title' => $link['title'], 'href' => '/' . $link['slug']]) ?>
    <?php endforeach; ?>
  </div>
</section>
<?php endif; ?>

</div>
