<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/skkni-functions.php';

$slug = trim($_GET['slug'] ?? '');
if (!$slug) {
    header('Location: ' . SITE_URL . '/skkni/', true, 301);
    exit;
}

$item = get_skkni_item($slug);
if (!$item) {
    http_response_code(404);
    include __DIR__ . '/../404.php';
    exit;
}

$s = get_all_settings();

$canonical = SITE_URL . '/skkni/' . $item['slug'] . '/';

// SERP-optimized Title (under 65 chars) & Meta Description (140-158 chars)
$judul = $item['judul'];
if (mb_strlen($judul) <= 38) {
    $metaTitle = $judul . ' - SKKNI & BNSP';
} elseif (mb_strlen($judul) <= 50) {
    $metaTitle = $judul . ' | SKKNI BNSP';
} else {
    $metaTitle = mb_strimwidth($judul, 0, 48, '...') . ' | SKKNI BNSP';
}

$metaDesc = 'Standar kompetensi SKKNI ' . $judul . '. Pelajari daftar unit BNSP, syarat asesmen, uraian tugas kerja, dan standar gaji industri terverifikasi.';
if (mb_strlen($metaDesc) > 158) {
    $metaDesc = mb_strimwidth($metaDesc, 0, 155, '...');
}

// Related professions
$related = get_related_skkni($item['slug'], $item['sektor'], 4);

// WA consultation link
$waNumber = $s['wa_number'] ?? '6287759151278';
$waText   = urlencode("Halo Wahana Totalita, kami ingin konsultasi pelatihan dan uji kompetensi BNSP untuk profesi: " . $item['judul']);
$waUrl    = "https://wa.me/{$waNumber}?text={$waText}";

// Prepare JSON-LD Schema
$schemaFaqs = [];
if (!empty($item['faqs'])) {
    foreach ($item['faqs'] as $faq) {
        $schemaFaqs[] = [
            '@type' => 'Question',
            'name' => $faq['q'],
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => $faq['a']
            ]
        ];
    }
}

$jsonLd = [
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'EducationalOccupationalCredential',
            '@id' => $canonical . '#credential',
            'name' => $item['judul'],
            'credentialCategory' => 'Sertifikat Kompetensi Kerja BNSP',
            'educationalLevel' => $item['jenjang_kkni'],
            'recognizedBy' => [
                '@type' => 'GovernmentOrganization',
                'name' => 'Badan Nasional Sertifikasi Profesi (BNSP)'
            ],
            'description' => $item['ringkasan'],
            'url' => $canonical
        ],
        [
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                [
                    '@type' => 'ListItem',
                    'position' => 1,
                    'name' => 'Beranda',
                    'item' => SITE_URL . '/'
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 2,
                    'name' => 'Standar Kompetensi SKKNI',
                    'item' => SITE_URL . '/skkni/'
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 3,
                    'name' => $item['judul'],
                    'item' => $canonical
                ]
            ]
        ],
        [
            '@type' => 'FAQPage',
            'mainEntity' => $schemaFaqs
        ]
    ]
];
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
<script type="application/ld+json"><?= json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
<style>
/* SKKNI Detail Styling */
.skkni-header {
    background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 60%, #1e40af 100%);
    color: #ffffff;
    padding: 48px 0 44px;
}
.skkni-breadcrumb {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.85rem;
    margin-bottom: 20px;
    flex-wrap: wrap;
}
.skkni-breadcrumb a {
    color: #93c5fd;
    text-decoration: none;
}
.skkni-breadcrumb a:hover {
    color: #ffffff;
    text-decoration: underline;
}
.skkni-breadcrumb span.sep {
    color: #64748b;
}
.skkni-breadcrumb span.current {
    color: #cbd5e1;
}

.skkni-badges {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 14px;
    flex-wrap: wrap;
}
.skkni-badge-tag {
    background: #0284c7;
    color: #ffffff;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    padding: 4px 10px;
    border-radius: 6px;
    letter-spacing: 0.04em;
}
.skkni-badge-level {
    background: rgba(255, 255, 255, 0.15);
    border: 1px solid rgba(255, 255, 255, 0.25);
    color: #f8fafc;
    font-size: 0.78rem;
    font-weight: 600;
    padding: 4px 10px;
    border-radius: 6px;
}
.skkni-ref-no {
    font-size: 0.95rem;
    color: #38bdf8;
    font-weight: 600;
    margin-bottom: 8px;
}
.skkni-main-title {
    font-size: clamp(1.8rem, 3.2vw, 2.5rem);
    font-weight: 800;
    line-height: 1.25;
    margin: 0 0 16px;
}
.skkni-lead {
    font-size: 1.05rem;
    line-height: 1.65;
    color: #e2e8f0;
    max-width: 820px;
    margin: 0;
}

/* Detail Layout */
.skkni-body {
    padding: 50px 0 70px;
    background: #f8fafc;
}
.skkni-layout {
    display: grid;
    grid-template-columns: 1fr 340px;
    gap: 36px;
    align-items: start;
}
@media (max-width: 960px) {
    .skkni-layout {
        grid-template-columns: 1fr;
    }
}

/* Main Column Sections */
.skkni-section-card {
    background: #ffffff;
    border-radius: 14px;
    border: 1px solid #e2e8f0;
    padding: 32px;
    margin-bottom: 28px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.03);
}
.skkni-section-title {
    font-size: 1.35rem;
    font-weight: 700;
    color: #0f172a;
    margin: 0 0 18px;
    display: flex;
    align-items: center;
    gap: 10px;
    border-bottom: 2px solid #f1f5f9;
    padding-bottom: 12px;
}
.skkni-prose {
    font-size: 1rem;
    line-height: 1.75;
    color: #334155;
}
.skkni-prose p {
    margin: 0 0 18px;
}
.skkni-prose a {
    color: #1e40af;
    font-weight: 600;
    text-decoration: underline;
    text-underline-offset: 3px;
    transition: color 0.2s;
}
.skkni-prose a:hover {
    color: #1d4ed8;
}

/* Units Table */
.units-table-wrapper {
    overflow-x: auto;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
}
.units-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.92rem;
    text-align: left;
}
.units-table th {
    background: #f1f5f9;
    color: #475569;
    font-weight: 700;
    padding: 12px 16px;
    border-bottom: 1px solid #e2e8f0;
}
.units-table td {
    padding: 12px 16px;
    border-bottom: 1px solid #f1f5f9;
    color: #334155;
}
.units-table tr:last-child td {
    border-bottom: none;
}
.units-table tr:hover {
    background: #f8fafc;
}
.unit-code {
    font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
    font-size: 0.85rem;
    font-weight: 600;
    color: #0369a1;
    white-space: nowrap;
}

/* Box info blocks */
.info-block {
    background: #f8fafc;
    border-left: 4px solid #1e40af;
    padding: 18px 20px;
    border-radius: 0 8px 8px 0;
    margin-bottom: 20px;
    font-size: 0.95rem;
    line-height: 1.65;
    color: #334155;
    white-space: pre-line;
}

/* Salary & Career Grid */
.career-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-top: 10px;
}
@media (max-width: 640px) {
    .career-grid {
        grid-template-columns: 1fr;
    }
}
.career-box {
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    border-radius: 10px;
    padding: 20px;
}
.career-box-title {
    font-size: 0.88rem;
    font-weight: 700;
    text-transform: uppercase;
    color: #166534;
    margin-bottom: 8px;
    letter-spacing: 0.04em;
}
.career-box-val {
    font-size: 1.05rem;
    font-weight: 700;
    color: #14532d;
    line-height: 1.5;
}

/* FAQ Accordion UI */
.faq-item {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 18px 20px;
    margin-bottom: 12px;
}
.faq-q {
    font-size: 1.02rem;
    font-weight: 700;
    color: #0f172a;
    margin: 0 0 8px;
}
.faq-a {
    font-size: 0.92rem;
    color: #475569;
    line-height: 1.65;
    margin: 0;
}

/* Sidebar Styling */
.skkni-sidebar {
    position: -webkit-sticky;
    position: sticky;
    top: 90px;
    align-self: start;
    height: fit-content;
    z-index: 30;
}
@media (max-width: 960px) {
    .skkni-sidebar {
        position: static;
        top: auto;
    }
}
.skkni-sidebar-card {
    background: #ffffff;
    border-radius: 14px;
    border: 1px solid #e2e8f0;
    padding: 24px;
    margin-bottom: 24px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.03);
}
.skkni-sidebar-title {
    font-size: 1.1rem;
    font-weight: 700;
    color: #0f172a;
    margin: 0 0 16px;
    padding-bottom: 10px;
    border-bottom: 1px solid #f1f5f9;
}
.fact-row {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    border-bottom: 1px dashed #f1f5f9;
    font-size: 0.88rem;
}
.fact-row:last-child {
    border-bottom: none;
}
.fact-label {
    color: #64748b;
}
.fact-val {
    font-weight: 600;
    color: #0f172a;
    text-align: right;
    max-width: 60%;
}

.wa-btn-card {
    display: block;
    background: #22c55e;
    color: #ffffff;
    text-align: center;
    padding: 14px 20px;
    border-radius: 10px;
    font-weight: 700;
    font-size: 0.95rem;
    text-decoration: none;
    transition: background 0.2s;
    box-shadow: 0 4px 12px rgba(34, 197, 94, 0.25);
}
.wa-btn-card:hover {
    background: #16a34a;
}

/* Related items list */
.related-item {
    display: block;
    padding: 12px 0;
    border-bottom: 1px solid #f1f5f9;
    text-decoration: none;
}
.related-item:last-child {
    border-bottom: none;
}
.related-item-title {
    font-size: 0.92rem;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 4px;
    transition: color 0.2s;
}
.related-item:hover .related-item-title {
    color: #1e40af;
}
.related-item-sub {
    font-size: 0.78rem;
    color: #64748b;
}
</style>
</head>
<body>
<?php include __DIR__ . '/../includes/navbar.php'; ?>

<!-- Hero Section -->
<header class="skkni-header">
    <div class="container">
        <nav class="skkni-breadcrumb" aria-label="Breadcrumb">
            <a href="/">Beranda</a>
            <span class="sep">&rsaquo;</span>
            <a href="/skkni/">Standar Kompetensi SKKNI</a>
            <span class="sep">&rsaquo;</span>
            <span class="current"><?= e($item['judul']) ?></span>
        </nav>

        <div class="skkni-badges">
            <span class="skkni-badge-tag"><?= e($item['sektor']) ?></span>
            <span class="skkni-badge-level"><?= e($item['jenjang_kkni']) ?></span>
            <span class="skkni-badge-level">Sertifikasi BNSP / Kemnaker</span>
        </div>

        <div class="skkni-ref-no">📜 Rujukan: <?= e($item['skkni_nomor']) ?></div>
        <h1 class="skkni-main-title"><?= e($item['judul']) ?></h1>
        <p class="skkni-lead"><?= e($item['ringkasan']) ?></p>
    </div>
</header>

<!-- Main Detail Content -->
<main class="skkni-body">
    <div class="container">
        <div class="skkni-layout">
            
            <!-- Left Main Column -->
            <article class="skkni-main-col">
                
                <!-- Section 1: In-depth Overview (with capped commercial anchor links) -->
                <section class="skkni-section-card">
                    <h2 class="skkni-section-title">🏢 Deskripsi Profesi & Ruang Lingkup Kerja</h2>
                    <div class="skkni-prose">
                        <?= $item['content_html'] ?>
                    </div>
                </section>

                <!-- Section 2: Official BNSP Competency Units -->
                <section class="skkni-section-card">
                    <h2 class="skkni-section-title">📋 Daftar Unit Kompetensi SKKNI (BNSP)</h2>
                    <p style="font-size:0.92rem; color:#64748b; margin:0 0 16px;">
                        Kandidat wajib dinyatakan <em>Kompeten (K)</em> pada seluruh unit kompetensi berikut dalam uji asesmen LSP terlisensi BNSP:
                    </p>
                    <div class="units-table-wrapper">
                        <table class="units-table">
                            <thead>
                                <tr>
                                    <th style="width:40px;">No</th>
                                    <th style="width:180px;">Kode Unit</th>
                                    <th>Judul Unit Kompetensi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($item['unit_kompetensi'] as $unit): ?>
                                <tr>
                                    <td style="color:#94a3b8; font-weight:600;"><?= $no++ ?></td>
                                    <td><span class="unit-code"><?= e($unit['kode']) ?></span></td>
                                    <td><strong><?= e($unit['judul']) ?></strong></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- Section 3: Assessment Prerequisites -->
                <section class="skkni-section-card">
                    <h2 class="skkni-section-title">🎓 Persyaratan Peserta & Uji Asesmen</h2>
                    <div class="info-block">
                        <?= e($item['persyaratan_asesmen']) ?>
                    </div>
                    <p style="font-size:0.88rem; color:#64748b; margin:0;">
                        * Portofolio kerja dan bukti berkas pendukung wajib diverifikasi oleh Asesor Kompetensi sebelum pelaksanaan uji lisan/praktik.
                    </p>
                </section>

                <!-- Section 4: Operational Duties -->
                <section class="skkni-section-card">
                    <h2 class="skkni-section-title">🛠️ Uraian Tugas & Tanggung Jawab Operasional</h2>
                    <div class="info-block" style="border-left-color:#0284c7;">
                        <?= e($item['deskripsi_tugas']) ?>
                    </div>
                </section>

                <!-- Section 5: Salary Benchmark & Career Path -->
                <section class="skkni-section-card">
                    <h2 class="skkni-section-title">💼 Benchmarking Gaji & Jenjang Karir</h2>
                    <div class="career-grid">
                        <div class="career-box">
                            <div class="career-box-title">💵 Rentang Gaji Industri</div>
                            <div class="career-box-val"><?= e($item['rentang_gaji']) ?></div>
                        </div>
                        <div class="career-box" style="background:#eff6ff; border-color:#bfdbfe;">
                            <div class="career-box-title" style="color:#1e40af;">📈 Prospek Jalur Karir</div>
                            <div class="career-box-val" style="color:#1e3a8a; font-size:0.95rem; font-weight:600;">
                                <?= e($item['prospek_karir']) ?>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section 6: FAQ -->
                <?php if (!empty($item['faqs'])): ?>
                <section class="skkni-section-card">
                    <h2 class="skkni-section-title">❓ Tanya Jawab Seputar <?= e($item['judul']) ?></h2>
                    <div>
                        <?php foreach ($item['faqs'] as $faq): ?>
                        <div class="faq-item">
                            <h3 class="faq-q"><?= e($faq['q']) ?></h3>
                            <p class="faq-a"><?= e($faq['a']) ?></p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </section>
                <?php endif; ?>

            </article>

            <!-- Right Sidebar Column -->
            <aside class="skkni-sidebar">
                
                <!-- Quick Facts Card -->
                <div class="skkni-sidebar-card">
                    <h3 class="skkni-sidebar-title">📌 Informasi Kunci Profesi</h3>
                    <div class="fact-row">
                        <span class="fact-label">Dasar SKKNI</span>
                        <span class="fact-val"><?= e($item['skkni_nomor']) ?></span>
                    </div>
                    <div class="fact-row">
                        <span class="fact-label">Klaster Sektor</span>
                        <span class="fact-val"><?= e($item['sektor']) ?></span>
                    </div>
                    <div class="fact-row">
                        <span class="fact-label">Jenjang KKNI</span>
                        <span class="fact-val"><?= e($item['jenjang_kkni']) ?></span>
                    </div>
                    <div class="fact-row">
                        <span class="fact-label">Total Unit</span>
                        <span class="fact-val"><?= count($item['unit_kompetensi']) ?> Unit Kompetensi</span>
                    </div>
                    <div class="fact-row">
                        <span class="fact-label">Lembaga Uji</span>
                        <span class="fact-val">LSP Terlisensi BNSP</span>
                    </div>
                </div>

                <!-- WhatsApp Consultation Card -->
                <div class="skkni-sidebar-card" style="background:linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); border-color:#bbf7d0;">
                    <div style="font-size:1.8rem; margin-bottom:8px;">💬</div>
                    <h3 style="font-size:1.15rem; font-weight:700; color:#14532d; margin:0 0 8px;">Konsultasi Sertifikasi</h3>
                    <p style="font-size:0.88rem; color:#166534; line-height:1.55; margin:0 0 16px;">
                        Ingin mengikuti uji kompetensi atau mendaftarkan pelatihan in-house perusahaan untuk skema <strong><?= e($item['judul']) ?></strong>? Tim konsultan kami siap membantu jadwal & penawaran resmi.
                    </p>
                    <a href="<?= $waUrl ?>" target="_blank" rel="noopener" class="wa-btn-card">
                        Hubungi via WhatsApp &rarr;
                    </a>
                </div>

                <!-- Related Professions in Same Sector -->
                <?php if (!empty($related)): ?>
                <div class="skkni-sidebar-card">
                    <h3 class="skkni-sidebar-title">🔗 Skema Terkait di Sektor Ini</h3>
                    <div>
                        <?php foreach ($related as $rel): ?>
                        <a href="/skkni/<?= e($rel['slug']) ?>/" class="related-item">
                            <div class="related-item-title"><?= e($rel['judul']) ?></div>
                            <div class="related-item-sub">📜 <?= e($rel['skkni_nomor']) ?></div>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Hub Link -->
                <div style="text-align:center; padding:12px;">
                    <a href="/skkni/" style="color:#1e40af; font-size:0.9rem; font-weight:600; text-decoration:none;">
                        &larr; Kembali ke Direktori SKKNI
                    </a>
                </div>

            </aside>

        </div>
    </div>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>
<script src="<?= SITE_URL ?>/assets/js/main.js"></script>
</body>
</html>
