<?php

declare(strict_types=1);

namespace Engine\Core;

final class SubdomainResolver
{
    public function __construct(private readonly string $rootPath)
    {
    }

    /**
     * Resolve a request host to a subdomain slug purely by looking up which
     * /subdomains/{slug}/manifest.yaml declares that domain. No hardcoded
     * host->slug map, no code changes when a subdomain is added.
     */
    public function resolve(string $host): ?string
    {
        $host = strtolower(trim($host));
        $host = preg_replace('/:\d+$/', '', $host) ?? $host;

        foreach ($this->listSlugs() as $slug) {
            $manifest = ConfigLoader::manifestFor($this->rootPath, $slug);
            $domain = strtolower((string) ($manifest['domain'] ?? ''));

            if ($domain !== '' && $domain === $host) {
                return $slug;
            }
        }

        // local/dev convenience: {slug}.localhost or ?subdomain= override
        if (str_ends_with($host, '.localhost') || $host === 'localhost') {
            $candidate = explode('.', $host)[0];
            if ($candidate !== 'localhost' && is_dir($this->rootPath . "/subdomains/{$candidate}")) {
                return $candidate;
            }
        }

        return null;
    }

    /** @return string[] */
    public function listSlugs(): array
    {
        $dir = $this->rootPath . '/subdomains';
        if (!is_dir($dir)) {
            return [];
        }

        $slugs = [];
        foreach (scandir($dir) ?: [] as $entry) {
            if ($entry === '.' || $entry === '..') {
                continue;
            }
            if (is_file("{$dir}/{$entry}/manifest.yaml")) {
                $slugs[] = $entry;
            }
        }

        return $slugs;
    }
}
