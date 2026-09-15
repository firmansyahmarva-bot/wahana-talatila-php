<?php
if (defined('NEWSLETTER_FUNCTIONS_LOADED')) return;
define('NEWSLETTER_FUNCTIONS_LOADED', true);
/**
 * includes/newsletter-functions.php
 * Newsletter subscriber helper functions
 * Tables: newsletter_subscribers, newsletter_campaigns
 */

function newsletter_subscribe(string $email, string $name = '', string $source = 'website'): array {
    $pdo   = get_pdo();
    $email = strtolower(trim($email));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return ['ok' => false, 'msg' => 'Email tidak valid.'];
    }

    try {
        // Check if already subscribed
        $existing = $pdo->prepare('SELECT id, is_active FROM newsletter_subscribers WHERE email = ? LIMIT 1');
        $existing->execute([$email]);
        $row = $existing->fetch();

        if ($row) {
            if ($row['is_active']) {
                return ['ok' => false, 'msg' => 'Email sudah terdaftar sebelumnya.'];
            }
            // Re-subscribe
            $pdo->prepare('UPDATE newsletter_subscribers SET is_active=1, name=?, unsubscribed_at=NULL, subscribed_at=NOW() WHERE id=?')
                ->execute([$name ?: $row['name'], $row['id']]);
            return ['ok' => true, 'msg' => 'Berhasil berlangganan kembali!'];
        }

        $token = bin2hex(random_bytes(16));
        $pdo->prepare(
            'INSERT INTO newsletter_subscribers (email, name, source, unsubscribe_token, is_active, subscribed_at)
             VALUES (?, ?, ?, ?, 1, NOW())'
        )->execute([$email, $name, $source, $token]);

        return ['ok' => true, 'msg' => 'Berhasil! Cek email kamu untuk konfirmasi.'];

    } catch (Exception $e) {
        error_log('newsletter_subscribe error: ' . $e->getMessage());
        return ['ok' => false, 'msg' => 'Terjadi kesalahan. Coba lagi.'];
    }
}

function newsletter_unsubscribe_by_email(string $email): bool {
    try {
        get_pdo()->prepare('UPDATE newsletter_subscribers SET is_active=0, unsubscribed_at=NOW() WHERE email=?')
            ->execute([strtolower(trim($email))]);
        return true;
    } catch (Exception $e) { return false; }
}

function get_newsletter_stats(): array {
    $pdo = get_pdo();
    return [
        'total_active'  => (int)$pdo->query("SELECT COUNT(*) FROM newsletter_subscribers WHERE is_active=1")->fetchColumn(),
        'total_all'     => (int)$pdo->query("SELECT COUNT(*) FROM newsletter_subscribers")->fetchColumn(),
        'unsubscribed'  => (int)$pdo->query("SELECT COUNT(*) FROM newsletter_subscribers WHERE is_active=0")->fetchColumn(),
        'this_month'    => (int)$pdo->query("SELECT COUNT(*) FROM newsletter_subscribers WHERE is_active=1 AND MONTH(subscribed_at)=MONTH(NOW()) AND YEAR(subscribed_at)=YEAR(NOW())")->fetchColumn(),
    ];
}

function get_newsletter_campaigns(int $limit = 20, int $offset = 0): array {
    $stmt = get_pdo()->prepare('SELECT * FROM newsletter_campaigns ORDER BY created_at DESC LIMIT ? OFFSET ?');
    $stmt->execute([$limit, $offset]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
