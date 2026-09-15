<?php

declare(strict_types=1);

namespace Engine\AI\Contracts;

/**
 * The only seam through which the engine talks to any AI model. No provider
 * name (Claude, ChatGPT, Gemini, or otherwise) may appear anywhere outside an
 * implementation of this interface. Callers pass a system prompt, a user
 * prompt, and generic options — they never know or care which model answers.
 */
interface AiClientInterface
{
    /**
     * @param array{temperature?:float,max_tokens?:int} $options
     * @return string raw text completion (expected to be JSON for blueprint generation)
     */
    public function complete(string $systemPrompt, string $userPrompt, array $options = []): string;
}
