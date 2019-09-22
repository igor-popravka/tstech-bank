<?php


namespace App\Controllers;


use App\Controller;

class HTTPController extends Controller {
    public function users() {
        $users = $this->getORM()->query('SELECT * From clients');
        var_dump($users);
    }
}