<?php

// Create a PSR-4 compliant autoloader in the namespace "PHPhademic
spl_autoload_register(function ($class) {
    $prefix = 'PHPhademic\\';

    $base_dir = __DIR__ . '/src/';

    if (strpos($class, $prefix) !== 0)
        return;

    $relative_class = substr($class, strlen($prefix));
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file))
        require $file;
});