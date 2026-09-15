<?php
// View + text helpers for the /k3 engine.
// Guarded so the file is safe to include more than once (refresh.php chains scripts).
if (!function_exists('e')) {

function e(?string $v): string
{
    return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');
}

// Normalize any raw slug/query into a safe lowercase-hyphen slug.
function norm_slug(string $raw): string
{
    $s = strtolower(trim($raw));
    $s = preg_replace('/[^a-z0-9]+/', '-', $s);
    return trim($s, '-');
}

// Turn a slug/query into a human, Title-Cased phrase for the H1.
// Always escaped at output — never trust this as HTML.
function humanize(string $raw): string
{
    $s = str_replace(['-', '_'], ' ', strtolower(trim($raw)));
    $s = preg_replace('/\s+/', ' ', $s);
    // Keep common K3 acronyms upper-cased.
    $words = array_map(function ($w) {
        $upper = ['k3','bnsp','k3l','p3k','smk3','iso','hse','qhse','tkbt','agt','csms','ptp','popal','mplb3','oplb3','pplb3','pppa','pppu','poippu','pcua','pertek','tot','h2s','roi','hima','himu'];
        return in_array($w, $upper, true) ? strtoupper($w) : ucfirst($w);
    }, explode(' ', $s));
    return trim(implode(' ', $words));
}

function format_price(?string $price): string
{
    if ($price === null || $price === '' || (float)$price <= 0) return 'Hubungi kami';
    return 'Rp ' . number_format((float)$price, 0, ',', '.');
}

function wa_url(string $number, string $message): string
{
    return 'https://wa.me/' . $number . '?text=' . rawurlencode($message);
}

} // end function_exists guard
