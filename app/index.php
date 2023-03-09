<?php

/**
 * 1 - Debug on
 * 0 - Debug off
 */

use components\FileLogger;
use controllers\MainController;

const DEBUG = 1;

if (DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}else{
    error_reporting(0);
    ini_set('display_errors', 0);
}

define('ROOT', dirname(__FILE__));
require_once(ROOT . '/controllers/MainController.php');
require_once(ROOT . '/components/LoggerInterface.php');
require_once(ROOT . '/components/FileLogger.php');
require_once(ROOT . '/components/Validator.php');
require_once(ROOT . '/models/User.php');

$main = new MainController((new FileLogger('logs/log.txt')));
$main->actionIndex();