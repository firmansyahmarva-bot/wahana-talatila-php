<?php
/**
 * CONTACT FORM HANDLER — POST from /kontak/. Editorial contact only
 * (koreksi konten, izin kutip, pertanyaan redaksi). Emails the admin,
 * then redirects to /terima-kasih/. Honeypot + session rate limit.
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

$nama  = trim((string)($_POST['nama'] ?? ''));
$email = trim((string)($_POST['email'] ?? ''));
$topik = trim((string)($_POST['topik'] ?? ''));
$pesan = trim((string)($_POST['pesan'] ?? ''));

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
$nama = $clean($nama); $topik = $clean($topik);

$to      = $SITE['email'];
$subject = '[PediaK3] Pesan Redaksi dari ' . $nama;
$body = implode("\n", [
  'Pesan baru dari formulir kontak pedia.wahanatotalita.com',
  '',
  'Nama  : ' . $nama,
  'Email : ' . $email,
  'Topik : ' . ($topik !== '' ? $topik : '-'),
  '',
  'Pesan:',
  $pesan,
  '',
  'Dikirim: ' . date('Y-m-d H:i:s') . ' WIB',
]);

$headers = [
  'From: PediaK3 <no-reply@wahanatotalita.com>',
  'Reply-To: ' . $nama . ' <' . $email . '>',
  'Content-Type: text/plain; charset=UTF-8',
  'X-Mailer: PHP/' . PHP_VERSION,
];

$sent = @mail($to, '=?UTF-8?B?' . base64_encode($subject) . '?=', $body, implode("\r\n", $headers));

$_SESSION['last_submit'] = time();

if (!$sent) {
  back_with_error('Maaf, pesan gagal terkirim. Silakan email kami langsung di ' . $SITE['email'] . '.');
}

header('Location: /terima-kasih/');
exit;
