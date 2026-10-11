<?php
/**
 * cron/write-article.php
 * AI article writer - generates one full SEO article per run using the free
 * Gemini key (via get_claude() fallback) and publishes it to the articles table.
 * Run via Hostinger cron (CLI) or manually:
 *   https://wahanatotalita.com/cron/write-article.php?key=wahana2026ping
 */
if (PHP_SAPI !== 'cli'
    && (($_GET['key'] ?? '') !== 'wahana2026ping')
    && (!isset($_GET['cron_key']) || !getenv('CRON_SECRET') || $_GET['cron_key'] !== getenv('CRON_SECRET'))) {
    http_response_code(403); exit('Forbidden');
}
set_time_limit(240);
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/ai-functions.php';

header('Content-Type: application/json; charset=utf-8');

function wt_ai_write_article(): array {
    $topics = [
        ['biaya-pelatihan-k3-yogyakarta', 'Biaya Pelatihan K3 di Yogyakarta: Rincian per Program dan Cara Hemat'],
        ['syarat-menjadi-ahli-k3-umum', 'Syarat Menjadi Ahli K3 Umum: Pendidikan, Pengalaman, dan Proses Sertifikasi'],
        ['pelatihan-k3-untuk-instansi-pemerintah', 'Panduan Pengadaan Pelatihan K3 untuk Instansi Pemerintah dan BUMN'],
        ['perbedaan-pop-pom-pou-pertambangan', 'Perbedaan POP, POM, dan POU di Pertambangan: Jenjang dan Syaratnya'],
        ['cara-membuat-jsa-job-safety-analysis', 'Cara Membuat JSA (Job Safety Analysis) Langkah demi Langkah'],
        ['checklist-audit-smk3-pp-50-2012', 'Checklist Audit SMK3 PP 50/2012: 166 Kriteria dan Cara Mempersiapkannya'],
        ['tugas-dan-tanggung-jawab-safety-officer', 'Tugas dan Tanggung Jawab Safety Officer di Perusahaan'],
        ['sertifikasi-petugas-p3k-kemnaker', 'Sertifikasi Petugas P3K Kemnaker: Syarat, Biaya, dan Masa Berlaku'],
        ['prosedur-izin-kerja-confined-space', 'Prosedur Izin Kerja di Ruang Terbatas (Confined Space) Sesuai Regulasi'],
        ['hierarki-pengendalian-bahaya-k3', 'Hierarki Pengendalian Bahaya K3: Dari Eliminasi hingga APD'],
        ['cara-mendapatkan-sio-forklift', 'Cara Mendapatkan SIO Forklift: Syarat, Biaya, dan Proses Ujian'],
        ['perbedaan-ukl-upl-dan-amdal', 'Perbedaan UKL-UPL dan AMDAL: Mana yang Wajib untuk Usaha Anda?'],
        ['kewajiban-p2k3-di-perusahaan', 'P2K3 di Perusahaan: Kewajiban, Struktur, dan Cara Membentuknya'],
        ['nilai-ambang-batas-kebisingan', 'Nilai Ambang Batas Kebisingan di Tempat Kerja Menurut Permenaker 5/2018'],
        ['prosedur-lockout-tagout-loto', 'Prosedur Lockout Tagout (LOTO): Melindungi Pekerja dari Energi Berbahaya'],
        ['inspeksi-k3-rutin-checklist', 'Inspeksi K3 Rutin: Checklist Harian, Mingguan, dan Bulanan'],
        ['izin-kerja-panas-hot-work-permit', 'Izin Kerja Panas (Hot Work Permit): Kapan Wajib dan Cara Mengurusnya'],
        ['k3-bekerja-di-ketinggian-tkbt', 'K3 Bekerja di Ketinggian: Sertifikasi TKBT dan Peralatan Wajib'],
        ['metode-investigasi-kecelakaan-kerja', 'Metode Investigasi Kecelakaan Kerja: Dari 5 Why hingga Fishbone'],
        ['cara-membangun-budaya-k3', 'Cara Membangun Budaya K3 yang Kuat di Perusahaan'],
        ['emergency-response-plan-perusahaan', 'Menyusun Emergency Response Plan (ERP) Perusahaan dari Nol'],
        ['ahli-k3-kimia-tugas-sertifikasi', 'Ahli K3 Kimia: Tugas, Syarat, dan Jalur Sertifikasinya'],
        ['sertifikat-k3-untuk-fresh-graduate', 'Sertifikat K3 untuk Fresh Graduate: Mana yang Paling Dicari HRD?'],
        ['k3-listrik-kewajiban-perusahaan', 'K3 Listrik: Kewajiban Perusahaan Menurut Permenaker 12/2015'],
    ];

    $pdo = get_pdo();
    $topic = null;
    foreach ($topics as $t) {
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM articles WHERE slug = ?');
        $stmt->execute([$t[0]]);
        if ((int)$stmt->fetchColumn() === 0) { $topic = $t; break; }
    }
    if (!$topic) return ['success' => false, 'error' => 'Topic queue exhausted - add more topics'];

    $ai = get_claude();
    if (!$ai) return ['success' => false, 'error' => 'No AI key configured (gemini_api_key empty)'];

    $slug = $topic[0]; $title = $topic[1];
    $system = 'Kamu adalah penulis konten senior spesialis K3 (Keselamatan dan Kesehatan Kerja) Indonesia untuk Wahana Totalita Konsultan, penyedia pelatihan K3 bersertifikasi BNSP dan KEMNAKER RI di Yogyakarta. Tulis dalam bahasa Indonesia semi-formal, akurat, mengutip nomor regulasi yang benar (Permenaker, PP, UU). Jangan mengarang fakta, statistik, atau harga.';
    $prompt = 'Tulis artikel SEO lengkap berjudul: "' . $title . '"' . "\n\n" .
        'Ketentuan WAJIB:' . "\n" .
        '- Panjang 800-1000 kata, padat dan to-the-point.' . "\n" .
        '- Konten dalam HTML: gunakan <h2>, <h3>, <p>, <ul>, <ol>, <strong>. JANGAN sertakan <h1>, <html>, <head>, atau <body>.' . "\n" .
        '- Struktur: pembuka yang menjawab intent pencarian, 4-6 bagian <h2>, penutup dengan ajakan menghubungi Wahana Totalita via WhatsApp.' . "\n" .
        '- Sertakan minimal satu link internal relevan: <a href="/pelatihan/">katalog pelatihan</a>, <a href="/glosarium/">glosarium K3</a>, atau <a href="/jadwal/">jadwal pelatihan</a>.' . "\n" .
        '- Sebutkan regulasi Indonesia yang relevan dengan nomor yang benar.' . "\n\n" .
        'Jawab HANYA dengan JSON valid (tanpa markdown fence) berformat:' . "\n" .
        '{"meta_title":"<max 65 char>","meta_desc":"<max 155 char>","keywords":"<5-8 keyword dipisah koma>","category":"<K3|Lingkungan|Sertifikasi|Regulasi>","content_html":"<artikel HTML>","faq":[{"q":"...","a":"..."},{"q":"...","a":"..."},{"q":"...","a":"..."}]}';

    // Try flash first; on transient overload fall back to flash-lite.
    $res = $ai->message($prompt, $system, 'gemini-2.5-flash-lite', 4096, true);
    if (!$res['success']) {
        sleep(5);
        $res = $ai->message($prompt, $system, 'gemini-2.5-flash', 4096, true);
    }
    if (!$res['success']) return ['success' => false, 'error' => 'AI error: ' . $res['error']];

    $raw = trim($res['text']);
    $raw = preg_replace('/^\x60\x60\x60(json)?|\x60\x60\x60$/m', '', $raw);
    $data = json_decode(trim($raw), true);
    if (!$data || empty($data['content_html'])) {
        return ['success' => false, 'error' => 'AI returned unparseable JSON', 'raw_head' => mb_substr($raw, 0, 200)];
    }

    $words = str_word_count(strip_tags($data['content_html']));
    if ($words < 450) {
        return ['success' => false, 'error' => 'Article too short (' . $words . ' words) - not published'];
    }

    $stmt = $pdo->prepare(
        'INSERT INTO articles (title, slug, meta_title, meta_desc, keywords, category, content, faq_data, author, status, published_at)
         VALUES (?,?,?,?,?,?,?,?,?,"published",NOW())'
    );
    $stmt->execute([
        $title, $slug,
        mb_substr($data['meta_title'] ?? $title, 0, 70),
        mb_substr($data['meta_desc'] ?? '', 0, 160),
        mb_substr($data['keywords'] ?? '', 0, 300),
        in_array($data['category'] ?? '', ['K3','Lingkungan','Sertifikasi','Regulasi']) ? $data['category'] : 'K3',
        $data['content_html'],
        json_encode($data['faq'] ?? [], JSON_UNESCAPED_UNICODE),
        'Wahana Totalita Konsultan',
    ]);

    $url = SITE_URL . '/artikel/' . $slug . '/';
    @file_get_contents('https://api.indexnow.org/indexnow?url=' . urlencode($url) . '&key=wahana2026indexnow');

    return ['success' => true, 'slug' => $slug, 'title' => $title, 'words' => $words, 'tokens' => $res['tokens'], 'url' => $url];
}

echo json_encode(wt_ai_write_article(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT), "\n";
