<?php

declare(strict_types=1);

namespace Engine\Strategy;

/**
 * The single output contract of the Content Intelligence Pipeline. One
 * blueprint per subdomain, produced by one provider call — not a chain of
 * separate research/keyword/content/FAQ/linking calls (minimizes AI token
 * usage; see ai/PROJECT_MEMORY.md).
 *
 * SubdomainGenerator consumes exactly this shape and writes it into
 * /subdomains/{slug}/ — it does not care whether a Blueprint came from the
 * Manual stub provider or a future AI provider.
 */
final class Blueprint
{
    public function __construct(
        public readonly string $niche,
        /** @var array{pillars: array<int, array{slug:string,title:string,clusters:array<int,array{slug:string,title:string,intent:string}>}>} topical authority map + pillar/cluster structure */
        public readonly array $topicalMap,
        /** @var array<string, array{primary_keyword:string,supporting_keywords:string[],intent:string}> keyword architecture + search-intent mapping, keyed by page slug */
        public readonly array $keywordArchitecture,
        /** @var array<string, array{title:string,type:string,outline:string[],primary_keyword:string}> content blueprint, keyed by page slug */
        public readonly array $pageBlueprint,
        /** @var array<string, array<int, array{question:string,answer:string}>> FAQ blueprint, keyed by page slug */
        public readonly array $faqBlueprint,
        /** @var array<string, string[]> internal linking blueprint: page slug => related page slugs */
        public readonly array $internalLinkingPlan,
        /** @var array{title_template:string,default_description:string,schema_type_map:array<string,string>} SEO metadata blueprint */
        public readonly array $seoMetadata,
        /** @var array{audience?:string,business_model?:string,value_proposition?:string,competitive_notes?:string} niche analysis */
        public readonly array $nicheAnalysis = [],
        /** @var string[] entity mapping — topics/entities the subdomain must cover for semantic completeness */
        public readonly array $entityMap = [],
        /** @var array<int, array{slug:string,title:string}> category structure */
        public readonly array $categoryStructure = [],
        /** @var array<int, array{slug:string,category_slug:string,title:string,description?:string}> product/service structure */
        public readonly array $productStructure = [],
        /** @var array<string, array{type:string}> schema blueprint, keyed by page slug */
        public readonly array $schemaBlueprint = [],
    ) {
    }

    /**
     * Builds a Blueprint from the one JSON/YAML shape both providers speak:
     * the AI provider's model response and a hand-authored manual blueprint
     * file use the same keys, so this is the single decode path for either.
     */
    public static function fromArray(string $niche, array $data): self
    {
        return new self(
            niche: $niche,
            topicalMap: $data['topical_map'] ?? ['pillars' => []],
            keywordArchitecture: $data['keyword_architecture'] ?? [],
            pageBlueprint: $data['page_blueprint'] ?? [],
            faqBlueprint: $data['faq_blueprint'] ?? [],
            internalLinkingPlan: $data['internal_linking_plan'] ?? [],
            seoMetadata: $data['seo_metadata'] ?? [],
            nicheAnalysis: $data['niche_analysis'] ?? [],
            entityMap: $data['entity_map'] ?? [],
            categoryStructure: $data['category_structure'] ?? [],
            productStructure: $data['product_structure'] ?? [],
            schemaBlueprint: $data['schema_blueprint'] ?? [],
        );
    }

    public function toArray(): array
    {
        return [
            'niche' => $this->niche,
            'niche_analysis' => $this->nicheAnalysis,
            'topical_map' => $this->topicalMap,
            'keyword_architecture' => $this->keywordArchitecture,
            'entity_map' => $this->entityMap,
            'category_structure' => $this->categoryStructure,
            'product_structure' => $this->productStructure,
            'page_blueprint' => $this->pageBlueprint,
            'faq_blueprint' => $this->faqBlueprint,
            'internal_linking_plan' => $this->internalLinkingPlan,
            'schema_blueprint' => $this->schemaBlueprint,
            'seo_metadata' => $this->seoMetadata,
        ];
    }
}
