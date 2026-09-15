<?php

declare(strict_types=1);

namespace Engine\SEO;

use Engine\Content\ContentEntity;

/**
 * Single entry point for all SEO concerns. Every route type (page, category,
 * product, faq) calls this same class — never per-template SEO logic.
 * See ai/SEO_RULES.md and ai/AI_RULES.md rule 3.
 */
final class SeoEngine
{
    public function __construct(
        private readonly MetaGenerator $meta,
        private readonly SchemaEngine $schema,
        private readonly CanonicalResolver $canonical,
        private readonly BreadcrumbBuilder $breadcrumbs,
    ) {
    }

    public static function fromConfig(array $engineConfig): self
    {
        return new self(
            new MetaGenerator($engineConfig),
            new SchemaEngine(),
            new CanonicalResolver(),
            new BreadcrumbBuilder(),
        );
    }

    /** @param array{label:string,path:string}[] $breadcrumbTrail */
    public function forRequest(
        ContentEntity $entity,
        array $manifest,
        array $seoDefaults,
        string $path,
        array $breadcrumbTrail = [],
        array $schemaOverrides = [],
    ): array {
        return [
            'meta' => $this->meta->generate($entity, $manifest, $seoDefaults),
            'canonical' => $this->canonical->resolve($manifest, $path),
            'schema' => $this->schema->build($entity, $manifest, $seoDefaults, $schemaOverrides),
            'breadcrumbs' => $breadcrumbTrail !== []
                ? $this->breadcrumbs->build($breadcrumbTrail, $manifest)
                : null,
        ];
    }
}
