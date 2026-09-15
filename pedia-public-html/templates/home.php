<?php
/** HOME TEMPLATE — library front page: intro + grid of the 6 pillars. */
require SMK3_ROOT . '/includes/header.php';
$hubOrder = ['k3-dasar', 'bahaya', 'regulasi', 'kesehatan-kerja', 'lingkungan', 'studi-kasus'];
?>
<article class="article home-page">
  <div class="wrap wrap-narrow">
    <header class="article-head">
      <h1><?= e($page['h1']) ?></h1>
      <?php if ($updated): ?><p class="article-meta">Diperbarui: <time datetime="<?= e($updated) ?>"><?= e(tgl_id($updated)) ?></time></p><?php endif; ?>
    </header>

    <figure class="article-figure">
      <img src="<?= e(img_path($page['key'])) ?>" alt="<?= e($page['img_alt']) ?>" width="960" height="480" loading="eager" fetchpriority="high">
    </figure>

    <div class="article-body">
      <?= $content_html ?>
    </div>

    <section class="cluster" aria-labelledby="pilar-h">
      <h2 id="pilar-h">Enam Topik Utama</h2>
      <ol class="cluster-grid">
        <?php foreach ($hubOrder as $hk): ?>
        <li><a class="cluster-card" href="<?= e(page_url($hk)) ?>">
          <span class="cluster-num"><?= (int)$PAGES[$hk]['n'] ?></span>
          <span class="cluster-title"><?= e($SITE['hub_names'][$hk]) ?></span>
        </a></li>
        <?php endforeach; ?>
      </ol>
    </section>

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
</article>
<?php require SMK3_ROOT . '/includes/footer.php'; ?>
