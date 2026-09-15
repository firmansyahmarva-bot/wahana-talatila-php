<?php

declare(strict_types=1);

require __DIR__ . '/../engine/bootstrap.php';

use Engine\Core\ConfigLoader;
use Engine\Core\Request;
use Engine\Core\SubdomainResolver;
use Engine\SEO\RobotsBuilder;

$rootPath = dirname(__DIR__);
$request = Request::fromGlobals();

$resolver = new SubdomainResolver($rootPath);
$slug = $resolver->resolve($request->host);

if ($slug === null) {
    http_response_code(404);
    exit;
}

$manifest = ConfigLoader::manifestFor($rootPath, $slug);
$seoDefaults = ConfigLoader::loadYaml("{$rootPath}/subdomains/{$slug}/seo/defaults.yaml");

header('Content-Type: text/plain; charset=utf-8');
echo (new RobotsBuilder())->build($manifest, $seoDefaults);
