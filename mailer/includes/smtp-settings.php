<?php
declare(strict_types=1);

define('SMTP_SETTINGS_FILE', ROOT_PATH . '/config/smtp-settings.json');

function mailer_default_smtp_settings(): array
{
    return [
        'host'                 => 'smtp.hostinger.com',
        'port'                 => 465,
        'encryption'           => 'ssl', // 'ssl' (port 465) or 'tls' (port 587)
        'username'             => 'info@wahanatotalita.com',
        'password'             => '',
        'from_email'           => 'info@wahanatotalita.com',
        'from_name'            => 'PT Wahana Totalita Konsultan',
        'daily_limit_default'  => 500,
        'window_start_default' => '10:00',
        'window_end_default'   => '17:00',
        'batch_size'           => 25,
    ];
}

function mailer_load_smtp_settings(): array
{
    $defaults = mailer_default_smtp_settings();
    if (!is_file(SMTP_SETTINGS_FILE)) {
        return $defaults;
    }
    $data = json_decode((string)file_get_contents(SMTP_SETTINGS_FILE), true);
    if (!is_array($data)) {
        return $defaults;
    }
    return array_merge($defaults, $data);
}

/** Merges $settings on top of the current saved values and writes atomically. */
function mailer_save_smtp_settings(array $settings): bool
{
    $current = mailer_load_smtp_settings();
    // Never overwrite the stored password with a blank "leave unchanged" field.
    if (array_key_exists('password', $settings) && $settings['password'] === '') {
        unset($settings['password']);
    }
    $merged = array_merge($current, $settings);

    $dir = dirname(SMTP_SETTINGS_FILE);
    if (!is_dir($dir) && !mkdir($dir, 0755, true) && !is_dir($dir)) {
        return false;
    }

    $json = json_encode($merged, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    if ($json === false) {
        return false;
    }

    $tmp = SMTP_SETTINGS_FILE . '.tmp';
    if (file_put_contents($tmp, $json, LOCK_EX) === false) {
        return false;
    }
    return rename($tmp, SMTP_SETTINGS_FILE);
}
