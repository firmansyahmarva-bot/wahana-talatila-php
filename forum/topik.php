<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/forum-functions.php';

// Public reply submission — moderated (is_approved=0 until admin approves)
define('FORUM_SUBMISSIONS_OPEN', true);

$slug = get_url_slug() ?: ($_GET['slug'] ?? '');
if (!$slug) redirect(SITE_URL . '/forum/');
$topic = get_forum_topic_by_slug($slug); // auto-increments view
if (!$topic || !$topic['is_approved']) { http_response_code(404); include __DIR__.'/../404.php'; exit; }

$replies = get_forum_replies($topic['id']);
$s = get_all_settings();
$errors = [];
$success = false;

if (FORUM_SUBMISSIONS_OPEN && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reply_content'])) {
    if (!verify_csrf()) { $errors[] = 'Sesi tidak valid.'; }
    else {
        $data = [
            'topic_id'    => $topic['id'],
            'author_name' => sanitize($_POST['author_name']  ?? ''),
            'author_email'=> sanitize($_POST['author_email'] ?? ''),
            'content'     => sanitize($_POST['reply_content'] ?? ''),
        ];
        if (!$data['author_name'])  $errors[] = 'Nama wajib diisi.';
        if (!$data['author_email']) $errors[] = 'Email wajib diisi.';
        if (!$data['content'])      $errors[] = 'Isi balasan wajib diisi.';
        if (empty($errors)) {
            $res = save_forum_reply($data);
            if ($res) { $success = true; }
            else { $errors[] = 'Gagal menyimpan balasan.'; }
        }
    }
}

$metaTitle = e($topic['title']) . ' | Forum K3 Wahana Totalita';
$metaDesc  = mb_substr(strip_tags($topic['content'] ?? ''), 0, 160);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= $metaTitle ?></title>
<meta name="description" content="<?= e($metaDesc) ?>">
<link rel="canonical" href="<?= SITE_URL ?>/forum/topik/<?= e($topic['slug']) ?>/">
<link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/style.css">
<?= theme_css_vars($s) ?>
<style>
.topic-page{padding:40px 0}
.topic-layout{display:grid;grid-template-columns:1fr 280px;gap:32px}
.breadcrumb{font-size:.85rem;color:#999;margin-bottom:20px}
.breadcrumb a{color:var(--green);text-decoration:none}
.topic-main{background:#fff;border-radius:12px;border:1px solid #eee;overflow:hidden}
.topic-header{background:linear-gradient(135deg,var(--green),#1a5c3a);padding:24px 28px;color:#fff}
.topic-header h1{font-size:1.3rem;font-weight:800;margin:0 0 8px;line-height:1.4}
.topic-header .meta{font-size:.8rem;opacity:.7}
.topic-body{padding:28px}
.topic-content{line-height:1.8;color:#333;font-size:.95rem}
.reply-section{margin-top:0;border-top:1px solid #f0f0f0}
.reply-item{padding:20px 28px;border-bottom:1px solid #f0f0f0;display:flex;gap:16px}
.reply-item:last-child{border-bottom:none}
.reply-item.best{background:#f0fdf4;border-left:4px solid #059669}
.avatar{width:40px;height:40px;border-radius:50%;background:var(--green);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:700;flex-shrink:0}
.reply-meta{font-size:.8rem;color:#999;margin-bottom:8px}
.reply-content{font-size:.9rem;color:#333;line-height:1.7}
.reply-form{padding:24px 28px;background:#f9fafb;border-top:2px solid var(--green)}
.reply-form h3{margin:0 0 16px;color:var(--green);font-size:1rem}
.reply-form input,.reply-form textarea{width:100%;box-sizing:border-box;padding:10px 14px;border:1px solid #ddd;border-radius:8px;font-size:.9rem;font-family:inherit;margin-bottom:12px}
.reply-form textarea{min-height:120px;resize:vertical}
.reply-form button{background:var(--orange);color:#fff;border:none;padding:12px 28px;border-radius:8px;font-weight:700;cursor:pointer}
.reply-closed{font-size:.85rem;color:#666;text-align:center;padding:8px 0}
.reply-closed a{color:var(--green);font-weight:600}
.sidebar-card{background:#fff;border-radius:12px;border:1px solid #eee;padding:20px;margin-bottom:20px}
.sidebar-card h3{font-size:1rem;font-weight:700;margin:0 0 16px;color:var(--green)}
.flash{padding:12px 16px;border-radius:8px;margin-bottom:16px}
.flash.success{background:#dcfce7;color:#166534}
.flash.error{background:#fee2e2;color:#991b1b}
@media(max-width:768px){.topic-layout{grid-template-columns:1fr}}
</style>
</head>
<body>
<?php include __DIR__ . '/../includes/navbar.php'; ?>

<div class="container topic-page">
  <div class="breadcrumb">
    <a href="/forum/">Forum</a> ›
    <?php if ($topic['cat_name']): ?><a href="/forum/<?= e($topic['cat_slug'] ?? '') ?>/"><?= e($topic['cat_name']) ?></a> ›<?php endif; ?>
    <?= e(mb_substr($topic['title'],0,50)) ?>
  </div>

  <div class="topic-layout">
    <div>
      <div class="topic-main">
        <div class="topic-header">
          <h1><?= e($topic['title']) ?></h1>
          <div class="meta">oleh <?= e($topic['author_name']) ?> · <?= time_ago($topic['created_at']) ?> · 👁 <?= $topic['view_count'] ?> dilihat · 💬 <?= $topic['reply_count'] ?? 0 ?> balasan</div>
        </div>
        <div class="topic-body">
          <div class="topic-content"><?= nl2br(e($topic['content'])) ?></div>
        </div>

        <?php if (!empty($replies)): ?>
        <div class="reply-section">
          <div style="padding:16px 28px;font-weight:700;color:#666;font-size:.85rem;background:#f9fafb;border-bottom:1px solid #eee">
            💬 <?= count($replies) ?> Balasan
          </div>
          <?php foreach ($replies as $r): ?>
          <div class="reply-item <?= $r['is_best_answer'] ? 'best' : '' ?>">
            <div class="avatar"><?= mb_substr($r['author_name']??'A',0,1) ?></div>
            <div style="flex:1">
              <?php if ($r['is_best_answer']): ?>
              <div style="background:#059669;color:#fff;font-size:.75rem;font-weight:700;padding:2px 8px;border-radius:4px;display:inline-block;margin-bottom:6px">✅ Jawaban Terbaik</div>
              <?php endif; ?>
              <div class="reply-meta"><?= e($r['author_name']) ?> · <?= time_ago($r['created_at']) ?></div>
              <div class="reply-content"><?= nl2br(e($r['content'])) ?></div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if (!FORUM_SUBMISSIONS_OPEN): ?>
        <div class="reply-form">
          <div class="reply-closed">
            Balasan publik sedang ditutup sementara. Ada pertanyaan?
            <a href="<?= wa_url('Halo, saya ingin bertanya tentang '.$topic['title']) ?>">Tanya via WhatsApp</a>
          </div>
        </div>
        <?php else: ?>
        <div class="reply-form">
          <h3>✏️ Tulis Balasan</h3>
          <?php if ($success): ?>
          <div class="flash success">✅ Balasan Anda berhasil dikirim dan menunggu moderasi.</div>
          <?php endif; ?>
          <?php if (!empty($errors)): ?>
          <div class="flash error"><?= implode('<br>', array_map('e', $errors)) ?></div>
          <?php endif; ?>
          <form method="POST">
            <?= csrf_field() ?>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
              <input type="text"  name="author_name"  placeholder="Nama Anda *" required value="<?= e($_POST['author_name'] ?? '') ?>">
              <input type="email" name="author_email" placeholder="Email *"      required value="<?= e($_POST['author_email'] ?? '') ?>">
            </div>
            <textarea name="reply_content" placeholder="Tulis balasan Anda di sini..." required><?= e($_POST['reply_content'] ?? '') ?></textarea>
            <button type="submit">📤 Kirim Balasan</button>
          </form>
          <p style="font-size:.75rem;color:#999;margin-top:12px">Semua balasan melalui proses moderasi sebelum ditampilkan.</p>
        </div>
        <?php endif; ?>

        <!-- T17c: placed below the replies/reply-form (never above UGC).
             Fails silent today (no forum-category map yet); wired so it
             activates automatically once that map is added — see T15 notes. -->
        <?php
          require_once __DIR__ . '/../includes/related-cta.php';
          echo related_cta('forum', $topic['cat_slug'] ?? '');
        ?>
      </div>
    </div>

    <div>
      <div class="sidebar-card">
        <h3>ℹ️ Info Topik</h3>
        <div style="font-size:.875rem;color:#555;line-height:2">
          <div>👤 Penulis: <strong><?= e($topic['author_name']) ?></strong></div>
          <div>📅 Dibuat: <?= format_date($topic['created_at']) ?></div>
          <div>👁 Dilihat: <?= $topic['view_count'] ?> kali</div>
          <div>💬 Balasan: <?= $topic['reply_count'] ?? 0 ?></div>
        </div>
      </div>
      <div class="sidebar-card">
        <h3>❓ Punya Pertanyaan K3?</h3>
        <p style="font-size:.85rem;color:#666">Gunakan AI Chat kami untuk jawaban instan</p>
        <a href="/#ai-chat" style="display:block;background:var(--green);color:#fff;padding:10px;border-radius:8px;text-decoration:none;font-weight:600;text-align:center;margin-bottom:8px">🤖 Tanya AI</a>
        <a href="<?= wa_url('Halo, saya ingin tanya tentang '.$topic['title']) ?>" style="display:block;background:var(--orange);color:#fff;padding:10px;border-radius:8px;text-decoration:none;font-weight:600;text-align:center">💬 Tanya via WA</a>
      </div>
      <?php if (FORUM_SUBMISSIONS_OPEN): ?>
      <div style="text-align:center">
        <a href="/forum/buat/" style="display:block;background:#f0f9f0;color:var(--green);padding:12px;border-radius:8px;text-decoration:none;font-weight:700;border:2px solid var(--green)">✏️ Buat Topik Baru</a>
      </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
<script src="<?= SITE_URL ?>/assets/js/main.js"></script>
</body></html>
