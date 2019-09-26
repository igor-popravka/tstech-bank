<?php


namespace App\Entities;

use App\Interfaces\IDBManager;
use App\DB\MySQLEntity;

class Deposit extends MySQLEntity {
    /**
     * @var integer
     */
    private $id_deposit;
    /**
     * @var integer
     */
    private $id_client;
    /**
     * @var string
     */
    private $account_number;
    /**
     * @var float
     */
    private $equity;
    /**
     * @var float
     */
    private $rate;
    /**
     * @var \DateTime
     */
    private $open_date;

    public function update(IDBManager $manager) {
        $manager->query("UPDATE deposit SET equity=:equity WHERE id_deposit=:id_deposit;", [':equity' => $this->getEquity(), ':id_deposit' => $this->getIdDeposit()]);
    }

    public function insert(IDBManager $manager) {
        // TODO: Implement insert() method.
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
    private function setIdDeposit(int $id_deposit) {
        $this->id_deposit = $id_deposit;
    }

    /**
     * @return int
     */
    public function getIdClient(): int {
        return $this->id_client;
    }

    /**
     * @param int $id_client
     */
    public function setIdClient(int $id_client) {
        $this->id_client = $id_client;
    }

    /**
     * @return string
     */
    public function getAccountNumber(): string {
        return $this->account_number;
    }

    /**
     * @param string $account_number
     */
    public function setAccountNumber(string $account_number) {
        $this->account_number = $account_number;
    }

    /**
     * @return float
     */
    public function getEquity(): float {
        return $this->equity;
    }

    /**
     * @param float $equity
     */
    public function setEquity(float $equity) {
        $this->equity = $equity;
    }

    /**
     * @return float
     */
    public function getRate(): float {
        return $this->rate;
    }

    /**
     * @param float $rate
     */
    public function setRate(float $rate) {
        $this->rate = $rate;
    }

    /**
     * @return \DateTime
     * @throws \Exception
     */
    public function getOpenDate(): \DateTime {
        return $this->open_date ?? new \DateTime();
    }

    /**
     * @param string $open_date
     */
    public function setOpenDate(string $open_date) {
        $this->open_date = \DateTime::createFromFormat(self::DB_DATE_FORMAT, $open_date);
    }
}