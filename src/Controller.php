<?php


namespace App;


use App\Interfaces\IORM;

abstract class Controller {
    protected function getORM(): IORM {
        return Application::instance()->getOrm();
    }

    public function default() {
        echo "<h1>hello Wold!</h1>";
    }
}