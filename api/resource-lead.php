<?php
/**
 * api/resource-lead.php
 * Process resource download lead form. Called via POST from resources/detail.php.
 */
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/resources-functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') { redirect(SITE_URL . '/resources/'); }
if (!verify_csrf()) { flash_set('error', 'Sesi tidak valid. Silakan coba lagi.'); redirect(SITE_URL . '/resources/'); }

$resourceId = (int)($_POST['resource_id'] ?? 0);
$slug       = sanitize($_POST['resource_slug'] ?? '');
$name       = sanitize($_POST['name']    ?? '');
$email      = sanitize($_POST['email']   ?? '');
$phone      = sanitize($_POST['phone']   ?? '');
$company    = sanitize($_POST['company'] ?? '');
$jabatan    = sanitize($_POST['jabatan'] ?? '');

if (!$resourceId || !$name || !$email) {
    flash_set('error', 'Nama dan email wajib diisi.');
    redirect(SITE_URL . '/resources/' . ($slug ?: '') . ($slug ? '/' : ''));
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    flash_set('error', 'Format email tidak valid.');
    redirect(SITE_URL . '/resources/' . $slug . '/');
}

$resource = get_resource_by_id($resourceId);
if (!$resource) { redirect(SITE_URL . '/resources/'); }

// Save lead
$lead = [
    'resource_id' => $resourceId,
    'name'        => $name,
    'email'       => $email,
    'phone'       => $phone,
    'company'     => $company,
    'jabatan'     => $jabatan,
    'ip_address'  => $_SERVER['REMOTE_ADDR'] ?? '',
];
save_resource_lead($lead);

// Also save to main leads table for AI scoring
try {
    $pdo = get_pdo();
    $pdo->prepare("INSERT IGNORE INTO leads (name,email,phone,company,jabatan,source,created_at) VALUES (?,?,?,?,?,?,NOW())")
        ->execute([$name,$email,$phone,$company,$jabatan,'resource_library']);
} catch (Exception $e) { /* non-fatal */ }

// Session cookie so they don't need to re-submit
setcookie('wt_rl_' . $resourceId, '1', time() + 86400 * 30, '/', '', true, true);

// Redirect to download
redirect(SITE_URL . '/resources/download/' . $resourceId . '/');
