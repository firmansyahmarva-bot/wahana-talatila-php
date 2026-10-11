<?php
declare(strict_types=1);

function mailer_url(string $path = ''): string
{
    return MAILER_URL . '/' . ltrim($path, '/');
}

function redirect(string $url): never
{
    header('Location: ' . $url);
    exit;
}

function e(?string $s): string
{
    return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
}

function is_post(): bool
{
    return ($_SERVER['REQUEST_METHOD'] ?? '') === 'POST';
}

function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrf_field(): string
{
    return '<input type="hidden" name="csrf_token" value="' . e(csrf_token()) . '">';
}

function csrf_verify(): void
{
    $token = $_POST['csrf_token'] ?? '';
    if (!is_string($token) || $token === '' || !hash_equals($_SESSION['csrf_token'] ?? '', $token)) {
        http_response_code(403);
        exit('Invalid or expired form submission. Go back and try again.');
    }
}

function flash_set(string $type, string $message): void
{
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function flash_get(): ?array
{
    if (empty($_SESSION['flash'])) {
        return null;
    }
    $f = $_SESSION['flash'];
    unset($_SESSION['flash']);
    return $f;
}

/** Timestamp of the cron's last run, or null if it has never run. */
function cron_last_run(): ?int
{
    $flag = ROOT_PATH . '/cron/.last-run';
    return is_file($flag) ? filemtime($flag) : null;
}

function time_ago(int $timestamp): string
{
    $diff = max(0, time() - $timestamp);
    if ($diff < 60) {
        return $diff . 's ago';
    }
    if ($diff < 3600) {
        return floor($diff / 60) . 'm ago';
    }
    if ($diff < 86400) {
        return floor($diff / 3600) . 'h ago';
    }
    return floor($diff / 86400) . 'd ago';
}
