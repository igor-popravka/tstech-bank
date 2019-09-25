<?php

use App\Application;
use App\AppConfig;
use App\ORM\MySQLConfig;
use App\ORM\MySQLConnection;
use App\ORM\ORM;

require_once APP_ROOT . "vendor/autoload.php";

$config = new AppConfig();
$config->loadFromFile(APP_ROOT . 'config.ini');

$mysql_config = new MySQLConfig($config['MySQL']);
$mysql_connection = new MySQLConnection($mysql_config);

$orm = new ORM();
$orm->setConnection($mysql_connection);

Application::instance()
    ->setOrm($orm);
