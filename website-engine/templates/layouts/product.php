<?php
/** @var Engine\Content\ContentEntity|null $entity */
$bodyHtml = $entity?->bodyHtml ?? '<p>Product not found.</p>';
echo $templates->renderLayout('base', array_merge(get_defined_vars(), ['bodyHtml' => $bodyHtml]));
