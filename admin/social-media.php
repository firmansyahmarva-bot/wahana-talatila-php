<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/partials/auth.php';
require_auth('social_queue');

$pdo = get_pdo();

// Handle actions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && verify_csrf()) {
    $act = sanitize($_POST['action'] ?? '');
    $id  = (int)($_POST['id'] ?? 0);
    if ($act === 'add') {
        $pdo->prepare("INSERT INTO social_content (platform,content,image_url,scheduled_at,status,created_by,created_at) VALUES (?,?,?,?,?,?,NOW())")->execute([
            sanitize($_POST['platform'] ?? 'instagram'),
            sanitize($_POST['content'] ?? ''),
            sanitize($_POST['image_url'] ?? ''),
            $_POST['scheduled_at'] ?: null,
            'scheduled',
            $_SESSION['admin_id'] ?? 0,
        ]);
    } elseif ($act === 'mark_posted' && $id) {
        $pdo->prepare("UPDATE social_content SET status='posted', posted_at=NOW() WHERE id=?")->execute([$id]);
    } elseif ($act === 'delete' && $id) {
        $pdo->prepare("DELETE FROM social_content WHERE id=?")->execute([$id]);
    }
    redirect(SITE_URL . '/admin/social-media.php?saved=1');
}

$tab    = sanitize($_GET['tab'] ?? 'queue');
$page   = max(1,(int)($_GET['p'] ?? 1));
$limit  = 20; $offset = ($page-1)*$limit;

$statusFilter = $tab === 'posted' ? 'posted' : 'scheduled';
$posts = $pdo->prepare("SELECT * FROM social_content WHERE status=? ORDER BY " . ($tab==='posted' ? 'posted_at' : 'scheduled_at') . " DESC LIMIT $limit OFFSET $offset");
try { $posts->execute([$statusFilter]); $posts = $posts->fetchAll(); } catch(Exception $e) { $posts = []; }

$queueCount  = 0;
$postedCount = 0;
try {
    $queueCount  = (int)$pdo->query("SELECT COUNT(*) FROM social_content WHERE status='scheduled'")->fetchColumn();
    $postedCount = (int)$pdo->query("SELECT COUNT(*) FROM social_content WHERE status='posted'")->fetchColumn();
} catch(Exception $e) {}

$platformIcons = ['instagram'=>'📸','facebook'=>'👥','linkedin'=>'💼','tiktok'=>'🎵','twitter'=>'🐦'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Konten Sosmed — Admin</title>
<meta name="robots" content="noindex">
<link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/admin.css">
</head>
<body class="admin-body">
<?php include __DIR__ . '/partials/sidebar.php'; ?>
<div class="admin-main">
  <?php if (isset($_GET['saved'])): ?><div class="flash flash-ok">✅ Tersimpan</div><?php endif; ?>
  <div class="admin-topbar">
    <h1>📱 Konten Media Sosial K3</h1>
    <button onclick="document.getElementById('addModal').style.display='flex'" style="background:var(--orange);color:#fff;border:none;padding:10px 18px;border-radius:8px;cursor:pointer;font-weight:600">+ Tambah Konten</button>
  </div>

  <!-- Tabs -->
  <div style="display:flex;gap:4px;margin-bottom:20px;border-bottom:2px solid #eee">
    <a href="?tab=queue"  style="padding:10px 16px;text-decoration:none;font-size:.875rem;font-weight:600;border-bottom:2px solid <?= $tab==='queue'?'var(--green)':'transparent' ?>;color:<?= $tab==='queue'?'var(--green)':'#555' ?>;margin-bottom:-2px">📋 Antrian (<?= $queueCount ?>)</a>
    <a href="?tab=posted" style="padding:10px 16px;text-decoration:none;font-size:.875rem;font-weight:600;border-bottom:2px solid <?= $tab==='posted'?'var(--green)':'transparent' ?>;color:<?= $tab==='posted'?'var(--green)':'#555' ?>;margin-bottom:-2px">✅ Sudah Diposting (<?= $postedCount ?>)</a>
    <a href="/tools/social-generator/" target="_blank" style="padding:10px 16px;text-decoration:none;font-size:.875rem;font-weight:600;color:#6366f1;margin-left:auto">🎨 Buat Poster K3 →</a>
  </div>

  <?php if (empty($posts)): ?>
  <div style="text-align:center;padding:60px;background:#fff;border-radius:12px;border:1px solid #eee;color:#999">
    <?php if ($tab === 'queue'): ?>
    <p style="font-size:1.1rem">📋 Belum ada konten terjadwal</p>
    <button onclick="document.getElementById('addModal').style.display='flex'" style="margin-top:12px;background:var(--orange);color:#fff;border:none;padding:10px 20px;border-radius:8px;cursor:pointer;font-weight:600">+ Tambah Konten Pertama</button>
    <?php else: ?>
    <p>Belum ada konten yang sudah diposting</p>
    <?php endif; ?>
  </div>
  <?php else: ?>
  <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:16px">
    <?php foreach ($posts as $post): ?>
    <div style="background:#fff;border-radius:12px;border:1px solid #eee;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.05)">
      <?php if ($post['image_url'] ?? ''): ?>
      <img src="<?= e($post['image_url']) ?>" alt="" style="width:100%;height:160px;object-fit:cover">
      <?php else: ?>
      <div style="height:80px;background:linear-gradient(135deg,var(--green),#1a5c3a);display:flex;align-items:center;justify-content:center;font-size:2rem"><?= $platformIcons[$post['platform'] ?? 'instagram'] ?? '📱' ?></div>
      <?php endif; ?>
      <div style="padding:16px">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px">
          <span style="background:#f0f9f0;color:var(--green);padding:3px 10px;border-radius:100px;font-size:.75rem;font-weight:700"><?= strtoupper($post['platform'] ?? 'IG') ?></span>
          <?php if ($post['scheduled_at'] ?? ''): ?>
          <span style="font-size:.75rem;color:#999">📅 <?= format_date($post['scheduled_at']) ?></span>
          <?php endif; ?>
        </div>
        <p style="margin:0 0 14px;font-size:.85rem;color:#333;line-height:1.5"><?= e(mb_substr($post['content'],0,120)) ?><?= strlen($post['content'])>120?'...':'' ?></p>
        <div style="display:flex;gap:8px">
          <?php if ($post['status'] === 'scheduled'): ?>
          <form method="POST" style="flex:1">
            <?= csrf_field() ?>
            <input type="hidden" name="action" value="mark_posted">
            <input type="hidden" name="id" value="<?= $post['id'] ?>">
            <button type="submit" style="width:100%;background:var(--green);color:#fff;border:none;padding:8px;border-radius:8px;cursor:pointer;font-weight:600;font-size:.8rem">✅ Mark Diposting</button>
          </form>
          <?php endif; ?>
          <form method="POST" onsubmit="return confirm('Hapus konten ini?')">
            <?= csrf_field() ?>
            <input type="hidden" name="action" value="delete">
            <input type="hidden" name="id" value="<?= $post['id'] ?>">
            <button type="submit" style="background:#fee2e2;color:#991b1b;border:none;padding:8px 12px;border-radius:8px;cursor:pointer;font-size:.8rem">🗑</button>
          </form>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>

  <!-- Tips sidebar content -->
  <div style="margin-top:28px;background:#f0f9f0;border-radius:12px;border:1px solid #bbf7d0;padding:20px">
    <h3 style="margin:0 0 12px;color:var(--green);font-size:.95rem">💡 Waktu Posting Terbaik K3 Content</h3>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:12px;font-size:.82rem;color:#555">
      <div><strong>📸 Instagram:</strong> Sel-Kam 07:00-09:00 & 17:00-19:00 WIB</div>
      <div><strong>💼 LinkedIn:</strong> Sel-Rab 08:00-10:00 WIB (B2B)</div>
      <div><strong>🎵 TikTok:</strong> Jum-Ming 19:00-21:00 WIB</div>
      <div><strong>👥 Facebook:</strong> Rab-Jum 13:00-16:00 WIB</div>
    </div>
  </div>
</div>

<!-- Add Modal -->
<div id="addModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:1000;align-items:center;justify-content:center">
  <div style="background:#fff;border-radius:16px;padding:28px;max-width:500px;width:90%">
    <h2 style="margin:0 0 20px;color:var(--green)">➕ Tambah Konten Sosmed</h2>
    <form method="POST">
      <?= csrf_field() ?>
      <input type="hidden" name="action" value="add">
      <div style="margin-bottom:12px">
        <label style="font-size:.83rem;font-weight:600;display:block;margin-bottom:4px">Platform</label>
        <select name="platform" style="width:100%;padding:9px 12px;border:1.5px solid #ddd;border-radius:8px;font-size:.875rem">
          <option value="instagram">📸 Instagram</option>
          <option value="facebook">👥 Facebook</option>
          <option value="linkedin">💼 LinkedIn</option>
          <option value="tiktok">🎵 TikTok</option>
          <option value="twitter">🐦 Twitter/X</option>
        </select>
      </div>
      <div style="margin-bottom:12px">
        <label style="font-size:.83rem;font-weight:600;display:block;margin-bottom:4px">Caption / Konten *</label>
        <textarea name="content" rows="5" required placeholder="Tulis caption K3 di sini... Tambah hashtag di akhir." style="width:100%;box-sizing:border-box;padding:9px 12px;border:1.5px solid #ddd;border-radius:8px;font-size:.875rem;resize:vertical"></textarea>
      </div>
      <div style="margin-bottom:12px">
        <label style="font-size:.83rem;font-weight:600;display:block;margin-bottom:4px">URL Gambar (opsional)</label>
        <input type="text" name="image_url" placeholder="https://..." style="width:100%;box-sizing:border-box;padding:9px 12px;border:1.5px solid #ddd;border-radius:8px;font-size:.875rem">
      </div>
      <div style="margin-bottom:20px">
        <label style="font-size:.83rem;font-weight:600;display:block;margin-bottom:4px">Jadwal Posting (opsional)</label>
        <input type="datetime-local" name="scheduled_at" style="width:100%;box-sizing:border-box;padding:9px 12px;border:1.5px solid #ddd;border-radius:8px;font-size:.875rem">
      </div>
      <div style="display:flex;gap:12px">
        <button type="submit" style="flex:1;background:var(--green);color:#fff;border:none;padding:12px;border-radius:8px;cursor:pointer;font-weight:700">Simpan ke Antrian</button>
        <button type="button" onclick="document.getElementById('addModal').style.display='none'" style="flex:1;background:#f3f4f6;color:#333;border:none;padding:12px;border-radius:8px;cursor:pointer;font-weight:600">Batal</button>
      </div>
    </form>
  </div>
</div>

<script src="<?= SITE_URL ?>/assets/js/admin.js"></script>
</body></html>
