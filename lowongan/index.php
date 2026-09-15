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
<link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/style.css">
<?= theme_css_vars($s) ?>
<style>
.job-hero{background:linear-gradient(135deg,#1e3a5f,#2d5282);padding:56px 0;color:#fff;text-align:center}
.job-hero h1{font-size:clamp(1.8rem,3.5vw,2.5rem);font-weight:800;margin:0 0 12px}
.search-box{background:#fff;border-radius:12px;padding:6px;display:flex;gap:8px;max-width:560px;margin:20px auto 0;box-shadow:0 4px 20px rgba(0,0,0,.2)}
.search-box input{flex:1;border:none;outline:none;padding:10px 16px;font-size:1rem;background:transparent;color:#222}
.search-box button{background:#2d5282;color:#fff;border:none;padding:10px 20px;border-radius:8px;cursor:pointer;font-weight:600}
.filter-bar{background:#f8f8f8;border-bottom:1px solid #eee;padding:16px 0}
.filter-bar form{display:flex;gap:12px;flex-wrap:wrap;align-items:center}
.filter-bar select{padding:8px 14px;border:1px solid #ddd;border-radius:8px;font-size:.875rem}
.filter-bar button{padding:8px 16px;background:#2d5282;color:#fff;border:none;border-radius:8px;font-weight:600;cursor:pointer}
.jobs-list{padding:32px 0;max-width:820px;margin:0 auto}
.job-card{background:#fff;border-radius:12px;border:1px solid #eee;padding:24px;margin-bottom:16px;display:flex;gap:20px;align-items:flex-start;transition:.2s;box-shadow:0 2px 8px rgba(0,0,0,.05)}
.job-card:hover{border-color:#2d5282;box-shadow:0 4px 16px rgba(0,0,0,.1)}
.job-logo{width:56px;height:56px;border-radius:8px;background:#f0f4ff;display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0}
.job-info{flex:1;min-width:0}
.job-info h2{font-size:1rem;font-weight:700;margin:0 0 4px}
.job-info h2 a{text-decoration:none;color:#1a1a1a}
.job-info h2 a:hover{color:#2d5282}
.job-company{font-size:.875rem;color:#2d5282;font-weight:600;margin-bottom:8px}
.job-meta{display:flex;gap:14px;flex-wrap:wrap;font-size:.8rem;color:#999}
.job-badge{display:inline-block;padding:3px 10px;border-radius:100px;font-size:.75rem;font-weight:700}
.badge-fulltime{background:#dbeafe;color:#1d4ed8}
.badge-contract{background:#fef3c7;color:#92400e}
.badge-parttime{background:#d1fae5;color:#065f46}
.btn-apply{display:block;text-align:center;padding:10px 20px;background:#2d5282;color:#fff;border-radius:8px;text-decoration:none;font-weight:600;font-size:.875rem;flex-shrink:0;white-space:nowrap}
.btn-apply:hover{background:#1e3a5f}
.salary-tag{background:#f0fdf4;color:#059669;padding:4px 10px;border-radius:100px;font-size:.78rem;font-weight:600}
.new-badge{background:#fee2e2;color:#991b1b;padding:2px 8px;border-radius:100px;font-size:.72rem;font-weight:700}
.empty-state{text-align:center;padding:60px 20px;color:#999}
@media(max-width:600px){.job-card{flex-direction:column}.btn-apply{width:100%;margin-top:12px}}
</style>
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
      <?php if ($type || $search): ?><a href="/lowongan/" style="color:#999;font-size:.875rem">Reset</a><?php endif; ?>
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
      <a href="<?= wa_url('Halo, saya ingin posting lowongan kerja K3') ?>" style="display:inline-block;margin-top:16px;background:#2d5282;color:#fff;padding:12px 24px;border-radius:8px;text-decoration:none;font-weight:600">💬 Post Lowongan (Gratis)</a>
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
        <div style="margin-top:8px;font-size:.82rem;color:#666"><?= e(mb_substr(strip_tags($j['requirements']),0,100)) ?>...</div>
        <?php endif; ?>
      </div>
      <a href="/lowongan/<?= e($j['slug']) ?>/" class="btn-apply">Lihat Detail →</a>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>

    <div style="margin-top:32px;background:#f0f4ff;border-radius:12px;padding:24px;text-align:center">
      <h3 style="margin:0 0 8px;color:#2d5282">Mau Rekrut Profesional K3?</h3>
      <p style="color:#666;font-size:.9rem;margin:0 0 16px">Post lowongan kerja K3 Anda secara gratis</p>
      <a href="<?= wa_url('Halo, saya ingin posting lowongan kerja K3/HSE di website Wahana Totalita') ?>" style="display:inline-block;background:#2d5282;color:#fff;padding:12px 24px;border-radius:8px;text-decoration:none;font-weight:600">💬 Post Lowongan Gratis</a>
    </div>

    <div style="margin-top:20px;background:#f0f9f0;border-radius:12px;padding:24px;text-align:center">
      <p style="color:#333;font-size:.9rem;margin:0 0 12px">Tingkatkan nilai jual Anda di dunia kerja K3</p>
      <a href="/jadwal/" style="display:inline-block;background:var(--orange);color:#fff;padding:12px 24px;border-radius:8px;text-decoration:none;font-weight:600">🎓 Ikuti Pelatihan K3 Bersertifikat</a>
    </div>
  </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
<script src="<?= SITE_URL ?>/assets/js/main.js"></script>
</body></html>
