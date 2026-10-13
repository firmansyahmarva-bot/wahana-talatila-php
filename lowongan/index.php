<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/jobs-functions.php';

$s      = get_all_settings();
$search = sanitize($_GET['q'] ?? '');
$type   = sanitize($_GET['type'] ?? '');
$page   = max(1, (int)($_GET['p'] ?? 1));
$perPage= 16;
$offset = ($page - 1) * $perPage;

$opts = ['limit'=>$perPage,'offset'=>$offset,'status'=>'active'];
if ($search) $opts['search'] = $search;
if ($type)   $opts['type']   = $type;
$jobs = get_jobs($opts);

$metaTitle = 'Lowongan Kerja K3 & HSE Indonesia — Job Board Safety | Wahana Totalita';
$metaDesc  = 'Temukan lowongan kerja K3, HSE Officer, Safety Manager, QHSE Engineer di seluruh Indonesia. Update setiap hari.';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($metaTitle) ?></title>
<meta name="description" content="<?= e($metaDesc) ?>">
<link rel="canonical" href="<?= SITE_URL ?>/lowongan/">
<?php require __DIR__ . '/../includes/css.php'; ?>
<link rel="stylesheet" href="<?= asset_v('/assets/css/page/lowongan.css') ?>">
</head>
<body>
<?php include __DIR__ . '/../includes/navbar.php'; ?>

<section class="job-hero">
  <div class="container">
    <h1>💼 Lowongan Kerja K3 & HSE</h1>
    <p style="opacity:.85;max-width:560px;margin:0 auto">Temukan pekerjaan di bidang Keselamatan & Kesehatan Kerja terbaik di Indonesia</p>
    <form class="search-box" action="" method="GET">
      <input type="search" name="q" placeholder="Cari posisi (HSE Officer, Safety Manager, QHSE...)" value="<?= e($search) ?>">
      <button type="submit">🔍 Cari</button>
    </form>
  </div>
</section>

<div class="filter-bar">
  <div class="container">
    <form method="GET">
      <?php if ($search): ?><input type="hidden" name="q" value="<?= e($search) ?>"><?php endif; ?>
      <select name="type">
        <option value="">Semua Tipe</option>
        <option value="fulltime" <?= $type==='fulltime'?'selected':'' ?>>Full-time</option>
        <option value="contract" <?= $type==='contract'?'selected':'' ?>>Kontrak</option>
        <option value="parttime" <?= $type==='parttime'?'selected':'' ?>>Part-time</option>
      </select>
      <button type="submit">Filter</button>
      <?php if ($type || $search): ?><a href="/lowongan/" style="color:var(--text-light);font-size:.875rem">Reset</a><?php endif; ?>
    </form>
  </div>
</div>

<div class="container">
  <div class="jobs-list">
    <?php if (empty($jobs)): ?>
    <div class="empty-state">
      <div style="font-size:3rem;margin-bottom:16px">📭</div>
      <h3>Belum ada lowongan tersedia</h3>
      <p>Lowongan K3 akan segera tersedia. Hubungi kami untuk posting lowongan.</p>
      <a href="<?= wa_url('Halo, saya ingin posting lowongan kerja K3') ?>" style="display:inline-block;margin-top:16px;background:var(--mut);color:var(--surface);padding:12px 24px;border-radius:8px;text-decoration:none;font-weight:600">💬 Post Lowongan (Gratis)</a>
    </div>
    <?php else: ?>
    <?php foreach ($jobs as $j):
      $daysSince = floor((time() - strtotime($j['created_at'])) / 86400);
    ?>
    <div class="job-card">
      <div class="job-logo">🏢</div>
      <div class="job-info">
        <h2>
          <a href="/lowongan/<?= e($j['slug']) ?>/"><?= e($j['title']) ?></a>
          <?php if ($daysSince < 3): ?><span class="new-badge">BARU</span><?php endif; ?>
        </h2>
        <div class="job-company"><?= e($j['company']) ?></div>
        <div class="job-meta">
          <?php if ($j['location']): ?><span>📍 <?= e($j['location']) ?></span><?php endif; ?>
          <span class="job-badge badge-<?= e($j['type'] ?? 'fulltime') ?>"><?= strtoupper($j['type'] ?? 'FULL-TIME') ?></span>
          <?php if ($j['salary_min']): ?><span class="salary-tag">💰 <?= format_price((int)$j['salary_min']) ?>+</span><?php endif; ?>
          <span>📅 <?= $daysSince < 1 ? 'Hari ini' : ($daysSince === 1 ? '1 hari lalu' : $daysSince . ' hari lalu') ?></span>
        </div>
        <?php if ($j['requirements']): ?>
        <div style="margin-top:8px;font-size:.82rem;color:var(--slate-600)"><?= e(mb_substr(strip_tags($j['requirements']),0,100)) ?>...</div>
        <?php endif; ?>
      </div>
      <a href="/lowongan/<?= e($j['slug']) ?>/" class="btn-apply">Lihat Detail →</a>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>

    <div style="margin-top:32px;background:var(--info-bg);border-radius:12px;padding:24px;text-align:center">
      <h3 style="margin:0 0 8px;color:var(--mut)">Mau Rekrut Profesional K3?</h3>
      <p style="color:var(--slate-600);font-size:.9rem;margin:0 0 16px">Post lowongan kerja K3 Anda secara gratis</p>
      <a href="<?= wa_url('Halo, saya ingin posting lowongan kerja K3/HSE di website Wahana Totalita') ?>" style="display:inline-block;background:var(--mut);color:var(--surface);padding:12px 24px;border-radius:8px;text-decoration:none;font-weight:600">💬 Post Lowongan Gratis</a>
    </div>

    <div style="margin-top:20px;background:var(--success-bg);border-radius:12px;padding:24px;text-align:center">
      <p style="color:var(--slate-800);font-size:.9rem;margin:0 0 12px">Tingkatkan nilai jual Anda di dunia kerja K3</p>
      <a href="/jadwal/" style="display:inline-block;background:var(--orange);color:var(--surface);padding:12px 24px;border-radius:8px;text-decoration:none;font-weight:600">🎓 Ikuti Pelatihan K3 Bersertifikat</a>
    </div>
  </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
<script src="<?= SITE_URL ?>/assets/js/main.js"></script>
</body></html>
