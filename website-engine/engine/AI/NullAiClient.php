<?php

declare(strict_types=1);

namespace Engine\AI;

use Engine\AI\Contracts\AiClientInterface;

/**
 * Safe default when no AI backend is configured. Fails loudly and clearly at
 * the moment generation is attempted, instead of the factory silently
 * guessing or the engine crashing obscurely deeper in the pipeline.
 */
final class NullAiClient implements AiClientInterface
{
    public function __construct(private readonly string $reason)
    {
    }

    public function complete(string $systemPrompt, string $userPrompt, array $options = []): string
    {
        throw new \RuntimeException(
            "No AI client configured ({$this->reason}). Set content_intelligence_provider: ai " .
            'in config/engine.yaml and complete config/ai.yaml (enabled, endpoint, model, api_key_env).',
        );
    }
}
