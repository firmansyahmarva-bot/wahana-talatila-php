<?php

declare(strict_types=1);

namespace Engine\SEO;

final class BreadcrumbBuilder
{
    /** @param array{label:string,path:string}[] $trail */
    public function build(array $trail, array $manifest): array
    {
        $items = [];
        foreach (array_values($trail) as $i => $crumb) {
            $items[] = [
                '@type' => 'ListItem',
                'position' => $i + 1,
                'name' => $crumb['label'],
                'item' => 'https://' . ($manifest['domain'] ?? '') . $crumb['path'],
            ];
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $items,
        ];
    }
}
