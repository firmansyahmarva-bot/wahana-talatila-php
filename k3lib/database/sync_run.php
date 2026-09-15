<?php
// CLI: php k3lib/database/sync_run.php
// Cron (every 30 min):
//   */30 * * * * /usr/bin/php /home/u566907099/domains/wahanatotalita.com/public_html/k3lib/database/sync_run.php >> /home/u566907099/domains/wahanatotalita.com/public_html/k3lib/database/sync.log 2>&1
require __DIR__ . '/../src/autoload.php';
require_once __DIR__ . '/../src/helpers.php';

use App\MainDatabase;
use App\Database;
use App\Sync\ProgramSync;

$n = (new ProgramSync(MainDatabase::connection(), Database::connection()))->run();
echo date('Y-m-d H:i:s') . " — synced {$n} programs into programs_cache\n";
