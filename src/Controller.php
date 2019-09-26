<?php


namespace App;


use App\Interfaces\IDBManager;
use App\Interfaces\IViewer;

abstract class Controller {
    /**
     * @var IDBManager
     */
    private $db_manager;

    /**
     * @var IViewer
     */
    private $viewer;

    abstract public function __default();

    abstract public function __home();

    public function __construct(IDBManager $db_manager, IViewer $viewer = null) {
        $this->db_manager = $db_manager;
        $this->viewer = $viewer;
    }

    /**
     * @return IDBManager
     */
    protected function getDBManager(): IDBManager {
        return $this->db_manager;
    }

    /**
     * @return IViewer|null
     */
    protected function getViewer():? IViewer {
        return $this->viewer;
    }
}