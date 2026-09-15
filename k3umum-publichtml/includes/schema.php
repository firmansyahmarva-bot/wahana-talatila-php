<?php
/**
 * SCHEMA — builds all JSON-LD for the current page from manifest data.
 */

function build_schema(array $page, array $SITE, array $faq, array $howto): array {
  $url    = page_url($page['key']);
  $imgUrl = $SITE['base_url'] . img_path($page['key']);
  $orgId    = $SITE['base_url'] . '/#organization';
  $siteId   = $SITE['base_url'] . '/#website';
  $authorId = $SITE['base_url'] . '/#author-' . preg_replace('/[^a-z0-9]+/', '-', strtolower($SITE['author']['name']));

  $graph = [];

  /* Organization — sitewide (publisher, not author — content is human-written/reviewed) */
  $graph[] = [
    '@type' => 'Organization',
    '@id'   => $orgId,
    'name'  => $SITE['org_name'],
    'url'   => $SITE['org_url'],
    'email' => $SITE['email'],
    'telephone' => '+' . $SITE['wa_number'],
    'address' => [
      '@type' => 'PostalAddress',
      'addressLocality' => $SITE['org_city'],
      'addressRegion'   => $SITE['org_region'],
      'addressCountry'  => $SITE['org_country'],
    ],
  ];

  /* Person — the named reviewer/author (E-E-A-T). Placeholder fields until
     real credentials are supplied; see config/site.php TODOs. */
  $person = [
    '@type' => 'Person',
    '@id'   => $authorId,
    'name'  => $SITE['author']['name'],
    'jobTitle' => $SITE['author']['title'],
    'description' => $SITE['author']['bio'],
  ];
  if ($SITE['author']['photo']) $person['image'] = $SITE['base_url'] . $SITE['author']['photo'];
  $graph[] = $person;

  /* WebSite — sitewide */
  $graph[] = [
    '@type' => 'WebSite',
    '@id'   => $siteId,
    'name'  => $SITE['site_name'] . ' — ' . $SITE['tagline'],
    'url'   => $SITE['base_url'] . '/',
    'inLanguage' => 'id-ID',
    'publisher'  => ['@id' => $orgId],
  ];

  /* Breadcrumb */
  $trail = breadcrumb_trail($page);
  $crumbs = [];
  $pos = 1;
  foreach ($trail as $t) {
    $crumbs[] = [
      '@type' => 'ListItem', 'position' => $pos++,
      'name' => $t['label'], 'item' => $t['url'] ?? $url,
    ];
  }
  $graph[] = ['@type' => 'BreadcrumbList', '@id' => $url . '#breadcrumb', 'itemListElement' => $crumbs];

  /* ImageObject for the featured illustration */
  $graph[] = [
    '@type' => 'ImageObject',
    '@id'   => $url . '#primaryimage',
    'url'   => $imgUrl,
    'caption' => $page['img_alt'],
  ];

  /* WebPage */
  $graph[] = [
    '@type' => 'WebPage',
    '@id'   => $url . '#webpage',
    'url'   => $url,
    'name'  => $page['title'],
    'description' => $page['meta'],
    'inLanguage'  => 'id-ID',
    'isPartOf'    => ['@id' => $siteId],
    'breadcrumb'  => ['@id' => $url . '#breadcrumb'],
    'primaryImageOfPage' => ['@id' => $url . '#primaryimage'],
  ];

  /* Article — every page except home (home gets no Article, it's the index) */
  if ($page['key'] !== 'home') {
    $graph[] = [
      '@type' => 'Article',
      '@id'   => $url . '#article',
      'headline' => $page['h1'],
      'description' => $page['meta'],
      'inLanguage'  => 'id-ID',
      'image'  => ['@id' => $url . '#primaryimage'],
      'author' => ['@id' => $authorId],
      'reviewedBy' => ['@id' => $authorId],
      'publisher' => ['@id' => $orgId],
      'mainEntityOfPage' => ['@id' => $url . '#webpage'],
    ];
  }

  /* HowTo — only step-by-step pages that populate $howto */
  if (!empty($howto)) {
    $steps = [];
    foreach ($howto['steps'] as $i => $s) {
      $steps[] = ['@type' => 'HowToStep', 'position' => $i + 1, 'name' => $s['name'] ?? $s, 'text' => $s['text'] ?? $s];
    }
    $graph[] = [
      '@type' => 'HowTo', '@id' => $url . '#howto',
      'name' => $howto['name'] ?? $page['h1'],
      'step' => $steps,
    ];
  }

  /* FAQPage — masterplan rule: this schema type is emitted ONLY on the
     dedicated FAQ page (f4), even though other pages may render a visible
     Q&A accordion from $faq without emitting FAQPage JSON-LD for it. */
  if (!empty($faq) && $page['key'] === 'f4') {
    $items = [];
    foreach ($faq as $qa) {
      $items[] = [
        '@type' => 'Question',
        'name'  => $qa['q'],
        'acceptedAnswer' => ['@type' => 'Answer', 'text' => $qa['a']],
      ];
    }
    $graph[] = ['@type' => 'FAQPage', '@id' => $url . '#faq', 'mainEntity' => $items];
  }

  return ['@context' => 'https://schema.org', '@graph' => $graph];
}
