<?php
declare(strict_types=1);

/**
 * Zero-config template system: any folder under /templates/ that contains
 * both template.html and config.json is auto-detected. Adding a template
 * never requires touching PHP — see each template folder's PROMPT.txt for the contract.
 */

function mailer_templates_dir(): string
{
    return ROOT_PATH . '/templates';
}

/** @return array<string,array> keyed by template slug */
function mailer_list_templates(): array
{
    $out = [];
    $paths = glob(mailer_templates_dir() . '/*', GLOB_ONLYDIR) ?: [];
    foreach ($paths as $path) {
        $slug = basename($path);
        $configPath = $path . '/config.json';
        $htmlPath = $path . '/template.html';
        if (!is_file($configPath) || !is_file($htmlPath)) {
            continue;
        }
        $config = json_decode((string)file_get_contents($configPath), true);
        if (!is_array($config)) {
            continue;
        }
        $preview = null;
        foreach (['preview.png', 'preview.webp', 'preview.jpg'] as $candidate) {
            if (is_file($path . '/' . $candidate)) {
                $preview = $candidate;
                break;
            }
        }
        $out[$slug] = [
            'slug'        => $slug,
            'name'        => (string)($config['name'] ?? $slug),
            'description' => (string)($config['description'] ?? ''),
            'fields'      => is_array($config['fields'] ?? null) ? $config['fields'] : [],
            'preview'     => $preview,
        ];
    }
    ksort($out);
    return $out;
}

function mailer_get_template(string $slug): ?array
{
    return mailer_list_templates()[$slug] ?? null;
}

/** Strips everything except a small safe subset of formatting tags. */
function mailer_sanitize_rich_text(string $html): string
{
    $allowed = '<p><br><strong><b><em><i><ul><ol><li><a>';
    $clean = strip_tags($html, $allowed);
    $clean = preg_replace('/\s+on\w+\s*=\s*("[^"]*"|\'[^\']*\')/i', '', $clean) ?? $clean;
    $clean = preg_replace('/href\s*=\s*("|\')\s*javascript:[^"\']*("|\')/i', 'href="#"', $clean) ?? $clean;
    return $clean;
}

/**
 * Renders one template with campaign field values + per-recipient system tokens.
 * Returns null if the template folder/file no longer exists.
 */
function mailer_render_template(string $slug, array $fieldValues, array $systemTokens): ?string
{
    $tpl = mailer_get_template($slug);
    if ($tpl === null) {
        return null;
    }
    $htmlFile = mailer_templates_dir() . '/' . basename($slug) . '/template.html';
    if (!is_file($htmlFile)) {
        return null;
    }
    $html = (string)file_get_contents($htmlFile);

    $tokens = [];
    foreach ($tpl['fields'] as $field) {
        $key = (string)($field['key'] ?? '');
        if ($key === '') {
            continue;
        }
        $raw = $fieldValues[$key] ?? ($field['default'] ?? '');
        $type = (string)($field['type'] ?? 'text');
        $tokens['{{' . $key . '}}'] = $type === 'textarea'
            ? mailer_sanitize_rich_text((string)$raw)
            : htmlspecialchars((string)$raw, ENT_QUOTES, 'UTF-8');
    }
    foreach ($systemTokens as $key => $value) {
        $tokens['{{' . $key . '}}'] = htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
    }

    return strtr($html, $tokens);
}

/** Renders the HTML <input>/<textarea> for one config.json field definition. */
function mailer_render_field_input(array $field, string $value): string
{
    $key = e((string)($field['key'] ?? ''));
    $type = (string)($field['type'] ?? 'text');
    $required = !empty($field['required']) ? ' required' : '';

    if ($type === 'textarea') {
        return '<textarea name="field_' . $key . '" rows="5"' . $required . '>' . e($value) . '</textarea>';
    }
    $inputType = $type === 'url' ? 'url' : 'text';
    $maxLength = isset($field['max_length']) ? ' maxlength="' . (int)$field['max_length'] . '"' : '';
    return '<input type="' . $inputType . '" name="field_' . $key . '" value="' . e($value) . '"' . $maxLength . $required . '>';
}
