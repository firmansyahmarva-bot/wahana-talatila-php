<?php
/**
 * "Artikel Terkait" section for hub pages.
 *
 * Include this in any hub page to show related articles from the DB.
 *
 * Before including, set $hub_article_cats to the article category strings:
 *   $hub_article_cats = ['K3'];
 *   include __DIR__ . '/includes/hub-artikel-terkait.php';
 *
 * Or use the hub-category-map:
 *   require_once __DIR__ . '/includes/hub-category-map.php';
 *   $hub_article_cats = $HUB_CATEGORY_MAP['k3']['article_cats'];
 *   include __DIR__ . '/includes/hub-artikel-terkait.php';
 */

if (!empty($hub_article_cats) && isset($pdo)) {
    $placeholders = implode(',', array_fill(0, count($hub_article_cats), '?'));
    $art_stmt = $pdo->prepare("
        SELECT title, slug, meta_desc, published_at
        FROM articles
        WHERE category IN ($placeholders) AND status = 'published'
        ORDER BY published_at DESC LIMIT 4
    ");
    $art_stmt->execute($hub_article_cats);
    $hub_articles = $art_stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($hub_articles)):
?>
<section class="hub-artikel-terkait" style="padding:3rem 0;background:#f8f9fa">
  <div class="container">
    <h2 style="text-align:center;margin:0 0 1.5rem;font-size:1.4rem;color:#1a1a1a">Artikel Terkait</h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:1.5rem;max-width:1000px;margin:0 auto">
      <?php foreach ($hub_articles as $ha): ?>
      <div style="background:#fff;border:1px solid #e0e0e0;border-radius:8px;padding:1.25rem">
        <a href="/artikel/<?= e($ha['slug']) ?>/" style="color:#1a5276;text-decoration:none;font-weight:600;font-size:1rem;line-height:1.4;display:block"><?= e($ha['title']) ?></a>
        <?php if (!empty($ha['published_at'])): ?>
        <div style="font-size:.8rem;color:#888;margin:.5rem 0"><?= date('d M Y', strtotime($ha['published_at'])) ?></div>
        <?php endif; ?>
        <?php if (!empty($ha['meta_desc'])): ?>
        <p style="color:#555;font-size:.9rem;margin:.5rem 0 0;line-height:1.5"><?= e(mb_substr($ha['meta_desc'], 0, 120)) ?>…</p>
        <?php endif; ?>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php
    endif;
}
?>
