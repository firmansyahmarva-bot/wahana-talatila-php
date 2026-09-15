<?php
/**
 * Structured data graph builder.
 * Called from includes/head.php on every page load.
 */

function build_schema_graph(): string {
    static $cache = null;
    if ($cache !== null) return $cache;

    $s = get_all_settings();
    $same_as = array_values(array_filter([
        $s['instagram_url'] ?? '',
        $s['facebook_url']  ?? '',
        $s['tiktok_url']    ?? '',
        $s['youtube_url']   ?? '',
    ]));

    $org = [
        '@type'        => 'Organization',
        '@id'          => SITE_URL . '/#organization',
        'name'         => $s['site_name'] ?? 'Wahana Totalita Konsultan',
        'url'          => SITE_URL,
        'logo'         => [
            '@type'  => 'ImageObject',
            'url'    => SITE_URL . ($s['og_image'] ?? '/assets/img/og-cover.svg'),
            'width'  => 1200,
            'height' => 630,
        ],
        'contactPoint' => [
            '@type'             => 'ContactPoint',
            'telephone'         => $s['site_phone'] ?? '',
            'contactType'       => 'customer service',
            'availableLanguage' => ['Indonesian'],
        ],
        'sameAs' => $same_as,
    ];

    $uri = strtok($_SERVER['REQUEST_URI'] ?? '/', '?');
    $is_home = ($uri === '/' || $uri === '');

    if (!$is_home) {
        $cache = json_encode([
            '@context' => 'https://schema.org',
            '@type'    => 'Organization',
            '@id'      => $org['@id'],
            'name'     => $org['name'],
            'url'      => $org['url'],
            'logo'     => $org['logo'],
            'sameAs'   => $org['sameAs'],
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        return $cache;
    }

    $graph   = [];
    $graph[] = $org;
    $graph[] = [
        '@type'       => 'LocalBusiness',
        '@id'         => SITE_URL . '/#localbusiness',
        'name'        => $s['site_name'] ?? 'Wahana Totalita Konsultan',
        'url'         => SITE_URL,
        'description' => 'Penyedia jasa pelatihan sertifikasi K3, Lingkungan, Mining, dan ISO terakreditasi KEMNAKER RI dan BNSP.',
        'priceRange'  => 'Rp3.000.000 – Rp8.750.000',
        'image'       => SITE_URL . ($s['og_image'] ?? '/assets/img/og-cover.svg'),
        'telephone'   => $s['site_phone'] ?? '',
        'email'       => $s['site_email'] ?? '',
        'address'     => [
            '@type'           => 'PostalAddress',
            'streetAddress'   => 'Jl. Wonosari No.km 8.5, Gandu, Sendangtirto, Berbah',
            'addressLocality' => 'Sleman',
            'addressRegion'   => 'Daerah Istimewa Yogyakarta',
            'postalCode'      => '55573',
            'addressCountry'  => 'ID',
        ],
        'geo' => [
            '@type'     => 'GeoCoordinates',
            'latitude'  => -7.7956,
            'longitude' => 110.3695,
        ],
        'openingHoursSpecification' => [
            '@type'     => 'OpeningHoursSpecification',
            'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
            'opens'     => '08:00',
            'closes'    => '17:00',
        ],
        'sameAs' => $same_as,
    ];

    $trainings = get_trainings();
    foreach ($trainings as $t) {
        $graph[] = [
            '@type'       => 'Course',
            'name'        => $t['name'],
            'description' => $t['description'] ?? $t['name'],
            'url'         => SITE_URL . '/pelatihan/' . $t['slug'] . '/',
            'provider'    => ['@id' => SITE_URL . '/#organization'],
            'educationalCredentialAwarded' => $t['certification'],
            'courseMode'  => $t['mode'] === 'offline' ? 'onsite' : 'online',
            'inLanguage'  => 'id',
            'offers'      => [
                '@type'        => 'Offer',
                'price'        => (string)(int)$t['price'],
                'priceCurrency'=> 'IDR',
                'availability' => 'https://schema.org/InStock',
                'url'          => SITE_URL . '/pelatihan/' . $t['slug'] . '/',
            ],
        ];
    }

    $cache = json_encode(
        ['@context' => 'https://schema.org', '@graph' => $graph],
        JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
    );
    return $cache;
}
