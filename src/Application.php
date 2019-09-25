<?php

namespace App;

use App\Interfaces\IORM;

class Application {
    private $orm;

    private static $instance;

    /**
     * Application constructor.
     */
    private function __construct() {
    }

    public static function instance(): Application {
        if (!isset(self::$instance)) {
            self::$instance = new Application();
        }
        return self::$instance;
    }

    /**
     * @return IORM
     */
    public function getOrm(): IORM {
        return $this->orm;
    }

    /**
     * @param IORM $orm
     * @return Application
     */
    public function setOrm(IORM $orm): Application {
        $this->orm = $orm;
        return $this;
    }

    public function run(Controller $controller, string $action, array $params = []) {
        if (method_exists($controller, $action)) {
            call_user_func_array([$controller, $action], $params);
        } else {
            call_user_func([$controller, Controller::DEFAULT_ACTION]);
        }
    }
}