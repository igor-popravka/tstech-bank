<?php


namespace App;


use App\Interfaces\IConfig;
use App\Interfaces\IDBManager;

abstract class Controller {
    private $db_manager;

    private $config;

    public function __construct(IDBManager $db_manager, IConfig $config) {
        $this->db_manager = $db_manager;
        $this->config = $config;
    }

    /**
     * @return IDBManager
     */
    protected function getDBManager(): IDBManager {
        return $this->db_manager;
    }

    /**
     * @return IConfig|AppConfig
     */
    protected function getConfig(): IConfig {
        return $this->config;
    }

    public function __action() {
        echo "<h1>hello Wold!</h1>";
    }
}