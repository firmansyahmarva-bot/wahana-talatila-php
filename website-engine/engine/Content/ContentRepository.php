<?php

declare(strict_types=1);

namespace Engine\Content;

/**
 * Reads flat-file content (Markdown pages + YAML/JSON structured data) for a
 * single subdomain and normalizes both into ContentEntity, so nothing
 * downstream (templates, SEO engine, linking) needs to know the source format.
 *
 * Swapping this for a DB-backed repository later (see PROJECT_MEMORY.md) means
 * implementing the same public methods against a different data source — no
 * other engine code changes.
 */
final class ContentRepository
{
    private readonly string $baseDir;

    public function __construct(
        private readonly string $rootPath,
        private readonly string $slug,
        private readonly MarkdownParser $markdown = new MarkdownParser(),
        private readonly StructuredDataParser $structured = new StructuredDataParser(),
    ) {
        $this->baseDir = "{$this->rootPath}/subdomains/{$this->slug}/content";
    }

    public function findPage(string $slug): ?ContentEntity
    {
        $path = "{$this->baseDir}/pages/{$slug}.md";
        if (!is_file($path)) {
            return null;
        }

        $parsed = $this->markdown->parseFile($path);
        $fm = $parsed['frontmatter'];

        return new ContentEntity(
            slug: $fm['slug'] ?? $slug,
            type: $fm['type'] ?? 'page',
            title: $fm['title'] ?? $slug,
            bodyHtml: $parsed['html'],
            meta: $fm,
        );
    }

    /** @return ContentEntity[] */
    public function allPages(): array
    {
        $dir = "{$this->baseDir}/pages";
        if (!is_dir($dir)) {
            return [];
        }

        $entities = [];
        foreach (glob("{$dir}/*.md") ?: [] as $file) {
            $slug = basename($file, '.md');
            $entity = $this->findPage($slug);
            if ($entity !== null) {
                $entities[] = $entity;
            }
        }

        return $entities;
    }

    public function categories(): array
    {
        return $this->structured->parseFile("{$this->baseDir}/categories.yaml");
    }

    public function findCategory(string $slug): ?array
    {
        foreach ($this->categories() as $category) {
            if (($category['slug'] ?? null) === $slug) {
                return $category;
            }
        }

        return null;
    }

    public function products(): array
    {
        return $this->structured->parseFile("{$this->baseDir}/products.yaml");
    }

    public function findProduct(string $categorySlug, string $slug): ?array
    {
        foreach ($this->products() as $product) {
            if (($product['slug'] ?? null) === $slug && ($product['category_slug'] ?? null) === $categorySlug) {
                return $product;
            }
        }

        return null;
    }

    public function faqs(): array
    {
        return $this->structured->parseFile("{$this->baseDir}/faq.yaml");
    }

    /**
     * Homepage marketing-section data (hero, categories, pillars, guides,
     * products, trust, process, FAQ preview, footer columns) for the `home`
     * layout. Separate from `Engine\Strategy\Blueprint` (the SEO content
     * strategy contract) — this is presentation content for one page, read
     * the same way categories()/products()/faqs() already are.
     */
    public function homepage(): array
    {
        return $this->structured->parseFile("{$this->baseDir}/homepage.yaml");
    }

    public function nav(string $name = 'primary'): array
    {
        return $this->structured->parseFile("{$this->rootPath}/subdomains/{$this->slug}/nav/{$name}.yaml");
    }
}
