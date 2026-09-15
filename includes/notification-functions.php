<?php
if (defined('NOTIFICATION_FUNCTIONS_LOADED')) return;
define('NOTIFICATION_FUNCTIONS_LOADED', true);
/**
 * includes/notification-functions.php
 * Staff Reminders, Tasks, Email, WhatsApp notifications.
 */
if (!defined('SITE_URL')) require_once __DIR__ . '/../config.php';

// ── Staff Tasks / Reminders ───────────────────────────────────────────────────

function get_staff_tasks(int $userId = 0, string $role = '', string $status = 'pending'): array {
    $where  = ['st.status != "dismissed"'];
    $params = [];
    if ($status) { $where[] = 'st.status = ?'; $params[] = $status; }
    if ($userId) { $where[] = '(st.assigned_to = ? OR st.assigned_to IS NULL)'; $params[] = $userId; }
    if ($role)   { $where[] = '(st.role_target = ? OR st.role_target IS NULL)';  $params[] = $role; }
    $sql = 'SELECT * FROM staff_tasks st WHERE ' . implode(' AND ', $where) . ' ORDER BY st.priority DESC, st.due_date ASC LIMIT 50';
    try {
        $stmt = get_pdo()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    } catch (Exception) { return []; }
}

function create_staff_task(array $data): int|false {
    try {
        $stmt = get_pdo()->prepare(
            'INSERT INTO staff_tasks (assigned_to, role_target, title, description, priority, status, action_url, due_date, created_by, is_auto)
             VALUES (?, ?, ?, ?, ?, "pending", ?, ?, ?, ?)'
        );
        $stmt->execute([
            $data['assigned_to'] ?? null,
            $data['role_target'] ?? null,
            $data['title'],
            $data['description'] ?? null,
            $data['priority'] ?? 'normal',
            $data['action_url'] ?? null,
            $data['due_date'] ?? null,
            $data['created_by'] ?? null,
            (int)($data['is_auto'] ?? 0),
        ]);
        return (int)get_pdo()->lastInsertId();
    } catch (Exception $e) { error_log('[tasks] create: ' . $e->getMessage()); return false; }
}

function update_task_status(int $id, string $status): bool {
    try {
        get_pdo()->prepare('UPDATE staff_tasks SET status = ?, updated_at = NOW() WHERE id = ?')->execute([$status, $id]);
        return true;
    } catch (Exception) { return false; }
}

function get_task_count_by_role(string $role): int {
    try {
        $stmt = get_pdo()->prepare("SELECT COUNT(*) FROM staff_tasks WHERE role_target = ? AND status = 'pending'");
        $stmt->execute([$role]);
        return (int)$stmt->fetchColumn();
    } catch (Exception) { return 0; }
}

/**
 * Auto-generate role-specific reminders. Called daily by cron.
 */
function generate_auto_reminders(): int {
    $pdo   = get_pdo();
    $count = 0;

    try {
        // Dismiss old auto tasks
        $pdo->query("UPDATE staff_tasks SET status='dismissed' WHERE is_auto=1 AND created_at < DATE_SUB(NOW(), INTERVAL 24 HOUR) AND status='pending'");

        // ── MANAGER: overdue tasks ──
        $overdueCerts = (int)$pdo->query("SELECT COUNT(*) FROM certifications WHERE expiry_date < CURDATE()")->fetchColumn();
        if ($overdueCerts > 0) {
            create_staff_task(['role_target'=>'manager','title'=>"$overdueCerts sertifikasi peserta sudah expired",'description'=>'Cek halaman sertifikasi dan hubungi peserta untuk renewal.','priority'=>'high','action_url'=>'/admin/certifications.php','is_auto'=>1,'due_date'=>date('Y-m-d')]);
            $count++;
        }
        $unpaidReg = (int)$pdo->query("SELECT COUNT(*) FROM user_registrations WHERE payment_status='unpaid' AND created_at > DATE_SUB(NOW(), INTERVAL 7 DAY)")->fetchColumn();
        if ($unpaidReg > 0) {
            create_staff_task(['role_target'=>'manager','title'=>"$unpaidReg pendaftaran belum bayar (7 hari terakhir)",'priority'=>'high','action_url'=>'/admin/registrations.php','is_auto'=>1,'due_date'=>date('Y-m-d')]);
            $count++;
        }

        // ── ACCOUNTANT: unpaid invoices ──
        try {
            $unpaidInv = (int)$pdo->query("SELECT COUNT(*) FROM invoices WHERE status='unpaid' AND due_date <= DATE_ADD(CURDATE(), INTERVAL 7 DAY)")->fetchColumn();
            if ($unpaidInv > 0) {
                create_staff_task(['role_target'=>'accountant','title'=>"$unpaidInv invoice jatuh tempo dalam 7 hari",'priority'=>'high','action_url'=>'/admin/invoices.php','is_auto'=>1,'due_date'=>date('Y-m-d')]);
                $count++;
            }
        } catch (Exception) {}

        // ── MARKETING: new leads today ──
        try {
            $newLeads = (int)$pdo->query("SELECT COUNT(*) FROM leads WHERE created_at >= CURDATE() - INTERVAL 1 DAY")->fetchColumn();
            if ($newLeads > 0) {
                create_staff_task(['role_target'=>'marketing','title'=>"$newLeads leads baru masuk hari ini",'description'=>'Segera follow up leads baru untuk closing lebih cepat.','priority'=>'high','action_url'=>'/admin/leads.php','is_auto'=>1]);
                $count++;
            }
            $resourceLeads = (int)$pdo->query("SELECT COUNT(*) FROM resource_leads WHERE DATE(downloaded_at)=CURDATE()")->fetchColumn();
            if ($resourceLeads > 0) {
                create_staff_task(['role_target'=>'marketing','title'=>"$resourceLeads leads dari download resource hari ini",'description'=>'Leads yang download materi K3 — potensial tinggi untuk follow up.','priority'=>'normal','action_url'=>'/admin/resources.php?tab=leads','is_auto'=>1]);
                $count++;
            }
        } catch (Exception) {}

        // ── SOCIAL MEDIA: content to post ──
        try {
            $readyContent = (int)$pdo->query("SELECT COUNT(*) FROM social_content WHERE status='ready'")->fetchColumn();
            if ($readyContent > 0) {
                create_staff_task(['role_target'=>'social_media','title'=>"$readyContent konten siap diposting",'description'=>'Download dan post ke Instagram, Facebook, TikTok.','action_url'=>'/admin/social-media.php','is_auto'=>1]);
                $count++;
            }
        } catch (Exception) {}

        // ── TRAINER: upcoming batches ──
        $upcomingBatch = (int)$pdo->query("SELECT COUNT(*) FROM training_batches WHERE start_date = DATE_ADD(CURDATE(), INTERVAL 3 DAY) AND status='open'")->fetchColumn();
        if ($upcomingBatch > 0) {
            create_staff_task(['role_target'=>'trainer','title'=>"$upcomingBatch pelatihan dimulai dalam 3 hari",'description'=>'Pastikan materi, absensi, dan sertifikat sudah siap.','priority'=>'high','action_url'=>'/admin/batches.php','is_auto'=>1]);
            $count++;
        }

        // ── ADMIN/SECRETARY: pending forum topics ──
        $pendingForum = (int)$pdo->query("SELECT COUNT(*) FROM forum_topics WHERE is_approved=0 AND is_active=1")->fetchColumn();
        if ($pendingForum > 0) {
            create_staff_task(['role_target'=>'admin_staff','title'=>"$pendingForum topik forum menunggu persetujuan",'action_url'=>'/admin/forum.php?filter=pending','is_auto'=>1]);
            $count++;
        }

    } catch (Exception $e) {
        error_log('[reminders] auto: ' . $e->getMessage());
    }
    return $count;
}

// ── Email ─────────────────────────────────────────────────────────────────────

function send_email(string $to, string $toName, string $subject, string $htmlBody, string $altBody = ''): bool {
    require_once __DIR__ . '/../vendor/phpmailer/src/Exception.php';
    require_once __DIR__ . '/../vendor/phpmailer/src/PHPMailer.php';
    require_once __DIR__ . '/../vendor/phpmailer/src/SMTP.php';

    $settings = get_all_settings();
    $host     = $settings['smtp_host']     ?? 'smtp.hostinger.com';
    $port     = (int)($settings['smtp_port'] ?? 465);
    $user     = $settings['smtp_user']     ?? ($settings['contact_email'] ?? '');
    $pass     = $settings['smtp_pass']     ?? '';
    $fromName = $settings['site_name']     ?? 'Wahana Totalita Konsultan';
    $fromEmail= $settings['smtp_user']     ?? ($settings['contact_email'] ?? 'noreply@wahanatotalita.com');

    if (!$user || !$pass) {
        error_log('[email] SMTP not configured');
        return false;
    }

    try {
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);
        $mail->isSMTP();
        $mail->Host       = $host;
        $mail->SMTPAuth   = true;
        $mail->Username   = $user;
        $mail->Password   = $pass;
        $mail->SMTPSecure = $port === 465 ? 'ssl' : 'tls';
        $mail->Port       = $port;
        $mail->CharSet    = 'UTF-8';
        $mail->setFrom($fromEmail, $fromName);
        $mail->addAddress($to, $toName);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $htmlBody;
        $mail->AltBody = $altBody ?: strip_tags($htmlBody);
        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log('[email] send failed: ' . $e->getMessage());
        return false;
    }
}

function send_registration_confirmation(int $regId): bool {
    require_once __DIR__ . '/jadwal-functions.php';
    $reg = get_registration_by_code('');
    if (!$reg) return false; // caller should pass code
    $subject = 'Konfirmasi Pendaftaran Pelatihan — ' . ($reg['training_name'] ?? '');
    $body    = email_template_registration($reg);
    return send_email($reg['email'], $reg['name'], $subject, $body);
}

function email_template_registration(array $reg): string {
    $site    = get_setting('site_name', 'Wahana Totalita Konsultan');
    $wa      = wa_url();
    $primary = '#0A4A2E';
    return <<<HTML
<!DOCTYPE html><html><head><meta charset="utf-8">
<style>body{font-family:Arial,sans-serif;background:#f5f5f5;margin:0;padding:20px}
.container{background:#fff;max-width:600px;margin:0 auto;border-radius:12px;overflow:hidden}
.header{background:{$primary};padding:30px;text-align:center;color:#fff}
.header h1{margin:0;font-size:24px}
.body{padding:30px}
.info-box{background:#f9f9f9;border-left:4px solid {$primary};padding:16px;border-radius:4px;margin:16px 0}
.btn{display:inline-block;background:#C6621C;color:#fff;padding:12px 24px;border-radius:8px;text-decoration:none;font-weight:bold}
.footer{background:#f5f5f5;padding:20px;text-align:center;font-size:12px;color:#999}
</style></head><body>
<div class="container">
  <div class="header"><h1>🦺 {$site}</h1><p>Konfirmasi Pendaftaran Pelatihan</p></div>
  <div class="body">
    <p>Yth. <strong>{$reg['name']}</strong>,</p>
    <p>Terima kasih telah mendaftar pelatihan di <strong>{$site}</strong>. Berikut detail pendaftaran Anda:</p>
    <div class="info-box">
      <strong>Pelatihan:</strong> {$reg['training_name']}<br>
      <strong>Kode Registrasi:</strong> {$reg['reg_code']}<br>
      <strong>Tanggal Mulai:</strong> {$reg['start_date']}<br>
      <strong>Lokasi:</strong> {$reg['location']}<br>
      <strong>Status Pembayaran:</strong> Menunggu Konfirmasi
    </div>
    <p>Untuk konfirmasi pembayaran atau pertanyaan, hubungi kami:</p>
    <p><a class="btn" href="{$wa}">Chat WhatsApp Sekarang</a></p>
    <p>Simpan kode registrasi <strong>{$reg['reg_code']}</strong> untuk verifikasi sertifikat Anda setelah pelatihan.</p>
  </div>
  <div class="footer">&copy; {date('Y')} {$site} | wahanatotalita.com</div>
</div></body></html>
HTML;
}

// ── WhatsApp ──────────────────────────────────────────────────────────────────

function send_wa_notification(string $phone, string $message): bool {
    require_once __DIR__ . '/../vendor/evolution/EvolutionClient.php';
    $evo = new EvolutionClient();
    if (!$evo->isEnabled()) {
        error_log('[wa] Evolution API not configured. wa.me fallback only.');
        return false;
    }
    $result = $evo->sendText($phone, $message);
    if (!$result['success']) error_log('[wa] send failed: ' . $result['error']);
    return $result['success'];
}

function log_wa_sent(string $phone, string $message, bool $success): void {
    try {
        get_pdo()->prepare('INSERT INTO wa_logs (phone_number, message, status, created_at) VALUES (?, ?, ?, NOW())')
            ->execute([$phone, mb_substr($message, 0, 255), $success ? 'sent' : 'failed']);
    } catch (Exception) {}
}
