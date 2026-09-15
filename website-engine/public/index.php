<?php

declare(strict_types=1);

require __DIR__ . '/../engine/bootstrap.php';

use Engine\Content\ContentRepository;
use Engine\Core\ConfigLoader;
use Engine\Core\Request;
use Engine\Core\Router;
use Engine\Core\SubdomainResolver;
use Engine\Linking\InternalLinkEngine;
use Engine\Render\ComponentRegistry;
use Engine\Render\TemplateEngine;
use Engine\SEO\SeoEngine;
use Engine\Theme\ThemeLoader;

$rootPath = dirname(__DIR__);
$request = Request::fromGlobals();

$resolver = new SubdomainResolver($rootPath);
$slug = $resolver->resolve($request->host);

if ($slug === null) {
    http_response_code(404);
    echo 'No subdomain configured for this host.';
    exit;
}

$engineConfig = ConfigLoader::engineConfig($rootPath);
$manifest = ConfigLoader::manifestFor($rootPath, $slug);

$router = new Router($engineConfig['routes'] ?? []);
$match = $router->match($request->path);

if ($match === null) {
    http_response_code(404);
    echo 'Not found.';
    exit;
}

$content = new ContentRepository($rootPath, $slug);
$requestedSlug = $match->params['slug'] ?? 'home';

// 'home' is a reserved slug every subdomain's root page is generated under
// (see SubdomainGenerator); the generic page route (/{slug}) would otherwise
// also serve it at /home, duplicating the root ('/') page under a second
// URL with its own self-referencing canonical. Merge them at the routing
// layer for every subdomain, not per-subdomain content.
if ($match->routeName === 'page' && $requestedSlug === 'home') {
    http_response_code(301);
    header('Location: /');
    exit;
}

$entity = match ($match->routeName) {
    'home' => $content->findPage('home'),
    'page' => $content->findPage($requestedSlug),
    'category' => null, // rendered from categories.yaml directly by the category layout
    'faq' => $content->findPage('faq') ?? $content->findPage('home'),
    default => $content->findPage($requestedSlug),
};

if ($entity === null && $match->routeName !== 'category') {
    http_response_code(404);
    echo 'Page not found.';
    exit;
}

$seoDefaults = ConfigLoader::loadYaml("{$rootPath}/subdomains/{$slug}/seo/defaults.yaml");
// Keyed by page slug (written by SubdomainGenerator from Blueprint::$schemaBlueprint);
// look up the slice for the entity actually being rendered.
$schemaOverridesBySlug = ConfigLoader::loadYaml("{$rootPath}/subdomains/{$slug}/schema/overrides.yaml");

$seo = SeoEngine::fromConfig($engineConfig);
$linking = new InternalLinkEngine();
$components = new ComponentRegistry($engineConfig);
$theme = new ThemeLoader($rootPath);
$templates = new TemplateEngine("{$rootPath}/templates");

$theme->writeCompiledCss($manifest['theme'] ?? 'default', "{$rootPath}/public/assets");

$schemaOverrides = $entity !== null ? ($schemaOverridesBySlug[$entity->slug] ?? []) : [];
$seoData = $entity !== null
    ? $seo->forRequest($entity, $manifest, $seoDefaults, $request->path, [], $schemaOverrides)
    : ['meta' => ['title' => $manifest['brand'] ?? '', 'description' => ''], 'canonical' => '', 'schema' => [], 'breadcrumbs' => null];

$relatedLinks = $entity !== null ? $linking->linksFor($entity->slug, $content) : [];
$slots = $components->slotsFor($match->layout, $manifest);

echo $templates->renderLayout($match->layout, [
    'manifest' => $manifest,
    'entity' => $entity,
    'seo' => $seoData,
    'nav' => $content->nav('primary'),
    'footerNav' => $content->nav('footer'),
    'relatedLinks' => $relatedLinks,
    'slots' => $slots,
    'content' => $content,
    'templates' => $templates,
    'theme' => $manifest['theme'] ?? 'default',
]);
