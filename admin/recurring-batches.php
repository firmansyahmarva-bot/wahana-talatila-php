<?php
require_once __DIR__.'/../config.php';
require_once __DIR__.'/partials/auth.php';
require_auth('batches');
$pdo = get_pdo();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && csrf_verify($_POST['csrf_token'] ?? '')) {
    $action = $_POST['action'] ?? 'save';
    if ($action === 'delete') {
        $pdo->prepare('DELETE FROM training_recurring_rules WHERE id=?')->execute([(int)$_POST['id']]);
        flash_set('success', 'Jadwal bulanan dihapus.');
    } else {
        $id = (int)($_POST['id'] ?? 0);
        $data = [(int)$_POST['course_id'], max(1,min(28,(int)$_POST['day_of_month'])), max(1,min(30,(int)$_POST['duration_days'])), $_POST['mode']??'online', trim($_POST['venue']??''), (int)preg_replace('/\D/','',$_POST['price']??'0'), max(1,(int)$_POST['max_participants']), max(1,min(12,(int)$_POST['months_ahead'])), isset($_POST['is_active'])?1:0];
        if ($id) {
            $data[] = $id;
            $pdo->prepare('UPDATE training_recurring_rules SET course_id=?,day_of_month=?,duration_days=?,mode=?,venue=?,price=?,max_participants=?,months_ahead=?,is_active=? WHERE id=?')->execute($data);
        } else {
            $pdo->prepare('INSERT INTO training_recurring_rules (course_id,day_of_month,duration_days,mode,venue,price,max_participants,months_ahead,is_active) VALUES (?,?,?,?,?,?,?,?,?) ON DUPLICATE KEY UPDATE day_of_month=VALUES(day_of_month),duration_days=VALUES(duration_days),venue=VALUES(venue),price=VALUES(price),max_participants=VALUES(max_participants),months_ahead=VALUES(months_ahead),is_active=VALUES(is_active)')->execute($data);
        }
        flash_set('success', 'Jadwal bulanan disimpan. Cron akan membuat batch otomatis.');
    }
    redirect(SITE_URL.'/admin/recurring-batches.php');
}

$rules = $pdo->query('SELECT r.*,t.name course_name FROM training_recurring_rules r JOIN trainings t ON t.id=r.course_id ORDER BY t.name')->fetchAll();
$courses = $pdo->query('SELECT id,name,price,duration_days FROM trainings WHERE is_active=1 ORDER BY name')->fetchAll();
$edit = null;
if (!empty($_GET['edit'])) {
    $q = $pdo->prepare('SELECT * FROM training_recurring_rules WHERE id=?');
    $q->execute([(int)$_GET['edit']]);
    $edit = $q->fetch();
}
$flash = flash_get();
?>
<!doctype html><html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><meta name="robots" content="noindex,nofollow"><title>Jadwal Bulanan — Admin</title><link rel="stylesheet" href="/admin/assets/admin.css"></head>
<body><div class="admin-layout"><?php require __DIR__.'/partials/sidebar.php';?><main class="admin-main"><div class="admin-topbar"><div class="topbar-title">Jadwal Bulanan Otomatis</div></div><div class="admin-content">
<?php if ($flash): ?><div class="alert alert-success"><?=e($flash['message'])?></div><?php endif; ?>
<div class="card" style="padding:24px"><h2><?=$edit?'Edit':'Tambah'?> Program Bulanan</h2><p>Pilih program. Harga dan durasi terisi otomatis, tetapi tetap bisa Anda edit sebelum disimpan.</p>
<form method="post"><?=csrf_field()?><input type="hidden" name="action" value="save"><input type="hidden" name="id" value="<?=$edit['id']??0?>"><div class="form-grid">
<div class="form-group form-full"><label class="form-label">Program</label><select class="form-select" id="course_id" name="course_id" required><?php foreach ($courses as $c): ?><option value="<?=$c['id']?>" data-price="<?=(int)$c['price']?>" data-duration="<?=(int)$c['duration_days']?>" <?=($edit['course_id']??0)==$c['id']?'selected':''?>><?=e($c['name'])?></option><?php endforeach; ?></select></div>
<div class="form-group"><label class="form-label">Mulai setiap tanggal (1-28)</label><input class="form-input" type="number" min="1" max="28" name="day_of_month" value="<?=$edit['day_of_month']??1?>"></div>
<div class="form-group"><label class="form-label">Durasi (hari)</label><input class="form-input" id="duration_days" type="number" min="1" max="30" name="duration_days" value="<?=$edit['duration_days']??1?>"></div>
<div class="form-group"><label class="form-label">Mode</label><select class="form-select" name="mode"><?php foreach (['online'=>'Online','offline'=>'Tatap Muka','hybrid'=>'Hybrid'] as $k=>$v): ?><option value="<?=$k?>" <?=($edit['mode']??'online')===$k?'selected':''?>><?=$v?></option><?php endforeach; ?></select></div>
<div class="form-group"><label class="form-label">Buat berapa bulan ke depan</label><input class="form-input" type="number" min="1" max="12" name="months_ahead" value="<?=$edit['months_ahead']??3?>"></div>
<div class="form-group"><label class="form-label">Harga</label><input class="form-input" id="price" name="price" value="<?=number_format((int)($edit['price']??0),0,',','.')?>"></div>
<div class="form-group"><label class="form-label">Kapasitas</label><input class="form-input" type="number" min="1" name="max_participants" value="<?=$edit['max_participants']??20?>"></div>
<div class="form-group form-full"><label class="form-label">Lokasi / Zoom Meeting</label><input class="form-input" name="venue" value="<?=e($edit['venue']??'Zoom Meeting')?>"></div>
<div class="form-group form-full"><label><input type="checkbox" name="is_active" value="1" <?=!$edit||!empty($edit['is_active'])?'checked':''?>> Aktif</label></div></div><button class="btn btn-primary">Simpan</button></form></div>
<div class="card"><div class="table-wrap"><table class="admin-table"><thead><tr><th>Program</th><th>Tanggal</th><th>Durasi</th><th>Mode</th><th>Ke depan</th><th>Aksi</th></tr></thead><tbody><?php foreach ($rules as $r): ?><tr><td><?=e($r['course_name'])?></td><td><?=$r['day_of_month']?> tiap bulan</td><td><?=$r['duration_days']?> hari</td><td><?=e($r['mode'])?></td><td><?=$r['months_ahead']?> bulan</td><td><a class="btn btn-xs btn-outline" href="?edit=<?=$r['id']?>">Edit</a> <form method="post" style="display:inline"><?=csrf_field()?><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?=$r['id']?>"><button class="btn btn-xs btn-danger">Hapus</button></form></td></tr><?php endforeach; ?></tbody></table></div></div>
</div></main></div>
<script>
const courseSelect = document.getElementById('course_id');
const priceInput = document.getElementById('price');
const durationInput = document.getElementById('duration_days');
function fillProgramDefaults() {
    const option = courseSelect.options[courseSelect.selectedIndex];
    priceInput.value = new Intl.NumberFormat('id-ID').format(Number(option.dataset.price || 0));
    durationInput.value = Number(option.dataset.duration || 1);
}
courseSelect.addEventListener('change', fillProgramDefaults);
<?php if (!$edit): ?>fillProgramDefaults();<?php endif; ?>
</script></body></html>
