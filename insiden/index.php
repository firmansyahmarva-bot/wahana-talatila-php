<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/incident-functions.php';

$s      = get_all_settings();
$search = sanitize($_GET['q'] ?? '');
$sector = sanitize($_GET['sector'] ?? '');
$prov   = sanitize($_GET['prov'] ?? '');
$page   = max(1, (int)($_GET['p'] ?? 1));
$perPage= 16;
$offset = ($page - 1) * $perPage;

$opts = ['limit'=>$perPage,'offset'=>$offset];
if ($search) $opts['search'] = $search;
if ($sector) $opts['industry'] = $sector;
if ($prov)   $opts['province'] = $prov;

$incidents  = get_incidents($opts);
$total      = count_incidents($opts);
$totalPages = max(1, (int)ceil($total / $perPage));
$filters    = get_incident_filters();
$stats      = get_incident_stats();

$metaTitle = 'Database Kecelakaan Kerja K3 Indonesia — Insiden Terkini 2024 | Wahana Totalita';
$metaDesc  = 'Database kecelakaan kerja dan insiden K3 Indonesia. Data real-time dari berbagai sektor: konstruksi, mining, oil & gas, manufaktur. Update otomatis setiap hari.';

// Schema: Dataset
$schema = json_encode([
  "@context"=>"https://schema.org",
  "@type"=>"Dataset",
  "name"=>"Database Kecelakaan Kerja K3 Indonesia",
  "description"=>$metaDesc,
  "url"=>SITE_URL."/insiden/",
  "creator"=>["@type"=>"Organization","name"=>"Wahana Totalita Konsultan"],
  "keywords"=>["K3","kecelakaan kerja","HSE","occupational safety","Indonesia"],
  "temporalCoverage"=>"2020/.."
]);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($metaTitle) ?></title>
<meta name="description" content="<?= e($metaDesc) ?>">
<link rel="canonical" href="<?= SITE_URL ?>/insiden/">
<?php require __DIR__ . '/../includes/css.php'; ?>
<script type="application/ld+json"><?= $schema ?></script>
<link rel="stylesheet" href="<?= asset_v('/assets/css/page/insiden.css') ?>">
</head>
<body>
<?php include __DIR__ . '/../includes/navbar.php'; ?>

<section class="insiden-hero">
  <div class="container">
    <div style="margin-bottom:12px"><span class="live-badge"><span class="live-dot"></span> Update Otomatis Setiap Hari</span></div>
    <h1>🚨 Database Kecelakaan Kerja Indonesia</h1>
    <p style="opacity:.85;max-width:580px;margin:0 auto">Satu-satunya database publik kecelakaan kerja & insiden K3 Indonesia yang update otomatis. Gratis untuk HSE profesional.</p>
    <div class="stat-row">
      <div class="stat"><strong><?= number_format($stats['total'] ?? 0) ?></strong><span>Total Insiden</span></div>
      <div class="stat"><strong><?= number_format($stats['fatal'] ?? 0) ?></strong><span>Fatal</span></div>
      <div class="stat"><strong><?= number_format($stats['this_month'] ?? 0) ?></strong><span>Bulan Ini</span></div>
      <div class="stat"><strong><?= number_format($stats['sectors'] ?? 0) ?></strong><span>Sektor Industri</span></div>
    </div>
    <form class="search-box" action="" method="GET">
      <input type="search" name="q" placeholder="Cari insiden (konstruksi, tambang, pabrik...)" value="<?= e($search) ?>">
      <button type="submit">🔍 Cari</button>
    </form>
  </div>
</section>

<div class="filter-bar">
  <div class="container">
    <form method="GET" action="">
      <?php if ($search): ?><input type="hidden" name="q" value="<?= e($search) ?>"><?php endif; ?>
      <select name="sector">
        <option value="">Semua Sektor</option>
        <?php foreach ($filters['sectors'] ?? [] as $sec): ?>
        <option value="<?= e($sec) ?>" <?= $sector===$sec?'selected':'' ?>><?= e($sec) ?></option>
        <?php endforeach; ?>
      </select>
      <select name="prov">
        <option value="">Semua Provinsi</option>
        <?php foreach ($filters['provinces'] ?? [] as $p): ?>
        <option value="<?= e($p) ?>" <?= $prov===$p?'selected':'' ?>><?= e($p) ?></option>
        <?php endforeach; ?>
      </select>
      <button type="submit">Filter</button>
      <?php if ($sector || $prov || $search): ?><a href="/insiden/" style="color:var(--text-light);font-size:.875rem">Reset</a><?php endif; ?>
    </form>
  </div>
</div>

<div class="container">
  <?php if (empty($incidents)): ?>
  <div style="text-align:center;padding:60px;color:var(--text-light)">
    <div style="font-size:3rem;margin-bottom:16px">🔍</div>
    <h3>Tidak ada insiden ditemukan</h3>
    <a href="/insiden/" style="color:var(--green);font-weight:600">Lihat semua insiden →</a>
  </div>
  <?php else: ?>
  <div class="insiden-grid">
    <?php foreach ($incidents as $ins): ?>
    <div class="insiden-card">
      <div class="insiden-card-top">
        <span class="severity-badge sev-<?= strtolower($ins['severity'] ?? 'minor') ?>"><?= e($ins['severity'] ?? 'minor') ?></span>
        <h3><a href="/insiden/<?= e($ins['slug']) ?>/"><?= e(mb_substr($ins['title'],0,80)) ?></a></h3>
        <div class="insiden-meta">
          <?php if ($ins['sector']): ?><span>🏭 <?= e($ins['sector']) ?></span><?php endif; ?>
          <?php if ($ins['province']): ?><span>📍 <?= e($ins['province']) ?></span><?php endif; ?>
          <span>📅 <?= format_date($ins['incident_date'] ?? $ins['created_at']) ?></span>
        </div>
      </div>
      <?php if ($ins['summary']): ?>
      <p><?= e(mb_substr($ins['summary'],0,120)) ?>...</p>
      <?php endif; ?>
    </div>
    <?php endforeach; ?>
  </div>

  <?php if ($totalPages > 1): ?>
  <div class="pagination">
    <?php for ($i=1;$i<=$totalPages;$i++): ?>
    <a href="?<?= http_build_query(array_merge($_GET,['p'=>$i])) ?>" class="page-btn <?= $i===$page?'active':'' ?>"><?= $i ?></a>
    <?php endfor; ?>
  </div>
  <?php endif; ?>
  <?php endif; ?>
</div>

<section style="background:var(--surface-subtle);padding:48px 0;text-align:center">
  <div class="container">
    <h2 style="font-size:1.4rem;font-weight:800;margin:0 0 8px">Cegah Kecelakaan di Tempat Kerja</h2>
    <p style="color:var(--slate-600);margin:0 0 24px">Ikuti pelatihan K3 bersertifikat dan jadikan tempat kerja Anda lebih aman</p>
    <a href="/jadwal/" style="display:inline-block;background:var(--orange);color:var(--surface);padding:14px 32px;border-radius:12px;font-weight:700;text-decoration:none">📅 Lihat Jadwal Pelatihan K3</a>
    <a href="/resources/" style="display:inline-block;background:var(--green);color:var(--surface);padding:14px 32px;border-radius:12px;font-weight:700;text-decoration:none;margin-left:12px">📄 Download Template JSA Gratis</a>
  </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
<script src="<?= SITE_URL ?>/assets/js/main.js"></script>
</body></html>
