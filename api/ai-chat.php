<?php
/**
 * api/ai-chat.php
 * AI Training Finder — No API key needed
 * Smart keyword matching against your training database
 * Returns JSON: { reply, programs[], wa_url }
 */

require_once __DIR__ . '/../config.php';

header('Content-Type: application/json; charset=utf-8');
header('X-Robots-Tag: noindex');

// ── Rate limiting (20 requests/min per session) ────────────
$now  = time();
$key  = 'ai_chat_reqs';
$reqs = array_filter($_SESSION[$key] ?? [], fn($t) => ($now - $t) < 60);
if (count($reqs) >= 30) {
    http_response_code(429);
    echo json_encode(['error' => 'Terlalu banyak permintaan.']);
    exit;
}
$reqs[] = $now;
$_SESSION[$key] = $reqs;

// ── Validate ───────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); echo json_encode(['error' => 'Method not allowed']); exit;
}
$body    = json_decode(file_get_contents('php://input'), true) ?? [];
$message = mb_strtolower(trim($body['message'] ?? ''));
if (empty($message) || mb_strlen($message) > 500) {
    http_response_code(400); echo json_encode(['error' => 'Pesan tidak valid.']); exit;
}

$wa_number = get_setting('wa_number', '6287759151278');

// ── Load all trainings ─────────────────────────────────────
$trainings = [];
try {
    $stmt = get_pdo()->query(
        "SELECT t.name, t.slug, t.price, t.certification, t.mode, t.description,
                c.name AS category, c.slug AS cat_slug
         FROM trainings t
         LEFT JOIN categories c ON c.id = t.category_id
         WHERE t.is_active = 1 ORDER BY t.sort_order ASC"
    );
    $trainings = $stmt->fetchAll();
} catch (Exception) {}

// ── Keyword → Training matching rules ─────────────────────
// Maps keywords to training slugs or category slugs
// More specific rules match first
$keyword_rules = [
    // K3 Umum
    ['keywords' => ['ahli k3 umum','ak3u','k3 umum','general k3','umum bnsp','umum kemnaker','ahli k3'], 
     'slugs' => ['pelatihan-ahli-k3-umum-sertifikasi-bnsp-online','pelatihan-ahli-k3-umum-sertifikasi-kemnaker-ri'], 'cat' => null],
    // Forklift / Alat Berat
    ['keywords' => ['forklift','fork lift','alat berat','operator forklift','crane','kran','scaffolding','perancah','angkat angkut','pesawat angkat'],
     'slugs' => null, 'cat' => 'k3', 
     'name_contains' => ['forklift','alat berat','crane','scaffolding','lift']],
    // Kebakaran / Fire
    ['keywords' => ['kebakaran','pemadam','damkar','fire','penanggulangan kebakaran','proteksi kebakaran'],
     'slugs' => null, 'cat' => 'k3',
     'name_contains' => ['kebakaran','penanggulangan','proteksi']],
    // Lingkungan / Environment
    ['keywords' => ['lingkungan','amdal','limbah','b3','pencemaran','air limbah','popal','pppa','pppu','udara','emisi','ipal'],
     'slugs' => null, 'cat' => 'lingkungan', 'name_contains' => null],
    // Mining / Pertambangan
    ['keywords' => ['pertambangan','mining','tambang','pop','pom','pou','pengawas operasional','mine'],
     'slugs' => null, 'cat' => 'mining', 'name_contains' => null],
    // ISO / QHSE
    ['keywords' => ['iso','qhse','manajemen mutu','iso 9001','iso 14001','iso 45001','audit iso','auditor iso','smk3 audit'],
     'slugs' => null, 'cat' => 'system-management', 'name_contains' => null],
    // K3 Listrik
    ['keywords' => ['listrik','electrical','electric','k3 listrik','ahli listrik','teknisi listrik'],
     'slugs' => null, 'cat' => 'k3', 'name_contains' => ['listrik']],
    // Migas / Oil Gas
    ['keywords' => ['migas','minyak gas','oil gas','pengawas migas','k3 migas','cepu'],
     'slugs' => null, 'cat' => 'k3', 'name_contains' => ['migas','cepu']],
    // H2S
    ['keywords' => ['h2s','gas berbahaya','hidrogen sulfida'],
     'slugs' => null, 'cat' => 'k3', 'name_contains' => ['h2s','gas']],
    // Confined Space / Ruang Terbatas
    ['keywords' => ['confined space','ruang terbatas','ruang sempit'],
     'slugs' => null, 'cat' => 'k3', 'name_contains' => ['ruang terbatas','confined']],
    // P3K / First Aid
    ['keywords' => ['p3k','first aid','pertolongan pertama','petugas p3k'],
     'slugs' => null, 'cat' => 'k3', 'name_contains' => ['p3k','first aid','pertolongan']],
    // Higiene Industri
    ['keywords' => ['higiene','higienis','industrial hygiene','higiene industri','himu','hima'],
     'slugs' => null, 'cat' => 'k3', 'name_contains' => ['higiene']],
    // K3 Konstruksi
    ['keywords' => ['konstruksi','construction','bangunan','proyek','sipil','k3 konstruksi','tkbt'],
     'slugs' => null, 'cat' => 'k3', 'name_contains' => ['konstruksi','tkbt','bangunan']],
    // SMK3 / Audit
    ['keywords' => ['smk3','sistem manajemen k3','auditor smk3','audit k3','pp 50 2012'],
     'slugs' => null, 'cat' => 'k3', 'name_contains' => ['smk3','auditor']],
    // Perpanjangan SKP
    ['keywords' => ['perpanjang','renewal','renew','skp','lisensi','expired','kadaluarsa','habis masa'],
     'reply_only' => 'Untuk perpanjangan SKP dan lisensi K3, silakan hubungi tim kami langsung — kami bantu proses perpanjangan sertifikat Anda sebelum kadaluarsa.',
     'slugs' => null, 'cat' => null],
    // Harga / Biaya
    ['keywords' => ['harga','biaya','berapa','cost','price','tarif','bayar'],
     'reply_only' => 'Harga program pelatihan kami mulai dari Rp 3.750.000/orang untuk program online, sudah termasuk sertifikat resmi. Program apa yang Anda minati? Saya bisa berikan info harga spesifik.',
     'slugs' => null, 'cat' => null],
    // Jadwal
    ['keywords' => ['jadwal','schedule','kapan','tanggal','bulan','batch','kelas'],
     'reply_only' => 'Jadwal pelatihan tersedia setiap bulan, baik online maupun tatap muka. Program apa yang Anda minati? Tim kami akan kirimkan jadwal terbaru via WhatsApp.',
     'slugs' => null, 'cat' => null],
    // Sertifikat / Sertifikasi
    ['keywords' => ['sertifikat','sertifikasi','certified','certification','bnsp','kemnaker'],
     'cat' => 'k3', 'slugs' => null, 'name_contains' => null],
];

// ── Match message to rules ─────────────────────────────────
$matched_trainings = [];
$reply_override    = null;

foreach ($keyword_rules as $rule) {
    $matched = false;
    foreach ($rule['keywords'] as $kw) {
        if (str_contains($message, $kw)) {
            $matched = true; break;
        }
    }
    if (!$matched) continue;

    // Reply-only rule (no program to show)
    if (!empty($rule['reply_only'])) {
        $reply_override = $rule['reply_only'];
        break;
    }

    // Match by specific slugs
    if (!empty($rule['slugs'])) {
        foreach ($trainings as $t) {
            foreach ($rule['slugs'] as $s) {
                if ($t['slug'] === $s) { $matched_trainings[] = $t; }
            }
        }
    }

    // Match by category + optional name contains
    if (!empty($rule['cat'])) {
        foreach ($trainings as $t) {
            if ($t['cat_slug'] !== $rule['cat']) continue;
            if (empty($rule['name_contains'])) {
                $matched_trainings[] = $t;
            } else {
                $name_lower = mb_strtolower($t['name']);
                foreach ($rule['name_contains'] as $nc) {
                    if (str_contains($name_lower, $nc)) {
                        $matched_trainings[] = $t; break;
                    }
                }
            }
        }
    }

    if (!empty($matched_trainings) || $reply_override) break;
}

// ── Deduplicate and limit to 3 results ─────────────────────
$seen = [];
$final_trainings = [];
foreach ($matched_trainings as $t) {
    if (!in_array($t['slug'], $seen)) {
        $seen[] = $t['slug'];
        $final_trainings[] = $t;
        if (count($final_trainings) >= 3) break;
    }
}

// ── Fallback: search by name if no rule matched ────────────
if (empty($final_trainings) && !$reply_override && mb_strlen($message) >= 3) {
    $words = preg_split('/\s+/', $message);
    foreach ($trainings as $t) {
        $name_lower = mb_strtolower($t['name']);
        foreach ($words as $word) {
            if (mb_strlen($word) >= 3 && str_contains($name_lower, $word)) {
                $slug = $t['slug'];
                if (!in_array($slug, $seen)) {
                    $seen[] = $slug;
                    $final_trainings[] = $t;
                }
                break;
            }
        }
        if (count($final_trainings) >= 3) break;
    }
}

// ── Generate reply ─────────────────────────────────────────
// Step 1: build a keyword-based fallback reply (used if AI is unavailable).
if ($reply_override) {
    $reply = $reply_override;
} elseif (!empty($final_trainings)) {
    $count = count($final_trainings);
    $names = array_map(fn($t) => $t['name'], array_slice($final_trainings, 0, 2));
    $names_str = implode(' dan ', $names);
    $intros = [
        "Saya temukan {$count} program yang sesuai untuk Anda: {$names_str}.",
        "Berikut program yang paling relevan dengan kebutuhan Anda:",
        "Program yang tepat untuk Anda adalah {$names_str}.",
    ];
    $reply = $intros[array_rand($intros)];
    if ($count >= 2) $reply .= " Tersedia online maupun tatap muka.";
    $reply .= " Klik program di bawah untuk info lengkap, atau daftar langsung via WhatsApp.";
} else {
    // Completely unmatched — show general help
    $cats = array_unique(array_column($trainings, 'category'));
    $reply = "Halo! 👋 Wahana Totalita menyediakan pelatihan K3 dan sertifikasi di bidang: "
           . implode(', ', array_slice($cats, 0, 4))
           . ". Ceritakan kebutuhan Anda — misalnya: jenis industri, program yang dicari, atau apakah butuh online atau tatap muka.";
}

// Step 2: try the real AI for a natural, conversational answer.
// Uses the same get_claude() helper as the rest of the site (Claude if its
// key is set, otherwise the free Gemini). If no key is configured or the call
// fails for any reason, we keep the keyword reply above — nothing breaks.
try {
    require_once __DIR__ . '/../includes/ai-functions.php';
    $ai = get_claude();
    if ($ai) {
        // Compact catalog so the assistant can recommend accurately.
        $catalog_lines = [];
        foreach ($trainings as $t) {
            $price = $t['price'] ? 'Rp ' . number_format((int)$t['price'], 0, ',', '.') : '-';
            $catalog_lines[] = '- ' . $t['name']
                . ' (' . ($t['category'] ?: 'K3') . ', ' . $price
                . ', ' . ($t['certification'] ?: 'Sertifikat') . ')';
        }
        $catalog_text = implode("\n", array_slice($catalog_lines, 0, 60));

        $system =
            "Anda adalah \"Asisten K3 Wahana\", asisten AI yang ramah dari Wahana Totalita "
          . "Konsultan — lembaga pelatihan & sertifikasi K3 (Keselamatan dan Kesehatan Kerja) "
          . "di Indonesia.\n\n"
          . "ATURAN MENJAWAB:\n"
          . "1. Jawab SEMUA pertanyaan pengunjung secara natural, hangat, dan singkat (maksimal 4 kalimat) dalam Bahasa Indonesia.\n"
          . "2. Jawab pertanyaan apa pun — sapaan, durasi/lama pelatihan, syarat, proses sertifikasi, perpanjangan, atau pertanyaan umum seputar K3. JANGAN hanya menyodorkan daftar program.\n"
          . "3. Setelah menjawab, jika relevan baru rekomendasikan 1-2 program dari DAFTAR PROGRAM (sebut namanya). Utamakan menjawab pertanyaan lebih dulu.\n"
          . "4. Jika tidak tahu detail pasti (harga final, tanggal jadwal), jawab sewajarnya lalu arahkan konfirmasi via WhatsApp.\n"
          . "5. Gunakan **tebal** untuk penekanan; jangan gunakan format markdown lain.\n\n"
          . "DAFTAR PROGRAM AKTIF:\n" . $catalog_text;

        // Rebuild the prior conversation for context (original casing).
        $convo = '';
        foreach (($body['history'] ?? []) as $h) {
            $role    = (($h['role'] ?? '') === 'assistant') ? 'Asisten' : 'Pengunjung';
            $content = trim((string)($h['content'] ?? ''));
            if ($content !== '') $convo .= $role . ': ' . $content . "\n";
        }
        $prompt = ($convo ? "Percakapan sebelumnya:\n" . $convo . "\n" : '')
                . "Pesan pengunjung: " . trim((string)($body['message'] ?? '')) . "\n\n"
                . "Jawab sebagai Asisten K3 Wahana:";

        $res = $ai->message($prompt, $system, 'gemini-2.5-flash-lite', 600, false);
        if (!empty($res['success']) && !empty($res['text'])) {
            $reply = $res['text'];
        }
    }
} catch (Throwable $e) {
    error_log('[ai-chat] AI reply failed: ' . $e->getMessage());
    // keep keyword reply
}

// ── Build WA message ───────────────────────────────────────
$wa_msg = 'Halo, saya ingin info program pelatihan K3';
if (!empty($final_trainings)) {
    $wa_msg = 'Halo, saya ingin info ' . $final_trainings[0]['name'];
}
$wa_url = 'https://wa.me/' . $wa_number . '?text=' . rawurlencode($wa_msg);

// ── Format programs for response ───────────────────────────
$programs_out = [];
foreach ($final_trainings as $p) {
    $programs_out[] = [
        'name'  => $p['name'],
        'slug'  => $p['slug'],
        'price' => (int)$p['price'],
        'cert'  => $p['certification'],
        'url'   => '/pelatihan/' . $p['slug'] . '/',
    ];
}

echo json_encode([
    'reply'    => $reply,
    'programs' => $programs_out,
    'wa_url'   => $wa_url,
    'show_wa'  => true,
], JSON_UNESCAPED_UNICODE);
