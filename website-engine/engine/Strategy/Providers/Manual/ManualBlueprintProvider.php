<?php

declare(strict_types=1);

namespace Engine\Strategy\Providers\Manual;

use Engine\Strategy\Blueprint;
use Engine\Strategy\Contracts\ContentIntelligenceProviderInterface;
use Engine\Support\Yaml;

/**
 * Default provider. No research, no AI — every fact and page is supplied by
 * a human. Two modes, selected by whether `blueprint_file` is present in the
 * config passed to generate():
 *
 * - `blueprint_file` given: load a hand-authored blueprint (same JSON/YAML
 *   shape the AI provider emits — niche_analysis, topical_map,
 *   keyword_architecture, page_blueprint, faq_blueprint,
 *   internal_linking_plan, category_structure, product_structure,
 *   schema_blueprint, seo_metadata) via Blueprint::fromArray. Lets a subdomain
 *   get a real pillar/cluster architecture without an AI backend configured.
 * - otherwise: fall back to the original tiny generic stub (1 pillar, 2
 *   clusters) — enough to prove the pipeline end-to-end.
 *
 * Never niche-specific: this class has no knowledge of any particular
 * subdomain's content, only how to read the generic blueprint contract.
 */
final class ManualBlueprintProvider implements ContentIntelligenceProviderInterface
{
    public function __construct(private readonly string $rootPath = '')
    {
    }

    public function generate(string $niche, array $config): Blueprint
    {
        $blueprintFile = $config['blueprint_file'] ?? null;
        if (is_string($blueprintFile) && $blueprintFile !== '') {
            return $this->fromFile($niche, $blueprintFile);
        }

        return $this->genericStub($niche);
    }

    private function fromFile(string $niche, string $blueprintFile): Blueprint
    {
        $path = $this->isAbsolute($blueprintFile) || $this->rootPath === ''
            ? $blueprintFile
            : "{$this->rootPath}/{$blueprintFile}";

        if (!is_file($path)) {
            throw new \RuntimeException("Manual blueprint file not found: {$path}");
        }

        return Blueprint::fromArray($niche, Yaml::parseFile($path));
    }

    private function isAbsolute(string $path): bool
    {
        return str_starts_with($path, '/') || preg_match('#^[A-Za-z]:[\\\\/]#', $path) === 1;
    }

    private function genericStub(string $niche): Blueprint
    {
        $nicheLabel = ucwords(str_replace(['-', '_'], ' ', $niche));
        $pillarSlug = 'home';
        $clusterSlugs = ['overview', 'getting-started'];

        $topicalMap = [
            'pillars' => [[
                'slug' => $pillarSlug,
                'title' => $nicheLabel,
                'clusters' => array_map(
                    fn ($slug) => [
                        'slug' => $slug,
                        'title' => $nicheLabel . ' ' . ucwords(str_replace('-', ' ', $slug)),
                        'intent' => 'informational',
                    ],
                    $clusterSlugs,
                ),
            ]],
        ];

        $keywordArchitecture = [
            $pillarSlug => [
                'primary_keyword' => strtolower($nicheLabel),
                'supporting_keywords' => [],
                'intent' => 'informational',
            ],
        ];
        foreach ($clusterSlugs as $slug) {
            $keywordArchitecture[$slug] = [
                'primary_keyword' => strtolower($nicheLabel) . ' ' . str_replace('-', ' ', $slug),
                'supporting_keywords' => [],
                'intent' => 'informational',
            ];
        }

        $pageBlueprint = [
            $pillarSlug => [
                'title' => $nicheLabel,
                'type' => 'pillar',
                'outline' => ['Introduction', 'Why it matters', 'Explore the topics below'],
                'primary_keyword' => $keywordArchitecture[$pillarSlug]['primary_keyword'],
            ],
        ];
        foreach ($clusterSlugs as $slug) {
            $pageBlueprint[$slug] = [
                'title' => $nicheLabel . ' ' . ucwords(str_replace('-', ' ', $slug)),
                'type' => 'cluster',
                'outline' => ['Overview', 'Key points', 'Next steps'],
                'primary_keyword' => $keywordArchitecture[$slug]['primary_keyword'],
            ];
        }

        $faqBlueprint = [
            $pillarSlug => [
                ['question' => "What is {$nicheLabel}?", 'answer' => "Placeholder answer about {$nicheLabel}."],
            ],
        ];

        $internalLinkingPlan = [
            $pillarSlug => $clusterSlugs,
        ];
        foreach ($clusterSlugs as $slug) {
            $internalLinkingPlan[$slug] = [$pillarSlug];
        }

        $seoMetadata = [
            'title_template' => '{page_title} | {brand}',
            'default_description' => "Placeholder description for {$nicheLabel}.",
            'schema_type_map' => [
                'page' => 'WebPage',
                'faq' => 'FAQPage',
                'product' => 'Product',
            ],
        ];

        $categoryStructure = [['slug' => $pillarSlug, 'title' => $nicheLabel]];
        $schemaBlueprint = [$pillarSlug => ['type' => 'WebPage']];
        foreach ($clusterSlugs as $slug) {
            $schemaBlueprint[$slug] = ['type' => 'WebPage'];
        }

        return new Blueprint(
            niche: $niche,
            topicalMap: $topicalMap,
            keywordArchitecture: $keywordArchitecture,
            pageBlueprint: $pageBlueprint,
            faqBlueprint: $faqBlueprint,
            internalLinkingPlan: $internalLinkingPlan,
            seoMetadata: $seoMetadata,
            nicheAnalysis: [
                'audience' => "Placeholder audience for {$nicheLabel}.",
                'business_model' => 'Placeholder — not researched (manual provider).',
                'value_proposition' => "Placeholder value proposition for {$nicheLabel}.",
                'competitive_notes' => 'Placeholder — not researched (manual provider).',
            ],
            entityMap: [$nicheLabel],
            categoryStructure: $categoryStructure,
            productStructure: [],
            schemaBlueprint: $schemaBlueprint,
        );
    }
}
