<?php

declare(strict_types=1);

namespace Engine\Strategy\Providers\Ai;

use Engine\AI\Contracts\AiClientInterface;
use Engine\Strategy\Blueprint;
use Engine\Strategy\Contracts\ContentIntelligenceProviderInterface;
use Engine\Strategy\QualityGate;

/**
 * Produces one complete Blueprint from a niche name + config via a single
 * call to a model-agnostic AiClientInterface (see ai/AI_RULES.md rule 7:
 * one blueprint call, not chained research/keyword/content/FAQ calls). The
 * model never sees engine internals — only the niche, optional config, and
 * ai/AI_RULES.md, and must answer with one JSON object matching the
 * Blueprint schema. Output always passes through QualityGate before it is
 * returned, so prompt compliance is verified, not assumed.
 */
final class AiBlueprintProvider implements ContentIntelligenceProviderInterface
{
    public function __construct(
        private readonly AiClientInterface $client,
        private readonly string $rulesPath,
        private readonly QualityGate $qualityGate = new QualityGate(),
    ) {
    }

    public function generate(string $niche, array $config): Blueprint
    {
        $rules = is_file($this->rulesPath) ? (string) file_get_contents($this->rulesPath) : '';

        $raw = $this->client->complete(
            $this->systemPrompt($rules),
            $this->userPrompt($niche, $config),
            [
                'temperature' => $config['temperature'] ?? 0.4,
                'max_tokens' => $config['max_tokens'] ?? 4000,
            ],
        );

        $blueprint = Blueprint::fromArray($niche, $this->decode($raw));

        return $this->qualityGate->review($blueprint);
    }

    private function systemPrompt(string $rules): string
    {
        return <<<PROMPT
You are an elite Technical SEO strategist, Information Architect, Content
Strategist, and Conversion Optimizer, generating the complete content
strategy for one new subdomain of a multi-site SEO engine.

You must follow these permanent rules exactly. They are not suggestions:

{$rules}

Respond with exactly one JSON object and nothing else — no prose, no markdown
code fences, no commentary before or after. It must match this shape:

{
  "niche_analysis": {
    "audience": "string",
    "business_model": "string",
    "value_proposition": "string",
    "competitive_notes": "string"
  },
  "topical_map": {
    "pillars": [
      {
        "slug": "kebab-case",
        "title": "string",
        "clusters": [
          {"slug": "kebab-case", "title": "string", "intent": "informational|commercial|transactional|navigational"}
        ]
      }
    ]
  },
  "keyword_architecture": {
    "<page-slug>": {"primary_keyword": "string", "supporting_keywords": ["string"], "intent": "string"}
  },
  "entity_map": ["string"],
  "category_structure": [{"slug": "kebab-case", "title": "string"}],
  "product_structure": [{"slug": "kebab-case", "category_slug": "kebab-case", "title": "string", "description": "string"}],
  "page_blueprint": {
    "<page-slug>": {"title": "string", "type": "pillar|cluster|page", "outline": ["string", "string", "string"], "primary_keyword": "string", "meta_description": "string, unique per page, never the same text reused across pages"}
  },
  "faq_blueprint": {
    "<page-slug>": [{"question": "string", "answer": "string"}]
  },
  "internal_linking_plan": {
    "<page-slug>": ["<related-page-slug>"]
  },
  "schema_blueprint": {
    "<page-slug>": {"type": "WebPage|FAQPage|Product|Organization|Article"}
  },
  "seo_metadata": {
    "title_template": "{page_title} | {brand}",
    "default_description": "string",
    "schema_type_map": {"page": "WebPage", "faq": "FAQPage", "product": "Product"}
  }
}

Every "<page-slug>" key must reference a slug that also appears in
page_blueprint. Only include a page if it has genuine ranking potential and a
clear role in topical authority — if the niche cannot support enough depth
for a page, omit that page entirely rather than filling it with thin content.
Never fabricate facts, certifications, testimonials, or statistics.
PROMPT;
    }

    private function userPrompt(string $niche, array $config): string
    {
        $extra = array_diff_key($config, array_flip(['temperature', 'max_tokens', 'name']));

        return "Niche name: {$niche}\n"
            . 'Optional configuration (JSON, may be empty): '
            . json_encode($extra, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    private function decode(string $raw): array
    {
        $cleaned = trim($raw);
        $cleaned = preg_replace('/^```(?:json)?\s*|\s*```$/m', '', $cleaned) ?? $cleaned;
        $data = json_decode(trim($cleaned), true);

        if (!is_array($data)) {
            throw new \RuntimeException('AI provider did not return a valid JSON blueprint.');
        }

        return $data;
    }
}
