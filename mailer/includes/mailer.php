<?php
declare(strict_types=1);

require_once ROOT_PATH . '/lib/PHPMailer/Exception.php';
require_once ROOT_PATH . '/lib/PHPMailer/PHPMailer.php';
require_once ROOT_PATH . '/lib/PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as PHPMailerException;

/** One SMTP connection is meant to be reused across many sends — see mailer_send_html(). */
function mailer_build_phpmailer(): PHPMailer
{
    $settings = mailer_load_smtp_settings();

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host        = $settings['host'];
    $mail->Port         = (int)$settings['port'];
    $mail->SMTPAuth     = true;
    $mail->Username     = $settings['username'];
    $mail->Password     = $settings['password'];
    $mail->SMTPSecure   = $settings['encryption'];
    $mail->CharSet      = 'UTF-8';
    $mail->SMTPKeepAlive = true;
    // Fail fast: PHPMailer's default 300s timeout exceeds LiteSpeed's ~60s web
    // request limit, so a connection problem became a blank 500 instead of a
    // readable error. 15s is plenty for a healthy SMTP handshake.
    $mail->Timeout = 15;
    $mail->setFrom($settings['from_email'], $settings['from_name']);
    $mail->isHTML(true);

    return $mail;
}

/** @return array{ok:bool,error:?string} */
function mailer_send_html(PHPMailer $mail, string $toEmail, string $toName, string $subject, string $html): array
{
    try {
        $mail->clearAddresses();
        $mail->clearAttachments();
        $mail->addAddress($toEmail, $toName);
        $mail->Subject = $subject;
        $mail->Body    = $html;
        $mail->AltBody = mailer_html_to_text($html);
        $mail->send();
        return ['ok' => true, 'error' => null];
    } catch (PHPMailerException $e) {
        return ['ok' => false, 'error' => $mail->ErrorInfo !== '' ? $mail->ErrorInfo : $e->getMessage()];
    }
}

function mailer_html_to_text(string $html): string
{
    $text = preg_replace('/<br\s*\/?>/i', "\n", $html) ?? $html;
    $text = preg_replace('/<\/p>/i', "\n\n", $text) ?? $text;
    $text = strip_tags($text);
    $text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');
    $text = preg_replace('/\n{3,}/', "\n\n", $text) ?? $text;
    return trim($text);
}
