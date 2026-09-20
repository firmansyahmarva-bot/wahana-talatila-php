<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/forum-functions.php';

$s    = get_all_settings();
$cats = get_forum_categories();
$errors = [];
$success = false;

// Public topic submission — moderated (is_approved=0 until admin approves)
define('FORUM_SUBMISSIONS_OPEN', true);

if (FORUM_SUBMISSIONS_OPEN && $_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf()) { $errors[] = 'Sesi tidak valid.'; }
    else {
        $data = [
            'category_id'  => (int)($_POST['category_id']  ?? 0),
            'author_name'  => sanitize($_POST['author_name']  ?? ''),
            'author_email' => sanitize($_POST['author_email'] ?? ''),
            'title'        => sanitize($_POST['title']        ?? ''),
            'content'      => sanitize($_POST['content']      ?? ''),
        ];
        if (!$data['category_id']) $errors[] = 'Pilih kategori.';
        if (!$data['author_name']) $errors[] = 'Nama wajib diisi.';
        if (!$data['author_email'] || !filter_var($data['author_email'], FILTER_VALIDATE_EMAIL)) $errors[] = 'Email valid wajib diisi.';
        if (strlen($data['title']) < 10) $errors[] = 'Judul minimal 10 karakter.';
        if (strlen($data['content']) < 30) $errors[] = 'Isi topik minimal 30 karakter.';

        if (empty($errors)) {
            $id = save_forum_topic($data);
            if ($id) { $success = true; }
            else { $errors[] = 'Gagal menyimpan topik.'; }
        }
    }
}
?>
<?php
$page_title = 'Buat Topik Forum K3';
$meta_desc = 'Buat topik diskusi baru di Forum K3 Wahana Totalita. Tanya jawab seputar keselamatan dan kesehatan kerja.';
require __DIR__ . '/../includes/head.php';
<?= theme_css_vars($s) ?>
<style>
.form-page{max-width:680px;margin:60px auto;padding:0 20px}
.form-card{background:#fff;border-radius:16px;border:1px solid #eee;box-shadow:0 4px 20px rgba(0,0,0,.08);overflow:hidden}
.form-header{background:linear-gradient(135deg,var(--green),#1a5c3a);padding:28px 32px;color:#fff}
.form-header h1{font-size:1.3rem;font-weight:800;margin:0}
.form-body{padding:32px}
.form-group{margin-bottom:20px}
.form-group label{display:block;font-weight:600;margin-bottom:6px;font-size:.9rem}
.form-group input,.form-group select,.form-group textarea{width:100%;box-sizing:border-box;padding:12px 16px;border:1px solid #ddd;border-radius:8px;font-size:.95rem;font-family:inherit}
.form-group textarea{min-height:160px;resize:vertical}
.form-group input:focus,.form-group select:focus,.form-group textarea:focus{outline:none;border-color:var(--green);box-shadow:0 0 0 3px rgba(10,74,46,.1)}
.btn-submit{background:var(--orange);color:#fff;border:none;padding:14px 32px;border-radius:12px;font-size:1rem;font-weight:700;cursor:pointer}
.flash{padding:12px 16px;border-radius:8px;margin-bottom:16px}
.flash.success{background:#dcfce7;color:#166534}
.flash.error{background:#fee2e2;color:#991b1b}
.closed-notice{text-align:center;padding:20px 0}
.closed-notice .icon{font-size:2.5rem;margin-bottom:12px}
.closed-notice h2{font-size:1.1rem;margin:0 0 8px;color:#333}
.closed-notice p{color:#666;font-size:.9rem;line-height:1.6;max-width:440px;margin:0 auto 20px}
.closed-notice a{display:inline-block;background:var(--orange);color:#fff;padding:12px 28px;border-radius:10px;font-weight:700;text-decoration:none}
</style>
<?php include __DIR__ . '/../includes/navbar.php'; ?>

<div class="form-page">
  <div style="font-size:.85rem;color:#999;margin-bottom:16px">
    <a href="/forum/" style="color:var(--green)">Forum</a> › Buat Topik Baru
  </div>
  <div class="form-card">
    <div class="form-header"><h1>Buat Topik Diskusi Baru</h1></div>
    <div class="form-body">

      <?php if (!FORUM_SUBMISSIONS_OPEN): ?>
      <div class="closed-notice">
        <div class="icon">🛠️</div>
        <h2>Forum Sedang Dalam Persiapan</h2>
        <p>Pembuatan topik baru untuk sementara ditutup. Punya pertanyaan seputar K3? Hubungi tim kami langsung via WhatsApp — respons cepat, tanpa menunggu moderasi.</p>
        <a href="<?= wa_url('Halo, saya ingin bertanya tentang K3') ?>">💬 Tanya via WhatsApp</a>
      </div>
      <?php elseif ($success): ?>
      <div class="flash success">
        <strong>✅ Topik berhasil dikirim!</strong><br>
        Topik Anda sedang dalam proses moderasi dan akan ditampilkan dalam 1x24 jam.<br><br>
        <a href="/forum/" style="color:var(--green);font-weight:600">← Kembali ke Forum</a>
      </div>
      <?php else: ?>
      <?php if (!empty($errors)): ?>
      <div class="flash error"><?= implode('<br>', array_map('e', $errors)) ?></div>
      <?php endif; ?>
      <form method="POST">
        <?= csrf_field() ?>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
          <div class="form-group">
            <label>Nama Anda *</label>
            <input type="text" name="author_name" value="<?= e($_POST['author_name'] ?? '') ?>" required>
          </div>
          <div class="form-group">
            <label>Email *</label>
            <input type="email" name="author_email" value="<?= e($_POST['author_email'] ?? '') ?>" required>
          </div>
        </div>
        <div class="form-group">
          <label>Kategori *</label>
          <select name="category_id" required>
            <option value="">— Pilih kategori —</option>
            <?php foreach ($cats as $c): ?>
            <option value="<?= $c['id'] ?>" <?= (int)($_POST['category_id']??0)===$c['id']?'selected':'' ?>><?= e($c['icon'].' '.$c['name']) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label>Judul Topik * <span style="font-weight:400;color:#999">(min 10 karakter)</span></label>
          <input type="text" name="title" value="<?= e($_POST['title'] ?? '') ?>" placeholder="Contoh: Cara membuat JSA yang benar untuk pekerjaan di ketinggian?" required>
        </div>
        <div class="form-group">
          <label>Isi Diskusi * <span style="font-weight:400;color:#999">(min 30 karakter)</span></label>
          <textarea name="content" placeholder="Jelaskan pertanyaan atau topik diskusi Anda secara detail..." required><?= e($_POST['content'] ?? '') ?></textarea>
        </div>
        <div style="display:flex;gap:12px;align-items:center">
          <button type="submit" class="btn-submit">📤 Kirim Topik</button>
          <a href="/forum/" style="color:#999;font-size:.875rem">Batal</a>
        </div>
        <p style="font-size:.75rem;color:#999;margin-top:12px">Topik akan ditampilkan setelah moderasi admin. Email tidak dipublikasikan.</p>
      </form>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
<script src="<?= SITE_URL ?>/assets/js/main.js"></script>
</body></html>
