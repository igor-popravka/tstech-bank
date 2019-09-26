<?php

namespace App\Entities;

use App\DB\MySQLEntity;
use App\Interfaces\IDBManager;

/**
 * @author: igor.popravka
 * Date: 26.09.2019
 * Time: 12:20
 */
class MoneyMovement extends MySQLEntity {
    const OT_DEPOSIT = 'D';
    const OT_WITHDRAWAL = 'W';
    /**
     * @var integer
     */
    private $id_money_movement;
    /**
     * @var integer
     */
    private $id_deposit;
    /**
     * @var string
     */
    private $operation_type;
    /**
     * @var float
     */
    private $amount;
    /**
     * @var \DateTime
     */
    private $operation_date;

    public function update(IDBManager $manager) {
        // TODO: Implement update() method.
    }

    public function insert(IDBManager $manager) {
        $statement = "INSERT money_movement (id_deposit, operation_type, amount, operation_date) VALUES (:id_deposit, :operation_type, :amount, :operation_date);";
        $bind = [
            ':id_deposit' => $this->getIdDeposit(),
            ':operation_type' => $this->getOperationType(),
            ':amount' => $this->getAmount(),
            ':operation_date' => $this->getOperationDate()->format(self::DB_DATE_FORMAT),
        ];

        $manager->query($statement, $bind);
    }

    /**
     * @return int
     */
    public function getIdMoneyMovement(): int {
        return $this->id_money_movement;
    }

    /**
     * @param int $id_money_movement
     */
    private function setIdMoneyMovement(int $id_money_movement) {
        $this->id_money_movement = $id_money_movement;
    }

    /**
     * @return int
     */
    public function getIdDeposit(): int {
        return $this->id_deposit;
    }

    /**
     * @param int $id_deposit
     */
    public function setIdDeposit(int $id_deposit) {
        $this->id_deposit = $id_deposit;
    }

    /**
     * @return string
     */
    public function getOperationType(): string {
        return $this->operation_type;
    }

    /**
     * @param string $operation_type
     */
    public function setOperationType(string $operation_type) {
        $this->operation_type = $operation_type;
    }

    /**
     * @return float
     */
    public function getAmount(): float {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount(float $amount) {
        $this->amount = $amount;
    }

    /**
     * @return \DateTime
     */
    public function getOperationDate(): \DateTime {
        return $this->operation_date ?? new \DateTime();
    }

    /**
     * @param string $operation_date
     */
    public function setOperationDate(string $operation_date) {
        $this->operation_date = \DateTime::createFromFormat(self::DB_DATE_FORMAT, $operation_date);
    }
}