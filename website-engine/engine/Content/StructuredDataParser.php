<?php

declare(strict_types=1);

namespace Engine\Content;

use Engine\Support\Yaml;

final class StructuredDataParser
{
    public function parseFile(string $path): array
    {
        if (!is_file($path)) {
            return [];
        }

        if (str_ends_with($path, '.json')) {
            return json_decode(file_get_contents($path) ?: '[]', true) ?? [];
        }

        return Yaml::parseFile($path) ?? [];
    }
}
