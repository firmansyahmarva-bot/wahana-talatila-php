<?php
require_once __DIR__ . '/../config.php';
$s = get_all_settings();
$metaTitle = 'K3 Social Media Generator — Buat Konten HSE Profesional Gratis | Wahana Totalita';
$metaDesc  = 'Buat poster dan konten K3 untuk Instagram, LinkedIn, dan Facebook secara gratis. Template profesional, download langsung, tanpa aplikasi.';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($metaTitle) ?></title>
<meta name="description" content="<?= e($metaDesc) ?>">
<link rel="canonical" href="<?= SITE_URL ?>/tools/social-generator/">
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "SoftwareApplication",
  "applicationCategory": "BusinessApplication",
  "name": "<?= e($metaTitle) ?>",
  "description": "<?= e($metaDesc) ?>",
  "url": "https://wahanatotalita.com/tools/social-generator/",
  "provider": {"@type": "Organization", "name": "Wahana Totalita", "url": "https://wahanatotalita.com"},
  "offers": {"@type": "Offer", "price": "0", "priceCurrency": "IDR"}
}
</script>
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
<?= theme_css_vars($s) ?>
<style>
.tool-hero{background:linear-gradient(135deg,#0f172a,#1e293b);padding:52px 0;color:#fff;text-align:center}
.tool-hero h1{font-size:clamp(1.8rem,4vw,2.4rem);font-weight:800;margin:0 0 10px}
.tool-hero p{margin:0 auto;opacity:.8;max-width:560px;font-size:1rem}
.tool-main{padding:40px 0}
.tool-grid{display:grid;grid-template-columns:380px 1fr;gap:32px;align-items:start}
/* Controls */
.controls-card{background:#fff;border-radius:16px;border:1px solid #eee;padding:24px;box-shadow:0 4px 20px rgba(0,0,0,.06);position:sticky;top:20px}
.controls-card h2{font-size:1rem;font-weight:700;margin:0 0 18px;color:#0f172a}
.form-group{margin-bottom:14px}
.form-group label{display:block;font-size:.82rem;font-weight:600;color:#333;margin-bottom:5px}
.form-group input,.form-group select,.form-group textarea,.form-group input[type=color]{width:100%;box-sizing:border-box;padding:9px 12px;border:1.5px solid #ddd;border-radius:8px;font-size:.85rem;font-family:inherit;background:#fff}
.form-group input[type=color]{padding:4px 8px;height:40px;cursor:pointer}
.form-group textarea{resize:vertical;min-height:80px;line-height:1.5}
.form-group select:focus,.form-group input:focus,.form-group textarea:focus{outline:none;border-color:#6366f1}
.templates-grid{display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-bottom:14px}
.template-btn{border:2px solid #eee;border-radius:8px;padding:10px;cursor:pointer;text-align:center;font-size:.78rem;font-weight:600;background:#fff;transition:.2s;color:#333}
.template-btn:hover{border-color:#6366f1;color:#6366f1}
.template-btn.active{border-color:#6366f1;background:#eff6ff;color:#6366f1}
.btn-generate{width:100%;background:linear-gradient(135deg,#6366f1,#4f46e5);color:#fff;border:none;padding:13px;border-radius:10px;font-size:.95rem;font-weight:700;cursor:pointer;margin-top:6px}
.btn-generate:hover{opacity:.9}
.btn-download{display:none;width:100%;background:var(--green);color:#fff;border:none;padding:13px;border-radius:10px;font-size:.95rem;font-weight:700;cursor:pointer;margin-top:8px}
/* Preview */
.preview-card{background:#fff;border-radius:16px;border:1px solid #eee;padding:24px;box-shadow:0 4px 20px rgba(0,0,0,.06)}
.preview-card h2{font-size:1rem;font-weight:700;margin:0 0 18px;color:#0f172a}
.canvas-wrap{display:flex;justify-content:center}
canvas{border-radius:12px;box-shadow:0 8px 32px rgba(0,0,0,.15);max-width:100%}
.size-tabs{display:flex;gap:8px;margin-bottom:16px;flex-wrap:wrap}
.size-tab{padding:6px 14px;border-radius:100px;border:1.5px solid #eee;font-size:.78rem;font-weight:600;cursor:pointer;background:#fff;color:#555}
.size-tab.active{background:#6366f1;color:#fff;border-color:#6366f1}
.preview-tip{margin-top:12px;font-size:.78rem;color:#999;text-align:center}
.samples-row{display:flex;gap:10px;flex-wrap:wrap;margin-top:20px}
.sample-tag{background:#f1f5f9;padding:6px 12px;border-radius:100px;font-size:.78rem;cursor:pointer;color:#475569;border:none}
.sample-tag:hover{background:#e2e8f0}
/* Sidebar tips */
.tips-card{background:#fff;border-radius:12px;border:1px solid #eee;padding:20px;margin-top:20px}
.tips-card h3{font-size:.95rem;font-weight:700;margin:0 0 12px;color:#0f172a}
@media(max-width:900px){.tool-grid{grid-template-columns:1fr}.controls-card{position:static}}
.tools-training-cta{padding:40px 0}
.tools-training-cta h2{font-size:1.3rem;font-weight:800;margin:0 0 16px;text-align:center;color:#0A4A2E}
.tools-training-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(230px,1fr));gap:16px}
.tools-training-card{background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:18px;display:flex;flex-direction:column}
.tools-training-card h3{font-size:.95rem;font-weight:700;margin:0 0 8px}
.tools-training-card h3 a{color:#0A4A2E;text-decoration:none}
.tools-training-card p{font-size:.85rem;color:#555;line-height:1.6;margin:0 0 12px;flex:1}
.tools-training-btn{display:inline-block;background:#0A4A2E;color:#fff;font-weight:700;font-size:.85rem;padding:8px 14px;border-radius:8px;text-decoration:none;text-align:center}
</style>
</head>
<body>
<?php include __DIR__ . '/../includes/navbar.php'; ?>

<div class="tool-hero">
  <div class="container">
    <h1>🎨 K3 Social Media Generator</h1>
    <p>Buat poster & konten K3 profesional untuk media sosial — Instagram, LinkedIn, Facebook — langsung di browser, gratis</p>
  </div>
</div>

<div class="tool-main">
  <div class="container">
    <div class="tool-grid">
      <!-- Controls -->
      <div>
        <div class="controls-card">
          <h2>⚙️ Atur Konten</h2>

          <div class="form-group">
            <label>Template</label>
            <div class="templates-grid">
              <button class="template-btn active" onclick="setTemplate('safety_tip')" data-tpl="safety_tip">💡 Safety Tip</button>
              <button class="template-btn" onclick="setTemplate('alert')" data-tpl="alert">⚠️ Safety Alert</button>
              <button class="template-btn" onclick="setTemplate('quote')" data-tpl="quote">💬 K3 Quote</button>
              <button class="template-btn" onclick="setTemplate('stat')" data-tpl="stat">📊 Statistik K3</button>
              <button class="template-btn" onclick="setTemplate('checklist')" data-tpl="checklist">✅ Checklist K3</button>
              <button class="template-btn" onclick="setTemplate('promo')" data-tpl="promo">🎓 Info Pelatihan</button>
            </div>
          </div>

          <div class="form-group">
            <label>Judul Utama</label>
            <input type="text" id="inputTitle" maxlength="60" placeholder="Contoh: 5 APD Wajib di Area Konstruksi">
          </div>

          <div class="form-group">
            <label>Konten / Body</label>
            <textarea id="inputBody" rows="3" placeholder="Isi pesan utama..."></textarea>
          </div>

          <div class="form-group">
            <label>Footer / Sub-teks</label>
            <input type="text" id="inputFooter" maxlength="80" placeholder="www.wahanatotalita.com | #K3Indonesia">
          </div>

          <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
            <div class="form-group">
              <label>Warna Utama</label>
              <input type="color" id="colorPrimary" value="#0A4A2E">
            </div>
            <div class="form-group">
              <label>Warna Aksen</label>
              <input type="color" id="colorAccent" value="#C6621C">
            </div>
          </div>

          <button class="btn-generate" onclick="generateCard()">🎨 Generate Poster</button>
          <button class="btn-download" id="btnDownload" onclick="downloadCard()">⬇️ Download PNG</button>
        </div>

        <div class="tips-card">
          <h3>💡 Tips Konten K3 Viral</h3>
          <ul style="margin:0;padding-left:18px;font-size:.83rem;line-height:2;color:#555">
            <li>Gunakan angka spesifik: "5 APD", "3 Langkah", "70% kecelakaan bisa dicegah"</li>
            <li>Tanda tanya di judul meningkatkan engagement</li>
            <li>Posting pukul 07-09 pagi atau 17-19 sore WIB</li>
            <li>Tambahkan hashtag: #K3Indonesia #HSE #SafetyFirst</li>
            <li>Sertakan call-to-action yang jelas</li>
          </ul>
        </div>
      </div>

      <!-- Preview -->
      <div>
        <div class="preview-card">
          <h2>👀 Preview</h2>
          <div class="size-tabs">
            <button class="size-tab active" onclick="setSize(1080,1080,'square')">⬛ Square (1:1)</button>
            <button class="size-tab" onclick="setSize(1080,1920,'story')">📱 Story (9:16)</button>
            <button class="size-tab" onclick="setSize(1200,630,'banner')">🖥 Banner (FB)</button>
          </div>
          <div class="canvas-wrap">
            <canvas id="socialCanvas" width="540" height="540"></canvas>
          </div>
          <p class="preview-tip">Klik "Generate Poster" untuk membuat desain. Download dalam resolusi 1080px.</p>

          <div style="margin-top:20px">
            <p style="font-size:.83rem;color:#555;margin:0 0 10px;font-weight:600">🚀 Quick Fill — Contoh Konten K3:</p>
            <div class="samples-row">
              <button class="sample-tag" onclick="fillSample('apd')">APD Konstruksi</button>
              <button class="sample-tag" onclick="fillSample('alert')">Safety Alert</button>
              <button class="sample-tag" onclick="fillSample('stat')">Statistik K3</button>
              <button class="sample-tag" onclick="fillSample('quote')">Quote K3</button>
              <button class="sample-tag" onclick="fillSample('pelatihan')">Info Pelatihan</button>
              <button class="sample-tag" onclick="fillSample('apar')">Prosedur APAR</button>
            </div>
          </div>
        </div>

        <!-- After-generate info -->
        <div class="tips-card">
          <h3>📤 Cara Share ke Media Sosial</h3>
          <div style="font-size:.84rem;color:#555;line-height:1.8">
            <p style="margin:0 0 8px"><strong>Instagram:</strong> Download → Upload ke IG Feed atau Stories → Tambah caption + hashtag K3</p>
            <p style="margin:0 0 8px"><strong>LinkedIn:</strong> Cocok untuk Safety Alert dan statistik — engage dengan profesional HSE</p>
            <p style="margin:0"><strong>WhatsApp Group:</strong> Share langsung ke grup safety officer, anggota K3, dll</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
// Top K3 trainings (real DB query — falls back to 3 known-real flagship
// programs only if the query errors or returns zero rows; never RAND()).
function snippet100(string $s): string {
    $s = trim(strip_tags($s));
    if (mb_strlen($s) <= 100) return $s;
    $cut = mb_substr($s, 0, 100);
    $pos = mb_strrpos($cut, ' ');
    return ($pos !== false ? mb_substr($cut, 0, $pos) : $cut) . '...';
}
$topK3Trainings = [];
try {
    $stmt = get_pdo()->prepare(
        "SELECT slug, name, description FROM trainings
         WHERE category_id = (SELECT id FROM categories WHERE slug = 'k3')
         ORDER BY view_count DESC LIMIT 3"
    );
    $stmt->execute();
    $topK3Trainings = $stmt->fetchAll();
} catch (Exception) { $topK3Trainings = []; }
if (!$topK3Trainings) {
    $topK3Trainings = [
        ['slug' => 'pelatihan-ahli-k3-umum-sertifikasi-bnsp-online', 'name' => 'Pelatihan Ahli K3 Umum', 'description' => 'Sertifikasi wajib bagi praktisi K3 perusahaan, resmi BNSP, materi regulasi & manajemen risiko.'],
        ['slug' => 'pelatihan-petugas-p3k-sertifikasi-bnsp', 'name' => 'Pelatihan Petugas P3K | Sertifikasi BNSP', 'description' => 'Pelatihan penanganan darurat dan P3K di tempat kerja, sertifikasi BNSP, wajib untuk perusahaan.'],
        ['slug' => 'pelatihan-operator-k3-sertifikasi-bnsp', 'name' => 'Pelatihan Operator K3 | Sertifikasi BNSP', 'description' => 'Kompetensi dasar keselamatan kerja untuk operator, sertifikasi resmi BNSP, untuk semua industri.'],
    ];
}
?>
<section class="tools-training-cta">
  <div class="container">
    <h2>Tingkatkan Kompetensi K3 Anda</h2>
    <div class="tools-training-grid">
      <?php foreach ($topK3Trainings as $tk): ?>
      <div class="tools-training-card">
        <h3><a href="/pelatihan/<?= e($tk['slug']) ?>/"><?= e($tk['name']) ?></a></h3>
        <p><?= e(snippet100($tk['description'] ?? '')) ?></p>
        <a href="/pelatihan/<?= e($tk['slug']) ?>/" class="tools-training-btn">Lihat Program &rarr;</a>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
<script src="<?= SITE_URL ?>/assets/js/main.js"></script>
<script>
// ─── State ────────────────────────────────────────────────────────────────
let currentSize = { w: 1080, h: 1080, type: 'square' };
let currentTemplate = 'safety_tip';

// ─── Templates ────────────────────────────────────────────────────────────
const TEMPLATES = {
  safety_tip: { icon:'💡', label:'SAFETY TIP', bg:'linear', titleColor:'#fff', bodyColor:'rgba(255,255,255,.85)' },
  alert:      { icon:'⚠️', label:'SAFETY ALERT', bg:'red',    titleColor:'#fff', bodyColor:'rgba(255,255,255,.9)' },
  quote:      { icon:'💬', label:'K3 QUOTE',    bg:'dark',   titleColor:'#fff', bodyColor:'rgba(255,255,255,.8)' },
  stat:       { icon:'📊', label:'STATISTIK K3',bg:'light',  titleColor:'#1a1a1a', bodyColor:'#444' },
  checklist:  { icon:'✅', label:'K3 CHECKLIST',bg:'linear', titleColor:'#fff', bodyColor:'rgba(255,255,255,.85)' },
  promo:      { icon:'🎓', label:'PELATIHAN K3',bg:'orange', titleColor:'#fff', bodyColor:'rgba(255,255,255,.85)' },
};

const SAMPLES = {
  apd: {
    template:'checklist',
    title:'5 APD Wajib di Area Konstruksi',
    body:'1. Helm pelindung kepala\n2. Sepatu safety (steel toe)\n3. Rompi reflektif\n4. Sarung tangan\n5. Kacamata pelindung',
    footer:'Wahana Totalita | #APD #K3Konstruksi'
  },
  alert: {
    template:'alert',
    title:'⚠️ SAFETY ALERT: Musim Hujan',
    body:'Waspadai lantai licin dan risiko sambaran petir. Hentikan pekerjaan di ketinggian saat hujan lebat.',
    footer:'Stay Safe! #SafetyFirst #K3Indonesia'
  },
  stat: {
    template:'stat',
    title:'70% Kecelakaan Kerja Bisa Dicegah',
    body:'Hanya dengan disiplin APD, briefing K3 rutin, dan identifikasi bahaya sebelum bekerja.',
    footer:'Data: BPJS Ketenagakerjaan 2024'
  },
  quote: {
    template:'quote',
    title:'"Keselamatan bukan kebetulan — itu adalah pilihan"',
    body:'Setiap kecelakaan yang bisa dicegah adalah pilihan untuk tidak mencegahnya.',
    footer:'Wahana Totalita Konsultan K3'
  },
  pelatihan: {
    template:'promo',
    title:'Pelatihan Ahli K3 Umum BNSP',
    body:'Sertifikasi resmi Kemnaker RI\nJadwal fleksibel — Online & Offline\nTersedia di seluruh Indonesia',
    footer:'Info: wa.me/62... | wahanatotalita.com'
  },
  apar: {
    template:'checklist',
    title:'Cara Pakai APAR — PASS',
    body:'P — Pull (Cabut pin pengaman)\nA — Aim  (Arahkan ke api)\nS — Squeeze (Tekan handle)\nS — Sweep (Sapukan kiri-kanan)',
    footer:'Latih secara rutin! #APAR #K3'
  }
};

// ─── Helpers ──────────────────────────────────────────────────────────────
function wrapText(ctx, text, x, y, maxWidth, lineHeight) {
  const lines = text.split('\n');
  let curY = y;
  for (const line of lines) {
    const words = line.split(' ');
    let current = '';
    for (const word of words) {
      const test = current ? current + ' ' + word : word;
      if (ctx.measureText(test).width > maxWidth && current) {
        ctx.fillText(current, x, curY);
        curY += lineHeight;
        current = word;
      } else { current = test; }
    }
    if (current) { ctx.fillText(current, x, curY); curY += lineHeight; }
  }
  return curY;
}

function hexToRgba(hex, a) {
  const r = parseInt(hex.slice(1,3),16), g = parseInt(hex.slice(3,5),16), b = parseInt(hex.slice(5,7),16);
  return `rgba(${r},${g},${b},${a})`;
}

// ─── Generate ─────────────────────────────────────────────────────────────
function generateCard() {
  const canvas  = document.getElementById('socialCanvas');
  const ctx     = canvas.getContext('2d');
  const W = currentSize.w, H = currentSize.h;
  const SCALE   = canvas.width / W;
  const cW = canvas.width, cH = canvas.height;

  const title   = document.getElementById('inputTitle').value || 'Safety Tip K3';
  const body    = document.getElementById('inputBody').value  || 'Keselamatan adalah prioritas utama';
  const footer  = document.getElementById('inputFooter').value || 'wahanatotalita.com | #K3Indonesia';
  const primary = document.getElementById('colorPrimary').value;
  const accent  = document.getElementById('colorAccent').value;
  const tpl     = TEMPLATES[currentTemplate] || TEMPLATES.safety_tip;

  ctx.clearRect(0, 0, cW, cH);

  // Background
  if (tpl.bg === 'linear') {
    const grd = ctx.createLinearGradient(0, 0, cW, cH);
    grd.addColorStop(0, primary);
    grd.addColorStop(1, hexToRgba(primary, 0.7));
    ctx.fillStyle = grd;
  } else if (tpl.bg === 'red') {
    const grd = ctx.createLinearGradient(0, 0, 0, cH);
    grd.addColorStop(0, '#7f1d1d'); grd.addColorStop(1, '#991b1b');
    ctx.fillStyle = grd;
  } else if (tpl.bg === 'dark') {
    const grd = ctx.createLinearGradient(0, 0, cW, cH);
    grd.addColorStop(0, '#0f172a'); grd.addColorStop(1, '#1e293b');
    ctx.fillStyle = grd;
  } else if (tpl.bg === 'orange') {
    const grd = ctx.createLinearGradient(0, 0, 0, cH);
    grd.addColorStop(0, accent); grd.addColorStop(1, hexToRgba(accent, 0.75));
    ctx.fillStyle = grd;
  } else {
    ctx.fillStyle = '#f8fafc';
  }
  ctx.fillRect(0, 0, cW, cH);

  // Decorative circles
  ctx.save();
  ctx.globalAlpha = 0.08;
  ctx.fillStyle = '#fff';
  ctx.beginPath(); ctx.arc(cW * 0.85, cH * 0.12, cW * 0.35, 0, Math.PI * 2); ctx.fill();
  ctx.beginPath(); ctx.arc(cW * 0.1, cH * 0.85, cW * 0.25, 0, Math.PI * 2); ctx.fill();
  ctx.restore();

  // Accent bar
  ctx.fillStyle = accent;
  ctx.fillRect(0, 0, cW * 0.006, cH);

  // Label badge
  const pad = Math.round(cW * 0.055);
  ctx.fillStyle = accent;
  const badgeH = Math.round(cH * 0.048);
  ctx.beginPath();
  ctx.roundRect(pad, pad, Math.round(cW * 0.38), badgeH, badgeH/2);
  ctx.fill();
  ctx.fillStyle = '#fff';
  ctx.font = `bold ${Math.round(cH * 0.022)}px Arial, sans-serif`;
  ctx.fillText(tpl.icon + '  ' + tpl.label, pad + 16*SCALE, pad + badgeH * 0.68);

  // Title
  const titleFontSize = currentSize.type === 'story' ? cH * 0.05 : cH * 0.065;
  ctx.fillStyle = tpl.titleColor;
  ctx.font = `800 ${Math.round(titleFontSize)}px Arial, sans-serif`;
  const titleY = pad + badgeH + Math.round(cH * 0.06);
  const titleBottom = wrapText(ctx, title, pad, titleY, cW - pad*2, titleFontSize * 1.3);

  // Divider line
  ctx.fillStyle = accent;
  ctx.fillRect(pad, titleBottom + 12, cW * 0.12, 3*SCALE);

  // Body text
  const bodyFontSize = currentSize.type === 'story' ? cH * 0.036 : cH * 0.04;
  ctx.fillStyle = tpl.bodyColor;
  ctx.font = `${Math.round(bodyFontSize)}px Arial, sans-serif`;
  wrapText(ctx, body, pad, titleBottom + 30*SCALE, cW - pad*2, bodyFontSize * 1.55);

  // Footer bar
  const fbarH = cH * 0.1;
  ctx.fillStyle = hexToRgba('#000', 0.35);
  ctx.fillRect(0, cH - fbarH, cW, fbarH);

  // Wahana logo text
  ctx.fillStyle = '#fff';
  ctx.font = `bold ${Math.round(cH * 0.028)}px Arial, sans-serif`;
  ctx.fillText('Wahana Totalita', pad, cH - fbarH * 0.55);

  // Footer text
  ctx.fillStyle = 'rgba(255,255,255,.7)';
  ctx.font = `${Math.round(cH * 0.022)}px Arial, sans-serif`;
  ctx.fillText(footer, pad, cH - fbarH * 0.2);

  // Show download button
  document.getElementById('btnDownload').style.display = 'block';
}

function downloadCard() {
  const canvas  = document.getElementById('socialCanvas');
  const tmpCanvas = document.createElement('canvas');
  tmpCanvas.width = currentSize.w;
  tmpCanvas.height = currentSize.h;
  const tmpCtx = tmpCanvas.getContext('2d');
  tmpCtx.drawImage(canvas, 0, 0, currentSize.w, currentSize.h);

  const link = document.createElement('a');
  link.download = 'k3-social-card-' + currentTemplate + '.png';
  link.href = tmpCanvas.toDataURL('image/png');
  link.click();
}

function setSize(w, h, type) {
  currentSize = {w, h, type};
  const ratio = h / w;
  const maxW = Math.min(540, window.innerWidth - 80);
  document.getElementById('socialCanvas').width  = maxW;
  document.getElementById('socialCanvas').height = Math.round(maxW * ratio);
  document.querySelectorAll('.size-tab').forEach(b => b.classList.remove('active'));
  event.target.classList.add('active');
  generateCard();
}

function setTemplate(name) {
  currentTemplate = name;
  document.querySelectorAll('.template-btn').forEach(b => {
    b.classList.toggle('active', b.dataset.tpl === name);
  });
}

function fillSample(key) {
  const s = SAMPLES[key]; if (!s) return;
  setTemplate(s.template);
  document.getElementById('inputTitle').value  = s.title;
  document.getElementById('inputBody').value   = s.body;
  document.getElementById('inputFooter').value = s.footer;
  generateCard();
}

// Auto-generate on load with default sample
window.addEventListener('load', () => {
  fillSample('apd');
});
</script>
</body></html>
