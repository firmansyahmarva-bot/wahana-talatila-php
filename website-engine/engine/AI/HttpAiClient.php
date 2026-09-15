<?php

declare(strict_types=1);

namespace Engine\AI;

use Engine\AI\Contracts\AiClientInterface;

/**
 * Generic adapter for any OpenAI-compatible chat-completions HTTP endpoint —
 * a de facto standard implemented by many hosted providers, gateways, and
 * local inference servers. Every detail that would tie this to one vendor
 * (endpoint, model name, headers, API key) comes from config/ai.yaml and an
 * environment variable, never hardcoded here. Swapping models or providers is
 * a config change, not a code change.
 */
final class HttpAiClient implements AiClientInterface
{
    public function __construct(
        private readonly string $endpoint,
        private readonly string $model,
        private readonly string $apiKey,
        private readonly array $extraHeaders = [],
        private readonly int $timeoutSeconds = 60,
    ) {
    }

    public function complete(string $systemPrompt, string $userPrompt, array $options = []): string
    {
        $payload = [
            'model' => $this->model,
            'messages' => [
                ['role' => 'system', 'content' => $systemPrompt],
                ['role' => 'user', 'content' => $userPrompt],
            ],
            'temperature' => $options['temperature'] ?? 0.4,
            'max_tokens' => $options['max_tokens'] ?? 4000,
        ];

        $headers = array_merge([
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->apiKey,
        ], $this->extraHeaders);

        $ch = curl_init($this->endpoint);
        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_POSTFIELDS => json_encode($payload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => $this->timeoutSeconds,
        ]);

        $response = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        if ($response === false) {
            throw new \RuntimeException("AI request failed: {$error}");
        }
        if ($status < 200 || $status >= 300) {
            throw new \RuntimeException("AI request returned HTTP {$status}: " . substr((string) $response, 0, 500));
        }

        $decoded = json_decode((string) $response, true);
        $content = $decoded['choices'][0]['message']['content'] ?? null;

        if (!is_string($content)) {
            throw new \RuntimeException('AI response did not contain expected choices[0].message.content.');
        }

        return $content;
    }
}
