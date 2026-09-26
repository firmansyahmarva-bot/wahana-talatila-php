<?php
/**
 * api/trainings.php
 * Secure REST API for Training Content Management.
 * Supports: Search/List, Read, Create, Partial/Full Update, and Archive.
 * 
 * Flow: Agent / Client -> HTTPS + Bearer Token -> MySQL (Single Source of Truth)
 */

require_once __DIR__ . '/includes/api-common.php';
require_once __DIR__ . '/../includes/hub-category-map.php';

// Enforce authentication
require_api_auth();

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

// Support Method Override for environments where PUT/PATCH/DELETE are restricted
if ($method === 'POST') {
    $override = $_POST['_method'] ?? ($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE'] ?? '');
    if ($override) {
        $method = strtoupper($override);
    }
}

// ─── ROUTER ───────────────────────────────────────────────────────────────
switch ($method) {
    case 'GET':
        handle_get(get_pdo());
        break;

    case 'POST':
        handle_post(get_pdo());
        break;

    case 'PUT':
    case 'PATCH':
        handle_put(get_pdo());
        break;

    case 'DELETE':
        handle_delete(get_pdo());
        break;

    case 'TEST':
        // Test mode for automated unit verification
        break;

    default:
        api_error("HTTP method {$method} is not supported.", 405, [], 'METHOD_NOT_ALLOWED');
}

// ─── HANDLER: GET (Read / Search / Audit Logs) ─────────────────────────────
function handle_get(PDO $pdo): never {
    $action = $_GET['action'] ?? '';

    // Sub-route: Audit Logs
    if ($action === 'audit_logs') {
        ensure_audit_log_table($pdo);
        $trainingId = isset($_GET['id']) ? (int)$_GET['id'] : null;
        $slug = isset($_GET['slug']) ? trim($_GET['slug']) : null;
        $limit = min(100, max(1, (int)($_GET['limit'] ?? 50)));

        $where = ["entity_type = 'training'"];
        $params = [];
        if ($trainingId) {
            $where[] = "entity_id = ?";
            $params[] = $trainingId;
        }
        if ($slug) {
            $where[] = "slug = ?";
            $params[] = $slug;
        }

        $sql = "SELECT id, entity_type, entity_id, slug, action, actor, changes_json, ip_address, created_at
                FROM content_audit_logs
                WHERE " . implode(' AND ', $where) . "
                ORDER BY id DESC LIMIT $limit";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        $logs = $stmt->fetchAll();

        foreach ($logs as &$log) {
            if (!empty($log['changes_json'])) {
                $log['changes'] = json_decode($log['changes_json'], true);
            } else {
                $log['changes'] = null;
            }
            unset($log['changes_json']);
        }

        api_success($logs, 'Audit logs retrieved');
    }

    // Sub-route: Single Training by ID or Slug
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';

    if ($id > 0 || $slug !== '') {
        $sql = "SELECT t.*, c.name AS cat_name, c.slug AS cat_slug, c.icon AS cat_icon, c.accent_color
                FROM trainings t
                LEFT JOIN categories c ON c.id = t.category_id
                WHERE " . ($id > 0 ? "t.id = ?" : "t.slug = ?") . " LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id > 0 ? $id : $slug]);
        $row = $stmt->fetch();

        if (!$row) {
            api_error('Training program not found.', 404, [], 'NOT_FOUND');
        }

        // Format and enrich response
        $training = format_training_record($row);
        api_success($training, 'Training retrieved');
    }

    // Sub-route: List & Filter Trainings
    $search = trim($_GET['q'] ?? '');
    $cat = trim($_GET['cat'] ?? '');
    $mode = trim($_GET['mode'] ?? '');
    $status = trim($_GET['status'] ?? 'active'); // 'active', 'inactive', 'all'
    $fields = trim($_GET['fields'] ?? 'summary'); // 'summary' or 'full'
    $page = max(1, (int)($_GET['page'] ?? 1));
    $limit = min(100, max(1, (int)($_GET['limit'] ?? 20)));
    $offset = ($page - 1) * $limit;

    $where = ['1=1'];
    $params = [];

    if ($search !== '') {
        $where[] = "(t.name LIKE ? OR t.slug LIKE ? OR t.description LIKE ?)";
        $wild = "%$search%";
        $params[] = $wild;
        $params[] = $wild;
        $params[] = $wild;
    }

    if ($cat !== '') {
        if (ctype_digit($cat)) {
            $where[] = "t.category_id = ?";
            $params[] = (int)$cat;
        } else {
            $where[] = "c.slug = ?";
            $params[] = $cat;
        }
    }

    if (in_array($mode, ['online', 'offline', 'both'], true)) {
        $where[] = "t.mode = ?";
        $params[] = $mode;
    }

    if ($status === 'active') {
        $where[] = "t.is_active = 1";
    } elseif ($status === 'inactive') {
        $where[] = "t.is_active = 0";
    }

    $whereSql = implode(' AND ', $where);

    // Count total
    $cntStmt = $pdo->prepare("SELECT COUNT(*) FROM trainings t LEFT JOIN categories c ON c.id = t.category_id WHERE $whereSql");
    $cntStmt->execute($params);
    $total = (int)$cntStmt->fetchColumn();

    // Select rows
    $selectCols = ($fields === 'full')
        ? "t.*, c.name AS cat_name, c.slug AS cat_slug, c.icon AS cat_icon, c.accent_color"
        : "t.id, t.name, t.slug, t.mode, t.certification, t.price, t.duration_days,
           t.is_featured, t.is_active, t.sort_order, t.view_count, t.updated_at,
           c.name AS cat_name, c.slug AS cat_slug";

    $stmt = $pdo->prepare("
        SELECT $selectCols
        FROM trainings t
        LEFT JOIN categories c ON c.id = t.category_id
        WHERE $whereSql
        ORDER BY t.sort_order ASC, t.id ASC
        LIMIT $limit OFFSET $offset
    ");
    $stmt->execute($params);
    $rows = $stmt->fetchAll();

    $items = array_map('format_training_record', $rows);

    api_success($items, 'Trainings list retrieved', 200, [
        'total'        => $total,
        'page'         => $page,
        'limit'        => $limit,
        'total_pages'  => (int)ceil($total / $limit),
    ]);
}

// ─── HANDLER: POST (Create / Action) ───────────────────────────────────────
function handle_post(PDO $pdo): never {
    $input = get_json_input();
    $action = $input['action'] ?? ($_GET['action'] ?? '');

    // Allow delegating archive/delete via POST
    if ($action === 'archive' || $action === 'delete') {
        $_GET['action'] = $action;
        handle_delete($pdo);
    }

    // Validation
    $name = trim($input['name'] ?? '');
    if ($name === '') {
        api_error('Field "name" is required.', 422, ['name' => 'Nama program wajib diisi.'], 'VALIDATION_ERROR');
    }

    // Resolve Category ID
    $catId = (int)($input['category_id'] ?? 0);
    if ($catId <= 0 && !empty($input['category_slug'])) {
        $cStmt = $pdo->prepare('SELECT id FROM categories WHERE slug = ? LIMIT 1');
        $cStmt->execute([trim($input['category_slug'])]);
        $catId = (int)$cStmt->fetchColumn();
    }
    if ($catId <= 0) {
        api_error('Valid "category_id" or "category_slug" is required.', 422, ['category_id' => 'Kategori wajib dipilih.'], 'VALIDATION_ERROR');
    }

    // Slug generation & uniqueness check
    $slugInput = trim($input['slug'] ?? '');
    $slug = $slugInput !== '' ? make_slug($slugInput) : make_slug($name);
    
    // Ensure slug unique
    $checkStmt = $pdo->prepare('SELECT id FROM trainings WHERE slug = ? LIMIT 1');
    $checkStmt->execute([$slug]);
    if ($checkStmt->fetch()) {
        $baseSlug = $slug;
        $suffix = 1;
        do {
            $slug = $baseSlug . '-' . $suffix++;
            $checkStmt->execute([$slug]);
        } while ($checkStmt->fetch());
    }

    $mode         = in_array($input['mode'] ?? '', ['online', 'offline', 'both'], true) ? $input['mode'] : 'online';
    $cert         = trim($input['certification'] ?? 'Sertifikasi BNSP');
    $price        = max(0, (int)($input['price'] ?? 0));
    $description  = trim($input['description'] ?? '');
    $longContent  = trim($input['long_content'] ?? '');
    $duration     = (int)($input['duration_days'] ?? 0) ?: null;
    $metaTitle    = trim($input['meta_title'] ?? '');
    $metaDesc     = trim($input['meta_desc'] ?? '');
    $waText       = trim($input['wa_text'] ?? '');
    $isFeatured   = !empty($input['is_featured']) ? 1 : 0;
    $isActive     = isset($input['is_active']) ? (!empty($input['is_active']) ? 1 : 0) : 1;
    $sortOrder    = (int)($input['sort_order'] ?? 0);
    $actor        = trim($input['actor'] ?? 'agent');

    // Curriculum processing
    $curriculum = $input['curriculum'] ?? [];
    if (is_string($curriculum)) {
        $dec = json_decode($curriculum, true);
        $curriculum = is_array($dec) ? $dec : [];
    }
    $curJson = !empty($curriculum) ? json_encode(array_values(array_filter(array_map('trim', $curriculum))), JSON_UNESCAPED_UNICODE) : null;

    $stmt = $pdo->prepare("
        INSERT INTO trainings
        (category_id, name, slug, mode, certification, price, description, long_content, curriculum,
         duration_days, meta_title, meta_desc, wa_text, is_featured, is_active, sort_order, created_at, updated_at)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())
    ");
    $stmt->execute([
        $catId, $name, $slug, $mode, $cert, $price, $description, $longContent, $curJson,
        $duration, $metaTitle, $metaDesc, $waText, $isFeatured, $isActive, $sortOrder
    ]);

    $newId = (int)$pdo->lastInsertId();

    // Audit Log
    log_content_audit($pdo, 'training', $newId, $slug, 'create', [
        'created_data' => [
            'name'        => $name,
            'slug'        => $slug,
            'category_id' => $catId,
            'price'       => $price,
            'mode'        => $mode,
        ]
    ], $actor);

    // Fetch newly created record
    $fetchStmt = $pdo->prepare("SELECT t.*, c.name AS cat_name, c.slug AS cat_slug FROM trainings t LEFT JOIN categories c ON c.id = t.category_id WHERE t.id = ?");
    $fetchStmt->execute([$newId]);
    $created = format_training_record($fetchStmt->fetch());

    api_success($created, 'Training created successfully', 201);
}

// ─── HANDLER: PUT / PATCH (Update Content) ─────────────────────────────────
function handle_put(PDO $pdo): never {
    $input = get_json_input();
    $id = (int)($input['id'] ?? ($_GET['id'] ?? 0));
    $slugParam = trim($input['slug'] ?? ($_GET['slug'] ?? ''));

    // Locate existing record
    if ($id > 0) {
        $stmt = $pdo->prepare('SELECT * FROM trainings WHERE id = ? LIMIT 1');
        $stmt->execute([$id]);
    } elseif ($slugParam !== '') {
        $stmt = $pdo->prepare('SELECT * FROM trainings WHERE slug = ? LIMIT 1');
        $stmt->execute([$slugParam]);
    } else {
        api_error('Training ID or slug must be provided in URL or body.', 400, [], 'MISSING_IDENTIFIER');
    }

    $existing = $stmt->fetch();
    if (!$existing) {
        api_error('Training program not found.', 404, [], 'NOT_FOUND');
    }

    $trainingId = (int)$existing['id'];
    $oldSlug = (string)$existing['slug'];
    $wasActive = (int)$existing['is_active'];
    $actor = trim($input['actor'] ?? 'agent');

    // Prepare fields to update
    $allowedFields = [
        'category_id'   => 'int',
        'name'          => 'string',
        'slug'          => 'slug',
        'mode'          => 'mode',
        'certification' => 'string',
        'price'         => 'int',
        'description'   => 'string',
        'long_content'  => 'string',
        'curriculum'    => 'curriculum',
        'duration_days' => 'nullable_int',
        'meta_title'    => 'string',
        'meta_desc'     => 'string',
        'wa_text'       => 'string',
        'is_featured'   => 'bool',
        'is_active'     => 'bool',
        'sort_order'    => 'int',
    ];

    $updates = [];
    $params = [];
    $diff = [];

    // Support category_slug in update
    if (isset($input['category_slug']) && !isset($input['category_id'])) {
        $cStmt = $pdo->prepare('SELECT id FROM categories WHERE slug = ? LIMIT 1');
        $cStmt->execute([trim($input['category_slug'])]);
        $resolvedCatId = (int)$cStmt->fetchColumn();
        if ($resolvedCatId > 0) {
            $input['category_id'] = $resolvedCatId;
        }
    }

    foreach ($allowedFields as $field => $type) {
        if (!array_key_exists($field, $input)) {
            continue;
        }

        $rawVal = $input[$field];
        $newVal = null;

        switch ($type) {
            case 'int':
                $newVal = (int)$rawVal;
                break;
            case 'nullable_int':
                $newVal = $rawVal !== null && $rawVal !== '' ? (int)$rawVal : null;
                break;
            case 'bool':
                $newVal = !empty($rawVal) ? 1 : 0;
                break;
            case 'mode':
                $newVal = in_array($rawVal, ['online', 'offline', 'both'], true) ? $rawVal : 'online';
                break;
            case 'string':
                $newVal = trim((string)$rawVal);
                break;
            case 'slug':
                $newVal = make_slug(trim((string)$rawVal));
                break;
            case 'curriculum':
                if (is_string($rawVal)) {
                    $dec = json_decode($rawVal, true);
                    $arr = is_array($dec) ? $dec : [];
                } elseif (is_array($rawVal)) {
                    $arr = $rawVal;
                } else {
                    $arr = [];
                }
                $cleanArr = array_values(array_filter(array_map('trim', $arr)));
                $newVal = !empty($cleanArr) ? json_encode($cleanArr, JSON_UNESCAPED_UNICODE) : null;
                break;
        }

        // Compare with existing value
        $currVal = $existing[$field];
        if ($type === 'int' || $type === 'bool') {
            $currVal = (int)$currVal;
        }

        if ($currVal !== $newVal) {
            $updates[] = "`$field` = ?";
            $params[] = $newVal;
            $diff[$field] = [
                'old' => $currVal,
                'new' => $newVal,
            ];
        }
    }

    if (empty($updates)) {
        // Nothing changed
        $fetchStmt = $pdo->prepare("SELECT t.*, c.name AS cat_name, c.slug AS cat_slug FROM trainings t LEFT JOIN categories c ON c.id = t.category_id WHERE t.id = ?");
        $fetchStmt->execute([$trainingId]);
        api_success(format_training_record($fetchStmt->fetch()), 'No changes detected');
    }

    // Slug change handling & validation
    $newSlug = isset($diff['slug']) ? $diff['slug']['new'] : $oldSlug;
    if (isset($diff['slug'])) {
        // Check uniqueness
        $checkStmt = $pdo->prepare('SELECT id FROM trainings WHERE slug = ? AND id != ? LIMIT 1');
        $checkStmt->execute([$newSlug, $trainingId]);
        if ($checkStmt->fetch()) {
            api_error("Slug '{$newSlug}' is already taken by another training program.", 409, ['slug' => 'Slug sudah digunakan.'], 'SLUG_CONFLICT');
        }

        // Setup 301 Redirect in training_redirects
        ensure_redirect_tables($pdo);
        $pdo->prepare("
            INSERT INTO training_redirects (old_slug, target_slug, target_category_slug, reason, created_at)
            VALUES (?, ?, NULL, 'slug_changed', NOW())
            ON DUPLICATE KEY UPDATE target_slug = VALUES(target_slug), target_category_slug = NULL, reason = VALUES(reason), created_at = NOW()
        ")->execute([$oldSlug, $newSlug]);
    }

    // Deactivation redirect handling
    $newActive = isset($diff['is_active']) ? $diff['is_active']['new'] : $wasActive;
    if ($wasActive === 1 && $newActive === 0) {
        $cStmt = $pdo->prepare('SELECT slug FROM categories WHERE id = ?');
        $cStmt->execute([$existing['category_id']]);
        $catSlug = $cStmt->fetchColumn() ?: null;

        $pdo->prepare("
            INSERT INTO training_redirects (old_slug, target_slug, target_category_slug, reason, created_at)
            VALUES (?, NULL, ?, 'deactivated', NOW())
            ON DUPLICATE KEY UPDATE target_slug = NULL, target_category_slug = VALUES(target_category_slug), reason = VALUES(reason), created_at = NOW()
        ")->execute([$newSlug, $catSlug]);
    } elseif ($wasActive === 0 && $newActive === 1) {
        // Reactivated: delete deactivated redirect rule
        $pdo->prepare("DELETE FROM training_redirects WHERE old_slug = ? AND reason = 'deactivated'")->execute([$newSlug]);
    }

    // Execute UPDATE
    $updates[] = "`updated_at` = NOW()";
    $params[] = $trainingId;
    $sql = "UPDATE trainings SET " . implode(', ', $updates) . " WHERE id = ?";
    $pdo->prepare($sql)->execute($params);

    // Audit Log
    log_content_audit($pdo, 'training', $trainingId, $newSlug, 'update', $diff, $actor);

    // Return updated record
    $fetchStmt = $pdo->prepare("SELECT t.*, c.name AS cat_name, c.slug AS cat_slug FROM trainings t LEFT JOIN categories c ON c.id = t.category_id WHERE t.id = ?");
    $fetchStmt->execute([$trainingId]);
    $updated = format_training_record($fetchStmt->fetch());

    api_success($updated, 'Training updated successfully');
}

// ─── HANDLER: DELETE (Archive or Hard Delete) ──────────────────────────────
function handle_delete(PDO $pdo): never {
    $input = get_json_input();
    $id = (int)($input['id'] ?? ($_GET['id'] ?? 0));
    $slugParam = trim($input['slug'] ?? ($_GET['slug'] ?? ''));
    $mode = trim($input['mode'] ?? ($_GET['mode'] ?? 'archive')); // 'archive' (default) or 'hard_delete'
    $actor = trim($input['actor'] ?? 'agent');

    if ($id > 0) {
        $stmt = $pdo->prepare("
            SELECT t.*, c.slug AS cat_slug
            FROM trainings t LEFT JOIN categories c ON c.id = t.category_id
            WHERE t.id = ? LIMIT 1
        ");
        $stmt->execute([$id]);
    } elseif ($slugParam !== '') {
        $stmt = $pdo->prepare("
            SELECT t.*, c.slug AS cat_slug
            FROM trainings t LEFT JOIN categories c ON c.id = t.category_id
            WHERE t.slug = ? LIMIT 1
        ");
        $stmt->execute([$slugParam]);
    } else {
        api_error('Training ID or slug must be provided.', 400, [], 'MISSING_IDENTIFIER');
    }

    $training = $stmt->fetch();
    if (!$training) {
        api_error('Training program not found.', 404, [], 'NOT_FOUND');
    }

    $trainingId = (int)$training['id'];
    $slug = (string)$training['slug'];
    $catSlug = $training['cat_slug'] ?: null;

    if ($mode === 'hard_delete') {
        // Safe 301 redirect before hard deletion
        ensure_redirect_tables($pdo);
        $pdo->prepare("
            INSERT INTO training_redirects (old_slug, target_slug, target_category_slug, reason, created_at)
            VALUES (?, NULL, ?, 'deleted', NOW())
            ON DUPLICATE KEY UPDATE target_slug = NULL, target_category_slug = VALUES(target_category_slug), reason = VALUES(reason), created_at = NOW()
        ")->execute([$slug, $catSlug]);

        // Remove image if any
        if (!empty($training['image_path'])) {
            @unlink(UPLOAD_DIR . basename($training['image_path']));
        }

        $pdo->prepare('DELETE FROM trainings WHERE id = ?')->execute([$trainingId]);
        log_content_audit($pdo, 'training', $trainingId, $slug, 'delete', ['name' => $training['name']], $actor);

        api_success(['deleted_id' => $trainingId, 'slug' => $slug, 'redirect_to' => "/pelatihan/$catSlug/"], 'Training permanently deleted and redirect established');
    } else {
        // Default: Archive (Soft-delete)
        $pdo->prepare("
            INSERT INTO training_redirects (old_slug, target_slug, target_category_slug, reason, created_at)
            VALUES (?, NULL, ?, 'deactivated', NOW())
            ON DUPLICATE KEY UPDATE target_slug = NULL, target_category_slug = VALUES(target_category_slug), reason = VALUES(reason), created_at = NOW()
        ")->execute([$slug, $catSlug]);

        $pdo->prepare("UPDATE trainings SET is_active = 0, updated_at = NOW() WHERE id = ?")->execute([$trainingId]);
        log_content_audit($pdo, 'training', $trainingId, $slug, 'archive', ['is_active' => ['old' => 1, 'new' => 0]], $actor);

        api_success(['archived_id' => $trainingId, 'slug' => $slug, 'is_active' => 0], 'Training archived (deactivated) successfully');
    }
}

// ─── HELPER: Format Output Record ──────────────────────────────────────────
function format_training_record(array $row): array {
    $curriculum = [];
    if (!empty($row['curriculum'])) {
        $dec = json_decode($row['curriculum'], true);
        if (is_array($dec)) {
            $curriculum = $dec;
        }
    }

    return [
        'id'            => (int)$row['id'],
        'name'          => (string)$row['name'],
        'slug'          => (string)$row['slug'],
        'url'           => SITE_URL . '/pelatihan/' . $row['slug'] . '/',
        'category_id'   => (int)($row['category_id'] ?? 0),
        'category_name' => (string)($row['cat_name'] ?? ''),
        'category_slug' => (string)($row['cat_slug'] ?? ''),
        'mode'          => (string)($row['mode'] ?? 'online'),
        'certification' => (string)($row['certification'] ?? 'BNSP'),
        'price'         => (int)($row['price'] ?? 0),
        'duration_days' => isset($row['duration_days']) ? (int)$row['duration_days'] : null,
        'description'   => (string)($row['description'] ?? ''),
        'long_content'  => (string)($row['long_content'] ?? ''),
        'curriculum'    => $curriculum,
        'meta_title'    => (string)($row['meta_title'] ?? ''),
        'meta_desc'     => (string)($row['meta_desc'] ?? ''),
        'wa_text'       => (string)($row['wa_text'] ?? ''),
        'is_featured'   => (int)($row['is_featured'] ?? 0) === 1,
        'is_active'     => (int)($row['is_active'] ?? 1) === 1,
        'sort_order'    => (int)($row['sort_order'] ?? 0),
        'view_count'    => (int)($row['view_count'] ?? 0),
        'created_at'    => $row['created_at'] ?? null,
        'updated_at'    => $row['updated_at'] ?? null,
    ];
}
