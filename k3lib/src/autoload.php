<?php
// Minimal autoloader — no Composer. Namespace App\ maps to k3lib/src/.
spl_autoload_register(function (string $class) {
    if (strpos($class, 'App\\') !== 0) return;
    $rel = substr($class, 4);
    $path = __DIR__ . '/' . str_replace('\\', '/', $rel) . '.php';
    if (is_file($path)) require $path;
});
