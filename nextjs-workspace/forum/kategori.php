<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/forum-functions.php';

$slug = get_url_slug();
if (!$slug) { redirect(SITE_URL . '/forum/'); }

$s  = get_all_settings();

// Load category
try {
    $pdo = get_pdo();
    $cat = $pdo->prepare('SELECT * FROM forum_categories WHERE slug=? AND is_active=1');
    $cat->execute([$slug]);
    $cat = $cat->fetch();
} catch (Exception $ex) { $cat = null; }

if (!$cat) { redirect(SITE_URL . '/forum/'); }

// Pagination
$page    = max(1, (int)($_GET['p'] ?? 1));
$perPage = 20;
$offset  = ($page - 1) * $perPage;

$topics = get_forum_topics(['category_id' => $cat['id'], 'limit' => $perPage, 'offset' => $offset, 'status' => 'approved']);
$total  = $cat['topic_count'] ?? count($topics);
$pages  = ceil($total / $perPage);

$allCats = get_forum_categories();

$metaTitle = 'Forum ' . $cat['name'] . ' — Diskusi K3 Indonesia | Wahana Totalita';
$metaDesc  = ($cat['description'] ?: 'Diskusi ' . $cat['name'] . ' bersama profesional K3 dan HSE Indonesia') . ' | Forum Wahana Totalita';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($metaTitle) ?></title>
<meta name="description" content="<?= e($metaDesc) ?>">
<link rel="canonical" href="<?= SITE_URL ?>/forum/<?= e($cat['slug']) ?>/">
<style><?php
$_core_css_file = __DIR__ . '/../assets/css/core.min.css';
if (is_file($_core_css_file)) {
    readfile($_core_css_file);
} else {
    readfile(__DIR__ . '/../assets/css/tokens.css');
    readfile(__DIR__ . '/../assets/css/core.css');
}
?></style>
<link rel="stylesheet" href="<?= asset_v('/assets/css/components.min.css') ?>" media="print" onload="this.media='all'">
<noscript><link rel="stylesheet" href="<?= asset_v('/assets/css/components.min.css') ?>"></noscript>
<?= theme_css_vars($s) ?>
<style>
.cat-hero{background:linear-gradient(135deg,var(--green),#1a5c3a);padding:48px 0;color:#fff}
.cat-hero .crumb{font-size:.8rem;opacity:.7;margin-bottom:12px}
.cat-hero .crumb a{color:#fff;text-decoration:none}
.cat-hero h1{font-size:clamp(1.6rem,3.5vw,2.2rem);font-weight:800;margin:0 0 8px}
.cat-hero p{margin:0;opacity:.8;font-size:.95rem}
.cat-meta{display:flex;gap:24px;margin-top:16px;flex-wrap:wrap}
.cat-meta span{font-size:.8rem;opacity:.7}
.content{padding:40px 0}
.layout{display:grid;grid-template-columns:1fr 280px;gap:28px}
.topics-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:16px}
.topics-header h2{font-size:1rem;font-weight:700;margin:0}
.topic-card{background:#fff;border-radius:10px;border:1px solid #eee;padding:16px 20px;margin-bottom:10px;display:flex;gap:16px;align-items:flex-start;box-shadow:0 1px 4px rgba(0,0,0,.04);transition:.2s}
.topic-card:hover{box-shadow:0 4px 16px rgba(0,0,0,.08);transform:translateY(-1px)}
.avatar{width:40px;height:40px;border-radius:50%;background:var(--green);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:1rem;flex-shrink:0}
.topic-title{font-weight:600;font-size:.95rem;color:#1a1a1a;text-decoration:none;line-height:1.4;display:block;margin-bottom:4px}
.topic-title:hover{color:var(--green)}
.topic-meta{font-size:.78rem;color:#999}
.topic-meta a{color:var(--green);text-decoration:none}
.topic-stats{text-align:center;flex-shrink:0;min-width:52px}
.topic-stats strong{display:block;font-size:1.1rem;font-weight:800;color:#333}
.topic-stats span{font-size:.72rem;color:#999}
.badge{display:inline-block;padding:2px 8px;border-radius:100px;font-size:.72rem;font-weight:700;margin-left:8px}
.badge-pinned{background:#fef3c7;color:#92400e}
.sidebar-card{background:#fff;border-radius:12px;border:1px solid #eee;padding:20px;margin-bottom:16px}
.sidebar-card h3{font-size:.95rem;font-weight:700;margin:0 0 14px;color:var(--green)}
.cat-link{display:flex;gap:12px;align-items:center;padding:8px 0;border-bottom:1px solid #f0f0f0;text-decoration:none;color:#333;font-size:.85rem}
.cat-link:last-child{border-bottom:none}
.cat-link:hover{color:var(--green)}
.cat-link.active{color:var(--green);font-weight:700}
.pagination{display:flex;gap:8px;justify-content:center;margin-top:24px;flex-wrap:wrap}
.pagination a,.pagination span{display:inline-block;padding:8px 14px;border-radius:8px;font-size:.875rem;text-decoration:none;border:1px solid #eee;background:#fff;color:#333}
.pagination a:hover{background:var(--green);color:#fff;border-color:var(--green)}
.pagination .current{background:var(--green);color:#fff;border-color:var(--green)}
.empty{text-align:center;padding:60px 20px;color:#999}
@media(max-width:768px){.layout{grid-template-columns:1fr}}
</style>
</head>
<body>
<?php include __DIR__ . '/../includes/navbar.php'; ?>

<div class="cat-hero">
  <div class="container">
    <div class="crumb"><a href="/">Home</a> › <a href="/forum/">Forum</a> › <?= e($cat['name']) ?></div>
    <h1><?= e($cat['icon'] ?? '💬') ?> <?= e($cat['name']) ?></h1>
    <?php if ($cat['description']): ?><p><?= e($cat['description']) ?></p><?php endif; ?>
    <div class="cat-meta">
      <span>📝 <?= number_format($cat['topic_count'] ?? 0) ?> topik</span>
      <span>💬 <?= number_format($cat['reply_count'] ?? 0) ?> balasan</span>
    </div>
  </div>
</div>

<div class="content">
  <div class="container">
    <div class="layout">
      <div>
        <div class="topics-header">
          <h2>Semua Topik</h2>
          <a href="/forum/buat/?category=<?= $cat['id'] ?>" style="background:var(--orange);color:#fff;padding:8px 16px;border-radius:8px;text-decoration:none;font-weight:600;font-size:.875rem">✏️ Buat Topik</a>
        </div>

        <?php if (empty($topics)): ?>
        <div class="empty">
          <p style="font-size:2rem;margin-bottom:12px">💬</p>
          <p>Belum ada topik di kategori ini.</p>
          <a href="/forum/buat/?category=<?= $cat['id'] ?>" style="display:inline-block;margin-top:8px;background:var(--orange);color:#fff;padding:10px 20px;border-radius:8px;text-decoration:none;font-weight:600">Mulai Diskusi Pertama</a>
        </div>
        <?php else: ?>

        <?php foreach ($topics as $t): ?>
        <div class="topic-card">
          <div class="avatar"><?= mb_substr($t['author_name'] ?? 'A', 0, 1) ?></div>
          <div style="flex:1;min-width:0">
            <a href="/forum/topik/<?= e($t['slug']) ?>/" class="topic-title">
              <?= e(mb_substr($t['title'], 0, 90)) ?>
              <?php if ($t['is_pinned'] ?? false): ?><span class="badge badge-pinned">📌 Pinned</span><?php endif; ?>
            </a>
            <div class="topic-meta">
              oleh <strong><?= e($t['author_name']) ?></strong> ·
              <?= time_ago($t['created_at']) ?>
              <?php if (!empty($t['last_reply_at'])): ?> · Balasan terakhir <?= time_ago($t['last_reply_at']) ?><?php endif; ?>
            </div>
          </div>
          <div class="topic-stats">
            <strong><?= $t['reply_count'] ?? 0 ?></strong>
            <span>balasan</span>
            <?php if (($t['view_count'] ?? 0) > 0): ?>
            <div style="margin-top:4px"><strong><?= number_format($t['view_count']) ?></strong><span> views</span></div>
            <?php endif; ?>
          </div>
        </div>
        <?php endforeach; ?>

        <!-- Pagination -->
        <?php if ($pages > 1): ?>
        <div class="pagination">
          <?php if ($page > 1): ?>
          <a href="/forum/<?= e($cat['slug']) ?>/?p=<?= $page-1 ?>">← Prev</a>
          <?php endif; ?>

          <?php for ($i = max(1, $page-2); $i <= min($pages, $page+2); $i++): ?>
          <?php if ($i === $page): ?>
          <span class="current"><?= $i ?></span>
          <?php else: ?>
          <a href="/forum/<?= e($cat['slug']) ?>/?p=<?= $i ?>"><?= $i ?></a>
          <?php endif; ?>
          <?php endfor; ?>

          <?php if ($page < $pages): ?>
          <a href="/forum/<?= e($cat['slug']) ?>/?p=<?= $page+1 ?>">Next →</a>
          <?php endif; ?>
        </div>
        <?php endif; ?>
        <?php endif; ?>
      </div>

      <!-- Sidebar -->
      <div>
        <div class="sidebar-card">
          <h3>✏️ Mulai Diskusi</h3>
          <p style="font-size:.85rem;color:#666;margin:0 0 14px">Punya pertanyaan K3 atau ingin berbagi pengalaman?</p>
          <a href="/forum/buat/?category=<?= $cat['id'] ?>" style="display:block;background:var(--orange);color:#fff;padding:11px;border-radius:8px;text-decoration:none;font-weight:600;text-align:center">✏️ Buat Topik Baru</a>
        </div>

        <div class="sidebar-card">
          <h3>📂 Kategori Lain</h3>
          <?php foreach ($allCats as $c): ?>
          <a href="/forum/<?= e($c['slug']) ?>/" class="cat-link <?= $c['id']==$cat['id']?'active':'' ?>">
            <span><?= e($c['icon'] ?? '💬') ?></span>
            <span style="flex:1"><?= e($c['name']) ?></span>
            <span style="font-size:.75rem;color:#999"><?= $c['topic_count'] ?? 0 ?></span>
          </a>
          <?php endforeach; ?>
        </div>

        <div class="sidebar-card" style="background:var(--green);color:#fff;border-color:var(--green)">
          <h3 style="color:#fff">💼 Butuh Konsultasi K3?</h3>
          <p style="font-size:.85rem;opacity:.85;margin:0 0 14px">Tim ahli K3 siap membantu</p>
          <a href="<?= wa_url('Halo, saya dari forum K3 dan butuh konsultasi langsung') ?>" style="display:block;background:var(--orange);color:#fff;padding:10px;border-radius:8px;text-decoration:none;font-weight:600;text-align:center">💬 Konsultasi Gratis</a>
        </div>

        <div class="sidebar-card">
          <h3>🔗 Link Berguna</h3>
          <div style="display:flex;flex-direction:column;gap:8px">
            <a href="/resources/" style="color:var(--green);text-decoration:none;font-size:.875rem">📄 Template K3 Gratis</a>
            <a href="/jadwal/"    style="color:var(--green);text-decoration:none;font-size:.875rem">📅 Jadwal Pelatihan</a>
            <a href="/glosarium/" style="color:var(--green);text-decoration:none;font-size:.875rem">📖 Glosarium K3</a>
            <a href="/verifikasi/" style="color:var(--green);text-decoration:none;font-size:.875rem">✅ Verifikasi Sertifikat</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
<script src="<?= SITE_URL ?>/assets/js/main.js"></script>
</body></html>
