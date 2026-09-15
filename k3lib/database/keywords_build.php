<?php
// CLI: php k3lib/database/keywords_build.php
require __DIR__ . '/../src/autoload.php';
require_once __DIR__ . '/../src/helpers.php';

use App\Database;
use App\Sync\KeywordBuilder;

$attempted = (new KeywordBuilder(Database::connection()))->run();
$total = Database::connection()->query("SELECT COUNT(*) c FROM keywords")->fetch()['c'];
echo date('Y-m-d H:i:s') . " — keyword build attempted {$attempted} inserts, total rows now: {$total}\n";
