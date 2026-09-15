<?php
/** @var Engine\Content\ContentRepository $content */
$homepage = $content->homepage();
echo $templates->renderLayout('base', array_merge(get_defined_vars(), ['bodyHtml' => '']));
