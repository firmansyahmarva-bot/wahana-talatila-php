<?php
declare(strict_types=1);

/**
 * PT Wahana Totalita Konsultan — Standalone Mailer
 * Config & bootstrap. This file is blocked from direct HTTP access by .htaccess —
 * never remove that protection.
 */

define('APP_ENV', 'production'); // 'development' shows PHP errors; keep 'production' live
define('SITE_URL', 'https://wahanatotalita.com');
define('MAILER_URL', 'https://wahanatotalita.com/mailer');
define('SITE_LOGO_URL', 'https://wahanatotalita.com/assets/img/logo-wt.png');

// ── Database — CREATE A NEW, DEDICATED DATABASE in hPanel. Do not reuse the main site's DB. ──
define('DB_HOST', 'localhost');
define('DB_NAME', 'u566907099_mailer');
define('DB_USER', 'u566907099_mailer');
define('DB_PASS', '2KDSGW#mp9.XLK+');

// ── Security ──
define('SECRET_KEY', 'eb2835247b2196a6283ac17402267f068a905b2d470c3aa3fee221e49fc6f532');
define('SESSION_HOURS', 8);
define('LOGIN_MAX_ATTEMPTS', 5);
define('LOGIN_LOCKOUT_MINUTES', 15);

define('ROOT_PATH', __DIR__);
define('TIMEZONE', 'Asia/Jakarta');
date_default_timezone_set(TIMEZONE);

if (APP_ENV === 'development') {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
} else {
    error_reporting(0);
    ini_set('display_errors', '0');
}

// Cron runs as CLI — it has no cookies/session and doesn't need one.
if (php_sapi_name() !== 'cli' && session_status() === PHP_SESSION_NONE) {
    session_name('wtmailer_sess');
    ini_set('session.cookie_httponly', '1');
    ini_set('session.cookie_samesite', 'Lax');
    ini_set('session.gc_maxlifetime', (string)(SESSION_HOURS * 3600));
    if (APP_ENV === 'production') {
        ini_set('session.cookie_secure', '1');
    }
    session_start();
}

require_once ROOT_PATH . '/includes/db.php';
require_once ROOT_PATH . '/includes/helpers.php';
require_once ROOT_PATH . '/includes/template-engine.php';
require_once ROOT_PATH . '/includes/smtp-settings.php';

// auth.php and layout.php use session/helpers above; only meaningful on the web (not cron)
require_once ROOT_PATH . '/includes/auth.php';
if (php_sapi_name() !== 'cli') {
    require_once ROOT_PATH . '/includes/layout.php';
}
