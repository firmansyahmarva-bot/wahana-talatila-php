<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/resources-functions.php';

$slug = get_url_slug();
if (!$slug) redirect(SITE_URL . '/resources/');
$resource = get_resource_by_slug($slug);
if (!$resource) { http_response_code(404); include __DIR__ . '/../404.php'; exit; }

increment_resource_view($resource['id']);

// Flash message
$flash = flash_get();

// Related resources (same category)
$related = wt_get_resources(['category_id'=>$resource['category_id'],'limit'=>4]);
$related  = array_filter($related, fn($r) => $r['id'] !== $resource['id']);

$s = get_all_settings();
$metaTitle = $resource['meta_title'] ?: 'Download ' . $resource['title'] . ' | Wahana Totalita';
$metaDesc  = $resource['meta_desc']  ?: mb_substr(strip_tags($resource['description'] ?? ''), 0, 160);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($metaTitle) ?></title>
<meta name="description" content="<?= e($metaDesc) ?>">
<link rel="canonical" href="<?= SITE_URL ?>/resources/<?= e($resource['slug']) ?>/">
<?php require __DIR__ . '/../includes/css.php'; ?>
<link rel="stylesheet" href="<?= asset_v('/assets/css/page/resources-detail.css') ?>">
</head>
<body>
<?php include __DIR__ . '/../includes/navbar.php'; ?>

<section class="detail-hero">
  <div class="container">
    <div class="detail-hero-inner">
      <div>
        <span class="cat-tag"><?= e($resource['cat_icon'] ?? '📁') ?> <?= e($resource['cat_name'] ?? '') ?></span>
        <h1><?= e($resource['title']) ?></h1>
        <div class="meta">
          <span>⬇ <?= number_format($resource['download_count']) ?> download</span>
          <span>👁 <?= number_format($resource['view_count']) ?> dilihat</span>
          <?php if ($resource['file_size_kb']): ?>
          <span>📦 <?= $resource['file_size_kb'] > 1024 ? round($resource['file_size_kb']/1024,1).'MB' : $resource['file_size_kb'].'KB' ?></span>
          <?php endif; ?>
          <?php if (!$resource['is_premium']): ?>
          <span style="background:color-mix(in srgb, var(--surface) 20%, transparent);padding:2px 10px;border-radius:100px;">✅ GRATIS</span>
          <?php endif; ?>
        </div>
        <?php if ($resource['tags']): ?>
        <div class="tag-list" style="margin-top:16px;">
          <?php foreach (explode(',', $resource['tags']) as $tag): ?>
          <span class="tag"><?= e(trim($tag)) ?></span>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
      </div>
      <div class="download-box">
        <span class="file-icon"><?= match(strtolower($resource['file_type'] ?? '')) { 'pdf'=>'📕','xlsx','xls'=>'📊','docx','doc'=>'📝','zip'=>'🗜️',default=>'📄' } ?></span>
        <div class="file-type-badge"><?= e(strtoupper($resource['file_type'] ?? 'FILE')) ?></div>
        <div style="font-size:1.5rem;font-weight:800;color:var(--green);margin-bottom:4px;">
          <?= $resource['is_premium'] ? format_price((int)$resource['price']) : 'GRATIS' ?>
        </div>
        <div style="font-size:.8rem;color:var(--text-light);margin-bottom:20px;">Langsung download setelah isi form</div>
        <a href="#download-form" class="btn-download-big">⬇ Download Sekarang</a>
      </div>
    </div>
  </div>
</section>

<section class="detail-content">
  <div class="container">
    <div class="detail-content-grid">
      <div>
        <?php if ($flash): ?>
        <div class="flash <?= e($flash['type']) ?>"><?= e($flash['message']) ?></div>
        <?php endif; ?>

        <?php if ($resource['description']): ?>
        <div class="content-block">
          <h2>📋 Tentang Dokumen Ini</h2>
          <?= nl2br(e($resource['description'])) ?>
        </div>
        <?php endif; ?>

        <?php if (!empty($related)): ?>
        <div class="content-block">
          <h2>📁 Dokumen Terkait</h2>
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-top:8px">
            <?php foreach ($related as $r): ?>
            <a href="/resources/<?= e($r['slug']) ?>/" style="display:flex;gap:12px;align-items:center;padding:12px;border:1px solid var(--border);border-radius:8px;text-decoration:none;color:inherit">
              <span style="font-size:1.5rem"><?= match(strtolower($r['file_type']??'')) { 'pdf'=>'📕','xlsx','xls'=>'📊','docx','doc'=>'📝',default=>'📄' } ?></span>
              <span style="font-size:.85rem;font-weight:600;line-height:1.3"><?= e(mb_substr($r['title'],0,60)) ?></span>
            </a>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endif; ?>
      </div>

      <div id="download-form">
        <?php if (!$resource['is_gated']): // Direct download without form ?>
        <div class="gate-form" style="text-align:center">
          <h3>⬇ Download Langsung</h3>
          <p>Klik tombol di bawah untuk download dokumen <?= e($resource['title']) ?></p>
          <a href="/resources/download/<?= $resource['id'] ?>/" class="btn-download-big">⬇ Download Sekarang</a>
        </div>
        <?php else: // Email gate ?>
        <div class="gate-form">
          <h3>📥 Download Dokumen</h3>
          <?php if (!$resource['is_premium']): ?>
          <p>Isi form berikut untuk download <strong>GRATIS</strong>. Data Anda aman dan tidak akan dibagikan.</p>
          <?php else: ?>
          <p>Dokumen premium. Harga: <strong><?= format_price((int)$resource['price']) ?></strong>. Isi form untuk info pembelian.</p>
          <?php endif; ?>

          <?php if (!$resource['is_premium']): ?>
          <form action="/api/resource-lead.php" method="POST">
            <?= csrf_field() ?>
            <input type="hidden" name="resource_id" value="<?= $resource['id'] ?>">
            <input type="hidden" name="resource_slug" value="<?= e($resource['slug']) ?>">
            <input type="text"  name="name"    placeholder="Nama Lengkap *"    required>
            <input type="email" name="email"   placeholder="Email Aktif *"      required>
            <input type="tel"   name="phone"   placeholder="No. WhatsApp">
            <input type="text"  name="company" placeholder="Perusahaan / Instansi">
            <input type="text"  name="jabatan" placeholder="Jabatan">
            <button type="submit">⬇ Download Gratis Sekarang</button>
          </form>
          <?php else: ?>
          <a href="<?= wa_url('Halo, saya ingin mendapatkan dokumen premium: '.$resource['title']) ?>" class="btn-download-big" style="background:var(--green);text-align:center;display:block;padding:14px;">
            💬 Hubungi via WhatsApp
          </a>
          <?php endif; ?>

          <ul class="benefits-list">
            <li>✅ <span>File langsung download setelah submit</span></li>
            <li>✅ <span>100% gratis, tidak perlu kartu kredit</span></li>
            <li>✅ <span>Format siap pakai untuk HSE profesional</span></li>
            <li>🔒 <span>Data pribadi terlindungi dan tidak dibagikan</span></li>
          </ul>
        </div>
        <?php endif; ?>

        <div class="gate-form" style="margin-top:16px;text-align:center;border-color:var(--slate-300)">
          <p style="margin:0 0 12px;color:var(--slate-600);font-size:.9rem">Butuh pelatihan K3 bersertifikat BNSP?</p>
          <a href="<?= wa_url('Halo, saya ingin info pelatihan K3') ?>" style="display:inline-block;background:var(--green);color:var(--surface);padding:10px 20px;border-radius:8px;text-decoration:none;font-weight:600;font-size:.9rem">💬 Konsultasi Gratis</a>
        </div>

        <!-- T17g: fails silent today (no resource-category map yet); wired
             so it activates automatically once that map is added — see T15
             notes. category_slug/category are best-effort field guesses;
             harmless if absent since the branch is unconditionally fail-silent. -->
        <?php
          require_once __DIR__ . '/../includes/related-cta.php';
          echo related_cta('resource', $resource['category_slug'] ?? $resource['category'] ?? '');
        ?>
      </div>
    </div>
  </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
<script src="<?= SITE_URL ?>/assets/js/main.js"></script>
</body></html>
