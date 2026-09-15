<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';

redirect(current_admin() ? mailer_url('dashboard.php') : mailer_url('login.php'));
