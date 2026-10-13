<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/jadwal-functions.php';

$id = (int)(get_query_param('id') ?: ($_GET['id'] ?? 0));
if (!$id) redirect(SITE_URL . '/jadwal/');
$batch = get_schedule_by_id($id);
if (!$batch || $batch['is_public'] != 1) { http_response_code(404); include __DIR__.'/../404.php'; exit; }

$today = new DateTimeImmutable('today');
$endDate = new DateTimeImmutable($batch['end_date'] ?: $batch['start_date']);
$daysEnded = $endDate < $today ? (int)$endDate->diff($today)->days : 0;
if ($daysEnded > 90) {
    $target = !empty($batch['training_slug']) ? SITE_URL.'/pelatihan/'.$batch['training_slug'].'/' : SITE_URL.'/jadwal/';
    header('Location: '.$target, true, 301); exit;
}
$isEnded = $endDate < $today;
$robots = 'index,follow';
$canonicalUrl = ($isEnded && !empty($batch['training_slug']))
    ? SITE_URL . '/pelatihan/' . $batch['training_slug'] . '/'
    : SITE_URL . '/jadwal/' . $id . '/';

$s = get_all_settings();
$sisa = $batch['max_participants'] - $batch['current_participants'];
$isFull = $batch['status'] === 'full' || $sisa <= 0;
$cleanProg = clean_program_name($batch['training_name'] ?? 'Pelatihan K3');
$coreProg  = preg_replace('/^Pelatihan\s+/i', '', $cleanProg);
$dateStr   = format_date($batch['start_date'], 'd M Y');

$hasDate    = !empty($batch['start_date']) && $batch['start_date'] !== '0000-00-00' && $dateStr !== '—';
$dateSuffix = $hasDate ? " ({$dateStr})" : "";

$metaTitle = "Jadwal Pelatihan {$coreProg}{$dateSuffix}";
if (mb_strlen($metaTitle) > 60) {
    $metaTitle = "Jadwal {$coreProg}{$dateSuffix}";
}

$certTxt = !empty($batch['certification_body']) ? ' Sertifikasi ' . $batch['certification_body'] . '.' : '';
$modeTxt = strtoupper($batch['mode'] ?? 'offline');
$metaDesc = "Jadwal resmi Pelatihan {$coreProg} tanggal {$dateStr} ({$modeTxt}).{$certTxt} Kurikulum resmi, rincian biaya, dan registrasi batch terdekat.";

$waRegister = wa_url("Halo, saya ingin mendaftar jadwal pelatihan:\n*Pelatihan {$coreProg}*\nTanggal: {$dateStr}\nMode: {$modeTxt}\nURL batch: ".SITE_URL."/jadwal/{$id}/");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($metaTitle) ?></title>
<meta name="description" content="<?= e($metaDesc) ?>">
<meta name="robots" content="<?= $robots ?>">
<link rel="canonical" href="<?= e($canonicalUrl) ?>">
<meta property="og:type" content="website">
<meta property="og:title" content="<?= e($metaTitle) ?>">
<meta property="og:description" content="<?= e($metaDesc) ?>">
<meta property="og:url" content="<?= e($canonicalUrl) ?>">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?= e($metaTitle) ?>">
<meta name="twitter:description" content="<?= e($metaDesc) ?>">
<?php require __DIR__ . '/../includes/css.php'; ?>
<?php if (!$isEnded): ?><script type="application/ld+json"><?= json_encode([
  '@context'=>'https://schema.org','@type'=>'Event','name'=>'Jadwal Pelatihan '.$coreProg.' ('.$dateStr.')',
  'startDate'=>$batch['start_date'],'endDate'=>$batch['end_date'] ?: $batch['start_date'],
  'eventAttendanceMode'=>$batch['mode']==='online'?'https://schema.org/OnlineEventAttendanceMode':'https://schema.org/OfflineEventAttendanceMode',
  'eventStatus'=>'https://schema.org/EventScheduled','url'=>SITE_URL.'/jadwal/'.$id.'/',
  'organizer'=>['@type'=>'Organization','name'=>'Wahana Totalita Konsultan','url'=>SITE_URL],
  'location'=>$batch['mode']==='online'?['@type'=>'VirtualLocation','url'=>SITE_URL.'/jadwal/'.$id.'/']:['@type'=>'Place','name'=>$batch['location'] ?: 'Wahana Totalita Konsultan'],
  'offers'=>['@type'=>'Offer','url'=>SITE_URL.'/jadwal/'.$id.'/','price'=>(string)$batch['price'],'priceCurrency'=>'IDR','availability'=>'https://schema.org/InStock']
], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) ?></script><?php endif; ?>
<link rel="stylesheet" href="<?= asset_v('/assets/css/page/jadwal-detail.css') ?>">
</head>
<body>
<?php include __DIR__ . '/../includes/navbar.php'; ?>

<?php if ($isEnded): ?><div style="margin-top:80px;padding:14px 20px;background:var(--warning-bg);color:var(--warning-text);text-align:center;font-weight:700">Batch ini telah selesai. Lihat <a href="/pelatihan/<?=e($batch['training_slug'])?>/">program berikutnya</a> atau <a href="/jadwal/">semua jadwal terbaru</a>.</div><?php endif; ?>

<section class="detail-hero">
  <div class="container">
    <div style="font-size:.85rem;opacity:.7;margin-bottom:8px">
      <a href="/jadwal/" style="color:inherit">Jadwal</a> › <?= e($batch['training_name']) ?>
    </div>
    <div style="margin-bottom:12px"><span class="badge-mode"><?= strtoupper($batch['mode'] ?? 'OFFLINE') ?></span></div>
    <h1>Jadwal Pelatihan <?= e($coreProg) ?></h1>
    <?php if ($batch['certification_body']): ?>
    <div style="font-size:.9rem;opacity:.8;margin-bottom:8px">🎓 Sertifikasi: <?= e($batch['certification_body']) ?></div>
    <?php endif; ?>
    <div class="meta-grid">
      <span>📅 <?= format_date($batch['start_date']) ?><?= ($batch['end_date'] && $batch['end_date']!==$batch['start_date']) ? ' — '.format_date($batch['end_date']) : '' ?></span>
      <?php if ($batch['location']): ?><span>📍 <?= e($batch['location']) ?></span><?php endif; ?>
      <span>⏱ <?= e($batch['duration_days'] ?? '?') ?> hari pelatihan</span>
      <?php if ($batch['max_participants'] > 0): ?><span>👥 <?= $batch['current_participants'] ?>/<?= $batch['max_participants'] ?> peserta</span><?php endif; ?>
    </div>
  </div>
</section>

<div class="container">
  <div class="content-grid">
    <div>
      <?php if ($batch['training_desc']): ?>
      <div class="content-card">
        <h2>📋 Tentang Pelatihan</h2>
        <?= nl2br(e($batch['training_desc'])) ?>
      </div>
      <?php endif; ?>

      <?php
      $modules = [];
      if ($batch['training_modules']) {
          $modules = json_decode($batch['training_modules'], true) ?: explode("\n", $batch['training_modules']);
      }
      ?>
      <?php if (!empty($modules)): ?>
      <div class="content-card">
        <h2>📚 Materi Pelatihan</h2>
        <ul class="module-list">
          <?php foreach ($modules as $i => $m): ?>
          <li><span style="color:var(--green);font-weight:700;min-width:24px"><?= $i+1 ?>.</span> <?= e(is_array($m) ? ($m['title'] ?? $m[0]) : $m) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <?php endif; ?>

      <div class="content-card">
        <h2>ℹ️ Persyaratan Peserta</h2>
        <?php if ($batch['prerequisites']): ?>
        <?= nl2br(e($batch['prerequisites'])) ?>
        <?php else: ?>
        <ul style="margin:0;padding-left:20px;line-height:2">
          <li>Pendidikan minimal SMA/SMK sederajat</li>
          <li>Membawa KTP/identitas diri</li>
          <li>Foto 3x4 (2 lembar) untuk sertifikat</li>
          <li>Berpakaian rapi dan sopan</li>
        </ul>
        <?php endif; ?>
      </div>

      <div class="content-card">
        <h2>📜 Tentang Sertifikasi</h2>
        <p>Setelah mengikuti pelatihan dan lulus ujian kompetensi, peserta akan mendapatkan:</p>
        <ul style="margin:0;padding-left:20px;line-height:2">
          <?php if ($batch['certification_body']): ?>
          <li>Sertifikat <?= e($batch['certification_body']) ?> yang diakui secara nasional</li>
          <?php else: ?>
          <li>Sertifikat kelulusan dari Wahana Totalita Konsultan</li>
          <?php endif; ?>
          <li>Kartu tanda peserta pelatihan</li>
          <li>Materi pelatihan (modul/handout)</li>
        </ul>
      </div>
    </div>

    <div>
      <div class="reg-card">
        <h3>📝 Daftarkan Diri Anda</h3>
        <div class="price-big">
          <?= $batch['price'] > 0 ? format_price((int)$batch['price']) : '<span style="color:var(--green)">GRATIS</span>' ?>
        </div>
        <?php if ($batch['price_notes']): ?>
        <div style="font-size:.8rem;color:var(--text-light);margin-top:-12px;margin-bottom:12px"><?= e($batch['price_notes']) ?></div>
        <?php endif; ?>

        <div class="info-rows">
          <div class="info-row"><span class="label">📅 Mulai</span><span class="value"><?= format_date($batch['start_date']) ?></span></div>
          <?php if ($batch['end_date'] && $batch['end_date'] !== $batch['start_date']): ?>
          <div class="info-row"><span class="label">📅 Selesai</span><span class="value"><?= format_date($batch['end_date']) ?></span></div>
          <?php endif; ?>
          <div class="info-row"><span class="label">🖥 Mode</span><span class="value"><?= strtoupper($batch['mode'] ?? 'OFFLINE') ?></span></div>
          <?php if ($batch['location']): ?>
          <div class="info-row"><span class="label">📍 Lokasi</span><span class="value"><?= e(mb_substr($batch['location'],0,30)) ?></span></div>
          <?php endif; ?>
          <div class="info-row"><span class="label">⏱ Durasi</span><span class="value"><?= e($batch['duration_days'] ?? '?') ?> hari</span></div>
        </div>

        <?php if ($batch['max_participants'] > 0): ?>
        <?php $pct = min(100, (int)($batch['current_participants']/$batch['max_participants']*100)); ?>
        <div style="font-size:.8rem;color:var(--slate-600);margin-bottom:4px">
          Kursi tersisa: <strong style="color:<?= $isFull?'var(--danger)':'var(--orange)' ?>"><?= $isFull ? 'PENUH' : $sisa . ' kursi' ?></strong>
        </div>
        <div class="slots-bar"><div class="slots-fill" style="width:<?= $pct ?>%;background:<?= $pct>=90?'var(--danger)':($pct>=70?'var(--warning)':'var(--orange)') ?>"></div></div>
        <?php endif; ?>

        <?php if ($isEnded): ?>
        <a href="/pelatihan/<?=e($batch['training_slug'])?>/" class="btn-reg">Lihat Program &amp; Batch Berikutnya</a>
        <?php elseif (!$isFull): ?>
        <a href="<?=$waRegister?>" target="_blank" rel="noopener" class="btn-reg" style="background:var(--success)">💬 Daftar via WhatsApp</a>
        <a href="/jadwal/daftar/<?=$id?>/" class="btn-reg-secondary">atau isi formulir &amp; terima konfirmasi email</a>
        <?php else: ?>
        <a href="<?= wa_url('Halo, saya ingin masuk waiting list '.$batch['training_name']) ?>" class="btn-reg" style="background:var(--green)">📋 Waiting List</a>
        <?php endif; ?>

        <div style="margin-top:16px;text-align:center">
          <a href="<?= wa_url('Halo, saya ingin tanya tentang pelatihan '.$batch['training_name'].' batch '.$batch['batch_code']) ?>" style="font-size:.875rem;color:var(--green);font-weight:600;text-decoration:none">💬 Tanya via WhatsApp</a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
<script src="/assets/js/main.js"></script>
</body></html>
