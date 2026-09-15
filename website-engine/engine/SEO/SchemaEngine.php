<?php

declare(strict_types=1);

namespace Engine\SEO;

use Engine\Content\ContentEntity;

final class SchemaEngine
{
    public function build(ContentEntity $entity, array $manifest, array $seoDefaults, array $overrides = []): array
    {
        $type = $overrides['type'] ?? $this->defaultTypeFor($entity->type, $seoDefaults);

        $schema = match ($type) {
            'FAQPage' => $this->faqPage($entity),
            'Product' => $this->product($entity, $manifest),
            'Organization' => $this->organization($manifest),
            'Article' => $this->article($entity, $manifest),
            default => $this->webPage($entity),
        };

        return array_replace_recursive($schema, $overrides['fields'] ?? []);
    }

    private function defaultTypeFor(string $entityType, array $seoDefaults): string
    {
        return $seoDefaults['schema_type_map'][$entityType] ?? match ($entityType) {
            'faq' => 'FAQPage',
            'product' => 'Product',
            default => 'WebPage',
        };
    }

    private function webPage(ContentEntity $entity): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'WebPage',
            'name' => $entity->title,
        ];
    }

    private function faqPage(ContentEntity $entity): array
    {
        $items = $entity->get('faqs', []);

        return [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => array_map(static fn ($faq) => [
                '@type' => 'Question',
                'name' => $faq['question'] ?? '',
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $faq['answer'] ?? '',
                ],
            ], $items),
        ];
    }

    /**
     * Author is read from manifest.yaml (`author: {name, credential}`) so
     * it's a per-subdomain content-authorship fact, never hardcoded in the
     * engine. Omitted entirely - no Person node at all - if a subdomain
     * hasn't set one, rather than inventing a byline.
     */
    private function article(ContentEntity $entity, array $manifest): array
    {
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => $entity->title,
            'publisher' => [
                '@type' => 'Organization',
                'name' => $manifest['brand'] ?? $manifest['name'] ?? '',
            ],
        ];

        $author = $manifest['author'] ?? null;
        if (is_array($author) && ($author['name'] ?? '') !== '') {
            $schema['author'] = [
                '@type' => 'Person',
                'name' => $author['name'],
            ];
        }

        return $schema;
    }

    private function product(ContentEntity $entity, array $manifest): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Product',
            'name' => $entity->title,
            'brand' => $manifest['brand'] ?? $manifest['name'] ?? '',
        ];
    }

    private function organization(array $manifest): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => $manifest['brand'] ?? $manifest['name'] ?? '',
            'url' => 'https://' . ($manifest['domain'] ?? ''),
        ];
    }
}
