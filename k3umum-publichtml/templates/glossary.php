<?php
/**
 * GLOSSARY TEMPLATE — F3 only. A link SINK: every other page links into
 * this page on a term's first mention (anchored to #<term-slug>). This page
 * links back only to Home, plus out to a handful of terms that have their
 * own dedicated deep page (per ARCHITECTURE.md §Glosarium).
 */
require K3U_ROOT . '/includes/header.php';

/** slugify a term for anchor ids, e.g. 'HIRADC/HIRARC' -> 'hiradc-hirarc' */
function term_slug(string $t): string {
  $s = strtolower($t);
  $s = preg_replace('/[^a-z0-9]+/', '-', $s);
  return trim($s, '-');
}
$grouped = [];
foreach ($terms as $t) {
  $letter = strtoupper(substr($t['term'], 0, 1));
  $grouped[$letter][] = $t;
}
ksort($grouped);
?>
<div class="wrap-narrow glossary-page">
    <?php require K3U_ROOT . '/includes/breadcrumb.php'; ?>

    <header class="page-head">
      <img class="page-icon-badge" src="<?= e(img_path($page['key'])) ?>" alt="" width="64" height="64">
      <div>
        <h1><?= e($page['h1']) ?></h1>
        <?php if ($updated): ?><p class="article-meta"><?= icon('info') ?> Diperbarui <time datetime="<?= e($updated) ?>"><?= e(tgl_id($updated)) ?></time></p><?php endif; ?>
      </div>
    </header>

    <div class="article-body">
      <?= $content_html ?>
    </div>

    <?php if (!empty($grouped)): ?>
    <nav class="glossary-jump" aria-label="Lompat ke huruf">
      <?php foreach (array_keys($grouped) as $letter): ?>
      <a href="#letter-<?= e($letter) ?>"><?= e($letter) ?></a>
      <?php endforeach; ?>
    </nav>
    <?php foreach ($grouped as $letter => $items): ?>
    <section class="glossary-group">
      <h2 id="letter-<?= e($letter) ?>"><?= e($letter) ?></h2>
      <dl>
        <?php foreach ($items as $t): ?>
        <div class="glossary-item" id="<?= e(term_slug($t['term'])) ?>">
          <dt><?= e($t['term']) ?></dt>
          <dd><?= $t['def'] ?><?php if (!empty($t['link']) && isset($PAGES[$t['link']])): ?> <?= ilink($t['link'], 'Baca selengkapnya') ?><?php endif; ?></dd>
        </div>
        <?php endforeach; ?>
      </dl>
    </section>
    <?php endforeach; ?>
    <?php endif; ?>

    <?php require K3U_ROOT . '/includes/faq-block.php'; ?>
</div>
<?php require K3U_ROOT . '/includes/footer.php'; ?>
