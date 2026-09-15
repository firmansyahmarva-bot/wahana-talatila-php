<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/ai-functions.php';

$s = get_all_settings();

$result  = null;
$error   = '';
$loading = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && verify_csrf()) {
    $docText = sanitize($_POST['doc_text'] ?? '');
    $docType = sanitize($_POST['doc_type'] ?? 'general');

    if (strlen($docText) < 50) {
        $error = 'Dokumen terlalu pendek. Minimal 50 karakter.';
    } elseif (strlen($docText) > 8000) {
        $error = 'Dokumen terlalu panjang. Maksimal 8000 karakter.';
    } else {
        $result = ai_analyze_document($docText, $docType);
        if (!$result) {
            // Fallback analysis (no API key)
            $result = fallback_analyze_document($docText, $docType);
        }
    }
}

function fallback_analyze_document(string $text, string $type): array {
    $wordCount = str_word_count($text);
    $issues    = [];
    $strengths = [];

    // Keyword checks
    $k3Keywords = ['k3','keselamatan','kesehatan','kecelakaan','hazard','risiko','apd','p3k','apar','darurat'];
    $foundK3 = array_filter($k3Keywords, fn($kw) => stripos($text, $kw) !== false);

    $legalKeywords = ['pp','permenaker','kepmenaker','uu','peraturan','standar','snk3','iso 45001','ohsas'];
    $foundLegal = array_filter($legalKeywords, fn($kw) => stripos($text, $kw) !== false);

    if (count($foundK3) < 3)  $issues[] = 'Konten K3 minim — tambahkan istilah dan prosedur keselamatan yang lebih spesifik';
    else $strengths[] = 'Terminologi K3 sudah digunakan (' . implode(', ', array_slice(array_values($foundK3), 0, 3)) . ')';

    if (empty($foundLegal)) $issues[] = 'Tidak ada referensi regulasi — sertakan dasar hukum K3 yang berlaku (PP 50/2012, Permenaker, dll)';
    else $strengths[] = 'Mencantumkan referensi regulasi';

    if ($wordCount < 100) $issues[] = 'Dokumen terlalu singkat untuk dokumen K3 formal';
    if (stripos($text, 'prosedur') === false && stripos($text, 'langkah') === false) $issues[] = 'Tidak ada prosedur/langkah kerja yang jelas';
    if (stripos($text, 'darurat') === false && stripos($text, 'emergency') === false) $issues[] = 'Tidak mencantumkan prosedur tanggap darurat';
    if (stripos($text, 'tanggung jawab') !== false || stripos($text, 'penanggung') !== false) $strengths[] = 'Mencantumkan tanggung jawab/penanggung jawab';

    $score = max(20, min(90, 50 + count($strengths)*10 - count($issues)*5));

    return [
        'score'     => $score,
        'grade'     => $score >= 80 ? 'A' : ($score >= 65 ? 'B' : ($score >= 50 ? 'C' : 'D')),
        'summary'   => 'Analisis dokumen berdasarkan standar K3 Indonesia (PP 50/2012, Permenaker No.5/2018).',
        'strengths' => $strengths ?: ['Dokumen telah dibuat'],
        'issues'    => $issues ?: ['Tidak ada masalah mayor terdeteksi'],
        'recommendations' => [
            'Rujuk pada PP No. 50 Tahun 2012 tentang SMK3 untuk kerangka dokumen',
            'Tambahkan identifikasi bahaya dan penilaian risiko (HIRARC)',
            'Cantumkan prosedur tanggap darurat dan titik evakuasi',
            'Sertakan formulir/checklist monitoring berkala',
        ],
        'compliance' => [
            'PP 50/2012 SMK3'   => stripos($text,'smk3') !== false || stripos($text,'sistem manajemen') !== false,
            'ISO 45001:2018'     => stripos($text,'iso 45001') !== false || stripos($text,'ohsas') !== false,
            'Permenaker 5/2018'  => stripos($text,'permenaker') !== false || stripos($text,'higiene') !== false,
            'UU K3 No.1/1970'   => stripos($text,'uu k3') !== false || stripos($text,'keselamatan kerja') !== false,
        ],
        'word_count' => $wordCount,
        'mode'       => 'keyword',
    ];
}
?>
<?php
$page_title = 'AI Analyzer Dokumen K3 — Audit Otomatis Dokumen HSE';
$meta_desc = 'Analisis dokumen K3 Anda secara otomatis dengan AI. Cek compliance, temukan celah, dan dapatkan rekomendasi perbaikan dokumen HSE Anda.';
require __DIR__ . '/../includes/head.php';
?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "SoftwareApplication",
  "applicationCategory": "BusinessApplication",
  "name": "AI Analyzer Dokumen K3 — Audit Otomatis Dokumen HSE",
  "description": "Analisis dokumen K3 Anda secara otomatis dengan AI. Cek compliance, temukan celah, dan dapatkan rekomendasi perbaikan dokumen HSE Anda.",
  "url": "https://wahanatotalita.com/tools/ai-analyzer/",
  "provider": {"@type": "Organization", "name": "Wahana Totalita", "url": "https://wahanatotalita.com"},
  "offers": {"@type": "Offer", "price": "0", "priceCurrency": "IDR"}
}
</script>
<script type="application/ld+json">
{"@context":"https://schema.org","@type":"FAQPage","mainEntity":[{"@type":"Question","name":"Apakah hasil analisis AI ini 100% akurat dan bisa menggantikan Ahli K3?","acceptedAnswer":{"@type":"Answer","text":"Tidak. Alat ini menggunakan analisis berbasis kata kunci dan pola dokumen untuk memberikan gambaran awal kelengkapan dokumen K3 Anda. Untuk kepastian hukum dan kelengkapan sesuai regulasi, dokumen tetap perlu ditinjau oleh Ahli K3 Umum bersertifikat atau HSE Manager."}},{"@type":"Question","name":"Jenis dokumen apa saja yang bisa dianalisis?","acceptedAnswer":{"@type":"Answer","text":"Tool ini mendukung dokumen K3 umum, JSA, HIRARC/identifikasi bahaya, SOP/prosedur kerja, prosedur APAR/kebakaran, prosedur APD, dokumen SMK3, dan laporan kecelakaan kerja."}},{"@type":"Question","name":"Apakah data dokumen yang saya paste disimpan atau dibagikan?","acceptedAnswer":{"@type":"Answer","text":"Teks dokumen digunakan hanya untuk proses analisis pada saat itu juga dan tidak ditujukan untuk publikasi. Untuk dokumen yang bersifat rahasia perusahaan, tetap disarankan menghapus data sensitif (nama klien, angka finansial) sebelum menempelkannya ke tool ini."}}]}
</script>
<link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/style.css">
<?= theme_css_vars($s) ?>
<style>
.tool-hero{background:linear-gradient(135deg,#1e1b4b,#312e81);padding:56px 0;color:#fff;text-align:center}
.tool-hero h1{font-size:clamp(1.8rem,4vw,2.5rem);font-weight:800;margin:0 0 12px}
.tool-hero p{margin:0;opacity:.8;max-width:600px;margin:0 auto;font-size:1rem}
.tool-badges{display:flex;gap:12px;justify-content:center;margin-top:20px;flex-wrap:wrap}
.tool-badge{background:rgba(255,255,255,.12);padding:6px 16px;border-radius:100px;font-size:.8rem}
.tool-content{padding:48px 0}
.tool-layout{display:grid;grid-template-columns:1fr 340px;gap:32px}
.analyzer-card{background:#fff;border-radius:16px;border:1px solid #eee;padding:28px;box-shadow:0 4px 20px rgba(0,0,0,.06)}
.analyzer-card h2{font-size:1.1rem;font-weight:700;margin:0 0 20px;color:#1e1b4b}
.form-group{margin-bottom:16px}
.form-group label{display:block;font-size:.85rem;font-weight:600;color:#333;margin-bottom:6px}
.form-group select,.form-group textarea{width:100%;box-sizing:border-box;padding:11px 14px;border:1.5px solid #ddd;border-radius:10px;font-size:.875rem;font-family:inherit;transition:.2s;background:#fff}
.form-group textarea{resize:vertical;min-height:200px;line-height:1.6}
.form-group select:focus,.form-group textarea:focus{outline:none;border-color:#6366f1}
.char-count{text-align:right;font-size:.75rem;color:#999;margin-top:4px}
.btn-analyze{width:100%;background:linear-gradient(135deg,#6366f1,#4f46e5);color:#fff;border:none;padding:14px;border-radius:10px;font-size:1rem;font-weight:700;cursor:pointer;transition:.2s}
.btn-analyze:hover{opacity:.9;transform:translateY(-1px)}
.error-box{background:#fee2e2;border-radius:8px;padding:14px;color:#991b1b;font-size:.875rem;margin-bottom:16px}
/* Result Styles */
.result-section{margin-top:24px}
.score-display{display:flex;align-items:center;gap:20px;background:linear-gradient(135deg,#1e1b4b,#312e81);color:#fff;border-radius:12px;padding:20px;margin-bottom:20px}
.score-circle{width:80px;height:80px;border-radius:50%;background:conic-gradient(#a5b4fc calc(var(--pct)*3.6deg),rgba(255,255,255,.1) 0deg);display:flex;align-items:center;justify-content:center;flex-direction:column;flex-shrink:0}
.score-circle .grade{font-size:1.8rem;font-weight:900;line-height:1}
.score-circle .pts{font-size:.7rem;opacity:.7}
.result-card{background:#fff;border-radius:12px;border:1px solid #eee;margin-bottom:14px;overflow:hidden}
.result-card-header{padding:12px 18px;border-bottom:1px solid #f0f0f0;font-weight:700;font-size:.9rem;display:flex;gap:8px;align-items:center}
.result-card-body{padding:14px 18px}
.check-item{display:flex;gap:10px;align-items:flex-start;padding:8px 0;border-bottom:1px solid #f5f5f5;font-size:.875rem}
.check-item:last-child{border-bottom:none}
.check-ok{color:#10b981}
.check-bad{color:#ef4444}
.compliance-row{display:flex;align-items:center;justify-content:space-between;padding:8px 0;border-bottom:1px solid #f5f5f5;font-size:.85rem}
.compliance-row:last-child{border-bottom:none}
.comp-badge{padding:3px 10px;border-radius:100px;font-size:.72rem;font-weight:700}
.comp-yes{background:#d1fae5;color:#065f46}
.comp-no{background:#f3f4f6;color:#9ca3af}
/* Sidebar */
.sidebar-card{background:#fff;border-radius:12px;border:1px solid #eee;padding:20px;margin-bottom:16px}
.sidebar-card h3{font-size:.95rem;font-weight:700;margin:0 0 14px;color:#312e81}
.doc-type-list{display:flex;flex-direction:column;gap:8px}
.doc-type-item{display:flex;gap:10px;align-items:flex-start;font-size:.85rem;color:#555}
.tip-list{margin:0;padding-left:20px;font-size:.85rem;color:#555;line-height:2}
@media(max-width:768px){.tool-layout{grid-template-columns:1fr}}
.tools-training-cta{padding:40px 0}
.tools-training-cta h2{font-size:1.3rem;font-weight:800;margin:0 0 16px;text-align:center;color:#0A4A2E}
.tools-training-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(230px,1fr));gap:16px}
.tools-training-card{background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:18px;display:flex;flex-direction:column}
.tools-training-card h3{font-size:.95rem;font-weight:700;margin:0 0 8px}
.tools-training-card h3 a{color:#0A4A2E;text-decoration:none}
.tools-training-card p{font-size:.85rem;color:#555;line-height:1.6;margin:0 0 12px;flex:1}
.tools-training-btn{display:inline-block;background:#0A4A2E;color:#fff;font-weight:700;font-size:.85rem;padding:8px 14px;border-radius:8px;text-decoration:none;text-align:center}
.tool-article{padding:8px 0 40px}
.tool-article h2{font-size:1.15rem;font-weight:800;color:#1e1b4b;margin:28px 0 14px}
.tool-article h2:first-child{margin-top:0}
.tool-article p{font-size:.92rem;color:#374151;line-height:1.8;margin-bottom:14px}
.tool-article ol{padding-left:20px;font-size:.92rem;line-height:1.9;color:#374151;margin-bottom:8px}
.tool-article ol li{margin-bottom:8px}
.faq-item{margin-bottom:16px}
.faq-item h3{font-size:.95rem;font-weight:700;color:#1e1b4b;margin-bottom:6px}
.faq-item p{font-size:.9rem;color:#374151;margin:0}
</style>
<?php include __DIR__ . '/../includes/navbar.php'; ?>

<div class="tool-hero">
  <div class="container">
    <h1>🤖 AI Analyzer Dokumen K3</h1>
    <p>Audit otomatis dokumen HSE Anda — temukan celah compliance, dapatkan rekomendasi perbaikan berbasis standar K3 Indonesia</p>
    <div class="tool-badges">
      <span class="tool-badge">✅ PP 50/2012 SMK3</span>
      <span class="tool-badge">✅ ISO 45001:2018</span>
      <span class="tool-badge">✅ Permenaker 5/2018</span>
      <span class="tool-badge">✅ UU K3 No.1/1970</span>
    </div>
  </div>
</div>

<div class="tool-content">
  <div class="container">
    <div class="tool-layout">
      <div>
        <div class="analyzer-card">
          <h2>📄 Input Dokumen K3 Anda</h2>
          <?php if ($error): ?><div class="error-box">❌ <?= e($error) ?></div><?php endif; ?>
          <form method="POST" id="analyzeForm">
            <?= csrf_field() ?>
            <div class="form-group">
              <label>Jenis Dokumen</label>
              <select name="doc_type">
                <option value="general"  <?= ($_POST['doc_type']??'')=='general'?'selected':'' ?>>📄 Dokumen K3 Umum</option>
                <option value="jsa"      <?= ($_POST['doc_type']??'')=='jsa'?'selected':'' ?>>🔍 Job Safety Analysis (JSA)</option>
                <option value="hirarc"   <?= ($_POST['doc_type']??'')=='hirarc'?'selected':'' ?>>⚠️ HIRARC / Identifikasi Bahaya</option>
                <option value="sop"      <?= ($_POST['doc_type']??'')=='sop'?'selected':'' ?>>📋 SOP / Prosedur Kerja</option>
                <option value="apar"     <?= ($_POST['doc_type']??'')=='apar'?'selected':'' ?>>🔥 Prosedur APAR / Kebakaran</option>
                <option value="apd"      <?= ($_POST['doc_type']??'')=='apd'?'selected':'' ?>>🦺 Prosedur APD</option>
                <option value="smk3"     <?= ($_POST['doc_type']??'')=='smk3'?'selected':'' ?>>🏗️ Dokumen SMK3</option>
                <option value="incident" <?= ($_POST['doc_type']??'')=='incident'?'selected':'' ?>>📊 Laporan Kecelakaan Kerja</option>
              </select>
            </div>
            <div class="form-group">
              <label>Teks Dokumen (paste teks dari dokumen Anda)</label>
              <textarea name="doc_text" id="docText" placeholder="Paste teks dokumen K3 Anda di sini...&#10;&#10;Contoh: Prosedur Keselamatan Pengoperasian Forklift&#10;1. Pastikan operator memiliki SIO (Surat Izin Operasi)&#10;2. Periksa kondisi forklift sebelum digunakan&#10;..."><?= e($_POST['doc_text'] ?? '') ?></textarea>
              <div class="char-count" id="charCount">0 / 8000 karakter</div>
            </div>
            <button type="submit" class="btn-analyze" id="submitBtn">🤖 Analisis Dokumen Sekarang</button>
          </form>

          <!-- Results -->
          <?php if ($result): ?>
          <div class="result-section">
            <div class="score-display" style="--pct:<?= $result['score'] ?>">
              <div class="score-circle">
                <span class="grade"><?= e($result['grade']) ?></span>
                <span class="pts"><?= $result['score'] ?>/100</span>
              </div>
              <div>
                <h3 style="margin:0 0 6px;font-size:1.1rem">Dokumen K3 Score: <?= $result['score'] ?>/100</h3>
                <p style="margin:0;opacity:.8;font-size:.875rem"><?= e($result['summary']) ?></p>
                <?php if (($result['mode'] ?? '') === 'keyword'): ?>
                <p style="margin:6px 0 0;font-size:.75rem;opacity:.5">* Analisis berbasis kata kunci (mode gratis)</p>
                <?php endif; ?>
              </div>
            </div>

            <!-- Strengths -->
            <?php if (!empty($result['strengths'])): ?>
            <div class="result-card">
              <div class="result-card-header" style="background:#f0fdf4"><span>✅</span> Kekuatan Dokumen</div>
              <div class="result-card-body">
                <?php foreach ($result['strengths'] as $s2): ?>
                <div class="check-item"><span class="check-ok">✓</span> <?= e($s2) ?></div>
                <?php endforeach; ?>
              </div>
            </div>
            <?php endif; ?>

            <!-- Issues -->
            <?php if (!empty($result['issues'])): ?>
            <div class="result-card">
              <div class="result-card-header" style="background:#fef2f2"><span>⚠️</span> Celah / Kekurangan</div>
              <div class="result-card-body">
                <?php foreach ($result['issues'] as $issue): ?>
                <div class="check-item"><span class="check-bad">✗</span> <?= e($issue) ?></div>
                <?php endforeach; ?>
              </div>
            </div>
            <?php endif; ?>

            <!-- Recommendations -->
            <?php if (!empty($result['recommendations'])): ?>
            <div class="result-card">
              <div class="result-card-header" style="background:#eff6ff"><span>💡</span> Rekomendasi Perbaikan</div>
              <div class="result-card-body">
                <?php foreach ($result['recommendations'] as $i => $rec): ?>
                <div class="check-item"><span style="color:#3b82f6;font-weight:700"><?= $i+1 ?>.</span> <?= e($rec) ?></div>
                <?php endforeach; ?>
              </div>
            </div>
            <?php endif; ?>

            <!-- Compliance Check -->
            <?php if (!empty($result['compliance'])): ?>
            <div class="result-card">
              <div class="result-card-header" style="background:#f9fafb"><span>📋</span> Compliance Check</div>
              <div class="result-card-body">
                <?php foreach ($result['compliance'] as $reg => $pass): ?>
                <div class="compliance-row">
                  <span><?= e($reg) ?></span>
                  <span class="comp-badge <?= $pass ? 'comp-yes' : 'comp-no' ?>"><?= $pass ? '✓ Terpenuhi' : '✗ Belum' ?></span>
                </div>
                <?php endforeach; ?>
              </div>
            </div>
            <?php endif; ?>

            <!-- CTA -->
            <div style="background:linear-gradient(135deg,var(--green),#1a5c3a);border-radius:12px;padding:20px;color:#fff;text-align:center;margin-top:16px">
              <p style="margin:0 0 12px;font-weight:600">Butuh dokumen K3 yang profesional?</p>
              <a href="<?= wa_url('Halo, saya sudah pakai AI Analyzer dan butuh bantuan perbaikan dokumen K3 perusahaan kami') ?>" style="display:inline-block;background:#fff;color:var(--green);padding:10px 24px;border-radius:8px;text-decoration:none;font-weight:700">💬 Konsultasi dengan Tim K3 Kami</a>
            </div>
          </div>
          <?php endif; ?>
        </div>
      </div>

      <!-- Sidebar -->
      <div>
        <div class="sidebar-card">
          <h3>🔍 Apa yang Dianalisis?</h3>
          <div class="doc-type-list">
            <div class="doc-type-item"><span>✅</span><span>Kelengkapan prosedur dan langkah kerja</span></div>
            <div class="doc-type-item"><span>✅</span><span>Referensi regulasi K3 yang berlaku</span></div>
            <div class="doc-type-item"><span>✅</span><span>Identifikasi bahaya dan risiko</span></div>
            <div class="doc-type-item"><span>✅</span><span>Prosedur tanggap darurat</span></div>
            <div class="doc-type-item"><span>✅</span><span>Tanggung jawab dan penanggung jawab</span></div>
            <div class="doc-type-item"><span>✅</span><span>Compliance PP 50/2012, ISO 45001</span></div>
          </div>
        </div>

        <div class="sidebar-card">
          <h3>💡 Tips Penggunaan</h3>
          <ul class="tip-list">
            <li>Paste teks lengkap dari dokumen Word/PDF</li>
            <li>Semakin lengkap dokumen, semakin akurat analisis</li>
            <li>Pilih jenis dokumen yang tepat</li>
            <li>Gunakan hasil sebagai checklist perbaikan</li>
          </ul>
        </div>

        <div class="sidebar-card">
          <h3>📥 Template K3 Gratis</h3>
          <p style="font-size:.85rem;color:#666;margin:0 0 14px">Download template dokumen K3 yang sudah compliance untuk referensi</p>
          <a href="/resources/" style="display:block;background:var(--green);color:#fff;padding:10px;border-radius:8px;text-decoration:none;font-weight:600;text-align:center;font-size:.875rem">📄 Download Template</a>
        </div>

        <div class="sidebar-card">
          <h3>📅 Pelatihan Penyusunan Dokumen K3</h3>
          <p style="font-size:.85rem;color:#666;margin:0 0 14px">Ingin belajar menyusun dokumen K3 yang benar? Ikuti pelatihan kami.</p>
          <a href="/jadwal/" style="display:block;background:var(--orange);color:#fff;padding:10px;border-radius:8px;text-decoration:none;font-weight:600;text-align:center;font-size:.875rem">📅 Lihat Jadwal</a>
        </div>

        <div class="sidebar-card">
          <h3>🔗 Tools Lainnya</h3>
          <div style="display:flex;flex-direction:column;gap:8px">
            <a href="/tools/social-generator/" style="color:#6366f1;font-weight:600;text-decoration:none;font-size:.875rem">🎨 Social Media K3 Generator</a>
            <a href="/verifikasi/" style="color:var(--green);text-decoration:none;font-size:.875rem">✅ Verifikasi Sertifikat</a>
            <a href="/insiden/" style="color:var(--green);text-decoration:none;font-size:.875rem">📊 Database Insiden K3</a>
            <a href="/glosarium/" style="color:var(--green);text-decoration:none;font-size:.875rem">📖 Glosarium K3</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<section class="tool-article">
  <div class="container">
    <h2>Cara Menggunakan AI Analyzer Dokumen K3</h2>
    <ol>
      <li>Pilih Jenis Dokumen yang ingin dianalisis — dokumen K3 umum, JSA, HIRARC, SOP, prosedur APAR, prosedur APD, dokumen SMK3, atau laporan kecelakaan kerja.</li>
      <li>Salin (copy) seluruh teks dari dokumen Word/PDF Anda, lalu tempel (paste) ke kolom Teks Dokumen.</li>
      <li>Pastikan jumlah karakter antara 50 hingga 8000 karakter — perhatikan indikator jumlah karakter di bawah kolom teks.</li>
      <li>Klik "Analisis Dokumen Sekarang" untuk memulai proses analisis otomatis.</li>
      <li>Tinjau hasil skor dokumen K3, kekuatan dokumen, celah/kekurangan, rekomendasi perbaikan, dan status compliance terhadap regulasi yang berlaku.</li>
      <li>Gunakan hasil analisis sebagai checklist untuk merevisi dokumen sebelum digunakan secara resmi.</li>
    </ol>

    <h2>Manfaat AI Analyzer Dokumen K3 untuk Keselamatan Kerja</h2>
    <p>Banyak perusahaan memiliki dokumen K3 — SOP, JSA, HIRARC, prosedur darurat — namun tidak pernah benar-benar diperiksa apakah dokumen tersebut sudah memenuhi standar minimum regulasi K3 di Indonesia. AI Analyzer Dokumen K3 membantu HSE Officer melakukan pengecekan cepat sebelum dokumen digunakan secara resmi atau diajukan dalam audit, tanpa harus menunggu jadwal review manual yang seringkali tertunda.</p>
    <p>Alat ini memeriksa beberapa aspek penting sekaligus — kelengkapan prosedur kerja, referensi regulasi yang dicantumkan, identifikasi bahaya, prosedur tanggap darurat, hingga kejelasan penanggung jawab. Setiap aspek yang belum lengkap akan ditandai sebagai "celah" beserta rekomendasi konkret untuk memperbaikinya.</p>
    <p>Dengan skor dan grade yang jelas (A sampai D), tim K3 dapat memprioritaskan dokumen mana yang perlu direvisi terlebih dahulu, terutama menjelang audit SMK3 internal maupun eksternal, atau sebelum dokumen dijadikan acuan kerja di lapangan.</p>
    <p>Penggunaan alat ini bukan pengganti kajian oleh Ahli K3 Umum bersertifikat, namun sangat membantu sebagai langkah awal quality control dokumen sebelum masuk ke proses review resmi — menghemat waktu dan mengurangi risiko dokumen K3 yang tidak lengkap lolos ke lapangan.</p>

    <h2>Dasar Hukum yang Relevan</h2>
    <p>Kewajiban penyusunan dan pendokumentasian sistem K3 yang lengkap diatur dalam PP No. 50 Tahun 2012 tentang Penerapan SMK3, yang mensyaratkan dokumentasi mencakup kebijakan K3, perencanaan, penerapan, pemantauan, serta tinjauan manajemen. Standar internasional ISO 45001:2018 juga menjadi acuan tambahan bagi perusahaan yang ingin menyelaraskan dokumen K3 dengan praktik global. Dokumen yang tidak memuat unsur-unsur ini berisiko dianggap tidak lengkap saat diperiksa oleh pengawas ketenagakerjaan atau auditor eksternal, sehingga pengecekan berkala menjadi bagian penting dari tata kelola dokumen K3 perusahaan.</p>

    <h2>Pertanyaan Umum</h2>
    <div class="faq-item">
      <h3>Apakah hasil analisis AI ini 100% akurat dan bisa menggantikan Ahli K3?</h3>
      <p>Tidak. Alat ini menggunakan analisis berbasis kata kunci dan pola dokumen untuk memberikan gambaran awal kelengkapan dokumen K3 Anda. Untuk kepastian hukum dan kelengkapan sesuai regulasi, dokumen tetap perlu ditinjau oleh Ahli K3 Umum bersertifikat atau HSE Manager.</p>
    </div>
    <div class="faq-item">
      <h3>Jenis dokumen apa saja yang bisa dianalisis?</h3>
      <p>Tool ini mendukung dokumen K3 umum, JSA, HIRARC/identifikasi bahaya, SOP/prosedur kerja, prosedur APAR/kebakaran, prosedur APD, dokumen SMK3, dan laporan kecelakaan kerja.</p>
    </div>
    <div class="faq-item">
      <h3>Apakah data dokumen yang saya paste disimpan atau dibagikan?</h3>
      <p>Teks dokumen digunakan hanya untuk proses analisis pada saat itu juga dan tidak ditujukan untuk publikasi. Untuk dokumen yang bersifat rahasia perusahaan, tetap disarankan menghapus data sensitif (nama klien, angka finansial) sebelum menempelkannya ke tool ini. Sebagai praktik keamanan tambahan, gunakan versi dokumen yang sudah digeneralisasi terlebih dahulu jika dokumen asli memuat informasi yang sangat sensitif.</p>
    </div>
  </div>
</section>

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
const ta = document.getElementById('docText');
const cc = document.getElementById('charCount');
const btn = document.getElementById('submitBtn');
if (ta && cc) {
  ta.addEventListener('input', () => {
    const len = ta.value.length;
    cc.textContent = len + ' / 8000 karakter';
    cc.style.color = len > 7000 ? '#ef4444' : '#999';
  });
  // Trigger on load
  ta.dispatchEvent(new Event('input'));
}
document.getElementById('analyzeForm')?.addEventListener('submit', () => {
  if (btn) { btn.textContent = '⏳ Menganalisis...'; btn.disabled = true; }
});
</script>
</body></html>
