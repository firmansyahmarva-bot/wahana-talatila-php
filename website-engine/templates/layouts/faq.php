<?php
/** @var Engine\Content\ContentRepository $content */
$faqs = $content->faqs();
$bodyHtml = $templates->renderComponent('faq-block', ['faqs' => $faqs]);
echo $templates->renderLayout('base', array_merge(get_defined_vars(), ['bodyHtml' => $bodyHtml]));
