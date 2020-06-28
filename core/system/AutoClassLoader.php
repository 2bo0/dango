<?php

class AutoClassLoader
{
    private static $dirs;

    public static function autoLoad($class)
    {
        foreach (self::directories() as $directory) {
            $file = "{$directory}/{$class}.php";
            if (is_file($file)) {
                require_once $file;
                return true;
            }
        }
    }

    private static function directories()
    {
        if (empty(self::$dirs)) {
            self::$dirs = array(
                APP_ROOT_PATH . '/config',
                CORE_ROOT_PATH . '/include',
                CORE_ROOT_PATH . '/controllers'
            );
        }
        return self::$dirs;
    }
}

spl_autoload_register(array('AutoClassLoader', 'autoLoad'));
