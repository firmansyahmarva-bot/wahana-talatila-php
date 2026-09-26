<?php
/**
 * api/includes/api-common.php
 * Unified helper functions for Wahana Totalita Content APIs.
 * Handles HTTPS enforcement, token auth, CORS, JSON output, and audit logging.
 */

if (!defined('APP_DEBUG')) {
    require_once __DIR__ . '/../../config.php';
}

// ─── Headers & Security ───────────────────────────────────────────────────
header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('Referrer-Policy: strict-origin-when-cross-origin');

// Allow local or designated origins if needed (CORS preflight support)
if (isset($_SERVER['HTTP_ORIGIN'])) {
    $origin = (string)$_SERVER['HTTP_ORIGIN'];
    $allowed = [
        'https://wahanatotalita.com',
        'http://localhost',
        'http://127.0.0.1'
    ];
    if (in_array($origin, $allowed, true) || str_ends_with($origin, '.wahanatotalita.com')) {
        header('Access-Control-Allow-Origin: ' . $origin);
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Authorization, X-API-Key, Content-Type, X-Requested-With');
    }
}

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'OPTIONS') {
    http_response_code(204);
    exit;
}

// ─── Response Helpers ─────────────────────────────────────────────────────
function api_response(bool $success, mixed $data = null, ?string $message = null, int $statusCode = 200, array $errors = [], array $meta = []): never {
    http_response_code($statusCode);
    
    $response = [
        'success'   => $success,
        'message'   => $message,
        'data'      => $data,
        'timestamp' => date('c'),
    ];

    if (!$success && !empty($errors)) {
        $response['errors'] = $errors;
    }

    if (!empty($meta)) {
        $response['meta'] = $meta;
    }

    echo json_encode($response, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
}

function api_success(mixed $data = null, ?string $message = 'Success', int $statusCode = 200, array $meta = []): never {
    api_response(true, $data, $message, $statusCode, [], $meta);
}

function api_error(string $message, int $statusCode = 400, array $errors = [], string $errorCode = 'BAD_REQUEST'): never {
    api_response(false, null, $message, $statusCode, $errors, ['error_code' => $errorCode]);
}

// ─── Request Body Helper ──────────────────────────────────────────────────
function get_json_input(): array {
    $raw = file_get_contents('php://input');
    if (!$raw || trim($raw) === '') {
        return $_POST ?: [];
    }
    $decoded = json_decode($raw, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        api_error('Invalid JSON payload: ' . json_last_error_msg(), 400, [], 'INVALID_JSON');
    }
    return is_array($decoded) ? $decoded : [];
}

// ─── HTTPS & Authentication Middleware ─────────────────────────────────────
function require_api_auth(): void {
    // 1. Enforce HTTPS in production environment
    if (!APP_DEBUG && php_sapi_name() !== 'cli') {
        $isHttps = (
            (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ||
            (isset($_SERVER['SERVER_PORT']) && (int)$_SERVER['SERVER_PORT'] === 443) ||
            (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')
        );
        if (!$isHttps) {
            api_error('HTTPS is required to access the Content API.', 403, [], 'HTTPS_REQUIRED');
        }
    }

    // 2. Extract Bearer Token or X-API-Key
    $token = null;
    
    // Check Authorization header
    $authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? ($_SERVER['REDIRECT_HTTP_AUTHORIZATION'] ?? '');
    if (!$authHeader && function_exists('apache_request_headers')) {
        $headers = apache_request_headers();
        $authHeader = $headers['Authorization'] ?? ($headers['authorization'] ?? '');
    }

    if ($authHeader && preg_match('/Bearer\s+(\S+)/i', $authHeader, $matches)) {
        $token = $matches[1];
    } elseif (!empty($_SERVER['HTTP_X_API_KEY'])) {
        $token = (string)$_SERVER['HTTP_X_API_KEY'];
    } elseif (!empty($_GET['api_key'])) {
        // Fallback for secure curl query parameter testing
        $token = (string)$_GET['api_key'];
    }

    if (!$token) {
        api_error('Missing API key. Provide via "Authorization: Bearer <TOKEN>" or "X-API-Key" header.', 401, [], 'UNAUTHORIZED');
    }

    // 3. Verify Token
    $serverKey = get_content_api_key();
    if ($serverKey === '') {
        api_error('API key is not configured on the server. Please define CONTENT_API_KEY.', 503, [], 'SERVER_MISCONFIGURED');
    }

    if (!verify_content_api_key($token)) {
        api_error('Invalid or expired API key.', 401, [], 'INVALID_CREDENTIALS');
    }
}

// ─── Audit Trail Logger ───────────────────────────────────────────────────
function ensure_audit_log_table(PDO $pdo): void {
    static $checked = false;
    if ($checked) return;
    try {
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS content_audit_logs (
                id BIGINT AUTO_INCREMENT PRIMARY KEY,
                entity_type VARCHAR(32) NOT NULL,
                entity_id INT NULL,
                slug VARCHAR(255) NOT NULL,
                action VARCHAR(32) NOT NULL,
                actor VARCHAR(100) NOT NULL DEFAULT 'agent',
                changes_json LONGTEXT NULL,
                ip_address VARCHAR(45) NULL,
                user_agent VARCHAR(255) NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                INDEX idx_entity (entity_type, entity_id),
                INDEX idx_slug (slug),
                INDEX idx_action (action),
                INDEX idx_created (created_at)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ");
        $checked = true;
    } catch (Exception $e) {
        error_log('[API Audit Log Table] ' . $e->getMessage());
    }
}

function ensure_redirect_tables(PDO $pdo): void {
    static $checked = false;
    if ($checked) return;
    try {
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS training_redirects (
                id INT AUTO_INCREMENT PRIMARY KEY,
                old_slug VARCHAR(255) NOT NULL UNIQUE,
                target_slug VARCHAR(255) NULL,
                target_category_slug VARCHAR(255) NULL,
                reason VARCHAR(50) NOT NULL DEFAULT 'slug_changed',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                INDEX idx_old (old_slug)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ");
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS article_redirects (
                id INT AUTO_INCREMENT PRIMARY KEY,
                old_slug VARCHAR(255) NOT NULL UNIQUE,
                target_slug VARCHAR(255) NULL,
                target_category_slug VARCHAR(255) NULL,
                reason VARCHAR(50) NOT NULL DEFAULT 'slug_changed',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                INDEX idx_art_old (old_slug)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ");
        $checked = true;
    } catch (Exception $e) {
        error_log('[Redirects Table Error] ' . $e->getMessage());
    }
}

function log_content_audit(
    PDO $pdo,
    string $entityType,
    ?int $entityId,
    string $slug,
    string $action,
    ?array $changes = null,
    string $actor = 'agent'
): void {
    try {
        ensure_audit_log_table($pdo);
        $ip = $_SERVER['REMOTE_ADDR'] ?? (php_sapi_name() === 'cli' ? '127.0.0.1' : null);
        $ua = substr($_SERVER['HTTP_USER_AGENT'] ?? (php_sapi_name() === 'cli' ? 'CLI/Agent' : ''), 0, 255);
        $changesJson = !empty($changes) ? json_encode($changes, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) : null;

        $stmt = $pdo->prepare("
            INSERT INTO content_audit_logs
            (entity_type, entity_id, slug, action, actor, changes_json, ip_address, user_agent, created_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())
        ");
        $stmt->execute([
            $entityType,
            $entityId,
            $slug,
            $action,
            $actor,
            $changesJson,
            $ip,
            $ua
        ]);
    } catch (Exception $e) {
        error_log('[Audit Log Error] ' . $e->getMessage());
    }
}
