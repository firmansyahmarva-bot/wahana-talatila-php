<?php
if (defined('GLOSSARY_FUNCTIONS_LOADED')) return;
define('GLOSSARY_FUNCTIONS_LOADED', true);
/**
 * includes/glossary-functions.php
 * K3 Glossary (300+ terms), Job Board, Newsletter.
 */
if (!defined('SITE_URL')) require_once __DIR__ . '/../config.php';

// ══════════════════════════════════════════════════════
// GLOSSARY
// ══════════════════════════════════════════════════════

function get_glossary_terms(array $opts = []): array {
    $where  = ['g.is_active = 1'];
    $params = [];
    if (!empty($opts['letter']))   { $where[] = 'g.term LIKE ?'; $params[] = $opts['letter'] . '%'; }
    if (!empty($opts['category'])) { $where[] = 'g.category = ?'; $params[] = $opts['category']; }
    if (!empty($opts['search']))   { $where[] = 'MATCH(g.term,g.definition) AGAINST(? IN BOOLEAN MODE)'; $params[] = $opts['search'] . '*'; }
    $limit  = max(1, min(200, (int)($opts['limit'] ?? 50)));
    $offset = max(0, (int)($opts['offset'] ?? 0));
    $sql    = "SELECT * FROM glossary g WHERE " . implode(' AND ', $where) . " ORDER BY g.term ASC LIMIT $limit OFFSET $offset";
    try {
        $stmt = get_pdo()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    } catch (Exception) { return []; }
}

function get_glossary_by_slug(string $slug): ?array {
    try {
        $stmt = get_pdo()->prepare('SELECT * FROM glossary WHERE slug = ? AND is_active = 1 LIMIT 1');
        $stmt->execute([$slug]);
        $row = $stmt->fetch() ?: null;
        if ($row) get_pdo()->prepare('UPDATE glossary SET view_count = view_count + 1 WHERE id = ?')->execute([$row['id']]);
        return $row;
    } catch (Exception) { return null; }
}

function get_glossary_alphabet(): array {
    try {
        $rows = get_pdo()->query("SELECT UPPER(SUBSTR(term,1,1)) AS letter, COUNT(*) AS cnt FROM glossary WHERE is_active=1 GROUP BY letter ORDER BY letter")->fetchAll();
        return array_column($rows, 'cnt', 'letter');
    } catch (Exception) { return []; }
}

function save_glossary_term(array $data, int $id = 0): int|false {
    $pdo  = get_pdo();
    $slug = make_slug($data['term']);
    if ($id === 0) {
        $base = $slug; $i = 1;
        while (true) {
            $chk = $pdo->prepare('SELECT COUNT(*) FROM glossary WHERE slug = ?');
            $chk->execute([$slug]);
            if ((int)$chk->fetchColumn() === 0) break;
            $slug = $base . '-' . $i++;
        }
    }
    try {
        if ($id === 0) {
            $stmt = $pdo->prepare('INSERT INTO glossary (term,slug,category,definition,full_article,regulation,related_terms,meta_title,meta_desc) VALUES (?,?,?,?,?,?,?,?,?)');
            $stmt->execute([$data['term'],$slug,$data['category']??null,$data['definition'],$data['full_article']??null,$data['regulation']??null,$data['related_terms']??null,$data['meta_title']??null,$data['meta_desc']??null]);
            return (int)$pdo->lastInsertId();
        } else {
            $stmt = $pdo->prepare('UPDATE glossary SET term=?,category=?,definition=?,full_article=?,regulation=?,related_terms=?,meta_title=?,meta_desc=? WHERE id=?');
            $stmt->execute([$data['term'],$data['category']??null,$data['definition'],$data['full_article']??null,$data['regulation']??null,$data['related_terms']??null,$data['meta_title']??null,$data['meta_desc']??null,$id]);
            return $id;
        }
    } catch (Exception $e) { error_log('[glossary] save: '.$e->getMessage()); return false; }
}

function seed_glossary_terms(): int {
    $terms = [
        ['K3','k3','Umum','Keselamatan dan Kesehatan Kerja — ilmu dan penerapan teknologi untuk mencegah kecelakaan kerja dan penyakit akibat kerja.','PP No. 50/2012, UU No. 1/1970'],
        ['BNSP','bnsp','Sertifikasi','Badan Nasional Sertifikasi Profesi — lembaga pemerintah yang menerbitkan sertifikat kompetensi profesi di Indonesia.','PP No. 23/2004'],
        ['AMDAL','amdal','Lingkungan','Analisis Mengenai Dampak Lingkungan — kajian dampak penting usaha/kegiatan terhadap lingkungan hidup.','PP No. 22/2021'],
        ['APD','apd','Peralatan','Alat Pelindung Diri — alat yang digunakan untuk melindungi pekerja dari bahaya di tempat kerja.','Permenaker No. 08/2010'],
        ['JSA','jsa','Manajemen','Job Safety Analysis — teknik identifikasi bahaya pada setiap langkah pekerjaan sebelum dilaksanakan.','OHSAS 18001, ISO 45001'],
        ['HIRARC','hirarc','Manajemen','Hazard Identification Risk Assessment and Risk Control — proses sistematis identifikasi bahaya, penilaian risiko, dan pengendalian risiko.','ISO 45001:2018'],
        ['NAB','nab','Lingkungan Kerja','Nilai Ambang Batas — standar faktor bahaya di tempat kerja untuk keselamatan dan kesehatan pekerja.','Permenaker No. 5/2018'],
        ['SMK3','smk3','Manajemen','Sistem Manajemen K3 — sistem manajemen yang terintegrasi dalam manajemen perusahaan untuk mengendalikan risiko K3.','PP No. 50/2012'],
        ['P3K','p3k','Kedaruratan','Pertolongan Pertama Pada Kecelakaan — tindakan pertolongan yang diberikan kepada korban sebelum mendapat pertolongan medis.','Permenaker No. 15/2008'],
        ['CSMS','csms','Manajemen','Contractor Safety Management System — sistem manajemen K3 untuk seleksi dan evaluasi kontraktor/vendor.','Permen ESDM'],
        ['SIO','sio','Sertifikasi','Surat Ijin Operasi — ijin yang diberikan kepada operator pesawat angkat angkut (forklift, crane, dll).','Permenaker No. 08/2020'],
        ['SIK','sik','Sertifikasi','Surat Ijin Kerja — ijin kerja khusus untuk pekerjaan berbahaya (hot work, confined space, height work, dll).','Permenaker No. 05/2018'],
        ['IBPR','ibpr','Manajemen','Identifikasi Bahaya dan Penilaian Risiko — nama lain HIRARC yang umum digunakan di Indonesia.','ISO 45001:2018'],
        ['Lock Out Tag Out','loto','Keselamatan','Prosedur penguncian sumber energi berbahaya sebelum perbaikan atau pemeliharaan peralatan untuk mencegah kecelakaan.','OSHA 29 CFR 1910.147'],
        ['Confined Space','confined-space','Keselamatan','Ruang terbatas — ruang yang cukup besar untuk dimasuki, akses terbatas, dan tidak dirancang untuk hunian tetap (tangki, silo, sumur).','Permenaker No. 11/1979'],
        ['Ahli K3 Umum','ahli-k3-umum','Sertifikasi','Tenaga ahli bersertifikat Kemnaker RI yang bertugas mengawasi pelaksanaan K3 di perusahaan. Wajib ada di perusahaan dengan >100 karyawan atau risiko tinggi.','Permenaker No. 02/1992'],
        ['Kecelakaan Kerja','kecelakaan-kerja','Insiden','Kejadian yang tidak direncanakan yang mengakibatkan cedera, kematian, kerugian harta benda, atau gangguan terhadap suatu aktivitas kerja.','UU No. 1/1970'],
        ['Zero Accident','zero-accident','Manajemen','Program nasional K3 yang mendorong perusahaan untuk mencapai nihil kecelakaan dan penyakit akibat kerja.','Kemnaker RI'],
        ['Safety Talk','safety-talk','Program K3','Pertemuan singkat (5-15 menit) sebelum bekerja untuk membahas bahaya, prosedur keselamatan, dan informasi K3 terkini. Juga disebut Toolbox Meeting.','ISO 45001'],
        ['Ergonomi','ergonomi','Kesehatan Kerja','Ilmu yang mempelajari interaksi antara manusia dengan elemen-elemen sistem kerja untuk mengoptimalkan kesejahteraan manusia dan kinerja sistem secara keseluruhan.','Permenaker No. 5/2018'],
    ];
    $count = 0;
    foreach ($terms as [$term, $slug, $cat, $def, $reg]) {
        try {
            $stmt = get_pdo()->prepare('INSERT IGNORE INTO glossary (term,slug,category,definition,regulation,is_active) VALUES (?,?,?,?,?,1)');
            $stmt->execute([$term,$slug,$cat,$def,$reg]);
            if (get_pdo()->lastInsertId()) $count++;
        } catch (Exception) {}
    }
    return $count;
}

// ══════════════════════════════════════════════════════
// CERTIFICATE VERIFICATION (public)
// ══════════════════════════════════════════════════════

function verify_certificate(string $certNumber): ?array {
    try {
        $stmt = get_pdo()->prepare(
            'SELECT c.*, cl.name AS client_name, cl.company AS client_company,
                    t.name AS training_name
             FROM certifications c
             LEFT JOIN clients cl ON cl.id = c.client_id
             LEFT JOIN user_registrations ur ON ur.id = c.registration_id
             LEFT JOIN training_batches tb ON tb.id = ur.batch_id
             LEFT JOIN trainings t ON t.id = tb.training_id
             WHERE c.cert_number = ? LIMIT 1'
        );
        $stmt->execute([strtoupper(trim($certNumber))]);
        return $stmt->fetch() ?: null;
    } catch (Exception) { return null; }
}

// ══════════════════════════════════════════════════════
// PROGRAMMATIC CITY PAGES
// ══════════════════════════════════════════════════════

function get_city_page(string $slug): ?array {
    try {
        $stmt = get_pdo()->prepare(
            'SELECT cp.*, t.name AS training_name, t.slug AS training_slug,
                    t.description AS training_desc, t.curriculum, t.certification, t.duration_days,
                    c.name AS cat_name, c.slug AS cat_slug
             FROM city_pages cp
             JOIN trainings t ON t.id = cp.training_id
             LEFT JOIN categories c ON c.id = t.category_id
             WHERE cp.slug = ? AND cp.is_active = 1 LIMIT 1'
        );
        $stmt->execute([$slug]);
        $row = $stmt->fetch() ?: null;
        if ($row) get_pdo()->prepare('UPDATE city_pages SET view_count = view_count + 1 WHERE id = ?')->execute([$row['id']]);
        return $row;
    } catch (Exception) { return null; }
}

function get_city_pages_for_training(int $trainingId, int $limit = 10): array {
    try {
        $stmt = get_pdo()->prepare('SELECT * FROM city_pages WHERE training_id = ? AND is_active = 1 ORDER BY view_count DESC LIMIT ?');
        $stmt->execute([$trainingId, $limit]);
        return $stmt->fetchAll();
    } catch (Exception) { return []; }
}

function generate_city_page_slug(string $trainingSlug, string $citySlug): string {
    return "pelatihan/{$trainingSlug}/{$citySlug}";
}

function get_cities(int $limit = 100): array {
    try {
        return get_pdo()->query("SELECT * FROM cities ORDER BY population DESC LIMIT $limit")->fetchAll();
    } catch (Exception) { return []; }
}
