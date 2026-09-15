<?php
if (defined('AI_FUNCTIONS_LOADED')) return;
define('AI_FUNCTIONS_LOADED', true);
/**
 * includes/ai-functions.php
 * AI helpers — Claude API wrappers for website features.
 * Only loads ClaudeClient when API key is configured.
 */
if (!defined('SITE_URL')) require_once __DIR__ . '/../config.php';

function get_claude(): ?object {
    static $client = null;
    if ($client !== null) return $client;

    // Prefer Claude if its key is set; otherwise fall back to the FREE Gemini.
    // GeminiClient extends ClaudeClient and shares the identical interface, so
    // every caller (chat, lead scoring, captions, doc analysis) is unchanged.
    $claudeKey = get_setting('claude_api_key', defined('CLAUDE_API_KEY') ? CLAUDE_API_KEY : '');
    if ($claudeKey) {
        require_once __DIR__ . '/../vendor/ai/ClaudeClient.php';
        return $client = new ClaudeClient($claudeKey);
    }

    $geminiKey = get_setting('gemini_api_key', defined('GEMINI_API_KEY') ? GEMINI_API_KEY : '');
    if ($geminiKey) {
        require_once __DIR__ . '/../vendor/ai/GeminiClient.php';
        return $client = new GeminiClient($geminiKey, 120);
    }

    return null;
}

// ── AI Chat (K3 Q&A) ──────────────────────────────────────────────────────────

function ai_answer_question(string $question): array {
    $claude = get_claude();
    if (!$claude) {
        return ['success'=>false,'answer'=>keyword_answer($question),'source'=>'keyword'];
    }
    $answer = $claude->answerK3Question($question);
    return ['success'=>true,'answer'=>$answer,'source'=>'claude'];
}

/**
 * Keyword-based fallback (free, no API) — used when Claude key not configured.
 */
function keyword_answer(string $question): string {
    $q = strtolower($question);
    $answers = [
        'ahli k3 umum'   => 'Ahli K3 Umum adalah tenaga ahli yang memiliki sertifikasi dari Kemnaker RI untuk mengelola K3 di perusahaan. Persyaratan: S1/D3 + pengalaman, atau SMK + pengalaman lebih lama. Pelatihan 12 hari. Hubungi kami untuk jadwal terbaru.',
        'bnsp'           => 'BNSP (Badan Nasional Sertifikasi Profesi) adalah lembaga pemerintah yang menerbitkan sertifikat kompetensi nasional. Sertifikasi BNSP diakui secara nasional dan internasional.',
        'amdal'          => 'AMDAL (Analisis Mengenai Dampak Lingkungan) wajib bagi kegiatan usaha yang berdampak lingkungan signifikan, diatur dalam PP No. 22/2021. Wahana Totalita menyediakan konsultasi dan penyusunan dokumen AMDAL.',
        'p3k'            => 'Petugas P3K wajib ada di tempat kerja sesuai Permenaker No. 15/2008. Jumlah petugas tergantung jumlah pekerja dan tingkat risiko. Hubungi kami untuk pelatihan P3K bersertifikat Kemnaker.',
        'k3 konstruksi'  => 'K3 Konstruksi diatur dalam Permenaker No. 01/1980 dan Permen PUPR No. 21/2019. Setiap proyek konstruksi wajib memiliki Ahli K3 Konstruksi bersertifikat.',
        'forklift'       => 'Operator forklift wajib memiliki SIO (Surat Ijin Operasi) sesuai Permenaker No. 08/2020. Pelatihan minimal 30 jam. Wahana Totalita menyelenggarakan pelatihan operator forklift bersertifikat Kemnaker.',
        'kebisingan'     => 'Nilai Ambang Batas (NAB) kebisingan adalah 85 dB(A) untuk 8 jam kerja, sesuai Permenaker No. 5/2018. Gunakan kalkulator kebisingan kami di menu Tools.',
        'jsea'           => 'JSA (Job Safety Analysis) adalah teknik identifikasi bahaya per langkah pekerjaan. Gunakan template JSA gratis di menu Resources kami.',
        'smk3'           => 'SMK3 (Sistem Manajemen K3) diatur dalam PP No. 50/2012. Audit SMK3 dilakukan oleh Lembaga Audit yang ditunjuk Kemnaker. Nilai 64-84% = bendera perak, ≥85% = bendera emas.',
    ];
    foreach ($answers as $kw => $ans) {
        if (str_contains($q, $kw)) return $ans;
    }
    return 'Terima kasih atas pertanyaan Anda. Untuk jawaban lebih detail dari tenaga ahli K3 kami, silakan hubungi WhatsApp kami atau posting di Forum K3. Wahana Totalita Konsultan siap membantu! 🦺';
}

// ── AI Lead Scoring ───────────────────────────────────────────────────────────

function score_leads_batch(int $limit = 20): int {
    $pdo = get_pdo();
    try {
        $stmt = $pdo->prepare(
            'SELECT l.id, l.name, l.email, l.company, l.position AS jabatan, l.notes AS message, l.source
             FROM leads l WHERE l.ai_score = 0 LIMIT ?'
        );
        $stmt->execute([$limit]);
        $leads = $stmt->fetchAll();
    } catch (Exception) { return 0; }

    $claude = get_claude();
    if (!$claude) return 0;
    $scored = 0;
    foreach ($leads as $lead) {
        $result = $claude->scoreLead($lead);
        try {
            $pdo->prepare('UPDATE leads SET ai_score=?, ai_reason=?, pipeline_stage=? WHERE id=?')
                ->execute([$result['score'], $result['reason'], $result['priority'] === 'hot' ? 'new' : 'new', $lead['id']]);
            $scored++;
        } catch (Exception) {}
    }
    return $scored;
}

// ── Social Media Caption Generator ───────────────────────────────────────────

function generate_social_captions(string $topic, string $type = 'instagram'): array {
    $claude = get_claude();
    if (!$claude) return fallback_captions($topic);
    return $claude->generateCaptions($topic, $type) ?: fallback_captions($topic);
}

function fallback_captions(string $topic): array {
    $site = 'Wahana Totalita Konsultan';
    $tag  = '#WahanaTotalitaKonsultan #PelatihanK3 #BNSP #K3Indonesia #KeselamatanKerja';
    return [
        "⚠️ Tahukah Anda? {$topic}\n\nK3 bukan sekadar aturan, tapi investasi keselamatan nyawa pekerja Anda.\n\n📞 DM atau WA untuk info pelatihan K3 bersertifikat BNSP di Yogyakarta.\n\n{$tag}",
        "🦺 {$topic}\n\nJangan tunggu kecelakaan terjadi. Lindungi tim Anda dengan pelatihan K3 profesional.\n\n✅ Sertifikat BNSP & Kemnaker RI\n✅ Instruktur berpengalaman\n✅ Jadwal fleksibel\n\nDM untuk konsultasi gratis!\n\n{$tag}",
        "💡 {$topic}\n\nDi {$site}, kami percaya bahwa zero accident adalah mungkin dengan SDM yang terlatih.\n\n🎓 Daftarkan tim Anda sekarang!\n📍 Yogyakarta & Online\n\n{$tag}",
    ];
}

// ── Document Analyzer ─────────────────────────────────────────────────────────

function analyze_k3_document(string $docText, string $docType = 'JSA'): array {
    $claude = get_claude();
    if (!$claude) {
        return [
            'score'           => 0,
            'strengths'       => [],
            'weaknesses'      => ['AI analyzer tidak tersedia. Konfigurasi Claude API key di admin settings.'],
            'recommendations' => [],
            'regulations'     => [],
        ];
    }
    return $claude->analyzeDocument($docText, $docType);
}

// ── Content Queue Helpers ─────────────────────────────────────────────────────

function save_social_content(array $data): int|false {
    try {
        $stmt = get_pdo()->prepare(
            'INSERT INTO social_content (type, title, caption_1, caption_2, caption_3, hashtags, best_time, platform, status, created_by)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, "ready", ?)'
        );
        $stmt->execute([
            $data['type'] ?? 'tip', $data['title'],
            $data['caption_1'] ?? null, $data['caption_2'] ?? null, $data['caption_3'] ?? null,
            $data['hashtags'] ?? null, $data['best_time'] ?? '07:00-09:00 atau 19:00-21:00 WIB',
            $data['platform'] ?? 'instagram,facebook',
            $data['created_by'] ?? null,
        ]);
        return (int)get_pdo()->lastInsertId();
    } catch (Exception $e) { error_log('[social] save: ' . $e->getMessage()); return false; }
}

function get_social_content(string $status = '', int $limit = 30): array {
    $where = $status ? "WHERE status = '" . addslashes($status) . "'" : '';
    try { return get_pdo()->query("SELECT * FROM social_content $where ORDER BY created_at DESC LIMIT $limit")->fetchAll(); }
    catch (Exception) { return []; }
}
