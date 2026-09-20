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
<script type="application/ld+json">
<?= json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?>
</script>
<style>
/* Detail Hero */
.reg-detail-hero {
    background: linear-gradient(135deg, #0f5132 0%, #157347 100%);
    color: #ffffff;
    padding: 48px 0 40px;
}
.reg-breadcrumbs {
    display: flex;
    gap: 8px;
    align-items: center;
    font-size: 0.85rem;
    margin-bottom: 20px;
    flex-wrap: wrap;
    opacity: 0.85;
}
.reg-breadcrumbs a {
    color: #ffffff;
    text-decoration: none;
}
.reg-breadcrumbs a:hover {
    text-decoration: underline;
}
.reg-breadcrumbs span {
    opacity: 0.6;
}

.reg-hero-meta {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin-bottom: 16px;
    align-items: center;
}
.reg-hero-badge {
    font-size: 0.8rem;
    font-weight: 700;
    text-transform: uppercase;
    padding: 4px 12px;
    border-radius: 999px;
    background: rgba(255, 255, 255, 0.2);
    color: #ffffff;
}
.badge-status {
    background: #dcfce7;
    color: #166534;
}

.reg-detail-hero h1 {
    font-size: clamp(1.6rem, 3.2vw, 2.4rem);
    font-weight: 800;
    margin: 0 0 10px;
    line-height: 1.25;
}
.reg-detail-hero .hero-sub {
    font-size: 1.15rem;
    opacity: 0.95;
    font-weight: 500;
    line-height: 1.5;
    max-width: 850px;
}

/* Content Layout */
.reg-content-wrap {
    padding: 48px 0 64px;
    background: #f8fafc;
}
.reg-layout-grid {
    display: grid;
    grid-template-columns: 1fr 340px;
    gap: 36px;
    align-items: start;
}
@media (max-width: 992px) {
    .reg-layout-grid {
        grid-template-columns: 1fr;
    }
}

/* Content Cards */
.reg-card-block {
    background: #ffffff;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    padding: 32px;
    margin-bottom: 28px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.03);
}
.reg-card-block h2 {
    font-size: 1.3rem;
    font-weight: 700;
    color: #0f172a;
    margin: 0 0 18px;
    display: flex;
    align-items: center;
    gap: 10px;
    border-bottom: 2px solid #f1f5f9;
    padding-bottom: 12px;
}
.reg-card-block p {
    font-size: 0.98rem;
    line-height: 1.7;
    color: #334155;
    margin-bottom: 16px;
}
.reg-card-block p:last-child {
    margin-bottom: 0;
}
.reg-card-block a {
    color: #0f5132;
    font-weight: 600;
    text-decoration: underline;
    text-underline-offset: 2px;
}
.reg-card-block a:hover {
    color: var(--orange, #f97316);
}

/* Key Articles List */
.pasal-list {
    list-style: none;
    padding: 0;
    margin: 0;
}
.pasal-item {
    padding: 14px 18px;
    border-left: 4px solid #0f5132;
    background: #f8fafc;
    border-radius: 0 8px 8px 0;
    margin-bottom: 12px;
    font-size: 0.95rem;
    line-height: 1.6;
    color: #1e293b;
}

/* Compliance Checklist */
.compliance-box {
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    border-radius: 10px;
    padding: 20px 24px;
    color: #166534;
    font-size: 0.98rem;
    line-height: 1.65;
}

/* Penalties Alert Box */
.penalty-box {
    background: #fef2f2;
    border: 1px solid #fecaca;
    border-radius: 10px;
    padding: 20px 24px;
    color: #991b1b;
    font-size: 0.98rem;
    line-height: 1.65;
}

/* FAQ Accordion */
.faq-box {
    margin-bottom: 16px;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    overflow: hidden;
}
.faq-question {
    background: #f8fafc;
    padding: 16px 20px;
    font-weight: 700;
    font-size: 1rem;
    color: #0f172a;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.faq-question:hover {
    background: #f1f5f9;
}
.faq-answer {
    padding: 18px 20px;
    background: #ffffff;
    font-size: 0.95rem;
    line-height: 1.65;
    color: #334155;
    border-top: 1px solid #e2e8f0;
}

/* Sidebar */
.reg-sidebar {
    position: -webkit-sticky;
    position: sticky;
    top: 90px;
    align-self: start;
    height: fit-content;
}
@media (max-width: 960px) {
    .reg-sidebar {
        position: static;
        top: auto;
    }
}
.side-card {
    background: #ffffff;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    padding: 24px;
    margin-bottom: 24px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.03);
}
.side-title {
    font-size: 1.1rem;
    font-weight: 700;
    color: #0f172a;
    margin: 0 0 16px;
    border-bottom: 1px solid #f1f5f9;
    padding-bottom: 10px;
}
.side-meta-item {
    margin-bottom: 12px;
    font-size: 0.88rem;
    line-height: 1.45;
}
.side-meta-item strong {
    display: block;
    color: #64748b;
    font-size: 0.78rem;
    text-transform: uppercase;
    margin-bottom: 2px;
}
.side-meta-item span {
    color: #1e293b;
    font-weight: 600;
}

.side-cta-card {
    background: linear-gradient(135deg, #0f5132 0%, #157347 100%);
    color: #ffffff;
    border-radius: 12px;
    padding: 26px 22px;
    text-align: center;
}
.side-cta-card h3 {
    font-size: 1.15rem;
    font-weight: 800;
    margin: 0 0 10px;
}
.side-cta-card p {
    font-size: 0.88rem;
    opacity: 0.9;
    line-height: 1.5;
    margin: 0 0 20px;
}
.btn-side-wa {
    display: block;
    background: #25d366;
    color: #ffffff;
    font-weight: 700;
    font-size: 0.92rem;
    padding: 12px 18px;
    border-radius: 8px;
    text-decoration: none;
    box-shadow: 0 4px 12px rgba(37, 211, 102, 0.3);
    transition: transform 0.2s, background 0.2s;
}
.btn-side-wa:hover {
    background: #20ba5a;
    transform: translateY(-2px);
}

.related-link {
    display: block;
    padding: 10px 0;
    border-bottom: 1px solid #f1f5f9;
    text-decoration: none;
}
.related-link:last-child {
    border-bottom: none;
    padding-bottom: 0;
}
.related-link strong {
    display: block;
    font-size: 0.9rem;
    color: #0f172a;
    line-height: 1.35;
    margin-bottom: 4px;
}
.related-link span {
    font-size: 0.8rem;
    color: #64748b;
}
.related-link:hover strong {
    color: #0f5132;
}
</style>
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
                    <p style="font-size:0.9rem; color:#64748b; margin-top:12px; font-style:italic;">
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
                        <span style="color:#166534; font-weight:700;">✓ <?= e($r['status']) ?></span>
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
