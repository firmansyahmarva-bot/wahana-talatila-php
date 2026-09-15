<?php
/**
 * auth.php — Role-based permission middleware
 * Include at top of every admin page
 */

// ─── Permission Matrix ────────────────────────────────────────────────────
const PERMISSIONS = [
    'dashboard'         => ['superadmin','website','certification','accounting','viewer'],
    'website'           => ['superadmin','website'],
    'programs'          => ['superadmin','website'],
    'clients'           => ['superadmin','certification'],
    'companies'         => ['superadmin','certification'],
    'certifications'    => ['superadmin','certification'],
    'leads'             => ['superadmin','certification'],
    'calendar'          => ['superadmin','website','certification','accounting','viewer'],
    'batches'           => ['superadmin','certification'],
    'instructors'       => ['superadmin','certification'],
    'accounts'          => ['superadmin','accounting'],
    'invoices'          => ['superadmin','accounting'],
    'payments'          => ['superadmin','accounting'],
    'expenses'          => ['superadmin','accounting'],
    'targets'           => ['superadmin','accounting'],
    'whatsapp'          => ['superadmin','certification'],
    'reports'           => ['superadmin','certification','accounting'],
    'users'             => ['superadmin'],
    'settings'          => ['superadmin','website'],
    'articles'          => ['superadmin','website'],
    // ── Platform K3 ───────────────────────────────────────────────────────
    'resources_admin'   => ['superadmin','website'],
    'registrations'     => ['superadmin','certification'],
    'forum_mod'         => ['superadmin','website'],
    'newsletter_admin'  => ['superadmin','website','certification'],
    'incidents_admin'   => ['superadmin','website'],
    'workplace_admin'   => ['superadmin','certification'],
    'social_queue'      => ['superadmin','website'],
    'ai_leads'          => ['superadmin','certification'],
];

// ─── Role labels & colors ─────────────────────────────────────────────────
const ROLE_LABELS = [
    'superadmin'    => ['label' => 'Super Admin',    'color' => '#dc2626'],
    'website'       => ['label' => 'Website Admin',  'color' => '#2563eb'],
    'certification' => ['label' => 'Sertifikasi',    'color' => '#0A4A2E'],
    'accounting'    => ['label' => 'Keuangan',       'color' => '#d97706'],
    'viewer'        => ['label' => 'View Only',      'color' => '#6b7280'],
];

// ─── Check if current user can access a section ──────────────────────────
function can(string $section): bool {
    $role = $_SESSION['admin_role'] ?? 'viewer';
    return in_array($role, PERMISSIONS[$section] ?? []);
}

// ─── Require login + optionally a section ────────────────────────────────
function require_auth(string $section = 'dashboard'): void {
    if (empty($_SESSION['admin_id'])) {
        redirect(SITE_URL . '/admin/login.php');
    }
    // Inactivity timeout — destroy the session after SESSION_LIFETIME seconds idle
    if (!empty($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > SESSION_LIFETIME) {
        $_SESSION = [];
        session_destroy();
        redirect(SITE_URL . '/admin/login.php?timeout=1');
    }
    $_SESSION['last_activity'] = time();
    // Periodic session-id regeneration (anti session-fixation)
    if (empty($_SESSION['last_regen']) || (time() - $_SESSION['last_regen']) > 300) {
        session_regenerate_id(true);
        $_SESSION['last_regen'] = time();
    }
    // Role check
    if (!can($section)) {
        http_response_code(403);
        die('
        <!DOCTYPE html><html lang="id"><head><meta charset="UTF-8">
        <title>Akses Ditolak</title>
        <style>body{font-family:system-ui;display:flex;align-items:center;justify-content:center;min-height:100vh;background:#f0f4f8;margin:0}
        .box{background:#fff;border-radius:12px;padding:40px;text-align:center;box-shadow:0 4px 20px rgba(0,0,0,.1);max-width:380px}
        h2{color:#dc2626;margin-bottom:8px}p{color:#666;margin-bottom:20px}
        a{background:#0A4A2E;color:#fff;padding:10px 24px;border-radius:8px;text-decoration:none;font-weight:600}
        </style></head><body>
        <div class="box">
          <h2>🔒 Akses Ditolak</h2>
          <p>Anda tidak memiliki izin untuk mengakses halaman ini.</p>
          <a href="/admin/">← Kembali ke Dashboard</a>
        </div></body></html>');
    }
}

// ─── Get current user role ────────────────────────────────────────────────
function current_role(): string {
    return $_SESSION['admin_role'] ?? 'viewer';
}

function current_user_id(): int {
    return (int)($_SESSION['admin_id'] ?? 0);
}

function is_superadmin(): bool {
    return current_role() === 'superadmin';
}

// ─── Notification count for sidebar badge ────────────────────────────────
function get_notification_count(): int {
    try {
        $role = current_role();
        $stmt = get_pdo()->prepare(
            "SELECT COUNT(*) FROM notifications 
             WHERE is_read = 0 AND FIND_IN_SET(?, for_roles)"
        );
        $stmt->execute([$role]);
        return (int)$stmt->fetchColumn();
    } catch (Exception) { return 0; }
}

// ─── Quick stats for dashboard ────────────────────────────────────────────
function get_dashboard_stats(): array {
    try {
        $pdo = get_pdo();
        $stats = [];

        // Certifications
        $stats['total_clients']   = (int)$pdo->query("SELECT COUNT(*) FROM clients WHERE is_active=1")->fetchColumn();
        $stats['active_certs']    = (int)$pdo->query("SELECT COUNT(*) FROM certifications WHERE expiry_date > DATE_ADD(NOW(), INTERVAL 30 DAY)")->fetchColumn();
        $stats['expiring_soon']   = (int)$pdo->query("SELECT COUNT(*) FROM certifications WHERE expiry_date BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 30 DAY)")->fetchColumn();
        $stats['expired_certs']   = (int)$pdo->query("SELECT COUNT(*) FROM certifications WHERE expiry_date < NOW()")->fetchColumn();

        // Financial
        $stats['total_revenue']   = (float)$pdo->query("SELECT COALESCE(SUM(amount),0) FROM payments WHERE MONTH(payment_date)=MONTH(NOW()) AND YEAR(payment_date)=YEAR(NOW())")->fetchColumn();
        $stats['unpaid_invoices'] = (int)$pdo->query("SELECT COUNT(*) FROM invoices WHERE status IN ('sent','partial','overdue')")->fetchColumn();
        $stats['unpaid_amount']   = (float)$pdo->query("SELECT COALESCE(SUM(total_amount-paid_amount),0) FROM invoices WHERE status IN ('sent','partial','overdue')")->fetchColumn();

        // Leads
        $stats['new_leads']       = (int)$pdo->query("SELECT COUNT(*) FROM leads WHERE status='new'")->fetchColumn();

        // This month target
        $target = $pdo->query("SELECT revenue_target FROM targets WHERE year=YEAR(NOW()) AND month=MONTH(NOW()) LIMIT 1")->fetch();
        $stats['revenue_target']  = $target ? (float)$target['revenue_target'] : 0;
        $stats['revenue_progress'] = $stats['revenue_target'] > 0
            ? min(100, round(($stats['total_revenue'] / $stats['revenue_target']) * 100))
            : 0;

        return $stats;
    } catch (Exception) { return []; }
}
