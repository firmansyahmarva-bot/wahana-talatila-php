<?php
/** @var Engine\Content\ContentEntity|null $entity */
/** @var array $manifest */
$bodyHtml = $entity?->bodyHtml ?? '';

// hero.php already renders the page <h1> (with an eyebrow); the markdown
// body always opens with its own "# Title" per SubdomainGenerator, which
// would otherwise duplicate it. Strip that first heading here rather than
// asking every subdomain's content to omit it.
$bodyHtml = preg_replace('/^\s*<h1>.*?<\/h1>/s', '', $bodyHtml, 1) ?? $bodyHtml;

// Visible authorship signal, shown on substantive content pages only (not
// the FAQ utility page). Reads manifest.yaml (`author: {name, credential}`)
// - every subdomain opts in independently, nothing hardcoded here.
$author = $manifest['author'] ?? null;
if ($entity !== null && in_array($entity->type, ['pillar', 'cluster'], true) && is_array($author) && ($author['name'] ?? '') !== '') {
    $credential = $author['credential'] ?? '';
    $byline = 'Ditinjau oleh ' . htmlspecialchars($author['name']) . ($credential !== '' ? ', ' . htmlspecialchars($credential) : '');
    $bodyHtml = '<p class="page-hero byline" style="padding:0;border:none;">' . $byline . '</p>' . $bodyHtml;
}

$bodyHtml = '<div class="wrap"><div class="prose">' . $bodyHtml . '</div></div>';

echo $templates->renderLayout('base', array_merge(get_defined_vars(), ['bodyHtml' => $bodyHtml]));
