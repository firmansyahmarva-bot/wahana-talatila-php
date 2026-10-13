<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/jadwal-functions.php';

$year  = (int)($_GET['y'] ?? date('Y'));
$month = (int)($_GET['m'] ?? date('n'));
if ($month < 1)  { $month = 12; $year--; }
if ($month > 12) { $month = 1;  $year++; }

$calendar = get_schedules_calendar($year, $month);
$s = get_all_settings();
$monthNames = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
$prevM = $month - 1 < 1  ? 12 : $month - 1;
$prevY = $month - 1 < 1  ? $year - 1 : $year;
$nextM = $month + 1 > 12 ? 1  : $month + 1;
$nextY = $month + 1 > 12 ? $year + 1 : $year;
$firstDay = (int)date('N', mktime(0,0,0,$month,1,$year)); // 1=Mon
$daysInMonth = (int)date('t', mktime(0,0,0,$month,1,$year));
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kalender Pelatihan K3 <?= $monthNames[$month] ?> <?= $year ?> | Wahana Totalita</title>
<?php require __DIR__ . '/../includes/css.php'; ?>
<link rel="stylesheet" href="<?= asset_v('/assets/css/page/jadwal-kalender.css') ?>">
</head>
<body>
<?php include __DIR__ . '/../includes/navbar.php'; ?>

<div class="container cal-page">
  <div class="cal-nav">
    <a href="?m=<?= $prevM ?>&y=<?= $prevY ?>">← <?= $monthNames[$prevM] ?></a>
    <h2>📅 <?= $monthNames[$month] ?> <?= $year ?></h2>
    <a href="?m=<?= $nextM ?>&y=<?= $nextY ?>"><?= $monthNames[$nextM] ?> →</a>
  </div>

  <div class="calendar">
    <?php foreach (['Sen','Sel','Rab','Kam','Jum','Sab','Min'] as $d): ?>
    <div class="cal-head"><?= $d ?></div>
    <?php endforeach; ?>

    <?php
    $today = date('Y-m-d');
    // Empty cells before first day
    for ($i = 1; $i < $firstDay; $i++) echo '<div class="cal-day empty"></div>';
    for ($d = 1; $d <= $daysInMonth; $d++):
        $dateStr = sprintf('%04d-%02d-%02d', $year, $month, $d);
        $events  = $calendar[$dateStr] ?? [];
        $isToday = $dateStr === $today;
    ?>
    <div class="cal-day <?= $isToday ? 'today' : '' ?>">
      <div class="cal-day-num" <?= $isToday ? 'style="color:var(--orange)"' : '' ?>><?= $d ?></div>
      <?php foreach ($events as $ev): ?>
      <a href="/jadwal/<?= $ev['id'] ?>/" class="cal-event <?= $ev['mode'] ?? '' ?>"
         title="<?= e($ev['training_name']) ?>">
        <?= e(mb_substr($ev['training_name'],0,20)) ?>
      </a>
      <?php endforeach; ?>
    </div>
    <?php endfor; ?>

    <?php
    $totalCells = ($firstDay - 1) + $daysInMonth;
    $remaining  = $totalCells % 7 === 0 ? 0 : 7 - ($totalCells % 7);
    for ($i = 0; $i < $remaining; $i++) echo '<div class="cal-day empty"></div>';
    ?>
  </div>

  <div style="margin-top:20px;display:flex;gap:16px;flex-wrap:wrap">
    <span style="display:flex;align-items:center;gap:6px;font-size:.85rem"><span style="width:12px;height:12px;border-radius:2px;background:var(--green);display:inline-block"></span> Offline</span>
    <span style="display:flex;align-items:center;gap:6px;font-size:.85rem"><span style="width:12px;height:12px;border-radius:2px;background:var(--info);display:inline-block"></span> Online</span>
    <span style="display:flex;align-items:center;gap:6px;font-size:.85rem"><span style="width:12px;height:12px;border-radius:2px;background:var(--warning-text);display:inline-block"></span> Hybrid</span>
  </div>

  <div style="margin-top:32px;text-align:center">
    <a href="/jadwal/" style="display:inline-block;background:var(--orange);color:var(--surface);padding:12px 28px;border-radius:8px;text-decoration:none;font-weight:600">📋 Lihat Semua Jadwal</a>
  </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
<script src="<?= SITE_URL ?>/assets/js/main.js"></script>
</body></html>
