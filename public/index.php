<?php

require_once "../bootstrap.php";

use App\Application;
use App\Controllers\HTTPController;

$controller = new HTTPController();
$action = $_GET['a'] ?? 'default';
$params = array_filter($_GET, function ($key){
    return $key != 'a';
}, ARRAY_FILTER_USE_KEY);

Application::instance()->run($controller, $action, $params);
