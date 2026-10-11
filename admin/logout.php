<?php
require_once __DIR__ . '/../config.php';
require_admin();
session_destroy();
redirect(SITE_URL . '/admin/login.php');
