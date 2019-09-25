<?php


namespace App\Controllers;


use App\Controller;
use App\Entities\Deposit;

class CronController extends Controller {
    public function calculation() {
        $result = $this->getDBManager()->find("SELECT * FROM deposit WHERE id_deposit=:id_deposit;", [':id_deposit' => 2], Deposit::class);
        /** @var Deposit $deposit */
        $deposit = array_shift($result);
        $deposit->setEquity(3123.50);
        $deposit->update($this->getDBManager());
        //var_dump($result);
    }
}