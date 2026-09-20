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
<script type="application/ld+json"><?= $schema ?></script>
<?= theme_css_vars($s) ?>
<style>
.insiden-hero{background:linear-gradient(135deg,#7f1d1d,#991b1b);padding:56px 0;color:#fff;text-align:center}
.insiden-hero h1{font-size:clamp(1.6rem,3.5vw,2.5rem);font-weight:800;margin:0 0 12px}
.stat-row{display:flex;gap:32px;justify-content:center;flex-wrap:wrap;margin:24px 0 0}
.stat-row .stat strong{display:block;font-size:1.8rem;font-weight:800}
.stat-row .stat span{font-size:.8rem;opacity:.7}
.search-box{background:#fff;border-radius:12px;padding:6px;display:flex;gap:8px;max-width:560px;margin:20px auto 0;box-shadow:0 4px 20px rgba(0,0,0,.2)}
.search-box input{flex:1;border:none;outline:none;padding:10px 16px;font-size:1rem;background:transparent;color:#222}
.search-box button{background:#991b1b;color:#fff;border:none;padding:10px 20px;border-radius:8px;cursor:pointer;font-weight:600}
.filter-bar{background:#f8f8f8;border-bottom:1px solid #eee;padding:16px 0}
.filter-bar form{display:flex;gap:12px;flex-wrap:wrap;align-items:center}
.filter-bar select{padding:8px 14px;border:1px solid #ddd;border-radius:8px;background:#fff;font-size:.875rem}
.filter-bar button{padding:8px 16px;background:var(--green);color:#fff;border:none;border-radius:8px;font-weight:600;cursor:pointer}
.insiden-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:20px;padding:32px 0}
.insiden-card{background:#fff;border-radius:12px;border:1px solid #eee;overflow:hidden;transition:.2s;box-shadow:0 2px 8px rgba(0,0,0,.06)}
.insiden-card:hover{box-shadow:0 8px 24px rgba(0,0,0,.12);transform:translateY(-2px)}
.insiden-card-top{padding:16px 20px;border-left:4px solid #991b1b}
.severity-badge{display:inline-block;padding:3px 10px;border-radius:100px;font-size:.72rem;font-weight:700;text-transform:uppercase;margin-bottom:8px}
.sev-fatal{background:#fee2e2;color:#991b1b}
.sev-major{background:#fef3c7;color:#92400e}
.sev-minor{background:#dbeafe;color:#1d4ed8}
.insiden-card h3{font-size:.95rem;font-weight:700;margin:0 0 8px;line-height:1.4}
.insiden-card h3 a{text-decoration:none;color:#1a1a1a}
.insiden-card h3 a:hover{color:#991b1b}
.insiden-meta{display:flex;gap:12px;font-size:.78rem;color:#999;flex-wrap:wrap}
.insiden-card p{font-size:.85rem;color:#666;line-height:1.5;margin:8px 0 0;padding:0 20px 16px}
.live-badge{display:inline-flex;align-items:center;gap:6px;background:rgba(255,255,255,.15);padding:6px 14px;border-radius:100px;font-size:.85rem}
.live-dot{width:8px;height:8px;border-radius:50%;background:#4ade80;animation:pulse 2s infinite}
@keyframes pulse{0%,100%{opacity:1}50%{opacity:.3}}
.pagination{display:flex;gap:8px;justify-content:center;padding:40px 0;flex-wrap:wrap}
.page-btn{display:inline-block;padding:8px 16px;border-radius:8px;border:1px solid #ddd;text-decoration:none;color:#333;font-weight:600}
.page-btn.active{background:#991b1b;color:#fff;border-color:#991b1b}
</style>
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
      <?php if ($sector || $prov || $search): ?><a href="/insiden/" style="color:#999;font-size:.875rem">Reset</a><?php endif; ?>
    </form>
  </div>
</div>

<div class="container">
  <?php if (empty($incidents)): ?>
  <div style="text-align:center;padding:60px;color:#999">
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

<section style="background:#f8f8f8;padding:48px 0;text-align:center">
  <div class="container">
    <h2 style="font-size:1.4rem;font-weight:800;margin:0 0 8px">Cegah Kecelakaan di Tempat Kerja</h2>
    <p style="color:#666;margin:0 0 24px">Ikuti pelatihan K3 bersertifikat dan jadikan tempat kerja Anda lebih aman</p>
    <a href="/jadwal/" style="display:inline-block;background:var(--orange);color:#fff;padding:14px 32px;border-radius:12px;font-weight:700;text-decoration:none">📅 Lihat Jadwal Pelatihan K3</a>
    <a href="/resources/" style="display:inline-block;background:var(--green);color:#fff;padding:14px 32px;border-radius:12px;font-weight:700;text-decoration:none;margin-left:12px">📄 Download Template JSA Gratis</a>
  </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
<script src="<?= SITE_URL ?>/assets/js/main.js"></script>
</body></html>
