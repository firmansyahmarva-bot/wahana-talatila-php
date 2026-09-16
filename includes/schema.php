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
        'description'  => 'PJK3 Resmi Berlisensi Kementerian Ketenagakerjaan RI (No. Kep. 312/BINWASPNAK-PNK3/V/2020) dan Lembaga Pelatihan Sertifikasi K3, Lingkungan, Mining & ISO.',
        'logo'         => [
            '@type'  => 'ImageObject',
            'url'    => SITE_URL . ($s['og_image'] ?? '/assets/img/og-cover.jpg'),
            'width'  => 1200,
            'height' => 630,
        ],
        'contactPoint' => [
            '@type'             => 'ContactPoint',
            'telephone'         => $s['site_phone'] ?? '+62-877-5915-1278',
            'contactType'       => 'customer service',
            'availableLanguage' => ['Indonesian', 'English', 'Chinese'],
        ],
        'knowsAbout'   => [
            'Keselamatan dan Kesehatan Kerja (K3)',
            'Sertifikasi BNSP',
            'Sertifikasi Kemnaker RI',
            'SMK3 PP 50/2012',
            'Riksa Uji Alat Berat (SIA)',
            'Surat Izin Operator (SIO)'
        ],
        'sameAs' => $same_as,
    ];

    $uri = strtok($_SERVER['REQUEST_URI'] ?? '/', '?');
    $is_home = ($uri === '/' || $uri === '');

    if (!$is_home) {
        $cache = json_encode([
            '@context'    => 'https://schema.org',
            '@type'       => 'Organization',
            '@id'         => $org['@id'],
            'name'        => $org['name'],
            'url'         => $org['url'],
            'description' => $org['description'],
            'logo'        => $org['logo'],
            'contactPoint'=> $org['contactPoint'],
            'sameAs'      => $org['sameAs'],
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
        'description' => 'Penyedia jasa pelatihan sertifikasi K3, Lingkungan, Mining, dan ISO terakreditasi KEMNAKER RI (No. Kep. 312/BINWASPNAK-PNK3/V/2020) dan BNSP.',
        'priceRange'  => 'Rp3.000.000 – Rp8.750.000',
        'image'       => SITE_URL . ($s['og_image'] ?? '/assets/img/og-cover.jpg'),
        'telephone'   => $s['site_phone'] ?? '+62-877-5915-1278',
        'email'       => $s['site_email'] ?? 'info@wahanatotalita.com',
        'hasMap'      => 'https://maps.google.com/?q=-7.7956,110.3695',
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

    $cache = json_encode(
        ['@context' => 'https://schema.org', '@graph' => $graph],
        JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
    );
    return $cache;
}
