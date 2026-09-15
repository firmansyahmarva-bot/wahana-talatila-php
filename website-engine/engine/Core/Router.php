<?php

declare(strict_types=1);

namespace Engine\Core;

final class RouteMatch
{
    public function __construct(
        public readonly string $routeName,
        public readonly string $layout,
        public readonly array $params,
    ) {
    }
}

final class Router
{
    /** @param array<string,array{pattern:string,layout:string}> $routes */
    public function __construct(private readonly array $routes)
    {
    }

    public function match(string $path): ?RouteMatch
    {
        foreach ($this->routes as $name => $route) {
            $params = $this->matchPattern($route['pattern'], $path);
            if ($params !== null) {
                return new RouteMatch($name, $route['layout'], $params);
            }
        }

        return null;
    }

    private function matchPattern(string $pattern, string $path): ?array
    {
        $pattern = '/' . trim($pattern, '/');
        $path = '/' . trim($path, '/');

        if ($pattern === '/') {
            return $path === '/' ? [] : null;
        }

        $quoted = preg_quote($pattern, '#');
        $regex = '#^' . preg_replace('#\\\\\{([a-zA-Z_]+)\\\\\}#', '(?P<$1>[^/]+)', $quoted) . '$#';

        if (!preg_match($regex, $path, $matches)) {
            return null;
        }

        return array_filter($matches, fn ($k) => !is_int($k), ARRAY_FILTER_USE_KEY);
    }
}
