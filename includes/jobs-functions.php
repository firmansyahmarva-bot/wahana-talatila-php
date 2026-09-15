<?php
if (defined('JOBS_FUNCTIONS_LOADED')) return;
define('JOBS_FUNCTIONS_LOADED', true);
/**
 * includes/jobs-functions.php
 * Job listings helper functions
 * Table: jobs
 */

function get_jobs(array $opts = []): array {
    $where   = ['j.is_active = 1', 'j.expires_at > NOW()'];
    $params  = [];
    $limit   = (int)($opts['limit'] ?? 20);
    $offset  = (int)($opts['offset'] ?? 0);

    if (!empty($opts['search'])) {
        $where[] = '(j.title LIKE ? OR j.company LIKE ? OR j.location LIKE ?)';
        $s = '%' . $opts['search'] . '%';
        array_push($params, $s, $s, $s);
    }
    if (!empty($opts['location'])) {
        $where[] = 'j.location LIKE ?';
        $params[] = '%' . $opts['location'] . '%';
    }
    if (!empty($opts['type'])) {
        $where[] = 'j.job_type = ?';
        $params[] = $opts['type'];
    }
    if (!empty($opts['level'])) {
        $where[] = 'j.experience_level = ?';
        $params[] = $opts['level'];
    }

    $whereSQL = 'WHERE ' . implode(' AND ', $where);
    $sql = "SELECT * FROM jobs j $whereSQL ORDER BY j.is_featured DESC, j.created_at DESC LIMIT $limit OFFSET $offset";

    $stmt = get_pdo()->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function count_jobs(array $opts = []): int {
    $where  = ['j.is_active = 1', 'j.expires_at > NOW()'];
    $params = [];

    if (!empty($opts['search'])) {
        $where[] = '(j.title LIKE ? OR j.company LIKE ? OR j.location LIKE ?)';
        $s = '%' . $opts['search'] . '%';
        array_push($params, $s, $s, $s);
    }
    if (!empty($opts['location'])) {
        $where[] = 'j.location LIKE ?';
        $params[] = '%' . $opts['location'] . '%';
    }
    if (!empty($opts['type'])) {
        $where[] = 'j.job_type = ?';
        $params[] = $opts['type'];
    }

    $whereSQL = 'WHERE ' . implode(' AND ', $where);
    $stmt = get_pdo()->prepare("SELECT COUNT(*) FROM jobs j $whereSQL");
    $stmt->execute($params);
    return (int)$stmt->fetchColumn();
}

function get_job_by_slug(string $slug): ?array {
    try {
        $stmt = get_pdo()->prepare('SELECT * FROM jobs WHERE slug = ? AND is_active = 1 LIMIT 1');
        $stmt->execute([$slug]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            get_pdo()->prepare('UPDATE jobs SET view_count = view_count + 1 WHERE id = ?')->execute([$row['id']]);
        }
        return $row ?: null;
    } catch (Exception $e) { return null; }
}

function get_jobs_stats(): array {
    $pdo = get_pdo();
    return [
        'total'     => (int)$pdo->query("SELECT COUNT(*) FROM jobs WHERE is_active=1 AND expires_at > NOW()")->fetchColumn(),
        'featured'  => (int)$pdo->query("SELECT COUNT(*) FROM jobs WHERE is_active=1 AND is_featured=1 AND expires_at > NOW()")->fetchColumn(),
        'companies' => (int)$pdo->query("SELECT COUNT(DISTINCT company_name) FROM jobs WHERE is_active=1")->fetchColumn(),
        'types'     => $pdo->query("SELECT job_type, COUNT(*) AS cnt FROM jobs WHERE is_active=1 AND expires_at > NOW() GROUP BY job_type ORDER BY cnt DESC")->fetchAll(PDO::FETCH_KEY_PAIR),
    ];
}
