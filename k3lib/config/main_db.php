<?php
// MAIN Wahana DB (source of truth for program data). Used ONLY by the sync
// script (database/sync_run.php), which runs SELECT-only against `trainings`.
// Nothing in the request path ever connects here.
return [
    'host'    => 'localhost',
    'name'    => 'u566907099_wahana_db',
    'user'    => 'u566907099_billalpenacons',
    'pass'    => 'Hati@4413',
    'charset' => 'utf8mb4',
];
