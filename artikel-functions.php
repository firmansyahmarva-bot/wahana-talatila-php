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