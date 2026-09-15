<?php

declare(strict_types=1);

require __DIR__ . '/../engine/bootstrap.php';

use Engine\Core\ConfigLoader;
use Engine\Generate\SubdomainGenerator;
use Engine\Strategy\ContentIntelligencePipeline;

$rootPath = dirname(__DIR__);

$args = [];
foreach (array_slice($argv, 1) as $arg) {
    if (str_contains($arg, '=')) {
        [$key, $value] = explode('=', $arg, 2);
        $args[$key] = $value;
    }
}

$name = $args['name'] ?? null;
if ($name === null) {
    fwrite(STDERR, "Usage: php bin/create-subdomain.php name=<niche> [theme=default] [logo=logo.svg] [domain=...] [brand=...]\n");
    exit(1);
}

$slug = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', trim($name)) ?? $name);
$slug = trim($slug, '-');

$engineConfig = ConfigLoader::engineConfig($rootPath);

$pipeline = ContentIntelligencePipeline::fromConfig($engineConfig, $rootPath);
$blueprint = $pipeline->run($name, $args);

$generator = new SubdomainGenerator($rootPath);
$dir = $generator->generate($slug, $blueprint, [
    'theme' => $args['theme'] ?? 'default',
    'logo' => $args['logo'] ?? 'logo.svg',
    'domain' => $args['domain'] ?? null,
    'brand' => $args['brand'] ?? null,
]);

$changelog = "{$rootPath}/ai/CHANGELOG.md";
$entry = "\n## " . date('Y-m-d') . " — subdomain created: {$slug}\n"
    . "- Generated via bin/create-subdomain.php name={$name}\n"
    . "- Provider: " . ($engineConfig['content_intelligence_provider'] ?? 'manual') . "\n";
file_put_contents($changelog, $entry, FILE_APPEND);

fwrite(STDOUT, "Created subdomain '{$slug}' at {$dir}\n");
