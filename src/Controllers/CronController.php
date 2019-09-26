<?php


namespace App\Controllers;


use App\Controller;
use App\Entities\Deposit;
use App\Entities\MoneyMovement;

class CronController extends Controller {
    public function __default() {
        echo "Wrong action name of the controller!!\n";
    }

    public function __home() {
        // Using only for HTTPController
    }

    public function calculation() {
        $current_date = new \DateTime();

        if ($current_date->format('d') == $current_date->format('t')) {
            $statement = 'SELECT * FROM deposit WHERE open_date=LAST_DAY(open_date);';
            $bind = null;
        } else {
            $statement = 'SELECT * FROM deposit WHERE DAY(open_date)=:current_day;';
            $bind = [':current_day' => $current_date->format('d')];
        }

        $result = $this->getDBManager()->find($statement, $bind, Deposit::class);

        /** @var Deposit $deposit */
        foreach ($result as $deposit) {
            $profit = $deposit->getEquity() * ($deposit->getRate() / 100);
            $deposit->setEquity($deposit->getEquity() + $profit);
            $deposit->update($this->getDBManager());

            $this->logMoneyMovement($deposit->getIdDeposit(), MoneyMovement::OT_DEPOSIT, $profit);
        }

        if ($current_date->format('j') == 1) {
            $statement = 'SELECT * FROM deposit;';
            $result = $this->getDBManager()->find($statement, null, Deposit::class);

            foreach ($result as $deposit) {
                if ($deposit->getEquity() < 1000) {
                    $fee = $deposit->getEquity() * ($this->getDepositFeeRate($deposit->getOpenDate(), 5) / 100);
                    $fee = $fee < 50 ? 50 : $fee;
                } else if ($deposit->getEquity() < 10000) {
                    $fee = $deposit->getEquity() * ($this->getDepositFeeRate($deposit->getOpenDate(), 6) / 100);
                } else {
                    $fee = $deposit->getEquity() * ($this->getDepositFeeRate($deposit->getOpenDate(), 7) / 100);
                    $fee = $fee > 5000 ? 5000 : $fee;
                }

                $equity = $deposit->getEquity() - $fee;

                $deposit->setEquity($equity < 0 ? 0 : $equity);
                $deposit->update($this->getDBManager());

                $this->logMoneyMovement($deposit->getIdDeposit(), MoneyMovement::OT_WITHDRAWAL, $fee);
            }
        }

        echo "Completed successfully.\n";
    }

    /**
     * @param \DateTime $open_date
     * @param float $base_rate
     * @return float
     */
    protected function getDepositFeeRate(\DateTime $open_date, float $base_rate): float {
        $days_passed = (int)(new \DateTime())->diff($open_date)->format('%d');
        $days_month = (int)$open_date->format('t');
        return ($days_passed && $days_passed <= $days_month) ? $base_rate / $days_month * $days_passed : $base_rate;
    }

    /**
     * @param int $id_deposit
     * @param string $operation_type
     * @param float $amount
     */
    protected function logMoneyMovement(int $id_deposit, string $operation_type, float $amount) {
        $money_movement = new MoneyMovement();
        $money_movement->setIdDeposit($id_deposit);
        $money_movement->setOperationType($operation_type);
        $money_movement->setAmount($amount);
        $money_movement->insert($this->getDBManager());
    }
}