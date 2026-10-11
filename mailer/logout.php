<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';

$_SESSION = [];
session_destroy();
redirect(mailer_url('login.php'));
