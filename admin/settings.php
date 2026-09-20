<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/partials/auth.php';
require_auth('settings');
require_admin();

$pdo   = get_pdo();
$flash = flash_get();

// ─── SAVE ────────────────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_verify($_POST['csrf_token'] ?? '')) {
        flash_set('error','Token tidak valid.'); redirect(SITE_URL.'/admin/settings.php');
    }

    // Update password if provided
    $new_pw  = trim($_POST['new_password']      ?? '');
    $confirm = trim($_POST['confirm_password']  ?? '');
    if ($new_pw) {
        if (strlen($new_pw) < 8) { flash_set('error','Password minimal 8 karakter.'); redirect(SITE_URL.'/admin/settings.php'); }
        if ($new_pw !== $confirm)  { flash_set('error','Konfirmasi password tidak cocok.'); redirect(SITE_URL.'/admin/settings.php'); }
        $hash = password_hash($new_pw, PASSWORD_BCRYPT, ['cost'=>12]);
        $pdo->prepare('UPDATE admin_users SET password_hash=? WHERE id=?')
            ->execute([$hash, $_SESSION['admin_id']]);
    }

    // Handle logo upload
    if (!empty($_FILES['logo']['tmp_name'])) {
        $allowed = ['image/jpeg','image/png','image/webp','image/svg+xml'];
        $ftype   = mime_content_type($_FILES['logo']['tmp_name']);
        $fsize   = $_FILES['logo']['size'];
        $ext_map = ['image/jpeg'=>'jpg','image/png'=>'png','image/webp'=>'webp','image/svg+xml'=>'svg'];
        if (!in_array($ftype, $allowed)) {
            flash_set('error','Format logo tidak didukung. Gunakan JPG, PNG, WebP, atau SVG.'); redirect(SITE_URL.'/admin/settings.php');
        }
        if ($fsize > 2 * 1024 * 1024) {
            flash_set('error','Ukuran logo maksimal 2MB.'); redirect(SITE_URL.'/admin/settings.php');
        }
        $ext      = $ext_map[$ftype];
        $dest_dir = $_SERVER['DOCUMENT_ROOT'] . '/assets/uploads/';
        $filename = 'logo.' . $ext;
        $dest     = $dest_dir . $filename;
        // Remove old logo files
        foreach (['logo.jpg','logo.png','logo.webp','logo.svg'] as $old) {
            if ($old !== $filename && file_exists($dest_dir . $old)) @unlink($dest_dir . $old);
        }
        if (!move_uploaded_file($_FILES['logo']['tmp_name'], $dest)) {
            flash_set('error','Gagal menyimpan logo. Pastikan folder assets/uploads/ dapat ditulis.'); redirect(SITE_URL.'/admin/settings.php');
        }
        $logo_path = '/assets/uploads/' . $filename;
        $pdo->prepare("UPDATE site_settings SET setting_value=? WHERE setting_key='logo_path'")->execute([$logo_path]);
    }

    // Handle logo removal
    if (!empty($_POST['remove_logo'])) {
        foreach (['logo.jpg','logo.png','logo.webp','logo.svg'] as $old) {
            $f = $_SERVER['DOCUMENT_ROOT'] . '/assets/uploads/' . $old;
            if (file_exists($f)) @unlink($f);
        }
        $pdo->prepare("UPDATE site_settings SET setting_value='' WHERE setting_key='logo_path'")->execute([]);
        unset($_POST['logo_path']);
    }

    // Update all settings
    $skip = ['csrf_token','new_password','confirm_password','remove_logo'];
    $upd  = $pdo->prepare('UPDATE site_settings SET setting_value=? WHERE setting_key=?');
    foreach ($_POST as $key => $val) {
        if (in_array($key, $skip)) continue;
        $key = preg_replace('/[^a-z0-9_]/', '', $key);
        if (!$key) continue;
        $upd->execute([trim($val), $key]);
    }
    flash_set('success','Pengaturan berhasil disimpan.');
    redirect(SITE_URL.'/admin/settings.php');
}

// Load all settings grouped
$rows = $pdo->query(
  'SELECT setting_key, setting_value, setting_group, label, input_type, sort_order
   FROM site_settings ORDER BY setting_group, sort_order'
)->fetchAll();

$grouped = [];
foreach ($rows as $r) { $grouped[$r['setting_group']][$r['setting_key']] = $r; }

$group_labels = [
  'general'  => ['label'=>'Informasi Umum',        'icon'=>'🏢'],
  'seo'      => ['label'=>'SEO & Analytics',        'icon'=>'📈'],
  'social'   => ['label'=>'Media Sosial',            'icon'=>'📱'],
  'homepage' => ['label'=>'Konten Hero & Statistik', 'icon'=>'🎨'],
  'about'    => ['label'=>'Tentang Perusahaan',      'icon'=>'ℹ️'],
  'api'      => ['label'=>'API & Integrasi',         'icon'=>'🔑'],
  'smtp'     => ['label'=>'Email (SMTP)',             'icon'=>'📧'],
  'whatsapp' => ['label'=>'WhatsApp (EVO/WA API)',   'icon'=>'💬'],
];

// Load theme settings for the custom Theme panel
$theme_settings = $grouped['theme'] ?? [];
$curr_prim   = $theme_settings['theme_color_primary']['setting_value'] ?? '#0A4A2E';
$curr_accent = $theme_settings['theme_color_accent']['setting_value']  ?? '#C6621C';
$curr_font   = $theme_settings['theme_font']['setting_value']           ?? 'Plus Jakarta Sans';
$curr_logo   = $theme_settings['logo_path']['setting_value']            ?? '';
$curr_ltext  = $theme_settings['logo_text']['setting_value']            ?? 'WT';
$font_opts   = array_keys(THEME_FONTS);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pengaturan Website — Admin</title>
<meta name="robots" content="noindex,nofollow">
<link rel="stylesheet" href="/admin/assets/admin.css">
<style>
body{background:#f5f6fa}
.form-label{font-size:13px;font-weight:600;color:#374151;margin-bottom:5px;display:block}
.form-text{font-size:11px;color:#888;margin-top:4px}
.form-input{width:100%;padding:10px 13px;border:1.5px solid #e5e7eb;border-radius:8px;font-size:14px;outline:none;background:#fafafa;font-family:inherit;transition:border-color .2s}
.form-input:focus{border-color:#0A4A2E;background:#fff}
textarea.form-input{resize:vertical;min-height:80px}
.field-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px}
@media(max-width:640px){.field-grid{grid-template-columns:1fr}}
.field-full{grid-column:1/-1}
.color-row{display:flex;gap:20px;flex-wrap:wrap;align-items:flex-start}
.color-field{display:flex;flex-direction:column;gap:6px}
.color-field label{font-size:13px;font-weight:600;color:#374151}
.color-wrap{display:flex;align-items:center;gap:10px}
.color-wrap input[type=color]{width:48px;height:38px;border:1.5px solid #e5e7eb;border-radius:8px;padding:2px;cursor:pointer;background:#fafafa}
.color-wrap input[type=text]{width:96px;padding:9px 12px;border:1.5px solid #e5e7eb;border-radius:8px;font-size:13px;font-family:monospace;outline:none;background:#fafafa}
.color-wrap input[type=text]:focus{border-color:#0A4A2E}
.font-select{width:100%;padding:10px 13px;border:1.5px solid #e5e7eb;border-radius:8px;font-size:14px;outline:none;background:#fafafa;font-family:inherit;cursor:pointer}
.font-select:focus{border-color:#0A4A2E}
.logo-section{display:grid;grid-template-columns:1fr 1fr;gap:20px;align-items:start}
@media(max-width:600px){.logo-section{grid-template-columns:1fr}}
.logo-preview-box{
  background:#f9fafb;border:1.5px dashed #d1d5db;border-radius:10px;
  min-height:80px;display:flex;align-items:center;justify-content:center;
  overflow:hidden;padding:12px;
}
.logo-preview-box img{max-height:60px;max-width:100%;object-fit:contain}
.logo-preview-box .logo-placeholder{font-size:11px;color:#9ca3af;text-align:center}
.file-input-wrap{position:relative}
.file-input-wrap input[type=file]{width:100%;padding:8px;border:1.5px solid #e5e7eb;border-radius:8px;font-size:13px;background:#fafafa;cursor:pointer}
.btn-remove{
  display:inline-flex;align-items:center;gap:6px;
  background:none;border:1.5px solid #fca5a5;color:#dc2626;
  padding:7px 14px;border-radius:7px;font-size:12.5px;font-weight:600;
  cursor:pointer;margin-top:8px;font-family:inherit;
}
.btn-remove:hover{background:#fef2f2}
.font-preview{margin-top:8px;padding:10px 14px;background:#f3f4f6;border-radius:8px;font-size:15px;color:#374151}
.palette-preview{display:flex;gap:8px;margin-top:10px;flex-wrap:wrap}
.swatch{width:36px;height:36px;border-radius:8px;border:1px solid rgba(0,0,0,.08);position:relative}
.swatch span{position:absolute;bottom:-18px;left:50%;transform:translateX(-50%);font-size:9px;color:#6b7280;white-space:nowrap}
</style>
<link rel="stylesheet" href="/admin/assets/admin.css"></head>
<body>
<div class="admin-wrap">
  <?php include __DIR__ . '/partials/sidebar.php'; ?>
  <div class="main-area">
    <div class="topbar">
      <div class="topbar-title">Pengaturan Website</div>
      <a href="/admin/" style="font-size:13px;color:#888">← Dashboard</a>
    </div>
    <div class="content">

      <?php if ($flash): ?>
      <div style="padding:12px 16px;border-radius:8px;margin-bottom:16px;font-size:14px;
           background:<?= $flash['type']==='success' ? '#E8F4EE' : '#FEF2F2' ?>;
           color:<?= $flash['type']==='success' ? '#0A4A2E' : '#991B1B' ?>">
        <?= e($flash['message']) ?>
      </div>
      <?php endif; ?>

      <form method="post" enctype="multipart/form-data" novalidate>
        <?= csrf_field() ?>

        <?php foreach ($group_labels as $group_key => $ginfo): ?>
        <?php $settings = $grouped[$group_key] ?? []; if (empty($settings)) continue; ?>
        <div class="card-section">
          <h6><?= $ginfo['icon'] ?> <?= $ginfo['label'] ?></h6>
          <div class="field-grid">
            <?php foreach ($settings as $key => $row):
              $label = $row['label'] ?: ucwords(str_replace('_',' ', $key));
              $val   = $row['setting_value'] ?? '';
              $type  = $row['input_type'] ?? 'text';
              $is_textarea = ($type === 'textarea' || strlen($val) > 100);
              $is_full = $is_textarea || in_array($key, ['meta_description','about_description','hero_subtitle']);
            ?>
            <div <?= $is_full ? 'class="field-full"' : '' ?>>
              <label class="form-label" for="field-<?= e($key) ?>"><?= e($label) ?></label>
              <?php if ($is_textarea): ?>
              <textarea class="form-input" id="field-<?= e($key) ?>" name="<?= e($key) ?>" rows="3"><?= e($val) ?></textarea>
              <?php else: ?>
              <input class="form-input" type="<?= in_array($type,['url','email','tel','number']) ? $type : 'text' ?>"
                     id="field-<?= e($key) ?>" name="<?= e($key) ?>" value="<?= e($val) ?>">
              <?php endif; ?>
              <?php if ($key==='gtm_id'): ?><div class="form-text">Contoh: GTM-XXXXXXX</div><?php endif; ?>
              <?php if ($key==='ga_measurement_id'): ?><div class="form-text">Contoh: G-XXXXXXXXXX</div><?php endif; ?>
              <?php if ($key==='wa_number'): ?><div class="form-text">Tanpa tanda + dan tanpa strip. Contoh: 6287759151278</div><?php endif; ?>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endforeach; ?>


        <!-- ═══ THEME & APPEARANCE PANEL ═══ -->
        <div class="card-section" id="theme-panel">
          <h6>🎨 Tema & Tampilan</h6>

          <!-- Colors -->
          <div style="margin-bottom:20px">
            <div style="font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:#6b7280;margin-bottom:12px">Skema Warna</div>
            <div class="color-row">
              <div class="color-field">
                <label for="cp-prim">Warna Utama (Hijau)</label>
                <div class="color-wrap">
                  <input type="color" id="cp-prim" value="<?= e($curr_prim) ?>"
                         oninput="syncColor(this,'tf-prim','sw-prim')">
                  <input type="text" id="tf-prim" name="theme_color_primary"
                         value="<?= e($curr_prim) ?>" maxlength="7"
                         oninput="syncText(this,'cp-prim','sw-prim')">
                </div>
                <div class="palette-preview">
                  <div class="swatch" id="sw-prim" style="background:<?= e($curr_prim) ?>"><span>Utama</span></div>
                  <div class="swatch" id="sw-prim-dark"  style="background:<?= e(hex_darken($curr_prim,30)) ?>"><span>Gelap</span></div>
                  <div class="swatch" id="sw-prim-light" style="background:<?= e(hex_lighten($curr_prim,185)) ?>"><span>Terang</span></div>
                </div>
              </div>
              <div class="color-field">
                <label for="cp-acc">Warna Aksen (Oranye)</label>
                <div class="color-wrap">
                  <input type="color" id="cp-acc" value="<?= e($curr_accent) ?>"
                         oninput="syncColor(this,'tf-acc','sw-acc')">
                  <input type="text" id="tf-acc" name="theme_color_accent"
                         value="<?= e($curr_accent) ?>" maxlength="7"
                         oninput="syncText(this,'cp-acc','sw-acc')">
                </div>
                <div class="palette-preview">
                  <div class="swatch" id="sw-acc" style="background:<?= e($curr_accent) ?>"><span>Aksen</span></div>
                  <div class="swatch" id="sw-acc-dark" style="background:<?= e(hex_darken($curr_accent,25)) ?>"><span>Gelap</span></div>
                  <div class="swatch" id="sw-acc-light" style="background:<?= e(hex_lighten($curr_accent,180)) ?>"><span>Terang</span></div>
                </div>
              </div>
            </div>
          </div>

          <!-- Font -->
          <div style="margin-bottom:20px">
            <div style="font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:#6b7280;margin-bottom:12px">Font Website</div>
            <div style="max-width:320px">
              <select class="font-select" name="theme_font" id="font-select"
                      onchange="previewFont(this.value)">
                <?php foreach ($font_opts as $fo): ?>
                <option value="<?= e($fo) ?>" <?= $fo === $curr_font ? 'selected' : '' ?>><?= e($fo) ?></option>
                <?php endforeach; ?>
              </select>
              <div class="font-preview" id="font-preview" style="font-family:'<?= e($curr_font) ?>',system-ui">
                Pelatihan K3 &amp; Sertifikasi BNSP — Wahana Totalita
              </div>
            </div>
          </div>

          <!-- Logo -->
          <div>
            <div style="font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:#6b7280;margin-bottom:12px">Logo &amp; Identitas</div>
            <div class="logo-section">
              <div>
                <label class="form-label">Upload Logo</label>
                <div class="file-input-wrap">
                  <input type="file" name="logo" id="logo-input" accept="image/png,image/jpeg,image/webp,image/svg+xml"
                         onchange="previewLogo(this)">
                </div>
                <div class="form-text">JPG, PNG, WebP, atau SVG. Maks 2MB. Disarankan PNG transparan 200×60px.</div>
                <?php if ($curr_logo): ?>
                <button type="submit" name="remove_logo" value="1" class="btn-remove"
                        onclick="return confirm('Hapus logo saat ini?')">
                  🗑 Hapus Logo
                </button>
                <?php endif; ?>
              </div>
              <div>
                <label class="form-label">Preview Logo</label>
                <div class="logo-preview-box" id="logo-preview-box">
                  <?php if ($curr_logo): ?>
                  <img src="<?= e($curr_logo) ?>?t=<?= time() ?>" alt="Logo saat ini" id="logo-preview-img">
                  <?php else: ?>
                  <div class="logo-placeholder" id="logo-preview-img">
                    Belum ada logo<br>
                    <small>Teks "<?= e($curr_ltext) ?>" digunakan sebagai gantinya</small>
                  </div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
            <div style="margin-top:16px;max-width:200px">
              <label class="form-label" for="field-logo-text">Teks Logo (inisial fallback)</label>
              <input class="form-input" type="text" id="field-logo-text" name="logo_text"
                     value="<?= e($curr_ltext) ?>" maxlength="3" placeholder="WT">
              <div class="form-text">Ditampilkan jika logo tidak ada. Maks 3 karakter.</div>
            </div>
          </div>
        </div>
        <!-- ═══ END THEME PANEL ═══ -->

        <!-- Password Change -->
        <div class="card-section">
          <h6>🔒 Ganti Password Admin</h6>
          <div class="field-grid">
            <div>
              <label class="form-label">Password Baru</label>
              <input type="password" class="form-input" name="new_password" autocomplete="new-password" placeholder="Kosongkan jika tidak ingin mengubah">
              <div class="form-text">Minimal 8 karakter.</div>
            </div>
            <div>
              <label class="form-label">Konfirmasi Password Baru</label>
              <input type="password" class="form-input" name="confirm_password" autocomplete="new-password" placeholder="Ulangi password baru">
            </div>
          </div>
        </div>

        <div style="display:flex;gap:12px;margin-top:8px">
          <button type="submit" class="btn-save">💾 Simpan Semua Pengaturan</button>
          <a href="/admin/" style="padding:10px 20px;border:1.5px solid #e8e8e8;border-radius:8px;font-size:14px;color:#888">Batal</a>
        </div>

      </form>
    </div>
  </div>
</div>

<script>
// Sync color picker ↔ text field ↔ swatch
function syncColor(picker, textId, swatchId) {
  var v = picker.value;
  document.getElementById(textId).value = v;
  document.getElementById(swatchId).style.background = v;
  updateDerivedSwatches(textId, v);
}
function syncText(input, pickerId, swatchId) {
  var v = input.value;
  if (/^#[0-9A-Fa-f]{6}$/.test(v)) {
    document.getElementById(pickerId).value = v;
    document.getElementById(swatchId).style.background = v;
    updateDerivedSwatches(input.id, v);
  }
}
function updateDerivedSwatches(fieldId, hex) {
  if (fieldId === 'tf-prim') {
    var d = shadeHex(hex,-30), l = shadeHex(hex,185);
    if(document.getElementById('sw-prim-dark'))  document.getElementById('sw-prim-dark').style.background = d;
    if(document.getElementById('sw-prim-light')) document.getElementById('sw-prim-light').style.background = l;
  } else if (fieldId === 'tf-acc') {
    var d2 = shadeHex(hex,-25), l2 = shadeHex(hex,180);
    if(document.getElementById('sw-acc-dark'))  document.getElementById('sw-acc-dark').style.background = d2;
    if(document.getElementById('sw-acc-light')) document.getElementById('sw-acc-light').style.background = l2;
  }
}
function shadeHex(hex, amt) {
  var r=parseInt(hex.slice(1,3),16), g=parseInt(hex.slice(3,5),16), b=parseInt(hex.slice(5,7),16);
  r=Math.min(255,Math.max(0,r+amt)); g=Math.min(255,Math.max(0,g+amt)); b=Math.min(255,Math.max(0,b+amt));
  return '#'+[r,g,b].map(function(x){return x.toString(16).padStart(2,'0')}).join('');
}

// Font preview
var fontCache = {};
function previewFont(name) {
  var preview = document.getElementById('font-preview');
  preview.style.fontFamily = "'" + name + "',system-ui";
  // Load Google Font for preview
  var key = name.replace(/ /g,'+');
  if (!fontCache[key]) {
    var link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = 'https://fonts.googleapis.com/css2?family=' + key + ':wght@400;700&display=swap';
    document.head.appendChild(link);
    fontCache[key] = true;
  }
}

// Logo preview
function previewLogo(input) {
  if (!input.files || !input.files[0]) return;
  var reader = new FileReader();
  reader.onload = function(e) {
    var box = document.getElementById('logo-preview-box');
    box.innerHTML = '<img src="'+e.target.result+'" alt="Preview" style="max-height:60px;max-width:100%;object-fit:contain">';
  };
  reader.readAsDataURL(input.files[0]);
}
</script>
<script src="/admin/assets/admin.js"></script></body>
</html>
