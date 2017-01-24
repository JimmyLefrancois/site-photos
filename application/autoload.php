<?php

spl_autoload_register(function ($class) {
    $path = __DIR__ . '/library/' . str_replace('\\', '/', $class) . '.php';
    
    if (is_file($path)) {
        require $path;
    }
});
