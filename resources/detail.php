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
<link rel="stylesheet" href="<?= asset_v('/assets/css/style.css') ?>">
<?= theme_css_vars($s) ?>
<style>
.detail-hero{background:linear-gradient(135deg,var(--green),#1a5c3a);padding:50px 0 40px;color:#fff}
.detail-hero-inner{display:grid;grid-template-columns:1fr auto;gap:40px;align-items:center}
.detail-hero h1{font-size:clamp(1.5rem,3vw,2.2rem);font-weight:800;margin:0 0 12px}
.detail-hero .cat-tag{display:inline-flex;align-items:center;gap:6px;background:rgba(255,255,255,.15);padding:6px 14px;border-radius:100px;font-size:.85rem;margin-bottom:16px}
.detail-hero .meta{display:flex;gap:20px;font-size:.875rem;opacity:.8;flex-wrap:wrap;margin-top:12px}
.download-box{background:#fff;border-radius:16px;padding:32px;text-align:center;min-width:260px;box-shadow:0 8px 32px rgba(0,0,0,.2)}
.download-box .file-icon{font-size:4rem;display:block;margin-bottom:12px}
.download-box .file-type-badge{display:inline-block;background:#f0f9f0;color:var(--green);font-weight:700;padding:4px 12px;border-radius:100px;font-size:.85rem;margin-bottom:16px}
.btn-download-big{display:block;background:var(--orange);color:#fff;padding:14px 28px;border-radius:12px;font-weight:700;font-size:1.1rem;text-decoration:none;border:none;cursor:pointer;width:100%}
.btn-download-big:hover{background:var(--orange-dark)}
.detail-content{padding:48px 0}
.detail-content-grid{display:grid;grid-template-columns:1fr 320px;gap:40px}
.content-block{background:#fff;border-radius:12px;border:1px solid #eee;padding:32px;margin-bottom:24px}
.content-block h2{font-size:1.2rem;font-weight:700;margin:0 0 16px;color:var(--green)}
.tag-list{display:flex;gap:8px;flex-wrap:wrap;margin-top:8px}
.tag{display:inline-block;background:#f0f9f0;color:var(--green);padding:4px 12px;border-radius:100px;font-size:.8rem;font-weight:600}
.gate-form{background:#fff;border-radius:16px;border:2px solid var(--green);padding:28px}
.gate-form h3{margin:0 0 8px;color:var(--green);font-size:1.2rem}
.gate-form p{font-size:.875rem;color:#666;margin:0 0 20px}
.gate-form input{width:100%;box-sizing:border-box;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:.95rem;margin-bottom:12px;font-family:inherit}
.gate-form input:focus{outline:none;border-color:var(--green);box-shadow:0 0 0 3px rgba(10,74,46,.1)}
.gate-form button{width:100%;background:var(--orange);color:#fff;border:none;padding:14px;border-radius:8px;font-size:1rem;font-weight:700;cursor:pointer}
.gate-form button:hover{background:var(--orange-dark)}
.benefits-list{list-style:none;padding:0;margin:16px 0}
.benefits-list li{padding:8px 0;border-bottom:1px solid #f0f0f0;display:flex;gap:10px;align-items:flex-start;font-size:.9rem}
.benefits-list li:last-child{border-bottom:none}
.flash{padding:14px 20px;border-radius:8px;margin-bottom:20px;font-weight:500}
.flash.success{background:#dcfce7;color:#166534;border:1px solid #bbf7d0}
.flash.error{background:#fee2e2;color:#991b1b;border:1px solid #fecaca}
@media(max-width:768px){.detail-hero-inner{grid-template-columns:1fr}.download-box{display:none}.detail-content-grid{grid-template-columns:1fr}}
</style>
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
          <span style="background:rgba(255,255,255,.2);padding:2px 10px;border-radius:100px;">✅ GRATIS</span>
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
        <div style="font-size:.8rem;color:#999;margin-bottom:20px;">Langsung download setelah isi form</div>
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
            <a href="/resources/<?= e($r['slug']) ?>/" style="display:flex;gap:12px;align-items:center;padding:12px;border:1px solid #eee;border-radius:8px;text-decoration:none;color:inherit">
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

        <div class="gate-form" style="margin-top:16px;text-align:center;border-color:#ddd">
          <p style="margin:0 0 12px;color:#666;font-size:.9rem">Butuh pelatihan K3 bersertifikat BNSP?</p>
          <a href="<?= wa_url('Halo, saya ingin info pelatihan K3') ?>" style="display:inline-block;background:var(--green);color:#fff;padding:10px 20px;border-radius:8px;text-decoration:none;font-weight:600;font-size:.9rem">💬 Konsultasi Gratis</a>
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
