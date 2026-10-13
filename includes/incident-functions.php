<?php
if (defined('INCIDENT_FUNCTIONS_LOADED')) return;
define('INCIDENT_FUNCTIONS_LOADED', true);
/**
 * includes/incident-functions.php
 * Indonesia K3 Incident Database — public searchable, auto-scraped daily.
 */
if (!defined('SITE_URL')) require_once __DIR__ . '/../config.php';

// ── Public Queries ────────────────────────────────────────────────────────────

function get_incidents(array $opts = []): array {
    $where  = ['i.is_active = 1'];
    $params = [];
    if (!empty($opts['province']))      { $where[] = 'i.province = ?';      $params[] = $opts['province']; }
    if (!empty($opts['industry']))      { $where[] = 'i.industry = ?';       $params[] = $opts['industry']; }
    if (!empty($opts['incident_type'])) { $where[] = 'i.incident_type = ?';  $params[] = $opts['incident_type']; }
    if (!empty($opts['year']))          { $where[] = 'YEAR(i.incident_date) = ?'; $params[] = (int)$opts['year']; }
    if (!empty($opts['deaths_gt']))     { $where[] = 'i.deaths > 0'; }
    if (!empty($opts['search']))        { $where[] = 'MATCH(i.title,i.description,i.company) AGAINST(? IN BOOLEAN MODE)'; $params[] = $opts['search'] . '*'; }
    $limit  = max(1, min(100, (int)($opts['limit'] ?? 20)));
    $offset = max(0, (int)($opts['offset'] ?? 0));
    $order  = in_array($opts['order'] ?? '', ['deaths','injured','incident_date','view_count']) ? $opts['order'] : 'incident_date';
    $sql = "SELECT * FROM incidents i WHERE " . implode(' AND ', $where) . "
            ORDER BY i.$order DESC LIMIT $limit OFFSET $offset";
    try {
        $stmt = get_pdo()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    } catch (Exception) { return []; }
}

function count_incidents(array $opts = []): int {
    $where  = ['i.is_active = 1'];
    $params = [];
    if (!empty($opts['province'])) { $where[] = 'i.province = ?'; $params[] = $opts['province']; }
    if (!empty($opts['industry'])) { $where[] = 'i.industry = ?'; $params[] = $opts['industry']; }
    if (!empty($opts['search']))   { $where[] = 'MATCH(i.title,i.description,i.company) AGAINST(? IN BOOLEAN MODE)'; $params[] = $opts['search'] . '*'; }
    $sql = 'SELECT COUNT(*) FROM incidents i WHERE ' . implode(' AND ', $where);
    try {
        $stmt = get_pdo()->prepare($sql);
        $stmt->execute($params);
        return (int)$stmt->fetchColumn();
    } catch (Exception) { return 0; }
}

function get_incident_by_slug(string $slug): ?array {
    try {
        $stmt = get_pdo()->prepare('SELECT * FROM incidents WHERE slug = ? AND is_active = 1 LIMIT 1');
        $stmt->execute([$slug]);
        $row = $stmt->fetch() ?: null;
        if ($row) get_pdo()->prepare('UPDATE incidents SET view_count = view_count + 1 WHERE id = ?')->execute([$row['id']]);
        return $row;
    } catch (Exception) { return null; }
}

function get_incident_filters(): array {
    try {
        $pdo = get_pdo();
        return [
            'provinces' => $pdo->query("SELECT DISTINCT province FROM incidents WHERE province IS NOT NULL AND is_active=1 ORDER BY province")->fetchAll(PDO::FETCH_COLUMN),
            'industries'=> $pdo->query("SELECT DISTINCT industry FROM incidents WHERE industry IS NOT NULL AND is_active=1 ORDER BY industry")->fetchAll(PDO::FETCH_COLUMN),
            'types'     => $pdo->query("SELECT DISTINCT incident_type FROM incidents WHERE incident_type IS NOT NULL AND is_active=1 ORDER BY incident_type")->fetchAll(PDO::FETCH_COLUMN),
            'years'     => $pdo->query("SELECT DISTINCT YEAR(incident_date) AS yr FROM incidents WHERE incident_date IS NOT NULL AND is_active=1 ORDER BY yr DESC")->fetchAll(PDO::FETCH_COLUMN),
        ];
    } catch (Exception) { return ['provinces'=>[],'industries'=>[],'types'=>[],'years'=>[]]; }
}

function get_incident_stats(): array {
    try {
        $pdo = get_pdo();
        return [
            'total'         => (int)$pdo->query('SELECT COUNT(*) FROM incidents WHERE is_active=1')->fetchColumn(),
            'total_deaths'  => (int)$pdo->query('SELECT COALESCE(SUM(deaths),0) FROM incidents WHERE is_active=1')->fetchColumn(),
            'total_injured' => (int)$pdo->query('SELECT COALESCE(SUM(injured),0) FROM incidents WHERE is_active=1')->fetchColumn(),
            'this_year'     => (int)$pdo->query('SELECT COUNT(*) FROM incidents WHERE is_active=1 AND YEAR(incident_date)=YEAR(CURDATE())')->fetchColumn(),
            'this_month'    => (int)$pdo->query('SELECT COUNT(*) FROM incidents WHERE is_active=1 AND MONTH(incident_date)=MONTH(CURDATE()) AND YEAR(incident_date)=YEAR(CURDATE())')->fetchColumn(),
            'last_updated'  => $pdo->query('SELECT MAX(updated_at) FROM incidents WHERE is_active=1')->fetchColumn(),
        ];
    } catch (Exception) { return []; }
}

function get_related_incidents(int $id, string $province = '', string $industry = '', int $limit = 4): array {
    $where  = ['i.is_active = 1', 'i.id != ' . (int)$id];
    $params = [];
    if ($province) { $where[] = 'i.province = ?'; $params[] = $province; }
    if ($industry) { $where[] = 'i.industry = ?'; $params[] = $industry; }
    $sql = 'SELECT * FROM incidents i WHERE ' . implode(' AND ', $where) . " ORDER BY i.incident_date DESC LIMIT $limit";
    try {
        $stmt = get_pdo()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    } catch (Exception) { return []; }
}
