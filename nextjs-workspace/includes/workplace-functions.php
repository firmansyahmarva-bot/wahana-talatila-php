<?php
/**
 * Workplace K3 — auth + data functions.
 * Replaces the broken original (signature mismatches between login.php
 * and wp_login/wp_set_session/wp_require_login made login unusable).
 * No role system — per platform brief, roles are deferred until v1 has
 * real users. Single account = single login = full access to own data.
 */

function wp_login(string $email, string $password): ?array {
    try {
        $stmt = get_pdo()->prepare('SELECT * FROM workplace_accounts WHERE email = ? LIMIT 1');
        $stmt->execute([strtolower(trim($email))]);
        $acc = $stmt->fetch();
        if (!$acc || !password_verify($password, $acc['password_hash'])) return null;
        return $acc;
    } catch (Exception) { return null; }
}

function wp_register(array $data): array {
    $pdo = get_pdo();
    $email = strtolower(trim($data['email'] ?? ''));

    $chk = $pdo->prepare('SELECT id FROM workplace_accounts WHERE email = ?');
    $chk->execute([$email]);
    if ($chk->fetch()) return ['success' => false, 'error' => 'Email ini sudah terdaftar. Silakan login.'];

    try {
        $stmt = $pdo->prepare(
            'INSERT INTO workplace_accounts (company_name, contact_name, email, password_hash) VALUES (?, ?, ?, ?)'
        );
        $stmt->execute([
            trim($data['company_name'] ?? ''),
            trim($data['contact_name'] ?? ''),
            $email,
            password_hash($data['password'], PASSWORD_DEFAULT),
        ]);
        $id = (int)$pdo->lastInsertId();
        wp_log($id, 'account_created', trim($data['company_name'] ?? ''));
        return ['success' => true, 'id' => $id];
    } catch (Exception $e) {
        return ['success' => false, 'error' => 'Gagal mendaftar. Coba lagi.'];
    }
}

function wp_set_session(array $account): void {
    $_SESSION['wp_account_id']   = $account['id'];
    $_SESSION['wp_company_name'] = $account['company_name'];
}

function wp_get_session(): ?array {
    if (empty($_SESSION['wp_account_id'])) return null;
    return [
        'account_id'   => (int)$_SESSION['wp_account_id'],
        'company_name' => $_SESSION['wp_company_name'] ?? '',
    ];
}

function wp_require_login(): array {
    $session = wp_get_session();
    if (!$session) redirect(SITE_URL . '/workplace/login/');
    return $session;
}

function wp_logout(): void {
    unset($_SESSION['wp_account_id'], $_SESSION['wp_company_name']);
}

function wp_log(int $accountId, string $action, string $detail = ''): void {
    try {
        get_pdo()->prepare('INSERT INTO workplace_activity_log (account_id, action, detail) VALUES (?, ?, ?)')
                 ->execute([$accountId, $action, $detail]);
    } catch (Exception) {}
}

// Returns 'valid' | 'expiring' | 'expired' based on days until expiry.
function wp_cert_status(string $expiry_date): string {
    $days = (strtotime($expiry_date) - strtotime(date('Y-m-d'))) / 86400;
    if ($days < 0) return 'expired';
    if ($days <= 30) return 'expiring';
    return 'valid';
}

function wp_get_employees(int $accountId): array {
    try {
        $stmt = get_pdo()->prepare('SELECT * FROM workplace_employees WHERE account_id = ? ORDER BY expiry_date ASC');
        $stmt->execute([$accountId]);
        return $stmt->fetchAll();
    } catch (Exception) { return []; }
}

function wp_add_employee(int $accountId, array $data): bool {
    try {
        get_pdo()->prepare(
            'INSERT INTO workplace_employees (account_id, full_name, position, cert_type, cert_number, expiry_date)
             VALUES (?, ?, ?, ?, ?, ?)'
        )->execute([
            $accountId,
            trim($data['full_name']),
            trim($data['position'] ?? ''),
            trim($data['cert_type']),
            trim($data['cert_number'] ?? ''),
            $data['expiry_date'],
        ]);
        wp_log($accountId, 'employee_added', trim($data['full_name']));
        return true;
    } catch (Exception) { return false; }
}

function wp_delete_employee(int $accountId, int $employeeId): bool {
    try {
        $stmt = get_pdo()->prepare('SELECT full_name FROM workplace_employees WHERE id=? AND account_id=?');
        $stmt->execute([$employeeId, $accountId]);
        $name = $stmt->fetchColumn();
        if (!$name) return false;
        get_pdo()->prepare('DELETE FROM workplace_employees WHERE id=? AND account_id=?')->execute([$employeeId, $accountId]);
        wp_log($accountId, 'employee_deleted', $name);
        return true;
    } catch (Exception) { return false; }
}

// K3 Score + stat counts for the dashboard, computed live from real data.
function wp_dashboard_data(int $accountId): array {
    $employees = wp_get_employees($accountId);
    $total = count($employees);
    $valid = $expiring = $expired = 0;
    foreach ($employees as $e) {
        match (wp_cert_status($e['expiry_date'])) {
            'valid'    => $valid++,
            'expiring' => $expiring++,
            'expired'  => $expired++,
        };
    }
    return [
        'employees' => $employees,
        'total'     => $total,
        'valid'     => $valid,
        'expiring'  => $expiring,
        'expired'   => $expired,
        'k3_score'  => $total > 0 ? (int)round(($valid / $total) * 100) : 0,
    ];
}
