<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/jadwal-functions.php';

$s       = get_all_settings();
$search  = sanitize($_GET['q'] ?? '');
$mode    = sanitize($_GET['mode'] ?? '');
$page    = max(1, (int)($_GET['p'] ?? 1));
$perPage = 12;
$offset  = ($page - 1) * $perPage;

$opts = ['limit'=>$perPage,'offset'=>$offset,'is_public'=>1,'status'=>'open'];
if ($search) $opts['search'] = $search;
if ($mode)   $opts['mode']   = $mode;

$batches    = get_public_schedules($opts);
$totalCount = get_upcoming_schedule_count();

$metaTitle = 'Jadwal Pelatihan K3 — Bersertifikat BNSP & Kemnaker RI | Wahana Totalita';
$metaDesc  = 'Lihat jadwal pelatihan K3, safety, lingkungan & AMDAL. Sertifikasi BNSP resmi. Daftar online langsung dapat nomor peserta.';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($metaTitle) ?></title>
<meta name="description" content="<?= e($metaDesc) ?>">
<link rel="canonical" href="<?= SITE_URL ?>/jadwal/">
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
.jadwal-hero{background:linear-gradient(135deg,var(--green),#1a5c3a);padding:60px 0;color:#fff;text-align:center}
.jadwal-hero h1{font-size:clamp(1.8rem,4vw,2.8rem);font-weight:800;margin:0 0 12px}
.jadwal-hero p{opacity:.85;max-width:600px;margin:0 auto 24px}
.stat-pills{display:flex;gap:16px;justify-content:center;flex-wrap:wrap;margin-top:20px}
.stat-pill{background:rgba(255,255,255,.15);padding:10px 20px;border-radius:100px;font-weight:600}
.jadwal-filters{background:#f8f8f8;border-bottom:1px solid #eee;padding:20px 0}
.filter-row{display:flex;gap:12px;align-items:center;flex-wrap:wrap}
.filter-row input{flex:1;min-width:200px;padding:10px 16px;border:1px solid #ddd;border-radius:8px;font-size:.95rem}
.filter-row select{padding:10px 16px;border:1px solid #ddd;border-radius:8px;background:#fff;font-size:.95rem;min-width:140px}
.filter-row button{background:var(--orange);color:#fff;border:none;padding:10px 20px;border-radius:8px;font-weight:600;cursor:pointer}
.jadwal-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:24px;padding:40px 0}
.jadwal-card{background:#fff;border-radius:12px;border:1px solid #eee;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.06);transition:.2s}
.jadwal-card:hover{box-shadow:0 8px 24px rgba(0,0,0,.12);transform:translateY(-2px)}
.jadwal-card-header{background:linear-gradient(135deg,var(--green),#1a5c3a);padding:20px;color:#fff}
.jadwal-card-header .batch-code{font-size:.8rem;opacity:.7;margin-bottom:6px;font-family:monospace}
.jadwal-card-header h3{font-size:1.05rem;font-weight:700;margin:0;line-height:1.4}
.jadwal-card-body{padding:20px}
.jadwal-meta{display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-bottom:16px}
.jadwal-meta-item{display:flex;align-items:flex-start;gap:8px;font-size:.875rem;color:#555}
.jadwal-meta-item .label{font-size:.75rem;color:#999;display:block}
.badge-mode{display:inline-block;padding:3px 10px;border-radius:100px;font-size:.75rem;font-weight:700}
.badge-online{background:#dbeafe;color:#1d4ed8}
.badge-offline{background:#d1fae5;color:#065f46}
.badge-hybrid{background:#fef3c7;color:#92400e}
.slots-bar{height:8px;background:#e5e7eb;border-radius:100px;overflow:hidden;margin-bottom:8px}
.slots-fill{height:100%;background:var(--orange);border-radius:100px;transition:.3s}
.slots-fill.full{background:#ef4444}
.slots-fill.low{background:#f59e0b}
.btn-daftar{display:block;text-align:center;background:var(--orange);color:#fff;padding:12px;border-radius:8px;font-weight:700;text-decoration:none;margin-top:12px}
.btn-daftar:hover{background:var(--orange-dark)}
.btn-daftar.full{background:#999;cursor:not-allowed}
.price-tag{font-size:1.2rem;font-weight:800;color:var(--green)}
.price-tag.free{color:#059669}
.nav-tabs{display:flex;gap:0;border-bottom:2px solid #eee;margin-bottom:32px;padding-top:24px}
.nav-tab{padding:12px 24px;font-weight:600;color:#999;text-decoration:none;border-bottom:2px solid transparent;margin-bottom:-2px}
.nav-tab.active{color:var(--green);border-bottom-color:var(--green)}
.empty-state{text-align:center;padding:80px 20px;color:#999}
.pagination{display:flex;gap:8px;justify-content:center;padding:40px 0}
.page-btn{display:inline-block;padding:8px 16px;border-radius:8px;border:1px solid #ddd;text-decoration:none;color:#333;font-weight:600}
.page-btn.active{background:var(--green);color:#fff;border-color:var(--green)}
</style>
</head>
<body>
<?php include __DIR__ . '/../includes/navbar.php'; ?>

<section class="jadwal-hero">
  <div class="container">
    <h1>📅 Jadwal Pelatihan K3</h1>
    <p>Pelatihan K3 bersertifikasi BNSP & Kemnaker RI — online, offline, dan hybrid. Daftar sekarang dan dapatkan sertifikat resmi.</p>
    <div class="stat-pills">
      <span class="stat-pill">🎓 <?= $totalCount ?>+ Batch Tersedia</span>
      <span class="stat-pill">✅ Sertifikat BNSP Resmi</span>
      <span class="stat-pill">🏛️ Kemnaker RI</span>
    </div>
  </div>
</section>

<div class="jadwal-filters">
  <div class="container">
    <form class="filter-row" method="GET" action="">
      <input type="search" name="q" placeholder="Cari pelatihan (K3 Umum, Forklift, AMDAL...)" value="<?= e($search) ?>">
      <select name="mode">
        <option value="">Semua Mode</option>
        <option value="online"  <?= $mode==='online'  ?'selected':'' ?>>Online</option>
        <option value="offline" <?= $mode==='offline' ?'selected':'' ?>>Offline</option>
        <option value="hybrid"  <?= $mode==='hybrid'  ?'selected':'' ?>>Hybrid</option>
      </select>
      <button type="submit">🔍 Cari</button>
      <a href="/jadwal/kalender/" style="padding:10px 20px;background:var(--green);color:#fff;border-radius:8px;text-decoration:none;font-weight:600;">📅 Lihat Kalender</a>
    </form>
  </div>
</div>

<div class="container">
  <?php if (empty($batches)): ?>
  <div class="empty-state">
    <span style="font-size:4rem;display:block;margin-bottom:16px">📭</span>
    <h3>Tidak ada jadwal tersedia</h3>
    <p>Coba kata kunci lain atau hubungi kami untuk jadwal khusus.</p>
    <a href="<?= wa_url('Halo, saya ingin info jadwal pelatihan K3') ?>" style="display:inline-block;margin-top:16px;background:var(--orange);color:#fff;padding:12px 24px;border-radius:8px;text-decoration:none;font-weight:600">💬 Tanya Jadwal</a>
  </div>
  <?php else: ?>
  <div class="jadwal-grid">
    <?php foreach ($batches as $b):
      $pct    = $b['max_participants'] > 0 ? min(100, (int)($b['current_participants']/$b['max_participants']*100)) : 0;
      $sisa   = $b['max_participants'] - $b['current_participants'];
      $isFull = $b['status'] === 'full' || $sisa <= 0;
      $fillClass = $pct >= 90 ? 'full' : ($pct >= 70 ? 'low' : '');
    ?>
    <div class="jadwal-card">
      <div class="jadwal-card-header">
        <div class="batch-code"><?= e($b['batch_code']) ?></div>
        <h3><?= e($b['training_name']) ?></h3>
        <?php if ($b['certification_body']): ?>
        <div style="margin-top:8px;font-size:.8rem;opacity:.8">🎓 <?= e($b['certification_body']) ?></div>
        <?php endif; ?>
      </div>
      <div class="jadwal-card-body">
        <div class="jadwal-meta">
          <div class="jadwal-meta-item">
            <div>
              <span class="label">Tanggal</span>
              📅 <?= format_date($b['start_date']) ?>
              <?php if ($b['end_date'] && $b['end_date'] !== $b['start_date']): ?>
              — <?= format_date($b['end_date']) ?>
              <?php endif; ?>
            </div>
          </div>
          <div class="jadwal-meta-item">
            <div>
              <span class="label">Mode</span>
              <span class="badge-mode badge-<?= e($b['mode'] ?? 'offline') ?>"><?= strtoupper($b['mode'] ?? 'OFFLINE') ?></span>
            </div>
          </div>
          <?php if ($b['location']): ?>
          <div class="jadwal-meta-item">
            <div>
              <span class="label">Lokasi</span>
              📍 <?= e(mb_substr($b['location'],0,30)) ?>
            </div>
          </div>
          <?php endif; ?>
          <div class="jadwal-meta-item">
            <div>
              <span class="label">Durasi</span>
              ⏱ <?= e($b['duration_days'] ?? '?') ?> hari
            </div>
          </div>
        </div>

        <?php if ($b['max_participants'] > 0): ?>
        <div style="font-size:.8rem;color:#999;margin-bottom:4px">
          Peserta: <?= $b['current_participants'] ?>/<?= $b['max_participants'] ?>
          <?php if (!$isFull): ?>
          <span style="color:var(--orange);font-weight:600">(<?= $sisa ?> kursi tersisa)</span>
          <?php else: ?>
          <span style="color:#ef4444;font-weight:600">(PENUH)</span>
          <?php endif; ?>
        </div>
        <div class="slots-bar"><div class="slots-fill <?= $fillClass ?>" style="width:<?= $pct ?>%"></div></div>
        <?php endif; ?>

        <div style="display:flex;align-items:center;justify-content:space-between;margin-top:12px">
          <?php if ($b['price'] > 0): ?>
          <div class="price-tag"><?= format_price((int)$b['price']) ?></div>
          <?php else: ?>
          <div class="price-tag free">GRATIS</div>
          <?php endif; ?>
          <?php if ($b['price_notes']): ?>
          <div style="font-size:.75rem;color:#999"><?= e($b['price_notes']) ?></div>
          <?php endif; ?>
        </div>

        <?php if (!$isFull): ?>
        <a href="/jadwal/<?= $b['id'] ?>/" class="btn-daftar">📝 Detail & Daftar Sekarang</a>
        <?php else: ?>
        <a href="<?= wa_url('Halo, saya ingin waiting list pelatihan ' . $b['training_name']) ?>" class="btn-daftar" style="background:var(--green);">📋 Masuk Waiting List</a>
        <?php endif; ?>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>
</div>

<!-- CTA section -->
<section style="background:var(--green);padding:60px 0;text-align:center;color:#fff">
  <div class="container">
    <h2 style="font-size:1.8rem;font-weight:800;margin:0 0 12px">Tidak ada jadwal yang cocok?</h2>
    <p style="opacity:.85;margin-bottom:24px">Hubungi kami untuk pelatihan in-house sesuai kebutuhan perusahaan Anda</p>
    <a href="<?= wa_url('Halo, saya ingin info pelatihan in-house K3') ?>" style="display:inline-block;background:var(--orange);color:#fff;padding:14px 32px;border-radius:12px;font-weight:700;font-size:1.1rem;text-decoration:none">💬 Konsultasi Pelatihan In-House</a>
  </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
<script src="<?= SITE_URL ?>/assets/js/main.js"></script>
</body></html>
