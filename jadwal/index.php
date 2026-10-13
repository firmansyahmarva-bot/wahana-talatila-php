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

$metaTitle = 'Jadwal Pelatihan K3 2026: Resmi Kemnaker RI & BNSP';
$metaDesc  = 'Jadwal resmi pelatihan K3, keselamatan kerja & sertifikasi Kemnaker RI dan BNSP 2026. Kelas online & tatap muka, daftar batch terdekat sekarang.';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($metaTitle) ?></title>
<meta name="description" content="<?= e($metaDesc) ?>">
<link rel="canonical" href="<?= SITE_URL ?>/jadwal/">
<?php
$eventSchemas = [];
foreach ($batches as $b) {
    $evMode = ($b['mode'] ?? '') === 'online'
        ? 'https://schema.org/OnlineEventAttendanceMode'
        : (($b['mode'] ?? '') === 'both'
            ? 'https://schema.org/MixedEventAttendanceMode'
            : 'https://schema.org/OfflineEventAttendanceMode');

    $location = ($b['mode'] ?? '') === 'online'
        ? [
            '@type' => 'VirtualLocation',
            'url'   => SITE_URL . '/jadwal/' . $b['id'] . '/',
          ]
        : [
            '@type'   => 'Place',
            'name'    => !empty($b['location']) ? $b['location'] : 'Training Center Wahana Totalita Yogyakarta & In-House',
            'address' => [
                '@type'           => 'PostalAddress',
                'addressLocality' => 'Yogyakarta',
                'addressRegion'   => 'DI Yogyakarta',
                'addressCountry'  => 'ID',
            ],
          ];

    $ev = [
        '@context'            => 'https://schema.org',
        '@type'               => 'EducationalEvent',
        'name'                => 'Pelatihan ' . ($b['training_name'] ?? 'K3') . ' - ' . ($b['batch_code'] ?? 'Batch Terdekat'),
        'description'         => 'Jadwal resmi ' . ($b['training_name'] ?? 'Pelatihan K3') . (!empty($b['certification']) ? ' sertifikasi ' . $b['certification'] : '') . '.',
        'startDate'           => $b['start_date'],
        'eventAttendanceMode' => $evMode,
        'eventStatus'         => 'https://schema.org/EventScheduled',
        'location'            => $location,
        'organizer'           => [
            '@type' => 'Organization',
            '@id'   => SITE_URL . '/#organization',
            'name'  => 'Wahana Totalita Konsultan',
            'url'   => SITE_URL,
        ],
        'offers' => [
            '@type'         => 'Offer',
            'price'         => (string)(int)($b['price'] ?? 0),
            'priceCurrency' => 'IDR',
            'availability'  => 'https://schema.org/InStock',
            'url'           => SITE_URL . '/jadwal/' . $b['id'] . '/',
            'validFrom'     => date('Y-m-d'),
        ],
    ];
    if (!empty($b['end_date']) && $b['end_date'] !== '0000-00-00') {
        $ev['endDate'] = $b['end_date'];
    }
    if (!empty($b['training_slug'])) {
        $ev['about'] = [
            '@type' => 'Course',
            'name'  => $b['training_name'],
            'url'   => SITE_URL . '/pelatihan/' . $b['training_slug'] . '/',
        ];
    }
    $eventSchemas[] = $ev;
}
?>
<?php if (!empty($eventSchemas)): ?>
<script type="application/ld+json">
<?= json_encode($eventSchemas, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) ?>
</script>
<?php endif; ?>
<?php require __DIR__ . '/../includes/css.php'; ?>
<link rel="stylesheet" href="<?= asset_v('/assets/css/page/jadwal.css') ?>">
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
      <a href="/jadwal/kalender/" style="padding:10px 20px;background:var(--green);color:var(--surface);border-radius:8px;text-decoration:none;font-weight:600;">📅 Lihat Kalender</a>
    </form>
  </div>
</div>

<div class="container">
  <?php if (empty($batches)): ?>
  <div class="empty-state">
    <span style="font-size:4rem;display:block;margin-bottom:16px">📭</span>
    <h3>Tidak ada jadwal tersedia</h3>
    <p>Coba kata kunci lain atau hubungi kami untuk jadwal khusus.</p>
    <a href="<?= wa_url('Halo, saya ingin info jadwal pelatihan K3') ?>" style="display:inline-block;margin-top:16px;background:var(--orange);color:var(--surface);padding:12px 24px;border-radius:8px;text-decoration:none;font-weight:600">💬 Tanya Jadwal</a>
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
        <div style="font-size:.8rem;color:var(--text-light);margin-bottom:4px">
          Peserta: <?= $b['current_participants'] ?>/<?= $b['max_participants'] ?>
          <?php if (!$isFull): ?>
          <span style="color:var(--orange);font-weight:600">(<?= $sisa ?> kursi tersisa)</span>
          <?php else: ?>
          <span style="color:var(--danger);font-weight:600">(PENUH)</span>
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
          <div style="font-size:.75rem;color:var(--text-light)"><?= e($b['price_notes']) ?></div>
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
<section style="background:var(--green);padding:60px 0;text-align:center;color:var(--surface)">
  <div class="container">
    <h2 style="font-size:1.8rem;font-weight:800;margin:0 0 12px">Tidak ada jadwal yang cocok?</h2>
    <p style="opacity:.85;margin-bottom:24px">Hubungi kami untuk pelatihan in-house sesuai kebutuhan perusahaan Anda</p>
    <a href="<?= wa_url('Halo, saya ingin info pelatihan in-house K3') ?>" style="display:inline-block;background:var(--orange);color:var(--surface);padding:14px 32px;border-radius:12px;font-weight:700;font-size:1.1rem;text-decoration:none">💬 Konsultasi Pelatihan In-House</a>
  </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
<script src="<?= SITE_URL ?>/assets/js/main.js"></script>
</body></html>
