<?php

declare(strict_types=1);

namespace Engine\SEO;

final class CanonicalResolver
{
    public function resolve(array $manifest, string $path): string
    {
        $domain = $manifest['domain'] ?? 'example.com';
        $path = '/' . ltrim($path, '/');
        $path = $path === '/' ? '' : rtrim($path, '/');

        return "https://{$domain}{$path}";
    }
}
