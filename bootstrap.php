<?php

use App\Core;
use App\DB\MySQLConfig;
use App\DB\MySQLConnection;
use App\DB\MySQLManager;
use App\AppConfig;

require_once APP_ROOT . "vendor/autoload.php";

$mysql_config = (new MySQLConfig())->load(APP_ROOT . 'config/mysql_config.ini');

$mysql_connection = new MySQLConnection($mysql_config);

$mysql_manager = new MySQLManager($mysql_connection);

$app_config = (new AppConfig())->load(APP_ROOT . 'config/app_config.ini');

Core::instance()
    ->setDBManager($mysql_manager)
    ->setAppConfig($app_config);
