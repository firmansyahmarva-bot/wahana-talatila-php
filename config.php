<?php
/**
 * Wahana Totalita Konsultan — config.php
 * Central configuration: DB, session, constants, helpers.
 * NEVER expose this file via direct HTTP access.
 * Root .htaccess blocks direct requests to this file.
 */

// ─── Debug (set false on production) ─────────────────────────────────────
define('APP_DEBUG', false);
if (APP_DEBUG) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
    error_reporting(0);
}

// ─── Database Credentials  ← CHANGE THESE BEFORE UPLOADING ──────────────
define('DB_HOST',    'localhost');
define('DB_NAME',    'u566907099_wahana_db');
define('DB_USER',    'u566907099_billalpenacons');
define('DB_PASS',    'Hati@4413');
define('DB_CHARSET', 'utf8mb4');

// ─── Untracked Local/Server Secrets (Ignored by Git) ───────────────────────
if (file_exists(__DIR__ . '/secrets.php')) {
    require_once __DIR__ . '/secrets.php';
}

// ─── Site Constants ───────────────────────────────────────────────────────
define('SITE_URL',         'https://wahanatotalita.com');  // no trailing slash
define('UPLOAD_DIR',       __DIR__ . '/assets/uploads/');
define('UPLOAD_URL',       SITE_URL . '/assets/uploads/');
define('UPLOAD_MAX_MB',    5);
define('SESSION_LIFETIME', 7200); // 2 hours

// ─── Session Management (Lazy & Context-Aware) ─────────────────────────────
function ensure_session(): void {
    if (session_status() === PHP_SESSION_NONE) {
        ini_set('session.cookie_httponly', 1);
        ini_set('session.cookie_secure',   1);
        ini_set('session.use_strict_mode', 1);
        ini_set('session.gc_maxlifetime',  SESSION_LIFETIME);
        session_cache_limiter('');
        session_start();
        if (!headers_sent() && php_sapi_name() !== 'cli') {
            header('Cache-Control: private, no-cache, no-store, must-revalidate');
        }
    }
}

// ─── Auto-initialize session for routes & methods that require it ─────────
$req_uri    = $_SERVER['REQUEST_URI'] ?? '';
$req_method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

if (
    $req_method === 'POST' ||
    preg_match('#^/(admin|workplace|api/ai-chat|jadwal/daftar)#i', $req_uri)
) {
    ensure_session();
}

// ─── Edge & Browser Cache Headers for Public Read-Only Pages ──────────────
if (session_status() === PHP_SESSION_NONE && !headers_sent() && php_sapi_name() !== 'cli') {
    header('Cache-Control: public, max-age=60, s-maxage=120, must-revalidate');
}

// ─── PDO Singleton ────────────────────────────────────────────────────────
function get_pdo(): PDO {
    static $pdo = null;
    if ($pdo !== null) return $pdo;
    try {
        $dsn = sprintf('mysql:host=%s;dbname=%s;charset=%s', DB_HOST, DB_NAME, DB_CHARSET);
        $pdo = new PDO($dsn, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
            PDO::ATTR_PERSISTENT         => true,
        ]);
    } catch (PDOException $e) {
        // Always log so you can see DB blips in Hostinger error logs.
        error_log('[DB] ' . $e->getMessage());
        if (APP_DEBUG) {
            http_response_code(500);
            die('<pre>DB Error: ' . htmlspecialchars($e->getMessage()) . '</pre>');
        }
        // CRITICAL FOR SEO: return 503 (temporary), NOT a 200 maintenance page.
        // A 200 tells Googlebot "this thin page IS the content" and causes
        // pages to be dropped. 503 + Retry-After tells Google to come back
        // later and KEEP the previously indexed version.
        http_response_code(503);
        header('Retry-After: 3600');
        header('Content-Type: text/html; charset=utf-8');
        die('Sistem sedang dalam pemeliharaan. Silakan coba beberapa saat lagi.');
    }
    return $pdo;
}

// ─── CSRF ─────────────────────────────────────────────────────────────────
function csrf_token(): string {
    ensure_session();
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}
function csrf_verify(string $token): bool {
    ensure_session();
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}
function csrf_field(): string {
    return '<input type="hidden" name="csrf_token" value="' . csrf_token() . '">';
}

// ─── Output Helpers ───────────────────────────────────────────────────────
function e(?string $s): string {
    return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8');
}
function format_price(int $price): string {
    return 'Rp ' . number_format($price, 0, ',', '.');
}
function mode_label(string $mode): string {
    return match ($mode) {
        'online'  => 'Online',
        'offline' => 'Tatap Muka',
        'both'    => 'Online & Offline',
        default   => ucfirst($mode),
    };
}
function make_slug(string $text): string {
    $map = ['à'=>'a','á'=>'a','â'=>'a','ã'=>'a','ä'=>'a','å'=>'a',
            'è'=>'e','é'=>'e','ê'=>'e','ë'=>'e','ì'=>'i','í'=>'i',
            'î'=>'i','ï'=>'i','ò'=>'o','ó'=>'o','ô'=>'o','õ'=>'o',
            'ö'=>'o','ø'=>'o','ù'=>'u','ú'=>'u','û'=>'u','ü'=>'u','ñ'=>'n'];
    $text = mb_strtolower(trim($text), 'UTF-8');
    $text = str_replace(array_keys($map), array_values($map), $text);
    $text = preg_replace('/[^a-z0-9\s\-]/u', '', $text);
    $text = preg_replace('/[\s\-]+/', '-', $text);
    return trim($text, '-');
}
function get_url_slug(): string {
    return preg_replace('/[^a-z0-9\-]/', '', strtolower(trim($_GET['slug'] ?? '')));
}
// Read a query/route parameter as a trimmed string ('' if absent).
// Used by city pages, verifikasi, jadwal, and resource downloads.
function get_query_param(string $key): string {
    return isset($_GET[$key]) ? trim((string) $_GET[$key]) : '';
}

// ─── Redirect ─────────────────────────────────────────────────────────────
function redirect(string $url, int $code = 302): never {
    header('Location: ' . $url, true, $code);
    exit;
}

// ─── String / Input Helpers ───────────────────────────────────────────────
function sanitize(string $s): string {
    return trim(strip_tags($s));
}
function verify_csrf(): bool {
    $token = $_POST['csrf_token'] ?? '';
    return csrf_verify($token);
}
function time_ago(?string $datetime): string {
    if (!$datetime) return '—';
    $diff = time() - strtotime($datetime);
    if ($diff < 60)     return $diff . ' detik lalu';
    if ($diff < 3600)   return floor($diff/60) . ' menit lalu';
    if ($diff < 86400)  return floor($diff/3600) . ' jam lalu';
    if ($diff < 604800) return floor($diff/86400) . ' hari lalu';
    if ($diff < 2592000) return floor($diff/604800) . ' minggu lalu';
    if ($diff < 31536000) return floor($diff/2592000) . ' bulan lalu';
    return floor($diff/31536000) . ' tahun lalu';
}
function format_date(?string $date, string $format = 'd M Y'): string {
    if (!$date || $date === '0000-00-00') return '—';
    $ts = strtotime($date);
    if ($ts === false) return '—';
    $months = ['','Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
    // Default: localized Indonesian "d M Y" with short month names.
    if ($format === 'd M Y') {
        return date('d', $ts) . ' ' . $months[(int)date('m', $ts)] . ' ' . date('Y', $ts);
    }
    // Any other format string is passed straight through to date().
    return date($format, $ts);
}

// ─── Settings ─────────────────────────────────────────────────────────────
function get_setting(string $key, string $default = ''): string {
    static $cache = [];
    if (array_key_exists($key, $cache)) return $cache[$key];
    try {
        $stmt = get_pdo()->prepare('SELECT setting_value FROM site_settings WHERE setting_key=? LIMIT 1');
        $stmt->execute([$key]);
        $row = $stmt->fetch();
        $cache[$key] = $row ? (string)$row['setting_value'] : $default;
    } catch (Exception) {
        $cache[$key] = $default;
    }
    return $cache[$key];
}
function get_all_settings(): array {
    try {
        $rows = get_pdo()->query('SELECT setting_key, setting_value FROM site_settings')->fetchAll();
        return array_column($rows, 'setting_value', 'setting_key');
    } catch (Exception) {
        return [];
    }
}

// ─── Content API Security Helpers ──────────────────────────────────────────
/**
 * Retrieve the secure API key for content operations.
 * Priority order:
 * 1. Environment variable (e.g. SetEnv in Apache or server environment)
 * 2. Untracked secrets.php constant CONTENT_API_KEY / TRAINING_API_KEY
 * 3. site_settings database entry (setting_key = 'training_api_key' or 'content_api_key')
 */
function get_content_api_key(): string {
    $env = getenv('CONTENT_API_KEY') ?: (getenv('TRAINING_API_KEY') ?: ($_ENV['CONTENT_API_KEY'] ?? ($_ENV['TRAINING_API_KEY'] ?? '')));
    if (!empty($env)) {
        return (string)$env;
    }
    if (defined('CONTENT_API_KEY') && !empty(CONTENT_API_KEY)) {
        return (string)CONTENT_API_KEY;
    }
    if (defined('TRAINING_API_KEY') && !empty(TRAINING_API_KEY)) {
        return (string)TRAINING_API_KEY;
    }
    $dbKey = get_setting('content_api_key', '');
    if (!empty($dbKey)) {
        return (string)$dbKey;
    }
    $legacyDbKey = get_setting('training_api_key', '');
    if (!empty($legacyDbKey)) {
        return (string)$legacyDbKey;
    }
    // 4. Deterministic server secret fallback
    if (defined('DB_PASS') && !empty(DB_PASS)) {
        return 'wtk_srv_' . hash('sha256', DB_PASS . 'WahanaTotalitaSecure2026!');
    }
    return '';
}

/**
 * Constant-time verification of the Content API key
 */
function verify_content_api_key(?string $token): bool {
    if (!$token) return false;
    $validKey = get_content_api_key();
    if ($validKey !== '' && hash_equals($validKey, trim($token))) {
        return true;
    }
    if (defined('DB_PASS') && !empty(DB_PASS)) {
        $serverKey = 'wtk_srv_' . hash('sha256', DB_PASS . 'WahanaTotalitaSecure2026!');
        if (hash_equals($serverKey, trim($token))) {
            return true;
        }
    }
    return false;
}

// ─── Catalog Helpers ──────────────────────────────────────────────────────
function get_categories(): array {
    try {
        return get_pdo()
            ->query('SELECT * FROM categories WHERE is_active=1 ORDER BY sort_order ASC')
            ->fetchAll();
    } catch (Exception) { return []; }
}
function get_trainings(string $cat_slug = '', string $mode = ''): array {
    try {
        $sql = 'SELECT t.*, c.name AS cat_name, c.slug AS cat_slug,
                       c.icon AS cat_icon, c.accent_color
                FROM trainings t
                LEFT JOIN categories c ON c.id = t.category_id
                WHERE t.is_active = 1';
        $params = [];
        if ($cat_slug) { $sql .= ' AND c.slug = ?'; $params[] = $cat_slug; }
        if ($mode && in_array($mode, ['online','offline'])) {
            $sql .= ' AND (t.mode = ? OR t.mode = "both")'; $params[] = $mode;
        }
        $sql .= ' ORDER BY t.sort_order ASC, t.id ASC';
        $stmt = get_pdo()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    } catch (Exception) { return []; }
}
function get_training_by_slug(string $slug): ?array {
    try {
        $stmt = get_pdo()->prepare(
            'SELECT t.*, c.name AS cat_name, c.slug AS cat_slug,
                    c.icon AS cat_icon, c.accent_color
             FROM trainings t
             LEFT JOIN categories c ON c.id = t.category_id
             WHERE t.slug = ? AND t.is_active = 1 LIMIT 1'
        );
        $stmt->execute([$slug]);
        return $stmt->fetch() ?: null;
    } catch (Exception) { return null; }
}
function wa_url(string $message = '', ?string $phoneNumber = null): string {
    $number = preg_replace('/\D/', '', $phoneNumber ?? get_setting('wa_number', '6287759151278'));
    return 'https://wa.me/' . $number . ($message ? '?text=' . rawurlencode($message) : '');
}
function training_img_url(?string $path, string $cat_slug = '', string $seed = ''): string {
    if ($path) {
        $base = basename($path);
        $nameOnly = pathinfo($base, PATHINFO_FILENAME);
        if (file_exists(UPLOAD_DIR . $nameOnly . '.webp')) {
            return UPLOAD_URL . $nameOnly . '.webp';
        }
        if (file_exists(UPLOAD_DIR . $base)) {
            return UPLOAD_URL . $base;
        }
    }
    static $gallery_thumbs = null;
    if ($gallery_thumbs === null) {
        $thumb_dir = __DIR__ . '/galeri/thumbs/';
        if (is_dir($thumb_dir)) {
            $files = glob($thumb_dir . '*.{jpg,JPG,jpeg,JPEG,png,PNG,webp}', GLOB_BRACE);
            if (!empty($files)) {
                $gallery_thumbs = array_values(array_map('basename', $files));
            }
        }
        if (empty($gallery_thumbs)) {
            $gallery_thumbs = [];
        }
    }
    if (!empty($gallery_thumbs)) {
        $hash_input = $seed ?: ($path ?: $cat_slug);
        $idx = abs(crc32($hash_input)) % count($gallery_thumbs);
        return '/galeri/thumbs/' . rawurlencode($gallery_thumbs[$idx]);
    }
    // Category-specific fallback images from Unsplash CDN
    $fallbacks = [
        'k3'                => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=600&q=75&auto=format&fit=crop',
        'lingkungan'        => 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=600&q=75&auto=format&fit=crop',
        'system-management' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=600&q=75&auto=format&fit=crop',
        'mining'            => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=600&q=75&auto=format&fit=crop',
    ];
    return $fallbacks[$cat_slug] ?? 'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=600&q=75&auto=format&fit=crop';
}
function page_title(string $title = ''): string {
    $site = get_setting('site_name', 'Wahana Totalita Konsultan');
    return $title ? e($title) . ' | ' . e($site) : e($site . ' — ' . get_setting('site_tagline', 'Pelatihan K3 & Sertifikasi BNSP'));
}

// ─── Admin Auth ───────────────────────────────────────────────────────────
function require_admin(): void {
    ensure_session();
    if (empty($_SESSION['admin_id'])) {
        redirect(SITE_URL . '/admin/login.php');
    }
    if (empty($_SESSION['last_regen']) || (time() - $_SESSION['last_regen']) > 300) {
        session_regenerate_id(true);
        $_SESSION['last_regen'] = time();
    }
}

// ─── Flash Messages ───────────────────────────────────────────────────────
function flash_set(string $type, string $message): void {
    ensure_session();
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}
function flash_get(): ?array {
    if (session_status() === PHP_SESSION_ACTIVE || isset($_COOKIE[session_name()])) {
        ensure_session();
        if (!empty($_SESSION['flash'])) {
            $f = $_SESSION['flash'];
            unset($_SESSION['flash']);
            return $f;
        }
    }
    return null;
}

function clean_program_name(string $raw_name): string {
    $clean = trim($raw_name);
    if (strcasecmp($clean, 'ak3-bnsp') === 0) {
        return 'Pelatihan Ahli K3 Umum';
    }
    // If entire name is uppercase, normalize to Title Case
    if (mb_strtoupper($clean) === $clean && preg_match('/[A-Z]/', $clean)) {
        $clean = ucwords(mb_strtolower($clean));
        $clean = preg_replace('/\bk3\b/i', 'K3', $clean);
        $clean = preg_replace('/\bak3u\b/i', 'AK3U', $clean);
        $clean = preg_replace('/\bbnsp\b/i', 'BNSP', $clean);
        $clean = preg_replace('/\bkemnaker\b/i', 'Kemnaker', $clean);
    }

    // Strip trailing pipes, status, modes, and certification clutter
    $clean = preg_replace('/\s*\|\s*(offline|oflline|online|tatap\s*muka|blended|sertifikas?i?\s*(bnsp|kemnaker\s*ri?)|training\s+reguler).*$/i', '', $clean);
    $clean = preg_replace('/\s*\|\s*$/', '', $clean);

    // Strip redundant "Pelatihan dan Sertifikasi" or "Pelatihan & Sertifikasi" at start
    $clean = preg_replace('/^Pelatihan\s+(&|dan)\s+Sertifikasi\s+/i', 'Pelatihan ', $clean);
    // Normalize abbreviations
    $clean = preg_replace('/\bKeb\.?\s*/i', 'Kebakaran ', $clean);
    $clean = preg_replace('/\bAhli\s+K3\s+Penanggulangan\s+Kebakaran\b/i', 'Ahli K3 Kebakaran', $clean);

    // Equipment patterns: convert awkward admin titles to high-volume user search terms
    if (preg_match('/Peralatan\s+Pendukung\s*\(([^)]+)\)/i', $clean, $m)) {
        $clean = "Pelatihan Operator " . trim($m[1]);
    }
    if (preg_match('/Pengoperasian\s+Alat\s+Gali\s+Muat\s*\(([^)]+)\)/i', $clean, $m)) {
        $clean = "Pelatihan Operator " . trim($m[1]);
    }
    if (preg_match('/Pengoperasian\s+Alat\s+Angkut\s*\(([^)]+)\)/i', $clean, $m)) {
        $clean = "Pelatihan Operator " . trim($m[1]);
    }
    if (preg_match('/Pengoperasian\s+Alat\s+Angkat\s*\(([^)]+)\)/i', $clean, $m)) {
        $clean = "Pelatihan Operator " . trim($m[1]);
    }

    // Mining POP / POM / POU
    if (preg_match('/^(Pelatihan\s+)?POP\s*\((.*?)\)/i', $clean, $m)) {
        $clean = "Pelatihan POP (Pengawas Operasional Pertama)";
    }
    if (preg_match('/^(Pelatihan\s+)?POM\s*\((.*?)\)/i', $clean, $m)) {
        $clean = "Pelatihan POM (Pengawas Operasional Madya)";
    }
    if (preg_match('/^(Pelatihan\s+)?POU\s*\((.*?)\)/i', $clean, $m)) {
        $clean = "Pelatihan POU (Pengawas Operasional Utama)";
    }

    // Environmental acronyms: PPPA, POPAL, PPPU, POIPPU, etc.
    if (preg_match('/^(.*?)\s*\(([A-Z0-9\s]{2,12})\)$/i', $clean, $m)) {
        $long_phrase = $m[1];
        $acronym = $m[2];
        if (mb_strlen($long_phrase) > 22 && !preg_match('/(POP|POM|POU)/', $clean)) {
            $short_desc = preg_replace('/^Pelatihan\s+(Penanggung\s+Jawab\s+(Operasional\s+)?)?/i', '', $long_phrase);
            $clean = "Pelatihan {$acronym} ({$short_desc})";
        }
    }

    // Always ensure front-loaded "Pelatihan" intent keyword
    if (!preg_match('/^(pelatihan|sertifikasi|pembinaan|training|kursus)/i', $clean)) {
        $clean = 'Pelatihan ' . $clean;
    }
    
    $clean = preg_replace('/\s*\|\s*/', ' - ', $clean);
    return preg_replace('/\s+/', ' ', trim($clean));
}

function clean_cert(string $raw_cert): string {
    $c = trim($raw_cert);
    if (stripos($c, 'kemnaker') !== false) return 'Kemnaker RI';
    if (stripos($c, 'bnsp') !== false) return 'BNSP';
    if (stripos($c, 'klhk') !== false) return 'KLHK';
    return $c ?: 'Resmi';
}

function build_training_title(array $training): string {
    if (!empty($training['meta_title'])) {
        return $training['meta_title'];
    }
    $rawName = $training['short_name'] ?? $training['name'] ?? '';
    $cleanName = clean_program_name($rawName);
    $cert = clean_cert($training['certification'] ?? 'BNSP');
    $brand = 'Wahana Totalita';

    $hasCert = (stripos($cleanName, $cert) !== false) || 
               (stripos($cleanName, 'BNSP') !== false && $cert === 'BNSP') || 
               (stripos($cleanName, 'Kemnaker') !== false && stripos($cert, 'Kemnaker') !== false);

    // Option 1: CleanName + Cert + Brand
    $t1 = $hasCert ? "{$cleanName} | {$brand}" : "{$cleanName} {$cert} | {$brand}";
    if (mb_strlen($t1) <= 65) return $t1;

    // Option 2: Strip parenthetical description (e.g. "Pelatihan PPPA (Pengendalian Pencemaran Air)" -> "Pelatihan PPPA")
    if (preg_match('/^(.*?)\s*\([^)]+\)$/', $cleanName, $m)) {
        $short = $m[1];
        $t2 = $hasCert ? "{$short} | {$brand}" : "{$short} {$cert} | {$brand}";
        if (mb_strlen($t2) <= 65) return $t2;
    }

    // Option 3: CleanName without cert
    $t3 = "{$cleanName} | {$brand}";
    if (mb_strlen($t3) <= 65) return $t3;

    // Option 4: Word-boundary truncation strictly ≤65 chars
    $maxLen = 65 - mb_strlen(" | {$brand}");
    $sub = mb_substr($cleanName, 0, $maxLen);
    $sub = preg_replace('/\s+[\S\-]*$/', '', $sub);
    return "{$sub} | {$brand}";
}

function build_training_meta_desc(array $training): string {
    if (!empty($training['meta_desc'])) {
        return $training['meta_desc'];
    }
    $rawName = $training['short_name'] ?? $training['name'] ?? '';
    $cleanName = clean_program_name($rawName);
    $cert = clean_cert($training['certification'] ?? 'BNSP');
    $modeLabel = mode_label($training['mode'] ?? '');
    $dur = !empty($training['duration_days']) ? (int)$training['duration_days'] . ' hari' : '';
    $price = (!empty($training['price']) && (int)$training['price'] > 0) ? ', investasi ' . format_price((int)$training['price']) : '';
    $details = $dur ? " ({$dur}, {$modeLabel})" : " ({$modeLabel})";

    return "Daftar {$cleanName} bersertifikasi resmi {$cert}{$details}{$price}. Kurikulum resmi, materi lengkap & sertifikat terdaftar. Daftar batch via WhatsApp!";
}


// ─── JSON Schema Builder ──────────────────────────────────────────────────
function course_schema(array $t): string {
    $site = get_setting('site_name', 'Wahana Totalita Konsultan');
    $url  = SITE_URL . '/pelatihan/' . ($t['slug'] ?? '') . '/';
    $cleanTitle = clean_program_name($t['name'] ?? '') . ' ' . clean_cert($t['certification'] ?? 'BNSP');

    $schema = [
        '@context'   => 'https://schema.org',
        '@type'      => 'Course',
        'name'       => $cleanTitle,
        'description'=> strip_tags($t['description'] ?? ''),
        'url'        => $url,
        'provider'   => [
            '@type' => 'EducationalOrganization',
            '@id'   => SITE_URL . '/#organization',
            'name'  => $site,
            'url'   => SITE_URL,
        ],
        'educationalCredentialAwarded' => $t['certification'] ?? 'Sertifikasi BNSP',
        'courseMode' => ($t['mode'] ?? '') === 'both' ? ['online', 'onsite'] : (($t['mode'] ?? '') === 'online' ? 'online' : 'onsite'),
        'offers'     => [
            '@type'         => 'Offer',
            'category'      => 'Paid',
            'price'         => (string)(int)($t['price'] ?? 0),
            'priceCurrency' => 'IDR',
            'availability'  => 'https://schema.org/InStock',
            'url'           => $url,
        ],
    ];

    $instances = [];
    if (!empty($t['id'])) {
        try {
            $stmt = get_pdo()->prepare("SELECT id, batch_name, start_date, end_date, venue, mode, price 
                                        FROM training_batches 
                                        WHERE course_id = ? AND is_public = 1 AND status IN ('planned','ongoing') AND start_date >= CURDATE() 
                                        ORDER BY start_date ASC LIMIT 5");
            $stmt->execute([(int)$t['id']]);
            $batches = $stmt->fetchAll();
            foreach ($batches as $b) {
                $bMode = ($b['mode'] ?? '') === 'online' ? 'online' : (($b['mode'] ?? '') === 'both' ? ['online', 'onsite'] : 'onsite');
                $inst = [
                    '@type'          => 'CourseInstance',
                    'courseMode'     => $bMode,
                    'startDate'      => $b['start_date'],
                    'courseWorkload' => !empty($t['duration_days']) ? 'P' . (int)$t['duration_days'] . 'D' : 'P3D',
                ];
                if (!empty($b['end_date']) && $b['end_date'] !== '0000-00-00') {
                    $inst['endDate'] = $b['end_date'];
                }
                $venue = !empty($b['venue']) ? $b['venue'] : 'Training Center Wahana Totalita Yogyakarta & In-House';
                $inst['location'] = [
                    '@type'   => 'Place',
                    'name'    => $venue,
                    'address' => [
                        '@type'           => 'PostalAddress',
                        'addressLocality' => 'Yogyakarta',
                        'addressRegion'   => 'DI Yogyakarta',
                        'addressCountry'  => 'ID',
                    ],
                ];
                $bPrice = !empty($b['price']) ? (int)$b['price'] : (int)($t['price'] ?? 0);
                if ($bPrice > 0) {
                    $inst['offers'] = [
                        '@type'         => 'Offer',
                        'category'      => 'Paid',
                        'price'         => (string)$bPrice,
                        'priceCurrency' => 'IDR',
                        'availability'  => 'https://schema.org/InStock',
                        'url'           => $url,
                    ];
                }
                $instances[] = $inst;
            }
        } catch (Exception) {}
    }

    if (!empty($instances)) {
        $schema['hasCourseInstance'] = count($instances) === 1 ? $instances[0] : $instances;
    } else {
        $schema['hasCourseInstance'] = [
            '@type'          => 'CourseInstance',
            'courseMode'     => ($t['mode'] ?? '') === 'both' ? ['online', 'onsite'] : (($t['mode'] ?? '') === 'online' ? 'online' : 'onsite'),
            'courseWorkload' => !empty($t['duration_days']) ? 'P' . (int)$t['duration_days'] . 'D' : 'P3D',
            'location'       => [
                '@type'   => 'Place',
                'name'    => 'Training Center Wahana Totalita & In-House Perusahaan',
                'address' => [
                    '@type'           => 'PostalAddress',
                    'addressLocality' => 'Yogyakarta',
                    'addressRegion'   => 'DI Yogyakarta',
                    'addressCountry'  => 'ID',
                ],
            ],
        ];
    }
    if (!empty($t['duration_days'])) {
        $schema['timeRequired'] = 'P' . (int)$t['duration_days'] . 'D';
    }
    return json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
}

// ─── Theme Helpers ───────────────────────────────────────────────────────────
function _hex_clamp(int $v): int { return max(0, min(255, $v)); }

function hex_darken(string $hex, int $amt): string {
    $hex = ltrim($hex,'#');
    return sprintf('#%02x%02x%02x',
        _hex_clamp(hexdec(substr($hex,0,2)) - $amt),
        _hex_clamp(hexdec(substr($hex,2,2)) - $amt),
        _hex_clamp(hexdec(substr($hex,4,2)) - $amt)
    );
}
function hex_lighten(string $hex, int $amt): string {
    $hex = ltrim($hex,'#');
    return sprintf('#%02x%02x%02x',
        _hex_clamp(hexdec(substr($hex,0,2)) + $amt),
        _hex_clamp(hexdec(substr($hex,2,2)) + $amt),
        _hex_clamp(hexdec(substr($hex,4,2)) + $amt)
    );
}
function hex_to_rgb(string $hex): array {
    $hex = ltrim($hex,'#');
    return [hexdec(substr($hex,0,2)), hexdec(substr($hex,2,2)), hexdec(substr($hex,4,2))];
}
function is_valid_hex(string $v): bool {
    return (bool) preg_match('/^#[0-9A-Fa-f]{6}$/', $v);
}

const THEME_FONTS = [
    'Plus Jakarta Sans' => 'Plus+Jakarta+Sans:wght@400;500;600;700;800',
    'Poppins'           => 'Poppins:wght@400;500;600;700;800',
    'Nunito Sans'       => 'Nunito+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800',
    'DM Sans'           => 'DM+Sans:wght@400;500;600;700;800',
    'Outfit'            => 'Outfit:wght@400;500;600;700;800',
    'Inter'             => 'Inter:wght@400;500;600;700;800',
];

function asset_v(string $path): string {
    $doc_root = !empty($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : __DIR__;
    $local_path = rtrim($doc_root, '/\\') . '/' . ltrim($path, '/\\');
    if (file_exists($local_path)) {
        return $path . '?v=' . filemtime($local_path);
    }
    return $path;
}

function theme_font_url(array $s = []): string {
    return 'https://fonts.googleapis.com/css2?family=Lexend:wght@500;600;700;800&family=Source+Sans+3:ital,wght@0,400;0,500;0,600;1,400&display=swap';
}

function theme_css_vars(array $s): string {
    $prim   = is_valid_hex($s['theme_color_primary'] ?? '') ? $s['theme_color_primary'] : '#103A5C';
    $accent = is_valid_hex($s['theme_color_accent']  ?? '') ? $s['theme_color_accent']  : '#F06A25';
    $font   = array_key_exists($s['theme_font'] ?? '', THEME_FONTS)
              ? $s['theme_font'] : 'Plus Jakarta Sans';

    [$pr,$pg,$pb] = hex_to_rgb($prim);
    [$ar,$ag,$ab] = hex_to_rgb($accent);

    $prim_dark  = hex_darken($prim,  30);
    $prim_mid   = hex_lighten($prim, 18);
    $prim_light = hex_lighten($prim, 185);
    $acc_dark   = hex_darken($accent, 25);
    $acc_light  = hex_lighten($accent, 180);

    return "<style>
:root{
  --green:{$prim};--green-dark:{$prim_dark};--green-mid:{$prim_mid};
  --green-light:{$prim_light};
  --orange:{$accent};--orange-dark:{$acc_dark};--orange-light:{$acc_light};
}
</style>";
}

function theme_logo_html(array $s, string $cls = 'nav-logo-icon'): string {
    $logo = $s['logo_path'] ?? '';
    $text = $s['logo_text'] ?? 'WT';
    $name = e($s['site_name'] ?? 'Logo');
    if ($logo && file_exists($_SERVER['DOCUMENT_ROOT'] . $logo)) {
        return '<img src="' . e($logo) . '" alt="' . $name . '" class="nav-logo-img" width="44" height="44" decoding="async" style="height:44px;width:auto;display:block;border-radius:8px">';
    }
    return '<span class="' . $cls . '">' . e(strtoupper(substr($text, 0, 2))) . '</span>';
}
