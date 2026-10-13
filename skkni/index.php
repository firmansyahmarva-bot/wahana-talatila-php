<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/skkni-functions.php';

$s = get_all_settings();

// Filters
$search = trim($_GET['q'] ?? '');
$sektor = trim($_GET['sektor'] ?? '');

$filter = [];
if ($search !== '') $filter['q'] = $search;
if ($sektor !== '') $filter['sektor'] = $sektor;

$skkniList   = get_all_skkni_items($filter);
$totalFound  = count($skkniList);
$allSectors  = get_skkni_sectors();

$metaTitle = 'Standar Kompetensi SKKNI & Sertifikasi Profesi BNSP Resmi | Wahana Totalita';
$metaDesc  = 'Direktori lengkap Standar Kompetensi Kerja Nasional Indonesia (SKKNI) & sertifikasi profesi BNSP/Kemnaker. Pelajari unit kompetensi, syarat asesmen, dan standar gaji industri.';
$canonical = SITE_URL . '/skkni/';

// Structured Data
$jsonLd = [
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'CollectionPage',
            '@id' => $canonical,
            'url' => $canonical,
            'name' => $metaTitle,
            'description' => $metaDesc,
            'inLanguage' => 'id-ID'
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
                    'item' => $canonical
                ]
            ]
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
<link rel="stylesheet" href="<?= asset_v('/assets/css/page/skkni.css') ?>">
</head>
<body>
<?php include __DIR__ . '/../includes/navbar.php'; ?>

<!-- Hero Section -->
<section class="skkni-hero">
    <div class="container">
        <h1>🎖️ Standar Kompetensi SKKNI & Sertifikasi Profesi BNSP</h1>
        <p>Direktori rujukan Standar Kompetensi Kerja Nasional Indonesia (SKKNI), unit kompetensi asesmen BNSP, dan sertifikasi keahlian industri bersertifikat resmi Kementerian Ketenagakerjaan RI.</p>
        
        <form class="skkni-search-form" action="/skkni/" method="GET">
            <?php if ($sektor): ?><input type="hidden" name="sektor" value="<?= e($sektor) ?>"><?php endif; ?>
            <input type="text" name="q" value="<?= e($search) ?>" placeholder="Cari profesi, nomor SKKNI, misal: ahli k3 umum, pop tambang, limbah b3, forklift...">
            <button type="submit">Cari Profesi</button>
        </form>

        <div class="skkni-stats-row">
            <div class="skkni-stat-box">
                <strong><?= count(get_all_skkni_items()) ?>+</strong>
                <span>Skema Profesi SKKNI</span>
            </div>
            <div class="skkni-stat-box">
                <strong>100%</strong>
                <span>Standar BNSP & Kemnaker</span>
            </div>
            <div class="skkni-stat-box">
                <strong>6+ Sektor</strong>
                <span>Industri Strategis</span>
            </div>
            <div class="skkni-stat-box">
                <strong>Level 2-7</strong>
                <span>Jenjang Kualifikasi KKNI</span>
            </div>
        </div>
    </div>
</section>

<!-- Filter Section -->
<section class="skkni-filter-bar">
    <div class="container">
        <div class="skkni-filter-label">Filter Klaster & Sektor Industri:</div>
        <div class="skkni-chip-row">
            <a href="/skkni/<?= $search ? '?q='.urlencode($search) : '' ?>" class="skkni-chip <?= $sektor === '' ? 'active' : '' ?>">Semua Sektor (<?= count(get_all_skkni_items(['q' => $search])) ?>)</a>
            <?php foreach ($allSectors as $secName => $secCount): ?>
            <a href="?<?= http_build_query(array_merge($_GET, ['sektor' => $secName, 'q' => $search])) ?>" class="skkni-chip <?= strcasecmp($sektor, $secName) === 0 ? 'active' : '' ?>">
                <?= e($secName) ?> (<?= $secCount ?>)
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Main List -->
<section class="skkni-main-content">
    <div class="container">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px; flex-wrap:wrap; gap:12px;">
            <h2 style="font-size:1.35rem; font-weight:700; color:var(--slate-800); margin:0;">
                <?php if ($search || $sektor): ?>
                    Hasil Pencarian: <?= $totalFound ?> Skema Profesi Ditemukan
                <?php else: ?>
                    Daftar Lengkap Skema Profesi SKKNI Bersertifikat
                <?php endif; ?>
            </h2>
            <?php if ($search || $sektor): ?>
            <a href="/skkni/" style="font-size:0.88rem; color:var(--danger); font-weight:600; text-decoration:none;">✕ Bersihkan Filter</a>
            <?php endif; ?>
        </div>

        <?php if (empty($skkniList)): ?>
        <div style="text-align:center; padding:60px 20px; background:var(--slate-50); border-radius:12px; border:1px dashed var(--slate-300);">
            <div style="font-size:3rem; margin-bottom:12px;">🔍</div>
            <h3 style="color:var(--slate-700); margin:0 0 8px;">Tidak Ada Skema Profesi yang Cocok</h3>
            <p style="color:var(--slate-500); margin:0 0 16px;">Silakan coba kata kunci lain atau pilih sektor industri yang berbeda.</p>
            <a href="/skkni/" class="skkni-chip active" style="display:inline-block;">Lihat Seluruh Skema</a>
        </div>
        <?php else: ?>
        <div class="skkni-grid">
            <?php foreach ($skkniList as $item): ?>
                <div class="skkni-card">
                    <div class="skkni-card-header">
                        <span class="skkni-badge-sector"><?= e($item['sektor']) ?></span>
                        <span class="skkni-badge-kkni"><?= e($item['jenjang_kkni']) ?></span>
                    </div>
                    <div class="skkni-card-body">
                        <div class="skkni-card-ref">📜 <?= e($item['skkni_nomor']) ?></div>
                        <h3 class="skkni-card-title">
                            <a href="/skkni/<?= e($item['slug']) ?>/"><?= e($item['judul']) ?></a>
                        </h3>
                        <p class="skkni-card-desc"><?= e(mb_strimwidth($item['ringkasan'], 0, 140, '...')) ?></p>
                        
                        <div class="skkni-card-meta">
                            <span>📋 <?= count($item['unit_kompetensi']) ?> Unit Kompetensi</span>
                            <span>💼 <?= e(explode(' per', $item['rentang_gaji'])[0] ?? 'Standar Industri') ?></span>
                        </div>
                    </div>
                    <div class="skkni-card-footer">
                        <a href="/skkni/<?= e($item['slug']) ?>/" class="skkni-btn-detail">Lihat Standar Kompetensi &rarr;</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Featured Training Showcase Section (Constraint: Show pelatihan at that hub) -->
<section class="skkni-showcase">
    <div class="container">
        <h2 class="skkni-showcase-title">🎓 Program Pelatihan & Uji Kompetensi Terakreditasi</h2>
        <p class="skkni-showcase-sub">Tingkatkan daya saing karier dan penuhi standar kepatuhan regulasi industri melalui program pembinaan resmi Wahana Totalita terlisensi BNSP & Kemnaker RI.</p>

        <div class="ft-grid">
            <div class="ft-card">
                <span class="ft-badge">Sertifikasi BNSP</span>
                <h3 class="ft-title">Ahli K3 BNSP (Level 6 KKNI)</h3>
                <p class="ft-desc">Pengujian resmi 8 unit kompetensi perancangan strategi K3, evaluasi HIRADC, dan audit SMK3 korporasi.</p>
                <a href="/pelatihan/ak3-bnsp/" class="ft-btn">Lihat Silabus & Jadwal &rarr;</a>
            </div>

            <div class="ft-card">
                <span class="ft-badge">Sertifikasi ESDM / BNSP</span>
                <h3 class="ft-title">POP Pertambangan Minerba</h3>
                <p class="ft-desc">Sertifikasi wajib pengawas operasional lapangan IUP tambang minerba sesuai Kepmen ESDM 1827/2018.</p>
                <a href="/pelatihan/pelatihan-pop-pertambangan-sertifikasi-bnsp-online/" class="ft-btn">Lihat Silabus & Jadwal &rarr;</a>
            </div>

            <div class="ft-card">
                <span class="ft-badge">Sertifikasi BNSP</span>
                <h3 class="ft-title">Manajer PLB3 (Level 6 KKNI)</h3>
                <p class="ft-desc">Tata kelola Persetujuan Teknis (PERTEK), TPS Limbah B3, manifest FESTRONIK, dan baku mutu KLHK.</p>
                <a href="/pelatihan/pelatihan-manajer-pengolahan-limbah-b3-jenjang-kualifikasi-6-level-pengawas-mplb3-sertifikasi-bnsp/" class="ft-btn">Lihat Silabus & Jadwal &rarr;</a>
            </div>

            <div class="ft-card">
                <span class="ft-badge">Sertifikasi BNSP</span>
                <h3 class="ft-title">Pengawas K3 Migas</h3>
                <p class="ft-desc">Kualifikasi perwira keselamatan fasilitas hulu dan hilir migas berstandar PTK 005 SKK Migas dan CSMS.</p>
                <a href="/pelatihan/pelatihan-pengawas-k3-migas-sertifikasi-bnsp/" class="ft-btn">Lihat Silabus & Jadwal &rarr;</a>
            </div>

            <div class="ft-card">
                <span class="ft-badge">Sertifikasi BNSP</span>
                <h3 class="ft-title">POPAL (Operasional Air Limbah)</h3>
                <p class="ft-desc">Penguasaan instalasi IPAL industri, stabilisasi parameter BOD/COD, dan pemenuhan pelaporan SIMPEL.</p>
                <a href="/pelatihan/pelatihan-penanggung-jawab-operasional-pengolahan-air-limbah-popal-sertifikasi-bnsp/" class="ft-btn">Lihat Silabus & Jadwal &rarr;</a>
            </div>

            <div class="ft-card">
                <span class="ft-badge">Sertifikasi Kemnaker RI</span>
                <h3 class="ft-title">Petugas P3K di Tempat Kerja</h3>
                <p class="ft-desc">Pelatihan resmi tindakan pertolongan darurat medik di tempat kerja sesuai mandat Permenaker 15/2008.</p>
                <a href="/pelatihan/pelatihan-petugas-p3k-sertifikasi-kemnaker-ri/" class="ft-btn">Lihat Silabus & Jadwal &rarr;</a>
            </div>
        </div>
    </div>
</section>

<!-- Educational Guide to SKKNI & BNSP Section -->
<section style="background:var(--surface); padding:64px 0; border-top:1px solid var(--slate-200);">
    <div class="container" style="max-width:960px;">
        <h2 style="font-size:1.8rem; font-weight:800; color:var(--slate-900); margin-bottom:16px; text-align:center;">
            📘 Panduan Standar Kompetensi SKKNI & Jalur Sertifikasi Profesi
        </h2>
        <p style="font-size:1rem; color:var(--slate-600); line-height:1.7; text-align:center; margin-bottom:40px;">
            Memahami bagaimana Standar Kompetensi Kerja Nasional Indonesia (SKKNI) diterapkan sebagai tolok ukur pengakuan keahlian personil, akreditasi LSP, dan kualifikasi rekrutmen industri modern.
        </p>

        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(280px, 1fr)); gap:24px; margin-bottom:44px;">
            <div style="background:var(--slate-50); border:1px solid var(--slate-200); border-radius:12px; padding:24px;">
                <div style="font-size:1.8rem; margin-bottom:10px;">📋</div>
                <h3 style="font-size:1.15rem; font-weight:700; color:var(--info-dark); margin:0 0 10px;">1. Pengertian SKKNI</h3>
                <p style="font-size:0.92rem; color:var(--slate-600); line-height:1.6; margin:0;">
                    SKKNI adalah rumusan kemampuan kerja yang mencakup aspek pengetahuan (knowledge), keterampilan (skill), serta sikap kerja (attitude) yang relevan dengan pelaksanaan tugas dan syarat jabatan yang ditetapkan secara tripartit oleh pemerintah, asosiasi profesi, dan pakar industri.
                </p>
            </div>

            <div style="background:var(--slate-50); border:1px solid var(--slate-200); border-radius:12px; padding:24px;">
                <div style="font-size:1.8rem; margin-bottom:10px;">🏛️</div>
                <h3 style="font-size:1.15rem; font-weight:700; color:var(--info); margin:0 0 10px;">2. Peran BNSP & LSP</h3>
                <p style="font-size:0.92rem; color:var(--slate-600); line-height:1.6; margin:0;">
                    Badan Nasional Sertifikasi Profesi (BNSP) adalah lembaga independen pemerintah yang memberikan lisensi kepada Lembaga Sertifikasi Profesi (LSP). Asesor bersertifikat menguji kandidat melalui metode verifikasi portofolio kerja, tes tulis, wawancara, dan simulasi unjuk kerja.
                </p>
            </div>

            <div style="background:var(--slate-50); border:1px solid var(--slate-200); border-radius:12px; padding:24px;">
                <div style="font-size:1.8rem; margin-bottom:10px;">🌍</div>
                <h3 style="font-size:1.15rem; font-weight:700; color:var(--success); margin:0 0 10px;">3. Pengakuan Regional & Global</h3>
                <p style="font-size:0.92rem; color:var(--slate-600); line-height:1.6; margin:0;">
                    Sertifikat kompetensi yang berlogo Garuda Emas BNSP diakui secara nasional di seluruh wilayah Indonesia serta memiliki kesetaraan kualifikasi regional di kawasan ASEAN melalui kerangka kerja ASEAN Guiding Principles for Quality Assurance and Recognition of Competency.
                </p>
            </div>
        </div>

        <div style="background:var(--info-bg); border:1px solid var(--info-border); border-radius:14px; padding:28px; margin-bottom:44px;">
            <h3 style="font-size:1.25rem; font-weight:700; color:var(--info-dark); margin:0 0 14px;">
                🚀 4 Langkah Mengikuti Asesmen Uji Kompetensi BNSP
            </h3>
            <ol style="color:var(--info-dark); font-size:0.95rem; line-height:1.75; margin:0; padding-left:22px;">
                <li><strong>Memilih Skema Sertifikasi:</strong> Pilih skema profesi yang sesuai dengan latar belakang pendidikan dan pengalaman kerja Anda di lapangan.</li>
                <li><strong>Mengikuti Pelatihan Pembekalan (Pre-Assessment):</strong> Ikuti workshop pembekalan materi SKKNI bersama instruktur master trainer Wahana Totalita untuk merapikan portofolio bukti kerja (Formulir APL-01 & APL-02).</li>
                <li><strong>Pelaksanaan Uji Kompetensi:</strong> Menjalani asesmen tatap muka atau daring di hadapan Asesor Kompetensi berlisensi BNSP melalui tes wawancara, ujian tertulis, dan demonstrasi studi kasus.</li>
                <li><strong>Penerbitan Sertifikat Resmi BNSP:</strong> Peserta yang dinyatakan <em>Kompeten (K)</em> akan diterbitkan Sertifikat Kompetensi Kerja berlogo Garuda Republik Indonesia yang berlaku selama 3 hingga 5 tahun.</li>
            </ol>
        </div>

        <!-- FAQ Section -->
        <h3 style="font-size:1.45rem; font-weight:700; color:var(--slate-900); margin-bottom:20px; text-align:center;">
            ❓ Pertanyaan Umum Seputar SKKNI & Sertifikasi Profesi
        </h3>
        <div style="display:flex; flex-direction:column; gap:14px;">
            <div style="background:var(--slate-50); border:1px solid var(--slate-200); border-radius:10px; padding:20px;">
                <h4 style="margin:0 0 8px; font-size:1rem; color:var(--slate-900);">Apa perbedaan sertifikat pelatihan dan sertifikat kompetensi BNSP?</h4>
                <p style="margin:0; font-size:0.92rem; color:var(--slate-600); line-height:1.6;">
                    Sertifikat pelatihan (Certificate of Attendance/Completion) hanya membuktikan bahwa seseorang telah selesai mendengarkan materi kursus. Sedangkan Sertifikat Kompetensi BNSP adalah pengakuan negara resmi yang menyatakan bahwa orang tersebut telah diuji dan terbukti memiliki kemampuan kerja nyata sesuai standar SKKNI.
                </p>
            </div>

            <div style="background:var(--slate-50); border:1px solid var(--slate-200); border-radius:10px; padding:20px;">
                <h4 style="margin:0 0 8px; font-size:1rem; color:var(--slate-900);">Apakah sertifikasi BNSP bisa kadaluarsa?</h4>
                <p style="margin:0; font-size:0.92rem; color:var(--slate-600); line-height:1.6;">
                    Ya, sertifikat kompetensi BNSP memiliki masa berlaku umumnya 3 (tiga) tahun atau 5 (lima) tahun tergantung skema profesi, dan dapat diperpanjang melalui proses re-sertifikasi portofolio kegiatan kerja aktif.
                </p>
            </div>

            <div style="background:var(--slate-50); border:1px solid var(--slate-200); border-radius:10px; padding:20px;">
                <h4 style="margin:0 0 8px; font-size:1rem; color:var(--slate-900);">Bagaimana cara mendaftar sertifikasi profesi di Wahana Totalita?</h4>
                <p style="margin:0; font-size:0.92rem; color:var(--slate-600); line-height:1.6;">
                    Anda dapat menghubungi konsultan training Wahana Totalita melalui tombol WhatsApp atau memilih program pelatihan yang Anda minati di katalog program kami untuk mendapatkan jadwal public training maupun penawaran in-house training perusahaan.
                </p>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
<script src="<?= SITE_URL ?>/assets/js/main.js"></script>
</body>
</html>
