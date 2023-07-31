<?php

namespace core\config;

class Config
{

    private static Config $instance;

    private function __construct()
    {
        self::getInstance();
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::loadEnv();
        }

        return self::$instance;
    }

    private static function loadEnv(): void
    {
        $lines = file('.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos($line, '=') !== false) {
                list($key, $value) = explode('=', $line, 2);
                $_ENV[$key] = $value;
            }
        }
    }
}
