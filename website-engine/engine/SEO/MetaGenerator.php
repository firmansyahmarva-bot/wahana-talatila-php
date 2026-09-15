<?php

declare(strict_types=1);

namespace Engine\SEO;

use Engine\Content\ContentEntity;

final class MetaGenerator
{
    public function __construct(private readonly array $engineConfig)
    {
    }

    public function generate(ContentEntity $entity, array $manifest, array $seoDefaults): array
    {
        $brand = $manifest['brand'] ?? $manifest['name'] ?? '';
        $template = $seoDefaults['title_template']
            ?? $this->engineConfig['seo']['default_title_template']
            ?? '{page_title} | {brand}';

        $title = str_replace(
            ['{page_title}', '{brand}'],
            [$entity->title, $brand],
            $template,
        );

        $description = $entity->get('meta_description') ?? $seoDefaults['default_description'] ?? '';
        $maxLen = $this->engineConfig['seo']['default_meta_description_length'] ?? 155;
        if (strlen($description) > $maxLen) {
            $description = rtrim(substr($description, 0, $maxLen - 1)) . '…';
        }

        return [
            'title' => $title,
            'description' => $description,
            'og_title' => $title,
            'og_description' => $description,
            'og_type' => $entity->type === 'product' ? 'product' : 'website',
        ];
    }
}
