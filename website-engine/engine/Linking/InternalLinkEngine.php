<?php

declare(strict_types=1);

namespace Engine\Linking;

use Engine\Content\ContentRepository;

/**
 * Computes internal links from data relationships declared in content
 * (pillar/cluster type + explicit related_slugs), following ai/SEO_RULES.md:
 * pillars link to all their clusters, clusters link back to their pillar and
 * 2-4 siblings, no orphan pages.
 */
final class InternalLinkEngine
{
    public function linksFor(string $slug, ContentRepository $content): array
    {
        $pages = $content->allPages();
        $current = null;
        foreach ($pages as $page) {
            if ($page->slug === $slug) {
                $current = $page;
                break;
            }
        }

        if ($current === null) {
            return [];
        }

        $explicit = $current->get('related_slugs', []);
        if ($explicit !== []) {
            return $this->resolveSlugs($explicit, $pages);
        }

        $type = $current->get('type', 'page');
        $pillarSlug = $current->get('pillar_slug');

        if ($type === 'pillar') {
            $clusters = array_filter($pages, fn ($p) => $p->get('pillar_slug') === $current->slug);

            return array_values(array_map(fn ($p) => ['slug' => $p->slug, 'title' => $p->title], $clusters));
        }

        if ($type === 'cluster' && $pillarSlug !== null) {
            $siblings = array_filter(
                $pages,
                fn ($p) => $p->get('pillar_slug') === $pillarSlug && $p->slug !== $current->slug,
            );
            $siblings = array_slice(array_values($siblings), 0, 4);
            $links = array_map(fn ($p) => ['slug' => $p->slug, 'title' => $p->title], $siblings);

            $links[] = ['slug' => $pillarSlug, 'title' => $pillarSlug];

            return $links;
        }

        return [];
    }

    private function resolveSlugs(array $slugs, array $pages): array
    {
        $indexed = [];
        foreach ($pages as $page) {
            $indexed[$page->slug] = $page->title;
        }

        $links = [];
        foreach ($slugs as $slug) {
            if (isset($indexed[$slug])) {
                $links[] = ['slug' => $slug, 'title' => $indexed[$slug]];
            }
        }

        return $links;
    }
}
