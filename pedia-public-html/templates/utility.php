<?php
/** UTILITY TEMPLATE — editorial/legal/contributor pages. Indexable, no chain. */
require SMK3_ROOT . '/includes/header.php';
$toc = build_toc($content_html);
?>
<article class="article">
  <div class="wrap wrap-narrow">
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <ol>
        <li><a href="/">Beranda</a></li>
        <li aria-current="page"><?= e($page['h1']) ?></li>
      </ol>
    </nav>

    <header class="article-head">
      <h1><?= e($page['h1']) ?></h1>
      <?php if ($updated): ?><p class="article-meta">Diperbarui: <time datetime="<?= e($updated) ?>"><?= e(tgl_id($updated)) ?></time></p><?php endif; ?>
    </header>

    <?php if (count($toc) > 3): ?>
    <nav class="toc" aria-labelledby="toc-h">
      <h2 id="toc-h">Daftar Isi</h2>
      <ol>
        <?php foreach ($toc as $t): ?>
        <li><a href="#<?= e($t['id']) ?>"><?= e($t['text']) ?></a></li>
        <?php endforeach; ?>
      </ol>
    </nav>
    <?php endif; ?>

    <div class="article-body">
      <?= $content_html ?>
    </div>

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
  </div>
</article>
<?php require SMK3_ROOT . '/includes/footer.php'; ?>
