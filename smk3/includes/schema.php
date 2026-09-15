<?php
/**
 * SCHEMA — builds all JSON-LD for the current page from manifest data.
 * Returns an array of schema objects; header.php prints them.
 */

function build_schema(array $page, array $SITE, array $faq): array {
  $url    = page_url($page['key']);
  $imgUrl = $SITE['base_url'] . img_path($page['key']);
  $orgId  = $SITE['base_url'] . '/#organization';
  $siteId = $SITE['base_url'] . '/#website';

  $graph = [];

  /* Organization — sitewide */
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
  $crumbs = [[
    '@type' => 'ListItem', 'position' => 1,
    'name' => 'Beranda', 'item' => $SITE['base_url'] . '/',
  ]];
  $pos = 2;
  if ($page['hub'] !== 'money' && $page['type'] !== 'hub') {
    $hubKey = $SITE['hub_pages'][$page['hub']];
    $crumbs[] = [
      '@type' => 'ListItem', 'position' => $pos++,
      'name' => $SITE['hub_names'][$page['hub']], 'item' => page_url($hubKey),
    ];
  }
  if ($page['key'] !== 'home') {
    $crumbs[] = [
      '@type' => 'ListItem', 'position' => $pos,
      'name' => $page['h1'], 'item' => $url,
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

  /* WebPage (all) + Article (hub/article types) */
  $webpage = [
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
  $graph[] = $webpage;

  if ($page['type'] !== 'money') {
    $graph[] = [
      '@type' => 'Article',
      '@id'   => $url . '#article',
      'headline' => $page['h1'],
      'description' => $page['meta'],
      'inLanguage'  => 'id-ID',
      'image'  => ['@id' => $url . '#primaryimage'],
      'author' => ['@id' => $orgId],
      'publisher' => ['@id' => $orgId],
      'mainEntityOfPage' => ['@id' => $url . '#webpage'],
    ];
  }

  /* Service — money pages (except kontak, which gets LocalBusiness) */
  if ($page['type'] === 'money' && $page['key'] !== 'kontak' && $page['key'] !== 'home') {
    $graph[] = [
      '@type' => 'Service',
      '@id'   => $url . '#service',
      'name'  => $page['h1'],
      'description' => $page['meta'],
      'provider' => ['@id' => $orgId],
      'areaServed' => 'Indonesia',
      'serviceType' => 'Konsultan SMK3',
    ];
  }

  /* LocalBusiness — kontak page */
  if ($page['key'] === 'kontak') {
    $graph[] = [
      '@type' => 'ProfessionalService',
      '@id'   => $url . '#localbusiness',
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
  }

  /* FAQPage — whenever the content declared a $faq array */
  if (!empty($faq)) {
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
