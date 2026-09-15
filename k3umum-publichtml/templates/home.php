<?php
/** HOME TEMPLATE — master pillar: hero + links to all 9 depth-1 pages. */
require K3U_ROOT . '/includes/header.php';
$toc = build_toc($content_html);
$pillars = all_pillars();
?>
<div class="wrap-article">
  <section class="hero">
    <span class="hero-eyebrow"><span class="dot"></span> Panduan Resmi &amp; Terus Diperbarui — 2026</span>
    <h1><?= e($page['h1']) ?></h1>
    <p class="lead"><?= e($page['meta']) ?></p>
    <p class="reviewer-byline" style="position:relative">
      <span class="rb-avatar"><?= e(substr($SITE['author']['name'], 0, 1)) ?></span>
      Ditinjau oleh <strong><?= e($SITE['author']['name']) ?></strong>, <?= e($SITE['author']['title']) ?> <?= icon('check', 'rb-check') ?>
    </p>
    <div class="hero-stats">
      <div class="hero-stat"><b>25</b><span>Panduan lengkap, satu topik utuh</span></div>
      <div class="hero-stat"><b>6</b><span>Area: hukum, sertifikasi, praktik, industri, data</span></div>
      <div class="hero-stat"><b>100%</b><span>Ditinjau praktisi HSE bersertifikat</span></div>
    </div>
  </section>

  <div class="wrap-narrow" style="padding:0">
  <?php if (count($toc) > 2): ?>
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
  </div>

  <section class="cluster pillar-grid" aria-labelledby="pillar-h">
    <h2 id="pillar-h">Jelajahi Semua Topik</h2>
    <ol class="cluster-grid">
      <?php foreach ($pillars as $pk => $pp): ?>
      <li><a class="cluster-card" href="<?= e(page_url($pk)) ?>">
        <span class="cc-icon"><?= icon(page_icon_name($pk)) ?></span>
        <span class="cluster-title"><?= e($pp['h1']) ?></span>
        <span class="cc-arrow"><?= icon('chevron-right') ?></span>
      </a></li>
      <?php endforeach; ?>
    </ol>
  </section>

  <div class="wrap-narrow" style="padding:0">
  <?php require K3U_ROOT . '/includes/faq-block.php'; ?>
  <?php require K3U_ROOT . '/includes/cta.php'; ?>
  </div>
</div>
<?php require K3U_ROOT . '/includes/footer.php'; ?>
