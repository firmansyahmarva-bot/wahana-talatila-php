<?php
namespace PHPMailer\PHPMailer;

class PHPMailer {
    const VERSION       = '6.8.1';
    const CHARSET_UTF8  = 'UTF-8';
    const CHARSET_ISO88591 = 'ISO-8859-1';
    const CONTENT_TYPE_PLAINTEXT = 'text/plain';
    const CONTENT_TYPE_TEXT_CALENDAR = 'text/calendar';
    const CONTENT_TYPE_TEXT_HTML = 'text/html';
    const ENCODING_7BIT   = '7bit';
    const ENCODING_8BIT   = '8bit';
    const ENCODING_BASE64 = 'base64';
    const ENCODING_QP     = 'quoted-printable';
    const ENCODING_UTF8   = 'UTF-8';

    public bool   $exceptions = true;
    public bool   $isSMTP    = false;
    public string $Host      = 'localhost';
    public bool   $SMTPAuth  = false;
    public string $Username  = '';
    public string $Password  = '';
    public string $SMTPSecure = '';
    public bool   $SMTPAutoTLS = true;
    public int    $Port      = 25;
    public string $From      = '';
    public string $FromName  = '';
    public string $Sender    = '';
    public string $Subject   = '';
    public string $Body      = '';
    public string $AltBody   = '';
    public string $Ical      = '';
    public string $CharSet   = self::CHARSET_UTF8;
    public string $ContentType = self::CONTENT_TYPE_PLAINTEXT;
    public string $Encoding  = self::ENCODING_8BIT;
    public bool   $IsHTML    = false;
    public int    $WordWrap  = 0;
    public string $Mailer    = 'mail';
    public string $Sendmail  = '/usr/sbin/sendmail';
    public bool   $UseSendmailOptions = true;
    public string $ConfirmReadingTo = '';
    public string $Hostname  = '';
    public string $MessageID = '';
    public string $MessageDate = '';
    public int    $Priority  = 3;
    public string $XMailer   = '';
    public string $DKIM_domain = '';
    public string $DKIM_private = '';
    public string $DKIM_private_string = '';
    public string $DKIM_selector = '';
    public string $DKIM_passphrase = '';
    public string $DKIM_identity = '';
    public bool   $DKIM_copyHeaderFields = true;
    public array  $DKIM_extraHeaders = [];
    public array  $CustomHeader = [];
    public int    $SMTPDebug = 0;
    public array  $SMTPOptions = [];

    protected array $to = [];
    protected array $cc = [];
    protected array $bcc = [];
    protected array $reply_to = [];
    protected array $all_recipients = [];
    protected array $RecipientsQueue = [];
    protected array $ReplyToQueue = [];
    protected array $attachment = [];
    protected array $CustomHeader_arr = [];
    protected string $message_type = '';
    protected array $boundary = [];
    protected array $language = [];
    protected int   $error_count = 0;
    protected string $sign_cert_file = '';
    protected string $sign_key_file = '';
    protected string $sign_extracerts_file = '';
    protected string $sign_key_pass = '';
    protected bool  $SingleToArray = false;
    protected bool  $do_verp = false;
    protected bool  $lastMessageID = false;
    protected string $MIMEBody = '';
    protected string $MIMEHeader = '';
    protected string $mailHeader = '';
    public    string $ErrorInfo = '';
    protected ?SMTP $smtp = null;

    public function __construct(bool $exceptions = true) { $this->exceptions = $exceptions; }
    public function __destruct() { $this->smtpClose(); }

    protected function mailPassthru(string $to, string $subject, string $body, string $header, string $params): bool {
        $rt = @mail($to, $this->encodeHeader($this->secureHeader($subject)), $body, $header, $params);
        return (bool)$rt;
    }
    protected function edebug(string $str): void {
        if ($this->SMTPDebug <= 0) return;
        echo htmlspecialchars($str) . "\n";
    }
    public function isHTML(bool $isHtml = true): void {
        $this->IsHTML     = $isHtml;
        $this->ContentType = $isHtml ? self::CONTENT_TYPE_TEXT_HTML : self::CONTENT_TYPE_PLAINTEXT;
        if (!$isHtml && $this->Encoding === self::ENCODING_QP) $this->Encoding = self::ENCODING_BASE64;
    }
    public function isSMTP(): void  { $this->Mailer = 'smtp'; }
    public function isMail(): void  { $this->Mailer = 'mail'; }
    public function isSendmail(): void { $sendmailFmt = '/usr/sbin/sendmail'; $this->Mailer = 'sendmail'; }
    public function isQmail(): void { $this->Sendmail = '/var/qmail/bin/qmail-inject'; $this->Mailer = 'qmail'; }

    public function addAddress(string $address, string $name = ''): bool {
        return $this->addOrEnqueueAnAddress('to', $address, $name);
    }
    public function addCC(string $address, string $name = ''): bool {
        return $this->addOrEnqueueAnAddress('cc', $address, $name);
    }
    public function addBCC(string $address, string $name = ''): bool {
        return $this->addOrEnqueueAnAddress('bcc', $address, $name);
    }
    public function addReplyTo(string $address, string $name = ''): bool {
        return $this->addOrEnqueueAnAddress('Reply-To', $address, $name);
    }
    protected function addOrEnqueueAnAddress(string $kind, string $address, string $name): bool {
        $address = trim($address);
        $name = trim(preg_replace('/[\r\n]+/', '', $name));
        $pos = strrpos($address, '@');
        if ($pos === false) {
            $error_message = sprintf('%s (From): %s', $this->lang('invalid_address'), $address);
            $this->setError($error_message);
            if ($this->exceptions) throw new Exception($error_message);
            return false;
        }
        if ($kind !== 'Reply-To') {
            if (!array_key_exists(strtolower($address), $this->all_recipients)) {
                $this->$kind[] = [$address, $name];
                $this->all_recipients[strtolower($address)] = true;
                return true;
            }
        } else {
            if (!array_key_exists(strtolower($address), $this->reply_to)) {
                $this->reply_to[strtolower($address)] = [$address, $name];
                return true;
            }
        }
        return false;
    }
    public function setFrom(string $address, string $name = '', bool $auto = true): bool {
        $address = trim($address);
        $name    = trim(preg_replace('/[\r\n]+/', '', $name));
        if (!$this->validateAddress($address)) {
            $this->setError(sprintf('%s (From): %s', $this->lang('invalid_address'), $address));
            if ($this->exceptions) throw new Exception($this->ErrorInfo);
            return false;
        }
        $this->From     = $address;
        $this->FromName = $name;
        if ($auto && empty($this->Sender)) $this->Sender = $address;
        return true;
    }
    public function getLastMessageID(): string { return (string)$this->lastMessageID; }
    public static function validateAddress(string $address, string $patternselect = 'auto'): bool {
        return (bool)filter_var($address, FILTER_VALIDATE_EMAIL);
    }
    public function idnSupported(): bool { return function_exists('idn_to_ascii'); }
    public function punyencodeAddress(string $address): string { return $address; }
    public function send(): bool {
        try {
            if (!$this->preSend()) return false;
            return $this->postSend();
        } catch (Exception $exc) {
            $this->mailHeader = '';
            $this->setError($exc->getMessage());
            if ($this->exceptions) throw $exc;
            return false;
        }
    }
    public function preSend(): bool {
        try {
            $this->error_count = 0;
            $this->mailHeader  = '';
            if (($this->Mailer === 'sendmail' || $this->Mailer === 'qmail') && !strip_tags($this->Body)) {
                throw new Exception($this->lang('empty_message'));
            }
            if (empty($this->From)) throw new Exception($this->lang('from_failed') . $this->From . ' : ');
            if (!$this->validateAddress($this->From)) throw new Exception($this->lang('from_failed') . $this->From . ' : ');
            $this->MIMEHeader = $this->createHeader();
            $this->MIMEBody   = $this->createBody();
            return true;
        } catch (Exception $exc) {
            $this->setError($exc->getMessage());
            if ($this->exceptions) throw $exc;
            return false;
        }
    }
    public function postSend(): bool {
        try {
            switch ($this->Mailer) {
                case 'sendmail':
                case 'qmail':    return $this->sendmailSend($this->MIMEHeader, $this->MIMEBody);
                case 'smtp':     return $this->smtpSend($this->MIMEHeader, $this->MIMEBody);
                case 'mail':     return $this->mailSend($this->MIMEHeader, $this->MIMEBody);
                default:
                    $this->setError(sprintf('%s: %s', $this->lang('invalid_mailer'), $this->Mailer));
                    return false;
            }
        } catch (Exception $exc) {
            $this->setError($exc->getMessage());
            if ($this->exceptions) throw $exc;
            return false;
        }
    }
    protected function sendmailSend(string $header, string $body): bool {
        $header = rtrim($header, "\r\n ") . "\r\n\r\n";
        if (empty($this->Sender) && ini_get('sendmail_from') === '') {
            throw new Exception($this->lang('extension_missing') . 'SendmailSend');
        }
        $toArr = [];
        foreach ($this->to as $toaddr) $toArr[] = $this->addrFormat($toaddr);
        $to = implode(', ', $toArr);
        if (!empty($this->Sender) && static::validateAddress($this->Sender)) {
            if ($this->Mailer === 'qmail') {
                $sendmail = sprintf('%s %s', escapeshellcmd($this->Sendmail), escapeshellarg("-f$this->Sender"));
            } else {
                $sendmail = sprintf('%s -oi -f%s -t', escapeshellcmd($this->Sendmail), escapeshellarg($this->Sender));
            }
        } elseif ($this->Mailer === 'qmail') {
            $sendmail = sprintf('%s', escapeshellcmd($this->Sendmail));
        } else {
            $sendmail = sprintf('%s -oi -t', escapeshellcmd($this->Sendmail));
        }
        $proc = @popen($sendmail, 'w');
        if (!$proc) throw new Exception($this->lang('execute') . $this->Sendmail, self::STOP_CRITICAL);
        fwrite($proc, $header);
        fwrite($proc, $body);
        $result = pclose($proc);
        if ($result !== 0) {
            throw new Exception($this->lang('execute') . $this->Sendmail);
        }
        return true;
    }
    protected function mailSend(string $header, string $body): bool {
        $toArr = [];
        foreach ($this->to as $toaddr) $toArr[] = $this->addrFormat($toaddr);
        $to = implode(', ', $toArr);
        $params = null;
        if (!empty($this->Sender) && static::validateAddress($this->Sender)) {
            if (self::isShellSafe($this->Sender)) {
                $params = sprintf('-f%s', $this->Sender);
            }
        }
        if (!empty($this->Sender) && static::validateAddress($this->Sender)) {
            $old_from = ini_get('sendmail_from');
            ini_set('sendmail_from', $this->Sender);
        }
        $result = false;
        if ($this->SingleToArray) {
            foreach ($this->to as $toaddr) {
                $result = $this->mailPassthru($toaddr[0], $this->Subject, $body, $header, $params ?? '');
            }
        } else {
            $result = $this->mailPassthru($to, $this->Subject, $body, $header, $params ?? '');
        }
        if (isset($old_from)) ini_set('sendmail_from', $old_from);
        if (!$result) throw new Exception($this->lang('instantiate'));
        return true;
    }
    protected function smtpConnect(array $options = []): bool {
        if (null === $this->smtp) $this->smtp = $this->getSMTPInstance();
        if ($this->smtp->connected()) return true;
        $this->smtp->setDebugLevel($this->SMTPDebug);
        $hosts = explode(';', $this->Host);
        $lastexception = null;
        foreach ($hosts as $hostentry) {
            $hostinfo = [];
            if (!preg_match('/^((ssl|tls):\/\/)*(.+?)(:(\d+))?$/', trim($hostentry), $hostinfo)) continue;
            $prefix  = $hostinfo[2] ?? '';
            $tls     = $this->SMTPSecure === 'tls' || ($this->SMTPAutoTLS && $prefix !== 'ssl');
            $host    = $hostinfo[3];
            $port    = (int)($hostinfo[5] ?? $this->Port);
            $secure  = $prefix === 'ssl' ? 'ssl' : '';
            $sslContext = $options['ssl'] ?? $this->SMTPOptions['ssl'] ?? [];
            try {
                if ($this->smtp->connect(($secure === 'ssl' ? 'ssl://' : '') . $host, $port, $this->Timeout, $sslContext)) {
                    try {
                        if ($this->Helo) { $this->smtp->hello($this->Helo); } else { $this->smtp->hello($this->serverHostname()); }
                        if ($tls && !$this->smtp->startTLS()) throw new Exception($this->lang('connect_host'));
                        if ($tls) {
                            if ($this->Helo) { $this->smtp->hello($this->Helo); } else { $this->smtp->hello($this->serverHostname()); }
                        }
                        if ($this->SMTPAuth && !$this->smtp->authenticate($this->Username, $this->Password, $this->AuthType, $this->oauth)) {
                            throw new Exception($this->lang('authenticate'));
                        }
                        return true;
                    } catch (Exception $exc) {
                        $lastexception = $exc;
                        $this->edebug('SMTP connect() failed. ' . $exc->getMessage());
                        $this->smtp->quit();
                    }
                }
            } catch (\Exception $exc) {
                $lastexception = new Exception($exc->getMessage());
                $this->edebug('Connection failed. Error #' . $exc->getCode() . ': ' . $exc->getMessage());
            }
        }
        $this->smtp->close();
        $this->edebug('SMTP connect() failed.');
        if ($this->exceptions && $lastexception !== null) throw $lastexception;
        return false;
    }
    protected function smtpSend(string $header, string $body): bool {
        $bad_rcpt = [];
        if (!$this->smtpConnect($this->SMTPOptions)) throw new Exception($this->lang('smtp_connect_failed'));
        if (!empty($this->Sender) && static::validateAddress($this->Sender)) {
            $smtp_from = $this->Sender;
        } else { $smtp_from = $this->From; }
        if (!$this->smtp->mail($smtp_from)) {
            $this->setError($this->lang('from_failed') . $smtp_from . ' : ' . implode(',', $this->smtp->getError()));
            throw new Exception($this->ErrorInfo);
        }
        $callbacks = [];
        foreach ([$this->to, $this->cc, $this->bcc] as $togroup) {
            foreach ($togroup as $to) {
                if (!$this->smtp->recipient($to[0])) {
                    $error       = $this->smtp->getError();
                    $bad_rcpt[]  = ['to' => $to[0], 'error' => $error['detail']];
                    $isSent      = false;
                } else {
                    $isSent = true;
                }
                $callbacks[] = ['issent'=>$isSent, 'to'=>$to[0], 'name'=>$to[1]];
            }
        }
        if ($this->AllFilesExist && count($bad_rcpt) === count($this->to) + count($this->cc) + count($this->bcc)) {
            $errstr = '';
            foreach ($bad_rcpt as $bad) { $errstr .= $bad['to'] . ': ' . $bad['error']; }
            throw new Exception($this->lang('recipients_failed') . $errstr);
        }
        if (!$this->smtp->data($header . $body)) {
            throw new Exception($this->lang('data_not_accepted'));
        }
        return true;
    }
    public function smtpClose(): void {
        if ($this->smtp !== null && $this->smtp->connected()) {
            $this->smtp->quit();
            $this->smtp->close();
        }
    }
    protected function getSMTPInstance(): SMTP { return new SMTP(); }
    public function getSMTPInstance2(): SMTP { return $this->getSMTPInstance(); }
    protected function lang(string $key): string {
        $language = [
            'authenticate'         => 'SMTP Error: Could not authenticate.',
            'buggy_php'            => 'Your version of PHP is affected by a bug that may result in corrupted messages. To fix it, switch to sending using SMTP, disable the mail.add_x_header option in your php.ini, switch to MacOS or Linux, or upgrade your PHP to version 7.0.17+ or 7.1.3+.',
            'connect_host'         => 'SMTP Error: Could not connect to SMTP host.',
            'data_not_accepted'    => 'SMTP Error: data not accepted.',
            'empty_message'        => 'Message body empty.',
            'encoding'             => 'Unknown encoding: ',
            'execute'              => 'Could not execute: ',
            'extension_missing'    => 'Extension missing: ',
            'file_access'          => 'Could not access file: ',
            'file_open'            => 'File Error: Could not open file: ',
            'from_failed'          => 'The following From address failed: ',
            'instantiate'          => 'Could not instantiate mail function.',
            'invalid_address'      => 'Invalid address',
            'invalid_header'       => 'Invalid header name or value',
            'invalid_hostentry'    => 'Invalid hostentry: ',
            'invalid_hotel'        => 'Invalid host: ',
            'invalid_mailer'       => 'Invalid Mailer',
            'mailer_not_supported' => ' mailer is not supported.',
            'provide_address'      => 'You must provide at least one recipient email address.',
            'recipients_failed'    => 'SMTP Error: The following recipients failed: ',
            'signing'              => 'Signing Error: ',
            'smtp_code'            => 'SMTP code: ',
            'smtp_code_ex'         => 'Additional SMTP info: ',
            'smtp_connect_failed'  => 'SMTP connect() failed.',
            'smtp_error'           => 'SMTP server error: ',
            'variable_set'         => 'Cannot set or reset variable: ',
            'wrong_init_order'     => 'Use of Debugoutput = "echo" in HTML context is not supported, use "html" or "error_log" instead.',
        ];
        return $language[$key] ?? "Language string failed to load: $key";
    }
    public function clearAddresses(): void { $this->to = []; $this->all_recipients = []; $this->RecipientsQueue = []; }
    public function clearCCs(): void { $this->cc = []; }
    public function clearBCCs(): void { $this->bcc = []; }
    public function clearReplyTos(): void { $this->reply_to = []; $this->ReplyToQueue = []; }
    public function clearAllRecipients(): void { $this->to = []; $this->cc = []; $this->bcc = []; $this->all_recipients = []; $this->RecipientsQueue = []; }
    public function clearAttachments(): void { $this->attachment = []; }
    public function clearCustomHeaders(): void { $this->CustomHeader = []; }
    protected function setError(string $msg): void { ++$this->error_count; $this->ErrorInfo = $msg; }
    public static function rfcDate(): string { return date('D, j M Y H:i:s O'); }
    protected function serverHostname(): string {
        $result = 'localhost.localdomain';
        if (!empty($this->Hostname)) { $result = $this->Hostname; }
        elseif (isset($_SERVER['SERVER_NAME']) && !empty($_SERVER['SERVER_NAME'])) { $result = $_SERVER['SERVER_NAME']; }
        elseif (isset($_SERVER['SERVER_ADDR']) && !empty($_SERVER['SERVER_ADDR'])) { $result = $_SERVER['SERVER_ADDR']; }
        return $result;
    }
    public static function isShellSafe(string $string): bool {
        if (escapeshellcmd($string) !== $string || !in_array(escapeshellarg($string), ["'$string'", "\"$string\""])) return false;
        return (bool)preg_match('/^[a-zA-Z0-9@_\-\.]+$/', $string);
    }
    public static function isPermittedPath(string $path): bool {
        return !preg_match('#^[a-z][a-z\d+\-.]*://#i', $path);
    }
    protected function addrFormat(array $addr): string {
        return empty($addr[1]) ? $this->secureHeader($addr[0]) : $this->encodeHeader($this->secureHeader($addr[1])) . ' <' . $this->secureHeader($addr[0]) . '>';
    }
    protected function secureHeader(string $str): string { return trim(str_replace(["\r", "\n"], '', $str)); }
    protected function encodeHeader(string $str, string $position = 'text'): string {
        $matchcount = preg_match_all('/[\200-\377]/', $str, $matches);
        if (!$matchcount) $matchcount += preg_match_all('/[\000-\010\013\014\016-\037\177-\377]/', $str, $matches);
        if ($matchcount === 0 && !preg_match('/[^\x20-\x7E]/', $str)) return $str;
        $maxlen = 75 - 7 - strlen($this->CharSet);
        if ($maxlen < 1) $maxlen = 1;
        if (strlen($str) > $maxlen) {
            return '=?' . $this->CharSet . '?B?' . base64_encode($str) . '?=';
        }
        return '=?' . $this->CharSet . '?B?' . base64_encode($str) . '?=';
    }
    protected function hasLineLongerThanMax(string $str): bool {
        return (bool)preg_match('/^(.{' . (self::MAX_LINE_LEN + 2) . ',})/m', $str);
    }
    protected function wrapText(string $message, int $length, bool $qp_mode = false): string {
        if ($qp_mode) $soft_break = sprintf(' =%s', self::CRLF); else $soft_break = self::CRLF;
        $message = $this->fixEOL($message);
        if (substr($message, -1) === "\n") $message = substr($message, 0, -1);
        $line = explode("\n", $message);
        $message    = '';
        $space_left = $length;
        foreach ($line as $line_num => $line_text) {
            if (strlen($line_text) <= $length) { $message .= $line_text . self::CRLF; }
            else {
                $space_left = $length;
                while (strlen($line_text) > 0) {
                    $idx = $length;
                    if (strlen($line_text) <= $idx) { $message .= $line_text; break; }
                    for ($i = $idx; $i >= 0; --$i) {
                        if (substr($line_text, $i, 1) === ' ') { $idx = $i; break; }
                    }
                    $line_part   = substr($line_text, 0, $idx);
                    $message    .= $line_part . $soft_break;
                    $line_text   = ltrim(substr($line_text, $idx + 1));
                }
                $message .= self::CRLF;
            }
        }
        return $message;
    }
    const CRLF       = "\r\n";
    const MAX_LINE_LEN = 998;
    const STOP_CONTINUE = 0;
    const STOP_NOMAIL   = 1;
    const STOP_CRITICAL = 2;

    public string $Helo     = '';
    public ?string $AuthType = '';
    public mixed $oauth     = null;
    public bool $AllFilesExist = false;

    protected function createHeader(): string {
        $result  = '';
        $result .= $this->headerLine('Date', self::rfcDate());
        if (!empty($this->Sender)) $result .= $this->headerLine('Return-Path', trim($this->Sender));
        if ($this->Mailer === 'mail') {
            if (count($this->to) > 0) { $result .= $this->addrAppend('To', $this->to); }
            elseif (empty($this->cc)) { $result .= $this->headerLine('To', 'undisclosed-recipients:;'); }
        }
        $from = [[trim($this->From), $this->FromName]];
        $result .= $this->addrAppend('From', $from);
        if (count($this->cc) > 0) $result .= $this->addrAppend('Cc', $this->cc);
        if ($this->Mailer !== 'mail' && count($this->to) > 0) $result .= $this->addrAppend('To', $this->to);
        if (count($this->reply_to) > 0) $result .= $this->addrAppend('Reply-To', $this->reply_to);
        if (!empty($this->Subject)) $result .= $this->headerLine('Subject', $this->encodeHeader($this->secureHeader($this->Subject)));
        if (!empty($this->MessageID) && preg_match('/^<.*@.*>$/', $this->MessageID)) { $this->lastMessageID = $this->MessageID; }
        else { $this->lastMessageID = sprintf('<%s@%s>', $this->uniqueid(), $this->serverHostname()); }
        $result .= $this->headerLine('Message-ID', (string)$this->lastMessageID);
        if (!empty($this->Priority)) $result .= $this->headerLine('X-Priority', (string)$this->Priority);
        if (empty($this->XMailer)) {
            $result .= $this->headerLine('X-Mailer', 'PHPMailer ' . self::VERSION . ' (https://github.com/PHPMailer/PHPMailer)');
        } elseif ($this->XMailer) {
            $result .= $this->headerLine('X-Mailer', trim($this->XMailer));
        }
        if (!empty($this->ConfirmReadingTo)) $result .= $this->headerLine('Disposition-Notification-To', '<' . trim($this->ConfirmReadingTo) . '>');
        foreach ($this->CustomHeader as $header) { $result .= $this->headerLine(trim($header[0]), $this->encodeHeader(trim($header[1]))); }
        if (!$this->sign_key_file) {
            $result .= $this->headerLine('MIME-Version', '1.0');
            $result .= $this->getMailMIME();
        }
        return $result;
    }
    public function getMailMIME(): string {
        $result = '';
        $ismultipart = true;
        switch ($this->message_type) {
            case 'inline': $result .= $this->headerLine('Content-Type', self::CONTENT_TYPE_MULTIPART_RELATED . ';' . self::CRLF . ' boundary="' . $this->boundary[1] . '"'); break;
            case 'attach':
            case 'inline_attach':
            case 'alt_attach':
            case 'alt_inline_attach':
                $result .= $this->headerLine('Content-Type', self::CONTENT_TYPE_MULTIPART_MIXED . ';' . self::CRLF . ' boundary="' . $this->boundary[1] . '"');
                break;
            case 'alt':
            case 'alt_inline':
                $result .= $this->headerLine('Content-Type', self::CONTENT_TYPE_MULTIPART_ALTERNATIVE . ';' . self::CRLF . ' boundary="' . $this->boundary[1] . '"');
                break;
            default:
                $result .= $this->textLine('Content-Type: ' . $this->ContentType . '; charset=' . $this->CharSet);
                $result .= $this->headerLine('Content-Transfer-Encoding', $this->Encoding);
                $ismultipart = false;
                break;
        }
        if (72 < strlen($this->mailHeader)) $this->mailHeader .= self::CRLF;
        return $result;
    }
    const CONTENT_TYPE_MULTIPART_ALTERNATIVE = 'multipart/alternative';
    const CONTENT_TYPE_MULTIPART_MIXED       = 'multipart/mixed';
    const CONTENT_TYPE_MULTIPART_RELATED     = 'multipart/related';

    protected function createBody(): string {
        $body    = '';
        $this->boundary[1] = $this->generateId();
        $this->boundary[2] = $this->generateId();
        $this->boundary[3] = $this->generateId();
        $this->setMessageType();
        switch ($this->message_type) {
            case '':
            case 'alt':
                if ($this->message_type === 'alt') {
                    $body  .= $this->getBoundary($this->boundary[1], '', self::CONTENT_TYPE_PLAINTEXT, '');
                    $body  .= $this->encodeString($this->AltBody, $this->Encoding);
                    $body  .= self::CRLF;
                    $body  .= $this->getBoundary($this->boundary[1], '', self::CONTENT_TYPE_TEXT_HTML, '');
                    $body  .= $this->encodeString($this->Body, $this->Encoding);
                    $body  .= self::CRLF;
                    $body  .= $this->endBoundary($this->boundary[1]);
                } else {
                    $body .= $this->encodeString($this->Body, $this->Encoding);
                }
                break;
            default:
                $body .= $this->encodeString($this->Body, $this->Encoding);
                break;
        }
        return $body;
    }
    protected function setMessageType(): void {
        $type = [];
        if ($this->alternativeExists()) $type[] = 'alt';
        if ($this->inlineImageExists()) $type[] = 'inline';
        if ($this->attachmentExists())  $type[] = 'attach';
        $this->message_type = implode('_', $type);
        if ($this->message_type === '') $this->message_type = '';
    }
    public function alternativeExists(): bool { return !empty($this->AltBody); }
    public function inlineImageExists(): bool {
        foreach ($this->attachment as $attachment) {
            if ($attachment[6] === 'inline') return true;
        }
        return false;
    }
    public function attachmentExists(): bool {
        foreach ($this->attachment as $attachment) {
            if ($attachment[6] === 'attachment') return true;
        }
        return false;
    }
    protected function getBoundary(string $boundary, string $charSet, string $contentType, string $encoding): string {
        $result = '';
        if ($charSet === '') $charSet = $this->CharSet;
        if ($contentType === '') $contentType = $this->ContentType;
        if ($encoding === '') $encoding = $this->Encoding;
        $result .= $this->textLine('--' . $boundary);
        $result .= sprintf("Content-Type: %s; charset=%s", $contentType, $charSet);
        $result .= self::CRLF;
        $result .= $this->headerLine('Content-Transfer-Encoding', $encoding);
        $result .= self::CRLF;
        return $result;
    }
    protected function endBoundary(string $boundary): string { return self::CRLF . '--' . $boundary . '--' . self::CRLF; }
    protected function encodeString(string $str, string $encoding = self::ENCODING_BASE64): string {
        switch (strtolower($encoding)) {
            case static::ENCODING_BASE64:        return chunk_split(base64_encode($str), self::STD_LINE_LEN, self::CRLF);
            case static::ENCODING_7BIT:
            case static::ENCODING_8BIT:          return $this->fixEOL($str);
            case static::ENCODING_BINARY:        return $str;
            case static::ENCODING_QP:
                $encoded = $this->encodeQP($str);
                if ($this->hasLineLongerThanMax($encoded)) $encoded = $this->wrapText($encoded, self::MAX_LINE_LEN - 1, true);
                return $encoded;
            default: throw new Exception($this->lang('encoding') . $encoding);
        }
    }
    const ENCODING_BINARY = 'binary';
    const STD_LINE_LEN    = 76;
    protected function encodeQP(string $str): string { return quoted_printable_encode($str); }
    protected function fixEOL(string $str): string {
        $nstr = str_replace(["\r\n", "\r", "\n"], "\n", $str);
        return str_replace("\n", self::CRLF, $nstr);
    }
    protected function headerLine(string $name, string $value): string { return $name . ': ' . $value . self::CRLF; }
    protected function textLine(string $value): string { return $value . self::CRLF; }
    protected function addrAppend(string $type, array $addr): string {
        $addresses = [];
        foreach ($addr as $address) $addresses[] = $this->addrFormat($address);
        return $this->headerLine($type, implode(', ', $addresses));
    }
    protected function getBoundary2(string $boundary, string $charSet, string $contentType, string $encoding): string { return $this->getBoundary($boundary, $charSet, $contentType, $encoding); }
    protected function generateId(): string { return sprintf('%s-%s.%s', date('YmdHis'), uniqid('', true), 'phpmailer'); }
    protected function uniqueid(): string { return sha1(uniqid((string)mt_rand(), true)); }
    public function addCustomHeader(string $name, string $value = null): bool {
        if ($value === null) {
            if (strpos($name, ':') === false) return false;
            $this->CustomHeader[] = [trim(substr($name, 0, strpos($name, ':'))), trim(substr($name, strpos($name, ':') + 1))];
        } else {
            $this->CustomHeader[] = [trim($name), trim($value)];
        }
        return true;
    }
    public function msgHTML(string $message, string $basedir = '', callable $advanced = null): string {
        preg_match_all('/(src|background)=["\'](.+?)["\']/i', $message, $images);
        $this->Body = $message;
        if (empty($this->AltBody)) $this->AltBody = $this->html2text($message);
        return $this->Body;
    }
    protected function html2text(string $html, bool $advanced = false): string {
        return html_entity_decode(strip_tags(preg_replace('/<br[^>]*>/i', "\n", $html)), ENT_QUOTES, $this->CharSet);
    }
    public function isError(): bool { return $this->error_count > 0; }
    public function addAttachment(string $path, string $name = '', string $encoding = self::ENCODING_BASE64, string $type = '', string $disposition = 'attachment'): bool {
        try {
            if (!self::isPermittedPath($path) || !@is_file($path)) {
                throw new Exception($this->lang('file_access') . $path);
            }
            if (empty($type)) $type = self::filenameToType($path);
            if (empty($name)) $name = basename($path);
            $this->attachment[] = [
                0 => $path, 1 => $name, 2 => $name, 3 => $encoding,
                4 => $type, 5 => false, 6 => $disposition, 7 => 0,
            ];
        } catch (Exception $exc) {
            $this->setError($exc->getMessage());
            if ($this->exceptions) throw $exc;
            return false;
        }
        return true;
    }
    public static function filenameToType(string $filename): string {
        $extensions = [
            'jpg|jpeg|jpe'  => 'image/jpeg',
            'gif'           => 'image/gif',
            'png'           => 'image/png',
            'pdf'           => 'application/pdf',
            'doc'           => 'application/msword',
            'xls'           => 'application/vnd.ms-excel',
            'zip'           => 'application/zip',
            'htm|html'      => 'text/html',
            'txt'           => 'text/plain',
        ];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        foreach ($extensions as $exts => $mime) {
            if (in_array($ext, explode('|', $exts))) return $mime;
        }
        return 'application/octet-stream';
    }
    public function getSentMIMEMessage(): string { return rtrim($this->MIMEHeader, "\n\r") . self::CRLF . self::CRLF . $this->MIMEBody; }
    public function createHeader2(): string { return $this->createHeader(); }
    public function getAllRecipientAddresses(): array { return $this->all_recipients; }
}
