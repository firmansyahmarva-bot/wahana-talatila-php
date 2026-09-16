<?php
// Shared constants — kept in sync with the main site's tracking setup
// (CLAUDE.md: GTM-MMZHD3HN, WA 6287759151278).
return [
    'canonical_base' => 'https://wahanatotalita.com',
    'hub_path'       => '/k3',
    'wa_number'      => '6287759151278',
    'gtm_id'         => 'GTM-MMZHD3HN',
    'org_name'       => 'Wahana Totalita Konsultan',
    // Real main-site program URL pattern (CLAUDE.md: pelatihan.php → /pelatihan/{slug}/)
    'program_url_pattern' => 'https://wahanatotalita.com/pelatihan/{slug}/',
    // Secret for k3lib/database/refresh.php's browser trigger. Change this
    // before deploying, then use the new value in the URL / cron command.
    'refresh_key' => 'k3-refresh-Ht9x2Qv7',
];
