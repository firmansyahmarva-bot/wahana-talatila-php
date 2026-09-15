<?php
/**
 * MONEY TEMPLATE — conversion pages (home, jasa, audit, harga, kontak).
 * Content files control their own section layout; this template provides
 * the shell, FAQ, related links, and (for home) the chain into Hub 1.
 */
require SMK3_ROOT . '/includes/header.php';
$isHome = $page['key'] === 'home';
?>
<div class="money <?= $isHome ? 'is-home' : '' ?>">
  <?php if (!$isHome): ?>
  <div class="wrap wrap-narrow">
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <ol>
        <li><a href="/">Beranda</a></li>
        <li aria-current="page"><?= e($page['h1']) ?></li>
      </ol>
    </nav>
  </div>
  <?php endif; ?>

  <?= $content_html ?>

  <div class="wrap wrap-narrow">
    <?php if (!empty($faq)): ?>
    <section class="faq" aria-labelledby="faq-h">
      <h2 id="faq-h">Pertanyaan yang Sering Diajukan</h2>
      <?php foreach ($faq as $qa): ?>
      <details class="faq-item">
        <summary><?= e($qa['q']) ?></summary>
        <p><?= e($qa['a']) ?></p>
      </details>
      <?php endforeach; ?>
    </section>
    <?php endif; ?>

    <?php require SMK3_ROOT . '/includes/related.php'; ?>
    <?php require SMK3_ROOT . '/includes/chain.php'; ?>
  </div>
</div>
<?php require SMK3_ROOT . '/includes/footer.php'; ?>
