<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';
require_login();

$id = (int)($_GET['id'] ?? 0);
$slug = (string)($_GET['template'] ?? '');
$fieldValues = [];

if ($id > 0) {
    $stmt = db()->prepare('SELECT * FROM campaigns WHERE id = ?');
    $stmt->execute([$id]);
    $campaign = $stmt->fetch();
    if (!$campaign) {
        http_response_code(404);
        exit('Campaign not found.');
    }
    $slug = $campaign['template_slug'];
    $fieldValues = json_decode((string)$campaign['field_data'], true) ?: [];
} elseif ($slug === '') {
    http_response_code(400);
    exit('Missing id or template parameter.');
} else {
    // Gallery sample preview: fill every field with placeholder text.
    $tpl = mailer_get_template($slug);
    if (!$tpl) {
        http_response_code(404);
        exit('Template not found.');
    }
    foreach ($tpl['fields'] as $field) {
        $key = (string)($field['key'] ?? '');
        if ($key === '') {
            continue;
        }
        $fieldValues[$key] = (string)($field['default'] ?? ('[' . ($field['label'] ?? $key) . ']'));
    }
}

$systemTokens = [
    'contact_name'    => 'Bapak/Ibu Pelanggan',
    'unsubscribe_url' => mailer_url('unsubscribe.php?t=preview'),
    'site_url'        => SITE_URL,
    'site_logo_url'   => SITE_LOGO_URL,
    'current_year'    => date('Y'),
];

$html = mailer_render_template($slug, $fieldValues, $systemTokens);
if ($html === null) {
    http_response_code(404);
    exit('Template files missing.');
}

header('Content-Type: text/html; charset=UTF-8');
echo $html;
