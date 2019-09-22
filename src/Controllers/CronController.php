<?php


namespace App\Controllers;


use App\Controller;
use App\Entities\Deposit;

class CronController extends Controller {
    public function calculation() {
        $result = $this->getORM()->fetchAll(Deposit::class);
        var_dump($result);
    }
}