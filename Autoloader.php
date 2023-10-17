<?php

class Autoloader
{
    public static function register()
    {
        spl_autoload_register([__CLASS__, 'autoload']);
    }

    public static function autoload($class)
    {
        // Convert namespace to directory path and include the file
        $file = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
        if (file_exists($file)) {
            include $file;
        }
    }
}

