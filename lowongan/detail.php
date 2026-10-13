<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/jobs-functions.php';

$slug = get_url_slug() ?: ($_GET['slug'] ?? '');
if (!$slug) redirect(SITE_URL . '/lowongan/');
$job = get_job_by_slug($slug);
if (!$job || !$job['is_active']) { http_response_code(404); include __DIR__.'/../404.php'; exit; }

$s = get_all_settings();
$metaTitle = e($job['title']) . ' di ' . e($job['company']) . ' | Lowongan K3 Wahana Totalita';
$metaDesc  = mb_substr(strip_tags($job['description'] ?? $job['requirements'] ?? ''), 0, 160);

$schema = json_encode([
  "@context"=>"https://schema.org",
  "@type"=>"JobPosting",
  "title"=>$job['title'],
  "description"=>$metaDesc,
  "hiringOrganization"=>["@type"=>"Organization","name"=>$job['company']],
  "jobLocation"=>["@type"=>"Place","address"=>["@type"=>"PostalAddress","addressLocality"=>$job['location'],"addressCountry"=>"ID"]],
  "employmentType"=>strtoupper($job['job_type'] ?? 'FULL_TIME'),
  "datePosted"=>date('Y-m-d', strtotime($job['created_at'])),
  "validThrough"=>$job['expires_at'] ?? date('Y-m-d', strtotime('+30 days')),
  "url"=>SITE_URL."/lowongan/".urlencode($job['slug'])."/"
]);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= $metaTitle ?></title>
<meta name="description" content="<?= e($metaDesc) ?>">
<link rel="canonical" href="<?= SITE_URL ?>/lowongan/<?= e($job['slug']) ?>/">
<?php require __DIR__ . '/../includes/css.php'; ?>
<script type="application/ld+json"><?= $schema ?></script>
<link rel="stylesheet" href="<?= asset_v('/assets/css/page/lowongan-detail.css') ?>">
</head>
<body>
<?php include __DIR__ . '/../includes/navbar.php'; ?>

<div class="container job-detail">
  <div class="breadcrumb">
    <a href="/lowongan/">Lowongan K3</a> › <?= e($job['title']) ?>
  </div>

  <div class="job-layout">
    <div>
      <div class="job-main">
        <div class="job-main-header">
          <h1><?= e($job['title']) ?></h1>
          <div class="company">🏢 <?= e($job['company']) ?></div>
          <div class="meta-row">
            <?php if ($job['location']): ?><span>📍 <?= e($job['location']) ?></span><?php endif; ?>
            <span>📋 <?= strtoupper($job['job_type'] ?? 'FULL-TIME') ?></span>
            <?php if ($job['salary_min']): ?><span>💰 <?= format_price((int)$job['salary_min']) ?><?= $job['salary_max'] ? ' — ' . format_price((int)$job['salary_max']) : '+' ?></span><?php endif; ?>
            <span>📅 Diposting <?= time_ago($job['created_at']) ?></span>
          </div>
        </div>
        <div class="job-body">
          <?php if ($job['description']): ?>
          <div class="section-block">
            <h2>📋 Deskripsi Pekerjaan</h2>
            <div><?= nl2br(e($job['description'])) ?></div>
          </div>
          <?php endif; ?>
          <?php if ($job['requirements']): ?>
          <div class="section-block">
            <h2>✅ Kualifikasi & Persyaratan</h2>
            <div><?= nl2br(e($job['requirements'])) ?></div>
          </div>
          <?php endif; ?>
          <?php if ($job['benefits']): ?>
          <div class="section-block">
            <h2>🎁 Benefit & Fasilitas</h2>
            <div><?= nl2br(e($job['benefits'])) ?></div>
          </div>
          <?php endif; ?>
          <div style="background:var(--info-bg);border-radius:8px;padding:16px;margin-top:8px">
            <h2 style="color:var(--mut);margin:0 0 8px;font-size:.95rem">💡 Tip: Tingkatkan Peluang Diterima</h2>
            <p style="font-size:.85rem;color:var(--slate-600);margin:0">Miliki sertifikat K3 BNSP dari Wahana Totalita untuk menonjol dari pelamar lain.
            <a href="/jadwal/" style="color:var(--mut);font-weight:600">Lihat jadwal pelatihan →</a></p>
          </div>
          <?php
            // T17d: fails silent today (no job-category map yet); wired so it
            // activates automatically once that map is added — see T15 notes.
            require_once __DIR__ . '/../includes/related-cta.php';
            echo related_cta('job', $job['category'] ?? '');
          ?>
        </div>
      </div>
    </div>

    <div>
      <div class="sidebar-card">
        <h3>📌 Info Lowongan</h3>
        <div class="job-info-row"><span class="label">Perusahaan</span><span class="value"><?= e($job['company']) ?></span></div>
        <?php if ($job['location']): ?><div class="job-info-row"><span class="label">Lokasi</span><span class="value"><?= e($job['location']) ?></span></div><?php endif; ?>
        <div class="job-info-row"><span class="label">Tipe</span><span class="value"><?= strtoupper($job['job_type'] ?? 'FULL-TIME') ?></span></div>
        <?php if ($job['salary_min']): ?><div class="job-info-row"><span class="label">Gaji</span><span class="value"><?= format_price((int)$job['salary_min']) ?>+</span></div><?php endif; ?>
        <?php if ($job['expires_at']): ?><div class="job-info-row"><span class="label">Deadline</span><span class="value"><?= format_date($job['expires_at']) ?></span></div><?php endif; ?>
      </div>

      <?php if ($job['apply_url']): ?>
      <a href="<?= e($job['apply_url']) ?>" class="btn-apply-big" target="_blank" rel="noopener">📤 Lamar Sekarang</a>
      <?php elseif ($job['apply_email']): ?>
      <a href="mailto:<?= e($job['apply_email']) ?>" class="btn-apply-big">📧 Kirim Lamaran</a>
      <?php else: ?>
      <a href="<?= wa_url('Halo, saya tertarik melamar posisi '.$job['title'].' di '.$job['company']) ?>" class="btn-apply-big">💬 Lamar via WhatsApp</a>
      <?php endif; ?>

      <a href="<?= wa_url('Halo, saya ingin tanya tentang lowongan '.$job['title']) ?>" class="btn-wa">💬 Tanya Info Lebih Lanjut</a>

      <div class="sidebar-card" style="margin-top:16px;background:var(--green);color:var(--surface);border-color:var(--green)">
        <h3 style="color:var(--surface)">🎓 Siap untuk K3?</h3>
        <p style="font-size:.85rem;opacity:.85;margin:0 0 12px">Dapatkan sertifikat BNSP dan tingkatkan nilai Anda</p>
        <a href="/jadwal/" style="display:block;background:var(--orange);color:var(--surface);padding:10px;border-radius:8px;text-decoration:none;font-weight:600;text-align:center">📅 Daftar Pelatihan</a>
      </div>
    </div>
  </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
<script src="<?= SITE_URL ?>/assets/js/main.js"></script>
</body></html>
