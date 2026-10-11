<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/forum-functions.php';

// Public topic/reply submission — moderated (is_approved=0 until admin approves)
define('FORUM_SUBMISSIONS_OPEN', true);

$s     = get_all_settings();
$cats  = get_forum_categories();
$stats = get_forum_stats();

$metaTitle = 'Forum Diskusi K3 Indonesia — Tanya Jawab HSE & Safety | Wahana Totalita';
$metaDesc  = 'Diskusi K3, HSE, lingkungan & keselamatan kerja bersama profesional Indonesia. Tanya, jawab, dan berbagi pengalaman.';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($metaTitle) ?></title>
<meta name="description" content="<?= e($metaDesc) ?>">
<link rel="canonical" href="<?= SITE_URL ?>/forum/">
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
.forum-hero{background:linear-gradient(135deg,var(--green),#1a5c3a);padding:56px 0;color:#fff;text-align:center}
.forum-hero h1{font-size:clamp(1.8rem,4vw,2.5rem);font-weight:800;margin:0 0 12px}
.forum-stats{display:flex;gap:32px;justify-content:center;flex-wrap:wrap;margin-top:24px}
.forum-stats .stat strong{display:block;font-size:1.8rem;font-weight:800}
.forum-stats .stat span{font-size:.8rem;opacity:.7}
.forum-content{padding:48px 0}
.forum-layout{display:grid;grid-template-columns:1fr 280px;gap:32px}
.cat-card{background:#fff;border-radius:12px;border:1px solid #eee;overflow:hidden;margin-bottom:16px;box-shadow:0 2px 8px rgba(0,0,0,.05)}
.cat-card-header{background:linear-gradient(135deg,var(--green),#1a5c3a);padding:16px 20px;color:#fff;display:flex;gap:16px;align-items:center}
.cat-card-header .icon{font-size:2rem}
.cat-card-header h2{margin:0;font-size:1.1rem;font-weight:700}
.cat-card-header p{margin:0;font-size:.8rem;opacity:.75}
.topic-list{padding:0;margin:0;list-style:none}
.topic-item{display:flex;align-items:flex-start;gap:16px;padding:14px 20px;border-bottom:1px solid #f0f0f0}
.topic-item:last-child{border-bottom:none}
.topic-item:hover{background:#f9fafb}
.topic-item .avatar{width:36px;height:36px;border-radius:50%;background:var(--green);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.9rem;flex-shrink:0}
.topic-title{font-weight:600;font-size:.9rem;color:#1a1a1a;text-decoration:none;line-height:1.4}
.topic-title:hover{color:var(--green)}
.topic-meta{font-size:.75rem;color:#999;margin-top:4px}
.topic-counts{text-align:center;font-size:.75rem;color:#999;flex-shrink:0;min-width:48px}
.topic-counts strong{display:block;font-size:1rem;font-weight:700;color:#333}
.sidebar-card{background:#fff;border-radius:12px;border:1px solid #eee;padding:20px;margin-bottom:20px}
.sidebar-card h3{font-size:1rem;font-weight:700;margin:0 0 16px;color:var(--green)}
.btn-new-topic{display:block;background:var(--orange);color:#fff;padding:12px;border-radius:8px;font-weight:700;text-align:center;text-decoration:none;margin-bottom:16px}
.cat-link{display:flex;gap:12px;align-items:center;padding:8px 0;border-bottom:1px solid #f0f0f0;text-decoration:none;color:#333;font-size:.875rem}
.cat-link:last-child{border-bottom:none}
.cat-link:hover{color:var(--green)}
.view-all{display:block;text-align:center;margin-top:12px;font-size:.85rem;color:var(--green);text-decoration:none;font-weight:600}
@media(max-width:768px){.forum-layout{grid-template-columns:1fr}}
</style>
</head>
<body>
<?php include __DIR__ . '/../includes/navbar.php'; ?>

<section class="forum-hero">
  <div class="container">
    <h1>💬 Forum K3 Indonesia</h1>
    <p style="opacity:.85;max-width:560px;margin:0 auto">Tanya, diskusi, dan berbagi pengetahuan K3 bersama ribuan profesional HSE di Indonesia</p>
    <div class="forum-stats">
      <div class="stat"><strong><?= number_format($stats['total_topics'] ?? 0) ?></strong><span>Topik</span></div>
      <div class="stat"><strong><?= number_format($stats['total_replies'] ?? 0) ?></strong><span>Balasan</span></div>
      <div class="stat"><strong><?= number_format($stats['total_users'] ?? 0) ?></strong><span>Anggota</span></div>
    </div>
  </div>
</section>

<section class="forum-content">
  <div class="container">
    <div class="forum-layout">
      <div>
        <?php foreach ($cats as $cat):
          $topics = get_forum_topics(['category_id'=>$cat['id'],'limit'=>5]);
        ?>
        <div class="cat-card">
          <a href="/forum/<?= e($cat['slug']) ?>/" style="text-decoration:none">
            <div class="cat-card-header">
              <span class="icon"><?= e($cat['icon'] ?? '💬') ?></span>
              <div>
                <h2><?= e($cat['name']) ?></h2>
                <?php if ($cat['description']): ?><p><?= e($cat['description']) ?></p><?php endif; ?>
                <div style="font-size:.75rem;margin-top:4px;opacity:.7"><?= $cat['topic_count'] ?? 0 ?> topik · <?= $cat['reply_count'] ?? 0 ?> balasan</div>
              </div>
            </div>
          </a>
          <ul class="topic-list">
            <?php foreach ($topics as $t): ?>
            <li class="topic-item">
              <div class="avatar"><?= mb_substr($t['author_name'] ?? 'A', 0, 1) ?></div>
              <div style="flex:1;min-width:0">
                <a href="/forum/topik/<?= e($t['slug']) ?>/" class="topic-title"><?= e(mb_substr($t['title'],0,70)) ?></a>
                <div class="topic-meta">oleh <?= e($t['author_name']) ?> · <?= time_ago($t['created_at']) ?></div>
              </div>
              <div class="topic-counts">
                <strong><?= $t['reply_count'] ?? 0 ?></strong>balasan
              </div>
            </li>
            <?php endforeach; ?>
            <?php if (empty($topics)): ?>
            <li style="padding:20px;text-align:center;color:#999;font-size:.875rem">
              <?php if (FORUM_SUBMISSIONS_OPEN): ?>
              Belum ada topik. <a href="/forum/buat/" style="color:var(--green)">Mulai diskusi!</a>
              <?php else: ?>
              Belum ada topik di kategori ini.
              <?php endif; ?>
            </li>
            <?php endif; ?>
          </ul>
          <?php if (!empty($topics)): ?>
          <a href="/forum/<?= e($cat['slug']) ?>/" class="view-all" style="display:block;text-align:right;padding:12px 20px;border-top:1px solid #f0f0f0;font-size:.8rem;color:var(--green);text-decoration:none;font-weight:600">Lihat semua topik →</a>
          <?php endif; ?>
        </div>
        <?php endforeach; ?>
        <?php if (empty($cats)): ?>
        <div style="text-align:center;padding:60px;color:#999">Forum sedang dalam persiapan. Segera hadir!</div>
        <?php endif; ?>
      </div>

      <div>
        <?php if (FORUM_SUBMISSIONS_OPEN): ?>
        <a href="/forum/buat/" class="btn-new-topic">✏️ Buat Topik Baru</a>
        <?php endif; ?>

        <div class="sidebar-card">
          <h3>📂 Kategori Forum</h3>
          <?php foreach ($cats as $cat): ?>
          <a href="/forum/<?= e($cat['slug']) ?>/" class="cat-link">
            <span><?= e($cat['icon'] ?? '💬') ?></span>
            <span style="flex:1"><?= e($cat['name']) ?></span>
            <span style="font-size:.75rem;color:#999"><?= $cat['topic_count'] ?? 0 ?></span>
          </a>
          <?php endforeach; ?>
        </div>

        <div class="sidebar-card">
          <h3>🏆 Aturan Forum</h3>
          <ul style="margin:0;padding-left:20px;font-size:.85rem;line-height:2;color:#555">
            <li>Gunakan bahasa yang sopan dan profesional</li>
            <li>Topik harus relevan dengan K3 / HSE</li>
            <li>Dilarang spam atau promosi berlebihan</li>
            <li>Semua postingan melalui moderasi</li>
          </ul>
        </div>

        <div class="sidebar-card" style="background:var(--green);color:#fff;border-color:var(--green)">
          <h3 style="color:#fff">💼 Butuh Pelatihan K3?</h3>
          <p style="font-size:.85rem;opacity:.85;margin:0 0 16px">Konsultasikan kebutuhan HSE perusahaan Anda</p>
          <a href="<?= wa_url('Halo, saya ingin konsultasi kebutuhan K3 perusahaan') ?>" style="display:block;background:var(--orange);color:#fff;padding:10px;border-radius:8px;text-decoration:none;font-weight:600;text-align:center">💬 Hubungi Sekarang</a>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
<script src="<?= SITE_URL ?>/assets/js/main.js"></script>
</body></html>
