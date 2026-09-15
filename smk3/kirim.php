<?php
/**
 * FORM HANDLER — receives the consultation form (POST from /kontak/),
 * emails it to the configured address, then redirects to /terima-kasih/.
 * Includes basic anti-spam: honeypot field + minimal rate limiting via session.
 */

declare(strict_types=1);
session_start();

$SITE = require __DIR__ . '/config/site.php';

function back_with_error(string $msg): void {
  $_SESSION['form_error'] = $msg;
  header('Location: /kontak/#form');
  exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: /kontak/');
  exit;
}

/* Honeypot: real users never fill this hidden field. */
if (!empty($_POST['website'] ?? '')) {
  header('Location: /terima-kasih/'); // pretend success to bots
  exit;
}

/* Simple rate limit: one submission per 60s per session. */
if (isset($_SESSION['last_submit']) && (time() - (int)$_SESSION['last_submit']) < 60) {
  back_with_error('Anda baru saja mengirim pesan. Mohon tunggu sebentar sebelum mengirim lagi.');
}

$nama       = trim((string)($_POST['nama'] ?? ''));
$perusahaan = trim((string)($_POST['perusahaan'] ?? ''));
$email      = trim((string)($_POST['email'] ?? ''));
$telepon    = trim((string)($_POST['telepon'] ?? ''));
$kebutuhan  = trim((string)($_POST['kebutuhan'] ?? ''));
$pesan      = trim((string)($_POST['pesan'] ?? ''));

if ($nama === '' || $email === '' || $pesan === '') {
  back_with_error('Mohon lengkapi nama, email, dan pesan Anda.');
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  back_with_error('Format email tidak valid. Mohon periksa kembali.');
}
if (mb_strlen($pesan) > 5000) {
  back_with_error('Pesan terlalu panjang.');
}

/* Strip header-injection attempts from single-line fields. */
$clean = fn(string $s): string => str_replace(["\r", "\n", '%0a', '%0d'], ' ', $s);
$nama = $clean($nama); $perusahaan = $clean($perusahaan);
$telepon = $clean($telepon); $kebutuhan = $clean($kebutuhan);

$to      = $SITE['email'];
$subject = '[SMK3 Subdomain] Permintaan Konsultasi dari ' . $nama;
$bodyLines = [
  'Permintaan konsultasi baru dari smk3.wahanatotalita.com',
  '',
  'Nama       : ' . $nama,
  'Perusahaan : ' . ($perusahaan !== '' ? $perusahaan : '-'),
  'Email      : ' . $email,
  'Telepon/WA : ' . ($telepon !== '' ? $telepon : '-'),
  'Kebutuhan  : ' . ($kebutuhan !== '' ? $kebutuhan : '-'),
  '',
  'Pesan:',
  $pesan,
  '',
  'Dikirim: ' . date('Y-m-d H:i:s') . ' WIB',
];
$body = implode("\n", $bodyLines);

/* From = domain sendiri agar lolos SPF hosting; email pengirim di Reply-To. */
$headers = [
  'From: SMK3 Indonesia <no-reply@wahanatotalita.com>',
  'Reply-To: ' . $nama . ' <' . $email . '>',
  'Content-Type: text/plain; charset=UTF-8',
  'X-Mailer: PHP/' . PHP_VERSION,
];

$sent = @mail($to, '=?UTF-8?B?' . base64_encode($subject) . '?=', $body, implode("\r\n", $headers));

$_SESSION['last_submit'] = time();

if (!$sent) {
  back_with_error('Maaf, pesan gagal terkirim. Silakan hubungi kami langsung via WhatsApp.');
}

header('Location: /terima-kasih/');
exit;
