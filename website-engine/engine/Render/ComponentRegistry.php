<?php

declare(strict_types=1);

namespace Engine\Render;

/**
 * Maps a route/layout name to its ordered component slots. Subdomain-specific
 * variance is a manifest flag (e.g. show_hero: false), never a forked template.
 */
final class ComponentRegistry
{
    public function __construct(private readonly array $engineConfig)
    {
    }

    public function slotsFor(string $layout, array $manifest): array
    {
        $default = match ($layout) {
            'page' => ['header', 'breadcrumb', 'hero', 'content', 'cta', 'footer'],
            'category' => ['header', 'breadcrumb', 'hero', 'content', 'cta', 'footer'],
            'product' => ['header', 'breadcrumb', 'content', 'cta', 'footer'],
            'faq' => ['header', 'breadcrumb', 'faq-block', 'footer'],
            'home' => [
                'home-header', 'home-hero', 'home-search', 'home-categories', 'home-pillars',
                'home-guides', 'home-products', 'home-trust', 'home-process', 'home-faq',
                'home-finalcta', 'home-footer',
            ],
            default => ['header', 'content', 'footer'],
        };

        $flags = $manifest['component_flags'] ?? [];

        return array_values(array_filter($default, static function ($slot) use ($flags) {
            return ($flags["show_{$slot}"] ?? true) !== false;
        }));
    }
}
