<?php

define('APP_ROOT', dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR);

require_once APP_ROOT . "bootstrap.php";

use App\Core;
use App\Controllers\HTTPController;
use App\HTTPViewer;

$controller = new HTTPController(Core::instance()->getDBManager(), new HTTPViewer(APP_ROOT . 'templates' . DIRECTORY_SEPARATOR));
$action = isset($_GET['a']) ? $_GET['a'] : Core::instance()->getAppConfig()['CONTROLLER']['home_action'];
$params = array_filter($_GET, function ($key){
    return $key != 'a';
}, ARRAY_FILTER_USE_KEY);

Core::instance()->run($controller, $action, $params);
