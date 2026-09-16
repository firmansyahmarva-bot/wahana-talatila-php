<?php
require_once __DIR__ . '/../config.php';
$s = get_all_settings();

$page_title = 'IBPR Generator Online Gratis – Buat HIRARC & Penilaian Risiko K3';
$meta_desc  = 'Generator IBPR/HIRARC online gratis. Identifikasi bahaya, nilai risiko dengan matriks 5x5, susun pengendalian, lalu cetak PDF atau ekspor ke Excel dalam hitungan menit.';
require __DIR__ . '/../includes/head.php';
?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "SoftwareApplication",
  "applicationCategory": "BusinessApplication",
  "name": "IBPR Generator Online Gratis",
  "description": "Generator IBPR/HIRARC online gratis untuk identifikasi bahaya, penilaian risiko, dan pengendalian risiko K3 sesuai kerangka SMK3 PP 50/2012.",
  "url": "https://wahanatotalita.com/tools/ibpr-generator/",
  "operatingSystem": "Web",
  "provider": {"@type": "Organization", "name": "Wahana Totalita", "url": "https://wahanatotalita.com"},
  "offers": {"@type": "Offer", "price": "0", "priceCurrency": "IDR"}
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {"@type": "ListItem", "position": 1, "name": "Beranda", "item": "https://wahanatotalita.com/"},
    {"@type": "ListItem", "position": 2, "name": "Tools K3", "item": "https://wahanatotalita.com/tools/"},
    {"@type": "ListItem", "position": 3, "name": "IBPR Generator", "item": "https://wahanatotalita.com/tools/ibpr-generator/"}
  ]
}
</script>
<script type="application/ld+json">
{"@context":"https://schema.org","@type":"FAQPage","mainEntity":[
{"@type":"Question","name":"Apa perbedaan IBPR dan HIRARC?","acceptedAnswer":{"@type":"Answer","text":"IBPR dan HIRARC merujuk pada proses yang sama, yaitu identifikasi bahaya, penilaian risiko, dan penentuan pengendaliannya. IBPR adalah istilah yang lazim dipakai di Indonesia, sedangkan HIRARC (Hazard Identification, Risk Assessment and Risk Control) adalah istilah yang lebih umum digunakan secara internasional."}},
{"@type":"Question","name":"Seberapa sering IBPR sebaiknya ditinjau ulang?","acceptedAnswer":{"@type":"Answer","text":"PP 50/2012 mewajibkan perusahaan melakukan peninjauan ulang SMK3 secara berkesinambungan, namun tidak menetapkan interval waktu yang baku untuk setiap dokumen IBPR. Sebagai praktik umum, banyak perusahaan meninjau IBPR secara berkala sesuai prosedur internal, dan mempercepat peninjauan bila terjadi perubahan proses kerja, insiden, alat atau mesin baru, maupun temuan audit."}},
{"@type":"Question","name":"Apakah hasil dari tool ini bisa langsung dipakai untuk audit SMK3?","acceptedAnswer":{"@type":"Answer","text":"Tool ini membantu menyusun draf tabel IBPR dengan format dan perhitungan risiko yang konsisten. Sebelum digunakan sebagai dokumen resmi audit, hasilnya tetap perlu ditinjau dan divalidasi oleh Ahli K3 Umum atau HSE Manager yang memahami kondisi aktual pekerjaan, prosedur perusahaan, dan peraturan yang berlaku, karena tool ini bersifat alat bantu, bukan pengganti penilaian pihak yang berkompeten."}}
]}
</script>
<link rel="manifest" href="/manifest.json">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
<style>
:root{
  --primary:#0f4d33;--primary-d:#0a3826;--primary-soft:#e8f3ee;
  --accent:#b7791f;
  --ink:#14181c;--muted:#5b6b63;--faint:#8a978f;
  --bg:#f6f8f7;--card:#ffffff;--border:#e3e7e4;--border-strong:#cdd6d0;
  --low:#1f9254;--low-bg:#e6f6ec;
  --med:#b7791f;--med-bg:#fbf1de;
  --high:#c2540c;--high-bg:#fdece0;
  --ext:#c0301f;--ext-bg:#fbe6e3;
  --radius:10px;--radius-sm:6px;
  --font-head:'Space Grotesk',system-ui,sans-serif;
  --font-body:'Inter',system-ui,sans-serif;
}
*{box-sizing:border-box;margin:0;padding:0}
html{-webkit-text-size-adjust:100%}
body{font-family:var(--font-body);background:var(--bg);color:var(--ink);line-height:1.55;font-size:15px}
a{color:var(--primary);text-decoration:none}
h1,h2,h3{font-family:var(--font-head)}
.container{max-width:1120px;margin:0 auto;padding:0 20px}
button,select,input{font-family:inherit}
:focus-visible{outline:2px solid var(--primary);outline-offset:2px}

/* NAV */
nav{background:#fff;border-bottom:1px solid var(--border);padding:12px 0;position:sticky;top:0;z-index:100}
.nav-inner{display:flex;align-items:center;justify-content:space-between;gap:12px}
.nav-logo{display:flex;align-items:center;gap:9px;font-weight:700;color:var(--primary);font-size:.95rem;font-family:var(--font-head)}
.nav-logo svg{width:28px;height:28px;flex:none}
.nav-right{display:flex;align-items:center;gap:16px}
.nav-back{color:var(--muted);font-size:.85rem}
.nav-cta{background:var(--primary);color:#fff;padding:7px 16px;border-radius:7px;font-size:.83rem;font-weight:600}

/* PAGE HEADER — compact, tool is the focus, not a hero banner */
.page-head{padding:22px 0 14px;border-bottom:1px solid var(--border);background:#fff}
.page-head .eyebrow{font-size:.72rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:var(--primary);margin-bottom:6px}
.page-head h1{font-size:clamp(1.25rem,2.6vw,1.6rem);font-weight:700;color:var(--ink);margin-bottom:6px;letter-spacing:-.01em}
.page-head p{font-size:.9rem;color:var(--muted);max-width:640px}
.page-head .kw-line{margin-top:8px;font-size:.76rem;color:var(--faint)}

/* TOOLBAR */
.toolbar{background:#fff;border-bottom:1px solid var(--border);padding:10px 0;position:sticky;top:53px;z-index:90}
.toolbar-inner{display:flex;align-items:center;gap:8px;flex-wrap:wrap}
.tb-select{border:1px solid var(--border-strong);border-radius:7px;padding:8px 10px;font-size:.83rem;background:#fff;color:var(--ink)}
.btn{border:none;border-radius:7px;padding:8px 14px;font-size:.83rem;font-weight:600;cursor:pointer;display:inline-flex;align-items:center;gap:6px;white-space:nowrap}
.btn-primary{background:var(--primary);color:#fff}
.btn-primary:hover{background:var(--primary-d)}
.btn-ghost{background:#fff;color:var(--ink);border:1px solid var(--border-strong)}
.btn-ghost:hover{background:var(--bg)}
.btn-outline{background:var(--primary-soft);color:var(--primary-d);border:1px solid #cfe6da}
.btn-outline:hover{background:#dcefe4}
.btn-danger-ghost{background:#fff;color:var(--ext);border:1px solid var(--border-strong)}
.btn-danger-ghost:hover{background:var(--ext-bg);border-color:#f3c9c2}
.tb-spacer{flex:1}

.main{padding:20px 0 64px}

/* DOC INFO — collapsible, compact */
details.panel{background:var(--card);border:1px solid var(--border);border-radius:var(--radius);margin-bottom:14px}
details.panel summary{list-style:none;cursor:pointer;padding:12px 16px;font-size:.85rem;font-weight:600;color:var(--ink);display:flex;align-items:center;gap:8px}
details.panel summary::-webkit-details-marker{display:none}
details.panel summary::before{content:'▸';color:var(--muted);font-size:.7rem;transition:transform .15s}
details.panel[open] summary::before{transform:rotate(90deg)}
.panel-body{padding:2px 16px 16px}
.grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:12px}
.field{margin-bottom:0}
.field label{display:block;font-size:.76rem;font-weight:600;color:var(--muted);margin-bottom:4px}
.field input{width:100%;padding:8px 10px;border:1px solid var(--border-strong);border-radius:6px;font-size:.85rem;color:var(--ink);background:#fff}
.field input:focus{border-color:var(--primary)}

/* SUMMARY STRIP + MATRIX */
.stat-strip{display:flex;align-items:stretch;gap:0;background:var(--card);border:1px solid var(--border);border-radius:var(--radius);margin-bottom:14px;overflow:hidden;flex-wrap:wrap}
.stat{flex:1;min-width:110px;padding:12px 16px;border-right:1px solid var(--border)}
.stat:last-child{border-right:none}
.stat .num{font-family:var(--font-head);font-size:1.5rem;font-weight:700;font-variant-numeric:tabular-nums;line-height:1.1}
.stat .lbl{font-size:.72rem;color:var(--muted);margin-top:2px}
.stat.low .num{color:var(--low)}
.stat.med .num{color:var(--med)}
.stat.high .num{color:var(--ext)}

details.matrix summary{padding:10px 16px;font-size:.78rem}
.matrix-wrap{padding:4px 16px 16px;display:flex;gap:20px;flex-wrap:wrap;align-items:flex-start}
.matrix-grid{display:grid;grid-template-columns:auto repeat(5,34px);gap:2px;font-size:.68rem}
.matrix-grid .mx-axis{display:flex;align-items:center;justify-content:center;color:var(--faint);font-weight:600}
.matrix-grid .mx-cell{width:34px;height:34px;display:flex;align-items:center;justify-content:center;border-radius:4px;font-weight:700;font-variant-numeric:tabular-nums;color:#fff;font-size:.72rem}
.matrix-legend{font-size:.76rem;color:var(--muted);max-width:260px}
.matrix-legend div{display:flex;align-items:center;gap:6px;margin-bottom:4px}
.dot{width:9px;height:9px;border-radius:50%;flex:none}

/* TABLE — desktop spreadsheet */
.table-panel{background:var(--card);border:1px solid var(--border);border-radius:var(--radius);margin-bottom:16px;overflow:hidden}
.table-panel-head{padding:12px 16px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;gap:10px;flex-wrap:wrap}
.table-panel-head h2{font-size:.92rem;font-weight:700;color:var(--ink)}
.legend-inline{display:flex;gap:14px;font-size:.72rem;color:var(--muted);flex-wrap:wrap}
.legend-inline span{display:inline-flex;align-items:center;gap:5px}

.ibpr-wrap{overflow-x:auto}
.ibpr-table{width:100%;border-collapse:collapse;font-size:.79rem;min-width:960px}
.ibpr-table thead th{background:var(--bg);color:var(--muted);font-weight:700;padding:9px 8px;text-align:left;font-size:.68rem;text-transform:uppercase;letter-spacing:.03em;white-space:nowrap;border-bottom:1px solid var(--border);border-right:1px solid var(--border)}
.ibpr-table thead th.group-awal{background:var(--low-bg);color:var(--low)}
.ibpr-table thead th.group-sisa{background:#eaf1ee;color:var(--primary-d)}
.ibpr-table thead th:last-child{border-right:none}
.ibpr-table tbody td{padding:6px;border-bottom:1px solid var(--border);border-right:1px solid var(--border);vertical-align:top}
.ibpr-table tbody tr:hover{background:#fafbfa}
.ibpr-table tbody td:last-child{border-right:none}
.ibpr-table td input,.ibpr-table td select{width:100%;border:1px solid var(--border);border-radius:5px;padding:7px 8px;font-size:.79rem;font-family:inherit;background:#fff;color:var(--ink)}
.ibpr-table td input:focus,.ibpr-table td select:focus{border-color:var(--primary)}
.ibpr-table td.rownum{text-align:center;font-weight:700;color:var(--faint);font-size:.78rem;padding-top:12px}
.score-cell{text-align:center;font-variant-numeric:tabular-nums}
.score-cell .empty{color:var(--faint);font-size:.85rem}
.score-pill{display:inline-flex;flex-direction:column;align-items:center;gap:2px;padding:5px 4px;border-radius:6px;min-width:52px}
.score-pill .n{font-family:var(--font-head);font-weight:700;font-size:.95rem;line-height:1}
.score-pill .l{font-size:.6rem;font-weight:700;letter-spacing:.03em}
.score-pill.low{background:var(--low-bg);color:var(--low)}
.score-pill.medium{background:var(--med-bg);color:var(--med)}
.score-pill.high{background:var(--high-bg);color:var(--high)}
.score-pill.extreme{background:var(--ext-bg);color:var(--ext)}
.btn-del-row{background:none;border:none;color:var(--faint);cursor:pointer;font-size:1rem;padding:6px;border-radius:5px}
.btn-del-row:hover{background:var(--ext-bg);color:var(--ext)}
.field-warn{border-color:var(--ext)!important}

.btn-add-row{background:var(--primary-soft);color:var(--primary-d);border:1.5px dashed #a9d1bb;border-radius:8px;padding:11px;width:100%;font-size:.85rem;font-weight:600;cursor:pointer}
.btn-add-row:hover{background:#dcefe4}

.empty-state{padding:44px 20px;text-align:center;color:var(--muted)}
.empty-state .ic{font-size:1.8rem;margin-bottom:8px}
.empty-state h3{font-size:.95rem;color:var(--ink);margin-bottom:4px}
.empty-state p{font-size:.83rem;margin-bottom:14px}

/* MOBILE CARD TABLE (no horizontal scroll) */
@media(max-width:768px){
  .ibpr-wrap{overflow-x:visible}
  .ibpr-table{min-width:0;display:block}
  .ibpr-table thead{display:none}
  .ibpr-table tbody{display:block}
  .ibpr-table tbody tr{display:flex;flex-wrap:wrap;gap:8px;position:relative;background:#fff;border:1px solid var(--border);border-radius:10px;padding:14px 14px 12px;margin-bottom:12px}
  .ibpr-table tbody tr:hover{background:#fff}
  .ibpr-table td{border:none;padding:0;flex:1 1 100%}
  .ibpr-table td.rownum{order:-2;flex:0 0 auto;padding-top:0;font-size:.7rem}
  .ibpr-table td.rownum::before{content:'IBPR #'}
  .ibpr-table td.del-cell{order:-1;margin-left:auto;flex:0 0 auto}
  .ibpr-table td[data-label]::before{content:attr(data-label);display:block;font-size:.68rem;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.03em;margin-bottom:3px}
  .ibpr-table td.grp-awal{flex:1 1 28%;background:var(--low-bg);border-radius:6px;padding:6px}
  .ibpr-table td.grp-sisa{flex:1 1 28%;background:#eaf1ee;border-radius:6px;padding:6px}
  .ibpr-table td.grp-awal:nth-of-type(6),.ibpr-table td.grp-sisa:nth-of-type(9){flex-basis:100%;background:none;padding:0;margin-top:4px}
  .ibpr-table td.grp-awal:nth-of-type(6)::before{content:'Penilaian Risiko Awal';color:var(--low);font-size:.72rem}
  .ibpr-table td.grp-sisa:nth-of-type(9)::before{content:'Penilaian Risiko Sisa';color:var(--primary-d);font-size:.72rem}
  .score-cell{text-align:left}
}
@media(max-width:520px){.grid-3{grid-template-columns:1fr}.stat{min-width:45%}}

/* HELP PANEL */
.help-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:6px 24px;font-size:.82rem;color:#374151}
.help-grid li{margin-bottom:2px}
@media(max-width:640px){.help-grid{grid-template-columns:1fr}}

.cta-strip{background:var(--primary);color:#fff;border-radius:var(--radius);padding:24px;text-align:center;margin:28px 0}
.cta-strip h3{font-size:1.02rem;font-weight:700;margin-bottom:6px}
.cta-strip p{opacity:.85;font-size:.85rem;margin-bottom:14px;max-width:520px;margin-left:auto;margin-right:auto}
.cta-strip a.wa-btn{background:#25D366;color:#fff;padding:11px 24px;border-radius:8px;font-weight:700;display:inline-flex;align-items:center;gap:8px;font-size:.85rem}

footer{background:#111827;color:#9ca3af;padding:26px 0;text-align:center;font-size:.82rem}
footer a{color:#6ee7b7}

.toast{position:fixed;bottom:22px;left:50%;transform:translateX(-50%) translateY(20px);background:var(--primary-d);color:#fff;padding:10px 22px;border-radius:50px;font-size:.85rem;font-weight:600;opacity:0;transition:all .25s;pointer-events:none;z-index:999;max-width:90vw;text-align:center}
.toast.show{opacity:1;transform:translateX(-50%) translateY(0)}
.toast.warn{background:#7a3a13}

@media print{
  nav,.toolbar,.btn-add-row,.cta-strip,footer,.tool-article,.tools-training-cta,details.matrix,.wa-float,.toast{display:none!important}
  body{background:#fff}
  .page-head{border:none}
  .ibpr-wrap{overflow:visible}
  .ibpr-table{min-width:auto;font-size:7.5pt;display:table!important}
  .ibpr-table thead{display:table-header-group!important}
  .ibpr-table tbody{display:table-row-group!important}
  .ibpr-table tbody tr{display:table-row!important;border:none;padding:0;margin:0}
  .ibpr-table td{display:table-cell!important;border:1px solid #ccc!important;padding:4px!important}
  .ibpr-table td::before{display:none!important}
  .ibpr-table th{font-size:6.5pt}
  details.panel{border:none}
}

.tools-training-cta{padding:36px 0}
.tools-training-cta h2{font-size:1.15rem;font-weight:700;margin:0 0 14px;text-align:center;color:var(--primary-d)}
.tools-training-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(230px,1fr));gap:14px}
.tools-training-card{background:#fff;border:1px solid var(--border);border-radius:10px;padding:16px;display:flex;flex-direction:column}
.tools-training-card h3{font-size:.9rem;font-weight:700;margin:0 0 6px}
.tools-training-card h3 a{color:var(--primary-d)}
.tools-training-card p{font-size:.82rem;color:#555;line-height:1.55;margin:0 0 12px;flex:1}
.tools-training-btn{display:inline-block;background:var(--primary-d);color:#fff;font-weight:700;font-size:.82rem;padding:8px 14px;border-radius:7px;text-align:center}

.tool-article{padding:8px 0}
.tool-article h2{font-size:1.1rem;font-weight:700;color:var(--primary-d);margin:30px 0 12px;letter-spacing:-.01em}
.tool-article h2:first-child{margin-top:0}
.tool-article p{font-size:.9rem;color:#374151;line-height:1.75;margin-bottom:12px}
.tool-article ol,.tool-article ul{padding-left:20px;font-size:.9rem;line-height:1.85;color:#374151;margin-bottom:10px}
.tool-article ol li,.tool-article ul li{margin-bottom:6px}
.ex-table-wrap{overflow-x:auto;margin:14px 0}
.ex-table{width:100%;border-collapse:collapse;font-size:.78rem;min-width:680px}
.ex-table th{background:var(--bg);color:var(--muted);text-transform:uppercase;font-size:.66rem;letter-spacing:.03em;padding:8px;text-align:left;border:1px solid var(--border)}
.ex-table td{padding:8px;border:1px solid var(--border);vertical-align:top;color:#374151}
.ex-table td.lvl{font-weight:700}
.note-box{background:var(--primary-soft);border-left:3px solid var(--primary);border-radius:0 8px 8px 0;padding:12px 16px;font-size:.85rem;color:#1f3a2c;margin:14px 0}
.faq-item{margin-bottom:14px}
.faq-item h3{font-size:.92rem;font-weight:700;color:var(--ink);margin-bottom:5px}
.faq-item p{font-size:.87rem;color:#374151;margin:0}
</style>
<nav>
  <div class="container nav-inner">
    <a href="/" class="nav-logo">
      <svg viewBox="0 0 40 40" fill="none"><circle cx="20" cy="20" r="20" fill="#0f4d33"/><path d="M20 8l3 9h9l-7 5 3 9-8-6-8 6 3-9-7-5h9z" fill="#b7791f"/></svg>
      Wahana Totalita
    </a>
    <div class="nav-right">
      <a href="/tools/" class="nav-back">← Semua Tools</a>
      <a href="https://wa.me/6287759151278" target="_blank" class="nav-cta">Konsultasi</a>
    </div>
  </div>
</nav>

<div class="page-head">
  <div class="container">
    <div class="eyebrow">Tools K3 · Gratis</div>
    <h1>IBPR Generator — Identifikasi Bahaya & Penilaian Risiko</h1>
    <p>Susun tabel IBPR/HIRARC lengkap dengan perhitungan risiko otomatis, lalu unduh sebagai PDF atau ekspor ke Excel. Cocok untuk konstruksi, manufaktur, gudang, tambang, dan perkantoran.</p>
    <div class="kw-line">IBPR · HIRARC · Identifikasi Bahaya · Penilaian Risiko · Pengendalian Risiko · sesuai kerangka SMK3 PP 50/2012</div>
  </div>
</div>

<div class="toolbar">
  <div class="container toolbar-inner">
    <select class="tb-select" id="presetSelect" onchange="onPresetChange(this.value)">
      <option value="">Pilih preset industri…</option>
      <option value="konstruksi">Konstruksi</option>
      <option value="manufaktur">Manufaktur</option>
      <option value="gudang">Pergudangan</option>
      <option value="tambang">Pertambangan</option>
      <option value="kantor">Perkantoran</option>
    </select>
    <button class="btn btn-outline" onclick="loadExample()">✦ Coba dengan Contoh</button>
    <div class="tb-spacer"></div>
    <button class="btn btn-ghost" onclick="doPrint()">🖨 Cetak / PDF</button>
    <button class="btn btn-ghost" onclick="exportCSV()">⇩ Ekspor CSV</button>
    <button class="btn btn-danger-ghost" onclick="clearAll()">↺ Reset</button>
  </div>
</div>

<section class="main">
  <div class="container">

    <details class="panel" open>
      <summary>Informasi Dokumen <span style="font-weight:400;color:var(--muted)">(opsional, tampil saat dicetak)</span></summary>
      <div class="panel-body">
        <div class="grid-3">
          <div class="field"><label>Nama Proyek / Unit Kerja</label><input type="text" id="project" placeholder="cth: Proyek Konstruksi Gedung A"></div>
          <div class="field"><label>Nomor Dokumen</label><input type="text" id="docNo" placeholder="cth: IBPR-K3-2025-001"></div>
          <div class="field"><label>Tanggal</label><input type="date" id="docDate" value="<?php echo date('Y-m-d'); ?>"></div>
          <div class="field"><label>Departemen / Bagian</label><input type="text" id="dept" placeholder="cth: Departemen HSE"></div>
          <div class="field"><label>Dibuat oleh</label><input type="text" id="createdBy" placeholder="cth: Budi Santoso, HSE Officer"></div>
          <div class="field"><label>Disetujui oleh</label><input type="text" id="approvedBy" placeholder="cth: Ahmad K., HSE Manager"></div>
        </div>
      </div>
    </details>

    <div class="stat-strip">
      <div class="stat"><div class="num" id="sumTotal">0</div><div class="lbl">Total aktivitas</div></div>
      <div class="stat low"><div class="num" id="sumLow">0</div><div class="lbl">Risiko rendah</div></div>
      <div class="stat med"><div class="num" id="sumMed">0</div><div class="lbl">Risiko sedang</div></div>
      <div class="stat high"><div class="num" id="sumHigh">0</div><div class="lbl">Tinggi + ekstrem</div></div>
    </div>

    <details class="panel matrix">
      <summary>Lihat Matriks Risiko 5×5 (live)</summary>
      <div class="matrix-wrap">
        <div>
          <div class="matrix-grid" id="matrixGrid" style="grid-template-rows:auto repeat(5,34px)"></div>
        </div>
        <div class="matrix-legend">
          <div><span class="dot" style="background:var(--low)"></span> Low — skor 1–4</div>
          <div><span class="dot" style="background:var(--med)"></span> Medium — skor 5–9</div>
          <div><span class="dot" style="background:var(--high)"></span> High — skor 10–16</div>
          <div><span class="dot" style="background:var(--ext)"></span> Extreme — skor 17–25</div>
          <p style="margin-top:8px;color:var(--faint)">Sumbu X = Severity (1–5), sumbu Y = Likelihood (1–5). Angka pada sel menunjukkan jumlah bahaya (risiko awal) di kombinasi tersebut.</p>
        </div>
      </div>
    </details>

    <div class="table-panel">
      <div class="table-panel-head">
        <h2>Tabel IBPR / HIRARC</h2>
        <div class="legend-inline">
          <span><span class="dot" style="background:var(--low)"></span>Risiko Awal = sebelum kontrol tambahan</span>
          <span><span class="dot" style="background:var(--primary-d)"></span>Risiko Sisa = setelah kontrol tambahan</span>
        </div>
      </div>
      <div class="ibpr-wrap">
        <table class="ibpr-table">
          <thead>
            <tr>
              <th rowspan="2" style="width:32px">#</th>
              <th rowspan="2" style="min-width:130px">Aktivitas / Proses</th>
              <th rowspan="2" style="min-width:140px">Identifikasi Bahaya</th>
              <th rowspan="2" style="min-width:130px">Risiko / Konsekuensi</th>
              <th rowspan="2" style="min-width:140px">Kontrol Saat Ini</th>
              <th colspan="3" class="group-awal">Risiko Awal</th>
              <th colspan="3" class="group-sisa">Risiko Sisa</th>
              <th rowspan="2" style="min-width:140px">Tindakan Tambahan</th>
              <th rowspan="2" style="min-width:80px">PIC</th>
              <th rowspan="2" style="width:36px"></th>
            </tr>
            <tr>
              <th class="group-awal" style="width:38px">L</th>
              <th class="group-awal" style="width:38px">S</th>
              <th class="group-awal" style="width:60px">Skor</th>
              <th class="group-sisa" style="width:38px">L</th>
              <th class="group-sisa" style="width:38px">S</th>
              <th class="group-sisa" style="width:60px">Skor</th>
            </tr>
          </thead>
          <tbody id="ibprBody"></tbody>
        </table>
      </div>
      <div id="emptyState" class="empty-state" style="display:none">
        <div class="ic">📋</div>
        <h3>Belum ada aktivitas yang dianalisis</h3>
        <p>Tambahkan baris pertama, atau muat contoh untuk melihat cara kerjanya.</p>
        <button class="btn btn-primary" onclick="addRow()">+ Tambah Aktivitas Pertama</button>
      </div>
      <div style="padding:12px 16px 16px">
        <button class="btn-add-row" onclick="addRow(true)">+ Tambah Baris IBPR</button>
      </div>
    </div>

    <details class="panel">
      <summary>Panduan Pengisian & Skala Penilaian</summary>
      <div class="panel-body">
        <ul class="help-grid">
          <li><strong>Aktivitas:</strong> nama kegiatan yang dianalisis (cth: Pengelasan, Pekerjaan di Ketinggian)</li>
          <li><strong>Bahaya:</strong> sumber yang berpotensi menyebabkan cedera/kerugian (cth: percikan api, jatuh dari ketinggian)</li>
          <li><strong>Risiko:</strong> konsekuensi bila bahaya terjadi (cth: luka bakar, patah tulang)</li>
          <li><strong>Kontrol saat ini:</strong> pengendalian yang sudah berjalan di lapangan</li>
          <li><strong>L — Likelihood:</strong> 1 Rare, 2 Unlikely, 3 Possible, 4 Likely, 5 Almost Certain</li>
          <li><strong>S — Severity:</strong> 1 Insignificant, 2 Minor, 3 Moderate, 4 Major, 5 Catastrophic</li>
          <li><strong>Skor</strong> = L × S, dengan pita Low (1–4), Medium (5–9), High (10–16), Extreme (17–25)</li>
          <li><strong>Risiko Sisa:</strong> nilai ulang L dan S setelah tindakan tambahan diterapkan</li>
        </ul>
      </div>
    </details>

    <div class="cta-strip">
      <h3>Pelajari IBPR dan SMK3 Secara Resmi</h3>
      <p>Pelatihan Ahli K3 Umum KEMNAKER RI membahas praktik lengkap IBPR, JSA, hierarki pengendalian, dan audit SMK3 PP 50/2012.</p>
      <a class="wa-btn" href="https://wa.me/6287759151278?text=Halo%20Wahana%2C%20saya%20pakai%20IBPR%20Generator%20dan%20ingin%20tanya%20pelatihan%20K3" target="_blank" rel="noopener">📱 Tanya Pelatihan Ahli K3 Umum</a>
    </div>
  </div>
</section>

<section class="tool-article">
  <div class="container">

    <h2>Apa Itu IBPR?</h2>
    <p>IBPR (Identifikasi Bahaya, Penilaian, dan Pengendalian Risiko) adalah dokumen inti dalam Sistem Manajemen Keselamatan dan Kesehatan Kerja (SMK3) yang memetakan bahaya di setiap aktivitas kerja, menilai seberapa besar risikonya, lalu menentukan cara mengendalikannya. Dokumen ini menjadi dasar bagi elemen "Perencanaan K3" pada kerangka SMK3, karena program K3 — pelatihan, inspeksi, prosedur kerja aman — semestinya disusun berdasarkan risiko yang sudah teridentifikasi, bukan asumsi.</p>
    <p>Tanpa IBPR yang terdokumentasi, perusahaan kesulitan menunjukkan bahwa bahaya di tempat kerja sudah diidentifikasi secara sistematis, apalagi dikendalikan dengan prioritas yang tepat. Karena itu IBPR/HIRARC hampir selalu menjadi salah satu dokumen yang diperiksa saat audit internal maupun audit SMK3.</p>

    <h2>Cara Membuat IBPR</h2>
    <ol>
      <li><strong>Daftar aktivitas kerja</strong> — pecah pekerjaan menjadi tahapan atau aktivitas yang cukup spesifik untuk dianalisis, bukan sekadar nama proyek besar.</li>
      <li><strong>Identifikasi bahaya</strong> di setiap aktivitas, termasuk bahaya fisik, kimia, biologis, ergonomi, maupun psikososial.</li>
      <li><strong>Tentukan risiko/konsekuensi</strong> yang mungkin timbul jika bahaya tersebut benar-benar terjadi.</li>
      <li><strong>Nilai risiko awal</strong> menggunakan Likelihood × Severity berdasarkan kontrol yang sudah berjalan saat ini.</li>
      <li><strong>Tentukan pengendalian tambahan</strong> mengikuti hierarki pengendalian risiko, dimulai dari opsi yang paling efektif.</li>
      <li><strong>Nilai ulang sebagai risiko sisa</strong> setelah kontrol tambahan diasumsikan diterapkan, untuk memastikan risiko turun ke tingkat yang dapat diterima.</li>
      <li><strong>Dokumentasikan, sahkan, dan tinjau ulang secara berkala</strong>, terutama saat ada perubahan proses, alat, atau setelah insiden.</li>
    </ol>
    <p>Generator di atas mengikuti alur yang sama — Anda cukup mengisi kolom sesuai urutannya, dan skor risiko dihitung otomatis.</p>

    <h2>Contoh IBPR Konstruksi</h2>
    <p>Berikut contoh singkat penerapan IBPR untuk beberapa aktivitas umum di proyek konstruksi. Anda bisa memuat contoh yang lebih lengkap langsung di generator melalui tombol "Coba dengan Contoh".</p>
    <div class="ex-table-wrap">
      <table class="ex-table">
        <thead><tr><th>Aktivitas</th><th>Bahaya</th><th>L</th><th>S</th><th>Skor</th><th>Level</th><th>Pengendalian Tambahan</th></tr></thead>
        <tbody>
          <tr><td>Pekerjaan di ketinggian</td><td>Terjatuh dari perancah</td><td>3</td><td>5</td><td>15</td><td class="lvl" style="color:var(--high)">High</td><td>Full body harness, inspeksi scaffolding, safety net</td></tr>
          <tr><td>Pengelasan</td><td>Percikan api, asap las</td><td>3</td><td>3</td><td>9</td><td class="lvl" style="color:var(--med)">Medium</td><td>Fire watch, exhaust fan, izin kerja panas (hot work permit)</td></tr>
          <tr><td>Pengangkatan (lifting) dengan crane</td><td>Beban jatuh/ayun</td><td>2</td><td>5</td><td>10</td><td class="lvl" style="color:var(--high)">High</td><td>Lifting plan, rigger bersertifikat, barikade area ayun beban</td></tr>
          <tr><td>Galian (excavation)</td><td>Longsor dinding galian</td><td>2</td><td>4</td><td>8</td><td class="lvl" style="color:var(--med)">Medium</td><td>Shoring/sloping, izin masuk ruang terbatas bila perlu</td></tr>
        </tbody>
      </table>
    </div>

    <h2>Cara Menilai Likelihood dan Severity</h2>
    <p>Likelihood (L) menggambarkan seberapa mungkin bahaya benar-benar terjadi, biasanya dipertimbangkan dari frekuensi paparan, riwayat kejadian serupa, dan efektivitas kontrol yang ada. Severity (S) menggambarkan seberapa parah dampaknya jika terjadi, mulai dari nyaris tidak berdampak hingga berpotensi fatal atau melibatkan banyak korban.</p>
    <p>Skala 1–5 seperti pada generator ini adalah salah satu pendekatan yang umum dipakai. Beberapa perusahaan menggunakan matriks 4×4, bobot yang berbeda, atau kriteria tambahan seperti dampak lingkungan dan reputasi — sesuaikan dengan prosedur penilaian risiko internal perusahaan Anda apabila sudah memilikinya. Yang terpenting adalah konsistensi: gunakan definisi skala yang sama di seluruh dokumen IBPR agar hasil penilaian antar-aktivitas bisa dibandingkan secara wajar.</p>

    <h2>Hierarki Pengendalian Risiko</h2>
    <p>Setelah risiko dinilai, tindakan pengendalian idealnya dipilih mengikuti hierarki pengendalian, dari yang paling efektif ke yang paling bergantung pada perilaku individu:</p>
    <ol>
      <li><strong>Eliminasi</strong> — menghilangkan bahaya sepenuhnya, misalnya mengganti metode kerja agar pekerjaan di ketinggian tidak diperlukan.</li>
      <li><strong>Substitusi</strong> — mengganti bahan, alat, atau proses dengan yang lebih rendah risikonya.</li>
      <li><strong>Rekayasa teknik (engineering control)</strong> — pagar pengaman, guarding mesin, sistem ventilasi, safety net.</li>
      <li><strong>Pengendalian administratif</strong> — izin kerja (permit to work), prosedur kerja aman, rotasi kerja, pelatihan.</li>
      <li><strong>Alat pelindung diri (APD)</strong> — lapisan pengendalian terakhir, digunakan bersama kontrol lain, bukan sebagai satu-satunya andalan.</li>
    </ol>
    <p>Kombinasi beberapa lapis pengendalian umumnya menghasilkan penurunan risiko yang lebih andal dibanding mengandalkan satu jenis kontrol saja — inilah yang tercermin pada perbandingan risiko awal versus risiko sisa di tabel IBPR.</p>

    <h2>IBPR untuk Pekerjaan Konstruksi</h2>
    <p>Proyek konstruksi umumnya memiliki profil risiko yang lebih tinggi dibanding kantor karena banyak aktivitas berisiko tinggi berjalan bersamaan. Beberapa contoh bahaya yang sering muncul dalam IBPR konstruksi:</p>
    <ul>
      <li><strong>Pekerjaan di ketinggian</strong> — risiko jatuh dari atap, perancah, atau bukaan lantai; memerlukan harness, jaring pengaman, dan pengawasan kompeten.</li>
      <li><strong>Scaffolding</strong> — risiko roboh atau komponen lepas bila pemasangan tidak diperiksa; perlu inspeksi berkala dan tagging status aman/tidak aman.</li>
      <li><strong>Lifting/pengangkatan dengan crane</strong> — risiko beban jatuh atau ayunan mengenai pekerja; memerlukan lifting plan, operator dan rigger bersertifikat, serta zona eksklusi.</li>
      <li><strong>Galian (excavation)</strong> — risiko longsor dinding galian atau ruang terbatas dengan kadar oksigen rendah; memerlukan shoring/sloping dan pemantauan gas bila relevan.</li>
      <li><strong>Alat berat</strong> — risiko pekerja tertabrak atau alat terguling; memerlukan jalur akses terpisah, spotter, dan pemeriksaan kondisi alat.</li>
      <li><strong>Pengelasan dan hot work</strong> — risiko kebakaran, luka bakar, dan paparan asap las; memerlukan izin kerja panas dan fire watch.</li>
    </ul>
    <p>Karena banyaknya interaksi antar-pekerjaan di lapangan, IBPR di proyek konstruksi biasanya perlu dipadukan dengan Job Safety Analysis (JSA) per tugas harian dan sistem izin kerja (permit to work) untuk aktivitas berisiko tinggi.</p>

    <h2>IBPR vs HIRARC</h2>
    <p>IBPR dan HIRARC pada dasarnya membahas proses yang sama: identifikasi bahaya, penilaian risiko, dan penentuan pengendalian. IBPR adalah istilah yang lazim dipakai dalam konteks regulasi dan praktik K3 di Indonesia, sedangkan HIRARC (Hazard Identification, Risk Assessment and Risk Control) adalah istilah yang lebih umum dipakai secara internasional, termasuk dalam berbagai standar dan literatur K3 luar negeri. Struktur tabel, cara penilaian, dan tujuannya pada dasarnya identik — perbedaannya terutama pada istilah yang digunakan.</p>

    <h2>Risiko Awal vs Risiko Sisa</h2>
    <p><strong>Risiko awal (inherent risk)</strong> adalah tingkat risiko yang dinilai berdasarkan kontrol yang sudah berjalan saat ini, sebelum tindakan tambahan diterapkan. Nilai ini menunjukkan seberapa besar eksposur pekerja terhadap bahaya dalam kondisi kerja saat ini.</p>
    <p><strong>Risiko sisa (residual risk)</strong> adalah tingkat risiko setelah tindakan tambahan pada kolom "Tindakan Tambahan" diasumsikan sudah diterapkan. Idealnya risiko sisa berada di level yang lebih rendah dan dapat diterima (acceptable). Jika setelah kontrol tambahan risiko sisa masih tinggi atau ekstrem, itu tandanya pengendalian yang direncanakan belum cukup dan perlu dipertimbangkan opsi lain — idealnya dengan mendahulukan opsi yang lebih tinggi dalam hierarki pengendalian, bukan sekadar menambah APD.</p>

    <h2>Apakah Hasil Generator Langsung Bisa Digunakan untuk Audit?</h2>
    <p>Tool ini membantu Anda menyusun draf tabel IBPR dengan format dan perhitungan risiko yang konsisten, jauh lebih cepat dibanding membuat dari nol. Namun hasilnya adalah alat bantu penyusunan dokumen, bukan pengganti penilaian oleh pihak yang berkompeten.</p>
    <p>Sebelum digunakan sebagai dokumen resmi untuk audit SMK3 — baik audit internal maupun eksternal — draf IBPR sebaiknya ditinjau ulang oleh Ahli K3 Umum atau HSE Manager yang memahami kondisi aktual di lapangan, prosedur kerja perusahaan, serta peraturan dan standar yang relevan dengan jenis industri Anda. Penilaian Likelihood dan Severity yang tepat sangat bergantung pada konteks nyata pekerjaan, sesuatu yang tidak bisa sepenuhnya digantikan oleh formulir generik.</p>
    <div class="note-box">Ringkasnya: gunakan generator ini untuk mempercepat penyusunan draf dan menjaga format tetap rapi dan konsisten, lalu pastikan ada proses tinjauan oleh personel K3 yang kompeten sebelum dokumen ini digunakan secara resmi.</div>

    <h2>Pertanyaan Umum</h2>
    <div class="faq-item">
      <h3>Apa perbedaan IBPR dan HIRARC?</h3>
      <p>IBPR dan HIRARC merujuk pada proses yang sama, yaitu identifikasi bahaya, penilaian risiko, dan penentuan pengendaliannya. IBPR adalah istilah yang lazim dipakai di Indonesia, sedangkan HIRARC adalah istilah yang lebih umum digunakan secara internasional.</p>
    </div>
    <div class="faq-item">
      <h3>Seberapa sering IBPR sebaiknya ditinjau ulang?</h3>
      <p>PP 50/2012 mewajibkan peninjauan ulang SMK3 secara berkesinambungan, namun tidak menetapkan interval waktu baku untuk setiap dokumen IBPR. Banyak perusahaan meninjau IBPR secara berkala sesuai prosedur internal, dan mempercepat peninjauan bila terjadi perubahan proses kerja, insiden, alat/mesin baru, atau temuan audit.</p>
    </div>
    <div class="faq-item">
      <h3>Apakah hasil dari tool ini bisa langsung dipakai untuk audit SMK3?</h3>
      <p>Tool ini membantu menyusun draf tabel IBPR dengan format dan perhitungan risiko yang konsisten. Sebelum dipakai sebagai dokumen resmi audit, hasilnya tetap perlu ditinjau dan divalidasi oleh Ahli K3 Umum atau HSE Manager yang memahami kondisi aktual pekerjaan, prosedur perusahaan, dan peraturan yang berlaku.</p>
    </div>
  </div>
</section>

<section class="tools-training-cta">
  <div class="container">
    <h2>Tingkatkan Kompetensi K3 Anda</h2>
    <div class="tools-training-grid">
      <div class="tools-training-card">
        <h3><a href="/pelatihan/pelatihan-ahli-k3-umum-sertifikasi-bnsp-online/">Pelatihan Ahli K3 Umum</a></h3>
        <p>Sertifikasi wajib bagi praktisi K3 perusahaan, resmi BNSP, materi regulasi &amp; manajemen risiko.</p>
        <a href="/pelatihan/pelatihan-ahli-k3-umum-sertifikasi-bnsp-online/" class="tools-training-btn">Lihat Program &rarr;</a>
      </div>
      <div class="tools-training-card">
        <h3><a href="/pelatihan/pelatihan-petugas-p3k-sertifikasi-bnsp/">Pelatihan Petugas P3K | Sertifikasi BNSP</a></h3>
        <p>Pelatihan penanganan darurat dan P3K di tempat kerja, sertifikasi BNSP, wajib untuk perusahaan.</p>
        <a href="/pelatihan/pelatihan-petugas-p3k-sertifikasi-bnsp/" class="tools-training-btn">Lihat Program &rarr;</a>
      </div>
      <div class="tools-training-card">
        <h3><a href="/pelatihan/pelatihan-operator-k3-sertifikasi-bnsp/">Pelatihan Operator K3 | Sertifikasi BNSP</a></h3>
        <p>Kompetensi dasar keselamatan kerja untuk operator, sertifikasi resmi BNSP, untuk semua industri.</p>
        <a href="/pelatihan/pelatihan-operator-k3-sertifikasi-bnsp/" class="tools-training-btn">Lihat Program &rarr;</a>
      </div>
      <div class="tools-training-card">
        <h3><a href="/jadwal/">Jadwal Pelatihan Terdekat</a></h3>
        <p>Lihat jadwal batch pelatihan K3 terbaru — online dan offline di berbagai kota.</p>
        <a href="/jadwal/" class="tools-training-btn">Lihat Jadwal &rarr;</a>
      </div>
    </div>
  </div>
</section>

<footer>
  <div class="container">
    <p><a href="/tools/">← Semua Tools K3</a> | <a href="/tools/risk-matrix">Risk Matrix</a> | <a href="/tools/jsa-builder">JSA Builder</a> | <a href="/">Wahana Totalita</a></p>
    <p style="margin-top:8px">© <?php echo date('Y'); ?> Wahana Totalita Konsultan, Yogyakarta</p>
  </div>
</footer>

<a class="wa-float" href="https://wa.me/6287759151278" target="_blank" style="position:fixed;bottom:24px;right:24px;background:#25D366;width:52px;height:52px;border-radius:50%;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 14px rgba(37,211,102,.4);z-index:999">
  <svg viewBox="0 0 24 24" fill="white" width="26" height="26"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
</a>
<div class="toast" id="toast"></div>

<script>
let rowCount = 0;

function getRiskLevel(l,s){
  const score = parseInt(l)*parseInt(s);
  if(!score) return {score:'-',level:'',cls:''};
  if(score<=4) return {score,level:'LOW',cls:'low'};
  if(score<=9) return {score,level:'MEDIUM',cls:'medium'};
  if(score<=16) return {score,level:'HIGH',cls:'high'};
  return {score,level:'EXTREME',cls:'extreme'};
}

function lOpts(){ return [1,2,3,4,5].map(v=>`<option value="${v}">${v}</option>`).join(''); }
function sOpts(){ return [1,2,3,4,5].map(v=>`<option value="${v}">${v}</option>`).join(''); }

function rowTemplate(id){
  return `
    <td class="rownum">${id}</td>
    <td data-label="Aktivitas / Proses"><input type="text" placeholder="cth: Pengelasan" oninput="updateSummary()"></td>
    <td data-label="Identifikasi Bahaya"><input type="text" placeholder="cth: Percikan api" oninput="updateSummary()"></td>
    <td data-label="Risiko / Konsekuensi"><input type="text" placeholder="cth: Kebakaran" oninput="updateSummary()"></td>
    <td data-label="Kontrol Saat Ini"><input type="text" placeholder="cth: APD, briefing K3" oninput="updateSummary()"></td>
    <td class="grp-awal" data-label="L (Awal)"><select class="l1" onchange="calcScore(${id})"><option value="">-</option>${lOpts()}</select></td>
    <td class="grp-awal" data-label="S (Awal)"><select class="s1" onchange="calcScore(${id})"><option value="">-</option>${sOpts()}</select></td>
    <td class="grp-awal score-cell" data-label="Skor Awal" id="sc1-${id}"><span class="empty">—</span></td>
    <td class="grp-sisa" data-label="L (Sisa)"><select class="l2" onchange="calcScore(${id})"><option value="">-</option>${lOpts()}</select></td>
    <td class="grp-sisa" data-label="S (Sisa)"><select class="s2" onchange="calcScore(${id})"><option value="">-</option>${sOpts()}</select></td>
    <td class="grp-sisa score-cell" data-label="Skor Sisa" id="sc2-${id}"><span class="empty">—</span></td>
    <td data-label="Tindakan Tambahan"><input type="text" placeholder="cth: Fire blanket, izin kerja panas" oninput="updateSummary()"></td>
    <td data-label="PIC"><input type="text" placeholder="cth: HSE Officer" oninput="updateSummary()"></td>
    <td class="del-cell"><button class="btn-del-row" onclick="delRow(${id})" aria-label="Hapus baris" title="Hapus baris">✕</button></td>
  `;
}

function addRow(focus){
  rowCount++;
  const tbody = document.getElementById('ibprBody');
  const tr = document.createElement('tr');
  tr.id = `row-${rowCount}`;
  tr.innerHTML = rowTemplate(rowCount);
  tbody.appendChild(tr);
  renumber();
  toggleEmptyState();
  updateSummary();
  if(focus){
    const firstInput = tr.querySelector('input');
    if(firstInput){ firstInput.focus(); tr.scrollIntoView({behavior:'smooth',block:'center'}); }
  }
}

function delRow(id){
  const el = document.getElementById(`row-${id}`);
  if(el) el.remove();
  renumber();
  toggleEmptyState();
  updateSummary();
}

function renumber(){
  document.querySelectorAll('#ibprBody tr').forEach((tr,i)=>{
    const rn = tr.querySelector('.rownum');
    if(rn) rn.textContent = i+1;
  });
}

function toggleEmptyState(){
  const has = document.querySelectorAll('#ibprBody tr').length > 0;
  document.getElementById('emptyState').style.display = has ? 'none' : 'block';
}

function calcScore(id){
  const row = document.getElementById(`row-${id}`);
  if(!row) return;
  const l1 = row.querySelector('.l1')?.value;
  const s1 = row.querySelector('.s1')?.value;
  const l2 = row.querySelector('.l2')?.value;
  const s2 = row.querySelector('.s2')?.value;

  const r1 = getRiskLevel(l1,s1);
  const r2 = getRiskLevel(l2,s2);

  const sc1 = row.querySelector(`[id^="sc1-${id}"]`);
  const sc2 = row.querySelector(`[id^="sc2-${id}"]`);

  if(sc1) sc1.innerHTML = r1.score !== '-' ? `<span class="score-pill ${r1.cls}"><span class="n">${r1.score}</span><span class="l">${r1.level}</span></span>` : '<span class="empty">—</span>';
  if(sc2) sc2.innerHTML = r2.score !== '-' ? `<span class="score-pill ${r2.cls}"><span class="n">${r2.score}</span><span class="l">${r2.level}</span></span>` : '<span class="empty">—</span>';
  updateSummary();
}

function updateSummary(){
  let low=0, med=0, highext=0;
  const matrix = Array.from({length:5},()=>Array(5).fill(0));
  document.querySelectorAll('#ibprBody tr').forEach(tr=>{
    const l1 = tr.querySelector('.l1')?.value;
    const s1 = tr.querySelector('.s1')?.value;
    if(l1 && s1){
      const r = getRiskLevel(l1,s1);
      if(r.cls==='low') low++;
      else if(r.cls==='medium') med++;
      else if(r.cls==='high'||r.cls==='extreme') highext++;
      matrix[parseInt(l1)-1][parseInt(s1)-1]++;
    }
  });
  document.getElementById('sumTotal').textContent = document.querySelectorAll('#ibprBody tr').length;
  document.getElementById('sumLow').textContent = low;
  document.getElementById('sumMed').textContent = med;
  document.getElementById('sumHigh').textContent = highext;
  renderMatrix(matrix);
}

function renderMatrix(matrix){
  const grid = document.getElementById('matrixGrid');
  if(!grid) return;
  let html = `<div></div>`;
  for(let s=1;s<=5;s++) html += `<div class="mx-axis">${s}</div>`;
  for(let l=5;l>=1;l--){
    html += `<div class="mx-axis">${l}</div>`;
    for(let s=1;s<=5;s++){
      const r = getRiskLevel(l,s);
      const count = matrix[l-1][s-1];
      const colorVar = r.cls==='low' ? 'var(--low)' : r.cls==='medium' ? 'var(--med)' : r.cls==='high' ? 'var(--high)' : 'var(--ext)';
      html += `<div class="mx-cell" style="background:${colorVar};opacity:${count>0?1:0.35}">${count>0?count:''}</div>`;
    }
  }
  grid.innerHTML = html;
}

function clearAll(force){
  if(force || confirm('Hapus semua data IBPR yang sudah diisi? Tindakan ini tidak bisa dibatalkan.')){
    document.getElementById('ibprBody').innerHTML='';
    rowCount=0;
    ['project','docNo','docDate','dept','createdBy','approvedBy'].forEach(id=>{
      const el=document.getElementById(id);
      if(el) el.value = id==='docDate' ? new Date().toISOString().split('T')[0] : '';
    });
    addRow(); addRow(); addRow();
    toggleEmptyState();
    updateSummary();
  }
}

function fillRow(id, data){
  const row = document.getElementById(`row-${id}`);
  if(!row) return;
  const inputs = row.querySelectorAll('input');
  inputs[0].value = data.act || '';
  inputs[1].value = data.haz || '';
  inputs[2].value = data.risk || '';
  inputs[3].value = data.ctrl || '';
  inputs[4].value = data.action || '';
  inputs[5].value = data.pic || '';
  if(data.l1) row.querySelector('.l1').value = data.l1;
  if(data.s1) row.querySelector('.s1').value = data.s1;
  if(data.l2) row.querySelector('.l2').value = data.l2;
  if(data.s2) row.querySelector('.s2').value = data.s2;
  calcScore(id);
}

const PRESETS = {
  konstruksi: {
    project:'Proyek Konstruksi Gedung A', dept:'Departemen HSE',
    rows:[
      {act:'Pekerjaan di ketinggian', haz:'Terjatuh dari perancah/atap', risk:'Cedera berat, fatal', ctrl:'Briefing K3, safety line', l1:3,s1:5, action:'Full body harness, inspeksi scaffolding, jaring pengaman', l2:2,s2:4, pic:'Supervisor Sipil'},
      {act:'Scaffolding', haz:'Perancah roboh/komponen lepas', risk:'Cedera berat, kerusakan alat', ctrl:'Pemasangan oleh tim terlatih', l1:2,s1:5, action:'Inspeksi berkala + tagging status aman', l2:1,s2:4, pic:'HSE Officer'},
      {act:'Lifting dengan crane', haz:'Beban jatuh/ayun', risk:'Cedera fatal, kerusakan struktur', ctrl:'Operator bersertifikat', l1:2,s1:5, action:'Lifting plan, rigger bersertifikat, zona eksklusi', l2:1,s2:4, pic:'Rigger Lead'},
      {act:'Galian (excavation)', haz:'Longsor dinding galian', risk:'Tertimbun, cedera berat', ctrl:'Pemeriksaan visual harian', l1:2,s1:4, action:'Shoring/sloping, monitoring gas bila tertutup', l2:1,s2:3, pic:'Supervisor Sipil'},
      {act:'Operasional alat berat', haz:'Pekerja tertabrak/terguling', risk:'Cedera berat, fatal', ctrl:'Jalur akses terpisah', l1:3,s1:4, action:'Spotter, alarm mundur, pemeriksaan alat harian', l2:2,s2:3, pic:'Operator Alat Berat'},
      {act:'Pengelasan', haz:'Percikan api, asap las', risk:'Kebakaran, luka bakar, ISPA', ctrl:'APD standar', l1:3,s1:3, action:'Izin kerja panas, fire watch, exhaust fan', l2:2,s2:2, pic:'Welder Lead'}
    ]
  },
  manufaktur: {
    project:'Lini Produksi Pabrik B', dept:'Departemen Produksi',
    rows:[
      {act:'Pengoperasian mesin press', haz:'Tangan terjepit', risk:'Amputasi, luka berat', ctrl:'Guarding standar', l1:3,s1:5, action:'Two-hand control, interlock guard, LOTO', l2:1,s2:4, pic:'Supervisor Produksi'},
      {act:'Penanganan bahan kimia', haz:'Terpapar/tertumpah bahan kimia', risk:'Iritasi kulit, keracunan', ctrl:'MSDS tersedia', l1:2,s1:4, action:'APD kimia, eyewash station, pelatihan tumpahan', l2:1,s2:3, pic:'HSE Officer'},
      {act:'Kebisingan area produksi', haz:'Paparan bising tinggi', risk:'Gangguan pendengaran', ctrl:'Ear plug disediakan', l1:4,s1:2, action:'Pengukuran kebisingan berkala, rotasi kerja', l2:3,s2:2, pic:'HSE Officer'},
      {act:'Forklift di area produksi', haz:'Tertabrak forklift', risk:'Cedera berat', ctrl:'Jalur pejalan kaki', l1:3,s1:4, action:'Rambu & marka jalur, klakson mundur, operator bersertifikat', l2:2,s2:3, pic:'Supervisor Gudang'}
    ]
  },
  gudang: {
    project:'Gudang Distribusi C', dept:'Departemen Logistik',
    rows:[
      {act:'Penyusunan rak tinggi', haz:'Barang jatuh dari rak', risk:'Cedera kepala', ctrl:'SOP penyusunan barang', l1:3,s1:3, action:'Rak dengan pengaman, pembatasan tinggi tumpukan', l2:2,s2:2, pic:'Kepala Gudang'},
      {act:'Operasional forklift', haz:'Tabrakan/terguling', risk:'Cedera berat', ctrl:'Operator bersertifikat', l1:3,s1:4, action:'Speed limiter, cermin tikungan, jalur khusus', l2:2,s2:3, pic:'Operator Forklift'},
      {act:'Manual handling', haz:'Postur mengangkat salah', risk:'Cedera punggung', ctrl:'Briefing singkat', l1:4,s1:2, action:'Pelatihan manual handling, alat bantu angkat', l2:2,s2:2, pic:'HSE Officer'}
    ]
  },
  tambang: {
    project:'Area Tambang Terbuka D', dept:'Departemen Operasional Tambang',
    rows:[
      {act:'Peledakan (blasting)', haz:'Ledakan tak terkendali, batu terbang', risk:'Fatal, cedera berat', ctrl:'Prosedur peledakan standar', l1:2,s1:5, action:'Zona evakuasi, juru ledak bersertifikat, sirine peringatan', l2:1,s2:4, pic:'Juru Ledak'},
      {act:'Operasional dump truck', haz:'Tabrakan, terguling di jalan tambang', risk:'Fatal, kerusakan alat', ctrl:'Batas kecepatan', l1:3,s1:5, action:'Fatigue management, GPS tracking, inspeksi jalan tambang', l2:2,s2:4, pic:'Supervisor Hauling'},
      {act:'Kerja di area lereng tambang', haz:'Longsor material', risk:'Tertimbun, fatal', ctrl:'Pemantauan visual', l1:2,s1:5, action:'Radar pemantau lereng, larangan area rawan longsor', l2:1,s2:4, pic:'Geoteknik Engineer'},
      {act:'Area terbatas (confined space)', haz:'Kadar oksigen rendah, gas beracun', risk:'Sesak napas, fatal', ctrl:'Izin masuk ruang terbatas', l1:2,s1:5, action:'Gas monitor, ventilasi paksa, standby rescue', l2:1,s2:4, pic:'HSE Officer'}
    ]
  },
  kantor: {
    project:'Kantor Pusat', dept:'Departemen Umum & GA',
    rows:[
      {act:'Kerja di depan komputer (ergonomi)', haz:'Postur duduk salah dalam waktu lama', risk:'Nyeri leher/punggung', ctrl:'Kursi ergonomis tersedia', l1:4,s1:1, action:'Edukasi ergonomi, pengaturan jeda kerja', l2:3,s2:1, pic:'HR/GA'},
      {act:'Instalasi kelistrikan kantor', haz:'Korsleting listrik', risk:'Kebakaran, sengatan listrik', ctrl:'Inspeksi panel berkala', l1:2,s1:4, action:'Pemeliharaan preventif, APAR di setiap lantai', l2:1,s2:3, pic:'Teknisi GA'},
      {act:'Evakuasi keadaan darurat', haz:'Jalur evakuasi terhalang', risk:'Keterlambatan evakuasi', ctrl:'Denah evakuasi terpasang', l1:2,s1:3, action:'Simulasi evakuasi berkala, jalur bebas hambatan', l2:1,s2:2, pic:'HSE/GA'}
    ]
  }
};

function loadPreset(key, isExample){
  const preset = PRESETS[key];
  if(!preset) return;
  document.getElementById('ibprBody').innerHTML='';
  rowCount = 0;
  document.getElementById('project').value = preset.project;
  document.getElementById('dept').value = preset.dept;
  preset.rows.forEach(data=>{
    rowCount++;
    const tbody = document.getElementById('ibprBody');
    const tr = document.createElement('tr');
    tr.id = `row-${rowCount}`;
    tr.innerHTML = rowTemplate(rowCount);
    tbody.appendChild(tr);
    fillRow(rowCount, data);
  });
  renumber();
  toggleEmptyState();
  updateSummary();
  showToast(isExample ? `✅ Contoh IBPR ${labelFor(key)} dimuat` : `✅ Preset ${labelFor(key)} dimuat`);
}

function labelFor(key){
  return {konstruksi:'Konstruksi', manufaktur:'Manufaktur', gudang:'Pergudangan', tambang:'Pertambangan', kantor:'Perkantoran'}[key] || key;
}

function onPresetChange(key){
  if(!key) return;
  loadPreset(key, false);
}

function loadExample(){
  document.getElementById('presetSelect').value = 'konstruksi';
  loadPreset('konstruksi', true);
}

function validateRows(){
  const rows = document.querySelectorAll('#ibprBody tr');
  if(rows.length === 0){
    showToast('⚠️ Tambahkan minimal satu aktivitas sebelum melanjutkan.', true);
    return false;
  }
  let filled = 0;
  rows.forEach(tr=>{ if(tr.querySelector('.l1')?.value && tr.querySelector('.s1')?.value) filled++; });
  if(filled === 0){
    showToast('⚠️ Isi Likelihood & Severity minimal satu baris sebelum mencetak/ekspor.', true);
    return false;
  }
  return true;
}

function doPrint(){
  if(!validateRows()) return;
  window.print();
}

function exportCSV(){
  if(!validateRows()) return;
  const rows = [];
  rows.push('No,Aktivitas,Bahaya,Risiko,Kontrol Saat Ini,L(awal),S(awal),Score(awal),Level(awal),L(sisa),S(sisa),Score(sisa),Level(sisa),Tindakan Tambahan,PIC');
  document.querySelectorAll('#ibprBody tr').forEach((tr,i)=>{
    const inputs = tr.querySelectorAll('input');
    const l1=tr.querySelector('.l1')?.value, s1=tr.querySelector('.s1')?.value;
    const l2=tr.querySelector('.l2')?.value, s2=tr.querySelector('.s2')?.value;
    const r1=getRiskLevel(l1,s1), r2=getRiskLevel(l2,s2);
    rows.push([
      i+1,
      inputs[0]?.value||'', inputs[1]?.value||'', inputs[2]?.value||'', inputs[3]?.value||'',
      l1||'', s1||'', r1.score, r1.level,
      l2||'', s2||'', r2.score, r2.level,
      inputs[4]?.value||'', inputs[5]?.value||''
    ].map(v=>`"${String(v).replace(/"/g,'""')}"`).join(','));
  });
  const csvContent = '\uFEFF' + rows.join('\n');
  try{
    const blob = new Blob([csvContent], {type:'text/csv;charset=utf-8;'});
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    const docNo = document.getElementById('docNo')?.value?.trim();
    a.href = url;
    a.download = (docNo ? docNo : 'IBPR') + '.csv';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
    showToast('✅ CSV berhasil diunduh. Buka dengan Excel/Google Sheets.');
  }catch(e){
    navigator.clipboard.writeText(csvContent).then(()=>showToast('✅ Data disalin sebagai CSV. Paste ke Excel.'));
  }
}

function showToast(msg, warn){
  const t = document.getElementById('toast');
  t.textContent = msg;
  t.className = 'toast show' + (warn ? ' warn' : '');
  setTimeout(()=>{ t.className = 'toast'; }, 3200);
}

// Init: 3 empty rows
addRow(); addRow(); addRow();
</script>
</body>
</html>