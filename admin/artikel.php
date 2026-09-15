<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../artikel-functions.php';
require_once __DIR__ . '/../includes/hub-category-map.php';
require_once __DIR__ . '/partials/auth.php';
require_auth('articles');
$pdo = get_pdo();

// ── Handle POST actions ────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && csrf_verify($_POST['csrf_token'] ?? '')) {
    $action = $_POST['action'] ?? '';

    if ($action === 'save') {
        $id  = (int)($_POST['id'] ?? 0);

        // ─── Slug lock (same pattern as training-save.php / Fix 9) ───
        // Editing the Title must NEVER silently change the slug on an
        // existing article. Only an explicit, confirmed unlock can.
        $existing = $id ? get_article_by_id($id) : null;
        $slug_confirmed = !empty($_POST['confirm_slug_change']) && $_POST['confirm_slug_change'] === '1';

        if ($existing && !$slug_confirmed) {
            $slug = $existing['slug'];
        } else {
            $slug = make_slug(trim($_POST['slug'] ?? '') ?: trim($_POST['title'] ?? ''));
        }
        $old_slug_for_redirect = ($existing && $slug_confirmed && $slug !== $existing['slug']) ? $existing['slug'] : null;

        // Build FAQ array
        $faqs = [];
        $fq = $_POST['faq_q'] ?? [];
        $fa = $_POST['faq_a'] ?? [];
        foreach ($fq as $i => $q) {
            $q = trim($q); $a = trim($fa[$i] ?? '');
            if ($q && $a) $faqs[] = ['q' => $q, 'a' => $a];
        }
        $data = [
            'title'       => trim($_POST['title'] ?? ''),
            'slug'        => $slug,
            'meta_title'  => trim($_POST['meta_title'] ?? ''),
            'meta_desc'   => trim($_POST['meta_desc'] ?? ''),
            'keywords'    => trim($_POST['keywords'] ?? ''),
            'category'    => trim($_POST['category'] ?? 'K3'),
            'thumbnail'   => trim($_POST['thumbnail'] ?? ''),
            'content'     => trim($_POST['content'] ?? ''),
            'faq'         => $faqs,
            'author'      => trim($_POST['author'] ?? 'Wahana Totalita Konsultan'),
            'status'      => $_POST['status'] === 'published' ? 'published' : 'draft',
            'published_at'=> trim($_POST['published_at'] ?? ''),
        ];
        if (empty($data['title'])) { flash_set('error', 'Judul artikel tidak boleh kosong.'); }
        elseif (empty($data['content'])) { flash_set('error', 'Konten artikel tidak boleh kosong.'); }
        else {
            $result = save_article($data, $id);
            if ($result) {
                if ($old_slug_for_redirect) {
                    $pdo->prepare(
                        'INSERT INTO article_redirects (old_slug, target_slug, target_category_slug, reason)
                         VALUES (?, ?, NULL, ?)
                         ON DUPLICATE KEY UPDATE target_slug=VALUES(target_slug), target_category_slug=NULL, reason=VALUES(reason), created_at=NOW()'
                    )->execute([$old_slug_for_redirect, $slug, 'slug_changed']);
                }
                // Unpublished (published -> draft): old URL should 301 to category index, not 404.
                if ($existing && $existing['status'] === 'published' && $data['status'] === 'draft') {
                    $cat_slug = $ARTICLE_CAT_TO_SLUG[$data['category']] ?? null;
                    $pdo->prepare(
                        'INSERT INTO article_redirects (old_slug, target_slug, target_category_slug, reason)
                         VALUES (?, NULL, ?, ?)
                         ON DUPLICATE KEY UPDATE target_slug=NULL, target_category_slug=VALUES(target_category_slug), reason=VALUES(reason), created_at=NOW()'
                    )->execute([$slug, $cat_slug, 'unpublished']);
                }
                // Re-published: stale unpublish-redirect no longer applies.
                if ($existing && $existing['status'] === 'draft' && $data['status'] === 'published') {
                    $pdo->prepare('DELETE FROM article_redirects WHERE old_slug=? AND reason=?')->execute([$slug, 'unpublished']);
                }
                flash_set('success', $id ? 'Artikel diperbarui.' : 'Artikel ditambahkan.');
            } else {
                flash_set('error', 'Gagal menyimpan. Kemungkinan slug sudah digunakan.');
            }
        }
        redirect(SITE_URL . '/admin/artikel.php');
    }

    if ($action === 'delete') {
        $id = (int)($_POST['id'] ?? 0);
        if ($id) {
            $article = get_article_by_id($id);
            if ($article) {
                $cat_slug = $ARTICLE_CAT_TO_SLUG[$article['category']] ?? null;
                $pdo->prepare(
                    'INSERT INTO article_redirects (old_slug, target_slug, target_category_slug, reason)
                     VALUES (?, NULL, ?, ?)
                     ON DUPLICATE KEY UPDATE target_slug=NULL, target_category_slug=VALUES(target_category_slug), reason=VALUES(reason), created_at=NOW()'
                )->execute([$article['slug'], $cat_slug, 'deleted']);
            }
            $pdo->prepare('DELETE FROM articles WHERE id=?')->execute([$id]);
            flash_set('success', 'Artikel dihapus. URL lama akan otomatis redirect.');
        }
        redirect(SITE_URL . '/admin/artikel.php');
    }

    if ($action === 'toggle_status') {
        $id = (int)($_POST['id'] ?? 0);
        $article = get_article_by_id($id);
        if ($article) {
            $new = $article['status'] === 'published' ? 'draft' : 'published';
            $pub = $new === 'published' ? date('Y-m-d H:i:s') : $article['published_at'];
            $pdo->prepare('UPDATE articles SET status=?, published_at=?, updated_at=NOW() WHERE id=?')->execute([$new, $pub, $id]);

            if ($new === 'draft') {
                $cat_slug = $ARTICLE_CAT_TO_SLUG[$article['category']] ?? null;
                $pdo->prepare(
                    'INSERT INTO article_redirects (old_slug, target_slug, target_category_slug, reason)
                     VALUES (?, NULL, ?, ?)
                     ON DUPLICATE KEY UPDATE target_slug=NULL, target_category_slug=VALUES(target_category_slug), reason=VALUES(reason), created_at=NOW()'
                )->execute([$article['slug'], $cat_slug, 'unpublished']);
            } else {
                $pdo->prepare('DELETE FROM article_redirects WHERE old_slug=? AND reason=?')->execute([$article['slug'], 'unpublished']);
            }

            flash_set('success', $new === 'published' ? 'Artikel dipublikasikan.' : 'Artikel dijadikan draft.');
        }
        redirect(SITE_URL . '/admin/artikel.php');
    }
}

// ── GET: list or edit ───────────────────────────────────────────────────────
$search  = trim($_GET['q'] ?? '');
$status  = trim($_GET['status'] ?? '');
$page    = max(1, (int)($_GET['page'] ?? 1));
$per     = 20; $offset = ($page - 1) * $per;
$total   = count_articles_admin($search, $status);
$articles_list = get_all_articles_admin($per, $offset, $search, $status);
$total_pages = (int)ceil($total / $per);

$edit_id      = (int)($_GET['edit'] ?? 0);
$edit_article = $edit_id ? get_article_by_id($edit_id) : null;
$show_form    = isset($_GET['new']) || $edit_article;
$is_edit      = (bool)$edit_article;
$flash        = flash_get();

$categories   = ['K3', 'Lingkungan', 'Mining', 'ISO', 'QHSE', 'Umum'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Manajemen Artikel — Admin</title>
<meta name="robots" content="noindex,nofollow">
<link rel="stylesheet" href="/admin/assets/admin.css">
<style>
.ak-form-grid{display:grid;grid-template-columns:1fr 1fr;gap:1rem}
.ak-form-full{grid-column:1/-1}
.ak-content-area{width:100%;min-height:300px;font-family:monospace;font-size:13px;
  border:1px solid #e5e7eb;border-radius:8px;padding:12px;resize:vertical}
.ak-faq-row{display:grid;grid-template-columns:1fr 1fr 36px;gap:.5rem;margin-bottom:.5rem;align-items:start}
.ak-faq-row textarea{border:1px solid #e5e7eb;border-radius:6px;padding:8px;font-size:13px;
  resize:vertical;min-height:60px;width:100%;font-family:inherit}
.ak-faq-rm{background:#fee2e2;border:none;color:#dc2626;border-radius:6px;cursor:pointer;
  height:36px;font-size:16px;padding:0 8px}
.ak-char-count{font-size:11px;color:#9ca3af;text-align:right;margin-top:2px}
.ak-char-warn{color:#ef4444}
.status-badge-pub{background:#d1fae5;color:#065f46;padding:2px 8px;border-radius:10px;font-size:11px;font-weight:700}
.status-badge-dft{background:#f3f4f6;color:#6b7280;padding:2px 8px;border-radius:10px;font-size:11px;font-weight:700}
.ak-toggle-btn{background:none;border:1px solid #d1d5db;padding:4px 10px;border-radius:6px;
  cursor:pointer;font-size:12px;font-weight:600;color:#374151;transition:.15s}
.ak-toggle-btn:hover{background:#f3f4f6}
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
  <div class="topbar-title"><?= $show_form ? ($edit_article ? 'Edit Artikel' : 'Tambah Artikel Baru') : 'Manajemen Artikel' ?></div>
  <div class="topbar-actions">
    <?php if ($show_form): ?>
    <a href="/admin/artikel.php" class="topbar-btn">← Kembali ke Daftar</a>
    <?php else: ?>
    <a href="/admin/artikel.php?new=1" class="topbar-btn topbar-btn-primary">+ Artikel Baru</a>
    <a href="/admin/artikel-upload.php" class="topbar-btn" style="background:#2563eb;color:#fff">⬆ Upload CSV (20 artikel)</a>
    <?php endif; ?>
  </div>
</div>
<div class="admin-content">
<?php if ($flash): ?>
<div id="flash-message" class="alert alert-<?= $flash['type'] === 'success' ? 'success' : 'error' ?>">
  <?= e($flash['message']) ?>
</div>
<?php endif; ?>

<?php if ($show_form): ?>
<!-- ════════════════════════ ARTICLE FORM ════════════════════════ -->
<div class="card" style="max-width:900px">
<form method="post">
<?= csrf_field() ?>
<input type="hidden" name="action" value="save">
<input type="hidden" name="id" value="<?= $edit_article['id'] ?? 0 ?>">
<div class="modal-body" style="padding:1.5rem">
<div class="ak-form-grid">

  <!-- Title -->
  <div class="form-group ak-form-full">
    <label class="form-label">Judul Artikel <span>*</span></label>
    <input type="text" name="title" id="fTitle" class="form-input"
           value="<?= e($edit_article['title'] ?? '') ?>" required
           oninput="autoSlug();charCount('fTitle','cTitle',65)">
    <div class="ak-char-count" id="cTitle">0/65 karakter (optimal ≤65)</div>
  </div>

  <!-- Slug -->
  <div class="form-group">
    <label class="form-label">Slug URL</label>
    <?php if ($is_edit): ?>
    <div style="display:flex;gap:8px;align-items:center">
      <input type="text" name="slug" id="fSlug" class="form-input" readonly
             value="<?= e($edit_article['slug'] ?? '') ?>"
             style="background:#f3f4f6;color:#6b7280;cursor:not-allowed">
      <button type="button" class="btn btn-outline btn-xs" style="white-space:nowrap;border-color:#fca5a5;color:#991b1b"
              onclick="openSlugWarning()">🔓 Ubah URL</button>
    </div>
    <input type="hidden" name="confirm_slug_change" id="confirmSlugChange" value="0">
    <small style="color:#6b7280;font-size:11px">wahanatotalita.com/artikel/<strong id="slugPreview"><?= e($edit_article['slug'] ?? '') ?></strong>/ &mdash; <strong style="color:#0A4A2E">Terkunci.</strong> Mengubah URL memutus tautan &amp; peringkat Google yang ada.</small>
    <?php else: ?>
    <input type="text" name="slug" id="fSlug" class="form-input" placeholder="auto-dari-judul"
           value="<?= e($edit_article['slug'] ?? '') ?>">
    <small style="color:#6b7280;font-size:11px">wahanatotalita.com/artikel/<strong id="slugPreview"><?= e($edit_article['slug'] ?? 'auto-dari-judul') ?></strong>/</small>
    <?php endif; ?>
  </div>

  <!-- Category -->
  <div class="form-group">
    <label class="form-label">Kategori</label>
    <select name="category" class="form-select">
      <?php foreach ($categories as $cat): ?>
      <option value="<?= e($cat) ?>" <?= ($edit_article['category'] ?? 'K3') === $cat ? 'selected' : '' ?>><?= e($cat) ?></option>
      <?php endforeach; ?>
    </select>
  </div>

  <!-- Meta Title -->
  <div class="form-group ak-form-full">
    <label class="form-label">Meta Title (untuk Google)</label>
    <input type="text" name="meta_title" id="fMetaTitle" class="form-input"
           value="<?= e($edit_article['meta_title'] ?? '') ?>" placeholder="Kosongkan = auto dari judul"
           oninput="charCount('fMetaTitle','cMetaTitle',65)">
    <div class="ak-char-count" id="cMetaTitle">0/65 karakter</div>
  </div>

  <!-- Meta Desc -->
  <div class="form-group ak-form-full">
    <label class="form-label">Meta Description</label>
    <textarea name="meta_desc" id="fMetaDesc" class="form-textarea" rows="2"
              placeholder="Deskripsi singkat untuk Google (120-155 karakter)"
              oninput="charCount('fMetaDesc','cMetaDesc',155)"><?= e($edit_article['meta_desc'] ?? '') ?></textarea>
    <div class="ak-char-count" id="cMetaDesc">0/155 karakter</div>
  </div>

  <!-- Keywords -->
  <div class="form-group ak-form-full">
    <label class="form-label">Keywords (pisahkan dengan koma)</label>
    <input type="text" name="keywords" class="form-input"
           value="<?= e($edit_article['keywords'] ?? '') ?>" placeholder="k3 umum, sertifikasi bnsp, pelatihan k3 yogyakarta">
  </div>

  <!-- Thumbnail -->
  <div class="form-group ak-form-full">
    <label class="form-label">URL Thumbnail (opsional)</label>
    <input type="url" name="thumbnail" class="form-input"
           value="<?= e($edit_article['thumbnail'] ?? '') ?>" placeholder="https://...">
  </div>

  <!-- Author -->
  <div class="form-group">
    <label class="form-label">Penulis</label>
    <input type="text" name="author" class="form-input"
           value="<?= e($edit_article['author'] ?? 'Wahana Totalita Konsultan') ?>">
  </div>

  <!-- Status -->
  <div class="form-group">
    <label class="form-label">Status</label>
    <select name="status" id="fStatus" class="form-select" onchange="togglePubDate()">
      <option value="draft" <?= ($edit_article['status'] ?? '') !== 'published' ? 'selected' : '' ?>>Draft</option>
      <option value="published" <?= ($edit_article['status'] ?? '') === 'published' ? 'selected' : '' ?>>Dipublikasikan</option>
    </select>
    <?php if ($is_edit && $edit_article['status'] === 'published'): ?>
    <small style="color:#92400e;font-size:11px">Mengubah ke Draft akan otomatis redirect URL ini ke halaman kategori (bukan 404).</small>
    <?php endif; ?>
  </div>

  <!-- Published At -->
  <div class="form-group" id="pubDateRow" style="<?= ($edit_article['status'] ?? '') !== 'published' ? 'display:none' : '' ?>">
    <label class="form-label">Tanggal Publikasi</label>
    <input type="datetime-local" name="published_at" class="form-input"
           value="<?= e(str_replace(' ', 'T', substr($edit_article['published_at'] ?? '', 0, 16))) ?>">
  </div>

  <!-- Content -->
  <div class="form-group ak-form-full">
    <label class="form-label">Konten Artikel (HTML) <span>*</span></label>
    <textarea name="content" class="ak-content-area" required><?= e($edit_article['content'] ?? '') ?></textarea>
    <small style="color:#6b7280;font-size:11px">Tulis dalam HTML. Gunakan &lt;h2&gt;, &lt;h3&gt;, &lt;p&gt;, &lt;ul&gt;, &lt;strong&gt;, &lt;a href=""&gt; dll. Minimal 800 kata untuk SEO optimal.</small>
  </div>

  <!-- FAQ Section -->
  <div class="form-group ak-form-full">
    <label class="form-label">FAQ / Pertanyaan Umum (max 5)</label>
    <div id="faqContainer">
      <?php
      $existing_faqs = [];
      if (!empty($edit_article['faq_data'])) {
        $existing_faqs = json_decode($edit_article['faq_data'], true) ?? [];
      }
      // Always show at least 3 FAQ rows
      $existing_faqs = array_pad($existing_faqs, 3, ['q' => '', 'a' => '']);
      foreach ($existing_faqs as $i => $faq):
      ?>
      <div class="ak-faq-row">
        <textarea name="faq_q[]" placeholder="Pertanyaan <?= $i+1 ?>" rows="2"><?= e($faq['q'] ?? '') ?></textarea>
        <textarea name="faq_a[]" placeholder="Jawaban <?= $i+1 ?>" rows="2"><?= e($faq['a'] ?? '') ?></textarea>
        <button type="button" class="ak-faq-rm" onclick="this.closest('.ak-faq-row').remove()">✕</button>
      </div>
      <?php endforeach; ?>
    </div>
    <button type="button" onclick="addFaq()" class="btn btn-outline btn-xs" style="margin-top:.5rem">+ Tambah FAQ</button>
  </div>

</div><!-- end form-grid -->
</div><!-- end modal-body -->
<div class="modal-footer" style="padding:1rem 1.5rem;border-top:1px solid #e5e7eb;display:flex;gap:.75rem;justify-content:flex-end">
  <a href="/admin/artikel.php" class="btn btn-outline">Batal</a>
  <button type="submit" name="status_submit" value="draft" onclick="document.querySelector('[name=status]').value='draft'" class="btn btn-outline">Simpan Draft</button>
  <button type="submit" class="btn btn-primary">💾 Simpan</button>
</div>
</form>
</div>

<?php if ($is_edit): ?>
<!-- Slug change warning modal (same pattern as admin/training-save.php) -->
<div id="slugWarningOverlay" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:2000;align-items:center;justify-content:center">
  <div style="background:#fff;border-radius:12px;max-width:480px;width:92%;padding:0;overflow:hidden;box-shadow:0 20px 60px rgba(0,0,0,.3)">
    <div style="background:#FEF2F2;border-bottom:2px solid #FECACA;padding:18px 24px;display:flex;align-items:center;gap:10px">
      <span style="font-size:1.5rem">⚠️</span>
      <h5 style="margin:0;color:#991B1B;font-weight:800;font-size:16px">Peringatan: Mengubah URL</h5>
    </div>
    <div style="padding:22px 24px">
      <p style="font-size:14px;color:#374151;line-height:1.6;margin:0 0 12px">
        URL artikel ini mungkin sudah <strong>terindeks di Google</strong>. Mengubahnya akan:
      </p>
      <ul style="font-size:13.5px;color:#4b5563;line-height:1.8;margin:0 0 16px;padding-left:20px">
        <li>Memutus semua tautan lama yang mengarah ke artikel ini</li>
        <li>Mereset riwayat peringkat pencarian (SEO) untuk URL baru</li>
        <li>Membuat link yang sudah dibagikan tidak berfungsi kecuali di-update manual</li>
      </ul>
      <p style="font-size:13px;color:#6b7280;margin:0 0 16px">Sistem akan otomatis membuat redirect 301 dari URL lama ke URL baru, tapi tetap disarankan hanya mengubah URL bila benar-benar diperlukan.</p>
      <div class="form-check" style="margin-bottom:18px">
        <input type="checkbox" id="slugRiskAck" onchange="document.getElementById('slugUnlockBtn').disabled = !this.checked">
        <label for="slugRiskAck" style="font-size:13.5px;font-weight:600;color:#991B1B">Saya paham risikonya dan ingin tetap mengubah URL</label>
      </div>
      <div style="display:flex;gap:10px;justify-content:flex-end">
        <button type="button" onclick="closeSlugWarning()" style="padding:9px 18px;background:#f3f4f6;color:#374151;border:none;border-radius:8px;font-weight:600;font-size:13.5px;cursor:pointer">Batal</button>
        <button type="button" id="slugUnlockBtn" disabled onclick="confirmSlugUnlock()" style="padding:9px 18px;background:#991B1B;color:#fff;border:none;border-radius:8px;font-weight:600;font-size:13.5px;cursor:pointer;opacity:.5">Ya, Ubah URL</button>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>

<?php else: ?>
<!-- ════════════════════════ ARTICLE LIST ════════════════════════ -->
<div class="card">
  <div class="filter-bar">
    <div class="filter-search">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      <form method="get" style="flex:1">
        <input type="text" name="q" placeholder="Cari judul atau slug..." value="<?= e($search) ?>"
               style="border:none;outline:none;width:100%;font-size:13px;background:none;padding:8px 0">
        <input type="hidden" name="status" value="<?= e($status) ?>">
      </form>
    </div>
    <div class="filter-bar-end" style="display:flex;gap:.5rem;align-items:center">
      <a href="?status=" class="btn btn-xs <?= !$status ? 'btn-primary' : 'btn-outline' ?>">Semua (<?= count_articles_admin() ?>)</a>
      <a href="?status=published" class="btn btn-xs <?= $status === 'published' ? 'btn-primary' : 'btn-outline' ?>">Terbit (<?= count_articles_admin('', 'published') ?>)</a>
      <a href="?status=draft" class="btn btn-xs <?= $status === 'draft' ? 'btn-primary' : 'btn-outline' ?>">Draft (<?= count_articles_admin('', 'draft') ?>)</a>
    </div>
  </div>

  <div class="table-wrap">
    <table class="admin-table">
      <thead><tr>
        <th>Judul</th><th>Kategori</th><th>Status</th><th>Tanggal</th><th>Views</th><th>Aksi</th>
      </tr></thead>
      <tbody>
      <?php if (empty($articles_list)): ?>
      <tr><td colspan="6">
        <div class="empty-state">
          <div class="empty-state-icon">📝</div>
          <h3>Belum ada artikel</h3>
          <p><a href="/admin/artikel.php?new=1">+ Tambah artikel pertama</a> atau <a href="/admin/artikel-upload.php">upload CSV batch</a></p>
        </div>
      </td></tr>
      <?php else: foreach ($articles_list as $a): ?>
      <tr>
        <td>
          <strong style="font-size:13px"><?= e($a['title']) ?></strong>
          <div style="font-size:11px;color:#9ca3af;margin-top:2px">/artikel/<?= e($a['slug']) ?>/</div>
        </td>
        <td><span class="badge badge-active"><?= e($a['category']) ?></span></td>
        <td>
          <span class="status-badge-<?= $a['status'] === 'published' ? 'pub' : 'dft' ?>">
            <?= $a['status'] === 'published' ? '● Terbit' : '○ Draft' ?>
          </span>
        </td>
        <td style="font-size:12px;color:#6b7280"><?= $a['published_at'] ? date('d/m/Y', strtotime($a['published_at'])) : date('d/m/Y', strtotime($a['created_at'])) ?></td>
        <td style="font-size:12px"><?= number_format($a['view_count']) ?></td>
        <td>
          <div style="display:flex;gap:5px;flex-wrap:wrap">
            <?php if ($a['status'] === 'published'): ?>
            <a href="<?= SITE_URL ?>/artikel/<?= e($a['slug']) ?>/" target="_blank" class="btn btn-xs btn-outline">👁 Lihat</a>
            <?php endif; ?>
            <a href="?edit=<?= $a['id'] ?>" class="btn btn-xs btn-outline">✏ Edit</a>
            <form method="post" style="display:inline">
              <?= csrf_field() ?>
              <input type="hidden" name="action" value="toggle_status">
              <input type="hidden" name="id" value="<?= $a['id'] ?>">
              <button type="submit" class="ak-toggle-btn">
                <?= $a['status'] === 'published' ? '⬇ Draft' : '⬆ Terbitkan' ?>
              </button>
            </form>
            <form method="post" style="display:inline" onsubmit="return confirm('Hapus artikel ini? URL lama akan otomatis redirect.')">
              <?= csrf_field() ?>
              <input type="hidden" name="action" value="delete">
              <input type="hidden" name="id" value="<?= $a['id'] ?>">
              <button type="submit" class="btn btn-xs btn-danger">Hapus</button>
            </form>
          </div>
        </td>
      </tr>
      <?php endforeach; endif; ?>
      </tbody>
    </table>
  </div>

  <?php if ($total_pages > 1): ?>
  <div class="pagination">
    <div class="page-info">Menampilkan <?= $offset+1 ?>–<?= min($offset+$per, $total) ?> dari <?= $total ?></div>
    <?php for ($p = 1; $p <= $total_pages; $p++): ?>
    <a href="?q=<?= urlencode($search) ?>&status=<?= urlencode($status) ?>&page=<?= $p ?>" class="page-btn <?= $p === $page ? 'active' : '' ?>"><?= $p ?></a>
    <?php endfor; ?>
  </div>
  <?php endif; ?>
</div>
<?php endif; ?>

</div><!-- admin-content -->
</main>
</div>

<script src="/admin/assets/admin.js"></script>
<script>
const isEditMode = <?= $is_edit ? 'true' : 'false' ?>;

function autoSlug(){
  // Locked once an article exists — a title edit must NEVER touch the slug.
  if (isEditMode) return;
  var t = document.getElementById('fTitle').value;
  var s = t.toLowerCase().replace(/[^a-z0-9\s\-]/gi,'').replace(/[\s]+/g,'-').replace(/-+/g,'-').replace(/^-|-$/g,'');
  document.querySelector('[name=slug]').value = s;
  document.getElementById('slugPreview').textContent = s || 'auto-dari-judul';
}
function charCount(fieldId, counterId, max){
  var len = document.getElementById(fieldId).value.length;
  var el  = document.getElementById(counterId);
  el.textContent = len + '/' + max + ' karakter';
  el.className = 'ak-char-count' + (len > max ? ' ak-char-warn' : '');
}
function togglePubDate(){
  var sel = document.getElementById('fStatus');
  document.getElementById('pubDateRow').style.display = sel.value === 'published' ? '' : 'none';
}
function addFaq(){
  var c = document.getElementById('faqContainer');
  var n = c.querySelectorAll('.ak-faq-row').length + 1;
  if(n > 5){ alert('Maksimal 5 FAQ'); return; }
  var d = document.createElement('div'); d.className='ak-faq-row';
  d.innerHTML = '<textarea name="faq_q[]" placeholder="Pertanyaan '+n+'" rows="2"></textarea>'
              + '<textarea name="faq_a[]" placeholder="Jawaban '+n+'" rows="2"></textarea>'
              + '<button type="button" class="ak-faq-rm" onclick="this.closest(\'.ak-faq-row\').remove()">✕</button>';
  c.appendChild(d);
}
// Init char counts
['fTitle','fMetaTitle','fMetaDesc'].forEach(function(id){
  var el = document.getElementById(id); if(!el) return;
  var max = id==='fMetaDesc'?155:65;
  var cid = id.replace('f','c');
  el.dispatchEvent(new Event('input'));
});
// Update slug preview on load
var sl = document.querySelector('[name=slug]');
if(sl && sl.value) document.getElementById('slugPreview').textContent = sl.value;
if(sl && !isEditMode){ sl.addEventListener('input', function(){ document.getElementById('slugPreview').textContent = this.value || 'auto-dari-judul'; }); }
if(sl && isEditMode){ sl.addEventListener('input', function(){ document.getElementById('slugPreview').textContent = this.value || ''; }); }

// ── Slug warning modal ──
function openSlugWarning(){
  var ack = document.getElementById('slugRiskAck');
  var btn = document.getElementById('slugUnlockBtn');
  if (ack) ack.checked = false;
  if (btn) { btn.disabled = true; btn.style.opacity = '.5'; }
  document.getElementById('slugWarningOverlay').style.display = 'flex';
}
function closeSlugWarning(){
  document.getElementById('slugWarningOverlay').style.display = 'none';
}
function confirmSlugUnlock(){
  var slugEl = document.getElementById('fSlug');
  slugEl.readOnly = false;
  slugEl.style.background = '#fff';
  slugEl.style.color = '#111';
  slugEl.style.cursor = 'text';
  document.getElementById('confirmSlugChange').value = '1';
  closeSlugWarning();
  slugEl.focus();
}
</script>
</body>
</html>
