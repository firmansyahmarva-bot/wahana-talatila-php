<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/partials/auth.php';
require_auth('programs');

$pdo        = get_pdo();
$categories = get_categories();
$errors     = [];

$id       = (int)($_GET['id'] ?? $_POST['id'] ?? 0);
$training = [];
$curriculum = [];

if ($id) {
    $stmt = $pdo->prepare('SELECT * FROM trainings WHERE id=? LIMIT 1');
    $stmt->execute([$id]);
    $training = $stmt->fetch() ?: [];
    if (!$training) { flash_set('error','Program tidak ditemukan.'); redirect(SITE_URL.'/admin/trainings.php'); }
    if (!empty($training['curriculum'])) {
        $dec = json_decode($training['curriculum'], true);
        $curriculum = is_array($dec) ? $dec : [];
    }
}
$is_edit = !empty($training);

// ─── HANDLE SAVE ────────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_verify($_POST['csrf_token'] ?? '')) { $errors[] = 'Token tidak valid.'; }
    else {
        $name        = trim($_POST['name']              ?? '');
        $slug_input  = trim($_POST['slug']              ?? '');
        $cat_id      = (int)($_POST['category_id']      ?? 0);
        $description = trim($_POST['description']       ?? '');
        $long_content = trim($_POST['long_content']     ?? '');
        $price       = (int)preg_replace('/\D/', '', $_POST['price'] ?? '0');
        $mode        = in_array($_POST['mode']??'', ['online','offline','both']) ? $_POST['mode'] : 'online';
        $cert        = trim($_POST['certification']     ?? 'Sertifikasi BNSP');
        $duration    = (int)($_POST['duration_days']    ?? 0) ?: null;
        $is_featured = isset($_POST['is_featured']) ? 1 : 0;
        $is_active   = isset($_POST['is_active'])   ? 1 : 0;
        $meta_title  = mb_strimwidth(trim($_POST['meta_title'] ?? ''), 0, 70);
        $meta_desc   = mb_strimwidth(trim($_POST['meta_desc']  ?? ''), 0, 160);
        $wa_text     = trim($_POST['wa_text']           ?? '');
        $sort_order  = (int)($_POST['sort_order']       ?? 0);

        // Curriculum
        $cur_items = array_values(array_filter(array_map('trim', $_POST['curriculum'] ?? [])));
        $cur_json  = empty($cur_items) ? null : json_encode($cur_items, JSON_UNESCAPED_UNICODE);

        // Validation
        if (!$name)   $errors[] = 'Nama program wajib diisi.';
        if (!$cat_id) $errors[] = 'Kategori wajib dipilih.';
        if ($price <= 0) $errors[] = 'Harga harus lebih dari 0.';

        // ─── Slug lock ──────────────────────────────────────────────
        // On edit, the slug NEVER changes unless the admin explicitly
        // unlocked it via the red-warning confirmation in the UI.
        // This is enforced server-side — the confirm flag from the UI
        // is trusted, but the "original slug" always comes from the
        // DB row we loaded, never from POST, so it can't be spoofed.
        $slug_confirmed = !empty($_POST['confirm_slug_change']) && $_POST['confirm_slug_change'] === '1';

        if ($is_edit && !$slug_confirmed) {
            // Ignore whatever the client sent — keep the existing slug, always.
            $slug = $training['slug'];
        } else {
            // New program, or edit with explicit unlock confirmation.
            $slug = $slug_input ? make_slug($slug_input) : make_slug($name);

            // Check slug uniqueness
            if (!$errors) {
                $sl_stmt = $pdo->prepare('SELECT id FROM trainings WHERE slug=? AND id!=?');
                $sl_stmt->execute([$slug, $id]);
                if ($sl_stmt->fetch()) {
                    $slug_suffix = 1;
                    $slug_base   = $slug;
                    do {
                        $slug = $slug_base . '-' . $slug_suffix++;
                        $sl_stmt->execute([$slug, $id]);
                    } while ($sl_stmt->fetch());
                }
            }
        }

        $old_slug_for_redirect = ($is_edit && $slug_confirmed && $slug !== $training['slug']) ? $training['slug'] : null;

        // Image upload
        $image_path = $training['image_path'] ?? null;
        if (!empty($_POST['remove_image']) && $image_path) {
            @unlink(UPLOAD_DIR . basename($image_path));
            $image_path = null;
        }
        if (!empty($_FILES['image']['tmp_name']) && !$errors) {
            $file  = $_FILES['image'];
            $allow = ['image/jpeg','image/png','image/webp','image/gif'];
            $maxb  = UPLOAD_MAX_MB * 1024 * 1024;
            if (!in_array($file['type'], $allow)) $errors[] = 'Tipe gambar tidak didukung.';
            elseif ($file['size'] > $maxb)         $errors[] = 'Ukuran gambar melebihi ' . UPLOAD_MAX_MB . 'MB.';
            else {
                $ext  = pathinfo($file['name'], PATHINFO_EXTENSION);
                $fname = bin2hex(random_bytes(8)) . '.' . $ext;
                if (!is_dir(UPLOAD_DIR)) mkdir(UPLOAD_DIR, 0755, true);
                if (move_uploaded_file($file['tmp_name'], UPLOAD_DIR . $fname)) {
                    if ($image_path) @unlink(UPLOAD_DIR . basename($image_path));
                    $image_path = $fname;
                } else { $errors[] = 'Gagal upload gambar.'; }
            }
        }

        if (!$errors) {
            if ($is_edit) {
                $was_active = (int)($training['is_active'] ?? 0);

                $pdo->prepare(
                    'UPDATE trainings SET category_id=?,name=?,slug=?,mode=?,certification=?,
                     price=?,description=?,long_content=?,curriculum=?,duration_days=?,image_path=?,
                     meta_title=?,meta_desc=?,wa_text=?,is_featured=?,is_active=?,
                     sort_order=?,updated_at=NOW()
                     WHERE id=?'
                )->execute([$cat_id,$name,$slug,$mode,$cert,$price,$description,$long_content,$cur_json,
                            $duration,$image_path,$meta_title,$meta_desc,$wa_text,
                            $is_featured,$is_active,$sort_order,$id]);

                // Log the redirect so pelatihan.php 301s the old URL instead of 404ing.
                if ($old_slug_for_redirect) {
                    $pdo->prepare(
                        'INSERT INTO training_redirects (old_slug, target_slug, target_category_slug, reason)
                         VALUES (?, ?, NULL, ?)
                         ON DUPLICATE KEY UPDATE target_slug=VALUES(target_slug), target_category_slug=NULL, reason=VALUES(reason), created_at=NOW()'
                    )->execute([$old_slug_for_redirect, $slug, 'slug_changed']);
                }
                // Program just deactivated -> old URL should 301 to its category hub, not 404.
                if ($was_active === 1 && $is_active === 0) {
                    $cat_slug_stmt = $pdo->prepare('SELECT slug FROM categories WHERE id=?');
                    $cat_slug_stmt->execute([$cat_id]);
                    $cat_slug_for_redirect = $cat_slug_stmt->fetchColumn() ?: null;
                    $pdo->prepare(
                        'INSERT INTO training_redirects (old_slug, target_slug, target_category_slug, reason)
                         VALUES (?, NULL, ?, ?)
                         ON DUPLICATE KEY UPDATE target_slug=NULL, target_category_slug=VALUES(target_category_slug), reason=VALUES(reason), created_at=NOW()'
                    )->execute([$slug, $cat_slug_for_redirect, 'deactivated']);
                }
                // Reactivated -> the redirect no longer applies.
                if ($was_active === 0 && $is_active === 1) {
                    $pdo->prepare('DELETE FROM training_redirects WHERE old_slug=? AND reason=?')->execute([$slug, 'deactivated']);
                }

                flash_set('success',"Program \"$name\" berhasil diperbarui.");
            } else {
                $pdo->prepare(
                    'INSERT INTO trainings
                     (category_id,name,slug,mode,certification,price,description,long_content,curriculum,
                      duration_days,image_path,meta_title,meta_desc,wa_text,is_featured,
                      is_active,sort_order)
                     VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)'
                )->execute([$cat_id,$name,$slug,$mode,$cert,$price,$description,$long_content,$cur_json,
                            $duration,$image_path,$meta_title,$meta_desc,$wa_text,
                            $is_featured,$is_active,$sort_order]);
                flash_set('success',"Program \"$name\" berhasil ditambahkan.");
            }
            redirect(SITE_URL . '/admin/trainings.php');
        }
    }
}

// Helper: field value (from POST or existing training)
function fv(array $t, string $key, $default = ''): string {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        return e((string)($_POST[$key] ?? $default));
    }
    return e((string)($t[$key] ?? $default));
}
// Raw value (for textareas with HTML content — no double-escaping)
function fv_raw(array $t, string $key, $default = ''): string {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        return e((string)($_POST[$key] ?? $default));
    }
    return e((string)($t[$key] ?? $default));
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= $is_edit ? 'Edit' : 'Tambah' ?> Program — Admin</title>
<meta name="robots" content="noindex,nofollow">
<link rel="stylesheet" href="/admin/assets/admin.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<style>
/* Layout bridge — old classes mapped to new admin system */
.admin-wrap{display:flex;min-height:100vh}
.main-area{flex:1;margin-left:248px;display:flex;flex-direction:column}
.topbar{height:60px;background:#fff;border-bottom:1px solid #e5e9ef;display:flex;align-items:center;justify-content:space-between;padding:0 24px;position:sticky;top:0;z-index:100;box-shadow:0 1px 4px rgba(0,0,0,.04)}
.topbar-title{font-size:17px;font-weight:700;color:#111827}
.content{padding:24px;background:#f0f4f8;min-height:calc(100vh - 60px)}
.card-section{background:#fff;border-radius:10px;border:1px solid #e5e9ef;padding:20px 24px;margin-bottom:20px}
.card-section h6{font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:#6b7280;margin-bottom:16px;padding-bottom:10px;border-bottom:1px solid #e5e9ef}
.btn-save{display:block;width:100%;padding:13px;background:#0A4A2E;color:#fff;font-size:15px;font-weight:700;border:none;border-radius:8px;cursor:pointer;transition:background .2s}
.btn-save:hover{background:#0d5c38}
.form-label{font-size:13px;font-weight:600;color:#374151;margin-bottom:5px}
.form-text{font-size:11px;color:#888;margin-top:4px}
.form-control,.form-select{font-size:14px;border-color:#e5e7eb;border-radius:8px}
.form-control:focus,.form-select:focus{border-color:#0A4A2E;box-shadow:0 0 0 3px rgba(10,74,46,.1)}
.img-preview{border-radius:8px;border:1px solid #e8e8e8;max-height:200px;object-fit:cover}
.curriculum-row{display:flex;gap:6px;margin-bottom:6px}
.curriculum-row input{flex:1;padding:8px 12px;border:1.5px solid #e5e7eb;border-radius:7px;font-size:13px;outline:none}
.curriculum-row button{padding:8px 12px;background:#FEF2F2;color:#991B1B;border:1px solid #FECACA;border-radius:7px;cursor:pointer;font-size:12px}
.long-content-area{width:100%;min-height:400px;font-family:'Consolas','Monaco','Courier New',monospace;font-size:13px;line-height:1.6;padding:16px;border:1.5px solid #e5e7eb;border-radius:8px;resize:vertical;tab-size:2}
.long-content-area:focus{border-color:#0A4A2E;box-shadow:0 0 0 3px rgba(10,74,46,.1);outline:none}
.editor-toolbar{display:flex;gap:4px;margin-bottom:8px;flex-wrap:wrap}
.editor-toolbar button{padding:5px 10px;background:#f8f9fa;border:1px solid #e5e7eb;border-radius:5px;font-size:12px;font-weight:600;cursor:pointer;color:#374151}
.editor-toolbar button:hover{background:#E8F4EE;border-color:#0A4A2E;color:#0A4A2E}
.char-count{font-size:11px;color:#888;margin-top:4px;text-align:right}
.preview-toggle{display:inline-flex;gap:0;border:1px solid #e5e7eb;border-radius:6px;overflow:hidden;margin-bottom:8px}
.preview-toggle button{padding:6px 14px;border:none;background:#fff;font-size:12px;font-weight:600;cursor:pointer;color:#6b7280}
.preview-toggle button.active{background:#0A4A2E;color:#fff}
.long-content-preview{display:none;padding:16px 20px;border:1.5px solid #e5e7eb;border-radius:8px;min-height:200px;font-size:14px;line-height:1.7;background:#fafafa}
.long-content-preview h2,.long-content-preview h3,.long-content-preview h4{margin:1.2em 0 .5em;color:#111}
.long-content-preview p{margin:.5em 0}
.long-content-preview ul,.long-content-preview ol{padding-left:1.5em;margin:.5em 0}
.long-content-preview table{border-collapse:collapse;width:100%;margin:1em 0}
.long-content-preview th,.long-content-preview td{border:1px solid #ddd;padding:8px;text-align:left}
@media(max-width:900px){.main-area{margin-left:0}}
</style>
</head>
<body>
<div class="admin-wrap">
  <?php include __DIR__ . '/partials/sidebar.php'; ?>
  <div class="main-area">
    <div class="topbar">
      <div class="topbar-title"><?= $is_edit ? 'Edit Program' : 'Tambah Program Baru' ?></div>
      <a href="/admin/trainings.php" style="font-size:13px;color:#888">&larr; Kembali</a>
    </div>
    <div class="content">

      <?php if (!empty($errors)): ?>
      <div class="alert alert-danger mb-4" style="border-radius:8px">
        <strong>Terdapat kesalahan:</strong>
        <ul class="mb-0 mt-1 ps-3"><?php foreach ($errors as $e): ?><li><?= e($e) ?></li><?php endforeach; ?></ul>
      </div>
      <?php endif; ?>

      <form method="post" enctype="multipart/form-data" novalidate>
        <?= csrf_field() ?>
        <?php if ($is_edit): ?><input type="hidden" name="id" value="<?= $id ?>"><?php endif; ?>

        <div class="row g-4">

          <!-- LEFT COLUMN -->
          <div class="col-lg-8">

            <!-- Basic Info -->
            <div class="card-section">
              <h6>Informasi Dasar</h6>
              <div class="mb-3">
                <label class="form-label">Nama Program *</label>
                <input type="text" class="form-control" name="name"
                       value="<?= fv($training,'name') ?>"
                       oninput="autoSlug(this.value)" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Slug URL *</label>
                <?php if ($is_edit): ?>
                <div style="display:flex;gap:8px;align-items:center">
                  <input type="text" class="form-control" id="slug" name="slug"
                         value="<?= fv($training,'slug') ?>" readonly
                         style="background:#f3f4f6;color:#6b7280;cursor:not-allowed">
                  <button type="button" class="btn btn-sm btn-outline-danger" style="white-space:nowrap;font-size:12px"
                          onclick="openSlugWarning()">🔓 Ubah URL</button>
                </div>
                <input type="hidden" name="confirm_slug_change" id="confirmSlugChange" value="0">
                <div class="form-text">URL: /pelatihan/<strong id="slug-preview"><?= fv($training,'slug') ?: '&hellip;' ?></strong>/ &mdash; <strong style="color:#0A4A2E">Terkunci.</strong> Mengubah URL memutus semua tautan &amp; peringkat Google yang sudah ada.</div>
                <?php else: ?>
                <input type="text" class="form-control" id="slug" name="slug"
                       value="<?= fv($training,'slug') ?>">
                <div class="form-text">URL: /pelatihan/<strong id="slug-preview"><?= fv($training,'slug') ?: '&hellip;' ?></strong>/</div>
                <?php endif; ?>
              </div>
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label">Kategori *</label>
                  <select class="form-select" name="category_id" required>
                    <option value="">-- Pilih Kategori --</option>
                    <?php foreach ($categories as $c): ?>
                    <option value="<?= $c['id'] ?>" <?= (($training['category_id']??0)==$c['id']||($_POST['category_id']??0)==$c['id'])?'selected':'' ?>>
                      <?= $c['icon'] ?> <?= e($c['name']) ?>
                    </option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Mode Pelatihan</label>
                  <select class="form-select" name="mode">
                    <?php foreach(['online'=>'Online','offline'=>'Tatap Muka (Offline)','both'=>'Online &amp; Tatap Muka'] as $v=>$l): ?>
                    <option value="<?= $v ?>" <?= (fv($training,'mode','online')===$v)?'selected':'' ?>><?= $l ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>

            <!-- Description (short) -->
            <div class="card-section">
              <h6>Deskripsi Singkat</h6>
              <textarea class="form-control" name="description" rows="4"
                        placeholder="Ringkasan program untuk card dan meta description (2-3 kalimat)…"><?= fv($training,'description') ?></textarea>
              <div class="form-text">Ditampilkan di kartu program dan preview Google. Singkat, padat.</div>
            </div>

            <!-- Long Content (HTML) -->
            <div class="card-section">
              <h6>Konten Detail Program <small style="font-weight:400;text-transform:none;font-size:11px;color:#888">(opsional — HTML)</small></h6>

              <div class="preview-toggle">
                <button type="button" class="active" onclick="showEditor()">Edit HTML</button>
                <button type="button" onclick="showPreview()">Preview</button>
              </div>

              <div class="editor-toolbar" id="editorToolbar">
                <button type="button" onclick="insertTag('h2')">H2</button>
                <button type="button" onclick="insertTag('h3')">H3</button>
                <button type="button" onclick="insertTag('p')">P</button>
                <button type="button" onclick="insertTag('strong')">Bold</button>
                <button type="button" onclick="insertTag('ul')">UL</button>
                <button type="button" onclick="insertTag('ol')">OL</button>
                <button type="button" onclick="insertTag('li')">LI</button>
                <button type="button" onclick="insertLink()">Link</button>
                <button type="button" onclick="insertTag('table')">Table</button>
                <button type="button" onclick="insertTag('blockquote')">Quote</button>
              </div>

              <textarea class="long-content-area" name="long_content" id="longContent"
                        placeholder="Tulis konten detail program dalam HTML.&#10;&#10;Contoh:&#10;&lt;h2&gt;Apa Itu Ahli K3 Umum?&lt;/h2&gt;&#10;&lt;p&gt;Ahli K3 Umum adalah...&lt;/p&gt;&#10;&#10;&lt;h2&gt;Mengapa Penting?&lt;/h2&gt;&#10;&lt;p&gt;Sertifikasi ini diperlukan karena...&lt;/p&gt;"><?= fv_raw($training,'long_content') ?></textarea>

              <div class="long-content-preview" id="longContentPreview"></div>

              <div class="char-count">
                <span id="wordCount">0</span> kata · <span id="charCount">0</span> karakter
              </div>
              <div class="form-text">Konten detail yang muncul di halaman pelatihan. Tulis dalam HTML: gunakan &lt;h2&gt;, &lt;h3&gt;, &lt;p&gt;, &lt;ul&gt;, &lt;strong&gt;, &lt;a href=""&gt;. Minimal 500 kata untuk SEO optimal.</div>
            </div>

            <!-- Curriculum -->
            <div class="card-section">
              <h6>Materi / Kurikulum <small style="font-weight:400;text-transform:none;font-size:11px;color:#888">(opsional)</small></h6>
              <div id="curriculum-list">
                <?php
                $cur_items_display = $_SERVER['REQUEST_METHOD']==='POST'
                  ? array_filter(array_map('trim', $_POST['curriculum'] ?? []))
                  : $curriculum;
                foreach ($cur_items_display as $item):
                ?>
                <div class="curriculum-row">
                  <input type="text" name="curriculum[]" value="<?= e($item) ?>" placeholder="Materi / topik pelatihan">
                  <button type="button" onclick="this.closest('.curriculum-row').remove()">&#10005;</button>
                </div>
                <?php endforeach; ?>
              </div>
              <button type="button" onclick="addCurriculumRow()" style="margin-top:8px;padding:7px 14px;background:var(--green-light,#E8F4EE);color:#0A4A2E;border:1.5px solid #b8d8c8;border-radius:7px;font-size:13px;font-weight:600;cursor:pointer">+ Tambah Materi</button>
            </div>

            <!-- SEO -->
            <div class="card-section">
              <h6>SEO Meta Tags</h6>
              <div class="mb-3">
                <label class="form-label">Meta Title <small>(max 70 karakter)</small></label>
                <input type="text" class="form-control" name="meta_title"
                       value="<?= fv($training,'meta_title') ?>" maxlength="70"
                       placeholder="Biarkan kosong untuk generate otomatis">
              </div>
              <div class="mb-3">
                <label class="form-label">Meta Description <small>(max 160 karakter)</small></label>
                <textarea class="form-control" name="meta_desc" rows="3" maxlength="160"
                          placeholder="Biarkan kosong untuk generate otomatis"><?= fv($training,'meta_desc') ?></textarea>
              </div>
              <div class="mb-0">
                <label class="form-label">WhatsApp Pre-filled Message</label>
                <input type="text" class="form-control" name="wa_text"
                       value="<?= fv($training,'wa_text') ?>"
                       placeholder="Halo, saya ingin info …">
              </div>
            </div>

          </div>

          <!-- RIGHT COLUMN -->
          <div class="col-lg-4">

            <!-- Publish -->
            <div class="card-section">
              <h6>Publikasi</h6>
              <div class="mb-3 form-check">
                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                       <?= (!$is_edit || !empty($training['is_active'])) ? 'checked' : '' ?>>
                <label class="form-check-label" for="is_active" style="font-size:13px">Program Aktif</label>
              </div>
              <div class="mb-4 form-check">
                <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1"
                       <?= !empty($training['is_featured']) ? 'checked' : '' ?>>
                <label class="form-check-label" for="is_featured" style="font-size:13px">Tampilkan sebagai Unggulan</label>
              </div>
              <div class="mb-3">
                <label class="form-label">Sertifikasi</label>
                <input type="text" class="form-control" name="certification"
                       value="<?= fv($training,'certification','Sertifikasi BNSP') ?>">
              </div>
              <div class="mb-3">
                <label class="form-label">Harga (IDR) *</label>
                <div class="input-group">
                  <span class="input-group-text">Rp</span>
                  <input type="text" class="form-control" name="price"
                         value="<?= number_format((int)($training['price']??0),0,',','.') ?>"
                         placeholder="3.750.000"
                         oninput="this.value=this.value.replace(/[^0-9.]/g,'')">
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label">Durasi Pelatihan (hari)</label>
                <input type="number" class="form-control" name="duration_days"
                       value="<?= (int)($training['duration_days']??3) ?>" min="1" max="90">
              </div>
              <div class="mb-4">
                <label class="form-label">Urutan Tampil</label>
                <input type="number" class="form-control" name="sort_order"
                       value="<?= (int)($training['sort_order']??0) ?>" min="0">
                <div class="form-text">Angka lebih kecil tampil lebih atas.</div>
              </div>
              <button type="submit" class="btn-save w-100">
                <?= $is_edit ? 'Simpan Perubahan' : '+ Tambah Program' ?>
              </button>
              <?php if ($is_edit): ?>
              <a href="/pelatihan/<?= e($training['slug']) ?>/" target="_blank"
                 class="btn btn-sm btn-outline-secondary w-100 mt-2" style="font-size:13px;border-radius:8px;margin-top:8px;display:block;text-align:center;padding:8px">
                ↗ Lihat Halaman
              </a>
              <?php endif; ?>
            </div>

            <!-- Image Upload -->
            <div class="card-section">
              <h6>Gambar Program</h6>
              <?php
              $curr_img = $training['image_path'] ?? null;
              $img_url  = $curr_img ? '/assets/uploads/' . basename($curr_img) : null;
              ?>
              <?php if ($img_url): ?>
              <div class="mb-3">
                <img src="<?= e($img_url) ?>" class="img-preview w-100" alt="Gambar saat ini">
                <div class="form-check mt-2">
                  <input class="form-check-input" type="checkbox" id="remove_image" name="remove_image" value="1">
                  <label class="form-check-label text-danger" for="remove_image" style="font-size:12px">Hapus gambar ini</label>
                </div>
              </div>
              <?php endif; ?>
              <label class="form-label"><?= $img_url ? 'Ganti' : 'Upload' ?> Gambar</label>
              <input type="file" class="form-control form-control-sm" name="image"
                     accept="image/jpeg,image/png,image/webp"
                     onchange="previewImg(this)">
              <div class="form-text">JPG/PNG/WebP &middot; Maks <?= UPLOAD_MAX_MB ?>MB &middot; 800&times;500px disarankan</div>
              <div id="new-img-wrap" style="display:none;margin-top:8px">
                <img id="new-img" class="img-preview w-100" alt="Preview">
              </div>
            </div>

          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<?php if ($is_edit): ?>
<!-- Slug change warning modal -->
<div id="slugWarningOverlay" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:2000;align-items:center;justify-content:center">
  <div style="background:#fff;border-radius:12px;max-width:480px;width:92%;padding:0;overflow:hidden;box-shadow:0 20px 60px rgba(0,0,0,.3)">
    <div style="background:#FEF2F2;border-bottom:2px solid #FECACA;padding:18px 24px;display:flex;align-items:center;gap:10px">
      <span style="font-size:1.5rem">⚠️</span>
      <h5 style="margin:0;color:#991B1B;font-weight:800;font-size:16px">Peringatan: Mengubah URL</h5>
    </div>
    <div style="padding:22px 24px">
      <p style="font-size:14px;color:#374151;line-height:1.6;margin:0 0 12px">
        URL halaman ini sudah <strong>terindeks di Google</strong> dan mungkin sudah punya backlink dari luar. Mengubahnya akan:
      </p>
      <ul style="font-size:13.5px;color:#4b5563;line-height:1.8;margin:0 0 16px;padding-left:20px">
        <li>Memutus semua tautan lama yang mengarah ke halaman ini</li>
        <li>Mereset riwayat peringkat pencarian (SEO) untuk URL baru</li>
        <li>Membuat link yang sudah dibagikan (WhatsApp, brosur, dll) tidak berfungsi kecuali di-update manual</li>
      </ul>
      <p style="font-size:13px;color:#6b7280;margin:0 0 16px">Sistem akan otomatis membuat redirect 301 dari URL lama ke URL baru, tapi tetap disarankan hanya mengubah URL bila benar-benar diperlukan.</p>
      <div class="form-check" style="margin-bottom:18px">
        <input class="form-check-input" type="checkbox" id="slugRiskAck" onchange="document.getElementById('slugUnlockBtn').disabled = !this.checked">
        <label class="form-check-label" for="slugRiskAck" style="font-size:13.5px;font-weight:600;color:#991B1B">Saya paham risikonya dan ingin tetap mengubah URL</label>
      </div>
      <div style="display:flex;gap:10px;justify-content:flex-end">
        <button type="button" onclick="closeSlugWarning()" style="padding:9px 18px;background:#f3f4f6;color:#374151;border:none;border-radius:8px;font-weight:600;font-size:13.5px;cursor:pointer">Batal</button>
        <button type="button" id="slugUnlockBtn" disabled onclick="confirmSlugUnlock()" style="padding:9px 18px;background:#991B1B;color:#fff;border:none;border-radius:8px;font-weight:600;font-size:13.5px;cursor:pointer;opacity:.5">Ya, Ubah URL</button>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
const isEditMode = <?= $is_edit ? 'true' : 'false' ?>;
const slugEl = document.getElementById('slug');
const slugPrev = document.getElementById('slug-preview');
function slugify(v){return v.toLowerCase().replace(/[àáâãä]/g,'a').replace(/[èéêë]/g,'e').replace(/[ìíîï]/g,'i').replace(/[òóôöõ]/g,'o').replace(/[ùúûü]/g,'u').replace(/[^a-z0-9\s-]/g,'').replace(/[\s-]+/g,'-').replace(/^-|-$/g,'');}
function autoSlug(v){
  // In edit mode the slug is locked — name edits must NEVER touch it, silently or otherwise.
  if (isEditMode) return;
  if(slugEl && !slugEl.dataset.edited){ slugEl.value = slugify(v); if(slugPrev) slugPrev.textContent = slugEl.value||'…'; }
}
if(slugEl && !isEditMode){ slugEl.addEventListener('input', function(){ this.dataset.edited='1'; if(slugPrev) slugPrev.textContent=this.value||'…'; }); }
if(slugEl && isEditMode){ slugEl.addEventListener('input', function(){ if(slugPrev) slugPrev.textContent=this.value||'…'; }); }

function openSlugWarning(){
  document.getElementById('slugRiskAck').checked = false;
  document.getElementById('slugUnlockBtn').disabled = true;
  document.getElementById('slugUnlockBtn').style.opacity = '.5';
  document.getElementById('slugWarningOverlay').style.display = 'flex';
}
function closeSlugWarning(){
  document.getElementById('slugWarningOverlay').style.display = 'none';
}
function confirmSlugUnlock(){
  slugEl.readOnly = false;
  slugEl.style.background = '#fff';
  slugEl.style.color = '#111';
  slugEl.style.cursor = 'text';
  slugEl.dataset.edited = '1';
  document.getElementById('confirmSlugChange').value = '1';
  closeSlugWarning();
  slugEl.focus();
}
document.getElementById('slugRiskAck') && document.getElementById('slugRiskAck').addEventListener('change', function(){
  var btn = document.getElementById('slugUnlockBtn');
  btn.disabled = !this.checked;
  btn.style.opacity = this.checked ? '1' : '.5';
});
function addCurriculumRow(){
  var div = document.createElement('div'); div.className='curriculum-row';
  div.innerHTML='<input type="text" name="curriculum[]" placeholder="Materi / topik pelatihan"><button type="button" onclick="this.closest(\'.curriculum-row\').remove()">✕</button>';
  document.getElementById('curriculum-list').appendChild(div);
  div.querySelector('input').focus();
}
function previewImg(input){
  if(input.files&&input.files[0]){
    var r=new FileReader(); r.onload=function(e){document.getElementById('new-img').src=e.target.result;document.getElementById('new-img-wrap').style.display='block';};
    r.readAsDataURL(input.files[0]);
  }
}

// ── Long Content Editor ──
var lc = document.getElementById('longContent');
var lcPreview = document.getElementById('longContentPreview');
var wordCountEl = document.getElementById('wordCount');
var charCountEl = document.getElementById('charCount');

function updateCounts(){
  var text = lc.value.replace(/<[^>]*>/g, ' ').replace(/\s+/g, ' ').trim();
  wordCountEl.textContent = text ? text.split(' ').length : 0;
  charCountEl.textContent = lc.value.length;
}
lc.addEventListener('input', updateCounts);
updateCounts();

function showEditor(){
  lc.style.display = 'block';
  document.getElementById('editorToolbar').style.display = 'flex';
  lcPreview.style.display = 'none';
  document.querySelectorAll('.preview-toggle button').forEach(function(b,i){ b.classList.toggle('active', i===0); });
}
function showPreview(){
  lc.style.display = 'none';
  document.getElementById('editorToolbar').style.display = 'none';
  lcPreview.innerHTML = lc.value || '<em style="color:#888">Belum ada konten.</em>';
  lcPreview.style.display = 'block';
  document.querySelectorAll('.preview-toggle button').forEach(function(b,i){ b.classList.toggle('active', i===1); });
}

function insertTag(tag){
  var start = lc.selectionStart;
  var end = lc.selectionEnd;
  var selected = lc.value.substring(start, end);

  var insert = '';
  if (tag === 'ul' || tag === 'ol') {
    insert = '<' + tag + '>\n  <li>' + (selected || '') + '</li>\n</' + tag + '>';
  } else if (tag === 'table') {
    insert = '<table>\n  <thead>\n    <tr>\n      <th>Header 1</th>\n      <th>Header 2</th>\n    </tr>\n  </thead>\n  <tbody>\n    <tr>\n      <td>' + (selected || '') + '</td>\n      <td></td>\n    </tr>\n  </tbody>\n</table>';
  } else {
    insert = '<' + tag + '>' + (selected || '') + '</' + tag + '>';
  }

  lc.value = lc.value.substring(0, start) + insert + lc.value.substring(end);
  lc.focus();
  lc.selectionStart = lc.selectionEnd = start + insert.length;
  updateCounts();
}

function insertLink(){
  var start = lc.selectionStart;
  var end = lc.selectionEnd;
  var selected = lc.value.substring(start, end) || 'teks link';
  var url = prompt('URL:', 'https://');
  if (!url) return;
  var insert = '<a href="' + url + '">' + selected + '</a>';
  lc.value = lc.value.substring(0, start) + insert + lc.value.substring(end);
  lc.focus();
  updateCounts();
}

// Tab key inserts spaces in textarea
lc.addEventListener('keydown', function(e){
  if (e.key === 'Tab') {
    e.preventDefault();
    var start = this.selectionStart;
    this.value = this.value.substring(0, start) + '  ' + this.value.substring(this.selectionEnd);
    this.selectionStart = this.selectionEnd = start + 2;
  }
});
</script>
</body>
</html>
