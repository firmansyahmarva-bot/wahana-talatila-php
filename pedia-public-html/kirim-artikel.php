<?php
/**
 * CONTRIBUTOR SUBMISSION HANDLER — POST from /kontribusi/.
 *
 * Workflow (deliberately simple, file-based, no database, no accounts):
 *   Submit → saved to submissions/ (web-blocked) + email notification
 *   → admin reads the file → approves → publishes via the normal
 *   manifest + content/<key>.php procedure. NOTHING is auto-published.
 *
 * Honeypot + session rate limit; naskah stored as plain .txt.
 */

declare(strict_types=1);
session_start();

$SITE = require __DIR__ . '/config/site.php';

function back_with_error(string $msg): void {
  $_SESSION['form_error'] = $msg;
  header('Location: /kontribusi/#form');
  exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: /kontribusi/');
  exit;
}

/* Honeypot */
if (!empty($_POST['website'] ?? '')) {
  header('Location: /terima-kasih/');
  exit;
}

/* Rate limit: one submission per 5 minutes per session. */
if (isset($_SESSION['last_artikel']) && (time() - (int)$_SESSION['last_artikel']) < 300) {
  back_with_error('Anda baru saja mengirim naskah. Mohon tunggu beberapa menit sebelum mengirim lagi.');
}

$nama       = trim((string)($_POST['nama'] ?? ''));
$email      = trim((string)($_POST['email'] ?? ''));
$kredensial = trim((string)($_POST['kredensial'] ?? ''));
$judul      = trim((string)($_POST['judul'] ?? ''));
$naskah     = trim((string)($_POST['naskah'] ?? ''));
$referensi  = trim((string)($_POST['referensi'] ?? ''));

if ($nama === '' || $email === '' || $judul === '' || $naskah === '') {
  back_with_error('Mohon lengkapi nama, email, judul, dan isi naskah.');
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  back_with_error('Format email tidak valid. Mohon periksa kembali.');
}
if (mb_strlen($naskah) < 500) {
  back_with_error('Naskah terlalu pendek — minimal sekitar 500 karakter agar layak direviu.');
}
if (mb_strlen($naskah) > 60000) {
  back_with_error('Naskah terlalu panjang. Maksimal sekitar 60.000 karakter.');
}

$clean = fn(string $s): string => str_replace(["\r", "\n", '%0a', '%0d'], ' ', $s);
$nama = $clean($nama); $kredensial = $clean($kredensial); $judul = $clean($judul);

/* ---- save to submissions/ (blocked from the web by .htaccess) ---- */
$dir = __DIR__ . '/submissions';
if (!is_dir($dir)) { mkdir($dir, 0755); }

$slug = strtolower(preg_replace('/[^a-z0-9]+/i', '-', $judul));
$slug = trim(substr($slug, 0, 60), '-');
$file = $dir . '/' . date('Ymd-His') . '-' . $slug . '.txt';

$record = implode("\n", [
  'STATUS     : PENDING REVIEW',
  'Tanggal    : ' . date('Y-m-d H:i:s') . ' WIB',
  'Nama       : ' . $nama,
  'Email      : ' . $email,
  'Kredensial : ' . ($kredensial !== '' ? $kredensial : '-'),
  'Judul      : ' . $judul,
  str_repeat('=', 60),
  '',
  $naskah,
  '',
  str_repeat('=', 60),
  'Referensi/sumber yang dicantumkan penulis:',
  ($referensi !== '' ? $referensi : '-'),
]);

if (file_put_contents($file, $record, LOCK_EX) === false) {
  back_with_error('Maaf, naskah gagal tersimpan. Silakan kirim via email ke ' . $SITE['email'] . '.');
}

/* ---- notify admin (best-effort; the saved file is the source of truth) ---- */
$subject = '[PediaK3] Naskah Baru Menunggu Reviu: ' . $judul;
$body = implode("\n", [
  'Naskah kontribusi baru masuk dan menunggu reviu Anda.',
  '',
  'Penulis    : ' . $nama . ' (' . $email . ')',
  'Kredensial : ' . ($kredensial !== '' ? $kredensial : '-'),
  'Judul      : ' . $judul,
  'Panjang    : ' . mb_strlen($naskah) . ' karakter',
  'Tersimpan  : submissions/' . basename($file),
  '',
  'Tidak ada yang terbit otomatis. Publikasikan hanya lewat prosedur',
  'manifest + content/<key>.php setelah naskah Anda setujui.',
]);
$headers = [
  'From: PediaK3 <no-reply@wahanatotalita.com>',
  'Reply-To: ' . $nama . ' <' . $email . '>',
  'Content-Type: text/plain; charset=UTF-8',
];
@mail($SITE['email'], '=?UTF-8?B?' . base64_encode($subject) . '?=', $body, implode("\r\n", $headers));

$_SESSION['last_artikel'] = time();

header('Location: /terima-kasih/?dari=kontribusi');
exit;
