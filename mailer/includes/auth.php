<?php
declare(strict_types=1);

function current_admin(): ?array
{
    static $cache = null;
    static $checked = false;
    if ($checked) {
        return $cache;
    }
    $checked = true;
    if (empty($_SESSION['admin_id'])) {
        return null;
    }
    $stmt = db()->prepare('SELECT id, email, name FROM admin_users WHERE id = ?');
    $stmt->execute([$_SESSION['admin_id']]);
    $row = $stmt->fetch();
    $cache = $row ?: null;
    return $cache;
}

function require_login(): array
{
    $admin = current_admin();
    if (!$admin) {
        redirect(mailer_url('login.php'));
    }
    return $admin;
}

/** @return array{ok:bool,error:?string} */
function attempt_login(string $email, string $password): array
{
    $stmt = db()->prepare('SELECT * FROM admin_users WHERE email = ? LIMIT 1');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && $user['locked_until'] && strtotime((string)$user['locked_until']) > time()) {
        return ['ok' => false, 'error' => 'Account temporarily locked due to failed attempts. Try again later.'];
    }

    if (!$user || !password_verify($password, $user['password_hash'])) {
        if ($user) {
            $attempts = (int)$user['failed_attempts'] + 1;
            $locked = null;
            if ($attempts >= LOGIN_MAX_ATTEMPTS) {
                $locked = date('Y-m-d H:i:s', time() + LOGIN_LOCKOUT_MINUTES * 60);
                $attempts = 0;
            }
            $upd = db()->prepare('UPDATE admin_users SET failed_attempts = ?, locked_until = ? WHERE id = ?');
            $upd->execute([$attempts, $locked, $user['id']]);
        }
        return ['ok' => false, 'error' => 'Invalid email or password.'];
    }

    $upd = db()->prepare('UPDATE admin_users SET failed_attempts = 0, locked_until = NULL, last_login_at = NOW() WHERE id = ?');
    $upd->execute([$user['id']]);

    session_regenerate_id(true);
    $_SESSION['admin_id'] = $user['id'];
    return ['ok' => true, 'error' => null];
}
