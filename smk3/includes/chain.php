<?php
/**
 * CHAIN — prev/next crawl-chain navigation, generated from the manifest.
 * This is the closed-loop path: Home → Hub1 … → #50 → Home.
 */
$prevKey = $page['prev'];
$nextKey = $page['next'];
if ($prevKey === '' && $nextKey === '') return;
?>
<nav class="chain" aria-label="Navigasi artikel berurutan">
  <?php if ($prevKey !== '' && isset($PAGES[$prevKey])): ?>
  <a class="chain-prev" href="<?= e(page_url($prevKey)) ?>" rel="prev">
    <span class="chain-label">&larr; Sebelumnya</span>
    <span class="chain-title"><?= e($PAGES[$prevKey]['h1']) ?></span>
  </a>
  <?php endif; ?>
  <?php if ($nextKey !== '' && isset($PAGES[$nextKey])): ?>
  <a class="chain-next" href="<?= e(page_url($nextKey)) ?>" rel="next">
    <span class="chain-label">Lanjut membaca &rarr;</span>
    <span class="chain-title"><?= e($PAGES[$nextKey]['h1']) ?></span>
  </a>
  <?php endif; ?>
</nav>
