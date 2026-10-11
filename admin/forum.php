<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/partials/auth.php';
require_once __DIR__ . '/../includes/forum-functions.php';
require_auth('forum_mod');

$pdo = get_pdo();
$import_log = [];

// ─── Moderation actions (approve/reject/delete/pin) ────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && csrf_verify($_POST['csrf_token'] ?? '') && isset($_POST['action']) && $_POST['action'] !== 'import') {
    $act = sanitize($_POST['action'] ?? '');
    $id  = (int)($_POST['id'] ?? 0);
    $type = sanitize($_POST['type'] ?? 'topic');

    if ($act === 'approve' && $id) {
        $table = $type === 'reply' ? 'forum_replies' : 'forum_topics';
        $pdo->prepare("UPDATE $table SET is_approved=1, is_active=1 WHERE id=?")->execute([$id]);
    } elseif ($act === 'reject' && $id) {
        $table = $type === 'reply' ? 'forum_replies' : 'forum_topics';
        $pdo->prepare("UPDATE $table SET is_active=0 WHERE id=?")->execute([$id]);
    } elseif ($act === 'delete' && $id) {
        $table = $type === 'reply' ? 'forum_replies' : 'forum_topics';
        $pdo->prepare("DELETE FROM $table WHERE id=?")->execute([$id]);
    } elseif ($act === 'pin' && $id) {
        $pdo->prepare("UPDATE forum_topics SET is_pinned = NOT is_pinned WHERE id=?")->execute([$id]);
    }
    redirect(SITE_URL . '/admin/forum.php?saved=1&tab=' . ($_GET['tab'] ?? 'topics'));
}

// ─── Import: CSV topics / CSV replies / raw SQL ─────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && csrf_verify($_POST['csrf_token'] ?? '') && ($_POST['action'] ?? '') === 'import') {
    $import_mode = sanitize($_POST['import_mode'] ?? '');

    // Get content from either uploaded file or pasted textarea
    $raw = '';
    if (!empty($_FILES['import_file']['tmp_name']) && is_uploaded_file($_FILES['import_file']['tmp_name'])) {
        $raw = file_get_contents($_FILES['import_file']['tmp_name']);
    } elseif (!empty($_POST['import_text'])) {
        $raw = $_POST['import_text'];
    }

    if ($raw === '') {
        $import_log[] = ['error', 'Tidak ada file atau teks yang di-upload.'];
    } elseif ($import_mode === 'topics_csv') {
        $rows = array_map('str_getcsv', preg_split('/\r\n|\r|\n/', trim($raw)));
        $header = array_map('trim', array_shift($rows));
        $expected = ['category_slug','author_name','author_email','author_company','title','content','is_pinned','is_answered','created_at'];
        foreach ($rows as $i => $row) {
            if (count($row) < 6 || !array_filter($row)) continue;
            $row = array_combine(array_slice($expected, 0, count($row)), $row);

            $catStmt = $pdo->prepare('SELECT id FROM forum_categories WHERE slug = ? LIMIT 1');
            $catStmt->execute([trim($row['category_slug'] ?? '')]);
            $catId = $catStmt->fetchColumn();
            if (!$catId) { $import_log[] = ['error', "Baris " . ($i+2) . ": kategori '{$row['category_slug']}' tidak ditemukan."]; continue; }

            $data = [
                'category_id'   => (int)$catId,
                'author_name'   => trim($row['author_name'] ?? ''),
                'author_email'  => trim($row['author_email'] ?? ''),
                'author_company'=> trim($row['author_company'] ?? ''),
                'title'         => trim($row['title'] ?? ''),
                'content'       => trim($row['content'] ?? ''),
                'is_approved'   => 1,
            ];
            if (!$data['title'] || !$data['content'] || !$data['author_name']) {
                $import_log[] = ['error', "Baris " . ($i+2) . ": title/content/author_name wajib diisi."];
                continue;
            }
            $topicId = save_forum_topic($data);
            if ($topicId) {
                if (!empty($row['is_pinned']))   $pdo->prepare('UPDATE forum_topics SET is_pinned=1 WHERE id=?')->execute([$topicId]);
                if (!empty($row['is_answered'])) $pdo->prepare('UPDATE forum_topics SET is_answered=1 WHERE id=?')->execute([$topicId]);
                if (!empty($row['created_at']))  $pdo->prepare('UPDATE forum_topics SET created_at=? WHERE id=?')->execute([trim($row['created_at']), $topicId]);
                $import_log[] = ['ok', "Topik dibuat: \"{$data['title']}\" (ID {$topicId})"];
            } else {
                $import_log[] = ['error', "Baris " . ($i+2) . ": gagal menyimpan topik."];
            }
        }
    } elseif ($import_mode === 'replies_csv') {
        $rows = array_map('str_getcsv', preg_split('/\r\n|\r|\n/', trim($raw)));
        $header = array_map('trim', array_shift($rows));
        $expected = ['topic_slug','author_name','author_email','author_company','content','is_expert','is_best_answer','created_at'];
        foreach ($rows as $i => $row) {
            if (count($row) < 5 || !array_filter($row)) continue;
            $row = array_combine(array_slice($expected, 0, count($row)), $row);

            $topic = get_forum_topic_by_slug(trim($row['topic_slug'] ?? ''));
            if (!$topic) { $import_log[] = ['error', "Baris " . ($i+2) . ": topik slug '{$row['topic_slug']}' tidak ditemukan/belum disetujui."]; continue; }

            $data = [
                'topic_id'      => $topic['id'],
                'author_name'   => trim($row['author_name'] ?? ''),
                'author_email'  => trim($row['author_email'] ?? ''),
                'author_company'=> trim($row['author_company'] ?? ''),
                'content'       => trim($row['content'] ?? ''),
                'is_expert'     => !empty($row['is_expert']) ? 1 : 0,
                'is_approved'   => 1,
            ];
            if (!$data['content'] || !$data['author_name']) {
                $import_log[] = ['error', "Baris " . ($i+2) . ": content/author_name wajib diisi."];
                continue;
            }
            $replyId = save_forum_reply($data);
            if ($replyId) {
                if (!empty($row['is_best_answer'])) {
                    $pdo->prepare('UPDATE forum_replies SET is_best_answer=0 WHERE topic_id=?')->execute([$topic['id']]);
                    $pdo->prepare('UPDATE forum_replies SET is_best_answer=1 WHERE id=?')->execute([$replyId]);
                    $pdo->prepare('UPDATE forum_topics SET is_answered=1 WHERE id=?')->execute([$topic['id']]);
                }
                if (!empty($row['created_at'])) $pdo->prepare('UPDATE forum_replies SET created_at=? WHERE id=?')->execute([trim($row['created_at']), $replyId]);
                $import_log[] = ['ok', "Balasan ditambahkan ke \"{$topic['title']}\" (ID {$replyId})"];
            } else {
                $import_log[] = ['error', "Baris " . ($i+2) . ": gagal menyimpan balasan."];
            }
        }
    } elseif ($import_mode === 'raw_sql') {
        // Restricted: only INSERT statements into forum_* tables are allowed.
        $statements = array_filter(array_map('trim', explode(';', $raw)));
        $allowed_tables = ['forum_topics', 'forum_replies', 'forum_categories'];
        $pdo->beginTransaction();
        $ok = true;
        foreach ($statements as $i => $stmt) {
            if ($stmt === '') continue;
            $is_insert = preg_match('/^INSERT\s+INTO\s+`?(' . implode('|', $allowed_tables) . ')`?\s*\(/i', $stmt);
            if (!$is_insert) {
                $import_log[] = ['error', "Statement " . ($i+1) . " ditolak: hanya INSERT INTO forum_topics/forum_replies/forum_categories yang diizinkan."];
                $ok = false;
                continue;
            }
            try {
                $pdo->exec($stmt);
                $import_log[] = ['ok', "Statement " . ($i+1) . " berhasil dijalankan."];
            } catch (PDOException $e) {
                $import_log[] = ['error', "Statement " . ($i+1) . " gagal: " . $e->getMessage()];
                $ok = false;
            }
        }
        if ($ok) { $pdo->commit(); } else { $pdo->rollBack(); $import_log[] = ['error', 'Transaksi dibatalkan (rollback) karena ada statement yang gagal/ditolak.']; }
    }
}

$tab = sanitize($_GET['tab'] ?? 'topics');

// Pending topics
$pendingTopics = $pdo->query("SELECT t.*, c.name as cat_name FROM forum_topics t LEFT JOIN forum_categories c ON t.category_id=c.id WHERE t.is_approved=0 AND t.is_active=1 ORDER BY t.created_at DESC LIMIT 50")->fetchAll();

// All topics (approved)
$allTopics = $pdo->query("SELECT t.*, c.name as cat_name FROM forum_topics t LEFT JOIN forum_categories c ON t.category_id=c.id WHERE t.is_approved=1 AND t.is_active=1 ORDER BY t.created_at DESC LIMIT 30")->fetchAll();

// Pending replies
$pendingReplies = $pdo->query("SELECT r.*, t.title as topic_title, t.slug as topic_slug FROM forum_replies r JOIN forum_topics t ON r.topic_id=t.id WHERE r.is_approved=0 AND r.is_active=1 ORDER BY r.created_at DESC LIMIT 50")->fetchAll();

// Categories (for import reference)
$allCats = $pdo->query("SELECT id, name, slug, topic_count FROM forum_categories WHERE is_active=1 ORDER BY sort_order ASC")->fetchAll();

// Stats
$stats = [
    'total_topics'  => (int)$pdo->query("SELECT COUNT(*) FROM forum_topics WHERE is_approved=1 AND is_active=1")->fetchColumn(),
    'pending'       => count($pendingTopics) + count($pendingReplies),
    'total_replies' => (int)$pdo->query("SELECT COUNT(*) FROM forum_replies WHERE is_approved=1 AND is_active=1")->fetchColumn(),
];

// AI-readable schema prompt — kept in sync with actual live schema
$schema_prompt = <<<TXT
FORUM DATABASE SCHEMA — for generating CSV import files

Table: forum_categories (read-only reference, do not insert via CSV)
  id, name, slug, icon, description, sort_order, is_active, topic_count
  Available categories:
TXT;
foreach ($allCats as $c) {
    $schema_prompt .= "\n    - slug=\"{$c['slug']}\"  name=\"{$c['name']}\"";
}
$schema_prompt .= <<<TXT


Table: forum_topics
  id (auto), category_id (FK), user_id (nullable), author_name, author_email,
  author_company (nullable), slug (auto-generated unique, do not set), title,
  content, reply_count (auto), view_count (auto), is_pinned, is_answered,
  is_approved, is_active, last_reply_at, created_at

Table: forum_replies
  id (auto), topic_id (FK), user_id (nullable), author_name, author_email,
  author_company (nullable), content, is_expert, is_best_answer, is_approved,
  is_active, created_at

═══ CSV FORMAT — TOPICS ═══
Header row (exact column names, in this order):
category_slug,author_name,author_email,author_company,title,content,is_pinned,is_answered,created_at

- category_slug: must match one of the slugs listed above
- author_name, title, content: required
- author_email: required, valid email format
- author_company: optional, leave blank if none
- is_pinned, is_answered: 0 or 1, optional (blank = 0)
- created_at: optional, format YYYY-MM-DD HH:MM:SS (blank = now)
- title: min 10 characters recommended for SEO
- content: min 30 characters, plain text (newlines OK, no HTML needed — rendered with nl2br)
- Do NOT include a slug column — it is auto-generated from title and guaranteed unique
- Do NOT include is_approved — CSV imports via this admin panel are always auto-approved

Example row:
"k3-umum","Budi Santoso","budi@example.com","PT Contoh Industri","Bagaimana prosedur JSA untuk pekerjaan di ketinggian?","Saya ingin bertanya soal prosedur penyusunan JSA (Job Safety Analysis) untuk pekerjaan di ketinggian di lokasi tambang. Apa saja poin wajib yang harus dicantumkan?",0,1,"2026-05-12 09:30:00"

═══ CSV FORMAT — REPLIES ═══
Header row (exact column names, in this order):
topic_slug,author_name,author_email,author_company,content,is_expert,is_best_answer,created_at

- topic_slug: must match the slug of an already-approved topic (check the "Topik Disetujui" tab, or the topic was just created in the same CSV batch — import topics first, then replies)
- author_name, content, author_email: required
- is_expert: 0 or 1 — set to 1 for official/team answers (shown with an "expert" badge if template supports it)
- is_best_answer: 0 or 1 — only one reply per topic should be 1; marks topic as answered
- created_at: optional, should be AFTER the topic's created_at for realism

Example row:
"cara-membuat-jsa-yang-benar-untuk-pekerjaan-di-ketinggian","Tim K3 Wahana Totalita","admin@wahanatotalita.com","","JSA untuk pekerjaan di ketinggian wajib mencantumkan: identifikasi bahaya per tahapan kerja, APD yang digunakan (full body harness, lanyard, dll), titik anchor yang disetujui, serta prosedur rescue jika terjadi kondisi darurat. Rujukan utamanya Permenaker No. 9 Tahun 2016.",1,1,"2026-05-12 14:00:00"

═══ INSTRUCTIONS FOR AI GENERATING THIS DATA ═══
1. Write realistic, useful K3/HSE questions and answers in Bahasa Indonesia — no filler/lorem ipsum.
2. Base content on real Indonesian K3 regulations (Permenaker, UU No.1/1970, BNSP/Kemnaker certification schemes) where relevant.
3. Vary author names naturally (Indonesian names), vary company names or leave blank.
4. For each topic, write 1-2 replies — at least one should be_expert=1 as an authoritative answer, is_best_answer=1.
5. Space out created_at timestamps over the last 1-6 months so it doesn't look like a bulk dump.
6. Output as raw CSV text (comma-separated, quote fields containing commas), one file for topics, one file for replies.
7. Import topics CSV FIRST (creates the slugs), THEN import replies CSV (references those slugs).
TXT;
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Forum Moderasi — Admin</title>
<meta name="robots" content="noindex">
<link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/admin.css">
<style>
.import-card{background:#fff;border-radius:10px;border:1px solid #eee;padding:20px;margin-bottom:20px}
.import-card h3{margin:0 0 8px;font-size:1rem}
.import-card p{font-size:.82rem;color:#666;margin:0 0 14px}
.import-card textarea{width:100%;box-sizing:border-box;font-family:Consolas,Monaco,monospace;font-size:12px;border:1px solid #ddd;border-radius:8px;padding:12px}
.import-card input[type=file]{margin-bottom:10px}
.import-card button{background:var(--green,#0A4A2E);color:#fff;border:none;padding:10px 20px;border-radius:8px;font-weight:600;cursor:pointer;font-size:.85rem}
.import-log{margin-top:14px;font-size:.8rem;max-height:240px;overflow-y:auto;background:#f9fafb;border-radius:8px;padding:10px}
.import-log div{padding:3px 0}
.import-log .ok{color:#166534}
.import-log .error{color:#991b1b}
.schema-box{width:100%;box-sizing:border-box;font-family:Consolas,Monaco,monospace;font-size:11px;line-height:1.5;border:1px solid #ddd;border-radius:8px;padding:14px;background:#f9fafb;white-space:pre-wrap}
.copy-btn{margin-top:8px;background:#f3f4f6;color:#374151;border:1px solid #ddd;padding:7px 14px;border-radius:6px;font-size:.8rem;cursor:pointer}
</style>
</head>
<body class="admin-body">
<?php include __DIR__ . '/partials/sidebar.php'; ?>
<div class="admin-main">
  <?php if (isset($_GET['saved'])): ?><div class="flash flash-ok">✅ Aksi berhasil</div><?php endif; ?>
  <div class="admin-topbar">
    <h1>💬 Forum Moderasi</h1>
    <div style="display:flex;gap:16px;font-size:.85rem;color:#666">
      <span><?= $stats['total_topics'] ?> topik · <?= $stats['total_replies'] ?> balasan · <strong style="color:var(--orange)"><?= $stats['pending'] ?> pending</strong></span>
    </div>
  </div>

  <!-- Tabs -->
  <div style="display:flex;gap:4px;margin-bottom:20px;border-bottom:2px solid #eee;flex-wrap:wrap">
    <?php foreach (['topics'=>'📝 Topik Pending ('.count($pendingTopics).')','replies'=>'💬 Balasan Pending ('.count($pendingReplies).')','approved'=>'✅ Topik Disetujui','import'=>'📥 Import Data'] as $t => $lbl): ?>
    <a href="?tab=<?= $t ?>" style="padding:10px 16px;text-decoration:none;font-size:.875rem;font-weight:600;border-bottom:2px solid <?= $tab===$t?'var(--green)':'transparent' ?>;color:<?= $tab===$t?'var(--green)':'#555' ?>;margin-bottom:-2px"><?= $lbl ?></a>
    <?php endforeach; ?>
  </div>

  <?php if ($tab === 'topics'): ?>
  <?php if (empty($pendingTopics)): ?>
  <div style="text-align:center;padding:60px;color:#999">✅ Tidak ada topik yang menunggu moderasi</div>
  <?php else: ?>
  <?php foreach ($pendingTopics as $t): ?>
  <div style="background:#fff;border-radius:10px;border:1px solid #eee;padding:18px;margin-bottom:12px">
    <div style="display:flex;align-items:flex-start;gap:16px;flex-wrap:wrap">
      <div style="flex:1;min-width:200px">
        <span style="font-size:.72rem;background:#fef3c7;color:#92400e;padding:2px 8px;border-radius:100px;font-weight:700"><?= e($t['cat_name'] ?? 'Umum') ?></span>
        <div style="font-weight:700;margin:6px 0 4px"><?= e($t['title']) ?></div>
        <div style="font-size:.82rem;color:#666;margin-bottom:8px"><?= e(mb_substr($t['content'],0,200)) ?>...</div>
        <div style="font-size:.75rem;color:#999">oleh <strong><?= e($t['author_name']) ?></strong> (<?= e($t['author_email']) ?>) · <?= time_ago($t['created_at']) ?></div>
      </div>
      <div style="display:flex;gap:8px;flex-shrink:0">
        <form method="POST"><?= csrf_field() ?><input type="hidden" name="action" value="approve"><input type="hidden" name="id" value="<?= $t['id'] ?>"><input type="hidden" name="type" value="topic">
          <button type="submit" style="background:var(--green);color:#fff;border:none;padding:8px 16px;border-radius:8px;cursor:pointer;font-weight:600;font-size:.85rem">✓ Setujui</button></form>
        <form method="POST"><?= csrf_field() ?><input type="hidden" name="action" value="reject"><input type="hidden" name="id" value="<?= $t['id'] ?>"><input type="hidden" name="type" value="topic">
          <button type="submit" style="background:#fee2e2;color:#991b1b;border:none;padding:8px 16px;border-radius:8px;cursor:pointer;font-weight:600;font-size:.85rem">✗ Tolak</button></form>
        <form method="POST" onsubmit="return confirm('Hapus?')"><?= csrf_field() ?><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= $t['id'] ?>"><input type="hidden" name="type" value="topic">
          <button type="submit" style="background:#f3f4f6;color:#6b7280;border:none;padding:8px;border-radius:8px;cursor:pointer;font-size:.85rem">🗑</button></form>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
  <?php endif; ?>

  <?php elseif ($tab === 'replies'): ?>
  <?php if (empty($pendingReplies)): ?>
  <div style="text-align:center;padding:60px;color:#999">✅ Tidak ada balasan yang menunggu moderasi</div>
  <?php else: ?>
  <?php foreach ($pendingReplies as $r): ?>
  <div style="background:#fff;border-radius:10px;border:1px solid #eee;padding:18px;margin-bottom:12px">
    <div style="display:flex;align-items:flex-start;gap:16px;flex-wrap:wrap">
      <div style="flex:1">
        <div style="font-size:.75rem;color:#999;margin-bottom:4px">Topik: <a href="/forum/topik/<?= e($r['topic_slug'] ?? '') ?>/" style="color:var(--green)"><?= e($r['topic_title']) ?></a></div>
        <div style="font-size:.875rem;color:#333;margin-bottom:8px"><?= e(mb_substr($r['content'],0,250)) ?></div>
        <div style="font-size:.75rem;color:#999">oleh <strong><?= e($r['author_name']) ?></strong> · <?= time_ago($r['created_at']) ?></div>
      </div>
      <div style="display:flex;gap:8px;flex-shrink:0">
        <form method="POST"><?= csrf_field() ?><input type="hidden" name="action" value="approve"><input type="hidden" name="id" value="<?= $r['id'] ?>"><input type="hidden" name="type" value="reply">
          <button type="submit" style="background:var(--green);color:#fff;border:none;padding:8px 16px;border-radius:8px;cursor:pointer;font-weight:600;font-size:.85rem">✓ Setujui</button></form>
        <form method="POST"><?= csrf_field() ?><input type="hidden" name="action" value="reject"><input type="hidden" name="id" value="<?= $r['id'] ?>"><input type="hidden" name="type" value="reply">
          <button type="submit" style="background:#fee2e2;color:#991b1b;border:none;padding:8px 16px;border-radius:8px;cursor:pointer;font-weight:600;font-size:.85rem">✗ Tolak</button></form>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
  <?php endif; ?>

  <?php elseif ($tab === 'approved'): ?>
  <div class="admin-table-card">
    <table class="admin-table">
      <thead><tr><th>Topik</th><th>Kategori</th><th>Balasan</th><th>Dibuat</th><th>Aksi</th></tr></thead>
      <tbody>
      <?php foreach ($allTopics as $t): ?>
      <tr>
        <td>
          <a href="/forum/topik/<?= e($t['slug']) ?>/" target="_blank" style="font-weight:600;color:var(--green);text-decoration:none"><?= e(mb_substr($t['title'],0,55)) ?></a>
          <?php if ($t['is_pinned']): ?><span style="font-size:.7rem;background:#fef3c7;color:#92400e;padding:1px 6px;border-radius:4px;margin-left:6px">📌</span><?php endif; ?>
          <div style="font-size:.75rem;color:#999">oleh <?= e($t['author_name']) ?></div>
        </td>
        <td style="font-size:.82rem"><?= e($t['cat_name'] ?? '—') ?></td>
        <td style="text-align:center"><?= $t['reply_count'] ?? 0 ?></td>
        <td style="font-size:.78rem;color:#999"><?= time_ago($t['created_at']) ?></td>
        <td>
          <form method="POST" style="display:inline">
            <?= csrf_field() ?><input type="hidden" name="action" value="pin">
            <input type="hidden" name="id" value="<?= $t['id'] ?>">
            <button type="submit" style="background:#fef3c7;color:#92400e;border:none;padding:4px 8px;border-radius:6px;cursor:pointer;font-size:.75rem"><?= $t['is_pinned'] ? 'Unpin' : '📌 Pin' ?></button>
          </form>
          <form method="POST" style="display:inline" onsubmit="return confirm('Hapus topik ini?')">
            <?= csrf_field() ?><input type="hidden" name="action" value="delete">
            <input type="hidden" name="id" value="<?= $t['id'] ?>">
            <input type="hidden" name="type" value="topic">
            <button type="submit" style="background:#fee2e2;color:#991b1b;border:none;padding:4px 8px;border-radius:6px;cursor:pointer;font-size:.75rem">🗑</button>
          </form>
        </td>
      </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <?php else: /* import tab */ ?>

  <?php if (!empty($import_log)): ?>
  <div class="import-card">
    <h3>Hasil Import Terakhir</h3>
    <div class="import-log">
      <?php foreach ($import_log as [$level, $msg]): ?>
      <div class="<?= $level ?>"><?= $level === 'ok' ? '✓' : '✗' ?> <?= e($msg) ?></div>
      <?php endforeach; ?>
    </div>
  </div>
  <?php endif; ?>

  <div class="import-card">
    <h3>📄 Import Topik (CSV)</h3>
    <p>Upload file .csv atau tempel teks CSV. Kolom wajib: <code>category_slug,author_name,author_email,author_company,title,content,is_pinned,is_answered,created_at</code>. Lihat panduan schema di bawah. Topik otomatis disetujui (langsung tayang).</p>
    <form method="POST" enctype="multipart/form-data">
      <?= csrf_field() ?>
      <input type="hidden" name="action" value="import">
      <input type="hidden" name="import_mode" value="topics_csv">
      <input type="file" name="import_file" accept=".csv,text/csv">
      <textarea name="import_text" rows="6" placeholder="...atau tempel CSV di sini (lebih diprioritaskan jika file juga di-upload, kosongkan salah satu)"></textarea>
      <div style="margin-top:10px"><button type="submit">Import Topik</button></div>
    </form>
  </div>

  <div class="import-card">
    <h3>💬 Import Balasan (CSV)</h3>
    <p>Kolom wajib: <code>topic_slug,author_name,author_email,author_company,content,is_expert,is_best_answer,created_at</code>. Topik harus sudah ada (approved) sebelum balasannya diimport — import topik dulu.</p>
    <form method="POST" enctype="multipart/form-data">
      <?= csrf_field() ?>
      <input type="hidden" name="action" value="import">
      <input type="hidden" name="import_mode" value="replies_csv">
      <input type="file" name="import_file" accept=".csv,text/csv">
      <textarea name="import_text" rows="6" placeholder="...atau tempel CSV di sini"></textarea>
      <div style="margin-top:10px"><button type="submit">Import Balasan</button></div>
    </form>
  </div>

  <div class="import-card">
    <h3>🗄️ Import via SQL Mentah</h3>
    <p>Hanya statement <code>INSERT INTO forum_topics / forum_replies / forum_categories</code> yang diizinkan — statement lain otomatis ditolak. Dijalankan dalam satu transaksi (rollback penuh jika ada yang gagal).</p>
    <form method="POST" enctype="multipart/form-data">
      <?= csrf_field() ?>
      <input type="hidden" name="action" value="import">
      <input type="hidden" name="import_mode" value="raw_sql">
      <input type="file" name="import_file" accept=".sql,text/plain">
      <textarea name="import_text" rows="6" placeholder="INSERT INTO forum_topics (category_id, author_name, ...) VALUES (...);"></textarea>
      <div style="margin-top:10px"><button type="submit">Jalankan SQL</button></div>
    </form>
  </div>

  <div class="import-card">
    <h3>🤖 Panduan Schema untuk AI (copy-paste ke ChatGPT/Claude untuk generate CSV)</h3>
    <p>Salin teks di bawah dan berikan ke AI mana pun bersama instruksi topik yang Anda inginkan (misal: "buatkan 5 topik forum tentang K3 Kimia") — AI akan menghasilkan CSV yang siap diimport lewat form di atas.</p>
    <textarea class="schema-box" id="schemaPrompt" rows="20" readonly><?= e($schema_prompt) ?></textarea>
    <button type="button" class="copy-btn" onclick="copySchema()">📋 Salin ke Clipboard</button>
    <span id="copyStatus" style="font-size:.8rem;color:#166534;margin-left:8px"></span>
  </div>

  <?php endif; ?>
</div>
<script src="<?= SITE_URL ?>/assets/js/admin.js"></script>
<script>
function copySchema(){
  var el = document.getElementById('schemaPrompt');
  el.select();
  el.setSelectionRange(0, 999999);
  navigator.clipboard.writeText(el.value).then(function(){
    document.getElementById('copyStatus').textContent = 'Disalin!';
    setTimeout(function(){ document.getElementById('copyStatus').textContent = ''; }, 2000);
  });
}
</script>
</body></html>
