<?php
/**
 * GeminiClient — FREE alternative to ClaudeClient using Google Gemini.
 *
 * Gemini's free tier (Google AI Studio key) is generous enough for this site's
 * chat + lead scoring + caption needs. Get a key at https://aistudio.google.com.
 *
 * It EXTENDS ClaudeClient and only overrides message()/post(), so every
 * higher-level method (scoreLead, generateCaptions, answerK3Question,
 * analyzeDocument, extractIncidentData) keeps working unchanged — they all
 * call $this->message() internally.
 */
require_once __DIR__ . '/ClaudeClient.php';

class GeminiClient extends ClaudeClient {
    /** gemini-2.0-flash has 0 free-tier quota on this account; flash-lite works. */
    private const MODEL_DEFAULT = 'gemini-2.5-flash-lite';
    private const ENDPOINT = 'https://generativelanguage.googleapis.com/v1beta/models/%s:generateContent?key=%s';

    private string $key;
    private int    $to;

    public function __construct(string $apiKey = '', int $timeout = 30) {
        // Don't call parent ctor (it expects a Claude key). Keep our own.
        $this->key = $apiKey ?: (defined('GEMINI_API_KEY') ? GEMINI_API_KEY : '');
        $this->to  = $timeout;
    }

    public function isConfigured(): bool { return !empty($this->key); }

    /**
     * Same signature/return shape as ClaudeClient::message().
     * The $model arg is ignored unless a gemini-* model is passed, so the
     * inherited methods that pass 'claude-haiku-4-5' transparently use Gemini.
     */
    public function message(
        string $prompt,
        string $system    = '',
        string $model     = self::MODEL_DEFAULT,
        int    $maxTokens = 1024,
        bool   $jsonMode  = false
    ): array {
        if (!$this->isConfigured()) {
            return ['success'=>false,'text'=>'','error'=>'Gemini API key not configured','tokens'=>0];
        }
        if (strncmp($model, 'gemini', 6) !== 0) $model = self::MODEL_DEFAULT;

        $body = [
            'contents' => [[
                'role'  => 'user',
                'parts' => [['text' => $prompt]],
            ]],
            'generationConfig' => array_merge(['maxOutputTokens' => $maxTokens, 'temperature' => 0.7], $jsonMode ? ['responseMimeType' => 'application/json'] : []),
        ];
        if ($system !== '') {
            $body['system_instruction'] = ['parts' => [['text' => $system]]];
        }

        $url = sprintf(self::ENDPOINT, $model, $this->key);
        $res = $this->geminiPost($url, $body);
        if (!$res['success']) return ['success'=>false,'text'=>'','error'=>$res['error'],'tokens'=>0];

        $data = $res['data'];
        $text = $data['candidates'][0]['content']['parts'][0]['text'] ?? '';
        $tok  = ($data['usageMetadata']['promptTokenCount'] ?? 0)
              + ($data['usageMetadata']['candidatesTokenCount'] ?? 0);
        return ['success'=>true,'text'=>trim($text),'error'=>'','tokens'=>$tok];
    }

    private function geminiPost(string $url, array $body): array {
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => $this->to,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => json_encode($body, JSON_UNESCAPED_UNICODE),
            CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
            CURLOPT_SSL_VERIFYPEER => true,
        ]);
        $response = curl_exec($ch);
        $err      = curl_error($ch);
        $code     = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($err || $response === false) return ['success'=>false,'data'=>null,'error'=>$err];
        $data = json_decode($response, true);
        if ($code >= 400) {
            return ['success'=>false,'data'=>$data,'error'=>$data['error']['message'] ?? $response];
        }
        return ['success'=>true,'data'=>$data,'error'=>''];
    }
}
