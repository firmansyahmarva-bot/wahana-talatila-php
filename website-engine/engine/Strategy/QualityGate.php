<?php

declare(strict_types=1);

namespace Engine\Strategy;

/**
 * Enforces ai/AI_RULES.md against an already-produced Blueprint: strips thin
 * pages, resolves keyword cannibalization, removes orphaned internal links,
 * and prunes the topical map to match. Runs after any provider (Manual or
 * AI) produces a Blueprint and before it reaches SubdomainGenerator — a
 * provider's prompt-level instructions are not trusted alone; this is the
 * enforced backstop. "Reduce pages instead of weak content" is implemented
 * literally: pages are dropped, never padded.
 */
final class QualityGate
{
    private const MIN_OUTLINE_SECTIONS = 3;

    public function review(Blueprint $blueprint): Blueprint
    {
        $pages = $this->resolveCannibalization(
            $this->removeThinPages($blueprint->pageBlueprint),
            $blueprint->keywordArchitecture,
        );

        $keywordArchitecture = array_intersect_key($blueprint->keywordArchitecture, $pages);
        $faqBlueprint = array_intersect_key($blueprint->faqBlueprint, $pages);
        $schemaBlueprint = array_intersect_key($blueprint->schemaBlueprint, $pages);
        $internalLinkingPlan = $this->pruneOrphans(
            $this->intersectLinking($blueprint->internalLinkingPlan, $pages),
            $pages,
        );
        $topicalMap = $this->pruneTopicalMap($blueprint->topicalMap, $pages);

        return new Blueprint(
            niche: $blueprint->niche,
            topicalMap: $topicalMap,
            keywordArchitecture: $keywordArchitecture,
            pageBlueprint: $pages,
            faqBlueprint: $faqBlueprint,
            internalLinkingPlan: $internalLinkingPlan,
            seoMetadata: $blueprint->seoMetadata,
            nicheAnalysis: $blueprint->nicheAnalysis,
            entityMap: $blueprint->entityMap,
            categoryStructure: $blueprint->categoryStructure,
            productStructure: $blueprint->productStructure,
            schemaBlueprint: $schemaBlueprint,
        );
    }

    /** No thin pages: a page needs a real title and a real outline. */
    private function removeThinPages(array $pages): array
    {
        return array_filter($pages, static function (array $page): bool {
            $outline = $page['outline'] ?? [];
            $title = trim((string) ($page['title'] ?? ''));

            return $title !== '' && is_array($outline) && count($outline) >= self::MIN_OUTLINE_SECTIONS;
        });
    }

    /** Prevent keyword cannibalization: only the first page claiming a primary keyword survives. */
    private function resolveCannibalization(array $pages, array $keywordArchitecture): array
    {
        $claimed = [];

        foreach ($pages as $slug => $page) {
            $keyword = strtolower(trim(
                (string) ($keywordArchitecture[$slug]['primary_keyword'] ?? $page['primary_keyword'] ?? ''),
            ));

            if ($keyword === '') {
                unset($pages[$slug]);
                continue;
            }

            if (isset($claimed[$keyword])) {
                unset($pages[$slug]);
                continue;
            }

            $claimed[$keyword] = $slug;
        }

        return $pages;
    }

    private function intersectLinking(array $linking, array $pages): array
    {
        $result = [];
        foreach ($linking as $slug => $targets) {
            if (!isset($pages[$slug])) {
                continue;
            }
            $result[$slug] = array_values(array_filter(
                (array) $targets,
                static fn ($target) => isset($pages[$target]),
            ));
        }

        return $result;
    }

    /** No orphan pages: anything with zero inbound links gets attached to the pillar. */
    private function pruneOrphans(array $linking, array $pages): array
    {
        $inbound = [];
        foreach ($linking as $targets) {
            foreach ($targets as $target) {
                $inbound[$target] = true;
            }
        }

        $pillarSlug = null;
        foreach ($pages as $slug => $page) {
            if (($page['type'] ?? '') === 'pillar') {
                $pillarSlug = $slug;
                break;
            }
        }

        if ($pillarSlug === null) {
            return $linking;
        }

        foreach ($pages as $slug => $page) {
            if ($slug === $pillarSlug || isset($inbound[$slug])) {
                continue;
            }
            $linking[$pillarSlug] = array_values(array_unique([...($linking[$pillarSlug] ?? []), $slug]));
        }

        return $linking;
    }

    private function pruneTopicalMap(array $topicalMap, array $pages): array
    {
        $pillars = [];

        foreach (($topicalMap['pillars'] ?? []) as $pillar) {
            if (!isset($pages[$pillar['slug']])) {
                continue;
            }

            $pillar['clusters'] = array_values(array_filter(
                $pillar['clusters'] ?? [],
                static fn ($cluster) => isset($pages[$cluster['slug']]),
            ));
            $pillars[] = $pillar;
        }

        return ['pillars' => $pillars];
    }
}
