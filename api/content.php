<?php
/**
 * api/content.php
 * Unified router for Wahana Totalita Content APIs.
 * Routes to trainings or articles based on query/payload "entity".
 */

$entity = strtolower(trim((string)($_GET['entity'] ?? 'trainings')));

if ($entity === 'articles' || $entity === 'artikel' || $entity === 'article') {
    require __DIR__ . '/articles.php';
} else {
    require __DIR__ . '/trainings.php';
}
