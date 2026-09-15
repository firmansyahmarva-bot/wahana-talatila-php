<?php
/** HUB TEMPLATE — silo pillar pages with real children: A, B, C, E. */
require K3U_ROOT . '/includes/header.php';
$toc = build_toc($content_html);
$children = pillar_children($page['key']);
$hasToc = count($toc) > 2;
?>
<div class="wrap-article">
  <?php require K3U_ROOT . '/includes/breadcrumb.php'; ?>

  <header class="page-head">
    <img class="page-icon-badge" src="<?= e(img_path($page['key'])) ?>" alt="" width="64" height="64">
    <div>
      <h1><?= e($page['h1']) ?></h1>
      <p class="article-meta">
        <?php if ($updated): ?><span class="meta-item"><?= icon('info') ?> Diperbarui <time datetime="<?= e($updated) ?>"><?= e(tgl_id($updated)) ?></time></span><?php endif; ?>
        <span class="meta-item"><?= icon('clock') ?> <?= reading_time($content_html) ?> menit baca</span>
      </p>
      <p class="reviewer-byline">
        <span class="rb-avatar"><?= e(substr($SITE['author']['name'], 0, 1)) ?></span>
        Ditinjau oleh <strong><?= e($SITE['author']['name']) ?></strong>, <?= e($SITE['author']['title']) ?> <?= icon('check', 'rb-check') ?>
      </p>
    </div>
  </header>

  <?php if ($hasToc): ?>
  <details class="toc toc-mobile" open>
    <summary>Daftar Isi <span class="chev"><?= icon('chevron-right') ?></span></summary>
    <ol>
      <?php foreach ($toc as $t): ?><li><a href="#<?= e($t['id']) ?>"><?= e($t['text']) ?></a></li><?php endforeach; ?>
    </ol>
  </details>
  <?php endif; ?>

  <div class="page-layout<?= $hasToc ? ' has-toc' : '' ?>">
    <div class="page-main">
      <div class="article-body">
        <?= $content_html ?>
      </div>

      <section class="cluster" aria-labelledby="cluster-h">
        <h2 id="cluster-h">Semua Halaman dalam Topik Ini</h2>
        <ol class="cluster-grid">
          <?php foreach ($children as $ck => $cp): ?>
          <li><a class="cluster-card" href="<?= e(page_url($ck)) ?>">
            <span class="cc-icon"><?= icon(page_icon_name($ck)) ?></span>
            <span class="cluster-title"><?= e($cp['h1']) ?></span>
            <span class="cc-arrow"><?= icon('chevron-right') ?></span>
          </a></li>
          <?php endforeach; ?>
        </ol>
      </section>

      <?php require K3U_ROOT . '/includes/howto-block.php'; ?>
      <?php require K3U_ROOT . '/includes/faq-block.php'; ?>
      <?php require K3U_ROOT . '/includes/cta.php'; ?>
      <?php require K3U_ROOT . '/includes/related.php'; ?>
    </div>

    <?php if ($hasToc): ?>
    <aside class="toc-sidebar toc-desktop">
      <details class="toc" open>
        <summary>Daftar Isi</summary>
        <ol>
          <?php foreach ($toc as $t): ?><li><a href="#<?= e($t['id']) ?>"><?= e($t['text']) ?></a></li><?php endforeach; ?>
        </ol>
      </details>
    </aside>
    <?php endif; ?>
  </div>
</div>
<?php require K3U_ROOT . '/includes/footer.php'; ?>
