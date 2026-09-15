<?php
/**
 * EvolutionClient — minimal cURL wrapper for Evolution API (open source WhatsApp).
 * Hosted free on Railway.app. Falls back to wa.me links when Evolution is not configured.
 */
class EvolutionClient {
    private string $baseUrl;
    private string $apiKey;
    private string $instance;
    private bool   $enabled;

    public function __construct() {
        $this->baseUrl  = defined('EVO_URL')      ? EVO_URL      : '';
        $this->apiKey   = defined('EVO_API_KEY')  ? EVO_API_KEY  : '';
        $this->instance = defined('EVO_INSTANCE') ? EVO_INSTANCE : '';
        $this->enabled  = !empty($this->baseUrl) && !empty($this->apiKey) && !empty($this->instance);
    }

    public function isEnabled(): bool { return $this->enabled; }

    /**
     * Send a WhatsApp text message.
     * @param  string $to   Phone number with country code (e.g. 628123456789)
     * @param  string $text Message text
     * @return array        ['success'=>bool,'data'=>mixed,'error'=>string]
     */
    public function sendText(string $to, string $text): array {
        if (!$this->enabled) {
            return ['success'=>false,'data'=>null,'error'=>'Evolution API not configured — use wa.me link instead'];
        }
        $to = preg_replace('/\D/', '', $to);
        if (!str_starts_with($to, '62')) $to = '62' . ltrim($to, '0');

        $payload = json_encode([
            'number'  => $to . '@s.whatsapp.net',
            'options' => ['delay' => 1200, 'presence' => 'composing'],
            'textMessage' => ['text' => $text],
        ]);
        return $this->request('POST', "/message/sendText/{$this->instance}", $payload);
    }

    public function sendMedia(string $to, string $mediaUrl, string $mediaType, string $caption = ''): array {
        if (!$this->enabled) return ['success'=>false,'data'=>null,'error'=>'Not configured'];
        $to = preg_replace('/\D/', '', $to);
        if (!str_starts_with($to, '62')) $to = '62' . ltrim($to, '0');
        $payload = json_encode([
            'number'       => $to . '@s.whatsapp.net',
            'options'      => ['delay' => 1200],
            'mediaMessage' => ['mediatype' => $mediaType, 'media' => $mediaUrl, 'caption' => $caption],
        ]);
        return $this->request('POST', "/message/sendMedia/{$this->instance}", $payload);
    }

    public function getQrCode(): array {
        return $this->request('GET', "/instance/connect/{$this->instance}");
    }

    public function checkConnectionState(): array {
        return $this->request('GET', "/instance/connectionState/{$this->instance}");
    }

    private function request(string $method, string $endpoint, string $body = ''): array {
        $url = rtrim($this->baseUrl, '/') . $endpoint;
        $ch  = curl_init($url);
        $headers = [
            'Content-Type: application/json',
            'apikey: ' . $this->apiKey,
        ];
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 15,
            CURLOPT_HTTPHEADER     => $headers,
            CURLOPT_SSL_VERIFYPEER => true,
        ]);
        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        }
        $response = curl_exec($ch);
        $err      = curl_error($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($err) return ['success'=>false,'data'=>null,'error'=>$err];
        $data = json_decode($response, true);
        return ['success' => $httpCode >= 200 && $httpCode < 300, 'data' => $data, 'error' => $httpCode >= 400 ? ($data['message'] ?? $response) : ''];
    }

    /**
     * Fallback: generate wa.me URL for a message.
     */
    public static function waLink(string $phone, string $message = ''): string {
        $phone = preg_replace('/\D/', '', $phone);
        if (!str_starts_with($phone, '62')) $phone = '62' . ltrim($phone, '0');
        return 'https://wa.me/' . $phone . ($message ? '?text=' . rawurlencode($message) : '');
    }
}
