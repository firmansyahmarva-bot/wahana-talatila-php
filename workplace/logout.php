<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/workplace-functions.php';
wp_logout();
redirect(SITE_URL . '/workplace/login/');
