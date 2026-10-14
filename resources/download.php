<?php
/**
 * resources/download.php
 * Handles document file delivery for the Resource Library.
 */
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/resources-functions.php';

$id = (int)($_GET['id'] ?? 0);
if (!$id) {
    redirect(SITE_URL . '/resources/');
}

$resource = get_resource_by_id($id);
if (!$resource) {
    http_response_code(404);
    include __DIR__ . '/../404.php';
    exit;
}

// Increment download counter
increment_resource_download($id);

// Check physical file path
$filePath = '';
if (!empty($resource['file_path'])) {
    $candidatePaths = [
        __DIR__ . '/../' . ltrim($resource['file_path'], '/'),
        __DIR__ . '/../assets/uploads/resources/' . basename($resource['file_path']),
        __DIR__ . '/../assets/uploads/' . basename($resource['file_path']),
    ];
    foreach ($candidatePaths as $p) {
        if (file_exists($p) && is_file($p)) {
            $filePath = $p;
            break;
        }
    }
}

// If physical file exists, stream it as download
if ($filePath && file_exists($filePath)) {
    $filename = basename($filePath);
    $mimeType = match (strtolower(pathinfo($filePath, PATHINFO_EXTENSION))) {
        'pdf'  => 'application/pdf',
        'doc'  => 'application/msword',
        'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'xls'  => 'application/vnd.ms-excel',
        'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'zip'  => 'application/zip',
        default => 'application/octet-stream',
    };

    header('Content-Description: File Transfer');
    header('Content-Type: ' . $mimeType);
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filePath));
    readfile($filePath);
    exit;
}

// Fallback if physical file is not yet deployed on staging:
// Show confirmation page with direct WhatsApp delivery link rather than 404!
$metaTitle = 'Download ' . ($resource['title'] ?? 'Dokumen K3') . ' | Wahana Totalita';
$metaDesc = 'Pengunduhan dokumen panduan dan checklist keselamatan kerja Wahana Totalita.';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($metaTitle) ?></title>
<meta name="robots" content="noindex, follow">
<?php require __DIR__ . '/../includes/css.php'; ?>
<style>
.dl-wrap { max-width:640px; margin:80px auto; padding:40px 24px; text-align:center; background:#fff; border-radius:16px; border:1px solid var(--slate-200); box-shadow:0 10px 30px rgba(0,0,0,0.06); }
.dl-icon { font-size:48px; margin-bottom:16px; }
.dl-title { font-size:1.5rem; font-weight:800; color:var(--slate-900); margin-bottom:12px; }
.dl-desc { color:var(--slate-600); line-height:1.6; margin-bottom:28px; }
.dl-btn { display:inline-flex; align-items:center; gap:8px; padding:12px 28px; background:var(--brand); color:#fff; border-radius:10px; font-weight:700; text-decoration:none; }
.dl-btn-wa { background:#25D366; }
</style>
</head>
<body style="background:var(--slate-50);">
<?php require __DIR__ . '/../includes/navbar.php'; ?>
<main>
  <div class="dl-wrap">
    <div class="dl-icon">✅</div>
    <h1 class="dl-title">Permintaan Dokumen Berhasil Diterima</h1>
    <p class="dl-desc">Terima kasih telah mengunduh <strong><?= e($resource['title']) ?></strong>. File dokumen sedang disiapkan atau dapat dikirimkan langsung via WhatsApp Admin kami.</p>
    <a href="<?= wa_url('Halo Wahana Totalita, saya telah mengisi formulir untuk mengunduh dokumen: ' . ($resource['title'] ?? '')) ?>" class="dl-btn dl-btn-wa" target="_blank" rel="noopener">
      Kirim File ke WhatsApp Saya &rarr;
    </a>
    <div style="margin-top:20px;">
      <a href="/resources/" style="color:var(--slate-500); text-decoration:none; font-size:0.9rem;">&larr; Kembali ke Resource Library</a>
    </div>
  </div>
</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>
