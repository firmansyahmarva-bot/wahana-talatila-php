<?php
/** HUB TEMPLATE — pillar pages: article layout + cluster grid of children. */
require SMK3_ROOT . '/includes/header.php';
$toc = build_toc($content_html);
$children = hub_children($page['hub']);
?>
<article class="article hub-page">
  <div class="wrap wrap-narrow">
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <ol>
        <li><a href="/">Beranda</a></li>
        <li aria-current="page"><?= e($SITE['hub_names'][$page['hub']]) ?></li>
      </ol>
    </nav>

    <header class="article-head">
      <h1><?= e($page['h1']) ?></h1>
      <?php if ($updated): ?><p class="article-meta">Ditulis oleh Redaksi <?= e($SITE['site_name']) ?> · Diperbarui: <time datetime="<?= e($updated) ?>"><?= e(tgl_id($updated)) ?></time></p><?php endif; ?>
    </header>

    <figure class="article-figure">
      <img src="<?= e(img_path($page['key'])) ?>" alt="<?= e($page['img_alt']) ?>" width="960" height="480" loading="eager" fetchpriority="high">
    </figure>

    <div class="article-body">
      <?= $content_html ?>
    </div>

    <section class="cluster" aria-labelledby="cluster-h">
      <h2 id="cluster-h">Semua Entri dalam Topik Ini</h2>
      <ol class="cluster-grid">
        <?php foreach ($children as $ck => $cp): ?>
        <li><a class="cluster-card" href="<?= e(page_url($ck)) ?>">
          <span class="cluster-num"><?= (int)$cp['n'] ?></span>
          <span class="cluster-title"><?= e($cp['h1']) ?></span>
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
