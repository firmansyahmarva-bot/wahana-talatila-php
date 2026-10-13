<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/regulasi-data.php';

$slug = trim($_GET['slug'] ?? get_url_slug());
if (!$slug) {
    header('Location: ' . SITE_URL . '/regulasi/', true, 301);
    exit;
}

$r = get_regulasi_by_slug($slug);
if (!$r) {
    http_response_code(404);
    include __DIR__ . '/../404.php';
    exit;
}

$s = get_all_settings();

// Related regulations in same category
$allRegulasi = get_regulasi_dataset();
$related = array_filter($allRegulasi, fn($item) => $item['slug'] !== $slug && $item['kategori'] === $r['kategori']);
$related = array_slice($related, 0, 3);
if (count($related) < 3) {
    $fallback = array_filter($allRegulasi, fn($item) => $item['slug'] !== $slug && !in_array($item['slug'], array_keys($related)));
    $related = array_merge($related, array_slice($fallback, 0, 3 - count($related)));
}

$canonical = SITE_URL . '/regulasi/' . $r['slug'] . '/';
$metaTitle = $r['nomor'] . ': ' . $r['tentang'] . ' — Ringkasan & Kepatuhan';
$metaDesc  = 'Ulasan hukum lengkap ' . $r['nomor'] . ' tentang ' . $r['tentang'] . '. Pahami pasal penting, kewajiban industri, sanksi pelanggaran, dan sertifikasi K3 resmi.';

// WA consultation link
$waNumber = $s['wa_number'] ?? '6287759151278';
$waText   = urlencode("Halo Wahana Totalita, kami ingin konsultasi kepatuhan hukum dan pelatihan in-house terkait " . $r['nomor']);
$waUrl    = "https://wa.me/{$waNumber}?text={$waText}";

// Prepare JSON-LD Schema
$schemaFaqs = [];
foreach ($r['faqs'] as $faq) {
    $schemaFaqs[] = [
        '@type' => 'Question',
        'name' => $faq['q'],
        'acceptedAnswer' => [
            '@type' => 'Answer',
            'text' => $faq['a']
        ]
    ];
}

$jsonLd = [
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'Legislation',
            '@id' => $canonical . '#legislation',
            'name' => $r['nomor'],
            'alternateName' => $r['tentang'],
            'legislationType' => $r['jenis'],
            'legislationDate' => (string)$r['tahun'],
            'legislationJurisdiction' => [
                '@type' => 'AdministrativeArea',
                'name' => 'Indonesia'
            ],
            'description' => $r['ringkasan'],
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
                    'name' => 'Regulasi K3',
                    'item' => SITE_URL . '/regulasi/'
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 3,
                    'name' => $r['nomor'],
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
<script type="application/ld+json">
<?= json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?>
</script>
<link rel="stylesheet" href="<?= asset_v('/assets/css/page/regulasi-detail.css') ?>">
</head>
<body>
<?php include __DIR__ . '/../includes/navbar.php'; ?>

<!-- Detail Hero -->
<header class="reg-detail-hero">
    <div class="container">
        <nav class="reg-breadcrumbs" aria-label="Breadcrumb">
            <a href="/">Beranda</a>
            <span>›</span>
            <a href="/regulasi/">Regulasi K3</a>
            <span>›</span>
            <span><?= e($r['nomor']) ?></span>
        </nav>

        <div class="reg-hero-meta">
            <span class="reg-hero-badge"><?= e($r['jenis']) ?></span>
            <span class="reg-hero-badge badge-status"><?= e($r['status']) ?></span>
            <span class="reg-hero-badge">Tahun <?= e($r['tahun']) ?></span>
            <span class="reg-hero-badge"><?= e($r['kategori']) ?></span>
        </div>

        <h1><?= e($r['nomor']) ?></h1>
        <div class="hero-sub">Tentang: <?= e($r['tentang']) ?></div>
    </div>
</header>

<!-- Main Layout -->
<main class="reg-content-wrap">
    <div class="container">
        <div class="reg-layout-grid">
            
            <!-- Left Column: Comprehensive Legal Analysis -->
            <article class="reg-main-article">
                
                <!-- Ringkasan Resmi -->
                <section class="reg-card-block">
                    <h2>📋 Ringkasan & Ruang Lingkup Hukum</h2>
                    <p><?= e($r['ringkasan']) ?></p>
                    <?php if (!empty($r['mencabut']) && $r['mencabut'] !== '-'): ?>
                    <p style="font-size:0.9rem; color:var(--slate-500); margin-top:12px; font-style:italic;">
                        * Status Historis: Mencabut atau merevisi ketentuan pada <?= e($r['mencabut']) ?>.
                    </p>
                    <?php endif; ?>
                </section>

                <!-- Analisis Kontekstual & In-Content Anchor Links -->
                <section class="reg-card-block">
                    <h2>🔍 Analisis Kepatuhan & Implementasi Lapangan</h2>
                    <?= $r['content_html'] ?>
                </section>

                <!-- Pasal-Pasal Penting -->
                <section class="reg-card-block">
                    <h2>⚖️ Ketentuan & Pasal-Pasal Kunci</h2>
                    <ul class="pasal-list">
                        <?php foreach ($r['pasal_penting'] as $pasal): ?>
                        <li class="pasal-item"><?= e($pasal) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </section>

                <!-- Kewajiban Perusahaan -->
                <section class="reg-card-block">
                    <h2>🏢 Kewajiban Bagi Perusahaan & Pengurus</h2>
                    <div class="compliance-box">
                        <strong>Checklist Kepatuhan:</strong><br>
                        <?= nl2br(e($r['kewajiban_perusahaan'])) ?>
                    </div>
                </section>

                <!-- Sanksi Pelanggaran -->
                <section class="reg-card-block">
                    <h2>⚠️ Sanksi Hukum atas Pelanggaran</h2>
                    <div class="penalty-box">
                        <strong>Konsekuensi Hukum:</strong><br>
                        <?= e($r['sanksi']) ?>
                    </div>
                </section>

                <!-- FAQs Accordion -->
                <?php if (!empty($r['faqs'])): ?>
                <section class="reg-card-block">
                    <h2>❓ Pertanyaan Umum Seputar Regulasi Ini</h2>
                    <div class="faq-accordion">
                        <?php foreach ($r['faqs'] as $faq): ?>
                        <div class="faq-box">
                            <div class="faq-question">
                                <span><?= e($faq['q']) ?></span>
                                <span>+</span>
                            </div>
                            <div class="faq-answer">
                                <?= e($faq['a']) ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </section>
                <?php endif; ?>

            </article>

            <!-- Right Column: Sticky Sidebar -->
            <aside class="reg-sidebar">
                
                <!-- Legal Metadata Box -->
                <div class="side-card">
                    <h3 class="side-title">Informasi Regulasi</h3>
                    <div class="side-meta-item">
                        <strong>Nomor Aturan</strong>
                        <span><?= e($r['nomor']) ?></span>
                    </div>
                    <div class="side-meta-item">
                        <strong>Jenis Dokumen</strong>
                        <span><?= e($r['jenis']) ?></span>
                    </div>
                    <div class="side-meta-item">
                        <strong>Tahun Pengesahan</strong>
                        <span><?= e($r['tahun']) ?></span>
                    </div>
                    <div class="side-meta-item">
                        <strong>Sektor / Kategori</strong>
                        <span><?= e($r['kategori']) ?></span>
                    </div>
                    <div class="side-meta-item">
                        <strong>Status Keberlakuan</strong>
                        <span style="color:var(--success-dark); font-weight:700;">✓ <?= e($r['status']) ?></span>
                    </div>
                    <?php if (!empty($r['mencabut']) && $r['mencabut'] !== '-'): ?>
                    <div class="side-meta-item">
                        <strong>Menggantikan</strong>
                        <span><?= e($r['mencabut']) ?></span>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- B2B In-House Consultation CTA -->
                <div class="side-cta-card">
                    <h3>Butuh Kepatuhan Regulasi?</h3>
                    <p>Wahana Totalita membantu audit internal, penyiapan personil bersertifikat, dan training in-house pemenuhan <?= e($r['nomor']) ?> di perusahaan Anda.</p>
                    <a href="<?= $waUrl ?>" target="_blank" rel="noopener" class="btn-side-wa">
                        💬 Konsultasi via WhatsApp
                    </a>
                </div>

                <!-- Related Regulations -->
                <?php if (!empty($related)): ?>
                <div class="side-card">
                    <h3 class="side-title">Regulasi Terkait</h3>
                    <?php foreach ($related as $rel): ?>
                    <a href="/regulasi/<?= e($rel['slug']) ?>/" class="related-link">
                        <strong><?= e($rel['nomor']) ?></strong>
                        <span><?= e($rel['tentang']) ?></span>
                    </a>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

            </aside>

        </div>
    </div>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>
<script src="<?= SITE_URL ?>/assets/js/main.js"></script>
</body>
</html>
