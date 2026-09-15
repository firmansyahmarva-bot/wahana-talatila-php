<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/partials/auth.php';
require_once __DIR__ . '/../includes/ai-functions.php';
require_auth('ai_leads');

$pdo = get_pdo();

// Handle actions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && csrf_verify($_POST['csrf_token'] ?? '')) {
    $act = sanitize($_POST['action'] ?? '');
    $id  = (int)($_POST['id'] ?? 0);
    if ($act === 're_score' && $id) {
        $lead = $pdo->prepare('SELECT * FROM leads WHERE id=?');
        $lead->execute([$id]); $lead = $lead->fetch();
        if ($lead) {
            $score = score_leads_batch([$lead]);
            if (!empty($score[0]['ai_score'])) {
                $pdo->prepare('UPDATE leads SET ai_score=?, ai_label=?, ai_notes=?, ai_scored_at=NOW() WHERE id=?')
                    ->execute([$score[0]['ai_score'], $score[0]['ai_label'], $score[0]['ai_notes'], $id]);
            }
        }
    } elseif ($act === 'score_all') {
        $unscored = $pdo->query("SELECT * FROM leads WHERE ai_score IS NULL ORDER BY created_at DESC LIMIT 50")->fetchAll();
        if ($unscored) {
            $scores = score_leads_batch($unscored);
            foreach ($scores as $s) {
                if (!empty($s['id'])) {
                    $pdo->prepare('UPDATE leads SET ai_score=?, ai_label=?, ai_notes=?, ai_scored_at=NOW() WHERE id=?')
                        ->execute([$s['ai_score']??0, $s['ai_label']??'cold', $s['ai_notes']??'', $s['id']]);
                }
            }
        }
        redirect(SITE_URL . '/admin/ai-leads.php?scored='.count($unscored));
    } elseif ($act === 'update_status' && $id) {
        $pdo->prepare('UPDATE leads SET status=? WHERE id=?')->execute([sanitize($_POST['status'] ?? 'new'), $id]);
    }
    redirect(SITE_URL . '/admin/ai-leads.php?saved=1');
}

// Filters
$label  = sanitize($_GET['label'] ?? '');
$status = sanitize($_GET['status'] ?? '');
$page   = max(1,(int)($_GET['p'] ?? 1));
$limit  = 30; $offset = ($page-1)*$limit;

$where  = []; $params = [];
if ($label)  { $where[] = 'ai_label=?'; $params[] = $label; }
if ($status) { $where[] = 'status=?';   $params[] = $status; }
$whereSQL = $where ? 'WHERE '.implode(' AND ',$where) : '';

$total = $pdo->prepare("SELECT COUNT(*) FROM leads $whereSQL");
$total->execute($params); $total = (int)$total->fetchColumn();

$leads = $pdo->prepare("SELECT l.*, t.name as course_name FROM leads l LEFT JOIN trainings t ON l.course_id=t.id $whereSQL ORDER BY l.ai_score DESC, l.created_at DESC LIMIT $limit OFFSET $offset");
$leads->execute($params); $leads = $leads->fetchAll();
$pages = ceil($total/$limit);

// Summary stats
try {
    $summary = $pdo->query("SELECT ai_label, COUNT(*) as cnt, AVG(ai_score) as avg_score FROM leads WHERE ai_score IS NOT NULL GROUP BY ai_label")->fetchAll(PDO::FETCH_UNIQUE);
    $unscored = (int)$pdo->query("SELECT COUNT(*) FROM leads WHERE ai_score IS NULL")->fetchColumn();
    $hotCount = (int)$pdo->query("SELECT COUNT(*) FROM leads WHERE ai_label='hot'")->fetchColumn();
} catch(Exception $e) {
    $summary = []; $unscored = 0; $hotCount = 0;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>AI Lead Scoring — Admin</title>
<meta name="robots" content="noindex">
<link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/admin.css">
</head>
<body class="admin-body">
<?php include __DIR__ . '/partials/sidebar.php'; ?>
<div class="admin-main">
  <?php if (isset($_GET['saved'])): ?><div class="flash flash-ok">✅ Tersimpan</div><?php endif; ?>
  <?php if (isset($_GET['scored'])): ?><div class="flash flash-ok">✅ <?= (int)$_GET['scored'] ?> leads berhasil di-score oleh AI</div><?php endif; ?>
  <div class="admin-topbar">
    <h1>🤖 AI Lead Scoring</h1>
    <div style="display:flex;gap:8px">
      <?php if ($unscored > 0): ?>
      <form method="POST" style="display:inline"><?= csrf_field() ?>
        <input type="hidden" name="action" value="score_all">
        <button type="submit" style="background:var(--orange);color:#fff;border:none;padding:10px 18px;border-radius:8px;cursor:pointer;font-weight:600">🤖 Score <?= $unscored ?> Leads Baru</button>
      </form>
      <?php endif; ?>
    </div>
  </div>

  <!-- Summary cards -->
  <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:14px;margin-bottom:24px">
    <?php
    $labelCards = [
      'hot'  => ['🔥 Hot Leads',  '#fee2e2', '#991b1b'],
      'warm' => ['🌤 Warm Leads', '#fef3c7', '#92400e'],
      'cold' => ['❄️ Cold Leads', '#dbeafe', '#1e40af'],
    ];
    foreach ($labelCards as $lbl => [$name, $bg, $fg]):
      $cnt = (int)($summary[$lbl]['cnt'] ?? 0);
      $avg = round((float)($summary[$lbl]['avg_score'] ?? 0));
    ?>
    <div style="background:#fff;border-radius:10px;border:2px solid <?= $bg ?>;padding:16px;text-align:center">
      <div style="font-size:1.8rem;font-weight:800;color:<?= $fg ?>"><?= $cnt ?></div>
      <div style="font-size:.78rem;color:#666;font-weight:600"><?= $name ?></div>
      <?php if ($avg): ?><div style="font-size:.72rem;color:#999;margin-top:2px">avg score: <?= $avg ?></div><?php endif; ?>
    </div>
    <?php endforeach; ?>
    <div style="background:#fff;border-radius:10px;border:1px solid #eee;padding:16px;text-align:center">
      <div style="font-size:1.8rem;font-weight:800;color:#9ca3af"><?= $unscored ?></div>
      <div style="font-size:.78rem;color:#999">Belum Di-score</div>
    </div>
    <div style="background:#fff;border-radius:10px;border:1px solid #eee;padding:16px;text-align:center">
      <div style="font-size:1.8rem;font-weight:800;color:var(--green)"><?= $total ?></div>
      <div style="font-size:.78rem;color:#999">Total Leads</div>
    </div>
  </div>

  <!-- Filter tabs -->
  <div style="display:flex;gap:6px;margin-bottom:16px;flex-wrap:wrap">
    <?php
    $filterTabs = [''=>'Semua','hot'=>'🔥 Hot','warm'=>'🌤 Warm','cold'=>'❄️ Cold'];
    foreach ($filterTabs as $k => $lbl):
    ?>
    <a href="?label=<?= $k ?>&status=<?= e($status) ?>" style="padding:6px 14px;border-radius:100px;text-decoration:none;font-size:.82rem;font-weight:600;background:<?= $label===$k?'var(--green)':'#f1f5f9' ?>;color:<?= $label===$k?'#fff':'#475569' ?>"><?= $lbl ?></a>
    <?php endforeach; ?>
    <span style="margin-left:8px">Status:</span>
    <?php foreach ([''=>'Semua','new'=>'Baru','contacted'=>'Dihubungi','converted'=>'Closing','lost'=>'Batal'] as $k=>$lbl): ?>
    <a href="?label=<?= e($label) ?>&status=<?= $k ?>" style="padding:6px 14px;border-radius:100px;text-decoration:none;font-size:.82rem;font-weight:600;background:<?= $status===$k?'#312e81':'#f1f5f9' ?>;color:<?= $status===$k?'#fff':'#475569' ?>"><?= $lbl ?></a>
    <?php endforeach; ?>
  </div>

  <div class="admin-table-card">
    <table class="admin-table">
      <thead>
        <tr><th>Lead</th><th>Minat</th><th>Sumber</th><th>AI Score</th><th>AI Label</th><th>AI Catatan</th><th>Status</th><th>Aksi</th></tr>
      </thead>
      <tbody>
      <?php foreach ($leads as $l): ?>
      <tr>
        <td>
          <div style="font-weight:600"><?= e($l['name']) ?></div>
          <div style="font-size:.75rem;color:#999"><?= e($l['company'] ?? '') ?></div>
          <div style="font-size:.75rem;color:#999"><?= e($l['email']) ?></div>
          <div style="font-size:.75rem"><?php if ($l['phone']??''): ?><a href="<?= wa_url('Halo ' . $l['name'] . ', saya dari Wahana Totalita. Tertarik dengan program K3 kami?') ?>" style="color:var(--green);text-decoration:none">💬 <?= e($l['phone']) ?></a><?php endif; ?></div>
        </td>
        <td style="font-size:.82rem"><?= e(mb_substr($l['course_name'] ?? $l['training_interest'] ?? '—', 0, 35)) ?></td>
        <td style="font-size:.78rem">
          <span style="background:#f0f9f0;color:var(--green);padding:2px 8px;border-radius:4px;font-size:.72rem"><?= e($l['source'] ?? 'website') ?></span><br>
          <span style="color:#999;font-size:.72rem"><?= time_ago($l['created_at']) ?></span>
        </td>
        <td style="text-align:center">
          <?php if ($l['ai_score'] !== null): ?>
          <?php $sc = (int)$l['ai_score'];
                $scoreColor = $sc>=70?'#065f46':($sc>=40?'#92400e':'#1e40af');
                $scoreBg    = $sc>=70?'#d1fae5':($sc>=40?'#fef3c7':'#dbeafe'); ?>
          <span style="background:<?= $scoreBg ?>;color:<?= $scoreColor ?>;padding:4px 12px;border-radius:100px;font-weight:800;font-size:.95rem"><?= $sc ?></span>
          <?php else: ?>
          <form method="POST" style="display:inline"><?= csrf_field() ?>
            <input type="hidden" name="action" value="re_score">
            <input type="hidden" name="id" value="<?= $l['id'] ?>">
            <button type="submit" style="background:#f3f4f6;color:#6b7280;border:none;padding:4px 10px;border-radius:6px;cursor:pointer;font-size:.75rem">Score</button>
          </form>
          <?php endif; ?>
        </td>
        <td>
          <?php if ($l['ai_label']): ?>
          <?php $lc = ['hot'=>'#fee2e2:#991b1b','warm'=>'#fef3c7:#92400e','cold'=>'#dbeafe:#1e40af'][$l['ai_label']] ?? '#f3f4f6:#6b7280';
                [$lbg,$lfg] = explode(':',$lc); ?>
          <span style="background:<?= $lbg ?>;color:<?= $lfg ?>;padding:3px 10px;border-radius:100px;font-size:.78rem;font-weight:700"><?= strtoupper($l['ai_label']) ?></span>
          <?php else: ?><span style="color:#ccc;font-size:.78rem">—</span><?php endif; ?>
        </td>
        <td style="font-size:.78rem;color:#555;max-width:180px"><?= e(mb_substr($l['ai_notes']??'',0,80)) ?></td>
        <td>
          <form method="POST" style="display:inline"><?= csrf_field() ?>
            <input type="hidden" name="action" value="update_status">
            <input type="hidden" name="id" value="<?= $l['id'] ?>">
            <select name="status" onchange="this.form.submit()" style="padding:4px 8px;border:1.5px solid #ddd;border-radius:6px;font-size:.78rem;background:#fff">
              <option value="new"       <?= $l['status']==='new'?'selected':'' ?>>Baru</option>
              <option value="contacted" <?= $l['status']==='contacted'?'selected':'' ?>>Dihubungi</option>
              <option value="proposal"  <?= $l['status']==='proposal'?'selected':'' ?>>Proposal</option>
              <option value="converted" <?= $l['status']==='converted'?'selected':'' ?>>✅ Closing</option>
              <option value="lost"      <?= $l['status']==='lost'?'selected':'' ?>>Batal</option>
            </select>
          </form>
        </td>
        <td>
          <?php if ($l['phone'] ?? ''): ?>
          <a href="<?= wa_url('Halo ' . $l['name'] . ' dari ' . ($l['company']?:'') . ', saya dari Wahana Totalita. Tertarik dengan program K3 kami?') ?>" style="display:block;background:#d1fae5;color:#065f46;padding:6px 10px;border-radius:6px;text-align:center;text-decoration:none;font-size:.78rem;font-weight:600;margin-bottom:4px">💬 Follow Up</a>
          <?php endif; ?>
          <form method="POST" style="display:inline"><?= csrf_field() ?>
            <input type="hidden" name="action" value="re_score">
            <input type="hidden" name="id" value="<?= $l['id'] ?>">
            <button type="submit" style="width:100%;background:#f3f4f6;color:#6b7280;border:none;padding:5px;border-radius:6px;cursor:pointer;font-size:.75rem">🤖 Re-score</button>
          </form>
        </td>
      </tr>
      <?php endforeach; ?>
      <?php if (empty($leads)): ?><tr><td colspan="8" style="text-align:center;padding:40px;color:#999">Tidak ada lead ditemukan</td></tr><?php endif; ?>
      </tbody>
    </table>
  </div>

  <?php if ($pages > 1): ?>
  <div style="display:flex;gap:8px;justify-content:center;margin-top:20px">
    <?php for($i=1;$i<=$pages;$i++): ?>
    <a href="?label=<?= e($label) ?>&status=<?= e($status) ?>&p=<?= $i ?>" style="padding:6px 12px;border-radius:6px;border:1px solid #ddd;text-decoration:none;background:<?= $i===$page?'var(--green)':'#fff' ?>;color:<?= $i===$page?'#fff':'#333' ?>;font-size:.82rem"><?= $i ?></a>
    <?php endfor; ?>
  </div>
  <?php endif; ?>
</div>
<script src="<?= SITE_URL ?>/assets/js/admin.js"></script>
</body></html>
