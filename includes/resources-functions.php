<?php
if (defined('RESOURCES_FUNCTIONS_LOADED')) return;
define('RESOURCES_FUNCTIONS_LOADED', true);
// Guard against a duplicate copy of this library being loaded elsewhere on the
// server (caused a "Cannot redeclare get_resources()" fatal on /resources/).
// (renamed to wt_get_resources: host pre-defines a global get_resources)
/**
 * includes/resources-functions.php
 * Resource Library — all DB helpers.
 */
if (!defined('SITE_URL')) require_once __DIR__ . '/../config.php';

// ── Categories ────────────────────────────────────────────────────────────────

function get_resource_categories(bool $activeOnly = true): array {
    $sql = 'SELECT rc.*, COUNT(r.id) AS resource_count
            FROM resource_categories rc
            LEFT JOIN resources r ON r.category_id = rc.id AND r.is_active = 1
            ' . ($activeOnly ? 'WHERE rc.is_active = 1 ' : '') . '
            GROUP BY rc.id
            ORDER BY rc.sort_order ASC';
    try { return get_pdo()->query($sql)->fetchAll(); }
    catch (Exception) { return []; }
}

function get_resource_category_by_slug(string $slug): ?array {
    try {
        $stmt = get_pdo()->prepare('SELECT * FROM resource_categories WHERE slug = ? LIMIT 1');
        $stmt->execute([$slug]);
        return $stmt->fetch() ?: null;
    } catch (Exception) { return null; }
}

// ── Resources ─────────────────────────────────────────────────────────────────

function wt_get_resources(array $opts = []): array {
    $where  = ['r.is_active = 1'];
    $params = [];
    if (!empty($opts['category_id'])) { $where[] = 'r.category_id = ?'; $params[] = (int)$opts['category_id']; }
    if (!empty($opts['search']))      { $where[] = 'MATCH(r.title,r.description,r.tags) AGAINST(? IN BOOLEAN MODE)'; $params[] = $opts['search'] . '*'; }
    if (isset($opts['is_gated']))     { $where[] = 'r.is_gated = ?';   $params[] = (int)$opts['is_gated']; }
    if (isset($opts['is_premium']))   { $where[] = 'r.is_premium = ?'; $params[] = (int)$opts['is_premium']; }
    $limit  = max(1, min(100, (int)($opts['limit'] ?? 20)));
    $offset = max(0, (int)($opts['offset'] ?? 0));
    $order  = in_array($opts['order'] ?? '', ['title','download_count','view_count','created_at']) ? $opts['order'] : 'sort_order';
    $dir    = ($opts['dir'] ?? 'ASC') === 'DESC' ? 'DESC' : 'ASC';
    $sql = 'SELECT r.*, rc.name AS cat_name, rc.slug AS cat_slug, rc.icon AS cat_icon
            FROM resources r
            LEFT JOIN resource_categories rc ON rc.id = r.category_id
            WHERE ' . implode(' AND ', $where) . "
            ORDER BY r.$order $dir
            LIMIT $limit OFFSET $offset";
    try {
        $stmt = get_pdo()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    } catch (Exception) { return []; }
}

function count_resources(array $opts = []): int {
    $where = ['r.is_active = 1'];
    $params = [];
    if (!empty($opts['category_id'])) { $where[] = 'r.category_id = ?'; $params[] = (int)$opts['category_id']; }
    if (!empty($opts['search']))      { $where[] = 'MATCH(r.title,r.description,r.tags) AGAINST(? IN BOOLEAN MODE)'; $params[] = $opts['search'] . '*'; }
    $sql = 'SELECT COUNT(*) FROM resources r WHERE ' . implode(' AND ', $where);
    try {
        $stmt = get_pdo()->prepare($sql);
        $stmt->execute($params);
        return (int)$stmt->fetchColumn();
    } catch (Exception) { return 0; }
}

function get_resource_by_slug(string $slug): ?array {
    try {
        $stmt = get_pdo()->prepare(
            'SELECT r.*, rc.name AS cat_name, rc.slug AS cat_slug, rc.icon AS cat_icon
             FROM resources r LEFT JOIN resource_categories rc ON rc.id = r.category_id
             WHERE r.slug = ? AND r.is_active = 1 LIMIT 1'
        );
        $stmt->execute([$slug]);
        return $stmt->fetch() ?: null;
    } catch (Exception) { return null; }
}

function get_resource_by_id(int $id): ?array {
    try {
        $stmt = get_pdo()->prepare(
            'SELECT r.*, rc.name AS cat_name, rc.slug AS cat_slug
             FROM resources r LEFT JOIN resource_categories rc ON rc.id = r.category_id
             WHERE r.id = ? LIMIT 1'
        );
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    } catch (Exception) { return null; }
}

function increment_resource_view(int $id): void {
    try { get_pdo()->prepare('UPDATE resources SET view_count = view_count + 1 WHERE id = ?')->execute([$id]); }
    catch (Exception) {}
}

function increment_resource_download(int $id): void {
    try { get_pdo()->prepare('UPDATE resources SET download_count = download_count + 1 WHERE id = ?')->execute([$id]); }
    catch (Exception) {}
}

// ── Lead Capture (email-gate before download) ─────────────────────────────────

function save_resource_lead(int $resourceId, array $data): int {
    try {
        $stmt = get_pdo()->prepare(
            'INSERT INTO resource_leads (resource_id, name, email, phone, company, jabatan, ip_address)
             VALUES (?, ?, ?, ?, ?, ?, ?)'
        );
        $stmt->execute([
            $resourceId,
            trim($data['name']    ?? ''),
            strtolower(trim($data['email'] ?? '')),
            trim($data['phone']   ?? ''),
            trim($data['company'] ?? ''),
            trim($data['jabatan'] ?? ''),
            $_SERVER['REMOTE_ADDR'] ?? '',
        ]);
        // Also upsert into newsletter_subscribers
        try {
            get_pdo()->prepare(
                'INSERT IGNORE INTO newsletter_subscribers (email, name, company, source)
                 VALUES (?, ?, ?, "resource_download")'
            )->execute([$data['email'], $data['name'], $data['company'] ?? '']);
        } catch (Exception) {}
        return (int)get_pdo()->lastInsertId();
    } catch (Exception) { return 0; }
}

function already_submitted_lead(int $resourceId, string $email): bool {
    try {
        $stmt = get_pdo()->prepare(
            'SELECT COUNT(*) FROM resource_leads WHERE resource_id = ? AND email = ? LIMIT 1'
        );
        $stmt->execute([$resourceId, strtolower(trim($email))]);
        return (int)$stmt->fetchColumn() > 0;
    } catch (Exception) { return false; }
}

// ── Admin CRUD ────────────────────────────────────────────────────────────────

function save_resource(array $data, int $id = 0): int|false {
    $pdo = get_pdo();
    $slug = make_slug($data['title']);
    // Ensure unique slug
    if ($id === 0) {
        $base = $slug; $i = 1;
        while (true) {
            $stmt = $pdo->prepare('SELECT COUNT(*) FROM resources WHERE slug = ?');
            $stmt->execute([$slug]);
            if ((int)$stmt->fetchColumn() === 0) break;
            $slug = $base . '-' . $i++;
        }
    }
    try {
        if ($id === 0) {
            $stmt = $pdo->prepare(
                'INSERT INTO resources (category_id,title,slug,description,file_path,file_type,file_size_kb,
                    is_gated,is_premium,price,tags,meta_title,meta_desc,is_active,sort_order)
                 VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)'
            );
            $stmt->execute([
                (int)$data['category_id'], $data['title'], $slug, $data['description'] ?? '',
                $data['file_path'] ?? null, $data['file_type'] ?? null, $data['file_size_kb'] ?? null,
                (int)($data['is_gated'] ?? 1), (int)($data['is_premium'] ?? 0),
                (float)($data['price'] ?? 0),
                $data['tags'] ?? null, $data['meta_title'] ?? null, $data['meta_desc'] ?? null,
                (int)($data['is_active'] ?? 1), (int)($data['sort_order'] ?? 0),
            ]);
            return (int)$pdo->lastInsertId();
        } else {
            $stmt = $pdo->prepare(
                'UPDATE resources SET category_id=?,title=?,description=?,file_path=?,file_type=?,
                    file_size_kb=?,is_gated=?,is_premium=?,price=?,tags=?,meta_title=?,meta_desc=?,
                    is_active=?,sort_order=? WHERE id=?'
            );
            $stmt->execute([
                (int)$data['category_id'], $data['title'], $data['description'] ?? '',
                $data['file_path'] ?? null, $data['file_type'] ?? null, $data['file_size_kb'] ?? null,
                (int)($data['is_gated'] ?? 1), (int)($data['is_premium'] ?? 0),
                (float)($data['price'] ?? 0),
                $data['tags'] ?? null, $data['meta_title'] ?? null, $data['meta_desc'] ?? null,
                (int)($data['is_active'] ?? 1), (int)($data['sort_order'] ?? 0), $id,
            ]);
            return $id;
        }
    } catch (Exception $e) { error_log('[resource] save: ' . $e->getMessage()); return false; }
}

function delete_resource(int $id): bool {
    try {
        $r = get_resource_by_id($id);
        if ($r && $r['file_path'] && file_exists(UPLOAD_DIR . basename($r['file_path']))) {
            @unlink(UPLOAD_DIR . basename($r['file_path']));
        }
        get_pdo()->prepare('DELETE FROM resources WHERE id = ?')->execute([$id]);
        return true;
    } catch (Exception) { return false; }
}

/**
 * Handle file upload for a resource. Returns relative path or null on failure.
 */
function upload_resource_file(array $file, int $resourceId): ?string {
    $allowed = ['pdf','doc','docx','xls','xlsx','ppt','pptx','zip'];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowed)) return null;
    if ($file['size'] > 20 * 1024 * 1024) return null; // 20 MB max
    $dir  = UPLOAD_DIR . 'resources/';
    if (!is_dir($dir)) @mkdir($dir, 0755, true);
    $name = 'res_' . $resourceId . '_' . time() . '.' . $ext;
    if (move_uploaded_file($file['tmp_name'], $dir . $name)) return 'resources/' . $name;
    return null;
}

// ── Stats for admin ────────────────────────────────────────────────────────────

function get_resource_stats(): array {
    try {
        $pdo = get_pdo();
        return [
            'total_resources'   => (int)$pdo->query('SELECT COUNT(*) FROM resources WHERE is_active=1')->fetchColumn(),
            'total_downloads'   => (int)$pdo->query('SELECT SUM(download_count) FROM resources WHERE is_active=1')->fetchColumn(),
            'total_leads'       => (int)$pdo->query('SELECT COUNT(*) FROM resource_leads')->fetchColumn(),
            'leads_today'       => (int)$pdo->query("SELECT COUNT(*) FROM resource_leads WHERE DATE(downloaded_at)=CURDATE()")->fetchColumn(),
        ];
    } catch (Exception) { return []; }
}

function get_resource_leads(int $limit = 50, int $offset = 0, int $resourceId = 0): array {
    $where  = $resourceId ? 'WHERE rl.resource_id = ' . (int)$resourceId : '';
    $sql = "SELECT rl.*, r.title AS resource_title
            FROM resource_leads rl JOIN resources r ON r.id = rl.resource_id
            $where ORDER BY rl.downloaded_at DESC LIMIT $limit OFFSET $offset";
    try { return get_pdo()->query($sql)->fetchAll(); }
    catch (Exception) { return []; }
}
