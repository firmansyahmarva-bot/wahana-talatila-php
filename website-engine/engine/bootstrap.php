<?php

declare(strict_types=1);

/**
 * Zero-dependency PSR-4-style autoloader for the Engine\ namespace, so the
 * engine runs from plain `php -S` or any host without a composer install
 * step. If composer.json is ever used to add a real dependency, this can be
 * replaced by requiring vendor/autoload.php instead.
 */
spl_autoload_register(static function (string $class): void {
    $prefix = 'Engine\\';
    if (!str_starts_with($class, $prefix)) {
        return;
    }

    $relative = substr($class, strlen($prefix));
    $path = __DIR__ . '/' . str_replace('\\', '/', $relative) . '.php';

    if (is_file($path)) {
        require $path;
    }
});
