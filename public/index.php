<?php

use App\Application;
use App\AppConfig;
use App\Controllers\CronController;
use App\Controllers\HTTPController;
use App\ORM\MySQLConfig;
use App\ORM\MySQLConnection;
use App\ORM\ORM;

define('APP_PATH', dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR);

require_once APP_PATH . "vendor/autoload.php";

$config = new AppConfig();
$config->loadFromFile(APP_PATH . 'config.ini');

$mysql_config = new MySQLConfig($config['MySQL']);
$mysql_connection = new MySQLConnection($mysql_config);

$orm = new ORM();
$orm->setConnection($mysql_connection);

Application::instance()
    ->setOrm($orm);

if (php_sapi_name() == "cli") {
    $controller = new CronController();
    $action = $argv[1] ?? 'default';
    $params = array_slice($argv, 2);
} else {
    $controller = new HTTPController();
    $action = $_GET['a'] ?? 'default';
    $params = array_filter($_GET, function ($key){
        return $key != 'a';
    }, ARRAY_FILTER_USE_KEY);
}

Application::instance()->run($controller, $action, $params);
