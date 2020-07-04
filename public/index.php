<?php
if ( !defined('APP_ROOT_PATH') )
    define('APP_ROOT_PATH', dirname(dirname(__FILE__)) . '/app/');

if ( !defined('CORE_ROOT_PATH') )
    define('CORE_ROOT_PATH', dirname(dirname(__FILE__)) . '/core/');

session_start();

require_once CORE_ROOT_PATH . '/system/AutoClassLoader.php';
require_once CORE_ROOT_PATH . '/system/AutoConfigLoader.php';

Router::go();
