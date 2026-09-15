<?php /** RELATED — "Baca Juga" box, up to 3 keys from config/pages.php 'related'. */
$rel = $page['related'] ?? [];
if (!empty($rel)):
?>
<section class="related" aria-labelledby="related-h">
  <h2 id="related-h">Baca Juga</h2>
  <ul class="related-grid">
    <?php foreach ($rel as $rk): if (!isset($PAGES[$rk])) continue; ?>
    <li><a class="related-card" href="<?= e(page_url($rk)) ?>">
      <span class="cc-icon"><?= icon(page_icon_name($rk)) ?></span>
      <span><?= e($PAGES[$rk]['h1']) ?></span>
    </a></li>
    <?php endforeach; ?>
  </ul>
</section>
<?php endif; ?>
