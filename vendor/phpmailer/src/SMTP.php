<?php
namespace PHPMailer\PHPMailer;
class SMTP {
    const VERSION        = '6.8.1';
    const CRLF           = "\r\n";
    const DEFAULT_PORT   = 25;
    const MAX_LINE_LEN   = 998;
    const DEBUG_OFF      = 0;
    const DEBUG_CLIENT   = 1;
    const DEBUG_SERVER   = 2;
    const DEBUG_CONNECTION = 3;
    const DEBUG_LOWLEVEL = 4;
    public int $Priority = 3;
    public string $CharSet = PHPMailer::CHARSET_UTF8;
    public string $ContentType = PHPMailer::CONTENT_TYPE_PLAINTEXT;
    public int $WordWrap = 0;
    public int $Debugoutput = 0;
    public bool $do_verp = false;
    public int $Timeout = 300;
    public float $Timelimit = 30;
    public bool $SMTPAutoTLS = true;
    public bool $SMTPAuth = false;
    public ?string $SMTPAuthType = '';
    public string $SMTPXClientID = '';
    public array $SMTPOptions = [];
    public int $Port = self::DEFAULT_PORT;

    protected $smtp_conn;
    protected string $error = '';
    protected array $helo_rply = [];
    protected array $server_caps = [];
    protected string $last_reply = '';

    public function connect(string $host, int $port = null, int $timeout = 30, array $options = []): bool {
        $this->setError('');
        if ($this->connected()) $this->close();
        if (empty($port)) $port = self::DEFAULT_PORT;
        $this->edebug("Connection: opening to $host:$port, timeout=$timeout, options=" . var_export($options, true));
        $errno  = 0; $errstr = '';
        set_error_handler([$this, 'errorHandler']);
        if (!empty($options) && version_compare(PHP_VERSION, '5.6.0', '>=')) {
            $ssl_context = stream_context_create(['ssl' => $options]);
            $this->smtp_conn = stream_socket_client(
                "$host:$port", $errno, $errstr, $timeout, STREAM_CLIENT_CONNECT, $ssl_context
            );
        } else {
            $this->smtp_conn = fsockopen($host, $port, $errno, $errstr, $timeout);
        }
        restore_error_handler();
        if (!is_resource($this->smtp_conn)) {
            $this->setError('Failed to connect to server', $errno, $errstr);
            return false;
        }
        $socket_timeout = ini_get('default_socket_timeout');
        stream_set_timeout($this->smtp_conn, $timeout);
        $announce = $this->get_lines();
        $this->edebug("SMTP SERVER -> CLIENT: $announce");
        return true;
    }
    public function startTLS(): bool {
        if (!$this->sendCommand('STARTTLS', 'STARTTLS', 220)) return false;
        $crypto_method = STREAM_CRYPTO_METHOD_TLS_CLIENT;
        if (defined('STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT')) {
            $crypto_method |= STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT;
            $crypto_method |= STREAM_CRYPTO_METHOD_TLSv1_1_CLIENT;
        }
        if (!stream_socket_enable_crypto($this->smtp_conn, true, $crypto_method)) return false;
        return true;
    }
    public function authenticate(string $username, string $password, string $authtype = null, $OAuth = null): bool {
        if (!$this->server_caps) {
            $this->setError('Authentication is not allowed before HELO/EHLO');
            return false;
        }
        if (array_key_exists('EHLO', $this->server_caps)) {
            if (!array_key_exists('AUTH', $this->server_caps)) {
                $this->setError('Authentication is not supported by server');
                return false;
            }
            $this->server_caps['AUTH'] = (array)$this->server_caps['AUTH'];
        }
        if (empty($authtype)) {
            $authtypes = ['LOGIN','PLAIN','CRAM-MD5'];
            foreach ($authtypes as $atype) {
                if (isset($this->server_caps['AUTH']) && in_array($atype, $this->server_caps['AUTH'])) {
                    $authtype = $atype; break;
                }
            }
            if (!$authtype) { $this->setError('No supported authentication mechanisms found'); return false; }
        }
        switch ($authtype) {
            case 'PLAIN':
                if (!$this->sendCommand('AUTH', 'AUTH PLAIN ' . base64_encode("\0$username\0$password"), 235)) return false;
                break;
            case 'LOGIN':
                if (!$this->sendCommand('AUTH', 'AUTH LOGIN', 334)) return false;
                if (!$this->sendCommand('Username', base64_encode($username), 334)) return false;
                if (!$this->sendCommand('Password', base64_encode($password), 235)) return false;
                break;
            case 'CRAM-MD5':
                if (!$this->sendCommand('AUTH CRAM-MD5', 'AUTH CRAM-MD5', 334)) return false;
                $challenge = base64_decode(substr($this->last_reply, 4));
                $response  = $username . ' ' . hash_hmac('md5', $challenge, $password);
                if (!$this->sendCommand('Username', base64_encode($response), 235)) return false;
                break;
            default:
                $this->setError("Authentication method $authtype is not supported");
                return false;
        }
        return true;
    }
    public function connected(): bool {
        if (is_resource($this->smtp_conn)) {
            $sock_status = stream_get_meta_data($this->smtp_conn);
            return !$sock_status['eof'];
        }
        return false;
    }
    public function close(): void {
        $this->setError('');
        $this->server_caps = [];
        $this->helo_rply   = [];
        if (is_resource($this->smtp_conn)) {
            fclose($this->smtp_conn);
            $this->smtp_conn = null;
        }
    }
    public function data(string $msg_data): bool {
        if (!$this->sendCommand('DATA', 'DATA', 354)) return false;
        $lines    = explode("\n", str_replace(["\r\n", "\r"], "\n", $msg_data));
        $field    = substr($lines[0], 0, strpos($lines[0], ':'));
        $in_body  = false;
        $max_line_len = self::MAX_LINE_LEN;
        foreach ($lines as $line) {
            $lines_out = [];
            if ($line === '' && $field !== '') $in_body = true;
            if ($in_body && isset($line[0]) && $line[0] === '.') $line = '.' . $line;
            while (isset($line[self::MAX_LINE_LEN])) {
                $pos = strrpos(substr($line, 0, self::MAX_LINE_LEN), ' ');
                if ($pos === false) {
                    $pos = self::MAX_LINE_LEN - 1;
                    $lines_out[] = substr($line, 0, $pos + 1);
                    $line = substr($line, $pos + 1);
                } else {
                    $lines_out[] = substr($line, 0, $pos);
                    $line = substr($line, $pos + 1);
                }
            }
            $lines_out[] = $line;
            foreach ($lines_out as $line_out) {
                if (isset($line_out[0]) && $line_out[0] !== '.') {
                    $this->client_send($line_out . self::CRLF);
                } else {
                    $this->client_send($line_out . self::CRLF);
                }
            }
        }
        return $this->sendCommand('DATA END', '.', 250);
    }
    public function hello(string $host = ''): bool {
        return $this->sendHello('EHLO', $host) || $this->sendHello('HELO', $host);
    }
    protected function sendHello(string $hello, string $host): bool {
        $noerror = $this->sendCommand($hello, "$hello $host", 250);
        $this->helo_rply = $this->last_reply;
        if ($noerror) {
            $this->parseHelloFields($hello);
        } else {
            $this->server_caps = [];
        }
        return $noerror;
    }
    protected function parseHelloFields(string $type): void {
        $this->server_caps = [];
        $lines = explode("\n", $this->last_reply);
        foreach ($lines as $n => $s) {
            $s = trim(substr($s, 4));
            if ($s === '') continue;
            $fields = explode(' ', $s);
            if ($fields) {
                if ($n === 0) $this->server_caps['HELO'] = $s;
                $name = array_shift($fields);
                $this->server_caps[$name] = $fields ?: true;
            }
        }
    }
    public function mail(string $from): bool {
        $useVerp = $this->do_verp ? ' XVERP' : '';
        return $this->sendCommand('MAIL FROM', "MAIL FROM:<$from>$useVerp", 250);
    }
    public function quit(bool $close_on_error = true): bool {
        $noerror = $this->sendCommand('QUIT', 'QUIT', 221);
        $err = $this->error;
        if ($noerror || $close_on_error) $this->close();
        $this->error = $err;
        return $noerror;
    }
    public function recipient(string $address, int $dsn_notifications = 0): bool {
        $rcpt = "RCPT TO:<$address>";
        if ($dsn_notifications) {
            $dsn = [];
            if ($dsn_notifications & 4) $dsn[] = 'SUCCESS';
            if ($dsn_notifications & 2) $dsn[] = 'FAILURE';
            if ($dsn_notifications & 1) $dsn[] = 'DELAY';
            if ($dsn) $rcpt .= ' NOTIFY=' . implode(',', $dsn);
        }
        return $this->sendCommand('RCPT TO', $rcpt, [250, 251]);
    }
    public function reset(): bool { return $this->sendCommand('RESET', 'RSET', 250); }
    protected function sendCommand(string $command, string $commandstring, $expect): bool {
        if (!$this->connected()) {
            $this->setError("Called $command without being connected");
            return false;
        }
        if (str_contains($commandstring, "\n") || str_contains($commandstring, "\r")) {
            $this->setError("Command '$command' contained line breaks");
            return false;
        }
        $this->client_send($commandstring . self::CRLF, $command);
        $this->last_reply = $this->get_lines();
        $matches = [];
        if (preg_match('/^(\d{3})[ -]/m', $this->last_reply, $matches)) {
            $code = (int)$matches[1];
        } else {
            $this->setError("Invalid response '$this->last_reply'");
            return false;
        }
        $expect = (array)$expect;
        if (!in_array($code, $expect, true)) {
            $this->setError("Command: '$commandstring', Response: '$this->last_reply'");
            return false;
        }
        return true;
    }
    public function sendAndMail(string $from): bool { return $this->sendCommand('SAML', "SAML FROM:<$from>", 250); }
    public function verify(string $name): bool { return $this->sendCommand('VRFY', "VRFY $name", [250, 251, 252]); }
    public function noop(): bool { return $this->sendCommand('NOOP', 'NOOP', 250); }
    public function turn(): bool { $this->setError('SMTP TURN not implemented'); return false; }
    public function client_send(string $data, string $command = ''): int|bool {
        if (is_resource($this->smtp_conn)) return fwrite($this->smtp_conn, $data);
        return false;
    }
    public function getError(): array { return $this->error ? ['error'=>$this->error,'detail'=>'','smtp_code'=>'','smtp_msg'=>''] : []; }
    public function getServerExtList(): ?array { return $this->server_caps; }
    public function getServerExt(string $name): string|bool|array|null {
        if (!$this->server_caps) {
            $this->setError('No HELO/EHLO was sent');
            return null;
        }
        return $this->server_caps[$name] ?? false;
    }
    public function getLastReply(): string { return $this->last_reply; }
    protected function get_lines(): string {
        if (!is_resource($this->smtp_conn)) return '';
        $data      = '';
        $endtime   = 0;
        stream_set_timeout($this->smtp_conn, (int)$this->Timeout);
        if ($this->Timelimit > 0) $endtime = time() + (int)$this->Timelimit;
        $selR = [$this->smtp_conn]; $selW = null;
        while (is_resource($this->smtp_conn) && !feof($this->smtp_conn)) {
            set_error_handler([$this, 'errorHandler']);
            $n = stream_select($selR, $selW, $selW, $this->Timelimit);
            restore_error_handler();
            if ($n === false) break;
            $str = @fgets($this->smtp_conn, 515);
            $data .= $str;
            if (isset($str[3]) && $str[3] === ' ') break;
            $info = stream_get_meta_data($this->smtp_conn);
            if ($info['timed_out'] || ($endtime && time() > $endtime)) break;
        }
        return $data;
    }
    protected function edebug(string $str): void {
        if ($this->Debugoutput < self::DEBUG_CLIENT) return;
        if (is_callable($this->Debugoutput)) { call_user_func($this->Debugoutput, $str, 0); return; }
        if ($this->Debugoutput === 'error_log') { error_log($str); return; }
        echo htmlspecialchars($str, ENT_QUOTES) . "\n";
    }
    protected function setError(string $msg, string $detail = '', string $smtp_code = '', string $smtp_msg = ''): void {
        $this->error = ['error'=>$msg,'detail'=>$detail,'smtp_code'=>$smtp_code,'smtp_msg'=>$smtp_msg];
    }
    protected function errorHandler(int $errno, string $errmsg, string $errfile = '', int $errline = 0): bool {
        $notice = "Connection failed. System message: $errmsg";
        $this->setError($notice);
        return true;
    }
}
