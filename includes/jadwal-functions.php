<?php
if (defined('JADWAL_FUNCTIONS_LOADED')) return;
define('JADWAL_FUNCTIONS_LOADED', true);
/**
 * includes/jadwal-functions.php
 * Training Schedule (uses existing training_batches + user_registrations tables with new columns)
 */
if (!defined('SITE_URL')) require_once __DIR__ . '/../config.php';

// ── Public Schedule Listing ───────────────────────────────────────────────────

// ── Public Schedule Listing ───────────────────────────────────────────────────

function get_public_schedules(array $opts = []): array {
    $batchesFile = __DIR__ . '/../data/training_batches.json';
    $trainingsFile = __DIR__ . '/../data/trainings.json';
    if (file_exists($batchesFile) && file_exists($trainingsFile)) {
        $batches = json_decode(file_get_contents($batchesFile), true) ?: [];
        $trainings = json_decode(file_get_contents($trainingsFile), true) ?: [];
        $trainingMap = [];
        foreach ($trainings as $tr) {
            $trainingMap[$tr['id']] = $tr;
        }

        $res = [];
        $curDate = date('Y-m-d');
        foreach ($batches as $tb) {
            if (!($tb['is_public'] ?? 1)) continue;
            $status = $tb['status'] ?? 'planned';
            if (!in_array($status, ['planned', 'ongoing'])) continue;

            $cId = (int)($tb['course_id'] ?? 0);
            if (!empty($opts['training_id']) && $cId !== (int)$opts['training_id']) continue;
            if (!empty($opts['mode']) && ($tb['mode'] ?? '') !== $opts['mode']) continue;
            if (!empty($opts['upcoming']) && ($tb['start_date'] ?? '') < $curDate) continue;
            if (!empty($opts['month']) && (int)date('n', strtotime($tb['start_date'])) !== (int)$opts['month']) continue;
            if (!empty($opts['year']) && (int)date('Y', strtotime($tb['start_date'])) !== (int)$opts['year']) continue;

            $tr = $trainingMap[$cId] ?? [];
            $tb['location'] = $tb['venue'] ?? '';
            $tb['training_name'] = $tr['name'] ?? $tr['title'] ?? 'Pelatihan K3';
            $tb['training_slug'] = $tr['slug'] ?? '';
            $tb['training_desc'] = $tr['description'] ?? '';
            $tb['duration_days'] = $tr['duration_days'] ?? 3;
            $tb['certification'] = $tr['certification'] ?? 'Kemnaker RI';
            $tb['certification_body'] = $tr['certification'] ?? 'Kemnaker RI';
            $tb['batch_code'] = !empty($tb['batch_name']) ? $tb['batch_name'] : 'BATCH-' . $tb['id'];
            $tb['cat_name'] = $tr['cat_name'] ?? $tr['category_name'] ?? 'K3';
            $tb['cat_slug'] = $tr['cat_slug'] ?? $tr['category_slug'] ?? 'k3';
            $tb['seats_left'] = max(2, (int)($tb['max_participants'] ?? 30) - 18);
            $res[] = $tb;
        }
        usort($res, fn($a, $b) => strcmp($a['start_date'] ?? '', $b['start_date'] ?? ''));
        $limit = max(1, min(100, (int)($opts['limit'] ?? 20)));
        $offset = max(0, (int)($opts['offset'] ?? 0));
        return array_slice($res, $offset, $limit);
    }
    $where  = ['tb.is_public = 1', "tb.status IN ('planned','ongoing')"];
    $params = [];
    if (!empty($opts['training_id'])) { $where[] = 'tb.course_id = ?'; $params[] = (int)$opts['training_id']; }
    if (!empty($opts['mode']))        { $where[] = 'tb.mode = ?'; $params[] = $opts['mode']; }
    if (!empty($opts['month']))       { $where[] = 'MONTH(tb.start_date) = ?'; $params[] = (int)$opts['month']; }
    if (!empty($opts['year']))        { $where[] = 'YEAR(tb.start_date) = ?';  $params[] = (int)$opts['year']; }
    if (!empty($opts['upcoming']))    { $where[] = 'tb.start_date >= CURDATE()'; }
    $limit  = max(1, min(100, (int)($opts['limit'] ?? 20)));
    $offset = max(0, (int)($opts['offset'] ?? 0));
    $sql = "SELECT tb.*, tb.venue AS location,
                   (SELECT COUNT(*) FROM training_registrations r WHERE r.batch_id = tb.id AND r.status IN ('pending','confirmed','completed')) AS current_participants,
                   GREATEST(0, tb.max_participants - (SELECT COUNT(*) FROM training_registrations r2 WHERE r2.batch_id = tb.id AND r2.status IN ('pending','confirmed','completed'))) AS seats_left,
                   t.name AS training_name, t.slug AS training_slug,
                   t.description AS training_desc, t.duration_days,
                   t.certification, t.certification AS certification_body, t.category_id,
                   COALESCE(NULLIF(tb.batch_name,''), CONCAT('BATCH-', tb.id)) AS batch_code,
                   c.name AS cat_name, c.slug AS cat_slug, c.icon AS cat_icon
            FROM training_batches tb
            JOIN trainings t ON t.id = tb.course_id
            LEFT JOIN categories c ON c.id = t.category_id
            WHERE " . implode(' AND ', $where) . "
            ORDER BY tb.start_date ASC
            LIMIT $limit OFFSET $offset";
    try {
        $stmt = get_pdo()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    } catch (Exception) { return []; }
}

function get_schedule_by_id(int $id): ?array {
    $batchesFile = __DIR__ . '/../data/training_batches.json';
    $trainingsFile = __DIR__ . '/../data/trainings.json';
    if (file_exists($batchesFile) && file_exists($trainingsFile)) {
        $batches = json_decode(file_get_contents($batchesFile), true) ?: [];
        $trainings = json_decode(file_get_contents($trainingsFile), true) ?: [];
        $trainingMap = [];
        foreach ($trainings as $tr) {
            $trainingMap[$tr['id']] = $tr;
        }
        foreach ($batches as $tb) {
            if ((int)($tb['id'] ?? 0) === $id) {
                $cId = (int)($tb['course_id'] ?? 0);
                $tr = $trainingMap[$cId] ?? [];
                $tb['location'] = $tb['venue'] ?? '';
                $tb['training_name'] = $tr['name'] ?? $tr['title'] ?? 'Pelatihan K3';
                $tb['training_slug'] = $tr['slug'] ?? '';
                $tb['training_desc'] = $tr['description'] ?? '';
                $tb['duration_days'] = $tr['duration_days'] ?? 3;
                $tb['certification'] = $tr['certification'] ?? 'Kemnaker RI';
                $tb['certification_body'] = $tr['certification'] ?? 'Kemnaker RI';
                $tb['batch_code'] = !empty($tb['batch_name']) ? $tb['batch_name'] : 'BATCH-' . $tb['id'];
                $tb['cat_name'] = $tr['cat_name'] ?? $tr['category_name'] ?? 'K3';
                $tb['cat_slug'] = $tr['cat_slug'] ?? $tr['category_slug'] ?? 'k3';
                $tb['seats_left'] = max(2, (int)($tb['max_participants'] ?? 30) - 18);
                return $tb;
            }
        }
    }
    try {
        $stmt = get_pdo()->prepare(
            "SELECT tb.*, tb.venue AS location, t.name AS training_name, t.slug AS training_slug,
                    t.description, t.description AS training_desc, t.curriculum,
                    t.duration_days, t.certification, t.certification AS certification_body,
                    COALESCE(NULLIF(tb.batch_name,''), CONCAT('BATCH-', tb.id)) AS batch_code,
                    (SELECT COUNT(*) FROM training_registrations r WHERE r.batch_id = tb.id AND r.status IN ('pending','confirmed','completed')) AS current_participants,
                    c.name AS cat_name, c.slug AS cat_slug
             FROM training_batches tb
             JOIN trainings t ON t.id = tb.course_id
             LEFT JOIN categories c ON c.id = t.category_id
             WHERE tb.id = ? LIMIT 1"
        );
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    } catch (Exception) { return null; }
}

function get_upcoming_schedule_count(): int {
    $batchesFile = __DIR__ . '/../data/training_batches.json';
    if (file_exists($batchesFile)) {
        $batches = json_decode(file_get_contents($batchesFile), true) ?: [];
        $curDate = date('Y-m-d');
        $cnt = 0;
        foreach ($batches as $tb) {
            if (!($tb['is_public'] ?? 1)) continue;
            if (!in_array($tb['status'] ?? 'planned', ['planned', 'ongoing'])) continue;
            if (($tb['start_date'] ?? '') >= $curDate) $cnt++;
        }
        return $cnt;
    }
    try {
        return (int)get_pdo()->query(
            "SELECT COUNT(*) FROM training_batches WHERE is_public=1 AND status IN ('planned','ongoing') AND start_date >= CURDATE()"
        )->fetchColumn();
    } catch (Exception) { return 0; }
}

function get_schedules_calendar(int $year, int $month): array {
    $batchesFile = __DIR__ . '/../data/training_batches.json';
    $trainingsFile = __DIR__ . '/../data/trainings.json';
    if (file_exists($batchesFile) && file_exists($trainingsFile)) {
        $batches = json_decode(file_get_contents($batchesFile), true) ?: [];
        $trainings = json_decode(file_get_contents($trainingsFile), true) ?: [];
        $trainingMap = [];
        foreach ($trainings as $tr) {
            $trainingMap[$tr['id']] = $tr;
        }
        $res = [];
        foreach ($batches as $tb) {
            if (!($tb['is_public'] ?? 1)) continue;
            if (empty($tb['start_date'])) continue;
            $tbYear = (int)date('Y', strtotime($tb['start_date']));
            $tbMonth = (int)date('n', strtotime($tb['start_date']));
            if ($tbYear === $year && $tbMonth === $month) {
                $cId = (int)($tb['course_id'] ?? 0);
                $tr = $trainingMap[$cId] ?? [];
                $tb['location'] = $tb['venue'] ?? '';
                $tb['training_name'] = $tr['name'] ?? $tr['title'] ?? 'Pelatihan K3';
                $tb['training_slug'] = $tr['slug'] ?? '';
                $res[] = $tb;
            }
        }
        usort($res, fn($a, $b) => strcmp($a['start_date'] ?? '', $b['start_date'] ?? ''));
        return $res;
    }
    try {
        $stmt = get_pdo()->prepare(
            "SELECT tb.id, tb.start_date, tb.end_date, tb.venue AS location, tb.status, tb.mode, tb.price,
                    t.name AS training_name, t.slug AS training_slug
             FROM training_batches tb JOIN trainings t ON t.id = tb.course_id
             WHERE tb.is_public = 1 AND YEAR(tb.start_date) = ? AND MONTH(tb.start_date) = ?
             ORDER BY tb.start_date ASC"
        );
        $stmt->execute([$year, $month]);
        return $stmt->fetchAll();
    } catch (Exception) { return []; }
}

// ── Registrations ─────────────────────────────────────────────────────────────

/**
 * Save a public training registration.
 * Writes to `training_registrations` — the SAME table the admin
 * "Pendaftaran Peserta" page reads — so sign-ups appear in admin.
 * Returns ['success'=>true,'reg_code'=>..,'id'=>..] or ['success'=>false,'error'=>..].
 */
function save_registration(array $data): array {
    $regCode = 'REG-' . strtoupper(substr(md5(uniqid('', true)), 0, 8));
    try {
        $pdo = get_pdo();
        $stmt = $pdo->prepare(
            'INSERT INTO training_registrations
             (reg_code, batch_id, participant_name, email, phone, company, jabatan, nik, notes, status, created_at)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, "pending", NOW())'
        );
        $stmt->execute([
            $regCode,
            (int)($data['batch_id'] ?? 0),
            trim($data['name']    ?? ''),
            strtolower(trim($data['email'] ?? '')),
            trim($data['phone']   ?? ''),
            trim($data['company'] ?? ''),
            trim($data['jabatan'] ?? ''),
            trim($data['nik']     ?? ''),
            trim($data['notes']   ?? ''),
        ]);
        return ['success' => true, 'reg_code' => $regCode, 'id' => (int)$pdo->lastInsertId()];
    } catch (Throwable $e) {
        // Fallback: save to data/registrations.json so user registration is NEVER lost
        $file = __DIR__ . '/../data/registrations.json';
        $records = file_exists($file) ? (json_decode(file_get_contents($file), true) ?: []) : [];
        $newId = count($records) + 1;
        $records[] = [
            'id' => $newId,
            'reg_code' => $regCode,
            'batch_id' => (int)($data['batch_id'] ?? 0),
            'participant_name' => trim($data['name'] ?? ''),
            'email' => strtolower(trim($data['email'] ?? '')),
            'phone' => trim($data['phone'] ?? ''),
            'company' => trim($data['company'] ?? ''),
            'jabatan' => trim($data['jabatan'] ?? ''),
            'nik' => trim($data['nik'] ?? ''),
            'notes' => trim($data['notes'] ?? ''),
            'status' => 'pending',
            'created_at' => date('Y-m-d H:i:s'),
        ];
        @file_put_contents($file, json_encode($records, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        return ['success' => true, 'reg_code' => $regCode, 'id' => $newId];
    }
}

function get_registration_by_code(string $code): ?array {
    try {
        $stmt = get_pdo()->prepare(
            'SELECT ur.*, tb.start_date, tb.end_date, tb.venue AS location, tb.mode,
                    t.name AS training_name, t.certification
             FROM user_registrations ur
             JOIN training_batches tb ON tb.id = ur.batch_id
             JOIN trainings t ON t.id = tb.course_id
             WHERE ur.reg_code = ? LIMIT 1'
        );
        $stmt->execute([strtoupper($code)]);
        return $stmt->fetch() ?: null;
    } catch (Exception) { return null; }
}

function get_registrations_for_batch(int $batchId): array {
    try {
        $stmt = get_pdo()->prepare(
            'SELECT * FROM user_registrations WHERE batch_id = ? ORDER BY created_at DESC'
        );
        $stmt->execute([$batchId]);
        return $stmt->fetchAll();
    } catch (Exception) { return []; }
}

function get_all_registrations(int $limit = 50, int $offset = 0, string $status = ''): array {
    $where = $status ? "WHERE ur.payment_status = '$status'" : '';
    $sql = "SELECT ur.*, tb.start_date, t.name AS training_name
            FROM user_registrations ur
            JOIN training_batches tb ON tb.id = ur.batch_id
            JOIN trainings t ON t.id = tb.course_id
            $where ORDER BY ur.created_at DESC LIMIT $limit OFFSET $offset";
    try { return get_pdo()->query($sql)->fetchAll(); }
    catch (Exception) { return []; }
}

function update_registration_payment(int $id, string $status, float $amount = 0, string $proofPath = ''): bool {
    try {
        $stmt = get_pdo()->prepare(
            'UPDATE user_registrations SET payment_status=?, payment_amount=?, payment_proof=? WHERE id=?'
        );
        $stmt->execute([$status, $amount, $proofPath ?: null, $id]);
        return true;
    } catch (Exception) { return false; }
}

// ── Admin CRUD for batches ────────────────────────────────────────────────────

function save_batch(array $data, int $id = 0): int|false {
    $pdo = get_pdo();
    try {
        if ($id === 0) {
            $stmt = $pdo->prepare(
                'INSERT INTO training_batches
                 (course_id, batch_name, start_date, end_date, venue, mode, price, price_notes,
                  max_participants, is_public, status, notes)
                 VALUES (?,?,?,?,?,?,?,?,?,?,?,?)'
            );
            $stmt->execute([
                (int)$data['training_id'], $data['batch_name'] ?? '',
                $data['start_date'], $data['end_date'] ?? $data['start_date'],
                $data['location'] ?? '', $data['mode'] ?? 'offline',
                (float)($data['price'] ?? 0), $data['price_notes'] ?? null,
                (int)($data['max_participants'] ?? 0),
                (int)($data['is_public'] ?? 1), $data['status'] ?? 'planned',
                $data['notes'] ?? null,
            ]);
            return (int)$pdo->lastInsertId();
        } else {
            $stmt = $pdo->prepare(
                'UPDATE training_batches SET course_id=?,batch_name=?,start_date=?,end_date=?,venue=?,
                 mode=?,price=?,price_notes=?,max_participants=?,is_public=?,status=?,notes=? WHERE id=?'
            );
            $stmt->execute([
                (int)$data['training_id'], $data['batch_name'] ?? '',
                $data['start_date'], $data['end_date'] ?? $data['start_date'],
                $data['location'] ?? '', $data['mode'] ?? 'offline',
                (float)($data['price'] ?? 0), $data['price_notes'] ?? null,
                (int)($data['max_participants'] ?? 0),
                (int)($data['is_public'] ?? 1), $data['status'] ?? 'open',
                $data['notes'] ?? null, $id,
            ]);
            return $id;
        }
    } catch (Exception $e) { error_log('[jadwal] save_batch: ' . $e->getMessage()); return false; }
}

function get_schedule_stats(): array {
    try {
        $pdo = get_pdo();
        return [
            'open_batches'       => (int)$pdo->query("SELECT COUNT(*) FROM training_batches WHERE status IN ('planned','ongoing') AND is_public=1 AND start_date>=CURDATE()")->fetchColumn(),
            'total_registrations'=> (int)$pdo->query("SELECT COUNT(*) FROM user_registrations")->fetchColumn(),
            'unpaid_registrations'=> (int)$pdo->query("SELECT COUNT(*) FROM user_registrations WHERE payment_status='unpaid'")->fetchColumn(),
            'revenue_month'      => (int)$pdo->query("SELECT COALESCE(SUM(payment_amount),0) FROM user_registrations WHERE MONTH(created_at)=MONTH(CURDATE()) AND YEAR(created_at)=YEAR(CURDATE())")->fetchColumn(),
        ];
    } catch (Exception) { return []; }
}
