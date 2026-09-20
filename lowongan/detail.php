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
<link rel="stylesheet" href="<?= asset_v('/assets/css/style.css') ?>">
<script type="application/ld+json"><?= $schema ?></script>
<?= theme_css_vars($s) ?>
<style>
.job-detail{padding:40px 0}
.job-layout{display:grid;grid-template-columns:1fr 300px;gap:32px;max-width:1100px;margin:0 auto}
.job-main{background:#fff;border-radius:12px;border:1px solid #eee;overflow:hidden}
.job-main-header{background:linear-gradient(135deg,#1e3a5f,#2d5282);padding:28px 32px;color:#fff}
.job-main-header h1{font-size:clamp(1.2rem,2.5vw,1.6rem);font-weight:800;margin:0 0 6px}
.job-main-header .company{font-size:1rem;font-weight:600;opacity:.85;margin-bottom:12px}
.meta-row{display:flex;gap:16px;flex-wrap:wrap;font-size:.8rem;opacity:.75}
.job-body{padding:32px}
.section-block{margin-bottom:24px}
.section-block h2{font-size:1rem;font-weight:700;color:#2d5282;margin:0 0 12px;padding-bottom:8px;border-bottom:2px solid #e0e7ff}
.section-block p,.section-block li{font-size:.9rem;color:#333;line-height:1.8}
.sidebar-card{background:#fff;border-radius:12px;border:1px solid #eee;padding:20px;margin-bottom:20px}
.sidebar-card h3{font-size:1rem;font-weight:700;margin:0 0 14px;color:#2d5282}
.job-info-row{display:flex;justify-content:space-between;padding:8px 0;border-bottom:1px solid #f0f0f0;font-size:.875rem}
.job-info-row:last-child{border-bottom:none}
.job-info-row .label{color:#999}
.job-info-row .value{font-weight:600}
.btn-apply-big{display:block;background:#2d5282;color:#fff;padding:14px;border-radius:12px;font-weight:700;font-size:1.1rem;text-align:center;text-decoration:none}
.btn-apply-big:hover{background:#1e3a5f}
.btn-wa{display:block;background:var(--orange);color:#fff;padding:12px;border-radius:8px;font-weight:700;text-align:center;text-decoration:none;margin-top:8px}
.breadcrumb{font-size:.85rem;color:#999;margin-bottom:20px}
.breadcrumb a{color:#2d5282;text-decoration:none}
@media(max-width:768px){.job-layout{grid-template-columns:1fr}}
</style>
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
          <div style="background:#f0f4ff;border-radius:8px;padding:16px;margin-top:8px">
            <h2 style="color:#2d5282;margin:0 0 8px;font-size:.95rem">💡 Tip: Tingkatkan Peluang Diterima</h2>
            <p style="font-size:.85rem;color:#555;margin:0">Miliki sertifikat K3 BNSP dari Wahana Totalita untuk menonjol dari pelamar lain.
            <a href="/jadwal/" style="color:#2d5282;font-weight:600">Lihat jadwal pelatihan →</a></p>
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

      <div class="sidebar-card" style="margin-top:16px;background:var(--green);color:#fff;border-color:var(--green)">
        <h3 style="color:#fff">🎓 Siap untuk K3?</h3>
        <p style="font-size:.85rem;opacity:.85;margin:0 0 12px">Dapatkan sertifikat BNSP dan tingkatkan nilai Anda</p>
        <a href="/jadwal/" style="display:block;background:var(--orange);color:#fff;padding:10px;border-radius:8px;text-decoration:none;font-weight:600;text-align:center">📅 Daftar Pelatihan</a>
      </div>
    </div>
  </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
<script src="<?= SITE_URL ?>/assets/js/main.js"></script>
</body></html>
