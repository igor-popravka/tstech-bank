<?php

namespace App;

use App\Interfaces\IConfig;
use App\Interfaces\IDBManager;

class Core {
    private $db_manager;

    private $app_config;

    private static $instance;

    /**
     * Application constructor.
     */
    private function __construct() {
    }

    public static function instance(): Core {
        if (!isset(self::$instance)) {
            self::$instance = new Core();
        }
        return self::$instance;
    }

    /**
     * @return IDBManager
     */
    public function getDBManager(): IDBManager {
        return $this->db_manager;
    }

    /**
     * @param IDBManager $db_manager
     * @return Core
     */
    public function setDBManager(IDBManager $db_manager): Core {
        $this->db_manager = $db_manager;
        return $this;
    }

    /**
     * @return AppConfig
     */
    public function getAppConfig(): IConfig {
        return $this->app_config;
    }

    /**
     * @param IConfig $app_config
     * @return Core
     */
    public function setAppConfig(IConfig $app_config): Core {
        $this->app_config = $app_config;
        return $this;
    }

    public function run(Controller $controller, string $action, array $params = []) {
        if (method_exists($controller, $action)) {
            call_user_func_array([$controller, $action], $params);
        } else {
            call_user_func([$controller, $this->getAppConfig()->getDefaultAction()]);
        }
    }
}