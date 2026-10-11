<?php
if (defined('FORUM_FUNCTIONS_LOADED')) return;
define('FORUM_FUNCTIONS_LOADED', true);
/**
 * includes/forum-functions.php
 * Community Forum — K3 HSE Indonesia
 */
if (!defined('SITE_URL')) require_once __DIR__ . '/../config.php';

// ── Categories ────────────────────────────────────────────────────────────────

function get_forum_categories(): array {
    try {
        return get_pdo()->query(
            'SELECT fc.*, COUNT(ft.id) AS topic_count_real
             FROM forum_categories fc
             LEFT JOIN forum_topics ft ON ft.category_id = fc.id AND ft.is_approved = 1 AND ft.is_active = 1
             WHERE fc.is_active = 1
             GROUP BY fc.id ORDER BY fc.sort_order ASC'
        )->fetchAll();
    } catch (Exception) { return []; }
}

function get_forum_category_by_slug(string $slug): ?array {
    try {
        $stmt = get_pdo()->prepare('SELECT * FROM forum_categories WHERE slug = ? LIMIT 1');
        $stmt->execute([$slug]);
        return $stmt->fetch() ?: null;
    } catch (Exception) { return null; }
}

// ── Topics ────────────────────────────────────────────────────────────────────

function get_forum_topics(array $opts = []): array {
    $where  = ['ft.is_approved = 1', 'ft.is_active = 1'];
    $params = [];
    if (!empty($opts['category_id'])) { $where[] = 'ft.category_id = ?'; $params[] = (int)$opts['category_id']; }
    if (!empty($opts['search']))      { $where[] = 'MATCH(ft.title,ft.content) AGAINST(? IN BOOLEAN MODE)'; $params[] = $opts['search'] . '*'; }
    if (!empty($opts['answered']))    { $where[] = 'ft.is_answered = 1'; }
    $limit  = max(1, min(50, (int)($opts['limit'] ?? 20)));
    $offset = max(0, (int)($opts['offset'] ?? 0));
    $sql = "SELECT ft.*, fc.name AS cat_name, fc.slug AS cat_slug, fc.icon AS cat_icon,
                   (SELECT COUNT(*) FROM forum_replies fr WHERE fr.topic_id = ft.id AND fr.is_active=1) AS reply_count_real
            FROM forum_topics ft
            LEFT JOIN forum_categories fc ON fc.id = ft.category_id
            WHERE " . implode(' AND ', $where) . "
            ORDER BY ft.is_pinned DESC, COALESCE(ft.last_reply_at, ft.created_at) DESC
            LIMIT $limit OFFSET $offset";
    try {
        $stmt = get_pdo()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    } catch (Exception) { return []; }
}

function count_forum_topics(array $opts = []): int {
    $where  = ['ft.is_approved = 1', 'ft.is_active = 1'];
    $params = [];
    if (!empty($opts['category_id'])) { $where[] = 'ft.category_id = ?'; $params[] = (int)$opts['category_id']; }
    if (!empty($opts['search']))      { $where[] = 'MATCH(ft.title,ft.content) AGAINST(? IN BOOLEAN MODE)'; $params[] = $opts['search'] . '*'; }
    $sql = 'SELECT COUNT(*) FROM forum_topics ft WHERE ' . implode(' AND ', $where);
    try {
        $stmt = get_pdo()->prepare($sql);
        $stmt->execute($params);
        return (int)$stmt->fetchColumn();
    } catch (Exception) { return 0; }
}

function get_forum_topic_by_slug(string $slug): ?array {
    try {
        $stmt = get_pdo()->prepare(
            'SELECT ft.*, fc.name AS cat_name, fc.slug AS cat_slug
             FROM forum_topics ft LEFT JOIN forum_categories fc ON fc.id = ft.category_id
             WHERE ft.slug = ? AND ft.is_active = 1 LIMIT 1'
        );
        $stmt->execute([$slug]);
        $topic = $stmt->fetch() ?: null;
        if ($topic) {
            // Increment view
            get_pdo()->prepare('UPDATE forum_topics SET view_count = view_count + 1 WHERE id = ?')
                     ->execute([$topic['id']]);
        }
        return $topic;
    } catch (Exception) { return null; }
}

function get_forum_topic_by_id(int $id): ?array {
    try {
        $stmt = get_pdo()->prepare('SELECT * FROM forum_topics WHERE id = ? LIMIT 1');
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    } catch (Exception) { return null; }
}

function save_forum_topic(array $data): int|false {
    $pdo  = get_pdo();
    $title= trim($data['title'] ?? '');
    $slug = make_slug($title);
    $base = $slug; $i = 1;
    while (true) {
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM forum_topics WHERE slug = ?');
        $stmt->execute([$slug]);
        if ((int)$stmt->fetchColumn() === 0) break;
        $slug = $base . '-' . $i++;
    }
    // Auto-approve if admin, else pending
    $approved = (int)($data['is_approved'] ?? 0);
    try {
        $stmt = $pdo->prepare(
            'INSERT INTO forum_topics
             (category_id, author_name, author_email, author_company, slug, title, content, is_approved, is_active)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, 1)'
        );
        $stmt->execute([
            (int)$data['category_id'],
            trim($data['author_name']  ?? ''),
            strtolower(trim($data['author_email'] ?? '')),
            trim($data['author_company'] ?? ''),
            $slug, $title,
            trim($data['content'] ?? ''),
            $approved,
        ]);
        $id = (int)$pdo->lastInsertId();
        if ($approved) {
            $pdo->prepare('UPDATE forum_categories SET topic_count = topic_count + 1 WHERE id = ?')
                ->execute([(int)$data['category_id']]);
        }
        return $id;
    } catch (Exception $e) { error_log('[forum] save_topic: ' . $e->getMessage()); return false; }
}

function approve_forum_topic(int $id): bool {
    try {
        $topic = get_forum_topic_by_id($id);
        if (!$topic) return false;
        get_pdo()->prepare('UPDATE forum_topics SET is_approved = 1 WHERE id = ?')->execute([$id]);
        get_pdo()->prepare('UPDATE forum_categories SET topic_count = topic_count + 1 WHERE id = ?')
                 ->execute([$topic['category_id']]);
        return true;
    } catch (Exception) { return false; }
}

function delete_forum_topic(int $id): bool {
    try {
        get_pdo()->prepare('UPDATE forum_topics SET is_active = 0 WHERE id = ?')->execute([$id]);
        return true;
    } catch (Exception) { return false; }
}

// ── Replies ───────────────────────────────────────────────────────────────────

function get_forum_replies(int $topicId, bool $approvedOnly = true): array {
    $where = 'fr.topic_id = ? AND fr.is_active = 1' . ($approvedOnly ? ' AND fr.is_approved = 1' : '');
    try {
        $stmt = get_pdo()->prepare("SELECT * FROM forum_replies fr WHERE $where ORDER BY fr.created_at ASC");
        $stmt->execute([$topicId]);
        return $stmt->fetchAll();
    } catch (Exception) { return []; }
}

function save_forum_reply(array $data): int|false {
    $pdo      = get_pdo();
    $topicId  = (int)$data['topic_id'];
    $approved = (int)($data['is_approved'] ?? 0);
    try {
        $stmt = $pdo->prepare(
            'INSERT INTO forum_replies
             (topic_id, author_name, author_email, author_company, content, is_expert, is_approved, is_active)
             VALUES (?, ?, ?, ?, ?, ?, ?, 1)'
        );
        $stmt->execute([
            $topicId,
            trim($data['author_name']    ?? ''),
            strtolower(trim($data['author_email'] ?? '')),
            trim($data['author_company'] ?? ''),
            trim($data['content']        ?? ''),
            (int)($data['is_expert']     ?? 0),
            $approved,
        ]);
        $replyId = (int)$pdo->lastInsertId();
        if ($approved) {
            $pdo->prepare('UPDATE forum_topics SET reply_count = reply_count + 1, last_reply_at = NOW() WHERE id = ?')
                ->execute([$topicId]);
        }
        return $replyId;
    } catch (Exception $e) { error_log('[forum] save_reply: ' . $e->getMessage()); return false; }
}

function approve_forum_reply(int $id): bool {
    try {
        $stmt = get_pdo()->prepare('SELECT * FROM forum_replies WHERE id = ? LIMIT 1');
        $stmt->execute([$id]);
        $reply = $stmt->fetch();
        if (!$reply) return false;
        get_pdo()->prepare('UPDATE forum_replies SET is_approved = 1 WHERE id = ?')->execute([$id]);
        get_pdo()->prepare('UPDATE forum_topics SET reply_count = reply_count + 1, last_reply_at = NOW() WHERE id = ?')
                 ->execute([$reply['topic_id']]);
        return true;
    } catch (Exception) { return false; }
}

function mark_best_answer(int $replyId, int $topicId): bool {
    try {
        $pdo = get_pdo();
        $pdo->prepare('UPDATE forum_replies SET is_best_answer = 0 WHERE topic_id = ?')->execute([$topicId]);
        $pdo->prepare('UPDATE forum_replies SET is_best_answer = 1 WHERE id = ?')->execute([$replyId]);
        $pdo->prepare('UPDATE forum_topics SET is_answered = 1 WHERE id = ?')->execute([$topicId]);
        return true;
    } catch (Exception) { return false; }
}

// ── Stats ─────────────────────────────────────────────────────────────────────

function get_forum_stats(): array {
    try {
        $pdo = get_pdo();
        return [
            'total_topics'   => (int)$pdo->query('SELECT COUNT(*) FROM forum_topics WHERE is_active=1 AND is_approved=1')->fetchColumn(),
            'total_replies'  => (int)$pdo->query('SELECT COUNT(*) FROM forum_replies WHERE is_active=1 AND is_approved=1')->fetchColumn(),
            'pending_topics' => (int)$pdo->query('SELECT COUNT(*) FROM forum_topics WHERE is_approved=0 AND is_active=1')->fetchColumn(),
            'pending_replies'=> (int)$pdo->query('SELECT COUNT(*) FROM forum_replies WHERE is_approved=0 AND is_active=1')->fetchColumn(),
            'answered'       => (int)$pdo->query('SELECT COUNT(*) FROM forum_topics WHERE is_answered=1 AND is_active=1')->fetchColumn(),
        ];
    } catch (Exception) { return []; }
}
