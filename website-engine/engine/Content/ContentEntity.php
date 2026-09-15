<?php

declare(strict_types=1);

namespace Engine\Content;

final class ContentEntity
{
    public function __construct(
        public readonly string $slug,
        public readonly string $type, // page|category|product|faq
        public readonly string $title,
        public readonly string $bodyHtml,
        public readonly array $meta = [],
    ) {
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->meta[$key] ?? $default;
    }
}
