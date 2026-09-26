<?php
/**
 * api/articles.php
 * Secure REST API for Article Content Management.
 * Supports: Search/List, Read, Create, Partial/Full Update, and Unpublish/Archive.
 * 
 * Flow: Agent / Client -> HTTPS + Bearer Token -> MySQL (articles table)
 */

require_once __DIR__ . '/includes/api-common.php';
require_once __DIR__ . '/../artikel-functions.php';
require_once __DIR__ . '/../includes/hub-category-map.php';

// Enforce authentication
require_api_auth();

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

if ($method === 'POST') {
    $override = $_POST['_method'] ?? ($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE'] ?? '');
    if ($override) {
        $method = strtoupper($override);
    }
}

switch ($method) {
    case 'GET':
        handle_article_get(get_pdo());
        break;

    case 'POST':
        handle_article_post(get_pdo());
        break;

    case 'PUT':
    case 'PATCH':
        handle_article_put(get_pdo());
        break;

    case 'DELETE':
        handle_article_delete(get_pdo());
        break;

    case 'TEST':
        // Test mode for automated unit verification
        break;

    default:
        api_error("HTTP method {$method} is not supported.", 405, [], 'METHOD_NOT_ALLOWED');
}

// ─── HANDLER: GET (Read / Search / Audit Logs) ─────────────────────────────
function handle_article_get(PDO $pdo): never {
    $action = $_GET['action'] ?? '';

    // Sub-route: Audit Logs
    if ($action === 'audit_logs') {
        ensure_audit_log_table($pdo);
        $articleId = isset($_GET['id']) ? (int)$_GET['id'] : null;
        $slug = isset($_GET['slug']) ? trim($_GET['slug']) : null;
        $limit = min(100, max(1, (int)($_GET['limit'] ?? 50)));

        $where = ["entity_type = 'article'"];
        $params = [];
        if ($articleId) {
            $where[] = "entity_id = ?";
            $params[] = $articleId;
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

        api_success($logs, 'Article audit logs retrieved');
    }

    // Sub-route: Single Article by ID or Slug
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';

    if ($id > 0 || $slug !== '') {
        $stmt = $pdo->prepare("SELECT * FROM articles WHERE " . ($id > 0 ? "id = ?" : "slug = ?") . " LIMIT 1");
        $stmt->execute([$id > 0 ? $id : $slug]);
        $row = $stmt->fetch();

        if (!$row) {
            api_error('Article not found.', 404, [], 'NOT_FOUND');
        }

        api_success(format_article_record($row), 'Article retrieved');
    }

    // Sub-route: List & Filter Articles
    $search = trim($_GET['q'] ?? '');
    $category = trim($_GET['category'] ?? '');
    $status = trim($_GET['status'] ?? 'published'); // 'published', 'draft', 'all'
    $fields = trim($_GET['fields'] ?? 'summary');
    $page = max(1, (int)($_GET['page'] ?? 1));
    $limit = min(100, max(1, (int)($_GET['limit'] ?? 20)));
    $offset = ($page - 1) * $limit;

    $where = ['1=1'];
    $params = [];

    if ($search !== '') {
        $where[] = "(title LIKE ? OR slug LIKE ? OR meta_desc LIKE ?)";
        $wild = "%$search%";
        $params[] = $wild;
        $params[] = $wild;
        $params[] = $wild;
    }

    if ($category !== '') {
        $where[] = "category = ?";
        $params[] = $category;
    }

    if ($status === 'published') {
        $where[] = "status = 'published'";
    } elseif ($status === 'draft') {
        $where[] = "status = 'draft'";
    }

    $whereSql = implode(' AND ', $where);

    $cntStmt = $pdo->prepare("SELECT COUNT(*) FROM articles WHERE $whereSql");
    $cntStmt->execute($params);
    $total = (int)$cntStmt->fetchColumn();

    $selectCols = ($fields === 'full')
        ? "*"
        : "id, title, slug, category, thumbnail, meta_desc, author, status, published_at, view_count, created_at, updated_at";

    $stmt = $pdo->prepare("
        SELECT $selectCols
        FROM articles
        WHERE $whereSql
        ORDER BY published_at DESC, id DESC
        LIMIT $limit OFFSET $offset
    ");
    $stmt->execute($params);
    $rows = $stmt->fetchAll();

    $items = array_map('format_article_record', $rows);

    api_success($items, 'Articles retrieved', 200, [
        'total'       => $total,
        'page'        => $page,
        'limit'       => $limit,
        'total_pages' => (int)ceil($total / $limit),
    ]);
}

// ─── HANDLER: POST (Create Article) ────────────────────────────────────────
function handle_article_post(PDO $pdo): never {
    $input = get_json_input();
    $action = $input['action'] ?? ($_GET['action'] ?? '');

    if ($action === 'archive' || $action === 'delete') {
        $_GET['action'] = $action;
        handle_article_delete($pdo);
    }

    $title = trim($input['title'] ?? '');
    if ($title === '') {
        api_error('Field "title" is required.', 422, ['title' => 'Judul artikel tidak boleh kosong.'], 'VALIDATION_ERROR');
    }

    $content = trim($input['content'] ?? '');
    if ($content === '') {
        api_error('Field "content" is required.', 422, ['content' => 'Konten artikel tidak boleh kosong.'], 'VALIDATION_ERROR');
    }

    $slugInput = trim($input['slug'] ?? '');
    $slug = $slugInput !== '' ? make_slug($slugInput) : make_slug($title);

    // Uniqueness
    $check = $pdo->prepare("SELECT id FROM articles WHERE slug = ? LIMIT 1");
    $check->execute([$slug]);
    if ($check->fetch()) {
        $base = $slug;
        $i = 1;
        do {
            $slug = $base . '-' . $i++;
            $check->execute([$slug]);
        } while ($check->fetch());
    }

    $category   = trim($input['category'] ?? 'K3');
    $metaTitle  = trim($input['meta_title'] ?? '');
    $metaDesc   = trim($input['meta_desc'] ?? '');
    $keywords   = trim($input['keywords'] ?? '');
    $thumbnail  = trim($input['thumbnail'] ?? '');
    $author     = trim($input['author'] ?? 'Wahana Totalita Konsultan');
    $status     = ($input['status'] ?? 'published') === 'published' ? 'published' : 'draft';
    $pubAt      = trim($input['published_at'] ?? '') ?: ($status === 'published' ? date('Y-m-d H:i:s') : null);
    $actor      = trim($input['actor'] ?? 'agent');

    // FAQ processing
    $faq = $input['faq'] ?? [];
    if (is_string($faq)) {
        $dec = json_decode($faq, true);
        $faq = is_array($dec) ? $dec : [];
    }
    $faqJson = !empty($faq) ? json_encode($faq, JSON_UNESCAPED_UNICODE) : null;

    $stmt = $pdo->prepare("
        INSERT INTO articles
        (title, slug, category, thumbnail, meta_title, meta_desc, keywords, content, faq, author, status, published_at, created_at, updated_at)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())
    ");
    $stmt->execute([
        $title, $slug, $category, $thumbnail, $metaTitle, $metaDesc, $keywords, $content, $faqJson, $author, $status, $pubAt
    ]);

    $newId = (int)$pdo->lastInsertId();

    log_content_audit($pdo, 'article', $newId, $slug, 'create', [
        'created_data' => [
            'title'    => $title,
            'slug'     => $slug,
            'category' => $category,
            'status'   => $status,
        ]
    ], $actor);

    $fetch = $pdo->prepare("SELECT * FROM articles WHERE id = ?");
    $fetch->execute([$newId]);
    $created = format_article_record($fetch->fetch());

    api_success($created, 'Article created successfully', 201);
}

// ─── HANDLER: PUT / PATCH (Update Article) ─────────────────────────────────
function handle_article_put(PDO $pdo): never {
    global $ARTICLE_CAT_TO_SLUG;
    $input = get_json_input();
    $id = (int)($input['id'] ?? ($_GET['id'] ?? 0));
    $slugParam = trim($input['slug'] ?? ($_GET['slug'] ?? ''));

    if ($id > 0) {
        $stmt = $pdo->prepare('SELECT * FROM articles WHERE id = ? LIMIT 1');
        $stmt->execute([$id]);
    } elseif ($slugParam !== '') {
        $stmt = $pdo->prepare('SELECT * FROM articles WHERE slug = ? LIMIT 1');
        $stmt->execute([$slugParam]);
    } else {
        api_error('Article ID or slug must be provided in URL or body.', 400, [], 'MISSING_IDENTIFIER');
    }

    $existing = $stmt->fetch();
    if (!$existing) {
        api_error('Article not found.', 404, [], 'NOT_FOUND');
    }

    $articleId = (int)$existing['id'];
    $oldSlug = (string)$existing['slug'];
    $wasStatus = (string)$existing['status'];
    $actor = trim($input['actor'] ?? 'agent');

    $allowed = [
        'title'        => 'string',
        'slug'         => 'slug',
        'category'     => 'string',
        'thumbnail'    => 'string',
        'meta_title'   => 'string',
        'meta_desc'    => 'string',
        'keywords'     => 'string',
        'content'      => 'string',
        'faq'          => 'faq',
        'author'       => 'string',
        'status'       => 'status',
        'published_at' => 'string',
    ];

    $updates = [];
    $params = [];
    $diff = [];

    foreach ($allowed as $field => $type) {
        if (!array_key_exists($field, $input)) continue;

        $raw = $input[$field];
        $val = null;

        switch ($type) {
            case 'string':
                $val = trim((string)$raw);
                break;
            case 'slug':
                $val = make_slug(trim((string)$raw));
                break;
            case 'status':
                $val = $raw === 'published' ? 'published' : 'draft';
                break;
            case 'faq':
                if (is_string($raw)) {
                    $dec = json_decode($raw, true);
                    $arr = is_array($dec) ? $dec : [];
                } elseif (is_array($raw)) {
                    $arr = $raw;
                } else {
                    $arr = [];
                }
                $val = !empty($arr) ? json_encode($arr, JSON_UNESCAPED_UNICODE) : null;
                break;
        }

        $curr = $existing[$field];
        if ($curr !== $val) {
            $updates[] = "`$field` = ?";
            $params[] = $val;
            $diff[$field] = ['old' => $curr, 'new' => $val];
        }
    }

    if (empty($updates)) {
        $fetch = $pdo->prepare("SELECT * FROM articles WHERE id = ?");
        $fetch->execute([$articleId]);
        api_success(format_article_record($fetch->fetch()), 'No changes detected');
    }

    // Slug redirect
    $newSlug = isset($diff['slug']) ? $diff['slug']['new'] : $oldSlug;
    if (isset($diff['slug'])) {
        $check = $pdo->prepare('SELECT id FROM articles WHERE slug = ? AND id != ? LIMIT 1');
        $check->execute([$newSlug, $articleId]);
        if ($check->fetch()) {
            api_error("Slug '{$newSlug}' is already taken by another article.", 409, ['slug' => 'Slug sudah digunakan.'], 'SLUG_CONFLICT');
        }

        ensure_redirect_tables($pdo);
        $pdo->prepare("
            INSERT INTO article_redirects (old_slug, target_slug, target_category_slug, reason, created_at)
            VALUES (?, ?, NULL, 'slug_changed', NOW())
            ON DUPLICATE KEY UPDATE target_slug = VALUES(target_slug), target_category_slug = NULL, reason = VALUES(reason), created_at = NOW()
        ")->execute([$oldSlug, $newSlug]);
    }

    // Unpublish redirect
    $newStatus = isset($diff['status']) ? $diff['status']['new'] : $wasStatus;
    if ($wasStatus === 'published' && $newStatus === 'draft') {
        $catName = $input['category'] ?? $existing['category'];
        $catSlug = $ARTICLE_CAT_TO_SLUG[$catName] ?? null;

        $pdo->prepare("
            INSERT INTO article_redirects (old_slug, target_slug, target_category_slug, reason, created_at)
            VALUES (?, NULL, ?, 'unpublished', NOW())
            ON DUPLICATE KEY UPDATE target_slug = NULL, target_category_slug = VALUES(target_category_slug), reason = VALUES(reason), created_at = NOW()
        ")->execute([$newSlug, $catSlug]);
    } elseif ($wasStatus === 'draft' && $newStatus === 'published') {
        $pdo->prepare("DELETE FROM article_redirects WHERE old_slug = ? AND reason = 'unpublished'")->execute([$newSlug]);
    }

    $updates[] = "`updated_at` = NOW()";
    $params[] = $articleId;
    $sql = "UPDATE articles SET " . implode(', ', $updates) . " WHERE id = ?";
    $pdo->prepare($sql)->execute($params);

    log_content_audit($pdo, 'article', $articleId, $newSlug, 'update', $diff, $actor);

    $fetch = $pdo->prepare("SELECT * FROM articles WHERE id = ?");
    $fetch->execute([$articleId]);
    api_success(format_article_record($fetch->fetch()), 'Article updated successfully');
}

// ─── HANDLER: DELETE (Unpublish or Hard Delete) ────────────────────────────
function handle_article_delete(PDO $pdo): never {
    global $ARTICLE_CAT_TO_SLUG;
    $input = get_json_input();
    $id = (int)($input['id'] ?? ($_GET['id'] ?? 0));
    $slugParam = trim($input['slug'] ?? ($_GET['slug'] ?? ''));
    $mode = trim($input['mode'] ?? ($_GET['mode'] ?? 'archive')); // 'archive' (unpublish to draft) or 'hard_delete'
    $actor = trim($input['actor'] ?? 'agent');

    if ($id > 0) {
        $stmt = $pdo->prepare("SELECT * FROM articles WHERE id = ? LIMIT 1");
        $stmt->execute([$id]);
    } elseif ($slugParam !== '') {
        $stmt = $pdo->prepare("SELECT * FROM articles WHERE slug = ? LIMIT 1");
        $stmt->execute([$slugParam]);
    } else {
        api_error('Article ID or slug must be provided.', 400, [], 'MISSING_IDENTIFIER');
    }

    $article = $stmt->fetch();
    if (!$article) {
        api_error('Article not found.', 404, [], 'NOT_FOUND');
    }

    $articleId = (int)$article['id'];
    $slug = (string)$article['slug'];
    $catSlug = $ARTICLE_CAT_TO_SLUG[$article['category']] ?? null;

    ensure_redirect_tables($pdo);
    if ($mode === 'hard_delete') {
        $pdo->prepare("
            INSERT INTO article_redirects (old_slug, target_slug, target_category_slug, reason, created_at)
            VALUES (?, NULL, ?, 'deleted', NOW())
            ON DUPLICATE KEY UPDATE target_slug = NULL, target_category_slug = VALUES(target_category_slug), reason = VALUES(reason), created_at = NOW()
        ")->execute([$slug, $catSlug]);

        $pdo->prepare('DELETE FROM articles WHERE id = ?')->execute([$articleId]);
        log_content_audit($pdo, 'article', $articleId, $slug, 'delete', ['title' => $article['title']], $actor);

        api_success(['deleted_id' => $articleId, 'slug' => $slug, 'redirect_to' => "/artikel/" . ($catSlug ? "$catSlug/" : '')], 'Article permanently deleted and redirect established');
    } else {
        // Archive (Unpublish to draft)
        $pdo->prepare("
            INSERT INTO article_redirects (old_slug, target_slug, target_category_slug, reason, created_at)
            VALUES (?, NULL, ?, 'unpublished', NOW())
            ON DUPLICATE KEY UPDATE target_slug = NULL, target_category_slug = VALUES(target_category_slug), reason = VALUES(reason), created_at = NOW()
        ")->execute([$slug, $catSlug]);

        $pdo->prepare("UPDATE articles SET status = 'draft', updated_at = NOW() WHERE id = ?")->execute([$articleId]);
        log_content_audit($pdo, 'article', $articleId, $slug, 'archive', ['status' => ['old' => $article['status'], 'new' => 'draft']], $actor);

        api_success(['archived_id' => $articleId, 'slug' => $slug, 'status' => 'draft'], 'Article unpublished (drafted) successfully');
    }
}

// ─── HELPER: Format Article Record ─────────────────────────────────────────
function format_article_record(array $row): array {
    $faq = [];
    if (!empty($row['faq'])) {
        $dec = json_decode($row['faq'], true);
        if (is_array($dec)) $faq = $dec;
    }

    return [
        'id'           => (int)$row['id'],
        'title'        => (string)$row['title'],
        'slug'         => (string)$row['slug'],
        'url'          => SITE_URL . '/artikel/' . $row['slug'] . '/',
        'category'     => (string)($row['category'] ?? 'K3'),
        'thumbnail'    => (string)($row['thumbnail'] ?? ''),
        'meta_title'   => (string)($row['meta_title'] ?? ''),
        'meta_desc'    => (string)($row['meta_desc'] ?? ''),
        'keywords'     => (string)($row['keywords'] ?? ''),
        'content'      => (string)($row['content'] ?? ''),
        'faq'          => $faq,
        'author'       => (string)($row['author'] ?? 'Wahana Totalita Konsultan'),
        'status'       => (string)($row['status'] ?? 'published'),
        'view_count'   => (int)($row['view_count'] ?? 0),
        'published_at' => $row['published_at'] ?? null,
        'created_at'   => $row['created_at'] ?? null,
        'updated_at'   => $row['updated_at'] ?? null,
    ];
}
