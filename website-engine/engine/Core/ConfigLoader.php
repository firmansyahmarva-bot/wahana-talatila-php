<?php

declare(strict_types=1);

namespace Engine\Core;

use Engine\Support\Yaml;

final class ConfigLoader
{
    private static array $cache = [];

    public static function loadYaml(string $path): array
    {
        if (isset(self::$cache[$path])) {
            return self::$cache[$path];
        }

        if (!is_file($path)) {
            return [];
        }

        $data = Yaml::parseFile($path) ?? [];

        return self::$cache[$path] = $data;
    }

    public static function engineConfig(string $rootPath): array
    {
        return self::loadYaml($rootPath . '/config/engine.yaml');
    }

    public static function manifestFor(string $rootPath, string $slug): array
    {
        return self::loadYaml($rootPath . "/subdomains/{$slug}/manifest.yaml");
    }

    public static function mergedConfigFor(string $rootPath, string $slug): array
    {
        $engine = self::engineConfig($rootPath);
        $manifest = self::manifestFor($rootPath, $slug);

        return array_replace_recursive($engine, ['manifest' => $manifest]);
    }

    public static function clearCache(): void
    {
        self::$cache = [];
    }
}
