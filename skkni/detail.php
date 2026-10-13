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
<?php require __DIR__ . '/../includes/css.php'; ?>
<script type="application/ld+json"><?= json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
<link rel="stylesheet" href="<?= asset_v('/assets/css/page/skkni-detail.css') ?>">
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
                    <p style="font-size:0.92rem; color:var(--slate-500); margin:0 0 16px;">
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
                                    <td style="color:var(--slate-400); font-weight:600;"><?= $no++ ?></td>
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
                    <p style="font-size:0.88rem; color:var(--slate-500); margin:0;">
                        * Portofolio kerja dan bukti berkas pendukung wajib diverifikasi oleh Asesor Kompetensi sebelum pelaksanaan uji lisan/praktik.
                    </p>
                </section>

                <!-- Section 4: Operational Duties -->
                <section class="skkni-section-card">
                    <h2 class="skkni-section-title">🛠️ Uraian Tugas & Tanggung Jawab Operasional</h2>
                    <div class="info-block" style="border-left-color:var(--info);">
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
                        <div class="career-box" style="background:var(--info-bg); border-color:var(--info-border);">
                            <div class="career-box-title" style="color:var(--info-dark);">📈 Prospek Jalur Karir</div>
                            <div class="career-box-val" style="color:var(--info-dark); font-size:0.95rem; font-weight:600;">
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
                <div class="skkni-sidebar-card" style="background:linear-gradient(135deg, var(--success-bg) 0%, var(--success-soft) 100%); border-color:var(--success-border);">
                    <div style="font-size:1.8rem; margin-bottom:8px;">💬</div>
                    <h3 style="font-size:1.15rem; font-weight:700; color:var(--brand); margin:0 0 8px;">Konsultasi Sertifikasi</h3>
                    <p style="font-size:0.88rem; color:var(--success-dark); line-height:1.55; margin:0 0 16px;">
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
                    <a href="/skkni/" style="color:var(--info-dark); font-size:0.9rem; font-weight:600; text-decoration:none;">
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
