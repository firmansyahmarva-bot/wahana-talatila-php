<?php

declare(strict_types=1);

namespace Engine\SEO;

use Engine\Content\ContentRepository;

final class SitemapBuilder
{
    public function build(ContentRepository $content, array $manifest): string
    {
        $domain = $manifest['domain'] ?? '';
        $urls = ["https://{$domain}/"];

        foreach ($content->allPages() as $page) {
            $urls[] = "https://{$domain}/{$page->slug}";
        }
        foreach ($content->categories() as $category) {
            $urls[] = "https://{$domain}/category/{$category['slug']}";
        }
        foreach ($content->products() as $product) {
            $urls[] = "https://{$domain}/product/{$product['category_slug']}/{$product['slug']}";
        }

        $xml = ['<?xml version="1.0" encoding="UTF-8"?>', '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'];
        foreach (array_unique($urls) as $url) {
            $xml[] = '<url><loc>' . htmlspecialchars($url, ENT_XML1) . '</loc></url>';
        }
        $xml[] = '</urlset>';

        return implode("\n", $xml);
    }
}
