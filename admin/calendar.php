<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/partials/auth.php';
require_auth('calendar');

$pdo = get_pdo();

// ── Handle save event ─────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && csrf_verify($_POST['csrf_token'] ?? '')) {
    $action = $_POST['action'] ?? '';
    if ($action === 'save_event') {
        $id    = (int)($_POST['id'] ?? 0);
        $title = trim($_POST['title'] ?? '');
        $desc  = trim($_POST['description'] ?? '');
        $date  = $_POST['event_date'] ?? '';
        $start = $_POST['start_time'] ?: null;
        $end   = $_POST['end_time']   ?: null;
        $type  = $_POST['type'] ?? 'other';
        $color = $_POST['color'] ?? '#0A4A2E';
        $all   = isset($_POST['all_day']) ? 1 : 0;

        if ($title && $date) {
            if ($id) {
                $pdo->prepare("UPDATE calendar_events SET title=?,description=?,event_date=?,start_time=?,end_time=?,type=?,color=?,all_day=? WHERE id=?")
                    ->execute([$title,$desc,$date,$start,$end,$type,$color,$all,$id]);
            } else {
                $pdo->prepare("INSERT INTO calendar_events (title,description,event_date,start_time,end_time,type,color,all_day,created_by) VALUES (?,?,?,?,?,?,?,?,?)")
                    ->execute([$title,$desc,$date,$start,$end,$type,$color,$all,current_user_id()]);
            }
            flash_set('success', 'Event berhasil disimpan.');
        }
    } elseif ($action === 'delete_event') {
        $pdo->prepare("DELETE FROM calendar_events WHERE id=?")->execute([(int)$_POST['id']]);
        flash_set('success', 'Event dihapus.');
    }
    redirect(SITE_URL . '/admin/calendar.php?' . http_build_query(['year'=>$_POST['cal_year']??date('Y'),'month'=>$_POST['cal_month']??date('n')]));
}

// ── Calendar data ─────────────────────────────────────────────────────────
$year  = (int)($_GET['year']  ?? date('Y'));
$month = (int)($_GET['month'] ?? date('n'));
if ($month < 1)  { $month = 12; $year--; }
if ($month > 12) { $month = 1;  $year++; }

$first_day  = mktime(0,0,0,$month,1,$year);
$days_in    = (int)date('t', $first_day);
$start_dow  = (int)date('N', $first_day); // 1=Mon 7=Sun

// Load events for this month
$stmt = $pdo->prepare("SELECT * FROM calendar_events WHERE YEAR(event_date)=? AND MONTH(event_date)=? ORDER BY event_date ASC, start_time ASC");
$stmt->execute([$year,$month]);
$events_raw = $stmt->fetchAll();

// Group by day
$events_by_day = [];
foreach ($events_raw as $ev) {
    $d = (int)date('j', strtotime($ev['event_date']));
    $events_by_day[$d][] = $ev;
}

// Also load expiring certs as events
if (can('certifications')) {
    $stmt = $pdo->prepare(
        "SELECT c.expiry_date, cl.name AS client_name, t.name AS course_name
         FROM certifications c
         JOIN clients cl ON cl.id=c.client_id
         JOIN trainings t ON t.id=c.course_id
         WHERE YEAR(c.expiry_date)=? AND MONTH(c.expiry_date)=?"
    );
    $stmt->execute([$year,$month]);
    foreach ($stmt->fetchAll() as $ce) {
        $d = (int)date('j', strtotime($ce['expiry_date']));
        $events_by_day[$d][] = [
            'id'    => 0,
            'title' => '⚠️ Exp: '.$ce['client_name'],
            'type'  => 'reminder',
            'color' => '#d97706',
            'description' => 'Sertifikasi '.$ce['course_name'].' kedaluwarsa',
            'all_day' => 1,
        ];
    }
}

// Edit event
$edit_event = null;
if (!empty($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM calendar_events WHERE id=?");
    $stmt->execute([(int)$_GET['edit']]);
    $edit_event = $stmt->fetch();
}
$prefill_date = $_GET['date'] ?? '';

$months_id = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
$flash = flash_get();
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kalender — Wahana Totalita Admin</title>
<meta name="robots" content="noindex,nofollow">
<link rel="stylesheet" href="/admin/assets/admin.css">
<style>
.cal-cell { min-height: 90px; cursor: pointer; }
.cal-cell:hover { background: #f8fafc; }
.type-colors { display:flex; gap:8px; flex-wrap:wrap; margin-top:12px; }
.type-dot { display:flex; align-items:center; gap:5px; font-size:11px; color:#6b7280; }
.type-dot::before { content:''; width:10px; height:10px; border-radius:50%; flex-shrink:0; }
</style>
</head>
<body>
<div class="admin-layout">
  <div class="mobile-overlay" id="mobileOverlay"></div>
  <?php require __DIR__ . '/partials/sidebar.php'; ?>
  <main class="admin-main">
    <div class="admin-topbar">
      <button class="topbar-hamburger" id="hamburger"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg></button>
      <div class="topbar-title">Kalender & Jadwal</div>
      <div class="topbar-actions">
        <button class="topbar-btn topbar-btn-primary" onclick="openModal('modalEvent')">+ Tambah Event</button>
      </div>
    </div>

    <div class="admin-content">
      <?php if ($flash): ?>
      <div id="flash-message" class="alert alert-<?= $flash['type']==='success'?'success':'error' ?>"><?= e($flash['message']) ?></div>
      <?php endif; ?>

      <div class="cal-wrap card">
        <!-- Navigation -->
        <div class="cal-nav">
          <a href="?year=<?= $month===1?$year-1:$year ?>&month=<?= $month===1?12:$month-1 ?>" class="cal-nav-btn">‹</a>
          <h3><?= $months_id[$month] ?> <?= $year ?></h3>
          <a href="?year=<?= $month===12?$year+1:$year ?>&month=<?= $month===12?1:$month+1 ?>" class="cal-nav-btn">›</a>
        </div>

        <!-- Day headers -->
        <div class="cal-grid">
          <?php foreach (['Sen','Sel','Rab','Kam','Jum','Sab','Min'] as $dh): ?>
          <div class="cal-day-header"><?= $dh ?></div>
          <?php endforeach; ?>

          <?php
          // Empty cells before first day
          for ($e=1; $e < $start_dow; $e++) {
              echo '<div class="cal-cell other-month"></div>';
          }
          // Days
          $today_day = (int)date('j');
          $today_mon = (int)date('n');
          $today_yr  = (int)date('Y');
          for ($d=1; $d<=$days_in; $d++):
            $is_today = $d===$today_day && $month===$today_mon && $year===$today_yr;
            $date_str = sprintf('%04d-%02d-%02d', $year, $month, $d);
          ?>
          <div class="cal-cell <?= $is_today?'today':'' ?>"
               onclick="prefillDate('<?= $date_str ?>')">
            <div class="cal-date"><?= $d ?></div>
            <?php foreach ($events_by_day[$d] ?? [] as $ev): ?>
            <div class="cal-event"
                 style="background:<?= e($ev['color']) ?>22;color:<?= e($ev['color']) ?>"
                 onclick="event.stopPropagation();<?= $ev['id']>0 ? "window.location='?edit={$ev['id']}&year=$year&month=$month'" : '' ?>"
                 title="<?= e($ev['description'] ?? $ev['title']) ?>">
              <?= e($ev['title']) ?>
            </div>
            <?php endforeach; ?>
          </div>
          <?php endfor; ?>

          <?php
          // Trailing empty cells
          $total_cells = $start_dow - 1 + $days_in;
          $trailing = $total_cells % 7 === 0 ? 0 : 7 - ($total_cells % 7);
          for ($e=0; $e < $trailing; $e++) echo '<div class="cal-cell other-month"></div>';
          ?>
        </div>

        <!-- Legend -->
        <div style="padding:12px 16px;border-top:1px solid var(--border, #e5e9ef)">
          <div class="type-colors">
            <div class="type-dot" style="--c:#0A4A2E"><span style="width:10px;height:10px;border-radius:50%;background:#0A4A2E;display:inline-block"></span> Pelatihan</div>
            <div class="type-dot"><span style="width:10px;height:10px;border-radius:50%;background:#3b82f6;display:inline-block"></span> Meeting</div>
            <div class="type-dot"><span style="width:10px;height:10px;border-radius:50%;background:#d97706;display:inline-block"></span> Reminder Exp.</div>
            <div class="type-dot"><span style="width:10px;height:10px;border-radius:50%;background:#ef4444;display:inline-block"></span> Deadline</div>
            <div class="type-dot"><span style="width:10px;height:10px;border-radius:50%;background:#8b5cf6;display:inline-block"></span> Lainnya</div>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>

<!-- ── Add/Edit Event Modal ── -->
<div class="modal-overlay <?= $edit_event?'open':'' ?>" id="modalEvent">
  <div class="modal">
    <div class="modal-header">
      <div class="modal-title"><?= $edit_event?'Edit Event':'Tambah Event / Catatan' ?></div>
      <button class="modal-close" onclick="closeModal('modalEvent')">✕</button>
    </div>
    <form method="post">
      <?= csrf_field() ?>
      <input type="hidden" name="action" value="save_event">
      <input type="hidden" name="id" value="<?= $edit_event['id']??0 ?>">
      <input type="hidden" name="cal_year"  value="<?= $year ?>">
      <input type="hidden" name="cal_month" value="<?= $month ?>">
      <div class="modal-body">
        <div class="form-grid">
          <div class="form-group form-full">
            <label class="form-label">Judul / Catatan <span>*</span></label>
            <input type="text" name="title" class="form-input" value="<?= e($edit_event['title']??'') ?>" required autofocus>
          </div>
          <div class="form-group">
            <label class="form-label">Tanggal <span>*</span></label>
            <input type="date" name="event_date" id="eventDate" class="form-input"
                   value="<?= $edit_event['event_date']??$prefill_date ?>" required>
          </div>
          <div class="form-group">
            <label class="form-label">Tipe Event</label>
            <select name="type" class="form-select">
              <?php foreach (['training'=>'Pelatihan','reminder'=>'Reminder','meeting'=>'Meeting','deadline'=>'Deadline','holiday'=>'Libur','other'=>'Lainnya'] as $k=>$v): ?>
              <option value="<?= $k ?>" <?= ($edit_event['type']??'other')===$k?'selected':'' ?>><?= $v ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Warna</label>
            <input type="color" name="color" class="form-input" value="<?= $edit_event['color']??'#0A4A2E' ?>" style="height:40px;padding:3px">
          </div>
          <div class="form-group">
            <label class="form-label">Jam Mulai</label>
            <input type="time" name="start_time" class="form-input" value="<?= $edit_event['start_time']??'' ?>">
          </div>
          <div class="form-group">
            <label class="form-label">Jam Selesai</label>
            <input type="time" name="end_time" class="form-input" value="<?= $edit_event['end_time']??'' ?>">
          </div>
          <div class="form-group form-full">
            <label class="form-label">Keterangan / Catatan</label>
            <textarea name="description" class="form-textarea"><?= e($edit_event['description']??'') ?></textarea>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <?php if ($edit_event): ?>
        <form method="post" style="margin-right:auto" onsubmit="return confirm('Hapus event ini?')">
          <?= csrf_field() ?>
          <input type="hidden" name="action" value="delete_event">
          <input type="hidden" name="id" value="<?= $edit_event['id'] ?>">
          <input type="hidden" name="cal_year"  value="<?= $year ?>">
          <input type="hidden" name="cal_month" value="<?= $month ?>">
          <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
        </form>
        <?php endif; ?>
        <button type="button" class="btn btn-outline" onclick="closeModal('modalEvent')">Batal</button>
        <button type="submit" class="btn btn-primary">💾 Simpan</button>
      </div>
    </form>
  </div>
</div>

<script src="/admin/assets/admin.js"></script>
<script>
<?php if ($edit_event || $prefill_date): ?>openModal('modalEvent');<?php endif; ?>
function prefillDate(date) {
  document.getElementById('eventDate').value = date;
  openModal('modalEvent');
}
</script>
</body>
</html>
