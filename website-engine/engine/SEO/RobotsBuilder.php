<?php

declare(strict_types=1);

namespace Engine\SEO;

final class RobotsBuilder
{
    public function build(array $manifest, array $seoDefaults): string
    {
        $domain = $manifest['domain'] ?? '';
        $disallow = $seoDefaults['robots_disallow'] ?? [];

        $lines = ['User-agent: *'];
        foreach ($disallow as $path) {
            $lines[] = "Disallow: {$path}";
        }
        if ($disallow === []) {
            $lines[] = 'Disallow:';
        }
        $lines[] = "Sitemap: https://{$domain}/sitemap.xml";

        return implode("\n", $lines) . "\n";
    }
}
