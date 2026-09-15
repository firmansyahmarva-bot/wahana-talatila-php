<?php

declare(strict_types=1);

namespace Engine\Theme;

use Engine\Support\Yaml;

final class ThemeLoader
{
    public function __construct(private readonly string $rootPath)
    {
    }

    public function tokens(string $themeName): array
    {
        $path = "{$this->rootPath}/themes/{$themeName}/tokens.yaml";

        return is_file($path) ? (Yaml::parseFile($path) ?? []) : [];
    }

    public function compileCss(string $themeName): string
    {
        $tokens = $this->tokens($themeName);
        $lines = [':root {'];

        foreach (($tokens['colors'] ?? []) as $name => $value) {
            $lines[] = "  --color-{$name}: {$value};";
        }
        foreach (($tokens['fonts'] ?? []) as $name => $value) {
            $lines[] = "  --font-{$name}: {$value};";
        }
        foreach (($tokens['spacing'] ?? []) as $name => $value) {
            $lines[] = "  --space-{$name}: {$value};";
        }
        foreach (($tokens['radius'] ?? []) as $name => $value) {
            $lines[] = $name === 'default' ? "  --radius: {$value};" : "  --radius-{$name}: {$value};";
        }
        foreach (($tokens['shadows'] ?? []) as $name => $value) {
            $lines[] = $name === 'default' ? "  --shadow: {$value};" : "  --shadow-{$name}: {$value};";
        }

        $lines[] = '}';

        return implode("\n", $lines) . "\n";
    }

    public function writeCompiledCss(string $themeName, string $publicAssetsDir): string
    {
        if (!is_dir($publicAssetsDir)) {
            mkdir($publicAssetsDir, 0775, true);
        }

        $path = "{$publicAssetsDir}/theme-{$themeName}.css";
        file_put_contents($path, $this->compileCss($themeName));

        return $path;
    }
}
