<?php
if ( !defined('APP_ROOT_PATH') )
    define('APP_ROOT_PATH', dirname(dirname(__FILE__)) . '/app/');

if ( !defined('CORE_ROOT_PATH') )
    define('CORE_ROOT_PATH', dirname(dirname(__FILE__)) . '/core/');

if ( !defined('TMP_ROOT_PATH') )
    define('TMP_ROOT_PATH', dirname(dirname(__FILE__)) . '/tmp/');

if ( !defined('VENDOR_ROOT_PATH') )
    define('VENDOR_ROOT_PATH', dirname(dirname(__FILE__)) . '/vendor/');

session_start();

require_once VENDOR_ROOT_PATH . 'autoload.php';
require_once CORE_ROOT_PATH . 'system/AutoClassLoader.php';
require_once CORE_ROOT_PATH . 'system/AutoConfigLoader.php';

Router::go();
