<?php

declare(strict_types=1);

namespace Engine\Generate;

use Engine\Strategy\Blueprint;
use Engine\Support\Yaml;

/**
 * The only sanctioned way to create a subdomain (ai/AI_RULES.md rule 4).
 * Consumes a Blueprint (from ContentIntelligencePipeline) plus branding
 * options and writes a complete, production-shaped /subdomains/{slug}/
 * tree. Never called with niche-specific logic embedded here — all niche
 * content comes from the Blueprint.
 */
final class SubdomainGenerator
{
    public function __construct(private readonly string $rootPath)
    {
    }

    public function generate(string $slug, Blueprint $blueprint, array $options = []): string
    {
        if ($slug === '' || preg_match('/[^a-z0-9\-]/', $slug)) {
            throw new \InvalidArgumentException('Subdomain slug must be lowercase alphanumeric/hyphen.');
        }

        $dir = "{$this->rootPath}/subdomains/{$slug}";
        if (is_dir($dir)) {
            throw new \RuntimeException("Subdomain '{$slug}' already exists at {$dir}.");
        }

        $this->makeDirs($dir);

        $theme = $options['theme'] ?? 'default';
        $brand = $options['brand'] ?? ucwords(str_replace(['-', '_'], ' ', $slug));
        $domain = $options['domain'] ?? "{$slug}.example.com";

        $this->writeManifest($dir, $slug, $brand, $domain, $theme, $options);
        $this->writeNav($dir, $blueprint);
        $this->writePages($dir, $blueprint);
        $this->writeCategories($dir, $blueprint);
        $this->writeFaq($dir, $blueprint);
        $this->writeSeoDefaults($dir, $blueprint, $brand);
        $this->writeStrategyArtifacts($dir, $blueprint);

        return $dir;
    }

    private function makeDirs(string $dir): void
    {
        foreach (['', '/content/pages', '/nav', '/seo', '/schema', '/strategy'] as $sub) {
            $path = $dir . $sub;
            if (!is_dir($path)) {
                mkdir($path, 0775, true);
            }
        }
    }

    private function writeManifest(string $dir, string $slug, string $brand, string $domain, string $theme, array $options): void
    {
        $manifest = [
            'slug' => $slug,
            'name' => $brand,
            'brand' => $brand,
            'domain' => $domain,
            'theme' => $theme,
            'logo' => $options['logo'] ?? 'logo.svg',
            'component_flags' => [],
            'created_at' => date('c'),
        ];

        file_put_contents("{$dir}/manifest.yaml", Yaml::dump($manifest));
    }

    private function writeNav(string $dir, Blueprint $blueprint): void
    {
        $pillars = $blueprint->topicalMap['pillars'] ?? [];
        $primary = [];

        foreach ($pillars as $pillar) {
            $primary[] = ['label' => $pillar['title'], 'path' => "/{$pillar['slug']}"];
            foreach ($pillar['clusters'] ?? [] as $cluster) {
                $primary[] = ['label' => $cluster['title'], 'path' => "/{$cluster['slug']}"];
            }
        }

        file_put_contents("{$dir}/nav/primary.yaml", Yaml::dump(['items' => $primary]));
        file_put_contents("{$dir}/nav/footer.yaml", Yaml::dump(['items' => [['label' => 'FAQ', 'path' => '/faq']]]));
    }

    private function writePages(string $dir, Blueprint $blueprint): void
    {
        $pillarSlugByCluster = [];
        foreach ($blueprint->topicalMap['pillars'] ?? [] as $pillar) {
            foreach ($pillar['clusters'] ?? [] as $cluster) {
                $pillarSlugByCluster[$cluster['slug']] = $pillar['slug'];
            }
        }

        foreach ($blueprint->pageBlueprint as $slug => $page) {
            $frontmatter = [
                'title' => $page['title'],
                'slug' => $slug,
                'type' => $page['type'],
                'primary_keyword' => $page['primary_keyword'],
                'supporting_keywords' => $blueprint->keywordArchitecture[$slug]['supporting_keywords'] ?? [],
                'search_intent' => $blueprint->keywordArchitecture[$slug]['intent'] ?? 'informational',
                'related_slugs' => $blueprint->internalLinkingPlan[$slug] ?? [],
                'meta_description' => $page['meta_description'] ?? $blueprint->seoMetadata['default_description'] ?? '',
                'faqs' => $blueprint->faqBlueprint[$slug] ?? [],
            ];

            if (isset($pillarSlugByCluster[$slug])) {
                $frontmatter['pillar_slug'] = $pillarSlugByCluster[$slug];
            }

            $body = "# {$page['title']}\n\n";
            foreach ($page['outline'] as $heading) {
                $body .= "## {$heading}\n\nPlaceholder content.\n\n";
            }

            $content = "---\n" . rtrim(Yaml::dump($frontmatter)) . "\n---\n\n" . $body;
            file_put_contents("{$dir}/content/pages/{$slug}.md", $content);
        }
    }

    private function writeCategories(string $dir, Blueprint $blueprint): void
    {
        $categories = $blueprint->categoryStructure !== []
            ? $blueprint->categoryStructure
            : array_map(
                static fn ($pillar) => ['slug' => $pillar['slug'], 'title' => $pillar['title']],
                $blueprint->topicalMap['pillars'] ?? [],
            );

        file_put_contents("{$dir}/content/categories.yaml", Yaml::dump($categories));
        file_put_contents("{$dir}/content/products.yaml", Yaml::dump($blueprint->productStructure));
    }

    private function writeFaq(string $dir, Blueprint $blueprint): void
    {
        $all = [];
        foreach ($blueprint->faqBlueprint as $items) {
            $all = array_merge($all, $items);
        }

        file_put_contents("{$dir}/content/faq.yaml", Yaml::dump($all));
    }

    private function writeSeoDefaults(string $dir, Blueprint $blueprint, string $brand): void
    {
        $defaults = $blueprint->seoMetadata + ['brand' => $brand];
        file_put_contents("{$dir}/seo/defaults.yaml", Yaml::dump($defaults));

        $overrides = [];
        foreach ($blueprint->schemaBlueprint as $slug => $entry) {
            $overrides[$slug] = ['type' => $entry['type'] ?? 'WebPage'];
        }
        file_put_contents("{$dir}/schema/overrides.yaml", Yaml::dump($overrides));
    }

    /**
     * Niche analysis and entity map aren't consumed at render time — they're
     * written as an audit trail for whoever reviews or extends this
     * subdomain's content strategy later.
     */
    private function writeStrategyArtifacts(string $dir, Blueprint $blueprint): void
    {
        file_put_contents("{$dir}/strategy/niche-analysis.yaml", Yaml::dump($blueprint->nicheAnalysis));
        file_put_contents("{$dir}/strategy/entity-map.yaml", Yaml::dump($blueprint->entityMap));
    }
}
