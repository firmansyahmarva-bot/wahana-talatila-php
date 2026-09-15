<?php

declare(strict_types=1);

namespace Engine\Strategy\Contracts;

use Engine\Strategy\Blueprint;

/**
 * The only seam for future AI-driven subdomain generation. Implementations
 * take a niche name + config and return one complete Blueprint in a single
 * call — no per-stage interfaces, no chained prompts (see ai/AI_RULES.md
 * rule 5 and ai/PROJECT_MEMORY.md).
 *
 * Selected via config/engine.yaml: content_intelligence_provider.
 * Today: Manual (stub placeholders). Later: an AI implementation of this
 * same interface — the pipeline, generator, and engine do not change.
 */
interface ContentIntelligenceProviderInterface
{
    public function generate(string $niche, array $config): Blueprint;
}
