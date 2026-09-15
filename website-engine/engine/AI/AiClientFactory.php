<?php

declare(strict_types=1);

namespace Engine\AI;

use Engine\AI\Contracts\AiClientInterface;

/**
 * Reads config/ai.yaml and produces whichever AiClientInterface it
 * describes. This is the single place model/provider selection happens —
 * everything upstream (ContentIntelligencePipeline, AiBlueprintProvider)
 * only ever sees AiClientInterface.
 */
final class AiClientFactory
{
    public static function fromConfig(array $aiConfig): AiClientInterface
    {
        if (($aiConfig['enabled'] ?? false) !== true) {
            return new NullAiClient('config/ai.yaml: enabled is not true');
        }

        $endpoint = (string) ($aiConfig['endpoint'] ?? '');
        $model = (string) ($aiConfig['model'] ?? '');
        $apiKeyEnv = (string) ($aiConfig['api_key_env'] ?? '');
        $apiKey = $apiKeyEnv !== '' ? (string) getenv($apiKeyEnv) : '';

        if ($endpoint === '' || $model === '') {
            return new NullAiClient('config/ai.yaml: endpoint and model are required');
        }
        if ($apiKey === '') {
            return new NullAiClient("environment variable '{$apiKeyEnv}' is not set");
        }

        return new HttpAiClient(
            endpoint: $endpoint,
            model: $model,
            apiKey: $apiKey,
            extraHeaders: $aiConfig['extra_headers'] ?? [],
            timeoutSeconds: (int) ($aiConfig['timeout_seconds'] ?? 60),
        );
    }
}
