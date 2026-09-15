<?php
// Combined refresh: ProgramSync (mirror trainings -> programs_cache) then
// KeywordBuilder (rebuild the long-tail surface). Two ways to run this:
//
//   1) CRON (recommended, recurring):
//      */30 * * * * /usr/bin/php /home/u566907099/domains/wahanatotalita.com/public_html/k3lib/database/refresh.php
//      CLI runs are always allowed, no key needed.
//
//   2) BROWSER (one-time, e.g. right after deploy, no terminal needed):
//      https://wahanatotalita.com/k3lib/database/refresh.php?key=k3-refresh-Ht9x2Qv7
//      Requires the key from config/settings.php ('refresh_key') — change that
//      value before deploying, then use your own key here. Delete/rename this
//      file, or at least change the key, once you no longer need browser access.
//      NOTE: k3lib/.htaccess blocks direct access to everything in k3lib/ — to
//      use the browser trigger you must add a narrow allow rule for this one
//      file (see DEPLOY.md), otherwise only the cron path will work.

require __DIR__ . '/../src/autoload.php';
require_once __DIR__ . '/../src/helpers.php';

use App\MainDatabase;
use App\Database;
use App\Sync\ProgramSync;
use App\Sync\KeywordBuilder;

$isCli = (php_sapi_name() === 'cli');

if (!$isCli) {
    $settings = require __DIR__ . '/../config/settings.php';
    $key = $_GET['key'] ?? '';
    if (!hash_equals($settings['refresh_key'], (string)$key)) {
        http_response_code(403);
        exit("Forbidden. Pass ?key=<refresh_key from config/settings.php>.\n");
    }
    header('Content-Type: text/plain');
}

$synced = (new ProgramSync(MainDatabase::connection(), Database::connection()))->run();
echo date('Y-m-d H:i:s') . " — synced {$synced} programs into programs_cache\n";

$kwAttempted = (new KeywordBuilder(Database::connection()))->run();
$kwTotal = Database::connection()->query("SELECT COUNT(*) c FROM keywords")->fetch()['c'];
echo date('Y-m-d H:i:s') . " — keyword build attempted {$kwAttempted} inserts, total rows now: {$kwTotal}\n";
