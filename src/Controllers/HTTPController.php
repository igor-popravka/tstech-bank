<?php


namespace App\Controllers;


use App\Controller;
use App\Entities\MoneyMovement;

class HTTPController extends Controller {
    public function __default() {
        echo "<h4>Invalid action!</h4><p><a href='/'>Back</a></p>";
    }

    public function __home() {
        $statement = "SELECT DATE_FORMAT(operation_date,'%M %Y') as OpMonth, sum(amount) as SumAmount, operation_type as OpType FROM money_movement group by OpMonth, OpType;";
        $result = $this->getDBManager()->find($statement);

        $loss_profit = [];
        foreach ($result as $row) {
            if (!isset($loss_profit[$row['OpMonth']])) {
                $loss_profit[$row['OpMonth']] = ['num' => count($loss_profit) + 1, 'loss' => 0, 'profit' => 0];
            }

            $point = ($row['OpType'] == MoneyMovement::OT_WITHDRAWAL) ? 'loss' : 'profit';
            $loss_profit[$row['OpMonth']][$point] = round($row['SumAmount'], 2);
        }

        $statement = "SELECT case ";
        $statement .= "when (YEAR(NOW()) - YEAR(tclient.birthday)) BETWEEN 18 AND 25 then 'I group' ";
        $statement .= "when (YEAR(NOW()) - YEAR(tclient.birthday)) BETWEEN 26 AND 50 then 'II group' ";
        $statement .= "when (YEAR(NOW()) - YEAR(tclient.birthday)) > 50 then 'III group' ";
        $statement .= "end as year_group, avg(tdeposit.equity) as deposit_equity FROM `ts-bank`.client as tclient, `ts-bank`.deposit as tdeposit group by year_group;";

        $average_amount = $this->getDBManager()->find($statement);

        try {
            $this->getViewer()->render('home', ['loss_profit' => $loss_profit, 'average_amount' => $average_amount]);
        } catch (\Throwable $t) {
            echo "<h4>Failed rendering template: <>";
        }
    }
}