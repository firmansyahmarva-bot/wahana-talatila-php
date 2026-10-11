<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../artikel-functions.php';
require_once __DIR__ . '/partials/auth.php';
require_auth('articles');

$flash   = flash_get();
$preview = [];
$errors  = [];

// ── Step 2: Confirm upload (after preview) ────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_upload']) && csrf_verify($_POST['csrf_token'] ?? '')) {
    $rows_json = $_POST['rows_json'] ?? '[]';
    $rows      = json_decode($rows_json, true) ?? [];
    $saved = 0; $skipped = 0;

    foreach ($rows as $row) {
        $faqs = [];
        for ($i = 1; $i <= 5; $i++) {
            $q = trim($row["faq_{$i}_q"] ?? '');
            $a = trim($row["faq_{$i}_a"] ?? '');
            if ($q && $a) $faqs[] = ['q' => $q, 'a' => $a];
        }
        $data = [
            'title'        => trim($row['judul'] ?? ''),
            'slug'         => make_slug(trim($row['slug'] ?? '') ?: trim($row['judul'] ?? '')),
            'meta_title'   => trim($row['meta_title'] ?? ''),
            'meta_desc'    => trim($row['meta_desc'] ?? ''),
            'keywords'     => trim($row['keywords'] ?? ''),
            'category'     => trim($row['kategori'] ?? 'K3'),
            'thumbnail'    => trim($row['thumbnail'] ?? ''),
            'content'      => trim($row['konten'] ?? ''),
            'faq'          => $faqs,
            'author'       => trim($row['author'] ?? 'Wahana Totalita Konsultan'),
            'status'       => 'published',
            'published_at' => date('Y-m-d H:i:s'),
        ];
        if (empty($data['title']) || empty($data['content'])) { $skipped++; continue; }
        $result = save_article($data, 0);
        if ($result) { $saved++; } else { $skipped++; } // skip duplicates
    }

    flash_set('success', "✅ Berhasil: $saved artikel dipublikasikan." . ($skipped ? " $skipped dilewati (judul kosong atau slug duplikat)." : ''));
    redirect(SITE_URL . '/admin/artikel.php');
}

// ── Step 1: Parse uploaded CSV ─────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['csv_file']) && csrf_verify($_POST['csrf_token'] ?? '')) {
    $file = $_FILES['csv_file'];
    if ($file['error'] !== UPLOAD_ERR_OK) {
        $errors[] = 'Upload gagal. Coba lagi.';
    } elseif (!in_array(mime_content_type($file['tmp_name']), ['text/csv', 'text/plain', 'application/vnd.ms-excel', 'application/csv'])) {
        $errors[] = 'File harus berformat CSV (.csv).';
    } elseif ($file['size'] > 5 * 1024 * 1024) {
        $errors[] = 'File terlalu besar (max 5MB).';
    } else {
        $handle = fopen($file['tmp_name'], 'r');
        $header = fgetcsv($handle);
        if (!$header) { $errors[] = 'File CSV kosong atau format salah.'; }
        else {
            $header = array_map('trim', $header);
            $count  = 0;
            while (($row = fgetcsv($handle)) !== false && $count < 20) {
                if (count($row) < 2) continue;
                $assoc = array_combine(
                    array_slice($header, 0, count($row)),
                    $row
                ) ?: [];
                if (!empty($assoc['judul'])) {
                    $preview[] = $assoc;
                    $count++;
                }
            }
            fclose($handle);
            if (empty($preview)) $errors[] = 'Tidak ada baris valid ditemukan dalam CSV.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Upload Artikel CSV — Admin</title>
<meta name="robots" content="noindex,nofollow">
<link rel="stylesheet" href="/admin/assets/admin.css">
<style>
.upload-zone{border:2px dashed #d1d5db;border-radius:12px;padding:3rem;text-align:center;
  background:#fafafa;transition:border-color .2s;cursor:pointer}
.upload-zone:hover,.upload-zone.drag-over{border-color:var(--green,#0A4A2E);background:#f0fdf4}
.upload-zone-icon{font-size:3rem;margin-bottom:1rem}
.upload-zone h3{font-size:1.1rem;font-weight:700;margin:0 0 .4rem;color:#1a1a2e}
.upload-zone p{font-size:13px;color:#6b7280;margin:0 0 1.5rem}
.csv-cols{display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:.5rem;margin:1rem 0}
.csv-col{background:#f0fdf4;border:1px solid #a7f3d0;border-radius:6px;padding:6px 10px;
  font-size:12px;font-family:monospace;color:#065f46}
.csv-col.required{background:#fef3ec;border-color:#fed7aa;color:#9a3412}
.preview-table{font-size:12px}
.preview-table td{max-width:200px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;vertical-align:top;padding:6px 10px}
.preview-cell-content{max-width:180px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;display:block}
.pub-count{display:inline-flex;align-items:center;gap:.5rem;background:#d1fae5;
  color:#065f46;padding:10px 16px;border-radius:8px;font-weight:700;margin-bottom:1rem}
.step-indicator{display:flex;gap:.5rem;align-items:center;margin-bottom:2rem;font-size:14px}
.step{display:flex;align-items:center;gap:.4rem}
.step-num{width:28px;height:28px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:13px}
.step-active .step-num{background:var(--green,#0A4A2E);color:#fff}
.step-done .step-num{background:#d1fae5;color:#065f46}
.step-idle .step-num{background:#f3f4f6;color:#9ca3af}
.step-line{width:40px;height:2px;background:#e5e7eb}
</style>
</head>
<body>
<div class="admin-layout">
<div class="mobile-overlay" id="mobileOverlay"></div>
<?php require __DIR__ . '/partials/sidebar.php'; ?>
<main class="admin-main">
<div class="admin-topbar">
  <button class="topbar-hamburger" id="hamburger">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
      <line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/>
    </svg>
  </button>
  <div class="topbar-title">Upload Artikel Batch (CSV)</div>
  <div class="topbar-actions">
    <a href="/admin/artikel.php" class="topbar-btn">← Kembali</a>
    <a href="/admin/artikel-sample.csv" class="topbar-btn" download>⬇ Download Template CSV</a>
  </div>
</div>
<div class="admin-content">

<?php if ($flash): ?>
<div class="alert alert-<?= $flash['type'] === 'success' ? 'success' : 'error' ?>"><?= e($flash['message']) ?></div>
<?php endif; ?>

<!-- Step indicator -->
<div class="step-indicator">
  <div class="step <?= empty($preview) ? 'step-active' : 'step-done' ?>">
    <div class="step-num">1</div><span>Upload CSV</span>
  </div>
  <div class="step-line"></div>
  <div class="step <?= !empty($preview) ? 'step-active' : 'step-idle' ?>">
    <div class="step-num">2</div><span>Preview & Konfirmasi</span>
  </div>
  <div class="step-line"></div>
  <div class="step step-idle">
    <div class="step-num">3</div><span>Publikasi</span>
  </div>
</div>

<?php if (!empty($errors)): ?>
<div class="alert alert-error">
  <?php foreach ($errors as $e): ?><div><?= e($e) ?></div><?php endforeach; ?>
</div>
<?php endif; ?>

<?php if (!empty($preview)): ?>
<!-- ════ STEP 2: PREVIEW ════ -->
<div class="card">
  <div style="padding:1.25rem 1.5rem;border-bottom:1px solid #e5e7eb">
    <div class="pub-count">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
      <?= count($preview) ?> artikel siap dipublikasikan
    </div>
    <p style="font-size:13px;color:#6b7280;margin:0">Periksa preview di bawah. Klik <strong>Publikasikan Semua</strong> untuk menyimpan ke database dan mempublikasikan langsung.</p>
  </div>

  <div class="table-wrap">
    <table class="admin-table preview-table">
      <thead><tr>
        <th>#</th><th>Judul</th><th>Slug</th><th>Kategori</th>
        <th>Meta Desc</th><th>FAQ</th><th>Panjang Konten</th>
      </tr></thead>
      <tbody>
      <?php foreach ($preview as $i => $row): ?>
      <?php
        $faq_count = 0;
        for ($f = 1; $f <= 5; $f++) if (!empty($row["faq_{$f}_q"])) $faq_count++;
        $content_len = strlen($row['konten'] ?? '');
        $word_count = str_word_count(strip_tags($row['konten'] ?? ''));
      ?>
      <tr>
        <td><?= $i + 1 ?></td>
        <td><strong class="preview-cell-content"><?= e($row['judul'] ?? '') ?></strong></td>
        <td><span class="preview-cell-content" style="color:#6b7280;font-size:11px"><?= e(make_slug(($row['slug'] ?? '') ?: ($row['judul'] ?? ''))) ?></span></td>
        <td><span class="badge badge-active"><?= e($row['kategori'] ?? 'K3') ?></span></td>
        <td><span class="preview-cell-content"><?= e(mb_substr($row['meta_desc'] ?? '', 0, 60)) ?></span></td>
        <td><?= $faq_count > 0 ? '<span class="badge badge-active">'.$faq_count.' FAQ</span>' : '<span style="color:#9ca3af">-</span>' ?></td>
        <td>
          <?php if ($word_count < 300): ?>
          <span style="color:#ef4444">⚠ <?= $word_count ?> kata (terlalu pendek)</span>
          <?php elseif ($word_count < 600): ?>
          <span style="color:#f59e0b">~<?= $word_count ?> kata</span>
          <?php else: ?>
          <span style="color:#10b981">✓ ~<?= $word_count ?> kata</span>
          <?php endif; ?>
        </td>
      </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <form method="post" style="padding:1.25rem 1.5rem;border-top:1px solid #e5e7eb;display:flex;gap:.75rem">
    <?= csrf_field() ?>
    <input type="hidden" name="rows_json" value="<?= e(json_encode($preview)) ?>">
    <a href="/admin/artikel-upload.php" class="btn btn-outline">← Upload Ulang</a>
    <button type="submit" name="confirm_upload" value="1" class="btn btn-primary" style="background:#10b981">
      🚀 Publikasikan <?= count($preview) ?> Artikel Sekarang
    </button>
  </form>
</div>

<?php else: ?>
<!-- ════ STEP 1: UPLOAD ════ -->
<div class="card" style="max-width:680px">
  <div style="padding:1.5rem">

    <form method="post" enctype="multipart/form-data" id="uploadForm">
      <?= csrf_field() ?>
      <div class="upload-zone" id="dropZone" onclick="document.getElementById('csvInput').click()">
        <div class="upload-zone-icon">📊</div>
        <h3>Upload File CSV</h3>
        <p>Klik untuk pilih file, atau drag & drop di sini<br><small>Format: .csv | Maks: 20 artikel | Maks file: 5MB</small></p>
        <input type="file" name="csv_file" id="csvInput" accept=".csv" style="display:none" onchange="showFileName(this)">
        <div id="fileName" style="font-size:13px;color:#0A4A2E;font-weight:600;min-height:20px"></div>
      </div>
      <div style="margin-top:1.25rem;text-align:right">
        <button type="submit" class="btn btn-primary" id="submitBtn" disabled>
          📋 Parse & Preview CSV
        </button>
      </div>
    </form>

    <div style="margin-top:2rem;padding-top:2rem;border-top:1px solid #e5e7eb">
      <h4 style="font-size:14px;font-weight:700;margin:0 0 1rem;color:#1a1a2e">Kolom CSV yang Diperlukan</h4>
      <div class="csv-cols">
        <div class="csv-col required">judul ⭐ wajib</div>
        <div class="csv-col required">konten ⭐ wajib</div>
        <div class="csv-col">slug</div>
        <div class="csv-col">meta_desc</div>
        <div class="csv-col">meta_title</div>
        <div class="csv-col">keywords</div>
        <div class="csv-col">kategori</div>
        <div class="csv-col">thumbnail</div>
        <div class="csv-col">author</div>
        <div class="csv-col">faq_1_q</div>
        <div class="csv-col">faq_1_a</div>
        <div class="csv-col">faq_2_q</div>
        <div class="csv-col">faq_2_a</div>
        <div class="csv-col">faq_3_q</div>
        <div class="csv-col">faq_3_a</div>
        <div class="csv-col">faq_4_q / faq_4_a</div>
        <div class="csv-col">faq_5_q / faq_5_a</div>
      </div>
      <p style="font-size:12px;color:#6b7280;margin:.75rem 0 0">
        ⭐ = wajib diisi. Kolom lain opsional.<br>
        Kategori pilihan: <strong>K3, Lingkungan, Mining, ISO, QHSE, Umum</strong><br>
        Konten ditulis dalam HTML. Untuk SEO optimal minimal 800 kata.<br>
        Slug kosong = auto-generate dari judul. Duplikat slug akan dilewati.
      </p>
    </div>

  </div>
</div>
<?php endif; ?>

</div>
</main>
</div>
<script src="/admin/assets/admin.js"></script>
<script>
function showFileName(input){
  var name = input.files[0]?.name || '';
  document.getElementById('fileName').textContent = name ? '📄 ' + name : '';
  document.getElementById('submitBtn').disabled = !name;
}
var dz = document.getElementById('dropZone');
if(dz){
  dz.addEventListener('dragover', function(e){ e.preventDefault(); this.classList.add('drag-over'); });
  dz.addEventListener('dragleave', function(){ this.classList.remove('drag-over'); });
  dz.addEventListener('drop', function(e){
    e.preventDefault(); this.classList.remove('drag-over');
    var f = e.dataTransfer.files[0];
    if(f){ document.getElementById('csvInput').files = e.dataTransfer.files; showFileName({files:[f]}); }
  });
}
</script>
</body>
</html>
