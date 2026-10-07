<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/incident-functions.php';

$slug = get_url_slug() ?: ($_GET['slug'] ?? '');
if (!$slug) redirect(SITE_URL . '/insiden/');
$inc = get_incident_by_slug($slug);
if (!$inc) { http_response_code(404); include __DIR__.'/../404.php'; exit; }

// Map the real `incidents` columns onto the field names this template expects.
$inc['sector']              = $inc['industry'] ?? '';
$inc['fatalities']          = (int)($inc['deaths'] ?? 0);
$inc['injuries']            = (int)($inc['injured'] ?? 0);
$inc['location_detail']     = $inc['city'] ?? '';
$inc['preventive_measures'] = $inc['prevention'] ?? '';
$inc['content']             = $inc['description'] ?? '';
$inc['summary']             = '';
$inc['severity']            = $inc['fatalities'] > 0 ? 'fatal' : ($inc['injuries'] > 0 ? 'major' : 'minor');

$related = get_related_incidents($inc['id'], $inc['province'] ?? '', $inc['sector']);
$s = get_all_settings();
$metaTitle = e($inc['title']) . ' — Insiden K3 Indonesia | Wahana Totalita';
$metaDesc  = mb_substr(strip_tags($inc['description'] ?? ''), 0, 160);

$schema = json_encode([
  "@context"=>"https://schema.org",
  "@type"=>"NewsArticle",
  "headline"=>$inc['title'],
  "description"=>$metaDesc,
  "url"=>SITE_URL."/insiden/".urlencode($inc['slug'])."/",
  "datePublished"=>$inc['incident_date'] ?? $inc['created_at'],
  "publisher"=>["@type"=>"Organization","name"=>"Wahana Totalita Konsultan","url"=>SITE_URL]
]);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= $metaTitle ?></title>
<meta name="description" content="<?= e($metaDesc) ?>">
<link rel="canonical" href="<?= SITE_URL ?>/insiden/<?= e($inc['slug']) ?>/">
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
.insiden-detail{padding:40px 0}
.insiden-layout{display:grid;grid-template-columns:1fr 300px;gap:32px}
.article-card{background:#fff;border-radius:12px;border:1px solid #eee;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.06)}
.article-header{background:linear-gradient(135deg,#7f1d1d,#991b1b);padding:28px 32px;color:#fff}
.article-header h1{font-size:clamp(1.2rem,2.5vw,1.6rem);font-weight:800;margin:0 0 12px;line-height:1.4}
.severity-badge{display:inline-block;padding:4px 12px;border-radius:100px;font-size:.8rem;font-weight:700;background:rgba(255,255,255,.2);margin-bottom:12px}
.article-meta-grid{display:flex;gap:20px;flex-wrap:wrap;font-size:.8rem;opacity:.8;margin-top:12px}
.article-body{padding:28px 32px}
.article-body h2{color:#7f1d1d;font-size:1.1rem;margin:24px 0 12px}
.article-content{line-height:1.85;color:#333;font-size:.95rem}
.key-facts{background:#fff1f2;border:1px solid #fecdd3;border-radius:12px;padding:20px;margin:20px 0}
.key-facts h3{color:#991b1b;margin:0 0 12px;font-size:1rem}
.key-facts-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px}
.fact-item{font-size:.875rem}
.fact-item .fact-label{color:#999;font-size:.75rem;display:block}
.fact-item .fact-val{font-weight:700;color:#1a1a1a}
.sidebar-card{background:#fff;border-radius:12px;border:1px solid #eee;padding:20px;margin-bottom:20px}
.sidebar-card h3{font-size:1rem;font-weight:700;margin:0 0 14px;color:var(--green)}
.related-item{display:flex;gap:10px;padding:10px 0;border-bottom:1px solid #f0f0f0;text-decoration:none;color:inherit}
.related-item:last-child{border-bottom:none}
.related-item:hover .related-title{color:#991b1b}
.related-title{font-size:.85rem;font-weight:600;line-height:1.3}
.related-meta{font-size:.72rem;color:#999}
@media(max-width:768px){.insiden-layout{grid-template-columns:1fr}.key-facts-grid{grid-template-columns:1fr}}
</style>
</head>
<body>
<?php include __DIR__ . '/../includes/navbar.php'; ?>

<div class="container insiden-detail">
  <div style="font-size:.85rem;color:#999;margin-bottom:20px">
    <a href="/insiden/" style="color:var(--green)">Database Insiden</a>
    <?php if ($inc['sector']): ?> › <a href="/insiden/?sector=<?= urlencode($inc['sector']) ?>" style="color:var(--green)"><?= e($inc['sector']) ?></a><?php endif; ?>
    › <?= e(mb_substr($inc['title'],0,50)) ?>
  </div>

  <div class="insiden-layout">
    <div>
      <div class="article-card">
        <div class="article-header">
          <span class="severity-badge">⚠️ <?= strtoupper($inc['severity'] ?? 'MINOR') ?></span>
          <h1><?= e($inc['title']) ?></h1>
          <div class="article-meta-grid">
            <?php if ($inc['incident_date']): ?><span>📅 <?= format_date($inc['incident_date']) ?></span><?php endif; ?>
            <?php if ($inc['sector']): ?><span>🏭 <?= e($inc['sector']) ?></span><?php endif; ?>
            <?php if ($inc['province']): ?><span>📍 <?= e($inc['province']) ?></span><?php endif; ?>
            <?php if ($inc['source_name']): ?><span>📰 <?= e($inc['source_name']) ?></span><?php endif; ?>
          </div>
        </div>
        <div class="article-body">
          <?php if ($inc['fatalities'] || $inc['injuries'] || $inc['company']): ?>
          <div class="key-facts">
            <h3>📊 Data Insiden</h3>
            <div class="key-facts-grid">
              <?php if ($inc['fatalities']): ?>
              <div class="fact-item"><span class="fact-label">Korban Jiwa</span><span class="fact-val" style="color:#991b1b">💀 <?= (int)$inc['fatalities'] ?> orang</span></div>
              <?php endif; ?>
              <?php if ($inc['injuries']): ?>
              <div class="fact-item"><span class="fact-label">Luka-luka</span><span class="fact-val" style="color:#f59e0b">🤕 <?= (int)$inc['injuries'] ?> orang</span></div>
              <?php endif; ?>
              <?php if ($inc['company']): ?>
              <div class="fact-item"><span class="fact-label">Perusahaan</span><span class="fact-val"><?= e($inc['company']) ?></span></div>
              <?php endif; ?>
              <?php if ($inc['location_detail']): ?>
              <div class="fact-item"><span class="fact-label">Lokasi</span><span class="fact-val"><?= e($inc['location_detail']) ?></span></div>
              <?php endif; ?>
            </div>
          </div>
          <?php endif; ?>

          <?php if ($inc['summary']): ?>
          <div style="background:#f9fafb;border-radius:8px;padding:16px;margin-bottom:20px;font-size:.9rem;color:#555;line-height:1.7;border-left:4px solid #991b1b">
            <?= nl2br(e($inc['summary'])) ?>
          </div>
          <?php endif; ?>

          <?php if ($inc['content']): ?>
          <div class="article-content">
            <?php if ($inc['root_cause']): ?>
            <h2>🔍 Penyebab Insiden</h2>
            <p><?= nl2br(e($inc['root_cause'])) ?></p>
            <?php endif; ?>
            <?php if ($inc['preventive_measures']): ?>
            <h2>🛡️ Langkah Pencegahan</h2>
            <p><?= nl2br(e($inc['preventive_measures'])) ?></p>
            <?php endif; ?>
            <?= nl2br(e($inc['content'])) ?>
          </div>
          <?php endif; ?>

          <?php if ($inc['source_url']): ?>
          <div style="margin-top:24px;padding:16px;background:#f0f9f0;border-radius:8px;font-size:.85rem">
            📰 Sumber: <a href="<?= e($inc['source_url']) ?>" target="_blank" rel="noopener nofollow" style="color:var(--green)"><?= e($inc['source_name'] ?? $inc['source_url']) ?></a>
          </div>
          <?php endif; ?>

          <div style="margin-top:24px;padding-top:20px;border-top:1px solid #f0f0f0;text-align:center">
            <p style="color:#666;font-size:.9rem;margin-bottom:12px">Cegah insiden serupa dengan pelatihan K3 bersertifikat</p>
            <a href="/jadwal/" style="display:inline-block;background:var(--orange);color:#fff;padding:12px 24px;border-radius:8px;text-decoration:none;font-weight:600">📅 Lihat Jadwal Pelatihan</a>
            <a href="/resources/" style="display:inline-block;background:var(--green);color:#fff;padding:12px 24px;border-radius:8px;text-decoration:none;font-weight:600;margin-left:8px">📄 Download Template JSA</a>
          </div>

          <!-- T17b: fails silent today (no incident-category map yet); wired so
               it activates automatically once that map is added — see T15 notes. -->
          <?php
            require_once __DIR__ . '/../includes/related-cta.php';
            echo related_cta('incident', $inc['sector'] ?? '');
          ?>
        </div>
      </div>
    </div>

    <div>
      <?php if (!empty($related)): ?>
      <div class="sidebar-card">
        <h3>🔗 Insiden Terkait</h3>
        <?php foreach ($related as $r): ?>
        <a href="/insiden/<?= e($r['slug']) ?>/" class="related-item">
          <span style="font-size:1.2rem;flex-shrink:0">⚠️</span>
          <div>
            <div class="related-title"><?= e(mb_substr($r['title'],0,60)) ?></div>
            <div class="related-meta"><?= format_date($r['incident_date'] ?? $r['created_at']) ?></div>
          </div>
        </a>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>

      <div class="sidebar-card" style="background:var(--green);color:#fff;border-color:var(--green)">
        <h3 style="color:#fff">🛡️ Jadikan Tempat Kerja Lebih Aman</h3>
        <p style="font-size:.875rem;opacity:.85;margin:0 0 16px">Konsultasikan kebutuhan K3 perusahaan Anda</p>
        <a href="<?= wa_url('Halo, saya ingin konsultasi K3 untuk perusahaan kami') ?>" style="display:block;background:var(--orange);color:#fff;padding:10px;border-radius:8px;text-decoration:none;font-weight:600;text-align:center">💬 Konsultasi Gratis</a>
      </div>

      <div class="sidebar-card">
        <h3>📄 Template K3 Terkait</h3>
        <a href="/resources/" style="display:flex;gap:8px;align-items:center;text-decoration:none;color:#333;padding:8px 0;border-bottom:1px solid #f0f0f0;font-size:.875rem"><span>📕</span>Template JSA (Job Safety Analysis)</a>
        <a href="/resources/" style="display:flex;gap:8px;align-items:center;text-decoration:none;color:#333;padding:8px 0;border-bottom:1px solid #f0f0f0;font-size:.875rem"><span>📝</span>Checklist Inspeksi K3</a>
        <a href="/resources/" style="display:flex;gap:8px;align-items:center;text-decoration:none;color:#333;padding:8px 0;font-size:.875rem"><span>📊</span>Form Laporan Kecelakaan</a>
        <a href="/resources/" style="display:block;text-align:center;margin-top:12px;font-size:.8rem;color:var(--green);font-weight:600">Lihat semua template →</a>
      </div>
    </div>
  </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
<script src="<?= SITE_URL ?>/assets/js/main.js"></script>
</body></html>
