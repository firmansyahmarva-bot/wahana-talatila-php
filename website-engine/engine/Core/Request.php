<?php

declare(strict_types=1);

namespace Engine\Core;

final class Request
{
    private function __construct(
        public readonly string $host,
        public readonly string $path,
        public readonly array $query,
    ) {
    }

    public static function fromGlobals(): self
    {
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        $uri = $_SERVER['REQUEST_URI'] ?? '/';
        $path = (string) parse_url($uri, PHP_URL_PATH);
        $path = '/' . trim($path, '/');

        return new self($host, $path, $_GET);
    }
}
