<?php

declare(strict_types=1);

namespace Engine\Strategy;

use Engine\AI\AiClientFactory;
use Engine\Core\ConfigLoader;
use Engine\Strategy\Contracts\ContentIntelligenceProviderInterface;
use Engine\Strategy\Providers\Ai\AiBlueprintProvider;
use Engine\Strategy\Providers\Manual\ManualBlueprintProvider;

/**
 * Orchestrator: niche name + config in, one Blueprint out. Provider is
 * selected by config/engine.yaml: content_intelligence_provider, so
 * switching between the manual stub and a real AI backend is a config
 * change, never an engine change.
 */
final class ContentIntelligencePipeline
{
    public function __construct(private readonly ContentIntelligenceProviderInterface $provider)
    {
    }

    public static function fromConfig(array $engineConfig, string $rootPath): self
    {
        $providerName = $engineConfig['content_intelligence_provider'] ?? 'manual';

        $provider = match ($providerName) {
            'manual' => new ManualBlueprintProvider($rootPath),
            'ai' => self::buildAiProvider($rootPath),
            default => throw new \RuntimeException(
                "Unknown content_intelligence_provider '{$providerName}'. " .
                'Implement Engine\\Strategy\\Contracts\\ContentIntelligenceProviderInterface and register it here.',
            ),
        };

        return new self($provider);
    }

    private static function buildAiProvider(string $rootPath): AiBlueprintProvider
    {
        $aiConfig = ConfigLoader::loadYaml("{$rootPath}/config/ai.yaml");
        $client = AiClientFactory::fromConfig($aiConfig);

        return new AiBlueprintProvider($client, "{$rootPath}/ai/AI_RULES.md");
    }

    public function run(string $niche, array $config = []): Blueprint
    {
        return $this->provider->generate($niche, $config);
    }
}
