<?php
/**
 * artikel-functions.php
 * Article helper functions for wahanatotalita.com
 * Include AFTER config.php
 * Do NOT modify config.php — all article logic lives here
 *
 * 2026-08-11 FIX: save_article() no longer changes the slug on UPDATE,
 * under any circumstances. Previously it silently regenerated the slug
 * from title on every save, which broke live indexed article URLs
 * (confirmed cause of id 107's 404). New function change_article_slug()
 * added for deliberate, on-purpose slug changes only.
 */

require_once __DIR__ . '/includes/trust-photo.php';

// ─── Get published articles (list) ───────────────────────────────────────
function get_articles(int $limit = 12, int $offset = 0, string $category = '', string $search = ''): array {
    try {
        $where  = "WHERE a.status = 'published'";
        $params = [];
        if ($category) { $where .= " AND a.category = ?"; $params[] = $category; }
        if ($search)   { $where .= " AND (a.title LIKE ? OR a.meta_desc LIKE ?)"; $params[] = "%$search%"; $params[] = "%$search%"; }
        $sql = "SELECT id, title, slug, meta_desc, category, thumbnail,
                       author, published_at, view_count,
                       ROUND((LENGTH(content) - LENGTH(REPLACE(content,' ',''))) / 200) AS read_min
                FROM articles a $where
                ORDER BY a.published_at DESC
                LIMIT $limit OFFSET $offset";
        $stmt = get_pdo()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    } catch (Exception) { return []; }
}

// ─── Count published articles ─────────────────────────────────────────────
function count_articles(string $category = '', string $search = ''): int {
    try {
        $where  = "WHERE status = 'published'";
        $params = [];
        if ($category) { $where .= " AND category = ?"; $params[] = $category; }
        if ($search)   { $where .= " AND (title LIKE ? OR meta_desc LIKE ?)"; $params[] = "%$search%"; $params[] = "%$search%"; }
        $stmt = get_pdo()->prepare("SELECT COUNT(*) FROM articles $where");
        $stmt->execute($params);
        return (int)$stmt->fetchColumn();
    } catch (Exception) { return 0; }
}

// ─── Get single article by slug ───────────────────────────────────────────
function get_article_by_slug(string $slug): ?array {
    try {
        $stmt = get_pdo()->prepare(
            "SELECT * FROM articles WHERE slug = ? AND status = 'published' LIMIT 1"
        );
        $stmt->execute([$slug]);
        return $stmt->fetch() ?: null;
    } catch (Exception) { return null; }
}

// ─── Get article for admin (any status) ──────────────────────────────────
function get_article_by_id(int $id): ?array {
    try {
        $stmt = get_pdo()->prepare("SELECT * FROM articles WHERE id = ? LIMIT 1");
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    } catch (Exception) { return null; }
}

// ─── Related articles ─────────────────────────────────────────────────────
function get_related_articles(int $exclude_id, string $category, int $limit = 3): array {
    try {
        $stmt = get_pdo()->prepare(
            "SELECT id, title, slug, meta_desc, category, thumbnail, published_at
             FROM articles
             WHERE status = 'published' AND id != ? AND category = ?
             ORDER BY published_at DESC
             LIMIT $limit"
        );
        $stmt->execute([$exclude_id, $category]);
        $rows = $stmt->fetchAll();
        if (count($rows) < $limit) {
            $need = $limit - count($rows);
            $ids  = array_column($rows, 'id');
            $ids[] = $exclude_id;
            $placeholders = implode(',', array_fill(0, count($ids), '?'));
            $stmt2 = get_pdo()->prepare(
                "SELECT id, title, slug, meta_desc, category, thumbnail, published_at
                 FROM articles
                 WHERE status = 'published' AND id NOT IN ($placeholders)
                 ORDER BY published_at DESC LIMIT $need"
            );
            $stmt2->execute($ids);
            $rows = array_merge($rows, $stmt2->fetchAll());
        }
        return $rows;
    } catch (Exception) { return []; }
}

// ─── Article thumbnail fallback ───────────────────────────────────────────
function artikel_thumb(string $thumb = '', string $category = '', string $seed = ''): string {
    if (!empty($thumb)) {
        if (filter_var($thumb, FILTER_VALIDATE_URL) || str_starts_with($thumb, '/') || str_starts_with($thumb, 'assets/') || str_starts_with($thumb, 'images/')) {
            return $thumb;
        }
    }

    $hash_seed = $seed !== '' ? $seed : $category;
    if (function_exists('trust_photo')) {
        $real = trust_photo($hash_seed);
        if ($real !== '') return $real;
    }

    static $gal_thumbs = null;
    if ($gal_thumbs === null) {
        $td = __DIR__ . '/galeri/thumbs/';
        if (is_dir($td)) {
            $files = glob($td . '*.{jpg,JPG,jpeg,JPEG,png,PNG,webp}', GLOB_BRACE);
            $gal_thumbs = !empty($files) ? array_values(array_map('basename', $files)) : [];
        } else {
            $gal_thumbs = [];
        }
    }
    if (!empty($gal_thumbs)) {
        $idx = abs(crc32($hash_seed)) % count($gal_thumbs);
        return '/galeri/thumbs/' . rawurlencode($gal_thumbs[$idx]);
    }

    $fallbacks = [
        'K3'          => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=800&q=80&auto=format&fit=crop',
        'Lingkungan'  => 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=800&q=80&auto=format&fit=crop',
        'Mining'      => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800&q=80&auto=format&fit=crop',
        'ISO'         => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&q=80&auto=format&fit=crop',
    ];
    return $fallbacks[$category] ?? $fallbacks['K3'];
}

// ─── Estimated reading time ───────────────────────────────────────────────
function reading_time(string $html): string {
    $words = str_word_count(strip_tags($html));
    $mins  = max(1, (int)ceil($words / 200));
    return $mins . ' menit';
}

// ─── Article category badge color ─────────────────────────────────────────
function artikel_cat_color(string $cat): string {
    return match($cat) {
        'K3'         => '#C6621C',
        'Lingkungan' => '#0A4A2E',
        'Mining'     => '#8B5A2B',
        'ISO'        => '#2D7DD2',
        default      => '#6b7280',
    };
}

// ─── Format article date (Indonesian) ────────────────────────────────────
function format_article_date(string $date): string {
    $months = ['','Januari','Februari','Maret','April','Mei','Juni',
               'Juli','Agustus','September','Oktober','November','Desember'];
    $ts = strtotime($date);
    return $months[(int)date('n', $ts)] . ' ' . date('Y', $ts);
}

// ─── Get article categories with count ────────────────────────────────────
function get_article_categories(): array {
    try {
        $stmt = get_pdo()->query(
            "SELECT category, COUNT(*) as cnt
             FROM articles WHERE status = 'published'
             GROUP BY category ORDER BY cnt DESC"
        );
        return $stmt->fetchAll();
    } catch (Exception) { return []; }
}

// ─── Increment view count ─────────────────────────────────────────────────
function artikel_view_increment(int $id): void {
    try {
        get_pdo()->prepare('UPDATE articles SET view_count = view_count + 1 WHERE id = ?')->execute([$id]);
    } catch (Exception) {}
}

// ─── Admin: Save article (insert or update) — SLUG-SAFE VERSION ───────────
// UPDATE: slug is NEVER changed, no matter what the form submits. Only
// title, meta fields, category, thumbnail, content, faq, author, status,
// published_at can change on an edit.
// INSERT: slug comes from whatever was typed manually in the slug field;
// falls back to slugifying the title only if left blank (new articles only).
function save_article(array $data, int $id = 0): int|false {
    try {
        $pdo = get_pdo();
        $faq = !empty($data['faq']) ? json_encode($data['faq'], JSON_UNESCAPED_UNICODE) : null;
        $pub = $data['status'] === 'published' ? ($data['published_at'] ?: date('Y-m-d H:i:s')) : null;

        if ($id > 0) {
            // slug intentionally excluded from this UPDATE — cannot change here.
            $pdo->prepare(
                "UPDATE articles SET title=?,meta_title=?,meta_desc=?,keywords=?,
                 category=?,thumbnail=?,content=?,faq_data=?,author=?,status=?,
                 published_at=?,updated_at=NOW() WHERE id=?"
            )->execute([
                $data['title'], $data['meta_title'] ?: null,
                $data['meta_desc'] ?: null, $data['keywords'] ?: null,
                $data['category'], $data['thumbnail'] ?: null,
                $data['content'], $faq, $data['author'],
                $data['status'], $pub, $id
            ]);
            return $id;
        } else {
            $slug = make_slug($data['slug'] ?: $data['title']);
            $pdo->prepare(
                "INSERT INTO articles (title,slug,meta_title,meta_desc,keywords,
                 category,thumbnail,content,faq_data,author,status,published_at)
                 VALUES (?,?,?,?,?,?,?,?,?,?,?,?)"
            )->execute([
                $data['title'], $slug, $data['meta_title'] ?: null,
                $data['meta_desc'] ?: null, $data['keywords'] ?: null,
                $data['category'], $data['thumbnail'] ?: null,
                $data['content'], $faq, $data['author'],
                $data['status'], $pub
            ]);
            return (int)$pdo->lastInsertId();
        }
    } catch (Exception $e) { return false; }
}

// ─── Admin: Explicit, deliberate slug change (separate action, on purpose) ──
// Use this ONLY when you genuinely want to change a live article's URL.
// Returns old + new slug so a 301 redirect can be added manually.
// Does NOT run automatically — must be called on purpose.
function change_article_slug(int $id, string $new_slug): array|false {
    try {
        $pdo = get_pdo();
        $existing = get_article_by_id($id);
        if (!$existing) return false;

        $old_slug = $existing['slug'];
        $new_slug = make_slug($new_slug);

        if ($old_slug === $new_slug) {
            return ['old_slug' => $old_slug, 'new_slug' => $new_slug, 'changed' => false];
        }

        $pdo->prepare("UPDATE articles SET slug=?, updated_at=NOW() WHERE id=?")
            ->execute([$new_slug, $id]);

        return ['old_slug' => $old_slug, 'new_slug' => $new_slug, 'changed' => true];
    } catch (Exception $e) { return false; }
}

// ─── Admin: All articles (with pagination) ────────────────────────────────
function get_all_articles_admin(int $limit = 20, int $offset = 0, string $search = '', string $status = ''): array {
    try {
        $where  = "WHERE 1=1";
        $params = [];
        if ($status) { $where .= " AND status = ?"; $params[] = $status; }
        if ($search) { $where .= " AND (title LIKE ? OR slug LIKE ?)"; $params[] = "%$search%"; $params[] = "%$search%"; }
        $stmt = get_pdo()->prepare(
            "SELECT id, title, slug, category, status, published_at, view_count, created_at
             FROM articles $where ORDER BY created_at DESC LIMIT $limit OFFSET $offset"
        );
        $stmt->execute($params);
        return $stmt->fetchAll();
    } catch (Exception) { return []; }
}

function count_articles_admin(string $search = '', string $status = ''): int {
    try {
        $where  = "WHERE 1=1";
        $params = [];
        if ($status) { $where .= " AND status = ?"; $params[] = $status; }
        if ($search) { $where .= " AND (title LIKE ? OR slug LIKE ?)"; $params[] = "%$search%"; $params[] = "%$search%"; }
        $stmt = get_pdo()->prepare("SELECT COUNT(*) FROM articles $where");
        $stmt->execute($params);
        return (int)$stmt->fetchColumn();
    } catch (Exception) { return 0; }
}

// ─── Lead Hunter & Rich CTR WhatsApp Functions ────────────────────────────

if (!function_exists('wa_svg_icon')) {
    function wa_svg_icon(int $size = 18): string {
        return '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>';
    }
}

function artikel_wa_msg(string $title, string $intent = 'general'): string {
    $clean_title = trim(strip_tags($title));
    return match($intent) {
        'top' => "Halo Wahana Totalita, saya sedang membaca artikel \"{$clean_title}\" di website dan ingin tanya info jadwal pelatihan serta rincian biayanya.",
        'eligibility' => "Halo Wahana Totalita, saya membaca artikel \"{$clean_title}\". Mau tanya dan konsultasi gratis apakah kualifikasi pendidikan/jurusan saya memenuhi syarat sertifikasi ini.",
        'syllabus' => "Halo Wahana Totalita, saya tertarik dengan pembahasan \"{$clean_title}\". Boleh saya minta silabus materi lengkap dan jadwal batch pelatihan bulan ini (PDF)?",
        'corporate' => "Halo Wahana Totalita, kami butuh proposal pelatihan in-house training K3 untuk tim perusahaan kami terkait topik \"{$clean_title}\". Mohon informasi silabus dan penawaran biayanya.",
        'sidebar' => "Halo Wahana Totalita, saya ingin konsultasi pendaftaran pelatihan bersertifikasi resmi Kemnaker RI / BNSP terkait \"{$clean_title}\".",
        default => "Halo Wahana Totalita, saya sedang membaca artikel \"{$clean_title}\" dan ingin tanya informasi pelatihan terkait."
    };
}

/**
 * Top Lead Hook (Above the fold / under header)
 */
function artikel_top_hook(array $article, array $s = []): string {
    $wa_url = wa_url(artikel_wa_msg($article['title'] ?? '', 'top'));
    $cat = htmlspecialchars($article['category'] ?? 'K3');
    $svg = wa_svg_icon(19);

    return <<<HTML
    <div class="ak-top-hook" data-reveal="up">
      <div class="ak-top-hook-content">
        <div class="ak-top-hook-badge">
          <span class="ak-pulse-dot"></span>
          <span>PJK3 Resmi Kemnaker RI &amp; BNSP</span>
        </div>
        <h2 class="ak-top-hook-title">Butuh Pelatihan &amp; Sertifikasi {$cat} Resmi?</h2>
        <p class="ak-top-hook-desc">Tersedia kelas Online (Zoom) &amp; Tatap Muka berlisensi nasional. Dapatkan jadwal batch terdekat, silabus materi, dan rincian biaya.</p>
      </div>
      <div class="ak-top-hook-action">
        <a href="{$wa_url}" target="_blank" rel="noopener" class="ak-btn-wa-rich" data-wa-track="top_hook">
          {$svg}
          <span>Tanya Jadwal &amp; Biaya</span>
        </a>
        <div class="ak-top-hook-note">⚡ Respon Cepat &bull; Bebas Konsultasi</div>
      </div>
    </div>
HTML;
}

/**
 * Modern Desktop Sidebar Lead Card
 */
function artikel_sidebar_lead_card(array $article, array $s = []): string {
    $wa_url = wa_url(artikel_wa_msg($article['title'] ?? '', 'sidebar'));
    $svg = wa_svg_icon(17);
    $wa_num = htmlspecialchars($s['wa_number'] ?? '0877-5915-1278');

    return <<<HTML
    <div class="ak-sidebar-lead-card">
      <div class="ak-slc-header">
        <div class="ak-slc-status">
          <span class="ak-pulse-dot"></span>
          <span>Admin K3 Online</span>
        </div>
        <h4 class="ak-slc-title">Konsultasi Pelatihan K3</h4>
      </div>
      <ul class="ak-slc-list">
        <li>
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#25D366" stroke-width="3" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
          <span>Sertifikat Resmi Kemnaker / BNSP</span>
        </li>
        <li>
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#25D366" stroke-width="3" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
          <span>Batch Terdekat Buka Pendaftaran</span>
        </li>
        <li>
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#25D366" stroke-width="3" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
          <span>Bisa Kelas Publik / In-House Kantor</span>
        </li>
      </ul>
      <a href="{$wa_url}" target="_blank" rel="noopener" class="ak-slc-btn" data-wa-track="sidebar">
        {$svg}
        <span>Chat WhatsApp Konsultan</span>
      </a>
      <div class="ak-slc-footer">
        <a href="/jadwal/" class="ak-slc-schedule-link">📅 Cek Kalender Jadwal Aktif &rarr;</a>
        <span class="ak-slc-phone">WA: {$wa_num}</span>
      </div>
    </div>
HTML;
}

/**
 * In-Content Slot 1: Qualification & Eligibility Box
 */
function artikel_incontent_slot1(array $article, array $s = []): string {
    $wa_url = wa_url(artikel_wa_msg($article['title'] ?? '', 'eligibility'));
    $svg = wa_svg_icon(17);

    return <<<HTML
    <div class="ak-lead-box ak-lead-early" data-reveal="up">
      <div class="ak-lead-box-top">
        <span class="ak-lead-tag">💡 KONSULTASI KUALIFIKASI GRATIS</span>
        <span class="ak-lead-time">Respon &lt; 5 Menit</span>
      </div>
      <h3 class="ak-lead-title">Ragu Apakah Jurusan &amp; Dokumen Anda Memenuhi Syarat?</h3>
      <p class="ak-lead-desc">Persyaratan sertifikasi K3 memiliki kriteria pendidikan minimal (SMA/SMK, D3, atau S1) dan ketentuan administrasi tertentu. Jangan buang waktu menerka — konsultasikan berkas &amp; latar belakang Anda secara gratis dengan tim spesialis kami.</p>
      <div class="ak-lead-cta-row">
        <a href="{$wa_url}" target="_blank" rel="noopener" class="ak-btn-wa-compact" data-wa-track="in_content_early">
          {$svg}
          <span>Cek Kelayakan Saya via WhatsApp &rarr;</span>
        </a>
      </div>
    </div>
HTML;
}

/**
 * In-Content Slot 2: Syllabus & Batch Schedule Magnet
 */
function artikel_incontent_slot2(array $article, array $s = []): string {
    $wa_url = wa_url(artikel_wa_msg($article['title'] ?? '', 'syllabus'));
    $svg = wa_svg_icon(18);

    return <<<HTML
    <div class="ak-lead-box ak-lead-mid" data-reveal="up">
      <div class="ak-lead-mid-glow" aria-hidden="true"></div>
      <div class="ak-lead-mid-inner">
        <div class="ak-lead-mid-badge">
          <span>📋 SILABUS &amp; BIAYA RESMI</span>
        </div>
        <h3 class="ak-lead-mid-title">Dapatkan Silabus Materi Lengkap &amp; Jadwal Batch Terbaru</h3>
        <p class="ak-lead-mid-desc">Butuh rundown materi 120 JPL, materi ujian, jadwal Online Zoom / Tatap Muka, atau format proposal anggaran untuk diajukan ke manajemen kantor? Kami kirimkan langsung dokumen PDF resminya via WhatsApp.</p>
        <div class="ak-lead-mid-features">
          <span>✓ Silabus Kurikulum Resmi</span>
          <span>✓ Kalender Batch Terbuka</span>
          <span>✓ Estimasi Investasi &amp; Diskon Rombongan</span>
        </div>
        <div class="ak-lead-mid-actions">
          <a href="{$wa_url}" target="_blank" rel="noopener" class="ak-btn-wa-hero" data-wa-track="in_content_mid">
            {$svg}
            <span>Minta File Silabus &amp; Jadwal (PDF)</span>
          </a>
          <a href="/jadwal/" class="ak-link-secondary">Lihat Semua Jadwal &rarr;</a>
        </div>
      </div>
    </div>
HTML;
}

/**
 * Bottom Corporate & In-House Training Card
 */
function artikel_bottom_corporate(array $article, array $s = []): string {
    $wa_url = wa_url(artikel_wa_msg($article['title'] ?? '', 'corporate'));
    $svg = wa_svg_icon(18);

    return <<<HTML
    <div class="ak-bottom-corporate" data-reveal="up">
      <div class="ak-bc-icon">🏢</div>
      <div class="ak-bc-content">
        <span class="ak-bc-badge">Layanan Perusahaan &amp; B2G</span>
        <h3 class="ak-bc-title">Kebutuhan In-House Training K3 untuk Perusahaan Anda?</h3>
        <p class="ak-bc-desc">Wahana Totalita Konsultan menyelenggarakan In-House Training berlisensi Kemnaker RI &amp; BNSP di seluruh wilayah Indonesia. Materi disesuaikan dengan potensi bahaya industri Anda, jadwal fleksibel, dan penawaran biaya grup yang efisien.</p>
      </div>
      <div class="ak-bc-action">
        <a href="{$wa_url}" target="_blank" rel="noopener" class="ak-btn-wa-rich" data-wa-track="bottom_corporate">
          {$svg}
          <span>Minta Penawaran RAB In-House &rarr;</span>
        </a>
      </div>
    </div>
HTML;
}

/**
 * Sticky Mobile Bottom Bar (Screen <= 768px)
 */
function artikel_mobile_sticky_bar(array $article, array $s = []): string {
    $wa_url = wa_url(artikel_wa_msg($article['title'] ?? '', 'top'));
    $svg = wa_svg_icon(17);

    return <<<HTML
    <div class="ak-mobile-sticky-bar" id="akMobileStickyBar" role="region" aria-label="WhatsApp Lead Hunter">
      <div class="ak-msb-info">
        <div class="ak-msb-status">
          <span class="ak-pulse-dot"></span>
          <span>Konsultan K3 Online</span>
        </div>
        <div class="ak-msb-text">Tanya Biaya &amp; Jadwal Terdekat</div>
      </div>
      <a href="{$wa_url}" target="_blank" rel="noopener" class="ak-msb-btn" data-wa-track="mobile_sticky">
        {$svg}
        <span>Chat WA</span>
      </a>
    </div>
HTML;
}

/**
 * Automatic In-Content CTA Injector
 * Injects Slot 1 after Paragraph 2/3 and Slot 2 near the middle (50%)
 */
function inject_article_lead_ctas(string $content, array $article, array $s = []): string {
    if (empty(trim($content))) return $content;

    // Pattern to identify closing paragraph tags
    $pattern = '/(<\/p>)/i';
    $parts = preg_split($pattern, $content, -1, PREG_SPLIT_DELIM_CAPTURE);
    if (!$parts || count($parts) < 3) {
        // Less than 2 paragraphs: append Slot 1 and Slot 2 gracefully
        return $content . artikel_incontent_slot1($article, $s) . artikel_incontent_slot2($article, $s);
    }

    $slot1_html = artikel_incontent_slot1($article, $s);
    $slot2_html = artikel_incontent_slot2($article, $s);

    // Count how many <p> chunks exist
    $p_count = 0;
    foreach ($parts as $part) {
        if (strcasecmp($part, '</p>') === 0) $p_count++;
    }

    // Determine injection points:
    // Slot 1: after paragraph 2
    // Slot 2: at ~50% paragraph count (minimum paragraph 4, maximum paragraph 8)
    $slot1_target = min(2, $p_count);
    $slot2_target = $p_count >= 5 ? (int)floor($p_count / 2) + 1 : 0;
    if ($slot2_target <= $slot1_target) {
        $slot2_target = $p_count >= 4 ? $p_count - 1 : 0;
    }

    $out = '';
    $current_p = 0;
    foreach ($parts as $part) {
        $out .= $part;
        if (strcasecmp($part, '</p>') === 0) {
            $current_p++;
            if ($current_p === $slot1_target) {
                $out .= "\n" . $slot1_html . "\n";
            }
            if ($slot2_target > 0 && $current_p === $slot2_target) {
                $out .= "\n" . $slot2_html . "\n";
            }
        }
    }

    // If content was short and slot 2 hasn't been placed, append slot 2 at the bottom
    if ($slot2_target === 0 && $p_count >= 2) {
        $out .= "\n" . $slot2_html . "\n";
    }

    // Contextual interlinking to relevant pelatihan pages
    $out = artikel_autolink_pelatihan($out, $article);

    return $out;
}

/**
 * Pelatihan Relevance & Interlinking Dictionary
 */
function get_pelatihan_interlinks_catalog(): array {
    return [
        [
            'slug'        => 'pelatihan-ahli-k3-umum-sertifikasi-kemnaker-ri',
            'title'       => 'Pelatihan Ahli K3 Umum Sertifikasi Kemnaker RI',
            'cert'        => 'Kemnaker RI',
            'badge'       => 'Sertifikasi Wajib',
            'category'    => 'K3',
            'keywords'    => ['ahli k3 umum kemnaker', 'ahli k3 umum', 'pembinaan ahli k3 umum', 'sertifikasi ahli k3 umum', 'ak3u kemnaker', 'ahli k3']
        ],
        [
            'slug'        => 'pelatihan-ahli-muda-k3-konstruksi-online',
            'title'       => 'Pelatihan Ahli Muda K3 Konstruksi Sertifikasi Kemnaker RI',
            'cert'        => 'Kemnaker RI',
            'badge'       => 'Tender Proyek LPSE',
            'category'    => 'K3',
            'keywords'    => ['ahli muda k3 konstruksi', 'ahli k3 konstruksi', 'k3 konstruksi', 'petugas k3 konstruksi', 'smk3 konstruksi', 'rk3k']
        ],
        [
            'slug'        => 'pelatihan-k3-operator-forklift-kelas-2-sertifikasi-kemnaker-ri',
            'title'       => 'Pelatihan K3 Operator Forklift Kelas II Kemnaker RI',
            'cert'        => 'Kemnaker RI',
            'badge'       => 'Lisensi K3 & SIO',
            'category'    => 'K3',
            'keywords'    => ['operator forklift', 'sio forklift', 'lisensi k3 operator forklift', 'forklift kelas 2', 'forklift']
        ],
        [
            'slug'        => 'pelatihan-k3-operator-scaffolding-sertifikasi-kemnaker-ri',
            'title'       => 'Pelatihan K3 Operator Scaffolding Sertifikasi Kemnaker RI',
            'cert'        => 'Kemnaker RI',
            'badge'       => 'Teknisi Perancah',
            'category'    => 'K3',
            'keywords'    => ['operator scaffolding', 'scaffolding', 'perancah', 'teknisi scaffolding', 'inspeksi scaffolding']
        ],
        [
            'slug'        => 'pelatihan-ahli-k3-listrik-sertifikasi-kemnaker-ri',
            'title'       => 'Pelatihan Ahli K3 Listrik Sertifikasi Kemnaker RI',
            'cert'        => 'Kemnaker RI',
            'badge'       => 'PUIL 2011 & Permenaker 12/2015',
            'category'    => 'K3',
            'keywords'    => ['ahli k3 listrik', 'teknisi k3 listrik', 'k3 listrik', 'puil 2011', 'arc flash', 'lockout tagout', 'loto']
        ],
        [
            'slug'        => 'pelatihan-teknisi-confined-space-sertifikasi-kemnaker-ri',
            'title'       => 'Pelatihan Teknisi K3 Ruang Terbatas (Confined Space) Kemnaker RI',
            'cert'        => 'Kemnaker RI',
            'badge'       => 'Ruang Terbatas',
            'category'    => 'K3',
            'keywords'    => ['confined space', 'ruang terbatas', 'teknisi confined space', 'petugas utama ruang terbatas', 'gas detector']
        ],
        [
            'slug'        => 'pelatihan-tkbt-ii-sertifikasi-kemnaker-ri',
            'title'       => 'Pelatihan Tenaga Kerja Bangunan Tinggi (TKBT II) Kemnaker RI',
            'cert'        => 'Kemnaker RI',
            'badge'       => 'Bekerja di Ketinggian',
            'category'    => 'K3',
            'keywords'    => ['tkbt ii', 'tkbt 2', 'tkbt 1', 'bekerja di ketinggian', 'k3 ketinggian', 'full body harness']
        ],
        [
            'slug'        => 'pelatihan-damkar-paralel-kelas-dcba-sertifikasi-kemnaker-ri',
            'title'       => 'Pelatihan Penanggulangan Kebakaran Kelas D, C, B, A Kemnaker RI',
            'cert'        => 'Kemnaker RI',
            'badge'       => 'Tanggap Darurat',
            'category'    => 'K3',
            'keywords'    => ['damkar kelas', 'damkar', 'fire watcher', 'penanggulangan kebakaran', 'proteksi kebakaran']
        ],
        [
            'slug'        => 'pelatihan-pplb3-online',
            'title'       => 'Pelatihan Pengelolaan Limbah B3 (PPLB3) Sertifikasi BNSP',
            'cert'        => 'BNSP',
            'badge'       => 'Lingkungan Hidup',
            'category'    => 'Lingkungan',
            'keywords'    => ['pplb3', 'pengelolaan limbah b3', 'limbah b3', 'amdal', 'persetujuan lingkungan', 'ukl upl']
        ],
        [
            'slug'        => 'pelatihan-penanggung-jawab-pengendalian-pencemaran-air-pppa-sertifikasi-bnsp',
            'title'       => 'Pelatihan Penanggung Jawab Pengendalian Pencemaran Air (PPPA) BNSP',
            'cert'        => 'BNSP',
            'badge'       => 'Sertifikasi BNSP',
            'category'    => 'Lingkungan',
            'keywords'    => ['pppa', 'pencemaran air', 'ipal', 'air limbah']
        ],
        [
            'slug'        => 'pelatihan-penanggung-jawab-pengendalian-pencemaran-udara-pppu-sertifikasi-bnsp',
            'title'       => 'Pelatihan Penanggung Jawab Pengendalian Pencemaran Udara (PPPU) BNSP',
            'cert'        => 'BNSP',
            'badge'       => 'Sertifikasi BNSP',
            'category'    => 'Lingkungan',
            'keywords'    => ['pppu', 'pencemaran udara', 'emisi udara']
        ],
        [
            'slug'        => 'pelatihan-lead-auditor-iso-45001-online',
            'title'       => 'Pelatihan Lead Auditor ISO 45001:2018 (SMK3 Internasional)',
            'cert'        => 'Sertifikat Internasional',
            'badge'       => 'Audit & Sistem',
            'category'    => 'System Management',
            'keywords'    => ['lead auditor iso 45001', 'internal auditor iso 45001', 'iso 45001', 'audit smk3', 'smk3 pp 50 2012', 'smk3']
        ],
        [
            'slug'        => 'pelatihan-csms-pengawas-smk3-kontraktor-online',
            'title'       => 'Pelatihan Contractor Safety Management System (CSMS)',
            'cert'        => 'K3 Kontraktor',
            'badge'       => 'Pra-Kualifikasi Tender',
            'category'    => 'K3',
            'keywords'    => ['csms', 'kontraktor k3', 'manajemen kontraktor', 'hse kontraktor']
        ],
        [
            'slug'        => 'pelatihan-pou-pertambangan-sertifikasi-bnsp-online',
            'title'       => 'Pelatihan Pengawas Operasional Utama (POU) Pertambangan BNSP',
            'cert'        => 'BNSP',
            'badge'       => 'Pertambangan',
            'category'    => 'Mining',
            'keywords'    => ['pou pertambangan', 'pop pertambangan', 'pom pertambangan', 'k3 pertambangan', 'tambang']
        ],
        [
            'slug'        => 'pelatihan-petugas-k3-rumah-sakit-sertifikasi-bnsp-online',
            'title'       => 'Pelatihan Petugas K3 Rumah Sakit Sertifikasi BNSP',
            'cert'        => 'BNSP',
            'badge'       => 'Kesehatan & RS',
            'category'    => 'K3',
            'keywords'    => ['k3 rumah sakit', 'petugas k3 rumah sakit', 'k3 fasilitas pelayanan kesehatan']
        ],
        [
            'slug'        => 'pelatihan-k3-operator-welder-kelas-1-sertifikasi-kemnaker-ri',
            'title'       => 'Pelatihan Juru Las (Welder) Kelas 1 Kemnaker RI',
            'cert'        => 'Kemnaker RI',
            'badge'       => 'Juru Las',
            'category'    => 'K3',
            'keywords'    => ['operator welder', 'juru las kemnaker', 'welder kelas 1', 'juru las']
        ],
        [
            'slug'        => 'pelatihan-accident-investigation-online',
            'title'       => 'Pelatihan Investigasi Kecelakaan Kerja (Accident Investigation)',
            'cert'        => 'HSE Specialist',
            'badge'       => 'Investigasi Insiden',
            'category'    => 'K3',
            'keywords'    => ['investigasi kecelakaan', 'accident investigation', 'analisis kecelakaan kerja', 'near miss']
        ]
    ];
}

/**
 * In-content keyword autolinking to relevant pelatihan pages
 */
function artikel_autolink_pelatihan(string $html, array $article = []): string {
    $mappings = get_pelatihan_interlinks_catalog();
    
    $rules = [];
    foreach ($mappings as $m) {
        $url = '/pelatihan/' . $m['slug'] . '/';
        foreach ($m['keywords'] as $kw) {
            $rules[] = [
                'kw'    => $kw,
                'len'   => mb_strlen($kw),
                'url'   => $url,
                'title' => $m['title'],
                'cert'  => $m['cert']
            ];
        }
    }
    usort($rules, fn($a, $b) => $b['len'] <=> $a['len']);

    $tokens = preg_split('/(<[^>]+>)/is', $html, -1, PREG_SPLIT_DELIM_CAPTURE);
    if (!$tokens) return $html;

    $in_anchor = false;
    $in_heading = false;
    $in_code = false;
    $in_leadbox = false;
    
    $linked_urls = [];
    $max_links = 4;
    $total_linked = 0;

    $result = '';
    foreach ($tokens as $token) {
        if ($token === '') continue;

        if (preg_match('/^<a\b/i', $token)) {
            $in_anchor = true;
            $result .= $token;
            continue;
        }
        if (preg_match('/^<\/a>/i', $token)) {
            $in_anchor = false;
            $result .= $token;
            continue;
        }
        if (preg_match('/^<h[1-6]\b/i', $token)) {
            $in_heading = true;
            $result .= $token;
            continue;
        }
        if (preg_match('/^<\/h[1-6]>/i', $token)) {
            $in_heading = false;
            $result .= $token;
            continue;
        }
        if (preg_match('/^<(code|pre|script|style)\b/i', $token)) {
            $in_code = true;
            $result .= $token;
            continue;
        }
        if (preg_match('/^<\/(code|pre|script|style)>/i', $token)) {
            $in_code = false;
            $result .= $token;
            continue;
        }
        if (preg_match('/class=["\'][^"\']*ak-lead-box/i', $token)) {
            $in_leadbox = true;
            $result .= $token;
            continue;
        }

        if ($token[0] === '<') {
            $result .= $token;
            continue;
        }

        if (!$in_anchor && !$in_heading && !$in_code && !$in_leadbox && $total_linked < $max_links) {
            $text = $token;
            foreach ($rules as $rule) {
                if ($total_linked >= $max_links) break;
                if (isset($linked_urls[$rule['url']])) continue;

                $kw = preg_quote($rule['kw'], '/');
                $pattern = '/(?<![a-zA-Z0-9_\/])(' . $kw . ')(?![a-zA-Z0-9_])/iu';
                
                if (preg_match($pattern, $text)) {
                    $replacement = '<a href="' . $rule['url'] . '" class="ak-inline-pelatihan-link" title="Pelajari ' . htmlspecialchars($rule['title']) . ' (' . htmlspecialchars($rule['cert']) . ')">$1</a>';
                    $text = preg_replace($pattern, $replacement, $text, 1);
                    $linked_urls[$rule['url']] = true;
                    $total_linked++;
                }
            }
            $result .= $text;
        } else {
            $result .= $token;
        }
    }

    return $result;
}

/**
 * Score and find the top relevant training programs for an article
 */
function artikel_get_relevant_trainings(array $article, int $limit = 3): array {
    $mappings = get_pelatihan_interlinks_catalog();
    $scored = [];

    $text_to_search = mb_strtolower(
        ($article['title'] ?? '') . ' ' .
        ($article['slug'] ?? '') . ' ' .
        ($article['keywords'] ?? '') . ' ' .
        strip_tags($article['content'] ?? '')
    );

    $title_lower = mb_strtolower($article['title'] ?? '');
    $cat_lower = mb_strtolower($article['category'] ?? '');

    foreach ($mappings as $t) {
        $score = 0;
        foreach ($t['keywords'] as $kw) {
            $kw_lower = mb_strtolower($kw);
            if (str_contains($title_lower, $kw_lower)) {
                $score += 15;
            }
            $count = substr_count($text_to_search, $kw_lower);
            if ($count > 0) {
                $score += min(10, $count * 3);
            }
        }
        if (!empty($t['category']) && mb_strtolower($t['category']) === $cat_lower) {
            $score += 2;
        }

        $scored[] = [
            'training' => $t,
            'score'    => $score
        ];
    }

    usort($scored, fn($a, $b) => $b['score'] <=> $a['score']);

    $results = [];
    foreach ($scored as $item) {
        if (count($results) >= $limit) break;
        $results[] = $item['training'];
    }

    return $results;
}

/**
 * Renders a high-converting "Program Pelatihan Terkait" recommendation block
 */
function artikel_relevant_trainings_block(array $article, array $s = []): string {
    $trainings = artikel_get_relevant_trainings($article, 3);
    if (empty($trainings)) return '';

    $cards_html = '';
    foreach ($trainings as $t) {
        $wa_msg = artikel_wa_msg($article['title'] ?? '', 'syllabus') . '%20Saya%20tertarik%20dengan%20program%20' . rawurlencode($t['title']) . '.';
        $wa_url = wa_url($wa_msg);
        $url = '/pelatihan/' . $t['slug'] . '/';
        $cert_cls = str_contains($t['cert'], 'BNSP') ? 'ak-rt-cert-bnsp' : 'ak-rt-cert-kemnaker';

        $cards_html .= <<<HTML
        <div class="ak-rt-card">
          <div class="ak-rt-card-top">
            <span class="ak-rt-cert {$cert_cls}">{$t['cert']}</span>
            <span class="ak-rt-tag">{$t['badge']}</span>
          </div>
          <h4 class="ak-rt-card-title">
            <a href="{$url}">{$t['title']}</a>
          </h4>
          <ul class="ak-rt-perks">
            <li><span>✓</span> Kelas Online Zoom &amp; Tatap Muka</li>
            <li><span>✓</span> Sertifikat &amp; Lisensi Resmi Terverifikasi</li>
            <li><span>✓</span> Jadwal Batch Terdekat Buka Pendaftaran</li>
          </ul>
          <div class="ak-rt-actions">
            <a href="{$url}" class="ak-rt-btn-info">Lihat Silabus &rarr;</a>
            <a href="{$wa_url}" target="_blank" rel="noopener" class="ak-rt-btn-wa" data-wa-track="relevant_training_wa">
              Tanya Jadwal WA
            </a>
          </div>
        </div>
HTML;
    }

    return <<<HTML
    <section class="ak-relevant-trainings" data-reveal="up" aria-label="Program Pelatihan Terkait">
      <div class="ak-rt-head">
        <div class="ak-rt-head-badge"><span class="ak-pulse-dot"></span> PJK3 Resmi &amp; Lembaga Sertifikasi Terakreditasi</div>
        <h3 class="ak-rt-head-title">Program Pelatihan &amp; Sertifikasi Terkait</h3>
        <p class="ak-rt-head-sub">Tingkatkan kualifikasi profesional atau lengkapi kepatuhan regulasi K3 perusahaan Anda melalui program pelatihan berlisensi resmi Wahana Totalita:</p>
      </div>
      <div class="ak-rt-grid">
        {$cards_html}
      </div>
    </section>
HTML;
}
