<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/regulasi-data.php';

$s = get_all_settings();

// Filters
$search   = trim($_GET['q'] ?? '');
$jenis    = trim($_GET['jenis'] ?? '');
$kategori = trim($_GET['kategori'] ?? '');

$filter = [];
if ($search !== '')   $filter['search']   = $search;
if ($jenis !== '')    $filter['jenis']    = $jenis;
if ($kategori !== '') $filter['kategori'] = $kategori;

$regulasiList = get_all_regulasi($filter);
$totalFound   = count($regulasiList);
$allCategories= get_regulasi_categories();
$allTypes     = get_regulasi_types();

$metaTitle = 'Pusat Regulasi K3 & Ketenagakerjaan Indonesia | Dasar Hukum & Kepatuhan';
$metaDesc  = 'Database lengkap undang-undang, PP, Permenaker, Kepmenaker, dan regulasi lingkungan hidup K3 Indonesia. Dilengkapi ringkasan pasal penting, kewajiban industri, dan sanksi.';
$canonical = SITE_URL . '/regulasi/';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($metaTitle) ?></title>
<meta name="description" content="<?= e($metaDesc) ?>">
<link rel="canonical" href="<?= $canonical ?>">
<link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/style.css">
<?= theme_css_vars($s) ?>
<style>
/* Regulasi Hub Styling */
.reg-hero {
    background: linear-gradient(135deg, #0f5132 0%, #157347 100%);
    color: #ffffff;
    padding: 60px 0 50px;
    text-align: center;
}
.reg-hero h1 {
    font-size: clamp(1.8rem, 3.5vw, 2.7rem);
    font-weight: 800;
    margin: 0 0 14px;
    line-height: 1.25;
}
.reg-hero p {
    font-size: 1.05rem;
    opacity: 0.9;
    max-width: 720px;
    margin: 0 auto 28px;
    line-height: 1.6;
}
.reg-stats-row {
    display: flex;
    justify-content: center;
    gap: 32px;
    flex-wrap: wrap;
    margin-top: 24px;
}
.reg-stat-box {
    background: rgba(255, 255, 255, 0.12);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 12px;
    padding: 12px 24px;
    min-width: 140px;
}
.reg-stat-box strong {
    display: block;
    font-size: 1.8rem;
    font-weight: 800;
    color: #ffd166;
}
.reg-stat-box span {
    font-size: 0.85rem;
    opacity: 0.9;
}

/* Search bar */
.reg-search-form {
    background: #ffffff;
    border-radius: 12px;
    padding: 6px;
    display: flex;
    gap: 8px;
    max-width: 640px;
    margin: 0 auto;
    box-shadow: 0 8px 24px rgba(0,0,0,0.18);
}
.reg-search-form input {
    flex: 1;
    border: none;
    outline: none;
    padding: 12px 18px;
    font-size: 1rem;
    color: #1f2937;
    background: transparent;
}
.reg-search-form button {
    background: var(--orange, #f97316);
    color: #ffffff;
    border: none;
    padding: 12px 24px;
    border-radius: 8px;
    font-weight: 700;
    cursor: pointer;
    transition: background 0.2s;
}
.reg-search-form button:hover {
    background: #ea580c;
}

/* Filter Section */
.reg-filter-bar {
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
    padding: 18px 0;
}
.reg-filter-group {
    margin-bottom: 10px;
}
.reg-filter-group:last-child {
    margin-bottom: 0;
}
.reg-filter-label {
    font-size: 0.8rem;
    font-weight: 700;
    text-transform: uppercase;
    color: #64748b;
    margin-bottom: 6px;
    letter-spacing: 0.05em;
}
.reg-chip-row {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
    align-items: center;
}
.reg-chip {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 14px;
    border-radius: 999px;
    background: #ffffff;
    border: 1px solid #cbd5e1;
    color: #334155;
    font-size: 0.85rem;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s ease;
}
.reg-chip:hover {
    border-color: #0f5132;
    color: #0f5132;
}
.reg-chip.active {
    background: #0f5132;
    color: #ffffff;
    border-color: #0f5132;
    font-weight: 600;
}

/* Regulation Cards Grid */
.reg-main-content {
    padding: 44px 0 60px;
}
.reg-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 24px;
}
.reg-card {
    background: #ffffff;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    display: flex;
    flex-direction: column;
    overflow: hidden;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.reg-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 24px rgba(0, 0, 0, 0.08);
}
.reg-card-header {
    padding: 16px 20px;
    border-bottom: 1px solid #f1f5f9;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.reg-badge-type {
    display: inline-block;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    padding: 4px 10px;
    border-radius: 6px;
    letter-spacing: 0.03em;
}
.badge-uu { background: #dcfce7; color: #15803d; }
.badge-pp { background: #dbeafe; color: #1e40af; }
.badge-permenaker { background: #ffedd5; color: #c2410c; }
.badge-kepmenaker { background: #f3e8ff; color: #7e22ce; }
.badge-esdm { background: #fef3c7; color: #b45309; }
.badge-lhk { background: #ccfbf1; color: #0f766e; }
.badge-iso { background: #e0e7ff; color: #4338ca; }

.reg-year {
    font-size: 0.85rem;
    font-weight: 600;
    color: #64748b;
}
.reg-card-body {
    padding: 20px;
    flex: 1;
    display: flex;
    flex-direction: column;
}
.reg-card-title {
    font-size: 1.15rem;
    font-weight: 700;
    color: #0f172a;
    margin: 0 0 8px;
    line-height: 1.35;
}
.reg-card-tentang {
    font-size: 0.92rem;
    font-weight: 600;
    color: #0f5132;
    margin: 0 0 12px;
    line-height: 1.4;
}
.reg-card-summary {
    font-size: 0.875rem;
    color: #475569;
    line-height: 1.55;
    margin: 0 0 16px;
    flex: 1;
}
.reg-card-footer {
    padding-top: 14px;
    border-top: 1px solid #f1f5f9;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.reg-cat-tag {
    font-size: 0.78rem;
    font-weight: 600;
    color: #64748b;
    background: #f1f5f9;
    padding: 3px 8px;
    border-radius: 4px;
}
.reg-link-btn {
    font-size: 0.88rem;
    font-weight: 700;
    color: #0f5132;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}
.reg-link-btn:hover {
    color: var(--orange, #f97316);
    text-decoration: underline;
}

/* Featured Training Hub Section */
.featured-pelatihan-section {
    background: #f1f5f9;
    padding: 56px 0 64px;
    border-top: 1px solid #e2e8f0;
}
.featured-section-title {
    text-align: center;
    margin-bottom: 36px;
}
.featured-section-title h2 {
    font-size: 1.85rem;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 8px;
}
.featured-section-title p {
    font-size: 1rem;
    color: #64748b;
    max-width: 600px;
    margin: 0 auto;
}
.featured-training-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
}
.ft-card {
    background: #ffffff;
    border-radius: 12px;
    padding: 24px;
    border: 1px solid #cbd5e1;
    display: flex;
    flex-direction: column;
    box-shadow: 0 2px 6px rgba(0,0,0,0.04);
}
.ft-badge {
    display: inline-block;
    background: #dcfce7;
    color: #166534;
    font-size: 0.75rem;
    font-weight: 700;
    padding: 3px 8px;
    border-radius: 4px;
    margin-bottom: 12px;
    align-self: flex-start;
}
.ft-title {
    font-size: 1.05rem;
    font-weight: 700;
    color: #0f172a;
    margin: 0 0 8px;
    line-height: 1.35;
}
.ft-desc {
    font-size: 0.85rem;
    color: #64748b;
    line-height: 1.5;
    margin: 0 0 16px;
    flex: 1;
}
.ft-btn {
    display: block;
    text-align: center;
    background: #0f5132;
    color: #ffffff;
    font-weight: 700;
    font-size: 0.88rem;
    padding: 10px 16px;
    border-radius: 8px;
    text-decoration: none;
    transition: background 0.2s;
}
.ft-btn:hover {
    background: var(--orange, #f97316);
}
</style>
</head>
<body>
<?php include __DIR__ . '/../includes/navbar.php'; ?>

<section class="reg-hero">
    <div class="container">
        <h1>⚖️ Pusat Regulasi K3 & Ketenagakerjaan</h1>
        <p>Akses direktori hukum keselamatan kerja, higiene industri, baku mutu lingkungan hidup, dan pertambangan Indonesia dengan analisis pasal, kewajiban korporasi, dan kepatuhan.</p>
        
        <form class="reg-search-form" action="/regulasi/" method="GET">
            <?php if ($jenis): ?><input type="hidden" name="jenis" value="<?= e($jenis) ?>"><?php endif; ?>
            <?php if ($kategori): ?><input type="hidden" name="kategori" value="<?= e($kategori) ?>"><?php endif; ?>
            <input type="text" name="q" value="<?= e($search) ?>" placeholder="Cari nomor aturan, kata kunci, misal: kebisingan, limbah b3, forklift, smk3...">
            <button type="submit">Cari Regulasi</button>
        </form>

        <div class="reg-stats-row">
            <div class="reg-stat-box">
                <strong><?= count(get_regulasi_dataset()) ?>+</strong>
                <span>Regulasi Terverifikasi</span>
            </div>
            <div class="reg-stat-box">
                <strong>100%</strong>
                <span>Hukum Resmi Berlaku</span>
            </div>
            <div class="reg-stat-box">
                <strong>Kemnaker & KLHK</strong>
                <span>Rujukan Sah Industri</span>
            </div>
        </div>
    </div>
</section>

<!-- Filter Section -->
<section class="reg-filter-bar">
    <div class="container">
        <!-- Jenis Filter -->
        <div class="reg-filter-group">
            <div class="reg-filter-label">Berdasarkan Jenis Aturan:</div>
            <div class="reg-chip-row">
                <a href="/regulasi/<?= $kategori ? '?kategori='.urlencode($kategori) : '' ?>" class="reg-chip <?= $jenis === '' ? 'active' : '' ?>">Semua Jenis</a>
                <?php foreach ($allTypes as $t): ?>
                <a href="?<?= http_build_query(array_merge($_GET, ['jenis' => $t, 'q' => $search])) ?>" class="reg-chip <?= strcasecmp($jenis, $t) === 0 ? 'active' : '' ?>"><?= e($t) ?></a>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Kategori Filter -->
        <div class="reg-filter-group" style="margin-top:12px;">
            <div class="reg-filter-label">Berdasarkan Bidang / Kategori:</div>
            <div class="reg-chip-row">
                <a href="/regulasi/<?= $jenis ? '?jenis='.urlencode($jenis) : '' ?>" class="reg-chip <?= $kategori === '' ? 'active' : '' ?>">Semua Bidang</a>
                <?php foreach ($allCategories as $c): ?>
                <a href="?<?= http_build_query(array_merge($_GET, ['kategori' => $c, 'q' => $search])) ?>" class="reg-chip <?= strcasecmp($kategori, $c) === 0 ? 'active' : '' ?>"><?= e($c) ?></a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- Main List -->
<section class="reg-main-content">
    <div class="container">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
            <h2 style="font-size:1.35rem; font-weight:700; color:#1e293b; margin:0;">
                <?php if ($search || $jenis || $kategori): ?>
                    Hasil Pencarian: <?= $totalFound ?> Dokumen Ditemukan
                <?php else: ?>
                    Daftar Lengkap Regulasi K3 & Ketenagakerjaan
                <?php endif; ?>
            </h2>
            <?php if ($search || $jenis || $kategori): ?>
            <a href="/regulasi/" style="font-size:0.88rem; color:#dc2626; font-weight:600; text-decoration:none;">✕ Reset Filter</a>
            <?php endif; ?>
        </div>

        <?php if (empty($regulasiList)): ?>
        <div style="text-align:center; padding:60px 20px; background:#f8fafc; border-radius:12px; border:1px dashed #cbd5e1;">
            <div style="font-size:3rem; margin-bottom:12px;">🔍</div>
            <h3 style="color:#334155; margin:0 0 8px;">Tidak Ada Regulasi yang Cocok</h3>
            <p style="color:#64748b; margin:0 0 16px;">Silakan coba kata kunci lain atau bersihkan filter jenis dan bidang Anda.</p>
            <a href="/regulasi/" class="reg-chip active" style="display:inline-block;">Lihat Seluruh Regulasi</a>
        </div>
        <?php else: ?>
        <div class="reg-grid">
            <?php foreach ($regulasiList as $r): ?>
                <?php
                $badgeClass = 'badge-uu';
                if (stripos($r['jenis'], 'Pemerintah') !== false) $badgeClass = 'badge-pp';
                elseif (stripos($r['jenis'], 'Permenaker') !== false) $badgeClass = 'badge-permenaker';
                elseif (stripos($r['jenis'], 'Kepmenaker') !== false) $badgeClass = 'badge-kepmenaker';
                elseif (stripos($r['jenis'], 'ESDM') !== false) $badgeClass = 'badge-esdm';
                elseif (stripos($r['jenis'], 'LHK') !== false || stripos($r['jenis'], 'LH') !== false) $badgeClass = 'badge-lhk';
                elseif (stripos($r['jenis'], 'ISO') !== false || stripos($r['jenis'], 'SNI') !== false) $badgeClass = 'badge-iso';
                ?>
                <div class="reg-card">
                    <div class="reg-card-header">
                        <span class="reg-badge-type <?= $badgeClass ?>"><?= e($r['jenis']) ?></span>
                        <span class="reg-year">Tahun <?= e($r['tahun']) ?></span>
                    </div>
                    <div class="reg-card-body">
                        <h3 class="reg-card-title"><?= e($r['nomor']) ?></h3>
                        <div class="reg-card-tentang">Tentang: <?= e($r['tentang']) ?></div>
                        <p class="reg-card-summary"><?= e($r['ringkasan']) ?></p>
                        <div class="reg-card-footer">
                            <span class="reg-cat-tag"><?= e($r['kategori']) ?></span>
                            <a href="/regulasi/<?= e($r['slug']) ?>/" class="reg-link-btn">
                                Ringkasan & Pasal &rarr;
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Featured Pelatihan Section (Required: show pelatihan at that hub) -->
<section class="featured-pelatihan-section">
    <div class="container">
        <div class="featured-section-title">
            <h2>🎓 Program Pembinaan & Sertifikasi Terkait Regulasi</h2>
            <p>Penuhi syarat hukum ketenagakerjaan dan hindari sanksi dengan menempatkan personil yang memiliki lisensi resmi Kemnaker RI & BNSP.</p>
        </div>
        <div class="featured-training-grid">
            <div class="ft-card">
                <span class="ft-badge">Sertifikasi BNSP</span>
                <h3 class="ft-title">Ahli K3 BNSP</h3>
                <p class="ft-desc">Pemenuhan dasar hukum UU No. 1 Tahun 1970 dan PP No. 50 Tahun 2012 untuk kompetensi personil keselamatan kerja tingkat korporasi.</p>
                <a href="/pelatihan/ak3-bnsp/" class="ft-btn">Lihat Silabus Program &rarr;</a>
            </div>

            <div class="ft-card">
                <span class="ft-badge">Sertifikasi Kemnaker RI</span>
                <h3 class="ft-title">Auditor SMK3 Kemnaker</h3>
                <p class="ft-desc">Pelatihan resmi pelaksanaan audit sistem manajemen keselamatan kerja sesuai mandat PP 50/2012 untuk 166 kriteria evaluasi.</p>
                <a href="/pelatihan/pelatihan-auditor-sistem-manajemen-k3-sertifikasi-kemnaker-ri/" class="ft-btn">Lihat Silabus Program &rarr;</a>
            </div>

            <div class="ft-card">
                <span class="ft-badge">Sertifikasi BNSP</span>
                <h3 class="ft-title">POPAL (Penanggung Jawab Air Limbah)</h3>
                <p class="ft-desc">Mandat pemenuhan PP No. 22 Tahun 2021 dan Permen LH No. 5 Tahun 2014 untuk operasional IPAL industri bebas sanksi pencemaran.</p>
                <a href="/pelatihan/pelatihan-penanggung-jawab-operasional-pengolahan-air-limbah-popal-sertifikasi-bnsp/" class="ft-btn">Lihat Silabus Program &rarr;</a>
            </div>

            <div class="ft-card">
                <span class="ft-badge">Sertifikasi BNSP / ESDM</span>
                <h3 class="ft-title">POP Pertambangan Minerba</h3>
                <p class="ft-desc">Sertifikasi frontliner pengawas tambang wajib Kepmen ESDM No. 1827/2018 dan Kepdirjen Minerba No. 185/2019.</p>
                <a href="/pelatihan/pelatihan-pengawas-operasional-pertama-pop-pertambangan-sertifikasi-bnsp/" class="ft-btn">Lihat Silabus Program &rarr;</a>
            </div>

            <div class="ft-card">
                <span class="ft-badge">Sertifikasi BNSP</span>
                <h3 class="ft-title">Pengawas K3 Migas</h3>
                <p class="ft-desc">Kepatuhan standar PTK 005 SKK Migas dan CSMS untuk pengawasan operasi rig onshore maupun offshore.</p>
                <a href="/pelatihan/pelatihan-pengawas-k3-migas-sertifikasi-bnsp/" class="ft-btn">Lihat Silabus Program &rarr;</a>
            </div>

            <div class="ft-card">
                <span class="ft-badge">Sertifikasi Kemnaker RI</span>
                <h3 class="ft-title">Petugas P3K di Tempat Kerja</h3>
                <p class="ft-desc">Mandat wajib Permenaker No. 15 Tahun 2008 untuk penyediaan personil pertolongan pertama berlisensi di setiap unit kerja.</p>
                <a href="/pelatihan/pelatihan-petugas-p3k-sertifikasi-kemnaker-ri/" class="ft-btn">Lihat Silabus Program &rarr;</a>
            </div>
        </div>
    </div>
<!-- Educational Regulatory Guide & Legal Hierarchy Section -->
<section style="background:#ffffff; padding:60px 0; border-top:1px solid #e2e8f0;">
    <div class="container" style="max-width:960px;">
        <h2 style="font-size:1.8rem; font-weight:800; color:#0f172a; margin-bottom:16px; text-align:center;">
            📚 Panduan Hierarki Hukum & Kepatuhan K3 di Indonesia
        </h2>
        <p style="font-size:1rem; color:#475569; line-height:1.7; text-align:center; margin-bottom:36px;">
            Sistem perundang-undangan Keselamatan dan Kesehatan Kerja (K3) di Indonesia disusun secara berjenjang untuk memastikan perlindungan menyeluruh bagi setiap tenaga kerja di seluruh sektor industri.
        </p>

        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(280px, 1fr)); gap:24px; margin-bottom:40px;">
            <div style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:10px; padding:20px;">
                <h3 style="font-size:1.1rem; font-weight:700; color:#0f5132; margin:0 0 8px;">1. Tingkat Undang-Undang (UU)</h3>
                <p style="font-size:0.9rem; color:#475569; line-height:1.6; margin:0;">
                    Landasan payung hukum tertinggi, seperti <strong>UU No. 1 Tahun 1970</strong> (Keselamatan Kerja), <strong>UU No. 13 Tahun 2003</strong> (Ketenagakerjaan), dan <strong>UU No. 32 Tahun 2009</strong> (PPLH) yang memuat hak konstitusional dan tanggung jawab pidana pengurus.
                </p>
            </div>

            <div style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:10px; padding:20px;">
                <h3 style="font-size:1.1rem; font-weight:700; color:#1e40af; margin:0 0 8px;">2. Peraturan Pemerintah (PP)</h3>
                <p style="font-size:0.9rem; color:#475569; line-height:1.6; margin:0;">
                    Aturan pelaksanaan operasional lintas kementerian, seperti <strong>PP No. 50 Tahun 2012</strong> tentang SMK3 dan <strong>PP No. 22 Tahun 2021</strong> tentang Persetujuan Lingkungan dan Limbah B3.
                </p>
            </div>

            <div style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:10px; padding:20px;">
                <h3 style="font-size:1.1rem; font-weight:700; color:#c2410c; margin:0 0 8px;">3. Peraturan Menteri (Permen)</h3>
                <p style="font-size:0.9rem; color:#475569; line-height:1.6; margin:0;">
                    Standar teknis spesifik yang diterbitkan oleh Kementerian Ketenagakerjaan (Permenaker), Kementerian ESDM, dan Kementerian LHK mengenai kualifikasi operator, izin alat (SILO), dan ambang batas lingkungan.
                </p>
            </div>
        </div>

        <div style="background:#f0fdf4; border:1px solid #bbf7d0; border-radius:12px; padding:28px; margin-bottom:44px;">
            <h3 style="font-size:1.25rem; font-weight:700; color:#166534; margin:0 0 12px;">
                🏢 5 Kewajiban Pokok K3 bagi Setiap Manajemen Perusahaan
            </h3>
            <ul style="color:#166534; font-size:0.95rem; line-height:1.75; margin:0; padding-left:20px;">
                <li><strong>Membentuk Panitia Pembina K3 (P2K3)</strong> dan menunjuk personil Ahli K3 Umum ber-SKP aktif sebagai sekretaris (Permenaker 04/1987).</li>
                <li><strong>Menerapkan Sistem Manajemen K3 (SMK3)</strong> bagi tempat kerja dengan minimal 100 buruh atau berpotensi bahaya tinggi (PP 50/2012).</li>
                <li><strong>Menyediakan Surat Izin Layak Operasi (SILO)</strong> dan Lisensi K3 (SIO) untuk seluruh operator forklift, boiler, genset, dan bejana tekan.</li>
                <li><strong>Menempatkan Petugas P3K Berlisensi</strong> dan menyediakan kotak P3K sesuai rasio jumlah tenaga kerja (Permenaker 15/2008).</li>
                <li><strong>Melakukan Pemeriksaan & Pengujian (Riksa Uji)</strong> berkala terhadap seluruh instalasi listrik, penyalur petir, dan lingkungan kerja minimal 1 tahun sekali.</li>
            </ul>
        </div>

        <!-- FAQ Hub Section -->
        <h3 style="font-size:1.4rem; font-weight:700; color:#0f172a; margin-bottom:20px; text-align:center;">
            ❓ Tanya Jawab Seputar Regulasi K3 di Indonesia
        </h3>
        <div style="display:flex; flex-direction:column; gap:12px;">
            <div style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:8px; padding:18px 20px;">
                <h4 style="margin:0 0 8px; font-size:1rem; color:#0f172a;">Apa akibat hukum jika perusahaan tidak menerapkan K3?</h4>
                <p style="margin:0; font-size:0.9rem; color:#475569; line-height:1.6;">
                    Perusahaan berisiko dikenakan sanksi pidana kurungan, denda, penghentian sementara kegiatan operasional oleh Pengawas Ketenagakerjaan, hingga penutupan tempat kerja serta tanggung jawab perdata penuh bila terjadi kecelakaan fatal.
                </p>
            </div>

            <div style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:8px; padding:18px 20px;">
                <h4 style="margin:0 0 8px; font-size:1rem; color:#0f172a;">Apakah sertifikat kompetensi K3 wajib diperpanjang secara berkala?</h4>
                <p style="margin:0; font-size:0.9rem; color:#475569; line-height:1.6;">
                    Ya. Surat Keputusan Penunjukan (SKP) Ahli K3 dan Lisensi K3 Kemnaker umumnya memiliki masa berlaku 3 hingga 5 tahun dan wajib diperpanjang dengan menyertakan bukti laporan kegiatan kerja K3 periodik.
                </p>
            </div>

            <div style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:8px; padding:18px 20px;">
                <h4 style="margin:0 0 8px; font-size:1rem; color:#0f172a;">Bagaimana cara memastikan seluruh regulasi K3 terpenuhi di perusahaan?</h4>
                <p style="margin:0; font-size:0.9rem; color:#475569; line-height:1.6;">
                    Perusahaan dapat melakukan gap analysis kepatuhan hukum melalui audit internal SMK3, menyusun register regulasi K3 yang terus diperbarui, dan bermitra dengan konsultan terpercaya seperti Wahana Totalita untuk in-house training dan sertifikasi resmi.
                </p>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
<script src="<?= SITE_URL ?>/assets/js/main.js"></script>
</body>
</html>
